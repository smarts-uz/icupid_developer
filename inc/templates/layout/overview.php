<?
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
<?php  
if($show_page=="home"){
?>
<style>


#QuickBoxAdmin .announcement-header h2{
  color: #FFFFFF;
}
#QuickBoxAdmin .announcement-body{
  background: #ffffff;
}
#QuickBoxAdmin .announcement-body img{
  background: #383737;
    float: left;
    width: 100px;
    margin-right: 10px;
}
.fancybox-close{
  display: none;
}
.announcement-footer .fancybox-btn{
   
    color: #FFFFFF;
    padding: 3px 20px;
    border-radius: 6px;
    float: right;
    margin: 10px 20px 10px 0px;
}
</style>
<?php
} 
if($GLOBALS['MyProfile']['status'] ==""){ $GLOBALS['MyProfile']['status'] = D_STATUSMSG; }
?>
<? foreach($BANNER_ARRAY as $banner){ if($banner['position'] =="middle"){?>
<div class="middle_banner"><? print $banner['display'];?></div><? }} ?>


<div id="eMeeting" class="user">
  <div class="header account_tabs" style="width: 100%; padding: 0px 0px 0px 0px;">
    <ul>
    <li class="tablinks <? if($show_page=="home"){ ?>selected<? } ?>"><a href="<?=getThePermalink('overview')?>"><span style="font-size: 14px;"><?=$GLOBALS['_LANG']['_account'] ?></span></a></li>

    <? if(D_FREE =="no"){ ?><li class="tablinks <? if($page=="subscribe"){ ?>selected<? } ?>"><a href="<?=getThePermalink('subscribe')?>"><span style="font-size: 14px;"><?=$GLOBALS['LANG_OVERVIEW']['51'] ?></span></a></li><? } ?>

    <? if(D_NEAR_ME == '1'){ ?><li class="tablinks <? if($show_page=="nearme"){ ?>selected<? } ?>"><a href="<?=getThePermalink('overview/nearme')?>"><span style="font-size: 14px;"><?=$GLOBALS['LANG_OVERVIEW']['95'] ?></span></a></li>
    <?php } ?>

    <?php if(D_MEET_ME == '1'){ ?> <li class="tablinks <? if($show_page=="meetme"){ ?>selected<? } ?>"><a href="<?=getThePermalink('overview/meetme')?>"><span style="font-size: 14px;"><?=$GLOBALS['LANG_OVERVIEW']['96'] ?></span></a></li>
    <?php } ?>


   <li class="tablinks <? if($show_page=="viewed"){ ?>selected<? } ?>"><a href="<?=getThePermalink('overview/viewed')?>"><span style="font-size: 14px;"><?=$GLOBALS['LANG_OVERVIEW']['a21'] ?></span></a></li>
   </ul>

    <div class="ClearAll"></div>
 </div>
</div>

<br> 

<? if($show_page=="home"){ ?>
 
<? /*<div class="menu_box_title1"><?=$PageTitle ?></div>*/ ?>

<div class="menu_box_body1" id="overview-account-box"> 

<div class="overviewBox">
<div class="row">

    <div class="col-xs-12 col-md-7 account_overview">
        <h4 class="template_color"><?=$GLOBALS['LANG_OVERVIEW']['92'] ?> <?=$_SESSION['username'] ?></h4>
      <p>What are you looking for today?</p>      
      <div class="MyDailyStatus"  style="background:#D5D5D5;overflow:auto;width: 83%;"><span id="MyDailyStatus"><?=$GLOBALS['MyProfile']['status'] ?> </span></div>  <script type="text/javascript"> new Ajax.InPlaceEditor('MyDailyStatus', '<?=DB_DOMAIN ?>inc/ajax/_actions.php', { okText:'Ok', callback: function(form, value) { return 'action=ChangeStatusMsg&msg=' + encodeURIComponent(value)}})</script>
      <br>
        <h4>Notifications</h4>
        <?
        $notifications = GetOverviewNotifications();
        ?>
        <div id="overview-notifications" onscroll="loadMoreNotifications();">
          <ul class="notifications-list" id="notifications-list">
            <?php
            foreach ($notifications as $notification) {
            ?>
            <li>
              <div class="notification-image">
                <img src="<?=$notification['image']?>">
              </div>
              <?php

              switch ($notification['notification_type']) {
                case 'message':
                  echo '<div class="notification-content"><span>'.$notification['username'].'</span> sent you a message.
                    <div class="notification-time">'.$notification['date'].'</div>
                  </div>';
                break;
                case 'request':
                  echo '<div class="notification-content"><span>'.$notification['username'].'</span> sent you a friend request.
                    <div class="notification-time">'.$notification['date'].'</div>
                  </div>';
                break;
                case 'comment':
                  echo '<div class="notification-content"><span>'.$notification['username'].'</span> has commented on your profile
                  <div class="notification-time">'.$notification['date'].'</div>
                  </div>';
                break;
                case 'wink':
                echo '<div class="notification-content"><span>'.$notification['username'].'</span> sent you a wink.
                  <div class="notification-time">'.$notification['date'].'</div>
                  </div>';
                break;
              }
              ?>
            </li>
            <?php 
            }
            ?>  
            
          </ul>
        </div>
    </div>

    <div class="col-xs-12 col-md-5">
        <div class="account_profile_completion">
          <div class="col-md-12 profile_photo_section">
            <div class="profile_photo">
              <img src="<?=$GLOBALS['MyProfile']['image'] ?>&x=96&y=96">
            </div>

            <span class="change_profile_photo">
              <a href="<?=getThePermalink('gallery/display')?>" class="template_color"><?=$GLOBALS['LANG_OVERVIEW']['94'] ?></a>
            </span>
          </div>

          <div id="overview-profile-complete">
          
            <? /*<a href="<?=DB_DOMAIN ?>index.php?dll=account&sub=edit" style="font-size:12px; text-decoration:none;"><?=$GLOBALS['_LANG']['_CompleteProfile'] ?> (<?=$GLOBALS['MyProfile']['profile_complete'] ?>%) <img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/pencil.png" width="16" height="16" align="absmiddle"></a> */ ?>

            <p>Your profile is <?=$GLOBALS['MyProfile']['profile_complete'] ?>% complete</p>
         
            <div class="full-width"><span class="completed" style="width: <?=$GLOBALS['MyProfile']['profile_complete'] ?>%;"><?=$GLOBALS['MyProfile']['profile_complete'] ?>%</span></div>
            
            <p><a href="<?=getThePermalink('account/edit')?>" class="template_color" style="text-decoration: underline;">Complete Profile</a></p>
          </div>
          <?php if(D_COMPATIBILITY_QUIZ == 'yes'){ ?>
          <a href="<?=getThePermalink('compatibilityquiz')?>">
          <div class="overview-compatibility-section">
          
            <? /*<a href="<?=DB_DOMAIN ?>index.php?dll=account&sub=edit" style="font-size:12px; text-decoration:none;"><?=$GLOBALS['_LANG']['_CompleteProfile'] ?> (<?=$GLOBALS['MyProfile']['profile_complete'] ?>%) <img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/pencil.png" width="16" height="16" align="absmiddle"></a> */ ?>

            <div class="compatibility-title border_color">
              <h3 class="template_color">NEW FEATURE!</h3>
            </div>
            <div class="compatibility-content background_color">
              <p>Answer Compatibility Q's for better matches</p>
            </div>
         
          </div>
          </a>
          <?php 
          }
          ?>
        </div>
    </div>
</div>
<div class="ClearAll"></div>
</div>
</div>

<script type="text/javascript">

var offset = 0;
function loadMoreNotifications(){
  var scrollHeight = document.getElementById('overview-notifications').scrollHeight;
  var clHeight = document.getElementById('overview-notifications').clientHeight;
  var scrollTop = document.getElementById('overview-notifications').scrollTop;

  if((clHeight + scrollTop + 20) > scrollHeight){
    offset = offset + 10;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("notifications-list").innerHTML += this.responseText;
      }
    };
    xhttp.open("GET", "/inc/ajax/_actions.php?action=overviewNotifications&offset="+offset, true);
    xhttp.send();
  }
  //alert(document.getElementById('notifications-list').clientHeight);   

}

