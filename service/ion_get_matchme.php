<?php
header('Access-Control-Allow-Origin: *');
require_once("../inc/config.php");
global $DB;
$arrData = array();
if($_GET){
$iId = $_GET['uid'];

$MData = $DB->Row("SELECT match_array FROM members_privacy WHERE uid= ( '".$iId."' ) LIMIT 1");
if($MData['match_array'])
{
	$get_row = unserialize($MData['match_array']);
	$qeryMatch = "";
	$qeryAge = "";
	//print_r($rows);

$i = 0;
	  foreach($get_row as $rows){
		if (array_key_exists($i, $rows))
		{
			if($rows[$i]['value'])
			{
			if($rows[$i]['name'] == 'age')
				$qeryAge = $rows[0]['value'];
			 else
			$qeryMatch .= " AND members_data.".$rows[$i]['name']." = '".$rows[$i]['value']."'";
			}
		}	
		 $i++;

	 }	
	
	//echo count($row);
	//if(count($rows)>= 0)	
//	if (array_key_exists(0, $rows))
//	{
//		if($rows[0]['value'])
//		{
//		if($rows[0]['name'] == 'age')
//			$qeryAge = $rows[0]['value'];
//		 else
//		$qeryMatch .= " AND members_data.".$rows[0]['name']." = '".$rows[0]['value']."'";
//		}
//	}
//	
//	if (array_key_exists(1, $rows))	
//	{
//		if($rows[1]['value'])
//		{
//		if($rows[1]['name'] == 'age')
//			$qeryAge = $rows[1]['value'];
//		 else
//		$qeryMatch .= " AND members_data.".$rows[1]['name']." = '".$rows[1]['value']."'";
//		}
//	}
//	if (array_key_exists(2, $rows))	
//	{
//		if($rows[2]['value'])
//		{
//		if($rows[2]['name'] == 'age')
//				$qeryAge = $rows[2]['value'];
//		 else
//		$qeryMatch .= " AND members_data.".$rows[2]['name']." = '".$rows[2]['value']."'";
//			}
//	}
//	if (array_key_exists(3, $rows))	
//	{
//		if($rows[3]['value'])
//		{
//		if($rows[3]['name'] == 'age')
//				$qeryAge = $rows[3]['value'];
//		 else
//		$qeryMatch .= " AND members_data.".$rows[3]['name']." = '".$rows[3]['value']."'";
//			}
//	}
//	if (array_key_exists(4, $rows))	
//	{
//		if($rows[4]['value'])
//		{
//		if($rows[4]['name'] == 'age')
//				$qeryAge = $rows[4]['value'];
//		 else
//		$qeryMatch .= " AND members_data.".$rows[4]['name']." = '".$rows[4]['value']."'";
//			}
//	}
//	if (array_key_exists(5, $rows))
//	{
//		if($rows[5]['value'])
//		{
//		if($rows[5]['name'] == 'age')
//				$qeryAge = $rows[5]['value'];
//		 else
//		$qeryMatch .= " AND members_data.".$rows[5]['name']." = '".$rows[5]['value']."'";
//		}
//	}
//	if (array_key_exists(6, $rows))
//	{
//		if($rows[6]['value'])
//		{
//		if($rows[6]['name'] == 'age')
//				$qeryAge = $rows[6]['value'];
//		 else
//		$qeryMatch .= " AND members_data.".$rows[6]['name']." = '".$rows[6]['value']."'";
//			}
//	}
//	if (array_key_exists(7, $rows))
//	{
//		if($rows[7]['value'])
//		{
//		if($rows[7]['name'] == 'age')
//				$qeryAge = $rows[7]['value'];
//		 else
//		$qeryMatch .= " AND members_data.".$rows[7]['name']." = '".$rows[7]['value']."'";
//			}
//	}
//	if (array_key_exists(8, $rows))
//	{
//		if($rows[8]['value'])
//		{
//		if($rows[8]['name'] == 'age')
//				$qeryAge = $rows[8]['value'];
//		 else
//		$qeryMatch .= " AND members_data.".$rows[8]['name']." = '".$rows[8]['value']."'";
//		}
//	}
//	if (array_key_exists(9, $rows))
//	{
//		if($rows[9]['value'])
//		{
//		if($rows[9]['name'] == 'age')
//				$qeryAge = $rows[9]['value'];
//		 else
//		$qeryMatch .= " AND members_data.".$rows[9]['name']." = '".$rows[9]['value']."'";
//			}
//	}
//	if (array_key_exists(10, $rows))
//	{
//		if($rows[10]['value'])
//		{
//		if($rows[10]['name'] == 'age')
//				$qeryAge = $rows[10]['value'];
//		 else
//		$qeryMatch .= " AND members_data.".$rows[10]['name']." = '".$rows[10]['value']."'";
//			}
//	}
//	if (array_key_exists(11, $rows))
//	{
//		if($rows[11]['value'])
//		{
//		if($rows[11]['name'] == 'age')
//				$qeryAge = $rows[11]['value'];
//		 else
//		$qeryMatch .= " AND members_data.".$rows[11]['name']." = '".$rows[11]['value']."'";
//			}
//	}
//	if (array_key_exists(12, $rows))
//	{
//		if($rows[12]['value'])
//		{
//		if($rows[12]['name'] == 'age')
//				$qeryAge = $rows[12]['value'];
//		 else
//		$qeryMatch .= " AND members_data.".$rows[12]['name']." = '".$rows[12]['value']."'";
//			}
//	}
//	if (array_key_exists(13, $rows))
//	{
//		if($rows[13]['value'])
//		{
//		if($rows[13]['name'] == 'age')
//				$qeryAge = $rows[13]['value'];
//		 else
//		$qeryMatch .= " AND members_data.".$rows[13]['name']." = '".$rows[13]['value']."'";
//			}
//	}
//	if (array_key_exists(14, $rows))
//	{
//		if($rows[14]['value'])
//		{
//		if($rows[14]['name'] == 'age')
//				$qeryAge = $rows[14]['value'];
//		 else
//		$qeryMatch .= " AND members_data.".$rows[14]['name']." = '".$rows[14]['value']."'";
//			}
//	}
//	if (array_key_exists(15, $rows))
//	{
//		if($rows[15]['value'])
//		{
//		if($rows[15]['name'] == 'age')
//				$qeryAge = $rows[15]['value'];
//		 else
//		$qeryMatch .= " AND members_data.".$rows[15]['name']." = '".$rows[15]['value']."'";
//			}
//	}
//	if (array_key_exists(16, $rows))
//	{
//		if($rows[16]['value'])
//		{
//		if($rows[16]['name'] == 'age')
//				$qeryAge = $rows[16]['value'];
//		 else
//		$qeryMatch .= " AND members_data.".$rows[16]['name']." = '".$rows[16]['value']."'";
//			}
//	}
//	if (array_key_exists(17, $rows))
//	{
//		if($rows[17]['value'])
//		{
//		if($rows[17]['name'] == 'age')
//				$qeryAge = $rows[17]['value'];
//		 else
//		$qeryMatch .= " AND members_data.".$rows[17]['name']." = '".$rows[17]['value']."'";
//			}
//	}
//	if (array_key_exists(18, $rows))
//	{
//		if($rows[18]['value'])
//		{
//		if($rows[18]['name'] == 'age')
//				$qeryAge = $rows[18]['value'];
//		 else
//		$qeryMatch .= " AND members_data.".$rows[18]['name']." = '".$rows[18]['value']."'";
//			}
//	}
//	if (array_key_exists(19, $rows))
//	{
//		if($rows[19]['value'])
//		{
//		if($rows[19]['name'] == 'age')
//				$qeryAge = $rows[19]['value'];
//		 else
//		$qeryMatch .= " AND members_data.".$rows[19]['name']." = '".$rows[19]['value']."'";
//			}
//	}
//	if (array_key_exists(20, $rows))
//	{
//		if($rows[20]['value'])
//		{
//		if($rows[20]['name'] == 'age')
//				$qeryAge = $rows[20]['value'];
//		 else
//		$qeryMatch .= " AND members_data.".$rows[20]['name']." = '".$rows[20]['value']."'";
//			}
//	}
//	if (array_key_exists(21, $rows))
//	{
//		if($rows[21]['value'])
//		{
//		if($rows[21]['name'] == 'age')
//				$qeryAge = $rows[21]['value'];
//		 else
//		$qeryMatch .= " AND members_data.".$rows[21]['name']." = '".$rows[21]['value']."'";
//			}
//	}
//	if (array_key_exists(22, $rows))
//	{
//		if($rows[22]['value'])
//		{
//		if($rows[22]['name'] == 'age')
//				$qeryAge = $rows[22]['value'];
//		 else
//		$qeryMatch .= " AND members_data.".$rows[22]['name']." = '".$rows[22]['value']."'";
//			}
//	}
//	if (array_key_exists(23, $rows))
//	{
//		if($rows[23]['value'])
//		{
//		if($rows[23]['name'] == 'age')
//			$qeryAge = $rows[23]['value'];
//		 else
//		$qeryMatch .= " AND members_data.".$rows[23]['name']." = '".$rows[23]['value']."'";
//			}
//	}
//	if (array_key_exists(24, $rows))
//	{
//		if($rows[24]['value'])
//		{
//		if($rows[24]['name'] == 'age')
//				$qeryAge = $rows[24]['value'];
//		 else
//		$qeryMatch .= " AND members_data.".$rows[24]['name']." = '".$rows[24]['value']."'";
//			}
//	}
//	if(count($rows)>= 25)	
//	{
//		if($rows[25]['value'])
//		{
//		if($rows[25]['name'] == 'age')
//				$qeryAge = $rows[25]['value'];
//		 else
//		$qeryMatch .= " AND members_data.".$rows[25]['name']." = '".$rows[25]['value']."'";
//		}
//	}

//	echo $qeryAge;
//	$dSex = explode(" - ",$qeryAge);	
//		print_r($dSex);
//		exit;
	if($qeryAge != "")
	{
	
$dSex = explode(" - ",$qeryAge);	
$age = intval($dSex[0]);
$to = intval($dSex[1]);
$date1 = time();//strtotime($user_data[13]); // date when age was recorded
$time1 = $age*31556926; // calculating age in seconds
$time2 = $to*31556926; // calculating age in seconds
$dob1 = $date1 - $time1; // getting the timestamp for his / her date of birth
$dob2 = $date1 - $time2; // getting the timestamp for his / her date of birth
$dob_age = explode("-",date("Y-m-d",$dob1)); // getting the date of birth here
$dob_age1 = explode("-",date("Y-m-d",$dob2)); // getting the date of birth here
$dob_age[0];
$dob_age1[0];


		$qeryMatch .= "AND members_data.age < ".$dob_age[0]." AND members_data.age > ".$dob_age1[0];
	}
	
	$sSqls = "SELECT DISTINCT members.id, members.username, files.bigimage, members_data.location, files.bigimage, members_data.age FROM members LEFT JOIN files ON ( files.uid = members.id AND files.default=1) LEFT JOIN members_data ON ( members_data.uid = members.id ) WHERE members.id != '".$iId."' AND members.id != '0' ".$qeryMatch." GROUP BY members.id ORDER BY members.lastlogin LIMIT 100";
 //require_once("ion_app_function.php");
	//echo $sSqls;
	
	 $resultss = mysql_query($sSqls);

		  $i = 0;
	while ($rowsss = mysql_fetch_assoc($resultss))
	 {

		 $arrData[$i] = new StdClass;
		 $arrData[$i]->uid = $rowsss['id'];
		 $arrData[$i]->thumb = DB_DOMAIN."inc/tb.php?src=".$rowsss['bigimage'];
		 $arrData[$i]->username = $rowsss['username'];
		 $arrData[$i]->location = $rowsss['location'];
		 $arrData[$i]->age = MakeAge($rowsss['age']);
		 $i++;
	
	 }
}
	else
	{
	 $arrData[0] = new StdClass;
	}

    echo json_encode($arrData, JSON_UNESCAPED_SLASHES);
}
else {
     $arrData[0] = new StdClass;
     echo json_encode($arrData, JSON_UNESCAPED_SLASHES);
}
function getCaption($id){
global $DB;
  $re3 = $DB->Row("SELECT fvCaption FROM field_list_value WHERE fvid='".strip_tags($id)."' AND lang='".D_LANG."' LIMIT 1");
if($re3)
  return $re3['fvCaption'];
  else
  return $id;
}
function MakeAge($birthday){

        $birth = explode("-", $birthday);
if(isset($birth[1])){
    switch($birth[1]){
      case "JAN": { $MM = "01"; } break;
      case "FEB": { $MM = "02"; } break;
      case "MAR": { $MM = "03"; } break;
      case "APR": { $MM = "04"; } break;
      case "MAY": { $MM = "05"; } break;
      case "JUN": { $MM = "06"; } break;
      case "JUL": { $MM = "07"; } break;
      case "AUG": { $MM = "08"; } break;
      case "SEP": { $MM = "09"; } break;
      case "OCT": { $MM = "10"; } break;
      case "NOV": { $MM = "11"; } break;
      case "DEC": { $MM = "12"; } break;
      default: { return 21; }
    }
}else{
$MM = "12";
}

  $day =$birth[2];
  $month =$MM;
  $year =$birth[0];

  $year_diff  = date("Y") - $year;
    $month_diff = date("m") - $month;
    $day_diff   = date("d") - $day;

  if ($month_diff < 0) $year_diff--;
        elseif (($month_diff==0) && ($day_diff < 0))$year_diff--;
##        elseif (($month_diff==0) && ($day_diff >= 0))$year_diff++;
        return $year_diff;

}
?>
