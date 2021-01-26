<?php $tdata = array(); ob_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html><head>
<title><?=$admin_layout_header['title'] ?> - <?=$_SESSION['admin_name'] ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$admin_layout_header['charset'] ?>">

<?php print Header_LoadScripts($_REQUEST['n'], $_GET['p']) ?>

<?php  print Header_LoadCSS($_REQUEST['n'], $_GET['p']) ?>
  <link rel="stylesheet" href="inc/css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="inc/css/style.css"> <!-- Resource style -->
            <?php if(isset($_REQUEST['p']) && $_REQUEST['p']=="files")
            { ?>
               <link rel="stylesheet" href="inc/css/cropstyle.css"/>
             <link rel="stylesheet" href="inc/css/jquery.Jcrop.min.css"/>
            <?php } ?>
	<script src="inc/js/modernizr.js"></script> <!-- Modernizr -->
</head>

<body onLoad="<?php print Header_LoadOn($_REQUEST['n'], $_GET['p']) ?>">

<div class="top-head">
  <div class="logo">iCupid Admin Area Ver <?=VERSION ?> 
    | Page Loaded in:
    <?
			$StopTimer = (float) time()+ (float) microtime();
			$EndTimer = round($StopTimer-$StartTimer,4);
			
			print $EndTimer;
			?>
 Seconds</div><div class="top-links"><a href="http://www.advandate.com/support/" target="_blank">Support</a> | <a href="logout.php"><span class="outer"><span class="inner">Logout</span></span></a></div>
</div>
<div class="left-menu">
 	<!-- SART MAIN MENU -->

