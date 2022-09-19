<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicTrxPemohonKerjasamaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('public.trx_pemohon_kerjasama', function (Blueprint $table) {
            $table->uuid('trx_pemohon_kerjasama_id')->primary();
            $table->uuid('trx_pemohon_id')->nullable();
            $table->string('lembaga_nm', 100)->nullable();
            $table->string('kegiatan_nm', 1000)->nullable();
            $table->decimal('nominal_bantuan', 19,2)->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('public.trx_pemohon_kerjasama');
    }
}
