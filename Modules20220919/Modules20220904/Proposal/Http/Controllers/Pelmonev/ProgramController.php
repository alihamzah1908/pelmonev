<?php

namespace Modules\Proposal\Http\Controllers\Pelmonev;

use DB;
use PDF;
use Auth;
use DataTables;

use App\Models\ComBank;
use App\Models\AuthUser;
use App\Models\PublicTrxPemohon;
use App\Models\PublicTrxProposal;
use App\Models\PublicTrxProposalMitra;
use App\Models\PublicTrxProposalTimeline;
use App\Models\PublicTrxProsesStatus;
use App\Models\PublicTrxMitraKemaslahatan;
use App\Models\PublicTrxProposalPejabatRekomendasi;
use App\Models\PublicTrxKuotaProposal;
use App\Models\PublicTrxProposalPenilaianMitra;
use App\Models\PublicTrxProposalAnalisKepatuhan;
use App\Models\KlasifikasiProposal;
use App\Models\PublicTrxProposalAnalisisResiko;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ComCode;
use App\Models\PublicTrxMitraStrategis1;
use App\Models\PublicTrxAssessmentMk;
use App\Models\PublicTrxMitraStrategis;
use App\Models\PublicTrxProposalFiles;
use App\Models\PublicTrxProposalLayakTeknis;
use App\Models\PublicTrxProposalLayakTeknisAnalisa;
use App\Models\PublicTrxProposalLayakTeknisDeskripsi;
use App\Models\PublicTrxProposalLayakTeknisPelaksanaanPenilaian;
use App\Models\PublicTrxProposalPenilaian;
use App\Models\PublicTrxProposalScreaning1;
use App\Models\PublicTrxUjiKelayakan;
use App\Models\PublicTrxProposalAnalisisHk;
use App\Models\PublicTrxPks;
use Illuminate\Support\Facades\Route;
//use Request;
// use App\Traits\Uuid;

use Ramsey\Uuid\Uuid;

class ProgramController extends Controller
{

    private $folder_path = '';
    var $statusScreaning = ['PROSES_TR', 'PROSES_SKG', 'PROSES_SDK', 'PROSES_SABP'];
    var $statusDisposisi = ['PROSES_KBP', 'PROSES_ABP', 'PROSES_DK', 'PROSES_KR'];
    var $statusAnalisa   = ['PROSES_AR', 'PROSES_AKR', 'PROSES_ADK', 'PROSES_AABP'];
    var $statusMR        = ['PROSES_AMR_01', 'PROSES_AMR_02', 'PROSES_AMR_03', 'PROSES_AMR_04'];
    var $statusHK        = ['PROSES_HK_01', 'PROSES_HK_02', 'PROSES_HK_03', 'PROSES_HK_04', 'PROSES_HK_05', 'PROSES_HK_06'];
    var $statusPelmonev  = ['PROSES_TERIMA', 'PROSES_PENCAIRAN', 'PROSES_PERIKATAN'];

    function __construct()
    {
        $this->middleware('auth');
    }

