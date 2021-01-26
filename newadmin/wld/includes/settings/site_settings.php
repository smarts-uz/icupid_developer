<div class="page">
	<div class="heading">
		<h2>Settings</h2>
	</div>

	<div class="content">
		<div class="block">
			<div class="box">
				<div class="box-heading">
					<h2>Market Specific :</h2>
				</div>
				<div class="box-content">
					<div class="field choose-market">
						<label>Choose Market:</label>
						<span>
							
						<?php echo getMarketsHtml('site_settings'); ?>

						</span>
					</div>
					<div id="MarketSiteSettingViewer"></div>
				</div>
			</div>
			<div class="box">
				<div class="box-heading">
					<h2>Site Specific :</h2>
				</div>
				<div class="box-content">
					<div class="field choose-site">
						<label>Choose Site:</label>
						<span id="SelectSiteSettingHtml">
							<select>
								<option value="">Select Site</option>
							</select>
						</span>
					</div>
					<div id="SiteSettingViewer"></div>
					
				</div>
			</div>
		</div>


		<div class="block">	
		
			<?php //echo getMarketSiteHtml("settings_site"); ?>

		</div>

	</div>
</div>