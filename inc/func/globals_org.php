<?php

###############################################################################
/*
	THE BELOW FUNCTIONS ARE USED DURING THE INITAL SYSTEM LOAD
*/
###############################################################################

function StripModLinkBad($value){
	$value = str_replace("!","",$value);
	$value = str_replace("/","-",$value);
	$value = str_replace(" ","-",str_replace("\'","",$value));
	$value = str_replace(".","",str_replace("#","",str_replace("?","",strip_tags($value))));
	return $value;
}




function MakeAgeListField($value="", $id, $tabcounter=6){

	$ReturnValue="";



	if ($value == "") {



		if(isset($_POST['FieldValue23a'])){ $ValYY = eMeetingOutput($_POST['FieldValue23a']); }else{ $ValYY = ""; }

		if(isset($_POST['FieldValue23b'])){ $ValMM = eMeetingOutput($_POST['FieldValue23b']); }else{ $ValMM = ""; }

		if(isset($_POST['FieldValue23c'])){ $ValDD = eMeetingOutput($_POST['FieldValue23c']); }else{ $ValDD = ""; }



		if(isset($_POST['FieldValue23a']) &&  strlen($_POST['FieldValue23a']) < 2){ $ValStyleYY="border: 2px solid #990000; padding: 2px; background:#FAB6B8;";  }else{ $ValStyleYY="";}

		if(isset($_POST['FieldValue23b']) &&  strlen($_POST['FieldValue23b']) < 2){ $ValStyleMM="border: 2px solid #990000; padding: 2px; background:#FAB6B8;";  }else{ $ValStyleMM="";}

		if(isset($_POST['FieldValue23c']) &&  strlen($_POST['FieldValue23c']) < 1){ $ValStyleDD="border: 2px solid #990000; padding: 2px; background:#FAB6B8;";  }else{ $ValStyleDD="";}

	}

	else {

		$cv = explode("-",$value);

		$ValYY = $cv[0];

		$ValMM = $cv[1];

		$ValDD = $cv[2];

	}





	

	## MONTH

	$ms1="";$ms2="";$ms3="";$ms4="";$ms5="";$ms6="";$ms17="";$ms8="";$ms9="";$ms10="";$ms11="";$ms12="";

	switch($ValMM){

	case "JAN": { $ms1="selected";} break;

	case "FEB": { $ms2="selected";} break;

	case "MAR": { $ms3="selected";} break;

	case "APR": { $ms4="selected";} break;

	case "MAY": { $ms5="selected";} break;

	case "JUN": { $ms6="selected";} break;

	case "JUL": { $ms7="selected";} break;

	case "AUG": { $ms8="selected";} break;

	case "SEP": { $ms9="selected";} break;

	case "OCT": { $ms10="selected";} break;

	case "NOV": { $ms11="selected";} break;

	case "DEC": { $ms12="selected";} break;

	}

	$bt_sliding_class = '';
	if(D_USER_REGISTRATION == 'sliding'){
		$bt_sliding_class = 'class="form-control fieldGroup_2 field_id_23"';
	
		$ReturnValue .='<div class="col-md-4">';
	}

	$ReturnValue .='<select name="FieldValue'.$id.'b" '.$bt_sliding_class.' tabindex="'.$tabcounter.'" style="'.isset($ValStyleMM).'">

	<option value="0" '.$ms1.'>'.$GLOBALS['_LANG']['_month'].'</option>

	<option value="JAN" '.$ms1.'>'.MakeCalendarMonth(01,true).'</option>

	<option value="FEB" '.$ms2.'>'.MakeCalendarMonth(02,true).'</option>

	<option value="MAR" '.$ms3.'>'.MakeCalendarMonth(03,true).'</option>

	<option value="APR" '.$ms4.'>'.MakeCalendarMonth(04,true).'</option>

	<option value="MAY" '.$ms5.'>'.MakeCalendarMonth(05,true).'</option>

	<option value="JUN" '.$ms6.'>'.MakeCalendarMonth(06,true).'</option>

	<option value="JUL" '.isset($ms7).'>'.MakeCalendarMonth(07,true).'</option>

	<option value="AUG" '.$ms8.'>'.$GLOBALS['_LANG']['_august'].'</option>

	<option value="SEP" '.$ms9.'>'.$GLOBALS['_LANG']['_september'].'</option>

	<option value="OCT" '.$ms10.'>'.MakeCalendarMonth(10,true).'</option>

	<option value="NOV" '.$ms11.'>'.MakeCalendarMonth(11,true).'</option>

	<option value="DEC" '.$ms12.'>'.MakeCalendarMonth(12,true).'</option>

	</select><p class="note response_span_gen" style="display: none;"></p>';

	if(D_USER_REGISTRATION == 'sliding'){
		$ReturnValue .='</div>';
		$ReturnValue .='<div class="col-md-4">';
	}
	## DAY

	$ReturnValue .='<select name="FieldValue'.$id.'c" '.$bt_sliding_class.' tabindex="'.$tabcounter.'" style="'.isset($ValStyleDD).'"><option value="0">'.$GLOBALS['_LANG']['_day'].'</option>';

	$DD=31;

	for($i=0; $i<31; $i++){

	if($DD ==$ValDD){ $sel ="selected"; }else{ $sel =""; }

		$ReturnValue .='<option value="'.$DD.'" '.$sel.'>'.$DD.'</option>';

		$DD--;

	} 

	$ReturnValue .='</select><p class="note response_span_gen" style="display: none;"></p>';
	
	if(D_USER_REGISTRATION == 'sliding'){
		$ReturnValue .='</div>';
		$ReturnValue .='<div class="col-md-4">';
	}

	$ReturnValue .='<select name="FieldValue'.$id.'a" '.$bt_sliding_class.' tabindex="'.$tabcounter.'" style="'.isset($ValStyleYY).'"><option value="0">'.$GLOBALS['_LANG']['_year'].'</option>';


	## MAKE AGE ARRAY

	$YY=date('Y')-18;

	for($i=0; $i<80; $i++){

	if($YY ==$ValYY){ $sel ="selected"; }else{ $sel =""; }

		$ReturnValue .='<option value="'.$YY.'" '.$sel.'>'.$YY.'</option>';

		$YY--;

	}

	$ReturnValue .='</select><p class="note response_span_gen" style="display: none;"></p>';
	
	if(D_USER_REGISTRATION == 'sliding'){
		$ReturnValue .='</div>';
	}
	return $ReturnValue;

}

function DisplaySignupFields($id=0){

	/*

		THIS FUNCTION WILL DISPLAY THE EXTRA PROFILE FIELDS

		AS CREATED IN THE ADMIN AREA

	*/

	global $DB;

	$NumFields = 1;

	$NumLinkedFields = 1;

	$counter=1;

	$tabcounter=4;

	$ReturnValue =" ";

	$arrLocation = GetLocationDetails($_SERVER['REMOTE_ADDR']);
	
	if(!is_numeric($id)){ return; }

	if($id ==0){ $extraID =" OR field_groups.private =1 OR field_groups.private = 2 "; }else{ $extraID =""; }

    $SQL = "SELECT field.fid,field.fType,field.fName,field.linked_id FROM field INNER JOIN field_groups ON ( ( field_groups.id = field.groupid  || field_groups.id = field.groupid_1 || field_groups.id = field.groupid_2 ) AND ( field_groups.private = ".$id." ".$extraID." ) ) WHERE field.required = 1 ORDER BY field.fOrder ASC";

	$result = $DB->Query($SQL);   

    while( $groups = $DB->NextRow($result) )

    {

		////////////////////////////

		// STOP NULL CAPTION VALUES

		/////////////////////////////

		if(D_LANG !="english"){

			// check see if there is a caption

			$Caption = $DB->Row("SELECT caption, description FROM field_caption WHERE Cid=".$groups['fid']." AND lang='".D_LANG."' AND `match`='no' limit 1");

			if(empty($Caption)){

				// no caption found, load english caption

				$Caption = $DB->Row("SELECT description, caption FROM field_caption WHERE Cid=".$groups['fid']." AND `match`='no' limit 1");

			}

		}else{

			$Caption = $DB->Row("SELECT caption, description FROM field_caption WHERE Cid=".$groups['fid']." AND lang='".D_LANG."' AND `match`='no' limit 1");

		}			

		////////////////////////////

		/////////////////////////////

		// ADD CODE INCASE THE FORM IS SUBMITTED AND DATA IS ENTERED INTO THE BOX

		if(isset($_POST['FieldValue'.$groups['fid']])){ $Val = eMeetingOutput($_POST['FieldValue'.$groups['fid']]); }else{ $Val = ""; }


		if(isset($_POST['FieldValue'.$groups['fid']]) &&  strlen($_POST['FieldValue'.$groups['fid']]) < 2){ $ValStyle="border: 2px solid #990000; padding: 2px; background:#FAB6B8;";  }else{ $ValStyle="";}

		/////////////////////////////////////////////////////////////////////////

		## Display Field Data

		//if($id ==0){ $ReturnValue .="<li>";  }else{ $ReturnValue .="<br>"; }

		if($id ==0){ $ReturnValue .="<li>";  }else{ $ReturnValue .="<li>"; }

		$ReturnValue .= "<label class='required'>".$Caption['caption'].": </label>";

		if(!isset($_POST['FieldValue'.$groups['fid']])){ $_POST['FieldValue'.$groups['fid']]=""; }

		if($groups['fType'] == 1){

			// DOB ADDITIONAL CODE

			if($groups['fName'] =="age"){			

				if($id !=0){

				$ReturnValue .='<select name="birthdatey" tabindex="'.$tabcounter.'">

				<option value="1990">'.$GLOBALS['_LANG']['_year'].'</option>
				<option value="1990">1990</option>
				<option value="1989">1989</option>
				<option value="1988">1988</option>
				<option value="1987">1987</option>
				<option value="1986">1986</option>
				<option value="1985">1985</option>
				<option value="1984">1984</option>
				<option value="1983">1983</option>
				<option value="1982">1982</option>
				<option value="1981">1981</option>
				<option value="1980">1980</option>
				<option value="1979">1979</option>
				<option value="1978">1978</option>
				<option value="1977">1977</option>
				<option value="1976">1976</option>
				<option value="1975">1975</option>
				<option value="1974">1974</option>
				<option value="1973">1973</option>
				<option value="1972">1972</option>
				<option value="1971">1971</option>
				<option value="1970">1970</option>
				<option value="1969">1969</option>
				<option value="1968">1968</option>
				<option value="1967">1967</option>
				<option value="1966">1966</option>
				<option value="1965">1965</option>
				<option value="1964">1964</option>
				<option value="1963">1963</option>
				<option value="1962">1962</option>
				<option value="1961">1961</option>
				<option value="1960">1960</option>
				<option value="1959">1959</option>
				<option value="1958">1958</option>
				<option value="1957">1957</option>
				<option value="1956">1956</option>
				<option value="1955">1955</option>
				<option value="1954">1954</option>
				<option value="1953">1953</option>
				<option value="1952">1952</option>
				<option value="1951">1951</option>
				<option value="1950">1950</option>
				<option value="1949">1949</option>
				<option value="1948">1948</option>
				<option value="1947">1947</option>
				<option value="1946">1946</option>
				<option value="1945">1945</option>
				<option value="1944">1944</option>
				<option value="1943">1943</option>
				<option value="1942">1942</option>
				<option value="1941">1941</option>
				<option value="1940">1940</option>
				<option value="1939">1939</option>
				<option value="1938">1938</option>
				<option value="1937">1937</option>
				<option value="1936">1936</option>
				<option value="1935">1935</option>
				<option value="1934">1934</option>
				<option value="1933">1933</option>
				<option value="1932">1932</option>
				<option value="1931">1931</option>
				<option value="1930">1930</option>
				<option value="1929">1929</option>
				<option value="1928">1928</option>
				<option value="1927">1927</option>
				<option value="1926">1926</option>
				<option value="1925">1925</option>
				<option value="1924">1924</option>
				<option value="1923">1923</option>
				<option value="1922">1922</option>
				<option value="1921">1921</option>
				<option value="1920">1920</option>
				<option value="1919">1919</option>
				<option value="1918">1918</option>
				<option value="1917">1917</option>
				<option value="1916">1916</option>
				<option value="1915">1915</option>
				<option value="1914">1914</option>
				<option value="1913">1913</option>
				<option value="1912">1912</option>
				<option value="1911">1911</option>
				<option value="1910">1910</option>
				</select>

				<select name="birthdatem" tabindex="'.$tabcounter.'">
				<option value="JAN">'.$GLOBALS['_LANG']['_month'].'</option>
				<option value="JAN">'.MakeCalendarMonth(01,true).'</option>
				<option value="FEB">'.MakeCalendarMonth(02,true).'</option>
				<option value="MAR">'.MakeCalendarMonth(03,true).'</option>
				<option value="APR">'.MakeCalendarMonth(04,true).'</option>
				<option value="MAY">'.MakeCalendarMonth(05,true).'</option>
				<option value="JUN">'.MakeCalendarMonth(06,true).'</option>
				<option value="JUL">'.MakeCalendarMonth(07,true).'</option>
				<option value="AUG">'.$GLOBALS['_LANG']['_august'].'</option>
				<option value="SEP">'.$GLOBALS['_LANG']['_september'].'</option>
				<option value="OCT">'.MakeCalendarMonth(10,true).'</option>
				<option value="NOV">'.MakeCalendarMonth(11,true).'</option>
				<option value="DEC">'.MakeCalendarMonth(12,true).'</option>
				</select>

				<select name="birthdated" tabindex="'.$tabcounter.'">
				<option value="01">'.$GLOBALS['_LANG']['_day'].'</option>
				<option value="01">1</option>
				<option value="02">2</option>
				<option value="03">3</option>
				<option value="04">4</option>
				<option value="05">5</option>
				<option value="06">6</option>
				<option value="07">7</option>
				<option value="08">8</option>
				<option value="09">9</option>
				<option value="10">10</option>
				<option value="11">11</option>
				<option value="12">12</option>
				<option value="13">13</option>
				<option value="14">14</option>
				<option value="15">15</option>
				<option value="16">16</option>
				<option value="17">17</option>
				<option value="18">18</option>
				<option value="19">19</option>
				<option value="20">20</option>
				<option value="21">21</option>
				<option value="22">22</option>
				<option value="23">23</option>
				<option value="24">24</option>
				<option value="25">25</option>
				<option value="26">26</option>
				<option value="27">27</option>
				<option value="28">28</option>
				<option value="29">29</option>
				<option value="30">30</option>
				<option value="31">31</option>
				</select>';

				$ReturnValue .= "<input name='FieldValue".$groups['fid']."' class='hidden' type='hidden' value='0'>";

			}else{					

				if(isset($_POST['FieldValue'.$groups['fid']])){ $dAge =strip_tags($_POST['FieldValue'.$groups['fid']]); }else{ $dAge ="1990-01-01"; }

				if($dAge ==""){ $dAge ="1990-01-01"; }

				$ReturnValue .= "<script>DateInput('FieldValue".$groups['fid']."', true, 'YYYY-MON-DD','".$dAge."')</script>";

			}

		}else{

			if($groups['fName'] == "location"){
				
				$ReturnValue .= "<div class='box-location'><input name='FieldValue".$groups['fid']."' class='input' id='registerLocation' ".$ValStyle."' type='text' value='".$Val."' tabindex='".$tabcounter."'></div>";
			}
			else{
				$ReturnValue .= "<input name='FieldValue".$groups['fid']."' class='input' type='text' ".$ValStyle."' value='".$Val."' tabindex='".$tabcounter."' size='40'>";
			}	

		}

	}elseif($groups['fType'] == 4){

		## turn of styling for checkbox if value is 1

		if(isset($_POST['do']) &&  $_POST['FieldValue'.$groups['fid']] != 1){ $ValStyle="border: 2px solid #990000; padding: 2px; background:#FAB6B8;"; }else { $ValStyle=""; }

		if($Val ==1){ $Val ="checked"; }else{ $Val ="";  }

		$ReturnValue .= "<span style='".$ValStyle."'><input type='checkbox' name='FieldValue".$groups['fid']."' value='1' ".$Val." tabindex='".$counter."'></span>";

	}elseif($groups['fType'] == 2){

		$ReturnValue .= "<textarea name='FieldValue".$groups['fid']."' rows='3' cols='23' class='input' style='".$ValStyle."' tabindex='".$tabcounter."'>".$Val."</textarea>";

		## age field

	}elseif($groups['fType'] == 7){

		$ReturnValue .= " ".MakeAgeListField("",$groups['fid'],$tabcounter);

	}elseif($groups['fType'] == 3){

		if($groups['fName'] == 'country'){

			$linkcode = "";
			
			/* This is a list box */

			// check if there is a field linked to this one
			$Linked = $DB->Row("SELECT fid FROM field WHERE linked_id=".$groups['fid']." limit 1");	

			if(!empty($Linked) && $groups['fName'] !="gender"){

				$LinkedCode ="onChange='eMeetingNetworkStates(this.value, ".$Linked['fid'].");'"; $NumLinkedFields++;

			}

			$ReturnValue .= "<div id='Link".$groups['fid']."'>";
			$ReturnValue .= "<select name='FieldValue".$groups['fid']."' $LinkedCode>";

			$ReturnValue .= "<option value='0'>------------------</option>";

			/*while( $ListValue = $DB->NextRow($result2) ) {

				if($Val == $ListValue['geo_network_country_id']){

					$ReturnValue .= "<option value='".$ListValue['geo_network_country_id']."' selected>".$ListValue['country_name']."</option>";

				}else{

					$Selecteed ="";

					$ReturnValue .= "<option value='".$ListValue['geo_network_country_id']."' ".$Selecteed.">".$ListValue['country_name']."</option>";

				}

				}*/
				if(isset($_POST['FieldValue25']) && $_POST['FieldValue25'] !="" && $_POST['FieldValue25'] !="0"){

					$ReturnValue .= DisplayNetworkCountries($_POST['FieldValue25']);

				}
				else{

					$ReturnValue .= DisplayNetworkCountries($arrLocation['country_id']);
				
				}

				// BACKUP INCASE NOT VALUES FOUND

				$ReturnValue .= "</select></div>";

			}
			else if($groups['fName'] == 'em_85820081128'){

				$linkcode = "";
				if(isset($_POST['em_85820081128']) && $_POST['em_85820081128'] !="0"){

				}

				/* This is a list box */

				// check if there is a field linked to this one
				$Linked = $DB->Row("SELECT fid FROM field WHERE linked_id=".$groups['fid']." limit 1");	

				$LinkedCode = "";
				if(!empty($Linked) && $groups['fName'] !="gender"){

					$LinkedCode ="onChange='eMeetingNetworkCities(this.value, ".$Linked['fid'].",0);'"; $NumLinkedFields++;

				}

				$ReturnValue .= "<div id='Link".$groups['fid']."'>";
				$ReturnValue .= "<select name='FieldValue".$groups['fid']."' $LinkedCode>";

				$ReturnValue .= "<option value='0' selected>------------------</option>";

				// BACKUP INCASE NOT VALUES FOUND

				if(isset($_POST['FieldValue'.$groups['fid']]) && $_POST['FieldValue'.$groups['fid']] !="0" && $_POST['FieldValue'.$groups['fid']] !=""){

					if(isset($_POST['FieldValue25']) && $_POST['FieldValue25'] !="0" && $_POST['FieldValue25'] !=""){
									
						$ReturnValue .= DisplayNetworkStates($_POST['FieldValue25'], $_POST['FieldValue'.$groups['fid']]);

					}
					else{

						$ReturnValue .= DisplayNetworkStates($arrLocation['country_id'], $_POST['FieldValue'.$groups['fid']]);
					}

				}
				else{

					if(isset($_POST['FieldValue25']) && $_POST['FieldValue25'] !="0" && $_POST['FieldValue25'] !=""){
						
						$ReturnValue .= DisplayNetworkStates($_POST['FieldValue25'], $arrLocation['state_id']);

					}
					else{

						$ReturnValue .= DisplayNetworkStates($arrLocation['country_id'], $arrLocation['state_id']);
					}

					
				}

				$ReturnValue .= "</select></div>";

			}
			else if($groups['fName'] == 'location'){

				$linkcode = "";
				if(isset($_POST['location']) && $_POST['location'] !="0"){

				}

				/* This is a list box */

				// check if there is a field linked to this one
				$Linked = $DB->Row("SELECT fid FROM field WHERE linked_id=".$groups['fid']." limit 1");	

				$ReturnValue .= "<div id='Link".$groups['fid']."'>";
				$ReturnValue .= "<select name='FieldValue".$groups['fid']."'>";

				$ReturnValue .= "<option value='0' selected>------------------</option>";

				// BACKUP INCASE NOT VALUES FOUND

				if(isset($_POST['FieldValue54']) && $_POST['FieldValue54'] !="0" && $_POST['FieldValue54'] !=""){

					if(isset($_POST['FieldValue54']) && $_POST['FieldValue54'] !="0" && $_POST['FieldValue54'] !=""){
						
						$ReturnValue .= DisplayNetworkCities($_POST['FieldValue54'], $_POST['FieldValue26']);

					}
					else{

						$ReturnValue .= DisplayNetworkCities($arrLocation['state_id'], $_POST['FieldValue26']);
					}

				}
				else{

					if(isset($_POST['FieldValue54']) && $_POST['FieldValue54'] !="0" && $_POST['FieldValue54'] !=""){
						
						$ReturnValue .= DisplayNetworkCities($_POST['FieldValue54'], $arrLocation['city_id']);

					}
					else{

						$ReturnValue .= DisplayNetworkCities($arrLocation['state_id'], $arrLocation['city_id']);
					}
					
					
				}

				$ReturnValue .= "</select></div>";


			}
			
			else{

				$linkcode = "";
				if($groups['fName'] == "em_85820081128" && $_POST['FieldValue25'] !="0"){
					$linkcode = " AND linked_cap_id = '".$_POST['FieldValue25']."'  ";
				}

				// check if there is a field linked to this one
				$Linked = $DB->Row("SELECT fid FROM field WHERE linked_id=".$groups['fid']." limit 1");	

				if(!empty($Linked) && $groups['fName'] !="gender"){

					$LinkedCode ="onChange='eMeetingLinkedField(this.value, ".$Linked['fid'].",0);'"; $NumLinkedFields++;

				}
				else if($groups['fName'] =="gender"){

					$LinkedCode ="onChange='eMeetingGenderChange(this.value)'";

				}
				else{ $LinkedCode =""; }

				/* This is a list box */									

				$result2 = $DB->Query("SELECT * FROM field_list_value WHERE fvFid = '". $groups['fid'] ."' AND lang='".D_LANG."' ".$linkcode." Order by fvOrder");									

				if($groups['linked_id'] !=0){

					if( $groups['fName'] =="em_85820081128"){
						//$DisplayedLink ="disabled";//
						$DisplayedLink ="";//disabled
					}else{
						$DisplayedLink ="";//disabled
					}
				
				}else{
					$DisplayedLink ="";
				}

				$ReturnValue .= "<div id='Link".$groups['fid']."'><select name='FieldValue".$groups['fid']."' style='".$ValStyle."' tabindex='".$tabcounter."' class='input222' ".$LinkedCode." $DisplayedLink>";

				$ReturnValue .= "<option value='0' selected>------------------</option>";

				$tfO =1;
				while( $ListValue = $DB->NextRow($result2) ) { 			

					if($Val == $ListValue['fvid']){

						$ReturnValue .= "<option value='".$ListValue['fvid']."' selected>".$ListValue['fvCaption']."</option>";

					}else{

						if($ListValue['default'] =="yes"){ $Selecteed ="selected"; }else{$Selecteed ="";  }

						$ReturnValue .= "<option value='".$ListValue['fvid']."' ".$Selecteed.">".$ListValue['fvCaption']."</option>";

					}					

					$tfO++;

				}

				// BACKUP INCASE NOT VALUES FOUND

				if($tfO ==1){

					$result2 = $DB->Query("SELECT * FROM field_list_value WHERE fvFid = '". $groups['fid'] ."' AND lang='english' Order by fvOrder");

					while( $ListValue = $DB->NextRow($result2) )  

					{ 			

						if($ListValue['default'] =="yes"){ $Selecteed ="selected"; }else{$Selecteed ="";  }

						$ReturnValue .= "<option value='".$ListValue['fvid']."' ".$Selecteed.">".$ListValue['fvCaption']."</option>";					

						$tfO++;

					}

				}

				$ReturnValue .= "</select></div>";

				if($groups['fName'] =="gender"){

				$ReturnValue .= "<div id='GenderChanger'></div>";

				}
			}
		}elseif($groups['fType'] == 5){

			$tdC=2;

			$result2 = $DB->Query("SELECT * FROM field_list_value WHERE fvFid = '". $groups['fid'] ."' AND lang='".D_LANG."' Order by fvOrder");

			$ReturnValue .= "<div class='ClearAll'></div><br><table width='100%'  border=0><tr> ";

			while( $ListValue = $DB->NextRow($result2) )  

			{ 

				$newname = $groups['fid']."_".$ListValue['id'];

				if(isset($_POST['FieldValue'.$groups['fid']])){ 

					$Val = "";
					
					if(isset($_POST['FieldValue'.$newname])){

						$Val = $_POST['FieldValue'.$newname];

					}

				}

				else{ $Val = ""; }

				if($Val ==1){ $Val ="checked"; }else{ $Val ="";  }	

				$ReturnValue .= "<td width='25%'><span>";

				$ReturnValue .= "<input type='checkbox' name='FieldValue".$newname."' value='1' class=radio ".$Val." tabindex='".$tabcounter."'>";								

				$ReturnValue .= "<input type='hidden' class='hidden' name='FieldName".$groups['fid']."' value='".$groups['fName']."'>";

				$ReturnValue .= "<input type='hidden' class='hidden' name='FieldType".$groups['fid']."' value='".$groups['fType']."'>";					

				$ReturnValue .= ''.$ListValue['fvCaption'].'';

				if($tdC ==5){ $ReturnValue .= '</tr><tr>'; $tdC=1; }

					$tdC++;

					$NumFields++;								

				}

				$ReturnValue .= "</tr></table>";

			}

			if($groups['fType'] != 5){

				$ReturnValue .= "<input type='hidden' class='hidden' name='FieldName".$groups['fid']."' value='".$groups['fName']."'>";

				$ReturnValue .= "<input type='hidden' class='hidden' name='FieldType".$groups['fid']."' value='".$groups['fType']."'>";

				$NumFields++;

			}

			if(isset($Caption['description']) && $Caption['description'] != ""){

				$ReturnValue .= '<div class="tip">'.$Caption['description'].'</div>';

			}

			$ReturnValue .= '</li>';

			$counter++;

			$tabcounter++;

			$NumFields++;

		}

		if($id ==0){

			$ReturnValue .= "<input name='LinkedRows' type='hidden' value='".$NumLinkedFields."' class='hidden'>";

		}	 

	//if($id !=0){ $ReturnValue = str_replace("< li>","<li>",$ReturnValue);   }

	return $ReturnValue;

}

function MakeDisplayFile($Values){

	global $DB;

	// define variables

	$ReturnValue="";

	$supportedWMVideoTypes = array('wmv','wma');

	switch($Values['type']){	

	case "photo": { $ReturnValue= ReturnDeImage($Values,'full'); } break;

	case "music": {

			$ReturnValue =	'<div id="podcast'.$Values['id'].'">Please install flash.</div>

			<script type="text/javascript">	loadSWFObject('.$Values['id'].', "'.WEB_PATH_MUSIC.$Values['bigimage'].'", "'.DB_DOMAIN.'inc/exe/flash/mp3_player.swf", "400", "200", "6", "#ffffff"); </script>';

			} break;

	case "video": {

		$MINEType= returnMIMEType($Values['bigimage']);

		if(in_array(substr($Values['bigimage'], -3),$supportedWMVideoTypes)){

			$ReturnValue= '<span id="'.$Values['id'].'"></span><script type="text/javascript">	var cnt = document.getElementById("'.$Values['id'].'");	var src = \'newadmin/inc/js/wmvplayer.xaml\';	var cfg = {	file:\''.WEB_PATH_VIDEO.$Values['bigimage'].'\',	height:\'320\',width:\'420\'};	var ply = new jeroenwijering.Player(cnt,src,cfg);</script>';

							//image:\'images/DEFAULT/video_icon.png\',

		}else{

			/*$ReturnValue='<object width="400" height="400" data="'.WEB_PATH_VIDEO.$Values['bigimage'].'" codebase="http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=5,1,52,701"></object>';*/
			$ReturnValue='<video height="auto" class="video-tabs" controls id="Video1" style="width: 100%;">
					<source src="'.WEB_PATH_VIDEO.$Values['bigimage'].'" type="'.$MINEType.'" />
					  Your browser does not support HTML5 video.
					</video>';
	/*$ReturnValue= '<object id="MediaPlayer" width="100%" height="460" classid="CLSID:22d6f312-b0f6-11d0-94ab-0080c74c7e95" codebase="http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=5,1,52,701" style="overflow: hidden;">

    <param name="AudioStream" value="-1">

    <param name="AutoSize" value="0">

    <param name="AutoStart" value="-1">

    <param name="AnimationAtStart" value="0">

    <param name="AllowScan" value="-1">

    <param name="AllowChangeDisplaySize" value="-1">

    <param name="AutoRewind" value="0">

    <param name="Balance" value="0">

    <param name="BaseURL" value="">

    <param name="BufferingTime" value="5">

    <param name="CaptioningID" value="">

    <param name="ClickToPlay" value="-1">

    <param name="CursorType" value="0">

    <param name="CurrentPosition" value="-1">

    <param name="CurrentMarker" value="0">

    <param name="DefaultFrame" value="">

    <param name="DisplayBackColor" value="0">

    <param name="DisplayForeColor" value="16777215">

    <param name="DisplayMode" value="0">

    <param name="DisplaySize" value="4">

    <param name="Enabled" value="-1">

    <param name="EnableContextMenu" value="-1">

    <param name="EnablePositionControls" value="-1">

    <param name="EnableFullScreenControls" value="0">

    <param name="EnableTracker" value="-1">

    <param name="Filename" value="'.WEB_PATH_VIDEO.$Values['bigimage'].'">

    <param name="InvokeURLs" value="-1">

    <param name="Language" value="-1">

    <param name="Mute" value="0">

    <param name="PlayCount" value="1">

    <param name="PreviewMode" value="0">

    <param name="Rate" value="1">

    <param name="SAMILang" value="">

    <param name="SAMIStyle" value="">

    <param name="SAMIFileName" value="">

    <param name="SelectionStart" value="-1">

    <param name="SelectionEnd" value="-1">

    <param name="SendOpenStateChangeEvents" value="-1">

    <param name="SendWarningEvents" value="-1">

    <param name="SendErrorEvents" value="-1">

    <param name="SendKeyboardEvents" value="0">

    <param name="SendMouseClickEvents" value="0">

    <param name="SendMouseMoveEvents" value="0">

    <param name="SendPlayStateChangeEvents" value="-1">

    <param name="ShowCaptioning" value="0">

    <param name="ShowControls" value="-1">

    <param name="ShowAudioControls" value="-1">

    <param name="ShowDisplay" value="0">

    <param name="ShowGotoBar" value="0">

    <param name="ShowPositionControls" value="0">

    <param name="ShowStatusBar" value="-1">

    <param name="ShowTracker" value="0">

    <param name="TransparentAtStart" value="0">

    <param name="VideoBorderWidth" value="0">

    <param name="VideoBorderColor" value="0">

    <param name="VideoBorder3D" value="0">

    <param name="Volume" value="-600">

    <param name="WindowlessVideo" value="0">

    <embed class="embed-responsive embed-responsive-4by3" type="application/x-mplayer2" pluginspage="http://www.microsoft.com/Windows/Downloads/Contents/Products/MediaPlayer/" name="MediaPlayer" src="'.WEB_PATH_VIDEO.$Values['bigimage'].'" showcontrols="1" showpositioncontrols="0" showaudiocontrols="1" showtracker="0" showdisplay="0" showstatusbar="1" showgotobar="0" showcaptioning="0" autostart="1" autorewind="0" animationatstart="0" transparentatstart="0" allowchangedisplaysize="0" allowscan="0" enablecontextmenu="0" clicktoplay="0" width="100%" height="100%"></embed>

				</object>';*/

		}

	} break;

	case "youtube": {

			$file_part = explode("?v=",$Values['bigimage']); $file_part = explode("&",$file_part[1]);	

			$UImage = "//img.youtube.com/vi/".$file_part[0]."/2.jpg";

				if( file_exists('Zend/Loader.php') ){		

					include 'Zend/Loader.php';

					Zend_Loader::loadClass('Zend_Gdata_YouTube');

					$yt = new Zend_Gdata_YouTube();

					$videoEntry = $yt->getVideoEntry($file_part[0]);	

					$videoThumbnails 		=	$videoEntry->getVideoThumbnails();

					$ReturnValue= '<object width="100%" height="344"><param name="movie" value="'.$videoEntry->getFlashPlayerUrl().'"></param><param name="allowFullScreen" value="true"></param><embed src="'.$videoEntry->getFlashPlayerUrl().'" type="application/x-shockwave-flash" allowfullscreen="true" width="100%" height="344"></embed></object>';

				}		

				else {		


$ReturnValue= '<object width="100%" height="344"><param name="movie" value="http://www.youtube.com/v/'.$file_part[0].'"></param><param name="allowFullScreen" value="true"></param><embed src="//www.youtube.com/v/'.$file_part[0].'" type="application/x-shockwave-flash" allowfullscreen="true" width="100%" height="344"></embed></object>';







				}

	} break;

	default: { $ReturnValue= "File Type Not Found"; } break;

	}

 	if(isset($Values['bigimage'])){

	$DB->Update("UPDATE files SET views=views+1 WHERE bigimage='".$Values['bigimage']."' LIMIT 1");

	}

	return $ReturnValue;

}

/**

* Info: Funcions used to get the mime type of a file

* 		

* @version  9.0

* @created  Fri Sep 25 10:48:31 EEST 2008

* @updated  Fri Sep 25 10:48:31 EEST 2008

*/

    function returnMIMEType($filename)

    {

        preg_match("|\.([a-z0-9]{2,4})$|i", $filename, $fileSuffix);

        switch(strtolower($fileSuffix[1]))

        {

            case "js" :

                return "application/x-javascript";

            case "json" :

                return "application/json";

            case "jpg" :

            case "jpeg" :

            case "jpe" :

                return "image/jpg";

            case "png" :

            case "gif" :

            case "bmp" :

            case "tiff" :

                return "image/".strtolower($fileSuffix[1]);

            case "css" :

                return "text/css";

            case "xml" :

                return "application/xml";

            case "doc" :

            case "docx" :

                return "application/msword";

            case "xls" :

            case "xlt" :

            case "xlm" :

            case "xld" :

            case "xla" :

            case "xlc" :

            case "xlw" :

            case "xll" :

                return "application/vnd.ms-excel";

            case "ppt" :

            case "pps" :

                return "application/vnd.ms-powerpoint";

            case "rtf" :

                return "application/rtf";

            case "pdf" :

                return "application/pdf";

            case "html" :

            case "htm" :

            case "php" :

                return "text/html";

            case "txt" :

                return "text/plain";

            case "mpeg" :

            case "mpg" :

            case "mpe" :

                return "video/mpeg";

            case "mp3" :

            	return "audio/mpeg3";

			case "mp4" :

                return "video/mp4";

            case "wav" :

                return "audio/wav";

            case "aiff" :

            case "aif" :

                return "audio/aiff";

            case "avi" :

                return "video/msvideo";

            case "wmv" :

                return "video/x-ms-wmv";

            case "mov" :

                return "video/quicktime";

            case "zip" :

                return "application/zip";

            case "tar" :

                return "application/x-tar";

            case "swf" :

                return "application/x-shockwave-flash";

            default :

            if(function_exists("mime_content_type"))

            {

               $fileSuffix = mime_content_type($filename);

            }

            return "unknown/" . trim($fileSuffix[1], ".");

        }

    }

