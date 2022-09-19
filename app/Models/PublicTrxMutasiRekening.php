<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class PublicTrxMutasiRekening extends Model
{
    use Uuid;

    protected $table            = 'public.trx_mutasi_rekening';
    private static $tableName   = 'public.trx_mutasi_rekening';
    protected $primaryKey       = 'trx_mutasi_rek_id';
    public $incrementing        = false;

    protected $fillable = [
        'trx_mutasi_rek_id',
        'post_date',
        'post_time',
        'eff_date',
        'eff_time',
        'description',
        'debit',
        'credit',
        'balance',
        'ref_no',
        'created_by',
        'updated_by'
    ];
}
