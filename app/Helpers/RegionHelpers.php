<?php
if ( ! function_exists('getRegionNm')){
    function getRegionNm($id){
        $region = App\Models\ComRegion::where('region_cd', $id)->first();

        if($region){
            return $region->region_nm;
        }else{
            return '';
        }
    }
}