<?php

namespace Modules\Proposal\Http\Controllers;

use DB;
use Auth;
use DataTables;
use App\Models\PublicTrxProposalPengalaman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProposalPengalamanController extends Controller
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
        $data = PublicTrxProposalPengalaman::where('trx_proposal_id',$request->id);

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

            $pengurus                   = new PublicTrxProposalPengalaman;
            $pengurus->trx_proposal_id  = $request->id;
            $pengurus->program_kegiatan = $request->pengalaman_program_kegiatan;
            $pengurus->tujuan           = $request->pengalaman_tujuan;
            $pengurus->lokasi           = $request->pengalaman_lokasi;
            $pengurus->outcome          = $request->pengalaman_outcome;
            $pengurus->output           = $request->pengalaman_output;
            $pengurus->note             = $request->note;
            $pengurus->created_by       = Auth::user()->user_id;
            $pengurus->save();  
            DB::commit();

            \LogActivity::saveLog(
                $logTp      = 'create', 
                $logNm      = "Membuat Data Pengalaman Proposal $request->id", 
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
