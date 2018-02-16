<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Rating extends Model
{
    //
    protected $table = 'ratings';
    protected $fillable = [
        /*'store_id',
        'user_id',*/
        'rating',
        'comment'
    ];
    public function storeRating (Store $store)
    {
        return $this->select('store_id')
            ->where('store_id', $store->id)
            ->groupBy('store_id')
            ->avg('rating');
    }
    public function ratingCount (Store $store)
    {
        return $this->select('store_id')
            ->where('store_id', $store->id)
            ->groupBy('store_id')
            ->count('rating');
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
    /*public function ownedByUser(User $user)
    {
        return $this->user_id == $user->id;
    }*/

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
    public function ownedBy(Store $store)
    {
        return $this->id == $store->id;
    }
}
