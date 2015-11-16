<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

		 $this->call('CategoryTableSeeder');
		 $this->call('ForumTableSeeder');
		 $this->call('UserTableSeeder');
	}

}