    function index($id = NULL, Request $request)
    {
        $baseUrl = 'proposal';
        $currUserData = AuthUser::mGetDetailUser(Auth::user()->user_id)->first();
        if ($id) {
            $title             = 'Detail Pelmonev Program';
            $proposal       = PublicTrxProposal::join('trx_proses_status', 'trx_proses_status.trx_proses_status_id', 'trx_proposal.proses_st')
                ->leftJoin('public.trx_mitra_strategis', 'trx_mitra_strategis.trx_mitra_strategis_id', 'trx_proposal.trx_mitra_strategis_id')
                ->find($id);
            // dd($proposal);
            $pemohon        = PublicTrxPemohon::find($proposal->trx_pemohon_id);
            $userPemohon    = AuthUser::where('default_key', $proposal->trx_pemohon_id)->first();
            $banks          = ComBank::all();
            $disposisi      = PublicTrxProposalTimeline::join('trx_proses_status', 'trx_proses_status.trx_proses_status_id', 'trx_proposal_timeline.status')->where('trx_proposal_id', $id)
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
            $lastScreaning      = PublicTrxProposalScreaning1::getLastStatus($id);
            $lastPejabat        = PublicTrxProposalPejabatRekomendasi::getLastStatus($id);
            $status             = PublicTrxProsesStatus::getStatus($id);
            $rekomendasiPejabat = PublicTrxProposalPejabatRekomendasi::where('trx_proposal_id', $id)->first();
            // dd($pemohon);
            \LogActivity::saveLog(
                $logTp = 'visit',
                $logNm = "Membuka Menu $title $id"
            );

            if ($proposal->type_proposal == 1) {
                $filename_page     = 'detail-short';
                return view('proposal::' . $this->folder_path . '.' . $filename_page, compact('title', 'proposal', 'pemohon', 'userPemohon', 'banks', 'disposisi', 'lastStatus', 'status', 'rekomendasiPejabat', 'baseUrl', 'lastScreaning'));
            } else {
                $filename_page     = 'detail';
                return view('proposal::' . $this->folder_path . '.' . $filename_page, compact('title', 'proposal', 'pemohon', 'userPemohon', 'banks', 'disposisi', 'lastStatus', 'lastPejabat', 'lastScreaning', 'status', 'rekomendasiPejabat', 'baseUrl'));
            }
        } else {
            $filename_page     = 'pelmonev.program.index';
            $title             = 'Program Pelmonev';
            \LogActivity::saveLog(
                $logTp = 'visit',
                $logNm = "Membuka Menu $title"
            );

            return view('proposal::' . $this->folder_path . '.' . $filename_page, compact('title', 'baseUrl'));
        }
    }

    public function pencairanindex()
    {
        $baseUrl = 'proposal';
        $filename_page     = 'pelmonev.program.pencairanindex';
        $title             = 'Program Pencairan Pelmonev';
        \LogActivity::saveLog(
            $logTp = 'visit',
            $logNm = "Membuka Menu $title"
        );

        return view('proposal::' . $this->folder_path . '.' . $filename_page, compact('title', 'baseUrl'));
    }

    public function perikatanindex()
    {
        $baseUrl = 'proposal';
        $filename_page     = 'pelmonev.program.perikatanindex';
        $title             = 'Program Perikatan Pelmonev';
        \LogActivity::saveLog(
            $logTp = 'visit',
            $logNm = "Membuka Menu $title"
        );

        return view('proposal::' . $this->folder_path . '.' . $filename_page, compact('title', 'baseUrl'));
    }

