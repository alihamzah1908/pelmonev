<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicTrxProposalLayakTeknisDeskripsiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('public.trx_proposal_layak_teknis_deskripsi', function (Blueprint $table) {
            $table->uuid('trx_proposal_layak_teknis_deskripsi_id')->primary();
            $table->uuid('trx_proposal_id');
            $table->text('nama_program')->nullable();
            $table->text('sistem_penyaluran')->nullable();
            $table->text('sub_program')->nullable();
            $table->text('tujuan_program')->nullable();
            $table->text('anggaran_sumberdana')->nullable();
            $table->text('rencana_lokasi')->nullable();
            $table->text('penerima_maslahat')->nullable();
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
        Schema::dropIfExists('public.trx_proposal_layak_teknis_deskripsi');
    }
}
