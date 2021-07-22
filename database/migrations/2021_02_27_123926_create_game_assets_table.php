<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameAssetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('game_assets', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('asset_name')->nullable();
			$table->string('asset_description')->nullable();
			$table->binary('asset_body', 65535)->nullable();
			$table->smallInteger('asset_for_game')->nullable();
			$table->boolean('asset_status')->nullable();
			$table->integer('asset_taxonomy_id')->nullable()->index('asset_taxonomy_id');
			$table->integer('ipr_id')->nullable()->index('ipr_id');
			$table->integer('file_ext_id')->nullable()->index('file_ext_id');
			$table->integer('file_size_kb')->nullable();
			$table->string('author_name')->nullable();
			$table->integer('creator_id')->nullable()->index('creator_id');
			$table->dateTime('created_at')->nullable()->default('now()');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('game_assets');
	}

}
