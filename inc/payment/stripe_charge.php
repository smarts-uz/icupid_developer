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

$subd = "../../"; 
require_once $subd . "inc/config.php";

require_once $subd . "plugins/plugins/stripe/init.php";
  
require_once $subd . "inc/API/api_functions.php";
require_once $subd . "inc/func/func_login.php";
require_once $subd . "inc/func/globals.php";
 
  
  $stripe_mode = $DB->Row("SELECT md.value as mode FROM merchant_data md, merchant m WHERE md.mid = m.id and m.name='Stripe' and md.name like 'stripe_mode'");

  if(isset($stripe_mode['mode'])){
    if($stripe_mode['mode'] == 'Live'){
      $secret = 'live_secret';
      $publishable = 'live_publishable';
    }
    else if($stripe_mode['mode'] == 'Test'){
      $secret = 'test_secret';
      $publishable = 'test_publishable';


    }
  }

  $secret = $DB->Row("SELECT value FROM merchant_data md, merchant m WHERE md.mid = m.id and m.name='Stripe' and md.name like '$secret'");
  $publishable = $DB->Row("SELECT value FROM merchant_data WHERE mid='6' and name like '$publishable'");
  $member = $DB->Row("SELECT * FROM members WHERE id='".$_SESSION['uid']."'");
  


  $token  = $_POST['stripeToken'];
  $customer_id = $_POST['user_id'];

  
  \Stripe\Stripe::setApiKey($secret['value']);

  /*$customer = \Stripe\Customer::create(array(
      'email' =>  $member['email'],
      'source'  => $token
  ));*/

  $charge = \Stripe\Charge::create(array(
      'amount'   => $_POST['amount'],
      'currency' => $_POST['currency'],
      'source' => $token, // obtained with Stripe.js,
      'metadata' => array("package_id" => $_POST['packageId'] , 'user_id' => $_SESSION['uid'])
  ));


//inc/API/api_functions.php
  if($charge->status == 'succeeded'){
    if($charge->metadata['package_id'] == 'credits'){
      AddCredits($charge->metadata['user_id'], $charge->metadata['package_id'], "Stripe", $charge->source['name'], $charge->balance_transaction);
    }
    else{
      AddOrder($charge->metadata['user_id'], $charge->metadata['package_id'], "Stripe", $charge->source['name'], $charge->balance_transaction);
      ChangeUpgrade($charge->metadata['user_id']);
      
    }
    header("location: ".getThePermalink('order/thankyou'));
  }
  else{
    StopSubscription($charge->balance_transaction);
    header("location: ".getThePermalink('order/cancel'));
  }

?>