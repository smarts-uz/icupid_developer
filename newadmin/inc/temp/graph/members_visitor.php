<?php
$d_array = array();
	for($i=0;$i!=14;$i++){
			
		$DisplayDate  = date("l jS",mktime(0, 0, 0, date("m")  , date("d")-$i, date("Y")));
		$d_array[] =$DisplayDate;		
	}
	$d_array = array_reverse($d_array);
?>
<script type="text/javascript" src="inc/js/_flash.js"></SCRIPT>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="inc/js/highcharts.js" type="text/javascript"></script>
<script src="inc/js/exporting.js" type="text/javascript"></script>-->
<script>

function ShowVisitorGraph(){

    $('#box-visitors').highcharts({
        title: {
            text: 'Web Site Visitors',
            x: -20 //center
        },
        subtitle: {
            text: 'Unique Web Site Visitors Over The Last 14 Days',
            x: -20
        },
        xAxis: {
            categories: ['<?=implode("','",$d_array)?>']
        },
        yAxis: {
            allowDecimals: false,
            title: {
                text: 'No. of Visitors'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
            
        tooltip: {
            valueSuffix: ' visitors(s)'
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
            data: [<?=trim(str_replace("*",",",GetVisitorGraphData()),",")?>]
        }, 
        ]
    });
}

</script>
</head>
<body>

<div id="members-graph" style="min-width: 100px;width:100%; height: 300px; margin: 0 auto;">
 
</div>






   
<!--</div>-->
</body>

</html>



