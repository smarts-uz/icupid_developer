<?
/***************************************************************************
 *
 *	 PROJECT: iCupid Dating Software
 *	 VERSION: 8
 *	 LISENSE: OWN / LEASED (http://www.advandate.com/license.php)
 *
 *	 This program is a commercial software product and any kind of usage
 *	 means agreement to the eMeeting software License Agreement.
 *
 *	 This notice MUST NOT be removed from the code.   
 *
 *   Copyright 2006-2007 AdvanDate, Ltd.
 *   http://www.advandate.com/
 *
 ***************************************************************************/
## START SESSIONS
date_default_timezone_set('UTC');
if(!session_id())session_start();
if (!isset($loginSet) && ( !isset($_SESSION['admin_auth'])  || $_SESSION['admin_auth'] != "yes" ) )  {
	header("location: index.php");
	exit();  
}
require_once "../../../inc/config.php";
require_once "../../inc/config.php";
require_once "../config.php";
require_once "../func/wld_admin_globals.php";
function DisplayCalCatsID($default=0){

	global $DB; $String="";

	$result = $DB->Query("SELECT id, name FROM calendar_types ORDER BY id ASC");

    while( $groups = $DB->NextRow($result) )
    {
		if($default == $groups['id']){		
			$String.= "<option value='".$groups['id']."' selected>".$groups['name']."</option>";
		}else{		
			$String.=  "<option value='".$groups['id']."'>".$groups['name']."</option>";
		}		
	}
	
	return $String;
}
 
$action = trim(strip_tags($_GET['action']));
 
