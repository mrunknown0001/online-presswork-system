<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	[
        		'firstname' => 'Admin',
        		'lastname' => 'Administrator',
        		'username' => 'admin',
        		'password' => bcrypt('pressworkadmin'),
        		'user_type' => 1
        	],

        	[
        		'firstname' => 'Editor In',
        		'lastname' => 'Chief',
        		'username' => 'eic',
        		'password' => bcrypt('pressworkeic'),
        		'user_type' => 2
        	]
        ]);
    }
}
