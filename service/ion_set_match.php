<?php
header('Access-Control-Allow-Origin: *');
require_once("../inc/config.php");

$arrData = array();
if($_POST){
  $match = $_POST;
// $iId = $_GET['id'];
//
$MatchDataArray = array();

$MatchDataArray[0]['name'] = 'gender';
$MatchDataArray[0]['value'] = $match['seeking'];
$MatchDataArray[0]['type'] = '3';
$MatchDataArray[0]['caption'] = "I am seeking a / We are seeking a";

$MatchDataArray[1]['name'] = 'em_hrh20080113';
$MatchDataArray[1]['value'] = $match['marital'];
$MatchDataArray[1]['type'] = '3';
$MatchDataArray[1]['caption'] = 'Your marital status';

$MatchDataArray[2]['name'] = 'em_8cx20070511';
$MatchDataArray[2]['value'] = $match['sexuality'];
$MatchDataArray[2]['type'] = '3';
$MatchDataArray[2]['caption'] = 'Sexual Orientation';

$MatchDataArray[3]['name'] = 'age';
$MatchDataArray[3]['value'] = $match['afrom']." - ".$match['ato'];
$MatchDataArray[3]['type'] = '7';
$MatchDataArray[3]['caption'] = "Aged Between";

$MatchDataArray[4]['name'] = 'country';
$MatchDataArray[4]['value'] = $match['country'];
$MatchDataArray[4]['type'] = '3';
$MatchDataArray[4]['caption'] = 'Country';

$MatchDataArray[5]['name'] = 'em_85820081128';
$MatchDataArray[5]['value'] = $match['state'];
$MatchDataArray[5]['type'] = '3';
$MatchDataArray[5]['caption'] = 'State / Province';

$MatchDataArray[6]['name'] = 'location';
$MatchDataArray[6]['value'] = $match['city'];
$MatchDataArray[6]['type'] = '1';
$MatchDataArray[6]['caption'] = "City / Town";

$MatchDataArray[7]['name'] = 'em_txg20080113';
$MatchDataArray[7]['value'] = $match['religion'];
$MatchDataArray[7]['type'] = '3';
$MatchDataArray[7]['caption'] = "Religion";

$MatchDataArray[8]['name'] = 'em_72220080113';
$MatchDataArray[8]['value'] = $match['employment'];
$MatchDataArray[8]['type'] = '3';
$MatchDataArray[8]['caption'] = "Employment";

$MatchDataArray[9]['name'] = 'em_kjc20080113';
$MatchDataArray[9]['value'] = $match['income'];
$MatchDataArray[9]['type'] = '3';
$MatchDataArray[9]['caption'] = "Income";

$MatchDataArray[10]['name'] = 'em_s1620080113';
$MatchDataArray[10]['value'] = $match['education'];
$MatchDataArray[10]['type'] = '3';
$MatchDataArray[10]['caption'] = "Education";

$MatchDataArray[11]['name'] = 'em_rn620080113';
$MatchDataArray[11]['value'] = $match['wchildren'];
$MatchDataArray[11]['type'] = '3';
$MatchDataArray[11]['caption'] = "Wants Children";

$MatchDataArray[12]['name'] = 'em_kxb20080113';
$MatchDataArray[12]['value'] = $match['hchildren'];
$MatchDataArray[12]['type'] = '3';
$MatchDataArray[12]['caption'] = "Has Children";

$MatchDataArray[13]['name'] = 'em_qck20080113';
$MatchDataArray[13]['value'] = $match['personality'];
$MatchDataArray[13]['type'] = '3';
$MatchDataArray[13]['caption'] = "Personality";

$MatchDataArray[14]['name'] = 'em_r9720080113';
$MatchDataArray[14]['value'] = $match['romantic'];
$MatchDataArray[14]['type'] = '3';
$MatchDataArray[14]['caption'] = "Romantic";

$MatchDataArray[15]['name'] = 'em_1k820080113';
$MatchDataArray[15]['value'] = $match['height'];
$MatchDataArray[15]['type'] = '3';
$MatchDataArray[15]['caption'] = "Height";

$MatchDataArray[16]['name'] = 'em_heh20080113';
$MatchDataArray[16]['value'] = $match['build'];
$MatchDataArray[16]['type'] = '3';
$MatchDataArray[16]['caption'] = "Build";

$MatchDataArray[17]['name'] = 'em_93n20080113';
$MatchDataArray[17]['value'] = $match['hcolour'];
$MatchDataArray[17]['type'] = '3';
$MatchDataArray[17]['caption'] = "Hair Colour";

$MatchDataArray[18]['name'] = 'em_jsh20080113';
$MatchDataArray[18]['value'] = $match['ecolour'];
$MatchDataArray[18]['type'] = '3';
$MatchDataArray[18]['caption'] = "Eye Colour";

$MatchDataArray[19]['name'] = 'em_jhb20080113';
$MatchDataArray[19]['value'] = $match['hlength'];
$MatchDataArray[19]['type'] = '3';
$MatchDataArray[19]['caption'] = "Hair Length";

$MatchDataArray[20]['name'] = 'em_yh020080113';
$MatchDataArray[20]['value'] = $match['ethnicity'];
$MatchDataArray[20]['type'] = '3';
$MatchDataArray[20]['caption'] = "Ethnicity";

$MatchDataArray[21]['name'] = 'em_7jr20080113';
$MatchDataArray[21]['value'] = $match['pappearance'];
$MatchDataArray[21]['type'] = '3';
$MatchDataArray[21]['caption'] = "Physical Appearance";

$MatchDataArray[22]['name'] = 'em_wvh20080113';
$MatchDataArray[22]['value'] = $match['style'];
$MatchDataArray[22]['type'] = '3';
$MatchDataArray[22]['caption'] = "Style";

$MatchDataArray[23]['name'] = 'em_vqf20080113';
$MatchDataArray[23]['value'] = $match['mafeature'];
$MatchDataArray[23]['type'] = '3';
$MatchDataArray[23]['caption'] = "Most Attractive Feature";

// $MatchDataArray[25]['name'] = 'em_txg20080113';
// $MatchDataArray[25]['value'] = $match['weight'];
// $MatchDataArray[25]['type'] = '3';
// $MatchDataArray[25]['caption'] = "Weight";


//
 mysql_query("UPDATE members_privacy SET `match_array` = '".serialize($MatchDataArray)."' WHERE `uid` = '".$match['id']."'");

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
