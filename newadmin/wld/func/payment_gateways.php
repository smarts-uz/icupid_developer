<?
// no direct access
defined( 'KEY_ID' ) or die( 'Restricted access' );


function WLDSaferpay($data,$market_id){

	$dbh = getMarketDBConnection($market_id);
	
	
	$stmt = $dbh->prepare("INSERT INTO `merchant` ( `id` , `name` , `comments` , `active` , action, method, icon) VALUES (NULL , 'Saferpay', '', 'yes', 'CURL', 'POST', 'http://".$_SERVER['HTTP_HOST']."/images/payment/moneybookers.gif')");
	
	$stmt->execute();

	$LASTID = $dbh->lastInsertId();

	// CUSTOM DATA
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'account_id', '".$data['email9']."', 'hidden')");
	
}

function WLDBank($data,$market_id){

	$dbh = getMarketDBConnection($market_id);
	
	$stmt = $dbh->prepare("INSERT INTO `merchant` ( `id` , `name` , `comments` , `active` , action, method, icon) VALUES (NULL , 'Bank / Wire Transfer', '', 'yes', 'bank', 'POST', '')");
	$stmt->execute();
	
	$LASTID = $dbh->lastInsertId();

	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'Beneficiary', '".$data['b1']."', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'Bank Name', '".$data['b2']."', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'SWIFT Addr', '".$data['b3']."', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'BLZ', '".$data['b4']."', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'IBAN Number', '".$data['b5']."', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'Account Number', '".$data['b6']."', 'hidden')");

}

function WLDAddMoneyBookers($data,$market_id){

	$dbh = getMarketDBConnection($market_id);
	
	$stmt = $dbh->prepare("INSERT INTO `merchant` ( `id` , `name` , `comments` , `active` , action, method, icon) VALUES (NULL , 'MoneyBookers', '', 'yes', 'https://www.moneybookers.com/app/payment.pl', 'POST', 'http://".$_SERVER['HTTP_HOST']."/images/payment/moneybookers.gif')");
	
	$stmt->execute();

	$LASTID = $dbh->lastInsertId();

	// CUSTOM DATA
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'pay_to_email', '".$data['email9']."', 'hidden')");
	
	// BASIC DATA
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'amount', '(amount)', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'recipient_description', '(name)', 'hidden')");
	
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'notify_url', 'http://".$_SERVER['HTTP_HOST']."/index.php?dll=order&sub=thankyou', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'cancel_url', 'http://".$_SERVER['HTTP_HOST']."/index.php?dll=order&sub=cancel', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'return_url', 'http://".$_SERVER['HTTP_HOST']."/index.php?dll=order&sub=thankyou', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'currency', 'USD', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'language', 'EN', 'hidden')");
	
	## CUSTOM FIELD	
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'merchant_fields', 'custom', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'custom', '(custom)', 'hidden')");
	
	## PRODUCT FIELDS
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'detail1_description', '(name)', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'detail1_text', '(custom)', 'hidden')");

}

function WLDAddCCBill($data,$market_id){

	$dbh = getMarketDBConnection($market_id);
	
	$stmt = $dbh->prepare("INSERT INTO `merchant` ( `id` , `name` , `comments` , `active` , action, method, icon) VALUES (NULL , 'CCBill', '', 'yes', 'https://bill.ccbill.com/jpost/signup.cgi', 'POST', 'http://".$_SERVER['HTTP_HOST']."/images/payment/ccbill.gif')");
	
	$stmt->execute();
	$LASTID = $dbh->lastInsertId();

	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'clientAccnum', '".$data['accNo']."', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'clientSubacc', '".$data['subNo']."', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'formName', '(name)', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'custom', '(custom)', 'hidden')");

}

function WLDAddGoogleCheckout($data,$market_id){

	$dbh = getMarketDBConnection($market_id);
	
	$stmt = $dbh->prepare("INSERT INTO `merchant` ( `id` , `name` , `comments` , `active` , action, method, icon) VALUES (NULL , 'GoogleCheckout', '', 'yes', 'https://checkout.google.com/api/checkout/v2/checkoutForm/Merchant/".$data['email13']."', 'POST', 'http://".$_SERVER['HTTP_HOST']."/images/payment/google.gif')");
	
	$stmt->execute();
	
	$LASTID = $dbh->lastInsertId();

	## CUSTOM FIELD		
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'item_selection_1', '1', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'amount', '(amount)', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'item_option_name_1', '(name)', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'item_option_description_1', '(name)', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'item_option_quantity_1', '1', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'item_option_price_1', '(amount)', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'item_option_currency_1', 'USD', 'hidden')");
	
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', '_charset_', 'utf-8', 'hidden')");

}

