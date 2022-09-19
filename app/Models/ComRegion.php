<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ComRegion
 *
 * @property string $region_cd
 * @property string $region_nm
 * @property string|null $region_root
 * @property string|null $region_capital
 * @property int|null $region_level
 * @property string $default_st
 * @property string|null $region_cd_maps
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ComRegion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ComRegion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ComRegion query()
 * @method static \Illuminate\Database\Eloquent\Builder|ComRegion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComRegion whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComRegion whereDefaultSt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComRegion whereRegionCapital($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComRegion whereRegionCd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComRegion whereRegionCdMaps($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComRegion whereRegionLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComRegion whereRegionNm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComRegion whereRegionRoot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComRegion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComRegion whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class ComRegion extends Model{
    protected $table        	= 'com_region';
	protected Static $tableName = 'com_region';
	protected Static $viewName  = 'vw_region';
    protected $primaryKey    	= 'region_cd'; 
    public $incrementing    	= false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'region_cd',
        'region_nm',
        'region_root',
        'region_capital',
        'region_alias',
        'region_level',
        'region_cd_maps',
        'default_st',
        'region_tp',
        'created_by',
        'updated_by',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
	
	public static function getRegionByRoot($root=NULL,$level=NULL){
		$query = DB::table(Self::$tableName.' as A')
                ->leftJoin('com_region as B','A.region_root','=','B.region_cd')
                //->where('A.region_root','=',$root)
                //->where('A.region_level','=',$level)
				->select('A.region_cd','A.region_nm','A.region_root','B.region_nm AS region_root_nm')
                ->orderBy('A.region_cd')
                ->distinct();
				
		if(!empty($root)) {
            $query->where('A.region_root','=', $root);
        }
		if(!empty($level)) {
			if($level != '') {
				$query->where('A.region_level','=', $level);
			}
        }

        return $query->get();
    }
	public static function getRegionList($param=NULL,$root=NULL,$level=NULL){
		$query = DB::table(Self::$tableName.' as A')
                ->leftJoin('com_region as B','A.region_root','=','B.region_cd')
                ->where("A.region_nm", "LIKE", "%$param%")
				->select('A.region_cd as id','A.region_nm as text', 'B.region_nm as root')
                ->orderBy('A.region_cd');
		//'B.region_nm as root'
		//DB::Raw('IFNULL( `B`.`region_nm` , 0 ) as root')
        
		/*$query = ComRegion::select(DB::raw("region_cd as id, region_nm as text"))
					->where("region_nm", "LIKE", "%$param%");*/
							
        if(!empty($root)) {
            $query->where('A.region_root', $root);
        }
		if(!empty($level)) {
			if($level != '') {
				$query->where('A.region_level','=', $level);
			}
        }
		
		$query->limit(100);
        
        return $query->get();
    }
	
	public static function getRegionView($param=NULL,$root=NULL,$level=NULL){
        $query = VwRegion::select(DB::raw("region_cd as id, 
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
					->where("region_nm", "LIKE", "%$param%");

        if(!empty($root)) {
            $query->where('region_root', $root);
        }
		if(!empty($level)) {
			if($level != '') {
				$query->where('region_level','=', $level);
			}
        }

        $query->limit(100);
        
        return $query->get();
    }

    /*public static function getRegionView($root=NULL){
		$query = VwRegion::select('vw_region.region_cd',
				  'vw_region.region_nm',
				  'vw_region.region_level_nm',
				  'vw_region.region_root_nm',
				  'vw_region.region_capital'
				 );
		
		if(!empty($root)) {
            $query->where('vw_region.region_root', $root);
        }
		
		return $query->get();
    }*/
	
	public static function getRegionById($id){
        return VwRegion::find($id);
    }
}
