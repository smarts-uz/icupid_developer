<?php
$TabID=1;
$sp 		= ini_get( 'session.save_path' );
require_once( '../inc/config.php' );
require_once( 'inc/func/common.php' );
require_once( 'install_layout.php' );
$version 	= VERSION;

if(!isset($_POST['start'])){
header("location: index.php");
}
if(isset($_POST['start'])){

	if($_POST['Key1'] == '') {
	
		db_err ('index.php','You have not entered a valid license key.',$_POST);
		
	}
	
	$LicenseCheck = ValidateLicense($_POST['Key1']);
	
	if($LicenseCheck != '') {
	
		db_err ('index.php',$LicenseCheck,$_POST);
		
	}
	
	
	// WRITE THE LICENSE KEY TO THE DATABASE
	$ProductType = explode("_",$_POST['Key1']);
	
	
	$filename = '../inc/config_db.php';

	if (!$file = fopen($filename, 'a+b')) {						
			//die("THERE IS AN ERROR TRYING TO OPEN YOUR CONFIG FILE. PLEASE CHECK IT EXISTS AND IS WRITABLE. (".$filename.")");						
	} else {
					
			$data = array();
			$counter = 1;
			$filecontent = "";
			while (!feof($file)) {
								
										$data[$counter] = fgets($file);
									
										 if ( strstr($data[$counter], "'KEY_ID',''") ) {
										 
												$filecontent .= str_replace("'KEY_ID',''", "'KEY_ID','".$_POST['Key1']."'", $data[$counter]);
										  }
										 
										 
										 // auto matic branding 										
										/*
										  elseif ( strstr($data[$counter], "'BRAND_ID',''") && ( ( $ProductType[1] == "PACK2") || ( $ProductType[1] =="PACK3" ) )  ) {
										  
												$filecontent .= str_replace("'BRAND_ID',''", "'BRAND_ID','".$ProductType[2]."'", $data[$counter]);
										  }
										 
										
										  
										  elseif ( strstr($data[$counter], "'MAPS_ID',''") && ( $ProductType[1] == "PACK3" )  ) {
										  
												$filecontent .= str_replace("'MAPS_ID',''", "'MAPS_ID','".$ProductType[2]."'", $data[$counter]);
										  }*/
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
}


print $tdata[1]["contents"];
if(DB_USER !=""){ require_once( 'install_complete.php' );}else{
?>

			
				<div id="step" class="s1">pre-installation check</div>

				
				<div class="clr"></div>

				<h1 style="text-align: center; border-bottom: 0px;">
					iCupid Dating Software <?php echo $version; ?>
				</h1>

				<h1>
					Required Settings Check:
				</h1>

				<div class="install-text">
					<p>
						If any of these items are highlighted in red then please take actions to correct them.
					</p>
					<p>
						Failure to do so could lead to your iCupid Dating Software installation not functioning correctly.
					</p>
					<div class="ctr"></div>
				</div>

				<div class="install-form">
					<div class="form-block">
						<table class="content">
						<tr>
							<td class="item">
								PHP version >= 7.0
							</td>
							<td align="left">
								<?php echo phpversion() < '5.6' ? '<b><font color="red">No</font></b>' : '<b><font color="green">Yes</font></b>';?>
							</td>
						</tr>
						<tr>
							<td>
								&nbsp; - zlib compression support
							</td>
							<td align="left">
								<?php echo extension_loaded('zlib') ? '<b><font color="green">Available</font></b>' : '<b><font color="red">Unavailable</font></b>';?>
							</td>
						</tr>
						<tr>
							<td>
								&nbsp; - XML support
							</td>
							<td align="left">
								<?php echo extension_loaded('xml') ? '<b><font color="green">Available</font></b>' : '<b><font color="red">Unavailable</font></b>';?>
							</td>
						</tr>
						<tr>
							<td>
								&nbsp; - MySQL support
							</td>
							<td align="left">
								<?php echo function_exists( 'mysqli_connect' ) ? '<b><font color="green">Available</font></b>' : '<b><font color="red">Unavailable</font></b>';?>
							</td>
						</tr>
									
						 
						<tr>
							<td valign="top" class="item">
								configuration.php
							</td>
							<td align="left">
								<?php
								if (@file_exists('../inc/config_db.php') &&  @is_writable( '../inc/config_db.php' )){
									echo '<b><font color="green">Writeable</font></b>';
								} else if (is_writable( '..' )) {
									echo '<b><font color="green">Writeable</font></b>';
								} else {
									echo '<b><font color="red">Unwriteable</font></b><br /><span class="small">You must CHMOD 777 the config files before you continue. /inc/config_db.php and /inc/config.php</span>';
								}
								?>
							</td>
						</tr>
						</table>
					</div>
				</div>
				<div class="clr"></div>

				<?php
				$wrongSettingsTexts = array();

				if ( ini_get('magic_quotes_gpc') != '1' ) {
					$wrongSettingsTexts[] = 'PHP magic_quotes_gpc setting is `OFF` instead of `ON`';
				}
				if ( ini_get('register_globals') == '1' ) {
					$wrongSettingsTexts[] = 'PHP register_globals setting is `ON` instead of `OFF`';
				}

				if ( count($wrongSettingsTexts) ) {
					?>
					<h1>
						Security Check:
					</h1>

					<div class="install-text">
						<p>
							Following PHP Server Settings are not optimal for <strong>Security</strong> and it is recommended to change them:
						</p>
						
						<div class="ctr"></div>
					</div>

					<div class="install-form">
						<div class="form-block" style=" border: 1px solid #cc0000; background: #ffffcc;">
							<table class="content">
							<tr>
								<td class="item">
									<ul style="margin: 0px; padding: 0px; padding-left: 5px; text-align: left; padding-bottom: 0px; list-style: none;">
										<?php
										foreach ($wrongSettingsTexts as $txt) {
											?>
											<li style="min-height: 25px; padding-bottom: 5px; padding-left: 25px; color: red; font-weight: bold; background-image: url(inc/images/warning.png); background-repeat: no-repeat; background-position: 0px 2px;" >
												<?php
												echo $txt;
												?>
											</li>
											<?php
										}
										?>
									</ul>
								</td>
							</tr>
							</table>
						</div>
					</div>
					<div class="clr"></div>
					<?php
				}
				?>

				<h1>
					Recommended Settings Check:
				</h1>

				<div class="install-text">
					<p>
						These settings are recommended for PHP in order to ensure full
						compatibility with iCupid Dating Software.					</p>
					<p>
						However, iCupid Dating Software will still operate if your settings do not quite match the recommended					</p>
				  <div class="ctr"></div>
				</div>

<div class="install-form">
					<div class="form-block">

						<table class="content">
						<tr>
							<td class="toggle" width="500px">
								Directive
							</td>
							<td class="toggle">
								Recommended
							</td>
							<td class="toggle">
								Actual
							</td>
						</tr>
						<?php
						$php_recommended_settings = array(array ('Safe Mode','safe_mode','OFF'),
							array ('Display Errors','display_errors','ON'),
							array ('File Uploads','file_uploads','ON'),
							array ('Magic Quotes GPC','magic_quotes_gpc','ON'),
							array ('Magic Quotes Runtime','magic_quotes_runtime','OFF'),
							array ('Register Globals','register_globals','OFF'),
							array ('Output Buffering','output_buffering','OFF'),
							array ('Session auto start','session.auto_start','OFF'),
						);

						foreach ($php_recommended_settings as $phprec) {
							?>
							<tr>
								<td class="item">
									<?php echo $phprec[0]; ?>:
								</td>
								<td class="toggle">
									<?php echo $phprec[2]; ?>:
								</td>
								<td>
									<b>
										<?php
										if ( get_php_setting($phprec[1]) == $phprec[2] ) {
											?>
											<font color="green">
											<?php
										} else {
											?>
											<font color="red">
											<?php
										}
										echo get_php_setting($phprec[1]);
										?>
										</font>
									</b>
								<td>
							</tr>
							<?php
						}
						?>
						</table>
					</div>
				</div>
				<div class="clr"></div>

				<h1>
					Directory and File Permissions Check:
				</h1>

				<div class="install-text">
					<p>
						In order for iCupid Dating Software to function correctly it needs to be able to access or write to certain files or directories.					</p>
			  <p>
						If you see "Unwriteable" you need to change the permissions on the file or directory to allow iCupid Dating Software to write to it.					</p>
				  <div class="clr">&nbsp;&nbsp;</div>
					<div class="ctr"></div>
				</div>

<div class="install-form">
					<div class="form-block">
						<table class="content">
						<?php
						writableCell( 'inc/config.php' );
						writableCell( 'inc/config_db.php' );
						writableCell( 'plugins/config_plugins.php' );
						//writableCell( 'uploads' );
						writableCell( 'uploads/images' );
						writableCell( 'uploads/thumbs' );
						writableCell( 'uploads/videos' );
						writableCell( 'uploads/music' );
						writableCell( 'inc/langs/english.php' );
						?>
						</table>
						</div>			
				</div>
				
				<div class="ctr">&nbsp;&nbsp;</div>
				<br/>
					<input type="button" class="button" value="Refresh Page" onclick="window.location=window.location" /> 
					<input name="Button2" type="submit" class="button" value="Continue Installation" onclick="window.location='2.php';" />
				<br/>
<?php } print $tdata[2]["contents"]; ?>