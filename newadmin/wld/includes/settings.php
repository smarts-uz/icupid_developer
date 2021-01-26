<?php
if(ADMIN_DEMO != "yes"){

    if(isset($_POST['do'])){ 

        
        switch ($_POST['do']) {

            case "site_settings": {
            
                $market_id = $_POST['market_id'];
                $site_id = $_POST['site_id'];

                $marketSites = getMarketSites( $market_id , $site_id );

                $site_condition = "";
                if($_POST['site_id'] != '0'){
                    $site_condition = " AND site_id = '".$_POST['site_id']."'";
                }
                else if(isset($_POST['change_sites']) && $_POST['change_sites'] == 'false'){
                    $site_condition = " AND site_id = '0'";
                }


                foreach ($marketSites as $marketSite) {
                    
                    $siteDetails = getMarketSiteSearchMemberSettings($marketSite['market'],$marketSite['wld_site_id']);
                    $site_url = $marketSite['site_url'];
                    $dpath = str_replace(array('http://','https://','www.','/'), '', $site_url);

                    $config = $_SERVER['DOCUMENT_ROOT'].'/'.$dpath.'/inc/config.php';
                    $config_db = $_SERVER['DOCUMENT_ROOT'].'/'.$dpath.'/inc/config_db.php'; 

                    if(!file_exists($config)){
                        
                        echo "<div class='wld-success-message' style='background: #FF0000;'>There was an error opening your <span>$config</span> file. Please make sure it exsits and is located in the <span>".$_SERVER['DOCUMENT_ROOT']."/".$dpath."/inc</span> directory</div>";
                
                    
                        continue;
                    }
                    if (!$file = fopen($config, 'a+b')) {
                        die("There was an error opening your config.php file. Please make sure it exsits and is located in the inc/ directory.");
                    } else if($_POST['site_id'] != '0' || (isset($_POST['change_sites']) && $_POST['change_sites'] == 'true')) {

                        $data = array();
                        $counter = 1;
                        $filecontent = "";
                        while (!feof($file)) {
                            $data[$counter] = fgets($file);
                            // check line and replace string

                            if ( strstr($data[$counter], "define('DATE_DISPLAY_FORMAT','")  && isset($_POST['zdate'])) {
                                
                                $filecontent .= "define('DATE_DISPLAY_FORMAT','".$_POST['zdate']."');\r\n";

                                //$filecontent .= str_replace("'DATE_DISPLAY_FORMAT','".$siteDetails['date_display_format']."'", "'DATE_DISPLAY_FORMAT','".$_POST['zdate']."'", $data[$counter]);

                            }
                            elseif ( strstr($data[$counter], "define('BLOCK_USERNAMES','") && isset($_POST['block_usernames']) ) {
                                
                                $filecontent .= "define('BLOCK_USERNAMES','".$_POST['block_usernames']."');\r\n";

                            }
                            elseif ( strstr($data[$counter], "define('MARKET_COMMISSION','") && isset($_POST['market_commission']) ) {
                                
                                $filecontent .= "define('MARKET_COMMISSION','".$_POST['market_commission']."');\r\n";
                                

                            }
                            elseif ( strstr($data[$counter], "define('D_MOD_WRITE','") && isset($_POST['seof']) ) {
                                
                                $filecontent .= "define('D_MOD_WRITE','".$_POST['seof']."');\r\n";
                            
                            }
                            elseif ( strstr($data[$counter], "define('D_FLAGS','") && isset($_POST['flag']) ) {
                                
                                $filecontent .= "define('D_FLAGS','".$_POST['flag']."');\r\n";
                            
                            }
                            elseif ( strstr($data[$counter], "define('D_CCTEXT','") && isset($_POST['cctext']) ) {
                                
                                $filecontent .= "define('D_CCTEXT','".$_POST['cctext']."');\r\n";
                            
                            }
                            elseif ( strstr($data[$counter], "define('AUTO_LOGIN','") && isset($_POST['auto_login']) ) {
                                
                                $filecontent .= "define('AUTO_LOGIN','".$_POST['auto_login']."');\r\n";
                            
                            }
                            elseif(strstr($data[$counter], "define('AUTO_AMOUNT','") && isset($_POST['auto_amount'])){
                                
                                $filecontent .= "define('AUTO_AMOUNT','".$_POST['auto_amount']."');\r\n";
                            
                            }
                            elseif(strstr($data[$counter], "define('AFF_CURRENCY','") && isset($_POST['wldcurrency'])){
                                
                                $filecontent .= "define('AFF_CURRENCY','".$_POST['wldcurrency']."');\r\n";
                            
                            }
                            
                                                        
                           /*if ( strstr($data[$counter], "'DATE_DISPLAY_FORMAT','".$siteDetails['date_display_format']."'") && isset($_POST['zdate']) ) {
                                
                                $filecontent .= str_replace("'DATE_DISPLAY_FORMAT','".$siteDetails['date_display_format']."'", "'DATE_DISPLAY_FORMAT','".$_POST['zdate']."'", $data[$counter]);
                            }*/
                           /* elseif ( strstr($data[$counter], "'BLOCK_USERNAMES','".$siteDetails['block_usernames']."'") && isset($_POST['block_usernames']) ) {
                                
                                $filecontent .= str_replace("'BLOCK_USERNAMES','".$siteDetails['block_usernames']."'", "'BLOCK_USERNAMES','".$_POST['block_usernames']."'", $data[$counter]);
                            }*/
                            /*elseif ( strstr($data[$counter], "'MARKET_COMMISSION','".$siteDetails['market_commission']."'") && isset($_POST['market_commission']) ) {
                                
                                $filecontent .= str_replace("'MARKET_COMMISSION','".$siteDetails['market_commission']."'", "'MARKET_COMMISSION','".$_POST['market_commission']."'", $data[$counter]);
                            
                            }*/
                            /*elseif ( strstr($data[$counter], "'D_MOD_WRITE','".$siteDetails['d_mod_write']."'") && isset($_POST['seof']) ) {
                                
                                $filecontent .= str_replace("'D_MOD_WRITE','".$siteDetails['d_mod_write']."'", "'D_MOD_WRITE','".$_POST['seof']."'", $data[$counter]);
                            
                            }*/
                            /*elseif ( strstr($data[$counter], "'D_FLAGS','".$siteDetails['d_flags']."'") && isset($_POST['flag']) ) {
                                
                                $filecontent .= str_replace("'D_FLAGS','".$siteDetails['d_flags']."'", "'D_FLAGS','".$_POST['flag']."'", $data[$counter]);
                            
                            }*/
                            /*elseif ( strstr($data[$counter], "'D_CCTEXT','".$siteDetails['d_cctext']."'") && isset($_POST['cctext']) ) {
                                
                                $filecontent .= str_replace("'D_CCTEXT','".$siteDetails['d_cctext']."'", "'D_CCTEXT','".$_POST['cctext']."'", $data[$counter]);
                            
                            }*/
                            /*elseif ( strstr($data[$counter], "'AUTO_LOGIN','".$siteDetails['auto_login']."'") && isset($_POST['auto_login']) ) {
                                
                                $filecontent .= str_replace("'AUTO_LOGIN','".$siteDetails['auto_login']."'", "'AUTO_LOGIN','".$_POST['auto_login']."'", $data[$counter]);
                            
                            }*/
                            /*elseif ( strstr($data[$counter], "'AUTO_AMOUNT','".$siteDetails['auto_amount']."'") && isset($_POST['auto_amount']) ) {
                                
                                $filecontent .= str_replace("'AUTO_AMOUNT','".$siteDetails['auto_amount']."'", "'AUTO_AMOUNT','".$_POST['auto_amount']."'", $data[$counter]);
                            
                            }
                             elseif ( strstr($data[$counter], "'AFF_CURRENCY','".$siteDetails['aff_currency']."'") && isset($_POST['wldcurrency']) ) {
                                
                                $filecontent .= str_replace("'AFF_CURRENCY','".$siteDetails['aff_currency']."'", "'AFF_CURRENCY','".$_POST['wldcurrency']."'", $data[$counter]);
                            
                            }*/
                            else{
                                $filecontent .= $data[$counter];
                            }      
                        $counter ++;
                    }   
                    fclose($file);

                    //now we have to write in all the new data to this file
                    if (!$handle = fopen($config, 'w')) { 
                        echo "Cannot open file ($config)"; 
                        exit; 
                    }
                    // Write $somecontent to our opened file. 
                    if (fwrite($handle, $filecontent) === FALSE) { 
                        echo "Cannot write to file ($config)"; 
                        exit; 
                    } 
                    fclose($handle);
                    
                    
                    }
                     
                }

                 $DB->Update("UPDATE wld_site_search_membership_file_settings SET date_display_format = '".$_POST['zdate']."',block_usernames = '".$_POST['block_usernames']."',market_commission = '".$_POST['market_commission']."',d_mod_write = '".$_POST['seof']."',d_flags = '".$_POST['flag']."',d_cctext = '".$_POST['cctext']."',auto_login = '".$_POST['auto_login']."',auto_amount = '".$_POST['auto_amount']."',aff_currency = '".$_POST['wldcurrency']."' WHERE market_id = '".$_POST['market_id']."' $site_condition");
                
               

                echo '<div id="messages" class="wld-success-message">Site setting has been updated successfully.</div>';

            }break;
            case "search_settings": {

                $market_id = $_POST['market_id'];
                $site_id = $_POST['site_id'];

                $marketSites = getMarketSites( $market_id , $site_id );
       

                $site_condition = "";
                if($_POST['site_id'] != '0'){
                    $site_condition = " AND site_id = '".$_POST['site_id']."'";
                }
                else if(isset($_POST['change_sites']) && $_POST['change_sites'] == 'false'){
                    $site_condition = " AND site_id = '0'";
                }
                
                foreach ($marketSites as $marketSite) {
                    
                    $siteDetails = getMarketSiteSearchMemberSettings($marketSite['market'],$marketSite['wld_site_id']);
                    $site_url = $marketSite['site_url'];
                    $dpath = str_replace(array('http://','https://','www.','/'), '', $site_url);

                    $config = $_SERVER['DOCUMENT_ROOT'].'/'.$dpath.'/inc/config.php';
                    $config_db = $_SERVER['DOCUMENT_ROOT'].'/'.$dpath.'/inc/config_db.php'; 

                    if(!file_exists($config)){
                        
                        echo "<div class='wld-success-message' style='background: #FF0000;'>There was an error opening your <span>$config</span> file. Please make sure it exsits and is located in the <span>".$_SERVER['DOCUMENT_ROOT']."/".$dpath."/inc</span> directory</div>";
                
                    
                        continue;
                    }
                    if (!$file = fopen($config, 'a+b')) {
                        die("There was an error opening your config.php file. Please make sure it exsits and is located in the inc/ directory.");
                    } else if(isset($_POST['write_market_sites']) && $_POST['write_market_sites'] == 'yes' || $site_id != '0') {

                        $data = array();
                        $counter = 1;
                        $filecontent = "";
                        while (!feof($file)) {
                            $data[$counter] = fgets($file);
                            // check line and replace string
                                                        
                            if(strstr($data[$counter], "define('SEARCH_PAGE_DISPLAY','") && isset($_POST['search_view'])){
                                
                                $filecontent .= "define('SEARCH_PAGE_DISPLAY','".$_POST['search_view']."');\r\n";
                            
                            }
                            elseif(strstr($data[$counter], "define('SEARCH_PAGE_ROWS','") && isset($_POST['searchrows'])){
                                
                                $filecontent .= "define('SEARCH_PAGE_ROWS','".$_POST['searchrows']."');\r\n";
                            
                            }
                            elseif(strstr($data[$counter], "define('SEARCH_WITHOUT_PICS','") && isset($_POST['nophoto'])){
                                
                                $filecontent .= "define('SEARCH_WITHOUT_PICS','".$_POST['nophoto']."');\r\n";
                            
                            }
                            elseif(strstr($data[$counter], "define('MATCH_PAGE_ROWS','") && isset($_POST['matchrows'])){
                                
                                $filecontent .= "define('MATCH_PAGE_ROWS','".$_POST['matchrows']."');\r\n";
                            
                            }

                           /*if ( strstr($data[$counter], "'SEARCH_PAGE_DISPLAY','".$siteDetails['search_page_display']."'") && isset($_POST['search_view']) ) {
                                
                                $filecontent .= str_replace("'SEARCH_PAGE_DISPLAY','".$siteDetails['search_page_display']."'", "'SEARCH_PAGE_DISPLAY','".$_POST['search_view']."'", $data[$counter]);
                            }*/
                            /*elseif ( strstr($data[$counter], "'SEARCH_PAGE_ROWS','".$siteDetails['search_page_rows']."'") && isset($_POST['searchrows']) ) {
                                
                                $filecontent .= str_replace("'SEARCH_PAGE_ROWS','".$siteDetails['search_page_rows']."'", "'SEARCH_PAGE_ROWS','".$_POST['searchrows']."'", $data[$counter]);
                            }
                            elseif ( strstr($data[$counter], "'SEARCH_WITHOUT_PICS','".$siteDetails['search_without_pics']."'") && isset($_POST['nophoto']) ) {
                                
                                $filecontent .= str_replace("'SEARCH_WITHOUT_PICS','".$siteDetails['search_without_pics']."'", "'SEARCH_WITHOUT_PICS','".$_POST['nophoto']."'", $data[$counter]);
                            
                            }*/
                           /* elseif ( strstr($data[$counter], "'MATCH_PAGE_ROWS','".$siteDetails['match_page_rows']."'") && isset($_POST['matchrows']) ) {
                                
                                $filecontent .= str_replace("'MATCH_PAGE_ROWS','".$siteDetails['match_page_rows']."'", "'MATCH_PAGE_ROWS','".$_POST['matchrows']."'", $data[$counter]);
                            
                            }*/
                            else{
                                $filecontent .= $data[$counter];
                            }      
                        $counter ++;
                    }   
                    fclose($file);

                    //now we have to write in all the new data to this file
                    if (!$handle = fopen($config, 'w')) { 
                        echo "Cannot open file ($config)"; 
                        exit; 
                    }
                    // Write $somecontent to our opened file. 
                    if (fwrite($handle, $filecontent) === FALSE) { 
                        echo "Cannot write to file ($config)"; 
                        exit; 
                    } 
                    fclose($handle);
                    
                    
                    }
                     
                }

                $DB->Update("UPDATE wld_site_search_membership_file_settings SET search_page_display = '".$_POST['search_view']."',search_page_rows = '".$_POST['searchrows']."',search_without_pics = '".$_POST['nophoto']."',match_page_rows = '".$_POST['matchrows']."' WHERE market_id = '".$_POST['market_id']."' $site_condition");
                
               

                echo '<div id="messages" class="wld-success-message">Search setting has been updated successfully.</div>';
              
            }break;

            case "settings_file_paths": {

                $market_id = $_POST['market_id'];
                $site_id = $_POST['site_id'];

                $marketSites = getMarketSites( $market_id , $site_id );
       

                $site_condition = "";
                if($_POST['site_id'] != '0'){
                $site_condition = " AND site_id = '".$_POST['site_id']."'";
                }
                else if(isset($_POST['change_sites']) && $_POST['change_sites'] == 'false'){
                    $site_condition = " AND site_id = '0'";
                }

                foreach ($marketSites as $marketSite) {
                    
                    $siteDetails = getMarketSiteSearchMemberSettings($marketSite['market'],$marketSite['wld_site_id']);
                    $site_url = $marketSite['site_url'];
                    $dpath = str_replace(array('http://','https://','www.','/'), '', $site_url);

                    $config = $_SERVER['DOCUMENT_ROOT'].'/'.$dpath.'/inc/config.php';
                    $config_db = $_SERVER['DOCUMENT_ROOT'].'/'.$dpath.'/inc/config_db.php'; 

                    if(!file_exists($config)){
                        
                        echo "<div class='wld-success-message' style='background: #FF0000;'>There was an error opening your <span>$config</span> file. Please make sure it exsits and is located in the <span>".$_SERVER['DOCUMENT_ROOT']."/".$dpath."/inc</span> directory</div>";
                
                    
                        continue;
                    }
                    if (!$file = fopen($config, 'a+b')) {
                        die("There was an error opening your config.php file. Please make sure it exsits and is located in the inc/ directory.");
                    } else if((isset($_POST['write_market_sites']) && $_POST['write_market_sites'] == 'yes') || $_POST['site_id'] != '0' || (isset($_POST['change_sites']) && $_POST['change_sites'] == 'true')){

                        $data = array();
                        $counter = 1;
                        $filecontent = "";
                        while (!feof($file)) {
                            $data[$counter] = fgets($file);
                            // check line and replace string


                            if(strstr($data[$counter], "define('PATH_FILES','") && isset($_POST['pa0'])){
                                
                                $filecontent .= "define('PATH_FILES','".$_POST['pa0']."');\r\n";
                                $path_files = $_POST['pa0'];
                            
                            }
                            elseif(strstr($data[$counter], "define('PATH_IMAGE','") && isset($_POST['pa1'])){
                                
                                $filecontent .= "define('PATH_IMAGE','".$_POST['pa1']."');\r\n";
                                $path_image = $_POST['pa1'];
                            
                            }
                            elseif(strstr($data[$counter], "define('PATH_IMAGE_THUMBS','") && isset($_POST['pa2'])){
                                
                                $filecontent .= "define('PATH_IMAGE_THUMBS','".$_POST['pa2']."');\r\n";
                                
                                $path_image_thumbs = $_POST['pa2'];
                            }
                            elseif(strstr($data[$counter], "define('PATH_VIDEO','") && isset($_POST['pa3'])){
                                
                                $filecontent .= "define('PATH_VIDEO','".$_POST['pa3']."');\r\n";
                                
                                $path_video = $_POST['pa3'];

                            }

                            elseif(strstr($data[$counter], "define('PATH_MUSIC','") && isset($_POST['pa4'])){
                                
                                $filecontent .= "define('PATH_MUSIC','".$_POST['pa4']."');\r\n";
                                
                                $path_music = $_POST['pa4'];

                            }

                            elseif(strstr($data[$counter], "define('WEB_PATH_IMAGE','") && isset($_POST['p1'])){
                                
                                $filecontent .= "define('WEB_PATH_IMAGE','".$_POST['p1']."');\r\n";
                                
                                $web_path_image = $_POST['p1'];

                            }

                            elseif(strstr($data[$counter], "define('WEB_PATH_IMAGE_THUMBS','") && isset($_POST['p2'])){
                                
                                $filecontent .= "define('WEB_PATH_IMAGE_THUMBS','".$_POST['p2']."');\r\n";
                                
                                $web_path_image_thumbs = $_POST['p2'];

                            }

                            elseif(strstr($data[$counter], "define('WEB_PATH_VIDEO','") && isset($_POST['p3'])){
                                
                                $filecontent .= "define('WEB_PATH_VIDEO','".$_POST['p3']."');\r\n";
                                
                                $web_path_video = $_POST['p3'];

                            }

                            elseif(strstr($data[$counter], "define('WEB_PATH_MUSIC','") && isset($_POST['p4'])){
                                
                                $filecontent .= "define('WEB_PATH_MUSIC','".$_POST['p4']."');\r\n";
                                
                                $web_path_music = $_POST['p4'];

                            }

                            elseif(strstr($data[$counter], "define('WEB_PATH_FILES','") && isset($_POST['p0'])){
                                
                                $filecontent .= "define('WEB_PATH_FILES','".$_POST['p0']."');\r\n";
                                
                                $web_path_files = $_POST['p0'];

                            }

                            else{
                            
                                $filecontent .= $data[$counter];
                            
                            }
                              
                        $counter ++;
                    }   
                    fclose($file);

                     //now we have to write in all the new data to this file
                    if (!$handle = fopen($config, 'w')) { 
                        echo "Cannot open file ($config)"; 
                        exit; 
                    }
                    // Write $somecontent to our opened file. 
                    if (fwrite($handle, $filecontent) === FALSE) { 
                        echo "Cannot write to file ($config)"; 
                        exit; 
                    } 
                    fclose($handle);
                    }
                   
                
                }

                $path_files = (isset($path_files)) ? $path_files : $siteDetails['file_storage_server_path'];
                $path_image = (isset($path_image)) ? $path_image : $siteDetails['photo_storage_server_path'];
                $path_image_thumbs = (isset($path_image_thumbs)) ? $path_image_thumbs : $siteDetails['thumb_storage_server_path'];
                $path_video = (isset($path_video)) ? $path_video : $siteDetails['video_storage_server_path'];
                $path_music = (isset($path_music)) ? $path_music : $siteDetails['music_storage_server_path'];
                $web_path_image = (isset($web_path_image)) ? $web_path_image : $siteDetails['photo_storage_web_path'];
                $web_path_image_thumbs = (isset($web_path_image_thumbs)) ? $web_path_image_thumbs : $siteDetails['thumb_storage_web_path'];
                $web_path_video = (isset($web_path_video)) ? $web_path_video : $siteDetails['video_storage_web_path'];
                $web_path_music = (isset($web_path_music)) ? $web_path_music : $siteDetails['music_storage_web_path'];
                $web_path_files = (isset($web_path_files)) ? $web_path_files : $siteDetails['file_storage_web_path'];

                $DB->Update("UPDATE wld_site_search_membership_file_settings SET file_storage_server_path = '$path_files',photo_storage_server_path = '$path_image',thumb_storage_server_path = '$path_image_thumbs',video_storage_server_path = '$path_video',music_storage_server_path = '$path_music',photo_storage_web_path = '$web_path_image',thumb_storage_web_path = '$web_path_image_thumbs',video_storage_web_path = '$web_path_video',music_storage_web_path = '$web_path_music',file_storage_web_path = '$web_path_files' WHERE market_id = '".$_POST['market_id']."' $site_condition");
                
                echo '<div id="messages" class="wld-success-message">File paths has been updated successfully.</div>';
            
            }break;

            case "settings_membership": {

                $market_id = $_POST['market_id'];
                $site_id = $_POST['site_id'];

                $marketSites = getMarketSites( $market_id , $site_id );
       

                $site_condition = "";
                if($_POST['site_id'] != '0'){
                $site_condition = " AND site_id = '".$_POST['site_id']."'";
                }
                else if(isset($_POST['change_sites']) && $_POST['change_sites'] == 'false'){
                    $site_condition = " AND site_id = '0'";
                }

                foreach ($marketSites as $marketSite) {
                    
                    $siteDetails = getMarketSiteSearchMemberSettings($marketSite['market'],$marketSite['wld_site_id']);
                    $site_url = $marketSite['site_url'];
                    $dpath = str_replace(array('http://','https://','www.','/'), '', $site_url);

                    $config = $_SERVER['DOCUMENT_ROOT'].'/'.$dpath.'/inc/config.php';
                    $config_db = $_SERVER['DOCUMENT_ROOT'].'/'.$dpath.'/inc/config_db.php'; 

                    if(!file_exists($config)){
                        
                        echo "<div class='wld-success-message' style='background: #FF0000;'>There was an error opening your <span>$config</span> file. Please make sure it exsits and is located in the <span>".$_SERVER['DOCUMENT_ROOT']."/".$dpath."/inc</span> directory</div>";
                
                    
                        continue;
                    }
                    if (!$file = fopen($config, 'a+b')) {
                        die("There was an error opening your config.php file. Please make sure it exsits and is located in the inc/ directory.");
                    } else if((isset($_POST['write_market_sites']) && $_POST['write_market_sites'] == 'yes') || $_POST['site_id'] != '0' || (isset($_POST['change_sites']) && $_POST['change_sites'] == 'true')){

                        $data = array();
                        $counter = 1;
                        $filecontent = "";
                        while (!feof($file)) {
                            $data[$counter] = fgets($file);
                            // check line and replace string

                            if(strstr($data[$counter], "define('D_STATUSMSG','") && isset($_POST['ssmsg'])){
                                
                                $filecontent .= "define('D_STATUSMSG','".$_POST['ssmsg']."');\r\n";
                                
                            }
                            elseif ( strstr($data[$counter], "define('D_FREE','") && isset($_POST['free'])){
                                
                                $filecontent .= "define('D_FREE','".$_POST['free']."');\r\n";
                            
                            }
                            elseif ( strstr($data[$counter], "define('DEFAULT_PACKAGE','") && isset($_POST['mid'])){
                                
                                $filecontent .= "define('DEFAULT_PACKAGE','".$_POST['mid']."');\r\n";
                            
                            }
                            elseif ( strstr($data[$counter], "define('D_MUST_UPGRADE','") && isset($_POST['mustupgrade'])){
                                
                                $filecontent .= "define('D_MUST_UPGRADE','".$_POST['mustupgrade']."');\r\n";
                            
                            }
                            elseif ( strstr($data[$counter], "define('ENABLE_ADULTCONTENT','") && isset($_POST['eadult'])){
                                
                                $filecontent .= "define('ENABLE_ADULTCONTENT','".$_POST['eadult']."');\r\n";

                            }
                            
                            elseif ( strstr($data[$counter], "define('D_GENDERMATCHING','") && isset($_POST['egender'])){
                                
                                $filecontent .= "define('D_GENDERMATCHING','".$_POST['egender']."');\r\n";

                            }

                            elseif ( strstr($data[$counter], "define('MUST_HAVE_IMAGE','") && isset($_POST['must'])){
                                
                                $filecontent .= "define('MUST_HAVE_IMAGE','".$_POST['must']."');\r\n";

                            }

                            elseif ( strstr($data[$counter], "define('VALIDATE_EMAIL','") && isset($_POST['valemail'])){
                                
                                $filecontent .= "define('VALIDATE_EMAIL','".$_POST['valemail']."');\r\n";

                            }

                            elseif ( strstr($data[$counter], "define('APPROVE_ACCOUNTS','") && isset($_POST['appmem'])){
                                
                                $filecontent .= "define('APPROVE_ACCOUNTS','".$_POST['appmem']."');\r\n";

                            }

                            elseif ( strstr($data[$counter], "define('APPROVE_FILES','") && isset($_POST['files'])){
                                
                                $filecontent .= "define('APPROVE_FILES','".$_POST['files']."');\r\n";

                            }
                            else{
                            
                                $filecontent .= $data[$counter];
                            
                            }
                              
                        $counter ++;
                    }   
                    fclose($file);

                     //now we have to write in all the new data to this file
                    if (!$handle = fopen($config, 'w')) { 
                        echo "Cannot open file ($config)"; 
                        exit; 
                    }
                    // Write $somecontent to our opened file. 
                    if (fwrite($handle, $filecontent) === FALSE) { 
                        echo "Cannot write to file ($config)"; 
                        exit; 
                    } 
                    fclose($handle);
                    }
                   
                
                }
                $_POST['mid'] = (isset($_POST['mid'])) ? $_POST['mid'] : 0;
                $_POST['mustupgrade'] = (isset($_POST['mustupgrade'])) ? $_POST['mustupgrade'] : 'no';
                $_POST['eadult'] = (isset($_POST['eadult'])) ? $_POST['eadult'] : 'no';
                $DB->Update("UPDATE wld_site_search_membership_file_settings SET d_statusmsg = '".$_POST['ssmsg']."',d_free = '".$_POST['free']."',default_package = '".$_POST['mid']."',d_must_upgrade = '".$_POST['mustupgrade']."',enable_adultcontent = '".$_POST['eadult']."',d_gendermatching = '".$_POST['egender']."',must_have_image = '".$_POST['must']."',validate_email = '".$_POST['valemail']."',approve_accounts = '".$_POST['appmem']."',approve_files = '".$_POST['files']."' WHERE market_id = '".$_POST['market_id']."' $site_condition");
                
                if(isset($_POST['ratingreset']) && $_POST['ratingreset'] == 'yes'){
                    

                    $market = getMarket($market_id);

                    $dbh = new PDO('mysql:host='.$market['market_database_path'].';dbname='.$market['market_database_name'].';charset=utf8mb4', $market['market_database_username'], $market['market_database_password']);
                    

                    if($site_id != '0'){
                        $sql = "UPDATE members SET member_rating =0 WHERE site_id = '".$site_id."'";
                    }
                    else{
                        $sql = "UPDATE members SET member_rating =0";

                    }
                    
                    $stmt = $dbh->prepare($sql);
                                                              
                    $stmt->execute();
                    //$DB->Update("UPDATE members SET member_rating =0");
                    //$DB->Update("TRUNCATE TABLE `member_rating`");

                }
               

                echo '<div id="messages" class="wld-success-message">Membership setting has been updated successfully.</div>';
            
            }break;

            case "email_settings": {       

                $market_id = $_POST['market_id'];
                $site_id = $_POST['site_id'];
                $do_section = (isset($_POST['do_section'])) ? $_POST['do_section'] : '';
                $marketSites = getMarketSites( $market_id , $site_id );
                

                $site_condition = "";
                if($_POST['site_id'] != '0'){
                $site_condition = " AND site_id = '".$_POST['site_id']."'";
                }
                else if(isset($_POST['change_sites']) && $_POST['change_sites'] == 'false'){
                    $site_condition = " AND site_id = '0'";
                }

                foreach ($marketSites as $marketSite) {
                    
                    $siteDetails = getMarketSiteSearchMemberSettings($marketSite['market'],$marketSite['wld_site_id']);
                    $site_url = $marketSite['site_url'];
                    $dpath = str_replace(array('http://','https://','www.','/'), '', $site_url);

                    $config = $_SERVER['DOCUMENT_ROOT'].'/'.$dpath.'/inc/config.php';
                    $config_db = $_SERVER['DOCUMENT_ROOT'].'/'.$dpath.'/inc/config_db.php'; 

                    if(!file_exists($config)){
                        
                        echo "<div class='wld-success-message' style='background: #FF0000;'>There was an error opening your <span>$config</span> file. Please make sure it exsits and is located in the <span>".$_SERVER['DOCUMENT_ROOT']."/".$dpath."/inc</span> directory</div>";
                
                    
                        continue;
                    }
                    if (!$file = fopen($config, 'a+b')) {
                        die("There was an error opening your config.php file. Please make sure it exsits and is located in the inc/ directory.");
                    } else if($_POST['site_id'] != '0' || (isset($_POST['change_sites']) && $_POST['change_sites'] == 'true')){

                        $data = array();
                        $counter = 1;
                        $filecontent = "";
                        if($do_section == 'email_client_settings'){

                                               
                        while (!feof($file)) {
                            $data[$counter] = fgets($file);
                            // check line and replace string
                            
                            if ( strstr($data[$counter], "define('USE_SMTP','") && isset($_POST['emailclient'])){
                                $filecontent .= "define('USE_SMTP','".$_POST['emailclient']."');\r\n";
                            }

                            elseif ( strstr($data[$counter], "define('SMTP_SERVER','") && isset($_POST['smtp1'])){
                                $filecontent .= "define('SMTP_SERVER','".$_POST['smtp1']."');\r\n";
                            }

                            elseif ( strstr($data[$counter], "define('SMTP_PORT','") && isset($_POST['smtp2'])){

                                $filecontent .= "define('SMTP_PORT','".$_POST['smtp2']."');\r\n";
                        
                            }
                            elseif ( strstr($data[$counter], "define('SMTP_FROM_NAME','") && isset($_POST['smtp3'])){
                                    
                                $filecontent .= "define('SMTP_FROM_NAME','".$_POST['smtp3']."');\r\n";
                       
                            }
                            elseif ( strstr($data[$counter], "define('SMTP_USERNAME','") && isset($_POST['smtp4'])){
                                    
                                $filecontent .= "define('SMTP_USERNAME','".$_POST['smtp4']."');\r\n";
                       
                            }
                            elseif ( strstr($data[$counter], "define('SMTP_PASSWORD','") && isset($_POST['smtp5'])){
                                    
                                $filecontent .= "define('SMTP_PASSWORD','".$_POST['smtp5']."');\r\n";
                       
                            }
                           
                            else{
                            
                                $filecontent .= $data[$counter];
                            
                            }
                              
                        $counter ++;
                        }

                    fclose($file);

                     //now we have to write in all the new data to this file
                    if (!$handle = fopen($config, 'w')) { 
                        echo "Cannot open file ($config)"; 
                        exit; 
                    }
                    // Write $somecontent to our opened file. 
                    if (fwrite($handle, $filecontent) === FALSE) { 
                        echo "Cannot write to file ($config)"; 
                        exit; 
                    } 
                    fclose($handle);

                    $use_smtp = (isset($_POST['emailclient'])) ? $_POST['emailclient'] : $siteDetails['use_smtp'];
                    $smtp_server = (isset($_POST['smtp1'])) ? $_POST['smtp1'] : $siteDetails['smtp_server'];
                    $smtp_port = (isset($_POST['smtp2'])) ? $_POST['smtp2'] : $siteDetails['smtp_port'];
                    $smtp_from_name = (isset($_POST['smtp3'])) ? $_POST['smtp3'] : $siteDetails['smtp_from_name'];
                    $smtp_username = (isset($_POST['smtp4'])) ? $_POST['smtp4'] : $siteDetails['smtp_username']; 
                    $smtp_password = (isset($_POST['smtp5'])) ? $_POST['smtp5'] : $siteDetails['smtp_password']; 

                    $DB->Update("UPDATE wld_site_search_membership_file_settings SET use_smtp = '".$use_smtp."',smtp_server = '".$smtp_server."',smtp_port = '".$smtp_port."',smtp_from_name = '".$smtp_from_name."',smtp_username = '".$smtp_username."',smtp_password = '".$smtp_password."' WHERE market_id = '".$_POST['market_id']."' $site_condition");
                
                    
                    }
                    else if($do_section == 'semail_settings'){

                                               
                        while (!feof($file)) {
                            $data[$counter] = fgets($file);
                            // check line and replace string
                            

                            if ( strstr($data[$counter], "define('SEMAIL_JOIN','") && isset($_POST['sjoin'])){
                                $filecontent .= "define('SEMAIL_JOIN','".$_POST['sjoin']."');\r\n";
                            }
                            elseif ( strstr($data[$counter], "define('SEMAIL_UPDATE','") && isset($_POST['supdate'])){
                                $filecontent .= "define('SEMAIL_UPDATE','".$_POST['supdate']."');\r\n";
                            }
                            elseif ( strstr($data[$counter], "define('SEMAIL_FILES','") && isset($_POST['sfiles'])){
                                $filecontent .= "define('SEMAIL_FILES','".$_POST['sfiles']."');\r\n";
                            }
                            elseif ( strstr($data[$counter], "define('SEMAIL_GROUPS','") && isset($_POST['sgroups'])){
                                $filecontent .= "define('SEMAIL_GROUPS','".$_POST['sgroups']."');\r\n";
                            }
                            elseif ( strstr($data[$counter], "define('SEMAIL_CLASSADS','") && isset($_POST['semail_classads'])){
                                $filecontent .= "define('SEMAIL_CLASSADS','".$_POST['semail_classads']."');\r\n";
                            }
                            elseif ( strstr($data[$counter], "define('SEMAIL_BLOG','") && isset($_POST['sblog'])){
                                $filecontent .= "define('SEMAIL_BLOG','".$_POST['sblog']."');\r\n";
                            }
                            elseif ( strstr($data[$counter], "define('SEMAIL_FORUM','") && isset($_POST['sforum'])){
                                $filecontent .= "define('SEMAIL_FORUM','".$_POST['sforum']."');\r\n";
                            }
                            elseif ( strstr($data[$counter], "define('SEMAIL_LOGIN','") && isset($_POST['slogin'])){
                                $filecontent .= "define('SEMAIL_LOGIN','".$_POST['slogin']."');\r\n";
                            }
                            elseif ( strstr($data[$counter], "define('SEMAIL_TEMPLATE','") && isset($_POST['newid'])){
                                $filecontent .= "define('SEMAIL_TEMPLATE','".$_POST['newid']."');\r\n";
                            }
                           
                            else{
                                $filecontent .= $data[$counter];
                            }

                        $counter ++;
                        }

                    fclose($file);

                     //now we have to write in all the new data to this file
                    if (!$handle = fopen($config, 'w')) { 
                        echo "Cannot open file ($config)"; 
                        exit; 
                    }
                    // Write $somecontent to our opened file. 
                    if (fwrite($handle, $filecontent) === FALSE) { 
                        echo "Cannot write to file ($config)"; 
                        exit; 
                    } 
                    fclose($handle);

                    $semail_join = (isset($_POST['sjoin'])) ? $_POST['sjoin'] : $siteDetails['semail_join'];
                    $semail_update = (isset($_POST['supdate'])) ? $_POST['supdate'] : $siteDetails['semail_update'];
                    $semail_files = (isset($_POST['sfiles'])) ? $_POST['sfiles'] : $siteDetails['semail_files'];
                    $semail_groups = (isset($_POST['sgroups'])) ? $_POST['sgroups'] : $siteDetails['semail_groups'];
                    $semail_classads = (isset($_POST['sclassads'])) ? $_POST['sclassads'] : $siteDetails['semail_classads'];
                    $semail_blog = (isset($_POST['sblog'])) ? $_POST['sblog'] : $siteDetails['semail_blog'];
                    $semail_forum = (isset($_POST['sforum'])) ? $_POST['sforum'] : $siteDetails['semail_forum'];
                    $semail_login = (isset($_POST['slogin'])) ? $_POST['slogin'] : $siteDetails['semail_login'];
                    $semail_template = (isset($_POST['newid'])) ? $_POST['newid'] : $siteDetails['semail_template'];

                    $DB->Update("UPDATE wld_site_search_membership_file_settings SET semail_join = '".$semail_join."',semail_update = '".$semail_update."',semail_files = '".$semail_files."',semail_groups = '".$semail_groups."',semail_classads = '".$semail_classads."',semail_blog = '".$semail_blog."',semail_forum = '".$semail_forum."',semail_login = '".$semail_login."',semail_template = '".$semail_template."' WHERE market_id = '".$_POST['market_id']."' $site_condition");
                
                    
                    }


                    }
                    else{
                        $use_smtp = (isset($_POST['emailclient'])) ? $_POST['emailclient'] : $siteDetails['use_smtp'];
                        $smtp_server = (isset($_POST['smtp1'])) ? $_POST['smtp1'] : $siteDetails['smtp_server'];
                        $smtp_port = (isset($_POST['smtp2'])) ? $_POST['smtp2'] : $siteDetails['smtp_port'];
                        $smtp_from_name = (isset($_POST['smtp3'])) ? $_POST['smtp3'] : $siteDetails['smtp_from_name'];
                        $smtp_username = (isset($_POST['smtp4'])) ? $_POST['smtp4'] : $siteDetails['smtp_username']; 
                        $smtp_password = (isset($_POST['smtp5'])) ? $_POST['smtp5'] : $siteDetails['smtp_password']; 

                        $DB->Update("UPDATE wld_site_search_membership_file_settings SET use_smtp = '".$use_smtp."',smtp_server = '".$smtp_server."',smtp_port = '".$smtp_port."',smtp_from_name = '".$smtp_from_name."',smtp_username = '".$smtp_username."',smtp_password = '".$smtp_password."' WHERE market_id = '".$_POST['market_id']."' $site_condition");
                    
                        
                    }
                   
                    echo '<div id="messages" class="wld-success-message">Email settings has been updated successfully.</div>';
                }
            
            }break;

            case "settings_thumbnails": {
                
                $market_id = $_POST['market_id'];
                $site_id = $_POST['site_id'];
                $marketSites = getMarketSites( $market_id , $site_id );
                

                $site_condition = "";
                if($_POST['site_id'] != '0'){
                $site_condition = " AND site_id = '".$_POST['site_id']."'";
                }
                else if(isset($_POST['change_sites']) && $_POST['change_sites'] == 'false'){
                    $site_condition = " AND site_id = '0'";
                }

                foreach ($marketSites as $marketSite) {

                    $siteDetails = getMarketSiteSearchMemberSettings($marketSite['market'],$marketSite['wld_site_id']);
                    $site_url = $marketSite['site_url'];
                    $dpath = str_replace(array('http://','https://','www.','/'), '', $site_url);

                    $config = $_SERVER['DOCUMENT_ROOT'].'/'.$dpath.'/inc/config.php';
                    $config_db = $_SERVER['DOCUMENT_ROOT'].'/'.$dpath.'/inc/config_db.php'; 

                    $web_path_file = $_SERVER['DOCUMENT_ROOT'].'/'.str_replace(array('http://','https://','www.'), '', $siteDetails['file_storage_web_path']);

                    // CHECK FOR UPLOADS
                    if(strlen($_FILES['t3_file']['tmp_name']) > 5){
                        $copy = copy($_FILES['t3_file']['tmp_name'], $web_path_file.$_FILES['t3_file']['name']);            
                        if($copy){$T3=$_FILES['t3_file']['name'];}else{ $T3=""; }
                    }
                    if(strlen($_FILES['t4_file']['tmp_name']) > 5){                 
                        $copy = copy($_FILES['t4_file']['tmp_name'], $web_path_file.$_FILES['t4_file']['name']);            
                        if($copy){$T4=$_FILES['t4_file']['name'];}else{ $T4=""; }
                    }
                    if(strlen($_FILES['t5_file']['tmp_name']) > 5){                 
                        $copy = copy($_FILES['t5_file']['tmp_name'], $web_path_file.$_FILES['t5_file']['name']);            
                        if($copy){$T5=$_FILES['t5_file']['name'];}else{ $T5=""; }
                    }

                    if(strlen($_FILES['t6_file']['tmp_name']) > 5){                 
                        $copy = copy($_FILES['t6_file']['tmp_name'], $web_path_file.$_FILES['t6_file']['name']);            
                        if($copy){$T6=$_FILES['t6_file']['name'];}else{ $T6=""; }
                    }


                    if (!$file = fopen($config_db, 'a+b')) {
                        die("There was an error opening your config.php file. Please make sure it exsits and is located in the inc/ directory.");
                    } else {
                        
                        $data = array();
                        $counter = 1;
                        $filecontent = "";
                        while (!feof($file)) {
                            $data[$counter] = fgets($file);
                            // check line and replace string
                                                        
                                
                            if ( strstr($data[$counter], "'DEFAULT_IMAGE','".$siteDetails['default_image']."'") && isset($T3) && $T3 !="") {
                                
                                $filecontent .= str_replace("'DEFAULT_IMAGE','".$siteDetails['default_image']."'", "'DEFAULT_IMAGE','".$T3."'", $data[$counter]);
                            }
                            elseif ( strstr($data[$counter], "'DEFAULT_IMAGE_ADULT','".$siteDetails['default_image_adult']."'") && isset($T4) && $T4 !="" ) {
                                
                                $filecontent .= str_replace("'DEFAULT_IMAGE_ADULT','".$siteDetails['default_image_adult']."'", "'DEFAULT_IMAGE_ADULT','".$T4."'", $data[$counter]);
                            }
                            elseif ( strstr($data[$counter], "'DEFAULT_MUSIC','".$siteDetails['default_music']."'") && isset($T5) && $T5 !="" ) {
                                
                                $filecontent .= str_replace("'DEFAULT_MUSIC','".$siteDetails['default_music']."'", "'DEFAULT_MUSIC','".$T5."'", $data[$counter]);
                            }
                            elseif ( strstr($data[$counter], "'DEFAULT_VIDEO','".$siteDetails['default_video']."'") && isset($T6) && $T6 !="" ) {
                                
                                $filecontent .= str_replace("'DEFAULT_VIDEO','".$siteDetails['default_video']."'", "'DEFAULT_VIDEO','".$T6."'", $data[$counter]);
                            }
                            else{
                                $filecontent .= $data[$counter];
                            }      
                            $counter ++;
                        }   
                        fclose($file);
                    }

                    //now we have to write in all the new data to this file
                   if (!$handle = fopen($config_db, 'w')) { 
                         echo "Cannot open file ($filename)"; 
                         exit; 
                   }
                   // Write $somecontent to our opened file. 
                   if (fwrite($handle, $filecontent) === FALSE) { 
                       echo "Cannot write to file ($config_db)"; 
                      exit; 
                   } 
                   fclose($handle);
                       
                    // UPLOAD DEFAULT IMAGES FOR NEW GENDERS
                
                    $FF = $_POST['TotalDe'];
                    while($FF > 0){

                        if(isset($_FILES['main_file_'.$FF]['tmp_name']) && strlen($_FILES['main_file_'.$FF]['tmp_name']) > 5){

                            // delete the old image
                            @unlink($web_path_file."nophoto_".$_POST['default_'.$FF].".jpg");
    
                            // upload the new
                            $copy = move_uploaded_file($_FILES['main_file_'.$FF]['tmp_name'], $web_path_file."nophoto_".$_POST['default_'.$FF].".jpg");  
                            // rename the new
                                
                            //if(rename_win($web_path_file.$_FILES['main_file_'.$FF]['name'],$web_path_file."nophoto_".$_POST['default_'.$FF].".jpg") == FALSE) { }
        
                                 
                        }

                        $FF--;
                    }
                
                    $T3 = (isset($T3)) ? $T3 : $siteDetails['default_image'];
                    $T4 = (isset($T4)) ? $T4 : $siteDetails['default_image_adult'];
                    $T5 = (isset($T5)) ? $T5 : $siteDetails['default_music'];
                    $T6 = (isset($T6)) ? $T6 : $siteDetails['default_video'];

                    $DB->Update("UPDATE wld_site_search_membership_file_settings SET default_image = '".$T3."',default_image_adult = '".$T4."',default_music = '".$T5."',default_video = '".$T6."' WHERE market_id = '".$_POST['market_id']."' $site_condition");

                }
                echo '<div id="messages" class="wld-success-message">Thumbnails updated successfully.</div>';
                
                $ErrorSend=1; 

            }break;

            case "packagedelete": {
                
                $market_id = (isset($_POST['market_id'])) ? $_POST['market_id'] : 0;
                $site_id = (isset($_POST['site_id'])) ? $_POST['site_id'] : 0;
                $market = getMarket($market_id);

                $dbh = new PDO('mysql:host='.$market['market_database_path'].';dbname='.$market['market_database_name'].';charset=utf8mb4', $market['market_database_username'], $market['market_database_password']);

                $ErrorSend=0;
                for($i = 1; $i < $_POST['NumRows']+1; $i++) { 
        
                    if(isset($_POST['d'. $i]) && $_POST['d'.$i] == "on"){
                        
                        $p_delete = "DELETE FROM package WHERE pid=".$_POST['id'. $i];
                        
                        $stmt = $dbh->prepare($p_delete);
                                                              
                        $stmt->execute();

                        // UPDATE ALL MEMBERS WHO WERE ON THIS PACKAGE
                        
                        $member_update = "UPDATE members SET packageid=3 WHERE packageid=".$_POST['id'. $i];

                        $stmt = $dbh->prepare($member_update);
                                                              
                        $stmt->execute();

                        global $DB;
                        $DB->Update("DELETE FROM wld_site_package_settings WHERE package_id = '".$_POST['id'. $i]."'");
                        $ErrorSend++;
                        
                        }
                }

                echo '<div id="messages" class="wld-success-message">Packages updated successfully.</div>';

            }break;
            
            case "settings_add_package": {

                if(isset($_POST['market_id']) && $_POST['market_id'] != '0'){

                    $market_id = $_POST['market_id'];
                    $site_id = (isset($_POST['site_id'])) ? $_POST['site_id'] : 0;
                    
                    $market = getMarket($market_id);

                    $dbh = getMarketDBConnection($market_id);

                    //$dbh = new PDO('mysql:host='.$market['market_database_path'].';dbname='.$market['market_database_name'].';charset=utf8mb4', $market['market_database_username'], $market['market_database_password']);
            
                    $_POST['iadult'] = (isset($_POST['iadult'])) ? $_POST['iadult'] : "";
                    $_POST['name'] = (isset($_POST['name'])) ? $_POST['name'] : "";
                    $_POST['price'] = (isset($_POST['price'])) ? $_POST['price'] : "";
                    $_POST['ispace'] = (isset($_POST['ispace'])) ? $_POST['ispace'] : "";
                    $_POST['icon'] = (isset($_POST['icon'])) ? $_POST['icon'] : "";
                    $_POST['visible'] = (isset($_POST['visible'])) ? $_POST['visible'] : "";
                    $_POST['comments'] = (isset($_POST['comments'])) ? $_POST['comments'] : "";
                    $_POST['numdays'] = (isset($_POST['numdays'])) ? $_POST['numdays'] : "";
                    $_POST['ifiles'] = (isset($_POST['ifiles'])) ? $_POST['ifiles'] : "";
                    $_POST['imessages'] = (isset($_POST['imessages'])) ? $_POST['imessages'] : "";
                    $_POST['isub'] = (isset($_POST['isub'])) ? $_POST['isub'] : "";
                    $_POST['icurrency'] = (isset($_POST['icurrency'])) ? $_POST['icurrency'] : "";
                    $_POST['isms'] = (isset($_POST['isms'])) ? $_POST['isms'] : "";
                    $_POST['ihighlight'] = (isset($_POST['ihighlight'])) ? $_POST['ihighlight'] : "";
                    $_POST['ifeatured'] = (isset($_POST['ifeatured'])) ? $_POST['ifeatured'] : "";
                    $_POST['iwink'] = (isset($_POST['iwink'])) ? $_POST['iwink'] : "";
                    
                    if($_POST['smspackage'] ==1){
                        $_POST['icon']="SMS";
                    }else{
                        $_POST['icon']="";
                    }

                    if($_POST['ihighlight'] ==''){
                        $_POST['ihighlight']="no";
                    }

                    
                    if(!isset($_POST['pid'])){
                    
                        
                        $SQL = "INSERT INTO package (
                            site_id,
                            view_adult,
                            `name`,
                            `price`,
                            imageSpace,
                            icon,
                            visible,
                            comments,
                            numdays,
                            maxFiles,
                            maxMessage,
                            subscription,
                            currency_code,
                            SMS_credits,
                            Highlighted,
                            Featured,
                            wink)
                            VALUES(
                            '".$site_id."',
                            '".$_POST['iadult']."',
                            '".$_POST['name']."',
                            '".$_POST['price']."',
                            '".$_POST['ispace']."',
                            '".$_POST['icon']."',
                            '".$_POST['visible']."',
                            '".eMeetingInput($_POST['comments'])."',
                            '".$_POST['numdays']."',
                            '".$_POST['ifiles']."',
                            '".$_POST['imessages']."',
                            '".$_POST['isub']."',
                            '".htmlspecialchars  ($_POST['icurrency'])."',
                            '".$_POST['isms']."',
                            '".$_POST['ihighlight']."',
                            '".$_POST['ifeatured']."',
                            '".$_POST['iwink']."')";

                        $stmt = $dbh->prepare($SQL);
                                                              
                        $stmt->execute();
    
                        $package_id = $dbh->lastInsertId();

                        global $DB;

                        $Query = $DB->Query("SELECT page_name,page_key,page_label FROM wld_site_package_settings WHERE package_id = '3'");

                        while ( $data = $DB->NextRow($Query)) {
                            
                            $DB->Update("INSERT INTO wld_site_package_settings(site_id,package_id,page_name,page_key,page_label) VALUES('$site_id','$package_id','".$data['page_name']."','".$data['page_key']."',\"".$data['page_label']."\")");

                        }

                    }else{
                    
                        $SQL = "UPDATE package SET view_adult='".$_POST['iadult']."', name='".$_POST['name']."', price='".$_POST['price']."', imageSpace='".$_POST['ispace']."', icon='".$_POST['icon']."', visible='".$_POST['visible']."', comments='".eMeetingInput($_POST['comments'])."', numdays='".$_POST['numdays']."',maxFiles='".$_POST['ifiles']."', maxMessage='".$_POST['imessages']."', subscription='".$_POST['isub']."', currency_code='".htmlspecialchars  ($_POST['icurrency'])."', SMS_credits='".$_POST['isms']."', Highlighted='".$_POST['ihighlight']."', Featured='".$_POST['ifeatured']."', wink='".$_POST['iwink']."' WHERE pid=".$_POST['pid'];               

                        $stmt = $dbh->prepare($SQL);
                                                              
                        $stmt->execute();

                    }

                    echo '<div id="messages" class="wld-success-message">Membership package has been updated successfully.</div>';
                }
                

                

            }break;

            case"wldupdatepageaccess": {

                global $DB;

                $market_id = (isset($_POST['market_id'])) ? $_POST['market_id'] : 0;
                $site_id = (isset($_POST['site_id'])) ? $_POST['site_id'] : 0;
                $marketSites = getMarketSites( $market_id , $site_id );

                if($site_id == 0){
                
                	$DB->Update("UPDATE wld_site_package_settings SET page_value = '0' WHERE market_id = '$market_id' AND site_id = '0'");
                
                }
                foreach ($marketSites as $marketSite) {
                    
                    $siteDetails = getMarketSiteSearchMemberSettings($marketSite['market'],$marketSite['wld_site_id']);
                    
                    if((isset($_POST['write_market_sites']) && $_POST['write_market_sites'] == 'yes') || $site_id != '0'){

                        $site_url = $marketSite['site_url'];
                        $dpath = str_replace(array('http://','https://','www.','/'), '', $site_url);

                        $config_packageaccess = $_SERVER['DOCUMENT_ROOT'].'/'.$dpath.'/inc/config_packageaccess.php';


                        $filecontent = "<?\n";
                        $PACKIDS = explode(",",trim($_POST['packageIDS']));
             
                        $t=1;

                        foreach($PACKIDS as $package_id){

                            if(trim($package_id) == ""){
                                continue;
                            }

                            // Market Package

                            $package_exists = $DB->Row("SELECT COUNT(*) AS  count FROM wld_site_package_settings WHERE market_id = '$market_id' AND site_id = '0' AND package_id = '$package_id'");

                            if($package_exists['count']  == '0' && $site_id == '0'){

                                $package_data = $DB->Query("SELECT * FROM wld_site_package_settings WHERE market_id ='0' AND site_id ='0' AND package_id = '3' ORDER BY id");

                                while ( $data = $DB->NextRow($package_data))
                                {
                                    $DB->Update("INSERT INTO wld_site_package_settings(market_id,site_id,package_id,page_name,page_key,page_label,page_value) VALUES('$market_id','0','".$package_id."','".$data['page_name']."','".mysql_real_escape_string($data['page_key'])."','".mysql_real_escape_string($data['page_label'])."','0')");
                                    
                                }

                            }

                            // Market Site Package

                            $package_exists = $DB->Row("SELECT COUNT(*) AS  count FROM wld_site_package_settings WHERE market_id = '$market_id' AND site_id = '".$marketSite['wld_site_id']."' AND package_id = '$package_id'");

                            if($package_exists['count']  == '0'){

                                $package_data = $DB->Query("SELECT * FROM wld_site_package_settings WHERE market_id ='0' AND site_id ='0' AND package_id = '3' ORDER BY id");

                                while ( $data = $DB->NextRow($package_data))
                                {
                                    $DB->Update("INSERT INTO wld_site_package_settings(market_id,site_id,package_id,page_name,page_key,page_label,page_value) VALUES('$market_id','".$marketSite['wld_site_id']."','".$package_id."','".$data['page_name']."','".mysql_real_escape_string($data['page_key'])."','".mysql_real_escape_string($data['page_label'])."','0')");

                                }

                            }





                            $DB->Update("UPDATE wld_site_package_settings SET page_value = '0' WHERE market_id = '$market_id' AND site_id = '".$marketSite['wld_site_id']."' AND package_id = '$package_id'");
                            if($package_id !="" && is_numeric($package_id)){

                                $filecontent .= "$"."PACKAGEACCESS[".$package_id."] = array( \n";
                                while($t < $_POST['TotalOps']){

                                    if(isset($_POST[$package_id."_".$t]) && $_POST[$package_id."_".$t]==1){

                                        $filecontent .="'".$_POST["key_".$t]."-".$_POST["value_".$t]."',\n";

                                        $DB->Update("UPDATE wld_site_package_settings SET page_value = '1' WHERE market_id = '$market_id' AND site_id = '".$marketSite['wld_site_id']."' AND package_id = '$package_id' AND page_name='".$_POST["key_".$t]."' AND page_key='".$_POST["value_".$t]."'");

                                        if($site_id == 0){
                        
                                            $DB->Update("UPDATE wld_site_package_settings SET page_value = '1' WHERE market_id = '$market_id' AND site_id = '0' AND package_id = '$package_id' AND page_name='".$_POST["key_".$t]."' AND page_key='".$_POST["value_".$t]."'");
                                        
                                        }
                                    }
                            
                                    $t++;
                                }
                                $filecontent .= ");";
                                $t=1;
                            }
                        }

                    
                        $filename = $config_packageaccess;
                        if (!$file = fopen($filename, 'a+b')) {
                            die("There was an error opening your config.php file. Please make sure it exsits and is located in the inc/ directory.");
                        } else {

                            $filecontent .= " \n ?>";
                            //now we have to write in all the new data to this file
                            if (!$handle = fopen($filename, 'w')) {
                                echo "Cannot open file ($filename)";
                                exit;
                            }
                            // Write $somecontent to our opened file.
                            if (fwrite($handle, $filecontent) === FALSE) {
                                echo "Cannot write to file ($filename)";
                                exit;
                            }
                            fclose($handle);
                        }

                    }
                    else{

                        $PACKIDS = explode(",",trim($_POST['packageIDS']));
             
                        $t=1;

                        foreach($PACKIDS as $package_id){


                            // Market Package

                            $package_exists = $DB->Row("SELECT COUNT(*) AS  count FROM wld_site_package_settings WHERE market_id = '$market_id' AND site_id = '0' AND package_id = '$package_id'");

                            if($package_exists['count']  == '0'){

                                $package_data = $DB->Query("SELECT * FROM wld_site_package_settings WHERE market_id ='0' AND site_id ='0' AND package_id = '3' ORDER BY id");

                                while ( $data = $DB->NextRow($package_data))
                                {
                                    $DB->Update("INSERT INTO wld_site_package_settings(market_id,site_id,package_id,page_name,page_key,page_label,page_value) VALUES('$market_id','0','".$package_id."','".$data['page_name']."','".mysql_real_escape_string($data['page_key'])."','".mysql_real_escape_string($data['page_label'])."','0')");
                                    
                                }

                            }
                            

                            $DB->Update("UPDATE wld_site_package_settings SET page_value = '0' WHERE market_id = '$market_id' AND site_id = '0' AND package_id = '$package_id'");
                            if($package_id !="" && is_numeric($package_id)){

                                while($t < $_POST['TotalOps']){

                                    if(isset($_POST[$package_id."_".$t]) && $_POST[$package_id."_".$t]==1){

                                        $DB->Update("UPDATE wld_site_package_settings SET page_value = '1' WHERE market_id = '$market_id' AND site_id = '0' AND package_id = '$package_id' AND page_name='".$_POST["key_".$t]."' AND page_key='".$_POST["value_".$t]."'");
                                        
                                    }
                            
                                    $t++;
                                }
                                $t=1;
                            }
                        }

                    }

                }    

                echo '<div id="messages" class="wld-success-message">Manage access has been updated successfully.</div>';

            } break;


        }
    }

}





