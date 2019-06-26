<?php

use Illuminate\Database\Seeder;

class StrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('strands')->insert([
        'title' => 'Creatures of the Night',
        'color' => '#000000',
        'description' => 'Cult films. Late at night.',
        'thumb' => '',
        'slug' => 'creatures'
      ]);
      DB::table('strands')->insert([
        'title' => 'Tuesday Wonder',
        'color' => '#00B9BE',
        'description' => 'Films to feed your consciousness',
        'thumb' => '',
        'slug' => 'tw'
      ]);
      DB::table('strands')->insert([
        'title' => 'Hyde & Seek',
        'color' => '#FFDD00',
        'description' => 'Discover a world of family friendly films, every Saturday at 12 noon.',
        'thumb' => '',
        'slug' => 'hyde-seek'
      ]);
    }
}
