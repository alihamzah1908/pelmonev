<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePublicTrxKuotaProposal20220222200605 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('public.trx_kuota_proposal', function (Blueprint $table) {
            $table->renameColumn('region_cd', 'kuota_cd');
            $table->renameColumn('ruang_lingkup', 'kuota_tp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('public.trx_kuota_proposal', function (Blueprint $table) {
            $table->renameColumn('kuota_tp', 'ruang_lingkup');
            $table->renameColumn('kuota_cd', 'region_cd');
        });
    }
}
