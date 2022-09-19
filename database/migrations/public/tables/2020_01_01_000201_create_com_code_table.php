<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('public.com_code', function (Blueprint $table) {
            $table->string('com_cd',100);
            $table->string('code_nm',1000);
            $table->string('code_group',100);
            $table->string('code_value',1000)->nullable();
            $table->string('code_value_2',1000)->nullable();
            $table->string('code_value_3',1000)->nullable();
            $table->string('created_by',50)->nullable();
            $table->string('updated_by',50)->nullable();
            $table->timestamps();

            $table->primary('com_cd');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('com_code');
    }
}
