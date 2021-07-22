<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToGameAssetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('game_assets', function(Blueprint $table)
		{
			$table->foreign('asset_taxonomy_id', 'game_assets_ibfk_1')->references('id')->on('game_asset_taxonomy')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('ipr_id', 'game_assets_ibfk_2')->references('id')->on('intellectual_prop_rights')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('file_ext_id', 'game_assets_ibfk_3')->references('id')->on('file_extestions')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('creator_id', 'game_assets_ibfk_4')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('game_assets', function(Blueprint $table)
		{
			$table->dropForeign('game_assets_ibfk_1');
			$table->dropForeign('game_assets_ibfk_2');
			$table->dropForeign('game_assets_ibfk_3');
			$table->dropForeign('game_assets_ibfk_4');
		});
	}

}
