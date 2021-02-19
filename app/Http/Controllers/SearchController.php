<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

/**
 * Class SearchController
 * @package App\Http\Controllers
 */
class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query_search = $request->input('search');
        if (!$query_search) {
            redirect()->route('home');
        }

        $users = User::query()
            ->where(DB::raw("CONCAT (first_name,' ',last_name)"), 'like', "%{$query_search}%")
            ->orWhere('username','LIKE',"%{$query_search}%")
            ->orWhere('first_name','LIKE',"%{$query_search}%")
            ->orWhere('last_name','LIKE',"%{$query_search}%")
            ->get();

        return view('search.results')->with('users', $users);
    }
}
