function WLDLoadTable(system,startvalue){
	Timer_Icon('TableViewer');
	//eMeetingDo('wld/ajax/_actions.php?action=LoadTable&system='+system+'&startvalue='+startvalue+'&market_id='+market_id,"TableViewer");
	eMeetingDo('wld/ajax/_actions.php?action=LoadTable&system='+system+'&startvalue='+startvalue,"TableViewer");
}

function WLDLoadMarketwiseTable(system,startvalue,market_id){

	var change_sites = false;

	if(document.getElementById('chk-settings_membership')){
		change_sites = document.getElementById('chk-settings_membership').checked;	
	}
	if(market_id != ""){
		if(document.getElementById('SelectSiteHtml')){
			Timer_Icon('SelectSiteHtml');
			eMeetingDo('wld/ajax/_actions.php?action=marketsites&system='+system+'&startvalue='+startvalue+'&market_id='+market_id,'SelectSiteHtml');
		}
		
		if(system == 'dashboard'){
			WLDGetDashboardFigures(market_id,0);			
		}
		else if (system == 'admin_reports') {
			WLDGetAdminReportFigures(market_id,0);
		}
		else if(system == 'customers' || system == 'approve_edit_metatags' || system == 'approve_edit_text'){
			Timer_Icon('TableViewer');
			eMeetingDo('wld/ajax/_actions.php?action=LoadTable&system='+system+'&startvalue='+startvalue+'&market_id='+market_id + '&change_sites=' + change_sites,"TableViewer");
		}
		else if(system == 'approve_media' || system == 'members' || system == 'manage_field_groups'  || system == 'payments' || system == 'approve_edit_banners' || system == 'approve_edit_pages'){
			Timer_Icon('TableViewer');
			eMeetingDo('wld/ajax/_actions.php?action=LoadMarketTable&system='+system+'&startvalue='+startvalue+'&market_id=' + market_id + '&change_sites=' + change_sites,"TableViewer");
		}
		else if(system == 'site_settings'){
			Timer_Icon('SelectSiteSettingHtml');
			eMeetingDo('wld/ajax/_actions.php?action=marketsites&system='+system+'&startvalue='+startvalue+'&market_id='+market_id,'SelectSiteSettingHtml');
			
			Timer_Icon('MarketSiteSettingViewer');
			eMeetingDo('wld/ajax/_actions.php?action='+system+'&system=market_settings&market_id='+market_id+'&site_id=0&change_sites=' + change_sites,"MarketSiteSettingViewer");
			
			document.getElementById("SiteSettingViewer").innerHTML ="";	
		}
		else{
			Timer_Icon('TableViewer');
			eMeetingDo('wld/ajax/_actions.php?action='+system+'&market_id='+market_id+'&change_sites=' + change_sites,"TableViewer");
		}
	}
}

function eMeetingEditFieldWld(value, id, field){

	var market_id=0;
	if(document.getElementById('select-market')){
		market_id = document.getElementById('select-market').value;
	}

	var site_id=0;
	if(document.getElementById('select-site')){
		site_id = document.getElementById('select-site').value;
	}
	var table = document.getElementById('HHDeleteValue').value;
	
	if(table == 'wld_home_page_meta_tags.site_id'){
		eMeetingDo('wld/ajax/_actions.php?action=EditRow&value='+unescapeHTML(value)+'&field='+field+'&id='+id+'&table='+table+'&market_id='+market_id+'&site_id='+site_id,"TableAlert");
	}
	else{
		eMeetingDo('wld/ajax/_actions.php?action=WLDEditRow&value='+unescapeHTML(value)+'&field='+field+'&id='+id+'&table='+table+'&market_id='+market_id+'&site_id='+site_id,"TableAlert");
	}
}
function WLDLoadSitewiseTable(system,startvalue,site_id){
	
	var market_id = document.getElementById("select-market").value;

	if(market_id == "" || market_id == "0"){
		alert("Please select market first.");
		return false;
	}
	var change_sites = false;

	if(document.getElementById('chk-settings_membership')){
		change_sites = document.getElementById('chk-settings_membership').checked;	
	}
	if(system == 'dashboard'){
		WLDGetDashboardFigures(market_id,site_id);			
	}
	else if (system == 'admin_reports') {
		WLDGetAdminReportFigures(market_id,site_id);
	}
	else if(system == 'approve_media' || system == 'members' || system == 'manage_field_groups'  || system == 'payments' || system == 'approve_edit_banners' || system == 'approve_edit_pages'){
	
		Timer_Icon('TableViewer');
		eMeetingDo('wld/ajax/_actions.php?action=LoadMarketTable&system='+system+'&startvalue='+startvalue+'&market_id='+market_id+'&site_id='+site_id+'&change_sites='+change_sites,"TableViewer");

	}
	else if(system == 'settings_search' || system == 'settings_membership' || system == 'settings_membership_packages' || system == 'settings_manage_access' || system == 'settings_email' || system == 'settings_file_paths'  || system == 'settings_thumbnails'){

		Timer_Icon('TableViewer');
		eMeetingDo('wld/ajax/_actions.php?action='+system+'&market_id='+market_id+'&site_id='+site_id+'&change_sites='+change_sites,"TableViewer");

	}
	else if(system == 'site_settings')
	{
		Timer_Icon('SiteSettingViewer');
		eMeetingDo('wld/ajax/_actions.php?action='+system+'&system=site_settings&market_id='+market_id+'&&site_id='+site_id+'&change_sites=' + change_sites,"SiteSettingViewer");
	}
	else{
		
		Timer_Icon('TableViewer');
		eMeetingDo('wld/ajax/_actions.php?action=LoadTable&system='+system+'&startvalue='+startvalue+'&market_id='+market_id+'&site_id='+site_id+'&change_sites='+change_sites,"TableViewer");
	
	}

}

