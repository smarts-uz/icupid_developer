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
<? foreach($BANNER_ARRAY as $banner){ if($banner['position'] =="middle"){?>
<div class="middle_banner"><? print $banner['display'];?></div><? }} ?>

<p <? if ($PageDesc !='') {?> class="page_decr" <? }?> ><?=$PageDesc ?></p>
<? if(isset($show_page) && ( $show_page=="albums" ||  $show_page=="display" || $show_page=="create" ||  $show_page=="upload" ||  $show_page=="manage" ||  $show_page=="edit" ) ){  ?>
<div id="eMeeting" class="user">
<div class="header account_tabs">
<ul>
<li <? if($show_page=="albums" ||  $show_page=="manage" ||  $show_page=="edit" ){ ?>class="selected" <? } ?>><a href="<?= getThePermalink('gallery/albums') ?>"><span><?=$SubSub_Lang['albums'] ?></span></a></li>
<li <? if($show_page=="create"){ ?>class="selected" <? } ?>><a href="<?= getThePermalink('gallery/create') ?>"><span><?=$SubSub_Lang['create'] ?></span></a></li>
<li <? if($show_page=="upload"){ ?>class="selected" <? } ?>><a href="<?= getThePermalink('gallery/upload') ?>"><span><?=$SubSub_Lang['upload'] ?></span></a></li>
<li <? if($show_page=="display"){ ?>class="selected" <? } ?>><a href="<?= getThePermalink('gallery/display') ?>"><span><?=$SubSub_Lang['display'] ?></span></a></li></ul>
<div class="ClearAll"></div></div></div><br />
<? } ?><? if($show_page=="home"){ 


	 /**
	 * Page: Gallery Options
	 *
	 * @version  8.0
	 * @created  Fri Jan 18 10:48:31 EEST 2008
	 * @updated  Fri Sep 24 16:28:31 EEST 2008
	 */

?>
<style>
	.s1 { background: url(images/DEFAULT/_icons/new/acc/gal_1.png) no-repeat; background-position: 0% 50%}
	.s2 { background: url(images/DEFAULT/_icons/new/acc/gal_2.png) no-repeat; background-position: 0% 50%}
	.s3 { background: url(images/DEFAULT/_icons/new/acc/gal_3.png) no-repeat; background-position: 0% 50%}
	.s4 { background: url(images/DEFAULT/_icons/new/acc/gal_4.png) no-repeat; background-position: 0% 50%}</style><?=BuildPageHomeMenu($SubSub_Lang, $page) ?><? }elseif($show_page=="display"){ 

	 /**
	 * Page: Display Photo
	 *
	 * @version  8.0
	 * @created  Fri Jan 18 10:48:31 EEST 2008
	 * @updated  Fri Sep 24 16:28:31 EEST 2008
	 */

?><? if(!empty($my_image_array)){ ?><!-- START DISPLAY IMAGE -->
<div class="menu_box_title1"><span><a onclick="Effect.toggle('su','blind', {queue: 'end'}); return false;"> <img alt="" src="<?=DB_DOMAIN ?>images/DEFAULT/blank.gif" width="30" height="29" onclick="expandcontent(this,'su'); return false;" class="menu_expand" /></a></span><?=$GLOBALS['LANG_GLO_OPTIONS']['37'] ?></div>
<div class="menu_box_body1">
    <div class="row">
    
        <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 mobile_center">
            <div id="ShowDefaultPhoto1"><img alt="" src="<?=$GLOBALS['MyProfile']['image'] ?>&x=58&y=58" width="65" height="65" /></div>
        </div>
        <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
            <div id="form_car2">
            <div class="previous_button"></div>
            <div class="container">
            <ul><?  foreach( $my_image_array as $value){ ?>
            <li><img alt="" src="<?=$value['image'] ?>" id="<?=$value['filename'] ?>" onclick="Over_ChangeDefaultPhoto('<?=$value['filename'] ?>','<?=$_SESSION['uid'] ?>');" style="cursor: pointer" width="65" height="65" /></li><? } ?></ul></div>
            <div class="next_button"></div></div>
            <script>function runTest() {hCarousel = new UI.Carousel("form_car2");     }Event.observe(window, "load", runTest); </script><!-- END DISPLAY IMAGE -->
        </div>
    
    </div>

	<div class="ClearAll"></div>
</div><? }else{ ?>
<h2>You have no photos suitable for display. </h2><? } ?><? }elseif($show_page=="upload"){ 

	 /**
	 * Page: Gallery Upload
	 *
	 * @version  8.0
	 * @created  Fri Jan 18 10:48:31 EEST 2008
	 * @updated  Fri Sep 24 16:28:31 EEST 2008
	 */

?><? if(UP_PHOTO !=0 || UP_VIDEO !=0 || UP_MUSIC != 0 || UP_YOUTUBE != 0){ ?><span id="response_upload" class="responce_alert"></span>
<form name="FileUpload" enctype="multipart/form-data" method="post" action="<?=DB_DOMAIN ?>index.php" <? if(!isset($_REQUEST['eid'])){ ?> onsubmit="return CheckUploadNulls();" <? } ?>><? if(isset($_GET['eid'])){ ?><input type="hidden" name="eid" value="<?=$_REQUEST['eid'] ?>" class="hidden" /><input type="hidden" name="do" value="edit" class="hidden" /><input name="sub" type="hidden" value="albums" class="hidden" /><? }else{ ?><input type="hidden" name="do" value="upload" class="hidden" /><input name="sub" type="hidden" value="upload" class="hidden" /><? } ?><input type="hidden" name="default" value="1" class="hidden" /><input type="hidden" name="type" value="photo" id="UploadType" class="hidden" /><input type="hidden" name="uploadNeed" value="1" class="hidden" />	<input name="do_page" type="hidden" value="gallery" class="hidden" /><input name="javascriptType" type="hidden" value="photo" class="hidden" id="javascriptType" /><input name="javascriptError" type="hidden" value="<?=$GLOBALS['_LANG_ERROR']['_notaccepted'] ?>" class="hidden" id="javascriptError" />
<ul class="form">
<div class="CapBody bd_padding_20">
<!-- ****************** UPLOAD WAITING / LOADING SCREEN ************** -->
<div id="UploadWait">
<p><strong><?=$GLOBALS['LANG_GALLERY']['a4'] ?></strong></p>
<p><?=$GLOBALS['LANG_GALLERY']['a5'] ?></p>
<p><img alt="" src="<?=DB_DOMAIN ?>images/DEFAULT/_gal/loading.gif" /></p></div><!-- **************************************************************** -->
<div id="UploadBox">
<li><label><?=$GLOBALS['_LANG']['_album'] ?>: </label><select name="aid">  <?=$gallery_display_showalbums ?> </select></li><? if(!isset($_REQUEST['eid'])){ ?><!-- DISPLAY UPLOAD OPTIONS -->
<li id="FileType"><label><?=$GLOBALS['_LANG']['_fileType'] ?>:</label><select class="input" name="type" onchange="javascript:ChangeUploadType(this.value); return false;">
<option value="photo">------ <?=$GLOBALS['_LANG']['_fileType'] ?> ------</option><? if(UP_PHOTO ==1){ ?>
<option value="photo"><?=$GLOBALS['_LANG']['_photo'] ?></option> <? } ?><? if(UP_VIDEO ==1){ ?>
<option value="video"><?=$GLOBALS['_LANG']['_video'] ?></option> <? } ?><? if(UP_MUSIC ==1){ ?>
<option value="music"><?=$GLOBALS['_LANG']['_music'] ?></option> <? } ?><? if(UP_YOUTUBE ==1){ ?>
<option value="youtube">YouTube</option><? } ?></select></li>
<li id="TypePhoto"><label><?=$GLOBALS['_LANG']['_file'] ?>: </label><span id="upMe1" style="display: visible">1. <input name="uploadFile00" type="file" id="uploadFile00" /></span><br />
<span id="upMe2" style="display: visible">2. <input name="uploadFile01" type="file" id="uploadFile01" onchange="toggleLayer('upMe3');" /></span><span id="upMe3" style="display: none">3. <input name="uploadFile02" type="file" id="uploadFile02" onchange="toggleLayer('upMe4');" /></span><span id="upMe4" style="display: none; margin-left: 210px">4. <input name="uploadFile03" type="file" id="uploadFile03" onchange="toggleLayer('upMe5');" /></span><span id="upMe5" style="display: none; margin-left: 210px">5. <input name="uploadFile04" type="file" id="uploadFile04" onchange="toggleLayer('upMe6');" /></span><span id="upMe6" style="display: none; margin-left: 210px">6. <input name="uploadFile05" type="file" id="uploadFile05" onchange="toggleLayer('upMe7');" /></span><span id="upMe7" style="display: none; margin-left: 210px">7. <input name="uploadFile06" type="file" id="uploadFile06" onchange="toggleLayer('upMe8');" /></span><span id="upMe8" style="display: none; margin-left: 210px">8. <input name="uploadFile07" type="file" id="uploadFile07" onchange="toggleLayer('upMe9');" /></span><span id="upMe9" style="display: none; margin-left: 210px">9. <input name="uploadFile08" type="file" id="uploadFile08" onchange="toggleLayer('upMe10');" /></span><span id="upMe10" style="display: none; margin-left: 210px">10. <input name="uploadFile09" type="file" id="uploadFile09" onchange="toggleLayer('upMe11');" /></span><span id="upMe11" style="display: none; margin-left: 210px"> <img alt="" src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/cancel.png" align="absmiddle" /> You cannot add any more files yet.</span>
<p class="note"><?=$GLOBALS['LANG_GALLERY']['a15'] ?></p>
<div class="tip"><?=$GLOBALS['LANG_GALLERY']['a16'] ?></div></li>
<li id="TypeDefault"> <label><?=$GLOBALS['LANG_GALLERY']['a17'] ?></label><select name="default" class="input">
<option value="0"><?=$GLOBALS['_LANG']['_no'] ?></option>
<option value="1" selected=""><?=$GLOBALS['_LANG']['_yes'] ?></option></select>
<div class="tip"><?=$GLOBALS['LANG_GALLERY']['a20'] ?></div></li>
<li id="TypeMusic"><label><?=$GLOBALS['_LANG']['_file'] ?>:</label><input name="uploadFile011" type="file" id="uploadFile011" />
<p class="note"><?=$GLOBALS['LANG_GALLERY']['a22'] ?>.</p>
<div class="tip"><?=$GLOBALS['LANG_GALLERY']['a23'] ?></div></li>
<li id="TypeYouTube"><label><?=$GLOBALS['_LANG']['_link'] ?>:  </label><input id="YoutubeURL" name="url" type="text" size="40" class="input" />
<p class="note"><?=$GLOBALS['LANG_GALLERY']['a25'] ?></p>
<div class="tip"><?=$GLOBALS['LANG_GALLERY']['a26'] ?></div></li>
<li id="TypeVideo"><label><?=$GLOBALS['_LANG']['_file'] ?>:</label><input name="uploadFile012" type="file" id="uploadFile012" />
<p class="note"><?=$GLOBALS['LANG_GALLERY']['a28'] ?></p>
<div class="tip"><?=$GLOBALS['LANG_GALLERY']['a29'] ?></div></li>	<!-- END FILE TYPES --><? } ?><? if(D_FREE=="no" && ENABLE_ADULTCONTENT=="yes"){ ?>
<li><label><?=$GLOBALS['_LANG']['_adultContent'] ?>:  </label><select name="upAdult" class="input">
<option value="no"><?=$GLOBALS['_LANG']['_no'] ?></option>
<option value="yes" <? if(isset($file_array) && $file_array['adult_content'] =="yes"){ print "selected";  } ?>><?=$GLOBALS['_LANG']['_yes'] ?></option>  </select>
<p class="note"><?=$GLOBALS['_LANG_ERROR']['_adultWarning'] ?></p></li><? }else{ ?><input type="hidden" name="upAdult" value="no" /><? } ?>
<li><label><?=$GLOBALS['_LANG']['_title'] ?>:  </label><input class="input" name="title" id="Filetitle" type="text" size="30" value="<? if(isset($file_array)){ print $file_array['title']; } ?>" />
<p class="note"><?=$GLOBALS['LANG_GALLERY']['a74'] ?></p></li>
<li><label><?=$GLOBALS['_LANG']['_description'] ?>:</label><textarea class="input" name="comments" id="FileComments" cols="50" rows="4"></textarea></li>
<li><input name="Input" type="submit" value="<?=$GLOBALS['_LANG']['_save'] ?>" class="MainBtn" id="Input" /></li></div> </div></ul></form><? } ?><? }elseif($show_page=="albums"){ 

	 /**
	 * Page: Gallery Manage Albums
	 *
	 * @version  8.0
	 * @created  Fri Jan 18 10:48:31 EEST 2008
	 * @updated  Fri Sep 24 16:28:31 EEST 2008
	 */


?>

<style>
.defaultFile {
border:3px solid red;
}</style><!--<span id="response_gallery" class="responce_alert2"></span>-->
<div class="menu_box_body1">
<div class="row">
	<div class="album-gallery">
    <ul>
		<? foreach($gallery_albums as $value){ ?>
        <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
        <li id="Album_<?=$value['aid']?>" style="background: white; color: #333333"><span> <?=$value['title'] ?></span>		
        <div class="AlbumFilePic">
    		<a href="<?=getThePermalink('gallery/manage/'.$value['aid'])?>"><img alt="" src="<?=$value['image'] ?>" /></a>
    	</div>
    	<small style="font-size: 11px"><?=$GLOBALS['_LANG']['_files'] ?> <?=$value['filecount'] ?> <br />
        <img alt="" src="<?=DB_DOMAIN ?>images/DEFAULT/_gal/add.gif" align="absmiddle" style="border: 0px" /> <a href="<?=getThePermalink('gallery/upload')?>"><?=$GLOBALS['_LANG']['_add'] ?></a> |<img alt="" src="<?=DB_DOMAIN ?>images/DEFAULT/_gal/edit.gif" align="absmiddle" style="border: 0px" /> <a href="<?=getThePermalink('gallery/create/'.$value['aid'])?>"><?=$GLOBALS['_LANG']['_edit'] ?></a> <br />
        <img alt="" src="<?=DB_DOMAIN ?>images/DEFAULT/_gal/delete.gif" align="absmiddle" style="border: 0px" /> <a href="javascript:void(0);" onclick="Effect.Fade('Album_<?=$value['aid'] ?>'); DeleteAlbum('<?=$value['aid'] ?>'); return false;"><?=$GLOBALS['_LANG']['_delete'] ?></a><? if($value['password'] !=""){ ?><img alt="" src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/key_add.png" align="absmiddle" style="border: 0px" />		<? } ?></small>		</li>
        
        </div><? } ?>
    
    </ul>
    
    </div>
</div>
</div>
<? }elseif($show_page=="manage"){ 

	 /**
	 * Page: Gallery Manage Album Files
	 *
	 * @version  8.0
	 * @created  Fri Jan 18 10:48:31 EEST 2008
	 * @updated  Fri Sep 24 16:28:31 EEST 2008
	 */

?>
<div class="menu_box_body1"><!-- DISPLAY FOLDER BODY --->
<div id="FolderBody"><span id="response_gallery" class="responce_alert"></span><!-- START ALBUM DISPLAY -->

<div class="gallery">
  <div class="row">	
    <ul><? if(is_array($gallery_display_albums)) { foreach($gallery_display_albums as $value){ ?>				
    <div id="File_<?=$value['id'] ?>" class="col-xs-6 col-sm-4 col-md-4 col-lg-4">		
    <li class="album_list"><!-- DISPLAY ALBUM FILE -->
    <div class="ClearAll"></div>
    <div class="PicFrame">
    <div class="PicFramebody"><a href="<?=$value['edit_link'] ?>" <? if($value['default'] ==1){ ?>class="defaultFile" <? } ?>><img alt="" src="<?=$value['image'] ?>" /></a></div><span class="commentinfo"><a href="<?=$value['edit_link'] ?>"><?=$value['comments'] ?></a></span>
    <h2><a href="<?= getThePermalink('gallery/upload'.$value['id']) ?>"><img alt="" src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/10/create.gif" align="absmiddle" /> <?=$value['title'] ?></a></h2>			</div>							<!-- DISPLAY RATING -->
    <div id="post-ratings-232" class="post-ratings">								<?=$value['rating_image'] ?><span> <?=$value['rating'] ?> % </span></div><!-- END DISPLAY RATING -->
    <div class="ClearAll"></div>	<small style="font-size: 11px"><?=$value['views'] ?> <?=$GLOBALS['_LANG']['_views'] ?><? if($value['adult'] =="yes"){ ?>[ Adult ]<? } ?>
                                    [ <a href="#" onclick="Effect.Fade('File_<?=$value['id'] ?>'); DeleteFile('<?=$value['id'] ?>'); return false;"><?=$GLOBALS['_LANG']['_delete'] ?></a> ]</small>	<!--<br />
    <? if($value['type'] =="photo" && $value['adult'] !="yes"){ ?><a href="#" onclick="MakeDefaultP(<?=$value['id'] ?>); return false;" style="color: red"><?=$GLOBALS['LANG_GALLERY']['a44'] ?></a> <? } ?> --><!-- END ALBUM FILE DISPLAY --></li></div>					<? } }?><!-- NO ALBUM FILES --><? if(count($gallery_display_albums) ==0){ ?>
    <li> <img alt="" src="<?=DB_DOMAIN ?>images/no_photo_big.jpg" width="86px" style="float: left; padding-left: 9px; border: 0px" /><?=$GLOBALS['LANG_GALLERY']['a46'] ?></li><? } ?><!-- END NO ALBUM FILES -->
    </ul>
  </div>
</div>

</div></div><? }elseif($show_page=="edit"){ 

	 /**
	 * Page: Gallery Edit File
	 *
	 * @version  8.0
	 * @created  Fri Jan 18 10:48:31 EEST 2008
	 * @updated  Fri Sep 24 16:28:31 EEST 2008
	 */

?>
<script type="text/javascript" src="newadmin/newadmin/inc/js/silverlight.js"></script>
<script type="text/javascript" src="newadmin/newadmin/inc/js/wmvplayer.js"></script>
<style>
	#MainImage { max-width:400px;}</style>
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
 
<style type="text/css">
	.gallery_image img {width: 100%;}
</style>
<div class="width_100">    	
    <div class="col-xs-12 col-sm-12 col-md-7 col-lg-8">
        <? if($FileData['type']=="music"){ ?>
        <div id="podcast<?=$FileData['id'] ?>">Please install flash.</div>
        <script type="text/javascript">	loadSWFObject(<?=$FileData['id'] ?>, "<?=WEB_PATH_MUSIC.$FileData['bigimage'] ?>", "<?=DB_DOMAIN ?>inc/exe/flash/mp3_player.swf", "94", "61", "6", "#ffffff"); 		</script>		<? }elseif($FileData['type']=="photo"){ ?>
        <div class="img_width gallery_image" align="center"><?=$FileData['src'] ?></div><? }
		
		else	{?>
       <div class="img_width" align="center"><?=$FileData['src'] ?></div><? } ?>
    </div>
    
    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-4 sm_magintop_15">
        <div class="menu_box_title1"><span><img alt="" src="<?=DB_DOMAIN ?>images/DEFAULT/blank.gif" width="30" height="29" onclick="expandcontent(this,'s1')" class="menu_noexpand" /></span><?=$GLOBALS['_LANG']['_information'] ?> </div>
        <div class="menu_box_body1">
        <div style="overflow: auto; height: 100px; line-height: 25px"><strong><?=$GLOBALS['_LANG']['_title'] ?>:</strong> <br />
        <span id="FileCaption1" style="margin-bottom: 15px"> <?=$FileData['title'] ?></span>   <br />
        <strong><?=$GLOBALS['_LANG']['_description'] ?>:</strong> <br />
         <span id="FileDesc"> <?=$FileData['description'] ?></span></div><span><img alt="" src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/pencil.png" width="16" height="16" align="absmiddle" /> <a href="<?=DB_DOMAIN ?>index.php?dll=gallery&sub=upload&eid=<?=$item3_id ?>"><?=$GLOBALS['_LANG']['_edit'] ?></a></span><br />
        <br /><span><img alt="" src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/emoticon_tongue.png" width="16" height="16" align="absmiddle" /> (<?=$FileData['rating'] ?> %) <?=$FileData['rating_image'] ?> </span><br />
        <br /><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/zoom.png" alt="views" align="absmiddle" /> (<? print $FileData['views']; ?> <?=$GLOBALS['_LANG']['_views'] ?>) <br />
        <p><span><?=$GLOBALS['_LANG']['_album'] ?>: </span><span class="tags"><? print $FileData['album_title']; ?></span>&nbsp; <img alt="" src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/wrench.png" align="absmiddle" /><br />
        </p>
        <form method="post" action="<?=DB_DOMAIN ?>index.php"><input name="do_page" type="hidden" value="gallery" class="hidden" /><input name="sub" type="hidden" value="albums" class="hidden" /><input name="aid" type="hidden" value="<?=$item2_id ?>" class="hidden" /><input name="lid" type="hidden" value="<?=$item3_id ?>" class="hidden" /><input type="hidden" name="do" value="changeAlbum" class="hidden" /><select name="new_aid" class="input"><?=$gallery_display_showalbums ?></select><input type="submit" name="Submit" value="<?=$GLOBALS['_LANG']['_save'] ?>" class="MainBtn" /></form><br />
        <span><img alt="" src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/16/lock.gif" width="16" height="16" align="absmiddle" /> <?=$GLOBALS['_LANG']['_adultContent'] ?>: <?=$FileData['adult_content']; ?></span></div>
    
    </div>
</div>
<!-- DISPLAY FOLDER BODY -->
<form method="post" action="<?=DB_DOMAIN ?>index.php" name="UpdateBlog"><input type="hidden" id="ChangeOrder" name="ChangeOrder" value="maildate" class="hidden" /><input name="sub" type="hidden" value="edit" class="hidden" /><input name="aid" type="hidden" value="<?=$_REQUEST['aid'] ?>" class="hidden" /><input name="lid" type="hidden" value="<?=$_REQUEST['lid'] ?>" class="hidden" /><input name="do_page" type="hidden" value="gallery" class="hidden" /></form><? }elseif($show_page=="create"){ 

	 /**
	 * Page: Gallery Create Album
	 *
	 * @version  8.0
	 * @created  Fri Jan 18 10:48:31 EEST 2008
	 * @updated  Fri Sep 24 16:28:31 EEST 2008
	 */



?>
<form method="post" action="<?=DB_DOMAIN ?>index.php" onsubmit="return CheckNullsAlbums('<?=$GLOBALS['_LANG_ERROR']['_incomplete'] ?>');">
	<input type="hidden" name="do" value="addalbum" class="hidden" />
	<input name="do_page" type="hidden" value="gallery" class="hidden" />
	<? if(isset($_REQUEST['aid'])){ ?>
	<input name="sub" type="hidden" value="albums" class="hidden" />
	<input type="hidden" name="aid" value="<?=$_REQUEST['username'] ?>" class="hidden" />
	<? }else{ ?>
	<input name="sub" type="hidden" value="upload" class="hidden" />
	<? } ?>
	<ul class="form">
		<div class="CapBody bd_padding_20">
			<li>
				<label><?=$GLOBALS['_LANG']['_title'] ?>: </label>
				<input id="a1" name="title" type="text" class="input" size="40" value="<? if(isset($album)){print $album['title']; } ?>"/>
				<div class="tip"><?=$GLOBALS['LANG_GALLERY']['a64'] ?></div>
			</li>
			<li>
				<label><?=$GLOBALS['_LANG']['_visibility'] ?></label>
				<input name="catid" type="radio" value="private" id="catid_1" class="radio" onclick="javascript:enablePrivateField();" <? if(isset($album)){ if($album['cat'] =="private"){ print"checked";} } ?> style="margin-right: 20px; border: 0px" /><?=$GLOBALS['LANG_GALLERY']['a66'] ?>
				
				<div style="padding-left:20px; line-height:20px">
					<input type="checkbox" name="af" value="y" id="catid_type1" style="margin-right: 20px; border: 0px" <? if(isset($album)){ if($album['allow_f'] =="y"){ print"checked";} else{ print "disabled"; } } ?> > <?=$GLOBALS['_LANG']['_friends'] ?> <br/>
					<input type="checkbox" name="ah" value="y" id="catid_type2" style="margin-right: 20px; border: 0px" <? if(isset($album)){ if($album['allow_h'] =="y"){ print"checked";}else{ print "disabled"; } } ?> /><?=$GLOBALS['_LANG']['_hotList'] ?><br />
				</div>
				<input name="catid" type="radio" value="public" class="radio" onclick="javascript:DisablePrivateField();" style="margin-right: 20px; border: 0px" <? if(isset($album)){ if($album['cat'] =="public"){ print"checked";} }else{ print "checked"; } ?> /><?=$GLOBALS['LANG_GALLERY']['a70'] ?>
				<div class="tip"><?=$GLOBALS['LANG_GALLERY']['a71'] ?></div>
			</li>
	<!--
<? if(!isset($_REQUEST['aid'])){ ?>
<? }else{ ?><input type="hidden" name="af" value="<?=$album['allow_f'] ?>"><input type="hidden" name="ah" value="<?=$album['allow_h'] ?>" /><input type="hidden" name="aa" value="<?=$album['allow_a'] ?>" /><input type="hidden" name="catid" value="<?=$album['cat'] ?>" />			  <? } ?>
-->
<li><label><img alt="" src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/key_add.png" align="absmiddle" /> <?=$GLOBALS['_LANG']['_password'] ?>:  </label><input name="password" class="input" type="text" size="40" value="<? if(isset($album)){ print $album['password']; } ?>" />
<p class="note"><?=$GLOBALS['LANG_GALLERY']['76'] ?></p></li>
<li><label><?=$GLOBALS['_LANG']['_description'] ?></label>	<textarea id="a2" name="commentsBox" cols="40" rows="7" class="input"></textarea></li>
<li><input value="<?=$GLOBALS['_LANG']['_save'] ?>" type="submit" class="MainBtn" /></li></div></ul></form><? }elseif($show_page=="search"){ 

	 /**
	 * Page: Gallery Create Album
	 *
	 * @version  8.0
	 * @created  Fri Jan 18 10:48:31 EEST 2008
	 * @updated  Fri Sep 24 16:28:31 EEST 2008
	 */


?>
<div id="eMeetingContentBox">
<form method="GET" action="<?=DB_DOMAIN ?>index.php" name="ClassSearch"><input name="dll" type="hidden" value="gallery" class="hidden" /><input name="sub" type="hidden" value="search" class="hidden" />
<div id="Title">
<div class="AddIcon"><br />
<a href="<?= getThePermalink('gallery/upload') ?>" class="MainBtn">  <img alt="" src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/add.png" align="absmiddle" /> <?=$GLOBALS['_LANG']['_createNew'] ?></a></div><span class="a1"><?=$PageTitle ?></span><span class="a2"><?=$PageDesc ?></span></div><?=$ThisPersonsNetworkBar ?>
<div id="Search"><span class="a1"><input name="keyword" type="text" class="input" /> <input type="submit" value="<?=$GLOBALS['_LANG']['_search'] ?>" class="NormBtn" /></span><span class="a2"><?=$Search_Page_Numbers ?></span></div>
<div id="Results"> <span class="a1"> <strong><?=$search_total_results ?></strong> <?=$GLOBALS['_LANG']['_results'] ?> </span></div></form> <span id="response_event" class="responce_alert"></span><span id="response_gallery" class="responce_alert"></span>
<form name="SearchResults" method="post" action="<?=DB_DOMAIN ?>index.php?dll=<?=$page ?><? if(isset($search_page)){ print "&view_page=".strip_tags($search_page); }else{ print "&view_page=1"; } ?>"><input name="searchPage" type="hidden" id="searchPage" value="1" class="hidden" /><input name="page" type="hidden" value="<? if(isset($search_page) && is_numeric($search_page) ){ print strip_tags($search_page); }else{ print "1"; } ?>" class="hidden" id="Spage" /><input name="sub" type="hidden" value="<?=$sub_page ?>" class="hidden" /><input name="do_page" type="hidden" value="<?=$page ?>" class="hidden" /><input type="hidden" name="sort" value="1" class="hidden" id="SSort" /><? if(is_numeric($item_id)){ ?><input name="item_id" type="hidden" value="<?=$item_id ?>" class="hidden" /> <? } ?><? if(is_numeric($search_uid)){ ?><input name="fcid" type="hidden" value="<?=$search_uid ?>" class="hidden" /> <? } ?><? if($search_total_results ==0){ ?>
<div style="padding: 50px; line-height: 30px">
<h1><a href="<?= getThePermalink('gallery/search') ?>"> <?=$GLOBALS['_LANG_ERROR']['_noResults'] ?></a></h1></div><? } ?><? $i=1; foreach($search_data as $value){ ?>	
<div class="Acc_ListBox <? if(isset($value['ThisApproved']) && $value['ThisApproved']=="no"){ ?>search_display_unapproved<? }else{ if($i % 2){ ?>search_display_off<? }else{ ?>search_display_on<? } } ?>">
<div class="Acc_ListBox_left">
<div class="pic75"><a class="photo_75" href="<?=$value['link'] ?>" title="<?=$value['title'] ?>"><img alt="" src="<?=$value['images'][1]['image'] ?>" width="96" height="96" /></a></div></div>
<div class="Acc_ListBox_right">	
<div class="Acc_ListBox_right1">
<div class="Acc_ListBox_title_break"><a href="<?=$value['link'] ?>" title="<?=$value['title'] ?>"><?=$value['title'] ?></a></div><strong>   <?=$GLOBALS['_LANG']['_username'] ?>: <a href="<?=$value['user_link'] ?>"><?=$value['username'] ?></a> - <?=$GLOBALS['_LANG']['_files'] ?> <?=$value['filecount'] ?> </strong>
<div class="Acc_ListBox_margin5"></div>	<? if(count($value['images']) >1){for ($ix=2;$ix<=count($value['images']);$ix++) {print '<a href="'.$value['images'][$ix]['link'].'"><img src="'.$value['images'][$ix]['image'].'" style="border:1px solid #ccc; margin-right:8px;" width="40" height="40"></a>';}} ?></div>
<div class="Acc_ListBox_right2">
<div>		<? if($value['password'] != ""){  ?><img alt="" src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/key_delete.png" align="absmiddle" /><? }else{ ?><img alt="" src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/zoom.png" width="16" height="16" align="absmiddle" /><? } ?> <a href="<?=$value['link'] ?>"><?=$GLOBALS['_LANG']['_view'] ?></a>	 <br>
<img alt="" src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/user.png" width="16" height="16" align="absmiddle" /> <a href="<?=$value['user_link'] ?>"><?=$GLOBALS['LANG_COMMON'][11] ?></a>				</div></div>
<div class="clear"></div></div>
<div class="clear"></div></div>	
<div class="ClearAll"></div><? $i++; } ?>							
<div id="Bottom"><?=$Search_Page_Numbers ?></div></form></div> <!-- end main box --><? } ?>

<?php
/* MAIN CLOSE */
if(!isset($HEADER_SINGLE_COLUMN)){ ?></div><div class="clear"></div> <? }else{ print "</div>"; }
?>

</div> <div id="main_wrapper_bottom"></div>
</div>