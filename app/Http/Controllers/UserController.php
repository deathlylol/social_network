<?php

namespace App\Http\Controllers;

use App\Models\UploadFile;
use App\Models\User;
use http\Env\Response;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    use ValidatesRequests;

    public function index($id)
    {
        $user = User::query()->findOrFail($id);
        return view('user.uploadAvatar')->with('user', $user);
    }

    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'avatar' => 'required|image|mimes:jpeg,png,jpg'
        ]);
        $user = User::query()->findOrFail($id);

        $avatar_file = $request->file('avatar');
        $avatar_name = md5(uniqid($avatar_file->getClientOriginalName())) . '.' . $avatar_file->extension();

        UploadFile::uploadAvatar($avatar_file, $avatar_name);

        $user->avatar = $avatar_name;
        $user->save();

        return redirect()->back()->with('success', 'Сохранена');
    }

    public function sendRequestFriend(Request $request)
    {
        if ($request->ajax()) {
            $this->validate($request, [
                'friend_id' => 'required',
                'accepted' => 'required'
            ]);
            $user = User::query()->findOrFail(Auth::user()->id);
            if(Auth::user()->friends())
            {

            }
            if($user->friendRequests()){
                $user->by_user_friends()
                    ->wherePivot('accepted', false)
                    ->where('friend_id', $request->input('friend_id'))
                    ->first()
                    ->pivot
                    ->update(['accepted' => true]);
                return response()->json(['message' => 'Вы теперь друзья'],200);
            }

            DB::table('friends')->insert([
               'user_id' => $request->input('friend_id'),
               'friend_id' => Auth::user()->id,
               'accepted' => 0
            ]);

            return response()->json(['message' => 'вы теперь друзья']);
        }
    }

    public function addFriend(Request $request)
    {
        if ($request->ajax()) {
            $this->validate($request, [
                'user_id' => 'required',
                'friend_id' => 'required',
                'accepted' => 'required'
            ]);

            $user = User::query()->findOrFail($request->input('user_id'));
            $user_friend = User::query()->findOrFail($request->input('friend_id'));

            $friend_id = $request->input('friend_id');

            $user->by_user_friends()
                ->wherePivot('accepted', false)
                ->where('friend_id', $friend_id)
                ->first()
                ->pivot
                ->update(['accepted' => true]);

            return $user_friend;
        }
    }

    public function destroy()
    {

    }
}
