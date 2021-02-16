<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SearchController extends Controller
{
    public function getSearchResults(Request $request)
    {
        $query_search = $request->input('search');
        if (!$query_search) {
            redirect()->route('home');
        }

        $users = User::query()
            ->where(DB::raw("CONCAT (first_name,' ',last_name)"), 'like', "%{$query_search}%")
            ->orWhere('username','LIKE',"%{$query_search}%")
            ->get();

        return view('search.results')->with('users', $users);
    }
}
