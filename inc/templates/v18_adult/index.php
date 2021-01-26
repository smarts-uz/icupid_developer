<?php  $fdata = DisplayFeaturedMembers(20);	?>
<style>
#splitpage #main_content_wrapper { background:none; border:0px; width:100%;}
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
div#page_container{width:100%;}
.fullscreen-bg {   position: relative; 
  top: 112px; 
  left: 0; 
  min-width: 100%;
  min-height: 735px}
#page_footer{  position: relative; bottom: -35px; width: 100%;padding:1% 0;}
#page_container{background:none; border-bottom:none;}
#PageHeader{    z-index: 999; position: absolute; width: 100%;}
.flags_table{display:none;}
/*#PageHeader .sub_menu {
    box-shadow: none;
}*/
table.members-search-info td {
    padding: 2% 4%;
}

.right-head {
    float: right;
    text-align: right;
    width: auto;
    margin: 22px 20px 0px 0px;
}
#PageHeader .sub_menu{
   min-height: 52px;
}
.sub_menu{
	background-color:#fff;
}
.sub_tabs{
    padding: 0px 10px;
}
.sub_tabs li{
    padding: 16px 18px 0 16px;
	margin-top:0;
}
.sub_tabs li a{
	line-height:19px;
	padding:0;
	margin:0;
}
.sub_tabs li a span{
	padding-left:0;
	font-size:15px;
}
.onlinenow {
    float: left;
    color: #fff;
    min-width: 145PX;
    margin: 8% 0% 0% 0px;
    width: 100%;
}
.sub_menu .onlinenow a {
    font-size: 15px;
	font-weight:normal;
}
select{
	padding:1%;
	font-size:15px;
}
.members-search-info{
	padding:17px;
}
input.NormBtn, A.NormBtn:hover, input.NormBtn:hover {
    background: #eee none repeat scroll 0 0;
    border: medium none;
    padding: 3%;
    color: #333;
}
.right-head a{
	font-size:15px;
}
div#MenuBar {
    width: 70%;
}
#page_footer ul.footer_tabs {
    width: 100%;
}
td.age_td td {
    padding-left: 0 !important;
}
@media(max-width:700px){

#page_footer {
    position: relative;
}	
}

</style>




<!--<div style="width:1040px;line-height:25px;">
<a href="index.php?dll=register"><img src="inc/templates/<?=D_TEMP ?>/images/but_join.jpg" style="float:right; margin-right:30px;"></a>
 
<h1 style="font-size:37px;font-weight:normal;"><?=TMP_TXT_1 ?></h1><p><?=TMP_TXT_2 ?></p></div>-->

<div class="fullscreen-bg" style=" background:url(inc/templates/<?=D_TEMP ?>/images/visual.jpg) no-repeat;">
    
<div class="content-width">
<div class="members-search">
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
<table class="members-search-info" width="310"  border="0" cellpadding="2" cellspacing="2" style="">
<tr class="first_memtr"><td height="30" colspan="3" style="font-size:25px;color:#ffffff"><?=$LANG_BODY['_member']. " ".$LANG_BODY['_search'] ?></td>
</tr><tr> <td width="122" height="30"><?=$LANG_BODY['_home1'] ?> </td><td colspan="2">
<select name="select"><?=displayGenders() ?></select>
</td></tr><tr><td height="30"><?=$LANG_BODY['_home2'] ?> </td><td colspan="2">
<select name="SeV[2]"><?=displayGenders(1) ?></select>
</td></tr>


<tr>
<td  width="30"><?=$LANG_BODY['_age'] ?></font></td>
<td  colspan="2" class="age_td"><? print DoAge(1); ?></td>
</tr>


<tr>
  <td height="30"><?=$LANG_BODY['_withPics'] ?></td><td width="155"><input type="checkbox" name="Extra[pics]" value="1"> &nbsp;&nbsp;&nbsp;&nbsp; <?=$lang_global_options['13'] ?> </td>
  <td width="50"><input type="checkbox" name="Extra[online]" value="1"></td>
</tr>
<tr>
  <td height="30">&nbsp;</td>
<td height="30" colspan="2" >
<input type="submit" name="submit" value="&nbsp;&nbsp;<?=$LANG_BODY['_search'] ?>&nbsp;&nbsp;" class="NormBtn"  style="font-size:16px;">
</td>
</tr>
</table>
</form>
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