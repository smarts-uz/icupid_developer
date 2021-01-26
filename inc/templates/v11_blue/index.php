`<?  $fdata = DisplayFeaturedMembers(15);	?>
<style>#splitpage #main_content_wrapper { background: #ffffff; border:0px;}#splitpage #main_wrapper_bottom {	background: #ffffff;}

.menu {   background: #3A5461 url('../../../inc/templates/v11_blue/images/menu_bg.jpg') no-repeat; height:60px; margin:0px; padding:0px; }

#bottomBar{	background: #67869D url('../../../inc/templates/v11_blue/images/bottom.jpg') bottom no-repeat; }

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
.onlinenow a{
	color:#fff;
}


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
<div style="width:900px; height:295px; background: url('inc/templates/<?=D_TEMP ?>/images/welcome.jpg') bottom no-repeat; padding:20px;">
<div style="width:750px;line-height:26px;"><h1 style="font-size:37px;font-weight:normal;"><?=TMP_TXT_1 ?></h1><p><?=TMP_TXT_2 ?></p></div>
<div class="ClearAll"></div>
<div style="margin-top:40px; margin-left:30px; padding:10px; width:300px;">
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
<input type='hidden' name='SeN[3]' value='em_85820081128' class='hidden'>
<input type='hidden' name='SeT[3]' value='3' class='hidden'>
<table width="300"  border="0" cellpadding="0" cellspacing="0"><tr valign="top"><td height="26" colspan="2" style="font-size:24px;color:#666666"><?=$GLOBALS['_LANG']['_member']." ".$GLOBALS['_LANG']['_search'] ?></td>
</tr><tr> <td width="95" height="28"><?=$GLOBALS['_LANG']['_home1'] ?></td><td width="205">
<select name="select"><?=displayGenders() ?></select>
</td></tr><tr><td height="30"><?=$GLOBALS['_LANG']['_home2'] ?> </td><td>
<select name="SeV[2]"><?=displayGenders(1) ?></select>
</td></tr>
<tr><td height="30">&nbsp;</td><td>
<input type="submit" name="submit" value="&nbsp;&nbsp;<?=$LANG_BODY['_search'] ?>&nbsp;&nbsp;" 
       class="NormBtn"  style="font-size:16px;color:black;">
</td></tr>

</table></form>
</div></div> 
<table width="940"  border="0" cellpadding="0"><tr><td width="586" height="252" class="inner_nav_body" style="border:0px;"><br>
<a href="index.php?dll=register"><img src="inc/templates/<?=D_TEMP ?>/images/but_join.jpg" style="float:right; margin-right:30px;"></a>
<span style="font-size:21px;color:#666666; height:45px; margin-left:50px;"><?=$GLOBALS['_LANG']['_featured']." ".$GLOBALS['_LANG']['_members'] ?></span>
<div id="style3" style="margin-left:30px;margin-top:20px;">
<div class="previous_button"></div><div class="container">
<ul> <?  foreach( $fdata as $value){ ?>
<li><a href="<?=$value['link'] ?>"><img src="<?=$value['image'] ?>" width="96" height="96" border="0" style="cursor:pointer;"></a><br>
<strong><?=$value['username'] ?></strong><br><?=$value['gender'] ?>/<?=$value['age'] ?><br><br><a href="<?=$value['link'] ?>"><small style="line-height:15px;padding-top:5px; font-size:11px;"><em>
<?=substr($value['headline'],0,30) ?>..</em></small></a></li><? } ?></ul></div>
<div class="next_button"></div></div><script>function runTest() {  hCarousel = new UI.Carousel("style3");     }  Event.observe(window, "load", runTest); </script></td></tr></table>
</div>