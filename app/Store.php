<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Store extends Model
{
    //
    protected $fillable = [
        'store_name',
        'store_name_slug',
        'store_description',
        'notes',
        'store_address',
        'country',
        'region',
        'city',
        'region_slug',
        'city_slug',
        'store_phone',
        'main_img',
        'store_email',
        'website',
        'store_hours',
        'lat',
        'lng',
        'place_id',
        'atm_machine',
        'parking',
        'established'
    ];
    protected $attributes = [
        'country' => 'Canada'
    ];

    public function photos() {
        return $this->hasMany('App\Photo');
    }
    /*public function comments() {
        return $this->hasMany('App\Comment');
    }*/
    public static function locatedAt($store_name)
    {
        $store_name = str_replace('-', ' ', $store_name);
        return static::where(compact('store_name'))->firstOrFail();
    }
    public function ratings()
    {
        return $this->hasMany('App\Rating')->orderBy('store_id', 'desc');
    }
    public function ratingsCount()
    {
        $ratingcount = $this->ratings()->selectRaw('count(store_id) as rating_count');
        return $ratingcount;
        //return $this->hasMany(Rating::class)->selectRaw('count(store_id) as rating_count');
        /*->groupBy('store_id')
        ->avg('rating');*/
    }
    public function getRealRating(){
        //return $this->ratings()->selectRaw('AVG(rating) as rating');
        //return $realrating;
        return $this->ratings()->select('rating')
            ->groupBy('store_id')
            ->avg('rating');
        //$rating = $this->ratings()->
    }
    public function addPhoto(Photo $photo){
        return $this->photos()->save($photo);
    }
    public function hasRated()
    {
       $userid = Auth::user()->id;
       return $this->ratings()->where('user_id', '=', $userid)->count() > 0;
       //return $rated;
    }

    public function searchName($storename){
        return Store::where('store_name', 'LIKE', $storename);
    }

    public function parent()
    {
        return $this->belongsTo(static::class, 'region');
    }

    public function children()
    {
        return $this->hasMany(static::class, 'city');
    }
    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function manager(){
        return $this->belongsTo('App\User', 'managed_by');
    }
    public function managedBy(User $user)
    {
        return $this->managed_by == $user->id;
    }

    // favorite

    public function favorited()
    {
        return (bool) Favorite::where('user_id', Auth::id())
            ->where('store_id', $this->id)
            ->first();
    }

    /*public function manager(User $user, Store $store)
    {
         // If user is administrator, then can edit any post
        //if ($user->isModerator()) {
        //    return true;
        //}

        // Check if user is the post author
        if ($user->id === $store->managed_by) {
            return true;
        }

        return false;
    }*/
}

