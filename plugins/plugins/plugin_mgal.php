<?php
/**
 * api: iCupid Dating Software
 * title: iCupid Basic Member Gallery (MGAL)
 * description: This add-on will display a basic member gallery for your members. The menu link will be www.yourwebsite.com/index.php?dll=mgal
 * type: functions
 * category: Member Photo Gallery
 * author: AdvanDate, LLC
 * url: http://www.advandate.com
 * license: iCupid 11.3
 * config:
 * provides: iCupid
 * hooks: sidebar
 * version: 9.0
 * sort: 10
 * updated: May 4th 2016
 * 
 * This plugin will display a basic member gallery
 */
 	
	/*
		TELL THE SCRIPT TO USE
		OUR CUSTOM PLUGIN PAGES
	*/
	$LOAD_PLUGIN_OPTIONS = true;
	
 
	$PLUGINS_PAGES = array("mgal","import");
	
	switch($page){
	
		case "mgal": {			

			/*
				LOADS MAIN PAGE IF NOT INNER PAGES ARE SELECTED
			*/
			$PLUGINS_PAGE_TYPE = "link"; // link or html
			$PLUGINS_PAGE_LINK = "plugins/plugins/plugin_mgal/mgal.php";
			
		} break;
		
	
	} // END SWITCH PAGE CALL


?>