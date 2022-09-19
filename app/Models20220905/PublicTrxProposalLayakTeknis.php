<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

/**
 * App\Models\PublicTrxProposalLayakTeknis
 *
 * @property string $trx_proposal_layak_teknis_id
 * @property string $trx_proposal_id
 * @property string|null $layak_teknis_id
 * @property string|null $layak_teknis_value
 * @property string|null $note
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknis newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknis newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknis query()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknis whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknis whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknis whereLayakTeknisId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknis whereLayakTeknisValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknis whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknis whereTrxProposalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknis whereTrxProposalLayakTeknisId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknis whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLayakTeknis whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class PublicTrxProposalLayakTeknis extends Model
{
    use Uuid;

    protected $table            = 'public.trx_proposal_layak_teknis';
    private static $tableName   = 'public.trx_proposal_layak_teknis';
    protected $primaryKey       = 'trx_proposal_layak_teknis_id'; 
    public $incrementing        = false;

    protected $fillable = [
        'trx_proposal_layak_teknis_id',
        'trx_proposal_id',
        'layak_teknis_id',
        'layak_teknis_value',
        'note',
        'created_by',
        'updated_by'
    ];

    static function insertLayakTeknis($proposalId)
    {
        $penilaian = ComCode::whereIn('code_group', [
            'LT_01',
            'LT_02',
            'LT_03',
            'LT_04'
            ])->get();

        foreach ($penilaian as $item) {
            $layakTeknis                   = new PublicTrxProposalLayakTeknis;
            $layakTeknis->trx_proposal_id  = $proposalId;
            $layakTeknis->layak_teknis_id  = $item->com_cd;
            $layakTeknis->created_by       = Auth::user()->user_id;
            $layakTeknis->save();
        }

        return "OK";
    }
}
