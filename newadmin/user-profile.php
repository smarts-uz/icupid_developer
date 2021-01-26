<div id="user_profile" style="margin-left: 20px;">
<?php
error_reporting(0);
$con=mysql_connect("localhost","advandate","xsYf'7ujEv3n");
mysql_select_db("advandat_dating",$con);
$user_query="SELECT DISTINCT t_entity_details.Entity_Id, t_entity_details.First_Name, t_entity_details.Last_Name, t_entity_details.Profile_Pic_Url, t_entity.Create_Dt 
FROM t_entity
INNER JOIN t_entity_details ON t_entity.Entity_Id = t_entity_details.Entity_Id
ORDER BY t_entity_details.Entity_Id DESC 
LIMIT 5";
$user_query1=mysql_query($user_query);


echo "<table border='0'><tbody>";


while($user_detail=mysql_fetch_array($user_query1))
{ 
	?>  
	
	<tr>
			<td rowspan="2" style="background-color:#E9E9E9;"><img width="60px" height="60px" src='<?php echo $user_detail['Profile_Pic_Url'];?>'></td>
			<td height="23" style="background-color:#E9E9E9;"><?php echo $user_detail['First_Name'].'&nbsp;'.$user_detail['Last_Name'];?></td>
	</tr>
	<tr>
			<td style="background-color:#E9E9E9;"><?php echo $user_detail['Create_Dt'];?></td>
	</tr>

	
	

<?php	

}
echo "</tbody>";
echo "</table>";
?>
</div>