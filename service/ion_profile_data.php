<?php
header('Access-Control-Allow-Origin: *');
require_once("../inc/config.php");

$arrData = array();
if($_GET){
$uid = $_GET['uid'];
require_once("ion_app_function.php");
$match_profile_array = GetProfileData($uid,'',1);
//print_r($match_profile_array);
print_r(GetProfileData($uid));
  // $arrData[0] = new StdClass;
  // $arrData[0]->msg = $match_profile_array;
  // $arrData[0]->islogin = "yes";
  // echo json_encode($arrData);
}
else {
  $arrData[0] = new StdClass;
  $arrData[0]->msg = "Ooops!";
  $arrData[0]->islogin = "no";
  echo json_encode($arrData, JSON_UNESCAPED_SLASHES);
}
?>
