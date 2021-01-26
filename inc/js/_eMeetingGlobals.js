var IMChatId = "";


function ChangeFollowId(id, div){
	document.getElementById(div).value=id;
}

function showProfileDiv(NewDiv){
	ProfileStatus = document.getElementById('hiddenProfileStatus');
	if(ProfileStatus.value != NewDiv){
		Effect.toggle(ProfileStatus.value,'appear');
		ProfileStatus.value=NewDiv;
		Effect.toggle(NewDiv,'appear'); return false;
	}
}

function showDefaultProfileDiv(){
	toggleLayer('ShowProfileData');
}

/* profile page */

function ChangeTState(){

}


function NewAlertSound(playSound){

	var flashvars = {};
	flashvars.sndfilename = "ringbell";
	var params = {};
	params.play = "true";
	params.loop = "false";
	params.menu = "false";
	params.scale = "noscale";
	params.wmode = "transparent";

	var attributes = {};
	attributes.align = "top";
	swfobject.embedSWF("inc/exe/IM/inc/sounds/playSnd.swf", "playAlertSound", "100%", "100%", "9.0.0", "inc/exe/IM/inc/sounds/expressInstall.swf", flashvars, params, attributes);

}



function showMenu(){

	statusMenu = document.getElementById('hiddenStatusMenu');
	if(statusMenu.value==0){
		statusMenu.value=1;
		Effect.toggle('searchmenu','appear'); return false;
	}

}

function hideMenu(){

	statusMenu = document.getElementById('hiddenStatusMenu');
	if(statusMenu.value==1){
		statusMenu.value=0;
		Effect.toggle('searchmenu','appear'); return false;
	}

}





/**

* Info: Load IM Window

*

* @version  9.0

* @created  Fri Sep 18 10:48:31 EEST 2008

* @updated  Fri Sep 18 10:48:31 EEST 2008

*/

function popPDF(page, id, domain){
	window.open(domain+"inc/exe/PDF/show.php?page="+page+"&id="+id,"Window1","width=500,height=500");
}



function LauncheMeetingIm(domain){
	window.open(domain+"inc/exe/IM/list.php","Window1","menubar=no,width=250,height=430,toolbar=no");
}



function openIMWin(pid, myid, domain, imType, imWidth, imHeight) {
		
		IMChatId = "pid"+pid;
		if(imType =="userplane"){
			var WLink = "plugins/plugins/userplane/wm.php?strDestinationUserID=" +pid+"&strFromID="+myid+"WMWindow_" + up_replaceAlpha(myid) + "_" + up_replaceAlpha(pid);
		} else{
			var WLink = imType+pid;
		}

		var wWidth = imWidth;
		var wHeight = imHeight;
		NewpopUpWin(domain+WLink, wWidth, wHeight);

}



function openChatWin(domain, imagefolder, wWidth, wHeight, ChatPath, PopUpWindow) { }



function openProfileViewer(domain, imagefolder) {

	if(!wbPopover2) {
		var FilePath = domain+'images/DEFAULT/_window/';
		wbPopover2 = new Popover(domain+'inc/exe/viewing/show.php', {height:400, width:380, heading:'&nbsp;', closeButton:true, dragable:true, hideShutter:true, closeButton:true, image_path:''+FilePath+''});
	}

	wbPopover2.show();



}



function NewpopUpWin(URL, width, height) {

	day = new Date();
	id = IMChatId; //day.getTime();

	eval("page" + id + " = window.open(URL, '" + IMChatId + "', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=" + width + ",height=" + height + ",left = 490,top = 200');");
}



function DisplayPackFeatures(pid){

	document.getElementById('newpackageid').value =pid;
	Timer_Icon('PackageFeatures_span');
	eMeetingDo('inc/ajax/_actions.php?action=displayPackageFea&id='+pid,"PackageFeatures_span");

}



function UpdateimgB(imgName){

	document.getElementById('imgAol').style.border='1px solid #ccc';
	document.getElementById('imgGmail').style.border='1px solid #ccc';
	document.getElementById('imgHotmail').style.border='1px solid #ccc';
	document.getElementById('imgYahoo').style.border='1px solid #ccc';
	document.getElementById(imgName).style.border='1px dashed red';
}

/**

* Info:Profile Page Functions

*

* @version  9.0

* @created  Fri Sep 18 10:48:31 EEST 2008

* @updated  Fri Sep 18 10:48:31 EEST 2008

*/

