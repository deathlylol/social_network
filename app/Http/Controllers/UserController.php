<?php

namespace App\Http\Controllers;

use App\Models\UploadFile;
use App\Models\User;
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

    public function avatar($id)
    {
        $user = User::query()->findOrFail($id);
        return view('user.uploadAvatar')->with('user', $user);
    }

    public function uploadAvatar(Request $request, $id)
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

    public function imageWall($id)
    {
        $user = User::query()->findOrFail($id);
        return view('user.uploadImageWall')->with('user', $user);
    }
    public function uploadImageWall(Request $request,$id)
    {
        $this->validate($request, [
            'wall_img' => 'required|image|mimes:jpeg,png,jpg'
        ]);
        $user = User::query()->findOrFail($id);

        $wall_file = $request->file('wall_img');
        $wall_name = md5(uniqid($wall_file->getClientOriginalName())) . '.' . $wall_file->extension();
        UploadFile::uploadWallImage($wall_file, $wall_name);

        $user->wall_img = $wall_name;
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

            DB::table('friends')->insert([
                'user_id' => $request->input('friend_id'),
                'friend_id' => Auth::user()->id,
                'accepted' => 0
            ]);
            return response()->json(['message' => 'Запрос отправлен']);
        }
    }

    public function addFriend(Request $request)
    {
        if ($request->ajax()) {
            $this->validate($request, [
                'friend_id' => 'required',
                'accepted' => 'required'
            ]);

            $user_friend = User::query()->findOrFail($request->input('friend_id'));
            $friend_id = $request->input('friend_id');

            Auth::user()->by_user_friends()
                ->wherePivot('accepted', false)
                ->where('friend_id', $friend_id)
                ->first()
                ->pivot
                ->update(['accepted' => true]);

            return $user_friend;
        }
    }

    public function destroy(Request $request)
    {
        if ($request->ajax()){
            $this->validate($request, [
                'friend_id' => 'required',
                'accepted' => 'required'
            ]);
            $friend = User::query()->findOrFail($request->input('friend_id'));
            return Auth::user()->by_user_id()
                ->wherePivot('accepted', true)
                ->orWherePivot('accepted',false)
                ->wherePivot('user_id' , $friend->id)
                ->detach();
        }
    }

    public function createPost(Request $request)
    {
        $this->validate($request,[
           'body' => 'required|string|max:1000'
        ]);

        Auth::user()->posts()->create([
            'body' => $request->input('body')
        ]);

        return redirect()
            ->back()
            ->with('success','добавлен пост');
    }
}
