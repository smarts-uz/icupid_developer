<?php  $fdata = DisplayFeaturedMembers(20);	?>
<style>
div#PageHeader {
    width: 59%;
    float: none;
}
.wide_wrapper {top:61px;margin-bottom: 0px;}
body#splitpage{background:#66c3ee;}
#splitpage #main_content_wrapper { background:#66c3ee; border:0px; width:100%;overflow: hidden;}
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
#page_container{width:100%;}
.fullscreen-bg {   position: fixed; 
  top: 0; 
  left: 0; 
  min-width: 100%;
  min-height: 100%;}
#MainPageBackground #page_container{background:none; border-bottom:none; margin-bottom:6px; width:100%;}
.flags_table{display:none;}
.sub_menu, .top-menu{ display:none;}
.login{ text-align:center; margin:30px 0px;}
.login a{ border:1px solid #fff; padding:11px 21px; display:inline-block; text-decoration:none; font-weight: bold; color:#fff; width:120px;}
.login a:first-child{margin-right:50px;}
select#lang {padding: 6px;}
.content-width {
    width: auto;
}
div#myModal {
    display: none;
}
.right-head {
    width: auto;
    line-height: 25px;
    margin-top: 34px;
    float: right;
    margin-right: 10px;
    float: right;
}
div#copyright_bar {
    width: 100%;
}
@media (max-width:1025px){
div#PageHeader {
    width: 88%;
}
}
@media (max-width:786px){
div#PageHeader { width: 96%;}
}
@media (max-width:720px){
.footer-banner-add img {
    width: 100%;
}
}
@media (max-width:550px){
div#PageHeader { width: 100%;}
.logo_height {
    width: 100%;
    float: none;
    text-align: center;
    margin: 0 auto;
}
#PageHeader div#ImageLogo {
    width: 100%;
	margin: 0 auto;
    background-position: center;
}
#PageHeader .right-head {
    float: none;
    margin: 0 auto;
    padding: 7px 0 20px 0px;
    text-align: center;
    width: 100%;
}
#splitpage #main_content_wrapper {
    min-height: 100px !important;
}

}
@media (max-width:410px){
.login a:first-child {
    margin-right: 5px;
}
.login a {
    border: 1px solid #fff;
    padding: 11px 16px;
    display: inline-block;
    text-decoration: none;
    font-weight: bold;
    color: #fff;
    width: 110px;
}
}
@media (max-width:335px){
#PageHeader div#ImageLogo {
    background-size: 100%;
}
}
</style>




<!--<div style="width:1040px;line-height:25px;">
<a href="index.php?dll=register"><img src="inc/templates/<?=D_TEMP ?>/images/but_join.jpg" style="float:right; margin-right:30px;"></a>
 
<h1 style="font-size:37px;font-weight:normal;"><?=TMP_TXT_1 ?></h1><p><?=TMP_TXT_2 ?></p></div>-->

    
<div class="content-width">
<div class="home-banner"><img src="<?=DB_DOMAIN ?>/inc/templates/v18_teal/images/v18_teal-visual.png"></div>
<? if(my_logged_in){ ?>
<? }else{ ?>
<div class="login"><!--4-->

<a class="button-home" href="index.php?dll=register">Sign Up</a> <a class="button-home"  href="index.php?dll=login">Login Here</a>
</div><? } ?>
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