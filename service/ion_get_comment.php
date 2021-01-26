<?php
header('Access-Control-Allow-Origin: *');
require_once("../inc/config.php");

$arrData = array(); 
if($_GET){
$iId = $_GET['uid'];
//AND members_network.approved = 'yes'
$sSql = "SELECT DISTINCT comments.id AS id, members.id AS uid, members.username, files.bigimage, comments.comments, comments.date, comments.time, comments.approved FROM comments LEFT JOIN members ON ( comments.from_uid = members.id ) LEFT JOIN files ON ( files.uid = comments.from_uid AND files.default=1) WHERE comments.to_uid = '".$iId."' ORDER BY comments.approved = 'yes'";
 //require_once("ion_app_function.php");
 $result = mysql_query($sSql);

      $i = 0;
while ($row = mysql_fetch_assoc($result))
 {
    // user Data
//$mad = MemberAccountDetails($row['mid']);

     $arrData[$i] = new StdClass;
     $arrData[$i]->id = $row['id'];
     $arrData[$i]->uid = $row['uid'];
     $arrData[$i]->thumb = DB_DOMAIN."inc/tb.php?src=".$row['bigimage'];
     $arrData[$i]->username = $row['username'];
     $arrData[$i]->comments = $row['comments'];
	 $arrData[$i]->approved = $row['approved'];
     $arrData[$i]->date = $row['date'];
     $arrData[$i]->time = $row['time'];
     $i++;

 }

    echo json_encode($arrData, JSON_UNESCAPED_SLASHES);
}
else {
     $arrData[0] = new StdClass;
     $arrData[0]->status = 'fail';
     echo json_encode($arrData, JSON_UNESCAPED_SLASHES);
}
?>
