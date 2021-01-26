<?php

if(isset($_POST['do']) && $_POST['do'] == 'fielddelete'){

  $dbh = getMarketDBConnection($_REQUEST['market_id']);
  for($i = 1; $i < $_POST['TotalOrder']; $i++) { 
    
    if(isset($_POST['d'. $i]) && $_POST['d'.$i] == "on"){

      $stmt = $dbh->prepare("SELECT fName FROM field WHERE fid  = '".$_POST['id'.$i]."' LIMIT 1");
      
      $stmt->execute();
      $fT = $stmt->fetch();
      getMarketQueryUpdate($dbh,"ALTER TABLE `members_data` DROP ".$fT['fName']);
      getMarketQueryUpdate($dbh,"DELETE FROM field WHERE fid  = '".$_POST['id'.$i]."' LIMIT 1");
      getMarketQueryUpdate($dbh,"DELETE FROM field_caption WHERE Cid  = '".$_POST['id'.$i]."' LIMIT 1");
      getMarketQueryUpdate($dbh,"DELETE FROM field_list_value WHERE fvFid  = '".$_POST['id'.$i]."'");   

      // RESET EVERYONES MATCH RESULTS
      getMarketQueryUpdate($dbh,"UPDATE members_privacy SET match_array=''");
                    
    }
  
  }

  echo '
    <script>
    window.location.href="?p=management&Err=Fields%20has%20been%20updated%20successfully.**1";
    </script>';

}

?>


<div class="page">
   
  <div class="content">
    <div class="block"> 
      <?php echo getMarketSiteHtml("manage_profile_questions",'no','no'); ?>
    </div>

    <div class="box">
      <div class="box-content">
        <div id="contentcolumn" class="contentcolumndash">
          <div id="TableViewer"></div>
        </div>
        <br class="clear">
      </div>
    </div>
  </div>

</div>