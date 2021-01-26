<?php
$icon_pic=0;
?>
<style>
.ititle { font-size:12px; background:#eeeeee; clear:both; font-weight:bold;}
 #QuickMenu { float:left;}
 #QuickMenu .PaddingBox{ float: left;margin-right: 10px;}
.style2 {font-size: 14px; }
.style3 {
	font-size: 14px;
	font-weight: bold;
	color: #FF0000;
}
.news-title{
    min-width: 190px;
    float: left;
}
</style>
<div class="title-head">Awaiting Approval</div>
 <div id="menuTop">

 			 	<ul class="group" id="menu_group_main">
            	<li><a href="members.php?ustatus=unapproved" class="<?php if($CheckData[1]['total'] > 0){ print "alertOn"; }else{ print "alertOff"; } ?>"><img src="inc/images/24x24/users_<?php if($CheckData[1]['total'] > 0){ print "on"; }else{ print "off"; } ?>.png" />
               <span class="inner">Members</span></a></li>
                <li><a href="members.php?p=files&t=photo" class="<?php if($CheckData[2]['total'] > 0){ print "alertOn"; }else{ print "alertOff"; } ?>"><img src="inc/images/24x24/image_<?php if($CheckData[2]['total'] > 0){ print "on"; }else{ print "off"; } ?>.png" /><span class="inner">Photos</span></a></li>
                <li><a href="members.php?p=files&t=video" class="<?php if($CheckData[3]['total'] > 0){ print "alertOn"; }else{ print "alertOff"; } ?>"><img src="inc/images/24x24/video_<?php if($CheckData[3]['total'] > 0){ print "on"; }else{ print "off"; } ?>.png" /><span class="inner" >Videos</span></a></li>
                <li><a href="members.php?p=files&t=music" class="<?php if($CheckData[4]['total'] > 0){ print "alertOn"; }else{ print "alertOff"; } ?>"><img src="inc/images/24x24/sound_<?php if($CheckData[4]['total'] > 0){ print "on"; }else{ print "off"; } ?>.png" /><span class="inner">Music</span></a></li>
            	<li><a href="management.php?p=cal" class="<?php if($CheckData[5]['total'] > 0){ print "alertOn"; }else{ print "alertOff"; } ?>"><img src="inc/images/24x24/events_<?php if($CheckData[5]['total'] > 0){ print "on"; }else{ print "off"; } ?>.png" /><span class="inner">Events</span></a></li>
                <li><a href="management.php?p=class" class="<?php if($CheckData[6]['total'] > 0){ print "alertOn"; }else{ print "alertOff"; } ?>"> <img src="inc/images/24x24/adverts_<?php if($CheckData[6]['total'] > 0){ print "on"; }else{ print "off"; } ?>.png" /><span class="inner">Adverts</span></a></li>
                <li><a href="email.php?p=tc" class="<?php if(isset($CheckData[8]['total']) && $CheckData[8]['total'] > 0){ print "alertOn"; }else{ print "alertOff"; } ?>"> <img src="inc/images/24x24/reports_<?php if(isset($CheckData[8]['total']) && $CheckData[8]['total'] > 0){ print "on"; }else{ print "off"; } ?>.png" /><span class="inner">Reports</span></a></li>
                <li><a href="members.php?sp=mreport&p=" class="<?php if(isset($CheckData[7]['total']) && $CheckData[7]['total'] > 0){ print "alertOn"; }else{ print "alertOff"; } ?>"> <img src="inc/images/24x24/users_<?php if(isset($CheckData[7]['total']) && $CheckData[7]['total'] > 0){ print "on"; }else{ print "off"; } ?>.png" /><span class="inner">Report Members</span></a></li>
             
        		</ul>
</div>
        <div class="title-head">Admin Functions</div>
        <ul class="shadetabs">
        	<?php if($_SESSION['admin_level'] ==1 || ( isset($_SESSION['admin_super_user']) && $_SESSION['admin_super_user'] == "yes" ) ){ ?>	
				<li><a href="maintenance.php"  class="home"><?=$admin_layout_nav['11'] ?></a></li>				
				<? if(isset($_SESSION['admin_super_user']) && $_SESSION['admin_super_user'] =="yes"){ ?><li><a href="admins.php"><?=$admin_layout_nav['10'] ?></a></li><? } ?>
				<?php } ?>	
</ul>	
 <div id="QuickMenu">

<?
$pos = strpos(KEY_ID, "TRIAL_");
if ($pos === false) { }else{
$days = (strtotime($_SESSION['trial_startdate']) - strtotime(date("Y-m-d"))) / (60 * 60 * 24)+10;
if($days ==0){ $days=10; }
?>
<div style="background:#FFB3B2; margin-bottom:20px; padding:5px;  border:1px solid #900000;">
<b>eMeeting Trial Software</b>
<p><?=$days; ?> Days Remaining: <a href="http://advandate.com/buy-dating-software/" target="_blank" style="text-decoration:underline;">Upgrade Now</a></p>
</div>

<? } ?>

 <div class="PaddingBox">

<div style="background:#EBFFFF; padding:5px; height:50px;">
 <span style="float:left; width:55px;"><?php if($_SESSION['admin_super_user'] =="yes"){ ?> <img src="inc/images/avatars/1.gif" width="40" height="40"><?php }else{ ?><img src="inc/images/avatars/<?=$_SESSION['admin_icon'] ?>" width="40" height="40">
	  <?php } ?></span>
<span style="float:left; line-height:20px;">
<b><?=$_SESSION['admin_name'] ?></b><br>
<a href="<?php if($_SESSION['admin_super_user'] !="yes"){ ?>admins.php?p=pref<?php }else{ ?>admins.php?p=super<?php } ?>" ><?=$admin_layout['3'] ?></a>
</span>
</div>
</div>

<?php if(isset($PageLang[$_GET['p'].'_?']) && $PageLang[$_GET['p'].'_?'] !=""){ ?>
<div class="PaddingBox" style="height:30px; background:#FFE1E7;">
<div id='GoBackButton'><a href='javascript:history.go(-1);'><img src="inc/images/24x24/logout.png" align="absmiddle"> Cancel Changes</a></div> 
</div>
<?php } ?>

</div>

<div class="title-head">Backup</div>
<div id="menuTop">
<p class="style3">Backup your dating site with CodeGuard.</p>
<br/>
<br/>
<p><a style="outline: none; border: none;" href="http://mbsy.co/cvWwC" target="_blank" rel="nofollow"><img class=" alignleft" src="https://ambassador-api.s3.amazonaws.com/uploads/marketing/8785/2014_11_05_20_16_39.png" alt="CodeGuard" border="0" /></a></p>
<br/>
<span class="style2"><br/>
</span>
<p class="style2">Backup your whole dating site including databases and files with the CodeGuard Backup Solution.</p>
</div>
<div class="title-head">AdvanDate News</div>
<div id="menuTop">
    <?php
    $rss = simplexml_load_file('https://www.advandate.com/feed/');
    ?>
    <ul>
        <?php
        foreach ($rss->channel->item as $item) {
        ?>
            <li><a href="<?=$item->link?>" target="_blank"><span class="news-title"><?=$item->title?></span><span class="news-date"><?=date("l, M d,Y",strtotime($item->pubDate))?></span></a></li>
        <?php
        }
        ?>

    </ul>
</div>
<?php 
if(isset($_REQUEST['p']) && $_REQUEST['p']=="mobileserver")
{
include("user-profile.php");
}
?>