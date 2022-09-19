<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
class PublicTrxUjiKelayakan extends Model
{
    use Uuid;

    protected $table            = 'public.trx_uji_kelayakan_mk';
    private static $tableName   = 'public.trx_uji_kelayakan_mk';
    protected $primaryKey       = 'trx_uji_kelayakan_mk_id'; 
    public $incrementing        = false;

    protected $fillable = [
        'trx_uji_kelayakan_mk_id',
        'trx_proposal_id',
        'uji_kelayakan',
        'summary_assess'
    ];
}
