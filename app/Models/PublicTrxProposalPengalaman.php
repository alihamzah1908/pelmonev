<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

/**
 * App\Models\PublicTrxProposalPengalaman
 *
 * @property string $trx_proposal_pengalaman_id
 * @property string $trx_proposal_id
 * @property string|null $program_kegiatan
 * @property string|null $tujuan
 * @property string|null $lokasi
 * @property string|null $outcome
 * @property string|null $output
 * @property string|null $note
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPengalaman newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPengalaman newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPengalaman query()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPengalaman whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPengalaman whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPengalaman whereLokasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPengalaman whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPengalaman whereOutcome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPengalaman whereOutput($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPengalaman whereProgramKegiatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPengalaman whereTrxProposalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPengalaman whereTrxProposalPengalamanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPengalaman whereTujuan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPengalaman whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalPengalaman whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class PublicTrxProposalPengalaman extends Model
{
    use Uuid;

    protected $table            = 'public.trx_proposal_pengalaman';
    private static $tableName   = 'public.trx_proposal_pengalaman';
    protected $primaryKey       = 'trx_proposal_pengalaman_id'; 
    public $incrementing        = false;

    protected $fillable = [
        'trx_proposal_pengalaman_id',
        'trx_proposal_id',
        'program_kegiatan',
        'tujuan',
        'lokasi',
        'outcome',
        'output',
        'note',
        'created_by',
        'updated_by',
    ];
}
