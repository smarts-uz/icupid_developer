<?php

## block direct page access

defined( 'KEY_ID' ) or die( 'Restricted access' );

?>
<div id="main">         
    <div id="main_content_wrapper">     


<div class="clear"></div>

<?php  if(isset($ERROR_MESSAGE) && strlen($ERROR_MESSAGE) > 3){ ?>
<div id="messages">
	
	<div style="" class="message-<?=$ERROR_TYPE ?>" id="main-message-<?=$ERROR_TYPE ?>">
    	<a class="dismiss-message" href="#" onclick="$('#main-message-<?=$ERROR_TYPE ?>').fadeOut(); return false;"><img src="/images/DEFAULT/_icons/16/menu.gif"></a>
      	<?=$ERROR_MESSAGE ?>
    </div>
</div>
<?php  } ?>
<?php  
foreach($BANNER_ARRAY as $banner){ 
	if($banner['position'] =="middle"){ ?>
	<div class="middle_banner"><?php  print $banner['display'];?></div>
	<?php  
	}
}
?>






<?php  if(isset($show_page) && ( $show_page=="edit" ||  $show_page=="design" ||  $show_page=="video"  ) ){  ?>



<link rel="stylesheet" href="<?=DB_DOMAIN ?>inc/css/_profile.css" type="text/css">

<!-- css -->
<link rel="stylesheet" href="<?=DB_DOMAIN?>inc/css/cslide/base.css" />
<link rel="stylesheet" href="<?=DB_DOMAIN?>inc/css/cslide/style.css" />
    
<!-- js -->
<script src="<?=DB_DOMAIN?>inc/js/cslide/jquery-1.9.1.min.js"></script>
<script src="<?=DB_DOMAIN?>inc/js/cslide/jquery.cslide.js" type="text/javascript"></script>
<script>
$(document).ready(function(){
    $("#cslide-slides").cslide();
});
</script>


<?php

$paagination = DisplayAccountPagination($_SESSION['uid']);

//echo $paagination;
?>

<?php /*<div id="eMeeting" class="user">

  <div class="header account_tabs">

    <ul>

	 	<li <?php  if($show_page=="edit"){ ?>class="selected"<?php  } ?>><a href="<?=DB_DOMAIN ?>index.php?dll=account&sub=edit"><span><?=$SubSub_Lang['edit'] ?></span></a></li>

		<?php  if(D_DESIGNER ==1){ ?><li class="hidden-xs hidden-sm <?php  if($show_page=="design"){ ?>selected<?php  } ?>"><a href="<?=DB_DOMAIN ?>index.php?dll=account&sub=design"><span><?=$SubSub_Lang['design'] ?></span></a></li><?php  } ?>

		<?php  if(FLASH_VIDEO =="yes"){ ?><li <?php  if($show_page=="video"){ ?>class="selected"<?php  } ?>><a href="<?=DB_DOMAIN ?>index.php?dll=account&sub=video"><span><?=$SubSub_Lang['video'] ?></span></a></li><?php  } ?>

    </ul>

    <div class="ClearAll"></div>

 </div>

</div>

<br>*/

} ?>


<?php  if(isset($show_page) && $show_page=="home"){ 

	 /**

	 * Page: Account Options

	 *

	 * @version  8.0

	 * @created  Fri Jan 18 10:48:31 EEST 2008

	 * @updated  Fri Sep 24 16:28:31 EEST 2008

	 */


?>

<!--<b class="b1f"></b><b class="b2f"></b><b class="b3f"></b><b class="b4f"></b>-->

<div class="contentf" style="width:94%;margin:3%;"><div>

<b class="i1f"></b>
<b class="i2f"></b>
<b class="i3f"></b>
<b class="i4f"></b>
<div class="contenti" style="margin-left:0px;">

	<style>

	.s1 { background: url(images/DEFAULT/_icons/new/acc/acc_1.png) no-repeat; background-position: 0% 50%}

	.s2 { background: url(images/DEFAULT/_icons/new/acc/acc_2.png) no-repeat; background-position: 0% 50%}

	.s3 { background: url(images/DEFAULT/_icons/new/acc/acc_3.png) no-repeat; background-position: 0% 50%}

	.s4 { background: url(images/DEFAULT/_icons/new/acc/acc_4.png) no-repeat; background-position: 0% 50%}

	.s5 { background: url(images/DEFAULT/_icons/new/acc/acc_5.png) no-repeat; background-position: 0% 50%}

	.s6 { background: url(images/DEFAULT/_icons/new/acc/acc_6.jpg) no-repeat; background-position: 0% 50%}

	.s7 { background: url(images/DEFAULT/_icons/new/acc/acc_7.jpg) no-repeat; background-position: 0% 50%}

	.s8 { background: url(images/DEFAULT/_icons/new/acc/acc_8.jpg) no-repeat; background-position: 0% 50%}

	.s9 { background: url(images/DEFAULT/_icons/new/acc/acc_9.jpg) no-repeat; background-position: 0% 50%}

	.s10 { background: url(images/DEFAULT/_icons/new/acc/acc_10.jpg) no-repeat; background-position: 0% 50%}

	.s11 { background: url(images/DEFAULT/_icons/new/acc/acc_12.jpg) no-repeat; background-position: 0% 50%}

	@media(max-width:550px){
		ul.Acc_Heading_List .s4 {
	    display: none;
		}
	}
	</style>

	

	<?=BuildPageHomeMenu($SubSub_Lang, $page) ?>

		
	<br><br>

</div>

<b class="i4f"></b>
<b class="i3f"></b>
<b class="i2f"></b>
<b class="i1f"></b>
</div>
</div>

<b class="b4f"></b>
<b class="b3f"></b>
<b class="b2f"></b>
<b class="b1f"></b>

	

	

	<div class="ClearAll"></div>















<?php  }elseif(isset($show_page) && $show_page=="edit"){ 



	 /**

	 * Page: Account Edit Profile Page

	 *

	 * @version  8.0

	 * @created  Fri Jan 18 10:48:31 EEST 2008

	 * @updated  Fri Sep 24 16:28:31 EEST 2008

	 */



?>
<div class="contentf" style="width:94%;margin:3%;"><div>

<style type="text/css">
	#main{
		background-color: transparent;
	}
