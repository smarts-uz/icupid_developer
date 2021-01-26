<div class="page">

	<div class="content">
	 	<div class="block">  
            <?php echo getMarketSiteHtml("admin_reports"); ?>
        </div>
		
        <div class="submenu">
            <h3 class="nav-tab-wrapper">
                <div class="nav-tab tab-report active year" onClick="WLDGetAdminReportBy('year');">Year</div>
                <div class="nav-tab tab-report last_month" onClick="WLDGetAdminReportBy('last_month');">Last Month</div>
                <div class="nav-tab tab-report cur_month" onClick="WLDGetAdminReportBy('cur_month');">This Momth</div>
                <div class="nav-tab tab-report last_days" onClick="WLDGetAdminReportBy('last_days');">Last 7 Days</div>
                <div class="nav-tab custom">Custom: <input type="date" name="from" value="" id="fromDate" placeholder="From"/> &nbsp;&nbsp;&nbsp; <input type="date" name="to" value="" id="toDate" placeholder="To"/> &nbsp;&nbsp;&nbsp; <input type="button" name="go" value="Go" onClick="WLDGetAdminReportBy('custom');" style="width: 40px; padding: 3px;" /></div>
            </h3>
        </div>

		<div class="box">
			<!--  HIGHCHART CODE START -->

		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		
		<script type="text/javascript">
			var global_load_by = '';
			$(document).ready(function(){

		    	var market_id = $("#select-market").val();
		      
		      	if(market_id == ""){
		      		market_id = 0;  
		      	}
		      
		      	var site_id = $("#select-site").val();
		      
		      	if(site_id == ""){
		        	site_id = 0;  
		      	}

		      	WLDGetAdminReportFigures(market_id,site_id);

		    });

    		function WLDGetAdminReportFigures(market_id = 0, site_id = 0, loadby = ""){

		      	if(!site_id){
		      		site_id = 0;
		      	}
		      	
		      	var fromDate = "";
		      	var toDate = "";
		      	
		      	if(global_load_by == 'custom'){
		      		var fromDate = $("#fromDate").val();
		      		var toDate = $("#toDate").val();
		      	}
		      	Timer_Icon('loadingGraph');
		      	$.ajax({
		        	url:"<?php echo DB_DOMAIN;?>newadmin/wld/ajax/json_actions.php?action=getAdminReportFigures",
		          	type:"POST",
		          	data: {market_id : market_id , site_id : site_id , load_by : global_load_by , from_date : fromDate , to_date : toDate},
		          	success: function(response){

						//alert(response);
		            	var rlt = $.parseJSON(response);

			            $("#total_earnings").html("$" + rlt.total_earnings);
			            $("#total_admin_earnings").html("$" + rlt.total_admin_earnings);
			            $("#total_customer_earnings").html("$" + rlt.total_customer_earnings);

			            var cats = $.map(rlt.graph_cats, function(value, index) { return [value]; });
    	        		var sites = $.map(rlt.graph_sites, function(value, index) { return [value]; });
        	    		//var regs = $.map(rlt.graph_regs, function(value, index) { return [value]; });
            			var pays = $.map(rlt.graph_pays, function(value, index) { return [value]; });
            			var admin_pays = $.map(rlt.graph_admin_pays, function(value, index) { return [value]; });
            			var customer_pays = $.map(rlt.graph_customer_pays, function(value, index) { return [value]; });

			            WLDGetDashboardGraphFigures(cats, pays, admin_pays, customer_pays);

			            $('#loadingGraph').html("");
          			},
          			error: function(response){
			            
			            $('#loadingGraph').html("");
 	             		$(".output-update-market").hide();
            			alert("Error in loading contents, please try again.");
            			console.log(response);
          			}
        		});

    		}
   		</script>

    	<script type="text/javascript">


    	function WLDGetAdminReportBy(loadby){

    			global_load_by = loadby;
  				$('.nav-tab').removeClass('active');
		      	
		      	$('.nav-tab-wrapper .'+ loadby).addClass('active');
  				
  				var market_id = 0;
  				var site_id = 0;

  				if(document.getElementById("select-market") && document.getElementById("select-market").value != ""){
  					market_id = document.getElementById("select-market").value;
  				}
  				if(document.getElementById("select-site") && document.getElementById("select-site").value != ""){
  					site_id = document.getElementById("select-site").value;
  				}

		      	WLDGetAdminReportFigures(market_id, site_id, loadby);

  			}

    		function WLDGetDashboardGraphFigures(cats, pays, admin_pays, customer_pays) {
      			
      			console.log(pays);
      			$('#report-container').highcharts({
			        chart: {
			            zoomType: 'xy'
			        },
			        title: {
			            text: ''
			        },
			        subtitle: {
			            text: ''
			        },
			        xAxis: [{
			            categories: cats,
			            crosshair: true
			        }],
			        tooltip: {
				    	pointFormat: "Value: {point.y:.2f}"
				    },
			        yAxis: [{ // Primary yAxis
			            labels: {
			                format: '$ {value}',
			                style: {
			                    color: Highcharts.getOptions().colors[2]
			                }
			            },
			            title: {
			                text: '',
			                style: {
			                    color: Highcharts.getOptions().colors[2]
			                }
			            },
			            opposite: true,
			            labels: {
			                enabled: false
			            }


			        }, { // Secondary yAxis
			            gridLineWidth: 0,
			            title: {
			                text: '',
			                style: {
			                    color: Highcharts.getOptions().colors[0]
			                }
			            },
			            labels: {
			                format: '$ {value}',
			                style: {
			                    color: Highcharts.getOptions().colors[0]
			                }
			            },
			            opposite: true,
			            labels: {
			                enabled: false
			            }

			        }],
			        tooltip: {
			            shared: true
			        },
			        legend: {
			            layout: 'vertical',
			            align: 'left',
			            x: 80,
			            verticalAlign: 'top',
			            y: 55,
			            floating: true,
			            backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#666666'
			        },
			        series: [{
			            name: 'Total Earning',
			            type: 'column',
			            yAxis: 1,
			            data: pays,
			            tooltip: {
			                valuePrefix: '$ '
			            },
			            color: {
			                radialGradient: { cx: 0.5, cy: 0.5, r: 0.5 },
			                stops: [
			                   [0, '#dbe0e3'],
			                   [1, '#dbe0e3']
			                ]
			            }

			        }, {
			            name: 'Admin Earning',
			            type: 'spline',
			            data: admin_pays,
			            tooltip: {
			                valuePrefix: '$ '
			            },
			            color: {
			                radialGradient: { cx: 0.5, cy: 0.5, r: 0.5 },
			                stops: [
			                   [0, '#e74433'],
			                   [1, '#e74433']
			                ]
			            }
			            
			        }, {
			            name: 'Customer Earning',
			            type: 'spline',
			            data: customer_pays,
			            tooltip: {
			                valuePrefix: ' $ '
			            },
			            color: {
			                radialGradient: { cx: 0.5, cy: 0.5, r: 0.5 },
			                stops: [
			                   [0, '#3598db'],
			                   [1, '#3598db']
			                ]
			            }
			        }]
			    });
  			}

  			
		

		</script>
	
