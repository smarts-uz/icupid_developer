<?php 
$tdata = array(); 
ob_start(); ?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link rel="stylesheet" href="inc/css/install.css" type="text/css" />
	</head>
	<body>


	<div id="ctr" align="center">
		<div class="install">
			<div id="stepbar">
				<div class="<?php if($TabID==0){ ?>step-on<?php }else{ ?>step-off<?php } ?>">license key</div>
				<div class="<?php if($TabID==1){ ?>step-on<?php }else{ ?>step-off<?php } ?>">pre-installation check</div>
				
				<div class="<?php if($TabID==3){ ?>step-on<?php }else{ ?>step-off<?php } ?>">step 1</div>
				<div class="<?php if($TabID==4){ ?>step-on<?php }else{ ?>step-off<?php } ?>">step 2</div>
				<div class="<?php if($TabID==5){ ?>step-on<?php }else{ ?>step-off<?php } ?>">step 3</div>
				<div class="<?php if($TabID==6){ ?>step-on<?php }else{ ?>step-off<?php } ?>">Completed!</div>
			</div>

			<div id="right">
<?

$contents = ob_get_contents();
ob_end_clean();
$tdata[1]["contents"] = $contents;
$tdata[1]["name"] = "Page Header";
ob_start();
?>
</div>
					<div class="clr"></div>
				</div>


				<div class="clr"></div>
			</div>
			<div class="clr"></div>
		</div>
	</div>

	</body>
	</html>
<?
$contents = ob_get_contents();
ob_end_clean();
$tdata[2]["contents"] = $contents;
$tdata[2]["name"] = "Page Footer";
ob_start();
?>