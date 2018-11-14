<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

use Carbon\Carbon;

use App\Models\Film;
use App\Models\Screening;
use App\Models\Menu;

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

      if (! $this->app->runningInConsole()) {
        $footerMenuEntries = Menu::where('title','Footer')->pluck('entries')->first();
        if($footerMenuEntries) {
          $footerMenuIds = array_column($footerMenuEntries, 'page');
          $footerMenuIdsStr = implode(',', $footerMenuIds);
          $footerMenu = \Backpack\PageManager\app\Models\Page::whereIn('id',$footerMenuIds)->get();
          $footerMenu = $footerMenu->sortBy(function($model) use ($footerMenuIds) {
              return array_search($model->id, $footerMenuIds);
          });

          // Replaced the above with DB query because MySQL returns results ordered by ID by default. We want to respect menu order.
          // $footerMenu = DB::table('pages')
          //     ->whereIn('id', $footerMenuIds)
          //     ->orderByRaw(DB::raw("FIELD(id, $footerMenuIdsStr)"))
          //     ->get();
          View::share('footermenu', $footerMenu);
        }
      }



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
