<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;

use App\Store;

trait AuthorizesUsers
{
    protected function userManagesStore(Request $request){
        $store = Store::where([
            'id' => $request->id,
            'managed_by' => $this->user->id
        ])->exists();
        dd($store);

    }
    protected function unauthorized(Request $request){
        if ($request->ajax()){
            return response(['message' => 'No way.'], 403);
        }
        flash('nos ways');
        return redirect('/');
    }
}