<?php $tdata = array(); ob_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title><?=$admin_layout_header['title'] ?> - <?=$_SESSION['admin_name'] ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$admin_layout_header['charset'] ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php print Header_LoadScripts($_REQUEST['n'], $_GET['p']) ?>

<?php  print Header_LoadCSS($_REQUEST['n'], $_GET['p']) ?>
  
      <link rel="stylesheet" href="inc/css/bootstrap.min.css">
      <link rel="stylesheet" href="inc/css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="inc/css/style.css"> <!-- Resource style -->
            
             <link rel="stylesheet" href="inc/css/cropstyle.css"/>
             <link rel="stylesheet" href="inc/css/jquery.Jcrop.min.css"/>
            
	 <script src="inc/js/modernizr.js"></script> <!-- Modernizr -->
     <script src="inc/js/jquery.min.js"></script>
     <script src="inc/js/bootstrap.min.js"></script>
     
     <style> 
	 @media only screen and (min-width: 1000px) {

	
	.has-children > ul {
    width: 100%;
    z-index: 1;
  }
  .has-children ul a {
    padding-left: 18px;
  }
  .has-children.active > ul {
    /* if the item is active, make the subnavigation visible */
    position: relative;
    display: block;
    /* reset style */
    left: 0;
    box-shadow: none;
  }
  .no-touch .cd-side-nav .has-children:hover > ul, .cd-side-nav .has-children.hover > ul {
    /* show subnavigation on hover */
    display: block;
    opacity: 1;
    visibility: visible; padding:8px 0px;
  }
  .has-children.active > ul{padding:8px 0px;}
  
  
   
  .cd-side-nav {
    width: 180px;
  }
  .cd-side-nav > ul {
    padding: 0.6em 0;
  }
  
  .cd-side-nav > ul > li:not(.action-btn):hover > a , .cd-side-nav .active > a{
    background-color: #f78e3f; color:#fff;
    text-decoration: none;
  }
  
  .cd-side-nav > ul > li > a {
    padding: 1em 1em 1em 42px;
    text-align: left;
    border-bottom: none;
  }
  .cd-side-nav > ul > li > a::before {
    top: 50%;
    bottom: auto;
    -webkit-transform: translateY(-50%);
    -moz-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    -o-transform: translateY(-50%);
    transform: translateY(-50%);
    left: 18px;
  }
  .cd-side-nav .cd-label {
    display: block;
    padding: 1em 18px;
  }
  .cd-side-nav .action-btn {
    text-align: left;
  }
  .cd-side-nav .action-btn a {
    margin: 0 18px;
  }
  .no-touch .cd-side-nav .action-btn a:hover {
    background-color: #1a93de;
  }
  .cd-side-nav .count {
    /* reset style */
    color: #ffffff;
    height: auto;
    width: auto;
    border-radius: .25em;
    padding: .2em .4em;
    top: 50%;
    bottom: auto;
    -webkit-transform: translateY(-50%);
    -moz-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    -o-transform: translateY(-50%);
    transform: translateY(-50%);
    right: 18px;
    left: auto;
    box-shadow: none;
  }
  
}
	 

	 
	 
	 
	 @media(max-width:770px)
	 {
		
		 .logo_content
	       {
			   margin-top:10px;
			   text-align:center;
	       }
		 	body .active {
      background-color: black!important;
         }
     .dropdown-menu
	 {
		 background:black!important;
	 }

		 .customze_menus li a
		   {
			color: #979797; 
		   }
		 .left-menu
		 {
			 display:none!important;
		 }
		 #myNavbar
		 {
		background:black;	 
		 }
		 
		     
		   #container {
           width: 100%!important;
		   padding:0px 15px!important;
		   margin-top: 10px;
           margin-left: 0px
           }
		 .navbar-toggle2
		 {
			background:#000; 
		 }
		 .navbar-toggle2 .icon-bar
		 {
			background:#fff; 
			}
			
	.left-menu
	{
		background:#fff;
	}
	

	
	.top-head .top-links
	{
		float:left!important;
		
	 }
	 .nav .open>a, .nav .open>a:focus
	 {
		     background-color: #f78e3f!important; 
			 color:#fff!important;
	 }
	 }
	 
	 @media(max-width:650px)
	 {
		 
		 
		 .search_display_off,  .search_display_on
          {
         	font-size:10px!important;  
          }
	   .logo_content
	   {
		 font-size:11px!important;
		   margin-top: 8px;
	   }
	   
	  #mobile-form .form .box_body
	   {
		 width:100%!important;  
	   }
	     
		 #contentcolumn .approva_container .left_div ,#contentcolumn .approva_container .right_div
		 {
			 width:100%;
		 }
	 }
	 



	 
	 </style>
     
     