</style>


	<form method="post" action="<?=DB_DOMAIN ?>index.php"  name="MemberSearch" id="MemberSearch">

	<input name="do" type="hidden" value="edit" class='hidden'>

	<input name="do_page" type="hidden" value="account" class="hidden">

	<input name="sub" type="hidden" value="edit" class="hidden">

	<?php  if(isset($_SESSION['site_moderator_edit']) && $_SESSION['site_moderator_edit'] =="yes" && isset($_GET['id']) && is_numeric($_GET['id']) ){ ?>	

	<input name="eid" type="hidden" value="<?=$_GET['id'] ?>" class="hidden">	

	<?php  }else{ ?>

	<input name="eid" type="hidden" value="<?=$_SESSION['uid'] ?>" class="hidden">	

	<?php  } ?>

	<input type="hidden" value="1" name="StopConfigStrip"/>

	<script src="<?=DB_DOMAIN ?>inc/js/_extras/_date.js"></script>

	<ul id="cslide-slides" class="cslide-slides-master clearfix form form-boxed">
	    
	    <div class="cslide-slides-container clearfix">
			<?=$profile_details ?>
		</div>
	</ul>
	

	</form>
	

<script type="text/javascript">

$('.cslidee-nexttt,.btn-register').click(function() {
var slidesContainerId = '#cslide-slides';
var i = $(slidesContainerId+" .cslide-slide.cslide-active").index();
var n = i+1;
var btn_id = $(this).attr('id');
var field_ids = $(this).attr('data-fields');
var res = btn_id.split('_');
var chckids = field_ids.split(',');
var valid_error = 0;
var ques_lab = ($('.ques_label').attr('data-count'));

for(var i = 0; i < chckids.length; i++){
	
	//new field
	$('.field_id_'+chckids[i]).each(function() {
         
		if(($(this).val()=='' || $(this).val()== '0') && $(this).attr('type') != 'checkbox')
		{
			//alert('Not checkbox');
			$(this).addClass('has-error');
			$(this).next('p').css('display','block');
			$(this).next('p').html('<img src="/images/DEFAULT/_icons/16/alert.gif"> This field is required');
			valid_error = 1
		} else if($(this).attr('type') == 'checkbox' && $('.field_id_'+chckids[i]+':checked').length <= 0) {
			//alert('checkbox');
			
			$('.validate_field_id_'+chckids[i]).css('display','block');
			$('.validate_field_id_'+chckids[i]).html('<img src="/images/DEFAULT/_icons/16/alert.gif"> This field is required');

			valid_error = 1
		}else {
            
            	$(this).removeClass('has-error');
				$(this).next('p').css('display','none');
				$('.validate_field_id_'+chckids[i]).css('display','none');
				$(this).next('p').empty();
				$('.validate_field_id_'+chckids[i]).empty();
           
    //         	$(this).removeClass('has-error');
				// $(this).next('p').css('display','none');
				// $('.checkbox_valid').css('display','none');
				// $(this).next('p').empty();
				// $('.checkbox_valid').empty();
            
			
			
		}  

	});

}

//old field 
/*$('.fieldGroup_'+res[1]).each(function() {
	if(($(this).val()=='' || $(this).val()== '0') && $(this).attr('type') != 'checkbox')
	{
		$(this).addClass('has-error');
		$(this).next('p').css('display','block');
		$(this).next('p').html('<img src="/images/DEFAULT/_icons/16/alert.gif"> This field is required');
		valid_error = 1
	} 
	else if($(this).attr('type') == 'checkbox') {
		if($('.data-fields:checked').length <= 0) {
			$('.checkbox_valid').css('display','block');
			$('.checkbox_valid').html('<img src="/images/DEFAULT/_icons/16/alert.gif"> This field is required');
			valid_error = 1	
		} 

		else {
			
			
		}
		
		
		//console.log(valid_error);
	}else {

		$(this).removeClass('has-error');
		$(this).next('p').css('display','none');
		$('.checkbox_valid').css('display','none');
		$(this).next('p').empty();
		$('.checkbox_valid').empty();
	}  
});*/
//alert(valid_error);
if(valid_error == 1) {
	return false;
}else {
        	
        if (!$(slidesContainerId+" .cslide-slide.cslide-active").hasClass("cslide-last")) {
            
            $("#reg-pagination .active").addClass('visited').removeClass('active');
            $("#reg-pagination .step").each(function(){
                if(!$(this).hasClass('visited')){
                    $(this).addClass('active');
                    return false;
                }
            });

        }

        var slideLeft = "-"+n*100+"%";
        //alert('slideLeft'+slideLeft);
        if (!$(slidesContainerId+" .cslide-slide.cslide-active").hasClass("cslide-last")) {
            $(slidesContainerId+" .cslide-slide.cslide-active").removeClass("cslide-active").next(".cslide-slide").addClass("cslide-active");
            $(slidesContainerId+" .cslide-slides-container").animate({
                marginLeft : slideLeft
            },250);
            if ($(slidesContainerId+" .cslide-slide.cslide-active").hasClass("cslide-last")) {
                $(slidesContainerId+" .cslide-next").addClass("cslide-disabled");
            }
        }
        if ((!$(slidesContainerId+" .cslide-slide.cslide-active").hasClass("cslide-first")) && $(".cslide-prev").hasClass("cslide-disabled")) {
            $(slidesContainerId+" .cslide-prev").removeClass("cslide-disabled");
        }
        
        $('html, body').animate({
            scrollTop: $("#reg-pagination").offset().top
        }, 1000);
            
}

});

