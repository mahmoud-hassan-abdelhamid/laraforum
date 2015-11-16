<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForumTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('forum',function( $table){
			$table->increments('id');
			$table->string('name');
			$table->boolean('locked')->default(false);
			$table->integer('category_id')->unsigned()->nullable();
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->engine = 'InnoDB';
		});

	/*	 Schema::table('forum', function($table) {
      		$table->foreign('category_id')->references('id')->on('category');
   		});*/

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('forum');
	}

}
