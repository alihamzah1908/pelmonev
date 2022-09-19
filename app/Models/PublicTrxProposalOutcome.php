<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

/**
 * App\Models\PublicTrxProposalOutcome
 *
 * @property string $trx_proposal_outcome_id
 * @property string $trx_proposal_id
 * @property string|null $sub_kegiatan
 * @property string|null $outcome
 * @property string|null $output
 * @property string|null $note
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalOutcome newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalOutcome newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalOutcome query()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalOutcome whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalOutcome whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalOutcome whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalOutcome whereOutcome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalOutcome whereOutput($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalOutcome whereSubKegiatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalOutcome whereTrxProposalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalOutcome whereTrxProposalOutcomeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalOutcome whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalOutcome whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class PublicTrxProposalOutcome extends Model
{
    use Uuid;

    protected $table            = 'public.trx_proposal_outcome';
    private static $tableName   = 'public.trx_proposal_outcome';
    protected $primaryKey       = 'trx_proposal_outcome_id'; 
    public $incrementing        = false;

    protected $fillable = [
        'trx_proposal_outcome_id',
        'trx_proposal_id',
        'sub_kegiatan',
        'outcome',
        'output',
        'note',
        'created_by',
        'updated_by',
    ];
}
