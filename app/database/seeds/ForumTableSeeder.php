<?php

class ForumTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$forums=[
		['name' => 'forum1-cat-1','category_id' => 1],
		['name' => 'forum2-cat-1','category_id' => 1],
		['name' => 'forum1-cat-2','category_id' => 2],
		['name' => 'forum2-cat-2','category_id' => 2],
		['name' => 'forum1-cat-3','category_id' => 3],
		['name' => 'forum2-cat-3','category_id' => 3]
		];

		DB::table('forum')->insert($forums);
	}

}
