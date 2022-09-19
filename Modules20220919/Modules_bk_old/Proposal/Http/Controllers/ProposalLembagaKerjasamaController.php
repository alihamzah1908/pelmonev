<?php

namespace Modules\Proposal\Http\Controllers;

use DB;
use Auth;
use DataTables;
use App\Models\PublicTrxProposalLembagaKerjasama;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProposalLembagaKerjasamaController extends Controller
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
        $data = PublicTrxProposalLembagaKerjasama::where('trx_proposal_id',$request->id);

        return DataTables::of($data)->make(true);
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

            $pengurus                   = new PublicTrxProposalLembagaKerjasama;
            $pengurus->trx_proposal_id  = $request->id;
            $pengurus->lembaga_nm       = $request->lembaga_nm;
            $pengurus->kegiatan_nm      = $request->kegiatan_nm;
            $pengurus->nominal_bantuan  = uang($request->nominal_bantuan);
            $pengurus->note             = $request->note;
            $pengurus->created_by       = Auth::user()->user_id;
            $pengurus->save();
            DB::commit();

            \LogActivity::saveLog(
                $logTp      = 'create', 
                $logNm      = "Membuat Data Kerjasama Lembaga Proposal $request->id", 
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