    public function data_program(Request $request)
    {
        $currUserData = AuthUser::mGetDetailUser(Auth::user()->user_id)->first();
        $data = PublicTrxProposalMitra::select(
            'trx_proposal_mitra_id',
            'trx_proposal_child_id',
            'trx_proposal_mitra.trx_pemohon_id',
            DB::Raw("coalesce(pemohon.pemohon_nm, pemohon_mitra.mitra_kemaslahatan_nm) as pemohon_nm"),
            'trx_proposal_mitra.trx_mitra_kemaslahatan_id',
            'mitra.mitra_kemaslahatan_nm',
            'trx_proposal_mitra.created_at as tanggal_pengajuan',
            'judul_proposal',
            'trx_proposal_mitra.proposal_no',
            'trx_proposal_mitra.ruang_lingkup_child',
            'trx_proposal_mitra.uraian_singkat_proposal',
            'trx_proposal_mitra.region_prop',
            'trx_proposal_mitra.region_kab',
            'trx_proposal_mitra.region_kec',
            'trx_proposal_mitra.region_kel',
            'ruang_lingkup',
            'ruang_lingkup_tp.code_nm as ruang_lingkup_nm',
            'nominal',
            'proses_st',
            'status.proses_nm',
            'status.proses_jabatan'
        )
            ->leftJoin('public.trx_pemohon as pemohon', 'pemohon.trx_pemohon_id', 'trx_proposal_mitra.trx_pemohon_id')
            ->leftJoin('public.trx_mitra_kemaslahatan as pemohon_mitra', 'pemohon_mitra.trx_mitra_kemaslahatan_id', 'trx_proposal_mitra.trx_pemohon_id')
            ->join('public.trx_proses_status as status', 'status.trx_proses_status_id', 'trx_proposal_mitra.proses_st')
            ->leftJoin('public.trx_mitra_kemaslahatan as mitra', 'mitra.trx_mitra_kemaslahatan_id', 'trx_proposal_mitra.trx_mitra_kemaslahatan_id')
            ->leftJoin('public.com_code as ruang_lingkup_tp', 'ruang_lingkup_tp.com_cd', 'trx_proposal_mitra.ruang_lingkup_child')
            ->where('trx_proposal_mitra.proses_st', 'PROSES_TERIMA')
            // ->whereJsonContains(
            //     DB::raw('"proses_jabatan"::json'),
            //     [$currUserData->jabatan_id]
            // )
            ->orderBy('trx_proposal_mitra.created_at', 'DESC');
        // ->whereIn('trx_proposal_mitra.proses_st', ['PROSES_AR', 'PROSES_AKR', 'PROSES_ADR', 'PROSES_AABP']);
        return DataTables::of($data)
            ->addColumn('trx_proposal_id', function ($data) {
                return $data->proposal_no;  //".url('proposal-penilaian')."/".$data->trx_proposal_id."
            })
            ->addColumn('trx_proposal_uid', function ($data) {
                return $data->trx_proposal_mitra_id;
            })
            ->addColumn('proses_st_nm', function ($data) {
                return "<span class='badge badge-info d-block'>" . substr($data->proses_st, 7, strlen($data->proses_st)) . ' - ' . $data->proses_nm . "</span>";
            })
            ->addColumn('nominal', function ($data) {
                $id = $data->trx_proposal_child_id != '' ? $data->trx_proposal_child_id : $data->trx_proposal_mitra_id;
                $total = \App\Models\PublicTrxProposalRAB::select(DB::raw('sum(total_bpkh) as nominal_rekomendasi'))->where('trx_proposal_id', $data->trx_proposal_child_id)->first();
                return $total->nominal_rekomendasi;
            })
            ->addColumn('ruang_lingkup_nm', function ($data) {
                if ($data->ruang_lingkup == "RUANG_LINGKUP_1") {
                    return 'Reguler - ' . $data->ruang_lingkup_nm;
                } else {
                    return 'Tanggap Darurat - ' . $data->ruang_lingkup_nm;
                }
            })
            ->addColumn('order_column', function ($data) {
                return "ok";
            })
            ->addColumn('actions', function ($data) {
                $actions = '';
                if ($data->proses_st == 'PROSES_TERIMA') {
                    $button =  '<button id="disposisi-program" class="btn btn-sm btn-primary mx-1 px-2" data-status=' . $data->proses_st . ' data-id=' . $data->trx_proposal_child_id . '>Disposisi</button>
                    <a href="' . url('proposal') . "/program/task-program/" . $data->trx_proposal_child_id . '/show" class="btn btn-sm btn-info mx-1 px-2"><i class="icon icon-search4"></i></a>';
                } elseif ($data->proses_st == 'PROSES_PENCAIRAN') {
                    $button =  '<a href="' . url('proposal') . "/program/task-program/" . $data->trx_proposal_child_id . '/show" class="btn btn-sm btn-info mx-1 px-2"><i class="icon icon-search4"></i></a>';
                }

                $actions .= '<div class="d-flex justify-content-center">
			    ' . $button . '
			     </div>';
                return $actions;
            })
            ->rawColumns(['proses_st_nm', 'actions', 'trx_proposal_id'])
            ->addIndexColumn()
            ->make(true);
    }