function WLDChangeYesNo(yesNo, id, field){
		
	//if(field == 'files.approved' || field == 'files.adult_content AS Adult' || field == 'files.featured'){
		var market_id = 0;
		if(document.getElementById("select-market")){
			market_id = document.getElementById("select-market").value;
		}
		var table = document.getElementById('HHDeleteValue').value;
		
		Timer_Icon('TableAlert');
		eMeetingDo('wld/ajax/_actions.php?action=ChangeYesNo&id='+id+'&yesno='+yesNo+'&table='+table+'&field='+field+'&market_id='+market_id,"TableAlert");

	/*}	
	else{
		var table = document.getElementById('HHDeleteValue').value;
		Timer_Icon('TableAlert');
		eMeetingDo('wld/ajax/_actions.php?action=ChangeYesNo&id='+id+'&yesno='+yesNo+'&table='+table+'&field='+field,"TableAlert");

	}*/
}

function WLDChangeImage(div, way, id, field){ 
	if(way =="yes"){ 
		document.getElementById(div).innerHTML="<a href='#' onClick=\"WLDChangeYesNo('no','"+id+"','"+field+"'); WLDChangeImage('"+div+"','no','"+id+"','"+field+"'); return false;\"><img src='inc/images/icons/yes.png' align='absmiddle'></a>";
	} else {
		document.getElementById(div).innerHTML="<a href='#' onClick=\"WLDChangeYesNo('yes','"+id+"','"+field+"'); WLDChangeImage('"+div+"','yes','"+id+"','"+field+"'); return false;\"><img src='inc/images/icons/no.png' align='absmiddle'></a>";
	}
}

function eMeetingTableSwitchWld(value, whichOne){

	
 	var System	 	= document.getElementById('HHSystem').value;
	var DefaultValue= document.getElementById('HHDefaultValue').value;		
	var OrderWay 	= document.getElementById('HHOrderWay').value;	
	var SearchField = document.getElementById('HHSearchF').value;


	//alert("System " + System);
	//alert("DefaultValue " + DefaultValue);
	//alert("OrderWay " + OrderWay);
	//alert("SearchField " + SearchField);

	var market_id = 0;
	if(document.getElementById('select-market')){
		market_id = document.getElementById('select-market').value;
	}
	
	var site_id = 0;
	if(document.getElementById('select-site')){
		site_id = document.getElementById('select-site').value;
	}
	 
	if(whichOne ==1){
		var SearchValue = value;
	}else{ 
		var SearchValue = document.getElementById('HHSearch').value;
	}

	if(whichOne ==2){
		var Order = value;
	}else{
		var Order = document.getElementById('HHOrder').value;
	}

	if(whichOne ==3){
		var Start 		= value;
	}else{ 
		var Start 		= document.getElementById('HHStart').value;
	}	

	if(whichOne ==4){
		var RowsPerPage 		= value;
	}else{ 
		var RowsPerPage 		= document.getElementById('HHRows').value;
	}		
 	
	Timer_Icon('TableViewer');
	eMeetingDo('wld/ajax/_actions.php?action=TableOrder&o='+Order+'&s='+Start+'&sw='+OrderWay+'&fv='+SearchValue+'&ff='+SearchField+'&rows='+RowsPerPage+'&system='+System+'&startvalue='+DefaultValue+'&market_id='+market_id+'&site_id='+site_id,"TableViewer");

 	
}

function WLDUpdatePageStatus(val,page_id){
	Timer_Icon('StatusPageUpdate');
	eMeetingDo('wld/ajax/_actions.php?action=pagestatusupdate&page_id='+page_id,"StatusPageUpdate");
}

