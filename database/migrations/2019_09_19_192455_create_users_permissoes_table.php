<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersPermissoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_permissoes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('permissao_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('permissao_id')->references('id')->on('permissoes');
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_permissoes');
    }
}
