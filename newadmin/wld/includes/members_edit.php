<link rel="stylesheet" href="inc/zebra/profile-bootstrap.css" type="text/css">
<link rel="stylesheet" href="inc/zebra/bootstrap-select.css" type="text/css">
<link rel="stylesheet" href="inc/zebra/styles.css" type="text/css">
<link rel="stylesheet" href="inc/zebra/mediastyles.css" type="text/css">
<link rel="stylesheet" href="inc/zebra/responsivetabs.css" type="text/css">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" crossorigin="anonymous">
<style>
.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus{
    background: #1c1f22;
}
.userdata1 h3,.nav-tabs > li > a,.nav-tabs > li > a:hover,.text-blue2,.dl-custom1 dt,h1, h2, h3, h4, h5, h6,.titles-edit,.btn-circle-resp{
    color: #979797;

}
.btn-circle-resp{
    border-color:#1c1f22;   
}

</style>
<?php $memberData = WLDGetEditMemberProfileDetails($_REQUEST['mid'],$_REQUEST['market_id']); ?>
    
<input type="hidden" name="market_id" id="select-market" value="<?php echo $_GET['market_id'];?>"/>
<div class="modal fade in" id="uploadPropic" tabindex="-1" role="dialog" aria-labelledby="uploadPropicLabel" style="display: none; padding-right: 17px;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="uploadPropicLabel">Upload Profile Picture</h4>
      </div>
      <form name="frmProfilepicUpload" id="frmProfilepicUpload" action="" method="post" enctype="multipart/form-data">
      <div class="modal-body my-form">
        <div class="row">
            <div class="col-xs-4">
                <?php
                $memPhoto = WLDGetMemberPhoto($_REQUEST['mid'],'photo',$_REQUEST['market_id']);

                $albumID = WLDGetMemberAlbum($_REQUEST['mid'],$_REQUEST['market_id']);
                if($memPhoto['bigimage']):?>
                <img src="<?php echo $memPhoto['domain'];?>inc/tb.php?src=<?php echo $memPhoto['bigimage']; ?>&x=96&y=96&uid=<?php echo $_REQUEST['mid']; ?>" class="img-responsive">
                <?php else:?>
               <img src="<?php echo DB_DOMAIN;?>/inc/tb.php?src=&x=96&y=96&uid=<?php echo $_REQUEST['mid']; ?>" class="img-responsive">
               <?php endif; ?>
            </div>
            <div class="col-xs-8">
                <div><input type="file" name="profilepic" id="profilepic">
                    <p class="small margin-top-10">Please upload a headshot of yourself that is recent, well lit and ideally smiling!</p> 
                    <p class="font-size-10"><strong><em>Images can be up to 2 MB and we accept jpeg, gif or png files.</em></strong></p>
                </div>
                <div class="checkbox">
                    <label>
                    <input type="checkbox" id="yespic"><span class="font-size-10 text-muted">Click here if you would like to submit this photo to be included in our Featured Members on the home page. Not all photos are approved for the Featured Members section. To be featured, you must have a clear, well-lit headshot of you, preferably smiling, with no sunglasses. If approved, your photo will remain in the rotation for the next 45 days.</span>
                    </label>
                </div>                        
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btnlogin" data-dismiss="modal" onclick="WLDUploadProfilePhoto()">Upload Profile Pic</button>
      </div>
      <input type="hidden" name="imgid" value="<?php echo $memPhoto['id']?>" />
      <input type="hidden" name="aid" value="<?php echo $albumID['aid']?>" />
      <input type="hidden" name="uid" value="<?php echo $_GET['mid']?>" />
      <input type="hidden" name="gmtdiff" value="<?php echo $memberData['gmt_diference']?>" />  
      </form>
      
    </div>
  </div>
</div>
    
<div class="modal fade in" id="deletePropic" tabindex="-1" role="dialog" aria-labelledby="deletePropicLabel" style="display: none; padding-right: 17px;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="deletePropicLabel">Delete Profile Picture</h4>
      </div>
      <form name="fromprofilepicDelete" id="fromprofilepicDelete" action="" method="post">
      <div class="modal-body my-form">
        <div class="row">
            <div class="col-xs-12 text-center">
                Are you sure you want to remove your current profile pic?   
            </div>
            
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btnlogin" data-dismiss="modal" onclick="WLDDeleteProfilePic()">Delete Profile Pic</button>
      </div>
      <input type="hidden" name="mid" value="<?php echo $_GET['mid']?>" />
      <input type="hidden" name="photoid" value="<?php echo $memPhoto['id'];?>" />
      </form>
      
    </div>
  </div>
