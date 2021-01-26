

<div class="clear"></div>
  
</div>
  <!-- Modal -->
<?php if($page != 'index'){
    
    echo include_script_files(); 
    
    } ?>

<script>
jQuery('.bxslider').bxSlider({
  auto: true,
  autoControls: true,
  captions: true
});
</script>
<script>
jQuery('.bxslider2').bxSlider({
  auto: true,
  autoControls: true,
  captions: true
});
</script>
<!-- Invitation Part Start -->


<!-- Invitation Part Start -->

<?php 
## SIdebar Users Online
funcDisplaySidebarOnline();

## Display Footer Area
funcLayoutUserFooter($FOOTER_MENU_BAR,$FOOTER_MENU_TIMER,$BANNER_ARRAY);
?>

</div>

<!-- END PAGE MAIN BACKGROUND -->

</div> <!-- End of wide_wrapper -->




<script language="javascript" type="text/javascript">
  var jQuery = jQuery.noConflict();
  jQuery('form[name="cssform"]').prepend('<div class="loding_img" ><img src="/inc/templates/<?=D_TEMP?>/images/flightloader.gif"></div>');
  jQuery('iframe#PreviewFrame').hide();
jQuery(window).load(function() {
  
  jQuery('iframe#PreviewFrame').contents().find('#fullpage').addClass('iframe_cont_body'); 
  jQuery('iframe#PreviewFrame').contents().find('.collapsable.list').addClass('closed');
  jQuery('iframe#PreviewFrame').contents().find('.i-count.chats.chat-hide').addClass('chat-show');
  jQuery('iframe#PreviewFrame').contents().find('.value.minimize').addClass('disabled');
  jQuery('iframe#PreviewFrame').contents().find('.value.maximize').removeClass('disabled');
  jQuery('iframe#PreviewFrame').css('height','650px');
  jQuery(".loding_img").fadeOut();
  jQuery('iframe#PreviewFrame').fadeIn(10);
});
</script>

</body>


</html>