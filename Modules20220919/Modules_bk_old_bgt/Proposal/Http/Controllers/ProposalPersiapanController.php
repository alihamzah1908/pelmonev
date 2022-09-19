<?php

namespace Modules\Proposal\Http\Controllers;

use DB;
use Auth;
use DataTables;
use App\Models\PublicTrxProposalPersiapan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProposalPersiapanController extends Controller
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
        $data = PublicTrxProposalPersiapan::where('trx_proposal_id',$request->id);

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

            $pengurus                   = new PublicTrxProposalPersiapan;
            $pengurus->trx_proposal_id  = $request->id;
            $pengurus->komponen_persiapan = $request->persiapan_komponen;
            $pengurus->progress         = $request->persiapan_progress;
            $pengurus->note             = $request->note;
            $pengurus->created_by       = Auth::user()->user_id;
            $pengurus->save();
            DB::commit();

            \LogActivity::saveLog(
                $logTp      = 'create', 
                $logNm      = "Membuat Data Persiapan Proposal $request->id", 
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
