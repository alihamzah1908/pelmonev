<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\VwRegion
 *
 * @property string|null $region_cd
 * @property string|null $region_nm
 * @property int|null $region_level
 * @property string|null $region_level_nm
 * @property string|null $region_root
 * @property string|null $region_root_nm
 * @property string|null $region_capital
 * @property string|null $region_cd_prop
 * @property string|null $region_nm_prop
 * @property string|null $region_cd_kab
 * @property string|null $region_nm_kab
 * @property string|null $region_cd_kec
 * @property string|null $region_nm_kec
 * @property string|null $region_cd_kel
 * @property string|null $region_nm_kel
 * @method static \Illuminate\Database\Eloquent\Builder|VwRegion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VwRegion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VwRegion query()
 * @method static \Illuminate\Database\Eloquent\Builder|VwRegion whereRegionCapital($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VwRegion whereRegionCd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VwRegion whereRegionCdKab($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VwRegion whereRegionCdKec($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VwRegion whereRegionCdKel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VwRegion whereRegionCdProp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VwRegion whereRegionLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VwRegion whereRegionLevelNm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VwRegion whereRegionNm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VwRegion whereRegionNmKab($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VwRegion whereRegionNmKec($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VwRegion whereRegionNmKel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VwRegion whereRegionNmProp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VwRegion whereRegionRoot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VwRegion whereRegionRootNm($value)
 * @mixin \Eloquent
 */
class VwRegion extends Model
{
    protected $table        = 'vw_region';
    protected $primaryKey   = 'region_cd'; 
    public $incrementing    = false;
}
