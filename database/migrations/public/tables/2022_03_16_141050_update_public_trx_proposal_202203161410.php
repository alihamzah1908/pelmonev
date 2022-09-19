<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePublicTrxProposal202203161410 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('public.trx_proposal', function (Blueprint $table) {
            $table->string('rab_tp')->nullable();
            $table->string('kuota_st')->nullable();
            $table->string('kuota_wilayah')->nullable();
            $table->string('kuota_ruang_lingkup')->nullable();
            $table->string('kuota_mitra')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('public.trx_proposal', function (Blueprint $table) {
            $table->dropColumn([
                'rab_tp',
                'kuota_st',
                'kuota_wilayah',
                'kuota_ruang_lingkup',
                'kuota_mitra'
            ]);
        });
    }
}
