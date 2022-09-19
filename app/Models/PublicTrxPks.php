<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class PublicTrxPks extends Model
{
    use Uuid;

    protected $table            = 'public.trx_pelmonev_pks';
    private static $tableName   = 'public.trx_pelmonev_pks';
    protected $primaryKey       = 'trx_pks_id';
    public $incrementing        = false;

    protected $fillable = [
        'trx_pks_id',
        'trx_proposal_id',
        'judul_program',
        'tanggal_kegiatan',
        'tanggal',
        'no_pks_bpkh',
        'no_pks_mitra',
        'alamat_bpkh',
        'kepala_bpk',
        'sk_pengangkatan_kep_bpkh',
        'alamat_mitra',
        'sk_pendirian_mitra',
        'jabatan',
        'dana_kegiatan',
        'nomor_sk_bpkh',
        'termin',
        'start_date_timeline',
        'end_date_timeline',
        'signature',
        'created_by',
        'updated_by',
    ];
}
