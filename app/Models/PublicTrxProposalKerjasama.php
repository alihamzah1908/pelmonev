<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

/**
 * App\Models\PublicTrxProposalKerjasama
 *
 * @property string $trx_proposal_kerjasama_id
 * @property string $trx_proposal_id
 * @property string|null $jenis_kontraprestasi
 * @property int|null $jumlah
 * @property string|null $nama_paket
 * @property string|null $note
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalKerjasama newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalKerjasama newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalKerjasama query()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalKerjasama whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalKerjasama whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalKerjasama whereJenisKontraprestasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalKerjasama whereJumlah($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalKerjasama whereNamaPaket($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalKerjasama whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalKerjasama whereTrxProposalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalKerjasama whereTrxProposalKerjasamaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalKerjasama whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalKerjasama whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class PublicTrxProposalKerjasama extends Model
{
    use Uuid;

    protected $table            = 'public.trx_proposal_kerjasama';
    private static $tableName   = 'public.trx_proposal_kerjasama';
    protected $primaryKey       = 'trx_proposal_kerjasama_id'; 
    public $incrementing        = false;

    protected $fillable = [
        'trx_proposal_kerjasama_id',
        'trx_proposal_id',
        'jenis_kontraprestasi',
        'jumlah',
        'nama_paket',
        'note',
        'created_by',
        'updated_by',
    ];
}
