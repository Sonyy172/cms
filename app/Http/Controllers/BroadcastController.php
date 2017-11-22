<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;
use Carbon\Carbon;
use App\Broadcasts;

class BroadcastController extends Controller
{
    public function getBroadcasts() {
        $user_activation_key = session('user_activation_key');
        if($user_activation_key == null)
        {
            return view('login');
        }
        else
        {
        	// Create a client with a base URI
            $client = new GuzzleHttpClient(); 
        	$response = $client->request('GET', 'http://cb.saostar.vn:3000/broadcast/get/'.$user_activation_key);
        	$broadcasts = json_decode($response->getBody()->getContents());
            
            
            
        	// dd(Carbon::now()->toDateTimeString("DD"));
            // Thu, 23 Nov 2017 14:00:00 GMT
            // dd(Carbon::createFromFormat("D, d M Y H:i:s e","Thu, 23 Nov 2017 14:00:00 GMT"));
            return view('broadcast')->with('broadcasts',$broadcasts);
        }
    }
    public function insertBroadcast(){
    	return view('insertbroadcast');
    }
    public function insertBroadcastNow(){
    	return view('insertbroadcastnow');
    }

    public function postBroadcastMessageNow(Request $request){
    	$user_activation_key = session('user_activation_key');
        if($user_activation_key == null)
        {
            return view('login');
        }
        else
        {
        	// Create a client with a base URI
            $client = new GuzzleHttpClient(); 
        	$message = $request->input('message');
        	$timestamp = Carbon::now()->toDateTimeString();
            $content = null;
            try {
                   $client = new GuzzleHttpClient();
                   $apiRequest = $client->request('POST', 'http://cb.saostar.vn:3000/broadcast/message', [
                        'form_params' => [  'user_activation_key' => $user_activation_key,
                                            'message' => $message,
                                            'timestamp' => $timestamp,
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
            	// Broadcasts::create([
            	// 	'content' => $message,
            	// 	'type' => 'message',
            	// 	'username' => session('username'),
            	// 	'status' => 1,
            	// 	'publish_at' => $timestamp,
            	// ]);
                return redirect()->intended('/broadcast');
    		}
        }
    }
    public function postBroadcastMessage(Request $request){
    	$user_activation_key = session('user_activation_key');
        if($user_activation_key == null)
        {
            return view('login');
        }
        else
        {
        	// Create a client with a base URI
            $client = new GuzzleHttpClient(); 
        	$message = $request->input('message');
			$timestamp = $request->input('timestamp');
        	$date = Carbon::parse($request->input('timestamp'));
            $content = null;
            try {
                   $client = new GuzzleHttpClient();
                   $apiRequest = $client->request('POST', 'http://cb.saostar.vn:3000/broadcast/save_message', [
                        'form_params' => [  'user_activation_key' => $user_activation_key,
                                            'message' => $message,
                                            'timestamp' => $timestamp,
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
            	// Broadcasts::create([
            	// 	'content' => $message,
            	// 	'type' => 'message',
            	// 	'username' => session('username'),
            	// 	'status' => 1,
            	// 	'publish_at' => $timestamp,
            	// ]);
                return redirect()->intended('/broadcast');
    		}
        }
    }
    public function postBroadcastMessageButton(Request $request){
    	$user_activation_key = session('user_activation_key');
        if($user_activation_key == null)
        {
            return view('login');
        }
        else
        {
        	// Create a client with a base URI
            $client = new GuzzleHttpClient(); 
        	$message = $request->input('message');
        	$timestamp = $request->input('timestamp');
            $content = null;
            try {
                   $client = new GuzzleHttpClient();
                   $apiRequest = $client->request('POST', 'http://cb.saostar.vn:3000/broadcast/message_button', [
                        'form_params' => [  'user_activation_key' => $user_activation_key,
                                            'message' => $message,
                                            'timestamp' => $timestamp,
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
                return redirect()->intended('/broadcast');
    		}
        }
    }
}
