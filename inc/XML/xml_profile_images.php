<?php
	
if(D_TEMP == "v17red")
{
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<script type="text/javascript" src="inc/templates/v17red/bxslider2/jquery.bxslider.js"></script>
<script type="text/javascript" src="inc/templates/v17red/bxslider2/jquery.bxslider.min.js"></script>
 <link href="inc/templates/v17red/bxslider2/jquery.bxslider.css" rel="stylesheet" type="text/css" />
    <?
    if(isset($profileId) && is_numeric($profileId)){
       ?> <div class="bx-wrapper">
			<div class="bx-viewport">
			<?php
        require_once "inc/API/api_functions.php";
        $dd = DisplayRecentPhotos($profileId,8); 
        ?>
          <ul class="bxslider">
			<?php
            if(!empty($dd)){foreach($dd as $value){
            ?>  
                   <li> <img src="<?=DB_DOMAIN?>uploads/images/<?php echo $value['bigimage']; ?>" title="<?php echo htmlspecialchars($value['title']); ?> <br> <?php echo htmlspecialchars($value['description']); ?>"/></li>
               
            <?php
                
            } 
            ?>
       </ul>
		</div>
		</div>
        <?php
            
        }
    
        ## display a default image
        if(empty($dd)){
				print '<img src="'.DB_DOMAIN.'uploads/files/nophoto.jpg" title="No Photo Added">';
        }
      
    }
	?>
	<script>
jQuery('.bxslider').bxSlider({
  auto: true,
  autoControls: true,
  captions: true
});
</script>
<?php
}
else
{ 
	if(isset($_GET['uid']) && is_numeric($_GET['uid'])){
	require_once "../config.php";
	require_once "../API/api_functions.php";
	$dd = DisplayRecentPhotos($_GET['uid'],8); 
	header("Content-type: text/xml"); 
	print '<?xml version="1.0" encoding="utf-8"?>
	<content>';
	if(!empty($dd)){foreach($dd as $value){
 		
		if(file_exists("../../uploads/images/".htmlspecialchars($value['bigimage']))){
			print '<item>
				<title>'.htmlspecialchars($value['title']."..").'</title>
				<image_path>'.DB_DOMAIN."uploads/images/".htmlspecialchars($value['bigimage']).'</image_path>
				<target_url>'.htmlspecialchars(DB_DOMAIN.'index.php?dll=profile&sub=viewfile&item_id='.$_GET['uid'].'&item2_id='.$value['aid'].'&item3_id='.$value['id']).'</target_url>
				<description>'.htmlspecialchars($value['description']."..").'</description>
			</item>';
		}
		else{
			print '<item>
				<title>No Photo Added</title>
				<image_path>'.DB_DOMAIN."uploads/files/nophoto.jpg".'</image_path>
				<target_url>index.php</target_url>
				<description>.</description>
			</item>';
		}

		
	} }

	## display a default image
	if(empty($dd)){
			print '<item>
				<title>No Photo Added</title>
				<image_path>'.DB_DOMAIN."uploads/files/nophoto.jpg".'</image_path>
				<target_url>index.php</target_url>
				<description>.</description>
			</item>';
	}
	print '</content>';
}
	
}
?>
	