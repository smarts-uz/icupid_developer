<?php
header('Access-Control-Allow-Origin: *');
require_once("../inc/config.php");

$arrData = array();
if($_GET){
$iId = $_GET['uid'];
//AND members_network.approved = 'yes'
require_once("ion_app_function.php");

 $gallery_albums = DisplayAllPic($iId);

      $i = 0;
    echo json_encode($gallery_albums, JSON_UNESCAPED_SLASHES);
}
else {
     $arrData[0] = new StdClass;
     $arrData[0]->status = 'fail';
     echo json_encode($arrData, JSON_UNESCAPED_SLASHES);
}
?>