</script>

    </div></div>

<?php  }elseif($show_page=="design" && D_DESIGNER =="1"){ 



	 /**

	 * Page: Account Profile Designer

	 *

	 * @version  8.0

	 * @created  Fri Jan 18 10:48:31 EEST 2008

	 * @updated  Fri Sep 24 16:28:31 EEST 2008

	 */



?>


<div class="hidden-sm">


<form method="post" action="<?=DB_DOMAIN ?>index.php"  enctype="multipart/form-data" name="cssform">

<input name="do" type="hidden" value="design" class='hidden'>

<input name="do_page" type="hidden" value="account" class="hidden">

<input name="sub" type="hidden" value="design" class="hidden">





<iframe id="PreviewFrame" src="<?= getThePermalink('user',array('username' => $_SESSION['username']))?>" frameborder="0" style="width:650px; height:500px; border:3px dashed #cccccc; margin-top:10px;"></iframe>





<table width="650"><tr valign="top"><td width="312">

 



<ul class="form" id="form1" style="display:visible"> 



	<div class="menu_box_title1" onClick="toggleLayer('bb1');" style="cursor:pointer;"><span><img src="<?=DB_DOMAIN ?>images/DEFAULT/blank.gif" width="30" height="29" onClick="expandcontent(this,'s1')" class="menu_noexpand"></span> 

	<img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/add.png" align="absmiddle"> <?=$GLOBALS['LANG_ACCOUNT']['5'] ?></div>

	

	<div class="CapBody" style="display:none" id="bb1">



<li><label><?=$GLOBALS['LANG_ACCOUNT']['9'] ?>: </label><select onChange="UpdateFrame('font1', this.value); return false;" class="input" name="f2" style="width:220px; font-size:14px; height:25px;"><option value="Andale Mono" <?php  if($myTheme['font2'] =="no-repeat"){ print "selected"; } ?>>Andale Mono</option><option value="Helvetica Neue" <?php  if($myTheme['font2'] =="Helvetica Neue"){ print "selected"; } ?>>Helvetica Neue</option><option value="Arial Black" <?php  if($myTheme['font2'] =="Arial Black"){ print "selected"; } ?>>Arial Black</option><option value="Comic Sans MS" <?php  if($myTheme['font2'] =="omic Sans MS"){ print "selected"; } ?>>Comic Sans MS</option><option value="Courier New" <?php  if($myTheme['font2'] =="Courier New"){ print "selected"; } ?>>Courier New</option><option value="Futura" <?php  if($myTheme['font2'] =="Futura"){ print "selected"; } ?>>Futura</option><option value="Georgia" <?php  if($myTheme['font2'] =="Georgia"){ print "selected"; } ?>>Georgia</option><option value="Gill Sans" <?php  if($myTheme['font2'] =="Gill Sans"){ print "selected"; } ?>>Gill Sans</option><option value="Impact" <?php  if($myTheme['font2'] =="Impact"){ print "selected"; } ?>>Impact</option><option value="Lucida Grande" <?php  if($myTheme['font2'] =="Lucida Grande"){ print "selected"; } ?>>Lucida Grande</option><option value="Times New Roman" <?php  if($myTheme['font2'] =="Times New Roman"){ print "selected"; } ?>>Times New Roman</option><option value="Trebuchet MS" <?php  if($myTheme['font2'] =="Trebuchet MS"){ print "selected"; } ?>>Trebuchet MS</option><option value="Verdana" <?php  if($myTheme['font2'] =="Verdana"){ print "selected"; } ?>>Verdana</option></select></li>



			<li><label><?=$GLOBALS['LANG_ACCOUNT']['10'] ?>: </label><select class="input" name="f1" style="width:220px; font-size:14px; height:25px;"><option value="Andale Mono" <?php  if($myTheme['font1'] =="no-repeat"){ print "selected"; } ?>>Andale Mono</option><option value="Helvetica Neue" <?php  if($myTheme['font1'] =="Helvetica Neue"){ print "selected"; } ?>>Helvetica Neue</option><option value="Arial Black" <?php  if($myTheme['font1'] =="Arial Black"){ print "selected"; } ?>>Arial Black</option><option value="Comic Sans MS" <?php  if($myTheme['font1'] =="omic Sans MS"){ print "selected"; } ?>>Comic Sans MS</option><option value="Courier New" <?php  if($myTheme['font1'] =="Courier New"){ print "selected"; } ?>>Courier New</option><option value="Futura" <?php  if($myTheme['font1'] =="Futura"){ print "selected"; } ?>>Futura</option><option value="Georgia" <?php  if($myTheme['font1'] =="Georgia"){ print "selected"; } ?>>Georgia</option><option value="Gill Sans" <?php  if($myTheme['font1'] =="Gill Sans"){ print "selected"; } ?>>Gill Sans</option><option value="Impact" <?php  if($myTheme['font1'] =="Impact"){ print "selected"; } ?>>Impact</option><option value="Lucida Grande" <?php  if($myTheme['font1'] =="Lucida Grande"){ print "selected"; } ?>>Lucida Grande</option><option value="Times New Roman" <?php  if($myTheme['font1'] =="Times New Roman"){ print "selected"; } ?>>Times New Roman</option><option value="Trebuchet MS" <?php  if($myTheme['font1'] =="Trebuchet MS"){ print "selected"; } ?>>Trebuchet MS</option><option value="Verdana" <?php  if($myTheme['font1'] =="Verdana"){ print "selected"; } ?>>Verdana</option></select></li>

	<li><input value="<?=$GLOBALS['_LANG']['_save'] ?>" type="submit" class="MainBtn"></li>		

	</div>



</ul>	







<ul class="form" id="form2" style="display:visible"> 



	<div class="menu_box_title1" onClick="toggleLayer('bb2');" style="cursor:pointer;"><span><img src="<?=DB_DOMAIN ?>images/DEFAULT/blank.gif" width="30" height="29" onClick="expandcontent(this,'s1')" class="menu_noexpand"></span> 

	<img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/add.png" align="absmiddle"> <?=$GLOBALS['LANG_ACCOUNT']['6'] ?>

	</div>

	<div class="CapBody" style="display:none" id="bb2">



	<li style="border:2px dashed #999999 cursor:pointer; padding:5px; color:#333333;" onclick="getColor('b1')"><label>&nbsp;&nbsp;&nbsp;<?=$GLOBALS['LANG_ACCOUNT']['11'] ?>: </label><input name="b1" id="b1" type="text" value="<?=$myTheme['background'] ?>" maxlength="10" style="background-color:<?=$myTheme['background'] ?>; width:210px; font-size:14px; height:25px;background-image:none;" class="input"></li>



 	[ <a href="javascript:void(0);" onClick="toggleLayer('myBodyBG');"><?=$GLOBALS['LANG_ACCOUNT']['12'] ?></a> ] 

	

	<span id="myBodyBG" style="display:none">



	<p style="background:#DCFADD; border:3px dashed #999999; padding:10px; color:#666666;">



		 <label><?=$GLOBALS['LANG_ACCOUNT']['13'] ?>: </label><input name="b2" type="file" style="width:50px;">  



		<?php  $cT = $myTheme['background_image_display']; ?>

		<label><?=$GLOBALS['LANG_ACCOUNT']['14'] ?>: </label> <select name="b3" style="width:200px; font-size:14px; height:25px;"><option value="no-repeat" <?php  if($cT =="no-repeat"){ print "selected"; } ?>><?=$GLOBALS['LANG_ACCOUNT']['23'] ?></option><option value="repeat" <?php  if($cT =="repeat"){ print "selected"; } ?>><?=$GLOBALS['LANG_ACCOUNT']['24'] ?></option><option value="repeat-y"<?php  if($cT =="repeat-y"){ print "selected"; } ?>><?=$GLOBALS['LANG_ACCOUNT']['25'] ?></option> <option value="repeat-x" <?php  if($cT =="repeat-x"){ print "selected"; } ?>><?=$GLOBALS['LANG_ACCOUNT']['26'] ?></option></select>

		<?php  if(isset($myTheme['background_image']) && $myTheme['background_image'] !=""){ ?>

			<img src="<?=WEB_PATH_FILES.$myTheme['background_image'] ?>" width="50" height="50" onclick="NewpopUpWin('<?=WEB_PATH_FILES.$myTheme['background_image'] ?>','500','500')">

			<br><br><input name="bremove" type="checkbox" value="1"> <?=$GLOBALS['LANG_ACCOUNT']['15'] ?>

		<?php  } ?>

	</p>



	</span>

	<hr>

	

	

	<li style="border:2px dashed #999999 cursor:pointer; padding:5px; color:#333333;" onclick="getColor('i2')"><label>&nbsp;&nbsp;&nbsp;<?=$GLOBALS['LANG_ACCOUNT']['16'] ?>: </label><input name="i2" id="i2" type="text" value="<?=$myTheme['inner_background'] ?>" maxlength="10" style="background-color:<?=$myTheme['inner_background'] ?>; width:210px; font-size:14px; height:25px; background-image:none;" class="input"> </li>

	



<li><input value="<?=$GLOBALS['_LANG']['_save'] ?>" type="submit" class="MainBtn"></li>

	</div>



</ul>





<ul class="form" id="form3" style="display:visible">



	<div class="menu_box_title1" onClick="toggleLayer('bb3');" style="cursor:pointer;"><span><img src="<?=DB_DOMAIN ?>images/DEFAULT/blank.gif" width="30" height="29" onClick="expandcontent(this,'s1')" class="menu_noexpand"></span> <img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/add.png" align="absmiddle"> <?=$GLOBALS['LANG_ACCOUNT']['7'] ?></div> 

	<div class="CapBody" style="display:none" id="bb3">



	<li style="border:2px dashed #999999 cursor:pointer; padding:5px; color:#333333;" onclick="getColor('h1')">

	  <label>&nbsp;&nbsp;&nbsp;<?=$GLOBALS['LANG_ACCOUNT']['17'] ?>:</label>

	  <input name="h1" id="h1" type="text" value="<?=$myTheme['header_background'] ?>" maxlength="10" style="background-color:<?=$myTheme['header_background'] ?>; width:210px; font-size:14px; height:25px;background-image:none;" class="input"></li>

	<hr>

<div class="ClearAll"></div>

	[ <a href="javascript:void(0);" onClick="toggleLayer('myHeadBG');"><?=$GLOBALS['LANG_ACCOUNT']['12'] ?></a> ]



	<span id="myHeadBG" style="display:none">



		<p style="background:#DCFADD; border:3px dashed #999999; padding:10px; color:#666666;">

			<label><?=$GLOBALS['LANG_ACCOUNT']['13'] ?>: </label><input name="h2" type="file"  style="width:50px;"> 

			<?php  $cT = $myTheme['header_image_display']; ?>

			<label><?=$GLOBALS['LANG_ACCOUNT']['14'] ?>: </label> <select name="h3" class="input" style="width:200px; font-size:14px; height:25px;" ><option value="no-repeat" <?php  if($cT =="no-repeat"){ print "selected"; } ?>><?=$GLOBALS['LANG_ACCOUNT']['23'] ?></option><option value="repeat" <?php  if($cT =="repeat"){ print "selected"; } ?>><?=$GLOBALS['LANG_ACCOUNT']['24'] ?></option><option value="repeat-y"<?php  if($cT =="repeat-y"){ print "selected"; } ?>><?=$GLOBALS['LANG_ACCOUNT']['25'] ?></option> <option value="repeat-x" <?php  if($cT =="repeat-x"){ print "selected"; } ?>><?=$GLOBALS['LANG_ACCOUNT']['26'] ?></option></select>

		

			<?php  if(isset($myTheme['header_image']) && $myTheme['header_image'] !=""){ ?>

			<img src="<?=WEB_PATH_FILES.$myTheme['header_image'] ?>" width="50" height="50" onclick="NewpopUpWin('<?=WEB_PATH_FILES.$myTheme['header_image'] ?>','500','500')">

			<br><br> <input name="hremove" type="checkbox" value="1" class="input" > <?=$GLOBALS['LANG_ACCOUNT']['15'] ?>

			<?php  } ?>

		</p>



	</span>

	<hr>



	<li style="border:2px dashed #999999 cursor:pointer; padding:5px; color:#333333;" onclick="getColor('h0')"><label>&nbsp;&nbsp;&nbsp;<?=$GLOBALS['LANG_ACCOUNT']['18'] ?>: </label><input name="h0" id="h0" type="text" class="input" value="<?=$myTheme['header_text'] ?>" maxlength="10" style="background-color:<?=$myTheme['header_text'] ?>; width:210px; font-size:14px; height:25px;background-image:none;"></li><hr>

<li><input value="<?=$GLOBALS['_LANG']['_save'] ?>" type="submit" class="MainBtn"></li>

	</div>



</ul>	





<ul class="form" id="form4" style="display:visible">



	<div class="menu_box_title1" onClick="toggleLayer('bb4');" style="cursor:pointer;"><span><img src="<?=DB_DOMAIN ?>images/DEFAULT/blank.gif" width="30" height="29" onClick="expandcontent(this,'s1')" class="menu_noexpand"></span> <img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/add.png" align="absmiddle"> <?=$GLOBALS['LANG_ACCOUNT']['8'] ?> </div> 

	<div class="CapBody" style="display:none" id="bb4">



	<li style="border:2px dashed #999999 cursor:pointer; padding:5px; color:#333333;" onclick="getColor('t1')">

	  <label><?=$GLOBALS['LANG_ACCOUNT']['19'] ?>: </label>

	  <input name="t1" id="t1" type="text" value="<?=$myTheme['color_text'] ?>" maxlength="10" style="background-color:<?=$myTheme['color_text'] ?>; width:210px; font-size:14px; height:25px;background-image:none;" class="input"></li><hr>

	<li style="border:2px dashed #999999 cursor:pointer; padding:5px; color:#333333;" onclick="getColor('t2')">

	  <label><?=$GLOBALS['LANG_ACCOUNT']['20'] ?>: </label>

	  <input name="t2" id="t2" type="text" value="<?=$myTheme['color_link'] ?>" maxlength="10" style="background-color:<?=$myTheme['color_link'] ?>; width:210px; font-size:14px; height:25px;background-image:none;" class="input"></li><hr>

	<li style="border:2px dashed #999999 cursor:pointer; padding:5px; color:#333333;" onclick="getColor('s1')">

	  <label><?=$GLOBALS['LANG_ACCOUNT']['21'] ?>: </label>

	  <input name="s1" type="text" id="s1" value="<?=$myTheme['subheader_title'] ?>" maxlength="10" style="background-color:<?=$myTheme['subheader_title'] ?>; width:210px; font-size:14px; height:25px;background-image:none;" class="input"></li><hr>

	<li style="border:2px dashed #999999 cursor:pointer; padding:5px; color:#333333;" onclick="getColor('s2')"><label><?=$GLOBALS['LANG_ACCOUNT']['22'] ?>: </label>

	  <input name="s2" type="text" id="s2" value="<?=$myTheme['subheader_background'] ?>" maxlength="10" style="background-color:<?=$myTheme['subheader_background'] ?>; width:210px; font-size:14px; height:25px;background-image:none;" class="input"></li><hr>

	<li><input value="<?=$GLOBALS['_LANG']['_save'] ?>" type="submit" class="MainBtn"></li>	



	</div>



</ul>

 



</td> <td width="328">

<div style="border:1px dashed #999999; padding:10px; background:#eeeeee; margin-top:10px; line-height:30px;"><?=$GLOBALS['LANG_ACCOUNT']['29'] ?></div>





</td></tr></table>







</form>

<hr>

<form method="post" action="<?=DB_DOMAIN ?>index.php">

<input name="do" type="hidden" value="design" class='hidden'>

<input name="do_page" type="hidden" value="account" class="hidden">

<input name="sub" type="hidden" value="design" class="hidden">

<input name="reset" type="hidden" value="1" class="hidden">

<input value="Reset Styles" type="submit" class="MainBtn">

</form>

	





   	<div id="plugin" onmousedown="HSVslide('drag','plugin',event)" style="TOP: 58px; Z-INDEX: 20;">

	<div id="plugCUR"></div><div id="plugHEX" onmousedown="stop=0; setTimeout('stop=1',100);">FFFFFF</div>

	<div id="plugCLOSE" onClick="getColor('s2');">X</div><br>

	<div id="SV" onmousedown="HSVslide('SVslide','plugin',event)" title="Saturation + Value">

	 <div id="SVslide" style="TOP: -4px; LEFT: -4px;"><br /></div>

	</div>

	<form id="H" onmousedown="HSVslide('Hslide','plugin',event)" title="Hue">

	 <div id="Hslide" style="TOP: -7px; LEFT: -8px;"><br /></div>

	 <div id="Hmodel"></div>

	</form>

   </div>

  	<input type="text" value="ColourPickIder" id="ColourPickIder" style="display:none;">

	<script type="text/javascript">

	loadSV();

	HSVupdate({H:0, S:0, V:20});

	//$S('plugin').left=($('s2').offsetLeft+35)+'px';

	//$S('plugin').top=($('s2').offsetTop+35)+'px';		 

	$S('plugin').display='none';

	

	</script>










</div>


<?php  }elseif($show_page=="comments" && D_COMMENTS =="1"){ 




	 /**

	 * Page: Account Comments Page

	 *

	 * @version  8.0

	 * @created  Fri Jan 18 10:48:31 EEST 2008

	 * @updated  Fri Sep 24 16:28:31 EEST 2008

	 */

 



?>

<style>
@media (max-width: 650px){
	#DisplayList ul ul li {
	    min-height: 144px;
	}
	.search_display_on {
	     border:0; 
	}
}

