<?php
header('Access-Control-Allow-Origin: *');
require_once("../inc/config.php");

$arrData = array();
if($_POST){

$profile = $_POST;

mysql_query("UPDATE members_data SET `em_txg20080113` = '".$profile['religion']."', `em_72220080113` = '".$profile['employment']."', `em_kjc20080113` = '".$profile['income']."', `em_s1620080113` = '".$profile['education']."', `em_rn620080113` = '".$profile['wantchildren']."', `em_kxb20080113` = '".$profile['havechildren']."', `em_qck20080113` = '".$profile['personality']."', `em_r9720080113` = '".$profile['romantic']."' WHERE `uid` = '".$profile['uid']."'");


$arrData[0] = new StdClass;
$arrData[0]->status = 'success';
echo json_encode($arrData, JSON_UNESCAPED_SLASHES);

}
else {
     $arrData[0] = new StdClass;
     $arrData[0]->status = 'fail';
     echo json_encode($arrData, JSON_UNESCAPED_SLASHES);
}

?>
