<?php

defined( 'KEY_ID' ) or die( 'Restricted access' );


function DisplayNetworkCountries($country_id=0){

	global $DB;
	
	$result = "";

	$result = $DB->query("SELECT geo_network_country_id,country_name FROM geo_network_countries ORDER BY country_name");

	while( $country = $DB->NextRow($result) ){
		
		$seleted = "";
		if($country['geo_network_country_id'] == $country_id){
			$seleted = "selected='selected'";
		}

		$result .= "<option value='".$country['geo_network_country_id']."' $seleted>".$country['country_name']."</option>";

	}
	
	return $result;
}


function DisplayNetworkStates($country_id, $state_id=0){

	global $DB;
	
	$result = "";

	if($country_id != 0){
	
		$result2 = $DB->query("SELECT geo_network_state_id,state_name FROM geo_network_states WHERE geo_network_country_id='$country_id' AND state_name != '' ORDER BY state_name");
		
		while( $state = $DB->NextRow($result2) ){
			
			$seleted = "";
			if($state['geo_network_state_id'] == $state_id){
				$seleted = "selected='selected'";
			}

			$result .= "<option value='".$state['geo_network_state_id']."' $seleted>".$state['state_name']."</option>";
			
		}

	}
	
	return $result;
}

function DisplayNetworkCities($state_id, $city_id=0){

	global $DB;
	
	if($state_id != 0){
	
		$result2 = $DB->query("SELECT geo_network_city_id,city_name FROM geo_network_cities WHERE state_id = '$state_id' AND city_name != '' ORDER BY city_name");

		while( $city = $DB->NextRow($result2) ){
			$seleted = "";
			if($city['geo_network_city_id'] == $city_id){
				$seleted = "selected='selected'";
			}
			$result .= "<option value='".$city['geo_network_city_id']."' $seleted>".$city['city_name']."</option>";
		}

	}

	return $result;
}

function GetLocationDetails($ip_address){

	global $DB;
	list( $o1, $o2, $o3, $o4 ) = explode(".",$ip_address);
	$integer_ip = (16777216 * $o1) + (65536 * $o2) + (256 * $o3) + $o4;

	$geo_block = $DB->Row("SELECT geoname_id FROM geo_network_blocks WHERE (start_ip_num <= '$integer_ip' AND end_ip_num >= '$integer_ip') OR (start_ip_num >= '$integer_ip' AND end_ip_num <= '$integer_ip') LIMIT 1");

	//$goename_id = $geo_block['geoname_id'];
		
	$goename_id = 1261481;

	$geo_details = $DB->Row("SELECT geo_network_city_id,country_id,state_id, city_name FROM geo_network_cities WHERE geoname_id = '$goename_id'");

	$country_id = (isset($geo_details['country_id'])) ? $geo_details['country_id'] : 0; 
	$state_id = (isset($geo_details['state_id'])) ? $geo_details['state_id'] : 0;
	$city_id = (isset($geo_details['geo_network_city_id'])) ? $geo_details['geo_network_city_id'] : 0;
	DisplayNetworkCountries($country_id);
	DisplayNetworkStates($country_id,$state_id);
	DisplayNetworkCities($state_id,$city_id);
	
	return $integer_ip;
}

?>