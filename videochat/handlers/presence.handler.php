<?php

$xml = file_get_contents("php://input");

/*
ts -- timestamp in seconds (not milliseconds)
e -- user enter
l -- user leave
inv -- user became invisible
vis -- user became visible

<presenceDelta ts="123456">
	<e>1</e>
	<e>2</e>
 	<inv>2</inv>
	<l>1</l>
 	<vis>2</vis>
</presenceDelta>

<presenceFull ts="123456">
	<id>1</id>
	<id inv="1">2</id>
	<id>3</id>
</presenceFull>
*/

echo 'Done';

?>