<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePublicTrxProposal20220207 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('public.trx_proposal', function (Blueprint $table) {
            $table->uuid('trx_mitra_strategis_id')->nullable();
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
            $table->dropColumn('trx_mitra_strategis_id');
        });
    }
}
