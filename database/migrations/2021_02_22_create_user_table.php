<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

            $table->integer('id',);
            $table->string('full_name');
            $table->string('user_name');
            $table->string('password');
            $table->timestamp('created_at')->default('NOW');
            $table->integer('age',);
            $table->tinyInteger('gender',);
            $table->tinyInteger('grade',);
            $table->string('email',32)->nullable()->default('NULL');
            $table->string('nick_name',32)->nullable()->default('NULL');
            $table->tinyInteger('fungame_skills',2)->nullable()->default('NULL');
            $table->tinyInteger('edugame_skills',2)->nullable()->default('NULL');
            $table->tinyInteger('status',);
            $table->integer('role_id',);

        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}