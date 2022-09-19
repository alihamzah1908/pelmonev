<?php

namespace Modules\Proposal\Http\Controllers\AnalisisHk;

use DB;
use Auth;
use DataTables;

use App\Models\ComBank;
use App\Models\AuthUser;
use App\Models\PublicTrxPemohon;
use App\Models\PublicTrxProposal;
use App\Models\PublicTrxProposalTimeline;
use App\Models\PublicTrxMitraKemaslahatan;
use App\Models\PublicTrxProposalLayakTeknis;
use App\Models\PublicTrxProposalAnalisisHk;
use App\Models\PublicTrxProposalAnalisisHkVerif;
use App\Models\PublicTrxProsesStatus;

use App\Models\ComCode;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnalisisHkController extends Controller
{
    private $folder_path = 'analisis-hk';
    
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
            $proposal       = PublicTrxProposal::join('trx_proses_status','trx_proses_status.trx_proses_status_id','trx_proposal.proses_st')
                            ->leftJoin('public.trx_mitra_kemaslahatan','trx_mitra_kemaslahatan.trx_mitra_kemaslahatan_id','trx_proposal.trx_mitra_kemaslahatan_id')
                            ->leftJoin('public.trx_mitra_strategis','trx_mitra_strategis.trx_mitra_strategis_id','trx_proposal.trx_mitra_strategis_id')
                            ->find($id);
            $pemohon        = PublicTrxPemohon::find($proposal->trx_pemohon_id);
            $userPemohon    = AuthUser::where('default_key',$proposal->trx_pemohon_id)->first();
            $banks          = ComBank::all();
            $disposisi      = PublicTrxProposalTimeline::join('trx_proses_status','trx_proses_status.trx_proses_status_id','trx_proposal_timeline.status')->where('trx_proposal_id',$id)
                                ->select(
                                    "trx_proposal_timeline_id",
                                    "trx_proposal_id",
                                    "timeline_by",
                                    "status",
                                    "file_asesmen",
                                    "note",
                                    "trx_proposal_timeline.created_at",
                                    "trx_proses_status_id",
                                    "proses_nm",
                                    "proses_next_yes",
                                    "proses_next_no",
                                    "proses_form_title",
                                    "proses_btn_yes_title",
                                    "proses_btn_no_title",
                                    "proses_file_nm",
                                    "proses_roles"
                                )->orderBy('trx_proposal_timeline.created_at', 'DESC')->get();
            $lastStatus     = PublicTrxProposalTimeline::getLastStatus($id);
            $status         = PublicTrxProsesStatus::getStatus($id);
            $analisisHk     = PublicTrxProposalAnalisisHk::where('trx_proposal_id', $id)->first();
            $analisisHkVerif    = PublicTrxProposalAnalisisHkVerif::where('trx_proposal_id', $id)->get();

            // dd($lastStatus);
            \LogActivity::saveLog(
                $logTp = 'visit', 
                $logNm = "Membuka Menu $title $id"
            );

            return view('proposal::' . $this->folder_path . '.' . $filename_page, compact('title', 'proposal', 'pemohon','userPemohon','banks','disposisi','lastStatus', 'status','analisisHk', 'analisisHkVerif'));
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
            DB::Raw("coalesce(pemohon.pemohon_nm, pemohon_mitra.mitra_kemaslahatan_nm) as pemohon_nm"),
            'trx_proposal.trx_mitra_kemaslahatan_id',
            'mitra.mitra_kemaslahatan_nm',
            'trx_proposal.created_at as tanggal_pengajuan',
            'judul_proposal',
            'ruang_lingkup',
            'ruang_lingkup_tp.code_nm as ruang_lingkup_nm',
            'nominal',
            'proses_st',
            'status.proses_nm'
        )
        ->leftJoin('public.trx_pemohon as pemohon','pemohon.trx_pemohon_id','trx_proposal.trx_pemohon_id')
        ->leftJoin('public.trx_mitra_kemaslahatan as pemohon_mitra','pemohon_mitra.trx_mitra_kemaslahatan_id','trx_proposal.trx_pemohon_id')
        ->join('public.trx_proses_status as status','status.trx_proses_status_id','trx_proposal.proses_st')
        ->leftJoin('public.trx_mitra_kemaslahatan as mitra','mitra.trx_mitra_kemaslahatan_id','trx_proposal.trx_mitra_kemaslahatan_id')
        ->leftJoin('public.com_code as ruang_lingkup_tp','ruang_lingkup_tp.com_cd','trx_proposal.ruang_lingkup')
        ->where(function($query) use($request){
            if (isRoleUser('pemohon')) {
                $query->where('trx_proposal.trx_pemohon_id',Auth::user()->default_key);
            }

            if (isRoleUser('mitra')) {
                $query->where('trx_proposal.trx_mitra_kemaslahatan_id',Auth::user()->default_key);
            }

            $query->whereIn('proses_st', [
                'PROSES_18B',
                'PROSES_19'
            ]);

            if ($request->judul != '') {
                $query->where("judul_proposal", "ILIKE" ,'%'.$request->judul.'%');
            }
        });

        return DataTables::of($data)
            ->addColumn('proses_st_nm', function($data){
                return "<span class='badge badge-info d-block'>".substr($data->proses_st,7,strlen($data->proses_st)).' - '.$data->proses_nm."</span>";
            })  
            ->addColumn('order_column', function($data){
                if (!empty(PublicTrxProsesStatus::getStatus($data->trx_proposal_id))) {
                    return (int)1;
                }else{
                    return (int)0;
                }
            })
            ->addColumn('actions', function($data){
                $actions = '';
                if (!empty(PublicTrxProsesStatus::getStatus($data->trx_proposal_id))) {
                    // $actions .= "<button type='button' class='proposal-file btn btn-danger btn-flat btn-sm' data-toggle='tooltip' data-placement='top' title='File Proposal'><i class='icon icon-download'></i> </button> &nbsp";
                    // $actions .= "<button type='button' class='approve btn btn-info btn-flat btn-sm' data-toggle='tooltip' data-placement='top' title='Disposisi Proposal'><i class='icon icon-check'></i> </button> &nbsp";
                    $actions .= "<button type='button' class='lengkapi-proposal btn btn-info btn-flat btn-sm' data-toggle='tooltip' data-placement='top' title='Detail Proposal'><i class='icon icon-enlarge'></i> Detail Proposal</button> &nbsp";
                }else{
                    $actions .= "<button type='button' class='lengkapi-proposal btn btn-warning btn-flat btn-sm' data-toggle='tooltip' data-placement='top' title='Detail Proposal'><i class='icon icon-enlarge'></i> Detail Proposal</button> &nbsp";
                }
    
                return $actions;
            })
            ->rawColumns(['proses_st_nm','actions'])
            ->addIndexColumn()
            ->make(true);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    function store(Request $request){
	//dd($request->all());
        try {
            DB::beginTransaction();
		
	    if(request()->childid){
            	$check = PublicTrxProposalAnalisisHk::where('trx_proposal_id', request()->childid)->first();
	    }else{
		$check = PublicTrxProposalAnalisisHk::where('trx_proposal_id', $request->id)->first();
	    }
            if ($check) {
                $analisis               = PublicTrxProposalAnalisisHk::find($check->trx_proposal_analisis_hk_id);
                $analisis->updated_by   = Auth::user()->user_id;
            }else{
                $analisis                   = new PublicTrxProposalAnalisisHk;
                $analisis->trx_proposal_id  = request()->childid ? request()->childid : $request->id;
                $analisis->created_by       = Auth::user()->user_id;
            }
            $analisis->analisa_legalitas    = $request->analisa_legalitas;
            $analisis->analisa_peraturan    = $request->analisa_peraturan;
            $analisis->analisa_hukum        = $request->analisa_hukum;
            $analisis->kesimpulan           = $request->kesimpulan;
            $analisis->rekomendasi          = $request->rekomendasi;
            $analisis->save();  
            DB::commit();

            \LogActivity::saveLog(
                $logTp      = 'create', 
                $logNm      = "Membuat Data Analisis HK Proposal $request->id", 
                $table      = $analisis->getTable(), 
                $newData    = $analisis
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    function storeVerif(Request $request){
        try {
            DB::beginTransaction();
            foreach ($request->record as $item) {
                $newItem = (object)$item;
                $check = PublicTrxProposalAnalisisHkVerif::where('trx_proposal_id', $request->id)->where('verif_id', $newItem->verif_id)->first();
                
                if ($check) {
                    $verifikasi               = PublicTrxProposalAnalisisHkVerif::find($check->trx_proposal_analisis_hk_verif_id);
                    $verifikasi->updated_by   = Auth::user()->user_id;
                }else{
                    $verifikasi                   = new PublicTrxProposalAnalisisHkVerif;
                    $verifikasi->trx_proposal_id  = $request->id;
                    $verifikasi->created_by       = Auth::user()->user_id;
                }

                $verifikasi->verif_id       = $newItem->verif_id;
                $verifikasi->verif_value    = $newItem->verif_value;
                $verifikasi->verif_note     = $newItem->verif_note;
                $verifikasi->save();  
            }

            DB::commit();

            \LogActivity::saveLog(
                $logTp      = 'create', 
                $logNm      = "Membuat Data Analisis HK Proposal $request->id", 
                $table      = $verifikasi->getTable(), 
                $newData    = $verifikasi
            );

            return response()->json(['status' => 'ok'],200); 

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }
}
