<?php

namespace Modules\Proposal\Http\Controllers;

use DB;
use PDF;
use Auth;
use DataTables;
use Response;

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
use App\Models\PublicTrxProposalRab;
use Illuminate\Support\Facades\Route;
//use Request;
// use App\Traits\Uuid;

use Ramsey\Uuid\Uuid;

class ProposalController extends Controller
{
    private $folder_path = '';
    var $statusScreaning = ['PROSES_TR', 'PROSES_SKG', 'PROSES_SDK', 'PROSES_SABP'];
    var $statusDisposisi = ['PROSES_KBP', 'PROSES_ABP', 'PROSES_DK', 'PROSES_KR'];
    var $statusAnalisa   = ['PROSES_AR', 'PROSES_AKR', 'PROSES_ADK', 'PROSES_AABP'];
    var $statusMR        = ['PROSES_AMR_01', 'PROSES_AMR_02', 'PROSES_AMR_03', 'PROSES_AMR_04'];
    var $statusHK        = ['PROSES_HK_01', 'PROSES_HK_02', 'PROSES_HK_03', 'PROSES_HK_04', 'PROSES_HK_05', 'PROSES_HK_06'];

    function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Index
     *
     * @return \Illuminate\Http\Response
     */
    function index($id = NULL, Request $request)
    {
        $baseUrl = 'proposal';
        $currUserData = AuthUser::mGetDetailUser(Auth::user()->user_id)->first();
        if ($id) {
            $title             = 'Detail Proposal';
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
            $filename_page     = 'index';
            $title             = 'Proposal';
            \LogActivity::saveLog(
                $logTp = 'visit',
                $logNm = "Membuka Menu $title"
            );

            return view('proposal::' . $this->folder_path . '.' . $filename_page, compact('title', 'baseUrl'));
        }
    }


    function indexHistory()
    {
        $baseUrl = 'proposal';
        $currUserData = AuthUser::mGetDetailUser(Auth::user()->user_id)->first();
        $filename_page     = 'index-history';
        $title             = 'Proposal History';
        \LogActivity::saveLog(
            $logTp = 'visit',
            $logNm = "Membuka Menu $title"
        );

        return view('proposal::' . $this->folder_path . '.' . $filename_page, compact('title', 'baseUrl'));
    }

    function show($id, Request $request)
    {
        $baseUrl = 'proposal';
        $statusScreaning = $this->statusScreaning;
        $statusDisposisi = $this->statusDisposisi;
        $statusAnalisa   = $this->statusAnalisa;
        $statusHK        = $this->statusHK;
        $statusMR        = $this->statusMR;
        $currUserData = AuthUser::mGetDetailUser(Auth::user()->user_id)->first();
        $title             = 'View Proposal';
        $proposal       = PublicTrxProposal::join('trx_proses_status', 'trx_proses_status.trx_proses_status_id', 'trx_proposal.proses_st')
            ->leftJoin('public.trx_mitra_strategis', 'trx_mitra_strategis.trx_mitra_strategis_id', 'trx_proposal.trx_mitra_strategis_id')
            ->leftJoin('public.com_code as ruang_lingkup_tp', 'ruang_lingkup_tp.com_cd', 'trx_proposal.ruang_lingkup_child')
            ->find($id);

        $pemohon        = PublicTrxPemohon::find($proposal->trx_pemohon_id);
        $userPemohon    = AuthUser::where('default_key', $proposal->trx_pemohon_id)->first();
        $bank          = ComBank::find($proposal->bank_cd);
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
        // dd($lastScreaning);
        if ($lastScreaning) {
            $mitra              = PublicTrxMitraKemaslahatan::find($lastScreaning->trx_mitra_kemaslahatan_id);
        } else {
            $mitra              = '';
        }

        $lastPejabat        = PublicTrxProposalPejabatRekomendasi::getLastStatus($id);
        $status             = PublicTrxProsesStatus::getStatus($id);
        // dd($lastPejabat);
        $rekomendasiPejabat = PublicTrxProposalPejabatRekomendasi::where('trx_proposal_id', $id)->first();
        $assessment         = PublicTrxAssessmentMk::where('trx_proposal_id', $id)->first();

        \LogActivity::saveLog(
            $logTp = 'visit',
            $logNm = "Membuka Menu $title $id"
        );
        if ($proposal->type_proposal == 1) {
            $filename_page     = 'show-short';
            return view('proposal::' . $this->folder_path . '.' . $filename_page, compact('title', 'proposal', 'pemohon', 'userPemohon', 'bank', 'disposisi', 'lastStatus', 'lastPejabat', 'lastScreaning', 'assessment', 'mitra', 'status', 'rekomendasiPejabat', 'baseUrl', 'statusScreaning', 'statusDisposisi', 'statusAnalisa', 'statusHK', 'statusMR',));
        } else {
            $filename_page     = 'show';
            return view('proposal::' . $this->folder_path . '.' . $filename_page, compact('title', 'proposal', 'pemohon', 'userPemohon', 'bank', 'disposisi', 'lastStatus', 'lastPejabat', 'lastScreaning', 'assessment', 'mitra', 'status', 'rekomendasiPejabat', 'baseUrl', 'statusScreaning', 'statusDisposisi', 'statusAnalisa', 'statusHK', 'statusMR'));
        }
    }

    /**
     * Show : DataTables
     *
     * @return \Illuminate\Http\Response
     */
    function getData(Request $request)
    {
        $currUserData = AuthUser::mGetDetailUser(Auth::user()->user_id)->first();
        $data = PublicTrxProposal::select(
            'trx_proposal_id',
            'trx_proposal.trx_pemohon_id',
            DB::Raw("coalesce(pemohon.pemohon_nm, pemohon_mitra.mitra_kemaslahatan_nm) as pemohon_nm"),
            'trx_proposal.trx_mitra_kemaslahatan_id',
            'mitra.mitra_kemaslahatan_nm',
            'trx_proposal.created_at as tanggal_pengajuan',
            'judul_proposal',
            'trx_proposal.proposal_no',
            'trx_proposal.ruang_lingkup_child',
            'trx_proposal.uraian_singkat_proposal',
            'trx_proposal.region_prop',
            'trx_proposal.region_kab',
            'trx_proposal.region_kec',
            'trx_proposal.region_kel',
            'ruang_lingkup',
            'ruang_lingkup_tp.code_nm as ruang_lingkup_nm',
            'nominal',
            'proses_st',
            'status.proses_nm',
            'status.proses_jabatan'
        )
            ->leftJoin('public.trx_pemohon as pemohon', 'pemohon.trx_pemohon_id', 'trx_proposal.trx_pemohon_id')
            ->leftJoin('public.trx_mitra_kemaslahatan as pemohon_mitra', 'pemohon_mitra.trx_mitra_kemaslahatan_id', 'trx_proposal.trx_pemohon_id')
            ->join('public.trx_proses_status as status', 'status.trx_proses_status_id', 'trx_proposal.proses_st')
            ->leftJoin('public.trx_mitra_kemaslahatan as mitra', 'mitra.trx_mitra_kemaslahatan_id', 'trx_proposal.trx_mitra_kemaslahatan_id')
            ->leftJoin('public.com_code as ruang_lingkup_tp', 'ruang_lingkup_tp.com_cd', 'trx_proposal.ruang_lingkup_child')
            ->where(function ($query) use ($request) {
                if (isRoleUser('pemohon')) {
                    $query->where('trx_proposal.trx_pemohon_id', Auth::user()->default_key);
                }
                if (isRoleUser('mitra')) {
                    $query->where('trx_proposal.trx_mitra_kemaslahatan_id', Auth::user()->default_key);
                    $query->where('status.special_jabatan', Auth::user()->jabatan_id);
                }
                // if (isRoleUser(['regas'])) {
                //     $query->where('trx_proposal.proses_st', 'PROSES_ABP');
                // }
                if (isRoleUser(['regas', 'kepbp', 'bidhk', 'bidmr'])) {
                    $query->where('status.special_jabatan', Auth::user()->jabatan_id);
                    //$query->where('trx_proposal.flag_proposal_mitra', null);
                    $query->whereNotNull('trx_proposal.judul_proposal');
                }
                if ($request->proses != 'SEMUA') {
                    $query->where('proses_st', $request->proses);
                }
                if ($request->judul != '') {
                    $query->where("judul_proposal", "ILIKE", '%' . $request->judul . '%');
                }
            })
            // ->whereJsonContains(
            //     DB::raw('"proses_jabatan"::json'),
            //     [$currUserData->jabatan_id]
            // )
            //->where('trx_proposal.flag_proposal_mitra', null)
            ->orderBy('trx_proposal.created_at', 'DESC');
        return DataTables::of($data)
            ->addColumn('trx_proposal_id', function ($data) {
                return $data->proposal_no;  //".url('proposal-penilaian')."/".$data->trx_proposal_id."
            })
            ->addColumn('trx_proposal_uid', function ($data) {
                return $data->trx_proposal_id;
            })
            ->addColumn('proses_st_nm', function ($data) {
                return "<span class='badge badge-info d-block'>" . substr($data->proses_st, 7, strlen($data->proses_st)) . ' - ' . $data->proses_nm . "</span>";
            })
            ->addColumn('ruang_lingkup_nm', function ($data) {
                if ($data->ruang_lingkup == "RUANG_LINGKUP_1") {
                    return 'Reguler - ' . $data->ruang_lingkup_nm;
                } else {
                    return 'Tanggap Darurat - ' . $data->ruang_lingkup_nm;
                }
            })
            ->addColumn('order_column', function ($data) {
                if (!empty(PublicTrxProsesStatus::getStatus($data->trx_proposal_id))) {
                    return (int)1;
                } else {
                    return (int)0;
                }
            })
            ->addColumn('actions', function ($data) {
                $actions = '';
                // if (isRoleUser('pemohon') && $data->proses_st == 'PROSES_CPM') {
                //     $actions .= '<div class="d-flex justify-content-center">
                //             <a href="' . url('proposal') . "/list-proposal/" . $data->trx_proposal_id . '" class="btn btn-sm btn-primary mx-1 px-2" href><i class="icon icon-pencil"></i></a>
                //             <a href="' . url('proposal') . "/list-proposal/" . $data->trx_proposal_id . '/show" class="btn btn-sm btn-info mx-1 px-2"><i class="icon icon-search4"></i></a>
                //             <button id="hapus" class="btn btn-sm btn-danger mx-1 px-2"><i class="icon icon-bin"></i></button>
                //             </div>';
                // }
                if (isRoleUser('pemohon')) {
                    $actions .= '<div class="d-flex justify-content-center">
                            <button disabled class="btn btn-sm btn-primary mx-1 px-2"><i class="icon icon-pencil"></i></button>
                            <a href="' . url('proposal') . "/list-proposal/" . $data->trx_proposal_id . '/show" class="btn btn-sm btn-info mx-1 px-2"><i class="icon icon-search4"></i></a>
                            <button disabled class="btn btn-sm btn-danger mx-1 px-2"><i class="icon icon-bin"></i></button>
                    </div>';
                } else if (isRoleUser('pemohon') && $data->proses_st == 'PROSES_CPM') {
                    $actions .= '<div class="d-flex justify-content-center">
                            <a href="' . url('proposal') . "/list-proposal/" . $data->trx_proposal_id . '/show" class="btn btn-sm btn-info mx-1 px-2"><i class="icon icon-search4"></i></a>
                            <button id="disposisi" class="btn btn-sm btn-primary mx-1 px-2" data-status=' . $data->proses_st  . '>Disposisi</button>
                            </div>';
                } else if ($data->proses_st == 'PROSES_KBP' || $data->proses_st == 'PROSES_ABP' || $data->proses_st == 'PROSES_DK' || $data->proses_st == 'PROSES_KR') {
                    $actions .= '<div class="d-flex justify-content-center">
                            <a href="' . url('proposal') . "/list-proposal/" . $data->trx_proposal_id . '/show" class="btn btn-sm btn-info mx-1 px-2"><i class="icon icon-search4"></i></a>
                            <button id="disposisi" class="btn btn-sm btn-primary mx-1 px-2" data-status=' . $data->proses_st  . '>Disposisi</button>
                            </div>';
                } else if (
                    $data->proses_st == 'PROSES_TR' || $data->proses_st == 'PROSES_SKG' || $data->proses_st == 'PROSES_SDK' || $data->proses_st == 'PROSES_SABP' ||
                    $data->proses_st == 'PROSES_AMK' || $data->proses_st == 'PROSES_AR' || $data->proses_st == 'PROSES_AKR' || $data->proses_st == 'PROSES_ADR' || $data->proses_st == 'PROSES_AABP'
                ) {
                    $actions .= '<div class="d-flex justify-content-center">
                    <a href="' . url('proposal') . "/list-proposal/" . $data->trx_proposal_id . '/show" class="btn btn-sm btn-info mx-1 px-2"><i class="icon icon-search4"></i></a>
                    <button id="rekomendasikan" class="btn btn-sm btn-primary mx-1 px-2" data-status=' . $data->proses_st  . '>Rekomendasikan</button>
                    </div>';
                } else {
                    $actions .= '<div class="d-flex justify-content-center">
                            <button disabled class="btn btn-sm btn-primary mx-1 px-2"><i class="icon icon-pencil"></i></button>
                            <a href="' . url('proposal') . "/list-proposal/" . $data->trx_proposal_id . '/show" class="btn btn-sm btn-info mx-1 px-2"><i class="icon icon-search4"></i></a>
                            <button disabled class="btn btn-sm btn-danger mx-1 px-2"><i class="icon icon-bin"></i></button>
                            </div>';
                }


                return $actions;
            })
            ->rawColumns(['proses_st_nm', 'actions', 'trx_proposal_id'])
            ->addIndexColumn()
            ->make(true);
    }

