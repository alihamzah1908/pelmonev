<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

/**
 * App\Models\PublicTrxMitraKemaslahatan
 *
 * @property string $trx_mitra_kemaslahatan_id
 * @property string $mitra_kemaslahatan_nm
 * @property string|null $phone
 * @property string|null $region_prop
 * @property string|null $region_kab
 * @property string|null $region_kec
 * @property string|null $region_kel
 * @property string|null $address
 * @property string|null $email
 * @property string|null $email2
 * @property string|null $email3
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxMitraKemaslahatan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxMitraKemaslahatan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxMitraKemaslahatan query()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxMitraKemaslahatan whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxMitraKemaslahatan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxMitraKemaslahatan whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxMitraKemaslahatan whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxMitraKemaslahatan whereEmail2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxMitraKemaslahatan whereEmail3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxMitraKemaslahatan whereMitraKemaslahatanNm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxMitraKemaslahatan wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxMitraKemaslahatan whereRegionKab($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxMitraKemaslahatan whereRegionKec($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxMitraKemaslahatan whereRegionKel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxMitraKemaslahatan whereRegionProp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxMitraKemaslahatan whereTrxMitraKemaslahatanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxMitraKemaslahatan whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxMitraKemaslahatan whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class PublicTrxMitraKemaslahatan extends Model
{
    use Uuid;

    protected $table            = 'public.trx_mitra_kemaslahatan';
    private static $tableName   = 'public.trx_mitra_kemaslahatan';
    protected $primaryKey       = 'trx_mitra_kemaslahatan_id'; 
    public $incrementing        = false;

    protected $fillable = [
        'trx_mitra_kemaslahatan_id',
        'mitra_kemaslahatan_nm',
        'phone',
        'email',
        'email2',
        'email3',
        'region_prop',
        'region_kab',
        'region_kec',
        'region_kel',
        'address',
        'created_by',
        'updated_by'
    ];
}
