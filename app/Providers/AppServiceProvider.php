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

        $footerMenu =  \Cache::rememberForever('footerMenu', function () {
          $footerMenuEntries = Menu::where('title','Footer')->pluck('entries')->first();
          if($footerMenuEntries) {
            $footerMenuIds = array_column($footerMenuEntries, 'page');
            $footerMenuIdsStr = implode(',', $footerMenuIds);
            $footerMenu = \Backpack\PageManager\app\Models\Page::whereIn('id',$footerMenuIds)->get();
            $footerMenu = $footerMenu->sortBy(function($model) use ($footerMenuIds) {
              return array_search($model->id, $footerMenuIds);
            });
            return $footerMenu;
          }
        });

        $days_until_otr = \Cache::remember('daysUntilOtr', Carbon::tomorrow(), function () {
          return Carbon::now()->diffInDays(Carbon::createFromFormat('d/m/Y', '16/02/2020'));
        });

        $searchData = \Cache::remember('searchData', Carbon::tomorrow(), function () {
          // $data = Film::hasFutureScreenings()->get()->toJson();
          $data = Film::hasFutureScreenings()->orderBy('id','desc')->get()->map(function($item){
            return array('slug' => $item->slug, 'title' => $item->title, 'alt_language_title' => $item->alt_language_title);
          })->toJson();
          return $data;
        });

        View::composer('*', function ($view) use ($footerMenu, $searchData, $days_until_otr) {
          $view->with('days_until_otr', $days_until_otr);
          $view->with('footermenu', $footerMenu);
          $view->with('searchData', $searchData);
        });

        // $footerMenuEntries = Menu::where('title','Footer')->pluck('entries')->first();
        // if($footerMenuEntries) {
        //   $footerMenuIds = array_column($footerMenuEntries, 'page');
        //   $footerMenuIdsStr = implode(',', $footerMenuIds);
        //   $footerMenu = \Backpack\PageManager\app\Models\Page::whereIn('id',$footerMenuIds)->get();
        //   $footerMenu = $footerMenu->sortBy(function($model) use ($footerMenuIds) {
        //       return array_search($model->id, $footerMenuIds);
        //   });
        //
        //   View::share('footermenu', $footerMenu);
        // }
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
