<?php
$d_array = array();
	for($i=0;$i!=14;$i++){
			
		$DisplayDate  = date("l jS",mktime(0, 0, 0, date("m")  , date("d")-$i, date("Y")));
		$d_array[] =$DisplayDate;		
	}
	$d_array = array_reverse($d_array);
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="inc/js/highcharts.js" type="text/javascript"></script>
<script src="inc/js/exporting.js" type="text/javascript"></script>
<script>

$(function () {
    ShowNewMembersGraph();
});
function ShowNewMembersGraph() {
    $('#members-graph').highcharts({
        title: {
            text: 'Last 14 Days',
            x: -20 //center
        },
        subtitle: {
            text: 'User Registered',
            x: -20
        },
        xAxis: {
            categories: ['<?=implode("','",$d_array)?>']
        },
        yAxis: {
			allowDecimals: false,
            title: {
                text: 'No. of Users'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
		
        tooltip: {
            valueSuffix: ' user(s)'
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
            data: [<?=trim(str_replace("*",",",GetMemberGraphData()),",")?>]
        }, 
		]
    });

    $('#members-statistics').highcharts({
        title: {
            text: 'Last 14 Days',
            x: -20 //center
        },
        subtitle: {
            text: 'User Registered',
            x: -20
        },
        xAxis: {
            categories: ['<?=implode("','",$d_array)?>']
        },
        yAxis: {
            allowDecimals: false,
            title: {
                text: 'No. of Users'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        
        tooltip: {
            valueSuffix: ' user(s)'
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
            data: [<?=trim(str_replace("*",",",GetMemberGraphData()),",")?>]
        }, 
        ]
    });
	
}
    
</script>

