<?  $fdata = DisplayFeaturedMembers(12,4); $wdata = DisplayFeaturedMembers(20);		?>
<style>
#splitpage #main_content_wrapper { background: #ffffff; border:0px;}
#splitpage #main_wrapper_bottom {	background: #ffffff;}
.Home_ImageBar { background: #000; border-bottom:2px solid #929091; /*height:180px;*/ }
#style4 ul li { color:white; }
#style4 .previous_button {  background: url(inc/templates/<?=D_TEMP ?>/images/ho2.jpg) no-repeat; width:9%; height:137px;  }
#style4 .previous_button_over {  background: url(inc/templates/<?=D_TEMP ?>/images/ho2.jpg) no-repeat; width:9%; height:137px; }
#style4 .previous_button_disabled {  background: url(inc/templates/<?=D_TEMP ?>/images/ho2.jpg) no-repeat; width:9%; height:137px; }
#style4 .next_button {   background: url(inc/templates/<?=D_TEMP ?>/images/ho2b.jpg) no-repeat; width:9%; height:137px; }
#style4 .next_button_over {  background: url(inc/templates/<?=D_TEMP ?>/images/ho2b.jpg) no-repeat; width:9%; height:137px; }
#style4 .next_button_disabled {  background: url(inc/templates/<?=D_TEMP ?>/images/ho2b.jpg) no-repeat; width:9%; height:137px; }
#style4 .container {
    width: 82%;
}
.steps { font-size:16px; color:#DA0303;}
</style>

<style>
#page_footer .footer_menu {
    background: #6b6a6c;
}
.pImage { float:left; width:100px; height:150px; margin-right:31px;}
.pImageBorder { border:3px solid #eee;}
.pImageUsername { font-size:11px; font-weight:bold; text-align:center;width: 100%;}
.menu { background: #383737;border-top:2px solid white; }
ul.tabs{
	float:left;
}
body{ padding:10px 0 10px 0;}
.logo_height {
    float: none;
}
div#PageHeader {
    width: 940px;
	float:none;
}
#PageHeader .sub_menu {
    width: 100%;
    box-shadow: none;
	min-height:auto;
}
div#MenuBar {
    float: left;
    width: 100%;
	margin:0;
}
.sub_tabs li {
    padding: 0;
}
#ImageLogo {
    margin-top: 0;
}
.min_height{
	min-height:335px;
}
#copyright_bar,ul.flags_ul {
    text-align: center;
	width: 100%;
}
#copyright_bar{   text-align: center;}
select ,input.NormBtn {
    color: #000;
}

li.flags_list_item {
display: inline-block;
padding: 21px 0 0 0;
}

#page_footer .footer_tabs li {
display: inline-block;
line-height: 10px;
padding: 0px 0 14px 5px;
}
#page_footer ul.footer_tabs {
width: intrinsic; /* Safari/WebKit uses a non-standard name /*/
width: -moz-max-content; / *Firefox/Gecko */
width: -webkit-max-content;
}

#page_footer.footer_sec {
background-color: #6B6A6C;
text-align: center;
float: left;
position: relative;
}


#style4 ul li {
    width: 100px;
}
#style4 {
	width: 100%;
    MARGIN: 0 AUTO;
    border-radius: 12px;
    padding-top: 10px;
    margin-top: 15px;
    border: 2px solid #555555;
    PADDING: 10PX;
    float: left;
    background: #373737;
    margin-bottom: 20px;	
}
.featured{
    float: left;
    background: #e5e3e4;
}
.Home_ImageBar .col-xs-12.col-sm-5.col-md-5.col-lg-5 {
    padding: 20px;
}
@media (max-width: 768px){
div#PageHeader,div#page_container {
    width: 99%;
}
.inner_nav_body,.featured {
    background: #fff;
}
.pImage {
    margin-right: 20px;
}
.inner_nav_body {
    height: auto !important;
}
#style4 .container {
    width: 310px;
}
div#mynav {
    POSITION: ABSOLUTE;
    WIDTH: 99%;
    Z-INDEX: 99;
}
.inner_nav_body h1 {
    font-size: 30px !important;
}
}

