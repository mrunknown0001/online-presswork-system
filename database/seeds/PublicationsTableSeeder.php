<?php

use Illuminate\Database\Seeder;

class PublicationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('publications')->insert([
        	[
        		'name' => 'Obra'
        	],
        	[
        		'name' => 'Newsletter'
        	],
        	[
        		'name' => 'Tabloid '
        	],
        	[
        		'name' => 'Folio'
        	],
        	[
        		'name' => 'Magazines '
        	],
        	[
        		'name' => 'Brochure'
        	],
        	[
        		'name' => 'Newsflash'
        	]
        ]);
    }
}
