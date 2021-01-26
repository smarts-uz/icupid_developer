CREATE TABLE `aff_banners` (
  `id` int(5) NOT NULL auto_increment,
  `filename` varchar(100) default NULL,
  `image_name` varchar(200) default NULL,
  `image_alt` varchar(200) default NULL,
  `image_link` varchar(200) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `aff_members` (
  `id` int(11) NOT NULL auto_increment,
  `joined` date default NULL,
  `username` varchar(25) default NULL,
  `password` varchar(100) default NULL,
  `firstname` varchar(50) default NULL,
  `lastname` varchar(50) default NULL,
  `businessname` varchar(100) default NULL,
  `address` varchar(255) default NULL,
  `street` varchar(255) default NULL,
  `town_city` varchar(255) default NULL,
  `state_county` varchar(255) default NULL,
  `zip_post` varchar(255) default NULL,
  `country` varchar(255) default NULL,
  `telephone` varchar(255) default NULL,
  `fax` varchar(255) default NULL,
  `email` varchar(255) default NULL,
  `website` varchar(255) default NULL,
  `payment_to` varchar(255) default NULL,
  `status` enum('active','unapproved') default 'active',
  `total_clicks` int(10) default NULL,
  `total_registered` int(10) default NULL,
  PRIMARY KEY  (`id`),
  KEY `username` (`username`),
  KEY `email` (`email`),
  KEY `total_clicks` (`total_clicks`),
  KEY `status` (`status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE `aff_pages` (
  `id` int(11) NOT NULL auto_increment,
  `page` varchar(50) default NULL,
  `title` varchar(255) default NULL,
  `content` longblob,
  `date` date default NULL,
  PRIMARY KEY  (`id`),
  KEY `page` (`page`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE `aff_payment` (
  `autoid` int(5) NOT NULL auto_increment,
  `member_id` int(5) default NULL,
  `affiliate_id` int(5) default NULL,
  `total_due` int(11) default NULL,
  `status` enum('approved','unapproved','canceled') default 'unapproved',
  `date` date default NULL,
  `paid` enum('yes','no') default 'no',
  PRIMARY KEY  (`autoid`),
  KEY `status` (`status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE `aff_signup` (
  `autoid` int(5) NOT NULL auto_increment,
  `affiliate_id` int(5) default NULL,
  `member_id` int(5) default NULL,
  `date` date default NULL,
  PRIMARY KEY  (`autoid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `album` (
  `aid` mediumint(9) NOT NULL auto_increment,
  `uid` mediumint(9) default '0',
  `title` varchar(255) default NULL,
  `comment` varchar(255) default NULL,
  `filecount` int(11) default '0',
  `cat` enum('public','private') default 'public',
  `allow_f` enum('y','n') default 'n',
  `allow_h` enum('y','n') default 'y',
  `allow_n` enum('y','n') default 'y',
  `allow_a` enum('y','n') default 'y',
  `password` varchar(50) character set latin1 NOT NULL default '',
  `time` date NULL default NULL,
  `date` date NULL default NULL,
  PRIMARY KEY  (`aid`),
  KEY `uid` (`uid`),
  KEY `cat` (`cat`),
  KEY `allow_f` (`allow_f`),
  KEY `allow_h` (`allow_h`),
  KEY `allow_n` (`allow_n`),
  KEY `allow_a` (`allow_a`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE `articles` (
  `id` int(5) NOT NULL auto_increment,
  `cat_id` int(5) NOT NULL default '0',
  `date` date NULL default NULL,
  `title` longtext NOT NULL,
  `content` longtext NOT NULL,
  `views` int(5) NOT NULL default '0',
  `short` longtext NOT NULL,
  `link` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `cat_id` (`cat_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE `articles_cat` (
  `id` int(5) NOT NULL auto_increment,
  `name` varchar(200) NOT NULL default '',
  `count` int(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE `badwords` (
  `id` int(5) NOT NULL auto_increment,
  `word` varchar(255) default NULL,
  PRIMARY KEY  (`id`),
  KEY `word` (`word`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE `banners` (
  `bid` int(5) NOT NULL auto_increment,
  `bName` varchar(150) default NULL,
  `imglocation` varchar(255) default NULL,
  `urllocation` varchar(255) default NULL,
  `page` varchar(150) default NULL,
  `active` enum('yes','no') default 'yes',
  `clicks` int(5) default '0',
  `width` varchar(5) default NULL,
  `height` varchar(5) default NULL,
  `impressions` int(5) default '0',
  `code` mediumtext,
  `position` varchar(10) default 'top',
  PRIMARY KEY  (`bid`),
  KEY `page` (`page`),
  KEY `position` (`position`),
  KEY `impressions` (`impressions`),
  KEY `active` (`active`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE `blog_links` (
  `id` int(5) NOT NULL auto_increment,
  `uid` mediumint(9) default '0',
  `name` varchar(255) default NULL,
  `link` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `blog_posts` (
  `id` int(5) NOT NULL auto_increment,
  `uid` mediumint(9) default '0',
  `title` varchar(255) default NULL,
  `comments` text,
  `date` datetime NULL default NULL,
  `time` time default '00:00:00',
  `photo` varchar(100) NOT NULL default '',
  `rating` float NOT NULL default '0',
  `rating_votes` int(10) NOT NULL default '0',
  `hits` int(10) NOT NULL default '0',
  `approved` enum('yes','no') NOT NULL default 'no',
  `attachment` int(15) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE `calendar_attending` (
  `id` int(5) NOT NULL auto_increment,
  `uid` int(5) default NULL,
  `event_id` int(5) default NULL,
  `date` date default NULL,
  PRIMARY KEY  (`id`),
  KEY `event_id` (`event_id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `calendar_data` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE `calendar_types` (
  `id` int(5) NOT NULL auto_increment,
  `name` varchar(150) default NULL,
  `lang` varchar(20) default NULL,
  `icon` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE `chatroom_messages` (
  `message_id` int(10) unsigned NOT NULL auto_increment,
  `message_username` varchar(56) default NULL,
  `message_date` int(10) unsigned default '0',
  `message_text` text,
  `message_pm_recipient` varchar(16) default NULL,
  `room_id` int(5) default NULL,
  PRIMARY KEY  (`message_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE `chatroom_onlinelist` (
  `username` varchar(56) default NULL,
  `online_time` int(10) unsigned default '0',
  `status` tinyint(1) unsigned default '1',
  `room_id` int(5) default NULL,
  KEY `room_id` (`room_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `chatroom_rooms` (
  `room_id` int(10) unsigned NOT NULL auto_increment,
  `room_name` varchar(56) default NULL,
  `room_count` int(10) unsigned default '0',
  `room_pass` varchar(100) default NULL,
  PRIMARY KEY  (`room_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE `chatroom_users` (
  `username_id` int(10) unsigned NOT NULL auto_increment,
  `username` varchar(56) default NULL,
  `password` varchar(32) default NULL,
  `password_salt` varchar(5) default NULL,
  `email` varchar(100) default NULL,
  `status` tinyint(1) unsigned default '1',
  `registered` int(10) unsigned default '0',
  PRIMARY KEY  (`username_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `class_adverts` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE `class_cats` (
  `id` int(5) NOT NULL auto_increment,
  `name` varchar(150) default NULL,
  `lang` varchar(20) default NULL,
  `icon` varchar(255) NOT NULL default '',
  `subId` int(20) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE `comments` (
  `id` int(10) NOT NULL auto_increment,
  `to_uid` int(10) NOT NULL default '0',
  `from_uid` int(10) default NULL,
  `ex1_id` varchar(25) default NULL,
  `ex2_id` varchar(255) default NULL,
  `ex3_id` int(15) default NULL,
  `comments` mediumtext,
  `date` date default NULL,
  `time` time NOT NULL default '00:00:00',
  `approved` enum('yes','no') NOT NULL default 'yes',
  `page` varchar(50) NOT NULL default '',
  `sub` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE `email_newsletters` (
  `nid` int(5) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `status` enum('system','custom','template') NOT NULL default 'custom',
  `content` longtext NOT NULL,
  `image` varchar(100) NOT NULL default 'images/newsletters/default.gif',
  `description` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`nid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE `email_sendtime` (
  `id` int(5) NOT NULL auto_increment,
  `email` varchar(200) default '0',
  `send_date` date default NULL,
  `nid` int(10) default NULL,
  `status` enum('sent','not-sent') default 'not-sent',
  `open_date` date default NULL,
  `stats_opened` int(5) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `faq` (
  `id` int(5) NOT NULL auto_increment,
  `date` date default NULL,
  `subject` varchar(255) default NULL,
  `content` text,
  `orderid` int(2) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE `field` (
  `fid` int(5) NOT NULL auto_increment,
  `fName` varchar(100) default NULL,
  `fType` int(1) default '0',
  `fOrder` int(3) default '0',
  `fGender` int(1) default '0',
  `groupid` int(11) default '1',
  `required` int(1) default '0',
  `browsepage` enum('yes','no') default 'no',
  `matchpage` enum('yes','no') default 'no',
  `linked_id` int(10) NOT NULL default '0',
  PRIMARY KEY  (`fid`),
  KEY `groupid` (`groupid`),
  KEY `fType` (`fType`),
  KEY `fGender` (`fGender`),
  KEY `required` (`required`),
  KEY `browsepage` (`browsepage`),
  KEY `matchpage` (`matchpage`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE `field_caption` (
  `id` int(5) NOT NULL auto_increment,
  `Cid` int(5) default '0',
  `lang` varchar(10) character set utf8 collate utf8_bin default NULL,
  `caption` varchar(255) default NULL,
  `description` varchar(255) default NULL,
  `match` enum('yes','no') default 'no',
  PRIMARY KEY  (`id`),
  KEY `Cid` (`Cid`),
  KEY `lang` (`lang`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE `field_groups` (
  `id` int(5) NOT NULL auto_increment,
  `caption` varchar(255) default NULL,
  `forder` int(5) default '1',
  `private` int(1) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE `field_list_value` (
  `id` int(10) NOT NULL auto_increment,
  `fvid` int(5) NOT NULL default '0',
  `fvFid` int(5) default '0',
  `fvCaption` varchar(255) default NULL,
  `fvOrder` int(5) default '1',
  `lang` varchar(10) default 'en',
  `default` enum('yes','no') NOT NULL default 'no',
  `linked_cap_id` int(10) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `fvid` (`fvid`),
  KEY `fvFid` (`fvFid`),
  KEY `lang` (`lang`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE `files` (
  `id` int(10) NOT NULL auto_increment,
  `aid` mediumint(9) default '0',
  `user` varchar(50) default NULL,
  `uid` mediumint(9) default '0',
  `date` date default NULL,
  `title` varchar(75) default NULL,
  `description` text,
  `bigimage` varchar(255) default NULL,
  `width` smallint(6) default NULL,
  `height` smallint(4) default NULL,
  `filesize` int(10) default '0',
  `views` int(10) default '0',
  `medwidth` int(12) default '0',
  `medheight` smallint(6) default '0',
  `medsize` mediumint(9) default '0',
  `approved` enum('yes','no') default 'no',
  `rating` float(12,2) default '0.00',
  `default` int(1) default '1',
  `featured` enum('yes','no') default 'no',
  `type` varchar(10) default 'photo',
  `rating_votes` int(5) default '0',
  `adult_content` enum('yes','no') NOT NULL default 'no',
  PRIMARY KEY  (`id`),
  KEY `userid` (`uid`),
  KEY `bigimage` (`bigimage`),
  KEY `aid` (`aid`),
  KEY `featured` (`featured`),
  KEY `approved` (`approved`),
  KEY `default` (`default`),
  KEY `adult_content` (`adult_content`),
  KEY `type` (`type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE `forum_banned` (
  `id` int(10) NOT NULL auto_increment,
  `banip` varchar(15) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `forum_forums` (
  `forum_id` int(10) NOT NULL auto_increment,
  `forum_name` varchar(150) default NULL,
  `forum_desc` text,
  `forum_order` int(10) default '0',
  `forum_icon` varchar(255) default 'default.gif',
  `topics_count` int(10) default '0',
  `posts_count` int(10) default '0',
  `forum_group` varchar(150) default NULL,
  PRIMARY KEY  (`forum_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE `forum_posts` (
  `post_id` int(10) NOT NULL auto_increment,
  `forum_id` int(10) default '1',
  `topic_id` int(10) default '1',
  `poster_id` int(10) default '0',
  `poster_name` varchar(40) default 'Anonymous',
  `post_text` text,
  `post_time` datetime default NULL,
  `poster_ip` varchar(15) default NULL,
  `post_status` tinyint(1) default '0',
  PRIMARY KEY  (`post_id`),
  KEY `post_id` (`post_id`),
  KEY `forum_id` (`forum_id`),
  KEY `topic_id` (`topic_id`),
  KEY `poster_id` (`poster_id`),
  KEY `poster_ip` (`poster_ip`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE `forum_topics` (
  `topic_id` int(10) NOT NULL auto_increment,
  `topic_title` varchar(100) default NULL,
  `topic_poster` int(10) default '0',
  `topic_poster_name` varchar(40) default 'Anonymous',
  `topic_time` datetime default NULL,
  `topic_views` int(10) default '0',
  `forum_id` int(10) default '1',
  `topic_status` tinyint(1) default '0',
  `topic_last_post_id` int(10) default '1',
  `posts_count` int(10) default '0',
  `sticky` int(1) default '0',
  `topic_last_post_time` datetime default NULL,
  PRIMARY KEY  (`topic_id`),
  KEY `topic_id` (`topic_id`),
  KEY `forum_id` (`forum_id`),
  KEY `topic_last_post_id` (`topic_last_post_id`),
  KEY `sticky` (`sticky`),
  KEY `posts_count` (`posts_count`),
  KEY `topic_last_post_time` (`topic_last_post_time`),
  KEY `topic_views` (`topic_views`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE `game_cats` (
  `id` int(11) NOT NULL auto_increment,
  `cat` varchar(15) default NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `game_games` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE `game_scores` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(255) NOT NULL default '',
  `thescore` decimal(20,0) default NULL,
  `ip` varchar(255) NOT NULL default '0',
  `phpdate` date  default NULL,
  `gamename` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE `groups` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE `groups_cats` (
  `id` int(5) NOT NULL auto_increment,
  `name` varchar(150) default NULL,
  `lang` varchar(20) default NULL,
  `photo` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE `groups_members` (
  `id` int(10) NOT NULL auto_increment,
  `group_id` int(10) default NULL,
  `uid` int(10) default NULL,
  `date_joined` date default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE `groups_topics` (
  `id` int(10) NOT NULL auto_increment,
  `uid` int(10) default NULL,
  `groups_id` int(10) default NULL,
  `title` varchar(255) default NULL,
  `comments` mediumtext,
  `date` date default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `im` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;


CREATE TABLE `im_words` (
  `id` int(5) NOT NULL auto_increment,
  `word` varchar(50) default NULL,
  `icon` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `members` (
  `id` mediumint(9) NOT NULL auto_increment,
  `username` varchar(100) default NULL,
  `password` varchar(100) default NULL,
  `email` varchar(255) default NULL,
  `session` varchar(35) default NULL,
  `ip` varchar(15) default NULL,
  `lastlogin` datetime default NULL,
  `visible` enum('yes','no') default 'yes',
  `active` enum('active','suspended','unapproved','cancel') default 'active',
  `created` datetime default NULL,
  `packageid` int(5) default '3',
  `hits` int(11) default '0',
  `profile_complete` int(1) default '0',
  `templateid` int(5) default '1',
  `updated` datetime default NULL,
  `moderator` enum('yes','no') default 'no',
  `activate_code` varchar(20) default 'OK',
  `highlight` enum('on','off') default 'off',
  `ip_long` varchar(25) default NULL,
  `ip_lat` varchar(25) default NULL,
  `ip_country` varchar(50) NOT NULL default '',
  `ip_code` varchar(5) NOT NULL default '',
  `member_rating` int(5) NOT NULL default '0',
  `msgStatus` varchar(255) NOT NULL default '',
  `video_duration` int(10) NOT NULL default '0',
  `video_live` enum('yes','no') NOT NULL default 'no',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `hits` (`hits`),
  KEY `visible` (`visible`),
  KEY `active` (`active`),
  KEY `packageid` (`packageid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `members_meetme` (
  `id` int(5) PRIMARY KEY  AUTO_INCREMENT NOT NULL,
  `uid` int(5) DEFAULT '0',
  `to_uid` int(5) DEFAULT '0',
  `date` date DEFAULT NULL,
  `approved` enum('yes','no') DEFAULT 'no'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE `members_admin` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE `members_admin_message` (
  `id` int(5) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `content` blob NOT NULL,
  `display` enum('yes','no') NOT NULL default 'yes',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE `members_banned` (
  `autoid` int(5) NOT NULL auto_increment,
  `ip` varchar(25) NOT NULL default '',
  `date` datetime default NULL,
  `string` varchar(255) NOT NULL default '',
  `username` varchar(25) NOT NULL default '',
  PRIMARY KEY  (`autoid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `members_billing` (
  `id` int(5) NOT NULL auto_increment,
  `uid` mediumint(9) default '0',
  `packageid` int(5) default '0',
  `date_upgrade` datetime default NULL,
  `date_expire` datetime default NULL,
  `pay_method` varchar(50) default '0',
  `running` enum('yes','no') default 'yes',
  `subscription` enum('yes','no') default 'no',
  `bill_email` varchar(255) default NULL,
  `transaction_id` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `members_msn` (
  `id` mediumint(9) NOT NULL auto_increment,
  `uid` mediumint(9) default '0',
  `email_name` varchar(200) default NULL,
  `email` varchar(255) default NULL,
  `date` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `members_network` (
  `id` int(5) NOT NULL auto_increment,
  `uid` int(5) default '0',
  `to_uid` int(5) default '0',
  `date` date default NULL,
  `comments` varchar(255) default NULL,
  `type` int(1) default '1',
  `approved` enum('yes','no') default 'no',
  PRIMARY KEY  (`id`),
  KEY `uid` (`uid`),
  KEY `to_uid` (`to_uid`),
  KEY `approved` (`approved`),
  KEY `type` (`type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE `members_online` (
  `timestamp` int(15) default '0',
  `ip` varchar(40) default NULL,
  `page` varchar(100) default NULL,
  `logid` int(5) default '0',
  KEY `ip` (`ip`),
  KEY `page` (`page`),
  KEY `logid` (`logid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `members_privacy` (
  `uid` mediumint(9) default '0',
  `Newsletters` enum('yes','no') default 'no',
  `Notifications` enum('yes','no') default 'no',
  `IM` enum('yes','no') default 'no',
  `Language` varchar(50) default NULL,
  `Time Zone` varchar(50) default NULL,
  `friends` enum('yes','no') default 'no',
  `comments` enum('yes','no') default 'no',
  `adult_content` enum('yes','no') default 'no',
  `profile_view` enum('all','friends') default 'all',
  `im_window` enum('on','off') default 'off',
  `SMS_email` enum('on','off') default 'off',
  `SMS_wink` enum('on','off') default 'off',
  `SMS_number` varchar(50) default NULL,
  `SMS_credits` int(5) default NULL,
  `SMS_country` varchar(50) default NULL,
  `match_array` mediumblob,
  `email_winks` enum('yes','no') default 'yes',
  `email_msg` enum('yes','no') default 'yes',
  `email_friends` enum('yes','no') default 'yes',
  `email_match` enum('yes','no') default 'yes',
  `skype` varchar(200) NOT NULL default '',
  UNIQUE KEY `uid` (`uid`),
  KEY `Notifications` (`Notifications`),
  KEY `SMS_credits` (`SMS_credits`),
  KEY `IM` (`IM`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `members_template` (
  `uid` int(11) NOT NULL default '0',
  `updated` date default NULL,
  `font1` varchar(50) NOT NULL default '',
  `font2` varchar(50) NOT NULL default '',
  `background` varchar(50) NOT NULL default '',
  `background_image` varchar(255) NOT NULL default '',
  `background_image_display` varchar(20) NOT NULL default '',
  `inner_background` varchar(10) NOT NULL default '',
  `header_text` varchar(10) NOT NULL default '',
  `header_background` varchar(10) NOT NULL default '',
  `header_image` varchar(150) NOT NULL default '',
  `header_image_display` varchar(20) NOT NULL default '',
  `subheader_title` varchar(10) NOT NULL default '',
  `subheader_background` varchar(10) NOT NULL default '',
  `color_text` varchar(10) NOT NULL default '',
  `color_link` varchar(10) NOT NULL default '',
  `css_file` blob NOT NULL,
  PRIMARY KEY  (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `members_triger` (
  `id` int(10) NOT NULL auto_increment,
  `uid` int(10) default NULL,
  `from_uid` int(10) default NULL,
  `event` varchar(20) default NULL,
  `opened` enum('yes','no') default 'no',
  PRIMARY KEY  (`id`),
  KEY `uid` (`uid`),
  KEY `from_uid` (`from_uid`),
  KEY `opened` (`opened`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `member_rating` (
  `id` int(10) NOT NULL auto_increment,
  `uid` int(10) NOT NULL default '0',
  `date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `vote_amount` int(5) NOT NULL default '0',
  `ip` varchar(50) NOT NULL default '',
  `profile_id` int(10) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;



CREATE TABLE `member_scores` (
  `autoid` int(5) NOT NULL auto_increment,
  `uid` int(10) default NULL,
  `date` date default NULL,
  `score` int(40) default NULL,
  `game` varchar(25) default NULL,
  PRIMARY KEY  (`autoid`),
  KEY `uid` (`uid`),
  KEY `score` (`score`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE `merchant` (
  `id` int(5) NOT NULL auto_increment,
  `name` varchar(200) default NULL,
  `comments` varchar(255) default NULL,
  `active` enum('yes','no') default 'no',
  `action` varchar(255) default NULL,
  `method` enum('POST','GET') default 'POST',
  `icon` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE `merchant_data` (
  `id` int(5) NOT NULL auto_increment,
  `mid` int(5) default '0',
  `name` varchar(100) default NULL,
  `value` varchar(255) default NULL,
  `type` varchar(50) default 'hidden',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE `messages` (
  `uid` mediumint(5) default '0',
  `mailnum` int(5) NOT NULL auto_increment,
  `mail2id` int(5) default '0',
  `mailstatus` enum('read','unread') default 'unread',
  `maildate` date default NULL,
  `mailtime` time default '00:00:00',
  `mail_subject` varchar(255) default NULL,
  `mail_message` text,
  `mail_displayalert` int(1) default '0',
  `my_box` enum('inbox','sent','trash','none') default 'inbox',
  `to_box` enum('inbox','sent','trash','none') default 'inbox',
  `type` enum('normal','sms','card','wink') default 'normal',
  PRIMARY KEY  (`mailnum`),
  KEY `uid` (`uid`),
  KEY `mail2id` (`mail2id`),
  KEY `mailstatus` (`mailstatus`),
  KEY `my_box` (`my_box`),
  KEY `to_box` (`to_box`),
  KEY `type` (`type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE `package` (
  `pid` int(5) NOT NULL auto_increment,
  `name` varchar(200) default NULL,
  `price` double default '0',
  `imageSpace` varchar(10) default '1000',
  `visible` int(5) default '1',
  `icon` varchar(255) default NULL,
  `comments` mediumtext,
  `type` enum('system','custom') default 'custom',
  `numdays` int(5) default '1',
  `maxFiles` int(11) default '5',
  `maxMessage` int(11) default '5',
  `subscription` enum('yes','no') default 'no',
  `currency_code` varchar(10) default NULL,
  `SMS_credits` varchar(10) default '0',
  `Highlighted` enum('yes','no') default 'no',
  `Featured` enum('yes','no') default 'no',
  `wink` int(5) default '5',
  `view_adult` enum('yes','no') NOT NULL default 'no',
  PRIMARY KEY  (`pid`),
  KEY `SMS_credits` (`SMS_credits`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE `package_items` (
  `pid` varchar(100) default NULL,
  `itemid` int(5) NOT NULL auto_increment,
  `value` varchar(5) default NULL,
  `name` varchar(255) default NULL,
  `description` varchar(255) default NULL,
  `type` enum('system','custom') default 'custom',
  PRIMARY KEY  (`itemid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `poll_check` (
  `pollid` int(11) default '0',
  `uid` mediumint(9) default '0',
  `time` varchar(14) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `poll_data` (
  `pollid` int(11) default '0',
  `polltext` varchar(50) default NULL,
  `votecount` int(11) default '0',
  `voteid` int(11) default '0',
  `status` varchar(6) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `poll_desc` (
  `pollid` int(11) NOT NULL auto_increment,
  `polltitle` varchar(100) default NULL,
  `timestamp` datetime default NULL,
  `votecount` mediumint(9) default '0',
  `STATUS` enum('active','disabled') default 'disabled',
  PRIMARY KEY  (`pollid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `postcodescoords` (
  `id` int(11) NOT NULL auto_increment,
  `postcode` varchar(4) default NULL,
  `town` varchar(255) default NULL,
  `county` varchar(100) default NULL,
  `easting` int(11) default '0',
  `northing` int(11) default '0',
  `latitude` double default '0',
  `longitude` double default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `postcode` (`postcode`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE `quiz` (
  `id` int(5) NOT NULL auto_increment,
  `uid` int(5) default '0',
  `title` varchar(255) default NULL,
  `description` varchar(255) default NULL,
  `date` date default NULL,
  `hits` int(11) default '0',
  `icon` varchar(255) default NULL,
  PRIMARY KEY  (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `quiz_questions` (
  `id` int(5) NOT NULL auto_increment,
  `uid` mediumint(9) default '0',
  `parent_id` int(5) default '0',
  `question_title` varchar(255) default NULL,
  `q1` varchar(255) default NULL,
  `q2` varchar(255) default NULL,
  `q3` varchar(255) default NULL,
  `q4` varchar(255) default NULL,
  `q5` varchar(255) default NULL,
  `answer` int(1) default '0',
  `orderid` int(5) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `quiz_results` (
  `id` int(5) NOT NULL auto_increment,
  `uid` int(5) default '0',
  `percentage` double default '0',
  `quiz_id` int(1) default '0',
  `comments` mediumint(9) default '0',
  `date` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `state` (
  `state_prefix` varchar(2) NOT NULL default '',
  `state_name` varchar(30) default NULL,
  PRIMARY KEY  (`state_prefix`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `system_log` (
  `id` int(5) NOT NULL auto_increment,
  `username` varchar(20) default NULL,
  `to_uid` int(10) NOT NULL default '0',
  `date` date default NULL,
  `time` time default '00:00:00',
  `value` varchar(255) default NULL,
  `value2` varchar(255) NOT NULL default '',
  `ip` varchar(50) default NULL,
  `type` varchar(50) NOT NULL default '',
  `page` varchar(10) NOT NULL default '',
  `sub` varchar(10) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `to_uid` (`to_uid`),
  KEY `page` (`page`),
  KEY `type` (`type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE `system_settings` (
  `id` int(10) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL default '',
  `value1` varchar(255) NOT NULL default '',
  `value2` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE `system_templates` (
  `id` int(5) NOT NULL auto_increment,
  `template_id` varchar(100) NOT NULL default '',
  `cat` int(5) NOT NULL default '0',
  `name` varchar(100) NOT NULL default '',
  `preview` varchar(50) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE `system_update` (
  `id` int(10) NOT NULL auto_increment,
  `date` datetime default NULL,
  `value1` varchar(150) NOT NULL default '',
  `value2` varchar(150) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE `tag_cloud` (
  `id` int(10) NOT NULL auto_increment,
  `page` varchar(15) NOT NULL default '',
  `keyword` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `template_meta` (
  `id` int(5) NOT NULL auto_increment,
  `page` varchar(100) default NULL,
  `title` varchar(255) default NULL,
  `description` varchar(255) default NULL,
  `keywords` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE `template_pages` (
  `id` int(5) NOT NULL auto_increment,
  `name` varchar(50) default NULL,
  `created` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `content` longblob,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `userplane_pending_wm` (
  `originatingUserID` int(11) default '0',
  `destinationUserID` int(11) default '0',
  `openedWindowAt` datetime default NULL,
  `insertedAt` datetime default NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `userplane_rooms` (
  `id` int(5) NOT NULL auto_increment,
  `Name` varchar(255) default NULL,
  `Description` varchar(255) default NULL,
  `Orderid` int(5) default NULL,
  `Access` enum('public','private') default 'public',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `videos_watched` (
  `id` int(5) NOT NULL auto_increment,
  `vid_id` varchar(30) NOT NULL default '',
  `views` int(5) NOT NULL default '0',
  `title` varchar(255) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

CREATE TABLE `visited` (
  `autoid` int(11) NOT NULL auto_increment,
  `uid` int(5) default '0',
  `view_uid` int(5) default '0',
  `date` datetime default NULL,
  PRIMARY KEY  (`autoid`),
  KEY `view_uid` (`view_uid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8; 

CREATE TABLE `visitors_table` (
  `ID` int(11) NOT NULL auto_increment,
  `visitor_ip` varchar(32) default NULL,
  `visitor_browser` varchar(255) default NULL,
  `visitor_hour` smallint(2) NOT NULL default '0',
  `visitor_minute` smallint(2) NOT NULL default '0',
  `visitor_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `visitor_day` smallint(2) NOT NULL default '0',
  `visitor_month` smallint(2) NOT NULL default '0',
  `visitor_year` smallint(4) NOT NULL default '0',
  `visitor_refferer` varchar(255) default NULL,
  `visitor_page` varchar(255) default NULL,
  PRIMARY KEY  (`ID`),
  KEY `visitor_refferer` (`visitor_refferer`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8; 

CREATE TABLE `zip_code` (
  `zip_code` int(10) unsigned NOT NULL default '0',
  `lattitude` float default '0',
  `longitude` float default '0',
  `city` varchar(25) default NULL,
  `state_prefix` varchar(2) default NULL,
  `zip_class` varchar(20) default NULL,
  PRIMARY KEY  (`zip_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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

CREATE TABLE IF NOT EXISTS `members_data` (
  `uid` mediumint(9) NOT NULL default '0',
  `em_eha20070509` varchar(100) default NULL,
  `em_86t20070511` int(3) default '0',
  `em_8cx20070511` int(3) default '0',
  `postcode` varchar(255) default NULL,
  `age` varchar(255) default '0',
  `headline` varchar(255) default '0',
  `country` varchar(255) default '0',
  `location` varchar(255) default '0',
  `description` text,
  `gender` int(3) default NULL,
  `em_hrh20080113` int(3) default NULL,
  `em_kxb20080113` int(3) default NULL,
  `em_1k820080113` int(3) default NULL,
  `em_heh20080113` int(3) default NULL,
  `em_93n20080113` int(3) default NULL,
  `em_jsh20080113` int(3) default NULL,
  `em_q0m20080113` int(3) default NULL,
  `em_jhb20080113` int(3) default NULL,
  `em_yh020080113` int(3) default NULL,
  `em_7jr20080113` int(3) default NULL,
  `em_wvh20080113` int(3) default NULL,
  `em_vqf20080113` int(3) default NULL,
  `em_qck20080113` int(3) default NULL,
  `em_r9720080113` int(3) default NULL,
  `em_s5j20080113` int(3) default NULL,
  `em_rn620080113` int(3) default NULL,
  `em_s1620080113` int(3) default NULL,
  `em_kjc20080113` int(3) default NULL,
  `em_72220080113` int(3) default NULL,
  `em_txg20080113` int(3) default NULL,
  `em_y8520080116` varchar(255) default NULL,
  `em_grm20080116` varchar(255) default NULL,
  `em_85820081128` int(3) default NULL,
  `em_chn20090224` varchar(255) default NULL,
  `em_rhr20090224` varchar(255) default NULL,
  `em_7vv20090224` varchar(255) default NULL,
  `em_qxs20090224` varchar(255) default NULL,
  `em_5tt20090224` text,
  `em_gfk20090224` text,
  PRIMARY KEY  (`uid`),
  KEY `postcode` (`postcode`),
  KEY `country` (`country`),
  KEY `location` (`location`),
  KEY `gender` (`gender`),
  KEY `age` (`age`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
ALTER TABLE `field` ADD `groupid_1` INT( 10 ) NOT NULL AFTER `linked_id` , ADD `groupid_2` INT( 10 ) NOT NULL AFTER `groupid_1` ;