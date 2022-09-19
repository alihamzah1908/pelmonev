<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicTrxMitraKemaslahatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('public.trx_mitra_kemaslahatan', function (Blueprint $table) {
            $table->uuid('trx_mitra_kemaslahatan_id')->primary();
            $table->string('mitra_kemaslahatan_nm', 100);
            $table->string('phone', 20)->nullable();
            $table->string('region_prop', 20)->nullable();
            $table->string('region_kab', 20)->nullable();
            $table->string('region_kec', 20)->nullable();
            $table->string('region_kel', 20)->nullable();
            $table->string('address', 1000)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('email2', 100)->nullable();
            $table->string('email3', 100)->nullable();
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
        Schema::dropIfExists('public.trx_mitra_kemaslahatan');
    }
}
