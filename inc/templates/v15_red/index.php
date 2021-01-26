<?php  $fdata = DisplayFeaturedMembers(20);	?>
<style>
#splitpage #main_content_wrapper { background: #ffffff; border:0px; width:100%}
#splitpage #main_wrapper_bottom {	background: #ffffff;}
.Home_ImageBar { background-color:#373737; border-radius: 28px; }
#style4 ul li { color:white; }
#style4 .previous_button {  background: url(inc/templates/<?=D_TEMP ?>/images/ho2.jpg) no-repeat; width:38px; height:137px;  }
#style4 .previous_button_over {  background: url(inc/templates/<?=D_TEMP ?>/images/ho2.jpg) no-repeat; width:38px; height:137px; }
#style4 .previous_button_disabled {  background: url(inc/templates/<?=D_TEMP ?>/images/ho2.jpg) no-repeat; width:38px; height:137px; }
#style4 .next_button {   background: url(inc/templates/<?=D_TEMP ?>/images/ho2b.jpg) no-repeat; width:38px; height:137px; }
#style4 .next_button_over {  background: url(inc/templates/<?=D_TEMP ?>/images/ho2b.jpg) no-repeat; width:38px; height:137px; }
#style4 .next_button_disabled {  background: url(inc/templates/<?=D_TEMP ?>/images/ho2b.jpg) no-repeat; width:38px; height:137px; }
.steps { font-size:16px; color:#DA0303;}
#page_container{width:100%;}
.index_right{
	width: auto;
    line-height: 25px;
   
    position: absolute;
    float: right;
    margin-right: 10px;
    right: 0;
}
.index_right a {
   line-height: 36px !important; 
}
.f_left {
    float: left;
}
.padding_5 {
    padding: 5px;
}
table.flags_table {
    background: #fff;
}
</style>
<script>

  function initialize(id) {
    var input = document.getElementById(id);
        var options = {types: ['(cities)'], componentRestrictions: {}};

        new google.maps.places.Autocomplete(input, options);
    }

  google.maps.event.addDomListener(window, 'load', function() {  
    initialize('quickSearchLocation');
    });
</script>
<?php 

?>

<div class="home-content">
<div class="home-content-banner">
<!--<div style="width:1040px;line-height:25px;">
<a href="index.php?dll=register"><img src="inc/templates/<?=D_TEMP ?>/images/but_join.jpg" style="float:right; margin-right:30px;"></a>
 
<h1 style="font-size:37px;font-weight:normal;"><?=TMP_TXT_1 ?></h1><p><?=TMP_TXT_2 ?></p></div>-->
<div class="banner">
<div class="content-width"><div class="home-banner" style=" background:url(inc/templates/<?=D_TEMP ?>/images/visual.jpg) no-repeat;">
    

<div class="members-search">
<form method="post" name="MemberSearch" action="index.php?dll=search&view_page=1">
<input name="do" type="hidden" value="add" class="hidden"/>            
<input name="do_page" type="hidden" value="search" class="hidden"/>
<input type="hidden" name="page" value="1" class="hidden"/>
<input type="hidden" name="Extra[zero]" value="1" class="hidden"/>
<input name="TotalNumberOfRows" type="hidden" value="3" class="hidden"/>               

<input type="hidden" name="SeN[2]" value="gender" class="hidden"/>
<input type="hidden" name="SeT[2]" value="3" class="hidden"/>

<!--<input type="hidden" name="SeN[3]" value="milesfrom" class="hidden"/>
<input type="hidden" name="SeT[3]" value="1" class="hidden"/>

<input type="hidden" name="SeN[1]" value="location" class="hidden"/>
<input type="hidden" name="SeT[1]" value="1" class="hidden"/>-->

<table class="members-search-info" width="400"  border="0" cellpadding="2" cellspacing="2">
<tr>
	<td height="30" colspan="3" style="font-size:25px;color:#ffffff"><?=$LANG_BODY['_member']. " ".$LANG_BODY['_search'] ?></td>
</tr>
<tr>
	<td width="122" height="30"><?=$LANG_BODY['_home1'] ?> </td>
	<td colspan="2">
		<select name="select"><?=displayGenders() ?></select>
	</td>
</tr>
<tr>
	<td height="30"><?=$LANG_BODY['_home2'] ?> </td>
	<td colspan="2">
		<select name="SeV[2]"><?=displayGenders(1) ?></select>
	</td>
</tr>

<tr>
	<td  width="30"><?=$LANG_BODY['_age'] ?></font></td>
	<td colspan="2"><? print DoAge(1); ?></td>
</tr>


<tr>
	<td height="30"><?=$LANG_BODY['_withPics'] ?></td>
	<td width="140"><input type="checkbox" name="Extra[pics]" value="1"> &nbsp;&nbsp;&nbsp;&nbsp; <?=$lang_global_options['13'] ?> </td>
	<td width="65"><input type="checkbox" name="Extra[online]" value="1"></td>
</tr>

<!--<tr>
	<td  width="30"><?=$LANG_BODY['_location'] ?></font></td>
	<td colspan="2"><input style="width:78px;" name="SeV[3]"  
        maxlength="255" id="quickSearchLocation" placeholder="Location" autocomplete="off" type="text">
        &nbsp;&nbsp;<?=$LANG_BODY['_milesfrom'] ?>
        </td>
</tr>
<tr>
	<td  width="30"><?=$LANG_BODY['_city'] ?></font></td>
	<td colspan="2"><input style="width:78px;" name="SeV[1]" maxlength="20" type="text"></td>
</tr>-->

<tr>
	<td height="30">&nbsp;</td>
	<td height="30" colspan="2" >
		<input type="submit" name="submit" value="<?=$LANG_BODY['_search'] ?>" class="NormBtn"  style="font-size:16px;color:#333"/>
	</td>
</tr>
</table>
</form>
</div>
</div>
</div>
</div>
</div>


 
<table width="940" border="0" align="center" class="Home_ImageBar" style="margin-top: 3%;margin-bottom: 3%;"><tr align="center"><td width="940">


<div id="style4" style="margin-top:15px;">
<div class="previous_button" style="margin-left: 25px;"></div><div class="container" style="width: 814px;">
<ul> 
<?  foreach( $fdata as $value){ ?>
<li><a href="<?=$value['link'] ?>"><img src="<?=$value['image'] ?>" width="96" height="96" border="0" style="cursor:pointer;"></a><br>
<strong><?=$value['username'] ?></strong></li><? } ?>
<?  foreach( $fdata as $value){ ?>
<li><a href="<?=$value['link'] ?>"><img src="<?=$value['image'] ?>" width="96" height="96" border="0" style="cursor:pointer;"></a><br>
<strong><?=$value['username'] ?></strong></a></li><? } ?>

</ul>

</div>
<div class="next_button"></div></div><script>function runTest() {  hCarousel = new UI.Carousel("style4");     }  Event.observe(window, "load", runTest); </script>

</td>
</tr></table>

</div> 

<form class="clearfix" action="<?=DB_DOMAIN ?>index.php?dll=search&view_page=1" method="POST" name="QuickSearch" id="QuickSearch">          
		<input name="do_page" 	type="hidden" 			value="search" class="hidden">
		<input type="hidden" 	name="page" 			value="1" class="hidden">
		<input type="hidden" 	name="Extra[newtoday]" 	value="0" class="hidden"	id="se_newtoday">
		<input type="hidden" 	name="Extra[favorite]" 	value="0" class="hidden"	id="se_favorite">
		<input type="hidden" 	name="Extra[birthday]" 	value="0" class="hidden" 	id="se_birthday">
		<input type="hidden" 	name="Extra[online]" 	value="0" class="hidden" 	id="se_onlinenow">
		<input type="hidden" 	name="Extra[pics]" 		value="0" class="hidden" 	id="se_pics">
		<input type="hidden" 	name="Extra[featured]" 	value="0" class="hidden" 	id="se_featured">
		<input type="hidden" 	name="Extra[highlighted]" value="0" class="hidden" 	id="se_highlight">
		<input type="hidden" 	name="SeN[1]" 	value="0" class="hidden">
		<input type="hidden" 	name="SeV[1]" 	value="0" class="hidden">
		<input type="hidden" 	name="SeT[1]" 	value="0" class="hidden">
	</form>
<script>
document.getElementById("side").style.float = "right";

 

    

</script>
<script type="text/javascript" charset="UTF-8" src="https://maps.googleapis.com/maps-api-v3/api/js/34/15/controls.js"></script>
<script type="text/javascript" charset="UTF-8" src="https://maps.googleapis.com/maps-api-v3/api/js/34/15/places_impl.js"></script>