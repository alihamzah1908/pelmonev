<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

/**
 * App\Models\PublicTrxProposalLayakTeknisAnalisa
 *
 * @property string $trx_proposal_layak_teknis_analisa_id
 * @property string $trx_proposal_id
 * @property string|null $tujuan
 * @property string|null $manfaat
 * @property string|null $kuota_kegiatan
 * @property string|null $hukum
 * @property string|null $kompetensi_tenaga_ahli
 * @property string|null $ekonomi
 * @property string|null $kapasitas_mitra
 * @property string|null $aspek_kewajaran_biaya
 * @property string|null $kuota_wilayah
 * @property string|null $dampak_kualitas
 * @property string|null $note
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknisAnalisa newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknisAnalisa newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknisAnalisa query()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknisAnalisa whereAspekKewajaranBiaya($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknisAnalisa whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknisAnalisa whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknisAnalisa whereDampakKualitas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknisAnalisa whereEkonomi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknisAnalisa whereHukum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknisAnalisa whereKapasitasMitra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknisAnalisa whereKompetensiTenagaAhli($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknisAnalisa whereKuotaKegiatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknisAnalisa whereKuotaWilayah($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknisAnalisa whereManfaat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknisAnalisa whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknisAnalisa whereTrxProposalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknisAnalisa whereTrxProposalLayakTeknisAnalisaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknisAnalisa whereTujuan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknisAnalisa whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknisAnalisa whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class PublicTrxProposalLayakTeknisAnalisa extends Model
{
    use Uuid;

    protected $table            = 'public.trx_proposal_layak_teknis_analisa';
    private static $tableName   = 'public.trx_proposal_layak_teknis_analisa';
    protected $primaryKey       = 'trx_proposal_layak_teknis_analisa_id'; 
    public $incrementing        = false;

    protected $fillable = [
        'trx_proposal_layak_teknis_analisa_id',
        'trx_proposal_id',
        'kompetensi_tenaga_ahli',
        'tujuan',
        'kapasitas_mitra',
        'manfaat',
        'aspek_kewajaran_biaya',
        'kuota_kegiatan',
        'kuota_wilayah',
        'hukum',
        'dampak_kualitas',
        'ekonomi',
        'note',
        'created_by',
        'updated_by'
    ];

    static function insertLayakTeknisAnalisa($proposalId)
    {
        $analisa                    = new PublicTrxProposalLayakTeknisAnalisa;
        $analisa->trx_proposal_id   = $proposalId;
        $analisa->created_by        = Auth::user()->user_id;
        $analisa->save();

        return "OK";
    }
}
