<? $fdata = DisplayFeaturedMembers(10);	?>
<style>
#splitpage #main_content_wrapper { background: transparent; border:0px;}
#splitpage #main_wrapper_bottom {	background: transparent;}
.search{ font-size:12px; float:left; width: 150px; display:block; height:30px; margin-right:5px; line-height:30px;}
.pImage { float:left; width:100px; height:150px; margin-right:23px;}
.pImageBorder { border:3px solid #eee;}
.pImageUsername { font-size:11px; font-weight:bold; text-align:center}
</style>

<div class="ClearAll"></div>
<table width="280" height="256" border="0" style="margin-top:10px; margin-left:10px;" bgcolor="#FFFFFF"><tr><td width="244" height="19" valign="top">
  


	

	<div class="index" style="padding-top:10px;margin-left:12px;color:white;">


		<table width="82%"  border="0" cellpadding="0" >
		  <tr>
			<td width="272" height="30" class="inner_nav_bar">&nbsp;&nbsp;<font color="black"><?=$GLOBALS['_LANG']['_member'] ?> <?=$GLOBALS['_LANG']['_login'] ?></font></td>
		  </tr>
		  <tr>
			<td height="145" valign="top"><form method="post" action="mobile.php">
              <input name="do" type="hidden" value="login" class="hidden">
              <input name="visible" value="0" type="hidden">
              <input name="do_page" type="hidden" value="mobilelogin" class="hidden">
              <table width="100%"  border="0" style="margin-top:10px;">
                <tr>
                  <td width="29%"><font color="black"><?=$GLOBALS['_LANG']['_username'] ?></font></td>
                  <td width="30%"><input name="username" id="username" type="text" class="input" size="15" <? if(isset($_COOKIE['emeeting']['username'])){ print "value='".$_COOKIE['emeeting']['username']."'"; } ?>></td>
                </tr>
                <tr>
                  <td colspan="2"></td>
                </tr>
                <tr>
                  <td><font color="black"><?=$GLOBALS['_LANG']['_password'] ?></font></td>
                  <td><input name="password" id="password" type="password" class="input" size="15"></td>
                </tr>
                <tr>
                  <td colspan="2"><input name="submit" type="submit" class="NormBtn22" 
			value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$GLOBALS['_LANG']['_login'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;">
                      </td>
                </tr>

         	<tr>
                  <td colspan="2">
                      <input type="checkbox" name="remember" value="1" style="margin-right:15px;" checked='checked'>
                      <small>
                      <font color="black"><?=$GLOBALS['_LANG']['_rememberMe'] ?></font>
                    </small></td>
                </tr>

              </table>
			  </form></td>
		  </tr>
		  <tr>
			<td height="30" valign="top" style="font-size:12px;"><?=$LANG_WELCOME['_join'] ?> <a href="mobile.php?dll=mobileregister"><?=$LANG_WELCOME['_join2'] ?></a></td>
		  </tr>
		</table>

	</div>	 

	
	
	
	</td>






</tr></table><br>

<div style="padding-top:5px;margin-left:12px">
<? if (defined('FACEBOOK_APP_ID')  && FACEBOOK_APP_ID !="") { ?>             
 <a href="<?=DB_DOMAIN ?>mobile.php?dll=fblogin"><img src="<?=DB_DOMAIN ?>images/facebook-login.jpg" ></a><br>
<br>
 <a href="<?=DB_DOMAIN ?>mobile.php?dll=mobilefbregister"><img src="<?=DB_DOMAIN ?>images/facebook-register.jpg" ></a><br />


<? } ?>
</div>




</div>