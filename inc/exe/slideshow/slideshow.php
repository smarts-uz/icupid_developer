<?

if(isset($_GET['id']) && is_numeric($_GET['id']) ){ 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>SlideShow</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<script type="text/javascript" src="../../templates/v17red/bxslider2/jquery.bxslider.js"></script>
<script type="text/javascript" src="../../templates/v17red/bxslider2/jquery.bxslider.min.js"></script>
<link href="../../templates/v17red/bxslider2/jquery.bxslider.css" rel="stylesheet" type="text/css" />
<style>
body .bx-wrapper {
    max-width: 300px !important;
}
body .bx-viewport {
    height: 300px !important;
}
body .bx-wrapper {
    margin: 0 auto;
}
</style>
</head>

<body style="margin:0px; padding:0px;">
    <?
    if(isset($_GET['id']) && is_numeric($_GET['id'])){
       ?> <div class="bx-wrapper">
			<div class="bx-viewport">
			<?php
			error_reporting(E_ERROR | E_PARSE);
		require_once "../../config.php";
        require_once "../../API/api_functions.php";
        $dd = DisplayRecentPhotos($_GET['id'],8); 
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
</body>
</html>
<? } ?>