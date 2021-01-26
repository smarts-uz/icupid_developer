<?php
/**
* Page: MEMBER UPGRADE PAGE
*
* @version  9.0
* @created  Sat 25 Oct  2008
* @related  inc/func/func_subscribe.php & inc/payment/*
*/
## block direct page access
defined( 'KEY_ID' ) or die( 'Restricted access' );

?>
<style type="text/css">
	.to_address_img{}
	.to_address_img img{
		width: 100%;
	}
	.send_to{ float: left; width: 100%;}
	.send_to label{ float: left; }
	.send_to input{ float: left; max-width: 90px; margin: -8px 10px 8px 10px; }
	.send_to span{ float: left; font-weight: bold; }
</style>
<div id="main">         
    <div id="main_content_wrapper">


    <? if(!isset($HEADER_SINGLE_COLUMN)){ ?><div class='conten_outer' style="padding:10px 20px;"> <? } ?>   
        
     <div class="clear"></div>

    <? if(isset($ERROR_MESSAGE) && strlen($ERROR_MESSAGE) > 3){ ?>
    <div id="messages">
          <div style="" class="message-<?=$ERROR_TYPE ?>" id="main-message-<?=$ERROR_TYPE ?>">
          <a class="dismiss-message" href="#" onclick="Effect.Fade('main-message-<?=$ERROR_TYPE ?>', { duration : 0.5 });; return false;"><img src="images/DEFAULT/_icons/16/menu.gif"></a>
          <?=$ERROR_MESSAGE ?>
        </div>
        <script type="text/javascript" language="javascript">Effect.Pulsate('main-message-<?=$ERROR_TYPE ?>', { pulses : 2, duration : 1, from : 0.7 });</script>
    </div>
    <? } ?>
<? foreach($BANNER_ARRAY as $banner){ if($banner['position'] =="middle"){?>
<div class="middle_banner"><? print $banner['display'];?></div><? }} ?>

<p <? if ($PageDesc !='') {?> class="page_decr" <? }?> ><?=$PageDesc ?></p>


<? if(isset($SubscribeOnly)){ ?>
<p style="color:red;">Thank you for joining our website, please select your desired membership package below, you must upgrade your membership to continue.</p>
<? } ?>
 


<div id="eMeeting">
    <ul class="menu_tab">
	 	<li class="tablinks">&nbsp;</li>
	 	<li class="tablinks"><a href="<?=DB_DOMAIN ?>overview"><?=$GLOBALS['_LANG']['_account'] ?></a></li>
		<? if(D_FREE =="no"){ ?><li class="tablinks <? if($page=="subscribe"){ ?>active<? } ?>"><a href="<?=DB_DOMAIN ?>subscribe"><span><?=$GLOBALS['LANG_OVERVIEW']['51'] ?></span></a></li><? } 			        ?>
        
	    <? if(D_NEAR_ME == '1'){ ?> <li class="tablinks <? if($show_page=="nearme"){ ?>active<? } ?>"><a href="<?=DB_DOMAIN ?>overview/nearme"><span><?=$GLOBALS['LANG_OVERVIEW']['95'] ?></span></a></li>
	    <?php } ?>

	    <?php if(D_MEET_ME == '1'){ ?> <li class="tablinks <? if($show_page=="meetme"){ ?>active<? } ?>"><a href="<?=DB_DOMAIN ?>overview/meetme"><span><?=$GLOBALS['LANG_OVERVIEW']['96'] ?></span></a></li>
	    <?php } ?>
	        
	    <?php /*if(D_FLASHCOM_CHAT ==1){ ?> <li class="tablinks <? if($show_page=="chat"){ ?>active<? } ?>"><a href="<?=DB_DOMAIN ?>overview/chat"><span><?=$GLOBALS['LANG_OVERVIEW']['97'] ?></span></a></li>
	    <?php }*/ ?>

	    <li lass="tablinks <? if($show_page=="viewed"){ ?>active<? } ?>"><a href="<?=DB_DOMAIN ?>overview/viewed"><span><?=$GLOBALS['LANG_OVERVIEW']['a21'] ?></span></a></li>
	 	<li class="tablinks">&nbsp;</li>
    </ul>
    <div class="ClearAll"></div>
</div>
 
<br>

