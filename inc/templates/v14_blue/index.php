<?  $fdata = DisplayFeaturedMembers(20);	?>
<style>
#style4 .container{
	height: 140px;
	}
#splitpage #main_content_wrapper {
	background: #ffffff;
	border:0px;
	box-shadow:none;
}
#splitpage #main_wrapper_bottom {
	background: #ffffff;
}
.Home_ImageBar {
	margin: 0;
    padding: 0;
	/*background: url('inc/templates/<?=D_TEMP ?>/images/index_imagebox.jpg');*/
	background-color:#292929;
	border-bottom:2px solid #929091;
/*	height:180px;*/
}
#style4 ul li {
	color:white;
}
#style4 .previous_button {
background: url(inc/templates/<?=D_TEMP ?>/images/ho2.jpg) no-repeat;
	width:38px;
	height:137px;
}
#style4 .previous_button_over {
background: url(inc/templates/<?=D_TEMP ?>/images/ho2.jpg) no-repeat;
	width:38px;
	height:137px;
}
#style4 .previous_button_disabled {
background: url(inc/templates/<?=D_TEMP ?>/images/ho2.jpg) no-repeat;
	width:38px;
	height:137px;
}
#style4 .next_button {
background: url(inc/templates/<?=D_TEMP ?>/images/ho2b.jpg) no-repeat;
	width:38px;
	height:137px;
}
#style4 .next_button_over {
background: url(inc/templates/<?=D_TEMP ?>/images/ho2b.jpg) no-repeat;
	width:38px;
	height:137px;
}
#style4 .next_button_disabled {
background: url(inc/templates/<?=D_TEMP ?>/images/ho2b.jpg) no-repeat;
	width:38px;
	height:137px;
}
.steps {
	font-size:16px;
	color:#DA0303;
}
.menu {
	background: #08AFEC;
	border-top:2px solid white;
}
#page_footer .footer_menu {
	background: #6B6A6C;
}
#main_content_wrapper .row.Home_ImageBar {
    margin: 0 auto;
}
.inner {
	MARGIN: 0 AUTO;
	border-radius: 14px;
	padding-top: 10px;
	margin-top: 15px;
	border: 1px solid #5DCEF8;
	background: #359DC4;
	box-shadow: 0px 1px 16px 2px #0588B6;
	margin-right: 30px;
}
ul.flags_ul li {
    display: inline-block;
}
.f_left {
    float: left;
}
.sub_menu, .menu {
    height: 43px;
}
#MenuBar .tabs li a {
    font-size: 100%;
     line-height: 20px; 
}
#MenuBar .tabs li a:hover ,#MenuBar .tabs li a:focus {
    background: transparent;
}
.navbar-inverse .navbar-collapse, .navbar-inverse .navbar-form {
    border: 0;
}
div#mynav a {
    color: #fff;
    font-weight: normal;
}
#PageHeader .navbar-toggle:focus, #PageHeader .navbar-toggle:hover {
    background-color: transparent;
}
@media (max-width: 768px){
	
/****** Header Responsive Start ******/
	div#MenuBar ul {
		max-height: 300px;
		overflow: scroll;
		background: #08AFEC;
		z-index: 2;
	}
    .navbar-left,.navbar-right {
        float: none !important;
    }
    #PageHeader .navbar-toggle {
        display: block;
		position: inherit;
    }
    .navbar-collapse {
        border-top: 1px solid transparent;
        box-shadow: inset 0 1px 0 rgba(255,255,255,0.1);
    }
    .navbar-fixed-top {
		top: 0;
		border-width: 0 0 1px;
	}
    #PageHeader .navbar-collapse.collapse {
        display: none !important;
    }
    .navbar-nav {
        float: none!important;
		margin-top: 7.5px;
	}
	.navbar-nav>li {
        float: none;
    }
    .navbar-nav>li>a {
        padding-top: 10px;
        padding-bottom: 10px;
    }
    #PageHeader .collapse.in{
  		display:block !important;
	}
	div#PageHeader {
    box-shadow: 0px 8px 15px #c5b1b1;
	}
	.language
	{
		background:#fff;
	}
	
	.nav_button
	{
	width: 100%;
    float: left;
	margin-top: 5px;
}
	div#MenuBar ul li
	{
	width:100%;	
	}
	div#MenuBar
	{
	width:100%;	
	padding: 0px;	
	}
	#top_banner
	{
		width:100%;
	}
   .hiddenonsmall
   {
	   display:none;
   }
   .navbar-inverse .navbar-collapse
   {
	  border-color: #fff;
   }
   #PageHeader .navbar-toggle
   {
		   padding: 6px 6px;
		   margin-top:0px;
   }
 
	#PageHeader button.navbar-toggle {
    border: 2px solid #fff;
	}
	.right-head {
    margin: 20px 20px 0 0;
}

