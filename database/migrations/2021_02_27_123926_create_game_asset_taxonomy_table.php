<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameAssetTaxonomyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('game_asset_taxonomy', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('asset_type_name')->nullable();
			$table->integer('parent_id')->nullable()->index('parent_id');
			$table->dateTime('created_at')->nullable()->default('now()');
			$table->string('resource_description')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('game_asset_taxonomy');
	}

}
