<?php
namespace App\Http\Controllers;

use DB;
use Auth;
use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ComNation;
use App\Models\VwRegion;

class NationController extends Controller{
    private $folder_path = 'nation';
    
    function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function index($id = NULL){
        $filename_page  = 'index';
        $title          = 'Data Negara';
        $type           = "Negara";

        \LogActivity::saveLog(
            $logTp = 'visit', 
            $logNm = "Membuka Menu $title"
        );

        return view('sistem.' . $this->folder_path . '.' . $filename_page, compact('title','id'));
    }

    /**
     * Display a listing of the resource for datatables.
     *
     * @return \Illuminate\Http\Response
     */
    function getData(Request $request){
        $data   = ComNation::query();

        return DataTables::of($data)
            ->addColumn('actions',function($data){
                $actions = '';
                $actions .= "<button id='hapus' class='btn btn-danger btn-flat btn-sm' title='hapus'>
                                <i class='icon icon-trash'></i>
                        </button>  &nbsp";
                $actions .= "<button id='ubah' class='btn btn-warning btn-flat btn-sm' title='ubah'>
                                <i class='icon icon-pencil'></i>
                        </button>  &nbsp";
                return $actions;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    function store(Request $request){
        $this->validate($request,[
            'nation_cd'      => 'required|unique:com_nation|alpha_num',
            'nation_nm'      => 'required'
        ]);
        
        if (!empty($request->nation_root)) {
            $nationRoot=ComNation::find($request->nation_root);
            $nationLevel=$nationRoot->nation_level+1;
        }else{
            $nationLevel=1;
        }
        
        $nation = ComNation::create([
            'nation_cd'     => $request->nation_cd,
            'nation_nm'     => $request->nation_nm,
            'created_by'    => Auth::user()->user_id
        ]);

        \LogActivity::saveLog(
            $logTp = 'create', 
            $logNm = "Menambah Data Negara $nation->nation_cd - $nation->nation_nm", 
            $table = $nation->getTable(), 
            $newData = $nation
        );

        return response()->json(['status' => 'ok'],200); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    function show($id){
        $nation = PublicVwRegion::select(DB::Raw("*, trim(concat(nation_nm_kel, ', ', nation_nm_kec, ', ', nation_nm_kab, ', ', nation_nm_prop),', ') as long_nation"))->find($id);

        if($nation){
            return response()->json(['status' => 'ok', 'data' => $nation],200);
        }else{
            return response()->json(['status' => 'failed', 'data' => 'not found'],200);
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
        $this->validate($request,[
            'nation_nm'      => 'required',
        ]);
        
        
        $nation = ComNation::find($id);
        $oldData = clone $nation;

        $nation->nation_nm     = $request->nation_nm;
        $nation->updated_by    = Auth::user()->user_id;

        $nation->save();

        \LogActivity::saveLog(
            $logTp   = 'update', 
            $logNm   = "Mengubah Data Negara $nation->nation_cd - $nation->nation_nm", 
            $table   = $nation->getTable(), 
            $newData = $nation,
            $oldData = $oldData
        );

        return response()->json(['status' => 'ok'],200); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    function destroy($id){
        $data = ComNation::find($id);
            \LogActivity::saveLog(
                $logTp   = 'delete', 
                $logNm   = "Menghapus Data Negara $id",
                $table   = $data->getTable(), 
                $newData = NULL,
                $oldData = $data
            );
        ComNation::destroy($id);

        return response()->json(['status' => 'ok'],200);
    }

    /**
     * Display a listing of the resource for select2.
     *
     * @return \Illuminate\Http\Response
     */
    function getRegionList(Request $request, $id=NULL){
        $nationNmParam  = $request->get('term');
        $level          = $request->get('level');
        $action         = $request->route()->getAction();

        $nations        = PublicVwRegion::select(DB::raw("nation_cd as id, 
                            nation_nm as text")
                            )
                            ->where("nation_nm", "ILIKE", "%$nationNmParam%");
        $nations->limit(100);
        
        return response()->json($nations->get());
    }
}
