<? if (!isset($loginSet) && ( !isset($_SESSION['admin_auth'])  || $_SESSION['admin_auth'] != "yes" ) )  {	die( 'Restricted access' ); } 


include("functions.php");
?>

<script src="../plugins/plugins/plugin_admin_approve/ApproveList.js" type="text/javascript"></script>
<style type="text/css">
	#admin-profile-view{
		float: left;
	    width: 96%;
    	position: fixed;
	    top: 2%;
    	z-index: 10000;
	    left: 2%;
    	right: 2%;
	    bottom: 2%;
    	padding: 10px;
	    background: #ffffff;
	    box-shadow: 0px 0px 30px #000000;
	    border-radius: 3px;
    }
    #admin-profile-view iframe{
	    width: 100%;
	    height: 100%;
    }
    #admin-profile-view .admin-view-cancel{
    	position: absolute;
    	width: 50px;
	    right: 25px;
    }
</style>
<?

if(isset($_GET['sort'])){
	if($_GET['sort']==1){
	$SortThis=" AND members.created = members.updated";
	}else{
		$SortThis=" AND members.created != members.updated";
	}
}else{
$SortThis="";
}
?>
<p id='TopCommentsBox'><img src='inc/images/icons/help.png' align='absmiddle' /> You have members to accept or decline below. </p>

<p style="padding:5px; background:#cccccc; text-align:center; font-weight:bold;"><a href="overview.php?p=pluginApprove&sort=1">New Signups</a> - <a href="overview.php?p=pluginApprove&sort=2">Profile Updates</a></p>

<div id="ApproveListDisplay"></div>

<div style="display:none;" id="EmailThis">
<table width="100%"  border="0" style="background:red; padding:4px;"><tr><td style="color:white;">
<form action="" name="SearchForm" method="post" onSubmit="SendNotify(SearchForm.welcome_email.value, SearchForm.MID.value); return false;">
Give a reason? 
<input name="MID" value="" id="MID" type="hidden">
<select class="input" name="welcome_email"><option value="0">No Reason</option> <?=DisplayNS() ?></select> 
<input name="Go" type="submit"> 
</form>
</td></tr></table>
</div>
<br>
<?
$counter=1;
$SQL ="SELECT members.*, members_data_pending_approval.*, members_data_pending_approval.description AS tt, files.bigimage FROM members INNER JOIN members_data_pending_approval ON ( members.id = members_data_pending_approval.uid) LEFT JOIN files ON (files.uid = members.id ) GROUP BY members.id ORDER BY members.id"; 
//$SQL ="SELECT members.*, members_data_pending_approval.*, members_data_pending_approval.description AS tt, files.bigimage FROM members INNER JOIN members_data_pending_approval ON ( members.id = members_data_pending_approval.uid) LEFT JOIN files ON (files.uid = members.id ) WHERE members.active='unapproved' ".$SortThis." GROUP BY members.id ORDER BY members.id"; 

$result = $DB->Query($SQL);

while( $Data = $DB->NextRow($result) ){

$image = ReturnDeImage($Data,"medium");
?>


<div class="approva_container"  border="0" style="font-size:12px; border:1px dashed #cccccc; padding:4px;" id="table_<?=$counter ?>" bgcolor="<? if($counter %2){ print "#ffffff"; }else{  print "#eeeeee"; } ?>">
  <tr>
    <div class="left_div"><img src="<?=$image ?>" width="96" height="96"><br>
    <br>[ <a href="members.php?p=files&u=<?=$Data['username'] ?>" target="_blank">View Files</a> ] <br> <select onChange="updatethis(3,this.value,<?=$Data['uid'] ?>);"><?=DisplayPackageCheck($Data['packageid']); ?></select>
    </div>
	<?php 
		$value['gender'] = (isset($value['gender'])) ? $value['gender'] : 0 ;
	?>
    <div class="right_div"><p class="left_p"><b style="font-size:15px;"><?=(isset($Data['username'])) ? $Data['username'] : '' ?></b> / <?=(isset($_SESSION['g_array'][$value['gender']]['icon'])) ? $_SESSION['g_array'][$value['gender']]['icon'] : '' ?> <?=(isset($_SESSION['g_array'][$Data['gender']]['caption'])) ? $_SESSION['g_array'][$Data['gender']]['caption'] : '' ?> / <?=MakeAge($Data['age']) ?> / <?=MakeCountry($Data['country']) ?> </p>
    <p class="right_p">[<img src="../plugins/plugins/plugin_admin_approve/yes.png" width="16" height="16" align="absmiddle"> <a href="#" onClick="AcceptMember('table_<?=$counter ?>',<?=$Data['uid'] ?>);">accept</a> ] [ <img src="../plugins/plugins/plugin_admin_approve/no.png" width="16" height="16" align="absmiddle"> <a href="#" onClick="DeclineMember('table_<?=$counter ?>',<?=$Data['uid'] ?>)">decline</a> ] [<img src="../plugins/plugins/plugin_admin_approve/edit.png" width="16" height="16" align="absmiddle"><a href="members.php?p=mapprove&mid=<?=$Data['uid'] ?>" target="_blank"> edit</a>] [<img src="../plugins/plugins/plugin_admin_approve/view.png" width="16" height="16" align="absmiddle"><a href="javascript:void(0);" onclick="ShowHideProfileViewDiv('block','<?=$Data['username']?>');"> view</a>]</p>
    <div class="form_cont">
<form action="" method="post">
<p><b>Headline:</b><br> <input type="text" name="" value="<?=strip_tags($Data['headline']) ?>" style="font-size:13px;" onChange="updatethis(2,this.value,<?=$Data['uid'] ?>);"></p>

<p><b>Description:</b> <br><textarea style="font-size:13px;" onChange="updatethis(1,this.value,<?=$Data['uid'] ?>);"><?=strip_tags($Data['tt']) ?></textarea></p>

</form> 
</div>
    <p style="font-size:11px;">[<?=$Data['ip'] ?>] [<img src="../plugins/plugins/plugin_admin_approve/email.gif" width="16" height="16" align="absmiddle"> <a href="email.php?p=send&e=<?=$Data['email'] ?>"><?=$Data['email'] ?></a>] <? if( $Data['created'] == $Data['updated'] ){ ?> <img src="../plugins/plugins/plugin_admin_approve/flag_green.png" width="16" height="16" align="absmiddle"> (New Signup!) <? }else{ ?> <img src="../plugins/plugins/plugin_admin_approve/flag_blue.png" width="16" height="16" align="absmiddle"> (Profile Update)  <? } ?>
[ <a href="#" onClick="updatethis(4,'yes',<?=$Data['uid'] ?>);">Make Featured</a> ]
</p>

	</div>
</div>

<? $counter++; } ?>

<div id="admin-profile-view" style="display: none;">
	<img onclick="ShowHideProfileViewDiv('none');" class="admin-view-cancel" src="../plugins/plugins/plugin_admin_approve/cancel.png">
	<iframe id="profile-view-frame" src="<?=DB_DOMAIN?>adminuser/LukasT504"></iframe>
</div>

<script type="text/javascript">
	function ShowHideProfileViewDiv(status,username=""){
		document.getElementById("admin-profile-view").style.display = status;
		if(username != ""){
			document.getElementById("profile-view-frame").src = "<?=DB_DOMAIN?>adminuser/"+username;
		}
	}
</script>