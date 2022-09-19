<?php

namespace Modules\Proposal\Http\Controllers;

use DB;
use Auth;
use DataTables;
use App\Models\PublicTrxProposal;
use App\Models\PublicTrxPemohon;
use App\Models\PublicTrxProposalTimeline;
use App\Models\PublicTrxProsesStatus;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ramsey\Uuid\Uuid;

class ApprovalProposalController extends Controller
{
    private $folder_path = '';

    function __construct(){
        $this->middleware('auth');
    }

    /**
     * Index
     *
     * @return \Illuminate\Http\Response
     */
    function index($id = NULL){
        if ($id) {
            $filename_page 	= 'detail';
            $title 			= 'Detail Proposal';
            $proposal        = PublicTrxProposal::find($id);

            \LogActivity::saveLog(
                $logTp = 'visit',
                $logNm = "Membuka Menu $title $id"
            );

            return view('proposal::' . $this->folder_path . '.' . $filename_page, compact('title', 'proposal'));
        }else{
            $filename_page 	= 'index';
            $title 			= 'Proposal';

            \LogActivity::saveLog(
                $logTp = 'visit',
                $logNm = "Membuka Menu $title"
            );

            return view('proposal::' . $this->folder_path . '.' . $filename_page, compact('title'));
        }
    }

