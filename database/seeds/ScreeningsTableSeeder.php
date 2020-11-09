<?php

use Illuminate\Database\Seeder;

class ScreeningsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $film_count = App\Models\Film::count();
      $screening_count = 20;

      for ($i = 0; $i < $screening_count; $i++) {

        if(!App\Models\Screening::find($i+1)) {

          DB::table('screenings')->insert([
            'film_id' => ($i % $film_count) + 1,  // splits screenings evenly across all films
            'date' => date("Y/m/d",(time() + rand(0,($screening_count)) * 86400)), // gives an average of three screening per day
            'time' => rand(5,11) * 2 . ':00',
            'url' => '123'
          ]);

        }

      }


    //
    }

}
