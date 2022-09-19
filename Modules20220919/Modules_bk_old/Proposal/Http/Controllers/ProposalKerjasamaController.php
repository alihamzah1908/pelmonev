<?php

namespace Modules\Proposal\Http\Controllers;

use DB;
use Auth;
use DataTables;
use App\Models\PublicTrxProposalKerjasama;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProposalKerjasamaController extends Controller
{
    private $folder_path = '';
    
    function __construct(){
        $this->middleware('auth');
    }

    /**
     * Show : DataTables
     *
     * @return \Illuminate\Http\Response
     */
    function getData(Request $request){
        $data = PublicTrxProposalKerjasama::where('trx_proposal_id',$request->id);

        return DataTables::of($data)->addIndexColumn()->make(true);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    function store(Request $request){
        try {
            DB::beginTransaction();

            $pengurus                       = new PublicTrxProposalKerjasama;
            $pengurus->trx_proposal_id      = $request->id;
            $pengurus->jenis_kontraprestasi = $request->kerjasama_jenis_kontraprestasi;
            $pengurus->jumlah               = $request->kerjasama_jumlah;
            $pengurus->nama_paket           = $request->kerjasama_nama_paket;
            $pengurus->note                 = $request->note;
            $pengurus->created_by           = Auth::user()->user_id;
            $pengurus->save();  
            DB::commit();

            \LogActivity::saveLog(
                $logTp      = 'create', 
                $logNm      = "Membuat Data Kerjasama Proposal $request->id", 
                $table      = $pengurus->getTable(), 
                $newData    = $pengurus
            );

            return response()->json(['status' => 'ok'],200); 

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

}
