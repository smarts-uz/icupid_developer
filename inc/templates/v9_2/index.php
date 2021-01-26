<script type="text/javascript" src="inc/js/extras/contentslider.js"></script>
<style>
#splitpage #main_content_wrapper {
 background: transparent; border:0px;
}
#splitpage #main_wrapper_bottom {
	background: transparent;
}
.menu { background: #666666 url('../../../inc/templates/v9_2/images/menu_bg.jpg') repeat-x; }
#page_footer .footer_menu { 	background: #BFCFCF; }
#copyright_bar { background:#F9F8F3;}
#bottomBar .col1 {
    display: inline;
    float: left;
    width: 33%;
}
#bottomBar .col2 {
    display: inline;
    float: left;
    margin-left: 20px;
    width: 35%;
}
#bottomBar .col3 {
    display: inline;
    float: left;
    margin-left: 20px;
    width: 27%;
}
#bottomBar{ background: #BFCFCF; }
.page_header {
    background: transparent url("../../../inc/templates/v9_2/images/header.jpg") no-repeat scroll center top;
}
ul.form .input, .input , ul.form .input:hover, .input:hover{
	padding: 1%;
}
</style>
 
<?
	 /**
	 * Page: Home Page
	 *
	 * @version  9.0
	 */
	if(SLIDER1_IMAGE ==""){	$Slider_1="inc/templates/".D_TEMP."/images/slide1.jpg";}else{$Slider_1=SLIDER1_IMAGE;}
	if(SLIDER2_IMAGE ==""){	$Slider_2="inc/templates/".D_TEMP."/images/slide2.jpg";}else{$Slider_2=SLIDER2_IMAGE;}
	if(SLIDER3_IMAGE ==""){	$Slider_3="inc/templates/".D_TEMP."/images/slide3.jpg";}else{$Slider_3=SLIDER3_IMAGE;}
	if(SLIDER4_IMAGE ==""){	$Slider_4="inc/templates/".D_TEMP."/images/slide4.jpg";}else{$Slider_4=SLIDER4_IMAGE;}

	$fdata = DisplayFeaturedMembers(12);	
	$vdata = DisplayRecentVideos(4);
	$edata = DisplayRecentEvents(4);
	$ldata = DisplayForumPosts(4);
	$gdata = DisplyRecentGroups(4);

?>

<div style="padding:15px; margin-left:10px;">
<table width="890"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="611" height="242" valign="top"><table width="600" height="310"  border="0" cellspacing="6" bgcolor="#FFFFFF" style="border:1px solid #cccccc;">
      <tr>
        <td valign="top"><table width="592"  border="0" cellpadding="0">
          <tr>
            <td width="586" height="35" class="inner_nav_bar">&nbsp;&nbsp;<?=$GLOBALS['LANG_COMMON'][17] ?></td>
          </tr>
          <tr>
            <td height="252" class="inner_nav_body">


	<div id="slider1" class="sliderwrapper">
	
	<div class="contentdiv">
	<a href="<?=SLIDER1_LINK ?>"><img src="<?=$Slider_1 ?>"></a>
	</div>
	
	<div class="contentdiv">
	<a href="<?=SLIDER2_LINK ?>"><img src="<?=$Slider_2?>"></a>
	</div>
	
	<div class="contentdiv">
	<a href="<?=SLIDER3_LINK ?>"><img src="<?=$Slider_3 ?>"></a>
	</div>
	
	<div class="contentdiv">
	<a href="<?=SLIDER4_LINK ?>"><img src="<?=$Slider_4 ?>"></a>
	</div>
	
	</div>
	
	<div id="paginate-slider1" class="pagination">
	
	</div>

<script type="text/javascript">

featuredcontentslider.init({
	id: "slider1",  //id of main slider DIV
	contentsource: ["inline", ""],  //Valid values: ["inline", ""] or ["ajax", "path_to_file"]
	toc: ["<p><?=SLIDER1_TITLE ?></p> <small><?=SLIDER1_DESC ?> </small>", 
		"<p><?=SLIDER2_TITLE ?></p> <small><?=SLIDER2_DESC ?> </small>", 
		"<p><?=SLIDER3_TITLE ?></p> <small><?=SLIDER3_DESC ?> </small>",
		"<p><?=SLIDER4_TITLE ?></p> <small><?=SLIDER4_DESC ?> </small>"
		],  //Valid values: "#increment", "markup", ["label1", "label2", etc]
	nextprev: ["", ""],  //labels for "prev" and "next" links. Set to "" to hide.
	revealtype: "click", //Behavior of pagination links to reveal the slides: "click" or "mouseover"
	enablefade: [true, 0.2],  //[true/false, fadedegree]
	autorotate: [true, 3000],  //[true/false, pausetime]
	onChange: function(previndex, curindex){  //event handler fired whenever script changes slide
		//previndex holds index of last slide viewed b4 current (1=1st slide, 2nd=2nd etc)
		//curindex holds index of currently shown slide (1=1st slide, 2nd=2nd etc)
	}
})

