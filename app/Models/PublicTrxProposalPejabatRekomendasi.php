<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

/**
 * App\Models\PublicTrxProposalPejabatRekomendasi
 *
 * @property string $trx_proposal_pejabat_rekomendasi_id
 * @property string $trx_proposal_id
 * @property string|null $nama
 * @property string|null $jabatan
 * @property string|null $institusi
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPejabatRekomendasi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPejabatRekomendasi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPejabatRekomendasi query()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPejabatRekomendasi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPejabatRekomendasi whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPejabatRekomendasi whereInstitusi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPejabatRekomendasi whereJabatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPejabatRekomendasi whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPejabatRekomendasi whereTrxProposalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPejabatRekomendasi whereTrxProposalPejabatRekomendasiId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPejabatRekomendasi whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPejabatRekomendasi whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class PublicTrxProposalPejabatRekomendasi extends Model
{
    use Uuid;

    protected $table            = 'public.trx_proposal_pejabat_rekomendasi';
    private static $tableName   = 'public.trx_proposal_pejabat_rekomendasi';
    protected $primaryKey       = 'trx_proposal_pejabat_rekomendasi_id'; 
    public $incrementing        = false;

    protected $fillable = [
        'trx_proposal_pejabat_rekomendasi_id',
        'trx_proposal_id',
        'nama',
        'jabatan',
        'institusi',
        'created_by',
        'updated_by',
    ];

    static function getLastStatus($id)
    {
        $data     = PublicTrxProposalPejabatRekomendasi::where('trx_proposal_id', $id)->orderBy('created_at', 'desc')->first();
        
        return $data;
    }
}
