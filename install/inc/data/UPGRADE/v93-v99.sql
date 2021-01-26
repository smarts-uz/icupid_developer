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
ALTER TABLE `field` ADD `groupid_1` INT( 10 ) NOT NULL AFTER `linked_id` , ADD `groupid_2` INT( 10 ) NOT NULL AFTER `groupid_1` ;