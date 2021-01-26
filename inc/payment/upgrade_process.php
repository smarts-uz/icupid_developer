<?

/***************************************************************************
 *
 *	 PROJECT: iCupid Dating Software
 *	 VERSION: 8
 *	 LISENSE: OWN / LEASED (http://www.advandate.com/license.php)
 *
 *	 This program is a commercial software product and any kind of usage
 *	 means agreement to the eMeeting software License Agreement.
 *
 *	 This notice MUST NOT be removed from the code.   
 *
 *   Copyright 2008-2009 AdvanDate, Ltd.
 *   http://www.advandate.com/
 *
***************************************************************************/


## connect to the database
$subd = "../../"; require_once $subd . "inc/config.php";



## make sure package id is selected

if(!isset($_POST['PackageUpID']) || $_POST['PackageUpID'] ==""){

	$pack = $DB->Row("SELECT pid FROM package WHERE visible='1' and type='custom' LIMIT 1");	
	$_POST['PackageUpID'] = $pack['pid'];

}


## if its bank lets redirect them to the bank page or check for CURL payments
if(isset($_POST['payid'])){

	$bank = $DB->Row("SELECT id, action, name FROM merchant WHERE id=".$_POST['payid']." limit 1");

	if($bank['action'] =="bank"){

		header("location: ../../index.php?dll=subscribe&sub=bank&packageid=".$_POST['PackageUpID']);

	}elseif($bank['action'] =="CURL"){

		## THIS PAYMENT MUST BE DONE VIA CURL, SO LETS DO THIS
		switch($bank['name']){

			case "Saferpay": { 

				## get array of data 
				$result=$DB->Row("SELECT value FROM merchant_data WHERE name='account_id' AND mid=".$bank['id']);

				$pak = $DB->Row("SELECT price, name, numdays,subscription FROM package WHERE pid=".$_POST['PackageUpID']." LIMIT 1");				

				$CustomData = htmlentities($_SESSION['uid']."**".$_POST['PackageUpID']);

				$accountid = trim($result['value']); 	// the saferpay account id (for testing: the Saferpay testaccount-id)

				$orderid = $CustomData; 			// order or basket identifier (unique, dynamically defined from your shop)

				$amount = trim(str_replace(".","",$pak['price'])); 			// the total amount for this payment (calculated from your shop)

				$currency = "EUR"; 			// the currency for this payment (defined from your shop)

				// * DESCRIPTION - attribute has to be html-encoded to verify html-conformity of this info-text

				$description = htmlentities($pak['name']); 			

				$successlink = DB_DOMAIN."index.php?dll=order&sub=thankyou&returnSaferpay=1&SaferUid=".$CustomData; // return URL if payment successful

				$faillink = DB_DOMAIN . "order/cancel";	// return URL if payment failed

				$backlink = DB_DOMAIN . "order/cancel";	// return URL if user cancelled the payment 

				include("saferpay/start.php");
				header("location: ".$payment_url);
				die();

			} break;
		}
	}
}

############################################################
#################### OPERATIONS ############################
############################################################

?>

