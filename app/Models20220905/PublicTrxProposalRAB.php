<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

/**
 * App\Models\PublicTrxProposalRAB
 *
 * @property string $trx_proposal_rab_id
 * @property string $trx_proposal_id
 * @property string|null $jenis_pengeluaran
 * @property string|null $satuan
 * @property int|null $jumlah_unit
 * @property string|null $biaya_satuan
 * @property string|null $total
 * @property int|null $jumlah_unit_mitra
 * @property string|null $biaya_satuan_mitra
 * @property string|null $total_mitra
 * @property int|null $jumlah_unit_bpkh
 * @property string|null $biaya_satuan_bpkh
 * @property string|null $total_bpkh
 * @property string|null $note
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalRAB newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalRAB newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalRAB query()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalRAB whereBiayaSatuan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalRAB whereBiayaSatuanBpkh($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalRAB whereBiayaSatuanMitra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalRAB whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalRAB whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalRAB whereJenisPengeluaran($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalRAB whereJumlahUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalRAB whereJumlahUnitBpkh($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalRAB whereJumlahUnitMitra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalRAB whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalRAB whereSatuan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalRAB whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalRAB whereTotalBpkh($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalRAB whereTotalMitra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalRAB whereTrxProposalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalRAB whereTrxProposalRabId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalRAB whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalRAB whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class PublicTrxProposalRAB extends Model
{
    use Uuid;

    protected $table            = 'public.trx_proposal_rab';
    private static $tableName   = 'public.trx_proposal_rab';
    protected $primaryKey       = 'trx_proposal_rab_id'; 
    public $incrementing        = false;

    protected $fillable = [
        'trx_proposal_rab_id',
        'trx_proposal_id',
        'jenis_pengeluaran',
        'satuan',
        'jumlah_unit',
        'biaya_satuan',
        'total',
        'jumlah_unit_mitra',
        'biaya_satuan_mitra',
        'total_mitra',
        'jumlah_unit_bpkh',
        'biaya_satuan_bpkh',
        'total_bpkh',
        'note',
        'created_by',
        'updated_by',
    ];
}
