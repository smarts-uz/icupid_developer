<?php
if(isset($_GET['detail']) && $_GET['detail'] == "beneficiery"){

if(isset($_POST['do']) && $_POST['do'] == 'beneficiary_update'){

    GLOBAL $DB;

    $beneficiary_count =  $DB->Row("SELECT COUNT(user_id) AS users FROM wld_user_beneficiary WHERE user_id = '".$_POST['customer_id']."'");

    if(isset($beneficiary_count['users']) && $beneficiary_count['users'] > 0){
        
        $DB->Update("UPDATE wld_user_beneficiary SET
            minimum_payout = '".$_POST['minimum_payout']."',
            payment_currency = '".$_POST['payment_currency']."',
            payment_method = '".$_POST['payment_method']."',
            beneficiary_name = '".$_POST['beneficiary_name']."',
            beneficiary_company_reg_number = '".$_POST['b_company_reg_no']."',
            beneficiary_vat_number = '".$_POST['b_vat_num']."',
            beneficiary_country = '".$_POST['beneficiary_country']."',
            beneficiary_region = '".$_POST['beneficiary_region']."',
            beneficiary_city = '".$_POST['beneficiary_city']."',
            beneficiary_address = '".$_POST['beneficiary_address']."' WHERE user_id = '".$_POST['customer_id']."'");

    }
    else{
        
        $DB->Update("INSERT INTO wld_user_beneficiary
            (user_id,
            minimum_payout,
            payment_currency,
            payment_method,
            beneficiary_name,
            beneficiary_company_reg_number,
            beneficiary_vat_number,
            beneficiary_country,
            beneficiary_region,
            beneficiary_city,
            beneficiary_address) 
            VALUES('".$_POST['customer_id']."',
            '".$_POST['minimum_payout']."',
            '".$_POST['payment_currency']."',
            '".$_POST['payment_method']."',
            '".$_POST['beneficiary_name']."',
            '".$_POST['b_company_reg_no']."',
            '".$_POST['b_vat_num']."',
            '".$_POST['beneficiary_country']."',
            '".$_POST['beneficiary_region']."',
            '".$_POST['beneficiary_city']."',
            '".$_POST['beneficiary_address']."')");
    
    }

    if(isset($_FILES['photo']['name']) && $_FILES['photo']['name'] != ""){
        $beneficiary_folder = $_SERVER['DOCUMENT_ROOT']."/uploads/wld/beneficiary";
        
        if(!file_exists($beneficiary_folder)){

            mkdir($beneficiary_folder, 0755, true);
        
        }

        $arr_ext = explode(".", $_FILES['photo']['name']);

        $extension = $arr_ext[sizeof($arr_ext)-1];

        $file_name = 'BENE_'.date("YmdHis").'.'.$extension;

        move_uploaded_file($_FILES['photo']['tmp_name'], $beneficiary_folder.'/'.$file_name);
        
        $DB->Update("INSERT INTO wld_user_beneficiary_files
                (user_id,
                file,
                created_at) 
                VALUES('".$_POST['customer_id']."',
                '".$file_name."',
                '".date("Y-m-d H:i:s")."')");
    }
    echo '<div id="messages" class="wld-success-message">Beneficiary information updated Successfully.</div>';


}

if(isset($_REQUEST['del_doc_id']) && $_REQUEST['del_doc_id'] != ""){

    $beneficiary_file = $DB->Row("SELECT * FROM wld_user_beneficiary_files WHERE id = '".$_REQUEST['del_doc_id']."'");

    $beneficiary_folder = $_SERVER['DOCUMENT_ROOT']."/uploads/wld/beneficiary";

    if(isset($beneficiary_file['file'])){

        $file_name = $beneficiary_file['file'];

        $DB->Update("DELETE FROM wld_user_beneficiary_files WHERE id = '".$_REQUEST['del_doc_id']."'");

       unlink($beneficiary_folder.'/'.$file_name);
    
       echo '<div id="messages" class="wld-success-message">Beneficiary Document Deleted Successfully.</div>';

    }
    
}
?>

<?php $id = (isset($_GET['eedit_id'])) ? $_GET['eedit_id'] : ''; ?>
<form method="post" action="" name="MemberSearch" id="MemberSearch">
	<input name="customer_id" type="hidden" value="<?=$id ?>" class="hidden">
	<input name="do" type="hidden" value="beneficiary_update" class="hidden">
	<?php
	
	GLOBAL $DB;

	$beneficiary_details =  $DB->Row("SELECT * FROM wld_user_beneficiary WHERE user_id = '$id'");
	$beneficiary_files =  $DB->Query("SELECT * FROM wld_user_beneficiary_files WHERE user_id = '$id'");

	if(isset($beneficiary_details['minimum_payout']) && $beneficiary_details['minimum_payout'] != ""){

	}
	else{

    $beneficiary_details['minimum_payout'] = 50;
    $beneficiary_details['payment_currency'] = 'USD';
    $beneficiary_details['payment_method'] = 'paypal';
    $beneficiary_details['beneficiary_name'] = "";
    $beneficiary_details['beneficiary_company_reg_number'] = "";
    $beneficiary_details['beneficiary_vat_number'] = "";
    $beneficiary_details['b_vat_num'] = "";
    $beneficiary_details['beneficiary_country'] = "";
    $beneficiary_details['beneficiary_region'] = "";
    $beneficiary_details['beneficiary_city'] = "";
    $beneficiary_details['beneficiary_address'] = "";

	}
	?>


	<div class="boxx1">
		<a href="javascript:void(0);" onClick="idShowHide('Div1'); return false;"><img src="inc/images/icons/resultset_next.png" align="absmiddle"> <b> Beneficiary's Wallet </b> </a>
	</div>

	<div id="Div1" style="display:none;">

		<ul class="form">
			<div class="box_body">
				<li>
					<label style="width:200px;"><b> Minimum Payout: </b></label>
					
					<select name="minimum_payout" class="input">
                        <option value="50" <?php echo ($beneficiary_details['minimum_payout'] == 50) ? 'selected' : '';?> >50</option>
                        <option value="100" <?php echo ($beneficiary_details['minimum_payout'] == 100) ? 'selected' : '';?> >100</option>
                        <option value="150" <?php echo ($beneficiary_details['minimum_payout'] == 150) ? 'selected' : '';?> >150</option>
                        <option value="200" <?php echo ($beneficiary_details['minimum_payout'] == 200) ? 'selected' : '';?> >200</option>
                        <option value="300" <?php echo ($beneficiary_details['minimum_payout'] == 300) ? 'selected' : '';?> >300</option>
                        <option value="400" <?php echo ($beneficiary_details['minimum_payout'] == 400) ? 'selected' : '';?> >400</option>
                        <option value="500" <?php echo ($beneficiary_details['minimum_payout'] == 500) ? 'selected' : '';?> >500</option>
                        <option value="700" <?php echo ($beneficiary_details['minimum_payout'] == 700) ? 'selected' : '';?> >700</option>
                        <option value="1000" <?php echo ($beneficiary_details['minimum_payout'] == 1000) ? 'selected' : '';?> >1000</option>
                        <option value="1500" <?php echo ($beneficiary_details['minimum_payout'] == 1500) ? 'selected' : '';?> >1500</option>
                        <option value="2000" <?php echo ($beneficiary_details['minimum_payout'] == 2000) ? 'selected' : '';?> >2000</option>
                        <option value="2500" <?php echo ($beneficiary_details['minimum_payout'] == 2500) ? 'selected' : '';?> >2500</option>
                        <option value="3000" <?php echo ($beneficiary_details['minimum_payout'] == 3000) ? 'selected' : '';?> >3000</option>
                        <option value="5000" <?php echo ($beneficiary_details['minimum_payout'] == 5000) ? 'selected' : '';?> >5000</option>
                        <option value="7000" <?php echo ($beneficiary_details['minimum_payout'] == 7000) ? 'selected' : '';?> >7000</option>
                        <option value="10000" <?php echo ($beneficiary_details['minimum_payout'] == 10000) ? 'selected' : '';?> >10000</option>
                        <option value="15000" <?php echo ($beneficiary_details['minimum_payout'] == 15000) ? 'selected' : '';?> >15000</option>
                        <option value="20000" <?php echo ($beneficiary_details['minimum_payout'] == 20000) ? 'selected' : '';?> >20000</option>
                        <option value="25000" <?php echo ($beneficiary_details['minimum_payout'] == 25000) ? 'selected' : '';?> >25000</option>
                        <option value="50000" <?php echo ($beneficiary_details['minimum_payout'] == 50000) ? 'selected' : '';?> >50000</option>
                    </select>
				</li>
				<li>
					<label style="width:200px;">Payment Currency: </label>
					<select name="payment_currency" class="input">
                        <option value="GBP" <?php echo ($beneficiary_details['payment_currency'] == 'GBP') ? 'selected' : '';?> >GBP (Great British Pound)</option>
                        <option value="EUR" <?php echo ($beneficiary_details['payment_currency'] == 'EUR') ? 'selected' : '';?> >EUR (EURO)</option>
                        <option value="USD" <?php echo ($beneficiary_details['payment_currency'] == 'USD') ? 'selected' : '';?> >USD (United States Dollar)</option>             
                        <option value="YEN" <?php echo ($beneficiary_details['payment_currency'] == 'YEN') ? 'selected' : '';?> >YEN (Japanese Yen) </option> 
                        <option value="R" <?php echo ($beneficiary_details['payment_currency'] == 'R') ? 'selected' : '';?> >R (South African Rand Currency)</option>
                        <option value="ZL" <?php echo ($beneficiary_details['payment_currency'] == 'ZL') ? 'selected' : '';?> >ZL (Polish Currency)</option>    
                        <option value="RMB" <?php echo ($beneficiary_details['payment_currency'] == 'RMB') ? 'selected' : '';?> >RMB (Chinese Currency)</option>
                        <option value="HK" <?php echo ($beneficiary_details['payment_currency'] == 'HK') ? 'selected' : '';?> >HK (Hong Kong Currency)</option>
                        <option value="NOK" <?php echo ($beneficiary_details['payment_currency'] == 'NOK') ? 'selected' : '';?> >NOK (Norwegian Kroner)</option>
                        <option value="INR" <?php echo ($beneficiary_details['payment_currency'] == 'INR') ? 'selected' : '';?> >INR (Indian Rupees)</option>
                        <option value="AUD" <?php echo ($beneficiary_details['payment_currency'] == 'AUD') ? 'selected' : '';?> >AUD (Australian Dollar)</option>
                        <option value="CAD" <?php echo ($beneficiary_details['payment_currency'] == 'CAD') ? 'selected' : '';?> >CAD (Canadian Dollar)</option>
                        <option value="CHF" <?php echo ($beneficiary_details['payment_currency'] == 'CHF') ? 'selected' : '';?> >CHF (Swiss Franc)</option>
                        <option value="CZK" <?php echo ($beneficiary_details['payment_currency'] == 'CZK') ? 'selected' : '';?> >CZK (Czech Koruna)</option>
                        <option value="DKK" <?php echo ($beneficiary_details['payment_currency'] == 'DKK') ? 'selected' : '';?> >DKK (Danish Krone)</option>
                        <option value="HUF" <?php echo ($beneficiary_details['payment_currency'] == 'HUF') ? 'selected' : '';?> >HUF (Hungarian Forint)</option>
                        <option value="NZD" <?php echo ($beneficiary_details['payment_currency'] == 'NZD') ? 'selected' : '';?> >NZD (New Zealand Dollar)</option>
                        <option value="PLN" <?php echo ($beneficiary_details['payment_currency'] == 'PLN') ? 'selected' : '';?> >PLN (Polish Zloty)</option>
                        <option value="SEK" <?php echo ($beneficiary_details['payment_currency'] == 'SEK') ? 'selected' : '';?> >SEK (Swedish Krona)</option>
                        <option value="SGD" <?php echo ($beneficiary_details['payment_currency'] == 'SGD') ? 'selected' : '';?> >SGD (Singapore Dollar)</option>
                        <option value="BRL" <?php echo ($beneficiary_details['payment_currency'] == 'BRL') ? 'selected' : '';?> >BRL (Brazilian Real)</option>
                        <option value="TL" <?php echo ($beneficiary_details['payment_currency'] == 'TL') ? 'selected' : '';?> >TL</option>
                        <option value="THB" <?php echo ($beneficiary_details['payment_currency'] == 'THB') ? 'selected' : '';?> >THB (Thai Baht)</option>
                    </select>
				</li>
				<li>
					<label style="width:200px;">Payment Method: </label>
					<select name="payment_method" class="input">
                    	<option value="paypal" <?php echo ($beneficiary_details['payment_method'] == 'paypal') ? 'selected' : '';?> >By Paypal</option>
                        <option value="stripe" <?php echo ($beneficiary_details['payment_method'] == 'stripe') ? 'selected' : '';?> >By Stripe</option>
                        <option value="ccbill" <?php echo ($beneficiary_details['payment_method'] == 'ccbill') ? 'selected' : '';?> >By CCBill</option>
                	</select>
				</li>
				<li><input name="Input" type="submit" value="<?=$admin_button_val['8'] ?>"class="MainBtn"></li>
			</div>
		</ul>

	</div>

	<div class="boxx1">
		<a href="javascript:void(0);" onClick="idShowHide('Div2'); return false;"><img src="inc/images/icons/resultset_next.png" align="absmiddle"> <b> Beneficiary Information: </b> </a>
	</div>

	<div id="Div2" style="display:none;">

		<ul class="form">
			<div class="box_body">
				<li>
					<label style="width:200px;">Beneficiary Name: </label>
					<input type="text" name="beneficiary_name" value="<?=$beneficiary_details['beneficiary_name'];?>" class="input">
				</li>
				<li>
					<label>Beneficiary company registration number (if applicable): </label>
					<input class="input" type="text" name="b_company_reg_no" value="<?=$beneficiary_details['beneficiary_company_reg_number'];?>">
				</li>
				<li>
					<label>Beneficiary VAT number (if applicable): </label>
					<input class="input" type="text" name="b_vat_num" value="<?=$beneficiary_details['beneficiary_vat_number'];?>"/>
				</li>


				<?php 
                $countries = $DB->query("SELECT fvid, fvFid, fvCaption FROM field_list_value WHERE fvFid= '25' AND lang='english' ORDER BY fvCaption ASC");
                                
                $states = $DB->query("SELECT fvid, fvFid, fvCaption FROM field_list_value WHERE fvFid= '54' AND lang='english' ORDER BY fvCaption ASC");
                ?>
                <li>
	                <label>Beneficiary country:</label>
                    <select name="beneficiary_country" class="input" onchange="WLDMeetingLinkedField(this.value, 54 , 0);">
                        <option value="0" selected="">------------------</option>
                        <?php
                        while ($country = $DB->NextRow($countries)) { ?>
                            <option value="<?=$country['fvid']?>" <?php echo ($beneficiary_details['beneficiary_country'] == $country['fvid']) ? 'selected' : '';?> ><?=$country['fvCaption']?></option>
                        <?php } ?>
                    </select>
                </li>
               	<li id="country_states">
                    <label>Beneficiary region:</label>
                                    
                    <select name="beneficiary_region" class="input">
                        <option value="0" selected="">------------------</option>
                        <?php
                        while ($state = $DB->NextRow($states)) { ?>
                            <option value="<?=$state['fvid']?>" <?php echo ($beneficiary_details['beneficiary_region'] == $state['fvid']) ? 'selected' : '';?> ><?=$state['fvCaption']?></option>
                        <?php } ?>
                    </select>
                </li>

				<li>
					<label style="width:200px;">Beneficiary City: </label>
					<input type="text" name="beneficiary_city" class="input" value="<?=$beneficiary_details['beneficiary_city']?>"/>
				</li>
				<li>
					<label style="width:200px;">Beneficiary Address: </label>
					<textarea class="textarea-wallet" name="beneficiary_address" style="height: 60px;"><?=$beneficiary_details['beneficiary_address']?></textarea>
				</li>
				<li>
					<input name="Input" type="submit" class="MainBtn" value="<?=$admin_button_val['8'] ?>">
				</li>

			</div>
		</ul>

	</div>

	<div class="boxx1">
		<a href="javascript:void(0);" onClick="idShowHide('Div3'); return false;"><img src="inc/images/icons/resultset_next.png" align="absmiddle"> <b> Personal ID Document Scan/Photo: </b> </a>
	</div>

	<div id="Div3" style="display:none;">
 
		<ul class="form">
			<div class="box_body beneficiary_files">
				
				<?php
                while ($file = $DB->NextRow($beneficiary_files)) { ?>
                <li>
					<a href="<?=DB_DOMAIN?>uploads/wld/beneficiary/<?=$file['file']?>" target="_blank"><img src="<?=DB_DOMAIN?>uploads/wld/beneficiary/<?=$file['file']?>"/></a>
					<label><?=$file['upload_name']?> <span><?=$file['created_at']?></span></label>

                    <a class="delete-file" href="<?=DB_DOMAIN?>newadmin/wld.php?p=customers&detail=beneficiery&eedit_id=<?=$_REQUEST['eedit_id']?>&del_doc_id=<?=$file['id']?>" onclick="var conf=confirm('Do you really want to delete?'); return conf;">Delete</a>
				</li>
                <?php } ?>
				
			</div>
		</ul>
	
	</div>
</form>
	  
 <script type="text/javascript">

function WLDMeetingLinkedField(value, linkedID, searchPage){

    Timer_Icon('country_states');
    eMeetingDo('wld/ajax/_actions.php?action=CountryLinkedField&lid='+linkedID+'&value='+value+'&rownum='+searchPage,'country_states');
}

</script>

<?php 
}
else if(isset($_GET['eedit_id']) && $_GET['eedit_id'] != ""){
?>

<?

if(isset($_POST['do']) && $_POST['do'] == 'customer_update'){ 

	global $DB;

	$DB->Update("UPDATE wld_users SET username = '".$_POST['username']."',first_name = '".$_POST['first_name']."',last_name = '".$_POST['last_name']."',company_name = '".$_POST['company_name']."',address = '".$_POST['address']."',street = '".$_POST['street']."',city = '".$_POST['city']."',state = '".$_POST['state']."',postal_code = '".$_POST['postal_code']."',country = '".$_POST['country']."',phone = '".$_POST['phone']."',fax = '".$_POST['fax']."',email = '".$_POST['email']."',status = '".$_POST['status']."' WHERE wld_user_id = '".$_POST['uid']."'");

	if(isset($_POST['password']) && $_POST['password'] != ''){

		$DB->Update("UPDATE wld_users SET `password` = '".md5($_POST['password'])."' WHERE wld_user_id = '".$_POST['uid']."'");

	}
	echo '<div id="messages" class="wld-success-message">Customer\'s information has been updated successfully.</div>';;

}
?>

<style type="text/css">
	.boxx1 { border: 1px solid #cccccc; padding: 8px; font-weight: bold; margin-bottom: 15px; background: white; clear: both; }
	#dating_rebranded_admin ul.customer-info-edit li{ float: left; clear: none; width: 45%; display: inline; }
</style>

<form method="post" action="" name="MemberSearch" id="MemberSearch">
	<input name="uid" type="hidden" value="<?=$_GET['eedit_id'] ?>" class="hidden">
	<input name="do" type="hidden" value="customer_update" class="hidden">
	<?php
	$id = (isset($_GET['eedit_id'])) ? $_GET['eedit_id'] : '';
	$tM = WldGetCustomerEditDetails($id); ?>


	<div class="boxx1">
		<a href="javascript:void(0);" onClick="idShowHide('Div1'); return false;"><img src="inc/images/icons/resultset_next.png" align="absmiddle"> <b> Change Member's Username </b> </a>
	</div>

	<div id="Div1" style="display:none;">

		<ul class="form">
			<div class="box_body">
				<li>
					<label style="width:200px;"><?=$admin_table_val[1] ?>: </label>
					<div class="tip">It's not recommend to change a members username unless you must. The members username is also the same name the member will use to login and share their profile link with friends and family.</div>
					<input type="text" class="input" name="username" size="40" value="<?=$tM['username'] ?>">
				</li>
				<li><input name="Input" type="submit" value="<?=$admin_button_val['8'] ?>"class="MainBtn"></li>
			</div>
		</ul>

	</div>

	<div class="boxx1">
		<a href="javascript:void(0);" onClick="idShowHide('Div2'); return false;"><img src="inc/images/icons/resultset_next.png" align="absmiddle"> <b> Change Password & Email </b> </a>
	</div>

	<div id="Div2" style="display:none;">

		<ul class="form">
			<div class="box_body">
				<li>
					<label style="width:200px;"><?=$admin_login[8] ?>: </label>
					<input name="password" type="text" class="input" value="encrypted password" size="40" id="epassword" disabled>
					<div class="tip">
						<img src="inc/images/icons/help.png" align="absmiddle"> The software uses Md5 encryption on all member passwords to protect their privacy. You cannot read the password however you can change it.<br>
						<input name="epass" type="checkbox" value="1" onChange="ShowPass();" class="radio"> <b><?=$admin_members_extra[9] ?></b>
					</div>
				</li>
			</div>
		</ul>

		<ul class="form">
			<div class="box_body">
				<li>
					<label style="width:200px;"><?=$admin_login[3] ?>:</label><input name="email" type="text" class="input" value="<?=$tM['email'] ?>"size="40" style="height:30px;">
				</li>
				<li>
					<input name="Input" type="submit" value="<?=$admin_button_val['8'] ?>"class="MainBtn">
				</li>
			</div>
		</ul>
	</div>

	<div class="boxx1">
		<a href="javascript:void(0);" onClick="idShowHide('Div3'); return false;"><img src="inc/images/icons/resultset_next.png" align="absmiddle"> <b> Change Active Status </b> </a>
	</div>

	<div id="Div3" style="display:none;">
 
		<ul class="form">
			<div class="box_body">
				<li>
					<label><?=$admin_members_extra[8] ?>: </label>
					<select name="status" class="input">
						<option value="active" <?php if($tM['status'] == "active"){ print "selected"; } ?>>Active</option>
						<option value="inactive" <?php if($tM['status'] == "inactive"){ print "selected"; } ?>>Inactive</option>
					</select>
				</li>
				<li>
					<input name="Input" type="submit" value="<?=$admin_button_val['8'] ?>"class="MainBtn">
				</li>
			</div>
		</ul>
	</div>

	<div class="boxx1">
		<a href="javascript:void(0);" onClick="idShowHide('Div5'); return false;"><img src="inc/images/icons/resultset_next.png" align="absmiddle"> <b> Change SMS Alert Details </b> </a>
	</div>

	<div id="Div5" style="display:none;"> 

		<ul class="form">
			<div class="box_body">
				<li>
					<label style="width:200px;"><?=$admin_members_extra[6] ?>: </label><input name="phone" type="text" class="input" value="<?=$tM['phone'] ?>"size="40">
				</li>
				<li>
					<input name="Input" type="submit" value="<?=$admin_button_val['8'] ?>"class="MainBtn">
				</li>
			</div>
		</ul>
	</div>
 
	<div class="boxx1">
		<a href="javascript:void(0);" onClick="idShowHide('Div6'); return false;"><img src="inc/images/icons/resultset_next.png" align="absmiddle"> <b> Edit Profile </b> </a>
	</div>

	<div id="Div6" style="display:none;"> 

 		<script type="text/javascript" src="<?=subd ?>inc/js/_extras/_date.js"></script>
		<?php $id = (isset($_GET['eedit_id'])) ? $_GET['eedit_id'] : ''; ?>
		<?=WldEditCustomer($id) ?>
 		<input name="Input" type="submit" value="<?=$admin_button_val['8'] ?>" class="MainBtn">
</form>
	  
 
<?php 
}
else{
?>


<div class="page">
	
	<div class="content">
		<div class="block">	
	 		
			<?php echo getMarketSiteHtml("customers"); ?>
	 	
		</div>
		<div class="admin-note">
			<p id="TopCommentsBox"><img src="inc/images/icons/help.png" align="admin-note-text"> Listed below are all the current membership packages applied to your web site. The ones highlighted in green are required by the system to control how visitors and new members are handled giving you more control of your web site.</p>
		</div> 
	 	

	</div>

</div>
<br/>
<br/>
<div id="TableViewer" style="margin-top:10px;float:left;width: 100%;"></div>

<?php
}
?>
