<?php
header('Access-Control-Allow-Origin: *');
require_once("../inc/config.php");
require_once("../inc/API/api_functions.php");

$row = MemberAccountDetails('411126', false,"profile");
print_r($row);

?>