############################################################
#################### OPERATIONS ############################
switch ( $action ){

	case 'uploadprofilepic':
		global $DB;
		if($_POST['gmtdiff'] == 0):
			$pic = 'pics';
		else:
			$pic = 'pics'.$_POST['gmtdiff'];
		endif;
		
		$market = getMarketSiteSearchMemberSettings($_GET['market_id'],0);

		$dbh = getMarketDBConnection($_GET['market_id']);

		//$count_file = $DB->Query("SELECT count(*) FROM files WHERE uid = '".$_POST['uid']."'");
		
		$directoryPath = $market['file_storage_server_path'].$_POST['uid'].'/images';
		$directorythumb = $market['file_storage_server_path'].$_POST['uid'].'/thumbs';
		$directoryName = $_POST['uid'];
		if(!is_dir($directoryPath)){
			mkdir($directoryPath, 0777,true);
		} 
		
		
		$allowedExts = array("gif", "jpeg", "jpg", "png", "GIF", "JPEG", "JPG", "PNG");
		$temp = explode(".", $_FILES["profilepic"]["name"]);
		$extension = end($temp);
	
	//Check write Access to Directory
		if(!is_writable($directoryPath)){
			echo 'Can`t upload File; no write Access';
		}
	
		if ( in_array($extension, $allowedExts)) {

	  	if ($_FILES["profilepic"]["error"] > 0) {
			echo 'ERROR Return Code: '. $_FILES["profilepic"]["error"];
		}
	  	else {
			
	      	$filename = $_FILES["profilepic"]["tmp_name"];
		  	list($width, $height) = getimagesize( $filename );
			$imagename = $_POST['uid'].'_'.rand().'.'.$extension;
			
		  	move_uploaded_file($filename,  $directorythumb.'/'.$imagename);
		  	move_uploaded_file($filename,  $directoryPath.'/'.$imagename);
		  
			
			if($_POST['aid'] == '' && $_POST['imgid'] == ''):
			
				$date = date('Y-m-d');
				

				$stmt = $dbh->prepare("INSERT INTO `album`(`uid`,`title`,`comment`,`password`,`time`,`date`) VALUES(".$_POST['uid'].",'Profile','Default Album','','".$date."','".$date."')");
				$stmt->execute();

				$albumid = $dbh->lastInsertId();

				$stmt = $dbh->prepare("INSERT INTO `files`(`aid`,`user`,`uid`,`date`,`title`,`description`,`bigimage`,`width`,`height`) VALUES(".$albumid.",'',".$_POST['uid'].",'".$date."','Title goes here','Description goes here','".$imagename."',".$width.",".$height.")");

				$stmt->execute();
				
			elseif($_POST['imgid'] == ''):
				$date = date('Y-m-d');
							
				$stmt = $dbh->prepare("INSERT INTO `files`(`aid`,`user`,`uid`,`date`,`title`,`description`,`bigimage`,`width`,`height`) VALUES(".$_POST['aid'].",'',".$_POST['uid'].",'".$date."','Title goes here','Description goes here','".$imagename."',".$width.",".$height.")");
				$stmt->execute();

			elseif($_POST['aid'] != '' && $_POST['imgid'] != ''):
			
				$stmt = $dbh->prepare("UPDATE `files` SET `bigimage` = '".$imagename."' WHERE `id` = ".$_POST['imgid']."");

				$stmt->execute();
				
			endif;
				
			
			echo "Profile pic uploaded sucessfully";
		}
	  }
	else
	  {
			echo 'something went wrong, most likely file is to large for upload. check upload_max_filesize, post_max_size and memory_limit in you php.ini';
	  }
	break;
	
	case 'deleteprofilepic':
		
		$dbh = getMarketDBConnection($_GET['market_id']);
		if($_POST['photoid']){
		$SQL = "SELECT * FROM files WHERE uid = ". $_POST['mid'] ." AND id=".$_POST['photoid']."";
		$stmt = $dbh->query($SQL);
		$fetch = $stmt->fetch();
		//$fetch = $DB->NextRow($result);
			$fields = array();
			$values = array();
			foreach($fetch as $key => $val){
				if(!is_numeric($key)){
					if($val!=''){
					$fields[] = $key;
					$values[] = $val;
					}
				}
			}
			
			// If data added ($count not false) displays the number of rows added
			$stmt = $dbh->prepare("DELETE FROM `files` WHERE `id` = ".$_POST['photoid']." AND `uid` = ".$_POST['mid']."");
			$stmt->execute();
		echo 'Sucessfully Deleted';
		} else {
			echo "Profile pic does not exists!!!";	
		}
	break;

	case 'marketsites':
		
		echo getSitesHtml($_GET['system'],$_GET['market_id']);
		

	break;
	case 'LoadTable': {
 
	$SearchConfig = array();


 	print WLDMakeTable($SearchConfig);
		
	} break;

	case 'LoadMarketTable': {
 
	$SearchConfig = array();


 	print WLDMakeMarketTable($SearchConfig);
		
	} break;

	case 'LoadReportTable': {
 
	$SearchConfig = array('members_reported' => 'yes');

 	print MakeTable($SearchConfig);
		
	} break;


	case "PopClassSubCats": {

	$id = trim(strip_tags($_GET['value']));
	$def = trim(strip_tags($_GET['def']));

	$result1 = $DB->Query("SELECT id, name, icon FROM class_cats WHERE subId= ('".$id."') ORDER BY name DESC");

	## ADMIN APPROVAL SYSTEM, SHOW ALL ADVERT TYPES EVENT IF THEY ARE NOT APPROVED
	print '<select name="sub_catid" class="input"><option value="0">--------------</option>';
    while( $Data = $DB->NextRow($result1) )
    {
	if($def ==$Data['id']){ $extra="selected"; }else{ $extra="";}
	print "<option value='".$Data['id']."' ".$extra.">".$Data['name']."</option>";

	}
	print '</select>';
	} break;

//////////////////// EVENTFUL API ///////////////////////
case "calrsssearch":{
 

			require_once('../class/EVDB.php');
			require_once('../rss/rss_fetch.inc');
			
			$ThisKeyword = trim(strip_tags($_GET['keyword'])); $DataArray = array(); $Counter=1;
 
			$app_key  = EVENTFUL_KEY;
			$user     = EVENTFUL_USERNAME;
			$password = EVENTFUL_PASSWORD;
			
			//$evdb = &new Services_EVDB($app_key);
			$evdb =  new Services_EVDB($app_key);
				
			if ($user and $password)
				{
				  $l = $evdb->login($user, $password);
				  
				  if ( PEAR::isError($l) )
				  {
					  print("Can't log in: " . $l->getMessage() . "\n");
				  }

				$args = array(
					'keywords' => $ThisKeyword,
				);

				$event = $evdb->call('events/search', $args);
								
				if ( PEAR::isError($event) )
				{
					print("An error occurred: " . $event->getMessage() . "\n");
					print_r( $evdb );
				}

			
			print '
<ul class="form"><div class="box_body">	<form method="post" action="" name="form1">
<input name="do" type="hidden" value="callrssData" class="hidden">
<input name="p" type="hidden" value="importcal" class="hidden">

<li><label>Category</label>
<div class="tip">Select the category that this event will be placed under.</div>
<select class="input" name="category">'.DisplayCalCatsID(0).'</select></li>

<table class="widefat">                
              <thead>                  
                <tr>                     
                	<th scope="col">&nbsp;</th>
                	<th scope="col">Name</th> 
				</tr>
              </thead>                
              <tbody>                  
                                
              ';

			$i=1;

			if(empty($event['events'])){
				print "No Results Found";
				die();
			}
			foreach($event['events']['event'] as $event){
			
 
				print "<tr>
                    <td><input name='eb".$i."' type='checkbox' value='on'><input name='ev".$i."' type='hidden' value='".$event['id']."'></td>
                    <td><b>".$event['title']."</b> [<a href='#' onClick=\"javascript:idShowHide('group_".$i.");\"> details</a>]</td>  
                  </tr>";

				print "<tr id='group_".$i."'>
                    <td colspan=2 style='font-size:11px; padding:10px'>".eMeetingInput(str_replace('"',"'",$event['description']))."</td>  
                  </tr>";

				print "<input name='st".$i."' type='hidden' value='".$event['start_time']."'>";
				print "<input name='add".$i."' type='hidden' value='".eMeetingInput($event['address'])."'>";
				print "<input name='city".$i."' type='hidden' value='".$event['city']."'>";
				print "<input name='country".$i."' type='hidden' value='".$event['country']."'>";
				print '<input name="title'.$i.'" type="hidden" value="'.eMeetingInput(str_replace('"',"'",$event['title'])).'">'; 
				print '<input name="desc'.$i.'" type="hidden" value="'.eMeetingInput(str_replace('"',"'",$event['description'])).'">'; 
				print "<input name='reg".$i."' type='hidden' value='".eMeetingInput($event['region'])."'>"; 
				print "<input name='zip".$i."' type='hidden' value='".eMeetingInput($event['postal_code'])."'>";
				print "<input name='url".$i."' type='hidden' value='".eMeetingInput($event['url'])."'>";
				//$DataArray[$Counter]['id'] =  $event['id'];
				//$DataArray[$Counter]['title'] =  $event['title'];
				//$DataArray[$Counter]['description'] =  $event[''];
				//$DataArray[$Counter]['start_time'] =  ;
				//$DataArray[$Counter]['stop_time'] =  $event['stop_time'];
				//$Counter++;
				$i++;
			}
		print "<input name='totalFound' type='hidden' value='".$i."'>";
		print '</tbody></table>
<input type="submit" value="Add to Website" class="MainBtn">
</form></div></ul>
';
			 
							
		}

} break;




case "DisplayLinkedList":{

	$current = trim(strip_tags($_GET['c']));

	print '<select style="height:200px; width:150px;" onChange="UpdateTmpPreview(this.value);">';
	$result = $DB->Query("");
	while( $val = $DB->NextRow($result) ){
						
			print '<option value="'.$val['id'].'">'.$val['name'].'</option>';

	}			
		
	print '</select>';


} break;

//////////////////// LINKED LIST BOXES ///////////////////////


case "show_emailpreview": {
	
	$pid = trim(strip_tags($_GET['id']));

	$result = $DB->Row("SELECT nid, name, description, image FROM email_newsletters WHERE nid= '". $pid ."' LIMIT 1");
	
	print "<div style='padding:5px; border:1px solid #999; background:#eee; font-size:11px; line-height:25px; width:100%; height:200px;'>
	<p><b>".$result['name']."</b></p>
	".$result['description']."";

	if($result['image'] !="" && $result['image'] !="images/newsletters/default.gif"){
		print "<img src='".DB_DOMAIN."newadmin/inc/".$result['image']."' style='float:left; padding-right:20px;'>12";
	}
	print "<p><a href='javascript:void(0);' onClick=PreviewWin('inc/pops/pop_email_preview.php?id=".$result['nid']."'); class='MainBtn'>Preview</a>  
	<a href='email.php?p=add&id=".$pid."' class='MainBtn'>Edit Email</a> - 
	<a href='email.php?delete=1&id=".$result['nid']."' class='GreenMainBtn'>Delete Email</a> </p></div>";
				
} break;

case "update_emaillist": {
	
	$system = trim(strip_tags($_GET['mid']));
$i=1;
	if(!isset($system)){$Extra="WHERE status='system' AND name !='tracking'";}
	elseif($system ==0){$Extra="WHERE status='system' AND name !='tracking'"; }
	elseif($system ==1){$Extra="WHERE status='custom' AND name !='tracking'"; }
	elseif($system ==2){$Extra="WHERE status='template' AND name !='tracking'"; }
	elseif($system ==3){$Extra="WHERE status='admin' AND name !='tracking'"; }

	$result = $DB->Query("SELECT name, status, nid FROM email_newsletters $Extra ORDER BY nid ASC");


	print '<select class="input EmailPreviewer" name="ThemeEditorList" size="1" multiple id="ThemeEditorList" style="height:250px; width:250px" onChange="UpdateEmailPreview(this.value);">';

	while( $val = $DB->NextRow($result) ){
		
		print '<option value="'.$val['nid'].'" class="ei">'.$i.': '.$val['name'].'</option>';
$i++;
	}					
	print '</select>';

} break;
			
case "update_list": {
	
	$mid = trim(strip_tags($_GET['mid']));
	if($mid ==3){
		$result = $DB->Query("SELECT * FROM system_templates");
	}else{
		$result = $DB->Query("SELECT * FROM system_templates WHERE cat= '". $mid ."'");
	}					
	
	print '<select name="ThemeEditorList" size="1" multiple id="ThemeEditorList" style="height:200px; width:200px; margin-top:10px" onChange="UpdateTmpPreview(this.value);">';

	while( $val = $DB->NextRow($result) ){
		
		print '<option value="'.$val['id'].'">'.$val['name'].'</option>';

	}					
	print '</select>';

} break;				
	
case "payment_gateways": { ?>

	<div class="bar_save">
		<input type="button" value="Add Gateways" class="NormBtn" onClick="javascript:location.href='?p=gateways&sp=add_gateway&market_id=<?=$_GET['market_id']?>';"/>
		<br class="clear">
	</div>

	<br class="clear">
	<form method="post" action="" name="profile2" onSubmit="return CheckMemberForm2();">
		<input name="do" type="hidden" value="none" id="do2" class="hidden">
		<input name="market_id" type="hidden" value="<?=$_GET['market_id']?>"/>
		<table class="widefat">
            <thead>
        		<tr> 
                	<th></th>
                    <th><?=$admin_table_val[12] ?></th>
                    <th><?=$admin_table_val[27] ?></th>
                    <th><?=$admin_table_val[28] ?></th>
                    <th><?=$admin_table_val[29] ?></th>
                    <th><?=$admin_table_val[20] ?></th>
              	</tr>
            </thead>
            <tbody>
            	<?php $tRows =WLDDisplayGateways($_GET['market_id']); ?>
            </tbody>
        </table>
		<input name="NumRows" type='hidden' class='hidden' value='<?=$tRows ?>'>
		<br class="clear">

		<div class="bar_save">
			<input type="button" value="<?=$admin_button_val[1] ?>" class="NormBtn" onClick="ca2(<?=$tRows ?>)"/>
			<input type="button" value="<?=$admin_button_val[2] ?>" class="NormBtn"  onClick="ua2(<?=$tRows ?>)"/> - 
			<input type="button" value="<?=$admin_button_val[5] ?>" class="MainBtn"  onclick="WLDChangeOption2('gatewaydelete');"/>
			<br class="clear">
		</div>
	</form>
 
<?php } break;		

				case "show_previewDesc": {
					
					$pid = trim(strip_tags($_GET['pid']));
					
					if(is_numeric($pid)){ 

						$result = $DB->Row("SELECT template_id, name, description, preview FROM system_templates WHERE id= '". $pid ."' LIMIT 1");
	
						print "<img src='../inc/templates/".$result['template_id']."/images/design.gif' width=70 height=55 style='float:left; padding-right:20px;'>
	
						<input type='hidden' name='UpateTempName' id='UpateTempName' value='".$result['template_id']."'>";
	
						print "<p><b>".$result['name']."</b></p><p>".$result['description']."</p></div>";
					
					}
			
	} break;		



	case "fieldorderpage": {

	if(ADMIN_DEMO == "yes"){ print "Disabled in Demo Mode"; return; }

	$dbh = getMarketDBConnection($_GET['market_id']);
	$id = trim(strip_tags($_GET['id']));
	$value = trim(strip_tags($_GET['value']));
 
	getMarketQueryUpdate($dbh,"UPDATE field SET fOrder='".$value."' WHERE fid='".$id."' LIMIT 1");

	print "Field Order Updated";

	} break;

	case "fieldtypepage": {

	if(ADMIN_DEMO == "yes"){ print "Disabled in Demo Mode"; return; }

	$id = trim(strip_tags($_GET['id']));
	$value = trim(strip_tags($_GET['value']));
	$type = trim(strip_tags($_GET['type']));


	$dbh = getMarketDBConnection($_GET['market_id']);

 	$div = (isset($_GET['div'])) ? trim(strip_tags($_GET['div'])) : '';
 
	switch($value){
	
	case "1": { }
	case "yes": {$img="yes.png"; $nVal ="no";} break;
	
	case "0": { }
	case "no": {$img="no.png"; $nVal ="yes";} break;
	
	}
	
	switch($type){

		case "1": {
			getMarketQueryUpdate($dbh,"UPDATE field SET browsepage='".$value."' WHERE fid='".$id."' LIMIT 1");
			
		} break;
		case "2": {
			getMarketQueryUpdate($dbh,"UPDATE field SET required='".$value."' WHERE fid='".$id."' LIMIT 1");
			
		} break;
		case "3": {
			getMarketQueryUpdate($dbh,"UPDATE field SET matchpage='".$value."' WHERE fid='".$id."' LIMIT 1");
		
		} break;

	}
	$div = (isset($div)) ? $div : '';
	print "<img src='inc/images/icons/".$img."' onClick=\"WLDUpdateFieldPage('".$nVal."','".$id."','".$div."',".$type.")\" style='cursor:pointer;'>";

	

	//print "Field Order Updated";

	} break;

	case "SaveLinkedList":{

	if(ADMIN_DEMO == "yes"){ print "Disabled in Demo Mode"; return; }

		$fid = trim(strip_tags($_GET['fid']));
		$value = trim(strip_tags($_GET['value']));
		$DB->Update("UPDATE field SET field.linked_id='".$value."' WHERE fid='".$fid."' LIMIT 1");

		print GetLinkedName($value);

	} break;

	case "ShowLinkedList": {

	$fid = trim(strip_tags($_GET['fid']));
	$div = (isset($_GET['div'])) ? trim(strip_tags($_GET['div'])) : '';

	$string = "";
    $result = $DB->Query("SELECT fid, caption FROM field INNER JOIN  field_caption ON ( field.fid = field_caption.Cid AND field_caption.match ='yes' )  WHERE  field.fType =3 ");
	$string .="<select onChange=\"eMeetingSaveLinkedField(this.value,".$fid.",'".$div."'); return false;\">";
	$string .= "<option value=0> Select Field to link with </option><option value=0> ---> Field Not Linked </option>";
	while( $data = $DB->NextRow($result) )
    {
		
		$string .= "<option value='".$data['fid']."'>".$data['caption']."</option>";
	}
	$string .="</select>";
	print $string;

	} break;

	case "SaveLinkedListID": {

	if(ADMIN_DEMO == "yes"){ print "Disabled in Demo Mode"; return; }

	$table = trim(strip_tags($_GET['table']));
 	$id = trim(strip_tags($_GET['id']));
	$value = trim(strip_tags($_GET['value']));

	$bits1 = explode(".",$table);
	 
	$DB->Update("UPDATE ".$bits1[0]." SET linked_cap_id ='".eMeetingInput($value)."' WHERE ".$bits1[1]." = '". $id ."' LIMIT 1");

	print "Changes Saved";	
	
	} break;

	case "SaveTableOrder": {

	if(ADMIN_DEMO == "yes"){ print "Disabled in Demo Mode"; return; }

	$sortBy = trim(strip_tags($_GET['o']));
	$sortWay = trim(strip_tags($_GET['sw']));
	$start = trim(strip_tags($_GET['p']));
	$save = trim(strip_tags($_GET['save']));
 	$table = trim(strip_tags($_GET['table']));
	$DEFAULTVALUE = trim(strip_tags($_GET['startvalue']));
	$WhereString="";

	if($DEFAULTVALUE !=0){
		$WhereString = $GLOBALS['SEARCH_DATA']['tb_where'];
	}
	$bits = explode(".",$table);

	$i=1;
	$result = $DB->Query("SELECT ".$table.",".$save." FROM ".$bits[0]." ".$WhereString." ORDER BY ".$sortBy." ".$sortWay);
	while( $val = $DB->NextRow($result) ){
						
	 $DB->Update("UPDATE ".$bits[0]." SET ".$save."='".$i."' WHERE ".$table."='".$val[$bits[1]]."' LIMIT 1");
	 $i++;		
	}

	print "Table Order Saved";

	} break;

	case "TablePage":{

	$sortBy = trim(strip_tags($_GET['o']));
	$sortWay = trim(strip_tags($_GET['sw']));
	$start = trim(strip_tags($_GET['p']));
  	$searchValue = trim(strip_tags($_GET['fv']));
	$searchField = trim(strip_tags($_GET['ff']));

	$SearchConfig = array(
	
	"Cpage" => $start,
	"Spage" =>"",
	"Tpage" =>"",
	"sort" => $sortBy,
	"Wsort" => $sortWay,
	"search" => $searchValue,
	"Fsearch" => $searchField,

	);

	print MakeTable($SearchConfig);	
	
	} break;

	case "TableOrder": {

	$sortBy = trim(strip_tags($_GET['o']));
	$sortWay = trim(strip_tags($_GET['sw']));
	$start = trim(strip_tags($_GET['s']));
  	$searchValue = trim(strip_tags($_GET['fv']));
	$searchField = trim(strip_tags($_GET['ff']));
	$RowsPerPage = trim(strip_tags($_GET['rows']));
	$system = trim(strip_tags($_GET['system']));

	$SearchConfig = array(
	
	"Cpage" => $start,
	"Spage" =>"",
	"Tpage" => $RowsPerPage,
	"sort" => $sortBy,
	"Wsort" => $sortWay,
	"search" => $searchValue,
	"Fsearch" => $searchField,
	"system" => $system,

	);

	print WLDMakeMarketTable($SearchConfig);
	
	} break;


	case 'DeleteRow': {

	if(ADMIN_DEMO == "yes"){ print "Disabled in Demo Mode"; return; }

	$id = trim(strip_tags($_GET['id']));
	$table = trim(strip_tags($_GET['table']));
	$bits = explode(".",$table);
	
	$market_id = trim(strip_tags($_GET['market_id']));
	$site_id = trim(strip_tags($_GET['site_id']));

	if($table == 'wu.wld_user_id'){
		global $DB;

		$DB->Update("DELETE FROM wld_users WHERE wld_user_id = '".$id."'");
	}
	else if($table == 'ws.wld_site_id'){

		global $DB;

		$site = $DB->Row("SELECT ws.wld_site_id,ws.languages,ws.template,ws.market,ws.countries,ws.age_from,ws.age_to,ws.default_language,wm.wld_market_id,ws.site_name,ws.site_url,wm.market_name,wm.market_database_name,wm.market_database_username,wm.market_database_password,wm.market_database_path FROM wld_sites ws INNER JOIN wld_markets wm ON ws.market = wm.wld_market_id WHERE wld_site_id = $id");
	   
	   	$site_url = $site['site_url'];

	   	$market_name = strtolower(str_replace(" ", "", $site['market_name']));
	   
		$market_id = $site['wld_market_id'];

	   	$site_id = $site['wld_site_id'];

	   	$site_langs = $site['languages'];
	   	
	   	$site_countries = $site['countries'];

	   	$template = $site['template'];

	   	$dpath = str_replace(array('http://','https://','www.','/'), '', $site_url);

	   	$config_url = str_replace(array('http://','https://','/'), '', $site_url);

	   	$config_url = 'http://'.$config_url;
		
		if (file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$dpath) && strlen($dpath) > 5 && $dpath != "") {
			
			if(file_exists($_SERVER['DOCUMENT_ROOT']."/".$dpath."/videochat/files/.htaccess")){
            
	            chmod($_SERVER['DOCUMENT_ROOT']."/".$dpath."/videochat/files/.htaccess", 0755);
	            unlink($_SERVER['DOCUMENT_ROOT']."/".$dpath."/videochat/files/.htaccess");

	        }
	        if(file_exists($_SERVER['DOCUMENT_ROOT']."/".$dpath."/.htaccess")){
	            
	            chmod($_SERVER['DOCUMENT_ROOT']."/".$dpath."/.htaccess", 0755);
	            unlink($_SERVER['DOCUMENT_ROOT']."/".$dpath."/.htaccess");

	        }
			
			WLDeleteSiteFiles($_SERVER['DOCUMENT_ROOT'].'/'.$dpath);
		}

		$DB->Update("DELETE FROM wld_sites WHERE wld_site_id = '$id'");
		
		$DB->Update("DELETE FROM wld_home_page_text WHERE site_id = '$id'");
		$DB->Update("DELETE FROM wld_metatags WHERE site_id = '$id'");
		$DB->Update("DELETE FROM wld_site_api_settings WHERE site_id = '$id'");
		$DB->Update("DELETE FROM wld_site_images WHERE site_id = '$id'");
		$DB->Update("DELETE FROM wld_site_package_settings WHERE site_id = '$id'");
		$DB->Update("DELETE FROM wld_site_pages WHERE site_id = '$id'");
		$DB->Update("DELETE FROM wld_site_rotating_images WHERE site_id = '$id'");
		$DB->Update("DELETE FROM wld_site_search_membership_file_settings WHERE site_id = '$id'");
		$DB->Update("DELETE FROM wld_site_settings WHERE site_id = '$id'");
		$DB->Update("DELETE FROM wld_site_template_settings WHERE site_id = '$id'");


	}
	else{
	
	$market = getMarket($market_id);
	$market_site_settings = getMarketSiteSearchMemberSettings($market_id,$site_id);

	$dbh = new PDO('mysql:host='.$market['market_database_path'].';dbname='.$market['market_database_name'].';charset=utf8mb4', $market['market_database_username'], $market['market_database_password']);
			
	// CUSTOM DELETE OPTIONS
	if( $bits[0] =="field_groups"){
		// MOVE THESE FIELDS TO A NEW GROUP
		$NewGroup = $DB->Row("SELECT id FROM field_groups LIMIT 1");
		$DB->Insert("UPDATE field SET groupid='".$NewGroup['id']."' WHERE groupid  = '".$id."' ");

		$stmt = $dbh->prepare("DELETE FROM ".$bits[0]." WHERE ".$bits[1]." = '". $id ."' LIMIT 1");

		$stmt->execute();
		
	}elseif( $bits[0] =="members"){
			
		$SQL ="SELECT members_privacy.Notifications, members.email, members.username FROM members_privacy, members WHERE members_privacy.uid = members.id AND members_privacy.uid=".$id;		

		$stmt = $dbh->query($SQL);
		$val = $stmt->fetch();

		getMarketQueryUpdate($dbh,"UPDATE members SET visible = 'no', `is_deleted` = 'yes', updated = '".date("Y-m-d H:i:s")."' WHERE id =".$id);

		//$val = $DB->Row("SELECT members_privacy.Notifications, members.email, members.username FROM members_privacy, members WHERE members_privacy.uid = members.id AND members_privacy.uid=".$id);
		/*getMarketQueryUpdate($dbh,"DELETE FROM members WHERE id=".$id);
		getMarketQueryUpdate($dbh,"DELETE FROM members_reported WHERE to_uid=".$id);
		getMarketQueryUpdate($dbh,"DELETE FROM members_data WHERE uid=".$id);
		
		
		$result = $dbh->query("SELECT bigimage, type, id FROM files WHERE uid=".$id);

		foreach( $result AS $file ){

			if( $file['type'] == 'music'){
				@unlink($market_site_settings['file_storage_server_path'].$file['uid'].'/music/'.$file['bigimage']);	
				//@unlink(PATH_MUSIC.$file['bigimage']);
			}elseif($file['type'] =='video'){
				@unlink($market_site_settings['file_storage_server_path'].$file['uid'].'/video/'.$file['bigimage']);
				//@unlink(PATH_VIDEO.$file['bigimage']);
			}else{
				@unlink($market_site_settings['file_storage_server_path'].$file['uid'].'/images/'.$file['bigimage']);
				@unlink($market_site_settings['file_storage_server_path'].$file['uid'].'/thumbs/'.$file['bigimage']);
				//@unlink(PATH_IMAGE.$file['bigimage']);
				//@unlink(PATH_IMAGE_THUMBS.$file['bigimage']);
			}
			getMarketQueryUpdate($dbh,"DELETE FROM files WHERE uid=".$id." AND id=".$file['id']);
		}*/
					
		/*getMarketQueryUpdate($dbh,"DELETE FROM album WHERE uid =".$id);							
		getMarketQueryUpdate($dbh,"DELETE FROM forum_posts WHERE poster_id =".$id);
		getMarketQueryUpdate($dbh,"DELETE FROM forum_topics WHERE topic_poster =".$id);
		getMarketQueryUpdate($dbh,"DELETE FROM members_network WHERE uid=".$id);
		getMarketQueryUpdate($dbh,"DELETE FROM members_network WHERE to_uid=".$id);
		getMarketQueryUpdate($dbh,"DELETE FROM poll_check WHERE uid =".$id);							
		getMarketQueryUpdate($dbh,"DELETE FROM members_template WHERE uid =".$id);
		getMarketQueryUpdate($dbh,"DELETE FROM member_scores WHERE uid =".$id);							
		getMarketQueryUpdate($dbh,"DELETE FROM members_billing WHERE uid =".$id);
		getMarketQueryUpdate($dbh,"DELETE FROM comments WHERE from_uid =".$id);							
		getMarketQueryUpdate($dbh,"DELETE FROM quiz WHERE uid =".$id);
		getMarketQueryUpdate($dbh,"DELETE FROM quiz_questions WHERE uid =".$id);
		getMarketQueryUpdate($dbh,"DELETE FROM quiz_results WHERE uid =".$id);							
		getMarketQueryUpdate($dbh,"DELETE FROM visited WHERE uid =".$id);
		getMarketQueryUpdate($dbh,"DELETE FROM poll_check WHERE uid =".$id);
		getMarketQueryUpdate($dbh,"DELETE FROM members_online WHERE logid =".$id);
		getMarketQueryUpdate($dbh,"DELETE FROM messages WHERE uid =".$id);
		getMarketQueryUpdate($dbh,"DELETE FROM members_privacy WHERE uid=".$id);*/
		if($val['Notifications'] =="yes"){

			$Data['email'] =  $val['email'];
			$Data['username'] =  $val['username'];
			SendTemplateMail($Data, 8);
		}
	
	}elseif( $bits[0] =="files"){

		$sql = "SELECT id, uid, bigimage, type, aid, `default`, approved FROM files WHERE id=".$id;

		$stmt = $dbh->prepare($sql);

		$stmt->execute();
		$file = $stmt->fetch();

		//$file = $DB->Row();
		if(is_numeric($file['id'])){
			$del_files = $dbh->prepare("DELETE FROM files WHERE id=".$file['id']);

			$del_files->execute();
			//$DB->Update("DELETE FROM files WHERE id=".$file['id']);
		}
		if( $file['type'] == 'music'){
			@unlink($market_site_settings['music_storage_web_path'].$file['uid'].'/music/'.$file['bigimage']);
		}elseif($file['type'] =='video'){
			@unlink($market_site_settings['video_storage_web_path'].$file['uid'].'/videos/'.$file['bigimage']);
		}else{
			//@unlink(PATH_IMAGE.$file['bigimage']);
			//@unlink(PATH_IMAGE_THUMBS.$file['bigimage']);

			@unlink($market_site_settings['photo_storage_web_path'].$file['uid'].'/images/'.$file['bigimage']);		
			@unlink($market_site_settings['thumb_storage_web_path'].$file['uid'].'/thumbs/'.$file['bigimage']);		
		}

		$stmt = $dbh->prepare("UPDATE album SET filecount=filecount-1 WHERE aid=".$file['aid']);

		$stmt->execute();
		//$DB->Update("UPDATE album SET filecount=filecount-1 WHERE aid=".$file['aid']);
		 
		// IF THIS WAS THE DEFAULT FILE, MAKE ANOTHER FILE DEFAULT
		if(	$file['default'] ==1){
			$stmt = $dbh->prepare("UPDATE files SET `default`=1 WHERE uid=".$file['uid']." LIMIT 1");

			$stmt->execute();
			//$DB->Update("UPDATE files SET `default`=1 WHERE uid=".$file['uid']." LIMIT 1");
		}
								
		// SEND REJECTED EMAIL
		if($file['approved'] =="no"){
			$stmt = $dbh->prepare("SELECT * FROM members WHERE id='".$file['uid']."' LIMIT 1");

			$stmt->execute();
			$Data = $stmt->fetch();

			//$Data = $DB->Row();
			SendTemplateMail($Data, 15);										
		}
		
		$stmt = $dbh->prepare("DELETE FROM ".$bits[0]." WHERE ".$bits[1]." = '". $id ."' LIMIT 1");

		$stmt->execute();

	}
	else{
		
		$stmt = $dbh->prepare("DELETE FROM ".$bits[0]." WHERE ".$bits[1]." = '". $id ."' LIMIT 1");
		$stmt->execute();		

	}

	//$DB->Update();
	}		
	print "Deleted Successfully";
		
	} break;

	case 'BlockRow': {

	if(ADMIN_DEMO == "yes"){ print "Disabled in Demo Mode"; return; }

	$id = trim(strip_tags($_GET['id']));
	
		//BAN USER

		$market_id = trim(strip_tags($_GET['market_id']));
		$site_id = trim(strip_tags($_GET['site_id']));
		
		$market = getMarket($market_id);

		$dbh = new PDO('mysql:host='.$market['market_database_path'].';dbname='.$market['market_database_name'].';charset=utf8mb4', $market['market_database_username'], $market['market_database_password']);
			
		$stmt = $dbh->prepare("SELECT username,ip FROM members WHERE id = ".$id);
		$stmt->execute();
		$val = $stmt->fetch();
		$DB->Update("INSERT INTO `members_banned` (`ip` ,`date` ,`string`, username) VALUES ( '".$val['ip']."', '".date("Y-m-d H:i:s")."' , 'Banned by Admin','".$val['username']."')");

		print "Blocked Successfully";
		
	} break;

	case 'AcceptReportRow': {

	if(ADMIN_DEMO == "yes"){ print "Disabled in Demo Mode"; return; }

	$id = trim(strip_tags($_GET['id']));
	
		//BAN USER

		//$val = $DB->Row("SELECT username,ip FROM members WHERE id = ".$id);

		$DB->Update("DELETE FROM `members_reported` WHERE to_uid = '".$id."'");

		print "Updated Successfully";
		
	} break;

	case "ChangeYesNo": {

	if(ADMIN_DEMO == "yes"){ print "Disabled in Demo Mode"; return; }

	$id = trim(strip_tags($_GET['id']));
	$table = trim(strip_tags($_GET['table']));
	$yesno = trim(strip_tags($_GET['yesno']));
	$field = trim(strip_tags($_GET['field']));
 	$bits = explode(".",$table);
	$field = str_replace("AS Adult","",$field);
	
		if($field =="ws.approved" && $bits[0] =="ws"){

			if($yesno =="yes"){


			$site = $DB->Row("SELECT ws.wld_site_id,ws.languages,ws.template,ws.market,ws.countries,ws.age_from,ws.age_to,ws.default_language,wm.wld_market_id,ws.site_name,ws.site_url,wm.market_name,wm.market_database_name,wm.market_database_username,wm.market_database_password,wm.market_database_path FROM wld_sites ws INNER JOIN wld_markets wm ON ws.market = wm.wld_market_id WHERE wld_site_id = $id");
		   
		   	$site_url = $site['site_url'];

		   	$market_name = strtolower(str_replace(" ", "", $site['market_name']));
		   
			$market_id = $site['wld_market_id'];

		   	$site_id = $site['wld_site_id'];

		   	$site_langs = $site['languages'];
		   	
		   	$site_countries = $site['countries'];

		   	$site_age_from = $site['age_from'];
	    	
	        $site_age_to = $site['age_to'];

		   	$template = $site['template'];

		   	$dpath = str_replace(array('http://','https://','www.','/'), '', $site_url);

		   	$config_url = str_replace(array('http://','https://','/'), '', $site_url);

		   	$config_url = 'http://'.$config_url;
			
			if (!file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$dpath)) {

				mkdir($_SERVER['DOCUMENT_ROOT'].'/'.$dpath, 0755, true);
				
				$zip = new ZipArchive;
				if ($zip->open($_SERVER['DOCUMENT_ROOT'].'/site_code.zip') === TRUE) {
					$zip->extractTo($_SERVER['DOCUMENT_ROOT'].'/'.$dpath.'/');
				    $zip->close();
				}
			}
			
			$siteDetails = getMarketSiteSearchMemberSettings($market_id,'0');	

			$config = $_SERVER['DOCUMENT_ROOT'].'/'.$dpath.'/inc/config.php';
			$config_db = $_SERVER['DOCUMENT_ROOT'].'/'.$dpath.'/inc/config_db.php';	
			$config_packageaccess = $_SERVER['DOCUMENT_ROOT'].'/'.$dpath.'/inc/config_packageaccess.php';	

			$sourceTemp = $_SERVER['DOCUMENT_ROOT'].'/wld/'.$market_name.'/inc/templates/'.$template;
			$destinationTemp = $_SERVER['DOCUMENT_ROOT'].'/'.$dpath.'/inc/templates/'.$template;

			WLDCopyTemplate($sourceTemp, $destinationTemp);

			if (file_exists($config)) {

				if (!$file_config = fopen($config, 'a+b')) {
				
					die("There was an error opening your config.php file. Please make sure it exsits and is located in the inc/ directory.");
				
				}
				else {
				
					$data = array();
					$counter = 1;
					$filecontent = "";
				
					$MEDIA_SITE_PATH = $_SERVER['DOCUMENT_ROOT'].'/wld/'.$market_name.'/usermedia/';

					while (!feof($file_config)) {

						$data[$counter] = fgets($file_config);
						
						if ( strstr($data[$counter], "'PATH_IMAGE','REPLACE_PATH_IMAGE'") ) {
							$filecontent .= str_replace('REPLACE_PATH_IMAGE', $MEDIA_SITE_PATH, $data[$counter]);
						}

						else if(strstr($data[$counter], "'PATH_IMAGE_THUMBS','REPLACE_PATH_IMAGE_THUMBS'")){
							$filecontent .= str_replace('REPLACE_PATH_IMAGE_THUMBS', $MEDIA_SITE_PATH, $data[$counter]);
						}

						else if(strstr($data[$counter], "'PATH_VIDEO','REPLACE_PATH_VIDEO'")){
							$filecontent .= str_replace('REPLACE_PATH_VIDEO', $MEDIA_SITE_PATH, $data[$counter]);
						}

						else if(strstr($data[$counter], "'PATH_MUSIC','REPLACE_PATH_MUSIC'")){
							$filecontent .= str_replace('REPLACE_PATH_MUSIC', $MEDIA_SITE_PATH, $data[$counter]);
						}

						else if(strstr($data[$counter], "'PATH_FILES','REPLACE_PATH_FILES'")){
							$filecontent .= str_replace('REPLACE_PATH_FILES', $MEDIA_SITE_PATH, $data[$counter]);
						}
						else if(strstr($data[$counter], "'WEB_PATH_IMAGE','REPLACE_WEB_PATH_IMAGE'")){
							$filecontent .= str_replace('REPLACE_WEB_PATH_IMAGE', $config_url.'/uploads/images/', $data[$counter]);
						}
						else if(strstr($data[$counter], "'WEB_PATH_IMAGE_THUMBS','REPLACE_WEB_PATH_IMAGE_THUMBS'")){
							$filecontent .= str_replace('REPLACE_WEB_PATH_IMAGE_THUMBS', $config_url.'/uploads/thumbs/', $data[$counter]);
						}

						else if(strstr($data[$counter], "'WEB_PATH_VIDEO','REPLACE_WEB_PATH_VIDEO'")){
							$filecontent .= str_replace('REPLACE_WEB_PATH_VIDEO', $config_url.'/uploads/videos/', $data[$counter]);
						}

						else if(strstr($data[$counter], "'WEB_PATH_MUSIC','REPLACE_WEB_PATH_MUSIC'")){
							$filecontent .= str_replace('REPLACE_WEB_PATH_MUSIC', $config_url.'/uploads/music/', $data[$counter]);
						}

						else if(strstr($data[$counter], "'WEB_PATH_FILES','REPLACE_WEB_PATH_FILES'")){
							$filecontent .= str_replace('REPLACE_WEB_PATH_FILES', $config_url.'/uploads/files/', $data[$counter]);
						}
						else if(strstr($data[$counter], "'MARKETING_DIR','REPLACE_MARKETING_DIR'")){
							$filecontent .= str_replace('REPLACE_MARKETING_DIR', $market_name , $data[$counter]);
						}

						else if(strstr($data[$counter], "'MARKET_ID','REPLACE_MARKET_ID'")){
							$filecontent .= str_replace('REPLACE_MARKETING_DIR', $market_id , $data[$counter]);
						}

						else if(strstr($data[$counter], "'SITE_ID','REPLACE_SITE_ID'")){
							$filecontent .= str_replace('REPLACE_SITE_ID', $site_id , $data[$counter]);
						}

						else if(strstr($data[$counter], "'SITE_LANGS','REPLACE_SITE_LANGS'")){
							$filecontent .= str_replace('REPLACE_SITE_LANGS', $site_langs , $data[$counter]);
						}

						else if(strstr($data[$counter], "'SITE_AGE_FROM','REPLACE_SITE_AGE_FROM'")){
							$filecontent .= str_replace('REPLACE_SITE_AGE_FROM', $site_age_from , $data[$counter]);
						}

						else if(strstr($data[$counter], "'SITE_AGE_TO','REPLACE_SITE_AGE_TO'")){
							$filecontent .= str_replace('REPLACE_SITE_AGE_TO', $site_age_to , $data[$counter]);
						}

						else if(strstr($data[$counter], "'SITE_COUNTRIES','REPLACE_SITE_COUNTRIES'")){
							$filecontent .= str_replace('REPLACE_SITE_COUNTRIES', $site_countries , $data[$counter]);
						}

						else if(strstr($data[$counter], "'D_TEMP','REPLACE_D_TEMP'")){
							$filecontent .= str_replace('REPLACE_D_TEMP', $template , $data[$counter]);
						}

						else if(strstr($data[$counter], "'DEFAULT_PACKAGE','REPLACE_DEFAULT_PACKAGE'")){
							$filecontent .= str_replace('REPLACE_DEFAULT_PACKAGE', '3' , $data[$counter]);
						}

						else if ( strstr($data[$counter], "define('DATE_DISPLAY_FORMAT','")  && isset($siteDetails['date_display_format']) && $siteDetails['date_display_format'] != "") {
                            $filecontent .= "define('DATE_DISPLAY_FORMAT','".$siteDetails['date_display_format']."');\r\n";
        				}
						else if ( strstr($data[$counter], "define('BLOCK_USERNAMES','") && isset($siteDetails['block_usernames']) && $siteDetails['block_usernames'] != "") {
							$filecontent .= "define('BLOCK_USERNAMES','".$siteDetails['block_usernames']."');\r\n";
						}
						else if ( strstr($data[$counter], "define('MARKET_COMMISSION','") && isset($siteDetails['market_commission']) && $siteDetails['market_commission'] != "") {
							$filecontent .= "define('MARKET_COMMISSION','".$siteDetails['market_commission']."');\r\n";
        				}
        				else if ( strstr($data[$counter], "define('D_MOD_WRITE','") && isset($siteDetails['d_mod_write']) && $siteDetails['d_mod_write'] != "") {
                        	$filecontent .= "define('D_MOD_WRITE','".$siteDetails['d_mod_write']."');\r\n";
        				}
						else if ( strstr($data[$counter], "define('D_FLAGS','") && isset($siteDetails['d_flags']) && $siteDetails['d_flags'] != "") {
							$filecontent .= "define('D_FLAGS','".$siteDetails['d_flags']."');\r\n";
				        }
				        else if ( strstr($data[$counter], "define('D_CCTEXT','") && isset($siteDetails['d_cctext']) && $siteDetails['d_cctext'] != "") {
				            $filecontent .= "define('D_CCTEXT','".$siteDetails['d_cctext']."');\r\n";
				        }
				        else if ( strstr($data[$counter], "define('AUTO_LOGIN','") && isset($siteDetails['auto_login']) && $siteDetails['auto_login'] != "") {
				            $filecontent .= "define('AUTO_LOGIN','".$siteDetails['auto_login']."');\r\n";
				        }
				        else if (strstr($data[$counter], "define('AUTO_AMOUNT','") && isset($siteDetails['auto_amount']) && $siteDetails['auto_amount'] != ""){
				            $filecontent .= "define('AUTO_AMOUNT','".$siteDetails['auto_amount']."');\r\n";
				        }
				        else if (strstr($data[$counter], "define('AFF_CURRENCY','") && isset($siteDetails['aff_currency']) && $siteDetails['aff_currency'] != ""){
				            $filecontent .= "define('AFF_CURRENCY','".$siteDetails['aff_currency']."');\r\n";
				        }
				        else if(strstr($data[$counter], "define('SEARCH_PAGE_DISPLAY','") && isset($siteDetails['search_page_display']) && $siteDetails['search_page_display'] != ""){
				            $filecontent .= "define('SEARCH_PAGE_DISPLAY','".$siteDetails['search_page_display']."');\r\n";
				        }
				        else if(strstr($data[$counter], "define('SEARCH_PAGE_ROWS','") && isset($siteDetails['search_page_rows']) && $siteDetails['search_page_rows'] != "" && $siteDetails['search_page_rows'] != "0"){
				            $filecontent .= "define('SEARCH_PAGE_ROWS','".$siteDetails['search_page_rows']."');\r\n";
				        }
				        else if(strstr($data[$counter], "define('SEARCH_WITHOUT_PICS','") && isset($siteDetails['search_without_pics']) && $siteDetails['search_without_pics'] != ""){
				            $filecontent .= "define('SEARCH_WITHOUT_PICS','".$siteDetails['search_without_pics']."');\r\n";
				        }
				        else if(strstr($data[$counter], "define('MATCH_PAGE_ROWS','") && isset($siteDetails['match_page_rows']) && $siteDetails['match_page_rows'] != "" && $siteDetails['match_page_rows'] != "0"){
				            $filecontent .= "define('MATCH_PAGE_ROWS','".$siteDetails['match_page_rows']."');\r\n";
				        }
				        else if(strstr($data[$counter], "define('D_STATUSMSG','") && isset($siteDetails['d_statusmsg']) && $siteDetails['d_statusmsg'] != ""){
				            $filecontent .= "define('D_STATUSMSG','".$siteDetails['d_statusmsg']."');\r\n";
				        }
				        else if ( strstr($data[$counter], "define('D_FREE','") && isset($siteDetails['d_free']) && $siteDetails['d_free'] != ""){
				            $filecontent .= "define('D_FREE','".$siteDetails['d_free']."');\r\n";
				        }
				        
				        else if ( strstr($data[$counter], "define('D_MUST_UPGRADE','") && isset($siteDetails['d_must_upgrade']) && $siteDetails['d_must_upgrade'] != ""){
				            $filecontent .= "define('D_MUST_UPGRADE','".$siteDetails['d_must_upgrade']."');\r\n";
				        }
				        else if ( strstr($data[$counter], "define('ENABLE_ADULTCONTENT','") && isset($siteDetails['enable_adultcontent']) && $siteDetails['enable_adultcontent'] != ""){
				            $filecontent .= "define('ENABLE_ADULTCONTENT','".$siteDetails['enable_adultcontent']."');\r\n";
				        }
				        else if ( strstr($data[$counter], "define('D_GENDERMATCHING','") && isset($siteDetails['d_gendermatching']) && $siteDetails['d_gendermatching'] != ""){
				            $filecontent .= "define('D_GENDERMATCHING','".$siteDetails['d_gendermatching']."');\r\n";
				        }
				        else if ( strstr($data[$counter], "define('MUST_HAVE_IMAGE','") && isset($siteDetails['must_have_image']) && $siteDetails['must_have_image'] != ""){
				            $filecontent .= "define('MUST_HAVE_IMAGE','".$siteDetails['must_have_image']."');\r\n";
				        }
				        else if ( strstr($data[$counter], "define('VALIDATE_EMAIL','") && isset($siteDetails['validate_email']) && $siteDetails['validate_email'] != ""){
				            $filecontent .= "define('VALIDATE_EMAIL','".$siteDetails['validate_email']."');\r\n";
				        }

						else if ( strstr($data[$counter], "define('APPROVE_ACCOUNTS','") && isset($siteDetails['approve_accounts'])&& $siteDetails['approve_accounts'] != ""){
							$filecontent .= "define('APPROVE_ACCOUNTS','".$siteDetails['approve_accounts']."');\r\n";
						}



						else if ( strstr($data[$counter], "define('USE_SMTP','") && isset($siteDetails['use_smtp']) && $siteDetails['use_smtp'] != ""){
	                        $filecontent .= "define('USE_SMTP','".$siteDetails['use_smtp']."');\r\n";
	                    }
	                    else if ( strstr($data[$counter], "define('SMTP_SERVER','") && isset($siteDetails['smtp_server']) && $siteDetails['smtp_server'] != ""){
	                        $filecontent .= "define('SMTP_SERVER','".$siteDetails['smtp_server']."');\r\n";
	                    }
	                    else if ( strstr($data[$counter], "define('SMTP_PORT','") && isset($siteDetails['smtp_port']) && $siteDetails['smtp_port'] != ""){
	                        $filecontent .= "define('SMTP_PORT','".$siteDetails['smtp_port']."');\r\n";
	                    }
	                    else if ( strstr($data[$counter], "define('SMTP_FROM_NAME','") && isset($siteDetails['smtp_from_name']) && $siteDetails['smtp_from_name'] != ""){
	                        $filecontent .= "define('SMTP_FROM_NAME','".$siteDetails['smtp_from_name']."');\r\n";
	                    }
	                    else if ( strstr($data[$counter], "define('SMTP_USERNAME','") && isset($siteDetails['smtp_username']) && $siteDetails['smtp_username'] != ""){
	                        $filecontent .= "define('SMTP_USERNAME','".$siteDetails['smtp_username']."');\r\n";
	                    }
	                    else if ( strstr($data[$counter], "define('SMTP_PASSWORD','") && isset($siteDetails['smtp_password']) && $siteDetails['smtp_password'] != "") {
	                       $filecontent .= "define('SMTP_PASSWORD','".$siteDetails['smtp_password']."');\r\n";
	                    }


	                    else if ( strstr($data[$counter], "define('SEMAIL_JOIN','") && isset($siteDetails['semail_join']) && $siteDetails['semail_join'] != ""){
                            $filecontent .= "define('SEMAIL_JOIN','".$siteDetails['semail_join']."');\r\n";
                        }
                        elseif ( strstr($data[$counter], "define('SEMAIL_UPDATE','") && isset($siteDetails['semail_update']) && $siteDetails['semail_update'] != ""){
                            $filecontent .= "define('SEMAIL_UPDATE','".$siteDetails['semail_update']."');\r\n";
                        }
                        elseif ( strstr($data[$counter], "define('SEMAIL_FILES','") && isset($siteDetails['semail_files']) && $siteDetails['semail_files'] != ""){
                            $filecontent .= "define('SEMAIL_FILES','".$siteDetails['semail_files']."');\r\n";
                        }
                        elseif ( strstr($data[$counter], "define('SEMAIL_GROUPS','") && isset($siteDetails['semail_groups']) && $siteDetails['semail_groups'] != ""){
                            $filecontent .= "define('SEMAIL_GROUPS','".$siteDetails['semail_groups']."');\r\n";
                        }
                        elseif ( strstr($data[$counter], "define('SEMAIL_CLASSADS','") && isset($siteDetails['semail_classads']) && $siteDetails['semail_classads'] != ""){
                            $filecontent .= "define('SEMAIL_CLASSADS','".$siteDetails['semail_classads']."');\r\n";
                        }
                        elseif ( strstr($data[$counter], "define('SEMAIL_BLOG','") && isset($siteDetails['semail_blog']) && $siteDetails['semail_blog'] != ""){
                            $filecontent .= "define('SEMAIL_BLOG','".$siteDetails['semail_blog']."');\r\n";
                        }
                        elseif ( strstr($data[$counter], "define('SEMAIL_FORUM','") && isset($siteDetails['semail_forum']) && $siteDetails['semail_forum'] != ""){
                            $filecontent .= "define('SEMAIL_FORUM','".$siteDetails['semail_forum']."');\r\n";
                        }
                        elseif ( strstr($data[$counter], "define('SEMAIL_LOGIN','") && isset($siteDetails['semail_login']) && $siteDetails['semail_login'] != ""){
                            $filecontent .= "define('SEMAIL_LOGIN','".$siteDetails['semail_login']."');\r\n";
                        }
                        elseif ( strstr($data[$counter], "define('SEMAIL_TEMPLATE','") && isset($siteDetails['semail_template']) && $siteDetails['semail_template'] != ""){
                            $filecontent .= "define('SEMAIL_TEMPLATE','".$siteDetails['semail_template']."');\r\n";
                        }

						else{
							$filecontent .= $data[$counter];
					  	}
						$counter ++;
					}
					fclose($file_config);
				}
				
				//now we have to write in all the new data to this file
		   		if (!$handle = fopen($config, 'w')) { 
					echo "Cannot open file ($filename)"; 
					exit; 
			   	}
			   // Write $somecontent to our opened file. 
			   	if (fwrite($handle, $filecontent) === FALSE) { 
					echo "Cannot write to file ($filename)"; 
					exit; 
			   	} 
			   	fclose($handle);
			   
			   	$ErrorSend=1;

				}
				
				if (file_exists($config_db)) {

				if (!$file_config_db = fopen($config_db, 'a+b')) {
				
					die("There was an error opening your config.php file. Please make sure it exsits and is located in the inc/ directory.");
				
				}
				else {
				
					$data = array();
					$counter = 1;
					$filecontent = "";
				
					while (!feof($file_config_db)) {

						$data[$counter] = fgets($file_config_db);
						
						if ( strstr($data[$counter], "'DB_HOST','REPLACE_DB_HOST'") ) {

							// MySQL host name (usually:localhost)
							
							$filecontent .= str_replace('REPLACE_DB_HOST', $site['market_database_path'], $data[$counter]);

						}
						else if(strstr($data[$counter], "'DB_USER','REPLACE_DB_USER'")){

							// MySQL username
							
							$filecontent .= str_replace('REPLACE_DB_USER', $site['market_database_username'], $data[$counter]);

						}
						else if(strstr($data[$counter], "'DB_PASS','REPLACE_DB_PASS'")){
							
							// MySQL password
							
							$filecontent .= str_replace('REPLACE_DB_PASS', $site['market_database_password'], $data[$counter]);

						}
						else if(strstr($data[$counter], "'DB_BASE','REPLACE_DB_BASE'")){
							
							// MySQL database
							
							$filecontent .= str_replace('REPLACE_DB_BASE', $site['market_database_name'], $data[$counter]);

						}
						else if(strstr($data[$counter], "'DB_DOMAIN','REPLACE_DB_DOMAIN'")){
							
							//Domain Name

							$filecontent .= str_replace('REPLACE_DB_DOMAIN', $config_url.'/', $data[$counter]);

						}
						else if(strstr($data[$counter], "'MARKET_DIR','REPLACE_MARKET_DIR'")){
							
							//Market Directory

							$filecontent .= str_replace('REPLACE_MARKET_DIR', $market_name, $data[$counter]);

						}
						else if(strstr($data[$counter], "'PATH_MARKET','REPLACE_PATH_MARKET'")){
							
							//Domain Name

							$filecontent .= str_replace('REPLACE_PATH_MARKET', $_SERVER['DOCUMENT_ROOT'].'/wld/'.$market_name.'/', $data[$counter]);

						}
						else if(strstr($data[$counter], "'DB_TEMP','REPLACE_DB_TEMP'")){
							
							//Domain Name

							$filecontent .= str_replace('REPLACE_DB_TEMP', $template, $data[$counter]);

						}
						else{

							$filecontent .= $data[$counter];
					  	
					  	}

						$counter ++;
					}
					fclose($file_config_db);
				}
				//now we have to write in all the new data to this file
			   if (!$handle = fopen($config_db, 'w')) { 
					 echo "Cannot open file ($filename)"; 
					 exit; 
			   }
			   // Write $somecontent to our opened file. 
			   if (fwrite($handle, $filecontent) === FALSE) { 
				   echo "Cannot write to file ($filename)"; 
				  exit; 
			   } 
			   fclose($handle);
			   
			   $ErrorSend=1;
			}

				
			if (file_exists($config_packageaccess)) {
					                 
				global $DB;   
	            
			                    
	            if( isset($site_id) && $site_id != '0' ){

					$filecontent = "<?\n";

					$dbh = getMarketDBConnection($market_id);

					$query = $dbh->query("SELECT COUNT(*) AS count, GROUP_CONCAT(DISTINCT(pid)) AS ids FROM `package` WHERE site_id = '0'");

					$query->execute();

					$packageIDS = $query->fetch();
					
					$PACKIDS = explode(",",trim($packageIDS['ids']));
		             
	                $t=1;

	                foreach($PACKIDS as $package_id){

		                if(trim($package_id) == ""){
		                    continue;
		                }
		                // Market Package

		                $package_exists = $DB->Row("SELECT COUNT(*) AS  count FROM wld_site_package_settings WHERE market_id = '$market_id' AND site_id = '0' AND package_id = '$package_id'");

		                if($package_exists['count']  == '0'){

			                $package_data = $DB->Query("SELECT * FROM wld_site_package_settings WHERE market_id ='0' AND site_id ='0' AND package_id = '3' ORDER BY id");

			                while ( $data = $DB->NextRow($package_data)) {

								$DB->Update("INSERT INTO wld_site_package_settings(market_id,site_id,package_id,page_name,page_key,page_label,page_value) VALUES('$market_id','0','".$package_id."','".$data['page_name']."','".mysql_real_escape_string($data['page_key'])."','".mysql_real_escape_string($data['page_label'])."','0')");
					                                    
							}

				        }

		                // Market Site Package

		                $package_exists = $DB->Row("SELECT COUNT(*) AS  count FROM wld_site_package_settings WHERE market_id = '$market_id' AND site_id = '$site_id' AND package_id = '$package_id'");

		                if($package_exists['count']  == '0'){

		                    $package_data = $DB->Query("SELECT * FROM wld_site_package_settings WHERE market_id ='0' AND site_id ='0' AND package_id = '3' ORDER BY id");

		                    while ( $data = $DB->NextRow($package_data)) {
		                                    
		                        $DB->Update("INSERT INTO wld_site_package_settings(market_id,site_id,package_id,page_name,page_key,page_label,page_value) VALUES('$market_id','$site_id','".$package_id."','".$data['page_name']."','".mysql_real_escape_string($data['page_key'])."','".mysql_real_escape_string($data['page_label'])."','0')");

		                    }

		                }


		                $DB->Update("UPDATE wld_site_package_settings SET page_value = '0' WHERE market_id = '$market_id' AND site_id = '$site_id' AND package_id = '$package_id'");
		                            
	                    if($package_id !="" && is_numeric($package_id)){

			                $filecontent .= "$"."PACKAGEACCESS[".$package_id."] = array( \n";

			                $accesses = $DB->Query("SELECT * FROM wld_site_package_settings WHERE market_id = '$market_id' AND site_id = '0' AND package_id = '$package_id' AND page_value = '1'");

			                while($access =  $DB->NextRow($accesses)){

		                        $filecontent .="'".$access['page_name']."-".$access['page_key']."',\n";
			                    $t++;

			                }
			                $filecontent .= ");";
			                $t=1;
		            	}
		        	}

			        $filename = $config_packageaccess;
			        if (!$file = fopen($filename, 'a+b')) {
		    	        die("There was an error opening your config.php file. Please make sure it exsits and is located in the inc/ directory.");
		        	} else {

			            $filecontent .= " \n ?>";
			            //now we have to write in all the new data to this file
			            if (!$handle = fopen($filename, 'w')) {
			                echo "Cannot open file ($filename)";
			                exit;
			            }
			            // Write $somecontent to our opened file.
			            if (fwrite($handle, $filecontent) === FALSE) {
			                echo "Cannot write to file ($filename)";
			                exit;
			            }
			            fclose($handle);
			        }

			    }
				    

	    	}


			$DB->Update("UPDATE wld_sites SET approved = 'yes' where wld_site_id = $id");

		   	}else{

		   		$DB->Update("UPDATE wld_sites SET approved = 'no' where wld_site_id = $id");

			}

		}
	else if(($field =="files.approved" || trim($field) =="files.adult_content" || $field =="files.featured") && $bits[0] =="files" || $bits[0] =="members" || $bits[0] =="members_billing" || trim($field) == "banners.active" || trim($field) == "banners.approved" || trim($field) == "template_pages.approved"){

		$market_id = $_GET['market_id'];

		WLDChangeYesNo($field,$id,$bits[0],$yesno,$market_id,$table);

		echo '<span style="color:#000000">Status updated successfully.</span>';

	}
	else if($field =="wld_metatags.approved"){

		global $DB;

		$metadata = $DB->Row("SELECT * FROM wld_metatags WHERE site_id = '$id'");

		$data = array();

		$data = array('m1' => $metadata['custom_title_prefix'], 'm2' => $metadata['description_prefix'], 'm3' => $metadata['keyword_prefix'], 'site_id' => $metadata['site_id'], 'h1' => $metadata['page_title'], 'h2' => $metadata['description'], 'h3' => $metadata['keywords'], 'yesno' => $yesno);		

		$result = WLDUpdateSteMetaTags($data);

		echo '<span style="color:#000000">Updated successfully.</span>';

	}
	else if($field =="wld_home_page_text.approved"){

		global $DB;

		$metadata = $DB->Row("SELECT * FROM wld_home_page_text WHERE site_id = '$id'");

		$data = array();

		$data = array('txt1' => $metadata['welcome_title'], 'txt2' => $metadata['welcome_subtitle'], 'txt3' => $metadata['intro_title'], 'txt4' => $metadata['intro_subtitle'], 'txt5' => $metadata['intro_title_extra'], 'txt6' => $metadata['intro_subtitle_extra'], 'site_id' => $metadata['site_id'], 'yesno' => $yesno);		

		$result = WLDUpdateSiteText($data);

		echo '<span style="color:#000000">Updated successfully.</span>';

	}


	
	} break;

	case "WLDEditRow": {

	if(ADMIN_DEMO == "yes"){ print "Disabled in Demo Mode"; return; }

		$id = trim(strip_tags($_GET['id']));
		$field = str_replace(" AS description_media","", trim(strip_tags($_GET['field'])));
		$value = trim(strip_tags($_GET['value']));
		$table = trim(strip_tags($_GET['table']));
		$bits = explode(".",$field);
		$bits1 = explode(".",$table);
		
		$market_id = trim(strip_tags($_GET['market_id']));
		$site_id = trim(strip_tags($_GET['site_id']));
		
		$market = getMarket($market_id);

		$dbh = new PDO('mysql:host='.$market['market_database_path'].';dbname='.$market['market_database_name'].';charset=utf8mb4', $market['market_database_username'], $market['market_database_password']);
			
		$sql = "UPDATE ".$bits[0]." SET ".$field."='".eMeetingInput($value)."' WHERE ".$bits1[1]." = '". $id ."' LIMIT 1";

		$stmt = $dbh->prepare($sql);
	                                              
		//$stmt->bindParam(':field', $yesno, PDO::PARAM_STR);       
		//$stmt->bindParam(':condition_field', $id, PDO::PARAM_STR); 
		$stmt->execute();
	 
		print "Changes Saved";

	} break;

	case "EditRow": {

	if(ADMIN_DEMO == "yes"){ print "Disabled in Demo Mode"; return; }

	$id = trim(strip_tags($_GET['id']));
	$field = trim(strip_tags($_GET['field']));
	$value = trim(strip_tags($_GET['value']));
	$table = trim(strip_tags($_GET['table']));
	$bits = explode(".",$field);
	$bits1 = explode(".",$table);
	
	if($bits[0] == "members_privacy" && $bits1[1] =="id"){ $bits1[1] = "uid"; }

	$field = str_replace("AS Transaction","",$field);
	 
	if($bits[0] =="members_data"){ $bits1[1]="uid";}

	$DB->Update("UPDATE ".$bits[0]." SET ".$field."='".eMeetingInput($value)."' WHERE ".$bits1[1]." = '". $id ."' LIMIT 1");
 
	print "Changes Saved";

	} break;

	case "ChangeLang":{

	$id = trim(strip_tags($_GET['id']));
	$field = trim(strip_tags($_GET['field']));
	$current = trim(strip_tags($_GET['current']));
 	$div = (isset($_GET['div'])) ? trim(strip_tags($_GET['div'])) : '';

	print eMeetingTableLangs($current,$div,$id,$field);
	
	} break;


	case "SaveLang":{

	if(ADMIN_DEMO == "yes"){ print "Disabled in Demo Mode"; return; }

	$id = trim(strip_tags($_GET['id']));
	$field = trim(strip_tags($_GET['field']));
	$value = trim(strip_tags($_GET['value']));
	$table = trim(strip_tags($_GET['table']));
 	$div = (isset($_GET['div'])) ? trim(strip_tags($_GET['div'])) : '';
	$bits = explode(".",$field);
	$bits1 = explode(".",$table);

	$DB->Update("UPDATE ".$bits1[0]." SET ".$field."='".eMeetingInput($value)."' WHERE ".$bits1[1]." = '". $id ."' LIMIT 1");
	
	print "<img src=\"".DB_DOMAIN."images/language/flag_".$value.".gif\" align='absmiddle'> ".eMeetingInput($value);

	} break;

	case 'editbasicprofileinfo':
			$data = $_POST;
			foreach($data as $key => $value):
				if($key =='hid' || $key =='chk'){
					if($key =='hid'){
						$chkbs = $value;

						$mFieldValues = array();

						foreach ($chkbs as $index => $chk) {

							

							if(isset($_POST['chk'][$index])) {

								$check = 1;

							}
							else{

								$check = 0;

							}

							$field = explode("___", $index);
						
							$mFieldValues[$field['0']][$field['1']] = $check;
							
							//$DB->Update("UPDATE members_data SET ".$field." = '".implode("**", $mFieldValues)."' WHERE uid=".$data['uid']);

						}
						$dbh = getMarketDBConnection($_GET['market_id']);
						foreach ($mFieldValues as $field => $fieldValue) {
								
							$stmt = $dbh->prepare("UPDATE members_data SET ".$field." = '".implode("**", $fieldValue)."' WHERE uid=".$data['uid']);

							$stmt->execute();
						}
					}
				}
				else if($key!='uid'){
					$dbh = getMarketDBConnection($_GET['market_id']);
					$stmt = $dbh->prepare("UPDATE members_data SET ".$key." = '".$value."' WHERE uid=".$data['uid']);
					$stmt->execute();
				}
			endforeach;
			echo "true";
	break;

	case 'editprofileinfo':
	
			$data = $_POST;
			foreach($data as $key => $value){
				if($key != 'email' && $key!='password'  && $key!='repeat-password' && $key!='uid' && $key!='okvalue'):
					$DB->Update("UPDATE members_data SET ".$key." = '".$value."' WHERE uid=".$_REQUEST['uid']);
				endif;
			}
			if($data['password']!='' && $data['repeat-password']!=''):
			
				if($data['password'] == $data['repeat-password']):
					
					$DB->Update("UPDATE members SET email = '".$data['email']."', password = '".md5($data['password'])."' WHERE id=".$_REQUEST['uid']);
				else:
					echo "Password do not match";
					exit;
				endif;
			endif;
				
			echo "Updated Successfully!!!";
						
	break;
	
	case 'edittagline':
			$market_id = trim(strip_tags($_GET['market_id']));

			$dbh = getMarketDBConnection($market_id);
			$fieldval = $_POST['headline'];
			//$questionval = $_REQUEST[$fieldval];
			$stmt = $dbh->prepare("UPDATE members_data SET `headline` = '".$fieldval."' WHERE uid=".$_REQUEST['mid']);

			$stmt->execute();

			echo $fieldval;
	break;
	
	case 'editmylocation':
			$fieldval = $_POST;
			$questionval = $_REQUEST[$fieldval];
			$year = $fieldval['birthdayyear'];
			$month = $fieldval['birthdaymonth'];
			$day = $fieldval['birthdayday'];
			$age = $year.'-'.$month.'-'.$day;

			$dbh = getMarketDBConnection($_GET['market_id']);
			if($fieldval['FieldValue54']){
				$stmt = $dbh->prepare("UPDATE `members_data` SET `country` = '".$fieldval['country']."',`em_85820081128` = ".$fieldval['FieldValue54'].",`location` = '".$fieldval['location']."', `age` = '".$age."', `gender` = '".$fieldval['gender']."', `em_8cx20070511`= ".$fieldval['orientation']." WHERE uid=".$fieldval['mid']);
				$stmt->execute();
			} else{
				$stmt = $dbh->prepare("UPDATE `members_data` SET `country` = '".$fieldval['country']."',`location` = '".$fieldval['location']."', `age` = '".$age."', `gender` = '".$fieldval['gender']."', `em_8cx20070511`= ".$fieldval['orientation']." WHERE uid=".$fieldval['mid']);
				$stmt->execute();
			}
			echo "done";
	break;
	
	case "ChangeDiv":{
	
	$id = trim(strip_tags($_GET['id']));
	$field = trim(strip_tags($_GET['field']));
	$current = trim(strip_tags($_GET['current']));
 	$div = (isset($_GET['div'])) ? trim(strip_tags($_GET['div'])) : '';
	$switchMe = trim(strip_tags($_GET['switchMe']));
 	switch($switchMe){

	case "membership": { print "<select onChange=\"eMeetingSaveDivWld('".$div."','membership',this.value,'".$id."')\">".DisplayPackage($current)."</select>"; } break;
	case "status": { print "<select onChange=\"eMeetingSaveDivWld('".$div."','status',this.value,'".$id."')\">".DisplayStatus($current)."</select>"; } break;
	case "gender": { print "<select onChange=\"eMeetingSaveDivWld('".$div."','gender',this.value,'".$id."')\">".DisplayGenderList($current)."</select>"; } break;
	case "country": { print "<select onChange=\"eMeetingSaveDivWld('".$div."','country',this.value,'".$id."')\">".DisplayCountryList($current)."</select>"; } break;
 

	default: { print "Nothing Selected??"; }

	}
	
	} break;

	case "SaveDiv": {

	if(ADMIN_DEMO == "yes"){ print "Disabled in Demo Mode"; return; }

	$id = trim(strip_tags($_GET['id']));
	$value = trim(strip_tags($_GET['value']));
	$type = trim(strip_tags($_GET['type']));
 	$div = (isset($_GET['div'])) ? trim(strip_tags($_GET['div'])) : '';
 	
 	$market_id = (isset($_GET['market_id'])) ? $_GET['market_id'] : 0;
	$site_id = (isset($_GET['site_id'])) ? $_GET['site_id'] : 0;

 	$market = getMarket($market_id);

	$dbh = new PDO('mysql:host='.$market['market_database_path'].';dbname='.$market['market_database_name'].';charset=utf8mb4', $market['market_database_username'], $market['market_database_password']);


	switch($type){

	case "membership": {

	$SQL = "UPDATE members SET packageid='".$value."', activate_code='OK' WHERE id='".$id."' LIMIT 1";
	$stmt = $dbh->prepare($SQL);
	$stmt->execute();
	print "<div id='".$div."' onClick=\"eMeetingChangeDivWld('membership','".$div."', '".$value."','".$id."','0')\" style='cursor:pointer;'/>".GetPackageName($value)."</div>";

	} break;



	case "location": {

	$SQL="UPDATE members_data SET location='".$value."' WHERE uid='".$id."' LIMIT 1";

	$stmt = $dbh->prepare($SQL);
	$stmt->execute();
	
	} break;

	case "status": {

	if(ADMIN_DEMO == "yes"){ print "Disabled in Demo Mode"; return; }

	if($value == '---') { $value = 'active'; }

	$SQL="UPDATE members SET active='".$value."' WHERE id='".$id."' LIMIT 1";
	$stmt = $dbh->prepare($SQL);
	$stmt->execute();

	//	SEND EMAIL TO MEMBER
	if($value =="active" || $value =="suspended"){
		$SQL="SELECT members.* FROM members WHERE id='".$id."' LIMIT 1";
		
		$stmt = $dbh->prepare($SQL);

		$stmt->execute();
		$Data = $stmt->fetch();

		switch($value){
		
			case "active": { SendTemplateMail($Data, 17); } break;
			case "suspended": { SendTemplateMail($Data, 58); } break;
	
		}
	}
	print "<div id='".$div."' onClick=\"eMeetingChangeDiv('status','".$div."', '".$value."','".$id."','0')\" style='cursor:pointer;'/>".$value."</div>";


	} break;

	case "gender": {

	if(ADMIN_DEMO == "yes"){ print "Disabled in Demo Mode"; return; }

	$SQL="UPDATE members_data SET gender='".$value."' WHERE uid='".$id."' LIMIT 1";

	$stmt = $dbh->prepare($SQL);
	$stmt->execute();

	print "<div id='".$div."' onClick=\"eMeetingChangeDiv('gender','".$div."', '".$value."','".$id."','0')\" style='cursor:pointer;'/>".$_SESSION['g_array'][$value]['icon']." ".$_SESSION['g_array'][$value]['caption']."</div>";

	} break;

	case "country": {

	if(ADMIN_DEMO == "yes"){ print "Disabled in Demo Mode"; return; }

	$SQL="UPDATE members_data SET country='".$value."' WHERE uid='".$id."' LIMIT 1";

	$stmt = $dbh->prepare($SQL);
	$stmt->execute();


	print "<div id='".$div."' onClick=\"eMeetingChangeDiv('country','".$div."', '".$value."','".$id."','0')\" style='cursor:pointer;'/>".$value."</div>";

	} break;



	}

	} break;
	
	case 'pagestatusupdate': {

		global $DB;

		$DB->Query("UPDATE wld_site_pages SET approved = 'yes' WHERE id = '".$_GET['page_id']."'");

		echo "Pages Approved Successfully.";

	} break;

	case 'settings_membership': {

	// membership settings
	$market_id = (isset($_REQUEST['market_id'])) ? $_REQUEST['market_id']: 0;
	$site_id = (isset($_REQUEST['site_id'])) ? $_REQUEST['site_id']: 0;
	$change_sites = (isset($_REQUEST['change_sites'])) ? $_REQUEST['change_sites']: 0;
	$market_site_settings = getMarketSiteSearchMemberSettings($market_id,$site_id);	
	?>

   	   	<input type="hidden" name="do" value="settings_membership"/>
	   	<input type="hidden" name="p" value="settings"/>
	   	<input type="hidden" name="market_id" value="<?php echo $market_id;?>"/>
	   	<input type="hidden" name="site_id" value="<?php echo $site_id;?>"/>
	   	<input type="hidden" name="change_sites" value="<?php echo $change_sites;?>"/>
	   	<div class="admin-note">
			<p id="TopCommentsBox"><img src="inc/images/icons/help.png" align="admin-note-text"> Use the options below to customize the way your web site membership setup is displayed.</p>	
		</div>
		<ul class="form">

			<li>
				<label>Default Status Message</label>
				<input type="text" name="ssmsg" value="<?= $market_site_settings['d_statusmsg'] ?>" class="input">
				<div class="tip">This is the member status message used by members to describe what they are doing or looking for today! This value is added to their account during registration.</div>
			</li>
			
	  
	 		<input name="submit2" type="submit" class="MainBtn" value="<?=$admin_button_val[8] ?>">

		</ul>


  		<ul class="form">

			<li>
				<label ><?=$admin_settings_extra[23] ?></label>
				<select name="free" style="width:100px;" class="input">
					<option value="yes" <?php if($market_site_settings['d_free']=="yes"){ print "selected";} ?>><?=$admin_selection[1] ?></option>
					<option value="no" <?php if($market_site_settings['d_free']=="no"){ print "selected";} ?>><?=$admin_selection[2] ?></option>
				</select>
				<div class="tip"><?=$admin_settings_extra[24] ?></div>
			</li>
	
			<?php if($market_site_settings['d_free'] =="no"){ ?>

			<li style="background:#FDE8CF;">
				<label><?=$admin_settings_extra[19] ?>: </label>
				<select name="mid" style="width:250px;" class="input">
					<?=DisplayPackage($market_site_settings['default_package']) ?>
				</select>
				<div class="tip"><?=$admin_settings_extra[20] ?></div>
			</li>       

			<li style="background:#FDE8CF;">
				<label>Must Upgrade After Registration: </label>
				<select name="mustupgrade" style="width:150px;" class="input">
					<option value="yes" <?php if($market_site_settings['d_must_upgrade']=="yes"){ print "selected";} ?>>Yes</option>
					<option value="no" <?php if($market_site_settings['d_must_upgrade']=="no"){ print "selected";} ?>>No</option>
				</select>
				<div class="tip">You if select yes then the member will always be redirected to the upgrade page until they upgrade their account from the default membership package.</div>
			</li>       

			<li  style="background:#FDE8CF;">
				<label >Enable Adult Content</label>
				<select name="eadult" style="width:100px;" class="input">
					<option value="yes" <?php if($market_site_settings['enable_adultcontent']=="yes"){ print "selected";} ?>><?=$admin_selection[1] ?></option>
					<option value="no" <?php if($market_site_settings['enable_adultcontent']=="no"){ print "selected";} ?>><?=$admin_selection[2] ?></option>
				</select>
				<div class="tip">If you would like to run your website so that members can upload adult content files, please select yes otherwise the website will accept all content.</div>
			</li>		
			<?php } ?>

			<li>
				<label>Display My Gender</label>
				<select name="egender" style="width:100px;" class="input">
					<option value="0" <?php if($market_site_settings['d_gendermatching']=="0"){ print "selected";} ?>><?=$admin_selection[1] ?></option>
					<option value="1" <?php if($market_site_settings['d_gendermatching']=="1"){ print "selected";} ?>><?=$admin_selection[2] ?></option>
				</select>

				<div class="tip">If you disable this then members who login will not see other members with the same gender as them in the search results.</div>
			</li>		


 			<input name="submit2" type="submit" class="MainBtn" value="<?=$admin_button_val[8] ?>">
 
		</ul>



	  	<ul class="form">
		   	<li>
			   	<label><?=$admin_settings_extra[21] ?></label>
			   	<select name="must" style="width:100px;" class="input">
			   		<option value="1" <?php if($market_site_settings['must_have_image']==1){ print "selected";} ?>><?=$admin_selection[1] ?></option>
			   		<option value="0" <?php if($market_site_settings['must_have_image']==0){ print "selected";} ?>><?=$admin_selection[2] ?></option>
			   	</select>
		   		<div class="tip"><?=$admin_settings_extra[22] ?></div>
		   	</li>


			<li>
				<label><?=$admin_settings_extra[31] ?></label>
				<select name="valemail" style="width:100px;" class="input">
					<option value="1" <?php if($market_site_settings['validate_email']==1){ print "selected";} ?>><?=$admin_selection[1] ?></option>
					<option value="0" <?php if($market_site_settings['validate_email']==0){ print "selected";} ?>><?=$admin_selection[2] ?></option>
				</select>
				<div class="tip"><?=$admin_settings_extra[32] ?> </div>
			</li>

 			<input name="submit2" type="submit" class="MainBtn" value="<?=$admin_button_val[8] ?>">

		</ul>
	
		<ul class="form">

			<li>
				<label>Manually Approve Content</label>
				<select name="appmem" style="width:100px;" class="input">
					<option value="yes" <?php if($market_site_settings['approve_accounts']=="yes"){ print "selected";} ?>><?=$admin_selection[1] ?></option>
					<option value="no" <?php if($market_site_settings['approve_accounts']=="no"){ print "selected";} ?>><?=$admin_selection[2] ?></option>
				</select>
				<div class="tip">Everytime a member updates their profile, creates a new blog post, group or classified ad you can decide to manually approve this content before its displayed live on your website. An email will be emailed to each of the website administrators to inform them new content is waiting approval.</div>
			</li>
				
		    <li>
		    	<label><?=$admin_settings_extra[35] ?></label>
		    	<select name="files" style="width:100px;" class="input">
		    		<option value="yes" <?php if($market_site_settings['approve_files']=="yes"){ print "selected";} ?>><?=$admin_selection[1] ?></option>
		    		<option value="no" <?php if($market_site_settings['approve_files']=="no"){ print "selected";} ?>><?=$admin_selection[2] ?></option>
				</select>
				<div class="tip"><?=$admin_settings_extra[36] ?></div>
			</li>

 			<input name="submit2" type="submit" class="MainBtn" value="<?=$admin_button_val[8] ?>">

		</ul>


		<ul class="form">

			<li>
				<label>Reset Member Ratings</label>
				<input name="ratingreset" type="checkbox" value="1">
				<div class="tip">Check this box if you wish to reset all the member profile ratings.</div>
			</li>
			
			<input name="submit2" type="submit" class="MainBtn" value="<?=$admin_button_val[8] ?>">

		</ul>

	

<?php } break;
	case 'settings_search': { 
	// search settings ?>

		<?php

		$market_id = (isset($_REQUEST['market_id'])) ? $_REQUEST['market_id']: 0;
		$site_id = (isset($_REQUEST['site_id'])) ? $_REQUEST['site_id']: 0;
		$market_site_settings = getMarketSiteSearchMemberSettings($market_id,$site_id);

   		?>
   		
	   	<input type="hidden" name="do" value="search_settings"/>
	   	<input type="hidden" name="p" value="settings"/>
	   	<input type="hidden" name="market_id" value="<?php echo $market_id;?>"/>
	   	<input type="hidden" name="site_id" value="<?php echo $site_id;?>"/>

	   	<div class="admin-note">
			<p id="TopCommentsBox"><img src="inc/images/icons/help.png" align="admin-note-text"> Use the options below to customize the way your search pages are displayed throughout your web site.</p>	
		</div> 

	  	<ul class="form">

		  	<li>
				<label>Default Search View</label>
				<select name="search_view" class="input">
					<option value="basic" <?php if($market_site_settings['search_page_display'] =='basic'){ print "selected"; } ?>>Basic View</option>
					<option value="detail" <?php if($market_site_settings['search_page_display'] =='detail'){ print "selected"; } ?>>Detailed View</option>
					<option value="gallery" <?php if($market_site_settings['search_page_display'] =='gallery'){ print "selected"; } ?>>Gallery View</option>		
					
				</select>
			</li>

			<li>
				<label ><?=$admin_settings_extra[27] ?></label>
		      	<select name="searchrows" style="width:100px;" class="input">
					<option value="2"<?php if($market_site_settings['search_page_rows'] =='2'){ print "selected"; } ?>>2</option>
					<option value="4" <?php if($market_site_settings['search_page_rows'] =='4'){ print "selected"; } ?>>4</option>
					<option value="6" <?php if($market_site_settings['search_page_rows'] =='6'){ print "selected"; } ?>>6</option>
					<option value="8" <?php if($market_site_settings['search_page_rows'] =='8'){ print "selected"; } ?>>8</option>
					<option value="10" <?php if($market_site_settings['search_page_rows'] =='10'){ print "selected"; } ?>>10</option>
					<option value="12" <?php if($market_site_settings['search_page_rows'] =='12'){ print "selected"; } ?>>12</option>
					<option value="14" <?php if($market_site_settings['search_page_rows'] =='14'){ print "selected"; } ?>>14</option>
					<option value="16" <?php if($market_site_settings['search_page_rows'] =='16'){ print "selected"; } ?>>16</option>
					<option value="18"<?php if($market_site_settings['search_page_rows'] =='18'){ print "selected"; } ?>>18</option>
					<option value="20" <?php if($market_site_settings['search_page_rows'] =='20'){ print "selected"; } ?>>20</option>
					<option value="22" <?php if($market_site_settings['search_page_rows'] =='22'){ print "selected"; } ?>>22</option>
					<option value="24" <?php if($market_site_settings['search_page_rows'] =='24'){ print "selected"; } ?>>24</option>
					<option value="26" <?php if($market_site_settings['search_page_rows'] =='26'){ print "selected"; } ?>>26</option>
					<option value="28" <?php if($market_site_settings['search_page_rows'] =='28'){ print "selected"; } ?>>28</option>
					<option value="30" <?php if($market_site_settings['search_page_rows'] =='30'){ print "selected"; } ?>>30</option>
					<option value="32" <?php if($market_site_settings['search_page_rows'] =='32'){ print "selected"; } ?>>32</option>
					<option value="34" <?php if($market_site_settings['search_page_rows'] =='34'){ print "selected"; } ?>>34</option>
					<option value="36" <?php if($market_site_settings['search_page_rows'] =='36'){ print "selected"; } ?>>36</option>
					<option value="38" <?php if($market_site_settings['search_page_rows'] =='38'){ print "selected"; } ?>>38</option>
					<option value="40" <?php if($market_site_settings['search_page_rows'] =='40'){ print "selected"; } ?>>40</option>
					<option value="42" <?php if($market_site_settings['search_page_rows'] =='42'){ print "selected"; } ?>>42</option>
					<option value="44" <?php if($market_site_settings['search_page_rows'] =='44'){ print "selected"; } ?>>44</option>
					<option value="46" <?php if($market_site_settings['search_page_rows'] =='46'){ print "selected"; } ?>>46</option>
					<option value="48" <?php if($market_site_settings['search_page_rows'] =='48'){ print "selected"; } ?>>48</option>
					<option value="50" <?php if($market_site_settings['search_page_rows'] =='50'){ print "selected"; } ?>>50</option>					
				</select>
				<div class="tip"><?=$admin_settings_extra[28] ?></div>
			</li>

			<li>
				<label>Show Incomplete Profiles?</label>
				<select name="nophoto" style="width:100px;" class="input">
					<option value="yes" <?php if($market_site_settings['search_without_pics']=="yes"){ print "selected";} ?>><?=$admin_selection[1] ?></option>
					<option value="no" <?php if($market_site_settings['search_without_pics']=="no"){ print "selected";} ?>><?=$admin_selection[2] ?></option>
				</select>
				<div class="tip"><?=$admin_settings_extra[52] ?>.</div>
			</li>

			<input name="submit2" type="submit" class="MainBtn" value="<?=$admin_button_val[8] ?>">				
		</ul>

		<ul class="form">
			<li>
				<label ><?=$admin_settings_extra[29] ?></label>
	      		<select name="matchrows" style="width:100px;" class="input">
					<option value="2"<?php if($market_site_settings['match_page_rows'] =='2'){ print "selected"; } ?>>2</option>
					<option value="4" <?php if($market_site_settings['match_page_rows'] =='4'){ print "selected"; } ?>>4</option>
					<option value="6" <?php if($market_site_settings['match_page_rows'] =='6'){ print "selected"; } ?>>6</option>
					<option value="8" <?php if($market_site_settings['match_page_rows'] =='8'){ print "selected"; } ?>>8</option>
					<option value="10" <?php if($market_site_settings['match_page_rows'] =='10'){ print "selected"; } ?>>10</option>
					<option value="12" <?php if($market_site_settings['match_page_rows'] =='12'){ print "selected"; } ?>>12</option>
					<option value="14" <?php if($market_site_settings['match_page_rows'] =='14'){ print "selected"; } ?>>14</option>
					<option value="16" <?php if($market_site_settings['match_page_rows'] =='16'){ print "selected"; } ?>>16</option>
					<option value="18"<?php if($market_site_settings['match_page_rows'] =='18'){ print "selected"; } ?>>18</option>
					<option value="20" <?php if($market_site_settings['match_page_rows'] =='20'){ print "selected"; } ?>>20</option>
					<option value="22" <?php if($market_site_settings['match_page_rows'] =='22'){ print "selected"; } ?>>22</option>
					<option value="24" <?php if($market_site_settings['match_page_rows'] =='24'){ print "selected"; } ?>>24</option>
					<option value="26" <?php if($market_site_settings['match_page_rows'] =='26'){ print "selected"; } ?>>26</option>
					<option value="28" <?php if($market_site_settings['match_page_rows'] =='28'){ print "selected"; } ?>>28</option>
					<option value="30" <?php if($market_site_settings['match_page_rows'] =='30'){ print "selected"; } ?>>30</option>
					<option value="32" <?php if($market_site_settings['match_page_rows'] =='32'){ print "selected"; } ?>>32</option>
					<option value="34" <?php if($market_site_settings['match_page_rows'] =='34'){ print "selected"; } ?>>34</option>
					<option value="36" <?php if($market_site_settings['match_page_rows'] =='36'){ print "selected"; } ?>>36</option>
					<option value="38" <?php if($market_site_settings['match_page_rows'] =='38'){ print "selected"; } ?>>38</option>
					<option value="40" <?php if($market_site_settings['match_page_rows'] =='40'){ print "selected"; } ?>>40</option>
					<option value="42" <?php if($market_site_settings['match_page_rows'] =='42'){ print "selected"; } ?>>42</option>
					<option value="44" <?php if($market_site_settings['match_page_rows'] =='44'){ print "selected"; } ?>>44</option>
					<option value="46" <?php if($market_site_settings['match_page_rows'] =='46'){ print "selected"; } ?>>46</option>
					<option value="48" <?php if($market_site_settings['match_page_rows'] =='48'){ print "selected"; } ?>>48</option>
					<option value="50" <?php if($market_site_settings['match_page_rows'] =='50'){ print "selected"; } ?>>50</option>					
				</select>
				<div class="tip"><?=$admin_settings_extra[30] ?></div>
			</li>
			<input name="submit2" type="submit" class="MainBtn" value="<?=$admin_button_val[8] ?>">
		</ul>
		
<?php } break;

