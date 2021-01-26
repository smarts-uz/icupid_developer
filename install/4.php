<?php
$TabID=5;
require_once( '../inc/config.php' );
require_once( 'inc/func/common.php' );
require_once( 'install_layout.php' );

if($_POST['do']){

	// START CHAT ROOM SETUP
	$filename = '../inc/config.php';
	
	// UPDATE THE PAGE TITLES
	
	$DB->Update("UPDATE template_meta SET title=('".$_POST['S1']."') ");

	$_POST['S3'] = str_replace("//","/",$_POST['S3']);

	$_POST['S2'] = str_replace("//","/",$_POST['S2']);
	$_POST['S2'] = str_replace("http:/","http://",$_POST['S2']);

	////////////////////////////////////
	if (!$file = fopen($filename, 'a+b')) {
	
		die('The confg file is not writable, please CHMOD /inc/config.php to 777 and then refresh this page.');
		
		
	} else {

			$data = array();
			$counter = 1;
			$filecontent = "";
			while (!feof($file)) {


				$data[$counter] = fgets($file);
				
				 /* FILE UPLOAD PATHS */
				
				  if ( strstr($data[$counter], "'PATH_IMAGE',''") ) {

						$filecontent .= str_replace("'PATH_IMAGE',''", "'PATH_IMAGE','".$_POST['S3']."/uploads/images/'", $data[$counter]);
				  }
				  elseif ( strstr($data[$counter], "'PATH_IMAGE_THUMBS',''") ) {
						$filecontent .= str_replace("'PATH_IMAGE_THUMBS',''", "'PATH_IMAGE_THUMBS','".$_POST['S3']."/uploads/thumbs/'", $data[$counter]);
				  }
				  elseif ( strstr($data[$counter], "'PATH_VIDEO',''") ) {
						$filecontent .= str_replace("'PATH_VIDEO',''", "'PATH_VIDEO','".$_POST['S3']."/uploads/videos/'", $data[$counter]);
				  }
				  elseif ( strstr($data[$counter], "'PATH_MUSIC',''") ) {
						$filecontent .= str_replace("'PATH_MUSIC',''", "'PATH_MUSIC','".$_POST['S3']."/uploads/music/'", $data[$counter]);
				  }
				  elseif ( strstr($data[$counter], "'PATH_FILES',''") ) {
						$filecontent .= str_replace("'PATH_FILES',''", "'PATH_FILES','".$_POST['S3']."/uploads/files/'", $data[$counter]);
				  }

				 /* WEB UPLOAD PATHS */
 				

				  elseif ( strstr($data[$counter], "'WEB_PATH_IMAGE',''") ) {
						$filecontent .= str_replace("'WEB_PATH_IMAGE',''", "'WEB_PATH_IMAGE','".$_POST['S2']."/uploads/images/'", $data[$counter]);
				  }
				  elseif ( strstr($data[$counter], "'WEB_PATH_IMAGE_THUMBS',''") ) {
						$filecontent .= str_replace("'WEB_PATH_IMAGE_THUMBS',''", "'WEB_PATH_IMAGE_THUMBS','".$_POST['S2']."/uploads/thumbs/'", $data[$counter]);
				  }
				  elseif ( strstr($data[$counter], "'WEB_PATH_VIDEO',''") ) {
						$filecontent .= str_replace("'WEB_PATH_VIDEO',''", "'WEB_PATH_VIDEO','".$_POST['S2']."/uploads/videos/'", $data[$counter]);
				  }
				  elseif ( strstr($data[$counter], "'WEB_PATH_MUSIC',''") ) {
						$filecontent .= str_replace("'WEB_PATH_MUSIC',''", "'WEB_PATH_MUSIC','".$_POST['S2']."/uploads/music/'", $data[$counter]);
				  }
				  elseif ( strstr($data[$counter], "'WEB_PATH_FILES',''") ) {
						$filecontent .= str_replace("'WEB_PATH_FILES',''", "'WEB_PATH_FILES','".$_POST['S2']."/uploads/files/'", $data[$counter]);
				  }
				/* DEFAULT IMAGES */
/*
				  elseif ( strstr($data[$counter], "'DEFAULT_IMAGE',''") ) {
						$filecontent .= str_replace("'DEFAULT_IMAGE',''", "'DEFAULT_IMAGE','".$_POST['S2']."/images/DEFAULT/nophoto_1.gif'", $data[$counter]);
				  }
				  elseif ( strstr($data[$counter], "'DEFAULT_VIDEO',''") ) {
						$filecontent .= str_replace("'DEFAULT_VIDEO',''", "'DEFAULT_VIDEO','".$_POST['S2']."/images/DEFAULT/notavailable_2.gif'", $data[$counter]);
				  }
				  elseif ( strstr($data[$counter], "'DEFAULT_MUSIC',''") ) {
						$filecontent .= str_replace("'DEFAULT_MUSIC',''", "'DEFAULT_MUSIC','".$_POST['S2']."/images/DEFAULT/notavailable_2.gif'", $data[$counter]);
				  }
				  elseif ( strstr($data[$counter], "'WATINGAPPROVAL_IMAGE',''") ) {
						$filecontent .= str_replace("'WATINGAPPROVAL_IMAGE',''", "'WATINGAPPROVAL_IMAGE','".$_POST['S2']."/images/DEFAULT/waitingapproval_2.gif'", $data[$counter]);
				  }
				  elseif ( strstr($data[$counter], "'DEFAULT_IMAGE_ADULT',''") ) {
						$filecontent .= str_replace("'DEFAULT_IMAGE_ADULT',''", "'DEFAULT_IMAGE_ADULT','".$_POST['S2']."/images/DEFAULT/adultcontent_2.gif'", $data[$counter]);
				  }
				  
				   elseif ( strstr($data[$counter], "'DEFAULT_IMAGE_HOTLIST',''") ) {
							  	
						$filecontent .= str_replace("'DEFAULT_IMAGE_HOTLIST',''", "'DEFAULT_IMAGE_HOTLIST','".$_POST['S2']."/images/DEFAULT/adultcontent_2.gif'", $data[$counter]);
					}
							  
				 	elseif ( strstr($data[$counter], "'DEFAULT_IMAGE_FRIENDS',''") ) {
							  	
						$filecontent .= str_replace("'DEFAULT_IMAGE_FRIENDS',''", "'DEFAULT_IMAGE_FRIENDS','".$_POST['S2']."/images/DEFAULT/adultcontent_2.gif'", $data[$counter]);
					}*/
				/* ADMIN SUPER USER */

				  elseif ( strstr($data[$counter], "'ADMIN_USERNAME',''") ) {
						$filecontent .= str_replace("'ADMIN_USERNAME',''", "'ADMIN_USERNAME','".$_POST['S4']."'", $data[$counter]);
				  }
				  elseif ( strstr($data[$counter], "'ADMIN_PASSWORD',''") ) {
						$filecontent .= str_replace("'ADMIN_PASSWORD',''", "'ADMIN_PASSWORD','".$_POST['S5']."'", $data[$counter]);
				  }
				  elseif ( strstr($data[$counter], "'ADMIN_EMAIL',''") ) {
						$filecontent .= str_replace("'ADMIN_EMAIL',''", "'ADMIN_EMAIL','".$_POST['S6']."'", $data[$counter]);
				  }

				  else{
						$filecontent .= $data[$counter];
				  }
	
				  $counter ++;
		}
		 fclose($file);
	}
		
		//now we have to write in all the new data to this file
	   if (!$handle = fopen($filename, 'w')) { 
			 echo "Cannot open file ($filename)"; 
			 exit; 
	   }
	   // Write $somecontent to our opened file. 
	   if (fwrite($handle, $filecontent) === FALSE) { 
		   echo "Cannot write to file ($filename)"; 
		  exit; 
	   } 
	   fclose($handle);

				  	$subject = "iCupid Admin Password";
					$headers = "From: Admin <" . $_POST['S6'] . ">\r\n";
					$headers .= "Reply-To: " . $_POST['S6'] . "\r\n";
					$headers .= "Return-Path: " . $_POST['S6'] . "\r\n";
					$headers .= "X-Mailer: iCupid Software\r\n"; //mailer
					$headers .= "X-Priority: 1\r\n"; //1 UrgentMessage, 3 Normal
					$headers .= "MIME-Version: 1.0\r\n";
					$headers .= "Content-Type: text/plain; charset=".EMAIL_CHARSET."\r\n";
					$message = "Admin Login Details \n\n Username: ".$_POST['S4']." \n\n Password: ".$_POST['S5']." ";
					mail($_POST['S6'],$subject,$message,$headers);
}

