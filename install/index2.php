<?php
$TabID=0;
$sp 		= ini_get( 'session.save_path' );
require_once( '../inc/config.php' );
//require_once( 'inc/func/common.php' );
require_once( 'install_layout.php' );
$version 	= VERSION;

print $tdata[1]["contents"];
 
?>

<?php if(@extension_loaded('ioncube')  || @extension_loaded('ionCube Loader') || isset($_POST['ioncube'])){ ?>
<script>

function CheckData() {

	// form validation check
	var formValid=false;
	var f = document.form;
	if ( f.Key1.value == '' ) {
		alert('Please enter your software license key');
		f.Key1.focus();
		formValid=false;		
	} else if ( f.Key2.value == '' ) {
		alert('You must enter a valid email address which is used to login to your customer account area.');
		f.Key2.focus();
		formValid=false;		
	} else {
		formValid=true;
	}
	return formValid;

}
</script>
<form action="0.php" method="post" name="form" id="form" onSubmit="return CheckData();">
<input type="hidden" name="start" value="0">

<div id="step" class="s2">iCupid Software <?=$version ?></div>
			
<div class="clr"></div>

								
		<h1>Commercial License Key:</h1>
		<div class="clr"></div>			
  				<div class="form-block">
				
				  <em>				  </em>
				  <table width="500" >
                    <tr>
                      <td width="21"></td>
                      <td width="61"></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td colspan="2"> <strong>Software License Key </strong><br/>
                      </td>
                      <td width="240">
                        <input name="Key1" type="text" class="inputbox" size="40" />
                      </td>
                    </tr>
                    <tr>
                      <td colspan="2"><strong>Customer Login Email</strong></td>
                      <td>
                        <input name="Key2" type="text" class="inputbox" size="40" value=""/>
                      </td>
                    </tr>
                  </table>
  				</div>
				
			    <div class="clr"></div>
		<h1>Customer License Agreement</h1>
		<div class="licensetext">
				
		</div>
		
		<div class="clr"></div>

		
		<div class="clr"></div>
		<div class="license-form">
			<div class="form-block" style="padding: 0px;">
				<iframe src="inc/data/license.html" class="license" frameborder="0" scrolling="auto" style="height:200px;"></iframe>
			</div>
		</div>
		<div class="clr"></div>
		<div class="clr"></div>
		
		<div class="ctr">&nbsp;&nbsp;</div>
		<br/><input name="Button2" type="submit" class="button" value="Continue Installation"/><br/>	
</form>
<? }else{ ?>
<form method="post" action="index.php">
<input type="hidden" name="ioncube" value="1">
<h1>Ioncube Support Required</h1>
<img src="inc/images/ioncube.gif">
<h2 style="text-align:left;">Ioncube is part of the software requirements but was not found on this web site hosting environment.</h2>
<p style="text-align:left;font-size:13px;">Please contact your hosting provider or server administrator and ask them to install/include ioncube support with your hosting installation.</p>
<p>You can learn more about ioncube at: <a href="http://www.ioncube.com">www.ioncube.com</a></p>
<p>If you continue without ioncube you may get errors!</p>
<br/><input name="Button2" type="submit" class="button" value="Continue Without Ioncube"/><br/>
</form>
<? } ?>
<?php print $tdata[2]["contents"]; ?>