function BuilderFooterBottom(){

if(TMP_PAGE_FOOTER !=1){ return ""; }  

$TopArticles = DisplayTop10Articles(6);

$TopSignups = DisplayRecentSignups(5);

$TopChanges = RecentMemberActivity(5);

$ReturnValue ="";

$ReturnValue .= '<div id="bottomBar"><div class="col1"><h4>'.$GLOBALS['LANG_COMMON']['24'].'</h4><table width="95%"  border="0" align="center" style="margin-top:10px;">';

foreach($TopChanges as $value){	

$ReturnValue .= '<tr valign="top"><td width="5%" height="51"><a href="'.$value['link'].'"><img src="'.$value['image'].'&x=48&y=48" width="48" height="48" style="float:left; padding-right:10px;"></a>

<td width="95%" valign="top"  style="border-bottom:1px dashed #ffffff;"><span style="font-weight:bold;display:block;font-size:13px;">'.$value['msg'].'</span>

'.ShowTimeSince($value['date']).'</td>';

} 

$ReturnValue .= '</table></div><div class="col2"><h4>'.$GLOBALS['LANG_COMMON'][22].'</h4><ul id="links">';

foreach($TopArticles as $value){	

$ReturnValue .= "<li><a href='".$value['link']."'>".$value['title']."</a></li>";

}

$ReturnValue .= '</ul></div><div class="col3"><h4>'.$GLOBALS['_LANG']['_new'].' '.$GLOBALS['_LANG']['_members'].'</h4><table width="95%"  border="0" align="center" style="margin-top:10px;">';

foreach($TopSignups as $value){	

$ReturnValue .= '<tr valign="top"><td width="5%" height="51"><a href="'.$value['link'].'"><img src="'.$value['image'].'&x=48&y=48" width="48" height="48" style="float:left; padding-right:10px;"></a>

<td width="95%" valign="top"  style="border-bottom:1px dashed #ffffff;"><span style="font-weight:bold;display:block;font-size:13px;">'.$value['username'].' - '.ShowTimeSince($value['created']).'</span>

'.$value['age'].' '.$GLOBALS['_LANG']['_yold'].' / '.$value['country'].'</td>';

} 

$ReturnValue .= '</table></div><div class="clear"></div></div><div class="clear"></div>';

return $ReturnValue;

}

function BuildExtraReturnString($values){

					$ExtraSendData="";

					if(isset($values['eid'])){

					$ExtraSendData .="&eid=".$values['eid'];

					}

					if(isset($values['id'])){

					$ExtraSendData .="&id=".$values['id'];

					}

					if(isset($values['item_id'])){

					$ExtraSendData .="&item_id=".$values['item_id'];

					}

return $ExtraSendData;

}

function GetAttachmentAlbum($aid){

	if(!is_numeric($aid)){ return ""; }

	global $DB;

	$SmallPics=array(); $run=1; $ReturnValue="";

	$SQL = "SELECT files.id AS fid, `default`, type, title, files.uid, files.approved, adult_content, bigimage FROM files WHERE aid='".$aid."' AND type='photo' AND approved='yes' ORDER BY RAND()";

	$result1 = $DB->Query($SQL);

	if(!empty($result1)){		

		while( $pics = $DB->NextRow($result1) ){	

			$SmallPics[$run]['image'] 		= ReturnDeImage($pics,"medium");

			$SmallPics[$run]['bigimage'] 	= $pics['bigimage'];

			$SmallPics[$run]['title'] 		= $pics['title'];

			$run++;

		}

	}

	// build output

	if(!empty($SmallPics)){

		// load lightbox popups

		$ReturnValue.= '<link rel="stylesheet" href="inc/js/lightbox2/css/lightbox.css" type="text/css" media="screen" />	

		<script src="inc/js/lightbox2/js/lightbox.js" type="text/javascript"></script>';

		$ReturnValue.= "<ul class='ItemGallery'>";

			foreach($SmallPics as $Value){

				$ReturnValue.= '<li><a href="'.WEB_PATH_IMAGE.$Value['bigimage'].'" rel="lightbox[gallery]" title="'.eMeetingOutput($Value['title']).'"><img src="'.$Value['image'].'" width="75" height="75" /></a></li>';

			}

		$ReturnValue.= "</ul>";

		}	

	return $ReturnValue;

}

/**

* Info: Funcions used to display a members albums

* 		

* @version  9.0

* @created  Fri Sep 25 10:48:31 EEST 2008

* @updated  Fri Sep 25 10:48:31 EEST 2008

*/

function GetAlbums($id, $selected=""){

	global $DB;

	$ReturnValue="";

    $result = $DB->Query("SELECT aid, title FROM album WHERE uid='".$id."'");

    while( $Data = $DB->NextRow($result) )

    {

		if($Data['aid'] == $selected){

			$ReturnValue .= "<option name='".$Data['aid']."' value='".$Data['aid']."' selected>".eMeetingOutput($Data['title'])."</option>";

		}else{

			$ReturnValue .= "<option name='".$Data['aid']."' value='".$Data['aid']."'>".eMeetingOutput($Data['title'])."</option>";

		}

	}

	## return array

	return $ReturnValue;

}

function CanSeeAdult(){

	if(isset($_SESSION['pack_adult']) && $_SESSION['pack_adult'] =="yes"){

		return "";

	}else{

		return "and adult_content !='yes'";

	}

}

