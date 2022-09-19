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

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SPKegiatanKemaslahatanController extends Controller
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
        $baseUrl        = 'sp-kegiatan';
        
        if ($id) {
            $filename_page 	= 'detail';
            $title 			= 'Detail SP Kegiatan Kemaslahatan';
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

            return view('proposal::' . $this->folder_path . '.' . $filename_page, compact('title', 'proposal', 'pemohon','userPemohon','banks','disposisi','lastStatus', 'status', 'baseUrl'));
        }else{
            $filename_page 	= 'index';
            $title 			= 'SP Kegiatan Kemaslahatan';
            
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
                    'proses_st',
                    'status.proses_nm'
                )
                ->join('public.trx_pemohon as pemohon','pemohon.trx_pemohon_id','trx_proposal.trx_pemohon_id')
                ->join('public.trx_proses_status as status','status.trx_proses_status_id','trx_proposal.proses_st')
                ->leftJoin('public.trx_mitra_kemaslahatan as mitra','mitra.trx_mitra_kemaslahatan_id','trx_proposal.trx_mitra_kemaslahatan_id')
                ->leftJoin('public.com_code as ruang_lingkup_tp','ruang_lingkup_tp.com_cd','trx_proposal.ruang_lingkup')
                ->where(function($query) use($request){
                    $query->whereIn('proses_st', [
                        'PROSES_28AB'
                    ]);

                    if (isRoleUser('mitra')) {
                        $query->where('trx_proposal.trx_mitra_kemaslahatan_id',Auth::user()->default_key);
                    }

                    if ($request->judul != '') {
                        $query->where("judul_proposal", "ILIKE" ,'%'.$request->judul.'%');
                    }
                });

        return DataTables::of($data)
            ->addColumn('proses_st_nm', function($data){
                return "<span class='badge badge-info d-block'>".substr($data->proses_st,-2).' - '.$data->proses_nm."</span>";
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
     * @return \Illuminate\Http\Response
     */
    function store(Request $request){
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
    function update(Request $request, $id){
        try {
            DB::beginTransaction();

            $proposal                = PublicTrxProposal::find($id);
            $oldData = $proposal;

            if($request->has('trx_mitra_kemaslahatan_id')) $proposal->trx_mitra_kemaslahatan_id = $request->trx_mitra_kemaslahatan_id;
            if($request->has('judul_proposal')) $proposal->judul_proposal = $request->judul_proposal;
            if($request->has('nominal')) $proposal->nominal = uang($request->nominal);
            if($request->has('ruang_lingkup')) $proposal->ruang_lingkup = $request->ruang_lingkup;
            if($request->has('uraian_singkat_proposal')) $proposal->uraian_singkat_proposal = $request->uraian_singkat_proposal;
            if($request->has('note')) $proposal->note = $request->note;
            if($request->has('proposal_fill_st')) $proposal->proposal_fill_st = $request->proposal_fill_st;
            if($request->has('proposal_latitude')) $proposal->proposal_latitude = $request->proposal_latitude;
            if($request->has('proposal_longitude')) $proposal->proposal_longitude = $request->proposal_longitude;
            if($request->has('region_prop')) $proposal->region_prop = $request->region_prop;
            if($request->has('region_kab')) $proposal->region_kab = $request->region_kab;
            if($request->has('region_kel')) $proposal->region_kel = $request->region_kel;
            if($request->has('region_kec')) $proposal->region_kec = $request->region_kec;
            if($request->has('address')) $proposal->address = $request->address;

            if($request->has('akta_pendirian')) $proposal->akta_pendirian = $request->akta_pendirian;
            if($request->has('akta_perubahan_terakhir')) $proposal->akta_perubahan_terakhir = $request->akta_perubahan_terakhir;
            if($request->has('sk_pengesahan_pendirian_no')) $proposal->sk_pengesahan_pendirian_no = $request->sk_pengesahan_pendirian_no;
            if($request->has('sk_pengesahan_perubahan_terakhir_no')) $proposal->sk_pengesahan_perubahan_terakhir_no = $request->sk_pengesahan_perubahan_terakhir_no;
            if($request->has('ktp_no_pimpinan')) $proposal->ktp_no_pimpinan = $request->ktp_no_pimpinan;
            if($request->has('npwp_no_lembaga')) $proposal->npwp_no_lembaga = $request->npwp_no_lembaga;
            if($request->has('kriteria_mitra')) $proposal->kriteria_mitra = $request->kriteria_mitra;
            if($request->has('lembaga_fill_st')) $proposal->lembaga_fill_st = $request->lembaga_fill_st;

            if($request->has('profil_singkat')) $proposal->profil_singkat = $request->profil_singkat;
            if($request->has('profil_fill_st')) $proposal->profil_fill_st = $request->profil_fill_st;

            if($request->has('phone')) $proposal->phone = $request->phone;
            if($request->has('website')) $proposal->website = $request->website;
            if($request->has('socmed')) $proposal->socmed = $request->socmed;
            if($request->has('informasi_fill_st')) $proposal->informasi_fill_st = $request->informasi_fill_st;

            if($request->has('penanggung_jawab_nm')) $proposal->penanggung_jawab_nm = $request->penanggung_jawab_nm;
            if($request->has('penanggung_jawab_email')) $proposal->penanggung_jawab_email = $request->penanggung_jawab_email;
            if($request->has('penanggung_jawab_phone')) $proposal->penanggung_jawab_phone = $request->penanggung_jawab_phone;
            if($request->has('bank_cd')) $proposal->bank_cd = $request->bank_cd;
            if($request->has('bank_branch')) $proposal->bank_branch = $request->bank_branch;
            if($request->has('bank_holder')) $proposal->bank_holder = $request->bank_holder;
            if($request->has('bank_account_no')) $proposal->bank_account_no = $request->bank_account_no;
            if($request->has('kontak_fill_st')) $proposal->kontak_fill_st = $request->kontak_fill_st;

            if($request->has('deskripsi_nama_kegiatan')) $proposal->deskripsi_nama_kegiatan = $request->deskripsi_nama_kegiatan;
            if($request->has('deskripsi_spesifikasi_kegiatan')) $proposal->deskripsi_spesifikasi_kegiatan = $request->deskripsi_spesifikasi_kegiatan;
            if($request->has('deskripsi_latar_belakang_usulan')) $proposal->deskripsi_latar_belakang_usulan = $request->deskripsi_latar_belakang_usulan;
            if($request->has('deskripsi_tujuan_acara')) $proposal->deskripsi_tujuan_acara = $request->deskripsi_tujuan_acara;
            if($request->has('deskripsi_nominal')) $proposal->deskripsi_nominal = uang($request->deskripsi_nominal);
            if($request->has('deskripsi_prioritas_penggunaan_dana')) $proposal->deskripsi_prioritas_penggunaan_dana = $request->deskripsi_prioritas_penggunaan_dana;
            if($request->has('deskripsi_fill_st')) $proposal->deskripsi_fill_st = $request->deskripsi_fill_st;
            
            if($request->has('lokasi_nama_gedung')) $proposal->lokasi_nama_gedung = $request->lokasi_nama_gedung;
            if($request->has('lokasi_region_prop')) $proposal->lokasi_region_prop = $request->lokasi_region_prop;
            if($request->has('lokasi_region_kab')) $proposal->lokasi_region_kab = $request->lokasi_region_kab;
            if($request->has('lokasi_region_kec')) $proposal->lokasi_region_kec = $request->lokasi_region_kec;
            if($request->has('lokasi_komunitas')) $proposal->lokasi_komunitas = $request->lokasi_komunitas;
            if($request->has('lokasi_fill_st')) $proposal->lokasi_fill_st = $request->lokasi_fill_st;
            
            if($request->has('manfaat_bpkh')) $proposal->manfaat_bpkh = $request->manfaat_bpkh;
            if($request->has('manfaat_haji')) $proposal->manfaat_haji = $request->manfaat_haji;
            if($request->has('manfaat_kemaslahatan')) $proposal->manfaat_kemaslahatan = $request->manfaat_kemaslahatan;
            if($request->has('manfaat_lain_lain')) $proposal->manfaat_lain_lain = $request->manfaat_lain_lain;
            if($request->has('manfaat_fill_st')) $proposal->manfaat_fill_st = $request->manfaat_fill_st;

            $proposal->updated_by    = Auth::user()->user_id;
            $proposal->save();
            DB::commit();

            \LogActivity::saveLog(
                $logTp      = 'update', 
                $logNm      = "Mengubah Data Proposal $id", 
                $table      = $proposal->getTable(), 
                $oldData    = $oldData, 
                $newData    = $proposal
            );

            return response()->json(['status' => 'ok'],200); 

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }
}
