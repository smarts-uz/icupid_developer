<?php

include"inc/config.php";


$DB->Update("CREATE TABLE IF NOT EXISTS `article_categories_assigned` (
  `article_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1");



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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ");



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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45");




$DB->Update("CREATE TABLE IF NOT EXISTS `compatibility_field_groups` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `caption` varchar(255) DEFAULT NULL,
  `forder` int(5) DEFAULT '1',
  `private` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5");



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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=69");





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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=69");



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


$DB->Update("CREATE TABLE IF NOT EXISTS `field_group_languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fgid` int(11) NOT NULL,
  `caption` varchar(255) CHARACTER SET utf8 NOT NULL,
  `language` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50");



$DB->Update("CREATE TABLE IF NOT EXISTS `geo_ip_contries` (
  `geo_ip_contry_id` int(11) NOT NULL AUTO_INCREMENT,
  `start_remote_ip_address` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `end_remote_ip_address` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `start_ip_num` bigint(20) NOT NULL,
  `end_ip_num` bigint(20) NOT NULL,
  `country_code` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `country_name` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `is_blocked` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  PRIMARY KEY (`geo_ip_contry_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=128261");



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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3119358");


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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=101663");

$DB->Update("CREATE TABLE IF NOT EXISTS `geo_network_countries` (
  `geo_network_country_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_code` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `country_name` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`geo_network_country_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=252");


$DB->Update("CREATE TABLE IF NOT EXISTS `geo_network_states` (
  `geo_network_state_id` int(11) NOT NULL AUTO_INCREMENT,
  `state_code` varchar(70) NOT NULL,
  `state_name` varchar(70) NOT NULL,
  `geo_network_country_id` int(11) NOT NULL,
  PRIMARY KEY (`geo_network_state_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2705");




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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ");


$DB->Update("CREATE TABLE IF NOT EXISTS `members_data_bkp` (
  `uid` mediumint(9) NOT NULL DEFAULT '0',
  `em_eha20070509` varchar(100) DEFAULT NULL,
  `em_86t20070511` int(3) DEFAULT '0',
  `em_8cx20070511` int(3) DEFAULT '0',
  `postcode` varchar(255) DEFAULT NULL,
  `age` varchar(255) DEFAULT '0',
  `headline` varchar(255) DEFAULT '0',
  `country` varchar(255) DEFAULT '0',
  `location` varchar(255) DEFAULT '0',
  `description` text,
  `gender` int(4) DEFAULT NULL,
  `em_hrh20080113` int(3) DEFAULT NULL,
  `em_kxb20080113` int(3) DEFAULT NULL,
  `em_1k820080113` int(3) DEFAULT NULL,
  `em_heh20080113` int(3) DEFAULT NULL,
  `em_93n20080113` int(3) DEFAULT NULL,
  `em_jsh20080113` int(3) DEFAULT NULL,
  `em_jhb20080113` int(3) DEFAULT NULL,
  `em_yh020080113` int(3) DEFAULT NULL,
  `em_7jr20080113` int(3) DEFAULT NULL,
  `em_wvh20080113` int(3) DEFAULT NULL,
  `em_vqf20080113` int(3) DEFAULT NULL,
  `em_qck20080113` int(3) DEFAULT NULL,
  `em_r9720080113` int(3) DEFAULT NULL,
  `em_rn620080113` int(3) DEFAULT NULL,
  `em_s1620080113` int(3) DEFAULT NULL,
  `em_kjc20080113` int(3) DEFAULT NULL,
  `em_72220080113` int(3) DEFAULT NULL,
  `em_txg20080113` int(3) DEFAULT NULL,
  `em_y8520080116` varchar(255) DEFAULT NULL,
  `em_grm20080116` varchar(255) DEFAULT NULL,
  `em_85820081128` int(3) DEFAULT NULL,
  `em_chn20090224` varchar(255) DEFAULT NULL,
  `em_rhr20090224` varchar(255) DEFAULT NULL,
  `em_7vv20090224` varchar(255) DEFAULT NULL,
  `em_qxs20090224` varchar(255) DEFAULT NULL,
  `em_5tt20090224` text,
  `em_gfk20090224` text,
  `em_sk920171229` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`uid`),
  KEY `postcode` (`postcode`),
  KEY `country` (`country`),
  KEY `location` (`location`),
  KEY `gender` (`gender`),
  KEY `age` (`age`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");




$DB->Update("CREATE TABLE IF NOT EXISTS `members_data_pending_approval` (
  `uid` mediumint(9) NOT NULL DEFAULT '0',
  `em_eha20070509` varchar(100) DEFAULT NULL,
  `em_86t20070511` int(3) DEFAULT '0',
  `em_8cx20070511` int(3) DEFAULT '0',
  `postcode` varchar(255) DEFAULT NULL,
  `age` varchar(255) DEFAULT '0',
  `headline` varchar(255) DEFAULT '0',
  `country` varchar(255) DEFAULT '0',
  `location` varchar(255) DEFAULT '0',
  `description` text,
  `gender` int(4) DEFAULT NULL,
  `em_hrh20080113` int(3) DEFAULT NULL,
  `em_kxb20080113` int(3) DEFAULT NULL,
  `em_1k820080113` int(3) DEFAULT NULL,
  `em_heh20080113` int(3) DEFAULT NULL,
  `em_93n20080113` int(3) DEFAULT NULL,
  `em_jsh20080113` int(3) DEFAULT NULL,
  `em_jhb20080113` int(3) DEFAULT NULL,
  `em_yh020080113` int(3) DEFAULT NULL,
  `em_7jr20080113` int(3) DEFAULT NULL,
  `em_wvh20080113` int(3) DEFAULT NULL,
  `em_vqf20080113` int(3) DEFAULT NULL,
  `em_qck20080113` int(3) DEFAULT NULL,
  `em_r9720080113` int(3) DEFAULT NULL,
  `em_rn620080113` int(3) DEFAULT NULL,
  `em_s1620080113` int(3) DEFAULT NULL,
  `em_kjc20080113` int(3) DEFAULT NULL,
  `em_72220080113` int(3) DEFAULT NULL,
  `em_txg20080113` int(3) DEFAULT NULL,
  `em_y8520080116` varchar(255) DEFAULT NULL,
  `em_grm20080116` varchar(255) DEFAULT NULL,
  `em_85820081128` int(3) DEFAULT NULL,
  `em_chn20090224` varchar(255) DEFAULT NULL,
  `em_rhr20090224` varchar(255) DEFAULT NULL,
  `em_7vv20090224` varchar(255) DEFAULT NULL,
  `em_qxs20090224` varchar(255) DEFAULT NULL,
  `em_5tt20090224` text,
  `em_gfk20090224` text,
  `em_sk920171229` varchar(255) DEFAULT NULL,
  `em_he820180321` varchar(255) DEFAULT NULL,
  `em_be320180321` int(3) DEFAULT NULL,
  `em_vxf20180321` int(1) DEFAULT NULL,
  PRIMARY KEY (`uid`),
  KEY `postcode` (`postcode`),
  KEY `country` (`country`),
  KEY `location` (`location`),
  KEY `gender` (`gender`),
  KEY `age` (`age`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");



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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18");



$DB->Update("CREATE TABLE IF NOT EXISTS `members_videochat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `to_uid` int(11) NOT NULL,
  `session_id` varchar(200) NOT NULL,
  `token_id` text NOT NULL,
  `read` enum('yes','no') NOT NULL DEFAULT 'no',
  `datetime` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=59");


$DB->Update("CREATE TABLE IF NOT EXISTS `mobile_admin` (
  `id` tinyint(4) NOT NULL,
  `mobile_image` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `page_contents` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");



$DB->Update("CREATE TABLE IF NOT EXISTS `tbl_rating` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `rate` varchar(11) NOT NULL,
  `rate_date` datetime DEFAULT NULL,
  `rate_exp` datetime,
  `description` varchar(255) NOT NULL,
  `transaction_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `transaction_id` varchar(255) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6");



$DB->Update("CREATE TABLE IF NOT EXISTS `t_add_friend` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `entity_id` int(100) NOT NULL,
  `friend_fb_id` int(100) NOT NULL,
  `friend_name` varchar(100) NOT NULL,
  `friend_picture` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1");



$DB->Update("CREATE TABLE IF NOT EXISTS `t_add_likes` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `entity_id` int(50) NOT NULL,
  `like_id` varchar(100) NOT NULL,
  `like_name` varbinary(50) NOT NULL,
  `like_picture` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1");


$DB->Update("CREATE TABLE IF NOT EXISTS `t_admin` (
  `aid` int(5) NOT NULL AUTO_INCREMENT COMMENT 'Admin id',
  `admin_username` varchar(30) NOT NULL COMMENT 'admin username',
  `admin_password` varchar(30) NOT NULL COMMENT 'admin password',
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12");


$DB->Update("CREATE TABLE IF NOT EXISTS `t_authtypes` (
  `authType_id` tinyint(3) NOT NULL AUTO_INCREMENT COMMENT 'Authentication type',
  `authName` varchar(150) NOT NULL COMMENT 'Authentication name',
  PRIMARY KEY (`authType_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Types of authentications for the appl' AUTO_INCREMENT=3");



$DB->Update("CREATE TABLE IF NOT EXISTS `t_chatmessages` (
  `mid` int(30) NOT NULL AUTO_INCREMENT COMMENT 'Message id',
  `sender` int(25) NOT NULL COMMENT 'sender entity id',
  `receiver` int(25) NOT NULL COMMENT 'reciever entity id',
  `message` varchar(2000) NOT NULL COMMENT 'actual chat message ',
  `msg_dt` datetime COMMENT 'Date and time of message',
  `user1` varchar(100) NOT NULL,
  `user2` varchar(100) NOT NULL,
  PRIMARY KEY (`mid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Contains chat messages' AUTO_INCREMENT=1");


$DB->Update("CREATE TABLE IF NOT EXISTS `t_city` (
  `City_Id` int(8) NOT NULL AUTO_INCREMENT COMMENT 'City Id',
  `State_Id` int(7) DEFAULT NULL COMMENT 'State Id',
  `Country_Id` int(6) NOT NULL COMMENT 'Country Id',
  `City_Name` varchar(100) NOT NULL COMMENT 'City Name',
  PRIMARY KEY (`City_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Cities in all states around all the countries' AUTO_INCREMENT=1");



$DB->Update("
CREATE TABLE IF NOT EXISTS `t_country` (
  `Country_Id` int(6) NOT NULL AUTO_INCREMENT COMMENT 'Country Id',
  `Country_Name` varchar(100) NOT NULL COMMENT 'Country name',
  PRIMARY KEY (`Country_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Country table' AUTO_INCREMENT=1");



$DB->Update("CREATE TABLE IF NOT EXISTS `t_details` (
  `d_id` int(100) NOT NULL AUTO_INCREMENT,
  `details_ques` varchar(200) NOT NULL,
  PRIMARY KEY (`d_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='t_details' AUTO_INCREMENT=4");




$DB->Update("CREATE TABLE IF NOT EXISTS `t_dislike_user` (
  `dislike_user_id` int(11) NOT NULL AUTO_INCREMENT,
  `entity1_id` int(11) NOT NULL,
  `entity2_id` int(11) NOT NULL,
  `created` datetime,
  PRIMARY KEY (`dislike_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1");



$DB->Update("CREATE TABLE IF NOT EXISTS `t_education` (
  `Education_Id` int(25) NOT NULL AUTO_INCREMENT COMMENT 'User Education Id',
  `Entity_Id` int(25) NOT NULL COMMENT 'Entity_Id',
  `Education_City` varchar(50) DEFAULT NULL COMMENT 'Education city',
  `Education_Country` varchar(50) DEFAULT NULL COMMENT 'Education Country',
  `Education_Institute` varchar(250) DEFAULT NULL COMMENT 'Education Institute',
  `Education_Degree` varchar(100) NOT NULL COMMENT 'Education Degree',
  `Education_Start_Date` date COMMENT 'Education start date',
  `Education_End_Date` date COMMENT 'Education end date',
  PRIMARY KEY (`Education_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1");


$DB->Update("CREATE TABLE IF NOT EXISTS `t_entity` (
  `Entity_Id` int(25) NOT NULL AUTO_INCREMENT COMMENT 'Entity Identifier',
  `Status` tinyint(2) NOT NULL DEFAULT '1',
  `Unique_Identifier` varchar(100) NOT NULL COMMENT 'Unique identifier for the entity',
  `Password` varchar(25) DEFAULT NULL COMMENT 'User password. Not encrypted for this phase.',
  `Create_Dt` datetime DEFAULT NULL COMMENT 'Date/time of creation.',
  `Last_Active_Dt_Time` datetime DEFAULT NULL COMMENT 'Date/time of last activity',
  `Device_Type` tinyint(2) NOT NULL COMMENT 'Device Type',
  `Device_Id` varchar(250) NOT NULL COMMENT 'Device Id',
  `authType` tinyint(2) NOT NULL COMMENT 'Authentication type fk from authtypes',
  PRIMARY KEY (`Entity_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Entity identifier' AUTO_INCREMENT=1");



$DB->Update("CREATE TABLE IF NOT EXISTS `t_entity_details` (
  `Entity_Id` int(25) NOT NULL COMMENT 'App User Id',
  `Fb_Id` varchar(150) DEFAULT NULL COMMENT 'User Facebook Id',
  `Google_Id` varchar(150) DEFAULT NULL COMMENT 'User Google Id',
  `First_Name` varchar(100) NOT NULL COMMENT 'User Firstname',
  `Last_Name` varchar(100) DEFAULT NULL COMMENT 'User Lastname',
  `Email` varchar(250) NOT NULL COMMENT 'User email address',
  `Country` varchar(70) DEFAULT NULL COMMENT 'Country from which the user is logging in',
  `City` varchar(70) DEFAULT NULL COMMENT 'City from which the user is logging in',
  `Current_Lat` varchar(30) DEFAULT NULL COMMENT 'Latitude for current logged in location',
  `Current_Long` varchar(30) DEFAULT NULL COMMENT 'Longitude for current logged in location',
  `Profile_Pic_Url` varchar(300) DEFAULT 'http://elluminati.in/Flamer_nofacebook/pics/default.png' COMMENT 'URL of the profile picture',
  `TagLine` varchar(400) NOT NULL DEFAULT '' COMMENT 'Tag line for the user profile',
  `Sex` tinyint(1) NOT NULL COMMENT '1 - male, 2 - female',
  `Device_Type` int(50) NOT NULL,
  `pushtoken` varchar(700) NOT NULL COMMENT 'Quickblocks_Id',
  `Personal_Desc` varchar(600) NOT NULL DEFAULT '' COMMENT 'Personal Description of the user',
  `DOB` date DEFAULT NULL COMMENT 'User Date of Birth',
  `Skill_Rating` tinyint(1) DEFAULT NULL COMMENT 'User skill rating',
  `Status` varchar(500) NOT NULL,
  PRIMARY KEY (`Entity_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='User details table'");



$DB->Update("CREATE TABLE IF NOT EXISTS `t_likes` (
  `Like_Id` int(25) NOT NULL AUTO_INCREMENT COMMENT 'Like Id for the user',
  `Entity1_Id` int(25) NOT NULL COMMENT 'User id who liked the other user',
  `Entity2_Id` int(25) NOT NULL COMMENT 'User id who is getting liked',
  `Like_Flag` tinyint(1) NOT NULL COMMENT '1 -> Liked, 2-> DisLiked, 3-> Liked by both, 4->blocked',
  `Like_DateTime` datetime COMMENT 'Date and time of the like',
  `Update_Dt` datetime COMMENT 'updated date time',
  `Dislike_Count` int(5) NOT NULL COMMENT 'Count of dislikes',
  PRIMARY KEY (`Like_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='List of mutual  likes' AUTO_INCREMENT=1");




$DB->Update("CREATE TABLE IF NOT EXISTS `t_matches` (
  `Match_Id` int(25) NOT NULL AUTO_INCREMENT COMMENT 'March Id',
  `Matched_entity1_Id` int(25) NOT NULL COMMENT 'First User who is participating in the match',
  `Matched_entity2_Id` int(25) NOT NULL COMMENT 'Second User who is participating in the match',
  `Mathc_requestor_Id` int(25) NOT NULL COMMENT 'User who is Match maker ',
  `Match_Type` tinyint(1) NOT NULL COMMENT '0 ->  normal match, 1 -> booty call match, 2 -> blind date match, 4 -> matchmaking',
  `Match_Date_Time` datetime COMMENT 'March date and time',
  `Status` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'default = 0 = unblocked , 1 = unblocked and invite sent , 2 = invite declined 3 = invite accepted 4 = blocked',
  `Blind_Date_Location` varchar(400) DEFAULT NULL COMMENT 'This is the location for the blind date',
  PRIMARY KEY (`Match_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='List of Matches Per User' AUTO_INCREMENT=2");


$DB->Update("CREATE TABLE IF NOT EXISTS `t_moment_likes` (
  `moment_like_id` int(11) NOT NULL AUTO_INCREMENT,
  `moment_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `like_flag` tinyint(1) NOT NULL,
  `system_created_datetime` datetime DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  PRIMARY KEY (`moment_like_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1");

$DB->Update("CREATE TABLE IF NOT EXISTS `t_preferences` (
  `Entity_Id` int(25) NOT NULL COMMENT 'Entityid',
  `Preference_Sex` tinyint(1) NOT NULL COMMENT '1 - male, 2 - female',
  `Preference_lower_age` int(3) NOT NULL DEFAULT '0' COMMENT 'Prefered lower age',
  `Preference_upper_age` int(3) NOT NULL DEFAULT '0' COMMENT 'prefered upper age',
  `Preference_radius` double NOT NULL DEFAULT '10' COMMENT 'prefered radius',
  `Preference_discovery` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=off, 1=on',
  UNIQUE KEY `Entity_Id` (`Entity_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='List of PreferencesPer User'");



$DB->Update("CREATE TABLE IF NOT EXISTS `t_settings` (
  `setting_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `notification_new_matches` tinyint(1) DEFAULT '1',
  `notification_messages` tinyint(1) DEFAULT '1',
  `notification_moment_likes` tinyint(1) DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");



$DB->Update("CREATE TABLE IF NOT EXISTS `t_statusmessages` (
  `sid` int(4) NOT NULL AUTO_INCREMENT COMMENT 'Status id',
  `statusNumber` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 - success, 1 - error',
  `statusMessage` varchar(400) NOT NULL COMMENT 'brief status message',
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='status messages for the appl response' AUTO_INCREMENT=71");



$DB->Update("CREATE TABLE IF NOT EXISTS `t_subscription` (
  `id` int(40) NOT NULL AUTO_INCREMENT,
  `entity_id` int(40) NOT NULL,
  `joined_date` date,
  `last_payment_date` date,
  PRIMARY KEY (`id`),
  UNIQUE KEY `entity_id` (`entity_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ");



$DB->Update("CREATE TABLE IF NOT EXISTS `t_uploads` (
  `upload_id` int(11) NOT NULL AUTO_INCREMENT,
  `entity_id` int(11) NOT NULL,
  `upload_url` text COLLATE utf8_unicode_ci NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `upload_detail` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`upload_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1");



$DB->Update("CREATE TABLE IF NOT EXISTS `t_user_likes` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `entity_id` int(25) NOT NULL,
  `like_id` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1");



$DB->Update("CREATE TABLE IF NOT EXISTS `t_user_sessions` (
  `sid` int(20) NOT NULL AUTO_INCREMENT COMMENT 'Session id',
  `oid` int(20) NOT NULL COMMENT 'Object Id',
  `token` varchar(500) NOT NULL COMMENT 'Session token',
  `expiry_gmt` datetime COMMENT 'Session expiry date and time in GMT',
  `device` varchar(500) NOT NULL COMMENT 'Device on which session is generated',
  `type` int(4) NOT NULL COMMENT 'Type of device or platform',
  `push_token` varchar(700) DEFAULT NULL COMMENT 'Token for push notification',
  `create_date_gmt` datetime COMMENT 'Current date and time in GMT',
  `loggedIn` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 - logged in, 2 - logged out',
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='stores multiple session token for all the users' AUTO_INCREMENT=1");



$DB->Update("CREATE TABLE IF NOT EXISTS `t_work_experience` (
  `Work_Id` int(25) NOT NULL AUTO_INCREMENT,
  `Entity_Id` int(25) NOT NULL COMMENT 'Entity_id',
  `Work_city` varchar(50) DEFAULT NULL,
  `work_country` varchar(50) DEFAULT NULL,
  `work_company` varchar(150) NOT NULL,
  `work_post` varchar(100) NOT NULL,
  `work_start_date` date DEFAULT NULL,
  `work_end_date` date DEFAULT NULL,
  PRIMARY KEY (`Work_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='List of work experience for each user' AUTO_INCREMENT=1");


?>

































