<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadFile extends Model
{
    public static function uploadAvatar($file,$avatar_name)
    {
        $file->move(public_path('users_avatar'), $avatar_name);
    }

    public static function uploadWallImage($file,$avatar_name)
    {
        $file->move(public_path('wall'), $avatar_name);
    }
}
