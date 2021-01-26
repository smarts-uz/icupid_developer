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
 


<div id="eMeeting" class="user">
  <div class="header account_tabs" style="width: 100%; padding: 0px 0px 0px 2px;">
    <ul>
    <li class="tablinks <? if($show_page=="home"){ ?><? } ?>"><a href="<?=getThePermalink('overview')?>"><span style="font-size: 14px;"><?=$GLOBALS['_LANG']['_account'] ?></span></a></li>

    <? if(D_FREE =="no"){ ?><li class="tablinks <? if($page=="subscribe"){ ?>selected<? } ?>"><a href="<?=getThePermalink('subscribe')?>"><span style="font-size: 14px;"><?=$GLOBALS['LANG_OVERVIEW']['51'] ?></span></a></li><? } ?>

    <? if(D_NEAR_ME == '1'){ ?><li class="tablinks <? if($show_page=="nearme"){ ?>selected<? } ?>"><a href="<?=getThePermalink('overview/nearme')?>"><span style="font-size: 14px;"><?=$GLOBALS['LANG_OVERVIEW']['95'] ?></span></a></li>
    <?php } ?>

    <?php if(D_MEET_ME == '1'){ ?> <li class="tablinks <? if($show_page=="meetme"){ ?>selected<? } ?>"><a href="<?=getThePermalink('overview/meetme')?>"><span style="font-size: 14px;"><?=$GLOBALS['LANG_OVERVIEW']['96'] ?></span></a></li>
    <?php } ?>


   <li class="tablinks <? if($show_page=="viewed"){ ?>selected<? } ?>"><a href="<?=getThePermalink('overview/viewed')?>"><span style="font-size: 14px;"><?=$GLOBALS['LANG_OVERVIEW']['a21'] ?></span></a></li>
   </ul>

    <div class="ClearAll"></div>
 </div>
