/***************************************************************************
 *
 *	 PROJECT: iCupid Dating Software
 *	 VERSION: 9
 *	 LISENSE: OWN / LEASED (http://www.advandate.com)
 *
 *	 This program is a commercial software product and any kind of usage
 *	 means agreement to the eMeeting software License Agreement.
 *
 *	 This notice MUST NOT be removed from the code.   
 *
 *   Copyright 2008-2009 AdvanDate, Ltd.
 *   http://www.advandate.com/
 *
 ***************************************************************************/
function AjaxRequest()
{
	this.mRequest = this.getHttpRequest();
	this.mHandlers = new Array();
	var self = this;
	
	this.mRequest.onreadystatechange = function()
	{
		if(	self.mHandlers[ self.mRequest.readyState ] != undefined )
		{
			for( i = 0 ; i < self.mHandlers[ self.mRequest.readyState ].length ; i++ )
			{
				self.mHandlers[ self.mRequest.readyState ][ i ]( self );				
			}
		}
	}
}

AjaxRequest.prototype.addEventListener = function( pEventType, pFunction )
{
	if(	this.mHandlers[ pEventType ] == undefined )
	{
		this.mHandlers[ pEventType ] = new Array();
	}
	
	this.mHandlers[ pEventType ].push( pFunction );
}

AjaxRequest.prototype.getHttpRequest = function()
{
	// List of Microsoft XMLHTTP versions - newest first

	var MSXML_XMLHTTP_PROGIDS = new Array
	(
		'MSXML2.XMLHTTP.5.0',
		'MSXML2.XMLHTTP.4.0',
		'MSXML2.XMLHTTP.3.0',
		'MSXML2.XMLHTTP',
		'Microsoft.XMLHTTP'
	);

	// Do we support the request natively (eg, Mozilla, Opera, Safari, Konqueror)

	if( window.XMLHttpRequest != null )
	{
		return new XMLHttpRequest();
	}
	else
	{
		// Look for a supported IE version

		for( i = 0 ; MSXML_XMLHTTP_PROGIDS.length > i ; i++ )
		{
			try
			{
				return new ActiveXObject( MSXML_XMLHTTP_PROGIDS[ i ] );
			}
			catch( e )
			{
			}
		}
	}
	
	return( null );
}

/**
* Info: Globals Functions
*
* @version  9.0
* @created  Fri Sep 18 10:48:31 EEST 2008
* @updated  Fri Sep 18 10:48:31 EEST 2008
*/

function toggleLayer( whichLayer )
{
  var elem, vis;
  if( document.getElementById ) 
    elem = document.getElementById( whichLayer );
  else if( document.all ) 
      elem = document.all[whichLayer];
  else if( document.layers ) 
    elem = document.layers[whichLayer];
  vis = elem.style;

  if(vis.display==''&&elem.offsetWidth!=undefined&&elem.offsetHeight!=undefined)    vis.display = (elem.offsetWidth!=0&&elem.offsetHeight!=0)?'block':'none';  vis.display = (vis.display==''||vis.display=='block')?'none':'block';
}
 
/**
* Info: eMeeting Load Ajax Calls
*
* @version  9.0
* @created  Fri Sep 18 10:48:31 EEST 2008
* @updated  Fri Sep 18 10:48:31 EEST 2008
*/
function eMeetingDo( fileName, div )
{
	var Ajax = new AjaxRequest();

	if( Ajax.mRequest )
	{				
		Ajax.mFileName 	= fileName;		
		var obj = document.getElementById(div);				

		Ajax.mRequest.open( "GET", fileName);
		Ajax.mRequest.onreadystatechange = function() {
			if(Ajax.mRequest.readyState == 4 && Ajax.mRequest.status == 200){
				obj.innerHTML = Ajax.mRequest.responseText;
			}
		}		
	}
	Ajax.mRequest.send( null );
}

