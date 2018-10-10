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
        		'password' => bcrypt('password'),
        		'user_type' => 1
        	],

        	[
        		'firstname' => 'Editor In',
        		'lastname' => 'Chief',
        		'username' => 'eic',
        		'password' => bcrypt('password'),
        		'user_type' => 2
        	],

            [
                'firstname' => 'Le',
                'lastname' => 'Layout',
                'username' => 'le',
                'password' => bcrypt('password'),
                'user_type' => 3
            ],

            [
                'firstname' => 'Se',
                'lastname' => 'Section',
                'username' => 'se',
                'password' => bcrypt('password'),
                'user_type' => 4
            ],

            [
                'firstname' => 'Co',
                'lastname' => 'Corr',
                'username' => 'co',
                'password' => bcrypt('password'),
                'user_type' => 5
            ]


        ]);

        DB::table('section_editor_assignments')->insert([
            'user_id' => 4,
            'section_id' => 2
        ]);
    }
}
