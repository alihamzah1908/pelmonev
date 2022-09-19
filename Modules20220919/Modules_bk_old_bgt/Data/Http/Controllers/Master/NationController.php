<?php
namespace Modules\Data\Http\Controllers\Master;

use DB;
use Auth;
use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ComNation;

class NationController extends Controller{
    private $folder_path = 'master.nation';
    
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
        $title 			= 'Data Negara';

        return view('data::' . $this->folder_path . '.' . $filename_page, compact('title'));
    }

    /**
     * Show : DataTables
     *
     * @return \Illuminate\Http\Response
     */
    function getData(Request $request){
        $data = ComNation::query();

        return DataTables::of($data)->make(true);
		
		
		/* $data   =  ComNation::all();
		
		return DataTables::of($data)->make(true); */
    }

    /**
     * Create
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    function store(Request $request){
		$this->validate($request,[
            'nation_cd'     => 'required',
            'nation_nm'     => 'required',
        ]);
		
        $nation             = new ComNation;
        $nation->nation_cd  = str_replace(' ','',$request->nation_cd);
        $nation->nation_nm  = ucwords($request->nation_nm);
        $nation->created_by = Auth::user()->user_id;
        $nation->save();

        return response()->json(['status' => 'ok'],200); 
    }

    /**
     * Show by id
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    function show($id){
        $nation = ComNation::find($id);

        if($nation){
            return response()->json(['status' => 'ok', 'data' => $nation],200);
        }else{
            return response()->json(['status' => 'failed', 'data' => 'not found'],200);
        }
    }

    /**
     * Update
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    function update(Request $request, $id){
        $this->validate($request,[
            'nation_nm'       => 'required',
        ]);
        
        $nation             = ComNation::find($id);
        $nation->nation_nm  = ucwords($request->nation_nm);
        $nation->updated_by = Auth::user()->user_id;

        $nation->save();

        return response()->json(['status' => 'ok'],200); 
    }

    /** 
     * Delete
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    function destroy($id){
        ComNation::destroy($id);

        return response()->json(['status' => 'ok'],200);
    }
	
	function getNationList(Request $request){
        $searchParam  = $request->get('term');
		
		$nations = ComNation::getNationList($searchParam);
        
        return response()->json($nations);
    }

    /*function getNationList(Request $request){
        $searchParam = $request->get('term');
		
		$nation = ComNation::select("nation_cd as id", "nation_nm as text") 
                        ->where("nation_nm", "LIKE", "%$searchParam%")
						->orderby("nation_nm")
                        ->get()
                        ->toArray();
		array_unshift($nation,array('id' => '','text'=>'=== Pilih Data ==='));
		
        return response()->json($nation);
    }*/
	
	public static function getNationById($id){
        return PublicComNation::find($id);
    }
}
