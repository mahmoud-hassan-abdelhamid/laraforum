<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThreadTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('thread',function($table){
			$table->increments('id');
			$table->string('title');
			$table->boolean('stickey')->default(false);
			$table->integer('forum_id')->unsigned()->nullable();
			$table->integer('user_id')->unsigned()->nullable();
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->boolean('locked')->default(false);
			$table->longText('content');
			$table->engine = 'InnoDB';			     
		});

	/*	Schema::table('thread', function($table) {
      		$table->foreign('forum_id')
			      ->references('id')->on('forum')
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
		Schema::drop('thread');
	}

}
