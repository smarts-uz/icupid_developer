<?php

function ValidateLicense($license){


		$pos = strpos($license, "VERSION9-EMEETING");
	 
		$license = $license;
		$installed_host="advandate.com";
		$installed_directory="/order"; 
		$query_string="license=".$license;		
		$query_string.="&access_ip=".$_SERVER['SERVER_ADDR'];
		$query_string.="&access_host=".$_SERVER['HTTP_HOST'];			
		
		$data=phpaudit_exec_socket($installed_host, $installed_directory, "/validate_internal.php", $query_string);
		$parser=@xml_parser_create('');
		@xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
		@xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
		@xml_parse_into_struct($parser, $data, $values, $tags);
		@xml_parser_free($parser);

		$returned=$values[0]['attributes'];
 

		if (isset($returned['status']) && $returned['status']=="invalid")
			{
				$error="Error: The license key entered is invalid";
			}
		if (isset($returned['status']) && $returned['status']=="invalid")
			{
				$error="Error: The license key entered is invalid";
			}
		
		elseif (isset($returned['status']) && $returned['status']=="suspended")
			{
				$error="Error: The license key entered has been suspended";
			}
		
		elseif (isset($returned['status']) && $returned['status']=="expired")
			{
				$error="Error: The license key entered has expired";
			}
		
		elseif (isset($returned['status']) && $returned['status']=="pending")
			{
				$error="Error: The license key entered is pending";
			}
		else{
			// if server has problems allow install
			
			$error="";
		}
		
		return $error;
}
function phpaudit_exec_socket($http_host, $http_dir, $http_file, $querystring)
	{
			
	$fp=@fsockopen($http_host, 80, $errno, $errstr, 5);
	if (!$fp) { return false; }
	else
		{
		$header="POST ".($http_dir.$http_file)." HTTP/1.0\r\n";
		$header.="Host: ".$http_host."\r\n";
		$header.="Content-type: application/x-www-form-urlencoded\r\n";
		$header.="User-Agent: PHPAudit v2 (http://www.phpaudit.com)\r\n";
		$header.="Content-length: ".@strlen($querystring)."\r\n";
		$header.="Connection: close\r\n\r\n";
		$header.=$querystring;

		$data=false;
		//die("here5: $error :: $returned");
		//@stream_set_timeout($fp, 20);		
		@fputs($fp, $header);
		
		$status=@socket_get_status($fp);
		while (!@feof($fp)&&$status) 
			{ 
			$data.=@fgets($fp, 1024);
			
			$status=@socket_get_status($fp);
			}
		@fclose ($fp);

		if (!$data) { return false; }
		
		$data=explode("\r\n\r\n", $data, 2);

		return $data[1];
		}
	}

function phpaudit_get_mac_address(){

		$fp=popen("/sbin/ifconfig", "r");
	
		if (!$fp) { return -1; } # returns invalid, cannot open ifconfig
	
		$res=@fread($fp, 4096);
		@pclose($fp);
	
		$array=@explode("HWaddr", $res);
		if (count($array)<2) { $array=@explode("ether", $res); } # FreeBSD
		$array=@explode("\n", $array[1]);
		$buffer[]=@trim($array[0]);
	
		$array=@explode("inet addr:", $res);
		if (count($array)<2) { $array=@explode("inet ", $res); } # FreeBSD
		$array=@explode(" ", $array[1]);
		$buffer[]=@trim($array[0]);
	
		return $buffer;
}
function MakePassword($length) {
	$salt = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	$len = strlen($salt);
	$makepass="";
	mt_srand(10000000*(double)microtime());
	for ($i = 0; $i < $length; $i++)
	$makepass .= $salt[mt_rand(0,$len - 1)];
	return $makepass;
}
/**
* Chmods files and directories recursivel to given permissions
* @param path The starting file or directory (no trailing slash)
* @param filemode Integer value to chmod files. NULL = dont chmod files.
* @param dirmode Integer value to chmod directories. NULL = dont chmod directories.
* @return TRUE=all succeeded FALSE=one or more chmods failed
*/
function mosChmodRecursive($path, $filemode=NULL, $dirmode=NULL)
{
	$ret = TRUE;
	if (is_dir($path)) {
		$dh = opendir($path);
		while ($file = readdir($dh)) {
			if ($file != '.' && $file != '..') {
				$fullpath = $path.'/'.$file;
				if (is_dir($fullpath)) {
					if (!mosChmodRecursive($fullpath, $filemode, $dirmode))
						$ret = FALSE;
				} else {
					if (isset($filemode))
						if (!@chmod($fullpath, $filemode))
							$ret = FALSE;
				} // if
			} // if
		} // while
		closedir($dh);
		if (isset($dirmode))
			if (!@chmod($path, $dirmode))
				$ret = FALSE;
	} else {
		if (isset($filemode))
			$ret = @chmod($path, $filemode);
	} // if
	return $ret;
} // mosChmodRecursive