function Timer_Icon(divlayer){
	window.document.getElementById(divlayer).innerHTML='<img src="inc/images/loading.gif">';
}
/**
* Info: eMeeting Delete Network Friends
*
* @version  9.0
*/

function eMeetingLinkedField(value, linkedID, searchPage){

	Timer_Icon('Link'+linkedID);
	eMeetingDo('../inc/ajax/_actions.php?action=PopLinkedField&lid='+linkedID+'&value='+value+'&rownum='+searchPage,'Link'+linkedID);
}


function eMeetingDeleteRegBgImage(){

	var conf = confirm("Do you really want to delete background image?");
	if(conf){
		Timer_Icon("del-image-result");
		eMeetingDo('inc/ajax/_actions.php?action=DelBgregImage&','del-image-result');
	}
}


function unescapeHTML(html) {
 	var string;
	string = html;
	string = string.replace("&amp;", escape("&"));
	return string;
}
function LoadReportTable(system,startvalue){
	Timer_Icon('TableViewer');
	eMeetingDo('inc/ajax/_actions.php?action=LoadReportTable&system='+system+'&startvalue='+startvalue,"TableViewer");
}
function LoadTable(system,startvalue){
	Timer_Icon('TableViewer');
	eMeetingDo('inc/ajax/_actions.php?action=LoadTable&system='+system+'&startvalue='+startvalue,"TableViewer");
}
function ChangeYesNo(yesNo, id, field){
	
	var table = document.getElementById('HHDeleteValue').value;
	Timer_Icon('TableAlert');
	eMeetingDo('inc/ajax/_actions.php?action=ChangeYesNo&id='+id+'&yesno='+yesNo+'&table='+table+'&field='+field,"TableAlert");
}
function ChangeMemberYesNo(yesNo, id, field){
	
	var table = 'members.id';
	
	eMeetingDo('inc/ajax/_actions.php?action=ChangeYesNo&id='+id+'&yesno='+yesNo+'&table='+table+'&field='+field,"TableAlert");
}
function eMeetingShowLinkList(fid, div){

	Timer_Icon(div);
	eMeetingDo('inc/ajax/_actions.php?action=ShowLinkedList&fid='+fid+'&div='+div,div);

}
function eMeetingSaveLinkedField(value, fid,div){
	Timer_Icon(div);
	eMeetingDo('inc/ajax/_actions.php?action=SaveLinkedList&fid='+fid+'&value='+value ,div);
}
function eMeetingSaveLinkedListID(value, id){

	var table 	= document.getElementById('HHDeleteValue').value;

	Timer_Icon('TableAlert');
	eMeetingDo('inc/ajax/_actions.php?action=SaveLinkedListID&table='+table+'&id='+id+'&value='+value,"TableAlert");

}
function eMeetingSaveListOrder(save){

	var table 		= document.getElementById('HHDeleteValue').value;
 	var System	 	= document.getElementById('HHSystem').value;
	var DefaultValue = document.getElementById('HHDefaultValue').value;		
	var OrderWay 	= document.getElementById('HHOrderWay').value;	
	var Order 		= document.getElementById('HHOrder').value;
	var Start 		= document.getElementById('HHStart').value;

	Timer_Icon('TableAlert');
	eMeetingDo('inc/ajax/_actions.php?action=SaveTableOrder&o='+Order+'&save='+save+'&s='+Start+'&table='+table+'&sw='+OrderWay+'&system='+System+'&startvalue='+DefaultValue,"TableAlert");


}