</script>

<? } ?>

 
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

<div class="menu_box_title1">Recent Follower Updates[ <a href="<?=getThePermalink('follow') ?>"><?=$GLOBALS['_LANG']['_edit']; ?></a> ]</div>
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
<div class="menu_box_title1"><?=$lang_overview_page[90] ?> - <? $ff = MatchCount(); if($ff != 0 && $ff != '0'){ print $ff." ". $GLOBALS['_LANG']['_results']; } ?> [ <a href="<?= getThePermalink('settings/settings') ?>"><?=$GLOBALS['_LANG']['_edit']; ?></a> ]</div>
<div class="menu_box_body1" id="s1">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
     <div class="row">
      <?  if(!empty($MemberMatches)){ ?>
      <? $i=1; foreach($MemberMatches as $value){ if($i ==4){ print "</tr> <tr>"; $i=1;} ?>
     
      <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
        <div class="width_100">
            <div class="row my-matches">
              <div class="col-md-12" style="margin-left: 1px;font-size: 14px;">
                <a href="<?=$value['link'] ?>"><img src="<?=$value['image'] ?>" class="img_border" width="48" height="48"></a>
              </div>
              <div class="match-info">
               <span class="small"> <b><?=$value['username'] ?></b></span><br>
               <span class="small"> <?=$value['gender'] ?> / <?=$value['age'] ?></span><br>
               <span class="small"><?=$value['country'] ?></span>
              </div>
            </div>

            <style type="text/css">
              .my-matches img{
              position:absolute;
              }

              .my-matches .match-info{
              position: relative;
              padding-left: 73px;
              }
            </style>
        </div>
      </div>
          <? $i++; } ?>
         <?  } else  { ?>
         <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
         <a href="<?= getThePermalink('settings/settings') ?>"><?=$GLOBALS['_LANG']['_edit']; ?>  <?=$GLOBALS['LANG_OVERVIEW']['63'] ?></a>
         <br><br><br>
         </div>
         <? } ?>
      
      
     </div>
    </div>
</div>

<?  if(!empty($MemberMatches)){ ?>
<div class="width_100"> 
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <form method="POST" name="MemberSearch1" action="<?=getThePermalink('search')?>">               
    <input name="do" type="hidden" value="add" class="hidden">            
    <input name="do_page" type="hidden" value="search" class="hidden">
    <input type="hidden" name="page" value="1" class="hidden">
    <input type="hidden" name="Extra[zero]" value="1" class="hidden">
    <input  class="MainBtn" type="submit" value="<?=$GLOBALS['_LANG']['_search'] ?> <?=$lang_overview_page[90] ?>" style="margin:0;">
    <input type="hidden" name="Extra[match]" value="1">
    </form>
  </div>
</div>
</div>
<?  } ?>


