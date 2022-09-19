<?php

namespace Modules\Proposal\Http\Controllers;

use DB;
use Auth;
use DataTables;
use App\Models\PublicTrxProposalLembagaPengurus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProposalLembagaPengurusController extends Controller
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
        $data = PublicTrxProposalLembagaPengurus::where('trx_proposal_id',$request->id);

        return DataTables::of($data)
        ->addColumn('action', function(){
            $actions = '<div class="d-flex justify-content-center">
                            <button type="button" data-toggle="modal" data-target="#modal-edit-pengurus" id="edit" class="edit-pengurus btn btn-sm btn-primary mx-1 px-2"><i class="icon icon-pencil"></i></button>
                            <button id="hapus" class="hapus-pengurus btn btn-sm btn-danger mx-1 px-2"><i class="icon icon-bin"></i></button>
                        </div>';
            return $actions;
        })
        ->make(true);
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

            $pengurus                   = new PublicTrxProposalLembagaPengurus;
            $pengurus->trx_proposal_id  = $request->id;
            $pengurus->pengurus_nm      = $request->pengurus_nm;
            $pengurus->jabatan_nm       = $request->jabatan_nm;
            $pengurus->pekerjaan_nm     = $request->pekerjaan_nm;
            $pengurus->note             = $request->note;
            $pengurus->created_by       = Auth::user()->user_id;
            $pengurus->save();
            DB::commit();

            \LogActivity::saveLog(
                $logTp      = 'create', 
                $logNm      = "Membuat Data Pengurus Lembaga Proposal $request->id", 
                $table      = $pengurus->getTable(), 
                $newData    = $pengurus
            );

            return response()->json(['status' => 'ok'],200); 

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }


    function update(Request $request, $id){
        try {
            DB::beginTransaction();

            $pengurus = PublicTrxProposalLembagaPengurus::find($id);
            $oldData = $pengurus;
            if($request->has('pengurus_nm'))$pengurus->pengurus_nm      = $request->pengurus_nm;
            if($request->has('jabatan_nm'))$pengurus->jabatan_nm        = $request->jabatan_nm;
            if($request->has('pekerjaan_nm'))$pengurus->pekerjaan_nm    = $request->pekerjaan_nm;
            if($request->has('note'))$pengurus->note                    = $request->note;
            $pengurus->created_by                                       = Auth::user()->user_id;
            $pengurus->save();

            DB::commit();

            \LogActivity::saveLog(
                $logTp      = 'update', 
                $logNm      = "Update Data Pengurus Lembaga Proposal $request->id", 
                $table      = $pengurus->getTable(), 
                $oldData    = $oldData,
                $newData    = $pengurus
            );

            return response()->json(['status' => 'ok'],200); 

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $pengurus = PublicTrxProposalLembagaPengurus::find($id);
            $oldData = $pengurus;
            $pengurus->delete();
            DB::commit();

            \LogActivity::saveLog(
                $logTp      = 'delete',
                $logNm      = "Menghapus Data Pengurus Lembaga Proposal $id",
                $table      = $pengurus->getTable(),
                $oldData    = $oldData
            );

            return response()->json(['status' => 'ok'],200);

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

}
