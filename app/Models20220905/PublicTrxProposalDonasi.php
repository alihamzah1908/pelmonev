<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

/**
 * App\Models\PublicTrxProposalDonasi
 *
 * @property string $trx_proposal_donasi_id
 * @property string $trx_proposal_id
 * @property string|null $donatur
 * @property string|null $instansi
 * @property string|null $nominal
 * @property string|null $note
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalDonasi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalDonasi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalDonasi query()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalDonasi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalDonasi whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalDonasi whereDonatur($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalDonasi whereInstansi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalDonasi whereNominal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalDonasi whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalDonasi whereTrxProposalDonasiId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalDonasi whereTrxProposalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalDonasi whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalDonasi whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class PublicTrxProposalDonasi extends Model
{
    use Uuid;

    protected $table            = 'public.trx_proposal_donasi';
    private static $tableName   = 'public.trx_proposal_donasi';
    protected $primaryKey       = 'trx_proposal_donasi_id'; 
    public $incrementing        = false;

    protected $fillable = [
        'trx_proposal_donasi_id',
        'trx_proposal_id',
        'donatur',
        'instansi',
        'nominal',
        'note',
        'created_by',
        'updated_by',
    ];
}
