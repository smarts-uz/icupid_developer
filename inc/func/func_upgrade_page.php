<?php 
function DisplayPackages(){
	
	global $DB;
	global $LANG_BODY;
$RunningCount=1;
$PAckageDataArray = array();

$top = $DB->Query("SELECT SMS_credits, package.pid, name, price, icon, package.comments, currency_code, numdays,caption FROM package LEFT JOIN package_languages on package.pid = package_languages.pid and language = '".$_SESSION['lang']."' WHERE visible='1' and type='custom' order by price asc");



while( $code = $DB->NextRow($top) ){

    $PAckageDataArray[$RunningCount]['id']             =   $code['pid'];
    $PAckageDataArray[$RunningCount]['comments']     =     $code['comments'];
    $PAckageDataArray[$RunningCount]['price']         =    $code['price'];
    $PAckageDataArray[$RunningCount]['currency']     =    $code['currency_code'];
    $PAckageDataArray[$RunningCount]['icon']         =    $code['icon'];
    $PAckageDataArray[$RunningCount]['name']         =    ($code['caption'] != "") ? 
      $code['caption'] : $code['name'] ;
   	//$PAckageDataArray[$RunningCount]['name'] 		=	$code['name'];
	$PAckageDataArray[$RunningCount]['credits'] 	=	$code['SMS_credits'];
    ## DISPLAY UPGRADE PERIOD
    if($code['numdays'] < 2){
        $timeCap = $LANG_BODY['_day'];
        $timeperiod  = $code['numdays'];
    }elseif($code['numdays'] < 8){
        $timeCap = $LANG_BODY['_days'];          
        $timeperiod  = $code['numdays'];
    }elseif($code['numdays'] < 30){
        $timeCap = $LANG_BODY['_weeks'];            
        $timeperiod = $code['numdays']/7;
    }elseif($code['numdays'] < 32){
        $timeCap = $LANG_BODY['_month'];
        $timeperiod = $code['numdays']/30;
    }elseif($code['numdays'] < 900){
        $timeCap = $LANG_BODY['_months'];
        $timeperiod = $code['numdays']/30;

    }elseif($code['numdays'] == "2147483647"){
        $timeCap = "unlimited time";
        $timeperiod="";
    }

    $PAckageDataArray[$RunningCount]['time_type']             =    $timeCap;
    $PAckageDataArray[$RunningCount]['time_period']         =    $timeperiod;
    $RunningCount++;
}

return $PAckageDataArray;
}

function DisplayPaymentCode(){

	global $DB;
	$PAckageDataArray = array();
	$RunningCount=1;
	$top = $DB->Query("SELECT id, action, method, title, name, icon, comments FROM merchant WHERE active='yes'");

	while( $code = $DB->NextRow($top) ){
	
		$PAckageDataArray[$RunningCount]['id'] 			=  	$code['id'];
		$PAckageDataArray[$RunningCount]['name'] 		=  	$code['name'];
		$PAckageDataArray[$RunningCount]['title'] 		=  	$code['title'];
		$PAckageDataArray[$RunningCount]['icon'] 		=  	$code['icon'];
		$PAckageDataArray[$RunningCount]['action'] 		=  	$code['action'];
		$RunningCount++;
	}
	
	return $PAckageDataArray;

}

function DisplayPaymentMetadata($id){

	global $DB;
	$PAckageDataArray = array();
	$top = $DB->Query("SELECT * FROM merchant_data WHERE mid='$id'");

	while( $code = $DB->NextRow($top) ){
		$PAckageDataArray[$code['name']] = $code['value'];
	}
	
	return $PAckageDataArray;

}

function DisplayBankPayment(){

	global $DB;
	$PAckageDataArray = array();
	$RunningCount=1;
	$top = $DB->Query("SELECT merchant_data.name, merchant_data.value FROM merchant_data, merchant WHERE merchant_data.mid = merchant.id AND merchant.action='bank'");

	while( $code = $DB->NextRow($top) ){
	
		$PAckageDataArray[$RunningCount]['name'] 		=  	$code['name'];
		$PAckageDataArray[$RunningCount]['value'] 		=  	$code['value'];
		$RunningCount++;
	}
	
	return $PAckageDataArray;

}

function DisplayBankPrice($packageID){

	global $DB;

	$top = $DB->Row("SELECT currency_code, price FROM package WHERE pid= ('".$packageID."') LIMIT 1");

	return $top;

}
?>