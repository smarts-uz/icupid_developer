<?php
$TabID=3;
require_once( '../inc/config.php' );
require_once( 'inc/func/common.php' );
require_once( 'install_layout.php' );

print $tdata[1]["contents"];
if(DB_USER !=""){ require_once( 'install_complete.php' );}else{
?>

<script>
function idShowHide(obj) {
     var el = document.getElementById(obj);
     if ( el.style.display != "none" ) {
     el.style.display = 'none';
     } else {
     el.style.display = 'block';
     }
}
function CheckData() {

	// form validation check
	var formValid=false;
	var f = document.form;
	if ( f.DBhostname.value == '' ) {
		alert('Please enter a Host name');
		f.DBhostname.focus();
		formValid=false;
	} else if ( f.DBuserName.value == '' ) {
		alert('Please enter a Database User Name');
		f.DBuserName.focus();
		formValid=false;
	} else if ( f.DBname.value == '' ) {
		alert('Please enter a Name for your new Database');
		f.DBname.focus();
		formValid=false;
	} else if ( confirm('Are you sure these settings are correct? \niCupid will now attempt to populate a Database with the settings you have supplied')) {
		idShowHide('dataform');
		idShowHide('loading');
		formValid=true;
	}

	return formValid;
}
</script>



<div id="step" class="s3">iCupid Database Setup</div>

<div id="loading" style="display:none;">
	
	<div class="clr"></div>
	<h1>Your Database is now being setup:</h1>
	<div class="clr"></div><div class="clr"></div>
	
	<p style="font-size:15px;font-weight:bold;">Please Wait</p>
	<img src="inc/images/loading.gif">
	
	<div class="clr"></div><div class="clr"></div>
	
	<p>This process may take upto 5 minutes so please be patient.</p>

</div>

<div id="dataform" style="display:visible;">

<form action="3.php" method="post" name="form" id="form" onSubmit="return CheckData();">
		<div class="clr"></div>
		<h1>MYSQL Database Information:</h1>
		<div class="clr"></div>			
  				<div class="form-block">
  		 			<table >
  		  			<tr>
  						<td></td>
  						<td></td>
  						<td></td>
  					</tr>
  		  			<tr>
  						<td colspan="2">
  							<strong>Host Name</strong><br/>
					  <input class="inputbox" type="text" name="DBhostname" value="<?php if(isset($_POST['DBhostname'])){ echo $_POST['DBhostname']; }else{  print "localhost"; } ?>" />					  </td>
			  			<td>
			  				<em>This is usually 'localhost'</em>
</td>
  					</tr>
					<tr>
			  			<td colspan="2">
			  				<strong>MySQL User Name
			  				</strong><br/>
	  				  <input class="inputbox" type="text" name="DBuserName" value="<?php if(isset($_POST['DBuserName'])){ echo $_POST['DBuserName']; } ?>"/>		  			  </td>
			  			<td><em>Enter your MYSQL username, if your using Cpanel, this is often the same username for cpanel. </em> </td>
  					</tr>
			  		<tr>
			  			<td colspan="2">
			  				<strong>MySQL Password
			  				</strong><br/>
	  				  <input class="inputbox" type="text" name="DBpassword" value="<?php if(isset($_POST['DBpassword'])){ echo $_POST['DBpassword']; } ?>" />		  			  </td>
			  			<td>
			  				<em>Enter your MYSQL database name, if your using Cpanel, this is often the same password for cpanel. </em></td>
					</tr>
  		  			<tr>
  						<td colspan="2">
  							<strong>MySQL Database Name</strong>						  <br/>
					  <input class="inputbox" type="text" name="DBname" value="<?php if(isset($_POST['DBname'])){ echo $_POST['DBname']; } ?>" />					  </td>
			  			<td>
			  				<em>Make sure you have setup a MYSQL database via your hosting control panel first. </em></td>
  					</tr>
  		  			<tr>
			  			<td colspan="2"><strong>Installation Type </strong><br/>
			  			  <select name="install_type">
			  			    <option value="1">Fresh Installation</option>
							<option value="2">Database Upgrade (V9.3 - V<?=VERSION ?>)</option>
			  			    <option value="0">Database Upgrade (V8 - V<?=VERSION ?>)</option>
		  			      </select>			  			  
		  				</td>
						<td><em>Only select 'database upgrade' if you are upgrading your website from eMeeting version 7. </em>
  						</td>
			  		</tr>
  		  			<tr>
			  			<td height="35" valign="bottom">
	  				  <input type="checkbox" name="DBDel" id="DBDel" value="1"  /></td>
						<td valign="bottom">
							<label for="DBDel">Drop Existing Tables</label>					  </td>
  						<td>
  						</td>
			  		</tr>
  		  			<tr>
			  			<td>
			  				<input name="DBBackup" type="checkbox" id="DBBackup" value="1" />
			  			</td>
						<td>
							<label for="DBBackup">Install Postcodes </label></td>
  						<td>
  							<em><strong>Note:</strong> If you have problems with the installation going blank, uncheck this box. </em></td>
			  		</tr>
  		  			<tr>
			  			<td>
			  				<input name="DBSample" type="checkbox" id="DBSample" value="1" checked />
			  			</td>
						<td>
							<label for="DBSample">Install Sample Data</label>
						</td>
			  			<td>
			  				<em>This will install a few sample profiles to help you get started. </em></td>
			  		</tr>
		  		 	</table>
  				
			</div>

		
		<div class="clr"></div>
		<div class="clr"></div>
		
		<div class="ctr">&nbsp;&nbsp;</div>
				<br/>
					<input type="submit" class="button" value="Continue Installation" />
				<br/>	
</form>
</div>
<?php } print $tdata[2]["contents"]; ?>