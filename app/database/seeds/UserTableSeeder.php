<?php

class UserTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$users=[
		['email' => 'user@site.com','password' => Hash::make('123'),'role'=>'user'],
		['email' => 'admin@site.com','password' =>Hash::make('123'),'role'=>'admin']
		];

		DB::table('user')->insert($users);
	}

}
