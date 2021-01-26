<?php
	$market_id = (isset($_GET['market_id'])) ? $_GET['market_id'] : 0;
	$site_id = (isset($_GET['site_id'])) ? $_GET['site_id'] : 0;

	$data = array();
	if(isset($_GET['pid'])){
		$data = WldPackageItems($market_id,$_GET['pid']);	
	}
	
?>
<div class="page">
	<div class="heading">
		<h2>Add/Edit Membership Package</h2>
	</div>
	<div class="content">

		<div class="admin-note">
			<p id="TopCommentsBox"><img src="/newadmin/inc/images/icons/help.png" align="admin-note-text"> Complete the forms below to add or update the membership package for your web site.</p>
		</div> 
 
		<div class="box">
			<div class="box-content">
				<div id="contentcolumn" class="contentcolumndash">

					<form method="post" action="" name="form1">

						<input type="hidden" value="settings_add_package" name="do" class="hidden">
						<input type="hidden" name="ispace" value="" class="hidden">
						<input type="hidden" name="StopConfigStrip" value="1" class="hidden">
						<input type="hidden" name="market_id" value="<?=$market_id?>" class="hidden">
						<input type="hidden" name="site_id" value="<?=$site_id?>" class="hidden">
						<?php
						if(isset($_GET['pid'])){
						?>		
						<input type="hidden" name="pid" value="<?=$_GET['pid']?>" class="hidden">
						<?php
						}	
						?>

						<ul class="form">
							<div class="box_body">
								<li>
									<label>Package Type</label>
									<div class="tip">Select yes if you wish to create an SMS only package allowing this package to be used to purchase additional SMS credits on your web site.</div>
									<select class="input" name="smspackage" onchange="javascript:idShowHide(this.value); return false;">
										<option value="0"><?=$admin_billing_extra[3] ?></option>
										<!-- <option value="1">SMS Package</option> -->
									</select>
								</li>
								<?php if(isset($data['type']) =="custom"){ ?>
								<li><label><?=$admin_billing_extra[35] ?></label><input type="checkbox" name="visible" class="radio" <?php if($data['visible'] ==1){print "checked"; } ?> value="1"></li>
								<?php }else{ ?>
								<input type="hidden" name="visible" value="1" class="hidden">
								<?php } ?>
							</div>
						</ul>

						<ul class="form">
							<div class="box_body">
								<li>
									<label><?=$admin_billing_extra[6] ?>:</label>
									<div class="tip"><?=$admin_billing_extra[7] ?></div>
									<input class="input"  name="name" type="text" value="<? if(isset($data['name'])){if($data['name']!=""){echo $data['name']; }}?>" size="40" maxlength="255">
								</li>
								<li>
									<label><?=$admin_billing_extra[8] ?>:</label>
									<div class="tip"><?=$admin_billing_extra[7] ?></div>
									<textarea class="input" name="comments" id="comments"  style="height:70px;"><? if(isset($data['comments'])){if($data['comments']!=""){echo $data['comments']; }} ?></textarea>
								</li>
							</div>
						</ul>
						<ul class="form">
							<div class="box_body">
								
								<li>
									<label><?=$admin_billing_extra[9] ?></label>
									<div class="tip"><?=$admin_billing_extra[10] ?></div>
									<input class="input"  type="text" name="price" value="<? if(isset($data['price'])){if($data['price']!=""){echo $data['price']; }} ?>">
								</li>

								<li>
									<label><?=$admin_billing_extra[11] ?> (<? if(isset($data['currency_code'])){if($data['currency_code']!=""){echo $data['currency_code']; }}?>)</label> 

									<select class="input" name="icurrency">
						                <option value="GBP" <?php if(isset($data['currency_code'])){ if($data['currency_code']=="GBP"){print "selected";}} ?>>GBP (Great British Pound)</option>
										<option value="EUR" <?php if(isset($data['currency_code'])){ if($data['currency_code']=="EUR"){print "selected";}} ?>>EUR (EURO)</option>
										<option value="USD" <?php if(isset($data['currency_code'])){ if($data['currency_code']=="USD"){print "selected";} }?>>USD (United States Dollar)</option>				
										<option value="YEN" <?php if(isset($data['currency_code'])){ if($data['currency_code']=="YEN"){print "selected";}} ?>>YEN (Japanese Yen) </option> 
						                <option value="R" <?php if(isset($data['currency_code'])){ if($data['currency_code']=="R"){print "selected";}} ?>>R (South African Rand Currency)</option>
										<option value="ZL" <?php if(isset($data['currency_code'])){ if($data['currency_code']=="ZL"){print "selected";}} ?>>ZL (Polish Currency)</option>	
										<option value="RMB"  <?php if(isset($data['currency_code'])){ if($data['currency_code']=="RMB"){print "selected";}} ?>>RMB (Chinese Currency)</option>
										<option value="HK" <?php if(isset($data['currency_code'])){ if($data['currency_code']=="HK"){print "selected";}} ?>>HK (Hong Kong Currency)</option>
										<option value="NOK" <?php if(isset($data['currency_code'])){ if($data['currency_code']=="NOK"){print "selected";}} ?>>NOK (Norwegian Kroner)</option>
										<option value="INR" <?php if(isset($data['currency_code'])){ if($data['currency_code']=="INR"){print "selected";}} ?>>INR (Indian Rupees)</option>
										<option value="AUD" <?php if(isset($data['currency_code'])){ if($data['currency_code']=="AUD"){print "selected";}} ?>>AUD (Australian Dollar)</option>
										<option value="CAD" <?php if(isset($data['currency_code'])){ if($data['currency_code']=="CAD"){print "selected";}} ?>>CAD (Canadian Dollar)</option>
										<option value="CHF" <?php if(isset($data['currency_code'])){ if($data['currency_code']=="CHF"){print "selected";}} ?>>CHF (Swiss Franc)</option>
										<option value="CZK" <?php if(isset($data['currency_code'])){ if($data['currency_code']=="CZK"){print "selected";}} ?>>CZK (Czech Koruna)</option>
										<option value="DKK" <?php if(isset($data['currency_code'])){ if($data['currency_code']=="DKK"){print "selected";}} ?>>DKK (Danish Krone)</option>
										<option value="HUF" <?php if(isset($data['currency_code'])){ if($data['currency_code']=="HUF"){print "selected";}} ?>>HUF (Hungarian Forint)</option>
										<option value="NZD" <?php if(isset($data['currency_code'])){ if($data['currency_code']=="NZD"){print "selected";}} ?>>NZD (New Zealand Dollar)</option>
										<option value="PLN" <?php if(isset($data['currency_code'])){ if($data['currency_code']=="PLN"){print "selected";}} ?>>PLN (Polish Zloty)</option>
										<option value="SEK" <?php if(isset($data['currency_code'])){ if($data['currency_code']=="SEK"){print "selected";}} ?>>SEK (Swedish Krona)</option>
										<option value="SGD" <?php if(isset($data['currency_code'])){ if($data['currency_code']=="SGD"){print "selected";}} ?>>SGD (Singapore Dollar)</option>
										<option value="BRL" <?php if(isset($data['currency_code'])){ if($data['currency_code']=="BRL"){print "selected";}} ?>>BRL (Brazilian Real)</option>
						 				<option value="TL" <?php if(isset($data['currency_code'])){ if($data['currency_code']=="TL"){print "selected";}} ?>>TL</option>
										<option value="THB" <?php if(isset($data['currency_code'])){ if($data['currency_code']=="THB"){print "selected";}} ?>>THB (Thai Baht)</option>
							      	</select>
									<div class="tip"><?=$admin_billing_extra[12] ?></div>
								</li>
								<li>
									<label><?=$admin_billing_extra[13] ?></label>
									<select class="input" name="isub">
										<option value="yes" <?php if(isset($data['currency_code'])){  if($data['subscription']=="yes"){print "selected";} }?>><?=$admin_selection[1] ?></option>
										<option value="no" <?php if(isset($data['currency_code'])){  if($data['subscription']=="no"){print "selected";} }?>><?=$admin_selection[2] ?></option>
									</select>
									<div class="tip"><?=$admin_billing_extra[14] ?></div>
								</li>
								<li><label><?=$admin_billing_extra[15] ?></label>               
				  					<select class="input" name="numdays">
									<option value="1"<?php if(isset($data['currency_code'])){ if($data['numdays'] =='1'){ print "selected"; }} ?>>1<?=$admin_billing_extra[16] ?></option>
									<option value="2"<?php if(isset($data['currency_code'])){  if($data['numdays'] =='2'){ print "selected"; }} ?>>2<?=$admin_billing_extra[16] ?>s</option>
									<option value="3"<?php if(isset($data['currency_code'])){  if($data['numdays'] =='3'){ print "selected"; } }?>>3<?=$admin_billing_extra[16] ?>s</option>
									<option value="4"<?php if(isset($data['currency_code'])){  if($data['numdays'] =='4'){ print "selected"; }} ?>>4<?=$admin_billing_extra[16] ?>s</option>
									<option value="5"<?php if(isset($data['currency_code'])){  if($data['numdays'] =='5'){ print "selected"; } }?>>5<?=$admin_billing_extra[16] ?>s</option>
									<option value="6"<?php if(isset($data['currency_code'])){  if($data['numdays'] =='6'){ print "selected"; } }?>>6<?=$admin_billing_extra[16] ?>s</option>
									<option value="7" <?php if(isset($data['currency_code'])){  if($data['numdays'] =='7'){ print "selected"; } }?>>1<?=$admin_billing_extra[17] ?></option>
									<option value="14" <?php if(isset($data['currency_code'])){  if($data['numdays'] =='14'){ print "selected"; } }?>>2<?=$admin_billing_extra[17] ?></option>
									<option value="21" <?php if(isset($data['currency_code'])){  if($data['numdays'] =='21'){ print "selected"; } }?>>3<?=$admin_billing_extra[17] ?></option>
									<option value="30" <?php if(isset($data['currency_code'])){  if($data['numdays'] =='30'){ print "selected"; } }?>>1<?=$admin_billing_extra[18] ?></option>
									<option value="60" <?php if(isset($data['currency_code'])){  if($data['numdays'] =='60'){ print "selected"; } }?>>2<?=$admin_billing_extra[18] ?></option>
									<option value="90" <?php if(isset($data['currency_code'])){  if($data['numdays'] =='90'){ print "selected"; } }?>>3<?=$admin_billing_extra[18] ?></option>
									<option value="120" <?php if(isset($data['currency_code'])){  if($data['numdays'] =='120'){ print "selected"; } }?>>4<?=$admin_billing_extra[18] ?></option>
									<option value="150" <?php if(isset($data['currency_code'])){  if($data['numdays'] =='150'){ print "selected"; } }?>>5<?=$admin_billing_extra[18] ?></option>
									<option value="180" <?php if(isset($data['currency_code'])){  if($data['numdays'] =='180'){ print "selected"; } }?>>6<?=$admin_billing_extra[18] ?></option>
									<option value="210" <?php if(isset($data['currency_code'])){  if($data['numdays'] =='210'){ print "selected"; } }?>>7<?=$admin_billing_extra[18] ?></option>
									<option value="240" <?php if(isset($data['currency_code'])){  if($data['numdays'] =='240'){ print "selected"; } }?>>8<?=$admin_billing_extra[18] ?></option>
									<option value="270" <?php if(isset($data['currency_code'])){  if($data['numdays'] =='270'){ print "selected"; } }?>>9<?=$admin_billing_extra[18] ?></option>
									<option value="300" <?php if(isset($data['currency_code'])){  if($data['numdays'] =='300'){ print "selected"; } }?>>10<?=$admin_billing_extra[18] ?></option>
									<option value="330" <?php if(isset($data['currency_code'])){  if($data['numdays'] =='330'){ print "selected"; } }?>>11<?=$admin_billing_extra[18] ?></option>
									<option value="360" <?php if(isset($data['currency_code'])){  if($data['numdays'] =='360'){ print "selected"; } }?>>12<?=$admin_billing_extra[18] ?></option>
									<option value="540" <?php if(isset($data['currency_code'])){  if($data['numdays'] =='540'){ print "selected"; } }?>>18<?=$admin_billing_extra[18] ?></option>
									<option value="720" <?php if(isset($data['currency_code'])){  if($data['numdays'] =='720'){ print "selected"; } }?>>24<?=$admin_billing_extra[18] ?></option>
									<option value="2147483647" <?php if(isset($data['currency_code'])){  if($data['numdays'] =='2147483647'){ print "selected"; }} ?>><?=$admin_billing_extra['18a'] ?></option>
				  					</select>
								</li>
							</div>
						</ul>

						<ul class="form">
							<div class="box_body">
								
								<li>
									<label><?=$admin_billing_extra[19] ?></label>
									<input class="input" type="text" name="imessages" value="<? if(isset($data['maxMessage'])){if($data['maxMessage']!=""){echo $data['maxMessage']; }} ?>">
									<div class="tip"><?=$admin_billing_extra[20] ?></div>
								</li>
								<li>
									<label><?=$admin_billing_extra[21] ?></label>
									<input class="input" type="text" name="iwink" value="<? if(isset($data['wink'])){if($data['wink']!=""){echo $data['wink']; }} ?>">
									<div class="tip"><?=$admin_billing_extra[22] ?></div>
								</li>
								<li>
									<label><?=$admin_billing_extra[23] ?></label>
									<input class="input" type="text" name="ifiles" value="<? if(isset($data['maxFiles'])){if($data['maxFiles']!=""){echo $data['maxFiles']; }} ?>">
									<div class="tip"><?=$admin_billing_extra[24] ?></div>
								</li>



								<li>
									<label><?=$admin_billing_extra[27] ?></label>
									<select class="input" name="ifeatured">
										<option value="yes"><?=$admin_selection[1] ?></option>
										<option value="no" <?php if(isset($data['Featured']) && $data['Featured']=="no"){print "selected";} ?>><?=$admin_selection[2] ?></option>
									</select>
									<div class="tip"><?=$admin_billing_extra[28] ?></div>
								</li>
								<li style="background-color:#FCDCDC;">
									<label><?=$admin_billing_extra[31] ?></label>
									<select class="input" name="iadult">
										<option value="yes"><?=$admin_selection[1] ?></option>
										<option value="no" <?php if(isset($data['view_adult']) && $data['view_adult']=="no"){print "selected";} ?>><?=$admin_selection[2] ?></option>
									</select>
									<div class="tip"><?=$admin_billing_extra[32] ?></div>
								</li>
								<li>
									<input type="submit" value="Update" class="MainBtn">
								</li>
							</div>
						</ul>
					</form>
				</div>
			</div>

			<br class="clear">
		</div>
	</div>
	<br class="clear">
	<!-- EMEETING CONTENT END -->

</div>