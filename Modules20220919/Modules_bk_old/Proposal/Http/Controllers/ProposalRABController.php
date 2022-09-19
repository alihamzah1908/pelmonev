<?php

namespace Modules\Proposal\Http\Controllers;

use DB;
use Auth;
use DataTables;
use App\Models\PublicTrxProposalRAB;
use App\Models\PublicTrxProsesStatus;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProposalRABController extends Controller
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
        $data = PublicTrxProposalRAB::leftJoin('com_code as freq','freq.com_cd','trx_proposal_rab.satuan')
                ->select(
                    "trx_proposal_rab_id",
                    "jenis_pengeluaran",
                    "satuan",
                    "freq.code_nm as satuan_nm",
                    "jumlah_unit",
                    "biaya_satuan",
		    "biaya_satuan_mitra",
                    "total",
		    "total_mitra",
                    "trx_proposal.proses_st",
                    "trx_proposal.rab_tp"
                )
                ->join('trx_proposal','trx_proposal.trx_proposal_id','trx_proposal_rab.trx_proposal_id')
                ->where('trx_proposal_rab.trx_proposal_id',$request->id);

        return DataTables::of($data)
        ->addColumn('actions', function($data){
            $actions = '';
            if ($data->proses_st == 'PROSES_CPM') {
                if ($data->rab_tp == 'PENGADAAN') {
                    $actions .= '<div class="d-flex justify-content-center">
                                    <button type="button" data-toggle="modal" data-target="#modal-edit-pengadaan" id="edit-pengadaan" class="edit-pengadaan btn btn-sm btn-primary mx-1 px-2"><i class="icon icon-pencil"></i></button>
                                    <button id="hapus" class="hapus-rab btn btn-sm btn-danger mx-1 px-2"><i class="icon icon-bin"></i></button>
                                </div>';
                }elseif ($data->rab_tp == 'PEMBANGUNAN') {
                    $actions .= '<div class="d-flex justify-content-center">
                                    <button type="button" data-toggle="modal" data-target="#modal-edit-pembangunan" id="edit-pembangunan" class="edit-pembangunan btn btn-sm btn-primary mx-1 px-2"><i class="icon icon-pencil"></i></button>
                                    <button id="hapus" class="hapus-rab btn btn-sm btn-danger mx-1 px-2"><i class="icon icon-bin"></i></button>
                                </div>';
                }elseif ($data->rab_tp == 'KEGIATAN') {
                    $actions .= '<div class="d-flex justify-content-center">
                                    <button type="button" data-toggle="modal" data-target="#modal-edit-kegiatan" id="edit-kegiatan" class="edit-kegiatan btn btn-sm btn-primary mx-1 px-2"><i class="icon icon-pencil"></i></button>
                                    <button id="hapus" class="hapus-rab btn btn-sm btn-danger mx-1 px-2"><i class="icon icon-bin"></i></button>
                                </div>';
                }elseif ($data->rab_tp == 'DEFAULT') {
                    $actions .= '<div class="d-flex justify-content-center">
                                    <button type="button" data-toggle="modal" data-target="#modal-edit-default" id="edit-default" class="edit-default btn btn-sm btn-primary mx-1 px-2"><i class="icon icon-pencil"></i></button>
                                    <button id="hapus" class="hapus-rab btn btn-sm btn-danger mx-1 px-2"><i class="icon icon-bin"></i></button>
                                </div>';
                }
            }
            return $actions;
        })
        ->editColumn('biaya_satuan', function($data){
            return (int)$data->biaya_satuan_mitra;
        })
        ->editColumn('biaya_satuan_mitra', function($data){
            return $data->biaya_satuan_mitra ? (int)$data->biaya_satuan_mitra : NULL;
        })
        ->rawColumns(['actions'])
        ->addIndexColumn()->make(true);
    }

    function getDataMitra(Request $request){
        $data = PublicTrxProposalRAB::leftJoin('com_code as freq','freq.com_cd','trx_proposal_rab.satuan')
                ->select(
                    "trx_proposal_rab_id",
                    "jenis_pengeluaran",
                    "satuan",
                    "freq.code_nm as satuan_nm",
                    "jumlah_unit",
                    "biaya_satuan_mitra",
                    "total_mitra",
                    "trx_proposal_mitra.proses_st",
                    "trx_proposal_mitra.rab_tp"
                )
                ->join('trx_proposal_mitra','trx_proposal_mitra.trx_proposal_child_id','trx_proposal_rab.trx_proposal_id')
                ->where('trx_proposal_rab.trx_proposal_id',$request->id);

        return DataTables::of($data)
        ->addColumn('actions', function($data){
            $actions = '';
            if ($data->proses_st == 'PROSES_CPM') {
                if ($data->rab_tp == 'PENGADAAN') {
                    $actions .= '<div class="d-flex justify-content-center">
                                    <button type="button" data-toggle="modal" data-target="#modal-edit-pengadaan" id="edit-pengadaan" class="edit-pengadaan btn btn-sm btn-primary mx-1 px-2"><i class="icon icon-pencil"></i></button>
                                    <button id="hapus" class="hapus-rab btn btn-sm btn-danger mx-1 px-2"><i class="icon icon-bin"></i></button>
                                </div>';
                }elseif ($data->rab_tp == 'PEMBANGUNAN') {
                    $actions .= '<div class="d-flex justify-content-center">
                                    <button type="button" data-toggle="modal" data-target="#modal-edit-pembangunan" id="edit-pembangunan" class="edit-pembangunan btn btn-sm btn-primary mx-1 px-2"><i class="icon icon-pencil"></i></button>
                                    <button id="hapus" class="hapus-rab btn btn-sm btn-danger mx-1 px-2"><i class="icon icon-bin"></i></button>
                                </div>';
                }elseif ($data->rab_tp == 'KEGIATAN') {
                    $actions .= '<div class="d-flex justify-content-center">
                                    <button type="button" data-toggle="modal" data-target="#modal-edit-kegiatan" id="edit-kegiatan" class="edit-kegiatan btn btn-sm btn-primary mx-1 px-2"><i class="icon icon-pencil"></i></button>
                                    <button id="hapus" class="hapus-rab btn btn-sm btn-danger mx-1 px-2"><i class="icon icon-bin"></i></button>
                                </div>';
                }elseif ($data->rab_tp == 'DEFAULT') {
                    $actions .= '<div class="d-flex justify-content-center">
                                    <button type="button" data-toggle="modal" data-target="#modal-edit-default" id="edit-default" class="edit-default btn btn-sm btn-primary mx-1 px-2"><i class="icon icon-pencil"></i></button>
                                    <button id="hapus" class="hapus-rab btn btn-sm btn-danger mx-1 px-2"><i class="icon icon-bin"></i></button>
                                </div>';
                }
            }
            return $actions;
        })
        ->editColumn('biaya_satuan', function($data){
            return $data->biaya_satuan_mitra ? (int)$data->biaya_satuan_mitra : NULL;
        })
        ->editColumn('total', function($data){
            return (int)$data->total_mitra;
        })
        ->editColumn('biaya_satuan_mitra', function($data){
            return $data->biaya_satuan_mitra ? (int)$data->biaya_satuan_mitra : NULL;
        })
        ->rawColumns(['actions','total','biaya_satuan'])
        ->addIndexColumn()->make(true);
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
                $rab                       = new PublicTrxProposalRAB;
                $rab->trx_proposal_id      = $request->proposal_id;
                $rab->jenis_pengeluaran = $request->rab_jenis_pengeluaran;
                $rab->satuan = $request->rab_satuan;

                switch (roleUser()) {
                    case 'mitra':
                        if($request->has('rab_jumlah_unit')) $rab->jumlah_unit_mitra = $request->rab_jumlah_unit;
                        if($request->has('rab_biaya_satuan')) $rab->biaya_satuan_mitra = uang($request->rab_biaya_satuan);
                        if($request->has('rab_jumlah_unit') && $request->has('rab_satuan'))$rab->total_mitra = $request->rab_jumlah_unit * uang($request->rab_biaya_satuan);
                        break;
                    case 'regas':
                        if($request->has('rab_jumlah_unit')) $rab->jumlah_unit_bpkh = $request->rab_jumlah_unit;
                        if($request->has('rab_biaya_satuan')) $rab->biaya_satuan_bpkh = uang($request->rab_biaya_satuan);
                        if($request->has('rab_jumlah_unit') && $request->has('rab_satuan'))$rab->total_bpkh = $request->rab_jumlah_unit * uang($request->rab_biaya_satuan);
                        break;
                    default:
                        if($request->has('rab_jumlah_unit')) $rab->jumlah_unit = $request->rab_jumlah_unit;
                        if($request->has('rab_biaya_satuan')) $rab->biaya_satuan = uang($request->rab_biaya_satuan);
                        if($request->has('rab_jumlah_unit') && ($request->has('rab_satuan') || $request->has('rab_biaya_satuan')) )$rab->total = $request->rab_jumlah_unit * uang($request->rab_biaya_satuan);
                        break;
                }

                if($request->has('note')) $rab->note = $request->note;

                $rab->created_by           = Auth::user()->user_id;
                $rab->save();  
                // return $rab;
                DB::commit();
    
                \LogActivity::saveLog(
                    $logTp      = 'create', 
                    $logNm      = "Membuat Data RAB Proposal $request->id", 
                    $table      = $rab->getTable(), 
                    $newData    = $rab
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
    function update(Request $request, $id){
        try {
            DB::beginTransaction();

                $rab                       = PublicTrxProposalRAB::find($id);
                $oldData = $rab;

                if($request->has('rab_jenis_pengeluaran')) $rab->jenis_pengeluaran = $request->rab_jenis_pengeluaran;
                if($request->has('rab_satuan')) $rab->satuan = $request->rab_satuan;

                switch (roleUser()) {
                    case 'mitra':
                        if($request->has('rab_jumlah_unit')) $rab->jumlah_unit_mitra = $request->rab_jumlah_unit;
                        if($request->has('rab_biaya_satuan')) $rab->biaya_satuan_mitra = uang($request->rab_biaya_satuan);
                        if($request->has('rab_jumlah_unit') && $request->has('rab_satuan'))$rab->total_mitra = $request->rab_jumlah_unit * uang($request->rab_biaya_satuan);
                        break;
                    case 'regas':
                        if($request->has('rab_jumlah_unit')) $rab->jumlah_unit_bpkh = $request->rab_jumlah_unit;
                        if($request->has('rab_biaya_satuan')) $rab->biaya_satuan_bpkh = uang($request->rab_biaya_satuan);
                        if($request->has('rab_jumlah_unit') && $request->has('rab_satuan'))$rab->total_bpkh = $request->rab_jumlah_unit * uang($request->rab_biaya_satuan);
                        break;
                    default:
                        if($request->has('rab_jumlah_unit')) $rab->jumlah_unit = $request->rab_jumlah_unit;
                        if($request->has('rab_biaya_satuan')) $rab->biaya_satuan = uang($request->rab_biaya_satuan);
                        if($request->has('rab_jumlah_unit') && ($request->has('rab_satuan') || $request->has('rab_biaya_satuan')) )$rab->total = $request->rab_jumlah_unit * uang($request->rab_biaya_satuan);
                        break;
                }

                if($request->has('note')) $rab->note = $request->note;

                $rab->updated_by           = Auth::user()->user_id;
                $rab->save();  
                DB::commit();

                \LogActivity::saveLog(
                    $logTp      = 'create', 
                    $logNm      = "Update Data RAB Proposal $request->proposal_id", 
                    $table      = $rab->getTable(), 
                    $newData    = $rab,
                    $oldData    = $oldData
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

            $pengurus = PublicTrxProposalRAB::find($id);
            $oldData = $pengurus;
            $pengurus->delete();
            DB::commit();

            \LogActivity::saveLog(
                $logTp      = 'delete',
                $logNm      = "Menghapus Data rab Proposal $id",
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