span.icon-bar {
    background: #fff !important;
}

#MenuBar .tabs li a {
    line-height: 29px;
    width: 100%;
    margin: 0;
    padding: 0 3%;
    text-align: left;
}
.menu .i1 {
    margin-left:0px;
}
.menu {
     border-top: 0; 
}
}
@media screen and (max-width :780px) {
.img_border {
	display: initial;
}
.account_tabs li a {
	padding: 1px 0 1px 3px !important;
}
.onlinenow {
	margin-top:35px;
}
.center-text {
	margin: auto;
	text-align: center;
}
.inner {
	margin-right: 0px;
	margin-bottom:10px;
	margin-top:17px;
}
}

@media (max-width: 740px) and (min-width: 600px){
/*	div#MenuBar ul {
		top:126px;
		left:3%;
		width:94%;
		position: absolute;
	}
*/}
@media (max-width: 500px){
/*	div#MenuBar ul {
		left:3%;
		width:94%;
	}
*/	.width_100{
		width:100%;
	}
	.row {
    margin: 0 !important;
	}
}

@media (max-width: 400px){
.col-xs-12.form_cont {
    padding: 2%;
}
}
div#mynav {
    background: #08AFEC;
	padding: 0;
}
#style4 ul li {
    width: 110px;
}
@media (max-width: 335px){
#ImageLogo {
	margin:0 auto;
    background-size: 93%;
}
div#style4 .col-xs-1 {
    padding: 0;
}
#page_container, #PageHeader.page_header {
    width: 100%;
}
}

#copyright_bar { text-align: center;}
</style>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<!-- Optional theme -->
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
-->
<div class='row center-text'>
  <div class="col-xs-12 col-sm-8 col-md-8 col-lg-9">
    <h1 class="logo">
      <?=TMP_TXT_1 ?>
    </h1>
    <p>
      <?=TMP_TXT_2 ?>
    </p>
  </div>
  <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3 margin-bottom"> <a href="index.php?dll=register"><img src="inc/templates/<?=D_TEMP ?>/images/but_join.jpg" class="login-butt"></a> </div>
</div>
<div class="ClearAll"></div>
<div class='row' style="background: url('<?=DB_DOMAIN ?>/inc/templates/<?=D_TEMP ?>/images/banner-bg.png') top repeat-x #0582ae;margin:0px;padding:0px;">
  <div class="col-xs-12 col-sm-6 col-md-7 col-lg-7">
  <center>  <div><img src="inc/templates/<?=D_TEMP ?>/images/welcome.png" style="margin-top: -15px;" class="width_100" /></div></center>
  </div>
  <div class="col-xs-12 col-sm-6 col-md-5 col-lg-5 form_cont">
<center>
 <div class="inner">

    <div style="padding: 5px 0 10px 0;">
      <form method="post" name="MemberSearch" class="MemberSearch" action="index.php?dll=search&view_page=1">
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
          <tr valign="top">
            <td height="30" colspan="3" style="font-size:25px;color:#ffffff"><?=$LANG_BODY['_member']. " ".$LANG_BODY['_search'] ?></td>
          </tr>
          <tr>
            <td width="122" height="30"><?=$LANG_BODY['_home1'] ?></td>
            <td colspan="2"><select name="select">
                <?=displayGenders() ?>
              </select></td>
          </tr>
          <tr>
            <td height="30"><?=$LANG_BODY['_home2'] ?></td>
            <td colspan="2"><select name="SeV[2]">
                <?=displayGenders(1) ?>
              </select></td>
          </tr>
          <tr>
            <td  width="30"><?=$LANG_BODY['_age'] ?>
              </font></td>
            <td  colspan="2"><? print DoAge(1); ?></td>
          </tr>
          
          <tr>
            <td height="30"><?=$LANG_BODY['_withPics'] ?></td>
            <td width="140"><input type="checkbox" name="Extra[pics]" value="1">
              &nbsp;&nbsp;&nbsp;&nbsp;
              <?=$lang_global_options['13'] ?></td>
            <td width="65"><input type="checkbox" name="Extra[online]" value="1"></td>
          </tr>
          <tr>
            <td height="30">&nbsp;</td>
            <td height="30" colspan="2" valign="bottom"><input type="submit" name="submit" value="&nbsp;&nbsp;<?=$LANG_BODY['_search'] ?>&nbsp;&nbsp;" class="NormBtn"  style="font-size:16px;color:#333"></td>
          </tr>
        </table>
      </form>
    </div>
    </div>
    </center>
  </div>
</div>
<div class="row Home_ImageBar">

  <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
  <center>
