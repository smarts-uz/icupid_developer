<? $fdata = DisplayFeaturedMembers(10);	?>
<style>
#splitpage #main_content_wrapper { background: transparent; border:0px;}
#splitpage #main_wrapper_bottom {	background: transparent;}
.search{ font-size:12px; float:left; width: 150px; display:block; height:30px; margin-right:5px; line-height:30px;}
.pImage { float:left; width:100px; height:150px; margin-right:23px;}
.pImageBorder { border:3px solid #eee;}
.pImageUsername { font-size:11px; font-weight:bold; text-align:center}
.menu {background: #A0A6A8;border-top:2px solid white; }
#page_footer .footer_menu { 	background: #A0A6A8; }
#copyright_bar { background: #A0A6A8; }
ul.tabs{
	float:left;
}
ul.form .input, .input , ul.form .input:hover, .input:hover{
	padding: 1%;
}
.content-width{
	width:940px;
	margin:0 auto;
}
</style>

<div class="ClearAll"></div>
<table width="915" height="476" border="0" style="margin-top:10px; margin-left:10px;"><tr><td width="244" height="19" valign="top">
  


	<div style="background: transparent url('inc/templates/<?=D_TEMP ?>/images/small_3.jpg') no-repeat; height:235px; margin-top:10px;">

	<div class="index" style="padding-top:10px;margin-left:12px;color:white;">


		<table width="82%"  border="0" cellpadding="0">
		  <tr>
			<td width="272" height="30" class="inner_nav_bar">&nbsp;&nbsp;<font color="#707374"><?=$GLOBALS['_LANG']['_member'] ?> <?=$GLOBALS['_LANG']['_login'] ?></font></td>
		  </tr>
		  <tr>
			<td height="145" valign="top"><form method="post" action="index.php">
              <input name="do" type="hidden" value="login" class="hidden">
              <input name="visible" value="0" type="hidden">
              <input name="do_page" type="hidden" value="login" class="hidden">
              <table width="100%"  border="0" style="margin-top:10px;">
                <tr>
                  <td width="29%"><font color="#707374"><?=$GLOBALS['_LANG']['_username'] ?></font></td>
                  <td width="30%"><input name="username" id="username" type="text" class="input" size="15" <? if(isset($_COOKIE['emeeting']['username'])){ print "value='".$_COOKIE['emeeting']['username']."'"; } ?>></td>
                </tr>
                <tr>
                  <td colspan="2"></td>
                </tr>
                <tr>
                  <td><font color="#707374"><?=$GLOBALS['_LANG']['_password'] ?></font></td>
                  <td><input name="password" id="password" type="password" class="input" size="15"></td>
                </tr>
                <tr>
                  <td colspan="2"><input name="submit" type="submit" class="NormBtn" value="<?=$GLOBALS['_LANG']['_login'] ?>">
                      <input type="checkbox" name="remember" value="1" style="margin-right:15px;" checked='checked'>
                      <small>
                      <font color="#707374"><?=$GLOBALS['_LANG']['_rememberMe'] ?></font>
                    </small></td>
                </tr>
              </table>
			  </form></td>
		  </tr>
		  <tr>
			<td height="30" valign="top" style="font-size:13px;"><?=$LANG_WELCOME['_join'] ?> <a href="index.php?dll=register"><?=$LANG_WELCOME['_join2'] ?></a></td>
		  </tr>
		</table>

	</div>	 
	</div>
	
	
	
	</td><td width="651" height="211" valign="top">
	
	<div style="background: transparent url('inc/templates/<?=D_TEMP ?>/images/h4.jpg') top right; background-repeat:no-repeat; height:240px; margin-left:15px;">
		<br>
		<div style="width:360px;display:block; margin-top:20px;">
			
			<h1><?=TMP_TXT_3 ?></h1>
			<p style="line-height:23px;"><?=TMP_TXT_4 ?></p>	
			<input type="button" value="&nbsp;&nbsp;<?=$LANG_WELCOME['_join2'] ?>&nbsp;&nbsp;" class="MainBtn" onClick="location.href='index.php?dll=register'" style="font-size:16px;">&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="button" value="&nbsp;&nbsp;<?=$LANG_TOUR['a1'] ?>&nbsp;&nbsp;" class="MainBtn" onClick="location.href='index.php?dll=tour'" style="font-size:16px;">
			
		</div>
	
	</div>
	
	
</td></tr><tr><td width="244" height="280" valign="top" style="background: transparent url('inc/templates/<?=D_TEMP ?>/images/small_2.jpg') no-repeat; height:350px;">


<div style="margin-left:10px; padding:10px; width:190px; overflow:hidden; height:300px; color:white;"><b><?=TMP_TXT_5 ?></b><p style="color:white;"><?=TMP_TXT_6 ?></p></div>


</td>
<td height="259" valign="top">

<div style="margin-left:20px; margin-top:20px;">
 
	<h2><?=$GLOBALS['_LANG']['_featured']." ".$GLOBALS['_LANG']['_members'] ?></h2><br>
	<? foreach( $fdata as $value){ ?>
	<div class="pImage"><a href="<?=$value['link']; ?>"><img src="<?=$value['image']; ?>" border="0" width="96" height="96" class="pImageBorder"></a><div class="pImageUsername"><?=$value['username']; ?></div></div>
	<? } ?>

</div>

</td></tr></table><br>
</div>