function WLDShowDesc(divId){
	document.getElementById(divId).style.display = 'block';
}
function WLDHideDesc(divId){
	document.getElementById(divId).style.display = 'none';
}

function eMeetingTableSubmitWld(x){

	var market_id = 0;
	if(document.getElementById('select-market')){
		market_id = document.getElementById('select-market').value;
	}

	var site_id = 0;
	if(document.getElementById('select-site')){
		site_id = document.getElementById('select-site').value;
	}

	var answer = confirm ("Are you sure you want to delete these items?")
	if (answer){
		var table = document.getElementById('HHDeleteValue').value;

		for(var j=1;j<=x;j++){	 
			if(eval("document.profile.d"+j).checked == true){ 
				document.getElementById("tr_"+j).style.display = 'none'; 
				var ID = eval("document.profile.id"+j).value;
				eMeetingDo('wld/ajax/_actions.php?action=DeleteRow&id='+ID+'&table='+table+'&market_id='+market_id+'&site_id='+site_id,"TableAlert");
			}
		}
		return false;
	}


}

function eMeetingSaveDivWld(div, type, value, id){
	
	var market_id = document.getElementById('select-market').value;
	var site_id = document.getElementById('select-site').value;


	Timer_Icon(div);
	eMeetingDo('wld/ajax/_actions.php?action=SaveDiv&id='+id+'&value='+value+'&type='+type+'&div='+div+'&market_id='+market_id+'&site_id='+site_id, div);
}

function eMeetingChangeDivWld(switchMe, div, current, id, field){	

	var slt = document.querySelector("#" + div + " select");
	
	if(slt !== null){		return true;	}	Timer_Icon(div);
	eMeetingDo('wld/ajax/_actions.php?action=ChangeDiv&id='+id+'&current='+current+'&field='+field+'&div='+div+'&switchMe='+switchMe, div);
}

function eMeetingTableBlockWld(x){

var answer = confirm ("Are you sure you want to block these items?")
if (answer){
	var table = document.getElementById('HHDeleteValue').value;

	for(var j=1;j<=x;j++){	 
		if(eval("document.profile.d"+j).checked == true){ 
			document.getElementById("tr_"+j).style.display = 'none'; 
			var ID = eval("document.profile.id"+j).value;
			eMeetingDo('wld/ajax/_actions.php?action=BlockRow&id='+ID+'&table='+table,"TableAlert");
		}
	}
	return false;

}
}



function WLDMpSave(edit_type){
	str1 = edit_type.replace ( /[^\d.]/g, '' );	
	if(str1){
		dataString = $("#frmquestion"+str1).serialize();
		$.ajax({
			type: "POST",
			url: "wld/ajax/_actions.php?action=profileeditquestions",
			data: dataString,
			cache: false,
			success: function(html) {
			 $('#MPEditLabel_essayquestion'+str1).html(html);
			 $('#MPEditLabel_essayquestion'+str1).show();
			 $('#MPEditContainer_essayquestion'+str1).hide();
			 $(".MPEditButton_"+edit_type).show();
			 $(".MPSaveButton_"+edit_type).hide();
			}
		});
	}
}

function WLDMpSaveOkQuestion(edit_type){
		
	dataString = $("#okquestion"+edit_type).serialize();
	$.ajax({
		type: "POST",
		url: "wld/ajax/_actions.php?action=okquestions",
		data: dataString,
		cache: false,
		success: function(html) {
		 //alert("Updated sucessfully!!!");
		}
	});

}

function WLDMpSaveProfileInfo(edit_type){
		
	dataString = $("#frmprofileinfo").serialize();
	$.ajax({
		type: "POST",
		url: "wld/ajax/_actions.php?action=editprofileinfo",
		data: dataString,
		cache: false,
		success: function(html) {
		 $("#successprofile").show();
		 setTimeout(function() { $("#successprofile").fadeOut(1500); }, 2000)
		}
	});
}




