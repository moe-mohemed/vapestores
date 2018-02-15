<?php

namespace App\Providers;

use App\Store;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->filterThings();
        //$this->allStores();


    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    public function allStores(){
        view()->composer('layout', function($view) {
            $stores = Store::Where('closed_down', 0);
            $view->with('stores', $stores);
            dd($stores);
        });
    }
    public function filterThings()
    {


        view()->composer('sidebar', function($view) {
            /*$city = DB::raw('COUNT(region) as regionCount, COUNT(city) as cityCount, city_slug, region_slug');
            dd($city);*/
            /*$cities = Store::select('region', 'city', DB::raw('COUNT(region) as regionCount, COUNT(city) as cityCount, city_slug, region_slug'))
                ->groupBy('city')
                ->get();
            //dd($cities);
            $view->with('cities', $cities);*/
            /*$cities = Store::select('region', 'city', DB::raw('COUNT(region) as regionCount, COUNT(city) as cityCount, city_slug, region_slug'))
                ->groupBy('city')
                ->get();
            $view->with('cities');*/
            //$view->with('cities', Store::with('children')->orderBy('region', 'asc')->get());
            $region = Store::select('region', 'region_slug')->distinct()->pluck('region', 'region_slug');
            /*$region = DB::table('stores')
                ->select(DB::raw('count(*) as region_counts, region, region_slug'))
                ->groupBy('region')
                ->get();*/
            $loc = array();
            foreach ($region as $reg_slug => $reg) {
                $city = DB::table('stores')
                    ->select(DB::raw('count(*) as counts, city, city_slug, region_slug'))
                    ->where('region', $reg)
                    ->where('closed_down', 0)
                    ->groupBy('city')
                    ->get();
                /*$city = Store::select('city','city_slug')
                    ->where('region', $reg)
                    ->distinct()
                    ->pluck('city','city_slug');*/
                /*foreach ($city as $c){
                   $cityCount = Store::select('id', DB::raw('COUNT(city) as cityCount'))
                       ->where('city', $c)
                       ->get();
                }*/
                $loc[] = array(
                    'region' => $reg,
                    'cities' => $city
                );

            }
            //dd($loc);
            $view->with('loc', $loc);
        });
    }
}
