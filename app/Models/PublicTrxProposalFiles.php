<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

/**
 * App\Models\PublicTrxProposalFiles
 *
 * @property string $trx_proposal_files_id
 * @property string|null $trx_proposal_id
 * @property string|null $file_tp
 * @property string|null $file_ext
 * @property string|null $file_path
 * @property string|null $note
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalFiles newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalFiles newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalFiles query()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalFiles whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalFiles whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalFiles whereFileExt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalFiles whereFilePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalFiles whereFileTp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalFiles whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalFiles whereTrxProposalFilesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalFiles whereTrxProposalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalFiles whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalFiles whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class PublicTrxProposalFiles extends Model
{
    use Uuid;

    protected $table            = 'public.trx_proposal_files';
    private static $tableName   = 'public.trx_proposal_files';
    protected $primaryKey       = 'trx_proposal_files_id'; 
    public $incrementing        = false;

    protected $fillable = [
        'trx_proposal_files_id',
        'trx_proposal_id',
        'file_tp',
        'file_ext',
        'file_path',
        'note',
        'created_by',
        'updated_by',
    ];
}
