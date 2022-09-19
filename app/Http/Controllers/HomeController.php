<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;


use App\Models\ComCode;
use App\Models\ComRegion;

use App\Models\PublicTrxKuotaProposal;
use DB;
use Auth;
use DataTables;

use Illuminate\Http\Request;
use App\Models\AuthMenu;
use App\Models\PublicTrxProposal;
use App\Models\PublicTrxProsesStatus;
use App\Models\PublicTrxPemohon;

use App\Mail\NotifSent;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    function __construct(){
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request): \Illuminate\Contracts\Support\Renderable
    {
        $title                  = "Beranda";
        $dataPenyebaranProposal = [];
        $rekapProposal          = PublicTrxProposal::select(
            "region_cd_maps",
            DB::Raw("count(*) as jumlah")
        )
            ->join('public.com_region','com_region.region_cd','trx_proposal.region_prop')
            ->groupBy("region_cd_maps")
            ->get();

        foreach ($rekapProposal as $item) {
            $dataPenyebaranProposal[] = [$item->region_cd_maps, (int)($item->jumlah)];
        }

        $daftar_provinsi = ComRegion::select('region_cd', 'region_nm')
            ->where('region_level', '=', 1)
            ->orderBy('region_nm')
            ->get();
        $prov_color = [];
        foreach ($daftar_provinsi as $prov) {
            // ambil pagu
            $total_pagu = 0;
            $data_kuota = PublicTrxKuotaProposal::select('kuota')
                ->where("trx_year", '=', (int)date('Y'))
                //->where('region_cd', '=', $prov->region_cd) // BPK INTERNAL
                ->get();
            if (count($data_kuota) > 0) {
                $total_pagu = (float)$data_kuota[0]->kuota;
            }


            // ambil total proposal
            $sum_nominal = 0;
            $summary_proposal = PublicTrxProposal::select(DB::raw("sum(nominal) as sum_nominal"))
                ->where('region_prop', '=', $prov->region_cd)
                ->whereRaw("EXTRACT(YEAR from trx_proposal.created_at)::int = ".date('Y'))
                ->get();
            $sum_nominal = (float)$summary_proposal[0]->sum_nominal;

            //$sisa_alokasi = $total_pagu - $sum_nominal;

            // Handle division by zero
            $sisa_alokasi = 0;
            if(!empty($total_pagu)){
                $sisa_alokasi = 1 - ($sum_nominal / $total_pagu);
            }

            $color = '#FFFF00';
            if ($sisa_alokasi >= 0.1) {
                $color = '#00B050';
            } elseif ($sisa_alokasi == 0) {
                $color = '#FF0000';
            } elseif ($sisa_alokasi < 0) {
                $color = '#000000';
            }
            $prov_color[strtoupper($prov->region_nm)] = $color;
        }

        return view('home_shp', compact('title','dataPenyebaranProposal', 'prov_color'));
    }

    public function dashMs(Request $request) {
        $title = "Dashboard Mitra Strategis";
        return view('dash_ms', compact('title'));
    }

    public function reportRekapTotalRealisasiMitra(Request $request) {
        $title = "Rekap Total Realisasi Mitra";
        return view('rep_rekap_total_realisasi_mitra', compact('title'));
    }

    public function reportRekapTotalPerAsnaf(Request $request) {
        $title = "Rekap Total Per Asnaf";
        return view('rep_rekap_total_per_asnaf', compact('title'));
    }

    public function reportRekapTotalPerProvinsiPerAlokasiPerAsnaf(Request $request) {
        $title = "Rekap Total per-Provinsi per-Alokasi per-Asnaf";
        return view('rep_rekap_total_per_provinsi_alokasi_asnaf', compact('title'));
    }

    public function reportRekapKeuangan(Request $request) {
        $title = "Rekap Keuangan";
        return view('rep_rekap_keuangan', compact('title'));
    }

    public function reportRekapPengembalianKeKasHaji(Request $request) {
        $title = "Rekap Pengembalian ke Kas Haji";
        return view('rep_rekap_pengembalian_kas_haji', compact('title'));
    }

    public function reportRekapLPJ(Request $request) {
        $title = "Rekap LPJ";
        return view('rep_rekap_lpj', compact('title'));
    }

    public function dashPencairan(Request $request) {
        $year = $request->query('tahun', '');

        $yearFilter = !empty($year) ? $year : (int)date('Y');

        $aweekBefore = date('Y-m-d', strtotime('-7 days'));
        $todayDate = date('Y-m-d');

        $total_pagu = 0;
        $data_kuota = PublicTrxKuotaProposal::select('kuota')
            ->where("trx_year", '=', $yearFilter)
            ->get();
        if (count($data_kuota) > 0) {
            $total_pagu = (float)$data_kuota[0]->kuota;
        }

        // Alokasi (Kolom 1)
        $summary_nominal_alokasi = PublicTrxProposal::select(DB::raw("sum(nominal) as sum_nominal"))
                ->whereRaw("updated_at between '".$aweekBefore."' and '".$todayDate."'")
                ->where('proses_st', 'Proses_27B')
                ->get();

        $sum_nominal_alokasi = (float)$summary_nominal_alokasi[0]->sum_nominal;
        $persen_alokasi = 0;
        if(!empty($total_pagu)){
            $persen_alokasi = ($sum_nominal_alokasi / $total_pagu) * 100;
        }

        // total persetujuan (Kolom 2)
        $summary_nominal_persetujuan = PublicTrxProposal::select(DB::raw("sum(nominal) as sum_nominal"))
                ->whereRaw("EXTRACT(YEAR from trx_proposal.created_at)::int = ".$yearFilter)
                ->where('proses_st', 'Proses_27B')
                ->get();

        $sum_nominal_persetujuan = (float)$summary_nominal_persetujuan[0]->sum_nominal;
        $persen_persetujuan = 0;
        if(!empty($total_pagu)){
            $persen_persetujuan = ($sum_nominal_persetujuan / $total_pagu) * 100;
        }

        // total pengajuan BP (Kolom 3)
        $summary_nominal_total_pengajuan_bp = PublicTrxProposal::select(DB::raw("sum(nominal) as sum_nominal"))
                ->whereRaw("EXTRACT(YEAR from trx_proposal.created_at)::int = ".$yearFilter)
                ->where('proses_st', 'PROSES_24')
                ->get();

        $sum_nominal_total_pengajuan_bp = (float)$summary_nominal_total_pengajuan_bp[0]->sum_nominal;
        $persen_total_pengajuan_bp = 0;
        if(!empty($total_pagu)){
            $persen_total_pengajuan_bp = ($sum_nominal_total_pengajuan_bp / $total_pagu) * 100;
        }

         // total sk lengkap (Kolom 4)
        $summary_nominal_total_sk_lengkap = PublicTrxProposal::select(DB::raw("sum(nominal) as sum_nominal"))
                ->whereRaw("EXTRACT(YEAR from trx_proposal.created_at)::int = ".$yearFilter)
                ->where('proses_st', 'PROSES_28B')
                ->get();

        $sum_nominal_total_sk_lengkap = (float)$summary_nominal_total_sk_lengkap[0]->sum_nominal;
        $persen_total_sk_lengkap = 0;
        if(!empty($total_pagu)){
            $persen_total_sk_lengkap = ($sum_nominal_total_sk_lengkap / $total_pagu) * 100;
        }

         // total sk lengkap (Kolom 5)
        $summary_nominal_total_menunggu_sk_lengkap = PublicTrxProposal::select(DB::raw("sum(nominal) as sum_nominal"))
                ->whereRaw("EXTRACT(YEAR from trx_proposal.created_at)::int = ".$yearFilter)
                ->where('proses_st', 'PROSES_27B')
                ->get();

        $sum_nominal_total_menunggu_sk_lengkap = (float)$summary_nominal_total_menunggu_sk_lengkap[0]->sum_nominal;
        // dump($sum_nominal_total_menunggu_sk_lengkap);
        // dump($total_pagu);
        $persen_total_menunggu_sk_lengkap = 0;
        if(!empty($total_pagu)){
            $persen_total_menunggu_sk_lengkap = ($sum_nominal_total_menunggu_sk_lengkap / $total_pagu) * 100;
        }

          // total sk lengkap (Kolom 6)
        $summary_nominal_total_pinbuk = PublicTrxProposal::select(DB::raw("sum(nominal) as sum_nominal"))
                ->whereRaw("EXTRACT(YEAR from trx_proposal.created_at)::int = ".$yearFilter)
                ->where('proses_st', 'PROSES_30')
                ->get();

        $sum_nominal_total_pinbuk = (float)$summary_nominal_total_pinbuk[0]->sum_nominal;
        $persen_total_pinbuk = 0;
        if(!empty($total_pagu)){
            $persen_total_pinbuk = ($sum_nominal_total_pinbuk / $total_pagu) * 100;
        }


         // total sk lengkap (Kolom 9)
        $summary_nominal_total_menunggu_doc_lengkap = PublicTrxProposal::select(DB::raw("sum(nominal) as sum_nominal"))
                ->whereRaw("EXTRACT(YEAR from trx_proposal.created_at)::int = ".$yearFilter)
                ->where('proses_st', 'PROSES_35ABC')
                ->get();

        $sum_nominal_total_menunggu_doc_lengkap = (float)$summary_nominal_total_menunggu_doc_lengkap[0]->sum_nominal;
        $persen_total_menunggu_doc_lengkap = 0;
        if(!empty($total_pagu)){
            $persen_total_menunggu_doc_lengkap = ($sum_nominal_total_menunggu_doc_lengkap / $total_pagu) * 100;
        }



        $title = "Dashboard Pencairan";
        $data = [
            'alokasi' => [
                'nominal' => "Rp " . number_format($total_pagu,0,',','.'),
                'persen' => $persen_alokasi.'%'
            ],
            'total_persetujuan' => [
                'nominal' => "Rp " . number_format($sum_nominal_persetujuan,0,',','.'),
                'persen' => $persen_persetujuan.'%'
            ],
            'total_pengajuan_bp' => [
                'nominal' => "Rp " . number_format($sum_nominal_total_pengajuan_bp,0,',','.'),
                'persen' => $persen_total_pengajuan_bp.'%'
            ],
            'total_sk_lengkap' => [
                'nominal' => "Rp " . number_format($sum_nominal_total_sk_lengkap,0,',','.'),
                'persen' => $persen_total_sk_lengkap.'%'
            ],
            'total_menunggu_sk_lengkap' => [
                'nominal' => "Rp " . number_format($sum_nominal_total_menunggu_sk_lengkap,0,',','.'),
                'persen' => $persen_total_menunggu_sk_lengkap.'%'
            ],
            'total_pinbuk' => [
                'nominal' => "Rp " . number_format($sum_nominal_total_pinbuk,0,',','.'),
                'persen' => $persen_total_pinbuk.'%'
            ],
            'total_sk_lengkap_blm_pinbuk' => [
                'nominal' => "Rp " . number_format($sum_nominal_total_pengajuan_bp - $sum_nominal_total_menunggu_sk_lengkap,0,',','.'),
                'persen' => '0%'
            ],
            'total_pencairan_mitra' => [
                'nominal' => "Rp 0",
                'persen' => '0%'
            ],
            'total_pencairan_termin' => [
                'nominal' => "Rp 0",
                'persen' => '0%'
            ],
            'total_menunggu_doc_lengkap' => [
                'nominal' => "Rp " . number_format($sum_nominal_total_menunggu_doc_lengkap,0,',','.'),
                'persen' => $persen_total_menunggu_doc_lengkap.'%'
            ],
            'total_eff_pengembalian' => [
                'nominal' => "Rp 0",
                'persen' => '0%'
            ]
        ];
        return view('dash_pencairan', compact('title', 'data', 'yearFilter'));
    }

    public function dashRealisasi(Request $request) {

        $prov = $request->query('prov', '');
        $tahun = $request->query('tahun', date('Y'));

        $SATUAN = 1000000;
        $title = "Dashboard Realisasi Anggaran";

        $data_kuota = PublicTrxKuotaProposal::select(DB::raw("sum(trx_kuota_proposal.kuota) as sum_kuota"))
        // BPKH Internal Region CD tidak ada di table trx_kuota_proposal
        // ->when(!empty($prov), function ($query) use ($prov) {
        //     return $query->where('region_cd', '=', $prov);
        // })
        ->where("trx_year", '=', (int) $tahun)
        ->get();

        $total_pagu = round(((float)$data_kuota[0]->sum_kuota) / $SATUAN, 2);

        $summary_proposal = PublicTrxProposal::select(DB::raw("sum(nominal) as sum_nominal"))
        ->when(!empty($prov), function ($query) use ($prov) {
            return $query->where('region_prop', '=', $prov);
        })
        ->whereRaw("EXTRACT(YEAR from trx_proposal.created_at)::int = ".$tahun)
        ->get();
        $sum_nominal = round(((float)$summary_proposal[0]->sum_nominal) / $SATUAN, 2);

        $gap = [];
        $gapVal = abs($total_pagu -  $sum_nominal);

        if($total_pagu < $sum_nominal){
            $gap = [
                'value' => $gapVal,
                'color' => '#FF0000'
            ];
        }else if($total_pagu > $sum_nominal){
            $gap = [
                'value' => $gapVal,
                'color' => '#FFFF00'
            ];
        }else{
            $gap = [
                'value' => 0,
                'color' => '#000'
            ];
        }

        $gapVal = $gap['value'];
        $gapColor = $gap['color'];

        $summary_proposal2 = PublicTrxProposal::select("nominal", 'proses_st')
        ->when(!empty($prov), function ($query) use ($prov) {
            return $query->where('region_prop', '=', $prov);
        })
        ->whereRaw("EXTRACT(YEAR from trx_proposal.created_at)::int = ".date('Y'))
        ->get();


        $proposalMasuk = 0;
        $proposalKajian = 0;
        $proposalRealisasi = 0;


        foreach($summary_proposal2 as $summary_proposal2_item) {
            //dump($summary_proposal2_item['nominal']);
            //dump($summary_proposal2_item['proses_st']);

            $statusNum = (int) substr($summary_proposal2_item['proses_st'], 7, 2);
            if($statusNum > 27){
                if(!empty($summary_proposal2_item['nominal'])){
                    $proposalRealisasi += round(((float)$summary_proposal2_item['nominal']) / $SATUAN, 2);
                }
            }else if(in_array($statusNum, range(17,27))){
                if(!empty($summary_proposal2_item['nominal'])){
                    $proposalKajian += round(((float)$summary_proposal2_item['nominal']) / $SATUAN, 2);
                }
            }else{
                if(!empty($summary_proposal2_item['nominal'])){
                    $proposalMasuk += round(((float)$summary_proposal2_item['nominal']) / $SATUAN, 2);
                }
            }
            //dump('=================================');
        }

        // dump($proposalMasuk);
        // dump($proposalKajian);
        // dump($proposalRealisasi);





        return view('dash_realisasi', compact('title', 'gapVal', 'gapColor', 'sum_nominal', 'proposalMasuk', 'proposalKajian', 'proposalRealisasi', 'prov', 'tahun'));
    }

    public function dashboardPelaksanaanMonev(Request $request) {
        $title = "Dashboard Pelaksanaan dan Monev";
        return view('dash_pelaksanaan_monev', compact('title'));
    }

    public function dashboardPelaksanaanMonevMitra(Request $request, $mitra_id) {
        $title = "Dashboard Pelaksanaan dan Monev Per Mitra";
        return view('dash_pelaksanaan_monev_mitra', compact('title'));
    }

    public function dashboardPelaksanaanMonevKegiatan(Request $request, $kegiatan_id) {
        $title = "Dashboard Pelaksanaan dan Monev Per Kegiatan";
        return view('dash_pelaksanaan_monev_kegiatan', compact('title'));
    }

    public function dashMonitoringSt(Request $request) {
        $title = "Dashboard Monitoring dan Serah Terima";
        return view('dash_monst', compact('title'));
    }


    function getPemohon(){
        $data = PublicTrxPemohon::select(
            "pemohon_nm",
            "pemohon_latitude",
            "pemohon_longitude",
            "address"
        )->get();

        return response()->json(['status' => 'ok', 'data' => $data],200);
    }

    function getProposal(){
        $data = PublicTrxProposal::select(
            "judul_proposal",
            "proposal_latitude",
            "proposal_longitude",
            "address"
        )->get();

        return response()->json(['status' => 'ok', 'data' => $data],200);
    }

    /**
     * Show : DataTables
     *
     * @return \Illuminate\Http\Response
     */
    public function detailDashboard(Request $request)
    {
        $data = PublicTrxProposal::select(
            'trx_proposal_id',
            'judul_proposal',
            'ruang_lingkup',
            'ruang_lingkup_tp.code_nm as ruang_lingkup_nm',
            'trx_proposal.region_prop as region_prop',
            'propinsi.region_nm as region_prop_nm',
            'nominal',
            'trx_proposal.trx_mitra_kemaslahatan_id',
            'mitra.mitra_kemaslahatan_nm',
            'trx_proposal.trx_mitra_kemaslahatan_id as trx_mitra_strategis_id',
            'mitra.mitra_kemaslahatan_nm as mitra_strategis_nm'

        )
            ->leftJoin('public.trx_pemohon as pemohon','pemohon.trx_pemohon_id','trx_proposal.trx_pemohon_id')
            ->leftJoin('public.trx_mitra_kemaslahatan as pemohon_mitra','pemohon_mitra.trx_mitra_kemaslahatan_id','trx_proposal.trx_pemohon_id')
            ->join('public.trx_proses_status as status','status.trx_proses_status_id','trx_proposal.proses_st')
            ->leftJoin('public.trx_mitra_kemaslahatan as mitra','mitra.trx_mitra_kemaslahatan_id','trx_proposal.trx_mitra_kemaslahatan_id')
            ->leftJoin('public.com_code as ruang_lingkup_tp','ruang_lingkup_tp.com_cd','trx_proposal.ruang_lingkup')
            ->leftJoin('public.com_region as propinsi','propinsi.region_cd','trx_proposal.region_prop')
            ->where(function($query) use ($request){

                if($request->tahun != ''){
                    $query->whereRaw("EXTRACT(YEAR from trx_proposal.created_at)::int = '$request->tahun'::int");
                }

                if($request->mitra_kemaslahatan != ''){
                    $query->where('trx_proposal.trx_mitra_kemaslahatan_id', $request->mitra_kemaslahatan);
                }

                if($request->mitra_strategis != ''){
                    $query->where('trx_proposal.trx_mitra_kemaslahatan_id', $request->mitra_kemaslahatan);
                }

                if($request->provinsi != ''){
                    $query->where('trx_proposal.region_prop', $request->provinsi);
                }

            });

        return DataTables::of($data)
            ->addColumn('proses_st_nm', function($data){
                return "<span class='badge badge-info d-block'>".substr($data->proses_st,7,strlen($data->proses_st)).' - '.$data->proses_nm."</span>";

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

    public function detailProvinsi(Request $request): \Illuminate\Http\JsonResponse
    {
        // ambil daftar ruang lingkup
        $daftar_ruang_lingkup = ComCode::select('com_cd', 'code_nm')->where('code_group', '=', 'RUANG_LINGKUP')->get();
        // ambil kode provinsi
        $daftar_provinsi = ComRegion::select('region_cd')->whereRaw("upper(region_nm) = '". strtoupper($request->provinsi)."'")->get();
        $kode_provinsi = '';
        foreach ($daftar_provinsi as $item) {
            $kode_provinsi = $item->region_cd;
        }

        $total_nominal = 0;
        $num_item = PublicTrxProposal::where('region_prop', '=', $kode_provinsi)
            ->whereRaw("EXTRACT(YEAR from trx_proposal.created_at)::int = '$request->tahun'::int")
            ->count();
        $ret = [];
        $ret['Provinsi'] = $request->provinsi;
        $ret['Jumlah Kegiatan'] = $num_item. " Proposal <a href='#' id='daftar-proposal-peta'><strong>[detail]</strong></a>";

        foreach ($daftar_ruang_lingkup as $item) {
            $summary_proposal = PublicTrxProposal::select(DB::raw("sum(nominal) as sum_nominal"))
                ->where('ruang_lingkup', '=', $item->com_cd)
                ->where('region_prop', '=', $kode_provinsi)
                ->whereRaw("EXTRACT(YEAR from trx_proposal.created_at)::int = '$request->tahun'::int")
                ->get();
            $sum_nominal = (float)$summary_proposal[0]->sum_nominal;
            $total_nominal += $sum_nominal;
            $ret['Nilai Total '.$item->code_nm] = number_format($sum_nominal,0, ',', '.') ;
        }
        $data_kuota = PublicTrxKuotaProposal::select('kuota')
            ->whereRaw("trx_year = '$request->tahun'::int")
            //->where('region_cd', '=', $kode_provinsi) // BPKH Internal
            ->get();

        $ret['Total Nilai Bantuan'] = number_format($total_nominal,0, ',', '.') ;
        $total_pagu_provinsi = 0;
        foreach ($data_kuota as $item) {
            $total_pagu_provinsi = $item->kuota;
        }
        $ret['Nilai Pagu Total Provinsi'] = number_format($total_pagu_provinsi,0, ',', '.') ;
        $sisa_alokasi = $total_pagu_provinsi - $total_nominal;
        $ret['Sisa Alokasi'] = number_format($sisa_alokasi,0, ',', '.') ;

        return response()->json(['status' => 'ok', 'kode_provinsi' => $kode_provinsi, 'data' => $ret],200);
    }

    function testEmail(){
        $dataUser = DB::table('auth.users as user')
                    ->select('user_nm', 'email')
                    ->join('auth.role_users as ru','ru.user_id', 'user.user_id')
                    ->join('auth.roles as role','role.role_cd', 'ru.role_cd')
                    ->where('role.role_cd', 'pelmonev')
                    ->get();

        foreach($dataUser as $itemUser){
            Mail::to($itemUser->email)->send(new NotifSent('emails.notif',  [
                'nama' => $itemUser->user_nm,
                'judulProposal' => 'www.test-email.com',
                'prosesStatus' => 'status proposal test'
            ]));
        }

         dd("SUCCESS");

    }
}
