<?php

namespace Modules\MutasiRekening\Http\Controllers;

use DB;
use Auth;
use DataTables;
use App\Models\ComBank;
use App\Models\AuthUser;
use App\Models\PublicTrxMutasiRekening;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use App\Http\Controllers\Controller;
use Modules\MutasiRekening\Imports\MutasiRekeningImport;

class MutasiRekeningController extends Controller
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
        $title 			= 'Mutasi Rekening Mitra';

        \LogActivity::saveLog(
            $logTp = 'visit',
            $logNm = "Membuka Menu $title"
        );

        return view('mutasirekening::' . $this->folder_path . '.' . $filename_page, compact('title'));
    }

    /**
     * Show : DataTables
     *
     * @return \Illuminate\Http\Response
     */
    function getData(Request $request){
        $data = PublicTrxMutasiRekening::where(function($query) use($request){
                    if ($request->nama) {
                        $query->where("ref_no", "ILIKE" ,'%'.$request->nama.'%');
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
                'ref_no' => 'required',
                'post_date' => 'required',
                'post_time' => 'required',
                'eff_date' => 'required',
                'eff_time' => 'required',
                'debit' => 'required',
                'balance' => 'required',
                'credit' => 'required',
            ]);

            $mutasiRek                      = new PublicTrxMutasiRekening;
            $mutasiRek->ref_no  = $request->ref_no;
            $mutasiRek->post_date  = $request->post_date;
            $mutasiRek->post_time  = $request->post_time;
            $mutasiRek->eff_date  = $request->eff_date;
            $mutasiRek->eff_time  = $request->eff_time;
            $mutasiRek->debit  = uang($request->debit);
            $mutasiRek->balance  = uang($request->balance);
            $mutasiRek->credit  = uang($request->credit);
            $mutasiRek->description  = $request->description;
            $mutasiRek->created_by          = Auth::user()->user_id;
            $mutasiRek->save();

            DB::commit();

            \LogActivity::saveLog(
                $logTp      = 'create',
                $logNm      = "Menambahkan Data Mutasi Rekening",
                $table      = $mutasiRek->getTable(),
                $newData    = $mutasiRek
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
                'ref_no' => 'required',
                'post_date' => 'required',
                'post_time' => 'required',
                'eff_date' => 'required',
                'eff_time' => 'required',
                'debit' => 'required',
                'balance' => 'required',
                'credit' => 'required',
            ]);

            $mutasiRek                = PublicTrxMutasiRekening::find($id);
            $oldData = $mutasiRek;

            $mutasiRek->ref_no  = $request->ref_no;
            $mutasiRek->post_date  = $request->post_date;
            $mutasiRek->post_time  = $request->post_time;
            $mutasiRek->eff_date  = $request->eff_date;
            $mutasiRek->eff_time  = $request->eff_time;
            $mutasiRek->debit  = uang($request->debit);
            $mutasiRek->balance  = uang($request->balance);
            $mutasiRek->credit  = uang($request->credit);
            $mutasiRek->description  = $request->description;
            $mutasiRek->updated_by          = Auth::user()->user_id;
            $mutasiRek->save();

            DB::commit();

            \LogActivity::saveLog(
                $logTp      = 'update',
                $logNm      = "Mengubah Data Mutasi Rekening $id",
                $table      = $mutasiRek->getTable(),
                $oldData    = $oldData,
                $newData    = $mutasiRek
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

            $mutasiRek                = PublicTrxMutasiRekening::find($id);
            $oldData = $mutasiRek;

            PublicTrxMutasiRekening::destroy($id);

            DB::commit();

            \LogActivity::saveLog(
                $logTp      = 'update',
                $logNm      = "Menghapus Data Mutasi Rekening $id",
                $table      = $mutasiRek->getTable(),
                $oldData    = $oldData
            );

            return response()->json(['status' => 'ok'],200);

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }


    function uploadExcel(){
        Excel::import(new MutasiRekeningImport, request()->file('mutasi_file'));

        return response()->json(['success' => true]);
    }
}