function eMeetingAdminClassCats(value, div, def){
 
	Timer_Icon(div);
	eMeetingDo('inc/ajax/_actions.php?action=PopClassSubCats&value='+value+'&def='+def,div);
}
function ChangeImage(div, way, id, field){ 
	if(way =="yes"){ 
	document.getElementById(div).innerHTML="<a href='#' onClick=\"ChangeYesNo('no','"+id+"','"+field+"'); ChangeImage('"+div+"','no','"+id+"','"+field+"'); return false;\"><img src='inc/images/icons/yes.png' align='absmiddle'></a>";
	} else {
	document.getElementById(div).innerHTML="<a href='#' onClick=\"ChangeYesNo('yes','"+id+"','"+field+"'); ChangeImage('"+div+"','yes','"+id+"','"+field+"'); return false;\"><img src='inc/images/icons/no.png' align='absmiddle'></a>";
	}
}
function eMeetingChangeLang(div, current, id, field){	 
	Timer_Icon(div);
	eMeetingDo('inc/ajax/_actions.php?action=ChangeLang&id='+id+'&current='+current+'&field='+field+'&div='+div, div);
}
function SaveLang(value,div,id,field){

	var table = document.getElementById('HHDeleteValue').value;

	Timer_Icon(div);
	eMeetingDo('inc/ajax/_actions.php?action=SaveLang&id='+id+'&value='+value+'&table='+table+'&field='+field, div);
}
function eMeetingSaveDiv(div, type, value, id){
	Timer_Icon(div);
	eMeetingDo('inc/ajax/_actions.php?action=SaveDiv&id='+id+'&value='+value+'&type='+type+'&div='+div, div);
}

function eMeetingChangeDiv(switchMe, div, current, id, field){	var slt = document.querySelector("#" + div + " select");
	if(slt !== null){		return true;	}	Timer_Icon(div);
	eMeetingDo('inc/ajax/_actions.php?action=ChangeDiv&id='+id+'&current='+current+'&field='+field+'&div='+div+'&switchMe='+switchMe, div);
}

function eMeetingChangeInput(switchMe, div, current, id, field){
	var slt = document.querySelector("#" + div + " select");
	
	if(slt !== null){
		return true;
	}

	Timer_Icon(div);
	eMeetingDo('inc/ajax/_actions.php?action=ChangeInput&id='+id+'&current='+current+'&field='+field+'&div='+div+'&switchMe='+switchMe, div);

}

function eMeetingChangeWay(){

	if(document.getElementById('HHOrderWay').value =="DESC"){
		document.getElementById('HHOrderWay').value ="ASC";
	} else {
		document.getElementById('HHOrderWay').value ="DESC";
	}
}
function eMeetingEditField(value, id, field){

var table = document.getElementById('HHDeleteValue').value;
 
eMeetingDo('inc/ajax/_actions.php?action=EditRow&value='+unescapeHTML(value)+'&field='+field+'&id='+id+'&table='+table,"TableAlert")
}
function eMeetingTableSubmit(x){

var answer = confirm ("Are you sure you want to delete these items?")
if (answer){
	var table = document.getElementById('HHDeleteValue').value;

	for(var j=1;j<=x;j++){	 
		if(eval("document.profile.d"+j).checked == true){ 
			document.getElementById("tr_"+j).style.display = 'none'; 
			var ID = eval("document.profile.id"+j).value;
			eMeetingDo('inc/ajax/_actions.php?action=DeleteRow&id='+ID+'&table='+table,"TableAlert");
		}
	}
	return false;

}

}


function eMeetingTableBlock(x){

var answer = confirm ("Are you sure you want to block these items?")
if (answer){
	var table = document.getElementById('HHDeleteValue').value;

	for(var j=1;j<=x;j++){	 
		if(eval("document.profile.d"+j).checked == true){ 
			document.getElementById("tr_"+j).style.display = 'none'; 
			var ID = eval("document.profile.id"+j).value;
			eMeetingDo('inc/ajax/_actions.php?action=BlockRow&id='+ID+'&table='+table,"TableAlert");
		}
	}
	return false;

}

}

function eMeetingTableReport(x){



	var table = document.getElementById('HHDeleteValue').value;

	for(var j=1;j<=x;j++){	 
		if(eval("document.profile.d"+j).checked == true){ 
			document.getElementById("tr_"+j).style.display = 'none'; 
			var ID = eval("document.profile.id"+j).value;
			eMeetingDo('inc/ajax/_actions.php?action=AcceptReportRow&id='+ID+'&table='+table,"TableAlert");
		}
	}
	return false;



}

