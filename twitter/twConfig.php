<?php
if(!session_id()){
    session_start();
}

//Include Twitter client library 
include_once 'src/twitteroauth.php';

/*
 * Configuration and setup Twitter API
 */
$consumerKey = TWITTER_SIGNIN_KEY;
$consumerSecret = TWITTER_SIGNIN_SECRET;
$redirectURL = getThePermalink('twitterlogin');

?>