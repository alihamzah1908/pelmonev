<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

/**
 * App\Models\PublicTrxProposalAnalisisHkVerif
 *
 * @property string $trx_proposal_analisis_hk_verif_id
 * @property string $trx_proposal_id
 * @property string|null $verif_id
 * @property string|null $verif_value
 * @property string|null $verif_note
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalAnalisisHkVerif newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalAnalisisHkVerif newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalAnalisisHkVerif query()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalAnalisisHkVerif whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalAnalisisHkVerif whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalAnalisisHkVerif whereTrxProposalAnalisisHkVerifId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalAnalisisHkVerif whereTrxProposalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalAnalisisHkVerif whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalAnalisisHkVerif whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalAnalisisHkVerif whereVerifId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalAnalisisHkVerif whereVerifNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalAnalisisHkVerif whereVerifValue($value)
 * @mixin \Eloquent
 */
class PublicTrxProposalAnalisisHkVerif extends Model
{
    use Uuid;

    protected $table            = 'public.trx_proposal_analisis_hk_verif';
    private static $tableName   = 'public.trx_proposal_analisis_hk_verif';
    protected $primaryKey       = 'trx_proposal_analisis_hk_verif_id'; 
    public $incrementing        = false;

    protected $fillable = [
        'trx_proposal_analisis_hk_verif_id',
        'trx_proposal_id',
        'verif_id',
        'verif_value',
        'verif_note',
        'created_by',
        'updated_by',
    ];
}
