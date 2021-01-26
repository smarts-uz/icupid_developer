<?  

	$fdata = DisplayFeaturedMembers(8);	
	 
?>
<style>
#splitpage #main_content_wrapper { background: #ffffff; border:0px;}
#splitpage #main_wrapper_bottom {	background: transparent;}
#top_banner img { margin-right:40px;}
a.eMeeting1 {background:url(<?=$fdata[1]['image']; ?>);}
a.eMeeting2 {background:url(<?=$fdata[2]['image']; ?>);}
a.eMeeting3 {background:url(<?=$fdata[3]['image']; ?>);}
a.eMeeting4 {background:url(<?=$fdata[4]['image']; ?>);}
a.eMeeting5 {background:url(<?=$fdata[5]['image']; ?>);}
a.eMeeting6 {background:url(<?=$fdata[6]['image']; ?>);}
a.eMeeting7 {background:url(<?=$fdata[7]['image']; ?>);}
a.eMeeting8 {background:url(<?=$fdata[8]['image']; ?>);}

#bottomBar {
    background: #8E7D9F url('../../../inc/templates/v10_purple/images/bottom.jpg') bottom no-repeat;
}

#bottomBar .col1 {
    width: 33%;
}
#bottomBar .col2 {
    width: 35%;
}
#bottomBar .col3 {
    width: 27%;
}
#bottomBar .col1, #bottomBar .col2, #bottomBar .col3 {
    background: none;
}
div#PageHeader {
    background-color: transparent !important;
}
.menu {   background: #3A5461 url('../../../inc/templates/v10_purple/images/menu_bg.jpg') no-repeat; height:60px; margin:0px; padding:0px; }
ul.tabs{ float:left;}
.sub_tabs li a{
	color:#fff;
}
#page_footer .footer_tabs li a{
	color:#333;
}
#page_footer .content-width {
    width: 940px;
    margin: 0 auto;
}
</style>
 

<div id="slider_div"></div>
<img src="inc/templates/<?=D_TEMP ?>/images/txt_1.png" style="margin-left:15px; margin-top:15px;">
<ul id="three_col"  style="margin-left:15px; padding-top:20px;">
<li class="eMeeting">
<form method="post" name="MemberSearch" action="index.php?dll=search&view_page=1">               
<input name="do" type="hidden" value="add" class="hidden">            
<input name="do_page" type="hidden" value="search" class="hidden">
<input type="hidden" name="page" value="1" class="hidden">
<input type="hidden" name="Extra[zero]" value="1" class="hidden">
<input name='TotalNumberOfRows' type='hidden' value='3' class='hidden'>               
<input type='hidden' name='SeN[1]' value='country' class='hidden'>
<input type='hidden' name='SeT[1]' value='3' class='hidden'>
<input type='hidden' name='SeN[2]' value='gender' class='hidden'>
<input type='hidden' name='SeT[2]' value='3' class='hidden'>
<table width="300"  border="0" cellpadding="0" cellspacing="0"><tr> <td width="95" height="30" style="color:white; font-weight:bold;"><?=$LANG_BODY['_home1'] ?> </td><td width="205">
<select name="select"><?=displayGenders() ?></select>
</td></tr><tr><td height="30" style="color:white; font-weight:bold;"><?=$LANG_BODY['_home2'] ?> </td><td>
<select name="SeV[2]"><?=displayGenders(1) ?></select>
</td></tr>
<tr><td height="30">&nbsp;</td><td><br><input type="image" src="inc/templates/<?=D_TEMP ?>/images/btn_search.gif"></td></tr></table>
</form>
</li>
<li class="fitting"><a href="index.php?dll=register"><img src="inc/templates/<?=D_TEMP ?>/images/fitting.jpg"  width="255" border="0" height="146" style="margin-left:5px;"></a></li>
<li class="offer"><a href="index.php?dll=tour"><img src="inc/templates/<?=D_TEMP ?>/images/offer.jpg" width="255" border="0" height="146"></a></li>
</ul>


<div class="ClearAll"></div>


<div id="save_area" style="margin-top:20px; margin-left:15px">

<div id="save_area_selection">
<div class="eMeeting_thumbs">
<a class="save_area_gallery eMeeting1" href="<?=$fdata[1]['link']; ?>"><em><img src="<?=$fdata[1]['image']; ?>"></em></a>
<a class="save_area_gallery eMeeting2" href="<?=$fdata[2]['link']; ?>"><em><img src="<?=$fdata[2]['image']; ?>"></em></a>
<a class="save_area_gallery eMeeting3" href="<?=$fdata[3]['link']; ?>"><em><img src="<?=$fdata[3]['image']; ?>"></em></a>
<a class="save_area_gallery eMeeting4" href="<?=$fdata[4]['link']; ?>"><em><img src="<?=$fdata[4]['image']; ?>"></em></a>
<a class="save_area_gallery eMeeting5" href="<?=$fdata[5]['link']; ?>"><em><img src="<?=$fdata[5]['image']; ?>"></em></a>
<a class="save_area_gallery eMeeting6" href="<?=$fdata[6]['link']; ?>"><em><img src="<?=$fdata[6]['image']; ?>"></em></a>
<a class="save_area_gallery eMeeting7" href="<?=$fdata[7]['link']; ?>"><em><img src="<?=$fdata[7]['image']; ?>"></em></a>
<a class="save_area_gallery eMeeting8" href="<?=$fdata[8]['link']; ?>"><em><img src="<?=$fdata[8]['image']; ?>"></em></a>
</div>
<a href="index.php?dll=register"><h1>Create your free online account today!</h1></a>

<div class="ClearAll"></div>
<img src="inc/templates/<?=D_TEMP ?>/images/txt_3.png"  style="margin-top:20px;">
<div id="choose_area_bottom">
<div id="choose_area_1">
<p><?=TMP_TXT_5 ?></p>
<p><?=TMP_TXT_6 ?></p>
</div>

	<div id="choose_area_2">
		<ul>
			<li>100% Free Website</li>
			<li>Live Chatrooms</li>
			<li>Video Profiles</li>
			<li>Photo and Music Albums</li>
			<li>Community Forum</li>
			<li class="bottom">Get started today!</li>
		</ul>
	</div>
</div>
</div>

<div class="ClearAll"></div>
<br><br>

<script type="text/javascript" src="inc/js/swfobject.js"> </script>
<script type="text/javascript">
		var so = new SWFObject("inc/exe/flash/home_slider940.swf", "slideshow", "940", "260", "0", "#ffffff");
		so.addParam("quality", "high");
		so.addParam("menu", "false");
		so.addParam("loop", "false");
		so.addParam("scale", "noscale");
		so.write("slider_div");
</script>
</div>