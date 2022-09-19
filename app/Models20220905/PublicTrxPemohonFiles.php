<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

/**
 * App\Models\PublicTrxPemohonFiles
 *
 * @property string $trx_pemohon_files_id
 * @property string|null $trx_pemohon_id
 * @property string|null $file_tp
 * @property string|null $file_path
 * @property string|null $note
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohonFiles newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohonFiles newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohonFiles query()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohonFiles whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohonFiles whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohonFiles whereFilePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohonFiles whereFileTp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohonFiles whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohonFiles whereTrxPemohonFilesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohonFiles whereTrxPemohonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohonFiles whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohonFiles whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class PublicTrxPemohonFiles extends Model
{
    use Uuid;

    protected $table            = 'public.trx_pemohon_files';
    private static $tableName   = 'public.trx_pemohon_files';
    protected $primaryKey       = 'trx_pemohon_files_id'; 
    public $incrementing        = false;

    protected $fillable = [
        'trx_pemohon_files_id',
        'trx_pemohon_id',
        'file_tp',
        'file_path',
        'note',
        'created_by',
        'updated_by',
    ];
}
