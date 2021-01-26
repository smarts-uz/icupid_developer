<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once "inc/config.php";
/* //https://maps.googleapis.com/maps/api/js?sensor=true&libraries=places&key=AIzaSyANs2Rmr2t8_siRyfkFd7Pcujj4r_Ut8r4
    
    // Get lat and long by address         
        $address = $_REQUEST['location']; // Google HQ
        $prepAddr = str_replace(' ','+',$address);
        $geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false'.
                '&key='.GOOGLE_MAPS_KEY);
        $output= json_decode($geocode);
        print_r($output);
        $latitude = $output->results[0]->geometry->location->lat;
        $longitude = $output->results[0]->geometry->location->lng;
        
        //echo 'lati******'.$latitude.' **** longitude'.$longitude;
        
     //   $orig_lat=30.695366;
     //  / $orig_lon=-88.039894;
      //  $dist=135;
        //https://www.scribd.com/presentation/2569355/Geo-Distance-Search-with-MySQL
        //https://developers.google.com/maps/solutions/store-locator/clothing-store-locator
         
        $lat=$latitude ;//30.695366;
        $lng=$longitude; //-88.039894;
        $dist=$_REQUEST['miles'];
       
       $query="SELECT *, ( 3959 * acos( cos( radians($lat) ) * cos( radians( ip_lat ) ) "
               . "* cos( radians( ip_long ) - radians($lng) ) + sin( radians($lat) ) * sin( radians( ip_lat ) ) ) )"
               . " AS distance FROM members HAVING distance <=$dist ORDER BY distance";
         echo '<br>'.$query;

/*Major cities near Mobile, AL

https://www.latlong.net/

    131 miles to New Orleans, LA
    185 miles to Baton Rouge, LA
    209 miles to Birmingham, AL
    *//*
echo $_SERVER['REMOTE_ADDR'];
$new_arr[]= unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR']));
echo "Latitude:".$new_arr[0]['geoplugin_latitude']." and Longitude:".$new_arr[0]['geoplugin_longitude'];
        */
echo 'testing***************88';

         ?>