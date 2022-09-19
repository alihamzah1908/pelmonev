<?php

namespace Modules\Proposal\Http\Controllers;

use DB;
use Auth;
use DataTables;
use App\Models\PublicTrxProposalOutcome;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProposalOutcomeController extends Controller
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
        $data = PublicTrxProposalOutcome::where('trx_proposal_id',$request->id);

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

            $pengurus                   = new PublicTrxProposalOutcome;
            $pengurus->trx_proposal_id  = $request->id;
            $pengurus->sub_kegiatan     = $request->outcome_sub_kegiatan;
            $pengurus->outcome          = $request->outcome_outcome;
            $pengurus->output           = $request->outcome_output;
            $pengurus->note             = $request->note;
            $pengurus->created_by       = Auth::user()->user_id;
            $pengurus->save();  
            DB::commit();

            \LogActivity::saveLog(
                $logTp      = 'create', 
                $logNm      = "Membuat Data Outcome Proposal $request->id", 
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
