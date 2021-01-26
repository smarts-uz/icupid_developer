<?php
header('Access-Control-Allow-Origin: *');
require_once("../inc/config.php");

global $DB;

$arrData = array();

if($_POST){
  $oldpass = $_POST['oldpass'];
  $password = $_POST['password'];
  $uid = $_POST['uid'];

  $pw = $DB->Row("SELECT password FROM members WHERE id= ( '".$uid."' ) LIMIT 1");



if( ( D_MD5 ==1 && md5($oldpass) == $pw['password']) || ( $oldpass == $pw['password'] ) ){



if(D_MD5 ==1){

  $passcode = md5($password);

}else{

  $passcode = $password;

}



$DB->Update("UPDATE members SET password='".$passcode."' WHERE id= ( '".$uid."' ) LIMIT 1");


/* END FORUM INTEGRATION */



  $arrData[0] = new StdClass;
  $arrData[0]->msg = "Password Updated";



}else{


  $arrData[0] = new StdClass;
  $arrData[0]->msg = "Your current password does not match";



}
echo json_encode($arrData, JSON_UNESCAPED_SLASHES);
}
else {
  $arrData[0] = new StdClass;
  $arrData[0]->msg = "Ooops!";
  echo json_encode($arrData, JSON_UNESCAPED_SLASHES);
}
?>
