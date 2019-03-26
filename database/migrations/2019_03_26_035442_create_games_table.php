<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('board_one_id');
            $table->unsignedBigInteger('board_two_id');
            $table->unsignedBigInteger('winner')->nullable();;
            $table->smallInteger('status')->default(1)->comment('1 - playing, 2 - finished');
            $table->foreign('board_one_id')->references('id')->on('boards');
            $table->foreign('board_two_id')->references('id')->on('boards');
            $table->foreign('winner')->references('id')->on('boards');
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
        Schema::dropIfExists('games');
    }
}
