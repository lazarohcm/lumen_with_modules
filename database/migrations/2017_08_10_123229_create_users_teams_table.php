<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_teams', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('teams_id')->unsigned();
            $table->integer('users_id')->unsigned();
            $table->integer('level_access_id')->unsigned();
            $table->timestamps();

            $table->foreign('teams_id')->references('id')->on('teams')->onDelete('cascade');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('level_access_id')->references('id')->on('level_access')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_teams');
    }
}
