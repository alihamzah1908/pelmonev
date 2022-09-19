<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

/**
 * App\Models\PublicTrxProposalLaporanMonitoring
 *
 * @property string $trx_proposal_laporan_monitoring_id
 * @property string $trx_proposal_id
 * @property string|null $jenis_kegiatan
 * @property string|null $nama_kegiatan
 * @property string|null $metode_pelaksanaan
 * @property string|null $tanggal_monitoring
 * @property string|null $periode_monitoring
 * @property string|null $note
 * @property string|null $bukti_foto_monitoring
 * @property string|null $kesimpulan_monitoring
 * @property string $status
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLaporanMonitoring newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLaporanMonitoring newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLaporanMonitoring query()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLaporanMonitoring whereBuktiFotoMonitoring($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLaporanMonitoring whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLaporanMonitoring whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLaporanMonitoring whereJenisKegiatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLaporanMonitoring whereKesimpulanMonitoring($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLaporanMonitoring whereMetodePelaksanaan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLaporanMonitoring whereNamaKegiatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLaporanMonitoring whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLaporanMonitoring wherePeriodeMonitoring($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLaporanMonitoring whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLaporanMonitoring whereTanggalMonitoring($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLaporanMonitoring whereTrxProposalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLaporanMonitoring whereTrxProposalLaporanMonitoringId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLaporanMonitoring whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposalLaporanMonitoring whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class PublicTrxProposalLaporanMonitoring extends Model
{
    use Uuid;

    protected $table            = 'public.trx_proposal_laporan_monitoring';
    private static $tableName   = 'public.trx_proposal_laporan_monitoring';
    protected $primaryKey       = 'trx_proposal_laporan_monitoring_id'; 
    public $incrementing        = false;
    
    protected $fillable = [
        'trx_proposal_laporan_monitoring_id',
        'trx_proposal_id',
        'jenis_kegiatan',
        'nama_kegiatan',
        'metode_pelaksanaan',
        'tanggal_monitoring',
        'periode_monitoring',
        'bukti_foto_monitoring',
        'kesimpulan_monitoring',
        'status',
        'note',
        'created_by',
        'updated_by',
    ];
}
