<?php
require_once __DIR__ . '/phpsdk5/Facebook/autoload.php';
 
session_start();
 
$fb = new Facebook\Facebook([
  'app_id' => '385750371842199',
  'app_secret' => '4907802fbf3e614c611542fced8ad7dc',
  'default_graph_version' => 'v2.4',
  'default_access_token' => isset($_SESSION['facebook_access_token']) ? $_SESSION['facebook_access_token'] : 'APP-ID|APP-SECRET'
]);
  
try {
  $response = $fb->get('/me?fields=id,name');
  $user = $response->getGraphUser();
  echo 'Name: ' . $user['name'];
  exit; //redirect, or do whatever you want
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  //echo 'Graph returned an error: ' . $e->getMessage();
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  //echo 'Facebook SDK returned an error: ' . $e->getMessage();
}
 
$helper = $fb->getRedirectLoginHelper();
$permissions = ['email', 'user_likes'];
$loginUrl = $helper->getLoginUrl('http://cb.saostar.vn/login-callback.php', $permissions);
echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';