function get_php_setting($val) {
	$r =  (ini_get($val) == '1' ? 1 : 0);
	return $r ? 'ON' : 'OFF';
}

function writableCell( $folder, $relative=1, $text='' ) {
	$writeable 		= '<b><font color="green">Writeable</font></b>';
	$unwriteable 	= '<b><font color="red">Unwriteable</font></b>';

	echo '<tr>';
	echo '<td class="item">' . $folder . '/</td>';
	echo '<td align="right">';
	if ( $relative ) {
		echo is_writable( "../$folder" ) 	? $writeable : $unwriteable;
	} else {
		echo is_writable( "$folder" ) 		? $writeable : $unwriteable;
	}
	echo '</tr>';
}

/**
 * @param object
 * @param string File name
 */
function populate_db( $sqlfile='emeeting.sql') {

	global $errors;
	global $DB;

	
	
	$query = fread( fopen( 'inc/data/' . $sqlfile, 'r' ), filesize( 'inc/data/' . $sqlfile ) );
	$pieces  = split_sql($query);

	for ($i=0; $i<count($pieces); $i++) {
		$pieces[$i] = trim($pieces[$i]);
		if(!empty($pieces[$i]) && $pieces[$i] != "#") {
			$DB->Create( $pieces[$i] );
			/*if (!$database->query()) {
				$errors[] = array ( $database->getErrorMsg(), $pieces[$i] );
			}*/
		}
	}
}

/**
 * @param string
 */
function split_sql($sql) {
	$sql = trim($sql);
	//$sql = ereg_replace("\n#[^\n]*\n", "\n", $sql);

	$buffer = array();
	$ret = array();
	$in_string = false;

	for($i=0; $i<strlen($sql)-1; $i++) {
		if($sql[$i] == ";" && !$in_string) {
			$ret[] = substr($sql, 0, $i);
			$sql = substr($sql, $i + 1);
			$i = 0;
		}

		if($in_string && ($sql[$i] == $in_string) && $buffer[1] != "\\") {
			$in_string = false;
		}
		elseif(!$in_string && ($sql[$i] == '"' || $sql[$i] == "'") && (!isset($buffer[0]) || $buffer[0] != "\\")) {
			$in_string = $sql[$i];
		}
		if(isset($buffer[1])) {
			$buffer[0] = $buffer[1];
		}
		$buffer[1] = $sql[$i];
	}

	if(!empty($sql)) {
		$ret[] = $sql;
	}
	return($ret);
}

function db_err($step, $alert, $data) {
	if(!isset($data['DBhostname'])){$data['DBhostname']=""; }
	if(!isset($data['DBuserName'])){$data['DBuserName']=""; }
	if(!isset($data['DBpassword'])){$data['DBpassword']=""; }
	if(!isset($data['DBLicense'])){$data['DBLicense']=""; }
	if(!isset($data['DBDel'])){$data['DBDel']=""; }
	if(!isset($data['DBname'])){$data['DBname']=""; }

	echo "<form method=\"post\" action=\"$step\" id=\"$step\">
	<input type=\"hidden\" name=\"DBhostname\" value=\"".$data['DBhostname']."\">
	<input type=\"hidden\" name=\"DBuserName\" value=\"".$data['DBuserName']."\">
	<input type=\"hidden\" name=\"DBpassword\" value=\"".$data['DBpassword']."\">
	<input type=\"hidden\" name=\"DBLicense\" value=\"".$data['DBLicense']."\">
	<input type=\"hidden\" name=\"DBDel\" value=\"".$data['DBDel']."\">
	<input type=\"hidden\" name=\"DBname\" value=\"".$data['DBname']."\">
	</form>\n";
	//echo "<script>alert(\"$alert\"); window.history.go(-1);</script>";
	echo "<script>alert(\"$alert\"); document.location.href='".$step."';</script>";
	exit();
}
?>