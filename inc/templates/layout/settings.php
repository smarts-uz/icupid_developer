<?
/**
* Page: MEMBER SETTINGS AND PRIVACY PAGE
*
* @version  9.0
* @created  Sat 25 Oct  2008
* @related  inc/func/func_settings_page.php & func_settings.php
*/

## block direct page access

defined( 'KEY_ID' ) or die( 'Restricted access' );

?>
<div id="main">         
    <div id="main_content_wrapper">     

    <? if(!isset($HEADER_SINGLE_COLUMN)){ ?><div class='conten_outer' style="padding:10px 20px;"> <? } ?>   
        
 	<div class="clear"></div>

    <? if(isset($ERROR_MESSAGE) && strlen($ERROR_MESSAGE) > 3){ ?>
    <div id="messages">
		<div class="message-<?=$ERROR_TYPE ?>" id="main-message-<?=$ERROR_TYPE ?>">
        	<a class="dismiss-message" href="#" onclick="Effect.Fade('main-message-<?=$ERROR_TYPE ?>', { duration : 0.5 });; return false;"><img src="images/DEFAULT/_icons/16/menu.gif"></a>
          	<?=$ERROR_MESSAGE ?>
        </div>
        <script type="text/javascript" language="javascript">Effect.Pulsate('main-message-<?=$ERROR_TYPE ?>', { pulses : 2, duration : 1, from : 0.7 });</script>
    </div>
    <? } ?>



<? foreach($BANNER_ARRAY as $banner){ if($banner['position'] =="middle"){?>
<div class="middle_banner"><? print $banner['display'];?></div><? }} ?>

<p <? if ($PageDesc !='') {?> class="page_decr" <? }?> ><?=$PageDesc ?></p>

