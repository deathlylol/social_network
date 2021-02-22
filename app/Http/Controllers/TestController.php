<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Routing\Controller;
class TestController extends Controller
{
    public function test()
    {
        //$response = Http::get('http://127.0.0.1:81/api/test');
       $guzzle= new Client([
               'base_uri' => 'http://127.0.0.1:81/api/'
       ]);
       dd($guzzle->request('POST','test'));
    }
}
