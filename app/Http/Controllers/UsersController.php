<?php

namespace App\Http\Controllers;

use App\Rating;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    //
    public function FavoriteStores()
    {
        $store = Auth::user()->favorites;

        return view('users.favorites', compact('store'));
    }
    public function myRates()
    {

        $ratings = Rating::with('store')->where('user_id', Auth::id())->get();

        return view('users.ratedstores', compact('ratings'));

    }
}