</div>

 
<?php /*
<div id="eMeeting" class="user">
  <div class="header account_tabs">
    <ul>
	 	<li><a href="<?=DB_DOMAIN ?>overview"><span><?=$GLOBALS['_LANG']['_accountOverview'] ?></span></a></li>
		<li <? if($page=="subscribe"){ ?>class="selected"<? } ?>><a href="<?=DB_DOMAIN ?>index.php?dll=subscribe"><span><?=$GLOBALS['LANG_OVERVIEW']['51'] ?></span></a></li>
        <li <? if($show_page=="nearme"){ ?>class="selected"<? } ?>><a href="<?=DB_DOMAIN ?>index.php?dll=overview&sub=nearme"><span><?=$GLOBALS['LANG_OVERVIEW']['95'] ?></span></a></li>
        <li <? if($show_page=="meetme"){ ?>class="selected"<? } ?>><a href="<?=DB_DOMAIN ?>index.php?dll=overview&sub=meetme"><span><?=$GLOBALS['LANG_OVERVIEW']['96'] ?></span></a></li>        
        <?php
        if(D_FLASHCOM_CHAT == '1'){
        ?>
        	<li <? if($show_page=="chat"){ ?>class="selected"<? } ?>><a href="<?=DB_DOMAIN ?>index.php?dll=overview&sub=chat"><span><?=$GLOBALS['LANG_OVERVIEW']['97'] ?></span></a></li>	
        <?php
        }
		?>
		<li <? if($show_page=="viewed"){ ?>class="selected"<? } ?>><a href="<?=DB_DOMAIN ?>index.php?dll=overview&sub=viewed"><span><?=$GLOBALS['LANG_OVERVIEW']['a21'] ?></span></a></li>

    </ul>
    <div class="ClearAll"></div>
 </div>
</div>*/ ?>
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
			/*if($GLOBALS['MyProfile']['name'] == 'Lifetime' && isset($GLOBALS['MyProfile']['expire']) && date("Y-m-d") < date("Y-m-d",strtotime($GLOBALS['MyProfile']['expire']))){
				$GLOBALS['MyProfile']['id'] = 21;
			}
			else if($GLOBALS['MyProfile']['name'] == 'Starter' && isset($GLOBALS['MyProfile']['expire']) && date("Y-m-d") < date("Y-m-d",strtotime($GLOBALS['MyProfile']['expire']))){
				$GLOBALS['MyProfile']['id'] = 22;
			}
			else if($GLOBALS['MyProfile']['name'] =='Test' && isset($GLOBALS['MyProfile']['expire']) && date("Y-m-d") < date("Y-m-d",strtotime($GLOBALS['MyProfile']['expire']))){
				$GLOBALS['MyProfile']['id'] = 23;
			}
			else{
				$GLOBALS['MyProfile']['id'] = 0;
			}*/
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


		    
    
			<form name="upgradeAccount" method="post" action="<?=DB_DOMAIN ?>inc/payment/upgrade_process.php">
	
				<input type="hidden" name="newpackageid" id="newpackageid" value="1">
	
				<div id="membership-tab">

					<div class="col-xs-12 col-sm-5 col-md-5 col-lg-5" style="float:right">
			        
			    		<!-- DISPLAY TOP BOX -->
			        	<strong><?=$GLOBALS['LANG_ORDER']['a5'] ?></strong>
			    	    <br>
	            
	            		<div class="box_body" style="height:320px; overflow : auto; Overflow-x:hidden; border:1px solid #ccc;">
	            			<span id="PackageFeatures_span"><span style="margin-top:100px;display:block;text-align:center;"><font color="#666666"><?=$GLOBALS['LANG_ORDER']['a6'] ?></font></span></span>
	            		</div>
	            		<p  style="padding:10px"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/zoom_in.png" width="16" height="16" align="absmiddle"> <a href="<?= getThePermalink('subscribe/matrix')?>"><?=$LANG_UPGRADE_MENU['matrix'] ?></a></p>
	    			</div>
					<div class="col-xs-12 col-sm-1 col-md-1 col-lg-2 pull-right"></div>
    				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 pull-left">  	   
		
						<strong><?=$GLOBALS['LANG_ORDER']['a7'] ?></strong><br>
		
						<!-- DISPLAY UPGRADE PACKAGES -->
						<? foreach($show_packages as $package){  ?>
						<label class="package_box">
							<span class="check"><input name="PackageUpID" id="PackageID" type="radio" value="<?=$package['id'] ?>" onclick="DisplayPackFeatures(<?=$package['id']?>);">
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

					<ul id="payment-methods">

						<?
						$i = 0;
						foreach($show_payment_types as $merchant){ ?>
						<li>
							<fieldset class="paymentcls">
			  					<legend id="merchant-title-<?=$merchant['id']?>"><?=$merchant['title']?></legend>
			  					<img src="<?=$merchant['icon']?>">	
							 </fieldset>
							 <input type="radio" name="payid" value="<?=$merchant['id']?>" class="method" <?=($i == 0)? 'checked' : ''?> >
						</li>
						<? 
						$i++;
						} ?>
					</ul>

				</div>

			<? if(D_FREE=="no"){ ?>

		<!-- ******************* PAYMENT INFORMATION AND METHODS ************************* -->
			
			<!-- DISPLAY UPGRADE PACKAGES -->
			<?php
			if(isset($GLOBALS['MyProfile']['id']) && $GLOBALS['MyProfile']['id'] != '21'){
			?>
			<ul>	
				<? /*<li>
					<label><?=$GLOBALS['LANG_ORDER']['a13'] ?> </label>
					<select name="payid" class="payment_methods">
					<? foreach($show_payment_types as $merchant){ ?>
						<option value="<?=$merchant['id'] ?>"><?=$merchant['name'] ?></option>
					<? } ?>
					</select> 
				</li>*/ ?>
				<li><input type='submit' value="<?=$GLOBALS['LANG_ORDER']['a14'] ?>" class="MainBtn" style="font-size:20px; margin-top:20px;"></li>
			</ul>
			
			<?php
			}
			?>


		 
		</form>
		<!-- END BOX -->

		<form name="stripe-upgrade-form" id="stripe-upgrade-form" action="<?=DB_DOMAIN ?>inc/payment/stripe_charge.php" method="POST">
			<input type="hidden" name="currency" id="stripe-currency" value=""/>
			<input type="hidden" name="amount" id="stripe-amount" value=""/>
			<input type="hidden" name="packageId" id="stripe-packageId" value=""/>
			<input type="hidden" name="stripeToken" id="stripe-stripeToken" value=""/>
			<input type="hidden" name="user_id" value="<?php echo $_SESSION['uid'];?>"/>
		</form>
			<!-- END DISPLAY -->
			
		<? 
		}
	?>
	
	
<? }elseif($show_page=="matrix"){ 

	 /**
	 * Page: Displays the bank details when members wish to pay via bank transfer
	 *
	 * @version  9.0
	 */

?>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <table class="membership_table">
    <thead>
        <tr bgcolor="#999999">
            <th class="left_profilelist">&nbsp;</th>  
            <?php 
            $i = 1;
            foreach($PACKARRAY as $pValue){
                
            ?>
                <th bgcolor="#999999" style="color:white;"><?=$pValue['name'] ?></th>
            <? 
            }
            ?>                  
        </tr>
    </thead> 
    <?
    
    
     $i=1;
     foreach($PAGE_ARRAY as  $PAGENAME => $TOP_MENU){
        
    if($PAGENAME =="7"){ $PAGENAME="classads"; }
    if($PAGENAME =="8"){ $PAGENAME="blog"; }
     
    if($PAGENAME =="10"){ $PAGENAME="chatroom"; }
     
    //print $PAGENAME." -->".$TOP_MENU."<br>";
    
    if(!is_numeric($PAGENAME)){
        
        $inner=1;
    
    $save=0;
    
        foreach( $TOP_MENU as $key => $value){ 
     
            if(substr($key,-1,1) !="?" && substr($key,1,3) !="dll" && ( $key !="view" && $key !="" && $key !="inbox" && $key !="sent" && $key !="trash" && $key !="manage"  && $key !="albums" && $key !="password" && $key !="cancel"  && $key !="taken" && $key !="test") && $value !=""){ ## hide value if its a help value 
    
            if($inner==1){ $InnerSymbol=''; }else{ $InnerSymbol="&nbsp;&nbsp;&nbsp;&nbsp;<img src='images/DEFAULT/_icons/16/bullet_go.png' align='absmiddle'>"; }
     
    ?>
    
    
    
    
    
    <?	foreach($PACKARRAY as $pValue){	 
    
            $PackageString = "";
            $PackageString = $PAGENAME."-".$key; 
    
                if(isset($PACKAGEACCESS[$pValue['id']]) && is_array($PACKAGEACCESS[$pValue['id']]) && in_array($PackageString,$PACKAGEACCESS[$pValue['id']])){ 
                  $CheckME='<img src="'.DB_DOMAIN.'images/DEFAULT/_icons/new/chk_no.png">'; 
                }else{
                  $CheckME='<img src="'.DB_DOMAIN.'images/DEFAULT/_icons/new/chk_yes.png">'; 
                  $save = $save + 1;
                }
            
        }
    
     ?>
    
    
    <? if ($save != 0) { ?>
    
     
      <tr>
        <td width="130" style="font-size: 15px;"> <?= $TOP_MENU[$key] ?> </td>
    
            <?	foreach($PACKARRAY as $pValue){	 
    
    
    
    
            $PackageString = "";
            $PackageString = $PAGENAME."-".$key; 
    
            if(isset($PACKAGEACCESS[$pValue['id']]) && is_array($PACKAGEACCESS[$pValue['id']]) && in_array($PackageString,$PACKAGEACCESS[$pValue['id']])){ 
            $CheckME='<img src="'.DB_DOMAIN.'images/DEFAULT/_icons/new/chk_no.png">'; 
            }else{$CheckME='<img src="'.DB_DOMAIN.'images/DEFAULT/_icons/new/chk_yes.png">'; }
     ?>
    
                <td width="25" bgcolor="#eeeeee" align="center"><?=$CheckME ?></td>
    
            <? } ?>
    
      </tr>
    
    <? } ?>
    
    <?
            $i++; 
    $save = 0;
            $inner++;
            } 
    
        } }
    
    }
    ?>
    
        <tr>
            <th bgcolor="#FFFFFF">&nbsp;</th>  
            <?	foreach($PACKARRAY as $pValue){	  ?>
                <th><?=$pValue['currency_code'].$pValue['price'] ?></th>
            <? } ?>                  
        </tr>
    </table>
    </div>
</div>
<? }elseif($show_page=="bank"){ 

	 /**
	 * Page: Displays the bank details when members wish to pay via bank transfer
	 *
	 * @version  9.0
	 */

?>
 
		<div style="margin-left:10px; margin-top:5px;">
		
			<strong><?=$GLOBALS['LANG_ORDER']['17'] ?></strong><br><br>
			
			<p><?=$GLOBALS['LANG_ORDER']['18'] ?> <?=$bank_price['currency_code'] ?><?=$bank_price['price'] ?> <?=$GLOBALS['LANG_ORDER']['19'] ?></p>
		
			<!-- DISPLAY UPGRADE PACKAGES -->
			<div class="box_title" style="width:610px;"><?=$GLOBALS['LANG_ORDER']['16'] ?></div>
			<div class="box_body">
				<ul class="form">	
				<? foreach($bank_data as $bb){ ?>
				<li>
				<label><?=$bb['name'] ?>: </label><?=$bb['value'] ?>
				</li>
				<? } ?>
				</ul>
		
			</div>
			<!-- END DISPLAY -->
			
			<div class="ClearAll"></div>
			
			
		</div>
	
<? } ?>


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
  	var handler = StripeCheckout.configure({/*
    key: '<?php echo $stripe_publishable;?>',
    image: '/uploads/files/stripe.png',
    locale: 'auto',
    allowRememberMe: false,
    email: '<?php echo $member_email; ?>',
    token: function(token) {

		var pid = $('input[name=PackageUpID]:checked').val();
		
		$("#stripe-packageId").val(pid);
		$("#stripe-stripeToken").val(token.id);
		var p_amount = parseFloat($("#pack_price_" + pid).val()) * 100;
		$("#stripe-amount").val(p_amount);
		$("#stripe-currency").val($("#pack_currency_" + pid).val());
		
		$("#stripe-upgrade-form").submit();
      	// You can access the token ID with `token.id`.
      	// Get the token ID to your server-side code for use.
    }
  */});
  var $ = jQuery.noConflict();