function TakeTestQ(id) {

	document.getElementById('quizid').value=''+id+'';
	document.TakeTest.submit();

}



/**

* Info: Login Page

*

* @version  9.0

* @created  Fri Sep 18 10:48:31 EEST 2008

* @updated  Fri Sep 18 10:48:31 EEST 2008

*/



function CheckNullsLogin(error){

	if( (document.getElementById('e_username').value =="") || (document.getElementById('e_password').value =="") ){

		alert(error);
		return false;

	}

	return true;

}

function CheckPageNullsLogin(error){

	if(document.getElementById('e_username_login').value ==""){
		document.getElementById("login_user_error").style.display="block";
		return false;
	}

	if(document.getElementById('e_password_login').value ==""){
		document.getElementById("login_user_pass").style.display="block";
		
		return false;
	}
	if( (document.getElementById('e_username_login').value =="") || (document.getElementById('e_password_login').value =="") ){
		alert(error);
		return false;
	}
	return true;
}

function CheckPageNullsRegister(error){

	if(document.getElementById('regUsername').value ==""){
		document.getElementById("response_span").innerHTML='<img src="images/DEFAULT/_icons/16/alert.gif"> Please type your desired username.';
		document.getElementById("regUsername").focus();
		document.getElementById("response_span").style.display="block";
		return false;
	}

	if(document.getElementById('regEmail').value ==""){
		document.getElementById("response_span_email").innerHTML='<img src="images/DEFAULT/_icons/16/alert.gif"> Please type your email id.';
		document.getElementById("regEmail").focus();
		document.getElementById("response_span_email").style.display="block";
		
		return false;
	}
	if(document.getElementById('regPassword').value ==""){
		document.getElementById("response_span_pass").innerHTML='<img src="images/DEFAULT/_icons/16/alert.gif"> Please type your desired password.';
		document.getElementById("regPassword").focus();
		document.getElementById("response_span_pass").style.display="block";
		
		return false;
	}
	if(document.getElementById('regRPassword').value ==""){
		document.getElementById("response_span_rpass").innerHTML='<img src="images/DEFAULT/_icons/16/alert.gif"> Please re-type your password.';
		document.getElementById("regRPassword").focus();
		document.getElementById("response_span_rpass").style.display="block";
		
		return false;
	}
	
	return true;
}

function removeValidation(id){
	document.getElementById(id).style.display="none";
}
/**

* Info: Contact Page Functions

*

* @version  9.0

* @created  Fri Sep 18 10:48:31 EEST 2008

* @updated  Fri Sep 18 10:48:31 EEST 2008

*/

function CheckNullsContact(error){

	if( (document.getElementById('C1').value =="") || (document.getElementById('C2').value =="") || (document.getElementById('C2').value =="") || (document.getElementById('C4').value =="") ){
		alert(error);
		return false;
	}

	return true;

}

function CheckNullsInvite(error){

	if( (document.getElementById('I1').value =="") || (document.getElementById('I2').value =="") ){
		alert(error);
		return false;
	}

	return true;

}

function CheckNulls2(error){

	if( (document.getElementById('b1').value =="") || (document.getElementById('b2').value =="") ){

		alert(error);
		return false;

	}

	return true;

}

/**

* Info: Contact Page Functions

*

* @version  9.0

* @created  Fri Sep 18 10:48:31 EEST 2008

* @updated  Fri Sep 18 10:48:31 EEST 2008

*/

function CheckNullsAlbums(error){

	if( (document.getElementById('a1').value =="") || (document.getElementById('a2').value =="") ){
		alert(error);
		return false;
	}
	return true;

}

/**

* Info: Blog Page Functions

*

* @version  9.0

* @created  Fri Sep 18 10:48:31 EEST 2008

* @updated  Fri Sep 18 10:48:31 EEST 2008

*/



function CheckNullsBlog(error){



	if( 

		(document.getElementById('BlogTitle').value =="") ||

		(document.getElementById('editor').value =="")

	){

		alert(error);

		return false;

	}



	return true;

	

}

/**

* Info: Group Page Functions

*

* @version  9.0

* @created  Fri Sep 18 10:48:31 EEST 2008

* @updated  Fri Sep 18 10:48:31 EEST 2008

*/



