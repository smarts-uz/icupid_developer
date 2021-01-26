<?  $fdata = DisplayFeaturedMembers(12,4); $wdata = DisplayFeaturedMembers(20);		?>
<style>
#featured_members #style4 .previous_button, #featured_members #style4 .next_button, #featured_members #style5 .previous_button, #featured_members #style5 .next_button {
    background-size: 35px 100px;
}
#splitpage #main_content_wrapper { background: #ffffff; border:0px;}
#splitpage #main_wrapper_bottom {	background: #ffffff;}
#style4 ul li { color:white; }
#style4 .previous_button {  background: url(inc/templates/<?=D_TEMP ?>/images/ho2.jpg) no-repeat; width:38px; height:137px;  }
#style4 .previous_button_over {  background: url(inc/templates/<?=D_TEMP ?>/images/ho2.jpg) no-repeat; width:38px; height:137px; }
#style4 .previous_button_disabled {  background: url(inc/templates/<?=D_TEMP ?>/images/ho2.jpg) no-repeat; width:38px; height:137px; }
#style4 .next_button {   background: url(inc/templates/<?=D_TEMP ?>/images/ho2b.jpg) no-repeat; width:38px; height:137px; }
#style4 .next_button_over {  background: url(inc/templates/<?=D_TEMP ?>/images/ho2b.jpg) no-repeat; width:38px; height:137px; }
#style4 .next_button_disabled {  background: url(inc/templates/<?=D_TEMP ?>/images/ho2b.jpg) no-repeat; width:38px; height:137px; }
.steps { font-size:16px; color:#DA0303;}
.sub_menu{ display:none;}
#page_container{width:100% !important; max-width:100% !important;}
body#splitpage{overflow-x: hidden;}
#top_banner, .footer-banner-add{display:none;}

</style>

<style>
.pImage { float:left; width:100px; height:150px; margin-right:32px;}
.pImageBorder { border:3px solid #eee;}
.pImageUsername { font-size:11px; font-weight:bold; text-align:center}

div#PageHeader{
	float:left;
	width:100%;	 
}
.right-head {
    float: right;
    text-align: right;
    width: auto;
}

#style4 .container.cont-slider, #style5 .container.cont-slider {
    max-width: 94% !important;
    width: auto !important;
}
div#MenuBar {
    width: 76%;
}
.content-width {
    width: 60%;
    margin: auto;
}
.home-quick-search {
    max-height: 370px;
}
#page_footer ul.footer_tabs {
     width: 100%; 
}
.menu .tabs li a {
    line-height: 20px;
}
@media (max-width: 1440px){
div#MenuBar {
    width: 76%;
}
}
@media (max-width: 1200px){
.content-width {
    width: 77%;
}
}

@media (max-width: 768px){
.content-width {
    width: 98%;
}
.right-head {
    float: left;
    text-align: left;
    width: auto;
	margin-left: 20px !important;
}
.nav_button {
    width: 66%;
    float: left;
    margin: 21px 0 0 0;
}
#PageHeader span.icon-bar {
    background: #b1a8a3;
}
#PageHeader div#MenuBar {
    width: 100%;
	margin:15px 0 0 0 !important;
}
#style4 .container.cont-slider, #style5 .container.cont-slider {
    max-width: 91% !important;
}
a.join-now {
    margin-left: 32%;
}
}
@media (max-width: 750px){
.box-right {
    float: none;
    width: 100%;
    text-align: center;
}
.home-quick-search {
    float: none;
    width: 100%;
    height: 100%;
    margin: 10px auto;
}
.right-head {
    margin-left: 13px !important;
}
.nav_button {
    width: 60%;
}
#featured_members #style5 .previous_button ,#featured_members #style5 .next_button{
    WIDTH: 4%;
}	

}
@media (max-width: 570px){
.nav_button {
    width: 100%;
}
#style4 .container.cont-slider, #style5 .container.cont-slider {
    padding: 0;
    max-width: 82% !important;
}
a.join-now {
    margin-left: 24%;
}
}

@media(max-width:335px){

.home-quick-search li span {
    width: 85px;
    line-height: 27px;
}

}
</style>
  

<div class="slider-home">
<div class="content-width">
<div class="box-right"><img src="<?=DB_DOMAIN ?>/inc/templates/v16_gray/images/home-banner.png"></div>
<div class="home-quick-search"><form method="post" name="MemberSearch" action="index.php?dll=search&amp;view_page=1"><input name="do" type="hidden" value="add" class="hidden">            
<input name="do_page" type="hidden" value="search" class="hidden">
<input type="hidden" name="page" value="1" class="hidden">
<input type="hidden" name="Extra[zero]" value="1" class="hidden">
<input name="TotalNumberOfRows" type="hidden" value="3" class="hidden">               
<input type="hidden" name="SeN[1]" value="country" class="hidden">
<input type="hidden" name="SeT[1]" value="3" class="hidden">
<input type="hidden" name="SeN[2]" value="gender" class="hidden">
<input type="hidden" name="SeT[2]" value="3" class="hidden">
<input type="hidden" name="SeN[3]" value="em_85820081128" class="hidden">
<input type="hidden" name="SeT[3]" value="3" class="hidden">
<h3><?=$LANG_BODY['_member']. " ".$LANG_BODY['_search'] ?></h3>
<ul>
<li><span><?=$LANG_BODY['_home1'] ?></span><select name="select"><?=displayGenders() ?></select></li>
<li><span><?=$LANG_BODY['_home2'] ?></span> <select name="SeV[2]"><?=displayGenders(1) ?></select></li>
<li class="birth"><span><?=$LANG_BODY['_age'] ?></span> <? print DoAge(1); ?></li>
<li class="radio-btns"><span><label><?=$LANG_BODY['_withPics'] ?></label> <input type="checkbox" name="Extra[pics]" value="1"/></span><span><label><?=$lang_global_options['13'] ?> </label>
<input type="checkbox" name="Extra[online]" value="1"></span></li>
<li><span>&nbsp;</span> <input type="submit" name="submit" value="<?=$LANG_BODY['_search'] ?>" class="NormBtn"></li>
</ul>
</form></div>
</div>
</div>
<div class="banner-line"><div class="content-width"><a class="join-now" href="index.php?dll=register">Join Now</a></div></div>
<div id="featured_members"> <!-- class="content-width" -->
<div class="members">
<h2><?=$GLOBALS['_LANG']['_featured']." ".$GLOBALS['_LANG']['_members'] ?></h2>
<!--
<table border="0" align="center" class="Home_ImageBar" style="margin-left: 0px; margin-right:0px;"><tr align="center"><td >
-->

<div id="style4" style="margin-top:15px;">
<div class="previous_button"></div><div class="container cont-slider">
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
<!--
</td>
</tr></table>
-->
</div>
</div>




 