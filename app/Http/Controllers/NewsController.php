<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;



class NewsController extends Controller
{
    public function getNews() {
        $user_activation_key = session('user_activation_key');
        if($user_activation_key == null)
        {
            return view('login');
        }
        else
        {
        	// Create a client with a base URI
            $client = new GuzzleHttpClient(); 
        	$response = $client->request('GET', 'http://cb.saostar.vn:3000/news/get/'.$user_activation_key);
        	$news = json_decode($response->getBody()->getContents());
            return view('news')->with('news',$news);
        }
    }

    public function insertNew(){
    	return view('insertnew');
    }
}
