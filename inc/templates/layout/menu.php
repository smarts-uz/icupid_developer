<?
## block direct page access
defined( 'KEY_ID' ) or die( 'Restricted access' );

?>

<style>
.side_left_blog.col-xs-12.col-sm-12.col-md-12.col-lg-12 {
    float: left;
}
.side_right_blog.col-xs-12.col-sm-12.col-md-12.col-lg-12 {
    float: right;
}   
</style>

<?php
/**
* Info: Displays member profile
*       
* @version  9.0
*/
            
if(isset($_SESSION['auth']) && $_SESSION['auth'] =="yes" && isset($page) && $page == "compatibilityquiz"){ ?>
<div id="compatibility_side">
    <div id="side_box">              
        <div class="side_right_blog col-xs-12 col-sm-12 col-md-12 col-lg-12 compatibility-menu">
            <div class="pagehead-title"><?=$LANG_COMPATIBILITY['questions']?></div>
            <div class="menu_box_body">
                <ul class="profile_menu_left_small">
                <?php 
                $arrSaveData = getMyCompatibilityAnswers($_SESSION['uid']);
                $allquestions = getCompatibilityGroups(); $activeClass = 'active'; $progressTotalQ = 0; $progressCheckedQ = 0;
                
                foreach ($allquestions as $key => $value) {
                    
                    $groupFields = getCompatibilityGroupFieldsName($value['id']);
                    $groupAnswers = 0;
                    foreach ($groupFields['fieldName'] as $val) {
                        if(isset($arrSaveData[$val]) && $arrSaveData[$val] != ""){
                            $groupAnswers++;
                        }
                    }

                    if($key != 0) $activeClass = '';

                    print '<li id="list_'.$key.'" class="'.$activeClass.'">
                    <a href= "javascript:void(0)" onClick="getCurrentQuestions('.$key.');"> 
                    <div class="col-md-10">'.$value['caption'].'</div> 
                    <div class="total-right col-md-2 menuCheckedTotal" id="menu_total_questions_'.$value['id'].'" >'.$groupAnswers.'/'.$value['total_questions'].' </div>
                    </a></li>';
                    
                    $progressTotalQ += $value['total_questions'];
                    $progressCheckedQ += $groupAnswers;
                }
                            
                $percentageCompleted = round(($progressCheckedQ * 100) / $progressTotalQ);
                ?> 
                </ul>
            
                <div class="progressbar-info"><span id="completed" class="pull-left bar-info"><?php echo $percentageCompleted ?>% Completed</span> <span class="pull-right bar-info" id="menuTotalQuestions"><?php echo $progressCheckedQ."/". $progressTotalQ;?></span>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $percentageCompleted ?>%" id="percentageComplete" data-percent="<?php echo $percentageCompleted ?>">
                            <span class="sr-only">70% Complete</span>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>
<?php }
else {
 ?>


<div id="side">
    <div class="row">
       <div id="side_box">
            <?php e_sidebar() ?>
            <div class="col-md-12" id="eMeeting_Alert_Div" style="display: none;"><span id="eMeeting_Alert_Span" class="responce_alert2"></span></div> 
 
            <?=$MyAlertsBar ?>

            <span id="profile_responce_span" class="responce_alert2" style="display:none;"></span>
            <?php

            /**
            * Info: Displays member profile
            *       
            * @version  9.0
            */
                
            if((isset($_SESSION['auth']) && $_SESSION['auth'] =="yes" && isset($show_page) && $show_page == "overview") || $page=="profile_admin"){ 
            ?>
            <div class="side_left_blog col-xs-12 col-sm-12 col-md-12 col-lg-12">
             
               
                <div class="user-general-info-sidebar">

                    <div class="user-general-info-sidebar-image">
                        <div class="user-general-info-sidebar-online"></div>    
                        <a href="<?=DB_DOMAIN.'uploads/thumbs/'. $MyProfileGlobals['bigimage']; ?>" data-fancybox >
                        <img src="<?=$MyProfileGlobals['image']?>"/>
                        </a>
                    </div>
                    <div class="user-general-info-sidebar-user">
                        <h4><?=substr($profileUsername,0,30) ?></h4>
                        <ul class="user-general-info-sidebar-action">
                            <li>
                                <div class="user-general-info-sidebar-icon"><a href="#" onClick="LauncheMeetingIm('<?=DB_DOMAIN ?>'); return false;"><img src="<?=DB_DOMAIN?>images/text-chat.png"></a></div>
                            </li>
                            <?php
                            if(!isset($PACKAGEACCESS[$_SESSION['packageid']]) || !in_array("chat-chat",$PACKAGEACCESS[$_SESSION['packageid']]) ) {
                            ?>
                            <li>
                                <div class="user-general-info-sidebar-icon"><a href="javascript:void(0);" onclick="ShowHideVideoSection('block','<?=DB_DOMAIN?>chat/web?to_uid=<?=$profileId?>');"><img src="<?=DB_DOMAIN?>images/video-chat.png"></a></div>
                            </li>
                            <?php
                            }
                            ?>
                            
                        
                        </ul>
                    </div>

                    <div class="user-general-info-sidebar-desc">
                        
                        <p><?=$MyProfileGlobals['location']?>, <?=$MyProfileGlobals['country']?><br/>
                        <?=$MyProfileGlobals['age']?>,<?=$MyProfileGlobals['MyGender']?>, <?=$MyProfileGlobals['starsign']?>
                        </p>
                        

                    </div>
                    
                    <div class="user-general-info-sidebar-btns">

                        <ul>
                            <li>
                                <a <? if($_SESSION['auth'] =="yes"){  if(isset($PACKAGEACCESS[$_SESSION['packageid']]) && is_array($PACKAGEACCESS[$_SESSION['packageid']]) && !in_array("messages-create",$PACKAGEACCESS[$_SESSION['packageid']])){ ?> href="<?= getThePermalink('messages/create/'.$profileUsername)?>" <? }else{ ?> href="<?=getThePermalink('subscribe')?>" <? } ?> <? }else{ ?> href="<?=getThePermalink('login')?>" <? } ?>  class="MainBtn"><?=$GLOBALS['_LANG']['_email3']?></a>
                            </li>
                            <li><a <? if($_SESSION['auth'] =="yes"){ if(isset($PACKAGEACCESS[$_SESSION['packageid']]) && is_array($PACKAGEACCESS[$_SESSION['packageid']]) && !in_array("chatroom-wink",$PACKAGEACCESS[$_SESSION['packageid']])){ ?> href="javascript:void(0);" data-lightbox="QuickBox2" onclick="openQuickWink(<?=$profileId ?>,'<?=$profileUsername ?>','<?=$MyProfileGlobals['image'] ?>'); return false;" <? }else{ ?> href="<?=DB_DOMAIN ?>subscribe" <? } ?> <? }else{ ?> href="<?=DB_DOMAIN ?>login" <? } ?> class="MainBtn"><?=$GLOBALS['_LANG']['_wink3']?></a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" onclick="ProfileAddNet(<?=$profileId ?>,2);" class="MainBtn"><?=$GLOBALS['_LANG']['_friends3']?></a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" onclick="ProfileAddNet(<?=$profileId ?>,1);" class="MainBtn"><?=$GLOBALS['_LANG']['_hotlist3']?></a>
                            </li>
                            <li>
                                <a class="MainBtn" <? if(isset($PACKAGEACCESS[$_SESSION['packageid']]) && is_array($PACKAGEACCESS[$_SESSION['packageid']]) && !in_array("chatroom-im",$PACKAGEACCESS[$_SESSION['packageid']])){ ?>href="javascript:void(0);"  onclick="openIMWin(<?=$profileId ?>, '<?=$_SESSION['uid'] ?>','<?=DB_DOMAIN ?>','<?=$IMRoomArray['path'] ?>','<?=$IMRoomArray['width'] ?>','<?=$IMRoomArray['height'] ?>'); return false;" <? }else{ ?> href="<?=DB_DOMAIN ?>subscribe" <? } ?>> <?=$GLOBALS['_LANG']['_imchat5'] ?> </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" onclick="ProfileAddNet(<?=$profileId ?>,3);" class="MainBtn"><?=$GLOBALS['_LANG']['_block3']?></a>
                            </li>
                        </ul>
                    
                    </div>
                    <?php /*<div class="user-general-info-sidebar-btn">

                        <a class="MainBtn" href="#">Send Message</a>
                    
                    </div> */ ?>
                    
                </div>
                
            </div>
            <?php

            }
            

            /**
            * Info: Displays member profile
            *       
            * @version  9.0
            */

            if(isset($_SESSION['auth']) && $_SESSION['auth'] =="yes"){ 

            if((isset($show_page) && $show_page == "home") || (isset($page) && $page == "articles")){
            ?>
            <div class="side_left_blog col-xs-12 col-sm-12 col-md-12 col-lg-12">
             
               
                <div class="user-general-info-sidebar">

                    <div class="user-general-info-sidebar-image">
                        <div class="user-general-info-sidebar-online"></div>    
                        <a href="<?=DB_DOMAIN.'uploads/thumbs/'. $GLOBALS['MyProfile']['bigimage']; ?>" data-fancybox >
                        <img src="<?=$GLOBALS['MyProfile']['image'] ?>&x=96&y=96"/>
                        </a>
                        
                    </div>
                    <div class="user-general-info-sidebar-user">
                        <h4><?=$_SESSION['username'] ?></h4>
                        <a class="member_edit" href="<?=DB_DOMAIN ?>account/edit">Edit</a>

                    </div>

                    <div class="user-general-info-sidebar-desc">
                        
                        <div class="sidebar_membership">Membership: <span>Free</span></div>
                        

                    </div>
                    
                    <?php /*<div class="user-general-info-sidebar-btn">

                        <a class="MainBtn" href="#">Send Message</a>
                    
                    </div> */ ?>
                    
                </div>
                
            </div>
            <?
            }
            }
            ?>
            <? if(isset($_SESSION['auth']) && $_SESSION['auth'] =="yes" && isset($show_page) && $show_page=="overview"){ ?>
            <div class="side_left_blog col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="menu_box_title">
                    <?=$GLOBALS['LANG_GLO_OPTIONS']['1'] ?>
                </div>
        
                <div class="menu_box_body">
                    <? if(!isset($_SESSION['account_active']) && $MyProfileGlobals['onlinenow'] && $profileId != $_SESSION['uid'] && D_IM ==1 && $MyProfileGlobals['visible'] == 'yes' && $_SESSION['auth'] == 'yes'){  ?>
                    <p>
                        <img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/comments.png" width="16" height="16" align="absmiddle"> <a <? if(isset($PACKAGEACCESS[$_SESSION['packageid']]) && is_array($PACKAGEACCESS[$_SESSION['packageid']]) && !in_array("chatroom-im",$PACKAGEACCESS[$_SESSION['packageid']])){ ?>href="javascript:void(0);"  onclick="openIMWin(<?=$profileId ?>, '<?=$_SESSION['uid'] ?>','<?=DB_DOMAIN ?>','<?=$IMRoomArray['path'] ?>','<?=$IMRoomArray['width'] ?>','<?=$IMRoomArray['height'] ?>'); return false;" <? }else{ ?> href="<?=DB_DOMAIN ?>subscribe" <? } ?>> <?=$GLOBALS['_LANG']['_pChat'] ?> </a>
                    </p><hr>
                <? } ?>
                
                <? if(!isset($_SESSION['account_active']) && $_SESSION['uid'] !=$profileId){ ?>

                    <div>
                        <img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/email.png" width="16" height="16" align="absmiddle"> <a <? if($_SESSION['auth'] =="yes"){  if(isset($PACKAGEACCESS[$_SESSION['packageid']]) && is_array($PACKAGEACCESS[$_SESSION['packageid']]) && !in_array("messages-create",$PACKAGEACCESS[$_SESSION['packageid']])){ ?> href="<?= getThePermalink('messages/create/'.$profileUsername)?>" <? }else{ ?> href="<?= getThePermalink('subscribe')?>" <? } ?> <? }else{ ?> href="<?= getThePermalink('login')?>" <? } ?>  class="pLink"><?=$GLOBALS['LANG_COMMON'][9] ?></a>
                    </div>
                    <hr>
                <? } ?>
                
                <? if(!isset($_SESSION['account_active']) && D_WINK ==1 && $_SESSION['uid'] !=$profileId){ ?>
                    <div>
                        <img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/emoticon_smile.png" width="16" height="16" align="absmiddle">&nbsp;<a <? if($_SESSION['auth'] =="yes"){ if(isset($PACKAGEACCESS[$_SESSION['packageid']]) && is_array($PACKAGEACCESS[$_SESSION['packageid']]) && !in_array("chatroom-wink",$PACKAGEACCESS[$_SESSION['packageid']])){ ?> href="javascript:void(0);" data-lightbox="QuickBox2" onclick="openQuickWink(<?=$profileId ?>,'<?=$profileUsername ?>','<?=$MyProfileGlobals['image'] ?>'); return false;" <? }else{ ?> href="<?=DB_DOMAIN ?>subscribe" <? } ?> <? }else{ ?> href="<?=DB_DOMAIN ?>login" <? } ?>class="pLink"><?=$GLOBALS['LANG_COMMON'][10] ?></a>
                    </div>
                    <hr>
                <? } ?>
        
                <?
                if($_SESSION['auth'] =="yes"){
                    $myalert = $GLOBALS['_LANG']['_updated'];
                }
                else {
                    $myalert = "You must login to use this feature";
                }
                ?>
                
                <? if(!isset($_SESSION['account_active']) && D_FRIENDS ==1 && $_SESSION['uid'] !=$profileId){ ?>

                    <div>
                        <img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/female.png" width="16" height="16" align="absmiddle">&nbsp; <a href="javascript:void(0);" class="pLink" onclick="ProfileAddNet(<?=$profileId ?>,2);"><?=$GLOBALS['LANG_COMMON'][13] ?></a>
                    </div>
                    <hr>
                <? } ?>
                
                <? if(!isset($_SESSION['account_active']) && D_HOTLIST ==1 && $_SESSION['uid'] !=$profileId){ ?>
                    <div>
                        <img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/heart.png" width="16" height="16" align="absmiddle">&nbsp;<a href="javascript:void(0);" class="pLink" onclick="ProfileAddNet(<?=$profileId ?>,1);"><?=$GLOBALS['LANG_COMMON'][12] ?></a>
                    </div><hr>
                <? } ?>
                
                <? if(!isset($_SESSION['account_active']) && D_PARTNER ==1 && $_SESSION['uid'] !=$profileId){ ?>
                    <div>
                        <img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/user_green.png" width="16" height="16" align="absmiddle">&nbsp;<a href="javascript:void(0);" class="pLink" onclick="ProfileAddNet(<?=$profileId ?>,5);"><?=$GLOBALS['LANG_COMMON'][16] ?></a>
                    </div>
                    <hr>
                <? } ?>
        
                <? if(!isset($_SESSION['account_active']) && D_FOLLOW ==1 && isset($MyProfileGlobals['follow_approve']) && $MyProfileGlobals['follow_approve'] =="yes"){ ?>
                    <div>
                        <img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/add.png" width="16" height="16" align="absmiddle">&nbsp;<a href="javascript:void(0);" class="pLink" onclick="ProfileAddNet(<?=$profileId ?>,8);">Follow Me (<?=GetFriendCounter(8); ?> followers)</a>
                    </div>
                    <hr>
                <? } ?>
        
                <? if(!isset($_SESSION['account_active']) && D_RECOMMEND ==1){ ?>
                    <div>
                        <img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/16/check.gif" width="16" height="16" align="absmiddle">&nbsp;<a href="<?=getThePermalink('recommend/'.$profileId);?>" class="pLink">Recommend to a friend</a>
                    </div>
                    <hr>
                <? } ?>
        
                <? if(!isset($_SESSION['account_active']) && $_SESSION['uid'] !=$profileId){ ?>
                    <div>
                        <img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/cancel.png" width="16" height="16" align="absmiddle">&nbsp;<a href="javascript:void(0);" class="pLink" onclick="ProfileAddNet(<?=$profileId ?>,3);"><?=$GLOBALS['LANG_COMMON'][14] ?></a>
                    </div>
                    <hr>
                <? } ?>
                
            </div>
        </div>      

   <? } ?>


    <?php
    /**
    * Info: Displays member Credits
    *       
    * @version  9.0
    */
    
    if(isset($_SESSION['auth']) && $_SESSION['auth'] =="yes" && isset($show_page) && $show_page=="overview"){ ?>

    
        <div class="user-credit-info-sidebar col-xs-12 col-sm-12 col-md-12 col-lg-12">
        
        <div class="menu_box_title"><?=$GLOBALS['_LANG']['_credits2']?></div>
        <div class="menu_box_body">

            <div class="col-md-12">
                <p><?=$GLOBALS['_LANG']['_balance2']?><span> 852</span></p>
            </div>
    
            <div class="user-credit-info-sidebar-btn">

                <a class="MainBtn" href="<?=DB_DOMAIN ?>/index.php?dll=subscribe&view=credits">Buy More</a>
                    
            </div>
    
        </div>
    </div>

    <? 
    } 


    if(isset($_SESSION['auth']) && $_SESSION['auth'] =="yes" && isset($show_page) && $show_page=="overview"){ ?>

    
        <? if(D_SKYPE ==1 && strlen($MyProfileGlobals['skype']) > 3 && $_SESSION['auth'] =="yes" && $show_page=="overview"){ ?>
            <script type="text/javascript" src="http://download.skype.com/share/skypebuttons/js/skypeCheck.js"></script>
            <p align="center">
                <a href="skype:<?=$MyProfileGlobals['skype'] ?>?call"><img src="http://download.skype.com/share/skypebuttons/buttons/call_green_white_153x63.png" style="border: none;" width="153" height="63" alt="My status" /></a>
            </p>
            <hr>
        <? } ?>
        
    
        <? if($MyProfileGlobals['video_duration'] > 0 && $show_page == "overview"){ ?>  
    
          <div class="menu_box_title"><?=$LANG_ACCOUNT_MENU['video'] ?></div>
          <div id='preview'></div>
          <script type='text/javascript' src='<?=DB_DOMAIN ?>inc/js/swfobject.js'></script>
          <script type='text/javascript'>
          var s1 = new SWFObject('<?=DB_DOMAIN ?>inc/exe/flash/video_player_rtmp.swf','ply','215','170','9','#ffffff');
          s1.addParam('allowfullscreen','true');
          s1.addParam('allowscriptaccess','always');
          s1.addParam('wmode','transparent');
          s1.addParam('flashvars','file=eMeetingVideo_<?=$profileId ?>.flv&streamer=<?=FLASH_DOMAIN?>&autostart=false&controlbar=none');
          s1.write('preview');
        </script>
    
        <? } ?>

       <?
       if(isset($MusicFile) && $MusicFile != ''){
        ?>
        <div class="side_right_blog col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="menu_box_title"><?=$LANG_ACCOUNT_MENU['music'] ?></div>
          <div class="menu_box_body">
            <?php print $MusicFile; ?>
          </div>
       </div>
       <?php
       }
       ?>

    <? 
    } 

    /**
    * Info: Displays member adverts
    *       
    * @version  9.0
    */
    

    if(isset($_SESSION['auth']) && $_SESSION['auth'] =="yes" && !empty($show_album_array) && $show_page !="blogview"){ 

    ?>
    <div class="side_left_blog col-xs-12 col-sm-12 col-md-12 col-lg-12">
     
        <div class="menu_box_title"><?=$GLOBALS['LANG_COMMON'][5] ?></div>
        <div id="response_gallery" style="color:red;font-weight:bold;font-size:15px"></div>
        <div class="menu_box_body">
        <ul class="profile_menu_right_small">
    
        <? if(!empty($show_album_array)){ foreach($show_album_array as $value){ ?>
    
        <li style="height:65px;margin-top:7px;">
            <div style="float:left; padding-right:10px;">
                <a href="<?=$value['link'] ?>"><img src="<?=$value['image']; ?>&x=48&y=48" width="48" height="48"></a>
            </div>  
            <a href="<?=$value['link'] ?>"><b><?=$value['title'] ?></b><br><?=substr(isset($value['comment']),0,100); ?></a>
        </li><div class="ClearAll"></div>
        
    
        <? } } ?>
    
         </ul>
        </div>
        
    </div>
    <?

    }
?>

<!-- -->

<? if(isset($_SESSION['auth']) && $_SESSION['auth'] =="yes" && isset($SaveSearchData[1]) && is_array($SaveSearchData) ){ ?>
    <div class="side_left_blog col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="menu_box_title">
        <span><a onclick="new Effect.toggle('s1','blind', {queue: 'end'}); "> <img src="<?=DB_DOMAIN ?>images/DEFAULT/blank.gif" width="30" height="29" onClick="expandcontent(this,'s1')" class="menu_expand"></a></span>
                <?=$LANG_ERROR['_t13'] ?>
        </div>      
        <div class="menu_box_body" id="s14">
        
        <table width="100%"  border="0">  <?=MakeSavedSearched($SaveSearchData) ?> </table>
        
        </div>
    </div>
<? } ?>
<?php


/**
* Info: Displays Quick Links
*       
* @version  9.0
*/
    

if(isset($_SESSION['auth']) && $_SESSION['auth'] =="yes"){ 

if((isset($show_page) && $show_page=="home") || (isset($page) && $page == "articles")){

// Profile View
    
$totalLastViewed =  MyLastVisitedProfileCount($_SESSION['uid']);

//Friends
$MyTotalFriends = GetFriendCounter();

//Winks
$MyTotalWinks = CountWinks($_SESSION['uid']);

// Today's Birthday
$today_birthday =  TodaysBirthday();
?>
    <div class="side_right_blog col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="menu_box_title">Quick Links</div>
        <div class="menu_box_body">
        <ul class="quick_menu_links">
            <li><a href="<?=getThePermalink('viewed')?>">Profile Views <span class="template_color"><?=$totalLastViewed?></span></a></li>
            <li><a href="<?=getThePermalink('/search/friends/'.$_SESSION['uid'].'/detail')?>">Friends <span class="template_color"><?=$MyTotalFriends[1]['total'] ?></span></a></li>
            <li><a href="<?=getThePermalink('messages/wink')?>">Winks <span class="template_color"><?=$MyTotalWinks?></span></a></li>
            <li><a href="<?= getThePermalink('search/friends/'.$_SESSION['uid'].'/1/detail') ?>">Hot List <span class="template_color"><?=$MyTotalFriends[2]['total'] ?></span></a></li>
            <li><a href="<?=getThePermalink('birthday')?>">Today's Birthday <span class="template_color"><?=$today_birthday?></span></a></li>
        </ul>
        </div>
    </div>
<?
}
}

/**
* Info: Displays member events
*       
* @version  9.0
*/
    

if(isset($_SESSION['auth']) && $_SESSION['auth'] =="yes" && !empty($show_events_array) && $show_page=="overview"){ 

?>
    <div class="side_right_blog col-xs-12 col-sm-12 col-md-12 col-lg-12">
     
        <div class="menu_box_title"><?=$GLOBALS['LANG_COMMON']['8a'] ?></div>
        <div class="menu_box_body">
        <ul class="profile_menu_right_small">
    
        <? if(!empty($show_events_array)){ foreach($show_events_array as $value){ ?>
        <li style="padding-top:6px;height:70px;">
            <div style="float:left; padding-right:10px;">
                <a href="<?=$value['link'] ?>"><img src="<?=$value['image']; ?>&x=48&y=48" width="48" height="48"></a>
            </div>  
            <a href="<?=$value['link'] ?>"><b><?=$value['title'] ?></b><br><?=substr($value['description'],0,100); ?></a>
        </li>
        <? } } ?>
     
     
                <br><b> <img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/zoom_in.png" align="absmiddle"> <a href='<?=getThePermalink('calendar/search/'.$profileId)?>'><?=$GLOBALS['_LANG']['_viewAll'] ?> <?=$GLOBALS['LANG_COMMON']['8a'] ?></a></b>
            
    
        </ul>
    
    
        <div class="ClearAll"></div>
    
        </div>
    </div>
    <?

    }


/**
    * Info: Displays member adverts
    *       
    * @version  9.0
    */
    

    if(isset($_SESSION['auth']) && $_SESSION['auth'] =="yes"  && !empty($show_adverts_array) && $show_page=="overview"){ 

    ?>
    <div class="side_left_blog col-xs-12 col-sm-12 col-md-12 col-lg-12">
     
        <div class="menu_box_title"><?=$GLOBALS['LANG_OVERVIEW']['81'] ?></div>
        <div class="menu_box_body">
        <ul class="profile_menu_right_small">
    
        <? if(!empty($show_adverts_array)){ foreach($show_adverts_array as $value){ ?>
    
        <li style="height:65px;margin-top:7px;">
            <div style="float:left; padding-right:10px;">
                <a href="<?=$value['link'] ?>"><img src="<?=$value['image']; ?>&x=48&y=48" width="48" height="48"></a>
            </div>  
            <a href="<?=$value['link'] ?>"><b><?=strip_tags($value['title']) ?></b><br><?=strip_tags(substr($value['description'],0,100)); ?></a>
        </li><div class="ClearAll"></div>
    
    
        <? } } ?>
          
        <br><b> <img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/zoom_in.png" align="absmiddle"> <a href='<?=getThePermalink('classads/search/'.$profileId)?>'><?=$GLOBALS['_LANG']['_viewAll'] ?> </a> </b>
        </ul>
        <div class="ClearAll"></div>
        </div>
    </div>  
    <?

    }
    /**
    * Info: Displays member adverts
    *       
    * @version  9.0
    */
    ?>



<?php if(isset($_SESSION['auth']) && $_SESSION['auth'] =="yes"  && !empty($show_blog_array) ){ 

    ?>

    <div class="side_right_blog col-xs-12 col-sm-12 col-md-12 col-lg-12"> 
        <div class="menu_box_title"><?=$GLOBALS['LANG_COMMON'][7] ?></div>
        <div class="menu_box_body" id="s14">
        <ul class="profile_menu_right_small">
    
        <? if(!empty($show_blog_array)){ foreach($show_blog_array as $value){ ?>
    
        <li style="height:65px;margin-top:7px;">
            <div style="float:left; padding-right:10px;">
                <a href="<?=$value['link'] ?>"><img src="<?=$value['image']; ?>&x=48&y=48" width="48" height="48"></a>
            </div>  
            <a href="<?=$value['link'] ?>"><b><?=strip_tags(substr($value['title'],0,25)); ?></b><br><?=strip_tags(substr($value['description'],0,25)); ?></a>
        </li><div class="ClearAll"></div>
    
    
        <? } } ?>
          
        <br><b> <img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/zoom_in.png" align="absmiddle"> <a href='<?=getThePermalink('blog/search/'.$profileId)?>'><?=$GLOBALS['_LANG']['_viewAll'] ?></a> </b>
        </ul>
        <div class="ClearAll"></div>
        
    </div>
    </div>
    <?

    } ?>




<?php /* Login Information*/ ?>

<? if(isset($_SESSION['auth']) && $_SESSION['auth'] =="yes"  && isset($show_page) && $show_page=="overview" ){ ?>
    <div class="side_left_blog col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="menu_box_title">
            <?=$GLOBALS['_LANG']['_information'] ?>
        </div>      
        <div class="menu_box_body" id="s14">
            <ul class="profile_menu_right_small" style="line-height:26px; font-size:11px; margin-left:15px;">
                 
                <li><?=$MyProfileGlobals['name']; ?></li>
                <li><span><?=$GLOBALS['_LANG']['_lastLogin']?></span> <?=showTimeSince($MyProfileGlobals['lastlogin']) ?> </li>
                <li><span><?=$GLOBALS['_LANG']['_updated']?></span> <?=showTimeSince($MyProfileGlobals['updated']) ?></li>
                <li><span><?=$GLOBALS['_LANG']['_created']?></span> <?=showTimeSince($MyProfileGlobals['created']); ?></li>
                <li><span><?=$GLOBALS['_LANG']['_views']?></span> <?=$MyProfileGlobals['hits'] ?> </li>
            </ul>
        </div>
    </div>
<?php } ?>
 
    


<? if(isset($_SESSION['auth']) && $_SESSION['auth'] =="no" && $page !="login" && !isset($GLOBALS['MENU_AFFILIATE'])){ 

/**
* Info: Show the login box 
*       
* @version  9.0
* @created  Fri Sep 25 10:48:31 EEST 2008
* @updated  Fri Sep 25 10:48:31 EEST 2008
*/

?>


    <div class="side_left_blog col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="menu_box_title">
            <span><a onclick="new Effect.toggle('s1','blind', {queue: 'end'}); "> <img src="<?=DB_DOMAIN ?>images/DEFAULT/blank.gif" width="30" height="29" onClick="expandcontent(this,'s1')" class="menu_expand"></a></span>
             <?=$GLOBALS['_LANG']['_login'] ?>
        </div>      
        <div class="menu_box_body" id="s1">
    
            <form method="post" action="<?=getThePermalink('login')?>" name="MenuLoginForm" onSubmit="return CheckPageNullsLogin('<?=$GLOBALS['_LANG_ERROR']['_incomplete'] ?>');">
            <input name="do" type="hidden" value="login" class="hidden" />
             <input name="visible" value="0" type="hidden" />
             <input name="do_page" type="hidden" value="login" class="hidden" />
    
                <table width="100%"  border="0" class="menu_side validate_field">
                  <tr>
                    <td width="49%"><?=$GLOBALS['_LANG']['_username'] ?></td>
                  </tr>
                  <tr>
                    <td>
                        <input name="username" id="e_username_login" onclick="removeValidation('login_user_error');" type="text" <? if(isset($_COOKIE['emeeting']['username'])){ print "value='".$_COOKIE['emeeting']['username']."'"; } ?> class="form-control" />
                        <p class="note" id="login_user_error" style="display: none;"><img src="/images/DEFAULT/_icons/16/alert.gif">Please enter your username.</p>
                    </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><?=$GLOBALS['_LANG']['_password'] ?></td>
                  </tr>
                  <tr>
                    <td>
                        <input name="password" id="e_password_login" onclick="removeValidation('login_user_pass');" type="password" class="form-control"/>
                        <p class="note" id="login_user_pass" style="display: none;"><img src="/images/DEFAULT/_icons/16/alert.gif">Please enter your password.</p>
                    </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td style="font-size:11px;"><input name="submit" type="submit" class="MainBtn"  value="<?=$GLOBALS['_LANG']['_login'] ?>">
                    <br/>
                    <input type="checkbox" name="remember" value="1"  checked='checked'><?=$GLOBALS['_LANG']['_rememberMe']  ?></td>
                  </tr>
                  <tr>
                    <td><span style="margin:0px;font-size:11px;"> <a href="<?=getThePermalink('register');?>"><?=$GLOBALS['LANG_WELCOME']['_join2'] ?></a></span>
    
                    <? if (defined('FACEBOOK_APP_ID')  && FACEBOOK_APP_ID !="") { ?>
                    <br/>
                    <br/>
                    

                    <p class="facebook-li">
                    <a href="<?=DB_DOMAIN ?>fblogin"><img src="<?=DB_DOMAIN ?>images/facebook-login.jpg" width="211" height="53"></a>
                    </p>
                    <br/>
                    <br/>
                    <? } ?>
                    <?
                    //Twitter
                    if (defined('TWITTER_SIGNIN_KEY')  && TWITTER_SIGNIN_KEY !="") {
                    ?>
                    <p class="twitter-li">
                      <?=GetTwitterGlobalLoginButton();?>
                    </p>
                    <br/>
                    <br/>
                    <?
                    }
                    ?>
                    <?
                    //Google
                    if (defined('GOOGLE_SIGNIN_KEY')  && GOOGLE_SIGNIN_KEY !="") {
                    ?>
                    <p class="google-li">
                      
                      <a href="javascript:void()"><image id="googleSignIn" src="<?=DB_DOMAIN?>images/google-login.jpg"></a>
                      <div id="google-sign-in" style="display: none;"></div>
                    </p>
                    <?
                    }
                    ?>
    
    </td>
                  </tr>
                </table>
    
          </form>
    
        </div>
    
    </div>

<? } ?>



<? if(isset($GLOBALS['MENU_ARTICLES'])){ 


    /**
    * Info: Show the articles box
    *       
    * @version  9.0
    * @created  Fri Sep 25 10:48:31 EEST 2008
    * @updated  Fri Sep 25 10:48:31 EEST 2008
    */
?>

    <div class="side_right_blog col-xs-12 col-sm-12 col-md-12 col-lg-12">
    
        <div class="menu_box_title">
            <span><a onclick="new Effect.toggle('s2','blind', {queue: 'end'}); "> <img src="<?=DB_DOMAIN ?>images/DEFAULT/blank.gif" width="30" height="29" onClick="expandcontent(this,'s1')" class="menu_expand"></a></span>
            <?=$GLOBALS['_LANG']['_articles'] ?> <?=$GLOBALS['_LANG']['_category'] ?>
        </div>
    
        <div class="menu_box_body" id="s2">
            <ul class="menu_side">
            <? foreach($article_cats as $cat){ ?>
            <li class="article"><span><a href="<?=$cat['link'] ?>1/" style="font-size:100%;"><?=$cat['name'] ?> (<?=$cat['count'] ?>) </a></span></li>
            <? } ?>
            </ul>
        </div>
    </div>



<? }elseif(isset($GLOBALS['MENU_AFFILIATE'])){ 

    /**
    * Info: Show the affiliate box
    *       
    * @version  9.0
    * @created  Fri Sep 25 10:48:31 EEST 2008
    * @updated  Fri Sep 25 10:48:31 EEST 2008
    */

?>
    
    <div class="side_left_blog col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="menu_box_title">
            <span><a onclick="new Effect.toggle('s3','blind', {queue: 'end'}); "> <img src="<?=DB_DOMAIN ?>images/DEFAULT/blank.gif" width="30" height="29" onClick="expandcontent(this,'s1')" class="menu_expand"></a></span>
            <?=$GLOBALS['_LANG']['_affiliate'] ?> <?=$GLOBALS['_LANG']['_options'] ?>
        </div>
    
        <div class="menu_box_body" id="s3">
            <ul class="menu_side">
            <? if($affiliate_login){ ?>
            <li class="search"><a href="<?=DB_DOMAIN ?>affiliate/summary"><?=$GLOBALS['_LANG']['_accountOverview'] ?></a></li>
            <li class="search"><a href="<?=DB_DOMAIN ?>affiliate/banners"><?=$GLOBALS['_LANG']['_banners'] ?></a></li>
            <li class="search"><a href="<?=DB_DOMAIN ?>affiliate/payment"><?=$GLOBALS['_LANG']['_payments'] ?></a></li>
            <li class="search"><a href="<?=DB_DOMAIN ?>affiliate/edit"><?=$GLOBALS['_LANG']['_edit'] ?></a></li>
            <li class="search"><a href="<?=DB_DOMAIN ?>logout"><?=$GLOBALS['_LANG']['_logout'] ?></a></li>
            
            <? }else{ ?>
            <li class="search"><a href="<?=DB_DOMAIN ?>affiliate/join"><?=$GLOBALS['_LANG']['_register'] ?></a></li>
            <li class="search"><a href="<?=DB_DOMAIN ?>affiliate/login"><?=$GLOBALS['_LANG']['_login'] ?></a></li>
            <? } ?>
            </ul>
        </div>
    </div>  
    

<? }elseif(my_logged_in){ 


    /**
    * Info: main menu bars
    *       
    * @version  9.0
    * @created  Fri Sep 25 10:48:31 EEST 2008
    * @updated  Fri Sep 25 10:48:31 EEST 2008
    */
 
?>

<? if(isset($show_page) && $show_page!="overview" && $show_page!="home" && !empty($lastViewed) ){ ?>
    <div class="side_right_blog col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="menu_box_title"><span><a onclick="new Effect.toggle('s1','blind', {queue: 'end'}); "> <img src="<?=DB_DOMAIN ?>images/DEFAULT/blank.gif" width="30" height="29" onClick="expandcontent(this,'s1')" class="menu_expand"></a></span>
        <?=$GLOBALS['_LANG']['_menue1'] ?></div>
        <div class="menu_box_body" id="s1"> 


        <? foreach($lastViewed as $value){ ?>
        <div class="BorderBox2">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><a href="<?=$value['link'] ?>"><img src="<?=$value['image'] ?>" class="img_border" width="48" height="48"></a>
            <b><?=$value['username'] ?></b> <br> 
              <?=$value['gender'] ?> <? if($value['age'] != 35){ ?>/ <?=$value['age'] ?> <? } ?>  <br><?=$value['country'] ?></div>
        </div>
        </div>
        <? } ?>
        </div>
    </div>
<? } ?>
 

<? if($page !="search" && $page !="overview" && $page !="profile" && $page !="chatroom" && $page !="subscribe") { ?>
    <div class="side_left_blog col-xs-12 col-sm-12 col-md-12 col-lg-12"> 
        <div id="MenuControlMain">
        
            <div id="MenuControlHead">
            
                <div class="top">
                    <span class="user_image"><a href="<?=DB_DOMAIN ?>gallery/display"><img src="<?=$GLOBALS['MyProfile']['image'] ?>&x=58&y=58" width="58" height="58"></a></span>
                    <div class="user_name"><br><?=$_SESSION['username'] ?></div>        
                </div>
            
            </div>
        
            <!-- control body -->
            <div id="MenuControlBody">
        
                <div class="top">
        
                    <div class="user_status">
                    <span class="status_text"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/IconComment.png"> <?=$GLOBALS['LANG_GLO_OPTIONS']['12'] ?></span>
        
                    <select name="status" onChange="eMeetingOnlineStatus(this.value); return false;" style="width:100%;">
                      <option value="yes" <? if($GLOBALS['MyProfile']['visible'] =="yes"){ print "selected"; } ?>><?=$GLOBALS['LANG_GLO_OPTIONS']['13'] ?></option>
                      <option value="no" <? if($GLOBALS['MyProfile']['visible'] =="no"){ print "selected"; } ?>><?=$GLOBALS['LANG_GLO_OPTIONS']['14'] ?></option>
                    </select>
        
                </div>
                    <? if(!empty($HEADER_MENU_BAR_SUB_SUB)){ ?>
                    <div class="ListDisplay">
                    <div class="ListDisplay_text"><span><?=$GLOBALS['LANG_GLO_OPTIONS']['15'] ?></span></div>
                    
                        <ul id="MenuControlList">
                            <?=$HEADER_MENU_BAR_SUB_SUB ?>
                        </ul>
        
                    </div>
                    <? } ?>
                </div>
        
            </div>
        
            <!-- control body -->
            <div id="MenuControlBot">
                <a href="<?=DB_DOMAIN ?>logout"> 
                    <img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/cancel.png" width="16" height="16" align="absmiddle"> <?=$GLOBALS['LANG_GLO_OPTIONS']['16'] ?> 
                </a>
            </div>
        
        </div>
    </div>
<? } ?>


 

<? if($page !="overview" && $page !="search" && $page !="profile"  && $page !="subscribe"){ ?>
    <div class="side_right_blog col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="menu_box_title"><span><a onclick="new Effect.toggle('s77','blind', {queue: 'end'}); "> <img src="<?=DB_DOMAIN ?>images/DEFAULT/blank.gif" width="30" height="29" onClick="expandcontent(this,'s1')" class="menu_expand"></a></span>
        <?=$GLOBALS['_LANG']['_alert1'] ?></div>
        <div class="menu_box_body" id="s77">
        
        
     
        <ul class="emeeting_profile_alerts" style="line-height:26px;">
     
        <li><a href="<?=getThePermalink('search/online/1')?>" style="text-decoration:none;"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/m_1.png" align="absmiddle">    <?=$HEADER_MEMBERS_ONLINE ?>     <?=$GLOBALS['_LANG']['_members'] ?>  <?=$GLOBALS['_LANG']['_online'] ?></a></li>
        <? if(D_MESSAGES ==1){ ?>   <li><a href="<?=DB_DOMAIN ?>messages/inbox" style="text-decoration:none;"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/m_3.png" align="absmiddle"> <?=$MyAlertsArray[1]['total'] ?> <?=$GLOBALS['LANG_COMMON'][39] ?></a></li><? } ?>
        <? if(D_COMMENTS ==1){ ?>   <li><a href="<?=DB_DOMAIN ?>account/comments" style="text-decoration:none;"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/m_2.png" align="absmiddle"> <?=$MyAlertsArray[3]['total'] ?> <?=$GLOBALS['LANG_COMMON'][41] ?></a></li><? } ?>
        <? if(D_FRIENDS ==1){ ?><li><a href="<?=DB_DOMAIN ?>search/friends/0" style="text-decoration:none;"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/m_4.png" align="absmiddle"> <?=$MyAlertsArray[2]['total'] ?> <?=$GLOBALS['LANG_COMMON'][40] ?></a></li><? } ?>
        <? if(UPGRADE_SMS =="yes"){ ?><li><a href="<?=DB_DOMAIN ?>settings/sms" style="text-decoration:none;"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/m_5.png" align="absmiddle"> <?=$GLOBALS['MyProfile']['SMS_credits'] ?> <?=$LANG_SETTINGS['a13'] ?></a></li>  <? } ?>
        <li><a href="<?=DB_DOMAIN ?>overview/viewed" style="text-decoration:none;"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/m_6.png" align="absmiddle"> <?=$GLOBALS['MyProfile']['hits'] ?> <?=$GLOBALS['_LANG']['_profile'] ?> <?=$GLOBALS['_LANG']['_views'] ?></a></li>
        </ul>
    
    </div>
    </div>
<? } ?>


<? if(D_IM ==1 & @!in_array("chatroom-im",$PACKAGEACCESS[$_SESSION['packageid']]) && $page !="search" && $page !="profile" && $page !="chatroom" && $page !="overview"  && $page !="subscribe"){ ?>
    <div class="side_right_blog col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <a href="#" onClick="LauncheMeetingIm('<?=DB_DOMAIN ?>'); return false;"><img src="<?=DB_DOMAIN ?>inc/templates/<?=D_TEMP ?>/images/imbox.png" style="width: 100%; max-width: 200px;"></a>
    </div>
<? } ?>


<? } ?>


<? if(!empty($MenuBoxData) && isset($show_page) && $show_page != 'overview' && $show_page != 'home'){ 

    /**
    * Info: Main Dynamic Menu Box
    *       
    * @version  9.0
    * @created  Fri Sep 25 10:48:31 EEST 2008
    * @updated  Fri Sep 25 10:48:31 EEST 2008
    */

?>
    


    <div class="side_left_blog col-xs-12 col-sm-12 col-md-12 col-lg-12">
       
        <div class="menu_box_title"><span><a onclick="new Effect.toggle('s1','blind', {queue: 'end'}); "> <img src="<?=DB_DOMAIN ?>images/DEFAULT/blank.gif" width="30" height="29" onClick="expandcontent(this,'s1')" class="menu_expand"></a></span>
        <? 
        if($page =="overview" || $page =="search"){  print $LANG_ERROR['_t10'];
        }elseif($page=="profile"  && D_PROFILERATING ==1 && $show_page=="overview" ){ print $LANG_ERROR['_t11'];
        }else{ print $GLOBALS['LANG_GLO_OPTIONS']['17']; } ?></div>
        
        <div class="menu_box_body" id="s1">
        <table width="95%"  border="0" align="center" style="font-size:11px;">
        <?
        foreach($MenuBoxData as $value){ 
        ?>
        
        
            <tr valign="top" style="border-bottom:1px dashed #999999;  font-size:11px;">
                <td>
                    <a href="<?=$value['link'] ?>" title="<?=$value['title'] ?>" <? if(isset($page) && $page=="forum"){ ?>target="ListFrame"<? } ?> >
                        <img src="<?=$value['image']; ?>" title="<?=$value['title'] ?>">
                    </a>
                    <a href="<?=$value['link'] ?>" <? if(isset($page) && $page=="forum"){ ?>target="ListFrame"<? } ?>>
                        <span style="font-weight:bold;display:block;font-size:13px;"><?=$value['title'] ?></span>
                        <?=substr($value['description'],0,100); ?>
                    </a>
                </td>
            </tr>
        
    
        <?
        }
        ?>
        </table>
        </div>
    </div>
<? } ?>



    <?  if($page =="overview" && isset($show_poll) && !empty($show_poll)){  ?>
    <!--  WEBSITE POLL -->
    <div class="side_left_blog col-xs-12 col-sm-12 col-md-12 col-lg-12">    
        <form method="post" action="<?=DB_DOMAIN ?>index.php">
        <input name="do_page" type="hidden" value="overview" class="hidden">
        <input name="do" type="hidden" value="poll" class="hidden">
        <div class="menu_box_title" style="height:48px;"><?=$show_poll[1]['title'] ?></div>
        <div class="menu_box_body"><div id="VoteComplete">
        <?
            if(isset($show_poll[1]['votes'])){
                foreach($show_poll as $polld){
                     
    
            print '<dl>
                <dt>'.$polld['caption'].' ('.$polld['votes_percent'].'%)</dt>
                    <dd style="margin-top:10px;/*margin-left: -19px;*/">
                    <span><em style="left:'.($polld['votes_percent']*2).'px">'.$polld['votes_percent'].'%</em></span>
                </dd>               
            </dl>';
                    
                }
            }else{  
                foreach($show_poll as $polld){
                    print "<input type=\"radio\"  name=\"voteid\" value=\"".$polld['voteid']."\"" .isset($ex)."/>".$polld['caption']."<br>";
                    print "<input type=\"hidden\" name=\"pollid\" id=\"pollid\" value=\"".$polld['id']."\" class='hidden' style='display: none;' />";
                }
            }
        ?>
        <? if(!isset($show_poll[1]['votes'])){ ?><input  type="submit" value="<?=$GLOBALS['_LANG']['_submit'] ?>" class="button"><? } ?>
        </div></div>
        
        </form><div class="ClearAll"></div> 
    </div>   
    
    <? } ?>




<? if(isset($MyModeratorBar)){if($MyModeratorBar !=""){echo $MyModeratorBar;}} ?>

<?=$PLUGINS_MENU_BAR ?>
</div>

</div>
<!-- SIDE MENU ADVERTISING SLOT -->
<div class="menu_advertisement">
<? foreach($BANNER_ARRAY as $banner){

    /**
    * Info: BANNER DISPLAY
    *       
    * @version  9.0
    * @created  Fri Sep 25 10:48:31 EEST 2008
    * @updated  Fri Sep 25 10:48:31 EEST 2008
    */


 if($banner['position'] =="left"){ print $banner['display'];}} ?>

</div>
</div>
<?php
}
?>

<div id="video-chat-section">
    <div class="close-video-section" onclick="ShowHideVideoSection('none','');">Close</div>
    <iframe id="video-frame" src=""></iframe>
</div>
<div id="popup-notificaiton-section"></div>