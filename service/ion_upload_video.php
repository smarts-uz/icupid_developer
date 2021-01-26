<?php
header('Access-Control-Allow-Origin: *');
require_once("../inc/config.php");

$dirname = "../uploads/videos";

$postdata = file_get_contents("php://input");

	$request = json_decode($postdata);

  // $uid  = $_GET['uid'];
	// $aid  = $_GET['aid'];
  // $adult  = $_GET['adult'];
  // $title  = $_GET['title'];
  // $desc  = $_GET['desc'];


$arrData = array();
    $ran = rand();
    // If uploading file
    $imgsPath = "V".$uid.$ran.".mp4";
    $path = trim($dirname)."/".$imgsPath;
        //print_r($_FILES);
        if(move_uploaded_file($_FILES['videoFile']['tmp_name'], $path)) {
          $DB->Insert("INSERT INTO `files` ( `aid` , `uid` , `date`, `title`, `description` , `bigimage` , `approved` , `type` )
          VALUES ('".$_GET['aid']."', '".$_GET['uid']."' , '".DATE_NOW."', '".$_GET['title']."', '".$_GET['desc']."', '".$imgsPath."', 'yes', 'video')");

          $sSql = "UPDATE album SET `filecount` = `filecount`+1 WHERE `aid` = '".$_GET['aid']."'";
          mysql_query($sSql);

          $arrData[0] = new StdClass;
          $arrData[0]->status = 'Success';
          echo json_encode($arrData, JSON_UNESCAPED_SLASHES);
         }
         else{
              //echo "There was an error uploading the file, please try again!";
              $arrData[0] = new StdClass;
              $arrData[0]->status = 'There was an error uploading the file, please try again!';
              echo json_encode($arrData, JSON_UNESCAPED_SLASHES);
         }



?>
