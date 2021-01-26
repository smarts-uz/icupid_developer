<?php

header('Content-Type: text/html; charset=UTF-8');

error_reporting(E_ALL ^ E_NOTICE);
set_error_handler('errorHandler');


function trace($message, $isWriteLog = true)
{
    $content = print_r($message, true);
    if($isWriteLog)
    {
        $handle = @fopen(LOG_DIR.'log.txt', 'a');
        @fwrite($handle, date("Y-m-d H:i:s")."\r\n".$content."\r\n\r\n");
        @fclose($handle);
    }
    else echo "<pre>".$content."</pre><br>";
}

function errorHandler($code, $msg, $file, $line)
{
    switch ($code)
    {
        case 2048: break; //ignore PHP5 errors
        case E_USER_ERROR:
            trace("*FATAL* $msg ($file:$line)");
            exit(1);
            break;
        case E_USER_WARNING:
            trace("*ERROR* $msg ($file:$line)");
            break;
        case E_USER_NOTICE:
            trace("*WARNING* $msg ($file:$line)");
            break;
        default: trace("$msg ($file:$line)");
    }
}

function showUpgradePlayerMessage($version = 8)
{
    $link = "http://www.adobe.com/go/getflashplayer";
    $message = "<p>You need to upgrade your Flash Player.</p>\n";
    $message .= "<p>Version ".$version." or higher is required.</p>\n";
    $message .= "download from <a href=\"".$link."\">".$link."</a>\n";
    return $message;
}

function checkInputParameters($strParams)
{
    $arrParams = explode(",", $strParams);
    $len = count($arrParams);
    for($i = 0; $i < $len; $i++)
    {
        $param = $arrParams[$i];
        if(!isset($_GET[$param]) && !isset($_POST[$param]))
        {
            die("invalid parameters - ".$arrParams[$i]." is undefined");
        }
    }
}

function getInputParam($param, $defaultValue = "")
{
    $value = $defaultValue;

    if( isset($_POST[$param]) ) $value = $_POST[$param];
    else if( isset($_GET[$param]) ) $value = $_GET[$param];

    if(get_magic_quotes_gpc()) $value = stripslashes($value);

    return $value;
}

?>
