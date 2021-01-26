<?
/**
* Page: RETURN PAGE AFTER A PAYMENT HAS BEEN PROCESSED
		THIS PAGE ONLY DISPLAYS THE THANK YOU MESSAGE, 
		NOT PROCESSING IS DONE HERE. PLUGINS DO ALL PROCESSING
*
* @version  9.0
* @created  Sat 25 Oct  2008
* @related  
*/
## block direct page access
defined( 'KEY_ID' ) or die( 'Restricted access' );

?>

<div id="main">         
    <div id="main_content_wrapper">     


    <? if(!isset($HEADER_SINGLE_COLUMN)){ ?><div class='conten_outer' style="padding:10px 20px;"> <? } ?>   
        
     <div class="clear"></div>

    <? if(isset($ERROR_MESSAGE) && strlen($ERROR_MESSAGE) > 3){ ?>
    <div id="messages">
          <div style="" class="message-<?=$ERROR_TYPE ?>" id="main-message-<?=$ERROR_TYPE ?>">
          <a class="dismiss-message" href="#" onclick="Effect.Fade('main-message-<?=$ERROR_TYPE ?>', { duration : 0.5 });; return false;"><img src="images/DEFAULT/_icons/16/menu.gif"></a>
          <?=$ERROR_MESSAGE ?>
        </div>
        <script type="text/javascript" language="javascript">Effect.Pulsate('main-message-<?=$ERROR_TYPE ?>', { pulses : 2, duration : 1, from : 0.7 });</script>
    </div>
    <? } ?>