print $tdata[1]["contents"];

if(DB_USER !="" && !isset($_SESSION['running_installer']) ){ require_once( 'install_complete.php' );}else{
?>
<style type="text/css">
<!--
.style1 {font-size: 10px}
-->
</style>


<form action="5.php" method="post" name="form" id="form">
<input type="hidden" name="do" value="send">
<div id="step" class="s3">Setup Started. Please Wait..</div>


		<div class="clr"></div>
		<h1>Please complete the short questionnare below.</h1>

		<div class="clr"></div>			
  				
				<TABLE width="100%" border=0 cellPadding=2 cellSpacing=1 borderColor=#cccccc bgcolor="#CCCCCC">
          <TBODY>
            <TR bgcolor="#FFFFFF" class=form> 
              <TD width="1232" height="20"><font size="2"><strong>Question</strong></font></TD>
              <TD align=center><font size="2"><strong>Poor</strong></font></TD>
              <TD align=center><font size="2"><strong>Average</strong></font></TD>
              <TD align=center><font size="2"><strong>Good</strong></font></TD>
            </TR>
            <TR bgcolor="#FFFFFF"> 
              <TD><span class="style1">What was your impression of the AdvanDate.com website?</span></TD>
              <TD width="86" align=center> <INPUT type=radio value=Poor 
                  name=a2> </TD>
              <TD width="121" align=center> <INPUT name=a2 type=radio 
                  value=Satisfactory checked> </TD>
              <TD width="68" align=center> <INPUT 
                  name=a2 type=radio value=Good> </TD>
            </TR>
            <TR bgcolor="#FFFFFF"> 
              <TD><span class="style1">What was your impression of the products and 
                services we offer?</span></TD>
              <TD width="86" align=center> <INPUT type=radio value=Poor 
                  name=a3> </TD>
              <TD width="121" align=center> <INPUT name=a3 type=radio 
                  value=Satisfactory checked> </TD>
              <TD width="68" align=center> <INPUT 
                  name=a3 type=radio value=Good> </TD>
            </TR>
            <TR bgcolor="#FFFFFF"> 
              <TD><span class="style1">What was your impression of the software pricing?</span></TD>
              <TD width="86" align=center> <INPUT type=radio value=Poor 
                  name=a4> </TD>
              <TD width="121" align=center> <INPUT name=a4 type=radio 
                  value=Satisfactory checked> </TD>
              <TD width="68" align=center> <INPUT 
                  name=a4 type=radio value=Good> </TD>
            </TR>
            <TR bgcolor="#FFFFFF"> 
              <TD><span class="style1">How was the support service (if applicable)?</span></TD>
              <TD width="86" align=center> <INPUT type=radio value=Poor 
                  name=a5> </TD>
              <TD width="121" align=center> <INPUT name=a5 type=radio 
                  value=Satisfactory checked> </TD>
              <TD width="68" align=center> <INPUT 
                  name=a5 type=radio value=Good> </TD>
            </TR>
            <TR bgcolor="#FFFFFF"> 
              <TD><span class="style1">How would you rate our dating software?</span></TD>
              <TD width="86" align=center> <INPUT type=radio value=Poor 
                  name=a6> </TD>
              <TD width="121" align=center> <INPUT name=a6 type=radio 
                  value=Satisfactory checked> </TD>
              <TD width="68" align=center> <INPUT 
                  name=a6 type=radio value=Good> </TD>
            </TR>
            <TR bgcolor="#FFFFFF"> 
              <TD><span class="style1">Would you recommend our software  
                to friends?</span></TD>
              <TD colSpan=3 align=left><font size="2">Yes: 
                <INPUT 
                  name=a7 type=radio class="radio" value=Yes checked>
                No: 
                <INPUT type=radio value=No 
                  name=a7 class="radio">
                </font></TD>
            </TR>
            <TR bgcolor="#FFFFFF"> 
              <TD><span class="style1">Were you satisfied with the overal experience 
                with AdvanDate?</span></TD>
              <TD colSpan=3 align=left><font size="2">Yes: 
                <INPUT 
                  name=a9 type=radio class="radio" value=Yes checked>
                No: 
                <INPUT type=radio value=No 
                  name=a9 class="radio">
                </font></TD>
            </TR>
          </TBODY>
        </TABLE>
				

		
        <p><strong>How could we improve our service for you? </strong></p>
        <TEXTAREA  name=a10 cols=45 rows="5" wrap=VIRTUAL style="width:100%; border:1px solid #666;"></TEXTAREA> 
              <p><strong>For marketing purposes, please advise how you heard of 
          AdvanDate.</strong><br>
                
          <TEXTAREA  name=a11 cols=45 rows="5" wrap=VIRTUAL style="width:100%; border:1px solid #666;"></TEXTAREA>
        </P>
  <p><strong>Please use the space below for any additional comments or details: 
          </strong> 
          <TEXTAREA  name=a12 cols=45 rows="5" wrap=VIRTUAL style="width:100%; border:1px solid #666;"></TEXTAREA>
  </p>
		<div class="clr"></div>
		<div class="clr"></div>
		
		<div class="ctr">&nbsp;&nbsp;</div>
				<br/>
					<input type="submit" class="button" value="Continue Installation" />
				<br/>	
</form>

<?php } print $tdata[2]["contents"]; ?>