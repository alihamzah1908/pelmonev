<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

/**
 * App\Models\PublicTrxProposalTimeline
 *
 * @property string $trx_proposal_timeline_id
 * @property string $trx_proposal_id
 * @property string $timeline_by
 * @property string $status
 * @property string|null $file_asesmen
 * @property string|null $note
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalTimeline newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalTimeline newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalTimeline query()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalTimeline whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalTimeline whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalTimeline whereFileAsesmen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalTimeline whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalTimeline whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalTimeline whereTimelineBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalTimeline whereTrxProposalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalTimeline whereTrxProposalTimelineId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalTimeline whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalTimeline whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class PublicTrxProposalTimeline extends Model
{
    use Uuid;

    protected $table            = 'public.trx_proposal_timeline';
    private static $tableName   = 'public.trx_proposal_timeline';
    protected $primaryKey       = 'trx_proposal_timeline_id'; 
    public $incrementing        = false;

    protected $fillable = [
        'trx_proposal_timeline_id',
        'trx_proposal_id',
        'timeline_by',
        'status',
        'dokumen_assesmen',
        'note',
        'created_by',
        'updated_by'
    ];

    static function insertTimeline($proposalId, $timelineBy, $status, $note = NULL, $dokumenAsesmen = NULL)
    {
        $timeline                   = new PublicTrxProposalTimeline;
        $timeline->trx_proposal_id  = $proposalId;
        $timeline->timeline_by      = $timelineBy;
        $timeline->status           = $status;
        $timeline->file_asesmen     = $dokumenAsesmen;
        $timeline->note             = $note;
        $timeline->created_by       = Auth::user()->user_id;
        $timeline->save();

        return $timeline;
    }

    static function getLastStatus($id)
    {
        $proposal = PublicTrxProposal::find($id);
        $data     = PublicTrxProposalTimeline::where('trx_proposal_id', $id)->where('status',$proposal->proses_st)->first();
        
        return $data;
    }
}
