<!-- Closing Side Id -->


<?php
function getAge(){
	for($age=18; $age <=99; $age++){
		echo "<option value='".$age."'>".$age."</option>";
	}
	
}
function getAgeRange(){
	for($age=99; $age >=18; $age--){
		echo "<option value='".$age."'>".$age."</option>";
	}
	
}

?>

<div id="quick-search" class="col-md-3">


<form method="post" name="MemberSearch" action="<?=getThePermalink('search')?>">         
    <input name="do_page" type="hidden" value="search" class="hidden">
    <input type="hidden" name="page" value="1" class="hidden">
    <input type="hidden" name="Extra[zero]" value="1" class="hidden">
    <? if(isset($_GET['friendid'])){ ?><input type="hidden" name="friendid"   value="<? if(isset($_GET['friendid'])){ print $_GET['friendid']; }else{ print $_GET['friendid']; } ?>" class="hidden"><? } ?>
    <? if(isset($_POST['friendid'])){ ?><input type="hidden" name="friendid"  value="<? print $_POST['friendid']; ?>" class="hidden"><? } ?>  
    <? if(isset($_GET['friend_type'])){ ?><input type="hidden" name="friend_type"   value="<? print strip_tags($_GET['friend_type']); ?>" class="hidden"><? } ?>
    <? if(isset($_POST['friend_type'])){ ?><input type="hidden" name="friend_type"  value="<? print strip_tags($_POST['friend_type']); ?>" class="hidden"><? } ?>

<div class="quick-search-form">
<h3 class="col-md-12 head-title"><?=$GLOBALS['_LANG']['_searchQ'] ?></h3>

<?=DisplayQuickBrowse()?>



<div class="form-group">
  <div class="col-md-12 btn-row">
  <br/>
  <input name="submit" type="submit" class="btn MainBtn btn-fullwidth"  value="<?=$GLOBALS['_LANG']['_search'] ?>">
  <br/>
  <br/>
  
  <a class="link" href="<?php echo DB_DOMAIN;?>search/advanced">Advanced Search<?php //$GLOBALS['_LANG']['_advancedsearch'] ?></a>
  </div>
</div>
</div>
</form>

<script>

  function initialize(id) {
    var input = document.getElementById(id);
        var options = {types: ['(cities)'], componentRestrictions: {}};

        new google.maps.places.Autocomplete(input, options);
    }

  google.maps.event.addDomListener(window, 'load', function() {  
    initialize('quickSearchLocation');
    });
    
</script>
</div>
