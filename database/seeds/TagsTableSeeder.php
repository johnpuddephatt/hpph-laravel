<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('tags')->insert([
        'title' => 'Captioned',
        'abbreviation' => 'C',
        'description' => 'Captioning converts the spoken word into text which provides people with hearing loss access to live performances. In captioning, the words appear on a screen at the same time as they are sung or spoken. Captions also include sound effects, offstage noises and character names.',
        'color' => ''
      ]);
      DB::table('tags')->insert([
        'title' => 'Bring Your Own Baby',
        'abbreviation' => 'BYOBABY',
        'description' => 'A chance for parents and carers with babies up to 12 months old to visit the cinema without leaving the little one at home. Featuring raised lighting, reduced volume and baby changing facilities.',
        'color' => '#d18500'
      ]);
      DB::table('tags')->insert([
        'title' => 'Autism friendly',
        'abbreviation' => 'AF',
        'description' => 'A safe environment for those on the autism spectrum who wish to visit the cinema. During screenings audiences are able to move more freely around the cinema during the film.',
        'color' => '#005b81'
      ]);
    }
}
