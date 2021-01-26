<?php
  
  if(isset($_POST['do']) && $_POST['do'] == 'fieldadd'){
  
    if(isset($_POST['editid'])){ // update field row

    

    $dbh = getMarketDBConnection($_REQUEST['market_id']);


    getMarketQueryUpdate($dbh,"UPDATE field SET fType='".$_POST['f3']."', groupid='".$_POST['groupid']."' WHERE fid='".$_POST['editid']."' LIMIT 1");
    
    }else{

      $dbh = getMarketDBConnection($_REQUEST['market_id']);
      // ADD AN ARRANGE OF FIELDS THAT ARE ACCEPTED AS IS
      $fieldNames = array("postcode", "age", "gender", "location", "headline", "description","lookingfor", "country");
      if (in_array($_POST['f2'], $fieldNames)) {
        $newfield = $_POST['f2'];
      }
      else{
        /* Lets strip all the spaces from the field entry */
        if(strlen($_POST['f1']) > 1){             
          $newfield = $_POST['f1'];
        }
        else{
          $newfield = "em_".WLDCreateRowName();
        }
      
      }             
    
      /* Alter the users table for the new table row */
      if($_POST['f3'] == 1){
        $AlterTable ="ALTER TABLE `members_data` ADD `".$newfield."` VARCHAR( 255 )";
      }
      elseif($_POST['f3'] == 2){             
        $AlterTable ="ALTER TABLE `members_data` ADD `".$newfield."` TEXT ";
      }
      elseif($_POST['f3'] == 3){
        $AlterTable ="ALTER TABLE `members_data` ADD `".$newfield."` INT( 3 )";
      }
      elseif($_POST['f3'] == 9){
        $AlterTable ="ALTER TABLE `members_data` ADD `".$newfield."` INT( 3 )"; 
      }
      elseif($_POST['f3'] == 10){
        $AlterTable ="ALTER TABLE `members_data` ADD `".$newfield."` INT( 3 )"; 
      }
      elseif($_POST['f3'] == 4){
        $AlterTable ="ALTER TABLE `members_data` ADD `".$newfield."` INT( 1 )";
      }
      // MULTIPLE CHECK BOX AND AGE FIELD
      elseif($_POST['f3'] == 5 || $_POST['f3'] == 7){
        $AlterTable ="ALTER TABLE `members_data` ADD `".$newfield."` VARCHAR( 100 )";
      }
      getMarketQueryUpdate($dbh,$AlterTable);
                
      // PLACE UNDER GROUP TITLE
      if($_POST['groupid'] ==0){

        $stmt = $dbh->prepare("SELECT id FROM field_groups LIMIT 1");
        $stmt->execute();
        $newtype = $stmt->fetch();
        
        $_POST['groupid'] = $newtype['id'];
      }
              
      /* Add a new Row into the database */
      if(!isset($_POST['req'])){ $_POST['req'] =0; }
      
      $stmt = $dbh->prepare("INSERT INTO `field` (`fName` , `fType` , `fOrder` , `fGender`, groupid, required ) VALUES ('".$newfield."', '".$_POST['f3']."', '1', '".$_POST['f4']."', '".$_POST['groupid']."', '".$_POST['req']."')");
      $stmt->execute();
      $GenerateID = $dbh->lastInsertId();
      /*  Remove Row from database*/
      $capnewlang = str_replace(".php","",$_POST['lang']);
      getMarketQueryUpdate($dbh,"INSERT INTO `field_caption` (`Cid` , `lang` , `caption`, `description`, `match` )  VALUES ('".$GenerateID."', '$capnewlang', '".$_POST['f2']."','','no')");
      getMarketQueryUpdate($dbh,"INSERT INTO `field_caption` (`Cid` , `lang` , `caption`, `description`, `match` )  VALUES ('".$GenerateID."', '$capnewlang', '".$_POST['f2']."','','yes')");
                
    }
    
    echo '
    <script>
    window.location.href="?p=management&Err=New%20field%20has%20been%20added%20successfully.**1";
    </script>';
  }

?>






<ul class="form">

  <form method="post" name="form1" action="">
  <input name="do" type="hidden" value="fieldadd" class="hidden">
  <input name="f4" type="hidden" value="2" class="hidden">
  <input name="f1" type="hidden" value="" class="hidden">

  <? if(isset($_GET['id'])){ 
  $data = $DB->Row("SELECT * FROM field WHERE fid='".$_GET['id']."' LIMIT 1");
  ?>
  <input name="editid" type="hidden" value="<?=$_GET['id'] ?>" class="hidden">
  <? } 
  if(!isset($data['groupid'])){ $data['groupid']=0; }
  ?>
      

  <? if(!isset($_GET['id'])){ ?>
  <ul class="form"><div class="box_body"> 
    <li><label><?=$admin_management[21] ?></label>
  <div class="tip">This is a name for your field. For example. 'Gender' or 'Height'. Its recommended to keep this field short as you can add more information to the description later.</div>
  <input name="f2" type="text" class="input" size="40">
  </li></div></ul>
  <? } ?>

  <ul class="form"><div class="box_body"> 
  
  <li><label><?=$admin_management[22] ?></label>
  <div class="tip">Field type allows you to select what type of field will be created. Each field has different display options.</div>
          <select name="f3"  class="input" onChange="ShowLinked(this.value);">
          <option value="1" <? if(isset($data['fType']) && $data['fType'] =="1"){ print "selected";} ?>>- <?=$admin_management[23] ?></option>
          <option value="2" <? if(isset($data['fType']) && $data['fType'] =="2"){ print "selected";} ?>>- <?=$admin_management[24] ?></option>
          <option value="3" <? if(isset($data['fType']) && $data['fType'] =="3"){ print "selected";} ?>>- <?=$admin_management[25] ?></option>
          <option value="4" <? if(isset($data['fType']) && $data['fType'] =="4"){ print "selected";} ?>>- <?=$admin_management[26] ?></option>
          <option value="5" <? if(isset($data['fType']) && $data['fType'] =="5"){ print "selected";} ?>>- <?=$admin_management[27] ?></option>
          <!--<option value="6">- Input Field </option>-->
          <option value="7" <? if(isset($data['fType']) && $data['fType'] =="7"){ print "selected";} ?>>- Birthday (Age) Field </option>
          <!--<option value="8">- Date Field</option> -->
           

          </select>
  </li>
  <? if(!isset($_GET['id'])){ ?>
  </div></ul><ul class="form"><div class="box_body"> 
  <li><label><?=$admin_management[18] ?>: </label>
  <div class="tip">Select the base language for this field. You can create captions in different languages later.</div>
  <select class="input" name="lang"><?=WLDFieldLangs() ?></select></li>
  <? } ?>
  </div></ul><ul class="form"><div class="box_body"> 
  <li><label><?=$admin_management[28] ?></label>
  <div class="tip">Select which group headline to save this field under.</div>
  <select class="input" name="groupid"><option value="0"><?=$admin_management[30] ?></option><?= WLDDisplayGroups($data['groupid'],$_GET['market_id']) ?></select></li>
  <!--<li><label><?=$admin_management[29] ?> </label><input name="req" type="checkbox" value="1" class="radio"></li> -->
  <li><input type="submit" class="MainBtn" value="<?=$admin_button_val[8] ?>"></li>
  </div></ul>
  </form>


</ul>