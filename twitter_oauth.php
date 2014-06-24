<?php
require("twitteroauth.php");
session_start();

if(!empty($_GET['oauth_verifier']) && !empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret'])){
   
   // TwitterOAuth instance, with two new parameters we got in twitter_login.php
$twitteroauth = new TwitterOAuth('YOUR_CONSUMER_KEY', 'YOUR_CONSUMER_SECRET', $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
// Let's request the access token
$access_token = $twitteroauth->getAccessToken($_GET['oauth_verifier']);
// Save it in a session var
$_SESSION['access_token'] = $access_token;
// Let's get the user's info
$user_info = $twitteroauth->get('account/verify_credentials');
// Print user's info
print_r($user_info);
echo "<br/>";
echo "Required information below";
echo "<br/>";
echo "User ID: ";
print_r($user_info->id);
echo "<br/>";
echo "Name: ";
print_r($user_info->name);
echo "<br/>";
echo "profile image url: ";
print_r($user_info->profile_image_url);
//print_r($user_info->gender);
//print_r($user_info->email);
} 

else {
    // Something's missing, go back to square 1
    header('Location: twitter_login.php');
}
?>