<div class="black_div">    <div id="style4" style="margin-left: 17px;margin-top:0px;">
    <div class="row">
  <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 prev">    <div class="previous_button"></div></div>
    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">  <div class="container"  style="padding: 0; width:100%;">
        <ul>
          <?  foreach( $fdata as $value){ ?>
          <li><a href="<?=$value['link'] ?>"><img src="<?=$value['image'] ?>" width="96" height="96" border="0" style="cursor:pointer;"></a><br>
            <strong>
            <?=$value['username'] ?>
            </strong></li>
          <? } ?>
          <?  foreach( $fdata as $value){ ?>
          <li><a href="<?=$value['link'] ?>"><img src="<?=$value['image'] ?>" width="96" height="96" border="0" style="cursor:pointer;"></a><br>
            <strong>
            <?=$value['username'] ?>
            </strong></a></li>
          <? } ?>
        </ul>
      </div></div>
    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1" style="margin-left: -42px;">  <div class="next_button"></div></div>
      </div>
    </div>
    <script>function runTest() {  hCarousel = new UI.Carousel("style4");     }  Event.observe(window, "load", runTest); </script></div> </center> </div>
  <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5 margin-top"><span style="font-size:21px;color:#ffffff; height:45px; margin-top:25px;">
    <?=TMP_TXT_3 ?>
    </span>
    <p style="color:white;">
      <?=TMP_TXT_4 ?>
    </p>
    <p><a href="index.php?dll=register" style="color:white;">
      <?=$LANG_WELCOME['_join2'] ?>
      </a></p>
  </div>

</div>
<div class="row inner_nav_body" style="margin:0; padding:15px 0 0 0;">
 <div class="col-xs-12 col-sm-4 col-md-4"><div style="font-size:21px;color:#666666; height:45px;">
        <?=$LANG_WELCOME['1'] ?>
      </div>
      <div class="ClearAll"></div>
      <? $bdata = DisplayTop10Articles(1);   ?>
      <b>
      <?=(isset($bdata[1]['title'])) ? $bdata[1]['title'] : ''; ?>
      </b>
      <p>
        <?=(isset($bdata[1]['content'])) ? $bdata[1]['content'] : ''; ?>
      </p>
      <b><a href="<?=$bdata[1]['link'] ?>" style="text-decoration:none;"><img src="images/DEFAULT/_acc/comments.png" width="16" height="16" align="absmiddle" border="0">
      <?=$LANG_WELCOME['2'] ?>
      </a></b></div>
 <div class="col-xs-12 col-sm-4 col-md-4" style="border-left: 2px solid white;border-right: 2px solid white;"><span style="font-size:21px;color:#666666; height:45px; margin-top:25px;">
      <?=$LANG_WELCOME['3'] ?>
      </span>
      <ul style="line-height:30px;margin-top:20px;color:#CF0079;">
        <a href="index.php?dll=register"><img src="inc/templates/<?=D_TEMP ?>/images/home_join.png" border="0" style="float:right;"></a>
        <li class="steps">
          <?=$LANG_WELCOME['4'] ?>
        </li>
        <li class="steps">
          <?=$LANG_WELCOME['5'] ?>
        </li>
        <li class="steps">
          <?=$LANG_WELCOME['6'] ?>
        </li>
      </ul>
      <br>
      <p style="margin-top:0px;">
        <?=$LANG_WELCOME['7'] ?>
      </p></div>
 <div class="col-xs-12 col-sm-4 col-md-4"><div style="font-size:21px;color:#666666; height:45px;">
        <?=$LANG_WELCOME['8'] ?>
      </div>
      <div class="ClearAll"></div>
      <img src="inc/templates/<?=D_TEMP ?>/images/people.png" border="0" style="float:right;">
      <p>
        <?=$LANG_WELCOME['9'] ?>
      </p>
      <ul style="line-height:30px;">
        <li><img src="images/DEFAULT/_acc/zoom.png" align="absmiddle"> <a href="index.php?dll=search&page=1">
          <?=$GLOBALS['_LANG']['_viewAll'] ?>
          <?=$GLOBALS['_LANG']['_members'] ?>
          </a></li>
        <li><img src="images/DEFAULT/_acc/zoom.png" align="absmiddle"> <a href="#" onclick="MakeSearchOptions(0,0,0,1,0,0,0); return false;">
          <?=$GLOBALS['_LANG']['_online'] ?>
          <?=$GLOBALS['_LANG']['_members'] ?>
          </a></li>
        <li><img src="images/DEFAULT/_acc/zoom.png" align="absmiddle"> <a href="#" onclick="MakeSearchOptions(1,0,0,0,0,0,0); return false;">
          <?=$GLOBALS['_LANG']['_latest'] ?>
          <?=$GLOBALS['_LANG']['_members'] ?>
          </a></li>
        <li><img src="images/DEFAULT/_acc/zoom.png" align="absmiddle"> <a href="#" onclick="MakeSearchOptions(0,0,0,0,0,1,0); return false;">
          <?=$GLOBALS['LANG_COMMON'][18] ?>
          </a></li>
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
</script></div>
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
