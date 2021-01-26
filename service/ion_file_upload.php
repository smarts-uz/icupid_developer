<?php
header('Access-Control-Allow-Origin: *');
require_once("../inc/config.php");

$dirname = "../uploads/images";
$dirnameThumb = "../uploads/thumbs";
$arrData = array();
    $ran = rand();
    // If uploading file
    if ($_FILES) {
        //print_r($_FILES);

    	list($w, $h) = getimagesize($_FILES["file"]["tmp_name"]);
      /* calculate new image size with ratio */
      $width = 900;
      $height = 900;
      $ratio = max($width/$w, $height/$h);
      $h = ceil($height / $ratio);
      $x = ($w - $width / $ratio) / 2;
      $w = ceil($width / $ratio);
      /* new file name */
      $imgsPath = "SS".$_POST['uid'].$ran.".jpg";

      $path = trim($dirname)."/".$imgsPath;
      $pathThumb = trim($dirnameThumb)."/".$imgsPath;
      /* read binary data from image file */
      $imgString = file_get_contents($_FILES['file']['tmp_name']);
      /* create image from string */
      $image = imagecreatefromstring($imgString);
      $tmp = imagecreatetruecolor($width, $height);
      imagecopyresampled($tmp, $image,
        0, 0,
        $x, 0,
        $width, $height,
        $w, $h);
      /* Save image */
      switch ($_FILES['file']['type']) {
        case 'image/jpeg':
          imagejpeg($tmp, $path, 60);
          imagejpeg($tmp, $pathThumb, 60);
          break;
        case 'image/png':
          imagepng($tmp, $path, 0);
          break;
        case 'image/gif':
          imagegif($tmp, $path);
          break;
        default:
          exit;
          break;
      }

      $DB->Insert("INSERT INTO `files` ( `aid` , `uid` , `date` , `bigimage` , `approved` , `type` )
      VALUES ('".$_POST['aid']."', '".$_POST['uid']."' , '".DATE_NOW."', '".$imgsPath."', '".APPROVE_FILES."', 'photo')");

      $sSql = "UPDATE album SET `filecount` = `filecount`+1 WHERE `aid` = '".$_POST['aid']."'";
      mysql_query($sSql);

  //    $size = filesize($tmp);
      //return $path;
      $arrData[0] = new StdClass;
      $arrData[0]->status = 'success';
      echo json_encode($arrData, JSON_UNESCAPED_SLASHES);

      /* cleanup memory */
      imagedestroy($image);
      imagedestroy($tmp);
    }
?>