function CheckGroupNulls(error){

 

	if( 

		(document.getElementById('name').value =="") ||

		(document.getElementById('editor').value =="")

	){

		alert(error);

		return false;

	}



	return true;

	

}

/**

* Info: ClassAds Page Functions

*

* @version  9.0

* @created  Fri Sep 18 10:48:31 EEST 2008

* @updated  Fri Sep 18 10:48:31 EEST 2008

*/



function CheckClassadsNulls(error){

 

	if( 

		(document.getElementById('ad_title').value =="") ||

		(document.getElementById('editor').value =="")

	){

		alert(error);

		return false;

	}



	return true;

	

}

/**

* Info: Claendar Page Functions

*

* @version  9.0

* @created  Fri Sep 18 10:48:31 EEST 2008

* @updated  Fri Sep 18 10:48:31 EEST 2008

*/

function CheckNullEvent(error){

	if( 

		(document.getElementById('name').value =="") ||

		(document.getElementById('comment').value =="") || 		

		(document.getElementById('time').value =="") ||

		(document.getElementById('street').value =="") ||

		(document.getElementById('town').value =="") ||

		(document.getElementById('phone').value =="") ||

		(document.getElementById('email').value =="") ||

		(document.getElementById('website').value =="")

	){

		alert(error);

		return false;

	}



	return true;

}

/**

* Info: Account Functions

*

* @version  9.0

* @created  Fri Sep 18 10:48:31 EEST 2008

* @updated  Fri Sep 18 10:48:31 EEST 2008

*/

function Form_ChangeDefaultPhoto(filename, divid){



	document.getElementById(divid+'_hidden').value=''+filename+'';

	window.document.getElementById(divid).innerHTML='<img src="uploads/thumbs/'+filename+'" width="46" height="46" align="absmiddle">';

	toggleLayer('ImgagesHide');



}

function UpdateBlogOrder(orderby) {

	document.getElementById('ChangeOrder').value=''+orderby+'';

	document.UpdateBlog.submit();

}

function EditBlogPost(blogid) {

	document.getElementById('eid').value=''+blogid+'';

	document.EditBlog.submit();

}

function UpdateCommentsOrder(orderby) {

	document.getElementById('ChangeOrder').value=''+orderby+'';

	document.UpdateComments.submit();

}

function EditMatchTest(id){

	document.getElementById('eid').value=''+id+'';

	document.EditMatch.submit();

}

function UpdateMatchOrder(orderby) {

	document.getElementById('ChangeOrder').value=''+orderby+'';

	document.UpdateMatch.submit();

}



/**

* Info: Messages Page

*

* @version  9.0

* @created  Fri Sep 18 10:48:31 EEST 2008

* @updated  Fri Sep 18 10:48:31 EEST 2008

*/

function popUpWin(URL) {

day = new Date();

id = day.getTime();

eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=500,height=500,left = 490,top = 200');");

}

function AddMsgIcon(icon){

	document.getElementById('formMessage').value = document.getElementById('formMessage').value+''+icon+'';

}

function AttCard(cardid){

	document.getElementById('addCardID').value=''+cardid+'';

	document.getElementById('response_ecard').innerHTML ="<img src='./images/DEFAULT/_msg/attached.gif'> ecard attached";

}

function UpdateMailOrder(box,orderby) {

	document.getElementById('ChangeOrder').value=''+orderby+'';

	document.getElementById('ChangeOrderTotal').value=''+orderby+'';

	document.getElementById('sub').value=''+box+'';

	document.UpdateMail.submit();

}

function AddSendTo(username){

	if(document.getElementById('SendTo').value ==""){

		document.getElementById('SendTo').value = document.getElementById('SendTo').value+''+username+'';

	}else{

		document.getElementById('SendTo').value = document.getElementById('SendTo').value+','+username+''

	}

}

function CheckNullsMessages(){

	

	if( 

		(document.getElementById('SendTo').value =="") ||

		(document.getElementById('SentSubject').value =="") || 

		(document.getElementById('formMessage').value =="")

	){

		document.getElementById('response_message').innerHTML ="Please complete all the fields";

		return false;

	}

	toggleLayer('SendMsgBoxDiv'); 

	toggleLayer('UploadWait');

	return true;

}

function da(x){for(var j=1;j<=x;j++){box=eval("document.MessagesBox.d"+j);box.checked=true;}}