$(document).ready(function(){

	

	$('.MainBtn').on('click', function(e) {
    // Open Checkout with further options:

    	var payment_id = $('#payment-methods input[name="payid"]:checked').val();
    	
    	if($('#merchant-title-'+payment_id).text() == 'Stripe'){
    		
    		var pid = $('input[name=PackageUpID]:checked').val();
    		var title = '<?php echo SEO_PREFIX_TITLE; ?>';
    		title = title.replace("|","");
    		title = $.trim(title);

    		var p_amount = parseFloat($("#pack_price_" + pid).val()) * 100;
    		handler.open({
      			name: title,
      			description: '<?php echo HOME_DESC; ?>',
      			amount: p_amount,
      			currency: $("#pack_currency_" + pid).val(),
     			stripeEmail: false
    		});
    		e.preventDefault();
    		
    	}
    
    	
  	});

  		// Close Checkout on page navigation:
  		$(window).on('popstate', function() {
    		handler.close();
  		});
	
});
</script>
<?php
/* MAIN CLOSE */
if(!isset($HEADER_SINGLE_COLUMN)){ ?></div><div class="clear"></div> <? }else{ print "</div>"; }
?>

</div> <div id="main_wrapper_bottom"></div>
</div>


<?php  if(isset($_GET['view']) && $_GET['view']=='credits') { 
 ?>
	
	
	<script type="text/javascript">	
		$(document).ready(function() {
		displayMembershipTab('credits-tab', 'credits');
		}); 
	
	</script>
	<?php } ?>