</style>






	<span id="response_eMeetingCommentsDelete" class="responce_alert"></span>

	<div class="menu_box_body1">

	<div id="DisplayList">

	  <ul>

		<li> <strong style="text-transform:uppercase"> <?=$GLOBALS['LANG_COMMON'][8] ?> </strong> 

				

				<!-- DISPLAY PAGE NUMBERS -->

				<span>

				<?php  if(($show_page_current) > 1){ ?>

				<a href="<?=DB_DOMAIN ?>index.php?dll=account&sub=comments&sta=<?=$show_page_prev?><?=$show_page_rows?>&cpage=<?=$show_page_current-1; ?>"><</a>

				<?php  } ?>  

				<?=str_replace("%1",$show_page_current,str_replace("%2",$show_page_num_of,$GLOBALS['LANG_COMMON'][0])) ?>

				<?php  if($show_page_current < $show_page_num_of){ ?>

				<a href="<?=DB_DOMAIN ?>index.php?dll=account&sub=comments&sta=<?=$show_page_next?><?=$show_page_rows?>&cpage=<?=$show_page_current+1; ?>">></a>

				<?php  } ?>

				</span> 

				<!-- END PAGE NUMBERS -->			

		  <div class="ClearAll"></div>

		</li>

	

		<li class="middle">

		  <ul>	 

			<?php  $i=1; foreach($comments_array as $comment){ ?>			
			
            <div class="row">
				<div class="<?php if($i % 2){ ?>search_display_off<?php  }else{ ?>search_display_on<?php  }  ?>">
					<li id="comment_<?=$comment['id'] ?>" <?php  if($comment['approved']=="no"){ ?> style="background:#eee;" <?php  } ?>> 	
						<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
						  	<!-- Message Text -->
			                <div class="row"> 
								<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
									<a href="<?=getThePermalink('user',array('username' => $comment['username']))?>"><img src="<?=$comment['image'] ?>" class="thumb-mail"></a>
		                		</div>
		                		
		                		<div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
				                	
				                	<div class="reply_topic">
					                	<?=$comment['comments'] ?>
				                	</div>

									<?=$GLOBALS['_LANG']['_username'] ?>
									<a href="<?=$comment['user_link'] ?>"><?=$comment['username'] ?></a> <?=$GLOBALS['_LANG']['_date'] ?>: <?=$comment['date'] ?> @ <?=$comment['time'] ?>
								</div>
							</div>
						</div>		

					 	<!-- Message Buttons -->
		             	<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
							<strong>			
							<?php  if($comment['approved']=="no" || $comment['approved']==""){ ?>

								<img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/approve.gif" align="absmiddle"><a href="#" onclick="ApproveCommentsPost('<?=$comment['page'] ?>','<?=$comment['id'] ?>','<?=$comment['subpage'] ?>'); return false;"><?=$GLOBALS['_LANG']['_approve'] ?></a><br>

							<?php  } ?>

								<img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/10/manage.gif" align="absmiddle"><a href="<?=$comment['link'] ?>"><?=$GLOBALS['_LANG']['_view'] ?></a><br>

								<img src="<?=DB_DOMAIN ?>images/DEFAULT/_msg/delete.gif" align="absmiddle"><a href="#" onclick="Effect.Fade('comment_<?=$comment['id'] ?>'); eMeetingCommentsDelete('<?=$comment['page'] ?>','<?=$comment['id'] ?>','<?=$comment['subpage'] ?>'); return false;"><?=$GLOBALS['_LANG']['_delete'] ?> </a>

							</strong>
		                </div>
                
			</li>		

		</div>
			</div>
			<?php  $i++; } ?>		

			<?php  if(empty($comments_array)){ ?>		

			<li class="nomail"> <?=$GLOBALS['LANG_ACCOUNT']['27'] ?></li>		

			<?php  } ?>		

		  </ul>

		</li>

 

		<li style="margin-top:30px;"> 

			<strong> 

				<?=$GLOBALS['_LANG']['_sort'] ?>: 

					<a href="#" onclick="UpdateCommentsOrder('comments.date'); return false;"><?=$GLOBALS['_LANG']['_date'] ?></a> 

					<a href="#" onclick="UpdateCommentsOrder('comments.from_uid'); return false;"><?=$GLOBALS['_LANG']['_username'] ?></a> 

					<a href="#" onclick="UpdateCommentsOrder('comments.approved'); return false;"><?=$GLOBALS['_LANG']['_approved'] ?></a> 				

			</strong> 

			

			<span>

				<form method="post" action="<?=DB_DOMAIN ?>index.php">

				<input name="do_page" type="hidden" value="account" class="hidden">

				<input type="hidden" name="ChangeOrderTotal" value="maildate" id="ChangeOrderTotal" class="hidden">

				<input name="sub" type="hidden" value="comments" class="hidden">

				<input name="type" type="hidden" value="<?=strip_tags($type) ?>" class="hidden">

				<select name="sto" onchange="this.form.submit();" class="input">

						<option value="10"><?=str_replace("%s","10",$GLOBALS['_LANG']['_sort6']) ?></option>

						<option value="20"><?=str_replace("%s","20",$GLOBALS['_LANG']['_sort6']) ?></option>

						<option value="30"><?=str_replace("%s","30",$GLOBALS['_LANG']['_sort6']) ?></option>

						<option value="40"><?=str_replace("%s","40",$GLOBALS['_LANG']['_sort6']) ?></option>

						<option value="50"><?=str_replace("%s","50",$GLOBALS['_LANG']['_sort6']) ?></option>

	

				</select>

				</form>		

			</span> 

			<div class="ClearAll"></div>

		</li>	

	  </ul>

	</div>

	</div>

	<form method="post" action="<?=DB_DOMAIN ?>index.php" name="UpdateComments" id="UpdateComments">

	<input type="hidden" id="ChangeOrder" name="ChangeOrder" value="date" class="hidden">

	<input type="hidden" id="sub" name="sub" value="comments" class="hidden">

	<input name="type" type="hidden" value="<?=strip_tags($type) ?>" class="hidden">

	<input name="do_page" type="hidden" value="account" class="hidden">

	</form>