function WLDMpSaveBasicProfileInfo(edit_type){
	

	var market_id = document.getElementById('select-market').value;	
	$('textarea.ckeditor').each(function () {
	   var $textarea = $(this);
	   $textarea.val(CKEDITOR.instances[$textarea.attr('name')].getData());
	});
	//var dataString = new FormData($("#frmBasicProfileInfo_" + edit_type)[0]);
	var dataString = $("#frmBasicProfileInfo_" + edit_type).serialize();
	
	$.ajax({
		type: "POST",
		url: "wld/ajax/_actions.php?action=editbasicprofileinfo&market_id="+market_id,
		data: dataString,
		cache: false,
		success: function(html) {
			//alert(html);
		 $("#basicinfo").show();
		 setTimeout(function() { $("#basicinfo").fadeOut(1500); 
		 
		 $('#MPEditLabel_'+edit_type).show();
		 $('#MPEditContainer_'+edit_type).hide();
		 $(".MPEditButton_"+edit_type).show();
		 $(".MPSaveButton_"+edit_type).hide();
		 
		 }, 2000)
		 
		}
	});

}
	
	
function WLDMpSaveMyLocation(edit_type){
	
	var market_id = document.getElementById("select-market").value;

	dataString = $("#frmmylocation").serialize();
	$.ajax({
		type: "POST",
		url: "wld/ajax/_actions.php?action=editmylocation&market_id="+market_id,
		data: dataString,
		cache: false,
		success: function(html) {
			 $("#mylocation").show();
			 setTimeout(function() { $("#mylocation").fadeOut(1500); 
			 
			 $('#MPEditLabel_'+edit_type).show();
			 $('#MPEditContainer_'+edit_type).hide();
			 $(".MPEditButton_"+edit_type).show();
			 $(".MPSaveButton_"+edit_type).hide();
			 
		 }, 2000)
		 
		}
	});
}
	
function WLDMpTagSave(edit_type){
	
	var market_id=0;
	if(document.getElementById('select-market')){
		market_id = document.getElementById('select-market').value;
	}
	dataString = $("#frmtagline").serialize();
	$.ajax({
		type: "POST",
		url: "wld/ajax/_actions.php?action=edittagline&market_id="+market_id,
		data: dataString,
		cache: false,
		success: function(html) {
		 $('#MPEditLabel_'+edit_type).html(html);
		 $('#MPEditLabel_'+edit_type).show();
		 $('#MPEditContainer_'+edit_type).hide();
		 $(".MPEditButton_"+edit_type).show();
		 $(".MPSaveButton_"+edit_type).hide();
		}
	});
}
	

function WLDMpEdit(edit_type){

	$("#MPEditLabel_"+edit_type).hide();
	$("#MPEditContainer_"+edit_type).show();
	$(".MPEditButton_"+edit_type).hide();
	$(".MPSaveButton_"+edit_type).show();
	$(".MPCancelButton_"+edit_type).show();

}

function WLDMpCancel(edit_type){
	
	$("#MPEditLabel_"+edit_type).show();
	$("#MPEditContainer_"+edit_type).hide();
	$(".MPEditButton_"+edit_type).show();
	$(".MPSaveButton_"+edit_type).hide();
	$(".MPCancelButton_"+edit_type).hide();

}

function WLDDeleteProfilePic(){
	
	var market_id = document.getElementById("select-market").value;

	dataString = $("#fromprofilepicDelete").serialize();
	$.ajax({
		type: "POST",
		url: "wld/ajax/_actions.php?action=deleteprofilepic&market_id="+market_id,
		data: dataString,
		cache: false,
		success: function(html) {
			alert(html);
			location.reload();
		}
	});	
}

function WLDUploadProfilePhoto()
{
	var market_id = document.getElementById("select-market").value;

	$.ajax({
		type: "POST",
		url: "wld/ajax/_actions.php?action=uploadprofilepic&market_id="+market_id,
		data: new FormData($('#frmProfilepicUpload')[0]),
		contentType: false,
		cache: false,
		processData: false,
		success: function(html) {
			alert(html);
		 	location.reload();
		}
	});
		
}

function WLDChangeMemberYesNo(yesNo, id, field){
	
	var market_id=0;
	if(document.getElementById('select-market')){
		market_id = document.getElementById('select-market').value;
	}
	var table = 'members.id';
		
	eMeetingDo('wld/ajax/_actions.php?action=ChangeYesNo&id='+id+'&yesno='+yesNo+'&table='+table+'&field='+field+'&market_id='+market_id,"TableAlert");
}

function WLDUpdateFieldPage(value, fieldid, div, type){
 
	var market_id = document.getElementById('select-market').value;
	Timer_Icon(div);
	eMeetingDo('wld/ajax/_actions.php?action=fieldtypepage&id='+fieldid+'&value='+value+'&type='+type+'&div='+div+'&market_id='+market_id ,div);

}

function WLDUpdateFieldOrderBit(order, fieldid){
 	
	var market_id = document.getElementById('select-market').value;
 	Timer_Icon('response_fieldupdate');
	eMeetingDo('wld/ajax/_actions.php?action=fieldorderpage&id='+fieldid+'&value='+order+'&market_id='+market_id,"response_fieldupdate");
}

function WLDChangeOption2(Page) {
	document.getElementById('do2').value=''+Page+'';
	document.profile2.submit();
}

function WLDNewpopUpWin(URL) {
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open('wld/crop/crop.php?f='+URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=500,height=500,left = 490,top = 200');");
}