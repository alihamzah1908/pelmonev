<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

/**
 * App\Models\PublicTrxProposalAnalisisHk
 *
 * @property string $trx_proposal_analisis_hk_id
 * @property string $trx_proposal_id
 * @property mixed|null $verifikasi
 * @property string|null $analisa_legalitas
 * @property string|null $analisa_peraturan
 * @property string|null $analisa_hukum
 * @property string|null $kesimpulan
 * @property string|null $rekomendasi
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalAnalisisHk newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalAnalisisHk newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalAnalisisHk query()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalAnalisisHk whereAnalisaHukum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalAnalisisHk whereAnalisaLegalitas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalAnalisisHk whereAnalisaPeraturan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalAnalisisHk whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalAnalisisHk whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalAnalisisHk whereKesimpulan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalAnalisisHk whereRekomendasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalAnalisisHk whereTrxProposalAnalisisHkId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalAnalisisHk whereTrxProposalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalAnalisisHk whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalAnalisisHk whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalAnalisisHk whereVerifikasi($value)
 * @mixin \Eloquent
 */
class PublicTrxProposalAnalisisHk extends Model
{
    use Uuid;

    protected $table            = 'public.trx_proposal_analisis_hk';
    private static $tableName   = 'public.trx_proposal_analisis_hk';
    protected $primaryKey       = 'trx_proposal_analisis_hk_id'; 
    public $incrementing        = false;

    protected $fillable = [
        'trx_proposal_analisis_hk_id',
        'trx_proposal_id',
        'verifikasi',
        'analisa_legalitas',
        'analisa_peraturan',
        'analisa_hukum',
        'kesimpulan',
        'rekomendasi',
        'created_by',
        'updated_by',
    ];
}