</div>
<div id="divmaincontent" class="medit">
            
    <div class="row">
        <div class="col-md-3 col-sm-4">
            <div id="main-profile-pic">
                <div class="userdata1">
                    <h3><?php echo $memberData['username']; ?></h3>
                </div>
                <div class="row">
                    <div class="col-xs-10 text-blue2" id="MPEditLabel_mytagline" style="display: block;">
                        <?php if($memberData['headline']) { echo $memberData['headline'];} ?>
                    </div>
                    
                    <div class="col-xs-2 MPEditButton_mytagline" style="display: block;"> 
                        <a class="btn btn-default btn-circle-edit" href="javascript:void(0)" role="button" onclick="WLDMpEdit('mytagline')" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a>
                    </div>
                </div>
                <div class="row" id="MPEditContainer_mytagline" style="display: none;">
                    <div class="col-xs-9">
                        <form name="frmtagline" id="frmtagline" method="post">
                            <input type="text" class="form-control" name="headline" value="<?php echo $memberData['headline'];?>" id="tagline" placeholder="Looking for my Soulmate">   
                            <input type="hidden" name="mid" value="<?php echo $_REQUEST['mid'];?>" />
                        </form> 
                    </div>
                    <div class="col-xs-3 padding-side-0 text-center MPSaveButton_mytagline" style="display: none;">
                        <a class="btn btn-default btn-circle-resp" href="javascript:void(0)" role="button" onclick="WLDMpTagSave('mytagline')" title="Save"><i class="fa fa-check" aria-hidden="true"></i></a>
                        <a class="btn btn-default btn-circle-resp" href="javascript:void(0)" role="button" onclick="WLDMpCancel('mytagline')" title="Cancel"><i class="fa fa-close" aria-hidden="true"></i></a>
                    </div>
                </div>
                        
                <div class="row margin-top-10">
                    <form>
                        <div class="col-xs-12">
                            <span class="small text-muted">Profile Visibility: &nbsp;<input type="radio" name="profilevisible" id="profilevisible" onClick="WLDChangeMemberYesNo('yes','<?php echo $_GET['mid'];?>','members.visible');" value="<?php echo $memberData['visible'];?>" <?php if($memberData['visible'] == 'yes'): echo "checked"; endif;?>> <span class="font-size-10">Visible</span>
                            <input type="radio" name="profilevisible" id="profilehidden" onClick="WLDChangeMemberYesNo('no','<?php echo $_GET['mid'];?>','members.visible');" value="<?php echo $memberData['visible'];?>" <?php if($memberData['visible'] != 'yes'): echo "checked"; endif;?>> <span class="font-size-10">Hidden</span>
                            </span>
                        </div>
                    </form>
                </div>
                <div class="margin-top-10">
                    <?php 
                    $memberPhoto = WLDGetMemberPhoto($_REQUEST['mid'],'photo',$_REQUEST['market_id']);
                    if(isset($memberPhoto['bigimage']) && $memberPhoto['bigimage']):?>
                    <div><img src="<?php echo $memberPhoto['domain'];?>/inc/tb.php?src=<?php echo $memberPhoto['bigimage']; ?>&x=253&y=337&uid=<?php echo $_REQUEST['mid']; ?>" class="img-responsive thumbnail-image"></div>
                    <?php else:?>
                    <div><img src="<?php echo DB_DOMAIN;?>/inc/tb.php?src=&x=253&y=337&uid=<?php echo $_REQUEST['mid']; ?>" class="img-responsive thumbnail-image"></div>
                    <?php endif; ?>
                    <div class="margin-top-10"><a href="#" data-toggle="modal" data-target="#uploadPropic"><i class="fa fa-edit" aria-hidden="true"></i> Edit Profile Pic</a></div>
                    <div class="margin-top-10"><a href="#" data-toggle="modal" data-target="#deletePropic"><i class="fa fa-trash" aria-hidden="true"></i> Delete Profile Pic</a></div>
                </div>
                        <div class="row margin-top-10" id="MPEditLabel_editasl">
                            <div class="col-xs-9 bold-darker">
                                <span><?php echo $memberData['location']?>,</span>
                                <?php
                                    $mylocation = WLDGetBasicProfileInformation(2,$_REQUEST['market_id']);
                                    $my = array(25,54,28,20);
                                    foreach($mylocation as $key => $mybvalue){
                                        $myfieldCaption = WLDGetFieldCaption($mybvalue['fid'],$mybvalue['fType'],$_REQUEST['market_id']);
                                        $mymembersField = WLDGetMemberColumns($mybvalue['fName'], $_REQUEST['mid'],$_REQUEST['market_id']);
                                        $mymembersFieldValue = WLDGetMemberColumnsValue($mymembersField[0],$_REQUEST['market_id']);
                                        //print_r($mymembersField);
                                        if(in_array($mybvalue['fid'],$my)) {
                                            
                                ?>
                                
                                <span><?php echo $mymembersFieldValue[0];?>,</span>
                                <?php /*?><span><?php echo MakeAge($memberData['age']);?> - <?php echo $sex['fvCaption'];?> - <?php echo $sexual['fvCaption'];?></span><?php */?>
                                <?php } } ?>
                               <span> <?php echo MakeAge($memberData['age']);?></span>
                            </div>
                            <div class="col-xs-3 MPEditButton_editasl">
                                <a class="btn btn-default btn-circle-edit" href="javascript:void(0)" role="button" onclick="WLDMpEdit('editasl')" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div class="row margin-top-10" id="MPEditContainer_editasl" style="display:none;">
                            <div class="col-xs-6 text-left">
                                <h6>My Location</h6>
                            </div>
                           
                            <div class="col-xs-6 text-right MPSaveButton_editasl">
                                <a class="btn btn-default btn-circle-resp" href="javascript:void(0)" role="button" onclick="WLDMpSaveMyLocation('editasl')" title="Save"><i class="fa fa-check" aria-hidden="true"></i></a>
                                <a class="btn btn-default btn-circle-resp" href="javascript:void(0)" role="button" onclick="WLDMpCancel('editasl')" title="Cancel"><i class="fa fa-close" aria-hidden="true"></i></a>
                            </div>
                            <div class="col-xs-12">
                                <div id="mylocation" style="display:none; font-weight:bold; color:#090;">Updated sucessfully!!!</div>
                                <form name="frmmylocation" id="frmmylocation" action="" method="post">
                                    <div class="row">
                                        <label for="country" class="col-xs-12 label-edit-info">Country</label>
                                        <div class="col-xs-12">
                                            <?php echo getCountryState($memberData['country']); ?>
                                        </div>
                                        <label for="state" class="col-xs-12 margin-top-10 label-edit-info">State</label>
                                        <div class="col-xs-12">
                                            <div id="Link54">
                                                <a href="javascript:void(0);" onclick="eMeetingLinkedField(569, 54,0);">
                                                <?php 
                                                
                                                $state = WLDGetMemberColumnsValue($memberData['em_85820081128'],$_REQUEST['market_id']);
                                                echo $state[0];
                                                ?> </a>
                                            </div>
                                            
                                        </div>
                                        <label for="City" class="col-xs-12 margin-top-10 label-edit-info">City</label>
                                        <div class="col-xs-12">
                                            <input type="text" class="form-control" id="location" name="location" value="<?php echo $memberData['location'];?>" placeholder="Sarah">
                                        </div>
                                         <div class="col-xs-12 text-left">
                                            <h6>Birthday, gender and orientation</h6>
                                        </div>
                                        <label class="col-xs-12 label-edit-info">My Birthday</label>
                                        <div class="col-xs-12">
                                            <?php
                                                $age = explode("-",$memberData['age']);
                                            ?>
                                            <select class="form-control" id="birthdayyear" name="birthdayyear">
                                                <option>Select Year</option>
                                                <?php   
                                                $firstYear = 1919;
                                                $lastYear = date('Y') - 18;
                                                for($i=$firstYear;$i<=$lastYear;$i++){
                                                    if($age[0] == $i):
                                                    echo '<option value='.$i.' selected="selected">'.$i.'</option>';
                                                    else:
                                                    echo '<option value='.$i.'>'.$i.'</option>';
                                                    endif;
                                                }?>
                                            </select>
                                        </div>
                                        <div class="col-xs-12 margin-top-10">
                                            <?php
                                            $months = array();
                                            $months = array(1 => 'JAN', 2 => 'FEB', 3 => 'MAR', 4 => 'APR', 5 => 'MAY', 6 => 'JUN', 7 => 'JUL', 8 => 'AUG', 9 => 'SEP', 10 => 'OCT', 11 => 'NOV', 12 => 'DEC');
                                             ?>
                                            <select class="form-control" id="birthdaymonth" name="birthdaymonth">
                                                <option>Select Month</option>
                                                <?php foreach ($months as $num => $name) {
                                                        if($age[1] == $name):
                                                            $checked1 = 'selected="selected"';
                                                        else:
                                                            $checked1 = '';
                                                        endif;
                                                        
                                                        printf('<option value="%s" '.$checked1.'>%s</option>', $name, $name);
                                                        
                                                 } ?>
                                            </select>
                                        </div>
                                        <div class="col-xs-12 margin-top-10">
                                            <select class="form-control" id="birthdayday" name="birthdayday">
                                                <option>Select Day</option>
                                                <?php for($i=1; $i<=31; $i++){
                                                    if($age[2] == $i):
                                                        $checked2 = 'selected="selected"';
                                                    else:
                                                        $checked2 = '';
                                                    endif;
                                                    
                                                    echo '<option value='.$i.' '.$checked2.'>'.$i.'</option>';
                                                 } ?>
                                            </select>
                                        </div>
                                        <label for="gender" class="col-xs-12 margin-top-10 label-edit-info">My Gender</label>
                                        <div class="col-xs-12">
                                            <select class="form-control" id="gender" name="gender">
                                                <?php echo DisplayProfileGender($memberData['gender']); ?>
                                            </select>
                                        </div>
                                        <label for="orientation" class="col-xs-12 margin-top-10 label-edit-info">My Orientation</label>
                                        <div class="col-xs-12">
                                            <select class="form-control" id="orientation" name="orientation">
                                                <?php echo WLDGetProfileOrientation($memberData['em_8cx20070511'],$_REQUEST['market_id']); ?>
                                            </select>
                                        </div>
                                            
                                    </div>
                                    <input type="hidden" name="mid" value="<?php echo $_REQUEST['mid'];?>" />
                                </form>
                            </div>
                            <div class="col-xs-12 margin-top-10 text-right MPSaveButton_editasl">
                                 <a class="btn btn-default btn-circle-resp" href="javascript:void(0)" role="button" onclick="WLDMpSaveMyLocation('editasl')" title="Save"><i class="fa fa-check" aria-hidden="true"></i></a>
                                                            <a class="btn btn-default btn-circle-resp" href="javascript:void(0)" role="button" onclick="WLDMpCancel('editasl')" title="Cancel"><i class="fa fa-close" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="col-md-9 col-sm-8"> 
                    <div class="row">
                        <div class="col-xs-12 margin-top-10">
                                
                            <?php

                            $groups = $DB->Query("SELECT id,caption FROM field_groups ORDER BY forder");
                            
                            ?>

                            <div role="tabpanel" data-example-id="togglable-tabs">
                                <ul class="nav nav-tabs centered" role="tablist">
                                    
                                <?php
                                    $counter = 0;
                                    while( $group = $DB->NextRow($groups) ){
                                    $count_fields = WLDGetBasicProfileInformation($group['id'],$_REQUEST['market_id']);

                                    if(count($count_fields)){
                                        
                                    ?>
                                    <li role="presentation" <?php echo ($counter == 0) ? 'class="active"' : '';?>>
                                      <a href="#<?php echo preg_replace('/[^a-zA-Z0-9\']/', '-', strtolower($group['caption']));?>" id="<?php echo str_replace(" ", "-",strtolower($group['caption']));?>-tab" role="tab" data-toggle="tab" aria-controls="<?php echo strtolower($group['caption']);?>" aria-expanded="true">
                                        <span class="text"><?php echo $group['caption'];?></span>
                                      </a>
                                    </li>
                                    <?php
                                    $counter++;
                                    }
                                
                                    }

                                ?>

                                    <li role="presentation" class="">
                                      <a href="#photovideo" role="tab" id="photovideo-tab" data-toggle="tab" aria-controls="photovideo" aria-expanded="false">
                                        <span class="text">Media</span>
                                      </a>
                                    </li>
                                
                                </ul>
                                <div class="tab-content">

                                <?php

                                $groups = $DB->Query("SELECT id,caption FROM field_groups ORDER BY forder");
                                
                                $counter = 0;
                                ?>

                                <?php
                                $counter = 0;
                                while( $group = $DB->NextRow($groups) ){
                                $userinfo = WLDGetBasicProfileInformation($group['id'],$_REQUEST['market_id']);
                                if(count($userinfo)){
                                ?>
                                    <div role="tabpanel" class="tab-pane fade <?php echo ($counter == 0) ? 'active': '';?> in" id="<?php echo preg_replace('/[^a-zA-Z0-9\']/', '-', strtolower($group['caption']));?>" aria-labelledby="<?php echo strtolower($group['caption']);?>-tab">
                                        <div class="row margin-top-10" id="MPEditLabel_<?php echo $group['id'];?>">
                                            <div class="col-md-12 MPEditButton_<?php echo $group['id'];?> text-right">
                                                <a class="btn btn-default btn-circle-edit" href="javascript:void(0)" role="button" onclick="WLDMpEdit('<?php echo $group['id'];?>')" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                            </div>
                                            <div class="col-md-12">
                                                <dl class="dl-horizontal dl-custom1">
                                                  
                                                <?php
                                                
                                                foreach($userinfo as $key => $bvalue){
                                                    $fieldCaption = WLDGetFieldCaption($bvalue['fid'],$bvalue['fType'],$_REQUEST['market_id']);
                                                    $membersField = WLDGetMemberColumns($bvalue['fName'], $_REQUEST['mid'],$_REQUEST['market_id']);
                                                    $mFieldValue = WLDGetfieldValue($bvalue['fid'],$_REQUEST['market_id']); 

                                                    $membersFieldValue = WLDGetMemberColumnsValue($membersField[0],$_REQUEST['market_id']);
                                                    
                                                    $multiVals = array();

                                                    if($bvalue['fType'] == 5){
                                                    

                                                    $mValues = explode("**",$membersField[0]);
                                                    
                                                    foreach($mFieldValue as $key => $mflvalue):
                                                        if(isset($mValues[$key]) &&  $mValues[$key] == '1'):
                                                            $multiVals[] = $mflvalue['fvCaption'];
                                                        endif;
                                                    ?>
                                                    <?php endforeach; ?>


                                                    <div style="float:left; width:50%">
                                                        <dt><?php echo $fieldCaption['caption']?>:</dt>
                                                        <dd><?php echo implode(" , ",$multiVals);?></dd>
                                                    </div>
                                                    <?php 

                                                    }
                                                    
                                                    else if($bvalue['fType'] == 2){
                                                        if($fieldCaption['caption'] != '' && $membersField[0] != ''){
                                                    ?>
                                                        <div style="float:left; width:50%"><dt><?php echo $fieldCaption['caption']?>:</dt><dd><?php echo $membersField[0]?></dd></div>
                                                    <?php        
                                                        }
                                                    }
                                                    else if($bvalue['fType'] == 1){
                                                        if($fieldCaption['caption'] != '' && $membersField[0] != ''){
                                                    ?>
                                                        <div style="float:left; width:50%"><dt><?php echo $fieldCaption['caption']?>:</dt><dd><?php echo $membersField[0]?></dd></div>
                                                    <?php        
                                                        }
                                                    }
                                                    else{
                                                    
                                                        if($fieldCaption['caption'] != '' && $membersFieldValue[0] != ''){?>
                                                    
                                                            <div style="float:left; width:50%"><dt><?php echo $fieldCaption['caption']?>:</dt><dd><?php echo $membersFieldValue[0]?></dd></div>
                                                      
                                                        <?php
                                                        }
                                                    }
                                                } ?>
                          
                                                </dl>
                                            </div>
                                        </div>



                <div class="row margin-top-10" id="MPEditContainer_<?php echo $group['id'];?>" style="display:none;">
                    <div class="col-md-12 text-right margin-bottom-10 MPSaveButton_<?php echo $group['id'];?>">
                        <a class="btn btn-default btn-circle-resp" href="javascript:void(0)" role="button" onclick="WLDMpSaveBasicProfileInfo('<?php echo $group['id'];?>')" title="Save"><i class="fa fa-check" aria-hidden="true"></i></a>
                                            <a class="btn btn-default btn-circle-resp" href="javascript:void(0)" role="button" onclick="WLDMpCancel('<?php echo $group['id'];?>')" title="Cancel"><i class="fa fa-close" aria-hidden="true"></i></a>
                    </div>
                        <?php $editbasicinfo = WLDGetBasicProfileInformation($group['id'],$_REQUEST['market_id']);// print_r($editbasicinfo);?>
                    <form class="join-form" name="frmBasicProfileInfo_<?=$group['id']?>" id="frmBasicProfileInfo_<?=$group['id']?>" method="post" action="">
                        <div id="basicinfo" style="display:none; color:#090; font-weight:bold;">Updates Sucessfully!!!</div>
                        <?php 

                        foreach($editbasicinfo as $key => $bvalue){
                                $fieldCaption = WLDGetFieldCaption($bvalue['fid'],$bvalue['fType'],$_REQUEST['market_id']);
                                $membersField = WLDGetMemberColumns($bvalue['fName'], $_REQUEST['mid'],$_REQUEST['market_id']);
                                $membersFieldValue = WLDGetMemberColumnsValue($membersField[0],$_REQUEST['market_id']);
                                $mFieldValue = WLDGetfieldValue($bvalue['fid'],$_REQUEST['market_id']);
                                //echo $fieldCaption['caption']."<br>";
                                //print_r($mFieldValue);
                                ?>
                                
                                <?php if($bvalue['fType'] == 5){ ?>
                                <div class="col-md-6">      
                                    <div class="row">
                                        <div class="col-md-12 titles-edit2"><?php echo $fieldCaption['caption'];?>:</div>
                                          <div class="col-md-12">
                                              <div class="row">
                                                  <div class="col-xs-12">
                                                  <?php 
                                                  $mValues = explode("**",$membersField[0]);
                                                  /*echo"<pre>";
                                                  print_r($mFieldValue);
                                                  echo "</pre>";*/
                                                  
                                                  foreach($mFieldValue as $key => $mflvalue):
                                                    if(isset($mValues[$key]) && $mValues[$key] == '1'):
                                                        $checked= 'checked';
                                                        else:
                                                        $checked = '';
                                                    endif;
                                                   ?>
                                                        
                                                    <div class="checkbox" style="width:45%; float:left;">
                                                  <label>
                                                    <input type="hidden" name="hid[<?php echo $bvalue['fName'];?>___<?php echo $key;?>]" value="<?php echo $mflvalue['fvid'];?>"/>
                                                    <input type="checkbox" name="chk[<?php echo $bvalue['fName'];?>___<?php echo $key;?>]" value="<?php echo $mflvalue['fvid'];?>" <?php echo $checked; ?>>
                                                    <?php echo $mflvalue['fvCaption'];?>
                                                  </label>
                                                </div>
                                                <?php endforeach; ?>
                                                  </div>
                                               </div>
                                          </div>
                                        </div>
                                    </div>
                                    <?php }
                                    else if($bvalue['fType'] == 7){
                                        /*if($fieldCaption['caption'] != '' && $membersField[0] != ''){
                                        ?>
                                        <div style="float:left; width:50%"><dt><?php echo $fieldCaption['caption']?>:</dt><dd><?php echo $membersField[0]?></dd></div>
                                        <?php
                                        }*/
                                    }
                                    else  if($bvalue['fType'] == 4){ ?>
                                <div class="col-md-6">      
                                    <div class="row">
                                        <div class="col-md-12 titles-edit2"><?php echo $fieldCaption['caption'];?>:</div>
                                          <div class="col-md-12">
                                              <div class="row">
                                                  <div class="col-xs-12">
                                                  <?php foreach($mFieldValue as $key => $mflvalue):
                                                    if($memberData[$bvalue['fName']] == $mflvalue['fvid']):
                                                        $checked= 'checked';
                                                        else:
                                                        $checked = '';
                                                    endif;
                                                   ?>
                                                        
                                                    <div class="checkbox" style="width:45%; float:left;">
                                                  <label>
                                                  
                                                    <input type="radio" name="<?php echo $bvalue['fName'];?>" value="<?php echo $mflvalue['fvid'];?>" <?php echo $checked; ?>>
                                                    <?php echo $mflvalue['fvCaption'];?>
                                                  </label>
                                                </div>
                                                <?php endforeach; ?>
                                                  </div>
                                               </div>
                                          </div>
                                        </div>
                                    </div>
                                    <?php } else if($bvalue['fType'] == 1){
                                    if($bvalue['fName'] != 'location'){
                                     ?>
                                    <div class="col-md-6">      
                                        <div class="row margin-top-10">
                                            <div class="col-md-4 titles-edit text-align-left-xs"><?php echo $fieldCaption['caption'];?>:</div>
                                            <div class="col-md-8">
                                                    <input type="text" name="<?php echo $bvalue['fName'];?>" class="form-control" value="<?php echo $membersField[0];?>" id="weight">
                                            </div>                    
                                        </div>
                                    </div>
                                    <?php } } else if($bvalue['fType'] == 2){ ?>
                                    <div class="col-md-12">      
                                        
                                        <div class="row margin-top-10">
                                            <div class="col-md-12 titles-edit text-align-left-xs" style="text-align:left;"><?php echo $fieldCaption['caption'];?>:</div>
                                            <br/>
                                            <br/>
                                            <div class="col-md-12">
                                                <textarea name="<?php echo $bvalue['fName'];?>" id="<?php echo $bvalue['fName'];?>" class="form-control ckeditor" id="weight"><?php echo $membersField[0];?></textarea>
                                            </div>
                                            <script>
                                                // Replace the <textarea id="editor1"> with a CKEditor
                                                // instance, using default configuration.
                                                CKEDITOR.replace( '<?php echo $bvalue['fName'];?>' );
                                            </script>
                                    </div>
                                    </div>
                                    <?php }elseif($bvalue['fName'] != 'em_85820081128' && $bvalue['fName'] != 'country'){ ?>
                                    <div class="col-md-6">      
                                        <div class="row margin-top-10">
                                            <div class="col-md-4 titles-edit text-align-left-xs"><?php echo $fieldCaption['caption'];?>:</div>
                                            <div class="col-md-8">
                                                    <select name="<?php echo $bvalue['fName'];?>" class="form-control" id="weight">
                                                    <option value="0">------------------</option>
                                                    <?php foreach($mFieldValue as $key => $mflvalue): 
                                                        if($membersFieldValue[0] == $mflvalue['fvCaption']):
                                                            $checked = 'selected="selected"';
                                                            else:
                                                            $checked = '';
                                                        endif;
                                                    ?>
                                                    <option value="<?php echo $mflvalue['fvid'];?>" <?php echo $checked; ?>><?php echo $mflvalue['fvCaption'];?></option>
                                                    <?php endforeach; ?> 
                                                 </select>
                                            </div>                    
                                        </div>
                                    </div>
                                    <?php } ?>
                                
                                   
                                  
                            <?php  } ?>
                        <input type="hidden" name="uid" value="<?php echo $_REQUEST['mid']?>" />
                    </form>
                    <div class="col-md-12 text-right margin-top-10 MPSaveButton_<?php echo $group['id'];?>">
                        <a class="btn btn-default btn-circle-resp" href="javascript:void(0)" role="button" onclick="WLDMpSaveBasicProfileInfo('<?php echo $group['id'];?>')" title="Save"><i class="fa fa-check" aria-hidden="true"></i></a>
                                            <a class="btn btn-default btn-circle-resp" href="javascript:void(0)" role="button" onclick="WLDMpCancel('<?php echo $group['id'];?>')" title="Cancel"><i class="fa fa-close" aria-hidden="true"></i></a>
                    </div>
                </div>









                </div>
                <?php
                $counter++;
                }
            
                }

            ?>








      <div role="tabpanel" class="tab-pane fade" id="photovideo" aria-labelledby="photovideo-tab">
      <?php $photoGallery = WLDGetMemberMediaGalley($_REQUEST['mid'], 'photo', $_GET['market_id']); ?>
      <?php $videoGallery = WLDGetMemberMediaGalley($_REQUEST['mid'], 'video', $_GET['market_id']); ?>
      <h3>My Media</h3>
      <?php if(count($photoGallery) > 0):?>
    <h5>My photos </h5>
    <div class="row margin-top-10">
        <?php foreach($photoGallery as $photo):?>
      <a class="col-md-3" href="" data-lightbox="example-set" data-title="SF Bridge :)"><img class="img-responsive" src="<?php echo WLDGetMemberSiteUrl($_GET['market_id'],$_REQUEST['mid']);?>inc/tb.php?src=<?php echo $photo['bigimage']; ?>&x=250&y=250&uid=<?php echo $_REQUEST['mid']; ?>" title="<?php echo $photo['title']; ?>" alt="<?php echo $photo['title']; ?>"></a>
      <?php endforeach; ?>
    </div>
    <?php else:?>
            <div class="col-xs-12 margin-auto">Photos not found!!!</div>
    <?php endif; ?>
    <h5>My Video</h5>
    <div class="row margin-top-10">
     <?php if(count($videoGallery) > 0):?>
            <?php foreach($videoGallery as $video):?>
                <div class="col-xs-12 margin-auto"><img src="img/novideo.jpg" class="img-responsive"></div>
                <?php endforeach; ?>
    <?php else:?>
            <div class="col-xs-12 margin-auto">Videos not found!!!</div>
    <?php endif; ?>
    </div>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="personalinfo" aria-labelledby="personalinfo-tab">
              <div class="row margin-top-10">
                <div class="col-xs-12">
                    <h3>My Personal Info</h3>   
                </div>
                
                
                <div class="col-xs-8 col-xs-offset-2">
                    <div id="successprofile" style="display:none; color:#090; font-weight:bold;">Profile Updates Sucessfully!!!</div>
                    <form name="frmprofileinfo" id="frmprofileinfo" class="form-horizontal join-form text-left" method="post" action="">
                            <?php
                            $personalInfo = getBasicProfileInformation(2);
                            $i = 0; 
                                foreach($personalInfo as $key => $mvalue){
                                    $fieldCaption = WLDGetFieldCaption($mvalue['fid'],$mvalue['fType'],$_REQUEST['market_id']);
                                    $membersField = WLDGetMemberColumns($mvalue['fName'], $_REQUEST['mid'],$_REQUEST['market_id']);
                                    
                                    ?>
                                    <?php if($mvalue['fName'] == 'em_cxw20160112' || $mvalue['fName'] == 'em_p8p20160112' || $mvalue['fName'] == 'em_mu320160126'){?>
                                    <div class="form-group">
                                        <label for="name" class="col-sm-4 control-label"><?php echo $fieldCaption['caption'];?></label>
                                        <div class="col-sm-8">
                                        <input type="text" class="form-control" id="<?php echo $mvalue['fName'];?>" name="<?php echo $mvalue['fName'];?>" value="<?php echo $membersField[0];?>" placeholder="Sarah">
                                        </div>
                                    </div>
                                    <?php } $i++; } ?>
                    
                                
                              <div class="form-group">
                                <label for="inputEmail3" class="col-sm-4 control-label">Email</label>
                                <div class="col-sm-8">
                                  <input type="email" name="email" class="form-control" id="inputEmail3" value="<?php echo $memberData['email'];?>" placeholder="currentemail@something.com">
                                  <span class="font-size-10 text-muted">Please enter a working email address as this will be used to send password reminders and notifications of member correspondence and interest.</span>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-sm-4 control-label">Current Password</label>
                                <div class="col-sm-8" style="padding-top:7px;">
                                    1234xxxxx
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="enterpw" class="col-sm-4 control-label">New Password</label>
                                <div class="col-sm-8">
                                  <input type="password" name="password" class="form-control" id="enterpw">
                                  
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="inputPassword3" class="col-sm-4 control-label">Reenter New Password</label>
                                <div class="col-sm-8">
                                  <input type="password" name="repeat-password" class="form-control" id="inputPassword3">
                                  <span class="font-size-10 text-muted">New password will be saved only if you enter a new one and click save.</span>
                                </div>
                              </div>
                              
                              <div class="form-group">
                                <div class="col-sm-8 pull-right text-center">
                                  <button type="button" class="btn btn-default btnlogin" onclick="WLDMpSaveProfileInfo()">SAVE CHANGES</button>
                                </div>
                              </div>
                              <input type="hidden" name="uid" value="<?php echo $_GET['mid'];?>"
                    </form>
                </div>
              </div>
              
           
       </div>
        <div role="tabpanel" class="tab-pane fade" id="cupid" aria-labelledby="cupid-tab">
              <div class="row margin-top-10" id="questions-answered">
                <div class="col-lg-7 col-md-4">
                    <h3 class="hmargin-top-0">My Questions</h3>
                </div>
                <!--<div class="col-lg-5 col-md-8 text-right">
                    <a class="btn btn-sm btn-primary" href="javascript:void(0)" onClick="HideOneShowTwo('questions-answered', 'questions-not-answered')">Answer More Questions</a>&nbsp;<a class="btn btn-sm btn-primary" href="javascript:void(0)" onClick="">Clear All Answers</a>
                </div>-->
                <div class="col-xs-12">
                    <div class="panel-group margin-top-10" id="compquestions" role="tablist" aria-multiselectable="true">
                        <div class="row">
                            <div class="col-md-12">
                            
                            <?php
                        $okQuestion = getBasicProfileInformation(15);
                        //echo "<pre>";
                        //print_r($okQuestion);
                        foreach($okQuestion as $key => $okmvalue){
                            
                            $okfieldCaption = WLDGetFieldCaption($okmvalue['fid'],$okmvalue['fType'],$_REQUEST['market_id']);
                            $okmembersField = WLDGetMemberColumns($okmvalue['fName'], $_REQUEST['mid'],$_REQUEST['market_id']);
                            $okmembersFieldValue = WLDGetMemberColumnsValue($okmembersField[0],$_REQUEST['market_id']);
                            $okmFieldValue = WLDGetfieldValue($okmvalue['fid'],$_REQUEST['market_id']);
                            //echo "<pre>";
                            //print_r($okmFieldValue);
                            
                            ?>
                                <div class="panel panel-default" style="float:left; width:48%; margin-left:10px;">
                            <div class="panel-heading" id="heading-compquestion<?php echo $okmvalue['fid']; ?>">
                        <h5 class="panel-title">
                            <a role="button" class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#compquestions" href="#collapse-compquestion<?php echo $okmvalue['fid']; ?>" aria-expanded="false" aria-controls="collapse-compquestion<?php echo $okmvalue['fid']; ?>"><?php echo $okfieldCaption['caption']; ?></a>
                        </h5>
                      </div>
                            <div id="collapse-compquestion<?php echo $okmvalue['fid']; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-compquestion<?php echo $okmvalue['fid']; ?>" aria-expanded="false" style="height: 0px;">
                                <div class="panel-body">
                        <form id="okquestion<?php echo $okmvalue['fid']; ?>" name="okquestion<?php echo $okmvalue['fid']; ?>" method="post" action="">
                            <div class="row">
                            <div class="col-xs-8 col-xs-offset-2">
                            <?php foreach($okmFieldValue as $okmflvalue): 
                                                if($okmflvalue['fvid'] == $memberData[$okmvalue['fName']]):
                                                    $checked = 'checked';
                                                    else:
                                                    $checked = '';
                                                endif;
                                                ?>
                                <div class="radio">
                                          <label>
                                            <input type="radio" name="<?php echo $okmvalue['fName'] ?>" id="<?php echo $okmvalue['fName'] ?>" value="<?php echo $okmflvalue['fvid'];?>" <?php echo $checked; ?>>
                                            <?php echo $okmflvalue['fvCaption'];?>
                                            <input type="hidden" name="okvalue" value="<?php echo $okmvalue['fName'] ?>" />
                                            <input type="hidden" name="uid" value="<?php echo $_GET['mid'] ?>" />
                                          </label>
                                        </div>
                                <?php endforeach; ?>
                            </div>
                                
                            <div class="col-xs-12 text-right margin-top-10"><a role="button" class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#compquestions" href="#collapse-compquestion<?php echo $okmvalue['fid']; ?>" aria-expanded="false" aria-controls="collapse-compquestion<?php echo $okmvalue['fid']; ?>" onclick="WLDMpSaveOkQuestion('<?php echo $okmvalue['fid']; ?>')">Save Changes</a></div>
                        </div>
                        </form>
                      </div>
                            </div>
                          </div>  
                            <?php }?>    
                                
                            </div>
                            
                       </div>
                      </div>
                </div>
              </div>
 
        </div>
      </div>
    </div>
                             
                        </div>
                    </div>
                    
                    
                    
                </div>
            </div>
            
            
        </div>
        
        
        
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="inc/zebra/responsivetabs.js"></script>
<script src="inc/zebra/bootstrap.min.js"></script>
<script src="inc/zebra/bootstrap-select.min.js"></script>
