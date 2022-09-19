<?php

namespace Modules\Proposal\Http\Controllers;

use DB;
use Auth;
use DataTables;

use App\Models\ComBank;
use App\Models\AuthUser;
use App\Models\PublicTrxPemohon;
use App\Models\PublicTrxProposal;
use App\Models\PublicTrxProposalTimeline;
use App\Models\PublicTrxProsesStatus;
use App\Models\PublicTrxMitraKemaslahatan;
use App\Models\PublicTrxProposalPejabatRekomendasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProposalHasilAssesmenController extends Controller
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
        $baseUrl            = 'proposal-hasil-assesmen';
        
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
            $lastStatus         = PublicTrxProposalTimeline::getLastStatus($id);
            $status             = PublicTrxProsesStatus::getStatus($id);
            $rekomendasiPejabat = PublicTrxProposalPejabatRekomendasi::where('trx_proposal_id', $id)->first();

            // dd($rekomendasiPejabat);
            \LogActivity::saveLog(
                $logTp = 'visit', 
                $logNm = "Membuka Menu $title $id"
            );

            return view('proposal::' . $this->folder_path . '.' . $filename_page, compact('title', 'proposal', 'pemohon','userPemohon','banks','disposisi','lastStatus', 'status','rekomendasiPejabat','baseUrl'));
        }else{
            $filename_page 	= 'index';
            $title 			= 'Proposal';
            
            \LogActivity::saveLog(
                $logTp = 'visit', 
                $logNm = "Membuka Menu $title"
            );

            return view('proposal::' . $this->folder_path . '.' . $filename_page, compact('title', 'baseUrl'));
        }
    }

    /**
     * Show : DataTables
     *
     * @return \Illuminate\Http\Response
     */
    function getData(Request $request){
        // return $request->all();
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
                    $query->whereIn('proses_st', [
                        'PROSES_10',
                        'PROSES_11',
                        'PROSES_12'
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
}
