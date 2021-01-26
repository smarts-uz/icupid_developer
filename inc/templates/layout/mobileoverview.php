<?
## block direct page access
defined( 'KEY_ID' ) or die( 'Restricted access' );

if($GLOBALS['MyProfile']['status'] ==""){ $GLOBALS['MyProfile']['status'] = D_STATUSMSG; }

?>
 <div class="TopLogin"><div style="float:right;"><? foreach($BANNER_ARRAY as $banner){ if($banner['position'] =="middle"){ print $banner['display'];}} ?></div><span><?=$PageTitle ?></span></div><br>



 




<? if($show_page=="home"){ ?>


<div class="menu_box_body1" id="s1"> 

<div class="overviewBox22">

<table width="320"  border="0">

<tr><td width="110" valign="top" style="font-size:12px;line-height:24px;">

<div style="margin-left:5px;">
<img src="<?=$GLOBALS['MyProfile']['image'] ?>&x=96&y=96" border="0" width="95" height="95" style="margin-top:17px;border:4px solid #dddddd;">

</div>

</td>
<td width="264" valign="top">

  <div style="font-size:18px; margin-top:20px;"><?=$GLOBALS['LANG_OVERVIEW']['92'] ?> <br> <?=$_SESSION['username'] ?></div>
  <br>
  <div id="ProfileComplete" style="margin-left:1px;">
	  <dl>
		  <dt> <a href="<?=DB_DOMAIN ?>mobile.php?dll=mobileaccount&sub=edit" style="font-size:12px; text-decoration:none;"><?=$GLOBALS['_LANG']['_CompleteProfile'] ?><br> (<?=$GLOBALS['MyProfile']['profile_complete'] ?>%) <img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/pencil.png" width="16" height="16" align="right"></a></dt>
		  
	  </dl>
    </div>

</td>

</tr>
<tr>

<td colspan="2" width="295" valign="top" style="font-size:14px;">


<div style="margin-top:15px;"></div>

<span style="margin-left:30px;"><b><?=$GLOBALS['_LANG']['_alert1'] ?></b></span>

<ul style="line-height:26px; margin-left:15px;margin-top:5px;font-size:11.5px;">


	<? if(D_MESSAGES ==1){ ?><li><a href="<?=DB_DOMAIN ?>mobile.php?dll=mobilemessages&sub=inbox" style="text-decoration:none;font-size:14px;"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/m_3.png" align="absmiddle"> <?=$MyAlertsArray[1]['total'] ?> <?=$GLOBALS['LANG_COMMON'][39] ?></a></li><? } ?>
	<? if(D_COMMENTS ==222){ ?><li><a href="<?=DB_DOMAIN ?>mobile.php?dll=account&sub=comments" style="text-decoration:none;"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/m_2.png" align="absmiddle"> <?=$MyAlertsArray[3]['total'] ?> <?=$GLOBALS['LANG_COMMON'][41] ?></a></li><? } ?>
	<? if(D_FRIENDS ==222){ ?><li><a href="<?=DB_DOMAIN ?>mobile.php?dll=friends" style="text-decoration:none;"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/m_4.png" align="absmiddle"> <?=$MyAlertsArray[2]['total'] ?> <?=$GLOBALS['LANG_COMMON'][40] ?></a></li><? } ?>
	<? if(UPGRADE_SMS =="yes222"){ ?><li><a href="<?=DB_DOMAIN ?>mobile.php?dll=settings&sub=sms" style="text-decoration:none;"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/m_5.png" align="absmiddle"> <?=$GLOBALS['MyProfile']['SMS_credits'] ?> <?=$LANG_SETTINGS['a13'] ?></a></li> <? } ?>
	<li><a href="<?=DB_DOMAIN ?>mobile.php?dll=mobilesearch&page=1&online=1" style="text-decoration:none;font-size:14px;"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/m_1.png" align="absmiddle">    <?=$HEADER_MEMBERS_ONLINE ?>     <?=$GLOBALS['_LANG']['_members'] ?>  <?=$GLOBALS['_LANG']['_online'] ?></a></li>

</ul>   


<? if(D_FREE =="no"){ ?>
<br>
<a href="<?=DB_DOMAIN ?>mobile.php?dll=mobilesubscribe" class="MainBtn" style="font-size:16px;padding-right:65px;">  
<?=$GLOBALS['LANG_OVERVIEW']['51'] ?></a>
<? } ?>

<br><br>
<a href="<?=DB_DOMAIN ?>mobile.php?dll=mobileoverview&sub=viewed" class="MainBtn" style="font-size:16px;">  
<?=$GLOBALS['LANG_OVERVIEW']['a21'] ?></a>

<br><br>
<a href="<?=DB_DOMAIN ?>mobile.php?dll=mobileaccount&sub=view" class="MainBtn" style="font-size:16px;padding-right:70px;">  
<?=$GLOBALS['_LANG']['_view'] ?> <?=$GLOBALS['_LANG']['_my'] ?> <?=$GLOBALS['_LANG']['_profile'] ?></a>

<br><br>
<a href="<?=DB_DOMAIN ?>mobile.php?dll=mobileaccount&sub=edit" class="MainBtn" style="font-size:16px;padding-right:75px;">  
<?=$GLOBALS['_LANG']['_edit'] ?> <?=$GLOBALS['_LANG']['_my'] ?> <?=$GLOBALS['_LANG']['_profile'] ?></a>

<? if(D_FRIENDS ==1){ ?>
<br><br>
<a href="<?=DB_DOMAIN ?>mobile.php?dll=friends&sub=edit" class="MainBtn" style="font-size:16px;padding-right:75px;">  
<?=$GLOBALS['_LANG']['_my'] ?> <?=$GLOBALS['_LANG']['_friendsList'] ?></a>
<? } ?>

<br><br>

</td></tr></table>

<div class="ClearAll"></div>
</div>
</div>

<? } ?>

 
<? if($show_page=="home"){ 

	 /**
	 * Page: Overview Page
	 *
	 * @version  9.0
	 * @created  Fri Jan 18 10:48:31 EEST 2008
	 * @updated  Fri Sep 24 16:28:31 EEST 2008
	 */

?>





<br>
<div class="menu_box_title1"><?=$lang_overview_page[90] ?> - <? $ff = MatchCount(); if($ff != 0 && $ff != '0'){ print $ff." ". $GLOBALS['_LANG']['_results']; } ?> [ <a href="<?=DB_DOMAIN ?>mobile.php?dll=mobilesettings&sub=settings"><?=$GLOBALS['_LANG']['_edit']; ?></a> ]</div>
<div class="menu_box_body1" id="s1"> 

<table width="300" border="0"><tr>

<?  if(!empty($MemberMatches)){ ?>

  <? $i=1; foreach($MemberMatches as $value){ if($i ==2){ print "</tr> <tr>"; $i=1;} ?>
  <td><div class="BorderBox1"><table width="200" border="0"><tr valign="top">
  <td width="80"><a href="<?=$value['link'] ?>"><img src="<?=$value['image'] ?>" class="img_border" width="48" height="48"></a></td>
  <td width="129" height="70" style="font-size:12px;"> <b><?=$value['username'] ?></b> <br> 
  <?=$value['gender'] ?> / <? if($value['age'] != 35){ ?><?=$value['age'] ?> <br> <? } ?> <?=$value['country'] ?></td>
  </tr></table></div></td>
  <? $i++; } ?>

<?  } else  { ?>
<br>
<a href="<?=DB_DOMAIN ?>mobile.php?dll=mobilesettings&sub=settings"><?=$GLOBALS['_LANG']['_edit']; ?>  <?=$GLOBALS['LANG_OVERVIEW']['63'] ?></a>
<br><br><br>
<? } ?>

</tr></table>

<?  if(!empty($MemberMatches)){ ?>

 <form method="POST" name="MemberSearch1" action="<?=DB_DOMAIN ?>mobile.php?dll=mobilesearch&view_page=1">               
<input name="do" type="hidden" value="add" class="hidden">            
<input name="do_page" type="hidden" value="mobilesearch" class="hidden">
<input type="hidden" name="page" value="1" class="hidden">
<input type="hidden" name="Extra[zero]" value="1" class="hidden">
<input  class="MainBtn" type="submit" value="<?=$GLOBALS['_LANG']['_search'] ?> <?=$lang_overview_page[90] ?>" style="font-size:16px;">
<input type="hidden" name="Extra[match]" value="1">
</form>

<?  } ?>


</div>











<? }elseif($show_page=="viewed"){

	 /**
	 * Page: Whos viewed my profile
	 *
	 * @version  9.0
	 * @created  Fri Jan 18 10:48:31 EEST 2008
	 * @updated  Fri Sep 24 16:28:31 EEST 2008
	 */

 ?>



<form method="post" action="<?=DB_DOMAIN ?>mobile.php" name="box">
<input name="do" type="hidden" value="history" class='hidden'>
  <table width=660  border=0 align="center" cellpadding=4 cellspacing=1 bgcolor=#999999>
    <?=$table_view; ?>
</table>
</form>




<? } ?>
