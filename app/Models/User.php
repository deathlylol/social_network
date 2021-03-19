<?php

namespace App\Models;

use App\Traits\UserRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

/**
 * Class User
 * @property int $id
 * @property string $username
 * @property string $first_name
 * @property string $last_name
 * @property string $location
 * @property string $email
 * @property string $avatar
 * @property string $wall_img
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

    /**
     * @return string
     * Выводит имя пользователя в зависимости его существующих имён
     */
    public function getName(): string
    {
        if ($this->first_name && $this->last_name) {
            return "{$this->first_name} {$this->last_name}";
        }

        if ($this->first_name) {
            return $this->first_name;
        }

        return $this->username;
    }

    /**
     * @return string
     * Отображает аватар
     */
    public function getAvatar(): string
    {
        $path = asset('users_avatar') . '/';

        if ($this->avatar == null || empty($this->avatar)) {
            return $path . 'empty.jpg';
        }
        return $path . $this->avatar;
    }

    /**
     * @return string
     * отображает изображение стены профиля
     */
    public function getWall(): string
    {
        $path = asset('wall') . '/';

        if ($this->wall_img == null || empty($this->avatar)) {
            return $path . 'noah.jpg';
        }
        return $path . $this->wall_img;
    }

    public function friendRequests()
    {
        return $this->by_friend_id()->wherePivot('accepted', false)->get();
    }

    public function friendRequestsById($id)
    {
        return $this->by_user_id()->wherePivot('accepted', false)->wherePivot('user_id', $id)->first();
    }

    public function canDeleteByFriend($id)
    {
        return $this->by_user_id()->wherePivot('accepted', true)->wherePivot('user_id',$id)->first();
    }

    public function canDeleteByUser($id)
    {
        return $this->by_friend_id()->wherePivot('accepted', true)->wherePivot('friend_id',$id)->first();
    }

    public function friends()
    {
        return $this->by_friend_id()->wherePivot('accepted',true)->get()
            ->merge( $this->by_user_id()->wherePivot('accepted',true)->get() );
    }
}
