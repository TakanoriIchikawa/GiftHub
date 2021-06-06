<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGivePoints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('give_points', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('give_point');
            $table->integer('give_user_id');
            $table->integer('receive_user_id');
            $table->boolean('signature');
            $table->string('message', 100)->nullable();
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
        Schema::dropIfExists('give_points');
    }
}
