<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicTrxProposalPengalamanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('public.trx_proposal_pengalaman', function (Blueprint $table) {
            $table->uuid('trx_proposal_pengalaman_id')->primary();
            $table->uuid('trx_proposal_id');
            $table->string('program_kegiatan', 1000)->nullable();
            $table->string('tujuan', 1000)->nullable();
            $table->string('lokasi', 1000)->nullable();
            $table->string('outcome', 1000)->nullable();
            $table->string('output', 1000)->nullable();
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
        Schema::dropIfExists('public.trx_proposal_pengalaman');
    }
}
