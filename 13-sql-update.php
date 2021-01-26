<?php



include"inc/config.php";





////////////////// TABLE 'ARTICLES'  /////////////////////////

$tableRow = $DB->Row("SHOW COLUMNS FROM articles LIKE 'meta_title'");



if(!(isset($tableRow['Field']) && $tableRow['Field'] == 'meta_title')){

  $DB->Update("ALTER TABLE articles

  ADD COLUMN `meta_title` varchar(200) NOT NULL AFTER `content`");  

}

else{

  echo "<p>Table 'articles' is already updated.</p>";

}



$tableRow = $DB->Row("SHOW COLUMNS FROM articles LIKE 'meta_description'");

if(!(isset($tableRow['Field']) && $tableRow['Field'] == 'meta_description')){

  $DB->Update("ALTER TABLE articles

  ADD COLUMN `meta_description` text NOT NULL AFTER `meta_title`");

}



$tableRow = $DB->Row("SHOW COLUMNS FROM articles LIKE 'meta_keywords'");

if(!(isset($tableRow['Field']) && $tableRow['Field'] == 'meta_keywords')){

  $DB->Update("ALTER TABLE articles

  ADD COLUMN `meta_keywords` varchar(200) NOT NULL AFTER `meta_description`");

}



$tableRow = $DB->Row("SHOW COLUMNS FROM articles LIKE 'image'");

if(!(isset($tableRow['Field']) && $tableRow['Field'] == 'image')){

  $DB->Update("ALTER TABLE articles

  ADD COLUMN `image` varchar(200) NOT NULL AFTER `meta_keywords`");

}



$tableRow = $DB->Row("SHOW COLUMNS FROM articles LIKE 'status'");

if(!(isset($tableRow['Field']) && $tableRow['Field'] == 'status')){

  $DB->Update("ALTER TABLE articles

  ADD COLUMN `status` enum('published','draft') NOT NULL DEFAULT 'draft' AFTER `link`");

}



$tableRow = $DB->Row("SHOW COLUMNS FROM articles LIKE 'author_id'");

if(!(isset($tableRow['Field']) && $tableRow['Field'] == 'author_id')){

  $DB->Update("ALTER TABLE articles

  ADD COLUMN `author_id` int(11) NOT NULL AFTER `status`");

}



/*$DB->Update("ALTER TABLE articles

ADD COLUMN `meta_title` varchar(200) NOT NULL AFTER `content`,

ADD COLUMN `meta_description` text NOT NULL AFTER `meta_title`,

ADD COLUMN `meta_keywords` varchar(200) NOT NULL AFTER `meta_description`,

ADD COLUMN `image` varchar(200) NOT NULL AFTER `meta_keywords`,

ADD COLUMN `status` enum('published','draft') NOT NULL DEFAULT 'draft' AFTER `link`,

ADD COLUMN `author_id` int(11) NOT NULL AFTER `status`");*/



////////////////// TABLE 'Comments'  /////////////////////////



$tableRow = $DB->Row("SHOW COLUMNS FROM comments LIKE 'popup_viewed'");

if(!(isset($tableRow['Field']) && $tableRow['Field'] == 'popup_viewed')){

  $DB->Update("ALTER TABLE comments

  ADD COLUMN `popup_viewed` enum('yes','no') NOT NULL DEFAULT 'no' AFTER `approved`");  

}

else{

  echo "<p>Table 'comments' is already updated.</p>";

}

/*

$DB->Update("ALTER TABLE comments

ADD COLUMN `popup_viewed` enum('yes','no') NOT NULL DEFAULT 'no' AFTER `approved`");

*/





///////////////// TABLE 'Field'  /////////////////////////





$tableRow = $DB->Row("SHOW COLUMNS FROM field LIKE 'quickbrowsepage'");

if(!(isset($tableRow['Field']) && $tableRow['Field'] == 'quickbrowsepage')){

  $DB->Update("ALTER TABLE field

ADD COLUMN `quickbrowsepage` enum('yes','no') NOT NULL DEFAULT 'no' AFTER `browsepage`");  
  
  $DB->Update("update field set quickbrowsepage ='yes' where fName='milesfrom' or fName='location' ");  

}

else{

  echo "<p>Table 'quickbrowsepage' is already updated.</p>";
  $DB->Update("update field set quickbrowsepage ='yes' where fName='milesfrom' or fName='location' ");  

}



/*

$DB->Update("ALTER TABLE field

ADD COLUMN `quickbrowsepage` enum('yes','no') NOT NULL DEFAULT 'no' AFTER `browsepage`");*/



//$DB->Update("ALTER TABLE members

//ADD COLUMN `reg_type` enum('Reg Page','FB','Twitter','Google') NOT NULL DEFAULT 'Reg Page' AFTER `lastlogin`,

//ADD COLUMN `facebook_id` varchar(250) DEFAULT NULL AFTER `video_live`");







///////////////// TABLE 'Members'  /////////////////////////



$tableRow = $DB->Row("SHOW COLUMNS FROM members LIKE 'reg_type'");

if(!(isset($tableRow['Field']) && $tableRow['Field'] == 'reg_type')){

  $DB->Update("ALTER TABLE members

ADD COLUMN `reg_type` enum('Reg Page','FB','Twitter','Google') NOT NULL DEFAULT 'Reg Page' AFTER `lastlogin`");  

}



$tableRow = $DB->Row("SHOW COLUMNS FROM members LIKE 'facebook_id'");

if(!(isset($tableRow['Field']) && $tableRow['Field'] == 'facebook_id')){

  $DB->Update("ALTER TABLE members

ADD COLUMN `facebook_id` varchar(250) DEFAULT NULL AFTER `video_live`");  

}

else{

 echo "<p>Table 'members' is already updated.</p>";

}

/*

$DB->Update("ALTER TABLE members

ADD COLUMN `reg_type` enum('Reg Page','FB','Twitter','Google') NOT NULL DEFAULT 'Reg Page' AFTER `lastlogin`");*/



///////////////// TABLE 'Members Network'  /////////////////////////





$tableRow = $DB->Row("SHOW COLUMNS FROM members_network LIKE 'popup_viewed'");

if(!(isset($tableRow['Field']) && $tableRow['Field'] == 'popup_viewed')){

  $DB->Update("ALTER TABLE members_network

ADD COLUMN `popup_viewed` enum('yes','no') NOT NULL DEFAULT 'no' AFTER `approved`");  

}

else{

  echo "<p>Table 'members_network' is already updated.</p>";

}



/*

$DB->Update("ALTER TABLE members_network

ADD COLUMN `popup_viewed` enum('yes','no') NOT NULL DEFAULT 'no' AFTER `approved`");*/







///////////////// TABLE 'Merchant'  /////////////////////////



$tableRow = $DB->Row("SHOW COLUMNS FROM merchant LIKE 'title'");

if(!(isset($tableRow['Field']) && $tableRow['Field'] == 'title')){

  $DB->Update("ALTER TABLE merchant

ADD COLUMN `title` varchar(100) NOT NULL AFTER `name`");  

}

else{

  echo "<p>Table 'merchant' is already updated.</p>";

}

/*

$DB->Update("ALTER TABLE merchant

ADD COLUMN `title` varchar(100) NOT NULL AFTER `name`");

*/







///////////////// TABLE 'Messages'  /////////////////////////



$tableRow = $DB->Row("SHOW COLUMNS FROM messages LIKE 'popup_viewed'");

if(!(isset($tableRow['Field']) && $tableRow['Field'] == 'popup_viewed')){

  $DB->Update("ALTER TABLE messages

ADD COLUMN `popup_viewed` enum('yes','no') NOT NULL DEFAULT 'no' AFTER `mailstatus`");  

}

else{

 echo "<p>Table 'messages' is already updated.</p>";

}



/*

$DB->Update("ALTER TABLE messages

ADD COLUMN `popup_viewed` enum('yes','no') NOT NULL DEFAULT 'no' AFTER `mailstatus`");*/





///////////////// TABLE 'Template Pages'  /////////////////////////



$tableRow = $DB->Row("SHOW COLUMNS FROM template_pages LIKE 'title'");

if(!(isset($tableRow['Field']) && $tableRow['Field'] == 'title')){

  $DB->Update("ALTER TABLE template_pages

  ADD COLUMN `title` varchar(200) NOT NULL AFTER `content`");  

}





$tableRow = $DB->Row("SHOW COLUMNS FROM template_pages LIKE 'description'");

if(!(isset($tableRow['Field']) && $tableRow['Field'] == 'description')){

  $DB->Update("ALTER TABLE template_pages

ADD COLUMN `description` text NOT NULL AFTER `title`");  

}

$tableRow = $DB->Row("SHOW COLUMNS FROM template_pages LIKE 'keywords'");

if(!(isset($tableRow['Field']) && $tableRow['Field'] == 'keywords')){

  $DB->Update("ALTER TABLE template_pages

ADD COLUMN `keywords` varchar(200) NOT NULL AFTER `description`");  

}

$tableRow = $DB->Row("SHOW COLUMNS FROM template_pages LIKE 'access'");

if(!(isset($tableRow['Field']) && $tableRow['Field'] == 'access')){

  $DB->Update("ALTER TABLE template_pages

ADD COLUMN `access` varchar(200) NOT NULL AFTER `keywords`");  

}

else{

  echo "<p>Table 'template_pages' is already updated.</p>";

}





/*

$DB->Update("ALTER TABLE template_pages

ADD COLUMN `title` varchar(200) NOT NULL AFTER `content`,

ADD COLUMN `description` text NOT NULL AFTER `title`,

ADD COLUMN `keywords` varchar(200) NOT NULL AFTER `description`,

ADD COLUMN `access` varchar(200) NOT NULL AFTER `keywords`");

*/



///////////////// TABLE 'Compatibility Field'  /////////////////////////





$DB->Update("CREATE TABLE IF NOT EXISTS `compatibility_field` (

  `fid` int(5) NOT NULL AUTO_INCREMENT,

  `fName` varchar(100) DEFAULT NULL,

  `fType` int(1) DEFAULT '0',

  `fOrder` int(3) DEFAULT '0',

  `fGender` int(1) DEFAULT '0',

  `groupid` int(11) DEFAULT '1',

  `required` int(1) DEFAULT '0',

  `browsepage` enum('yes','no') DEFAULT 'no',

  `quickbrowsepage` enum('yes','no') NOT NULL DEFAULT 'no',

  `matchpage` enum('yes','no') DEFAULT 'no',

  `linked_id` int(10) NOT NULL DEFAULT '0',

  `field_weight` enum('1','2','3','4','5') NOT NULL DEFAULT '5',

  `groupid_1` int(11) NOT NULL,

  `groupid_2` int(11) NOT NULL,

  PRIMARY KEY (`fid`),

  KEY `groupid` (`groupid`),

  KEY `fType` (`fType`),

  KEY `fGender` (`fGender`),

  KEY `required` (`required`),

  KEY `browsepage` (`browsepage`),

  KEY `matchpage` (`matchpage`)

) ENGINE=MyISAM  DEFAULT CHARSET=utf8");



///////////////// TABLE 'Compatibility Field'  /////////////////////////

$Caption = $DB->Row("SELECT count(*) as count FROM compatibility_field ");



  if(empty($Caption['count'])){



    $DB->Update("INSERT INTO `compatibility_field` (`fid`, `fName`, `fType`, `fOrder`, `fGender`, `groupid`, `required`, `browsepage`, `quickbrowsepage`, `matchpage`, `linked_id`, `field_weight`, `groupid_1`, `groupid_2`) VALUES

    (1, 'em_eym20170719', 3, 1, 2, 1, 0, 'no', 'no', 'no', 0, '5', 0, 0),

    (2, 'em_yxc20170719', 3, 2, 2, 1, 0, 'no', 'no', 'no', 0, '5', 0, 0),

    (3, 'em_7r820170721', 3, 3, 2, 1, 0, 'no', 'no', 'no', 0, '5', 0, 0),

    (4, 'em_nr420170721', 3, 4, 2, 1, 0, 'no', 'no', 'no', 0, '5', 0, 0),

    (5, 'em_beb20170721', 3, 5, 2, 1, 0, 'no', 'no', 'no', 0, '5', 0, 0),

    (6, 'em_04320170721', 3, 6, 2, 1, 0, 'no', 'no', 'no', 0, '5', 0, 0),

    (7, 'em_gw120170721', 3, 7, 2, 1, 0, 'no', 'no', 'no', 0, '5', 0, 0),

    (8, 'em_4kx20170724', 3, 1, 2, 2, 0, 'no', 'no', 'no', 0, '5', 0, 0),

    (9, 'em_87u20170724', 3, 2, 2, 2, 0, 'no', 'no', 'no', 0, '5', 0, 0),

    (10, 'em_89j20170724', 3, 3, 2, 2, 0, 'no', 'no', 'no', 0, '5', 0, 0),

    (11, 'em_rsf20170724', 3, 4, 2, 2, 0, 'no', 'no', 'no', 0, '5', 0, 0),

    (12, 'em_u3f20170724', 3, 5, 2, 2, 0, 'no', 'no', 'no', 0, '5', 0, 0),

    (13, 'em_29v20170724', 3, 6, 2, 2, 0, 'no', 'no', 'no', 0, '5', 0, 0),

    (14, 'em_bpy20170724', 3, 1, 2, 3, 0, 'no', 'no', 'no', 0, '5', 0, 0),

    (15, 'em_f5a20170724', 3, 2, 2, 3, 0, 'no', 'no', 'no', 0, '5', 0, 0),

    (16, 'em_hag20170724', 3, 3, 2, 3, 0, 'no', 'no', 'no', 0, '5', 0, 0),

    (17, 'em_gwp20170724', 3, 4, 2, 3, 0, 'no', 'no', 'no', 0, '5', 0, 0),

    (18, 'em_m1320170724', 3, 5, 2, 3, 0, 'no', 'no', 'no', 0, '5', 0, 0),

    (19, 'em_rvp20170724', 3, 1, 2, 4, 0, 'no', 'no', 'no', 0, '5', 0, 0),

    (20, 'em_2th20170724', 3, 2, 2, 4, 0, 'no', 'no', 'no', 0, '5', 0, 0),

    (21, 'em_y7620170724', 3, 3, 2, 4, 0, 'no', 'no', 'no', 0, '5', 0, 0),

    (22, 'em_pvw20170724', 3, 4, 2, 4, 0, 'no', 'no', 'no', 0, '5', 0, 0)");    

  }





///////////////// TABLE 'compatibility field caption'  /////////////////////////



$DB->Update("CREATE TABLE IF NOT EXISTS `compatibility_field_caption` (

  `id` int(5) NOT NULL AUTO_INCREMENT,

  `Cid` int(5) DEFAULT '0',

  `lang` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,

  `caption` varchar(255) DEFAULT NULL,

  `description` varchar(255) DEFAULT NULL,

  `match` enum('yes','no','quick') DEFAULT 'no',

  `is_multiple_type` enum('0','1') NOT NULL DEFAULT '0',

  PRIMARY KEY (`id`),

  KEY `Cid` (`Cid`),

  KEY `lang` (`lang`)

) ENGINE=MyISAM  DEFAULT CHARSET=utf8");







///////////////// TABLE 'compatibility field caption'  /////////////////////////

$Caption = $DB->Row("SELECT count(*) as count FROM compatibility_field_caption ");



  if(empty($Caption['count'])){



$DB->Update("INSERT INTO `compatibility_field_caption` (`id`, `Cid`, `lang`, `caption`, `description`, `match`, `is_multiple_type`) VALUES

(1, 1, 'english', 'When my partner and I are having an issue, I like to talk it through until it is resolved.', '', 'no', '1'),

(2, 1, 'english', 'When my partner and I are having an issue, I like to talk it through until it is resolved.', '', 'yes', '1'),

(3, 2, 'english', 'When I disagree with someone, I will usually tell them.', '', 'no', '0'),

(4, 2, 'english', 'When I disagree with someone, I will usually tell them.', '', 'yes', '1'),

(6, 3, 'english', 'Do you agree with the statement: \"If you don''t have anything nice to say, don''t say anything at all\"?', '', 'yes', '0'),

(7, 4, 'english', 'You are having an argument and you realise you are wrong. What do you do?', '', 'no', '0'),

(8, 4, 'english', 'You are having an argument and you realise you are wrong. What do you do?', '', 'yes', '0'),

(9, 5, 'english', 'I try to avoid confrontation.', '', 'no', '0'),

(10, 5, 'english', 'I try to avoid confrontation.', '', 'yes', '0'),

(11, 6, 'english', 'I stand up for my beliefs no matter what.', '', 'no', '0'),

(12, 6, 'english', 'I stand up for my beliefs no matter what.', '', 'yes', '0'),

(13, 7, 'english', 'Have you ever ghosted someone before? (stopped communicating with a potential partner without explanation)', '', 'no', '0'),

(14, 7, 'english', 'Have you ever ghosted someone before? (stopped communicating with a potential partner without explanation)', '', 'yes', '0'),

(15, 8, 'english', ' Do you like it when your partner is romantic?', '', 'no', '0'),

(16, 8, 'english', ' Do you like it when your partner is romantic?', '', 'yes', '0'),

(17, 9, 'english', 'Do you consider yourself a romantic person?', '', 'no', '0'),

(18, 9, 'english', 'Do you consider yourself a romantic person?', '', 'yes', '0'),

(19, 10, 'english', 'I believe monogamy is essential in a relationship.', '', 'no', '1'),

(20, 10, 'english', 'I believe monogamy is essential in a relationship.', '', 'yes', '1'),

(21, 11, 'english', 'I am a very affectionate person.', '', 'no', '0'),

(22, 11, 'english', 'I am a very affectionate person.', '', 'yes', '0'),

(23, 12, 'english', 'I like to bring romance into my relationship.', '', 'no', '1'),

(24, 12, 'english', 'I like to bring romance into my relationship.', '', 'yes', '1'),

(25, 13, 'english', 'I''m not a very touchy-feely person.', '', 'no', '0'),

(26, 13, 'english', 'I''m not a very touchy-feely person.', '', 'yes', '0'),

(27, 14, 'english', 'I have little patience.', '', 'no', '0'),

(28, 14, 'english', 'I have little patience.', '', 'yes', '0'),

(29, 15, 'english', 'I get angry pretty easily.', '', 'no', '1'),

(30, 15, 'english', 'I get angry pretty easily.', '', 'yes', '1'),

(31, 16, 'english', 'I get stressed easily.', '', 'no', '0'),

(32, 16, 'english', 'I get stressed easily.', '', 'yes', '0'),

(33, 17, 'english', 'My emotions tend to get out of control.', '', 'no', '1'),

(34, 17, 'english', 'My emotions tend to get out of control.', '', 'yes', '1'),

(35, 18, 'english', 'Someone cuts you off in traffic, what do you do?', '', 'no', '0'),

(36, 18, 'english', 'Someone cuts you off in traffic, what do you do?', '', 'yes', '0'),

(37, 19, 'english', 'Are you more serious or humorous when talking to others?', '', 'no', '0'),

(38, 19, 'english', 'Are you more serious or humorous when talking to others?', '', 'yes', '0'),

(39, 20, 'english', 'I was a bit of a class clown in school.', '', 'no', '0'),

(40, 20, 'english', 'I was a bit of a class clown in school.', '', 'yes', '0'),

(41, 21, 'english', 'I love making other people laugh.', '', 'no', '1'),

(42, 21, 'english', 'I love making other people laugh.', '', 'yes', '1'),

(43, 22, 'english', 'I enjoy watching stand-up comedy.', '', 'no', '0'),

(44, 22, 'english', 'I enjoy watching stand-up comedy.', '', 'yes', '0')");

        }

  





  //////////////// TABLE 'Compatibility Field Group'  /////////////////////////



$DB->Update("CREATE TABLE IF NOT EXISTS `compatibility_field_groups` (

  `id` int(5) NOT NULL AUTO_INCREMENT,

  `caption` varchar(255) DEFAULT NULL,

  `forder` int(5) DEFAULT '1',

  `private` int(1) DEFAULT '0',

  PRIMARY KEY (`id`)

) ENGINE=MyISAM  DEFAULT CHARSET=utf8");



 //////////////// TABLE 'Compatibility Field Group'  /////////////////////////



  $Caption = $DB->Row("SELECT count(*) as count FROM compatibility_field_groups ");



  if(empty($Caption['count'])){





$DB->Update("INSERT INTO `compatibility_field_groups` (`id`, `caption`, `forder`, `private`) VALUES

(1, 'Communication Style', 1, 0),

(2, 'Romance / Intimacy', 2, 0),

(3, 'Emotional Stability', 3, 0),

(4, 'Sense of Humour', 4, 0)");

$DB->Update("CREATE TABLE IF NOT EXISTS `compatibility_field_list_value` (

  `id` int(10) NOT NULL AUTO_INCREMENT,

  `fvid` int(5) NOT NULL DEFAULT '0',

  `fvFid` int(5) DEFAULT '0',

  `fvCaption` varchar(255) DEFAULT NULL,

  `fvOrder` int(5) DEFAULT '1',

  `lang` varchar(10) DEFAULT 'en',

  `default` enum('yes','no') NOT NULL DEFAULT 'no',

  `linked_cap_id` int(10) NOT NULL DEFAULT '0',

  PRIMARY KEY (`id`),

  KEY `fvid` (`fvid`),

  KEY `fvFid` (`fvFid`),

  KEY `lang` (`lang`)

  ) ENGINE=MyISAM  DEFAULT CHARSET=utf8");

      }

      





//////////////// TABLE 'Compatibility Field list value'  /////////////////////////



    $Caption = $DB->Row("SELECT count(*) as count FROM compatibility_field_list_value ");



  if(empty($Caption['count'])){



    $DB->Update("INSERT INTO `compatibility_field_list_value` (`id`, `fvid`, `fvFid`, `fvCaption`, `fvOrder`, `lang`, `default`, `linked_cap_id`) VALUES

    (7, 7, 1, '2', 2, 'english', 'no', 0),

    (6, 6, 1, '1', 1, 'english', 'no', 0),

    (24, 24, 8, 'Yes. I''m a sucker for romance.', 0, 'english', 'no', 0),

    (5, 5, 4, 'Stand your ground', 2, 'english', 'no', 0),

    (4, 4, 4, 'Admit it', 1, 'english', 'no', 0),

    (8, 8, 1, '3', 3, 'english', 'no', 0),

    (9, 9, 1, '4', 4, 'english', 'no', 0),

    (10, 10, 1, '5', 5, 'english', 'no', 0),

    (11, 11, 2, '1', 1, 'english', 'no', 0),

    (12, 12, 2, '2', 2, 'english', 'no', 0),

    (13, 13, 2, '3', 3, 'english', 'no', 0),

    (14, 14, 2, '4', 4, 'english', 'no', 0),

    (15, 15, 2, '5', 5, 'english', 'no', 0),

    (16, 16, 5, 'TRUE', 0, 'english', 'no', 0),

    (17, 17, 5, 'FALSE', 0, 'english', 'no', 0),

    (18, 18, 6, 'TRUE', 0, 'english', 'no', 0),

    (19, 19, 6, 'FALSE', 0, 'english', 'no', 0),

    (20, 20, 7, 'Yes. Sometimes its best to just end it.', 1, 'english', 'yes', 0),

    (21, 21, 7, 'No. I would feel guilty not giving an explanation.', 2, 'english', 'no', 0),

    (22, 22, 3, 'Yes. There''s no reason to be mean.', 1, 'english', 'no', 0),

    (23, 23, 3, 'No. Sometimes you need to give tough love.', 2, 'english', 'no', 0),

    (25, 25, 8, 'No. It would make me cringe.', 0, 'english', 'no', 0),

    (26, 26, 9, 'Yes', 0, 'english', 'no', 0),

    (27, 27, 9, 'No', 0, 'english', 'no', 0),

    (28, 28, 10, '1', 1, 'english', 'no', 0),

    (29, 29, 10, '2', 2, 'english', 'no', 0),

    (30, 30, 10, '3', 3, 'english', 'no', 0),

    (31, 31, 10, '4', 4, 'english', 'no', 0),

    (32, 32, 10, '5', 5, 'english', 'no', 0),

    (33, 33, 11, 'TRUE', 1, 'english', 'no', 0),

    (34, 34, 11, 'FALSE', 2, 'english', 'no', 0),

    (35, 35, 12, '1', 1, 'english', 'no', 0),

    (36, 36, 12, '2', 2, 'english', 'no', 0),

    (37, 37, 12, '3', 3, 'english', 'no', 0),

    (38, 38, 12, '4', 4, 'english', 'no', 0),

    (39, 39, 12, '5', 5, 'english', 'no', 0),

    (40, 40, 13, 'TRUE', 1, 'english', 'no', 0),

    (41, 41, 13, 'FALSE', 2, 'english', 'no', 0),

    (42, 42, 14, 'TRUE', 1, 'english', 'no', 0),

    (43, 43, 14, 'FALSE', 2, 'english', 'no', 0),

    (44, 44, 15, '1', 1, 'english', 'no', 0),

    (45, 45, 15, '2', 2, 'english', 'no', 0),

    (46, 46, 15, '3', 3, 'english', 'no', 0),

    (47, 47, 15, '4', 4, 'english', 'no', 0),

    (48, 48, 15, '5', 5, 'english', 'no', 0),

    (49, 49, 16, 'TRUE', 1, 'english', 'no', 0),

    (50, 50, 16, 'FALSE', 2, 'english', 'no', 0),

    (51, 51, 17, '1', 0, 'english', 'no', 0),

    (52, 52, 17, '2', 0, 'english', 'no', 0),

    (53, 53, 17, '3', 0, 'english', 'no', 0),

    (54, 54, 17, '4', 0, 'english', 'no', 0),

    (55, 55, 17, '5', 0, 'english', 'no', 0),

    (56, 56, 18, 'Flip them off and yell', 1, 'english', 'no', 0),

    (57, 57, 18, 'Feel frustrated but donâ€™t act on it', 2, 'english', 'no', 0),

    (58, 58, 19, 'Serious', 1, 'english', 'no', 0),

    (59, 59, 19, 'Humorous', 2, 'english', 'no', 0),

    (60, 60, 20, 'TRUE', 1, 'english', 'no', 0),

    (61, 61, 20, 'FALSE', 2, 'english', 'no', 0),

    (62, 62, 21, '1', 1, 'english', 'no', 0),

    (63, 63, 21, '2', 2, 'english', 'no', 0),

    (64, 64, 21, '3', 3, 'english', 'no', 0),

    (65, 65, 21, '4', 4, 'english', 'no', 0),

    (66, 66, 21, '5', 5, 'english', 'no', 0),

    (67, 67, 22, 'TRUE', 1, 'english', 'no', 0),

    (68, 68, 22, 'FALSE', 2, 'english', 'no', 0)");



    }

    



//////////////// TABLE 'Compatibility Members Data'  /////////////////////////





$DB->Update("CREATE TABLE IF NOT EXISTS `compatibility_members_data` (

  `uid` mediumint(9) NOT NULL DEFAULT '0',

  `em_eym20170719` tinyint(2) DEFAULT NULL,

  `em_yxc20170719` tinyint(2) DEFAULT NULL,

  `em_7r820170721` tinyint(2) DEFAULT NULL,

  `em_nr420170721` tinyint(2) DEFAULT NULL,

  `em_beb20170721` tinyint(2) DEFAULT NULL,

  `em_04320170721` tinyint(2) DEFAULT NULL,

  `em_gw120170721` tinyint(2) DEFAULT NULL,

  `em_4kx20170724` tinyint(2) DEFAULT NULL,

  `em_87u20170724` tinyint(2) DEFAULT NULL,

  `em_89j20170724` tinyint(2) DEFAULT NULL,

  `em_rsf20170724` tinyint(2) DEFAULT NULL,

  `em_u3f20170724` tinyint(2) DEFAULT NULL,

  `em_29v20170724` tinyint(2) DEFAULT NULL,

  `em_bpy20170724` tinyint(2) DEFAULT NULL,

  `em_f5a20170724` tinyint(2) DEFAULT NULL,

  `em_hag20170724` tinyint(2) DEFAULT NULL,

  `em_gwp20170724` tinyint(2) DEFAULT NULL,

  `em_m1320170724` tinyint(2) DEFAULT NULL,

  `em_rvp20170724` tinyint(2) DEFAULT NULL,

  `em_2th20170724` tinyint(2) DEFAULT NULL,

  `em_y7620170724` tinyint(2) DEFAULT NULL,

  `em_pvw20170724` tinyint(2) DEFAULT NULL,

  PRIMARY KEY (`uid`)

) ENGINE=MyISAM DEFAULT CHARSET=utf8");





//////////////// TABLE 'compatibility members data'  /////////////////////////



    $Caption = $DB->Row("SELECT count(*) as count FROM compatibility_members_data ");



  if(empty($Caption['count'])){



  $DB->Update("INSERT INTO `compatibility_members_data` (`uid`, `em_eym20170719`, `em_yxc20170719`, `em_7r820170721`, `em_nr420170721`, `em_beb20170721`, `em_04320170721`, `em_gw120170721`, `em_4kx20170724`, `em_87u20170724`, `em_89j20170724`, `em_rsf20170724`, `em_u3f20170724`, `em_29v20170724`, `em_bpy20170724`, `em_f5a20170724`, `em_hag20170724`, `em_gwp20170724`, `em_m1320170724`, `em_rvp20170724`, `em_2th20170724`, `em_y7620170724`, `em_pvw20170724`) VALUES

  (16, 10, 15, 22, 4, 16, 18, 20, 24, 26, 28, 33, 35, 40, 42, 44, 49, 53, 56, 59, 60, 66, 67),

  (37, 6, 13, 22, 4, 16, 18, 20, 24, 26, 31, 33, 38, 40, 42, 48, 49, 55, 56, 58, 60, 62, 67),

  (41, 6, 11, 22, 4, 16, 18, 20, 24, 26, 32, 33, 39, 40, 42, 44, 49, 54, 56, 58, 60, 64, 68),

  (49, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),

  (74, 6, 11, 22, 4, 16, 18, 20, 24, 26, 28, 33, 36, 40, 42, 44, 49, 51, 56, 58, 60, 62, 67),

  (132, 10, 15, 22, 4, 16, 18, 20, 24, 26, 32, 33, 39, 40, 42, 48, 49, 55, 56, 58, 60, 66, 67),

  (13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),

  (182, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),

  (185, NULL, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, NULL, NULL, NULL, NULL, NULL, 56, NULL, NULL, NULL, 68)");



          }

   

//////////////// TABLE 'article categories assigned'  /////////////////////////





$DB->Update("CREATE TABLE IF NOT EXISTS `article_categories_assigned` (

  `article_id` int(11) NOT NULL,

  `category_id` int(11) NOT NULL

) ENGINE=MyISAM DEFAULT CHARSET=latin1");



//////////////// TABLE 'field group languages'  /////////////////////////



$DB->Update("CREATE TABLE IF NOT EXISTS `field_group_languages` (

  `id` int(11) NOT NULL AUTO_INCREMENT,

  `fgid` int(11) NOT NULL,

  `caption` varchar(255) CHARACTER SET utf8 NOT NULL,

  `language` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,

  PRIMARY KEY (`id`)

) ENGINE=MyISAM  DEFAULT CHARSET=latin1");



//////////////// TABLE 'geo network blocks'  /////////////////////////



$DB->Update("CREATE TABLE IF NOT EXISTS `geo_network_blocks` (

  `geo_network_block_id` int(11) NOT NULL AUTO_INCREMENT,

  `geoname_id` int(11) NOT NULL,

  `start_remote_ip_address` varchar(20) NOT NULL,

  `end_remote_ip_address` varchar(20) NOT NULL,

  `start_ip_num` int(11) NOT NULL,

  `end_ip_num` int(11) NOT NULL,

  `registered_country_geoname_id` int(11) NOT NULL,

  `represented_country_geoname_id` int(11) NOT NULL,

  `is_anonymous_proxy` varchar(10) NOT NULL,

  `is_satellite_provider` varchar(20) NOT NULL,

  `postal_code` varchar(20) NOT NULL,

  `latitude` double(10,4) NOT NULL,

  `longitude` double(10,4) NOT NULL,

  `accuracy_radius` int(11) NOT NULL,

  PRIMARY KEY (`geo_network_block_id`)

) ENGINE=MyISAM  DEFAULT CHARSET=latin1");







$DB->Update("CREATE TABLE IF NOT EXISTS `geo_network_cities` (

  `geo_network_city_id` int(11) NOT NULL AUTO_INCREMENT,

  `geoname_id` int(11) NOT NULL,

  `locale_code` varchar(40) NOT NULL,

  `country_id` int(11) NOT NULL,

  `state_id` int(11) NOT NULL,

  `subdivision_1_iso_code` varchar(70) NOT NULL,

  `subdivision_1_name` varchar(70) NOT NULL,

  `subdivision_2_iso_code` varchar(70) NOT NULL,

  `subdivision_2_name` varchar(70) NOT NULL,

  `city_name` varchar(70) NOT NULL,

  `metro_code` varchar(40) NOT NULL,

  `time_zone` varchar(100) NOT NULL,

  PRIMARY KEY (`geo_network_city_id`)

) ENGINE=MyISAM  DEFAULT CHARSET=latin1");





$DB->Update("CREATE TABLE IF NOT EXISTS `geo_network_countries` (

  `geo_network_country_id` int(11) NOT NULL AUTO_INCREMENT,

  `country_code` varchar(5) COLLATE utf8_unicode_ci NOT NULL,

  `country_name` varchar(40) COLLATE utf8_unicode_ci NOT NULL,

  PRIMARY KEY (`geo_network_country_id`)

) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");





$DB->Update("CREATE TABLE IF NOT EXISTS `geo_network_states` (

  `geo_network_state_id` int(11) NOT NULL AUTO_INCREMENT,

  `state_code` varchar(70) NOT NULL,

  `state_name` varchar(70) NOT NULL,

  `geo_network_country_id` int(11) NOT NULL,

  PRIMARY KEY (`geo_network_state_id`)

) ENGINE=MyISAM  DEFAULT CHARSET=latin1");



$DB->Update("CREATE TABLE IF NOT EXISTS `members_credits` (

  `id` int(5) NOT NULL AUTO_INCREMENT,

  `uid` mediumint(9) DEFAULT '0',

  `creditid` int(5) DEFAULT '0',

  `total_messages` int(11) DEFAULT '5',

  `pay_method` varchar(50) DEFAULT '0',

  `running` enum('yes','no') DEFAULT 'yes',

  `subscription` enum('yes','no') DEFAULT 'no',

  `bill_email` varchar(255) DEFAULT NULL,

  `transaction_id` varchar(50) NOT NULL DEFAULT '',

  PRIMARY KEY (`id`)

) ENGINE=MyISAM  DEFAULT CHARSET=utf8");



$DB->Update("CREATE TABLE IF NOT EXISTS `members_data_pending_approval` LIKE `members_data`");



$DB->Update("CREATE TABLE IF NOT EXISTS `members_reported` (

  `id` int(5) NOT NULL AUTO_INCREMENT,

  `uid` int(5) DEFAULT '0',

  `to_uid` int(5) DEFAULT '0',

  `date` date DEFAULT NULL,

  `visible` enum('yes','no') DEFAULT 'no',

  PRIMARY KEY (`id`),

  UNIQUE KEY `UNIQUE` (`uid`,`to_uid`),

  KEY `uid` (`uid`),

  KEY `to_uid` (`to_uid`),

  KEY `approved` (`visible`)

) ENGINE=MyISAM  DEFAULT CHARSET=utf8");



$DB->Update("CREATE TABLE IF NOT EXISTS `package_languages` (

  `id` int(11) NOT NULL AUTO_INCREMENT,

  `pid` int(11) NOT NULL,

  `caption` varchar(50) CHARACTER SET utf8 NOT NULL,

  `comments` varchar(200) CHARACTER SET utf8 NOT NULL,

  `language` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,

  PRIMARY KEY (`id`)

) ENGINE=MyISAM  DEFAULT CHARSET=latin1");


$DB->Update("CREATE TABLE IF NOT EXISTS `members_videochat` (

  `id` int(11)  NOT NULL  AUTO_INCREMENT,

  `uid` int(11) NOT NULL,

  `to_uid` int(11) NOT NULL,

  `session_id` varchar(200) NOT NULL,

  `token_id` text NOT NULL,

  `read` enum('yes','no') NOT NULL DEFAULT 'no',

  `datetime` datetime DEFAULT CURRENT_TIMESTAMP,

  PRIMARY KEY (`id`)

) ENGINE=MyISAM DEFAULT CHARSET=latin1");


$DB->Update("CREATE TABLE IF NOT EXISTS credits (
cid int(5) NOT NULL AUTO_INCREMENT,
name varchar(200) DEFAULT NULL,
price double DEFAULT '0',
type enum('system','custom') DEFAULT 'custom',
maxMessage int(11) DEFAULT '5',
subscription enum('yes','no') DEFAULT 'no',
currency_code varchar(10) DEFAULT NULL,
PRIMARY KEY (cid)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");




$Caption = $DB->Row("SELECT count(*) as count FROM credits ");

  if(empty($Caption['count'])){
  $DB->Update("INSERT INTO credits (cid, name, price, type, maxMessage, subscription, currency_code) VALUES
(1, '20', 20, 'custom', 500, 'yes', 'USD')");
}



echo "<p Style='border:1px solid #000000;float: left;padding: 10px 10px;'><b>Database has been updated successfully.</b><p>";



?>