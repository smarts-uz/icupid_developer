<?php
/**
 * api: iCupid Dating Software
 * title: Authorize.net Payment Add-On
 * description: This add-on will setup Authorize.net postback logic to your website.
 * type: functions
 * category: Payment Gateways
 * author: AdvanDate, LLC
 * url: http://www.authorize.net
 * license: iCupid 11.3
 * provides: paypal
 * hooks: sidebar
 * version: 9.0
 * sort: 10
 * updated: October 1st 2015
 */



///////////////////////////////////////////////////////////////////////////////////////////
// PYMENT CALLBACK (AFTER PAYMENT IS MADE)
///////////////////////////////////////////////////////////////////////////////////////////
if(isset($_POST['x_response_code'])){


			$string="";
			foreach($_POST as $key => $value){
				 $string .= $key." == ".$value." <br>";
			}
				
			// SEND POSTBACK DATA TO ADMIN FOR STORING
			$text = "";
			$html = $string;
			$DB_MAIL = new htmlMimeMail();
			$DB_MAIL->setHtml($html, $text);
			$DB_MAIL->setReturnPath(ADMIN_EMAIL);
			$DB_MAIL->setFrom('"'.ADMIN_EMAIL.'" <'.ADMIN_EMAIL.'>');
			$DB_MAIL->setSubject("Authorize.net POSTBACK DATA");
			$DB_MAIL->setHeader('X-Mailer', 'eMeeting Dating Software');
			$result = $DB_MAIL->send(array(ADMIN_EMAIL));
			//$result = $DB_MAIL->send(array('contact@advandate.com'));			
			@ini_restore(sendmail_from);

			

			$OrderID 	= trim($_POST['x_cust_id']);
			$ORDER_PARTS = explode("**", $OrderID);
			$PackageID 	=  $ORDER_PARTS[1];
			$UserID 	=  $ORDER_PARTS[0];
			
            if ($_POST['x_response_code'] == "1"){
                 
				// Transaction is complete. It means that the amount was paid successfully.
						
				 AddOrder($UserID, $PackageID, "AuthorizeNet", $_POST['x_email'], $_POST['x_trans_id']);

            }
			

}

?>