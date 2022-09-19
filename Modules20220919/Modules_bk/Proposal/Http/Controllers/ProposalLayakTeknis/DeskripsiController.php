<?php

namespace Modules\Proposal\Http\Controllers\ProposalLayakTeknis;

use DB;
use Auth;
use DataTables;

use App\Models\PublicTrxProposal;
use App\Models\PublicTrxProposalLayakTeknisDeskripsi;

use App\Models\ComCode;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeskripsiController extends Controller
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

            $deskripsi                = PublicTrxProposalLayakTeknisDeskripsi::where('trx_proposal_id',$id)->first();
            $oldData = $deskripsi;

            $deskripsi->nama_program        = $request->nama_program;
            $deskripsi->sistem_penyaluran   = $request->sistem_penyaluran;
            $deskripsi->sub_program         = $request->sub_program;
            $deskripsi->tujuan_program      = $request->tujuan_program;
            $deskripsi->anggaran_sumberdana = $request->anggaran_sumberdana;
            $deskripsi->rencana_lokasi      = $request->rencana_lokasi;
            $deskripsi->penerima_maslahat   = $request->penerima_maslahat;
            $deskripsi->note                = $request->note;
            $deskripsi->updated_by          = Auth::user()->user_id;
            $deskripsi->save();
            DB::commit();

            \LogActivity::saveLog(
                $logTp      = 'update', 
                $logNm      = "Mengubah Data Deskripsi Proposal $id", 
                $table      = $deskripsi->getTable(), 
                $oldData    = $oldData, 
                $newData    = $deskripsi
            );

            return response()->json(['status' => 'ok'],200); 

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

}
