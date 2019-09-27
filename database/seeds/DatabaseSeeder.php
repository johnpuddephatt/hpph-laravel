<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      $this->call(TagsTableSeeder::class);
      $this->call(StrandsTableSeeder::class);

      $this->call(FilmsTableSeeder::class);
      $this->call(ScreeningsTableSeeder::class);

      $this->call(ScreeningTagTableSeeder::class);
      $this->call(FilmStrandTableSeeder::class);

      $this->call(PagesTableSeeder::class);
    }
}
