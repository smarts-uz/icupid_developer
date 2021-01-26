<style>
div.pagination {
    margin: 5px;
    padding: 5px;
}
div.pagination a {      
    color: #0033CC;
    font-size: 15px;
    padding: 2px 5px;
    text-decoration: none
}
div.pagination a:hover, div.pagination a:active {
    border: 1px solid #0DACFF;
    color: #000000;
}
div.pagination span.current {
    background-color: #0DACFF;
    border: 1px solid #0DACFF;
    color: #FFFFFF;
    font-weight: bold;
    margin: 2px;
    padding: 2px 5px;
}
div.pagination span.disabled {
    border: 1px solid #CCCCCC;
    color: #CCCCCC;
    margin: 2px;
    padding: 2px 5px;
}
.custom-button,.custom-button-edit,.custom-button-answer,.answer_update ,.ques_update{
	padding:5px 6px;
	background:red;
	border-radius:4px;
	text-decoration:none;
	color:#ffffff;
}
.custom-button-edit {background:orange;}
.custom-button-answer {background:yellowgreen;}
.answer_update, .ques_update{ background:#069;}


</style>
<?php
error_reporting(0);
/*
 SYSTEM CHECK AND POP-UP ENTIRES
*/
if( ADMIN_DEMO =="yes" && !isset($_SESSION['warn_demo']) && !in_array(A_LANG,$cant_pop) ){
	print '<input class="lbOn" id="lbOnAuto" type="hidden" value="pop_demo_mode.php">';
	$_SESSION['warn_demo']=1;
}
/*
if( isset($_SESSION['logincount']) && $_SESSION['logincount'] ==0 && $_SESSION['admin_super_user'] !="yes" && !in_array(A_LANG,$cant_pop)){
	print '<input class="lbOn" id="lbOnAuto" type="hidden" value="pop_introduction.php">';
	$_SESSION['logincount']=1;
}
*/

if( ($_SESSION['admin_alerts']=="yes" && !in_array(A_LANG,$cant_pop))  ){
	print '<input class="lbOn" id="lbOnAuto" type="hidden" value="pop_welcome.php">';
	$_SESSION['admin_alerts']="no";
}


$new_today = number_format(CountMembers(26));


if(!isset($_REQUEST['p']) || $_REQUEST['p']=="" ){ 


  ## define variables
	$AlertArray = array(); $Counter=1; 

	$SQL = "select row_num from 
		(
			SELECT count(id) AS row_num FROM members
			union ALL
			SELECT count(id) AS row_num FROM comments
			union ALL
			SELECT count(topic_id) AS row_num FROM forum_topics 
			union ALL
			SELECT count(id) AS row_num FROM calendar_data
			union ALL
			SELECT count(id) AS row_num FROM files WHERE  ( type='video' OR type='youtube' )
			union ALL
			SELECT count(id) AS row_num FROM files WHERE  ( type='photo' )
			union ALL
			SELECT count(id) AS row_num FROM files WHERE  ( type='music' )
			union ALL
			SELECT count(pollid) AS row_num FROM poll_desc 
			union ALL
			SELECT count(id) AS row_num FROM game_games 
			union ALL
			SELECT count(id) AS row_num FROM tag_cloud   
			union ALL
			SELECT count(id) AS row_num FROM articles 
			union ALL
			SELECT count(id) AS row_num FROM groups
			union ALL
			SELECT count(id) AS row_num FROM class_adverts  
			union ALL
			SELECT count(id) AS row_num FROM members_network
			union ALL
			SELECT count(id) AS row_num FROM blog_posts 
      union ALL
      SELECT count(id) AS row_num FROM members WHERE reg_type='Reg Page'
      union ALL
      SELECT count(id) AS row_num FROM members WHERE reg_type='FB'
      union ALL
      SELECT count(uid) AS row_num FROM members_data WHERE gender='63'
      union ALL
      SELECT count(uid) AS row_num FROM members_data WHERE gender='64'
      union ALL
      SELECT count(uid) AS row_num FROM members_billing
      union ALL
      SELECT count(search_id) AS row_num FROM member_searches
      union ALL
      SELECT count(aid) AS row_num FROM album
      union ALL
      SELECT count(mailnum) AS row_num FROM messages WHERE type='wink'
      union ALL
      SELECT count(mailnum) AS row_num FROM messages WHERE type='normal'
      union ALL
      SELECT count(uid) AS row_num FROM members_network n, members m WHERE m.id = n.uid AND m.active = 'active' AND visible = 'yes' AND (n.type=2 OR n.type=4) AND n.approved !='yes'
      union ALL
      SELECT count(id) AS row_num FROM members WHERE active='cancel'
      union ALL
      SELECT count(id) AS row_num FROM members_admin
		) as derived_table";
	 
	$Data = $DB->Query($SQL);
 
	## loop data from query
 	while( $DataArray = $DB->NextRow($Data) ){

	  $AlertArray[$Counter]['total'] = number_format($DataArray['row_num']); 
		$Counter++;
	}

?>

<style>
  .overview_title { padding:5px; color:#FFFFFF; dont-weight:bold; font-size:13px; }
  ul.form{float: left; width: 100%; position: relative;}
  .statistics-links{ float: left; width: 100%;  padding: 0px 9px 0px 8px; }
  .statistics-links ul{ float: left; width: 100%; border-bottom: 5px solid #0f2640;}
  .statistics-links ul li{ float: left; padding: 7px 12px; color: #0f2640; cursor: pointer;}
  .statistics-links ul li.active, .statistics-links ul li:hover{color: #FFFFFF; background-color: #0f2640 !important;}
  .usage-figures{ float: left; width: 100%; }
  .usage-figures li{ float: left; clear: none !important; width: 18%; padding: 4px 2px 6px 4px;}
  .usage-figures li.usage-value{width: 7%;}
  .search_display_on { background:#eeeeee;}
  
  .usage-figures li span{ float: right; }
  .popbox_text{vertical-align: top;padding-left: 5px;}
  .popbox_img{padding-right: 5px;}
  .recently_login_list{float: left;width: 100%; font-size: 13px;}
  .recently_login_list li{ min-height: 18px;  }
  .recently_login_list li img{ float: left;}
  .recently_login_list li span{ float: left; padding: 1px;}
  </style>

<div class="statistics-links">
  <ul class="statistics-link-list">
    <li onclick="ShowHideStats('tbl-members-graph'); ShowNewMembersGraph();" class="active">New Member Signups</li>
    <li onclick="ShowHideStats('tbl-box-visitors');ShowVisitorGraph();">Visitor Statistics</li>
    <li onclick="ShowHideStats('tbl-box-affiliated');ShowAffiliateGraph();">Affiliate Statistics</li>
  </ul>
</div>

<ul class="">
  <div class="box_body">
    <div id="tbl-members-graph" style="width:100%" >
        <div style="background-color:#666666;float: left; width: 100%;" class="overview_title">New Member Signups</div>
        <div class="box_body" id="members-graph">
        <?php include("graph/members_graph.php"); ?>
        </div>
    </div>

    <div id="tbl-box-visitors" style="width:100%;display: none;">
        <div style="background-color:#666666;float: left; width: 100%;" class="overview_title"><?=$admin_overview[6] ?></div>
        <div class="box_body" id="box-visitors">
        <?php include("graph/members_visitor.php"); ?>
        </div>
    </div>

    <div id="tbl-box-affiliated" style="width:100%;display: none;">
        <div style="background-color:#666666;float: left;width: 100%;" class="overview_title"><?=$admin_overview[10] ?></div>
        <div class="box_body" id="box-affiliated">
        <?php include("graph/members_affiliate.php"); ?>
        </div>
    </div>

    <table style="width:100%"  border="0" cellspacing="5">
      <tr>
        <td colspan="2" bgcolor="#666666" class="overview_title">&nbsp;Web Site Usage</td>
      </tr>

      <tr>
        <td colspan="2">
          <ul class="usage-figures">
            <li class="usage-value"><span><?=$AlertArray[1]['total'] ?></span></li><li>Members</li>
            <li class="usage-value"><span><?=$AlertArray[2]['total'] ?></span></li><li>Comments</li>
            <li class="usage-value"><span><?=$AlertArray[12]['total'] ?></span></li><li>Groups</li>
            <li class="usage-value"><span><?=$AlertArray[16]['total'] ?></span></li><li>Registrations</li>
            <li class="usage-value"><span><?=$AlertArray[18]['total'] ?></span></li><li>Male</li>
            <li class="usage-value"><span><?=$AlertArray[15]['total'] ?></span></li><li>Blogs</li>
            <li class="usage-value"><span><?=$AlertArray[27]['total'] ?></span></li><li>Moderators</li>
            <li class="usage-value"><span><?=$AlertArray[17]['total'] ?></span></li><li>Facebook Registrations</li>
            <li class="usage-value"><span><?=$AlertArray[19]['total'] ?></span></li><li>Female</li>
            <li class="usage-value"><span><?=$AlertArray[11]['total'] ?></span></li><li>Articles</li>
            <li class="usage-value"><span><?=$AlertArray[24]['total'] ?></span></li><li>Emails Sent</li>
            <li class="usage-value"><span><?=$AlertArray[20]['total'] ?></span></li><li>Payments</li>
            <li class="usage-value"><span><?=$AlertArray[4]['total'] ?></span></li><li>Events</li>
            <li class="usage-value"><span><?=$AlertArray[8]['total'] ?></span></li><li>Polls</li>
            <li class="usage-value"><span><?=$AlertArray[25]['total'] ?></span></li><li>Friend Requests</li>
            <li class="usage-value"><span>X</span></li><li>Subscriptions</li>
            <li class="usage-value"><span><?=$AlertArray[6]['total'] ?></span></li><li>Photos</li>
            <li class="usage-value"><span><?=$AlertArray[14]['total'] ?></span></li><li>Friends</li>
            <li class="usage-value"><span>X</span></li><li>Black Book Entries</li>
            <li class="usage-value"><span>X</span></li><li>Chargebacks</li>
            <li class="usage-value"><span><?=$AlertArray[7]['total'] ?></span></li><li>Music</li>
            <li class="usage-value"><span><?=$AlertArray[3]['total'] ?></span></li><li>Forum Topics</li>
            <li class="usage-value"><span><?=$AlertArray[23]['total'] ?></span></li><li>Wink/Flirts Sent</li>
            <li class="usage-value"><span><?=$AlertArray[26]['total'] ?></span></li><li>Canceled Memberships</li>
            <li class="usage-value"><span><?=$AlertArray[22]['total'] ?></span></li><li>Galleries</li>
            <li class="usage-value"><span><?=$AlertArray[9]['total'] ?></span></li><li>Games</li>
            <li class="usage-value"><span><?=$AlertArray[21]['total'] ?></span></li><li>Saved Searches</li>
          </ul>
          </td>
        </tr>
        <?php /*<tr>
          <td colspan="2">
          <table style="width:100%" height="142"  border="0" bgcolor="#eeeeee" style="font-size:13px;">
            <tr>
              <td width="100" height="26" class="tp_margin">Members</td>
              <td width="100"><strong>
                <?=$AlertArray[1]['total'] ?>
              </strong>&nbsp;&nbsp;</td>
              <td width="106">Comments</td>
              <td width="88"><strong>
                <?=$AlertArray[2]['total'] ?>
              </strong>&nbsp;&nbsp;</td>
              <td width="111" height="30">Forum Topics</td>
              <td width="34"><strong>
                <?=$AlertArray[3]['total'] ?>
              </strong>&nbsp;&nbsp;</td>
            </tr>
            <tr>
              <td height="26">Events</td>
              <td><strong>
                <?=$AlertArray[4]['total'] ?>
              </strong>&nbsp;&nbsp;</td>
              <td>Profile Videos</td>
              <td><strong>
                <?=$AlertArray[5]['total'] ?>
              </strong>&nbsp;&nbsp;</td>
              <td height="30">Photos</td>
              <td><strong>
                <?=$AlertArray[6]['total'] ?>
              </strong>&nbsp;&nbsp;</td>
            </tr>
            <tr>
              <td height="26">Profile Music </td>
              <td><strong>
                <?=$AlertArray[7]['total'] ?>
              </strong>&nbsp;&nbsp;</td>
              <td>Polls</td>
              <td><strong>
                <?=$AlertArray[8]['total'] ?>
              </strong>&nbsp;&nbsp;</td>
              <td height="30">Games</td>
              <td><strong>
                <?=$AlertArray[9]['total'] ?>
              </strong>&nbsp;&nbsp;</td>
            </tr>
            <tr>
              <td height="26">Tags</td>
              <td><strong>
                <?=$AlertArray[10]['total'] ?>
              </strong>&nbsp;&nbsp;</td>
              <td>Articles</td>
              <td><strong>
                <?=$AlertArray[11]['total'] ?>
              </strong>&nbsp;&nbsp;</td>
              <td height="30">Groups</td>
              <td><strong>
                <?=$AlertArray[12]['total'] ?>
              </strong>&nbsp;&nbsp;</td>
            </tr>
            <tr>
              <td height="26">Classifieds</td>
              <td><strong>
                <?=$AlertArray[13]['total'] ?>
              </strong>&nbsp;&nbsp;</td>
              <td>Friends</td>
              <td><strong>
                <?=$AlertArray[14]['total'] ?>
              </strong>&nbsp;&nbsp;</td>
              <td height="30">Blogs</td>
              <td><strong>
                <?=$AlertArray[15]['total'] ?>
              </strong>&nbsp;&nbsp;</td>
            </tr>
          </table> 
        </td>
      </tr>*/ ?>
    </table>

    <?php

    // CREATE TWO ARRAYS, ONE FOR TOTALS AND ONE FOR COUNTRY
    $re_a_array = array(); $array_counter =0;
    $re_b_array = array();
    ///customization options are here
    $foundData=0;
    $ReturnData="";
  
    $CountThis = "SELECT count(*) as exist FROM members
      INNER JOIN members_data ON ( members.id = members_data.uid )
      LEFT JOIN files ON ( files.uid = members_data.uid )
      LEFT JOIN members_online ON ( members_online.logid = members_data.uid )
      LEFT JOIN package ON ( members.packageid = package.pid)
      WHERE members.ip !='00.000.00.00' AND members.ip != '127.0.0.1' AND members.ip !='' AND members.ip_long !='' AND members.ip_lat !='' $ExtraString";
  
    $RnThis = "SELECT package.name AS packname, members_data.gender, members.ip_long,members.ip_lat,members.ip_country ,members.ip_code, members_data.country, members_data.gender, members.id, files.bigimage, files.type, files.approved, members_data.country, members.username, members.ip FROM members
      INNER JOIN members_data ON ( members.id = members_data.uid )
      LEFT JOIN files ON ( files.uid = members_data.uid )
      LEFT JOIN members_online ON ( members_online.logid = members_data.uid )
      LEFT JOIN package ON ( members.packageid = package.pid)
      WHERE members.ip !='00.000.00.00' AND members.ip != '127.0.0.1' AND members.ip !='' AND members.ip_long !='' AND members.ip_lat !='' $ExtraString
      GROUP BY members.username
      ORDER BY members.id DESC LIMIT 100";

    //print $_POST['u_value'];
    $count_result = $DB->Row($CountThis);
    $result = $DB->Query($RnThis);
  


    if($count_result['exist'] != '0'){

      while( $row = $DB->NextRow($result) ) { 
    
        if(!isset($row['gender'])){$row['gender']=0; }
          $gend = $DB->Row("SELECT fvCaption FROM field_list_value WHERE fvid=".$row['gender']." LIMIT 1");
      
          if($row['bigimage'] ==""){
            $UImage = "/inc/tb.php?src=".DEFAULT_IMAGE;
          }else{
            $UImage = "/inc/tb.php?src=".$row['bigimage']."&x=100&y=100";
            //$UImage = WEB_PATH_IMAGE_THUMBS.$row['bigimage'];
          }
        $BuildHTML = "<table width=200 border=0><tr><td><img src=\"".$UImage."\" class=\"popbox_img\"></td><td valign=\"top\" class=\"popbox_text\"><b>Username: ".$row['username']."</b><br>Package: ".$row['packname']." <br> Gender: ".$gend['fvCaption']." <br> <b><a href=\"".DB_DOMAIN."index.php?dll=profile&pId=".$row['id']."\" target=\"_blank\">View ".$row['username']."\'s Profile</a></b></td></tr></table>";
        $ReturnData .= "{'code': '".$row['ip_code']."', 'name': '".$row['username']."', 'latitude':".$row['ip_lat'].", 'longitude':".$row['ip_long'].",'html':'".$BuildHTML."'},";
        $recent_user_lat =  $row['ip_lat'];
        $recent_user_long = $row['ip_long'];
      }
    }
    else{
      
      $BuildHTML = "";
      $ReturnData .= "{'code': '".$_SERVER['REMOTE_ADDR']."', 'name': 'Administrator', 'latitude':34.0522, 'longitude':118.2437,'html':'".$BuildHTML."'},";
      $recent_user_lat =  '34.0522';
      $recent_user_long = '118.2437';
    }

    ?>

    <table style="width:100%"  border="0" cellspacing="5">
    <tr>
      <td colspan="2" bgcolor="#666666" class="overview_title">&nbsp;Website Visitors</td>
    </tr>

    <tr>
      <td colspan="2">
        <div id="map" style="width: 100%; height: 400px;"></div>
        <script>

          var locations = [ <?=$ReturnData ?> {'code': '', 'name': 'no', 'latitude':0, 'longitude':0, 'html':' ' } ];
        
          var map;

          function initMap() {

            map = new google.maps.Map(document.getElementById('map'), {
              center: {lat: <?=$recent_user_lat?>, lng: <?=$recent_user_long?>},
              zoom: 3
            });

            for (i = 0; i < (locations.length - 1); i++) {
              addMarker(locations[i], map);
            }
          }
          // Adds a marker to the map.
          function addMarker(location, map) {

            var infowindow = new google.maps.InfoWindow({
              content: location.html
            });
            
            var pos = {lat:location.latitude,lng:location.longitude};
            // Add the marker at the clicked location, and add the next-available label
            // from the array of alphabetical characters.
            var marker = new google.maps.Marker({
              position: pos,
              map: map
            });

            marker.addListener('click', function() {
              infowindow.open(map, marker);
            });
          }

        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=<?=GOOGLE_MAPS_KEY?>&callback=initMap" async defer></script>
      </td>
    </tr>
    </table>

<table style="width:100%"  border="0" cellspacing="5">
  <tr bgcolor="#666666">
    <td width="277" height="27" class="overview_title">Rcently Logged in Members </td>
    <td width="299" height="27"  class="overview_title">Latest Member Signups </td>
  </tr>
  <tr>
    <td width="50%">
      <ul class="recently_login_list">
      <?php
      $i=1;
      	$Data = $DB->Query("SELECT members.username,  members.id,  members.lastlogin, members.hits, members_data.gender FROM members, members_data WHERE members.id = members_data.uid  ORDER BY lastlogin DESC LIMIT 0,10"); 
      	## loop data from query
       	while( $value = $DB->NextRow($Data) ){
      	
      	$_SESSION['g_array'][$value['gender']]['icon'] = (isset($_SESSION['g_array'][$value['gender']]['icon'])) ? $_SESSION['g_array'][$value['gender']]['icon'] : '';
      ?>
      <li class="<?php if($i % 2){ ?>search_display_off<?php }else{ ?>search_display_on<?php } ?>"> <?=$_SESSION['g_array'][$value['gender']]['icon'] ?> <span><a href="../index.php?dll=profile&pId=<?=$value['id'] ?>" target="_blank"><b><?=$value['username'] ?></b></a> <?=ShowTimeSince($value['lastlogin']) ?> </span></li>
      <?php $i++; } ?>
      </ul>

    </td>
    <td>
      <ul class="res_set_li recently_login_list">
      <?php
      $i=1;
	    $Data = $DB->Query("SELECT members.username,  members.id,  members.created, members_data.gender FROM members, members_data WHERE members.id = members_data.uid  ORDER BY created DESC LIMIT 10"); 
	     
      ## loop data from query
    	$gender = '';
     	while( $value2 = $DB->NextRow($Data) ){
    		
    	  if($value2['gender'] != ''){
    	   $gender = $value2['gender'];
	      }
      ?>		
      <li class="<?php if($i % 2){ ?>search_display_off<?php }else{ ?>search_display_on<?php } ?>">
            <?php print $_SESSION['g_array'][$gender]['icon'] ?> <span><a href="../index.php?dll=profile&pId=<?=$value2['id'] ?>" target="_blank"><b><?=$value2['username'] ?></b></a> <?=ShowTimeSince($value2['created']) ?></span>
            </li>
            <?php $i++; } ?>
        </ul> </td>
        </tr>
    </table></td>
  </tr>
  <tr bgcolor="#cccccc">
    <td height="25"> <img src="inc/images/icons/resultset_next.png" width="16" height="16" align="absmiddle"> <a href="members.php">Search Members</a></td>
    <td height="25"><img src="inc/images/icons/resultset_next.png" width="16" height="16" align="absmiddle"> <a href="members.php?ustatus=unapprovedemail">View Unapproved Members</a> </td>
  </tr>
</table>

<? /*
<table style="width:100%"  border="0" cellspacing="5">
  <tr bgcolor="#666666">
    <td width="276" height="27" class="overview_title">Latest Website Referrals</td>
    <td width="300" height="27"  class="overview_title">Latest Article </td>
  </tr>
  <tr>
    <td height="35">
          <ul class="recently_login_list">
          <?php
          $i=1;
          $Data = $DB->Query("SELECT visitor_refferer, visitor_page FROM visitors_table WHERE visitor_refferer !='' ORDER BY ID DESC LIMIT 5"); 
	        ## loop data from query
 	        while( $value3 = $DB->NextRow($Data) ){
          ?>
            <li class="<?php if($i % 2){ ?>search_display_off<?php }else{ ?>search_display_on<?php } ?>">
              
              <span><a href="<?=$value3['visitor_page'] ?>" target="_blank"><?=substr($value3['visitor_page'],0,40) ?>..</a></span>
            </li>
            <?php $i++; } ?>
          </ul> 

    </td>
    <td class="p_text recently_login_list">

<?php
	//if ($rs = $rss->get('http://www.advandate.biz/rss.php?type=news')) {
	if ($rs = $rss->get('http://www.advandate.biz/inc/rss.php?type=news')) {
		$count=1;
		foreach($rs['items'] as $item) {
		if($count <2){
			echo "<p><b>".$item['title']."</b></p>";
			echo "<p>".$item['description']."...</p>";
			//print "<a href=\"$item[link]\" target=\"_blank\">Read Full Article </a>";
			print "<p></p>";
		}
		$count++;
		}
		
	}else {    echo "Error: It's not possible to reach RSS file...\n";} 
?></td>
  </tr>
  <tr bgcolor="#cccccc">
    <td height="25"><img src="inc/images/icons/resultset_next.png" width="16" height="16" align="absmiddle"> <a href="overview.php?p=visitor">View All Referrals</a> </td>
<?php //print_r($item); ?>
    
    <td height="25"><img src="inc/images/icons/resultset_next.png" width="16" height="16" align="absmiddle"> <a href="<?=(isset($item['link']))? $item['link'] : ''; ?>">View Full Article</a></td>
  </tr>
</table> */?>

</div></ul>

<script type="text/javascript">
  
  function ShowHideStats(id){
    document.getElementById("tbl-members-graph").style.display = 'none';
    document.getElementById("tbl-box-visitors").style.display = 'none';
    document.getElementById("tbl-box-affiliated").style.display = 'none';
    document.getElementById(id).style.display = 'block';
  }
  window.onload = function(){
  setTimeout(ShowHideStats("tbl-members-graph"),2000);
  }
  var selector, elems, makeActive;
  selector = '.statistics-link-list li';

  elems = document.querySelectorAll(selector);

  makeActive = function () {
      for (var i = 0; i < elems.length; i++)
          elems[i].classList.remove('active');
      
      this.classList.add('active');
  };

  for (var i = 0; i < elems.length; i++)
      elems[i].addEventListener('click', makeActive);
</script>

<?php }
else if($_REQUEST['p'] == "mobileserver"){ ?>
  
  <?php

  $mobile = getMobileContent();

  ?>

  <form method="post" id="mobile-form" enctype="multipart/form-data" action="settings.php">
  <input type="hidden" name="do" value="mobileadmin" class="hidden">
  <input type="hidden" name="p" value="mobileadmin" class="hidden">

  <ul class="form">    
  <div class="box_body" style="width:40%;float:left;">

  <li><label>Mobile Splash Page: </label><input type="file" name="mobile_splash" class="input"/> &nbsp; 400px × 700px</li>
  <br/>
  <br/>

  <li><label>About Us Page: </label><textarea name="mobile_about_us" class="input" style="width:100%;min-height:100px;"><?php echo $mobile['page_contents'];?></textarea></li>
  <br/>
  <br/>
  
  <input type="button" id="mobile-form-btn" value="<?=$admin_button_val[8] ?>" class="MainBtn">  
   
   <div id="mobile-frm-status" style="margin-top:10px;"></div>

  </div>
  <div class="box_body" style="width:40%;float:left;">
    
  <li><div class="mobile-admin-img">
    <img src="<?php echo $mobile['mobile_image'];?>" id="mobile-img" style="min-width: 400px; width: 100%;"/>
  </div>
  </li>
  </ul> 
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
  
  $(document).ready(function(){

    $("#mobile-form-btn").click(function(){
      
      $("#mobile-frm-status").html("<img src='inc/images/loading.gif'/>");
      $.ajax({
          url: 'inc/ajax/ajax_mobile.php',
          type: 'POST',
          processData: false,
          contentType: false,
          data: new FormData($("#mobile-form")[0]),
          success: function(data)
          {
            
            
            $("#mobile-frm-status").empty();
            var obj = jQuery.parseJSON(data);
            if(obj.status == '1'){
              $("#mobile-img").attr('src',obj.file)
              $("#mobile-frm-status").html("<p style='color:green;font-size:12px;font-weight:bold;'>" + obj.success + "</p>");
            }
            else{
  
              $("#mobile-frm-status").html("<p style='color:red;font-size:12px;font-weight:bold;'>" + obj.err + "</p>");
            }
            // Success so call function to process the form
            //submitForm(event, data);
               
          },
          error: function(textStatus)
          { 
            $("#mobile-frm-status").empty();
              
            // Handle errors here
            console.log('ERRORS: ' + textStatus);
          
          }
      });
    });
  });
</script>

<?php 



 /* ?>
<a href="overview.php?p=mobileserver&q=dashboard"><b><u>Dashboard</u></b></a> - 
<a href="overview.php?p=mobileserver&q=userlisting"><b><u>User Listing</u></b></a> - 
<a href="overview.php?p=mobileserver&q=profilequestion"><b><u>Profile Questioning</u></b></a>
<p>&nbsp;</p>
<?php //include("graph/gra.php");?>
 <?php if(!isset($_REQUEST['q']) || (isset($_REQUEST['q']) && $_REQUEST['q'] == "dashboard")){
	 include("graph/gra.php");
	 ?>
 <?php }?>
 <?php if($_REQUEST['q'] == "userlisting"){?>
 <?php if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete'){
		$DB->Query("DELETE FROM t_entity_details WHERE Entity_Id = '$_REQUEST[Entity_Id]' LIMIT 1");
	 
 }?>
<div id="eMeetingTableWrapper">
	<table id="eMeetingTable">
		<thead>
			<tr>
				<th class="sortfirstdesc"></th>
				<th>Id</th>
				<th>Name</th>
				<th>Date Of Birth</th>
				<th>Email</th>
				<th>Facebook ID</th>
				<th>Delete</th>
			</tr>
		</thead>
			<tbody>
            <?php
			$page = (int) $_GET['page'];
			if ($page < 1) $page = 1;
			$resultsPerPage = 5;
			$startResults = ($page - 1) * $resultsPerPage;
			$numberOfRows = mysql_num_rows(mysql_query("SELECT * FROM t_entity_details"));
			$totalPages = ceil($numberOfRows / $resultsPerPage);
$i=1;
	$Data = $DB->Query("SELECT * FROM t_entity_details ORDER BY Entity_Id DESC LIMIT $startResults, $resultsPerPage"); 
	## loop data from query
 	while( $value3 = $DB->NextRow($Data) ){
?>
            <tr>
				<td><input type="checkbox" /></td>
				<td><?=$value3['Entity_Id'] ?></td>
				<td><?=$value3['First_Name']." ".$value3['Last_Name'] ?></td>
				<td><?=$value3['DOB'] ?></td>
				<td><?php if($value3['Email']) echo $value3['Email']; else echo 'Not Available'; ?></td>
				<td><?=$value3['Fb_Id'] ?></td>
				<td align="center"><a class="custom-button" href="overview.php?p=mobileserver&q=userlisting&Entity_Id=<?=$value3['Entity_Id'] ?>&action=delete">Delete</a></td>
			</tr>
            <?php $i++; } ?>
			</tbody>
	</table>
	<div align="center"><div class="pagination">
		<?php 

if($page > 1)
	echo '<a href="overview.php?p=mobileserver&q=userlisting&page='.($page - 1).'">Prev</a>&nbsp';

for($i = 1; $i <= $totalPages; $i++)
{
	if($i == $page)
		echo '<span class="current">'.$i.'</span>&nbsp';
	else
		echo '<a href="overview.php?p=mobileserver&q=userlisting&page='.$i.'">'.$i.'</a>&nbsp';
}

if ($page < $totalPages)
	echo '<a href="overview.php?p=mobileserver&q=userlisting&page='.($page + 1).'">Next</a>&nbsp;';

?></div></div>
 </div>
 <?php }?>
 <?php if($_REQUEST['q'] == "profilequestion"){?>
  <?php if(isset($_REQUEST['update']) && $_REQUEST['update'] == 'ques'){
		$DB->Query("UPDATE t_details SET details_ques ='$_REQUEST[details_ques]' WHERE d_id = '$_REQUEST[Entity_Id]' LIMIT 1");
		@header("Location: overview.php?p=$_REQUEST[p]&q=$_REQUEST[q]");
	 
 }?>
 <?php if(isset($_REQUEST['update']) && $_REQUEST['update'] == 'addQues'){
		$DB->Query("INSERT INTO t_details SET details_ques ='$_REQUEST[details_ques]'");
		@header("Location: overview.php?p=$_REQUEST[p]&q=$_REQUEST[q]");
	 
 }?>
  <?php if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete'){
		$DB->Query("DELETE FROM t_details WHERE d_id = '$_REQUEST[Entity_Id]' LIMIT 1");
	 
 }?>
 <div id="eMeetingTableWrapper">
	<table id="eMeetingTable">
		<thead>
			<!--<tr><th colspan="3" align="right"><a href="overview.php?p=mobileserver&q=profilequestion&action=addQues">Add Question</a></th></td></tr>-->
			<tr>
				<th width="5%">NO.</th>
				<th width="65%">Question</th>
				<th width="30%">View/Delete</th>
			</tr>
		</thead>
			<tbody>
            <?php
$i=1;
	$Data = $DB->Query("SELECT * FROM t_details ORDER BY d_id DESC LIMIT 5"); 
	## loop data from query
 	while( $value3 = $DB->NextRow($Data) ){
?>
            <tr>
				<td><?=$i?></td>
				<td><?=$value3['details_ques']?></td>
				<td align="center">
					<a href="overview.php?p=mobileserver&q=profilequestion&Entity_Id=<?=$value3['d_id'] ?>&action=delete" class="custom-button">Delete</a>
					<a href="overview.php?p=mobileserver&q=profilequestion&Entity_Id=<?=$value3['d_id'] ?>&action=edit" class="custom-button-edit">Edit</a>
					<a href="overview.php?p=mobileserver&q=profilequestion&Entity_Id=<?=$value3['d_id'] ?>&action=answer" class="custom-button-answer">Answer</a>
				</td>
			</tr>
            <?php $i++; } ?>
			</tbody>
	</table>
	<?php if(isset($_REQUEST['action']) &&  $_REQUEST['action'] == 'edit'){
			$Data = $DB->Row("SELECT * FROM t_details WHERE d_id = '$_REQUEST[Entity_Id]'  LIMIT 1");
	?>
	<form action="" name="update_ques" method="post">
		<input type="hidden" name="p" value="<?=$_REQUEST['p']?>" />
		<input type="hidden" name="q" value="<?=$_REQUEST['q']?>" />
		<input type="hidden" name="Entity_Id" value="<?=$_REQUEST['Entity_Id']?>" />
		<?php if($_REQUEST['action'] == 'addQues'){?>
			<input type="hidden" name="update" value="addQues" />
		<?php }else{?>
			<input type="hidden" name="update" value="ques" />
		<?php }?>
	<table id="eMeetingTable">
		<thead>
			<tr>
				<th colspan="3" align="left"><?php if($_REQUEST['action'] == 'addQues'){?>Add<?php }else{?>Update<?php }?> Question Title</th>
			</tr>
		</thead>
		<tbody>
		<tr>
			<td>Question</td>
			<td><input type="text" name="details_ques" value="<?=$Data['details_ques']?>" /></td>
			<td align="center">
				<input type="submit" name="submit" value="SUBMIT" class="ques_update" />
			</td>
		</tr>
		</tbody>
	</table>
	</form>
	<?php }?>
	<?php if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'answer'){?>
 
 <?php if(isset($_REQUEST['update']) && $_REQUEST['update'] == 'answer'){
		$DB->Query("UPDATE t_details_ans SET detail_option ='$_REQUEST[detail_option]' WHERE id = '$_REQUEST[Answer_Id]' LIMIT 1");
		@header("Location: overview.php?p=$_REQUEST[p]&q=$_REQUEST[q]&Entity_Id=$_REQUEST[Entity_Id]&action=answer");
	 
 }?>
  <?php if(isset($_REQUEST['action_answer']) && $_REQUEST['action_answer'] == 'delete'){
		$DB->Query("DELETE FROM t_details_ans WHERE id = '$_REQUEST[Answer_Id]' LIMIT 1");
	 
 }?>
<?php $Data = $DB->Row("SELECT * FROM t_details WHERE d_id = '$_REQUEST[Entity_Id]'  LIMIT 1");?> 
	<p>&nbsp;</p>
		<table id="eMeetingTable">
			<thead>
				<tr><th colspan="4" align="left"><?php echo $Data['details_ques'];?></th></td></tr>
				<tr>
					<th width="5%">NO.</th>
					<th width="10%">Question Id</th>
					<th width="60%">Answer</th>
					<th width="25%">View/Delete</th>
				</tr>
			</thead>
				<tbody>
				<?php
	$i=1;
		$Data = $DB->Query("SELECT * FROM t_details_ans WHERE d_id = $_REQUEST[Entity_Id] ORDER BY id DESC LIMIT 5"); 
		## loop data from query
		while( $value3 = $DB->NextRow($Data) ){
	?>
				<tr>
					<td><?=$value3['id']?></td>
					<td><?=$value3['d_id']?></td>
					<td><?=$value3['detail_option']?></td>
					<td align="center">
						<a href="overview.php?p=mobileserver&q=profilequestion&Entity_Id=<?=$value3['d_id'] ?>&Answer_Id=<?=$value3['id'] ?>&action_answer=delete&action=answer" class="custom-button">Delete</a>
						<a href="overview.php?p=mobileserver&q=profilequestion&Entity_Id=<?=$value3['d_id'] ?>&Answer_Id=<?=$value3['id'] ?>&action_answer=edit&action=answer" class="custom-button-edit">Edit</a>
						<!--<a href="overview.php?p=mobileserver&q=profilequestion&Entity_Id=<?=$value3['d_id'] ?>&action=answer"><img src="inc/images/icons/edit.gif" align="absmiddle"></a>-->
					</td>
				</tr>
				<?php $i++; } ?>
				</tbody>
		</table>	
	<?php if(isset($_REQUEST['action_answer']) && $_REQUEST['action_answer'] == 'edit'){
			$Data = $DB->Row("SELECT * FROM t_details_ans WHERE id = '$_REQUEST[Answer_Id]'  LIMIT 1");
	?>
	<form action="" name="update_ques" method="post">
		<input type="hidden" name="p" value="<?=$_REQUEST['p']?>" />
		<input type="hidden" name="q" value="<?=$_REQUEST['q']?>" />
		<input type="hidden" name="Entity_Id" value="<?=$_REQUEST['Entity_Id']?>" />
		<input type="hidden" name="Answer_Id" value="<?=$_REQUEST['Answer_Id']?>" />
		<input type="hidden" name="update" value="answer" />

	<table id="eMeetingTable">
		<thead>
			<tr>
				<th colspan="3" align="left">Update Answer Title</th>
			</tr>
		</thead>
		<tbody>
		<tr>
			<td>Answer</td>
			<td><input type="text" name="detail_option" value="<?=$Data['detail_option']?>" /></td>
			<td align="center">
				<input type="submit" name="submit" value="SUBMIT" class="answer_update" />
			</td>
		</tr>
		</tbody>
	</table>
	</form>
	<?php }?>		
	<?php }?>
 </div>
 <?php }?>
<?php */}elseif($_REQUEST['p'] == "adminmsg"){ ?>


<?php $msgData = DisplayAdminMsg(); ?>
<form method="post" action="overview.php" name="form1">
<input name="do" type="hidden" value="msg" class="hidden">
<input name="page" type="hidden" value="adminmsg" class="hidden">

 
	<ul class="form"><div class="box_body"> 
	<li><label>Title: </label>
<div class="tip">Enter a title or introduction paragraph here.</div>
<input name="subject" type="text" size="40" class="input" value="<?=$msgData['title'] ?>"></li>
	<li><?php if(!isset($msgData)){ $msgData['content']=""; } print displayTextArea($msgData['content']); ?></li>
<li><input type="submit" name="Submit2" value="<?=$admin_button_val[8] ?>" class="MainBtn"></li> 
</div></ul><ul class="form"><div class="box_body"> 
	<li><label>Hide Box: </label>
<div class="tip">Select yes if you wish to stop the popup welcome message from appearing.</div>
<select name="hidebox" class="input" style="width:100px;"><option value="yes" <?php if($msgData['display']=="yes"){ print "selected";} ?>><?=$admin_selection[2] ?></option><option value="no" <?php if($msgData['display']=="no"){ print "selected";} ?>><?=$admin_selection[1] ?></option></select></li>
	<li><input type="submit" name="Submit2" value="<?=$admin_button_val[8] ?>" class="MainBtn"></li>      
	
	</div></ul>
</form>

<?php }elseif($_REQUEST['p'] == "visitor"){ ?>

<ul class="form"><div class="box_body">
<li><label><?=$admin_overview[6] ?></label></li>
<SCRIPT type="text/javascript" src="inc/js/_flash.js"></SCRIPT>
 
<div class="box_body" id="box-visitors">
<?php include("graph/members_visitor.php"); ?>
<?php/*<SCRIPT language="JavaScript">
	displayeMeeting("inc/charts/chart.swf?xml_file=inc/charts/data.php?d1=<?=GetVisitorGraphData() ?>","100%","300",{menu:"false",bgcolor:"#ffffff",version:"6,0,47,0",align:"middle",wmode:"transparent"});
</SCRIPT>*/?>
</div></ul>


<ul class="form"><div class="box_body">
<li><label>Last 50 Visitor References</label></li>
<table class="widefat">
     <thead>
      <tr> 

         <th>IP</th>
          <th>Reference</th>
<th></th>
        </tr>
      </thead>
      <tbody>
<?php
	$result = $DB->Query("SELECT * FROM visitors_table WHERE visitor_refferer !='' ORDER BY `visitor_date` DESC LIMIT 50");

    while( $Data = $DB->NextRow($result) )
    {

?>
         <tr>
		<td><?=$Data['visitor_ip'] ?></td>
		<td><?=substr($Data['visitor_page'],0,40) ?>..</td>
		<td><a href="<?=$Data['visitor_refferer'] ?>" target="_blank">View Website</a></td>
		</tr>
<?php } ?>
     </tbody>
</table>
</div></ul>




<?php }elseif($_REQUEST['p'] == "members"){ ?>

<ul class="form"><div class="box_body">
<li><label><?=$admin_overview[7] ?></label></li>
<?php include("graph/members_graph.php"); ?>
<?php /*
<SCRIPT type="text/javascript" src="inc/js/_flash.js"></SCRIPT>
 
<SCRIPT language="JavaScript">
	displayeMeeting("inc/charts/chart.swf?xml_file=inc/charts/data.php?d1=<?=GetMemberGraphData() ?>","100%","300",{menu:"false",bgcolor:"#ffffff",version:"6,0,47,0",align:"middle", zindex:"0",wmode:"transparent"});
</SCRIPT>
*/?>
</div>	</ul>




<?php }elseif($_REQUEST['p'] == "affiliate"){ ?>

<ul class="form"><div class="box_body"> 

<SCRIPT type="text/javascript" src="inc/js/_flash.js"></SCRIPT>
<div class="box_title"><?=$admin_overview[10] ?></div>
<div class="box_body" id="box-affiliated">
<?php include("graph/members_affiliate.php"); ?>
<?php/*<SCRIPT language="JavaScript">
	displayeMeeting("inc/charts/chart.swf?xml_file=inc/charts/data.php?d1=<?=GetAffiliateGraphData() ?>","100%","300",{menu:"false",bgcolor:"#ffffff",version:"6,0,47,0",align:"middle",wmode:"transparent"});
</SCRIPT>*/ ?>

</div>	

</div>	</ul>




<?php }elseif($_REQUEST['p'] == "maps"){ ?>
		<style>
			#mapThis table {
				width : 221px;
			}
			#mapThis table td {
				vertical-align : top;
				padding : 0px 5px;
			}
			.gm-style-iw div{
				overflow : hidden !important;
			}
		</style>
		<?php if(GOOGLE_MAPS_KEY ==""){ ?>		
		<form method="post" action="">
		<input name="do" type="hidden" value="update" class="hidden">
		<input name="p" type="hidden" value="maps" class="hidden">
		<ul class="form"><div class="box_body">
		<li><label>Google API Key:</label><input name="google_key" type="text" class="input" value="<?=GOOGLE_MAPS_KEY ?>"size="40"><div class="tip"><?=$admin_overview[12] ?></div></li>
		<li><input type="submit" value="Update Settings" class="MainBtn"></li> 
		</div></ul>
		</form>
<?php }elseif($_REQUEST['p'] == "mobileserver"){ ?>

<a>Dashboard</a> - 	<a>Dashboard</a> - <a>Dashboard</a>
			  
		<?php }else{ ?>  
		<link rel="stylesheet" type="text/css" media="all" href="inc/css/google_maps.css">
		
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
		
		handleResize();
		
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
		function myclick(i) { gmarkers[i].openInfoWindowHtml(htmls[i]);	}
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
		
		
		<div id="toolbar">		
		  <h1><?=$admin_overview[14] ?></h1>  
		  <form action="" method="post">
		  <input name="do" type="hidden" value="search" class="hidden">
		  <input name="p" type="hidden" value="maps" class="hidden">
		  <ul id="options">                	
			<li><select name="sgender" style="width:120px;"> <option value="0"><?=$admin_search_val[3] ?></option><?=DisplayGenders(); ?> </select></li>
			<li><select name="spackage" style="width:120px;"> <option value="0"><?=$admin_search_val[2] ?></option><?=DisplayPackages(); ?></select></li>
			<li><select name="sstatus" style="width:120px;">
				  <option value="0"><?=$admin_search_val[7] ?></option>
				  <option value="active"><?=$admin_search_val[8] ?></option>
				  <option value="suspended"><?=$admin_search_val[9] ?></option>
				  <option value="unapproved"><?=$admin_search_val[10] ?></option>
				  <option value="cancel"><?=$admin_search_val[11] ?></option>
				</select></li>
			<li><select name="sjoin"  style="width:110px;">
				  <option value="0">Anytime</option>
				  <option value="1">Joined Today</option>
				  <option value="2">This Week</option>
				  <option value="3">This Month</option>
				  <option value="4">This year</option>
				</select></li>
			<li><input name="susername" type="text" value="<?=$admin_table_val['1'] ?>" style="width:100px;" onfocus="this.value='';"><input type="hidden" name="u_value" value="<?=$admin_table_val['1'] ?>"></li>
			<li><input type="submit" value="<?=$admin_button_val[0] ?>"></li>
		  </ul>
		  </form>
		</div>	
		
		<div id="content1">		
		  <div id="map-wrapper">			
			  <div id="mapThis"></div>
		  </div>
		  <div id="sidebar1" style="display:none;">			
			  <ul id="sidebar-list" style="display:block;">			
			  </ul>
		  </div>
		</div>
		<br class="clear">
		
		
		<?php } ?>

<?php } ?>