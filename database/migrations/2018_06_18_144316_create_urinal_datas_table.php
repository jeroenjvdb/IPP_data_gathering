<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUrinalDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('urinal_datas', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('device_id')->unsigned();

            $table->integer('type')->nullable();
            $table->integer('nb_flush')->nullable();
            $table->boolean('congestion')->default(false);
            $table->boolean('clogged')->default(false);
            $table->integer('nb_mkey');
            $table->integer('t_evac');

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
        Schema::dropIfExists('urinal_datas');
    }
}
