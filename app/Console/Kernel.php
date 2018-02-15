<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Intervention\Image\Facades\Image;
use App\Store;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // Commands\Inspire::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        $filePath = public_path().'/cronoutput.txt';
        $schedule->call(function () {


            //$stores = array_slice(scandir(public_path().'/googleimages/newimages/'), 2);
            //$stores = file_get_contents(public_path().'/googleimages/newimages/');
            //print_r($stores);
            // foreach ($stores as $store) {
            //     Image::make($store)->fit(400)->save(public_path().'/googleimages/nothumbs/'.$store);
            // }
        

            // $stores = Store::where('closed_down', 0)->get();
        
        
            // foreach ($stores as $store) {
            //     $url = "https://maps.googleapis.com/maps/api/place/details/json?placeid=$store->place_id&key=AIzaSyAGckPFOJijw-vwGXq8K4RUqjzr4zQN1TE";
            //     $response = file_get_contents($url);
            //     $json = json_decode($response,true);

            //     if (isset($json['result']['photos'])) {
            //         foreach ($json['result']['photos'] as $key => $photo) {
            //             if($key == 0){
            //                  $imageview = 'https://maps.googleapis.com/maps/api/place/photo?maxwidth='.$photo['width'].'&photoreference='.$photo['photo_reference'].'&key=AIzaSyAGckPFOJijw-vwGXq8K4RUqjzr4zQN1TE';
            //                 //echo $imageview;
            //                 Image::make(file_get_contents($imageview))->save(public_path().'/googleimages/'.$store->store_name_slug.'.jpg');
            //                 Image::make(public_path().'/googleimages/'.$store->store_name_slug.'.jpg')->fit(200)->save(public_path().'/googleimages/'.$store->store_name_slug.'-tn.jpg');
            //             }
            //         }
            //     }
            $placeids = Store::where('closed_down', 0)->get();
            foreach ($placeids as $placeid) {
                $url = "https://maps.googleapis.com/maps/api/place/details/json?placeid=$placeid->place_id&key=AIzaSyBzdFYFjrrhcFmTjaPCaSF9XfAT2M3Sv4Y";
                $response = file_get_contents($url);
                $json = json_decode($response,true);

                if (isset($json['result']['rating'])) {
                    $rating = $json['result']['rating'];
                    Store::where('place_id', $placeid->place_id)->where('id', '>', 0)->update(['google_rating' => $rating]);
                }
            }
        })->sendOutputTo($filePath);
    }
}