function WLDAddPayPal($data,$market_id){

	$dbh = getMarketDBConnection($market_id);
	
	$stmt = $dbh->prepare("INSERT INTO `merchant` ( `id` , `name` , `comments` , `active` , action, method, icon)VALUES (NULL , 'PayPal', '', 'yes', 'https://www.paypal.com/cgi-bin/webscr', 'POST', 'http://".$_SERVER['HTTP_HOST']."/images/payment/paypal.gif')");
	
	$stmt->execute();
	$LASTID = $dbh->lastInsertId();
	
	// CUSTOM DATA
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'business', '".$data['email']."', 'hidden')");
	
	// BASIC DATA
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'amount', '(amount)', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'item_name', '(name)', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'custom', '(custom)', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'notify_url', 'index.php?dll=order&sub=thankyou', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'cancel_return', 'index.php?dll=order&sub=cancel', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'return', 'index.php?dll=order&sub=thankyou', 'hidden')");
	
	// PAYPAL EXTRA
	//getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'cmd', '_xclick', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'no_shipping', '1', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'src', '1', 'hidden')");
}

function WLDAddNoChecx($data,$market_id){

	$dbh = getMarketDBConnection($market_id);
	
	$stmt = $dbh->prepare("INSERT INTO `merchant` ( `id` , `name` , `comments` , `active` , action, method, icon)VALUES (NULL , 'NOCHEX', '', 'yes', 'https://www.nochex.com/nochex.dll/checkout', 'POST', 'http://".$_SERVER['HTTP_HOST']."/images/payment/nochex.gif')");
	
	$stmt->execute();
	$LASTID = $dbh->lastInsertId();
	
	// CUSTOM DATA
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'email', '".$data['email']."', 'hidden')");
	
	// BASIC DATA
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'amount', '(amount)', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'description', '(name)', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'custom', '(custom)', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'responderurl', 'http://".$_SERVER['HTTP_HOST']."/index.php?dll=order&sub=thankyou', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'cancelurl', 'http://".$_SERVER['HTTP_HOST']."/index.php?dll=order&sub=cancel', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'returnurl', 'http://".$_SERVER['HTTP_HOST']."/index.php?dll=order&sub=thankyou', 'hidden')");
	
}

function WLDTwoCheckout($data,$market_id){

	$dbh = getMarketDBConnection($market_id);
	
	$stmt = $dbh->prepare("INSERT INTO `merchant` ( `id` , `name` , `comments` , `active` , action, method, icon)VALUES (NULL , '2Checkout', '', 'yes', 'https://www2.2checkout.com/2co/buyer/purchase', 'POST', 'http://".$_SERVER['HTTP_HOST']."/images/payment/2checkout.gif')");
	
	$stmt->execute();
	$LASTID = $dbh->lastInsertId();
	
	// CUSTOM DATA
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'sid', '".$data['email']."', 'hidden')");
	
	// BASIC DATA
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'total', '(amount)', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'cart_id', '(custom)', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'x_receipt_link_url', 'http://".$_SERVER['HTTP_HOST']."/index.php?dll=order&sub=thankyou', 'hidden')");

	// 2CHECKOUT EXTRA
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'cart_order_id', '1', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'quantity', '1', 'hidden')");	
}

function WLDAddEgold($data,$market_id){

	$dbh = getMarketDBConnection($market_id);
	
	$stmt = $dbh->prepare("INSERT INTO `merchant` ( `id` , `name` , `comments` , `active` , action, method, icon)VALUES (NULL , 'EGOLD', '', 'yes', 'https://www.e-gold.com/sci_asp/payments.asp', 'POST', 'http://".$_SERVER['HTTP_HOST']."/images/payment/e_gold.gif')");
	
	$stmt->execute();
	$LASTID = $dbh->lastInsertId();
	
	// CUSTOM DATA
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'PAYEE_ACCOUNT', '".$data['email']."', 'hidden')");
	
	// BASIC DATA
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'PAYMENT_AMOUNT', '(amount)', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'PAYEE_NAME', '(name)', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'CUST_NUM', '(custom)', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'STATUS_URL', 'http://".$_SERVER['HTTP_HOST']."/index.php?dll=order&sub=thankyou', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'NOPAYMENT_URL', 'http://".$_SERVER['HTTP_HOST']."/index.php?dll=order&sub=cancel', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'PAYMENT_URL', 'http://".$_SERVER['HTTP_HOST']."/index.php?dll=order&sub=thankyou', 'hidden')");
	
	// EGOLD EXTRA
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'PAYMENT_UNITS', '1', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'PAYMENT_METAL_ID', '1', 'hidden')");	
}


