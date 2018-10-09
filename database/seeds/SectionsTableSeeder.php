<?php

use Illuminate\Database\Seeder;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sections')->insert([
        	[
        		'name' => 'News',
        		'description' => 'News Section'
        	],
        	[
        		'name' => 'Sports',
        		'description' => 'Sports Section'
        	],
        	[
        		'name' => 'Development Communications',
        		'description' => 'Development Communications Section'
        	],
        	[
        		'name' => 'Features',
        		'description' => 'Features Section'
        	],
        	[
        		'name' => 'Literary',
        		'description' => 'Literary Section'
        	]
        ]);
    }
}
