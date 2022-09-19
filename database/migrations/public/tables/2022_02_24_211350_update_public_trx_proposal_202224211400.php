<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePublicTrxProposal202224211400 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('public.trx_proposal', function (Blueprint $table) {
            $table->string('penanggung_jawab_address', 200)->nullable();
            $table->string('penanggung_jawab_jabatan', 200)->nullable();
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
            $table->dropColumns(['penanggung_jawab_address','penanggung_jawab_jabatan']);
        });
    }
}
