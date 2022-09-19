<?php
namespace App\Http\Controllers;

use DB;
use Auth;
use Datatables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ComRegion;
use App\Models\VwRegion;

class DaftarDaerahController extends Controller{
    /**
     * Display a listing of the resource for select2.
     *
     * @return \Illuminate\Http\Response
     */
    function getRegionList(Request $request, $id=NULL){
        $regionNmParam  = $request->get('term');
        $level          = $request->get('level');
        $action         = $request->route()->getAction();

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
                            concat(region_nm_kel, ' || ', region_nm_kec, ' || ', region_nm_kab, ' || ', region_nm_prop) as long_region"))
                            ->where("region_nm", "ILIKE", "%$regionNmParam%");

        if (!empty($action['region_level'])) {
            $regions->where('region_level','=',$action['region_level']);
        }

        if ($id) {
            $regions->where('region_root', $id);
        }

        $regions->limit(100);
        
        return response()->json($regions->get());
    }
}