<?php $str = $_SERVER['REQUEST_URI']; ?>
	<nav class="cd-side-nav">	
	    <ul>
			<li class="has-children overview <?php if(strpos($str , 'overview.php') || strpos($str , 'maintenance.php')){echo 'active';}?>">
				<a href="overview.php" <?php if($_REQUEST['n'] ==0){ print "class='selected'"; } ?>><?=$admin_layout_nav['1'] ?></a>
				  <ul>
                   <li><?=MakeMenuBar($admin_layout_page1,"top","overview.php") ?>
					   <?=MakeMenuBar($admin_layout_page01,"top","maintenance.php") ?>
					   <?=MakeMenuBar($admin_layout_page02,"top","overview.php") ?>
				   </li>
                   </ul>					
			</li>
			
			
			
			<?php if( in_array("2",$_SESSION['admin_access_level']) ){ ?>
			
			<li class="has-children members <?php if(strpos($str , 'members.php')){echo 'active';}?>"><a href="members.php" <?php if($_REQUEST['n'] ==1){ print "class='selected'"; } ?>><?=$admin_layout_nav['2'] ?></a>
					  <ul><li><?=MakeMenuBar($admin_layout_page2,"top","members.php") ?>	</li></ul>		
			</li>
			
			<?php } ?>
			
			<?php if( in_array("3",$_SESSION['admin_access_level']) ){ ?>
			
			<li class="has-children design <?php if(strpos($str , 'template.php')){echo 'active';}?>"><a href="template.php" <?php if($_REQUEST['n'] ==2){ print "class='selected'"; } ?>><?=$admin_layout_nav['3'] ?></a>
					<ul>
						<li><?=MakeMenuBar($admin_layout_page3,"top","template.php") ?>		</li>		
					</ul>
			</li>
			
			<?php } ?>
			
			<?php if( in_array("4",$_SESSION['admin_access_level']) ){ ?>
			
			<li class="has-children email <?php if(strpos($str , 'email.php')){echo 'active';}?>"><a href="email.php" <?php if($_REQUEST['n'] ==3){ print "class='selected'"; } ?>><?=$admin_layout_nav['4'] ?></a>
				<ul>
					<li><?=MakeMenuBar($admin_layout_page4,"top","email.php") ?></li>
				</ul>
			</li>
			
			<?php } ?>
			
			<?php if( in_array("5",$_SESSION['admin_access_level']) ){ ?>
			
			<li class="has-children billing <?php if(strpos($str , 'billing.php')){echo 'active';}?>"><a href="billing.php" <?php if($_REQUEST['n'] ==4){ print "class='selected'"; } ?>><?=$admin_layout_nav['5'] ?></a>
				<ul>
					<li><?=MakeMenuBar($admin_layout_page5,"top","billing.php") ?></li>
				</ul>
			</li>
			
			<?php } ?>
			
			<?php if( in_array("6",$_SESSION['admin_access_level']) ){ ?>
			
			<li class="has-children settings <?php if(strpos($str , 'settings.php') || strpos($str , 'advertising.php')){echo 'active';}?>"><a href="settings.php" <?php if($_REQUEST['n'] ==6 || $_REQUEST['n'] ==8){ print "class='selected'"; } ?>><?=$admin_layout_nav['6'] ?></a>
	
				<ul>
					<li><?=MakeMenuBar($admin_layout_page6,"top","advertising.php") ?> <?=MakeMenuBar($admin_layout_page7,"top","settings.php") ?></li>
				</ul>
			</li>
			
			<?php
			if(isset($admin_layout_nav['12']) && in_array('wld',$PLUGINS_PAGES)){ ?>
			<li class="has-children wld <?php if(strpos($str , 'wld.php')){echo 'active';}?>"><a href="wld.php" <?php if($_REQUEST['n'] ==9 || $_REQUEST['n'] ==8){ print "class='selected'"; } ?>><?=$admin_layout_nav['12'] ?></a>
	
				<ul>
					<li><?=MakeMenuBar($admin_layout_page12,"top","wld.php") ?></li>
				</ul>
			</li>
			<?php } ?>
			<?php } ?>
			
			<?php if( in_array("7",$_SESSION['admin_access_level']) ){ ?>
			
			<li class="has-children content <?php if(strpos($str , 'management.php')){echo 'active';}?>"><a href="management.php" <?php if($_REQUEST['n'] ==7){ print "class='selected'"; } ?>><?=$admin_layout_nav['7'] ?></a>
	
				<ul>
					<li><?=MakeMenuBar($admin_layout_page8,"top","management.php",1) ?>
						
					
				</ul>
			</li>		
			
			<?php } ?>

			<?php if( in_array("8",$_SESSION['admin_access_level']) ){ ?>
			<li class="has-children plugin <?php if(strpos($str , 'plugins.php')){echo 'active';}?>"><a href="plugins.php" <?php if($_REQUEST['n'] ==14){ print "class='selected'"; } ?>><?=$admin_layout_nav['9'] ?></a>
				<ul>
					<li><?=MakeMenuBar($admin_layout_page11,"top","plugins.php") ?></li>
				</ul>
			</li>
				<?php } ?>
		</ul>		
	</nav>
	<!-- END MAIN MENU -->  
    </div>
<div id="container">
<?php if(isset($_REQUEST['Err']) || ( ADMIN_DEMO=="yes" ) ){ 
		
		if(ADMIN_DEMO=="yes"){
			$msg[0] ="Demo Mode Enabled, many features are disabled in this demo."; 
			$msg[1] ="0";
		}else{
			$msg = explode("**",$_REQUEST['Err']); 
		}
		if(!isset($msg[1])){$msgType="good";}elseif($msg[1] ==0){ $msgType="bad";}elseif($msg[1] ==1){$msgType="good";}else{ $msgType="good";} ?>  
  		
		<div id="messages">
			  <div class="message-<?=$msgType ?>" id="main-message-<?=$msgType ?>">
			  <a class="dismiss-message" href="#" onclick="Effect.Fade('main-message-<?=$msgType ?>', { duration : 0.5 });; return false;"></a>
			  <?=$msg[0] ?>
			</div>
			
		</div>
		
		<?php } ?>

 <div id="wrapper">
 
  <div id="header">

 <?php

	## define variables
	$CheckData = array(); $Counter=1; 

	$SQL = "select row_num from 
		(
			SELECT count(id) AS row_num FROM members WHERE ( active='unapproved' )
	 
			union ALL	

			SELECT count(uid) AS found FROM files WHERE ( approved='no' AND type='photo' )

			union ALL	

			SELECT count(uid) AS found FROM files WHERE ( approved='no' AND (type='video' or type='youtube'))
	 
			union ALL	

			SELECT count(uid) AS found FROM files WHERE ( approved='no' AND type='music' )

			union ALL	

			SELECT count(id) AS found FROM calendar_data  WHERE ( approved='no' )			

			union ALL	

			SELECT count(id) AS found FROM class_adverts  WHERE ( approved='no' )

			union ALL	

			SELECT count(id) AS found FROM members_reported  WHERE ( visible='no' )

		) as derived_table";
	 
	$CheckThis = $DB->Query($SQL);
 
	## loop data from query
 	while( $DataArray = $DB->NextRow($CheckThis) ){

		$CheckData[$Counter]['total'] = number_format($DataArray['row_num']); 
		$Counter++;
	}	