<? if($show_page==""){ ?>

<? }
elseif($show_page=="requitix"){ ?>
<? foreach($BANNER_ARRAY as $banner){ if($banner['position'] =="middle"){?>
<div class="middle_banner"><? print $banner['display'];?></div><? }} ?>

<div class="inner_common_cont">
<?php /*
<style>
@import url(http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);

#dv1{ width: 61%; padding: 15px; margin: auto; float: right; }
#dv1 h4{ font-size: 1.5em; font-weight: bold; }
#dv1 h5{ font-size: 1.2em; font-weight: bold; }
.trans_id{ cursor: pointer; float: left; width: 60%; }
.error{ display: none; }
.review_form{ display: none; float: left; margin-bottom: 5%; }
.review_active{ color: #5bc0de; font-size: 16px; }
.review_active:focus, .review_active:hover { color: #5bc0de; font-size: 16px; text-decoration: none; }
.rating_review { border: none; float: left; }
.rating_review > input { display: none; } 
.rating_review > label:before { margin: 5px; font-size: 1.25em; font-family: FontAwesome; display: inline-block; content: "\f005"; }
.rating_review > .half:before { content: "\f089"; position: absolute; }
.rating_review > label { color: #ddd; float: right; font-size: 28px; }
.rating_review > input:checked ~ label, .rating_review:not(:checked) > label:hover, .rating_review:not(:checked) > label:hover ~ label { color: #FFD700;  }
.rating_review > input:checked + label:hover, .rating_review > input:checked ~ label:hover, .rating_review > label:hover ~ input:checked ~ label, .rating_review > input:checked ~ label:hover ~ label { color: #FFED85;  }   

</style>

<?php 

$user_id = $_SESSION['uid'];
$sql_count = "SELECT count(*) as exist FROM tbl_rating WHERE user_id = $user_id";

$sql = "SELECT * FROM tbl_rating WHERE user_id = $user_id && status = 0 && DATEDIFF(NOW(), transaction_date) <= 30";

$count = $DB->Row($sql_count);
$result = $DB->query($sql);

if ($count['exist'] > 0) {
?>
<div id="dv1">
    <h4>Review transaction</h4>

  <?php
  while($row = $DB->NextRow($result)) {

    $trans_id = $row['transaction_id'];
    $transcut = substr($trans_id,0, 30);
    $r_id = $row['id'];

    echo "<a  id='trans_id_".$r_id."' class='trans_id' onClick='getid(".$r_id.")' data-target='".$r_id."' href='javascript:void(0);'><h5>".$transcut."...</h5></a>";

  }
  ?>
  
  <form id="ratingform">
    <fieldset id='demo1' class="rating_review">
      <input type="hidden" name="rating_id" id="rating_id" value=""/>
      <input class="stars" type="radio" id="star5" name="rating" value="5" />
      <label class = "full" for="star5" title="Awesome - 5 stars"></label>

      <input class="stars" type="radio" id="star4" name="rating" value="4"/>
      <label class = "full" for="star4" title="Pretty good - 4 stars"></label>

      <input class="stars" type="radio" id="star3" name="rating" value="3"  />
      <label class = "full" for="star3" title="Meh - 3 stars"></label>

      <input class="stars" type="radio" id="star2" name="rating" value="2" />
      <label class = "full" for="star2" title="Kinda bad - 2 stars"></label>

      <input class="stars" type="radio" id="star1" name="rating" value="1" />
      <label class = "full" for="star1" title=" 1 star"></label>

    </fieldset>
    <div id='feedback'></div>

      <textarea name="description" id="description" rows="4"  cols="50"></textarea>
      <p class="error"  id="rate_error">please rate it first.</p>
      <p class="error" id="description_error">This field is required.</p>

      <button type="button" id="before_review"  style="margin-top: 4%;float: right;margin-right: 20%;background-color: #66c3ee;padding: 2%;color: #fff;border: #fff;"  data-toggle="modal" data-target="#myModal2">Submit Review</button>

      <div id="myModal2" class="modal fade" role="dialog">
        <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Do you want to submit this review?</h4>
          </div>
          
          <div class="modal-body">        
            <input type="submit" class="btn btn-primary" id="review_it" data-dismiss="modal" value="yes" >
            <button type="button" class="btn btn-danger" data-dismiss="modal">no</button>
          </div>
     
        </div>
      </div>
    </div>   

  </form>
</div>
<?php }
 ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
$(document).ready(function() {

  $(function(){
    $(".trans_id").click(function(e){
      $(".trans_id").removeClass("review_active");
      $(this).addClass("review_active");
      e.preventDefault();   
    });
  });

  $("#demo1 .full").hover(function () {
    $("#feedback").text($(this).attr('title'));
  },
  function() {
    
    if($('.selected')) {
      $('#feedback').text($('.selected').attr('data-desc'));
    } else {
      $('#feedback').text('Rate this product');
    }                  
  });

  $(function() {
    
    $('.error').hide();
    $('#before_review').click(function() {

      var description = $('#description').val();
      var rateisChecked = jQuery("input[name=rating]:checked").val();

      if(!rateisChecked){
        $("p#rate_error").show();
        return false;
      }

      if (description == "") {
        $("p#description_error").show();
        return false;
      }
    });
  });


  $('#review_it').click(function(event) {
    var formData = {
      'rate'   : $('.stars:checked').val(),
      'description' : $('#description').val(),
      'rating_id' : $('#rating_id').val(),
    };
    var rating_id_review = $('#rating_id').val();

    $.ajax({
      type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
      url         : 'inc/templates/layout/rating_review.php', // the url where we want 
      data        : formData, // our data object
      dataType    : 'json', // what type of data do we expect back from the server
      encode      : true,
      success: function(d) {
        console.log(d);
        if(d == 0) {
          alert('Your review has been submitted successfully.');
          $("#trans_id_"+rating_id_review).hide('slow');
          $('#ratingform')[0].reset();
          $("#feedback").html('');
          $("#review_form").hide('slow');
        }
        else if(d == 1){
          alert('You already rated');
        }
        else if(d == 2){
          alert('Your 30 days time period over');
        }
        else if(d == 3){
          alert('please do transaction');
        }
      },
    });
    event.preventDefault();
  });




});
</script>


<script type="text/javascript">
function getid(id) {
$("#review_form").hide('slow');
    $("#review_form").show('slow');

$("#rating_id").val(id);

  $('#ratingform')[0].reset();
$("#feedback").html('');





  
}




        </script>*/?>
<p><?=$PageDesc ?></p>
<a class="NormBtn" href="<?=getThePermalink('subscribe')?>"><span>Continue</span></a>
</div>

<? }
elseif($show_page=="thankyou"){ ?>
<? foreach($BANNER_ARRAY as $banner){ if($banner['position'] =="middle"){?>
<div class="middle_banner"><? print $banner['display'];?></div><? }} ?>

<div class="inner_common_cont">
<p><?=$PageDesc ?></p>
<a class="NormBtn" href="<?=getThePermalink('logout')?>"><span><?=$GLOBALS['_LANG']['_logout'] ?></span></a>
</div>

<? }elseif($show_page=="cancel"){ ?>

<div class="TopContact"><span><?=$PageTitle ?></span></div><br>
<div class="inner_common_cont">
<p><?=$PageDesc ?></p>
<a class="NormBtn" href="<?=getThePermalink('logout')?>"><span><?=$GLOBALS['_LANG']['_logout'] ?></span></a>
</div>

<? }elseif($show_page=="error"){ ?>

<div class="TopContact"><span><?=$PageTitle ?></span></div><br>
<div class="inner_common_cont">
<p><?=$PageDesc ?></p>
<a class="NormBtn" href="<?=getThePermalink('logout')?>"><span><?=$GLOBALS['_LANG']['_logout'] ?></span></a>
</div>

<? } ?>

<?php
/* MAIN CLOSE */
if(!isset($HEADER_SINGLE_COLUMN)){ ?></div><div class="clear"></div> <? }else{ print "</div>"; }
?>

</div> <div id="main_wrapper_bottom"></div>
</div>