<?php
header('Access-Control-Allow-Origin: *');
require_once("../inc/config.php");

$arrData = array();
if($_GET){

$profile = $_GET;
$query = "UPDATE members_network SET `type` = '".$profile['type']."' WHERE `uid` = '".$profile['uid']."' AND `to_uid` = '".$profile['fid']."'";
mysql_query($query);


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
