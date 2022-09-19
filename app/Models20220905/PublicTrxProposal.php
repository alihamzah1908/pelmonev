<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

/**
 * App\Models\PublicTrxProposal
 *
 * @property string $trx_proposal_id
 * @property string|null $trx_pemohon_id
 * @property string|null $proposal_no
 * @property string|null $judul_proposal
 * @property string|null $nominal
 * @property string|null $ruang_lingkup
 * @property string|null $uraian_singkat_proposal
 * @property string|null $deskripsi_singkat_proposal
 * @property string $proposal_fill_st
 * @property string|null $nominal_rekomendasi
 * @property string|null $trx_mitra_kemaslahatan_id
 * @property string|null $mitra_asessmen_date_start
 * @property string|null $mitra_asessmen_date_end
 * @property string|null $region_prop
 * @property string|null $region_kab
 * @property string|null $region_kec
 * @property string|null $region_kel
 * @property string|null $address
 * @property string|null $proposal_latitude
 * @property string|null $proposal_longitude
 * @property string|null $akta_pendirian
 * @property string|null $akta_perubahan_terakhir
 * @property string|null $sk_pengesahan_pendirian_no
 * @property string|null $sk_pengesahan_perubahan_terakhir_no
 * @property string|null $ktp_no_pimpinan
 * @property string|null $npwp_no_lembaga
 * @property string|null $kriteria_mitra
 * @property string $lembaga_fill_st
 * @property string|null $profil_singkat
 * @property string $profil_fill_st
 * @property string|null $phone
 * @property string|null $website
 * @property string|null $socmed
 * @property string $informasi_fill_st
 * @property string|null $penanggung_jawab_nm
 * @property string|null $penanggung_jawab_email
 * @property string|null $penanggung_jawab_phone
 * @property string|null $bank_cd
 * @property string|null $bank_branch
 * @property string|null $bank_holder
 * @property string|null $bank_account_no
 * @property string|null $bank_account_file
 * @property string $kontak_fill_st
 * @property string|null $note
 * @property string|null $deskripsi_nama_kegiatan
 * @property string|null $deskripsi_spesifikasi_kegiatan
 * @property string|null $deskripsi_latar_belakang_usulan
 * @property string|null $deskripsi_tujuan_acara
 * @property string|null $deskripsi_nominal
 * @property string|null $deskripsi_prioritas_penggunaan_dana
 * @property string $deskripsi_fill_st
 * @property string|null $lokasi_nama_gedung
 * @property string|null $lokasi_region_prop
 * @property string|null $lokasi_region_kab
 * @property string|null $lokasi_region_kec
 * @property string|null $lokasi_komunitas
 * @property string $lokasi_fill_st
 * @property string|null $manfaat_bpkh
 * @property string|null $manfaat_haji
 * @property string|null $manfaat_kemaslahatan
 * @property string|null $manfaat_lain_lain
 * @property string $manfaat_fill_st
 * @property string $sent_st
 * @property string $file_fill_st
 * @property string $pengurus
 * @property string $kerjasama
 * @property string $persiapan
 * @property string $donasi
 * @property string $rab
 * @property string $kerjasama2
 * @property string $pj
 * @property string $outcome
 * @property string $pengalaman
 * @property string|null $proses_st
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal query()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereAktaPendirian($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereAktaPerubahanTerakhir($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereBankAccountFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereBankAccountNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereBankBranch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereBankCd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereBankHolder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereDeskripsiFillSt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereDeskripsiLatarBelakangUsulan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereDeskripsiNamaKegiatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereDeskripsiNominal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereDeskripsiPrioritasPenggunaanDana($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereDeskripsiSingkatProposal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereDeskripsiSpesifikasiKegiatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereDeskripsiTujuanAcara($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereDonasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereFileFillSt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereInformasiFillSt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereJudulProposal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereKerjasama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereKerjasama2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereKontakFillSt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereKriteriaMitra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereKtpNoPimpinan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereLembagaFillSt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereLokasiFillSt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereLokasiKomunitas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereLokasiNamaGedung($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereLokasiRegionKab($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereLokasiRegionKec($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereLokasiRegionProp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereManfaatBpkh($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereManfaatFillSt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereManfaatHaji($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereManfaatKemaslahatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereManfaatLainLain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereMitraAsessmenDateEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereMitraAsessmenDateStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereNominal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereNominalRekomendasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereNpwpNoLembaga($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereOutcome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal wherePenanggungJawabEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal wherePenanggungJawabNm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal wherePenanggungJawabPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal wherePengalaman($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal wherePengurus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal wherePersiapan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal wherePj($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereProfilFillSt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereProfilSingkat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereProposalFillSt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereProposalLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereProposalLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereProposalNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereProsesSt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereRab($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereRegionKab($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereRegionKec($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereRegionKel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereRegionProp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereRuangLingkup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereSentSt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereSkPengesahanPendirianNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereSkPengesahanPerubahanTerakhirNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereSocmed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereTrxMitraKemaslahatanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereTrxPemohonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereTrxProposalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereUraianSingkatProposal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxProposal whereWebsite($value)
 * @mixin \Eloquent
 */