function du(x){for(var j=1;j<=x;j++){box=eval("document.MessagesBox.d"+j);box.checked=false;}}

/**

* Info: Gallery Page

*

* @version  9.0

* @created  Fri Sep 18 10:48:31 EEST 2008

* @updated  Fri Sep 18 10:48:31 EEST 2008

*/

function enablePrivateField()

{

	document.getElementById( 'catid_type1' ).checked = true;

	document.getElementById( 'catid_type2' ).checked = true;

	//document.getElementById( 'catid_type3' ).checked = true;

	

	document.getElementById( 'catid_type1' ).disabled = false;

	document.getElementById( 'catid_type2' ).disabled = false;

	//document.getElementById( 'catid_type3' ).disabled = false;

	

}

function DisablePrivateField()

{

	document.getElementById( 'catid_type1' ).checked = false;

	document.getElementById( 'catid_type2' ).checked = false;

	//document.getElementById( 'catid_type3' ).checked = false;

	

	document.getElementById( 'catid_type1' ).disabled = true;

	document.getElementById( 'catid_type2' ).disabled = true;

	//document.getElementById( 'catid_type3' ).disabled = true;

	

}

function CheckUploadNulls(error){





	// GET UPLOAD TYPE

	var upType = document.getElementById("javascriptType").value;

	

	if(upType =="photo"){

		

		var validext = new Array("jpg","peg","bmp","png","gif");



		var val = document.getElementById( 'uploadFile00' ).value; 

		var len = val.length;



	}else if(upType=="video"){		



		var validext = new Array("mpg","mpeg","mov","qt","mxu","movie","divx","avi","mp4","flv");



		var val = document.getElementById( 'uploadFile012' ).value;

		var len = val.length;

	

	}else if(upType=="music"){



		var validext = new Array("mp3","midi","mpeg");



		var val = document.getElementById( 'uploadFile011' ).value;

		var len = val.length;		



	}else if(upType=="youtube"){



		if(document.getElementById( 'YoutubeURL' ).value.length > 10){



			toggleLayer('UploadBox'); 

			toggleLayer('UploadWait');

			return true;

		

		} else {



		alert(document.getElementById("javascriptError").value);

		return false;

		

		}

	

	}

 

	// lets do some checks



	if( (len == 0 ) || ( len == undefined ) )

	{



		alert('Please select a file to upload');return false;

	}

	else{

	

		val = val.toLowerCase(); 

		var ext = val.substr(len-3,3);

		for(var i=0; validext.length > i ; i++){

			if (ext.indexOf(validext[i])!= -1){

	

					toggleLayer('UploadBox'); 

					toggleLayer('UploadWait');

					return true;

			}

		}

		alert(document.getElementById("javascriptError").value);

		return false;

	} 



}



function ChangeUploadType(type){



	document.getElementById("javascriptType").value=type;



	if(type =="photo"){

		toggleLayer('TypePhoto'); 

		toggleLayer('TypeDefault');

	}else if(type=="video"){

		toggleLayer('TypeVideo'); 

	}else if(type=="music"){

		toggleLayer('TypeMusic'); 

	}else if(type=="youtube"){

		toggleLayer('TypeYouTube'); 	

	}

	toggleLayer('FileType');

}



function HideComments(){

	document.getElementById("DisplayList").style.display='none';

}

/**

* Info: Search Page Functions

*

* @version  9.0

* @created  Fri Sep 18 10:48:31 EEST 2008

* @updated  Fri Sep 18 10:48:31 EEST 2008

*/

function DoTagSearch(tag) {



	document.getElementById('QKeyword').value=''+tag+'';

	document.ClassSearch.submit();

}

function ChangeSearchPage(PageNum) {



	document.getElementById('searchPage').value=''+PageNum+'';



}

function ChangeSearchDisplay(display) {



	document.getElementById('displaytype').value=''+display+'';

	document.SearchResults.submit();



}

function ChangeInnserSort(display) {



	document.getElementById('displaytype').value=''+display+'';

	document.SearchResults.submit();



}

function ChangePage(Page) {

	document.getElementById('Spage').value = Page;
	document.SearchResults.submit();



}

function SavePage() {



	document.getElementById('SavePage').value=1;

	document.SearchResults.submit();



}



function ChangeSort(Page) {



	document.getElementById('SSort').value=''+Page+'';

	document.SearchResults.submit();



}

