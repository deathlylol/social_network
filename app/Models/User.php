<?php

namespace App\Models;

use App\Traits\UserRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 * @property int $id
 * @property string $username
 * @property string $first_name
 * @property string $last_name
 * @property string $location
 * @property string $email
 * @property string $avatar
 * @property int $password
 * @package App\Models
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable, UserRelations;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'first_name',
        'last_name',
        'location',
        'school',
        'job',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getName()
    {
        if($this->first_name && $this->last_name)
        {
            return "{$this->first_name} {$this->last_name}";
        }

        if($this->first_name)
        {
            return $this->first_name;
        }

        return $this->username;
    }

    public function getAvatar()
    {
        $path = asset('users_avatar'). '/' ;

        if($this->avatar == null || empty($this->avatar)){
            return $path . 'empty-dalbayob.jpg';
        }
        return  $path . $this->avatar;
    }

    public function friendRequests()
    {
        return $this->by_user_friends()->wherePivot('accepted',false)->get();
    }
}
