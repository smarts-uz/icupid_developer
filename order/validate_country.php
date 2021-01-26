<?php


$cords = file_get_contents("http://freegeoip.net/json/".$_GET['ipCode']);

$cord = json_decode($cords);


echo $cord->country_code.",,".$cord->country_name.",".$cord->latitude.",".$cord->longitude;