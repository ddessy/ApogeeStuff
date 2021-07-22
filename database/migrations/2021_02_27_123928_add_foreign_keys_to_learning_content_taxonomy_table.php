<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToLearningContentTaxonomyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('learning_content_taxonomy', function(Blueprint $table)
		{
			$table->foreign('parent_id', 'learning_content_taxonomy_ibfk_1')->references('id')->on('learning_content_taxonomy')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('learning_content_taxonomy', function(Blueprint $table)
		{
			$table->dropForeign('learning_content_taxonomy_ibfk_1');
		});
	}

}
