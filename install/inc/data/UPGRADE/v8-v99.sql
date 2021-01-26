
DROP TABLE IF EXISTS members_admin;

CREATE TABLE IF NOT EXISTS `members_admin` (
  `id` int(11) NOT NULL auto_increment,
  `access_level` varchar(200) default NULL,
  `last_login` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `username` varchar(100) default NULL,
  `password` varchar(100) default NULL,
  `email` varchar(255) default NULL,
  `icon` varchar(100) NOT NULL default '',
  `logincount` int(5) NOT NULL default '0',
  `ip` varchar(20) NOT NULL default '',
  `pass_reset` enum('yes','no') NOT NULL default 'no',
  `fullname` varchar(200) NOT NULL default '',
  `language` varchar(15) NOT NULL default '',
  `alerts` enum('yes','no') NOT NULL default 'yes',
  `admin_alerts` enum('yes','no') NOT NULL default 'yes',
  `liveEmail` enum('yes','no') NOT NULL default 'no',
  `liveEdit` enum('yes','no') NOT NULL default 'no',
  `liveDelete` enum('yes','no') NOT NULL default 'no',
  PRIMARY KEY  (`id`)
);

DROP TABLE IF EXISTS im;

CREATE TABLE IF NOT EXISTS `im` (
  `dataid` mediumint(9) NOT NULL auto_increment,
  `from_uid` mediumint(9) default '0',
  `to_uid` mediumint(9) default '0',
  `date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `message` mediumtext,
  `read` enum('yes','no') default 'no',
  `avartar` varchar(40) NOT NULL default '',
  PRIMARY KEY  (`dataid`),
  KEY `from_uid` (`from_uid`),
  KEY `to_uid` (`to_uid`),
  KEY `read` (`read`)
);

DROP TABLE IF EXISTS class_cats;

CREATE TABLE IF NOT EXISTS `class_cats` (
  `id` int(5) NOT NULL auto_increment,
  `name` varchar(150) default NULL,
  `lang` varchar(20) default NULL,
  `icon` varchar(255) NOT NULL default '',
  `subId` int(20) NOT NULL default '0',
  PRIMARY KEY  (`id`)
);

INSERT INTO `class_cats` VALUES(106, 'Dating', '0', '', 0);
INSERT INTO `class_cats` VALUES(107, 'Men Seek Both\r\n', '0', '', 106);
INSERT INTO `class_cats` VALUES(20, 'Services', '0', '', 0);
INSERT INTO `class_cats` VALUES(21, 'Pets', '0', '', 0);
INSERT INTO `class_cats` VALUES(19, 'Tickets & Events', '0', '', 0);
INSERT INTO `class_cats` VALUES(18, 'For Rent', '0', '', 0);
INSERT INTO `class_cats` VALUES(17, 'Buy/Sell/Trade', '0', '', 0);
INSERT INTO `class_cats` VALUES(16, 'Jobs', '0', '', 0);
INSERT INTO `class_cats` VALUES(14, 'Cars & Vehicles', '0', '', 0);
INSERT INTO `class_cats` VALUES(15, 'Real Estate', '0', '', 0);
INSERT INTO `class_cats` VALUES(109, 'Men Seek Women\r\n', '0', '', 106);
INSERT INTO `class_cats` VALUES(24, 'Boats', '0', '', 14);
INSERT INTO `class_cats` VALUES(25, 'Cars', '0', '', 14);
INSERT INTO `class_cats` VALUES(26, 'Commercial Trucks', '0', '', 14);
INSERT INTO `class_cats` VALUES(27, 'Heavy Equipment', '0', '', 14);
INSERT INTO `class_cats` VALUES(28, 'Motorcycles', '0', '', 14);
INSERT INTO `class_cats` VALUES(29, 'Parts & Accessories', '0', '', 14);
INSERT INTO `class_cats` VALUES(30, 'Power Sports', '0', '', 14);
INSERT INTO `class_cats` VALUES(31, 'RVs', '0', '', 14);
INSERT INTO `class_cats` VALUES(32, 'Everything Else', '0', '', 14);
INSERT INTO `class_cats` VALUES(108, 'Men Seek Men', '0', '', 106);
INSERT INTO `class_cats` VALUES(35, 'Condo/Townhome', '0', '', 15);
INSERT INTO `class_cats` VALUES(36, 'Farm/Ranch', '0', '', 15);
INSERT INTO `class_cats` VALUES(37, 'Foreclosures', '0', '', 15);
INSERT INTO `class_cats` VALUES(38, 'Land', '0', '', 15);
INSERT INTO `class_cats` VALUES(39, 'Mobile Homes', '0', '', 15);
INSERT INTO `class_cats` VALUES(40, 'Multi Family', '0', '', 15);
INSERT INTO `class_cats` VALUES(41, 'Open Houses', '0', '', 15);
INSERT INTO `class_cats` VALUES(42, 'Single Family', '0', '', 15);
INSERT INTO `class_cats` VALUES(43, 'Storage', '0', '', 15);
INSERT INTO `class_cats` VALUES(44, 'Vacation Property', '0', '', 15);
INSERT INTO `class_cats` VALUES(45, 'Other', '0', '', 15);
INSERT INTO `class_cats` VALUES(46, 'Account & Finance', '0', '', 16);
INSERT INTO `class_cats` VALUES(47, 'Admin & Clerical', '0', '', 16);
INSERT INTO `class_cats` VALUES(80, 'Activities', '0', '', 19);
INSERT INTO `class_cats` VALUES(49, 'Advert, Market,', '0', '', 16);
INSERT INTO `class_cats` VALUES(51, 'Architect & Design', '0', '', 16);
INSERT INTO `class_cats` VALUES(52, 'Arts & Media', '0', '', 16);
INSERT INTO `class_cats` VALUES(53, 'Civil Serv & Policy', '0', '', 16);
INSERT INTO `class_cats` VALUES(54, 'Construct & Trades', '0', '', 16);
INSERT INTO `class_cats` VALUES(55, 'Customer Service', '0', '', 16);
INSERT INTO `class_cats` VALUES(56, 'Domestic Help & Care', '0', '', 16);
INSERT INTO `class_cats` VALUES(57, 'Engineering', '0', '', 16);
INSERT INTO `class_cats` VALUES(58, 'Appliances', '0', '', 17);
INSERT INTO `class_cats` VALUES(59, 'Books & Magazines\r\n', '0', '', 17);
INSERT INTO `class_cats` VALUES(60, 'Clothes & Accessories\r\n', '0', '', 17);
INSERT INTO `class_cats` VALUES(61, 'Collectibles\r\n', '0', '', 17);
INSERT INTO `class_cats` VALUES(62, 'Computers & Access\r\n', '0', '', 17);
INSERT INTO `class_cats` VALUES(63, 'Electronics\r\n', '0', '', 17);
INSERT INTO `class_cats` VALUES(64, 'Entertainment\r\n', '0', '', 17);
INSERT INTO `class_cats` VALUES(65, 'Free\r\n', '0', '', 17);
INSERT INTO `class_cats` VALUES(66, 'Furniture\r\n', '0', '', 17);
INSERT INTO `class_cats` VALUES(67, 'Garage & Yard Sales', '0', '', 17);
INSERT INTO `class_cats` VALUES(68, 'Apartments\r\n', '0', '', 18);
INSERT INTO `class_cats` VALUES(69, 'Commercial\r\n', '0', '', 18);
INSERT INTO `class_cats` VALUES(70, 'Condos\r\n', '0', '', 18);
INSERT INTO `class_cats` VALUES(71, 'Garages\r\n', '0', '', 18);
INSERT INTO `class_cats` VALUES(72, 'Homes\r\n', '0', '', 18);
INSERT INTO `class_cats` VALUES(73, 'Mobile Homes\r\n', '0', '', 18);
INSERT INTO `class_cats` VALUES(74, 'Open Houses\r\n', '0', '', 18);
INSERT INTO `class_cats` VALUES(75, 'Roommates\r\n', '0', '', 18);
INSERT INTO `class_cats` VALUES(76, 'Short Term\r\n', '0', '', 18);
INSERT INTO `class_cats` VALUES(77, 'Storage\r\n', '0', '', 18);
INSERT INTO `class_cats` VALUES(78, 'Vacation\r\n', '0', '', 18);
INSERT INTO `class_cats` VALUES(79, 'Other\r\n\r\n', '0', '', 18);
INSERT INTO `class_cats` VALUES(81, 'Concerts\r\n', '0', '', 19);
INSERT INTO `class_cats` VALUES(82, 'Sports\r\n', '0', '', 19);
INSERT INTO `class_cats` VALUES(83, 'Theater\r\n', '0', '', 19);
INSERT INTO `class_cats` VALUES(84, 'Other', '0', '', 19);
INSERT INTO `class_cats` VALUES(85, 'Auto\r\n', '0', '', 20);
INSERT INTO `class_cats` VALUES(86, 'Child & Elderly Care\r\n', '0', '', 20);
INSERT INTO `class_cats` VALUES(87, 'Cleaning\r\n', '0', '', 20);
INSERT INTO `class_cats` VALUES(88, 'Coupons\r\n', '0', '', 20);
INSERT INTO `class_cats` VALUES(89, 'Financial\r\n', '0', '', 20);
INSERT INTO `class_cats` VALUES(90, 'Health & Beauty\r\n', '0', '', 20);
INSERT INTO `class_cats` VALUES(91, 'Home\r\n', '0', '', 20);
INSERT INTO `class_cats` VALUES(92, 'Lawn & Garden\r\n', '0', '', 20);
INSERT INTO `class_cats` VALUES(93, 'Legal\r\n', '0', '', 20);
INSERT INTO `class_cats` VALUES(94, 'Lessons', '0', '', 20);
INSERT INTO `class_cats` VALUES(95, 'Birds\r\n', '0', '', 21);
INSERT INTO `class_cats` VALUES(96, 'Cats\r\n', '0', '', 21);
INSERT INTO `class_cats` VALUES(97, 'Dogs\r\n', '0', '', 21);
INSERT INTO `class_cats` VALUES(98, 'Fish\r\n', '0', '', 21);
INSERT INTO `class_cats` VALUES(99, 'Horses\r\n', '0', '', 21);
INSERT INTO `class_cats` VALUES(100, 'Livestock\r\n', '0', '', 21);
INSERT INTO `class_cats` VALUES(101, 'Pet Supplies', '0', '', 21);
INSERT INTO `class_cats` VALUES(102, 'Rabbits', '0', '', 21);
INSERT INTO `class_cats` VALUES(103, 'Reptiles\r\n', '0', '', 21);
INSERT INTO `class_cats` VALUES(104, 'Small & Furry\r\n', '0', '', 21);
INSERT INTO `class_cats` VALUES(105, 'Other', '0', '', 21);
INSERT INTO `class_cats` VALUES(110, 'Missed Connections\r\n', '0', '', 106);
INSERT INTO `class_cats` VALUES(111, 'Women Seek Both', '0', '', 106);
INSERT INTO `class_cats` VALUES(112, 'Women Seek Men', '0', '', 106);
INSERT INTO `class_cats` VALUES(113, 'Women Seek Women', '0', '', 106);
INSERT INTO `class_cats` VALUES(114, 'Everyone Else', '0', '', 106);

DROP TABLE IF EXISTS class_adverts;

CREATE TABLE IF NOT EXISTS `class_adverts` (
  `id` int(10) NOT NULL auto_increment,
  `uid` int(10) default NULL,
  `cat_id` int(10) default NULL,
  `title` varchar(255) default NULL,
  `sub_title` varchar(255) NOT NULL default '',
  `comments` mediumtext,
  `summary` mediumblob NOT NULL,
  `date_added` date default NULL,
  `date_updated` date default NULL,
  `hits` int(5) NOT NULL default '0',
  `pic1` varchar(100) NOT NULL default 'no_photo.gif',
  `pic2` varchar(255) NOT NULL default '',
  `pic3` varchar(100) NOT NULL default '',
  `pic4` varchar(100) NOT NULL default '',
  `pic5` varchar(100) NOT NULL default '',
  `pic6` varchar(100) NOT NULL default '',
  `pic7` varchar(100) NOT NULL default '',
  `pic8` varchar(100) NOT NULL default '',
  `recommends` int(5) NOT NULL default '0',
  `rating` float(12,2) NOT NULL default '0.00',
  `rating_votes` int(5) NOT NULL default '0',
  `featured` enum('yes','no') NOT NULL default 'no',
  `approved` enum('yes','no') NOT NULL default 'no',
  `attachment` int(15) NOT NULL default '0',
  PRIMARY KEY  (`id`)
);

DROP TABLE IF EXISTS calendar_data;

CREATE TABLE IF NOT EXISTS `calendar_data` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `uid` int(10) default NULL,
  `eventdate` date default NULL,
  `eventtime` time default '25:00:00',
  `shortevent` varchar(255) default NULL,
  `longevent` blob,
  `type_1` varchar(50) default NULL,
  `type_2` varchar(50) default NULL,
  `country` varchar(255) default NULL,
  `province` varchar(255) default NULL,
  `city` varchar(255) default NULL,
  `street` varchar(255) default NULL,
  `phone` varchar(255) default NULL,
  `email` varchar(255) default NULL,
  `website` varchar(255) default NULL,
  `vis` enum('all','friends') default 'all',
  `approved` enum('yes','no','cancelled') default 'no',
  `featured` enum('yes','no') NOT NULL default 'no',
  `recurring` enum('yes','no') NOT NULL default 'no',
  `photo` varchar(50) NOT NULL default '',
  `hits` int(10) NOT NULL default '0',
  `rating` float NOT NULL default '0',
  `rating_votes` int(10) NOT NULL default '0',
  `attachment` int(15) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `eventdate` (`eventdate`),
  KEY `eventtime` (`eventtime`),
  KEY `uid` (`uid`),
  KEY `type_1` (`type_1`),
  KEY `approved` (`approved`),
  KEY `featured` (`featured`),
  KEY `attachment` (`attachment`)
);

DROP TABLE IF EXISTS groups;

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(10) NOT NULL auto_increment,
  `cat_id` int(5) default NULL,
  `uid` int(10) default NULL,
  `name` varchar(255) default NULL,
  `description` mediumtext,
  `join_open` enum('yes','no') default 'yes',
  `join_password` varchar(25) default NULL,
  `member_invite` enum('yes','no') default 'yes',
  `member_posts` enum('yes','no') default 'yes',
  `photo` varchar(50) NOT NULL default '',
  `created` datetime default NULL,
  `updated` datetime default NULL,
  `rating` int(10) NOT NULL default '0',
  `rating_votes` float NOT NULL default '0',
  `hits` int(10) NOT NULL default '0',
  `approved` enum('yes','no') NOT NULL default 'no',
  `attachment` int(15) NOT NULL default '0',
  `featured` enum('yes','no') NOT NULL default 'no',
  PRIMARY KEY  (`id`)
);

DROP TABLE IF EXISTS groups_cats;

CREATE TABLE IF NOT EXISTS `groups_cats` (
  `id` int(5) NOT NULL auto_increment,
  `name` varchar(150) default NULL,
  `lang` varchar(20) default NULL,
  `photo` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`id`)
);

INSERT INTO `groups_cats` VALUES(2, 'Activities & Hobbies', 'english', 'group1.jpg');
INSERT INTO `groups_cats` VALUES(3, 'Cars, Bikes & Ridez', 'english', 'group2.jpg');
INSERT INTO `groups_cats` VALUES(4, 'College & University', 'english', 'group3.jpg');
INSERT INTO `groups_cats` VALUES(5, 'Events & Nightlife', 'english', 'group4.jpg');
INSERT INTO `groups_cats` VALUES(6, 'Gay, Bi & Lesbian', 'english', 'group5.jpg');
INSERT INTO `groups_cats` VALUES(7, 'Music', 'english', 'group6.jpg');
INSERT INTO `groups_cats` VALUES(8, 'TV & Movies', 'english', 'group7.jpg');
INSERT INTO `groups_cats` VALUES(9, 'Beliefs & Cultures', 'english', 'group8.jpg');
INSERT INTO `groups_cats` VALUES(10, 'Celebrity & Fame', 'english', 'group9.jpg');
INSERT INTO `groups_cats` VALUES(11, 'Computers & Games', 'english', 'group10.jpg');
INSERT INTO `groups_cats` VALUES(12, 'Fashion & Beauty', 'english', 'group11.jpg');
INSERT INTO `groups_cats` VALUES(13, 'Holidays & Travel', 'english', 'group12.jpg');
INSERT INTO `groups_cats` VALUES(14, 'Sex & Fetishes', 'english', 'group13.jpg');
INSERT INTO `groups_cats` VALUES(15, 'Towns & Places', 'english', 'group14.jpg');

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) NOT NULL auto_increment,
  `to_uid` int(10) NOT NULL default '0',
  `from_uid` int(10) default NULL,
  `ex1_id` varchar(25) default NULL,
  `ex2_id` int(15) default NULL,
  `ex3_id` int(15) default NULL,
  `comments` mediumtext,
  `date` date default NULL,
  `time` time NOT NULL default '00:00:00',
  `approved` enum('yes','no') NOT NULL default 'no',
  `page` varchar(50) NOT NULL default '',
  `sub` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`id`)
);

CREATE TABLE IF NOT EXISTS `members_template` (
  `uid` int(11) NOT NULL,
  `updated` date,
  `font1` varchar(50) NOT NULL,
  `font2` varchar(50) NOT NULL,
  `background` varchar(50) NOT NULL,
  `background_image` varchar(255) NOT NULL,
  `background_image_display` varchar(20) NOT NULL,
  `inner_background` varchar(10) NOT NULL,
  `header_text` varchar(10) NOT NULL,
  `header_background` varchar(10) NOT NULL,
  `header_image` varchar(150) NOT NULL,
  `header_image_display` varchar(20) NOT NULL,
  `subheader_title` varchar(10) NOT NULL,
  `subheader_background` varchar(10) NOT NULL,
  `color_text` varchar(10) NOT NULL,
  `color_link` varchar(10) NOT NULL,
  `css_file` blob NOT NULL,
  PRIMARY KEY  (`uid`)
);

CREATE TABLE IF NOT EXISTS `member_searches` (
  `search_id` int(10) NOT NULL auto_increment,
  `uid` int(10) NOT NULL,
  `search_date` datetime,
  `search_string` blob NOT NULL,
  `search_name` varchar(100) NOT NULL,
  PRIMARY KEY  (`search_id`)
);
CREATE TABLE IF NOT EXISTS `email_scheduler` (
  `send_id` int(10) NOT NULL auto_increment,
  `send_name` varchar(150) NOT NULL,
  `send_gender` int(5) NOT NULL,
  `send_photo` int(1) NOT NULL,
  `send_account` enum('active','suspended','unapproved','cancel','none') NOT NULL default 'none',
  `send_membership` int(10) NOT NULL,
  `send_country` varchar(150) NOT NULL,
  `send_nid` int(10) NOT NULL,
  `send_time` int(5) NOT NULL,
  `send_key` varchar(50) NOT NULL,
  PRIMARY KEY  (`send_id`)
);

CREATE TABLE IF NOT EXISTS `videos_watched` (
  `id` int(5) NOT NULL auto_increment,
  `vid_id` varchar(30) NOT NULL,
  `views` int(5) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
);


CREATE TABLE IF NOT EXISTS `system_templates` (
  `id` int(5) NOT NULL auto_increment,
  `template_id` varchar(100) NOT NULL,
  `cat` int(5) NOT NULL,
  `name` varchar(100) NOT NULL,
  `preview` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
);

CREATE TABLE IF NOT EXISTS `members_template` (
  `uid` int(11) NOT NULL,
  `updated` date,
  `font1` varchar(50) NOT NULL,
  `font2` varchar(50) NOT NULL,
  `background` varchar(50) NOT NULL,
  `background_image` varchar(255) NOT NULL,
  `background_image_display` varchar(20) NOT NULL,
  `inner_background` varchar(10) NOT NULL,
  `header_text` varchar(10) NOT NULL,
  `header_background` varchar(10) NOT NULL,
  `header_image` varchar(150) NOT NULL,
  `header_image_display` varchar(20) NOT NULL,
  `subheader_title` varchar(10) NOT NULL,
  `subheader_background` varchar(10) NOT NULL,
  `color_text` varchar(10) NOT NULL,
  `color_link` varchar(10) NOT NULL,
  `css_file` blob NOT NULL,
  PRIMARY KEY  (`uid`)
);

CREATE TABLE IF NOT EXISTS `game_scores` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(255) NOT NULL default '',
  `thescore` decimal(20,0) default NULL,
  `ip` varchar(255) NOT NULL default '0',
  `phpdate` date,
  `gamename` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `username` (`username`)
);


DROP TABLE IF EXISTS game_games;

CREATE TABLE IF NOT EXISTS `game_games` (
  `id` int(11) NOT NULL auto_increment,
  `game` varchar(255) default NULL,
  `gameid` varchar(255) NOT NULL default '',
  `gameheight` smallint(3) NOT NULL default '0',
  `gamewidth` smallint(3) NOT NULL default '0',
  `about` varchar(255) NOT NULL default '',
  `gamecat` varchar(255) NOT NULL default '',
  `remotelink` varchar(255) NOT NULL default '',
  `Champion_name` varchar(255) NOT NULL default '',
  `Champion_score` decimal(20,0) default NULL,
  `times_played` int(11) default '0',
  `last_played` datetime default NULL,
  `rating` float NOT NULL default '0',
  `rating_votes` int(5) NOT NULL default '0',
  UNIQUE KEY `id` (`id`),
  KEY `gamecat` (`gamecat`),
  KEY `gameid` (`gameid`)
);

INSERT INTO `game_games` (`id`, `game`, `gameid`, `gameheight`, `gamewidth`, `about`, `gamecat`, `remotelink`, `Champion_name`, `Champion_score`, `times_played`, `last_played`, `rating`, `rating_votes`) VALUES
(33, '100m Running', '100mRunning', 450, 600, ' Run 100M as fast as you can, your best time will be submitted. ', '', '', '', 0, 5, NULL, 10, 2),
(34, 'X-Training', '1055_kail', 300, 400, 'A game of survival', '', '', 'mark', 11, 19, NULL, 0, 0),
(35, 'Maze Game', '123mazeibpg', 314, 352, 'Can you get the ball to end?', '', '', '', 0, 3, NULL, 0, 0),
(36, '12 Many', '12manyibpa', 360, 480, 'How many stars shine in the sky?', '', '', '', 0, 3, NULL, 0, 0),
(37, 'Bat &amp; Mouse 2', '1996_BatAndMouse2', 400, 550, ' Your the mouse, avoid the bat and other enemies and collect as much cheese as possible&amp;#33; ', '', '', '', 0, 4, NULL, 0, 0),
(38, 'Monkey Cliff Diving', '23ing', 400, 500, 'Help the monkeys dive safely into the water.', '', '', '', 0, 7, NULL, 0, 0),
(39, '24 Hours Rally', '24hrally', 310, 570, ' You are the guy on the motorcycle, and all you have to do it beat all the cars&amp;#33; ', '', '', '', 0, 10, NULL, 0, 0),
(40, '30k Starfighter', '30kstarfighter', 550, 550, ' Destroy enemies while collecting bonuses and power-ups. ', '', '', '', 0, 6, NULL, 0, 0),
(41, 'Candy Tetris', '710', 250, 390, 'Just Like tetris but candy style', '', '', '', 0, 8, NULL, 0, 0);


CREATE TABLE IF NOT EXISTS `game_cats` (
  `id` int(11) NOT NULL auto_increment,
  `cat` varchar(15) default NULL,
  UNIQUE KEY `id` (`id`)
);

CREATE TABLE IF NOT EXISTS `blog_comments` (
  `autoid` mediumint(9) NOT NULL auto_increment,
  `blogid` mediumint(9) default '0',
  `postid` mediumint(9) default '0',
  `uid` mediumint(9) default '0',
  `comments` mediumtext,
  `date` datetime default NULL,
  `approved` enum('yes','no') default 'no',
  PRIMARY KEY  (`autoid`)
);

CREATE TABLE IF NOT EXISTS `class_adverts` (
  `id` int(10) NOT NULL auto_increment,
  `uid` int(10) default NULL,
  `cat_id` int(10) default NULL,
  `title` varchar(255) default NULL,
  `sub_title` varchar(255) NOT NULL,
  `comments` mediumtext,
  `summary` mediumblob NOT NULL,
  `date_added` date default NULL,
  `date_updated` date,
  `hits` int(5) NOT NULL default '0',
  `pic1` varchar(100) NOT NULL default 'no_photo.gif',
  `pic2` varchar(255) NOT NULL,
  `pic3` varchar(100) NOT NULL,
  `pic4` varchar(100) NOT NULL,
  `pic5` varchar(100) NOT NULL,
  `pic6` varchar(100) NOT NULL,
  `pic7` varchar(100) NOT NULL,
  `pic8` varchar(100) NOT NULL,
  `recommends` int(5) NOT NULL,
  `rating` float(12,2) NOT NULL,
  `rating_votes` int(5) NOT NULL,
  `featured` enum('yes','no') NOT NULL default 'no',
  PRIMARY KEY  (`id`)
);

CREATE TABLE IF NOT EXISTS `members_admin_message` (
`id` INT( 5 ) NOT NULL AUTO_INCREMENT ,
`title` VARCHAR( 255 ) NOT NULL ,
`content` BLOB NOT NULL ,
`display` ENUM( 'yes', 'no' ) NOT NULL ,
PRIMARY KEY ( `id` ) 
);

CREATE TABLE IF NOT EXISTS `tag_cloud` (
`id` INT( 10 ) NOT NULL AUTO_INCREMENT ,
`page` VARCHAR( 15 ) NOT NULL ,
`keyword` VARCHAR( 50 ) NOT NULL ,
PRIMARY KEY ( `id` ) 
);

CREATE TABLE IF NOT EXISTS `calendar_types` (
  `id` int(5) NOT NULL auto_increment,
  `name` varchar(150) default NULL,
  `lang` varchar(20) default NULL,
  `icon` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
);

CREATE TABLE IF NOT EXISTS `system_settings` (
  `id` int(10) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `value1` varchar(255) NOT NULL,
  `value2` blob NOT NULL,
  PRIMARY KEY  (`id`)
);

CREATE TABLE IF NOT EXISTS `system_update` (
  `id` int(10) NOT NULL auto_increment,
  `date` datetime,
  `value1` varchar(150) NOT NULL,
  `value2` varchar(150) NOT NULL,
  PRIMARY KEY  (`id`)
);

DROP TABLE IF EXISTS blog_posts;

CREATE TABLE IF NOT EXISTS `blog_posts` (
  `id` int(5) NOT NULL auto_increment,
  `uid` mediumint(9) default '0',
  `title` varchar(255) default NULL,
  `comments` text,
  `date` datetime default NULL,
  `time` time default '00:00:00',
  `photo` varchar(100) NOT NULL default '',
  `rating` float NOT NULL default '0',
  `rating_votes` int(10) NOT NULL default '0',
  `hits` int(10) NOT NULL default '0',
  `approved` enum('yes','no') NOT NULL default 'no',
  `attachment` int(15) NOT NULL default '0',
  PRIMARY KEY  (`id`)
);

DROP TABLE IF EXISTS `system_log` ;


CREATE TABLE IF NOT EXISTS `system_log` (
  `id` int(5) NOT NULL auto_increment,
  `username` varchar(20) default '',
  `to_uid` int(10) NOT NULL default '0',
  `date` date default NULL,
  `time` time default '00:00:00',
  `value` varchar(255) default NULL,
  `value2` varchar(255) NOT NULL default '',
  `ip` varchar(50) default '',
  `type` varchar(50) NOT NULL default '',
  `page` varchar(10) NOT NULL default '',
  `sub` varchar(10) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `to_uid` (`to_uid`),
  KEY `page` (`page`),
  KEY `type` (`type`)
);


CREATE TABLE IF NOT EXISTS `member_rating` (
  `id` int(10) NOT NULL auto_increment,
  `uid` int(10) NOT NULL,
  `date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `vote_amount` int(5) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `profile_id` int(10) NOT NULL,
  PRIMARY KEY  (`id`)
);

 
ALTER TABLE `files` ADD `adult_content` ENUM( 'yes', 'no' ) NOT NULL DEFAULT 'no' AFTER `rating_votes` ;

