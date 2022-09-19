<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicTrxProposalLembagaPengurusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('public.trx_proposal_lembaga_pengurus', function (Blueprint $table) {
            $table->uuid('trx_proposal_lembaga_pengurus_id')->primary();
            $table->uuid('trx_proposal_id')->nullable();
            $table->string('pengurus_nm', 100)->nullable();
            $table->string('jabatan_nm', 100)->nullable();
            $table->string('pekerjaan_nm', 100)->nullable();
            $table->text('note')->nullable();
            $table->string('created_by',50)->nullable();
            $table->string('updated_by',50)->nullable();
            $table->timestamps();

            $table->foreign('trx_proposal_id')
            ->references('trx_proposal_id')
            ->on('trx_proposal')
            ->onUpdate('CASCADE')
            ->onDelete('CASCADE');
        });;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('public_trx_proposal_lembaga_pengurus');
    }
}
