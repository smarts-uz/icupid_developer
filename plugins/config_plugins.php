<?php
include_once("plugins/payment_2checkout.php");
$Sample_Value["name"] = 'Sample Value';
$Paypal["ID"] = 'advandate@gmail.com';
include_once("plugins/payment_paypal.php");
$Google_Analytics["Code"] = 'UA-106328487-1';
include_once("plugins/payment_paymate.php");
include_once("plugins/payment_nochex.php");
include_once("plugins/payment_saferpay.php");
include_once("plugins/plugin_providesupport.php");
include_once("plugins/payment_ccbill.php");
include_once("plugins/payment_verotel.php");
include_once("plugins/payment_alertpay.php");
include_once("plugins/payment_worldpay.php");
$CCBill["ID"] = 948511;
include_once("plugins/payment_authorize.php");
include_once("plugins/plugin_mgal.php");
include_once("plugins/plugin_stripe.php");
$Stripe["TS"] = 'sk_test_s1p9oB0cN3YJPJdL4AvDQ6jr';
$Stripe["TP"] = 'pk_test_LKjAHiMBhLEkO268238OVP8r';
$Stripe["LS"] = 'sk_live_piQDlC1Y3SLAs9PRDKfKxG9d';
$Stripe["LP"] = 'pk_live_vC3E8vyILsvhx7AluxLan1Kz';
$Stripe["M"] = 'Test';
//include_once("plugins/white-label-dating/plugin_wld.php");
include_once("plugins/plugin_admin_approve.php");


?>