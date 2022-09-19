<?php

namespace Modules\Proposal\Http\Controllers\ProposalLayakTeknis;

use DB;
use Auth;
use DataTables;

use App\Models\PublicTrxProposal;
use App\Models\PublicTrxMitraKemaslahatan;

use App\Models\ComCode;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RencanaController extends Controller
{
    function __construct(){
        $this->middleware('auth');
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

            $rencana                = PublicTrxMitraKemaslahatan::find($id);
            // return $rencana;
            $oldData = $rencana;

            $rencana->email         = $request->rencana_email;
            $rencana->email3        = $request->rencana_penanggung_jawab;
            $rencana->phone         = $request->rencana_phone;
            $rencana->updated_by    = Auth::user()->user_id;
            $rencana->save();
            DB::commit();

            \LogActivity::saveLog(
                $logTp      = 'update', 
                $logNm      = "Mengubah Data Rencana Proposal $id", 
                $table      = $rencana->getTable(), 
                $oldData    = $oldData, 
                $newData    = $rencana
            );

            return response()->json(['status' => 'ok'],200); 

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

}
