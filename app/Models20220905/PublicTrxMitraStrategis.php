<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class PublicTrxMitraStrategis extends Model
{
    use Uuid;

    protected $table            = 'public.trx_mitra_strategis';
    private static $tableName   = 'public.trx_mitra_strategis';
    protected $primaryKey       = 'trx_mitra_strategis_id';
    public $incrementing        = false;

    protected $fillable = [
        'trx_mitra_strategis_id',
        'mitra_strategis_nm',
        'instansi',
        'jabatan',
        'created_by',
        'updated_by'
    ];
}
