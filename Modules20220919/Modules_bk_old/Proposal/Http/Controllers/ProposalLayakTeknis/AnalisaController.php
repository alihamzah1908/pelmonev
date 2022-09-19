<?php

namespace Modules\Proposal\Http\Controllers\ProposalLayakTeknis;

use DB;
use Auth;
use DataTables;

use App\Models\PublicTrxProposal;
use App\Models\PublicTrxProposalLayakTeknisAnalisa;

use App\Models\ComCode;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnalisaController extends Controller
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

            $analisa                = PublicTrxProposalLayakTeknisAnalisa::where('trx_proposal_id',$id)->first();
            // return $analisa;
            $oldData = $analisa;

            $analisa->tujuan                    = $request->tujuan;
            $analisa->manfaat                   = $request->manfaat;
            $analisa->kuota_kegiatan            = $request->kuota_kegiatan;
            $analisa->hukum                     = $request->hukum;
            $analisa->kompetensi_tenaga_ahli    = $request->kompetensi_tenaga_ahli;
            $analisa->ekonomi                   = $request->ekonomi;
            $analisa->kapasitas_mitra           = $request->kapasitas_mitra;
            $analisa->aspek_kewajaran_biaya     = $request->aspek_kewajaran_biaya;
            $analisa->kuota_wilayah             = $request->kuota_wilayah;
            $analisa->dampak_kualitas           = $request->dampak_kualitas;
            $analisa->note                      = $request->note;
            $analisa->updated_by                = Auth::user()->user_id;
            $analisa->save();
            DB::commit();

            \LogActivity::saveLog(
                $logTp      = 'update', 
                $logNm      = "Mengubah Data Analisa Proposal $id", 
                $table      = $analisa->getTable(), 
                $oldData    = $oldData, 
                $newData    = $analisa
            );

            return response()->json(['status' => 'ok'],200); 

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

}
