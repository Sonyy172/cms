<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;

class LoginController extends Controller
{
    public function getLogin() {
        $user_activation_key = session('user_activation_key');
        if($user_activation_key == null)
    	    return view('login');
        else
            return redirect()->intended('/broadcast');
    }
    public function postLogin(Request $request) {

    		$username = $request->input('username');
    		$password = $request->input('password');
            $content = null;
            try {
                   $client = new GuzzleHttpClient();
                   $apiRequest = $client->request('POST', 'http://cb.saostar.vn:3000/login', [
                        'form_params' => [  'username' => $username,
                                            'password' => $password
                    ],
                  ]);
         
                  $content = (string) $apiRequest->getBody()->getContents();
              } catch (RequestException $re) {
                  //For handling exception
                  
              }

    		if($content == "False" || $content == null) {
                return redirect()->intended('/');

    		} else 
            {
                session(['user_activation_key' => $content]);
                session(['username' => $username]);
                return redirect()->intended('/news');
    		}
    	
    }
    public function logout()
    {
        try {
                   $client = new GuzzleHttpClient();
                   $apiRequest = $client->request('POST', 'http://cb.saostar.vn:3000/logout', [
                        'form_params' => [  'username' => session('username'),
                                            'user_activation_key' => session('user_activation_key')
                    ],
                  ]);
         
                  $content = (string) $apiRequest->getBody()->getContents();
                  session()->flush();
                  return redirect()->intended('/login');
              } catch (RequestException $re) {
                  //For handling exception
                  
              }
    }
}
