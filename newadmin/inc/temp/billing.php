<?php if(!isset($_REQUEST['p']) || $_REQUEST['p'] == "packages" || $_REQUEST['p']==""){ ?>
<br class="clear">

<?php if(D_FREE !="yes"){ ?>


 

<ul class="form"><div class="box_body">

<form action="billing.php" method="post" name="profile" onSubmit="return CheckMemberForm();">
<input name="do" type="hidden" value="none" id="do" class="hidden">
<input name="p" type="hidden" value="packages" class="hidden">

  <div class="overflow_scroll">
  <div class="scroll_div">
			<table class="sortable resizable editable widefat">
                <thead>a
                  <tr> 
                    <th scope="col"></th>
          					<th scope="col"><?=$admin_table_val[22] ?></th>
                    <th scope="col"><?=$admin_table_val[12] ?></th>
                    <th scope="col"><?=$admin_table_val[23] ?></th>
                    <th scope="col"><?=$admin_table_val[24] ?></th>
                    <th scope="col">Members</th>
                    <th scope="col">Language</th>
                    <th scope="col"><?=$admin_table_val[20] ?></th>                    
                  </tr>
                </thead>
                <tbody>
                  <?php $totalnum = DisplayPackages(); ?>
                </tbody>
              </table>
            
</div>
</div>

<input name="NumRows" type='hidden' class='hidden' value='<?=$totalnum ?>'>
<br class="clear">

<div class="bar_save">

<input type="button" value="<?=$admin_button_val[1] ?>" class="NormBtn" onClick="ca(<?=$totalnum ?>)"/>
<input type="button" value="<?=$admin_button_val[2] ?>" class="NormBtn"  onClick="ua(<?=$totalnum ?>)"/>
<input type="button" value="<?=$admin_button_val[5] ?>" class="MainBtn"  onclick="ChangeOption('packagedelete');"/>

</div>
</form>
</div></ul>


<?php }else{ ?>


<p><?=$admin_billing[4] ?></p>
<p><?=$admin_billing[5] ?></p>
   <form method="post" action="billing.php">
   <input type="hidden" name="do" value="disablefree" class="hidden">
	
  	<ul class="form"><div class="box_body">

	<li><label><?=$admin_billing[6] ?></label><select class="input" name="free"><option value="no"><?=$admin_selection[1] ?></option></select><div class="tip"><?=$admin_billing_extra[1] ?></div></li>		
	<li><input type="submit" value="<?=$admin_button_val[8] ?>" class="MainBtn"></li>
	</div></ul></form>
<?php } ?>
<?php }
elseif($_REQUEST['p'] =="epackagelanguage"){ ?>

<p id='TopCommentsBox'> <img src='inc/images/icons/help.png' align='absmiddle'> A display caption is a short description of the content you would like members to enter into the field. For example a caption such as "Basic Membership" would prompt the member to select their membership plan from the list box.</p>
<div class="bar_save">
  <input type="button" value="Add New Caption" class="MainBtn" onclick="javascript:idShowHide('AddCaptionHide');">
</div>
<div id="AddCaptionHide" style="display:none;">
  <form method="post" action="billing.php" name="form1">
    <input name="cid" type="hidden" value="<?= $_REQUEST['id'] ?>" class="hidden">
    <input name="do" type="hidden" value="packageaddcaption" class="hidden">
    <ul class="form">
        <li><label><?=$admin_management[41] ?>:  </label><input name="caption" type="text" class="input"size="40"></li>
        <li><label><?=$admin_management[42] ?>:  </label><textarea class="input" name="description" style="height:60px;"></textarea></li>
        <li><label><?=$admin_management[18] ?>:</label>
          <select name="lang"><?=FieldLangs() ?></select>
        </li>
        <li><input type="submit" value="<?=$admin_button_val[8] ?>" class="MainBtn"></li>
    </ul>
  </form>
</div>
<?/*




  

  <br class="clear">
  <div class="bar_save">
  <input type="button" value="Add New Caption" class="MainBtn"  onclick="javascript:idShowHide('AddCaptionHide');"/>
  </div>

<br class="clear">
<div id="header-text">
  <h1><?=$admin_management[47] ?></h1>
</div>*/?>


<div id="TableViewer"></div>
 
      

<?php }
else if($_REQUEST['p'] == "credits"){ ?>
<style type="text/css">
  ul.form label{
    float: left;
    line-height: 26px;
    width: 100%;
    max-width: 150px;
  }
  ul.form span{
    font-size: 14px;
    font-weight: bold;
    padding-left: 10px;
  }
</style>

<form name="form1" method="post" action="billing.php">
  <input name="do" type="hidden" value="updatecredits" class="hidden">
  <input name="p" type="hidden" value="credits" class="hidden">
  <input name="mid" type="hidden" value="<?=$_REQUEST['id'] ?>" class="hidden">
  <ul class="form">
    <div class="box_body">
      <li>
        <label>User Credits: </label>
        <select class="input" name="credit_status">
          <option value="yes" <?=(D_CREDIT_STATUS == 'yes') ? "selected='selected'" : ''?>>Yes</option>
          <option value="no" <?=(D_CREDIT_STATUS == 'no') ? "selected='selected'" : ''?>>No</option>
        </select>
      </li>
      <?php
      if(D_CREDIT_STATUS == 'yes'){
      ?>
      <li>
        <label>Emails Per Credit: </label>
        <input name="credit_emails" type="text" size="5" class="input" value="<?=D_CREDIT_EMAILS?>" onkeypress="return isNumber();">
        <span>The number of emails that can be sent per credit.</span>
      </li>
      <li>
        <label>Price Per Credit: </label>
        <input name="credit_price" type="text" size="5" class="input" value="<?=D_CREDIT_PRICE?>" onkeypress="return isNumber();">
        <span>The price per credit. Don't put the currency symbol. Just the number.</span>
      </li>
      <?php
      }
      ?>
      <li><input name="Input" type="submit" value="<?=$admin_button_val[8] ?>" class="MainBtn"></li>
    </div>
  </ul>
</form>

<br class="clear">
<script type="text/javascript">
  function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
  }
