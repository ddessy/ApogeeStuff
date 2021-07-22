<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToLearningContentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('learning_contents', function(Blueprint $table)
		{
			$table->foreign('ipr_id', 'learning_contents_ibfk_1')->references('id')->on('intellectual_prop_rights')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('file_ext_id', 'learning_contents_ibfk_2')->references('id')->on('file_extestions')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('creator_id', 'learning_contents_ibfk_3')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('learning_contents', function(Blueprint $table)
		{
			$table->dropForeign('learning_contents_ibfk_1');
			$table->dropForeign('learning_contents_ibfk_2');
			$table->dropForeign('learning_contents_ibfk_3');
		});
	}

}