function eMeetingIpWhoisBlock(x){

var answer = confirm ("Are you sure you want to block these member?")
if (answer){
	
	
	//document.getElementById("tr_"+j).style.display = 'none'; 
	var ID = x;
	
	window.opener.location.reload();

	eMeetingDo('inc/ajax/_actions.php?action=BlockRow&id='+ID,"TableAlert");
	

	return false;

}

}


function eMeetingTableSwitch(value, whichOne){

	
 	var System	 	= document.getElementById('HHSystem').value;
	var DefaultValue= document.getElementById('HHDefaultValue').value;		
	var OrderWay 	= document.getElementById('HHOrderWay').value;	
	var SearchField = document.getElementById('HHSearchF').value;
 
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
	eMeetingDo('inc/ajax/_actions.php?action=TableOrder&o='+Order+'&s='+Start+'&sw='+OrderWay+'&fv='+SearchValue+'&ff='+SearchField+'&rows='+RowsPerPage+'&system='+System+'&startvalue='+DefaultValue,"TableViewer");
}
 




function LinkedList(current, div){

	Timer_Icon(div);
	eMeetingDo('inc/ajax/_actions.php?action=DisplayLinkedList&c='+current,div);
}


/// ADMIN SEARCH
function GetEventfulSearch(keyword){
	Timer_Icon('EventfulSearchData');
	eMeetingDo('inc/ajax/_actions.php?action=calrsssearch&keyword='+keyword,"EventfulSearchData");
}
/// ADMIN THEME EDITOR
function populate_menulist(mid,type){
	Timer_Icon('ThemeListBox');
	eMeetingDo('inc/ajax/_actions.php?action=update_list&mid='+mid+'&tid='+type,"ThemeListBox");
}
function UpdateTmpPreview(pid){
	Timer_Icon('response_previewTemp');
	eMeetingDo('inc/ajax/_actions.php?action=show_preview&pid='+pid,"response_previewTemp");
	eMeetingDo('inc/ajax/_actions.php?action=show_previewDesc&pid='+pid,"response_previewTempDesc");
}
/// ADMIN THEME EDITOR
function populate_emaillist(mid,type){
	Timer_Icon('ThemeListBox');
	eMeetingDo('inc/ajax/_actions.php?action=update_emaillist&mid='+mid+'&tid='+type,"ThemeListBox");
}
function UpdateEmailPreview(pid){

	Timer_Icon('response_previewTempDesc');
	eMeetingDo('inc/ajax/_actions.php?action=show_emailpreview&id='+pid,"response_previewTempDesc");
}

function UpdateFieldOrderBit(order, fieldid){
 
	Timer_Icon('response_fieldupdate');
	eMeetingDo('inc/ajax/_actions.php?action=fieldorderpage&id='+fieldid+'&value='+order,"response_fieldupdate");
}

function UpdateCompatibilityFieldOrderBit(order, fieldid){
 
	Timer_Icon('response_fieldupdate');
	eMeetingDo('inc/ajax/_actions.php?action=compatibilityfieldorderpage&id='+fieldid+'&value='+order,"response_fieldupdate");
}
function UpdateCompatibilityFieldWeightBit(value, fieldid){
 
	Timer_Icon('response_fieldupdate');
	eMeetingDo('inc/ajax/_actions.php?action=compatibilityfieldweightpage&id='+fieldid+'&value='+value,"response_fieldupdate");
}

function UpdateCompatibilityFieldRatetype(value, fieldid){
 
	Timer_Icon('response_fieldupdate');
	eMeetingDo('inc/ajax/_actions.php?action=compatibilityfieldratepage&id='+fieldid+'&value='+value,"response_fieldupdate");
}

function UpdateFieldPage(value, fieldid, div, type){
 
	Timer_Icon(div);
	eMeetingDo('inc/ajax/_actions.php?action=fieldtypepage&id='+fieldid+'&value='+value+'&type='+type+'&div='+div ,div);
}


