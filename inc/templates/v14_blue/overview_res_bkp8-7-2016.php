<?
## block direct page access

defined( 'KEY_ID' ) or die( 'Restricted access' );

if($GLOBALS['MyProfile']['status'] ==""){ $GLOBALS['MyProfile']['status'] = D_STATUSMSG; }

?>
<style type="text/css">
.inner {
    background: #359dc4 none repeat scroll 0 0;
    border: 1px solid #5dcef8;
    border-radius: 14px;
    box-shadow: 0 1px 16px 2px #0588b6;
    margin: 15px 30px 0 auto;
    padding-top: 10px;
}
.inner-outer{
background: rgba(255,255,255,1);
background: -moz-linear-gradient(top, rgba(255,255,255,1) 0%, rgba(246,246,246,1) 47%, rgba(243,243,243,1) 100%);
background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(255,255,255,1)), color-stop(47%, rgba(246,246,246,1)), color-stop(100%, rgba(243,243,243,1)));
background: -webkit-linear-gradient(top, rgba(255,255,255,1) 0%, rgba(246,246,246,1) 47%, rgba(243,243,243,1) 100%);
background: -o-linear-gradient(top, rgba(255,255,255,1) 0%, rgba(246,246,246,1) 47%, rgba(243,243,243,1) 100%);
background: -ms-linear-gradient(top, rgba(255,255,255,1) 0%, rgba(246,246,246,1) 47%, rgba(243,243,243,1) 100%);
background: linear-gradient(to bottom, rgba(255,255,255,1) 0%, rgba(246,246,246,1) 47%, rgba(243,243,243,1) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#f3f3f3', GradientType=0 );
    border-radius: 11px;

    box-shadow: 1px 0px 5px 6px #eee;
}
</style>
<div class="TopLogin">
  <div style="float:right;">
    <? foreach($BANNER_ARRAY as $banner){ if($banner['position'] =="middle"){ print $banner['display'];}} ?>
  </div>
  <span>
  <?=$PageTitle ?>
  </span></div>
<br>
<div id="eMeeting" class="user">
  <div class="header account_tabs">
    <ul>
      <li <? if($show_page=="home"){ ?>class="selected"<? } ?>><a href="<?=DB_DOMAIN ?>index.php?dll=overview"><span>
        <?=$GLOBALS['_LANG']['_accountOverview'] ?>
        </span></a></li>
      <? if(D_FREE =="no"){ ?>
      <li <? if($page=="subscribe"){ ?>class="selected"<? } ?>><a href="<?=DB_DOMAIN ?>index.php?dll=subscribe"><span>
        <?=$GLOBALS['LANG_OVERVIEW']['51'] ?>
        </span></a></li>
      <? } ?>
      <li <? if($show_page=="viewed"){ ?>class="selected"<? } ?>><a href="<?=DB_DOMAIN ?>index.php?dll=overview&sub=viewed"><span>
        <?=$GLOBALS['LANG_OVERVIEW']['a21'] ?>
        </span></a></li>
    </ul>
    <div class="ClearAll"></div>
  </div>
