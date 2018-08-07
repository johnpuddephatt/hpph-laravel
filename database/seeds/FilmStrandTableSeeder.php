<?php

use Illuminate\Database\Seeder;

class FilmStrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $film_count = App\Models\Film::count();
        $strand_count = App\Models\Tag::count();
        $strand_ratio = .25;  // ratio of screenings that have a tag
          //

        for ($i = 0; $i < ($strand_ratio * $film_count); $i++) {
          DB::table('film_strand')->insert([
            'film_id' => rand(1,$film_count),
            'strand_id' => rand(1,$strand_count)
          ]);
        }

    }
}