function SearchThisBox(clearbox){



	document.QuckSearchMenu.submit();

	if(clearbox ==1){

			document.getElementById('Q2').value='';		

			document.getElementById('Q4').value='';

			document.getElementById('Q3').value='';		

	}else if(clearbox ==2){

			document.getElementById('Q1').value='';		

			document.getElementById('Q4').value='';

			document.getElementById('Q3').value='';		

	}else if(clearbox ==3){

			document.getElementById('Q1').value='';

			document.getElementById('Q2').value='';

			document.getElementById('Q4').value='';

	}else if(clearbox ==4){

			document.getElementById('Q1').value='';

			document.getElementById('Q2').value='';

			document.getElementById('Q3').value='';

	}



}



function MakeSearchOptions(newtoday, birthday, fav, onlinenow, highlight, featured, pics){



	if(newtoday ==1){

		document.getElementById('se_newtoday').value='1';

	}

	if(birthday ==1){

		document.getElementById('se_birthday').value='1';

	}

	if(featured ==1){

		document.getElementById('se_featured').value='1';

	}

	if(onlinenow ==1){

		document.getElementById('se_onlinenow').value='1';

	}

	if(highlight ==1){

		document.getElementById('se_highlight').value='1';

	}	

	if(fav ==1){

		document.getElementById('se_favorite').value='1';

	}

	if(pics ==1){

		document.getElementById('se_pics').value='1';

	}

	

	document.QuickSearch.submit();	

}

/**

* Info: Register Functions

*

* @version  9.0

* @created  Fri Sep 18 10:48:31 EEST 2008

* @updated  Fri Sep 18 10:48:31 EEST 2008

*/

function SetNewName(username){

	document.getElementById('regUsername').value=''+username+'';

}



function CheckRegisterNulls(error,error1){
	if( 

		(document.getElementById('regUsername').value =="") ||

		(document.getElementById('regEmail').value =="") ||

		(document.getElementById('RegNotify').value =="") || 

		(document.getElementById('regPassword').value =="")|| document.getElementById('t&C').checked == false 

	){

		if(document.getElementById('t&C').checked == false){

			alert(error1);

			toggleLayer('MainRegisterForm'); 

			toggleLayer('UploadWait1');

			return false;

		} else {
			

			alert(error);

			toggleLayer('MainRegisterForm'); 

			toggleLayer('UploadWait1');

			Effect.toggle('reg_step_4','slide', {delay: 0.5}); 

			Effect.toggle('reg_step_1','slide', {delay: 0.5})

			return false;

		}

	}



	return true;

	



}

function SendEmailContacts(){



	toggleLayer('MainRegisterForm'); 

	toggleLayer('UploadWait');

	return true;

}

function ChangeRegContactType(){



	document.getElementById('cSS').value='forward';

	document.MyContacts.submit();

}



/**

* Info: Profile Functions

*

* @version  9.0

* @created  Fri Sep 18 10:48:31 EEST 2008

* @updated  Fri Sep 18 10:48:31 EEST 2008

*/

function bookmark(url, description)

{

	netscape="Netscape User's hit CTRL+D to add a bookmark to this site."

	if (navigator.appName=='Microsoft Internet Explorer'){window.external.AddFavorite(url, description);}else if (navigator.appName=='Netscape'){alert(netscape);}

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
  
  if(whichLayer == 'ForgottenPassword'){window.scrollTo(0, 0);
     document.getElementById( 'ActAccount' ).style.display = 'none';
   }
  if(whichLayer == 'ActAccount'){
     document.getElementById( 'ForgottenPassword' ).style.display = 'none';
   }

  if(vis.display==''&&elem.offsetWidth!=undefined&&elem.offsetHeight!=undefined)    vis.display = (elem.offsetWidth!=0&&elem.offsetHeight!=0)?'block':'none';  vis.display = (vis.display==''||vis.display=='block')?'none':'block';

}



/**

* Info: Userplane Extra Functions

*

* @version  9.0

* @created  Fri Sep 18 10:48:31 EEST 2008

* @updated  Fri Sep 18 10:48:31 EEST 2008

*/

function up_replaceAlpha( strIn )

{

	var strOut = "";

	for( var i = 0 ; i < strIn.length ; i++ )

	{

		var cChar = strIn.charAt(i);

		if( ( cChar >= 'A' && cChar <= 'Z' )

			|| ( cChar >= 'a' && cChar <= 'z' )

			|| ( cChar >= '0' && cChar <= '9' ) )

		{

			strOut += cChar;

		}

		else

		{

			strOut += "_";

		}

	}

	

	return strOut;

}

 



