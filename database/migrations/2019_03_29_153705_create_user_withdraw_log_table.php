<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserWithdrawLogTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_withdraw_log', function(Blueprint $table)
		{
			$table->increments('id');
			$table->char('ip', 15)->default('');
			$table->string('order_id', 64)->default('')->index();
			$table->integer('amount')->unsigned()->default(0);
			$table->integer('user_id')->default(0);
			$table->string('username', 32)->default('');
			$table->text('request_params', 65535);
			$table->text('request_back', 16777215);
			$table->text('content', 65535);
			$table->string('request_reason', 128)->default('');
			$table->boolean('request_status')->default(0);
			$table->string('back_reason', 128)->default('');
			$table->boolean('back_status')->default(0);
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_withdraw_log');
	}

}
