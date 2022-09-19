<?php

namespace Modules\MitraStrategis\Http\Controllers;

use DB;
use Auth;
use DataTables;
use App\Models\ComBank;
use App\Models\AuthUser;
use App\Models\PublicTrxMitraStrategis;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MitraStrategisController extends Controller
{
    private $folder_path = '';

    function __construct(){
        $this->middleware('auth');
    }
    /**
     * Index
     *
     * @return \Illuminate\Http\Response
     */
    function index($id = NULL){
        $filename_page 	= 'index';
        $title 			= 'Mitra Strategis Strategis';

        \LogActivity::saveLog(
            $logTp = 'visit',
            $logNm = "Membuka Menu $title"
        );

        return view('mitrastrategis::' . $this->folder_path . '.' . $filename_page, compact('title'));
    }

    /**
     * Show : DataTables
     *
     * @return \Illuminate\Http\Response
     */
    function getData(Request $request){
        $data = PublicTrxMitraStrategis::where(function($query) use($request){
                    if ($request->nama) {
                        $query->where("mitra_strategis_nm", "ILIKE" ,'%'.$request->nama.'%');
                    }
                });

        return DataTables::of($data)
                ->addColumn('actions', function($data){
                    $actions = '';
                    // $actions .= "<button type='button' class='detail btn btn-info btn-flat btn-sm' data-toggle='tooltip' data-placement='top' title='detail'><i class='icon icon-enlarge'></i> </button> &nbsp";
                    $actions .= "<button type='button' class='ubah btn btn-warning btn-flat btn-sm' data-toggle='tooltip' data-placement='top' title='Ubah Data'><i class='icon icon-pencil'></i> </button> &nbsp";
                    $actions .= "<button type='button' class='hapus btn btn-danger btn-flat btn-sm' data-toggle='tooltip' data-placement='top' title='Hapus Data'><i class='icon icon-trash'></i> </button> &nbsp";

                    return $actions;
                })
                ->rawColumns(['actions'])
                ->addIndexColumn()
                ->make(true);
    }

    /**
     * Create
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    function store(Request $request){
        try {
            DB::beginTransaction();
            $this->validate($request,[
                'mitra_strategis_nm' => 'required',
                'instansi'           => 'required',
                'jabatan'            => 'required'
            ]);

            $mitra                      = new PublicTrxMitraStrategis;
            $mitra->mitra_strategis_nm  = $request->mitra_strategis_nm;
            $mitra->instansi            = $request->instansi;
            $mitra->jabatan             = $request->jabatan;
            $mitra->created_by          = Auth::user()->user_id;
            $mitra->save();

            DB::commit();

            \LogActivity::saveLog(
                $logTp      = 'create',
                $logNm      = "Menambahkan Data Mitra",
                $table      = $mitra->getTable(),
                $newData    = $mitra
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
            $this->validate($request,[
                'mitra_strategis_nm' => 'required',
                'instansi'           => 'required',
                'jabatan'            => 'required',
            ]);

            $mitra                = PublicTrxMitraStrategis::find($id);
            $oldData = $mitra;

            $mitra->mitra_strategis_nm  = $request->mitra_strategis_nm;
            $mitra->instansi            = $request->instansi;
            $mitra->jabatan             = $request->jabatan;
            $mitra->updated_by          = Auth::user()->user_id;
            $mitra->save();

            DB::commit();

            \LogActivity::saveLog(
                $logTp      = 'update',
                $logNm      = "Mengubah Data Mitra Strategis $id",
                $table      = $mitra->getTable(),
                $oldData    = $oldData,
                $newData    = $mitra
            );

            return response()->json(['status' => 'ok'],200);

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    /**
     * Delete
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    function destroy($id){
        try {
            DB::beginTransaction();

            $mitra                = PublicTrxMitraStrategis::find($id);
            $oldData = $mitra;

            PublicTrxMitraStrategis::destroy($id);

            DB::commit();

            \LogActivity::saveLog(
                $logTp      = 'update',
                $logNm      = "Menghapus Data Mitra Strategis $id",
                $table      = $mitra->getTable(),
                $oldData    = $oldData
            );

            return response()->json(['status' => 'ok'],200);

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }
}
