</div>

<div class="clear"></div>





<?=$FOOTER_BOTTOM_BAR ?>

</div>



<!-- Invitation Part Start -->



<?php if(D_SIDEBARONLINE && isset($_SESSION['auth']) && $_SESSION['auth'] =="yes"){ ?>





<style>

.icon {position: absolute;background: url('/inc/templates/<?=D_TEMP?>/images/icons.png') no-repeat;}

#i-title .i-number, #i-title .i-number .decor {background: #cc3300 url('/inc/templates/<?=D_TEMP?>/images/sprite.gif') 0 -35px repeat-x;}

#i-bns .icon{position:absolute;left:0;top:0;width:15px;height:15px;cursor:pointer;_font-size:0;_line-height:0;background-repeat:no-repeat;background-image:url("/inc/templates/<?=D_TEMP?>/images/sprite.gif");}

#i-title .i-number,#i-title .i-number .decor{background:#cc3300 url('/inc/templates/<?=D_TEMP?>/images/sprite.gif') 0 -35px repeat-x;}

#invitations .bar{background:#cc3300 url('/inc/templates/<?=D_TEMP?>/images/sprite.gif') 0 -30px repeat-x;}

#invitations .minimize.bottom .icon{position:absolute;left:0;top:0;width:15px;height:15px;cursor:pointer;_font-size:0;_line-height:0;background-repeat:no-repeat;background-image:url("/inc/templates/<?=D_TEMP?>/images/sprite.gif");background-position:-15px 0;}

#i-title .maximize.bottom .icon{position:absolute;left:0;top:0;width:15px;height:15px;cursor:pointer;_font-size:0;_line-height:0;background-repeat:no-repeat;background-image:url("/inc/templates/<?=D_TEMP?>/images/sprite.gif");background-position: 0px 0px;}

#invitations .i-ctls .accept-invitation {width: 146px;height: 27px;padding: 0;margin: 0;text-indent: -9999px;white-space: nowrap;overflow: hidden;background: url('/inc/templates/<?=D_TEMP?>/images/invitation-buttons.png') 0 0 no-repeat;}

#invitations .anchor {

    position: absolute;

    top: 2px;

    left: -9px;

    margin-top: 0;

    display: block;

    display: none\9;

    width: 10px;

    height: 14px;

    background: transparent url('/inc/templates/<?=D_TEMP?>/images/ballon-anchor.gif') no-repeat scroll 0% 0%;

}

</style>



<?php $onlines = getOnline(0,5); ?>



