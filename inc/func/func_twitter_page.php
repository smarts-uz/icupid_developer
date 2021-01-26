<?php 

// no direct access
defined( 'KEY_ID' ) or die( 'Restricted access' );

require_once ($_SERVER['DOCUMENT_ROOT'].'/twitter/twConfig.php');

function GetTwitterLoginButton(){
	$twClient = new TwitterOAuth(TWITTER_SIGNIN_KEY, TWITTER_SIGNIN_SECRET);
	
	$redirectURL = getThePermalink('twitter');
	
	$request_token = $twClient->getRequestToken($redirectURL);
	
	//Received token info from twitter

	unset($_SESSION['token']);
	unset($_SESSION['token_secret']);
	$_SESSION['token']		 = $request_token['oauth_token'];
	$_SESSION['token_secret']= $request_token['oauth_token_secret'];
	
	//If authentication returns success
	if($twClient->http_code == '200'){
		//Get twitter oauth url
		$authUrl = $twClient->getAuthorizeURL($request_token['oauth_token']);
		
		//Display twitter login button
		$output = '<a href="'.filter_var($authUrl, FILTER_SANITIZE_URL).'"><img src="'.DB_DOMAIN.'images/twitter-login.jpg"/></a>';
	}

	return $output;
}
?>