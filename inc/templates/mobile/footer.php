</div>
<div class="clear"></div>

<!-- PAGE FOOTER -->
	<div id="page_footer">	


<div style="margin-left:10px;">


<table width="100%" border="0" cellpadding="2" cellspacing="4" ><tr>
<td width="50%" bgcolor="#eeeeee" align="center">
<a href="<?=DB_DOMAIN ?>mobile.php?dll=mobilecontact"  style="text-decoration: none;color:#ffffff;font-weight:bold;font-size:12px;"><img src="images/contact.png" title="Contact Us"></a></td>
<td width="50%" bgcolor="#eeeeee" align="center">
<a href="<?=DB_DOMAIN ?>mobile.php?dll=privacy" style="text-decoration: none;color:#ffffff;font-weight:bold;font-size:12px;"><img src="images/privacy.png" title="Privacy Policy"></a></td>


</tr>
</table>

</div>


<table width="100%" border="0" cellpadding="2" cellspacing="4" style="margin-left:2px;">

<tr><td>
<center>
<font size="1">


<?
$ReturnData ='<b><a href="'.DB_DOMAIN.'mobile.php"  style="text-decoration : none;">&copy; '.date('Y').' - '.D_CCTEXT.'</a> </b>';


if(BRAND_ID ==""){
	$ReturnData .='<br> <a href="http://www.advandate.com/" alt="Dating Software by AdvanDate" target="_blank" style="text-decoration : none;">Dating Software Powered by iCupid</a>';
}

print $ReturnData;


if(D_FLAGS ==1){	
  $FOOTER_MENU_TIMER =ShowLangList(); 
  print $FOOTER_MENU_TIMER;
?>





<? } ?>

</font>
</center>
</td></tr>

</table>


		
	</div>
<div class="clear"></div>
<!-- END FOOTER -->
</div>
<!-- END PAGE MAIN BACKGROUND -->


<br>


<?php e_footer() ?>

<div style="width:300px;margin-left:8px;margin-bottom:8px;";>
<? foreach($BANNER_ARRAY as $banner){ if($banner['position'] =="bottom"){ print $banner['display'];}} ?>
</div>


</body>
</html>