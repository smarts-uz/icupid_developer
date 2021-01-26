<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
<head>
	<title><?=$HEADER_META_TITLE ?></title>
    <meta name="keywords" content="<?=$HEADER_META_KEYWORDS ?>" />
    <meta name="description" content="<?=$HEADER_META_DESCRIPTION ?>" />
    <meta http-equiv="Content-Type" content="text/html; charset=<?=$HEADER_META_CHARSET ?>">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <?=$HEADER_META_BASE ?>
    <?php e_meta(); ?>

    <?=(isset($HEADER_ANALYTICS)) ? $HEADER_ANALYTICS : "";?>

    <?php 

    if($page == 'index'){
    ?>
    <link rel="stylesheet" href="/inc/css/styles_new.css" type="text/css">

    <?php
	}

    if(isset($_SESSION['auth']) && $_SESSION['auth'] =="no" && $page != 'index'){
    ?>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->

    <?php
	}
    if(isset($_SESSION['auth']) && $_SESSION['auth'] =="no" && $page == 'index'){
    ?>
    <script>
	
	function runTest() {

		
		hCarousel = new UI.Carousel("style5");

	}

	Event.observe(window, "load", runTest);


	</script>
    <?php
    }
    else{
    ?>

	<script>
	
	function runTest() {

		
		hCarousel = new UI.Carousel("style5");

	}

	Event.observe(window, "load", runTest);


	</script>
	
<?php
}
?>
<style>
@media (max-width: 768px){
    .sub_menu, .menu {
        height: 0;
    }
    div#mynav {
        background: #b1a8a3;
    }
}
</style>
</head>

<? if(isset($HEADER_SINGLE_COLUMN)){ ?>
<body id="splitpage" <?=$HEADER_ON_LOAD ?>>
<? }else{ ?>
<body id="fullpage" <?=$HEADER_ON_LOAD ?>>
<? } ?>
<?php e_head(); ?>


