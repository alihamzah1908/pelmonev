<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Illuminate\Http\Request;
use App\Models\AuthUser;
use App\Models\ComCode;
use App\Models\PublicTrxProposal;
use App\Models\PublicTrxProposalFiles;
use App\Models\PublicTrxProposalTimeline;
use App\Models\PublicTrxProposalLayakTeknis;
use App\Models\PublicTrxProposalLayakTeknisAnalisa;
use App\Models\PublicTrxProposalLayakTeknisDeskripsi;
use App\Models\PublicTrxProposalPenilaian;
use App\Models\PublicTrxProposalLayakTeknisPelaksanaanPenilaian;
use App\Models\PublicTrxKuotaProposal;

use Ramsey\Uuid\Uuid;

class PemohonProposalController extends Controller
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
    public function index(Request $request)
    {
        $title = "Beranda";
        return view('home', compact('title'));
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
            $proposal->trx_pemohon_id               = Auth::user()->default_key;
            $proposal->judul_proposal               = $request->judul_proposal;
            $proposal->nominal                      = uang($request->nominal);
            $proposal->ruang_lingkup                = $request->ruang_lingkup;
            $proposal->ruang_lingkup_child          = $request->ruang_lingkup_child;
            $proposal->region_prop                  = $request->region_prop;
            $proposal->region_kab                   = $request->region_kab;
            $proposal->region_kec                   = $request->region_kec;
            $proposal->region_kel                   = $request->region_kel;
            $proposal->uraian_singkat_proposal      = $request->uraian_singkat_proposal;
            $proposal->note                         = $request->note;
            $proposal->kuota_wilayah                = $request->region_prop;
            
            if (isRoleUser('mitra')) {
                $proposal->trx_mitra_kemaslahatan_id = Auth::user()->default_key;
            }

            if (isRoleUser('regas')) {
                $proposal->trx_pemohon_id = $request->trx_pemohon_id;
                $proposal->kuota_wilayah        = 'NASIONAL';
                // $proposal->kuota_ruang_lingkup  = 'NASIONAL';
            }

            $proposal->proposal_fill_st             = '1';
            if ($request->submit == 1) {
                $proposal->proses_st                = 'PROSES_KBP';   
            }else {
                $proposal->proses_st                = 'PROSES_CPM';
            }
            $proposal->created_by                   = Auth::user()->user_id;
            $proposal->save();
            if ($request->submit == 2) {
                $proposal->type_proposal            = 2;
                $proposal->proposal_no              = 'LG'.$proposal->created_at->format('m/d/Y') . '/' . $proposal->region_prop. '/' . $proposal->region_kel;
            }else {
                $proposal->type_proposal            = 1;
                $proposal->proposal_no              = 'ST'.$proposal->created_at->format('m/d/Y') . '/' . $proposal->region_prop. '/' . $proposal->region_kel;
            }
            $proposal->save();
            PublicTrxProposalTimeline::insertTimeline($proposal->trx_proposal_id, Auth::user()->user_nm, 'PROSES_01', '', '');
            PublicTrxProposalTimeline::insertTimeline($proposal->trx_proposal_id, Auth::user()->user_nm, $proposal->proses_st, '', '');

            PublicTrxProposalLayakTeknis::insertLayakTeknis($proposal->trx_proposal_id);
            PublicTrxProposalPenilaian::insertPenilaian($proposal->trx_proposal_id);
            PublicTrxProposalLayakTeknisAnalisa::insertLayakTeknisAnalisa($proposal->trx_proposal_id);
            PublicTrxProposalLayakTeknisDeskripsi::insertLayakTeknisDeskripsi($proposal->trx_proposal_id);
            PublicTrxProposalLayakTeknisPelaksanaanPenilaian::insertLayakTeknisPelaksanaanPenilaian($proposal->trx_proposal_id);
            
            $files = ComCode::where('code_group','FILE_TP')->get();
            
            foreach ($files as $item) {
                $saveFile                   = new PublicTrxProposalFiles;
                $saveFile->trx_proposal_id  = $proposal->trx_proposal_id;
                $saveFile->file_tp          = $item->com_cd;
                $saveFile->created_by       = Auth::user()->user_id;
                $saveFile->save();
            }

            DB::commit();
            if ($request->submit == 2) {
                \LogActivity::saveLog(
                    $logTp      = 'create', 
                    $logNm      = "Membuat Long Proposal", 
                    $table      = $proposal->getTable(), 
                    $newData    = $proposal
                ); 
                
                return response()->json(['status' => 'ok', 'id' => $proposal->trx_proposal_id],200); 
            }else {
                \LogActivity::saveLog(
                    $logTp      = 'create', 
                    $logNm      = "Membuat Short Proposal", 
                    $table      = $proposal->getTable(), 
                    $newData    = $proposal
                ); 
                
                return response()->json(['status' => 'oks'],200); 
            }
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    function checkKuota(Request $request){
        $kuotaWilayah = PublicTrxKuotaProposal::checkKuota($request->region_prop, 'wilayah', uang($request->nominal)); 
        if ($kuotaWilayah == FALSE) {
            return response()->json(['status' => 'failed','msg' => "KUOTA WILAYAH SUDAH HABIS"],200); 
        }

        $kuotaRuangLingkup = PublicTrxKuotaProposal::checkKuota($request->ruang_lingkup, 'ruanglingkup', uang($request->nominal)); 
        if ($kuotaRuangLingkup == FALSE) {
            return response()->json(['status' => 'failed','msg' => "KUOTA RUANG LINGKUP SUDAH HABIS"],200); 
        }

        return response()->json(['status' => 'ok'],200); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    function upload(Request $request){
        try {
            DB::beginTransaction();

            $proposal                  = new PublicTrxProposal;
            $proposal->trx_pemohon_id  = Auth::user()->default_key;
            $proposal->proses_st       = 'PROSES_01D';
            
            if (isRoleUser('mitra')) {
                $proposal->trx_mitra_kemaslahatan_id = Auth::user()->default_key;
            }
            
            $proposal->created_by      = Auth::user()->user_id;
            $proposal->save();

            if($request->hasFile('file_short_proposal')) {
                $file = $request->file('file_short_proposal');
                $name = Uuid::uuid4().".".$file->getClientOriginalExtension();
                $image['filePath'] = $name;     
                $file->move(storage_path('app/public/proposal-file/'), $name);

                $saveFile                   = new PublicTrxProposalFiles;
                $saveFile->trx_proposal_id  = $proposal->trx_proposal_id;
                $saveFile->file_tp          = 'FILE_TP_05';
                $saveFile->file_ext         = $file->getClientOriginalExtension();
                $saveFile->file_path        = $name;
                $saveFile->created_by       = Auth::user()->user_id;
                $saveFile->save();
            }

            if($request->hasFile('file_akte_pendirian')) {
                $file = $request->file('file_akte_pendirian');
                $name = Uuid::uuid4().".".$file->getClientOriginalExtension();
                $image['filePath'] = $name;     
                $file->move(storage_path('app/public/proposal-file/'), $name);

                $saveFile                   = new PublicTrxProposalFiles;
                $saveFile->trx_proposal_id  = $proposal->trx_proposal_id;
                $saveFile->file_tp          = 'FILE_TP_09';
                $saveFile->file_ext         = $file->getClientOriginalExtension();
                $saveFile->file_path        = $name;
                $saveFile->created_by       = Auth::user()->user_id;
                $saveFile->save();
            }

            if($request->hasFile('file_akte_perubahan')) {
                $file = $request->file('file_akte_perubahan');
                $name = Uuid::uuid4().".".$file->getClientOriginalExtension();
                $image['filePath'] = $name;     
                $file->move(storage_path('app/public/proposal-file/'), $name);

                $saveFile                   = new PublicTrxProposalFiles;
                $saveFile->trx_proposal_id  = $proposal->trx_proposal_id;
                $saveFile->file_tp          = 'FILE_TP_10';
                $saveFile->file_ext         = $file->getClientOriginalExtension();
                $saveFile->file_path        = $name;
                $saveFile->created_by       = Auth::user()->user_id;
                $saveFile->save();
            }

            if($request->hasFile('file_sk_pendirian')) {
                $file = $request->file('file_sk_pendirian');
                $name = Uuid::uuid4().".".$file->getClientOriginalExtension();
                $image['filePath'] = $name;     
                $file->move(storage_path('app/public/proposal-file/'), $name);

                $saveFile                   = new PublicTrxProposalFiles;
                $saveFile->trx_proposal_id  = $proposal->trx_proposal_id;
                $saveFile->file_tp          = 'FILE_TP_11';
                $saveFile->file_ext         = $file->getClientOriginalExtension();
                $saveFile->file_path        = $name;
                $saveFile->created_by       = Auth::user()->user_id;
                $saveFile->save();
            }

            if($request->hasFile('file_sk_perubahan')) {
                $file = $request->file('file_sk_perubahan');
                $name = Uuid::uuid4().".".$file->getClientOriginalExtension();
                $image['filePath'] = $name;     
                $file->move(storage_path('app/public/proposal-file/'), $name);

                $saveFile                   = new PublicTrxProposalFiles;
                $saveFile->trx_proposal_id  = $proposal->trx_proposal_id;
                $saveFile->file_tp          = 'FILE_TP_12';
                $saveFile->file_ext         = $file->getClientOriginalExtension();
                $saveFile->file_path        = $name;
                $saveFile->created_by       = Auth::user()->user_id;
                $saveFile->save();
            }

            PublicTrxProposalTimeline::insertTimeline($proposal->trx_proposal_id, Auth::user()->user_nm, 'PROSES_01', '', '');
            PublicTrxProposalTimeline::insertTimeline($proposal->trx_proposal_id, Auth::user()->user_nm, $proposal->proses_st, '', '');
            PublicTrxProposalLayakTeknis::insertLayakTeknis($proposal->trx_proposal_id);
            PublicTrxProposalPenilaian::insertPenilaian($proposal->trx_proposal_id);
            PublicTrxProposalLayakTeknisAnalisa::insertLayakTeknisAnalisa($proposal->trx_proposal_id);
            PublicTrxProposalLayakTeknisDeskripsi::insertLayakTeknisDeskripsi($proposal->trx_proposal_id);
            PublicTrxProposalLayakTeknisPelaksanaanPenilaian::insertLayakTeknisPelaksanaanPenilaian($proposal->trx_proposal_id);

            $files = ComCode::where('code_group','FILE_TP')->whereNotIn('com_cd',['FILE_TP_05','FILE_TP_09','FILE_TP_10','FILE_TP_11','FILE_TP_12'])->get();
            
            foreach ($files as $item) {
                $saveFile                   = new PublicTrxProposalFiles;
                $saveFile->trx_proposal_id  = $proposal->trx_proposal_id;
                $saveFile->file_tp          = $item->com_cd;
                $saveFile->created_by       = Auth::user()->user_id;
                $saveFile->save();
            }

            $user               = AuthUser::find(Auth::user()->user_id);
            $user->phone        = $request->phone;
            $user->updated_by   = Auth::user()->user_id;
            $user->save();
            
            DB::commit();

            \LogActivity::saveLog(
                $logTp      = 'create', 
                $logNm      = "Upload Proposal", 
                $table      = $proposal->getTable(), 
                $newData    = $proposal
            );
 
            return redirect('proposal-penerima-manfaat')->with('success', 'Berhasil Kirim Proposal');

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    
}