switch ($_REQUEST['p']) {
    case 'settings':
        ?>
        <div class="submenu">
            <div class="nav-tab-wrapper">
                <a href="?p=settings&sp=site_settings" class="nav-tab <?php echo (!isset($_REQUEST['sp']) || (isset($_REQUEST['sp']) && $_REQUEST['sp'] == 'site_settings')) ? 'active' : ''; ?>">Site Settings</a>
                <a href="?p=settings&sp=search_settings" class="nav-tab <?php echo (isset($_REQUEST['sp']) && $_REQUEST['sp'] == 'search_settings') ? 'active' : ''; ?>">Search Settings</a>
                <a href="?p=settings&sp=membership_settings" class="nav-tab <?php echo (isset($_REQUEST['sp']) && $_REQUEST['sp'] == 'membership_settings') ? 'active' : ''; ?>">Membership Settings</a>
                <a href="?p=settings&sp=membership_packages" class="nav-tab <?php echo (isset($_REQUEST['sp']) && ($_REQUEST['sp'] == 'membership_packages' || $_REQUEST['sp'] == 'wld_package')) ? 'active' : ''; ?>">Membership Packages</a>
                <a href="?p=settings&sp=manage_access" class="nav-tab <?php echo (isset($_REQUEST['sp']) && $_REQUEST['sp'] == 'manage_access') ? 'active' : ''; ?>">Manage Access</a>
                <a href="?p=settings&sp=email_settings" class="nav-tab <?php echo (isset($_REQUEST['sp']) && $_REQUEST['sp'] == 'email_settings') ? 'active' : ''; ?>">Email Settings</a>
                <a href="?p=settings&sp=file_paths" class="nav-tab <?php echo (isset($_REQUEST['sp']) && $_REQUEST['sp'] == 'file_paths') ? 'active' : ''; ?>">File Paths</a>
                <a href="?p=settings&sp=thumbnails" class="nav-tab <?php echo (isset($_REQUEST['sp']) && $_REQUEST['sp'] == 'thumbnails') ? 'active' : ''; ?>">Thumbnails</a>
            </div>
        </div>

        <?php

        $_REQUEST['sp'] = (isset($_REQUEST['sp'])) ? $_REQUEST['sp'] : 'site_settings';
        
        include('settings/'.$_REQUEST['sp'].'.php');    
        
        break;

    case 'dr_admin_markets':
        ?>
        <div class="submenu">
            <h3 class="nav-tab-wrapper">
                <a href="?page=dr_admin_markets&submenu=markets" class="nav-tab <?php echo (!isset($_REQUEST['submenu']) || (isset($_REQUEST['submenu']) && $_REQUEST['submenu'] == 'markets')) ? 'active' : ''; ?>">Markets</a>
                <a href="?page=dr_admin_markets&submenu=add_market" class="nav-tab <?php echo (isset($_REQUEST['submenu']) && $_REQUEST['submenu'] == 'add_market') ? 'active' : ''; ?>">Add Market</a>
               
            </h3>
        </div>
        <?php
        break;

    case 'dr_admin_approve_edits':
        ?>
        <div class="submenu">
            <h3 class="nav-tab-wrapper">
                <a href="?page=dr_admin_approve_edits&submenu=pages" class="nav-tab <?php echo (!isset($_REQUEST['submenu']) || (isset($_REQUEST['submenu']) && $_REQUEST['submenu'] == 'pages')) ? 'active' : ''; ?>">Pages</a>
                <a href="?page=dr_admin_approve_edits&submenu=text" class="nav-tab <?php echo (isset($_REQUEST['submenu']) && $_REQUEST['submenu'] == 'text') ? 'active' : ''; ?>">Text</a>
                <a href="?page=dr_admin_approve_edits&submenu=metatags" class="nav-tab <?php echo (isset($_REQUEST['submenu']) && $_REQUEST['submenu'] == 'metatags') ? 'active' : ''; ?>">Metatags</a>
                <a href="?page=dr_admin_approve_edits&submenu=banners" class="nav-tab <?php echo (isset($_REQUEST['submenu']) && $_REQUEST['submenu'] == 'banners') ? 'active' : ''; ?>">Banners</a>
               
            </h3>
        </div>
        <?php
        break;
    case 'dr_admin_payments':
        ?>
        <div class="submenu">
            <h3 class="nav-tab-wrapper">
                <a href="?page=dr_admin_payments&submenu=customers" class="nav-tab <?php echo (!isset($_REQUEST['submenu']) || (isset($_REQUEST['submenu']) && $_REQUEST['submenu'] == 'customers')) ? 'active' : ''; ?>">Customers</a>
                <a href="?page=dr_admin_payments&submenu=affiliates" class="nav-tab <?php echo (isset($_REQUEST['submenu']) && $_REQUEST['submenu'] == 'affiliates') ? 'active' : ''; ?>">Affiliates</a>
               
            </h3>
        </div>
        <?php
        break;
}

?>