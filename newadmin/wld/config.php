<?php
 
//////////////////////////////////////////////////////////////////////////////////////////
// SETUP TABLE VALUES
///////////////////////////////////////////////////////////////////////////////////////////
if(isset($_GET['system'])){
	switch($_GET['system']){
	
		case "approve_sites": {
	
			$GLOBALS['SEARCH_DATA'] = array(
			"tb_system" =>"approve_sites",
			
			"tb_data" => array("ws.wld_site_id","ws.site_url","ws.template", "ws.site_name","wm.market_name","ws.countries AS wld_countries","CONCAT(ws.age_from,'-',ws.age_to) AS age_range","ws.languages","ws.default_language AS lang","ws.approved"),
			"tb_captions" => array("ID","Domain","Template", "Site Name", "Market","Country","Age Range","Language","Default Language","Status"),
			"tb_data_name" => array("ws.","wm."), // used to display the table data			 

			"tb_tables" => "wld_sites ws INNER JOIN wld_markets wm ON ws.market = wm.wld_market_id ",
			"tb_where" => "", //WHERE files.album_id = albums.id
			"tb_OrderBy" => "ws.approved",
			"tb_OrderWay" =>"DESC",
			"tb_defaultField" => "ws.site_url", // default search field
			"tb_deletevalue" => "ws.wld_site_id", // default search field
			"tb_edit" => false, // default search field
			"tb_edit_path" => "?p=caladd&eid=",
			"tb_rowsPerPage" => "10",
			"tb_hideID" => true,
			"tb_defaultValue" => 0,
			);
	
		} break;

		case "customers": {
			

			$condition = "";

			if(isset($_GET['market_id']) && $_GET['market_id'] != '0' && $_GET['market_id'] != ''){
				
				$condition = "WHERE 1 AND ws.market = '".$_GET['market_id']."'";

				if(isset($_GET['site_id']) && $_GET['site_id'] != '0' && $_GET['site_id'] != ''){
				
					$condition .= " AND ws.wld_site_id = '".$_GET['site_id']."'";

				}
			}

			$GLOBALS['SEARCH_DATA'] = array(
			"tb_system" =>"customers",
			
			"tb_data" => array("wu.wld_user_id","wu.username","wu.first_name", "wu.last_name","wu.email","wu.phone","COUNT(ws.wld_site_id) AS sites","wu.phone","wu.phone"),
			"tb_captions" => array("ID","Username","First Name", "Last Name", "Email","Phone","# sites","# affiliates","Balance"),
			"tb_data_name" => array("wu.","ws."), // used to display the table data			 

			"tb_tables" => "wld_users wu LEFT JOIN wld_sites ws ON wu.wld_user_id = ws.wld_user_id ",
			"tb_where" => "$condition", //WHERE files.album_id = albums.id
			"tb_OrderBy" => "wu.wld_user_id",
			"tb_OrderWay" =>"DESC",
			"tb_Groupby" =>" GROUP BY wu.wld_user_id",
			"tb_defaultField" => "wu.username", // default search field
			"tb_deletevalue" => "wu.wld_user_id", // default search field
			"tb_edit" => true, // default search field
			"tb_edit_path" => "?p=customers&eedit_id=",
			"tb_rowsPerPage" => "10",
			"tb_hideID" => true,
			"tb_defaultValue" => 0,
			);
	
		} break;

		case "approve_edit_pages": {
			

			$condition = "";

			if(isset($_GET['site_id']) && $_GET['site_id'] != '0' && $_GET['site_id'] != ''){
				
				$condition .= " WHERE template_pages.site_id = '".$_GET['site_id']."'";

			}

			$GLOBALS['SEARCH_DATA'] = array(
			"tb_system" =>"approve_edit_pages",
			
			"tb_data" => array("template_pages.id AS id","name", "template_pages.site_id AS site_url_id", "template_pages.content","CONCAT(template_pages.site_id,'###',template_pages.name) AS page_url","template_pages.approved"),
			"tb_captions" => array("ID","Page Name","Domain Name", "Contents", "URL", "Status"),
			"tb_data_name" => array("template_pages."), // used to display the table data			 

			"tb_tables" => "template_pages",
			"tb_where" => "$condition", //WHERE files.album_id = albums.id
			"tb_OrderBy" => "template_pages.id",
			"tb_OrderWay" =>"DESC",
			"tb_Groupby" =>" GROUP BY template_pages.id",
			"tb_defaultField" => "template_pages.name", // default search field
			"tb_deletevalue" => "template_pages.id", // default search field
			"tb_edit" => true, // default search field
			"tb_edit_path" => "?p=approve_edits&sp=edit_page&market_id=".$_GET['market_id']."&edit_id=",
			"tb_rowsPerPage" => "10",
			"tb_hideID" => true,
			"tb_defaultValue" => 0,
			);
	
		} break;

		case "approve_edit_banners": {
			

			$condition = "";

				
			$condition = "WHERE banners.approved = 'no'";

			if(isset($_GET['site_id']) && $_GET['site_id'] != '0' && $_GET['site_id'] != ''){
				
				$condition .= " AND banners.site_id = '".$_GET['site_id']."'";

			}

			$GLOBALS['SEARCH_DATA'] = array( //Full Texts  	id 	caption 	forder 	private
			"tb_system" => "banners",  
			"tb_captions" => array("ID","Name","Code","Click URL","Active","Approved", "Clicks","Impressions","Position"),
			"tb_data" =>  array("banners.bid","banners.bName","banners.code","banners.urllocation","banners.active","banners.approved","banners.clicks","banners.impressions","banners.position"),
			"tb_data_name" => array("banners."), // used to display the table data			 
			"tb_tables" => "banners",
			"tb_where" => $condition, //WHERE files.album_id = albums.id
			"tb_OrderBy" =>"banners.impressions",
			"tb_OrderWay" =>"ASC",
			"tb_defaultField" => "banners.bName", // default search field
			"tb_deletevalue" => "banners.bid", // default search field
			"tb_edit" => true, // default search field
			"tb_edit_path" => "?p=approve_edits&sp=banners&market_id=".$_GET['market_id']."&banner_id=",//?p=pollresults&id=
			"tb_rowsPerPage" => "10",
			"tb_hideID" => true,
			"tb_defaultValue" => 0,
			);
	
		} break;

		case "approve_edit_metatags": {
			

			$condition = " WHERE wld_metatags.approved = 'no'";

			if(isset($_GET['market_id']) && $_GET['market_id'] != '0' && $_GET['market_id'] != ''){
				
				$condition = " AND wld_sites.market = '".$_GET['market_id']."'";

				if(isset($_GET['site_id']) && $_GET['site_id'] != '0' && $_GET['site_id'] != ''){
				
					$condition .= " AND wld_sites.wld_site_id = '".$_GET['site_id']."'";

				}
			}

			$GLOBALS['SEARCH_DATA'] = array(
			"tb_system" =>"approve_edit_metatags",
			
			"tb_data" => array("wld_metatags.site_id","wld_sites.site_url","wld_metatags.custom_title_prefix","wld_metatags.description_prefix", "wld_metatags.keyword_prefix","wld_metatags.page_title","wld_metatags.description","wld_metatags.keywords","wld_metatags.approved"),
			"tb_captions" => array("ID","Site URL","Custom Title Prefix", "Description Prefix", "Keyword Prefix", "Page Title", "Description", "Keywords", "Approved"),
			"tb_data_name" => array("wld_metatags.","wld_sites."), // used to display the table data			 

			"tb_tables" => "wld_metatags INNER JOIN wld_sites ON wld_metatags.site_id = wld_sites.wld_site_id ",
			"tb_where" => "$condition", //WHERE files.album_id = albums.id
			"tb_OrderBy" => "wld_metatags.site_id",
			"tb_OrderWay" =>"DESC",
			"tb_Groupby" =>" GROUP BY wld_metatags.id",
			"tb_defaultField" => "wld_sites.site_url", // default search field
			"tb_deletevalue" => "wld_metatags.site_id", // default search field
			"tb_edit" => true, // default search field
			"tb_edit_path" => "?p=approve_edits&sp=metatags&edit_id=",
			"tb_rowsPerPage" => "10",
			"tb_hideID" => true,
			"tb_defaultValue" => 0,
			);
	
		} break;

		case "approve_edit_text": {
			

			$condition = " WHERE wld_home_page_text.approved = 'no'";

			if(isset($_GET['market_id']) && $_GET['market_id'] != '0' && $_GET['market_id'] != ''){
				
				$condition = " AND wld_sites.market = '".$_GET['market_id']."'";

				if(isset($_GET['site_id']) && $_GET['site_id'] != '0' && $_GET['site_id'] != ''){
				
					$condition .= " AND wld_sites.wld_site_id = '".$_GET['site_id']."'";

				}
			}

			$GLOBALS['SEARCH_DATA'] = array(
			"tb_system" =>"approve_edit_metatags",
			
			"tb_data" => array("wld_home_page_text.site_id",
				"wld_sites.site_url",
				"wld_home_page_text.welcome_title",
				"wld_home_page_text.welcome_subtitle",
				"wld_home_page_text.intro_title",
				"wld_home_page_text.intro_subtitle",
				"wld_home_page_text.intro_title_extra",
				"wld_home_page_text.intro_subtitle_extra",
				"wld_home_page_text.approved"),

			"tb_captions" => array("ID","Site URL","Welcome Title", "Welcome Subtitle", "Intro Title", "Intro Subtitle", "Intro Title Extra", "Intro Subtitle Extra", "Approved"),
			"tb_data_name" => array("wld_home_page_text.","wld_sites."), // used to display the table data			 

			"tb_tables" => "wld_home_page_text INNER JOIN wld_sites ON wld_home_page_text.site_id = wld_sites.wld_site_id ",
			"tb_where" => "$condition", //WHERE files.album_id = albums.id
			"tb_OrderBy" => "wld_home_page_text.site_id",
			"tb_OrderWay" =>"DESC",
			"tb_Groupby" =>" GROUP BY wld_home_page_text.id",
			"tb_defaultField" => "wld_sites.site_url", // default search field
			"tb_deletevalue" => "wld_home_page_text.site_id", // default search field
			"tb_edit" => true, // default search field
			"tb_edit_path" => "?p=approve_edits&sp=text&edit_id=",
			"tb_rowsPerPage" => "10",
			"tb_hideID" => true,
			"tb_defaultValue" => 0,
			);
	
		} break;

		case "approve_media": { 

			$condition = "";

			if(isset($_GET['market_id']) && $_GET['market_id'] != '0' && $_GET['market_id'] != ''){
				
				if(isset($_GET['site_id']) && $_GET['site_id'] != '0' && $_GET['site_id'] != ''){
				
					$condition = " AND members.site_id = '".$_GET['site_id']."'";

				}
			}

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
			
			}else{ $ThisWhere="WHERE 1 "; }
 	
 			$ThisWhere .= $condition;

			$GLOBALS['SEARCH_DATA'] = array( //Full Texts  	id 	caption 	forder 	private
			"tb_system" => "approve_media",  
			"tb_captions" => array("ID","File","Type","Username","File Size","Approved","Adult Content","Featured","Default","Date","Views","Title","Description"),
			"tb_data" =>  array("files.id","files.bigimage AS File","files.type","members.username","files.filesize","files.approved","files.adult_content AS Adult","files.featured","files.default","files.date","files.views","files.title","files.description AS description_media","members.id AS member_id"),
			"tb_data_name" => array("files.","members."), // used to display the table data			 
			"tb_tables" => "files LEFT JOIN members ON ( members.id = files.uid )",
			"tb_where" => $ThisWhere, //WHERE files.album_id = albums.id
			"tb_OrderBy" => "files.id",
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

		case "members": { //SELECT * FROM members

			if(isset($_GET['startvalue']) && $_GET['startvalue'] !="" && $_GET['startvalue'] !="0"){ $ThisWhere = "WHERE members.is_deleted = 'no' AND members_banned.username IS NULL AND members.active='".$_GET['startvalue']."'"; }else{ $ThisWhere="WHERE members.is_deleted = 'no' AND members_banned.username IS NULL"; }
			if(isset($_GET['site_id']) && $_GET['site_id'] !="0"){

				$ThisWhere.=" AND members.site_id='".$_GET['site_id']."'";

			}
			$GLOBALS['SEARCH_DATA'] = array( //Full Texts  	id 	caption 	forder 	private
			"tb_system" => "members",  
			"tb_captions" => array("ID","Photo","Username","Age","Approved","activate_code","Last Login","Account Created","Gender","Email","Visible?","Membership","Country","Location","IP","Moderator"),
			"tb_data" =>  array("members.id","CONCAT(files.bigimage,'###',members.site_id) AS Photo","members.username", "members_data.age", "members.active", "members.activate_code","members.lastlogin", "members.created","members_data.gender", "members.email", "members.visible", "package.name AS Membership", "members_data.country","members_data.location", "members.ip","members.moderator"),
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
		case "manage_field_groups": { //SELECT * FROM field_groups ORDER BY forder ASC
	
			$GLOBALS['SEARCH_DATA'] = array( //Full Texts  	id 	caption 	forder 	private
			"tb_system" => "fieldgroups",  
			"tb_captions" => array("ID","Name","Order"),
			"tb_data" => array("field_groups.id","field_groups.caption","field_groups.forder"),
			"tb_data_name" => array("field_groups."), // used to display the table data			 
			"tb_tables" => "field_groups",
			"tb_where" => "", //WHERE files.album_id = albums.id
			"tb_OrderBy" => "field_groups.id",
			"tb_OrderWay" =>"ASC",
			"tb_defaultField" => "field_groups.caption", // default search field
			"tb_deletevalue" => "field_groups.id", // default search field
			"tb_edit" => true, // default search field
			"tb_edit_path" => "?p=management&sp=manage_add_groups&market_id=".$_GET['market_id']."&e=",//?p=pollresults&id=
			"tb_rowsPerPage" => "10",
			"tb_hideID" => true,
			"tb_defaultValue" => 0,
			);
	
		} break;
		case "payments": { //SELECT * FROM members_banned
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
			"tb_edit_path" => "?p=payments&sp=editbill&market_id=".$_GET['market_id']."&id=",//?p=pollresults&id=
			"tb_rowsPerPage" => "10",
			"tb_hideID" => true,
			"tb_defaultValue" => 0,
			);
	
		} break;
		case "banners": { //SELECT * FROM members_banned

			if(isset($_GET['site_id']) && $_GET['site_id'] != ""){
				$condition = " WHERE banners.site_id = '".$_GET['site_id']."'";
			}
			$GLOBALS['SEARCH_DATA'] = array( //Full Texts  	id 	caption 	forder 	private
			"tb_system" => "banners",  
			"tb_captions" => array("ID","Name","Click URL","Active", "Clicks","Impressions","Position"),
			"tb_data" =>  array("banners.bid","banners.bName","banners.urllocation","banners.active","banners.clicks","banners.impressions","banners.position"),
			"tb_data_name" => array("banners."), // used to display the table data			 
			"tb_tables" => "banners",
			"tb_where" => $condition, //WHERE files.album_id = albums.id
			"tb_OrderBy" =>"banners.impressions",
			"tb_OrderWay" =>"ASC",
			"tb_defaultField" => "banners.bName", // default search field
			"tb_deletevalue" => "banners.bid", // default search field
			"tb_edit" => true, // default search field
			"tb_edit_path" => "wld.php?dll=wld&sp=ads&view=addbanner&id=",//?p=pollresults&id=
			"tb_rowsPerPage" => "10",
			"tb_hideID" => true,
			"tb_defaultValue" => 0,
			);
	
		} break;
	}
}

 
?>