<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('u_datas', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('flush_ev_ctr')->comment('flush events counter');
            $table->integer('user_ev_ctr')->comment('user events counter');
            $table->integer('status')->comment('must be converted to enum');
            $table->integer('user_flush_time')->comment('time between user and flushing detection in seconds');
            $table->integer('key_present')->comment('key present events');
            $table->integer('flush_time')->comment('number of seconds for flushing');

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
        Schema::dropIfExists('u_datas');
    }
}
