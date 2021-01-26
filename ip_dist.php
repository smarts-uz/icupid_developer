<?php

$ip = $_SERVER['REMOTE_ADDR'];
$ip = '87.86.85.84';
$details = json_decode(file_get_contents("http://freegeoip.net/json/{$ip}"));
echo "<pre>";
//echo $details->city; // -> "Mountain View"
print_r($details);
echo "</pre>";