<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

/**
 * Class AuthController
 * @package App\Http\Controllers
 */
class AuthController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getSignup()
    {
        return view('auth.signup');
    }

    public function postSignup(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|unique:users|email|string|max:255',
            'username' => 'required|unique:users|string|alpha_dash|max:20',
            'password' => 'required|min:6'
        ]);

        User::create([
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password'))
        ]);

        return redirect()
            ->route('info-wall')
            ->with('success','Авторизуйтесь под своим логином.');
    }

    public function getSignin()
    {
        return view('auth.signin');
    }

    public function postSignin(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|max:20',
            'password' => 'required|min:6'
        ]);
        $user_data = $request->only(['username','password']);

        if (!Auth::attempt($user_data,$request->has('remember')))
        {
            return redirect()->back()->withInput()->with('danger','Неправильный логин или пароль.');
        }
        return redirect()->route('home')->with('success','Вы успешно авторизовались.');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('home');
    }
}
