<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicTrxProposalLayakTeknisAnalisaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('public.trx_proposal_layak_teknis_analisa', function (Blueprint $table) {
            $table->uuid('trx_proposal_layak_teknis_analisa_id')->primary();
            $table->uuid('trx_proposal_id');
            $table->text('tujuan')->nullable();
            $table->text('manfaat')->nullable();
            $table->text('kuota_kegiatan')->nullable();
            $table->text('hukum')->nullable();
            $table->text('kompetensi_tenaga_ahli')->nullable();
            $table->text('ekonomi')->nullable();
            $table->text('kapasitas_mitra')->nullable();
            $table->text('aspek_kewajaran_biaya')->nullable();
            $table->text('kuota_wilayah')->nullable();
            $table->text('dampak_kualitas')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('public.trx_proposal_layak_teknis_analisa');
    }
}
