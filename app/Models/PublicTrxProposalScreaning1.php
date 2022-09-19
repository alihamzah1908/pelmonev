<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

/**
 * App\Models\PublicTrxProposalScreaning1
 *
 * @property string $trx_proposal_screaning1_id
 * @property string $trx_proposal_id
 * @property string|null $nama
 * @property string|null $jabatan
 * @property string|null $institusi
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalScreaning1 newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalScreaning1 newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalScreaning1 query()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalScreaning1 whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalScreaning1 whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalScreaning1 whereInstitusi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalScreaning1 whereJabatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalScreaning1 whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalScreaning1 whereTrxProposalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalScreaning1 whereTrxProposalPejabatRekomendasiId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalScreaning1 whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalScreaning1 whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class PublicTrxProposalScreaning1 extends Model
{
    use Uuid;

    protected $table            = 'public.trx_proposal_screaning1';
    private static $tableName   = 'public.trx_proposal_screaning1';
    protected $primaryKey       = 'trx_screaning1_id'; 
    public $incrementing        = false;

    protected $fillable = [
        'trx_screaning1_id',
        'trx_proposal_id',
        'trx_mitra_kemaslahatan_id',
        'target_penyelesaian',
        'note',
        'created_by',
        'updated_by',
    ];

    static function getLastStatus($id)
    {
        $data     = PublicTrxProposalScreaning1::where('trx_proposal_id', $id)->orderBy('created_at', 'desc')->first();
        
        return $data;
    }
}
