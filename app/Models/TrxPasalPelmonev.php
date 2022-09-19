<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class TrxPasalPelmonev extends Model
{
    use Uuid;

    protected $table            = 'public.trx_pasal_pelmonev';
    private static $tableName   = 'public.trx_pasal_pelmonev';
    protected $primaryKey       = 'trx_pasal_id';
    public $incrementing        = false;

    protected $fillable = [
        'trx_pasal_id',
        'trx_pelmonev_pks_id',
        'pasal',
        'ayat_tambahan',
        'created_by',
        'updated_by'
    ];
}
