<?php
## block direct page access
defined( 'KEY_ID' ) or die( 'Restricted access' );
?>
<div id="main" class="col-md-6">    
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

if(isset($BLOCKPAGEACCESS)){
	print $GLOBALS['_LANG_ERROR']['_waitingApproval']; 
}
else{

	## PRIVACY SETTNGS OPTION TO BLOCK MEMBERS / NONE FRIENDS FRM VIEWING PROFILE BLOCKS
	if(isset($MyProfileGlobals['profile_viewnonefiends']) || isset($MyProfileGlobals['profile_viewfriends']) ){

		// AM I A FRIEND OR NOT?
		$whoami = $DB->Row("SELECT DISTINCT count(members.id) AS total FROM members_network,members  WHERE ( ( ( members.id = members_network.to_uid AND members_network.uid='".$_SESSION['uid']."' )  OR  ( members.id = members_network.to_uid AND members_network.to_uid='".$_SESSION['uid']."' ) ) AND members_network.type= ( '2' ) )");

		if($whoami['total'] > 0){
			$ThisArray =$MyProfileGlobals['profile_viewfriends'];
		}
		else{
			$ThisArray =$MyProfileGlobals['profile_viewnonefiends'];
		}

		$profile1_data = explode("*",$ThisArray);
		$profile1_array = array();

		foreach($profile1_data as $value){		
			array_push($profile1_array,$value);
		}

	}

?>


<input type="hidden" name="hiddenProfileStatus" id="hiddenProfileStatus" value="ShowProfileData">

<?php
if($MyProfileGlobals['ThisApproved'] !='active' && isset($_SESSION['site_moderator_approve']) && $_SESSION['site_moderator_approve']=="yes"){ ?>

<div id="messages">
	<div style="" class="message-good">
		<img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/user_green.png" align="absmiddle"> <?=$GLOBALS['_LANG_ERROR']['_waitingApproval']; ?>
			
		<span id="Approvediv_<?=$profileId ?>"> [ <a href="javascript:void(0)" onClick="AdminLiveApprove('<?=$profileId ?>', 'profile', ''); Effect.Fade('Approvediv_<?=$profileId ?>'); return false;" style="text-decoration:none"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/chk_on.png" align="absmiddle"> <?=$GLOBALS['_LANG']['_approve'] ?> </a> ] </span>
		
		[ <a href="javascript:void(0)" onClick="AdminLiveDelete('<?=$profileId ?>', 'profile', ''); Effect.Fade('ProfileHead'); return false;" style="text-decoration:none"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/cancel.png" align="absmiddle"> <?=$GLOBALS['_LANG']['_delete'] ?> </a> ]
	
	</div>
</div>

<?
}
if(isset($_SESSION['site_moderator_edit']) && $_SESSION['site_moderator_edit'] =="yes"){
?>

<div id="messages">
	<div style="" class="message-good">
		<img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/wrench.png" align="absmiddle"> <a href="<?= getThePermalink('account/edit')?>"> [ Edit Profile ] </a>

		<?
		if($_GET['sub'] =="blogview"){
		?>
		<a href="#" onclick="EditBlogPost('<?=$_GET['item2_id'] ?>'); return false;"> [ Edit Blog ]</a>
		<?
		}
		?>
	</div>
</div>
<?
}
?>

<div id="profile_section_13" >
	<ul class="tab">
	 	<li class="tablinks active" onclick="openProfileTab(event, 'profile-about')">About</li>
	 	<li class="tablinks" onclick="openProfileTab(event, 'profile-media')">Media</li>
	  	<?php
	  	if(D_PROFILE_COMPARE == 'yes'){
  		?>
	  	<li class="tablinks" onclick="openProfileTab(event, 'profile-compare')">Compare</li>
	  	<?php
	 	}
	  	
	  	if(D_COMPATIBILITY_QUIZ == 'yes'){
  		?>
	  	<li class="tablinks" onclick="openProfileTab(event, 'profile-compatibility')">Compatibility Quiz</li>
	  	<?php
	  	}
	  	?>
	  	<li class="tablinks" onclick="openProfileTab(event, 'profile-email')">Email</li>
	  	<li class="tablinks" onclick="openProfileTab(event, 'profile-comments')">Comments</li>
	  	<li class="tablinks" onclick="openProfileTab(event, 'profile-rating')">Rating</li>
	</ul>

	<div id="profile-about" style="display: block;" class="tabcontent">
	  		
	  	<?
				
		/**
		* Info: Displays description and textarea fields
		* 		
		* @version  9.0
		*/
		
		$show_events_array = DisplayRecentEvents(5,$profileId);
		$show_adverts_array = DisplayRecentAdverts(5,$profileId);



		foreach($profile_group_array as $value){

			if(isset($profile1_data) && is_array($profile1_data) ){
	 
				if(!in_array($value['groupid'],$profile1_data)){

					print GetProfileData($profileId,$value['groupid'],2);
				}
			}
		 }
		 
		 ?>	

	  	<?
	  	if(D_FRIENDS ==1){


			/**
			* Info: Displays member friends
			* 		
			* @version  9.0
			*/

			if(!empty($show_network_array)){

			?>


			<div class="profile_box_title marginTop">
		  
				<span class="goL">
				    <h4><?=$GLOBALS['LANG_COMMON'][3]?></h4>
				  </span>
				  <div class="ClearAll"></div>
		  
		    </div>

			<div class="profile_box_body">
				<div class="profile_friends_list">

					<? 
					if(!empty($show_network_array)){
					foreach($show_network_array as $value){ ?> 
					<div class="pImage">
						<a href="<?=$value['link']; ?>"><img src="<?=$value['image']; ?>" class="pImageBorder"></a>
						<div class="pImageUsername"><?=$value['username']; ?></div>
					</div>
					<?
					}
					}
					?>
			  		<div class="friendlist_link">
				  		<a class="MainBtn" href="<?= getThePermalink('search/friends/'.$profileId) ?>"><?=$GLOBALS['_LANG']['_friendsList'] ?></a>
					</div>
				</div>	
			</div>

			<? 
			}
		
		}
		


		/**
		* Info: Displays description and textarea fields
		* 		
		* @version  9.0
		*/

	 	foreach($profile_group_array as $value){

			if(isset($profile1_data) && is_array($profile1_data) ){
		 
				if(!in_array($value['groupid'],$profile1_data)){ ?>
		  
				<div class="profile_box_title marginTop" id="DataBoxTitle<?=$value['groupid'] ?>">
		  
					<span class="goL">
				    	<h4><?=$value['caption'] ?></h4>
				  	</span>
				  	<span class="goR">
				     <?
				     if($_SESSION['uid'] ==$profileId ){ ?>
				     	<a href="<?= getThePermalink('account/edit/group/'.$value['groupid'])?>" class="pLink"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/pencil.png" align="absmiddle"> <?=$GLOBALS['_LANG']['_edit']?> </a>
			     	<?
			     	}
			     	?>
				  	</span>
				  	<div class="ClearAll"></div>
		  
			    </div>
		  
				<div class="profile_box_body" id="DataBoxBody<?=$value['groupid'] ?>">
		   
		   		<?
				print GetProfileData($profileId,$value['groupid'],1); 
				 ?>
		  
				</div>

				<? 
				}
				?>


			<? }else{ ?>

			<div class="profile_box_title marginTop" id="DataBoxTitle<?=$value['groupid'] ?>">
		  
				<span class="goL">
				    <h4><?=$value['caption'] ?></h4>
				  </span>
				  <span class="goR">
				     <? if($_SESSION['uid'] ==$profileId ){ ?><a href="<?= getThePermalink('account/edit')?>" class="pLink"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/pencil.png" align="absmiddle"> <?=$GLOBALS['_LANG']['_edit']?> </a> <? } ?>
				  </span>
				  <div class="ClearAll"></div>
		  
		    </div>
		  
			<div class="profile_box_body" id="DataBoxBody<?=$value['groupid'] ?>">
		   
		   	<?
				 print GetProfileData($profileId,$value['groupid'],1); 
				
			 ?>
		  
			</div>

		  
		<? } ?>
		  

		                 
		<?
		}
		?>
	</div>

	<div id="profile-media" class="tabcontent">
	  	<?
	  	if(!empty($RecentPhotos)) {
					
		?>
	  	<div class="profile_box_title marginTop" style="display: none;">
	  		<span class="goL">
			    <h4><?=$GLOBALS['LANG_COMMON'][23] ?></h4>
		  	</span>
			<span class="goR">
				<?
				if($_SESSION['uid'] ==$profileId ){ ?>
				<a href="<?=getThePermalink('account/edit')?>"  class="pLink"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/pencil.png" align="absmiddle"> <?=$GLOBALS['_LANG']['_edit']?> </a> | 
				<?
				}
				?>  
			    <a class="pLink" href='<?=getThePermalink('gallery/search/'.$profileId)?>'><?=$GLOBALS['_LANG']['_viewAll'] ?></a> |
				  
				<a <? if($_SESSION['auth'] =="yes"){ ?>href="#" class="clickable"  data-toggle="modal" data-target="#myModal"  <? }else{ ?> href="<?= getThePermalink('login') ?>" <? } ?>><?=$GLOBALS['_LANG']['_slideshow'] ?></a>
		  	</span>
			<div class="ClearAll"></div>
	  	
	    </div>
	  
		<div class="profile_box_body">

		<div class="profile_photos_list row">

			<? 
			if(!empty($RecentPhotos)){
			foreach($RecentPhotos as $value){ ?> 
			<div class="col-xs-4 col-sm-4 col-md-4">
				<div class="profile_photo">
					<a href="javascript:void();" class="clickable"  data-toggle="modal" data-target="#myModal"><img src="<?=$value['image']; ?>" class="pImageBorder">
					<div class="pImageUsername"><b><?=$value['title']; ?></b><br/><?=$value['description']; ?></div></a>
				</div>
			</div>
			<?
			}
			}
			?>
	  		
		</div>

		    
		</div>
	  
	<?
	}
	?>
	</div>
	<?php
	
	if(D_PROFILE_COMPARE == 'yes'){ ?>
	<div id="profile-compare" class="tabcontent">
	  	
	  	<div class="row">
	  		<div class="col-md-4 profile_question"><div class="match-color-sample background_color"></div> Matched Answer </div>
	  		<div class="col-md-4 profile_question"><b>My Information</b></div>
	  		<div class="col-md-4 profile_question"><b>Their Information</b></div>
	  	</div>
	  	
	  	<?php
	  	$userCompareData = MemberProfileCompare($profileId);
	  	$myCompareData = MemberProfileCompare($_SESSION['uid']);
	  	
	  	foreach ($userCompareData['groups'] as $gid => $group_name) {
			if(isset($userCompareData['fields'][$gid]) && count($userCompareData['fields'][$gid]) > 0){
		?>
			<div class="row">
	  			<div class="profile_box_title marginTop col-md-12">
	  				<span class="goL">
						<h4><?=$group_name?></h4>
					</span>
		  		</div>
	  		</div>
		<?php
			foreach ($userCompareData['fields'][$gid] as $fid => $field) {
			?>
			<div class="row">
		  		<div class="col-md-4 profile_question"><?=$field?></div>
		  		<div class="col-md-4 profile_question"><span><?=(isset($myCompareData['values'][$gid][$fid]))? $myCompareData['values'][$gid][$fid] : '' ?></span></div>
		  		<?php
		  		$matchclass = "";

		  		if(isset($myCompareData['values'][$gid][$fid]) && isset($userCompareData['values'][$gid][$fid]) && $myCompareData['values'][$gid][$fid] == $userCompareData['values'][$gid][$fid]){
		  			$matchclass = "background_color matched";
		  		}
		  		?>

		  		<div class="col-md-4 profile_question"><span class="<?=$matchclass?>"><?=(isset($userCompareData['values'][$gid][$fid]))? $userCompareData['values'][$gid][$fid] : '' ?></span></div>
		  	</div>
			<?
			}
			}
		}	
		?>

	  	
	</div>

	<?php
	}
	if(D_COMPATIBILITY_QUIZ == 'yes'){ ?>
	<div id="profile-compatibility" class="tabcontent">
	  	
	  	
	  	<div class="row">
	  		<div class="profile_box_title marginTop col-md-12">
	  			<span class="goL">
					<h4>Match Categories</h4>
				</span>

				<span class="goR">
		     	<?
				if($_SESSION['uid'] ==$profileId ){ ?>
			     	<a href="#" class="pLink">View/Hide Details</a>
		     	<?
				}
		     	?>
			  	</span>

	  		</div>
	  	</div>
	  	<div class="row profile_box_content">
	  		<?php
			foreach ($compatibilityGroups as $compatibilityGroup) {
				$groupFields = getCompatibilityGroupFieldsName($compatibilityGroup['id']);
	  			
	  			$totalWeight = 0;
	  			$matchWeight = 0;

	  			$totalQus = 0;
	  			$answerQus = 0;

	  			foreach ($groupFields['fieldName'] as $index => $fieldName) {

	  				if(isset($myCompatibilityAnswers[$fieldName]) && isset($userCompatibilityAnswers[$fieldName]) && $myCompatibilityAnswers[$fieldName] == $userCompatibilityAnswers[$fieldName]){
	  					$matchWeight += $groupFields['fieldWeight'][$index];	
	  				}

	  				if(isset($myCompatibilityAnswers[$fieldName]) && $myCompatibilityAnswers[$fieldName] != ""){
	  					$answerQus++;	
	  				}
  					
  					$totalQus++;	
	  				$totalWeight += $groupFields['fieldWeight'][$index];

	  			}
	  		?>
  			<div class="col-md-6 profile_question_section">
		  		<div class="question_title">
		  			<span class="goL"><?=$compatibilityGroup['caption']?></span>
		  			<span class="goR"><?=round(($matchWeight/$totalWeight)*100 )?>%</span>
		  		</div>
		  		<div class="question_graph">
		  			<div class="full_path"></div>
		  			<div class="completed_path" style="width:<?=round(($matchWeight/$totalWeight)*100 )?>%;"></div>
		  		</div>
	  		</div>
	  		<?php
			}
	  		?>
	  	
	  	
	  		<?php /*<div class="col-md-12 text-center">
		  		<h5>You have answered <?=$answerQus?> of their <?=$totalQus?> questions</h5>
		  		<?php 
				if($answerQus != $totalQus){
		  		?>
		  		<a href="<?=DB_DOMAIN?>index.php?dll=compatibilityquiz"><h5>Answer more questions</h5></a>
		  		<?php
		  		}
		  		?>
	  		</div>

	  		<div class="col-md-12 marginTop">
	  			<div class="question_section">
	  				<div class="question_header col-md-12">
	  					<h5>Are you more of a social person or a loner?</h5>
	  				</div>
	  				<div class="question_content">
	  					<div class="question_block">
	  						<div class="user_image_thumb col-md-3">
	  							<img src="/inc/tb.php?src=v9_z6xg71b9e28cjkcx9zg6vusfs220170509.jpg&x=120&y=120">
	  						</div>
	  						<div class="question col-md-9">
	  							
	  							<div class="question_title"><b>Extremely Social</b></div>
	  							<div class="question_description">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</div>
	  						
	  						</div>
	  					</div>

	  					<div class="question_block">
	  						<div class="user_image_thumb col-md-3">
	  							<img src="/inc/tb.php?src=v9_z6xg71b9e28cjkcx9zg6vusfs220170509.jpg&x=120&y=120">
	  						</div>
	  						<div class="question col-md-9">
	  							
	  							<div class="question_title"><b>Extremely Social</b></div>
	  							<div class="question_description">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</div>
	  						
	  						</div>
	  					</div>
	  				</div>
	  			</div>
		  	</div>
		  	<div class="col-md-12 marginTop">
	  			<div class="question_section">
	  				<div class="question_header col-md-12">
	  					<h5>Question 3</h5>
	  				</div>
	  				<div class="question_content">
	  					<div class="question_block">
	  						<div class="user_image_thumb col-md-3">
	  							<img src="/inc/tb.php?src=v9_z6xg71b9e28cjkcx9zg6vusfs220170509.jpg&x=120&y=120">
	  						</div>
	  						<div class="question col-md-9">
	  							
	  							<div class="question_title"><b>Extremely Social</b></div>
	  							<div class="question_description">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</div>
	  						
	  						</div>
	  					</div>

	  					<div class="question_block">
	  						<div class="user_image_thumb col-md-3">
	  							<img src="/inc/tb.php?src=v9_z6xg71b9e28cjkcx9zg6vusfs220170509.jpg&x=120&y=120">
	  						</div>
	  						<div class="question col-md-9">
	  							
	  							<div class="question_title"><b>Extremely Social</b></div>
	  							<div class="question_description">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</div>
	  						
	  						</div>
	  					</div>
	  				</div>
	  			</div>
		  	</div>
		  	<div class="col-md-12 marginTop">
	  			<div class="question_section">
	  				<div class="question_header col-md-12">
	  					<h5>Question 4</h5>
	  				</div>
	  				<div class="question_content">
	  					<div class="question_block">
	  						<div class="user_image_thumb col-md-3">
	  							<img src="/inc/tb.php?src=v9_z6xg71b9e28cjkcx9zg6vusfs220170509.jpg&x=120&y=120">
	  						</div>
	  						<div class="question col-md-9">
	  							
	  							<div class="question_title"><b>Extremely Social</b></div>
	  							<div class="question_description">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</div>
	  						
	  						</div>
	  					</div>

	  					<div class="question_block">
	  						<div class="user_image_thumb col-md-3">
	  							<img src="/inc/tb.php?src=v9_z6xg71b9e28cjkcx9zg6vusfs220170509.jpg&x=120&y=120">
	  						</div>
	  						<div class="question col-md-9">
	  							
	  							<div class="question_title"><b>Extremely Social</b></div>
	  							<div class="question_description">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</div>
	  						
	  						</div>
	  					</div>
	  				</div>
	  			</div>
		  	</div>*/ ?>
	  	</div>
	  	
	</div>
	<?php
	}
	?>
	<div id="profile-email" class="tabcontent">
	  	
	  	<ul class="">

	  		<?php
	  		if(count($MailBoxArray) > 0){
		  		foreach ($MailBoxArray as $mail) {
		  			
	  			$dateArray = explode("-", $mail['date']);
	  			$mail['date'] = $dateArray['2']."-".$dateArray['0']."-".$dateArray['1'];

		  		?>
		  		<li>
	  				<div class="email_block">
						<div class="user_image_thumb col-md-3">
							<a href="<?=getThePermalink('messages/read/'.$mail['id'])?>">
							<img src="<?=$mail['image']?>">
							</a>
						</div>
						<div class="email col-md-9">
							<a href="<?=getThePermalink('messages/read/'.$mail['id'])?>">
							<div class="email_title"><b><?=$mail['subject']?></b></div>
							<div class="email_description">"<?=$mail['message']?>"</div>
							<div class="email_timestamp margin-top-10"><i><?=date("M d Y, H:i A",strtotime($mail['date']." ".$mail['time'] ));?> </i></div>
							</a>
	  					</div>
					</div>
				</li>
		  		<?php
		  		}
	  		}
	  		else{
	  		?>
	  		<hr/>
	  		<h4 class="text-center">There is no messge to you from "<span class="template_color"><b><?=substr($profileUsername,0,30) ?></b></span>"</h4>
	  		<hr/>
	  		<?php
	  		}
	  		?>
  			
			
		</ul>
	</div>

	<div id="profile-comments" class="tabcontent">
	  	<?
		/**
		* Info: Displays profile commnets
		* 		
		* @version  9.0
		*/
		if(D_COMMENTS ==1){
		?>
		
			<span id="response_comments" class="responce_alert"></span>

			<div class="profile_box_title marginTop">

				<span class="goL">
					<h4><?=$GLOBALS['_LANG']['_comments']?></h4>
				</span>
				<div class="ClearAll"></div>

			</div>

			<div class="profile_box_body">

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
				displayCommentsBox("310", $page, $show_page, $MyProfileGlobals['uid'], $profileId,0,0) ?>
			
			</div>

		<? 
		}
		?>
	</div>
	<div id="profile-rating" class="tabcontent">
	  	<?=DisplayProfileRatingSystem($profileId) ?>
	</div>
	
</div>




<script>
function openProfileTab(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";


    setTimeout(function(){
    if(cityName == 'profile-compatibility'){
    	
    	tabcontent = document.getElementsByClassName("completed_path");
    	for (i = 0; i < tabcontent.length; i++) {
        	if(tabcontent[i]){
        		document.getElementsByClassName("completed_path")[i].style.setProperty("background-position", "left bottom", "important");
   			}
   		}
	
	}
    else{
    	tabcontent = document.getElementsByClassName("completed_path");
    	for (i = 0; i < tabcontent.length; i++) {
        	if(tabcontent[i]){
        		document.getElementsByClassName("completed_path")[i].style.removeProperty("background-position");
   			}
   		}
    	
    }

}, 500);

}
</script>


<? require_once('slideshow_profile.php'); ?>
<div id="ProfileHead" style="display: none;">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div id="ProfileUsernameBox">
				<?php
				if(isset($_SESSION['auth']) && $_SESSION['auth'] == 'yes'){
				?>
					<div id="reportMember"></div>
					<img src="/images/DEFAULT/_icons/report-member-icon.png" style="position:relative;float:right;" onclick="reportMember('<?php echo (isset($_SESSION['uid'])) ? $_SESSION['uid'] : 0;?>','<?php echo $profileId;?>');"/>
		        <?php 
		    	}
		        ?>
        		<div class="row">
		        	<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" style="min-height: 200px;">
						<div id="ProfileImage">
                
		                <?php require_once "inc/config.php"; ?>

			                <?php 
			                if(isset($profileId) && is_numeric($profileId)){ ?>
		                	<div class="bx-wrapper">
								<div class="bx-viewport">
								<?php
						        require_once "inc/API/api_functions.php";
						        $dd = DisplayRecentPhotos($profileId,7); 
						        ?>
         							<ul class="bxslider">
										<?php if(!empty($dd)){foreach($dd as $value){ ?>  
                   						<li><img src="<?=DB_DOMAIN?>uploads/images/<?php echo $value['bigimage']; ?>" title="<?php echo htmlspecialchars($value['title']); ?> <br> <?php echo htmlspecialchars($value['description']); ?>"/></li>
               
            							<?php } }
    
								        ## display a default image
								        if(empty($dd)){
											print '<img src="'.DB_DOMAIN.'uploads/files/nophoto.jpg" title="No Photo Added">';
								        }
								        ?>
									</ul>
								</div>
							</div>
		   					<?   
		   					}
							?>
	                	</div>
					</div>
            
					<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">

						<div class="row">
						    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
						    	<p><strong><?=$GLOBALS['_LANG']['_name'] ?></strong></p>
					    	</div>
						    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
						    	<p><?=substr($profileUsername,0,30) ?> </p>
					    	</div>
						  	<?php
							if(isset($MyProfileGlobals['status']) && $MyProfileGlobals['status'] != ''){ ?>
						    	<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
						    		<p><strong><?=$GLOBALS['_LANG']['_status'] ?></strong></p>
					    		</div>
						    	<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
						    		<p><?=$MyProfileGlobals['status'] ?> </p>
					    		</div>
						  	<?php	
						  	}
						  	?>
						  
							<?
							if($MyProfileGlobals['gender'] != 2710){ ?>
							    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
							    	<p><strong><?=$GLOBALS['_LANG']['_details'] ?></strong></p>
						    	</div>
							    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
							    	<p> <?=$MyProfileGlobals['age'] ?> <?=$GLOBALS['_LANG']['_yold'] ?> <? if(D_STARSIGN ==1){ ?> (<?=$MyProfileGlobals['starsign'] ?>)<? } ?>, <?=$MyProfileGlobals['MyGender'] ?></p>
						    	</div>
							<? } ?>
						    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
						    	<p><strong><?=$GLOBALS['_LANG']['_location'] ?></strong></p>
					    	</div>
						    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
						    	<p><?=$MyProfileGlobals['location'] ?> <?=$MyProfileGlobals['country'] ?></p>
					    	</div>
							<?
							if(D_MOD_WRITE ==1){
							?>
						    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
						    	<p><strong><?=$GLOBALS['_LANG']['_pLink'] ?></strong></p>
					    	</div>
						    <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
						    	<p><a href="<?=getThePermalink('user',array('username' => $MyProfileGlobals['username']))?>" target="_blank" class="xs-small_text"><strong><?=DB_DOMAIN.$MyProfileGlobals['username'] ?></strong></a></p>
					    	</div>
							<?
							}
							?>
						</div>

						<?php 
						if($MyProfileGlobals['onlinenow'] && $profileId != $_SESSION['uid'] && $MyProfileGlobals['showIM'] =="yes" && D_IM ==1 && $MyProfileGlobals['visible'] == 'yes' && $_SESSION['auth'] == 'yes'){
						?>
							<a <? if(isset($PACKAGEACCESS[$_SESSION['packageid']]) && is_array($PACKAGEACCESS[$_SESSION['packageid']]) && !in_array("chatroom-im",$PACKAGEACCESS[$_SESSION['packageid']])){ ?>href="javascript:void(0);"  onclick="openIMWin(<?=$profileId ?>, '<?=$_SESSION['uid'] ?>','<?=DB_DOMAIN ?>','<?=$IMRoomArray['path'] ?>','<?=$IMRoomArray['width'] ?>','<?=$IMRoomArray['height'] ?>'); return false;" <? }else{ ?> href="<?= getThePermalink('subscribe')?>" <? } ?>  class="online"><img src="<?=DB_DOMAIN ?>images/DEFAULT/onlinenow_big.png"></a>
						<?
						}
						?>
						<p><b><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/medal.png" align="absmiddle"> <?=$MyProfileGlobals['name']; ?></b></p>
						<p style="font-size:11px;"><?=$GLOBALS['_LANG']['_lastLogin']?> <?=showTimeSince($MyProfileGlobals['lastlogin']) ?></p>
					</div>
		        </div> 
			           
			</div>

			<div class="ClearAll"></div>
			<div style="background:transparent; min-height:500px">

 

				<? if($show_page=="overview"){

				/**
				* Info: Profile Overview Page 
				* 		
				* @version  9.0
				* @created  Fri Sep 25 10:48:31 EEST 2008
				* @updated  Fri Sep 25 10:48:31 EEST 2008
				*/
				?>

			    <div id="ShowProfileData" style="display:none;">
					<?
					
					/**
					* Info: Displays recent photos
					* 		
					* @version  9.0
					*/
					
					/*if(!empty($RecentPhotos)) {
					
					?>
				  	<div class="profile_box_title marginTop">
				  		<span class="goL">
						    <h1><?=$GLOBALS['LANG_COMMON'][23] ?></h1>
					  	</span>
						<span class="goR">
							<?
							if($_SESSION['uid'] ==$profileId ){ ?>
							<a href="<?=DB_DOMAIN ?>index.php?dll=account&sub=edit"  class="pLink"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/pencil.png" align="absmiddle"> <?=$GLOBALS['_LANG']['_edit']?> </a> | 
							<?
							}
							?>  
						    <a class="pLink" href='index.php?dll=gallery&sub=search&fcid=<?=$profileId ?>'><?=$GLOBALS['_LANG']['_viewAll'] ?></a> |
							  
							<a <? if($_SESSION['auth'] =="yes"){ ?>href="#" class="clickable"  data-toggle="modal" data-target="#myModal"  <? }else{ ?> href="<?=DB_DOMAIN ?>index.php?dll=login" <? } ?>><?=$GLOBALS['_LANG']['_slideshow'] ?></a>
					  	</span>
						<div class="ClearAll"></div>
				  	
				    </div>
				  
					<div class="profile_box_body">
					    <div class="row">
						<? 
						foreach($RecentPhotos as $value){ ?>
							<div class="col-xs-4 col-sm-2 col-md-2 col-lg-2" style="margin:10px 0;">
								<a href="<?=$value['link'] ?>"><img src="<?=$value['image'] ?>&x=74&y=74"  width="74" height="74"></a>
							</div>
						<?
						}
						?>	 
				  		</div>
					</div>
				  
				<?
				}*/
				?>
				  

				<?
				
				/**
				* Info: Displays description and textarea fields
				* 		
				* @version  9.0
				*/
				
				/*$show_events_array = DisplayRecentEvents(5,$profileId);
				$show_adverts_array = DisplayRecentAdverts(5,$profileId);



				foreach($profile_group_array as $value){

					if(isset($profile1_data) && is_array($profile1_data) ){
			 
						if(!in_array($value['groupid'],$profile1_data)){

							print GetProfileData($profileId,$value['groupid'],2);
						}
					}
				 }*/
				 
				 ?>
				 


				<? 
				/*if(D_FRIENDS ==1){


					/**
					* Info: Displays member friends
					* 		
					* @version  9.0
					*//*

					if(!empty($show_network_array)){

					?>


					<div class="profile_box_title marginTop">
				  
						<span class="goL">
						    <h1><?=$GLOBALS['LANG_COMMON'][3]?></h1>
						  </span>
						  <div class="ClearAll"></div>
				  
				    </div>

					<div class="profile_box_body">
						<div style="margin-left:10px; margin-top:10px;">

							<? 
							if(!empty($show_network_array)){
							foreach($show_network_array as $value){ ?> 
							<div class="pImage">
								<a href="<?=$value['link']; ?>"><img src="<?=$value['image']; ?>" border="0" width="48" height="48" class="pImageBorder"></a>
								<div class="pImageUsername"><?=$value['username']; ?></div>
							</div>
							<?
							}
							}
							?>
					  		
					  		<p><br><a href="<?=DB_DOMAIN ?>index.php?dll=search&friendid=<?=$profileId ?>"><?=$GLOBALS['_LANG']['_friendsList'] ?></a></p>

						</div>	
					</div>

				<? 
				}
				?>

				<div class="ClearAll"></div>

				<? 
				}*/
				
				/**
				* Info: Displays description and textarea fields
				* 		
				* @version  9.0
				*/

			 	/*foreach($profile_group_array as $value){

					if(isset($profile1_data) && is_array($profile1_data) ){
				 
						if(!in_array($value['groupid'],$profile1_data)){ ?>
				  
						<div class="profile_box_title marginTop" id="DataBoxTitle<?=$value['groupid'] ?>">
				  
							<span class="goL">
						    	<h1><?=$value['caption'] ?></h1>
						  	</span>
						  	<span class="goR">
						     <?
						     if($_SESSION['uid'] ==$profileId ){ ?>
						     	<a href="<?=DB_DOMAIN ?>index.php?dll=account&sub=edit&group=<?=$value['groupid'] ?>" class="pLink"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/pencil.png" align="absmiddle"> <?=$GLOBALS['_LANG']['_edit']?> </a>
					     	<?
					     	}
					     	?>
						  	</span>
						  	<div class="ClearAll"></div>
				  
					    </div>
				  
						<div class="profile_box_body" id="DataBoxBody<?=$value['groupid'] ?>">
				   
				   		<?
						print GetProfileData($profileId,$value['groupid'],1); 
						 ?>
				  
						</div>

						<? 
						}
						?>


					<? }else{ ?>

					<div class="profile_box_title marginTop" id="DataBoxTitle<?=$value['groupid'] ?>">
				  
						<span class="goL">
						    <h1><?=$value['caption'] ?></h1>
						  </span>
						  <span class="goR">
						     <? if($_SESSION['uid'] ==$profileId ){ ?><a href="<?=DB_DOMAIN ?>index.php?dll=account&sub=edit" class="pLink"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/pencil.png" align="absmiddle"> <?=$GLOBALS['_LANG']['_edit']?> </a> <? } ?>
						  </span>
						  <div class="ClearAll"></div>
				  
				    </div>
				  
					<div class="profile_box_body" id="DataBoxBody<?=$value['groupid'] ?>">
				   
				   	<?
						 print GetProfileData($profileId,$value['groupid'],1); 
						
					 ?>
				  
					</div>

				  
				<? } ?>
				  

				                 
				<?
				}*/
				?>


					<?

					/**
					* Info: Displays member quizzes
					* 		
					* @version  9.0
					*/
					
					if(!empty($profile_tests) || $_SESSION['uid'] ==$profileId && D_MATCHTESTS ==1){ 

					?>

					<div class="profile_box_title marginTop">

						<span class="goL">
							<h1><?=$GLOBALS['_LANG']['_quiz'] ?> <? if($_SESSION['uid'] ==$profileId ){ ?><a href="<?=getThePermalink('matches/test')?>" class="pLink"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/pencil.png" align="absmiddle"> <?=$GLOBALS['_LANG']['_edit']?> </a> <? } ?> </h1>
						</span>

						<div class="ClearAll"></div>

				    </div>
				 
					<div class="profile_box_body"> 
					<? if(!empty($profile_tests)){ foreach($profile_tests as $value){ ?>
					<div class="row">
				        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				          <div class="row padding_tb_10" style="border-bottom:1px solid #eee;font-size:11px;">
				              <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
				            
				                <span style="font-weight:bold;display:block;font-size:13px;">
				                <a <? if($_SESSION['auth'] =="yes"){ ?>href="javascript:void(0);" onClick="NewpopUpWin('<?=DB_DOMAIN ?>inc/exe/quiz/start.php?item_id=<?=$profileId ?>&item2_id=<?=$value['id'] ?>', 450, 300);return false;" <? }else{ ?> href="<?=getThePermalink('login')?>" <? } ?>  class="pLink">
				                        <img src="<?=DB_DOMAIN ?>images/DEFAULT/_quiz/<?=$value['icon'] ?>.png" width="48" height="48" class="img_border">		</a>
				                </span>
				            
				             </div>
				        
				                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
				                <a <? if($_SESSION['auth'] =="yes"){ ?>href="javascript:void(0);" onClick="NewpopUpWin('<?=DB_DOMAIN ?>inc/exe/quiz/start.php?item_id=<?=$profileId ?>&item2_id=<?=$value['id'] ?>', 450, 300);return false;" <? }else{ ?> href="<?=getThePermalink('login')?>" <? } ?> class="pLink">
				                  <b><?=$value['title'] ?></b><br>
				                </a>
				                </div>
				            </div>
				        </div>
					</div>	
					
					<? } } ?>
					</div>
					
					<? } ?>





					<? 

					/**
					* Info: Displays follower updates
					* 		
					* @version  9.0
					*/

					if(D_FOLLOW ==1 && isset($MyProfileGlobals['follow_display']) && $MyProfileGlobals['follow_display'] =="yes"){ 

					?>

					<span id="response_comments" class="responce_alert"></span>


					<div class="profile_box_title marginTop">

						<span class="goL">
							<h1>My Follower Updates</h1>
						</span>
						<div class="ClearAll"></div>

				    </div>

					<div class="profile_box_body">

					<?php	displayCommentsBox("310", "follow", "overview", $profileId, $profileId,0,0,false,true);	?>

					</div>

					<? } ?>


					<?
					/**
					* Info: Displays profile commnets
					* 		
					* @version  9.0
					*/
					if(D_COMMENTS ==1){/*
					?>
					
					<span id="response_comments" class="responce_alert"></span>


					<div class="profile_box_title marginTop">

						<span class="goL">
							<h1><?=$GLOBALS['_LANG']['_comments']?></h1>
						</span>
						<div class="ClearAll"></div>

				    </div>

					<div class="profile_box_body">

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
					*//*
					displayCommentsBox("310", $page, $show_page, $MyProfileGlobals['uid'], $profileId,0,0) ?>
					
					
							
						</div>


						<?=DisplayProfileRatingSystem($profileId) ?>



				  


					<? */} ?>

					</div>

				 	    <? }elseif($show_page=="blogview"){
	
	
	/**
	* Info: Profile Profile Details Page
	* 		
	* @version  9.0
	* @created  Fri Sep 25 10:48:31 EEST 2008
	* @updated  Fri Sep 25 10:48:31 EEST 2008
	*/
	
	 ?>
	<br>
	    <div class="profile_box_title  marginTop">
	  
		<span class="goL">
			    <h1> <?=$BlogData['title']; ?> </h1>
		  </span>
	  
		<div class="ClearAll"></div>
	  
	    </div>
	    <div class="profile_box_body"><div class="ClearAll"></div>
 	  <div style="padding:10px;">
	  
	<img src="<? print $BlogData['photo']; ?>" style="float:left; padding-right:15px; padding-bottom:20px;" width="48" height="48">
  
	<b><?=$BlogData['title']; ?></b>
	<p><?=$GLOBALS['_LANG']['_date'] ?> <?=$BlogData['date']; ?> </p>
	  

	<div style="line-height:30px;"><?=$BlogData['comments']; ?></div>
		  
	<? 

	// ATTACHMENT ALBUM ATA
	if(isset($BlogData['attachment']) && $BlogData['attachment'] !=0){
 
		print GetAttachmentAlbum($BlogData['attachment']);

	}

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

	if(D_COMMENTS ==1){ 


	displayCommentsBox("280", $page, $show_page, $profileId, $BlogData['id'],eMeetingOutput($BlogData['title']),0) ?>
  
 	</div>
	<? } ?>
        </div>


	<form method="post" action="<?=DB_DOMAIN ?>index.php" name="EditBlog" id="EditBlog">
	<input type="hidden" id="eid" name="eid" value="0" class="hidden">
	<input type="hidden" id="sub" name="sub" value="add" class="hidden">
	<input name="do_page" type="hidden" value="blog" class="hidden">
	</form>

	<? }elseif($show_page=="manage"){ 
	
	/**
	* Info: Profile View Album Files
	* 		
	* @version  9.0
	* @created  Fri Sep 25 10:48:31 EEST 2008
	* @updated  Fri Sep 25 10:48:31 EEST 2008
	*/
	
	
	?>
	
		<br>
	    <span id="response_gallery" style="color:red;font-weight:bold;font-size:15px"></span>
	
	    <div class="profile_box_title marginTop">
	  
		<span class="goL">
			    <h1 style="color:#000;"> <?php if(!empty($album_name)){?> <?=$album_name ?><? } ?> <? if(empty($album_date)){?> <img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/cancel.png" align="absmiddle"> No Access! <? } ?></h1>
		  </span>
	  
		<div class="ClearAll"></div>
	  
	    </div>
	    <div class="profile_box_body">	    <div class="ClearAll"></div>	    <div>
  
		 <? if(empty($album_date)){ // album is empty ?>
		
		<p>There are either no photos available in this album or you do not have permission to view them.</p>
		<p><a href="<?=getThePermalink('gallery/search/'.$profileId) ?>">Click here to return to the album list.</a></p>
		<? }else{ ?>
  
	<p><?=$GLOBALS['_LANG']['_created'] ?> <?=$album_date ?> </p>
	  
	<? foreach($gallery_display_albums as $value){ ?>		
	  
	<div class="row" id="div_<?=$value['id'] ?>">
    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">    
	  
	<? if($value['approved'] =="no"){ ?>
	  <img src="<?=$value['image'] ?>" style="max-height:135px; max-width:120px;" width="96" height="96">
	  <? }else{ ?>			
	  <a href="<?=$value['link'] ?>">
		  <img src="<?=$value['image'] ?>" style="max-height:135px; max-width:120px;" width="96" height="96">
	  </a>
	  <? } ?>
	  
	
	  
	
	 </div>
     <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9" >    
	  
	
	 <h3 style="line-height:40px;" class="commen_user_name"><a href="<?=$value['link'] ?>"><?=$value['title'] ?></a></h3>
	  
	<? if(D_COMMENTS==1){ ?><span class="commentinfo"><a href="<?=$value['link'] ?>"><?=$value['comments'] ?> <?=$GLOBALS['_LANG']['_comments'] ?></a></span><? } ?>
	  
	<? if(D_PROFILERATING ==1){ ?><div id="post-ratings-232" class="post-ratings"><?=$value['rating_image'] ?><span> <?=$value['rating'] ?> % </span></div> <? } ?>		
	  

	<?
	## display delete functions for moderator
	if( ( isset($_SESSION['site_moderator_delete']) && $_SESSION['site_moderator_delete']=="yes") || $_SESSION['uid'] ==$value['uid'] ){
				
	print '<br><a href="javascript:void(0)" onClick="DeleteFile(\''.$value['id'].'\');  
	Effect.Fade(\'div_'.$value['id'].'\'); return false;" style="text-decoration:none">
	<img src="'.DB_DOMAIN.'images/DEFAULT/_acc/cancel.png" align="absmiddle"> &nbsp '.$GLOBALS['_LANG']['_delete'].'</a>';

	}
	?>

	</div>
    </div> <hr>

	  <? } ?>		

	<? } ?>
	  
	    </div>
	   </div>
	   <? } ?>

<?php /* New Rating */ ?>


 

	<? if($show_page=="viewfile" && $gallery_file_src !=""){ 
	
	/**
	* Info: Profile View Album File
	* 		
	* @version  9.0
	* @created  Fri Sep 25 10:48:31 EEST 2008
	* @updated  Fri Sep 25 10:48:31 EEST 2008
	*/
	
	?>
	<script type='text/javascript' src="newadmin/inc/js/silverlight.js"></script>
	<script type='text/javascript' src="newadmin/inc/js/wmvplayer.js"></script>
	
	<script type="text/javascript" src="<?=DB_DOMAIN ?>inc/js/swfobject.js"></script>
	<script>
	var numAudioPlayers = 1; 
	
	function loadSWFObject(id, pathToFile, src, w, h, v, bgcolor) {
		var strName = "podcast" + id;
	
		var so = new SWFObject(src, strName, w, h, v, bgcolor);
				 so.addParam("name", strName);
				 so.addParam("allowScriptAccess", "sameDomain");
				 so.addVariable("podcastFile", pathToFile);
				 so.addVariable("id", id);
				 so.addVariable("numAudioPlayers", numAudioPlayers);
				 so.write(strName);
	}
	</script>	

		<div style="padding:20px; background:#FFF;"><center><div class="img_width_100"><?=$gallery_file_src ?></div></center></div>
	
		<p style=" margin-top: 10px; font-size: 11px; padding: 1%; font-weight: bold; text-transform: capitalize; font-size: 14px; background: #fff;"> <?=$gallery_file_title ?></p>
		<div class="ClearAll"></div>
		<p style="padding:7px; background:#EBFAFB; border:1px solid #cccccc; margin-left:10px; margin-right:20px; font-weight:bold;"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/pictures.png" align="absmiddle"> <a <? if($_SESSION['auth'] =="yes"){ ?>href="javascript:void(0);" onClick="NewpopUpWin('<?=DB_DOMAIN ?>inc/exe/slideshow/slideshow.php?id=<?=$profileId ?>', 500, 500);return false;" <? }else{ ?> href="<?=getThePermalink('login')?>" <? } ?>><?=$GLOBALS['_LANG']['_slideshow'] ?></a></p>


	<?  if(!empty($my_image_array)){ ?>

	<!-- START EXTRA ALBUM IMAGES -->

		<div id="form_car3" style="margin-left:10px; margin-bottom:18px;">
		  <div class="previous_button"></div>  
		  <div class="container">
			<ul>
		   <?  foreach( $my_image_array as $value1){ ?> <li><a href="<?=$value1['link'] ?>"><img src="<?=$value1['image'] ?>" id="<?=$value1['filename'] ?>" width="48" height="48" style="cursor:pointer;"></a></li><? } ?>
			</ul>
		  </div>
		  <div class="next_button"></div>
		</div>
		<div class="ClearAll"></div>
	
	<script>function runTest() {        hCarousel = new UI.Carousel("form_car3");     }      Event.observe(window, "load", runTest); </script>
	<!-- END DISPLAY IMAGE -->
	
	<? } ?>


		<div class="file_comments" style="margin-left:10px; margin-bottom:30px;"> 
	 	



	<? if(D_COMMENTS ==1){ ?>
	<h3><?=$GLOBALS['_LANG']['_file'] ?> <?=$GLOBALS['_LANG']['_comments'] ?></h3>	
	
	<? 	displayCommentsBox("310", $page, $show_page, $profileId, $gallery_file_id,eMeetingOutput($gallery_file_title),0) ?>
	<br>
	<? } ?>

				  <div class="menu_box_title1">	<?=$GLOBALS['_LANG']['_information'] ?>	 </div>
				  <div class="menu_box_body1" style="line-height:30px;">
 
					
					<?=$GLOBALS['_LANG']['_title'] ?>:	<?=$gallery_file_title ?>					<br>
					<?=$GLOBALS['_LANG']['_description'] ?>					:
					<?=$gallery_file_description ?>					<br>					<?=$GLOBALS['_LANG']['_views'] ?>:		<?=$gallery_file_views ?>
					<br>
					<? if(D_PROFILERATING ==1){ ?> 
					<span id="responce_rating" class="responce_alert"></span>
					<div id="FileRatingStars">
					  <?=$GLOBALS['_LANG']['_rating'] ?>
					  :
					  <?=$gallery_file_rating ?>
					  %
					  <ul class="star-rating">
						<li class="current-rating" style="width:<?=$gallery_file_rating ?>%;"></li>
						<li><a href="#" title="1 star out of 5" class="one-star" onclick="AddRating(1,<?=$profileId ?>,<?=$gallery_file_id ?>); return false;">1</a></li>
						<li><a href="#" title="2 stars out of 5" class="two-stars" onclick="AddRating(2,<?=$profileId ?>,<?=$gallery_file_id ?>); return false;">2</a></li>
						<li><a href="#" title="3 stars out of 5" class="three-stars" onclick="AddRating(3,<?=$profileId ?>,<?=$gallery_file_id ?>); return false;">3</a></li>
						<li><a href="#" title="4 stars out of 5" class="four-stars" onclick="AddRating(4,<?=$profileId ?>,<?=$gallery_file_id ?>); return false;">4</a></li>
						<li><a href="#" title="5 stars out of 5" class="five-stars" onclick="AddRating(5,<?=$profileId ?>,<?=$gallery_file_id ?>); return false;">5</a></li>
					  </ul>
					</div>
<? } ?>
					<p>         
				</div>
	</div>
	
	<? } ?>

<?


/**
* Info: Displays profile sidebar information
* 		
* @version  9.0
*/

?></div>


</div>
</div>



<? } ?>



	<form method="post" action="<?=DB_DOMAIN ?>index.php" name="TakeTest" id="TakeTest">
	<input type="hidden" id="profileId" name="profileId" value="<?=$profileId ?>" class="hidden">
	<input type="hidden" id="quizid" name="quizid" value="0" class="hidden">
	<input type="hidden" id="sub" name="sub" value="taketest" class="hidden">
	<input name="do_page" type="hidden" value="matches" class="hidden">
	</form>

	<?

	if(isset($myTheme['header_background']) && $myTheme['header_background'] !=""){ $Fbg = str_replace("#","",$myTheme['header_background']); }else{ $Fbg ="eeeeee"; }
	if(isset($myTheme['inner_background']) && $myTheme['inner_background'] !=""){ $F1bg = str_replace("#","",$myTheme['inner_background']); }else{ $F1bg ="CCCCCC"; }
	if(isset($myTheme['header_text']) && $myTheme['header_text'] !=""){ $F2bg = str_replace("#","",$myTheme['header_text']); }else{ $F2bg ="666666"; }

	?>


</div>

<?php
/* MAIN CLOSE */
if(!isset($HEADER_SINGLE_COLUMN)){ ?></div><div class="clear"></div> <? }else{ print "</div>"; }
?>

</div> <div id="main_wrapper_bottom"></div>

</div>