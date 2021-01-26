<?php

if(isset($_GET['edit_id']) && $_GET['edit_id'] != ""){

		if(isset($_POST['do']) && $_POST['do'] == 'textedit'){

			$result = WLDUpdateSiteText($_POST);
			
			if($result){
		      	echo '<div id="messages" class="wld-success-message">Text has been approved successfully.</div>';
		  	}
		}

		$data = array();
		$data = $DB->Row("SELECT * FROM `wld_home_page_text` WHERE site_id = '".$_GET['edit_id']."'");   

		/*while($row = $DB->NextRow($result)){
			$data[$row['field_name']] = $row['field_value'];
		}*/
		?>

		<p id="TopCommentsBox"  style="width: 100%;float: left;margin-top: 20px;"><img src="inc/images/icons/help.png" align="absmiddle">  Some templates have text boxes on the front page. The fields below allow you to change that welcome text. Some templates use different sets of wording pairs.</p>

		<form action="" method="post">
			<input name="do" type="hidden" value="textedit" class="hidden">
			<input name="site_id" type="hidden" value="<?=$data['site_id']?>" class="hidden">
		<ul class="form">
			<div class="box_body">
		
				<li>
					<label>Welcome Title</label>
					<input name="txt1" type="text" value="<?=$data['welcome_title']?>" size="75" class="input">
				</li>
				<li>
					<label>Welcome Subtitle</label>
					<input name="txt2" type="text" value="<?=$data['welcome_subtitle']?>" size="75" class="input">
				</li>
			</div>
		</ul>

		<ul class="form">
			<div class="box_body">
				<li>
					<label>Introduction Title</label>
					<input name="txt3" type="text" value="<?=$data['intro_title']?>" size="75" class="input">
				</li>
				<li>
					<label>Introduction Subtitle</label>
		  			<textarea name="txt4" cols="75" class="input" style="width:550px; height:100px;"><?=$data['intro_subtitle']?></textarea>
				</li>

			</div>
		</ul>

		<ul class="form">
			<div class="box_body">
				<li>
					<label>Introduction Title Extra</label>
					<input name="txt5" type="text" value="<?=$data['intro_title_extra']?>" size="75" class="input">
				</li>
				<li>
					<label>Introduction Subtitle Extra</label>
				  	<textarea name="txt6" cols="75" class="input" style="width:550px; height:100px;"><?=$data['intro_subtitle_extra']?></textarea>
				</li>

			</div>
		</ul>


		<input name="Submit" type="submit" value="Save Changes" class="MainBtn"> 

	</form>

	<br><br><br>

	<div class="bar_save">
		<form action="" method="post">
			<input type="hidden" name="do" value="reset" class="hidden">
			<input name="p" type="hidden" value="text" class="hidden">
			<b>Reset Fields</b><br>
			<p>If you have problems editing these fields click this button to reset them back to the software defaults.</p>
				<input name="Submit" type="button" value="Reset All Fields" class="MainBtn"> 
		</form>
	</div>
<?php
}
else{
?>
<div class="page">
	<div class="heading">
		<h2>Text</h2>
	</div>
	<div class="content">
		<div class="block">	
			<?php echo getMarketSiteHtml("approve_edit_text"); ?>
		</div>
		<div id="TopCommentsMainBox">
			<div id="contentwrapper">
				<div id="contentcolumn" class="contentcolumndash">
					<div id="TableViewer"></div>
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