</div><br>
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 overviewOptions">
          <div class="row">
          
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                 
                    <div class="overview_bott_table">
                    
                        <div class="overview_left_side">
                            <div class="menu_box_title1"><?=$GLOBALS['_LANG']['_accountOverview'] ?></div>
                            <ul class="overview_ul">
                                 <li><?=$GLOBALS['LANG_OVERVIEW']['89'] ?> </li>
                               <li>   
                                  <div style="background-color: #ffffff; cursor: pointer;" onclick="document.location.href='<?=getThePermalink('gallery/upload')?>'" onmouseover="this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='#ffffff'">
                                
                                <div><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="186" height="1"><br>
                                    <a class="mhlinks" href="<?=getThePermalink('gallery/upload')?>"><?=$GLOBALS['LANG_OVERVIEW']['61'] ?> </a><br>
                                    <a class="mhlinks2" href="<?=getThePermalink('gallery/upload')?>"><b><?=$GLOBALS['LANG_OVERVIEW']['62'] ?></b><br>
                                </a></div>
                                <div><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="38" height="1"></div>
                              </div>
                                </li>
                                 <li>
                                  <div style="background-color: #ffffff; cursor: pointer;" onclick="document.location.href='<?=getThePermalink('settings/settings')?>'" onmouseover="this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='#ffffff'">
                                <div><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="186" height="1"><br>
                                    <a class="mhlinks" href="<?=getThePermalink('settings/settings')?>"><?=$GLOBALS['LANG_OVERVIEW']['63'] ?> </a>
                                    <a href="<?=getThePermalink('settings/settings')?>" class="mhlinkred">[<b><?=MatchCount() ?></b> <?=$GLOBALS['_LANG']['_members'] ?>]</a><br>
                                    <a class="mhlinks2" href="<?=getThePermalink('settings/settings')?>"><b><?=$GLOBALS['LANG_OVERVIEW']['64'] ?></b></a><br>
                                </div>
                                <div width="38"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="38" height="1"></div>
                              </div>
                                </li>
                                 <li>
                                  <div style="background-color: #ffffff; cursor: pointer;" onclick="document.location.href='<?=getThePermalink('settings/privacy')?>'" onmouseover="this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='#ffffff'">
                                <div width="213"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="186" height="1"><br>
                                    <a class="mhlinks" href="<?=getThePermalink('settings/privacy')?>"><?=$GLOBALS['LANG_OVERVIEW']['65'] ?> </a><br>
                                    <a class="mhlinks2" href="<?=getThePermalink('settings/privacy')?>"><b><?=$GLOBALS['LANG_OVERVIEW']['66'] ?></b><br>
                                  </a></div>
                                <div width="38"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="38" height="1"></div>
                              </div>
                                </li>
                              
        <? if(FLASH_VIDEO =="yes"){ ?>
                                 <li> 
                                  <div style="background-color: #ffffff; cursor: pointer;" onclick="document.location.href='<?=getThePermalink('account/video')?>'" onmouseover="this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='#ffffff'">
                                <div width="213"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="186" height="1"><br>
                                    <a class="mhlinks" href="<?=getThePermalink('account/video')?>"><?=$GLOBALS['LANG_OVERVIEW']['67'] ?></a><br>
                                    <a class="mhlinks2" href="<?=getThePermalink('account/video')?>"><b><?=$GLOBALS['LANG_OVERVIEW']['68'] ?></b></a><br>
                                </div>
                                <div width="38"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="38" height="1"></div>
                              </div>
                               </li>
        <? } ?>        
                 </ul>
               </div>
                    
                   </div>
                    
                     <div class="inner_spac_div"></div>
                    <!---PERFECT MATCHES QUAD-->
                    
                     <div class="overview_bott_table">
                      <div class="overview_right_side ">
                           <div class="menu_box_title1"><?=$GLOBALS['LANG_OVERVIEW']['52'] ?></div>
                           <ul class="overview_ul">
                          <li><?=$GLOBALS['LANG_OVERVIEW']['86'] ?></li>
                             
                             <li>
                              <div style="background-color: #ffffff; cursor: pointer;" onclick="document.location.href='<?=getThePermalink('gallery/albums')?>'" onmouseover="this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='#ffffff'">
                                    <div width="224"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="224" height="1"><br>
                                        <a class="mhlinks" href="<?=getThePermalink('gallery/albums')?>"><?=$GLOBALS['LANG_OVERVIEW']['53'] ?> </a><br>
                                        <a class="mhlinks2" href="<?=getThePermalink('gallery/albums')?>"><b><?=$GLOBALS['LANG_OVERVIEW']['54'] ?></b><br>
                                      </a>
                                    </div>
                              </div>
                             </li>
                             
                             <li>
                              <div style="background-color: #ffffff; cursor: pointer;" onclick="document.location.href='<?=getThePermalink('account/edit')?>'" onmouseover="this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='#ffffff'">
                                <div width="224"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="224" height="1"><br>
                                    <a class="mhlinks" href="<?=getThePermalink('account/edit')?>"><?=$GLOBALS['LANG_OVERVIEW']['55'] ?> </a>
                                    <a href="<?=getThePermalink('account/edit')?>" class="mhlinkred">[<?=showTimeSince($GLOBALS['MyProfile']['updated']) ?>]</a> <br>
                                    <a class="mhlinks2" href="<?=getThePermalink('account/edit')?>"><b><?=$GLOBALS['LANG_OVERVIEW']['56'] ?></b></a> <br>
                                </div>
                              </div>
                           </li>
                          
              <? if(D_FRIENDS ==1){   
                                        $MyFriends = GetFriendCounter();
                            ?>
                            <li>
                              <div style="background-color: #ffffff; cursor: pointer;" onclick="document.location.href='<?=getThePermalink('friends')?>'" onmouseover="this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='#ffffff'">
                                   <div width="224"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="224" height="1"><br>
                                      <a class="mhlinks" href="<?=getThePermalink('friends')?>"><?=$GLOBALS['LANG_OVERVIEW']['57'] ?></a>
                                        <a href="<?=getThePermalink('friends')?>" class="mhlinkred">[<b><? if(!isset($MyFriends[1]['total'])){ print 0;}else{ print $MyFriends[1]['total']; } ?></b> <?=$GLOBALS['_LANG']['_friends'] ?>]</a> <br>

                                        <a class="mhlinks2" href="<?=getThePermalink('friends')?>"><b><?=$GLOBALS['LANG_OVERVIEW']['58'] ?></b></a>
                                   </div>
                              </div>
                            </li>
    <? } ?>
    <? if(D_COMMENTS ==1){ ?>
                  <li>
                              <div style="background-color: #ffffff; cursor: pointer;" onclick="document.location.href='<?=getThePermalink('account/comments')?>'" onmouseover="this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='#ffffff'">
                                <div width="224"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="224" height="1"><br>
                                    <a class="mhlinks" href="<?=getThePermalink('account/comments')?>"><?=$GLOBALS['LANG_OVERVIEW']['59'] ?></a> 
                                    <a href="<?=getThePermalink('account/comments')?>" class="mhlinkred">[<b><? if(!isset($ThisCount['7']['total'])){ print 0; }else{ print $ThisCount['7']['total']; } ?></b> <?=$GLOBALS['_LANG']['_comments'] ?>]</a><br>
                                    <a class="mhlinks2" href="<?=getThePermalink('account/comments')?>"><b><?=$GLOBALS['LANG_OVERVIEW']['60'] ?></b></a><br>
                                </div>
                              </div>
    <? } ?>         </li>
              </ul>
                        </div>
                </div>
              
            </div>
      </div>
  </div>
