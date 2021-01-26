<?php
/**
 * api: iCupid Dating Software
 * title: Facebook Like
 * description: This add-on adds a Facebook like button to the footer section of your website 
 * type: functions
 * category: Social Plugins
 * author: AdvanDate, LLC
 * url: http://www.facebook.com/
 * license: iCupid 11.3
 * config:
 * provides: Facebook-Like
 * hooks: sidebar
 * version: 9.0
 * sort: 10
 * updated: August 28th 2016
 * 
 * This plugin allows you to add a Facebook like button to your website quickly
 * and easily from within the plugins section of the dating software admin area.
 */


$PLUGINS_FOOTER = (isset($PLUGINS_FOOTER)) ? $PLUGINS_FOOTER : "";

function FBLike_plugin() {

   global $AddThis;

   return '<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.10&appId=1648534301828873";
  fjs.parentNode.insertBefore(js, fjs);
}(document, "script", "facebook-jssdk"));</script>
<center><div class="fb-like" data-href="" data-layout="button" data-action="like" data-size="large" data-show-faces="true" data-share="true"></div></center>';
}

$PLUGINS_FOOTER .= FBLike_plugin();
	

?>