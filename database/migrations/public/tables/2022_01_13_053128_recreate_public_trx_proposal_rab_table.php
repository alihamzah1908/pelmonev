<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RecreatePublicTrxProposalRabTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('public.trx_proposal_rab');

        Schema::create('public.trx_proposal_rab', function (Blueprint $table) {
            $table->uuid('trx_proposal_rab_id')->primary();
            $table->uuid('trx_proposal_id');
            $table->string('jenis_pengeluaran', 1000)->nullable();
            $table->string('satuan',50)->nullable();

            $table->integer('jumlah_unit')->nullable();
            $table->decimal('biaya_satuan',19,2)->nullable();
            $table->decimal('total',19,2)->nullable();

            $table->integer('jumlah_unit_mitra')->nullable();
            $table->decimal('biaya_satuan_mitra',19,2)->nullable();
            $table->decimal('total_mitra',19,2)->nullable();

            $table->integer('jumlah_unit_bpkh')->nullable();
            $table->decimal('biaya_satuan_bpkh',19,2)->nullable();
            $table->decimal('total_bpkh',19,2)->nullable();
            
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
        Schema::dropIfExists('public.trx_proposal_rab');
    }
}
