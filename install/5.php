<?php
$TabID=6;
require_once( '../inc/config.php' );
require_once( 'inc/func/common.php' );

if(isset($_POST['do']) && $_POST['do'] == "send"){

	$today_time	=date("H:i:s");	
	$today_date	=date("y-m-d");

	$_POST['a2'] = (isset($_POST['a2'])) ? $_POST['a2'] : '';
	$_POST['a3'] = (isset($_POST['a3'])) ? $_POST['a3'] : '';
	$_POST['a4'] = (isset($_POST['a4'])) ? $_POST['a4'] : '';
	$_POST['a5'] = (isset($_POST['a5'])) ? $_POST['a5'] : '';
	$_POST['a6'] = (isset($_POST['a6'])) ? $_POST['a6'] : '';
	$_POST['a7'] = (isset($_POST['a7'])) ? $_POST['a7'] : '';
	$_POST['a8'] = (isset($_POST['a8'])) ? $_POST['a8'] : '';
	$_POST['a9'] = (isset($_POST['a9'])) ? $_POST['a9'] : '';
	$_POST['a10'] = (isset($_POST['a10'])) ? $_POST['a10'] : '';
	$_POST['a11'] = (isset($_POST['a11'])) ? $_POST['a11'] : '';
	$_POST['a12'] = (isset($_POST['a12'])) ? $_POST['a12'] : '';
	$subject = "Version ".VERSION." - Questionnaire";
	$headers = "From: ".ADMIN_EMAIL."\r\n";
	$headers .= "Reply-To: ".ADMIN_EMAIL."\r\n";
	$headers .= "Return-Path: ".ADMIN_EMAIL."\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$message = "Name: ".$_SERVER['HTTP_HOST']."<p> License: ".KEY_ID."".
	"What was your impression of the company website? ".$_POST['a2']."<p>".
	"What was your impression of the products and services we offer?: ".$_POST['a3'].
	"<p>"."What was your impression of the software pricing?: ".$_POST['a4'].
	"<p>"."How was the support service (if applicable)? ".$_POST['a5'].
	"<p>"."How did you rate our dating software?: ".$_POST['a6']."<p>".
	"Would you recommend our software or services to friends and coluges ?: ".$_POST['a7'].
	"<p>"."Did you purchase any of our software or services?: ".$_POST['a8'].
	"<p>".	"Were you satisfied with the overal experience with 
                our company?: ".$_POST['a9']."<p>".
	"How could we improve our service? : ".$_POST['a10']."<p>"."For marketing purposes, please 
                advise how you heard of AdvanDate, LLC: ".$_POST['a11']."<p>".
	"Please use the space below for any additional comments or 
          details: : ".$_POST['a12'];
	mail("advandate@gmail.com",$subject,$message,$headers);
	
}

require_once( 'install_layout.php' );
print $tdata[1]["contents"];
if(DB_USER !="" && !isset($_SESSION['running_installer']) ){ require_once( 'install_complete.php' );}else{
?>

<div id="step" class="s2">Setup Complete!</div>
		<div class="clr"></div>
		<h1>Your website is now setup and ready to go!</h1>
<div style="border:1px dashed #990000; background:#FFE6E6; padding:5px; font-weight:bold;">PLEASE REMEMBER TO COMPLETELY<br/> REMOVE THE INSTALL DIRECTORY</div><br>
	<div class="form-block" style="padding: 0px;">
		
		<div class="ctr">&nbsp;&nbsp;
		  <table width="100%">
            <tr>
              <td align="center" style="font-size:16px;color:#666;"><strong>Admin Login Details</strong></td>
            </tr>
            <tr>
              <td align="center" style="font-size:13px;"><b>Username : <?=ADMIN_USERNAME ?></b></td>
            </tr>
            <tr>
              <td align="center" style="font-size:13px;"><b>Password : <?=ADMIN_PASSWORD ?></b></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
          </table>
		</div>
</div>
	
<br/><input name="Button2" type="submit" class="button" value="Login to the admin area" onclick="window.location='<?=DB_DOMAIN ?>newadmin/';" />
<?php } print $tdata[2]["contents"]; ?>