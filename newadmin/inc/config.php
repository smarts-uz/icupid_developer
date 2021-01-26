<?php
/**
*       =========================================================================
*                                	CONFIG FILE
*       =========================================================================
*
*       @author:            AdvanDate, Ltd
*       @copyright:         AdvanDate, Ltd
*       @version:           Revision: 11.0
*       @date:              22nd July 2015
*       @last modified:     29th July 2015
*       @license            Licensed Software
*
*       @website:           www.advandate.com
*       @email:             contact@advandate.com
*
*       @requirements:      Valid Software License Key
*
*       =========================================================================
*
*       Copyright (C) 2009  AdvanDate, Ltd
*       
*       This program is not free software; you can not redistribute it and/or modify it
*       under the terms of the eMeeting Dating Software License as published by the
*       AdvanDate, Ltd.
*       
*       This program is distributed in the hope that it will be useful, but
*       WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
*       or FITNESS FOR A PARTICULAR PURPOSE. See the Software  License
*       for more details.
*       
*       You should have received a copy of the License Key along
*       with this program; if not, write to AdvanDate, Ltd or view the website for more details
*
*       =========================================================================
*/

if(!session_id())session_start();
if (!isset($loginSet) && ( !isset($_SESSION['admin_auth'])  || $_SESSION['admin_auth'] != "yes" ) )  {
	header("location: index.php");
	exit();  
}

if(isset($_SESSION['admin_lang']) && strlen($_SESSION['admin_lang']) > 2){
	define('A_LANG',''.$_SESSION['admin_lang'].'');
}else{
	define('A_LANG','english');
}

// LOAD THE LANGUAGE FILE
if(defined('D_LANG') && D_LANG =="" || !file_exists(dirname(__FILE__)."/langs/".strip_tags(A_LANG).".php") ){ 
		require_once(	dirname(__FILE__)."/langs/english.php"			);  
}else{  
		require_once(	dirname(__FILE__)."/langs/".strip_tags(A_LANG).".php"			); 
}

//////////////////////////////////////////////////////////////////////////////////////////
// DEFINE VALUES
///////////////////////////////////////////////////////////////////////////////////////////
define('subd','../');
define('theme_download','http://www.advandate.com');
define('powered_link','http://www.advandate.com');
define('sms_link','http://www.advandate.com/order-sms-credits');
define('upgrade_link','http://www.advandate.com/order-sms-credits');
define('upgrade_link_buy','http://www.advandate.com');
define('icon_edit','<img src="inc/images/icons/edit.png" align="absmiddle">');
define('lanicon_edit','<img src="inc/images/icons/edit.png" align="absmiddle">');
define('icon_email','<img src="inc/images/icons/email.gif" align="absmiddle">');
define('icon_delete','<img src="inc/images/icons/no.png" align="absmiddle">');
define('icon_files','<img src="inc/images/icons/files.gif" align="absmiddle">');
define('update_icon','<img src="inc/images/icons/yes.png" align="absmiddle">');
define("GAME_PATH_TARS",subd."inc/exe/Games/tars/");	
define("GAME_PATH_PICS",subd."inc/exe/Games/pics/");	
define("GAME_PATH_SWF",subd."inc/exe/Games/swf/");	
define("TEMPLATE_PATH_TARS",subd."inc/templates/");		
//////////////////////////////////////////////////////////////////////////////////////////
// LOAD INCLUDES
///////////////////////////////////////////////////////////////////////////////////////////
require_once "func/admin_globals.php";
require_once("class/class_pagenumbers.php" );

$mypv = '';
if(isset($_GET['p'])){
	$mypv = $_GET['p'];
}


	if( (isset($_POST['file'])) || ($mypv =="add" || $mypv =="newpage" || $mypv =="adminmsg" || $mypv =="send" || $mypv =="compose" || $mypv =="faqadd" || $mypv =="articleadd" || $mypv == "addclass" ) ){ 

		$path = $_SERVER['HTTP_HOST'];
		$Epath = str_replace("install/", "", $_SERVER['REQUEST_URI']);$Epath = str_replace("3.php", "", $Epath);$ext = explode("/",$Epath);if(isset($ext[1]) && strlen($ext[0]) =="" && strlen($ext[1]) >0){$path .= "/".$ext[1];}
			
		$hostname = str_replace("//","/",$path);
 
		include_once('wysiwygPro/wysiwygPro.class.php');		
		$editor = new wysiwygPro();				
		$editor->name = 'editor'; 	
		 
		// Full file path of your images folder:
		$editor->imageDir = dirname(str_replace("newadmin/","/",dirname(__FILE__))).'/uploads/files/';

		// URL of your images folder:
		$editor->imageURL = dirname("http://".str_replace("newadmin","",$hostname)."/".str_replace("newadmin/","",$_SERVER['SCRIPT_NAME'])).'/uploads/files/';
		
		// set file browser editing permissions:
		$editor->editImages = true;
		$editor->renameFiles = true;
		$editor->renameFolders = true;
		$editor->deleteFiles = true;
		$editor->deleteFolders = true;
		$editor->copyFiles = true;
		$editor->copyFolders = true;
		$editor->moveFiles = true;
		$editor->moveFolders = true;
		$editor->upload = true;
		$editor->overwrite = true;
		$editor->createFolders = true;


		// load and configure the server preview plugin
		//$editor->loadPlugin('serverPreview');
		//$editor->plugins['serverPreview']->URL = 'preview.php';
		$editor->fullURLs = true; 

		// set the html content
		// $editor->page->content;

}

