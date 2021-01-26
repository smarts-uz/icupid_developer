 <style>
.modal.and.carousel {
  position: fixed;
  top:50px; 
}
.carousel-inner#cont_slide>.item>a>img, #cont_slide>.item>img{
    display: inline-block;
}
.item {
    text-align: center;
}
</style>
  <div class="modal fade and carousel slide" id="myModal" role="dialog" data-ride="carousel">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <div class="carousel-inner" id="cont_slide" role="listbox">
		<?
        if(isset($profileId) && is_numeric($profileId)){
        ?>
		<?php
        $dd = DisplayRecentPhotos($profileId,8);
        ?>
			<?php
            if(!empty($dd)){foreach($dd as $value){
				//echo'<pre>'; print_r($value); echo'</pre>';
            ?> 
            
            
                   <div class="item"> <img src="<?=DB_DOMAIN?>uploads/images/<?php echo $value['bigimage']; ?>" title="<?php echo htmlspecialchars($value['title']); ?> <br> <?php echo htmlspecialchars($value['description']); ?>"/><div class="carousel-caption"><h5><?php echo htmlspecialchars($value['title']); ?></h5></div></div>
               
            <?php
                
            } 
			 ## display a default image
			if(empty($dd)){
				print '<div class="item"><img src="'.DB_DOMAIN.'uploads/files/nophoto.jpg" title="No Photo Added"></div>';
        	}
             } ?>
	 <?php } ?>
          </div><!-- /.carousel-inner -->
          <a class="left carousel-control" href="#myModal" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
          </a>
          <a class="right carousel-control" href="#myModal" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
          </a>
        </div><!-- /.modal-body -->
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->