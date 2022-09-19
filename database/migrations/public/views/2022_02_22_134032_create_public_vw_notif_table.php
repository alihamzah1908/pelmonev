<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicVwNotifTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
        CREATE OR REPLACE VIEW public.vw_notif as select
            tp.trx_proposal_id,
            tp.judul_proposal,
            tp.updated_at,
            tps.trx_proses_status_id,
            tps.proses_nm,
            tps.proses_roles
        from
            trx_proposal tp
        inner join trx_proses_status tps on
            tp.proses_st = tps.trx_proses_status_id
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP VIEW public.vw_notif');
    }
}