function UpdateFrame(divid, colour){

	//alert(divid);
	// get reference to form named 'ifrmTest' 
	var iframeEl = document.getElementById('PreviewFrame');

	//alert(colour+"--"+divid);
	if(divid =="font1"){

		// background color
		if ( iframeEl.contentDocument ) { // DOM
		   iframeEl.contentWindow.document.body.style.fontFamily=colour; // FF style
		} else if ( iframeEl.contentWindow ) { // IE win
			iframeEl.contentWindow.document.body.style.fontFamily=colour; // IE style
		}
	}

	if(divid =="font2"){}
	if(divid =="h0"){

		// background color MenuBar

		if ( iframeEl.contentDocument ) { // DOM
		   iframeEl.contentWindow.document.getElementById('ProfileHead').style.fontFamily=colour; // FF style
		} else if ( iframeEl.contentWindow ) { // IE win
			iframeEl.contentWindow.document.getElementById('ProfileHead').style.fontFamily=colour; // IE style
		}

	}



	if(divid =="h1"){

		// background color MenuBar

		if ( iframeEl.contentDocument ) { // DOM



		   iframeEl.contentWindow.document.getElementById('ProfileHead').style.backgroundColor = "#"+colour; // FF style

		   iframeEl.contentWindow.document.getElementById('MenuBar').style.backgroundColor = "#"+colour; // FF style



		} else if ( iframeEl.contentWindow ) { // IE win

			iframeEl.contentWindow.document.getElementById('ProfileHead').style.backgroundColor = "#"+colour; // IE style

		   iframeEl.contentWindow.document.getElementById('MenuBar').style.backgroundColor = "#"+colour; // FF style



		}

	}

	// #, #ProfileHead h2, #ProfileHead h1, #ProfileHead

	// BACKGROUND STYLE

	if(divid =="b1"){

		// background color

		if ( iframeEl.contentDocument ) { // DOM

		   iframeEl.contentWindow.document.body.style.backgroundColor = "#"+colour; // FF style

		} else if ( iframeEl.contentWindow ) { // IE win

			iframeEl.contentWindow.document.body.style.backgroundColor = "#"+colour; // IE style

		}

	} 


	// INNER BACKGROUND STYLE 
	if(divid =="i2"){
		// background color
		if ( iframeEl.contentDocument ) { // DOM
		   iframeEl.contentWindow.document.getElementById('ProfileOptionsBox').style.backgroundColor = "#"+colour; // FF style
		} else if ( iframeEl.contentWindow ) { // IE win
			iframeEl.contentWindow.document.getElementById('ProfileOptionsBox').style.backgroundColor = "#"+colour; // IE style
		}
	} 

}



window.onerror = null;

var topMargin = 100;

var slideTime = 1200;

var ns6 = (!document.all && document.getElementById);

var ie4 = (document.all);

var ns4 = (document.layers);



function layerSetup() {

	floatLyr = new layerObject('floatLayer', pageWidth * .5);
	window.setInterval("main()", 10)

}

function floatObject() {

	if (ns4 || ns6) {
		findHt = window.innerHeight;
	} else if(ie4) {
		findHt = document.body.clientHeight;
   }

} 

function main() {

	if (ns4) {
		this.currentY = document.layers["floatLayer"].top;
		this.scrollTop = window.pageYOffset;
		mainTrigger();
	}
	else if(ns6) {
		this.currentY = parseInt(document.getElementById('floatLayer').style.top);
		this.scrollTop = scrollY;
		mainTrigger();
	} else if(ie4) {
		this.currentY = floatLayer.style.pixelTop;
		this.scrollTop = document.body.scrollTop;
		mainTrigger();
   }

}

function mainTrigger() {

	var newTargetY = this.scrollTop + this.topMargin;

	if ( this.currentY != newTargetY ) {

		if ( newTargetY != this.targetY ) {
			this.targetY = newTargetY;
			floatStart();
		}
		animator();
   }

}

