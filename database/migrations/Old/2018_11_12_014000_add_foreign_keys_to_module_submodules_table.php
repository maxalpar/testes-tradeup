<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToModuleSubmodulesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('module_submodules', function(Blueprint $table)
		{
			$table->foreign('module_id')->references('id')->on('modules')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('submodule_id')->references('id')->on('submodules')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('submodule_origin_id')->references('id')->on('module_submodules')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('module_submodules', function(Blueprint $table)
		{
			$table->dropForeign('module_submodules_module_id_foreign');
			$table->dropForeign('module_submodules_submodule_id_foreign');
			$table->dropForeign('module_submodules_submodule_origin_id_foreign');
		});
	}

}
