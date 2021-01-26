<?php



function WLD_Header_LoadOn($page, $subpage){



	$TableData="";

	

	$DefaultValue=0;

	if($subpage =="approve_sites"){ $TableData="approve_sites"; }

	else if($subpage =="customers"){ $TableData="customers"; }

	else if($subpage =="members"){ $TableData="members"; }

	else if($subpage =="approve_edits" && isset($_REQUEST['sp']) && $_REQUEST['sp'] == 'text'){ $TableData="approve_edit_text"; }

	else if($subpage =="approve_edits" && isset($_REQUEST['sp']) && $_REQUEST['sp'] == 'metatags'){ $TableData="approve_edit_metatags"; }

	else if($subpage =="approve_edits" && isset($_REQUEST['sp']) && $_REQUEST['sp'] == 'banners'){ $TableData="approve_edit_banners"; }

	else if($subpage =="approve_edits"){ $TableData="approve_edit_pages"; }

	else if($subpage =="approve_media"){ $TableData="approve_media"; }

	else if($subpage =="management"){



		if(isset($_REQUEST['sp']) && $_REQUEST['sp']){

			$TableData="manage_field_groups";

		}



	}





	$market_id = (isset($_GET['market_id'])) ? $_GET['market_id'] : 0;



	if($TableData == 'manage_field_groups'){

		 print "WLDLoadMarketwiseTable('".$TableData."','".$DefaultValue."','".$market_id."');";

	}

	else if($TableData !="" && $TableData != "approve_media" && $TableData != "members" && $TableData != "approve_edit_banners" && $TableData != "approve_edit_pages"){ print "WLDLoadTable('".$TableData."','".$DefaultValue."');"; }else{ print "initLightbox();";}



}



function WLDMakeMarketTable($Data){



	global $DB;



	$market = getMarket($_GET['market_id']);



	if($GLOBALS['SEARCH_DATA']){



	// FORMAT DATA

	$SQL     	  	= (isset($Data['sql']) && $Data['sql'] !="") ? $Data['sql']	: "SELECT %data FROM %tables %where %groupby ORDER BY %order %limit"; // MAIN SQL STRING

	$SQL_TOTAL    	= (isset($Data['sql']) && $Data['sql'] !="") ? $Data['sql']	: "SELECT %data FROM %tables %where %groupby ORDER BY %order %limit"; // USED ONLY TO GET TOTAL RESULTS

	$PAGE_CURRENT 	= (isset($Data['Cpage']) && is_numeric($Data['Cpage']) && $Data['Cpage'] !="") ? $Data['Cpage']	: 0; // GET THE CURRENT PAGE

	$PAGE_START 	= (isset($Data['Spage']) && is_numeric($Data['Spage']) && $Data['Spage'] !="") ? $Data['Spage']	: 0; // GET THE CURRENT PAGE

	$PAGE_STOP 		= (isset($Data['Tpage']) && is_numeric($Data['Tpage']) && $Data['Tpage'] !="") ? $Data['Tpage']	: $GLOBALS['SEARCH_DATA']['tb_rowsPerPage']; // GET THE CURRENT PAGE

	$PAGE_SORTBY	= (isset($Data['sort']) && $Data['sort'] !="") ? $Data['sort']		: $GLOBALS['SEARCH_DATA']['tb_OrderBy']; // GET THE CURRENT PAGE

	$PAGE_SORTWAY	= (isset($Data['Wsort']) && $Data['Wsort'] !="") ? $Data['Wsort']	: $GLOBALS['SEARCH_DATA']['tb_OrderWay']; // GET THE CURRENT PAGE

	

	$PAGE_GROUPBY	= (isset($GLOBALS['SEARCH_DATA']['tb_Groupby']) && $GLOBALS['SEARCH_DATA']['tb_Groupby'] !="") ? $GLOBALS['SEARCH_DATA']['tb_Groupby']	: ""; // GET THE CURRENT PAGE

	$SEARCH_VALUE	= (isset($Data['search']) && $Data['search'] !="") ? $Data['search']	: ""; // GET THE CURRENT PAGE

	$SEARCH_FIELD 	= (isset($Data['sort']) && $Data['sort'] !="") ? $Data['sort']	: $GLOBALS['SEARCH_DATA']['tb_defaultField']; // GET THE CURRENT PAGE

	//

	

	if(strlen($SEARCH_VALUE) > 2){

	

		if($GLOBALS['SEARCH_DATA']['tb_OrderBy'] == $SEARCH_FIELD){		 

	 	

	 	$SEARCH_STRING	= WLDMakeAllSearchData($SEARCH_VALUE);

	 

		}else{

		

		$SEARCH_STRING	= " WHERE ".$SEARCH_FIELD." LIKE '%".$SEARCH_VALUE."%'";



		}	

		

		$SEARCH_STRING	.= str_replace("WHERE 1", "", $GLOBALS['SEARCH_DATA']['tb_where']);

	

	}else{

	$SEARCH_STRING	= $GLOBALS['SEARCH_DATA']['tb_where'];

	}

	 

	

	$Page_Start = ($PAGE_CURRENT*$PAGE_STOP)-$PAGE_STOP;

	if($Page_Start < 0){ $Page_Start=0; }	 

 

	$SQL_TOTAL = str_replace("%data","count(*) AS total ",$SQL_TOTAL);	

 

	$SQL_TOTAL = str_replace("%order",$PAGE_SORTBY,$SQL_TOTAL);

	$SQL_TOTAL = str_replace("%limit","",$SQL_TOTAL);

	$SQL_TOTAL = str_replace("%where",$SEARCH_STRING,$SQL_TOTAL);

	$SQL_TOTAL = str_replace("%tables",$GLOBALS['SEARCH_DATA']['tb_tables'],$SQL_TOTAL);

	$SQL_TOTAL = str_replace("%groupby",$PAGE_GROUPBY,$SQL_TOTAL);



	$SQL = str_replace("%data",implode(",", $GLOBALS['SEARCH_DATA']['tb_data'])."",$SQL);	

	$SQL = str_replace("%order",$PAGE_SORTBY." ".$PAGE_SORTWAY,$SQL);

 	$SQL = str_replace("%limit","LIMIT ".$Page_Start.",".$PAGE_STOP,$SQL); 

	$SQL = str_replace("%where",$SEARCH_STRING,$SQL);

 	$SQL = str_replace("%tables",$GLOBALS['SEARCH_DATA']['tb_tables'],$SQL);

	$SQL = str_replace("%groupby",$PAGE_GROUPBY,$SQL);



	//$DB->Query("SET sql_big_selects=1"); // UNCHECK THIS IF YOU HAVE PROBLMS WITH BIG QUERY



 	$SQL_TOTAL = str_replace("package.name LIKE", "package.pid LIKE", $SQL_TOTAL);

 	$SQL = str_replace("package.name LIKE", "package.pid LIKE", $SQL);





 	if((isset($_GET['system']) && $_GET['system'] == 'customers') || (isset($Data['system']) && $Data['system'] == 'approve_sites')){



	$total = $DB->Row("SELECT COUNT(*) AS total FROM ($SQL_TOTAL) temp");

	$result = $DB->Query($SQL);

 	//echo $SQL_TOTAL;	

	//$total_query = $dbh->query("SELECT COUNT(*) AS total FROM ($SQL_TOTAL) temp");



 	//$total = $total_query->fetch(PDO::FETCH_ASSOC);

 	}

 	else{

	

	$dbh = new PDO('mysql:host='.$market['market_database_path'].';dbname='.$market['market_database_name'].';charset=utf8mb4', $market['market_database_username'], $market['market_database_password']);



	$total_query = $dbh->query($SQL_TOTAL);



 	$total = $total_query->fetch(PDO::FETCH_ASSOC);

 	

 	$result = $dbh->query($SQL);



 	}

 	

 	$TOTAL_DATA =$total['total'];

	

	//print $SQL_TOTAL;

	//print $SQL;

	

	

	print "<div class='bar_save'><p><b>Results Found: ".number_format($total['total'])."</b>";

	//print "- [ <a href=\"#\" onclick=\"idShowHide('rightcolumn');ChangeDiv1();\" style='text-decoration:underline;'> Expand Window</a> - <a href=\"#\" onclick=\"idShowHide('rightcolumn');ChangeDiv2();\" style='text-decoration:underline;'>Extract Window</a> ]"; print "</p></div>";

	print '<form name="profile" onSubmit="return false;">



	<input type="hidden" name="HHDefaultValue" id="HHDefaultValue" value="'.$GLOBALS['SEARCH_DATA']['tb_defaultValue'].'">

	<input type="hidden" name="HHSystem" id="HHSystem" value="'.$GLOBALS['SEARCH_DATA']['tb_system'].'">

	<input type="hidden" name="HHOrder" id="HHOrder" value="'.$PAGE_SORTBY.'">

	<input type="hidden" name="HHSearch" id="HHSearch" value="'.$SEARCH_VALUE.'"><input type="hidden" name="HHSearchF" id="HHSearchF" value="'.$SEARCH_FIELD.'">

	<input type="hidden" name="HHOrderWay" id="HHOrderWay" value="'.$PAGE_SORTWAY.'"><input type="hidden" name="HHStart" id="HHStart" value="'.$PAGE_CURRENT.'">

	<input type="hidden" name="HHDeleteValue" id="HHDeleteValue" value="'.$GLOBALS['SEARCH_DATA']['tb_deletevalue'].'"><input type="hidden" name="HHRows" id="HHRows" value="'.$PAGE_STOP.'">

	';



	



	print '<table class="eMeetingTableBar"><tr><td>';



	print "<input type='text' onBlur='if(this.value == \"\"){this.value = \"Enter Keyword...\";}' onChange='eMeetingTableSwitchWld(this.value,1); return false;' class='input' id='SearchKey' onClick='this.value = \"\";' value='Enter Keyword...'>";



	print "<select onChange='eMeetingChangeWay(); eMeetingTableSwitchWld(this.value,2);' class='input' style='width:150px;'><option value='1'>Order By</option>"; $cap=0; foreach($GLOBALS['SEARCH_DATA']['tb_data'] as $value){ print "<option value='".eMeetingRemoveASTables($value)."'>".$GLOBALS['SEARCH_DATA']['tb_captions'][$cap]."</option>"; $cap++; } print "</select>";	



	print "<select onChange='eMeetingTableSwitchWld(this.value,4);' class='input'><option value='1'>Rows Per Page</option><option value='10'>10</option><option value='50'>50</option><option value='100'>100</option></select>";



	print "</td><td><div id='TableAlert'></div></td></tr></table>";



	if($TOTAL_DATA == 0){ print "<div style='padding:20px;text-align:center;'><h1>No Results Found</h1><p><img src='inc/images/icons/files.gif' align='absmiddle'> <a href='".$_SERVER['HTTP_REFERER']."'>Restart Search</a></p></div>"; }else{



	// LOAD TABLE HEADERS

	print '<div id="eMeetingTableWrapper"><table id="eMeetingTable">'; 

	print '<thead><tr>';

	print '<th class="sortfirstdesc"></th>';

	$th=0; foreach($GLOBALS['SEARCH_DATA']['tb_data'] as $value){ if(substr($value,-2) =="id" && $GLOBALS['SEARCH_DATA']['tb_hideID'] ==true) { $th++;}else{

	print '<th id="'.$GLOBALS['SEARCH_DATA']['tb_data'][$th].'"><a href="#" onClick="eMeetingChangeWay(); eMeetingTableSwitchWld(\''.eMeetingRemoveASTables($GLOBALS['SEARCH_DATA']['tb_data'][$th]).'\',2); return false;">'.$GLOBALS['SEARCH_DATA']['tb_captions'][$th].'</a>'.eMeetingSpecialHeader($GLOBALS['SEARCH_DATA']['tb_data'][$th]).'</th>'; 

	$th++; }} 



	if($GLOBALS['SEARCH_DATA']['tb_edit']){ print '<td></td>';}

				

	print '</tr></thead>';

	// LOAD TABLE BODY

	$Counter=1; 



	if((isset($_GET['system']) && $_GET['system'] == 'customers') || (isset($Data['system']) && $Data['system'] == 'approve_sites')){

	//foreach ($result as $Data) {

	

	while( $Data = $DB->NextRow($result) ){

	global $DB;

	

	if($Counter % 2){

		$BGC="roweven";

		$BG_C="transparent";

	}

	else{

		$BGC="rowodd";

	}

	print '<tr align="center" id="tr_'.$Counter.'" class="'.$BGC.'"  onmouseover="this.style.backgroundColor=\'#DAEFFF\';" onmouseout="this.style.backgroundColor=\'#ffffff\';"><td style="width:30px;"><input name="d'.$Counter.'" type="checkbox" value="on"><input type=hidden value="'.$Data[eMeetingTableStringKeys($GLOBALS['SEARCH_DATA']['tb_deletevalue'], $GLOBALS['SEARCH_DATA']['tb_data_name'])].'" name="id'.$Counter.'" class="hidden"></td>';

	 

	$i=0; foreach($GLOBALS['SEARCH_DATA']['tb_data'] as $value){ 

 

		if(substr($value,-2) =="id" && $GLOBALS['SEARCH_DATA']['tb_hideID'] ==true) {



		}

		else{

		

			$ThisValue = $Data[eMeetingTableStringKeys($GLOBALS['SEARCH_DATA']['tb_data'][$i], $GLOBALS['SEARCH_DATA']['tb_data_name'])]; 

			$ThisValue = eMeetingWLDTableValue($ThisValue,$Data[eMeetingTableStringKeys($GLOBALS['SEARCH_DATA']['tb_deletevalue'], $GLOBALS['SEARCH_DATA']['tb_data_name'])],$GLOBALS['SEARCH_DATA']['tb_data'][$i],$i.$Counter,$Data,$market);

		print '<td scope="col" >'.$ThisValue.'</td> ';}



	$i++; } 



	// EDIT BOX

	if($GLOBALS['SEARCH_DATA']['tb_edit']){

		print "<td align='center'><a href='".$GLOBALS['SEARCH_DATA']['tb_edit_path'].$Data[eMeetingTableStringKeys($GLOBALS['SEARCH_DATA']['tb_deletevalue'], $GLOBALS['SEARCH_DATA']['tb_data_name'])]."'>".icon_edit."</a></td>";

	}

	

	print '</tr>';	

	

	 $i=0;$Counter++;}

	 }

	 else{





	foreach ($result as $Data) {

	

	//while( $Data = $DB->NextRow($result) )

	global $DB;

	

	if($Counter % 2){

		$BGC="roweven";

		$BG_C="transparent";

	}

	else{

		$BGC="rowodd";

	}

	print '<tr align="center" id="tr_'.$Counter.'" class="'.$BGC.'"  onmouseover="this.style.backgroundColor=\'#DAEFFF\';" onmouseout="this.style.backgroundColor=\'#ffffff\';"><td style="width:30px;"><input name="d'.$Counter.'" type="checkbox" value="on"><input type=hidden value="'.$Data[eMeetingTableStringKeys($GLOBALS['SEARCH_DATA']['tb_deletevalue'], $GLOBALS['SEARCH_DATA']['tb_data_name'])].'" name="id'.$Counter.'" class="hidden"></td>';

	 

	$i=0; foreach($GLOBALS['SEARCH_DATA']['tb_data'] as $value){ 

 

		if(substr($value,-2) =="id" && $GLOBALS['SEARCH_DATA']['tb_hideID'] ==true) {



		}

		else{

		

			$ThisValue = $Data[eMeetingTableStringKeys($GLOBALS['SEARCH_DATA']['tb_data'][$i], $GLOBALS['SEARCH_DATA']['tb_data_name'])]; 

			$ThisValue = eMeetingWLDTableValue($ThisValue,$Data[eMeetingTableStringKeys($GLOBALS['SEARCH_DATA']['tb_deletevalue'], $GLOBALS['SEARCH_DATA']['tb_data_name'])],$GLOBALS['SEARCH_DATA']['tb_data'][$i],$i.$Counter,$Data,$market);

		print '<td scope="col" >'.$ThisValue.'</td> ';}



	$i++; } 



	// EDIT BOX

	if($GLOBALS['SEARCH_DATA']['tb_edit']){

		print "<td align='center'><a href='".$GLOBALS['SEARCH_DATA']['tb_edit_path'].$Data[eMeetingTableStringKeys($GLOBALS['SEARCH_DATA']['tb_deletevalue'], $GLOBALS['SEARCH_DATA']['tb_data_name'])]."'>".icon_edit."</a></td>";

	}

	

	print '</tr>';	

	

	 $i=0;$Counter++;}

	 

	 } 

	

	 print '</tbody></table></div>';



	}





	// BUILD PAGE BUTTON



	print '<table class="eMeetingTableBar"><tr><td>';



	print WLDMakePageNumbers($PAGE_STOP, $TOTAL_DATA, $PAGE_CURRENT);

if(isset($Counter)) $Counter--;

	print '</td><td>



		<table width="350" border="0" style="background:#FFFFFF; padding:5px;">

		  <tr>

			<td>&nbsp;Showing:</td>

			<td><input name="textfield2" type="text" size="3" maxlength="5" style="width:35px;" value="'.$PAGE_STOP.'" onChange="eMeetingTableSwitchWld(this.value,4);"></td>

			<td> per page </td>

			<td style="font-size:10px;font-weight:bold;"> ('.number_format (isset($Counter)).' visible /'.number_format($total['total']).' total )</td>

		  </tr>

		</table>



	</td>



    <td>



		<table width="92" border="0" style="padding:5px;">

		  <tr>

			 &nbsp;

		</tr>

		</table>



	</td>



  </tr></table>';



	if (isset($Counter)!=''){$Counter_1=$Counter;}else{$Counter_1=isset($Counter);}



	print '<br><div class="bar_save"><input type="button" value="Select All" class="NormBtn" onClick="ca('.$Counter_1.')"/>

	<input type="button" value="Deselect All" class="NormBtn"  onClick="ua('.$Counter_1.')"/>';



	if(isset($_REQUEST['system']) && $_REQUEST['system'] == 'members_report'){

		print '<input type="button" value="Accept" class="MainBtn report-btn" onClick="eMeetingTableReport('.$Counter_1.');" />';	

	}

	print '<input type="button" value="Delete" class="MainBtn" onClick="eMeetingTableSubmitWld('.$Counter_1.');" />';





	if(isset($_REQUEST['system']) && $_REQUEST['system'] == 'members'){

		print '<input type="button" value="Block" class="MainBtn block-btn" onClick="eMeetingTableBlockWld('.$Counter_1.');" />';	

	}

	

	print '</div>';



	print '</form>';





	}else{

		print "Error! Data not loaded ".$_GET['system'];

	}

	

	

}

