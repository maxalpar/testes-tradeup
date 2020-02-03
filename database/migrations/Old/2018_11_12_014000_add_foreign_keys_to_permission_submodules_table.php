<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPermissionSubmodulesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('permission_submodules', function(Blueprint $table)
		{
			$table->foreign('module_submodule_id')->references('id')->on('module_submodules')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('permission_id')->references('id')->on('permissions')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('permission_submodules', function(Blueprint $table)
		{
			$table->dropForeign('permission_submodules_module_submodule_id_foreign');
			$table->dropForeign('permission_submodules_permission_id_foreign');
		});
	}

}
