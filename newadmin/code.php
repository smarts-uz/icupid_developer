<?php

function facts($n)
{
	if($n == 1) {echo 1;return;}
	echo $n;
	facts($n-1);	
}
//echo facts(35);
function fact($n, $total=1) {
if($n < 2)
return $total;
else
return fact($n-1, $total * $n);
}
echo fact(6);
function factorial($num)
{
if($num<2)
return 1;
return $num*factorial($num-1);
}
echo factorial(6);
for($i=0;$i<=3;$i++){for($j=0;$j<=$i;$j++){echo '*';}echo '<br />';}
?>