function WLDMakeTable($Data){



	global $DB;



	//$market = getMarket($_GET['market_id']);



	if($GLOBALS['SEARCH_DATA']){



	// FORMAT DATA

	$SQL     	  	= (isset($Data['sql']) && $Data['sql'] !="") ? $Data['sql']	: "SELECT %data FROM %tables %where %groupby ORDER BY %order %limit"; // MAIN SQL STRING

	$SQL_TOTAL    	= (isset($Data['sql']) && $Data['sql'] !="") ? $Data['sql']	: "SELECT %data FROM %tables %where %groupby ORDER BY %order %limit"; // USED ONLY TO GET TOTAL RESULTS

	$PAGE_CURRENT 	= (isset($Data['Cpage']) && is_numeric($Data['Cpage']) && $Data['Cpage'] !="") ? $Data['Cpage']	: 0; // GET THE CURRENT PAGE

	$PAGE_START 	= (isset($Data['Spage']) && is_numeric($Data['Spage']) && $Data['Spage'] !="") ? $Data['Spage']	: 0; // GET THE CURRENT PAGE

	$PAGE_STOP 		= (isset($Data['Tpage']) && is_numeric($Data['Tpage']) && $Data['Tpage'] !="") ? $Data['Tpage']	: $GLOBALS['SEARCH_DATA']['tb_rowsPerPage']; // GET THE CURRENT PAGE

	$PAGE_SORTBY	= (isset($Data['sort']) && $Data['sort'] !="") ? $Data['sort']		: $GLOBALS['SEARCH_DATA']['tb_OrderBy']; // GET THE CURRENT PAGE

	$PAGE_SORTWAY	= (isset($Data['Wsort']) && $Data['Wsort'] !="") ? $Data['Wsort']	: $GLOBALS['SEARCH_DATA']['tb_OrderWay']; // GET THE CURRENT PAGE

	

	$PAGE_GROUPBY	= (isset($GLOBALS['SEARCH_DATA']['tb_Groupby']) && $GLOBALS['SEARCH_DATA']['tb_Groupby'] !="") ? $GLOBALS['SEARCH_DATA']['tb_Groupby']	: ""; // GET THE CURRENT PAGE

	

	$SEARCH_VALUE	= (isset($Data['search']) && $Data['search'] !="") ? $Data['search']	: ""; // GET THE CURRENT PAGE

	$SEARCH_FIELD 	= (isset($Data['sort']) && $Data['sort'] !="") ? $Data['sort']	: $GLOBALS['SEARCH_DATA']['tb_defaultField']; // GET THE CURRENT PAGE

	//

	 



	if(strlen($SEARCH_VALUE) > 2){

	

		if($GLOBALS['SEARCH_DATA']['tb_OrderBy'] == $SEARCH_FIELD){		 

	 	

	 	$SEARCH_STRING	= WLDMakeAllSearchData($SEARCH_VALUE);

	 

		}else{

		

		echo $SEARCH_STRING	= " WHERE ".$SEARCH_FIELD." LIKE '%".$SEARCH_VALUE."%'";

		

		}	

	

	}else{

		$SEARCH_STRING	= $GLOBALS['SEARCH_DATA']['tb_where'];

	}

	 

	 



	$Page_Start = ($PAGE_CURRENT*$PAGE_STOP)-$PAGE_STOP;

	if($Page_Start < 0){ $Page_Start=0; }	 

 

	$SQL_TOTAL = str_replace("%data","count(*) AS total ",$SQL_TOTAL);	

 

	$SQL_TOTAL = str_replace("%order",$PAGE_SORTBY,$SQL_TOTAL);

	$SQL_TOTAL = str_replace("%limit","",$SQL_TOTAL);

	$SQL_TOTAL = str_replace("%where",$SEARCH_STRING,$SQL_TOTAL);

	$SQL_TOTAL = str_replace("%tables",$GLOBALS['SEARCH_DATA']['tb_tables'],$SQL_TOTAL);

	//$SQL_TOTAL = str_replace("%groupby",$PAGE_GROUPBY,$SQL_TOTAL);

	$SQL_TOTAL = str_replace("%groupby","",$SQL_TOTAL);



	$SQL = str_replace("%data",implode(",", $GLOBALS['SEARCH_DATA']['tb_data'])."",$SQL);	

	$SQL = str_replace("%order",$PAGE_SORTBY." ".$PAGE_SORTWAY,$SQL);

 	$SQL = str_replace("%limit","LIMIT ".$Page_Start.",".$PAGE_STOP,$SQL); 

	$SQL = str_replace("%where",$SEARCH_STRING,$SQL);

 	$SQL = str_replace("%tables",$GLOBALS['SEARCH_DATA']['tb_tables'],$SQL);

	$SQL = str_replace("%groupby",$PAGE_GROUPBY,$SQL);



	//$DB->Query("SET sql_big_selects=1"); // UNCHECK THIS IF YOU HAVE PROBLMS WITH BIG QUERY



 	$SQL_TOTAL = str_replace("package.name LIKE", "package.pid LIKE", $SQL_TOTAL);

 	$SQL = str_replace("package.name LIKE", "package.pid LIKE", $SQL);





 	if(isset($_GET['system']) && $_GET['system'] == 'customers'){



	$total = $DB->Row("SELECT COUNT(*) AS total FROM ($SQL_TOTAL) temp");



 	}

 	else{



	$total = $DB->Row($SQL_TOTAL);



 	}

	$result = $DB->Query($SQL);



	$TOTAL_DATA =$total['total'];



	//print $SQL_TOTAL;

	//print $SQL;

	

	

	print "<div class='bar_save'><p><b>Results Found: ".number_format($total['total'])."</b>";

	//print "- [ <a href=\"#\" onclick=\"idShowHide('rightcolumn');ChangeDiv1();\" style='text-decoration:underline;'> Expand Window</a> - <a href=\"#\" onclick=\"idShowHide('rightcolumn');ChangeDiv2();\" style='text-decoration:underline;'>Extract Window</a> ]"; print "</p></div>";

	print '<form name="profile" onSubmit="return false;">



	<input type="hidden" name="HHDefaultValue" id="HHDefaultValue" value="'.$GLOBALS['SEARCH_DATA']['tb_defaultValue'].'">

	<input type="hidden" name="HHSystem" id="HHSystem" value="'.$GLOBALS['SEARCH_DATA']['tb_system'].'">

	<input type="hidden" name="HHOrder" id="HHOrder" value="'.$PAGE_SORTBY.'">

	<input type="hidden" name="HHSearch" id="HHSearch" value="'.$SEARCH_VALUE.'"><input type="hidden" name="HHSearchF" id="HHSearchF" value="'.$SEARCH_FIELD.'">

	<input type="hidden" name="HHOrderWay" id="HHOrderWay" value="'.$PAGE_SORTWAY.'"><input type="hidden" name="HHStart" id="HHStart" value="'.$PAGE_CURRENT.'">

	<input type="hidden" name="HHDeleteValue" id="HHDeleteValue" value="'.$GLOBALS['SEARCH_DATA']['tb_deletevalue'].'"><input type="hidden" name="HHRows" id="HHRows" value="'.$PAGE_STOP.'">

	';



	



	print '<table class="eMeetingTableBar"><tr><td>';



	print "<input type='text' onBlur='if(this.value == \"\"){this.value = \"Enter Keyword...\";}' onChange='eMeetingTableSwitchWld(this.value,1); return false;' class='input' id='SearchKey' onClick='this.value = \"\";' value='Enter Keyword...'>";



	print "<select onChange='eMeetingChangeWay(); eMeetingTableSwitchWld(this.value,2);' class='input' style='width:150px;'><option value='1'>Order By</option>"; $cap=0; foreach($GLOBALS['SEARCH_DATA']['tb_data'] as $value){ print "<option value='".eMeetingRemoveASTables($value)."'>".$GLOBALS['SEARCH_DATA']['tb_captions'][$cap]."</option>"; $cap++; } print "</select>";	



	print "<select onChange='eMeetingTableSwitchWld(this.value,4);' class='input'><option value='1'>Rows Per Page</option><option value='10'>10</option><option value='50'>50</option><option value='100'>100</option></select>";



	print "</td><td><div id='TableAlert'></div></td></tr></table>";



	if($TOTAL_DATA == 0){ print "<div style='padding:20px;text-align:center;'><h1>No Results Found</h1><p><img src='inc/images/icons/files.gif' align='absmiddle'> <a href='".$_SERVER['HTTP_REFERER']."'>Restart Search</a></p></div>"; }else{



	// LOAD TABLE HEADERS

	print '<div id="eMeetingTableWrapper"><table id="eMeetingTable">'; 

	print '<thead><tr>';

	print '<th class="sortfirstdesc"></th>';

	$th=0; foreach($GLOBALS['SEARCH_DATA']['tb_data'] as $value){ if(substr($value,-2) =="id" && $GLOBALS['SEARCH_DATA']['tb_hideID'] ==true) { $th++;}else{

	print '<th id="'.$GLOBALS['SEARCH_DATA']['tb_data'][$th].'"><a href="#" onClick="eMeetingChangeWay(); eMeetingTableSwitchWld(\''.eMeetingRemoveASTables($GLOBALS['SEARCH_DATA']['tb_data'][$th]).'\',2); return false;">'.$GLOBALS['SEARCH_DATA']['tb_captions'][$th].'</a>'.eMeetingSpecialHeader($GLOBALS['SEARCH_DATA']['tb_data'][$th]).'</th>'; 

	$th++; }} 



	if($GLOBALS['SEARCH_DATA']['tb_edit']){ print '<td></td>';}

				

	print '</tr></thead>';

	// LOAD TABLE BODY

	$Counter=1; while( $Data = $DB->NextRow($result) ){	



	if($Counter % 2){

		$BGC="roweven";

		$BG_C="transparent";

	}

	else{

		$BGC="rowodd";

	}

	print '<tr align="center" id="tr_'.$Counter.'" class="'.$BGC.'"  onmouseover="this.style.backgroundColor=\'#DAEFFF\';" onmouseout="this.style.backgroundColor=\'#ffffff\';"><td style="width:30px;"><input name="d'.$Counter.'" type="checkbox" value="on"><input type=hidden value="'.$Data[eMeetingTableStringKeys($GLOBALS['SEARCH_DATA']['tb_deletevalue'], $GLOBALS['SEARCH_DATA']['tb_data_name'])].'" name="id'.$Counter.'" class="hidden"></td>';

	 

	$i=0; foreach($GLOBALS['SEARCH_DATA']['tb_data'] as $value){ 

 

		if(substr($value,-2) =="id" && $GLOBALS['SEARCH_DATA']['tb_hideID'] ==true) {



		}

		else{

		

			$ThisValue = $Data[eMeetingTableStringKeys($GLOBALS['SEARCH_DATA']['tb_data'][$i], $GLOBALS['SEARCH_DATA']['tb_data_name'])]; 

			$ThisValue = eMeetingWLDTableValue($ThisValue,$Data[eMeetingTableStringKeys($GLOBALS['SEARCH_DATA']['tb_deletevalue'], $GLOBALS['SEARCH_DATA']['tb_data_name'])],$GLOBALS['SEARCH_DATA']['tb_data'][$i],$i.$Counter,$Data);

		print '<td scope="col" >'.$ThisValue.'</td> ';}



	$i++; } 



	// EDIT BOX

	if($GLOBALS['SEARCH_DATA']['tb_edit']){

		print "<td align='center'><a href='".$GLOBALS['SEARCH_DATA']['tb_edit_path'].$Data[eMeetingTableStringKeys($GLOBALS['SEARCH_DATA']['tb_deletevalue'], $GLOBALS['SEARCH_DATA']['tb_data_name'])]."'>".icon_edit."</a></td>";

	}

	

	print '</tr>';	

	

	 $i=0;$Counter++;} 

	

	 print '</tbody></table></div>';



	}





	// BUILD PAGE BUTTON



	print '<table class="eMeetingTableBar"><tr><td>';



	print WLDMakePageNumbers($PAGE_STOP, $TOTAL_DATA, $PAGE_CURRENT);

if(isset($Counter)) $Counter--;

	print '</td><td>



		<table width="350" border="0" style="background:#FFFFFF; padding:5px;">

		  <tr>

			<td>&nbsp;Showing:</td>

			<td><input name="textfield2" type="text" size="3" maxlength="5" style="width:35px;" value="'.$PAGE_STOP.'" onChange="eMeetingTableSwitchWld(this.value,4);"></td>

			<td> per page </td>

			<td style="font-size:10px;font-weight:bold;"> ('.number_format (isset($Counter)).' visible /'.number_format($total['total']).' total )</td>

		  </tr>

		</table>



	</td>



    <td>



		<table width="92" border="0" style="padding:5px;">

		  <tr>

			 &nbsp;

		</tr>

		</table>



	</td>



  </tr></table>';



	if (isset($Counter)!=''){$Counter_1=$Counter;}else{$Counter_1=isset($Counter);}



	print '<br><div class="bar_save"><input type="button" value="Select All" class="NormBtn" onClick="ca('.$Counter_1.')"/>

	<input type="button" value="Deselect All" class="NormBtn"  onClick="ua('.$Counter_1.')"/>';



	if(isset($_REQUEST['system']) && $_REQUEST['system'] == 'members_report'){

		print '<input type="button" value="Accept" class="MainBtn report-btn" onClick="eMeetingTableReport('.$Counter_1.');" />';	

	}

	print '<input type="button" value="Delete" class="MainBtn" onClick="eMeetingTableSubmitWld('.$Counter_1.');" />';





	if(isset($_REQUEST['system']) && $_REQUEST['system'] == 'members'){

		print '<input type="button" value="Block" class="MainBtn block-btn" onClick="eMeetingTableBlock('.$Counter_1.');" />';	

	}

	

	print '</div>';



	print '</form>';





	}else{

		print "Error! Data not loaded ".$_GET['system'];

	}

	

	

}









