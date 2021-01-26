<?php
if(isset($_GET['banner_id']) && $_GET['banner_id'] != ""){

if(isset($_POST['do']) && $_POST['do'] == 'updatebanner'){

	$return = WLDUpdateSiteBanner($_POST);

	if($return){
      	echo '<div id="messages" class="wld-success-message">Banners has been updated successfully.</div>';
  	}

}

$dbh = getMarketDBConnection($_GET['market_id']);

$id = $_GET['banner_id'];
			
if(!is_numeric($id)){ return; }
$result = $dbh->prepare("SELECT * FROM banners WHERE bid=".$id." LIMIT 1");
$result->execute();
$data = $result->fetch();

?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready( function(){

	$('#bannerForm').on('submit',function(e){

		//$('#code2').bind('input propertychange', function() {
		var code = $('#code2').val();
		$('#code').val(code);
		//console.log(code);
		//});
		$('#code2').val('');
	});
});
</script>
<div class="page">
	<div class="heading">
		<h2>Banners</h2>
	</div>
	<div class="content">	
	<form method="post" action="" name="form1" id="bannerForm" enctype="multipart/form-data">
		<input type="hidden" value="updatebanner" name="do" class="hidden">
		<input type="hidden" id="code" name="code" value="" class="hidden"/>
		<input type="hidden" name="market_id" value="<?=$_GET['market_id']?>"/>
		<input type="hidden" name="site_id" value="<?=$data['site_id']?>"/>

		<?php 
		if(isset($_REQUEST['id2'])){ ?>
		<input type="hidden" name="type" value="affiliate" class="hidden"><input type="hidden" name="eaid" value="<?=$_REQUEST['id2'] ?>" class="hidden">
		<?php $data = BannerAffItems($_REQUEST['id2']); 
		} ?>

		<?php
		if(isset($_REQUEST['banner_id'])){ ?>
		<input type="hidden" name="banner_id" value="<?=$_REQUEST['banner_id'] ?>" class="hidden">

		<?php
		}
		?>
        <br>

		<ul class="form">
			<div class="box_body">
	
			<?php if(!isset($_REQUEST['id2'])){ ?>
				<li>
					<label><?=$admin_advertising[5] ?></label>
					<select class="input" name="type" onchange="javascript:idShowHide(this.value); return false;">
						<option value="website"><?=$admin_advertising[6] ?></option>
						<option value="affiliate"><?=$admin_advertising[7] ?></option>
					</select>
				</li>
			<?php } ?>

				<li>
					<label><?=$admin_advertising[8] ?>:</label>
					<input class="input" name="name" type="text" value="<? if(isset($data['bName'])){if($data['bName'] !=""){echo $data['bName'];}} ?>" size="40" maxlength="255">
					<div class="tip">Enter a memoriable name for your new banner advert.</div>
				</li>
			
			</div>
		</ul> 

		<ul class="form">
			<div class="box_body">

				<span id="UpBanner" style="display:none;">
					<li>
						<label><?=$admin_advertising[9] ?>:</label>
						<input class="input" type="file" name="uploadFile">
					</li> 
					<div style="padding:5px; background:#eeeeee; border:1px solid #cccccc;">
						<img src="inc/images/icons/flag_green.png" align="absmiddle">
						<a href="#" onclick="idShowHide('UpBanner');idShowHide('UpCode')"><?=$admin_advertising[10] ?></a>
					</div><br>
				</span>

				<span id="UpCode" style="display:visible;">
					<li>
						<label><?=$admin_advertising[11] ?>:</label>
						<textarea class="input" name="code2" cols="25" rows="3" id="code2" style="height:200px; width:550px;"><? if(isset($data['code'])){if($data['code'] !=""){echo eMeetingOutput($data['code'],true); }}?></textarea>
						<div class="tip">Paste your HTML banner code into the box or select the upload button to upload a banner from your computer</div>
					</li>
					<div style="padding:5px; background:#eeeeee; border:1px solid #cccccc;">
						<img src="inc/images/icons/flag_green.png" align="absmiddle">
						<a href="#" onclick="idShowHide('UpBanner');idShowHide('UpCode')"><?=$admin_advertising[12] ?></a>
					</div><br>
				</span>            
	
				<li>
					<label><?=$admin_advertising[13] ?>:</label>
					<input class="input" name="link" type="text" value="<? if(isset($data['urllocation'])){if($data['urllocation']!=""){echo $data['urllocation'];}} ?>" size="40" maxlength="255">
					<div class="tip"><?=$admin_advertising[23] ?></div>
				</li>

				<?php
				if(!isset($_REQUEST['id2'])){ ?>

			</div>
		</ul>
		<ul class="form"><div class="box_body">

			<li>
				<label>Position:</label>
				<select name="bannerpos" class="input">
					<option value="top" <?php if(isset($data['position'])){ if($data['position'] =="top"){print "selected";} } ?>>Top</option>
					<option value="middle" <?php if(isset($data['position'])){ if($data['position'] =="middle"){print "selected";} } ?>>Middle</option>
					<option value="left" <?php if(isset($data['position'])){ if($data['position'] =="left"){print "selected";} } ?>>Left</option>
					<option value="bottom" <?php if(isset($data['position'])){ if($data['position'] =="bottom"){print "selected";} } ?>>Bottom</option>
				</select>
			</li>

			<div id="affiliate" style="display:visible">
				<li>
					<label><?=$admin_advertising[14] ?>:</label>
					<select name="showto" class="input">
						<option value="0" <?php if(isset($data['clicks'])) {if($data['clicks'] ==0){ print "selected"; }} ?>><?=$admin_advertising[15] ?></option>
						<option value="1" <?php if(isset($data['clicks'])) { if($data['clicks'] ==1){ print "selected"; }} ?>><?=$admin_advertising[16] ?></option>
						<?
						$result = $DB->Query("SELECT fvid, fvCaption, fvOrder, lang FROM field_list_value WHERE fvFid =28 ORDER BY fvOrder ASC");
						while( $list = $DB->NextRow($result) ){	?>
						<option value="<?=$list['fvid'] ?>"  <?php if(isset($data['clicks'])) { if($data['clicks'] ==$list['fvid']){ print "selected"; }} ?>><?=$list['fvCaption']?> Only</option><?php } ?>
					</select>
				</li>
				<li>
					<label><?=$admin_advertising[17] ?> </label>
					<select class="input" name="page">
						<option value="all"><?=$admin_search_val[12] ?></option><option value="index.php">Index / Home Page</option><? $mypage=$data['page']; ?><?=WLDDisplayBannerPages($mypage)?>
					</select>
				</li>
				<li>
					<label><?=$admin_advertising[18] ?>:</label>
					<select class="input" name="active">
						<option value="no" <?php if(isset($data['active']) && $data['active'] =="no"){print "selected"; } ?> >No</option>
						<option value="yes" <?php if(isset($data['active']) && $data['active'] =="yes"){print "selected"; } ?> >Yes</option>
					</select>
				</li>
				<li>
					<label>Approved:</label>
					<select class="input" name="approved">
						<option value="no" <?php if(isset($data['active']) && $data['active'] =="no"){print "selected"; } ?> >No</option>
						<option value="yes" <?php if(isset($data['active']) && $data['active'] =="yes"){print "selected"; } ?> >Yes</option>
					</select>
				</li>
			<?php } ?>
	    
				<li><input value="<?=$admin_button_val[8] ?>" type="submit" class="MainBtn"></li> 
			</div>
			</div>
		</ul>

	</form>

	</div>
</div>
<?php
}
else{
?>
<style type="text/css">
	.market_summary{ padding: 4% 10%; float: left; width: 50%; }
	.market_summary li{ padding: 10px; float: left; clear: both; width: 100%; }
	.market_summary li.header{ font-weight: bold; border-bottom: 2px solid #000000;	}
	.market_summary li span{ float: left; width: 50%; }
</style>
<div class="page">
	<div class="heading">
		<h2>Banners</h2>
	</div>
	<div class="content">
		<div class="block">	
			<?php echo getMarketSiteHtml("approve_edit_banners"); ?>

			<?php $markets = getMarkets();

			?>
		</div>
		<div id="TopCommentsMainBox">
			<div id="contentwrapper">
				<div id="contentcolumn" class="contentcolumndash">
					<div id="TableViewer">
						<div class="market_summary">
						<ul>
							<li class="header"><span class="num">Market Name</span><span>Unapproved Banners</span></li>
							<?php
							foreach ($markets as $id => $market) {
				
							$dbh = getMarketDBConnection($id);

							$result = $dbh->prepare("SELECT count(*) as banner FROM banners WHERE approved='no'");
							$result->execute();
							$data = $result->fetch();
							?>	
							<li><span class="num"><?=$market?></span><span><center><?=$data['banner']?></center></span></li>
							<?php
							}
							?>
							
						</ul>
						</div>

					</div>
 				</div>
 				<br class="clear">
			</div>
		</div>
 		<br class="clear">
		<!-- EMEETING CONTENT END -->
	</div>
</div>

<?php
}
?>