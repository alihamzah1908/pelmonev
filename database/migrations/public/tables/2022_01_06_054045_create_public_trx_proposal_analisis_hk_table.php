<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicTrxProposalAnalisisHkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('public.trx_proposal_analisis_hk', function (Blueprint $table) {
            $table->uuid('trx_proposal_analisis_hk_id',100)->primary();
            $table->uuid('trx_proposal_id');
            $table->json('verifikasi')->nullable();
            $table->text('analisa_legalitas')->nullable();
            $table->text('analisa_peraturan')->nullable();
            $table->text('analisa_hukum')->nullable();
            $table->text('kesimpulan')->nullable();
            $table->text('rekomendasi')->nullable();
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
        Schema::dropIfExists('public.trx_proposal_analisis_hk');

    }
}
