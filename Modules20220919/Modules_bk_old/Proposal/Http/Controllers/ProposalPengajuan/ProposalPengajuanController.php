<?php

namespace Modules\Proposal\Http\Controllers\ProposalPengajuan;

use App\Models\ComBank;
use App\Models\ComCode;
use App\Models\PublicTrxProposal;
use Auth;
use DB;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProposalPengajuanController extends Controller
{
    function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $banks          = ComBank::all();
        return view('proposal::proposal-pengajuan.pengajuan', compact('banks'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $proposal                = new PublicTrxProposal;

            $proposal->trx_mitra_kemaslahatan_id            = $request->trx_mitra_kemaslahatan_id;
            $proposal->judul_proposal                       = $request->judul_proposal;
            $proposal->nominal                              = uang($request->nominal);
            $proposal->ruang_lingkup                        = $request->ruang_lingkup;
            $proposal->uraian_singkat_proposal              = $request->uraian_singkat_proposal;
            $proposal->note                                 = $request->note;
            $proposal->proposal_fill_st                     = $request->proposal_fill_st;
            $proposal->proposal_latitude                    = $request->proposal_latitude;
            $proposal->proposal_longitude                   = $request->proposal_longitude;
            $proposal->region_prop                          = $request->region_prop;
            $proposal->region_kab                           = $request->region_kab;
            $proposal->region_kec                           = $request->region_kec;
            $proposal->address                              = $request->address;

            $proposal->akta_pendirian                       = $request->akta_pendirian;
            $proposal->akta_perubahan_terakhir              = $request->akta_perubahan_terakhir;
            $proposal->sk_pengesahan_pendirian_no           = $request->sk_pengesahan_pendirian_no;
            $proposal->sk_pengesahan_perubahan_terakhir_no  = $request->sk_pengesahan_perubahan_terakhir_no;
            $proposal->ktp_no_pimpinan                      = $request->ktp_no_pimpinan;
            $proposal->npwp_no_lembaga                      = $request->npwp_no_lembaga;
            $proposal->kriteria_mitra                       = $request->kriteria_mitra;
            $proposal->lembaga_fill_st                      = $request->lembaga_fill_st;

            $proposal->profil_singkat                       = $request->profil_singkat;
            $proposal->profil_fill_st                       = $request->profil_fill_st;

            $proposal->phone                                = $request->phone;
            $proposal->website                              = $request->website;
            $proposal->socmed                               = $request->socmed;
            $proposal->informasi_fill_st                    = $request->informasi_fill_st;

            $proposal->penanggung_jawab_nm                  = $request->penanggung_jawab_nm;
            $proposal->penanggung_jawab_email               = $request->penanggung_jawab_email;
            $proposal->penanggung_jawab_phone               = $request->penanggung_jawab_phone;
            $proposal->bank_cd                              = $request->bank_cd;
            $proposal->bank_branch                          = $request->bank_branch;
            $proposal->bank_holder                          = $request->bank_holder;
            $proposal->bank_account_no                      = $request->bank_account_no;
            $proposal->kontak_fill_st                       = $request->kontak_fill_st;

            $proposal->lokasi_nama_gedung                   = $request->lokasi_nama_gedung;
            $proposal->lokasi_region_prop                   = $request->lokasi_region_prop;
            $proposal->lokasi_region_kab                    = $request->lokasi_region_kab;
            $proposal->lokasi_region_kec                    = $request->lokasi_region_kec;
            $proposal->lokasi_komunitas                     = $request->lokasi_komunitas;
            $proposal->lokasi_fill_st                       = $request->lokasi_fill_st;

            $proposal->created_by                           = Auth::user()->user_id;
            $proposal->save();
            DB::commit();

            \LogActivity::saveLog(
                $logTp      = 'create', 
                $logNm      = "Menambahkan Proposal", 
                $table      = $proposal->getTable(), 
                $newData    = $proposal
            );

            return response()->json(['status' => 'ok'],200); 

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }
}
