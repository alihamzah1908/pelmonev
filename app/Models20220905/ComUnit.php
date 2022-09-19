<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

/**
 * App\Models\ComUnit
 *
 * @property string $unit_cd
 * @property string $unit_nm
 * @property string $unit_root
 * @property string $unit_data1
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ComUnit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ComUnit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ComUnit query()
 * @method static \Illuminate\Database\Eloquent\Builder|ComUnit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComUnit whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComUnit whereUnitCd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComUnit whereUnitData1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComUnit whereUnitNm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComUnit whereUnitRoot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComUnit whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComUnit whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class ComUnit extends Model{
    protected $table        = 'com_unit';
    private static $tableName   = 'com_unit';
    protected $primaryKey   = 'unit_cd'; 
    public $incrementing    = false;

    protected $fillable = [
        'unit_cd','unit_nm','unit_root','unit_data1','created_by','updated_by'
    ];
}
