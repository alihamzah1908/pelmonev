<?php

namespace Modules\Proposal\Http\Controllers\ProposalLayakTeknis;

use DB;
use Auth;
use DataTables;

use App\Models\PublicTrxProposal;
use App\Models\PublicTrxProposalLayakTeknisPelaksanaanPenilaian;

use App\Models\ComCode;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PelaksanaanPenilaianController extends Controller
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

            $rencana                = PublicTrxProposalLayakTeknisPelaksanaanPenilaian::where('trx_proposal_id',$id)->first();
            if (empty($rencana)) {
                PublicTrxProposalLayakTeknisPelaksanaanPenilaian::insertLayakTeknisPelaksanaanPenilaian($id);
                $rencana                = PublicTrxProposalLayakTeknisPelaksanaanPenilaian::where('trx_proposal_id',$id)->first();
            }
            
            $oldData = $rencana;
            $datetime = explode(' ',$request->penilaian_datetime);

            $rencana->penilaian_datetime    = formatDateTime($datetime[0], $datetime[1]);
            $rencana->lokasi                = $request->penilaian_lokasi;
            $rencana->petugas               = $request->penilaian_petugas;
            $rencana->pihak                 = $request->penilaian_pihak;
            $rencana->updated_by            = Auth::user()->user_id;
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