case 'settings_membership_packages': {

	$market_id = (isset($_GET['market_id'])) ? $_GET['market_id'] : 0;
	$site_id = (isset($_GET['site_id'])) ? $_GET['site_id'] : 0;
	?>
	<div class="admin-note">
		<p id="TopCommentsBox"><img src="inc/images/icons/help.png" align="admin-note-text"> Listed below are all the current membership packages applied to your web site. The ones highlighted in green are required by the system to control how visitors and new members are handled giving you more control of your web site.</p>
	</div> 


	<div id="contentcolumn" class="contentcolumndash">


	<ul class="form"><div class="box_body">

		<form action="" method="post" name="profile" onSubmit="return CheckMemberForm();">
		<input name="do" type="hidden" value="none" id="do" class="hidden">
		<input name="market_id" type="hidden" value="<?php echo $market_id;?>" class="hidden">
		<input name="site_id" type="hidden" value="<?php echo $site_id;?>" class="hidden">

			<table class="sortable resizable editable widefat">
            	<thead>
                	<tr> 
                    	<th scope="col"></th>
						<th scope="col"><?=$admin_table_val[22] ?></th>
	                    <th scope="col"><?=$admin_table_val[12] ?></th>
	                    <th scope="col"><?=$admin_table_val[23] ?></th>
	                    <th scope="col"><?=$admin_table_val[24] ?></th>
	                    <th scope="col">Members</th>
          				<th scope="col"><?=$admin_table_val[20] ?></th>                    
                  	</tr>
                </thead>
                <tbody>
                	<?php $totalnum = WldDisplayPackages($market_id,$site_id); ?>
                </tbody>
          	</table>
            

			<input name="NumRows" type='hidden' class='hidden' value='<?=$totalnum ?>'>
			<br class="clear">

			<div class="bar_save">

				<input type="button" value="<?=$admin_button_val[1] ?>" class="NormBtn" onClick="ca(<?=$totalnum ?>)"/>
				<input type="button" value="<?=$admin_button_val[2] ?>" class="NormBtn"  onClick="ua(<?=$totalnum ?>)"/>
				<input type="button" value="<?=$admin_button_val[5] ?>" class="MainBtn"  onclick="ChangeOption('packagedelete');"/>

			</div>
		</form>
		</div></ul>
		<a href="?p=settings&sp=wld_package&market_id=<?=$market_id?>&site_id=<?=$site_id?>" class="MainBtn">Add Package</a>

		
	</div>

	<br class="clear">

	<?php } break;

	
	case 'settings_manage_access': {

	$market_id = (isset($_GET['market_id'])) ? $_GET['market_id'] : 0;
	$site_id = (isset($_GET['site_id'])) ? $_GET['site_id'] : 0;
	
	$condition = " AND (site_id = '0'";
	
	if($site_id != '0'){

		$condition .= " OR site_id = '$site_id'";

	}

	$condition .= ") ";

	$market = getMarket($market_id);
	$market_site_settings = getMarketSiteSearchMemberSettings($market_id,$site_id);

	$dbh = getMarketDBConnection($market_id);

	?>
	<div class="admin-note">
		<p id="TopCommentsBox"><img src="inc/images/icons/help.png" align="admin-note-text"> Here you can control access to your entire web site based on membership package. <b>Note: Only tick the box if you do NOT wish the member to view that page. </b></p>	
	</div> 

	<?php

	$i=1;

	$SQL = "SELECT pid, name FROM package WHERE icon !='SMS' $condition ORDER BY pid";
	
	$result = $dbh->query($SQL);
	//$result = $DB->Query();
    foreach( $result AS $package )
    {
		$PACKARRAY[$i]['id'] 	=	$package['pid'];
		$PACKARRAY[$i]['name'] 	=	$package['name'];
		$i++;
	}

	global $DB;


	WLDAddPackageAccessFields($market_id,$site_id);

	$package_data = $DB->Query("SELECT * FROM wld_site_package_settings WHERE market_id ='$market_id' AND site_id ='$site_id' ORDER BY id");

	//$result = $DB->Query();
	$WLD_PAGE_ARRAY = array();
	$WLD_PACKAGEACCESS = array();
    
    while ( $data = $DB->NextRow($package_data))
    {
		$WLD_PAGE_ARRAY[$data['page_name']][$data['page_key']] = $data['page_label'];
		
	}

	$package_data = $DB->Query("SELECT * FROM wld_site_package_settings WHERE market_id ='$market_id' AND  site_id ='$site_id' AND page_value = '1' ORDER BY id");

	while ( $data = $DB->NextRow($package_data))
    {
		
		$WLD_PACKAGEACCESS[$data['package_id']][] = $data['page_name']."-".$data['page_key'];
	}

	?>

	<br class="clear">

	<?php if(is_array($PACKARRAY)){ ?>

		<input name="do" type="hidden" value="wldupdatepageaccess" id="do" class="hidden">
		<input type="hidden" name="market_id" value="<?=$market_id?>"/>
		<input type="hidden" name="site_id" value="<?=$site_id?>"/>
		<input name="packageIDS" type="hidden" value="<?	foreach($PACKARRAY as $pValue){ print $pValue['id'].",";	  } ?>  ">
			
			<div class="box_body manage-access" style="font-size:100%;width:100%; overflow:auto;">
				<ul style="width:100%"  border="0" style="border:0px;">

					<li class="tbl-head-manage-access">
					
						<div class="manage-access-title">Feature</div>  
						<?php
						foreach($PACKARRAY as $pValue){	  ?>
							<div class="package-title"><?=$pValue['name']; ?></div>
						<?php } ?>
					
					</li>

				<?

				$i=1;

				foreach($WLD_PAGE_ARRAY as  $PAGENAME => $TOP_MENU){
					 
				 	$inner=1;
					if (is_array($TOP_MENU) || is_object($TOP_MENU)){
					foreach( $TOP_MENU as $key => $value){ 
				 
						if(substr($key,-1,1) !="?" && substr($key,1,3) !="dll" && ( $key !="view" && $key !="" && $key !="inbox" && $key !="sent" && $key !="trash" && $key !="manage"  && $key !="albums" && $key !="password" && $key !="cancel"  && $key !="taken" && $key !="test") && $value !=""){ ## hide value if its a help value 

						if($inner==1){ $InnerSymbol="";}else{ $InnerSymbol="";}
				 
						?>
				  	<li class="tbl-body-manage-access" style="background-color:<?php if($i % 2){ print "#ffffff";}else{ print "#eeeeee";} ?>"> 
					    <div class="manage-access-title" style="width:120px;border:0px;">
					      <?=$InnerSymbol." ".$TOP_MENU[$key] ?>
					    </div> 
				    

						<?  if (is_array($PACKARRAY) || is_object($PACKARRAY)){
						foreach($PACKARRAY as $pValue){	 


						$PackageString="";
					 	$PackageString = $PAGENAME."-".$key; 

					$CheckME=""; 	
					if(isset($WLD_PACKAGEACCESS[$pValue['id']])){
					if(is_array($WLD_PACKAGEACCESS[$pValue['id']]) && in_array($PackageString,$WLD_PACKAGEACCESS[$pValue['id']])){ $CheckME="checked"; }else{$CheckME=""; }
					}
					?>

					<div class="package-name" align="center"><input name="<?=$pValue['id'] ?>_<?=$i ?>" type="checkbox" value="1" <?=$CheckME ?>></div>

					<?php }
					}
					?>
				  <input type="hidden" name="key_<?=$i ?>" value="<?=$PAGENAME ?>">
				  <input type="hidden" name="value_<?=$i ?>" value="<?=$key ?>">
				  </li>

				<?
						$i++; 
						$inner++;
						} 

					} 
					}
				}
				?>

				</ul>
				</div>
				<br class="clear">
				<div class="bar_save">
				<input name="TotalOps" type="hidden" value="<?=$i ?>">
				<input type="submit" value="<?=$admin_button_val[8] ?>" class="MainBtn">
				</div>
				
				<?php } ?> 
	<?php } break;

	case 'settings_email': { 

		$market_id = (isset($_REQUEST['market_id'])) ? $_REQUEST['market_id']: 0;
		$site_id = (isset($_REQUEST['site_id'])) ? $_REQUEST['site_id']: 0;
		$change_sites = (isset($_REQUEST['change_sites'])) ? $_REQUEST['change_sites']: 0;
		$market_site_settings = getMarketSiteSearchMemberSettings($market_id,$site_id);
		?>

		<p id="TopCommentsBox"><img src="inc/images/icons/help.png" align="admin-note-text"> Listed below are a list of web site events, you can select which events you would like the system to send you an email notification. Email notifications will be sent to all system admins who have access to system settings.</p>		
		

		<form method="post" action="" name="form1">
		    <input name="do" type="hidden" value="email_settings" class="hidden">
			<input name="do_section" type="hidden" value="email_client_settings" class="hidden">		
			<input name="market_id" type="hidden" value="<?=$market_id;?>" class="hidden">		
			<input name="site_id" type="hidden" value="<?=$site_id;?>" class="hidden">		

			<ul class="form">    
				<div class="box_body">
    			<li>
    				<label>Email Client </label>
    				<select name="emailclient" class="input">
    					<option value="no" <?php if($market_site_settings['use_smtp']=="no"){ print "selected";} ?>>PHP Mail() Client (recommended)</option>
    					<option value="yes" <?php if($market_site_settings['use_smtp']=="yes"){ print "selected";} ?>>SMTP Server Client</option>
					</select>
					<div class="tip">It is recommend to use the servers default PHP mail client however if you wish to use the SMTP client you can enable it here.</div>
				</li>
				<?php if($market_site_settings['use_smtp']=="yes"){ ?>
				<li>
					<label>SMTP Server </label>
					<input name="smtp1" type="text" value="<?=$market_site_settings['smtp_server']?>" class="input">
				</li>
				<li>
					<label>SMTP Server Port </label>
					<input name="smtp2" type="text" value="<?=$market_site_settings['smtp_port'] ?>" class="input">
				</li>
 				<li>
 					<label>SMTP From Sender </label>
 					<input name="smtp3" type="text" value="<?=$market_site_settings['smtp_from_name'] ?>" class="input">
				</li>	
				<li>
					<label>SMTP Username </label>
					<input name="smtp4" type="text" value="<?=$market_site_settings['smtp_username'] ?>" class="input">
				</li>
				<li>
					<label>SMTP Password </label>
					<input name="smtp5" type="text" value="<?=$market_site_settings['smtp_password'] ?>" class="input">
				</li>
				<?php } ?>
 				<input type="submit" id="but5" value="<?=$admin_button_val[8] ?>" class="MainBtn">
 				</div>
			</ul>	
		</form>

		<div style="clear: both;"></div>
		<p id='TopCommentsBox'><img src='inc/images/icons/help.png' align='absmiddle' />  Listed below are a list of website events, you can select which events you would like the system to send you an email notification. Email notifications will be sent to all system admins who have acces to system settings.</p>
		
		

		<form method="post" action="" name="form1">
		   	<input name="do" type="hidden" value="email_settings" class="hidden">
			<input name="do_section" type="hidden" value="semail_settings" class="hidden">		
			<input name="market_id" type="hidden" value="<?=$market_id;?>" class="hidden">		
			<input name="site_id" type="hidden" value="<?=$site_id;?>" class="hidden">	

			<ul class="form">    
				<li>
					<table class="widefat">
						<thead>
			    		    <tr>               
					          	<td width="370">The system should email me when; </td>
					          	<td width="110" align="center" style="color:#fff;"><strong>Send</strong></td>
					          	<td width="114" align="center" style="color:#fff;"><strong>Dont Send </strong></td>
							</tr>
				    	</thead>
				    	<tbody>
							<tr>
          						<td >A member joins the website </td>
      							<td align="center" bgcolor="#E4FED6"><input type="radio" name="sjoin" value="yes" <?php if($market_site_settings['semail_join']=="yes"){ print "checked";} ?>></td>
      							<td align="center" bgcolor="#efefef"><input type="radio" name="sjoin" value="no" <?php if($market_site_settings['semail_join']=="no"){ print "checked";} ?>></td>
        					</tr>	    	
							<tr>
          						<td>A member updates their account </td>
        						<td align="center" bgcolor="#E4FED6"><input type="radio" name="supdate" value="yes" <?php if($market_site_settings['semail_update']=="yes"){ print "checked";} ?>></td>
         						<td align="center" bgcolor="#efefef"><input type="radio" name="supdate" value="no" <?php if($market_site_settings['semail_update']=="no"){ print "checked";} ?>></td>
        					</tr>
							<tr>
					          	<td >A member uploads a new photo </td>
					          	<td align="center" bgcolor="#E4FED6"><input type="radio" name="sfiles" value="yes" <?php if($market_site_settings['semail_files']=="yes"){ print "checked";} ?>></td>
          						<td align="center" bgcolor="#efefef"><input type="radio" name="sfiles" value="no" <?php if($market_site_settings['semail_files']=="no"){ print "checked";} ?>></td>
    						</tr>
					        <tr>
					        	<td >A member creates a new group </td>
					        	<td align="center" bgcolor="#E4FED6"><input type="radio" name="sgroups" value="yes" <?php if($market_site_settings['semail_groups']=="yes"){ print "checked";} ?>></td>
					          	<td align="center" bgcolor="#efefef"><input type="radio" name="sgroups" value="no" <?php if($market_site_settings['semail_groups']=="no"){ print "checked";} ?>></td>
					        </tr>
					        <tr>
					          	<td >A member creates a new blog </td>
					          	<td align="center" bgcolor="#E4FED6"><input type="radio" name="sblog" value="yes" <?php if($market_site_settings['semail_blog']=="yes"){ print "checked";} ?>></td>
					          	<td align="center" bgcolor="#efefef"><input type="radio" name="sblog" value="no" <?php if($market_site_settings['semail_blog']=="no"){ print "checked";} ?>></td>
					        </tr>
				    		<tr>
				    	      	<td >A member create a new classified advert </td>
			    	    	  	<td align="center" bgcolor="#E4FED6"><input type="radio" name="sclassads" value="yes" <?php if($market_site_settings['semail_classads']=="yes"){ print "checked";} ?>></td>
			    		      	<td align="center" bgcolor="#efefef"><input type="radio" name="sclassads" value="no" <?php if($market_site_settings['semail_classads']=="no"){ print "checked";} ?>></td>
        					</tr>
					        <tr>
					          	<td >A member logs into their account </td>
					          	<td align="center" bgcolor="#E4FED6"><input type="radio" name="slogin" value="yes" <?php if($market_site_settings['semail_login']=="yes"){ print "checked";} ?>></td>
					        	<td align="center" bgcolor="#efefef"><input type="radio" name="slogin" value="no" <?php if($market_site_settings['semail_login']=="no"){ print "checked";} ?>></td>
					        </tr>
				    	</tbody>
					</table>
    				<br>
    			</li>
    			<li>
    				<label>Send this email </label>
    				<select class="input" name="newid"><?=WLDDisplayNewsletters($market_site_settings['semail_template']) ?></select>
    				<div class="tip">Select the email you wish to recieve when any of the above events happen. Add the code (custom) to any email to recieve the alter text.</div>
				</li>
				<input type="submit" id="but5" value="<?=$admin_button_val[8] ?>" class="MainBtn">
			</ul>
			
	</form>
	
	<?php } break;
	case 'settings_file_paths': { 


		$market_id = (isset($_REQUEST['market_id'])) ? $_REQUEST['market_id']: 0;
		$site_id = (isset($_REQUEST['site_id'])) ? $_REQUEST['site_id']: 0;
		$change_sites = (isset($_REQUEST['change_sites'])) ? $_REQUEST['change_sites']: 0;
		$market_site_settings = getMarketSiteSearchMemberSettings($market_id,$site_id);

	?>

	<div class="admin-note">
		<p id="TopCommentsBox"><img src="inc/images/icons/help.png" align="admin-note-text">  The File and Folder paths below relate to the files and folders on your hosting account. The software will automatically apply these during the installation process however incase they are incorrect you can modify them below.</p>	
	</div>
	
   	<input type="hidden" name="do" value="settings_file_paths"/>
   	<input type="hidden" name="p" value="settings"/>
   	<input type="hidden" name="market_id" value="<?php echo $market_id;?>"/>
   	<input type="hidden" name="site_id" value="<?php echo $site_id;?>"/>
   	<input type="hidden" name="change_sites" value="<?php echo $change_sites;?>"/>
	
   	<?php
   	if($site_id !=0){
   	?>
	<div class="heading">
		<h2>Web Paths</h2>
	</div>
	<br/>
	<ul class="form">  
		<li>
			<label>File Storage Web Path </label>
			<input name="p0" type="text" class="input" value="<?php echo $market_site_settings['file_storage_web_path'];?>" size="60">
		</li>
		<li>
			<label>Photo Storage Web Path</label>
			<input name="p1" type="text" class="input" value="<?php echo $market_site_settings['photo_storage_web_path'];?>" size="60">
		</li>        
		<li>
			<label>Thumbs Storage Web Path</label>
			<input name="p2" type="text" class="input" value="<?php echo $market_site_settings['thumb_storage_web_path'];?>" size="60">
		</li>	 
		<li>
			<label>Video Storage Web Path</label>
			<input name="p3" type="text" class="input" value="<?php echo $market_site_settings['video_storage_web_path'];?>" size="60">
		</li>       
		<li>
			<label>Music Storage Web Path</label>
			<input name="p4" type="text" class="input" value="<?php echo $market_site_settings['music_storage_web_path'];?>" size="60">
		</li>	
		<li>
			<input type="submit" value="Update" class="MainBtn">
		</li>      
	</ul>		
		 
		
	<br class="clear">
	<?php
	}
	?>
	<div class="heading">
		<h2>Server Paths</h2>
	</div>
	<br/>	 
	<ul class="form">
		<li>
			<label>File Storage Server Path:</label>
			<input name="pa0" type="text" class="input" value="<?php echo $market_site_settings['file_storage_server_path'];?>" size="60">
			<div class="tip">Space Used: <?php echo GetFolderSize($market_site_settings['file_storage_server_path']); ?></div>
		</li> 
		<li>
			<label>Photo Storage Server Path:</label>
			<input name="pa1" type="text" class="input" value="<?php echo $market_site_settings['photo_storage_server_path'];?>" size="60">
			<div class="tip">Space Used: <?php echo GetFolderSize($market_site_settings['photo_storage_server_path']); ?></div>
		</li>   
		<li>
			<label>Thumbs Storage Server Path:</label>
			<input name="pa2" type="text" class="input" value="<?php echo $market_site_settings['thumb_storage_server_path'];?>" size="60">
			<div class="tip">Space Used: <?php echo GetFolderSize($market_site_settings['thumb_storage_server_path']); ?></div>
		</li>    
		<li>
			<label>Video Storage Server Path:</label>
			<input name="pa3" type="text" class="input" value="<?php echo $market_site_settings['video_storage_server_path'];?>" size="60">
			<div class="tip">Space Used: <?php echo GetFolderSize($market_site_settings['video_storage_server_path']); ?></div>
		</li> 	  
		<li>
			<label>Music Storage Server Path:</label>
			<input name="pa4" type="text" class="input" value="<?php echo $market_site_settings['music_storage_server_path'];?>" size="60">
			<div class="tip">Space Used: <?php echo GetFolderSize($market_site_settings['music_storage_server_path']); ?></div>
		</li>    
		<li>
			<input type="submit" value="Update" class="MainBtn">
		</li>	  
			
	</ul> 	  
	<?php } break;

	case 'manage_profile_questions': { ?>


	<br class="clear">
	<div class="bar_save">
	<input type="button" value="Add New Field" class="MainBtn" onClick="javascript:location.href='?p=management&sp=manage_add_fields&market_id=<?=$_GET['market_id']?>'"/>
	<input type="button" value="Add Group" class="MainBtn" onClick="javascript:location.href='?p=management&sp=manage_add_groups&market_id=<?=$_GET['market_id']?>'"/>
	<input type="button" value="<?=$admin_management[1] ?>" class="MainBtn" onClick="javascript:location.href='?p=management&sp=manage_field_groups&market_id=<?=$_GET['market_id']?>'"/>
	<br class="clear">
	</div>
	<br class="clear">
	
	<form action="" method="post" name="profile" onSubmit="return CheckMemberForm();">
	<input name="do" type="hidden" value="none" id="do" class="hidden">
	<input name="market_id" type="hidden" value="<?=$_GET['market_id']?>" class="hidden">
	
	<ul class="form"><div class="box_body"><?php $tRows =WLDDisplayFieldGroups($_GET['market_id']); ?></div></ul>
	
	<br class="clear">
	<div id="options">
	
		<div class="bar_save">
		<input type="button" value="<?=$admin_button_val[1] ?>" class="NormBtn" onClick="ca(<?=$tRows ?>)"/>
		<input type="button" value="<?=$admin_button_val[2] ?>" class="NormBtn"  onClick="ua(<?=$tRows ?>)"/> - 
		<input type="button" value="<?=$admin_button_val[5] ?>" class="MainBtn"  onclick="ChangeOption('fielddelete');"/> 
		</div>

		 
	
	</div>
	</form>





	<?php } break;
	case 'settings_thumbnails': {

		$market_id = (isset($_REQUEST['market_id'])) ? $_REQUEST['market_id']: 0;
		$site_id = (isset($_REQUEST['site_id'])) ? $_REQUEST['site_id']: 0;
		$change_sites = (isset($_REQUEST['change_sites'])) ? $_REQUEST['change_sites']: 0;
		$market_site_settings = getMarketSiteSearchMemberSettings($market_id,$site_id);
		
		$market = getMarket($market_id);
		
		if($site_id != '0'){

		$site = WLDGetSite($site_id);

		// Default Thumbnails ?>

		<p id='TopCommentsBox'><img src='inc/images/icons/help.png' align='absmiddle' />  The thumbnails below are used to replace member photos if they havent yet added a photo to their account. Thumbnails MUST be .JPG format and 96x96 in dimentions.</p>

		<form action="" method="post" enctype="multipart/form-data">
			<input type="hidden" name="do" value="settings_thumbnails" class="hidden">
			<input type="hidden" name="p" value="settings" class="hidden">
			<input type="hidden" name="market_id" value="<?php echo $market_id;?>" class="hidden">
			<input type="hidden" name="site_id" value="<?php echo $site_id;?>" class="hidden">
			<ul class="form">
				<li>
					<label>Default No Image:</label>

						<table width="600px"  border="0">
		  					<tr>
								<td width="161" rowspan="2"><img src="<?=$market_site_settings['file_storage_web_path'].$market_site_settings['default_image'] ?>" width="96" height="96"></td>
								<td width="429"><input type="text" class="input" value="<?=$market_site_settings['file_storage_web_path'].$market_site_settings['default_image']; ?>"size="60" disabled style="background:#FFC8D0"></td>
						  	</tr>
		  					<tr>
								<td>
									<small>Upload a new image to replace the existing one.</small>
									<input type="file" name="t3_file">
								</td>
		  					</tr>
						</table>

						<hr noshade>
				</li>
				<li>
					<label>Adult Default Image:  </label>

					<table width="600px"  border="0">
	 					<tr>
							<td width="161" rowspan="2">
								<img src="<?=$market_site_settings['file_storage_web_path'].$market_site_settings['default_image_adult']; ?>" width="96" height="96">
							</td>
							<td width="429">
								<input type="text" class="input" value="<?=$market_site_settings['file_storage_web_path'].$market_site_settings['default_image_adult'] ?>"size="60" disabled style="background:#FFC8D0">
							</td>
	  					</tr>
							<tr>
							<td>
								<small>Upload a new image to replace the existing one.</small>
		  						<input type="file" name="t4_file">
	  						</td>
	  					</tr>
					</table>
					<hr noshade>
        		</li>
			</ul>

			<ul class="form">

			<?php $tc=1; foreach($_SESSION['g_array'] as $value){ if(isset($value['id']) && $value['id'] !=""){ ?>

				<li>
					<label> <?=$value['caption'] ?> Default Image: </label>
					<table width="600px"  border="0">
		  				<tr>
							<td width="161" rowspan="2">
								<img src="<?=$market_site_settings['file_storage_web_path']."nophoto_".$value['id'] ?>.jpg" width="96" height="96">
							</td>
							<td width="429">
								<input type="text" class="input" value="<?=$market_site_settings['file_storage_web_path']."nophoto_".$value['id'] ?>.jpg"size="60" disabled style="background:#FFC8D0">
							</td>
					  	</tr>
					  	<tr>
							<td>
								<small>Upload a new JPG image to replace the existing one.</small>
								 <input type="file" name="main_file_<?=$tc ?>">
							 </td>
		  				</tr>
					</table>
					<hr noshade>
        		</li>
        		<input type="hidden" name="default_<?=$tc ?>" value="<?=$value['id'] ?>">

				<?php $tc++; } } ?>

				<input type="hidden" name="TotalDe" value="<?=$tc ?>">

			</ul>


			<ul class="form">
				<li>
					<label>Music Default Image: </label>

					<table width="600px"  border="0">
 						<tr>
							<td width="161" rowspan="2">
								<img src="<?=$market_site_settings['file_storage_web_path'].$market_site_settings['default_music'] ?>" width="96" height="96">
							</td>
							<td width="429">
								<input type="text" class="input" value="<?=$market_site_settings['file_storage_web_path'].$market_site_settings['default_music'] ?>"size="60" disabled style="background:#FFC8D0">
							</td>
  						</tr>
  						<tr>
							<td>
								<small>Upload a new image to replace the existing one.</small>
			  					<input type="file" name="t5_file">
		  					</td>
  						</tr>
					</table>

					<hr noshade>
    			</li>
				<li>
					<label>Video Default Image: </label>

					<table width="600px"  border="0">
					  	<tr>
							<td width="161" rowspan="2"><img src="<?=$market_site_settings['file_storage_web_path'].$market_site_settings['default_video'] ?>" width="96" height="96"></td>
							<td width="429"><input  type="text" class="input" value="<?=$market_site_settings['file_storage_web_path'].$market_site_settings['default_video'] ?>"size="60" disabled style="background:#FFC8D0"></td>
					  	</tr>
					  	<tr>
							<td>
								<small>Upload a new image to replace the existing one.</small>
							  <input type="file" name="t6_file">
						  </td>
  						</tr>
					</table>

					<hr noshade>
    			
    			</li>
    			<li>
    				<input type="submit" value="<?=$admin_button_val[8] ?>" class="MainBtn" >
				</li>   
			</ul>	
		</form>
<?php 	}
	
	} break;
	case 'site_settings': {

		if($_REQUEST['system'] == 'market_settings'){
			$market = getMarketSiteSearchMemberSettings($_GET['market_id'],0);
			?>
			<form action="" method="POST">


			<input type="hidden" name="market_id" value="<?=$_GET['market_id']?>"/>
			<input type="hidden" name="site_id" value="0"/>
			<input type="hidden" name="do" value="site_settings"/>

			<div class="field choose-market">
				<label>Change Sites In Market:</label>
				<span id="chkChangeSites" class="chkbox-site-settings">
					<input type="checkbox" name="change_sites" value="true"/>
				</span>
			</div>

			<div class="field m-market-comm"><label>Market Commission:</label><span>
				<select name="market_commission" class="input">
					<option value="">Select Commission</option>
					<?php
					for ($i=1; $i <= 100 ; $i++) { 
					$selected = "";
					if($market['market_commission'] == $i){
						$selected = "selected";
					}
					?>
					<option value="<?=$i?>" <?=$selected?>><?=$i?></option>
					<?php	
					
					}
					?>
				</select></span></div>
			<div class="field m-date-format"><label>Date Format:</label>
			<span><select name="zdate" style="width:100px;" class="input">
			<option value="d-m-Y" <?php if($market['date_display_format']== "d-m-Y"){ print "selected";} ?>>d-m-Y</option>
			<option value="d-Y-m" <?php if($market['date_display_format']== "d-Y-m"){ print "selected";} ?>>d-Y-m</option>
			<option value="Y-m-d" <?php if($market['date_display_format']== "Y-m-d"){ print "selected";} ?>>Y-m-d</option>
			<option value="m-d-Y" <?php if($market['date_display_format']== "m-d-Y"){ print "selected";} ?>>m-d-Y</option>
			</select></span></div>
			<div class="field m-banned-usernames"><label>Banned Usernames:</label><span><input type="text" name="block_usernames" value="<?=$market['block_usernames']?>" class="input"/></span></div>
			<div class="field m-seo-fiendly"><label>Search Engine Friendly:</label><span>
				<select name="seof" class="input">
					<option value="1" <?php if($market['d_mod_write']==1){ print "selected";} ?>><?=$admin_selection[1] ?></option>
					<option value="0" <?php if($market['d_mod_write']==0){ print "selected";} ?>><?=$admin_selection[2] ?></option>
				</select>
			</span></div>
			<div class="field m-lang-flag"><label>Display Language Flag:</label><span>
				<select name="flag" class="input">
					<option value="1" <?php if($market['d_flags']=="1"){ print "selected";} ?>><?=$admin_selection[1] ?></option>
					<option value="0" <?php if($market['d_flags']=="0"){ print "selected";} ?>><?=$admin_selection[2] ?></option>
				</select>
			</span></div>
			<div class="field m-enable-ghost-login"><label>Enable Ghost Login:</label><span>
				<select name="auto_login" class="input">
					<option value="yes" <?php if($market['auto_login']=="yes"){ print "selected";} ?>><?=$admin_selection[1] ?></option>
					<option value="no" <?php if($market['auto_login']=="no"){ print "selected";} ?>><?=$admin_selection[2] ?></option>
				</select>
			</span></div>
			<div class="field m-ghost-login-amount"><label>Ghost Login Amount:</label><span>
				<select name="auto_amount" style="width:100px;" class="input">
					<option value="2"<?php if($market['auto_amount'] =='2'){ print "selected"; } ?>>2</option>
					<option value="4" <?php if($market['auto_amount'] =='4'){ print "selected"; } ?>>4</option>
					<option value="6" <?php if($market['auto_amount'] =='6'){ print "selected"; } ?>>6</option>
					<option value="8" <?php if($market['auto_amount'] =='8'){ print "selected"; } ?>>8</option>
					<option value="10" <?php if($market['auto_amount'] =='10'){ print "selected"; } ?>>10</option>
					<option value="12" <?php if($market['auto_amount'] =='12'){ print "selected"; } ?>>12</option>
					<option value="14" <?php if($market['auto_amount'] =='14'){ print "selected"; } ?>>14</option>
					<option value="16" <?php if($market['auto_amount'] =='16'){ print "selected"; } ?>>16</option>
					<option value="18"<?php if($market['auto_amount'] =='18'){ print "selected"; } ?>>18</option>
					<option value="20" <?php if($market['auto_amount'] =='20'){ print "selected"; } ?>>20</option>
					<option value="22" <?php if($market['auto_amount'] =='22'){ print "selected"; } ?>>22</option>
					<option value="24" <?php if($market['auto_amount'] =='24'){ print "selected"; } ?>>24</option>
					<option value="26" <?php if($market['auto_amount'] =='26'){ print "selected"; } ?>>26</option>
					<option value="28" <?php if($market['auto_amount'] =='28'){ print "selected"; } ?>>28</option>
					<option value="30" <?php if($market['auto_amount'] =='30'){ print "selected"; } ?>>30</option>
					<option value="32" <?php if($market['auto_amount'] =='32'){ print "selected"; } ?>>32</option>
					<option value="34" <?php if($market['auto_amount'] =='34'){ print "selected"; } ?>>34</option>
					<option value="36" <?php if($market['auto_amount'] =='36'){ print "selected"; } ?>>36</option>
					<option value="38" <?php if($market['auto_amount'] =='38'){ print "selected"; } ?>>38</option>
					<option value="40" <?php if($market['auto_amount'] =='40'){ print "selected"; } ?>>40</option>
					<option value="42" <?php if($market['auto_amount'] =='42'){ print "selected"; } ?>>42</option>
					<option value="44" <?php if($market['auto_amount'] =='44'){ print "selected"; } ?>>44</option>
					<option value="46" <?php if($market['auto_amount'] =='46'){ print "selected"; } ?>>46</option>
					<option value="48" <?php if($market['auto_amount'] =='48'){ print "selected"; } ?>>48</option>
					<option value="50" <?php if($market['auto_amount'] =='50'){ print "selected"; } ?>>50</option>		
					<option value="100" <?php if($market['auto_amount'] =='100'){ print "selected"; } ?>>100</option>
					<option value="150" <?php if($market['auto_amount'] =='150'){ print "selected"; } ?>>150</option>
					<option value="200" <?php if($market['auto_amount'] =='200'){ print "selected"; } ?>>200</option>
				</select></span>
			</div>
			<div class="field m-affiliate-currency"><label>Affiliate Currency:</label><span>

				<select class="input" name="wldcurrency">
	                <option value="GBP" <?php if($market['aff_currency']=="GBP"){print "selected";} ?>>GBP (Great British Pound)</option>
					<option value="EUR" <?php if($market['aff_currency']=="EUR"){print "selected";} ?>>EUR (EURO)</option>
					<option value="USD" <?php if($market['aff_currency']=="USD"){print "selected";} ?>>USD (United States Dollar)</option>				
					<option value="YEN" <?php if($market['aff_currency']=="YEN"){print "selected";} ?>>YEN (Japanese Yen) </option> 
	                <option value="R" <?php if($market['aff_currency']=="R"){print "selected";} ?>>R (South African Rand Currency)</option>
					<option value="ZL" <?php if($market['aff_currency']=="ZL"){print "selected";} ?>>ZL (Polish Currency)</option>	
					<option value="RMB"  <?php if($market['aff_currency']=="RMB"){print "selected";} ?>>RMB (Chinese Currency)</option>
					<option value="HK" <?php if($market['aff_currency']=="HK"){print "selected";} ?>>HK (Hong Kong Currency)</option>
					<option value="NOK" <?php if($market['aff_currency']=="NOK"){print "selected";} ?>>NOK (Norwegian Kroner)</option>
					<option value="INR" <?php if($market['aff_currency']=="INR"){print "selected";} ?>>INR (Indian Rupees)</option>
					<option value="AUD" <?php if($market['aff_currency']=="AUD"){print "selected";} ?>>AUD (Australian Dollar)</option>
					<option value="CAD" <?php if($market['aff_currency']=="CAD"){print "selected";} ?>>CAD (Canadian Dollar)</option>
					<option value="CHF" <?php if($market['aff_currency']=="CHF"){print "selected";} ?>>CHF (Swiss Franc)</option>
					<option value="CZK" <?php if($market['aff_currency']=="CZK"){print "selected";} ?>>CZK (Czech Koruna)</option>
					<option value="DKK" <?php if($market['aff_currency']=="DKK"){print "selected";} ?>>DKK (Danish Krone)</option>
					<option value="HUF" <?php if($market['aff_currency']=="HUF"){print "selected";} ?>>HUF (Hungarian Forint)</option>
					<option value="NZD" <?php if($market['aff_currency']=="NZD"){print "selected";} ?>>NZD (New Zealand Dollar)</option>
					<option value="PLN" <?php if($market['aff_currency']=="PLN"){print "selected";} ?>>PLN (Polish Zloty)</option>
					<option value="SEK" <?php if($market['aff_currency']=="SEK"){print "selected";} ?>>SEK (Swedish Krona)</option>
					<option value="SGD" <?php if($market['aff_currency']=="SGD"){print "selected";} ?>>SGD (Singapore Dollar)</option>
					<option value="BRL" <?php if($market['aff_currency']=="BRL"){print "selected";} ?>>BRL (Brazilian Real)</option>
	 				<option value="TL" <?php if($market['aff_currency']=="TL"){print "selected";} ?>>TL</option>
					<option value="THB" <?php if($market['aff_currency']=="THB"){print "selected";} ?>>THB (Thai Baht)</option>
		      	</select>
			
			</span></div>
			<div class="field m-copyright-text"><label>Copyright Text:</label><span><input type="text" value="<?=$market['d_cctext'] ?>" name="cctext" class="input" style="width:300px;"></span></div>

			<div class="field"><label></label><span><input type="submit" value="Update" name="submit" class="MainBtn"></span></div>
			
			</form>
		<?php
		}
		else if($_REQUEST['system'] == 'site_settings'){
			$market = getMarketSiteSearchMemberSettings($_GET['market_id'],$_GET['site_id']);
			?>
			<form action="" method="POST">
			<input type="hidden" name="market_id" value="<?=$_GET['market_id']?>"/>
			<input type="hidden" name="site_id" value="<?=$_GET['site_id']?>"/>
			<input type="hidden" name="do" value="site_settings"/>
			<input type="hidden" name="change_sites" value="true"/>

			<div class="field s-market-comm"><label>Site Commission:</label><span>
				<select name="market_commission" class="input">
					<option value="">Select Commission</option>
					<?php
					for ($i=1; $i <= 100 ; $i++) { 
					$selected = "";
					if($market['market_commission'] == $i){
						$selected = "selected";
					}
					?>
					<option value="<?=$i?>" <?=$selected?>><?=$i?></option>
					<?php	
					
					}
					?>
				</select>
			</span></div>
			<div class="field s-date-format"><label>Date Format:</label>
			<span>
			<select name="zdate" style="width:100px;" class="input">
			<option value="d-m-Y" <?php if($market['date_display_format']== "d-m-Y"){ print "selected";} ?>>d-m-Y</option>
			<option value="d-Y-m" <?php if($market['date_display_format']== "d-Y-m"){ print "selected";} ?>>d-Y-m</option>
			<option value="Y-m-d" <?php if($market['date_display_format']== "Y-m-d"){ print "selected";} ?>>Y-m-d</option>
			<option value="m-d-Y" <?php if($market['date_display_format']== "m-d-Y"){ print "selected";} ?>>m-d-Y</option>
			</select>
			</span>
			</div>
			<div class="field s-banned-usernames"><label>Banned Usernames:</label><span><input type="text" name="block_usernames" value="<?=$market['block_usernames']?>" class="input"/></span></div>
			<div class="field s-seo-fiendly"><label>Search Engine Friendly:</label><span>
				<select name="seof" class="input">
				<option value="1" <?php if($market['d_mod_write']==1){ print "selected";} ?>><?=$admin_selection[1] ?></option>
				<option value="0" <?php if($market['d_mod_write']==0){ print "selected";} ?>><?=$admin_selection[2] ?></option>
				</select>
			</span></div>
			<div class="field s-lang-flag"><label>Display Language Flag:</label><span>
				<select name="flag" class="input">
					<option value="1" <?php if($market['d_flags']=="1"){ print "selected";} ?>><?=$admin_selection[1] ?></option>
					<option value="0" <?php if($market['d_flags']=="0"){ print "selected";} ?>><?=$admin_selection[2] ?></option>
				</select>
			</span></div>
			<div class="field s-enable-ghost-login"><label>Enable Ghost Login:</label><span>
				<select name="auto_login" class="input">
					<option value="yes" <?php if($market['auto_login']=="yes"){ print "selected";} ?>><?=$admin_selection[1] ?></option>
					<option value="no" <?php if($market['auto_login']=="no"){ print "selected";} ?>><?=$admin_selection[2] ?></option>
				</select>
			</span></div>
			<div class="field s-ghost-login-amount"><label>Ghost Login Amount:</label><span>
				<select name="auto_amount" style="width:100px;" class="input">
					<option value="2"<?php if($market['auto_amount'] =='2'){ print "selected"; } ?>>2</option>
					<option value="4" <?php if($market['auto_amount'] =='4'){ print "selected"; } ?>>4</option>
					<option value="6" <?php if($market['auto_amount'] =='6'){ print "selected"; } ?>>6</option>
					<option value="8" <?php if($market['auto_amount'] =='8'){ print "selected"; } ?>>8</option>
					<option value="10" <?php if($market['auto_amount'] =='10'){ print "selected"; } ?>>10</option>
					<option value="12" <?php if($market['auto_amount'] =='12'){ print "selected"; } ?>>12</option>
					<option value="14" <?php if($market['auto_amount'] =='14'){ print "selected"; } ?>>14</option>
					<option value="16" <?php if($market['auto_amount'] =='16'){ print "selected"; } ?>>16</option>
					<option value="18"<?php if($market['auto_amount'] =='18'){ print "selected"; } ?>>18</option>
					<option value="20" <?php if($market['auto_amount'] =='20'){ print "selected"; } ?>>20</option>
					<option value="22" <?php if($market['auto_amount'] =='22'){ print "selected"; } ?>>22</option>
					<option value="24" <?php if($market['auto_amount'] =='24'){ print "selected"; } ?>>24</option>
					<option value="26" <?php if($market['auto_amount'] =='26'){ print "selected"; } ?>>26</option>
					<option value="28" <?php if($market['auto_amount'] =='28'){ print "selected"; } ?>>28</option>
					<option value="30" <?php if($market['auto_amount'] =='30'){ print "selected"; } ?>>30</option>
					<option value="32" <?php if($market['auto_amount'] =='32'){ print "selected"; } ?>>32</option>
					<option value="34" <?php if($market['auto_amount'] =='34'){ print "selected"; } ?>>34</option>
					<option value="36" <?php if($market['auto_amount'] =='36'){ print "selected"; } ?>>36</option>
					<option value="38" <?php if($market['auto_amount'] =='38'){ print "selected"; } ?>>38</option>
					<option value="40" <?php if($market['auto_amount'] =='40'){ print "selected"; } ?>>40</option>
					<option value="42" <?php if($market['auto_amount'] =='42'){ print "selected"; } ?>>42</option>
					<option value="44" <?php if($market['auto_amount'] =='44'){ print "selected"; } ?>>44</option>
					<option value="46" <?php if($market['auto_amount'] =='46'){ print "selected"; } ?>>46</option>
					<option value="48" <?php if($market['auto_amount'] =='48'){ print "selected"; } ?>>48</option>
					<option value="50" <?php if($market['auto_amount'] =='50'){ print "selected"; } ?>>50</option>		
					<option value="100" <?php if($market['auto_amount'] =='100'){ print "selected"; } ?>>100</option>
					<option value="150" <?php if($market['auto_amount'] =='150'){ print "selected"; } ?>>150</option>
					<option value="200" <?php if($market['auto_amount'] =='200'){ print "selected"; } ?>>200</option>
				</select>
			</span></div>
			<div class="field s-affiliate-currency"><label>Affiliate Currency:</label><span>

				<select class="input" name="wldcurrency">
	                <option value="GBP" <?php if($market['aff_currency']=="GBP"){print "selected";} ?>>GBP (Great British Pound)</option>
					<option value="EUR" <?php if($market['aff_currency']=="EUR"){print "selected";} ?>>EUR (EURO)</option>
					<option value="USD" <?php if($market['aff_currency']=="USD"){print "selected";} ?>>USD (United States Dollar)</option>				
					<option value="YEN" <?php if($market['aff_currency']=="YEN"){print "selected";} ?>>YEN (Japanese Yen) </option> 
	                <option value="R" <?php if($market['aff_currency']=="R"){print "selected";} ?>>R (South African Rand Currency)</option>
					<option value="ZL" <?php if($market['aff_currency']=="ZL"){print "selected";} ?>>ZL (Polish Currency)</option>	
					<option value="RMB"  <?php if($market['aff_currency']=="RMB"){print "selected";} ?>>RMB (Chinese Currency)</option>
					<option value="HK" <?php if($market['aff_currency']=="HK"){print "selected";} ?>>HK (Hong Kong Currency)</option>
					<option value="NOK" <?php if($market['aff_currency']=="NOK"){print "selected";} ?>>NOK (Norwegian Kroner)</option>
					<option value="INR" <?php if($market['aff_currency']=="INR"){print "selected";} ?>>INR (Indian Rupees)</option>
					<option value="AUD" <?php if($market['aff_currency']=="AUD"){print "selected";} ?>>AUD (Australian Dollar)</option>
					<option value="CAD" <?php if($market['aff_currency']=="CAD"){print "selected";} ?>>CAD (Canadian Dollar)</option>
					<option value="CHF" <?php if($market['aff_currency']=="CHF"){print "selected";} ?>>CHF (Swiss Franc)</option>
					<option value="CZK" <?php if($market['aff_currency']=="CZK"){print "selected";} ?>>CZK (Czech Koruna)</option>
					<option value="DKK" <?php if($market['aff_currency']=="DKK"){print "selected";} ?>>DKK (Danish Krone)</option>
					<option value="HUF" <?php if($market['aff_currency']=="HUF"){print "selected";} ?>>HUF (Hungarian Forint)</option>
					<option value="NZD" <?php if($market['aff_currency']=="NZD"){print "selected";} ?>>NZD (New Zealand Dollar)</option>
					<option value="PLN" <?php if($market['aff_currency']=="PLN"){print "selected";} ?>>PLN (Polish Zloty)</option>
					<option value="SEK" <?php if($market['aff_currency']=="SEK"){print "selected";} ?>>SEK (Swedish Krona)</option>
					<option value="SGD" <?php if($market['aff_currency']=="SGD"){print "selected";} ?>>SGD (Singapore Dollar)</option>
					<option value="BRL" <?php if($market['aff_currency']=="BRL"){print "selected";} ?>>BRL (Brazilian Real)</option>
	 				<option value="TL" <?php if($market['aff_currency']=="TL"){print "selected";} ?>>TL</option>
					<option value="THB" <?php if($market['aff_currency']=="THB"){print "selected";} ?>>THB (Thai Baht)</option>
		      	</select>
			</span></div>
			<div class="field s-copyright-text"><label>Copyright Text:</label><span><input type="text" value="<?=$market['d_cctext'] ?>" name="cctext" class="input" style="width:300px;"></span></div>
			<div class="field"><label></label><span><input type="submit" value="Update" name="submit" class="MainBtn"></span></div>

			</form>
		<?php	
		}
		
	} break;
	case 'CountryLinkedField': {

	
		$value = trim(strip_tags($_GET['value']));
		$LinkID= trim(strip_tags($_GET['lid']));
		$sp = trim(strip_tags($_GET['rownum']));
		 
		if (strpos(strtoupper($value),'UNION') !== FALSE) {   die( 'Restricted access' ); }
		if (strpos(strtoupper($LinkID),'UNION') !== FALSE) {   die( 'Restricted access' ); }
		if (strpos(strtoupper($sp),'UNION') !== FALSE) {   die( 'Restricted access' ); }

		$ReturnString="<label>Beneficiary region:</label>";

		// check if there is a field linked to this one
		$Linked = $DB->Row("SELECT fid FROM field WHERE linked_id=".$LinkID." limit 1");						
 		$Linked['fid'];

		 $LinkedCode ="";

		$ReturnString .= "<select name='beneficiary_region' class='input'>";

		$ReturnString .= "<option value='0'>------------------</option>";

		if($value =="" || $value ==0){

			$ReturnString .="</select>";
			print $ReturnString;
			return;

		}		

		$result2 = $DB->Query("SELECT fvid, fvCaption FROM field_list_value WHERE linked_cap_id = '". $value ."' Order by fvOrder"); // AND lang='".D_LANG."'
		if(!empty($result2)){$tc=1;
		while( $ListValue = $DB->NextRow($result2) ){ 
			
				if(isset($ListValue['default']) =="yes"){ $Selecteed ="selected"; }else{$Selecteed ="";  }
				$ReturnString .= "<option value='".$ListValue['fvid']."' ".$Selecteed.">".$ListValue['fvCaption']."</option>";					
				$tc++;
		}
		}

		if(empty($result2) || $tc==1){
		$result3 = $DB->Query("SELECT fvid, fvCaption FROM field_list_value WHERE linked_cap_id = '". $value ."' Order by fvOrder");//fvCaption
		
		while( $ListValue = $DB->NextRow($result3) ){ 
			
				if($ListValue['default'] =="yes"){ $Selecteed ="selected"; }else{$Selecteed ="";  }
				$ReturnString .= "<option value='".$ListValue['fvid']."' ".$Selecteed.">".$ListValue['fvCaption']."</option>";					
								
		}
		}

		$ReturnString .="</select>";
		print $ReturnString;

	
	} break;

	case 'approve_edit_text':{ ?>
		
	<?php
	
	} break;

}
?>