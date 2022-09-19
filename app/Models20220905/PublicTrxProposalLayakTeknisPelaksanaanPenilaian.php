<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

/**
 * App\Models\PublicTrxProposalLayakTeknisPelaksanaanPenilaian
 *
 * @property string $trx_proposal_layak_teknis_pelaksanaan_penilaian_id
 * @property string $trx_proposal_id
 * @property string|null $penilaian_datetime
 * @property string|null $lokasi
 * @property string|null $petugas
 * @property string|null $pihak
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknisPelaksanaanPenilaian newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknisPelaksanaanPenilaian newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknisPelaksanaanPenilaian query()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknisPelaksanaanPenilaian whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknisPelaksanaanPenilaian whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknisPelaksanaanPenilaian whereLokasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknisPelaksanaanPenilaian wherePenilaianDatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknisPelaksanaanPenilaian wherePetugas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknisPelaksanaanPenilaian wherePihak($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknisPelaksanaanPenilaian whereTrxProposalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknisPelaksanaanPenilaian whereTrxProposalLayakTeknisPelaksanaanPenilaianId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknisPelaksanaanPenilaian whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknisPelaksanaanPenilaian whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class PublicTrxProposalLayakTeknisPelaksanaanPenilaian extends Model
{
    use Uuid;

    protected $table            = 'public.trx_proposal_layak_teknis_pelaksanaan_penilaian';
    private static $tableName   = 'public.trx_proposal_layak_teknis_pelaksanaan_penilaian';
    protected $primaryKey       = 'trx_proposal_layak_teknis_pelaksanaan_penilaian_id'; 
    public $incrementing        = false;

    protected $fillable = [
        'trx_proposal_layak_teknis_pelaksanaan_penilaian_id',
        'trx_proposal_id',
        'penilaian_datetime',
        'lokasi',
        'petugas',
        'pihak',
        'note',
        'created_by',
        'updated_by'
    ];

    static function insertLayakTeknisPelaksanaanPenilaian($proposalId)
    {
        $data                    = new PublicTrxProposalLayakTeknisPelaksanaanPenilaian;
        $data->trx_proposal_id   = $proposalId;
        $data->created_by        = Auth::user()->user_id;
        $data->save();

        return "OK";
    }
}
