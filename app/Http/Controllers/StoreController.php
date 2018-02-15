<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Traits\AuthorizesUsers;
use App\Http\Requests\ManageStoreRequest;
use App\Photo;
use App\Rating;
use App\Store;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Input;
use Mail;
use App\Http\Requests\StoreRequest;

class StoreController extends Controller
{
    //
    //use AuthorizesUsers;
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show', 'index', 'home', 'showByCity', 'searchStore', 'mailout', 'api']]);

        parent::__construct();
    }

    public function create() {
        return view('store.create');
    }
    public function getCoordinates($address){
        $address = urlencode($address);
        $url = "http://maps.google.com/maps/api/geocode/json?sensor=false&address=" . $address;
        $response = file_get_contents($url);
        $json = json_decode($response,true);

        $address_data = array();
        foreach($json['results']['0']['address_components'] as $element){
            $address_data[ implode(' ',$element['types']) ] = $element['long_name'];
        }
        $store_details['address'] = implode("+", preg_split("/[\s]+/", $json['results'][0]['formatted_address']));
        $store_details['addressOrig'] = $json['results'][0]['formatted_address'];
        $store_details['lat'] = $json['results'][0]['geometry']['location']['lat'];
        $store_details['lng'] = $json['results'][0]['geometry']['location']['lng'];
        $store_details['city'] = $address_data['locality political'];
        $store_details['region'] = $address_data['administrative_area_level_1 political'];
        $store_details['city_slug'] = str_slug($store_details['city'], '-');
        $store_details['region_slug'] = str_slug($store_details['region'], '-');
        $store_details['place_id'] = $json['results'][0]['place_id'];

        return $store_details;

    }
    public function imgDir()
    {
        return 'spaimages';
    }
    public function store(StoreRequest $request) {
        // $this->validate();
        $apikey = 'AIzaSyCzzym-3p1s-IWmXF6kQ3Iqg2cmx8um-2E';
        $store = new Store;
        $store_details = $this->getCoordinates($request->store_address);
        $store_name_slug = str_slug($request->store_name, '-');
        $imageview = 'https://maps.googleapis.com/maps/api/streetview?size=640x400&location=' .$store_details['address'].'&pitch=10&key='.$apikey;
        $city = $request->input('city');
        if ($city) {
            $request->request->add([
                'city' => $city,
                'city_slug' => str_slug($city, '-')
            ]);
        } else {
            $request->request->add([
                'city' => $store_details['city'],
                'city_slug' => $store_details['city_slug']
            ]);
        }
        $request->request->add([
            'store_name_slug' => $store_name_slug,
            'lat' => $store_details['lat'],
            'lng' => $store_details['lng'],
            'region' => $store_details['region'],
            'store_address' => $store_details['addressOrig'],
            'region_slug' => $store_details['region_slug'],
            'main_img' => $this->imgDir().'/'.$store_name_slug.'.jpg',
            'place_id' => $store_details['place_id']
        ]);
        Image::make(file_get_contents($imageview))->insert('img/wm.png', 'center')->save($this->imgDir().'/'.$store_name_slug.'.jpg');

        $store->create($request->all());
        flash()->success('success', 'Store Successfully added');
        $data = $request->all();
        unset($data['_token']);
        /*Mail::send('email.addspa', array('data' => $data), function ($message) {
            $message->from('info@spapal.ca', 'StorePal');

            $message->to('info@nuagedesign.ca')->subject('Store Added!');
        });*/
        return redirect()->back();
    }

    public function index()
    {
        $store = Store::With(array('ratings', 'photos' => function($query){
            $query->where('main_img', 1);
            $query->value('path');
        }))->where('closed_down', 0)
           ->paginate(15);

            /*->sortByDesc(function($store)
        {
            return $store->ratings->count();
        });*/
        $store->map(function ($store) {
            $store['rating'] = Rating::select('rating')
                ->where('store_id', $store->id)
                ->orderBy('rating', 'ASC')
                ->groupBy('store_id')
                ->avg('rating');
            $store['ratingAvg'] = ($store['rating'] * 100)/5;
            $store['mainListingImage'] = Photo::where('store_id', $store->id)->where('main_img', 1)->value('path');
            return $store;
        });
        //$json = $store->toJson();

        // ---- Determine user's location
        
        $allCities = array('saint-catharines', 'scarborough', 'vaughan', 'toronto', 'north-york', 'etobicoke', 'mississauga', 'brampton', 'richmond-hill', 'markham', 'ajax', 'barrie', '', 'burlington', 'cambridge', 'guelph', 'hamilton', 'kitchener', 'milton', 'oshawa', 'ottawa', 'pickering', 'vanier', 'welland', 'abbotsford', 'burnaby', 'coquitlam', 'surrey', 'richmond', 'vancouver', 'kelowna', 'calgary', 'london', 'edmonton', 'lethbridge', 'red-deer', 'winnipeg', 'st-johns', 'regina', 'saskatoon', 'longueuil', 'montreal', 'niagara-falls', 'laval');
        
        $location = geoip()->getLocation('99.238.178.223');
        //$location = geoip()->getLocation(geoip()->getClientIP());
        $province = $location['state_name'];
        $city = $location['city'];
        $visitingLocation = '/'.str_slug($province).'/'.str_slug($city);
            
        // $cityCookie = '';
        // $cityCookieTime = '';          
        if (in_array(str_slug($city), $allCities)) {
            # code...
            //setcookie("TestCookie", $cityCookie, time()+3600);  /* expire in 1 hour */
            header('Location: '.$visitingLocation);
        } else {
            return view('store.index', compact('store'));
        }
    }
    public function home(){
        $store = Store::With(array('ratings', 'photos' => function($query){
            $query->where('main_img', 1);
            $query->value('path');
        }))->where('closed_down', 0)
           ->paginate(15);

        $store->map(function ($store) {
            $store['rating'] = Rating::select('rating')
                ->where('store_id', $store->id)
                ->orderBy('rating', 'ASC')
                ->groupBy('store_id')
                ->avg('rating');
            $store['ratingAvg'] = ($store['rating'] * 100)/5;
            $store['mainListingImage'] = Photo::where('store_id', $store->id)->where('main_img', 1)->value('path');
            return $store;
        });
        return view('store.index', compact('store'));
    }

    public function api()
    {
        $store = Store::limit(10)->get();
        //dd($store);
        //$json = $store->toJson();

        return $store;
    }

    // public function index() {
    //     $stores = Store::select('city')->distinct()->pluck('city');
    //     $allCities = array('saint-catharines', 'scarborough', 'vaughan', 'toronto', 'north-york', 'etobicoke', 'mississauga', 'brampton', 'richmond-hill', 'markham', 'ajax', 'barrie', '', 'burlington', 'cambridge', 'guelph', 'hamilton', 'kitchener', 'milton', 'oshawa', 'ottawa', 'pickering', 'vanier', 'welland', 'abbotsford', 'burnaby', 'coquitlam', 'surrey', 'richmond', 'vancouver', 'kelowna', 'calgary', 'london', 'edmonton', 'lethbridge', 'red-deer', 'winnipeg', 'st-johns', 'regina', 'saskatoon', 'longueuil', 'montreal', 'niagara-falls', 'laval');
    // }

    public function addPhoto($store_name, Request $request){
        $this->validate($request, [
            'photo' => 'required|mimes:jpg,jpeg,png,bmp,gif'
        ]);
        $user = Auth::user();
        if (! $this->userManagesStore($request, $store_name)){
            if (! $user->isAdmin()) {
                return $this->unauthorized($request);
            }
        }
        $photo = Photo::fromFile($request->file('photo'), $store_name)->upload($store_name);
        Store::where('store_name_slug', $store_name)->first()->addPhoto($photo, $store_name);
    }
    protected function userManagesStore(Request $request, $store_name){
        $store = Store::where([
            'store_name_slug' => $store_name,
            'managed_by' => $this->user->id
        ])->exists();
        return $store;
    }
    protected function unauthorized(Request $request){
        if ($request->ajax()){
            return response(['message' => 'No way.'], 403);
        }
        flash('You are not the manager of this store');
        return redirect('/');
    }
    public function deletePhoto($id, $store_name){
        $photo = Photo::findOrFail($id);
        $photo->delete();
        $name = $photo->name;
        \File::delete("stores/{$store_name}/$name");
        \File::delete("stores/{$store_name}/tn-$name");

        return back();
    }
    public function show($region_slug, $city_slug, $store_name){
        $rating = new Rating;
        $store = Store::where('store_name_slug', $store_name)->with('ratings')->firstOrFail();
        $store_rating = ($rating->spaRating($store) * 100)/5;
        $rating_count = $rating->ratingCount($store) ;

        $rating_avg = $rating->where('store_id', $store->id)->avg('rating');
        $rating_min = $rating->where('store_id', $store->id)->min('rating');
        $rating_max = $rating->where('store_id', $store->id)->max('rating');

        $storesJson = $store->toJson();

        $mainPhoto = Photo::where('store_id', $store->id)->where('main_img', 1)->value('path');

        return view('store.show', compact('store', 'store_rating', 'rating_count', 'storesJson', 'mainPhoto', 'rating_avg', 'rating_min', 'rating_max'));
    }
    public function showByCity($city_slug, $city){
        $store = Store::With(array('ratings', 'photos' => function($query){
            $query->where('main_img', 1);
            $query->value('path');
        }))->where([['city_slug', $city],['closed_down', 0]])->get()->sortByDesc(function($store)
        {
            return $store->ratings->count();
        })->sortByDesc(function($store)
        {
            return $store->google_rating;
        });
        $store->map(function ($store) {
            $store['rating'] = Rating::select('rating')
                ->where('store_id', $store->id)
                ->orderBy('rating', 'ASC')
                ->groupBy('store_id')
                ->avg('rating');
            $store['ratingAvg'] = ($store['rating'] * 100)/5;
            $store['mainListingImage'] = Photo::where('store_id', $store->id)->where('main_img', 1)->value('path');
            return $store;
        });
        $locations = Store::select('store_name', 'lat', 'lng')->where('city_slug', $city)->get();
        $storeCity = Store::Select('city')->where('city_slug', '=', $city)->value('city');

        return view('store.showbycity', compact('store', 'spaCity', 'locations'));
    }
    public function singleStore($store_name){
        $store = Store::locatedAt($store_name);
        return view('store.singlespa', compact('store'));
    }
    public function edit($id)
    {
        $store = Store::findOrFail($id);
        return view('store.edit', compact('store'));
    }
    public function adminViewUsers(){
        $user = Auth::user();
        $usersAll = User::all();
        if ($user->isAdmin()) {
            return view('auth.viewusers', compact('usersAll'));
        } else {
            flash()->error('Sorry', 'This page is reserved for Admins only');
            return redirect('/');
        }
    }
    public function managerEdit($id)
    {
        $store = Store::findOrFail($id);
        $user = Auth::user();
        if ($user->manages($store) || $user->isAdmin()) {
            return view('store.manager', compact('store'));
        } else {
            flash()->error('Sorry', 'You are not the manager of this store');
            return redirect('/');
        }
    }
    public function managerUpdate(Request $request, $id)
    {
        $store = Store::findOrFail($id);
        $lastUpdated = $store->updated_at->toDateTimeString();
        $timediff = strtotime(Carbon::now()) - strtotime($lastUpdated);

        if ($timediff <= 60) {
            flash()->error('Sorry', 'You can only make updates once a day ');
            return redirect()->back();
        } else {
            $store->update($request->all());
            flash()->success('success', 'Store Successfully Updated');
            return redirect()->back();
        }
    }

    /*public function mailout(){
        $stores = Store::whereNotNull('store_email')->get();
        $stores =  $stores->filter(function ($stores)
        {
            return $stores->store_email != '';
        });
        foreach ($stores as $store) {
            $storelink = 'http://www.spapal.ca/'.$store->region_slug.'/'.$store->city_slug.'/'.$store->store_name_slug;
            $mBody = "Please check out your listing page at 
            '.$storelink.'
            and let us know if you would like to update your store image or if you want to add images to your listing";
            Mail::raw($mBody, function ($message) use ($store) {
                $message->from('info@spapal.ca', 'StorePal');
                $message->to($store->store_email)->subject('We have added your store '.$store->store_name.' as a listing on spapal.ca');
            });
        }
        return view('email.mailout', compact('stores'));
    }*/
    public function update(Request $request, $id)
    {
        /*$this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);*/
        $city = $request->input('city');
        if ($city) {
            $request->request->add([
                'city' => $city,
                'city_slug' => str_slug($city, '-')
            ]);
        }
        Store::findOrFail($id)->update($request->all());
        flash()->success('success', 'Store Successfully Updated');
        return redirect()->back();
    }
    public function searchStore(){
        $storename = Input::get('spaname');
        $store =  Store::where([['store_name', 'LIKE', '%' . $storename . '%'],['closed_down', 0]])->get();

        $store->map(function ($store) {
            $store['rating'] = Rating::select('rating')
                ->where('store_id', $store->id)
                ->orderBy('rating', 'ASC')
                ->groupBy('store_id')
                ->avg('rating');
            $store['ratingAvg'] = ($store['rating'] * 100)/5;
            return $store;
        });
        //die('fdsfsaf');
        return view('results', compact('store', 'spaname'));
    }

    // favorites

    public function favoritePost(Store $store)
    {
        Auth::user()->favorites()->attach($store->id);

        return back();
    }

    public function unFavoritePost(Store $spa)
    {
        Auth::user()->favorites()->detach($spa->id);

        return back();
    }
}
