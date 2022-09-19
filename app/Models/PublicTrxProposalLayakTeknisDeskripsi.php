<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

/**
 * App\Models\PublicTrxProposalLayakTeknisDeskripsi
 *
 * @property string $trx_proposal_layak_teknis_deskripsi_id
 * @property string $trx_proposal_id
 * @property string|null $nama_program
 * @property string|null $sistem_penyaluran
 * @property string|null $sub_program
 * @property string|null $tujuan_program
 * @property string|null $anggaran_sumberdana
 * @property string|null $rencana_lokasi
 * @property string|null $penerima_maslahat
 * @property string|null $note
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknisDeskripsi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknisDeskripsi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknisDeskripsi query()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknisDeskripsi whereAnggaranSumberdana($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknisDeskripsi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknisDeskripsi whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknisDeskripsi whereNamaProgram($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknisDeskripsi whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknisDeskripsi wherePenerimaMaslahat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknisDeskripsi whereRencanaLokasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknisDeskripsi whereSistemPenyaluran($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknisDeskripsi whereSubProgram($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknisDeskripsi whereTrxProposalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknisDeskripsi whereTrxProposalLayakTeknisDeskripsiId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknisDeskripsi whereTujuanProgram($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknisDeskripsi whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknisDeskripsi whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class PublicTrxProposalLayakTeknisDeskripsi extends Model
{
    use Uuid;

    protected $table            = 'public.trx_proposal_layak_teknis_deskripsi';
    private static $tableName   = 'public.trx_proposal_layak_teknis_deskripsi';
    protected $primaryKey       = 'trx_proposal_layak_teknis_deskripsi_id'; 
    public $incrementing        = false;

    protected $fillable = [
        'trx_proposal_layak_teknis_deskripsi_id',
        'trx_proposal_id',
        'nama_program',
        'sistem_penyaluran',
        'sub_program',
        'tujuan_program',
        'anggaran_sumberdana',
        'rencana_lokasi',
        'penerima_maslahat',
        'note',
        'created_by',
        'updated_by'
    ];

    static function insertLayakTeknisDeskripsi($proposalId)
    {
        $deskripsi                    = new PublicTrxProposalLayakTeknisDeskripsi;
        $deskripsi->trx_proposal_id   = $proposalId;
        $deskripsi->created_by        = Auth::user()->user_id;
        $deskripsi->save();

        return "OK";
    }
}