function eMeetingWLDTableValue($value, $id, $field, $counter, $ArrayData, $market = array()){



	if($value =="yes"){ $value="<div id='yesNoImg_".$counter."'><a href='#' onClick=\"WLDChangeYesNo('no','".$id."','".$field."'); WLDChangeImage('yesNoImg_".$counter."','no','".$id."','".$field."'); return false;\"><img src='inc/images/icons/yes.png' align='absmiddle'></a></div>"; 

	}elseif($value =="no"){ $value="<div id='yesNoImg_".$counter."'><a href='#' onClick=\"WLDChangeYesNo('yes','".$id."','".$field."'); WLDChangeImage('yesNoImg_".$counter."','yes','".$id."','".$field."'); return false;\"><img src='inc/images/icons/no.png' align='absmiddle'></a></div>"; }



	

	elseif(substr($field,-4) =="code"){

		return "<div class='table-code-img'>".str_replace("\\\"", "", $value)."</div>";

	}elseif(substr($field,-8) =="Category"){



	}elseif(substr($field,-8) =="page_url"){



		$site_page = explode("###", $value);



		$site_detail = WLDGetSite($site_page['0']);



		return "<a href='http://".$site_detail['site_url']."/index.php?dll=".$site_page['1']."' target='_blank'> http://".$site_detail['site_url']."/index.php?dll=".$site_page['1']." </a>";

	}elseif(substr($field,-8) =="template"){



		return "<img src='".DB_DOMAIN."inc/templates/".$value."/images/design.gif' style='width:200px;border:1px solid #6666;'>";



	}elseif(substr($field,-6) =="gender"){



	$_SESSION['g_array'][$value]['icon'] = (isset($_SESSION['g_array'][$value]['icon'])) ? $_SESSION['g_array'][$value]['icon'] :'';

	$_SESSION['g_array'][$value]['caption'] = (isset($_SESSION['g_array'][$value]['caption'])) ? $_SESSION['g_array'][$value]['caption'] :'';

	

	return "<div id='ChangeDiv_".$counter."' onClick=\"eMeetingChangeDivWld('gender','ChangeDiv_".$counter."', '".$value."','".$id."','".$field."')\" style='cursor:pointer;'/>".$_SESSION['g_array'][$value]['icon']." ".$_SESSION['g_array'][$value]['caption']."</div>";

 

	}elseif(substr($field,-4) =="Date"){



	}elseif(substr($field,-5) ==".type"){



	return "<a href='?p=files&t=".$value."'>".$value."</a>";



	}elseif(substr($field,-9) =="lastlogin" || substr($field,-7) =="created"){



	//return ShowTimeSince($value);

	return showTimeFrom($value);



	}



	elseif(substr($field,-9) =="languages"){

 	

 	$langs = explode(",", $value);

	

	$return_val = "<div class='wld_table_languages'><span>".implode("</span><span>", $langs)."</span></div>";



	return $return_val;



	}



	elseif(substr($field,-8) =="site_url" || substr($field,-9) =="site_name" || substr($field,-11) =="market_name" || substr($field,-9) =="age_range" || substr($field,-10) =="first_name" || substr($field,-9) =="last_name" || substr($field,-5) =="email" || substr($field,-5) =="phone" || substr($field,-5) =="sites" || substr($field,-3) =="url"){

 

	return $value;



	}

	elseif(substr($field,-7) =="content" || substr($field,-11) =="description"){

 		

 		$ret = "<div id='desc_".$id."' onmouseover = \"WLDShowDesc('long_desc_".$id."');\" onmouseout = \"WLDHideDesc('long_desc_".$id."');\" class='site_page_desc'>";



	 	if(strlen(html_entity_decode($value)) > 20){

			$ret .= substr(html_entity_decode($value), 0,20).'...';

	 	}

	 	else{

			$ret .= $value;

	 	}



	 	$ret .= "<div id = 'long_desc_".$id."'  class='site_page_long_desc' style=\"display:none;\">".html_entity_decode($value)."</div>

	 		</div>

	 	";  



	 	return $ret;

	}



	elseif(substr($field,-3) =="age"){

 

	return MakeAge($value);



	}elseif(substr($field,-5) =="Photo"){



		$domain = DB_DOMAIN;



		if($_GET['system'] == 'members'){



			$image_val = explode("###", $value);

			

			if(!empty($image_val)){

				$value = $image_val['0'];

				$site_id = (isset($image_val['1'])) ? $image_val['1'] : 0;

			}



			if(isset($site_id) && $site_id != '0'){

				$site = WLDGetSite($site_id);

			}

			else{

				$site = array();

			}



			if(!empty($site)){

				$domain = 'http://'.$site['site_url'].'/';

			}

		

		}



		

	//return "<a href='members.php?p=files&u=".$ArrayData['username']."'><img src='".$domain."inc/tb.php?src=".$value."&x=48&y=48' width='48' height='48' style='border:1px solid #6666;'></a>";

	return "<img src='".$domain."inc/tb.php?src=".$value."&x=48&y=48' width='48' height='48' style='border:1px solid #6666;'>";



	}elseif(substr($field,-8) =="username"){

		

		if(isset($_REQUEST['system']) && $_REQUEST['system'] == 'customers'){

			return "<a href='".DB_DOMAIN."newadmin/wld.php?p=customers&detail=beneficiery&eedit_id=".$id."'> ".$value." </a>";

		}

		else{

			return "<a href='".DB_DOMAIN."newadmin/wld.php?p=members_edit&mid=".$id."&market_id=".$_GET['market_id']."'> ".$value." </a>";

		}

	

	//return "<a href='".DB_DOMAIN."index.php?dll=profile&pUsername=".$ArrayData['username']."' target='_blank'> ".$value." </a>";



	}

	elseif(substr($field,-4) =="name"){

	return $value;

	}

	elseif(substr($field,-4) =="type"){

 

	}elseif(substr($field,-4) =="icon"){



	$value = str_replace(DB_DOMAIN."uploads/files/","",$value);

	return "<img src='".DB_DOMAIN."uploads/files/".$value."'>";



	}elseif(substr($field,-4) =="aicon"){



	return "<img src='inc/images/avatars/".$value."'>";



 	}elseif(substr($field,-4) =="Icon"){



	return "<img src='".DB_DOMAIN."inc/exe/Games/pics/".$value.".gif'>";



	}elseif(substr($field,-4) =="File"){

	

	return WLDDisplayPhoto($ArrayData,1,$market);



	}

	

	elseif(substr($field,-13) =="wld_countries"){



		global $DB;

		$c_codes = explode(",", $value);



		$site_countries = array();



		if($c_codes['0'] != '0'){

		$countries = $DB->Query("SELECT DISTINCT(country_name) AS country FROM geo_ip_contries WHERE country_code IN ('".implode("','", $c_codes)."') ORDER BY country_name");



		while($country = $DB->NextRow($countries)){

			

			$site_countries[] = $country['country'];



		}

		}

		else{

			$site_countries = array('International');	

		}

		return "<div class='wld_table_countries'><span>".implode("</span><span>", $site_countries)."</span></div>";





	}

	elseif(substr($field,-7) =="country"){



	return "<div id='ChangeDiv_".$counter."' onClick=\"eMeetingChangeDivWld('country','ChangeDiv_".$counter."', '".$value."','".$id."','".$field."')\" style='cursor:pointer;'/>".MakeCountry($value)."</div>";



	}elseif(substr($field,-8) =="Upgraded"){



	return "".GetPackageName($value)."";



	}elseif(substr($field,-10) =="Membership"){



	return "<div id='ChangeDiv_".$counter."' onClick=\"eMeetingChangeDivWld('membership','ChangeDiv_".$counter."', '".$value."','".$id."','".$field."')\" style='cursor:pointer;'/>".GetPackageName($value)."</div>";



	}elseif(substr($field,-10) =="LinkedWith"){



	return "<select onChange=\"eMeetingSaveLinkedListID(this.value, ".$id."); return false;\">".DynamicLinkFieldList($ArrayData['linked_id'],$value)."</select>";





	}elseif(substr($field,-6) =="active"){

 

		if($ArrayData['activate_code'] !="OK"){

			$value = "noAK";

		}



	// ADD IMAGES

	switch($value){

	 case"suspended":{ $img ='<img src="inc/images/icons/flag_red.png" align="absmiddle"> ';} break;

	 case"unapproved":{ $img ='<img src="inc/images/icons/flag_blue.png" align="absmiddle"> '; } break;

	 case"cancel":{ $img ='<img src="inc/images/icons/flag_orange.png" align="absmiddle"> '; } break;

	 case "noAK": { $img ='<img src="inc/images/icons/flag_green.png" align="absmiddle"> '; $value="Awaiting Email Activation"; } break;

	 default: {$img=""; }

	}



	return "<div id='ChangeDiv_".$counter."' onClick=\"eMeetingChangeDivWld('status','ChangeDiv_".$counter."', '".$value."','".$id."','".$field."')\" style='cursor:pointer;'/>".$img.$value."</div>";





	}elseif(substr($field,-5) =="photo" && $value !=""){ 



		if(strpos($value,".") ===false){ // added extra for game icons

		$value ="<img src='".WEB_PATH_FILES.$value.".gif'>";

		}else{

		$value ="<img src='".WEB_PATH_FILES.$value."'>";

		} 		

	

	}elseif(substr($field,-4) =="icon" && $value !=""){ 

 

		if(strpos($field,"game_games.gameid") ===false){ // added extra for game icons

			$value="<img src='".DB_DOMAIN."inc/tb.php?src=".$value."&t=f&x=48&y=48' width='48' height='48' style='border:1px solid #6666;'>";

		}else{

			$value="<img src='".GAME_PATH_PICS.$value.".gif'>";		

		

		}

	}elseif(substr($field,-8) =="filesize"){



		return byte_convert($value);



	}else{

		//if(strlen($value) > 20){ $value = strip_tags(substr($value,0,20)).".."; }else{ $value =strip_tags($value); }



		if(substr($field,-5) =="views"){



			$NewWidth="25px";



		}elseif(substr($field,-2) =="id"){

return $value;



		}elseif(substr($field,-2) =="id"){



			$NewWidth="25px";



		}elseif(substr($field,-5) =="title"){



		}elseif(substr($field,-4) =="rder"){



			$NewWidth="50px";



		}elseif(substr($field,-2) =="ip"){

		$NewWidth="50px";

		

		}elseif(substr($field,-7) =="credits"){

		$NewWidth="50px";

		

		}elseif(substr($field,-6) =="number"){

		$NewWidth="80px";



		}else{

			$NewWidth="150px";

		}



		if(substr($field,-4) =="lang"){

		 $value = "<div id='ChangeLang_".$counter."' onClick=\"eMeetingChangeLang('ChangeLang_".$counter."', '".$value."','".$id."','".$field."')\" style='cursor:pointer;'/> <img src=\"".DB_DOMAIN."images/language/flag_".$value.".gif\" align='absmiddle'> ".$value."</div>"; 

		}else{

		if (isset($NewWidth)!=''){$NewWidth_1=$NewWidth;}else{$NewWidth_1=isset($NewWidth);}



		if($field == 'members.ip'){



			$value = "<input type='text' value=\"".eMeetingOutput($value)."\" onClick='window.open(\"\/newadmin\/ip-whois.php?ip=".str_replace('"','',eMeetingOutput($value))."&uid=".$id."\", \"myWindow\", \"width=800,height=600,left=200px\");' onChange=\"eMeetingEditField(this.value,'".$id."','".$field."');\" style='width:".$NewWidth_1."; font-size:13px;height:25px;'>";



		}

		else{



			$value = "<input type='text' value=\"".eMeetingOutput($value)."\" onChange=\"eMeetingEditFieldWld(this.value,'".$id."','".$field."');\" style='width:".$NewWidth_1."; font-size:13px;height:25px;'>";



		}

		

	 

		}





		}



	return $value;

}



function getMarkets(){



	$arrMarket = array();

	global $DB;



	$markets = $DB->Query("SELECT wld_market_id,market_name FROM wld_markets WHERE active_status = 'Y'");

	

	while ($market = $DB->NextRow($markets)) {

		

		$arrMarket[$market['wld_market_id']] = $market['market_name'];



	}



	return $arrMarket;

}

function getMarketsHtml($page=""){



	$htmlMarket = "";

	global $DB;





	$markets = $DB->Query("SELECT wld_market_id,market_name FROM wld_markets WHERE active_status = 'Y'");

	

	$change = "";



	$change = "onChange=\"WLDLoadMarketwiseTable('$page',0,this.value);\"";



	$htmlMarket .= '<select '.$change.' name="wld-market" id="select-market"><option value="">Select Market</option>';





	while ($market = $DB->NextRow($markets)) {

		

		$htmlMarket .= '<option value="'.$market['wld_market_id'].'">'.$market['market_name'].'</option>';;



	}

	$htmlMarket .= '</select>';



	return $htmlMarket;

}



function getSitesHtml($page="",$market_id=0){



	



	$change = "";



	$query = "";



	$change = "onChange=\"WLDLoadSitewiseTable('$page',0,this.value);\"";



	if($market_id != '0' && $market_id != ''){



		$query = " AND market = '".$market_id."'";



	}



	$htmlSite = "";



	global $DB;



	$sites = $DB->Query("SELECT wld_site_id,site_url FROM wld_sites WHERE approved = 'yes' $query ORDER BY site_url");

	

	$htmlSite .= '<select '.$change.' name="wld-sites" id="select-site" ><option value="">Select Site</option>';





	while ($site = $DB->NextRow($sites)) {

		

		$htmlSite .= '<option value="'.$site['wld_site_id'].'">'.$site['site_url'].'</option>';;



	}

	$htmlSite .= '</select>';



	return $htmlSite;

}



function getMarketSiteHtml($page="",$chagneSettings="",$showSite = "yes"){



	$html = '<div class="box">

		<div class="box-content">

			<div class="field thumbnail-field choose-market">

				<label>Select Market:</label>

				<span id="select-market-html">';

					$html .= getMarketsHtml($page);

				$html .= '</span>

			</div>';

	if($showSite == "yes"){

			

		$html .= '<div class="field thumbnail-field choose-site">

			<label>Select Site:</label>

			<span id="SelectSiteHtml">';

		$html .= getSitesHtml($page);

		$html .= '</span></div>';

	}

	if($chagneSettings == 'yes'){

			$html .= '<div class="field thumbnail-field choose-market">

				<label>Change Sites In Market:</label>

				<span id="chkChangeSites" class="chkbox-site-settings">';

					$html .= '<input type="checkbox" name="write_market_sites" value="yes" id="chk-'.$page.'"/>';

				$html .= '</span>

			</div>';

		}

		$html .= '</div>

	</div>';



	return $html;

}



function getMarketDetail($mid){



	global $DB;



	$market = $DB->Row("SELECT * FROM wld_markets WHERE wld_market_id = '$mid'");

	

	

	echo json_encode($market);



}

function getMarket($mid){



	global $DB;



	$market = $DB->Row("SELECT * FROM wld_markets WHERE wld_market_id = '$mid'");

	

	

	return $market;



}

function addMarketDetail($post){



	global $DB;



	$arrReturn = array();



	$market = $DB->Row("SELECT count(*) as count FROM wld_markets WHERE market_name = '".$post['market_name']."' LIMIT 1");

	

	if($market['count'] > 0){

		

		$arrReturn['status'] = 'error';

		$arrReturn['text'] = 'Market name is already exists, please choose another name.';



	}

	else{



		$DB->Query("INSERT INTO wld_markets(market_name , market_database_name , market_database_username , market_database_password , market_database_path ) values('".$post['market_name']."','".$post['market_database_name']."','".$post['market_database_username']."','".$post['market_database_password']."','".$post['market_database_path']."')");



		$new_market = $DB->Row("SELECT wld_market_id , market_name FROM wld_markets ORDER BY  wld_market_id DESC LIMIT 1");



		$arrReturn['status'] = 'success';

		$arrReturn['mid'] = $new_market['wld_market_id'];

		$arrReturn['market_name'] = $new_market['market_name'];

		$arrReturn['text'] = 'New market has been created successfully.';



		$market = strtolower(str_replace(" ", "", $_POST['market_name']));



		$zip = new ZipArchive;

		if ($zip->open($_SERVER['DOCUMENT_ROOT'].'/market_code.zip') === TRUE) {

		    $zip->extractTo($_SERVER['DOCUMENT_ROOT'].'/wld/'.$market.'/');

		    $zip->close();

		}



		require_once($_SERVER['DOCUMENT_ROOT'].'/wld/'.$market.'/install/inc/data/icupid.php');

		require_once($_SERVER['DOCUMENT_ROOT'].'/wld/'.$market.'/install/inc/data/required_data.php');

		require_once($_SERVER['DOCUMENT_ROOT'].'/wld/'.$market.'/install/inc/data/required_data_1.php');

		require_once($_SERVER['DOCUMENT_ROOT'].'/wld/'.$market.'/install/inc/data/required_data_2.php');

		require_once($_SERVER['DOCUMENT_ROOT'].'/wld/'.$market.'/install/inc/data/required_data_3.php');

		require_once($_SERVER['DOCUMENT_ROOT'].'/wld/'.$market.'/install/inc/data/geo_ip_countries_1.php');

		require_once($_SERVER['DOCUMENT_ROOT'].'/wld/'.$market.'/install/inc/data/geo_ip_countries_2.php');



		$dbh = getMarketDBConnection($arrReturn['mid']);

		

		foreach ($icupid_query as $query) {

		

			$stmt = $dbh->prepare($query);

			$stmt->execute();

		

		}

		

		foreach ($required_data as $query) {

		

			$stmt = $dbh->prepare($query);

			$stmt->execute();

		

		}



		foreach ($required_data_1 as $query) {

		

			$stmt = $dbh->prepare($query);

			$stmt->execute();

		

		}



		foreach ($required_data_2 as $query) {

		

			$stmt = $dbh->prepare($query);

			$stmt->execute();

		

		}



		foreach ($required_data_3 as $query) {

		

			$stmt = $dbh->prepare($query);

			$stmt->execute();

		

		}



		foreach ($geo_ip_queries as $query) {



			$stmt = $dbh->prepare($query);

			$stmt->execute();

		

		}



	}

	echo json_encode($arrReturn);



}







