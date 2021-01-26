<?php
	
	if(isset($_POST['do']) && $_POST['do'] == 'upbill'){

		$dbh = getMarketDBConnection($_POST['market_id']);


		$stmt = $dbh->prepare("UPDATE members_billing SET uid='".$_POST['b0']."', packageid='".$_POST['pid']."', 	date_upgrade='".$_POST['b1']."', 	date_expire='".$_POST['b2']."', 	pay_method='".$_POST['b3']."', 	running='".$_POST['b7']."', 	subscription='".$_POST['b6']."', 	bill_email='".$_POST['b4']."', 	transaction_id='".$_POST['b5']."' WHERE id='".$_POST['eid']."' LIMIT 1");

		$stmt->execute();

		echo '<div id="messages" class="wld-success-message">Payment details has been updated successfully.</div>';
	}
				
?>

<div class="page">
	<div class="content">
	<?php if(isset($_GET['sp']) && $_GET['sp'] == 'editbill') { ?>

	<form name="form1" method="post" action="">
		<input name="market_id" type="hidden" value="<?=$_REQUEST['market_id']?>" class="hidden">
		<input name="do" type="hidden" value="upbill" class="hidden">
		<input name="eid" type="hidden" value="<?=$_REQUEST['id'] ?>" class="hidden">
		<?php if(isset($_REQUEST['id'])){ $data = WLDBillItems($_REQUEST['market_id'], $_REQUEST['id']); }  ?>
		<ul class="form"><div class="box_body">
			<li><label>Membership Package: </label> <select class="input" name="pid" ><?=DisplayPackage($data['packageid']) ?></select></li>
			<li><label>Member ID: </label> <input name="b0" type="text" size="40" maxlength="255" value="<?=$data['uid'] ?>"></li>
			<li><label>Date Upgraded: </label> <input name="b1" type="text" size="40" maxlength="255" value="<?=$data['date_upgrade'] ?>"></li>
			<li><label>Date Expires: </label> <input name="b2" type="text" size="40" maxlength="255" value="<?=$data['date_expire'] ?>"></li>
			<li><label>Payment Method: </label> <input name="b3" type="text" size="40" maxlength="255" value="<?=$data['pay_method'] ?>"></li>
			<li><label>Billing Email: </label> <input name="b4" type="text" size="40" maxlength="255" value="<?=$data['bill_email'] ?>"></li>
			<li><label>Transaction Id: </label> <input name="b5" type="text" size="40" maxlength="255" value="<?=$data['transaction_id'] ?>"></li>
			<li><label>Subscription: </label>
				<select class="input" name="b6">
					<option value="yes" <?php if($data['subscription'] =="yes"){ print "selected";} ?>><?=$admin_selection[1] ?></option>
					<option value="no" <?php if($data['subscription'] =="no"){ print "selected";} ?>><?=$admin_selection[2] ?></option>
				</select>
			</li>
			<li>
				<label>Still Active: </label>
				<select class="input" name="b7">
					<option value="yes" <?php if($data['running'] =="yes"){ print "selected";} ?>><?=$admin_selection[1] ?></option>
					<option value="no" <?php if($data['running'] =="no"){ print "selected";} ?>><?=$admin_selection[2] ?></option>
				</select>
			</li>
			<li><input name="Input" type="submit" value="<?=$admin_button_val[8] ?>" class="MainBtn"></li>
		</div></ul>
	</form>
	<?php } else{ ?>
		<div class="block">	
			<?php echo getMarketSiteHtml("payments",'no'); ?>
		</div>
		<div class="box">
			<div class="box-content">
				<div id="contentcolumn" class="contentcolumndash">
					<div id="TableViewer"></div>
				</div>
				<br class="clear">
			</div>
		</div>
	<?php } ?>	
	<br class="clear">
	</div>
</div>