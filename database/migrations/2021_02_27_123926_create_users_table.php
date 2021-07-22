<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('full_name')->nullable();
			$table->string('user_name')->nullable();
			$table->string('password')->nullable();
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->integer('age')->nullable();
			$table->boolean('gender')->nullable();
			$table->boolean('grade')->nullable();
			$table->string('email', 32)->nullable();
			$table->string('nick_name', 32)->nullable();
			$table->boolean('fungame_skills')->nullable();
			$table->boolean('edugame_skills')->nullable();
			$table->boolean('status')->nullable();
			$table->integer('role_id')->nullable()->index('role_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
