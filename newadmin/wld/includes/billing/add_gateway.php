<div class="page">
	<div class="heading">
		<h2>Add/Edit Payment Gateways</h2>
	</div>
	<div class="content">
		
		<div class="box">
			<div class="box-content">
				<div id="contentcolumn" class="contentcolumndash">
			
					<form name="form1" method="post" action="">
						<input name="do" type="hidden" value="add_gateway" class="hidden">
						<input name="comments" type="hidden" value="" class="hidden">
						<input name="market_id" type="hidden" value="<?=$_REQUEST['market_id']?>" class="hidden">

						<?php if(isset($_REQUEST['id'])){ ?><input name="editid" type="hidden" value="<?=$_REQUEST['id'] ?>" class="hidden"><?php $edit = WLDEditField($_REQUEST['id'],$_GET['market_id']); } ?>

						<ul class="form">
						<div class="box_body">

							<div id="gateway_custom" <?php if(isset($_REQUEST['id'])){ ?> style="display:none;" <?php }else{ ?>style="display:visible;"<?php } ?>>

								<li><label><?=$admin_billing[13] ?>:</label>
									<select class="input" name="gateway" onchange="javascript:idShowHide(this.value);idShowHide('gateway_custom');idShowHide('sub_button');">
										<option value="">-----------</option>
									   	<option value="paypal">Paypal</option>
									   	<option value="stripe">Stripe</option>
									   	<option value="nochex">NOCHEX</option>
									   	<option value="2checkout">2 Checkout</option>
									   	<option value="egold">eGold</option>
									   	<option value="alertpay">AlertPay</option>
									   	<option value="paymate">Paymate</option>
									   	<option value="worldpay">Worldpay</option>
									   	<option value="authorize">Authorize</option>
									   	<option value="ccbill">CCBill</option>
									   	<option value="moneybookers">Moneybookers</option>
									   	<option value="google">Google Checkout</option>
										<option value="saferpay">Saferpay</option>
										<option value="bank">BANK / WIRE TRANSFER</option>
									   	<option value="custom_code">Create Custom Payment Gateway</option>
									</select>
								</li>
							</div>

							<div id="paypal" style="display:none;">
								<li><label>Paypal Email:</label><input class="input" name="email" type="text"  size="40" maxlength="255"></li>
							</div>


							<div id="stripe" <?php echo (isset($edit['name']) && $edit['name'] =='stripe') ? "" : "style=\"display:none;\""?>>
								        
								<li><label>Stripe Post Action: </label>  <input class="input" name="action" type="text" value="<?php if(isset($edit)){ print $edit['action']; } ?>" size="40" maxlength="255"></li>
								<li><label>Merchant Image:</label> <input class="input" name="icon" type="text" value="<?php if(isset($edit)){ print $edit['icon']; } ?>" size="40" maxlength="255"></li>
								
							</div>


							<div id="nochex" style="display:none;">
								<li><label>NOCHEX Email:</label><input class="input" name="email2" type="text"  size="40" maxlength="255"></li>
							</div>
							<div id="2checkout" style="display:none;">
								<li><label>2Checkout Account ID :</label><input class="input" name="email3" type="text"  size="40" maxlength="255"></li>
							</div>
							<div id="egold" style="display:none;">
								<li><label>Egold Account ID :</label><input class="input" name="email4" type="text"  size="40" maxlength="255"></li>
							</div>
							<div id="alertpay" style="display:none;">
								<li><label>AlertPay Email :</label><input class="input" name="email5" type="text"  size="40" maxlength="255"></li>
							</div>
							<div id="paymate" style="display:none;">
								<li><label>PayMate Merchant ID :</label><input class="input" name="email6" type="text"  size="40" maxlength="255"></li>
							</div>
							<div id="google" style="display:none;">
								<li><label>Google Merchant ID :</label><input class="input" name="email13" type="text"  size="40" maxlength="255"></li>
							</div>
							<div id="worldpay" style="display:none;">
								<li><label>Worldpay Merchant ID :</label><input class="input" name="email7" type="text"  size="40" maxlength="255"></li>
							</div>
							<div id="authorize" style="display:none;">
								<li><label>Authorize Merchant ID :</label><input class="input" name="email8" type="text"  size="40" maxlength="255"></li>
							</div>
							<div id="ccbill" style="display:none;">
								<li><label>Client Acc Number :</label><input class="input" name="accNo" type="text"  size="40" maxlength="255"></li>
								<li><label>Item Subscription Number :</label><input class="input" name="subNo" type="text"  size="40" maxlength="255"></li>
							</div>
							<div id="moneybookers" style="display:none;">
								<li><label>MoneyBookers Email :</label><input class="input" name="email9" type="text"  size="40" maxlength="255"></li>
							</div>

							<div id="saferpay" style="display:none;">
								<li><label>Account ID :</label><input class="input" name="email9" type="text"  size="40" maxlength="255"></li>
							</div>

							<div id="bank" style="display:none;">

								<li><label>Beneficiary:</label><input class="input" name="b1" type="text"  size="40" maxlength="255"></li>
								<li><label>Bank Name:</label><input class="input" name="b2" type="text"  size="40" maxlength="255"></li>
								<li><label>SWIFT Addr. (BIC):</label><input class="input" name="b3" type="text"  size="40" maxlength="255"></li>
								<li><label>BLZ:</label><input class="input" name="b4" type="text"  size="40" maxlength="255"></li>
								<li><label>IBAN Number:</label><input class="input" name="b5" type="text"  size="40" maxlength="255"></li>
								<li><label>Account Number:</label><input class="input" name="b6" type="text"  size="40" maxlength="255"></li>

							</div>

							<div id="custom_code" <?php if(!isset($_REQUEST['id'])){ ?> style="display:none;" <?php } ?>>
								<li><label>Merchant Name: </label> <input class="input" name="name" type="text" value="<?php if(isset($edit)){ print $edit['name']; } ?>" size="40" maxlength="255"></li>        
								<li><label>Merchant Post Action: </label>  <input class="input" name="action" type="text" value="<?php if(isset($edit)){ print $edit['action']; } ?>" size="40" maxlength="255"></li>
								<li><label>Merchant Image:</label> <input class="input" name="icon" type="text" value="<?php if(isset($edit)){ print $edit['icon']; } ?>" size="40" maxlength="255"></li>
								<li><label>Method:</label>
								<select class="input" name="method">
										  <option value="GET" <?php if(isset($edit)){ if($edit['method']=="GET"){ print "selected";} } ?>>GET</option>
										  <option value="POST" <?php if(isset($edit)){ if($edit['method']=="POST"){ print "selected";} } ?>>POST</option>
								</select>
								</li>
							</div>

							<div id="sub_button" <?php if(!isset($_REQUEST['id'])){ ?> style="display:none;" <?php } ?> >
								<li>
									<label>Turn On:</label>
									<select class="input" name="active">
										<option value="yes"><?=$admin_selection[1] ?></option>
										<option value="no"><?=$admin_selection[2] ?></option>
									</select>
								</li>
								<li><input name="Input" type="submit" value="Add Gateway" class="MainBtn"></li>
							</div>
						</div>
						</ul>
					</form>	
				</div>
				<br class="clear">
			</div>
		</div>
		<br class="clear">
	</div>
</div>