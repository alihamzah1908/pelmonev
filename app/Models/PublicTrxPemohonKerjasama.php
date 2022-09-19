<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

/**
 * App\Models\PublicTrxPemohonKerjasama
 *
 * @property string $trx_pemohon_kerjasama_id
 * @property string|null $trx_pemohon_id
 * @property string|null $lembaga_nm
 * @property string|null $kegiatan_nm
 * @property string|null $nominal_bantuan
 * @property string|null $note
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohonKerjasama newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohonKerjasama newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohonKerjasama query()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohonKerjasama whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohonKerjasama whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohonKerjasama whereKegiatanNm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohonKerjasama whereLembagaNm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohonKerjasama whereNominalBantuan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohonKerjasama whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohonKerjasama whereTrxPemohonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohonKerjasama whereTrxPemohonKerjasamaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohonKerjasama whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohonKerjasama whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class PublicTrxPemohonKerjasama extends Model
{
    use Uuid;

    protected $table            = 'public.trx_pemohon_kerjasama';
    private static $tableName   = 'public.trx_pemohon_kerjasama';
    protected $primaryKey       = 'trx_pemohon_kerjasama_id'; 
    public $incrementing        = false;

    protected $fillable = [
        'trx_pemohon_kerjasama_id',
        'trx_pemohon_id',
        'lembaga_nm',
        'kegiatan_nm',
        'nominal_bantuan',
        'note',
        'created_by',
        'updated_by',
    ];
}