</div>
<br>
<? if($show_page=="home"){ ?>
<div class="menu_box_title1">
  <?=$PageTitle ?>
</div>
<div class="menu_box_body1" id="s1">
  <div class="" style="padding-bottom: 15px;">
  <div class="row">
  
   <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 overview_left_outer">
    <div class="inner-outer">
    <div class="row">
    <div class="col-xs-4 col-sm-4 col-md-5 col-lg-5 overview_left_part" >
       <div style="margin-left:10px;"> <img src="<?=$GLOBALS['MyProfile']['image'] ?>&x=96&y=96" border="0" width="95" height="95" style="margin-top:17px;border:4px solid #dddddd;">
            <div style="margin-top:20px;"> <a href="<?=DB_DOMAIN ?>index.php?dll=gallery&sub=display" style="text-decoration:none;"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/photo.png" align="absmiddle">
              <?=$GLOBALS['LANG_OVERVIEW']['94'] ?>
              </a> <br>
              <a href="<?=DB_DOMAIN ?>index.php?dll=gallery&sub=albums" style="text-decoration:none;"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/book_open.png" align="absmiddle">
              <?=$LANG_GALLERY_MENU['albums'] ?>
              </a> </div>
          </div>
          </div>
          <div class="col-xs-8 col-sm-8 col-md-7 col-lg-7" >
          <div style="font-size:22px; margin-top:20px;">
            <?=$GLOBALS['LANG_OVERVIEW']['92'] ?>
            <?=$_SESSION['username'] ?>
          </div>
          <div style="font-size:12px;height:40px;line-height:40px;">
            <?=$GLOBALS['LANG_OVERVIEW']['93'] ?>
          </div>
          <div class="MyDailyStatus"  style="width:220px; background:#D5D5D5;overflow:auto;"><span id="MyDailyStatus">
            <?=$GLOBALS['MyProfile']['status'] ?>
            </span></div>
          <script type="text/javascript"> new Ajax.InPlaceEditor('MyDailyStatus', '<?=DB_DOMAIN ?>inc/ajax/_actions.php', { okText:'Ok', callback: function(form, value) { return 'action=ChangeStatusMsg&msg=' + encodeURIComponent(value)}})</script> 
          <br>
          <div id="ProfileComplete" style="margin-left:10px;">
            <dl>
              <dt>&nbsp;&nbsp; <a href="<?=DB_DOMAIN ?>index.php?dll=account&sub=edit" style="font-size:12px; text-decoration:none;">
                <?=$GLOBALS['_LANG']['_CompleteProfile'] ?>
                (
                <?=$GLOBALS['MyProfile']['profile_complete'] ?>
                %) <img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/pencil.png" width="16" height="16" align="absmiddle"></a></dt>
              <dd style="margin-top:10px;"> <span><em style="left:<?=$GLOBALS['MyProfile']['profile_complete']*2 ?>px">
                <?=$GLOBALS['MyProfile']['profile_complete'] ?>
                %</em></span> </dd>
            </dl>
          </div>
          
          </div>
          </div> 
          </div>
          </div>
          
  <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 overview_right_part">
      <div class="inner-outer" style="font-size: 14px; padding-top: 5px; padding-bottom: 11px; margin-top: 11px;">
        <div style="margin-top:15px;"></div>
          <span style="margin-left:20px;"><b>
          <?=$GLOBALS['_LANG']['_alert1'] ?>
          </b></span>
          <ul style="line-height:26px; margin-left:20px;margin-top:8px;font-size:11.5px;" class="profile-links">
            <li><a href="<?=DB_DOMAIN ?>index.php?dll=search&page=1&online=1" style="text-decoration:none;"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/m_1.png" align="absmiddle">
              <?=$HEADER_MEMBERS_ONLINE ?>
              <?=$GLOBALS['_LANG']['_members'] ?>
              <?=$GLOBALS['_LANG']['_online'] ?>
              </a></li>
            <? if(D_MESSAGES ==1){ ?>
            <li><a href="<?=DB_DOMAIN ?>index.php?dll=messages&sub=inbox" style="text-decoration:none;"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/m_3.png" align="absmiddle">
              <?=$MyAlertsArray[1]['total'] ?>
              <?=$GLOBALS['LANG_COMMON'][39] ?>
              </a></li>
            <? } ?>
            <? if(D_COMMENTS ==1){ ?>
            <li><a href="<?=DB_DOMAIN ?>index.php?dll=account&sub=comments" style="text-decoration:none;"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/m_2.png" align="absmiddle">
              <?=$MyAlertsArray[3]['total'] ?>
              <?=$GLOBALS['LANG_COMMON'][41] ?>
              </a></li>
            <? } ?>
            <? if(D_FRIENDS ==1){ ?>
            <li><a href="<?=DB_DOMAIN ?>index.php?dll=friends" style="text-decoration:none;"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/m_4.png" align="absmiddle">
              <?=$MyAlertsArray[2]['total'] ?>
              <?=$GLOBALS['LANG_COMMON'][40] ?>
              </a></li>
            <? } ?>
            <? if(UPGRADE_SMS =="yes"){ ?>
            <li><a href="<?=DB_DOMAIN ?>index.php?dll=settings&sub=sms" style="text-decoration:none;"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/m_5.png" align="absmiddle">
              <?=$GLOBALS['MyProfile']['SMS_credits'] ?>
              <?=$LANG_SETTINGS['a13'] ?>
              </a></li>
            <? } ?>
            <li><a href="<?=DB_DOMAIN ?>index.php?dll=overview&sub=viewed" style="text-decoration:none;"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/m_6.png" align="absmiddle">
              <?=$GLOBALS['MyProfile']['hits'] ?>
              <?=$GLOBALS['_LANG']['_profile'] ?>
              <?=$GLOBALS['_LANG']['_views'] ?>
              </a></li>
          </ul>  
          </div>
      </div>
  </div>
  		
  </div>
     
  	
  </div>
  
  
  
  
  
  <? if($show_page=="home"){ 

	 /**
	 * Page: Overview Page
	 *
	 * @version  9.0
	 * @created  Fri Jan 18 10:48:31 EEST 2008
	 * @updated  Fri Sep 24 16:28:31 EEST 2008
	 */

?>
<? if(D_FOLLOW ==1){ ?>
<div class="menu_box_title1">Recent Follower Updates[ <a href="<?=DB_DOMAIN ?>index.php?dll=follow">
  <?=$GLOBALS['_LANG']['_edit']; ?>
  </a> ]</div>
<div class="menu_box_body1" id="s1">
  <div style="margin-left:15px;">
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
		displayCommentsBox("550", "follow", "overview", $_SESSION['uid'], $_SESSION['uid'],0,0,false,true,10) ?>
  </div>
</div>
<? } ?>
<br>
<div class="menu_box_title1">
  <?=$lang_overview_page[90] ?>
  -
  <? $ff = MatchCount(); if($ff != 0 && $ff != '0'){ print $ff." ". $GLOBALS['_LANG']['_results']; } ?>
  [ <a href="<?=DB_DOMAIN ?>index.php?dll=settings&sub=settings">
  <?=$GLOBALS['_LANG']['_edit']; ?>
  </a> ]</div>
<div class="menu_box_body1" id="s1">
  <table width="650" border="0">
    <tr>
      <?  if(!empty($MemberMatches)){ ?>
      <? $i=1; foreach($MemberMatches as $value){ if($i ==4){ print "</tr> <tr>"; $i=1;} ?>
      <td><div class="BorderBox1">
          <table width="200" border="0">
            <tr valign="top">
              <td width="80"><a href="<?=$value['link'] ?>"><img src="<?=$value['image'] ?>" class="img_border" width="48" height="48"></a></td>
              <td width="129" height="70" style="font-size:12px;"><b>
                <?=$value['username'] ?>
                </b> <br>
                <?=$value['gender'] ?>
                /
                <?=$value['age'] ?>
                <br>
                <?=$value['country'] ?></td>
            </tr>
          </table>
        </div></td>
      <? $i++; } ?>
      <?  } else  { ?>
      <br>
      <a href="<?=DB_DOMAIN ?>index.php?dll=settings&sub=settings">
      <?=$GLOBALS['_LANG']['_edit']; ?>
      <?=$GLOBALS['LANG_OVERVIEW']['63'] ?>
      </a> <br>
      <br>
      <br>
      <? } ?>
    </tr>
  </table>
  <?  if(!empty($MemberMatches)){ ?>
  <form method="POST" name="MemberSearch1" action="<?=DB_DOMAIN ?>index.php?dll=search&view_page=1">
    <input name="do" type="hidden" value="add" class="hidden">
    <input name="do_page" type="hidden" value="search" class="hidden">
    <input type="hidden" name="page" value="1" class="hidden">
    <input type="hidden" name="Extra[zero]" value="1" class="hidden">
    <input  class="MainBtn" type="submit" value="<?=$GLOBALS['_LANG']['_search'] ?> <?=$lang_overview_page[90] ?>">
    <input type="hidden" name="Extra[match]" value="1">
  </form>
  <?  } ?>
</div>

<div class="ClearAll"></div>
<br>

<? }elseif($show_page=="viewed"){

	 /**
	 * Page: Whos viewed my profile
	 *
	 * @version  9.0
	 * @created  Fri Jan 18 10:48:31 EEST 2008
	 * @updated  Fri Sep 24 16:28:31 EEST 2008
	 */

 ?>
<form method="post" action="<?=DB_DOMAIN ?>index.php" name="box">
  <input name="do" type="hidden" value="history" class='hidden'>
  <table width=660  border=0 align="center" cellpadding=4 cellspacing=1 bgcolor=#999999>
    <?=$table_view; ?>
  </table>
</form>
<? }?>
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
<div class="row">
<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
	<div class=" zoom_container">
                    <div>
                      <h2>
                          <?=$GLOBALS['_LANG']['_accountOverview'] ?>
                      </h2>
                    </div>
                    <div class="mhtext" colspan="3" height="94">
                    	<div>
                            <br>
                                    <?=$GLOBALS['LANG_OVERVIEW']['89'] ?>
                               
                            <div><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="1" height="9"></div>
                        </div>
                    </div>
                    
                    <div>
                      <img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="1" height="1">
                    </div>
                    <div style="cursor: pointer;border-top-width: 1px;border-top-style: solid;border-top-color: rgb(102, 102, 102);float: left;width: 100%;background-color: rgb(255, 255, 255);" onmouseover="this.style.backgroundColor='#eeeeee';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='#ffffff'">
                     <div class="zoom_blocks row" style="">
                      <div class="zoom_img col-xs-2  col-sm-1 col-md-1 col-lg-1" style="">
                      	<a href="<?=DB_DOMAIN ?>index.php?dll=gallery&sub=upload"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/zoom.png" width="16" height="16" border="0"></a>
                      </div>
                      <div class="col-xs-9 col-sm-10 col-md-10 col-lg-10"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="186" height="1"><br>
                        <a class="mhlinks" href="<?=DB_DOMAIN ?>index.php?dll=gallery&sub=upload">
                        <?=$GLOBALS['LANG_OVERVIEW']['61'] ?>
                        </a><br>
                        <a class="mhlinks2" href="<?=DB_DOMAIN ?>index.php?dll=gallery&sub=upload"><b>
                        <?=$GLOBALS['LANG_OVERVIEW']['62'] ?>
                        </b><br>
                        </a>
                      </div>
                      <div><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="38" height="1"></div>
                    </div>
                   </div>
                    <div>
                      <div colspan="3" bgcolor="#666666" height="1"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="1" height="1"></div>
                    </div>
                    <div style="cursor: pointer;border-top-width: 1px;border-top-style: solid;border-top-color: rgb(102, 102, 102);float: left;width: 100%;background-color: rgb(255, 255, 255);" onclick="document.location.href='index.php?dll=settings&sub=settings'" onmouseover="this.style.backgroundColor='#eeeeee';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='#ffffff'">
                      <div class="zoom_blocks row" style="">
                      <div class="zoom_img col-xs-2  col-sm-1 col-md-1 col-lg-1" style="">
                      	<a href="<?=DB_DOMAIN ?>index.php?dll=settings&sub=settings"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/zoom.png" border="0"></a>
                      </div>
                      <div class="col-xs-9 col-sm-10 col-md-10 col-lg-10">
                      	<img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="186" height="1"><br>
                        <a class="mhlinks" href="<?=DB_DOMAIN ?>index.php?dll=settings&sub=settings">
                        <?=$GLOBALS['LANG_OVERVIEW']['63'] ?>
                        </a> <a href="<?=DB_DOMAIN ?>index.php?dll=settings&sub=settings" class="mhlinkred">[<b>
                        <?=MatchCount() ?>
                        </b>
                        <?=$GLOBALS['_LANG']['_members'] ?>
                        ]</a><br>
                        <a class="mhlinks2" href="<?=DB_DOMAIN ?>index.php?dll=settings&sub=settings"><b>
                        <?=$GLOBALS['LANG_OVERVIEW']['64'] ?>
                        </b></a><br>
                      </div>
                      <div width="38"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="38" height="1"></div>
                    </div>
                  </div>
                    <div>
                      <div colspan="3" bgcolor="#666666" height="1"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="1" height="1"></div>
                    </div>
                    <div style="cursor: pointer;border-top-width: 1px;border-top-style: solid;border-top-color: rgb(102, 102, 102);float: left;width: 100%;background-color: rgb(255, 255, 255);" onclick="document.location.href='index.php?dll=settings&sub=privacy'" onmouseover="this.style.backgroundColor='#eeeeee';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='#ffffff'">
                      <div class="zoom_blocks row" style="">
                      <div class="zoom_img col-xs-2  col-sm-1 col-md-1 col-lg-1" style="">
                      	<a href="<?=DB_DOMAIN ?>index.php?dll=settings&sub=privacy"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/zoom.png" border="0"></a>
                      </div>
                      <div class="col-xs-9 col-sm-10 col-md-10 col-lg-10"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="186" height="1"><br>
                        <a class="mhlinks" href="<?=DB_DOMAIN ?>index.php?dll=settings&sub=privacy">
                        <?=$GLOBALS['LANG_OVERVIEW']['65'] ?>
                        </a><br>
                        <a class="mhlinks2" href="<?=DB_DOMAIN ?>index.php?dll=settings&sub=privacy"><b>
                        <?=$GLOBALS['LANG_OVERVIEW']['66'] ?>
                        </b><br>
                        </a>
                      </div>
                      <div width="38"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="38" height="1"></div>
                    </div>
                  </div>
                    <? if(FLASH_VIDEO =="yes"){ ?>
                    <div>
                      <div colspan="3" bgcolor="#666666" height="1"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="1" height="1"></div>
                    </div>
                    <div style="cursor: pointer;border-top-width: 1px;border-top-style: solid;border-top-color: rgb(102, 102, 102);float: left;width: 100%;background-color: rgb(255, 255, 255);" onclick="document.location.href='index.php?dll=account&sub=video'" onmouseover="this.style.backgroundColor='#eeeeee';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='#ffffff'">
                      <div class="zoom_blocks row" style="">
                      <div class="zoom_img col-xs-2 col-sm-1 col-md-1 col-lg-1" style="">
                      	<a href="<?=DB_DOMAIN ?>index.php?dll=account&sub=video"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/zoom.png" border="0"></a>
                      </div>
                      <div class="col-xs-9 col-sm-10 col-md-10 col-lg-10"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="186" height="1"><br>
                        <a class="mhlinks" href="<?=DB_DOMAIN ?>index.php?dll=account&sub=video">
                        <?=$GLOBALS['LANG_OVERVIEW']['67'] ?>
                        </a><br>
                        <a class="mhlinks2" href="<?=DB_DOMAIN ?>index.php?dll=account&sub=video"><b>
                        <?=$GLOBALS['LANG_OVERVIEW']['68'] ?>
                        </b></a><br>
                       </div>
                      <div width="38"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="38" height="1"></div>
                    </div>
                    </div>
                    <? } ?>
                </div>
         </div>
 <!-- Account overview -->
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" style="">
                  <div class="zoom_container">
                    <div>
                      <h2>
                           <?=$GLOBALS['LANG_OVERVIEW']['52'] ?>
                      </h2>
                    </div>
                    <div class="mhtext" colspan="3" height="94">
                    	<div>
                            <br>
                                    <?=$GLOBALS['LANG_OVERVIEW']['86'] ?>
                               
                            <div><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="1" height="9"></div>
                        </div>
                    </div>
                    
                    <div>
                      <img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="1" height="1">
                    </div>
                    <div style="cursor: pointer;border-top-width: 1px;border-top-style: solid;border-top-color: rgb(102, 102, 102);float: left;width: 100%;background-color: rgb(255, 255, 255);" onclick="document.location.href='index.php?dll=gallery&sub=upload'" onmouseover="this.style.backgroundColor='#eeeeee';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='#ffffff'">
                    <div class="zoom_blocks row" style="">
                      <div class="zoom_img col-xs-2 col-sm-1 col-md-1 col-lg-1" style="">
                      	<a href="#"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/zoom.png" width="16" height="16" border="0"></a>
                      </div>
                      <div class="col-xs-9 col-sm-10 col-md-10 col-lg-10" style="float:left;"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="186" height="1"><br>
                        <a class="mhlinks" href="<?=DB_DOMAIN ?>index.php?dll=gallery&sub=albums">
                        <?=$GLOBALS['LANG_OVERVIEW']['53'] ?>
                        </a><br>
                        <a class="mhlinks2" href="<?=DB_DOMAIN ?>index.php?dll=gallery&sub=albums"><b>
                        <?=$GLOBALS['LANG_OVERVIEW']['54'] ?>
                        </b><br>
                        </a>
                      </div>
                      <div><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="38" height="1"></div>
                      </div>
                    </div>
                    <div>
                      <div colspan="3" bgcolor="#666666" height="1"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="1" height="1"></div>
                    </div>
                    <div style="cursor: pointer;border-top-width: 1px;border-top-style: solid;border-top-color: rgb(102, 102, 102);float: left;width: 100%;background-color: rgb(255, 255, 255);" onclick="document.location.href='index.php?dll=settings&sub=settings'" onmouseover="this.style.backgroundColor='#eeeeee';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='#ffffff'">
                    <div class="zoom_blocks row" style="">
                      <div class="zoom_img col-xs-2  col-sm-1 col-md-1 col-lg-1" style="">
                     	<a href="<?=DB_DOMAIN ?>index.php?dll=account&sub=edit"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/zoom.png" border="0"></a>
                      </div>
                      <div class="col-xs-9 col-sm-10 col-md-10 col-lg-10" style="float:left;">
                      	<img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="186" height="1"><br>
                        <a class="mhlinks" href="<?=DB_DOMAIN ?>index.php?dll=account&sub=edit">
                        <?=$GLOBALS['LANG_OVERVIEW']['55'] ?>
                        </a> <a href="<?=DB_DOMAIN ?>index.php?dll=account&sub=edit" class="mhlinkred">[
                        <?=showTimeSince($GLOBALS['MyProfile']['updated']) ?>
                        ]</a> <br>
                        <a class="mhlinks2" href="<?=DB_DOMAIN ?>index.php?dll=account&sub=edit"><b>
                        <?=$GLOBALS['LANG_OVERVIEW']['56'] ?>
                        </b></a> <br>
                      </div>
                      <div><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="38" height="1"></div>
                    </div>
                    </div>
                    <div>
                      <div colspan="3" bgcolor="#666666" height="1"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="1" height="1"></div>
                    </div>
                     <? if(D_FRIENDS ==1){ 	
			$MyFriends = GetFriendCounter();
?>
                    <div style="cursor: pointer;border-top-width: 1px;border-top-style: solid;border-top-color: rgb(102, 102, 102);float: left;width: 100%;background-color: rgb(255, 255, 255);" onclick="document.location.href='index.php?dll=settings&sub=privacy'" onmouseover="this.style.backgroundColor='#eeeeee';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='#ffffff'">
                     <div class="zoom_blocks row" style="">
                       <div class="zoom_img col-xs-2 col-sm-1 col-md-1 col-lg-1" style="">
                      	<a href="<?=DB_DOMAIN ?>index.php?dll=friends"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/zoom.png" border="0"></a>
                       </div>
                      <div class="col-xs-9 col-sm-10 col-md-10 col-lg-10" style="float:left;"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="186" height="1"><br>
                        <a class="mhlinks" href="<?=DB_DOMAIN ?>index.php?dll=friends">
                        <?=$GLOBALS['LANG_OVERVIEW']['57'] ?>
                        </a> <a href="<?=DB_DOMAIN ?>index.php?dll=friends" class="mhlinkred">[<b>
                        <? if(!isset($MyFriends[1]['total'])){ print 0;}else{ print $MyFriends[1]['total']; } ?>
                        </b>
                        <?=$GLOBALS['_LANG']['_friends'] ?>
                        ]</a> <br>
                        <a class="mhlinks2" href="<?=DB_DOMAIN ?>index.php?dll=friends"><b>
                        <?=$GLOBALS['LANG_OVERVIEW']['58'] ?>
                        </b></a>
                      </div>
                      <div width="38"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="38" height="1"></div>
                    </div>
                    </div>
                     <? } ?>
                    <? if(D_COMMENTS ==1){ ?>

                    <div style="cursor: pointer;border-top-width: 1px;border-top-style: solid;border-top-color: rgb(102, 102, 102);float: left;width: 100%;background-color: rgb(255, 255, 255);" onclick="document.location.href='index.php?dll=account&sub=video'" onmouseover="this.style.backgroundColor='#eeeeee';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='#ffffff'">
                      <div class="zoom_blocks row" style="">
                       <div class="zoom_img col-xs-2  col-sm-1 col-md-1 col-lg-1" style="">
                       	<a href="<?=DB_DOMAIN ?>index.php?dll=account&sub=comments"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/zoom.png" border="0"></a>
                       </div>
                      <div class="col-xs-9 col-sm-10 col-md-10 col-lg-10" style="float:left;"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="186" height="1"><br>
                       <a class="mhlinks" href="<?=DB_DOMAIN ?>index.php?dll=account&sub=comments">
                        <?=$GLOBALS['LANG_OVERVIEW']['59'] ?>
                        </a> <a href="<?=DB_DOMAIN ?>index.php?dll=account&sub=comments" class="mhlinkred">[<b>
                        <? if(!isset($ThisCount['7']['total'])){ print 0; }else{ print $ThisCount['7']['total']; } ?>
                        </b>
                        <?=$GLOBALS['_LANG']['_comments'] ?>
                        ]</a><br>
                        <a class="mhlinks2" href="<?=DB_DOMAIN ?>index.php?dll=account&sub=comments"><b>
                        <?=$GLOBALS['LANG_OVERVIEW']['60'] ?>
                        </b></a><br>
                       </div>
                       </div>
                      
                    </div>
                    <? } ?>
                </div>
                </div>
                 <!-- profile management -->

      
  
</div>



<div class="row">
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
           <div class="zoom_container">
                    <div>
                      <h2>
                          <?=$GLOBALS['LANG_COMMON']['36'] ?>
                      </h2>
                    </div>
                    <div class="mhtext" colspan="3" height="94">
                    	<div>
                            <br>
                                    <?=$GLOBALS['LANG_OVERVIEW']['87'] ?>
                               
                            <div><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="1" border="0" height="5"></div>
                        </div>
                    </div>
                    
                    <div>
                      <img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="1" height="1">
                    </div>
                    <div style="cursor: pointer;border-top-width: 1px;border-top-style: solid;border-top-color: rgb(102, 102, 102);float: left;width: 100%;background-color: rgb(255, 255, 255);" onmouseover="this.style.backgroundColor='#eeeeee';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='#ffffff'">
                     <div class="zoom_blocks row" style="">
                      <div class="zoom_img col-xs-2 col-sm-1 col-md-1 col-lg-1" style="">
                      	<a href="<?=DB_DOMAIN ?>index.php?dll=gallery&sub=upload"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/zoom.png" width="16" height="16" border="0"></a>
                      </div>
                      <div class="col-xs-9 col-sm-10 col-md-10 col-lg-10"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="186" height="1"><br>
                         <a class="mhlinks" href="<?=DB_DOMAIN ?>index.php?dll=messages&sub=create">
                        <?=$GLOBALS['LANG_OVERVIEW']['69'] ?>
                        </a><br>
                        <a class="mhlinks2" href="<?=DB_DOMAIN ?>index.php?dll=messages&sub=create"><b>
                        <?=$GLOBALS['LANG_OVERVIEW']['70'] ?>
                        </b><br>
                        </a>
                      </div>
                      <div><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="38" height="1"></div>
                    </div>
                   </div>
                    <div>
                      <div colspan="3" bgcolor="#666666" height="1"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="1" height="1"></div>
                    </div>
                    <div style="cursor: pointer;border-top-width: 1px;border-top-style: solid;border-top-color: rgb(102, 102, 102);float: left;width: 100%;background-color: rgb(255, 255, 255);" onclick="document.location.href='index.php?dll=settings&sub=settings'" onmouseover="this.style.backgroundColor='#eeeeee';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='#ffffff'">
                      <div class="zoom_blocks row" style="">
                      <div class="zoom_img col-xs-2 col-sm-1 col-md-1 col-lg-1" style="">
                      	<a href="<?=DB_DOMAIN ?>index.php?dll=messages&sub=inbox"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/zoom.png" border="0"></a>
                      </div>
                      <div class="col-xs-9 col-sm-10 col-md-10 col-lg-10">
                      	<img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="186" height="1"><br>
                       <a class="mhlinks" href="<?=DB_DOMAIN ?>index.php?dll=messages&sub=inbox">
                        <?=$GLOBALS['LANG_COMMON']['36'] ?>
                        </a> <a href="<?=DB_DOMAIN ?>index.php?dll=messages&sub=inbox" class="mhlinkred">[<b>
                        <? if(!isset($MyAlertsArray[1]['total'])){ print 0; }else{ print $MyAlertsArray[1]['total'];}  ?>
                        </b>
                        <?=$GLOBALS['_LANG']['_messages'] ?>
                        ]</a> <br>
                        <a class="mhlinks2" href="<?=DB_DOMAIN ?>index.php?dll=messages&sub=inbox"><b>
                        <?=$GLOBALS['LANG_COMMON']['36'] ?>
                        </b></a><br>
                        
                        
                      </div>
                      <div width="38"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="38" height="1"></div>
                    </div>
                  </div>
                    <div>
                      <div colspan="3" bgcolor="#666666" height="1"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="1" height="1"></div>
                    </div>
                     <? if(UPGRADE_SMS =="yes"){ ?>
                    <div style="cursor: pointer;border-top-width: 1px;border-top-style: solid;border-top-color: rgb(102, 102, 102);float: left;width: 100%;background-color: rgb(255, 255, 255);" onclick="document.location.href='index.php?dll=settings&sub=privacy'" onmouseover="this.style.backgroundColor='#eeeeee';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='#ffffff'">
                      <div class="zoom_blocks row" style="">
                      <div class="zoom_img col-xs-2 col-sm-1 col-md-1 col-lg-1" style="">
                      	<a href="<?=DB_DOMAIN ?>index.php?dll=settings&sub=sms"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/zoom.png" border="0"></a>
                      </div>
                      <div class="col-xs-9 col-sm-10 col-md-10 col-lg-10"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="186" height="1"><br>
                        <a class="mhlinks" href="<?=DB_DOMAIN ?>index.php?dll=settings&sub=sms">
                        <?=$GLOBALS['LANG_OVERVIEW']['71'] ?>
                        </a> <a href="<?=DB_DOMAIN ?>index.php?dll=settings&sub=sms" class="mhlinkred">[<b>
                        <?=$GLOBALS['MyProfile']['SMS_credits'] ?>
                        </b>
                        <?=$GLOBALS['_LANG']['_credits']  ?>
                        ]</a> <br>
                        <a class="mhlinks2" href="<?=DB_DOMAIN ?>index.php?dll=settings&sub=sms"><b>
                        <?=$GLOBALS['LANG_OVERVIEW']['72'] ?>
                        </b></a><br>
                      </div>
                      <div width="38"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="38" height="1"></div>
                    </div>
                  </div>
                   <? } ?>
                 
                    <div>
                      <div colspan="3" bgcolor="#666666" height="1"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="1" height="1"></div>
                    </div>
                    <div style="cursor: pointer;border-top-width: 1px;border-top-style: solid;border-top-color: rgb(102, 102, 102);float: left;width: 100%;background-color: rgb(255, 255, 255);" onclick="document.location.href='index.php?dll=account&sub=video'" onmouseover="this.style.backgroundColor='#eeeeee';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='#ffffff'">
                      <div class="zoom_blocks row" style="">
                      <div class="zoom_img col-xs-2  col-sm-1 col-md-1 col-lg-1" style="">
                      	<a href="<?=DB_DOMAIN ?>index.php?dll=settings&sub=alerts"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/zoom.png" border="0"></a>
                      </div>
                      <div class="col-xs-9 col-sm-10 col-md-10 col-lg-10"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="186" height="1"><br>
                         <a class="mhlinks" href="<?=DB_DOMAIN ?>index.php?dll=settings&sub=alerts">
                        <?=$GLOBALS['LANG_OVERVIEW']['73'] ?>
                        </a><br>
                        <a class="mhlinks2" href="<?=DB_DOMAIN ?>index.php?dll=settings&sub=alerts"><b>
                        <?=$GLOBALS['LANG_OVERVIEW']['74'] ?>
                        </b><br>
                        </a>
                       </div>
                      <div width="38"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="38" height="1"></div>
                    </div>
                    </div>
                  
                </div>
                </div>
         <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" style="">
             <div class="zoom_container">
                    <div>
                      <h2>
                           <?=$GLOBALS['LANG_OVERVIEW']['75'] ?>
                      </h2>
                    </div>
                    <div class="mhtext" colspan="3" height="94">
                    	<div>
                            <br>
                                    <?=$GLOBALS['LANG_OVERVIEW']['88'] ?>
                               
                            <div><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="1" height="9"></div>
                        </div>
                    </div>
                    
                    <div>
                      <img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="1" height="1">
                    </div>
                     <? if(D_GROUPS ==1){ ?>
                    <div style="cursor: pointer;border-top-width: 1px;border-top-style: solid;border-top-color: rgb(102, 102, 102);float: left;width: 100%;background-color: rgb(255, 255, 255);" onclick="document.location.href='index.php?dll=gallery&sub=upload'" onmouseover="this.style.backgroundColor='#eeeeee';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='#ffffff'">
                    <div class="zoom_blocks row" style="">
                      <div class="zoom_img col-xs-2  col-sm-1 col-md-1 col-lg-1" style="">
                      	<a href="<?=DB_DOMAIN ?>index.php?dll=groups&sub=manage"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/zoom.png" width="16" height="16" border="0"></a>
                      </div>
                      <div class="col-xs-9 col-sm-10 col-md-10 col-lg-10" style="float:left;"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="186" height="1"><br>
                        <a class="mhlinks" href="<?=DB_DOMAIN ?>index.php?dll=groups&sub=manage">
                        <?=$GLOBALS['LANG_COMMON'][37] ?>
                        </a> <a href="<?=DB_DOMAIN ?>index.php?dll=groups&sub=manage" class="mhlinkred">[<b>
                        <?=$ThisCount['1']['total'] ?>
                        </b>
                        <?=$GLOBALS['_LANG']['_groups'] ?>
                        ]</a> <br>
                        <a class="mhlinks2" href="<?=DB_DOMAIN ?>index.php?dll=groups&sub=manage"><b>
                        <?=$GLOBALS['LANG_OVERVIEW']['76'] ?>
                        </b></a><br>
                      </div>
                      <div><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="38" height="1"></div>
                      </div>
                    </div>
                     <? } ?>
                    <? if(D_EVENTS ==1){ ?>
                    <div>
                      <div colspan="3" bgcolor="#666666" height="1"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="1" height="1"></div>
                    </div>
                    <div style="cursor: pointer;border-top-width: 1px;border-top-style: solid;border-top-color: rgb(102, 102, 102);float: left;width: 100%;background-color: rgb(255, 255, 255);" onclick="document.location.href='index.php?dll=settings&sub=settings'" onmouseover="this.style.backgroundColor='#eeeeee';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='#ffffff'">
                    <div class="zoom_blocks row" style="">
                      <div class="zoom_img col-xs-2  col-sm-1 col-md-1 col-lg-1" style="">
                     	<a href="<?=DB_DOMAIN ?>index.php?dll=calendar&sub=manage"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/zoom.png" border="0"></a>
                      </div>
                      <div class="col-xs-9 col-sm-10 col-md-10 col-lg-10" style="float:left;">
                      	<img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="186" height="1"><br>
                        <a class="mhlinks" href="<?=DB_DOMAIN ?>index.php?dll=calendar&sub=manage">
                        <?=$GLOBALS['LANG_OVERVIEW']['79'] ?>
                        </a> <a href="<?=DB_DOMAIN ?>index.php?dll=calendar&sub=manage" class="mhlinkred">[<b>
                        <?=$ThisCount['2']['total'] ?>
                        </b>
                        <?=$GLOBALS['_LANG']['_event'] ?>
                        ]</a><br>
                        <a class="mhlinks2" href="<?=DB_DOMAIN ?>index.php?dll=calendar&sub=manage"><b>
                        <?=$GLOBALS['LANG_OVERVIEW']['80'] ?>
                        </b><br>
                        </a>
                      </div>
                      <div><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="38" height="1"></div>
                    </div>
                    </div>
                     <? } ?>
                    <? if(D_CLASSADS ==1){ ?>
                    <div>
                      <div colspan="3" bgcolor="#666666" height="1"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="1" height="1"></div>
                    </div>
                    
                    <div style="cursor: pointer;border-top-width: 1px;border-top-style: solid;border-top-color: rgb(102, 102, 102);float: left;width: 100%;background-color: rgb(255, 255, 255);" onclick="document.location.href='index.php?dll=settings&sub=privacy'" onmouseover="this.style.backgroundColor='#eeeeee';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='#ffffff'">
                     <div class="zoom_blocks row" style="">
                       <div class="zoom_img col-xs-2  col-sm-1 col-md-1 col-lg-1" style="">
                      	<a href="<?=DB_DOMAIN ?>index.php?dll=classads&sub=search&fcid=0"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/zoom.png" border="0"></a>
                       </div>
                      <div class="col-xs-9 col-sm-10 col-md-10 col-lg-10" style="float:left;"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="186" height="1"><br>
                        <a class="mhlinks" href="<?=DB_DOMAIN ?>index.php?dll=classads&sub=manage">
                        <?=$GLOBALS['LANG_OVERVIEW']['81'] ?>
                        </a> <a href="<?=DB_DOMAIN ?>index.php?dll=classads&sub=manage" class="mhlinkred">[<b>
                        <?=$ThisCount['3']['total'] ?>
                        </b>
                        <?=$GLOBALS['_LANG']['_advert'] ?>
                        ]</a><br>
                        <a class="mhlinks2" href="<?=DB_DOMAIN ?>index.php?dll=classads&sub=manage"><b>
                        <?=$GLOBALS['LANG_OVERVIEW']['82'] ?>
                        </b></a><br>
                      </div>
                      <div width="38"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="38" height="1"></div>
                    </div>
                    </div>
                    <? } ?>
                    <? if(D_BLOG ==1){ ?>

                    <div style="cursor: pointer;border-top-width: 1px;border-top-style: solid;border-top-color: rgb(102, 102, 102);float: left;width: 100%;background-color: rgb(255, 255, 255);" onclick="document.location.href='index.php?dll=account&sub=video'" onmouseover="this.style.backgroundColor='#eeeeee';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='#ffffff'">
                      <div class="zoom_blocks row" style="">
                       <div class="zoom_img col-xs-2  col-sm-1 col-md-1 col-lg-1" style="">
                       	<a href="<?=DB_DOMAIN ?>index.php?dll=blog&sub=view"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/zoom.png" border="0"></a>
                       </div>
                      <div class="col-xs-9 col-sm-10 col-md-10 col-lg-10" style="float:left;"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="186" height="1"><br>
                       <a class="mhlinks" href="<?=DB_DOMAIN ?>index.php?dll=blog&sub=view">
                        <?=$GLOBALS['LANG_OVERVIEW']['83'] ?>
                        </a> <a href="<?=DB_DOMAIN ?>index.php?dll=blog&sub=view" class="mhlinkred">[<b>
                        <?=$ThisCount['4']['total'] ?>
                        </b>
                        <?=$lang_main_menu['blog&sub=search'] ?>
                        ]</a> <br>
                        <a class="mhlinks2" href="<?=DB_DOMAIN ?>index.php?dll=blog&sub=view"><b>
                        <?=$GLOBALS['LANG_OVERVIEW']['84'] ?>
                        </b><br>
                        </a>
                       </div>
                       </div>
                      
                    </div>
                    <? } ?>
                </div>
                </div>  

</div>



<!--

  <div class="overviewBox"> 
    <table width="650"  border="0">
      <tr>
        <td width="167" valign="top" style="font-size:12px;line-height:24px;"><div style="margin-left:30px;"> <img src="<?=$GLOBALS['MyProfile']['image'] ?>&x=96&y=96" border="0" width="95" height="95" style="margin-top:17px;border:4px solid #dddddd;">
            <div style="margin-top:20px;"> <a href="<?=DB_DOMAIN ?>index.php?dll=gallery&sub=display" style="text-decoration:none;"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/photo.png" align="absmiddle">
              <?=$GLOBALS['LANG_OVERVIEW']['94'] ?>
              </a> <br>
              <a href="<?=DB_DOMAIN ?>index.php?dll=gallery&sub=albums" style="text-decoration:none;"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/book_open.png" align="absmiddle">
              <?=$LANG_GALLERY_MENU['albums'] ?>
              </a> </div>
          </div></td>
        <td width="264" valign="top"><div style="font-size:22px; margin-top:20px;">
            <?=$GLOBALS['LANG_OVERVIEW']['92'] ?>
            <?=$_SESSION['username'] ?>
          </div>
          <div style="font-size:12px;height:40px;line-height:40px;">
            <?=$GLOBALS['LANG_OVERVIEW']['93'] ?>
          </div>
          <div class="MyDailyStatus"  style="width:220px; background:#D5D5D5;overflow:auto;"><span id="MyDailyStatus">
            <?=$GLOBALS['MyProfile']['status'] ?>
            </span></div>
          <script type="text/javascript"> new Ajax.InPlaceEditor('MyDailyStatus', '<?=DB_DOMAIN ?>inc/ajax/_actions.php', { okText:'Ok', callback: function(form, value) { return 'action=ChangeStatusMsg&msg=' + encodeURIComponent(value)}})</script> 
          <br>
          <div id="ProfileComplete" style="margin-left:10px;">
            <dl>
              <dt>&nbsp;&nbsp; <a href="<?=DB_DOMAIN ?>index.php?dll=account&sub=edit" style="font-size:12px; text-decoration:none;">
                <?=$GLOBALS['_LANG']['_CompleteProfile'] ?>
                (
                <?=$GLOBALS['MyProfile']['profile_complete'] ?>
                %) <img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/pencil.png" width="16" height="16" align="absmiddle"></a></dt>
              <dd style="margin-top:10px;"> <span><em style="left:<?=$GLOBALS['MyProfile']['profile_complete']*2 ?>px">
                <?=$GLOBALS['MyProfile']['profile_complete'] ?>
                %</em></span> </dd>
            </dl>
          </div></td>
        <td width="205" valign="top" style="font-size:14px;"><div style="margin-top:15px;"></div>
          <span style="margin-left:30px;"><b>
          <?=$GLOBALS['_LANG']['_alert1'] ?>
          </b></span>
          <ul style="line-height:26px; margin-left:30px;margin-top:8px;font-size:11.5px;">
            <li><a href="<?=DB_DOMAIN ?>index.php?dll=search&page=1&online=1" style="text-decoration:none;"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/m_1.png" align="absmiddle">
              <?=$HEADER_MEMBERS_ONLINE ?>
              <?=$GLOBALS['_LANG']['_members'] ?>
              <?=$GLOBALS['_LANG']['_online'] ?>
              </a></li>
            <? if(D_MESSAGES ==1){ ?>
            <li><a href="<?=DB_DOMAIN ?>index.php?dll=messages&sub=inbox" style="text-decoration:none;"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/m_3.png" align="absmiddle">
              <?=$MyAlertsArray[1]['total'] ?>
              <?=$GLOBALS['LANG_COMMON'][39] ?>
              </a></li>
            <? } ?>
            <? if(D_COMMENTS ==1){ ?>
            <li><a href="<?=DB_DOMAIN ?>index.php?dll=account&sub=comments" style="text-decoration:none;"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/m_2.png" align="absmiddle">
              <?=$MyAlertsArray[3]['total'] ?>
              <?=$GLOBALS['LANG_COMMON'][41] ?>
              </a></li>
            <? } ?>
            <? if(D_FRIENDS ==1){ ?>
            <li><a href="<?=DB_DOMAIN ?>index.php?dll=friends" style="text-decoration:none;"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/m_4.png" align="absmiddle">
              <?=$MyAlertsArray[2]['total'] ?>
              <?=$GLOBALS['LANG_COMMON'][40] ?>
              </a></li>
            <? } ?>
            <? if(UPGRADE_SMS =="yes"){ ?>
            <li><a href="<?=DB_DOMAIN ?>index.php?dll=settings&sub=sms" style="text-decoration:none;"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/m_5.png" align="absmiddle">
              <?=$GLOBALS['MyProfile']['SMS_credits'] ?>
              <?=$LANG_SETTINGS['a13'] ?>
              </a></li>
            <? } ?>
            <li><a href="<?=DB_DOMAIN ?>index.php?dll=overview&sub=viewed" style="text-decoration:none;"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/m_6.png" align="absmiddle">
              <?=$GLOBALS['MyProfile']['hits'] ?>
              <?=$GLOBALS['_LANG']['_profile'] ?>
              <?=$GLOBALS['_LANG']['_views'] ?>
              </a></li>
          </ul></td>
      </tr>
    </table>
    <div class="ClearAll"></div>
  </div>
  
  -->

<? }  ?>


