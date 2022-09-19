<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class PublicTrxProposal extends Model
{
    use Uuid;

    protected $table            = 'public.trx_proses_proposal_child';
    private static $tableName   = 'public.trx_proses_proposal_child';
    protected $primaryKey       = 'trx_proses_proposal_child_id'; 
    public $incrementing        = false;

    protected $fillable = [
        'trx_proses_proposal_child_id',
        'trx_proposal_id',
        'proses_st_mr',
        'proses_st_hk'
    ];
}
