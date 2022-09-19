<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ComCode
 *
 * @property string $com_cd
 * @property string $code_nm
 * @property string $code_group
 * @property string|null $code_value
 * @property string|null $code_value_2
 * @property string|null $code_value_3
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ComCode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ComCode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ComCode query()
 * @method static \Illuminate\Database\Eloquent\Builder|ComCode whereCodeGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComCode whereCodeNm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComCode whereCodeValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComCode whereCodeValue2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComCode whereCodeValue3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComCode whereComCd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComCode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComCode whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComCode whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComCode whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class ComCode extends Model{
    protected $table        	= 'com_code';
	private static $tableName   = 'com_code';
    protected $primaryKey   = 'com_cd'; 
    public $incrementing    = false;

    protected $fillable = [
        'com_cd', 
		'code_nm', 
		'code_group',
		'code_value',
		'code_value_2',
		'code_value_3',
		'created_by', 
		'updated_by'
    ];

    public static function getComCd($codeGroup){
        $code = ComCode::where('code_group', $codeGroup)->count();

        return $codeGroup.'_'.str_pad($code + 1 , 2 , "0" ,STR_PAD_LEFT);
    }
	
	public static function getCodeGroup($codeGroup){
		$data = DB::table(Self::$tableName.' as A')
			->where('A.code_group',$codeGroup)
			->select('A.com_cd','A.code_nm','A.code_group','A.code_value')
			->orderBy('A.com_cd')
			->distinct();
        
		return $data;
    }
	
	public static function getAllGroup($groups){
		$data = DB::table(Self::$tableName)->whereIn('code_group',$groups)->distinct()->get(['code_group']);
		
		return $data;
		
		/*$query = DB::table(Self::$tableName.' as A')
			->select('A.code_group')
			->orderBy('A.com_cd')
			->distinct();
			
		return $query->get();*/
    }
}
