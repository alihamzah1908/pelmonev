<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

/**
 * App\Models\PublicTrxProposalLembagaKerjasama
 *
 * @property string $trx_proposal_lembaga_kerjasama_id
 * @property string|null $trx_proposal_id
 * @property string|null $lembaga_nm
 * @property string|null $kegiatan_nm
 * @property string|null $nominal_bantuan
 * @property string|null $note
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLembagaKerjasama newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLembagaKerjasama newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLembagaKerjasama query()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLembagaKerjasama whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLembagaKerjasama whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLembagaKerjasama whereKegiatanNm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLembagaKerjasama whereLembagaNm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLembagaKerjasama whereNominalBantuan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLembagaKerjasama whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLembagaKerjasama whereTrxProposalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLembagaKerjasama whereTrxProposalLembagaKerjasamaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLembagaKerjasama whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLembagaKerjasama whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class PublicTrxProposalLembagaKerjasama extends Model
{
    use Uuid;

    protected $table            = 'public.trx_proposal_lembaga_kerjasama';
    private static $tableName   = 'public.trx_proposal_lembaga_kerjasama';
    protected $primaryKey       = 'trx_proposal_lembaga_kerjasama_id'; 
    public $incrementing        = false;

    protected $fillable = [
        'trx_proposal_lembaga_kerjasama_id',
        'trx_proposal_id',
        'lembaga_nm',
        'kegiatan_nm',
        'nominal_bantuan',
        'note',
        'created_by',
        'updated_by',
    ];
}