<div id="MainPageBackground">

    <?php
    if($page == 'index' && $_SESSION['auth'] == 'no'){
    ?>
	<div <?php if($page != "index"){?> class="navbar navbar-inverse navbar-fixed-top"<?php }?> >
    	<div class="page_header" id="PageHeader">

		<?php if($page != "index")
            {
            ?>
                <div class="logo_height">
                    <a href="<?=DB_DOMAIN ?>index.php" title="<?=$HEADER_META_TITLE ?>">
                        <div id="ImageLogo">					
                            <p class="<? if( TMP_LOGO_ICON =="images/DEFAULT/LOGOS/none.png"){ print "p3"; }else{ print "p1"; } ?>"><? if(TMP_LOGO_HIDE ==0){ ?><?=TMP_LOGO ?><? } ?></p>					
                            <p class="p2"><? if(TMP_LOGO_HIDE ==0){ ?><?=TMP_LOGO_SLOGAN ?><? } ?></p>
                        </div>
                    </a>
                </div>
            <?php
             }
            ?>
			
            <div class="right-head" style=" <?php if($page == "index"){?> margin:21px 20px 0px 0px; <?php } ?>">
                <!--4-->
               <?php

                if(isset($_SESSION['lang'])){
                    $lang = $_SESSION['lang'];
                    $$lang = "selected = 'selected'";
                }
                else{
                    $english = "selected = 'selected'";
                }

                
                ?>
                <form class="f_left">
                    <select class="language f_left padding_5" name="lang" id="lang" onchange="location = this.options[this.selectedIndex].value;"> 
                        <option value="/index.php?l=english" <?php if(isset($english)){ echo $english;}?>>English</option>
                        <option value="/index.php?l=bosnian" <?php if(isset($bosnian)){ echo $bosnian;}?>>Bosnian</option>
                        <option value="/index.php?l=turkey" <?php if(isset($turkey)){ echo $turkey;}?>>Turkey</option>
                        <option value="/index.php?l=spanish" <?php if(isset($spanish)){ echo $spanish;}?>>Spanish</option>
                        <option value="/index.php?l=russian" <?php if(isset($russian)){ echo $russian;}?>>Russian</option>
                        <option value="/index.php?l=czech" <?php if(isset($czech)){ echo $czech;}?>>Czech</option>
                        <option value="/index.php?l=japanese" <?php if(isset($japanese)){ echo $japanese;}?>>Japanese</option>
                        <option value="/index.php?l=slovenian" <?php if(isset($slovenian)){ echo $slovenian;}?>>Slovenian</option>
                        <option value="/index.php?l=swedish" <?php if(isset($swedish)){ echo $swedish;}?>>Swedish</option>
                        <option value="/index.php?l=slovak" <?php if(isset($slovak)){ echo $slovak;}?>>Slovak</option>
                        <option value="/index.php?l=thai" <?php if(isset($thai)){ echo $thai;}?>>Thai</option>
                        <option value="/index.php?l=danish" <?php if(isset($danish)){ echo $danish;}?>>Danish</option>
                        <option value="/index.php?l=chinese" <?php if(isset($chinese)){ echo $chinese;}?>>Chinese</option>
                        <option value="/index.php?l=romanian" <?php if(isset($romanian)){ echo $romanian;}?>>Romanian</option>
                        <option value="/index.php?l=german" <?php if(isset($german)){ echo $german;}?>>German</option>
                        <option value="/index.php?l=italian" <?php if(isset($italian)){ echo $italian;}?>>Italian</option>
                        <option value="/index.php?l=vietnamese" <?php if(isset($vietnamese)){ echo $vietnamese;}?>>Vietnamese</option>
                        <option value="/index.php?l=arabic" <?php if(isset($arabic)){ echo $arabic;}?>>Arabic</option>
                        <option value="/index.php?l=portugues" <?php if(isset($portugues)){ echo $portugues;}?>>Portugues</option>
                        <option value="/index.php?l=norwegian" <?php if(isset($norwegian)){ echo $norwegian;}?>>Norwegian</option>
                        <option value="/index.php?l=dutch" <?php if(isset($dutch)){ echo $dutch;}?>>Dutch</option>
                        <option value="/index.php?l=korean" <?php if(isset($korean)){ echo $korean;}?>>Korean</option>
                        <option value="/index.php?l=croatian" <?php if(isset($croatian)){ echo $croatian;}?>>Croatian</option>
                        <option value="/index.php?l=taiwanese" <?php if(isset($taiwanese)){ echo $taiwanese;}?>>Taiwanese</option>
                        <option value="/index.php?l=polish" <?php if(isset($polish)){ echo $polish;}?>>Polish</option>
                        <option value="/index.php?l=french" <?php if(isset($french)){ echo $french;}?>>French</option>
                        <option value="/index.php?l=greek" <?php if(isset($greek)){ echo $greek;}?>>Greek</option>
                    </select>
                    <? if(my_logged_in){ ?>
                    <? }elseif($page == "index"){ ?>
                        <a href="/index.php?dll=login" style="text-decoration:none; background-color:white; margin-left:18px; padding: 5px 14px; line-height: 25px;">Login Here</a>
                    <? } ?>
                </form>
                <!--4-->
            </div>
        
			 <?php if($page != "index")
			 {
			 ?>
                <div id="top_banner" class="hiddenonsmall"><? foreach($BANNER_ARRAY as $banner){ if($banner['position'] =="top"){ print $banner['display'];}} ?></div>	 
           
            
 			<?php
             }
            ?>
            
            
            <div class="nav_button hidden-lg hidden-md">
            	<span style="padding-left:12px;">
				    <span>
                    	<a href="<?=DB_DOMAIN ?>index.php?dll=search&page=1&online=1" style="color:#fff;">
							<?=CountOnline() ?> <?=$GLOBALS['_LANG']['_members']." ".$GLOBALS['_LANG']['_online'] ?>
                         </a>
                    </span>
			    </span>	
               <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mynav">
                 <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                 <span class="icon-bar"></span>
            </button>
            </div>
            
             
            <div class="menu" id="MenuBar" style=" <?php if($page == "index"){?> margin:21px 0px 0px 0px; <?php } ?>"><!--3-->
          
            
            <div class="collapse navbar-collapse" id="mynav">
            
                <ul class="tabs nav navbar-nav">
                    <?=$HEADER_MENU_BAR_TOP ?>
                    <div class="hidden-md hidden-lg">
                     <?=$HEADER_MENU_BAR_SUB ?>
                     </div>
                </ul>	
                
                
                
                </div>
                		
            </div>
           
          
            <div class="sub_menu hidden-xs hidden-sm"> 
   				<ul class="sub_tabs f_left">
				    <?=$HEADER_MENU_BAR_SUB ?>	
			    </ul>
    			<span style="float:right;padding:4px;">
				    <span class="onlinenow">
                    	<a href="<?=DB_DOMAIN ?>index.php?dll=search&page=1&online=1">
							<?=CountOnline() ?> <?=$GLOBALS['_LANG']['_members']." ".$GLOBALS['_LANG']['_online'] ?>
                         </a>
                    </span>
			    </span>			
            </div>
		</div>
    </div>
    <?php
    }
    else{
    funcLayoutUserHeader($page,$BANNER_ARRAY,$HEADER_MENU_BAR_TOP,$HEADER_MENU_BAR_SUB,$HEADER_MENU_BAR_QUICK_LINKS);
    }
    ?>

	<div <?php if($page != "index"){?> class="wide_wrapper" <?php } ?>>
    	
        <?php echo getHeaderBreadCrumb($page, $sub_page, $LANG_HEADINGS, $LANG_BREADCRUMB); ?>

        <?php $fdata = DisplayFeaturedMembersTop(12,1); ?>
		
		<?php
    if(isset($_SESSION['auth']) && $_SESSION['auth'] =="yes" && D_FEATUREDMEMBERTOP2 == '1'){
    ?>
    <div id="featured_members" class="featured_members_<?=D_HEADER_LAYOUT?>">
        <div id="style5" style="margin-top:15px; float: left;">
        <div class="previous_button"></div><div class="container cont-slider">
            <ul> 
                <? foreach( $fdata as $value){ ?>
                <li><a href="<?=$value['link'] ?>"><img src="<?=$value['image'] ?>" width="96" height="96" border="0" style="cursor:pointer;"></a><br>
                </li><? } ?>
                

            </ul>

        </div>
        <div class="next_button"></div></div>
    </div>  
    <?php
    }
    ?>

    <div id="page_container"  class="page-container-<?=D_HEADER_LAYOUT?>">