<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicTrxPemohonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('public.trx_pemohon', function (Blueprint $table) {
            $table->uuid('trx_pemohon_id')->primary();
            $table->string('pemohon_nm', 100);

            $table->string('region_prop', 20)->nullable();
            $table->string('region_kab', 20)->nullable();
            $table->string('region_kec', 20)->nullable();
            $table->string('region_kel', 20)->nullable();
            $table->string('address', 1000)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('pemohon_latitude',20)->nullable();
            $table->string('pemohon_longitude',20)->nullable();

            $table->string('akta_pendirian', 1000)->nullable();
            $table->string('akta_perubahan_terakhir', 1000)->nullable();
            $table->string('sk_pengesahan_pendirian_no', 1000)->nullable();
            $table->string('sk_pengesahan_perubahan_terakhir_no', 1000)->nullable();
            $table->string('ktp_no_pimpinan', 50)->nullable();
            $table->string('npwp_no_lembaga', 50)->nullable();
            $table->string('kriteria_mitra', 1000)->nullable();

            $table->text('profil_singkat')->nullable();
            $table->string('struktur_organisasi_file', 100)->nullable();

            $table->string('phone', 20)->nullable();
            $table->string('website', 100)->nullable();
            $table->string('socmed', 100)->nullable();

            $table->string('penanggung_jawab_nm', 255)->nullable();
            $table->string('penanggung_jawab_email', 255)->nullable();
            $table->string('penanggung_jawab_phone', 100)->nullable();

            $table->string('bank_cd', 20)->nullable();
            $table->string('bank_branch', 255)->nullable();
            $table->string('bank_holder', 255)->nullable();
            $table->string('bank_account_no', 255)->nullable();
            $table->string('bank_account_file', 255)->nullable();

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
        Schema::dropIfExists('public.trx_pemohon');
    }
}
