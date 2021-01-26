<?php
header('Access-Control-Allow-Origin: *');
require_once("../inc/config.php");

$arrData = array();
if($_GET){
$iId = $_GET['uid'];
//AND members_network.approved = 'yes'
require_once("ion_app_function.php");

 $gallery_albums = DisplayAlbumsPic($iId);

      $i = 0;
// foreach($gallery_albums as $row){
//
//      $arrData[$i] = new StdClass;
//      $arrData[$i]->aid = $row['aid'];
//      $arrData[$i]->title = $row['title'];
//      $arrData[$i]->image = $row['image'];
//      $arrData[$i]->filecount = $row['filecount'];
//      $i++;
//
//  }

    echo json_encode($gallery_albums, JSON_UNESCAPED_SLASHES);
}
else {
     $arrData[0] = new StdClass;
     $arrData[0]->status = 'fail';
     echo json_encode($arrData, JSON_UNESCAPED_SLASHES);
}
?>
