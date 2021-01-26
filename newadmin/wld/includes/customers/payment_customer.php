<?php
if(isset($_POST['payment_type']) && $_POST['payment_type'] != ""){

    global $DB;

    $DB->Update("INSERT INTO wld_user_payment(user_id,payment,type,gateway,created_at) VALUES('".$_POST['customer_id']."','".$_POST['payment_amount']."','".$_POST['payment_type']."','".$_POST['gateway']."','".date("Y-m-d H:i:s")."')");

    switch ($_POST['payment_type']) {
        case 'cerdit':
            $msg = "Credited Successfully.";
        break;
        case 'debit':
            $msg = "Debited Successfully.";
        break;
    }
?>
<script> window.location.href="<?=DB_DOMAIN?>newadmin/wld.php?p=payment_customers&Err=<?=$msg?>**1"; </script>    

<?php
    
}

?>

<div class="page">
	
    <div class="content customer-payment-form">

        <form action="" method="POST">
         
            <input type="hidden" id="payment_type" name="payment_type" value="">
            <input type="hidden" id="customer_id" name="customer_id" value="">
            <ul class="form">
                <li><label>Customer</label><span class="customer-name">Member</span></li>
                <li><label>Type</label><span class="payment-type">Credit</span></li>
                <li><label>Gateway</label><span class="payment-gateway"></span>

                    <select class="input" name="gateway">
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
                <li><label>Enter Amount</label><input type="number" name="payment_amount" value="" placeholder="Please Enter Amount" class="payment-amount input"></li>
                <li><input type="submit" name="pay" value="Submit" class="MainBtn" /></li>
            </ul>
            
        </form> 

   </div>

    <div id="TableViewer" style="margin-top:10px;float:left;width: 100%;">
    
    <div class="div-payment-custoemr-table">
        <table border="0">
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Total Paid</th>
                    <th>Balance</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php

                $users = $DB->Query("SELECT distinct(ws.wld_user_id) AS user, GROUP_CONCAT(ws.wld_site_id) AS sites, wu.* FROM wld_sites AS ws INNER JOIN wld_users AS wu ON ws.wld_user_id = wu.wld_user_id GROUP BY ws.wld_user_id");

                
                while ($user = $DB->NextRow($users)) {

                $sites = explode(",", $user['sites']);

                //$balance = 0; 
                $total_earning = 0;
                foreach ($sites as $site) {

                    $site_detail = WLDGetSite($site);

                    if($site_detail['market'] != '0'){
                    $dbh = getMarketDBConnection($site_detail['market']);
                
                    $market_settings = getMarketSiteSearchMemberSettings($site_detail['market'], $site);

                    $market_commission = (int)$market_settings['market_commission'];

                    $query_earning = $dbh->prepare("SELECT SUM(p.price) AS total_earning ,GROUP_CONCAT(distinct(p.currency_code)) AS currency FROM members m INNER JOIN members_billing mb ON m.id = mb.uid INNER JOIN package p ON mb.packageid = p.pid WHERE m.site_id IN (".$site.")");

                    $query_earning->execute();

                    $earning = $query_earning->fetch();

                    $total_earning += (($market_commission/100)*$earning['total_earning']);

                    }
                }

                $payment = $DB->Row("SELECT SUM(IF(type = 'debit',payment, 0)) AS debit, SUM(IF(type = 'credit',payment, 0)) AS credit FROM wld_user_payment WHERE user_id = '".$user['wld_user_id']."'");
                $debit = (double)$payment['debit'];
                $credit = (double)$payment['credit'] + $total_earning;
                ?>
                <tr>
                    <td><?=$user['username']?></td>
                    <td>$<?=$debit?></td>
                    <td>$<?=$credit - $debit?></td>
                    <td>
                        <input type="button" value="Credit" onclick="paymentForm('<?=$user['user']?>','<?=$user['username']?>','credit');" class="MainBtn">  
                    </td>
                    <td>
                        <input type="button" value="Debit" onclick="paymentForm('<?=$user['user']?>','<?=$user['username']?>','debit');" class="MainBtn">
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>

        </table>
    </div>
    </div>

</div>

<script type="text/javascript">
    function paymentForm(id, customer_name, type){

        document.getElementById('payment_type').value = type;
        document.getElementById('customer_id').value = id;
        document.getElementsByClassName('customer-name')[0].innerHTML = customer_name;
        document.getElementsByClassName('payment-type')[0].innerHTML = type;
        document.getElementsByClassName('customer-payment-form')[0].style.display = 'block';

    }

</script>