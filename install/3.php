<?php

set_time_limit(900);

$TabID = 4;

require_once( '../inc/config.php' );
require_once( 'inc/func/common.php' );
require_once( 'install_layout.php' );


//print_r($_POST);die;

if(isset($_POST['DBhostname'])){

	$DBhostname = strip_tags(trim($_POST['DBhostname']));
	$DBuserName = trim($_POST['DBuserName']);
	$DBpassword = trim($_POST['DBpassword']);
	$DBname  	= strip_tags(trim($_POST['DBname']));
	//$DBLicense 	= strip_tags(trim($_POST['DBLicense']));
	$DBDel  	= (isset($_POST['DBDel'])) ? strip_tags(trim($_POST['DBDel'])) : '';
	$DBBackup  	= (isset($_POST['DBBackup'])) ? strip_tags(trim($_POST['DBBackup'])) : '';
	$DBSample  	= (isset($_POST['DBSample'])) ? strip_tags(trim($_POST['DBSample'])) : '';
	$DBtype  	= (isset($_POST['install_type'])) ? strip_tags(trim($_POST['install_type'])) : '';
	 
	$errors = array();

	if (!$DBhostname || !$DBuserName || !$DBname) {
	
		db_err ('2.php','The database details provided are incorrect and/or empty.',$_POST);
		
	}

	$DB = new DB($DBhostname, $DBuserName, $DBpassword, $DBname, false, false, 'install');
	$DB_STATUS = $DB->Connect();
	
	if($DB_STATUS ==1){
		
			db_err ('2.php','The username ('.$DBuserName.') or password ('.$DBpassword.')  provided are incorrect.',$_POST);
	
	}elseif($DB_STATUS ==2){
		
			db_err ('2.php','The database does not exist and couldnt be created. Please manyally create it and try again.',$_POST);
	}


	// DO A DATABASE BACKUP IF REQUIRED
	if ($DBDel) {

		$tables=array();
		$result=mysql_query("SHOW TABLES");
		while ($row = mysql_fetch_array($result)){		$tables[]=$row[0];		}
			foreach ($tables as $table) {				
					
					$query = "DROP TABLE IF EXISTS `$table`";
					$DB->Update($query);			
				}
	}


	if($DBtype ==1){

		if (ob_get_level() == 0) ob_start();
		//print 1;
		// INSTALL DATABASE DATA
		populate_db( 'icupid.sql' );

			ob_flush();
			flush();
			usleep(50000);// delay minimum of .05 seconds to allow ie to flush to screen
			sleep(2);

		$DB->Disconnect();
		$DB = new DB($DBhostname, $DBuserName, $DBpassword, $DBname, false, false, 'install');
		$DB_STATUS = $DB->Connect();
		// INSTALL FIELD DATA
		populate_db( 'required_data.sql' );
		populate_db( 'required_data_2.sql' );
		populate_db( 'required_data_3.sql' );
	//print 2;
	// POSTCODE DATA

	if ($DBBackup) {
		
	   populate_db( 'required_data_1.sql' );	
	 

	 }
 		
		ob_flush();
		flush();
		usleep(50000);// delay minimum of .05 seconds to allow ie to flush to screen
		sleep(2);
		
		//populate_db( '_chinese.sql' );
		//populate_db( '_french.sql' );
		//populate_db( '_spanish.sql' );
		//populate_db( '_german.sql' );
		
		ob_end_flush();

	}elseif($DBtype ==2){

		// UPGRADE V9.3 TO V9.9
		populate_db( 'UPGRADE/v93-v99.sql' );
	
	}else{

		// UPGRADE V8 TO V9.9
		populate_db( 'UPGRADE/v8-v99.sql' );

	
	}		
	// SAVE THE DATA TO THE CONFIG FILE

$path = $_SERVER['HTTP_HOST'];
$Epath = str_replace("install/", "", $_SERVER['REQUEST_URI']);$Epath = str_replace("3.php", "", $Epath);$ext = explode("/",$Epath);if(isset($ext[1]) && strlen($ext[0]) =="" && strlen($ext[1]) >0){$path .= "/".$ext[1];}
	
$path = str_replace("//","/",$path);

$filename = '../inc/config_db.php';
	if (!$file = fopen($filename, 'a+b')) {
						
			die("THERE IS AN ERROR TRYING TO OPEN YOUR CONFIG FILE. PLEASE CHECK IT EXISTS AND IS WRITABLE. (inc/config_db.php)");
						
	} else {
					
			$data = array();
			$counter = 1;
			$filecontent = "";
			while (!feof($file)) {
								
										$data[$counter] = fgets($file);
									
										  if ( strstr($data[$counter], "'DB_HOST',''") ) {
										  
												$filecontent .= str_replace("'DB_HOST',''", "'DB_HOST','".$DBhostname."'", $data[$counter]);
										  }
										  elseif ( strstr($data[$counter], "'DB_USER',''") ) {
										  
												$filecontent .= str_replace("'DB_USER',''", "'DB_USER','".$DBuserName."'", $data[$counter]);
										  }
										  elseif ( strstr($data[$counter], "'DB_PASS',''") ) {
										  
												$filecontent .= str_replace("'DB_PASS',''", "'DB_PASS','".$DBpassword."'", $data[$counter]);
										  }
										  elseif ( strstr($data[$counter], "'DB_BASE',''") ) {
										  
												$filecontent .= str_replace("'DB_BASE',''", "'DB_BASE','".$DBname."'", $data[$counter]);
										  }								  
										
										  elseif ( strstr($data[$counter], "'DB_DOMAIN',''") ) {
										 
												$filecontent .= str_replace("'DB_DOMAIN',''", "'DB_DOMAIN','http://".$path."/'", $data[$counter]);
										  }
										  else{
												$filecontent .= $data[$counter];
										  }
										  
										  $counter ++;									  
									}
									fclose($file);
			}
			$handle = fopen($filename, 'w');
			fwrite($handle, $filecontent);
			fclose($handle);


			$filename = '../inc/config.php';
			if (!$file = fopen($filename, 'a+b')) {
						
							die("THERE IS AN ERROR TRYING TO OPEN YOUR CONFIG FILE. PLEASE CHECK IT EXISTS AND IS WRITABLE. (inc/config.php)");
						
			} else {
					
						$data = array();
						$counter = 1;
						$filecontent = "";
						while (!feof($file)) {
								
										$data[$counter] = fgets($file);
									
										  if ( strstr($data[$counter], "'D_TEMP',''") ) {
										  
												$filecontent .= str_replace("'D_TEMP',''", "'D_TEMP','emeeting'", $data[$counter]);
										  }
										  elseif ( strstr($data[$counter], "'DATESETUP',''") ) {
										 
												$filecontent .= str_replace("'DATESETUP',''", "'DATESETUP','".date('Y-m-d')."'", $data[$counter]);
										  }
										  else{
												$filecontent .= $data[$counter];
										  }
										  
										  $counter ++;									  
									}
									
									fclose($file);
									
			}
			$handle = fopen($filename, 'w');
			fwrite($handle, $filecontent);
			fclose($handle);
			
			$_SESSION['running_installer'] =1;
}