</script>

 </td>
          </tr>
        </table></td>
      </tr>
    </table></td>
    <td width="16">&nbsp;</td>
    <td width="273" valign="top"><table width="273" height="180"  border="0" cellspacing="6" bgcolor="#FFFFFF" style="border:1px solid #cccccc;">
      <tr>
        <td width="257" height="168" valign="top"><table width="100%"  border="0" cellpadding="0">
          <tr>
            <td width="272" height="35" class="inner_nav_bar">&nbsp;&nbsp;<?=$GLOBALS['_LANG']['_member'] ?> <?=$GLOBALS['_LANG']['_login'] ?></td>
          </tr>
          <tr>
            <td height="118" valign="top" class="inner_nav_body">

			<form method="post" action="index.php">
              <input name="do" type="hidden" value="login" class="hidden">
              <input name="visible" value="0" type="hidden">
              <input name="do_page" type="hidden" value="login" class="hidden">
            
              <table width="100%"  border="0">
  <tr>
    <td width="59%"><?=$GLOBALS['_LANG']['_username'] ?></td>
    <td width="41%" rowspan="4">

<a href="index.php?dll=register" class="NormBtn" style="width:65px; height:60px; display:block; margin-left:4px; margin-top:20px;line-height:20px; background-color:transparent;">  
<b><?=$GLOBALS['_LANG']['_register'] ?></b>  
<br><img src="images/DEFAULT/_acc/emoticon_smile.png" width="16" height="16" align="absmiddle"> <?=$GLOBALS['_LANG']['_now'] ?> <br>

<small><?=$GLOBALS['_LANG']['_itsFree'] ?>!</small> </a>

</td></tr>
  <tr>
    <td><input name="username" id="username" type="text" class="input" size="15" <? if(isset($_COOKIE['emeeting']['username'])){ print "value='".$_COOKIE['emeeting']['username']."'"; } ?>></td>
    </tr>
  <tr>
    <td><?=$GLOBALS['_LANG']['_password'] ?></td>
    </tr>
  <tr>
    <td><input name="password" id="password" type="password" class="input" size="15">      </td>
    </tr>
  <tr>
    <td colspan="2"><input name="submit" type="submit" class="NormBtn" value="<?=$GLOBALS['_LANG']['_login'] ?>">
      <input type="checkbox" name="remember" value="1" style="margin-right:15px;" checked='checked'>
      <small> <?=$GLOBALS['_LANG']['_rememberMe'] ?> </small></td>
    </tr>
</table>
                
            </form></td>
          </tr>
        </table></td>
      </tr>
    </table>
      <table width="270" height="127"  border="0" cellspacing="6" bgcolor="#FFFFFF" style="border:1px solid #cccccc; margin-top:15px;">
        <tr>
          <td height="115" valign="top"><table width="100%"  border="0" cellpadding="0">
              <tr>
                <td width="272" height="35" class="inner_nav_bar">&nbsp;&nbsp;<?=$LANG_WELCOME['_join'] ?></td>
              </tr>
              <tr>
                <td height="67" align="center" valign="middle" class="inner_nav_body">&nbsp;&nbsp;&nbsp;<a href="index.php?dll=register"><span style="font-size:18px ">  </span> <?=$LANG_WELCOME['_join1'] ?> </a></td>
              </tr>
          </table></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td height="19">&nbsp;</td>
    <td>&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td height="19" valign="top"><table width="600" height="310"  border="0" cellspacing="6" bgcolor="#FFFFFF" style="border:1px solid #cccccc;">
      <tr>
        <td valign="top"><table width="592"  border="0" cellpadding="0">
            <tr>
              <td width="586" height="35" class="inner_nav_bar">&nbsp;&nbsp;<?=$GLOBALS['LANG_COMMON'][18] ?> ( <a href="index.php?dll=search&page=1&online=1" style="ext-decoration:none;color:white;"><?=CountOnline() ?> <?=$GLOBALS['_LANG']['_members'] ?> <?=$GLOBALS['_LANG']['_online'] ?> </a> )</td>
            </tr>
            <tr>
              <td height="252" class="inner_nav_body">


<div id="style2" style="margin-left:10px;">
      <div class="previous_button"></div>  
      <div class="container">
        <ul>
       <?  foreach( $fdata as $value){ ?> <li><a href="<?=$value['link'] ?>"><img src="<?=$value['image'] ?>" width="96" height="96" border="0" style="cursor:pointer;"></a><br>
         <strong><?=$value['username'] ?></strong><br>  <?=$value['gender'] ?> / <?=$value['age'] ?> <br> <br>
         <a href="<?=$value['link'] ?>"><small style="line-height:15px;padding-top:5px; font-size:11px;"><em><?=substr($value['headline'],0,30) ?>..</em></small></a></li>
       <? } ?>
        </ul>
      </div>
      <div class="next_button"></div>
