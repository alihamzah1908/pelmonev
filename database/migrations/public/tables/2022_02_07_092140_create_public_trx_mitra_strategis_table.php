<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicTrxMitraStrategisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('public.trx_mitra_strategis', function (Blueprint $table) {
            $table->uuid('trx_mitra_strategis_id')->primary();
            $table->string('mitra_strategis_nm', 100);
            $table->string('instansi', 255)->nullable();
            $table->string('jabatan', 255)->nullable();
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
        Schema::dropIfExists('public.trx_mitra_strategis');
    }
}
