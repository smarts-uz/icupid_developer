<?php
error_reporting(0);
$con=mysql_connect("localhost","advandate","xsYf'7ujEv3n");
mysql_select_db("advandat_dating",$con);
$monthcount=array();
for($month_time=1;$month_time<=12;$month_time++)
{
	//$query="SELECT COUNT(et.Entity_Id),etd.sex FROM t_entity  et INNER t_entity_details etd JOIN  ON et.Entity_Id=etd.Entity_Id  WHERE MONTH(Create_Dt) ={$month_time} AND  etd.sex=1";
	
	
	/*no of male user*/
	$m_query="SELECT COUNT(t_entity.Entity_Id),t_entity_details.sex FROM t_entity INNER JOIN t_entity_details ON t_entity.Entity_Id=t_entity_details.Entity_Id WHERE MONTH(Create_Dt) ={$month_time} AND t_entity_details.sex=1";
	$m_months=mysql_query($m_query);
	$m_fetch=mysql_fetch_array($m_months);
	 $m_man_count[]=trim($m_fetch['COUNT(t_entity.Entity_Id)']);
	/* no of female */
	$f_query="SELECT COUNT(t_entity.Entity_Id),t_entity_details.sex FROM t_entity INNER JOIN t_entity_details ON t_entity.Entity_Id=t_entity_details.Entity_Id WHERE MONTH(Create_Dt) ={$month_time} AND t_entity_details.sex=2";
	$f_months=mysql_query($f_query);
	$f_fetch=mysql_fetch_array($f_months);
	 $f_female_monthcount[]=trim($f_fetch['COUNT(t_entity.Entity_Id)']);
	 /* no of total user*/
	$query="SELECT COUNT(Entity_Id) FROM t_entity WHERE MONTH(Create_Dt) ={$month_time}";
	$months=mysql_query($query);
	$fetch=mysql_fetch_array($months);
	$monthcount[]=trim($fetch['COUNT(Entity_Id)']);
}
$m_man_month_json=str_replace('"',"",json_encode($m_man_count));
$f_female_month_json=str_replace('"',"",json_encode($f_female_monthcount));
$month_json=str_replace('"',"",json_encode($monthcount));
//last 5 records

?>


<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!--<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>-->
<script src="inc/js/highcharts.js" type="text/javascript"></script>
<script src="inc/js/exporting.js" type="text/javascript"></script>
<script>

$(function () {
  $('#container1').highcharts({
            title: {
                text: 'Monthly No of user',
                x: -20 //center
            },
            subtitle: {
                text: 'Source: No of user',
                x: -20
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yAxis: {
                title: {
                    text: 'No. of User'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
			
            tooltip: {
                valueSuffix: 'user'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 1
            },
            series: [
			{
                name: 'No. of new user',
                data: <?php echo $month_json;?>
            }, 
			{
                name: 'No. of female',
                data: <?php echo $f_female_month_json?>
            }, 
			{
                name: 'No. of male',
                data: <?php echo $m_man_month_json;?>
            }, 
			
			]
        });
		
    });
    
</script>
</head>
<body>

<div id="container1" style="min-width: 100px; height: 300px; margin: 0 auto;">
 
</div>






   
<!--</div>-->
</body>

</html>



