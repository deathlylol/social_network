<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

/**
 * Class ProfileController
 * @package App\Http\Controllers
 */
class ProfileController extends Controller
{
    use ValidatesRequests;

    /**
     * @param $username
     * показывает профиль пользователя.
     */
    public function index($username)
    {
        $user = User::query()->where('username', '=', $username)->first();

        if (!$user) {
            abort(404);
        }
        return view('profile.index')->with('user',$user);
    }
}
