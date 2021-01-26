<?php
header('Access-Control-Allow-Origin: *');

require_once("../inc/config.php");

global $DB;

$arrData = array();

  $mobile = $DB->Row("SELECT id, mobile_image, page_contents FROM mobile_admin LIMIT 1");

  if($mobile['mobile_image']){

        $arrData[0] = new StdClass;
        $arrData[0]->status = "success";
        $arrData[0]->mobile_image = $mobile['mobile_image'];
        $arrData[0]->page_contents = $mobile['page_contents'];
	  	$arrData[0]->pppid = PAYPAL_ENVIRONMENT_PRODUCTION;
        $arrData[0]->ppsid = PAYPAL_ENVIRONMENT_SANDBOX;
	  
	    if(PAYPAL_LIVE == 'yes')
			$arrData[0]->pplive = 'PayPalEnvironmentProduction';
	  	else
			$arrData[0]->pplive = 'PayPalEnvironmentSandbox';
	  
  }else{

    	$arrData[0] = new StdClass;
        $arrData[0]->status = "fail";
  }

echo json_encode($arrData, JSON_UNESCAPED_SLASHES);

?>