class PublicTrxProposal extends Model
{
    use Uuid;

    protected $table            = 'public.trx_proposal';
    private static $tableName   = 'public.trx_proposal';
    protected $primaryKey       = 'trx_proposal_id'; 
    public $incrementing        = false;

    protected $fillable = [
        'trx_proposal_id',
        'trx_pemohon_id',
        'proposal_no',
        'judul_proposal',
        'nominal',
        'nominal_realisasi',
        'nominal_efisiensi',
        'ruang_lingkup',
        'uraian_singkat_proposal',
        'deskripsi_singkat_proposal',
        'nominal_rekomendasi',
        'trx_mitra_kemaslahatan_id',
        'trx_mitra_strategis_id',
        'mitra_asessmen_date_start',
        'mitra_asessmen_date_end',
        'proposal_fill_st',
        'region_prop',
        'region_kab',
        'region_kec',
        'region_kel',
        'address',
        'proposal_latitude',
        'proposal_longitude',
        'akta_pendirian',
        'akta_perubahan_terakhir',
        'sk_pengesahan_pendirian_no',
        'sk_pengesahan_perubahan_terakhir_no',
        'ktp_no_pimpinan',
        'npwp_no_lembaga',
        'kriteria_mitra',
        'lembaga_fill_st',
        'profil_singkat',
        'struktur_organisasi_file',
        'phone',
        'website',
        'socmed',
        'penanggung_jawab_nm',
        'penanggung_jawab_email',
        'penanggung_jawab_phone',
        'penanggung_jawab_address',
        'penanggung_jawab_jabatan',
        'bank_cd',
        'bank_branch',
        'bank_holder',
        'bank_account_no',
        'bank_account_file',
        'note',
        'deskripsi_nama_kegiatan',
        'deskripsi_spesifikasi_kegiatan',
        'deskripsi_latar_belakang_usulan',
        'deskripsi_tujuan_acara',
        'deskripsi_nominal',
        'deskripsi_prioritas_penggunaan_dana',
        'deskripsi_fill_st',
        'lokasi_nama_gedung',
        'lokasi_region_prop',
        'lokasi_region_kab',
        'lokasi_region_kec',
        'lokasi_komunitas',
        'lokasi_fill_st',
        'file_fill_st',
        'manfaat_bpkh',
        'manfaat_haji',
        'manfaat_kemaslahatan',
        'manfaat_lain_lain',
        'manfaat_fill_st',
        'sent_st',
        'rab_tp',
        'kuota_st',
        'kuota_wilayah',
        'kuota_ruang_lingkup',
        'kuota_mitra',
        'proses_st',
        'created_by',
        'updated_by',
    ];
}
