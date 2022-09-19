<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicTrxProposalLaporanMonitoringTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('public.trx_proposal_laporan_monitoring', function (Blueprint $table) {
            $table->uuid('trx_proposal_laporan_monitoring_id')->primary();
            $table->uuid('trx_proposal_id');
            $table->string('jenis_kegiatan')->nullable();
            $table->string('nama_kegiatan')->nullable();
            $table->string('metode_pelaksanaan')->nullable();
            $table->date('tanggal_monitoring')->nullable();
            $table->string('periode_monitoring')->nullable();
            $table->text('note')->nullable();
            $table->text('bukti_foto_monitoring')->nullable();
            $table->string('kesimpulan_monitoring')->nullable();
            $table->string('status')->default('2');
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
        Schema::dropIfExists('public.trx_proposal_laporan_monitoring');
    }
}