<div id="invitations" class="aidate invitations" style="opacity: 1;display:none;">

    <span class="sh-t"></span>

    <span class="sh-r"></span>

    <span class="sh-b"></span>

    <span class="sh-l"></span>

    <span class="sh-tr"></span>

    <span class="sh-br"></span>

    <span class="sh-bl"></span>

    <span class="sh-tl"></span>

                

    

                

    <ul class="collapsable list closed" id="users_online">

        <h4>Start chatting right NOW!</h4>

        <?php 



        $count_online = count($onlines);

        

        $i = 0;

        foreach($onlines as $online){ 



            $i++;



        ?>

        

        <li class="chat invitation advandate-com source-lc online-<?=$online['uid']?> <?=($i > 3) ? 'not-ad' : ''; ?>" style="height: auto; opacity: 1;">

            <div class="wrapper">

                <div class="i-profile clearfix">

                    <div class="l">

                        <div class="thumb-container">

                            

                            <a href="/<?=$online['username']?>">

                                <img class="accept-invitation" src="<?=$online['image']?>" alt="Yinhan">

                            </a>

                        </div>

                    </div>

                    <div class="r">

                        <div class="member-info-data">

                            <h5>

                                <a style="_padding-right: .4em;" class="member-name" href="/<?=$online['username'];?>"><?=GetUsername($online['uid'])?></a>

                                <?php /*<em class="nowrap member-id">(ID: <span class="value" bind="this.text(data.member['id'])"><?=$online['uid']?></span>)</em>*/?>

                            </h5>

                            <p class="age">

                                <span>

                                    Age:

                                    <span><?=$online['age']?></span>

                                </span>

                            </p>

                            <p class="location" bind="this.text(data.member['location'])"><?=$online['location']?>, <?=$online['country']?></p>

                            <!--<p class="description"><span bind="this.html(data.member.description + ( ({'lc': '&nbsp;invites you to chat ', 'cs': ' <span class=video-text>invites you to chat</span><span class=camshare-text>invites you to CamShare</span>', 'ai': '&nbsp;is online now'})[data.source] || ''))">Never married lady with Black eyes and Brown hair&nbsp;invites you to chat </span>.</p>-->

                        </div>



                        <!-- TODO : TOGGLE() ??? -->

                        <div class="ballon" bind="this.toggleClass('no-serif', data.type == 2).toggle(!!data.text)" style="display: block;">

                            <span class="anchor"></span>

                            <span class="shade"></span>

                            <!--<div class="messages" id="invite-messages" bind="this.html(data.text)"><?=$online['description']?></div>-->

                            <div class="messages" id="invite-messages" bind="this.html(data.text)"><?=$online['status']?></div>

                        </div>





                    </div>

                </div>

                            

                <div class="i-ctls clearfix">

                    <div class="l">

                        <div class="countdown"><span class="bar" style="width: <?=$online['profile_complete']?>%;"></span></div>

                                    

                        <div class="invitation-actions">

                            <span class="i-close" onclick="block_remove(<?=$online['uid']?>)">Close</span>

                            

                                <?php /*<span class="separator">|</span>

                                <span class="i-block" onclick="ProfileAddNet(<?=$online['uid']?>,3); block_remove(<?=$online['uid']?>);">Block</span>*/?>

                            

                        </div>

                    </div>

                                

                    <div class="r">

                        <button class="button accept free-chat approve small progress">

                            <div class="progress-wrapper">

                                <div class="value">Start Free Chat Now!</div>

                                <div class="progress-bar" style="width: 59%;"></div>

                            </div>

                        </button>



                        <button class="button accept free-camshare approve small progress" key="free-premium">

                            <div class="progress-wrapper">

                                <div class="value">Free CamShare</div>

                                <div class="progress-bar" style="width: 59%;"></div>

                            </div>

                        </button>



                        <button class="button accept camshare primary small progress" key="premium">

                            <div class="progress-wrapper">

                                <div class="value">Start CamShare!</div>

                                <div class="progress-bar" style="width: 59%;"></div>

                            </div>

                        </button>



                        

                            <div class="start-chat">

                                <button class="button accept chat alarm small progress">

                                    <div class="progress-wrapper">

                                        <span class="value">Start Chat Now!</span>

                                        <span class="progress-bar" style="width: 59%;"></span>

                                    </div>

                                </button>

                                <button class="button accept free-chat approve small progress">

                                    <div class="progress-wrapper">

                                        <div class="value">Start Free Chat Now!</div>

                                        <div class="progress-bar" style="width: 59%;"></div>

                                    </div>

                                </button>

                            </div>

                        



                        

                        

                            <!--<a href="#" onclick="window.open('/inc/exe/IM/window.php?pId=<?=$online['uid']?>'); return false;" class="accept chat livechat-link">

                                <span class="value">Start Live Chat</span>

                            </a>-->

                        



                        <div class="discount-balloon">

                            <i></i>

                            50% OFF

                        </div>



                        <a href="#" onclick="window.open('/inc/exe/IM/window.php?pId=<?=$online['uid']?>','targetWindow','toolbar=no,scrollbars=yes,resizable=yes,width=415,height=460'); return false;" class="accept-invitation">Start Chat Now!</a>

                        <input name="ctl00$ctl00$ctl53$startBtn2" type="button" id="ctl53_startBtn2" class="accept-invitation camshare" value="Start Chat Now!" key="premium">



                        <div class="accept-free-camshare"><span data-action="accept-invitation" key="free-premium">Start Free CamShare</span></div>



                        <input name="ctl00$ctl00$ctl53$ctl04" type="button" class="accept-invitation free-camshare" value="Start Chat Now!" key="free-premium">

                    </div>

                </div>



            </div>

            <!--[if lte IE 7]>

                <div class="after"></div>

            <![endif]-->

        </li>

        <?php

        }

        ?>

                

        

       </ul>

                

    <div id="i-footer">

        

            <!--<div class="note non-camshare-message">

                Live Chat is billed at 1 Credit per minute<br>

                Video "on" adds 1 Credit per minute

            </div>

            <div class="note camshare-message">

                Chat is billed at 1 Credit per minute,<br>

                Chat with video — 2 Credits, CamShare — 6 Credits.

            </div>-->

        

                    

        <div id="i-title">

            <span class="i-count chats chat-hide">

                <span>

                    <?php

                    /*if(isset($_SESSION['genderid']) && $_SESSION['genderid'] == 63){

                        echo"Ladies";

                    }

                    else if(isset($_SESSION['genderid']) && $_SESSION['genderid'] == 64){

                        echo"Gents";

                    }

                    else{

                        echo"Online";

                    }*/

                    ?>

                    Start chatting right NOW!

                    </span>

                <?php /*<span class="i-number">

                    <span class="decor l"></span>

                    <span id="chats"><?=($count_online > 3) ? '3' : $count_online ;?></span>

                    <span class="decor r"></span>

                </span>*/?>

            </span>

                        

            <span class="i-count gifts none">

                <span>Gifts</span>

                <span class="i-number">

                    <span class="decor l"></span>

                    <span id="gifts"></span>

                    <span class="decor r"></span>

                </span>

            </span>

            <span class="value minimize bottom">

                <span class="icon"></span>

                <span class="label">Minimize</span>

            </span>

            <span class="value maximize bottom disabled">

                <span class="icon"></span>

                <span class="label">Maximize</span>

            </span>     

            

        </div>

    </div>

                

    <div id="i-bns">

        <span class="value minimize">

            <span class="icon"></span>

            <span class="label">Minimize</span>

        </span>

        <span class="value maximize disabled">

            <span class="icon"></span>

            <span class="label">Maximize</span>

        </span>

    <input type="hidden" name="users_count" id="users_count" value="5"/>

    </div>



