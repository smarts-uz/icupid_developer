
<?php if( ( !isset($_REQUEST['p']) || $_REQUEST['p']=="" ) ||  $_REQUEST['p'] == "banned" || $_REQUEST['p'] == "files"){ ?>
 
<?php if( isset($_REQUEST['p']) && $_REQUEST['p'] !="" ){ 
    ?>
     
     <style>
        .block-btn{
         display: none !important;
        }
    </style>

<?php
}
?>

 
<div id="TableViewer"></div>
 

<?php  }

elseif($_REQUEST['p'] == "reports"){ ?>


<form method="post" action="billing.php" name="form1">
<input type="hidden" value="packages" name="p" class="hidden">
<input type="hidden" value="add" name="do" class="hidden">
<input type="hidden" name="ispace" value="" class="hidden">
<input type="hidden" name="StopConfigStrip" value="1" class="hidden">

<div class="submenu">
        <h3 class="nav-tab-wrapper">
            <div class="nav-tab tab-report <?php echo (!isset($_REQUEST['submenu']) || (isset($_REQUEST['submenu']) && $_REQUEST['submenu'] == 'site_settings')) ? 'active' : ''; ?>">Year</div>
            <div class="nav-tab tab-report <?php echo (isset($_REQUEST['submenu']) && $_REQUEST['submenu'] == 'search_settings') ? 'active' : ''; ?>">Last Month</div>
            <div class="nav-tab tab-report <?php echo (isset($_REQUEST['submenu']) && $_REQUEST['submenu'] == 'membership_settings') ? 'active' : ''; ?>">This Month</div>
            <div class="nav-tab tab-report <?php echo (isset($_REQUEST['submenu']) && ($_REQUEST['submenu'] == 'membership_packages' || $_REQUEST['submenu'] == 'add_package')) ? 'active' : ''; ?>">Last 7 Days</div>
            <div class="nav-tab <?php echo (isset($_REQUEST['submenu']) && $_REQUEST['submenu'] == 'manage_access') ? 'active' : ''; ?>" style="padding: 10.5px 14px;">Custom: <input type="date" name="from" value="" placeholder="From"/> &nbsp;&nbsp;&nbsp; <input type="date" name="to" value="" placeholder="To"/> &nbsp;&nbsp;&nbsp; <input type="button" name"go" value="go"/></div>
        </h3>
    </div>

<div class="box">

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    
    <script type="text/javascript">
$(function () {
    $('#report-container').highcharts({
        chart: {
            zoomType: 'xy'
        },
        title: {
            text: ''
        },
        subtitle: {
            text: ''
        },
        xAxis: [{
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
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
            layout: 'vertical',
            align: 'left',
            x: 80,
            verticalAlign: 'top',
            y: 55,
            floating: true,
            backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#666666'
        },
        series: [{
            name: 'XYZ',
            type: 'column',
            yAxis: 1,
            data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4],
            tooltip: {
                valueSuffix: ' mm'
            },
            color: {
                radialGradient: { cx: 0.5, cy: 0.5, r: 0.5 },
                stops: [
                   [0, '#dbe0e3'],
                   [1, '#dbe0e3']
                ]
            }

        }, {
            name: 'XYZ 1',
            type: 'spline',
            data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6],
            tooltip: {
                valueSuffix: ' °C'
            },
            color: {
                radialGradient: { cx: 0.5, cy: 0.5, r: 0.5 },
                stops: [
                   [0, '#e74433'],
                   [1, '#e74433']
                ]
            }
            
        }, {
            name: 'XYZ 2',
            type: 'spline',
            data: [10.0, 5.9, 5.5, 7.5, 10.2, 13.5, 17.2, 20.5, 26.3, 10.3, 10.9, 17.6],
            tooltip: {
                valueSuffix: ' °C'
            },
            color: {
                radialGradient: { cx: 0.5, cy: 0.5, r: 0.5 },
                stops: [
                   [0, '#3598db'],
                   [1, '#3598db']
                ]
            }
        }, {
            name: 'XYZ 3',
            type: 'spline',
            data: [12.0, 8.9, 7.5, 7.5, 12.2, 15.5, 19.2, 22.5, 28.3, 12.3, 12.9, 19.6],
            tooltip: {
                valueSuffix: ' °C'
            },
            color: {
                radialGradient: { cx: 0.5, cy: 0.5, r: 0.5 },
                stops: [
                   [0, '#b1d4ea'],
                   [1, '#b1d4ea']
                ]
            }
        }]
    });
});


    </script>
  
<script src="inc/js/highcharts.js"></script>
<script src="inc/js//exporting.js"></script>

<div class="report-left-sidebar">
    
        <div class="box-content">
            <div class="report-field" style="border-right:4px solid #aed2e8;">
                <span class="report-amount">$35,755.00</span>
                <span class="report-label">Total Earning</span>
            </div>
            <div class="report-field" style="border-right:4px solid #aed2e8;">
                <span class="report-amount">$295.50</span>
                <span class="report-label">Total Admin Earning</span>
            </div>
            <div class="report-field" style="border-right:4px solid #2994d8;">
                <span class="report-amount">$35,755.00</span>
                <span class="report-label">Total Customers Earning</span>
            </div>
            <div class="report-field" style="border-right:4px solid #2994d8;">
                <span class="report-amount">$295.00</span>
                <span class="report-label">Total Refunds</span>
            </div>
            <div class="report-field" style="border-right:4px solid #d8e0e2;">
                <span class="report-amount">128</span>
                <span class="report-label">Total Subscriptions</span>
            </div>
            <div class="report-field" style="border-right:4px solid #ebeff0;">
                <span class="report-amount">136</span>
                <span class="report-label">Total Chargebacks</span>
            </div>
            <div class="report-field" style="border-right:4px solid #e74433;">
                <span class="report-amount">$378.00</span>
                <span class="report-label">Total Affiliate Earning</span>
            </div>

        </div>
    
</div>
<div id="report-container" style="width: 80%; height: 475px; float:left;"></div>

</div>
</form>

<?php }

