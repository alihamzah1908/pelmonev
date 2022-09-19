<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

/**
 * App\Models\PublicTrxProposalPersiapan
 *
 * @property string $trx_proposal_persiapan_id
 * @property string $trx_proposal_id
 * @property string|null $komponen_persiapan
 * @property int|null $progress
 * @property string|null $note
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPersiapan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPersiapan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPersiapan query()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPersiapan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPersiapan whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPersiapan whereKomponenPersiapan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPersiapan whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPersiapan whereProgress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPersiapan whereTrxProposalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPersiapan whereTrxProposalPersiapanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPersiapan whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPersiapan whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class PublicTrxProposalPersiapan extends Model
{
    use Uuid;

    protected $table            = 'public.trx_proposal_persiapan';
    private static $tableName   = 'public.trx_proposal_persiapan';
    protected $primaryKey       = 'trx_proposal_persiapan_id'; 
    public $incrementing        = false;

    protected $fillable = [
        'trx_proposal_persiapan_id',
        'trx_proposal_id',
        'komponen_persiapan',
        'progress',
        'note',
        'created_by',
        'updated_by',
    ];
}
