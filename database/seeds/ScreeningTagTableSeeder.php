<?php

use Illuminate\Database\Seeder;

class ScreeningTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $screening_count = App\Models\Screening::count();
      $tag_count = App\Models\Tag::count();
      $tag_ratio = .25;  // ratio of screenings that have a tag
        //

      for ($i = 0; $i < ($tag_ratio * $screening_count); $i++) {
        DB::table('screening_tag')->insert([
          'screening_id' => rand(1,$screening_count),
          'tag_id' => rand(1,$tag_count)
        ]);
      }

    }
}