</div>
<div class="ClearAll"></div><br>
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-12 col-sm-12 overviewOptions">
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-sm-12">
                  <!---PROFILE MANAGMENT QUAD-->
                  
                  <div class="overview_bott_table">
                   <div class="overview_left_side">
                    <div class="menu_box_title1"><?=$GLOBALS['LANG_COMMON']['36'] ?></div>
                    <ul class="overview_ul">
                      <li><?=$GLOBALS['LANG_OVERVIEW']['87'] ?></li>
                      <li>
                        <div style="background-color: #ffffff; cursor: pointer;" onclick="document.location.href='<?=getThePermalink('messages/create')?>'" onmouseover="this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='#ffffff'">
                          <div><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="186" height="1"><br>
                              <a class="mhlinks" href="<?=getThePermalink('messages/create')?>"><?=$GLOBALS['LANG_OVERVIEW']['69'] ?></a><br>
                              <a class="mhlinks2" href="<?=getThePermalink('messages/create')?>"><b><?=$GLOBALS['LANG_OVERVIEW']['70'] ?></b><br>
                            </a></div>
                          <div><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="38" height="1"></div>
                        </div>
                      </li>
                      <li>
                        <div style="background-color: #ffffff; cursor: pointer;" onclick="document.location.href='<?=getThePermalink('messages/inbox')?>'" onmouseover="this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='#ffffff'">
                          <div width="213"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="186" height="1"><br>
                              <a class="mhlinks" href="<?=getThePermalink('messages/inbox')?>"><?=$GLOBALS['LANG_COMMON']['36'] ?></a> 
                              <a href="<?=getThePermalink('messages/inbox')?>" class="mhlinkred">[<b><? if(!isset($MyAlertsArray[1]['total'])){ print 0; }else{ print $MyAlertsArray[1]['total'];}  ?></b> <?=$GLOBALS['_LANG']['_messages'] ?>]</a> <br>
                              <a class="mhlinks2" href="<?=getThePermalink('messages/inbox')?>"><b><?=$GLOBALS['LANG_COMMON']['36'] ?></b></a><br>
                          </div>
                          <div width="38"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="38" height="1"></div>
                        </div>
                      </li>
                       <? if(UPGRADE_SMS =="yes"){ ?>
                      <li>
                       <div style="background-color: #ffffff; cursor: pointer;" onclick="document.location.href='<?=getThePermalink('settings/sms')?>'" onmouseover="this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='#ffffff'">
                          <div width="213"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="186" height="1"><br>
                              <a class="mhlinks" href="<?=getThePermalink('settings/sms')?>"><?=$GLOBALS['LANG_OVERVIEW']['71'] ?> </a>
                              <a href="<?=getThePermalink('settings/sms')?>" class="mhlinkred">[<b><?=$GLOBALS['MyProfile']['SMS_credits'] ?></b> <?=$GLOBALS['_LANG']['_credits']  ?>]</a> <br>
                              <a class="mhlinks2" href="<?=getThePermalink('settings/sms')?>"><b><?=$GLOBALS['LANG_OVERVIEW']['72'] ?></b></a><br>
                          </div>
                          <div width="38"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="38" height="1"></div>
                        </div>
                      </li>  
                       <? } ?>
                       <li>
                        <div style="background-color: #ffffff; cursor: pointer;" onclick="document.location.href='<?=getThePermalink('settings/alerts')?>'" onmouseover="this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='#ffffff'">
                          <div width="213"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="186" height="1"><br>
                              <a class="mhlinks" href="<?=getThePermalink('settings/alerts')?>"><?=$GLOBALS['LANG_OVERVIEW']['73'] ?></a><br>
                              <a class="mhlinks2" href="<?=getThePermalink('settings/alerts')?>"><b><?=$GLOBALS['LANG_OVERVIEW']['74'] ?></b><br>
                            </a>
                           </div>
                          <div width="38"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="38" height="1"></div>
                        </div>
                       </li>
                    </ul> 
                    </div> 
                  </div>
                  
                  <div class="inner_spac_div"></div>
                  
                  <!---PERFECT MATCHES QUAD-->
                  
                  <div class="overview_bott_table">
    <? if(D_GROUPS ==1 || D_EVENTS ==1 || D_CLASSADS ==1 || D_BLOG ==1){ ?>
                    <div class="overview_right_side">
                      <div class="menu_box_title1"><?=$GLOBALS['LANG_OVERVIEW']['75'] ?></div>
                      <ul class="overview_ul">
                        <li><?=$GLOBALS['LANG_OVERVIEW']['88'] ?></li>
    <? if(D_GROUPS ==1){ ?>
                        <li>
                            <div style="background-color: #ffffff; cursor: pointer;" onclick="document.location.href='<?=getThePermalink('groups/manage')?>'" onmouseover="this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='#ffffff'">
                          <div width="224"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="224" height="1"><br>
                              <a class="mhlinks" href="<?=getThePermalink('groups/manage')?>"><?=$GLOBALS['LANG_COMMON'][37] ?></a>
                              <a href="<?=getThePermalink('groups/manage')?>" class="mhlinkred">[<b><?=(isset($ThisCount['1']['total'])) ? $ThisCount['1']['total'] : '' ?></b> <?=$GLOBALS['_LANG']['_groups'] ?>]</a> <br>
                              <a class="mhlinks2" href="<?=getThePermalink('groups/manage')?>"><b><?=$GLOBALS['LANG_OVERVIEW']['76'] ?></b></a><br>
                          </div>
                        </div>
                        </li>
    <? } ?>
    <? if(D_EVENTS ==1){ ?>
                        <li>
                            <div style="background-color: #ffffff; cursor: pointer;" onclick="document.location.href='<?=getThePermalink('calendar/manage')?>'" onmouseover="this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='#ffffff'">
                          <div width="224"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="224" height="1"><br>
                              <a class="mhlinks" href="<?=getThePermalink('calendar/manage')?>"><?=$GLOBALS['LANG_OVERVIEW']['79'] ?> </a>
                                <a href="<?=getThePermalink('calendar/manage')?>" class="mhlinkred">[<b><?=(isset($ThisCount['2']['total'])) ? $ThisCount['2']['total'] : '' ?></b> <?=$GLOBALS['_LANG']['_event'] ?>]</a><br>
                              <a class="mhlinks2" href="<?=getThePermalink('calendar/manage')?>"><b><?=$GLOBALS['LANG_OVERVIEW']['80'] ?></b><br>
                            </a></div>
                        </div>
                        </li>
    <? } ?>
    <? if(D_CLASSADS ==1){ ?>
                        <li>
                            <div style="background-color: #ffffff; cursor: pointer;" onclick="document.location.href='<?=getThePermalink('classads/manage')?>'" onmouseover="this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='#ffffff'">
                          <div width="224"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="224" height="1"><br>
                              <a class="mhlinks" href="<?=getThePermalink('classads/manage')?>"><?=$GLOBALS['LANG_OVERVIEW']['81'] ?></a>
                              <a href="<?=getThePermalink('classads/manage')?>" class="mhlinkred">[<b><?=(isset($ThisCount['3']['total'])) ? $ThisCount['3']['total'] : '' ?></b> <?=$GLOBALS['_LANG']['_advert'] ?>]</a><br>
                              <a class="mhlinks2" href="<?=getThePermalink('classads/manage')?>"><b><?=$GLOBALS['LANG_OVERVIEW']['82'] ?></b></a><br>
                          </div>
                        </div>
                        </li>
    <? } ?>
    <? if(D_BLOG ==1){ ?>
                        <li>
                            <div style="background-color: #ffffff; cursor: pointer;" onclick="document.location.href='<?=getThePermalink('blog/view')?>'" onmouseover="this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='#ffffff'">
                          <div width="224"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/spacer_002.gif" width="224" height="1"><br>
                              <a class="mhlinks" href="<?=getThePermalink('blog/view')?>"><?=$GLOBALS['LANG_OVERVIEW']['83'] ?> </a>
                              <a href="<?=getThePermalink('blog/view')?>" class="mhlinkred">[<b><?=(isset($ThisCount['4']['total'])) ? $ThisCount['4']['total'] : '' ?></b> <?=$lang_main_menu['blog&sub=search'] ?>]</a> <br>
                              <a class="mhlinks2" href="<?=getThePermalink('blog/view')?>"><b><?=$GLOBALS['LANG_OVERVIEW']['84'] ?></b><br></a>
                          </div>
                        </div>
                        </li>
                        <? } ?>   
                    </ul>
                    </div><? } ?>
                  </div>
              
            </div>
          </div>
  </div>
