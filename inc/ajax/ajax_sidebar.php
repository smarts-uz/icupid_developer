<?php
require_once("../config.php");

$arrData = array();
if(isset($_REQUEST['from'])){
$from = $_REQUEST['from'];
require_once("../API/api_functions.php");
	$onlines = getOnline($from , 1);
	
    if(isset($onlines)){
  foreach ($onlines as $online) {

        ?>
        
    <li class="chat invitation asianbeauties-com source-lc online-<?=$online['uid']?> not-ad" style="height: auto; opacity: 1;">
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
}
  
  //return json_encode($arrData);
}

?>