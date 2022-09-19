<?php

namespace Modules\Proposal\Http\Controllers\ProposalPenilaian;

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
use App\Models\PublicTrxProposalPenilaian;
use App\Models\PublicTrxProsesStatus;

use App\Models\ComCode;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProposalPenilaianController extends Controller
{
    private $folder_path = 'proposal-penilaian';
    
    function __construct(){
        $this->middleware('auth');
    }

    /**
     * Index
     *
     * @return \Illuminate\Http\Response
     */
    function index($id = NULL){
        // $currUserData = AuthUser::mGetDetailUser(Auth::user()->user_id)->first();
        // dump($currUserData);
        
        if ($id) {
            $filename_page 	= 'detail';
            $title 			= 'Penilaian Kegiatan Kemaslahatan Berbasis Risiko';
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
            // dd($lastStatus);
            \LogActivity::saveLog(
                $logTp = 'visit', 
                $logNm = "Membuka Menu $title $id"
            );

            return view('proposal::' . $this->folder_path . '.' . $filename_page, compact('title', 'proposal', 'pemohon','userPemohon','banks','disposisi','lastStatus', 'status'));
        }else{
            $filename_page 	= 'index';
            $title 			= 'Penilaian Kegiatan Kemaslahatan Berbasis Risiko';
            
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

        $currUserData = AuthUser::mGetDetailUser(Auth::user()->user_id)->first();

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
        ->where(function($query) use ($request){
            if (isRoleUser('pemohon')) {
                $query->where('trx_proposal.trx_pemohon_id',Auth::user()->default_key);
            }

            if (isRoleUser('mitra')) {
                $query->where('trx_proposal.trx_mitra_kemaslahatan_id',Auth::user()->default_key);
            }

            if ($request->proses != 'SEMUA') {
                $query->where('proses_st', $request->proses);
            }

            if ($request->judul != '') {
                $query->where("judul_proposal", "ILIKE" ,'%'.$request->judul.'%');
            }
        });

        return DataTables::of($data)
            ->addColumn('proses_st_nm', function($data){
                return "<span class='badge badge-info'>".substr($data->proses_st,7,strlen($data->proses_st)).' - '.$data->proses_nm."</span>";  
            })
            ->addColumn('trx_proposal_id', function($data){
                return "<a href='".url('proposal-penilaian')."/".$data->trx_proposal_id."'>".$data->trx_proposal_id."</a>";  //".url('proposal-penilaian')."/".$data->trx_proposal_id."
            })
            ->addColumn('order_column', function($data){
                if (!empty(PublicTrxProsesStatus::getStatus($data->trx_proposal_id))) {
                    return (int)1;
                }else{
                    return (int)0;
                }
            })  
            ->addColumn('actions', function($data) use($currUserData){
                $actions = '';
                if (!empty(PublicTrxProsesStatus::getStatus($data->trx_proposal_id))) {
                    // $actions .= "<button type='button' class='proposal-file btn btn-danger btn-flat btn-sm' data-toggle='tooltip' data-placement='top' title='File Proposal'><i class='icon icon-download'></i> </button> &nbsp";
                    // $actions .= "<button type='button' class='approve btn btn-info btn-flat btn-sm' data-toggle='tooltip' data-placement='top' title='Disposisi Proposal'><i class='icon icon-check'></i> </button> &nbsp";
                    // $actions .= "<button type='button' class='lengkapi-proposal btn btn-info btn-flat btn-sm mb-2' data-toggle='tooltip' data-placement='top' title='Detail Proposal'><i class='icon icon-enlarge'></i> Detail Proposal</button>";
                    if(strtolower($currUserData->jabatan_name) === 'pimpinan'){
                        $actions .= "<div class='d-flex'><button type='button' class='terima-proposal btn btn-info btn-flat btn-sm mr-2' data-toggle='modal' data-target='#terimaProposalModal'><i class='icon icon-check'></i> Terima</button>";
                    }else if(strtolower($currUserData->jabatan_name) === 'pic'){
                        $actions .= "<div class='d-flex'><a href='#' class='ajukan-proposal btn btn-info btn-flat btn-sm mr-2'><i class='icon icon-forward'></i> Ajukan</button>";
                    }else{
                        // nothing
                    }
                    $actions .= "<button type='button' class='tolak-proposal btn btn-danger btn-flat btn-sm' data-toggle='modal' data-target='#tolakProposalModal'><i class='icon icon-cross'></i> Tolak</button></div>";
                }else{
                    $actions .= "<button type='button' class='lengkapi-proposal btn btn-warning btn-flat btn-sm' data-toggle='tooltip' data-placement='top' title='Detail Proposal'><i class='icon icon-enlarge'></i> Detail Proposal</button> &nbsp";
                }
    
                return $actions;
            })
            ->rawColumns(['proses_st_nm','actions', 'trx_proposal_id'])
            ->addIndexColumn()
            ->make(true);
    }

}
