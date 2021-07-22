<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToLearningContent2taxonomyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('learning_content2taxonomy', function(Blueprint $table)
		{
			$table->foreign('learning_content_id', 'learning_content2taxonomy_ibfk_1')->references('id')->on('learning_contents')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('learning_content_taxonomy_id', 'learning_content2taxonomy_ibfk_2')->references('id')->on('learning_content_taxonomy')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('learning_content2taxonomy', function(Blueprint $table)
		{
			$table->dropForeign('learning_content2taxonomy_ibfk_1');
			$table->dropForeign('learning_content2taxonomy_ibfk_2');
		});
	}

}