<?php  }elseif($show_page=="video"){ 



	 /**

	 * Page: Video Message

	 *

	 * @version  8.0

	 * @created  Fri Jan 18 10:48:31 EEST 2008

	 * @updated  Fri Sep 24 16:28:31 EEST 2008

	 */



?>





	<script type="text/javascript" src="<?=DB_DOMAIN ?>inc/js/_flash.js"></script>

	<script type='text/javascript' src='<?=DB_DOMAIN ?>inc/js/swfobject.js'></script>

		

	<?php  if($GLOBALS['MyProfile']['video_duration'] >0){ ?>

	<p><?=$GLOBALS['_LANG_ERROR']['_videoIntro'] ?></p>

	<?php  } ?>

	<table width="650"  border="0">

	  <tr><td width="390" style="overflow:hidden;">	

	

	<div id="show1" style="width:390px; height:297;overflow:hidden; display:visible;">

		

	   <SCRIPT language="JavaScript">

			displayeMeeting("<?=DB_DOMAIN ?>inc/exe/flash/video_recorder.swf?&uid=<?=$_SESSION['uid'] ?>&userid=77","380","297",{wmode:"transparent", menu:"false",bgcolor:"#FFFFFF",version:"6,0,47,0",align:"middle"});

		</SCRIPT>

	   

	</div>

	

	<div id="show2" style="display:none">

	



	

	<p align="center"><a href="#" onclick="toggleLayer('show1'); toggleLayer('show2'); return false;">[ <?=$GLOBALS['LANG_GLO_OPTIONS'][43] ?> ]</a></p>

	

	</div>

	

	</td><td width="250" align="center" valign="top" bgcolor="#eeeeee" style="border:1px dashed #999999; padding:10px;">



	<?php  if($GLOBALS['MyProfile']['video_duration'] == 0){ ?>

	<p><?=$GLOBALS['_LANG_ERROR']['_videoIntro'] ?></p>

	<?php  }else{ ?>

	  <div id='preview'></div>

	  <script type='text/javascript'>

	  var s1 = new SWFObject('<?=DB_DOMAIN ?>inc/exe/flash/video_player_rtmp.swf','ply','230','180','9','#ffffff');

	  s1.addParam('allowfullscreen','true');

	  s1.addParam('allowscriptaccess','always');

	  s1.addParam('wmode','opaque');

	  s1.addParam('flashvars','file=eMeetingVideo_<?=$_SESSION['uid'] ?>.flv&streamer=<?=FLASH_DOMAIN?>&controlbar=none');

	  s1.write('preview');

	</script>

	<?php  } ?>



</td></tr></table>



<?php  if($GLOBALS['MyProfile']['video_duration'] > 0){ ?>

<div id="VideoDelete"></div>

<div style="border:1px dashed #999999; padding:10px; background:#eeeeee; margin-top:10px;"> <a href="#" onClick="DeleteGreetings(); Effect.Fade('show1'); return false;" style="text-decoration:none; font-weight:bold;"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/chk_no.png" align="absmiddle"><?=$GLOBALS['LANG_ACCOUNT']['28'] ?></a> </div>

<?php  } ?>



<?php  } ?>	

<script type="text/javascript">
function mapInitialize(id) {
    var input = document.getElementById(id);
        var options = {types: ['(cities)'], componentRestrictions: {}};

        new google.maps.places.Autocomplete(input, options);
    }

google.maps.event.addDomListener(window, 'load', function() {  
    mapInitialize('registerLocation');
});
</script>
</div> <div id="main_wrapper_bottom"></div>
</div>