function ModeratorOptions($page, $subpage, $value){

	$FeaturedArray = array('classads','search','calendar');

	## display edit functions for moderators

	if(isset($_SESSION['site_moderator_edit']) && $_SESSION['site_moderator_edit'] =="yes"){

	if($page=="blog"){

		print '<br><a href="#" onclick="EditBlogPost(\''.$value['id'].'\'); return false;">';

	}elseif($page=="search"){

		print '<br><a href="'.getThePermalink('account/edit/').'" style="text-decoration:none">';

	}else{

		print '<br><a href="'.DB_DOMAIN.'index.php?dll='.$page.'&sub=add&eid='.$value['id'].'" style="text-decoration:none">';

	}

	print '<img src="'.DB_DOMAIN.'images/DEFAULT/_acc/wrench.png" align="absmiddle"> &nbsp; '.$GLOBALS['_LANG']['_edit'].' </a>';

	} 

	## display delete functions for moderator

	if( isset($_SESSION['site_moderator_approve']) && $_SESSION['site_moderator_approve']=="yes" && $value['ThisApproved']=="no"){

	print '<span id="Approvediv_'.$value['id'].'"><br><a href="javascript:void(0)" 

	onClick="AdminLiveApprove(\''.$value['id'].'\', \''.$page.'\', \''.$subpage.'\'); 

	Effect.Shake(\'div_'.$value['id'].'\'); Effect.Fade(\'Approvediv_'.$value['id'].'\'); return false;" style="text-decoration:none">

	<img src="'.DB_DOMAIN.'images/DEFAULT/_icons/new/chk_on.png"> &nbsp; '.$GLOBALS['_LANG']['_approve'].' </a></span>';

	 } 

	## display delete functions for moderator

	if( isset($_SESSION['site_moderator_delete']) && $_SESSION['site_moderator_delete']=="yes" ){

	print '<br><a href="javascript:void(0)" onClick="AdminLiveDelete(\''.$value['id'].'\', \''.$page.'\', \''.$subpage.'\');  

	Effect.Fade(\'div_'.$value['id'].'\'); return false;" style="text-decoration:none">

	<img src="'.DB_DOMAIN.'images/DEFAULT/_acc/cancel.png" align="absmiddle"> &nbsp '.$GLOBALS['_LANG']['_delete'].'</a>';

	}

	## display make featured

	if( isset($_SESSION['site_moderator_approve']) && $_SESSION['site_moderator_approve']=="yes" && in_array($page,$FeaturedArray) ){

	if($value['featured'] =="no"){

		print '<br><a href="javascript:void(0)" onClick="AdminLiveFeatured(\''.$value['id'].'\', \''.$page.'\', \''.$subpage.'\');

		Effect.Shake(\'div_'.$value['id'].'\'); return false;" style="text-decoration:none">

		<img src="'.DB_DOMAIN.'images/DEFAULT/_icons/new/thumb_up.png"> &nbsp '.$GLOBALS['_LANG']['_featured'].'</a>';

	}elseif($value['featured'] =="yes"){

		print '<br><a href="javascript:void(0)" onClick="AdminLiveRFeatured(\''.$value['id'].'\', \''.$page.'\', \''.$subpage.'\');

		Effect.Shake(\'div_'.$value['id'].'\'); return false;" style="text-decoration:none">

		<img src="'.DB_DOMAIN.'images/DEFAULT/_icons/new/thumb_down.png"> &nbsp '.$GLOBALS['_LANG']['_remove']." ".$GLOBALS['_LANG']['_featured'].'</a>';	

	}

	}

}

function CheckAdminEmail($page, $subpage, $data, $error=""){
	//echo $page;

	if(substr($error,-3) !="**1"){

		return;

	}
		if(is_array($data)){

			$CUSTOM="";

			foreach($data as $name => $value){ if(!is_numeric($name) && 'name' !="custom"){

				$CUSTOM .= "<p><strong>".$name."</strong> ".$value."</p>";

			} }

		}

	$SendEmail=0; $data['custom']="";

	switch($page){

		case "register": { 

			if(SEMAIL_JOIN =="yes"){

				$data['custom'] .="<h1>".$_SESSION['username']." just created a new account</h1>";



				$CUSTOM = "You can view their updated profile by visiting this link<br>";

				$CUSTOM .= "<a href=".getThePermalink('user',array('username' => $_SESSION['username'])).">".getThePermalink('user',array('username' => $_SESSION['username']))."</a><br><br>";



				$EmailID=16; 

				$SendEmail=1;

			} 

		} break;

		case "account": {

			if(SEMAIL_UPDATE =="yes"){

				$data['custom'] .="<h1>".$_SESSION['username']." has updated their account</h1>";



				$CUSTOM = "You can view their updated profile by visiting this link<br>";

				$CUSTOM .= "<a href=".getThePermalink('user',array('username' => $_SESSION['username'])).">".getThePermalink('user',array('username' => $_SESSION['username']))."</a><br><br>";



				$EmailID=16; 

				$SendEmail=1;

			}

		} break;

		case "blog": {

			if(SEMAIL_BLOG =="yes"){

				$data['custom'] .="<h1>".$_SESSION['username']." Added A New Blog </h1>";

				$EmailID=16; 

				$SendEmail=1;

			}

		} break;

		case "groups": {

			if(SEMAIL_GROUPS =="yes"){

				$data['custom'] .="<h1>".$_SESSION['username']." Added A New Group </h1>";

				$EmailID=16; 

				$SendEmail=1;

			}

		} break;

		case "classads": {

			if(SEMAIL_CLASSADS =="yes"){

				$data['custom'] .="<h1>".$_SESSION['username']." Added A New Classifed Advert </h1>";

				$EmailID=16; 

				$SendEmail=1;

			}

		} break;

		case "calendar": {

			if(SEMAIL_CALENDAR =="yes"){

				$EmailID=16; 

				$SendEmail=1;

			}

		} break;

		case "gallery": {

			if(SEMAIL_FILES =="yes"){

				$data['custom'] .="<h1>".$_SESSION['username']." Uploaded A New File </h1>";

				$EmailID=16; 

				$SendEmail=1;

			}

		} break;

		case "login": {

			if(SEMAIL_LOGIN =="yes"){

				$data['custom'] .="<h1>".$_SESSION['username']." Just Logged In</h1>";

				$EmailID=16; 

				$SendEmail=1;

			}

		} break;

	}

	if($SendEmail ==1){

		// lets email the admin to let them know they have a new signup

		$data['email'] = ADMIN_EMAIL;

		$data['custom'] .= $CUSTOM;

 		$data['custom'] .= "IP: ".$_SERVER['REMOTE_ADDR'];

	 	$data['custom'] .="<p></p><p></p><p>You are recieving this email because you have selected to in the admin settings. </p><p  style='font-size:11px;'> If you dont wish to recieve these emails please login to your admin area and disable this setting under Settings  -> Email Settings.</p>";

//die(print_r($data).SEMAIL_TEMPLATE);

		SendTemplateMail($data, SEMAIL_TEMPLATE);











	global $DB;

	

	$data2 = $DB->Query("SELECT liveEmail, liveEdit, liveDelete, alerts, email FROM members_admin WHERE alerts = 'yes' ");

		

	while( $mydata = $DB->NextRow($data2) )

	{



		$data['email'] = $mydata['email'];

		$data['custom'] .= $CUSTOM;

 		$data['custom'] .= "IP: ".$_SERVER['REMOTE_ADDR'];

	 	$data['custom'] .="<p></p><p></p><p style='font-size:11px;'>You are recieving this email because you have selected to in the admin settings. </p><p  style='font-size:11px;'> If you dont wish to recieve these emails please login to your admin area and disable this setting under Settings  -> Email Settings.</p>";

//die(print_r($data).SEMAIL_TEMPLATE);

		SendTemplateMail($data, SEMAIL_TEMPLATE);





	}











	}

}

function ShowFCIDMEmber($id){

	$ReturnValue ="";

	if(!is_numeric($id)){ return ""; }

	if($id == $_SESSION['uid']){
		
		$GLOBALS['MyProfile'] = (isset($GLOBALS['MyProfile'])) ? $GLOBALS['MyProfile'] : '';
		
		$ThisPersonsNetwork = $GLOBALS['MyProfile'];
		
	}else{

		$ThisPersonsNetwork = MemberAccountDetails($id,false);

	}	
	
	if(!empty($ThisPersonsNetwork)){

	$test_var = D_TEMP;

	//echo "Template is ".$test_var;

	if($test_var == "v17red")

	{

		

	$ReturnValue = '<div class="alert_box_blog" style="">

			<div class="col-xs-3 col-sm-2 col-md-2 col-lg-2">

				<div style="float:left; margin-top:5px; margin-bottom:4px; margin-left:8px;"><img src="'.$ThisPersonsNetwork['image'].'&x=48&y=48" width="48" height="48" class="img_border"  style="float:left;"></div> 

			</div>

				<div class="col-xs-8 col-sm-6 col-md-6 col-lg-6">

					<div style="margin-top:6px; margin-bottom:4px"><b>'.$ThisPersonsNetwork['username'].'</b> '.$ThisPersonsNetwork['status'].' 

					<br>'.$GLOBALS['_LANG']['_joined'].': '.ShowTimeSince($ThisPersonsNetwork['created']).', '.$GLOBALS['_LANG']['_updated'].': '.ShowTimeSince(				$ThisPersonsNetwork['updated']).'</div></div>

			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">   

				<div style="float:right;" class="view_profile_button"><a href="'.DB_DOMAIN.'profile/overview/'.$ThisPersonsNetwork['uid'].'" class="lgn_bttn advandate_btn">  <img src="'.DB_DOMAIN.'images/DEFAULT/_acc/add.png" align="absmiddle">'.$GLOBALS['LANG_COMMON'][11].'</a></div>

		</div></div>';

	

	return $ReturnValue;

	}
		
		$ReturnValue = '<div class="alert_box_blog" style="">

			<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">

				<div class="img_container" style="float:left; margin-top:5px; margin-bottom:4px; margin-left:8px;"><img src="'.$ThisPersonsNetwork['image'].'&x=48&y=48" width="48" height="48" class="img_border"  style="float:left;"></div> 

			</div>

				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

					<div style="margin-top:6px; margin-bottom:4px"><b>'.$ThisPersonsNetwork['username'].'</b> '.$ThisPersonsNetwork['status'].' 

					<br>'.$GLOBALS['_LANG']['_joined'].': '.ShowTimeSince($ThisPersonsNetwork['created']).', '.$GLOBALS['_LANG']['_updated'].': '.ShowTimeSince(				$ThisPersonsNetwork['updated']).'</div></div>

			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">   

				<div style="float:right;" class="view_profile_button"><a href="'.DB_DOMAIN.'profile/overview/'.$ThisPersonsNetwork['uid'].'" class="lgn_bttn advandate_btn">  <img src="'.DB_DOMAIN.'images/DEFAULT/_acc/add.png" align="absmiddle">'.$GLOBALS['LANG_COMMON'][11].'</a></div>

		</div></div>';

	}

	return $ReturnValue;

}

function BuildPageHomeMenu($SubSub_Lang, $page, $mobile="no"){

	if(!empty($SubSub_Lang)){

		print '<ul class="Acc_Heading_List">';

			$i=1; 

			foreach( $SubSub_Lang as $key => $value){ 

					if($page =="account" && $key =="video" && FLASH_VIDEO =="no"){ }

					elseif($page =="account" && $key =="comments" && D_COMMENTS =="0"){ }

					elseif($page =="account" && $key =="design" && D_DESIGNER =="0"){ }

					elseif($page =="settings" && $key =="sms" && UPGRADE_SMS !="yes"){ }

					elseif($page =="mobilesettings" && $key =="sms" && UPGRADE_SMS !="yes"){ }

					elseif($page =="messages" && $key =="wink" && D_WINK ==0){ }

					elseif($page =="mobilemessages" && $key =="wink" && D_WINK ==0){ }

					else{

						if(substr($key,-1,1) !="?" && isset($SubSub_Lang[$key.'_?']) && $SubSub_Lang[$key.'_?'] !="" && $value !=""){ ## hide value if its a help value 



		$mytime=time();



							// print '<li class="s'.$i.'"><a href="index.php?dll='.$page.'&sub='.$key.'&ts='.$mytime.'">'.$value.'<span>'.$SubSub_Lang[$key.'_?'].'</span></a></li>';



if ($mobile == "yes") {

		print '<li class="s'.$i.'"><a href="mobile.php?dll='.$page.'&sub='.$key.'">'.$value.'<span>'.$SubSub_Lang[$key.'_?'].'</span></a></li>';	

}else{

		//print '<li class="s'.$i.'"><a href="index.php?dll='.$page.'&sub='.$key.'">'.$value.'<span>'.$SubSub_Lang[$key.'_?'].'</span></a></li>';	
		print '<li class="s'.$i.'"><a href="'.getThePermalink($page.'/'.$key).'">'.$value.'<span>'.$SubSub_Lang[$key.'_?'].'</span></a></li>';	

}

				





							$i++;

						}

				}

			}

		print '</ul>';

	}

}

function MakeCalendarMonth($month,$full=false){

	switch($month){

		case "01": { $ThisMonth = $GLOBALS['_LANG']['_january']; } break;

		case "02": { $ThisMonth =$GLOBALS['_LANG']['_febuary']; } break;

		case "03": { $ThisMonth =$GLOBALS['_LANG']['_march']; } break;

		case "04": { $ThisMonth =$GLOBALS['_LANG']['_april']; } break;

		case "05": { $ThisMonth =$GLOBALS['_LANG']['_may']; } break;

		case "06": { $ThisMonth =$GLOBALS['_LANG']['_june'];} break;

		case "07": { $ThisMonth =$GLOBALS['_LANG']['_july'];} break;

		case "08": { $ThisMonth =$GLOBALS['_LANG']['_august'];} break;

		case "09": { $ThisMonth =$GLOBALS['_LANG']['_september'];} break;

		case "10": { $ThisMonth =$GLOBALS['_LANG']['_october'];} break;

		case "11": { $ThisMonth =$GLOBALS['_LANG']['_november'];} break;

		case "12": { $ThisMonth =$GLOBALS['_LANG']['_december'];} break;

	}

	## language check

	if(isset($_SESSION['lang']) && $_SESSION['lang'] =="chinese"){

		return $ThisMonth;

	}else{

		if($full){

			return $ThisMonth;

		}else{

			return substr($ThisMonth,0,3);

		}

	}

}

function MakePageNumerDisplay($searchData, $CurrentPage, $videopage=false){

	## count total search data array

	$DataCounter = count($searchData); $totalRows=0;
	

	## find the total search result value

	if($videopage){

	if(isset($searchData[0]['TotalResults'])){ $totalRows = $searchData[0]['TotalResults']; }

	if(isset($searchData[1]['TotalResults'])){ $totalRows = $searchData[1]['TotalResults']; }

	if(isset($searchData[2]['TotalResults'])){ $totalRows = $searchData[2]['TotalResults']; }

	}else{

		if(!isset($searchData[$DataCounter]['TotalResults'])){ $searchData[$DataCounter]['TotalResults']=0; }

		$totalRows = $searchData[$DataCounter]['TotalResults'];

	}	

	## SEARCH NEXT / LAST BUTTONS					

	if($totalRows == SEARCH_PAGE_ROWS){ 

		$GLOBALS['total_pages']=1; 

	}else{

		$GLOBALS['total_pages'] = ceil($totalRows/SEARCH_PAGE_ROWS); 

	}

	## return page numbers

	if($totalRows < SEARCH_PAGE_ROWS){		

		return "<div id='PageNums'><a href='#' class='selected'> ".$GLOBALS['_LANG']['_page']." 1 ".$GLOBALS['_LANG']['_of']." 1 </a></div>";

	}else{

		return PageNumbers($totalRows, $CurrentPage,true);

	}

}	

function StripDomain($var) {

	// COMPARE THE DOMAIN STRING AND REMOVE ANY URL DEPENDENCIES

	$LeftOvers = str_replace("http:","",str_replace("/","",str_replace($_SERVER['HTTP_HOST'],"",DB_DOMAIN)));

	if($var !=$LeftOvers){ return $var; }

}

function MakeLinkMOD($PageData, $which_way="out",$override=0){

	global $DB;

	$PageData= array_filter($PageData);

	$LinkString = "";

	$LinkSeperator = "/";

	//$LinkExt = "/index.html";
	$LinkExt = "/";

	$clearMOD=array();

	$cleanMOD=array();

	$page="";

	$sub="";

	$Val1="";

	$Val2="";

	if(empty($PageData)){ return ""; }

	if(D_MOD_WRITE ==0 ||$override ==1){

		// BUILD NORMAL LINK STYLE

		// REQUIES THREE VARIABLES

		// PAGE

		// SUB PAGE

		// ITEM ID

		/*$LinkString    .= (isset($PageData['page']))	?	"index.php?dll=".strip_tags($PageData['page'])		:'';

		$LinkString    .= (isset($PageData['sub']))		?	"&sub=".strip_tags($PageData['sub'])				:'';

		$LinkString    .= (isset($PageData['id1']))		?	"&item_id=".strip_tags($PageData['id1'])			:'';

		$LinkString    .= (isset($PageData['id2']))		?	"&item2_id=".strip_tags($PageData['id2'])			:'';

		$LinkString    .= (isset($PageData['id3']))		?	"&item3_id=".strip_tags($PageData['id3'])			:''; */

		$LinkString    .= (isset($PageData['page']))	?	"/".strip_tags($PageData['page']):'';

		$LinkString    .= (isset($PageData['sub']))		?	"/".strip_tags($PageData['sub']):'';

		$LinkString    .= (isset($PageData['id1']))		?	"/".strip_tags($PageData['id1']):'';

		$LinkString    .= (isset($PageData['id2']))		?	"/".strip_tags($PageData['id2'])			:'';

		$LinkString    .= (isset($PageData['id3']))		?	"/".strip_tags($PageData['id3']):''; // view files

		// view files

		// PATCH FOR ADMIN WITH 0 ID

		if(!isset($PageData['id1']) && isset($PageData['id2'])){

		$LinkString    .= "&item_id=0"; 

		}

		$mytime=time();

		//$LinkString .= '&ts=';

		//$LinkString .= $mytime;

		return $LinkString;

	}else{

		if($which_way =="in"){

			// THIS IS TAKING AN ARRAY FROM THE URL REQUEST

			// LETS CLEAN THE STRINGS

			$PageData = array_filter($PageData,StripDomain);

			$StoreArray = $PageData;

 			sort($PageData); // reindex the array

			if ( count($PageData) == 1 && strpos($PageData[0], "&") === false) {

				// this is a main ddl page only, no subpage included in the string

				if(strpos($PageData[0], ".") === false && ( $PageData[0] !="index.php" && $PageData[0] != "index.html" ) ){

					// check for username string

					$RSQL = "SELECT id,username FROM members WHERE username = ('".eMeetingInput(trim($PageData[0]))."') LIMIT 1"; 

					$Found = $DB->Row($RSQL);

					if (!empty($Found)){ 

					$PageData['page']="user";

					$PageData['item_id']=$Found['username'];

					/*$PageData['page']="profile";

					$PageData['item_id']=$Found['id'];*/

					}else{ $PageData['page']="index"; }

				}else{

					$PageData['page'] = str_replace("index.php?dll=","",array_shift($PageData));

					$PageData['page'] = str_replace("index.html","",$PageData['page']);

				}

				return $PageData;

			}elseif( count($PageData) == 1 ){

			}else{			

			$PageData = $StoreArray;

				foreach($PageData as $value){

					$innerBits = explode("&",$value);		 

					if($value !="" && $innerBits[0] !=""){

						if($innerBits[1] !=""){

							$innerBits[0] =  str_replace("index.php?dll=","",$innerBits[0]);

							array_push($clearMOD,$innerBits[0]);

							$innerBits[1] = str_replace("sub=","",$innerBits[1]); 

							array_push($clearMOD,$innerBits[1]);

						}else{

							array_push($clearMOD,$value);

						}

					}

				}

				// NOW WE HAVE A CLEAN STRING ARRAY

				if(isset($clearMOD[0]) && strlen($clearMOD[0]) > 1 && $clearMOD[0] !="index.php"){ $cleanMOD['page'] = $clearMOD[0]; }

				if(isset($clearMOD[1]) && $clearMOD[1] !=""){ $cleanMOD['sub'] = $clearMOD[1]; }

				if(isset($clearMOD[2]) && $clearMOD[2] !="" && $clearMOD[2] != str_replace("/","",$LinkExt) ){ $cleanMOD['item_id'] = $clearMOD[2]; }

				return $cleanMOD;

			}

		}else{

			// LETS MAKE A NEW LINK 

			if(isset($PageData['system'])){ // skip auto checker

				if(isset($PageData['sub'])){ $sub.= DB_DOMAIN.$LinkSeperator.$PageData['sub']; }



				if(isset($PageData['id1'])){ $sub.= $LinkSeperator.$PageData['id1']; }

				else { 

					$PageData['id1']  = 1; 

					$sub.= $LinkSeperator.$PageData['id1']; }





				if(isset($PageData['name'])){ $sub.= $LinkSeperator.str_replace(" ","-",str_replace("\'","",$PageData['name'])); }

				## build string

				$LinkString = $PageData['page'].$sub;

				return str_replace("//","/",$LinkString).$LinkExt;

			}	

				$PageData['page'] = (isset($PageData['page'])) ? $PageData['page'] : '';
				$page = str_replace("index.php?dll=","",$PageData['page']);

				$page = str_replace("index","",$page);

				## does the page contain links?

				$pageBits = explode("&sub=",$page);

				if(!empty($pageBits) && $pageBits[0] !=""){					

					if(isset($pageBits[0]) && strlen($pageBits[0]) > 1){ $page = $pageBits[0];  }

					if(isset($pageBits[1]) && strlen($pageBits[1]) > 1){ $sub = $pageBits[1];   $page .=$LinkSeperator;}

				}

				if(isset($PageData['sub'])){ $sub.= $LinkSeperator.$PageData['sub']; }



				if(isset($PageData['id1'])){ $sub.= $LinkSeperator.$PageData['id1']; }

				else { 

					$PageData['id1']  = 0; 

					$sub.= $LinkSeperator.$PageData['id1']; }





				if(isset($PageData['id2'])){ $sub.= $LinkSeperator.$PageData['id2']; }

				if(isset($PageData['id3'])){ $sub.= $LinkSeperator.$PageData['id3']; }

				if(isset($PageData['name'])){ $sub.= $LinkSeperator.StripModLinkBad($PageData['name']); }

				## build string

				$LinkString = $page.$sub;



			 	$FinalLink = DB_DOMAIN.$LinkString.$LinkExt;

				//$mytime=time();

				//$FinalLink .= '?ts=';

				//$FinalLink .= $mytime;

				$FinalLink = str_replace("/&dll=account","/view",$FinalLink);

				//$FinalLink = str_replace("/0","",$FinalLink);
				$FinalLink = str_replace("/0/","/",$FinalLink);

				$FinalLink = str_replace("account/&dll=gallery","gallery/manage",$FinalLink);

				$FinalLink = str_replace("read","inbox",$FinalLink);

				$FinalLink = str_replace("//index.html","/",$FinalLink);

				return $FinalLink;

		}

	}

}

 /**

	 * Info: eMeeting clever settings

	 * 		

	 * @version  8.0

	 * @created  Fri Jan 18 10:48:31 EEST 2008

	 * @updated  Fri Jan 18 10:48:31 EEST 2008

	 */

	function session_clever_defaults() {

		if(MAPS_ID !="" && $_SERVER['REMOTE_ADDR'] !="127.0.0.1" && !isset($_SESSION['clever_ip_country']) ){

			$exe_data = explode(",",ValidateExternalCountry($_SERVER['REMOTE_ADDR']));

			if(isset($exe_data[4])){

			$reg_long=$exe_data[4]; 

			$reg_lat=$exe_data[3]; 

			$reg_country=$exe_data[2]; 

			$reg_code=$exe_data[0];

			$_SESSION['clever_ip_long']	 	= $reg_long;

			$_SESSION['clever_ip_lat'] 		= $reg_lat;

			$_SESSION['clever_ip_country'] 	= $reg_country;

			$_SESSION['clever_ip_country_name'] = GetCountryFromCode($reg_code);

			$_SESSION['clever_ip_code'] 	= $reg_code;

			}else{

			$_SESSION['clever_ip_country'] ="";

			}

		}

	}

	function GetCountryFromCode($Code){

		switch(strtoupper(trim($Code))){

			case "GB": { return "United Kingdom"; } break;

			case "US": { return "United States"; } break;

			case "CA": { return "Canada"; } break;

			case "MX": { return "Mexico"; } break;

			case "SE": { return "Sweden"; } break;

			case "IT": { return "Italy"; } break;

			case "PR": { return "Puerto Rico"; } break;

			case "VI": { return "Virgin Islands, U.S."; } break;

			case "DE": { return "Germany"; } break;

			case "IR": { return "Iran, Islamic Republic of"; } break;

			case "BO": { return "Bolivia"; } break;

			case "FR": { return "France"; } break;

			case "IL": { return "Israel"; } break;

			case "ES": { return "Spain"; } break;

			case "A2": { return "Satellite Provider"; } break;

			case "AR": { return "Argentina"; } break;

			case "BS": { return "Bahamas"; } break;

			case "DM": { return "Dominica"; } break;

			case "BZ": { return "Belize"; } break;

			case "GA": { return "Gabon"; } break;

			case "ZA": { return "South Africa"; } break;

			case "EG": { return "Egypt"; } break;

			case "NA": { return "Namibia"; } break;

			case "ZW": { return "Zimbabwe"; } break;

			case "GH": { return "Ghana"; } break;

			case "CG": { return "Congo"; } break;

			case "MW": { return "Malawi"; } break;

			case "KE": { return "Kenya"; } break;

			case "AO": { return "Angola"; } break;

			case "SL": { return "Sierra Leone"; } break;

			case "LS": { return "Lesotho"; } break;

			case "SC": { return "Seychelles"; } break;

			case "KM": { return "Comoros"; } break;

			case "TZ": { return "Tanzania, United Republic of"; } break;

			case "RW": { return "Rwanda"; } break;

			case "CI": { return "Cote D'Ivoire"; } break;

			case "UG": { return "Uganda"; } break;

			case "SZ": { return "Swaziland"; } break;

			case "BF": { return "Burkina Faso"; } break;

			case "TG": { return "Togo"; } break;

			case "LY": { return "Libyan Arab Jamahiriya"; } break;

			case "SN": { return "Senegal"; } break;

			case "IN": { return "India"; } break;

			case "JP": { return "Japan"; } break;

			case "CN": { return "China"; } break;

			case "VN": { return "Vietnam"; } break;

			case "TH": { return "Thailand"; } break;

		} 

		return $Code;

	}

	 /**

	 * Info: eMeeting default sessions

	 * 		

	 * @version  8.0

	 * @created  Fri Jan 18 10:48:31 EEST 2008

	 * @updated  Fri Jan 18 10:48:31 EEST 2008

	 */

	function session_defaults() {

		$_SESSION['auth'] = "no";

		$_SESSION['uid'] = -1;

		$_SESSION['username'] = 'Guest';

		$_SESSION['cookie'] = 0;

		$_SESSION['remember'] = false;

		$_SESSION['packageid'] = 7;

		$_SESSION['genderid'] = 0;

		$_SESSION['site_moderator']='no';

		$_SESSION['pack_adult']='no';

		return ;

	}

	function setSession(&$values, $remember, $visible, $init = true) {
		//echo "This is set session <br>";
			
		/*

			THIS FUNCTION SETS THE MEMBERS SESSIONS

			ALSO THE MEMBERS IP IS LOGGED WITH DATE AND TIME

		*/
		if(isset($_POST['register']) && VALIDATE_EMAIL ==1 ){
			return;
		}
		global $DB;

	   $_SESSION['uid'] 			= $values['id'];

	   $_SESSION['username'] 		= eMeetingOutput($values['username']);

	   $_SESSION['auth'] 			= "yes";

	   $_SESSION['announcement'] 	= "yes";

	   $_SESSION['packageid'] 		= $values['packageid'];

	   $_SESSION['lastlogin'] 		= $values['lastlogin'];

	   $_SESSION['lang'] 			= $values['Language'];   

	   $_SESSION['remember']		= $remember;

	   $_SESSION['site_moderator'] 	= $values['moderator'];	   

		if($values['moderator'] =="yes"){

		## ADD EXTRA SESSIONS FOR ADMIN MODERATOR

			$data = $DB->Row("SELECT liveEmail, liveEdit, liveDelete FROM members_admin WHERE username='".eMeetingOutput($values['username'])."' LIMIT 1");

			$_SESSION['site_moderator_approve'] = $data['liveEmail'];

			$_SESSION['site_moderator_edit'] 	= $data['liveEdit'];

			$_SESSION['site_moderator_delete'] 	= $data['liveDelete'];

		}

	   // MEMBER ACCOUNT PACKAGE DATA

	   $_SESSION['pack_adult'] 			= isset($values['view_adult']) ? $values['view_adult'] : '';

	   $_SESSION['pack_name'] 			= isset($values['name']) ? $values['name'] : '';

	   $_SESSION['pack_winks'] 			= $values['wink'];

	   $_SESSION['pack_highlight'] 		= $values['Highlighted'];

	   $_SESSION['pack_messages'] 		= $values['maxMessage'];

	   $_SESSION['pack_files'] 			= $values['maxFiles'];

	   $_SESSION['pack_featured'] 		= $values['Featured']; 

	   $_SESSION['genderid'] 			= $values['genderD'];   

	   if ($init) {

		  $session = session_id();	 

	  		if($visible==1){$nv ="no";}else{$nv ="yes";}

			if(is_numeric($values['id']) && $values['id'] !=0){

				$sql = "UPDATE members SET session = '$session', ip = '".$_SERVER['REMOTE_ADDR']."' , lastlogin='".DATE_TIME."' WHERE id = ( '".$values['id']."' ) LIMIT 1";

				$DB->Update($sql);

			}

	   	}

	   	if($_SERVER['PHP_SELF'] != "/mobile.php")
		{
			if(isset($_POST['register']) && VALIDATE_EMAIL ==1 ){}
			else{
			//header("location: ".DB_DOMAIN."index.php");	
			}
		}
		
		return;
	}

	function updateSession($user_id, $package_id) {
		
		global $DB;

		$sql = "SELECT members.activate_code, members_template.header_background AS background, members_template.header_text AS color_text, members_data.gender AS genderD, package.view_adult, package.name, package.wink, package.Highlighted, package.Featured, package.maxMessage, members.moderator, package.maxFiles, members.active, members.id, members.activate_code, members.username, members.packageid, members.lastlogin, members_privacy.Language FROM members INNER JOIN members_privacy ON ( members.id = members_privacy.uid )  LEFT JOIN members_template ON ( members_template.uid = members_privacy.uid ) LEFT JOIN members_data ON ( members.id = members_data.uid ) LEFT JOIN package ON ( members.packageid = package.pid ) WHERE ( members.id = '".$user_id."') LIMIT 1";
				
		$values = $DB->Row($sql);
		
		$_SESSION['uid'] 			= $values['id'];

	   	$_SESSION['username'] 		= eMeetingOutput($values['username']);

	   	$_SESSION['auth'] 			= "yes";

	   	$_SESSION['announcement'] 	= "yes";

		$_SESSION['packageid'] 		= $values['packageid'];

		$_SESSION['lastlogin'] 		= $values['lastlogin'];

		$_SESSION['lang'] 			= $values['Language'];   

		$_SESSION['site_moderator'] 	= $values['moderator'];	   

		if($values['moderator'] =="yes"){

			## ADD EXTRA SESSIONS FOR ADMIN MODERATOR
			$data = $DB->Row("SELECT liveEmail, liveEdit, liveDelete FROM members_admin WHERE username='".eMeetingOutput($values['username'])."' LIMIT 1");

			$_SESSION['site_moderator_approve'] = $data['liveEmail'];

			$_SESSION['site_moderator_edit'] 	= $data['liveEdit'];

			$_SESSION['site_moderator_delete'] 	= $data['liveDelete'];

		}

	   	// MEMBER ACCOUNT PACKAGE DATA

	   	$_SESSION['pack_adult'] 			= isset($values['view_adult']) ? $values['view_adult'] : '';

	   	$_SESSION['pack_name'] 			= isset($values['name']) ? $values['name'] : '';

	   	$_SESSION['pack_winks'] 			= $values['wink'];

	   	$_SESSION['pack_highlight'] 		= $values['Highlighted'];

	   	$_SESSION['pack_messages'] 		= $values['maxMessage'];

	   	$_SESSION['pack_files'] 			= $values['maxFiles'];

	   	$_SESSION['pack_featured'] 		= $values['Featured']; 

	   	$_SESSION['genderid'] 			= $values['genderD'];   

	   	return;
	}

	function checkRemembered($cookie) {

		global $DB;

		if(!isset($cookie['username']) || !isset($cookie['uid'])){

			return;

		}

		$cookie_username = strip_tags(trim($cookie['username']));

		$cookie_userid = strip_tags(trim($cookie['uid']));	

		if (!$cookie_username or !$cookie_userid) return;

		$sql = "SELECT members_data.gender AS genderD, package.view_adult, package.name, package.wink, members.moderator, package.Highlighted, package.Featured, package.maxMessage, package.maxFiles, members.active, members.id, members.activate_code, members.username, members.packageid, members.lastlogin, members_privacy.Language FROM members

					INNER JOIN members_privacy ON ( members.id = members_privacy.uid ) 

					LEFT JOIN package ON ( members.packageid = package.pid )

					LEFT JOIN members_data ON ( members.id = members_data.uid )		

					WHERE (members.username = '".$cookie_username."') LIMIT 1";

		$result = $DB->Row($sql);

		if (!empty($result) ) {

			// update sessions

			   $_SESSION['uid'] 				= $cookie_userid;

			   $_SESSION['username'] 			= eMeetingOutput($result['username']);

			   $_SESSION['auth'] 				= "yes";

			   $_SESSION['remember'] 			= true;

			   $_SESSION['packageid'] 			= $result['packageid'];

			   $_SESSION['lastlogin'] 			= $result['lastlogin'];

			   $_SESSION['lang'] 				= $result['Language']; 

			   $_SESSION['site_moderator'] 		= $result['moderator'];

			   // MEMBER ACCOUNT PACKAGE DATA

				if(isset($values['moderator']) && $values['moderator'] =="yes"){

				## ADD EXTRA SESSIONS FOR ADMIN MODERATOR

					$data = $DB->Row("SELECT liveEmail, liveEdit, liveDelete FROM members_admin WHERE username='".eMeetingOutput($values['username'])."' LIMIT 1");

					$_SESSION['site_moderator_approve'] = $data['liveEmail'];

					$_SESSION['site_moderator_edit'] 	= $data['liveEdit'];

					$_SESSION['site_moderator_delete'] 	= $data['liveDelete'];

				}

 			   $_SESSION['pack_adult'] 			= $result['view_adult'];

			   $_SESSION['pack_name'] 			= $result['name'];

			   $_SESSION['pack_winks'] 			= $result['wink'];

			   $_SESSION['pack_highlight'] 		= $result['Highlighted'];

			   $_SESSION['pack_messages'] 		= $result['maxMessage'];

			   $_SESSION['pack_files'] 			= $result['maxFiles'];

			   $_SESSION['pack_featured'] 		= $result['Featured']; 

			   $_SESSION['genderid'] 			= $result['genderD']; 

		}

		return;

	}

	 /**

	 * Info: eMeeting Strip HTML

	 * 		

	 * @version  8.0

	 * @created  Fri Jan 18 10:48:31 EEST 2008

	 * @updated  Fri Jan 18 10:48:31 EEST 2008

	 */

	function striphtml ($text) {

		$search = array ("'<script[^>]*?>.*?</script>'si",  // Strip out javascript

						 "'<[\/\!]*?[^<>]*?>'si",           // Strip out HTML tags

						 "'([\r\n])[\s]+'",                 // Strip out white space

						 "'&(quot|#34);'i",                 // Replace HTML entities

						 "'&(amp|#38);'i",

						 "'&(lt|#60);'i",

						 "'&(gt|#62);'i",

						 "'&(nbsp|#160);'i",

						 "'&(iexcl|#161);'i",

						 "'&(cent|#162);'i",

						 "'&(pound|#163);'i",

						 "'&(copy|#169);'i",

						 "'&#(\d+);'e");                    // evaluate as php

		$replace = array ("",

						  "",

						  

						  "\"",

						  "&",

						  "<",

						  ">",

						  " ",

						  chr(161),

						  chr(162),

						  chr(163),

						  chr(169),);

		$text = str_replace($search, $replace, $text);

		return $text;

	}

	 /**

	 * Info: eMeeting Input and Output checking

	 * 		

	 * @version  8.0

	 * @created  Fri Jan 18 10:48:31 EEST 2008

	 * @updated  Fri Jan 18 10:48:31 EEST 2008

	 */

	function eMeetingOutput($output, $forceInt = false) 

	{

		 if (is_numeric($output)) 

		  { 

			  return $output; 

		  }	

		if($forceInt){

			$order = array("\r\n", "\n", "\r", "\\r\\n", "\\n", "\\r");

			$replace ="\n";

			$output = str_replace($order, $replace, $output); 

			$haupt = stripslashes(stripslashes($output));

			return $haupt;

		}else{

			$output = striphtml($output);

			if ( function_exists('mb_convert_encoding') ) {

				return @stripslashes(stripslashes($output)); //return @stripslashes(mb_convert_encoding($output,$GLOBALS['_META']['_charset'],"auto"));//"UTF-8"

			}else{

				return @stripslashes(stripslashes($output));

			}

		}			

	}

	function eMeetingInput($input, $forceInt = false) 
	{ 
		global $DB;

		$conVar = mysqli_connect(DB_HOST,DB_USER, DB_PASS);

		  if (is_numeric($input)) 

		  { 
			  return $input; 
		  } 

		## convert the input variable into a MySQL safe string. 

		if (phpversion() >= '4.3.0') {

			if(DB_BASE ==""){ // dont use mysql connection if no mysql is set

						$input = trim(strip_tags($input));
						


			}else{


				$input = is_array($input) ? array_map(mysqli_real_escape_string($conVar, $input)) : mysqli_real_escape_string($conVar, $input);


			}			

		} else {

			$input = mysqli_escape_string($DB->Connection(), $input); 


		} 	  

	return $input; 

	} 

	 /**

	 * Info: eMeeting Menu Bar Dynamic Content

	 * 		

	 * @version  8.0

	 * @created  Fri Jan 18 10:48:31 EEST 2008

	 * @updated  Fri Jan 18 10:48:31 EEST 2008

	 */ 

	function MenuDisplayBox($page,$sub="",$Limit=MATCH_PAGE_ROWS){

		global $DB;

		## define page functions

		$DataArray = array(); $i=1; $DoData=array();

		if($_SESSION['auth'] !="yes"){ return $DataArray; }

		## call page function	

		switch($page){

			case "groups": { // groups page

				$DoData = DisplyRecentGroups($Limit);

				//$linkStr = "index.php?dll=groups&sub=show&gid=[id]";

			} break;

			case "videos": { // videos page

				$DoData = DisplayRecentVideos($Limit);

				//$linkStr = "index.php?dll=videos&sub=view&id=[id]";

			} break;

			case "blog": {

				$DoData =DisplayRecentBlogs($Limit);

			} break;

			case "overview": {  $DoData = DisplayFeaturedMembers(10,4); } break;  

			case "subscribe": {  $DoData = DisplayFeaturedMembers(10,4); } break;  

			case "search": { $DoData = DisplayFeaturedMembers(12,4); } break;

			case "music": { }

			case "account": {  		

			 // search page

				$DoData = DisplayFeaturedMembers($Limit,1);

				//$linkStr = "index.php?dll=profile&pId=[uid]";

			} break;

			case "calendar": { // events page

				$DoData = DisplayRecentEvents($Limit);

				//$linkStr = "index.php?dll=calendar&sub=view&eventid=[id]";

			} break;

			case "games": { // games page


				$DoData = DisplayRecentGames($Limit); 

				//$linkStr = "index.php?dll=games&sub=play&play=[id]";

			} break;

			case "forum": { // forum page

				$DoData = DisplayForumPosts($Limit);

				//$linkStr = 'inc/exe/forum/index.php?&action=vthread&forum=[uid]&topic=[id]" target="ListFrame';

			} break;

			case "gallery": { // photos page

				$DoData = DisplayRecentPhotoAlbums($Limit);

				//$linkStr = "index.php?dll=profile&sub=manage&aid=[id]&pId=[uid]";

			} break;

			case "classads": { // photos page

				$DoData = DisplayRecentAdverts($Limit);

				//$linkStr = "index.php?dll=classads&id=[id]";

			} break;

			case "profile": { // profile page

				switch($sub){

					case "blogview":{ $DoData =DisplayRecentBlogs($Limit); } break;

					case "manage":{ $DoData = DisplayRecentPhotoAlbums($Limit); } break;

					case "viewfile":{ $DoData = DisplayRecentPhotoAlbums($Limit); } break;

					default : { 

						//if(isset($_GET['item_id']) && is_numeric($_GET['item_id'])){			

							if(D_PROFILERATING ==1){

							$DoData = DisplayFeaturedMembers($Limit,3);	

							}else{		

							$DoData = DisplayFeaturedMembers($Limit,1);	

							}

						//}

					} break;

				}

			} break;

			default: {  } break;

		}

		## make data

		if(is_array($DoData)){

			foreach( $DoData as $value){

				//$DoData = @array_map('eMeetingOutput',strip_tags($value));

				$DataArray[$i]['id']  = $value['id'];

				if(isset($value['uid'])){ $DataArray[$i]['uid'] = $value['uid']; }

				if(isset($value['title'])){ $DataArray[$i]['title'] = strip_tags($value['title']); }

				$DataArray[$i]['description'] = substr(strip_tags($value['description']),0,50)."..";

				$DataArray[$i]['image'] = $value['image'];

				if(isset($value['link'])){ $DataArray[$i]['link'] = $value['link']; }

				//$DataArray[$i]['link'] = str_replace("[id]",$value['id'],$linkStr);

				//$DataArray[$i]['link'] = str_replace("[uid]",$value['uid'],$DataArray[$i]['link']);

				$i++;

			}

		}

		## return data

		return $DataArray;

	}

	 /**

	 * Info: eMeeting Comments Box

	 * 		

	 * @version  8.0

	 * @created  Fri Jan 18 10:48:31 EEST 2008

	 * @updated  Fri Jan 18 10:48:31 EEST 2008

	 */

	/*

		PARAMERTS: 

		1: width of display box

		2: page

		3: sub page

		4: user created id

		5: item id

		6: extra id 1

		7: extra id 2

	*/

	function displayCommentsBox($width, $page, $sub, $id1, $id2, $id3, $id4, $show = true, $follow=false, $showamount=20){

	

	if(D_COMMENTS ==1){

		if($id1 ==""){ $id1=0; }

		if($id2 ==""){ $id2=0; }

		global $DB;

		$i=1; $ReturnData="";

		## get comments data

		$CommentsData = DisplayWebsiteComments($page, $sub ,$width, $id1, $id2, $id3, $id4, $follow,$showamount);

		if($follow){

			print '<div id="eMeetingCommentsBox"  style="display:visible;"></div><span id="response_eMeetingComments" class="response_alert"></span>';

		}

		if(!$follow){

				print '<div style="font-size:12px; padding:4px; border-bottom:1px solid #ccc; margin-bottom:20px;"><img src="'.DB_DOMAIN.'images/DEFAULT/_acc/comments.png" align="absmiddle" class="border_radius_none"> '.count($CommentsData).' '.$GLOBALS['_LANG']['_comments'].'</div>';

		}else{

			print "<br>";

		}

		 if(!empty($CommentsData)){ 

				$i=1;	

				foreach($CommentsData as $comment){ 	if(!isset($comment['id'])){ $comment['id']=$i; }

						print '<div class="topic_reply" id="delCom_'.$comment['id'].'" style="';

						if($follow && $comment['ex3_id'] !=0){ print 'margin-left:0px;'; }elseif(D_TEMP=='v17red'){ print 'margin-left:0px;'; }else{ print 'margin-left:-10px;'; }

						if(D_TEMP=='v17red')

						{

							print '"><div class="topic_reply_av">

							<div class="pic50"><a href="'.$comment['link'].'"><img src="'.$comment['image'].'" alt="'.$comment['username'].'"  class="img_border" width="48" height="48" style="margin-left:0px; margin-right:0px;"/></a></div>

							</div>

							<div class="topic_reply_info" style="width:80%;">

							<div class="reply_topic"';

						}

						else

						{

							print '"><div class="topic_reply_av">

							<div class="pic50"><a href="'.$comment['link'].'"><img src="'.$comment['image'].'" alt="'.$comment['username'].'"  class="img_border" width="48" height="48" style="margin-left:0px; margin-right:0px;"/></a></div>

							</div>

							<div class="topic_reply_info" style="width:'.$width.'px;">

							<div class="reply_topic"';

						}

						if($follow && $comment['ex3_id'] !=0){ print 'style="background:#FFDCE0;"'; }

						print '><strong>'.nl2br($comment['comments']).'</strong>

						</div>

						<div class="margin5 grey12">

						<div class="floatl"><a href="'.$comment['link'].'">'.$comment['username'].'</a> posted on '.$comment['date'].' @ '.$comment['time'].' </div>

						<div class="floatr">';

						## display delete functions for owner

						if($_SESSION['uid'] == $comment['uid']){

							print '<a href="javascript:void(0)" onClick="eMeetingCommentsDelete(\''.$page.'\', \''.$comment['id'].'\',\''.$sub.'\'); Effect.Fade(\'delCom_'.$comment['id'].'\'); return false;" style="text-decoration:none"><img src="'.DB_DOMAIN.'images/DEFAULT/_acc/cancel.png" align="absmiddle"> '.$GLOBALS['_LANG']['_delete'].' </a>';

						}

						## display delete functions for moderator

						if( isset($_SESSION['site_moderator_delete']) && $_SESSION['site_moderator_delete']=="yes" ){

							print '<a href="javascript:void(0)" onClick="AdminLiveDelete(\''.$comment['id'].'\', \'comments\', \''.$sub.'\'); Effect.Fade(\'delCom_'.$comment['id'].'\'); return false;" style="text-decoration:none"><img src="'.DB_DOMAIN.'images/DEFAULT/_acc/cancel.png" align="absmiddle"> '.$GLOBALS['_LANG']['_delete'].' </a>';

						}	

						// DISPLAY FOLLOW BOX

						if($follow && $_SESSION['auth'] =="yes"){

						print '<a href="javascript:void(0)" onClick="Effect.toggle(\'FollowDiv'.$i.'\'); ChangeFollowId('.$comment['uid'].',\'followID'.$i.'\'); return false;">Reply to follow</a>';

						}

						print '</div><div class="clear"></div></div></div><div class="clear"></div></div>';

						if($follow){

						print "<div style='display:none;' id='FollowDiv".$i."'><div align='center' style='padding:5px; background:#cccccc;'>

						<form method=\"post\" action=\"index.php\" onsubmit=\"eMeetingComments('@".$comment['username'].": '+eMeetingCommentsForm".$i.".comments.value, 'follow','".$_SESSION['uid']."',eMeetingCommentsForm".$i.".followID".$i.".value,'".str_replace("&x=48&y=48","",str_replace(DB_DOMAIN."inc/tb.php?src=","",$GLOBALS['MyProfile']['image']))."','500','overview','0','99','Please complete all the fields'); return false;\" target=\"_MakeComments\" name=\"eMeetingCommentsForm".$i."\">

						<input type='hidden' name='followID".$i."' id='followID".$i."' value=''>

						<b>Enter Reply:</b></a> <input type='text' name='comments' id='ThisComment".$i."' class='input' style='width:300px;'><input name='' value='Save' type='submit' class='NormBtn'></form> </div> </div>";

						}

					$i++; } 		

		 } 

					if($follow){

					print "<input type='hidden' name='comments' id='ThisComment' value='not used only for value checking' class='hidden'>";

					}

					print '<span id="response_eMeetingCommentsDelete" class="response_alert"></span>';

		## make comments box

		if($_SESSION['auth'] =="yes" && $show == true){

			/*echo "<pre>"; print_r($_SESSION); echo "</pre>";

			echo $show_page;*/

			if(($page == "games") && ($sub == "play"))

			{

				if(D_TEMP=='v17red')

				{

						print '

					<div id="_MakeComments" name="_MakeComments" style="background:#ffffff; border:0px" scrolling="no" frameborder="0"></div>

					<div id="eMeetingCommentsBox"  style="display:visible;">

					<form method="post" action="index.php" onsubmit="eMeetingComments(eMeetingCommentsForm.comments.value, \''.$page.'\',\''.$id1.'\',\''.$id2.'\',\''.get_string_between($GLOBALS['MyProfile']['image'],"src=","&").'\',\''.$width.'\',\''.$sub.'\',\''.$id3.'\',\''.$id4.'\',\''.$GLOBALS['_LANG_ERROR']['_incomplete'].'\'); return false;" target="_MakeComments" name="eMeetingCommentsForm">

					<!--<input name="id1" type="hidden" value="'.$id1.'" class="hidden">

					<input name="id2" type="hidden" value="'.$id2.'" class="hidden">

					<input name="id3" type="hidden" value="'.$id3.'" class="hidden">

					<input name="id4" type="hidden" value="'.$id4.'" class="hidden">-->

					';	

				}

				else

				{

				print '

				<div id="_MakeComments" name="_MakeComments" style="background:#ffffff; height:1px;border:0px" scrolling="no" frameborder="0"></div>

				<div id="eMeetingCommentsBox"  style="display:visible;">

				<form method="post" action="index.php" onsubmit="eMeetingComments(eMeetingCommentsForm.comments.value, \''.$page.'\',\''.$id1.'\',\''.$id2.'\',\''.get_string_between($GLOBALS['MyProfile']['image'],"src=","&").'\',\''.$width.'\',\''.$sub.'\',\''.$id3.'\',\''.$id4.'\',\''.$GLOBALS['_LANG_ERROR']['_incomplete'].'\'); return false;" target="_MakeComments" name="eMeetingCommentsForm">

				<!--<input name="id1" type="hidden" value="'.$id1.'" class="hidden">

				<input name="id2" type="hidden" value="'.$id2.'" class="hidden">

				<input name="id3" type="hidden" value="'.$id3.'" class="hidden">

				<input name="id4" type="hidden" value="'.$id4.'" class="hidden">-->

				';

				}

				$bwidth = $width+60;

			print '<a name="#commentsbox"></a><textarea name="comments" id="ThisComment" style="width:'.$bwidth.'px;height:80px;" class="input textarea_games_page"></textarea>

			<input name="" type="submit" class="NormBtn advandate_btn submit_games_page" value="'.$GLOBALS['_LANG']['_submit'].'"> 

			</form><div class="ClearAll"></div> <hr>

		</div><span id="response_eMeetingComments" class="response_alert"></span>';

			}

			else

			{

				if(D_TEMP=='v17red')

				{

					print '

					<div id="_MakeComments" name="_MakeComments" style="background:#ffffff;border:0px" scrolling="no" frameborder="0"></div>

					<div id="eMeetingCommentsBox"  style="display:visible;">

					<form method="post" action="index.php" onsubmit="eMeetingComments(eMeetingCommentsForm.comments.value, \''.$page.'\',\''.$id1.'\',\''.$id2.'\',\''.get_string_between($GLOBALS['MyProfile']['image'],"src=","&").'\',\''.$width.'\',\''.$sub.'\',\''.$id3.'\',\''.$id4.'\',\''.$GLOBALS['_LANG_ERROR']['_incomplete'].'\'); return false;" target="_MakeComments" name="eMeetingCommentsForm">

					<!--<input name="id1" type="hidden" value="'.$id1.'" class="hidden">

					<input name="id2" type="hidden" value="'.$id2.'" class="hidden">

					<input name="id3" type="hidden" value="'.$id3.'" class="hidden">

					<input name="id4" type="hidden" value="'.$id4.'" class="hidden">-->

					';

				}

				else

				{

					print '

					<iframe id="_MakeComments" name="_MakeComments" style="background:#ffffff; height:1px;border:0px" scrolling="no" frameborder="0"></iframe>

					<div id="eMeetingCommentsBox"  style="display:visible;">

					<form method="post" action="index.php" onsubmit="eMeetingComments(eMeetingCommentsForm.comments.value, \''.$page.'\',\''.$id1.'\',\''.$id2.'\',\''.get_string_between($GLOBALS['MyProfile']['image'],"src=","&").'\',\''.$width.'\',\''.$sub.'\',\''.$id3.'\',\''.$id4.'\',\''.$GLOBALS['_LANG_ERROR']['_incomplete'].'\'); return false;" target="_MakeComments" name="eMeetingCommentsForm">

					<!--<input name="id1" type="hidden" value="'.$id1.'" class="hidden">

					<input name="id2" type="hidden" value="'.$id2.'" class="hidden">

					<input name="id3" type="hidden" value="'.$id3.'" class="hidden">

					<input name="id4" type="hidden" value="'.$id4.'" class="hidden">-->

					';

				}

		$bwidth = $width+60;

			print '<a name="#commentsbox"></a><textarea name="comments" id="ThisComment" style="width:'.$bwidth.'px;height:80px;" class="input textarea_games_page"></textarea>

			<input name="" type="submit" class="NormBtn advandate_btn submit_games_page" value="'.$GLOBALS['_LANG']['_submit'].'"> 

			</form><div class="ClearAll"></div><br> <hr>

		</div><span id="response_eMeetingComments" class="response_alert"></span>';

			}

			

		}

		## display comments code

		print $ReturnData;

		}

	}

/**

* Info: Checks the user is logged in

* 		

* @version  9.0

* @created  Fri Sep 25 , 2008

* @updated  Fri Sep 25  , 2008

*/

function get_string_between($string, $start, $end){

        $string = " ".$string;

        $ini = strpos($string,$start);

        if ($ini == 0) return "";

        $ini += strlen($start);   

        $len = strpos($string,$end,$ini) - $ini;

        return substr($string,$ini,$len);

}

function MustBeLoggedIn($mobile="no"){

   if($_SESSION['auth'] !="yes"){



     if ($mobile == "yes") {

		header("location: ".DB_DOMAIN."mobile.php");	

     }else{

		header("location: ".getThePermalink('login',array('msg' => $GLOBALS['LANG_AJAX']['6'].'**1')));	

     }



   }

}

/**

* Info: This function ads new tags to the database

* 		

* @version  9.0

* @created  Fri Sep 25 , 2008

* @updated  Fri Sep 25  , 2008

*/

function AddTag($page, $keyword){

	global $DB;

	## make an array of tags

   // $DB->Insert("INSERT INTO `tag_cloud` (`page`, `keyword`) VALUES ('".eMeetingInput($page)."', '".eMeetingInput($keyword)."')");

	return;

}

/**

* Info: This function makes the tag cloud

* 		

* @version  9.0

* @created  Fri Sep 25 , 2008

* @updated  Fri Sep 25  , 2008

*/

function MakeCloud($page, $limit=25){

	global $DB;	

  	$ReturnValue = "";

	$randomWords = array();

	$tag_cloud_array = array('music','search','groups','calendar','gallery','videos');

	if(!in_array($page,$tag_cloud_array)){ $page="groups"; } // default page

	## make array for sizes

	srand((float) microtime() * 10000000);

	$input = array("1", "2", "3", "4", "5", "6", "7", "8", "0", "1", "2", "3", "4", "5", "6", "7", "8", "0" );

	$rand_keys = array_rand($input, 6); // 6 is the number of words u want to be different sizes

	## make an array of tags

    $result = $DB->Query("SELECT keyword FROM tag_cloud WHERE page = ( '".strip_tags(trim($page))."' ) GROUP BY keyword ORDER BY RAND() LIMIT ".$limit);

	## make sure its not empty

	if(!empty($result)){

		require_once(	str_replace("func","",dirname(__FILE__))."/classes/class_tags.php"			);

		$cloud = new wordCloud();

		## loop tags

		$tagi=0;

		while( $tag = $DB->NextRow($result) )

		{	

			$cloud->addWord($tag['keyword'], $input[$rand_keys[$tagi]]);

			$tagi++;

		}

		$cloud->addWord(" ",1);

		$myCloud = $cloud->showCloud("array");

		foreach ($myCloud as $key => $value) {

			## make page string

			switch($page){

				case "search":{ $ThisLink="href='javascript:void(0);' onClick=\"DoTagSearch('".$value['word']."');return false;\""; } break;

				case "groups":{ $ThisLink="href='index.php?do_page=groups&sub=search&keyword=".$value['word']."'"; } break;

				case "calendar":{ $ThisLink="href='index.php?do_page=calendar&sub=events&keyword=".$value['word']."'"; } break;

				case "gallery":{ $ThisLink="href='index.php?do_page=gallery&sub=search&gid=2&keyword=".$value['word']."'"; } break;

				case "music":{ $ThisLink="href='index.php?do_page=music&sub=search&gid=2&keyword=".$value['word']."'"; } break;

			}

			$ReturnValue .= ' <a '.$ThisLink.' style="font-size: 1.'.$value['sizeRange'].'em">'.$value['word'].'</a> &nbsp;';

		}

	}

	## return string

	return $ReturnValue;

}

/**

* Info: Adds an event log to the database to follow members activities

* 		

* @version  9.0

* @created  Fri Sep 25 , 2008

* @updated  Fri Sep 25  , 2008

*/

function AddEventSystemLog($username,$type, $page="", $sub="", $value1="", $value2="",$value3=""){

	global $DB;	

	if($page !=""){

		$DB->Insert("INSERT INTO `system_log` (`username` , to_uid, `date` ,`time` ,`value` , value2, `ip` ,`type`,page, sub) 

		VALUES ('".eMeetingInput($username)."', '".$value1."', '".DATE_NOW."', '".TIME_NOW."', '".eMeetingInput($value2)."' , '".eMeetingInput($value3)."', '".$_SERVER['REMOTE_ADDR']."', '".eMeetingInput($type)."','".$page."','".$sub."')");

	}

}

/**

* Info: Gets the Meta Tags for the viewing page

* 		

* @version  9.0

* @created  Fri Sep 25 , 2008

* @updated  Fri Sep 25  , 2008

*/

function GetMetaTags($page, $sub, $defaultTitle="", $data="", $homePage=false){

	// die(print_r($data));

	global $DB;

	$Meta_Data =array();

	// home page detection

	if($homePage){

		$Meta_Data['title'] 		= HOME_TITLE;

		$Meta_Data['description'] 	= HOME_DESC;

		$Meta_Data['keywords']		= HOME_KEYWORDS;

		return $Meta_Data;

	}

	//set the length of keywords you like

	$meta['title'] ="";

	$meta['description'] ="";

	$meta['content'] ="";

	$meta['min_word_length'] = 3;  //minimum length of single words

	$meta['min_word_occur'] = 1;  //minimum occur of single words

	$meta['min_2words_length'] = 3;  //minimum length of words for 2 word phrases

	$meta['min_2words_phrase_length'] = 10; //minimum length of 2 word phrases

	$meta['min_2words_phrase_occur'] = 2; //minimum occur of 2 words phrase

	$meta['min_3words_length'] = 3;  //minimum length of words for 3 word phrases

	$meta['min_3words_phrase_length'] = 10; //minimum length of 3 word phrases

	$meta['min_3words_phrase_occur'] = 2; //minimum occur of 3 words phrase

	// AUTO CREATE DESCRIPTION KEYWORDS

	if(isset($data)){

		if(isset($data['username']) && $page !="profile"){			 

			$meta['title'] .= $data['username']." - ";

		}

		if(isset($data['name'])){

			if(strlen($defaultTitle) > 1){ $defaultTitle = $defaultTitle." - "; }

			if($page =="profile"){

			$meta['title'] .= $data['username']." - ";

			}else{

			$meta['title'] .= $data['name']." - ";

			}

		}

		if(isset($data['title'])){

			$defaultTitle="";

			$meta['title'] .= $data['title'];

		}

		if(isset($data['headline'])){

			$meta['title'] .= $data['headline'];

		}

		if(isset($data['comments'])){

			$meta['content'] 	 .= strip_tags($data['comments']);

			$meta['description'] .= strip_tags(substr($data['comments'],0,255));

		}

		if(isset($data['description'])){

			$meta['content'] 		.= strip_tags($data['description']);

			$meta['description'] 	.= strip_tags(substr($data['description'],0,255));

		}		

		if(isset($data['desc']) && strlen($data['desc']) > 10 ){

			$meta['content'] 		.= strip_tags($data['desc']);

			$meta['description'] 	.= strip_tags(substr($data['desc'],0,255));

		}		

		// CREATE TAGS FROM VIDEO TAGS

		if(isset($data['tags']) && strlen($data['tags']) > 10 ){

			$meta['keywords'] = $data['tags'];

		}

	}

	// MAKE  KEYWORD OUTPUT

	if(strlen($meta['content']) > 10 && !isset($Meta_Data['keywords'])){

		if(function_exists('mb_internal_encoding')){

			$keyword = new autokeyword($meta, $GLOBALS['_META']['_charset']);//"utf-8"

			$Meta_Data['keywords'] 		= trim($keyword->get_keywords());

		}

	}else{

	}
	
	$page_data = $DB->Row("SELECT * FROM template_pages WHERE name = '$page'");
	
	
	$Meta_Data['keywords']		= SEO_PREFIX_KEYWORDS.$Meta_Data['keywords'] = HOME_KEYWORDS;

	if(isset($page_data['keywords']) && $page_data['keywords'] != ""){
		$Meta_Data['keywords'] = $page_data['keywords'];
	}
	
	$Meta_Data['title'] 		= SEO_PREFIX_TITLE.trim($defaultTitle .$meta['title']);
	if(isset($page_data['title']) && $page_data['title'] != ""){
		$Meta_Data['title'] = $page_data['title'];
	}
	$Meta_Data['description'] 	= SEO_PREFIX_DESC.trim($meta['description']);

	if(isset($page_data['description']) && $page_data['description'] != ""){
		$Meta_Data['description'] = $page_data['description'];
	}

	// CHECK FOR BLANKS

	if($Meta_Data['title'] ==""){ $Meta_Data['title'] = HOME_TITLE; }

	if($Meta_Data['description'] ==""){ $Meta_Data['description'] = HOME_DESC; }

	if($Meta_Data['keywords'] ==""){ $Meta_Data['keywords'] = HOME_KEYWORDS; }

	return $Meta_Data;

}

/**

* Info: Displays at the top of the member pages, displays the recent activity bar

* 		

* @version  9.0

* @created  Fri Sep 25 , 2008

* @updated  Fri Sep 25  , 2008

*/

function RecentMemberActivity($limit=10,$extra="AND s.type !='logout'",$startsLimit=0){

	global $DB;

	## define variables

	$dd=array(); $count=1; $msgString =array();

	## create array of message strings

	$msgString[1] = $GLOBALS['LANG_GLO_OPTIONS']['23'];

	$msgString[2] = $GLOBALS['LANG_GLO_OPTIONS']['24'];

	$msgString[3] = $GLOBALS['LANG_GLO_OPTIONS']['25'];

	$msgString[4] = $GLOBALS['LANG_GLO_OPTIONS']['26'];

	$msgString[5] = $GLOBALS['LANG_GLO_OPTIONS']['27'];

	$msgString[6] = $GLOBALS['LANG_GLO_OPTIONS']['28'];

	$msgString[7] = $GLOBALS['LANG_GLO_OPTIONS']['29'];

	$msgString[8] = $GLOBALS['LANG_GLO_OPTIONS']['30'];

	$msgString[9] = $GLOBALS['LANG_GLO_OPTIONS']['31'];

	$msgString[10] = $GLOBALS['LANG_GLO_OPTIONS']['32'];

	$msgString[11] = $GLOBALS['LANG_GLO_OPTIONS']['33'];

	$msgString[12] = $GLOBALS['LANG_GLO_OPTIONS']['34'];

    $result = $DB->Query("SELECT s.* FROM system_log s, members m WHERE m.username = s.username AND m.active='active' AND m.visible = 'yes' AND m.activate_code='OK' AND s.username !='' AND s.value !='' $extra GROUP BY s.date,s.username,s.type,s.value2 ORDER BY s.id DESC LIMIT ".$startsLimit.",".$limit);

    while( $Data = $DB->NextRow($result) )

    {

		$result1 = $DB->Row("SELECT files.uid, files.adult_content, files.approved, files.bigimage,files.aid, files.type FROM files, members WHERE files.uid = members.id AND members.username= ( '".$Data['username']."' ) AND files.type='photo' AND files.default LIKE '%1%' LIMIT 1");

		$dd[$count]['username'] 	= $Data['username'];

		$dd[$count]['date'] 		= $Data['date']." ".$Data['time'];

		$dd[$count]['time'] 		= $Data['time'];

		$dd[$count]['ip'] 			= $Data['ip'];

		$dd[$count]['to_uid'] 		= $Data['to_uid'];

		$dd[$count]['value'] 		= $Data['value'];

		$dd[$count]['type'] 		= $Data['type'];

		$dd[$count]['id'] 			= $result1['uid'];

		$dd[$count]['page'] 		= $Data['page'];

		$dd[$count]['sub'] 			= $Data['sub'];

		$dd[$count]['image'] 		= ReturnDeImage($result1,"small");

		/*if(D_MOD_WRITE ==1){

			$dd[$count]['link'] 	=	DB_DOMAIN.$Data['username'];

		}else{

			$dd[$count]['link'] 	=	"index.php?dll=profile&pUsername=".$Data['username'];

		}*/

		$dd[$count]['link'] = getThePermalink('user',array('username' => $Data['username']));	

		$BuildMsgString = "<a href='".$dd[$count]['link']."'>".$Data['username']."</a> ";

		if(substr($Data['type'],0,8) =="comment_"){$Data['type']="comment"; } 

		## determin the log type

		switch($Data['type']){

			# comments

			case "comment": { 



				if($Data['page'] =="articles"){ 

					$BuildMsgString .= $msgString[5];				

					$BuildMsgString .= " <a href='".getThePermalink($Data['page'].'/'.$Data['sub'].'/'.$Data['value'])."#commentsbox'><b> an article </b></a>";

				}elseif($Data['sub'] =="viewfile"){ 

					$BuildMsgString .= $msgString[3];

					$BuildMsgString .=  " <a href='".getThePermalink('profile/viewfile/'.$Data['to_uid'].'/0/'.$Data['value'])."#commentsbox'> ".GetUsername($Data['to_uid'])."</a>"; //&aid=4

				}elseif($Data['sub'] == "blogview"){

					$BuildMsgString .= $msgString[4];						

					$BuildMsgString .= " <a href='".getThePermalink('profile/blogview/'.$Data['to_uid'].'/'.$Data['value'])."#commentsbox'><b> ".$Data['value2']."</b></a>";

				}else{

					$BuildMsgString .= $msgString[5];				

					$BuildMsgString .= " <a href='".getThePermalink($Data['page'].'/'.$Data['sub'].'/'.$Data['value'])."#commentsbox'><b> ".GetUsername($Data['to_uid'])."</b></a>";						

				}

			} break;

		## -------------------> END COMMENTS

			case "login": { 

				$BuildMsgString .= $msgString[6]; 

			} break;

			case "updated": { 

				$BuildMsgString .= $msgString[7];

			} break;

			case "file_add": { 

				$BuildMsgString .= $msgString[8];

				if($Data['value2'] !="" ){ 

						$BuildMsgString .= "<a href='".getThePermalink('profile/viewfile',array('pId' => $Data['to_uid'], 'lid' => $Data['value']))."'><img src='".DB_DOMAIN."inc/tb.php?src=".$Data['value2']."&x=48&y=48' width='48' height='48' align='absmiddle'></a>";

				}

			} break;

			case "file_default": { 

				$BuildMsgString .= $msgString[9];

				if($Data['value'] !="" ){ 

						$BuildMsgString .= "<a href='".getThePermalink('user',array('username' => $Data['username']))."'><img src='".DB_DOMAIN."inc/tb.php?src=".$Data['value']."&x=48&y=48' width='48' height='48' align='absmiddle'></a>";

				}

			} break;

			case "event_attending": { 

				$BuildMsgString .= $msgString[10]; 

				$BuildMsgString .= "<a href='".getThePermalink('calendar/view',array('eventid' => $Data['value']))."'><b>".$Data['value2']."</b></a>";						

			} break;

			case "group_add": { 

				$BuildMsgString .= $msgString[11]; 

				$BuildMsgString .= "<a href='".getThePermalink('groups/show',array('gid' => $Data['value']))."'><b>".$Data['value2']."</b></a>";						

			} break;

			case "status": { 

				$BuildMsgString .= $msgString[12]; 

				$BuildMsgString .= "<a href='".getThePermalink('user',array('username' => $Data['username']))."'><b>".$Data['value']."</b></a>";						

			} break;

		}

		## store string

		$dd[$count]['msg'] = $BuildMsgString;//."-".$dd[$count]['page']." - ".$dd[$count]['sub'];

		$count++;

	}

	return $dd;

}

/**

* Info: Displays on the menu bar

* 		

* @version  9.0

* @created  Fri Sep 25 , 2008

* @updated  Fri Sep 25  , 2008

*/

function Build_HeaderAlertsBar(){

	global $DB;

	if($_SESSION['auth'] !="yes"){

		return "";

	}else{

	## define variables

	$AlertArray = array();	$NewArray=array(); $NoFlashingAlert=0; $Counter=1; $Box3Text=""; $ModeratorBox="";

	$SQL = "select row_num from 

		(

			SELECT count(mailnum) AS row_num FROM messages WHERE mail2id='".$_SESSION['uid']."' AND mailstatus='unread' AND to_box='inbox' AND messages.type != 'wink'

			union ALL

			SELECT count(uid) AS row_num FROM members_network n, members m WHERE m.id = n.uid AND m.active = 'active' AND visible = 'yes' AND n.to_uid='".$_SESSION['uid']."'  AND (n.type=2 OR n.type=4) AND n.approved !='yes'

			union ALL

			SELECT count( from_uid ) AS row_num FROM comments c, members m WHERE c.to_uid='".$_SESSION['uid']."'

			AND c.approved != 'yes' and c.from_uid = m.id

			union ALL

			SELECT count(mailnum) AS row_num FROM messages WHERE mail2id='".$_SESSION['uid']."' AND mailstatus='unread' AND to_box='inbox' AND messages.type = 'wink'

		) as derived_table";

	$Data = $DB->Query($SQL);

	## loop data from query

 	while( $DataArray = $DB->NextRow($Data) ){

		$AlertArray[$Counter]['total'] = $DataArray['row_num']; 

		$Counter++;

	}		

	## check values

	/*if($AlertArray[1]['total'] > 0){

			$Box3Text .= "<span class='alert_msg_outspan'><img src='".DB_DOMAIN."images/DEFAULT/_acc/email.png' align='absmiddle'> <a href='".DB_DOMAIN."index.php?dll=messages&sub=inbox' style='color:white;text-decoration:none;'>".$GLOBALS['LANG_SETTINGS']['a19']."</a></span> <br>";

	}

	if($AlertArray[2]['total'] > 0){

			$Box3Text .= "<span class='alert_msg_outspan'><img src='".DB_DOMAIN."images/DEFAULT/_icons/new/user_green.png' align='absmiddle'> <a href='".DB_DOMAIN."index.php?dll=search&friendid=".$_SESSION['uid']."&displaytype=detail'  style='color:white;text-decoration:none;'>".$GLOBALS['LANG_SETTINGS']['a23']."</a></span> <br>";

	}

	if($AlertArray[3]['total'] > 0){

			$Box3Text .= "<span class='alert_msg_outspan'><img src='".DB_DOMAIN."images/DEFAULT/_acc/comments.png' align='absmiddle'> <a href='".DB_DOMAIN."index.php?dll=account&sub=comments' style='color:white;text-decoration:none;'>".$GLOBALS['_LANG']['_new']." ".$GLOBALS['_LANG']['_comments']."</a></span><br>";

	}

	if($AlertArray[4]['total'] > 0){

			$Box3Text .= "<span class='alert_msg_outspan'><img src='".DB_DOMAIN."images/DEFAULT/_acc/emoticon_tongue.png' align='absmiddle'> <a href='".DB_DOMAIN."index.php?dll=messages&sub=wink' style='color:white;text-decoration:none;'>".$GLOBALS['_LANG']['_new']." ".$GLOBALS['_LANG']['_wink']."</a></span><br>";

	}*/

	## build alert box

	if($Box3Text !=""){

		$Box3Text =  '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><div class="message-bad" id="NewAlertsBar" style="line-height:30px;">'.$Box3Text.'</div> </div><script type="text/javascript" language="javascript">Effect.Pulsate("NewAlertsBar", { pulses : 6, duration : 8, from : 0}); </script>';

		if(D_BLINK_SOUND ==1){

			$Box3Text .= '<embed name="Alertsound" src="'.DB_DOMAIN.'inc/exe/IM/inc/sounds/doorbell.mp3" loop="false" hidden="true" autostart="true" ></embed>';

		}

	}

	## DISPLAY ADMIN MODERATOR BAR

	if(isset($_SESSION['site_moderator']) && $_SESSION['site_moderator']  =="yes"){

		if(!isset($_SESSION['site_moderator_approve']) || $_SESSION['site_moderator_approve']==""){$_SESSION['site_moderator_approve']="no"; }

		if(!isset($_SESSION['site_moderator_edit']) || $_SESSION['site_moderator_edit']==""){$_SESSION['site_moderator_edit']="no"; }

		if(!isset($_SESSION['site_moderator_delete']) || $_SESSION['site_moderator_delete']==""){$_SESSION['site_moderator_delete']="no"; }

		$ModeratorBox = '<div class="side_left_blog col-xs-12 col-sm-6 col-md-12 col-lg-12"> 
		
		<div class="message-good" id="menu-message-good" style="text-align:left;line-height:30px;">

		<ul style="padding:0px; margin:0px; margin-top:0px;">

		<li><img src="'.DB_DOMAIN.'images/DEFAULT/_icons/new/user_green.png" align="absmiddle">'.$GLOBALS['_LANG']['_mod1'].'</li>

		<li><img src="'.DB_DOMAIN.'images/DEFAULT/_icons/new/chk_'.$_SESSION['site_moderator_approve'].'.png" align="absmiddle">'.$GLOBALS['_LANG']['_mod2'].'</li>

		<li><img src="'.DB_DOMAIN.'images/DEFAULT/_icons/new/chk_'.$_SESSION['site_moderator_edit'].'.png" align="absmiddle">'.$GLOBALS['_LANG']['_mod3'].'</li>

		<li><img src="'.DB_DOMAIN.'images/DEFAULT/_icons/new/chk_'.$_SESSION['site_moderator_delete'].'.png" align="absmiddle">'.$GLOBALS['_LANG']['_mod4'].'</li>

		</ul>

		</div>
		
		</div>';

	}

	$AlertArray[5]['total'] = $Box3Text;

	$AlertArray[5]['admin'] = $ModeratorBox;

	return $AlertArray;

	}

}

/**

* Info: Displays the footer styles for all templates

* 		

* @version  9.0

* @created  Fri Sep 25 , 2008

* @updated  Fri Sep 25  , 2008

*/

function Build_FooterScripts($page,$WINK_MESSAGE_ARRAY, $ImData, $mobile){

	$ReturnData = "";	

	## display copyright bar



if ($mobile == 'yes') {

		$ReturnData .='<div id="copyright_bar2"><b><a href="'.DB_DOMAIN.'">&copy; '.date('Y').' - '.D_CCTEXT.'</a> </b>';

} else {

		$ReturnData .='<div id="copyright_bar"><b><a href="'.DB_DOMAIN.'">&copy; '.date('Y').' - '.D_CCTEXT.'</a> </b>';



}





		if(BRAND_ID ==""){

		$ReturnData .='-  <img src="'.DB_DOMAIN.'images/advandate.png" align="absmiddle" alt="iCupid Dating Software"><a href="https://www.advandate.com/" alt="Dating Software by AdvanDate, LLC" target="_blank">Dating Software Powered by AdvanDate, LLC</a>';

		}

		$ReturnData .='</div>';

	## displays the quick chat box

	$ReturnData .='<div id="QuickBox1" style="display:none;"><FORM onsubmit="return checkContact(\''.$GLOBALS['_LANG']['_msgSent'].'\');"><input type="hidden" id="MsgIDStore" name="MsgIDStore" value="0"><DIV id=contact-form class=contact-form><a id=cform-hide title="Close Contact Form" href="javascript:void(0);" onclick="new Lightbox.base(\'QuickBox1\', { externalControl : \'cancel_link\' }); return false;" >Close Contact Form</a><DIV class=bg><DIV class=inner><DL><DT><LABEL><span id="MsgImPhoto"></span></LABEL> <DD>'.str_replace("%s",'<span id="MsgNameHere"></span>',$GLOBALS['_LANG_ERROR']['_AlertQuickMsg']).'<DT><LABEL>'.$GLOBALS['_LANG']['_message'].' <span id="MsgIDError" style="color:red;"></span></LABEL><DD>';

	// opera browser fix

	if ( strpos($_SERVER['HTTP_USER_AGENT'], 'Opera') ){

	$ReturnData .='<input type="text" name="ImSendMessage" cols=10 rows=3 class="input" id="ImSendMessage" style="width:230px; height:100px;">';

	}else{

	$ReturnData .='<textarea name="ImSendMessage"  class="input" id="ImSendMessage" style="width:230px; height:100px;" cols=10 rows=3></textarea>';

	}

	$ReturnData .='</DD></DL><P class=button><INPUT value="'.$GLOBALS['_LANG']['_send']." ".$GLOBALS['_LANG']['_message'].'"  type="submit" class="MainBtn"></P></DIV></DIV></DIV></FORM></div>';

	## displays the quick wink box

	
if(!empty($ThisPersonsNetwork)){

	$test_var = D_TEMP;

	//echo "Template is ".$test_var;

	if($test_var == "v17red")
	{

	$ReturnData .='<div id="lightbox_wink" class="lightbox_outer"><div id="QuickBox2" style="display:none;"><FORM onsubmit="return checkWink(\''.$GLOBALS['_LANG']['_msgSent'].'\');"><input type="hidden" id="MsgIDStore" name="MsgIDStore" value="0"><DIV id=contact-form class=contact-form><a id=cform-hide title="Close" href="javascript:void(0);" onclick="new Lightbox.base(\'QuickBox2\', { externalControl : \'cancel_link\' }); return false;" >Close</a> <input type="hidden" id="SendWinkStore" name="SendWinkStore" value="0"><input type="hidden" id="SendWinkStoreUsername" name="SendWinkStoreUsername" value="0"><DIV class=bg1><DIV class=inner><DL><DT><LABEL><span id="WinkImPhoto"></span></LABEL> <DD> '.str_replace("%s",'<span id="WinkNameHere"></span>',$GLOBALS['_LANG_ERROR']['_AlertQuickWink']).'<DT><LABEL>'.$GLOBALS['_LANG']['_message'].' <span id="WinkIDError"  style="color:red;"></span></LABEL> <DD><select name="winkmsg" id="winkmsg" class="input">'; 

	foreach($WINK_MESSAGE_ARRAY as $key => $item){ $ReturnData .= "<option value='".$key."'>".$item."</option>";} $ReturnData .= '</select></DD></DL><P class=button><INPUT value="Send Message"  type="submit" class="MainBtn"></P></DIV></DIV></DIV></FORM></div></div>';

	}
}

	else

	{

			$ReturnData .='<div id="lightbox_wink" class="lightbox_outer"><div id="QuickBox2" style="display:none;position: fixed;top: 50%; margin-top: -180px; left: -376px;margin-left: 50%;z-index:1033;"><form onsubmit="return checkWink(\''.$GLOBALS['_LANG']['_msgSent'].'\');"><input type="hidden" id="MsgIDStore" name="MsgIDStore" value="0"><DIV id=contact-form class=contact-form><a id=cform-hide title="Close" href="javascript:void(0);" onclick="document.getElementById(\'QuickBox2\').style.display=\'none\'; return false;" >Close</a> <input type="hidden" id="SendWinkStore" name="SendWinkStore" value="0"><input type="hidden" id="SendWinkStoreUsername" name="SendWinkStoreUsername" value="0"><DIV class=bg1><DIV class=inner><DL><DT><LABEL><span id="WinkImPhoto"></span></LABEL> <DD> '.str_replace("%s",'<span id="WinkNameHere"></span>',$GLOBALS['_LANG_ERROR']['_AlertQuickWink']).'<DT><LABEL>'.$GLOBALS['_LANG']['_message'].' <span id="WinkIDError"  class="responce_alert2" style="display:none;"></span></LABEL> <DD><select name="winkmsg" id="winkmsg" class="input">'; 

	foreach($WINK_MESSAGE_ARRAY as $key => $item){ $ReturnData .= "<option value='".$key."'>".$item."</option>";} $ReturnData .= '</select></DD></DL><P class=button><INPUT value="Send Message"  type="submit" class="MainBtn"></P></DIV></DIV></DIV></FORM></div></div>';

	}





	## opens admin welcome message

	//if(isset($_GET['lim']) )
	if(!isset($_GET['sub']) && $page=="overview"){

	$msgAdmin = DisplayAdminMsg();	

		if($msgAdmin['display'] =="yes"){

			//$ReturnData .='<div id="QuickBox3" style="display:none;"><FORM><DIV id=contact-form class=contact-form><a id=cform-hide title="Close Contact Form" href="javascript:void(0);" onclick="new Lightbox.base(\'QuickBox3\', { externalControl : \'cancel_link\' }); return false;" >Close Window</a> <DIV class=bg><DIV class=inner>  <p><b>'.$msgAdmin['title'].'</b></p> <p>'.$msgAdmin['content'].'</p></DIV></DIV></DIV></FORM></div>';
			if(isset($_SESSION['announcement'])){
				
				$ReturnData .='<div id="QuickBoxAdmin" style="display:none;max-width:500px;">
				<FORM>
				<div id="contact-form class=contact-form">
				<div class="announcement-header message-bad"><h2>'.$msgAdmin['title'].'</h2></div>
				<div class="announcement-body"><p>'.$msgAdmin['content'].'</p></div>
				<div class="announcement-footer"><input class="fancybox-btn message-bad" type="button" name="close" onClick="jq.fancybox.close();" value="Close"/></div>
				</div></FORM></div>';
				
				unset($_SESSION['announcement']);

			}
		}

	}

	## applies javascript for the above

   $ReturnData .='<script src="'.DB_DOMAIN.'inc/js/_eMeetingFooter.js" type="text/javascript"></script>';

	if(!empty($ImData) && D_IM == 1){

	$ReturnData .='<DIV id="floatLayer" style="position: absolute; height:100px; width:250px; left:30px; top:1px;z-index: 100; border:1px solid #cccccc; padding:5px; background:#eeeeee;">

	<a href="'.getThePermalink('user',array('username' => $ImData['username'])).'"><img src="'.$ImData['image'].'" align="absmiddle" width=48 height=48 style="float:left; padding-right:15px; padding-bottom:50px;" border=0></a>

	<h2 style="font-size:18px;">'.$GLOBALS['_LANG']['_imchat1'].'</h2> 

	<p>'.$ImData['username'].' '.$GLOBALS['_LANG']['_imchat2'].'</p>

	<img src="'.DB_DOMAIN.'images/DEFAULT/_acc/comments.png" align="absmiddle"> <a href="javascript:void();" onClick="openIMWin('.$ImData['id'].','.$_SESSION['uid'].',\''.DB_DOMAIN.'\',\''.$ImData['path'].'\',\''.$ImData['width'].'\',\''.$ImData['height'].'\'); toggleLayer(\'floatLayer\'); return false;">'.$GLOBALS['_LANG']['_imchat3'].'</a>  

	- <img src="'.DB_DOMAIN.'images/DEFAULT/_acc/cancel.png" align="absmiddle"> <a href="#" onClick="RejectIM(\''.$ImData['id'].'\');toggleLayer(\'floatLayer\'); return false;">'.$GLOBALS['_LANG']['_imchat4'].'</a>

	<div id="IMChatId" style="display:none">pid'.$ImData['id'].'</div>

	</DIV>';

	}

	return $ReturnData;

}

/**

* Info: Displays the header styles for all templates

* 		

* @version  9.0

* @created  Fri Sep 25 , 2008

* @updated  Fri Sep 25  , 2008

*/

function Build_HeaderScripts($page, $sub, $CUSTOM_PLUGIN_HEADER="",$mobile){

	//echo "Start of header - <pre>"; print_r($_SESSION); echo "</pre>";
 	$ReturnData = "";

	$DontDisplayPageBase = array('search','classads','games','gallery','calendar','groups','music','blog','videos','mobilesearch','mobileaccount');

	$DontDisplaySubBase = array('search'); //,'view'

	## include base tag
	global $DB;

	$myresult = $DB->Row("SELECT id, content FROM template_pages WHERE name='".$page."' LIMIT 1");

	if ($myresult['id'] > 0) {

	}elseif(in_array($page,$DontDisplayPageBase)){

		## check subpage
		if($page == 'mobileaccount' || $page == 'mobilesearch' || ($sub !="" && in_array($sub,$DontDisplaySubBase))){}
		else{
			$ReturnData .='<base href="'.DB_DOMAIN.'">';		
		}

	}else{

		$ReturnData .='<base href="'.DB_DOMAIN.'">';

	}

	if( ( $page=="groups" && $sub=="view" ) || ( $page=="search" ) ){ $ReturnData="";	}

	if( ( $page=="blog" && $sub=="view" ) || ( $page=="search" ) ){ $ReturnData="";	}

	if( ( $page=="account" && $sub=="edit" ) ){ $ReturnData="";	}

	if( ( $page=="mobileaccount" && $sub=="edit" ) ){ $ReturnData="";	}

	//////////////////////////////////////////////////////////////////////////////////////////
	// CSS INCLUDES
	///////////////////////////////////////////////////////////////////////////////////////////

	$ReturnData .='<meta name="google-signin-client_id" content="'.GOOGLE_SIGNIN_KEY.'">'."\n";
	$ReturnData .='<script src="https://apis.google.com/js/platform.js?onload=onLoadGoogleCallback" async defer></script>'."\n";
	
	$ReturnData .='<script type="text/javascript">
  		function onLoadGoogleCallback(){
			gapi.load("auth2", function() {
		    auth2 = gapi.auth2.init({
		    	client_id: "'.GOOGLE_SIGNIN_KEY.'",
		      	cookiepolicy: "single_host_origin",
		      	scope: "profile"
		    });

		  	auth2.attachClickHandler(element, {},
		    	function(googleUser) {
		        	var profile = googleUser.getBasicProfile();
				  	var id = profile.getId();
				  	var name = profile.getName();
				  	var url = profile.getImageUrl();
				  	var email = profile.getEmail();
					Timer_Icon("google-sign-in");
					var xhttp = new XMLHttpRequest();
					xhttp.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {
							window.location.href = "/";
						}
					};
					xhttp.open("GET", "/inc/ajax/_actions.php?action=googlesign&id="+id+"&name="+name+"&url="+url+"&email="+email, true);
					xhttp.send();
					/*eMeetingDo("/inc/ajax/_actions.php?action=googlesign&id="+id+"&name="+name+"&url="+url+"&email="+email,"google-sign-in");
					setTimeout(function(){
						if(document.getElementById("google-sign-in").innerHTML == "OK"){
							window.location.href = "/";
						}
					},4000);*/

		      	}, function(error) {
		        	console.log("Sign-in error", error);
		      	}
		  	);
	  	});

		element = document.getElementById("googleSignIn");
		};
		</script>';
	## include home page css
	if(isset($page) && ($page =="index" )){
		$ReturnData .='<link rel="stylesheet" href="'.DB_DOMAIN.'inc/css/_homepage.css" type="text/css">';
	}

	## include custom profile css
	if($page =="profile" || $page =="profile_admin"){
		$ReturnData .='<link rel="stylesheet" href="'.DB_DOMAIN.'inc/css/_profile.css" type="text/css">';
	}
	
	//$templates_list = array('v5_7','v14_black'); // list of templates whose index pge will remains as the were before ( having Reduced Width )
	
	## build main page css and javascript includes
	if(D_TEMP =='v17red' || $page == "index"){ //  
		$ReturnData .= "\n\n".'<link rel="stylesheet" href="'.DB_DOMAIN.'inc/css/styles.css" type="text/css">'."\n";
		$ReturnData .= "\n\n".'<link rel="stylesheet" href="'.DB_DOMAIN.'inc/css/_version_13.css" type="text/css">'."\n";
	}
	else{
		$ReturnData .= "\n\n".'<link rel="stylesheet" href="'.DB_DOMAIN.'inc/css/styles_new.css" type="text/css">'."\n";
		$ReturnData .= "\n\n".'<link href="https://fonts.googleapis.com/css?family='.D_FONT_FAMILY.'" rel="stylesheet">'."\n";;
		$ReturnData .= '<link rel="stylesheet" href="'.DB_DOMAIN.'inc/js/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css">'."\n";	
	}
		
	//echo "Global - <pre>"; print_r($_SESSION); echo "</pre>";
	//echo "User Autorized -- ". $_SESSION['auth']."<br>".D_SIDEBARONLINE;
	
	if(D_SIDEBARONLINE && isset($_SESSION['auth']) && $_SESSION['auth'] =="yes"){
		$ReturnData .= "\n\n".'<link rel="stylesheet" href="'.DB_DOMAIN.'inc/css/sidebar.css" type="text/css">'."\n";
	}


	if ($mobile == "yes") {
		$ReturnData .= '<link rel="stylesheet" href="'.DB_DOMAIN.'inc/templates/mobile/template.css" type="text/css">'."\n";
	}else{
		$ReturnData .= '<link rel="stylesheet" href="'.DB_DOMAIN.'inc/templates/'.D_TEMP.'/template.css" type="text/css">'."\n";
	}

	$ReturnData .= '<!--[if IE 6]><link rel="stylesheet" href="'.DB_DOMAIN.'inc/css/_ie6.css" type="text/css"><![endif]-->'."\n";

	$ReturnData .= '<!--[if IE 7]><link rel="stylesheet" href="'.DB_DOMAIN.'inc/css/_ie7.css" type="text/css"><![endif]-->'."\n";

	if($sub =="design"){
		$ReturnData .= '<link href="inc/css/extras/color_selector.css" rel="stylesheet" type="text/css" />'."\n";
		$ReturnData .= '<script src="inc/js/_extras/color_selector.js" type="text/JavaScript"></script>'."\n";
	}

	//////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////// JAVASCRIPT INCLUDES //////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////

	if(D_MOD_WRITE ==1){
		$UseFullURL=DB_DOMAIN;
	}else{
		$UseFullURL="";
	}

	## build javascript input /* MUST BE AT THE TOP */

	if( ( $page =="search" && $_SESSION['auth'] =="yes" ) || ( $page =="profile" && $_SESSION['auth'] =="yes" )){

		/*$ReturnData .= '<script type="text/javascript" src="'.$UseFullURL.'inc/js/_extras/prototype_pop.js"></script>'."\n";

		$ReturnData .= '<script type="text/javascript" src="'.$UseFullURL.'inc/js/_extras/lightbox.js"></script>'."\n";

		$ReturnData .= '<script type="text/javascript" src="'.$UseFullURL.'inc/templates/'.D_TEMP.'/send_wink_js/jquery.bpopup.min.js"></script>'."\n"; */
	}
	

	##  scriptaculous
	$ReturnData .= '<script type="text/javascript" src="'.$UseFullURL.'inc/js/_scriptaculous/prototype.js"></script>'."\n";
	$ReturnData .= '<script type="text/javascript"  src="'.$UseFullURL.'inc/js/_scriptaculous/effects.js"> </script>'."\n";
	if($page !="index"){	
		$ReturnData .= '<script type="text/javascript" src="'.$UseFullURL.'inc/js/_scriptaculous/scriptaculous.js"></script>'."\n";
	}

	## sliding gallery

	if( ( $page=="profile" && $sub=="viewfile" ) || $page =="gallery" || $page =="index"  || ($page =="classads" && $sub=="add") || ( $page =="calendar" && $sub=="add" ) ||  ( $page =="groups" && $sub=="add" )  || ( $page =="blog" && $sub=="add" )){

		$ReturnData .= '<script type="text/javascript" src="'.$UseFullURL.'inc/exe/IM/inc/js/carousel.js"></script>'."\n";

	}
	else{
		$ReturnData .= '<script type="text/javascript" src="'.$UseFullURL.'inc/exe/IM/inc/js/carousel.js"></script>'."\n";
	}

	if($page !="index222"){	

		$ReturnData .= '<script type="text/javascript" src="'.$UseFullURL.'inc/js/_eMeetingGlobals.js" ></script>'."\n";
		$ReturnData .= '<script src="https://maps.googleapis.com/maps/api/js?sensor=true&libraries=places&key='.GOOGLE_MAPS_KEY.'"></script>';

		## ajax 
		if(D_MOD_WRITE ==1){
			$ReturnData .='<script type="text/javascript" src="'.$UseFullURL.'inc/js/_eMeetingAjax_mod.js" ></script>'."\n";
		}else{
			$ReturnData .='<script type="text/javascript" src="'.$UseFullURL.'inc/js/_eMeetingAjax.js" ></script>'."\n";
		}	

		if(D_BLINK_SOUND ==1){
			$ReturnData .= '<script type="text/javascript" src="'.$UseFullURL.'inc/exe/IM/inc/js/swfobject.js"></script>'."\n";
		}

	}
	if(!isset($_GET['sub']) && $page == "overview")
	{
		$GETMSG = $DB->Row("SELECT display FROM members_admin_message WHERE id=1 AND display='yes' LIMIT 1");

		if(isset($GETMSG['display']) && $GETMSG['display']=="yes"){

		   	//$ReturnData .= "openQuickAdmin();";
		   	if(isset($_SESSION['announcement'])){

			   	$ReturnData .= '<script type="text/javascript" src="'.$UseFullURL.'inc/js/fancybox/lib/jquery-1.10.1.min.js"></script>';
				$ReturnData .= '<script type="text/javascript" src="'.$UseFullURL.'inc/js/fancybox/source/jquery.fancybox.js?v=2.1.5"></script>';

				$ReturnData .= '<script type="text/javascript">
			    var jq = jQuery.noConflict();
			    jq(document).ready(function() {
			    	jq.fancybox("#QuickBoxAdmin");
			    });
				</script>';

			}

		}

	}
	## custom plugin headers

	$ReturnData .= $CUSTOM_PLUGIN_HEADER."\n\n";

	$ReturnData .= '<script type="text/javascript">function handleError() {return true;}window.onerror = handleError;</script>'."\n\n\n"; 

 	## build html editor

	if(U_EDITOR =="yes"){

		if(isset($page) && ( ($page =="classads" && $sub=="add") || ( $page =="calendar" && $sub=="add" ) || ( $page =="account"  && $sub=="edit" ) || ( $page =="groups" && $sub=="add" )  || ( $page =="blog" && $sub=="add" ) ) ){

		/*$ReturnData .= '<script type="text/javascript">_editor_url = "'.DB_DOMAIN.'newadmin/inc/editor08/"; _editor_lang = "en";</script>'."\n";

		$ReturnData .= '<script type="text/javascript" src="'.DB_DOMAIN.'newadmin/inc/editor08/htmlarea.js"></script>'."\n";

		$ReturnData .= '<script type="text/javascript" defer="1">

			
			function initDocument() {
				var count = document.getElementsByTagName("textarea").length;
				var editor1 = new HTMLArea("editor");

				
				var config = new HTMLArea.Config();

				config.height = "300px";

				config.pageStyle =  "body { background-color: white; color: black; font-family: verdana,sans-serif; border:0px; }";

				config.toolbar = [ [\'fontname\', \'space\', \'fontsize\', \'space\',\'separator\', \'space\', \'bold\', \'italic\', \'underline\', "strikethrough"]];				

				for(var i = 1 ; i <= count ; i++){
				HTMLArea.replace("editor"+ i , config);				
				}

			}

			HTMLArea.onload = initDocument;

		</script>';*/

		} 

	}

	// RIGHT TO LEFT INCLUDE

	if(D_LANG =="arabic" && $page !="index"){
		//$ReturnData .='<link href="'.DB_DOMAIN.'inc/css/_RTL.css" rel="stylesheet" type="text/css" />';
	}

	/**********************************************/

	$ReturnData .=  "<style>";

	if ($mobile == "no") {

		if(TMP_BACKGROUND !="" || TMP_BACKGROUND_IMG !=""){

			$ReturnData .=  " body { background: ";

			if( TMP_BACKGROUND !="" ){ $ReturnData .=  "".TMP_BACKGROUND." "; }

			if( TMP_BACKGROUND_IMG !="" ){ $ReturnData .=  " url('".WEB_PATH_FILES.TMP_BACKGROUND_IMG."') ".TMP_BACKGROUND_PO."; }"; }
		 	$ReturnData .= "} #MainPageBackground { background:none; } "; // #side { margin-left:-8px; }

		}

	}

	if(TMP_FOR_1 !=""){

		$ReturnData .= "#bottomBar h4, .page_header { background: ".TMP_FOR_1.";} #page_footer .footer_menu {	background: ".TMP_FOR_1.";} "; //#page_container,

	}

	if(TMP_FOR_2 !=""){

		$ReturnData .=  " #bottomBar, .b1f, .b2f, .b3f, .b4f, .contentf  { background: ".TMP_FOR_2."; } .menu { background: ".TMP_FOR_2."; }.toph2 { background-color: ".TMP_FOR_2.";}.CapTitle {  background-color: ".TMP_FOR_2."; }#side_box .menu_box_title, .menu_box_title1 {	background: ".TMP_FOR_2.";} .menu_box_title span {display:none;} #side_box .menu_box_title_sub { background: ".TMP_FOR_2.";}";

	}

	if(TMP_FOR_3 !=""){

		$ReturnData .=  "#main_wrapper_bottom { display:none;} #main_content_wrapper { width:687px; margin-top:10px;} #main_content_wrapper, #side_box .menu_box_body, .menu_box_body1 { background: ".TMP_FOR_3.";  border:1px solid ".TMP_FOR_2." } ";

	}

	if(TMP_LINK !=""){

		$ReturnData .= "a { color: ".TMP_LINK.";}a:link { color: ".TMP_LINK.";}a:visited {color: ".TMP_LINK.";}a:active {color: ".TMP_LINK.";}a:hover {color: ".TMP_LINK.";} .sub_tabs li a { color: ".TMP_LINK.";}.index { color: ".TMP_LINK.";}.onlinenow a{ color: ".TMP_LINK."; }";

	}

	if(TMP_LINK_MENU !=""){

		$ReturnData .= "#side_box .menu_box_title, .menu_box_title1,.toph2,.CapTitle { color: ".TMP_LINK.";} .tabs li a, .tabs li a:hover, .tabs li .selected,.onlinenow a, #page_footer .footer_tabs li a { 	color: ".TMP_LINK_MENU."; border-right:0px;} ";

	}	

	if(strlen(TMP_LOGO_ICON) > 1 && TMP_LOGO_HIDE != 1){

		//$size = @getimagesize(TMP_LOGO_ICON);
 		if(isset($size[1])){ $extra="height:".$size[1]."px;"; }else{ $extra=""; }
		$ReturnData .= " #ImageLogo { background-image:url('".TMP_LOGO_ICON."'); ".$extra."  } ";

	}else{

		$ReturnData .= " #ImageLogo .p1 { margin-left:0px;} ";

	}

	if(strlen(TMP_LOGO_HEIGHT) > 1 && $mobile=='no'){

		$ReturnData .= " .logo_height {  height:".TMP_LOGO_HEIGHT."} ";
		$logo_total_height = "".TMP_LOGO_HEIGHT."";
		$wide_wrapperPostion = ((float) $logo_total_height+58);
		$ReturnData .= " .wide_wrapper {  top:".$wide_wrapperPostion."px;} ";
		
	}

	if(strlen(TMP_PAGE_HEAD) > 1){

		$ReturnData .= ".TopVideos, .TopTour, .TopUpgrade, .TopSettings, .TopRegister, .TopMusic, .TopMessages, .TopMatches, .TopMap, .TopLogin, .TopLinks, .TopInvite, .TopGroups, .TopGames,

		.TopGallery, .TopForum, .TopFAQ, .TopContact, .TopAdverts, .TopChatRoom, .TopCalendar, .TopBlog, .TopArticles, .TopAffiliate, .TopAccount

		 { background: ".TMP_PAGE_HEAD." } .TopVideos, .TopTour, .TopUpgrade, .TopSettings, .TopRegister, .TopMusic, .TopMessages, .TopMatches, .TopMap, .TopLogin, .TopLinks, .TopInvite, .TopGroups, .TopGames,

		.TopGallery, .TopForum, .TopFAQ, .TopContact, .TopAdverts, .TopChatRoom, .TopCalendar, .TopBlog, .TopArticles, .TopAffiliate, .TopAccount

		span { color: ".TMP_LINK_MENU." }";

	}

	$ReturnData .= " #ImageLogo .p1, #ImageLogo .p3 {color: ".TMP_LOGO_COLOR."} #ImageLogo .p2 { color: ".TMP_LOGO_SLOGAN_COLOR."}";

	/*

	logo colours

	*/

	if($mobile=='no'){

		$ReturnData .= "#page_content { width:".TMP_WIDTH_CONTAINER.";}#fullpage #main { 	width: 74%;}#side_box { width: ".TMP_WIDTH_MENU."; }"; //".TMP_WIDTH_PAGE."

	}else{

		$ReturnData .= "#page_content { width:320px;}#fullpage #main { 	width: 300px;}#side_box { width: ".TMP_WIDTH_MENU."; }";

	}

	$ReturnData .= "</style>";

	return $ReturnData;

}

/**
* Info: Displays OnLoad Tag for all pages
* 		
* @version  9.0
* @created  Fri Sep 25 , 2008
* @updated  Fri Sep 25  , 2008
*/

function Build_HeaderOnLoad($page, $sub, $PACKAGEACCESS, $WaitingIM=false, $mobile="no"){

	global $DB;

	$ReturnData = 'onLoad="';	
	if($page=="profile"){
		$ReturnData .= "showDefaultProfileDiv();";
	}

	## ADD ONLOAD EVENT FOR IM MESSAGE

	if($WaitingIM){
		$ReturnData .= "start();";

		## update message status to read
		$DB->Update("UPDATE userplane_pending_wm SET openedWindowAt = now() WHERE destinationUserID='".$_SESSION['uid']."'"); 

	}

	## load html editor box

	if(isset($page) && ( ($page =="classads" && $sub=="add") || ( $page =="calendar" && $sub=="add" ) || ( $page =="account"  && $sub=="edit" ) || ( $page =="groups" && $sub=="add" ) || ( $page =="blog" && $sub=="add" ) ) ){

		$ReturnData .="HTMLArea.init();";

	} 

	if ($mobile == 'no') {

	   if(!defined('D_IM_POPUP') || D_IM_POPUP!="0") {

		   	## auto load IM window when user logs in
	    	if(isset($page) && $page=="overview" && isset($_GET['lim']) && @!in_array("chatroom-im",$PACKAGEACCESS[$_SESSION['packageid']])){

				$ReturnData .="LauncheMeetingIm('".DB_DOMAIN."');";

	      }

   		}

	   	## opens admin welcome message
	   	//isset($_GET['lim']) && $page=="overview"
		if(!isset($_GET['sub']) && $page=="overview"){

			$GETMSG = $DB->Row("SELECT display FROM members_admin_message WHERE id=1 AND display='yes' LIMIT 1");

			if(isset($GETMSG['display']) && $GETMSG['display']=="yes"){

			   	$ReturnData .= "openQuickAdmin();"; 

			}

	   	}

	}

	if(D_REGISTER_IMAGE == 1){
		$ReturnData .='CaptchaCallback(); ';	
	}
	$ReturnData .=' return false;"';

	return str_replace('onLoad=""',"",$ReturnData);

}

/**

* Info: Fulder Online Check System

* 		

* @version  9.0

* @created  Fri Sep 25 , 2008

* @updated  Fri Sep 25  , 2008

*/

function IsIMWindowExist($id)

{

	if(!isset($_SESSION['IMWindows']))

	{

		$_SESSION['IMWindows'] = array();

	}

	$imWindowsArray = $_SESSION['IMWindows'];

	for($i = 0; $i < count($imWindowsArray); $i++)

	{

		if($imWindowsArray[$i] == $id)

		{

			return true;

			break;

		}

	}

	return false;

}

function RegisterIMWindow($id)

{

	if(!isset($_SESSION['IMWindows']))

	{

		$_SESSION['IMWindows'] = array();

	}

	$imWindowsArray = $_SESSION['IMWindows'];

	$lastIndex = count($imWindowsArray);	

	$imWindowsArray[$lastIndex] = $id;

	$_SESSION['IMWindows'] = $imWindowsArray;

}

function RemoveIMWindow($id)

{

	if(!isset($_SESSION['IMWindows']))

	{

		$_SESSION['IMWindows'] = array();

	}

	$imWindowsArray = $_SESSION['IMWindows'];

	$imWindowsNewArray = array();

	$ii = 0;

	for($i = 0; $i < count($imWindowsArray); $i++)

	{

		if($imWindowsArray[$i] != $id)

		{

			$imWindowsNewArray[$ii] = $imWindowsArray[$i];

			$ii++;

		}

	}

	$_SESSION['IMWindows'] = $imWindowsNewArray;

}

function Build_IMMessage($IMRoomArray){

	

		if($_SESSION['auth'] =="yes"){

		

				global $DB;				

				

				$SearchDate = date("Y-m-d",mktime(0, 0, 0, date("m")  , date("d"), date("Y")));

				

				$result = $DB->Row("SELECT members.id, members.username, files.uid, files.bigimage, files.type, files.approved, files.aid, files.adult_content

				FROM im 

				INNER JOIN members ON ( im.from_uid = members.id AND im.to_uid= ( '".$_SESSION['uid']."' ) ) 

				LEFT JOIN files ON ( files.uid = im.from_uid AND files.default LIKE '%1%' AND files.approved='yes') 

				WHERE im.read ='no' AND im.date LIKE '%".$SearchDate."%' 

				GROUP BY im.from_uid LIMIT 1");

					

				if(!empty($result) && !IsIMWindowExist($result['id'])){			



					$result['image'] 	= ReturnDeImage($result,"medium");

					$result['width'] 	= $IMRoomArray['width'];

					$result['height'] 	= $IMRoomArray['height'];

					$result['path'] 	= $IMRoomArray['path'];



					return $result;

				

				}else{



					$result = $DB->Row("SELECT members.id, members.username, files.uid, files.bigimage, files.type, files.approved, files.aid, files.adult_content

					FROM userplane_pending_wm

					INNER JOIN members ON ( originatingUserID = members.id AND destinationUserID = ( '".$_SESSION['uid']."' ) ) 

					LEFT JOIN files ON ( files.uid = originatingUserID AND files.default LIKE '%1%' AND files.approved='yes') 

					WHERE insertedAt LIKE '%".$SearchDate."%' 

					AND openedWindowAt is null

					GROUP BY originatingUserID LIMIT 1");



					if(!empty($result)){		



						$result['image'] 	= ReturnDeImage($result,"medium");

						$result['width'] 	= $IMRoomArray['width'];

						$result['height'] 	= $IMRoomArray['height'];

						$result['path'] 	= $IMRoomArray['path'];



						return $result;



					}else{



						return "";

					}

				}

		}else{

			return "";

		}

}

/**

* Info: Build AutoLogin Function

* 		

* @version  9.0

* @created  Fri Sep 25 , 2008

* @updated  Fri Sep 25  , 2008

*/

function Build_AutoUsersOnline($value=10){

	global $DB;

	$min_online = 10;

	if(defined(AUTO_MINIMUM_ONLINE)){ $min_online = AUTO_MINIMUM_ONLINE;}

 	if(isset($_SESSION['countonline_total']) && $_SESSION['countonline_total'] < $min_online){

		$RandomAmount = rand($min_online,(AUTO_AMOUNT - $_SESSION['countonline_total']));

		if ($RandomAmount < 0) {

			$RandomAmount = 1;

		}

		$AutoOLogin = $DB->Query("SELECT members.id  FROM members WHERE members.visible = 'yes' AND members.active='active' ORDER BY RAND() LIMIT ".$RandomAmount); 

			// INNER JOIN files ON (members.id = files.uid AND files.default='yes')

		while( $aLogin = $DB->NextRow($AutoOLogin) ){		

			$DB->Insert("INSERT INTO members_online values('".time()."','0','browse', '".$aLogin['id']."')");

			$DB->Insert("UPDATE members SET lastlogin='".DATE_TIME."' WHERE id='".$aLogin['id']."' LIMIT 1");

		}	

		$_SESSION['countonline_total'] = $RandomAmount + $_SESSION['countonline_total'];

	}	

}

/**

* Info: Check for banned users

* 		

* @version  9.0

* @created  Fri Sep 25 , 2008

* @updated  Fri Sep 25  , 2008

*/

function Build_BankChecker(){

	global $DB;

	if( ( (strpos(strtoupper($_SERVER['REQUEST_URI']), ".txt?") !== FALSE)  || ( strpos(strtoupper($_SERVER['REQUEST_URI']), "UNION") !== FALSE) ) && !isset($_SESSION['banned_deny']) && $_SESSION['admin_auth'] !="yes"){

			if(isset($_SESSION['username'])){$BAN_USERNAME=$_SESSION['username'];}else{$BAN_USERNAME="Guest";}

			// HACK ATTEMPT FOUND

			$URI = strip_tags($_SERVER['REQUEST_URI']);

			$URI = str_replace("'", "", $URI);

			$DB->Row("INSERT INTO `members_banned` (`ip` ,`date` ,`string`, username)VALUES ('".$_SERVER['REMOTE_ADDR']."', '".date("Y-m-d H:i:s")."', '".$URI."','".$BAN_USERNAME."')");		

			session_unset($_SESSION['banned_check']);

	}

	if(!isset($_SESSION['banned_check'])){

			if(isset($_SESSION['banned_deny']) && $_SESSION['banned_deny'] == true){

				$_SESSION['banned_deny'] = true;

				require_once (	"inc/templates/layout/banned.php"	);

				die();

			}else{

				$F_Ban = $DB->Row("SELECT count(autoid) AS total FROM members_banned WHERE ip LIKE ('%".$_SERVER['REMOTE_ADDR']."%') LIMIT 1");

				if(!empty($F_Ban) && $F_Ban['total'] > 0){						

					$_SESSION['banned_deny'] = true;

					require_once (	"inc/templates/layout/banned.php"	);

					die();

				}else{

					$_SESSION['banned_check'] = true;

				}

			}

	}

}

/**

* Info: Build the user online tool

* 		

* @version  9.0

* @created  Fri Sep 25 , 2008

* @updated  Fri Sep 25  , 2008

*/

function Build_UserOnline($user_timestamp, $user_ip, $user_page, $user_logid, $timeoutseconds = 1200, $requested){

	global $DB;	

	## define timeout if not already defined

	if(defined(ONLINE_NOW_TIMEOUT)){ $timeoutseconds = ONLINE_NOW_TIMEOUT;}

	$timeout=$user_timestamp-$timeoutseconds;

	$returnThis ="";

	$user_page = eMeetingInput($user_page);

	// CHECK FOR PROFILE VIEWING

	if ($user_page != "profile") {

		if(is_numeric($_SESSION['uid']) && $_SESSION['uid'] != 0){

			$DB->Update("UPDATE members_online SET timestamp= ('".$user_timestamp."'), 	ip= ('".$user_ip."'), 	page= ('".$user_page."') WHERE logid = ( '".$user_logid."' ) LIMIT 1");

			if ($DB->Affected() == 0)

			{

				$DB->Insert("INSERT INTO members_online values('$user_timestamp','$user_ip','$user_page', '$user_logid')");

			}

		}elseif(is_numeric($_SESSION['uid']) && $_SESSION['uid'] == 0){

			$DB->Update("UPDATE members_online SET timestamp= ('".$user_timestamp."'), 	ip= ('".$user_ip."'), 	page= ('".$user_page."') WHERE logid = ( '0' ) AND ip= ('".$user_ip."') LIMIT 1");

			if ($DB->Affected() == 0)

			{

				$DB->Insert("DELETE FROM members_online WHERE ip= ('".$user_ip."') ");

				$DB->Insert("INSERT INTO members_online values('$user_timestamp','$user_ip','$user_page', '$user_logid')");

			}		

		}

	}else{

	} // end if

	$DB->Update("DELETE FROM members_online WHERE timestamp < $timeout");

	return $returnThis;

}

/**

* Info: Build all website menu bars

* 		

* @version  9.0

* @created  Fri Sep 25 , 2008

* @updated  Fri Sep 25  , 2008

*/
function Build_DisplayMenu($menu_array , $page="",$addLink = false, $ext_menu=""){
	 $ReturnValue ="";	 $counter=1; $ModArray = array();
	if (is_array($menu_array) || is_object($menu_array)){
		
	foreach($menu_array as $key => $item) {

		$AddSelected = str_replace("&sub=search","",$key);

		$target = "";

		if(strpos($key, "&new_window=1")){
			$key =str_replace("&new_window=1","",$key);
			$target = "target='_blank'";
		}

		if($addLink){ $key =$page."&sub=".$key;   }		

	 	if($page !="" && ( $page == strtolower($AddSelected) )  ){ $AddSel='class="selected"'; }else{ $AddSel="";}

		if($counter==1){ $Style =$counter."";  }else{ $Style =$counter; }

		if(substr($key,-1,1) !="?" && $item!=""){ ## hide value if its a help value

		$ModArray['page'] =$key;

		if(strtolower($AddSelected) =="logout"){ 

			$PageLink = getThePermalink('logout');

		}else{

			$PageLink = MakeLinkMOD($ModArray);

		}

		// GENERATE POWERED BY LINK		


		if(strtolower($key) == "copyright" && strlen(BRAND_ID) ==0){ 

  			$eKeys = array("");

			$ReturnValue .= '<li class="i'.$Style.'" style="color:white;"><a href="//www.advandate.com/" '.$AddSel.' title="Dating Software by AdvanDate, LLC" style="color:white;">'; //'.$eKeys[rand(0,5)].'

			$ReturnValue .= $item;

			$ReturnValue .=' ( Dating Software by AdvanDate, LLC )';

			$ReturnValue .= '</a></li>'; 


		}else{

			if(strtolower($AddSelected) =="tour" && D_TOUR ==0){	

			}elseif(strtolower($AddSelected) =="logout" && isset($_SESSION['auth']) && $_SESSION['auth'] =="no"){

			}elseif(strtolower($AddSelected) =="account" && D_ACCOUNT ==0){		

			}elseif(strtolower($AddSelected) =="faq" && D_FAQ ==0){			

			}elseif(strtolower($AddSelected) =="follow" && D_FOLLOW ==0){	

			}elseif(strtolower($AddSelected) =="chatroom" && D_CHATROOM ==0){			

			}elseif(strtolower($AddSelected) =="games" && D_GAMES ==0){

			}elseif(strtolower($AddSelected) =="blog" && D_BLOG ==0){			

			}elseif(strtolower($AddSelected) =="classads" && D_CLASSADS ==0){

			}elseif(strtolower($AddSelected) =="videos" && D_VIDEOS ==0){

			}elseif(strtolower($AddSelected) =="music" && D_MUSIC ==0){

			}elseif(strtolower($AddSelected) =="messages" && D_MESSAGES ==0){

			}elseif(strtolower($AddSelected) =="search" && D_SEARCH ==0 ){

			}elseif(strtolower($AddSelected) =="friends" && D_NETWORK ==0 ){

			}elseif(strtolower($AddSelected) =="settings" && D_SETTINGS ==0){

			}elseif(strtolower($AddSelected) =="gallery" && D_GALLERY ==0){

			}elseif(strtolower($AddSelected) =="calendar" && D_EVENTS ==0){

			}elseif(strtolower($AddSelected) =="forum" && D_FORUM ==0){	

			}elseif(strtolower($AddSelected) =="browse" && D_SEARCH ==0){		

			}elseif(strtolower($AddSelected) =="matches" && D_MATCHTESTS ==0){			

			}elseif(strtolower($AddSelected) =="calendar" && D_EVENTS ==0){			

			}elseif(strtolower($AddSelected) =="subscribe" && D_FREE =="yes"){			

			}elseif(strtolower($AddSelected) =="contact" && D_CONTACT ==0){			

			}elseif(strtolower($AddSelected) =="calendar" && D_CALENDAR =="no"){			

			}elseif(strtolower($AddSelected) =="affiliate" && AFF_ENABLED !="yes"){			

			}elseif(strtolower($AddSelected) =="articles" && D_ARTICLES ==0){			

			}elseif(strtolower($AddSelected) =="groups" && D_GROUPS ==0){

			}elseif(strtolower($AddSelected) =="register" && isset($_SESSION['auth']) && $_SESSION['auth'] =="yes"){

			}elseif(strtolower($AddSelected) =="login" && isset($_SESSION['auth']) && $_SESSION['auth'] =="yes"){

			}elseif(strtolower($AddSelected) =="tour" && isset($_SESSION['auth']) && $_SESSION['auth'] =="yes"){



			}else{

				if((strpos($key, "http://") === false) && (strpos($key, "http:\/\/") === false)){

					

				if((strpos($key, "https://") === false) && (strpos($key, "https:\/\/") === false)){
                      if($key =="account&sub=video" && FLASH_VIDEO =="no"){ }

					elseif($key =="account&sub=comments" && D_COMMENTS =="0"){ }

					elseif($key =="account&sub=design" && D_DESIGNER =="0"){ }

					elseif($key =="settings&sub=sms" && UPGRADE_SMS !="yes"){ }

					elseif($key =="messages&sub=wink" && D_WINK ==0){ }

					elseif($key =="messages&sub=read" ){ }

					elseif($AddSelected =="logout" && isset($_SESSION['google_user']) && $_SESSION['google_user'] == 'yes'){

						$ReturnValue .= '<li class="i'.$Style.'"><a href="javascript:void();" onclick="signOut(\''.getThePermalink('logout').'\');" '.$target.''.$AddSel.'><span>'.$item.'</span></a></li>';

					}

					else{

						$ReturnValue .= '<li class="i'.$Style.'"><a href="'.$PageLink.'" '.$target.''.$AddSel.'><span >'.$item.'</span></a></li>';

					}
					}else{
						$ReturnValue .= '<li class="i'.$Style.'" id="test"><a href="'.$key.'"  '.$target.''.$AddSel.'><span>'.$item.'</span></a></li>';
					}

					// draw inner menu

					if(is_array($ext_menu) && $key==$page){ 

					$ReturnValue .= "</ul>";

					$ReturnValue .= "<ul class='menu_side_inner'>";

					foreach($ext_menu as $key => $item) {

						$ReturnValue .= '<li><a href="'.$PageLink.'" '.$target.''.$AddSel.'><span>'.$item.'</span></a></li>';

					}

					$ReturnValue .= "</ul>";

					$ReturnValue .= "<ul class='menu_side'>";

					}

				}else{

					$ReturnValue .= '<li class="i'.$Style.'" id="test"><a href="'.$key.'"  '.$target.''.$AddSel.'><span>'.$item.'</span></a></li>';

				}



			}

		}	 }

		$counter++;

	 }	 
	}
	 return $ReturnValue;

}

/**

* Info: Gets the member template

* 		

* @version  9.0

* @created  Fri Sep 25 , 2008

* @updated  Fri Sep 25  , 2008

*/

function GetMemberTemplate($id){

	global $DB;

	$result = $DB->Row("SELECT * FROM members_template WHERE uid='".$id."' LIMIT 1");

	if(!empty($result)){

		$result = array_map('eMeetingOutput',$result);

	}

	return $result;

}

/**

* Info: Saves the score for the game played

* 		

* @version  9.0

* @created  Fri Sep 25 , 2008

* @updated  Fri Sep 25  , 2008

*/

function SaveScores($score, $game){

	global $DB;

 	$DB->Update("UPDATE `game_games` SET Champion_name ='".$_SESSION['username']."', Champion_score = '".$score."' WHERE gameid='".$game."' AND Champion_score < '".$score."' LIMIT 1");

   $checkscore = $DB->Row("SELECT * FROM game_scores WHERE gamename =( '".$game."' ) AND username=( '".$_SESSION['uid']."' ) ORDER BY thescore DESC LIMIT 1");

   if (!empty($checkscore)) { ## a score already exists by this person.

		if ($checkscore["thescore"] < $score) { ## ONLY SAVE IF THE NEW SCORE IS BETTER THAN OLD

		 $DB->Update("UPDATE `game_scores` SET `thescore` = '".$score."', `gamename` = '".$game."', `phpdate` = '".DATE_NOW."' WHERE gamename=''".$game."'' AND username='".$_SESSION['uid']."' LIMIT 1");

		}

 	} else {

 	 	## First time, submit it in.

   		$DB->Insert("INSERT INTO game_scores (username,thescore,ip,phpdate,gamename) VALUES ('".$_SESSION['username']."','".$score."','".$_SERVER['REMOTE_ADDR']."','".DATE_NOW."','".$game."')");

 	}

}

###############################################################################

/*

	THE ABOVE FUNCTIONS ARE USED DURING THE INITAL SYSTEM LOAD

*/

###############################################################################

function DisplayNewsFeed($limit=5){

	$news = array();

	$count=1;

	require_once( "newadmin/inc/class/lastRSS.php" );

	$rss = new lastRSS;

	$rss->cache_dir = '';

	$rss->cache_time = 0;

	$rss->cp = 'US-ASCII';

	$rss->date_format = 'l';

	if ($rs = $rss->get(DB_DOMAIN."rss.php")) {

		foreach($rs['items'] as $item) {

			$news[$count]['title'] 			= $item['title'];

			$news[$count]['description'] 	= $item['description'];

			$news[$count]['link'] 			= $item['link'];

			$news[$count]['category'] 		= $item['category'];

			if($count==$limit){

				return $news;

			}

			$count++;

		}

	}

	return $news;

}

###############################################################################

/**

* Info: Build Image Display Function

* 		

* @version  9.0

* @created  Fri Sep 25 , 2008

* @updated  Fri Sep 25  , 2008

*/

function ReturnDeImage($array,$size,$OnlyPic=0){

		## photo used on member adverts, groups etc

		if(isset($array['photo']) && $array['photo'] !=""){

			$array['bigimage']=$array['photo']; $array['type'] ="photo";

		}

		## if not file type is set

		if(!isset($array['type'])){ 

			$array['type']="photo"; 

			$array['bigimage'] = DEFAULT_IMAGE;

		}

		## build the image string

		switch($array['type']){

			case "photo": {

				## add gender display pic male/female etc

				if(isset($array['gender'])){ $array['bigimage'] .="&g=".$array['gender']; }

				$UImage = $array['bigimage'];

			} break;

			case "music": { $UImage = DEFAULT_MUSIC."&t=f"; 	} break;

			case "video": { $UImage = DEFAULT_VIDEO."&t=f";		} break;

			case "youtube": { 

				$file_part = explode("?v=",$array['bigimage']); 

				if(isset($file_part[1])){ $file_part = explode("&",$file_part[1]); }

				if(!isset($file_part[0])){

					$UImage = DEFAULT_VIDEO."&t=f";

				}else{

					return "//img.youtube.com/vi/".$file_part[0]."/2.jpg?";

				}	

			} break;

			// not type found

			default: { 

				$UImage = DEFAULT_IMAGE."&t=f"; 

				if(isset($array['gender'])){ $UImage ="nophoto.jpg&g=".$array['gender']; }

			} break;

		}
		## approval system 
		if(isset($array['approved']) && $array['approved'] =="no" ){

			$UImage = WATINGAPPROVAL_IMAGE."&t=f";

		}

		## adult images

		if(isset($array['adult_content']) && $array['adult_content'] =="yes" && $_SESSION['pack_adult'] !="yes" && ENABLE_ADULTCONTENT =="yes"){ // && $_SESSION['uid'] != $array['uid']

			 if($_SESSION['auth'] != "yes"  && (isset($array['id']) && $array['id'] != $_SESSION['uid']) || ( isset($array['uid']) && $array['uid'] != $_SESSION['uid'] ) ){

				$UImage = DEFAULT_IMAGE_ADULT."&t=f";

				//return $UImage;

			}

		}

		## build the query string

		$FilePath = DB_DOMAIN."inc/tb.php?src=";			

		## image sizes

		switch($size){

				case "xsmall":{	$UImage .="&x=40&y=40";			} break;	

				case "small":{	$UImage .="&x=48&y=48";			} break;

				case "medium":{	$UImage .="&x=96&y=96";			} break;

				case "big":{	$UImage .="&x=183&y=183";		} break;

				case "full":{	$FilePath = WEB_PATH_IMAGE; } break;

		}

	$UImage = $FilePath.$UImage;

	return $UImage;

}

/**

* Info: Checks if you can view the selected album

* 		

* @version  9.0

* @created  Fri Sep 25 , 2008

* @updated  Fri Sep 25  , 2008

*/

function CanIViewThisAlbum($albumType, $id){

	global $DB;

	if($albumType =="adult"){

			$VD = $DB->Row("SELECT view_adult FROM package WHERE pid= ( '".$_SESSION['packageid']."' ) LIMIT 1");

			if($VD['view_adult'] =="yes"){		

				return 1;

			}else{

				return 0;

			}

	}elseif($albumType =="hotlist"){

			$hotlist = $DB->Row("SELECT DISTINCT members_network.type FROM members_network WHERE 

					(members_network.uid='".$id."' AND  members_network.to_uid='".$_SESSION['uid']."' AND members_network.type=1) OR  

					(members_network.uid='".$_SESSION['uid']."' AND  members_network.to_uid='".$id."' AND members_network.type=1) 

					AND approved='yes' ORDER BY members_network.type ASC LIMIT 1");

			if(!empty($hotlist)){

				return 1;

			}else{

				return 0;

			}

	}elseif($albumType =="friends"){

			$FriendList = $DB->Row("SELECT DISTINCT members_network.type FROM members_network WHERE 

					(members_network.uid='".$id."' AND  members_network.to_uid='".$_SESSION['uid']."' AND members_network.type=2) OR  

					(members_network.uid='".$_SESSION['uid']."' AND  members_network.to_uid='".$id."' AND members_network.type=2) 

					AND approved='yes' ORDER BY members_network.type ASC LIMIT 1");	

			if(!empty($FriendList)){

				return 1;

			}else{

				return 0;

			}

	}

}

/**

* Info: Displays the file rating stars

* 		

* @version  9.0

* @created  Fri Sep 25 10:48:31 EEST 2008

* @updated  Fri Sep 25 10:48:31 EEST 2008

*/

function DisplayFileRating($rate){

	$i=1;

	$ReturnValue="";

	$crate = $rate;

	while($i < 6){

		if($crate < 10){

			$ReturnValue .= '<img src="'.DB_DOMAIN.'images/DEFAULT/_stars/rating_off.gif" style="border: 0px none">';

		}elseif($rate > 10 && $rate < 19){

				$ReturnValue .= '<img src="'.DB_DOMAIN.'images/DEFAULT/_stars/rating_half.gif" style="border: 0px none">';

		}else{

			$ReturnValue .= '<img src="'.DB_DOMAIN.'images/DEFAULT/_stars/rating_on.gif" style="border: 0px none">';

		}		

		$crate=$crate-20;

		$i++;

	}

	return $ReturnValue;

}

/**

* Info: Shows the website language flags

* 		

* @version  9.0

* @created  Fri Sep 25 , 2008

* @updated  Fri Sep 25  , 2008

*/



function ShowFlags($mobile="no"){

/*$page_name=  explode('?',$_SERVER['REQUEST_URI']);*/


if ($mobile == 'yes') {

	$string ='<table width="270" border="0" cellpadding="2" cellspacing="5" style="height:35px;"><tr><td align="center">';
	

} else {

	/*if($page_name[1] == 'dll=index_responsive'){*/

	$string ='<div class="flags_table"><ul class="flags_ul">';		
	//$string .='<ul>';
	/*	}else {

	$string ='<table width="845" border="0" align="center" cellpadding="1" cellspacing="1" style="height:35px;"><tr><td align="center">';

		}*/

}



	 $ext = array("php");

	 $files = array();

	 $HandlePath ="inc/langs/";

	 if($handle1 = opendir($HandlePath)) {

	 while(false !== ($file = readdir($handle1))){

	 for($i=0;$i<sizeof($ext);$i++){

	  if(strstr($file, ".".$ext[$i])){

	  $flasg_icon = str_replace(".php","",$file);

		if ($mobile == 'yes') {

			$string .='<a href="'.DB_DOMAIN.'index.php?l='.$flasg_icon.'" title="'.$flasg_icon.'"><img src="'.DB_DOMAIN.'images/language/flag_'.$flasg_icon.'.gif" alt="'.$flasg_icon.'" border="0" style="margin-right:5px;"></a>';

		}else {
			$string .='<li class="flags_list_item"><a href="'.DB_DOMAIN.'mobile.php?l='.$flasg_icon.'" title="'.$flasg_icon.'"><img src="'.DB_DOMAIN.'images/language/flag_'.$flasg_icon.'.gif" alt="'.$flasg_icon.'" border="0" style="margin-right:8px;margin-bottom:8px;"></a></li>';
			



		}

	   }

	   }   

	 }

	}
	if ($mobile == 'yes') {
		$string .='</td></tr></table><div class="clear"></div>';
	}else{
		$string .='</ul></div><div class="clear"></div>';
	}
	return $string;

}

/**

* Info: Shows the language dropdown list

* 		

* @version  9.0

* @created  August 2012

*/

function ShowLangList(){





	$string ='<form action="dummyvalue">

<select name="newurl" onchange="menu_goto(this.form)" size="1" style="width:150px;margin-top:8px;">

<option>-- Select Language --</option>';





	$ext = array("php");

	$files = array();

	$fileslist = array(); 

	$HandlePath ="inc/langs/";

	if($handle1 = opendir($HandlePath)) {

	   while(false !== ($file = readdir($handle1))){

	      for($i=0;$i<sizeof($ext);$i++){

	         if(strstr($file, ".".$ext[$i])){

	          $flasg_icon = str_replace(".php","",$file);

	          $lang_name = ucfirst($flasg_icon);

	          //$string .='<option value="mobile.php?l='.$flasg_icon.'" >'.$lang_name.'</option>';

		  $fileslist[] = $flasg_icon;

	         }

	       }

	    }

	}



	sort($fileslist, SORT_LOCALE_STRING);



	foreach ($fileslist as $f) {

	    $lang_name = ucfirst($f);

	    $string .='<option value="mobile.php?l='.$f.'" >'.$lang_name.'</option>';

	} 



	$string .='</select></form>';

	return $string;

}



##########################################################################################

## 								BANNER FUNCTION											##

##########################################################################################

function DisplayBannerCode($Page,$mobile){

	global $DB;

	$NumFields=1;

	$FlagBottom=0;

	$FlagLeft=0; $FlagMid=0;



	if($mobile == "yes"){

		$FlagMid=1;

	}

	$BannerArray=array();

	$FieldString=" AND ( clicks='0' ";

	## DATABASE FIELD 'clicks' NOW REFERS TO THE DISPLAY TYPE

	## IS THIS MEMBER LOGGED IN, IF SO LETS LOOK FOR MEMBERS ONLY BANNERS

	if(isset($_SESSION['auth']) && $_SESSION['auth'] =="yes"){

		$FieldString .="OR clicks='1'";

		if(isset($_SESSION['genderid'])){

			$FieldString .=" OR clicks='".$_SESSION['genderid']."'";

		}

	}

	$Page = str_replace("'","",$Page);

	$Page = str_replace("*","",$Page);

	$FieldString .=" ) ";	

	## We must seelct a random banner for this page from the database and then display it.

	$QQ = "SELECT * FROM banners WHERE (page='".strip_tags($Page).".php' OR page='all') $FieldString AND active='yes' ORDER BY RAND() ";

	$result = $DB->Query($QQ);

	$FlagTop =0;

	while( $row = $DB->NextRow($result) ){

		$BANNER[1]= $row['bid'];

		$BANNER[2]= $row['bName'];

		$BANNER[3]= $row['imglocation'];

		$BANNER[4]= $row['urllocation'];

		$BANNER[5]= $row['width'];

		$BANNER[6]= $row['height'];

		$BANNER[7]= eMeetingOutput($row['code'],true);

		$CanContinue=false;

		##	SET FLAGS IF THIS POSITION HAS BEEN TAKEN

		if($row['position'] =="top" && $FlagTop !=1){

			$CanContinue=true;

			$FlagTop =1;

		}

		if($row['position'] =="left" && $FlagLeft !=1){

			$CanContinue=true;

			$FlagLeft =1;

		}

		if($row['position'] =="middle" && $FlagMid !=1){

			$CanContinue=true;

			$FlagMid =1;

		}

		if($row['position'] =="bottom" && $FlagBottom !=1){

			$CanContinue=true;

			$FlagBottom =1;

		}		

		###############################################

		if($CanContinue){

			## Now lets update the impressions value

			$DB->Update("UPDATE banners SET impressions=impressions+1 WHERE bid= '".$BANNER[1]."' "); 

			##Now lets build the code and pass it back

			if($BANNER[4] != ""){		

				$banner = "<a href='".$BANNER[4]."' target='_blank'>".$BANNER[7]."</a>";

			}else{

				$banner = "".$BANNER[7]."";

			}

			$BannerArray[$NumFields]['display']	= "<div align='center'>".$banner."</div>";			

			$BannerArray[$NumFields]['position']	= $row['position'];

			$NumFields++;

		}

	}

	return $BannerArray;

}

##########################################################################################

## 								EMAIL FUNCTIONS											##

##########################################################################################

function SendMail($to, $subject, $message){

	global $DB;

	$Badwords = CreateBadWordFilter();

	$subject = eMeetingOutput(filter_str($subject,$Badwords),true);

	$message = eMeetingOutput(filter_str($message,$Badwords),true);

	$DB_MAIL = new htmlMimeMail();
	
	// ARE WE SENDING VIA SMTP OR SENDMAIL ?

	if(USE_SMTP =="yes"){

		// SEND SMTP

		$text = "";

		$html = $message;

		$DB_MAIL->setHtml($html, $text);

		$DB_MAIL->setSMTPParams(SMTP_SERVER, SMTP_PORT, "",SMTP_FROM_NAME, SMTP_USERNAME,SMTP_PASSWORD);

		$DB_MAIL->setReturnPath(ADMIN_EMAIL);

		$DB_MAIL->setFrom('"'.SEND_ADMIN_NAME.'" <'.ADMIN_EMAIL.'>');

		$DB_MAIL->setSubject($subject);	 

		$result = $DB_MAIL->send(array($to), 'smtp');

	}else{

	# Common Headers

	@ini_set(sendmail_from, ADMIN_EMAIL);	

	$text = "";

	$html = $message;

	$DB_MAIL->setHtml($html, $text);

	$DB_MAIL->setReturnPath(ADMIN_EMAIL);

	$DB_MAIL->setFrom('"'.SEND_ADMIN_NAME.'" <'.ADMIN_EMAIL.'>');

	$DB_MAIL->setSubject($subject);

	$DB_MAIL->setHeader('X-Mailer', 'eMeeting Dating Software');

	$result = $DB_MAIL->send(array($to));

	@ini_restore(sendmail_from);

	}

}

/**

* Info: Makes Request to send SMS

* 		

* @version  9.0

* @created  Fri Sep 25 , 2008

* @updated  Fri Sep 25  , 2008

*/

function DoEmailSMS($uid,$mailid,$type,$message=0, $Data=array()){

	global $DB;

	$val = $DB->Row("SELECT members_privacy.uid, members_privacy.email_winks, members_privacy.email_msg, members_privacy.email_friends,	members_privacy.email_match, members_privacy.Notifications, members.username, members.email, members_privacy.SMS_email, members_privacy.SMS_country, members_privacy.SMS_number, members_privacy.SMS_credits FROM members_privacy, members WHERE members_privacy.uid = members.id AND members_privacy.uid=".$uid);

	if($val[$type] =="yes"){

		$Data['email'] =  $val['email'];

		$Data['username'] =  $val['username'];

		$Data['from_username'] = $_SESSION['username'];																	

		SendTemplateMail($Data, $mailid);

	}

	if(strlen($message) > 1 && $val['SMS_credits'] > 0 && UPGRADE_SMS =="yes"){

		// SEND SMS NOTIFICATION

		$val['message'] = substr($message,0,30);

		//$val['SMS_country'] = MakeCountry($val['SMS_country']);

		DoSMS($val);

	}

}

/**

* Info: Used to send all of the emails

* 		

* @version  9.0

* @created  Fri Sep 25 , 2008

* @updated  Fri Sep 25  , 2008

*/

function ReplaceEmailContent($Data, $EmailContent){

	global $DB;

	## change email content

	$EmailContent = str_replace("(date)", 		date('l jS \of F Y'), 		$EmailContent);	

	if(isset($Data['username'])){ 		$EmailContent = str_replace("(username)", 		$Data['username'], 		$EmailContent); }

	if(isset($Data['from_username'])){	$EmailContent = str_replace("(from_username)", 	$Data['from_username'], $EmailContent); }

	if(isset($Data['password'])){		$EmailContent = str_replace("(password)", 		$Data['password'], 		$EmailContent); }

	if(isset($Data['email'])){			$EmailContent = str_replace("(email)", 			$Data['email'], 		$EmailContent); }

	if(isset($Data['profile_complete'])){	$EmailContent = str_replace("(profile_complete)", $Data['profile_complete'], $EmailContent); }

	if(isset($Data['name'])){			$EmailContent = str_replace("(name)", 			$Data['name'], 			$EmailContent); }

	if(isset($Data['message'])){		$EmailContent = str_replace("(message)", 		$Data['message'], 		$EmailContent); }

	if(isset($Data['custom'])){			$EmailContent = str_replace("(custom)", 		$Data['custom'], 		$EmailContent); }

	if(isset($Data['gender'])){			$EmailContent = str_replace("(gender)", 		MakeGender($Data['gender']), 		$EmailContent); }
	


	if(isset($Data['meet_me_username'])){			$EmailContent = str_replace("(meet_me_username)", 		$Data['meet_me_username'], 		$EmailContent); }
	
	if(isset($Data['meet_me_profile_link'])){			$EmailContent = str_replace("(meet_me_profile_link)", 		$Data['meet_me_profile_link'], 		$EmailContent); }

	


	if(isset($Data['country'])){ $EmailContent = str_replace("(country)",MakeCountry($Data['country']),$EmailContent); }

	if(isset($Data['location'])){ $EmailContent = str_replace("(location)", $Data['location'], $EmailContent); }

	if(isset($Data['headline'])){ $EmailContent = str_replace("(headline)", $Data['headline'], $EmailContent); }

	if(isset($Data['active'])){			$EmailContent = str_replace("(status)", 		$Data['active'], 		$EmailContent); }

	if(isset($Data['updated'])){		$EmailContent = str_replace("(updated)", 		$Data['updated'], 		$EmailContent); }

	if(isset($Data['hits'])){		$EmailContent = str_replace("(hits)", 		$Data['hits'], 		$EmailContent); }

	if(isset($Data['age'])){		$EmailContent = str_replace("(age)", 		MakeAge($Data['age']), 		$EmailContent); }

	if(isset($Data['link'])){			$EmailContent = str_replace("(link)", 			$Data['link'], 			$EmailContent); }

	if(isset($Data['ipaddress'])){			$EmailContent = str_replace("(ipaddress)", 			$Data['ipaddress'], 			$EmailContent); }

	if(isset($Data['custom'])){		// ACTIVATION CODE LINK		

		if(VALIDATE_EMAIL ==1){		

				$alink = "<a href='".DB_DOMAIN."index.php?valMe=".$Data['custom']."&email=".$Data['email']."'>".DB_DOMAIN."index.php?valMe=".$Data['custom']."&email=".$Data['email']."</a>";

				$EmailContent = str_replace("(link)", 		$alink, 		$EmailContent); 		

		}else{

			$EmailContent = str_replace("(link)","",$EmailContent); 

		}		

	}

	// MEMBER MATCHES

	$pos = strpos($EmailContent, "(matches)");

	if ($pos === false) {} else {

		$EmailM="";

		require_once(	str_replace("func","",dirname(__FILE__))."/API/api_functions.php" );

		$MatchData = MyMatchResults($Data['id'], 10);

		if(!empty($MatchData) && is_array($MatchData)){

			$i=1;

			$EmailM .="<center>";

			foreach($MatchData as $value){

				if($i % 2){ $bgColor ="#FFF3EE"; }else{ $bgColor ="#FFE9DF"; }

				if($value['location'] ==0){ $value['location']=""; }

				$EmailM .='<table cellspacing="0" cellpadding="0"  bgcolor="'.$bgColor.'" style="border-top:1px solid #FFE0D3;" width="600px"><tr><td width="134"><p align="center"><a href="'.$value['link'].'"><img width="56" height="56" src="'.$value['image'].'" alt="'.$value['username'].'"></a><br><a href="'.$value['link'].'" style="font-size: 12px;font-weight: bold; color:#333333"><strong>'.$value['username'].' </strong></a></p></td><td width="130" align="center" style="font-size:12px;">  <p>'.$value['age'].' years / '.$value['gender'].'<br><strong>'.$value['country'].'</strong><br><strong>'.$value['location'].'</strong> <br></p></td><td width="334" align="center"><p style="font-size:16px;font-weight:bold;">'.$value['headline'].'</p><p style="font-size:12px;">'.$value['description'].'</p></td></tr></table>';

				$i++;

			}

			$EmailM .="</center>";

		}	

		$EmailContent = str_replace("(matches)", 			$EmailM, 			$EmailContent);

	}

	$EmailContent = str_replace("(link)", 			isset($Data['link']), 			$EmailContent); 

	$EmailContent = str_replace("(website)", "<a href='".DB_DOMAIN."'>".DB_DOMAIN."</a>", $EmailContent);

	return $EmailContent;

}

function SendTemplateMail($Data, $TemplateID){

	global $DB;

	$DB_MAIL = new htmlMimeMail();

	$today_time=TIME_NOW;

	$today_date=DATE_NOW;		

	if(!isset($Data['email'])){ return 2; }

	## Get the email body for the database

	if($TemplateID != ""){

		$row = $DB->Row("SELECT name, content FROM email_newsletters WHERE nid ='".$TemplateID."' LIMIT 1");

		## Show contact message not template message

		$EmailContent = $row['content'];	

		$EmailSubject= $row['name'];

	}else{

		## no template selected

		return;

	}

	// SENDING FROM

	$EmailSender = SEND_ADMIN_NAME;

//if(isset($Data['username'])){ $EmailSender = $Data['username']; }

	// BASIC EMAIL SRTING REPLACE

	$EmailSubject = ReplaceEmailContent($Data, $EmailSubject);	

	$EmailContent = ReplaceEmailContent($Data, $EmailContent);	

	// EMAIL TRACKING CODE

	if(stristr($EmailContent, '(tracking_id)') === FALSE) {}else{		

		$TrackingCode = $DB->Row("SELECT content FROM email_newsletters WHERE name='tracking'");

		$EmailContent = str_replace("(tracking)", $TrackingCode['content'], $EmailContent);		

		// replace the tracking id with the image code

		$ImgTranslate = "<img src='".DB_DOMAIN."inc/exe/tracking/NS_OPEN.php?email=".$Data['email']."&nid=".$TemplateID."' width='0' height='0'>";

		$EmailContent = str_replace("(tracking_id)", $ImgTranslate, $EmailContent);		

		// add database tracking

		$DB->Insert("INSERT INTO `email_sendtime` (`email` ,`send_date` ,`nid` ,`status`)VALUES ('".$Data['email']."', '".DATE_NOW."', '$TemplateID', 'sent')");	

	}	

	// sctrip out R/N

	$EmailSubject = eMeetingOutput($EmailSubject,true);

	$EmailContent = eMeetingOutput($EmailContent,true);

	// ARE WE SENDING VIA SMTP OR SENDMAIL ?

	if(USE_SMTP =="yes"){

		// SEND SMTP

		$text = "";

		$html = $EmailContent;

		$DB_MAIL->setHtml($html, $text);

		$DB_MAIL->setSMTPParams(SMTP_SERVER, SMTP_PORT, "",SMTP_FROM_NAME, SMTP_USERNAME,SMTP_PASSWORD);

		$DB_MAIL->setReturnPath(ADMIN_EMAIL);

		//$DB_MAIL->setFrom('"'.$EmailSender.'" <'.ADMIN_EMAIL.'>');

		$DB_MAIL->setSubject($EmailSubject);

		$result = $DB_MAIL->send(array($Data['email']), 'smtp');

	}else{

		@ini_set(sendmail_from, ADMIN_EMAIL);	

		# Common Headers

		$text = "";

		$html = $EmailContent;

		$DB_MAIL->setHtml($html, $text);

		$DB_MAIL->setReturnPath(ADMIN_EMAIL);

		//$DB_MAIL->setFrom('"'.$EmailSender.'" <'.ADMIN_EMAIL.'>');

		$DB_MAIL->setSubject($EmailSubject);

		$DB_MAIL->setHeader('X-Mailer', 'eMeeting Dating Software');

		$result = $DB_MAIL->send(array($Data['email']));

		@ini_restore(sendmail_from);

	}

	 return 2;

}

/**

* Info: Displays the Country List

* 		

* @version  9.0

* @created  Fri Sep 25 , 2008

* @updated  Fri Sep 25  , 2008

*/

function DisplayCountries($value="", $ShowID=false){

			global $DB;

			$string = "";

			// MAKE SESSION COUNTRY

			//if($value !="" && !is_numeric($value)){   $value=MakeCountryID($value);  }

			// DISLAY DEFAULT COUNTRY

			if(strlen($value) > 1){

				if(isset($_SESSION['clever_ip_country_name']) && $value == $_SESSION['clever_ip_country_name']){	

				$string .= '<option value="'.MakeCountryID($_SESSION['clever_ip_country_name']).'">'.$_SESSION['clever_ip_country_name'].'</option><option value="0">--------</option>';	

				}else{

				if(is_numeric($value)){ $valueCaption = MakeCountry($value); }else{ $valueCaption=$value; }

				$string .= '<option value="'.$value.'">'.$valueCaption.'</option><option value="0">--------</option>';	

				}

			}else{

				$string .= '<option value="0">--------</option>';			

			}

			// GET DATABASE COUNTRY ROWS

			$FindCountry = $DB->Query("SELECT fvid, fvCaption,`default` FROM field_list_value WHERE fvFid=25 AND lang='".D_LANG."' ORDER BY fvCaption ASC");

			$tfO =1;

			while( $cc = $DB->NextRow($FindCountry) ){			

					if(isset($_POST['SeV']['1']) && $_POST['SeV']['1'] == $cc['fvid']){

						$selected="selected";

					}
					else if($cc['default'] =="yes"){

					$selected="selected";

					}else{

					$selected="";

					}		

					if($value != ""){

							$string .= '<option value="'.$cc['fvid'].'">'.$cc['fvCaption'].'</option>';

					}else{

							$string .= '<option value="'.$cc['fvid'].'" '.$selected.'>'.$cc['fvCaption'].'</option>';	

					}				

				$tfO++;

			}

			// BACKUP INCASE NOT VALUES FOUND

			if($tfO ==1){

					$FindCountry = $DB->Query("SELECT fvid, fvCaption,`default` FROM field_list_value WHERE fvFid=25 ORDER BY fvOrder ASC");

					while( $cc = $DB->NextRow($FindCountry) ){

						if($value != ""){

							$string .= '<option value="'.$cc['fvid'].'">'.$cc['fvCaption'].'</option>';

						}else{

							$string .= '<option value="'.$cc['fvid'].'" '.$cc['default'].'>'.$cc['fvCaption'].'</option>';	

						}

						$tfO++;

					}

			}

			// COMPLETE SELECT

			 $string .= '</select>';

			// DEFAULT SELECTION

			if($value !=""){

				$SelectCountry = $value;

			}else{

				$FindC = $DB->Row("SELECT fvCaption FROM field_list_value WHERE fvFid=25 ORDER BY `default` ASC LIMIT 1");

				$SelectCountry = $FindC['fvCaption'];				

			}

			return $string;

}

/**

* Info: Displays the States List

* 		

* @version  9.0

* @created  Fri Sep 25 , 2008

* @updated  Fri Sep 25  , 2008

*/

function DisplayStates($value="", $ShowID=false){

			global $DB;

			$string = "";

			$string .= '<option value="0">------------</option>';			



			

			// GET DATABASE STATES ROWS

			$FindState = $DB->Query("SELECT fvid, fvCaption,`default` FROM field_list_value WHERE fvFid=54 AND linked_cap_id=569 AND lang='".D_LANG."' ORDER BY fvCaption ASC");

			$tfO =1;

			while( $cc = $DB->NextRow($FindState) ){			

					if($cc['default'] =="yes"){

					$selected="selected";

					}else{

					$selected="";

					}		

					if($value != ""){

							$string .= '<option value="'.$cc['fvid'].'">'.$cc['fvCaption'].'</option>';

					}else{

							$string .= '<option value="'.$cc['fvid'].'" '.$selected.'>'.$cc['fvCaption'].'</option>';	

					}				

				$tfO++;

			}

			// COMPLETE SELECT

			 $string .= '</select>';

			return $string;

}



/**

* Info: Displays the location for the country

* 		

* @version  9.0

* @created  Fri Sep 25 , 2008

* @updated  Fri Sep 25  , 2008

*/

function Displaylocations($value=""){

	/* NOT USED IN V9 */

	return $value;

}

##########################################################################################

## 								SMS FUNCTIONS											##

##########################################################################################

function MakeCountry1($id, $fvFid=""){

	/*global $DB;

	if(!is_numeric($id)){

	return $id;

	}elseif($id == 0 || $id == ""){

		return "na";

	}else{

		if(is_numeric($fvFid)){ $SaveID = $id."0".$fvFid; }else{ $SaveID =$id; }

		if(isset($_SESSION['country'][$SaveID]['name'])){

		return $_SESSION['country'][$SaveID]['name'];

		}else{

			if(is_numeric($fvFid)){ $Extra ="AND fvFid='".$fvFid."'"; }else{ $Extra =""; }

			$re3 = $DB->Row("SELECT fvCaption FROM field_list_value WHERE fvid='".strip_tags($id)."'  ".$Extra." AND lang='".D_LANG."' LIMIT 1");

			if(empty($re3)){

			$re3 = $DB->Row("SELECT fvCaption FROM field_list_value WHERE fvid='".strip_tags($id)."' ".$Extra." LIMIT 1");

			}

			$_SESSION['country'][$SaveID]['name'] = $re3['fvCaption'];

			return $re3['fvCaption'];

		}

	}*/

	global $DB;
	

	$result = $DB->Row("SELECT geo_network_country_id,country_name FROM geo_network_countries WHERE geo_network_country_id = '$id'");

	
	return (isset($result->country_name)) ? $result->country_name : 'N/A';

}

function DoSMS($DataArray){

	global $DB;

	if($DataArray['SMS_email'] =="on" && $DataArray['SMS_number'] != "" && $DataArray['SMS_credits'] > 0 && UPGRADE_SMS =="yes"){

		// DOES THE USER HAVE CREDITS ??

		// BUILD SMS MESSAGE

		if(is_numeric($DataArray['SMS_country'])){ $DataArray['SMS_country'] = MakeCountry1($DataArray['SMS_country']); }

		$SMSMsgString = "SMS Message Alert - Message From: ".$_SESSION['username']." - ".$DataArray['message'].".. - Login at: ".DB_DOMAIN." to read the rest.";

		$WhatHappened = SendSMS($_SESSION['username'], $DataArray['SMS_number'], $SMSMsgString, $DataArray['SMS_country'], KEY_ID);									

		// retrieve confirmation from system that message was sent

		$DB->Update("UPDATE members_privacy SET SMS_credits=SMS_credits-1 WHERE uid='".$DataArray['uid']."' LIMIT 1");

		switch($WhatHappened){

				case "1": { // MESSAGE SENT

				// ALL DONE, LETS REMOVE A CREDIT FROM THIS USER

				} break;

				case "2": { // MESSAGE FAILED

				// OPS, TELL THIS USER THE MESSAGE COULDNT BE SENT

				// OR DO NOTHING FOR NOW

				} break;

				case "3": { // SYSTEM DIDNT LIKE THE LOGIN DETAILS

				// OPS, TELL THIS USER TO TRY AGAIN LATER

				SendSMSWarning();

				} break;

		}						

	}

	return 0;

}

 /**

	 * Info: fucntion used to check a members messenger account for their contact list

	 * 		

	 * @version  8.0

	 * @created  Fri Jan 18 10:48:31 EEST 2008

	 * @updated  Fri Jan 18 10:48:31 EEST 2008

	 */

function ContactListChecker($email, $password){

			if (!$curld = curl_init()) {

						return 0;

			}else{

					require_once("inc/classes/class_imfunctions.php");

					$CookiePath = str_replace("/images", "", PATH_IMAGE);

					$RunningCount =1;

					$ContactsDataArray = array();

					if (eregi('yahoo', $email)) {

						$system="yahoo";

					}elseif (eregi('gmail', $email)) {

						$system="gmail";

					}elseif (eregi('googlemail', $email)) {

						$system="gmail";

					}elseif (eregi('aol', $email)) {

						$system="aol";

					}elseif (eregi('hotmail', $email)) {

						$system="hotmail";

					}else{

						return 0;

					}

					$contactemails=eMeeting_Contacts($email,$password, $system,$CookiePath);

					if(is_array($contactemails)){

						// GET EMAIL ADDRESS ARRAY

						//$EmailArray = GetEmailArray();



							foreach($contactemails as $contact){							

									$ContactsDataArray[$RunningCount]['username'] = htmlspecialchars(@$contact[0],ENT_QUOTES);

									$ContactsDataArray[$RunningCount]['email'] = htmlspecialchars(@$contact[1],ENT_QUOTES);									

									$RunningCount++;			

							}							

							return $ContactsDataArray;

					}else{						

						return 0;

					}

			}

}	

##########################################################################################

## 								CALENDAR FUNCTIONS										##

##########################################################################################

function GetFriendIDS(){

		global $DB;

		$myFriends = array();

		$fString=" AND (";

		$run=1;

		$DB->Query("SET sql_big_selects=1"); // UNCHECK THIS IF YOU HAVE PROBLMS WITH BIG QUERY

		$result = $DB->Query("SELECT DISTINCT  members.id AS uid

			FROM members_network 

			LEFT JOIN members ON ( members.id = members_network.to_uid OR  members.id = members_network.uid )

			WHERE (members_network.uid='".$_SESSION['uid']."' OR  members_network.to_uid='".$_SESSION['uid']."') AND members.username != ( '".$_SESSION['username']."' ) AND members_network.type= ( '2' ) GROUP BY members.id");



		while( $af = $DB->NextRow($result) ){

			// build string

			$fString .= " calendar_data.uid=('".$af['uid']."')  OR  ";

			$run++;

		}

		$fString .=" calendar_data.uid=('".$_SESSION['uid']."') OR calendar_data.vis='all' ) ";

		return $fString;

}

///////////////////////////////////////////////////////////////////////////////////////////

// DO NOT DELETE THE FUNCTIONS BELOW

///////////////////////////////////////////////////////////////////////////////////////////

function PageNumbers($max_results,$page, $show_next_box=true){

	if($page ==0){$page=1; }

	require_once(	str_replace("func","",dirname(__FILE__))."/classes/class_pagenumbers.php"			);

 	$SearchNav = "<div id='PageNums'>";   

	$SearchNav .= "";

    $pag = new pageNumbers($page, $GLOBALS['total_pages'], 2);

    //the first and the last page number will always be displayed

    //we need a separator between the first/last page number and the middle page numbers

    $separator = "<a href='#' style='background:white;border:0px;color:#666;'>...</a>";

    foreach($pag->numbers as $pageNumber=>$type)

    {

        //each number has a type

        //there are 4 types:

        //  "current" - the curent page number;

        //  "link" - link to other page numbers

        //  "separatorAfter" - first line number when it needs the separator (separator after number)

        //  "separatorBefore" - last line number when it needs the separator (separator before number)  

        switch($type)

        {

            case "current": {

				$SearchNav .= "<a href='javascript:void(0)' class='selected'> ".$GLOBALS['_LANG']['_page']." ".$pageNumber." ".$GLOBALS['_LANG']['_of']." ".$GLOBALS['total_pages']." </a>";

             } break;

            case "link": {

				$SearchNav .= "<a href='javascript:void(0)' onclick=\"javascript:ChangePage('".$pageNumber."');\">".$pageNumber."</a>";

             } break;

            case "separatorAfter": $SearchNav .= " <a href='javascript:void(0)' onclick=\"javascript:ChangePage('".$pageNumber."');\">" . $pageNumber . '</a>' . $separator . '';

                break;

            case "separatorBefore": $SearchNav .= '' . $separator . " <a href='javascript:void(0)' onclick=\"javascript:ChangePage('".$pageNumber."');\">" . $pageNumber . '</a>';

                break;

        }

    }

	$SearchNav .= "<div class='ClearAll'></div></div><div class='ClearAll'></div>";

	return $SearchNav;

}

	 /**

	 * Info: Creates an array of bad words to filter

	 * 		

	 * @version  8.0

	 * @created  Fri Jan 18 10:48:31 EEST 2008

	 * @updated  Fri Jan 18 10:48:31 EEST 2008

	 */

	function CreateBadWordFilter(){

		global $DB;

		$BadWords = array();$bw = 1;

		$result = $DB->Query("SELECT * FROM badwords");

		while( $im = $DB->NextRow($result) ){

			$BadWords['word'][$bw] = $im['word'];  

			$bw ++;

		}

		return $BadWords;

	}

	function filter_str($text,$BadWords) {

		global $DB;

		## define variables

		$output = $text; 

		if(is_numeric($text)){ 

			return $text; 

		}elseif(is_array($BadWords)){			

				for($i=0; $i <= count($BadWords['word']); $i++){		

					if(isset($BadWords['word'][$i])){

						$output = str_replace($BadWords['word'][$i],BADWORD_REPLACE,$output);

					}		

				}	

		}

		return $output;

	}

	 /**

	 * Page: Common Functions for checking data input

	 * 		

	 * @version  8.0

	 * @created  Fri Jan 18 10:48:31 EEST 2008

	 * @updated  Fri Jan 18 10:48:31 EEST 2008

	 */

	function CheckAddSlashes( $string ) {	

		if (get_magic_quotes_gpc()==1) {

			return $string;	

		} else { 

			return  addslashes ( $string );	

		}	

	}

	 /**

	 * Page: Show the time since event date

	 * 		

	 * @version  8.0

	 * @created  Fri Jan 18 10:48:31 EEST 2008

	 * @updated  Fri Jan 18 10:48:31 EEST 2008

	 */

	function showTimeSince($date){

	// FORMAT STRING MAKING SURE IT CONTAINS 

	// BOTH DATE AND TIME FOR CALCULATIONS

	if(defined(DATE_DISPLAY_FORMAT) && DATE_DISPLAY_FORMAT == "m-d-Y"){ // Y-m-d

		$dd = explode(" ",$date);

		$regs = explode("-",$dd[0]);

		$ThisDate = $regs[2]."-".$regs[0]."-".$regs[1]. " ".$dd[1];

	}elseif(defined(DATE_DISPLAY_FORMAT) && DATE_DISPLAY_FORMAT == "m-Y-d"){

		$dd = explode(" ",$date);

		$regs = explode("-",$dd[0]);

		$ThisDate = $regs[1]."-".$regs[0]."-".$regs[2]. " ".$dd[1];

	}else{

		$ThisDate = $date;

	}

		$timedate = date("Y-m-d H:i:s");

		//$elapsed = round(get_elapsed_time( $ThisDate, $timedate, 'seconds', 3 ) );	
		$elapsed = strtotime($timedate) - strtotime($ThisDate);	
		$distanceInMinutes = round($elapsed / 60);

		if ( $distanceInMinutes <= 1 ) {             

                return str_replace("%1",$elapsed,$GLOBALS['LANG_COMMON'][26]);           

        }

        if ( $distanceInMinutes < 45 ) {

			return str_replace("%1",$distanceInMinutes,$GLOBALS['LANG_COMMON'][27]); 

        }

        if ( $distanceInMinutes < 90 ) {

           return str_replace("%1","1",$GLOBALS['LANG_COMMON'][32]);

        }

        if ( $distanceInMinutes < 1440 ) {

			return str_replace("%1",round(floatval($distanceInMinutes) / 60.0),$GLOBALS['LANG_COMMON'][32]);

        }

        if ( $distanceInMinutes < 2880 ) {

            return '1 '.$GLOBALS['_LANG']['_days'] . " ".$GLOBALS['_LANG']['_ago'];

        }

        if ( $distanceInMinutes < 43200 ) {

			return str_replace("%1",round(floatval($distanceInMinutes) / 1440),$GLOBALS['LANG_COMMON'][28]);

        }

        if ( ($distanceInMinutes < 86400)  && ($distanceInMinutes < 0) )  {

            return $GLOBALS['_LANG']['_about'].' 1 '.$GLOBALS['_LANG']['_month']." ".$GLOBALS['_LANG']['_ago'];

        }

        if ( $distanceInMinutes < 525600 ) {

			return str_replace("%1",round(floatval($distanceInMinutes) / 43200),$GLOBALS['LANG_COMMON'][30]); 

        }

        if ( $distanceInMinutes < 1051199 ) {

            return $GLOBALS['_LANG']['_about'].' 1 '.$GLOBALS['_LANG']['_year']." ".$GLOBALS['_LANG']['_ago'];

        }

        return substr($ThisDate,0,10);  

	}

	function get_elapsed_time(

		$time_start,

		$time_end,

		$units = "seconds",

		$decimals = 2

	)

	{

		$divider['years']   = ( 60 * 60 * 24 * 365 );

		$divider['months']  = ( 60 * 60 * 24 * 365 / 12 );

		$divider['weeks']   = ( 60 * 60 * 24 * 7 );

		$divider['days']    = ( 60 * 60 * 24 );

		$divider['hours']   = ( 60 * 60 );

		$divider['minutes'] = ( 60 );

		$divider['seconds'] = 1;

		$elapsed_time = ( ( get_mysql_to_epoch( $time_end )

						- get_mysql_to_epoch( $time_start ) )

						

						/ $divider[$units] );

		$elapsed_time = sprintf( "%0.{$decimals}f", $elapsed_time );

		return $elapsed_time;

	}

	function get_mysql_to_epoch( $date )

	{

		list( $year, $month, $day, $hour, $minute, $second )

			= preg_match( '([^0-9])', $date );

		return date( 'U', @mktime( $hour, $minute, $second, $month, $day,

			$year ) );

	}

function DisplayMainPageInfo($data, $page, $show_page,  $title, $extra1=""){

	if(!array($data)){ return ""; }
	if(D_TEMP == "v17red") {

		print '
			<style>
			.topTitle { font-size:14px; font-weight:bold; padding-bottom:0px; margin-bottom:0px;}
			.speadlist li {  float:left; }
			.speadlist li a { text-decoration:none;}
			.TopAdverts { display:none;}
			.TopGroups { display:none;}
			.TopCalendar { display:none;}
			</style>

			<div class="contentf"><div style=""><div style="font-weight:bold;"> <h3 style="padding:0px; margin:0px;"></h3>

			</div><div class="contenti" style="padding:10px;"><div class="row">

			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="padding-left:0px;"><div><img src="'.$data['image'].'" style="float:left; margin-right:20px;" width="96" height="96"> </div></div>

			<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8"><h2 style="line-height: 20px; font-size: 17px; margin-bottom: 0; margin-top: 0px;">'.$data['title'].'</h2><p style="font-size: 15px; font-weight: bold; margin-bottom: 5px;">'.$data['sub_title'].'</p>';
				print '	<p class="topTitle" style="margin-top:0px;"> '.$GLOBALS['_LANG']['_information'].' </p>
		<hr>
		<p>'.$data['comments'].'</p></div></div>';
	}

	else

	{
		
		$data['title'] = (isset($data['title'])) ? $data['title'] : '';
		$data['sub_title'] = (isset($data['sub_title'])) ? $data['sub_title'] : '';
		
		print '

			<style>
			.topTitle { font-size:14px; font-weight:bold; padding-bottom:0px; margin-bottom:0px;}
			.speadlist li {  float:left; }
			.speadlist li a { text-decoration:none;}
			.TopAdverts { display:none;}
			.TopGroups { display:none;}
			.TopCalendar { display:none;}
			</style>
		
		
			<div class="contentf"><div style=""><div style="font-weight:bold;"> <h3 style="padding:0px; margin:0px;"></h3>

			</div><div class="contenti" style="padding:10px;"><div class="row">

			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><div><img src="'.$data['image'].'" style="float:left; margin-right:20px;" width="96" height="96"> </div></div>

			<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8"><h2 style="line-height: 20px; font-size: 17px; margin-bottom: 0; margin-top: 0px;">'.$data['title'].'</h2><p style="font-size: 15px; font-weight: bold; margin-bottom: 5px;">'.$data['sub_title'].'</p>';

				print '	<p class="topTitle" style="margin-top:0px;"> '.$GLOBALS['_LANG']['_information'].' </p>

			<hr>

			<p>'.$data['comments'].'</p></div></div>';

	}

	

	if(isset($data['website']) && strlen($data['website']) > 5){
		print '<p> <a href="'.$data['website'].'" style="text-decoration:none;" target="_blank"><img src="'.DB_DOMAIN.'images/DEFAULT/_acc/add.png" align="absmiddle"> '.isset($GLOBALS['_LANG']['_visit']).' '.$GLOBALS['_LANG']['_website'].'</a> <p>';
	}

	// ATTACHMENT ALBUM ATA

	if(isset($data['attachment']) && $data['attachment'] !=0){
		print GetAttachmentAlbum($data['attachment']);
	}

	if(isset($data['image'])){   

		if(isset($data['user_image'])){$data['image'] = $data['user_image']; }

		print '<div style="padding:3px; background:#eee;color:#444444;line-height:31px; font-size:12px;">
			<a href="'.$data['user_link'].'"><img src="'.$data['image'].'" width="56" height="56" align="absmiddle" style="float:left; padding-right:20px;"></a>
			<span>';
	
		print $GLOBALS['_LANG']['_createdBy'].': <b style="font-size:16px;"><a href="'.$data['user_link'].'">'.$data['username'].'</a></b> ';

		if(isset($data['hits'])){ 

			 print $GLOBALS['_LANG']['_views'].': <b style="font-size:16px;">'.number_format($data['hits']).'</b> '; 

		}

		print '<span class="f_left" style="display:block; color:#666666;">';

		if(isset($data['date_updated'])){

			print ' '.$GLOBALS['_LANG']['_updated'].' @ '.$data['date_updated'].' '; 

		} 

		if(isset($data['rating'])){ 

			 print $GLOBALS['_LANG']['_rating'].': <b style="font-size:16px;">'.$data['percent'].'</b>%'; 

			if(round($data['percent']) > 50){

				print ' <img src="'.DB_DOMAIN.'images/DEFAULT/_icons/new/thumb_up.png" align="absmiddle">';

			}else{

				print ' <img src="'.DB_DOMAIN.'images/DEFAULT/_icons/new/thumb_down.png" align="absmiddle">';

			}

		}

		print '</span> <div class="ClearAll"></div></div>';

	}

	 $BlogTitle = str_replace(" ","-",$title);

	if($page !="groups"){

		print '<p class="topTitle">'.$GLOBALS['_LANG']['_speadWord'].'<p>

		<hr>

		<ul class="speadlist"><li>

		<a target="_blank" href="http://del.icio.us/post?title='.$BlogTitle.'&amp;url='.curPageURL().'" style="background: transparent url(images/DEFAULT/_acc/delicious.gif) no-repeat scroll left center; padding-left: 20px; margin-left: 10px;">&nbsp;</a> 

		</li><li>

		<a target="_blank" href="http://digg.com/submit?phase=2&amp;title='.$BlogTitle.'&amp;url='.curPageURL().'&amp;bodytext=This+is+documentation+for+the+Interspire+Email+Marketer+XML+API.+This+includes+descriptions+of+the+various+functions+and+how+they+are+used+showing+examples." style="background: transparent url(images/DEFAULT/_acc/digg.gif) no-repeat scroll left center; padding-left: 20px; margin-left: 10px;">&nbsp;</a> 

		</li><li>

		<a target="_blank" href="http://www.furl.net/storeIt.jsp?t='.$BlogTitle.'&amp;u='.curPageURL().'" style="background: transparent url(images/DEFAULT/_acc/furl.gif) no-repeat scroll left center; padding-left: 20px; margin-left: 10px;">&nbsp;</a> 

		</li><li>

		<a target="_blank" href="http://reddit.com/submit?title='.$BlogTitle.'&amp;url='.curPageURL().'" style="background: transparent url(images/DEFAULT/_acc/reddit.gif) no-repeat scroll left center; padding-left: 20px; margin-left: 10px;">&nbsp;</a> 

		</li><li>

		<a target="_blank" href="http://myweb2.search.yahoo.com/myresults/bookmarklet?title='.$BlogTitle.'&amp;u='.curPageURL().'&amp;popup=true" style="background: transparent url(images/DEFAULT/_acc/yahoo.gif) no-repeat scroll left center; padding-left: 20px;margin-left: 10px; ">&nbsp;</a> 

		</li>

		<li><a target="_blank" href="http://www.stumbleupon.com/submit?url='.curPageURL().'&title='.$BlogTitle.'" style="background: transparent url(images/DEFAULT/_acc/stumbleupon.gif) no-repeat scroll left center; padding-left: 20px;margin-left: 10px; ">&nbsp;</a> 

		</li>

		<li><a target="_blank" href="http://www.google.com/bookmarks/mark?op=edit&bkmk='.curPageURL().'&title='.$BlogTitle.'" style="background: transparent url(images/DEFAULT/_acc/google.gif) no-repeat scroll left center; padding-left: 20px;margin-left: 10px; ">&nbsp;</a> 

		</li>

		<li><a target="_blank" href="https://favorites.live.com/quickadd.aspx?marklet=1&mkt=en-us&url='.curPageURL().'&title='.$BlogTitle.'&top=1" style="background: transparent url(images/DEFAULT/_acc/live.gif) no-repeat scroll left center; padding-left: 20px;margin-left: 10px; ">&nbsp;</a> 

		</li><li>

		<a target="_blank" href="http://www.technorati.com/faves?add='.curPageURL().'" style="background: transparent url(images/DEFAULT/_acc/technorati.gif) no-repeat scroll left center; padding-left: 20px;margin-left: 10px; ">&nbsp;</a> 

		</li></ul><div class="ClearAll"></div><br>

	';

}

	if($page =="calendar" && is_array($extra1) && !empty($extra1)){ 

		print '<p class="topTitle">'.$GLOBALS['LANG_GLO_OPTIONS']['10'].'<p><hr>';

	//$FoundMe=0; 

		foreach($extra1 as $value){ 

		//if($value['id'] ==$_SESSION['uid']){ $FoundMe=1; } 

		print '<a href="'.getThePermalink('user',array('username' => $value['username'])).'"><img src="'.$value['image'].'" class="img_border" style="float:left; margin-right:20px;" width="48" height="48"></a>';

		}

	}

	if($page =="groups" && is_array($extra1) && !empty($extra1)){ 

		print '<p class="topTitle">'.$GLOBALS['_LANG']['_members'].'<p><hr>';

		$FoundMe=0; 

		foreach($extra1 as $value){ 

		if($value['id'] ==$_SESSION['uid']){ $FoundMe=1; } 

		print '<a href="'.getThePermalink('user',array('username' => $value['username'])).'"><img src="'.$value['image'].'" class="img_border" style="float:left; margin-right:20px;" width="48" height="48"></a>';

		}

	}

	if(!isset($PageTitle)){ $PageTitle=""; }

	if($page =="groups" && $data['joined'] =="no"){

	}else{

	print '<div class="clear"></div><p class="topTitle">'.$GLOBALS['_LANG']['_comments'].'<p>';

	displayCommentsBox("290", $page, $show_page, $data['uid'], $data['id'],$title,0);

	}

	print '<br><br></div><b class="i4f"></b><b class="i3f"></b><b class="i2f"></b><b class="i1f"></b></div></div><b class="b4f"></b><b class="b3f"></b><b class="b2f"></b><b class="b1f"></b>';

	if($page =="groups"){

	}
	else
	{

	}

}

function PageOptionsBox($data, $page, $sub){

	if(!isset($data['title'])){ $data['title']=DB_DOMAIN; }

	if(D_TEMP=='v17red')

	{

		if($_SESSION['uid'] == $data['uid']){

			print '<p style="margin-bottom:0px;"><a href="index.php?dll='.$page.'&sub=add&eid='.$data['id'].'" style="text-decoration:none;"> <img src="'.DB_DOMAIN.'images/DEFAULT/_icons/new/pencil.png" width="16" height="16" align="absmiddle" style="float:left;"> <p class="magin_v_17" style="margin-left:23px !important"> '.$GLOBALS['_LANG']['_edit'].'</p> </a></p><hr>';

		}

		## display delete functions for moderator

		if( isset($_SESSION['site_moderator_approve']) && $_SESSION['site_moderator_approve']=="yes" && $data['ThisApproved']=="no"){ 

			print '<p style="margin-bottom:0px;"><span><span id="Approvediv_'.$data['id'].'"><br><a href="javascript:void(0)" onClick="AdminLiveApprove(\''.$data['id'].'\', \''.$page.'\', \''.$sub.'\'); Effect.Fade(\'Approvediv_'.$data['id'].'\'); return false;" style="text-decoration:none">

			<img src="'.DB_DOMAIN.'images/DEFAULT/_icons/new/chk_on.png" align="absmiddle" style="float:left;"> <p class="magin_v_17" style="margin-left:23px !important"> '.$GLOBALS['_LANG']['_approve'].'</p></a></span></span></p><hr>';

		}

			print '	

			<p style="margin-bottom:0px;"><span><a href="javascript:void(0);" onclick="window.print ()" style="text-decoration:none;"><img src="'.DB_DOMAIN.'images/DEFAULT/_acc/IconPrint.gif" style="float:left;"><p class="magin_v_17" style="margin-left:23px !important"> '.$GLOBALS['LANG_GLO_OPTIONS']['2'].'</p></a></span></p><hr>

			<p style="margin-bottom:0px;"><span><a href="'.getThePermalink('invite').'" style="text-decoration:none;"><img src="'.DB_DOMAIN.'images/DEFAULT/_acc/IconEmail.gif" style="float:left;"> <p class="magin_v_17" style="margin-left:23px !important"> '.$GLOBALS['LANG_GLO_OPTIONS']['3'].'</p></a></span></p><hr>

			<p style="margin-bottom:0px;"><span><a href="'.getThePermalink('messages/create/'.$data['username']).'" style="text-decoration:none;"><img src="'.DB_DOMAIN.'images/DEFAULT/_acc/IconComment.png" style="float:left;"> <p class="magin_v_17" style="margin-left:23px !important">'.$GLOBALS['LANG_GLO_OPTIONS']['5'].'</p></a></span></p><hr>

			<p style="margin-bottom:0px;"><span><a href="javascript:void(0);" onClick="javascript:bookmark(\''.curPageURL().'\', \''.$data['title'].'\');" style="text-decoration:none;"><img src="'.DB_DOMAIN.'images/DEFAULT/_acc/IconFav.gif" style="float:left;"> <p class="magin_v_17" style="margin-left:23px !important">'.$GLOBALS['LANG_GLO_OPTIONS']['6'].'</p></a></span></p><hr>

			<p style="margin-bottom:0px;"><span><a href="javascript:void(0);" onclick="javascript:popPDF(\''.$page.'\','.$data['id'].', \''.DB_DOMAIN.'\');" style="text-decoration:none;"><img src="'.DB_DOMAIN.'images/DEFAULT/_acc/pdf.gif" style="float:left;"> <p class="magin_v_17" style="margin-left:23px !important">'.$GLOBALS['LANG_GLO_OPTIONS']['7'].' </p> </a></span></p><hr>

			';

	}

	else {

	 if($_SESSION['uid'] == $data['uid']){

		print '<p><a href="index.php?dll='.$page.'&sub=add&eid='.$data['id'].'" style="text-decoration:none;"> <img src="'.DB_DOMAIN.'images/DEFAULT/_icons/new/pencil.png" width="16" height="16" align="absmiddle">  &nbsp;&nbsp '.$GLOBALS['_LANG']['_edit'].'</a></p><hr>';

	}

	## display delete functions for moderator

	if( isset($_SESSION['site_moderator_approve']) && $_SESSION['site_moderator_approve']=="yes" && $data['ThisApproved']=="no"){ 

		print '<p><span><span id="Approvediv_'.$data['id'].'"><br><a href="javascript:void(0)" onClick="AdminLiveApprove(\''.$data['id'].'\', \''.$page.'\', \''.$sub.'\'); Effect.Fade(\'Approvediv_'.$data['id'].'\'); return false;" style="text-decoration:none">

		<img src="'.DB_DOMAIN.'images/DEFAULT/_icons/new/chk_on.png" align="absmiddle"> &nbsp;&nbsp '.$GLOBALS['_LANG']['_approve'].'</a></span></span></p><hr>';

	}

	print '	

	<p><span><a href="javascript:void(0);" onclick="window.print ()" style="text-decoration:none;"><img src="'.DB_DOMAIN.'images/DEFAULT/_acc/IconPrint.gif"> '.$GLOBALS['LANG_GLO_OPTIONS']['2'].'</a></span></p><hr>

	<p><span><a href="'.getThePermalink('invite').'" style="text-decoration:none;"><img src="'.DB_DOMAIN.'images/DEFAULT/_acc/IconEmail.gif"> '.$GLOBALS['LANG_GLO_OPTIONS']['3'].'</a></span></p><hr>

	<p><span><a href="'.getThePermalink('messages/create/'.$data['username']).'" style="text-decoration:none;"><img src="'.DB_DOMAIN.'images/DEFAULT/_acc/IconComment.png"> '.$GLOBALS['LANG_GLO_OPTIONS']['5'].'</a></span></p><hr>

	<p><span><a href="javascript:void(0);" onClick="javascript:bookmark(\''.curPageURL().'\', \''.$data['title'].'\');" style="text-decoration:none;"><img src="'.DB_DOMAIN.'images/DEFAULT/_acc/IconFav.gif"> '.$GLOBALS['LANG_GLO_OPTIONS']['6'].'</a></span></p><hr>

	<p><span><a href="javascript:void(0);" onclick="javascript:popPDF(\''.$page.'\','.$data['id'].', \''.DB_DOMAIN.'\');" style="text-decoration:none;"><img src="'.DB_DOMAIN.'images/DEFAULT/_acc/pdf.gif"> '.$GLOBALS['LANG_GLO_OPTIONS']['7'].' </a></span></p><hr>

	';

	}

}

function PageLinkBox(){
	if(D_TEMP == "v17red"){
		print '
			<div id="page_link" class=""><span class="event_heading">'.$GLOBALS['_LANG']['_page'].' '.$GLOBALS['_LANG']['_link'].'</span>
			<form id="page_link_form" name="page_link_form" style="padding:0px; margin:0px;">
			<textarea id="page_link" class="textarea_full"  style="width:100% !important; text-align:left;" 
			onclick=javascript:document.page_link_form.page_link.focus();document.page_link_form.page_link.select(); name="page_link" readOnly class="input">'.curPageURL().'
			</textarea> 
			</form></div>';
	}
	else {

		print ' 
			<h1>'.$GLOBALS['_LANG']['_page'].' '.$GLOBALS['_LANG']['_link'].'</h1>
			<form id="page_link_form" name="page_link_form" style="padding:0px; margin:0px;">
			<textarea id="page_link" class="textarea_full"  style="text-align:left;" 
			onclick=javascript:document.page_link_form.page_link.focus();document.page_link_form.page_link.select(); name="page_link" readOnly class="input">'.curPageURL().'
			</textarea> 
			</form>';	
	}
}

function curPageURL() {
	$url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].htmlspecialchars($_SERVER['REQUEST_URI']) : "http://".$_SERVER['SERVER_NAME'].htmlspecialchars($_SERVER['REQUEST_URI']);
	return $url;
}

function myCheckDNSRR($hostName, $recType = 'MX') {
	if(!empty($hostName)) {
   		exec("nslookup -type=$recType $hostName", $result);
		// check each line to find the one that starts with the host
   		// name. If it exists then the function succeeded.
		if(!empty($result)){
			return false;
		}
   		// otherwise there was no mail handler for the domain
		return true;
	}
	return true;
}

function rename_win($oldfile,$newfile) {
	if (@!rename($oldfile,$newfile)) {
		if (copy ($oldfile,$newfile)) {
			unlink($oldfile); return TRUE;
		}
		return FALSE;
	}
	return TRUE;
}

function dates_interconv( $date_str ) { 
	$dd = explode(" ",$date_str);
	$date_str = $dd[0];
	if(isset($dd[1]) && !empty($dd[1])){ $dd[1] = " ".$dd[1]; }else{ $dd[1]=""; }
	$date_format1 = $df_src = 'Y-m-d'; 
	if(!defined('DATE_DISPLAY_FORMAT')){ define('DATE_DISPLAY_FORMAT','Y-m-d'); }
	$date_format2=$df_des = DATE_DISPLAY_FORMAT; 
	$base_struc     = preg_split('[-]', $date_format1); 
	$date_str_parts = preg_split('[-]', $date_str ); 
	//$base_struc     = split('[/.-]', $date_format1); 
	//$date_str_parts = split('[/.-]', $date_str ); 
	$date_elements = array();  
	$p_keys = array_keys( $base_struc ); 
	foreach ( $p_keys as $p_key ) {
		if ( !empty( $date_str_parts[$p_key] )) {
			$date_elements[$base_struc[$p_key]] = $date_str_parts[$p_key];
		}
		else{
			return false; 
		}
	}
	$dummy_ts = @mktime( 0,0,0, $date_elements['m'],$date_elements['d'],$date_elements['Y']);  
	return date( $date_format2, $dummy_ts ).$dd[1];
}

// get members star sign

function getsign($date){

	if(!isset($GLOBALS['_LANG'])){ return ""; }

    list($year,$month,$day)=explode("-",$date); $ThisMonth=1;

	switch($month){
		case "JAN": { $ThisMonth =1; } break;
		case "FEB": { $ThisMonth =2; } break;
		case "MAR": { $ThisMonth =3; } break;
		case "APR": { $ThisMonth =4; } break;
		case "MAY": { $ThisMonth =5;} break;
		case "JUN": { $ThisMonth =6; } break;
		case "JUL": { $ThisMonth =7;} break;
		case "AUG": { $ThisMonth =8;} break;
		case "SEP": { $ThisMonth =9;} break;
		case "OCT": { $ThisMonth =10;} break;
		case "NOV": { $ThisMonth =11;} break;
		case "DEC": { $ThisMonth =12;} break;
		default: ($ThisMonth =round($month,1) );
	}

	$month = $ThisMonth;
     if(($month==1 && $day>20)||($month==2 && $day<20)){
          return $GLOBALS['_LANG']['_star12'];
     }else if(($month==2 && $day>18 )||($month==3 && $day<21)){
          return $GLOBALS['_LANG']['_star11'];
     }else if(($month==3 && $day>20)||($month==4 && $day<21)){
          return $GLOBALS['_LANG']['_star10'];
     }else if(($month==4 && $day>20)||($month==5 && $day<22)){
          return $GLOBALS['_LANG']['_star9'];
     }else if(($month==5 && $day>21)||($month==6 && $day<22)){
          return $GLOBALS['_LANG']['_star8'];
     }else if(($month==6 && $day>21)||($month==7 && $day<24)){
          return $GLOBALS['_LANG']['_star7'];
     }else if(($month==7 && $day>23)||($month==8 && $day<24)){
          return $GLOBALS['_LANG']['_star6'];
     }else if(($month==8 && $day>23)||($month==9 && $day<24)){
          return $GLOBALS['_LANG']['_star5'];
     }else if(($month==9 && $day>23)||($month==10 && $day<24)){
          return $GLOBALS['_LANG']['_star4'];
     }else if(($month==10 && $day>23)||($month==11 && $day<23)){
          return $GLOBALS['_LANG']['_star3'];
     }else if(($month==11 && $day>22)||($month==12 && $day<23)){
          return $GLOBALS['_LANG']['_star2'];
     }else if(($month==12 && $day>22)||($month==1 && $day<21)){
          return $GLOBALS['_LANG']['_star1'];
     }else{
		return $GLOBALS['_LANG']['_star1'];
	}
}

function roundup ($value){   return ceil($value*pow(10, 0))/pow(10, 0);}

function makeRandomPassword($PasswordLenght = 10) {   $pass=""; $salt = "0123456789123456789123456789123456789"; srand((double)microtime()*1000000); $i = 0; while ($i <= $PasswordLenght) {  $num = rand() % 33; $tmp = substr($salt, $num, 1); $pass = $pass . $tmp; $i++; }  return $pass; }

function SendSMSWarning(){mail(ADMIN_EMAIL,"SMS Alert System Failed","SMS System Failed. Please check your SMS system settings.");}

function DoAge($type=1){  if($type==1){ $name="Extra[age1]"; $name2 = "Extra[age2]"; }else{ $name="age1"; $name2 ="age2"; }  
	
	$String = "";

	$String .= '<table width="100" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td width="55">
				<select class="sc_select_b" id="search_age_from" onchange="searchAgerValidator(\'sf\');" name="'.$name.'" >
					<option value="18">--</option>';
					for ($i=18; $i <= 120; $i++) {
						if((isset($_POST['Extra']['age1']) && $_POST['Extra']['age1'] == $i) || (isset($_POST['age1']) && $_POST['age1'] == $i)){
							
							$String .= '<option value="'.$i.'" selected>'.$i.'</option>';

						}
						else{
							$String .= '<option value="'.$i.'">'.$i.'</option>';
						}
					}
					$String .= '</select></td> <td width="20"><div align="center">-</div></td> <td width="55"><select class= "sc_select_b" id="search_age_to" onchange="searchAgerValidator(\'st\');" name="'.$name2.'"><option value="99" selected>--</option>';

					for ($i=18; $i <= 120; $i++) {
						if((isset($_POST['Extra']['age2']) && $_POST['Extra']['age2'] == $i) || (isset($_POST['age2']) && $_POST['age2'] == $i)){
							
							$String .= '<option value="'.$i.'" selected>'.$i.'</option>';

						}
						else{
							$String .= '<option value="'.$i.'">'.$i.'</option>';
						}
					}

	$String .= '</select></td> </tr> </table>';
	return $String;

}

// Quick Search Age

function DoQuickAge($type=1){  if($type==1){ $name="Extra[age1]"; $name2 = "Extra[age2]"; }else{ $name="age1"; $name2 ="age2"; }  
	
	$String = "";
	


	$String .= '<div class="col-md-12">
	<div class="col-md-5" style="padding: 0px;">
	<span class="box-select">
		<select class="sc_select_b"  id="quick_search_age_from" onchange="searchAgerValidator(\'qsf\');" name="'.$name.'" >
			<option value="18">--</option>';
			for ($i=18; $i <= 120; $i++) {
				if((isset($_POST['Extra']['age1']) && $_POST['Extra']['age1'] == $i) || (isset($_POST['age1']) && $_POST['age1'] == $i)){
								
					$String .= '<option value="'.$i.'" selected>'.$i.'</option>';

				}
				else{
					$String .= '<option value="'.$i.'">'.$i.'</option>';
				}
			}
    $String .= '</select></span>
  </div>
  <div class="col-md-2 tocenter">
	<span class="mid-to">to</span>
  </div>
  <div class="col-md-5 pull-right" style="padding: 0px;">
	<span class="box-select">
	<select class= "sc_select_b"  id="quick_search_age_to" onchange="searchAgerValidator(\'qst\');" name="'.$name2.'"><option value="99" selected>--</option>';
	for ($i=18; $i <= 120; $i++) {
		if((isset($_POST['Extra']['age2']) && $_POST['Extra']['age2'] == $i) || (isset($_POST['age2']) && $_POST['age2'] == $i)){
			
			$String .= '<option value="'.$i.'" selected>'.$i.'</option>';

		}
		else{
			$String .= '<option value="'.$i.'">'.$i.'</option>';
		}
	}

    $String .= '</select></span>
  </div></div>';



 return $String; 
}

function SendSMS($username, $number, $message, $country, $key){

if(is_numeric($country) && function_exists('MakeCountry') ){ $country = MakeCountry($country); }  

$license = $key; 

$installed_host="advandate.com"; $installed_directory="/order"; $query_string="license=".$license; $query_string.="&access_ip=".$_SERVER['SERVER_ADDR']; $query_string.="&access_host=".$_SERVER['HTTP_HOST']; $query_string.="&username=".$username; $query_string.="&number=".$number; $query_string.="&message=".$message; $query_string.="&country=".$country;  $data=emeeting_exec_socket($installed_host, $installed_directory, "/validate_sms.php", $query_string); if ($data=="sent") { return 1; }  elseif ($data=="failed") { return 2; }  elseif ($data=="credits") { return 3; }  else{	} }

function selfURL() {

	$s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
	$protocol = strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/").$s;
	$port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);
	return $protocol."://".$_SERVER['SERVER_NAME'].$port.$_SERVER['REQUEST_URI']; 

}


function strleft($s1, $s2) {
	return substr($s1, 0, strpos($s1, $s2));
} 


function getBrowserType () {
	
	 $ua = strtolower($_SERVER['HTTP_USER_AGENT']);

	// you can add different browsers with the same way ..
	if(preg_match('/(chromium)[ \/]([\w.]+)/', $ua))
		$browser_agent = 'chromium';
	elseif(preg_match('/(chrome)[ \/]([\w.]+)/', $ua))
		$browser_agent = 'chrome';
	elseif(preg_match('/(safari)[ \/]([\w.]+)/', $ua))
		$browser_agent = 'safari';
	elseif(preg_match('/(opera)[ \/]([\w.]+)/', $ua))
		$browser_agent = 'opera';
	elseif(preg_match('/(msie)[ \/]([\w.]+)/', $ua))
		$browser_agent = 'msie';
	elseif(preg_match('/(mozilla)[ \/]([\w.]+)/', $ua))
		$browser_agent = 'mozilla';

	preg_match('/('.$browser_agent.')[ \/]([\w]+)/', $ua, $version);
	
	$browser_version = $version[2];

	return $browser_agent; 

}



function ValidateExternalCountry($ipaddress , $reg = 0){
	$query_string = '';
	if(isset($key)){
		$license = $key; 
		$query_string="license=".$license; 
	}
	$installed_host="advandate.biz"; 
	$installed_directory="/order"; 
	$query_string.="&access_ip=".$_SERVER['SERVER_ADDR'];
	$query_string.="&access_host=".$_SERVER['HTTP_HOST'];
	$query_string.="&license=".KEY_ID;
	$query_string.="&ipCode=".$ipaddress; 
	
	$data=emeeting_exec_socket($installed_host, $installed_directory, "/validate_country.php", $query_string);  

	if(!empty($data)){
		return $data;
	}
	else{
		return 0;
		} 
} 
function emeeting_exec_socket($http_host, $http_dir, $http_file, $querystring){

	$fp=@fsockopen($http_host, 80, $errno, $errstr, 5);
	if(!$fp){
		return false;
	} else {
		$data = array();
		$data[1] = file_get_contents("http://www.advandate.biz/order/validate_country.php?ipCode=".$_SERVER['REMOTE_ADDR']);
		
		return $data[1];
		} }
		
function emeeting_exec_socket_test($http_host, $http_dir, $http_file, $querystring){

	$fp=@fsockopen($http_host, 80, $errno, $errstr, 5);
	if(!$fp){
		return false;
	} else {
		$header="POST ".($http_dir.$http_file)." HTTP/1.0\r\n";
		$header.="Host: ".$http_host."\r\n";
		$header.="Content-type: application/x-www-form-urlencoded\r\n";
		$header.="User-Agent: eMeeting SMS Server (http://www.advandate.biz)\r\n";
		$header.="Content-length: ".@strlen($querystring)."\r\n";
		$header.="Connection: close\r\n\r\n";
		$header.=$querystring; 
		$data=false; 
		@fputs($fp, $header);
		$status=@socket_get_status($fp);
		while (!feof($fp)&&$status) {
			$data.= fgets($fp, 1024);
			$status=socket_get_status($fp);
		}
		@fclose ($fp);
		if (!$data) {
			return false;
		} 
		print_r($data);
		die;
		$data=explode("\r\n\r\n", $data, 2);
		
		print_r($data);
		die;
		return $data[1]; 
	}
}

/**

 * get_redirect_url()

 * Gets the address that the provided URL redirects to,

 * or FALSE if there's no redirect.

 *

 * @param string $url

 * @return string

 */

function get_redirect_url($url){

    $redirect_url = null;

 

    $url_parts = @parse_url($url);

    if (!$url_parts) return false;

    if (!isset($url_parts['host'])) return false; //can't process relative URLs

    if (!isset($url_parts['path'])) $url_parts['path'] = '/';

      

    $sock = fsockopen($url_parts['host'], (isset($url_parts['port']) ? (int)$url_parts['port'] : 80), $errno, $errstr, 30);

    if (!$sock) return false;

      

    $request = "HEAD " . $url_parts['path'] . (isset($url_parts['query']) ? '?'.$url_parts['query'] : '') . " HTTP/1.1\r\n";

    $request .= 'Host: ' . $url_parts['host'] . "\r\n";

    $request .= "Connection: Close\r\n\r\n";

    fwrite($sock, $request);

    $response = '';

    while(!feof($sock)) $response .= fread($sock, 8192);

    fclose($sock);

    if (preg_match('/^Location: (.+?)$/m', $response, $matches)){
        if ( substr($matches[1], 0, 1) == "/" )
            return $url_parts['scheme'] . "://" . $url_parts['host'] . trim($matches[1]);
        else
            return trim($matches[1]);
    } else {
        return false;
    }

}


/**
 * get_all_redirects()
 * Follows and collects all redirects, in order, for the given URL.
 *
 * @param string $url
 * @return array
 */

function get_all_redirects($url){

    $redirects = array();

    while ($newurl = get_redirect_url($url)){

        if (in_array($newurl, $redirects)){

            break;

        }

        $redirects[] = $newurl;

        $url = $newurl;

    }

    return $redirects;

}

 

/**

 * get_final_url()

 * Gets the address that the URL ultimately leads to.

 * Returns $url itself if it isn't a redirect.

 *

 * @param string $url

 * @return string

 */

function get_final_url($url){

    $redirects = get_all_redirects($url);

    if (count($redirects)>0){

        return array_pop($redirects);

    } else {

        return $url;

    }

}


/*Author -- Navpreet kaur*/

function include_script_files()
{
	$script_files;
	if(D_TEMP != "v17red")
	{	
		
		
		$script_files = '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script>	
		jQuery("#cont_slide .item:first").addClass("active");
		</script>';
		//$script_files .= include 'slideshow_profile.php';
		
		
		
		return 	$script_files; 
	}
}

function layoutTemplateHeader($page,$BANNER_ARRAY,$HEADER_MENU_BAR_TOP,$HEADER_MENU_BAR_SUB,$HEADER_MENU_BAR_QUICK_LINKS) {

	global $DB; 

	$AlertArray = array();

	$SQL = "select row_num from 

		(

			SELECT count(mailnum) AS row_num FROM messages WHERE mail2id='".$_SESSION['uid']."' AND mailstatus='unread' AND to_box='inbox' AND messages.type != 'wink'

			union ALL

			SELECT count(uid) AS row_num FROM members_network n, members m WHERE m.id = n.uid AND m.active = 'active' AND visible = 'yes' AND n.to_uid='".$_SESSION['uid']."'  AND (n.type=2 OR n.type=4) AND n.approved !='yes'

			union ALL

			SELECT count( from_uid ) AS row_num FROM comments c, members m WHERE c.to_uid='".$_SESSION['uid']."'

			AND c.approved != 'yes' and c.from_uid = m.id

			union ALL

			SELECT count(mailnum) AS row_num FROM messages WHERE mail2id='".$_SESSION['uid']."' AND mailstatus='unread' AND to_box='inbox' AND messages.type = 'wink'

		) as derived_table";

	$Data = $DB->Query($SQL);

	## loop data from query
	$Counter = 1;
 	while( $DataArray = $DB->NextRow($Data) ){

		$AlertArray[$Counter]['total'] = $DataArray['row_num']; 

		$Counter++;

	}		

	?>

	<div <?php if($page != "index"){?> class="navbar navbar-fixed-top navbar-<?=D_HEADER_LAYOUT?>"<?php }?> >
		<div class="page_header" id="PageHeader">
			<div class="row">

             <?php if($page != "index") { ?>
            <div class="logo_height col-xs-8 col-md-4 col-sm-4 col-lg-4">
                <a href="<?=DB_DOMAIN ?>index.php">
                    <div id="ImageLogo">					
                        <p class="<? if( TMP_LOGO_ICON =="images/DEFAULT/LOGOS/none.png"){ print "p3"; }else{ print "p1"; } ?>"><? if(TMP_LOGO_HIDE ==0){ ?><?=TMP_LOGO ?><? } ?></p>					
                        <p class="p2"><? if(TMP_LOGO_HIDE ==0){ ?><?=TMP_LOGO_SLOGAN ?><? } ?></p>
                    </div>
                </a>
            </div>
            
			<?php } ?>
        	
            <div class="right-head col-md-2 col-xs-2 col-sm-2 col-lg-2" style=" <?php if($page == "index"){?> margin:21px 20px 0px 0px; <?php } ?>">
	            <!--4-->
				<?php

                if(isset($_SESSION['lang'])){
                	$lang = $_SESSION['lang'];
                	$$lang = "selected = 'selected'";
                }
                else{
                	$english = "selected = 'selected'";
                }

                
                ?>
                <form class="f_left">
                    <select class="language f_left padding_5" name="lang" id="lang" onchange="location = this.options[this.selectedIndex].value;"> 
                        <option value="/index.php?l=english" <?php if(isset($english)){ echo $english;}?>>English</option>
                        <option value="/index.php?l=bosnian" <?php if(isset($bosnian)){ echo $bosnian;}?>>Bosnian</option>
                        <option value="/index.php?l=turkey" <?php if(isset($turkey)){ echo $turkey;}?>>Turkey</option>
                        <option value="/index.php?l=spanish" <?php if(isset($spanish)){ echo $spanish;}?>>Spanish</option>
                        <option value="/index.php?l=russian" <?php if(isset($russian)){ echo $russian;}?>>Russian</option>
                        <option value="/index.php?l=czech" <?php if(isset($czech)){ echo $czech;}?>>Czech</option>
                        <option value="/index.php?l=japanese" <?php if(isset($japanese)){ echo $japanese;}?>>Japanese</option>
                        <option value="/index.php?l=slovenian" <?php if(isset($slovenian)){ echo $slovenian;}?>>Slovenian</option>
                        <option value="/index.php?l=swedish" <?php if(isset($swedish)){ echo $swedish;}?>>Swedish</option>
                        <option value="/index.php?l=slovak" <?php if(isset($slovak)){ echo $slovak;}?>>Slovak</option>
                        <option value="/index.php?l=thai" <?php if(isset($thai)){ echo $thai;}?>>Thai</option>
                        <option value="/index.php?l=danish" <?php if(isset($danish)){ echo $danish;}?>>Danish</option>
                        <option value="/index.php?l=chinese" <?php if(isset($chinese)){ echo $chinese;}?>>Chinese</option>
                        <option value="/index.php?l=romanian" <?php if(isset($romanian)){ echo $romanian;}?>>Romanian</option>
                        <option value="/index.php?l=german" <?php if(isset($german)){ echo $german;}?>>German</option>
                        <option value="/index.php?l=italian" <?php if(isset($italian)){ echo $italian;}?>>Italian</option>
                        <option value="/index.php?l=vietnamese" <?php if(isset($vietnamese)){ echo $vietnamese;}?>>Vietnamese</option>
                        <option value="/index.php?l=arabic" <?php if(isset($arabic)){ echo $arabic;}?>>Arabic</option>
                        <option value="/index.php?l=portugues" <?php if(isset($portugues)){ echo $portugues;}?>>Portugues</option>
                        <option value="/index.php?l=norwegian" <?php if(isset($norwegian)){ echo $norwegian;}?>>Norwegian</option>
                        <option value="/index.php?l=dutch" <?php if(isset($dutch)){ echo $dutch;}?>>Dutch</option>
                        <option value="/index.php?l=korean" <?php if(isset($korean)){ echo $korean;}?>>Korean</option>
                        <option value="/index.php?l=croatian" <?php if(isset($croatian)){ echo $croatian;}?>>Croatian</option>
                        <option value="/index.php?l=taiwanese" <?php if(isset($taiwanese)){ echo $taiwanese;}?>>Taiwanese</option>
                        <option value="/index.php?l=polish" <?php if(isset($polish)){ echo $polish;}?>>Polish</option>
                        <option value="/index.php?l=french" <?php if(isset($french)){ echo $french;}?>>French</option>
                        <option value="/index.php?l=greek" <?php if(isset($greek)){ echo $greek;}?>>Greek</option>
                    </select>
              		<? if(my_logged_in){ ?>
					 <? }elseif($page == "index"){ ?>
                        <a href="<?=getThePermalink('login')?>" style="text-decoration:none; background-color:white; margin-left:18px; padding: 5px 14px; line-height: 25px;">
                            Login Here
                        </a>
                    <? } ?>
                </form>
                
                <div style="display:none;" class="login-top">
                    <div class="content-width">
                        <div class="login-box">
                            <form method="post" action="<?=DB_DOMAIN ?>index.php" name="LoginForm" onSubmit="return CheckNullsLogin('<?=$GLOBALS['_LANG_ERROR']['_incomplete'] ?>');">
                                <input name="do" type="hidden" value="login" class="hidden">
                                <input name="visible" value="0" type="hidden">
                                <input name="do_page" type="hidden" value="login" class="hidden">
                
                                <ul class="form custom-border">   
                                    <div class="CapBody">   
                                    <? if (defined('FACEBOOK_APP_ID')  && FACEBOOK_APP_ID !="") { ?>             
                                        <li>
                                            <a class="btn-ragister" href="<?=getThePermalink('fblogin')?>"><img src="/inc/templates/<?=D_TEMP ?>/images/facebook-f.jpg" />Login Fast with facebook</a><br />
                                        </li>
                                    <? } ?>
                                        <li>
                                            <div class="line-txt"><span>or sign in below</span></div>
                                        </li>    
                                        <li>
                                            <input placeholder="<?=$GLOBALS['_LANG']['_username'] ?>" tabindex="1" maxlength="15" name="username" id="e_username" type="text" class="input" size="25" <? if(isset($_COOKIE['emeeting']['username'])){ print "value='".$_COOKIE['emeeting']['username']."'"; } ?>>
                                        </li>
                                        <li>
                                            <input placeholder="<?=$GLOBALS['_LANG']['_password'] ?>" tabindex="2" maxlength="25" name="password" id="e_password" type="password" class="input" size="25">
                                        </li>
                                        <? if(D_REGISTER_IMAGE ==1){ } ?>

                                        <li>
                                            <input class="green-btn" maxlength="15" type="submit"  value="<?=$GLOBALS['_LANG']['_login'] ?>" class="MainBtn">
                                        </li>

                                        <li class="forget-txt">
                                            <a href="#" onclick="toggleLayer('ForgottenPassword2'); return false;"><?=$GLOBALS['LANG_COMMON'][1] ?></a>
                                        </li>
                                        <?php /*?>	<? if(VALIDATE_EMAIL==1){ ?>
                                            <li><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/emoticon_smile.png" align="absmiddle"> <a href="#" onclick="toggleLayer('ActAccount'); return false;"><?=$GLOBALS['LANG_LOGIN']['a7'] ?></a></li>
                    						
                                            <? } ?><?php */?>
                                    </div>
                                </ul>
                            </form>	
                            <div style="display:none" id="ForgottenPassword2">	
                                <form method="post" action="<?=DB_DOMAIN ?>index.php" name="ForgotPassword">
                                    <input name="do" type="hidden" value="password" class="hidden">
                                    <input name="do_page" type="hidden" value="login" class="hidden">
                                    <input name="username" type="hidden" value="" class="hidden">
                                    <ul class="form forget-form">   
                                        <div class="CapBody">
                                            <li>Enter your registration email<br /> and we'll send your a password</li>
                                            <li>
                                                <input maxlength="150" name="email" type="text" size="20" class="input">
                                            </li>
                                            <?php /*?><? if(D_REGISTER_IMAGE ==1){ ?><li><label	><?=$GLOBALS['_LANG']['_verification'] ?>:</label> <input maxlength="15" type="text" name="code" id="C4" class="input"><br><img name="Verification Image" src="<?=DB_DOMAIN ?>inc/classes/class_regimg_img.php?regen=y&<? echo time(); ?>"></li><? } ?><?php */?>
                                            <li>
                                                <input class="green-btn" type="submit"  value="<?=$GLOBALS['_LANG']['_submit'] ?>" class="MainBtn">
                                            </li>
                                        </div>
                                    </ul>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--4-->
            </div>	
                
            
            <?php if($page != "index"){
			?>
            <div id="top_banner" class="col-md-6 col-sm-6 col-lg-6 hiddenonsmall"><? foreach($BANNER_ARRAY as $banner){ if($banner['position'] =="top"){ print $banner['display'];}} ?></div>	 
            <?php
            }
            ?>
            </div>
            <div class="nav_button hidden-lg hidden-md">
            	<span style="padding-left:12px;">
				    <span>
                    	<a href="<?= getThePermalink('search/online/1')?>" style="color:#fff;">
							<?=CountOnline() ?> <?=$GLOBALS['_LANG']['_members']." ".$GLOBALS['_LANG']['_online'] ?>
                         </a>
                    </span>
			    </span>	
               <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mynav">
                 <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                 <span class="icon-bar"></span>
            </button>
            </div>
            <div class="" id="MenuBar" style=" <?php if($page == "index"){?> margin:21px 20px 0px 0px; <?php } ?>"><!--3-->
          
            
            <div class="collapse navbar-collapse" id="mynav">
            
                <ul class="tabs nav navbar-nav">
                    <?=$HEADER_MENU_BAR_TOP ?>
                    <div class="hidden-md hidden-lg">
                     <?=$HEADER_MENU_BAR_SUB ?>
                     </div>
                </ul>	
                
                
                
                </div>
                		
            </div>
          
            <div class="sub_menu hidden-xs hidden-sm"> 
   				<ul class="sub_tabs f_left">
   					<?=$HEADER_MENU_BAR_QUICK_LINKS ?>
				    <?=$HEADER_MENU_BAR_SUB ?>	
			    </ul>
			    <?php

			    if($_SESSION['auth'] == 'yes'){

			    ?>
			    <div class="notification-bell">
			    	<div style="padding: 5px 10px 0 0; float: left;">
            	<span style="padding-left:12px;">
				    <span>
                    	<a href="<?= getThePermalink('search/online/1')?>" style="color:#333333;">
							<?=CountOnline() ?> <?=$GLOBALS['_LANG']['_members']." ".$GLOBALS['_LANG']['_online'] ?>
                         </a>
                    </span>
			    </span>	
	               <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mynav">
	                 <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	                 <span class="icon-bar"></span>
	            </button>
	            </div>
			    	<?php if($AlertArray[1]['total'] > 0 || $AlertArray[4]['total'] > 0 || $AlertArray[2]['total'] > 0 || $AlertArray[3]['total'] > 0){   ?>
				    <img src="<?=DB_DOMAIN?>images/alert_notification_bell.png" onclick="navShowHide('notifications');" class="blink-image"/>
				    <?php }else{ ?>
                     <img src="<?=DB_DOMAIN?>images/notification_bell.png" onclick="navShowHide('notifications');"/>
				    <?php } ?>
				</div>
				<?php
                  }
			    ?>
			    <ul class="notification_tabs notification-desktop-responsive pull-right" id="notifications">
				    
			    	<?php
			    	if(D_FREE == 'no'){
			    	?>
				    <li class="upgrade">
				    	<a href="/index.php?dll=subscribe" class="btn btn-primary MainBtn">Upgrade</a>
			    	</li>
			    	<?php
			    	}
			    	?>
			    	<li>
				    	<a href="<?=DB_DOMAIN?>messages/inbox" class="notifications messages"><?php if($AlertArray[1]['total'] > 0){?><span><?=$AlertArray[1]['total']?></span><?php } ?></a>
			    	</li>
			    	
			    	<li>
				    	<a href="<?=getThePermalink('messages/wink')?>" class="notifications winks"><?php if($AlertArray[4]['total'] > 0){?><span><?=$AlertArray[4]['total']?></span><?php } ?></a>
			    	</li>
			    	<li>
				    	<a href="<?=getThePermalink('search/friends/'.$_SESSION['uid'].'/detail')?>" class="notifications friends"><?php if($AlertArray[2]['total'] > 0){?><span><?=$AlertArray[2]['total']?></span><?php } ?></a>
			    	</li>
			    
			    	<li>
				    	<a href="<?=getThePermalink('account/comments')?>" class="notifications comments"><?php if($AlertArray[3]['total'] > 0){?><span><?=$AlertArray[3]['total']?></span><?php } ?></a>
			    	</li>
			    	
			    </ul>

    			<?php
    			/*<span style="float:right;padding:4px;">
				    <span class="onlinenow">
                    	<a href="<?=DB_DOMAIN ?>index.php?dll=search&page=1&online=1">
							<?=CountOnline() ?> <?=$GLOBALS['_LANG']['_members']." ".$GLOBALS['_LANG']['_online'] ?>
                         </a>
                    </span>
			    </span>
			    */
			    ?>		
            </div>
                
        </div>
    </div>
<?php	
}

function funcLayoutUserFooter($FOOTER_MENU_BAR, $FOOTER_MENU_TIMER, $BANNER_ARRAY, $page = ""){
	if(D_USER_FOOTER == 'yes'){
	?>
	    <!-- Invitation Part End -->	
	    <div class="clear"></div>
			
	    <!-- PAGE FOOTER -->
	    <div id="page_footer" class="page-footer-<?=D_HEADER_LAYOUT?> <?php if(isset($page) && $page != "index") { ?> footer_sec <?php } ?>">
	        <div class="content-width">
	            <div class="footer_menu"> 
	                <ul class="footer_tabs">
	                    <?=$FOOTER_MENU_BAR ?>							
	                </ul>
	            </div>	
	        </div>
	    
	        <?=$FOOTER_MENU_TIMER ?>
	            
	        <?php e_footer() ?>
	    
	    </div>
	    <!-- END FOOTER -->
		<div class="footer-banner-add"> <? foreach($BANNER_ARRAY as $banner){ if($banner['position'] =="bottom"){ print $banner['display'];}} ?></div>
	<?php
	}
}
function layoutTemplateFooter($page,$BANNER_ARRAY,$HEADER_MENU_BAR_TOP,$HEADER_MENU_BAR_SUB) {
?>

<?php	
}

function funcDisplaySidebarOnline(){

if(D_SIDEBARONLINE && isset($_SESSION['auth']) && $_SESSION['auth'] =="yes"){ ?>



<style>
.icon {position: absolute;background: url('/inc/templates/<?=D_TEMP?>/images/icons.png') no-repeat;}
#i-title .i-number, #i-title .i-number .decor {background: #cc3300 url('/inc/templates/<?=D_TEMP?>/images/sprite.gif') 0 -35px repeat-x;}
#i-bns .icon{position:absolute;left:0;top:0;width:15px;height:15px;cursor:pointer;_font-size:0;_line-height:0;background-repeat:no-repeat;background-image:url("/inc/templates/<?=D_TEMP?>/images/sprite.gif");}
#i-title .i-number,#i-title .i-number .decor{background:#cc3300 url('/inc/templates/<?=D_TEMP?>/images/sprite.gif') 0 -35px repeat-x;}
#invitations .bar{background:#cc3300 url('/inc/templates/<?=D_TEMP?>/images/sprite.gif') 0 -30px repeat-x;}
#invitations .minimize.bottom .icon{position:absolute;left:0;top:0;width:15px;height:15px;cursor:pointer;_font-size:0;_line-height:0;background-repeat:no-repeat;background-image:url("/inc/templates/<?=D_TEMP?>/images/sprite.gif");background-position:-15px 0;}
#i-title .maximize.bottom .icon{position:absolute;left:0;top:0;width:15px;height:15px;cursor:pointer;_font-size:0;_line-height:0;background-repeat:no-repeat;background-image:url("/inc/templates/<?=D_TEMP?>/images/sprite.gif");background-position: 0px 0px;}
#invitations .i-ctls .accept-invitation {width: 146px;height: 27px;padding: 0;margin: 0;text-indent: -9999px;white-space: nowrap;overflow: hidden;background: url('/inc/templates/<?=D_TEMP?>/images/invitation-buttons.png') 0 0 no-repeat;}
#invitations .anchor {
    position: absolute;
    top: 2px;
    left: -9px;
    margin-top: 0;
    display: block;
    display: none\9;
    width: 10px;
    height: 14px;
    background: transparent url('/inc/templates/<?=D_TEMP?>/images/ballon-anchor.gif') no-repeat scroll 0% 0%;
}
</style>
 
<?php $onlines = getOnline(0,5); ?>

<div id="invitations" class="aidate invitations" style="opacity: 1;display:none;">
	<span class="sh-t"></span>
	<span class="sh-r"></span>
	<span class="sh-b"></span>
	<span class="sh-l"></span>
	<span class="sh-tr"></span>
	<span class="sh-br"></span>
	<span class="sh-bl"></span>
	<span class="sh-tl"></span>
				
	
				
	<ul class="collapsable list closed" id="users_online">
        <h4>Start chatting right NOW!</h4>
        <?php 

        $count_online = count($onlines);
        
        $i = 0;

        if(isset($onlines) && is_array($onlines) && $count_online > 0){
	        foreach($onlines as $online){ 

	            $i++;

	        ?>
	        
	       <li class="chat invitation advandate-com source-lc online-<?=$online['uid']?>" style="height: auto; opacity: 1;">
	            <div class="wrapper">
	                <div class="i-profile clearfix">
	                    <div class="l">
	                        <div class="thumb-container">
	                            
	                            <a href="/user/<?=$online['username']?>">
	                                <img class="accept-invitation" src="<?=$online['image']?>" alt="Yinhan">
	                            </a>
	                        </div>
	                    </div>
	                    <div class="r">
	                        <div class="member-info-data">
	                            <h5>
	                                <a style="_padding-right: .4em;" class="member-name" 
	                                href="/user/<?=$online['username'];?>"><?=GetUsername($online['uid'])?></a>
	                                <?php /*<em class="nowrap member-id">(ID: <span class="value" bind="this.text(data.member['id'])"><?=$online['uid']?></span>)</em>*/?>
	                            </h5>
	                            <p class="age">
	                                <span>
	                                    Age:
	                                    <span><?=$online['age']?></span>
	                                </span>
	                            </p>
	                            <p class="location" bind="this.text(data.member['location'])"><?=$online['location']?>, <?=$online['country']?></p>
	                            <!--<p class="description"><span bind="this.html(data.member.description + ( ({'lc': '&nbsp;invites you to chat ', 'cs': ' <span class=video-text>invites you to chat</span><span class=camshare-text>invites you to CamShare</span>', 'ai': '&nbsp;is online now'})[data.source] || ''))">Never married lady with Black eyes and Brown hair&nbsp;invites you to chat </span>.</p>-->
	                        </div>

	                        <!-- TODO : TOGGLE() ??? -->
	                        <div class="ballon" bind="this.toggleClass('no-serif', data.type == 2).toggle(!!data.text)" style="display: block;">
	                            <span class="anchor"></span>
	                            <span class="shade"></span>
	                            <!--<div class="messages" id="invite-messages" bind="this.html(data.text)"><?=$online['description']?></div>-->
	                            <div class="messages" id="invite-messages" bind="this.html(data.text)"><?=$online['status']?></div>
	                        </div>


	                    </div>
	                </div>
	                            
	                <div class="i-ctls clearfix">
	                    <div class="l">
	                        <div class="countdown"><span class="bar" style="width: <?=$online['profile_complete']?>%;"></span></div>
	                                    
	                        <div class="invitation-actions">
	                            <span class="i-close" onclick="block_remove(<?=$online['uid']?>)">Close</span>
	                            
	                                <?php /*<span class="separator">|</span>
	                                <span class="i-block" onclick="ProfileAddNet(<?=$online['uid']?>,3); block_remove(<?=$online['uid']?>);">Block</span>*/?>
	                            
	                        </div>
	                    </div>
	                                
	                    <div class="r">
	                        <button class="button accept free-chat approve small progress">
	                            <div class="progress-wrapper">
	                                <div class="value">Start Free Chat Now!</div>
	                                <div class="progress-bar" style="width: 59%;"></div>
	                            </div>
	                        </button>

	                        <button class="button accept free-camshare approve small progress" key="free-premium">
	                            <div class="progress-wrapper">
	                                <div class="value">Free CamShare</div>
	                                <div class="progress-bar" style="width: 59%;"></div>
	                            </div>
	                        </button>

	                        <button class="button accept camshare primary small progress" key="premium">
	                            <div class="progress-wrapper">
	                                <div class="value">Start CamShare!</div>
	                                <div class="progress-bar" style="width: 59%;"></div>
	                            </div>
	                        </button>

	                        
	                            <div class="start-chat">
	                                <button class="button accept chat alarm small progress">
	                                    <div class="progress-wrapper">
	                                        <span class="value">Start Chat Now!</span>
	                                        <span class="progress-bar" style="width: 59%;"></span>
	                                    </div>
	                                </button>
	                                <button class="button accept free-chat approve small progress">
	                                    <div class="progress-wrapper">
	                                        <div class="value">Start Free Chat Now!</div>
	                                        <div class="progress-bar" style="width: 59%;"></div>
	                                    </div>
	                                </button>
	                            </div>
	                        

	                        
	                        
	                            <!--<a href="#" onclick="window.open('/inc/exe/IM/window.php?pId=<?=$online['uid']?>'); return false;" class="accept chat livechat-link">
	                                <span class="value">Start Live Chat</span>
	                            </a>-->
	                        

	                        <div class="discount-balloon">
	                            <i></i>
	                            50% OFF
	                        </div>

	                        <a href="javascript:void(0);" onclick="ShowHideVideoSection('block','<?=DB_DOMAIN?>chat/web?to_uid=<?=$online['uid']?>');" return false;" class="accept-invitation">Start Chat Now!</a>
	                        <input name="ctl00$ctl00$ctl53$startBtn2" type="button" id="ctl53_startBtn2" class="accept-invitation camshare" value="Start Chat Now!" key="premium">

	                        <div class="accept-free-camshare"><span data-action="accept-invitation" key="free-premium">Start Free CamShare</span></div>

	                        <input name="ctl00$ctl00$ctl53$ctl04" type="button" class="accept-invitation free-camshare" value="Start Chat Now!" key="free-premium">
	                    </div>
	                </div>

	            </div>
	            <!--[if lte IE 7]>
	                <div class="after"></div>
	            <![endif]-->
	        </li>
	        <?php
	        }
        }
        else{
    	?>
	        <li>
        		<h4 class="not-found">No one is online!</h4>
	        </li>
    	<?php
        }
        ?>
				
		
	   </ul>
				
	<div id="i-footer">
		
			<!--<div class="note non-camshare-message">
				Live Chat is billed at 1 Credit per minute<br>
				Video "on" adds 1 Credit per minute
			</div>
			<div class="note camshare-message">
				Chat is billed at 1 Credit per minute,<br>
				Chat with video — 2 Credits, CamShare — 6 Credits.
			</div>-->
		
					
		<div id="i-title">
			<span class="i-count chats chat-hide">
				<span>
                    <?php
                    /*if(isset($_SESSION['genderid']) && $_SESSION['genderid'] == 63){
                        echo"Ladies";
                    }
                    else if(isset($_SESSION['genderid']) && $_SESSION['genderid'] == 64){
                        echo"Gents";
                    }
                    else{
                        echo"Online";
                    }*/
                    ?>
                    Start chatting right NOW!
                    </span>
				<?php /*<span class="i-number">
					<span class="decor l"></span>
					<span id="chats"><?=($count_online > 3) ? '3' : $count_online ;?></span>
					<span class="decor r"></span>
				</span>*/?>
			</span>
						
			<span class="i-count gifts none">
				<span>Gifts</span>
				<span class="i-number">
					<span class="decor l"></span>
					<span id="gifts"></span>
					<span class="decor r"></span>
				</span>
			</span>
			<span class="value minimize bottom">
				<span class="icon"></span>
				<span class="label">Minimize</span>
			</span>
            <span class="value maximize bottom disabled">
                <span class="icon"></span>
                <span class="label">Maximize</span>
            </span>		
            
		</div>
	</div>
				
	<div id="i-bns">
		<span class="value minimize">
			<span class="icon"></span>
			<span class="label" style="display: none;">Minimize</span>
		</span>
		<span class="value maximize disabled">
			<span class="icon"></span>
			<span class="label">Maximize</span>
		</span>
	<input type="hidden" name="users_count" id="users_count" value="5"/>
    </div>

</div>


<script type="text/javascript">
    
    var jQuery = jQuery.noConflict();
    var name = [];
    var value = [];
    jQuery(document).ready(function(){
    	var sessionValue = sessionStorage.getItem('onlinepopup');
    	//alert(sessionStorage.onlinepopup);
    	if (sessionStorage.onlinepopup == 'dontshow') { 
    	   		
    	   	jQuery("#invitations .collapsable").addClass('closed');
    	   	//alert('hello');   				
		} else  {
			jQuery("#invitations .collapsable").removeClass('closed');
			//alert('hi');   		
		}
    		
        jQuery("#invitations").show();
        //jQuery("#invitations .collapsable").removeClass('closed');
        
        //jQuery("#i-title .online").fadeOut(500).fadeIn(500, blink);
        jQuery("#i-footer #i-title , #i-bns .minimize .label").click(function(e){
			//alert(sessionStorage.onlinepopup);
			if(sessionStorage.onlinepopup != 'dontshow'){
        		sessionStorage.setItem("onlinepopup", "dontshow");
        		//alert('hi'); 
				} else  {
					sessionStorage.removeItem('onlinepopup');
					//alert('romove');
				}
        	


       if(jQuery("#invitations .collapsable").hasClass('closed')){
                jQuery("#invitations .collapsable").removeClass('closed');
                /*jQuery("#i-title .chat-hide").fadeOut(500,function(){
                    jQuery("#i-title .chat-hide").removeClass('chat-show');
                    jQuery("#i-title .chat-hide").removeAttr('style');
                });*/
                jQuery("#i-title .chat-hide").removeClass('chat-show');
            }
            else{
                jQuery("#invitations .collapsable").addClass('closed');
                
                jQuery("#i-title .chat-hide").addClass('chat-show');
            }

            if(jQuery("#i-title .minimize").hasClass('disabled')){
                jQuery("#i-title .minimize").removeClass('disabled');

                jQuery("#i-title .maximize").addClass('disabled');
                jQuery("#i-bns .minimize").removeClass('disabled');
                jQuery("#i-bns .maximize").addClass('disabled');
                jQuery("#i-title .i-number").removeClass('online');
                
                
            }
            else{
                jQuery("#i-title .minimize").addClass('disabled');
                jQuery("#i-title .maximize").removeClass('disabled');
                jQuery("#i-bns .minimize").addClass('disabled');
                jQuery("#i-title .i-number").addClass('online');
                //jQuery("#i-bns .maximize").removeClass('disabled');
                
            }
            //jQuery("#invitations .collapsable").slideToggle('slow');
             
            //jQuery("#i-bns .maximize").toggle('slow');
            
            return false;

        });
        
    });

    function block_remove(uid){

        var count = parseInt(jQuery("#chats").text());
       
        count = count - 1;
        jQuery("#chats").text(count);

        jQuery(".online-" + uid).slideUp(1000,function(){
            jQuery(this).remove();
            jQuery('.not-ad:first').slideDown(1000);
            if(jQuery('.not-ad:first').removeClass('not-ad')){
                
                //jQuery('.not-ad:first').fadeIn(500,function(){

                count = parseInt(jQuery("#users_online li").length);
                
                if(count > 3){
                    count = 3;
                }
                //count = count + 1;
                jQuery("#chats").text(count);
                //jQuery('.not-ad:first').removeClass('not-ad');
            //});
            }
            
        });

        var count = parseInt(jQuery("#users_count").val());
        count = count + 1;
        load_user(count);
        jQuery("#users_count").val(count);

    }

    function load_user(count){
            jQuery.ajax({
                url:"/inc/ajax/ajax_sidebar.php?from=" + count,

                success:function(data){

                    jQuery("#users_online").append(data);

                },
                error:function(e){
                    console.log(e);
                }
            });

        
    }

</script>
 
<?
}
}

function funcLayoutUserHeader($page,$BANNER_ARRAY,$HEADER_MENU_BAR_TOP,$HEADER_MENU_BAR_SUB,$HEADER_MENU_BAR_QUICK_LINKS){

    if(D_USER_HEADER == 'no' && ($page == 'account' || $page == 'register')){
    
    ?>
    <style type="text/css">
    	#MainPageBackground{
    		background: url(<?=DB_DOMAIN?>images/<?=D_USER_REGISTER_BACKGROUND_IMAGE?>);
    		float: left;
    		width: 100%;
    		background-size: cover;
    		background-position: 50% 0%; 
    	}
    	#MainPageBackground .wide_wrapper{
    		top: 20px;
    	}
    </style>
    <?php	
    }
    else{
        layoutTemplateHeader($page,$BANNER_ARRAY,$HEADER_MENU_BAR_TOP,$HEADER_MENU_BAR_SUB,$HEADER_MENU_BAR_QUICK_LINKS);
    }
            
}



/**

* Info: Quick Search Form

* 		

* @version  9.0

* @created  Fri Sep 25 10:48:31 EEST 2008

* @updated  Fri Sep 25 10:48:31 EEST 2008

*/

function DisplayQuickBrowse(){

	global $DB;
	$NumFields = 1;
	$ReturnString ="";
	$FullCounter=1;

	if (isset($_SESSION['site_moderator']) && $_SESSION['site_moderator']=="yes"){
		$extra="field_groups.private !=1 "; 
	} else {
		$extra="field_groups.private !=1 && field_groups.private !=2 ";
	}

	$result1 = $DB->Query("SELECT field_groups.id, field_groups.caption FROM field_groups INNER JOIN field ON ( field.groupid = field_groups.id ) WHERE $extra AND field.quickbrowsepage='yes' GROUP BY field_groups.id ORDER BY field_groups.forder ASC");

    while( $group_find = $DB->NextRow($result1) ) {

    	$result = $DB->Query("SELECT fid,fType,fName,linked_id FROM field WHERE quickbrowsepage='yes'  AND fType !=2 AND groupid='".$group_find['id']."' ORDER BY fOrder ASC");

	    while( $groups = $DB->NextRow($result) ) {


			////////////////////////////
			// STOP NULL CAPTION VALUES
			/////////////////////////////

			if(D_LANG !="english"){

				// check see if there is a caption

				$Caption = $DB->Row("SELECT caption, `description` FROM field_caption WHERE Cid=".$groups['fid']." AND lang='".D_LANG."' limit 1");


				if(empty($Caption)){

					// no caption found, load english caption

					$Caption = $DB->Row("SELECT caption, `description` FROM field_caption WHERE Cid=".$groups['fid']."  limit 1");

				}

			}else{


				$Caption = $DB->Row("SELECT caption, `description` FROM field_caption WHERE Cid=".$groups['fid']." AND lang='".D_LANG."' AND `match`='quick' limit 1");

			}

			////////////////////////////

			/////////////////////////////

			$ReturnString .= '<div class="form-group">
	
			  <label class="col-md-12 control-label" for="textinput">'.$Caption['caption'].'</label>';

			if($groups['fType'] == 1){

				if($groups['fName'] =="age"){

					$ReturnString .= DoQuickAge();

				}else{

					if($groups['fName'] == 'location'){

						$ReturnString .= "<div id='Link".$groups['fid']."' class='col-md-12'>
							<div class='box-location'>";
						$ReturnString .= "<input name='SeV[".$NumFields."]' type='text' maxlength='255' id='quickSearchLocation'>";
						$ReturnString .= "</div></div>";
					}
					else{

						$ReturnString .= "<div id='Link".$groups['fid']."' class='col-md-12'>
							<span class='box-select'>";
						$ReturnString .= "<input name='SeV[".$NumFields."]' type='text' maxlength='255'  style='width:185px'>";
						$ReturnString .= "</span></div>";
					}

				}

			}elseif($groups['fType'] == 2){

				if($groups['fName'] == 'location'){

					$ReturnString .= "<div id='Link".$groups['fid']."' class='col-md-12'>
						<div class='box-location'>";
					$ReturnString .= "<input name='SeV[".$NumFields."]' type='text' id='quickSearchLocation' maxlength='255'>";
					$ReturnString .= "</div></div>";
				}
				else{
						
					$ReturnString .= "<div id='Link".$groups['fid']."' class='col-md-12'>
						<span class='box-select'>";
					$ReturnString .= "<input name='SeV[".$NumFields."]' type='text' maxlength='255'>";
					$ReturnString .= "</span></div>";
				}
					
				## age field

			}elseif($groups['fType'] == 7){

				$ReturnString .= DoQuickAge();

			}elseif($groups['fType'] == 5){

				//multiple check boxes
		  	
				// check if there is a field linked to this one
				$Linked = $DB->Row("SELECT fid FROM field WHERE linked_id=".$groups['fid']." limit 1");						
				$result2 = $DB->Query("SELECT * FROM field_list_value WHERE fvFid = '". $groups['fid'] ."' AND lang='".D_LANG."' Order by fvOrder");

				$ReturnString .= "<div id='Link".$groups['fid']."'>";							
				$totalMultipleChoices = $totalMultipleChoices + $groups['fid'];
				
				$tfO =1;
				$c=0;
				$ro = 1;
				$ReturnString .= "<table width='100%'>";
				$ReturnString .= "<tr>";

				while( $ListValue = $DB->NextRow($result2) )  
				{ 			
					if($ListValue['default'] =="yes"){ $Checked ="checked=\"checked\""; }else{$Checked ="";  }
					$ReturnString .= "<td width='25%'>";
				  	$ReturnString .= "<input type='checkbox' name='Multi".$c."".$groups['fid']."' value='1' ".$Checked." />".$ListValue['fvCaption']."<br />";								

					$ReturnString .= "<input type='hidden' class='hidden' name='FieldValue".$groups['fid']."' value='".$groups['fName']."'>";
					$ReturnString .= "<input type='hidden' class='hidden' name='FieldName".$groups['fid']."' value='".$groups['fName']."'>";
					$ReturnString .= "<input type='hidden' class='hidden' name='FieldType".$groups['fid']."' value='".$groups['fType']."'>";					
					$ReturnString .= "<input type='hidden' class='hidden' name='FieldMulti".$c.$groups['fid']."' value='".$c."'>";					  

				  	$ReturnString .= "</td>";	
				  												
					if($ro >= 4)
					{
						$ReturnString .= "</tr>";
						$ReturnString .= "<tr>";
						$ro = 0;
					}


				    $c++;
					$tfO++;
					$ro++;
				}
				$ReturnString .= "</tr>";
				$ReturnString .= "</table>";
				
				// BACKUP INCASE NOT VALUES FOUND
				if($tfO ==1){
					$result2 = $DB->Query("SELECT fvid, fvCaption FROM field_list_value WHERE fvFid = '". $groups['fid'] ."' AND lang='english' Order by fvOrder");
					while( $ListValue = $DB->NextRow($result2) )  
					{ 			
						$ReturnString .= "<input type='checkbox' name='CeK".$NumFields."[]' value='".$ListValue['fvid']."' />".$ListValue['fvCaption']."<br />";					
						$tfO++;
					}
				}							
				$ReturnString .= "</div>";		  	
				$ReturnString .= "<input type='hidden' name='CeK[".$NumFields."]' value='".$groups['fid']."' class='hidden'>";



			}elseif($groups['fType'] == 3){

				/* This is a list box */

				// check if there is a field linked to this one

				$Linked = $DB->Row("SELECT fid FROM field WHERE linked_id=".$groups['fid']." limit 1");

				if(!empty($Linked)){

					// increment value for field box directly under
					$NumFields++;

					$LinkedCode ="onChange='eMeetingLinkedField(this.value, ".$Linked['fid'].",10000".$NumFields.");'";

					$NumFields--;

				}else{ $LinkedCode =""; }

				$result2 = $DB->Query("SELECT fvid, fvCaption FROM field_list_value WHERE fvFid = '". $groups['fid'] ."' AND lang='".D_LANG."' Order by fvOrder");

	  
    			$ReturnString .= "<div id='Link".$groups['fid']."' class='col-md-12'>
					<span class='box-select'>
					<select name='SeV[".$NumFields."]' ".$LinkedCode.">";							

				$ReturnString .= "<option value='0' selected>".$GLOBALS['_LANG']['_select'] ."</option>";

				$tfO =1;

				while( $ListValue = $DB->NextRow($result2) )  

				{ 			

					if(isset($ListValue['default']) =="yes"){ $Selecteed ="selected"; }else{$Selecteed ="";  }

						$ReturnString .= "<option value='".$ListValue['fvid']."' ".$Selecteed.">".$ListValue['fvCaption']."</option>";					

						$tfO++;

					}

					// BACKUP INCASE NOT VALUES FOUND

					if($tfO ==1){

						$result2 = $DB->Query("SELECT fvid, fvCaption FROM field_list_value WHERE fvFid = '". $groups['fid'] ."' AND lang='english' Order by fvOrder");

						while( $ListValue = $DB->NextRow($result2) )  

						{ 			

							if(isset($ListValue['default']) && $ListValue['default'] =="yes"){ $Selecteed ="selected"; }else{$Selecteed ="";  }

							$ReturnString .= "<option value='".$ListValue['fvid']."' ".$Selecteed.">".$ListValue['fvCaption']."</option>";					

							$tfO++;

						}

					}							

								

					$ReturnString .= "</select></span> </div>";

				}

			
				$ReturnString .= '</div>';
				

				$ReturnString .= "<input type='hidden' name='SeT[".$NumFields."]' value='".$groups['fType']."' class='hidden'>";			

				$ReturnString .= "<input type='hidden' name='SeN[".$NumFields."]' value='".$groups['fName']."' class='hidden'>";

				//if(isset($Caption['description']) && $Caption['description'] != ""){$ReturnString .= '<div class="tip">'.$Caption['description'].'</div>';	}

				$ReturnString .= "</span>";

				$FullCounter++;

				$NumFields++;	

			}

		}

		$ReturnString .= "<input name='TotalNumberOfRows' type='hidden' value='$NumFields' class='hidden'>";

		return $ReturnString;

}

/**
* Info: Return Compare Result Array
* 		
* @version  9.0
* @created  Fri Sep 25 10:48:31 EEST 2008
* @updated  Fri Sep 25 10:48:31 EEST 2008
*/

function MemberProfileCompare($id,$group=0){

	global $DB;

	$compareResult = array();
	$compareField = array();
	$compareFieldValue = array();
	## define variables
	$NumFields = 1;	$divCount =1; $divString=""; $ReturnString=""; $HideBox=1;

	## assign value for gender ID if not assigned
	if(!isset($_SESSION['genderid'])){ $_SESSION['genderid']=0; }

	## TOTAL GROUPS
	$Total = $DB->Row("SELECT count(id) AS total FROM field_groups WHERE ( private = 0 || private = 2 || private = ".strip_tags($_SESSION['genderid']).")");

	## search for all fields for this member
	$result = $DB->Query("SELECT id, caption FROM field_groups WHERE ( private = 0 || private = 2 || private = ".strip_tags($_SESSION['genderid']).") ORDER BY forder ASC");

    while( $groups = $DB->NextRow($result) ){

		
		$compareResult[$groups['id']] = $groups['caption'];
		
		## select group fields

		$SQL = "SELECT field.fid,field.fType, field.fName,field.linked_id FROM field INNER JOIN field_groups ON ( ( field_groups.id = field.groupid  || field_groups.id = field.groupid_1 || field_groups.id = field.groupid_2 )  ) WHERE field.fType = '3' AND ( field.groupid = '".$groups['id']."' OR field.groupid_1 = '".$groups['id']."' OR field.groupid_2 = '".$groups['id']."') GROUP BY field.fid ORDER BY field.fOrder ASC";

	

		$result1 = $DB->Query($SQL);

		$textarea_count = 1;

		while( $field = $DB->NextRow($result1) ){

			## determin field caption based on language

			if(D_LANG !="english"){

				## check see if there is a caption
				$Caption = $DB->Row("SELECT caption, `description` FROM field_caption WHERE Cid=".$field['fid']." AND `match` != 'yes' AND lang= ( '".D_LANG."' ) limit 1");						

				if(empty($Caption)){
					## no caption found, load english caption
					$Caption = $DB->Row("SELECT caption, `description` FROM field_caption WHERE Cid=".$field['fid']." AND `match` != 'yes' limit 1");
				}

			}else{

				## check for english value						
				$Caption = $DB->Row("SELECT caption, `description` FROM field_caption WHERE Cid=".$field['fid']." AND `match` != 'yes' AND lang='".D_LANG."' limit 1");
			}



			## select data value

			$Value = $DB->Row("SELECT ".$field['fName']." FROM members_data WHERE  uid= ('".$id."') limit 1");

			$compareField[$groups['id']][$field['fid']] = $Caption['caption'];
			

			## build output
			$input_div_class = "";
			$input_field_class = "";
					

			## clean the value for output

			if($field['fType'] == 3){

			// check if there is a field linked to this one

				$Linked = $DB->Row("SELECT fid FROM field WHERE linked_id=".$field['fid']." limit 1");

				if(!empty($Linked)){

					$storeLastLinked = $Linked['fid'];

					$LinkedCode ="onchange='eMeetingLinkedField(this.value, ".$Linked['fid'].",0);'";

				}else{ $LinkedCode =""; }


				## find caption

				if(D_LANG !="english"){

					## check see if there is a caption					

					$test = $DB->Row("SELECT * FROM field_list_value WHERE fvFid = '". $field['fid'] ."' AND lang='".D_LANG."' Order by fvOrder");	

					if(empty($test)){

						## no caption found, load english caption

						$result2 = $DB->Query("SELECT * FROM field_list_value WHERE fvFid = '". $field['fid'] ."' AND lang='english' Order by fvOrder");

					}
					else{				

						$result2 = $DB->Query("SELECT * FROM field_list_value WHERE fvFid = '". $field['fid'] ."' AND lang='".D_LANG."' Order by fvOrder");	

					}

				}
				else{

					$result2 = $DB->Query("SELECT * FROM field_list_value WHERE fvFid = '". $field['fid'] ."' AND lang='".D_LANG."' Order by fvOrder");

				}		

				## build output

				if(isset($storeLastLinked) && $storeLastLinked == $field['fid']){

					if(isset($StoreCountry) && is_numeric($StoreCountry)){

						$ReturnString .= "<div id='Link".$field['fid']."' class='".$input_div_class."'> <a href='javascript:void(0);' onchange=\"eMeetingLinkedField(".$StoreCountry.", 54,0);\">".MakeCountry($Value[$field['fName']],$field['fid'])." <input type='hidden' class='hidden' name='FieldValue".$field['fid']."' value='".$Value[$field['fName']]."'></a> </div>";

					 }
					 else{

						$ReturnString .= "<div id='Link".$field['fid']."'>".MakeCountry($Value[$field['fName']],$field['fid'])." </div>";						

					}

				}

				else{

					if($field['fid'] =="25"){ $StoreCountry = $Value[$field['fName']]; } // country box fix

					while( $ListValue = $DB->NextRow($result2) ){		

						if($Value[$field['fName']] == $ListValue['fvid']){

							$compareFieldValue[$groups['id']][$field['fid']] = $ListValue['fvCaption'];

						}
					}	
				}

			## multiple checkbox											
			}

		}
 		$LastFID = $field['fid'];
		$ThisBox=$HideBox;
		$NextBox=$HideBox+1;
		$PrevBox=$HideBox-1;
		$ReturnString .='<li>';

		$divCount++; $HideBox++;

	}
	$result = array('groups' => $compareResult, 'fields' => $compareField, 'values' => $compareFieldValue);
	
	## build total field number output
	return $result;
}

// Network Location 
function GetLocationDetails($ip_address){

	global $DB;
	list( $o1, $o2, $o3, $o4 ) = explode(".",$ip_address);
	$integer_ip = (16777216 * $o1) + (65536 * $o2) + (256 * $o3) + $o4;


	$geo_block = $DB->Row("SELECT geoname_id FROM geo_network_blocks WHERE (start_ip_num <= '$integer_ip' AND end_ip_num >= '$integer_ip') OR (start_ip_num >= '$integer_ip' AND end_ip_num <= '$integer_ip') LIMIT 1");

	$goename_id = $geo_block['geoname_id'];
		
	//$goename_id = 1261481;

	$geo_details = $DB->Row("SELECT geo_network_city_id,country_id,state_id, city_name FROM geo_network_cities WHERE geoname_id = '$goename_id'");

	$country_id = (isset($geo_details['country_id'])) ? $geo_details['country_id'] : 0; 
	$state_id = (isset($geo_details['state_id'])) ? $geo_details['state_id'] : 0;
	$city_id = (isset($geo_details['geo_network_city_id'])) ? $geo_details['geo_network_city_id'] : 0;
	
	//DisplayNetworkCountries($country_id);
	//DisplayNetworkStates($country_id,$state_id);
	//DisplayNetworkCities($state_id,$city_id);
	
	return array('country_id' => $country_id, 'state_id' => $state_id, 'city_id' => $city_id);
}

function DisplayNetworkCountries($country_id=0){

	global $DB;
	
	$result = "";

	$result2 = $DB->query("SELECT geo_network_country_id,country_name FROM geo_network_countries ORDER BY country_name");

	while( $country = $DB->NextRow($result2) ){
		
		$seleted = "";
		if($country['geo_network_country_id'] == $country_id){
			$seleted = "selected='selected'";
		}

		$result .= "<option value='".$country['geo_network_country_id']."' $seleted>".$country['country_name']."</option>";

	}
	
	return $result;
}

function MakeNetworkCountryName($country_id){

	global $DB;
	
	$result = $DB->Row("SELECT geo_network_country_id,country_name FROM geo_network_countries WHERE geo_network_country_id = '$country_id'");

	return (isset($result['country_name'])) ? $result['country_name'] : 'N/A';
}


function MakeNetworkStateName($state_id){

    global $DB;
	
    $result = $DB->Row("SELECT geo_network_state_id,state_name FROM geo_network_states WHERE geo_network_state_id = '$state_id'");

    return (isset($result['state_name'])) ? $result['state_name'] : 'N/A';
}


function MakeNetworkCityName($city_id){

    global $DB;
	
    $result = $DB->Row("SELECT geo_network_city_id,city_name FROM geo_network_cities WHERE geo_network_city_id = '$city_id'");

    return (isset($result['city_name'])) ? $result['city_name'] : 'N/A';

}


function DisplayNetworkStates($country_id, $state_id=0){

    global $DB;
	
    $result = "";

    if($country_id != 0){
	
        $result2 = $DB->query("SELECT geo_network_state_id,state_name FROM geo_network_states WHERE geo_network_country_id='$country_id' AND state_name != '' ORDER BY state_name");
		
	while( $state = $DB->NextRow($result2) ){
			
	    $seleted = "";
	    if($state['geo_network_state_id'] == $state_id){
	        $seleted = "selected='selected'";
	    }

	    $result .= "<option value='".$state['geo_network_state_id']."' $seleted>".$state['state_name']."</option>";
			
	}

    }
	
    return $result;

}

function DisplayNetworkCities($state_id, $city_id=0){

    global $DB;
	
    $result = "";
    if($state_id != 0){
		
        $result2 = $DB->query("SELECT geo_network_city_id,city_name FROM geo_network_cities WHERE state_id = '$state_id' AND city_name != '' ORDER BY city_name");

	while( $city = $DB->NextRow($result2) ){
	    $seleted = "";
	    if($city['geo_network_city_id'] == $city_id){
	        $seleted = "selected='selected'";
	    }
	    $result .= "<option value='".$city['geo_network_city_id']."' $seleted>".$city['city_name']."</option>";
	}

    }

    return $result;

}

defined( 'KEY_ID' ) or die( 'Restricted access' );

require_once ($_SERVER['DOCUMENT_ROOT'].'/twitter/twConfig.php');

function GetTwitterGlobalLoginButton(){
	$twClient = new TwitterOAuth(TWITTER_SIGNIN_KEY, TWITTER_SIGNIN_SECRET);
	
	$redirectURL = getThePermalink('twitter');
	$request_token = $twClient->getRequestToken($redirectURL);
	
	//Received token info from twitter
	$_SESSION['token']		 = $request_token['oauth_token'];
	$_SESSION['token_secret']= $request_token['oauth_token_secret'];
	
	//If authentication returns success
	if($twClient->http_code == '200'){
		//Get twitter oauth url
		$authUrl = $twClient->getAuthorizeURL($request_token['oauth_token']);
		
		//Display twitter login button
		$output = '<a href="'.filter_var($authUrl, FILTER_SANITIZE_URL).'"><img src="'.DB_DOMAIN.'images/twitter-login.jpg"/></a>';
	}

	return $output;
}

function getThePermalink($page , $param=array(), $addDomain='yes'){

	if($addDomain == 'yes'){
		$domain = DB_DOMAIN;
	}
	else{
		$domain = "";
	}
	switch ($page) {
		case 'user':
			return $domain.'user/'.$param['username'];
		break;
		
		case 'login':
			if(!isset($param['msg'])){
				$param['msg']="";
			}
			return $domain.'login/'.$param['msg'];
		break;
		
		case 'profile/viewfile':
			return $domain.'profile/viewfile/'.$param['pId'].'/'.$param['lid'];
		break;

		case 'calendar/view':
			return $domain.'calendar/view/'.$param['eventid'];
		break;

		case 'calendar/view':
			return $domain.'calendar/view/'.$param['day'];
		break;
		case 'affiliate/login':
			if(!isset($param['msg'])){
				$param['msg']="";
			}
			return $domain.'affiliate/login/'.$param['msg'];
		break;

		case 'groups/show':
			return $domain.'groups/show/'.$param['gid'];
		break;
		
		case 'search/friends':
			return $domain.'search/friends/'.$param['friendid'].'/'.$param['displaytype'];
		break;

		case 'profile/manage':
			return $domain.'profile/manage/'.$param['item_id'].'/'.$param['item2_id'];
		break;
		
		default:
			return $domain.$page;
		break;
	}
}

function getTheMobilePermalink($page , $param=array(), $addDomain='yes'){

	if($addDomain == 'yes'){
		$domain = DB_DOMAIN;
	}
	else{
		$domain = "";
	}
	switch ($page) {
		case 'user':
			return $domain.'mobile/user/'.$param['username'];
		break;
		
		case 'login':
			return $domain.'mobile/login/'.$param['msg'];
		break;
		
		case 'profile/viewfile':
			return $domain.'mobile/profile/viewfile/'.$param['pId'].'/'.$param['lid'];
		break;

		case 'calendar/view':
			return $domain.'mobile/calendar/view/'.$param['eventid'];
		break;

		case 'calendar/view':
			return $domain.'mobile/calendar/view/'.$param['day'];
		break;
		case 'affiliate/login':
			return $domain.'mobile/affiliate/login/'.$param['msg'];
		break;

		case 'groups/show':
			return $domain.'mobile/groups/show/'.$param['gid'];
		break;
		
		case 'search/friends':
			return $domain.'mobile/search/friends/'.$param['friendid'].'/'.$param['displaytype'];
		break;

		case 'profile/manage':
			return $domain.'mobile/profile/manage/'.$param['item_id'].'/'.$param['item2_id'];
		break;
		
		default:
			return $domain.'mobile/'.$page;
		break;
	}
}

function getHeaderBreadCrumb($page, $sub_page, $LANG_HEADINGS, $LANG_BREADCRUMB){

	if(D_BREADCRUMBS == 'yes' && $page != "overview"  && $page != "index"){

    $return = '<div id="header-section-13" class="header-section-'.D_HEADER_LAYOUT.'">
            <div class="header-title">';
            
    switch ($page) {
        case 'search':

            if(isset($_REQUEST['friendid']) && isset($_REQUEST['friend_type'])){
            	$return .= '<h2 class="template_color">'.$LANG_HEADINGS[$page.'_'.$_REQUEST['friend_type']].'</h2>';
            }
            elseif(isset($_REQUEST['friendid']) && isset($_REQUEST['displaytype'])){
				$return .= '<h2 class="template_color">'.$LANG_HEADINGS[$page.'_'.$_REQUEST['displaytype']].'</h2>';
            }
            else if(isset($sub_page) && $sub_page!=""){
               	$return .= '<h2 class="template_color">'.$LANG_HEADINGS[$page.'_'.$sub_page].'</h2>';
            }
            else{
      			$return .= '<h2 class="template_color">'.$LANG_HEADINGS[$page].'</h2>';
            }
            break;
                    
            default:
                if(isset($sub_page) && $sub_page!=""){
                	 
                	$return .= '<h2 class="template_color">'.$LANG_HEADINGS[$page.'_'.$sub_page].'</h2>';
                }
                else if(isset($LANG_HEADINGS[$page])){
                	$return .= '<h2 class="template_color">'.$LANG_HEADINGS[$page].'</h2>';
                }
                else{
                	$return .= '<h2 class="template_color">'.$page.'</h2>';
                }
        break;
    }
    
    $return .= '</div>
        <div id="breadcrumbing">

            <ul class="breadcrumb-flow">
                
                <li><a href="'.DB_DOMAIN.'">'.$LANG_BREADCRUMB['home'].'</a> <span class="breadcrumb-space template_color"></span></li>';


                switch ($page) {
                    case 'search':
                        
                        if(isset($_REQUEST['friendid']) && isset($_REQUEST['friend_type'])){
                        
                        	$return .= '<li><a href="'.DB_DOMAIN.''.$LANG_BREADCRUMB[$page].'">'.$LANG_BREADCRUMB[$page].'</a><span class="breadcrumb-space template_color"></span></li>
                        	<li>'.$LANG_BREADCRUMB[$page."_".$_REQUEST['friend_type']].'</li>';
                        }
                        elseif (isset($_REQUEST['friendid']) && isset($_REQUEST['displaytype'])){
                        	$return .= '<li><a href="'.DB_DOMAIN.''.$LANG_BREADCRUMB[$page].'">'.$LANG_BREADCRUMB[$page].'</a><span class="breadcrumb-space template_color"></span></li>
                        	<li>'.$LANG_BREADCRUMB[$page.'_'.$_REQUEST['displaytype']].'</li>';
                        }
                        else if(isset($sub_page) && $sub_page!=""){
	                        $return .= '<li><a href="'.DB_DOMAIN.''.$LANG_BREADCRUMB[$page].'">'.$LANG_BREADCRUMB[$page].'</a><span class="breadcrumb-space template_color"></span></li>
                        	<li>'.$LANG_BREADCRUMB[$page."_".$sub_page].'</li>';
                        }
                        else{
	                        $return .= '<li>'.$LANG_BREADCRUMB[$page].'</li>';
                        }
                    break;
                    default:
                        if(isset($sub_page) && $sub_page!=""){
                        
                        	$return .= '<li><a href="'.DB_DOMAIN.''.$LANG_BREADCRUMB[$page].'">'.$LANG_BREADCRUMB[$page].'</a><span class="breadcrumb-space template_color"></span></li>
                        	<li>'.$LANG_BREADCRUMB[$page."_".$sub_page].'</li>';
                        }
                        else if(isset($LANG_BREADCRUMB[$page])){
                        	$return .= '<li>'.$LANG_BREADCRUMB[$page].'</li>';
                        }
                        else{
                        	$return .= '<li>'.$page.'</li>';
                        }
                    break;
                }
                
            $return .= '</ul>';
        $return .= '</div>';
    $return .= '</div>';

    return $return;

	}
}

function notifyAdvandate(){
	@mail('activation.advandate.com',"Admin Login (".DB_DOMAIN.")","Recently, the admin of the site ".DB_DOMAIN." whose email id is ".ADMIN_EMAIL.", is successfully logged into Admin section.");
}



?>