<div class="contentf">
	<div class="contentf_inner1">
		<div class="inner_wrapper"> 
			<h3 class="template_color" style="width: 100%; margin-bottom: 10px;"><?=$GLOBALS['LANG_ORDER']['15'] ?>: <?=$GLOBALS['MyProfile']['name'] ?></h3> 
			<?php
			if(isset($GLOBALS['MyProfile']['expire']) && $GLOBALS['MyProfile']['expire'] != ""){
			?>
			<h3 class="expiry">Membership Expires <?=$GLOBALS['MyProfile']['expire']?></h3> 
			
			<?php
			}
			
			$GLOBALS['MyProfile']['id'] = 0;
			## Membership Credits Tabs
			?>

			<ul id="membership_tabs">
				<li class="active membership">
					<a href="javascript:void();" class="MainBtn" onclick="displayMembershipTab('membership-tab','membership');">Memberships</a>
				</li>
				<li class="credits">
					<a href="javascript:void();" class="MainBtn" onclick="displayMembershipTab('credits-tab', 'credits');">Credits</a>
				</li>
			</ul>
			<? if($_SESSION['packageid'] != 3 && $GLOBALS['MyProfile']['expire'] !=""){ 
		 	/**
		 	* Page: Displays when their membership expires
		 	*/
			?>
			<?=$GLOBALS['_LANG']['_membership'] ?> <?=$GLOBALS['_LANG']['_expires'] ?> <?=$GLOBALS['MyProfile']['expire'] ?> 
			<? 
			}
			?>
		</div>
		<b class="i1f"></b>
		<b class="i2f"></b>
		<b class="i3f"></b>
		<b class="i4f"></b>
		<div class="contenti" style="margin-left:0px;">
		<? if($show_page=="home"){ 
		 /**
		 * Page: Displays the membership packages
		 *
		 * @version  9.0
		 */
		 ?>

			<script>

			function popupform(myform, windowname) {
				if (! window.focus)return true;
				window.open('', windowname, 'height=650,width=500,scrollbars=yes');
				myform.target=windowname;
				return true;
			}
			</script>


		    
    
			<form onsubmit="address_valid_txt();return false">
	
				<input type="hidden" name="newpackageid" id="newpackageid" value="1">
	
				<div id="membership-tab">

					<div class="col-xs-12 col-sm-5 col-md-5 col-lg-5" style="float:right">
			        
			    		<!-- DISPLAY TOP BOX -->
			        	<strong><?=$GLOBALS['LANG_ORDER']['a5'] ?></strong>
			    	    <br>
	            
	            		<div class="box_body" style="height:320px; overflow : auto; Overflow-x:hidden; border:1px solid #ccc;">
	            			<span id="PackageFeatures_span"><span style="margin-top:100px;display:block;text-align:center;"><font color="#666666"><?=$GLOBALS['LANG_ORDER']['a6'] ?></font></span></span>
	            		</div>
	            		<p  style="padding:10px"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/zoom_in.png" width="16" height="16" align="absmiddle"> <a href="<?=DB_DOMAIN ?>subscribe/matrix"><?=$LANG_UPGRADE_MENU['matrix'] ?></a></p>
	    			</div>
					<div class="col-xs-12 col-sm-1 col-md-1 col-lg-2 pull-right"></div>
    				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 pull-left">  	   
		
						<strong><?=$GLOBALS['LANG_ORDER']['a7'] ?></strong><br>
		
						<!-- DISPLAY UPGRADE PACKAGES -->
						<? foreach($show_packages as $package){ ?>
						<label class="package_box">
							<span class="check"><input name="PackageUpID" id="PackageID" type="radio" value="<?=$package['id'] ?>" <?php if($_POST['packageid'] == $package['id']){ echo "checked";}else{echo "disabled";} ?> onclick="DisplayPackFeatures(<?=$package['id']?>);">
								<input type="hidden" id="pack_price_<?=$package['id'] ?>" value="<?=$package['price']?>"/>
								<input type="hidden" id="pack_currency_<?=$package['id'] ?>" value="<?=$package['currency']?>"/>
							</span> 
							<span class="checkinfo">
								<a href="#" onclick="DisplayPackFeatures(<?=$package['id']?>); return false;"><div class="package_name"> <?=$package['name'] ?></div></a>
								<p style="font-size:12px;">
								<? if($package['icon'] =="SMS"){  ?>
								<?=$package['credits'] ?> <?=$GLOBALS['LANG_ORDER']['20'] ?> <br> <?=$package['price'] ?> <?=$package['currency']; ?>
								<? }else{ ?>
								<?=$package['time_period'] ?>-<?=$package['time_type'] ?> <?=$package['name'] ?><br> <?=$package['price'] ?> <?=$package ['currency'] ?> /  <?=$package['time_period'] ?> <?=$package['time_type'] ?>
								<? } ?>
								</p>
							</span>
							<span class="package_icon">
							<?php if(isset($package['id']) && file_exists($_SERVER['DOCUMENT_ROOT']."/uploads/membershipicons/".$package['id'].".png")){ ?>
							    <img src="<?php echo DB_DOMAIN."uploads/membershipicons/".$package['id'] .".png"; ?>">
							<?php
							}
							?>
								
							</span>

						</label>
			
						<?
						}
						?>
					<!-- END DISPLAY -->
					</div>
   				</div>
				
				<div id="credits-tab" style="display: none;">
				    <ul id="credit-packages">
				    	<li>
				    		<label>
				    			<input type="radio" name="PackageUpID" value="credits"/>
				    			<span>1 credit for USD <?=D_CREDIT_PRICE?></span>
								<input type="hidden" id="pack_price_credits" value="<?=D_CREDIT_PRICE?>">
								<input type="hidden" id="pack_currency_credits" value="USD">
				    		</label>
				    	</li>
				    </ul>
    			</div>

    			<hr style="border-top:1px dotted #999; margin-bottom:15px;"/>
			
				<div class="payment-section">

					<?php				
					$order_num = mt_rand(1000, 9999);
					$cur_date = date("F jS \, Y");
					$packageamount = $_POST['eamount'];
					$eth_usd_amt = $packageamount/.25;
					?>

					<div class="cryptomain2">

				     	<div class="cryptodata2">

				       		<p style="margin-bottom: 6%;font-size: 30px;font-weight: bold;color:#5a5352; ">Pay For Order</p>
							
							<div class="row" style="margin-bottom: 4%;">

								<div class="col-md-3 cypto_details">
								    <p class="subcrypto">ORDER NUMBER:</p>

								    <p class="subcrypto2"><b><?=$order_num?></b></p>
								</div>

								<div class="col-md-3 cypto_details">
								    <p class="subcrypto">DATE:</p>
								    <p class="subcrypto2"><b><?=$cur_date?></b></p>
								</div>

								<div class="col-md-3 cypto_details">
									<p class="subcrypto">TOTAL:</p>
								    <p class="subcrypto2"><b>$ <?=$package['price']?>.00</b></p>
								</div>

								<div class="col-md-3 cypto_details">
									<p class="subcrypto">PAYMENT METHOD:</p>
								   	<p class="subcrypto2"><b>Digital Currencies</b></p>
								</div>

							</div>

					    	<div class="row">
								<div class="col-md-7">
									<div id="name-group" class="form-group">
										<label for="address">Refund address:</label>
				    					<input type="text" class="form-control" id="address" name="address" style="width: 70%;">
										<div id="loading_crypto" style="display: none;">
											<img src="<?php echo DB_DOMAIN ?>images/loading.gif">
										</div>
											<p id="result" style="float: left; width: 100%;"></p>
											<p id="result2" style="padding: 2%; color: #de6464;"></p>
									</div>

									<div class="form-group send_to">
										<label for="from">Send:</label>
										<input type="text" class="form-control" name="eamount" value="<?=$packageamount?>" readonly>
										<span>TRQX</span>
				       				</div>

							        <div id="name-group" class="form-group" >
									    <label for="from">TO:</label>
								    	<input type="text" class="form-control" id="admin_address" name="admin_address" value="<?=ETH_ADDRESS?>" readonly>

								        <input type="hidden" name="apikey" value="<?=REQUITIX_API_KEY?>" >

								   </div>

							        <div id="name-group" class="form-group" >
									    <label for="from">Time Left:</label>
								        <input type="text" class="form-control"  readonly id="countdown2" placeholder="" >
							       </div>

								</div>

								<div class="col-md-5 to_address_img">
									<img src="<?=DB_DOMAIN?>uploads/crypto_qr/<?=ETH_image?>" alt="wallet QR 	image">
								</div>

							</div>

				  		</div>

				  	</div>

				</div>

			<? if(D_FREE=="no"){ ?>

		<!-- ******************* PAYMENT INFORMATION AND METHODS ************************* -->
			
			<!-- DISPLAY UPGRADE PACKAGES -->
			<?php
			if(isset($GLOBALS['MyProfile']['id']) && $GLOBALS['MyProfile']['id'] != '21'){
			?>
			<ul>	
				<li>
					<input type='submit' value="Pay Now" class="MainBtn" style="font-size:20px; margin-top:20px;">
					<p id="result3" style="padding: 2%; color: #de6464;" id="submit"></p>
				</li>
			</ul>
			
			<?php
			}
			?>


		 
		</form>

		<!-- Submit Success Page -->
		<form id="rqx_payment" action="<?=getThePermalink('order/requitix')?>" method="POST">
			<input type="hidden" name="address" id="rq_address" value="">
			<input type="hidden" name="rqx" id="rq_rqx" value="">
			<input type="hidden" name="user_id" id="rq_user_id" value="">
			<input type="hidden" name="package_id" id="rq_package_id" value="">
			<input type="hidden" name="txn_hash" id="rq_txn_hash" value="">
		</form>		
		<? 
		}
	?>
	
	
<? } ?>


