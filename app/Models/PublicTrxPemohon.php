<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

/**
 * App\Models\PublicTrxPemohon
 *
 * @property string $trx_pemohon_id
 * @property string $pemohon_nm
 * @property string|null $region_prop
 * @property string|null $region_kab
 * @property string|null $region_kec
 * @property string|null $region_kel
 * @property string|null $address
 * @property string|null $email
 * @property string|null $pemohon_latitude
 * @property string|null $pemohon_longitude
 * @property string|null $akta_pendirian
 * @property string|null $akta_perubahan_terakhir
 * @property string|null $sk_pengesahan_pendirian_no
 * @property string|null $sk_pengesahan_perubahan_terakhir_no
 * @property string|null $ktp_no_pimpinan
 * @property string|null $npwp_no_lembaga
 * @property string|null $kriteria_mitra
 * @property string|null $profil_singkat
 * @property string|null $struktur_organisasi_file
 * @property string|null $phone
 * @property string|null $website
 * @property string|null $socmed
 * @property string|null $penanggung_jawab_nm
 * @property string|null $penanggung_jawab_email
 * @property string|null $penanggung_jawab_phone
 * @property string|null $bank_cd
 * @property string|null $bank_branch
 * @property string|null $bank_holder
 * @property string|null $bank_account_no
 * @property string|null $bank_account_file
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohon newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohon newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohon query()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohon whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohon whereAktaPendirian($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohon whereAktaPerubahanTerakhir($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohon whereBankAccountFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohon whereBankAccountNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohon whereBankBranch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohon whereBankCd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohon whereBankHolder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohon whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohon whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohon whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohon whereKriteriaMitra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohon whereKtpNoPimpinan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohon whereNpwpNoLembaga($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohon wherePemohonLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohon wherePemohonLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohon wherePemohonNm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohon wherePenanggungJawabEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohon wherePenanggungJawabNm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohon wherePenanggungJawabPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohon wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohon whereProfilSingkat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohon whereRegionKab($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohon whereRegionKec($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohon whereRegionKel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohon whereRegionProp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohon whereSkPengesahanPendirianNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohon whereSkPengesahanPerubahanTerakhirNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohon whereSocmed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohon whereStrukturOrganisasiFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohon whereTrxPemohonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohon whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohon whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicTrxPemohon whereWebsite($value)
 * @mixin \Eloquent
 */
class PublicTrxPemohon extends Model
{
    use Uuid;

    protected $table            = 'public.trx_pemohon';
    private static $tableName   = 'public.trx_pemohon';
    protected $primaryKey       = 'trx_pemohon_id'; 
    public $incrementing        = false;

    protected $fillable = [
        'trx_pemohon_id',
        'pemohon_nm',
        'region_prop',
        'region_kab',
        'region_kec',
        'region_kel',
        'address',
        'email',
        'akta_pendirian',
        'akta_perubahan_terakhir',
        'sk_pengesahan_pendirian_no',
        'sk_pengesahan_perubahan_terakhir_no',
        'pemohon_latitude',
        'pemohon_longitude',
        'ktp_no_pimpinan',
        'npwp_no_lembaga',
        'kriteria_mitra',
        'profil_singkat',
        'struktur_organisasi_file',
        'phone',
        'website',
        'socmed',
        'penanggung_jawab_nm',
        'penanggung_jawab_email',
        'penanggung_jawab_phone',
        'bank_cd',
        'bank_branch',
        'bank_holder',
        'bank_account_no',
        'bank_account_file',
        'created_by',
        'updated_by',
    ];
}
