<?php

$xml = file_get_contents("php://input");

/*

ts -- timestamp in seconds (not milliseconds)
id -- userID
v -- has video
a -- has audio

<broadcasting ts="12345">
	<u id="1" v="true" a="true" />
	<u id="2" v="false" a="true" />
	<u id="3" v="true" a="false" />
</broadcasting>

*/

echo "Done";

?>