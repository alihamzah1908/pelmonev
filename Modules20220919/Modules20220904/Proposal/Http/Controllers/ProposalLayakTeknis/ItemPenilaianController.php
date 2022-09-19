<?php

namespace Modules\Proposal\Http\Controllers\ProposalLayakTeknis;

use DB;
use Auth;
use DataTables;

use App\Models\PublicTrxProposal;
use App\Models\PublicTrxProposalLayakTeknis;
use App\Models\PublicTrxProposalPenilaianMitra;
use App\Models\PublicTrxProposalAnalisKepatuhan;

use App\Models\ComCode;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemPenilaianController extends Controller
{
    function __construct(){
        $this->middleware('auth');
    }

    /**
     * Show : DataTables
     *
     * @return \Illuminate\Http\Response
     */
    function getData(Request $request){
        // $data = PublicTrxProposalLayakTeknis::select(
        //             'trx_proposal_layak_teknis_id',
        //             'layak_teknis_id',
        //             'com_code.code_nm as layak_teknis_nm',
        //             'com_code.code_group as layak_teknis_group',
        //             'group.code_nm as layak_teknis_group_nm',
        //             'layak_teknis_value',
        //             'note'
        //         )
        //         ->join('public.com_code','com_code.com_cd','trx_proposal_layak_teknis.layak_teknis_id')
        //         ->join('public.com_code as group','group.com_cd','com_code.code_group')
        //         ->where(function($query) use($request){
        //             // $query->where('trx_proposal_id',$request->id);
        //             $query->where('trx_proposal_id', '7439a5df-2d4c-43d9-b2a0-25f98eaec3cd');
        //             $query->where('trx_proposal_id', '!=', null);
        //             $query->whereIn('com_code.code_group',['LT_01','LT_02','LT_03','LT_04']);
        //         });

        $data = DB::select("SELECT trx_proposal_layak_teknis_id, trx_proposal_id, 
                layak_teknis_id,
                com_code.code_nm as layak_teknis_nm, 
                com_code.code_group as layak_teknis_group, 
                jjj.code_nm as layak_teknis_group_nm,
                layak_teknis_value, 
                note
                FROM trx_proposal_layak_teknis
                INNER JOIN com_code on com_code.com_cd=trx_proposal_layak_teknis.layak_teknis_id
                INNER JOIN com_code as jjj on jjj.com_cd=com_code.code_group
                WHERE trx_proposal_id in (select trx_proposal_id
                                                from trx_proposal inner join trx_proposal_mitra on trx_proposal.proposal_no = trx_proposal_mitra.proposal_no
                                                where trx_proposal_mitra.trx_proposal_mitra_id = '" . $request->id ."')
                AND com_code.code_group IN ('LT_01','LT_02','LT_03','LT_04')");

        return DataTables::of($data)  
            ->addColumn('layak_teknis_value_radio', function($data){
		if($data->layak_teknis_nm == 'Deskripsi'){
		return "
			<form id='note-penilaian$data->trx_proposal_layak_teknis_id'>
                              <div class='custom-control custom-radio custom-control-inline'>
			    	   <textarea class='form-control' name='note'>$data->note</textarea>
                             </div>
			     <button type='button' class='simpan-note-penilaian btn btn-primary btn-sm' data-id='$data->trx_proposal_layak_teknis_id'>Simpan</button>
			</form>
		";
		}else{
		return "
                <div class='form-group'>
                    <div class='border p-3 rounded'>
                        <div class='custom-control custom-radio custom-control-inline'>
                            <input type='radio' class='custom-control-input clickable' name='$data->trx_proposal_layak_teknis_id' id='$data->trx_proposal_layak_teknis_id-ya' value='1' ".($data->layak_teknis_value == '1' ? 'checked' : '').">
                            <label class='custom-control-label' for='$data->trx_proposal_layak_teknis_id-ya'>Ya</label>
                        </div>

                        <div class='custom-control custom-radio custom-control-inline'>
                            <input type='radio' class='custom-control-input clickable' name='$data->trx_proposal_layak_teknis_id' id='$data->trx_proposal_layak_teknis_id-tidak' value='0' ".($data->layak_teknis_value == '0' ? 'checked' : '').">
                            <label class='custom-control-label' for='$data->trx_proposal_layak_teknis_id-tidak'>Tidak</label>
                        </div>
                    </div>
                </div>
                ";
		}
                
            })
            ->rawColumns(['actions','layak_teknis_value_radio'])
            ->addIndexColumn()
            ->make(true);
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

            $layak_teknis                = PublicTrxProposalLayakTeknis::find($id);
            $oldData = $layak_teknis;

            $layak_teknis->layak_teknis_value   = $request->value;
            $layak_teknis->note                 = $request->note;
            $layak_teknis->updated_by           = Auth::user()->user_id;
            $layak_teknis->save();
            DB::commit();

            \LogActivity::saveLog(
                $logTp      = 'update', 
                $logNm      = "Mengubah Data Penilaian Proposal $id", 
                $table      = $layak_teknis->getTable(), 
                $oldData    = $oldData, 
                $newData    = $layak_teknis
            );

            return response()->json(['status' => 'ok'],200); 

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    function updateForm(Request $request, $id){
        try {
            DB::beginTransaction();

            $layak_teknis                = PublicTrxProposalLayakTeknis::find($id);
            $oldData = $layak_teknis;

            $layak_teknis->layak_teknis_value   = $request->value;
            $layak_teknis->note                 = $request->note;
            $layak_teknis->updated_by           = Auth::user()->user_id;
            $layak_teknis->save();
            DB::commit();

            \LogActivity::saveLog(
                $logTp      = 'update', 
                $logNm      = "Mengubah Data Penilaian Proposal $id", 
                $table      = $layak_teknis->getTable(), 
                $oldData    = $oldData, 
                $newData    = $layak_teknis
            );

            return response()->json(['status' => 'ok'],200); 

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    function update_penilaian_mitra(Request $request, $id){
        try {
            DB::beginTransaction();
	    $check = PublicTrxProposalPenilaianMitra::where('trx_proposal_id', $id)->first();
	    //dd($check);
	    if($check){
		$penilaian                = PublicTrxProposalPenilaianMitra::find($check->trx_proposal_penilaian_id);	

		//dd($penilaian);
	    }else{
		$penilaian                = new PublicTrxProposalPenilaianMitra();
	    }
            	
	    $penilaian->trx_proposal_id = $id;
            $oldData = $penilaian;
            $penilaian->pen_mitra_bh = $request->pen_mitra_bh;
            $penilaian->pen_mitra_sdm_pen = $request->pen_mitra_sdm_pen;
	    $penilaian->pen_mitra_ruang_lingkup = $request->pen_mitra_ruang_lingkup;
	    $penilaian->pen_mitra_dk = $request->pen_mitra_dk;
	    $penilaian->pen_mitra_djk = $request->pen_mitra_djk;
            $penilaian->updated_by  = Auth::user()->user_id;
            $penilaian->save();
            DB::commit();

            \LogActivity::saveLog(
                $logTp      = 'update', 
                $logNm      = "Mengubah Data Penilaian Proposal $id", 
                $table      = $penilaian->getTable(), 
                $oldData    = $oldData, 
                $newData    = $penilaian
            );

            return response()->json(['status' => 'ok'],200); 

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    function update_analis_kepatuhan(Request $request, $id){
	// dd($request->all());
        try {
            DB::beginTransaction();
	    $check = PublicTrxProposalAnalisKepatuhan::where('trx_proposal_id', $id)->first();
//	    dd($check);
	    if($check){
		$penilaian                = PublicTrxProposalAnalisKepatuhan::find($check->trx_proposal_analis_kepatuhan_id);	

		//dd($penilaian);
	    }else{
		$penilaian                = new PublicTrxProposalAnalisKepatuhan();
	    }
            	
	    $penilaian->trx_proposal_id = $id;
            $oldData = $penilaian;
            $penilaian->verif_1_value = $request->verif_1_value;
            $penilaian->verif_1_note = $request->verif_1_note;
	    $penilaian->verif_2_value = $request->verif_2_value;
	    $penilaian->verif_2_note = $request->verif_2_note;
	    $penilaian->verif_3a_value = $request->verif_3a_value;
	    $penilaian->verif_3a_note = $request->verif_3a_note;
	    $penilaian->verif_3b_value = $request->verif_3b_value;
	    $penilaian->verif_3b_note = $request->verif_3b_note;
	    $penilaian->verif_3c_value = $request->verif_3c_value;
	    $penilaian->verif_3c_note = $request->verif_3c_note;
	    $penilaian->verif_4a_value = $request->verif_4a_value;
	    $penilaian->verif_4a_note = $request->verif_4a_note;
	    $penilaian->verif_4b_value = $request->verif_4b_value;
	    $penilaian->verif_4b_note = $request->verif_4b_note;
	    $penilaian->verif_4c_value = $request->verif_4c_value;
	    $penilaian->verif_4c_note = $request->verif_4c_note;
            $penilaian->updated_by  = Auth::user()->user_id;
            $penilaian->save();
            DB::commit();

            \LogActivity::saveLog(
                $logTp      = 'update', 
                $logNm      = "Mengubah Data Penilaian Proposal $id", 
                $table      = $penilaian->getTable(), 
                $oldData    = $oldData, 
                $newData    = $penilaian
            );

            return response()->json(['status' => 'ok'],200); 

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }


}
