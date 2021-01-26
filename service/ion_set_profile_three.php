<?php
header('Access-Control-Allow-Origin: *');
require_once("../inc/config.php");

$arrData = array();
if($_POST){

$profile = $_POST;

mysql_query("UPDATE members_data SET `em_1k820080113` = '".$profile['yheight']."', `em_heh20080113` = '".$profile['ybuild']."', `em_93n20080113` = '".$profile['hcolor']."', `em_jsh20080113` = '".$profile['ecolor']."', `em_jhb20080113` = '".$profile['hlength']."', `em_yh020080113` = '".$profile['methnicity']."', `em_7jr20080113` = '".$profile['pappearance']."', `em_wvh20080113` = '".$profile['mstyle']."', `em_vqf20080113` = '".$profile['afeature']."' WHERE `uid` = '".$profile['uid']."'");


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