    function getDataMitra(Request $request)
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
            ->where(function ($query) use ($request) {
                if (isJabatanUser(3)) {
                    $query->where('trx_proposal_mitra.proses_st',  'PROSES_AKR');
                } else
                if (isJabatanUser(1)) {
                    $query->where('trx_proposal_mitra.proses_st', 'PROSES_AMK');
                } else 
                if (isJabatanUser(4)) {
                    $query->where('trx_proposal_mitra.proses_st', 'PROSES_AKR');
                } else
                if (isJabatanUser(5)) {
                    $query->where('trx_proposal_mitra.proses_st', 'PROSES_ADR');
                } else
                if (isJabatanUser(6)) {
                    $query->where('trx_proposal_mitra.proses_st', 'PROSES_AR');
                } else
                if (isJabatanUser(7)) {
                    $query->where('trx_proposal_mitra.proses_st', 'PROSES_AABP');
                } else
                if (isJabatanUser(14)) {
                    $query->where('trx_proposal_mitra.proses_st', 'PROSES_H_01');
                } else
                if (isJabatanUser(15)) {
                    $query->where('trx_proposal_mitra.proses_st', 'PROSES_H_02');
                } else
                if (isJabatanUser(16)) {
                    $query->where('trx_proposal_mitra.proses_st', 'PROSES_K_01');
                } else
                if (isJabatanUser(17)) {
                    $query->where('trx_proposal_mitra.proses_st', 'PROSES_K_02');
                } else
                if (isJabatanUser(18)) {
                    $query->where('trx_proposal_mitra.proses_st', 'PROSES_HK_03');
                } else
                if (isJabatanUser(19)) {
                    $query->where('trx_proposal_mitra.proses_st', 'PROSES_HK_04');
                } else
                if (isJabatanUser(10)) {
                    $query->where('trx_proposal_mitra.proses_st', 'PROSES_AMR_01');
                } else
                if (isJabatanUser(11)) {
                    $query->where('trx_proposal_mitra.proses_st', 'PROSES_AMR_02');
                } else
                if (isJabatanUser(12)) {
                    $query->where('trx_proposal_mitra.proses_st', 'PROSES_AMR_03');
                } else
                if (isJabatanUser(13)) {
                    $query->where('trx_proposal_mitra.proses_st', 'PROSES_AMR_04');
                } else {
                    $query->where('trx_proposal_mitra.proses_st', 'PROSES_AMK');
                }
            })
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
            ->addColumn('ruang_lingkup_nm', function ($data) {
                if ($data->ruang_lingkup == "RUANG_LINGKUP_1") {
                    return 'Reguler - ' . $data->ruang_lingkup_nm;
                } else {
                    return 'Tanggap Darurat - ' . $data->ruang_lingkup_nm;
                }
            })
            ->addColumn('order_column', function ($data) {
                // if (!empty(PublicTrxProsesStatus::getStatus($data->trx_proposal_mitra_id))) {
                //     return (int)1;
                // } else {
                //     return (int)0;
                // }
                return "ok";
            })
            ->addColumn('actions', function ($data) {
                $actions = '';
		if(isJabatanUser(13) && isRoleUser(['bidmr'])){ 
		    $nominal = $data->nominal;
		    $button  = '<button id="disposisi-proposal-manaj-resiko" class="btn btn-sm btn-primary mx-1 px-2" data-bind=' . $data->trx_proposal_child_id . ' data-status=' . $data->proses_st . ' data-nominal=' . $nominal . '>Rekomendasikan</button>';
		}else{
		    $nominal = " ";
		    $status  = " ";
		    $button  = '<button id="disposisi-proposal-akr" class="btn btn-sm btn-primary mx-1 px-2" data-bind=' . $data->trx_proposal_child_id . ' data-status=' . $data->proses_st . '>Rekomendasikan</button>';
		}
                if (isRoleUser('pemohon') && $data->proses_st == 'PROSES_CPM') {
                    $actions .= '<div class="d-flex justify-content-center">
                            <a href="' . url('proposal') . "/list-proposal/mitra/" . $data->trx_proposal_mitra_id . '" class="btn btn-sm btn-info mx-1 px-2"><i class="icon icon-search4"></i></a>
                            
                            </div>';
                } else if ((isJabatanUser(9) && $data->proses_st == 'PROSES_KBP') || (isJabatanUser(7) && $data->proses_st == 'PROSES_ABP') ||
                    (isJabatanUser(5) && $data->proses_st == 'PROSES_DK') || (isJabatanUser(4) && $data->proses_st == 'PROSES_KR')
                ) {
                    $actions .= '<div class="d-flex justify-content-center">
                            <a href="' . url('proposal') . "/list-proposal/mitra/" . $data->trx_proposal_mitra_id . '" class="btn btn-sm btn-info mx-1 px-2"><i class="icon icon-search4"></i></a>
                            <button id="disposisi" class="btn btn-sm btn-primary mx-1 px-2">Disposisi</button>
                            </div>';
                } else if ((isJabatanUser(3) && $data->proses_st == 'PROSES_TR') || (isJabatanUser(4) && $data->proses_st == 'PROSES_SKG') ||
                    (isJabatanUser(5) && $data->proses_st == 'PROSES_SDK') || (isJabatanUser(7) && $data->proses_st == 'PROSES_SABP')
                ) {
                    $actions .= '<div class="d-flex justify-content-center">
                    <a href="' . url('proposal') . "/list-proposal/mitra/" . $data->trx_proposal_mitra_id . '" class="btn btn-sm btn-info mx-1 px-2"><i class="icon icon-search4"></i></a>
                    <button id="disposisi" class="btn btn-sm btn-primary mx-1 px-2">Rekomendasikan</button>
                    </div>';
                } else if (isJabatanUser([9, 7, 5, 4, 3, 11, 12, 13, 15, 17, 18, 19])) {
                    $actions .= '<div class="d-flex justify-content-center">
                            	<a href="' . url('proposal') . "/list-proposal/mitra/" . $data->trx_proposal_mitra_id . '" class="btn btn-sm btn-info mx-1 px-2"><i class="icon icon-search4"></i></a>
                            	' . $button . '
				<button id="disposisi-akr-back" class="btn btn-sm btn-danger mx-1 px-2" data-bind=' . $data->trx_proposal_child_id . ' data-status=' . $data->proses_st . '>Kembalikan</button>
                            </div>';
                } else {
		    if(isJabatanUser(6) && $data->proses_st == 'PROSES_AR'){
			$text = 'Lanjutkan ke Kadiv';
		    }else{
 			$text = 'Rekomendasikan';
		    }
                    $actions .= '<div class="d-flex justify-content-center">
                            <a href="' . url('proposal') . "/list-proposal/mitra/" . $data->trx_proposal_mitra_id . '" class="btn btn-sm btn-info mx-1 px-2"><i class="icon icon-search4"></i></a>
                            <button id="disposisi-proposal-akr" class="btn btn-sm btn-primary mx-1 px-2" data-bind=' . $data->trx_proposal_child_id . ' data-status=' . $data->proses_st . '>
				' . $text . '
			     </button>
                            </div>';
                }

                return $actions;
            })
            ->rawColumns(['proses_st_nm', 'actions', 'trx_proposal_id'])
            ->addIndexColumn()
            ->make(true);
    }

    function getDataRapat(Request $request) {
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
            ->where('trx_proposal_mitra.proses_st', $request["rapat"])
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
            ->addColumn('ruang_lingkup_nm', function ($data) {
                if ($data->ruang_lingkup == "RUANG_LINGKUP_1") {
                    return 'Reguler - ' . $data->ruang_lingkup_nm;
                } else {
                    return 'Tanggap Darurat - ' . $data->ruang_lingkup_nm;
                }
            })
            ->addColumn('order_column', function ($data) {
                // if (!empty(PublicTrxProsesStatus::getStatus($data->trx_proposal_mitra_id))) {
                //     return (int)1;
                // } else {
                //     return (int)0;
                // }
                return "ok";
            })
            ->addColumn('actions', function ($data) {
                $actions = '';
                $actions .= '<div class="d-flex justify-content-center">
                		<a href="' . url('proposal') . "/list-proposal/mitra/" . $data->trx_proposal_mitra_id . '" class="btn btn-sm btn-info mx-1 px-2"><i class="icon icon-search4"></i></a>
                        	<button id="rekomendasi-rapat" class="btn btn-sm btn-primary mx-1 px-2" data-bind=' . $data->trx_proposal_child_id . ' data-status=' . $data->proses_st . '>Rekomendasikan</button>
                        	<button id="kembalikan-rapat" class="btn btn-sm btn-danger mx-1 px-2" data-bind=' . $data->trx_proposal_child_id . ' data-status=' . $data->proses_st . '>Kembalikan</button>
                        	</div>';
                return $actions;
            })
            ->rawColumns(['proses_st_nm', 'actions', 'trx_proposal_id'])
            ->addIndexColumn()
            ->make(true);
    }


    function getDataHistory(Request $request)
    {
        $currUserData = AuthUser::mGetDetailUser(Auth::user()->user_id)->first();
        $data = PublicTrxProposal::select(
            'trx_proposal_id',
            'trx_proposal.trx_pemohon_id',
            DB::Raw("coalesce(pemohon.pemohon_nm, pemohon_mitra.mitra_kemaslahatan_nm) as pemohon_nm"),
            'trx_proposal.trx_mitra_kemaslahatan_id',
            'mitra.mitra_kemaslahatan_nm',
            'trx_proposal.created_at as tanggal_pengajuan',
            'judul_proposal',
            'trx_proposal.proposal_no',
            'trx_proposal.ruang_lingkup_child',
            'trx_proposal.uraian_singkat_proposal',
            'trx_proposal.region_prop',
            'trx_proposal.region_kab',
            'trx_proposal.region_kec',
            'trx_proposal.region_kel',
            'ruang_lingkup',
            'ruang_lingkup_tp.code_nm as ruang_lingkup_nm',
            'nominal',
            'proses_st',
            'status.proses_nm',
            'status.proses_jabatan'
        )
            ->leftJoin('public.trx_pemohon as pemohon', 'pemohon.trx_pemohon_id', 'trx_proposal.trx_pemohon_id')
            ->leftJoin('public.trx_mitra_kemaslahatan as pemohon_mitra', 'pemohon_mitra.trx_mitra_kemaslahatan_id', 'trx_proposal.trx_pemohon_id')
            ->join('public.trx_proses_status as status', 'status.trx_proses_status_id', 'trx_proposal.proses_st')
            ->leftJoin('public.trx_mitra_kemaslahatan as mitra', 'mitra.trx_mitra_kemaslahatan_id', 'trx_proposal.trx_mitra_kemaslahatan_id')
            ->leftJoin('public.com_code as ruang_lingkup_tp', 'ruang_lingkup_tp.com_cd', 'trx_proposal.ruang_lingkup_child')
            ->where(function ($query) use ($request) {
                if (isRoleUser('mitra')) {
                    $query->where('trx_proposal.trx_mitra_kemaslahatan_id', Auth::user()->default_key);
                    $query->where('status.special_jabatan', '!=', Auth::user()->jabatan_id);
                    //$query->where('status.trx_proses_status_id', ['PROSES_AR','PROSES_AKR']);
                }
                if (isRoleUser(['regas', 'kepbp', 'bidhk', 'bidmr'])) {
                    //$query->whereJsonContains(DB::raw('"proses_jabatan"::json'),[$currUserData->jabatan_id]);
                    $query->where('status.special_jabatan', '!=', Auth::user()->jabatan_id);
                    $query->whereNotNull('trx_proposal.judul_proposal');
                }
                if ($request->proses != 'SEMUA') {
                    $query->where('proses_st', $request->proses);
                }
                if ($request->judul != '') {
                    $query->where("judul_proposal", "ILIKE", '%' . $request->judul . '%');
                }
            })

            //->whereJsonContains(
            //DB::raw('"proses_jabatan"::json'),[$currUserData->jabatan_id]
            //)
            ->orderBy('trx_proposal.created_at', 'DESC');
        return DataTables::of($data)
            ->addColumn('trx_proposal_id', function ($data) {
                return $data->proposal_no;  //".url('proposal-penilaian')."/".$data->trx_proposal_id."
            })
            ->addColumn('trx_proposal_uid', function ($data) {
                return $data->trx_proposal_id;
            })
            ->addColumn('proses_st_nm', function ($data) {
                return "<span class='badge badge-info d-block'>" . substr($data->proses_st, 7, strlen($data->proses_st)) . ' - ' . $data->proses_nm . "</span>";
            })
            ->addColumn('ruang_lingkup_nm', function ($data) {
                if ($data->ruang_lingkup == "RUANG_LINGKUP_1") {
                    return 'Reguler - ' . $data->ruang_lingkup_nm;
                } else {
                    return 'Tanggap Darurat - ' . $data->ruang_lingkup_nm;
                }
            })
            ->addColumn('order_column', function ($data) {
                if (!empty(PublicTrxProsesStatus::getStatus($data->trx_proposal_id))) {
                    return (int)1;
                } else {
                    return (int)0;
                }
            })
            ->addColumn('actions', function ($data) {
                $actions = '';
                $actions .= '<div class="d-flex justify-content-center">
                            <a href="' . url('proposal') . "/list-proposal/" . $data->trx_proposal_id . '/show" class="btn btn-sm btn-info mx-1 px-2"><i class="icon icon-search4"></i></a>
                            </div>';
                return $actions;
            })
            ->rawColumns(['proses_st_nm', 'actions', 'trx_proposal_id'])
            ->addIndexColumn()
            ->make(true);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $proposal                               = new PublicTrxProposal;
            $proposal->trx_mitra_kemaslahatan_id    = $request->trx_mitra_kemaslahatan_id;
            $proposal->trx_pemohon_id               = isRoleUser('pemohon') ? Auth::user()->default_key : $request->trx_pemohon_id;
            $proposal->judul_proposal               = $request->judul_proposal;
            $proposal->nominal                      = uang($request->nominal);
            $proposal->ruang_lingkup                = $request->ruang_lingkup;
            $proposal->uraian_singkat_proposal      = $request->uraian_singkat_proposal;
            $proposal->deskripsi_singkat_proposal   = $request->deskripsi_singkat_proposal;
            $proposal->note                         = $request->note;
            $proposal->proses_st                    = 'PROSES_ST_10';
            $proposal->created_by                   = Auth::user()->user_id;
            $proposal->save();

            DB::commit();

            \LogActivity::saveLog(
                $logTp      = 'create',
                $logNm      = "Membuat Proposal",
                $table      = $proposal->getTable(),
                $newData    = $proposal
            );

            return response()->json(['status' => 'ok'], 200);
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
    function update(Request $request, $id)
    {
        // return $request->all();\
        //dd($request->all());
        try {
            DB::beginTransaction();

            $proposal = PublicTrxProposal::find($id);
            $oldData = $proposal;
            if ($proposal->proses_st == "PROSES_CPM") {
                if ($request->submit == 1) {
                    $proposal->proses_st                = 'PROSES_KBP';
                } else if ($request->submit == 0) {
                    $proposal->proses_st                = 'PROSES_CPM';
                } else if ($request->submit == 2) {
                    $proposal->proses_st                = 'PROSES_CPM';
                } else if ($request->submit == 3) {
                    $proposal->proses_st                = 'PROSES_AR';
                } else if ($request->submit == 4) {
                    $proposal->proses_st                = 'PROSES_TOLAK';
                }
            }
            if ($request->has('trx_mitra_kemaslahatan_id')) $proposal->trx_mitra_kemaslahatan_id = $request->trx_mitra_kemaslahatan_id;
            if ($request->has('trx_mitra_strategis_id')) $proposal->trx_mitra_strategis_id = $request->trx_mitra_strategis_id;
            if ($request->has('judul_proposal')) $proposal->judul_proposal = $request->judul_proposal;
            if ($request->has('nominal')) $proposal->nominal = uang($request->nominal);
            if ($request->has('nominal_realisasi')) $proposal->nominal_realisasi = uang($request->nominal_realisasi);
            if ($request->has('nominal_efisiensi')) $proposal->nominal_efisiensi = uang($request->nominal_efisiensi);
            if ($request->has('ruang_lingkup')) $proposal->ruang_lingkup = $request->ruang_lingkup;
            if ($request->has('ruang_lingkup_child')) $proposal->ruang_lingkup_child = $request->ruang_lingkup_child;
            if ($request->has('uraian_singkat_proposal')) $proposal->uraian_singkat_proposal = $request->uraian_singkat_proposal;
            if ($request->has('note')) $proposal->note = $request->note;
            if ($request->has('proposal_fill_st')) $proposal->proposal_fill_st = $request->proposal_fill_st;
            if ($request->has('proposal_latitude')) $proposal->proposal_latitude = $request->proposal_latitude;
            if ($request->has('proposal_longitude')) $proposal->proposal_longitude = $request->proposal_longitude;
            if ($request->has('region_prop')) $proposal->region_prop = $request->region_prop;
            if ($request->has('region_kab')) $proposal->region_kab = $request->region_kab;
            if ($request->has('region_kel')) $proposal->region_kel = $request->region_kel;
            if ($request->has('region_kec')) $proposal->region_kec = $request->region_kec;
            if ($request->has('address')) $proposal->address = $request->address;

            if ($request->has('akta_pendirian')) $proposal->akta_pendirian = $request->akta_pendirian;
            if ($request->has('akta_perubahan_terakhir')) $proposal->akta_perubahan_terakhir = $request->akta_perubahan_terakhir;
            if ($request->has('sk_pengesahan_pendirian_no')) $proposal->sk_pengesahan_pendirian_no = $request->sk_pengesahan_pendirian_no;
            if ($request->has('sk_pengesahan_perubahan_terakhir_no')) $proposal->sk_pengesahan_perubahan_terakhir_no = $request->sk_pengesahan_perubahan_terakhir_no;
            if ($request->has('ktp_no_pimpinan')) $proposal->ktp_no_pimpinan = $request->ktp_no_pimpinan;
            if ($request->has('npwp_no_lembaga')) $proposal->npwp_no_lembaga = $request->npwp_no_lembaga;
            if ($request->has('kriteria_mitra')) $proposal->kriteria_mitra = $request->kriteria_mitra;
            if ($request->has('lembaga_fill_st')) $proposal->lembaga_fill_st = $request->lembaga_fill_st;

            if ($request->has('profil_singkat')) $proposal->profil_singkat = $request->profil_singkat;
            if ($request->has('profil_fill_st')) $proposal->profil_fill_st = $request->profil_fill_st;

            if ($request->has('phone')) $proposal->phone = $request->phone;
            if ($request->has('website')) $proposal->website = $request->website;
            if ($request->has('socmed')) $proposal->socmed = $request->socmed;
            if ($request->has('informasi_fill_st')) $proposal->informasi_fill_st = $request->informasi_fill_st;

            if ($request->has('penanggung_jawab_nm')) $proposal->penanggung_jawab_nm = $request->penanggung_jawab_nm;
            if ($request->has('penanggung_jawab_email')) $proposal->penanggung_jawab_email = $request->penanggung_jawab_email;
            if ($request->has('penanggung_jawab_phone')) $proposal->penanggung_jawab_phone = $request->penanggung_jawab_phone;
            if ($request->has('penanggung_jawab_address')) $proposal->penanggung_jawab_address = $request->penanggung_jawab_address;
            if ($request->has('penanggung_jawab_jabatan')) $proposal->penanggung_jawab_jabatan = $request->penanggung_jawab_jabatan;
            if ($request->has('bank_cd')) $proposal->bank_cd = $request->bank_cd;
            if ($request->has('bank_branch')) $proposal->bank_branch = $request->bank_branch;
            if ($request->has('bank_holder')) $proposal->bank_holder = $request->bank_holder;
            if ($request->has('bank_account_no')) $proposal->bank_account_no = $request->bank_account_no;
            if ($request->has('kontak_fill_st')) $proposal->kontak_fill_st = $request->kontak_fill_st;

            if ($request->has('deskripsi_nama_kegiatan')) $proposal->deskripsi_nama_kegiatan = $request->deskripsi_nama_kegiatan;
            if ($request->has('deskripsi_spesifikasi_kegiatan')) $proposal->deskripsi_spesifikasi_kegiatan = $request->deskripsi_spesifikasi_kegiatan;
            if ($request->has('deskripsi_latar_belakang_usulan')) $proposal->deskripsi_latar_belakang_usulan = $request->deskripsi_latar_belakang_usulan;
            if ($request->has('deskripsi_tujuan_acara')) $proposal->deskripsi_tujuan_acara = $request->deskripsi_tujuan_acara;
            if ($request->has('deskripsi_nominal')) $proposal->deskripsi_nominal = uang($request->deskripsi_nominal);
            if ($request->has('deskripsi_prioritas_penggunaan_dana')) $proposal->deskripsi_prioritas_penggunaan_dana = $request->deskripsi_prioritas_penggunaan_dana;
            if ($request->has('deskripsi_fill_st')) $proposal->deskripsi_fill_st = $request->deskripsi_fill_st;

            if ($request->has('lokasi_nama_gedung')) $proposal->lokasi_nama_gedung = $request->lokasi_nama_gedung;
            if ($request->has('lokasi_region_prop')) $proposal->lokasi_region_prop = $request->lokasi_region_prop;
            if ($request->has('lokasi_region_kab')) $proposal->lokasi_region_kab = $request->lokasi_region_kab;
            if ($request->has('lokasi_region_kec')) $proposal->lokasi_region_kec = $request->lokasi_region_kec;
            if ($request->has('lokasi_komunitas')) $proposal->lokasi_komunitas = $request->lokasi_komunitas;
            if ($request->has('lokasi_fill_st')) $proposal->lokasi_fill_st = $request->lokasi_fill_st;

            if ($request->has('manfaat_bpkh')) $proposal->manfaat_bpkh = $request->manfaat_bpkh;
            if ($request->has('manfaat_haji')) $proposal->manfaat_haji = $request->manfaat_haji;
            if ($request->has('manfaat_kemaslahatan')) $proposal->manfaat_kemaslahatan = $request->manfaat_kemaslahatan;
            if ($request->has('manfaat_lain_lain')) $proposal->manfaat_lain_lain = $request->manfaat_lain_lain;
            if ($request->has('manfaat_fill_st')) $proposal->manfaat_fill_st = $request->manfaat_fill_st;

            if ($request->has('rab_tp')) $proposal->rab_tp = $request->rab_tp;

            if ($proposal->proses_st == "PROSES_CPM") {
                $proposal->updated_by    = Auth::user()->user_id;
                if ($request->submit == 2) {
                    $proposal->type_proposal            = 2;
                    $proposal->proposal_no              = 'LG' . $proposal->created_at->format('m/d/Y') . '/' . $proposal->region_prop . '/' . $proposal->region_kel;
                } else if ($request->submit == 0 || $request->submit == 1) {
                    $proposal->type_proposal            = 1;
                    $proposal->proposal_no              = 'ST' . $proposal->created_at->format('m/d/Y') . '/' . $proposal->region_prop . '/' . $proposal->region_kel;
                }
            }
            $proposal->save();
            if (!in_array($proposal->proses_st, ['PROSES_CPM', 'PROSES_KBP', 'PROSES_ABP', 'PROSES_KR', 'PROSES_DK']) && (isJabatanUser(3) || isJabatanUser(4) || isJabatanUser(5) || isJabatanUser(7))) {
                if ($request["type"] == 'screaning') {
                    $check = PublicTrxProposalScreaning1::where('trx_screaning1_id', $request["trx_screaning1_id"])->first();
                    // dd($check);
                    if ($check) {
                        $screaning  = PublicTrxProposalScreaning1::find($check->trx_screaning1_id);
                    } else {
                        $screaning  = new PublicTrxProposalScreaning1();
                    }
                    // dd($screaning);
                    $screaning->trx_proposal_id             = $proposal->trx_proposal_id;
                    $screaning->trx_mitra_kemaslahatan_id   = $request->trx_mitra_kemaslahatan_id;
                    $screaning->target_penyelesaian         = $request->target_penyelesaian;
                    $screaning->note                        = $request->note;
                    $screaning->created_by                  = Auth::user()->user_id;
                    $screaning->save();
                }


                if ($request["type"] == 'pejabat') {
                    $check2 = PublicTrxProposalPejabatRekomendasi::where('trx_proposal_pejabat_rekomendasi_id', $request["trx_proposal_pejabat_rekomendasi_id"])->first();
                    if ($check2) {
                        $pejabat = PublicTrxProposalPejabatRekomendasi::find($check2->trx_proposal_pejabat_rekomendasi_id);
                    } else {
                        $pejabat = new PublicTrxProposalPejabatRekomendasi();
                    }
                    $pejabat->trx_proposal_id   = $proposal->trx_proposal_id;
                    $pejabat->trx_mitra_strategis_id = $request->trx_mitra_strategis_id;
                    $pejabat->nama              = $request->rekomendasi_nama;
                    $pejabat->jabatan           = $request->rekomendasi_jabatan;
                    $pejabat->institusi         = $request->rekomendasi_instansi;
                    $pejabat->created_by        = Auth::user()->user_id;
                    $pejabat->save();
                }
            }
            if ($request->submit == 5) {
                $assessment = new PublicTrxAssessmentMk;
                $files = $request->file('photo');
                $saved_db_filename = array();
                if ($request->hasFile('photo')) {
                    foreach ($files as $index => $file) {
                        $saved_db_filename[$index] = Uuid::uuid4() . "." . $file->getClientOriginalExtension();
                        $image['filePath'] = $saved_db_filename[$index];
                        $file->move(storage_path('app/public/assessment-file/'), $saved_db_filename[$index]);
                    }
                    // $assessment->file_path    = json_encode($saved_db_filename);
                    $assessment->photo = json_encode($saved_db_filename);
                    $assessment->trx_proposal_id = $id;
                }
                $assessment->laporan_kunjungan_lapangan = $request->laporan_kunjungan_lapangan;
                $assessment->save();
            }

            if ($proposal->proses_st == "PROSES_CPM") {
                if ($request->submit == 1) {
                    PublicTrxProposalTimeline::insertTimeline($proposal->trx_proposal_id, Auth::user()->user_nm, 'PROSES_KBP', '', '');
                } else if ($request->submit == 0) {
                    PublicTrxProposalTimeline::insertTimeline($proposal->trx_proposal_id, Auth::user()->user_nm, 'PROSES_CPM', '', '');
                }
            }
            PublicTrxProposalTimeline::insertTimeline($proposal->trx_proposal_id, Auth::user()->user_nm, $proposal->proses_st, '', '');
            if ($request->submit == 3) {
                $assessment = new PublicTrxUjiKelayakan();
                $assessment->summary_assessment    = 1;
                $uji_save = array();
                for ($i = 1; $i <= 5; $i++) {
                    $uji_save[$i] = $request->input('uji' . $i);
                }
                $assessment->uji_kelayakan = json_encode($uji_save);
                $assessment->trx_proposal_id = $id;
                $assessment->save();
            } else if ($request->submit == 4) {
                $assessment = new PublicTrxUjiKelayakan;
                $assessment->summary_assessment    = 0;
                $uji_save = array();
                for ($i = 1; $i <= 5; $i++) {
                    $uji_save[$i] = $request->input('uji' . $i);
                }
                $assessment->uji_kelayakan = json_encode($uji_save);
                $assessment->trx_proposal_id = $id;
                $assessment->save();
            }
            DB::commit();
            if ($request->submit == 3) {
                $proposal2  = new PublicTrxProposal;
                $proposal2->trx_proposal_child_id = $proposal->trx_proposal_id;
                $proposal2->proses_st                = 'PROSES_AR';
                $proposal2->proposal_no              = 'LG' . $proposal->created_at->format('m/d/Y') . '/';
                $proposal2->save();
                \LogActivity::saveLog(
                    $logTp      = 'create',
                    $logNm      = "Membuat Long Proposal Mitra",
                    $table      = $proposal2->getTable(),
                    $newData    = $proposal2
                );
                return response()->json(
                    [
                        'status' => 'ok',
                        'id' => $proposal2->trx_proposal_id,
                    ],
                    200
                );
            } else {
                \LogActivity::saveLog(
                    $logTp      = 'update',
                    $logNm      = "Mengubah Data Proposal $id",
                    $table      = $proposal->getTable(),
                    $oldData    = $oldData,
                    $newData    = $proposal
                );
                // dd($screaning);
                if ($request["type"] == 'pejabat') {
                    $trxid = $pejabat->trx_proposal_pejabat_rekomendasi_id;
                } else if ($request["type"] == 'screaning') {
                    $trxid = $screaning->trx_screaning1_id;
                } else {
                    $trxid = '';
                }
                return response()->json([
                    'status' => 'ok',
                    'trx_screaning_id' => $trxid
                ], 200);
            }
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    function checkKuota(Request $request)
    {
        $kuotaWilayah = PublicTrxKuotaProposal::checkKuota($request->region_prop, 'wilayah', uang($request->nominal));
        if ($kuotaWilayah == FALSE) {
            return response()->json(['status' => 'failed', 'msg' => "KUOTA WILAYAH SUDAH HABIS"], 200);
        }

        $kuotaRuangLingkup = PublicTrxKuotaProposal::checkKuota($request->ruang_lingkup, 'ruanglingkup', uang($request->nominal));
        if ($kuotaRuangLingkup == FALSE) {
            return response()->json(['status' => 'failed', 'msg' => "KUOTA RUANG LINGKUP SUDAH HABIS"], 200);
        }

        return response()->json(['status' => 'ok'], 200);
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $proposal = PublicTrxProposal::find($id);
            $oldData = $proposal;
            $proposal->delete();
            DB::commit();

            \LogActivity::saveLog(
                $logTp      = 'delete',
                $logNm      = "Menghapus Data Pengajuan Proposal $id",
                $table      = $proposal->getTable(),
                $oldData    = $oldData
            );

            return response()->json(['status' => 'ok'], 200);
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    public function disposisi(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $proposal = PublicTrxProposal::find($id);
            // dd($proposal->proses_st);
            $oldData = $proposal;
            $lastStatus = PublicTrxProposalTimeline::getLastStatus($proposal->trx_proposal_id);
            $status     = PublicTrxProsesStatus::getStatus($id);

            // if ($request["flag_button"] == 'rekomendasi') {
            //     if (isJabatanUser(7) && $proposal->proses_st == 'PROSES_ABP') {
            //         $proposal->proses_st = 'PROSES_H01';
            //     }
            // } else {
            if (isJabatanUser(9) && $proposal->proses_st == 'PROSES_KBP') {
                $proposal->proses_st = 'PROSES_ABP';
            } elseif (isJabatanUser(7) && $proposal->proses_st == 'PROSES_ABP') {
                $proposal->proses_st = 'PROSES_DK';
            } elseif (isJabatanUser(5) && $proposal->proses_st == 'PROSES_DK') {
                $proposal->proses_st = 'PROSES_KR';
            } elseif (isJabatanUser(4) && $proposal->proses_st == 'PROSES_KR') {
                $proposal->proses_st = 'PROSES_TR';
            } elseif (isJabatanUser(3) && $proposal->proses_st == 'PROSES_TR') {
                $proposal->proses_st = 'PROSES_SKG';
            } elseif (isJabatanUser(4) && $proposal->proses_st == 'PROSES_SKG') {
                $proposal->proses_st = 'PROSES_SDK';
            } elseif (isJabatanUser(5) && $proposal->proses_st == 'PROSES_SDK') {
                $proposal->proses_st = 'PROSES_SABP';
            } elseif (isJabatanUser(7) && $proposal->proses_st == 'PROSES_SABP') {
                $proposal->proses_st = 'PROSES_AMK';
            }
            // }

            $proposal->note         = $request->approval_note;
            $proposal->updated_by   = Auth::user()->user_id;
            $proposal->save();

            $updateTimeline                 = PublicTrxProposalTimeline::find($lastStatus->trx_proposal_timeline_id);
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

            DB::commit();

            \LogActivity::saveLog(
                $logTp      = 'Disposisi',
                $logNm      = "Disposisi Data Proposal $id",
                $table      = $proposal->getTable(),
                $oldData    = $oldData
            );

            return response()->json(['status' => 'ok'], 200);
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    public function rekomendasi(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $proposal = PublicTrxProposal::find($id);
            // dd($proposal->proses_st);
            $oldData = $proposal;
            $lastStatus = PublicTrxProposalTimeline::getLastStatus($proposal->trx_proposal_id);
            $status     = PublicTrxProsesStatus::getStatus($id);

            // if ($request["flag_button"] == 'rekomendasi') {
            //     if (isJabatanUser(7) && $proposal->proses_st == 'PROSES_ABP') {
            //         $proposal->proses_st = 'PROSES_H01';
            //     }
            // } else {
            if (isJabatanUser(5) && $proposal->proses_st == 'PROSES_SDK') {
                $proposal->proses_st = 'PROSES_SABP';
            } else if (isJabatanUser(4) && $proposal->proses_st = 'PROSES_SKG') {
                $proposal->proses_st = 'PROSES_SDK';
            } else if (isJabatanUser(3) && $proposal->proses_st == 'PROSES_TR') {
                $proposal->proses_st = 'PROSES_SKG';
            } else if (isJabatanUser(7) && $proposal->proses_st == 'PROSES_SABP') {
                $proposal->proses_st = 'PROSES_AMK';
            } else if (isJabatanUser(1) && $proposal->proses_st == 'PROSES_AMK') {
                $proposal->proses_st = 'PROSES_AR';
            } else if (isJabatanUser(6) && $proposal->proses_st == 'PROSES_AR') {
                $proposal->proses_st = 'PROSES_AKR';
            }
            // }

            $proposal->note         = $request->approval_note;
            $proposal->updated_by   = Auth::user()->user_id;
            $proposal->save();

            $updateTimeline                 = PublicTrxProposalTimeline::find($lastStatus->trx_proposal_timeline_id);
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

            DB::commit();

            \LogActivity::saveLog(
                $logTp      = 'Disposisi',
                $logNm      = "Disposisi Data Proposal $id",
                $table      = $proposal->getTable(),
                $oldData    = $oldData
            );

            return response()->json(['status' => 'ok'], 200);
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    public function getPejabat(Request $request)
    {
        $mitra = PublicTrxMitraStrategis1::where('ms_code', $request["ms_code"])->first();
        return response()->json($mitra);
    }

    public function create_proposal_mitra($id, Request $request)
    {
        $baseUrl = 'proposal';
        $title = 'Create Proposal Mitra';
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

        $filename_page     = 'create-proposal-mitra';
        return view('proposal::' . $this->folder_path . '.' . $filename_page, compact('title', 'proposal', 'pemohon', 'userPemohon', 'banks', 'disposisi', 'lastStatus', 'status', 'rekomendasiPejabat', 'baseUrl', 'lastScreaning'));
    }

    public function insert_proposal_mitra($id, Request $request)
    {
        $check = PublicTrxProposalMitra::where('trx_proposal_child_id', $request["trx_proposal_id"])->first();
        // dd($check);
        if ($check) {
            $proposal = PublicTrxProposalMitra::find($check->trx_proposal_mitra_id);
        } else {
            $proposal = new PublicTrxProposalMitra();
        }
        // $oldData = $proposal;
        if ($proposal->proses_st == "PROSES_CPM") {
            if ($request->submit == 1) {
                $proposal->proses_st                = 'PROSES_KBP';
            } else if ($request->submit == 0) {
                $proposal->proses_st                = 'PROSES_CPM';
            } else if ($request->submit == 2) {
                $proposal->proses_st                = 'PROSES_CPM';
            } else if ($request->submit == 3) {
                $proposal->proses_st                = 'PROSES_AR';
            } else if ($request->submit == 4) {
                $proposal->proses_st                = 'PROSES_TOLAK';
            }
        } else {
            $proposal->proses_st = 'PROSES_AMK';
        }

        $check_regis = PublicTrxProposal::where('trx_proposal_id', $id)->first();
        if ($check_regis) {
            $regisproposal = PublicTrxProposal::find($check_regis->trx_proposal_id);
            $regisproposal->flag_proposal_mitra = 'yes';
            $regisproposal->save();
        }
        $proposal->trx_pemohon_id = $request["trx_pemohon_id"];
        $proposal->trx_proposal_child_id = $request["trx_proposal_id"];
        if ($request->has('trx_mitra_kemaslahatan_id')) $proposal->trx_mitra_kemaslahatan_id = $request->trx_mitra_kemaslahatan_id;
        if ($request->has('trx_mitra_strategis_id')) $proposal->trx_mitra_strategis_id = $request->trx_mitra_strategis_id;
        if ($request->has('judul_proposal')) $proposal->judul_proposal = $request->judul_proposal;
        if ($request->has('nominal')) $proposal->nominal = uang($request->nominal);
        if ($request->has('nominal_realisasi')) $proposal->nominal_realisasi = uang($request->nominal_realisasi);
        if ($request->has('nominal_efisiensi')) $proposal->nominal_efisiensi = uang($request->nominal_efisiensi);
        if ($request->has('ruang_lingkup')) $proposal->ruang_lingkup = $request->ruang_lingkup;
        if ($request->has('ruang_lingkup_child')) $proposal->ruang_lingkup_child = $request->ruang_lingkup_child;
        if ($request->has('uraian_singkat_proposal')) $proposal->uraian_singkat_proposal = $request->uraian_singkat_proposal;
        if ($request->has('note')) $proposal->note = $request->note;
        if ($request->has('proposal_fill_st')) $proposal->proposal_fill_st = $request->proposal_fill_st;
        if ($request->has('proposal_latitude')) $proposal->proposal_latitude = $request->proposal_latitude;
        if ($request->has('proposal_longitude')) $proposal->proposal_longitude = $request->proposal_longitude;
        if ($request->has('region_prop')) $proposal->region_prop = $request->region_prop;
        if ($request->has('region_kab')) $proposal->region_kab = $request->region_kab;
        if ($request->has('region_kel')) $proposal->region_kel = $request->region_kel;
        if ($request->has('region_kec')) $proposal->region_kec = $request->region_kec;
        if ($request->has('address')) $proposal->address = $request->address;

        if ($request->has('akta_pendirian')) $proposal->akta_pendirian = $request->akta_pendirian;
        if ($request->has('akta_perubahan_terakhir')) $proposal->akta_perubahan_terakhir = $request->akta_perubahan_terakhir;
        if ($request->has('sk_pengesahan_pendirian_no')) $proposal->sk_pengesahan_pendirian_no = $request->sk_pengesahan_pendirian_no;
        if ($request->has('sk_pengesahan_perubahan_terakhir_no')) $proposal->sk_pengesahan_perubahan_terakhir_no = $request->sk_pengesahan_perubahan_terakhir_no;
        if ($request->has('ktp_no_pimpinan')) $proposal->ktp_no_pimpinan = $request->ktp_no_pimpinan;
        if ($request->has('npwp_no_lembaga')) $proposal->npwp_no_lembaga = $request->npwp_no_lembaga;
        if ($request->has('kriteria_mitra')) $proposal->kriteria_mitra = $request->kriteria_mitra;
        if ($request->has('lembaga_fill_st')) $proposal->lembaga_fill_st = $request->lembaga_fill_st;

        if ($request->has('profil_singkat')) $proposal->profil_singkat = $request->profil_singkat;
        if ($request->has('profil_fill_st')) $proposal->profil_fill_st = $request->profil_fill_st;

        if ($request->has('phone')) $proposal->phone = $request->phone;
        if ($request->has('website')) $proposal->website = $request->website;
        if ($request->has('socmed')) $proposal->socmed = $request->socmed;
        if ($request->has('informasi_fill_st')) $proposal->informasi_fill_st = $request->informasi_fill_st;

        if ($request->has('penanggung_jawab_nm')) $proposal->penanggung_jawab_nm = $request->penanggung_jawab_nm;
        if ($request->has('penanggung_jawab_email')) $proposal->penanggung_jawab_email = $request->penanggung_jawab_email;
        if ($request->has('penanggung_jawab_phone')) $proposal->penanggung_jawab_phone = $request->penanggung_jawab_phone;
        if ($request->has('penanggung_jawab_address')) $proposal->penanggung_jawab_address = $request->penanggung_jawab_address;
        if ($request->has('penanggung_jawab_jabatan')) $proposal->penanggung_jawab_jabatan = $request->penanggung_jawab_jabatan;
        if ($request->has('bank_cd')) $proposal->bank_cd = $request->bank_cd;
        if ($request->has('bank_branch')) $proposal->bank_branch = $request->bank_branch;
        if ($request->has('bank_holder')) $proposal->bank_holder = $request->bank_holder;
        if ($request->has('bank_account_no')) $proposal->bank_account_no = $request->bank_account_no;
        if ($request->has('kontak_fill_st')) $proposal->kontak_fill_st = $request->kontak_fill_st;

        if ($request->has('deskripsi_nama_kegiatan')) $proposal->deskripsi_nama_kegiatan = $request->deskripsi_nama_kegiatan;
        if ($request->has('deskripsi_spesifikasi_kegiatan')) $proposal->deskripsi_spesifikasi_kegiatan = $request->deskripsi_spesifikasi_kegiatan;
        if ($request->has('deskripsi_latar_belakang_usulan')) $proposal->deskripsi_latar_belakang_usulan = $request->deskripsi_latar_belakang_usulan;
        if ($request->has('deskripsi_tujuan_acara')) $proposal->deskripsi_tujuan_acara = $request->deskripsi_tujuan_acara;
        if ($request->has('deskripsi_nominal')) $proposal->deskripsi_nominal = uang($request->deskripsi_nominal);
        if ($request->has('deskripsi_prioritas_penggunaan_dana')) $proposal->deskripsi_prioritas_penggunaan_dana = $request->deskripsi_prioritas_penggunaan_dana;
        if ($request->has('deskripsi_fill_st')) $proposal->deskripsi_fill_st = $request->deskripsi_fill_st;

        if ($request->has('lokasi_nama_gedung')) $proposal->lokasi_nama_gedung = $request->lokasi_nama_gedung;
        if ($request->has('lokasi_region_prop')) $proposal->lokasi_region_prop = $request->lokasi_region_prop;
        if ($request->has('lokasi_region_kab')) $proposal->lokasi_region_kab = $request->lokasi_region_kab;
        if ($request->has('lokasi_region_kec')) $proposal->lokasi_region_kec = $request->lokasi_region_kec;
        if ($request->has('lokasi_komunitas')) $proposal->lokasi_komunitas = $request->lokasi_komunitas;
        if ($request->has('lokasi_fill_st')) $proposal->lokasi_fill_st = $request->lokasi_fill_st;

        if ($request->has('manfaat_bpkh')) $proposal->manfaat_bpkh = $request->manfaat_bpkh;
        if ($request->has('manfaat_haji')) $proposal->manfaat_haji = $request->manfaat_haji;
        if ($request->has('manfaat_kemaslahatan')) $proposal->manfaat_kemaslahatan = $request->manfaat_kemaslahatan;
        if ($request->has('manfaat_lain_lain')) $proposal->manfaat_lain_lain = $request->manfaat_lain_lain;
        if ($request->has('manfaat_fill_st')) $proposal->manfaat_fill_st = $request->manfaat_fill_st;

        if ($request->has('rab_tp')) $proposal->rab_tp = $request->rab_tp;

        // $proposal->type_proposal            = 2;
        $proposal->proposal_no = $request["proposal_no"];

        $proposal->save();
        return response()->json(['status' => 'ok'], 200);
    }

    public function detail_mitra_proposal($id, Request $request)
    {
        $title  = 'Detail Proposal Mitra';
        $proposal = PublicTrxProposalMitra::
            // join('trx_proses_status', 'trx_proses_status.trx_proses_status_id', 'trx_proposal_mitra.proses_st')
            leftJoin('public.trx_mitra_strategis', 'trx_mitra_strategis.trx_mitra_strategis_id', 'trx_proposal_mitra.trx_mitra_strategis_id')
            ->leftJoin('public.com_code as ruang_lingkup_tp', 'ruang_lingkup_tp.com_cd', 'trx_proposal_mitra.ruang_lingkup_child')
            ->find($id);
	if($proposal->proses_st == 'PROSES_TRBP' || $proposal->proses_st == 'PROSES_TKEK'){
	    $proposalmitra = PublicTrxProposalMitra::
            // join('trx_proses_status', 'trx_proses_status.trx_proses_status_id', 'trx_proposal_mitra.proses_st')
            leftJoin('public.trx_mitra_strategis', 'trx_mitra_strategis.trx_mitra_strategis_id', 'trx_proposal_mitra.trx_mitra_strategis_id')
            ->leftJoin('public.com_code as ruang_lingkup_tp', 'ruang_lingkup_tp.com_cd', 'trx_proposal_mitra.ruang_lingkup_child')
            ->find($id);
	}else{
	    $proposalmitra = '';
	}
	$pemohon        = PublicTrxPemohon::find($proposal->trx_pemohon_id);
        $analisisHk    = PublicTrxProposalAnalisisHk::where('trx_proposal_id', $id)->first();
        $banks          = ComBank::all();
        $deskripsi      = PublicTrxProposalLayakTeknisDeskripsi::where('trx_proposal_id', $proposal->trx_proposal_child_id)->first();
        $mitra  = PublicTrxMitraKemaslahatan::find($proposal->trx_mitra_kemaslahatan_id);
        $analisa = PublicTrxProposalLayakTeknisAnalisa::where('trx_proposal_id', $proposal->trx_proposal_child_id)->first();
        $analisisHk = PublicTrxProposalAnalisisHk::where('trx_proposal_id', $proposal->trx_proposal_child_id)->first();
	//dd($analisa);
        $pelaksanaanPenilaian = PublicTrxProposalLayakTeknisPelaksanaanPenilaian::where('trx_proposal_id', $proposal->trx_proposal_child_id)->first();
	$penilaianMitra = PublicTrxProposalPenilaianMitra::where('trx_proposal_id', $proposal->trx_proposal_child_id)->first();
	$analisKepatuhan = PublicTrxProposalAnalisKepatuhan::where('trx_proposal_id', $proposal->trx_proposal_child_id)->first();
	$analisisResiko = PublicTrxProposalAnalisisResiko::where('trx_proposal_id', $proposal->trx_proposal_child_id)->first();
	$flag='';
        if ($proposal->proses_st == 'PROSES_AR') {
            $filename_page = 'detail-mitra';
        } else if ($proposal->proses_st == 'PROSES_AKR') {
            $filename_page = 'detail-mitra';
        } else if ($proposal->proses_st == 'PROSES_ADR') {
            $filename_page = 'detail-mitra';
        } else if ($proposal->proses_st == 'PROSES_AABP') {
            $filename_page = 'detail-mitra';
        } else if ($proposal->proses_st == 'PROSES_H_01') {
            $filename_page = 'detail-hukum';
        } else if ($proposal->proses_st == 'PROSES_H_02') {
            $filename_page = 'detail-hukum';
        } else if ($proposal->proses_st == 'PROSES_K_01') {
            $filename_page = 'detail-kepatuhan';
        } else if ($proposal->proses_st == 'PROSES_K_02') {
            $filename_page = 'detail-kepatuhan';
        } else if ($proposal->proses_st == 'PROSES_HK_03') {
            $filename_page = 'detail-hukumkepatuhan';
        } else if ($proposal->proses_st == 'PROSES_HK_04') {
            $filename_page = 'detail-hukumkepatuhan';
        } else if ($proposal->proses_st == 'PROSES_AMR_01') {
            $filename_page = 'detail-manajresiko';
        } else if ($proposal->proses_st == 'PROSES_AMR_02') {
            $filename_page = 'detail-manajresiko';
        } else if ($proposal->proses_st == 'PROSES_AMR_03') {
            $filename_page = 'detail-manajresiko';
        } else if ($proposal->proses_st == 'PROSES_AMR_04') {
            $filename_page = 'detail-manajresiko';
        } else if ($proposal->proses_st == 'PROSES_TRBP') {
            $filename_page = 'detail-rapat-bp';
        }else if ($proposal->proses_st == 'PROSES_TKEK') {
            $filename_page = 'detail-rapat-bp';
        }

        return view('proposal::' . $this->folder_path . '.' . $filename_page, compact('flag','proposal','analisKepatuhan', 'penilaianMitra', 'analisisHk', 'pemohon', 'title', 'deskripsi', 'mitra', 'analisa', 'banks', 'pelaksanaanPenilaian', 'analisisHk', 'proposalmitra','analisisResiko'));
    }

    public function send_proposal_mitra($id, Request $request)
    {
        $pemohon = \App\Models\PublicTrxProposalMitra::where('trx_proposal_child_id', $id)->first();
        if ($pemohon) {
	    $proposalmitra = \App\Models\PublicTrxProposalMitra::find($pemohon->trx_proposal_mitra_id);
            $proposal = \App\Models\PublicTrxProposal::find($id);
            if ($request["status"] == 'kembalikan') {
                if ($request["proses"] == 'PROSES_AR') {
                    $proposalmitra->proses_st = 'PROSES_AMK';
                    $proposal->proses_st = 'PROSES_AMK';
                } else if ($request["proses"] == 'PROSES_AKR') {
                    $proposalmitra->proses_st = 'PROSES_AR';
                    $proposal->proses_st = 'PROSES_AR';
                } else if ($request["proses"] == 'PROSES_ADR') {
                    $proposalmitra->proses_st = 'PROSES_AKR';
                    $proposal->proses_st = 'PROSES_AKR';
                } else if ($request["proses"] == 'PROSES_AABP') {
                    $proposalmitra->proses_st = 'PROSES_ADR';
                    $proposal->proses_st = 'PROSES_ADR';
                } else if ($request["proses"] == 'PROSES_H_01') {
                    $proposalmitra->proses_st = 'PROSES_AABP';
                    $proposal->proses_st = 'PROSES_AABP';
                } else if ($request["proses"] == 'PROSES_H_02') {
                    $proposalmitra->proses_st = 'PROSES_H_01';
                    $proposal->proses_st = 'PROSES_H_01';
                } else if ($request["proses"] == 'PROSES_K_01') {
                    $proposalmitra->proses_st = 'PROSES_H_02';
                    $proposal->proses_st = 'PROSES_H_02';
                } else if ($request["proses"] == 'PROSES_K_02') {
                    $proposalmitra->proses_st = 'PROSES_K_01';
                    $proposal->proses_st = 'PROSES_K_01';
                } else if ($request["proses"] == 'PROSES_HK_03') {
                    $proposalmitra->proses_st = 'PROSES_K_02';
                    $proposal->proses_st = 'PROSES_K_02';
                } else if ($request["proses"] == 'PROSES_HK_04') {
                    $proposalmitra->proses_st = 'PROSES_HK_03';
                    $proposal->proses_st = 'PROSES_HK_03';
                } else if ($request["proses"] == 'PROSES_AMR_01') {
                    $proposalmitra->proses_st = 'PROSES_HK_04';
                    $proposal->proses_st = 'PROSES_HK_04';
                } else if ($request["proses"] == 'PROSES_AMR_02') {
                    $proposalmitra->proses_st = 'PROSES_AMR_01';
                    $proposal->proses_st = 'PROSES_AMR_01';
                } else if ($request["proses"] == 'PROSES_AMR_03') {
                    $proposalmitra->proses_st = 'PROSES_AMR_02';
                    $proposal->proses_st = 'PROSES_AMR_02';
                } else if ($request["proses"] == 'PROSES_AMR_04') {
                    $proposalmitra->proses_st = 'PROSES_AMR_03';
                    $proposal->proses_st = 'PROSES_AMR_03';
                }else if ($request["proses"] == 'PROSES_TRBP') {
                    $proposalmitra->proses_st = 'PROSES_AMR_04';
                    $proposal->proses_st = 'PROSES_AMR_04';
                }else if ($request["proses"] == 'PROSES_TKEK') {
                    $proposalmitra->proses_st = 'PROSES_AMR_04';
                    $proposal->proses_st = 'PROSES_AMR_04';
                }else if ($request["proses"] == 'PROSES_RBP') {
                    $proposalmitra->proses_st = 'PROSES_TRBP';
                    $proposal->proses_st = 'PROSES_TRBP';
                }else if ($request["proses"] == 'PROSES_KEK') {
                    $proposalmitra->proses_st = 'PROSES_TKEK';
                    $proposal->proses_st = 'PROSES_TKEK';
                }else if ($request["proses"] == 'PROSES_TERIMA') {
                    $proposalmitra->proses_st = 'PROSES_KEK';
                    $proposal->proses_st = 'PROSES_KEK';
                }else if ($request["proses"] == 'PROSES_TERIMA') {
                    $proposalmitra->proses_st = 'PROSES_RBP';
                    $proposal->proses_st = 'PROSES_RBP';
                }

            } else {
                if ($request["proses"] == 'PROSES_AMK') {
                    $proposalmitra->proses_st = 'PROSES_AR';
                    $proposal->proses_st = 'PROSES_AR';
                } else if ($request["proses"] == 'PROSES_AR') {
                    $proposalmitra->proses_st = 'PROSES_AKR';
                    $proposal->proses_st = 'PROSES_AKR';
                } else if ($request["proses"] == 'PROSES_AKR') {
                    $proposalmitra->proses_st = 'PROSES_ADR';
                    $proposal->proses_st = 'PROSES_ADR';
                } else if ($request["proses"] == 'PROSES_ADR') {
                    $proposalmitra->proses_st = 'PROSES_AABP';
                    $proposal->proses_st = 'PROSES_AABP';
                } else if ($request["proses"] == 'PROSES_AABP') {
                    $proposalmitra->proses_st = 'PROSES_H_01';
                    $proposal->proses_st = 'PROSES_H_01';
                } else if ($request["proses"] == 'PROSES_H_01') {
                    $proposalmitra->proses_st = 'PROSES_H_02';
                    $proposal->proses_st = 'PROSES_H_02';
                } else if ($request["proses"] == 'PROSES_H_02') {
                    $proposalmitra->proses_st = 'PROSES_K_01';
                    $proposal->proses_st = 'PROSES_K_01';
                } else if ($request["proses"] == 'PROSES_K_01') {
                    $proposalmitra->proses_st = 'PROSES_K_02';
                    $proposal->proses_st = 'PROSES_K_02';
                } else if ($request["proses"] == 'PROSES_K_02') {
                    $proposalmitra->proses_st = 'PROSES_HK_03';
                    $proposal->proses_st = 'PROSES_HK_03';
                } else if ($request["proses"] == 'PROSES_HK_03') {
                    $proposalmitra->proses_st = 'PROSES_HK_04';
                    $proposal->proses_st = 'PROSES_HK_04';
                } else if ($request["proses"] == 'PROSES_HK_04') {
                    $proposalmitra->proses_st = 'PROSES_AMR_01';
                    $proposal->proses_st = 'PROSES_AMR_01';
                } else if ($request["proses"] == 'PROSES_AMR_01') {
                    $proposalmitra->proses_st = 'PROSES_AMR_02';
                    $proposal->proses_st = 'PROSES_AMR_02';
                } else if ($request["proses"] == 'PROSES_AMR_02') {
                    $proposalmitra->proses_st = 'PROSES_AMR_03';
                    $proposal->proses_st = 'PROSES_AMR_03';
                }else if ($request["proses"] == 'PROSES_AMR_03') {
                    $proposalmitra->proses_st = 'PROSES_AMR_04';
                    $proposal->proses_st = 'PROSES_AMR_04';
                }else if ($request["proses"] == 'PROSES_AMR_04' && $request["last_status"] == 'PROSES_RAPAT_BP') {
                    $proposalmitra->proses_st = 'PROSES_TRBP';
                    $proposal->proses_st = 'PROSES_TRBP';
                }else if ($request["proses"] == 'PROSES_AMR_04' && $request["last_status"] == 'PROSES_RAPAT_KEK') {
                    $proposalmitra->proses_st = 'PROSES_TKEK';
                    $proposal->proses_st = 'PROSES_TKEK';
                }else if ($request["proses"] == 'PROSES_TRBP') {
                    $proposalmitra->proses_st = 'PROSES_RBP';
                    $proposal->proses_st = 'PROSES_RBP';
                }else if ($request["proses"] == 'PROSES_TKEK') {
                    $proposalmitra->proses_st = 'PROSES_KEK';
                    $proposal->proses_st = 'PROSES_KEK';
                }else if ($request["proses"] == 'PROSES_KEK') {
                    $proposalmitra->proses_st = 'PROSES_RBP';
                    $proposal->proses_st = 'PROSES_RBP';
                }else if ($request["proses"] == 'PROSES_RBP') {
                    $proposalmitra->proses_st = 'PROSES_TERIMA';
                    $proposal->proses_st = 'PROSES_TERIMA';
                }

            }
	    $proposalmitra->save();
            $proposal->save();
            return response()->json(['status' => 'ok'], 200);
        } else {
            return response()->json(['status' => 'error'], 400);
        }
    }
   public function viewbp(Request $request)
    {
	$param = \Request::segment(2);
        $baseUrl = 'proposal';
        $filename_page     = 'list-rapat-bp';
	if($param == 'rapatkek'){
		$title             = 'List Rapat KEK';
	}else{
		$title             = 'List Rapat BP';
	}
        
        \LogActivity::saveLog(
            $logTp = 'visit',
            $logNm = "Membuka Menu $title"
        );
        return view('proposal::' . $this->folder_path . '.' . $filename_page, compact('title', 'baseUrl'));
    }

    public function viewkek(Request $request)
    {
	$param = \Request::segment(2);
        $baseUrl = 'proposal';
        $filename_page     = 'list-rapat-kek';
	if($param == 'rapatkek'){
		$title             = 'List Rapat KEK';
	}else{
		$title             = 'List Rapat BP';
	}
        
        \LogActivity::saveLog(
            $logTp = 'visit',
            $logNm = "Membuka Menu $title"
        );
        return view('proposal::' . $this->folder_path . '.' . $filename_page, compact('title', 'baseUrl'));
    }


    public function getRapatBp(Request $request)
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
            ->where('trx_proposal_mitra.proses_st', $request['last_status'])
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
	    ->addColumn('nominal', function ($data) {
		$id = $data->trx_proposal_child_id != '' ? $data->trx_proposal_child_id : $data->trx_proposal_mitra_id;
		$total = \App\Models\PublicTrxProposalRAB::select(DB::raw('sum(total_bpkh) as nominal_rekomendasi'))->where('trx_proposal_id', $data->trx_proposal_child_id)->first();
                return $total->nominal_rekomendasi;
            })
            ->addColumn('trx_proposal_uid', function ($data) {
                return $data->trx_proposal_mitra_id;
            })
            ->addColumn('proses_st_nm', function ($data) {
                return "<span class='badge badge-info d-block'>" . substr($data->proses_st, 7, strlen($data->proses_st)) . ' - ' . $data->proses_nm . "</span>";
            })
            ->addColumn('ruang_lingkup_nm', function ($data) {
                if ($data->ruang_lingkup == "RUANG_LINGKUP_1") {
                    return 'Reguler - ' . $data->ruang_lingkup_nm;
                } else {
                    return 'Tanggap Darurat - ' . $data->ruang_lingkup_nm;
                }
            })
            ->addColumn('order_column', function ($data) {
                // if (!empty(PublicTrxProsesStatus::getStatus($data->trx_proposal_mitra_id))) {
                //     return (int)1;
                // } else {
                //     return (int)0;
                // }
                return "ok";
            })
            ->addColumn('actions', function ($data) {
                $actions = '';
		//<button id="form-proposal" class="btn btn-sm btn-warning mx-1 px-2" data-bind=' . $data->trx_proposal_child_id . '>Form Proposal</button>
		//<button id="klasifikasi" class="btn btn-sm btn-success mx-1 px-2" data-bind=' . $data->trx_proposal_child_id . ' data-status=' . $data->proses_st . '>Klasifikasi</button>
		if(isRoleUser(['regas']) && $data->proses_st == 'PROSES_RBP'){
		    $button = '<a href="' . url('proposal') . "/rapat/" . $data->trx_proposal_child_id . '/show" class="btn btn-sm btn-info mx-1 px-2"><i class="icon icon-search4"></i></a>
			       <button id="izinkan-rapat" class="btn btn-sm btn-primary mx-1 px-2" data-bind=' . $data->trx_proposal_child_id . ' data-status=' . $data->proses_st . '>Izinkan</button>
			       <button id="kembalikan-rapat" class="btn btn-sm btn-danger mx-1 px-2" data-bind=' . $data->trx_proposal_child_id . ' data-status=' . $data->proses_st . '>Tolak</button>';
		}else if(isRoleUser(['regas']) && $data->proses_st == 'PROSES_KEK'){
		    $button = '<a href="' . url('proposal') . "/rapat/" . $data->trx_proposal_child_id . '/show" class="btn btn-sm btn-info mx-1 px-2"><i class="icon icon-search4"></i></a>
			       <button id="izinkan-rapat" class="btn btn-sm btn-primary mx-1 px-2" data-bind=' . $data->trx_proposal_child_id . ' data-status=' . $data->proses_st . '>Izinkan</button>
			       <button id="kembalikan-rapat" class="btn btn-sm btn-danger mx-1 px-2" data-bind=' . $data->trx_proposal_child_id . ' data-status=' . $data->proses_st . '>Tolak</button>';

		}else{
		    $button = '<a href="' . url('proposal') . "/rapat/" . $data->trx_proposal_child_id . '/show" class="btn btn-sm btn-info mx-1 px-2"><i class="icon icon-search4"></i></a>';
		}
                $actions .= '<div class="d-flex justify-content-center">
			    ' . $button .'
			     </div>';
                return $actions;
            })
            ->rawColumns(['proses_st_nm', 'actions', 'trx_proposal_id'])
            ->addIndexColumn()
            ->make(true);
    } 

    public function getKeputusanRbp(Request $request)
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
            ->where('trx_proposal_mitra.proses_st', $request['last_status'])
            ->orWhere('trx_proposal_mitra.proses_st','PROSES_PPP')
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
                // if (!empty(PublicTrxProsesStatus::getStatus($data->trx_proposal_mitra_id))) {
                //     return (int)1;
                // } else {
                //     return (int)0;
                // }
                return "ok";
            })
            ->addColumn('actions', function ($data) {
                $actions = '';
		//<button id="form-proposal" class="btn btn-sm btn-warning mx-1 px-2" data-bind=' . $data->trx_proposal_child_id . '>Form Proposal</button>
		//<button id="klasifikasi" class="btn btn-sm btn-success mx-1 px-2" data-bind=' . $data->trx_proposal_child_id . ' data-status=' . $data->proses_st . '>Klasifikasi</button>
		//if(isRoleUser(['regas']) && $data->proses_st == 'PROSES_RBP'){
		//    $button = '<a href="' . url('proposal') . "/rapat/" . $data->trx_proposal_child_id . '/show" class="btn btn-sm btn-info mx-1 px-2"><i class="icon icon-search4"></i></a>
		//	       <button id="izinkan-rapat" class="btn btn-sm btn-primary mx-1 px-2" data-bind=' . $data->trx_proposal_child_id . ' data-status=' . $data->proses_st . '>Izinkan</button>
		//	       <button id="kembalikan-rapat" class="btn btn-sm btn-danger mx-1 px-2" data-bind=' . $data->trx_proposal_child_id . ' data-status=' . $data->proses_st . '>Tolak</button>';
		//}else if(isRoleUser(['regas']) && $data->proses_st == 'PROSES_KEK'){
		//    $button = '<a href="' . url('proposal') . "/rapat/" . $data->trx_proposal_child_id . '/show" class="btn btn-sm btn-info mx-1 px-2"><i class="icon icon-search4"></i></a>
		//	       <button id="izinkan-rapat" class="btn btn-sm btn-primary mx-1 px-2" data-bind=' . $data->trx_proposal_child_id . ' data-status=' . $data->proses_st . '>Izinkan</button>
		//	       <button id="kembalikan-rapat" class="btn btn-sm btn-danger mx-1 px-2" data-bind=' . $data->trx_proposal_child_id . ' data-status=' . $data->proses_st . '>Tolak</button>';

		//}else{
		    $button = '<a href="' . url('proposal') . "/keputusan-rbp/" . $data->trx_proposal_child_id . '/show" class="btn btn-sm btn-info mx-1 px-2"><i class="icon icon-search4"></i></a>';
		//}
                $actions .= '<div class="d-flex justify-content-center">
			    ' . $button .'
			     </div>';
                return $actions;
            })
            ->rawColumns(['proses_st_nm', 'actions', 'trx_proposal_id'])
            ->addIndexColumn()
            ->make(true);
    }
    
    public function showrapatbp($id, Request $request)
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
	    $flag='rapat';
	$filename_page     = 'detail-rapat-bp';
        $title             = $proposal->proses_st == 'PROSES_RBP' ? 'Detail Rapat BP' : ' Detail Rapat KEK';
        \LogActivity::saveLog(
            $logTp = 'visit',
            $logNm = "Membuka Menu $title"
        );
        return view('proposal::' . $this->folder_path . '.' . $filename_page, compact('flag', 'title','analisKepatuhan','penilaianMitra','mitra','analisa','analisisHk','pelaksanaanPenilaian', 'deskripsi','proposal', 'pemohon', 'userPemohon', 'banks', 'disposisi', 'lastStatus', 'lastPejabat', 'lastScreaning', 'status', 'rekomendasiPejabat', 'baseUrl','proposalmitra','analisisResiko'));
    }

    public function showkeputusanrbp($id, Request $request)
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
	    $filename_page     = 'detail-keputusan-rbp';
            $title             = 'Detail Keputusan RBP';
        \LogActivity::saveLog(
            $logTp = 'visit',
            $logNm = "Membuka Menu $title"
        );
        return view('proposal::' . $this->folder_path . '.' . $filename_page, compact('status','title','analisKepatuhan','penilaianMitra','mitra','analisa','analisisHk','pelaksanaanPenilaian', 'deskripsi','proposal', 'pemohon', 'userPemohon', 'banks', 'disposisi', 'lastStatus', 'lastPejabat', 'lastScreaning', 'rekomendasiPejabat', 'baseUrl','proposalmitra','analisisResiko'));
    }



    public function simpan_klasifikasi(Request $request){
        $check = KlasifikasiProposal::where('trx_proposal_id',$request["trx_proposal_mitra_id"])->first();
	if($check){
	    $data = KlasifikasiProposal::find($check->trx_klasifikasi_id);
	    $data->trx_proposal_id = $request["trx_proposal_mitra_id"];
	    $data->klasifikasi_catatan = $request["klasifikasi_catatan"];
            $data->tipe_klasifikasi = $request["kategori_kajian"];
	    $data->save();
	}else{
	    $data = new KlasifikasiProposal();
	    $data->trx_proposal_id = $request["trx_proposal_mitra_id"];
	    $data->klasifikasi_catatan = $request["klasifikasi_catatan"];
            $data->tipe_klasifikasi = $request["kategori_kajian"];
	    $data->save();
	}
	return response()->json(['status' => 'ok'],200); 
    }

    public function ubah_proposal_rbp(Request $request){
        $check = PublicTrxProposalMitra::where('trx_proposal_child_id', $request["trx_proposal_mitra_id"])->first();
	if($check){
	    $data = PublicTrxProposalMitra::find($check->trx_proposal_mitra_id);
	    $data->judul_proposal = $request["judul_proposal_rbp"];
	    $data->ruang_lingkup = $request["ruang_lingkup"];
            $data->nominal = $request["nominal"];
	    $data->save();
	}

	return redirect(url('/proposal/rapatbp'));
    }

    public function simpan_analis_resiko(Request $request){
	//dd($request->all());
        $check = PublicTrxProposalAnalisisResiko::where('trx_proposal_id', $request["childid"])->first();
	//dd($check);
	if($check){
	    $data = PublicTrxProposalAnalisisResiko::find($check->trx_proposal_analisis_resiko_id);
	    //$data->judul_proposal = $request["mitra_kemaslahatan"];
	    $data->trx_proposal_id = $request["childid"];
	    $data->resiko_reputasi = $request["resiko_reputasi"];
            $data->resiko_keberlanjutan= $request["resiko_keberlanjutan"];
            $data->mitigasi_resiko_reputasi = $request["mitigasi_resiko"];
            $data->mitigasi_resiko_keberlanjutan = $request["mitigasi_resiko"];
	    $data->dasar_hukum = $request["dasar_hukum"];
            $data->mitra_kemaslahatan = $request["mitra_kemaslahatan"];
            $data->kesimpulan = $request["kesimpulan"];
	    $data->save();
	}else{
	    $data = new PublicTrxProposalAnalisisResiko();
	    $data->trx_proposal_id = $request["childid"];
	    $data->resiko_reputasi = $request["resiko_reputasi"];
            $data->resiko_keberlanjutan= $request["resiko_keberlanjutan"];
            $data->mitigasi_resiko_reputasi = $request["mitigasi_resiko"];
            $data->mitigasi_resiko_keberlanjutan = $request["mitigasi_resiko"];
	    $data->dasar_hukum = $request["dasar_hukum"];
            $data->mitra_kemaslahatan = $request["mitra_kemaslahatan"];
            $data->kesimpulan = $request["kesimpulan"];
	    $data->save();
	}
	return response()->json(['status' => 'ok'],200); 
    }


    public function ambil_data_proposal(Request $request){
        $check = PublicTrxProposalMitra::select('judul_proposal','nominal','ruang_lingkup')->where('trx_proposal_child_id', $request["trx_proposal_mitra_id"])->first();
	return response()->json($check);
    }

   function ringkasan($id){
	$proposal = PublicTrxProposal::join('trx_proses_status', 'trx_proses_status.trx_proses_status_id', 'trx_proposal.proses_st')
                ->leftJoin('public.trx_mitra_strategis', 'trx_mitra_strategis.trx_mitra_strategis_id', 'trx_proposal.trx_mitra_strategis_id')
		->leftJoin('public.trx_pemohon', 'trx_pemohon.trx_pemohon_id', 'trx_proposal.trx_pemohon_id')
                ->find($id);
	$data = PublicTrxProposalMitra::
            // join('trx_proses_status', 'trx_proses_status.trx_proses_status_id', 'trx_proposal_mitra.proses_st')
            leftJoin('public.trx_mitra_strategis', 'trx_mitra_strategis.trx_mitra_strategis_id', 'trx_proposal_mitra.trx_mitra_strategis_id')
            ->leftJoin('public.com_code as ruang_lingkup_tp', 'ruang_lingkup_tp.com_cd', 'trx_proposal_mitra.ruang_lingkup_child')
	    ->leftJoin('public.trx_pemohon', 'trx_pemohon.trx_pemohon_id', 'trx_proposal_mitra.trx_pemohon_id')
            ->where('trx_proposal_child_id', $proposal->trx_proposal_id)->first();
	$deskripsi      = PublicTrxProposalLayakTeknisDeskripsi::where('trx_proposal_id', $proposal->trx_proposal_id)->first();
	$pelaksanaanPenilaian = PublicTrxProposalLayakTeknisPelaksanaanPenilaian::where('trx_proposal_id', $proposal->trx_proposal_id)->first();
        if ($data) {
            $resultName = date('Ymd_His')."_SK_$id.pdf";

            $view       = view('proposal::print.ringkasan.ringkasan', compact('data','deskripsi','pelaksanaanPenilaian'))->render();
            // return $view;
            $pdf        = PDF::loadHtml($view);
            $pdf->setOptions(['isHtml5ParserEnabled' => true, 'setIsRemoteEnabled' => true]);
            $pdf->setPaper('Legal', 'potrait');
            return $pdf->stream($resultName);
        }else{
            return redirect()->back()->with('error',"Tidak ada data yang sesuai dengan kriteria yang dipilih");
        }
    }

   function surat_pernyataan($id){
	$proposal = PublicTrxProposal::join('trx_proses_status', 'trx_proses_status.trx_proses_status_id', 'trx_proposal.proses_st')
                ->leftJoin('public.trx_mitra_strategis', 'trx_mitra_strategis.trx_mitra_strategis_id', 'trx_proposal.trx_mitra_strategis_id')
		->leftJoin('public.trx_pemohon', 'trx_pemohon.trx_pemohon_id', 'trx_proposal.trx_pemohon_id')
                ->find($id);
	$data = PublicTrxProposalMitra::
            // join('trx_proses_status', 'trx_proses_status.trx_proses_status_id', 'trx_proposal_mitra.proses_st')
            leftJoin('public.trx_mitra_strategis', 'trx_mitra_strategis.trx_mitra_strategis_id', 'trx_proposal_mitra.trx_mitra_strategis_id')
            ->leftJoin('public.com_code as ruang_lingkup_tp', 'ruang_lingkup_tp.com_cd', 'trx_proposal_mitra.ruang_lingkup_child')
	    ->leftJoin('public.trx_pemohon', 'trx_pemohon.trx_pemohon_id', 'trx_proposal_mitra.trx_pemohon_id')
            ->where('trx_proposal_child_id', $proposal->trx_proposal_id)->first();
	$deskripsi      = PublicTrxProposalLayakTeknisDeskripsi::where('trx_proposal_id', $proposal->trx_proposal_id)->first();
	$pelaksanaanPenilaian = PublicTrxProposalLayakTeknisPelaksanaanPenilaian::where('trx_proposal_id', $proposal->trx_proposal_id)->first();
	$mitra = PublicTrxMitraKemaslahatan::where('trx_mitra_kemaslahatan_id', $proposal->trx_mitra_kemaslahatan_id)->first();
        if ($data) {
            $resultName = date('Ymd_His')."_SP_$id.pdf";

            $view       = view('proposal::print.sp.sp', compact('data','deskripsi','pelaksanaanPenilaian','mitra'))->render();
	    //dd($view);
            // return $view;
            $pdf        = PDF::loadHtml($view);
            $pdf->setOptions(['isHtml5ParserEnabled' => true, 'setIsRemoteEnabled' => true]);
            $pdf->setPaper('Legal', 'potrait');
            return $pdf->stream($resultName);
        }else{
            return redirect()->back()->with('error',"Tidak ada data yang sesuai dengan kriteria yang dipilih");
        }
    }

    public function download_assesment_file($file){
	$file_decode = implode('', json_decode($file));
	$files = storage_path("app/public/assessment-file/" . $file_decode);
    	$headers = array(
              'Content-Type: application/pdf',
              'Content-Type: application/jpg',
              'Content-Type: application/jpeg',
              'Content-Type: application/xlsx',
         );
    	return Response::download($files, 'file-assessment', $headers);	
    }

}
