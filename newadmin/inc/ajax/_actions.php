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
if(!session_id())session_start();
if (!isset($loginSet) && ( !isset($_SESSION['admin_auth'])  || $_SESSION['admin_auth'] != "yes" ) )  {
	header("location: index.php");
	exit();  
}
require_once "../../../inc/config.php";
require_once "../config.php";
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
		
		$count_file = $DB->Query("SELECT count(*) FROM files WHERE uid = '".$_POST['uid']."'");
		
		$directoryPath = $_SERVER['DOCUMENT_ROOT'].'/uploads/images';
		$directorythumb = $_SERVER['DOCUMENT_ROOT'].'/uploads/thumbs';
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
	
	if ( in_array($extension, $allowedExts))
	  {
	  if ($_FILES["profilepic"]["error"] > 0)
		{
				echo 'ERROR Return Code: '. $_FILES["profilepic"]["error"];
		}
	  else
		{
			
	      $filename = $_FILES["profilepic"]["tmp_name"];
		  list($width, $height) = getimagesize( $filename );
			$imagename = $_POST['uid'].'_'.rand().'.'.$extension;
			
		  move_uploaded_file($filename,  $directorythumb.'/'.$imagename);
		  move_uploaded_file($filename,  $directoryPath.'/'.$imagename);
		  
			
			if($_POST['aid'] == '' && $_POST['imgid'] == ''):
			
				$date = date('Y-m-d');
				
				$DB->Insert("INSERT INTO `album`(`uid`,`title`,`comment`,`password`,`time`,`date`) VALUES(".$_POST['uid'].",'Profile','Default Album','','".$date."','".$date."')");
				$albumid = $DB->InsertID();
				
				$DB->Insert("INSERT INTO `files`(`aid`,`user`,`uid`,`date`,`title`,`description`,`bigimage`,`width`,`height`) VALUES(".$albumid.",'',".$_POST['uid'].",'".$date."','Title goes here','Description goes here','".$imagename."',".$width.",".$height.")");
				
			elseif($_POST['imgid'] == ''):
			$date = date('Y-m-d');
						
			$DB->Insert("INSERT INTO `files`(`aid`,`user`,`uid`,`date`,`title`,`description`,`bigimage`,`width`,`height`) VALUES(".$_POST['aid'].",'',".$_POST['uid'].",'".$date."','Title goes here','Description goes here','".$imagename."',".$width.",".$height.")");
			
			elseif($_POST['aid'] != '' && $_POST['imgid'] != ''):
			
				$DB->Update("UPDATE `files` SET `bigimage` = '".$imagename."' WHERE `id` = ".$_POST['imgid']."");
				
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
		global $DB;
		if($_POST['photoid']){
		$SQL = "SELECT * FROM files WHERE uid = ". $_POST['mid'] ." AND id=".$_POST['photoid']."";
		$result = $DB->Query($SQL);
		$fetch = $DB->NextRow($result);
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
			$DB->Query("DELETE FROM `files` WHERE `id` = ".$_POST['photoid']." AND `uid` = ".$_POST['mid']."");
	
		if($count !== false) echo 'Sucessfully Deleted'. $count;
		} else {
			echo "Profile pic does not exists!!!";	
		}
	break;

	case 'DelBgregImage': {
		$root = $_SERVER['DOCUMENT_ROOT'];
		unlink($root.'/images/'.D_USER_REGISTER_BACKGROUND_IMAGE);
		echo '<span style="font-size:12px;">Deleted Successfully.</span>';
	}
	break;

	case 'DelArticleImage': {
		$root = $_SERVER['DOCUMENT_ROOT'];

		$article_image = $DB->Row("SELECT * FROM articles WHERE id = '".$_GET['article_id']."'");

		unlink($root.'/uploads/articles/'.$article_image['image']);

		$DB->Update("UPDATE articles SET image = '' WHERE id = '".$_GET['article_id']."'");
		echo '<span style="font-size:12px;">Deleted Successfully.</span>';

	}
	break;
	
	case 'LoadTable': {
 
	$SearchConfig = array();

 	print MakeTable($SearchConfig);
		
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
<ul class="form"><div class="box_body">	<form method="post" action="management.php" name="form1">
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
	
				case "show_preview": {
					
					return;
			
				} break;		

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

	$id = trim(strip_tags($_GET['id']));
	$value = trim(strip_tags($_GET['value']));
 
	$DB->Update("UPDATE field SET fOrder='".$value."' WHERE fid='".$id."' LIMIT 1");

	print "Field Order Updated";

	} break;

	case "compatibilityfieldorderpage": {

		if(ADMIN_DEMO == "yes"){ print "Disabled in Demo Mode"; return; }

		$id = trim(strip_tags($_GET['id']));
		$value = trim(strip_tags($_GET['value']));
	 
		$DB->Update("UPDATE compatibility_field SET fOrder='".$value."' WHERE fid='".$id."' LIMIT 1");

		print "Field Order Updated";

	} break;

	case "compatibilityfieldweightpage": {

		if(ADMIN_DEMO == "yes"){ print "Disabled in Demo Mode"; return; }

		$id = trim(strip_tags($_GET['id']));
		$value = trim(strip_tags($_GET['value']));
	 
		$DB->Update("UPDATE compatibility_field SET field_weight

			='".$value."' WHERE fid='".$id."' LIMIT 1");

		print "Field Weight Updated";

	} break;

	case "compatibilityfieldratepage": {

		if(ADMIN_DEMO == "yes"){ print "Disabled in Demo Mode"; return; }

		$id = trim(strip_tags($_GET['id']));
		$value = trim(strip_tags($_GET['value']));
	 
		$DB->Update("UPDATE compatibility_field_caption SET is_multiple_type

			='".$value."' WHERE Cid='".$id."'");

		print "Field Rate Type Updated";

	} break;

	case "fieldtypepage": {

	if(ADMIN_DEMO == "yes"){ print "Disabled in Demo Mode"; return; }

	$id = trim(strip_tags($_GET['id']));
	$value = trim(strip_tags($_GET['value']));
	$type = trim(strip_tags($_GET['type']));
 	$div = (isset($_GET['div'])) ? trim(strip_tags($_GET['div'])) : '';
 
	switch($value){
	
	case "1": { }
	case "yes": {$img="yes.png"; $nVal ="no";} break;
	
	case "0": { }
	case "no": {$img="no.png"; $nVal ="yes";} break;
	
	}
	
		switch($type){
	
		case "1": {		$DB->Update("UPDATE field SET browsepage='".$value."' WHERE fid='".$id."' LIMIT 1");	} break;
		case "2": {		$DB->Update("UPDATE field SET required='".$value."' WHERE fid='".$id."' LIMIT 1");		} break;
			case "3": {		$DB->Update("UPDATE field SET matchpage='".$value."' WHERE fid='".$id."' LIMIT 1");		} break;
	
		}
	$div = (isset($div)) ? $div : '';
	print "<img src='inc/images/icons/".$img."' onClick=\"UpdateFieldPage('".$nVal."','".$id."','".$div."',".$type.")\" style='cursor:pointer;'>";

	

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

	$SearchConfig = array(
	
	"Cpage" => $start,
	"Spage" =>"",
	"Tpage" => $RowsPerPage,
	"sort" => $sortBy,
	"Wsort" => $sortWay,
	"search" => $searchValue,
	"Fsearch" => $searchField,

	);

	print MakeTable($SearchConfig);
	
	} break;


	case 'DeleteRow': {

	if(ADMIN_DEMO == "yes"){ print "Disabled in Demo Mode"; return; }

	$id = trim(strip_tags($_GET['id']));
	$table = trim(strip_tags($_GET['table']));
	$bits = explode(".",$table);
	
	
		// CUSTOM DELETE OPTIONS
		if( $bits[0] =="field_groups"){			 	
			// MOVE THESE FIELDS TO A NEW GROUP
			$NewGroup = $DB->Row("SELECT id FROM field_groups LIMIT 1");
			$DB->Insert("UPDATE field SET groupid='".$NewGroup['id']."' WHERE groupid  = '".$id."' ");
	
		}elseif( $bits[0] =="members"){
			
			$val = $DB->Row("SELECT members_privacy.Notifications, members.email, members.username FROM members_privacy, members WHERE members_privacy.uid = members.id AND members_privacy.uid=".$id);
			$DB->Update("DELETE FROM members WHERE id=".$id);
			$DB->Update("DELETE FROM members_reported WHERE to_uid=".$id);
			$DB->Update("DELETE FROM members_data WHERE uid=".$id);
							
			$result = $DB->Query("SELECT bigimage, type, id FROM files WHERE uid=".$id);

			while( $file = $DB->NextRow($result) ){

				if( $file['type'] == 'music'){

					@unlink(PATH_MUSIC.$file['bigimage']);
												
				}elseif($file['type'] =='video'){
									
					@unlink(PATH_VIDEO.$file['bigimage']);
										
				}else{
									
					@unlink(PATH_IMAGE.$file['bigimage']);
					@unlink(PATH_IMAGE_THUMBS.$file['bigimage']);
													
				}
				$DB->Update("DELETE FROM files WHERE uid=".$id." AND id=".$file['id']);
			}
							
					$DB->Update("DELETE FROM album WHERE uid =".$id);							
					$DB->Update("DELETE FROM forum_posts WHERE poster_id =".$id);
					$DB->Update("DELETE FROM forum_topics WHERE topic_poster =".$id);
					$DB->Update("DELETE FROM members_network WHERE uid=".$id);
					$DB->Update("DELETE FROM members_network WHERE to_uid=".$id);							
					$DB->Update("DELETE FROM poll_check WHERE uid =".$id);							
					$DB->Update("DELETE FROM members_template WHERE uid =".$id);
					$DB->Update("DELETE FROM member_scores WHERE uid =".$id);							
					$DB->Update("DELETE FROM members_billing WHERE uid =".$id);
					$DB->Update("DELETE FROM comments WHERE from_uid =".$id);							
					$DB->Update("DELETE FROM quiz WHERE uid =".$id);
					$DB->Update("DELETE FROM quiz_questions WHERE uid =".$id);
					$DB->Update("DELETE FROM quiz_results WHERE uid =".$id);							
					$DB->Update("DELETE FROM visited WHERE uid =".$id);
					$DB->Update("DELETE FROM poll_check WHERE uid =".$id);
					$DB->Update("DELETE FROM members_online WHERE logid =".$id);
					$DB->Update("DELETE FROM messages WHERE uid =".$id);
							
					$DB->Update("DELETE FROM members_privacy WHERE uid=".$id);
					if($val['Notifications'] =="yes"){
													
								$Data['email'] =  $val['email'];
								$Data['username'] =  $val['username'];																	
								SendTemplateMail($Data, 8);
					}
	
		}elseif( $bits[0] =="files"){			 	

    		$file = $DB->Row("SELECT id, uid, bigimage, type, aid, `default`, approved FROM files WHERE id=".$id);
			if(is_numeric($file['id'])){
						$DB->Update("DELETE FROM files WHERE id=".$file['id']);
			}

			if( $file['type'] == 'music'){

				@unlink(PATH_MUSIC.$file['bigimage']);
												
			}elseif($file['type'] =='video'){
									
				@unlink(PATH_VIDEO.$file['bigimage']);
										
			}else{
				@unlink(PATH_IMAGE.$file['bigimage']);
				@unlink(PATH_IMAGE_THUMBS.$file['bigimage']);			
			}
									
			$DB->Update("UPDATE album SET filecount=filecount-1 WHERE aid=".$file['aid']);
		 
								
			// IF THIS WAS THE DEFAULT FILE, MAKE ANOTHER FILE DEFAULT
			if(	$file['default'] ==1){
			$DB->Update("UPDATE files SET `default`=1 WHERE uid=".$file['uid']." LIMIT 1");
			}
								
			// SEND REJECTED EMAIL
			if($file['approved'] =="no"){
				$Data = $DB->Row("SELECT * FROM members WHERE id='".$file['uid']."' LIMIT 1");
				SendTemplateMail($Data, 15);										
			}
		}

		$DB->Update("DELETE FROM ".$bits[0]." WHERE ".$bits[1]." = '". $id ."' LIMIT 1");
		
		print "Deleted Successfully";
		
	} break;

	case 'BlockRow': {

	if(ADMIN_DEMO == "yes"){ print "Disabled in Demo Mode"; return; }

	$id = trim(strip_tags($_GET['id']));
	
		//BAN USER

		$val = $DB->Row("SELECT username,ip FROM members WHERE id = ".$id);

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
	$DB->Update("UPDATE ".$bits[0]." SET ".$field."='".$yesno."' WHERE ".$bits[1]." = '". $id ."' LIMIT 1");

	if($field =="members.moderator" && $bits[0] =="members"){

	$Data = $DB->Row("SELECT username,password,email FROM members WHERE id=".$id." LIMIT 1");

	   if($yesno =="yes"){	

	   $DB->Update("INSERT INTO `members_admin` (`access_level` ,`last_login` ,`username`, password, email, icon) VALUES ( '', NOW( ) , '".$Data['username']."','".$Data['password']."','".$Data['email']."', '1.gif' )");

	   }else{
		$DB->Update("DELETE FROM members_admin WHERE username='".$Data['username']."' LIMIT 1");
	   }

	}

	if($field =="files.approved" && $yesno =="yes" ){
	   	print "File Approved";
		$Data = $DB->Row("SELECT members.* FROM members, files WHERE files.id='".$id."' and members.id = files.uid LIMIT 1");
		SendTemplateMail($Data, 10);								

	}
	else {

	   print "Database Updated";
	}

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
						foreach ($mFieldValues as $field => $fieldValue) {
							
							if(isset($data['approval_edit']) && $data['approval_edit']=='yes'){
								$DB->Update("UPDATE members_data_pending_approval SET ".$field." = '".implode("**", $fieldValue)."' WHERE uid=".$data['uid']);
							}
							else{
								$DB->Update("UPDATE members_data SET ".$field." = '".implode("**", $fieldValue)."' WHERE uid=".$data['uid']);
							}
						}

					}
				}
				
				else if($key!='uid' && $key!='approval_edit'){
					
					if(isset($data['approval_edit']) && $data['approval_edit']=='yes'){
						$DB->Update("UPDATE members_data_pending_approval SET ".$key." = '".$value."' WHERE uid=".$data['uid']);
					}
					else{
						$DB->Update("UPDATE members_data SET ".$key." = '".$value."' WHERE uid=".$data['uid']);
					}
					
				
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
			$fieldval = $_POST['headline'];
			//$questionval = $_REQUEST[$fieldval];
			$DB->Update("UPDATE members_data SET `headline` = '".$fieldval."' WHERE uid=".$_REQUEST['mid']);
			echo $fieldval;
	break;
	
	case 'editmylocation':
			$fieldval = $_POST;
			$questionval = $_REQUEST[$fieldval];
			$year = $fieldval['birthdayyear'];
			$month = $fieldval['birthdaymonth'];
			$day = $fieldval['birthdayday'];
			$age = $year.'-'.$month.'-'.$day;
			
			if(isset($fieldval['approval_edit']) && $fieldval['approval_edit'] == 'yes'){
				if($fieldval['FieldValue54']){
					$DB->Update("UPDATE `members_data_pending_approval` SET `country` = '".$fieldval['country']."',`em_85820081128` = ".$fieldval['FieldValue54'].",`location` = '".$fieldval['location']."', `age` = '".$age."', `gender` = '".$fieldval['gender']."', `em_8cx20070511`= ".$fieldval['orientation']." WHERE uid=".$fieldval['mid']);
				} else{
					$DB->Update("UPDATE `members_data_pending_approval` SET `country` = '".$fieldval['country']."',`location` = '".$fieldval['location']."', `age` = '".$age."', `gender` = '".$fieldval['gender']."', `em_8cx20070511`= ".$fieldval['orientation']." WHERE uid=".$fieldval['mid']);
				}
			}
			else{
				if($fieldval['FieldValue54']){
					$DB->Update("UPDATE `members_data` SET `country` = '".$fieldval['country']."',`em_85820081128` = ".$fieldval['FieldValue54'].",`location` = '".$fieldval['location']."', `age` = '".$age."', `gender` = '".$fieldval['gender']."', `em_8cx20070511`= ".$fieldval['orientation']." WHERE uid=".$fieldval['mid']);
				} else{
					$DB->Update("UPDATE `members_data` SET `country` = '".$fieldval['country']."',`location` = '".$fieldval['location']."', `age` = '".$age."', `gender` = '".$fieldval['gender']."', `em_8cx20070511`= ".$fieldval['orientation']." WHERE uid=".$fieldval['mid']);
				}
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

	case "membership": { print "<select onChange=\"eMeetingSaveDiv('".$div."','membership',this.value,'".$id."')\">".DisplayPackage($current)."</select>"; } break;
	case "status": { print "<select onChange=\"eMeetingSaveDiv('".$div."','status',this.value,'".$id."')\">".DisplayStatus($current)."</select>"; } break;
	case "gender": { print "<select onChange=\"eMeetingSaveDiv('".$div."','gender',this.value,'".$id."')\">".DisplayGenderList($current)."</select>"; } break;
	case "country": { print "<select onChange=\"eMeetingSaveDiv('".$div."','country',this.value,'".$id."')\">".DisplayCountryList($current)."</select>"; } break;
 

	default: { print "Nothing Selected??"; }

	}
	
	} break;

	case "ChangeInput":{
	
	$id = trim(strip_tags($_GET['id']));
	$field = trim(strip_tags($_GET['field']));
	$current = trim(strip_tags($_GET['current']));
 	$div = (isset($_GET['div'])) ? trim(strip_tags($_GET['div'])) : '';
	$switchMe = trim(strip_tags($_GET['switchMe']));
 
	switch($switchMe){

	case "meta_title": { print "<input type='text' onBlur=\"eMeetingSaveDiv('".$div."','meta_title',this.value,'".$id."')\" value='".$current."'>"; } break;
	case "meta_keywords": { print "<input type='text' onBlur=\"eMeetingSaveDiv('".$div."','meta_keywords',this.value,'".$id."')\" value='".$current."'>"; } break;
	case "meta_description": { print "<textarea onBlur=\"eMeetingSaveDiv('".$div."','meta_description',this.value,'".$id."')\">".$current."</textarea>"; } break;
	default: { print "Nothing Selected??"; }

	}
	
	} break;

	case "SaveDiv": {

	if(ADMIN_DEMO == "yes"){ print "Disabled in Demo Mode"; return; }

	$id = trim(strip_tags($_GET['id']));
	$value = trim(strip_tags($_GET['value']));
	$type = trim(strip_tags($_GET['type']));
 	$div = (isset($_GET['div'])) ? trim(strip_tags($_GET['div'])) : '';
 
	switch($type){

	case "membership": {

	$DB->Update("UPDATE members SET packageid='".$value."', activate_code='OK' WHERE id='".$id."' LIMIT 1");

	print "<div id='".$div."' onClick=\"eMeetingChangeDiv('membership','".$div."', '".$value."','".$id."','0')\" style='cursor:pointer;'/>".GetPackageName($value)."</div>";

	} break;

	case "meta_title": {

	$DB->Update("UPDATE articles SET meta_title='".$value."' WHERE id='".$id."' LIMIT 1");

	print "<div id='".$div."' style='cursor:pointer;'/><span onClick=\"eMeetingChangeInput('meta_title','".$div."', '".$value."','".$id."','articles.meta_title')\"><img src='inc/images/pencil-icon.png' class='article-edit-icon'>".$value."</span></div>";
	
	} break;

	case "meta_keywords": {

	$DB->Update("UPDATE articles SET meta_keywords='".$value."' WHERE id='".$id."' LIMIT 1");

	print "<div id='".$div."' style='cursor:pointer;'/><span onClick=\"eMeetingChangeInput('meta_keywords','".$div."', '".$value."','".$id."','articles.meta_keywords')\"><img src='inc/images/pencil-icon.png' class='article-edit-icon'>".$value."</span></div>";
	
	} break;

	case "meta_description": {

	$DB->Update("UPDATE articles SET meta_description='".$value."' WHERE id='".$id."' LIMIT 1");

	print "<div id='".$div."' style='cursor:pointer;'/><span onClick=\"eMeetingChangeInput('meta_description','".$div."', '".$value."','".$id."','articles.meta_description')\"><img src='inc/images/pencil-icon.png' class='article-edit-icon'>".$value."</span></div>";
	
	} break;

	case "location": {

	$DB->Update("UPDATE members_data SET location='".$value."' WHERE uid='".$id."' LIMIT 1");

	} break;



	case "status": {

	if(ADMIN_DEMO == "yes"){ print "Disabled in Demo Mode"; return; }

	if($value == '---') { $value = 'active'; }

	$DB->Update("UPDATE members SET active='".$value."' WHERE id='".$id."' LIMIT 1");
	
	//	SEND EMAIL TO MEMBER
	if($value =="active" || $value =="suspended"){
		$Data = $DB->Row("SELECT members.* FROM members WHERE id='".$id."' LIMIT 1");
		switch($value){
		
			case "active": { SendTemplateMail($Data, 17); } break;
			case "suspended": { SendTemplateMail($Data, 58); } break;
	
		}
	}
	print "<div id='".$div."' onClick=\"eMeetingChangeDiv('status','".$div."', '".$value."','".$id."','0')\" style='cursor:pointer;'/>".$value."</div>";


	} break;

	case "gender": {

	if(ADMIN_DEMO == "yes"){ print "Disabled in Demo Mode"; return; }

	$DB->Update("UPDATE members_data SET gender='".$value."' WHERE uid='".$id."' LIMIT 1");

	print "<div id='".$div."' onClick=\"eMeetingChangeDiv('gender','".$div."', '".$value."','".$id."','0')\" style='cursor:pointer;'/>".$_SESSION['g_array'][$value]['icon']." ".$_SESSION['g_array'][$value]['caption']."</div>";

	} break;

	case "country": {

	if(ADMIN_DEMO == "yes"){ print "Disabled in Demo Mode"; return; }

	$DB->Update("UPDATE members_data SET country='".$value."' WHERE uid='".$id."' LIMIT 1");

	print "<div id='".$div."' onClick=\"eMeetingChangeDiv('country','".$div."', '".$value."','".$id."','0')\" style='cursor:pointer;'/>".$value."</div>";

	} break;



	}

	} break;
 

}
?>