<? if($show_page =="home"){ 



	 /**

	 * Page: Settings Options

	 *

	 * @version  9.0

	 */



?>

<style type="text/css">
	
	.s6 a:nth-child(2) {
    color: gray;
    font-weight: bold;
    font-size: 15px;
    text-decoration: underline;
}
</style>






<div class="contentf">

<b class="i1f"></b><b class="i2f"></b><b class="i3f"></b><b class="i4f"></b><div class="contenti" style="margin-left:0px;">

<style>
.s1 { background: url(images/DEFAULT/_icons/new/acc/set_1.png) no-repeat; background-position: 0% 50%}
.s2 { background: url(images/DEFAULT/_icons/new/acc/set_2.png) no-repeat; background-position: 0% 50%}
.s3 { background: url(images/DEFAULT/_icons/new/acc/set_3.png) no-repeat; background-position: 0% 50%}
.s4 { background: url(images/DEFAULT/_icons/new/acc/set_4.png) no-repeat; background-position: 0% 50%}
.s5 { background: url(images/DEFAULT/_icons/new/acc/set_5.png) no-repeat; background-position: 0% 50%}
.s6 { background: url(images/DEFAULT/_icons/new/acc/gdpr-icon.jpg) no-repeat; background-position: 0% 50%}

</style>

<?=BuildPageHomeMenu($SubSub_Lang, $page) ?>

<br><br>

</div>

<b class="i4f"></b><b class="i3f"></b><b class="i2f"></b><b class="i1f"></b></div><b class="b4f"></b><b class="b3f"></b><b class="b2f"></b><b class="b1f"></b>

<div class="ClearAll"></div>

<? }elseif($show_page=="settings"){

	/**

	* Page: Match Settings

	*

	* @version  8.0

	* @created  Fri Jan 18 10:48:31 EEST 2008

	* @updated  Fri Sep 24 16:28:31 EEST 2008

	*/

if(!empty($match_settings_array)){ ?>
<form method="POST" name="MemberSearch1" action="<?= getThePermalink('search/view/1') ?>">               

<input name="do" type="hidden" value="add" class="hidden">            

<input name="do_page" type="hidden" value="search" class="hidden">

<input type="hidden" name="page" value="1" class="hidden">

<input type="hidden" name="Extra[zero]" value="1" class="hidden">

<div id="OldMatch"><ul class="form"><div class="CapBody bd_padding_20"> 

		<? foreach($match_settings_array as $Match){ 		

			if($Match['type'] == '5'){
			?>
			<li><label><?=$Match['caption'] ?></label><br/>
			
			<?php
			if(isset($Match['label'])){
				echo $Match['label'];
			}
			?>	
			</li>
			<?php	
			}
			else{
			?>
			<li><label><?=$Match['caption'] ?></label><input type="input" value="<?=$Match['value'] ?>" disabled></li>
			<?php
			}
			?>
		<? } ?>	

	 <li> <?=MatchCount() ?> <?=$GLOBALS['_LANG']['_results'] ?></li>	

      <li> <img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/16/menu.gif" align="absmiddle"> <a href="#" onclick="toggleLayer('NewMatch'); toggleLayer('OldMatch'); return false;"><?=$GLOBALS['_LANG']['_edit'] ?></a> </li>

	  <li><input  class="MainBtn" type="submit" value="<?=$GLOBALS['_LANG']['_search'] ?>"></li>

	</div>

	</ul>

</div>

<input type="hidden" name="Extra[match]" value="1">

</form>



<? } ?>



<div style="<? if(empty($match_settings_array)){ ?><? }else{ ?>display:none<? } ?>" id="NewMatch">



<div class="menu_box_title1"><?=$GLOBALS['LANG_MATCH']['a1'] ?></div>

<div class="menu_box_body1">

<form method="post" action="<?=DB_DOMAIN ?>index.php" name="MemberSearch">               

<input name="do" type="hidden" value="settings" class="hidden">            

<input name="do_page" type="hidden" value="settings" class="hidden">

<input name="sub" type="hidden" value="settings" class="hidden">

	<ul class="form">   

	<div class="CapBody bd_padding_20"> 

		<?=DisplayExtraFields() ?>

		<li><input  class="MainBtn"  type="submit" value="<?=$GLOBALS['_LANG']['_save'] ?>"></li>

		<li> <img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/16/alert.gif" align="absmiddle"> <a href="javascript:void(0);" onclick="toggleLayer('NewMatch'); toggleLayer('OldMatch'); return false;"><?=$GLOBALS['_LANG']['_cancel'] ?></a> </li>

	</div>

	</ul>

</form>

</div>

</div>









<? }elseif($show_page=="privacy"){ 



	 /**

	 * Page: Settings Privacy Page

	 *

	 * @version  8.0

	 * @created  Fri Jan 18 10:48:31 EEST 2008

	 * @updated  Fri Sep 24 16:28:31 EEST 2008

	 */



?>





<form method="post" action="<?=DB_DOMAIN ?>index.php">

<input name="do" type="hidden" value="privacy" class="hidden">

<input name="time" type="hidden" value="0" class="hidden"> 

<input name="counter" type="hidden" value="no" class="hidden">

<input name="lang" type="hidden" value="english" class="hidden"> 

<input name="do_page" type="hidden" value="settings" class="hidden">

<input name="sub" type="hidden" value="privacy" class="hidden">

<input name="pView" type="hidden" value="all" class="hidden">



<ul class="form"><div class="CapBody bd_padding_20">



	<li><label><?=$GLOBALS['LANG_SETTINGS']['a34'] ?></label> 

		<select name="im">

		<option value="yes" <? if($privacy_data['IM'] == "yes"){ print "selected"; } ?>><?=$GLOBALS['_LANG']['_yes'] ?></option>

		<option value="no" <? if($privacy_data['IM'] == "no"){ print "selected"; } ?>><?=$GLOBALS['_LANG']['_no'] ?></option>

		</select>

		<div class="tip"><?=$GLOBALS['LANG_SETTINGS']['a37'] ?></div>

	</li>

	

	<li><label><?=$GLOBALS['LANG_SETTINGS']['a38'] ?></label> 

		<select name="friends">

		<option value="yes" <? if($privacy_data['friends'] == "yes"){ print "selected"; } ?>><?=$GLOBALS['_LANG']['_yes'] ?></option>

		<option value="no" <? if($privacy_data['friends'] == "no"){ print "selected"; } ?>><?=$GLOBALS['_LANG']['_no'] ?></option>

		</select>

		

		<div class="tip"><?=$GLOBALS['LANG_SETTINGS']['a39'] ?></div>

		</li>



	<li><label><?=$GLOBALS['LANG_SETTINGS']['a40'] ?></label> 

		<select name="comments">

		<option value="yes" <? if($privacy_data['comments'] == "yes"){ print "selected"; } ?>><?=$GLOBALS['_LANG']['_yes'] ?></option>

		<option value="no" <? if($privacy_data['comments'] == "no"){ print "selected"; } ?>><?=$GLOBALS['_LANG']['_no'] ?></option>

		</select>

			<div class="tip"><?=$GLOBALS['LANG_SETTINGS']['a41'] ?></div>	

	</li>



	<li><label><?=$GLOBALS['LANG_COMMON']['34'] ?></label>

<?



$access_data = explode("*",$privacy_data['Time Zone']);

$access_array = array();

	foreach($access_data as $value){		

		array_push($access_array,$value);

	}





?>

<select name="access[]" size="1"  multiple class="input" style="height:150px; width:250px">

<option value="0" <? if( in_array(0,$access_array) ){ print "selected"; } ?>>------</option>

 <?

	$gg = $DB->Query("SELECT fvCaption, fvid FROM `field_list_value` WHERE fvFid =28 AND lang='".D_LANG."'");

	if(empty($gg)){	$gg = $DB->Query("SELECT fvCaption, fvid FROM `field_list_value` WHERE fvFid =28");	}

	while( $G = $DB->NextRow($gg) ){

	

?>

          <option value="<?=$G['fvid'] ?>" <? if( in_array($G['fvid'],$access_array) ){ print "selected"; } ?>><?=$G['fvCaption'] ?></option>

          <? } ?>

        </select>

<div class="tip"><?=$GLOBALS['LANG_COMMON']['35'] ?></div>

	</li>



<li><input type="submit" value="<?=$GLOBALS['_LANG']['_save'] ?>" class="MainBtn"></li>

</div>

</ul>	



<? if(D_SKYPE ==1){ ?>

<ul class="form"><div class="CapBody bd_padding_20">

	<li><label><?=$GLOBALS['_LANG']['_skype1'] ?></label> 



 

	<input name="skype" type="text" value="<?=$privacy_data['skype'] ?>" size="40" class="input" maxlength="200">	 

			<div class="tip"><?=$GLOBALS['_LANG']['_skype2'] ?></div>	

	</li>
<li><input type="submit" value="<?=$GLOBALS['_LANG']['_save'] ?>" class="MainBtn"></li>


</div>







</ul>	

<? } ?>















<?

$profile1_data = explode("*",$privacy_data['profileview_friends']);

$profile1_array = array();

	foreach($profile1_data as $value){		

		array_push($profile1_array,$value);

	}



$profile2_data = explode("*",$privacy_data['profileview_nonfriend']);

$profile2_array = array();

	foreach($profile2_data as $value){		

		array_push($profile2_array,$value);

	}







if (isset($GLOBALS['LANG_SETTINGS']['a53']) && $GLOBALS['LANG_SETTINGS']['a53'] != "") {

	$profile_label1 = $GLOBALS['LANG_SETTINGS']['a53'];

}

else {

	$profile_label1 = "Profile Access (non friends)";

}



if (isset($GLOBALS['LANG_SETTINGS']['a54']) && $GLOBALS['LANG_SETTINGS']['a54'] != "") {

	$profile_hint1 = $GLOBALS['LANG_SETTINGS']['a54'];

}

else {

	$profile_hint1 = "Select which parts of your profile to BLOCK from a non-friend.";

}



if (isset($GLOBALS['LANG_SETTINGS']['a55']) && $GLOBALS['LANG_SETTINGS']['a55'] != "") {

	$profile_label2 = $GLOBALS['LANG_SETTINGS']['a55'];

}

else {

	$profile_label2 = "Profile Access (friends)";

}



if (isset($GLOBALS['LANG_SETTINGS']['a56']) && $GLOBALS['LANG_SETTINGS']['a56'] != "") {

	$profile_hint2 = $GLOBALS['LANG_SETTINGS']['a56'];

}

else {

	$profile_hint2 = "Select which parts of your profile to BLOCK from a friend.";

}





?>





<ul class="form"><div class="CapBody bd_padding_20">

<li>	

	<label><?=$profile_label1 ?></label> 

	<select name="profileview2[]" size="1"  multiple class="input" style="height:150px; width:250px">

	<option value="0" <? if( in_array(0,$profile2_array) ){ print "selected"; } ?>>------</option>

	 <?



		if(!isset($_SESSION['genderid']) || $_SESSION['genderid']==""){ $extra=""; }else{ $extra="|| private = ".strip_tags($_SESSION['genderid']); }



		$SQL = "SELECT id, caption FROM field_groups WHERE ( private = 0 ".$extra." ) ORDER BY forder ASC";



		$gg = $DB->Query($SQL);

		$gg1 = $gg;

		while( $G = $DB->NextRow($gg) ){

		

	?>

       <option value="<?=$G['id'] ?>" <? if( in_array($G['id'],$profile2_array) ){ print "selected"; } ?>><?=$G['caption'] ?></option>

     <? } ?>

     </select>

	<div class="tip"><?=$profile_hint1 ?></div>

</li>

<li>	

	<label><?=$profile_label2 ?></label> 

	<select name="profileview1[]" size="1"  multiple class="input" style="height:150px; width:250px">

	<option value="0" <? if( in_array(0,$profile1_array) ){ print "selected"; } ?>>------</option>

	 <?

 		$gg = $DB->Query($SQL);

		while( $G1 = $DB->NextRow($gg) ){

		

	?>

       <option value="<?=$G1['id'] ?>" <? if( in_array($G1['id'],$profile1_array) ){ print "selected"; } ?>><?=$G1['caption'] ?></option>

     <? } ?>

     </select>

	<div class="tip"><?=$profile_hint2 ?></div>

</li>

 

	<li><input type="submit" value="<?=$GLOBALS['_LANG']['_save'] ?>" class="MainBtn"></li>

</div>

</ul>

</form>


<? }elseif($show_page=="gdpr"){ ?>




<?php } elseif($show_page=="alerts"){ 





	 /**

	 * Page: Settings Email Alerts Page

	 *

	 * @version  8.0

	 * @created  Fri Jan 18 10:48:31 EEST 2008

	 * @updated  Fri Sep 24 16:28:31 EEST 2008

	 */



?>





<form method="post" action="<?=DB_DOMAIN ?>index.php">

<input name="do" type="hidden" value="email_alerts" class="hidden">

<input name="do_page" type="hidden" value="settings" class="hidden">

<input name="sub" type="hidden" value="alerts" class="hidden">



<ul class="form"><div class="CapBody bd_padding_20">

<li>	

	<label><?=$GLOBALS['LANG_SETTINGS']['a17'] ?></label> 

    <input name="email" type="text" value="<?=$privacy_data['email'] ?>" size="40" class="input" maxlength="200">

	<div class="tip"><?=$GLOBALS['LANG_SETTINGS']['a18'] ?></div>

</li>

<li>	

		<label><?=$GLOBALS['LANG_SETTINGS']['a19'] ?></label>
		
		<select name="alert1"><option value="yes"><?=$GLOBALS['_LANG']['_yes'] ?></option><option value="no" <? if($privacy_data['email_msg'] =="no"){ print "selected"; } ?>><?=$GLOBALS['_LANG']['_no'] ?></option></select> 

		<div class="tip"><?=$GLOBALS['LANG_SETTINGS']['a20'] ?></div>

</li>	



<? if (D_WINK == 1) { ?>

<li>

		<label><?=$GLOBALS['LANG_SETTINGS']['a21'] ?></label> <select name="alert2"><option value="yes"><?=$GLOBALS['_LANG']['_yes'] ?></option><option value="no" <? if($privacy_data['email_winks'] =="no"){ print "selected"; } ?>><?=$GLOBALS['_LANG']['_no'] ?></option></select> 

		<div class="tip"><?=$GLOBALS['LANG_SETTINGS']['a22'] ?></div>

</li>

<? } ?>



<? if (D_FRIENDS == 1) { ?>

<li>

		<label><?=$GLOBALS['LANG_SETTINGS']['a23'] ?></label> <select name="alert3"><option value="yes"><?=$GLOBALS['_LANG']['_yes'] ?></option><option value="no" <? if($privacy_data['email_friends'] =="no"){ print "selected"; } ?>><?=$GLOBALS['_LANG']['_no'] ?></option></select>

		<div class="tip"><?=$GLOBALS['LANG_SETTINGS']['a24'] ?></div>

</li>

<? } ?>



<li>

		<label><?=$GLOBALS['LANG_SETTINGS']['a25'] ?></label> <select name="alert4"><option value="yes"><?=$GLOBALS['_LANG']['_yes'] ?></option><option value="no" <? if($privacy_data['email_match'] =="no"){ print "selected"; } ?>><?=$GLOBALS['_LANG']['_no'] ?></option></select>

		<div class="tip"><?=$GLOBALS['LANG_SETTINGS']['a26'] ?></div>

</li>



<li>

		<label><?=$GLOBALS['LANG_SETTINGS']['a27'] ?></label> <select name="alert5"><option value="yes"><?=$GLOBALS['_LANG']['_yes'] ?></option><option value="no" <? if($privacy_data['Notifications'] =="no"){ print "selected"; } ?>><?=$GLOBALS['_LANG']['_no'] ?></option></select>

		<div class="tip"><?=$GLOBALS['LANG_SETTINGS']['a28'] ?></div>

		

</li>



<li>

		<label><?=$GLOBALS['LANG_SETTINGS']['a29'] ?></label> <select name="alert6"><option value="yes"><?=$GLOBALS['_LANG']['_yes'] ?></option><option value="no" <? if($privacy_data['Newsletters'] =="no"){ print "selected"; } ?>><?=$GLOBALS['_LANG']['_no'] ?></option></select>

		<div class="tip"><?=$GLOBALS['LANG_SETTINGS']['a30'] ?></div>

		

</li>



	<li><input type="submit" value="<?=$GLOBALS['_LANG']['_save'] ?>" class="MainBtn"></li>

</div>

</ul>

</form>





































<? }elseif($show_page=="password"){ 



	 /**

	 * Page: Settings Change Password Page

	 *

	 * @version  8.0

	 * @created  Fri Jan 18 10:48:31 EEST 2008

	 * @updated  Fri Sep 24 16:28:31 EEST 2008

	 */



?>

<form method="post" action="<?=DB_DOMAIN ?>index.php"  onSubmit="return CheckNulls2('<?=$GLOBALS['_LANG_ERROR']['_incomplete'] ?>');">

<? if(ADMIN_DEMO !="yes"){ ?>

<input name="do" type="hidden" value="password" class="hidden">

<input name="do_page" type="hidden" value="settings" class="hidden">

<input name="sub" type="hidden" value="password" class="hidden">

<? }else{ ?>

Disabled in demo mode.

<? } ?>

	<ul class="form"><div class="CapBody bd_padding_20 margin_bot_0">	                        

		<li><label><?=$GLOBALS['_LANG']['_current']." ".$GLOBALS['_LANG']['_password'] ?>: </label><input class="input" name="cpassword" type="password" id="b1">

		</li>

		<li><label><?=$GLOBALS['_LANG']['_new']." ".$GLOBALS['_LANG']['_password']; ?>: </label><input class="input" name="npassword" type="password" id="b2">

		</li>

		<li><input type="submit" value="<?=$GLOBALS['_LANG']['_save'] ?>" class="MainBtn"></li>

	</div>

	</ul>



</form>





















<? }elseif($show_page=="cancel"){ 





	 /**

	 * Page: Settings Cancel Account Page

	 *

	 * @version  8.0

	 * @created  Fri Jan 18 10:48:31 EEST 2008

	 * @updated  Fri Sep 24 16:28:31 EEST 2008

	 */



?>







<form method="post" action="<?=DB_DOMAIN ?>index.php">

<input name="do_page" type="hidden" value="settings" class="hidden">

<input name="do" type="hidden" value="cancel" class="hidden">

<input name="sub" type="hidden" value="cancel" class="hidden">



<ul class="form"><div class="CapBody bd_padding_20">



	<li><?=$GLOBALS['LANG_SETTINGS']['a51'] ?></li>

	<li><label><?=$GLOBALS['LANG_SETTINGS']['a52'] ?></label> <div class="box"><input type="checkbox" name="confirm" value="yes" <?=$privacy_cancel ?>></div></li>

	<? if($privacy_cancel=="checked"){ ?><li><font color="#FF0000"><?=$GLOBALS['LANG_SETTINGS']['11'] ?></font></li> <? } ?>

	<input type="submit" value="<?=$GLOBALS['_LANG']['_submit'] ?>"  class="MainBtn">



</div>

</ul>

</form>























<? }elseif($show_page=="sms" && UPGRADE_SMS =="yes"){ 



	 /**

	 * Page: Settings SMS Alerts Page

	 *

	 * @version  8.0

	 * @created  Fri Jan 18 10:48:31 EEST 2008

	 * @updated  Fri Sep 24 16:28:31 EEST 2008

	 */



?>





<form method="post" action="<?=DB_DOMAIN ?>index.php">

<input name="do" type="hidden" value="sms_alerts" class="hidden">

<input name="do_page" type="hidden" value="settings" class="hidden">

<input name="sub" type="hidden" value="sms" class="hidden">



<ul class="form">



<div class="CapBody bd_padding_20">

<li>	

		<label><?=$GLOBALS['LANG_SETTINGS']['a2'] ?></label> 

      	<input name="smsnum" type="text" value="<?=$privacy_data['SMS_number'] ?>" size="40" maxlength="20">

		<div class="tip"><?=$GLOBALS['LANG_SETTINGS']['a3'] ?></div>

</li>



<li>	

		<label><?=$GLOBALS['_LANG']['_country'] ?></label><SELECT name="sms_country"><?=DisplayCountries($privacy_data['SMS_country']) ?> 

		<div class="tip"><?=$GLOBALS['LANG_SETTINGS']['a5'] ?></div>

</li>

<li>	

		<label><?=$GLOBALS['LANG_SETTINGS']['a6'] ?></label> 

		<select name="sms_msg_alert">

		<option value="on"><?=$GLOBALS['_LANG']['_yes'] ?></option>

		<option value="off" <? if($privacy_data['SMS_email'] =="off"){ print "selected"; } ?>><?=$GLOBALS['_LANG']['_no'] ?></option>

		</select>

		<div class="tip"><?=$GLOBALS['LANG_SETTINGS']['a9'] ?></div>

</li>	



<? if (D_WINK == 1) { ?>

<li>	

		<label><?=$GLOBALS['LANG_SETTINGS']['a10'] ?></label> 

		<select name="sms_wink_alert">

		<option value="on"><?=$GLOBALS['_LANG']['_yes'] ?></option>

		<option value="off" <? if($privacy_data['SMS_wink'] =="off"){ print "selected"; } ?>><?=$GLOBALS['_LANG']['_no'] ?></option>

		</select>

		<div class="tip"><?=$GLOBALS['LANG_SETTINGS']['a11'] ?></div>

</li>

<? } ?>



<li> 

		<strong> <?=$GLOBALS['LANG_SETTINGS']['a12'] ?> <?=$privacy_data['SMS_credits'] ?> <?=$GLOBALS['LANG_SETTINGS']['a13'] ?> </strong> 

		<? if(D_FREE =="no"){ ?><br><a href="<?=DB_DOMAIN ?>subscribe"><?=$GLOBALS['LANG_SETTINGS']['a14'] ?></a> <? } ?>

</li>

<li><input type="submit" value="<?=$GLOBALS['_LANG']['_save'] ?>" class="MainBtn"></li>

</div>

</ul>

</form>



<? } ?>

<?php
/* MAIN CLOSE */
if(!isset($HEADER_SINGLE_COLUMN)){ ?></div><div class="clear"></div> <? }else{ print "</div>"; }
?>

</div> <div id="main_wrapper_bottom"></div>
</div>