<?php
namespace App\Traits;


use App\Models\User;

trait UserRelations
{
    public function by_user_friends()
    {
        return $this->belongsToMany(User::class,'friends','user_id','friend_id');
    }

    public function by_friend_friends()
    {
        return $this->belongsToMany(User::class,'friends','friend_id','user_id');
    }

    public function friends()
    {
        return $this->by_user_friends()->wherePivot('accepted',true)->get()
            ->merge( $this->by_friend_friends()->wherePivot('accepted',true)->get() );
    }
}
