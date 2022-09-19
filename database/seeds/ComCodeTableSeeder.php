<?php

use Illuminate\Database\Seeder;
use App\Models\ComCode;

class ComCodeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        ComCode::truncate();

        ComCode::insert([
            /*--DAY_TP--*/
            ["com_cd" => "DAY_TP_01","code_nm"=>"Senin",    "code_group" => "DAY_TP","code_value" => "Monday","created_by"=>"admin","created_at" => date("Y-m-d H:i:s")],
            ["com_cd" => "DAY_TP_02","code_nm"=>"Selasa",   "code_group" => "DAY_TP","code_value" => "Tuesday","created_by"=>"admin","created_at" => date("Y-m-d H:i:s")],
            ["com_cd" => "DAY_TP_03","code_nm"=>"Rabu",     "code_group" => "DAY_TP","code_value" => "Wednesday","created_by"=>"admin","created_at" => date("Y-m-d H:i:s")],
            ["com_cd" => "DAY_TP_04","code_nm"=>"Kamis",    "code_group" => "DAY_TP","code_value" => "Thursday","created_by"=>"admin","created_at" => date("Y-m-d H:i:s")],
            ["com_cd" => "DAY_TP_05","code_nm"=>"Jumat",    "code_group" => "DAY_TP","code_value" => "Friday","created_by"=>"admin","created_at" => date("Y-m-d H:i:s")],
            ["com_cd" => "DAY_TP_06","code_nm"=>"Sabtu",    "code_group" => "DAY_TP","code_value" => "Saturday","created_by"=>"admin","created_at" => date("Y-m-d H:i:s")],
            ["com_cd" => "DAY_TP_07","code_nm"=>"Minggu",   "code_group" => "DAY_TP","code_value" => "Sunday","created_by"=>"admin","created_at" => date("Y-m-d H:i:s")],

			/*--IDENTITY_TP--*/
            [ "com_cd" => "ID_TP_1", "code_nm" => "KTP", "code_group" => "IDENTITY_TP","code_value" => "", "created_by" => "admin", "created_at" => date("Y-m-d H:i:s")],
            [ "com_cd" => "ID_TP_2", "code_nm" => "KK", "code_group" => "IDENTITY_TP","code_value" => "", "created_by" => "admin", "created_at" => date("Y-m-d H:i:s")],
            [ "com_cd" => "ID_TP_3", "code_nm" => "SIM", "code_group" => "IDENTITY_TP","code_value" => "", "created_by" => "admin", "created_at" => date("Y-m-d H:i:s")],
            [ "com_cd" => "ID_TP_4", "code_nm" => "Paspor", "code_group" => "IDENTITY_TP","code_value" => "", "created_by" => "admin", "created_at" => date("Y-m-d H:i:s")],
            [ "com_cd" => "ID_TP_5", "code_nm" => "KITAS", "code_group" => "IDENTITY_TP","code_value" => "", "created_by" => "admin", "created_at" => date("Y-m-d H:i:s")],

            /*--GENDER_TP--*/
            ["com_cd" => "GENDER_TP_01","code_nm"=>"Laki-Laki", "code_group" => "GENDER_TP","code_value" => NULL,"created_by"=>"admin","created_at" => date("Y-m-d H:i:s")],
            ["com_cd" => "GENDER_TP_02","code_nm"=>"Perempuan", "code_group" => "GENDER_TP","code_value" => NULL,"created_by"=>"admin","created_at" => date("Y-m-d H:i:s")],

            /*--RUANG_LINGKUP--*/
            ["com_cd" => "RUANG_LINGKUP_01","code_nm"=>"Pelayanan Ibadah Haji", "code_group" => "RUANG_LINGKUP","code_value" => 'PIH',"created_by"=>"admin","created_at" => date("Y-m-d H:i:s")],
            ["com_cd" => "RUANG_LINGKUP_02","code_nm"=>"Pendidikan dan Dakwah", "code_group" => "RUANG_LINGKUP","code_value" => 'PDD',"created_by"=>"admin","created_at" => date("Y-m-d H:i:s")],
            ["com_cd" => "RUANG_LINGKUP_03","code_nm"=>"Kesehatan", "code_group" => "RUANG_LINGKUP","code_value" => 'KES',"created_by"=>"admin","created_at" => date("Y-m-d H:i:s")],
            ["com_cd" => "RUANG_LINGKUP_04","code_nm"=>"Sosial Keagamaan", "code_group" => "RUANG_LINGKUP","code_value" => 'SKA',"created_by"=>"admin","created_at" => date("Y-m-d H:i:s")],
            ["com_cd" => "RUANG_LINGKUP_05","code_nm"=>"Ekonomi Umat", "code_group" => "RUANG_LINGKUP","code_value" => 'EKU',"created_by"=>"admin","created_at" => date("Y-m-d H:i:s")],
            ["com_cd" => "RUANG_LINGKUP_06","code_nm"=>"Pembangunan Sarana dan Prasarana Ibadah", "code_group" => "RUANG_LINGKUP","code_value" => 'SPI',"created_by"=>"admin","created_at" => date("Y-m-d H:i:s")],
            ["com_cd" => "RUANG_LINGKUP_07","code_nm"=>"Tanggap Darurat", "code_group" => "RUANG_LINGKUP","code_value" => 'TD',"created_by"=>"admin","created_at" => date("Y-m-d H:i:s")],

            /*--SPESIFIKASI_KEGIATAN--*/
            ["com_cd" => "SPESIFIKASI_KEGIATAN_01","code_nm"=>"SPESIFIKASI_KEGIATAN_01", "code_group" => "SPESIFIKASI_KEGIATAN","code_value" => 'PIH',"created_by"=>"admin","created_at" => date("Y-m-d H:i:s")],

            /*--FILE_TP--*/
            // ["com_cd" => "FILE_TP_01","code_nm"=>"Surat Pengantar Proposal", "code_group" => "FILE_TP","code_value" => '1',"created_by"=>"admin","created_at" => date("Y-m-d H:i:s")],
            // ["com_cd" => "FILE_TP_02","code_nm"=>"Scan Surat Pakta Integritas", "code_group" => "FILE_TP","code_value" => '1',"created_by"=>"admin","created_at" => date("Y-m-d H:i:s")],
            // ["com_cd" => "FILE_TP_03","code_nm"=>"Scan Surat Pernyataan Kebenaran Dokumen", "code_group" => "FILE_TP","code_value" => '1',"created_by"=>"admin","created_at" => date("Y-m-d H:i:s")],
            // ["com_cd" => "FILE_TP_04","code_nm"=>"Scan Surat Pernyataan Pertanggungjawaban Mutlak", "code_group" => "FILE_TP","code_value" => '1',"created_by"=>"admin","created_at" => date("Y-m-d H:i:s")],
            // ["com_cd" => "FILE_TP_05","code_nm"=>"File Proposal", "code_group" => "FILE_TPS","code_value" => '1',"created_by"=>"admin","created_at" => date("Y-m-d H:i:s")],
            
            // ["com_cd" => "FILE_TP_06","code_nm"=>"Surat Keterangan Domisili", "code_group" => "FILE_TP","code_value" => NULL,"created_by"=>"admin","created_at" => date("Y-m-d H:i:s")],
            // ["com_cd" => "FILE_TP_07","code_nm"=>"Formulir PM Kegiatan", "code_group" => "FILE_TPS","code_value" => NULL,"created_by"=>"admin","created_at" => date("Y-m-d H:i:s")],
            // ["com_cd" => "FILE_TP_08","code_nm"=>"Formulir Ekonomi Umat", "code_group" => "FILE_TPS","code_value" => NULL,"created_by"=>"admin","created_at" => date("Y-m-d H:i:s")],
            // ["com_cd" => "FILE_TP_09","code_nm"=>"Scan Akta Pendirian", "code_group" => "FILE_TP","code_value" => NULL,"created_by"=>"admin","created_at" => date("Y-m-d H:i:s")],
            // ["com_cd" => "FILE_TP_10","code_nm"=>"Scan Akta Perubahan", "code_group" => "FILE_TP","code_value" => NULL,"created_by"=>"admin","created_at" => date("Y-m-d H:i:s")],
            // ["com_cd" => "FILE_TP_11","code_nm"=>"Scan SK Pengesahan Pendirian", "code_group" => "FILE_TP","code_value" => NULL,"created_by"=>"admin","created_at" => date("Y-m-d H:i:s")],
            // ["com_cd" => "FILE_TP_12","code_nm"=>"Scan SK Pengesahan Perubahan", "code_group" => "FILE_TP","code_value" => NULL,"created_by"=>"admin","created_at" => date("Y-m-d H:i:s")],
            // ["com_cd" => "FILE_TP_13","code_nm"=>"Scan KTP Pimpinan", "code_group" => "FILE_TP","code_value" => NULL,"created_by"=>"admin","created_at" => date("Y-m-d H:i:s")],
            // ["com_cd" => "FILE_TP_14","code_nm"=>"Scan NPWP Lembaga", "code_group" => "FILE_TP","code_value" => NULL,"created_by"=>"admin","created_at" => date("Y-m-d H:i:s")],
            // ["com_cd" => "FILE_TP_15","code_nm"=>"Laporan Keuangan/Informasi Keuangan 2 thn terakhir", "code_group" => "FILE_TP","code_value" => NULL,"created_by"=>"admin","created_at" => date("Y-m-d H:i:s")],
            // ["com_cd" => "FILE_TP_16","code_nm"=>"Scan Surat Izin Operasional", "code_group" => "FILE_TP","code_value" => NULL,"created_by"=>"admin","created_at" => date("Y-m-d H:i:s")],
            // ["com_cd" => "FILE_TP_17","code_nm"=>"Struktur Organisasi", "code_group" => "FILE_TP","code_value" => NULL,"created_by"=>"admin","created_at" => date("Y-m-d H:i:s")],
            // ["com_cd" => "FILE_TP_18","code_nm"=>"Scan Rekening Bank", "code_group" => "FILE_TPS","code_value" => NULL,"created_by"=>"admin","created_at" => date("Y-m-d H:i:s")],
            // ["com_cd" => "FILE_TP_19","code_nm"=>"Jadwal pelaksanaan Kegiatan", "code_group" => "FILE_TP","code_value" => NULL,"created_by"=>"admin","created_at" => date("Y-m-d H:i:s")],
            

            /*--PROSES_ST--*/
            ["com_cd" => "PROSES_ST_10","code_nm"=>"Verifikasi dan Unggah Dokumen", "code_group" => "PROSES_ST","code_value" => NULL,"created_by"=>"admin","created_at" => date("Y-m-d H:i:s")],
            ["com_cd" => "PROSES_ST_11","code_nm"=>"Gagal Verifikasi dan Unggah Dokumen", "code_group" => "PROSES_ST","code_value" => NULL,"created_by"=>"admin","created_at" => date("Y-m-d H:i:s")],
            ["com_cd" => "PROSES_ST_20","code_nm"=>"Screening Awal Proposal", "code_group" => "PROSES_ST","code_value" => NULL,"created_by"=>"admin","created_at" => date("Y-m-d H:i:s")],
            ["com_cd" => "PROSES_ST_21","code_nm"=>"Gagal Screening Awal Proposal", "code_group" => "PROSES_ST","code_value" => NULL,"created_by"=>"admin","created_at" => date("Y-m-d H:i:s")],
            ["com_cd" => "PROSES_ST_30","code_nm"=>"Penugasan Mitra Kemaslahatan", "code_group" => "PROSES_ST","code_value" => NULL,"created_by"=>"admin","created_at" => date("Y-m-d H:i:s")],
            ["com_cd" => "PROSES_ST_40","code_nm"=>"Screening Ke 2", "code_group" => "PROSES_ST","code_value" => NULL,"created_by"=>"admin","created_at" => date("Y-m-d H:i:s")],
            ["com_cd" => "PROSES_ST_41","code_nm"=>"Gagal Screening Ke 2", "code_group" => "PROSES_ST","code_value" => NULL,"created_by"=>"admin","created_at" => date("Y-m-d H:i:s")],
            ["com_cd" => "PROSES_ST_50","code_nm"=>"Kajian Proposal", "code_group" => "PROSES_ST","code_value" => NULL,"created_by"=>"admin","created_at" => date("Y-m-d H:i:s")],
            ["com_cd" => "PROSES_ST_60","code_nm"=>"Persetujuan", "code_group" => "PROSES_ST","code_value" => NULL,"created_by"=>"admin","created_at" => date("Y-m-d H:i:s")],
            ["com_cd" => "PROSES_ST_61","code_nm"=>"Gagal Persetujuan", "code_group" => "PROSES_ST","code_value" => NULL,"created_by"=>"admin","created_at" => date("Y-m-d H:i:s")],
            ["com_cd" => "PROSES_ST_70","code_nm"=>"Pelaksanaan oleh Mitra Kemaslahatan", "code_group" => "PROSES_ST","code_value" => NULL,"created_by"=>"admin","created_at" => date("Y-m-d H:i:s")],
            ["com_cd" => "PROSES_ST_80","code_nm"=>"Audit", "code_group" => "PROSES_ST","code_value" => NULL,"created_by"=>"admin","created_at" => date("Y-m-d H:i:s")],
            ["com_cd" => "PROSES_ST_90","code_nm"=>"Selesai", "code_group" => "PROSES_ST","code_value" => NULL,"created_by"=>"admin","created_at" => date("Y-m-d H:i:s")],
        ]);
    }
}
