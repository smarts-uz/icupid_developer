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

    if(isset($_SESSION['auth']) && $_SESSION['auth'] =="no"){ ?>

    <script>
    $(document).ready(function(){
        $(".login-btn").click(function(){
            $(".login-top").slideToggle();
            return false;
        });
    
    });
    </script>
    <?php
    }
    else{
    ?>

    <script>
    function runTest() {

        hCarousel = new UI.Carousel("style4");

    }

    Event.observe(window, "load", runTest);

    </script>
    
<?php
}
?>
<style>

#style4 ul { margin: 0; padding: 0; width: 100000px; position: relative; top: 0; left: 0; height: 70px; /*margin-top: 11px; */}
#style4 ul li { color:white; width: 76px; height: 75px; text-align: center; list-style: none; float: left; margin-left: 0px; margin-right: 0px; }
#style4 ul li img { width: 75px; height: 75px; text-align: center; }
#style4 .container { float: left; width: 402px; height: 100px; position: relative; overflow: hidden;     max-width: 864px !important; width: auto !important;}
#style4 .previous_button {  background: url(/inc/templates/<?=D_TEMP ?>/images/arrow_left.jpg) no-repeat; border-top-left-radius: 5px;border-bottom-left-radius: 5px;background-size: 38px 76px; width:38px; height:76px; z-index: 100; float: left; }
#style4 .previous_button_over {  background: url(/inc/templates/<?=D_TEMP ?>/images/arrow_left.jpg) no-repeat; border-top-left-radius: 5px;border-bottom-left-radius: 5px;background-size: 38px 76px; width:38px; height:76px; }
#style4 .previous_button_disabled {  background: url(/inc/templates/<?=D_TEMP ?>/images/arrow_left.jpg) no-repeat; border-top-left-radius: 5px;border-bottom-left-radius: 5px;background-size: 38px 76px; width:38px; height:76px; }
#style4 .next_button {   background: url(/inc/templates/<?=D_TEMP ?>/images/arrow_right.jpg) no-repeat; background-size: 38px 76px; border-top-right-radius: 5px;border-bottom-right-radius: 5px; width:38px; height:76px; z-index: 100; float: left; }
#style4 .next_button_over {  background: url(/inc/templates/<?=D_TEMP ?>/images/arrow_right.jpg) no-repeat; border-top-right-radius: 5px;border-bottom-right-radius: 5px;background-size: 38px 76px; width:38px; height:76px; }
#style4 .next_button_disabled {  background: url(/inc/templates/<?=D_TEMP ?>/images/arrow_right.jpg) no-repeat; border-top-right-radius: 5px;border-bottom-right-radius: 5px;background-size: 38px 76px; width:38px; height:76px; }
</style>
</head>

<?php if(isset($HEADER_SINGLE_COLUMN)){ ?>
<body id="splitpage" <?=$HEADER_ON_LOAD ?>>
<?php }else{ ?>
<body id="fullpage" <?=$HEADER_ON_LOAD ?>>
<?php } ?>
<?php e_head(); ?>


<div id="MainPageBackground">
     
     <?php

     funcLayoutUserHeader($page,$BANNER_ARRAY,$HEADER_MENU_BAR_TOP,$HEADER_MENU_BAR_SUB,$HEADER_MENU_BAR_QUICK_LINKS);

     ?>
    <div <?php if($page != "index"){?> class="wide_wrapper" <?php } ?>>
        
        <?php
        if(D_BREADCRUMBS == 'yes' && $page != "overview"){
        
            echo getHeaderBreadCrumb($page, $sub_page, $LANG_HEADINGS, $LANG_BREADCRUMB);
        }
        
        $fdata = DisplayFeaturedMembersTop(25,1); 
        
        ?>
        
        <?php
        if(isset($_SESSION['auth']) && $_SESSION['auth'] =="yes" && D_FEATUREDMEMBERTOP2 == '1'){
        ?>
            <div id="featured_members" class="featured_members_<?=D_HEADER_LAYOUT?>">
            <div id="style4" style="margin-top:15px; float: left;">
            <div class="previous_button"></div><div class="container cont-slider">
                <ul> 
                    <?php  foreach( $fdata as $value){ 
                    
                    ?>
                    <li><a href="<?=$value['link'] ?>"><img src="<?=$value['image'] ?>" width="96" height="96" border="0" style="cursor:pointer;"></a></li><?php } ?>
                    

                </ul>

            </div>
            <div class="next_button"></div></div>
        </div>  
        <?php
        }
        ?>
        <div id="page_container"  class="page-container-<?=D_HEADER_LAYOUT?>">
            