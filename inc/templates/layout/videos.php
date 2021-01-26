<?
/**
* Page: DISPLAYS MEMBER VIDEOS MIXED WITH YOUTUBE IF PLUGIN ADDED
*
* @version  9.0
* @created  Sat 25 Oct  2008
* @related  inc/func/func_videos_page.php
*/
## block direct page access
defined( 'KEY_ID' ) or die( 'Restricted access' );

?>
<div id="main">         
    <div id="main_content_wrapper">     


    <? if(!isset($HEADER_SINGLE_COLUMN)){ ?><div class='conten_outer' style="padding:10px 20px;"> <? } ?>   
        
     <div class="clear"></div>

    <? if(isset($ERROR_MESSAGE) && strlen($ERROR_MESSAGE) > 3){ ?>
    <div id="messages">
          <div style="" class="message-<?=$ERROR_TYPE ?>" id="main-message-<?=$ERROR_TYPE ?>">
          <a class="dismiss-message" href="#" onclick="Effect.Fade('main-message-<?=$ERROR_TYPE ?>', { duration : 0.5 });; return false;"><img src="images/DEFAULT/_icons/16/menu.gif"></a>
          <?=$ERROR_MESSAGE ?>
        </div>
        <script type="text/javascript" language="javascript">Effect.Pulsate('main-message-<?=$ERROR_TYPE ?>', { pulses : 2, duration : 1, from : 0.7 });</script>
    </div>
    <? } ?>
<? foreach($BANNER_ARRAY as $banner){ if($banner['position'] =="middle"){?>
<div class="middle_banner"><? print $banner['display'];?></div><? }} ?>

<p <? if ($PageDesc !='') {?> class="page_decr" <? }?> ><?=$PageDesc ?></p>


