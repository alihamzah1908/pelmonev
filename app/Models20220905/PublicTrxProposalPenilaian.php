<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

/**
 * App\Models\PublicTrxProposalPenilaian
 *
 * @property string $trx_proposal_penilaian_id
 * @property string $trx_proposal_id
 * @property string|null $penilaian_id
 * @property string|null $penilaian_value
 * @property string|null $note
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPenilaian newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPenilaian newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPenilaian query()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPenilaian whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPenilaian whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPenilaian whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPenilaian wherePenilaianId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPenilaian wherePenilaianValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPenilaian whereTrxProposalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPenilaian whereTrxProposalPenilaianId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPenilaian whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPenilaian whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class PublicTrxProposalPenilaian extends Model
{
    use Uuid;

    protected $table            = 'public.trx_proposal_penilaian';
    private static $tableName   = 'public.trx_proposal_penilaian';
    protected $primaryKey       = 'trx_proposal_penilaian_id'; 
    public $incrementing        = false;
    
    protected $fillable = [
        'trx_proposal_penilaian_id',
        'trx_proposal_id',
        'penilaian_id',
        'penilaian_value',
        'note',
        'created_by',
        'updated_by'
    ];

    static function insertPenilaian($proposalId)
    {
        $penilaian = ComCode::whereIn('code_group', ['PENPROP_IU','PENPROP_AL'])->get();
        // ,'PENPROP_IU','PENPROP_AL'
        foreach ($penilaian as $item) {
            $penilaian                   = new PublicTrxProposalPenilaian;
            $penilaian->trx_proposal_id  = $proposalId;
            $penilaian->penilaian_id     = $item->com_cd;
            $penilaian->created_by       = Auth::user()->user_id;
            $penilaian->save();
        }

        return "OK";
    }
}
