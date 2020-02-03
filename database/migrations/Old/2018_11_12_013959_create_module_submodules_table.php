<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateModuleSubmodulesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('module_submodules', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('module_id')->unsigned()->index('module_submodules_module_id_foreign');
			$table->bigInteger('submodule_id')->unsigned()->index('module_submodules_submodule_id_foreign');
			$table->bigInteger('submodule_origin_id')->unsigned()->nullable()->index('module_submodules_submodule_origin_id_foreign');
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('module_submodules');
	}

}
