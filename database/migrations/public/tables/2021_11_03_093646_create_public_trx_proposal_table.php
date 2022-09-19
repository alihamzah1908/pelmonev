<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicTrxProposalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('public.trx_proposal', function (Blueprint $table) {
            $table->uuid('trx_proposal_id')->primary();
            $table->uuid('trx_pemohon_id')->nullable();
            $table->string('proposal_no', 200)->nullable();
            $table->string('judul_proposal', 200)->nullable();
            $table->decimal('nominal', 20,2)->nullable();
            $table->string('ruang_lingkup', 20)->nullable();
            $table->string('uraian_singkat_proposal', 300)->nullable();
            $table->string('deskripsi_singkat_proposal', 2000)->nullable();
            $table->string('proposal_fill_st', 1)->default('0');
            
            $table->decimal('nominal_rekomendasi', 20,2)->nullable();
            $table->uuid('trx_mitra_kemaslahatan_id')->nullable();
            $table->date('mitra_asessmen_date_start')->nullable();
            $table->date('mitra_asessmen_date_end')->nullable();

            $table->string('region_prop', 20)->nullable();
            $table->string('region_kab', 20)->nullable();
            $table->string('region_kec', 20)->nullable();
            $table->string('region_kel', 20)->nullable();
            $table->string('address', 1000)->nullable();
            $table->string('proposal_latitude',20)->nullable();
            $table->string('proposal_longitude',20)->nullable();

            $table->string('akta_pendirian', 1000)->nullable();
            $table->string('akta_perubahan_terakhir', 1000)->nullable();
            $table->string('sk_pengesahan_pendirian_no', 1000)->nullable();
            $table->string('sk_pengesahan_perubahan_terakhir_no', 1000)->nullable();
            $table->string('ktp_no_pimpinan', 50)->nullable();
            $table->string('npwp_no_lembaga', 50)->nullable();
            $table->string('kriteria_mitra', 1000)->nullable();
            $table->string('lembaga_fill_st', 1)->default('0');

            $table->text('profil_singkat')->nullable();
            $table->string('profil_fill_st', 1)->default('0');

            $table->string('phone', 20)->nullable();
            $table->string('website', 100)->nullable();
            $table->string('socmed', 100)->nullable();
            $table->string('informasi_fill_st', 1)->default('0');

            $table->string('penanggung_jawab_nm', 255)->nullable();
            $table->string('penanggung_jawab_email', 255)->nullable();
            $table->string('penanggung_jawab_phone', 100)->nullable();
            $table->string('bank_cd', 20)->nullable();
            $table->string('bank_branch', 255)->nullable();
            $table->string('bank_holder', 255)->nullable();
            $table->string('bank_account_no', 255)->nullable();
            $table->string('bank_account_file', 255)->nullable();
            $table->string('kontak_fill_st', 1)->default('0');
            
            $table->text('note')->nullable();

            $table->string('deskripsi_nama_kegiatan', 255)->nullable();
            $table->string('deskripsi_spesifikasi_kegiatan', 255)->nullable();
            $table->text('deskripsi_latar_belakang_usulan')->nullable();
            $table->text('deskripsi_tujuan_acara')->nullable();
            $table->decimal('deskripsi_nominal', 20,2)->nullable();
            $table->string('deskripsi_prioritas_penggunaan_dana', 255)->nullable();
            $table->string('deskripsi_fill_st', 1)->default('0');
            
            $table->string('lokasi_nama_gedung', 255)->nullable();
            $table->string('lokasi_region_prop', 20)->nullable();
            $table->string('lokasi_region_kab', 20)->nullable();
            $table->string('lokasi_region_kec', 20)->nullable();
            $table->text('lokasi_komunitas')->nullable();
            $table->string('lokasi_fill_st', 1)->default('0');

            $table->text('manfaat_bpkh')->nullable();
            $table->text('manfaat_haji')->nullable();
            $table->text('manfaat_kemaslahatan')->nullable();
            $table->text('manfaat_lain_lain')->nullable();
            $table->string('manfaat_fill_st', 1)->default('0');
            $table->string('sent_st', 1)->default('0');
            
            $table->string('file_fill_st', 1)->default('0');
            
            $table->string('pengurus',1)->default('0');
            $table->string('kerjasama',1)->default('0');
            $table->string('persiapan',1)->default('0');
            $table->string('donasi',1)->default('0');
            $table->string('rab',1)->default('0');
            $table->string('kerjasama2',1)->default('0');
            $table->string('pj',1)->default('0');
            $table->string('outcome',1)->default('0');
            $table->string('pengalaman',1)->default('0');

            $table->string('proses_st', 20)->nullable();
            $table->string('created_by',50)->nullable();
            $table->string('updated_by',50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('public.trx_proposal');
    }
}