@media (max-width: 750px) and (min-width: 550px){
#bg_set form{
	padding:40 !important;
}
#bg_set {
	background-size: 100% 100% !important;
}
}
@media (max-width: 750px){
#style4 {
    margin: 20px auto !important;
}
#style4 .container {
    width: 80%;
    padding: 0;
}
#style4 .previous_button,#style4 .next_button {
    width: 10%;
}
}

@media (max-width: 340px){
#ImageLogo {
    width: 100%;
    margin: 0 auto;
}
#bg_set form{
	padding:25px 0 !important;
}
#bg_set {
	padding:0;
}

}

</style>
  
<div class="row margin_0">
    <div class="col-xs-12 col-sm-6 col-md-7 col-lg-7 padding_0">
        <div class="inner_nav_body" style="margin-top:25px; height:535px; border:0px;">
            <h1 style="font-size:37px;font-weight:normal;"><?=TMP_TXT_1 ?></h1><p><?=TMP_TXT_2 ?></p> 
            <div style="margin-left:10px; margin-top:20px;">
                <? foreach( $fdata as $value){ ?>
                    <div class="pImage">
                        <a href="<?=$value['link']; ?>"><img src="<?=$value['image']; ?>" border="0" width="96" height="96" class="pImageBorder"></a>
                        <div class="pImageUsername"><?=$value['username']; ?></div>
                    </div>
                <? } ?>
            </div>
            <div class="clear"></div>
            
            </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-5 col-lg-5">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 inner_nav_body min_height" id="bg_set" style="border:0px; background: url('inc/templates/<?=D_TEMP ?>/images/index_backdrop.jpg') bottom no-repeat; background-size: cover;">
                <form method="post" name="MemberSearch" action="index.php?dll=search&view_page=1" style="padding:20px; "><br>               
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
            <table width="300"  border="0" cellpadding="0" cellspacing="0" style="color:white;margin-left:20px;margin-top:10px;">
            <tr valign="top"><td height="24" colspan="3" style="font-size:24px;color:#ffffff"><?=$LANG_BODY['_member']. " ".$LANG_BODY['_search'] ?></td>
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
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 inner_nav_body" style="border:0px;padding:20px 20px 0 20px;">
                <span style="font-size:21px;color:#666666; height:45px; margin-top:25px;"><?=$LANG_WELCOME['3'] ?></span>
                <ul style="line-height:30px;margin-top:20px;color:#CF0079;">
                <a href="index.php?dll=register"><img src="inc/templates/<?=D_TEMP ?>/images/home_join.png" border="0" style="float:right;"></a>
                <li class="steps"><?=$LANG_WELCOME['4'] ?></li>
                <li class="steps"><?=$LANG_WELCOME['5'] ?></li>
                <li class="steps"><?=$LANG_WELCOME['6'] ?></li>
                </ul><br>
                <p><?=$LANG_WELCOME['7'] ?></p>
            </div>
        </div>
    </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 featured"><h2 class="Featured_head"><?=$GLOBALS['_LANG']['_featured']." ".$GLOBALS['_LANG']['_members'] ?></h2><br></div>
<div class="row Home_ImageBar margin_0">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
    	<div id="style4" style="margin-left:17px;margin-top:20px;">
        <div class="previous_button"></div>
        <div class="container">
        <ul> 
        <?  foreach( $wdata as $value){ ?>
        <li><a href="<?=$value['link'] ?>"><img src="<?=$value['image'] ?>" width="96" height="96" border="0" style="cursor:pointer;"></a><br>
        <strong><?=$value['username'] ?></strong></li><? } ?>
        <?  foreach( $fdata as $value){ ?>
        <li><a href="<?=$value['link'] ?>"><img src="<?=$value['image'] ?>" width="96" height="96" border="0" style="cursor:pointer;"></a><br>
        <strong><?=$value['username'] ?></strong></a></li><? } ?>
        
        </ul>

	    </div>
		<div class="next_button"></div></div><script>function runTest() {  hCarousel = new UI.Carousel("style4");     }  Event.observe(window, "load", runTest); </script>

    </div>
    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
    	<span style="font-size:21px;color:#ffffff; height:45px; margin-top:25px;"><?=TMP_TXT_3 ?></span>
        <p style="color:white;"><?=TMP_TXT_4 ?></p>
        <p><a href="index.php?dll=register" style="color:white;"><?=$LANG_WELCOME['_join2'] ?></a></p>
    </div>
</div>    