function updateMarketDetail($post){



	global $DB;



	$udpate = $DB->Update("UPDATE wld_markets SET market_name = '".$post['market_name']."',market_database_name = '".$post['market_database_name']."',market_database_username = '".$post['market_database_username']."',market_database_password = '".$post['market_database_password']."',market_database_path = '".$post['market_database_path']."' WHERE wld_market_id = '".$post['mid']."'");

	

	/*$market = strtolower(str_replace(" ", "", $post['market_name']));



	



	require_once($_SERVER['DOCUMENT_ROOT'].'/market_code_2/install/inc/data/icupid.php');

	require_once($_SERVER['DOCUMENT_ROOT'].'/market_code_2/install/inc/data/required_data.php');

	require_once($_SERVER['DOCUMENT_ROOT'].'/market_code_2/install/inc/data/required_data_1.php');

	require_once($_SERVER['DOCUMENT_ROOT'].'/market_code_2/install/inc/data/required_data_2.php');

	require_once($_SERVER['DOCUMENT_ROOT'].'/market_code_2/install/inc/data/required_data_3.php');



	$dbh = getMarketDBConnection($post['mid']);

	

	foreach ($icupid_query as $query) {

		

		$stmt = $dbh->prepare($query);

		$stmt->execute();

	

	}

	

	foreach ($required_data as $query) {

	

		$stmt = $dbh->prepare($query);

		$stmt->execute();

	

	}



	foreach ($required_data_1 as $query) {

	

		$stmt = $dbh->prepare($query);

		$stmt->execute();

	

	}



	foreach ($required_data_2 as $query) {

	

		$stmt = $dbh->prepare($query);

		$stmt->execute();

	

	}



	foreach ($required_data_3 as $query) {

	

		$stmt = $dbh->prepare($query);

		$stmt->execute();

	

	}*/



	return "Market details has been updated successfully.";



}



function WLDMakePageNumbers($max_results, $total_results, $page){



$total_page_new = ceil($total_results / $max_results);

if($total_page_new ==0){ $total_page_new=1; }



	if($page ==0){$page=1; }

 

 	$SearchNav = '<table width="250" border="0" style="background:#FFFFFF; padding:5px;"><tr> <td><a href="#" onclick="javascript:eMeetingTableSwitchWld(1,3);"><img src="inc/images/icons/resultset_first.png"></a></td>';   



if($page < $total_page_new+1){



    $pag = new pageNumbers($page, $total_page_new, 1);



    $separator = "";

    foreach($pag->numbers as $pageNumber=>$type)

    {

        switch($type)

        {

            case "current": {



				$SearchNav .= '<td> Page <input name="textfield" style="width:35px;" type="text" size="3" maxlength="5" value="'.$pageNumber.'" onChange="eMeetingTableSwitchWld(this.value,3);"> of '.$total_page_new.'</td>';



             } break;

                

            case "link": {



				if($pageNumber < $page){ 



					if(!isset($StopThis1)){ $StopThis1=1;

					$SearchNav .= "<td><a href='#' onclick=\"javascript:eMeetingTableSwitchWld('".$pageNumber."',3);\"><img src=\"inc/images/icons/resultset_previous.png\"></a></td>"; }



				}else{

					

					if(!isset($StopThis2)){ $StopThis2=1;

					$SearchNav .= "<td><a href='#' onclick=\"javascript:eMeetingTableSwitchWld('".$pageNumber."',3);\"><img src=\"inc/images/icons/resultset_next.png\"></a></td>"; }

				}

             } break;



        }

    }

}

	$SearchNav .= "<td><a href='#' onclick=\"javascript:eMeetingTableSwitchWld('".$total_page_new."',3);\"><img src='inc/images/icons/resultset_last.png'></a></td></tr></table> ";



	print $SearchNav;



}



function getDashboardGraphFigures($market_id, $site_id){



	global $DB;



	$newSites = array();



	for ($i=1; $i <= 12; $i++) { 

		$newSites['sites'][$i] = 0;

	}



	$newSites['cats'] = array('1'=>'Jan', '2'=>'Feb', '3'=>'Mar', '4'=>'Apr', '5'=>'May', '6'=>'Jun', '7'=>'Jul', '8'=>'Aug', '9'=>'Sep', '10'=>'Oct', '11'=>'Nov', '12'=>'Dec');



	$result = $DB->Query("SELECT COUNT(wld_site_id) AS sites , MONTH(created_at) AS month FROM wld_sites WHERE created_at >= '".date("Y")."-01-01 00:00:00' GROUP BY MONTH(created_at)");



	while ($site = $DB->NextRow($result)) {

		$newSites['sites'][$site['month']] = (int) $site['sites'];

	}

	return $newSites;

}





function getAdminReportGraphFigures($market_id, $site_id, $load_by){



	global $DB;



	$newSites = array();



	for ($i=1; $i <= 12; $i++) { 

		$newSites['sites'][$i] = 0;

	}



	if($load_by == 'cur_month'){

		

		//$newSites['cats'] = array('1'=>'Jan', '2'=>'Feb', '3'=>'Mar', '4'=>'Apr', '5'=>'May', '6'=>'Jun', '7'=>'Jul', '8'=>'Aug', '9'=>'Sep', '10'=>'Oct', '11'=>'Nov', '12'=>'Dec');



		for ($i=1; $i <= date('d'); $i++) { 

			

			$day = date('jS', strtotime(date("Y-m-").$i));



			$newSites['cats'][$i] = $day;

		}

		$result = $DB->Query("SELECT COUNT(wld_site_id) AS sites , MONTH(created_at) AS month FROM wld_sites WHERE created_at >= '".date("Y-m")."-01 00:00:00' GROUP BY DAY(created_at)");



	}

	else if($load_by == 'last_month'){

		

		$month = (int)date('m');

		

		$prev_month_last = date("d", mktime(0, 0, 0, date("m"), 0, date("Y")));

		

		for ($i=1; $i <= $prev_month_last; $i++) {



			$day = date('jS', mktime(0, 0, 0, date("m")-1, $i, date("Y")));

						

			$newSites['cats'][$i] = $day;

		}



		$prev_month_first = date("Y-m-d H:i:s", mktime(0, 0, 0, date("m")-1, 1, date("Y")));

		$prev_month_last = date("Y-m-d H:i:s", mktime(23, 59, 10, date("m"), 0, date("Y")));



		$result = $DB->Query("SELECT COUNT(wld_site_id) AS sites , MONTH(created_at) AS month FROM wld_sites WHERE created_at >= '".$prev_month_first."' AND created_at <= '".$prev_month_last."' GROUP BY DAY(created_at)");



	}

	else if($load_by == 'last_days'){

		

		$prev_week_first_day = date("d", mktime(0, 0, 0, date("m"), date("d")-7, date("Y")));

		

		$j = 1;

		for ($i=7; $i >= 0; $i--) {



			$day = date('jS M', mktime(0, 0, 0, date("m"), date("d") - $i, date("Y")));

						

			$newSites['cats'][$j] = $day;

			$j++;

		}



		$prev_week_first = date("Y-m-d H:i:s", mktime(0, 0, 0, date("m"), date("d")-7, date("Y")));

		$prev_week_last = date("Y-m-d H:i:s", mktime(23, 59, 10, date("m"), date("d"), date("Y")));



		$result = $DB->Query("SELECT COUNT(wld_site_id) AS sites , MONTH(created_at) AS month FROM wld_sites WHERE created_at >= '".$prev_week_first."' AND created_at <= '".$prev_week_last."' GROUP BY DAY(created_at)");



	}

	else if($load_by == 'custom'){

		

		

		



		$from = explode("-", date("Y-m-d",strtotime($_POST['from_date'])));

		$to = explode("-", date("Y-m-d",strtotime($_POST['to_date'])));



		$custom_from_date = date("Y-m-d H:i:s", strtotime($_POST['from_date']));

		$custom_to_date = date("Y-m-d H:i:s", strtotime($_POST['to_date']));;



		if($from['0'] == $to['0']){



			if($from['1'] == $to['1']){



				$custom_from_day = date("d", strtotime($_POST['from_date']));

				$custom_from_month = date("m", strtotime($_POST['from_date']));

				$custom_from_year = date("Y", strtotime($_POST['from_date']));

				$custom_last_day = date("d", strtotime($_POST['to_date']));

						

				for ($i=(int)$custom_from_day; $i <= (int)$custom_last_day; $i++) {



					$day = date('jS M', mktime(0, 0, 0, $custom_from_month, $i, $custom_from_year));

								

					$newSites['cats'][$i] = $day;

				}



			}

			else{



				$custom_from_month = date("m", strtotime($_POST['from_date']));

				$custom_from_year = date("Y", strtotime($_POST['from_date']));

				$custom_last_month = date("d", strtotime($_POST['to_date']));

						

				for ($i=(int)$custom_from_month; $i <= (int)$custom_last_month; $i++) {



					$month = date('M', mktime(0, 0, 0, $i, 1, $custom_from_year));

								

					$newSites['cats'][$i] = $month;

				}



			}



		}

		else{

			

			$custom_from_year = date("Y", strtotime($_POST['from_date']));

			$custom_to_year = date("Y", strtotime($_POST['to_date']));

					

			for ($i=(int)$custom_from_year; $i <= (int)$custom_to_year; $i++) {



				$year = date('Y', mktime(0, 0, 0, 1, 1, $i));



				$newSites['cats'][$i] = $year;

			}

		}





		$prev_custom_first = date("Y-m-d", strtotime($_POST['from_date']))." 00:00:00";



		$prev_custom_last = date("Y-m-d", strtotime($_POST['to_date']))." 23:59:59";



		$result = $DB->Query("SELECT COUNT(wld_site_id) AS sites , MONTH(created_at) AS month FROM wld_sites WHERE created_at >= '".$prev_custom_first."' AND created_at <= '".$prev_custom_last."' GROUP BY DAY(created_at)");



	}

	else{

	

		$newSites['cats'] = array('1'=>'Jan', '2'=>'Feb', '3'=>'Mar', '4'=>'Apr', '5'=>'May', '6'=>'Jun', '7'=>'Jul', '8'=>'Aug', '9'=>'Sep', '10'=>'Oct', '11'=>'Nov', '12'=>'Dec');



		$result = $DB->Query("SELECT COUNT(wld_site_id) AS sites , MONTH(created_at) AS month FROM wld_sites WHERE created_at >= '".date("Y")."-01-01 00:00:00' GROUP BY MONTH(created_at)");

	}

	



	while ($site = $DB->NextRow($result)) {

		$newSites['sites'][$site['month']] = (int) $site['sites'];

	}

	return $newSites;

}





function getDashboardFigures($post){



	global $DB;

	$rlt = array();

	$condition = "";

	$market_condition="";



	if($post['market_id'] != "" && $post['market_id'] != "0"){

		$condition .= " AND market = '".$post['market_id']."' ";

		$market_condition = " AND wld_market_id = '".$post['market_id']."'";

	}



	if($post['site_id'] != "" && $post['site_id'] != "0"){

		$condition .= " AND wld_site_id = '".$post['site_id']."' ";

	}



	$markets = $DB->Row("SELECT count(*) as total_markets FROM wld_markets WHERE 1 $market_condition");

	$sites = $DB->Row("SELECT count(*) as total_sites, sum(IF(approved = 'yes',1,0)) as approved, sum(IF(approved = 'no',1,0)) as pending FROM wld_sites WHERE 1 $condition");

	

	$rlt['total_markets'] = $markets['total_markets'];

	$rlt['total_sites'] = $sites['total_sites'];

	$totalUserMedia = getMarketTotalUsers($post['market_id'], $post['site_id']);



	$totalGraphFigures = getDashboardGraphFigures($post['market_id'], $post['site_id']);



	$rlt['total_users'] = $totalUserMedia['totalUsers'];

	$rlt['pending_media'] = $totalUserMedia['pendingMedia'];

	$rlt['pending_music'] = $totalUserMedia['pendingMusic'];

	$rlt['pending_video'] = $totalUserMedia['pendingVideo'];

	$rlt['pending_youtube'] = $totalUserMedia['pendingYoutube'];

	$rlt['total_albums'] = $totalUserMedia['totalAlbums'];

	$rlt['total_comments'] = $totalUserMedia['totalComments'];

	$rlt['total_mail_sent'] = $totalUserMedia['totalMailSent'];

	$rlt['total_users_online'] = $totalUserMedia['totalUsersOnline'];

	$rlt['total_winks'] = $totalUserMedia['totalWinks'];

	$rlt['total_payments'] = $totalUserMedia['totalPayments'];

	$rlt['total_banners'] = $totalUserMedia['totalBanners'];

	$rlt['total_earnings'] = $totalUserMedia['totalEarnings'];

	$rlt['total_admin_earnings'] = $totalUserMedia['totalAdminEarnings'];

	$rlt['total_customer_earnings'] = $totalUserMedia['totalCustomerEarnings'];



	$rlt['approved_sites'] = $sites['approved'];

	$rlt['pending_sites'] = (isset($sites['pending']) && $sites['pending'] != "") ? $sites['pending'] : '0';

	



	$rlt['graph_regs'] = $totalUserMedia['totalGraphRegs'];

	$rlt['graph_pays'] = $totalUserMedia['totalGraphPays'];



	$rlt['graph_cats'] = $totalGraphFigures['cats'];

	$rlt['graph_sites'] = $totalGraphFigures['sites'];



	return $rlt;

}





function getAdminReportFigures($post){



	global $DB;

	$rlt = array();

	$condition = "";

	$market_condition="";



	if($post['market_id'] != "" && $post['market_id'] != "0"){

		$condition .= " AND market = '".$post['market_id']."' ";

		$market_condition = " AND wld_market_id = '".$post['market_id']."'";

	}



	if($post['site_id'] != "" && $post['site_id'] != "0"){

		$condition .= " AND wld_site_id = '".$post['site_id']."' ";

	}



	$markets = $DB->Row("SELECT count(*) as total_markets FROM wld_markets WHERE 1 $market_condition");

	$sites = $DB->Row("SELECT count(*) as total_sites, sum(IF(approved = 'yes',1,0)) as approved, sum(IF(approved = 'no',1,0)) as pending FROM wld_sites WHERE 1 $condition");

	

	$rlt['total_markets'] = $markets['total_markets'];

	$rlt['total_sites'] = $sites['total_sites'];

	$totalUserMedia = getGraphAdminReport($post['market_id'], $post['site_id'], $post['load_by']);



	$totalGraphFigures = getAdminReportGraphFigures($post['market_id'], $post['site_id'], $post['load_by']);



	$rlt['total_earnings'] = $totalUserMedia['totalEarnings'];

	$rlt['total_admin_earnings'] = $totalUserMedia['totalAdminEarnings'];

	$rlt['total_customer_earnings'] = $totalUserMedia['totalCustomerEarnings'];



	$rlt['graph_pays'] = $totalUserMedia['totalGraphPays'];

	$rlt['graph_admin_pays'] = $totalUserMedia['totalAdminGraphPays'];

	$rlt['graph_customer_pays'] = $totalUserMedia['totalCustomerGraphPays'];



	$rlt['graph_cats'] = $totalGraphFigures['cats'];

	$rlt['graph_sites'] = $totalGraphFigures['sites'];



	return $rlt;

}

{

	

}