<? if($show_page =="search"){ 

	 /**
	 * Page: Search Display
	 *
	 * @version  9.0
	 */


?>


	<div id="eMeetingContentBox">

	<form method="GET" action="<?=DB_DOMAIN ?>index.php" name="ClassSearch">
	<input name="dll" type="hidden" value="videos" class="hidden">
	<input name="sub" type="hidden" value="search" class="hidden">
	
	<div id="Title">
		<div class="AddIcon"><br><a href="<?= getThePermalink('gallery/upload') ?>" class="MainBtn">  <img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/add.png" align="absmiddle"> <?=$GLOBALS['_LANG']['_createNew'] ?></a></div>
		<span class="a1"><?=$PageTitle ?></span>
		<span class="a2"><?=$PageDesc ?></span>
	</div>

	<?=$ThisPersonsNetworkBar ?>

	<div id="Search">
		<span class="a1"><input name="keyword" type="text" class="input"> <input name="" type="submit" class="NormBtn" value="<?=$GLOBALS['_LANG']['_search'] ?>"></span>
		<span class="a2"><?=$Search_Page_Numbers ?></span>
	</div>
	<div id="Results"> 
		<span class="a1"> <b><?=$search_total_results ?></b> <?=$GLOBALS['_LANG']['_results'] ?> </span>
		
	</div>
	
	</form> 

	<?
	if(isset($search_page)){
		$view_page = strip_tags($search_page);
	}
	else{
		$view_page = 1;
	}
	?>

	<form name="SearchResults" method="post" action="<?= getThePermalink($page.'/view/'.$view_page) ?>">
	<input name="searchPage" type="hidden" id="searchPage" value="1" class="hidden">
	<input name="page" type="hidden" value="<? if(isset($search_page) && is_numeric($search_page) ){ print strip_tags($search_page); }else{ print "1"; } ?>" class="hidden" id="Spage">
	<input name="sub" type="hidden" value="<?=$sub_page ?>" class="hidden">
	<input name="do_page" type="hidden" value="<?=$page ?>" class="hidden">
	<input type="hidden" name="sort" value="1" class="hidden" id="SSort">
	<? if(is_numeric($item_id)){ ?><input name="item_id" type="hidden" value="<?=$item_id ?>" class="hidden"> <? } ?>
	<input name="keyword" type="hidden" value="<? if(isset($_GET['keyword']) ){ print strip_tags($_GET['keyword']); }else{print "music"; } ?>" class="hidden">


	<? if($search_total_results ==0){ ?>
	
	<div class="result_not_found"><h1><a href="<?=getThePermalink('videos/search')?>"> <?=$GLOBALS['_LANG_ERROR']['_noResults'] ?></a></h1></div>
	
	<? } ?>
	
	<? $i=1; if(is_array($search_data)){
		
		foreach($search_data as $value){ ?>	
		<?php if($value['tags'] != 'Youtube') {
			$value['link'] = $value['link'].$value['youtube_username']; 
		} ?>
		<div class="Acc_ListBox <? if($value['ThisApproved']=="no"){ ?>search_display_unapproved<? }else{ if($i % 2){ ?>search_display_off<? }else{ ?>search_display_on<? } } ?>" id="div_<?=$value['id'] ?>">
		<div class="Acc_ListBox_left"><div><a href="<?=$value['link'] ?>" title="<?=$value['image_alt'] ?>"><img src="<?=$value['image'] ?>" alt="<?=$value['image_alt'] ?>" width="110"></a></div></div>
		<div class="Acc_ListBox_right">	
		<div class="Acc_ListBox_right1">
		<div class="Acc_ListBox_title_break"><?=$value['image_alt'] ?></div>
		<b><?=$GLOBALS['_LANG']['_date'] ?>: <?=$value['date'] ?> <br> <?=$GLOBALS['_LANG']['_views'] ?>: <?=$value['views'] ?></b>
		<div class="Acc_ListBox_margin5"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/16/tpl_icon_tags.png" align="absmiddle">
	<?
			// displays video tags
			$bolx = explode(" ",$value['tags']);
			for ($ix=0;$ix<=count($bolx)-1;$ix++) {
			echo "<a class='tags' href='". getThePermalink('videos/search//keyword/'.$bolx[$ix])."'>$bolx[$ix]</a> ";
			}
	?>
		</div></div><div class="Acc_ListBox_right2"><div>
		<img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/zoom.png" align="absmiddle"> <a href="<?=$value['link'] ?>"><?=$GLOBALS['LANG_COMMON'][38] ?></a>

		<?
		## display delete functions for moderator
		if( isset($_SESSION['site_moderator_approve']) && $_SESSION['site_moderator_approve']=="yes" && $value['ThisApproved']=="no"){ ?>
					
		<span id="Approvediv_<?=$value['id'] ?>"><br><a href="javascript:void(0)" onClick="AdminLiveApprove('<?=$value['id'] ?>', 'video', ''); Effect.Fade('Approvediv_<?=$value['id'] ?>'); return false;" style="text-decoration:none">
		<img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/chk_on.png"> &nbsp;&nbsp; <?=$GLOBALS['_LANG']['_approve'] ?> </a></span>
		<? } ?>

		<?
		## display delete functions for moderator
		if( isset($_SESSION['site_moderator_delete']) && $_SESSION['site_moderator_delete']=="yes" && $value['uid'] !=0){ ?>
					
		<br><a href="javascript:void(0)" onClick="AdminLiveDelete('<?=$value['id'] ?>', 'video', ''); Effect.Fade('div_<?=$value['id'] ?>'); return false;" style="text-decoration:none">
		<img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/cancel.png" align="absmiddle"> <?=$GLOBALS['_LANG']['_delete'] ?> </a>
		<? } ?>	

		</div></div><div class="clear"></div></div><div class="clear"></div></div>



	<? $i++; } } ?>

	<div id="Bottom"><?=$Search_Page_Numbers ?></div>

	</form>


	</div> <!-- end main box -->






<? }elseif($show_page=="view"){ 

	 /**
	 * Page: View video file
	 *
	 * @version  9.0
	 */

?>

 	
	<div align="center" class="video_out_cont"><? print $video['file']; ?></div>
	
	<div class="content sidebar">
      <div class="gradient">
      	<div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          	<div class="row">
            
               <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8" id="Profile_MainBar">
              	  <div class="contain_white">
                      <div style="padding-right:10px; float:left; height:120px;"><? if($video['image'] !=""){ ?><img src="<?=$video['image'] ?>"  style="float:left;width:130px; height:100px;" class="img_border"> <? } ?> </div> 		
                      <h1 style="line-height:30px;"><?=$PageTitle ?></h1>
                      <h2 style="line-height:30px;"><?=substr($video['desc'],0,30) ?></h2>
              <div class="clear"></div>
          <? if(D_COMMENTS ==1){ ?>
              <? 
              /*
                  PARAMERTS: 
                  1: width of display box
                  2: page
                  3: sub page
                  4: user created id
                  5: item id
                  6: extra id 1
                  7: extra id 2
              */
              displayCommentsBox("310", $page, $show_page, $_SESSION['uid'], $video['id'],0,0) ?>
              
              <? } ?>
                </div>
               </div>
                  
              <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" id="Profile_SideBar">    
              <div class="menu_box_title1">
              <span><img src="<?=DB_DOMAIN ?>images/DEFAULT/blank.gif" width="30" height="29" onClick="expandcontent(this,'s1')" class="menu_noexpand"></span>
              <?=$GLOBALS['_LANG']['_searchQ'] ?> </div>
              <div class="menu_box_body1">
              <form method="GET" action="<?=DB_DOMAIN ?>index.php" name="ClassSearch">
                  <input name="dll" type="hidden" value="videos" class="hidden">
                  <input name="sub" type="hidden" value="search" class="hidden">
                  
              <input name="keyword" type="text" class="input"> <input type="submit" class="NormBtn" value="<?=$GLOBALS['_LANG']['_search'] ?>">
                  
                  </form> 
              </div>
              <br>
              <div class="menu_box_title1">
              <span><img src="<?=DB_DOMAIN ?>images/DEFAULT/blank.gif" width="30" height="29" onClick="expandcontent(this,'s1')" class="menu_noexpand"></span>
               <?=$GLOBALS['_LANG']['_information'] ?> </div>
              <div class="menu_box_body1">
              
              <div style="background:#eee; border:1px solid #ccc; overflow:auto; height:100px;color:#333333;"><? print $video['desc']; ?></div>
              
              <br>
              <span><img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/16/tpl_icon_tags.png" align="absmiddle"> <?=$GLOBALS['_LANG']['_tags'] ?>: </span>
              <?
          
                  $bolx = explode(" ",$video['tags']);
                  for ($ix=0;$ix<=count($bolx)-1;$ix++) {
                  echo "<a class='tags' href='". getThePermalink('videos/search/keyword/'.$bolx[$ix]) ."'>$bolx[$ix]</a> ";
                  }
              ?>
              <br><br>
              <?=PageLinkBox() ?>
              </div>
              
              <? if(YOUTUBE_API_ID !=""){ ?><div align="center"><a href="https://www.youtube.com" target="_blank"><img src="<?=DB_DOMAIN ?>images/youtube.gif"></a></div><? } ?>
              </div>
          	</div>
          </div>
        </div>
      </div>
    </div>


<? } ?>

<?php
/* MAIN CLOSE */
if(!isset($HEADER_SINGLE_COLUMN)){ ?></div><div class="clear"></div> <? }else{ print "</div>"; }
?>

</div> <div id="main_wrapper_bottom"></div>
</div>