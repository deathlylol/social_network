<?php

namespace App\Http\Controllers;

use App\Models\UploadFile;
use App\Models\User;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class UserController extends Controller
{
    use ValidatesRequests;

    public function UploadAvatar($id)
    {
        $user = User::query()->findOrFail($id);
        return view('user.uploadAvatar')->with('user',$user);
    }

    public function saveAvatar(Request $request,$id)
    {
        $this->validate($request,[
            'avatar' => 'required|image|mimes:jpeg,png,jpg'
        ]);

        $user = User::query()->findOrFail($id);

        $avatar_file = $request->file('avatar');
        $avatar_name = md5(uniqid($avatar_file->getClientOriginalName())) .'.'. $avatar_file->extension();

        UploadFile::uploadAvatar($avatar_file,$avatar_name);

        $user->avatar = $avatar_name;
        $user->save();

        return redirect()->back()->with('success','Сохранена');
    }
}