</script>
<?php }
elseif($_REQUEST['p'] == "fields"){ ?>

<form name="form1" method="post" action="billing.php">
<input name="do" type="hidden" value="addf" class="hidden">
<input name="p" type="hidden" value="gateway" class="hidden">
<input name="mid" type="hidden" value="<?=$_REQUEST['id'] ?>" class="hidden">
<ul class="form"><div class="box_body">
<li><label><?=$admin_billing[8] ?>: </label> <input name="name" type="text" size="40" maxlength="255"></li>
<li><label><?=$admin_billing[9] ?>: </label> <input name="value" type="text" size="40" maxlength="255"></li>
<li><label><?=$admin_billing[10] ?>: </label>
        <select class="input" name="type">
          <option value="hidden">hidden field</option>
        </select>
</li>
<li><input name="Input" type="submit" value="<?=$admin_button_val[8] ?>" class="MainBtn"></li>
</div></ul>
</form>

<br class="clear">
<div id="header-text">
	<h1><?=$admin_billing[11] ?></h1>
</div>

<form method="post" action="billing.php"  name="profile2" onSubmit="return CheckMemberForm2();">
<input name="do" type="hidden" value="none" id="do2" class="hidden">
<input name="mid" type="hidden" value="<?=$_REQUEST['id'] ?>" class="hidden">
<input name="p" type="hidden" value="gateway" class="hidden">
<table class="widefat">
                <thead>
                  <tr> 
                    <th></th>
                    <th><?=$admin_billing[8] ?></th>
                    <th><?=$admin_billing[9] ?></th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $totalnum =DisplayRows($_REQUEST['id']); ?>
                </tbody>
</table>

<input name="NumRows" type='hidden' class='hidden' value='<?=$totalnum ?>'>
<br class="clear">

<div class="bar_save">

<input type="button" value="<?=$admin_button_val[1] ?>" class="NormBtn" onClick="ca2(<?=$totalnum ?>)"/>
<input type="button" value="<?=$admin_button_val[2] ?>" class="NormBtn"  onClick="ua2(<?=$totalnum ?>)"/> -
<input type="button" value="<?=$admin_button_val[5] ?>" class="NormBtn"  onclick="ChangeOption2('paymentitemdelete');"/>

</div>
</form>
<br class="clear">	  
<?php }
elseif($_REQUEST['p'] == "editfield"){ 
?>

<form name="form1" method="post" action="billing.php" enctype="multipart/form-data">
<input name="do" type="hidden" value="editf" class="hidden">
<input name="p" type="hidden" value="gateway" class="hidden">
<input name="fid" type="hidden" value="<?=$_REQUEST['id'] ?>" class="hidden">
<ul class="form"><div class="box_body">
<?php
  $field_val = DisplayRow($_REQUEST['id']);
?>
<li><label><?=$admin_billing[8] ?>: </label> <input name="name" type="text" size="40" value="<?=$field_val['name']?>" maxlength="255" readonly></li>
<li><label><?=$admin_billing[9] ?>: </label> <input name="value" type="text" size="40" value="<?=$field_val['value']?>" value="" maxlength="255"></li>

<li><input name="Input" type="submit" value="<?=$admin_button_val[8] ?>" class="MainBtn"></li>
</div></ul>
</form>


<?php 
}
elseif($_REQUEST['p'] == "addgateway"){ ?>


<form name="form1" method="post" action="billing.php" enctype="multipart/form-data">
<input name="do" type="hidden" value="addgateway" class="hidden">
<input name="comments" type="hidden" value="" class="hidden">
<input name="p" type="hidden" value="gateway" class="hidden">
<?php if(isset($_REQUEST['id'])){ ?><input name="editid" type="hidden" value="<?=$_REQUEST['id'] ?>" class="hidden"><?php $edit = EditField($_REQUEST['id']); $editMeta = GetMetaData($_REQUEST['id']); } ?>
<ul class="form"><div class="box_body">
<div id="gateway_custom" <?php if(isset($_REQUEST['id'])){ ?> style="display:none;" <?php }else{ ?>style="display:visible;"<?php } ?>>
<li><label><?=$admin_billing[13] ?>:</label>
<select class="input" name="gateway" onchange="javascript:idShowHide(this.value);idShowHide('gateway_custom');idShowHide('sub_button');">
   <option value="paypal">-----------</option>
   <option value="paypal">Paypal</option>
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
	 <option value="stripe">Stripe</option>
   <option value="custom_code">Create Custom Payment Gateway</option>
</select>
</li>
</div>


<div id="paypal" style="display:none;">
	<li><label>Paypal Email:</label><input class="input" name="email" type="text"  size="40" maxlength="255"></li>
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

<div id="stripe" style="display:none;">
  <li><label>Stripe:</label></li>
  <input class="input" name="stt" type="hidden" value="Stripe">
  <input class="input" name="stn" type="hidden" value="Stripe">
  <input class="input" name="sta" type="hidden" value="https://checkout.stripe.com/checkout.js">
  <input class="input" name="sti" type="hidden" value="<?=DB_DOMAIN?>images/card-icons.png">
  <input class="input" name="stme" type="hidden" value="POST">


</div>

<div id="custom_code" <?php if(!isset($_REQUEST['id'])){ ?> style="display:none;" <?php } ?>>
  <li>
    <label>Merchant Title: </label>
    <input class="input" name="title" type="text"  value="<?php if(isset($edit)){ print $edit['title']; } ?>" size="40" maxlength="255">
  </li>
  <li>
    <label>Merchant Name: </label>
    <input class="input" name="name" type="text" value="<?php if(isset($edit)){ print $edit['name']; } ?>" size="40" maxlength="255">
  </li>
	<li>
    <label>Merchant Post Action: </label>
    <input class="input" name="action" type="text" value="<?php if(isset($edit)){ print $edit['action']; } ?>" size="40" maxlength="255">
  </li>
	<li>
    <label>Merchant Image:</label>
    <input class="input" name="icon" type="text" value="<?php if(isset($edit)){ print $edit['icon']; } ?>" size="40" maxlength="255">
  </li>
  <?php
  if(isset($edit) && $edit['title']=="Requitix"){
  ?>
  <li>
    <label>Ethereum ERC20 wallet address:</label>
    <input class="input" name="requitix_address" type="text" value="<?=ETH_ADDRESS?>" size="60" maxlength="255">
  </li>
  <li>
    <label>Requitix API key:</label>
    <input class="input" name="requitix_api_key" type="text" value="<?=REQUITIX_API_KEY?>" size="60" maxlength="255">
  </li>
  <li>
    <label>Ethereum wallet address QR code:</label>
    <input class="input" name="requitix_image" type="file">
    <br>
    <br>
    <?php
    if(ETH_image != ""){
    ?>
    <img src="<?=DB_DOMAIN?>uploads/crypto_qr/<?=ETH_image?>">
    <?php  
    }
    ?>

  </li>
  
  <?php  
  }
  ?>
	<li>
    <label>Method:</label>
	  <select class="input" name="method">
		  <option value="GET" <?php if(isset($edit) && $edit['method']=="GET"){ print "selected";}?>>GET</option>
			<option value="POST" <?php if(isset($edit) && $edit['method']=="POST"){ print "selected";}?>>POST</option>
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
  <li>
    <input name="Input" type="submit" value="Add Gateway" class="MainBtn">
  </li>
</div>
</div></ul>

</form>	

<?php }elseif($_REQUEST['p'] == "gatewaycode"){ ?>

<textarea class="input" name="textarea" cols="50" rows="10" style="font-size: 11px; width:600px; height:400px;"><?=DisplayGatewayCode($_REQUEST['id']) ?></textarea>

<?php }elseif($_REQUEST['p'] == "gateway"){ ?>


 <div class="bar_save">
<input type="button" value="Add Gateways" class="NormBtn" onClick="javascript:location.href='?p=addgateway'"/>
<br class="clear">
</div>

<br class="clear">
<form method="post" action="billing.php" name="profile2" onSubmit="return CheckMemberForm2();">
<input name="do" type="hidden" value="none" id="do2" class="hidden">
<input name="p" type="hidden" value="gateway" class="hidden">
<div class="overflow_scroll">
<div class="fifth_half">
<table class="widefat">
                <thead>
                  <tr> 
                    <th></th>
                    <th><?=$admin_table_val[12] ?></th>
                    <th><?=$admin_table_val[27] ?></th>
                    <th><?=$admin_table_val[28] ?></th>
                    <th><?=$admin_table_val[29] ?></th>
                    <th><?=$admin_table_val[20] ?></th>
                  </tr>
                </thead>
                <tbody>
                  <?php $tRows =DisplayGateways(); ?>
                </tbody>
              </table>
 </div>    
 </div>         
<input name="NumRows" type='hidden' class='hidden' value='<?=$tRows ?>'>
<br class="clear">

<div class="bar_save">
<input type="button" value="<?=$admin_button_val[1] ?>" class="NormBtn" onClick="ca2(<?=$tRows ?>)"/>
<input type="button" value="<?=$admin_button_val[2] ?>" class="NormBtn"  onClick="ua2(<?=$tRows ?>)"/> - 
<input type="button" value="<?=$admin_button_val[5] ?>" class="MainBtn"  onclick="ChangeOption2('gatewaydelete');"/>
<br class="clear">
</div>
</form>
 
 
 
	  
<?php }elseif($_REQUEST['p'] == "upall"){ ?>




<br class="clear">

<form method="post" action="billing.php">
<input type="hidden" value="transfer" name="do" class="hidden">
<ul class="form">           
   <div class="box_body">
    <li><label><?=$admin_billing[19] ?>: </label>  <select class="input" name="from_pid" onChange="ShowUp()"><?= DisplayPackage() ?></select></li>	  
	<li><label><?=$admin_billing[20] ?>: </label>  <select class="input" name="to_pid" onChange="ShowUp()"><?= DisplayPackage() ?></select></li>	  
	<li><input type="submit" value="<?=$admin_button_val[8] ?>" class="MainBtn"></li>
	</div>
    </ul>
</form>




<?php }elseif($_REQUEST['p'] == "epackage"){ ?>



<form method="post" action="billing.php" name="form1" enctype="multipart/form-data">
<input type="hidden" value="packages" name="p" class="hidden">
<input type="hidden" value="add" name="do" class="hidden">
<input type="hidden" name="ispace" value="" class="hidden">
<input type="hidden" name="StopConfigStrip" value="1" class="hidden">

<?php if(isset($_REQUEST['id'])){ $data = PackageItems($_REQUEST['id']); ?>
<input type="hidden" name="eid" value="<?=$_REQUEST['id'] ?>" class="hidden">
<?php /*if($data['icon'] == "SMS"){ ?>
<input type="hidden" name="icon" value="SMS" class="hidden">
<?php }*/ } ?>

<ul class="form">
<div class="box_body">
<li>
  
  <label><?=$admin_billing_extra[2] ?></label>
  <div class="tip"><?=$admin_billing_extra[5] ?></div>
  
  <select class="input" name="smspackage" onchange="javascript:idShowHide(this.value); return false;">
    <option value="0"><?=$admin_billing_extra[3] ?></option>
    <?php /*<option value="1" <?php if(isset($data['icon']) && $data['icon'] == "SMS"){ ?>selected<?php }?>><?=$admin_billing_extra[4] ?></option> */?>
  </select>

</li>

<?php if(isset($data['type']) =="custom"){ ?>
<li><label><?=$admin_billing_extra[35] ?></label><input type="checkbox" name="visible" class="radio" <?php if($data['visible'] ==1){print "checked"; } ?> value="1"></li>
<?php }else{ ?>
<input type="hidden" name="visible" value="1" class="hidden">
<?php } ?>
</div></ul><ul class="form"><div class="box_body">
<li><label><?=$admin_billing_extra[6] ?>:</label><div class="tip"><?=$admin_billing_extra[7] ?></div><input class="input"  name="name" type="text" value="<? if(isset($data['name'])){if($data['name']!=""){echo $data['name']; }}?>" size="40" maxlength="255"></li>
<li><label><?=$admin_billing_extra[8] ?>:</label><div class="tip"><?=$admin_billing_extra[7] ?></div><textarea class="input" name="comments" id="comments"  style="height:70px;"><? if(isset($data['comments'])){if($data['comments']!=""){echo $data['comments']; }} ?></textarea></li>
</div></ul><ul class="form"><div class="box_body">
<li><label><?=$admin_billing_extra[9] ?></label><div class="tip"><?=$admin_billing_extra[10] ?></div><input class="input"  type="text" name="price" value="<? if(isset($data['price'])){if($data['price']!=""){echo $data['price']; }} ?>"></li>
<li><label><?=$admin_billing_extra[11] ?> (<? if(isset($data['currency_code'])){if($data['currency_code']!=""){echo $data['currency_code']; }}?>)</label> 

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
<div class="tip"><?=$admin_billing_extra[12] ?></div></li>
<div id="1" style="display:visible;">
	<li><label><?=$admin_billing_extra[13] ?></label><select class="input" name="isub"><option value="yes" <?php if(isset($data['currency_code'])){  if($data['subscription']=="yes"){print "selected";} }?>><?=$admin_selection[1] ?></option><option value="no" <?php if(isset($data['currency_code'])){  if($data['subscription']=="no"){print "selected";} }?>><?=$admin_selection[2] ?></option></select><div class="tip"><?=$admin_billing_extra[14] ?></div></li>
	<li><label><?=$admin_billing_extra[15] ?></label>               
				  <select class="input" name="numdays">
					<option value="1"<?php if(isset($data['currency_code'])){ if($data['numdays'] =='1'){ print "selected"; }} ?>>1                 <?=$admin_billing_extra[16] ?></option>
					<option value="2"<?php if(isset($data['currency_code'])){  if($data['numdays'] =='2'){ print "selected"; }} ?>>2                 <?=$admin_billing_extra[16] ?>s</option>
					<option value="3"<?php if(isset($data['currency_code'])){  if($data['numdays'] =='3'){ print "selected"; } }?>>3                 <?=$admin_billing_extra[16] ?>s</option>
					<option value="4"<?php if(isset($data['currency_code'])){  if($data['numdays'] =='4'){ print "selected"; }} ?>>4                 <?=$admin_billing_extra[16] ?>s</option>
					<option value="5"<?php if(isset($data['currency_code'])){  if($data['numdays'] =='5'){ print "selected"; } }?>>5                 <?=$admin_billing_extra[16] ?>s</option>
					<option value="6"<?php if(isset($data['currency_code'])){  if($data['numdays'] =='6'){ print "selected"; } }?>>6                 <?=$admin_billing_extra[16] ?>s</option>
					<option value="7" <?php if(isset($data['currency_code'])){  if($data['numdays'] =='7'){ print "selected"; } }?>>1               <?=$admin_billing_extra[17] ?></option>
					<option value="14" <?php if(isset($data['currency_code'])){  if($data['numdays'] =='14'){ print "selected"; } }?>>2                <?=$admin_billing_extra[17] ?></option>
					<option value="21" <?php if(isset($data['currency_code'])){  if($data['numdays'] =='21'){ print "selected"; } }?>>3                 <?=$admin_billing_extra[17] ?></option>
					<option value="30" <?php if(isset($data['currency_code'])){  if($data['numdays'] =='30'){ print "selected"; } }?>>1                <?=$admin_billing_extra[18] ?></option>
					<option value="60" <?php if(isset($data['currency_code'])){  if($data['numdays'] =='60'){ print "selected"; } }?>>2                 <?=$admin_billing_extra[18] ?></option>
					<option value="90" <?php if(isset($data['currency_code'])){  if($data['numdays'] =='90'){ print "selected"; } }?>>3                 <?=$admin_billing_extra[18] ?></option>
					<option value="120" <?php if(isset($data['currency_code'])){  if($data['numdays'] =='120'){ print "selected"; } }?>>4                <?=$admin_billing_extra[18] ?></option>
					<option value="150" <?php if(isset($data['currency_code'])){  if($data['numdays'] =='150'){ print "selected"; } }?>>5                 <?=$admin_billing_extra[18] ?></option>
					<option value="180" <?php if(isset($data['currency_code'])){  if($data['numdays'] =='180'){ print "selected"; } }?>>6                 <?=$admin_billing_extra[18] ?></option>
					<option value="210" <?php if(isset($data['currency_code'])){  if($data['numdays'] =='210'){ print "selected"; } }?>>7                <?=$admin_billing_extra[18] ?></option>
					<option value="240" <?php if(isset($data['currency_code'])){  if($data['numdays'] =='240'){ print "selected"; } }?>>8               <?=$admin_billing_extra[18] ?></option>
					<option value="270" <?php if(isset($data['currency_code'])){  if($data['numdays'] =='270'){ print "selected"; } }?>>9                <?=$admin_billing_extra[18] ?></option>
					<option value="300" <?php if(isset($data['currency_code'])){  if($data['numdays'] =='300'){ print "selected"; } }?>>10                <?=$admin_billing_extra[18] ?></option>
					<option value="330" <?php if(isset($data['currency_code'])){  if($data['numdays'] =='330'){ print "selected"; } }?>>11                <?=$admin_billing_extra[18] ?></option>
					<option value="360" <?php if(isset($data['currency_code'])){  if($data['numdays'] =='360'){ print "selected"; } }?>>12                <?=$admin_billing_extra[18] ?></option>
					<option value="540" <?php if(isset($data['currency_code'])){  if($data['numdays'] =='540'){ print "selected"; } }?>>18                <?=$admin_billing_extra[18] ?></option>
					<option value="720" <?php if(isset($data['currency_code'])){  if($data['numdays'] =='720'){ print "selected"; } }?>>24                <?=$admin_billing_extra[18] ?></option>
					<option value="2147483647" <?php if(isset($data['currency_code'])){  if($data['numdays'] =='2147483647'){ print "selected"; }} ?>><?=$admin_billing_extra['18a'] ?></option>
				  </select>
	</li>
</div></ul><ul class="form"><div class="box_body">
	<li><label><?=$admin_billing_extra[19] ?></label><input class="input" type="text" name="imessages" value="<? if(isset($data['maxMessage'])){if($data['maxMessage']!=""){echo $data['maxMessage']; }} ?>"><div class="tip"><?=$admin_billing_extra[20] ?></div></li>
	<li><label><?=$admin_billing_extra[21] ?></label><input class="input" type="text" name="iwink" value="<? if(isset($data['wink'])){if($data['wink']!=""){echo $data['wink']; }} ?>"><div class="tip"><?=$admin_billing_extra[22] ?></div></li>
	<li><label><?=$admin_billing_extra[23] ?></label><input class="input" type="text" name="ifiles" value="<? if(isset($data['maxFiles'])){if($data['maxFiles']!=""){echo $data['maxFiles']; }} ?>"><div class="tip"><?=$admin_billing_extra[24] ?></div></li>
	<!-- <li><label><?=$admin_billing_extra[29] ?></label><select class="input" name="ihighlight"><option value="yes"><?=$admin_selection[1] ?></option><option value="no" <?php if($data['Highlighted']=="no"){print "selected";} ?>><?=$admin_selection[2] ?></option></select><div class="tip"><?=$admin_billing_extra[30] ?></div></li>		
	<li><label><?=$admin_billing_extra[25] ?></label><input class="input" type="text" name="icon" value="<?php if($data['icon'] !="SMS"){ print $data['icon']; }?>" size="40" maxlength="255"><div class="tip"><?=$admin_billing_extra[26] ?></div></li> -->
	<li><label><?=$admin_billing_extra[27] ?></label><select class="input" name="ifeatured"><option value="yes"><?=$admin_selection[1] ?></option><option value="no" <?php if(isset($data['Featured']) && $data['Featured']=="no"){print "selected";} ?>><?=$admin_selection[2] ?></option></select><div class="tip"><?=$admin_billing_extra[28] ?></div></li>
	<li style="background-color:#FCDCDC;"><label><?=$admin_billing_extra[31] ?></label><select class="input" name="iadult"><option value="yes"><?=$admin_selection[1] ?></option><option value="no" <?php if(isset($data['view_adult']) && $data['view_adult']=="no"){print "selected";} ?>><?=$admin_selection[2] ?></option></select><div class="tip"><?=$admin_billing_extra[32] ?></div></li>

  <li><label>Membership Image</label><input type="file" id="membership-icon" name="icon" onchange="validateImage(this);">
  <div class="tip">Icon should be 75 x 75 pixels and should be in .png format.</div>
  <br/>
  <?php if(isset($_REQUEST['id']) && file_exists($_SERVER['DOCUMENT_ROOT']."/uploads/membershipicons/".$_REQUEST['id'].".png")){ ?>
    <img src="<?php echo DB_DOMAIN."uploads/membershipicons/".$_REQUEST['id'] .".png"; ?>">
  <?php
  } ?>
  </li>
</div>

<?php /*if(UPGRADE_SMS =="yes"){ ?>
 </ul><ul class="form"><div class="box_body">
<li><label><?=$admin_billing_extra[33] ?></label><input type="text" name="isms" class="input" value="<?=$data['SMS_credits'] ?>"><div class="tip"><?=$admin_billing_extra[34] ?></div></li>       			  
<?php }*/ ?>


<li><input type="submit" value="<?=$admin_button_val[8] ?>" class="MainBtn"></li>

</div></ul>
</form>
<script type="text/javascript">
  var input = document.getElementById('membership-icon');

  input.addEventListener("change", function() {
    var file  = this.files[0];
    var img = new Image();

    if(file.name.split(".").pop() != 'png' && file.name.split(".").pop() != 'PNG'){
      alert("Please upload .png file");
      document.getElementById("membership-icon").value = "";
      return false;

    }
    img.onload = function() {
    var sizes = {
        width:this.width,
      height: this.height
    };
    if(this.width != 75 || this.height != 75){
      alert("Imgae dimensions should be of 75x75 pixels");
      document.getElementById("membership-icon").value = "";
      return false;
    }

    URL.revokeObjectURL(this.src);

    
    }

    var objectURL = URL.createObjectURL(file);

    console.log('change: file', file);
    console.log('change: objectURL', objectURL);
    img.src = objectURL;
  });
</script>
<?php }

  elseif($_REQUEST['p'] == "reports"){

  $monthly_members = GetRegistrationsMonthly();

  $custom_reports = GetCustomReports();

  $arrMonths = array();
  $arrMembers = array();
  $arrPackageCount = array();
  $arrPackagenName = array();

  foreach ($monthly_members as $key => $month_members) {
      
      $arrMonths[$key] = $month_members['month'];

      $arrMembers[$key] = $month_members['count'];

      $packagesMembers = $month_members['packages'];

      foreach ($packagesMembers as $pid => $packageMember) {
          
        $arrPackageCount[$pid][$key] = $packageMember['count'];

        $arrPackagenName[$pid] = $packageMember['name'];

      }
  }

  $arrMonths = array_reverse($arrMonths);
  $arrMembers = array_reverse($arrMembers);

  $temp_array = $arrPackageCount;

  foreach ($temp_array as $pid => $packageCount) {
      $arrPackageCount[$pid] = array_reverse($packageCount);
  }

  $colors = array('#FF0000','#008000','#000080','#800080','#33F0F6','#F69833','#35C61B','#206714','#1A5FFF','#FF1AD9','#EFC93E');
  $k = array_rand($colors);
  
 ?>

<style>

/* Sweep To Right */
.hvr-sweep-to-right {
  display: inline-block;
  height: 90px;
  vertical-align: middle;
  -webkit-transform: translateZ(0);
  transform: translateZ(0);
  box-shadow: 0 0 1px rgba(0, 0, 0, 0);
  -webkit-backface-visibility: hidden;
  backface-visibility: hidden;
  -moz-osx-font-smoothing: grayscale;
  position: relative;
  -webkit-transition-property: color;
  transition-property: color;
  -webkit-transition-duration: 0.3s;
  transition-duration: 0.3s;
}
.hvr-sweep-to-right .report-label{
    font-weight: bold;
    margin-top: 10px;
    float: left;
}
.hvr-sweep-to-right:before {
  content: "";
  position: absolute;
  z-index: -1;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: #2098d1;
  -webkit-transform: scaleX(0);
  transform: scaleX(0);
  -webkit-transform-origin: 0 50%;
  transform-origin: 0 50%;
  -webkit-transition-property: transform;
  transition-property: transform;
  -webkit-transition-duration: 0.3s;
  transition-duration: 0.3s;
  -webkit-transition-timing-function: ease-out;
  transition-timing-function: ease-out;
}
.hvr-sweep-to-right:hover, .hvr-sweep-to-right:focus, .hvr-sweep-to-right:active {
  color: white;
}
.hvr-sweep-to-right:hover:before, .hvr-sweep-to-right:focus:before, .hvr-sweep-to-right:active:before {
  -webkit-transform: scaleX(1);
  transform: scaleX(1);
}
</style>

<?php
  $current_month = (int)date("m");
  $last_month = ($current_month == '1') ? '12' : $current_month - 1;
?>
<div class="submenu">
        <h3 class="nav-tab-wrapper">
            <div class="nav-tab tab-report <?php echo (!isset($_GET['sp'])) ? 'active' : ''; ?>"><a href="?p=reports">Year</a></div>
            <div class="nav-tab tab-report <?php echo (isset($_GET['sp']) && $_GET['sp'] == 'l') ? 'active' : ''; ?>"><a href="?p=reports&sp=l">Last Month</a></div>
            <div class="nav-tab tab-report <?php echo (isset($_GET['sp']) && $_GET['sp'] == 'm') ? 'active' : ''; ?>"><a href="?p=reports&sp=m">This Month</a></div>
            <div class="nav-tab tab-report <?php echo (isset($_GET['sp']) && $_GET['sp'] == 'd') ? 'active' : ''; ?>"><a href="?p=reports&sp=d">Last 7 Days</a></div>
            <div class="nav-tab <?php (isset($_GET['sp']) && $_GET['sp'] == 'c') ? 'active' : ''; ?>" style="padding: 10.5px 14px;"><form action="billing.php?p=reports&sp=c" method="POST"> Custom: <input type="hidden" name="do" value="custom"/><input type="date" name="from_date" value="<?php echo (isset($_POST['from_date'])) ? $_POST['from_date'] : '';?>" placeholder="From"/> &nbsp;&nbsp;&nbsp; <input type="date" name="to_date" value="<?php echo (isset($_POST['to_date'])) ? $_POST['to_date'] : '';?>" placeholder="To"/> &nbsp;&nbsp;&nbsp; <input type="submit" name"go" value="go"/></form></div>
        </h3>
    </div>

<div class="box">

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    
    <script type="text/javascript">
$(function () {
    $('#report-container').highcharts({
        chart: {
            zoomType: 'xy',
            marginBottom: 120,
            marginRight: 20 
        },
        title: {
            text: ''
        },
        subtitle: {
            text: ''
        },
        xAxis: [{
            categories: ['<?php echo implode("', '",$arrMonths); ?>'],
            crosshair: true
        }],
        yAxis: [{ // Primary yAxis
            labels: {
                format: '{value}°C',
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
                format: '{value} mm',
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
            enabled: true,
            floating: true,
            verticalAlign: 'bottom',
            align: 'left',
            y: 10,
            backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#666666'
        },
        series: [{
            name: 'Total Registrations',
            type: 'column',
            yAxis: 1,
            data: [<?php echo implode(",",$arrMembers); ?>],
            tooltip: {
                valueSuffix: ' member(s)'
            },
            color: {
                radialGradient: { cx: 0.5, cy: 0.5, r: 0.5 },
                stops: [
                   [0, '#dbe0e3'],
                   [1, '#dbe0e3']
                ]
            }

        }
        <?php
        
        $k = -1;

        foreach ($arrPackagenName as $key => $package_name) {

        $k = $k + 1;

        ?>
        ,{
            name: '<?php echo $package_name ?>',
            type: 'spline',
            data: [<?php echo implode(", ", $arrPackageCount[$key]); ?>],
            color: {
                radialGradient: { cx: 0.5, cy: 0.5, r: 0.5 },
                stops: [
                   [0, '<?php echo $colors[$k]; ?>'],
                   [1, '<?php echo $colors[$k]; ?>']
                ]
            }
        }
        <?php 
        }
        ?>
]
    });
});


    </script>
  
<script src="inc/js/highcharts.js"></script>
<script src="inc/js//exporting.js"></script>
<?php

$earning = array();

foreach ($custom_reports['earning'] as $currency => $amount) {
  
    $earning[] = $currency ." ". number_format(array_sum($custom_reports['earning'][$currency]));

}

?>
<div class="report-left-sidebar">
    
        <div class="box-content">
            <div class="report-field hvr-sweep-to-right" style="border-right:4px solid #aed2e8;">
                <span class="report-amount"><?php echo implode(" + ", $earning)." "; ?></span>
                <span class="report-label">Total Earning</span>
            </div>
            <div class="report-field hvr-sweep-to-right" style="border-right:4px solid #d8e0e2;">
                <span class="report-amount"><?php echo number_format(array_sum($custom_reports['members']));?></span>
                <span class="report-label">Total Subscriptions</span>
            </div>
            <?php /*<div class="report-field hvr-sweep-to-right" style="border-right:4px solid #d8e0e2;">
                <span class="report-amount">218</span>
                <span class="report-label">Total Recurring Subscriptions</span>
            </div>
            <div class="report-field hvr-sweep-to-right" style="border-right:4px solid #2994d8;">
                <span class="report-amount">$295.00</span>
                <span class="report-label">Total Refunds</span>
            </div>*/?>
            <div class="report-field hvr-sweep-to-right" style="border-right:4px solid #e74433;">
                <span class="report-amount"><?php echo implode(" , ", array_unique($custom_reports['currency']))." ";echo $custom_reports['affiliates'];?></span>
                <span class="report-label">Total Affiliate Earning</span>
            </div>

        </div>
    
</div>
<div id="report-container" style="width: 80%; height: 520px; float:left;"></div>

</div>


<?php }

elseif($_REQUEST['p'] == "packaccess"){ 
 
	$i=1;

	$result = $DB->Query("SELECT pid, name FROM package WHERE icon !='SMS' ORDER BY pid");
    while( $package = $DB->NextRow($result) )
    {
		$PACKARRAY[$i]['id'] 	=	$package['pid'];
		$PACKARRAY[$i]['name'] 	=	$package['name'];
		$i++;
	}

?>

 

<br class="clear">

<?php if(is_array($PACKARRAY)){ ?>

<form action="billing.php" method="post" name="profile" >
<input name="do" type="hidden" value="updatepageaccess" id="do" class="hidden">
<input name="p" type="hidden" value="packaccess" class="hidden">

<input name="packageIDS" type="hidden" value="<?	foreach($PACKARRAY as $pValue){ print $pValue['id'].",";	  } ?>  ">
<div class="box_body manage-access overflow_scroll" style="font-size:100%;width:100%; overflow:auto;">


<ul class="manage-access_res" style="width:100%"  border="0" style="border:0px;">


<li class="tbl-head-manage-access">
	
		<div class="manage-access-title">Feature</div>  
		<?	 foreach($PACKARRAY as $pValue){	  ?>
			<div class="package-title"> <?php /*<img src="inc/images/16x16/75.png" alt="<?=$pValue['name'] ?>" align="absmiddle">*/?> <?=$pValue['name'];//substr($pValue['name'],0,10) ?></div>
		<?php } ?>                  
	
</li>

<?


 $i=1;

 foreach($PAGE_ARRAY as  $PAGENAME => $TOP_MENU){
	 
 	$inner=1;
	if (is_array($TOP_MENU) || is_object($TOP_MENU)){
	foreach( $TOP_MENU as $key => $value){ 
 
		if(substr($key,-1,1) !="?" && substr($key,1,3) !="dll" && ( $key !="view" && $key !="" && $key !="inbox" && $key !="sent" && $key !="trash" && $key !="manage"  && $key !="albums" && $key !="password" && $key !="cancel"  && $key !="taken" && $key !="test") && $value !=""){ ## hide value if its a help value 

		if($inner==1){ $InnerSymbol="";/*$InnerSymbol="<img src='inc/images/icons/flag_blue.png'>";*/ }else{ $InnerSymbol="";/*$InnerSymbol="&nbsp;&nbsp;&nbsp;&nbsp;";*//*$InnerSymbol="&nbsp;&nbsp;&nbsp;&nbsp;<img src='inc/images/icons/resultset_next.png'>";*/ }
 
?>
  <li class="tbl-body-manage-access" style="background-color:<?php if($i % 2){ print "#ffffff";}else{ print "#eeeeee";} ?>"> 
    <div class="manage-access-title" style="width:120px;border:0px;">
      <?=$InnerSymbol." ".$TOP_MENU[$key] ?>
    </div> 
    <?php /*<td class="manage-access-title" bgcolor="<?php if($i % 2){ print "#ffffff";}else{ print "#eeeeee";} ?>" style="width:120px;border:0px;"><table width="200" border="0" style="border:0px;">

      <tr>
        <td>
          <?php //$InnerSymbol." ".$TOP_MENU[$key] ?>
          <?=$InnerSymbol." ".$TOP_MENU[$key] ?>
        </td>
      </tr>
    </table>
</td> */?>

		<?  if (is_array($PACKARRAY) || is_object($PACKARRAY)){
			foreach($PACKARRAY as $pValue){	 


		$PackageString="";
	 	$PackageString = $PAGENAME."-".$key; 

		if(isset($PACKAGEACCESS[$pValue['id']])){
		if(is_array($PACKAGEACCESS[$pValue['id']]) && in_array($PackageString,$PACKAGEACCESS[$pValue['id']])){ $CheckME="checked"; }else{$CheckME=""; }
		}
 ?>

			<div class="package-name" align="center"><input name="<?=$pValue['id'] ?>_<?=$i ?>" type="checkbox" value="1" <?=$CheckME ?>></div>

		<?php }
		}
		 ?>
  <input type="hidden" name="key_<?=$i ?>" value="<?=$PAGENAME ?>">
  <input type="hidden" name="value_<?=$i ?>" value="<?=$key ?>">
  </li>

<?
		$i++; 
		$inner++;
		} 

	} 
	}
}
?>

</ul>


</div>
<br class="clear">
<div class="bar_save">
<input name="TotalOps" type="hidden" value="<?=$i ?>">
<input type="submit" value="<?=$admin_button_val[8] ?>" class="MainBtn">
</div>
</form>
<?php } ?> 
 



<?php }elseif($_REQUEST['p'] == "affbilling"){ ?>

<div class="bar_save button_save_syle">
<input type="button" value="<?=$admin_billing[25] ?>" class="NormBtn" onClick="javascript:location.href='?p=affbilling'"/>
<input type="button" value="<?=$admin_billing[26] ?>" class="NormBtn" onClick="javascript:location.href='?p=affbilling&z=1'"/>
<input type="button" value="<?=$admin_billing[27] ?>" class="NormBtn" onClick="javascript:location.href='?p=affbilling&z=2'"/>
<br class="clear">
</div>
<br class="clear">

		<?php if(!isset($_REQUEST['z'])){ ?>
		<p><b class="text-font"><?=$admin_billing[25] ?></b></p>
		<form action="billing.php" method="post" name="profile" onSubmit="return CheckMemberForm();">
		<input name="do" type="hidden" value="none" id="do" class="hidden">
		<input name="p" type="hidden" value="affbilling" class="hidden">
        <div class="overflow_div">
<div class="scroll_div2">
        
		<table class="widefat">
		<thead>
		 <tr> 
			<th></th>
		   <th><?=$admin_table_val[8] ?></th>
		   <th><?=$admin_table_val[30] ?></th>
		   <th><?=$admin_table_val[1] ?></th>
		   <th><?=$admin_table_val[31] ?></th>
		   <th><?=$admin_table_val[32] ?></th>
		  </tr>
		</thead>
		<tbody>
		 <?php $totalnum=displayPending(); ?>
		 </tbody>
		</table>
        
        </div>
        </div>
		<input name="NumRows" type='hidden' class='hidden' value='<?=$totalnum ?>'>
		<br class="clear">
		<div class="bar_save">
		<input type="button" value="<?=$admin_button_val[1] ?>" class="NormBtn" onClick="ca(<?=$totalnum ?>)"/>
		<input type="button" value="<?=$admin_button_val[2] ?>" class="NormBtn"  onClick="ua(<?=$totalnum ?>)"/> -
		<input type="button" value="<?=$admin_button_val[5] ?>" class="MainBtn"  onclick="ChangeOption('affpaydelete');"/> - 

		</div>

<br class="clear">
		<div class="bar_save">
		<input type="button" value="Approve Payment" class="MainBtn"  onclick="ChangeOption('affpayapprove');"/> -
		<input type="button" value="Reject Payment" class="MainBtn"  onclick="ChangeOption('affpayreject');"/>
</div>
		</form>
		
		
		<?php }elseif($_REQUEST['z'] == "1"){ ?>
		
		<p><b><?=$admin_billing[26] ?></b></p>
		<form action="billing.php" method="post" name="profile" onSubmit="return CheckMemberForm();">
		<input name="do" type="hidden" value="none" id="do" class="hidden">
		<input name="p" type="hidden" value="affbilling" class="hidden">
		
		<table class="widefat">                
		<thead>                  
		<tr>                    
		 <th></th>
		   <th><?=$admin_table_val[8] ?></th>
		   <th><?=$admin_table_val[30] ?></th>
		   <th><?=$admin_table_val[1] ?></th>
		   <th><?=$admin_table_val[31] ?></th>
		</tr>                
		</thead>                
		<tbody>                  
		  <?php $totalnum=displayActive(); ?>                
		</tbody>
		</table>
		<input name="NumRows" type='hidden' class='hidden' value='<?=$totalnum ?>'>
		<br class="clear">
		<div class="bar_save">
		<input type="button" value="<?=$admin_button_val[1] ?>" class="NormBtn" onClick="ca(<?=$totalnum ?>)"/>
		<input type="button" value="<?=$admin_button_val[2] ?>" class="NormBtn"  onClick="ua(<?=$totalnum ?>)"/> -
		<input type="button" value="<?=$admin_button_val[5] ?>" class="MainBtn"  onclick="ChangeOption('affpaydelete');"/> - 
		<input type="button" value="Reject Payment" class="MainBtn"  onclick="ChangeOption('affpayreject');"/>
		</div>
		</form>
		
		
		<?php }elseif($_REQUEST['z'] == "2"){ ?>
		
		<p><b><?=$admin_billing[27] ?></b></p>	  
		<form action="billing.php" method="post" name="profile" onSubmit="return CheckMemberForm();">
		<input name="do" type="hidden" value="none" id="do" class="hidden">
		<input name="p" type="hidden" value="affbilling" class="hidden">
		
		<table class="widefat">                
		<thead>                  
		<tr>                    
		 <th></th>
		   <th><?=$admin_table_val[8] ?></th>
		   <th><?=$admin_table_val[30] ?></th>
		   <th><?=$admin_table_val[1] ?></th>
		   <th><?=$admin_table_val[31] ?></th>

		</tr>                
		</thead>                
		<tbody>                  
		  <?php $totalnum=displayCanceled(); ?>                
		</tbody>
		</table>
		<input name="NumRows" type='hidden' class='hidden' value='<?=$totalnum ?>'>
		<br class="clear">
		<div class="bar_save">
		<input type="button" value="<?=$admin_button_val[1] ?>" class="NormBtn" onClick="ca(<?=$totalnum ?>)"/>
		<input type="button" value="<?=$admin_button_val[2] ?>" class="NormBtn"  onClick="ua(<?=$totalnum ?>)"/> -
		<input type="button" value="<?=$admin_button_val[5] ?>" class="MainBtn"  onclick="ChangeOption('affpaydelete');"/> - 
		<input type="button" value="Approve Payment" class="MainBtn"  onclick="ChangeOption('affpayapprove');"/>
		</div>
		</form>
		<?php } ?>
<br class="clear">




<?php }elseif($_REQUEST['p'] == "billing"){ ?>



<div id="TableViewer"></div>

 


<?php }elseif($_REQUEST['p'] == "code"){ ?>

<div class="bar_save">

<input type="button" value="<?=$admin_billing[1] ?>" class="NormBtn" onClick="javascript:location.href='?p=epackage'"/>
<input type="button" value="<?=$admin_billing[2] ?>" class="NormBtn" onClick="javascript:location.href='?p=packaccess'"/>
<input type="button" value="<?=$admin_billing[3] ?>" class="NormBtn" onClick="javascript:location.href='?p=upall'"/>
 
<br class="clear">

</div>

<br class="clear">

<?=DisplayCode($_REQUEST['id'])?>


<?php }elseif($_REQUEST['p'] == "editbill"){ ?>

<form name="form1" method="post" action="billing.php">
<input name="do" type="hidden" value="upbill" class="hidden">
<input name="p" type="hidden" value="billing" class="hidden">
<input name="eid" type="hidden" value="<?=$_REQUEST['id'] ?>" class="hidden">
<?php if(isset($_REQUEST['id'])){ $data = BillItems($_REQUEST['id']); }  ?>
<ul class="form"><div class="box_body">
<li><label>Membership Package: </label> <select class="input" name="pid" ><?=DisplayPackage($data['packageid']) ?></select></li>
<li><label>Member ID: </label> <input name="b0" type="text" size="40" maxlength="255" value="<?=$data['uid'] ?>"></li>
<li><label>Date Upgraded: </label> <input name="b1" type="text" size="40" maxlength="255" value="<?=$data['date_upgrade'] ?>"></li>
<li><label>Date Expires: </label> <input name="b2" type="text" size="40" maxlength="255" value="<?=$data['date_expire'] ?>"></li>
<li><label>Payment Method: </label> <input name="b3" type="text" size="40" maxlength="255" value="<?=$data['pay_method'] ?>"></li>
<li><label>Billing Email: </label> <input name="b4" type="text" size="40" maxlength="255" value="<?=$data['bill_email'] ?>"></li>
<li><label>Transaction Id: </label> <input name="b5" type="text" size="40" maxlength="255" value="<?=$data['transaction_id'] ?>"></li>
<li><label>Subscription: </label> <select class="input" name="b6">
<option value="yes" <?php if($data['subscription'] =="yes"){ print "selected";} ?>><?=$admin_selection[1] ?></option>
<option value="no" <?php if($data['subscription'] =="no"){ print "selected";} ?>><?=$admin_selection[2] ?></option>
</select></li>
<li><label>Still Active: </label> <select class="input" name="b7">
<option value="yes" <?php if($data['running'] =="yes"){ print "selected";} ?>><?=$admin_selection[1] ?></option>
<option value="no" <?php if($data['running'] =="no"){ print "selected";} ?>><?=$admin_selection[2] ?></option>
</select></li>
<li><input name="Input" type="submit" value="<?=$admin_button_val[8] ?>" class="MainBtn"></li>
</div></ul>
</form>
<?php } ?>