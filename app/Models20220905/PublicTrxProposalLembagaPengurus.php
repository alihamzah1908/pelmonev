<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

/**
 * App\Models\PublicTrxProposalLembagaPengurus
 *
 * @property string $trx_proposal_lembaga_pengurus_id
 * @property string|null $trx_proposal_id
 * @property string|null $pengurus_nm
 * @property string|null $jabatan_nm
 * @property string|null $pekerjaan_nm
 * @property string|null $note
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLembagaPengurus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLembagaPengurus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLembagaPengurus query()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLembagaPengurus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLembagaPengurus whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLembagaPengurus whereJabatanNm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLembagaPengurus whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLembagaPengurus wherePekerjaanNm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLembagaPengurus wherePengurusNm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLembagaPengurus whereTrxProposalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLembagaPengurus whereTrxProposalLembagaPengurusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLembagaPengurus whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLembagaPengurus whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class PublicTrxProposalLembagaPengurus extends Model
{
    use Uuid;

    protected $table            = 'public.trx_proposal_lembaga_pengurus';
    private static $tableName   = 'public.trx_proposal_lembaga_pengurus';
    protected $primaryKey       = 'trx_proposal_lembaga_pengurus_id'; 
    public $incrementing        =  false;

    protected $fillable = [
        'trx_proposal_lembaga_pengurus_id',
        'trx_proposal_id',
        'pengurus_nm',
        'jabatan_nm',
        'pekerjaan_nm',
        'note',
        'created_by',
        'updated_by',
    ];
}