$server_path=dirname(realpath($_SERVER['SCRIPT_FILENAME']));
$server_path = str_replace("install", "", $server_path);

print $tdata[1]["contents"];

if(DB_USER !="" && !isset($_SESSION['running_installer']) ){ require_once( 'install_complete.php' );}else{

?>
<form action="4.php" method="post" name="form" id="form">
<input type="hidden" name="do" value=1>
<div id="step" class="s3">iCupid Website Setup</div>

  <div class="clr"></div>
		<h1>Website Configuration</h1>
		<div class="licensetext">
				
		</div>
		<div class="clr"></div>			
  				<div class="form-block">
  		 			<table width="600" >
                      <tr>
                        <td width="21"></td>
                        <td width="61"></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td colspan="2"> <strong>Website Title </strong><br/>
                        </td>
                        <td width="240"> <em>
                          <input name="S1" type="text" class="inputbox" size="40" /><br>
                        <span class="small">
                        e.g. Weclome to our new website!</span>                        </em></td>
                      </tr>
                      <tr>
                        <td colspan="2">Website URL </td>
                        <td><em>
                          <input name="S2" type="text" class="inputbox" size="40" value="<?php print "http://".$path; ?>"/>
                        </em></td>
                      </tr>
                      <tr>
                        <td colspan="2">Website Path </td>
                        <td><em>
                        <input name="S3" type="text" class="inputbox" size="40" value="<?=$server_path ?>"/>
</em></td>
                      </tr>
                      <tr>
                        <td colspan="2">&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="2">Admin Username </td>
                        <td><em>
                          <input name="S4" type="text" class="inputbox" value="admin" size="40" />
                        </em></td>
                      </tr>
                      <tr>
                        <td colspan="2">Admin Password </td>
                        <td><em>
                          <input name="S5" type="text" class="inputbox" value="<?php echo MakePassword(8); ?>" size="40" />
                        </em></td>
                      </tr>
                      <tr>
                        <td colspan="2">Admin Email </td>
                        <td><em>
                          <input name="S6" type="text" class="inputbox" size="40" />
                        </em></td>
                      </tr>
                    </table>
  				</div>

		
		<div class="clr"></div>
		<div class="clr"></div>
		
		<div class="ctr">&nbsp;&nbsp;</div>
				<br/>
					<input name="Button2" type="submit" class="button" value="Continue Installation" onclick="window.location='3.php';" />
				<br/>	
	</form>
<?php } print $tdata[2]["contents"];  ?>