</div>
<script>function runTest() {  hCarousel = new UI.Carousel("style2");     }  Event.observe(window, "load", runTest); </script></td>
            </tr>
        </table></td>
      </tr>
    </table>      </td>
    <td width="16">&nbsp;</td>
    <td valign="top"><table width="272" height="310"  border="0" cellspacing="6" bgcolor="#FFFFFF" style="border:1px solid #cccccc;">
      <tr>
        <td width="256" valign="top"><table width="100%"  border="0" cellpadding="0">
            <tr>
              <td width="272" height="35" class="inner_nav_bar">&nbsp;&nbsp;<?=$GLOBALS['LANG_COMMON'][19] ?></td>
            </tr>
            <tr>
              <td height="252" valign="top" class="inner_nav_body">
                <? foreach( $gdata as $value){ ?>
                <table width="95%"  border="0" align="center" style="border-bottom:1px dashed #999999;">
                  <tr>
                    <td width="28%" height="51" valign="top"><a href="<?=$value['link']; ?>"><img src="<?=$value['image']; ?>&x=48&y=48" width="48" height="48"></a></td>
                    <td width="72%" style="font-size:11px;"><span style="font-weight:bold;display:block;font-size:13px;">                      <?=$value['name'] ?>                      </span><?=substr(strip_tags($value['description']),0,100); ?>..</td>
                  </tr>
                </table>
                <?  }?></td>
            </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="19">&nbsp;</td>
    <td>&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td height="242" valign="top"><table width="600" height="191"  border="0" cellspacing="6" bgcolor="#FFFFFF" style="border:1px solid #cccccc;">
      <tr>
        <td height="179" valign="top"><table width="592"  border="0" cellpadding="0">
          <tr>
            <td width="586" height="35" class="inner_nav_bar">&nbsp;&nbsp;<?=$GLOBALS['LANG_COMMON'][20] ?></td>
          </tr>
          <tr>
            <td height="211" class="inner_nav_body">
 <? if(isset($vdata['1']['image'])){ ?>
<table width="586"  border="0" cellspacing="5">
  <tr align="center">
    <?php  
    	foreach($vdata as $v_key => $v_value)
		{	
		
			echo ' <td width="138" height="73"><a href="'.$vdata[$v_key]['link'].'"><img src="'.$vdata[$v_key]['image'].'" border="0"></a></td>'; 
		}
	    
    ?>
  </tr>
  <tr align="center">
    <?php  
    	foreach($vdata as $v_key => $v_value)
		{	
			echo ' <td width="138" height="22" style="font-size:12px; font-weight:bold;">'.$vdata[$v_key]['title'].'</td>'; 
		}
	    
    ?>
  </tr>
  <tr align="center" valign="top">
   <?php  
    	foreach($vdata as $v_key => $v_value)
		{	
			echo '<td height="60" style="font-size:11px;"><div style="width:138px; overflow:hidden;">'.substr(strip_tags($vdata[$v_key]['description']),0,100).'</div></td>'; 
		}
	    
    ?>
  </tr>
</table>
<? } ?>
</td>
          </tr>
        </table></td>
      </tr>
    </table>      </td>
    <td>&nbsp;</td>
    <td valign="top"><table width="271" height="266"  border="0" cellspacing="6" bgcolor="#FFFFFF" style="border:1px solid #cccccc;">
      <tr>
        <td width="255" height="254" valign="top"><table width="100%"  border="0" cellpadding="0">
            <tr>
              <td width="272" height="35" class="inner_nav_bar">&nbsp;&nbsp;<?=$GLOBALS['LANG_COMMON'][17] ?></td>
            </tr>
            <tr>
              <td height="202" valign="top" class="inner_nav_body"><? foreach( $edata as $value){ ?>
                <table width="95%"  border="0" align="center" style="border-bottom:1px dashed #999999;">
                  <tr>
                    <td width="28%" height="51" valign="top"><a href="<?=$value['link'] ?>"><img src="<?=$value['image']; ?>&x=48&y=48" width="48" height="48"></a></td>
                    <td width="72%" style="font-size:11px;"><span style="font-weight:bold;display:block;font-size:13px;">
                      <a href="<?=$value['link'] ?>"><?=$value['name'] ?></a>
                      </span>
                        <?=substr(strip_tags($value['description']),0,100); ?></td>
                  </tr>
                </table>
                <?  }?></td>
            </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
</div>