<br><br>
</div>
<b class="i4f"></b><b class="i3f"></b><b class="i2f"></b><b class="i1f"></b></div></div><b class="b4f"></b><b class="b3f"></b><b class="b2f"></b><b class="b1f"></b>


<div class="ClearAll"></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://checkout.stripe.com/checkout.js"></script>
<script>

$(document).ready(function(){

	var name_val = $('input[name=eamount]').val();
	if (name_val == ""){
		alert('You have Refreshed the page we are sending on previous page');
		window.history.back();
		return false;
	}

});		

function address_valid_txt() {

	var adress = $('input[name=address]').val();

	if (adress  == ""){

		$("#result").text('');
		$("#result2").html('<b>Address is required</b>');
		return false;
	}

    var loading = $("#loading_crypto");

    $(document).ajaxStart(function () {
       loading.show();
       $("#submit").attr("disabled" , true);
       $("#submit").css("background-color", "#ccc");
       $("#result3").text('please do not Leave / Refresh page');
    });


     $(document).ajaxStop(function () {
        loading.hide();
        $("#submit").attr("disabled" , false);
        $("#submit").css("background-color", "#66c3ee");           
    });
    
    var name = $('input[name=address]').val();

         var eamount =  $('input[name=eamount]').val();

         var admin_address =  $('input[name=admin_address]').val();

         var apikey =  $('input[name=apikey]').val();

         var user_id = <?=$_SESSION['uid']?>;

         var package_id = <?=$_POST['packageid']?>;

        var formData = {

            'name'       : name,

            'eamount'    : eamount,

            'admin_address' :  admin_address,

            'apikey' : apikey,


        };

    $.ajax({

        type        : 'POST', 
        url         : '<?=DB_DOMAIN?>plugins/plugins/crypto/crypto_process.php',
        data        : formData,
        encode      : true,
        success: function(data) {

	        console.log(data);
	        resp_code = data.split ("|");

			if (resp_code[0] == "api_error"){

		        $('#result').html('Invalid API (This is API key error so this message is for Admin only ').show(1000);

			}

			else if (resp_code[0] == "AR"){

	 	        $('#result').html('Please enter Your Address. ').show(1000);

			}

		    else if (resp_code[0] == "IA"){ 

		        $('#result').html('Invalid address ').show(1000);

			}

			else if (resp_code[0] == "AVT-Failed"){ 

		        $('#result').html('Address is valid but have not sufficent funds for the purchase , Account has only ' + resp_code[1] +' Tokens ').show(1000);

					// wc_add_notice( 'Address is valid but have not sufficent funds for the purchase , Account has only '. $resp_code[1].' Tokens' , 'error');  

			}

			else if (resp_code[0] == "AV" && resp_code[2] == "0" ){ 

		        $('#result').html('Address is valid and have ' + resp_code[1] +' TRQX Tokens . Please check that you have send token to admin address or You have crossed 30 minutes trasaction verify limit ').show(1000);

			}

		   else if (resp_code[0] == "AV" && resp_code[2] == "VD" ){ 

	 	       $('#result').html('Address is valid and have ' + resp_code[1] +' TRQX Tokens . Please verify that amount is send to correct address').show(1000);

			}

			else if (resp_code[0] == "AV" && resp_code[2] == "ALP" ){ 

		        $('#result').html('Address is valid and have ' + resp_code[1] + ' TRQX Tokens . Amount you send is less than the product price ').show(1000);

					// wc_add_notice( 'Address is valid and have ' . $resp_code[1] .' TRQX Tokens . Amount you send is less than the product price', 'error');  

			}


			else if (resp_code[0] == "AV" && resp_code[3] == "TRANSFOUND" ){

		        $('#result').html('You have already upgraded with this transaction id').show(1000);

			}

			else if (resp_code[0] == "AV" && resp_code[3] ){

		        $('#result').html('we have receive a valid trasaction with the valid amount upgrading your account').show(1000);

		        $("#result2").html('<span style="color:#06af70;" class="loading">Please wait we are processing Your request........</span>');

		        //window.location.href = "thankyou.php?address="+name+"&rqx="+eamount+"&user_id="+user_id+"&package_id="+package_id+"&txn_hash="+resp_code[3];

		        $("#rq_address").val(name);
		 		$("#rq_rqx").val(eamount);
		 		$("#rq_user_id").val(user_id);
		 		$("#rq_package_id").val(package_id);
		 		$("#rq_txn_hash").val(resp_code[3]);
		 		$("#rqx_payment").submit();


			}
			/*if (data["success"] == false) {

				if(data['errors']['txn_hash'] == "0"){

				    $("#result").text(data['errors']['address'] );

	  	 			$("#result2").html('<b>Sorry unable to find trasaction hash Due to: </b> </br>1. Transaction is not updated on the Ethereum blockchain you may retry after few minutes.<br>2. Transaction not successfully processed.<br>3. Plese confirm that tokens were sent to site address correctly.<br>4. Trasanction time period limits to only to 30 minutes.');

				}
				else if(data['errors']['txn_hash'] == null){
			 		$("#result").text('');
			 		$("#result2").html('<b>'+data['errors']['address']+'</b>');
				}
				else if(data['errors']['address'] == "Invalid address"){

					$("#result").text('');
					$("#result2").html('<b>Address is not valid</b>');
				}

				else if(data['errors']['address'] == "Address is valid but Transaction Failed - Insufficient Funds"){
					$("#result2").html('<b>Address is valid but Transaction Failed - Due to Insufficient Funds</b>');
					$("#result").text('');
				}
				else if(data['errors']['txn_hash'] == "You have already upgraded with this transaction id"){

		     		$("#result").text(data['errors']['address'] );
					$("#result2").html('<b>Only one transaction per wallet address is allowed during beta.</b><br>Please use different wallet address or contact requitix.io.</br>');
				}
				else{

					$("#result").text(data['errors']['address'] );
					$("#result2").html('<span style="color:#06af70;" class="loading">Please wait we are processing Your request........</span>');


			 		$("#rq_address").val(data["person_ad"]);
			 		$("#rq_rqx").val(data["eamount"]);
			 		$("#rq_user_id").val(data["user_id"]);
			 		$("#rq_package_id").val(data["package_id"]);
			 		$("#rq_txn_hash").val(data['errors']['txn_hash']);
			 		$("#rqx_payment").submit();
		 		}
	  		} */
   		},
 	});
}

