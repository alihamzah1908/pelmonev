<?php

namespace Modules\MasterCoo\Http\Controllers;

use DB;
use Auth;
use DataTables;
use App\Models\ComBank;
use App\Models\AuthUser;
use App\Models\PublicMasterCoo;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MasterCooController extends Controller
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
        $title 			= 'Master CCO';

        \LogActivity::saveLog(
            $logTp = 'visit',
            $logNm = "Membuka Menu $title"
        );

        return view('mastercoo::' . $this->folder_path . '.' . $filename_page, compact('title'));
    }

    /**
     * Show : DataTables
     *
     * @return \Illuminate\Http\Response
     */
    function getData(Request $request){
        $data = PublicMasterCoo::where(function($query) use($request){
                    if ($request->nama) {
                        $query->where("coo_desc", "ILIKE" ,'%'.$request->nama.'%');
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
                'coo_desc' => 'required',
            ]);

            $masterCoo                      = new PublicMasterCoo;
            $masterCoo->coo_desc  = $request->coo_desc;
            $masterCoo->created_by          = Auth::user()->user_id;
            $masterCoo->save();

            DB::commit();

            \LogActivity::saveLog(
                $logTp      = 'create',
                $logNm      = "Menambahkan Data Master CCO",
                $table      = $masterCoo->getTable(),
                $newData    = $masterCoo
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
                'coo_desc' => 'required',
            ]);

            $masterCoo                = PublicMasterCoo::find($id);
            $oldData = $masterCoo;

            $masterCoo->coo_desc  = $request->coo_desc;
            $masterCoo->updated_by          = Auth::user()->user_id;
            $masterCoo->save();

            DB::commit();

            \LogActivity::saveLog(
                $logTp      = 'update',
                $logNm      = "Mengubah Data Master CCO $id",
                $table      = $masterCoo->getTable(),
                $oldData    = $oldData,
                $newData    = $masterCoo
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

            $masterCoo                = PublicMasterCoo::find($id);
            $oldData = $masterCoo;

            PublicMasterCoo::destroy($id);

            DB::commit();

            \LogActivity::saveLog(
                $logTp      = 'update',
                $logNm      = "Menghapus Data Master CCO $id",
                $table      = $masterCoo->getTable(),
                $oldData    = $oldData
            );

            return response()->json(['status' => 'ok'],200);

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }
}