//////////////////////////////////////////////////////////////////////////////////////////
// SETUP TABLE VALUES
///////////////////////////////////////////////////////////////////////////////////////////
if(isset($_GET['system'])){
	switch($_GET['system']){
	
		case "cal": {
	
			$GLOBALS['SEARCH_DATA'] = array(
			"tb_system" =>"cal",
			
			"tb_data" => array("calendar_data.id","members.username", "calendar_data.shortevent","calendar_data.approved","calendar_data.featured","calendar_types.name"),
			"tb_captions" => array("ID","Username", "Title", "Active","Featured","Name"),
			"tb_data_name" => array("calendar_data.","calendar_types.","members."), // used to display the table data			 
			"tb_tables" => "calendar_data LEFT JOIN calendar_types ON (calendar_data.type_1 = calendar_types.id) LEFT JOIN members ON ( members.id = calendar_data.uid) ",
			"tb_where" => "", //WHERE files.album_id = albums.id
			"tb_OrderBy" => "calendar_data.id",
			"tb_OrderWay" =>"ASC",
			"tb_defaultField" => "calendar_data.shortevent", // default search field
			"tb_deletevalue" => "calendar_data.id", // default search field
			"tb_edit" => true, // default search field
			"tb_edit_path" => "?p=caladd&eid=",
			"tb_rowsPerPage" => "10",
			"tb_hideID" => true,
			"tb_defaultValue" => 0,
			);
	
		} break;
		case "class": { //SELECT class_adverts.*,class_cats.name AS cat_name, class_cats.icon FROM class_adverts  ORDER BY class_adverts.date_added LIMIT 50
	
			$GLOBALS['SEARCH_DATA'] = array(
			"tb_system" =>"class",
			"tb_data" => array("class_adverts.id","class_cats.name AS Category","class_adverts.title","class_adverts.featured","class_adverts.approved","class_adverts.date_added","class_cats.icon"),
			"tb_captions" => array("ID","Category", "Title", "Featured","Approved","Date","Icon"),
			"tb_data_name" => array("class_cats.","class_adverts."), // used to display the table data			 
			"tb_tables" => "class_adverts INNER JOIN class_cats ON (class_adverts.cat_id = class_cats.id ) ",
			"tb_where" => "", //WHERE files.album_id = albums.id
			"tb_OrderBy" => "class_adverts.id",
			"tb_OrderWay" =>"ASC",
			"tb_defaultField" => "class_adverts.title", // default search field
			"tb_deletevalue" => "class_adverts.id", // default search field
			"tb_edit" => true, // default search field
			"tb_edit_path" => "?p=addclass&id=",
			"tb_rowsPerPage" => "10",
			"tb_hideID" => true,
			"tb_defaultValue" => 0,
			);
	
		} break;
		case "words": { //SELECT * FROM badwords ORDER BY id DESC
	
			$GLOBALS['SEARCH_DATA'] = array(
			"tb_system" =>"words",
			"tb_captions" => array("ID","Work or Phrase"),
			"tb_data" => array("badwords.id","badwords.word"),
			"tb_data_name" => array("badwords."), // used to display the table data			 
			"tb_tables" => "badwords",
			"tb_where" => "", //WHERE files.album_id = albums.id
			"tb_OrderBy" => "badwords.id",
			"tb_OrderWay" =>"ASC",
			"tb_defaultField" => "badwords.word", // default search field
			"tb_deletevalue" => "badwords.id", // default search field
			"tb_edit" => false, // default search field
			"tb_edit_path" => "",
			"tb_rowsPerPage" => "10",
			"tb_hideID" => true,
			"tb_defaultValue" => 0,
			);
	
		} break;
		case "epackagelanguage": { //SELECT * FROM packages ORDER BY id DESC
			
			$condition = "";

			if(isset($_GET['id']) && $_GET['id'] != ""  && $_GET['id'] != "0"){
				$condition = " WHERE package.pid = '".$_GET['id']."' ";
			}

			$GLOBALS['SEARCH_DATA'] = array(
			"tb_system" =>"epackagelanguage",
			"tb_captions" => array("ID","Caption","Description","Language"),
			"tb_data" => array("package_languages.id","package_languages.caption","package_languages.comments","package_languages.language AS lang"),
			"tb_data_name" => array("package.","package_languages."), // used to display the table data			 
			"tb_tables" => "package LEFT JOIN package_languages ON (package.pid = package_languages.pid )",
			"tb_where" => "WHERE package.pid = '".$_GET['startvalue']."'", //WHERE files.album_id = albums.id
			"tb_OrderBy" => "package_languages.caption",
			"tb_OrderWay" =>"ASC",
			"tb_defaultField" => "package_languages.caption", // default search field
			"tb_deletevalue" => "package_languages.id", // default search field
			"tb_edit" => false, // default search field
			"tb_edit_path" => "?p=epackage&id=",
			"tb_rowsPerPage" => "10",
			"tb_hideID" => true,
			"tb_defaultValue" => 0,
			);
	
		} break;

		case "managegrouplanguages": { //SELECT * FROM packages ORDER BY id DESC
			
			$condition = "";

			if(isset($_GET['startvalue']) && $_GET['startvalue'] != ""  && $_GET['startvalue'] != "0"){
				$condition = " WHERE field_group_languages
.fgid = '".$_GET['startvalue']."' ";
			}

			$GLOBALS['SEARCH_DATA'] = array(
			"tb_system" =>"managegrouplanguages",
			"tb_captions" => array("ID","Title","Language"),
			"tb_data" => array("field_group_languages.id","field_group_languages.caption","field_group_languages.language AS lang"),
			"tb_data_name" => array("field_group_languages."), // used to display the table data			 
			"tb_tables" => "field_group_languages",
			"tb_where" => $condition, //WHERE files.album_id = albums.id
			"tb_OrderBy" => "field_group_languages.caption",
			"tb_OrderWay" =>"ASC",
			"tb_defaultField" => "field_group_languages.caption", // default search field
			"tb_deletevalue" => "field_group_languages.id", // default search field
			"tb_edit" => false, // default search field
			"tb_edit_path" => "?p=epackage&id=",
			"tb_rowsPerPage" => "10",
			"tb_hideID" => true,
			"tb_defaultValue" => 0,
			);
	
		} break;

		case "addclasscat": { //SELECT * FROM class_cats ORDER BY id DESC
	
			$GLOBALS['SEARCH_DATA'] = array(
			"tb_system" =>"addclasscat",
			"tb_captions" => array("ID","Name","Parent ID","Photo"),
			"tb_data" => array("class_cats.id","class_cats.name","class_cats.subId", "class_cats.icon AS photo"),
			"tb_data_name" => array("class_cats."), // used to display the table data			 
			"tb_tables" => "class_cats",
			"tb_where" => "", //WHERE files.album_id = albums.id
			"tb_OrderBy" => "class_cats.id",
			"tb_OrderWay" =>"ASC",
			"tb_defaultField" => "class_cats.word", // default search field
			"tb_deletevalue" => "class_cats.id", // default search field
			"tb_edit" => true, // default search field
			"tb_edit_path" => "?p=addclasscat&id=",
			"tb_rowsPerPage" => "10",
			"tb_hideID" => false,
			"tb_defaultValue" => 0,
			);
	
		} break;
		case "caladdtype": { // SELECT * FROM calendar_types ORDER BY id DESC
	
			$GLOBALS['SEARCH_DATA'] = array(
			"tb_system" =>"caladdtype",
			"tb_captions" => array("ID","Name","Photo"),
			"tb_data" => array("calendar_types.id","calendar_types.name","calendar_types.icon AS photo"),
			"tb_data_name" => array("calendar_types."), // used to display the table data			 
			"tb_tables" => "calendar_types",
			"tb_where" => "", //WHERE files.album_id = albums.id
			"tb_OrderBy" => "calendar_types.id",
			"tb_OrderWay" =>"ASC",
			"tb_defaultField" => "calendar_types.word", // default search field
			"tb_deletevalue" => "calendar_types.id", // default search field
			"tb_edit" => true, // default search field
			"tb_edit_path" => "?p=caladdtype&id=",
			"tb_rowsPerPage" => "10",
			"tb_hideID" => true,
			"tb_defaultValue" => 0,
			);
	
		} break;
		case "games": { // SELECT * FROM game_games ORDER BY times_played DESC
	
			$GLOBALS['SEARCH_DATA'] = array(
			"tb_system" =>"games",
			"tb_captions" => array("ID","Icon","Name","Last Played","Times Played","Rating"),
			"tb_data" => array("game_games.id","game_games.gameid AS Icon","game_games.game","game_games.last_played","game_games.times_played","game_games.rating"),
			"tb_data_name" => array("game_games."), // used to display the table data			 
			"tb_tables" => "game_games",
			"tb_where" => "", //WHERE files.album_id = albums.id
			"tb_OrderBy" => "game_games.id",
			"tb_OrderWay" =>"ASC",
			"tb_defaultField" => "game_games.word", // default search field
			"tb_deletevalue" => "game_games.id", // default search field
			"tb_edit" => false, // default search field
			"tb_edit_path" => "",
			"tb_rowsPerPage" => "10",
			"tb_hideID" => true,
			"tb_defaultValue" => 0,
			);
	
		} break;
		case "faq": { // SELECT * FROM faq ORDER BY orderid ASC
	
			$GLOBALS['SEARCH_DATA'] = array(
			"tb_system" =>"faq",  
"tb_captions" => array("ID","Title","Date"),
			"tb_data" => array("faq.id","faq.subject","faq.date"),
			"tb_data_name" => array("faq."), // used to display the table data			 
			"tb_tables" => "faq",
			"tb_where" => "", //WHERE files.album_id = albums.id
			"tb_OrderBy" => "faq.id",
			"tb_OrderWay" =>"ASC",
			"tb_defaultField" => "faq.subject", // default search field
			"tb_deletevalue" => "faq.id", // default search field
			"tb_edit" => true, // default search field
			"tb_edit_path" => "?p=faqadd&eid=",
			"tb_rowsPerPage" => "10",
			"tb_hideID" => true,
			"tb_defaultValue" => 0,
			);
	
		} break;
		case "chatrooms": { // SELECT * FROM chatroom_rooms ORDER BY room_id ASC
	
			$GLOBALS['SEARCH_DATA'] = array( //room_id 	room_name 	room_count 	room_pass
			"tb_system" =>"chatrooms",  
			"tb_captions" => array("ID","Name","Counter","Password"),
			"tb_data" => array("chatroom_rooms.room_id","chatroom_rooms.room_name","chatroom_rooms.room_count","chatroom_rooms.room_pass"),
			"tb_data_name" => array("chatroom_rooms."), // used to display the table data			 
			"tb_tables" => "chatroom_rooms",
			"tb_where" => "", //WHERE files.album_id = albums.id
			"tb_OrderBy" => "chatroom_rooms.room_id",
			"tb_OrderWay" =>"ASC",
			"tb_defaultField" => "chatroom_rooms.room_name", // default search field
			"tb_deletevalue" => "chatroom_rooms.room_id", // default search field
			"tb_edit" => true, // default search field
			"tb_edit_path" => "?p=chatrooms&eid=",
			"tb_rowsPerPage" => "10",
			"tb_hideID" => true,
			"tb_defaultValue" => 0,
			);
	
		} break;
		case "forumpost": { // , , forum_posts.forum_id, forum_posts.topic_id, forum_posts.poster_id, forum_posts.post_time, , ,  FROM   $extra ORDER BY
	
			$GLOBALS['SEARCH_DATA'] = array( //forum_posts, forum_forums, forum_topics
			"tb_system" =>"forumpost",  
			"tb_captions" => array("ID","Username","Text","Title","Forum Name"),
			"tb_data" => array("forum_posts.post_id","forum_topics.topic_poster_name AS username","forum_posts.post_text","forum_topics.topic_title","forum_forums.forum_name AS forumname"),
			"tb_data_name" => array("forum_posts.","forum_topics.","forum_forums."), // used to display the table data			 
			"tb_tables" => "forum_posts, forum_forums, forum_topics ",
			"tb_where" => "WHERE forum_posts.topic_id = forum_topics.topic_id AND forum_posts.forum_id = forum_forums.forum_id", //WHERE files.album_id = albums.id
			"tb_OrderBy" => "forum_posts.post_id",
			"tb_OrderWay" =>"ASC",
			"tb_defaultField" => "forum_posts.post_text", // default search field
			"tb_deletevalue" => "forum_posts.post_id", // default search field
			"tb_edit" => true, // default search field
			"tb_edit_path" => "?p=editpost&pid=",
			"tb_rowsPerPage" => "10",
			"tb_hideID" => true,
			"tb_defaultValue" => 0,
			);
	
		} break;
		case "forum": { //SELECT * FROM forum_forums ORDER BY forum_id DESC
	
			$GLOBALS['SEARCH_DATA'] = array( //forum_posts, forum_forums, forum_topics
			"tb_system" => "forum",  
			"tb_captions" => array("ID","Forum Name","Description","Icon","Order"),
			"tb_data" => array("forum_forums.forum_id","forum_forums.forum_name","forum_forums.forum_desc","forum_forums.forum_icon","forum_forums.forum_order"),
			"tb_data_name" => array("forum_forums."), // used to display the table data			 
			"tb_tables" => "forum_forums",
			"tb_where" => "", //WHERE files.album_id = albums.id
			"tb_OrderBy" => "forum_forums.forum_id",
			"tb_OrderWay" =>"ASC",
			"tb_defaultField" => "forum_forums.forum_name", // default search field
			"tb_deletevalue" => "forum_forums.forum_id", // default search field
			"tb_edit" => true, // default search field
			"tb_edit_path" => "?p=forumadd&id=",
			"tb_rowsPerPage" => "10",
			"tb_hideID" => true,
			"tb_defaultValue" => 0,
			);
	
		} break;
		case "poll": { //SELECT  FROM poll_desc ORDER BY timestamp DESC
	
			$GLOBALS['SEARCH_DATA'] = array( //forum_posts, forum_forums, forum_topics
			"tb_system" => "poll",  
			"tb_captions" => array("ID","Title","Active","Date"),
			"tb_data" => array("poll_desc.pollid","poll_desc.polltitle","poll_desc.status","poll_desc.timestamp"),
			"tb_data_name" => array("poll_desc."), // used to display the table data			 
			"tb_tables" => "poll_desc",
			"tb_where" => "", //WHERE files.album_id = albums.id
			"tb_OrderBy" => "poll_desc.pollid",
			"tb_OrderWay" =>"ASC",
			"tb_defaultField" => "poll_desc.polltitle", // default search field
			"tb_deletevalue" => "poll_desc.pollid", // default search field
			"tb_edit" => true, // default search field
			"tb_edit_path" => "?p=polladd&id=",//?p=pollresults&id=
			"tb_rowsPerPage" => "10",
			"tb_hideID" => true,
			"tb_defaultValue" => 0,
			);
	
		} break;
		case "articles": { //SELECT  WHERE articles.cat_id = articles_cat.id ORDER BY articles.id DESC
			
			$condition = "";

			if(isset($_GET['sub']) && $_GET['sub'] != "all"  && $_GET['sub'] != ""){
				$condition = " WHERE articles.status = '".$_GET['sub']."' ";
			}

			$GLOBALS['SEARCH_DATA'] = array( //forum_posts, forum_forums, forum_topics
			"tb_system" => "articles",  
			"tb_captions" => array("ID","Title","Author","Category ID","Categories","SEO Title","SEO Description","SEO Keywords"),
			"tb_data" => array("articles.id","IF(articles.status='draft',CONCAT(articles.title,'<span>-Draft</span>'),articles.title) AS article_title","members.username","articles.cat_id","articles_cat.name AS Category", "articles.meta_title", "articles.meta_description", "articles.meta_keywords"),
			"tb_data_name" => array("articles.","articles_cat.","article_categories_assigned.","members."), // used to display the table data			 
			"tb_tables" => "articles LEFT JOIN article_categories_assigned ON ( articles.id = article_categories_assigned.article_id) LEFT JOIN articles_cat ON ( article_categories_assigned.category_id = articles_cat.id) LEFT JOIN members ON ( members.id = articles.author_id) ",
			"tb_where" => $condition, //WHERE files.album_id = albums.id
			"tb_OrderBy" => "articles.id",
			"tb_OrderWay" =>"ASC",
			"tb_defaultField" => "articles.title", // default search field
			"tb_deletevalue" => "articles.id", // default search field
			"tb_edit" => false, // default search field
			"tb_edit_path" => "?p=articleadd&id=",//?p=pollresults&id=
			"tb_rowsPerPage" => "10",
			"tb_hideID" => true,
			"tb_defaultValue" => 0,
			);
	
		} break;
		case "articlecats": { //SELECT * FROM articles_cat ORDER BY count DESC
	
			$GLOBALS['SEARCH_DATA'] = array( //forum_posts, forum_forums, forum_topics
			"tb_system" => "articlecats",  
			"tb_captions" => array("ID","Catgory Name","Counter"),
			"tb_data" => array("articles_cat.id","articles_cat.name","articles_cat.count"),
			"tb_data_name" => array("articles_cat."), // used to display the table data			 
			"tb_tables" => "articles_cat",
			"tb_where" => "", //WHERE files.album_id = albums.id
			"tb_OrderBy" => "articles_cat.id",
			"tb_OrderWay" =>"ASC",
			"tb_defaultField" => "articles_cat.name", // default search field
			"tb_deletevalue" => "articles_cat.id", // default search field
			"tb_edit" => true, // default search field
			"tb_edit_path" => "?p=articlecats&id=",//?p=pollresults&id=
			"tb_rowsPerPage" => "10",
			"tb_hideID" => true,
			"tb_defaultValue" => 0,
			);
	
		} break;
		case "groups": { //SELECT * FROM groups_cats ORDER BY id ASC
	
			$GLOBALS['SEARCH_DATA'] = array( //forum_posts, forum_forums, forum_topics
			"tb_system" => "groups",  
			"tb_captions" => array("ID","Name","Icon"),
			"tb_data" => array("groups_cats.id","groups_cats.name","groups_cats.photo"),
			"tb_data_name" => array("groups_cats."), // used to display the table data			 
			"tb_tables" => "groups_cats",
			"tb_where" => "", //WHERE files.album_id = albums.id
			"tb_OrderBy" => "groups_cats.id",
			"tb_OrderWay" =>"ASC",
			"tb_defaultField" => "groups_cats.name", // default search field
			"tb_deletevalue" => "groups_cats.id", // default search field
			"tb_edit" => true, // default search field
			"tb_edit_path" => "?p=groups&id=",//?p=pollresults&id=
			"tb_rowsPerPage" => "10",
			"tb_hideID" => true,
			"tb_defaultValue" => 0,
			);
	
		} break;
		case "fieldgroups": { //SELECT * FROM field_groups ORDER BY forder ASC
	
			$GLOBALS['SEARCH_DATA'] = array( //Full Texts  	id 	caption 	forder 	private
			"tb_system" => "fieldgroups",  
			"tb_captions" => array("ID","Name","Order","Language"),
			"tb_data" => array("field_groups.id","field_groups.caption","field_groups.forder","'english' AS lang_edit"),
			"tb_data_name" => array("field_groups."), // used to display the table data			 
			"tb_tables" => "field_groups",
			"tb_where" => "", //WHERE files.album_id = albums.id
			"tb_OrderBy" => "field_groups.id",
			"tb_OrderWay" =>"ASC",
			"tb_defaultField" => "field_groups.caption", // default search field
			"tb_deletevalue" => "field_groups.id", // default search field
			"tb_edit" => true, // default search field
			"tb_edit_path" => "?p=addgroups&e=",//?p=pollresults&id=
			"tb_rowsPerPage" => "10",
			"tb_hideID" => true,
			"tb_defaultValue" => 0,
			);
	
		} break;
		case "compatibilityfieldgroups": { //SELECT * FROM field_groups ORDER BY forder ASC
	
			$GLOBALS['SEARCH_DATA'] = array( //Full Texts  	id 	caption 	forder 	private
			"tb_system" => "compatibilityfieldgroups",  
			"tb_captions" => array("ID","Name","Order"),
			"tb_data" => array("compatibility_field_groups.id","compatibility_field_groups.caption","compatibility_field_groups.forder"),
			"tb_data_name" => array("compatibility_field_groups."), // used to display the table data			 
			"tb_tables" => "compatibility_field_groups",
			"tb_where" => "", //WHERE files.album_id = albums.id
			"tb_OrderBy" => "compatibility_field_groups.id",
			"tb_OrderWay" =>"ASC",
			"tb_defaultField" => "compatibility_field_groups.caption", // default search field
			"tb_deletevalue" => "compatibility_field_groups.id", // default search field
			"tb_edit" => true, // default search field
			"tb_edit_path" => "?p=compatibilityaddgroups&e=",//?p=pollresults&id=
			"tb_rowsPerPage" => "10",
			"tb_hideID" => true,
			"tb_defaultValue" => 0,
			);
	
		} break;
		case "fieldedit": { //SELECT caption, lang, id, `description`, `match` FROM field_caption WHERE Cid =".$id." ORDER BY id DESC
			//if(isset($_GET['startvalue']) && $_GET['startvalue'] !=0){ die($_GET['startvalue']);}
			$GLOBALS['SEARCH_DATA'] = array( //Full Texts  	id 	caption 	forder 	private
			"tb_system" => "fieldedit",  
			"tb_captions" => array("ID","Title","Description","Language","Match Caption"),
			"tb_data" => array("field_caption.id","field_caption.caption","field_caption.description","field_caption.lang","field_caption.match"),
			"tb_data_name" => array("field_caption."), // used to display the table data			 
			"tb_tables" => "field_caption",
			"tb_where" => "WHERE Cid ='".$_GET['startvalue']."'", //WHERE files.album_id = albums.id
			"tb_OrderBy" => "field_caption.id",
			"tb_OrderWay" =>"ASC",
			"tb_defaultField" => "field_caption.caption", // default search field
			"tb_deletevalue" => "field_caption.id", // default search field
			"tb_edit" => false, // default search field
			"tb_edit_path" => "",//?p=pollresults&id=
			"tb_rowsPerPage" => "10",
			"tb_hideID" => true,
			"tb_defaultValue" => $_GET['startvalue'],
			);
	
		} break;
		case "compatibilityfieldedit": { //SELECT caption, lang, id, `description`, `match` FROM field_caption WHERE Cid =".$id." ORDER BY id DESC
			//if(isset($_GET['startvalue']) && $_GET['startvalue'] !=0){ die($_GET['startvalue']);}
			$GLOBALS['SEARCH_DATA'] = array( //Full Texts  	id 	caption 	forder 	private
			"tb_system" => "fieldedit",  
			"tb_captions" => array("ID","Title","Description","Language","Match Caption"),
			"tb_data" => array("compatibility_field_caption.id","compatibility_field_caption.caption","compatibility_field_caption.description","compatibility_field_caption.lang","compatibility_field_caption.match"),
			"tb_data_name" => array("compatibility_field_caption."), // used to display the table data			 
			"tb_tables" => "compatibility_field_caption",
			"tb_where" => "WHERE Cid ='".$_GET['startvalue']."'", //WHERE files.album_id = albums.id
			"tb_OrderBy" => "compatibility_field_caption.id",
			"tb_OrderWay" =>"ASC",
			"tb_defaultField" => "compatibility_field_caption.caption", // default search field
			"tb_deletevalue" => "compatibility_field_caption.id", // default search field
			"tb_edit" => false, // default search field
			"tb_edit_path" => "",//?p=pollresults&id=
			"tb_rowsPerPage" => "10",
			"tb_hideID" => true,
			"tb_defaultValue" => $_GET['startvalue'],
			);
	
		} break;
		case "fieldlist": { 

			if(strpos($_GET['startvalue'],"*1") ===false){

			 $ThisEdit =$_GET['startvalue']; 
			 $thisArray = array("field.linked_id","field_list_value.id","field_list_value.fvCaption","field_list_value.fvOrder","field_list_value.lang","field_list_value.default");

			}else{

			 $ThisEdit = str_replace("*1","",$_GET['startvalue']);
			 
			 }

			$thisArray = array("field.linked_id","field_list_value.id","field_list_value.fvCaption","field_list_value.fvOrder","field_list_value.lang","field_list_value.default","field_list_value.linked_cap_id AS LinkedWith");
 

			$GLOBALS['SEARCH_DATA'] = array( //Full Texts  	id 	caption 	forder 	private
			"tb_system" => "fieldlist",  
			"tb_captions" => array("ID","Title","Title","Order","Language","Default Option","Linked"),
			"tb_data" => $thisArray,
			"tb_data_name" => array("field_list_value.","field."), // used to display the table data			 
			"tb_tables" => "field_list_value INNER JOIN field ON (field.fid = field_list_value.fvFid)",
			"tb_where" => "WHERE field_list_value.fvFid ='".$ThisEdit."'", //WHERE files.album_id = albums.id
			"tb_OrderBy" => "field_list_value.fvOrder",
			"tb_OrderWay" =>"ASC",
			"tb_defaultField" => "field_list_value.fvCaption", // default search field
			"tb_deletevalue" => "field_list_value.id", // default search field
			"tb_edit" => false, // default search field
			"tb_edit_path" => "",//?p=pollresults&id=
			"tb_rowsPerPage" => "10",
			"tb_hideID" => true,
			"tb_defaultValue" => $ThisEdit,
			);
	
		} break;

		case "compatibilityfieldlist": { 

			if(strpos($_GET['startvalue'],"*1") ===false){

			 $ThisEdit =$_GET['startvalue']; 
			 $thisArray = array("compatibility_field.linked_id","compatibility_field_list_value.id","compatibility_field_list_value.fvCaption","compatibility_field_list_value.fvOrder","compatibility_field_list_value.lang","compatibility_field_list_value.default");

			}else{

			 $ThisEdit = str_replace("*1","",$_GET['startvalue']);
			 
			 }

			$thisArray = array("compatibility_field.linked_id","compatibility_field_list_value.id","compatibility_field_list_value.fvCaption","compatibility_field_list_value.fvOrder","compatibility_field_list_value.lang","compatibility_field_list_value.default","compatibility_field_list_value.linked_cap_id AS LinkedWith");
 

			$GLOBALS['SEARCH_DATA'] = array( //Full Texts  	id 	caption 	forder 	private
			"tb_system" => "fieldlist",  
			"tb_captions" => array("ID","Title","Title","Order","Language","Default Option","Linked"),
			"tb_data" => $thisArray,
			"tb_data_name" => array("compatibility_field_list_value.","compatibility_field."), // used to display the table data			 
			"tb_tables" => "compatibility_field_list_value INNER JOIN compatibility_field ON (compatibility_field.fid = compatibility_field_list_value.fvFid)",
			"tb_where" => "WHERE compatibility_field_list_value.fvFid ='".$ThisEdit."'", //WHERE files.album_id = albums.id
			"tb_OrderBy" => "compatibility_field_list_value.fvOrder",
			"tb_OrderWay" =>"ASC",
			"tb_defaultField" => "compatibility_field_list_value.fvCaption", // default search field
			"tb_deletevalue" => "compatibility_field_list_value.id", // default search field
			"tb_edit" => false, // default search field
			"tb_edit_path" => "",//?p=pollresults&id=
			"tb_rowsPerPage" => "10",
			"tb_hideID" => true,
			"tb_defaultValue" => $ThisEdit,
			);
	
		} break;

		case "files": { //SELECT , files.* FROM  WHERE members.id=files.uid AND files.approved='yes' ORDER BY files.id ASC LIMIT 0, 12 

			if(isset($_GET['startvalue']) && $_GET['startvalue'] !="" && $_GET['startvalue'] !="0"){
			
				if(strpos($_GET['startvalue'],"*username") ===false){
				
				if($_GET['startvalue'] =="video"){

				$ThisWhere = "WHERE ( files.type ='video' OR files.type ='youtube' ) ";

				}else{

				$ThisWhere = "WHERE files.type ='".$_GET['startvalue']."'"; 

				}

				}else{
			
				$SearchString = str_replace("*username","",$_GET['startvalue']);
				$ThisWhere = "WHERE members.username ='".$SearchString."'"; 
			
				}

			
			}else{ $ThisWhere=""; }
 
			$GLOBALS['SEARCH_DATA'] = array( //Full Texts  	id 	caption 	forder 	private
			"tb_system" => "files",  
			"tb_captions" => array("ID","File","Type","Username","File Size","Approved","Adult Content","Featured","Default","Date","Views","Title","Description"),
			"tb_data" =>  array("files.id","files.bigimage AS File","files.type","members.username","files.filesize","files.approved","files.adult_content AS Adult","files.featured","files.default","files.date","files.views","files.title","files.description"),
			"tb_data_name" => array("files.","members."), // used to display the table data			 
			"tb_tables" => "files LEFT JOIN members ON ( members.id = files.uid )",
			"tb_where" => $ThisWhere, //WHERE files.album_id = albums.id
			"tb_OrderBy" => "files.approved DESC, files.id",
			"tb_OrderWay" =>"DESC",
			"tb_defaultField" => "files.title", // default search field
			"tb_deletevalue" => "files.id", // default search field
			"tb_edit" => false, // default search field
			"tb_edit_path" => "",//?p=pollresults&id=
			"tb_rowsPerPage" => "10",
			"tb_hideID" => true,
			"tb_defaultValue" => $_GET['startvalue'],
			);
	
		} break;
		case "affiliate": { //SELECT * FROM aff_members 
			$GLOBALS['SEARCH_DATA'] = array( //Full Texts  	id 	caption 	forder 	private
			"tb_system" => "affiliate",  
			"tb_captions" => array("ID","Username","Password","First Name","Last Name","Company","Address","Street","City","State","Zipcode","Country","Telephone","Fax","Email","Website","Payment","Approved","Join Date","Total Clicks","Affiliates Joined"),
			"tb_data" =>  array("aff_members.id","aff_members.username","aff_members.password","aff_members.firstname","aff_members.lastname","aff_members.businessname","aff_members.address","aff_members.street","aff_members.town_city","aff_members.state_county","aff_members.zip_post","aff_members.country","aff_members.telephone","aff_members.fax","aff_members.email","aff_members.website","aff_members.payment_to","aff_members.status","aff_members.joined","aff_members.total_clicks","aff_members.total_registered"),
			"tb_data_name" => array("aff_members."), // used to display the table data			 
			"tb_tables" => "aff_members",
			"tb_where" => "", //WHERE files.album_id = albums.id
			"tb_OrderBy" =>"aff_members.id",
			"tb_OrderWay" =>"ASC",
			"tb_defaultField" => "aff_members.username", // default search field
			"tb_deletevalue" => "aff_members.id", // default search field
			"tb_edit" => false, // default search field
			"tb_edit_path" => "",//?p=pollresults&id=
			"tb_rowsPerPage" => "10",
			"tb_hideID" => false,
			"tb_defaultValue" => 0,
			);
	
		} break;
		case "banned": { //SELECT * FROM members_banned
			$GLOBALS['SEARCH_DATA'] = array( //Full Texts  	id 	caption 	forder 	private
			"tb_system" => "banned",  
			"tb_captions" => array("ID","Username","IP","Date","Hack String Used"),
			"tb_data" =>  array("members_banned.autoid","members_banned.username","members_banned.ip","members_banned.date","members_banned.string"),
			"tb_data_name" => array("members_banned."), // used to display the table data			 
			"tb_tables" => "members_banned",
			"tb_where" => "", //WHERE files.album_id = albums.id
			"tb_OrderBy" =>"members_banned.autoid",
			"tb_OrderWay" =>"ASC",
			"tb_defaultField" => "members_banned.string", // default search field
			"tb_deletevalue" => "members_banned.autoid", // default search field
			"tb_edit" => false, // default search field
			"tb_edit_path" => "",//?p=pollresults&id=
			"tb_rowsPerPage" => "10",
			"tb_hideID" => true,
			"tb_defaultValue" => 0,
			);
	
		} break;
		case "members": { //SELECT * FROM members

			if(isset($_GET['startvalue']) && $_GET['startvalue'] !="" && $_GET['startvalue'] !="0"){ $ThisWhere = "WHERE members_banned.username IS NULL and members.active='".$_GET['startvalue']."'"; }else{ $ThisWhere="WHERE members_banned.username IS NULL"; }

			$GLOBALS['SEARCH_DATA'] = array( //Full Texts  	id 	caption 	forder 	private
			"tb_system" => "members",  
			"tb_captions" => array("ID","Photo","Username","Age","Approved","activate_code","Reg Type","Account Created","Gender","Email","Visible?","Membership","Country","Location","IP","Moderator"),
			"tb_data" =>  array("members.id","files.bigimage AS Photo","members.username", "members_data.age", "members.active", "members.activate_code","members.reg_type", "members.created","members_data.gender", "members.email", "members.visible", "package.name AS Membership", "members_data.country","members_data.location", "members.ip","members.moderator"),
			"tb_data_name" => array("members.","members_data.","members_privacy."), // used to display the table data			 
			"tb_tables" => "members INNER JOIN members_data ON ( members.id = members_data.uid AND members_data.uid != 0 ) LEFT JOIN package ON (members.packageid = package.pid) LEFT JOIN files ON ( members.id = files.uid AND files.type='photo' AND files.default=1 ) LEFT JOIN members_banned ON ( members.username = members_banned.username) ",
			"tb_where" => $ThisWhere, //WHERE files.album_id = albums.id
			"tb_OrderBy" =>"members.created",
			"tb_OrderWay" =>"DESC",
			"tb_defaultField" => "members.username", // default search field
			"tb_deletevalue" => "members.id", // default search field
			"tb_edit" => true, // default search field
			"tb_edit_path" => "members.php?p=edit&id=",//?p=pollresults&id=
			"tb_rowsPerPage" => "10",
			"tb_hideID" => false,
			"tb_defaultValue" => 0,
			);
	
		} break;

		case "members_report": { //SELECT * FROM members

			if(isset($_GET['startvalue']) && $_GET['startvalue'] !="" && $_GET['startvalue'] !="0"){ $ThisWhere = "WHERE members_banned.username IS NULL and members.active='".$_GET['startvalue']."'"; }else{ $ThisWhere="WHERE members_banned.username IS NULL"; }

			$GLOBALS['SEARCH_DATA'] = array( //Full Texts  	id 	caption 	forder 	private
			"tb_system" => "members_report",  
			"tb_captions" => array("ID","Photo","Username","Age","Approved","activate_code","Last Login","Account Created","Gender","Email","Visible?","Membership","Country","Location","IP","Moderator"),
			"tb_data" =>  array("members.id","files.bigimage AS Photo","members.username", "members_data.age", "members.active", "members.activate_code","members.lastlogin", "members.created","members_data.gender", "members.email", "members.visible", "package.name AS Membership", "members_data.country","members_data.location", "members.ip","members.moderator"),
			"tb_data_name" => array("members.","members_data.","members_privacy."), // used to display the table data			 
			"tb_tables" => "members INNER JOIN members_reported ON (members.id = members_reported.to_uid) INNER JOIN members_data ON ( members.id = members_data.uid AND members_data.uid != 0 ) LEFT JOIN package ON (members.packageid = package.pid) LEFT JOIN files ON ( members.id = files.uid AND files.type='photo' AND files.default=1 ) LEFT JOIN members_banned ON ( members.username = members_banned.username) ",
			"tb_where" => $ThisWhere, //WHERE files.album_id = albums.id
			"tb_OrderBy" =>"members.created",
			"tb_OrderWay" =>"DESC",
			"tb_defaultField" => "members.username", // default search field
			"tb_deletevalue" => "members.id", // default search field
			"tb_edit" => true, // default search field
			"tb_edit_path" => "members.php?p=edit&id=",//?p=pollresults&id=
			"tb_rowsPerPage" => "10",
			"tb_hideID" => false,
			"tb_defaultValue" => 0,
			);
	
		} break;
		case "billing": { //SELECT * FROM members_banned
			$GLOBALS['SEARCH_DATA'] = array( //Full Texts  	id 	caption 	forder 	private
			"tb_system" => "billing",  
			"tb_captions" => array("ID","Username","Membership","Date Upgraded", "Date Expires","Payment Method","Still Running","Subscription Payment","Email","Transaction ID"),
			"tb_data" =>  array("members_billing.id","members.username","members_billing.packageid AS Upgraded","members_billing.date_upgrade","members_billing.date_expire","members_billing.pay_method","members_billing.running","members_billing.subscription","members_billing.bill_email","members_billing.transaction_id AS Transaction"),
			"tb_data_name" => array("members.","members_billing."), // used to display the table data			 
			"tb_tables" => "members_billing LEFT JOIN members ON (members_billing.uid = members.id)",
			"tb_where" => "", //WHERE files.album_id = albums.id
			"tb_OrderBy" =>"members_billing.id",
			"tb_OrderWay" =>"ASC",
			"tb_defaultField" => "members.username", // default search field
			"tb_deletevalue" => "members_billing.id", // default search field
			"tb_edit" => true, // default search field
			"tb_edit_path" => "?p=editbill&id=",//?p=pollresults&id=
			"tb_rowsPerPage" => "10",
			"tb_hideID" => true,
			"tb_defaultValue" => 0,
			);
	
		} break;
		case "banners": { //SELECT * FROM members_banned
			$GLOBALS['SEARCH_DATA'] = array( //Full Texts  	id 	caption 	forder 	private
			"tb_system" => "banners",  
			"tb_captions" => array("ID","Name","Click URL","Active", "Clicks","Impressions","Position"),
			"tb_data" =>  array("banners.bid","banners.bName","banners.urllocation","banners.active","banners.clicks","banners.impressions","banners.position"),
			"tb_data_name" => array("banners."), // used to display the table data			 
			"tb_tables" => "banners",
			"tb_where" => "", //WHERE files.album_id = albums.id
			"tb_OrderBy" =>"banners.impressions",
			"tb_OrderWay" =>"ASC",
			"tb_defaultField" => "banners.bName", // default search field
			"tb_deletevalue" => "banners.bid", // default search field
			"tb_edit" => true, // default search field
			"tb_edit_path" => "?p=addbanner&id=",//?p=pollresults&id=
			"tb_rowsPerPage" => "10",
			"tb_hideID" => true,
			"tb_defaultValue" => 0,
			);
	
		} break;
		case "affban": { //SELECT * FROM members_banned
			$GLOBALS['SEARCH_DATA'] = array( //Full Texts  	id 	caption 	forder 	private
			"tb_system" => "affban",  
			"tb_captions" => array("ID","Name","Alt","Link"),
			"tb_data" =>  array("aff_banners.id","aff_banners.image_name","aff_banners.image_alt","aff_banners.image_link"),
			"tb_data_name" => array("aff_banners."), // used to display the table data			 
			"tb_tables" => "aff_banners",
			"tb_where" => "", //WHERE files.album_id = albums.id
			"tb_OrderBy" =>"aff_banners.id",
			"tb_OrderWay" =>"ASC",
			"tb_defaultField" => "aff_banners.filename", // default search field
			"tb_deletevalue" => "aff_banners.id", // default search field
			"tb_edit" => true, // default search field
			"tb_edit_path" => "advertising.php?p=addbanner&id2=",//?p=pollresults&id=
			"tb_rowsPerPage" => "10",
			"tb_hideID" => false,
			"tb_defaultValue" => 0,
			);
	
		} break;
		case "admins": { //SELECT * FROM members_banned
			$GLOBALS['SEARCH_DATA'] = array( //Full Texts  	id 	caption 	forder 	private
			"tb_system" => "admins",  
			"tb_captions" => array("Icon","ID","Username","Password","Email","Last Login","Login Count","IP","Language","Email Alerts","Admin Alerts","Live Approve","Live Delete"),
			"tb_data" =>  array("members_admin.icon","members_admin.id","members_admin.username","members_admin.password","members_admin.email","members_admin.last_login AS lastlogin","members_admin.logincount","members_admin.ip","members_admin.language","members_admin.alerts","members_admin.admin_alerts","members_admin.liveEdit","members_admin.liveDelete"),
			"tb_data_name" => array("members_admin."), // used to display the table data			 
			"tb_tables" => "members_admin INNER JOIN members ON (members_admin.username = members.username AND members.moderator='yes' )",
			"tb_where" => "", //WHERE files.album_id = albums.id
			"tb_OrderBy" =>"members_admin.username",
			"tb_OrderWay" =>"ASC",
			"tb_defaultField" => "members_admin.username", // default search field
			"tb_deletevalue" => "members_admin.id", // default search field
			"tb_edit" => true, // default search field
			"tb_edit_path" => "?p=manage&eid=",//?p=pollresults&id=
			"tb_rowsPerPage" => "10",
			"tb_hideID" => true,
			"tb_defaultValue" => 0,
			);
	
		} break;
		case "email": { //SELECT * FROM members_banned
			$GLOBALS['SEARCH_DATA'] = array( //Full Texts  	id 	caption 	forder 	private
			"tb_system" => "email",  
			"tb_captions" => array("Username","Send Date","Mail ID","Status","Mail Date","Subject"),
			"tb_data" =>  array("members.username","messages.mailtime","messages.mailnum","messages.uid","messages.mailstatus","messages.maildate","messages.mail_subject"),
			"tb_data_name" => array("members.","messages."), // used to display the table data			 
			"tb_tables" => "messages INNER JOIN members ON ( members.id = messages.uid )",
			"tb_where" => "WHERE messages.mail2id='0'", //WHERE files.album_id = albums.id
			"tb_OrderBy" => "members.username",
			"tb_OrderWay" =>"ASC",
			"tb_defaultField" => "members.username", // default search field
			"tb_deletevalue" => "messages.mailnum", // default search field
			"tb_edit" => true, // default search field
			"tb_edit_path" => "?p=admins&p=email_read&id=",//?p=pollresults&id=
			"tb_rowsPerPage" => "10",
			"tb_hideID" => true,
			"tb_defaultValue" => 0,
			);
	
		} break;


		case "auto": { //SELECT * FROM members_banned
			$GLOBALS['SEARCH_DATA'] = array( //Full Texts  	id 	caption 	forder 	private
			"tb_system" => "auto",  
			"tb_captions" => array("ID","Name","Secret Key"),
			"tb_data" =>  array("email_scheduler.send_id","email_scheduler.send_name","email_scheduler.send_key"),
			"tb_data_name" => array("email_scheduler."), // used to display the table data			 
			"tb_tables" => "email_scheduler",
			"tb_where" => "", //WHERE files.album_id = albums.id
			"tb_OrderBy" => "email_scheduler.send_id",
			"tb_OrderWay" =>"DESC",
			"tb_defaultField" => "email_scheduler.send_name", // default search field
			"tb_deletevalue" => "email_scheduler.send_id", // default search field
			"tb_edit" => true, // default search field
			"tb_edit_path" => "?p=auto&id=",//?p=pollresults&id=
			"tb_rowsPerPage" => "10",
			"tb_hideID" => true,
			"tb_defaultValue" => 0,
			);
	
		} break;

	}
}
//////////////////////////////////////////////////////////////////////////////////////////
// MISC SETTINGS
///////////////////////////////////////////////////////////////////////////////////////////
if(!isset($_GET['p'])){ $_GET['p']=""; }
$cant_pop = array('chinese','arabic');
$StartTimer = (float)time()+(float)microtime();
$LoadAdminPlugin =0;

