<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicTrxProposalAnalisisResikoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('public.trx_proposal_analisis_resiko', function (Blueprint $table) {
            $table->uuid('trx_proposal_analisis_resiko_id',100)->primary();
            $table->uuid('trx_proposal_id');
            $table->text('resiko_reputasi')->nullable();
            $table->text('resiko_keberlanjutan')->nullable();
            $table->text('mitigasi_resiko_reputasi')->nullable();
            $table->text('mitigasi_resiko_keberlanjutan')->nullable();
            $table->text('kesimpulan')->nullable();
            $table->string('created_by',50)->nullable();
            $table->string('updated_by',50)->nullable();
            $table->timestamps();

            $table->foreign('trx_proposal_id')
            ->references('trx_proposal_id')
            ->on('trx_proposal')
            ->onUpdate('CASCADE')
            ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('public.trx_proposal_analisis_resiko');
    }
}
