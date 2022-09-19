<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class PublicTrxMitraStrategis1 extends Model
{
    use Uuid;

    protected $table            = 'public.trx_mitra_strategis_1';
    private static $tableName   = 'public.trx_mitra_strategis_1';
    protected $primaryKey       = 'trx_mitra_strategis_id';
    public $incrementing        = false;

    protected $fillable = [
        'trx_mitra_strategis_id',
        'ms_code',
        'ms_name',
        'pejabat_name',
        'jabatan',
        'instansi',
        'region_prop',
        'created_by',
        'updated_by'
    ];
}
