<?php

// process.php

include"../../../inc/config.php";
global $DB;

error_reporting(0);

$errors         = array();       // array to hold validation errors

$data           = array();      // array to pass back data

// validate the variables ======================================================

//     // if any of these variables don't exist, add an error to our $errors array

// $url = "https://ropsten.etherscan.io/api?module=account&action=balance&address=".$_POST['name']."&tag=latest&apikey=R89BTPRFSCTVFUFHDUDUJDJIC2IP33FFGJ";

// $url = "https://rinkeby.etherscan.io/api?module=account&action=balance&address=".$_POST['name']."&tag=latest&apikey=X4UTSIVSM2J1ZAZD58JW5V4ZS12U9PKPP9";

$address = strtolower(strip_tags(trim($_REQUEST['name'])));

$adminAddress = strtolower(strip_tags(trim($_REQUEST['admin_address'])));

$apikey = strip_tags(trim($_REQUEST['apikey']));

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"http://www.presiam.com/wp-content/plugins/requitix_admin/api/getmerchantaccess.php");

curl_setopt($ch, CURLOPT_POST, 0);

curl_setopt($ch, CURLOPT_POSTFIELDS,

            "apikey=".$apikey);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec ($ch);

curl_close ($ch);

if ($server_output == 1){

$url = "https://api.etherscan.io/api?module=account&action=tokenbalance&contractaddress=0xffb55bc1f8c2dfd299d21836d2d115d5921021d6&address=".$address."&tag=latest&apikey=X4UTSIVSM2J1ZAZD58JW5V4ZS12U9PKPP9";

$json = @file_get_contents($url);

$json_data = json_decode($json, true);

foreach ($json_data as $k=>$v){

if ($k === 'result')

    {

$cal = $v/pow(10, 18);

        if (empty($address)) {

         echo  'AR';

         } 

        else {

                 if ($v == "Invalid address format")

                    {

                   echo 'IA|';

                    }

                     else if($cal >= $_REQUEST['eamount']){

                        echo  'AV| '. $cal.'|';

                $url = "https://api.etherscan.io/api?module=logs&action=getLogs&fromBlock=379224&toBlock=latest&address=0xffb55bc1f8c2dfd299d21836d2d115d5921021d6&topic0=0xddf252ad1be2c89b69c2b068fc378daa952ba7f163c4a11628f55a4df523b3ef&apikey=X4UTSIVSM2J1ZAZD58JW5V4ZS12U9PKPP9";

                $json = @file_get_contents($url);

                $tokens_result = json_decode($json, true);

                // print_r($json_data)

                    foreach ($tokens_result as $tr=>$tv){

                     if ($tr === 'result'){

                        // print_r($v);

                        foreach ($tv as $trans){

                        // echo $v2['address']."<br>";

                        $amountHex = hexdec($trans['data']);

                        $rqxAmount = $amountHex/pow(10, 18);

                        $trans_hash = $trans['transactionHash'];

                        $sender_hash = $trans['topics']['1'];

                        $senderAddress = substr_replace($sender_hash , "" , 2 , 24);

                        $receive_hash = $trans['topics']['2'];

                        $receiveAddress = substr_replace($receive_hash , "" , 2 , 24);

                        $timestamp2 = $trans['timeStamp'];

                        $contime = date('m/d/Y H:i:s', $timestamp2);

                        $tt = strtotime($contime);

                        $cc = strtotime('now');

                        $time_diff  = round($cc - $tt);

                        $minutes   = round($time_diff / 60);

                       }

                        if ($minutes <= '210' && $receiveAddress == $adminAddress ) {

                            if((int)$rqxAmount >= (int)$_REQUEST['eamount'] ){

                                // echo $receiveAddress." ".$senderAddress;

                                echo $senderAddress."|";

                                  if($senderAddress == $address) {


                                    $sql_count = "SELECT count(*) as exist FROM tbl_rating WHERE transaction_id = '$trans_hash' ";

                                    $count = $DB->Row($sql_count);


                                if($count['exist'] > 0) {

                                   echo "TRANSFOUND";
                                 }

                                 else{

                                    echo trim($trans_hash);


                                 }



                                      

                                  }else

                                  { 

                                    echo $address."|";

                                    echo $senderAddress."|";

                                     echo "VD|";

                                     // admin address and sender not match 

                                  }

                            }

                            else{

                                echo "ALP|";


                               
                                // amount less than product amount

                            }

                        }

                        else{


                          echo '0';

                          // reach 30 mins limit

                       }

                 }

                }

                    }

                    else  {

                     echo 'AVT-Failed|'.$cal;

                    }

             } // empty address else close 

     } //for each close

} // result if close

}

else if($server_output == 0)

{

echo "api_error";

}