</div>



<?php if($page != 'index'){
    
	echo include_script_files(); 

} ?>




<script type="text/javascript">

    

    var jQuery = jQuery.noConflict();

    

    jQuery(document).ready(function(){





        jQuery("#invitations").show();

        jQuery("#invitations .collapsable").removeClass('closed');



        //jQuery("#i-title .online").fadeOut(500).fadeIn(500, blink);

        jQuery("#i-footer #i-title , #i-bns .minimize .label").click(function(e){





            if(jQuery("#invitations .collapsable").hasClass('closed')){

                jQuery("#invitations .collapsable").removeClass('closed');

                /*jQuery("#i-title .chat-hide").fadeOut(500,function(){

                    jQuery("#i-title .chat-hide").removeClass('chat-show');

                    jQuery("#i-title .chat-hide").removeAttr('style');

                });*/

                jQuery("#i-title .chat-hide").removeClass('chat-show');

            }

            else{

                jQuery("#invitations .collapsable").addClass('closed');

                

                jQuery("#i-title .chat-hide").addClass('chat-show');

            }



            if(jQuery("#i-title .minimize").hasClass('disabled')){

                jQuery("#i-title .minimize").removeClass('disabled');

                jQuery("#i-title .maximize").addClass('disabled');

                jQuery("#i-bns .minimize").removeClass('disabled');

                jQuery("#i-bns .maximize").addClass('disabled');

                jQuery("#i-title .i-number").removeClass('online');

                

                

            }

            else{

                jQuery("#i-title .minimize").addClass('disabled');

                jQuery("#i-title .maximize").removeClass('disabled');

                jQuery("#i-bns .minimize").addClass('disabled');

                jQuery("#i-title .i-number").addClass('online');

                //jQuery("#i-bns .maximize").removeClass('disabled');

                

            }

            //jQuery("#invitations .collapsable").slideToggle('slow');

             

            //jQuery("#i-bns .maximize").toggle('slow');

            

            return false;



        });

        

    });



    function block_remove(uid){



        var count = parseInt(jQuery("#chats").text());

       

        count = count - 1;

        jQuery("#chats").text(count);



        jQuery(".online-" + uid).slideUp(1000,function(){

            jQuery(this).remove();

            jQuery('.not-ad:first').slideDown(1000);

            if(jQuery('.not-ad:first').removeClass('not-ad')){

                

                //jQuery('.not-ad:first').fadeIn(500,function(){



                count = parseInt(jQuery("#users_online li").length);

                

                if(count > 3){

                    count = 3;

                }

                //count = count + 1;

                jQuery("#chats").text(count);

                //jQuery('.not-ad:first').removeClass('not-ad');

            //});

            }

            

        });



        var count = parseInt(jQuery("#users_count").val());

        count = count + 1;

        load_user(count);

        jQuery("#users_count").val(count);



    }



    function load_user(count){

            jQuery.ajax({

                url:"/inc/ajax/ajax_sidebar.php?from=" + count,



                success:function(data){



                    jQuery("#users_online").append(data);



                },

                error:function(e){

                    console.log(e);

                }

            });



        

    }



</script>

 

<?

}

?>

<!-- Invitation Part End -->

<div class="clear"></div>
		
        <!-- PAGE FOOTER -->
        <div id="page_footer" class="<?php if($page != "index") { ?> footer_sec <?php } ?>">
            <div class="content-width">
                <div class="footer_menu"> 
                    <ul class="footer_tabs">
                        <?=$FOOTER_MENU_BAR ?>							
                    </ul>
                </div>	
            </div>
    
            <?=$FOOTER_MENU_TIMER ?>
            
            <?php e_footer() ?>
    
        </div>
        <!-- END FOOTER -->
		<div class="footer-banner-add"> <? foreach($BANNER_ARRAY as $banner){ if($banner['position'] =="bottom"){ print $banner['display'];}} ?></div>

</div>

<!-- END PAGE MAIN BACKGROUND -->

</div> <!-- End of wide_wrapper -->


</body>


</html>
