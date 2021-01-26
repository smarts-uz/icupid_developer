<?php
/**
* Page: CRYPTO CONVERT PAGE
*
* @version  13.0
* @created  Sat 09 Oct 2017
*/

## block direct page access
defined( 'KEY_ID' ) or die( 'Restricted access' );

?>
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

<b class="b1f"></b>
<b class="b2f"></b>
<b class="b3f"></b>
<b class="b4f"></b>
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
			?>
			<?
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
		 	*
		 	* @version  9.0
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


		    
    
			<form name="upgradeAccount" method="post" action="<?=DB_DOMAIN ?>cryptopayment">
	
				<input type="hidden" name="packageid" value="<?=$_POST['packageid']?>">
	
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
				## Reuqitex Payment 
				$url = "https://min-api.cryptocompare.com/data/pricemulti?fsyms=ETH,DASH&tsyms=BTC,USD,EUR";
				$json = file_get_contents($url);
				$json_data = json_decode($json, true);
				$slice = array_slice($json_data , 0 , 1);

				foreach ($slice as $j) {

					$ammountusd = $j['USD'];
					$packageamount = $_POST['a3'];
					$eth_usd_amt = $packageamount/.25;

				}

				?>

					<div class="cryptomain">

			 			<img src="<?php echo DB_DOMAIN ?>images/digidot.PNG"><p class="digital"><b><img src="<?php echo DB_DOMAIN ?>images/digicur.PNG"></b></p>

				 		<div class="cryptodata">
							<p><i class="arrow up"></i></p>

					       	<p style="margin-bottom: 6%;font-size: 20px;">Pay with Requitix</p>
							<p style="margin-bottom: 3%;font-size: 16px;">Estimated Cryptocurrency order total:</p>
							<p class="subcrypto"><b>requitix <?=$eth_usd_amt?></b></p>
							<input type="hidden" name="eamount" value="<?=$eth_usd_amt?>">
							<p class="subcrypto"><?=date("h:i:sa");?></p>

							<?php
							foreach($show_payment_types as $merchant){
								$metadata = DisplayPaymentMetadata($merchant['id']);
							?>


							<div class="form-group" <?php if(isset($merchant)){

						  		if(isset($metadata['user_address_status']) && $metadata['user_address_status']=="yes") {
				  	 				print "style='display:block'";
						  	 	}
						  	 	else {
							  		print "style='display:none'";
						  	 	} 
						  	}?> >
								<label for="address">Refund address:</label>
								<input type="text" class="form-control" id="address" name="address">
							</div>

							<div id="loading_crypto" style="display: none;"><img src="<?php echo DB_DOMAIN ?>images/contact_loading.gif"></div>
							<div><p id="result" style="padding: 2%;"></p></div>

							<? } ?>
						</div>
					</div>
					<?php /*
					<ul id="payment-methods">

						<?
						$i = 0;
						foreach($show_payment_types as $merchant){ ?>
						<li>
							<fieldset>
			  					<legend id="merchant-title-<?=$merchant['id']?>"><?=$merchant['title']?></legend>
			  					<img src="<?=$merchant['icon']?>">	
							 </fieldset>
							 <input type="radio" name="payid" value="<?=$merchant['id']?>" class="method" <?=($i == 0)? 'checked' : ''?> >
						</li>
						<? 
						$i++;
						} ?>
					</ul>
					*/?>

				</div>

			<? if(D_FREE=="no"){ ?>

		<!-- ******************* PAYMENT INFORMATION AND METHODS ************************* -->
			
			<!-- DISPLAY UPGRADE PACKAGES -->
			<?php
			if(isset($GLOBALS['MyProfile']['id']) && $GLOBALS['MyProfile']['id'] != '21'){
			?>
			<ul>	
				<li><input type='submit' value="<?=$GLOBALS['LANG_ORDER']['a14'] ?>" class="MainBtn" style="font-size:20px; margin-top:20px;"></li>
			</ul>
			
			<?php
			}
			?>
		</form>
			
		<? 
		}
	} ?>


<br><br>
</div>
<b class="i4f"></b><b class="i3f"></b><b class="i2f"></b><b class="i1f"></b></div></div><b class="b4f"></b><b class="b3f"></b><b class="b2f"></b><b class="b1f"></b>


<div class="ClearAll"></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://checkout.stripe.com/checkout.js"></script>
<script>

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

</script>
<?php
/* MAIN CLOSE */
if(!isset($HEADER_SINGLE_COLUMN)){ ?></div><div class="clear"></div> <? }else{ print "</div>"; }
?>

</div> <div id="main_wrapper_bottom"></div>
</div>