<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicTrxKuotaProposalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('public.trx_kuota_proposal', function (Blueprint $table) {
            $table->uuid('trx_kuota_proposal_id',100)->primary();
            $table->integer('trx_year');
            $table->string('region_cd');
            $table->string('ruang_lingkup')->nullable();
            $table->decimal('kuota',19,2)->default(0);
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
        Schema::dropIfExists('public.trx_kuota_proposal');
    }
}
