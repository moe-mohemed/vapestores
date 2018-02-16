<?php

namespace App\Http\Controllers;

use App\Rating;
use Auth;
use App\Store;
use App\Http\Requests\RatingRequest;
use Illuminate\Support\Facades\Mail;

class RatingController extends Controller
{
    //
    public function store(RatingRequest $request)
    {
        //$store = new Store;
        $rating = new Rating;
        $rating->rating = $request->rating;
        $rating->user_id = Auth::user()->id;
        $rating->store_id = $request->store_id;
        $rating->comment = $request->comment;
        $rating->save();

        $store = Store::where('id', $request->store_id)->value('store_name');
        $mBody = "Somebody left a rating for $store \r\n Rating: $request->rating \r\n Comment: $request->comment";
        Mail::raw($mBody, function ($message) use ($store) {
            $message->from('rzarectah88@gmail.com', 'VapeStoreMaps');
            $message->to('rzarectah88@gmail.com')->subject('New rating for '.$store);
        });

        flash()->success('success', 'Thanks for your review');
        return redirect()->back();
    }
}