</div>


<? }elseif($show_page=="viewed"){

   /**
   * Page: Whos viewed my profile
   *
   * @version  9.0
   * @created  Fri Jan 18 10:48:31 EEST 2008
   * @updated  Fri Sep 24 16:28:31 EEST 2008
   */

 ?>
<style>
.profile_viewer {
    padding: 15PX;
    background: #fff;
    border: 1PX SOLID #C8C8C8;
    border-radius: 5PX;
}
.profile_viewer .menu_box_title1, .profile_viewer .menu_box_body1 {
    border: 0;
    padding: 0 !IMPORTANT;
}
.profile_viewer .menu_box_title1 {
    margin-bottom: 10PX;
    font-size: 12px;
    border-bottom: 1PX SOLID #C8C8C8;
    text-align:center;
}
.profile_viewer .menu_box_body1 {
    text-align:center;
}
.profile_viewer .img-circle {
    border-radius: 0;
}
</style>

<form method="post" action="<?=DB_DOMAIN ?>index.php" name="box">
    <input name="do" type="hidden" value="history" class='hidden'>
    <table width=660  border=0 align="center" cellpadding=4 cellspacing=1 bgcolor=#999999>
        <?=$table_view; ?>
    </table>
</form>

<? } elseif($show_page=="nearme"){
  if(D_NEAR_ME == "1")
  {
   /**
   * Page: nearme my profile
   **/

   $ExtraString="";

   $range = 500;
  if(isset($_POST['do']) && !empty($_POST)){
  
    if($_POST['SeV']['2'] !="Username" && $_POST['SeV']['2'] !=""){ $range = 500; $ExtraString .=" AND members_data.gender = '".$_POST['SeV']['2']."' "; }
    if(isset($_POST['Extra']['age2']) && $_POST['Extra']['age2'] != '' && isset($_POST['Extra']['age1']) && $_POST['Extra']['age1'] != ''){ 
      $range = 500;
      $ExtraString .= " AND members_data.age BETWEEN '".GetAgeYear(eMeetingInput($_POST['Extra']['age2']))."-AAA-01' AND '".GetAgeYear(eMeetingInput($_POST['Extra']['age1']))."-ZZZ-31' ";
    }
    if($_POST['SeV']['1'] !="0"){
      $range = 50000;
     $ExtraString .=" AND members_data.country ='".$_POST['SeV']['1']."' "; }
    
        
  
  } 
  // CREATE TWO ARRAYS, ONE FOR TOTALS AND ONE FOR COUNTRY
  $re_a_array = array(); $array_counter =0;
  $re_b_array = array();
  ///customization options are here
  $foundData=0;
  $ReturnData="";
  
  $mylocation = $DB->Row("SELECT ip_lat,ip_long FROM members WHERE id = ".$_SESSION['uid']."");


  if($mylocation['ip_long'] == '' || $mylocation['ip_lat'] == ''){
    $cords = file_get_contents("http://freegeoip.net/json/".$_SERVER['REMOTE_ADDR']);

    $cord = json_decode($cords);

    $DB->Update("UPDATE members SET ip_lat = '".$cord->latitude."',ip_long = '".$cord->longitude."',ip_code = '".$cord->country_code."' WHERE id = ".$_SESSION['uid']."");

    $mylocation['ip_lat'] = $cord->latitude;
    $mylocation['ip_long'] = $cord->longitude;

  }
  if(filter_var($mylocation['ip_lat'], FILTER_VALIDATE_FLOAT)) {

    $RnThis = "SELECT package.name AS packname, members_data.gender, members.ip_long,members.ip_lat,members.ip_country ,members.ip_code, members_data.country, members_data.gender, members.id, files.bigimage, files.type, files.approved, members_data.country, members.username, members.ip FROM members
      INNER JOIN members_data ON ( members.id = members_data.uid )
      LEFT JOIN files ON ( files.uid = members_data.uid )
      LEFT JOIN members_online ON ( members_online.logid = members_data.uid )
      LEFT JOIN package ON ( members.packageid = package.pid)
      WHERE members.ip !='00.000.00.00' AND members.ip != '127.0.0.1' AND members.ip !='' AND ACOS( SIN( RADIANS( `ip_lat` ) ) * SIN( RADIANS(".$mylocation['ip_lat'].") ) + COS( RADIANS( `ip_lat` ) ) * COS( RADIANS(".$mylocation['ip_lat'].")) * COS( RADIANS( `ip_long` ) - RADIANS(".$mylocation['ip_long'].")) ) * 6380 < $range AND members.ip_long !='' AND members.ip_lat !='' $ExtraString
      GROUP BY members.username
      ORDER BY members.id DESC LIMIT 100";
    //print $RnThis;
    $result = $DB->Query($RnThis);
    while( $row = $DB->NextRow($result) )
    { 
      
    if(!isset($row['gender'])){$row['gender']=0; }
      $gend = $DB->Row("SELECT fvCaption FROM field_list_value WHERE fvid=".$row['gender']." LIMIT 1");
      
      if($row['bigimage'] ==""){
      $UImage = "/inc/tb.php?src=".DEFAULT_IMAGE;
      }else{  
      $UImage = WEB_PATH_IMAGE_THUMBS.$row['bigimage'];
      }
      $BuildHTML = "<table width=200 border=0><tr><td><img src=\"".$UImage."\" class=\"popbox_img\"></td><td valign=\"top\" class=\"popbox_text\"><b>Username: ".$row['username']."</b><br>Package: ".$row['packname']." <br> Gender: ".$gend['fvCaption']." <br> <b><a href=\"".getThePermalink('user',array('username' => $row['username']))."\" target=\"_blank\">View ".$row['username']."\'s Profile</a></b></td></tr></table>";
      $ReturnData .= "{'code': '".$row['ip_code']."', 'name': '".$row['username']."', 'latitude':".$row['ip_lat'].", 'longitude':".$row['ip_long'].",'html':'".$BuildHTML."'},";
      $recent_user_lat =  $row['ip_lat'];
      $recent_user_long = $row['ip_long'];
    }
  }
  else{
    $recent_user_lat = '38.940185';
    $recent_user_long = '-118.081055';
  }
    

  

 ?>




<link rel="stylesheet" type="text/css" media="all" href="inc/css/google_maps.css">
<style>   
 .meet-me-fields{
  width: 100%;
  float: none;
  text-align:center;
  margin-top: 10px;
}
.meet-me-fields li{
  float: none;
  display: inline-block;
  text-align:center;
  width:auto;
  vertical-align: top;
  padding: 10px;
  
}
.meet-me-fields li select{
  background: #ffffff;
  max-width: 110px !important;
  height: 28px;
}
.meet-me-fields li label{
  padding: 4px 4px 4px 0px;
}
.meet-me-fields li select, .meet-me-fields li table, .meet-me-fields li label{ 
  float: left !important;
}
</style>   
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo GOOGLE_MAPS_KEY;?>" async defer></script> -->

<script type="text/javascript">
      
      
  var gmarkers = [];
  var htmls = [];
    
  function init() {
   
    var map = new google.maps.Map(document.getElementById('mapThis'), {
      center: {lat: <?=$recent_user_lat?>, lng: <?=$recent_user_long?>},
      scrollwheel: false,
      zoom: 5,
        mapTypeControl: true,
      mapTypeControlOptions: {
        style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
        position: google.maps.ControlPosition.TOP_CENTER
      },
      zoomControl: true,
      zoomControlOptions: {
        position: google.maps.ControlPosition.LEFT_CENTER
      },
      scaleControl: true,
      streetViewControl: true,
      streetViewControlOptions: {
        position: google.maps.ControlPosition.LEFT_TOP
      }
    });
    
    //handleResize();

    <?php 
    if($ReturnData != ""){
    ?>
    var markers = [ <?=$ReturnData ?> {'code': '', 'name': 'no', 'latitude':0, 'longitude':0, 'html':' ' } ];
    
      

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < markers.length; i++) {
      
      if(markers[i].name !="" && markers[i].name !="reverse" && markers[i].name !="no"){
        marker = new google.maps.Marker({
          position: new google.maps.LatLng(markers[i]['latitude'], markers[i]['longitude']),
          map: map
        });

        google.maps.event.addListener(marker, 'click', (function(marker, i) {
          return function() {
            infowindow.setContent(markers[i]['html']);
            infowindow.open(map, marker);
          }
        })(marker, i));
      }
    }
    <?php } ?> 
    }
    
    function createMarker(pointData,id) {
      var latlng = new GLatLng(pointData.latitude, pointData.longitude);   
      var marker = new GMarker(latlng);  
      GEvent.addListener(marker, "click", function() { marker.openInfoWindowHtml(pointData.html);  });
      map.addOverlay(marker); 
      gmarkers[id] = marker;
      htmls[id] = pointData.html;
      return marker;
    }
    function myclick(i) { gmarkers[i].openInfoWindowHtml(htmls[i]); }
    function handleResize() {
      var height = windowHeight() - document.getElementById('toolbar').offsetHeight - 30;
      document.getElementById('mapThis').style.height = height + 'px';
      document.getElementById('sidebar1').style.height = height + 'px';
    }
    
    function windowHeight() {
      // Standard browsers (Mozilla, Safari, etc.)
      if (self.innerHeight) {
      return self.innerHeight;
      }
      // IE 6
      if (document.documentElement && document.documentElement.clientHeight) {
       return document.documentElement.clientHeight;
      }
      // IE 5
      if (document.body) {
      return document.body.clientHeight;
      }
      // Just in case. 
      return 0;
    }
    window.onresize = handleResize;
    window.onload = init;
    window.onunload = GUnload;
    
    </script>
    
    
  
<div class="menu_box_body1">  
    
    <div id="content1">   
      <div id="map-wrapper">      
      <div id="mapThis"></div>
      </div>
      <div id="sidebar1" style="display:none;">     
      <ul id="sidebar-list" style="display:block;">     
      </ul><br class="clear">
      </div>
    </div>
   
    <form method="post" name="MemberSearch" id="MeetMeSearch" class="MemberSearch" id="toolbar" action="/overview/nearme">
        <input name="do" type="hidden" value="overview" class="hidden">
        <input name="do_page" type="hidden" value="overview" class="hidden">
        <input type="hidden" name="page" value="1" class="hidden">
        <input type='hidden' name='SeN[1]' value='country' class='hidden'>
        <input type='hidden' name='SeT[1]' value='3' class='hidden'>
        <input type='hidden' name='SeN[2]' value='gender' class='hidden'>
        <input type='hidden' name='SeT[2]' value='3' class='hidden'>
        <input type='hidden' name='SeN[3]' value='em_85820081128' class='hidden'>
        <input type='hidden' name='SeT[3]' value='3' class='hidden'>
        <ul class="meet-me-fields">

            <li class="col-xs-6 col-sm-3 col-md-3 col-lg-3 sm_padding_0"><label><?=$LANG_BODY['_gender']?></label><select name="SeV[2]">
                <?=displayGenders(1) ?>
              </select>
            </li>
            <li class="col-xs-6 col-sm-3 col-md-3 col-lg-3 sm_padding_0"><label><?=$LANG_BODY['_age'] ?></label><? print DoAge(1); ?></li>
            <li class="col-xs-6 col-sm-4 col-md-4 col-lg-4 sm_padding_0"><label><?=$LANG_BODY['_country'] ?></label>&nbsp;<? print '<SELECT name="SeV[1]"  style="width:92%" id=country onchange="eMeetingLinkedField(this.value, 54,100003);" >';print DisplayCountries("",true); ?></li>
            <li class="col-xs-6 col-sm-2 col-md-2 col-lg-2 sm_padding_0"><input type="submit" name="" value="Filter" class="MainBtn" style="padding:4px 10px"/></li>
        
        </ul>
    </form>

</div>


<? }} elseif($show_page=="meetme"){
  if(D_MEET_ME == "1")
  {

   /**
   * Page: meetme my profile
   **/

 ?>
<style>
.cls-meet-me{
  text-align:center;
  padding:10px 0px;
}
.cls-meet-me h2{
  text-align:center;
  color:#000000;
  padding:5px 0px;
}

.cls-meet-me .btn-meet-me{
  width: 100%;
  padding : 10px 0px;
}
.cls-meet-me .user-meet-me h3{
  color: #000000;
  text-align: center;
  font-size: 16px;
}
.cls-meet-me .user-meet-me{
  color: #000000;
  padding : 10px 0px;
  text-align: center;
}
.cls-meet-me .img-meet-me{
  padding : 10px 0px;
}
.meet-me-fields{
  width: 100%;
  float: left;
  text-align: center;
}
.meet-me-fields li{
  float: none;
  width:auto;
  display: inline-block;
  vertical-align: top;
  padding: 10px;
}
.meet-me-fields li select{
  background: #ffffff;
  max-width: 110px;
  height: 28px;
}
.meet-me-fields li label{
  padding: 4px 4px 4px 0px;
}
.meet-me-fields li select, .meet-me-fields li table, .meet-me-fields li label{ 
  float: left
}
.meet-me-fields .meetme-gender{
  max-width: 70px;
}


</style>
<div class="menu_box_body1 cls-meet-me"> 

<?php
  if($SearchId == '0'){

    echo "<div><h1 style='vertical-align: middle; line-height: 5;'>".$LANG_ERROR['_noResults']."</h1></div>";
  
  }
  else{
?>
<h2><?=$LANG_COMMON['42']?></h2>
  
  <div class="btn-meet-me">
    <input type="button" name="" value="Yes" class="MainBtn" onclick="meetMeYes('<?php echo $_SESSION['uid'];?>','<?php echo $SearchId;?>');"/>&nbsp;&nbsp;&nbsp;<input type="button" name="" value="No"  class="MainBtn" onclick="meetMeNo('<?php echo $_SESSION['uid'];?>','<?php echo $SearchId;?>');"/>
  </div>
  <div id="response_message"></div>
  <div class="img-meet-me">
      <a href="<?=getThePermalink('user',array('username' => $MeetProfile['username']))?>" target="_blank"><img src="/inc/tb.php?src=<?=$MeetProfile['bigimage']?>&x=300&y=300"/></a>
  </div>
  <div class="user-meet-me">
      <h3><?=$MeetProfile['username']?>, <?php echo (isset($MeetProfile['54'])) ? $MeetProfile['54'].", " : "" ?> <?php echo (isset($MeetProfile['25'])) ? $MeetProfile['25'].", " : "" ?></h3>
  </div>

<?php } ?>

  <form method="post" name="MemberSearch" id="MeetMeSearch" class="MemberSearch" action="/overview/meetme">
        <input name="do" type="hidden" value="add" class="hidden">
        <input name="do_page" type="hidden" value="overview" class="hidden">
        <input type="hidden" name="page" value="1" class="hidden">
        <input type='hidden' name='SeN[1]' value='country' class='hidden'>
        <input type='hidden' name='SeT[1]' value='3' class='hidden'>
        <input type='hidden' name='SeN[2]' value='gender' class='hidden'>
        <input type='hidden' name='SeT[2]' value='3' class='hidden'>
        <input type='hidden' name='SeN[3]' value='em_85820081128' class='hidden'>
        <input type='hidden' name='SeT[3]' value='3' class='hidden'>
        <ul class="meet-me-fields">
            <li class="col-xs-12 col-sm-3 col-md-3 col-lg-3 sm_padding_0"><label><?=$LANG_BODY['_gender']?></label><select name="SeV[2]" class="meetme-gender">
                <?=displayGenders(1) ?>
              </select>
            </li>
            <li class="col-xs-12 col-sm-3 col-md-3 col-lg-3 sm_padding_0"><label><?=$LANG_BODY['_age'] ?></label><? print DoAge(1); ?></li>
            <li class="col-xs-12 col-sm-4 col-md-4 col-lg-4 sm_padding_0"><label><?=$LANG_BODY['_country'] ?></label>&nbsp;<? print '<SELECT name="SeV[1]"  style="width:92%" id=country onchange="eMeetingLinkedField(this.value, 54,100003);" >';print DisplayCountries("",true); ?></li>
            <li class="col-xs-12 col-sm-2 col-md-2 col-lg-2 sm_padding_0"><input type="submit" name="" value="Filter" class="MainBtn" style="padding:4px 10px"/></li>
        </ul>
    </form>


</div>


<? }} /*elseif($show_page=="chat"){

   /**
   * Page: chat my profile
   **//*
   
?>

<div class="menu_box_body1"> 

<?php
  $useragent=$_SERVER['HTTP_USER_AGENT'];
   if(preg_match('/android.+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|meego.+mobile|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))) {
  
?>    

    <iframe style="width:100%;height:100%;" src="<?php echo domain_name; ?>/videochat/mobile-client/index.htm"></iframe>

<?php
   }
   else
   {
   
?>
    <iframe style="width:100%;height:100%;" src="<?php echo domain_name; ?>/videochat/include.php?uid=<?php echo $_SESSION['uid'];?>"></iframe>
<?php
   }
?>
</div>


<? }*/ ?>

<?php
/* MAIN CLOSE */
if(!isset($HEADER_SINGLE_COLUMN)){ ?></div><div class="clear"></div> <? }else{ print "</div>"; }
?>

</div> <div id="main_wrapper_bottom"></div>

</div>
