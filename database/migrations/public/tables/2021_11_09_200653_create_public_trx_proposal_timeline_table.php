<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicTrxProposalTimelineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('public.trx_proposal_timeline', function (Blueprint $table) {
            $table->uuid('trx_proposal_timeline_id')->primary();
            $table->uuid('trx_proposal_id');
            $table->string('timeline_by');
            $table->string('status');
            $table->string('file_asesmen',100)->nullable();
            $table->text('note')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
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
        Schema::dropIfExists('public.trx_proposal_timeline');
    }
}
