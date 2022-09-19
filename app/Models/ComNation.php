<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ComNation
 *
 * @property string $nation_cd
 * @property string $nation_nm
 * @property string|null $capital
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ComNation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ComNation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ComNation query()
 * @method static \Illuminate\Database\Eloquent\Builder|ComNation whereCapital($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComNation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComNation whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComNation whereNationCd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComNation whereNationNm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComNation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComNation whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class ComNation extends Model{
    protected $table        = 'com_nation';
	protected $primaryKey   = 'nation_cd'; 
    public $incrementing    = false;

    protected $fillable = [
        'nation_cd', 'nation_nm', 'capital','created_by', 'updated_by'
    ];
	
	public static function getNationList($param=NULL){
		$query = ComNation::select("nation_cd as id", "nation_nm as text")
					->where("nation_nm", "LIKE", "%$param%")
					->orderBy("nation_nm");
					
        $query->limit(100);
        
        return $query->get();
    }
}
