<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\Film;
use App\Models\Screening;

use App\Observers\FilmObserver;
use App\Observers\ScreeningObserver;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      Film::observe(FilmObserver::class);
      Screening::observe(ScreeningObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
