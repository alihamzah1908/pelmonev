<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

/**
 * App\Models\PublicTrxProposalPJ
 *
 * @property string $trx_proposal_pj_id
 * @property string $trx_proposal_id
 * @property string|null $nama
 * @property string|null $posisi
 * @property string|null $note
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPJ newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPJ newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPJ query()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPJ whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPJ whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPJ whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPJ whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPJ wherePosisi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPJ whereTrxProposalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPJ whereTrxProposalPjId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPJ whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPJ whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class PublicTrxProposalPJ extends Model
{
    use Uuid;

    protected $table            = 'public.trx_proposal_pj';
    private static $tableName   = 'public.trx_proposal_pj';
    protected $primaryKey       = 'trx_proposal_pj_id'; 
    public $incrementing        = false;

    protected $fillable = [
        'trx_proposal_pj_id',
        'trx_proposal_id',
        'nama',
        'posisi',
        'note',
        'created_by',
        'updated_by',
    ];
}
