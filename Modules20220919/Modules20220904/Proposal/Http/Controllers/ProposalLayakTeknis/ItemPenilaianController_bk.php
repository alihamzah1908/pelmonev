<?php

namespace Modules\Proposal\Http\Controllers\ProposalLayakTeknis;

use DB;
use Auth;
use DataTables;

use App\Models\PublicTrxProposal;
use App\Models\PublicTrxProposalLayakTeknis;

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
        $data = PublicTrxProposalLayakTeknis::select(
                    'trx_proposal_layak_teknis_id',
                    'layak_teknis_id',
                    'com_code.code_nm as layak_teknis_nm',
                    'com_code.code_group as layak_teknis_group',
                    'group.code_nm as layak_teknis_group_nm',
                    'layak_teknis_value',
                    'note'
                )
                ->join('public.com_code','com_code.com_cd','trx_proposal_layak_teknis.layak_teknis_id')
                ->join('public.com_code as group','group.com_cd','com_code.code_group')
                ->where(function($query) use($request){
                    $query->where('trx_proposal_id',$request->id);
                    $query->whereIn('com_code.code_group',['LT_01','LT_02','LT_03','LT_04']);
                });

        return DataTables::of($data)  
            ->addColumn('layak_teknis_value_radio', function($data){
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

}
