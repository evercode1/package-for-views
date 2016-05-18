<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLittleRedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('little_reds', function (Blueprint $table) {
            $table->increments('id');
            $table->string('little_red_name', 30)->unique();
            $table->string('slug', 30);
            $table->integer('blue_id')->unsigned();
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
        Schema::drop('little_reds');
    }
}