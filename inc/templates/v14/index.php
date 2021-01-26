<?  $fdata = DisplayFeaturedMembers(20);	?>
<style>
#splitpage #main_content_wrapper { background: #ffffff; border:0px;}
#splitpage #main_wrapper_bottom {	background: #ffffff;}
.Home_ImageBar { background: url('inc/templates/<?=D_TEMP ?>/images/index_imagebox.jpg'); border-bottom:2px solid #929091; height:180px; }
#style4 ul li { color:white; }
#style4 .previous_button {  background: url(inc/templates/<?=D_TEMP ?>/images/ho2.jpg) no-repeat; width:38px; height:137px;  }
#style4 .previous_button_over {  background: url(inc/templates/<?=D_TEMP ?>/images/ho2.jpg) no-repeat; width:38px; height:137px; }
#style4 .previous_button_disabled {  background: url(inc/templates/<?=D_TEMP ?>/images/ho2.jpg) no-repeat; width:38px; height:137px; }
#style4 .next_button {   background: url(inc/templates/<?=D_TEMP ?>/images/ho2b.jpg) no-repeat; width:38px; height:137px; }
#style4 .next_button_over {  background: url(inc/templates/<?=D_TEMP ?>/images/ho2b.jpg) no-repeat; width:38px; height:137px; }
#style4 .next_button_disabled {  background: url(inc/templates/<?=D_TEMP ?>/images/ho2b.jpg) no-repeat; width:38px; height:137px; }
.steps { font-size:16px; color:#DA0303;}

.menu {  background: #E5329B;border-top:2px solid white; }
ul.tabs { float:left;}

</style>


<div style="width:940px; height:370px; background: url('inc/templates/<?=D_TEMP ?>/images/index_backdrop.jpg') bottom no-repeat;margin:0px;padding:0px;margin-top:20px;">
<div style="background: url('inc/templates/<?=D_TEMP ?>/images/welcome.png') bottom left no-repeat;margin:0px; padding:0px; height:370px;">
<div style="width:940px;line-height:25px;">
<a href="index.php?dll=register"><img src="inc/templates/<?=D_TEMP ?>/images/but_join.jpg" style="float:right; margin-right:30px;"></a>
 
<h1 style="font-size:37px;font-weight:normal;"><?=TMP_TXT_1 ?></h1><p><?=TMP_TXT_2 ?></p></div>
<div class="ClearAll"></div>
<div style="margin-top:30px; margin-left:550px; padding:10px; width:300px;">
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
<table width="300"  border="0" cellpadding="0" cellspacing="0" style="color:white;">
<tr valign="top"><td height="30" colspan="3" style="font-size:25px;color:#ffffff"><?=$LANG_BODY['_member']. " ".$LANG_BODY['_search'] ?></td>
</tr><tr> <td width="122" height="30"><?=$LANG_BODY['_home1'] ?> </td><td colspan="2">
<select name="select"><?=displayGenders() ?></select>
</td></tr><tr><td height="30"><?=$LANG_BODY['_home2'] ?> </td><td colspan="2">
<select name="SeV[2]"><?=displayGenders(1) ?></select>
</td></tr>


<tr>
<td  width="30"><?=$LANG_BODY['_age'] ?></font></td>
<td  colspan="2"><? print DoAge(1); ?></td>
</tr>


<tr>
  <td height="30"><?=$LANG_BODY['_withPics'] ?></td><td width="140"><input type="checkbox" name="Extra[pics]" value="1"> &nbsp;&nbsp;&nbsp;&nbsp; <?=$lang_global_options['13'] ?> </td>
  <td width="65"><input type="checkbox" name="Extra[online]" value="1"></td>
</tr>
<tr>
  <td height="30">&nbsp;</td>
<td height="30" colspan="2" valign="bottom">
<input type="submit" name="submit" value="&nbsp;&nbsp;<?=$LANG_BODY['_search'] ?>&nbsp;&nbsp;" class="NormBtn"  style="font-size:16px;">
</td>
</tr>
</table>
</form>

</div>
</div>
</div> 

 
<table width="940" border="0" class="Home_ImageBar"><tr valign="top"><td width="546">


<div id="style4" style="margin-left:30px;margin-top:20px;">
<div class="previous_button"></div><div class="container">
<ul> 
<?  foreach( $fdata as $value){ ?>
<li><a href="<?=$value['link'] ?>"><img src="<?=$value['image'] ?>" width="96" height="96" border="0" style="cursor:pointer;"></a><br>
<strong><?=$value['username'] ?></strong></li><? } ?>
<?  foreach( $fdata as $value){ ?>
<li><a href="<?=$value['link'] ?>"><img src="<?=$value['image'] ?>" width="96" height="96" border="0" style="cursor:pointer;"></a><br>
<strong><?=$value['username'] ?></strong></a></li><? } ?>

</ul>

</div>
<div class="next_button"></div></div><script>function runTest() {  hCarousel = new UI.Carousel("style4");     }  Event.observe(window, "load", runTest); </script>

</td><td width="384" style="padding:15px;">

<span style="font-size:21px;color:#ffffff; height:45px; margin-top:25px;"><?=TMP_TXT_3 ?></span>
<p style="color:white;"><?=TMP_TXT_4 ?></p>
<p><a href="index.php?dll=register" style="color:white;"><?=$LANG_WELCOME['_join2'] ?></a></p>

</td></tr></table>


<table width="940"  border="0" cellpadding="0" cellspacing="2"><tr><td width="310" height="252" valign="top" class="inner_nav_body" style="border:0px;padding:20px;">

<div style="font-size:21px;color:#666666; height:45px;"><?=$LANG_WELCOME['1'] ?></div>
<div class="ClearAll"></div>
<? $bdata = DisplayTop10Articles(1);   ?>
<b><?=(isset($bdata[1]['title'])) ? $bdata[1]['title'] : ''; ?></b>
<p><?=(isset($bdata[1]['content'])) ? $bdata[1]['content'] : ''; ?></p>
<b><a href="<?=$bdata[1]['link'] ?>" style="text-decoration:none;"><img src="images/DEFAULT/_acc/comments.png" width="16" height="16" align="absmiddle" border="0"> <?=$LANG_WELCOME['2'] ?></a></b>

</td>
<td width="312" valign="top" class="inner_nav_body" style="border:0px;padding:20px;">
 
<span style="font-size:21px;color:#666666; height:45px; margin-top:25px;"><?=$LANG_WELCOME['3'] ?></span>

<ul style="line-height:30px;margin-top:20px;color:#CF0079;">
<a href="index.php?dll=register"><img src="inc/templates/<?=D_TEMP ?>/images/home_join.png" border="0" style="float:right;"></a>
<li class="steps"><?=$LANG_WELCOME['4'] ?></li>
<li class="steps"><?=$LANG_WELCOME['5'] ?></li>
<li class="steps"><?=$LANG_WELCOME['6'] ?></li>
</ul><br>
<p><?=$LANG_WELCOME['7'] ?></p>


</td><td width="310" valign="top" class="inner_nav_body" style="border:0px;padding:20px;">

<div style="font-size:21px;color:#666666; height:45px;"><?=$LANG_WELCOME['8'] ?></div>
<div class="ClearAll"></div>
<img src="inc/templates/<?=D_TEMP ?>/images/people.png" border="0" style="float:right;">
<p><?=$LANG_WELCOME['9'] ?></p>

<ul style="line-height:30px;">

	<li><img src="images/DEFAULT/_acc/zoom.png" align="absmiddle"> <a href="index.php?dll=search&page=1"><?=$GLOBALS['_LANG']['_viewAll'] ?> <?=$GLOBALS['_LANG']['_members'] ?></a></li>
 	<li><img src="images/DEFAULT/_acc/zoom.png" align="absmiddle"> <a href="#" onclick="MakeSearchOptions(0,0,0,1,0,0,0); return false;"><?=$GLOBALS['_LANG']['_online'] ?> <?=$GLOBALS['_LANG']['_members'] ?></a></li>
	<li><img src="images/DEFAULT/_acc/zoom.png" align="absmiddle"> <a href="#" onclick="MakeSearchOptions(1,0,0,0,0,0,0); return false;"><?=$GLOBALS['_LANG']['_latest'] ?> <?=$GLOBALS['_LANG']['_members'] ?></a></li>
	<li><img src="images/DEFAULT/_acc/zoom.png" align="absmiddle"> <a href="#" onclick="MakeSearchOptions(0,0,0,0,0,1,0); return false;"><?=$GLOBALS['LANG_COMMON'][18] ?></a></li>
 
</ul>

<script>
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
</script>

</td></tr></table>
	<form class="clearfix" action="<?=DB_DOMAIN ?>index.php?dll=search&view_page=1" method="POST" name="QuickSearch" id="QuickSearch">          
		<input name="do_page" 	type="hidden" 			value="search" class="hidden">
		<input type="hidden" 	name="page" 			value="1" class="hidden">
		<input type="hidden" 	name="Extra[newtoday]" 	value="0" class="hidden"	id="se_newtoday">
		<input type="hidden" 	name="Extra[favorite]" 	value="0" class="hidden"	id="se_favorite">
		<input type="hidden" 	name="Extra[birthday]" 	value="0" class="hidden" 	id="se_birthday">
		<input type="hidden" 	name="Extra[online]" 	value="0" class="hidden" 	id="se_onlinenow">
		<input type="hidden" 	name="Extra[pics]" 		value="0" class="hidden" 	id="se_pics">
		<input type="hidden" 	name="Extra[featured]" 	value="0" class="hidden" 	id="se_featured">
		<input type="hidden" 	name="Extra[highlighted]" value="0" class="hidden" 	id="se_highlight">
		<input type="hidden" 	name="SeN[1]" 	value="0" class="hidden">
		<input type="hidden" 	name="SeV[1]" 	value="0" class="hidden">
		<input type="hidden" 	name="SeT[1]" 	value="0" class="hidden">
	</form>