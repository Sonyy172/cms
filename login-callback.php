<?php
require_once __DIR__ . '/phpsdk5/Facebook/autoload.php';
 
session_start();
 
$fb = new Facebook\Facebook([
  'app_id' => '385750371842199',
  'app_secret' => '4907802fbf3e614c611542fced8ad7dc',
  'default_graph_version' => 'v2.4',
  'default_access_token' => '4907802fbf3e614c611542fced8ad7dc'
]);
 
$helper = $fb->getRedirectLoginHelper();
 
try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  //echo 'Graph returned an error: ' . $e->getMessage();
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  //echo 'Facebook SDK returned an error: ' . $e->getMessage();
}
 
if (isset($accessToken)) {
  // Logged in!
  $_SESSION['facebook_access_token'] = (string) $accessToken;
} elseif ($helper->getError()) {
  // The user denied the request
}
header('Location: index.php');