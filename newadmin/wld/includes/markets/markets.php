<style>
.output-update-market,.output-add-market{
	font-size: 14px;
    font-weight: bold;
    margin: 10px 0px;
    color: #0f8001;
    border: 2px solid #0f8001;
    padding: 10px;
}
.output-add-market{
    
    margin: 0px 0px 20px 0px;
    min-width: 400px;
}
</style>

<div class="page" id="pg-markets">
	<div class="content">
		<div class="block">
			<div class="box">
				<div class="box-content">
					<div class="output-update-market" style="display:none;">Loading....</div>
					<div class="field choose-market">
						<label>Choose Market:</label>
						<span>
						<?php	
						echo getMarketsHtml();
						?>
						</span>
					</div>
					<div class="field m-market-comm"><label>Market Name:</label><span><input type="text" id="market-name" name="market_name" value=""/></span></div>
					<div class="field m-date-format"><label>Database Name:</label><span><input type="text" id="market-database-name" name="database_name" value=""/></span></div>
					<div class="field m-banned-usernames"><label>Database Username:</label><span><input type="text" id="market-database-username" name="database_username" value=""/></span></div>
					<div class="field m-seo-fiendly"><label>Database Password:</label><span><input type="text" id="market-database-password" name="database_password" value=""/></span></div>
					<div class="field m-lang-flag"><label>Database Path:</label><span><input type="text" id="market-database-path" name="database_path" value=""/></span></div>
					<div class="field m-lang-flag"><label></label><span><input type="submit" name="market_update" id="update-market" class="MainBtn" value="Update"/></span></div>
				</div>
			</div>
		</div>
		<div class="block">
			<div class="box">
				<div class="field m-lang-flag"><span><input type="button" id="btn-add-market" class="MainBtn" value="Add New Market"/></span></div>
			</div>
		</div>
	</div>
</div>

<?php /****** ADD MARKET ******/ ?>


<div class="page" id="pg-add-market" style="display:none;">
	<div class="heading" style="margin-bottom: 20px;">
		<h2 style="font-weight:bold;">Add Market</h2>
	</div>
	<div class="content">
        <div class="output-add-market" style="display:none;">Loading....</div>
		<div class="admin-note">
			<p id="TopCommentsBox"><img src="inc/images/icons/help.png" align="admin-note-text"> Listed below are a list of website events, you can select which events you would like the system ti send you an email notification. Email notifications will be sent to all sys.</p>
		</div>
		<div class="block">
			<div class="box">
				<div class="box-content">
					<div class="field m-market-comm"><label>Market Name:</label><span><input type="text" id="new-market-name" name="new_market_name" value=""/></span></div>
					<div class="field m-date-format"><label>Database Name:</label><span><input type="text" id="new-market-database-name" name="new_database_name" value=""/></span></div>
					<div class="field m-banned-usernames"><label>Database Username:</label><span><input type="text" id="new-market-database-username" name="new_database_username" value=""/></span></div>
					<div class="field m-seo-fiendly"><label>Database Password:</label><span><input type="text" id="new-market-database-password" name="new_database_password" value=""/></span></div>
					<div class="field m-lang-flag"><label>Database Path:</label><span><input  type="text" id="new-market-database-path" name="new_database_path" value=""/></span></div>
					<div class="field m-lang-flag"><label></label><span><input type="submit" id="add-market" name="market_add" class="MainBtn" value="Add Market"/></span></div>
				</div>
			</div>
		</div>
		<div class="block">
			<div class="box">
				<div class="field m-lang-flag"><span><input type="button" id="btn-markets" class="MainBtn" value="Markets"/></span></div>
			</div>
		</div>

	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("#btn-add-market").click(function(){
    	$("#pg-markets").hide();
    	$("#pg-add-market").show();
    });

    $("#btn-markets").click(function(){
    	$("#pg-markets").show();
    	$("#pg-add-market").hide();
    });

             
	$("#select-market").on('change',function(){

		$(".output-update-market").html("Loading...");
		$(".output-update-market").show();
    	
    	var mid = $("#select-market").val();
        $.ajax({
        	url:"<?php echo DB_DOMAIN;?>newadmin//wld/ajax/json_actions.php?action=getmarketdetail",
            type:"POST",
            dataType: 'json',
            data: {mid : mid},
            success: function(response){

            	$("#market-name").val(response.market_name);
                $("#market-database-name").val(response.market_database_name);
                $("#market-database-username").val(response.market_database_username);
                $("#market-database-password").val(response.market_database_password);
                $("#market-database-path").val(response.market_database_path);

                $(".output-update-market").hide();
            },
            error: function(response){
                $(".output-update-market").hide();
                alert("Error in loading contents, please try again.");
                console.log(response);
            }
        });

        //return false;
    });
        
    $("#update-market").on('click',function(){
    	
    	$(".output-update-market").html("Loading...");
		$(".output-update-market").show();

    	var mid = $("#select-market").val();
    	var market_name = $("#market-name").val();
        var market_database_name = $("#market-database-name").val();
        var market_database_username = $("#market-database-username").val();
        var market_database_password = $("#market-database-password").val();
        var market_database_path = $("#market-database-path").val();

        if(mid == ""){
        	alert("Please select your market.");
        	return false;
        }

        $.ajax({
        	url:"<?php echo DB_DOMAIN;?>newadmin//wld/ajax/json_actions.php?action=updatemarketdetail",
            type:"POST",
            data: {mid : mid , market_name : market_name , market_database_name : market_database_name , market_database_username : market_database_username , market_database_password : market_database_password , market_database_path : market_database_path},
            success: function(response){


		    	$(".output-update-market").html(response);

            },
            error: function(response){
                $(".output-update-market").hide();
                alert("Error in loading contents, please try again.");
                console.log(response);
            }
        });

        //return false;
    });

    $("#add-market").on('click',function(){
    	
    	$(".output-add-market").html("Loading...");
		$(".output-add-market").show();

    	var market_name = $("#new-market-name").val();
        var market_database_name = $("#new-market-database-name").val();
        var market_database_username = $("#new-market-database-username").val();
        var market_database_password = $("#new-market-database-password").val();
        var market_database_path = $("#new-market-database-path").val();

        if(market_name == "" || market_database_name == "" || market_database_username == "" || market_database_password == "" || market_database_path == ""){
        	alert("All fields are mandatory.");
        	return false;
        }

        $.ajax({
        	url:"<?php echo DB_DOMAIN;?>newadmin//wld/ajax/json_actions.php?action=addmarketdetail",
            type:"POST",
            dataType: 'json',
            data: {market_name : market_name , market_database_name : market_database_name , market_database_username : market_database_username , market_database_password : market_database_password , market_database_path : market_database_path},
            success: function(response){
            	if(response.status == 'success'){
            		
            		$("#select-market").append('<option value="'+ response.mid +'">'+ response.market_name +'</option>');
		    		
		    	}
            	
            	$(".output-add-market").html(response.text);

		    },
            error: function(response){
                alert(response);
                console.log(response);
            }
        });

        //return false;
    });    
});


</script>
</script>