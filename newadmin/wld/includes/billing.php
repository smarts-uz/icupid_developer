<?php
if(ADMIN_DEMO != "yes"){
    if(isset($_POST['do'])){ 
        switch ($_POST['do']) {
            case "add_gateway": {
				
				$dbh = getMarketDBConnection($_POST['market_id']);
				if(isset($_POST['editid'])){
				
					$stmt = $dbh->prepare("UPDATE merchant SET name='".$_POST['name']."', active='".$_POST['active']."', action='".$_POST['action']."', method='".$_POST['method']."', icon='".$_POST['icon']."' WHERE id=".$_POST['editid']);
					$stmt->execute();

					$ErrorSend=1;

					if(isset($ErrorSend)){
					if($ErrorSend > 0){ $Err = "Payment gateway updated successfully.**1";}else{$Err = "Payment gateway updated successfully.**0";}
					
					echo '<script>window.location.href="?p=gateways&Err='.$Err.'";</script>';

				}

				}else{

					require_once( 'wld/func/payment_gateways.php' );
					
					$market_id = $_POST['market_id'];
					switch($_POST['gateway']){
					
							case "paypal":{
							
								WLDAddPayPal($_POST,$market_id);
								
								$Err = "PayPal Gateway Created Successfully**1";
							
							} break;
				
							case "nochex":{
								$_POST['email'] = $_POST['email2'];
								
								WLDAddNoChecx($_POST,$market_id);
								
								$Err = "NOCHEX Gateway Created Successfully**1";
							
							} break;
										
							case "2checkout":{
								$_POST['email'] = $_POST['email3'];
								
								WLDTwoCheckout($_POST,$market_id);
								
								$Err = "2Checkout Gateway Created Successfully**1";
							
							} break;
							
							case "egold":{
								$_POST['email'] = $_POST['email4'];
								WLDAddEgold($_POST,$market_id);
								
								$Err = "EGold Gateway Created Successfully**1";
							
							} break;
				
							case "alertpay":{
								$_POST['email'] = $_POST['email5'];
								WLDAddAlertPay($_POST,$market_id);
								
								$Err = "AlertPay Gateway Created Successfully**1";
							
							} break;
				
							case "paymate":{
								$_POST['email'] = $_POST['email6'];
								WLDAddPayMate($_POST,$market_id);
								
								$Err = "PayMate Gateway Created Successfully**1";
							
							} break;
				
							case "worldpay":{
								$_POST['email'] = $_POST['email7'];
								WLDAddWorldPay($_POST,$market_id);
								
								$Err = "World Pay Gateway Created Successfully**1";
							
							} break;
							
							case "ccbill":{								
								WLDAddCCBill($_POST,$market_id);
								
								$Err = "CCBill Gateway Created Successfully**1";
							
							} break;
							
							case "google":{
							
								$_POST['email'] = $_POST['email13'];
								WLDAddGoogleCheckout($_POST,$market_id);
								
								$Err = "Google Gateway Created Successfully**1";
							
							} break;
							
							case "moneybookers":{
								$_POST['email'] = $_POST['email9'];
								WLDAddMoneyBookers($_POST,$market_id);
								
								$Err = "Moneybookers Gateway Created Successfully**1";
							
							} break;

							case "saferpay":{
								$_POST['email'] = $_POST['email9'];
								WLDSaferpay($_POST,$market_id);
								
								$Err = "Saferpay Gateway Created Successfully**1";
							
							} break;
									
							case "authorize":{
								$_POST['email'] = $_POST['email8'];
								WLDAddAuthorize($_POST,$market_id);
								
								$Err = "World Pay Gateway Created Successfully**1";
							
							} break;

							case "bank":{
								
								WLDBank($_POST,$market_id);
								
								$Err = "Bank System Created Successfully**1";
							
							} break;
							
							case "stripe":{

								$dbh = getMarketDBConnection($_REQUEST['market_id']);
								
								$query = $dbh->prepare("INSERT INTO `merchant` ( `id` , `name` , `active` , action, method, icon) VALUES (NULL , 'Stripe', '".$_POST['active']."', '".$_POST['action']."', 'POST', '".$_POST['icon']."')");
								
								$query->execute();

								$Err = "Stripe Payment Gateway Created Successfully**1";

							} break;

							case "custom_code":{
								
								$dbh = getMarketDBConnection($_REQUEST['market_id']);

								$query = $dbh->prepare("INSERT INTO `merchant` ( `id` , `name` , `comments` , `active` , action, method, icon) VALUES (NULL , '".$_POST['name']."', '".$_POST['comments']."', '".$_POST['active']."', '".$_POST['action']."', '".$_POST['method']."', '".$_POST['icon']."')");
								$query->execute();
								
							} break;
					}
					
					
				}
				
				$ErrorSend=1;

				if(isset($ErrorSend)){
					if($ErrorSend > 0){ $Err = "Payment gateway updated successfully.**1";}else{$Err = "Payment gateway updated successfully.**0";}
					
					echo '<script>window.location.href="?p=gateways&sp=add_gateway&market_id='.$market_id.'&Err='.$Err.'";</script>';

				}

			}break;
			case "gatewaydelete": {
				
				$ErrorSend=0;
				for($i = 1; $i < $_POST['NumRows']+1; $i++) { 
					
					$dbh = getMarketDBConnection($_POST['market_id']);

					if(isset($_POST['d'. $i]) && $_POST['d'.$i] == "on"){
						

						$stmt = $dbh->prepare("DELETE FROM merchant WHERE id=".$_POST['id'. $i]);
						$stmt->execute();
						$stmt = $dbh->prepare("DELETE FROM merchant_data WHERE mid=".$_POST['id'. $i]);
						$stmt->execute();
						$ErrorSend++;
					}
				}
				
			}break;
            case "addf": {
				
				$dbh = getMarketDBConnection($_POST['market_id']);

				$stmt = $dbh->prepare("INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$_POST['mid']."', '".$_POST['name']."', '".$_POST['value']."', '".$_POST['type']."')");
				
				$stmt->execute();
				echo '<script>window.location.href="?p=gateways&sp=fields&market_id='.$_POST['market_id'].'&id='.$_POST['mid'].'&Err=Field updated successfully.**1";</script>';
				
			}break;
            case "paymentitemdelete": {
            	$ErrorSend=0;
				
				for($i = 1; $i < $_POST['NumRows']+1; $i++) { 
					
					$dbh = getMarketDBConnection($_POST['market_id']);

					if(isset($_POST['d'. $i]) && $_POST['d'.$i] == "on"){
					
						$stmt = $dbh->prepare("DELETE FROM merchant_data WHERE id=".$_POST['id'. $i]);
						$stmt->execute();
						$ErrorSend++;
					
					}
				}

				echo '<script>window.location.href="?p=gateways&sp=fields&market_id='.$_POST['market_id'].'&id='.$_POST['mid'].'&Err=Field updated successfully.**1";</script>';
			}break;
        }
    }
}

?>

<?php

$_REQUEST['sp'] = (isset($_REQUEST['sp'])) ? $_REQUEST['sp'] : 'payment_gateways';

include('billing/'.$_REQUEST['sp'].'.php');    

?>