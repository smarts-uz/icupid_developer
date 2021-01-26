<?php
## block direct page access
defined( 'KEY_ID' ) or die( 'Restricted access' );
?>

<div id="main" class="col-md-6">    
	<div id="main_content_wrapper">     

		<?php  if(!isset($HEADER_SINGLE_COLUMN)){ ?><div class='conten_outer' style="padding:10px 20px;"> <?php  } ?>   
       	
       	<div class="clear"></div>

    	<?php
    	if(isset($ERROR_MESSAGE) && strlen($ERROR_MESSAGE) > 3){ ?>
	    <div id="messages">
			<div style="" class="message-<?=$ERROR_TYPE ?>" id="main-message-<?=$ERROR_TYPE ?>">
	        	<a class="dismiss-message" href="#" onclick="Effect.Fade('main-message-<?=$ERROR_TYPE ?>', { duration : 0.5 });; return false;"><img src="images/DEFAULT/_icons/16/menu.gif"></a>
	          <?=$ERROR_MESSAGE ?>
	        </div>
	        <script type="text/javascript" language="javascript">Effect.Pulsate('main-message-<?=$ERROR_TYPE ?>', { pulses : 2, duration : 1, from : 0.7 });</script>
	    </div>
		<?php
		}

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
		<img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/wrench.png" align="absmiddle"> <a href="<?= getThePermalink('account/edit') ?>"> [ Edit Profile ] </a>

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




<script>
	/*window.onload = function(e){ 
   		alert('here');
		openProfileTab(event, 'profile-about');
	}*/
	