ALTER TABLE `album` ADD `password` VARCHAR( 50 ) NOT NULL AFTER `allow_a` ;
ALTER TABLE `album` ADD `time` date AFTER `password` , ADD `date` date AFTER `time` ;

ALTER TABLE `members` ADD `member_rating` INT( 5 ) NOT NULL DEFAULT '0' AFTER `ip_code` ;
ALTER TABLE `members` ADD `msgStatus` VARCHAR( 255 ) NOT NULL AFTER `member_rating` ;
ALTER TABLE `members` ADD `video_duration` INT( 10 ) NOT NULL DEFAULT '0' AFTER `msgStatus` ;
ALTER TABLE `members` ADD `video_live` ENUM( 'yes', 'no' ) NOT NULL DEFAULT 'no' AFTER `video_duration` ;

ALTER TABLE `email_newsletters` CHANGE `status` `status` ENUM( 'system', 'custom', 'template', 'admin' ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'custom';
ALTER TABLE `email_newsletters` ADD `description` VARCHAR( 255 ) NOT NULL AFTER `image` ;

ALTER TABLE `members_privacy` ADD `skype` VARCHAR( 200 ) NOT NULL AFTER `email_match` ;
 

ALTER TABLE `banners` CHANGE `active` `active` ENUM( 'yes', 'no' ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'yes' ;
ALTER TABLE `banners` CHANGE `active` `active` ENUM( 'yes', 'no' ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'yes';

INSERT INTO `system_settings` (`id`, `name`, `value1`, `value2`) VALUES (1, 'welcome_email', '31', ''),
(2, 'welcome_sms', 'Welcome (username) to our website! Dont forget to tell your friends!!', ''),
(3, 'welcome_message', 'Welcome to our website!\r\n\r\nIf you have any problems, dont hesitate to contact us!\r\n\r\nKind Regards\r\n\r\nManagement', ''),
(4, 'welcome_subject', 'Welcome to our website!', ''),
(6, 'feed_calendar', 'dfsf', 0x736466),
(5, 'Terms and Conditions', '', '');


ALTER TABLE `field` ADD `linked_id` INT( 10 ) NOT NULL AFTER `matchpage` ;
ALTER TABLE `field` CHANGE `linked_id` `linked_id` INT( 10 ) NOT NULL DEFAULT '0';
ALTER TABLE `field` ADD `groupid_1` INT( 10 ) NOT NULL AFTER `linked_id` , ADD `groupid_2` INT( 10 ) NOT NULL AFTER `groupid_1` ;
UPDATE `field` SET `fType` = '3' WHERE `field`.`fid` =25 LIMIT 1 ;

ALTER TABLE `field_list_value` CHANGE `default` `default` ENUM( 'yes', 'no' ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'no';

ALTER TABLE `field_list_value` ADD `linked_cap_id` INT( 10 ) NOT NULL DEFAULT '0' AFTER `default` ;


INSERT INTO `members_admin_message` ( `id` , `title` , `content` , `display` )VALUES ('1', '', '', 'yes');

ALTER TABLE `members_privacy` ADD `profileview_friends` VARCHAR( 50 ) NOT NULL AFTER `skype` ,
ADD `profileview_nonfriend` VARCHAR( 50 ) NOT NULL AFTER `profileview_friends` ;

INSERT INTO `system_templates` (`id`, `template_id`, `cat`, `name`, `preview`, `description`) VALUES (6, '', 1, 'eMeeting Default Template', '', 'This is the default template installed with every software purchase. For more templates please refer to our website at www.datingscripts.co.uk');