?>
 
        
 


	
  <!-- END HEADER -->
  <div>
 <!-- END WRAPPER -->
</div>   

</div>
<!-- EMEETING CONTENT START -->
 
<div id="content">

<div>

 		<div class="shadetabs">
<?php if(isset($PageLang[$_GET['p'].'_*'])){ 	print $PageLang[$_GET['p'].'_*']; } ?>
<?php if(isset($Plugin_Title) && !isset($PageLang[$_GET['p'].'_*']) ){ print $Plugin_Title; } ?>
		</div>
 <!---->
 

 
<div id="TopCommentsMainBox">


<div id="contentwrapper">
<?php
$dashboardClass = '';
if($_SERVER['REQUEST_URI'] != '/newadmin/overview.php' && $_SERVER['REQUEST_URI'] != '/newadmin/overview.php?p='){
	$dashboardClass = 'contentcolumndash';
}
?>

<div id="contentcolumn" class="<?=$dashboardClass?>">


	<?php if(isset($PageLang[$_GET['p'].'_?']) && $PageLang[$_GET['p'].'_?'] !=""){ print "<p id='TopCommentsBox'><img src='inc/images/icons/help.png' align='absmiddle' />  ".$PageLang[$_GET['p'].'_?']."</p>";} ?>
	<?php $contents = ob_get_contents();ob_end_clean();$tdata[1]["contents"] = $contents;ob_start();?>
	
</div>

<?php

if($_SERVER['REQUEST_URI'] == '/newadmin/overview.php' || $_SERVER['REQUEST_URI'] == '/newadmin/overview.php?p='){
?>
<div id="rightcolumn">
 
		<?php include('layout_menu.php'); ?>

</div> 
<?php 
}
?>
<br class="clear" />
</div>
</div>
 
		
 

 
<br class="clear" />
 
<!-- EMEETING CONTENT END -->

</div>
</div>

<!-- EMEETING FOOTER START -->
<div id="bodyBottom" style="display:visible;">

<div id="footer" style="display:visible;">
<?php if(BRAND_ID ==""){ ?>
<div style="float:left; margin-left:30px; display:visible;">
<a href="<?=powered_link ?>" target="_blank" style="display:visible;"><img src="inc/images/lay/footer.jpg" style="margin-top:5px;" alt="Powered by iCupid Dating Software"></a>
</div>
<div style="float:right; margin-right:40px; display:visible;">
	<span> iCupid Version <?=VERSION ?> </span>
		<ul>
		<li></li>
			<li style="font-size:12px;">Page Loaded in: 
			<?php 
			$StopTimer = (float)time()+(float)microtime();
			$EndTimer = round($StopTimer-$StartTimer,4);
			
			//print $EndTimer;
			?> Seconds
			</li>
		</ul>
</div>
<?php } ?>
</div>
</div>
<!-- EMEETING FOOTER END -->
<script type="text/javascript" language="javascript">Effect.Pulsate('main-message-good', { pulses : 5, duration : 3, from : 0.1 });</script>
</body>
</html>
<?php $contents = ob_get_contents();ob_end_clean();$tdata[2]["contents"] = $contents;ob_start();?>