function floatStart() {

	var now = new Date();
	this.A = this.targetY - this.currentY;
	this.B = Math.PI / ( 2 * this.slideTime );
	this.C = now.getTime();

	if (Math.abs(this.A) > this.findHt) {
		this.D = this.A > 0 ? this.targetY - this.findHt : this.targetY + this.findHt;
		this.A = this.A > 0 ? this.findHt : -this.findHt;
	}
	else {
		this.D = this.currentY;
   }

}

function animator() {

	var now = new Date();
	var newY = this.A * Math.sin( this.B * ( now.getTime() - this.C ) ) + this.D;
	newY = Math.round(newY);
	if (( this.A > 0 && newY > this.currentY ) || ( this.A < 0 && newY < this.currentY )) {

		if ( ie4 )document.all.floatLayer.style.pixelTop = newY;

		if ( ns4 )document.layers["floatLayer"].top = newY;

		if ( ns6 )document.getElementById('floatLayer').style.top = newY + "px";

	}

}

function start() {

	if(ns6||ns4) {
		pageWidth = innerWidth;
		pageHeight = innerHeight;
		layerSetup();
		floatObject();
	}
	else if(ie4) {
		pageWidth = document.body.clientWidth;
		pageHeight = document.body.clientHeight;
		layerSetup();
		floatObject();
   }

}

function layerObject(id,left) {

	if (ns6) {

		this.obj = document.getElementById(id).style;
		this.obj.left = left;
		return this.obj;

	}

	else if(ie4) {

		this.obj = document.all[id].style;
		this.obj.left = left;
		return this.obj;

	}

	else if(ns4) {
		this.obj = document.layers[id];
		this.obj.left = left;
		return this.obj;
   }


}

function up_launchWM( userID, destinationUserID, destinationName, WebPath ) {

	up_localUserID = userID;
	window.open( WebPath+"/plugins/plugins/userplane/wm.php?strDestinationUserID=" + destinationUserID+"&strFromID="+userID, "WMWindow_" + up_replaceAlpha(userID) + "_" + up_replaceAlpha(destinationUserID), "width=360,height=397,toolbar=0,directories=0,menubar=0,status=0,location=0,scrollbars=0,resizable=1" );

}

function up_replaceAlpha( strIn ) {

	var strOut = "";
	for( var i = 0 ; i < strIn.length ; i++ ) {

		var cChar = strIn.charAt(i);
		if( ( cChar >= 'A' && cChar <= 'Z' ) || ( cChar >= 'a' && cChar <= 'z' ) || ( cChar >= '0' && cChar <= '9' ) ) {
			strOut += cChar;
		}
		else {
			strOut += "_";
		}
	}
	return strOut;

}

function ShowHideQuickLinks(id,st){
	document.getElementById(id).style.display = st;
}


function ShowHideVideoSection(status,url){

	document.getElementById("video-chat-section").style.display = status;
	document.getElementById("video-frame").src = url;

}

function onSignIn(googleUser) {
  	var profile = googleUser.getBasicProfile();
  	var id = profile.getId();
  	var name = profile.getName();
  	var url = profile.getImageUrl();
  	var email = profile.getEmail();
	Timer_Icon('google-sign-in');
	eMeetingDo('/inc/ajax/_actions.php?action=googlesign&id='+id+'&name='+name+'&url='+url+'&email='+email,"google-sign-in");
	setTimeout(function(){
		if(document.getElementById("google-sign-in").innerHTML == 'OK'){
			window.location.href = "/";
		}
	},2000);
	
}

function signOut(domain) {
	window.location.href= "https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue=" + domain;
}



function searchAgerValidator(type){
	
	if(type == 'qsf' || type == 'qst'){
		var vqsf = document.getElementById('quick_search_age_from');
		var vqst = document.getElementById("quick_search_age_to");
	}
	else{
		var vsf = document.getElementById("search_age_from");
		var vst = document.getElementById("search_age_to");
		
	}

	if(type == 'qsf'){

		if(parseInt(vqsf.value) > parseInt(vqst.value)){
			vqst.value = vqsf.value;
		}
	}
	else if(type == 'qst'){
		if(parseInt(vqsf.value) > parseInt(vqst.value)){
			vqsf.value = vqst.value;
		}
	}
	else if(type == 'sf'){
		if(parseInt(vsf.value) > parseInt(vst.value)){
			vst.value = vsf.value;
		}
	}
	else if(type == 'st'){
		if(parseInt(vsf.value) > parseInt(vst.value)){
			vsf.value = vst.value;
		}
	}


}