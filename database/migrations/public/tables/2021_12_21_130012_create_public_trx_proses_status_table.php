<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicTrxProsesStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('public.trx_proses_status', function (Blueprint $table) {
            $table->string('trx_proses_status_id',100)->primary();
            $table->string('proses_nm',1000);
            $table->string('proses_next_yes',100)->nullable();
            $table->string('proses_next_no',100)->nullable();
            $table->string('proses_form_title',1000)->nullable();
            $table->string('proses_btn_yes_title',1000)->nullable();
            $table->string('proses_btn_no_title',1000)->nullable();
            $table->string('proses_file_nm',1000)->nullable();
            $table->json('proses_roles')->nullable();
            $table->string('created_by',50)->nullable();
            $table->string('updated_by',50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('public.trx_proses_status');
    }
}
