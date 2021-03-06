<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

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
    public function index($id)
    {
        $user = User::query()->findOrFail($id);
        $friend_requests =  Auth::user()->friendRequests();
        $friends = $user->friends();
        $posts = $user->posts;

        return view('profile.index',[
            'user' => $user,
            'friend_requests' => $friend_requests,
            'posts' => $posts,
            'friends' => $friends
        ]);
    }

    public function edit($id)
    {
        $user = User::query()->findOrFail($id);

        return view('profile.updateInfo')->with('user',$user);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'location' => 'required|string|max:255',
            'school' => 'required|string|max:255',
            'job' => 'required|string|max:255',
        ]);

        $user = User::query()->findOrFail($id);

        $user->fill($request->all());
        $user->save();

        return redirect()->back()->with('success','Ваши данные были изменены!');
    }
}
