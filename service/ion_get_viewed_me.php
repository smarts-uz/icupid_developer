<?php
header('Access-Control-Allow-Origin: *');
require_once("../inc/config.php");

$arrData = array();
if($_GET){
$id = $_GET['uid'];
//AND members_network.approved = 'yes'
global $DB;



## define variables

$count=0; $todayDate = date("D");	$ReturnString = "";




for($i=0;$i!=30;$i++){

    ## make query for this date
    $SearchDate = date("Y-m-d",mktime(0, 0, 0, date("m")  , date("d")-$i, date("Y")));

    $result = $DB->Query("SELECT album.cat, files.aid, files.type, files.adult_content, files.approved, files.bigimage, members.username, members_data.location, visited.uid, visited.date
    FROM
    members
    INNER JOIN visited ON (visited.uid = members.id AND visited.uid != ".$id.")
    LEFT JOIN files ON (files.uid = members.id AND files.default=1)
    LEFT JOIN members_data ON (members_data.uid = members.id)
    LEFT JOIN album ON (album.aid = files.aid)
    WHERE visited.view_uid= ( '".$id."' ) AND visited.date LIKE '%".$SearchDate."%' GROUP BY visited.uid ORDER BY visited.date DESC LIMIT 200");

      $j=0;


      while( $history = $DB->NextRow($result) ){

        $arrData[$j] = new StdClass;
        $arrData[$j]->uid = $history['uid'];
        $arrData[$j]->thumb = DB_DOMAIN."inc/tb.php?src=".$history['bigimage'];
        $arrData[$j]->username = $history['username'];
        $arrData[$j]->location = $history['location'];
        $j++;
      }




}



## return output for display

//return $ReturnString;

    echo json_encode($arrData, JSON_UNESCAPED_SLASHES);
}
else {
     $arrData[0] = new StdClass;
     $arrData[0]->status = 'fail';
     echo json_encode($arrData, JSON_UNESCAPED_SLASHES);
}
?>