    /**
     * Show : DataTables
     *
     * @return \Illuminate\Http\Response
     */
    function getData(Request $request){
        $data = PublicTrxProposal::select(
                    'trx_proposal_id',
                    'trx_proposal.trx_pemohon_id',
                    'pemohon.pemohon_nm',
                    'trx_proposal.trx_mitra_kemaslahatan_id',
                    'mitra.mitra_kemaslahatan_nm',
                    'trx_proposal.created_at as tanggal_pengajuan',
                    'judul_proposal',
                    'ruang_lingkup',
                    'ruang_lingkup_tp.code_nm as ruang_lingkup_nm',
                    'nominal',
                    'proposal_file_nm',
                    'proses_st'
                )
                ->join('public.trx_pemohon as pemohon','pemohon.trx_pemohon_id','trx_proposal.trx_pemohon_id')
                ->leftJoin('public.trx_mitra_kemaslahatan as mitra','mitra.trx_mitra_kemaslahatan_id','trx_proposal.trx_mitra_kemaslahatan_id')
                ->leftJoin('public.com_code as ruang_lingkup_tp','ruang_lingkup_tp.com_cd','trx_proposal.ruang_lingkup')
                ->where(function($query){
                    if (isRoleUser('pemohon')) {
                        $query->where('trx_proposal.trx_pemohon_id',Auth::user()->default_key);
                    }

                    if (isRoleUser('mitra')) {
                        $query->where('trx_proposal.trx_mitra_kemaslahatan_id',Auth::user()->default_key);
                    }
                });

        return DataTables::of($data)
            ->addColumn('proses_st_nm', function($data){
                return "<span class='badge badge-info d-block'>".comCodeName($data->proses_st)."</span>";

            })
            ->addColumn('actions', function($data){
                $actions = '';
                switch ($data->proses_st) {
                    case 'PROSES_10':
                        if (isRoleUser('regas')) {
                            if ($data->proposal_file_nm) {
                                $actions .= "<button type='button' class='proposal-file btn btn-danger btn-flat btn-sm' data-toggle='tooltip' data-placement='top' title='File Proposal'><i class='icon icon-download'></i> </button> &nbsp";
                            }
                            $actions .= "<button type='button' class='approve btn btn-info btn-flat btn-sm' data-toggle='tooltip' data-placement='top' title='Setujui Proposal'><i class='icon icon-check'></i> Setujui Proposal</button> &nbsp";
                        }
                        break;
                    case 'PROSES_15':
                        if (isRoleUser('pemohon')) {
                            $actions .= "<button type='button' class='lengkapi-proposal btn btn-info btn-flat btn-sm' data-toggle='tooltip' data-placement='top' title='Lengkapi Proposal'><i class='icon icon-pencil7'></i> Lengkapi Proposal</button> &nbsp";
                        }
                        break;
                    default:
                        # code...
                        break;
                }

                return $actions;
            })
            ->rawColumns(['proses_st_nm','actions'])
            ->make(true);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    function store(Request $request, $id){
        // dd($request->all());
        try {
            $fileName = 'NULL';

            $this->validate($request,[
                'approval_status'   => 'required',
                'approval_note'     => 'nullable',
                'file_asesmen'      => 'nullable',
            ]);

            DB::beginTransaction();

            $proposal               = PublicTrxProposal::find($id);
            $oldData = $proposal;
            
            $lastStatus = PublicTrxProposalTimeline::getLastStatus($proposal->trx_proposal_id);
            $status     = PublicTrxProsesStatus::getStatus($id);

            if (in_array($request->approval_status,['11','13'])) {
                $proposal->sent_st    = "0";
            }

            if ("PROSES_".$request->approval_status == 'PROSES_11') {
                $proposal->sent_st    = "0";
            }
            
            if ("PROSES_".$request->approval_status == 'PROSES_07') {
                $proposal->nominal_rekomendasi         = uang($request->nominal_rekomendasi);

                $tanggalAsessment = explode('-', $request->assesment_mitra);

                $proposal->mitra_asessmen_date_start    = formatDate($tanggalAsessment[0]);
                $proposal->mitra_asessmen_date_end      = formatDate($tanggalAsessment[1]);

                $proposal->trx_mitra_kemaslahatan_id    = $request->trx_mitra_kemaslahatan_id;
            }

            if ("PROSES_".$request->approval_status == 'PROSES_53A') {
                $proposal->nominal_realisasi = uang($request->nominal_realisasi);
                $proposal->nominal_efisiensi = uang($request->nominal_efisiensi);
            }

            $proposal->proses_st    = "PROSES_".$request->approval_status;
            $proposal->note         = $request->approval_note;
            $proposal->updated_by   = Auth::user()->user_id;
            $proposal->save();
            
            if($request->hasFile('file_asesmen')) {
                $file       = $request->file('file_asesmen');
                $fileName   = Uuid::uuid4().".".$file->getClientOriginalExtension();
                $file->move(storage_path('app/public/asesmen-file/'), $fileName);
            }else{
                $fileName   = NULL;
            }

            $updateTimeline                 = PublicTrxProposalTimeline::find($lastStatus->trx_proposal_timeline_id);
            $updateTimeline->file_asesmen   = $fileName;
            $updateTimeline->timeline_by    = Auth::user()->user_nm;
            $updateTimeline->note           = $request->approval_note;
            $updateTimeline->updated_by     = Auth::user()->user_id;
            $updateTimeline->save();

            $newTimeline                   = new PublicTrxProposalTimeline;
            $newTimeline->trx_proposal_id  = $proposal->trx_proposal_id;
            $newTimeline->timeline_by      = Auth::user()->user_nm;
            $newTimeline->status           = $proposal->proses_st;
            $newTimeline->created_by       = Auth::user()->user_id;
            $newTimeline->save();

            // BPKH INTERNAL - Kirim email jika user role pelmonev
            if($proposal->proses_st === 'PROSES_62' || $proposal->proses_st === 'PROSES_63'){
                $status     = PublicTrxProsesStatus::where('trx_proses_status_id', $proposal->proses_st)->first();

                $dataUser = DB::table('auth.users as user')
                ->select('user_nm', 'email')
                ->join('auth.role_users as ru','ru.user_id', 'user.user_id')
                ->join('auth.roles as role','role.role_cd', 'ru.role_cd')
                ->where('role.role_cd', 'pelmonev')
                ->get();

                foreach($dataUser as $itemUser){
                    Mail::to($itemUser->email)->send(new NotifSent('emails.notif',  [
                        'nama' => $itemUser->user_nm,
                        'judulProposal' => $proposal->judul_proposal,
                        'prosesStatus' => $status->proses_nm ?? '-'
                    ]));
                }
            }

            // PublicTrxProposalTimeline::insertTimeline($proposal->trx_proposal_id, Auth::user()->user_id, $proposal->proses_st, $request->approval_note, $fileName);

            DB::commit();

            \LogActivity::saveLog(
                $logTp      = 'update',
                $logNm      = "Approval Proposal By $proposal->updated_by",
                $table      = $proposal->getTable(),
                $newData    = $proposal,
                $oldData    = $oldData
            );

            return response()->json(['status' => 'ok'],200);

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    function send(Request $request, $id){
        try {
            DB::beginTransaction();

            $status     = PublicTrxProsesStatus::getStatus($id);
            
            $proposal               = PublicTrxProposal::find($id);
            $oldData = $proposal;

            $lastStatus = PublicTrxProposalTimeline::getLastStatus($proposal->trx_proposal_id);

            $proposal->sent_st    = "1";
            $proposal->updated_by = Auth::user()->user_id;
            $proposal->save();

            $updateTimeline                 = PublicTrxProposalTimeline::find($lastStatus->trx_proposal_timeline_id);
            $updateTimeline->file_asesmen   = $fileName;
            $updateTimeline->timeline_by      = Auth::user()->user_id;
            $updateTimeline->note           = $request->approval_note;
            $updateTimeline->updated_by     = Auth::user()->user_id;
            $updateTimeline->save();

            $newTimeline                   = new PublicTrxProposalTimeline;
            $newTimeline->trx_proposal_id  = $proposal->trx_proposal_id;
            $newTimeline->timeline_by      = Auth::user()->user_id;
            $newTimeline->status           = $proposal->proses_st;
            $newTimeline->created_by       = Auth::user()->user_id;
            $newTimeline->save();

            DB::commit();

            \LogActivity::saveLog(
                $logTp      = 'update',
                $logNm      = "Send Proposal By $proposal->updated_by",
                $table      = $proposal->getTable(),
                $newData    = $proposal,
                $oldData    = $oldData
            );

            return response()->json(['status' => 'ok'],200);

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }
}