function displayMembershipTab(id,cls){
	$("#membership_tabs li").each(function(){
		$(this).removeClass("active");
	});
	$("#membership_tabs ." + cls).addClass("active");

	$("#membership-tab").hide();
	$("#credits-tab").hide();
	$("#"+ id).show();
	return false;
}

function countdown( elementName, minutes, seconds ){
    var element, endTime, hours, mins, msLeft, time;

    function twoDigits( n )
    {
        return (n <= 9 ? "0" + n : n);
    }

    function updateTimer()
    {
        msLeft = endTime - (+new Date);
        if ( msLeft < 1000 ) {
            element.value = "Time over";
        } else {
            time = new Date( msLeft );
            hours = time.getUTCHours();
            mins = time.getUTCMinutes();
            element.value = (hours ? hours + ':' + twoDigits( mins ) : mins) + ':' + twoDigits( time.getUTCSeconds() );
            setTimeout( updateTimer, time.getUTCMilliseconds() + 500 );
        }
    }

    element = document.getElementById( elementName );
    endTime = (+new Date) + 1000 * (60*minutes + seconds) + 500;
    updateTimer();
}

countdown( "countdown2", 30, 0 );
</script>
<?php
/* MAIN CLOSE */
if(!isset($HEADER_SINGLE_COLUMN)){ ?></div><div class="clear"></div> <? }else{ print "</div>"; }
?>

</div> <div id="main_wrapper_bottom"></div>
</div>
