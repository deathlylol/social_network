<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadFile extends Model
{
    public static function uploadAvatar($avatar_file,$avatar_name)
    {
        $avatar_file->move(public_path('users_avatar'), $avatar_name);
    }
}
