<?  $fdata = DisplayFeaturedMembers(12); ?>
<style>
#splitpage #main_content_wrapper { background: transparent; border:0px;}
#splitpage #main_wrapper_bottom {	background: transparent;}
#copyright_bar { border-right:0px; text-align: center; }
/*.menu, .sub_menu,#page_footer, #copyright_bar { width:940px; margin-left:0px; margin-right:0px;   } */
.page_header,#page_container { width: 940px;}
.logo_height {
    background: #5FB6FF;
}
div#PageHeader{
	background-color:transparent;
}
#MenuBar{
	float:left;
}
.menu {
    background: #298DEE url('../../../inc/templates/v5_5/images/menu_bg.jpg') repeat-x;
    border-top: 1px solid white;
}
.logo_height {
    width: 100%;
    float: left;
}
.sub_menu{
	float:left;
}
#page_footer .footer_menu {
    background-color: #298DEE;
}
</style>


<table width="880"  border="0" style="margin-left:10px; margin-top:0px; margin-bottom:10px;">
  <tr>
    <td width="497" height="279" valign="top">
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="border:1px dashed #999999;" class="inner_nav_body">
      
      <?php
      $i = 1;
      foreach ($fdata as $_data) {
        if($i%4 == 1){
        ?>
        <tr valign="top">
        <?php  
        }
        ?>
        <td width="25%" height="110" align="center">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
              <tr>
                <td height="100" align="center"><a href="<?=$_data['link']; ?>"><img src="<?=$_data['image']; ?>" width="76" height="78" border="0" style="background-color: #ffffff; border: 1px solid #333333; padding: 4px;"></a></td>
              </tr>
              <tr>
                <td height="27" align="center" class="btitle"><?=$_data['username']; ?></td>
              </tr>
          </table></td>
        <?php 
        if($i%4 == 0){
        ?>
        </tr>
        <?php  
        }
        $i++;
      }
      ?>
      
      </table>

    <div style="padding:8px;"><b><?=$GLOBALS['_LANG']['_searchQ'] ?></b> </div>



      <table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#eeeeee" class="home_page_box">
        <tr>
          <td height="97" valign="top"><table width="452" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-left:30px;">
              <tr>
                <td width="33"><img src="images/DEFAULT/_icons/16/search.gif"></td>
                <td width="183"><a href="index.php?dll=search&page=1" class="home_page_links"><?=$GLOBALS['_LANG']['_viewAll'] ?> <?=$GLOBALS['_LANG']['_members'] ?></a> </td>
                <td width="32"><img src="images/DEFAULT/_icons/16/search.gif"></td>
                <td width="200" height="30"><a href="index.php?dll=search&page=1&online=1"><?=$GLOBALS['_LANG']['_members']." ".$GLOBALS['_LANG']['_online'] ?></a></td>
              </tr>
              <tr>
                <td><img src="images/DEFAULT/_icons/16/search.gif"></td>
                <td><a href="#" onclick="MakeSearchOptions(1,0,0,0,0,0,0); return false;" class="home_page_links"><?=$GLOBALS['_LANG']['_latest'] ?> <?=$GLOBALS['_LANG']['_members'] ?></a></td>
                <td><img src="images/DEFAULT/_icons/16/search.gif"></td>
                <td height="30"><a href="#" onclick="MakeSearchOptions(0,0,0,0,0,1,0); return false;" class="home_page_links"><?=$GLOBALS['LANG_COMMON'][18] ?></a></td>
              </tr>
              <tr>
                <td><img src="images/DEFAULT/_icons/16/search.gif"></td>
                <td><a href="#" onclick="MakeSearchOptions(0,0,0,0,0,0,1); return false;" class="home_page_links"><?=$GLOBALS['_LANG']['_members'] ?> <?=$GLOBALS['_LANG']['_withPics'] ?></a></td>
                <td><img src="images/DEFAULT/_icons/16/search.gif"></td>
                <td height="30"><a href="index.php?dll=search" class="home_page_links"> <?=$GLOBALS['_LANG']['_advanced'] ?> <?=$GLOBALS['_LANG']['_search'] ?> </a></td>
              </tr>
          </table></td>
        </tr>
      </table>

	<div style="padding:8px;"><b><?=$GLOBALS['LANG_WELCOME']['_join'] ?></b>  <a href="index.php?dll=register"><?=$GLOBALS['LANG_WELCOME']['_join2'] ?></a> </div>
      
      <table width="495" height="103"  border="0" cellpadding="0" cellspacing="0" style="background: url('inc/templates/<?=D_TEMP ?>/images/getting-started.gif'); no-repeat;">
        <tr>
          <td width="13" height="103"></td>
          <td width="170" valign="top"><div class="ctitle"><?=$GLOBALS['LANG_WELCOME']['_ct1'] ?></div><div class="ctext"><?=$GLOBALS['LANG_WELCOME']['_cb1'] ?></div></td>
          <td width="165" valign="top"><div class="ctitle"><?=$GLOBALS['LANG_WELCOME']['_ct2'] ?></div><div class="ctext"><?=$GLOBALS['LANG_WELCOME']['_cb2'] ?></div></td>
          <td width="145" valign="top"><div class="ctitle"><?=$GLOBALS['LANG_WELCOME']['_ct3'] ?></div><div class="ctext"><?=$GLOBALS['LANG_WELCOME']['_cb3'] ?></div></td>
        </tr>
      </table>



</td>
    <td width="10">&nbsp;</td>
    <td width="359" valign="top"><img src="inc/templates/<?=D_TEMP ?>/images/welcome.jpg" width="350" height="260" style="border:1px solid black">
<div id="banner_icon" style="margin-top:15px;"></div>
<table width="350" height="268"  border="0" cellspacing="6" bgcolor="#FFFFFF" style="border:1px solid #cccccc; margin-top:10px;">
  <tr>
    <td height="254" valign="top"><table width="100%"  border="0" cellpadding="0">
        <tr>
          <td width="272" height="35" class="inner_nav_bar">&nbsp;&nbsp;<?=TMP_TXT_1 ?></td>
        </tr>
        <tr>
          <td height="209" valign="top" class="inner_nav_body" style="line-height:27px;">&nbsp;<?=TMP_TXT_2 ?>
            </td>
        </tr>
    </table></td>
  </tr>
</table>
</td>
  </tr>
</table>
<script type="text/javascript" src="inc/js/swfobject.js"> </script>
<script type="text/javascript">
		var so = new SWFObject("inc/templates/<?=D_TEMP ?>/images/banner.swf", "slideshow", "350", "80", "0", "#89D9FC");
		so.addParam("quality", "high");
		so.addParam("menu", "false");
		so.addParam("loop", "false");
		so.addParam("scale", "noscale");
		so.write("banner_icon");
</script>
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