<?php

namespace App\Http\Controllers;

use App\Photo;
use App\Store;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\AddPhotoRequest;
use Illuminate\Support\Facades\Auth;

class PhotosController extends Controller
{
    //
    // public function store($zip, $street, AddPhotoRequest $request)
    // {
    //     $flyer = Flyer::locatedAt($zip, $street);
    //     $photo = $request->file('photo');

    //     (new AddPhotoToFlyer($flyer, $photo))->save();
    // }
    public function pickMainImage($id)
    {
        $store = Store::findOrFail($id);
        $photos = Photo::where('store_id', $id)->get();
        $user = Auth::user();
        if ($user->manages($store) || $user->isAdmin()) {
            return view('store.mainimage', compact('photos', 'store'));
        } else {
            flash()->error('Sorry', 'You are not the manager of this store');
            return redirect('/');
        }
    }
    public function pickMainImageUpdate(Request $request, $id)
    {
        Photo::where('store_id', $request->store_id)->where('main_img', 1)->update(['main_img' => 0]);
        Photo::where('id', $request->main_img)->update(['main_img' => 1]);

        flash()->success('success', 'Store Image Successfully Updated');
        return redirect()->back();

    }
}

