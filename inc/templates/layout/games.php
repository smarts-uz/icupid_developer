<?
/**
* Page: MEMBER GAMES PAGE
*
* @version  9.0
* @created  Sat 25 Oct  2008
* @related  inc/func/func_games_page.php
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



 
<div id="eMeeting" class="user">
  <div class="header account_tabs">
    <ul>
	 	<li <? if($show_page=="search"){ ?>class="selected"<? } ?>><a href="<?= getThePermalink('games/search')?>"><span> <?=$GLOBALS['LANG_GAMES']['9'] ?></span></a></li>
		<li <? if($show_page=="top"){ ?>class="selected"<? } ?>><a href="<?= getThePermalink('games/top')?>"><span><?=$GLOBALS['LANG_GAMES']['6'] ?></span></a></li>
    </ul>
    <div class="ClearAll"></div>
 </div>
</div>
<br>






<? if($show_page =="search"){ 

	 /**
	 * Page: Settings Options
	 *
	 * @version  8.0
	 * @created  Fri Jan 18 10:48:31 EEST 2008
	 * @updated  Fri Sep 24 16:28:31 EEST 2008
	 */


?>


<div id="eMeetingContentBox">

	<form method="POST" action="<?=DB_DOMAIN ?>index.php" name="ClassSearch">
	<input name="sub" type="hidden" value="<?=$sub_page ?>" class="hidden">
	<input name="do_page" type="hidden" value="<?=$page ?>" class="hidden">
	
		<div id="Title">
			<span class="a1"><?=$PageTitle ?></span>
			<span class="a2"><?=$PageDesc ?></span>
		</div>
		<div id="Search">
			<span class="a1"> <!--<strong><?=$GLOBALS['_LANG']['_search'] ?></strong>-->	<input name="keyword" type="text" class="input"> <input name="" type="submit"  class="NormBtn" value="<?=$GLOBALS['_LANG']['_search'] ?>"></span>
			<span class="a2"><?=$Search_Page_Numbers ?></span>
		</div>
		<div id="Results"> 
			<span class="a1"> <b><?=$search_total_results ?></b> <?=$GLOBALS['_LANG']['_results'] ?> </span>
			<span class="a2"><?=$GLOBALS['_LANG']['_sort'] ?>: <a href="#" onclick="ChangeSort('1'); return false;"><?=$GLOBALS['_LANG']['_sort3'] ?></a> | <a href="#" onclick="ChangeSort('2'); return false;"><?=$GLOBALS['_LANG']['_sort5'] ?></a> | <a href="#" onclick="ChangeSort('3'); return false;"><?=$LANG_GAMES_PAGE['5'] ?></a></span>
		</div>
	
	</form> 
  
  <?php	
  $view_page=1;
	if(isset($search_page)){
    $view_page=$search_page;
  }

  ?>	
	
  <form name="SearchResults" method="post" action="<?=getThePermalink($page.'/'.$view_page)?>">
	<input name="searchPage" type="hidden" id="searchPage" value="1" class="hidden">
	<input name="page" type="hidden" value="<? if(isset($search_page) && is_numeric($search_page) ){ print strip_tags($search_page); }else{ print "1"; } ?>" class="hidden" id="Spage">
	<input name="sub" type="hidden" value="<?=$sub_page ?>" class="hidden">
	<input name="do_page" type="hidden" value="<?=$page ?>" class="hidden">
	<input type="hidden" name="sort" value="1" class="hidden" id="SSort">


 
	<? $i=1; foreach($search_data as $value){ ?>	
	
		<div class="Acc_ListBox <?php if($i % 2){ ?>search_display_off<? }else{ ?>search_display_on<? } ?>" id="div_<?=$value['id'] ?>">
		<div class="Acc_ListBox_left"><a class="photo_75" href="<?=$value['link'] ?>" title="<?=$value['game'] ?>"><img src="<?=$value['image'] ?>" class="img_border"></a> 
		<? if($value['Champion_name'] !=""){ ?><div align="center"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/winner.jpg" align="absmiddle"><a href="<?=$value['user_link'] ?>" style="color:#000"><?=$value['Champion_name'] ?></a> <?=$value['Champion_score'] ?></div> <? } ?></div>
		<div class="Acc_ListBox_right">	
		<div class="Acc_ListBox_right1">
		<div class="Acc_ListBox_title_break"><a href='<?=$value['link'] ?>'><?=$value['game'] ?></a><br></div>
	
		<b><?=$value['about'] ?></b>
		<div>
		<?=$GLOBALS['LANG_GAMES']['1'] ?>: <?=showTimeSince($value['last_played']); ?>, &nbsp; &nbsp; 
		<?=$GLOBALS['_LANG']['_rating'] ?> <?=$value['rating_image'] ?> <br> 		 
		<?=$GLOBALS['LANG_GAMES']['2'] ?> <?=number_format($value['times_played']) ?> <?=$GLOBALS['LANG_GAMES']['3'] ?>
		 <br>
	
		</div>
		</div><div class="Acc_ListBox_right2"><div>
	
			<a href="<?=$value['link'] ?>"> <img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/zoom.png" align="absmiddle"> &nbsp; &nbsp; <?=$GLOBALS['LANG_GAMES']['8'] ?></a>	 <br>
	
		<?
		## display delete functions for moderator
		if( isset($_SESSION['site_moderator_delete']) && $_SESSION['site_moderator_delete']=="yes" ){ ?>
					
		<br><a href="javascript:void(0)" onClick="AdminLiveDelete('<?=$value['id'] ?>', 'games', ''); Effect.Fade('div_<?=$value['id'] ?>'); return false;" style="text-decoration:none">
		<img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/cancel.png" align="absmiddle"> <?=$GLOBALS['_LANG']['_delete'] ?> </a>
		<? } ?>			 		
	
		</div>
		</div>
		<div class="clear"></div></div><div class="clear"></div>
		</div>
	
		<? $i++; } ?>
		
		<div id="Bottom"><?=$Search_Page_Numbers ?></div>
		</form>
	
	
	</div> <!-- end main box -->




<? }elseif($show_page =="play"){ 

	 /**
	 * Page: Play Games
	 *
	 * @version  8.0
	 * @created  Fri Jan 18 10:48:31 EEST 2008
	 * @updated  Fri Sep 24 16:28:31 EEST 2008
	 */
if(isset($gd['gamewidth']) && $gd['gamewidth'] > 380){ 
?>
<br/>
	<div class="margin_top_10">
		<div align="center" class="video_out_cont">
					<object classid=clsid:D27CDB6E-AE6D-11cf-96B8-444553540000 codebase=http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0 align=middle WIDTH=<?=$gd['gamewidth'] ?> HEIGHT=<?=$gd['gameheight'] ?>> 
					<param name='movie' value='<?=DB_DOMAIN ?>inc/exe/Games/swf/<?=$gd['gameid'] ?>.swf' />
					<param name=quality value=high />
					<param name=allowScriptAccess value=sameDomain />
					<param name='menu' value='false' />
					<embed src="<?=DB_DOMAIN ?>inc/exe/Games/swf/<?=$gd['gameid'] ?>.swf" quality=high pluginspage=http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash WIDTH=<?=$gd['gamewidth'] ?> HEIGHT=<?=$gd['gameheight'] ?> menu='false' type=application/x-shockwave-flash align=middle />
					</object>
		</div>
	<div class="ClearAll"></div>
	
	</div>

<? } ?>


<div class="content sidebar">
  <div class="gradient">
    <div class="row game">
       <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
              <div class="row">
              
				<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8" id="Profile_MainBar">
                <div class="contain_white">					<?
                    if(isset($gd['gamewidth']) && $gd['gamewidth'] < 381){ 
                    ?>
                        <div style="padding:5px; background:#eeeeee;">
                            <div align="center">
                                        <object classid=clsid:D27CDB6E-AE6D-11cf-96B8-444553540000 codebase=http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0 align=middle WIDTH=<?=$gd['gamewidth'] ?> HEIGHT=<?=$gd['gameheight'] ?>> 
                                        <param name='movie' value='<?=DB_DOMAIN ?>inc/exe/Games/swf/<?=$gd['gameid'] ?>.swf' />
                                        <param name=quality value=high />
                                        <param name=allowScriptAccess value=sameDomain />
                                        <param name='menu' value='false' />
                                        <embed src="<?=DB_DOMAIN ?>inc/exe/Games/swf/<?=$gd['gameid'] ?>.swf" quality=high pluginspage=http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash WIDTH=<?=$gd['gamewidth'] ?> HEIGHT=<?=$gd['gameheight'] ?> menu='false' type=application/x-shockwave-flash align=middle />
                                        </object>
                            </div>
                        <div class="ClearAll"></div>
                        
                        </div>
                    <? }  
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
                    displayCommentsBox("310", $page, $show_page, $_SESSION['uid'], isset($gd['gameid']) ? $gd['gameid'] : '',$PageTitle,0) ?>
                  </div>
                  </div>
                  <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" id="Profile_SideBar">    
                      <?
                           /**
                           * Page: Top Player
                           *
                           * @version  9.0
                           */
                      
                      if(isset($gd['Champion_name']) && $gd['Champion_name'] !=""){ ?>
                          <h1><?=$GLOBALS['LANG_GAMES']['4'] ?></h1><br>
                          <p><strong><?=$GLOBALS['_LANG']['_username'] ?>:</strong><span><a href="<?=$gd['user_link'] ?>"><?=$gd['Champion_name'] ?></a></span></p>
                          <hr>
                          <p><strong><?=$GLOBALS['LANG_GAMES']['5'] ?>:</strong><span> <?=$gd['Champion_score'] ?></span></p><hr>
                      
                      <? } ?>
                  
                      <div class="menu_box_title1">
                      <span><img src="<?=DB_DOMAIN ?>images/DEFAULT/blank.gif" width="30" height="29" onClick="expandcontent(this,'s1')" class="menu_noexpand"></span>
                      <?=$GLOBALS['_LANG']['_searchQ'] ?> </div>
                      <div class="menu_box_body1">
                      <form method="POST" action="<?=DB_DOMAIN ?>index.php" name="ClassSearch">
                      <input name="sub" type="hidden" value="<?=$sub_page ?>" class="hidden">
                      <input name="do_page" type="hidden" value="<?=$page ?>" class="hidden">
                          
                      <input name="keyword" type="text" class="input"> <input type="submit" class="NormBtn" value="<?=$GLOBALS['_LANG']['_search'] ?>">
                          
                          </form> 
                      </div>
                  
                      <div class="menu_box_title1">
                      <span><img src="<?=DB_DOMAIN ?>images/DEFAULT/blank.gif" width="30" height="29" onClick="expandcontent(this,'s1')" class="menu_noexpand"></span>
                      <?=$GLOBALS['_LANG']['_information'] ?> </div>
                      <div class="menu_box_body1">
                  
                  
                      
                      <? if(!empty($OtherGames)){ ?>
                  
                      <div style="background:#eee; border:1px solid #ccc; overflow:auto; height:150px;color:#333333;padding:5px;">
                  
                      <? 
                       /**
                       * Page: Display Other Games
                       *
                       * @version  9.0
                       */
                      
                      foreach($OtherGames as $value){ ?>
                          <div style="margin-bottom:10px;">
                          <a href="<?=getThePermalink('games/play/'.$value['id'])?>"><img src="<?=$value['image'] ?>" style="float:left; padding-right:10px;"><?=$value['title'] ?><?=$value['description'] ?></a>
                          <div class="ClearAll"></div>
                          </div>
                      <? } ?>
                      </div>
                      <? } ?>
                  
                      <div style="margin-top:20px;">
                          <span><?=$GLOBALS['LANG_GLO_OPTIONS']['36'] ?></span>
                          <span id="responce_rating" class="responce_alert"></span>
                      
                          <div  id="FileRatingStars">
                          <ul class="star-rating">		
                                  <li class="current-rating" style="width:<?=$value['percent'] ?>%;"></li>						
                                    <li><a href="#" title="1 star out of 5" class="one-star" onclick="AddGameRating(1,'<?=$gd['gameid'] ?>'); return false;">1</a></li>			
                                    <li><a href="#" title="2 stars out of 5" class="two-stars" onclick="AddGameRating(2,'<?=$gd['gameid'] ?>'); return false;">2</a></li>			
                                    <li><a href="#" title="3 stars out of 5" class="three-stars" onclick="AddGameRating(3,'<?=$gd['gameid'] ?>'); return false;">3</a></li>			
                                    <li><a href="#" title="4 stars out of 5" class="four-stars" onclick="AddGameRating(4,'<?=$gd['gameid'] ?>'); return false;">4</a></li>			
                                    <li><a href="#" title="5 stars out of 5" class="five-stars" onclick="AddGameRating(5,'<?=$gd['gameid'] ?>'); return false;">5</a></li>
                          </ul></div>
                      </div>
                  
                  
                      
                      </div>
                  
                  
                      <br>
                      <?=PageLinkBox() ?>
                  
                  </div>
              </div>
       </div>
    </div>
  </div>
</div>



<?

if(isset($_POST['thescore'])){ print "You Scored ".$_POST['thescore']; }
?>




<? }elseif($show_page =="top"){ 

	 /**
	 * Page: Games Leader Board
	 *
	 * @version  8.0
	 * @created  Fri Jan 18 10:48:31 EEST 2008
	 * @updated  Fri Sep 24 16:28:31 EEST 2008
	 */


?>

<div class="menu_box_title1"><?=$GLOBALS['LANG_GAMES']['6'] ?></div>
<div class="menu_box_body1">

<!--<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="row">
        <? $i=1; foreach($Leader_Data as $game){ ?>
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">&nbsp;</div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><?=$i ?><a href="<?=$game['user_link'] ?>"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/winner.jpg" align="absmiddle"><?=$game['Champion_name'] ?></a> </div>
                </div>
            </div>
            
            <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><?=isset($GLOBALS['LANG_GLO_DATA']['1']) ?></div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><?=$game['Champion_score'] ?></div>
                </div>
            </div>
            
            <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                <div class="row">
                <p><?=$GLOBALS['LANG_GAMES']['5'] ?></p>
                </div>
            </div>
            
            <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><?=$GLOBALS['LANG_GAMES']['7'] ?></div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><a href='index.php?dll=games&sub=play&item_id=<?=$game['gameid'] ?>'><img src='<?=$game['icon'] ?>'></a>&nbsp;</div>
                </div>
            </div>
            
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><?=$GLOBALS['LANG_GAMES']['8'] ?></div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><a href='index.php?dll=games&sub=play&item_id=<?=$game['gameid'] ?>'><?=$game['game'] ?></a></div>
                </div>
            </div>
            
            <? $i++; } ?>
        </div>
    </div>
</div>-->
<style>
/*table {
    border-collapse: collapse;
    border-spacing: 0;
    width: 100%;
    border: 1px solid #ddd;
}
*/
.table th,.table td {
    border: none !important;
}

</style>
<div style="overflow-x:auto;">
<table class="table">
  <tr>
    <td>&nbsp;</td>
    <td><?=isset($GLOBALS['LANG_GLO_DATA']['1']) ?></td>
    <td><?=$GLOBALS['LANG_GAMES']['5'] ?></td>
    <td>&nbsp;</td>
    <td><?=$GLOBALS['LANG_GAMES']['7'] ?></td>
    <td><?=$GLOBALS['LANG_GAMES']['8'] ?></td>
  </tr>
<? $i=1; foreach($Leader_Data as $game){ ?>
  <tr>
    <td><?=$i ?></td>
    <td><a href="<?=$game['user_link'] ?>"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/winner.jpg" align="absmiddle"><?=$game['Champion_name'] ?></a> </td>
    <td align="center" ><?=$game['Champion_score'] ?></td>
    <td align="center"><a href='<?=getThePermalink('games/play/'.$game['gameid'])?>'><img src='<?=$game['icon'] ?>'></a>&nbsp;</td>
    <td valign="top" style="line-height:30px;">

	<? if(isset($game['Champion_name1'])){ ?> <img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/winner_1.jpg" align="absmiddle"><a href="<?=getThePermalink('user', array('username' => $game['Champion_name1']))?>"><?=$game['Champion_name1'] ?></a> (<?=$game['Champion_score1'] ?>)<br> 
	<? } ?>
   	<? if(isset($game['Champion_score2'])){ ?>  <img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/winner_2.jpg" align="absmiddle"><a href="<?=getThePermalink('user', array('username' => $game['Champion_name2']))?>"><?=$game['Champion_name2'] ?></a> (<?=$game['Champion_score2'] ?>) <? } ?> </td>
    <td><a href='<?=getThePermalink('games/play/'.$game['gameid'])?>'><?=$game['game'] ?></a></td>
  </tr>
<? $i++; } ?>
</table>
</div>
</div>

<? } ?>

<?php
/* MAIN CLOSE */
if(!isset($HEADER_SINGLE_COLUMN)){ ?></div><div class="clear"></div> <? }else{ print "</div>"; }
?>

</div> <div id="main_wrapper_bottom"></div>
</div>