    public function data_pencairanperikatan(Request $request)
    {
        $currUserData = AuthUser::mGetDetailUser(Auth::user()->user_id)->first();
        $data = PublicTrxProposalMitra::select(
            'trx_proposal_mitra_id',
            'trx_proposal_child_id',
            'trx_proposal_mitra.trx_pemohon_id',
            DB::Raw("coalesce(pemohon.pemohon_nm, pemohon_mitra.mitra_kemaslahatan_nm) as pemohon_nm"),
            'trx_proposal_mitra.trx_mitra_kemaslahatan_id',
            'mitra.mitra_kemaslahatan_nm',
            'trx_proposal_mitra.created_at as tanggal_pengajuan',
            'judul_proposal',
            'trx_proposal_mitra.proposal_no',
            'trx_proposal_mitra.ruang_lingkup_child',
            'trx_proposal_mitra.uraian_singkat_proposal',
            'trx_proposal_mitra.region_prop',
            'trx_proposal_mitra.region_kab',
            'trx_proposal_mitra.region_kec',
            'trx_proposal_mitra.region_kel',
            'ruang_lingkup',
            'ruang_lingkup_tp.code_nm as ruang_lingkup_nm',
            'nominal',
            'proses_st',
            'status.proses_nm',
            'status.proses_jabatan'
        )
            ->leftJoin('public.trx_pemohon as pemohon', 'pemohon.trx_pemohon_id', 'trx_proposal_mitra.trx_pemohon_id')
            ->leftJoin('public.trx_mitra_kemaslahatan as pemohon_mitra', 'pemohon_mitra.trx_mitra_kemaslahatan_id', 'trx_proposal_mitra.trx_pemohon_id')
            ->join('public.trx_proses_status as status', 'status.trx_proses_status_id', 'trx_proposal_mitra.proses_st')
            ->leftJoin('public.trx_mitra_kemaslahatan as mitra', 'mitra.trx_mitra_kemaslahatan_id', 'trx_proposal_mitra.trx_mitra_kemaslahatan_id')
            ->leftJoin('public.com_code as ruang_lingkup_tp', 'ruang_lingkup_tp.com_cd', 'trx_proposal_mitra.ruang_lingkup_child')
            ->where('trx_proposal_mitra.proses_st', 'PROSES_PPP')
            // ->whereJsonContains(
            //     DB::raw('"proses_jabatan"::json'),
            //     [$currUserData->jabatan_id]
            // )
            ->orderBy('trx_proposal_mitra.created_at', 'DESC');
        // ->whereIn('trx_proposal_mitra.proses_st', ['PROSES_AR', 'PROSES_AKR', 'PROSES_ADR', 'PROSES_AABP']);
        if ($request["type"] == 'perikatan') {
            return DataTables::of($data)
                ->addColumn('trx_proposal_id', function ($data) {
                    return $data->proposal_no;  //".url('proposal-penilaian')."/".$data->trx_proposal_id."
                })
                ->addColumn('trx_proposal_uid', function ($data) {
                    return $data->trx_proposal_mitra_id;
                })
                ->addColumn('proses_st_nm', function ($data) {
                    return "<span class='badge badge-info d-block'>" . substr($data->proses_st, 7, strlen($data->proses_st)) . ' - ' . $data->proses_nm . "</span>";
                })
                ->addColumn('nominal', function ($data) {
                    $id = $data->trx_proposal_child_id != '' ? $data->trx_proposal_child_id : $data->trx_proposal_mitra_id;
                    $total = \App\Models\PublicTrxProposalRAB::select(DB::raw('sum(total_bpkh) as nominal_rekomendasi'))->where('trx_proposal_id', $data->trx_proposal_child_id)->first();
                    return $total->nominal_rekomendasi;
                })
                ->addColumn('ruang_lingkup_nm', function ($data) {
                    if ($data->ruang_lingkup == "RUANG_LINGKUP_1") {
                        return 'Reguler - ' . $data->ruang_lingkup_nm;
                    } else {
                        return 'Tanggap Darurat - ' . $data->ruang_lingkup_nm;
                    }
                })
                ->addColumn('order_column', function ($data) {
                    return "ok";
                })
                ->addColumn('actions', function ($data) {
                    $actions = '';
                    $button =  '<a href="' . url('proposal') . "/program/perikatan/" . $data->trx_proposal_child_id . '/show" class="btn btn-sm btn-info mx-1 px-2"><i class="icon icon-search4"></i></a>';
                    $actions .= '<div class="d-flex justify-content-center">
			    ' . $button . '
			     </div>';
                    return $actions;
                })
                ->rawColumns(['proses_st_nm', 'actions', 'trx_proposal_id'])
                ->addIndexColumn()
                ->make(true);
        } else if ($request["type"] == 'pencairan') {
            return DataTables::of($data)
                ->addColumn('trx_proposal_id', function ($data) {
                    return $data->proposal_no;  //".url('proposal-penilaian')."/".$data->trx_proposal_id."
                })
                ->addColumn('trx_proposal_uid', function ($data) {
                    return $data->trx_proposal_mitra_id;
                })
                ->addColumn('proses_st_nm', function ($data) {
                    return "<span class='badge badge-info d-block'>" . substr($data->proses_st, 7, strlen($data->proses_st)) . ' - ' . $data->proses_nm . "</span>";
                })
                ->addColumn('nominal', function ($data) {
                    $id = $data->trx_proposal_child_id != '' ? $data->trx_proposal_child_id : $data->trx_proposal_mitra_id;
                    $total = \App\Models\PublicTrxProposalRAB::select(DB::raw('sum(total_bpkh) as nominal_rekomendasi'))->where('trx_proposal_id', $data->trx_proposal_child_id)->first();
                    return $total->nominal_rekomendasi;
                })
                ->addColumn('ruang_lingkup_nm', function ($data) {
                    if ($data->ruang_lingkup == "RUANG_LINGKUP_1") {
                        return 'Reguler - ' . $data->ruang_lingkup_nm;
                    } else {
                        return 'Tanggap Darurat - ' . $data->ruang_lingkup_nm;
                    }
                })
                ->addColumn('order_column', function ($data) {
                    return "ok";
                })
                ->addColumn('actions', function ($data) {
                    $actions = '';
                    $button =  '<a href="' . url('proposal') . "/program/pencairan/" . $data->trx_proposal_child_id . '/show" class="btn btn-sm btn-info mx-1 px-2"><i class="icon icon-search4"></i></a>';
                    $actions .= '<div class="d-flex justify-content-center">
			    ' . $button . '
			     </div>';
                    return $actions;
                })
                ->rawColumns(['proses_st_nm', 'actions', 'trx_proposal_id'])
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function show($id, Request $request)
    {
        $baseUrl  = 'proposal';
        $proposal = PublicTrxProposal::join('trx_proses_status', 'trx_proses_status.trx_proses_status_id', 'trx_proposal.proses_st')
            ->leftJoin('public.trx_mitra_strategis', 'trx_mitra_strategis.trx_mitra_strategis_id', 'trx_proposal.trx_mitra_strategis_id')
            ->find($id);
        $proposalmitra = PublicTrxProposalMitra::
            // join('trx_proses_status', 'trx_proses_status.trx_proses_status_id', 'trx_proposal_mitra.proses_st')
            leftJoin('public.trx_mitra_strategis', 'trx_mitra_strategis.trx_mitra_strategis_id', 'trx_proposal_mitra.trx_mitra_strategis_id')
            ->leftJoin('public.com_code as ruang_lingkup_tp', 'ruang_lingkup_tp.com_cd', 'trx_proposal_mitra.ruang_lingkup_child')
            ->where('trx_proposal_child_id', $proposal->trx_proposal_id)->first();
        $penilaianMitra = PublicTrxProposalPenilaianMitra::where('trx_proposal_id', $proposalmitra->trx_proposal_child_id)->first();
        $analisKepatuhan = PublicTrxProposalAnalisKepatuhan::where('trx_proposal_id', $proposalmitra->trx_proposal_child_id)->first();
        $pemohon        = PublicTrxPemohon::find($proposal->trx_pemohon_id);
        $userPemohon    = AuthUser::where('default_key', $proposal->trx_pemohon_id)->first();
        $banks          = ComBank::all();
        $disposisi      = PublicTrxProposalTimeline::join('trx_proses_status', 'trx_proses_status.trx_proses_status_id', 'trx_proposal_timeline.status')->where('trx_proposal_id', $id)
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
        $lastScreaning      = PublicTrxProposalScreaning1::getLastStatus($id);
        $lastPejabat        = PublicTrxProposalPejabatRekomendasi::getLastStatus($id);
        $deskripsi      = PublicTrxProposalLayakTeknisDeskripsi::where('trx_proposal_id', $proposal->trx_proposal_id)->first();
        $pelaksanaanPenilaian = PublicTrxProposalLayakTeknisPelaksanaanPenilaian::where('trx_proposal_id', $proposal->trx_proposal_id)->first();
        $mitra  = PublicTrxMitraKemaslahatan::find($proposal->trx_mitra_kemaslahatan_id);
        $analisa = PublicTrxProposalLayakTeknisAnalisa::where('trx_proposal_id', $proposal->trx_proposal_id)->first();
        $analisisHk = PublicTrxProposalAnalisisHk::where('trx_proposal_id', $proposal->trx_proposal_id)->first();
        $status             = PublicTrxProsesStatus::getStatus($id);
        $rekomendasiPejabat = PublicTrxProposalPejabatRekomendasi::where('trx_proposal_id', $id)->first();
        $analisisResiko = PublicTrxProposalAnalisisResiko::where('trx_proposal_id', $proposal->trx_proposal_id)->first();
        $filename_page     = 'pelmonev.program.show';
        $title             = 'Pelmonev Program Detail';
        \LogActivity::saveLog(
            $logTp = 'visit',
            $logNm = "Membuka Menu $title"
        );
        return view('proposal::' . $this->folder_path . '.' . $filename_page, compact('status', 'title', 'analisKepatuhan', 'penilaianMitra', 'mitra', 'analisa', 'analisisHk', 'pelaksanaanPenilaian', 'deskripsi', 'proposal', 'pemohon', 'userPemohon', 'banks', 'disposisi', 'lastStatus', 'lastPejabat', 'lastScreaning', 'rekomendasiPejabat', 'baseUrl', 'proposalmitra', 'analisisResiko'));
    }

    public function detailPerikatan($id, Request $request)
    {
        $baseUrl  = 'proposal';
        $proposal = PublicTrxProposal::join('trx_proses_status', 'trx_proses_status.trx_proses_status_id', 'trx_proposal.proses_st')
            ->leftJoin('public.trx_mitra_strategis', 'trx_mitra_strategis.trx_mitra_strategis_id', 'trx_proposal.trx_mitra_strategis_id')
            ->find($id);
        $proposalmitra = PublicTrxProposalMitra::
            // join('trx_proses_status', 'trx_proses_status.trx_proses_status_id', 'trx_proposal_mitra.proses_st')
            leftJoin('public.trx_mitra_strategis', 'trx_mitra_strategis.trx_mitra_strategis_id', 'trx_proposal_mitra.trx_mitra_strategis_id')
            ->leftJoin('public.com_code as ruang_lingkup_tp', 'ruang_lingkup_tp.com_cd', 'trx_proposal_mitra.ruang_lingkup_child')
            ->where('trx_proposal_child_id', $proposal->trx_proposal_id)->first();
        $penilaianMitra = PublicTrxProposalPenilaianMitra::where('trx_proposal_id', $proposalmitra->trx_proposal_child_id)->first();
        $analisKepatuhan = PublicTrxProposalAnalisKepatuhan::where('trx_proposal_id', $proposalmitra->trx_proposal_child_id)->first();
        $pemohon        = PublicTrxPemohon::find($proposal->trx_pemohon_id);
        $userPemohon    = AuthUser::where('default_key', $proposal->trx_pemohon_id)->first();
        $banks          = ComBank::all();
        $disposisi      = PublicTrxProposalTimeline::join('trx_proses_status', 'trx_proses_status.trx_proses_status_id', 'trx_proposal_timeline.status')->where('trx_proposal_id', $id)
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
        $lastScreaning      = PublicTrxProposalScreaning1::getLastStatus($id);
        $lastPejabat        = PublicTrxProposalPejabatRekomendasi::getLastStatus($id);
        $deskripsi      = PublicTrxProposalLayakTeknisDeskripsi::where('trx_proposal_id', $proposal->trx_proposal_id)->first();
        $pelaksanaanPenilaian = PublicTrxProposalLayakTeknisPelaksanaanPenilaian::where('trx_proposal_id', $proposal->trx_proposal_id)->first();
        $mitra  = PublicTrxMitraKemaslahatan::find($proposal->trx_mitra_kemaslahatan_id);
        $analisa = PublicTrxProposalLayakTeknisAnalisa::where('trx_proposal_id', $proposal->trx_proposal_id)->first();
        $analisisHk = PublicTrxProposalAnalisisHk::where('trx_proposal_id', $proposal->trx_proposal_id)->first();
        $status             = PublicTrxProsesStatus::getStatus($id);
        $rekomendasiPejabat = PublicTrxProposalPejabatRekomendasi::where('trx_proposal_id', $id)->first();
        $analisisResiko = PublicTrxProposalAnalisisResiko::where('trx_proposal_id', $proposal->trx_proposal_id)->first();
        $trxpks = PublicTrxPks::where('trx_proposal_id', $proposalmitra->trx_proposal_child_id)->first();
        $filename_page     =   $request->segment(3) == 'perikatan' ? 'pelmonev.program.detail-perikatan' : 'pelmonev.program.detail-pencairan';
        $title             =   $request->segment(3) == 'perikatan' ? 'Pelmonev Perikatan Detail' : 'Pelmonev Pencairan Detail';
        \LogActivity::saveLog(
            $logTp = 'visit',
            $logNm = "Membuka Menu $title"
        );
	if($request->segment(3) == 'perikatan'){
	    return view('proposal::' . $this->folder_path . '.' . $filename_page, compact('trxpks', 'status', 'title', 'analisKepatuhan', 'penilaianMitra', 'mitra', 'analisa', 'analisisHk', 'pelaksanaanPenilaian', 'deskripsi', 'proposal', 'pemohon', 'userPemohon', 'banks', 'disposisi', 'lastStatus', 'lastPejabat', 'lastScreaning', 'rekomendasiPejabat', 'baseUrl', 'proposalmitra', 'analisisResiko'));
	}else if($request->segment(3) == 'pencairan'){
	    return view('proposal::' . $this->folder_path . '.' . $filename_page, compact('trxpks', 'status', 'title', 'analisKepatuhan', 'penilaianMitra', 'mitra', 'analisa', 'analisisHk', 'pelaksanaanPenilaian', 'deskripsi', 'proposal', 'pemohon', 'userPemohon', 'banks', 'disposisi', 'lastStatus', 'lastPejabat', 'lastScreaning', 'rekomendasiPejabat', 'baseUrl', 'proposalmitra', 'analisisResiko'));
        }
        
    }


    public function disposisi($id, Request $request)
    {
        $proposal = PublicTrxProposal::find($id);
        $proposalMitra = PublicTrxProposalMitra::where('trx_proposal_child_id', $id)->first();
        $proposalMitraUpdate = PublicTrxProposalMitra::find($proposalMitra->trx_proposal_mitra_id);
        if ($request["proses"] == 'PROSES_TERIMA') {
            $proposal->proses_st = 'PROSES_PPP';
            $proposalMitraUpdate->proses_st = 'PROSES_PPP';
        }
        $proposal->save();
        $proposalMitraUpdate->save();
        return response()->json(['status' => 'ok'], 200);
    }

    public function save_pks(Request $request)
    {
        if ($request["trx_pks_id"]) {
            $data = PublicTrxPks::find($request["trx_pks_id"]);
        } else {
            $data = new PublicTrxPks;
        }
        $data->trx_proposal_id = $request["trx_proposal_mitra_id"];
        $data->judul_program = $request["judul_proposal"];
        $data->tanggal_kegiatan = $request["tanggal_kegiatan"];
        $data->tanggal = $request["tanggal"];
        $data->no_pks_bpkh = $request["nomor_pks"];
        $data->no_pks_mitra = $request["nomor_pks_mitra"];
        $data->alamat_bpkh = $request["alamat_bpkh"];
        $data->kepala_bpk = $request["kepala_bpkh"];
        $data->sk_pengangkatan_kep_bpkh = $request["sk_peng_kep_bpkh"];
        $data->sk_pendirian_mitra = $request["sk_pendirian_mitra"];
        $data->jabatan = $request["trx_proposal_mitra_id"];
        $data->dana_kegiatan = $request["dana_kegiatan"];
        $data->nomor_sk_bpkh = $request["nomor_sk_bpkh"];
        $data->termin = $request["termin"];
        $data->start_date_timeline = $request["start_date_timeline"];
        $data->end_date_timeline = $request["end_date_timeline"];
        if ($request->hasFile('photo_mitra')) {
            $file = $request->file('photo_mitra');
            $saved_db_filename = Uuid::uuid4() . "." . $file->getClientOriginalExtension();
            $image['filePath'] = $saved_db_filename;
            $file->move(storage_path('app/public/pelmonev/pks'), $saved_db_filename);
            // $assessment->file_path    = json_encode($saved_db_filename);
            $data->photo_mitra = $saved_db_filename;
        }
        $data->save();
        return redirect()->away(route('show.perikatan', $data->trx_proposal_id));
    }

    public function print_pks($id, Request $request)
    {
        $proposal = PublicTrxProposal::find($id);
        $data       = PublicTrxProposalMitra::join('trx_proses_status', 'trx_proses_status.trx_proses_status_id', 'trx_proposal_mitra.proses_st')
            ->leftJoin('com_bank', 'com_bank.bank_cd', 'trx_proposal_mitra.bank_cd')
            ->leftJoin('trx_mitra_kemaslahatan', 'trx_mitra_kemaslahatan.trx_mitra_kemaslahatan_id', 'trx_proposal_mitra.trx_mitra_kemaslahatan_id')
            ->where('trx_proposal_child_id', $proposal->trx_proposal_id)->first();
        $trxpks = PublicTrxPks::where('trx_proposal_id', $id)->first();
        //dd($trxpks);
        if ($data) {
            $resultName = date('Ymd_His') . "_PKS_$id.pdf";

            $view       = view('proposal::pelmonev.print.pks-new', compact('data', 'trxpks'))->render();
            // return $view;
            $pdf        = PDF::loadHtml($view);
            $pdf->setOptions(['isHtml5ParserEnabled' => true, 'setIsRemoteEnabled' => true]);
            $pdf->setPaper('A4', 'potrait');
            return $pdf->stream($resultName);
        }
    }
}
