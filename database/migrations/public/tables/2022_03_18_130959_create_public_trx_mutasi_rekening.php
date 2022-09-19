<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicTrxMutasiRekening extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('public.trx_mutasi_rekening', function (Blueprint $table) {
            $table->uuid('trx_mutasi_rek_id')->primary();
            $table->date('post_date')->nullable();
            $table->time('post_time')->nullable();
            $table->date('eff_date')->nullable();
            $table->time('eff_time')->nullable();
            $table->text('description')->nullable();
            $table->decimal('debit', 20,2)->nullable();
            $table->decimal('credit', 20,2)->nullable();
            $table->decimal('balance', 20,2)->nullable();
            $table->string('ref_no', 300)->nullable();
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
        Schema::dropIfExists('public_trx_mutasi_rekening');
    }
}
