<?php 
	if(isset($_REQUEST['do']) && $_REQUEST['do'] == 'site_page_updated'){

		$result = WLDUpdateSitePage($_REQUEST);
		
		if($result){
	      	echo '<div id="messages" class="wld-success-message">Site page updated successfully.</div>';
      	}
	}

	$pageDetail = WLDGetSitePageDetails($_REQUEST['edit_id']); ?>

<div class="page">
	<div class="heading">
		<h2>Approve Edit Page</h2>
	</div>

	<div class="content">

		<div>

			<div id="TopCommentsMainBox">

				<div id="contentwrapper">

					<div id="contentcolumn" class="contentcolumndash">

						<script>
						function SaveEditChanges(){
						document.getElementById('editor_hidden').value=''+myCpWindow.getCode()+'';
						document.lang.submit();
						}
						</script>

						<form action="" method="post" name="lang">
							
							<input type="hidden" name="do" value="site_page_updated" class="hidden">

							<ul class="form">

								<div class="box_body">	 
									<li>
										<label>Page Name: </label>
										<input name="name" type="text" size="30" value="<?php echo $pageDetail['name']; ?>" maxlength="15" class="input">
							
										<div class="tip">This will be used in your page link so keep it short without spaces.</div>
									</li>
							 
									<?= displayTextArea($pageDetail['content']) ?>

									<br><br>
									<div class="bar_save">

										<input name="update" type="submit"  value="Save Page" class="MainBtn">&nbsp;&nbsp;<input name="update_status" type="button"  value="Approve" onClick="WLDUpdatePageStatus(this.value,'<?php echo $pageDetail['id']; ?>');" class="MainBtn">

										<div id="StatusPageUpdate"></div>
										<br class="clear">
									</div>

								</div>
							</ul>
						
						</form>

					</div>

					<br class="clear">

				</div>

			</div>
 
			<br class="clear">
 
		<!-- EMEETING CONTENT END -->

		</div>
	
	</div>
</div>