function getGraphAdminReport($market_id , $site_id , $loadby){



	$condition = "";

	$market_condition = "";



	if($market_id != '' && $market_id != '0'){

		$market_condition .= " AND wld_market_id = $market_id"; 

	}



	$site_condition = "";

	$site_condition_banner = "";

	$site_condition_payment = "";



	if($site_id != '' && $site_id != '0'){
		$site_condition .= " AND members.site_id = $site_id"; 

		$site_condition_banner .= " AND site_id = '$site_id' ";

		$site_condition_payment .= " AND m.site_id = '$site_id' ";
	}



	$total = array();

	

	$total['totalEarnings'] = 0;

	$total['totalPayments'] = 0;

	$total['totalAdminEarnings'] = 0;

	$total['totalCustomerEarnings'] = 0;



	$total['totalGraphPays'] = array();

	$total['totalAdminGraphPays'] = array();

	$total['totalCustomerGraphPays'] = array();



	

	if($loadby == 'cur_month'){

		$current_months_first = date("Y-m")."-01";

		$current_date = date("Y-m-d");

		for ($i=1; $i <= date("d") ; $i++) {

			$total['totalGraphPays'][$i] = 0;

			$total['totalAdminGraphPays'][$i] = 0;

			$total['totalCustomerGraphPays'][$i] = 0;

		}

	}

	else if($loadby == 'last_month'){

		$month = (int)date('m');

		$prev_month_last = date("d", mktime(0, 0, 0, date("m"), 0, date("Y")));

		for ($i=1; $i <= $prev_month_last; $i++) {

			$total['totalGraphPays'][$i] = 0;

			$total['totalAdminGraphPays'][$i] = 0;

			$total['totalCustomerGraphPays'][$i] = 0;

		}

	}

	else if($loadby == 'last_days'){

		$prev_week_first_day = date("d", mktime(0, 0, 0, date("m"), date("d")-7, date("Y")));

		$j = 1;

		for ($i=7; $i >= 0; $i--) {

			$prev_week_first_day = date("d", mktime(0, 0, 0, date("m"), date("d")-$i, date("Y")));

			$total['totalGraphPays'][$prev_week_first_day] = 0;

			$total['totalAdminGraphPays'][$prev_week_first_day] = 0;

			$total['totalCustomerGraphPays'][$prev_week_first_day] = 0;

		}

	}

	

	else if($loadby == 'custom'){



		$from = explode("-", date("Y-m-d",strtotime($_POST['from_date'])));

		$to = explode("-", date("Y-m-d",strtotime($_POST['to_date'])));



		if($from['0'] == $to['0']){

			

			if($from['1'] == $to['1']){



				$custom_from_first_day = date("d", strtotime($_POST['from_date']));

				$custom_to_last_day = date("d", strtotime($_POST['to_date']));

				$j = 1;

				for ($i=(int)$custom_from_first_day; $i <= (int)$custom_to_last_day; $i++) {

					$total['totalGraphPays'][$i] = 0;

					$total['totalAdminGraphPays'][$i] = 0;

					$total['totalCustomerGraphPays'][$i] = 0;

				}

			}

			else {

				for ($i=(int)$from['1']; $i <= (int)$to['1'] ; $i++) {

			

					$total['totalGraphPays'][$i] = 0;

					$total['totalAdminGraphPays'][$i] = 0;

					$total['totalCustomerGraphPays'][$i] = 0;

				

				}

			}

		}

		else{



			for ($i=(int)$from['0']; $i <= (int)$to['0'] ; $i++) {



				$total['totalGraphPays'][$i] = 0;

				$total['totalAdminGraphPays'][$i] = 0;

				$total['totalCustomerGraphPays'][$i] = 0;

			

			}

		}



	}



	else{

		

		for ($i=1; $i <= 12 ; $i++) {

			

			$total['totalGraphPays'][$i] = 0;

			$total['totalAdminGraphPays'][$i] = 0;

			$total['totalCustomerGraphPays'][$i] = 0;

		

		}

	

	}







	global $DB;



	$markets = $DB->Query("SELECT distinct(market_database_name),market_database_path,market_database_username,market_database_password,wld_market_id FROM wld_markets WHERE 1 $market_condition");



	while ($market = $DB->NextRow($markets)) {

		

		try {

			

			$dbh = new PDO('mysql:host='.$market['market_database_path'].';dbname='.$market['market_database_name'].';charset=utf8mb4', $market['market_database_username'], $market['market_database_password']);

		    

			

			



			if($loadby == 'cur_month'){



				$qry_total_payments = $dbh->query("SELECT count(mb.uid) as payments, sum(p.price) as earning, m.site_id AS site_id FROM members m INNER JOIN members_billing mb ON m.id = mb.uid LEFT JOIN package p ON mb.packageid = p.pid WHERE m.created >= '".date('Y-m')."-01 00:00:00' $site_condition_payment GROUP BY m.site_id");

		    	

		    	$qry_graph_payments = $dbh->query("SELECT count(mb.uid) as payments,sum(p.price) as earning, DAY(m.created) AS month, m.site_id AS site_id FROM members m INNER JOIN members_billing mb ON m.id = mb.uid LEFT JOIN package p ON mb.packageid = p.pid WHERE m.created >= '".date('Y-m')."-01 00:00:00' $site_condition_payment GROUP BY DAY(created),m.site_id");



			}

			else if($loadby == 'last_month'){



				$prev_month_first = date("Y-m-d H:i:s", mktime(0, 0, 0, date("m")-1, 1, date("Y")));

				$prev_month_last = date("Y-m-d H:i:s", mktime(23, 59, 10, date("m"), 0, date("Y")));



				$qry_total_payments = $dbh->query("SELECT count(mb.uid) as payments, sum(p.price) as earning, m.site_id AS site_id FROM members m INNER JOIN members_billing mb ON m.id = mb.uid LEFT JOIN package p ON mb.packageid = p.pid WHERE m.created >= '".$prev_month_first."' AND m.created <= '".$prev_month_last."' $site_condition_payment GROUP BY m.site_id");

		    	

		    	$qry_graph_payments = $dbh->query("SELECT count(mb.uid) as payments,sum(p.price) as earning, DAY(m.created) AS month, m.site_id AS site_id FROM members m INNER JOIN members_billing mb ON m.id = mb.uid LEFT JOIN package p ON mb.packageid = p.pid WHERE m.created >= '".$prev_month_first."' AND m.created <= '".$prev_month_last."' $site_condition_payment GROUP BY DAY(created),m.site_id");



			}

			else if($loadby == 'last_days'){



				$prev_week_first = date("Y-m-d H:i:s", mktime(0, 0, 0, date("m"), date("d")-7, date("Y")));

				$prev_week_last = date("Y-m-d H:i:s", mktime(23, 59, 10, date("m"), date("d"), date("Y")));



				$qry_total_payments = $dbh->query("SELECT count(mb.uid) as payments, sum(p.price) as earning, m.site_id AS site_id FROM members m INNER JOIN members_billing mb ON m.id = mb.uid LEFT JOIN package p ON mb.packageid = p.pid WHERE m.created >= '".$prev_week_first."' AND m.created <= '".$prev_week_last."' $site_condition_payment GROUP BY m.site_id");

		    	

		    	$qry_graph_payments = $dbh->query("SELECT count(mb.uid) as payments,sum(p.price) as earning, DAY(m.created) AS month, m.site_id AS site_id FROM members m INNER JOIN members_billing mb ON m.id = mb.uid LEFT JOIN package p ON mb.packageid = p.pid WHERE m.created >= '".$prev_week_first."' AND m.created <= '".$prev_week_last."' $site_condition_payment GROUP BY DAY(created),m.site_id");



			}

			else if($loadby == 'custom'){



				$from = explode("-", date("Y-m-d",strtotime($_POST['from_date'])));

				$to = explode("-", date("Y-m-d",strtotime($_POST['to_date'])));



				$custom_from_date = date("Y-m-d H:i:s", strtotime($_POST['from_date']));

				$custom_to_date = date("Y-m-d H:i:s", strtotime($_POST['to_date']));;



				if($from['0'] == $to['0']){



					if($from['1'] == $to['1']){



						$qry_total_payments = $dbh->query("SELECT count(mb.uid) as payments, sum(p.price) as earning, m.site_id AS site_id FROM members m INNER JOIN members_billing mb ON m.id = mb.uid LEFT JOIN package p ON mb.packageid = p.pid WHERE m.created >= '".$custom_from_date."' AND m.created <= '".$custom_to_date."' $site_condition_payment GROUP BY m.site_id");

				    	

				    	$qry_graph_payments = $dbh->query("SELECT count(mb.uid) as payments,sum(p.price) as earning, DAY(m.created) AS month, m.site_id AS site_id FROM members m INNER JOIN members_billing mb ON m.id = mb.uid LEFT JOIN package p ON mb.packageid = p.pid WHERE m.created >= '".$custom_from_date."' AND m.created <= '".$custom_to_date."' $site_condition_payment GROUP BY DAY(created),m.site_id");



					}

					else{



						$qry_total_payments = $dbh->query("SELECT count(mb.uid) as payments, sum(p.price) as earning, m.site_id AS site_id FROM members m INNER JOIN members_billing mb ON m.id = mb.uid LEFT JOIN package p ON mb.packageid = p.pid WHERE m.created >= '".$custom_from_date."' AND m.created <= '".$custom_to_date."' $site_condition_payment GROUP BY m.site_id");

				    	

				    	$qry_graph_payments = $dbh->query("SELECT count(mb.uid) as payments,sum(p.price) as earning, MONTH(m.created) AS month, m.site_id AS site_id FROM members m INNER JOIN members_billing mb ON m.id = mb.uid LEFT JOIN package p ON mb.packageid = p.pid WHERE m.created >= '".$custom_from_date."' AND m.created <= '".$custom_to_date."' $site_condition_payment GROUP BY MONTH(created),m.site_id");

					}

				

				}

				else{



					$qry_total_payments = $dbh->query("SELECT count(mb.uid) as payments, sum(p.price) as earning, m.site_id AS site_id FROM members m INNER JOIN members_billing mb ON m.id = mb.uid LEFT JOIN package p ON mb.packageid = p.pid WHERE m.created >= '".$custom_from_date."' AND m.created <= '".$custom_to_date."' $site_condition_payment GROUP BY m.site_id");

				    	

			    	$qry_graph_payments = $dbh->query("SELECT count(mb.uid) as payments,sum(p.price) as earning, YEAR(m.created) AS month, m.site_id AS site_id FROM members m INNER JOIN members_billing mb ON m.id = mb.uid LEFT JOIN package p ON mb.packageid = p.pid WHERE m.created >= '".$custom_from_date."' AND m.created <= '".$custom_to_date."' $site_condition_payment GROUP BY YEAR(created),m.site_id");



				}



			}

			else{

				

				$qry_total_payments = $dbh->query("SELECT count(mb.uid) as payments, sum(p.price) as earning, m.site_id AS site_id FROM members m INNER JOIN members_billing mb ON m.id = mb.uid LEFT JOIN package p ON mb.packageid = p.pid WHERE 1 $site_condition_payment GROUP BY m.site_id");

		    	

		    	$qry_graph_payments = $dbh->query("SELECT count(mb.uid) as payments,sum(p.price) as earning, MONTH(m.created) AS month, m.site_id AS site_id FROM members m INNER JOIN members_billing mb ON m.id = mb.uid LEFT JOIN package p ON mb.packageid = p.pid WHERE m.created >= '".date('Y')."-01-01 00:00:00' $site_condition_payment GROUP BY MONTH(created),m.site_id");

			

			}



		    

		    if($qry_total_payments){



				foreach ($qry_total_payments as $row) {

					

					$marketSiteSettings = getMarketSiteSearchMemberSettings($market['wld_market_id'] , $row['site_id']);

			      	$admin_percent = 100 - $marketSiteSettings['market_commission'];

			      	$customer_percent = $marketSiteSettings['market_commission'];

		

		      		$total['totalPayments'] += $row['payments'];

		      		$total['totalEarnings'] += $row['earning'];

		      		$total['totalAdminEarnings'] += round(($row['earning'] * $admin_percent)/100,2);

		      		$total['totalCustomerEarnings'] += round(($row['earning'] * $customer_percent)/100,2);



		      	}



			}



			if($qry_graph_payments){





				foreach ($qry_graph_payments as $payment) {



				$marketSiteSettings = getMarketSiteSearchMemberSettings($market['wld_market_id'] , $payment['site_id']);



				$admin_percent = 100 - $marketSiteSettings['market_commission'];

		      	$customer_percent = $marketSiteSettings['market_commission'];

					

					$total['totalGraphPays'][$payment['month']] += (float)$payment['earning'];

					$total['totalAdminGraphPays'][$payment['month']] += round( (float)(($payment['earning'] * $admin_percent)/100), 2, PHP_ROUND_HALF_EVEN);

					$total['totalCustomerGraphPays'][$payment['month']] += round( (float)(($payment['earning'] * $customer_percent)/100), 2, PHP_ROUND_HALF_EVEN);;

				}

			}



			$dbh = null;



		} catch (PDOException $e) {

		    print "Error!: " . $e->getMessage() . "<br/>";

		    die();

		}

		

	}

	return $total;



}



function getMarketTotalUsers($market_id , $site_id){



		

	$condition = "";

	$market_condition = "";

	if($market_id != '' && $market_id != '0'){

		$market_condition .= " AND wld_market_id = $market_id"; 

	}



	$site_condition = "";

	$site_condition_banner = "";

	$site_condition_payment = "";



	if($site_id != '' && $site_id != '0'){

		$site_condition .= " AND members.site_id = $site_id"; 

		$site_condition_banner .= " AND site_id = '$site_id' ";

		$site_condition_payment .= " AND m.site_id = '$site_id' ";

	}



	$total = array();

	$total['totalUsers'] = 0;

	$total['pendingMedia'] = 0;

	$total['pendingMusic'] = 0;

	$total['pendingVideo'] = 0;

	$total['pendingYoutube'] = 0;

	$total['totalAlbums'] = 0;

	$total['totalComments'] = 0;

	$total['totalMailSent'] = 0;

	$total['totalUsersOnline'] = 0;

	$total['totalWinks'] = 0;

	$total['totalPayments'] = 0;

	$total['totalBanners'] = 0;

	$total['totalEarnings'] = 0;

	$total['totalAdminEarnings'] = 0;

	$total['totalCustomerEarnings'] = 0;

	

	$total['totalGraphRegs'] = array();

	$total['totalGraphPays'] = array();



	for ($i=1; $i <= 12 ; $i++) {

		$total['totalGraphRegs'][$i] = 0;

		$total['totalGraphPays'][$i] = 0;

	}



	global $DB;

	$markets = $DB->Query("SELECT distinct(market_database_name),market_database_path,market_database_username,market_database_password,wld_market_id FROM wld_markets WHERE 1 $market_condition");



	while ($market = $DB->NextRow($markets)) {

		

		try {

			

			$dbh = new PDO('mysql:host='.$market['market_database_path'].';dbname='.$market['market_database_name'].';charset=utf8mb4', $market['market_database_username'], $market['market_database_password']);

		    

		    $qry_user = $dbh->query("SELECT count(*) as users FROM members WHERE 1 $site_condition");

		    

		    $qry_regs = $dbh->query("SELECT count(id) AS regs, MONTH(created) AS month FROM members WHERE created >= '".date('Y')."-01-01 00:00:00' $site_condition GROUP BY MONTH(created)");

		    

		    $qry_albums = $dbh->query("SELECT count(*) as albums FROM album INNER JOIN members ON members.id = album.uid WHERE 1 $site_condition");



		    $qry_comments = $dbh->query("SELECT count(*) as comment FROM comments INNER JOIN members ON comments.from_uid = members.id WHERE 1 $site_condition");

		    

		    $qry_banners = $dbh->query("SELECT count(*) as banner FROM banners WHERE 1 $site_condition_banner");



		    $qry_email_sent = $dbh->query("SELECT count(*) as email_sent FROM email_sendtime");

		    

		    $qry_media = $dbh->query("SELECT count(*) as media,sum(IF(f.approved = 'no',1,0)) as pending_media, sum(IF(f.type = 'music',1,0)) as music , sum(IF(f.type = 'video',1,0)) as video , sum(IF(f.type = 'youtube',1,0)) as youtube FROM files f INNER JOIN members m ON f.uid = m.id WHERE 1 $site_condition_payment");

		    

		    $qry_users_online = $dbh->query("SELECT count(*) as online FROM members_online INNER JOIN members ON members.id = members_online.logid WHERE 1 $site_condition");

		    

		    $qry_total_winks = $dbh->query("SELECT count(*) as winks FROM messages WHERE type = 'wink'");

		    

		    $qry_total_payments = $dbh->query("SELECT count(mb.uid) as payments, sum(p.price) as earning, m.site_id AS site_id FROM members m INNER JOIN members_billing mb ON m.id = mb.uid LEFT JOIN package p ON mb.packageid = p.pid WHERE 1 $site_condition_payment GROUP BY m.site_id");



		    $qry_graph_payments = $dbh->query("SELECT count(mb.uid) as payments, MONTH(m.created) AS month FROM members m INNER JOIN members_billing mb ON m.id = mb.uid WHERE m.created >= '".date('Y')."-01-01 00:00:00' $site_condition_payment GROUP BY MONTH(created)");

		    if($qry_user)

			{

			

				$row = $qry_user->fetch(PDO::FETCH_ASSOC);

		      	$total['totalUsers'] += $row['users'];



			}



			if($qry_albums){



				$row = $qry_albums->fetch(PDO::FETCH_ASSOC);

		      	$total['totalAlbums'] += $row['albums'];



			}



			if($qry_comments){



				$row = $qry_comments->fetch(PDO::FETCH_ASSOC);

		      	$total['totalComments'] += $row['comment'];



			}

			if($qry_email_sent){



				$row = $qry_email_sent->fetch(PDO::FETCH_ASSOC);

		      	$total['totalMailSent'] += $row['email_sent'];



			}





			if($qry_media)

			{

			

				$row = $qry_media->fetch(PDO::FETCH_ASSOC);

		      	$total['pendingMedia'] += $row['pending_media'];

		      	$total['pendingMusic'] += $row['music'];

		      	$total['pendingVideo'] += $row['video'];

		      	$total['pendingYoutube'] += $row['youtube'];



			}

			if($qry_users_online){



				$row = $qry_users_online->fetch(PDO::FETCH_ASSOC);

		      	$total['totalUsersOnline'] += $row['online'];



			}

			if($qry_total_winks){



				$row = $qry_total_winks->fetch(PDO::FETCH_ASSOC);

		      	$total['totalWinks'] += $row['winks'];



			}

			if($qry_banners){

				

				$row = $qry_banners->fetch(PDO::FETCH_ASSOC);

				$total['totalBanners'] += $row['banner'];



			}

			if($qry_total_payments){



				foreach ($qry_total_payments as $row) {

					

					$marketSiteSettings = getMarketSiteSearchMemberSettings($market['wld_market_id'] , $row['site_id']);

			      	$admin_percent = 100 - $marketSiteSettings['market_commission'];

			      	$customer_percent = $marketSiteSettings['market_commission'];

		

		      		$total['totalPayments'] += $row['payments'];

		      		$total['totalEarnings'] += $row['earning'];

		      		$total['totalAdminEarnings'] += round(($row['earning'] * $admin_percent)/100,2);

		      		$total['totalCustomerEarnings'] += round(($row['earning'] * $customer_percent)/100,2);



		      	}



			}

			if($qry_regs){

				foreach ($qry_regs as $reg) {

					$total['totalGraphRegs'][$reg['month']] += (int)$reg['regs'];

				}

			}



			if($qry_graph_payments){

				foreach ($qry_graph_payments as $payment) {

					$total['totalGraphPays'][$payment['month']] += (int)$payment['payments'];

				}

			}



			

			

			$dbh = null;



		} catch (PDOException $e) {

		    print "Error!: " . $e->getMessage() . "<br/>";

		    die();

		}

		

		    



	    



	}

	return $total;



}