<html>
	<head>
		<title>Please Wait</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	</head>
	<body onLoad="document.PAY.submit()">
	<?

	$formdata = "";

	if(!isset($_POST['payid'])){

		$top = $DB->Query("SELECT id, action, method, name, icon, comments FROM merchant limit 1");

	}else{

		$top = $DB->Query("SELECT id, action, method, name, icon, comments FROM merchant WHERE id=".$_POST['payid']." limit 1");

	}

	while( $code = $DB->NextRow($top) ){

			if($code['name'] == '2Checkout'){

				require_once($_SERVER['DOCUMENT_ROOT']."/plugins/plugins/2checkout-php/lib/Twocheckout.php");

				Twocheckout::verifySSL(true);  // this is set to true by default

				// To use your sandbox account set sandbox to true
				// Twocheckout::sandbox(true);

				$result = $DB->Query("SELECT * FROM merchant_data WHERE mid=".$code['id']);

				$params = array();


				while( $hidden = $DB->NextRow($result) ){

					$params[$hidden['name']] = $hidden['value'];				

				}

				if($_POST['PackageUpID'] == 'credits'){
					$pak = $DB->Row("SELECT price, name, maxMessage,currency_code FROM credits WHERE cid='1' LIMIT 1");
					
					$CustomData = $_SESSION['uid']."**".$_POST['PackageUpID']."**credits";
					$params['total'] = 	$pak['price'];
					$params['cart_id'] = $CustomData;
				}
				else{
					$pak = $DB->Row("SELECT price, name, numdays,subscription,currency_code, icon FROM package WHERE pid=".$_POST['PackageUpID']." LIMIT 1");	
					

					$CustomData = $_SESSION['uid']."**".$_POST['PackageUpID'];
					$params['total'] = 	$pak['price'];
					$params['cart_id'] = $CustomData;
				}
					
				Twocheckout_Charge::form($params, 'auto');

			}
			else{
			$result = $DB->Query("SELECT * FROM merchant_data WHERE mid=".$code['id']);

			print "<form method='".$code['method']."' action='".$code['action']."' name='PAY'>\n";

			

				//////////////////////////////////////////

				// DISPLAY PACKAGE INFORMATION (PRICE ETC)

				//////////////////////////////////////////			

								

					while( $hidden = $DB->NextRow($result) ){

							

							$formdata .= "<input type='".$hidden['type']."' value='".$hidden['value']."' name='".$hidden['name']."' class='hidden'>\n\n";				

					

					}

					

				

				if(isset($_POST['smscredits'])){

				

					$pak['price'] = SMS_PRICE*$_POST['credits'];

					$pak['name'] = "SMS Credits";

					$pak['numdays'] = "1";

					$CustomData = $_SESSION['uid']."**sms--".$_POST['credits'];

					

					$formdata .= "<input type='hidden' value='(amount)' name='".$hidden['name']."' class='hidden'>\n\n";

					$formdata .= "<input type='hidden' value='(name)' name='".$hidden['name']."' class='hidden'>\n\n";

					$formdata .= "<input type='hidden' value='(period)' name='".$hidden['name']."' class='hidden'>\n\n";

				

				}elseif(isset($_POST['featured'])){

				

					$pak['price'] = $_POST['price'];

					$pak['name'] = "Featured Member";

					$pak['numdays'] = "1";

					$CustomData = $_SESSION['uid']."**featured";

					

					$formdata .= "<input type='hidden' value='(amount)' name='".$hidden['name']."' class='hidden'>\n\n";

					$formdata .= "<input type='hidden' value='(name)' name='".$hidden['name']."' class='hidden'>\n\n";

					$formdata .= "<input type='hidden' value='(period)' name='".$hidden['name']."' class='hidden'>\n\n";



				}elseif(isset($_POST['highlight'])){

				

					$pak['price'] = $_POST['price'];

					$pak['name'] = "Highlight Profile";

					$pak['numdays'] = "1";

					$CustomData = $_SESSION['uid']."**highlight";

					

					$formdata .= "<input type='hidden' value='(amount)' name='".$hidden['name']."' class='hidden'>\n\n";

					$formdata .= "<input type='hidden' value='(name)' name='".$hidden['name']."' class='hidden'>\n\n";

					$formdata .= "<input type='hidden' value='(period)' name='".$hidden['name']."' class='hidden'>\n\n";

													

				}elseif(isset($_POST['PackageUpID'])){

					if($_POST['PackageUpID'] == 'credits'){
						$pak = $DB->Row("SELECT price, name, maxMessage,currency_code FROM credits WHERE cid='1' LIMIT 1");
					
						$CustomData = $_SESSION['uid']."**".$_POST['PackageUpID']."**credits";
					}
					else{
						$pak = $DB->Row("SELECT price, name, numdays,subscription,currency_code, icon FROM package WHERE pid=".$_POST['PackageUpID']." LIMIT 1");	
					
						$CustomData = $_SESSION['uid']."**".$_POST['PackageUpID'];
					}

					

				}

				

				

				///////////////////////////////////////////////////////////////////////

				/////////////////		  SUBSCRIPTION PERIOD  		//////////////////

				///////////////////////////////////////////////////////////////////////

				

				if(isset($pak['subscription']) && $pak['subscription'] =="yes" && $pak['numdays'] !='2147483647' && $pak['icon'] !="SMS" ){

				  // WORK OUT TIME PERIOD

				  // DAYS / WEEKS / MONTHS /  YEARS

				  

						  if($pak['numdays'] < 8){

						  

						  	  if($code['name'] =="PayPal"){ 

							  

							  print '<input type="hidden" name="a3" value="'.$pak['price'].'">';		

							  print '<input type="hidden" name="p3" value="'.$pak['numdays'].'">';	
							  
							  print '<input type="hidden" name="currency_code" value="'.$pak['currency_code'].'">';	

							  print '<input type="hidden" name="t3" value="D">';

							  print '<input type="hidden" name="src" value="1">';

							  print '<input type="hidden" name="sra" value="1">';

							  print '<input type="hidden" name="cmd" value="_xclick-subscriptions">'; 

							  }elseif(	$code['name'] =="AlertPay"){ 

							  

							   print '<input type="hidden" name="ap_timeunit" value="day"/>'; 

							   print '<input type="hidden" name="ap_periodlength" value="'.$pak['numdays'].'"/>' ;

							   print '<input type="hidden" name="ap_purchasetype" value="subscription"/>'; 

							  

							  }			  

						 

						  }elseif($pak['numdays'] < 30){

							  

							  // MAX 4 WEEKS

							  $numweeks = $pak['numdays']/7;

							  

							  if($code['name'] =="PayPal"){							  

							  	print '<input type="hidden" name="a3" value="'.$pak['price'].'">';		
								print '<input type="hidden" name="p3" value="'.$numweeks.'">';	
							  	print '<input type="hidden" name="currency_code" value="'.$pak['currency_code'].'">';	
							  	print '<input type="hidden" name="t3" value="W">';
							  	print '<input type="hidden" name="src" value="1">';
							  	print '<input type="hidden" name="sra" value="1">';
							  	print '<input type="hidden" name="cmd" value="_xclick-subscriptions">';

							  }
							  elseif($code['name'] == "Requitix"){

							  	print '<input type="hidden" name="cmd" value="_xclick">';
							  	print '<input type="hidden" name="currency_code" value="'.$pak['currency_code'].'">';	
							   	print '<input type="hidden" name="a3" value="'.$pak['price'].'">';
								print '<input type="hidden" name="packageid" value="'.$_POST['PackageUpID'].'">';

							  }
							  elseif(	$code['name'] =="AlertPay"){ 

							   print '<input type="hidden" name="ap_timeunit" value="week"/>'; 
							   print '<input type="hidden" name="ap_periodlength" value="'.$numweeks.'"/>';
							   print '<input type="hidden" name="ap_purchasetype" value="subscription"/>'; 

							  }				  

						  

						  	}elseif($pak['numdays'] < 370){

							  $nummonths = $pak['numdays']/30;
							  if($code['name'] =="PayPal"){

							  	// MAX 4 WEEKS							  
							  	print '<input type="hidden" name="a3" value="'.$pak['price'].'">';		
							  	print '<input type="hidden" name="p3" value="'.$nummonths.'">';	
							   	print '<input type="hidden" name="currency_code" value="'.$pak['currency_code'].'">';	
							  	print '<input type="hidden" name="t3" value="M">';
							  	print '<input type="hidden" name="src" value="1">';
							  	print '<input type="hidden" name="sra" value="1">';
							  	print '<input type="hidden" name="cmd" value="_xclick-subscriptions">';

							  }elseif(	$code['name'] =="AlertPay"){ 

							   	print '<input type="hidden" name="ap_timeunit" value="month"/>'; 
							   	print '<input type="hidden" name="ap_periodlength" value="'.$nummonths.'"/>';
							   	print '<input type="hidden" name="ap_purchasetype" value="subscription"/>'; 

							  }
						  }

				}else{

					// SINGLE PAYMENT, NOT A SUBSCRIPTION

					if($code['name'] =="PayPal"){

						print '<input type="hidden" name="cmd" value="_xclick">';

						print '<input type="hidden" name="currency_code" value="'.$pak['currency_code'].'">';	

					}
					elseif($code['name'] == "Requitix"){

					  	print '<input type="hidden" name="cmd" value="_xclick">';
					  	print '<input type="hidden" name="currency_code" value="'.$pak['currency_code'].'">';	
						print '<input type="hidden" name="a3" value="'.$pak['price'].'">';
						print '<input type="hidden" name="packageid" value="'.$_POST['PackageUpID'].'">';

					}
					elseif(	$code['name'] =="AlertPay"){ 

						print '<input type="hidden" name="ap_purchasetype" value="service"/>';

					}	

				}

				$tstamp = time ();

				$formdata = str_replace("(time)", $tstamp, $formdata);

				$formdata = str_replace("(amount)", $pak['price'], $formdata);

				$formdata = str_replace("(name)", $pak['name'], $formdata);

				if(isset($pak['numdays'])){
					$formdata = str_replace("(period)", $pak['numdays'], $formdata);
				}
				
				$formdata = str_replace("(custom)", $CustomData, $formdata);

				if($code['name'] =="Authorize.net"){

					// create figure print for authoize.net

					$loginID		= "xxxxxx";
					$transactionKey = "xxxxxx";
					$sequence	= rand(1, 1000);
					$timeStamp	= time ();
				

					if( phpversion() >= '5.1.2' ) {
						$fingerprint = hash_hmac("md5", $loginID . "^" . $sequence . "^" . $timeStamp . "^" . $pak['price'] . "^", $transactionKey);
					}
					else { 
						$fingerprint = bin2hex(mhash(MHASH_MD5, $loginID . "^" . $sequence . "^" . $timeStamp . "^" . $pak['price'] . "^", $transactionKey)); 
					}

					$formdata = str_replace("(sequence)", $sequence, $formdata);
					$formdata = str_replace("(fingerprint)", $fingerprint, $formdata);

				}

				print $formdata;
				print "</form>";
			}
		}

	?>

	Connecting with secure payment pages, please wait...
	</body>

</html>