<script src="<?php echo DB_DOMAIN; ?>/newadmin/wld/js/highcharts.js"></script>
<script src="<?php echo DB_DOMAIN; ?>/newadmin/wld/js/exporting.js"></script>
<div id="loadingGraph"></div>

<div class="report-left-sidebar">
    
        <div class="box-content">
            <div class="report-field" style="border-right:4px solid #aed2e8;">
                <span class="report-amount" id="total_earnings">?</span>
                <span class="report-label" style="position: absolute;top: 55%;">Total Earning</span>
            </div>
            <div class="report-field" style="border-right:4px solid #aed2e8;">
                <span class="report-amount" id="total_admin_earnings">?</span>
                <span class="report-label" style="position: absolute;top: 55%;">Total Admin Earning</span>
            </div>
            <div class="report-field" style="border-right:4px solid #2994d8;">
                <span class="report-amount" id="total_customer_earnings">?</span>
                <span class="report-label" style="position: absolute;top: 55%;">Total Customers Earning</span>
            </div>
            <?php /*<div class="report-field" style="border-right:4px solid #2994d8;">
                <span class="report-amount">$295.00</span>
                <span class="report-label">Total Refunds</span>
            </div>
            <div class="report-field" style="border-right:4px solid #d8e0e2;">
                <span class="report-amount">128</span>
                <span class="report-label">Total Subscriptions</span>
            </div>
            <div class="report-field" style="border-right:4px solid #ebeff0;">
                <span class="report-amount">136</span>
                <span class="report-label">Total Chargebacks</span>
            </div>
            <div class="report-field" style="border-right:4px solid #e74433;">
                <span class="report-amount">$378.00</span>
                <span class="report-label">Total Affiliate Earning</span>
            </div>*/?>

        </div>
    
</div>
<div id="report-container" style="width: 80%; height: 475px; float:left;"></div>


			<!-- HIGHCHART COE END -->
		</div>
	</div>
</div>