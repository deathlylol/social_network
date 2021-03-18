<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Posts
 * @package App\Models
 * @property int $user_id
 * @property string $body
 */
class Posts extends Model
{
    use HasFactory;

    public $fillable = [
        'body'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