//////////////////////////////////////////////////////////////////////////////////////////
// CHECK LICENSE KEY EVERY 5 MINS
///////////////////////////////////////////////////////////////////////////////////////////
$OnlineCounter=0;
$CurrentTime = @strtotime("now");

if(!isset($_SESSION['keychecker_time'])){
		
	$_SESSION['keychecker_time'] = $CurrentTime;
}

// find the difference between the two times
$TimeDifference = $CurrentTime - $_SESSION['keychecker_time'];
 
if( ($TimeDifference > 300 && isset($_REQUEST['n']) ) ){

	$mycondb = str_replace("newadmin/","",dirname(__FILE__)).'/config_db.php';
	require_once($mycondb);

	$pos = strpos(KEY_ID, "TRIAL_");
	if ($pos === false) {

		// if this is a full version lets check the product key 
		// otherwise log the user out.
			
			$CanContinue = CheckLicense(KEY_ID);	
			if($CanContinue !="ok"){
					ResetConfig();
		
			}

	}else{

		// if this is a trial version lets check the trial keys
		$days = (strtotime($_SESSION['trial_startdate']) - strtotime(date("Y-m-d"))) / (60 * 60 * 24);
		 
		$CanContinue = CheckLicense(KEY_ID);	
		if($days < -10 || !isset($_SESSION['trial_startdate']) || $CanContinue !="ok" ){
			ResetConfig();
		}
	
	}
 	 
	// reset counters
	$_SESSION['keychecker_time']	= $CurrentTime ;
	$_SESSION['keychecker_total'] 	= $OnlineCounter;

}

//////////////////////////////////////////////////////////////////////////////////////////
// CHECK IF THE TRIAL LICENSE HAS EXPIRED
///////////////////////////////////////////////////////////////////////////////////////////
 
?>