function openProfileTab(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
        tablinks[i].className = tablinks[i].className.replace(" selected", "");
         tablinks[i].className = tablinks[i].className.replace("selected", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active selected";


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


<?php


if($show_page=="blogview"){


	/**
	* Info: Profile Profile Details Page
	* 		
	* @version  9.0
	* @created  Fri Sep 25 10:48:31 EEST 2008
	* @updated  Fri Sep 25 10:48:31 EEST 2008
	*/
 	?>
	<br>
<div class="contentf"><div>
        <div class="contenti" style="margin-left:0px;">
	<div class="profile_box_title  marginTop" style="background-color: white;">
		<span class="goL">
			<h1 style="padding-left: 5px;font-size: 20px;"> <?=$BlogData['title']; ?> </h1>
	  	</span>
	  	<div class="ClearAll"></div>
  	</div>
	<div class="profile_box_body">
		<div class="ClearAll"></div>

				<div style="padding:10px;">

			<img src="<?php  print $BlogData['photo']; ?>" style="float:left; padding-right:15px; padding-bottom:20px;" width="48" height="48">
			<b><?=$BlogData['title']; ?></b>
			<p><?=$GLOBALS['_LANG']['_date'] ?> <?=$BlogData['date']; ?> </p>
			<div style="line-height:30px;"><?=$BlogData['comments']; ?></div>
			<?php  
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
		  
			<?php  } ?>
	 	</div>
	</div>
    </div>
                </div>
        </div>
	<form method="post" action="<?=DB_DOMAIN ?>index.php" name="EditBlog" id="EditBlog">
	<input type="hidden" id="eid" name="eid" value="0" class="hidden">
	<input type="hidden" id="sub" name="sub" value="add" class="hidden">
	<input name="do_page" type="hidden" value="blog" class="hidden">
	</form>

<?php  } else { ?>
<style type="text/css">
	.tablinks.selected, .tablinks:hover {
	    color: white;
	}
</style>


<div id="profile_section_13" >
	<div id="eMeeting">
  <div class="header account_tabs">
<ul>
    <li class="tablinks selected" onclick="openProfileTab(event, 'profile-about')"><span ><?=$LANG_BODY['_about']?></span></li>

<li class="tablinks" onclick="openProfileTab(event, 'profile-media')"><span><?=$LANG_BODY['_media']?></span></li>

    <?php
	  	if(D_PROFILE_COMPARE == 'yes'){
  		?>
   <li class="tablinks" onclick="openProfileTab(event, 'profile-compare')"><span><?=$LANG_BODY['_compare']?></span></li>
   <?php
	 	}
	  	
	  	if(D_COMPATIBILITY_QUIZ == 'yes'){
  		?> 

    <li class="tablinks" onclick="openProfileTab(event, 'profile-compatibility')"><span><?=$LANG_BODY['_compatibilityquiz']?></span></li>
    <?php
	  	}
	  	?>
    
   <li class="tablinks" onclick="openProfileTab(event, 'profile-email')"><span><?=$LANG_BODY['_email']?></span></li>

   <li class="tablinks" onclick="openProfileTab(event, 'profile-comments')"><span><?=$LANG_BODY['_comments']?></span></li>
   <li class="tablinks" onclick="openProfileTab(event, 'profile-rating')"><span><?=$LANG_BODY['_rating']?></span></li>
   <li class="tablinks" onclick="openProfileTab(event, 'profile-quizze')"><span><?=$LANG_HEADINGS['matches_test']?></span></li>

   </ul>
	
</div>
</div>

	<div id="profile-about" style="display: block;" class="tabcontent">
	  <div class="contentf" style="width:94%;margin:3%;"><div>
                  <div class="contenti" style="margin-left:0px;">
	  	<?php
				
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

	  	<?php
	  	if(D_FRIENDS ==1){


			/**
			* Info: Displays member friends
			* 		
			* @version  9.0
			*/

			if(!empty($show_network_array)){

			?>


<div class="profile_box_title marginTop" >
		  
				<span class="goL">
				    <h4><?=$GLOBALS['LANG_COMMON'][3]?></h4>
				  </span>
				  <div class="ClearAll"></div>
		  
		    </div>

			<div class="profile_box_body">
				<div class="profile_friends_list">

					<?php  
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

			<?php  
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
				     <?php
				     if($_SESSION['uid'] ==$profileId ){ ?>
				     	<a href="<?= getThePermalink('account/edit/group/'.$value['groupid']) ?>" class="pLink"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/pencil.png" align="absmiddle"> <?=$GLOBALS['_LANG']['_edit']?> </a>
			     	<?php
			     	}
			     	?>
				  	</span>
				  	<div class="ClearAll"></div>
		  
			    </div>
		  
				<div class="profile_box_body" id="DataBoxBody<?=$value['groupid'] ?>">
		   
		   		<?php
				print GetProfileData($profileId,$value['groupid'],1); 
				 ?>
		  
				</div>

				<?php  
				}
				?>


			<?php  }else{ ?>

			<div class="profile_box_title marginTop" id="DataBoxTitle<?=$value['groupid'] ?>">
		  
				<span class="goL">
				    <h4><?=$value['caption'] ?></h4>
				  </span>
				  <span class="goR">
				     <?php  if($_SESSION['uid'] ==$profileId ){ ?><a href="<?=getThePermalink('account/edit')?>" class="pLink"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/pencil.png" align="absmiddle"> <?=$GLOBALS['_LANG']['_edit']?> </a> <?php  } ?>
				  </span>
				  <div class="ClearAll"></div>
		  
		    </div>
		  
			<div class="profile_box_body" id="DataBoxBody<?=$value['groupid'] ?>">
		   
		   	<?php
				 print GetProfileData($profileId,$value['groupid'],1); 
				
			 ?>
		  
			</div>

		  
		<?php  } ?>
		  

		                 
		<?php
		}
		?>
        </div>
</div>
                </div>
	</div>

	<div id="profile-media" class="tabcontent">
	  	<?php
	  	if(!empty($RecentPhotos)) {
					
		?>
	  	<div class="profile_box_title marginTop" style="display: none;">
	  		<span class="goL">
			    <h4><?=$GLOBALS['LANG_COMMON'][23] ?></h4>
		  	</span>
			<span class="goR">
				<?php
				if($_SESSION['uid'] ==$profileId ){ ?>
				<a href="<?=getThePermalink('account/edit')?>"  class="pLink"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/pencil.png" align="absmiddle"> <?=$GLOBALS['_LANG']['_edit']?> </a> | 
				<?php
				}
				?>  
			    <a class="pLink" href='<?=getThePermalink('gallery/search/'.$profileId)?>'><?=$GLOBALS['_LANG']['_viewAll'] ?></a> |
				  
				<a <?php  if($_SESSION['auth'] =="yes"){ ?>href="#" class="clickable"  data-toggle="modal" data-target="#myModal"  <?php  }else{ ?> href="<?=getThePermalink('login')?>" <?php  } ?>><?=$GLOBALS['_LANG']['_slideshow'] ?></a>
		  	</span>
			<div class="ClearAll"></div>
	  	
	    </div>
	  
		<div class="profile_box_body">

		<div class="profile_photos_list row">

			<?php  
			if(!empty($RecentPhotos)){
			foreach($RecentPhotos as $value){ ?> 
			<div class="col-xs-6 col-sm-6 col-md-4 media_item">
				<div class="profile_photo">
					<!--<a href="javascript:void();" class="clickable"  data-toggle="modal" data-target="#myModal">-->
                                        <a href="<?=DB_DOMAIN.'uploads/thumbs/'. $value['bigimage']; ?>" data-fancybox >
                                            <img src="<?=$value['image']; ?>" class="pImageBorder">
					<div class="pImageUsername"><b><?=$value['title']; ?></b><br/><?=$value['description']; ?></div>
                                        </a>
				</div>
			</div>
			<?php
			}
			}
			?>
	  		
		</div>

		    
		</div>
	  
	<?php
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
			<?php
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
		     	<?php
				if($_SESSION['uid'] ==$profileId ){ ?>
			     	<a href="#" class="pLink">View/Hide Details</a>
		     	<?php
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
							<a href="<?= getThePermalink('messages/read/'.$mail['id'])?>">
							<img src="<?=$mail['image']?>">
							</a>
						</div>
						<div class="email col-md-9">
							<a href="<?= getThePermalink('messages/read/'.$mail['id'])?>">
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
	  	<?php
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

				<?php  
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

		<?php  
		}
		?>
	</div>
	<div id="profile-rating" class="tabcontent">
	  	<?=DisplayProfileRatingSystem($profileId) ?>
	</div>
    
    <div id="profile-quizze" class="tabcontent">
	  	  <?php $profile_tests=DisplayMemberQuizzes($profileId);;
                     if(!empty($profile_tests) || $_SESSION['uid'] ==$profileId && D_MATCHTESTS ==1)
					 {
					 	?>
                        <!--Qu1z part-->	
						<div class="profile_box_title_new marginTop"> 
                        <span class="goL">
                            <h1>
                              <?=$GLOBALS['_LANG']['_quiz'] ?>
                            </h1>
                        </span>
                        <span class="goR">
                          <?php if($_SESSION['uid'] ==$profileId ){ ?>
                          <a href="<?=getThePermalink('matches/test')?>" class="edit_link"><img src="<?=DB_DOMAIN ?>/images/DEFAULT/_icons/new/pencil.png" align="absmiddle" class="border_radius_none">
                          <?=$GLOBALS['_LANG']['_edit']?>
                          </a>
                          <?php } ?>
                       </span>
               
                <div class="ClearAll"></div>
              </div>
              				<div class="profile_box_body Acc_ListBox pddng_lft">
								<?php if(!empty($profile_tests)){ foreach($profile_tests as $value){ ?>
                                <table width="100%"  border="0" align="center" style="border-bottom:1px dashed #999999;  font-size:11px;">
                                  <tr valign="top">
                                    <td width="18%" height="51"><span style="font-weight:bold;display:block;font-size:13px;"> <a <?php  if($_SESSION['auth'] =="yes"){ ?>href="javascript:void(0);" onClick="NewpopUpWin('<?=DB_DOMAIN ?>inc/exe/quiz/start.php?item_id=<?=$profileId ?>&item2_id=<?=$value['id'] ?>', 450, 300);return false;" <?php  }else{ ?> href="<?=getThePermalink('login')?>" <?php  } ?>  class="pLink"> <img src="<?=DB_DOMAIN ?>/images/DEFAULT/_quiz/<?=$value['icon'] ?>.png" width="48" height="48" class="img_border"> </a> </span></td>
                                    <td width="82%" style="line-height:27px;"><a <?php  if($_SESSION['auth'] =="yes"){ ?>href="javascript:void(0);" onClick="NewpopUpWin('<?=DB_DOMAIN ?>inc/exe/quiz/start.php?item_id=<?=$profileId ?>&item2_id=<?=$value['id'] ?>', 450, 300);return false;" <?php  }else{ ?> href="<?=getThePermalink('login')?>" <?php  } ?> class="pLink"> <b>
                                      <?=$value['title'] ?>
                                      </b><br>
                                      </a></td>
                                  </tr>
                                </table>
                                <?php } } ?>
                             </div>
						<!--Quiz part-->
                        <?php	
					 }
					 
					?>
	</div>
	
</div>

<?php  } ?>
				

<?php  } ?>




	<form method="post" action="<?=DB_DOMAIN ?>index.php" name="TakeTest" id="TakeTest">
	<input type="hidden" id="profileId" name="profileId" value="<?=$profileId ?>" class="hidden">
	<input type="hidden" id="quizid" name="quizid" value="0" class="hidden">
	<input type="hidden" id="sub" name="sub" value="taketest" class="hidden">
	<input name="do_page" type="hidden" value="matches" class="hidden">
	</form>

	<?php

	if(isset($myTheme['header_background']) && $myTheme['header_background'] !=""){ $Fbg = str_replace("#","",$myTheme['header_background']); }else{ $Fbg ="eeeeee"; }
	if(isset($myTheme['inner_background']) && $myTheme['inner_background'] !=""){ $F1bg = str_replace("#","",$myTheme['inner_background']); }else{ $F1bg ="CCCCCC"; }
	if(isset($myTheme['header_text']) && $myTheme['header_text'] !=""){ $F2bg = str_replace("#","",$myTheme['header_text']); }else{ $F2bg ="666666"; }

	?>


<?php
/* MAIN CLOSE */
if(!isset($HEADER_SINGLE_COLUMN)){ ?></div><div class="clear"></div> <?php  }else{ print "</div>"; }
?>

</div> <div id="main_wrapper_bottom"></div>
</div>

