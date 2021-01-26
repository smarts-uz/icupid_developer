<?php
if(!session_id()){
    session_start();
}

//Include Twitter client library 
include_once 'src/twitteroauth.php';



$consumerKey = TWITTER_SIGNIN_KEY;
$consumerSecret = TWITTER_SIGNIN_SECRET;
$redirectURL = getThePermalink('twitter');
?>