<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class PublicTrxProposalAnalisKepatuhan extends Model
{
    use Uuid;

    protected $table            = 'public.trx_proposal_analis_kepatuhan';
    private static $tableName   = 'public.trx_proposal_analis_kepatuhan';
    protected $primaryKey       = 'trx_proposal_analis_kepatuhan_id'; 
    public $incrementing        = false;

    protected $fillable = [
        'trx_proposal_analis_kepatuhan_id',
        'trx_proposal_id',
        'verif_1_value',
        'verif_1_note',
        'verif_2_value',
        'verif_2_note',
        'verif_3a_value',
        'verif_3a_note',
        'verif_3b_value',
        'verif_3b_note',
        'verif_3c_value',
        'verif_3c_note',
        'verif_4a_value',
        'verif_4a_note',
        'verif_4b_value',
        'verif_4b_note',
        'verif_4c_value',
        'verif_4c_note',
        'created_by',
        'updated_by',
    ];
}
