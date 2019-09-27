<?php

use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('pages')->insert([
        'template' => 'standard',
        'name' => 'Contact us',
        'title' => 'Contact us',
        'slug' => 'contact-us',
      ]);
      DB::table('pages')->insert([
        'template' => 'standard',
        'name' => 'Privacy policy',
        'title' => 'Privacy policy',
        'slug' => 'privacy-policy',
      ]);
      DB::table('pages')->insert([
        'template' => 'standard',
        'name' => 'Jobs & volunteering',
        'title' => 'Jobs & volunteering',
        'slug' => 'jobs',
      ]);
      DB::table('pages')->insert([
        'template' => 'standard',
        'name' => 'Terms & conditions',
        'title' => 'Terms & conditions',
        'slug' => 'terms',
      ]);
    }
}