function WLDGetSitePageDetails($page_id){

	

	$market_id = $_REQUEST['market_id'];



	$dbh = getMarketDBConnection($market_id);

	

	$query = $dbh->prepare("SELECT * FROM template_pages WHERE id = '".$page_id."'");

	$query->execute();

	$page = $query->fetch();

	return $page;

}

function WLDGetSite($site_id){

	global $DB;



	$site = $DB->Row("SELECT * FROM wld_sites WHERE wld_site_id = '".$site_id."'");



	return $site;

}





function WLDUpdateSitePage($post){



	$page_id = $_REQUEST['edit_id'];

	$market_id = $_REQUEST['market_id'];

	



	$name = mysql_real_escape_string($_REQUEST['name']);

	$content = mysql_real_escape_string($_REQUEST['editor']);

	

	$dbh = getMarketDBConnection($market_id);



	$query = $dbh->prepare("UPDATE template_pages SET `name`= '$name', `content`= '$content' WHERE id='$page_id'");

	$query->execute();



	return true;

}





function WLDDisplayPhoto($array,$addSize,$market){

	

	$marketfolder = strtolower(str_replace(" ","",$market['market_name']));

	

	if($array['type'] =="photo"){

		

		if($addSize==1){			

			$UImage = DB_DOMAIN.'wld/'.$marketfolder.'/usermedia/'.$array['member_id'].'/thumbs/'.$array['File'];

		}else{						

			//$UImage = WEB_PATH_IMAGE_THUMBS.$array['File'];	

			$UImage = DB_DOMAIN.'wld/'.$marketfolder.'/usermedia/'.$array['member_id'].'/thumbs/'.$array['File'];

		}

		 

		//return "<a href='#' onclick=\"WLDNewpopUpWin('".$array['File']."');\"><img src='".$UImage."' width=48 height=48></a>";	

		return "<img src='".$UImage."' width=48 height=48>";	

										

	}elseif($array['type'] =="music"){



		$UMusic = DB_DOMAIN.'wld/'.$marketfolder.'/usermedia/'.$array['member_id'].'/music/'.$array['File'];

		

		return '<embed src="inc/js/mediaplayer.swf" width="48" height="20" allowscriptaccess="always" allowfullscreen="true" flashvars="width=48&height=20&file='.$UMusic.'" />';

									

	}elseif($array['type'] =="video"){				

		

		return '<a href="javascript:void(0);" onClick="PreviewWin(\'inc/pops/pop_video.php?file='.$array['File'].'\');"><img src="inc/images/16x16/movie_track_next.png" align="absmiddle"> Watch</a>';



	}elseif($array['type'] =="youtube"){

						

		return '<a href="javascript:void(0);" onClick="PreviewWin(\'inc/pops/pop_video.php?file='.str_replace("https://","",str_replace("http://","",$array['File'])).'&t=y\');"><img src="inc/images/16x16/movie_track_next.png" align="absmiddle"> Watch</a>';

 

	}else{

	

		return "<img src='../inc/tb.php?src=".DEFAULT_IMAGE."'>";

	

	}



	return $UImage;



}



function WLDChangeYesNo($field, $id, $table, $yesno, $market_id, $condition_field){



	$dbh = getMarketDBConnection($market_id);



	$sql = "UPDATE $table SET $field = :field WHERE $condition_field = :condition_field";



	$stmt = $dbh->prepare($sql);

                                              

	$stmt->bindParam(':field', $yesno, PDO::PARAM_STR);       

	$stmt->bindParam(':condition_field', $id, PDO::PARAM_STR); 

	$stmt->execute();

}



