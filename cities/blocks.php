<?php

include("../inc/config.php");
global $DB;

$countries = $DB->Query("SELECT * FROM geo_network_states where geo_network_country_id in(90)");

while ($country = $DB->NextRow($countries)){
		
	$DB->Update("UPDATE geo_network_cities SET state_id = '".$country['geo_network_state_id']."' WHERE subdivision_1_iso_code = '".$country['state_code']."' AND subdivision_1_name = '".addslashes($country['state_name'])."' AND state_id = 0");

}
$DB->Disconnect();
?>