<?php 

function GetProfiles($pageGET, $This_Page, $getData=""){
    

	global $DB;
	$RunExtra="";
	$RunExtra1="";
	$RunString="";
	$c=1;
	$count=1;
	$loopcount=1;
	$listFavs="";
	$DisplayType =2; // DEFAULT DISPLAY VIEW
	$SHOW_ONLY_NETWORK =0; $NETWORK_ID=2; $NETWORK_SHOW_SQL=""; $MODdata['page'] ='profile';  $MODdata['sub'] ='overview'; $MODdata['type'] ='system';
        $searchFromMiles=FALSE;
        $searchFromLocation=FALSE;


	///////////////////////MATCH OPTIONS //////////////////////////////

	if($_SESSION['auth'] =="yes" && isset($pageGET['Extra']['match']) && $pageGET['Extra']['match']==1){

		$MData = $DB->Row("SELECT match_array FROM members_privacy WHERE uid= ( '".$_SESSION['uid']."' ) LIMIT 1");	

		$get_myarray = unserialize($MData['match_array']);

		if(is_array($get_myarray)){

			foreach($get_myarray as $Match){

				if(strlen($Match['value']) > 0 && $Match['value'] !='0'){

					// BUILD AGE STRING
					if($Match['name']=="country"){

						$RunExtra .= " ( ".$Match['name']." = '".$Match['value']."' OR ".$Match['name']." = '".MakeCountry($Match['value'])."' ) AND ";

					}elseif($Match['name']=="age"){
						$ageSlipt = explode("-",$Match['value']);							

						$RunExtra .= " members_data.age BETWEEN '".GetAgeYear(trim($ageSlipt[1]))."-00-00' AND '".GetAgeYear(trim($ageSlipt[0]))."-".date("m")."-".date("d")."' AND ";

					}
					else if($Match['type'] == '5'){
						$CeKExtra = "";
						
						$lsData = explode("**", $Match['value']);

						for($ix=0; $ix < count($lsData); $ix++)
						{
							if($lsData[$ix] == "1")
							{
								if($ix == 0)
									$startFrom = 1;
								else
									$startFrom = $ix * 3 +1;

								$CeKExtra .= " SUBSTRING(members_data." . $Match['name'] .",".$startFrom.",3) = '".$lsData[$ix]."**' OR ";
							}
						}
						if(!empty($CeKExtra))
						{
							$RunExtra .= " (".substr(trim($CeKExtra), 0, strlen(trim($CeKExtra))-2).") AND ";
						}
					}else{

						$RunExtra .= "   ".$Match['name']." = '".$Match['value']."' AND ";

					}

				}

			}
		}

	}  

	///////////////////////////////////////////////////////////////////////	

	////////////////////// MAKE FAVOURITE ARRAY LIST //////////////////////

	if($_SESSION['auth'] =="yes" && isset($pageGET['Extra']['favorite']) && $pageGET['Extra']['favorite']==1){
			
		$listFavs="AND ( members.id = '-10' ";

		$result55 = $DB->Query("SELECT members_network.to_uid FROM members_network LEFT JOIN members ON ( members.id = members_network.to_uid ) LEFT JOIN files ON ( files.uid = members.id ) WHERE members_network.uid='".$_SESSION['uid']."' AND members_network.type='20' ORDER BY members_network.id DESC");

		while( $row5 = $DB->NextRow($result55)){		

			$listFavs .="  || members.id ='".$row5['to_uid']."'";				

		}

		/// END 

		$listFavs.=")";

	}	

	#######################################################################

	$GLOBALS['LANG_SEARCH_INNER']['65'] = (isset($GLOBALS['LANG_SEARCH_INNER']['65'])) ? $GLOBALS['LANG_SEARCH_INNER']['65'] : "";
	if(D_ZIPCODES ==1 && isset($pageGET['zipcode_value']) && strlen($pageGET['zipcode_value']) > 2 && $pageGET['zipcode_value'] != $GLOBALS['LANG_SEARCH_INNER']['65']){  

		require_once "inc/classes/class_zipcodes.php";

		$zipcode_data = new member_zipcodes;
		
		$zip_value =		eMeetingInput($pageGET['zipcode_value']);

		$zip_distance =		eMeetingInput($pageGET['postcode_distance']);


		/* RADIUS SEARCH WITHIN XX MILES OF XX ZIP CODE */

		$RunExtra .= " ( members_data.postcode LIKE '%$zip_value%' OR ";

		$zips = $zipcode_data->get_zips_in_range($zip_value, $zip_distance);

		if (!empty($zips)){

			foreach ($zips as $key => $value) {

				

				//$RunExtra .= " members_data.postcode='".$key."' OR";

		   }

		}

		$RunExtra .= " members_data.postcode='99999999' ) AND ";

		$RunString .=", members_data.postcode";

	}

	#######################################################################			

	################## POSTAL CODE DATABASE (UK ONLY)  ####################

	if(D_POSTCODES == 1 && isset($pageGET['postcode_value']) &&  strlen($pageGET['postcode_value']) > 2) {

		$postcode_value 	=	eMeetingInput($pageGET['postcode_value']);		
		$postcode_distance 	=	eMeetingInput($pageGET['uk_postcode_distance']);


		$postcode_distance 	=	$postcode_distance *1000;


		if(!is_numeric($postcode_distance)){ $postcode_distance=50; }

		/* RADIUS SEARCH WITHIN XX MILES OF XX postcode */

		$str = strtoupper($postcode_value);	$pos = strpos($str,' ');


		if(strlen($str)>3){
			if($pos){
				$str =substr($str,0,strpos($str,' '));
			}
		}
		
		 $co= $DB->Row("SELECT latitude, longitude FROM postcodescoords WHERE postcode LIKE '$str%' LIMIT 0,1");

		//if(!empty($co)){


			$RunExtra .= " ( members_data.postcode LIKE '%$postcode_value%' OR ";

			//  $codequery = $DB->Query("SELECT * , 6371.04 * acos( cos( pi( ) /2 - radians( 90 - `latitude` ) ) * cos( pi( ) /2 - radians( 90 - ".$latitude.") ) * cos( radians(`longitude` ) - radians( ".$longitude.") ) + sin( pi( ) /2 - radians( 90 - `latitude` ) ) * sin( pi( ) /2 - radians( 90 - ".$latitude.") ) ) AS `dist` FROM `postcodescoords`GROUP BY `postcode` HAVING `dist`<$postcode_distance ORDER BY `dist` ");


			$codequery = $DB->Query("SELECT dest.postcode, dest.easting, dest.northing 
			FROM postcodescoords AS source, postcodescoords AS dest 
			WHERE source.postcode ='$str' 
			AND ((dest.easting < (source.easting + $postcode_distance) 
			AND dest.easting > (source.easting - $postcode_distance)) 
			AND (dest.northing < (source.northing + $postcode_distance) 
			AND dest.northing > (source.northing - $postcode_distance))) 
			ORDER BY dest.postcode ASC");
			//print_r($codequery);
			



			while( $coRow = $DB->NextRow($codequery) )
			{
				 $RunExtra .= " members_data.postcode LIKE '".$coRow['postcode']."%' OR";
			}


			$RunExtra .= " members_data.postcode='99999999' ) AND members_data.country = '385' AND ";


			$RunString .=", members_data.postcode";


		//}
		/*else{

			echo "not data";
			die;

		}*/

	}

	#######################################################################			

	###################### BUILD SEARCH QUERY STRING  #####################
	 $BuiltArray = "";
	 $addExtra = false;

	 if(isset($pageGET['SeN'])){

	 
		$TotalArray = count($pageGET['SeN'])+1;

		for($i = 1; $i < $TotalArray; $i++) { 

			if(isset($pageGET['SeV'][$i])){

				if(  isset($pageGET['SeV'][$i]) && (is_numeric($pageGET['SeV'][$i]) && $pageGET['SeV'][$i] !=0) || ( strlen($pageGET['SeV'][$i]) > 1 ) ){

					if($pageGET['SeT'][$i] ==1 || $pageGET['SeT'][$i] ==2){
                                            
                                            if($pageGET['SeN'][$i]!="milesfrom" && $pageGET['SeN'][$i]!="location")
                                            {
                                                $RunExtra .= " members_data.".eMeetingInput($pageGET['SeN'][$i]) ." LIKE '%".eMeetingInput($pageGET['SeV'][$i])."%' AND ";
                                            }

					}
					else if($pageGET['SeT'][$i] ==3 ){ // listbox

						if($pageGET['SeN'][$i]=="country"){

							$RunExtra .= " ( members_data.".eMeetingInput($pageGET['SeN'][$i]) ."='".eMeetingInput($pageGET['SeV'][$i])."' OR members_data.".eMeetingInput($pageGET['SeN'][$i]) ."='".MakeCountry(eMeetingInput($pageGET['SeV'][$i]))."' ) AND ";

						}else{

							$RunExtra .= " members_data.".eMeetingInput($pageGET['SeN'][$i]) ."='".eMeetingInput($pageGET['SeV'][$i])."' AND ";	

						}

					}elseif($pageGET['SeT'][$i] ==4){ // checkbox

					   if($pageGET['SeV'][$i] == ""){$pageGET['SeV'][$i] =0; }
					   $RunExtra .= " members_data.".eMeetingInput($pageGET['SeN'][$i]) ."='".eMeetingInput($pageGET['SeV'][$i])."' AND";									
					
					}
                                         if($pageGET['SeN'][$i]!="milesfrom" && $pageGET['SeN'][$i]!="location")
                                            {

					$RunString .= ", members_data.".eMeetingInput($pageGET['SeN'][$i]);	
                                            }
                                            else
                                            {   if($pageGET['SeN'][$i] == "milesfrom")  
                                                {
                                                if($pageGET['SeV'][$i]!="")
                                                    {
                                                          $searchFromMiles=TRUE;
                                                          $miles=$pageGET['SeV'][$i];
                                                    }
                                                }
                                                else if($pageGET['SeN'][$i] == "location")  
                                                     {
                                                      if($pageGET['SeV'][$i]!="")
                                                        { 
                                                               $location=$pageGET['SeV'][$i];
                                                                $searchFromLocation=TRUE;
                                                        }
                                                
                                                     }
                                                
                                              
                                            }
                                            
			 	}
			}
			
		}
		
	}

	if(isset($pageGET['CeK'])){

		for($i = 0; $i < $pageGET['TotalNumberOfRows']+2; $i++) { 

			if(isset($pageGET['CeK'][$i])) //multiple choices
			{ 

				if($pageGET['SeT'][$i] ==5) { // multiple choices - checkbox
				
					$bitArray = array();
					$bitArrayC = 0;
					$x = 0;
					$fieldId = $pageGET['CeK'][$i];

					for($c = 0; $c < 100; $c++) {

						// MAKE SAVE
						if(isset($pageGET['FieldMulti'.$x.$fieldId]))
						{								
							if(isset($pageGET['Multi'.$x.$fieldId]))
							{
								$BuiltArray .="1**";
								$bitArray[$bitArrayC] = "1**";
								$addExtra = true;
							}else{
								$BuiltArray .="0**";
								$bitArray[$bitArrayC] = "0**";
							}
							$bitArrayC++;
						}
						$x++;  
					}			
					if($addExtra) {

						$CeKExtra = "";
						for($ix=0; $ix < count($bitArray); $ix++){

							if($bitArray[$ix] == "1**") {
								if($ix == 0)
									$startFrom = 1;
								else
									$startFrom = $ix * 3 +1;

								$CeKExtra .= " SUBSTRING(members_data." . eMeetingInput($pageGET['FieldName'.$fieldId]) .",".$startFrom.",3) = '".$bitArray[$ix]."' OR ";
							}
						}
						if(!empty($CeKExtra))
						{
							$RunExtra .= "(".substr(trim($CeKExtra), 0, strlen(trim($CeKExtr))-2).") AND ";
						}

					}

					//reset variables
					$BuiltArray = "";
					$CeKExtra = "";
					$bitArray = array();
					$addExtra = false;

			  	}
			}
		}
	}

	#######################################################################

	####################### BUILD EXTRA QUERY STRING  #####################
	
	#######################################################################			


	// SHOW ONLY NETWORK FRIENDS

	if( ( isset($pageGET['friendid']) && is_numeric($pageGET['friendid']) )  || ( isset($getData['friendid']) && is_numeric($getData['friendid']) )  ){


		$NETWORKD_FRIEND_ID    = (isset($pageGET['friendid']))	?	$pageGET['friendid']	: $getData['friendid'];


		$SHOW_ONLY_NETWORK =1;

		$NETWORK_SHOW_SQL ='members_network.approved AS networkApprove, members_network.uid AS networkUID, members_network.to_uid AS networkTOUID, ';



		## find the network type

		if( ( isset($pageGET['friend_type']) && is_numeric($pageGET['friend_type']) )  || ( isset($getData['friend_type']) && is_numeric($getData['friend_type']) )  ){

			$NETWORK_ID    = (isset($pageGET['friend_type']))	?	$pageGET['friend_type']	: $getData['friend_type'];

		}

	}

	

	## ADMIN APPROVAL SYSTEM, SHOW ALL ADVERT TYPES EVENT IF THEY ARE NOT APPROVED

	if( isset($_SESSION['site_moderator_approve']) && $_SESSION['site_moderator_approve']=="yes" ){

		$RunExtra1 .="";

	}else{


		if( D_GENDERMATCHING ==1 && $SHOW_ONLY_NETWORK !=1  ){ $RunExtra1 .="members_data.gender != '".$_SESSION['genderid']."' AND"; }

			$RunExtra1 .=" members.active ='active' AND activate_code='OK' AND";

	}
        


	// make default search not display my gender type

	//if(empty($pageGET) && $_SESSION['auth'] =="yes"){ 

		//$RunExtra1 .= " members_data.gender !=('".$_SESSION['genderid']."') AND ";

  	//}



	// build extra strings

	if(isset($pageGET['Extra']['pics']) && $pageGET['Extra']['pics']==1){

		$RunExtra1 .= " members.id = files.uid AND "; 

	}	

	// build extra strings

	if( ( isset($pageGET['Extra']['online']) && $pageGET['Extra']['online']==1 ) || ( isset($getData['online']) && $getData['online']== 1 ) ){

		$RunExtra1 .= " members.id = members_online.logid AND ";

	}

	// build extra strings

	//if(isset($pageGET['Extra']['keyword']) && strlen($pageGET['Extra']['keyword']) > 1 && $pageGET['Extra']['keyword'] !=$GLOBALS['LANG_SEARCH_INNER']['62']){
	if(isset($pageGET['Extra']['keyword']) && strlen($pageGET['Extra']['keyword']) > 1){

		$listFavs .=" AND (";

		if(isset($pageGET['Extra']['keyword_username']) && $pageGET['Extra']['keyword_username']==1){

			$listFavs .=" members.username LIKE ( '%".eMeetingInput($pageGET['Extra']['keyword'])."%' ) OR";

		}

		if(isset($pageGET['Extra']['keyword_headline']) && $pageGET['Extra']['keyword_headline']==1){

			$listFavs .=" members_data.headline LIKE ( '%".eMeetingInput($pageGET['Extra']['keyword'])."%' ) OR";

		}

		if(isset($pageGET['Extra']['keyword_description']) && $pageGET['Extra']['keyword_description']==1){

			$listFavs .=" members_data.description LIKE ( '%".eMeetingInput($pageGET['Extra']['keyword'])."%' ) OR";

		}


 		$listFavs .=" members.username LIKE ( '%".eMeetingInput($pageGET['Extra']['keyword'])."%' ) )   ";	

		## add tag for tag cloud

		//AddTag("search", $pageGET['Extra']['keyword']);

	}

	// build extra strings

	if(isset($pageGET['Extra']['birthday']) && $pageGET['Extra']['birthday']==1){

		$agemd = date('M-d'); 	
		$RunExtra1 .= " members_data.age LIKE '%$agemd%' AND "; 	
	}

	// unapproved members

	if(isset($pageGET['Extra']['unapproved']) && $pageGET['Extra']['unapproved']==1){

		$RunExtra1 .= " members.active !='active' AND "; 	

	}

	// build extra strings

	if(isset($pageGET['Extra']['period']) && is_numeric($pageGET['Extra']['period']) && $pageGET['Extra']['period'] > 1){

		$RunExtra1 .= " TO_DAYS( ".date("Y-m-d") .")  - TO_DAYS( members.created )  < ".$pageGET['Extra']['period']." AND "; 	

	}

	// build extra strings

	if(isset($pageGET['Extra']['livevideo']) && $pageGET['Extra']['livevideo']==1){

		$RunExtra1 .= " members.video_duration > 0 AND "; 	

	}

	// build extra strings

	if(isset($pageGET['Extra']['highlighted']) && $pageGET['Extra']['highlighted']==1){

		$RunExtra1 .= " members.highlight='on' AND "; 	

	}

	// build extra strings

	if(isset($pageGET['Extra']['newtoday']) && $pageGET['Extra']['newtoday']==1){

		$RunExtra1 .= " TO_DAYS( ".date("Y-m-d") .")  - TO_DAYS( members.created )  < 2 AND "; 	

	}

	// build extra strings

	if(isset($pageGET['Extra']['featured']) && $pageGET['Extra']['featured']==1){

		$RunExtra1 .= " files.featured='yes' AND "; 	

	}	

	// build extra strings

	if(isset($pageGET['Extra']['Username']) && strlen($pageGET['Extra']['Username']) > 1 && $pageGET['Extra']['Username'] !=$GLOBALS['LANG_SEARCH_INNER']['63']){

		$RunExtra1 .= " members.username LIKE ( '%".eMeetingInput($pageGET['Extra']['Username'])."%' ) AND "; 	

	}

	// BUILDING SORT STRING

	////////////////////////////////////////////////////////

	if(isset($pageGET['Extra']['sort'])){

		switch(trim($pageGET['Extra']['sort'])){

			case "1": {

				$OrderByThis = "members.lastlogin DESC";

			}break;

			case "2": {	// SORT BY MEMBER PHOTOS

				$OrderByThis = "files.date DESC";

				$RunExtra1 .= " members.id = files.uid AND files.bigimage !='' AND"; 				

			}break;

			case "3": {	// MOST POPULAR

				$OrderByThis = "members.hits DESC";

			}break;

			case "4": {	// LAST UPDATED

				$OrderByThis = "members.updated DESC";

			}break;

			case "5": {	// SORT BY MEMBER NAME

				$OrderByThis = "members.username ASC";

			}break;

			case "6": {	// GENDER

				$OrderByThis = "members_data.gender DESC";

			}break;

			case "7": {	// AGE

				$OrderByThis = "members_data.age DESC";			

			}break;

			case "8": {	// SORT BY NEW MEMBERS FIRST

				$OrderByThis = "members.packageid DESC";

			}break;	

			default: {  $OrderByThis = "members.lastlogin DESC"; }
		
		}

	}else{

		 $OrderByThis = "members.lastlogin DESC"; 

	}

	// build extra strings

	if(isset($pageGET['Extra']['view']) && $pageGET['Extra']['view'] != "" ){ // CHANGE LAYOUT VIEW

		$DisplayType	=	$pageGET['Extra']['view'];

		if($DisplayType ==2){

			$stoplimit=6;

		}else{

			$stoplimit=SEARCH_PAGE_ROWS;

		}

	}else{

		$stoplimit=SEARCH_PAGE_ROWS;

	}

	// build age string
	if(isset($pageGET['Extra']['age1']) && is_numeric($pageGET['Extra']['age1']) && isset($pageGET['Extra']['age2']) && $pageGET['Extra']['age2'] !='0' ){

		//die($pageGET['Extra']['age1']."--".$pageGET['Extra']['age2']);

		if($pageGET['Extra']['age1'] > $pageGET['Extra']['age2']){

			$AgeFinder1 = $pageGET['Extra']['age2'];

			$AgeFinder2 = $pageGET['Extra']['age1'];

			$pageGET['Extra']['age1'] = $AgeFinder1;

			$pageGET['Extra']['age2'] = $AgeFinder2;			

		}

		$RunExtra .= " members_data.age BETWEEN '".GetAgeYear(eMeetingInput($pageGET['Extra']['age2']))."-AAA-01' AND '".GetAgeYear(eMeetingInput($pageGET['Extra']['age1']))."-ZZZ-31'  AND ";
	}

	///////////////// GALLERY VIEW PHOTOS ONLY

	if(!isset($This_Page)){$This_Page=1; }

	$startlimit = $stoplimit*($This_Page-1);

	if($startlimit <0) $startlimit =0;

	#######################################################################			

	###################### BUILD FINISHED QUERY  ##########################

	//$QueryTotal = "SELECT if(count(DISTINCT ";
	$QueryTotal = "SELECT count(DISTINCT ";
	

	if(isset($pageGET['Extra']['online']) && $pageGET['Extra']['online']==1 || ( isset($getData['online']) && $getData['online']== 1 ) ){

		$QueryTotal .= "members_online.logid";

	}else{

		$QueryTotal .= "members.id";

	}

	$QueryTotal .= ")";

	/*$QueryTotal .= ") <= 100000 , count(DISTINCT ";
	
	if(isset($pageGET['Extra']['online']) && $pageGET['Extra']['online']==1 || ( isset($getData['online']) && $getData['online']== 1 ) ){

		$QueryTotal .= "members_online.logid";

	}else{

		$QueryTotal .= "members.id";

	}
	
	$QueryTotal .= "), '100000') AS total FROM members INNER JOIN members_data ON (  $RunExtra members.id = members_data.uid ";*/
	$QueryTotal .= " AS total FROM members INNER JOIN members_data ON (  $RunExtra members.id = members_data.uid ";

	if(isset($pageGET['Extra']['birthday']) && $pageGET['Extra']['birthday'] ==1){

		$agemd = date('M-d'); 		
		$QueryTotal .=" AND members_data.age LIKE '%$agemd%' ";

	}


	if( D_GENDERMATCHING ==1 && $SHOW_ONLY_NETWORK !=1 ){ $QueryTotal .= " AND members_data.gender != '".$_SESSION['genderid']."' "; }



	//if(isset($pageGET['Extra']['keyword']) && strlen($pageGET['Extra']['keyword']) > 1 && $pageGET['Extra']['keyword'] !=$GLOBALS['LANG_SEARCH_INNER']['62']){
	if(isset($pageGET['Extra']['keyword']) && strlen($pageGET['Extra']['keyword']) > 1){

		//$QueryTotalExtra = " AND ( members_data.description LIKE ( '%".eMeetingInput($pageGET['Extra']['keyword'])."%' ) OR members_data.headline LIKE ( '%".eMeetingInput($pageGET['Extra']['keyword'])."%' ) ) "; 	

	} 

	$QueryTotal .=")";

	// SHOW ONLY NETWORK FRIENDS

	if( ( isset($pageGET['friendid']) && is_numeric($pageGET['friendid']) )  || ( isset($getData['friendid']) && is_numeric($getData['friendid']) )  ){

		$NETWORKD_FRIEND_ID    = (isset($pageGET['friendid']))	?	$pageGET['friendid']	: $getData['friendid'];

if(($NETWORK_ID ==1) || ($NETWORK_ID ==3)){

		$QueryTotal .="INNER JOIN members_network ON ( members.id = members_network.to_uid AND members_network.uid='".$NETWORKD_FRIEND_ID."'  AND members_network.type= ( '".$NETWORK_ID."' ) )";

}else{

		$QueryTotal .="INNER JOIN members_network ON ( ( (members.id = members_network.to_uid AND members_network.uid='".$NETWORKD_FRIEND_ID."' )  OR  ( members.id = members_network.uid AND members_network.to_uid='".$NETWORKD_FRIEND_ID."' ) )  AND members_network.type= ( '".$NETWORK_ID."' ) )";

}

	}	

	// build extra strings     

	if(isset($pageGET['Extra']['featured']) && $pageGET['Extra']['featured']==1){

		$QueryTotal .= " INNER JOIN files ON (files.uid = members.id AND files.featured='yes' ) "; 

	}elseif(isset($pageGET['Extra']['pics']) && $pageGET['Extra']['pics']==1 ){

		$QueryTotal .=" INNER JOIN files ON (files.uid = members.id AND files.default LIKE '%1%' AND approved='yes' ) ";

	}else{

		if(SEARCH_WITHOUT_PICS =="no"){ // dont display profiles without images

			 $QueryTotal .= " INNER JOIN files ON ( files.uid = members.id AND files.default LIKE '%1%' AND approved='yes' ) ";

		}

	}

	if(isset($pageGET['Extra']['online']) && $pageGET['Extra']['online']==1 || ( isset($getData['online']) && $getData['online']== 1 ) ){

		$QueryTotal .=" INNER JOIN members_online ON ( members_online.logid = members_data.uid ) ";

	}  

	$QueryTotal .="	WHERE members.email !='' AND members.visible = 'yes' ";
	
	$append = 0;
	//if($RunExtra ==''){
		//$QueryTotal .=" AND members.id <= 104000 ";
	//}

	if(isset($pageGET['Extra']['highlighted']) && $pageGET['Extra']['highlighted']==1){

		$QueryTotal .=" AND members.highlight='on' ";

	} 

	## ADMIN APPROVAL SYSTEM, SHOW ALL ADVERT TYPES EVENT IF THEY ARE NOT APPROVED

	if( isset($_SESSION['site_moderator_approve']) && $_SESSION['site_moderator_approve']=="yes" ){

		$QueryTotal .="";

	}else{

		$QueryTotal .=" AND members.active ='active' AND activate_code='OK' ";

	}

	if(isset($pageGET['Extra']['unapproved']) && $pageGET['Extra']['unapproved']==1){

		$QueryTotal .= " AND  members.active !='active' "; 	

	}

	// build extra strings

	if(isset($pageGET['Extra']['period']) && is_numeric($pageGET['Extra']['period']) && $pageGET['Extra']['period'] > 1){

		$QueryTotal .= " AND TO_DAYS( ".date("Y-m-d") .")  - TO_DAYS( members.created )  < ".$pageGET['Extra']['period']."  "; 	

	}

	if(isset($pageGET['Extra']['livevideo']) && $pageGET['Extra']['livevideo']==1){

		$QueryTotal .= " AND  members.video_duration > 0"; 	

	}

	if(isset($pageGET['Extra']['newtoday']) && $pageGET['Extra']['newtoday']==1){

 

		$QueryTotal .= " AND TO_DAYS( ".date("Y-m-d") .")  - TO_DAYS( members.created )  < 2 "; 	

	}

	if(isset($pageGET['Extra']['Username']) && strlen($pageGET['Extra']['Username']) > 1 && $pageGET['Extra']['Username'] !=$GLOBALS['LANG_SEARCH_INNER']['63']){

		$QueryTotal .= " AND members.username LIKE ( '%".eMeetingInput($pageGET['Extra']['Username'])."%' ) "; 	

	}
        
         /* serch miles and location wise */
                     if($searchFromMiles && $searchFromLocation)
                    { 
                        $locationArray= GetLongLat($location);
                        if(isset($locationArray['longitude']) && $locationArray['longitude']!=""
                                && isset($locationArray['latitude']) && $locationArray['latitude']!="")
                        {
                            $lat=$locationArray['latitude'] ;//30.695366;
                            $lng=$locationArray['longitude']; //-88.039894;
                        
                        
                            /*$QQ .=" and ( 3959 * acos( cos( radians(30.6953657) ) *"
                               . " cos( radians( ip_lat ) ) * cos( radians( ip_long ) "
                               . "- radians(-88.0398912) ) + sin( radians(30.6953657) ) "
                              . "* sin( radians( ip_lat ) ) ) )<=200 ";
                            */
                            $QueryTotal .=" and ( 3959 * acos( cos( radians($lat) ) *"
                             . " cos( radians( ip_lat ) ) * cos( radians( ip_long ) "
                             . "- radians($lng) ) + sin( radians($lat) ) "
                            . "* sin( radians( ip_lat ) ) ) )<=$miles ";
                            
                        }
                    }

	

	$QueryTotal .=" $listFavs";



	if(isset($pageGET['Extra']['online']) && $pageGET['Extra']['online']==1 || ( isset($getData['online']) && $getData['online']== 1 ) ){

			//$QueryTotal .= "GROUP BY members_online.logid";

	}

	$DB->Query("SET sql_big_selects=1"); // UNCHECK THIS IF YOU HAVE PROBLMS WITH BIG QUERY
	
       // print $QueryTotal.'<br>';

	$totalResults = $DB->Row($QueryTotal);
	
	//print_r($totalResults);
	if($RunExtra == "" && $totalResults['total'] > 500000){

			// WE NEED TO CUT DOWN THE SIZE OF FULL DATABASE QUERIES TO PREVENT SLOW DATABASE CONNECTIONS

			$HALF_DATABASE_SIZE = $totalResults['total']/2;

			$RunExtra = " ( members_data.description !='' AND members_data.headline !='' ) AND ";

			//print_r($RunExtra);

	}

	## make SQL query
	

		$QQ ="SELECT $NETWORK_SHOW_SQL package.icon, album.cat, members_data.postcode, files.featured, members.active AS ThisApproved, members.msgStatus, members.video_duration, files.bigimage, files.type, files.approved, files.adult_content, members_online.logid AS onlinenow, members.id, members.packageid, members.username, members.highlight, members.lastlogin, members_data.gender , members_data.headline, members_data.description, members_data.age, members_data.location, members_data.em_85820081128, members_data.country $RunString 

		FROM members	

		INNER JOIN members_data ON ( $RunExtra members.id = members_data.uid )";

		$append = 0;
		if($RunExtra ==''){
			$append = 1;
		}

		if($SHOW_ONLY_NETWORK ==1){


if(($NETWORK_ID ==1) || ($NETWORK_ID ==3)){

		$QQ .="INNER JOIN members_network ON ( members.id = members_network.to_uid AND members_network.uid='".$NETWORKD_FRIEND_ID."'  AND members_network.type= ( '".$NETWORK_ID."' ) )";

}else{

			$QQ .="INNER JOIN members_network ON ( ( (members.id = members_network.to_uid AND members_network.uid='".$NETWORKD_FRIEND_ID."' )  OR  ( members.id = members_network.uid AND members_network.to_uid='".$NETWORKD_FRIEND_ID."' ) )  AND members_network.type= ( '".$NETWORK_ID."' ) )";

		}




		}



	if(isset($pageGET['Extra']['online']) && $pageGET['Extra']['online']==1 || ( isset($getData['online']) && $getData['online']== 1 ) ){

		$QQ .=" INNER JOIN members_online ON ( members_online.logid = members.id ) ";
		
		
	}else{
		
		$QQ .=" LEFT JOIN members_online ON ( members_online.logid = members.id ) ";

	}

		$QQ .=" LEFT JOIN package ON ( members.packageid = package.pid ) ";

		if(SEARCH_WITHOUT_PICS =="no"){  // dont display profiles without images

			 //$QQ .= " LEFT JOIN files ON ( files.uid = members.id AND files.default LIKE '%1%' AND title != 'Message Photo') ";
			 $QQ .= " LEFT JOIN files ON ( files.uid = members.id AND files.default LIKE '%1%') ";
		}else{

			 //$QQ .= " LEFT JOIN files ON ( files.uid = members.id AND files.default LIKE '%1%' AND files.type='photo' AND title != 'Message Photo')	";
			 $QQ .= " LEFT JOIN files ON ( files.uid = members.id AND files.default LIKE '%1%' AND files.type='photo' AND files.approved = 'yes')	";
		}

		$QQ .= " LEFT JOIN album ON ( album.aid = files.aid) ";

		$QQ .="WHERE $RunExtra1 members.email !='' AND members.visible = 'yes' ";

		if(isset($pageGET['Extra']['online']) && $pageGET['Extra']['online']==1 || ( isset($getData['online']) && $getData['online']== 1 ) ){

			$GroupByThis = "members.id";

		}else{

			$GroupByThis = "members.id";

		}
		$member_limit = '';
		//if($append){
			//$member_limit = 'and members.id <= 104000';
		//}
                /* serch miles and location wise */
                     if($searchFromMiles && $searchFromLocation)
                    { 
                        $locationArray= GetLongLat($location);
                        if(isset($locationArray['longitude']) && $locationArray['longitude']!=""
                                && isset($locationArray['latitude']) && $locationArray['latitude']!="")
                        {
                            $lat=$locationArray['latitude'] ;//30.695366;
                            $lng=$locationArray['longitude']; //-88.039894;
                        
                        
                            /*$QQ .=" and ( 3959 * acos( cos( radians(30.6953657) ) *"
                               . " cos( radians( ip_lat ) ) * cos( radians( ip_long ) "
                               . "- radians(-88.0398912) ) + sin( radians(30.6953657) ) "
                              . "* sin( radians( ip_lat ) ) ) )<=200 ";
                            */
                            $QQ .=" and ( 3959 * acos( cos( radians($lat) ) *"
                             . " cos( radians( ip_lat ) ) * cos( radians( ip_long ) "
                             . "- radians($lng) ) + sin( radians($lat) ) "
                            . "* sin( radians( ip_lat ) ) ) )<=$miles ";
                            
                        }
                    }
		$QQ .=" $listFavs $member_limit GROUP BY ".$GroupByThis." ORDER BY ".$OrderByThis." LIMIT ".$startlimit.",".$stoplimit;


		if($SHOW_ONLY_NETWORK ==1){
$QQ ="SELECT $NETWORK_SHOW_SQL '' as icon, members_data.postcode, 'no' as featured,  members.active AS ThisApproved, members.msgStatus, members.video_duration, 'x.jpg' as  bigimage, 'photo' as type, 'yes' as approved, 'no' as adult_content, '1' as onlinenow, members.id,  members.packageid, members.username, members.highlight, members.lastlogin,  members_data.gender , members_data.headline, members_data.description, members_data.age,  members_data.location, members_data.em_85820081128, members_data.country 
		FROM members	
		INNER JOIN members_data ON ( $RunExtra members.id = members_data.uid )";
		

if(($NETWORK_ID ==1) || ($NETWORK_ID ==3)){

		$QQ .="INNER JOIN members_network ON ( members.id = members_network.to_uid AND members_network.uid='".$NETWORKD_FRIEND_ID."'  AND members_network.type= ( '".$NETWORK_ID."' ) )";

}else{

	$QQ .="INNER JOIN members_network ON ( ( (members.id =  members_network.to_uid AND members_network.uid='".$NETWORKD_FRIEND_ID."' )  OR  (  members.id = members_network.uid AND members_network.to_uid='".$NETWORKD_FRIEND_ID."' )  )  AND members_network.type= ( '".$NETWORK_ID."' ) )";

}



		$QQ .="WHERE $RunExtra1 members.email !='' AND members.visible = 'yes' ";
                
                   


		$QQ .=" $listFavs GROUP BY ".$GroupByThis." ORDER BY members_network.approved DESC, members_network.id DESC  LIMIT ".$startlimit.",".$stoplimit;

		

		}

	//print $QQ;

	$result = $DB->Query($QQ);

	$DataArray = array(); $Counter=1;

	while( $Data = $DB->NextRow($result) )

    {

		///////////////////// FILL OUT BLANKS

		//if(strlen($Data['location']) ==1){ $Data['location']=""; }

		//if(strlen($Data['country']) ==1){ $Data['country']="n/a"; }

		////////////////////////////////////////////////////////////////////////////////////////////////////

		$DataArray[$Counter]['id'] 			= $Data['id'];			

		$DataArray[$Counter]['postcode'] 	= $Data['postcode'];			// MEMBERS HIGHTED OPTION

		$DataArray[$Counter]['username'] 	= substr($Data['username'],0,15);					// MEMBERS USERNAME

		$DataArray[$Counter]['genderID'] 		= $Data['gender'];

		$DataArray[$Counter]['gender'] 		= MakeGender($Data['gender']); 		// MEMBERS GENDER

		$DataArray[$Counter]['lastlogin'] 	= $Data['lastlogin'];					// MEMBERS LAST LOGIN TIME

		$DataArray[$Counter]['status'] 		= eMeetingOutput($Data['msgStatus']);					// MEMBERS LAST LOGIN TIME

		$DataArray[$Counter]['video_duration'] 		= $Data['video_duration'];					// MEMBERS LAST LOGIN TIME

		$DataArray[$Counter]['highlight'] 		= $Data['highlight'];					// MEMBERS HIGHTED OPTION

		$DataArray[$Counter]['featured'] 		= $Data['featured'];					// MEMBERS HIGHTED OPTION

		$DataArray[$Counter]['packageid'] 		= $Data['packageid'];					// MEMBERS PACKAGEID

		$DataArray[$Counter]['headline'] 		= eMeetingOutput($Data['headline']);					// MEMBERS HEADLINE

		if($DataArray[$Counter]['headline'] =="0"){ $DataArray[$Counter]['headline']=$DataArray[$Counter]['username']; }

		$DataArray[$Counter]['description'] 	= substr(eMeetingOutput(strip_tags($Data['description'])),0,120);				// MEMBERS DESCRIPTION

		if($DataArray[$Counter]['description'] =='0'){ $DataArray[$Counter]['description']=""; }


		$DataArray[$Counter]['country'] 		= MakeNetworkCountryName($Data['country']);	// MEMBERS COUNTRY

		$DataArray[$Counter]['state'] 		= MakeNetworkStateName($Data['em_85820081128']);					// MEMBERS LOCATION
		$DataArray[$Counter]['location'] 		= MakeNetworkCityName($Data['location']);					// MEMBERS LOCATION

		$DataArray[$Counter]['lastlogin'] 		= $Data['lastlogin'];					// MEMBERS LOCATION

		$DataArray[$Counter]['age'] 			= MakeAge($Data['age']);				// MEMBERS AGE

		$DataArray[$Counter]['ThisApproved'] 	= $Data['ThisApproved'];				// MEMBERS AGE

		$DataArray[$Counter]['starsign'] 		= getsign($Data['age']);				// MEMBERS AGE

		$DataArray[$Counter]['CanChat'] 		= "yes";//$Data['CanChat'];					// CHAT USE IM

		if($Data['icon'] ==""){

		$DataArray[$Counter]['icon'] 			= DB_DOMAIN."images/DEFAULT/blank.gif";

		}else{

		$DataArray[$Counter]['icon'] 			= $Data['icon'];						// MEMBERS PACKAGE ICON

		}

		if(isset($Data['duration']) && $Data['duration'] > 0){

		$DataArray[$Counter]['video']		= true;										// VIDEO GREETING DURATION

		}else{

		$DataArray[$Counter]['video']		= false;

		}


		# make link

		$MODdata['id1'] = $Data['id'];

		$MODdata['name'] = $DataArray[$Counter]['username'];

		$DataArray[$Counter]['link'] = MakeLinkMOD($MODdata);



		if($SHOW_ONLY_NETWORK ==1){
	
			$result1 = $DB->Row("SELECT type, adult_content, bigimage, files.approved FROM files WHERE uid='".$Data['id']."' AND type='photo' and adult_content !='yes' ORDER BY `default` DESC LIMIT 1");
			$DataArray[$Counter]['image']		= ReturnDeImage($result1,"medium");


			$result2 = $DB->Row("SELECT members_online.logid AS onlinenow  FROM members_online WHERE logid='".$Data['id']."' LIMIT 1");

			$DataArray[$Counter]['onlinenow'] 	= $result2['onlinenow'];	// MEMBERS ONLINE NOW


			
		}else{

			$DataArray[$Counter]['onlinenow'] 	= $Data['onlinenow'];		// MEMBERS ONLINE NOW


			if($Data['cat'] == "public" || (isset($_SESSION['uid']) && $Data['id']==$_SESSION['uid']))
				$DataArray[$Counter]['image'] = ReturnDeImage($Data,"medium");
			else
				$DataArray[$Counter]['image'] = ReturnDeImage($Data,"medium");
			//	$DataArray[$Counter]['image'] = DB_DOMAIN."inc/tb.php?src=".DEFAULT_IMAGE."&x=96&y=96&x=48&y=48";
			
		}

	


		/////////////////////////////////////////////////////////



		if(isset($DataArray[$Counter]['onlinenow']) && $DataArray[$Counter]['onlinenow'] !=""){

					$OnlineM = true;

		}else{

					$OnlineM = false;

		}


		## display approve buttons for friends

		if(isset($Data['networkTOUID']) && $Data['networkTOUID'] == $_SESSION['uid'] ){ 

			$DataArray[$Counter]['networkApprove'] 	= $Data['networkApprove'];

		} 


		$DataArray[$Counter]['TotalResults'] 		= $totalResults['total']; 			// TOTAL SEARCH RESULTS COUNTER		

		////////////////////////////////////////////////////////////////////////////////////////////////////

		$Counter++;

	}
	return $DataArray;

}


function SavedSearched($id){

 	global $DB;


	$Data = array(); $i=1;

	if(!is_numeric($id)){ return; }

	$SQL = "SELECT * FROM member_searches WHERE uid ='".$id."' ORDER BY search_id DESC";

	$result = $DB->Query($SQL);

	while( $DataArray = $DB->NextRow($result) ){

		$Data[$i]['name'] = $DataArray['search_name'];

		$Data[$i]['value'] = $DataArray['search_string'];

		$Data[$i]['id'] = $DataArray['search_id'];

	$i++;

	}
	return $Data;
}


function MakeSavedSearched($data){
	$i=1;

	foreach($data as $ff => $key){

		print '<tr id="ss_'.$data[$i]['id'].'">

		<td>&nbsp;</td>

		<td>

		<form method="post" name="SaveSearch'.$i.'" action="'.getThePermalink('search').'">';

			$Split1 = explode("*",$key['value']);

			foreach($Split1 as $value){

			$Split2 = explode("-",$value);

				if(isset($Split2[1])){

					if(is_array($Split2[0])){

						foreach($Split2[0] as $value1){

							$Split3 = explode("-",$value1);

							if(isset($Split3[1])){

								print '<input type="hidden" name="'.$Split3[0].'" value="'.$Split3[1].'" class="hidden">';

							}

						}

					}else{

						print '<input type="hidden" name="'.$Split2[0].'" value="'.$Split2[1].'" class="hidden">';

					}

				}

			}
	

		print '<div id="sn_'.$data[$i]['id'].'">'.eMeetingOutput($data[$i]['name']).'</div>

		</form>

		</td>

<td><a href="javascript:void();" onClick="document.SaveSearch'.$i.'.submit();"><img src="'.DB_DOMAIN.'images/DEFAULT/_icons/new/zoom.png" align="absmidde"> </a></td>

<td> <a href="javascript:void();" onClick="DeleteSavePage('.$data[$i]['id'].');Effect.Fade(\'ss_'.$data[$i]['id'].'\')"><img src="'.DB_DOMAIN.'images/DEFAULT/_icons/new/chk_no.png"></a></td>

		</tr>

<script type="text/javascript"> new Ajax.InPlaceEditor(\'sn_'.$data[$i]['id'].'\', \''.DB_DOMAIN.'inc/ajax/_actions.php\', { okText:\'Ok\', callback: function(form, value) { return \'action=ChangeSaveSearch&id='.$data[$i]['id'].'&msg=\' + encodeURIComponent(value)}})</script>

';

$i++;

	}

}

/*
@ PROFILE VIEWED
@ THURSDAY 26 OCT 2017
*/

function GetViewedProfiles($pageGET, $This_Page, $getData="",$pageType=""){

	global $DB;
	$RunExtra="";
	$RunExtra1="";
	$RunString="";
	$c=1;
	$count=1;
	$loopcount=1;
	$listFavs="";
	$DisplayType =2; // DEFAULT DISPLAY VIEW
	$SHOW_ONLY_NETWORK =0; $NETWORK_ID=2; $NETWORK_SHOW_SQL=""; $MODdata['page'] ='profile';  $MODdata['sub'] ='overview'; $MODdata['type'] ='system';


	#######################################################################			
	###################### BUILD SEARCH QUERY STRING  #####################
	#######################################################################			
	 $BuiltArray = "";
	 $addExtra = false;

	 if(isset($pageGET['SeN'])){

	 
		$TotalArray = count($pageGET['SeN'])+1;

		for($i = 1; $i < $TotalArray; $i++) { 

			if(isset($pageGET['SeV'][$i])){

				if(  isset($pageGET['SeV'][$i]) && (is_numeric($pageGET['SeV'][$i]) && $pageGET['SeV'][$i] !=0) || ( strlen($pageGET['SeV'][$i]) > 1 ) ){

					if($pageGET['SeT'][$i] ==1 || $pageGET['SeT'][$i] ==2){

						$RunExtra .= " members_data.".eMeetingInput($pageGET['SeN'][$i]) ." LIKE '%".eMeetingInput($pageGET['SeV'][$i])."%' AND ";

					}
					else if($pageGET['SeT'][$i] ==3 ){ // listbox

						if($pageGET['SeN'][$i]=="country"){

							$RunExtra .= " ( members_data.".eMeetingInput($pageGET['SeN'][$i]) ."='".eMeetingInput($pageGET['SeV'][$i])."' OR members_data.".eMeetingInput($pageGET['SeN'][$i]) ."='".MakeCountry(eMeetingInput($pageGET['SeV'][$i]))."' ) AND ";

						}else{

							$RunExtra .= " members_data.".eMeetingInput($pageGET['SeN'][$i]) ."='".eMeetingInput($pageGET['SeV'][$i])."' AND ";	

						}

					}elseif($pageGET['SeT'][$i] ==4){ // checkbox

					   if($pageGET['SeV'][$i] == ""){$pageGET['SeV'][$i] =0; }
					   $RunExtra .= " members_data.".eMeetingInput($pageGET['SeN'][$i]) ."='".eMeetingInput($pageGET['SeV'][$i])."' AND";									
					
					}

					$RunString .= ", members_data.".eMeetingInput($pageGET['SeN'][$i]);	
			 	}
			}
			
		}
		
	}

	if(isset($pageGET['CeK'])){

		for($i = 0; $i < $pageGET['TotalNumberOfRows']+2; $i++) { 

			if(isset($pageGET['CeK'][$i])) //multiple choices
			{ 

				if($pageGET['SeT'][$i] ==5) { // multiple choices - checkbox
				
					$bitArray = array();
					$bitArrayC = 0;
					$x = 0;
					$fieldId = $pageGET['CeK'][$i];

					for($c = 0; $c < 100; $c++) {

						// MAKE SAVE
						if(isset($pageGET['FieldMulti'.$x.$fieldId]))
						{								
							if(isset($pageGET['Multi'.$x.$fieldId]))
							{
								$BuiltArray .="1**";
								$bitArray[$bitArrayC] = "1**";
								$addExtra = true;
							}else{
								$BuiltArray .="0**";
								$bitArray[$bitArrayC] = "0**";
							}
							$bitArrayC++;
						}
						$x++;  
					}			
					if($addExtra) {

						$CeKExtra = "";
						for($ix=0; $ix < count($bitArray); $ix++){

							if($bitArray[$ix] == "1**") {
								if($ix == 0)
									$startFrom = 1;
								else
									$startFrom = $ix * 3 +1;

								$CeKExtra .= " SUBSTRING(members_data." . eMeetingInput($pageGET['FieldName'.$fieldId]) .",".$startFrom.",3) = '".$bitArray[$ix]."' OR ";
							}
						}
						if(!empty($CeKExtra))
						{
							$RunExtra .= "(".substr(trim($CeKExtra), 0, strlen(trim($CeKExtr))-2).") AND ";
						}

					}

					//reset variables
					$BuiltArray = "";
					$CeKExtra = "";
					$bitArray = array();
					$addExtra = false;

			  	}
			}
		}
	}

	#######################################################################

	####################### BUILD EXTRA QUERY STRING  #####################
	
	#######################################################################			


	## ADMIN APPROVAL SYSTEM, SHOW ALL ADVERT TYPES EVENT IF THEY ARE NOT APPROVED

	if( isset($_SESSION['site_moderator_approve']) && $_SESSION['site_moderator_approve']=="yes" ){

		$RunExtra1 .="";

	}else{


		if( D_GENDERMATCHING ==1 && $SHOW_ONLY_NETWORK !=1  ){ 
                    $RunExtra1 .="members_data.gender != '".$_SESSION['genderid']."' AND"; }

			$RunExtra1 .=" members.active ='active' AND activate_code='OK' AND";

	}




	// build extra strings

	if($pageType == 'birthday'){

		$agemd = date('M-d'); 	
		$RunExtra1 .= " members_data.age LIKE '%$agemd%' AND "; 	
	}

	////////////////////////////////////////////////////////
	/////////////// BUILDING SORT STRING ///////////////////
	////////////////////////////////////////////////////////


	$OrderByThis = "members.lastlogin DESC";

	// build extra strings

	$stoplimit=SEARCH_PAGE_ROWS;


	///////////////// GALLERY VIEW PHOTOS ONLY

	if(!isset($This_Page)){$This_Page=1; }

	$startlimit = $stoplimit*($This_Page-1);

	if($startlimit <0) $startlimit =0;

	#######################################################################			

	###################### BUILD FINISHED QUERY  ##########################

	//$QueryTotal = "SELECT if(count(DISTINCT ";
	$QueryTotal = "SELECT count(DISTINCT(members.id)) AS total FROM members INNER JOIN members_data ON (  $RunExtra members.id = members_data.uid ";

	if($pageType == 'birthday'){

		$agemd = date('M-d'); 		
		$QueryTotal .=" AND members_data.age LIKE '%$agemd%' ";

	}

	$QueryTotal .=")";

	if($pageType == 'viewed')
	$QueryTotal .=" INNER JOIN visited ON ( visited.view_uid = members.id) AND visited.uid = '".$_SESSION['uid']."'";

	if(isset($pageGET['Extra']['online']) && $pageGET['Extra']['online']==1 || ( isset($getData['online']) && $getData['online']== 1 ) ){

		$QueryTotal .=" INNER JOIN members_online ON ( members_online.logid = members_data.uid ) ";

	}  
	$QueryTotal .="	WHERE members.email !='' AND members.visible = 'yes' ";
	
	$append = 0;
	//if($RunExtra ==''){
		//$QueryTotal .=" AND members.id <= 104000 ";
	//}

	if(isset($pageGET['Extra']['highlighted']) && $pageGET['Extra']['highlighted']==1){

		$QueryTotal .=" AND members.highlight='on' ";

	} 

	## ADMIN APPROVAL SYSTEM, SHOW ALL ADVERT TYPES EVENT IF THEY ARE NOT APPROVED

	if( isset($_SESSION['site_moderator_approve']) && $_SESSION['site_moderator_approve']=="yes" ){

		$QueryTotal .="";

	}else{

		$QueryTotal .=" AND members.active ='active' AND activate_code='OK' ";

	}

	if(isset($pageGET['Extra']['unapproved']) && $pageGET['Extra']['unapproved']==1){

		$QueryTotal .= " AND  members.active !='active' "; 	

	}

	if( ( isset($pageGET['Extra']['online']) && $pageGET['Extra']['online']==1 ) || ( isset($getData['online']) && $getData['online']== 1 ) ){

		$RunExtra1 .= " members.id = members_online.logid AND ";

	}
	// build extra strings
	$QueryTotal .=" $listFavs";



	$DB->Query("SET sql_big_selects=1"); // UNCHECK THIS IF YOU HAVE PROBLMS WITH BIG QUERY
	
	print $QueryTotal;

	//$totalResults = $DB->Row($QueryTotal);
	
	//print_r($totalResults);
	if($RunExtra == "" && $totalResults['total'] > 500000){

			// WE NEED TO CUT DOWN THE SIZE OF FULL DATABASE QUERIES TO PREVENT SLOW DATABASE CONNECTIONS

			$HALF_DATABASE_SIZE = $totalResults['total']/2;

			$RunExtra = " ( members_data.description !='' AND members_data.headline !='' ) AND ";

	}

	## make SQL query

		$QQ ="SELECT $NETWORK_SHOW_SQL album.cat, members_data.postcode, files.featured, members.active AS ThisApproved, members.msgStatus, members.video_duration, files.bigimage, files.type, files.approved, files.adult_content, members.id, members.packageid, members_online.logid AS onlinenow, members.username, members.highlight, members.lastlogin, members_data.gender , members_data.headline, members_data.description, members_data.age, members_data.location, members_data.em_85820081128, members_data.country $RunString 

		FROM members	

		INNER JOIN members_data ON ( $RunExtra members.id = members_data.uid )";

		$append = 0;
		if($RunExtra ==''){
			$append = 1;
		}
		if($pageType == 'viewed'){
		$QQ .= " INNER JOIN visited ON ( visited.view_uid = members.id) AND visited.uid = '".$_SESSION['uid']."'";
		}
		$QQ .= " LEFT JOIN files ON ( files.uid = members.id AND files.default LIKE '%1%') ";

		$QQ .= " LEFT JOIN album ON ( album.aid = files.aid) ";
		if(isset($pageGET['Extra']['online']) && $pageGET['Extra']['online']==1 || ( isset($getData['online']) && $getData['online']== 1 ) ){

		$QQ .=" INNER JOIN members_online ON ( members_online.logid = members.id ) ";
			
			
		}else{
			
			$QQ .=" LEFT JOIN members_online ON ( members_online.logid = members.id ) ";

		}
		$QQ .="WHERE $RunExtra1 members.email !='' AND members.visible = 'yes' ";

		$GroupByThis = "members.id";

		$member_limit = '';
		//if($append){
			//$member_limit = 'and members.id <= 104000';
		//}

		$QQ .=" $listFavs $member_limit GROUP BY ".$GroupByThis." ORDER BY ".$OrderByThis." LIMIT ".$startlimit.",".$stoplimit;


	print $QQ;

	//$result = $DB->Query($QQ);

	$DataArray = array(); $Counter=1;

	while( $Data = $DB->NextRow($result) )

    {

		///////////////////// FILL OUT BLANKS

		//if(strlen($Data['location']) ==1){ $Data['location']=""; }

		//if(strlen($Data['country']) ==1){ $Data['country']="n/a"; }

		////////////////////////////////////////////////////////////////////////////////////////////////////

		$DataArray[$Counter]['id'] 			= $Data['id'];			

		$DataArray[$Counter]['postcode'] 	= $Data['postcode'];			// MEMBERS HIGHTED OPTION

		$DataArray[$Counter]['username'] 	= substr($Data['username'],0,15);					// MEMBERS USERNAME

		$DataArray[$Counter]['genderID'] 		= $Data['gender'];

		$DataArray[$Counter]['gender'] 		= MakeGender($Data['gender']); 		// MEMBERS GENDER

		$DataArray[$Counter]['lastlogin'] 	= $Data['lastlogin'];					// MEMBERS LAST LOGIN TIME

		$DataArray[$Counter]['status'] 		= eMeetingOutput($Data['msgStatus']);					// MEMBERS LAST LOGIN TIME

		$DataArray[$Counter]['video_duration'] 		= $Data['video_duration'];					// MEMBERS LAST LOGIN TIME

		$DataArray[$Counter]['highlight'] 		= $Data['highlight'];					// MEMBERS HIGHTED OPTION

		$DataArray[$Counter]['featured'] 		= $Data['featured'];					// MEMBERS HIGHTED OPTION

		$DataArray[$Counter]['packageid'] 		= $Data['packageid'];					// MEMBERS PACKAGEID

		$DataArray[$Counter]['headline'] 		= eMeetingOutput($Data['headline']);	// MEMBERS HEADLINE

		if($SHOW_ONLY_NETWORK ==1){
	
			$result1 = $DB->Row("SELECT type, adult_content, bigimage, files.approved FROM files WHERE uid='".$Data['id']."' AND type='photo' and adult_content !='yes' ORDER BY `default` DESC LIMIT 1");
			$DataArray[$Counter]['image'] = ReturnDeImage($result1,"medium");


			$result2 = $DB->Row("SELECT members_online.logid AS onlinenow  FROM members_online WHERE logid='".$Data['id']."' LIMIT 1");

			$DataArray[$Counter]['onlinenow'] 	= $result2['onlinenow'];	// MEMBERS ONLINE NOW


			
		}else{

			$DataArray[$Counter]['onlinenow'] 	= $Data['onlinenow'];		// MEMBERS ONLINE NOW


			if($Data['cat'] == "public" || (isset($_SESSION['uid']) && $Data['id']==$_SESSION['uid']))
				$DataArray[$Counter]['image'] = ReturnDeImage($Data,"medium");
			else
				$DataArray[$Counter]['image'] = ReturnDeImage($Data,"medium");
			//	$DataArray[$Counter]['image'] = DB_DOMAIN."inc/tb.php?src=".DEFAULT_IMAGE."&x=96&y=96&x=48&y=48";
			
		}

		if($DataArray[$Counter]['headline'] =="0"){ $DataArray[$Counter]['headline']=$DataArray[$Counter]['username']; }

		$DataArray[$Counter]['description'] 	= substr(eMeetingOutput(strip_tags($Data['description'])),0,120);				// MEMBERS DESCRIPTION

		if($DataArray[$Counter]['description'] =='0'){ $DataArray[$Counter]['description']=""; }


		$DataArray[$Counter]['country'] 		= MakeNetworkCountryName($Data['country']);	// MEMBERS COUNTRY

		$DataArray[$Counter]['state'] 		= MakeNetworkStateName($Data['em_85820081128']);					// MEMBERS LOCATION
		$DataArray[$Counter]['location'] 		= MakeNetworkCityName($Data['location']);					// MEMBERS LOCATION

		$DataArray[$Counter]['lastlogin'] 		= $Data['lastlogin'];					// MEMBERS LOCATION

		$DataArray[$Counter]['age'] 			= MakeAge($Data['age']);				// MEMBERS AGE

		$DataArray[$Counter]['ThisApproved'] 	= $Data['ThisApproved'];				// MEMBERS AGE

		$DataArray[$Counter]['starsign'] 		= getsign($Data['age']);				// MEMBERS AGE

		$DataArray[$Counter]['CanChat'] 		= "yes";//$Data['CanChat'];					// CHAT USE IM


		if(isset($Data['duration']) && $Data['duration'] > 0){

		$DataArray[$Counter]['video']		= true;										// VIDEO GREETING DURATION

		}else{

		$DataArray[$Counter]['video']		= false;

		}


		# make link

		$MODdata['id1'] = $Data['id'];

		$MODdata['name'] = $DataArray[$Counter]['username'];

		$DataArray[$Counter]['link'] = MakeLinkMOD($MODdata);


		if($Data['cat'] == "public" || (isset($_SESSION['uid']) && $Data['id']==$_SESSION['uid']))
			$DataArray[$Counter]['image'] = ReturnDeImage($Data,"medium");
		else
			$DataArray[$Counter]['image'] = ReturnDeImage($Data,"medium");
	


		/////////////////////////////////////////////////////////



		if(isset($DataArray[$Counter]['onlinenow']) && $DataArray[$Counter]['onlinenow'] !=""){

					$OnlineM = true;

		}else{

					$OnlineM = false;

		}


		## display approve buttons for friends

		if(isset($Data['networkTOUID']) && $Data['networkTOUID'] == $_SESSION['uid'] ){ 

			$DataArray[$Counter]['networkApprove'] 	= $Data['networkApprove'];

		} 


		$DataArray[$Counter]['TotalResults'] 		= $totalResults['total']; 			// TOTAL SEARCH RESULTS COUNTER		

		////////////////////////////////////////////////////////////////////////////////////////////////////

		$Counter++;

	}
	return $DataArray;

}

/*Param: Any address or location
 * Return: function will return latitude 
 * and longitude of given address
 *  */
function GetLongLat($location)
{
    $address = $location; // Google HQ
        $prepAddr = str_replace(' ','+',$address);
        $geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false'.
                '&key='.GOOGLE_MAPS_KEY);
        $output= json_decode($geocode);
                        
        $latitude = $output->results[0]->geometry->location->lat;
        $longitude = $output->results[0]->geometry->location->lng;
        $LocationArray['longitude']=$longitude;
        $LocationArray['latitude']=$latitude;
        return $LocationArray;
}
?>