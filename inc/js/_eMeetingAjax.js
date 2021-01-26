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

function unescapeHTML1(html) {

 	var string;

	string = html;

	string = string.replace("&", escape("&"));
	string = string.replace("&", "&amp;");
 
	return string;

}

function ChangeLiveStatus(uid){
eMeetingDo('../../../inc/ajax/_actions.php?action=ChangeIMLive&uid='+uid,"p2_span");
	
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

function RejectIM(uid){

	Timer_Icon('eMeeting_Alert_Span');
	//document.getElementById("div_"+id).style.background = 'white';
	eMeetingDo('inc/ajax/_actions.php?action=RejectIM&uid='+uid,"eMeeting_Alert_Span");
}

/**
* Info: eMeeting Delete Network Friends
*
* @version  9.0
*/


function ChangeRelationship(div, id1, id2, spandiv){
 
	Timer_Icon(div);
	eMeetingDo('inc/ajax/_actions.php?action=ChangeRelationship&id1='+id1+'&id2='+id2+'&spandiv='+spandiv,div);
}



function ChangeRelationshipDiv(new1, old1, uid, spandiv){ 
	//alert("newId="+new1+" old="+old1+" uid="+uid+" spandiv="+spandiv+"");
 
	document.getElementById('SearchAlert').style.display='block'; 
	new Effect.Fade(spandiv);
	
	eMeetingDo('inc/ajax/_actions.php?action=UpdateRelationship&nid='+new1+'&olid='+old1+"&muid="+uid,'SearchAlert');
	//alert('/inc/ajax/_actions.php?action=ChangeRelationshipList','RelationshipChange');
	//eMeetingDo('/inc/ajax/_actions.php?action=UpdateRelationshipCount&newolidd='+old1,'Results');
	//eMeetingDo('/inc/ajax/_actions.php?action=ChangeRelationshipList','RelationshipChange');
}



/*function ChangeRelationshipTotalResults(new1, old1, uid, spandiv){ 
	//alert("newId="+new1+" old="+old1+" uid="+uid+" spandiv="+spandiv+"");
 
	document.getElementById('SearchAlert').style.display='block'; 
	new Effect.Fade(spandiv);
	eMeetingDo('inc/ajax/_actions.php?action=UpdateRelationshipCount&nid='+new1+'&olid='+old1+"&muid="+uid,'Results');
}*/

function eMeetingGenderChange(id){
 
	Timer_Icon('GenderChanger');
	eMeetingDo('inc/ajax/_actions.php?action=GenderChanger&id='+id,"GenderChanger");
}
function DeleteSavePage(id) {

	Timer_Icon('eMeeting_Alert_Span');
	//document.getElementById("div_"+id).style.background = 'white';
	eMeetingDo('inc/ajax/_actions.php?action=DeleteSaveSearch&id='+id,"eMeeting_Alert_Span");

}
function AdminLiveApprove(id, page, subpage){
	Timer_Icon('eMeeting_Alert_Span');
	//document.getElementById("div_"+id).style.background = 'white';
	eMeetingDo('inc/ajax/_actions.php?action=ModLiveApprove&id='+id+'&page='+page+'&subpage='+subpage,"eMeeting_Alert_Span");
}
function AdminLiveFeatured(id, page, subpage){
	Timer_Icon('eMeeting_Alert_Span');
	document.getElementById("div_"+id).style.background = 'yellow';
	eMeetingDo('inc/ajax/_actions.php?action=ModLiveFeatured&id='+id+'&page='+page+'&subpage='+subpage,"eMeeting_Alert_Span");
}
function AdminLiveRFeatured(id, page, subpage){
	Timer_Icon('eMeeting_Alert_Span');
	document.getElementById("div_"+id).style.background = 'blue';
	eMeetingDo('inc/ajax/_actions.php?action=ModLiveRemoveFeatured&id='+id+'&page='+page+'&subpage='+subpage,"eMeeting_Alert_Span");
}
function AdminLiveDelete(id, page, subpage){
	Timer_Icon('eMeeting_Alert_Span');
	eMeetingDo('inc/ajax/_actions.php?action=ModLiveDelete&id='+id+'&page='+page+'&subpage='+subpage,"eMeeting_Alert_Span");
}
/**
* Info: eMeeting Delete Network Friends
*
* @version  9.0
*/
function DeleteGreetings(){
	Timer_Icon('VideoDelete');
	eMeetingDo('inc/ajax/_actions.php?action=VideoDelete',"VideoDelete");
}
function DeleteNetwork(userid, netid){
	Timer_Icon('response_search');
	document.getElementById('SearchAlert').style.display='block'; 
	eMeetingDo('../inc/ajax/_actions.php?action=DeleteNetwork&uid='+userid+'&netid='+netid,"response_search");
}
function ApproveNetwork(userid, netid){
	Timer_Icon('response_search');
	eMeetingDo('inc/ajax/_actions.php?action=ApproveNetwork&uid='+userid+'&netid='+netid,"response_search");
}

/**
* Info: eMeeting Comments Ajax Commands
*
* @version  9.0
*/
function eMeetingOnlineStatus(status){
	Timer_Icon('eMeeting_Alert_Span');
	eMeetingDo('/inc/ajax/_actions.php?action=ChangeOnlineStatus&status='+status,"eMeeting_Alert_Span");

}

function eMeetingMyStatus(msg){
 	Timer_Icon('eMeeting_Alert_Span');
	eMeetingDo('inc/ajax/_actions.php?action=ChangeStatusMsg&msg='+msg,"eMeeting_Alert_Span");
}


function ApproveCommentsPost(page, val1, subpage){

	Timer_Icon('response_eMeetingCommentsDelete');
	eMeetingDo('inc/ajax/_actions.php?action=eMeetingCommentsApprove&id='+val1,"response_eMeetingCommentsDelete");
}

function eMeetingComments( comment, page, val1, val2, img, width, subpage, val3, val4, error ){
 

	if( 
		(document.getElementById('ThisComment').value =="")
	){
		alert(error);
		return false;
	}
 
	try{
	new Effect.Fade('eMeetingCommentsBox');
	}
	catch(err){
		console.log("eMeetingComment Ajax Mod : " + err.message);
	}
	Timer_Icon('response_eMeetingComments');

	var NewComment = unescapeHTML1(comment);	 
	NewComment = encodeURI(NewComment);
	alert("NewComment " + NewComment);
	/*alert("page " + page);
	alert("id1 " + val1);
	alert("id2 " + val2);
	alert("id3 " + val3);
	alert("id4 " + val4);
	alert("img " + img);
	alert("width " + width);
	alert("sub " + subpage);
	alert("NewComment " + NewComment);*/
	eMeetingDo("inc/ajax/_actions.php?action=eMeetingCommentsAjax&comment="+NewComment+"&p="+page+"&id1="+val1+"&id2="+val2+"&id3="+val3+"&id4="+val4+"&img="+img+"&width="+width+"&sub="+subpage,"response_eMeetingComments");
}
function eMeetingCommentsDelete(page, val1, subpage){

	Timer_Icon('response_eMeetingCommentsDelete');
	eMeetingDo('inc/ajax/_actions.php?action=eMeetingCommentsDeleteAjax&p='+page+'&id1='+val1+'&sub='+subpage,"response_eMeetingCommentsDelete");
}
// PROFILE GALLERY PASSWORD
function CheckAlbumPassword(aid,pid){

	var pass = prompt("This album is password protected, please enter the password to continue.", "")
	Timer_Icon('response_gallery');
	eMeetingDo('inc/ajax/_actions.php?action=CheckAlbumPassword&aid='+aid+'&password='+pass+'&pid='+pid, "response_gallery");
	
}
/// OVERVIEW PAGE
function Acc_SendMessage(uid,msg){
	Timer_Icon('eMeeting_Alert_Span');
	eMeetingDo('inc/ajax/_actions.php?action=QuickMessage&uid='+uid+'&message='+msg, "eMeeting_Alert_Span");
}
function Acc_ChangePreviewPhotoDisplay(){
	Timer_Icon_parent('PhotoContainer');
	eMeetingDo('../../../inc/ajax/_actions.php?action=ChangePreviewPhotoDisplay', "PhotoContainer");
}
function Acc_ChangePreviewPhoto(fid,divid){
	Timer_Icon('form_preview_image');
	document.getElementById(divid).value=fid;
	eMeetingDo('inc/ajax/_actions.php?action=ChangePreviewPhoto&fid='+fid, "form_preview_image");
}
/// OVERVIEW PAGE
function Over_ChangeDefaultPhoto(fid,uid){

	Timer_Icon('ShowDefaultPhoto1');	 
	eMeetingDo('inc/ajax/_actions.php?action=overmakedefault&fid='+fid+'&uid='+uid, "ShowDefaultPhoto1");
}
function ChangeDefaultMusic(fid, whichway){
 
	Timer_Icon('response_music');
	eMeetingDo('inc/ajax/_actions.php?action=MakeDefaultMusic&fid='+fid+'&whichway='+whichway, "response_music");
}

// CLASS ADS PAGE
function DeleteClassAd(id,divid){
	Timer_Icon('response_class');
	new Effect.Fade(''+divid+'');
	eMeetingDo('inc/ajax/_actions.php?action=ClassAdDelete&id='+id, 'response_class');
}
///
function ChangeLinkedBox(linked_id,name,linked_with_id){
	Timer_Icon("linked_"+linked_id);
	eMeetingDo('../inc/ajax/_actions.php?action=linked_box&fid='+name+'&lid='+linked_id,"linked_"+linked_id);
}

/////////////////////////////////////////////
///////// WEBSITE GROUP FUNCTIONS //////////////
function delete_group(gid){
	Timer_Icon('response_group');
	eMeetingDo('inc/ajax/_actions.php?action=delete_group&gid='+gid,"response_group");
}
function delete_topic(gid){
	Timer_Icon('response_group');
	eMeetingDo('inc/ajax/_actions.php?action=delete_group_topic&gid='+gid,"response_group");
}

/////////////////////////////////////////////
///////// ADMIN AREA FUNCTIONS //////////////
function admin_approve_file(fid){
	Timer_Icon('response_event');
	eMeetingDo('../inc/ajax/_actions.php?action=Admin_Approve_File&fid='+fid,"response_event");
}
function admin_reject_file(fid){
	Timer_Icon('response_event');
	eMeetingDo('../inc/ajax/_actions.php?action=Admin_Delete_File&fid='+fid,"response_event");
}

/////////////////////////////////////////////
function UpdateEvent(uid, eid){
	Timer_Icon('response_event');
	eMeetingDo('inc/ajax/_actions.php?action=UpdateEvent&eid='+eid+'&uid='+uid,"response_event");
}
////////////////////////////////////////
function Acc_ListenNow(fid){
	Timer_Icon('music_listen');
	eMeetingDo('inc/ajax/_actions.php?action=ChangeListenNow&fid='+fid, "music_listen");
}
function Timer_Icon(divlayer){
	if(window.document.getElementById(divlayer))
	{
		window.document.getElementById(divlayer).innerHTML='<img src="./images/DEFAULT/load_red.gif" width="16" height="16">';
	}
	if(divlayer == 'eMeeting_Alert_Span'){
		document.getElementById('eMeeting_Alert_Div').style.display = 'block';
	}
}
function Timer_Icon_parent(divlayer){
	window.opener.document.getElementById(divlayer).innerHTML='<img src="./images/DEFAULT/load_red.gif" width="16" height="16">';
}

//////////////////////////////////////// RATING
function AddGroupRating(rate,cid){
	Timer_Icon('responce_rating');
	new Effect.Fade('FileRatingStars');
	eMeetingDo('/inc/ajax/_actions.php?action=grouprate&rating='+rate+'&cid='+cid,"responce_rating");
}
function AddRating(rate, pid, fid){
	Timer_Icon('responce_rating');
	new Effect.Fade('FileRatingStars');
	eMeetingDo('inc/ajax/_actions.php?action=profilerate&rating='+rate+'&pid='+pid+'&fid='+fid,"responce_rating");
}
function AddCalRating(rate,cid){
	Timer_Icon('responce_rating');
	new Effect.Fade('FileRatingStars');
	eMeetingDo('inc/ajax/_actions.php?action=calrate&rating='+rate+'&cid='+cid,"responce_rating");
}
function AddGameRating(rate,cid){
	Timer_Icon('responce_rating');
	new Effect.Fade('FileRatingStars');
	eMeetingDo('inc/ajax/_actions.php?action=gamerate&rating='+rate+'&cid='+cid,"responce_rating");
}
function AddClassRating(rate,cid){
Timer_Icon('responce_rating');
new Effect.Fade('FileRatingStars');
eMeetingDo('inc/ajax/_actions.php?action=classrate&rating='+rate+'&cid='+cid,"responce_rating");
}

function SearchSendWink(id,username,winkmsg){
	Timer_Icon('eMeeting_Alert_Span');
	eMeetingDo('inc/ajax/_actions.php?action=SendWink&id='+id+'&username='+username+'&winkmsg='+winkmsg,"eMeeting_Alert_Span");
}
function ProfileSendWink(id){
	Timer_Icon('profile_responce_span');
	eMeetingDo('inc/ajax/_actions.php?action=SendWink&id='+id,"profile_responce_span");
}
function ProfileAddNet(id, netid){
	Timer_Icon('profile_responce_span');
	eMeetingDo('inc/ajax/_actions.php?action=ProfileNetwork&nid='+netid+'&uid='+id,"profile_responce_span");
}
//////////////////////////////////////////////////

//////////////////////////////////////////////////
function ResendActivationCode(id, email){
	Timer_Icon('eMeeting_ResendActivation');
	eMeetingDo('inc/ajax/_actions.php?action=ResendActivationCode&id='+id+'&email='+email,"eMeeting_ResendActivation");
}
function validateUsername(username){
	Timer_Icon('response_span');
	eMeetingDo('inc/ajax/_actions.php?action=validateUsername&username='+username,"response_span");
}
function validateEmail(email){
	Timer_Icon('response_span_email');
	eMeetingDo('inc/ajax/_actions.php?action=validateEmail&email='+email,"response_span_email");
}
function validatePassword(password){
	Timer_Icon('response_span_pass');
	eMeetingDo('inc/ajax/_actions.php?action=validatePassword&password='+password,"response_span_pass");
}
function CheckPassword(){

	window.document.getElementById('response_span_rpass').innerHTML="";
	if(document.getElementById('regPassword').value != document.getElementById('regRPassword').value){
		window.document.getElementById('response_span_rpass').innerHTML="<img src='images/DEFAULT/_icons/16/alert.gif' align='absmiddle'> Passwords do not match!";
	}else{
		window.document.getElementById('response_span_rpass').innerHTML="<img src='images/DEFAULT/_icons/16/check.gif' align='absmiddle'>";
	}
}
///////////////////////////////////////////////////////
function DeleteMessage(mailid,box,senderid){
	Timer_Icon('response_message');
	eMeetingDo('inc/ajax/_actions.php?action=DeleteMessage&box='+box+'&mailid='+mailid+'&senderid='+senderid,"response_message");
}
////////////////////////////////////////////////////////
function DeleteFile(fileid){
	Timer_Icon('response_gallery');
	eMeetingDo('inc/ajax/_actions.php?action=DeleteFile&fileid='+fileid,"response_gallery");
}
////////////////////////////////////////////////////////

function UpdateFeaDiv(divid, addid){
	new Effect.Fade(divid);
	Timer_Icon('response_search');
	eMeetingDo('inc/ajax/_actions.php?action=addFavs&id='+addid,"response_search");
}
function RemoveFeaDiv(divid, removeid){
	new Effect.Fade(divid);
	Timer_Icon('response_search');
	eMeetingDo('inc/ajax/_actions.php?action=removeFavs&id='+removeid,"response_search");
}
////////////////////////////////////////////////////////

function DeleteBlogPost(id){

	eMeetingDo('inc/ajax/_actions.php?action=DeleteBlogPost&blogid='+id,"response_blog1");
}
 
 
//////////////////////////////////////////
function DeleteEventId(id){
	Timer_Icon('response_event');
	eMeetingDo('inc/ajax/_actions.php?action=DeleteEvent&id='+id,"response_event");
}
//////////////////////////////////////////
function DeleteMatchTest(id){
	Timer_Icon('response_match');
	eMeetingDo('inc/ajax/_actions.php?action=deleteMatch&id='+id,"response_match");
}
function DeleteMatchTestResult(id){
	Timer_Icon('response_match');
	eMeetingDo('inc/ajax/_actions.php?action=deleteMatchTestResult&id='+id,"response_match");
}
/////////////
function MakeDefaultP(id){
	Timer_Icon('response_gallery');
	eMeetingDo('inc/ajax/_actions.php?action=MakeDefaultImage&id='+id,"response_gallery");
}
function DeleteAlbum(id){
	Timer_Icon('response_gallery');
	eMeetingDo('inc/ajax/_actions.php?action=deleteAlbum&id='+id,"response_gallery");
}

/* EXTRA MEMBER PROFILE RATING
------------------------------*/

function eMeetingProfileRating(rating, profileID){
 
	Timer_Icon('eMeetingProfileRating');
	eMeetingDo('inc/ajax/_actions.php?action=eMeetingProfileRating&rating='+rating+'&profileID='+profileID,"eMeetingProfileRating");
}

function eMeetingLinkedField(value, linkedID, searchPage){

	Timer_Icon('Link'+linkedID);
	eMeetingDo('inc/ajax/_actions.php?action=PopLinkedField&lid='+linkedID+'&value='+value+'&rownum='+searchPage,'Link'+linkedID);
}

function eMeetingClassCats(value, div, def){
 
	Timer_Icon(div);
	eMeetingDo('inc/ajax/_actions.php?action=PopClassSubCats&value='+value+'&def='+def,div);
}

function eMeetingNetworkStates(value, div_id){
 	
	Timer_Icon("Link" + div_id);
	eMeetingDo('inc/ajax/_actions.php?action=DisplayNetworkStates&country_id='+value+'&fid='+div_id, "Link" + div_id );
}

function eMeetingNetworkCities(value, div_id){
 	
	Timer_Icon("Link" + div_id);
	eMeetingDo('inc/ajax/_actions.php?action=DisplayNetworkCities&state_id='+value+'&fid='+div_id, "Link" + div_id );
}