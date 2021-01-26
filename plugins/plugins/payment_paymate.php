<?php
/**
 * api: iCupid Dating Software
 * title: PayMate IPN Add-on
 * description: Allows you to automatically update your membership packages when taking payment using the IPN system from Paymate.
 * type: functions
 * category: Payment Gateways
 * author: AdvanDate, LLC
 * url: http://www.paymate.com
 * license: iCupid 11.3
 * config:
 * provides: PayMate
 * hooks: sidebar
 * version: 9.0
 * sort: 10
 * updated: April 5th 2016
 */
if(isset($_POST["billingPostcode"])){

		 
		//if (!strstr($response, "AUTHORISED")) {
		
			$OrderID 	= trim($_POST['ref']);
			$ORDER_PARTS = explode("**", $OrderID);
			$PackageID 	=  $ORDER_PARTS[1];
			$UserID 	=  $ORDER_PARTS[0];			
       
			// Transaction is complete. It means that the amount was paid successfully.
						
				 AddOrder($UserID, $PackageID, "PayMate", $_POST['buyerEmail'], $_POST["transactionID"]);

		//}
			
	///////////////////// FUNCTIONS ///////////////////////
	///////////////////////////////////////////////////////

	
}	
?>