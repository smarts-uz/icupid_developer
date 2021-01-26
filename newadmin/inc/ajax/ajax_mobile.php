<?php

if(!session_id())session_start();
if (!isset($loginSet) && ( !isset($_SESSION['admin_auth'])  || $_SESSION['admin_auth'] != "yes" ) )  {
	header("location: index.php");
	exit();
}
require_once "../../../inc/config.php";
require_once "../config.php";



$output = array();

if(isset($_FILES["mobile_splash"]) && $_FILES["mobile_splash"]["name"] != ''){
$file_name = time() .basename($_FILES["mobile_splash"]["name"]);
$target_dir = $_SERVER["DOCUMENT_ROOT"]."/uploads/mobile/";
$target_file = $target_dir . $file_name;
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image

$check = getimagesize($_FILES["mobile_splash"]["tmp_name"]);
if($check !== false) {
    //echo "File is an image - " . $check["mime"] . ".";
    $output['status'] = 1;
    $uploadOk = 1;
} else {
    $output['err'] = "File is not an image.";
    $output['status'] = 0;
    $uploadOk = 0;
    }


// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $output['status'] = 0;
    $uploadOk = 0;
}
// Check file size
if ($_FILES["mobile_splash"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $output['status'] = 0;
    $uploadOk = 0;
}

list($width, $height) = getimagesize($_FILES["mobile_splash"]["tmp_name"]);

if($width != '400' || $height != '700'){
	$output['err'] = "Sorry, image dimensions should be 400px x 700px";
    $output['status'] = 0;
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    $output['err'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $output['status'] = 0;
    $uploadOk = 0;
}

}
else{
  $uploadOk = 2;  
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    //$output['err'] = "Sorry, your file was not uploaded.";
    $output['status'] = 0;
    $uploadOk = 0;
    $DB->Update("UPDATE mobile_admin SET page_contents ='".$_POST['mobile_about_us']."'");
// if everything is ok, try to upload file
}
else if ($uploadOk == 2) {
    //$output['err'] = "Sorry, your file was not uploaded.";
    $output['status'] = 1;
    $uploadOk = 2;
    $DB->Update("UPDATE mobile_admin SET page_contents ='".$_POST['mobile_about_us']."'");
    $img = $DB->Row("SELECT mobile_image FROM mobile_admin"); 
    
    $output['file'] = $img['mobile_image'];
    $output['success'] = "The contents has been updated.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["mobile_splash"]["tmp_name"], $target_file)) {
    	$output['success'] = "The image has been uploaded.";
    	$output['status'] = 1;

    	$output['file'] = "/uploads/mobile/".$file_name;
		
		$DB->Update("UPDATE mobile_admin SET page_contents ='".$_POST['mobile_about_us']."',mobile_image ='".DB_DOMAIN."uploads/mobile/".$file_name."'");       
    } else {
    	$output['err'] = "Sorry, there was an error uploading your file.";
        $output['status'] = 0;
    }
}



echo json_encode($output);
?>