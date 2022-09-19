<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

/**
 * App\Models\PublicTrxProposalAnalisisResiko
 *
 * @property string $trx_proposal_analisis_resiko_id
 * @property string $trx_proposal_id
 * @property string|null $resiko_reputasi
 * @property string|null $resiko_keberlanjutan
 * @property string|null $mitigasi_resiko_reputasi
 * @property string|null $mitigasi_resiko_keberlanjutan
 * @property string|null $kesimpulan
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalAnalisisResiko newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalAnalisisResiko newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalAnalisisResiko query()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalAnalisisResiko whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalAnalisisResiko whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalAnalisisResiko whereKesimpulan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalAnalisisResiko whereMitigasiResikoKeberlanjutan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalAnalisisResiko whereMitigasiResikoReputasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalAnalisisResiko whereResikoKeberlanjutan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalAnalisisResiko whereResikoReputasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalAnalisisResiko whereTrxProposalAnalisisResikoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalAnalisisResiko whereTrxProposalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalAnalisisResiko whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalAnalisisResiko whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class PublicTrxProposalAnalisisResiko extends Model
{
    use Uuid;

    protected $table            = 'public.trx_proposal_analisis_resiko';
    private static $tableName   = 'public.trx_proposal_analisis_resiko';
    protected $primaryKey       = 'trx_proposal_analisis_resiko_id'; 
    public $incrementing        = false;

    protected $fillable = [
        'trx_proposal_analisis_resiko_id',
        'trx_proposal_id',
        'resiko_reputasi',
        'resiko_keberlanjutan',
        'mitigasi_resiko_reputasi',
        'mitigasi_resiko_keberlanjutan',
        'kesimpulan',
        'created_by',
        'updated_by',
    ];
}
