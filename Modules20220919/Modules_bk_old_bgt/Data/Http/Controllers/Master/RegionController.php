<?php
namespace Modules\Data\Http\Controllers\Master;

use DB;
use Auth;
use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ComRegion;
use App\Models\VwRegion;

class RegionController extends Controller{
    private $folder_path = 'master.region';
    
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
        $title 			= 'Data Wilayah';
		
		$rootcd         = '';
		$rootnm         = '';
		$region         = 'Propinsi';
		$parent         = '';
		$child          = 'Kabupaten';
		$level          = '1';
		
		return view('data::' . $this->folder_path . '.' . $filename_page, 
					compact('title','rootcd','rootnm','region','parent','child','level'));
    }
	
	/**
     * Show : DataTables
     *
     * @return \Illuminate\Http\Response
     */
    function getData(Request $request){
		$link = 'Kabupaten';
		$data = ComRegion::getRegionByRoot('',1);
		
		return DataTables::of($data)
		->addColumn('actions',function($data) use ($link){
            $actions = '';
			$actions .= "<button type='button' id='detail' class='btn btn-info btn-flat btn-sm' data-toggle='tooltip' data-placement='top' title='" .$link ."'><i class='icon icon-menu-open'>" .$link ."</i> </button> &nbsp";
            $actions .= "<button type='button' id='ubah'  class='btn btn-warning btn-flat btn-sm' data-toggle='tooltip' data-placement='top' title='Ubah Data'><i class='icon icon-pencil7'></i> </button> &nbsp";
            $actions .= "<button type='button' id='hapus' class='btn btn-danger btn-flat btn-sm' data-toggle='tooltip' data-placement='top' title='Hapus Data'><i class='icon icon-trash'></i> </button> &nbsp";
            //$actions .= "<button type='button' id='detail' class='btn btn-info btn-flat btn-sm' data-toggle='tooltip' data-placement='top' title='Detail Data'><i class='icon icon-menu-open'></i> </button>";
            
            return $actions;
        })
        ->rawColumns(['actions'])
        ->make(true);
    }
	
	function indexroot($id = NULL){
        $filename_page 	= 'index';
        $title 			= 'Data Wilayah';
		
		$dataregion 	= ComRegion::find($id);
		
        $rootcd         = $id;
		$rootnm         = $dataregion->region_nm;
		$region         = '';
		$parent         = '';
		$child          = '';
		$level          = $dataregion->region_level;
		
		//if (!empty($dataregion)) { }
		switch ($dataregion->region_level + 1) {
			case 2:
				$region	= 'Kabupaten';
				$parent = 'Propinsi';
				$child	= 'Kecamatan';
				break;
			case 3:
				$region	= 'Kecamatan';
				$parent = 'Kabupaten';
				$child	= 'Kelurahan';
				break;
			case 4:
				$region	= 'Kelurahan';
				$parent = 'Kecamatan';
				$child	= '';
				break;
			default:
				$region	= '';
				$parent = '';
				$child	= '';
		}
		
		/*if (!empty($dataregion)) {
			if($dataregion->region_level == 1) {
				$region	= 'Propinsi';
				$parent = '';
				$child	= 'Kabupaten';
			}elseif($dataregion->region_level == 2) {
				$region	= 'Kabupaten';
				$parent = 'Propinsi';
				$child	= 'Kecamatan';
			}elseif($dataregion->region_level == 3) {
				$region	= 'Kecamatan';
				$parent = 'Kabupaten';
				$child	= 'Kelurahan';
			}elseif($dataregion->region_level == 4) {
				$region	= 'Kelurahan';
				$parent = 'Kecamatan';
				$child	= '';
			}else {
				$region	= '';
				$parent = '';
				$child	= '';
			}
		}*/
		
		return view('data::' . $this->folder_path . '.' . $filename_page, 
					compact('title','rootcd','rootnm','region','parent','child','level'));
    }

    function getRegionByRoot(Request $request){
		$link = '';
		switch ($request->level + 1) {
			case 2:
				$link	= 'Kecamatan';
				break;
			case 3:
				$link	= 'Kelurahan';
				break;
			default:
				$link	= '';
		}
		
		$data = ComRegion::getRegionByRoot($request->rootcd,$request->level + 1);
		
		return DataTables::of($data)
		->addColumn('actions',function($data) use ($link){
            $actions = '';
			if($link != '') {
			$actions .= "<button type='button' id='detail' class='btn btn-info btn-flat btn-sm' data-toggle='tooltip' data-placement='top' title='" .$link ."'><i class='icon icon-menu-open'>" .$link ."</i> </button> &nbsp";
			}
            $actions .= "<button type='button' id='ubah'  class='btn btn-warning btn-flat btn-sm' data-toggle='tooltip' data-placement='top' title='Ubah Data'><i class='icon icon-pencil7'></i> </button> &nbsp";
            $actions .= "<button type='button' id='hapus' class='btn btn-danger btn-flat btn-sm' data-toggle='tooltip' data-placement='top' title='Hapus Data'><i class='icon icon-trash'></i> </button> &nbsp";
            //$actions .= "<button type='button' id='detail' class='btn btn-info btn-flat btn-sm' data-toggle='tooltip' data-placement='top' title='Detail Data'><i class='icon icon-menu-open'></i> </button>";
            
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
            'region_cd'      => 'required|unique:com_region',
            'region_nm'      => 'required',
            'region_capital' => 'nullable',
            'region_root'    => 'nullable',
        ]);
        
        if (!empty($request->region_root)) {
            $regionRoot=ComRegion::find($request->region_root);
            $regionLevel=$regionRoot->region_level+1;
        }else{
            $regionLevel=1;
        }
        
        $region = ComRegion::create([
            'region_cd'     => $request->region_cd,
            'region_nm'     => $request->region_nm,
            'region_root'   => $request->region_root,
            'region_capital'=> $request->region_capital,
            'region_level'  => $regionLevel,
            'created_by'    => Auth::user()->user_id
        ]);

        return response()->json(['status' => 'ok'],200); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    function show($id){
		$region = ComRegion::find($id);
        //$region = VwRegion::select(DB::Raw("*, trim(concat(region_nm_kel, ', ', region_nm_kec, ', ', region_nm_kab, ', ', region_nm_prop),', ') as long_region"))->find($id);

        if($region){
            return response()->json(['status' => 'ok', 'data' => $region],200);
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
            'region_nm'      => 'required',
            'region_capital' => 'nullable',
            'region_root'    => 'nullable',
        ]);
        
        if (!empty($request->region_root)) {
            $regionRoot=ComRegion::find($request->region_root);
            $regionLevel=$regionRoot->region_level+1;
        }else{
            $regionLevel=1;
        }
        
        $region = ComRegion::find($id);

        $region->region_nm     = $request->region_nm;
        $region->region_root   = $request->region_root;
        $region->region_capital= $request->region_capital;
        $region->region_level  = $regionLevel;
        $region->updated_by    = Auth::user()->user_id;

        $region->save();

        return response()->json(['status' => 'ok'],200); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    function destroy($id){
        ComRegion::destroy($id);

        return response()->json(['status' => 'ok'],200);
    }
	
	function getRegionList(Request $request, $id=NULL){
        $regionNmParam  = $request->get('term');
		
        $action = $request->route()->getAction();
		
		if (!empty($id)) {
			$dataregion = ComRegion::find($id);
			$level = $dataregion->region_level + 1;
		}else {
			$level = 1;
		}
		
		if (!empty($action['region_level'])) {
			$level = $action['region_level'];
		}
        
		$regions = ComRegion::getRegionList($regionNmParam, $id, $level);
        
        return response()->json($regions);
    }
	
	/*function getRegionList(Request $request, $id=NULL){
        $regionNmParam  = $request->get('term');
		$action         = $request->route()->getAction();
		
		$regions        = ComRegion::select(DB::raw("region_cd as id, region_nm as text"))
                            ->where("region_nm", "LIKE", "%$regionNmParam%");
							
        if (!empty($action['region_level'])) {
            $regions->where('region_level','=',$action['region_level']);
        }
		if ($id) {
            $regions->where('region_root', $id);
        }
		$regions->limit(100);
        
        return response()->json($regions->get());
    }*/
	
	function getRegionView(Request $request, $id=NULL){
        $regionNmParam  = $request->get('term');
		
        $action         = $request->route()->getAction();
		$level          = $action['region_level'];
		
		$regions        = VwRegion::select(DB::raw("region_cd as id, 
                            region_nm as text, 
                            region_root,
                            region_cd_prop,
                            region_nm_prop,
                            region_cd_kab,
                            region_nm_kab,
                            region_cd_kec,
                            region_nm_kec,
                            region_cd_kel,
                            region_nm_kel,
                            trim(concat(region_nm_kel, ' , ', region_nm_kec, ' , ', region_nm_kab, ' , ', region_nm_prop, ', ')) as long_region"))
                            ->where("region_nm", "LIKE", "%$regionNmParam%");
							
        /*$regions        = VwRegion::select(DB::raw("region_cd as id, 
                            region_nm as text, 
                            region_root,
                            region_cd_prop,
                            region_nm_prop,
                            region_cd_kab,
                            region_nm_kab,
                            region_cd_kec,
                            region_nm_kec,
                            region_cd_kel,
                            region_nm_kel,
                            trim(concat(region_nm_kel, ' || ', region_nm_kec, ' || ', region_nm_kab, ' || ', region_nm_prop)) as long_region"))
                            ->where("region_nm", "LIKE", "%$regionNmParam%");*/
		
		if (!empty($action['region_level'])) {
            $regions->where('region_level','=',$action['region_level']);
        }
		if ($id) {
            $regions->where('region_root', $id);
        }
		$regions->limit(100);
        
        return response()->json($regions->get());
    }

    /*function getRegionView(Request $request){
        $data   = VwRegion::select('vw_region.region_cd',
                                   'vw_region.region_nm',
                                   'vw_region.region_level_nm',
                                   'vw_region.region_root_nm',
                                   'vw_region.region_capital'
                                );
        
        if(!empty($request->root)) {
            $data->where('vw_region.region_root', $request->root);
        }else{
            // $data->where('com_region.region_level', 1);
        }

        return Datatables::of($data)->make(true);
    }*/
	
	public static function getRegionById($id){
        return VwRegion::find($id);
    }
}
