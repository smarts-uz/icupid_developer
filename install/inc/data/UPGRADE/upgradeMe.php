<?

include("inc/config.php");

$DB->Row("CREATE TABLE IF NOT EXISTS `member_searches` (
  `search_id` int(10) NOT NULL auto_increment,
  `uid` int(10) NOT NULL,
  `search_date` datetime,
  `search_string` blob NOT NULL,
  `search_name` varchar(100) NOT NULL,
  PRIMARY KEY  (`search_id`)
)");

$DB->Row("CREATE TABLE IF NOT EXISTS `email_scheduler` (
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
)");

$DB->Row("CREATE TABLE IF NOT EXISTS `members_follow` (
`autoid` INT( 10 ) NOT NULL AUTO_INCREMENT ,
`follow_friends` ENUM( 'yes', 'no' ) NOT NULL DEFAULT 'no',
`follow_autoadd` ENUM( 'yes', 'no' ) NOT NULL DEFAULT 'no',
`allow_approve` ENUM( 'yes', 'no' ) NOT NULL DEFAULT 'no',
`follow_display` ENUM( 'yes', 'no' ) NOT NULL DEFAULT 'no',
`uid` INT NOT NULL ,
PRIMARY KEY ( `autoid` ) ,
INDEX ( `uid` ))");

$DB->Row("ALTER TABLE `members_privacy` ADD `profileview_friends` VARCHAR( 50 ) NOT NULL AFTER `skype` , ADD `profileview_nonfriend` VARCHAR( 50 ) NOT NULL AFTER `profileview_friends`");

$DB->Row("ALTER TABLE `field` ADD `groupid_1` INT( 10 ) NOT NULL AFTER `linked_id` , ADD `groupid_2` INT( 10 ) NOT NULL AFTER `groupid_1`");
?>