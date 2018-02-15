<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'user_role', 'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin(){
        if (Auth::user()->user_role == 2) {
            return true;
        }
    }
    public function isStoreManager(){
        if (Auth::user()->user_role == 3) {
            return true;
        }
    }
    public function manages($relation){
        return $relation->managed_by == $this->id;
    }
    public function managerOfStore(){
        return $this->hasMany('App\Store', 'managed_by');
    }
    public function favorites()
    {
        return $this->belongsToMany(Store::class, 'favorites', 'user_id', 'store_id')->withTimeStamps();
    }
    public function rates()
    {
        return $this->belongsToMany(Store::class, 'rating', 'user_id', 'store_id')->withTimeStamps();
    }
}