function WLDAddAlertPay($data,$market_id){

	$dbh = getMarketDBConnection($market_id);
	
	$stmt = $dbh->prepare("INSERT INTO `merchant` ( `id` , `name` , `comments` , `active` , action, method, icon)VALUES (NULL , 'AlertPay', '', 'yes', 'https://www.alertpay.com/PayProcess.aspx', 'POST', 'http://".$_SERVER['HTTP_HOST']."/images/payment/header_01.gif')");
	
	$stmt->execute();
	$LASTID = $dbh->lastInsertId();
	
	// CUSTOM DATA
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'ap_merchant', '".$data['email']."', 'hidden')");
	
	// BASIC DATA
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'ap_amount', '(amount)', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'ap_itemname', '(name)', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'ap_description', '(name)', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'ap_cancelurl', 'http://".$_SERVER['HTTP_HOST']."/index.php?dll=order&sub=cancel', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'ap_returnurl', 'http://".$_SERVER['HTTP_HOST']."/index.php?dll=order&sub=thankyou', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'ap_itemcode', '(custom)', 'hidden')");
	// ALERTPAY EXTRA
	//getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'ap_purchasetype', 'service', 'hidden')");	
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'ap_quantity', '1', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'ap_currency', 'USD', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'ap_test', '0', 'hidden')");
		
}

function WLDAddPayMate($data,$market_id){

	$dbh = getMarketDBConnection($market_id);
	
	$stmt = $dbh->prepare("INSERT INTO `merchant` ( `id` , `name` , `comments` , `active` , action, method, icon)VALUES (NULL , 'PayMate', '', 'yes', 'http://www.paymate.com.au/cart/cart.html', 'POST', 'http://".$_SERVER['HTTP_HOST']."/images/payment/logo.gif')");
	
	$stmt->execute();	
	$LASTID = $dbh->lastInsertId();
	
	// CUSTOM DATA
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'mid', '".$data['email']."', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'ref', '(custom)', 'hidden')");
	
	// BASIC DATA
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'amt', '(amount)', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'pmt_item_name', '(name)', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'return', 'http://".$_SERVER['HTTP_HOST']."/index.php?dll=order&sub=thankyou', 'hidden')");
	
	// ALERTPAY EXTRA
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'add', '1', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'currency', 'USD', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'shipping', '0.00', 'hidden')");
	
}

function WLDAddWorldPay($data,$market_id){

	$dbh = getMarketDBConnection($market_id);
	
	$stmt = $dbh->prepare("INSERT INTO `merchant` ( `id` , `name` , `comments` , `active` , action, method, icon)VALUES (NULL , 'World Pay', '', 'yes', 'https://select.worldpay.com/wcc/purchase', 'POST', 'http://".$_SERVER['HTTP_HOST']."/images/payment/world_pay.gif')");
	
	$stmt->execute();
	$LASTID = $dbh->lastInsertId();
	
	// CUSTOM DATA
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'instId', '".$data['email']."', 'hidden')");
	
	// BASIC DATA
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'amount', '(amount)', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'desc', '(name)', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'cartId', '(custom)', 'hidden')");
	// WORLDPAY EXTRA
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'currency', 'USD', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'testMode', '0', 'hidden')");

	
}

function WLDAddAuthorize($data,$market_id){

	$dbh = getMarketDBConnection($market_id);
	
	$stmt = $dbh->prepare("INSERT INTO `merchant` ( `id` , `name` , `comments` , `active` , action, method, icon)VALUES (NULL , 'Authorize.net', '', 'yes', 'https://secure.authorize.net/gateway/transact.dll', 'POST', 'http://".$_SERVER['HTTP_HOST']."/images/payment/authorize_net.gif')");
	
	$stmt->execute();

	$LASTID = $dbh->lastInsertId();
	
	// CUSTOM DATA
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'x_login', '".$data['email']."', 'hidden')");
	
	// BASIC DATA
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'x_amount', '(amount)', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'x_description', '(name)', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'x_cust_ID', '(custom)', 'hidden')");
	// .NET EXTRA
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'x_show_form', 'PAYMENT_FORM', 'hidden')");
	
	
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'x_fp_sequence', '(sequence)', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'x_fp_timestamp', '(time)', 'hidden')");
	getMarketQueryUpdate($dbh,"INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$LASTID."', 'x_fp_hash', '(fingerprint)', 'hidden')");
	
}
function WLDhmac ($key, $data)
{
return (bin2hex (@mhash(MHASH_MD5, $data, $key)));
}
function WLDCalculateFP ($loginid, $x_tran_key, $amount, $sequence, $tstamp, $currency = "")
{
	return (hmac ($x_tran_key, $loginid . "^" . $sequence . "^" . $tstamp . "^" . $amount . "^" . $currency));
}

?>