<?php

if(isset($_POST['do']) && $_POST['do']=='fieldaddgroup'){
  
  if($_POST['private'] == ""){
    $_POST['private'] =0;
  }   
  
  $dbh = getMarketDBConnection($_REQUEST['market_id']);

  if(!isset($_POST['eid'])){
      
    $stmt = $dbh->prepare("INSERT INTO `field_groups` ( caption , private)VALUES ('".$_POST['caption']."', '".$_POST['private']."')");
    $stmt->execute();
                  
  }else{
    
    $stmt = $dbh->prepare("UPDATE field_groups SET caption='".$_POST['caption']."' , private='".$_POST['private']."' WHERE id=".$_POST['eid']);
    $stmt->execute();
                  
  }
  
   echo '<script>
    window.location.href="?p=management&Err=Group%20has%20been%20updated%20successfully.**1";
    </script>';
}

?>
<ul class="form">
   
  <form method="post" action="" name="form1">
  <?php if(isset($_REQUEST['e'])){ 
    $group = WLDGetGroup($_REQUEST['e'],$_REQUEST['market_id']); ?><input type='hidden' class='hidden' name='eid' value='<?=$_REQUEST['e'] ?>'>
  <?php } ?>
    <input name="do" type="hidden" value="fieldaddgroup" class="hidden">
    <input name="market_id" type="hidden" value="<?=$_GET['market_id']?>" class="hidden">
    <ul class="form">
      <div class="box_body">
        <li>
          <label><?=$admin_management[2] ?>: </label>
          <div class="tip">This is the title of your group, such as "About Me" or "My Hobbies".</div>
          <input type="text" class="input" name="caption" value="<?php if(isset($group)){ print $group['caption']; } ?>"size="40">
        </li>
      </div>
    </ul>

    <ul class="form">
      <div class="box_body">
      <li>
        <label><?=$admin_management[32] ?>:</label>
        <div class="tip">The display options allow you to choose which members can view the fields you add to this group. This allows you to personalise your field groups. For example you can create a field group for females only and add fields directly related to females such as bra size and fav. makup brand.</div>
  
  
        <select name="private" class="input">
          <option value="0" <?php if(isset($group)){ if($group['private']=="0"){print "selected"; } } ?>><?=$admin_management[34] ?></option>
          <option value="1" <?php if(isset($group)){ if($group['private']=="1"){print "selected"; } } ?>><?=$admin_management[35] ?></option>
          <option value="2" <?php if(isset($group)){ if($group['private']=="2"){print "selected"; } } ?>><?=$admin_management[36] ?></option>
          <?

        $dbh = getMarketDBConnection($_GET['market_id']);

        $result = $dbh->query("SELECT fvid, fvCaption, fvOrder, lang FROM field_list_value WHERE fvFid =28 ORDER BY fvOrder ASC");
        foreach( $result AS $list )
        {
        ?>
            <?php if(isset($group) && $group['private']==$list['fvid']){ ?>
            <option value="<?=$list['fvid'] ?>" selected><?=$list['fvCaption']?> <?=$admin_management[37] ?></option>
            <?php }else{ ?>
            <option value="<?=$list['fvid'] ?>"><?=$list['fvCaption']?> <?=$admin_management[37] ?></option>
            <?php } ?>
            
          <?php } ?>
        
  </select></li>
  <li><input  type="submit" class="MainBtn" value="<?=$admin_button_val[8] ?>"></li>
  </div></ul>
  </form>




</ul>