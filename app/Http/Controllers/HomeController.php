<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        if(Auth::check()){
            return view('timeline.index');
        }
        return view('home');
    }

    public function infoWall()
    {
        $posts = Posts::query()->where(function($query){
            return $query->whereIn('user_id', Auth::user()->friends()->pluck('id'));
        })
        ->orderBy('created_at','asc')
        ->paginate(10);

        return view('templates.infowall',[
            'posts' => $posts
        ]);
    }
}
