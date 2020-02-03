<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRefundsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('refunds', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
            $table->bigInteger('user_id')->unsigned()->index('user_id_foreign');
			$table->dateTime('date');
			$table->string('type');
			$table->text('description');
			$table->float('value');
			$table->integer('approved')->default(0);
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
		Schema::drop('refunds');
	}

}
