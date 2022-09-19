<?php

namespace Modules\Dashboard\Http\Controllers;

use DB;
use Auth;
use DataTables;
use App\Models\ComBank;
use App\Models\AuthUser;
use App\Models\PublicTrxMitraKemaslahatan;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MitraKemaslahatanController extends Controller
{
    private $folder_path = 'mitra-kemaslahatan';
    
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
        $title 			= 'Dashboard Mitra Kemaslahatan';
        
        \LogActivity::saveLog(
            $logTp = 'visit', 
            $logNm = "Membuka Menu $title"
        );

        return view('dashboard::' . $this->folder_path . '.' . $filename_page, compact('title'));
    }

    /**
     * Show : DataTables
     *
     * @return \Illuminate\Http\Response
     */
    function getData(Request $request){
        $data = PublicTrxMitraKemaslahatan::where(function($query) use($request){
                    if ($request->nama) {
                        $query->where("mitra_kemaslahatan_nm", "ILIKE" ,'%'.$request->nama.'%');
                    }
                });

        return DataTables::of($data)
                ->addColumn('actions', function($data){
                    $actions = '';
                    // $actions .= "<button type='button' class='detail btn btn-info btn-flat btn-sm' data-toggle='tooltip' data-placement='top' title='detail'><i class='icon icon-enlarge'></i> </button> &nbsp";
                    // $actions .= "<button type='button' class='ubah btn btn-warning btn-flat btn-sm' data-toggle='tooltip' data-placement='top' title='Ubah Data'><i class='icon icon-pencil'></i> </button> &nbsp";
                    // $actions .= "<button type='button' class='hapus btn btn-danger btn-flat btn-sm' data-toggle='tooltip' data-placement='top' title='Hapus Data'><i class='icon icon-trash'></i> </button> &nbsp";
                    
                    return $actions;
                })
                ->rawColumns(['actions'])
                ->addIndexColumn()
                ->make(true);
    }
}
