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
            $table->integer('device_id')->unsigned();

    	    $table->integer('type')->nullable();    
            $table->integer('nb_flush')->comment('flush events counter');
            $table->integer('nb_user')->comment('user events counter');
            $table->integer('status')->comment('must be converted to enum or something like that');
            $table->integer('user_flush_time')->comment('time between user and flushing detection in seconds');
            $table->integer('key_present_ev')->comment('key present events');
            $table->integer('flush_time')->comment('number of seconds for flushing');

            $table->string('address')->nullable();
            $table->string('payload')->nullable();


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