function MPSave(edit_type){
	str1 = edit_type.replace ( /[^\d.]/g, '' );	
	if(str1){
		dataString = $("#frmquestion"+str1).serialize();
		$.ajax({
			type: "POST",
			url: "inc/ajax/_actions.php?action=profileeditquestions",
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

function MpSaveOkQuestion(edit_type){
		
		dataString = $("#okquestion"+edit_type).serialize();
		$.ajax({
			type: "POST",
			url: "inc/ajax/_actions.php?action=okquestions",
			data: dataString,
			cache: false,
			success: function(html) {
			 //alert("Updated sucessfully!!!");
			}
			});
	}

function MpSaveProfileInfo(edit_type){
		
		dataString = $("#frmprofileinfo").serialize();
		$.ajax({
			type: "POST",
			url: "inc/ajax/_actions.php?action=editprofileinfo",
			data: dataString,
			cache: false,
			success: function(html) {
			 $("#successprofile").show();
			 setTimeout(function() { $("#successprofile").fadeOut(1500); }, 2000)
			}
			});
}




function MpSaveBasicProfileInfo(edit_type){
		
		$('textarea.ckeditor').each(function () {
		   var $textarea = $(this);
		   $textarea.val(CKEDITOR.instances[$textarea.attr('name')].getData());
		});
		//var dataString = new FormData($("#frmBasicProfileInfo_" + edit_type)[0]);
		var dataString = $("#frmBasicProfileInfo_" + edit_type).serialize();
		
		//alert(dataString);

		$.ajax({
			type: "POST",
			url: "inc/ajax/_actions.php?action=editbasicprofileinfo",
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
	
	
	function MpSaveMyLocation(edit_type){
		
		dataString = $("#frmmylocation").serialize();
		$.ajax({
			type: "POST",
			url: "inc/ajax/_actions.php?action=editmylocation",
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
	
function MPTagSave(edit_type){
	
		dataString = $("#frmtagline").serialize();
		$.ajax({
			type: "POST",
			url: "inc/ajax/_actions.php?action=edittagline",
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
	

function MPEdit(edit_type)
	{
	$("#MPEditLabel_"+edit_type).hide();
	$("#MPEditContainer_"+edit_type).show();
	$(".MPEditButton_"+edit_type).hide();
	$(".MPSaveButton_"+edit_type).show();
	$(".MPCancelButton_"+edit_type).show();
	}

function MPCancel(edit_type)
	{
	$("#MPEditLabel_"+edit_type).show();
	$("#MPEditContainer_"+edit_type).hide();
	$(".MPEditButton_"+edit_type).show();
	$(".MPSaveButton_"+edit_type).hide();
	$(".MPCancelButton_"+edit_type).hide();
	}

function DeleteProfilePic(){
	dataString = $("#fromprofilepicDelete").serialize();
		$.ajax({
			type: "POST",
			url: "inc/ajax/_actions.php?action=deleteprofilepic",
			data: dataString,
			cache: false,
			success: function(html) {
			 alert(html);
			 location.reload();
			}
			});	
}

function uploadProfilePhoto()
{
		
	$.ajax({
		type: "POST",
		url: "inc/ajax/_actions.php?action=uploadprofilepic",
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

	
function HideOneShowTwo(ONE, TWO){
	$("#"+ONE).hide();
	$("#"+TWO).show();
}

function delArticleImage(id){
	var conf = confirm("Do you really want to delete this image?");
	if(conf){
		Timer_Icon("del-article-image");
		eMeetingDo('inc/ajax/_actions.php?action=DelArticleImage&article_id='+id,'del-article-image');
	}
}

function LoadArticles(status){
	Timer_Icon('TableViewer');
	eMeetingDo('inc/ajax/_actions.php?action=LoadTable&system=articles&sub='+status+'&startvalue=0',"TableViewer");
}

