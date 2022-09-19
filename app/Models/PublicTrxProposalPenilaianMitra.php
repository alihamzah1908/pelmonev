<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class PublicTrxProposalPenilaianMitra extends Model
{
    use Uuid;

    protected $table            = 'public.trx_proposal_penilaian_mitra_kemaslahatan';
    private static $tableName   = 'public.trx_proposal_penilaian_mitra_kemaslahatan';
    protected $primaryKey       = 'trx_proposal_penilaian_id';
    public $incrementing        = false;

    protected $fillable = [
        'trx_proposal_penilaian_id',
        'trx_proposal_id',
        'pen_mitra_bh',
        'pen_mitra_sdm_pen',
        'pen_mitra_ruang_lingkup',
        'pen_mitra_dk',
        'pen_mitra_djk',
        'created_by',
        'updated_by'
    ];
}