</head>

<body onLoad="<?php print Header_LoadOn($_REQUEST['n'], $_GET['p']) ?>">
<div class="top-head_res">
<div class="top-head">
<div class="row">

 <div class="col-md-8 col-sm-8 col-xs-12 hidden-xs">
  <div class="logo">iCupid Admin Area Ver <?=VERSION ?> 
    | Page Loaded in:
    <?
			$StopTimer = time()+microtime();
			$EndTimer = round($StopTimer-$StartTimer,4);
			
			print $EndTimer;
			?>
 Seconds</div>
 </div>
 
 <div class="col-md-4 col-sm-4 col-xs-6">
 <div class="top-links"><a href="http://www.advandate.com/support/" target="_blank">Support</a> | <a href="logout.php"><span class="outer"><span class="inner">Logout</span></span></a></div>
 
 </div>
 
 <div class="col-xs-6">
<div class="menu_button_bar">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle navbar-toggle2" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        </button>
      </div> 
</div>
 </div>
 
 </div>
</div>
</div>



<?php $str = $_SERVER['REQUEST_URI']; ?>


    <div class="visible-sm visible-xs row">
    <div class="col-xs-12">
  <div class="collapse navbar-collapse customze_menus" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="overview.php"><?=$admin_layout_nav['1'] ?></a>
               <ul class="dropdown-menu">
                     <li><?=MakeMenuBar($admin_layout_page1,"top","overview.php") ?></li>
					 <li><?=MakeMenuBar($admin_layout_page01,"top","maintenance.php") ?></li>
					 <li><?=MakeMenuBar($admin_layout_page02,"top","overview.php") ?></li>
               </ul>
        </li>
        
        	<?php if( in_array("2",$_SESSION['admin_access_level']) ){ ?>
			
			<li class="dropdown <?php if(strpos($str , 'members.php')){echo 'active';}?>"><a class="dropdown-toggle" data-toggle="dropdown" href="members.php" <?php if($_REQUEST['n'] ==1){ print "class='selected'"; } ?>><?=$admin_layout_nav['2'] ?></a>
					  <ul  class="dropdown-menu" ><li><?=MakeMenuBar($admin_layout_page2,"top","members.php") ?>	</li></ul>		
			</li>
			
			<?php } ?>
        
        	<?php if( in_array("3",$_SESSION['admin_access_level']) ){ ?>
			
			<li class="dropdown <?php if(strpos($str , 'template.php')){echo 'active';}?>"><a class="dropdown-toggle" data-toggle="dropdown" href="template.php" <?php if($_REQUEST['n'] ==2){ print "class='selected'"; } ?>><?=$admin_layout_nav['3'] ?></a>
					<ul class="dropdown-menu" >
						<li><?=MakeMenuBar($admin_layout_page3,"top","template.php") ?>		</li>		
					</ul>
			</li>
			
            
            
			<?php } ?>
        
        <?php if( in_array("4",$_SESSION['admin_access_level']) ){ ?>
			
			<li class="dropdown <?php if(strpos($str , 'email.php')){echo 'active';}?>"><a class="dropdown-toggle" data-toggle="dropdown" href="email.php" <?php if($_REQUEST['n'] ==3){ print "class='selected'"; } ?>><?=$admin_layout_nav['4'] ?></a>
				<ul class="dropdown-menu">
					<li><?=MakeMenuBar($admin_layout_page4,"top","email.php") ?></li>
				</ul>
			</li>
			
			<?php } ?>
            
            	<?php if( in_array("5",$_SESSION['admin_access_level']) ){ ?>
			
			<li class="dropdown <?php if(strpos($str , 'billing.php')){echo 'active';}?>"><a class="dropdown-toggle" data-toggle="dropdown" href="billing.php" <?php if($_REQUEST['n'] ==4){ print "class='selected'"; } ?>><?=$admin_layout_nav['5'] ?></a>
				<ul class="dropdown-menu">
					<li><?=MakeMenuBar($admin_layout_page5,"top","billing.php") ?></li>
				</ul>
			</li>
			
			<?php } ?>
            
        	<?php if( in_array("6",$_SESSION['admin_access_level']) ){ ?>
			
			<li class="dropdown <?php if(strpos($str , 'settings.php') || strpos($str , 'advertising.php')){echo 'active';}?>"><a class="dropdown-toggle" data-toggle="dropdown" href="settings.php" <?php if($_REQUEST['n'] ==6 || $_REQUEST['n'] ==8){ print "class='selected'"; } ?>><?=$admin_layout_nav['6'] ?></a>
	
				<ul class="dropdown-menu" >
					<li><?=MakeMenuBar($admin_layout_page6,"top","advertising.php") ?> <?=MakeMenuBar($admin_layout_page7,"top","settings.php") ?></li>
				</ul>
			</li>
			
			
			<?php } ?>
            
            
            
            	<?php if( in_array("7",$_SESSION['admin_access_level']) ){ ?>
			
			<li class="dropdown <?php if(strpos($str , 'management.php')){echo 'active';}?>"><a class="dropdown-toggle" data-toggle="dropdown" href="management.php" <?php if($_REQUEST['n'] ==7){ print "class='selected'"; } ?>><?=$admin_layout_nav['7'] ?></a>
	
				<ul class="dropdown-menu">
					<li><?=MakeMenuBar($admin_layout_page8,"top","management.php",1) ?></li>
				</ul>
			</li>		
			
			<?php } ?>
            
            
            	<?php if( in_array("8",$_SESSION['admin_access_level']) ){ ?>
			<li class="dropdown <?php if(strpos($str , 'plugins.php')){echo 'active';}?>"><a class="dropdown-toggle" data-toggle="dropdown" href="plugins.php" <?php if($_REQUEST['n'] ==14){ print "class='selected'"; } ?>><?=$admin_layout_nav['9'] ?></a>
				<ul class="dropdown-menu">
					<li><?=MakeMenuBar($admin_layout_page11,"top","plugins.php") ?></li>
				</ul>
			</li>
				<?php } ?>
        
      </ul>
    
  
   </div> 
   
   </div>
   </div>
   <div class="row visible-xs"> 
   <div class="col-xs-12">
   <div class="logo logo_content">iCupid Admin Area Ver <?=VERSION ?> 
    | Page Loaded in:
    <?
			$StopTimer = time()+microtime();
			$EndTimer = round($StopTimer-$StartTimer,4);
			
			print $EndTimer;
			?>
 Seconds</div> 
 </div>
   </div>
   
    <div class="left-menu hidden-sm">
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
			
			
			<?php } ?>
			
			<?php if( in_array("7",$_SESSION['admin_access_level']) ){ ?>
			
			<li class="has-children content <?php if(strpos($str , 'management.php')){echo 'active';}?>"><a href="management.php" <?php if($_REQUEST['n'] ==7){ print "class='selected'"; } ?>><?=$admin_layout_nav['7'] ?></a>
	
				<ul>
					<li><?=MakeMenuBar($admin_layout_page8,"top","management.php",1) ?></li>
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
			<?
			$StopTimer = time()+microtime();
			$EndTimer = round($StopTimer-$StartTimer,4);
			
			print $EndTimer;
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

<script>


</script>