elseif($_REQUEST['p'] == "affiliate" || $_REQUEST['p'] == "affban"){ ?>



<div class="bar_save">
<input type="button" value="<?=$admin_members[10] ?>" class="NormBtn" onClick="javascript:location.href='?p=addaff'"/>
<input type="button" value="<?=$admin_members[12] ?>" class="NormBtn" onClick="javascript:location.href='?p=affsettings'"/>
<br class="clear">
</div>

<div id="TableViewer"></div>
 

 

<?php }elseif($_REQUEST['p'] == "edit"){ ?>

<?

if(isset($_GET['updated'])){ 

print '<div id="messages">
        <div class="message-good" id="main-message-good">
              <a class="dismiss-message" href="#" onclick="Effect.Fade(\'main-message-good\', { duration : 0.5 });; return false;"></a>
            Member Account Updated Successfully
    </div></div>';
}
 
?>

<style>
.boxx1 { border:1px solid #cccccc; padding:8px; font-weight:bold; margin-bottom:15px; background:white;}
</style>

<form method="post" action="members.php" name="MemberSearch" id="MemberSearch">
<input name="uid" type="hidden" value="<?=$_REQUEST['id'] ?>" class="hidden">
<input name="do" type="hidden" value="edit" class="hidden">
<input type="hidden" name="hightlight" value="off">
<?php 
$id = (isset($_GET['id'])) ? $_GET['id'] : '';
$tM = GetEditDetails($id); ?>



<div class="boxx1"><a href="javascript:void(0);" onClick="idShowHide('Div1'); return false;"><img src="inc/images/icons/resultset_next.png" align="absmiddle"> <b> Change Member's Username </b> </a> </div>

<div id="Div1" style="display:none;">

    <ul class="form"><div class="box_body">
    <li><label style="width:200px;"><?=$admin_table_val[1] ?>: </label>
    <div class="tip">It's not recommend to change a members username unless you must. The members username is also the same name the member will use to login and share their profile link with friends and family.</div>
    <input type="text" class="input" name="uname" size="40" value="<?=$tM['username'] ?>"></li>
    <li><input name="Input" type="submit" value="<?=$admin_button_val['8'] ?>"class="MainBtn"></li>
    </div></ul>

</div>

<div class="boxx1"><a href="javascript:void(0);" onClick="idShowHide('Div2'); return false;"><img src="inc/images/icons/resultset_next.png" align="absmiddle"> <b> Change Password & Email </b> </a> </div>

<div id="Div2" style="display:none;">

    <ul class="form"><div class="box_body">
    <li><label style="width:200px;"><?=$admin_login[8] ?>: </label><input name="upass" type="text" class="input" value="encrypted password" size="40" id="epassword" disabled><div class="tip"> <img src="inc/images/icons/help.png" align="absmiddle"> The software uses Md5 encryption on all member passwords to protect their privacy. You cannot read the password however you can change it.<br>
    <input name="epass" type="checkbox" value="1" onChange="ShowPass();" class="radio"> <b><?=$admin_members_extra[9] ?></b></div></li>
    </div></ul><ul class="form"><div class="box_body">
    <li><label style="width:200px;"><?=$admin_login[3] ?>:</label><input name="uemail" type="text" class="input" value="<?=$tM['email'] ?>"size="40" style="height:30px;"></li>
    <li><input name="Input" type="submit" value="<?=$admin_button_val['8'] ?>"class="MainBtn"></li>
    </div></ul>

</div>


<div class="boxx1"><a href="javascript:void(0);" onClick="idShowHide('Div3'); return false;"><img src="inc/images/icons/resultset_next.png" align="absmiddle"> <b> Change Active Status </b> </a> </div>

<div id="Div3" style="display:none;">
 
    <ul class="form"><div class="box_body">
                    
    <li><label><?=$admin_members_extra[8] ?>: </label>
    <select name="acc_status" class="input">
    <option value="active" <?php if($tM['active'] =="active"){ print "selected"; } ?>>Active</option>
    <option value="suspended" <?php if($tM['active'] =="suspended"){ print "selected"; } ?>>Suspended</option>
    <option value="unapproved" <?php if($tM['active'] =="unapproved"){ print "selected"; } ?>>Unapproved</option>
    <option value="cancel" <?php if($tM['active'] =="cancel"){ print "selected"; } ?>>Cancel Account</option>
    </select>
    </li>
    <li><input name="Input" type="submit" value="<?=$admin_button_val['8'] ?>"class="MainBtn"></li>
    </div></ul>

</div>


<div class="boxx1"><a href="javascript:void(0);" onClick="idShowHide('Div4'); return false;"><img src="inc/images/icons/resultset_next.png" align="absmiddle"> <b> Change Membership Package </b> </a> </div>

<div id="Div4" style="display:none;"> 
 
    <ul class="form"><div class="box_body">     
    <li><label style="width:200px;"><?=$admin_members_extra[3] ?>:</label><select name="pid" onChange="ShowUp();" style="width:200px;" class="input"><?=DisplayPackage($tM['packageid']) ?></select><li>   
    <input name="upgradeEmail" id="upgradeEmail" type="checkbox" value="1" class="radio" disabled><?=$admin_members_extra[4] ?> <br>
    <input name="upgradeBill" id="upgradeBill" type="checkbox" value="1" class="radio" disabled><?=$admin_members_extra[5] ?>                
    <li><input name="Input" type="submit" value="<?=$admin_button_val['8'] ?>"class="MainBtn"></li>
    </div></ul>

</div>


<div class="boxx1"><a href="javascript:void(0);" onClick="idShowHide('Div5'); return false;"><img src="inc/images/icons/resultset_next.png" align="absmiddle"> <b> Change SMS Alert Details </b> </a> </div>

<div id="Div5" style="display:none;"> 

    <ul class="form"><div class="box_body">
    <li><label style="width:200px;"><?=$admin_members_extra[6] ?>: </label><input name="smsN" type="text" class="input" value="<?=$tM['SMS_number'] ?>"size="40"></li>
    <li><label style="width:200px;"><?=$admin_members_extra[7] ?>: </label><input name="smsC" type="text" class="input" value="<?=$tM['SMS_credits'] ?>"size="40"></li>
    <li><input name="Input" type="submit" value="<?=$admin_button_val['8'] ?>"class="MainBtn"></li>
    </div></ul>

</div>
 


<div class="boxx1"><a href="javascript:void(0);" onClick="idShowHide('Div6'); return false;"><img src="inc/images/icons/resultset_next.png" align="absmiddle"> <b> Edit Profile </b> </a> </div>

<div id="Div6" style="display:none;"> 

 
    <script type="text/javascript" src="<?=subd ?>inc/js/_extras/_date.js"></script>
        

    <?php $id = (isset($_GET['id'])) ? $_GET['id'] : ''; ?>
    <?=EditMember($id) ?>
 
 
<input name="Input" type="submit" value="<?=$admin_button_val['8'] ?>"class="MainBtn">
</form>
      
 
<?php  }elseif($_REQUEST['p'] == "addaff"){ ?>


<form method="post" action="members.php">
<input name="p" type="hidden" value="affiliate" class="hidden">
<input name="do" type="hidden" value="addaff">
<?php if(isset($_REQUEST['id'])){ ?>
<?php $adata = GetAffiliateData($_REQUEST['id']); ?>
<input name="eid" type="hidden" value="<?=$_REQUEST['id']?>">
<?php } ?>
<ul class="form"><div class="box_body">                 
<li><label><?=$admin_members['a5'] ?></label>
<div class="tip">This is the username used to login to the affiliate account.</div>
<input name="j1" type="text" class="input" size="28" value="<?php if(isset($adata)){ print $adata['username']; } ?>"></li>
<li><label><?=$admin_members['a6'] ?></label>
<div class="tip">This is the password used to login to the affiliate account.</div>
<input name="j2" type="text" class="input" size="28" value="<?php if(isset($adata)){ print $adata['password']; } ?>"></li>

</div></ul><ul class="form"><div class="box_body">  
<li><label><?=$admin_members['a7'] ?></label><input name="j3" type="text" class="input" size="28" value="<?php if(isset($adata)){ print $adata['firstname']; } ?>"></li>
<li><label><?=$admin_members['a8'] ?></label><input name="j4" type="text" class="input" size="28" value="<?php if(isset($adata)){ print $adata['lastname']; } ?>"></li>
<li><label><?=$admin_members['a9'] ?></label><input name="j5" type="text" class="input" size="28" value="<?php if(isset($adata)){ print $adata['businessname']; } ?>"></li>
<li><label><?=$admin_members['a10'] ?></label><input name="j6" type="text" class="input" size="28" value="<?php if(isset($adata)){ print $adata['address']; } ?>"></li>
<li><label><?=$admin_members['a11'] ?></label><input name="j7" type="text" class="input" size="28" value="<?php if(isset($adata)){ print $adata['street']; } ?>"></li>
<li><label><?=$admin_members['a12'] ?></label><input name="j8" type="text" class="input" size="28" value="<?php if(isset($adata)){ print $adata['town_city']; } ?>"></li>
<li><label><?=$admin_members['a13'] ?></label><input name="j9" type="text" class="input" size="28" value="<?php if(isset($adata)){ print $adata['state_county']; } ?>"></li>
<li><label><?=$admin_members['a14'] ?></label><input name="j10" type="text" class="input" size="28" value="<?php if(isset($adata)){ print $adata['zip_post']; } ?>"></li>
<li><label><?=$admin_members['a15'] ?></label><select name="j11" size="1" class="input"><?=DisplayCountries($adata['country']) ?></select></li>
<li><label><?=$admin_members['a16'] ?></label><input name="j12" type="text" class="input" size="28" value="<?php if(isset($adata)){ print $adata['telephone']; } ?>"></li>
<li><label><?=$admin_members['a17'] ?></label><input name="j13" type="text" class="input" size="28" value="<?php if(isset($adata)){ print $adata['fax']; } ?>"></li>
<li><label><?=$admin_members['a18'] ?></label><input name="j14" type="text" class="input" size="28" value="<?php if(isset($adata)){ print $adata['email']; } ?>"></li>
<li><label><?=$admin_members['a19'] ?></label><input name="j16" type="text" class="input" value="<?php if(isset($adata)){ print $adata['website']; }else{ ?>http://<?php } ?>" size="28"></li>
<li><label><?=$admin_members['a20'] ?></label><input name="j15" type="text" class="input" size="28" value="<?php if(isset($adata)){ print $adata['payment_to']; } ?>"></li>
<li><input type="submit" name="Submit2" value="<?=$admin_button_val['8'] ?>"class="MainBtn"></li>
</div></ul>
</form>
    



<?php  }elseif($_REQUEST['p'] == "affcom"){ ?>

<form method="post" action="members.php">
<input name="p" type="hidden" value="affcom" class="hidden">
<input name="do" type="hidden" value="com">
        <table class="widefat">
          <tr>
            <td width="137"><strong><?=$admin_table_val[15] ?></strong></td>
            <td width="155" align="right">
                <input name="commission" type="text" class="input" maxlength="3" value="<?=GetPages('commission') ?>">
            </td>
            <td width="22">%</td>
          </tr>
        </table>
        <br>    
<input type="submit" value="<?=$admin_button_val['8'] ?>"class="MainBtn">
</form>

<?php  }elseif($_REQUEST['p'] == "affsettings"){ ?>




<form method="post" action="members.php">
<input name="do" type="hidden" value="editaffiliatepage">
<input name="p" type="hidden" value="affsettings">
<ul class="form"><div class="box_body">
<li><label><?=$admin_members_extra[12] ?></label><textarea class="input" name="p1" cols="1" rows="10" id="p1" style="width:99%;height:300px; font-size:11px;"><?=GetPages('home');?></textarea></li>
<li><label><?=$admin_members_extra[13] ?></label><textarea class="input" name="p2" rows="10" id="p2" style="width:99%;height:300px; font-size:11px;"><?=GetPages('code');?></textarea></li>
<li><label><?=$admin_members_extra[14] ?></label><textarea class="input" name="p3" rows="10" id="p3" style="width:99%;height:300px; font-size:11px;"><?=GetPages('payment');?></textarea></li>
<li><label><?=$admin_members_extra[15] ?></label><textarea class="input" name="p4" rows="10" id="textarea" style="width:99%;height:300px; font-size:11px;"><?=GetPages('summary');?></textarea></li>
<li><label><?=$admin_members_extra[16] ?></label><textarea class="input" name="p5" rows="10" style="width:99%;height:300px; font-size:11px;"><?=GetPages('edit');?></textarea></li>
<li><input type="submit" value="<?=$admin_button_val['8'] ?>"class="MainBtn"></li>
</div></ul>              
</form>
              
<?php  }elseif($_REQUEST['p'] == "import"){/*

    if(isset($ComText)){ ?>

    <h2><?=$admin_pop_import[1] ?></h2>
    <h3><?=$ComText ?> <?=$admin_pop_import[2] ?></h3>
    <p><b>Hi <?=$_SESSION['admin_name'] ?></b> , <?=$ComText ?> <?=$admin_pop_import[3] ?> <?=$_POST['software'] ?> <?=$admin_pop_import[4] ?></p>
    <p></p>
    <?php if($_GET['software'] =="abledating"){ ?>
    <p>Abledating member photos are stored:   "/photos/" directory on your hosting account.</p>
    <?php }elseif($_GET['software'] =="aedating"){ ?>
    <p>AE Dating member photos are stored: "id_img" directory on your software install. </p>
    <?php }elseif($_GET['software'] =="webscribble"){ ?>
    <p>Webscribble member photos are stored: "/photos/" directory on your hosting account.</p>
    <?php } ?>
    <p class="highlight"><?=$admin_pop_import[5] ?><br>
    <br>
    <b>Upload Photo Thumbnails:</b> /uploads/thumbs/<br> 
    <b>Upload Photo Images: </b>/uploads/images/</p>

 
<?php }else{ ?>     

<div id="Loading_wait" style="display:none;">
<p></p>
<p style="font-size:15px;"><center>Loading Please Wait</center></p>
<p><center><img src="inc/images/loading.gif"></center></p>
</div>
<div id="do_load" style="display:visible">



<form action="members.php" method="post" enctype="multipart/form-data" name="form1" onSubmit="idShowHide('Loading_wait');idShowHide('do_load');">
<input name="p" type="hidden" value="import" class="hidden">
<input name="do" type="hidden" value="import" class="hidden">

<div id="type" style="display:visible;">
    <ul class="form"><div class="box_body"> 
    <li><label><?=$admin_members_extra[17] ?>: </label>
    <div class="tip">Please select the import method, are you transfering your members from another database or from a CSV File.</div>
    <select name="type" class="input" onchange="javascript:idShowHide(this.value);idShowHide('type'); return false;">
        <option value="0" selected>--------------</option>
        <option value="cvs">CVS File</option>
        <?php /*<option value="database">Database</option>*//*?>
    </select>
    </li>
    </div></ul>
</div>
<div id="cvs" style="display:none;">

    <ul class="form"><div class="box_body"> 
    <li><label>Select CVS File</label><input type="file" name="import" class="input"></li>
    <li><label>Column Selimiter</label><input name="del" type="text" class="input" value="," size="5"></li>
    <li><label>Enclosure</label><input name="enc" type="text" class="input" value="/" size="5"></li>
    <li><label>Column Headings</label><select  class="input" name="heading"><option value="Yes"><?=$admin_selection[1] ?></option><option value="No" selected><?=$admin_selection[2] ?></option></select></li>
    <li><label>Default Member Password</label><input name="dpass" type="text" class="input" value="password"></li>
    <li><input type="submit" value="<?=$admin_layout_nav['2e'] ?>"class="MainBtn"></li>
    </div></ul>

</div>

<div id="database" style="display:none;">

    <ul class="form"><div class="box_body">
    <li><label>Import Members From</label>
<div class="tip">Select the software provider you would like to transfer members from. Please check to ensure that the software version you are running is listed below.</div>
        <select name="software" style="width:300px;" class="input">
        <option value="emeeting6" selected>eMeeting Dating Software Version 6.0</option>
            <option value="boonex5">Boonex Dolphin 6.x (old builds / upgrades)</option>     
            <option value="boonex">Boonex Dolphin 6.1</option>
            <option value="webscribble">Webscribble</option>
            <option value="abledating24">AbleDating 2.4</option>
            <option value="abledating">AbleDating (earlier versions)</option>
            <option value="joomla">Joomla</option>
            <option value="vld">Vld Personals</option>
            <option value="wordpress">Wordpress (members and articles)</option>
            <option value="osdate">OSdate</option>
            <option value="aedating">AE Dating 4.1</option>
            <option value="ska">SKA Date</option>
            <option value="bestdatingscript">Best Dating Script</option>

        </select>
    </li>
    <li><label>MySQL DB Host</label><input class="input" tabindex='1' size='40' maxlength='255'  type='text' name='emeeting_dbhost' value='localhost'></li>
    <li><label>MySQL DB Name</label><input class="input" tabindex='2' size='40' maxlength='255'  type='text' name='emeeting_db' value='<?php  if(isset($_POST['emeeting_db'])){ print $_POST['emeeting_db']; }  ?>'></li>
    <li><label>MySQL DB User</label><input class="input" tabindex='3' size='40' maxlength='255'  type='text' name='emeeting_dbuser' value='<?php if(isset($_POST['emeeting_db'])){  echo $_POST['emeeting_dbuser'];}  ?>'></li>
    <li><label>MySQL DB Pass</label><input class="input" tabindex='4' size='40' maxlength='255'  type='text' name='emeeting_dbpass' value='<?php if(isset($_POST['emeeting_dbpass'])){ echo $_POST['emeeting_dbpass'];} ?>'></li>
    <li><label>Table Prefix</label><input class="input" tabindex='4' size='40' maxlength='255'  type='text' name='emeeting_prefix' value='<?php if(isset($_POST['emeeting_prefix'])){ echo $_POST['emeeting_prefix'];} ?>'><div class="tip"><img src="inc/images/icons/help.png" align="absmiddle"> Leave this blank if you dont have one or are unable what this is.</div></li>
    <li><input type="submit" value="<?=$admin_layout_nav['2e'] ?>"class="MainBtn"></li>
    </div></ul>

</div>



</form>
</div>
<?php }

*/}elseif($_REQUEST['p'] == "addfile"){ ?>

<form name="form1" enctype="multipart/form-data" method="post" action="members.php">
<input type="hidden" name='do' value="upload" class="hidden">
<input type="hidden" name='uploadNeed0' value="0" class="hidden">
<input type="hidden" name='p' value="addfile" class="hidden">
<input name="type" type="hidden" value="photo">

<ul class="form"><div class="box_body"> 
                       
<li><label><?=$admin_members[25] ?>:</label> <input name="uname" type="text" class="input" id="uname" style="font-size:12px; width:180px;">
</li>    

</div></ul>
    
    
 <ul class="form"><div class="box_body"> 

        <li><label><?=$admin_members[23] ?>:  </label>  <input name="uploadFile0" type="file" class="input" id="uploadFile0"></li>        
        <li><label><?=$admin_members[26] ?>:</label><input name="title" type="text" class="input" size="44" maxlength="255">        
        <li><label><?=$admin_members[27] ?>:</label> <textarea class="input" name="comment" cols="45" rows="5" style="height:60px;"></textarea>        
        <li><label><?=$admin_members[28] ?>:</label><input type="checkbox" name='default' value="1">        
        <li><input name="submit" type="submit"class="MainBtn" value="<?=$admin_button_val['8'] ?>">        
        </div></ul>
</form>
 

 


<?php  }elseif($_REQUEST['p'] == "monitor"){ ?>

<form action="members.php" method="get">
<input name="p" type="hidden" value="monitor" class="hidden">
<ul class="form"><div class="box_body">
<li><label><?=$lang_members_nn[1] ?> </label> <div class="tip">Enter a username in the space below and the system will detect all messages sent to and from this user allowing you to check for abuse or spam.</div><input name="user" type="text" class="input" value="" size="40"></li>
<li><input type="submit" value="<?=$admin_button_val[0] ?>"class="MainBtn"></li>
</div></ul>
</form>

<?php if(isset($_GET['user'])){ ?>
<br>
<form method="post" action="members.php" name="profile">
<input name="p" type="hidden" value="monitor" class="hidden">
<input type="hidden" name="do" value="none" id="do" class="hidden">
<table class="widefat">
<thead>
<tr>
    <th></th>
    <th>Username</th>
    <th>Chatting With </th>
    <th>Date / Time </th>
    <th>Status </th>
    
    <th></th>
</tr>
</thead>
<tbody>
 <?php $totalnum = DisplayMonitor($_GET['user']); ?>
 <?php if($totalnum ==1){ print $lang_members_nn[2]; } ?>
 </tbody>
</table> <?php if($totalnum > 1){ ?>
<input type="hidden" name="totalrows" value="<?=$totalnum ?>" class="hidden">
<br class="clear">
<div class="bar_save">
<input type="button" value="<?=$admin_button_val[1] ?>" class="NormBtn" onClick="ca(<?=$totalnum ?>)"/>
<input type="button" value="<?=$admin_button_val[2] ?>" class="NormBtn"  onClick="ua(<?=$totalnum ?>)"/> -
<input type="button" value="<?=$admin_button_val[5] ?>" class="NormBtn"  onclick="ChangeOption('delmonitor');"/>
</div> <?php } ?>
</form>
<?php } ?>


<?php  } 
elseif($_REQUEST['p'] == "mapprove"){
?>
<link rel="stylesheet" href="inc/zebra/profile-bootstrap.css" type="text/css">
<link rel="stylesheet" href="inc/zebra/bootstrap-select.css" type="text/css">
<link rel="stylesheet" href="inc/zebra/styles.css" type="text/css">
<link rel="stylesheet" href="inc/zebra/mediastyles.css" type="text/css">
<link rel="stylesheet" href="inc/zebra/responsivetabs.css" type="text/css">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" crossorigin="anonymous">
<style>
.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus{
    background: #1c1f22;
}
.userdata1 h3,.nav-tabs > li > a,.nav-tabs > li > a:hover,.text-blue2,.dl-custom1 dt,h1, h2, h3, h4, h5, h6,.titles-edit,.btn-circle-resp{
    color: #979797;

}
.btn-circle-resp{
    border-color:#1c1f22;   
}
@media (max-width: 770px)
{
.customze_menus li a 
{
    color: #979797!important;
}

.text_alignment
{
text-align:center   
}

.text_alignment .center-img img
{
margin:0 auto;  
}
.li-full-width li
{
    margin: 2px 0px;
    width:100%!important;
}
}
</style>
    <?php $memberData = getPendingApprovalMemberProfileDetails($_REQUEST['mid']); ?>
        
    <?php 
   /* echo "<pre>";
    print_r($memberData);
    echo "</pre>";*/
    ?>
    <div class="modal fade in" id="uploadPropic" tabindex="-1" role="dialog" aria-labelledby="uploadPropicLabel" style="display: none; padding-right: 17px;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="uploadPropicLabel">Upload Profile Picture</h4>
                </div>
                <form name="frmProfilepicUpload" id="frmProfilepicUpload" action="" method="post" enctype="multipart/form-data">
                    <div class="modal-body my-form">
                        <div class="row">
                            <div class="col-xs-4">
                                <?php
                                $memPhoto = getMemberPhoto($_REQUEST['mid'],'photo');
                                $albumID = getMemberAlbum($_REQUEST['mid']);
                                if($memPhoto['bigimage']):?>
                                <img src="<?php echo DB_DOMAIN;?>/inc/tb.php?src=<?php echo $memPhoto['bigimage']; ?>&x=96&y=96&uid=<?php echo $_REQUEST['mid']; ?>" class="img-responsive">
                                <?php else:?>
                                <img src="<?php echo DB_DOMAIN;?>/inc/tb.php?src=&x=96&y=96&uid=<?php echo $_REQUEST['mid']; ?>" class="img-responsive">
                                <?php endif; ?>
                            </div>
                            <div class="col-xs-8">
                                <div><input type="file" name="profilepic" id="profilepic">
                                    <p class="small margin-top-10">Please upload a headshot of yourself that is recent, well lit and ideally smiling!</p> 
                                    <p class="font-size-10"><strong><em>Images can be up to 2 MB and we accept jpeg, gif or png files.</em></strong></p>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="yespic"><span class="font-size-10 text-muted">Click here if you would like to submit this photo to be included in our Featured Members on the home page. Not all photos are approved for the Featured Members section. To be featured, you must have a clear, well-lit headshot of you, preferably smiling, with no sunglasses. If approved, your photo will remain in the rotation for the next 45 days.</span>
                                    </label>
                                </div>                        
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btnlogin" data-dismiss="modal" onclick="uploadProfilePhoto()">Upload Profile Pic</button>
                    </div>
                    <input type="hidden" name="imgid" value="<?php echo $memPhoto['id']?>" />
                    <input type="hidden" name="aid" value="<?php echo $albumID['aid']?>" />
                    <input type="hidden" name="uid" value="<?php echo $_GET['mid']?>" />
                    <input type="hidden" name="gmtdiff" value="<?php if(isset($memberData['gmt_diference'])) { echo $memberData['gmt_diference']; } ?>" /> 
                </form>
          
            </div>
        </div>
    </div>
    
    <div class="modal fade in" id="deletePropic" tabindex="-1" role="dialog" aria-labelledby="deletePropicLabel" style="display: none; padding-right: 17px;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="deletePropicLabel">Delete Profile Picture</h4>
            </div>
            <form name="fromprofilepicDelete" id="fromprofilepicDelete" action="" method="post">
                <div class="modal-body my-form">
                    <div class="row">
                        <div class="col-xs-12 text-center">
                            Are you sure you want to remove your current profile pic?   
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btnlogin" data-dismiss="modal" onclick="DeleteProfilePic()">Delete Profile Pic</button>
                </div>
                <input type="hidden" name="mid" value="<?php echo $_GET['mid']?>" />
                <input type="hidden" name="photoid" value="<?php echo $memPhoto['id'];?>" />
            </form>
          
            </div>
        </div>
    </div>
           
    <div id="divmaincontent" class="medit">
            
        <div class="row">
            <div class="col-md-3 col-sm-12">
                <div id="main-profile-pic"><div class="userdata1"><h3><?php echo $memberData['username']; ?></h3></div> 
                <div class="row">
                    <div class="col-xs-10 text-blue2" id="MPEditLabel_mytagline" style="display: block;"><?php if($memberData['headline']) { echo $memberData['headline'];} ?></div>
                    <div class="col-xs-2 MPEditButton_mytagline" style="display: block;"> 
                        <a class="btn btn-default btn-circle-edit" href="javascript:void(0)" role="button" onclick="MPEdit('mytagline')" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a>
                    </div>
                </div>
                <div class="row" id="MPEditContainer_mytagline" style="display: none;">
                    <div class="col-xs-9">
                        
                        <form name="frmtagline" id="frmtagline" method="post">
                            <input type="text" class="form-control" name="headline" value="<?php echo $memberData['headline'];?>" id="tagline" placeholder="Looking for my Soulmate">   
                            <input type="hidden" name="mid" value="<?php echo $_REQUEST['mid'];?>" />
                        </form> 
                    </div>
                    <div class="col-xs-3 padding-side-0 text-center MPSaveButton_mytagline" style="display:none;">
                        <a class="btn btn-default btn-circle-resp" href="javascript:void(0)" role="button" onclick="MPTagSave('mytagline')" title="Save"><i class="fa fa-check" aria-hidden="true"></i></a>
                        <a class="btn btn-default btn-circle-resp" href="javascript:void(0)" role="button" onclick="MPCancel('mytagline')" title="Cancel"><i class="fa fa-close" aria-hidden="true"></i></a>
                    </div>
                </div>
                        
                <div class="row margin-top-10">
                    <form>
                        <div class="col-xs-12">
                            <span class="small text-muted">Profile Visibility: &nbsp;<input type="radio" name="profilevisible" id="profilevisible" onClick="ChangeMemberYesNo('yes','<?php echo $_GET['mid'];?>','members.visible');" value="<?php echo $memberData['visible'];?>" <?php if($memberData['visible'] == 'yes'): echo "checked"; endif;?>> <span class="font-size-10">Visible</span>
                            <input type="radio" name="profilevisible" id="profilehidden" onClick="ChangeMemberYesNo('no','<?php echo $_GET['mid'];?>','members.visible');" value="<?php echo $memberData['visible'];?>" <?php if($memberData['visible'] != 'yes'): echo "checked"; endif;?>> <span class="font-size-10">Hidden</span>
                                </span>
                        </div>
                    </form>
                </div>
                         
                 <div class="margin-top-10">
                    <?php 
                    $memberPhoto = getMemberPhoto($_REQUEST['mid'],'photo');
                    if($memberPhoto['bigimage']):?>
                    <div><img src="<?php echo DB_DOMAIN;?>/inc/tb.php?src=<?php echo $memberPhoto['bigimage']; ?>&x=253&y=337&uid=<?php echo $_REQUEST['mid']; ?>" class="img-responsive thumbnail-image"></div>
                    <?php else:?>
                    <div><img src="<?php echo DB_DOMAIN;?>/inc/tb.php?src=&x=253&y=337&uid=<?php echo $_REQUEST['mid']; ?>" class="img-responsive thumbnail-image"></div>
                    <?php endif; ?>
                    <div class="margin-top-10"><a href="#" data-toggle="modal" data-target="#uploadPropic"><i class="fa fa-edit" aria-hidden="true"></i> Edit Profile Pic</a></div>
                        <div class="margin-top-10"><a href="#" data-toggle="modal" data-target="#deletePropic"><i class="fa fa-trash" aria-hidden="true"></i> Delete Profile Pic</a></div>
                    </div>
                    <div class="row margin-top-10" id="MPEditLabel_editasl">
                        <div class="col-xs-9 bold-darker">
                            <span><?php echo $memberData['location']?>,</span>
                            <?php
                                $mylocation = getBasicProfileInformation(2);
                                $my = array(25,54,28,20);
                                foreach($mylocation as $key => $mybvalue){
                                    $myfieldCaption = getFieldCaption($mybvalue['fid'],$mybvalue['fType']);
                                    $mymembersField = getPendingApprovalMemberColumns($mybvalue['fName'], $_REQUEST['mid']);
                                    $mymembersFieldValue = getMemberColumnsValue($mymembersField[0]);
                                    //print_r($mymembersField);
                                    if(in_array($mybvalue['fid'],$my)) {
                                        
                            ?>
                            
                            <span><?php echo $mymembersFieldValue[0];?>,</span>
                            <?php /*?><span><?php echo MakeAge($memberData['age']);?> - <?php echo $sex['fvCaption'];?> - <?php echo $sexual['fvCaption'];?></span><?php */?>
                            <?php } } ?>
                           <span> <?php echo MakeAge($memberData['age']);?></span>
                        </div>
                        <div class="col-xs-3 MPEditButton_editasl">
                            <a class="btn btn-default btn-circle-edit" href="javascript:void(0)" role="button" onclick="MPEdit('editasl')" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    
                    <div class="row margin-top-10" id="MPEditContainer_editasl" style="display:none;">
                        <div class="col-xs-6 text-left">
                            <h6>My Location</h6>
                        </div>
                        <div class="col-xs-6 text-right MPSaveButton_editasl">
                            <a class="btn btn-default btn-circle-resp" href="javascript:void(0)" role="button" onclick="MpSaveMyLocation('editasl')" title="Save"><i class="fa fa-check" aria-hidden="true"></i></a>

                            <a class="btn btn-default btn-circle-resp" href="javascript:void(0)" role="button" onclick="MPCancel('editasl')" title="Cancel"><i class="fa fa-close" aria-hidden="true"></i></a>
                        </div>
                        <div class="col-xs-12">
                            <div id="mylocation" style="display:none; font-weight:bold; color:#090;">Updated sucessfully!!!</div>
                            <form name="frmmylocation" id="frmmylocation" action="" method="post">
                                <input type="hidden" name="approval_edit" value="yes">
                                <div class="row">
                                    <label for="country" class="col-xs-12 label-edit-info">Country</label>
                                    <div class="col-xs-12">
                                        <?php echo getCountryState($memberData['country']); ?>
                                    </div>
                                    <label for="state" class="col-xs-12 margin-top-10 label-edit-info">State</label>
                                    <div class="col-xs-12">
                                        <div id="Link54">
                                            <a href="javascript:void(0);" onclick="eMeetingLinkedField(569, 54,0);">
                                            <?php 
                                            //$fieldCaption = getFieldCaption($bvalue['fid'],$bvalue['fType']);
                                            $state = getMemberColumnsValue($memberData['em_85820081128']);
                                            echo $state[0];
                                            ?> </a>
                                        </div>
                                               
                                    </div>
                                        
                                    <label for="City" class="col-xs-12 margin-top-10 label-edit-info">City</label>
                                    <div class="col-xs-12">
                                        <input type="text" class="form-control" id="location" name="location" value="<?php echo $memberData['location'];?>" placeholder="Sarah">
                                    </div>
                                    <div class="col-xs-12 text-left">
                                        <h6>Birthday, gender and orientation</h6>
                                    </div>
                                    <label class="col-xs-12 label-edit-info">My Birthday</label>
                                    <div class="col-xs-12">
                                    <?php
                                    $age = explode("-",$memberData['age']);
                                    ?>
                                    <select class="form-control" id="birthdayyear" name="birthdayyear">
                                        <option>Select Year</option>
                                        <?php   $firstYear = 1919;
                                        $lastYear = date('Y') - 18;
                                        for($i=$firstYear;$i<=$lastYear;$i++)
                                        {
                                            if($age[0] == $i):
                                            echo '<option value='.$i.' selected="selected">'.$i.'</option>';
                                            else:
                                            echo '<option value='.$i.'>'.$i.'</option>';
                                            endif;
                                        }?>
                                    </select>
                                    </div>
                                            <div class="col-xs-12 margin-top-10">
                                                <?php
                                                $months = array();
                                                $months = array(1 => 'JAN', 2 => 'FEB', 3 => 'MAR', 4 => 'APR', 5 => 'MAY', 6 => 'JUN', 7 => 'JUL', 8 => 'AUG', 9 => 'SEP', 10 => 'OCT', 11 => 'NOV', 12 => 'DEC');
                                                 ?>
                                                <select class="form-control" id="birthdaymonth" name="birthdaymonth">
                                                    <option>Select Month</option>
                                                    <?php foreach ($months as $num => $name) {
                                                            if($age[1] == $name):
                                                                $checked1 = 'selected="selected"';
                                                            else:
                                                                $checked1 = '';
                                                            endif;
                                                            
                                                            printf('<option value="%s" '.$checked1.'>%s</option>', $name, $name);
                                                            
                                                     } ?>
                                                </select>
                                            </div>
                                            <div class="col-xs-12 margin-top-10">
                                                <select class="form-control" id="birthdayday" name="birthdayday">
                                                    <option>Select Day</option>
                                                    <?php for($i=1; $i<=31; $i++){
                                                            if($age[2] == $i):
                                                                $checked2 = 'selected="selected"';
                                                            else:
                                                                $checked2 = '';
                                                            endif;
                                                            
                                                            echo '<option value='.$i.' '.$checked2.'>'.$i.'</option>';
                                                     } ?>
                                                </select>
                                            </div>
                                            <label for="gender" class="col-xs-12 margin-top-10 label-edit-info">My Gender</label>
                                            <div class="col-xs-12">
                                                <select class="form-control" id="gender" name="gender">
                                                    <?php echo DisplayProfileGender($memberData['gender']); ?>
                                                </select>
                                            </div>
                                            <label for="orientation" class="col-xs-12 margin-top-10 label-edit-info">My Orientation</label>
                                            <div class="col-xs-12">
                                                <select class="form-control" id="orientation" name="orientation">
                                                    <?php echo getProfileOrientation($memberData['em_8cx20070511']); ?>
                                                </select>
                                            </div>
                                            
                                        </div>
                                        <input type="hidden" name="mid" value="<?php echo $_REQUEST['mid'];?>" />
                                    </form>
                            </div>
                            <div class="col-xs-12 margin-top-10 text-right MPSaveButton_editasl">
                                 <a class="btn btn-default btn-circle-resp" href="javascript:void(0)" role="button" onclick="MpSaveMyLocation('editasl')" title="Save"><i class="fa fa-check" aria-hidden="true"></i></a>
                                                            <a class="btn btn-default btn-circle-resp" href="javascript:void(0)" role="button" onclick="MPCancel('editasl')" title="Cancel"><i class="fa fa-close" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                    
                </div>
                 <div class="col-md-9 col-sm-12"> 
                     <div class="row">
                        <div class="col-xs-12 margin-top-10">
                                
                            <?php

                            $groups = $DB->Query("SELECT id,caption FROM field_groups ORDER BY forder");
                            
                            ?>

                            <div role="tabpanel" data-example-id="togglable-tabs">
                            <ul class="nav nav-tabs centered li-full-width" role="tablist">
                                
                            <?php
                                $counter = 0;
                                while( $group = $DB->NextRow($groups) ){
                                $count_fields = getBasicProfileInformation($group['id']);

                                if(count($count_fields)){
                                    
                                ?>
                                <li role="presentation" <?php echo ($counter == 0) ? 'class="active"' : '';?>>
                                  <a href="#<?php echo preg_replace('/[^a-zA-Z0-9\']/', '-', strtolower($group['caption']));?>" id="<?php echo str_replace(" ", "-",strtolower($group['caption']));?>-tab" role="tab" data-toggle="tab" aria-controls="<?php echo strtolower($group['caption']);?>" aria-expanded="true">
                                    <span class="text"><?php echo $group['caption'];?></span>
                                  </a>
                                </li>
                                <?php
                                $counter++;
                                }
                            
                                }

                            ?>

                                <li role="presentation" class="">
                                  <a href="#photovideo" role="tab" id="photovideo-tab" data-toggle="tab" aria-controls="photovideo" aria-expanded="false">
                                    <span class="text">Media</span>
                                  </a>
                                </li>
                                
                              </ul>
      <div class="tab-content">



            <?php

            $groups = $DB->Query("SELECT id,caption FROM field_groups ORDER BY forder");
            
            $counter = 0;
            ?>

            
        
                
            <?php
                $counter = 0;
                while( $group = $DB->NextRow($groups) ){
                $userinfo = getBasicProfileInformation($group['id']);

                if(count($userinfo)){
                    
                ?>
                <div role="tabpanel" class="tab-pane fade <?php echo ($counter == 0) ? 'active': '';?> in" id="<?php echo preg_replace('/[^a-zA-Z0-9\']/', '-', strtolower($group['caption']));?>" aria-labelledby="<?php echo strtolower($group['caption']);?>-tab">
                <div class="row margin-top-10" id="MPEditLabel_<?php echo $group['id'];?>">
                    <div class="col-md-12 MPEditButton_<?php echo $group['id'];?> text-right">
                        <a class="btn btn-default btn-circle-edit" href="javascript:void(0)" role="button" onclick="MPEdit('<?php echo $group['id'];?>')" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a>
                    </div>
                    <div class="col-md-12">
                        <dl class="dl-horizontal dl-custom1">
                          
                          <?php
                            
                            foreach($userinfo as $key => $bvalue){
                                $fieldCaption = getFieldCaption($bvalue['fid'],$bvalue['fType']);
                                $membersField = getPendingApprovalMemberColumns($bvalue['fName'], $_REQUEST['mid']);
                                $mFieldValue = getfieldValue($bvalue['fid']); 
                                /*echo "<pre>";
                                print_r($membersField);
                                echo "</pre>";*/

                                $membersFieldValue = getMemberColumnsValue($membersField[0]);
                                
                                /*echo "<pre>";
                                print_r($membersFieldValue);
                                echo "</pre>";*/
                                
                                $multiVals = array();

                                if($bvalue['fType'] == 5){
                                

                                $mValues = explode("**",$membersField[0]);
                                
                                foreach($mFieldValue as $key => $mflvalue):
                                    if(isset($mValues[$key]) &&  $mValues[$key] == '1'):
                                        $multiVals[] = $mflvalue['fvCaption'];
                                    endif;
                                ?>
                                <?php endforeach; ?>






                                <div style="float:left; width:50%">
                                    <dt><?php echo $fieldCaption['caption']?>:</dt>
                                    <dd><?php echo implode(" , ",$multiVals);?></dd>
                                </div>
                                <?php 

                                }
                                /*else if($bvalue['fType'] == 7){
                                    if($fieldCaption['caption'] != '' && $membersField[0] != ''){
                                ?>
                                    <div style="float:left; width:50%"><dt><?php echo $fieldCaption['caption']?>:</dt><dd><?php echo $membersField[0]?></dd></div>
                                <?php        
                                    }
                                }*/
                                else if($bvalue['fType'] == 2){
                                    if($fieldCaption['caption'] != '' && $membersField[0] != ''){
                                ?>
                                    <div style="float:left; width:50%"><dt><?php echo $fieldCaption['caption']?>:</dt><dd><?php echo $membersField[0]?></dd></div>
                                <?php        
                                    }
                                }
                                else if($bvalue['fType'] == 1){
                                    if($fieldCaption['caption'] != '' && $membersField[0] != ''){
                                ?>
                                    <div style="float:left; width:50%"><dt><?php echo $fieldCaption['caption']?>:</dt><dd><?php echo $membersField[0]?></dd></div>
                                <?php        
                                    }
                                }
                                else{
                                
                                    if($fieldCaption['caption'] != '' && $membersFieldValue[0] != ''){?>
                                
                                        <div style="float:left; width:50%"><dt><?php echo $fieldCaption['caption']?>:</dt><dd><?php echo $membersFieldValue[0]?></dd></div>
                                  
                                    <?php
                                    }
                                }
                            } ?>
                          
                        </dl>
                     </div>
                </div>






                <div class="row margin-top-10" id="MPEditContainer_<?php echo $group['id'];?>" style="display:none;">
                    <div class="col-md-12 text-right margin-bottom-10 MPSaveButton_<?php echo $group['id'];?>">
                        <a class="btn btn-default btn-circle-resp" href="javascript:void(0)" role="button" onclick="MpSaveBasicProfileInfo('<?php echo $group['id'];?>')" title="Save"><i class="fa fa-check" aria-hidden="true"></i></a>
                                            <a class="btn btn-default btn-circle-resp" href="javascript:void(0)" role="button" onclick="MPCancel('<?php echo $group['id'];?>')" title="Cancel"><i class="fa fa-close" aria-hidden="true"></i></a>
                    </div>
                        <?php $editbasicinfo = getBasicProfileInformation($group['id']);// print_r($editbasicinfo);?>
                    <form class="join-form" name="frmBasicProfileInfo_<?=$group['id']?>" id="frmBasicProfileInfo_<?=$group['id']?>" method="post" action="">
                        <input type="hidden" name="approval_edit" value="yes">
                        <div id="basicinfo" style="display:none; color:#090; font-weight:bold;">Updates Sucessfully!!!</div>
                        <?php 

                        foreach($editbasicinfo as $key => $bvalue){
                                $fieldCaption = getFieldCaption($bvalue['fid'],$bvalue['fType']);
                                $membersField = getPendingApprovalMemberColumns($bvalue['fName'], $_REQUEST['mid']);
                                $membersFieldValue = getMemberColumnsValue($membersField[0]);
                                $mFieldValue = getfieldValue($bvalue['fid']);
                                //echo $fieldCaption['caption']."<br>";
                                //print_r($mFieldValue);
                                ?>
                                
                                <?php if($bvalue['fType'] == 5){ ?>
                                <div class="col-md-6">      
                                    <div class="row">
                                        <div class="col-md-12 titles-edit2"><?php echo $fieldCaption['caption'];?>:</div>
                                          <div class="col-md-12">
                                              <div class="row">
                                                  <div class="col-xs-12">
                                                  <?php 
                                                  $mValues = explode("**",$membersField[0]);
                                                  /*echo"<pre>";
                                                  print_r($mFieldValue);
                                                  echo "</pre>";*/
                                                  
                                                  foreach($mFieldValue as $key => $mflvalue):
                                                    if(isset($mValues[$key]) && $mValues[$key] == '1'):
                                                        $checked= 'checked';
                                                        else:
                                                        $checked = '';
                                                    endif;
                                                   ?>
                                                        
                                                    <div class="checkbox" style="width:45%; float:left;">
                                                  <label>
                                                    <input type="hidden" name="hid[<?php echo $bvalue['fName'];?>___<?php echo $key;?>]" value="<?php echo $mflvalue['fvid'];?>"/>
                                                    <input type="checkbox" name="chk[<?php echo $bvalue['fName'];?>___<?php echo $key;?>]" value="<?php echo $mflvalue['fvid'];?>" <?php echo $checked; ?>>
                                                    <?php echo $mflvalue['fvCaption'];?>
                                                  </label>
                                                </div>
                                                <?php endforeach; ?>
                                                  </div>
                                               </div>
                                          </div>
                                        </div>
                                    </div>
                                    <?php }
                                    else if($bvalue['fType'] == 7){
                                        /*if($fieldCaption['caption'] != '' && $membersField[0] != ''){
                                        ?>
                                        <div style="float:left; width:50%"><dt><?php echo $fieldCaption['caption']?>:</dt><dd><?php echo $membersField[0]?></dd></div>
                                        <?php
                                        }*/
                                    }
                                    else  if($bvalue['fType'] == 4){ ?>
                                <div class="col-md-6">      
                                    <div class="row">
                                        <div class="col-md-12 titles-edit2"><?php echo $fieldCaption['caption'];?>:</div>
                                          <div class="col-md-12">
                                              <div class="row">
                                                  <div class="col-xs-12">
                                                  <?php foreach($mFieldValue as $key => $mflvalue):
                                                    if($memberData[$bvalue['fName']] == $mflvalue['fvid']):
                                                        $checked= 'checked';
                                                        else:
                                                        $checked = '';
                                                    endif;
                                                   ?>
                                                        
                                                    <div class="checkbox" style="width:45%; float:left;">
                                                  <label>
                                                  
                                                    <input type="radio" name="<?php echo $bvalue['fName'];?>" value="<?php echo $mflvalue['fvid'];?>" <?php echo $checked; ?>>
                                                    <?php echo $mflvalue['fvCaption'];?>
                                                  </label>
                                                </div>
                                                <?php endforeach; ?>
                                                  </div>
                                               </div>
                                          </div>
                                        </div>
                                    </div>
                                    <?php } else if($bvalue['fType'] == 1){
                                    if($bvalue['fName'] != 'location'){
                                     ?>
                                    <div class="col-md-6">      
                                        <div class="row margin-top-10">
                                            <div class="col-md-4 titles-edit text-align-left-xs"><?php echo $fieldCaption['caption'];?>:</div>
                                            <div class="col-md-8">
                                                    <input type="text" name="<?php echo $bvalue['fName'];?>" class="form-control" value="<?php echo $membersField[0];?>" id="weight">
                                            </div>                    
                                        </div>
                                    </div>
                                    <?php } } else if($bvalue['fType'] == 2){ ?>
                                    <div class="col-md-12">      
                                        
                                        <div class="row margin-top-10">
                                            <div class="col-md-12 titles-edit text-align-left-xs" style="text-align:left;"><?php echo $fieldCaption['caption'];?>:</div>
                                            <br/>
                                            <br/>
                                            <div class="col-md-12">
                                                <textarea name="<?php echo $bvalue['fName'];?>" id="<?php echo $bvalue['fName'];?>" class="form-control ckeditor" id="weight"><?php echo $membersField[0];?></textarea>
                                            </div>
                                            <script>
                                                // Replace the <textarea id="editor1"> with a CKEditor
                                                // instance, using default configuration.
                                                CKEDITOR.replace( '<?php echo $bvalue['fName'];?>' );
                                            </script>
                                    </div>
                                    </div>
                                    <?php }elseif($bvalue['fName'] != 'em_85820081128' && $bvalue['fName'] != 'country'){ ?>
                                    <div class="col-md-6">      
                                        <div class="row margin-top-10">
                                            <div class="col-md-4 titles-edit text-align-left-xs"><?php echo $fieldCaption['caption'];?>:</div>
                                            <div class="col-md-8">
                                                    <select name="<?php echo $bvalue['fName'];?>" class="form-control" id="weight">
                                                    <option value="0">------------------</option>
                                                    <?php foreach($mFieldValue as $key => $mflvalue): 
                                                        if($membersFieldValue[0] == $mflvalue['fvCaption']):
                                                            $checked = 'selected="selected"';
                                                            else:
                                                            $checked = '';
                                                        endif;
                                                    ?>
                                                    <option value="<?php echo $mflvalue['fvid'];?>" <?php echo $checked; ?>><?php echo $mflvalue['fvCaption'];?></option>
                                                    <?php endforeach; ?> 
                                                 </select>
                                            </div>                    
                                        </div>
                                    </div>
                                    <?php } ?>
                                
                                   
                                  
                            <?php  } ?>
                        <input type="hidden" name="uid" value="<?php echo $_REQUEST['mid']?>" />
                    </form>
                    <div class="col-md-12 text-right margin-top-10 MPSaveButton_<?php echo $group['id'];?>">
                        <a class="btn btn-default btn-circle-resp" href="javascript:void(0)" role="button" onclick="MpSaveBasicProfileInfo('<?php echo $group['id'];?>')" title="Save"><i class="fa fa-check" aria-hidden="true"></i></a>
                                            <a class="btn btn-default btn-circle-resp" href="javascript:void(0)" role="button" onclick="MPCancel('<?php echo $group['id'];?>')" title="Cancel"><i class="fa fa-close" aria-hidden="true"></i></a>
                    </div>
                </div>









                </div>
                <?php
                $counter++;
                }
            
                }

            ?>








      <div role="tabpanel" class="tab-pane fade text_alignment" id="photovideo" aria-labelledby="photovideo-tab">
      <?php $photoGallery = getMemberMediaGalley($_REQUEST['mid'], 'photo'); ?>
      <?php $videoGallery = getMemberMediaGalley($_REQUEST['mid'], 'video'); ?>
      <h3>My Media</h3>
      <?php if(count($photoGallery) > 0):?>
    <h5>My photos </h5>
    <div class="row margin-top-10">
        <?php foreach($photoGallery as $photo):?>
      <a class="col-md-3 center-img" href="" data-lightbox="example-set" data-title="SF Bridge :)"><img class="img-responsive" src="<?php echo DB_DOMAIN;?>/inc/tb.php?src=<?php echo $photo['bigimage']; ?>&x=250&y=250&uid=<?php echo $_REQUEST['mid']; ?>" title="<?php echo $photo['title']; ?>" alt="<?php echo $photo['title']; ?>"></a>
      <?php endforeach; ?>
    </div>
    <?php else:?>
            <div class="col-xs-12 margin-auto">Photos not found!!!</div>
    <?php endif; ?>
    <h5>My Video</h5>
    <div class="row margin-top-10">
     <?php if(count($videoGallery) > 0):?>
            <?php foreach($videoGallery as $video):?>
                <div class="col-xs-12 margin-auto"><img src="img/novideo.jpg" class="img-responsive"></div>
                <?php endforeach; ?>
    <?php else:?>
            <div class="col-xs-12 margin-auto">Videos not found!!!</div>
    <?php endif; ?>
    </div>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="personalinfo" aria-labelledby="personalinfo-tab">
              <div class="row margin-top-10">
                <div class="col-xs-12">
                    <h3>My Personal Info</h3>   
                </div>
                
                
                <div class="col-xs-8 col-xs-offset-2">
                    <div id="successprofile" style="display:none; color:#090; font-weight:bold;">Profile Updates Sucessfully!!!</div>
                    <form name="frmprofileinfo" id="frmprofileinfo" class="form-horizontal join-form text-left" method="post" action="">
                            <?php
                            $personalInfo = getBasicProfileInformation(2);
                            $i = 0; 
                                foreach($personalInfo as $key => $mvalue){
                                    $fieldCaption = getFieldCaption($mvalue['fid'],$mvalue['fType']);
                                    $membersField = getPendingApprovalMemberColumns($mvalue['fName'], $_REQUEST['mid']);
                                    
                                    ?>
                                    <?php if($mvalue['fName'] == 'em_cxw20160112' || $mvalue['fName'] == 'em_p8p20160112' || $mvalue['fName'] == 'em_mu320160126'){?>
                                    <div class="form-group">
                                        <label for="name" class="col-sm-4 control-label"><?php echo $fieldCaption['caption'];?></label>
                                        <div class="col-sm-8">
                                        <input type="text" class="form-control" id="<?php echo $mvalue['fName'];?>" name="<?php echo $mvalue['fName'];?>" value="<?php echo $membersField[0];?>" placeholder="Sarah">
                                        </div>
                                    </div>
                                    <?php } $i++; } ?>
                    
                                
                              <div class="form-group">
                                <label for="inputEmail3" class="col-sm-4 control-label">Email</label>
                                <div class="col-sm-8">
                                  <input type="email" name="email" class="form-control" id="inputEmail3" value="<?php echo $memberData['email'];?>" placeholder="currentemail@something.com">
                                  <span class="font-size-10 text-muted">Please enter a working email address as this will be used to send password reminders and notifications of member correspondence and interest.</span>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-sm-4 control-label">Current Password</label>
                                <div class="col-sm-8" style="padding-top:7px;">
                                    1234xxxxx
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="enterpw" class="col-sm-4 control-label">New Password</label>
                                <div class="col-sm-8">
                                  <input type="password" name="password" class="form-control" id="enterpw">
                                  
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="inputPassword3" class="col-sm-4 control-label">Reenter New Password</label>
                                <div class="col-sm-8">
                                  <input type="password" name="repeat-password" class="form-control" id="inputPassword3">
                                  <span class="font-size-10 text-muted">New password will be saved only if you enter a new one and click save.</span>
                                </div>
                              </div>
                              
                              <div class="form-group">
                                <div class="col-sm-8 pull-right text-center">
                                  <button type="button" class="btn btn-default btnlogin" onclick="MpSaveProfileInfo()">SAVE CHANGES</button>
                                </div>
                              </div>
                              <input type="hidden" name="uid" value="<?php echo $_GET['mid'];?>"
                    </form>
                </div>
              </div>
              
           
       </div>
        <div role="tabpanel" class="tab-pane fade" id="cupid" aria-labelledby="cupid-tab">
              <div class="row margin-top-10" id="questions-answered">
                <div class="col-lg-7 col-md-4">
                    <h3 class="hmargin-top-0">My Questions</h3>
                </div>
                <!--<div class="col-lg-5 col-md-8 text-right">
                    <a class="btn btn-sm btn-primary" href="javascript:void(0)" onClick="HideOneShowTwo('questions-answered', 'questions-not-answered')">Answer More Questions</a>&nbsp;<a class="btn btn-sm btn-primary" href="javascript:void(0)" onClick="">Clear All Answers</a>
                </div>-->
                <div class="col-xs-12">
                    <div class="panel-group margin-top-10" id="compquestions" role="tablist" aria-multiselectable="true">
                        <div class="row">
                            <div class="col-md-12">
                            
                            <?php
                        $okQuestion = getBasicProfileInformation(15);
                        //echo "<pre>";
                        //print_r($okQuestion);
                        foreach($okQuestion as $key => $okmvalue){
                            
                            $okfieldCaption = getFieldCaption($okmvalue['fid'],$okmvalue['fType']);
                            $okmembersField = getPendingApprovalMemberColumns($okmvalue['fName'], $_REQUEST['mid']);
                            $okmembersFieldValue = getMemberColumnsValue($okmembersField[0]);
                            $okmFieldValue = getfieldValue($okmvalue['fid']);
                            //echo "<pre>";
                            //print_r($okmFieldValue);
                            
                            ?>
                                <div class="panel panel-default" style="float:left; width:48%; margin-left:10px;">
                            <div class="panel-heading" id="heading-compquestion<?php echo $okmvalue['fid']; ?>">
                        <h5 class="panel-title">
                            <a role="button" class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#compquestions" href="#collapse-compquestion<?php echo $okmvalue['fid']; ?>" aria-expanded="false" aria-controls="collapse-compquestion<?php echo $okmvalue['fid']; ?>"><?php echo $okfieldCaption['caption']; ?></a>
                        </h5>
                      </div>
                            <div id="collapse-compquestion<?php echo $okmvalue['fid']; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-compquestion<?php echo $okmvalue['fid']; ?>" aria-expanded="false" style="height: 0px;">
                                <div class="panel-body">
                        <form id="okquestion<?php echo $okmvalue['fid']; ?>" name="okquestion<?php echo $okmvalue['fid']; ?>" method="post" action="">
                            <div class="row">
                            <div class="col-xs-8 col-xs-offset-2">
                            <?php foreach($okmFieldValue as $okmflvalue): 
                                                if($okmflvalue['fvid'] == $memberData[$okmvalue['fName']]):
                                                    $checked = 'checked';
                                                    else:
                                                    $checked = '';
                                                endif;
                                                ?>
                                <div class="radio">
                                          <label>
                                            <input type="radio" name="<?php echo $okmvalue['fName'] ?>" id="<?php echo $okmvalue['fName'] ?>" value="<?php echo $okmflvalue['fvid'];?>" <?php echo $checked; ?>>
                                            <?php echo $okmflvalue['fvCaption'];?>
                                            <input type="hidden" name="okvalue" value="<?php echo $okmvalue['fName'] ?>" />
                                            <input type="hidden" name="uid" value="<?php echo $_GET['mid'] ?>" />
                                          </label>
                                        </div>
                                <?php endforeach; ?>
                            </div>
                                
                            <div class="col-xs-12 text-right margin-top-10"><a role="button" class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#compquestions" href="#collapse-compquestion<?php echo $okmvalue['fid']; ?>" aria-expanded="false" aria-controls="collapse-compquestion<?php echo $okmvalue['fid']; ?>" onclick="MpSaveOkQuestion('<?php echo $okmvalue['fid']; ?>')">Save Changes</a></div>
                        </div>
                        </form>
                      </div>
                            </div>
                          </div>  
                            <?php }?>    
                                
                            </div>
                            
                       </div>
                      </div>
                </div>
              </div>
 
        </div>
      </div>
    </div>
                             
                        </div>
                    </div>
                    
                    
                    
                </div>
            </div>
            
            
        </div>
        
        
        
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="inc/zebra/responsivetabs.js"></script>
<script src="inc/zebra/bootstrap.min.js"></script>
<script src="inc/zebra/bootstrap-select.min.js"></script>


<?php }
elseif($_REQUEST['p'] == "medit"){
    ?>
<link rel="stylesheet" href="inc/zebra/profile-bootstrap.css" type="text/css">
<link rel="stylesheet" href="inc/zebra/bootstrap-select.css" type="text/css">
<link rel="stylesheet" href="inc/zebra/styles.css" type="text/css">
<link rel="stylesheet" href="inc/zebra/mediastyles.css" type="text/css">
<link rel="stylesheet" href="inc/zebra/responsivetabs.css" type="text/css">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" crossorigin="anonymous">
<style>
.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus{
    background: #1c1f22;
}
.userdata1 h3,.nav-tabs > li > a,.nav-tabs > li > a:hover,.text-blue2,.dl-custom1 dt,h1, h2, h3, h4, h5, h6,.titles-edit,.btn-circle-resp{
    color: #979797;

}
.btn-circle-resp{
    border-color:#1c1f22;   
}
@media (max-width: 770px)
{
.customze_menus li a 
{
    color: #979797!important;
}

.text_alignment
{
text-align:center   
}

.text_alignment .center-img img
{
margin:0 auto;  
}
.li-full-width li
{
    margin: 2px 0px;
    width:100%!important;
}
}
</style>
    <?php $memberData = getEditMemberProfileDetails($_REQUEST['mid']); ?>
        
    <?php 
   /* echo "<pre>";
    print_r($memberData);
    echo "</pre>";*/
    ?>
    <div class="modal fade in" id="uploadPropic" tabindex="-1" role="dialog" aria-labelledby="uploadPropicLabel" style="display: none; padding-right: 17px;">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title" id="uploadPropicLabel">Upload Profile Picture</h4>
          </div>
          <form name="frmProfilepicUpload" id="frmProfilepicUpload" action="" method="post" enctype="multipart/form-data">
          <div class="modal-body my-form">
            <div class="row">
                <div class="col-xs-4">
                            <?php
                            $memPhoto = getMemberPhoto($_REQUEST['mid'],'photo');
                            $albumID = getMemberAlbum($_REQUEST['mid']);
                            if($memPhoto['bigimage']):?>
                            <img src="<?php echo DB_DOMAIN;?>/inc/tb.php?src=<?php echo $memPhoto['bigimage']; ?>&x=96&y=96&uid=<?php echo $_REQUEST['mid']; ?>" class="img-responsive">
                            <?php else:?>
                           <img src="<?php echo DB_DOMAIN;?>/inc/tb.php?src=&x=96&y=96&uid=<?php echo $_REQUEST['mid']; ?>" class="img-responsive">
                           <?php endif; ?>
                </div>
                <div class="col-xs-8">
                    <div><input type="file" name="profilepic" id="profilepic">
                                            <p class="small margin-top-10">Please upload a headshot of yourself that is recent, well lit and ideally smiling!</p> 
                                            <p class="font-size-10"><strong><em>Images can be up to 2 MB and we accept jpeg, gif or png files.</em></strong></p></div>
                    <div class="checkbox">
                                                <label>
                                                <input type="checkbox" id="yespic"><span class="font-size-10 text-muted">Click here if you would like to submit this photo to be included in our Featured Members on the home page. Not all photos are approved for the Featured Members section. To be featured, you must have a clear, well-lit headshot of you, preferably smiling, with no sunglasses. If approved, your photo will remain in the rotation for the next 45 days.</span>
                                                </label>
                                    </div>                        
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btnlogin" data-dismiss="modal" onclick="uploadProfilePhoto()">Upload Profile Pic</button>
          </div>
          <input type="hidden" name="imgid" value="<?php echo $memPhoto['id']?>" />
          <input type="hidden" name="aid" value="<?php echo $albumID['aid']?>" />
          <input type="hidden" name="uid" value="<?php echo $_GET['mid']?>" />
          <input type="hidden" name="gmtdiff" value="<?php echo $memberData['gmt_diference']?>" />  
          </form>
          
        </div>
      </div>
    </div>
    
    <div class="modal fade in" id="deletePropic" tabindex="-1" role="dialog" aria-labelledby="deletePropicLabel" style="display: none; padding-right: 17px;">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title" id="deletePropicLabel">Delete Profile Picture</h4>
          </div>
          <form name="fromprofilepicDelete" id="fromprofilepicDelete" action="" method="post">
          <div class="modal-body my-form">
            <div class="row">
                <div class="col-xs-12 text-center">
                    Are you sure you want to remove your current profile pic?   
                </div>
                
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btnlogin" data-dismiss="modal" onclick="DeleteProfilePic()">Delete Profile Pic</button>
          </div>
          <input type="hidden" name="mid" value="<?php echo $_GET['mid']?>" />
          <input type="hidden" name="photoid" value="<?php echo $memPhoto['id'];?>" />
          </form>
          
        </div>
      </div>
    </div>
            <div id="divmaincontent" class="medit">
            
            <div class="row">
                 <div class="col-md-3 col-sm-12">
                    <div id="main-profile-pic"><div class="userdata1"><h3><?php echo $memberData['username']; ?></h3></div> 
                    <div class="row">
                        <div class="col-xs-10 text-blue2" id="MPEditLabel_mytagline" style="display: block;">
                        <?php if($memberData['headline']) { echo $memberData['headline'];} ?></div>
                        <div class="col-xs-2 MPEditButton_mytagline" style="display: block;"> 
                                                                <a class="btn btn-default btn-circle-edit" href="javascript:void(0)" role="button" onclick="MPEdit('mytagline')" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a></div>
                    </div>
                    <div class="row" id="MPEditContainer_mytagline" style="display: none;">
                        <div class="col-xs-9">
                                                                <form name="frmtagline" id="frmtagline" method="post">
                                                                <input type="text" class="form-control" name="headline" value="<?php echo $memberData['headline'];?>" id="tagline" placeholder="Looking for my Soulmate">   
                                                        <input type="hidden" name="mid" value="<?php echo $_REQUEST['mid'];?>" />
                                                        </form> 
                                                            </div>
                        <div class="col-xs-3 padding-side-0 text-center MPSaveButton_mytagline" style="display: none;">
                                                            <a class="btn btn-default btn-circle-resp" href="javascript:void(0)" role="button" onclick="MPTagSave('mytagline')" title="Save"><i class="fa fa-check" aria-hidden="true"></i></a>
                                                            <a class="btn btn-default btn-circle-resp" href="javascript:void(0)" role="button" onclick="MPCancel('mytagline')" title="Cancel"><i class="fa fa-close" aria-hidden="true"></i></a>
                                                            </div>
                    </div>
                        
                         <div class="row margin-top-10">
                            <form>
                                <div class="col-xs-12">
                                    <span class="small text-muted">Profile Visibility: &nbsp;<input type="radio" name="profilevisible" id="profilevisible" onClick="ChangeMemberYesNo('yes','<?php echo $_GET['mid'];?>','members.visible');" value="<?php echo $memberData['visible'];?>" <?php if($memberData['visible'] == 'yes'): echo "checked"; endif;?>> <span class="font-size-10">Visible</span>
                                    <input type="radio" name="profilevisible" id="profilehidden" onClick="ChangeMemberYesNo('no','<?php echo $_GET['mid'];?>','members.visible');" value="<?php echo $memberData['visible'];?>" <?php if($memberData['visible'] != 'yes'): echo "checked"; endif;?>> <span class="font-size-10">Hidden</span>
                                </span></div>
                            </form>
                         </div>
                         <div class="margin-top-10">
                            <?php 
                            $memberPhoto = getMemberPhoto($_REQUEST['mid'],'photo');
                            if($memberPhoto['bigimage']):?>
                            <div><img src="<?php echo DB_DOMAIN;?>/inc/tb.php?src=<?php echo $memberPhoto['bigimage']; ?>&x=253&y=337&uid=<?php echo $_REQUEST['mid']; ?>" class="img-responsive thumbnail-image"></div>
                            <?php else:?>
                            <div><img src="<?php echo DB_DOMAIN;?>/inc/tb.php?src=&x=253&y=337&uid=<?php echo $_REQUEST['mid']; ?>" class="img-responsive thumbnail-image"></div>
                            <?php endif; ?>
                            <div class="margin-top-10"><a href="#" data-toggle="modal" data-target="#uploadPropic"><i class="fa fa-edit" aria-hidden="true"></i> Edit Profile Pic</a></div>
                            <div class="margin-top-10"><a href="#" data-toggle="modal" data-target="#deletePropic"><i class="fa fa-trash" aria-hidden="true"></i> Delete Profile Pic</a></div>
                        </div>
                        <div class="row margin-top-10" id="MPEditLabel_editasl">
                            <div class="col-xs-9 bold-darker">
                            <span><?php echo $memberData['location']?>,</span>
                            <?php
                                $mylocation = getBasicProfileInformation(2);
                                $my = array(25,54,28,20);
                                foreach($mylocation as $key => $mybvalue){
                                    $myfieldCaption = getFieldCaption($mybvalue['fid'],$mybvalue['fType']);
                                    $mymembersField = getMemberColumns($mybvalue['fName'], $_REQUEST['mid']);
                                    $mymembersFieldValue = getMemberColumnsValue($mymembersField[0]);
                                    //print_r($mymembersField);
                                    if(in_array($mybvalue['fid'],$my)) {
                                        
                            ?>
                            
                            <span><?php echo $mymembersFieldValue[0];?>,</span>
                            <?php /*?><span><?php echo MakeAge($memberData['age']);?> - <?php echo $sex['fvCaption'];?> - <?php echo $sexual['fvCaption'];?></span><?php */?>
                            <?php } } ?>
                           <span> <?php echo MakeAge($memberData['age']);?></span>
                        </div>
                            <div class="col-xs-3 MPEditButton_editasl">
                                <a class="btn btn-default btn-circle-edit" href="javascript:void(0)" role="button" onclick="MPEdit('editasl')" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div class="row margin-top-10" id="MPEditContainer_editasl" style="display:none;">
                            <div class="col-xs-6 text-left">
                                <h6>My Location</h6>

                                
                            </div>
                            <div class="col-xs-6 text-right MPSaveButton_editasl">
                                 <a class="btn btn-default btn-circle-resp" href="javascript:void(0)" role="button" onclick="MpSaveMyLocation('editasl')" title="Save"><i class="fa fa-check" aria-hidden="true"></i></a>
                                                            <a class="btn btn-default btn-circle-resp" href="javascript:void(0)" role="button" onclick="MPCancel('editasl')" title="Cancel"><i class="fa fa-close" aria-hidden="true"></i></a>
                            </div>
                            <div class="col-xs-12">
                                <div id="mylocation" style="display:none; font-weight:bold; color:#090;">Updated sucessfully!!!</div>
                                <form name="frmmylocation" id="frmmylocation" action="" method="post">
                                    <div class="row">
                                           <label for="country" class="col-xs-12 label-edit-info">Country</label>
                                            <div class="col-xs-12">
                                                 <?php echo getCountryState($memberData['country']); ?>
                                            </div>
                                            <label for="state" class="col-xs-12 margin-top-10 label-edit-info">State</label>
                                            <div class="col-xs-12">
                                            <div id="Link54">
                                            <a href="javascript:void(0);" onclick="eMeetingLinkedField(569, 54,0);">
                                            <?php 
                                            
                                            //$fieldCaption = getFieldCaption($bvalue['fid'],$bvalue['fType']);
                                            
                                            $state = getMemberColumnsValue($memberData['em_85820081128']);
                                            echo $state[0];
                                            ?> </a>
                                            </div>
                                                <!--<select class="form-control" id="state">
                                                    <option>Select State</option>
                                                </select>-->
                                               
                                            </div>
                                            <label for="City" class="col-xs-12 margin-top-10 label-edit-info">City</label>
                                            <div class="col-xs-12">
                                            <input type="text" class="form-control" id="location" name="location" value="<?php echo $memberData['location'];?>" placeholder="Sarah">
                                            </div>
                                             <div class="col-xs-12 text-left">
                                                <h6>Birthday, gender and orientation</h6>
                                            </div>
                                            <label class="col-xs-12 label-edit-info">My Birthday</label>
                                            <div class="col-xs-12">
                                                <?php
                                                    $age = explode("-",$memberData['age']);
                                                ?>
                                                <select class="form-control" id="birthdayyear" name="birthdayyear">
                                                    <option>Select Year</option>
                                                    <?php   $firstYear = 1919;
                                                            $lastYear = date('Y') - 18;
                                                            for($i=$firstYear;$i<=$lastYear;$i++)
                                                            {
                                                                if($age[0] == $i):
                                                                echo '<option value='.$i.' selected="selected">'.$i.'</option>';
                                                                else:
                                                                echo '<option value='.$i.'>'.$i.'</option>';
                                                                endif;
                                                            }?>
                                                </select>
                                            </div>
                                            <div class="col-xs-12 margin-top-10">
                                                <?php
                                                $months = array();
                                                $months = array(1 => 'JAN', 2 => 'FEB', 3 => 'MAR', 4 => 'APR', 5 => 'MAY', 6 => 'JUN', 7 => 'JUL', 8 => 'AUG', 9 => 'SEP', 10 => 'OCT', 11 => 'NOV', 12 => 'DEC');
                                                 ?>
                                                <select class="form-control" id="birthdaymonth" name="birthdaymonth">
                                                    <option>Select Month</option>
                                                    <?php foreach ($months as $num => $name) {
                                                            if($age[1] == $name):
                                                                $checked1 = 'selected="selected"';
                                                            else:
                                                                $checked1 = '';
                                                            endif;
                                                            
                                                            printf('<option value="%s" '.$checked1.'>%s</option>', $name, $name);
                                                            
                                                     } ?>
                                                </select>
                                            </div>
                                            <div class="col-xs-12 margin-top-10">
                                                <select class="form-control" id="birthdayday" name="birthdayday">
                                                    <option>Select Day</option>
                                                    <?php for($i=1; $i<=31; $i++){
                                                            if($age[2] == $i):
                                                                $checked2 = 'selected="selected"';
                                                            else:
                                                                $checked2 = '';
                                                            endif;
                                                            
                                                            echo '<option value='.$i.' '.$checked2.'>'.$i.'</option>';
                                                     } ?>
                                                </select>
                                            </div>
                                            <label for="gender" class="col-xs-12 margin-top-10 label-edit-info">My Gender</label>
                                            <div class="col-xs-12">
                                                <select class="form-control" id="gender" name="gender">
                                                    <?php echo DisplayProfileGender($memberData['gender']); ?>
                                                </select>
                                            </div>
                                            <label for="orientation" class="col-xs-12 margin-top-10 label-edit-info">My Orientation</label>
                                            <div class="col-xs-12">
                                                <select class="form-control" id="orientation" name="orientation">
                                                    <?php echo getProfileOrientation($memberData['em_8cx20070511']); ?>
                                                </select>
                                            </div>
                                            
                                        </div>
                                        <input type="hidden" name="mid" value="<?php echo $_REQUEST['mid'];?>" />
                                    </form>
                            </div>
                            <div class="col-xs-12 margin-top-10 text-right MPSaveButton_editasl">
                                 <a class="btn btn-default btn-circle-resp" href="javascript:void(0)" role="button" onclick="MpSaveMyLocation('editasl')" title="Save"><i class="fa fa-check" aria-hidden="true"></i></a>
                                                            <a class="btn btn-default btn-circle-resp" href="javascript:void(0)" role="button" onclick="MPCancel('editasl')" title="Cancel"><i class="fa fa-close" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                    
                </div>
                 <div class="col-md-9 col-sm-12"> 
                     <div class="row">
                        <div class="col-xs-12 margin-top-10">
                                
                            <?php

                            $groups = $DB->Query("SELECT id,caption FROM field_groups ORDER BY forder");
                            
                            ?>

                            <div role="tabpanel" data-example-id="togglable-tabs">
                            <ul class="nav nav-tabs centered li-full-width" role="tablist">
                                
                            <?php
                                $counter = 0;
                                while( $group = $DB->NextRow($groups) ){
                                $count_fields = getBasicProfileInformation($group['id']);

                                if(count($count_fields)){
                                    
                                ?>
                                <li role="presentation" <?php echo ($counter == 0) ? 'class="active"' : '';?>>
                                  <a href="#<?php echo preg_replace('/[^a-zA-Z0-9\']/', '-', strtolower($group['caption']));?>" id="<?php echo str_replace(" ", "-",strtolower($group['caption']));?>-tab" role="tab" data-toggle="tab" aria-controls="<?php echo strtolower($group['caption']);?>" aria-expanded="true">
                                    <span class="text"><?php echo $group['caption'];?></span>
                                  </a>
                                </li>
                                <?php
                                $counter++;
                                }
                            
                                }

                            ?>

                                <li role="presentation" class="">
                                  <a href="#photovideo" role="tab" id="photovideo-tab" data-toggle="tab" aria-controls="photovideo" aria-expanded="false">
                                    <span class="text">Media</span>
                                  </a>
                                </li>
                                
                              </ul>
      <div class="tab-content">



            <?php

            $groups = $DB->Query("SELECT id,caption FROM field_groups ORDER BY forder");
            
            $counter = 0;
            ?>

            
        
                
            <?php
                $counter = 0;
                while( $group = $DB->NextRow($groups) ){
                $userinfo = getBasicProfileInformation($group['id']);

                if(count($userinfo)){
                    
                ?>
                <div role="tabpanel" class="tab-pane fade <?php echo ($counter == 0) ? 'active': '';?> in" id="<?php echo preg_replace('/[^a-zA-Z0-9\']/', '-', strtolower($group['caption']));?>" aria-labelledby="<?php echo strtolower($group['caption']);?>-tab">
                <div class="row margin-top-10" id="MPEditLabel_<?php echo $group['id'];?>">
                    <div class="col-md-12 MPEditButton_<?php echo $group['id'];?> text-right">
                        <a class="btn btn-default btn-circle-edit" href="javascript:void(0)" role="button" onclick="MPEdit('<?php echo $group['id'];?>')" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a>
                    </div>
                    <div class="col-md-12">
                        <dl class="dl-horizontal dl-custom1">
                          
                          <?php
                            
                            foreach($userinfo as $key => $bvalue){
                                $fieldCaption = getFieldCaption($bvalue['fid'],$bvalue['fType']);
                                $membersField = getMemberColumns($bvalue['fName'], $_REQUEST['mid']);
                                $mFieldValue = getfieldValue($bvalue['fid']); 
                                /*echo "<pre>";
                                print_r($membersField);
                                echo "</pre>";*/

                                $membersFieldValue = getMemberColumnsValue($membersField[0]);
                                
                                /*echo "<pre>";
                                print_r($membersFieldValue);
                                echo "</pre>";*/
                                
                                $multiVals = array();

                                if($bvalue['fType'] == 5){
                                

                                $mValues = explode("**",$membersField[0]);
                                
                                foreach($mFieldValue as $key => $mflvalue):
                                    if(isset($mValues[$key]) &&  $mValues[$key] == '1'):
                                        $multiVals[] = $mflvalue['fvCaption'];
                                    endif;
                                ?>
                                <?php endforeach; ?>






                                <div style="float:left; width:50%">
                                    <dt><?php echo $fieldCaption['caption']?>:</dt>
                                    <dd><?php echo implode(" , ",$multiVals);?></dd>
                                </div>
                                <?php 

                                }
                                /*else if($bvalue['fType'] == 7){
                                    if($fieldCaption['caption'] != '' && $membersField[0] != ''){
                                ?>
                                    <div style="float:left; width:50%"><dt><?php echo $fieldCaption['caption']?>:</dt><dd><?php echo $membersField[0]?></dd></div>
                                <?php        
                                    }
                                }*/
                                else if($bvalue['fType'] == 2){
                                    if($fieldCaption['caption'] != '' && $membersField[0] != ''){
                                ?>
                                    <div style="float:left; width:50%"><dt><?php echo $fieldCaption['caption']?>:</dt><dd><?php echo $membersField[0]?></dd></div>
                                <?php        
                                    }
                                }
                                else if($bvalue['fType'] == 1){
                                    if($fieldCaption['caption'] != '' && $membersField[0] != ''){
                                ?>
                                    <div style="float:left; width:50%"><dt><?php echo $fieldCaption['caption']?>:</dt><dd><?php echo $membersField[0]?></dd></div>
                                <?php        
                                    }
                                }
                                else{
                                
                                    if($fieldCaption['caption'] != '' && $membersFieldValue[0] != ''){?>
                                
                                        <div style="float:left; width:50%"><dt><?php echo $fieldCaption['caption']?>:</dt><dd><?php echo $membersFieldValue[0]?></dd></div>
                                  
                                    <?php
                                    }
                                }
                            } ?>
                          
                        </dl>
                     </div>
                </div>






                <div class="row margin-top-10" id="MPEditContainer_<?php echo $group['id'];?>" style="display:none;">
                    <div class="col-md-12 text-right margin-bottom-10 MPSaveButton_<?php echo $group['id'];?>">
                        <a class="btn btn-default btn-circle-resp" href="javascript:void(0)" role="button" onclick="MpSaveBasicProfileInfo('<?php echo $group['id'];?>')" title="Save"><i class="fa fa-check" aria-hidden="true"></i></a>
                                            <a class="btn btn-default btn-circle-resp" href="javascript:void(0)" role="button" onclick="MPCancel('<?php echo $group['id'];?>')" title="Cancel"><i class="fa fa-close" aria-hidden="true"></i></a>
                    </div>
                        <?php $editbasicinfo = getBasicProfileInformation($group['id']);// print_r($editbasicinfo);?>
                    <form class="join-form" name="frmBasicProfileInfo_<?=$group['id']?>" id="frmBasicProfileInfo_<?=$group['id']?>" method="post" action="">
                        <div id="basicinfo" style="display:none; color:#090; font-weight:bold;">Updates Sucessfully!!!</div>
                        <?php 

                        foreach($editbasicinfo as $key => $bvalue){
                                $fieldCaption = getFieldCaption($bvalue['fid'],$bvalue['fType']);
                                $membersField = getMemberColumns($bvalue['fName'], $_REQUEST['mid']);
                                $membersFieldValue = getMemberColumnsValue($membersField[0]);
                                $mFieldValue = getfieldValue($bvalue['fid']);
                                //echo $fieldCaption['caption']."<br>";
                                //print_r($mFieldValue);
                                ?>
                                
                                <?php if($bvalue['fType'] == 5){ ?>
                                <div class="col-md-6">      
                                    <div class="row">
                                        <div class="col-md-12 titles-edit2"><?php echo $fieldCaption['caption'];?>:</div>
                                          <div class="col-md-12">
                                              <div class="row">
                                                  <div class="col-xs-12">
                                                  <?php 
                                                  $mValues = explode("**",$membersField[0]);
                                                  /*echo"<pre>";
                                                  print_r($mFieldValue);
                                                  echo "</pre>";*/
                                                  
                                                  foreach($mFieldValue as $key => $mflvalue):
                                                    if(isset($mValues[$key]) && $mValues[$key] == '1'):
                                                        $checked= 'checked';
                                                        else:
                                                        $checked = '';
                                                    endif;
                                                   ?>
                                                        
                                                    <div class="checkbox" style="width:45%; float:left;">
                                                  <label>
                                                    <input type="hidden" name="hid[<?php echo $bvalue['fName'];?>___<?php echo $key;?>]" value="<?php echo $mflvalue['fvid'];?>"/>
                                                    <input type="checkbox" name="chk[<?php echo $bvalue['fName'];?>___<?php echo $key;?>]" value="<?php echo $mflvalue['fvid'];?>" <?php echo $checked; ?>>
                                                    <?php echo $mflvalue['fvCaption'];?>
                                                  </label>
                                                </div>
                                                <?php endforeach; ?>
                                                  </div>
                                               </div>
                                          </div>
                                        </div>
                                    </div>
                                    <?php }
                                    else if($bvalue['fType'] == 7){
                                        /*if($fieldCaption['caption'] != '' && $membersField[0] != ''){
                                        ?>
                                        <div style="float:left; width:50%"><dt><?php echo $fieldCaption['caption']?>:</dt><dd><?php echo $membersField[0]?></dd></div>
                                        <?php
                                        }*/
                                    }
                                    else  if($bvalue['fType'] == 4){ ?>
                                <div class="col-md-6">      
                                    <div class="row">
                                        <div class="col-md-12 titles-edit2"><?php echo $fieldCaption['caption'];?>:</div>
                                          <div class="col-md-12">
                                              <div class="row">
                                                  <div class="col-xs-12">
                                                  <?php foreach($mFieldValue as $key => $mflvalue):
                                                    if($memberData[$bvalue['fName']] == $mflvalue['fvid']):
                                                        $checked= 'checked';
                                                        else:
                                                        $checked = '';
                                                    endif;
                                                   ?>
                                                        
                                                    <div class="checkbox" style="width:45%; float:left;">
                                                  <label>
                                                  
                                                    <input type="radio" name="<?php echo $bvalue['fName'];?>" value="<?php echo $mflvalue['fvid'];?>" <?php echo $checked; ?>>
                                                    <?php echo $mflvalue['fvCaption'];?>
                                                  </label>
                                                </div>
                                                <?php endforeach; ?>
                                                  </div>
                                               </div>
                                          </div>
                                        </div>
                                    </div>
                                    <?php } else if($bvalue['fType'] == 1){
                                    if($bvalue['fName'] != 'location'){
                                     ?>
                                    <div class="col-md-6">      
                                        <div class="row margin-top-10">
                                            <div class="col-md-4 titles-edit text-align-left-xs"><?php echo $fieldCaption['caption'];?>:</div>
                                            <div class="col-md-8">
                                                    <input type="text" name="<?php echo $bvalue['fName'];?>" class="form-control" value="<?php echo $membersField[0];?>" id="weight">
                                            </div>                    
                                        </div>
                                    </div>
                                    <?php } } else if($bvalue['fType'] == 2){ ?>
                                    <div class="col-md-12">      
                                        
                                        <div class="row margin-top-10">
                                            <div class="col-md-12 titles-edit text-align-left-xs" style="text-align:left;"><?php echo $fieldCaption['caption'];?>:</div>
                                            <br/>
                                            <br/>
                                            <div class="col-md-12">
                                                <textarea name="<?php echo $bvalue['fName'];?>" id="<?php echo $bvalue['fName'];?>" class="form-control ckeditor" id="weight"><?php echo $membersField[0];?></textarea>
                                            </div>
                                            <script>
                                                // Replace the <textarea id="editor1"> with a CKEditor
                                                // instance, using default configuration.
                                                CKEDITOR.replace( '<?php echo $bvalue['fName'];?>' );
                                            </script>
                                    </div>
                                    </div>
                                    <?php }elseif($bvalue['fName'] != 'em_85820081128' && $bvalue['fName'] != 'country'){ ?>
                                    <div class="col-md-6">      
                                        <div class="row margin-top-10">
                                            <div class="col-md-4 titles-edit text-align-left-xs"><?php echo $fieldCaption['caption'];?>:</div>
                                            <div class="col-md-8">
                                                    <select name="<?php echo $bvalue['fName'];?>" class="form-control" id="weight">
                                                    <option value="0">------------------</option>
                                                    <?php foreach($mFieldValue as $key => $mflvalue): 
                                                        if($membersFieldValue[0] == $mflvalue['fvCaption']):
                                                            $checked = 'selected="selected"';
                                                            else:
                                                            $checked = '';
                                                        endif;
                                                    ?>
                                                    <option value="<?php echo $mflvalue['fvid'];?>" <?php echo $checked; ?>><?php echo $mflvalue['fvCaption'];?></option>
                                                    <?php endforeach; ?> 
                                                 </select>
                                            </div>                    
                                        </div>
                                    </div>
                                    <?php } ?>
                                
                                   
                                  
                            <?php  } ?>
                        <input type="hidden" name="uid" value="<?php echo $_REQUEST['mid']?>" />
                    </form>
                    <div class="col-md-12 text-right margin-top-10 MPSaveButton_<?php echo $group['id'];?>">
                        <a class="btn btn-default btn-circle-resp" href="javascript:void(0)" role="button" onclick="MpSaveBasicProfileInfo('<?php echo $group['id'];?>')" title="Save"><i class="fa fa-check" aria-hidden="true"></i></a>
                                            <a class="btn btn-default btn-circle-resp" href="javascript:void(0)" role="button" onclick="MPCancel('<?php echo $group['id'];?>')" title="Cancel"><i class="fa fa-close" aria-hidden="true"></i></a>
                    </div>
                </div>









                </div>
                <?php
                $counter++;
                }
            
                }

            ?>








      <div role="tabpanel" class="tab-pane fade text_alignment" id="photovideo" aria-labelledby="photovideo-tab">
      <?php $photoGallery = getMemberMediaGalley($_REQUEST['mid'], 'photo'); ?>
      <?php $videoGallery = getMemberMediaGalley($_REQUEST['mid'], 'video'); ?>
      <h3>My Media</h3>
      <?php if(count($photoGallery) > 0):?>
    <h5>My photos </h5>
    <div class="row margin-top-10">
        <?php foreach($photoGallery as $photo):?>
      <a class="col-md-3 center-img" href="" data-lightbox="example-set" data-title="SF Bridge :)"><img class="img-responsive" src="<?php echo DB_DOMAIN;?>/inc/tb.php?src=<?php echo $photo['bigimage']; ?>&x=250&y=250&uid=<?php echo $_REQUEST['mid']; ?>" title="<?php echo $photo['title']; ?>" alt="<?php echo $photo['title']; ?>"></a>
      <?php endforeach; ?>
    </div>
    <?php else:?>
            <div class="col-xs-12 margin-auto">Photos not found!!!</div>
    <?php endif; ?>
    <h5>My Video</h5>
    <div class="row margin-top-10">
     <?php if(count($videoGallery) > 0):?>
            <?php foreach($videoGallery as $video):?>
                <div class="col-xs-12 margin-auto"><img src="img/novideo.jpg" class="img-responsive"></div>
                <?php endforeach; ?>
    <?php else:?>
            <div class="col-xs-12 margin-auto">Videos not found!!!</div>
    <?php endif; ?>
    </div>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="personalinfo" aria-labelledby="personalinfo-tab">
              <div class="row margin-top-10">
                <div class="col-xs-12">
                    <h3>My Personal Info</h3>   
                </div>
                
                
                <div class="col-xs-8 col-xs-offset-2">
                    <div id="successprofile" style="display:none; color:#090; font-weight:bold;">Profile Updates Sucessfully!!!</div>
                    <form name="frmprofileinfo" id="frmprofileinfo" class="form-horizontal join-form text-left" method="post" action="">
                            <?php
                            $personalInfo = getBasicProfileInformation(2);
                            $i = 0; 
                                foreach($personalInfo as $key => $mvalue){
                                    $fieldCaption = getFieldCaption($mvalue['fid'],$mvalue['fType']);
                                    $membersField = getMemberColumns($mvalue['fName'], $_REQUEST['mid']);
                                    
                                    ?>
                                    <?php if($mvalue['fName'] == 'em_cxw20160112' || $mvalue['fName'] == 'em_p8p20160112' || $mvalue['fName'] == 'em_mu320160126'){?>
                                    <div class="form-group">
                                        <label for="name" class="col-sm-4 control-label"><?php echo $fieldCaption['caption'];?></label>
                                        <div class="col-sm-8">
                                        <input type="text" class="form-control" id="<?php echo $mvalue['fName'];?>" name="<?php echo $mvalue['fName'];?>" value="<?php echo $membersField[0];?>" placeholder="Sarah">
                                        </div>
                                    </div>
                                    <?php } $i++; } ?>
                    
                                
                              <div class="form-group">
                                <label for="inputEmail3" class="col-sm-4 control-label">Email</label>
                                <div class="col-sm-8">
                                  <input type="email" name="email" class="form-control" id="inputEmail3" value="<?php echo $memberData['email'];?>" placeholder="currentemail@something.com">
                                  <span class="font-size-10 text-muted">Please enter a working email address as this will be used to send password reminders and notifications of member correspondence and interest.</span>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-sm-4 control-label">Current Password</label>
                                <div class="col-sm-8" style="padding-top:7px;">
                                    1234xxxxx
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="enterpw" class="col-sm-4 control-label">New Password</label>
                                <div class="col-sm-8">
                                  <input type="password" name="password" class="form-control" id="enterpw">
                                  
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="inputPassword3" class="col-sm-4 control-label">Reenter New Password</label>
                                <div class="col-sm-8">
                                  <input type="password" name="repeat-password" class="form-control" id="inputPassword3">
                                  <span class="font-size-10 text-muted">New password will be saved only if you enter a new one and click save.</span>
                                </div>
                              </div>
                              
                              <div class="form-group">
                                <div class="col-sm-8 pull-right text-center">
                                  <button type="button" class="btn btn-default btnlogin" onclick="MpSaveProfileInfo()">SAVE CHANGES</button>
                                </div>
                              </div>
                              <input type="hidden" name="uid" value="<?php echo $_GET['mid'];?>"
                    </form>
                </div>
              </div>
              
           
       </div>
        <div role="tabpanel" class="tab-pane fade" id="cupid" aria-labelledby="cupid-tab">
              <div class="row margin-top-10" id="questions-answered">
                <div class="col-lg-7 col-md-4">
                    <h3 class="hmargin-top-0">My Questions</h3>
                </div>
                <!--<div class="col-lg-5 col-md-8 text-right">
                    <a class="btn btn-sm btn-primary" href="javascript:void(0)" onClick="HideOneShowTwo('questions-answered', 'questions-not-answered')">Answer More Questions</a>&nbsp;<a class="btn btn-sm btn-primary" href="javascript:void(0)" onClick="">Clear All Answers</a>
                </div>-->
                <div class="col-xs-12">
                    <div class="panel-group margin-top-10" id="compquestions" role="tablist" aria-multiselectable="true">
                        <div class="row">
                            <div class="col-md-12">
                            
                            <?php
                        $okQuestion = getBasicProfileInformation(15);
                        //echo "<pre>";
                        //print_r($okQuestion);
                        foreach($okQuestion as $key => $okmvalue){
                            
                            $okfieldCaption = getFieldCaption($okmvalue['fid'],$okmvalue['fType']);
                            $okmembersField = getMemberColumns($okmvalue['fName'], $_REQUEST['mid']);
                            $okmembersFieldValue = getMemberColumnsValue($okmembersField[0]);
                            $okmFieldValue = getfieldValue($okmvalue['fid']);
                            //echo "<pre>";
                            //print_r($okmFieldValue);
                            
                            ?>
                                <div class="panel panel-default" style="float:left; width:48%; margin-left:10px;">
                            <div class="panel-heading" id="heading-compquestion<?php echo $okmvalue['fid']; ?>">
                        <h5 class="panel-title">
                            <a role="button" class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#compquestions" href="#collapse-compquestion<?php echo $okmvalue['fid']; ?>" aria-expanded="false" aria-controls="collapse-compquestion<?php echo $okmvalue['fid']; ?>"><?php echo $okfieldCaption['caption']; ?></a>
                        </h5>
                      </div>
                            <div id="collapse-compquestion<?php echo $okmvalue['fid']; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-compquestion<?php echo $okmvalue['fid']; ?>" aria-expanded="false" style="height: 0px;">
                                <div class="panel-body">
                        <form id="okquestion<?php echo $okmvalue['fid']; ?>" name="okquestion<?php echo $okmvalue['fid']; ?>" method="post" action="">
                            <div class="row">
                            <div class="col-xs-8 col-xs-offset-2">
                            <?php foreach($okmFieldValue as $okmflvalue): 
                                                if($okmflvalue['fvid'] == $memberData[$okmvalue['fName']]):
                                                    $checked = 'checked';
                                                    else:
                                                    $checked = '';
                                                endif;
                                                ?>
                                <div class="radio">
                                          <label>
                                            <input type="radio" name="<?php echo $okmvalue['fName'] ?>" id="<?php echo $okmvalue['fName'] ?>" value="<?php echo $okmflvalue['fvid'];?>" <?php echo $checked; ?>>
                                            <?php echo $okmflvalue['fvCaption'];?>
                                            <input type="hidden" name="okvalue" value="<?php echo $okmvalue['fName'] ?>" />
                                            <input type="hidden" name="uid" value="<?php echo $_GET['mid'] ?>" />
                                          </label>
                                        </div>
                                <?php endforeach; ?>
                            </div>
                                
                            <div class="col-xs-12 text-right margin-top-10"><a role="button" class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#compquestions" href="#collapse-compquestion<?php echo $okmvalue['fid']; ?>" aria-expanded="false" aria-controls="collapse-compquestion<?php echo $okmvalue['fid']; ?>" onclick="MpSaveOkQuestion('<?php echo $okmvalue['fid']; ?>')">Save Changes</a></div>
                        </div>
                        </form>
                      </div>
                            </div>
                          </div>  
                            <?php }?>    
                                
                            </div>
                            
                       </div>
                      </div>
                </div>
              </div>
 
        </div>
      </div>
    </div>
                             
                        </div>
                    </div>
                    
                    
                    
                </div>
            </div>
            
            
        </div>
        
        
        
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="inc/zebra/responsivetabs.js"></script>
<script src="inc/zebra/bootstrap.min.js"></script>
<script src="inc/zebra/bootstrap-select.min.js"></script>


<?php } elseif($_REQUEST['p'] == "fake"){ ?>

<script type="text/javascript" src="<?=subd ?>inc/js/_country.js"></script>
<form action="members.php" method="post">
<input name="p" type="hidden" value="fake" class="hidden">
<input type="hidden" name="do" value="fakemembers" class="hidden">

<ul class="form"><div class="box_body">
<li><label>Amount </label>
<div class="tip">Enter the amount in a numeric format (1 - 1000) for how many members you would like to generate.</div>
<input name="total" type="text" class="input" value=""></li>


</div></ul><ul class="form"><div class="box_body">

<li><label>Male or Female Names</label>
<div class="tip">Select the gender of the name types, male or female names.</div> 
  <select name="names" class="input">
    <option value="1">Male</option>
    <option value="2">Female</option>
  </select>
</li>

<li><label><?=$admin_members['a15'] ?></label>
<div class="tip">Select the country where the members will be generated from.</div>
<select name="country" size="1" class="input"><?=DisplayCountries() ?></select></li>
<li><label>Gender </label> 

<div class="tip">Select the members actual gender type..</div>
<select name="genderid" class="input">
    <?php foreach($_SESSION['g_array'] as $item){ 
        if(isset($item['caption']) && $item['caption'] != '') { ?>
        <option value="<?=$item['id'] ?>"><?=$item['caption'] ?></option> 
    <?php } 
        }
    ?>
</select>

</li>
<li><label style="width:200px;"><?=$admin_members_extra[3] ?>:</label>
<div class="tip">Select the membership level for the new members.</div>
<select name="pid" style="width:200px;" class="input"><?=DisplayPackage() ?></select></li> 

</div></ul><ul class="form"><div class="box_body">

<li><label>Email </label>
<div class="tip">Enter the email address for the new members.</div>
<input name="email" type="text" class="input" value=""></li>

<li><label>Password </label>
<div class="tip">Create a login password for the new members.</div>
<input name="password" type="text" class="input" value=""></li>
<li><input type="submit" value="<?=$admin_button_val[8] ?>"class="MainBtn"></li>
</div></ul>
</form>
<?php } ?>

<!-- The popup for crop the uploaded photo -->
    <div id="popup_crop" >
        <div class="form_crop">
            <span class="close" onclick="close_popup('popup_crop')">x</span>
            <h2>Crop photo</h2>
            <!-- This is the image we're attaching the crop to -->
            <img id="cropbox"  />
            
            <!-- This is the form that our event handler fills -->
            <form>
                <input type="hidden" id="x" name="x" />
                <input type="hidden" id="y" name="y" />
                <input type="hidden" id="w" name="w" />
                <input type="hidden" id="h" name="h" />
                <input type="hidden" id="photo_url" name="photo_url" />
                <input type="button" value="Crop Image" id="crop_btn" onclick="crop_photo('<?php echo DB_DOMAIN?>')" />
            </form>
        </div>
    </div>