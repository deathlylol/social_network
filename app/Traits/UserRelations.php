<?php
namespace App\Traits;


use App\Models\Posts;
use App\Models\User;

trait UserRelations
{
    public function by_friend_id() // получаю друзей,которые делали запрос на дружбу
    {
        return $this->belongsToMany(User::class,'friends','user_id','friend_id');
    }

    public function by_user_id() // получаю user'a к которому кидался запрос на добавление друга
    {
        return $this->belongsToMany(User::class,'friends','friend_id','user_id');
    }

    public function posts()
    {
        return $this->hasMany(Posts::class,'user_id');
    }
}