function getMarketSiteSearchMemberSettings($market_id, $site_id){



	global $DB;



	$is_market_exists = $DB->Row("SELECT COUNT(id) as count FROM wld_site_search_membership_file_settings WHERE market_id = '".$market_id."' AND site_id = '".$site_id."'");



	if(isset($is_market_exists) && $is_market_exists['count'] > 0){}

	else if($market_id != '' && $market_id != '0'){ 



		$market = getMarket($market_id);

		$site = WLDGetSite($site_id);



		$path_image = $_SERVER['DOCUMENT_ROOT'].'/wld/seniordating/usermedia/';

		$path_image_thumbs = $_SERVER['DOCUMENT_ROOT'].'/wld/seniordating/usermedia/';

		$path_video = $_SERVER['DOCUMENT_ROOT'].'/wld/seniordating/usermedia/';

		$path_music = $_SERVER['DOCUMENT_ROOT'].'/wld/seniordating/usermedia/';

		$path_files = $_SERVER['DOCUMENT_ROOT'].'/wld/seniordating/usermedia/';

		

		if($site_id != '0'){	



			$web_path_image = 'http://'.$site['site_url'].'/uploads/images/';

			$web_path_image_thumbs = 'http://'.$site['site_url'].'/uploads/thumbs/';

			$web_path_video = 'http://'.$site['site_url'].'/uploads/videos/';

			$web_path_music = 'http://'.$site['site_url'].'/uploads/music/';

			$web_path_files = 'http://'.$site['site_url'].'/uploads/files/';



		}

		else{



			$web_path_image = '';

			$web_path_image_thumbs = '';

			$web_path_video = '';

			$web_path_music = '';

			$web_path_files = '';



		}



		$DB->Update("INSERT INTO wld_site_search_membership_file_settings(

			market_id,

			site_id,

			d_statusmsg,

			d_free,

			default_package,

			d_must_upgrade,

			enable_adultcontent,

			d_gendermatching,

			must_have_image,

			validate_email,

			approve_accounts,

			approve_files,

			file_storage_web_path,

			photo_storage_web_path,

			thumb_storage_web_path,

			video_storage_web_path,

			music_storage_web_path,

			file_storage_server_path,

			photo_storage_server_path,

			thumb_storage_server_path,

			video_storage_server_path,

			music_storage_server_path,

			default_image,

			default_image_adult,

			default_music,

			default_video,



			date_display_format,

			block_usernames,

			d_mod_write,

			d_flags,

			d_cctext,

			auto_login,

			auto_amount,

			aff_currency



			) 

			VALUES(

			'$market_id',

			'$site_id',

			'love!',

			'no',

			'3',

			'no',

			'no',

			'0',

			'0',

			'0',

			'yes',

			'yes',

			'$web_path_files',

			'$web_path_image',

			'$web_path_image_thumbs',

			'$web_path_video',

			'$web_path_music',

			'$path_files',

			'$path_image',

			'$path_image_thumbs',

			'$path_video',

			'$path_music',

			'nophoto.jpg',

			'default_adult.jpg',

			'noaudio.jpg',

			'novideo.jpg',

		

			'm-d-Y',

			'admin,administration,wanker',

			'1',

			'1',

			'All Rights Reserved',

			'yes',

			'20',

			'$'



			)"); }

	

	$market_site_settings = $DB->Row("SELECT * FROM wld_site_search_membership_file_settings WHERE market_id = '".$market_id."' AND site_id = '".$site_id."'");	



	return $market_site_settings;

}



function getMarketSites($market_id,$site_id){



	$site_condition = "";



	if($site_id != '0'){

		$site_condition .= " AND wld_site_id = '$site_id'";

	}



	if($market_id != '0'){

		$site_condition .= " AND market = '".$market_id."'";

	}



	



	$array_sites = array();

	global $DB;

	

	$market_sites = $DB->Query("SELECT * FROM wld_sites WHERE 1 $site_condition");



	while ($site = $DB->NextRow($market_sites)) {

	

		$array_sites[] = $site;



	}



	return $array_sites;

}



function WLDDisplayNewsletters($default="",$type="custom"){



	global $DB;

	$Extra="";



	if($type !=""){

		$Extra ="status='".$type."' AND";

	}



    $result = $DB->Query("SELECT nid, name FROM email_newsletters WHERE $Extra name !='tracking'");



    while( $new = $DB->NextRow($result) )

    {



		if($new['nid'] == $default){

			print "<option value='".$new['nid']."' selected>".$new['name']."</option>";

		}else{

			print "<option value='".$new['nid']."'>".$new['name']."</option>";

		}

		

	}

}

function WLDMakeAllSearchData($SEARCH_VALUE){



	$ReturnString=" WHERE ( ";

	

		

	foreach($GLOBALS['SEARCH_DATA']["tb_data"] as $value){	

		if(strpos($value, "COUNT") === false){

		$ReturnString .= " ".eMeetingRemoveASTables($value)." LIKE '%".$SEARCH_VALUE."%' OR ";

		//$ReturnString .= " username LIKE '%".$SEARCH_VALUE."%' OR ";

 		}

	}

	

	$ReturnString .=" ) ";

	

	$ReturnString = str_replace("OR  )",")",$ReturnString);

	

	return $ReturnString;



}



function WldGetCustomerEditDetails($id){



	global $DB;

	

	if($id==""){$id=0; }

    $result = $DB->Row("SELECT * FROM wld_users WHERE wld_user_id= $id LIMIT 1");



    return $result;



}



function WldEditCustomer($id){





	global $DB;

	$NumFields = 1;

	$divCount =1;

	$divString="";

	$ReturnString="";

	// FIRST EGT FIELD GROUPS

	

	$user = $DB->Row("SELECT * FROM wld_users WHERE wld_user_id = '$id'");



	## start output display



	$ReturnString .= '<ul class="form customer-info-edit"><div class="box_body">';

	

	$ReturnString .= '<li><label>First Name</label>';					

	$ReturnString .= "<input name='first_name' class='input' type='text' maxlength='255' size='42' value=\"".$user['first_name']."\">";							

	$value="<br>";

	$ReturnString .= $value."</li>";



	$ReturnString .= '<li><label>Last Name</label>';					

	$ReturnString .= "<input name='last_name' class='input' type='text' maxlength='255' size='42' value=\"".$user['last_name']."\">";							

	$value="<br>";

	$ReturnString .= $value."</li>";



	$ReturnString .= '<li><label>Company Name</label>';					

	$ReturnString .= "<input name='company_name' class='input' type='text' maxlength='255' size='42' value=\"".$user['company_name']."\">";							

	$value="<br>";

	$ReturnString .= $value."</li>";



	$ReturnString .= '<li><label>Address</label>';					

	$ReturnString .= "<input name='address' class='input' type='text' maxlength='255' size='42' value=\"".$user['address']."\">";							

	$value="<br>";

	$ReturnString .= $value."</li>";



	$ReturnString .= '<li><label>Street</label>';					

	$ReturnString .= "<input name='street' class='input' type='text' maxlength='255' size='42' value=\"".$user['street']."\">";							

	$value="<br>";

	$ReturnString .= $value."</li>";



	$ReturnString .= '<li><label>City</label>';					

	$ReturnString .= "<input name='city' class='input' type='text' maxlength='255' size='42' value=\"".$user['city']."\">";							

	$value="<br>";

	$ReturnString .= $value."</li>";



	$ReturnString .= '<li><label>State</label>';					

	$ReturnString .= "<input name='state' class='input' type='text' maxlength='255' size='42' value=\"".$user['state']."\">";							

	$ReturnString .= $value."</li>";



	$ReturnString .= '<li><label>Country</label>';					

	$ReturnString .= '<select class="input" name="country">'.DisplayCountries($user['country']).'</select>';							

	$value="<br>";

	$ReturnString .= $value."</li>";



	$ReturnString .= '<li><label>Postal Code</label>';					

	$ReturnString .= "<input name='postal_code' class='input' type='text' maxlength='255' size='42' value=\"".$user['postal_code']."\">";							

	$ReturnString .= $value."</li>";



	$ReturnString .= '<li><label>Fax</label>';					

	$ReturnString .= "<input name='fax' class='input' type='text' maxlength='255' size='42' value=\"".$user['fax']."\">";							

	$ReturnString .= $value."</li>";





	$ReturnString .="</div></ul>";

			

	return $ReturnString;



}



function WldDisplayPackages($market_id,$site_id){



	global $DB;

	

	$condition = " WHERE site_id = '0' ";



	if($site_id != '0'){

		$condition .= "  OR site_id = '$site_id' ";

	}



	$dbh = getMarketDBConnection($market_id);



 	$SQL = "SELECT * FROM package $condition ORDER BY `type`";



 	$packages = $dbh->query($SQL);



 	

	$count=1;



	if(isset($packages) && !empty($packages)){



	foreach ($packages as $package) {

	

		$stmt = $dbh->prepare("SELECT count(id) AS total FROM members WHERE packageid=".$package['pid']." limit 1"); 

		$stmt->execute(); 

		$pack_users = $stmt->fetch();



		if($package['pid'] ==3 || $package['pid'] == 7){ $bgc ="#F0F5F9"; }else{ $bgc ="#ffffff"; }

		if($package['type'] =="custom"){ $DD=""; }else{ $DD="disabled";}



		print "<tr>

				<td bgcolor='".$bgc."'><input name='d".$count."' type='checkbox' value='on' ".$DD."><input type=hidden value='".$package['pid']."' name=id".$count." class='hidden'></td>

				<td bgcolor='".$bgc."'>".$package['pid']."</td>

				<td bgcolor='".$bgc."'>".$package['name']."</td>					

				<td bgcolor='".$bgc."'>".$package['currency_code']." ".$package['price']."</td>

				<td bgcolor='".$bgc."' align=center>";

					

			if($package['visible']==1 && $package['type'] =="custom"){ print "Yes"; }else{ print "No"; } print "</td>

				<td bgcolor='".$bgc."' align=center>".$pack_users['total']."</td>";

				 

		print "<td bgcolor='".$bgc."'><a href='?p=settings&sp=wld_package&market_id=$market_id&site_id=$site_id&pid=".$package['pid']."'>".icon_edit.$GLOBALS['lang_admin_edit']."</a></td></tr>";



		$count++;

	}



	}

    

	return $count;

}

function WldPackageItems($market_id,$pid){



	global $DB;



	$dbh = getMarketDBConnection($market_id);



	$stmt = $dbh->prepare("SELECT * FROM package WHERE pid=".$pid); 

	$stmt->execute(); 

	$result = $stmt->fetch();



	

	return $result;

}



function WLDGetEditMemberProfileDetails($id,$market_id){

	

	$dbh = getMarketDBConnection($market_id);



	$stmt = $dbh->prepare("SELECT m.*,md.* FROM members AS m INNER JOIN members_data AS md ON m.id = md.uid WHERE m.id = ".$id.""); 

	$stmt->execute(); 

	$result = $stmt->fetch();



	return $result;



}

function WLDGetMemberPhoto($mid, $type, $market_id){

	$dbh = getMarketDBConnection($market_id);

	$stmt = $dbh->prepare("SELECT id, title, description, bigimage FROM files WHERE uid = ".$mid." and type = '".$type."'"); 

	$stmt->execute(); 

	$result = $stmt->fetch();



	$domain = WLDGetMemberSiteUrl($market_id, $mid);



	$result['domain'] = $domain;



	return $result;

}

function WLDGetMemberAlbum($mid,$market_id){

	$dbh = getMarketDBConnection($market_id);

	$stmt = $dbh->prepare("SELECT aid FROM album WHERE uid = ".$mid.""); 

	$stmt->execute(); 

	$result = $stmt->fetch();



	$domain = WLDGetMemberSiteUrl($market_id, $mid);



	

	$result['domain'] = $domain;



	return $result;

}



function WLDGetfieldValue($field,$market_id){

	

	$dbh = getMarketDBConnection($market_id);



	$result1 = array();

	if(D_LANG !="english"){

		## check see if there is a caption	

		$stmt = $dbh->prepare("SELECT * FROM field_list_value WHERE fvFid = '". $field ."' AND lang='".D_LANG."' Order by fvOrder");	

		

		$stmt->execute();

		$test = $stmt->fetch();

		if(empty($test)){

			## no caption found, load english caption

			$SQL = "SELECT * FROM field_list_value WHERE fvFid = '". $field ."' AND lang='".D_LANG."' Order by fvOrder";	

		}else{				

			$SQL = "SELECT * FROM field_list_value WHERE fvFid = '". $field ."' AND lang='".D_LANG."' Order by fvOrder";

		}

	}

	else{

		$SQL = "SELECT * FROM field_list_value WHERE fvFid = '". $field ."' AND lang='".D_LANG."' Order by fvOrder";

	}



	$result = $dbh->query($SQL);

	foreach( $result AS $field ){

		$result1[] = $field;

	}

	

	return $result1;	

}





function WLDGetBasicProfileInformation($fieldtype,$market_id){

	

	$dbh = getMarketDBConnection($market_id);



	$SQL = "SELECT field.fid,field.fType, field.fName,field.linked_id FROM field INNER JOIN field_groups ON ( ( field_groups.id = field.groupid  || field_groups.id = field.groupid_1 || field_groups.id = field.groupid_2 )) WHERE ( field.groupid = '".$fieldtype."' OR field.groupid_1 = '".$fieldtype."' OR field.groupid_2 = '".$fieldtype."') GROUP BY field.fid ORDER BY field.fOrder ASC";



	$result1 = $dbh->query($SQL); 

	$result = array();

	

	foreach ($result1 as $field) {

		$result[] = $field;

	}

	

	return $result;

}



function WLDGetMemberColumns($fieldname, $mid,$market_id){

	

	$dbh = getMarketDBConnection($market_id);



	//echo "SELECT ".$fieldname." FROM members_data WHERE  uid= ('".$mid."') limit 1";

	$stmt = $dbh->prepare("SELECT ".$fieldname." FROM members_data WHERE  uid= ('".$mid."') limit 1");

	$stmt->execute();

	$caption = $stmt->fetch();

	return $caption; 

}



function WLDGetMemberColumnsValue($field,$market_id){

	$dbh = getMarketDBConnection($market_id);

	if(D_LANG !="english"){

		## check see if there is a caption					

		$stmt = $dbh->prepare("SELECT * FROM field_list_value WHERE fvid = '". $field ."' AND lang='".D_LANG."' Order by fvOrder");	

		$stmt->execute();



		$test = $stmt->fetch();

		

		if(empty($test)){

			## no caption found, load english caption

			$stmt = $dbh->prepare("SELECT fvCaption FROM field_list_value WHERE fvid = '". $field ."' AND lang='english' Order by fvOrder");

		}else{				

			$stmt = $dbh->prepare("SELECT fvCaption FROM field_list_value WHERE fvid = '". $field ."' AND lang='".D_LANG."' Order by fvOrder");	

		}



		$stmt->execute();

		$result2 = $stmt->fetch();

	}

	else{

	$stmt = $dbh->prepare("SELECT fvCaption FROM field_list_value WHERE fvid = '". $field ."' AND lang='".D_LANG."' Order by fvOrder");

	$stmt->execute();

	$result2 = $stmt->fetch();

	}

	return $result2;

}





function WLDGetFieldCaption($fid,$type,$market_id){

	

	$dbh = getMarketDBConnection($market_id);



	if(D_LANG !="english"){

				## check see if there is a caption

				$stmt = $dbh->prepare("SELECT caption, `description` FROM field_caption WHERE Cid=".$fid." AND `match` != 'yes' AND lang= ( '".D_LANG."' ) limit 1"); 

				$stmt->execute(); 

				$caption = $stmt->fetch();



				if(empty($caption)){

					## no caption found, load english caption

					

					$stmt = $dbh->prepare("SELECT caption, `description` FROM field_caption WHERE Cid=".$fid." AND `match` != 'yes' limit 1"); 

					$stmt->execute(); 

					$caption = $stmt->fetch();



				}

			}else{

				## check for english value



				$stmt = $dbh->prepare("SELECT caption, `description` FROM field_caption WHERE Cid=".$fid." AND `match` != 'yes' AND lang='".D_LANG."' limit 1"); 

				$stmt->execute(); 

				$caption = $stmt->fetch();



			}	

	return $caption;		

}



function WLDGetMemberSiteUrl($market_id,$mid){

	$dbh = getMarketDBConnection($market_id);



	$stmt = $dbh->prepare("SELECT site_id FROM members WHERE id = ".$mid.""); 

	$stmt->execute(); 

	$_site = $stmt->fetch();





	if($_site['site_id'] != '0'){

		$site = WLDGetSite($_site['site_id']);

	}



	if(isset($site['site_url']) && $site['site_url'] != ""){

		$domain = 'http://'.$site['site_url'].'/';

	}

	else{

		$domain = DB_DOMAIN;

	}

	return $domain;

}



function WLDGetProfileOrientation($current,$market_id){

	$dbh = getMarketDBConnection($market_id);



	$Gen = $dbh->query("SELECT fvid AS id, fvCaption as name FROM field_list_value WHERE fvFid=20 order by fvOrder ASC LIMIT 10");

	foreach( $Gen AS $value)

    {

		if($current == $value['id']):

			$select = 'selected';

		else:

			$select = '';

		endif;

		print "<option value='".$value['id']."' ".$select.">".$value['name']."</option>";

	}

}



function WLDGetMemberMediaGalley($mid, $type, $market_id = 0){

	

	$dbh = getMarketDBConnection($market_id);

	

	$SQL = "SELECT title, description, bigimage FROM files WHERE uid = ".$mid." and type = '".$type."'";

	

	$result = $dbh->query($SQL);



	$result1 = array();

	foreach( $result AS $field){

		$result1[] = $field;

	}

	

	return $result1;	

}



function getMarketDBConnection($market_id){



	$market = getMarket($market_id);

	

	$dbh = new PDO('mysql:host='.$market['market_database_path'].';dbname='.$market['market_database_name'].';charset=utf8mb4', $market['market_database_username'], $market['market_database_password']);



	return $dbh;

}

function getMarketQueryUpdate($dbh,$sql){

	$stmt = $dbh->prepare($sql);

	$stmt->execute();

}



function WLDDisplayFieldGroups($market_id){



	global $DB;

	$count=1;



	$fieldArray = array('age','location','headline','country','description','gender','postcode','zipcode','em_85820081128');



	$dbh = getMarketDBConnection($market_id);

		

    $result = $dbh->query("SELECT * FROM field_groups ORDER BY forder ASC");



    foreach( $result AS $groups )

    {	

		print '<div id="response_fieldupdate" class="responce_alert"></div><div class="bar_save" style="padding:5px;  background:#efefef;  font-size:14px; color:#666666; cursor:pointer;" onClick="javascript:idShowHide(\'group_'.$groups['id'].'\');" >

 ';

		print '<b><img src="inc/images/icons/resultset_next.png" align="absmiddle"> '.$groups['caption'].'</b> </div>';

		

 	   

		   	print '<table class="widefat" style="display:none; width:600px; background:#eeeeee;" id="group_'.$groups['id'].'">

					<thead>

					  <tr> 

					    <th style="width:15px;"></th>

						<th style="width:250px;">Field Name</th>						

						<th>Adv Search</th>

						<th>Register</th>

						<th>Match</th>							

						<th>Order</th>

					  </tr>

					</thead><tbody>';

					

			    $result1 = $dbh->query("SELECT * FROM field WHERE groupid='".$groups['id']."' ORDER BY fOrder ASC"); //LEFT JOIN field_linked ON (field.fid = field_linked.fid1) 

		   		foreach( $result1 AS $groups ){



		  	 		if($groups['linked_id'] != 0 && $groups['linked_id'] > 0){

		  	 			$LinkedThis ="&linkID=".$groups['linked_id'];}else{ $LinkedThis ="";

		  	 		}

		   			if($groups['fType'] == 1){

		   				$type =" "; $tname ="<img src='inc/images/icons/xhtml.png' align='absmiddle'> Text Field "; /*text field */

					}

					elseif($groups['fType'] == 7){

						$type =""; $tname ="<img src='inc/images/icons/text_lowercase.png' align='absmiddle'> Age Input Field ";/* */

					}

					elseif($groups['fType'] == 2){

						$type ="";

						$tname ="<img src='inc/images/icons/text_lowercase.png' align='absmiddle'> Text Area";/* */

					}

					elseif($groups['fType'] == 3){

						$tname ="<img src='inc/images/icons/text_padding_left.png' align='absmiddle'> Drop Down Field "; $type ="<img src='inc/images/icons/resultset_next.png'>  <a href='?p=fieldlist&id=".$groups['fid']."&list=1".$LinkedThis."'> Drop Down Items </a> <br>";

					}

					elseif($groups['fType'] == 4){

						$tname ="<img src='inc/images/icons/savelist.png' align='absmiddle'> Check Box"; $type =" "; /* check area */

					}

					elseif($groups['fType'] == 5){

						$tname ="<img src='inc/images/icons/text_list_bullets.png' align='absmiddle'> Multiple Checkbox "; $type ="<img src='inc/images/icons/resultset_next.png'>  <a href='?p=fieldlist&id=".$groups['fid']."&list=1'>Check Box Items </a> <br>";

					}

					

					$tname .= "<a href='management.php?p=addfields&id=".$groups['fid']."'>(Edit)</a>";

					print "<tr>";

					if(!in_array($groups['fName'], $fieldArray)){ $CC=""; }

					else{ $CC="disabled";}

					

					print "<td><input name='d".$count."' type='checkbox' value='on' ".$CC."><input type=hidden value='".$groups['fid']."' name=id".$count." class='hidden'></td>";

					

					/* PROFILE FIELD NAME */

					print "<td>";



					$stmt = $dbh->prepare("select id, lang, caption from field_caption where Cid='".$groups['fid']."' AND lang = 'english' LIMIT 1");

					$stmt->execute();



					$result2 = $stmt->fetch();

					



					if(empty($result2)){

					

						$stmt = $dbh->prepare("select id, lang, caption from field_caption where Cid='".$groups['fid']."' ORDER BY lang LIMIT 1");

						$stmt->execute();



						$result2 = $stmt->fetch();

					}

					//$extraText ="Database Name: ".;			

					//

 

					if(isset($result2['fid2'])){ $FieldName="123"; }else{ $FieldName="none";}



					if($groups['groupid_1'] != 0 || $groups['groupid_2'] != 0){



						$shared ="<img src='inc/images/16x16/150.png' alt='This group is shared' align='absmiddle'>";

					}

					else{

						$shared ="";

					}

					print "<img src='../images/language/flag_".$result2['lang'].".gif'><a href='javascript:void(0);' onClick=\"javascript:idShowHide('extra1_".$count."')\";'>".$result2['caption']." ".(isset($elink))." ".$shared."</a> 

					

					<div id='extra1_".$count."' style='display:none;line-height:30px;'><div style='padding:5px;'>".$tname."</div>

					<img src='inc/images/icons/resultset_next.png'> <a href='?p=fieldedit&id=".$groups['fid']."'> Edit Title </a> <br>					

					".$type."

					<img src='inc/images/16x16/150.png' alt='This group is shared' align='absmiddle'> <a href='?p=fieldeditmove&id=".$groups['fid']."&G1=".$groups['groupid']."&G2=".$groups['groupid_1']."&G3=".$groups['groupid_2']."'>  Move to another group </a> <br>";



					if(  $groups['fType'] == 3){

						print "<img src='inc/images/icons/resultset_next.png'> Linked With: <b><div id='FLink".$groups['fid']."'><a href='#' onClick=\"eMeetingShowLinkList('".$groups['fid']."','FLink".$groups['fid']."');\"> <img src='inc/images/icons/monitor_lightning.png' align='absmiddle'> ".GetLinkedName($groups['linked_id'])."</a></div></b>";

					}

					print "</div>";

 

					print "</td>";



					/* PROFILE BROWSE TYPE */

					print "<td style='background:#DEFFDA;' align=center>";

					

					if($groups['browsepage'] =="yes"){

						$img="yes.png";

						$nVal ="no";

					}

					else{

						$img="no.png";

						$nVal ="yes";

					}



					print "<div id='f1_".$groups['fid']."'><img src='inc/images/icons/".$img."' onClick=\"WLDUpdateFieldPage('".$nVal."','".$groups['fid']."','f1_".$groups['fid']."',1)\" style='cursor:pointer;'> </div> ";											

					print "</td>";



					/* PROFILE REGISTER MATCH */

					print "<td  style='background:#DEFFDA;' align=center>";

					

					if($groups['required'] ==1){

						$img="yes.png"; $nVal ="0";

					}

					else{

						$img="no.png"; $nVal ="1";

					}

					

					print "<div id='f2_".$groups['fid']."'><img src='inc/images/icons/".$img."' onClick=\"WLDUpdateFieldPage('".$nVal."','".$groups['fid']."','f2_".$groups['fid']."',2)\" style='cursor:pointer;'> </div> ";		

					print "</td>";

										

					/* PROFILE REGISTER MATCH */

					print "<td  style='background:#DEFFDA;' align=center>";	

					

					if($groups['matchpage'] =="yes"){

						$img="yes.png";

						$nVal ="no";

					}

					else{

						$img="no.png";

						$nVal ="yes";

					}

					

					if(($groups['fName'] =="country" || $groups['fName'] =="location" || $groups['fName'] =="age") || $groups['fType'] != 5 && $groups['fType'] != 1 && $groups['fType'] != 2 && $groups['fType'] != 4){



						print "<div id='f3_".$groups['fid']."'><img src='inc/images/icons/".$img."' onClick=\"WLDUpdateFieldPage('".$nVal."','".$groups['fid']."','f3_".$groups['fid']."',3)\" style='cursor:pointer;'> </div> ";		

	

					}

					else{  }

					 

					print "</td>"; 

 



					print "<td style='background:#eeeeee;'><input style='width:63px;' onChange=\"WLDUpdateFieldOrderBit(this.value,'".$groups['fid']."')\" name='ordervalue".$count."' type='text' value='".$groups['fOrder']."' size=3> </td>";



					

					print "</tr>";



					$count++;

			 	}

		   

				print "</tbody>  </table><br>";

			

			}



	print "<input name='TotalOrder' type='hidden' class='hidden' value='".$count."'>";	

	

	return $count;

}

function WLDDisplayGroups($id, $market_id){



	$dbh = getMarketDBConnection($market_id);



	$result = $dbh->query("SELECT id, caption FROM field_groups ORDER BY forder ASC");



		if($id == 0){

		print "<option value='0' selected>Not Selected</option>";

		

		}else{

		print "<option value='0'>Not Selected</option>";

		

		}



    foreach( $result AS $groups )

    {



		if($id == $groups['id']){

		print "<option value='".$groups['id']."' selected>".$groups['caption']."</option>";

		

		}else{

		print "<option value='".$groups['id']."'>".$groups['caption']."</option>";

		

		}

	}

	

	return;

}



function WLDFieldLangs(){

   

	$ext = array("php");

    $files = array();



    $marketsettings = getMarketSiteSearchMemberSettings($_GET['market_id'],'0');



    ## Find files in root directory

   	$checkthisone = D_LANG.".php";

   	if($handle = opendir(str_replace("usermedia/", "", $marketsettings['file_storage_server_path'])."inc/langs/")) {{

       	while(false !== ($file = readdir($handle))){

           	for($i=0;$i<sizeof($ext);$i++){



				if(strstr($file, ".".$ext[$i])){

					

					$pos = strpos($checkthisone, $file);  			   

					if($file != "english.php"){

						echo "<option value='$file'>$file</option>";

					}else{

						echo "<option value='$file' selected >$file - Default</option>";

					}

				

				}		   

           

           }

		}					                      

       	closedir($handle);

	}}

}



function WLDCreateRowName($Lenght = 2) { 

		  $name="";

		  $salt = "abchefghjkmnpqrstuvwxyz0123456789ABCDEFGH1JKLMNOPQRSTUVWXYZ"; 

		  srand((double)microtime()*1000000); 

			  $i = 0; 

			  while ($i <= $Lenght) { 

					$num = rand() % 33; 

					$tmp = substr($salt, $num, 1); 

					$name = $name . $tmp; 

					$i++; 

			  }

			  

			  return $name.gmdate("Ymd");

}



function WLDGetGroup($id, $market_id){



	$dbh = getMarketDBConnection($market_id);

	global $DB;

    $stmt = $dbh->prepare("SELECT * FROM field_groups WHERE id=".$id);

	$stmt->execute();

	$result = $stmt->fetch();

	return $result;



}



function WLDDisplayGateways($market_id){

	

	$dbh = getMarketDBConnection($market_id);

	

	$count=1;	

	$result = $dbh->Query("SELECT * FROM merchant");





    foreach( $result AS $merchant )

    {

	

			print "<tr>";

			print "<td><input name='d".$count."' type='checkbox' value='on'><input type=hidden value='".$merchant['id']."' name=id".$count." class='hidden'></td>";	

			print "<td>".$merchant['name']."</td>

				<td>".$merchant['active']."</td>

				<td><a href='?p=gateways&sp=gatewaycode&market_id=".$_GET['market_id']."&id=".$merchant['id']."'>Code</a></td>

				<td><a href='?p=gateways&sp=fields&market_id=".$_GET['market_id']."&id=".$merchant['id']."''>Manage</a></td>

				<td><a href='?p=gateways&sp=add_gateway&market_id=".$_GET['market_id']."&id=".$merchant['id']."'>".icon_edit.$GLOBALS['lang_admin_edit']."</a></td>				

			</tr>";

			$count++;

	}

	print "<input type='hidden' class='hidden' value='".$count."' name='NumRows'>";

	

	return $count;

}



function WLDEditField($id,$market_id){



	$dbh = getMarketDBConnection($market_id);

	

	$stmt = $dbh->prepare("SELECT * FROM merchant WHERE id=".$id);

	$stmt->execute();

	$result = $stmt->fetch();

	return $result;

}



function WLDDisplayRows($market_id, $id){



	

	$dbh = getMarketDBConnection($market_id);



	$count =1;

	$result = $dbh->query("SELECT name, id, value FROM merchant_data WHERE mid=".$id);

	

    foreach( $result AS $code ) {



		print "<tr>";

		print "<td><input name='d".$count."' type='checkbox' value='on'><input type=hidden value='".$code['id']."' name=id".$count." class='hidden'></td>";	

		print "<td>".$code['name']."</td><td>".$code['value']."</td></tr>";

			$count++;

	}

	return $count;

}



function WLDDisplayGatewayCode($market_id, $id){

	

	$dbh = getMarketDBConnection($market_id);

	

	$stmt = $dbh->prepare("SELECT action, method FROM merchant WHERE id=".$id);

	$stmt->execute();

	$top = $stmt->fetch();



	$result = $dbh->query("SELECT * FROM merchant_data WHERE mid=".$id);

	$text = "<form method='".$top['method']."' action='".$top['action']."'>\n";

    

    foreach($result AS $code){

    	$text .= "<input type='".$code['type']."' value='".$code['value']."' name='".$code['name']."'>\n\n";

	}

	$text .= "</form>";

	return $text;

}



function WLDBillItems($market_id, $id){



	$dbh = getMarketDBConnection($market_id);

	

	$stmt = $dbh->prepare("SELECT * FROM members_billing WHERE id=".strip_tags($id));

	$stmt->execute();

	$result = $stmt->fetch();



    return $result;

}



function WLDUpdateSiteText($post){



	global $DB;



	$site = $DB->Row("SELECT * from wld_sites WHERE wld_site_id = '".$post['site_id']."'");

                    

	$site_url = $site['site_url'];

	$dpath = str_replace(array('http://','https://','www.','/'), '', $site_url);



	$config_template = $_SERVER['DOCUMENT_ROOT'].'/'.$dpath.'/inc/config_template.php';



	if(!file_exists($config_template)){

        

		echo "<div class='wld-success-message' style='background: #FF0000;'>There was an error opening your <span>$config_template</span> file. Please make sure it exsits and is located in the <span>".$_SERVER['DOCUMENT_ROOT']."/".$dpath."/inc</span> directory</div>";

    }



    $post['yesno'] = (isset($post['yesno'])) ? $post['yesno']:'yes';





    if (!$file = fopen($config_template, 'a+b')) {

		

		die("There was an error opening your config.php file. Please make sure it exsits and is located in the inc/ directory.");



    } else if($post['site_id'] != '0' && $post['yesno'] == 'yes'){



		$data = array();

		$counter = 1;

		$filecontent = "";

		while (!feof($file)) {

			$data[$counter] = fgets($file);

			// check line and replace string

													

			if ( strstr($data[$counter], 'define("TMP_TXT_1","') && isset($post['txt1']) ) {

							 	

				$filecontent .= "define(\"TMP_TXT_1\",\"".$post['txt1']."\");\r\n";



			}

		  	elseif ( strstr($data[$counter], 'define("TMP_TXT_2","') && isset($post['txt2'])) {

							  	

				$filecontent .= "define(\"TMP_TXT_2\",\"".$post['txt2']."\");\r\n";



			}

			elseif ( strstr($data[$counter], 'define("TMP_TXT_3","') && isset($post['txt3']) ) {

							  	

				$filecontent .= "define(\"TMP_TXT_3\",\"".$post['txt3']."\");\r\n";

				

			}

			elseif ( strstr($data[$counter], 'define("TMP_TXT_4","') && isset($post['txt4']) ) {

				

				$filecontent .= "define(\"TMP_TXT_4\",\"".$post['txt4']."\");\r\n";



			}		

			elseif ( strstr($data[$counter], 'define("TMP_TXT_5","') && isset($post['txt5']) ) {

				

				$filecontent .= "define(\"TMP_TXT_5\",\"".$post['txt5']."\");\r\n";



			}



			elseif ( strstr($data[$counter], 'define("TMP_TXT_6","') && isset($post['txt6']) ) {



				$filecontent .= "define(\"TMP_TXT_6\",\"".$post['txt6']."\");\r\n";

				

			}		

			else{



				$filecontent .= $data[$counter];



			}		 

			$counter ++;

		

		}	

		fclose($file);

					 

		//now we have to write in all the new data to this file

		if (!$handle = fopen($config_template, 'w')) {echo "Cannot open file ($config_template)"; exit;  }

		

		// Write $somecontent to our opened file. 

		if (fwrite($handle, $filecontent) === FALSE){ echo "Cannot write to file ($config_template)"; exit;} 

	   	fclose($handle);

		



		$DB->Update("UPDATE `wld_home_page_text` SET 

			`welcome_title` ='".$post['txt1']."',

			`welcome_subtitle` ='".$post['txt2']."',

			`intro_title` ='".$post['txt3']."',

			`intro_subtitle` ='".$post['txt4']."',

			`intro_title_extra` ='".$post['txt5']."',

			`intro_subtitle_extra` ='".$post['txt6']."',

			`approved` = '".$post['yesno']."'

			WHERE site_id = '".$post['site_id']."'");

	}



	return true;



}

function WLDUpdateSteMetaTags($post){

			

	$post['m1'] = WLDMetaTagStrip($post['m1']);

	$post['m2'] = WLDMetaTagStrip($post['m2']);

	$post['m3'] = WLDMetaTagStrip($post['m3']);





	global $DB;



	$site = $DB->Row("SELECT * from wld_sites WHERE wld_site_id = '".$post['site_id']."'");

                    

	$site_url = $site['site_url'];

	$dpath = str_replace(array('http://','https://','www.','/'), '', $site_url);



	$config_template = $_SERVER['DOCUMENT_ROOT'].'/'.$dpath.'/inc/config_template.php';



	if(!file_exists($config_template)){

        

		echo "<div class='wld-success-message' style='background: #FF0000;'>There was an error opening your <span>$config</span> file. Please make sure it exsits and is located in the <span>".$_SERVER['DOCUMENT_ROOT']."/".$dpath."/inc</span> directory</div>";

    }



    $post['yesno'] = (isset($post['yesno'])) ? $post['yesno']:'yes';





    if (!$file = fopen($config_template, 'a+b')) {

		

		die("There was an error opening your config.php file. Please make sure it exsits and is located in the inc/ directory.");



    } else if($post['site_id'] != '0' && $post['yesno'] == 'yes'){



		$data = array();

		$counter = 1;

		$filecontent = "";

		while (!feof($file)) {

			$data[$counter] = fgets($file);

			// check line and replace string

													

			if ( strstr($data[$counter], "define('SEO_PREFIX_TITLE','")  ) {

							 	

				$filecontent .= "define('SEO_PREFIX_TITLE','".$post['m1']."');\r\n";



			}

		  	elseif ( strstr($data[$counter], "define('SEO_PREFIX_DESC','") ) {

							  	

				$filecontent .= "define('SEO_PREFIX_DESC','".$post['m2']."');\r\n";



			}

			elseif ( strstr($data[$counter], "define('SEO_PREFIX_KEYWORDS','") ) {

							  	

				$filecontent .= "define('SEO_PREFIX_KEYWORDS','".$post['m3']."');\r\n";

				

			}

			elseif ( strstr($data[$counter], "define('HOME_TITLE','")  ) {

				

				$filecontent .= "define('HOME_TITLE','".$post['h1']."');\r\n";



			}		

			elseif ( strstr($data[$counter], "define('HOME_DESC','")  ) {

				

				$filecontent .= "define('HOME_DESC','".$post['h2']."');\r\n";



			}



			elseif ( strstr($data[$counter], "define('HOME_KEYWORDS','") ) {



				$filecontent .= "define('HOME_KEYWORDS','".$post['h3']."');\r\n";

				

			}		

			else{



				$filecontent .= $data[$counter];



			}		 

			$counter ++;

		

		}	

		fclose($file);

					 

		//now we have to write in all the new data to this file

		if (!$handle = fopen($config_template, 'w')) {echo "Cannot open file ($config_template)"; exit;  }

		

		// Write $somecontent to our opened file. 

		if (fwrite($handle, $filecontent) === FALSE){ echo "Cannot write to file ($config_template)"; exit;} 

	   	fclose($handle);

		



		$DB->Update("UPDATE `wld_metatags` SET 

			`custom_title_prefix` ='".mysql_real_escape_string($post['m1'])."',

			`description_prefix` ='".mysql_real_escape_string($post['m2'])."',

			`keyword_prefix` ='".mysql_real_escape_string($post['m3'])."',

			`page_title` ='".mysql_real_escape_string($post['h1'])."',

			`description` ='".mysql_real_escape_string($post['h2'])."',

			`keywords` ='".mysql_real_escape_string($post['h3'])."',

			`approved` = '".$post['yesno']."'

			WHERE site_id = '".$post['site_id']."'");

	}



	return true;



}

function WLDMetaTagStrip($in){



	$SAVETHIS = preg_replace('/\s\s+/', ' ', $in);

	$SAVETHIS = trim(strip_tags(str_replace('"',"",$SAVETHIS)));

	$SAVETHIS = str_replace("'"," ",$SAVETHIS);

	$out = str_replace('"'," ",$SAVETHIS);



	return $out;



}

function WLDDisplayBannerPages($page){



	 $path = WLDFilterPath();

	 $ext = array("php");

	 $files = array();

	 $HandlePath = $_SERVER['DOCUMENT_ROOT']."/inc/templates/layout/";

	   

	 if($handle1 = opendir($HandlePath)) {

	 

	  while(false !== ($file = readdir($handle1))){

	 

	    for($i=0;$i<sizeof($ext);$i++){

              

			  if(strstr($file, ".".$ext[$i])){



				if($page == $file) {

			  

			  		print "<option value='$file' selected>$file</option>";

				}



				else {

					print "<option value='$file'>$file</option>";

				}

				

			  }

		}

	  }

	 

	 }

}

function WLDFilterPath(){

	$path=dirname(realpath($_SERVER['SCRIPT_FILENAME']));

	$path_parts = pathinfo($path);

	$path = str_replace("newadmin", "", $path);

	$path = str_replace("NEW", "", $path);

	return $path;

}



function WLDUpdateSiteBanner($post){

  

  	## TRY TO GET BANNER SIZE



    //$site = GetSiteDetails($post['site_id']);



    $siteSearchFileSettings = getMarketSiteSearchMemberSettings($post['market_id'], $post['site_id']);



 

    $dbh = getMarketDBConnection($post['market_id']);



    $upload_web_path = (isset($siteSearchFileSettings['photo_storage_web_path']) && $siteSearchFileSettings['photo_storage_web_path'] != "") ? $siteSearchFileSettings['photo_storage_web_path'] : 'http://'.$site['site_url'].'/uploads/images/' ;



    $upload_server_path = str_replace(array('http://','https://','www.'), '', $upload_web_path);

    $upload_server_path = $_SERVER['DOCUMENT_ROOT'].'/'.$upload_server_path;



    $image_stats = @GetImageSize($_FILES["uploadFile"]["tmp_name"]);



    $imagewidth = $image_stats[0];

    $imageheight = $image_stats[1];

                  

    $newstatus = $post['active'];



    $post['code2'] = $post['code'];

    if(!empty($_FILES['uploadFile']) && strlen($_FILES['uploadFile']['tmp_name']) > 5){

      if(copy($_FILES['uploadFile']['tmp_name'], $upload_server_path.$_FILES['uploadFile']['name'])){

                        

        // MALE HTML FOR THIS BANNER

        $post['code2'] = '<img src="'.$upload_web_path.$_FILES['uploadFile']['name'].'">';

      }

    }



    

    if($post['type'] =="affiliate"){

                    

        if(!isset($post['eaid'])){

                        

            $stmt = $dbh->prepare("INSERT INTO `aff_banners` (`filename` ,`image_name` ,`image_alt` ,`image_link` ,`site_id` ) VALUES ('".eMeetingInput($post['code2'])."', '".$post['name']."', '".$post['name']."', '".$post['link']."', '".$post['site_id']."')");



        }else{

                        

            $stmt = $dbh->prepare("UPDATE `aff_banners` SET filename='".eMeetingInput($post['code2'])."', `image_name`='".$post['name']."' ,`image_alt` ='".$post['name']."',`image_link`='".$post['link']."' WHERE id=".$post['eaid']);

    

        }



        $stmt->execute();



    }else{





        if(!isset($post['banner_id'])){



            $stmt = $dbh->prepare("INSERT INTO `banners` ( `bid` , `bName` , `imglocation` , `urllocation` , `page` , `active` , `approved` , `clicks` , `width` , `height` , `impressions`, code, position, site_id) VALUES (NULL , '".$post['name']."', '".isset($post['image'])."', '".$post['link']."', '".$post['page']."', '".$newstatus."', '".$post['approved']."', '".$post['showto']."', '$imagewidth', '$imageheight', '0', '".eMeetingInput($post['code2'])."' ,'".$post['bannerpos']."', '".$post['site_id']."')");



        }else{



            $stmt = $dbh->prepare("UPDATE banners SET bName='".$post['name']."', imglocation='".isset($post['image'])."', clicks='".$post['showto']."', urllocation='".$post['link']."', page='".$post['page']."', width='".$imagewidth."', height='".$imageheight."', active='".$newstatus."', approved='".$post['approved']."', code='".eMeetingInput($post['code2'])."', position='".$post['bannerpos']."' WHERE bid=".$post['banner_id']);



        }



        $stmt->execute();



    }

    

    return 'gogogo';

}



function WLDCopyTemplate($source, $destination) {



	$directory = opendir($source); 



    if (!file_exists($destination)) {

              

    	mkdir($destination, 0755, true);

       

   	}



   	while(($file = readdir($directory)) != false) { 



    	//Copy each individual file

		if(is_dir($source.'/' .$file) && $file!=".." && $file!="."){

        	WLDCopyTemplate($source.'/' .$file, $destination.'/' .$file);

        }

        else if($file!=".." && $file!="."){

	    	copy($source.'/' .$file, $destination.'/'.$file); 

	    }

	} 



}



function WLDeleteSiteFiles($target) {

    if(is_dir($target)){

    

        $files = glob( $target . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned

		        

        foreach( $files as $file ) {

			            

			WLDeleteSiteFiles( $file );      

		

		}

		

		if(file_exists($target)){

        	rmdir( $target );

		}



    } elseif(is_file($target)) {

	

    	unlink( $target );  

    }



}



function WLDAddPackageAccessFields($market_id,$site_id){



	global $DB;

	$package_exists = $DB->Row("SELECT COUNT(*) AS  count FROM wld_site_package_settings WHERE market_id ='$market_id' AND site_id ='$site_id' ORDER BY id");



	if($package_exists['count']  == '0'){



		if($site_id == '0'){

			$create_package_condition = " WHERE market_id ='0' AND site_id ='0' ";

		}

		else{

			$create_package_condition = " WHERE market_id ='$market_id' AND site_id ='0' ";

		}



		$package_data = $DB->Query("SELECT * FROM wld_site_package_settings $create_package_condition ORDER BY id");



		while ( $data = $DB->NextRow($package_data))

    	{

			$DB->Update("INSERT INTO wld_site_package_settings(market_id,site_id,package_id,page_name,page_key,page_label,page_value) VALUES('$market_id','$site_id','".$data['package_id']."','".$data['page_name']."','".mysql_real_escape_string($data['page_key'])."','".mysql_real_escape_string($data['page_label'])."','0')");

    	}



	}

}



?>