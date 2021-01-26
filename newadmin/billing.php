<?
$_REQUEST['n'] =4;
require_once "inc/config.php";

require_once subd . "inc/config.php";
require_once("../plugins/config_plugins.php" );


## page access check
if(!in_array("5",$_SESSION['admin_access_level']) ) { header("location:overview.php");}

$PageLink = "billing.php";
$PageLang = $admin_layout_page5;

require_once "layout.php";

############################################################
#################### OPERATIONS ############################

if(ADMIN_DEMO != "yes"){

if(isset($_POST['do'])){ 

		switch ($_POST['do']) {

			case"updatepageaccess": {

				$filecontent = "<?\n";
				$PACKIDS = explode(",",trim($_POST['packageIDS']));
 
				$t=1;

				foreach($PACKIDS as $package_id){	

				if($package_id !="" && is_numeric($package_id)){

					$filecontent .= "$"."PACKAGEACCESS[".$package_id."] = array( \n";
					while($t < $_POST['TotalOps']){

						if(isset($_POST[$package_id."_".$t]) && $_POST[$package_id."_".$t]==1){

							$filecontent .="'".$_POST["key_".$t]."-".$_POST["value_".$t]."',\n";
						}
				
						$t++;
					}
					$filecontent .= ");";
					$t=1;
					}
				}

						$filename = str_replace("newadmin","",dirname(__FILE__)).'inc/config_packageaccess.php';
						if (!$file = fopen($filename, 'a+b')) {
							die("There was an error opening your config.php file. Please make sure it exsits and is located in the inc/ directory.");
						} else {					
						 
 							
							
							$filecontent .= " \n ?>";
							//now we have to write in all the new data to this file
						   if (!$handle = fopen($filename, 'w')) { 
								 echo "Cannot open file ($filename)"; 
								 exit; 
						   }
						   // Write $somecontent to our opened file. 
						   if (fwrite($handle, $filecontent) === FALSE) { 
							   echo "Cannot write to file ($filename)"; 
							  exit; 
						   } 
						   fclose($handle);
					} 

			$ErrorSend=1;

		} break;

		case "packageaddcaption":	{

			/*  Remove Row from database*/
			$capnewlang = str_replace(".php","",$_POST['lang']);
			$DB->Insert("INSERT INTO `package_languages` (`pid` , `language` , `caption`, `comments`)
			VALUES ('".$_POST['cid']."', '$capnewlang', '".$_POST['caption']."', '".$_POST['description']."')");

			
			header("location: billing.php?p=&se=1"); 
							
		} break;

		case "upbill": {
			
				$DB->Insert("UPDATE members_billing SET uid='".$_POST['b0']."', packageid='".$_POST['pid']."', 	date_upgrade='".$_POST['b1']."', 	date_expire='".$_POST['b2']."', 	pay_method='".$_POST['b3']."', 	running='".$_POST['b7']."', 	subscription='".$_POST['b6']."', 	bill_email='".$_POST['b4']."', 	transaction_id='".$_POST['b5']."' WHERE id='".$_POST['eid']."' LIMIT 1");
				
				$ErrorSend=1;
				
		}break;
		
		/*
			UPDATE CREDIT DETAILS
		*/	
		
		case "updatecredits": {
			 
				$filename = subd.'inc/config.php';
				if (!$file = fopen($filename, 'a+b')) {
					die("There was an error opening your config.php file. Please make sure it exsits and is located in the inc/ directory.");
				} else {
			
				$data = array();
				$counter = 1;
				$filecontent = "";
				while (!feof($file)) {
					$data[$counter] = fgets($file);
					// check line and replace string			
				
					if ( strstr($data[$counter], "'D_CREDIT_EMAILS','".D_CREDIT_EMAILS."'") && isset($_POST['credit_emails'])) {
					  	
						$filecontent .= str_replace("'D_CREDIT_EMAILS','".D_CREDIT_EMAILS."'", "'D_CREDIT_EMAILS','".$_POST['credit_emails']."'", $data[$counter]);
				  	}
					elseif ( strstr($data[$counter], "'D_CREDIT_PRICE','".D_CREDIT_PRICE."'") && isset($_POST['credit_price'])) {
					  	
						$filecontent .= str_replace("'D_CREDIT_PRICE','".D_CREDIT_PRICE."'", "'D_CREDIT_PRICE','".$_POST['credit_price']."'", $data[$counter]);
					}
					elseif ( strstr($data[$counter], "'D_CREDIT_STATUS','".D_CREDIT_STATUS."'") && isset($_POST['credit_status'])) {
					  	
						$filecontent .= str_replace("'D_CREDIT_STATUS','".D_CREDIT_STATUS."'", "'D_CREDIT_STATUS','".$_POST['credit_status']."'", $data[$counter]);
					}
					else{
						$filecontent .= $data[$counter];
					}		 
					$counter ++;
				}	
				fclose($file);
			}
			//now we have to write in all the new data to this file
		   	if (!$handle = fopen($filename, 'w')) { 
				echo "Cannot open file ($filename)"; 
				exit; 
		   	}
		 	// Write $somecontent to our opened file. 
			if (fwrite($handle, $filecontent) === FALSE) { 
				echo "Cannot write to file ($filename)"; 
				exit; 
			} 
			fclose($handle);
		   
			$ErrorSend=1;

		}break;

		/*
			DISABLE FREE MODE
		*/	
		
		case "disablefree": {
				
						$filename = str_replace("newadmin","",dirname(__FILE__)).'inc/config.php';
						if (!$file = fopen($filename, 'a+b')) {
							die("There was an error opening your config.php file. Please make sure it exsits and is located in the inc/ directory.");
						} else {
					
						$data = array();
						$counter = 1;
						$filecontent = "";
						while (!feof($file)) {
							$data[$counter] = fgets($file);
							// check line and replace string							
							  if ( strstr($data[$counter], "'D_FREE','".D_FREE."'") ) {
							  	
									$filecontent .= str_replace("'D_FREE','".D_FREE."'", "'D_FREE','no'", $data[$counter]);
							  }
							  else{
									$filecontent .= $data[$counter];
							  }		 
							 $counter ++;
						}	
						fclose($file);
					}
						//now we have to write in all the new data to this file
					   if (!$handle = fopen($filename, 'w')) { 
							 echo "Cannot open file ($filename)"; 
							 exit; 
					   }
					   // Write $somecontent to our opened file. 
					   if (fwrite($handle, $filecontent) === FALSE) { 
						   echo "Cannot write to file ($filename)"; 
						  exit; 
					   } 
					   fclose($handle);
					   
					   $ErrorSend=1;
				
		}break;
		
		/*
			REJECT AFFILIATE PAYMENT
		*/	
		
		case "affpayreject": {
				
				$ErrorSend=0;
				for($i = 1; $i < $_POST['NumRows']+1; $i++) { 
					
					if(isset($_POST['d'. $i]) && $_POST['d'.$i] == "on"){
					
						$DB->Insert("UPDATE aff_payment SET status='canceled' WHERE autoid=".$_POST['id'. $i]);
						$ErrorSend++;
					}
				}
				
		}break;
		
		
		/*
			APPROVE AFFILIATE PAYMENT
		*/	
		
		case "affpayapprove": {
				
				$ErrorSend=0;
				for($i = 1; $i < $_POST['NumRows']+1; $i++) { 
					
					if(isset($_POST['d'. $i]) && $_POST['d'.$i] == "on"){
					
						$DB->Insert("UPDATE aff_payment SET status='approved', paid='yes' WHERE autoid=".$_POST['id'. $i]);
						$ErrorSend++;
					}
				}
				
		}break;
		
		
		/*
			DELETE  AFFILIATE PAYMENT
		*/	
		
		case "affpaydelete": {
				
				$ErrorSend=0;
				for($i = 1; $i < $_POST['NumRows']+1; $i++) { 
					
					if(isset($_POST['d'. $i]) && $_POST['d'.$i] == "on"){
					
						$DB->Insert("DELETE FROM aff_payment WHERE autoid=".$_POST['id'. $i]);
						$ErrorSend++;
					}
				}
				
		}break;
		
		/*
			ADD PACKAGE ITEM
		*/	
		
		case "addf": {
			
				$DB->Insert("INSERT INTO `merchant_data` ( `mid` , `name` , `value` , `type` )VALUES ('".$_POST['mid']."', '".$_POST['name']."', '".$_POST['value']."', '".$_POST['type']."')");
				
				$ErrorSend=1;
				
		}break;

		/*
			Edit PACKAGE ITEM
		*/	
		
		case "editf": {
			
				$DB->Update("UPDATE `merchant_data` SET `name` = '".$_POST['name']."', `value` = '".$_POST['value']."' WHERE id = '".$_POST['fid']."'");
				
				$ErrorSend=1;
				
		}break;
			
		/*
			DELETE  PACKAGE ITEM
		*/	
		
		case "paymentitemdelete": {
				
				$ErrorSend=0;
				for($i = 1; $i < $_POST['NumRows']+1; $i++) { 
					
					if(isset($_POST['d'. $i]) && $_POST['d'.$i] == "on"){
					
						$DB->Insert("DELETE FROM merchant_data WHERE id=".$_POST['id'. $i]);
						$ErrorSend++;
					}
				}
				
		}break;
		
		/*
			DELETE  PACKAGE ITEM
		*/	
		case "gatewaydelete": {
				
				$ErrorSend=0;
				for($i = 1; $i < $_POST['NumRows']+1; $i++) { 
					
					if(isset($_POST['d'. $i]) && $_POST['d'.$i] == "on"){
					
						$DB->Update("DELETE FROM merchant WHERE id=".$_POST['id'. $i]);
						$DB->Update("DELETE FROM merchant_data WHERE mid=".$_POST['id'. $i]);
						$ErrorSend++;
					}
				}
				
		}break;
		
		/*
			ADD PAYMENT GATEWAY
		*/
		
			case "addgateway": {
				
				if(isset($_POST['editid'])){
				
					$DB->Update("UPDATE merchant SET name='".$_POST['name']."', title='".$_POST['title']."', active='".$_POST['active']."', action='".$_POST['action']."', method='".$_POST['method']."', icon='".$_POST['icon']."' WHERE id=".$_POST['editid']);

					if((isset($_FILES['requitix_image']) && $_FILES['requitix_image']['name'] != "") || (isset($_POST['requitix_address']) && $_POST['requitix_address'] != "")) {
						$filename = subd.'inc/config.php';
						if (!$file = fopen($filename, 'a+b')) {
							die("There was an error opening your config.php file. Please make sure it exsits and is located in the inc/ directory.");
						} else {
					
						$data = array();
						$counter = 1;
						$filecontent = "";
						while (!feof($file)) {
							$data[$counter] = fgets($file);
							// check line and replace string
														
							if ( strstr($data[$counter], "'ETH_ADDRESS','".ETH_ADDRESS."'") && isset($_POST['requitix_address']) ) {
							  	
								$filecontent .= str_replace("'ETH_ADDRESS','".ETH_ADDRESS."'", "'ETH_ADDRESS','".$_POST['requitix_address']."'", $data[$counter]);
						  	}
						  	else if ( strstr($data[$counter], "'REQUITIX_API_KEY','".REQUITIX_API_KEY."'") && isset($_POST['requitix_api_key']) ) {
							  	
								$filecontent .= str_replace("'REQUITIX_API_KEY','".REQUITIX_API_KEY."'", "'REQUITIX_API_KEY','".$_POST['requitix_api_key']."'", $data[$counter]);
						  	}
							elseif ( strstr($data[$counter], "'ETH_image','".ETH_image."'") && isset($_FILES['requitix_image']['name']) && $_FILES['requitix_image']['name'] != "" ) {

								$target_file = basename($_FILES["requitix_image"]["name"]);
							  	
								$filecontent .= str_replace("'ETH_image','".ETH_image."'", "'ETH_image','".$target_file."'", $data[$counter]);

								if(isset($_FILES['requitix_image'])){

									$target_file = basename($_FILES["requitix_image"]["name"]);
									move_uploaded_file($_FILES['requitix_image']['tmp_name'], '../uploads/crypto_qr/'.$target_file);
								}

							}
							else{
								$filecontent .= $data[$counter];
						  	}		 
						
							$counter ++;
						
						}	
						fclose($file);
					}

					

						//now we have to write in all the new data to this file
					   if (!$handle = fopen($filename, 'w')) { 
							 echo "Cannot open file ($filename)"; 
							 exit; 
					   }
					   // Write $somecontent to our opened file. 
					   if (fwrite($handle, $filecontent) === FALSE) { 
						   echo "Cannot write to file ($filename)"; 
						  exit; 
					   } 
					   fclose($handle);
					}

				
				}else{
				
					require_once( 'inc/func/payment_gateways.php' );
					
					switch($_POST['gateway']){
					
							case "paypal":{
							
								AddPayPal($_POST);
								
								$Err = "PayPal Gateway Created Successfully**1";
							
							} break;
				
							case "nochex":{
								$_POST['email'] = $_POST['email2'];
								AddNoChecx($_POST);
								
								$Err = "NOCHEX Gateway Created Successfully**1";
							
							} break;
										
							case "2checkout":{
								$_POST['email'] = $_POST['email3'];
								TwoCheckout($_POST);
								
								$Err = "2Checkout Gateway Created Successfully**1";
							
							} break;
							
							case "egold":{
								$_POST['email'] = $_POST['email4'];
								AddEgold($_POST);
								
								$Err = "EGold Gateway Created Successfully**1";
							
							} break;
				
							case "alertpay":{
								$_POST['email'] = $_POST['email5'];
								AddAlertPay($_POST);
								
								$Err = "AlertPay Gateway Created Successfully**1";
							
							} break;
				
							case "paymate":{
								$_POST['email'] = $_POST['email6'];
								AddPayMate($_POST);
								
								$Err = "PayMate Gateway Created Successfully**1";
							
							} break;
				
							case "worldpay":{
								$_POST['email'] = $_POST['email7'];
								AddWorldPay($_POST);
								
								$Err = "World Pay Gateway Created Successfully**1";
							
							} break;
							
							case "ccbill":{								
								AddCCBill($_POST);
								
								$Err = "CCBill Gateway Created Successfully**1";
							
							} break;
							
							case "google":{
							
								$_POST['email'] = $_POST['email13'];
								AddGoogleCheckout($_POST);
								
								$Err = "Google Gateway Created Successfully**1";
							
							} break;
							
							case "moneybookers":{
								$_POST['email'] = $_POST['email9'];
								AddMoneyBookers($_POST);
								
								$Err = "Moneybookers Gateway Created Successfully**1";
							
							} break;

							case "saferpay":{
								$_POST['email'] = $_POST['email9'];
								Saferpay($_POST);
								
								$Err = "Saferpay Gateway Created Successfully**1";
							
							} break;
									
							case "authorize":{
								$_POST['email'] = $_POST['email8'];
								AddAuthorize($_POST);
								
								$Err = "World Pay Gateway Created Successfully**1";
							
							} break;

							case "bank":{
								
								Bank($_POST);
								
								$Err = "Bank System Created Successfully**1";
							
							} break;

							case "stripe":{
								
								AddStripe($_POST);
								
								$Err = "Stripe Payment Gateway Created Successfully**1";
							
							} break;
							
							case "custom_code":{
							
								$DB->Insert("INSERT INTO `merchant` ( `id` , `name` , `title`, `comments` , `active` , action, method, icon) VALUES (NULL , '".$_POST['name']."', '".$_POST['title']."', '".$_POST['comments']."', '".$_POST['active']."', '".$_POST['action']."', '".$_POST['method']."', '".$_POST['icon']."')");
							
							} break;
					}
					
					
				}
				
				$ErrorSend=1;
				
			} break;
			
		/*
			UPDATE PACKAGE ACCESS
		*/
		
		case "transfer": {
			
				$DB->Update("UPDATE members SET packageid='".$_POST['to_pid']."' WHERE packageid='".$_POST['from_pid']."'");				

				$ErrorSend=1;
				
		} break;		
		/*
			UPDATE PACKAGE ACCESS
		*/
		case "updateitemaccess": {
			
					$packar = "";
					for($i = 1; $i < $_POST['TotalCheck']; $i++) { 
					
						if(isset($_POST['c'. $i]) && $_POST['c'.$i] == "on"){				
								$packar .= "*".$_POST['cn'.$i]."*";					
						}
					
					}
					if(!isset($_POST['eid'])){
					
						$DB->Insert("INSERT INTO `package_items` ( `pid` , `itemid` , `value` , `name` , `description` )
						VALUES ('".$packar."', NULL , '0', '".$_POST['title']."', '".$_POST['comment']."')");
						
					}else{
					

						if($_POST['NEWitemid'] !=$_POST['eid']){
						
							$HasP = $DB->Row("SELECT count(itemid) AS total FROM package_items WHERE itemid='".$_POST['NEWitemid']."' LIMIT 1");
							if($HasP['total'] ==0){
								$DB->Update("UPDATE package_items SET name='".$_POST['title']."', description='".$_POST['comment']."', pid='$packar', itemid='".$_POST['NEWitemid']."'  WHERE itemid=".$_POST['eid']);
							}else{
								die("THERE IS ALREADY A PACKAGE WITH THIS ITEMID. PLEASE CLICK BACK AND CHANGE THE ID TO A DIFFERENT VALUE.");
							}
						
						}else{
						
							$DB->Update("UPDATE package_items SET name='".$_POST['title']."', description='".$_POST['comment']."', pid='$packar'  WHERE itemid=".$_POST['eid']);
						
						}						
						
					}
					
					$ErrorSend=1;
					
			} break;
			
		/*
			UPDATE PACKAGE ACCESS
		*/	
		
			case "updateitems": {
							
					$packar = "";
			
					for($i = 1; $i < $_POST['TotalItems']; $i++) { 
					
						if(isset($_POST['cpn'. $i])){				
						
							// see if this package is aready enabled for this item
							$check = $DB->Row("SELECT pid FROM package_items WHERE pid LIKE '%*".$_POST['pid']."*%' AND itemid='".$_POST['cn'.$i]."' limit 1");
							if(!empty($check)){
									
									if($_POST['c'. $i] != "on"){

									$DB->Update("UPDATE package_items SET pid = '".str_replace("*".$_POST['pid']."*", "", $_POST['cpn'.$i])."' WHERE itemid=".$_POST['cn'.$i]);
									}
								
							}else{
									if($_POST['c'. $i] == "on"){
									$DB->Update("UPDATE package_items SET pid = '".$_POST['cpn'.$i]."*".$_POST['pid']."*"."' WHERE itemid=".$_POST['cn'.$i]);
									}
							}
						
						}
					
					}	

				$ErrorSend=1;
				
			} break;
 

		/*
			DELETE  PACKAGE ITEM
		*/	
		case "itemdelete": {
				
				$ErrorSend=0;
				for($i = 1; $i < $_POST['NumRows']+1; $i++) { 
					
					if(isset($_POST['d'. $i]) && $_POST['d'.$i] == "on"){
					
						$DB->Update("DELETE FROM package_items WHERE itemid=".$_POST['id'. $i]);
						$ErrorSend++;
					}
				}
				
		}break;
		
		/*
			DELETE PACKAGE
		*/	
		case "packagedelete": {
				
				$ErrorSend=0;
				for($i = 1; $i < $_POST['NumRows']+1; $i++) { 
		
			    	if(isset($_POST['d'. $i]) && $_POST['d'.$i] == "on"){
					
						$DB->Update("DELETE FROM package WHERE pid=".$_POST['id'. $i]);
						
						// UPDATE ALL MEMBERS WHO WERE ON THIS PACKAGE
						
						$DB->Update("UPDATE members SET packageid=3 WHERE packageid=".$_POST['id'. $i]);						
				
						$ErrorSend++;
						
					}
				}
				
		}break;
		
		/*
			DELETE  GATEWAY
		*/	
		case "gatewaydelete": {
				
				$ErrorSend=0;
				for($i = 1; $i < $_POST['NumRows']+1; $i++) { 
					
					if(isset($_POST['d'. $i]) && $_POST['d'.$i] == "on"){
					
						$DB->Update("DELETE FROM merchant WHERE id=".$_POST['id'.$i]);
						$DB->Update("DELETE FROM merchant_data WHERE mid=".$_POST['id'.$i]);
						
						$ErrorSend++;
					
					}
				}
			
		}break;
		
				
			case "add": {
			
					if($_POST['smspackage'] ==1){
						$_POST['icon']="SMS";
					}else{
						$_POST['icon']="";
					}

					if($_POST['ihighlight'] ==''){
						$_POST['ihighlight']="no";
					}
					
					if(!isset($_POST['eid'])){
					
						$DB->Insert("INSERT INTO `package` ( )	VALUES ()");
						$userid = $DB->InsertID();
						$DB->Update("UPDATE package SET view_adult='".$_POST['iadult']."', name='".$_POST['name']."', price='".$_POST['price']."', imageSpace='".$_POST['ispace']."', icon='".$_POST['icon']."', visible='".$_POST['visible']."', comments='".eMeetingInput($_POST['comments'])."', numdays='".$_POST['numdays']."',maxFiles='".$_POST['ifiles']."', maxMessage='".$_POST['imessages']."', subscription='".$_POST['isub']."', currency_code='".htmlspecialchars  ($_POST['icurrency'])."', SMS_credits='".$_POST['isms']."', Highlighted='".$_POST['ihighlight']."', Featured='".$_POST['ifeatured']."', wink='".$_POST['iwink']."' WHERE pid=".$userid);				
						
					}else{
					
						$SQL = "UPDATE package SET view_adult='".$_POST['iadult']."', name='".$_POST['name']."', price='".$_POST['price']."', imageSpace='".$_POST['ispace']."', icon='".$_POST['icon']."', visible='".$_POST['visible']."', comments='".eMeetingInput($_POST['comments'])."', numdays='".$_POST['numdays']."',maxFiles='".$_POST['ifiles']."', maxMessage='".$_POST['imessages']."', subscription='".$_POST['isub']."', currency_code='".htmlspecialchars  ($_POST['icurrency'])."', SMS_credits='".$_POST['isms']."', Highlighted='".$_POST['ihighlight']."', Featured='".$_POST['ifeatured']."', wink='".$_POST['iwink']."' WHERE pid=".$_POST['eid'];				

						$DB->Update($SQL);

						$userid = $_POST['eid'];
					}

					if(isset($_FILES['icon'])){
						move_uploaded_file($_FILES['icon']['tmp_name'], '../uploads/membershipicons/'.$userid.'.png');
					}

					$ErrorSend=1;
					
			} break;
			

		}
}

// REDIRECT TO THE SAME PAGE
if(isset($ErrorSend)){
	if($ErrorSend > 0){ $Err = $lang_members_code['update']."**1";}else{$Err = $lang_members_code['no_update']."**0";}
}

if(isset($Err) && !isset($_REQUEST['d'])){

	if( isset($_POST['p']) || isset($RedirectPage) ){
	
		$page    = (isset($RedirectPage))		?	$RedirectPage : $_POST['p'];
		
		header('location: billing.php?p='.$page.'&Err='.$Err.'&d=1');
		exit();	
	}else{
		
		header('location: billing.php?Err='.$Err.'&d=1');
		exit();
	}
}
}
############################################################
#################### FUNCTIONS #############################
function DisplayPackages(){

	global $DB;
	
	$count=1;

	$result = $DB->Query("SELECT * FROM package ORDER BY `type`");

    while( $package = $DB->NextRow($result) )
    {
		$pack_users = $DB->Row("SELECT count(id) AS total FROM members WHERE packageid=".$package['pid']." limit 1");
		if($package['pid'] ==3 || $package['pid'] == 7){ $bgc ="#F0F5F9"; }else{ $bgc ="#ffffff"; }
		if($package['type'] =="custom"){ $DD=""; }else{ $DD="disabled";}
		
		print "<tr>
				<td bgcolor='".$bgc."'><input name='d".$count."' type='checkbox' value='on' ".$DD."><input type=hidden value='".$package['pid']."' name=id".$count." class='hidden'></td>
				<td bgcolor='".$bgc."'>".$package['pid']."</td>
				<td bgcolor='".$bgc."'>".$package['name']."</td>					
				<td bgcolor='".$bgc."'>".$package['currency_code']." ".$package['price']."</td>
				<td bgcolor='".$bgc."' align=center>";
					
			if($package['visible']==1 && $package['type'] =="custom"){ print "Yes"; }else{ print "No"; } print "</td>
				<td bgcolor='".$bgc."' align=center>".$pack_users['total']."</td>";
				 
		print "<td bgcolor='".$bgc."'><a href='?p=epackagelanguage&id=".$package['pid']."'>".icon_edit."</a></td>";
		print "<td bgcolor='".$bgc."'><a href='?p=epackage&id=".$package['pid']."'>".icon_edit."</a></td></tr>";
		//print "<td bgcolor='".$bgc."'><a href='?p=epackage&id=".$package['pid']."'>".icon_edit.$GLOBALS['lang_admin_edit']."</a></td></tr>";

		$count++;
	}
	
	return $count;
}
 
function GetCustomReports(){
	
	global $DB;

	$sp = (isset($_GET['sp'])) ? $_GET['sp'] : '';

	switch ($sp) {
		case 'm':

			$end_cur_month = date("Y-m-d H:i:s");

			$start_cur_month = date("Y-m")."-01 00:00:00";
			
			$aff_condition = " AND `date` >= '".$start_cur_month."' AND `date` <= '".$end_cur_month."'";
			$pay_condition = " AND m.created >= '".$start_cur_month."' AND m.created <= '".$end_cur_month."'";

			break;
		
		case 'l':

			$end_prev_month = date("Y-m-d H:i:s",strtotime("-1 days",strtotime(date("Y-m")."-01 23:59:59")));

			$start_prev_month = date("Y-m",strtotime($end_prev_month))."-01 00:00:00";
			
			$aff_condition = " AND `date` >= '".$start_prev_month."' AND `date` <= '".$end_prev_month."'";
			$pay_condition = " AND m.created >= '".$start_prev_month."' AND m.created <= '".$end_prev_month."'";

			break;
		case 'd':
			
			$aff_condition = " AND `date` >= '".date("Y-m-d H:i:s", strtotime("-7 days"))."' AND `date` <= '".date("Y-m-d H:i:s")."'";
			$pay_condition = " AND m.created >= '".date("Y-m-d H:i:s", strtotime("-7 days"))."' AND m.created <= '".date("Y-m-d H:i:s")."'";

			break;

		case 'c':
			
			$aff_condition = " AND `date` >= '".date("Y-m-d H:i:s", strtotime($_POST['from_date']))."' AND `date` <= '".date("Y-m-d H:i:s", strtotime($_POST['to_date']))."'";
			$pay_condition = " AND m.created >= '".date("Y-m-d H:i:s", strtotime($_POST['from_date']))."' AND m.created <= '".date("Y-m-d H:i:s", strtotime($_POST['to_date']))."'";

			break;
		
		default:
			
			$aff_condition = "AND `date` LIKE '%".date("Y")."-%'";
			$pay_condition = "AND m.created LIKE '%".date("Y")."-%'";
			
			break;
	}



	$affiliate = $DB->Row("SELECT sum(total_due) as total_due FROM aff_payment ap WHERE 1 $aff_condition");

	$results = $DB->Query("SELECT count(m.id) as members, SUM(p.price) as earning, p.currency_code as currency FROM members m INNER JOIN package p ON m.packageid = p.pid WHERE 1 $pay_condition GROUP BY p.currency_code");

	$total_earning = array();

	
	$total_earning['affiliates'] = (isset($affiliate['total_due'])) ? $affiliate['total_due'] : 0;
	//$total_earning['currency'][] = ;
	
	$total_earning['earning']['USD'][] = 0;
	$total_earning['members'][] = 0;

	while ( $result = $DB->NextRow($results)) {
		
		
		$total_earning['currency'][] = $result['currency'];
		$total_earning['earning'][$result['currency']][] = $result['earning'];
		$total_earning['members'][] = $result['members'];

	}

	return $total_earning;
}

function GetRegistrationsMonthly(){

	global $DB;

	$arrMonthlyMembers = array();


	if(isset($_POST['do']) && $_POST['do'] == 'custom'){
		if((isset($_POST['from_date']) && $_POST['from_date'] != "") && (isset($_POST['to_date']) && $_POST['to_date'] != "")){

			$page = 'c';

		}
	}
	else if(isset($_GET['sp']) && $_GET['sp'] != ''){
		$page = $_GET['sp'];
	}
	else{
		$page = "";	
	}

	if($page == 'l'){


		

		$end_day_last_date = date("Y-m-d",strtotime("-1 days",strtotime(date("Y-m")."-01")));

		$first_day_last_date = date("Y-m",strtotime($end_day_last_date))."-01";


		$end_day = (int)date("d",strtotime($end_day_last_date));

		for ($i=0; $i < $end_day; $i++) {
		
		

		
			$match_date = date("Y-m-d",strtotime("-$i days",strtotime($end_day_last_date)));		

			$membersResult = $DB->Row("SELECT count(id) as monthly_members FROM members WHERE created LIKE '%$match_date%'");
			

			$packages = $DB->Query("SELECT pid as pack_id, name as pack_name FROM package WHERE visible = '1'");

			$packagesMembers = array();

			
			while( $package = $DB->NextRow($packages) ){

				
				$packagesMembersResult = $DB->Row("SELECT count(id) as monthly_pack_members,packageid FROM members WHERE created LIKE '%$match_date%' AND packageid = '".$package['pack_id']."'");

				$packagesMembers[$package['pack_id']]['count'] = $packagesMembersResult['monthly_pack_members'];
				$packagesMembers[$package['pack_id']]['name'] = $package['pack_name'];

			}

			
			
			$arrMonthlyMembers[$i]['month'] = date("m-d-Y",strtotime($match_date));
			$arrMonthlyMembers[$i]['count'] = $membersResult['monthly_members'];
			$arrMonthlyMembers[$i]['packages'] = $packagesMembers;

		}
	
		
	}
	else if($page == 'm'){


		

		$end_day_current_month = date("Y-m-d");

		$first_day_current_month = date("Y-m")."-01";


		$end_day = (int)date("d",strtotime($end_day_current_month));

		for ($i=0; $i < $end_day; $i++) {
		
		
			$match_date = date("Y-m-d",strtotime("-$i days",strtotime($end_day_current_month)));		

			$membersResult = $DB->Row("SELECT count(id) as monthly_members FROM members WHERE created LIKE '%$match_date%'");
			

			$packages = $DB->Query("SELECT pid as pack_id, name as pack_name FROM package WHERE  visible = '1'");

			$packagesMembers = array();

			
			while( $package = $DB->NextRow($packages) ){

			
				$packagesMembersResult = $DB->Row("SELECT count(id) as monthly_pack_members,packageid FROM members WHERE created LIKE '%$match_date%' AND packageid = '".$package['pack_id']."'");

				$packagesMembers[$package['pack_id']]['count'] = $packagesMembersResult['monthly_pack_members'];
				$packagesMembers[$package['pack_id']]['name'] = $package['pack_name'];

			}

		
		
			$arrMonthlyMembers[$i]['month'] = date("m-d-Y",strtotime($match_date));
			$arrMonthlyMembers[$i]['count'] = $membersResult['monthly_members'];
			$arrMonthlyMembers[$i]['packages'] = $packagesMembers;

		}
	

	}
	else if($page == 'd'){
		

		$current_date = date("Y-m-d");

		for ($i=0; $i < 7; $i++) {
		
		

			$match_date = date ("Y-m-d", strtotime("-$i days"));
			

			$membersResult = $DB->Row("SELECT count(id) as monthly_members FROM members WHERE created LIKE '%$match_date%'");
			

			$packages = $DB->Query("SELECT pid as pack_id, name as pack_name FROM package WHERE visible = '1'");

			$packagesMembers = array();

			
			while( $package = $DB->NextRow($packages) ){

			
				$packagesMembersResult = $DB->Row("SELECT count(id) as monthly_pack_members,packageid FROM members WHERE created LIKE '%$match_date%' AND packageid = '".$package['pack_id']."'");

				$packagesMembers[$package['pack_id']]['count'] = $packagesMembersResult['monthly_pack_members'];
				$packagesMembers[$package['pack_id']]['name'] = $package['pack_name'];

			}
		
			$arrMonthlyMembers[$i]['month'] = date("m-d-Y",strtotime($match_date));
			$arrMonthlyMembers[$i]['count'] = $membersResult['monthly_members'];
			$arrMonthlyMembers[$i]['packages'] = $packagesMembers;

		}
	

	}
	else if($page == 'c'){
		

		$from_year = date("Y",strtotime($_POST['from_date']));
		$to_year = date("Y",strtotime($_POST['to_date']));

		$from_month = date("m",strtotime($_POST['from_date']));
		$to_month = date("m",strtotime($_POST['to_date']));

		$from_day = date("d",strtotime($_POST['from_date']));
		$to_day = date("d",strtotime($_POST['to_date']));

		$end_day_custom_date = date("Y-m-d",strtotime($_POST['to_date']));
		$first_day_custom_date = date("Y-m-d",strtotime($_POST['from_date']));

		if($from_year == $to_year){ //CASE 1

			if($from_month == $to_month){  //CASE 2

				$case = 2;
				
				$start_day = (int)date("d",strtotime($first_day_custom_date));
				
				$end_day = (int)date("d",strtotime($end_day_custom_date));

				$custom_range = $end_day - $start_day + 1;

			}
			else{  //CASE 3
				
				$case = 3;

				$custom_year = (int)date("Y",strtotime($first_day_custom_date));
				
				$start_month = (int)date("m",strtotime($first_day_custom_date));
				
				$end_month = (int)date("m",strtotime($end_day_custom_date));

				$custom_range = $end_month - $start_month + 1;

			}

		}
		else{  //CASE 4

			$case = 4;

			$end_year = $to_year;

			$custom_range = $to_year - $from_year + 1;
		}

		for ($i=0; $i < $custom_range; $i++) {
		
		
			switch ($case) {
				case '2':
					
					$custom_query = "";
					$match_date = date ("Y-m-d", strtotime("-$i days",strtotime($end_day_custom_date)));

					break;
				case '3':

					$custom_month = $end_month - $i;
					
					$custom_query = " and created >= '".date("Y-m-d H:i:s",strtotime($first_day_custom_date))."' and created <= '".date("Y-m-d H:i:s",strtotime($end_day_custom_date." 23:59:59"))."' ";

					if($custom_month < 10){
						$match_date = "$custom_year-0$custom_month";
					}
					else{
						$match_date = "$custom_year-$custom_month";
					}

					break;

				case '4':

					$custom_year = $end_year - $i;
					
					$custom_query = " and created >= '".date("Y-m-d H:i:s",strtotime($first_day_custom_date))."' and created <= '".date("Y-m-d H:i:s",strtotime($end_day_custom_date." 23:59:59"))."' ";

					$match_date = "$custom_year-";
					

					break;		
			
			
			}
		
			$membersResult = $DB->Row("SELECT count(id) as monthly_members FROM members WHERE created LIKE '%$match_date%' $custom_query");
		

			$packages = $DB->Query("SELECT pid as pack_id, name as pack_name FROM package WHERE visible = '1'");

			$packagesMembers = array();

			
			while( $package = $DB->NextRow($packages) ){

			
				$packagesMembersResult = $DB->Row("SELECT count(id) as monthly_pack_members,packageid FROM members WHERE created LIKE '%$match_date%' $custom_query AND packageid = '".$package['pack_id']."'");

				$packagesMembers[$package['pack_id']]['count'] = $packagesMembersResult['monthly_pack_members'];
				$packagesMembers[$package['pack_id']]['name'] = $package['pack_name'];

			}

		
			switch ($case) {
				case '2':
					
					$arrMonthlyMembers[$i]['month'] = date("m-d-Y",strtotime($match_date));

					break;
				case '3':

				
					
					if($custom_month < 10){
						
						$arrMonthlyMembers[$i]['month'] = date("M-Y",strtotime("$custom_year-0$custom_month-01"));
						
					}
					else{
						$arrMonthlyMembers[$i]['month'] = date("M-Y",strtotime("$custom_year-$custom_month-01"));
					}

					break;	
				case '4':
						
					$arrMonthlyMembers[$i]['month'] = $custom_year;

					break;	
			
			
			}
		
			$arrMonthlyMembers[$i]['count'] = $membersResult['monthly_members'];
			$arrMonthlyMembers[$i]['packages'] = $packagesMembers;

		}
	
	
	}
	else{


		$count_month = (int)date('m');
		$current_month = (int)date('m');
		$current_year = date('Y');
		for ($i=0; $i < $count_month; $i++) { 
			
			if($current_month == '0'){
				$current_month = 12;
				$current_year = $current_year - 1;
			}

			if($current_month < 10){
				$match_date = "$current_year-0$current_month";
			}
			else{
				$match_date = "$current_year-$current_month";
			}

			$membersResult = $DB->Row("SELECT count(id) as monthly_members FROM members WHERE created LIKE '%$match_date%'");
			

			$packages = $DB->Query("SELECT pid as pack_id, name as pack_name FROM package WHERE  visible = '1'");

			$packagesMembers = array();

			
			while( $package = $DB->NextRow($packages) ){

				
				$packagesMembersResult = $DB->Row("SELECT count(id) as monthly_pack_members,packageid FROM members WHERE created LIKE '%$match_date%' AND packageid = '".$package['pack_id']."'");

				$packagesMembers[$package['pack_id']]['count'] = $packagesMembersResult['monthly_pack_members'];
				$packagesMembers[$package['pack_id']]['name'] = $package['pack_name'];

			}

		
		
			$arrMonthlyMembers[$i]['month'] = date("M",strtotime("$match_date-01"));
			$arrMonthlyMembers[$i]['count'] = $membersResult['monthly_members'];
			$arrMonthlyMembers[$i]['packages'] = $packagesMembers;

			$current_month--;
		}
	}
    
	return $arrMonthlyMembers;
}



function GetPackageItemElements($id){

	global $DB;

    $result = $DB->Row("SELECT * FROM package_items WHERE itemid=".$id);
	
	return $result;
}

function DisplayCode($pid){

	print '<textarea style="width:600px" rows=5><? if(CP('.$pid.', $_SESSION) !=1){			header("location: /index.php?dll=subscribe");		} ?>	</textarea>';
}





function DisplayPackageCheck($id ='0'){
	if($id ==""){ $id=0; }
	global $DB;

    $result = $DB->Query("SELECT pid, name FROM package");
	$total = 1;
	print "<div style='margin-left: 30px;'>";
    while( $pack = $DB->NextRow($result) )
    {
		// SHOULD WE CHECK THIS BOX??
		$check = $DB->Row("SELECT * FROM package_items WHERE pid LIKE '%*".$pack['pid']."*%' AND itemid=".$id." limit 1");
		if(!empty($check)){
			print "<br><input class='radio' type='checkbox' value='on' name='c$total' checked> ".$pack['name']; //".$pack['pid']."
		}else{
			print "<br><input class='radio' type='checkbox' value='on' name='c$total'> ".$pack['name']; //".$pack['pid']."
		}

		print "<input type='hidden' class='hidden' value='".$pack['pid']."' name='cn$total'>";
		print "<br />";
		
		$total++;
	}
	print "</div>";
	
	print "<input type='hidden' class='hidden' class='hidden' name='TotalCheck' value='$total'>";
}

 
 

function DisplayGateways(){
	
	global $DB;
	$count=1;	
	$result = $DB->Query("SELECT * FROM merchant");

    while( $merchant = $DB->NextRow($result) )
    {
	
			print "<tr>";
			print "<td><input name='d".$count."' type='checkbox' value='on'><input type=hidden value='".$merchant['id']."' name=id".$count." class='hidden'></td>";	
			print "<td>".$merchant['name']."</td>
				<td>".$merchant['active']."</td>
				<td><a href='?p=gatewaycode&id=".$merchant['id']."'>Code</a></td>
				<td><a href='?p=fields&id=".$merchant['id']."'>Manage</a></td>
				<td><a href='?p=addgateway&id=".$merchant['id']."'>".icon_edit.$GLOBALS['lang_admin_edit']."</a></td>				
			</tr>";
			$count++;
	}
	print "<input type='hidden' class='hidden' value='".$count."' name='NumRows'>";
	
	return $count;
}

function DisplayRows($id){

	global $DB;
	$count =1;
	$result = $DB->Query("SELECT name, id, value FROM merchant_data WHERE mid=".$id);
	
    while( $code = $DB->NextRow($result) )
    {

			print "<tr>";
			print "<td><input name='d".$count."' type='checkbox' value='on'><input type=hidden value='".$code['id']."' name=id".$count." class='hidden'></td>";	
			print "<td>".$code['name']."</td>
				<td>".$code['value']."</td>
				<td><a href='?p=editfield&id=".$code['id']."'><img src='inc/images/icons/edit.png' align='absmiddle'> Edit</a></td>
			</tr>";
			$count++;
	}
	return $count;
}
function GetMetaData($id){

	global $DB;
	$count =0;
	$dataArray = array();
	$result = $DB->Query("SELECT name, id, value FROM merchant_data WHERE mid=".$id);
    while( $code = $DB->NextRow($result) )
    {
    	$dataArray[$count]['id'] = 	$code['id'];
    	$dataArray[$count]['name'] = $code['name'];
    	$dataArray[$count]['value'] = $code['value'];
		$count++;
	}
	return $dataArray;
}
function DisplayRow($id){

	global $DB;
	$result = $DB->Row("SELECT name, id, value FROM merchant_data WHERE id=".$id);
    
	return $result;
}


function EditField($id){

	global $DB;
	
	$result = $DB->Row("SELECT * FROM merchant WHERE id=".$id);
	
	return $result;
}

function DisplayGatewayCode($id){
	
	global $DB;
	
	$top = $DB->Row("SELECT action, method FROM merchant WHERE id=".$id);
	$result = $DB->Query("SELECT * FROM merchant_data WHERE mid=".$id);
	$text = "<form method='".$top['method']."' action='".$top['action']."'>\n";
    while( $code = $DB->NextRow($result) )
    {
		$text .= "<input type='".$code['type']."' value='".$code['value']."' name='".$code['name']."'>\n\n";
	}
	$text .= "</form>";
	return $text;
}

function DisplayAffiliateMembers($id){

	global $DB;

    $result = $DB->Query("SELECT * FROM aff_signup WHERE affiliate_id='".$id."' ORDER BY date DESC");

    while( $log = $DB->NextRow($result) )
    {
		print "	<tr class='table_array'>
                    <th>".GetUsername($log['member_id'])."</th>
                    <th>".$log['date']."</th>
					<th></th>
                  </tr>";
	}
	
}

function displayPending(){

	global $DB;
	
	$count=1;
    $result = $DB->Query("SELECT * FROM aff_payment WHERE status='unapproved'");

    while( $log = $DB->NextRow($result) )
    {
		print "	<tr>";
	    print "<td><input name='d".$count."' type='checkbox' value='on'><input type=hidden value='".$log['autoid']."' name=id".$count." class='hidden'></td>";	
        print "<td>".$log['date']."</td>
                  <td>".GetAffiliateName($log['affiliate_id'])."</td>
                  <td><a href='../index.php?dll=profile&pId=".$log['member_id']."'>".GetUsername($log['member_id'])."</a></td>
                  <td>".$log['total_due']."</td>
                  <td>".$log['status']."</td>
                  </tr>";
		$count++;
	}
	
	return $count;

}

function displayActive(){

	global $DB;
	
	$count=1;
    $result = $DB->Query("SELECT * FROM aff_payment WHERE status='approved'");

    while( $log = $DB->NextRow($result) )
    {
		print "<tr>";
		print "<td><input name='d".$count."' type='checkbox' value='on'><input type=hidden value='".$log['autoid']."' name=id".$count." class='hidden'></td>";
        print "<td>".$log['date']."</td>
                  <td>".GetAffiliateName($log['affiliate_id'])."</td>
                  <td>".GetUsername($log['member_id'])."</td>
                  <td>".$log['total_due']."</td>
        </tr>";
		
		$count++;
	}
	
	return $count;
}

function displayCanceled(){

	global $DB;
	
	$count=1;
    $result = $DB->Query("SELECT * FROM aff_payment WHERE status='canceled'");

    while( $log = $DB->NextRow($result) )
    {
		print "<tr>";
		print "<td><input name='d".$count."' type='checkbox' value='on'><input type=hidden value='".$log['autoid']."' name=id".$count." class='hidden'></td>";
        print "<td>".$log['date']."</td>
                  <td>".GetAffiliateName($log['affiliate_id'])."</td>
                  <td>".GetUsername($log['member_id'])."</td>
                  <td>".$log['total_due']."</td>
        </tr>";
		
		$count++;
	}
	
	return $count;

}

function GetAffiliateName($id){

	global $DB;

    $result = $DB->Row("SELECT Username FROM aff_members WHERE id=".strip_tags($id));

    return $result['Username'];
}
function BillItems($id){

	global $DB;

    $result = $DB->Row("SELECT * FROM members_billing WHERE id=".strip_tags($id));

    return $result;
}

function FieldLangs(){
   
	$ext = array("php");
    $files = array();
    ## Find files in root directory
   	$checkthisone = D_LANG.".php";
   if($handle = opendir(subd."inc/langs/")) {{
       while(false !== ($file = readdir($handle))){
           for($i=0;$i<sizeof($ext);$i++){


				if(strstr($file, ".".$ext[$i])){
					
					$pos = strpos($checkthisone, $file);  			   
					if($file != "english.php"){
							echo "<option value='$file'>$file</option>";
					}else{
							echo "<option value='$file' selected >$file - Default</option>";
					}
				  }		   
              		   
		   }
		 }					                      
       closedir($handle);
	} }
}

############################################################
#################### TEMPLATE   ############################
print $tdata[1]["contents"];
if($LoadAdminPlugin ==0){

		require_once "inc/temp/billing.php";

}else{

		if($PLUGINS_PAGE_TYPE =="html"){
			
			print $PLUGINS_PAGE_LINK;
			
		}elseif($PLUGINS_PAGE_TYPE =="link"){
			
			require_once (	$PLUGINS_PAGE_LINK 	);	
		}
}
print $tdata[2]["contents"]; 
$DB->Disconnect();
?>