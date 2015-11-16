<?php

class CategoryTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$categories=[
		['name' => 'cat 1'],
		['name' => 'cat 2'],
		['name' => 'cat 3']
		];

		DB::table('category')->insert($categories);
	}

}
