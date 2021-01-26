<?php 
/**
 * api: iCupid Dating Software
 * title: Stripe Payment Add-on
 * description: Allows you to use the Stripe payment gateway with your dating site.
 * type: functions
 * category: Payment Gateways
 * author: AdvanDate, LLC
 * url: http://www.stripe.com
 * license: iCupid 11.3
 * config:<var name="Stripe[TS]" type="text" class="t1" value="" title="Test Secret Key" description=""  set="always" /> <var name="Stripe[TP]" type="text" class="t1" value="" title="Test Publishable Key" description="" set="always" /> <var name="Stripe[LS]" type="text" class="t1" value="" title="Live Secret Key" description="" set="always" /> <var name="Stripe[LP]" type="text" class="t1" value="" title="Live Publishable Key" description="" set="always" /> <var name="Stripe[M]" type="text" class="t1" value="" title="Mode" description="Test or Live" set="always" />
 * provides: Stripe
 * hooks: sidebar
 * version: 9.0
 * sort: 10
 * updated: April 5th 2016
 */

///////////////////////////////////////////////////////////////////////////////////////////
// ADMIN AREA FUNCTION
///////////////////////////////////////////////////////////////////////////////////////////
if(defined("A_LANG") && isset($_POST['setting']['Stripe%5BM%5D']) ){ // only display for admin area pages
 
	$data = array();

	$data['Merchant_Name'] 		= "Stripe";
	$data['Merchant_Image'] 	= "http://".$_SERVER['HTTP_HOST']."/images/payment/stripe.gif"; // not used
	$data['Merchant_Method'] 	= "POST"; // POST OR GET
	$data['Merchant_Gateway'] 	= "https://checkout.stripe.com/checkout.js"; // gateway URL, CURL or bank

	$data['test_secret'] = $_POST['setting']['Stripe%5BTS%5D'];
	$data['test_publishable'] = $_POST['setting']['Stripe%5BTP%5D'];
	$data['live_secret'] = $_POST['setting']['Stripe%5BLS%5D'];
	$data['live_publishable'] = $_POST['setting']['Stripe%5BLP%5D'];
	$data['stripe_mode'] = $_POST['setting']['Stripe%5BM%5D'];

	PluginStripe($data);

}

///////////////////////////////////////////////////////////////////////////////////////////
// FUNCTIONS
///////////////////////////////////////////////////////////////////////////////////////////
function PluginStripe($data){

	global $DB;

	// CHECK THIS DOESNT ALREADY EXIST

	$Merchant = $DB->Row("SELECT id FROM merchant WHERE name='".$data['Merchant_Name']."' LIMIT 1");

	if(empty($Merchant)){
	
		$DB->Insert("INSERT INTO `merchant` ( `id` , `name` , `comments` , `active` , action, method, icon) VALUES (NULL , '".$data['Merchant_Name']."', '', 'yes', '".$data['Merchant_Gateway']."', '".$data['Merchant_Method']."', '".$data['Merchant_Image']."')");
		
		$LASTID = $DB->InsertID();
		
		// BASIC DATA
		
		$DB->Insert("INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'test_secret', '".$data['test_secret']."', 'hidden')");
		$DB->Insert("INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'test_publishable', '".$data['test_publishable']."', 'hidden')");
		
		$DB->Insert("INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'live_secret', '".$data['live_secret']."', 'hidden')");
		$DB->Insert("INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'live_publishable', '".$data['live_publishable']."', 'hidden')");

		$DB->Insert("INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'stripe_mode', '".$data['stripe_mode']."', 'hidden')");

		$DB->Insert("INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'name', '(name)', 'hidden')");
		$DB->Insert("INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'custom', '(custom)', 'hidden')");

	}
	else{
	
		//$DB->Insert("INSERT INTO `merchant` ( `id` , `name` , `comments` , `active` , action, method, icon) VALUES (NULL , '".$data['Merchant_Name']."', '', 'yes', '".$data['Merchant_Gateway']."', '".$data['Merchant_Method']."', '".$data['Merchant_Image']."')");
		
		$LASTID = $Merchant['id'];
		
		// BASIC DATA
		
		$DB->Query("UPDATE merchant_data SET value = '".$data['test_secret']."',type = 'hidden' WHERE mid = '".$LASTID."' and name = 'test_secret'");
		$DB->Query("UPDATE merchant_data SET value = '".$data['test_publishable']."',type = 'hidden' WHERE mid = '".$LASTID."' and name = 'test_publishable'");
		$DB->Query("UPDATE merchant_data SET value = '".$data['live_secret']."',type = 'hidden' WHERE mid = '".$LASTID."' and name = 'live_secret'");
		$DB->Query("UPDATE merchant_data SET value = '".$data['live_publishable']."',type = 'hidden' WHERE mid = '".$LASTID."' and name = 'live_publishable'");
		$DB->Query("UPDATE merchant_data SET value = '".$data['stripe_mode']."',type = 'hidden' WHERE mid = '".$LASTID."' and name = 'stripe_mode'");

		

	}

}

?>