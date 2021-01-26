<?php
/**
* api: iCupid Dating Software
* title: Google Analytics
* description: Add google analytics to your website.
* type: functions
* category: Google Add-on
* author: AdvanDate, LLC
* url: http://www.google.com/analytics/
* license: iCupid 11.3
* config:<var name="Google_Analytics[Code]" type="text" class="t1" value="0" title="Analytics Account ID" description="Enter your Google analytics Account ID in the space provided. This can be found in your google ( Edit Account and Data Sharing Settings ) page." set="always" />
* provides: Google
* hooks: sidebar
* version: 9.0
* sort: 10
* updated: April 5th 2016
* 
* This plugin allows you to add google analytics code to your website quickly
* and easily from within the plugins section of the dating software admin area.
*/
 
$HEADER_ANALYTICS = "";

function Google_Analytics_plugin($gacode="") {

   	global $Google_Analytics;

   	if($gacode != ""){
   		return "<script type=\"text/javascript\">
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  		ga('create', '".$gacode."', 'auto');
  		ga('send', 'pageview'); </script>";
	
	}
	else{
		return;
	}
	
}


if(isset($Google_Analytics["Code"]) && $Google_Analytics["Code"] !=""){

	$HEADER_ANALYTICS = Google_Analytics_plugin($Google_Analytics["Code"]);
	
}
?>