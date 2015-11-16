<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReplyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reply',function($table){
			$table->increments('id');
			$table->string('title');
			$table->longText('content');
			$table->integer('thread_id')->unsigned()->nullable();
			$table->integer('user_id')->unsigned()->nullable();
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->engine = 'InnoDB';
		});

	/*	Schema::table('reply', function($table) {
			$table->foreign('thread_id')
			      ->references('id')->on('thread')
			      ->onDelete('cascade');
			$table->foreign('user_id')
			      ->references('id')->on('user')
			      ->onDelete('cascade');
   		});*/
   		
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('reply');
	}

}
