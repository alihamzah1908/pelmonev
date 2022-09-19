<?php

namespace Modules\Proposal\Http\Controllers\ProposalPenilaian;

use DB;
use Auth;
use DataTables;

use App\Models\ComBank;
use App\Models\AuthUser;
use App\Models\PublicTrxPemohon;
use App\Models\PublicTrxProposal;
use App\Models\PublicTrxProposalTimeline;
use App\Models\PublicTrxMitraKemaslahatan;
use App\Models\PublicTrxProposalLayakTeknis;
use App\Models\PublicTrxProposalPenilaian;

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
        $data = PublicTrxProposalPenilaian::select(
                    'trx_proposal_penilaian_id',
                    'penilaian_id',
                    'com_code.code_nm as penilaian_nm',
                    'com_code.code_value as penilaian_note',
                    'com_code.code_group as penilaian_group',
                    'penilaian_value',
                    'note'
                )
                ->join('public.com_code','com_code.com_cd','trx_proposal_penilaian.penilaian_id')
                ->where(function($query) use($request){
                    $query->where('trx_proposal_id',$request->id);
                    $query->where('com_code.code_group',$request->group);
                });

        return DataTables::of($data)  
            ->addColumn('actions', function($data){
                $actions = '';
                if (isRoleUser('regas')) {
                    if ($data->penilaian_value == NULL) {
                        $actions .= "<button type='button' class='keterangan-".substr($data->penilaian_group, -2)." btn btn-warning btn-flat btn-sm' data-toggle='tooltip' data-placement='top' title='Keterangan'><i class='icon icon-floppy-disk'></i> Keterangan</button> &nbsp";
                    }else{
                        $actions .= "<button type='button' class='proses-".substr($data->penilaian_group, -2)." btn btn-success btn-flat btn-sm' data-toggle='tooltip' data-placement='top' title='Proses'><i class='icon icon-floppy-disk'></i> Proses</button> &nbsp";
                    }
                }
    
                return $actions;
            })
            ->addColumn('penilaian_value_radio', function($data){
                return "
                <div class='form-group'>
                    <div class='border p-3 rounded'>
                        <div class='custom-control custom-radio custom-control-inline'>
                            <input type='radio' class='custom-control-input' name='$data->trx_proposal_penilaian_id' id='$data->trx_proposal_penilaian_id-ya' value='1' ".($data->penilaian_value == '1' ? 'checked' : '').">
                            <label class='custom-control-label' for='$data->trx_proposal_penilaian_id-ya'>Ya</label>
                        </div>

                        <div class='custom-control custom-radio custom-control-inline'>
                            <input type='radio' class='custom-control-input' name='$data->trx_proposal_penilaian_id' id='$data->trx_proposal_penilaian_id-tidak' value='0' ".($data->penilaian_value == '0' ? 'checked' : '').">
                            <label class='custom-control-label' for='$data->trx_proposal_penilaian_id-tidak'>Tidak</label>
                        </div>
                    </div>
                </div>
                ";
            })
            ->rawColumns(['actions','penilaian_value_radio'])
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

            $penilaian                = PublicTrxProposalPenilaian::find($id);
            $oldData = $penilaian;

            $penilaian->penilaian_value  = $request->modal_penilaian_value;
            $penilaian->note             = $request->penilaian_note;
            $penilaian->updated_by       = Auth::user()->user_id;
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
