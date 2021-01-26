<?php

if(isset($_GET['edit_id']) && $_GET['edit_id'] != "" && $_GET['edit_id'] != "0"){

if(isset($_POST['do']) && $_POST['do'] == 'metaedit'){

	$result = WLDUpdateSteMetaTags($_POST);
	
	if($result){
      	echo '<div id="messages" class="wld-success-message">Metatags has been approved successfully.</div>';
  	}
}
?>


<div class="page">
	<div class="heading">
		<h2>Metatags</h2>
	</div>
	<div class="content">
		
		<?php
		$data = array();
		$data = $DB->Row("SELECT * FROM `wld_metatags` WHERE site_id = '".$_GET['edit_id']."'");   

		/*while($row = $DB->NextRow($result)){
			$data[$row['field_name']] = $row['field_value'];
		}*/
		?>
 
		<form method="post" action="" name="form1">		
	        <input name="do" type="hidden" value="metaedit" class="hidden">
			<input name="change" id="change" type="hidden" value="single" class="hidden">
			<input name="market_id" type="hidden" value="<?=$_GET['market_id']?>" class="hidden">
			<input name="site_id" type="hidden" value="<?=$_GET['site_id']?>" class="hidden">
 			<p id="TopCommentsBox"><img src="inc/images/icons/help.png" align="absmiddle">  Our software has a sophisticated meta tag creation system built into the software saving you time and money creating thousands of page descriptions yourself. The software will automatically generate title, description and keyword meta tags based on the content displayed on the page.</p>
			<ul class="form">
				<div class="box_body">		
			        <li>
			        <label>Custom Title Prefix: </label>
			        <input name="m1" type="text" value="<?=$data['custom_title_prefix'] ?>" class="input" style="width:470px;">
					<div class="tip">The title prefix will allow you to add your own text to the beginning of all title meta tags on your website. A sample prefix would be something like " My Website -"</div>
					</li>

			        <li>
			        <label>Description Prefix: </label>
			        <textarea class="input" name="m2" style="width:470px; height:60px;"><?=$data['description_prefix'] ?></textarea>
					<div class="tip">The description prefix will allow you to add your own text to the beginning of all description meta tags on your website. A sample prefix would be something like " Welcome to my website, "</div>
					</li>
			       	<li>
			       	<label>Keyword Prefix: </label>
			       	<textarea class="input" name="m3" style="width:470px; height:60px;"><?=$data['keyword_prefix'] ?></textarea>
					<div class="tip">The title prefix will allow you to add your own text to the beginning of all keyword meta tags on your website. A sample prefix would be something like " my, website, "</div>
					</li>
					
					<li><input type="submit" name="Submit" value="<?=$admin_button_val[8] ?>" class="MainBtn"></li>        
				</div>
			</ul>

			<p id="TopCommentsBox" style="float: left;">
				<img align="absmiddle" src="inc/images/icons/help.png"/>
				The home page is often the page many like to customize themselves and as content is not always generated by the system you can enter your own meta tags below.
			</p>

			<ul class="form"><div class="box_body">		
        		<li>
    			<label>Page Title: </label>
    			<input name="h1" type="text" value="<?=$data['page_title'] ?>" class="input" style="width:470px;">
				</li>
        		<li>
    			<label><?=$admin_design[6] ?>: </label>
				<textarea class="input" name="h2" style="width:470px; height:60px;"><?=$data['description'] ?></textarea>
				</li>
		       	<li>
	       		<label><?=$admin_design[7] ?>: </label>
	       		<textarea class="input" name="h3" style="width:470px; height:60px;"><?=$data['keywords'] ?></textarea>
	       		</li>
		
				<li>
				<input type="submit" name="Submit" value="<?=$admin_button_val[8] ?>" class="MainBtn">
				</li>        
			</div></ul>
      	</form>

	
 		<br class="clear">
		<!-- EMEETING CONTENT END -->
	</div>
</div>
<?php
}
else{
?>


<div class="page">
	<div class="heading">
		<h2>Metatags</h2>
	</div>
	<div class="content">
		<div class="block">	
			<?php echo getMarketSiteHtml("approve_edit_metatags"); ?>
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