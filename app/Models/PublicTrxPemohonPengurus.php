<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

/**
 * App\Models\PublicTrxPemohonPengurus
 *
 * @property string $trx_pemohon_pengurus_id
 * @property string|null $trx_pemohon_id
 * @property string|null $pengurus_nm
 * @property string|null $jabatan_nm
 * @property string|null $pekerjaan_nm
 * @property string|null $note
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohonPengurus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohonPengurus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohonPengurus query()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohonPengurus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohonPengurus whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohonPengurus whereJabatanNm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohonPengurus whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohonPengurus wherePekerjaanNm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohonPengurus wherePengurusNm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohonPengurus whereTrxPemohonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohonPengurus whereTrxPemohonPengurusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohonPengurus whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohonPengurus whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class PublicTrxPemohonPengurus extends Model
{
    use Uuid;

    protected $table            = 'public.trx_pemohon_pengurus';
    private static $tableName   = 'public.trx_pemohon_pengurus';
    protected $primaryKey       = 'trx_pemohon_pengurus_id'; 
    public $incrementing        = false;

    protected $fillable = [
        'trx_pemohon_pengurus_id',
        'trx_pemohon_id',
        'pengurus_nm',
        'jabatan_nm',
        'pekerjaan_nm',
        'note',
        'created_by',
        'updated_by',
    ];
}
