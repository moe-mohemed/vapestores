<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $table = 'comments';
    protected $fillable = [
        'store_id',
        'user_id',
        'comment'
    ];
    public function comment (Store $store)
    {
        return $this->select('comment')
                ->where('store_id', $store->id)
                ->groupBy('store_id')
                ->get();
    }
    /*public function ratingCount (Store $store)
    {
        return $this->select('store_id')
                ->where('store_id', $store->id)
                ->groupBy('store_id')
                ->count('rating');
    }*/

    /*   public function ownedByUser(User $user)
       {
           return $this->user_id == $user->id;
       }*/

    public function spa()
    {
        return $this->belongsTo(Store::class);
    }
    public function ownedBy(Store $store)
    {
        return $this->id == $store->id;
    }
}
