<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePublicTrxProposalTable20220217 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('public.trx_proposal', function (Blueprint $table) {
            $table->decimal('nominal_realisasi', 20,2)->nullable();
            $table->decimal('nominal_efisiensi', 20,2)->nullable();

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
            $table->dropColumns(['nominal_realisasi','nominal_efisiensi']);
        });
    }
}
