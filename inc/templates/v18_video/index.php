<?php  $fdata = DisplayFeaturedMembers(20);	?>
<style>
#splitpage #main_content_wrapper { background:none; border:0px; width:100%}
#splitpage #main_wrapper_bottom {	background: #ffffff;}
.Home_ImageBar { background-color:#373737; border-radius: 28px; }
#style4 ul li { color:white; }
#style4 .previous_button {  background: url(inc/templates/<?=D_TEMP ?>/images/ho2.jpg) no-repeat; width:38px; height:137px;  }
#style4 .previous_button_over {  background: url(inc/templates/<?=D_TEMP ?>/images/ho2.jpg) no-repeat; width:38px; height:137px; }
#style4 .previous_button_disabled {  background: url(inc/templates/<?=D_TEMP ?>/images/ho2.jpg) no-repeat; width:38px; height:137px; }
#style4 .next_button {   background: url(inc/templates/<?=D_TEMP ?>/images/ho2b.jpg) no-repeat; width:38px; height:137px; }
#style4 .next_button_over {  background: url(inc/templates/<?=D_TEMP ?>/images/ho2b.jpg) no-repeat; width:38px; height:137px; }
#style4 .next_button_disabled {  background: url(inc/templates/<?=D_TEMP ?>/images/ho2b.jpg) no-repeat; width:38px; height:137px; }
.steps { font-size:16px; color:#DA0303;}
#page_container{border:none;}
#page_footer{    height: 100px; position: absolute; bottom: 0; width: 100%;}
.fullscreen-bg { position: fixed; top: 0; right: 0; bottom: 0; left: 0; overflow: hidden; z-index: -100;}
.fullscreen-bg__video { position: absolute; top: 0; left: 0; width: 100%; height: 100%;}
#page_container{background:none; border-bottom:none;}
.flags_table{display:none;}
.footer-banner-add{
	display:none;
}
.footer_tabs a{
	color:#fff;
}

.right-head {
    float: right;
    text-align: right;
    width: auto;
}

#PageHeader{
	float:left;
}

#PageHeader .sub_menu {
    min-height: 52px;
	background-color:#fff;
}
.sub_tabs{
	float:left;
	padding:0 10px;
}
.sub_tabs li {
    margin-top: 0;
    padding: 16px 18px 0 16px;
}
.sub_tabs li a {
    line-height: 19px;
    margin: 0;
    padding: 0;
}
.sub_tabs li a span {
    font-size: 15px;
    padding-left: 0;
}
.onlinenow {
    color: #fff;
    float: left;
    margin: 8% 0 0 0;
    min-width: 145px;
    width: 100%;
}
.sub_menu .onlinenow a {
    font-size: 15px;
    font-weight: normal;
}


@media (min-aspect-ratio: 16/9) {
  .fullscreen-bg__video {
    height: 300%;
    top: -100%;
  }
}

@media (max-aspect-ratio: 16/9) {
  .fullscreen-bg__video {
    width: 300%;
    left: -100%;
  }
}


</style>


<div class="home-content">
<div class="home-content-banner">
<!--<div style="width:1040px;line-height:25px;">
<a href="index.php?dll=register"><img src="inc/templates/<?=D_TEMP ?>/images/but_join.jpg" style="float:right; margin-right:30px;"></a>
 
<h1 style="font-size:37px;font-weight:normal;"><?=TMP_TXT_1 ?></h1><p><?=TMP_TXT_2 ?></p></div>-->
<div class="content-width">

<form method="post" name="MemberSearch" action="index.php?dll=search&view_page=1">
<input name="do" type="hidden" value="add" class="hidden"/>            
<input name="do_page" type="hidden" value="search" class="hidden"/>
<input type="hidden" name="page" value="1" class="hidden"/>
<input type="hidden" name="Extra[zero]" value="1" class="hidden"/>
<input name="TotalNumberOfRows" type="hidden" value="3" class="hidden"/>               
<input type="hidden" name="SeN[1]" value="country" class="hidden"/>
<input type="hidden" name="SeT[1]" value="3" class="hidden"/>
<input type="hidden" name="SeN[2]" value="gender" class="hidden"/>
<input type="hidden" name="SeT[2]" value="3" class="hidden"/>
<input type="hidden" name="SeN[3]" value="em_85820081128" class="hidden"/>
<input type="hidden" name="SeT[3]" value="3" class="hidden"/>
<table class="members-search-info" width="400"  border="0" cellpadding="2" cellspacing="2">
<tr>
	<td height="30" colspan="3" style="font-size:25px;color:#ffffff"><?=$LANG_BODY['_member']. " ".$LANG_BODY['_search'] ?></td>
</tr>
<tr>
	<td width="122" height="30"><?=$LANG_BODY['_home1'] ?> </td>
	<td colspan="2">
		<select name="select"><?=displayGenders() ?></select>
	</td>
</tr>
<tr>
	<td height="30"><?=$LANG_BODY['_home2'] ?> </td>
	<td colspan="2">
		<select name="SeV[2]"><?=displayGenders(1) ?></select>
	</td>
</tr>

<tr>
	<td  width="30"><?=$LANG_BODY['_age'] ?></font></td>
	<td colspan="2"><? print DoAge(1); ?></td>
</tr>

<tr>
	<td height="30"><?=$LANG_BODY['_withPics'] ?></td>
	<td width="140"><input type="checkbox" name="Extra[pics]" value="1"> &nbsp;&nbsp;&nbsp;&nbsp; <?=$lang_global_options['13'] ?> </td>
	<td width="65"><input type="checkbox" name="Extra[online]" value="1"></td>
</tr>
<tr>
	<td height="30">&nbsp;</td>
	<td height="30" colspan="2" >
		<input type="submit" name="submit" value="<?=$LANG_BODY['_search'] ?>" class="NormBtn"  style="font-size:16px;"/>
	</td>
</tr>
</table>
</form>
</div>
<div class="fullscreen-bg">
    <video loop muted autoplay poster="img/videoframe.jpg" class="fullscreen-bg__video">
        <source src="inc/templates/<?=D_TEMP ?>/images/visual.webm" type="video/webm">
        <source src="inc/templates/<?=D_TEMP ?>/images/visual.mp4" type="video/mp4">
        <source src="inc/templates/<?=D_TEMP ?>/images/visual.ogv" type="video/ogg">
    </video>
    
</div>
</div>
</div>


 
</div>
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
<script>
document.getElementById("side").style.float = "right";
</script>