<?php

include"inc/config.php";


$DB->Update("CREATE TABLE IF NOT EXISTS `members_meetme` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `uid` int(11) DEFAULT '0',
  `to_uid` int(11) DEFAULT '0',
  `date` date DEFAULT NULL,
  `approved` enum('yes','no') DEFAULT 'no'
) ENGINE=MyISAM");



$DB->Update("CREATE TABLE IF NOT EXISTS `members_reported` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `uid` int(11) DEFAULT '0',
  `to_uid` int(11) DEFAULT '0',
  `date` date DEFAULT NULL,
  `visible` enum('yes','no') DEFAULT 'no',
  UNIQUE KEY `UNIQUE` (`uid`,`to_uid`)
) ENGINE=MyISAM");



$DB->Update("CREATE TABLE IF NOT EXISTS `mobile_admin` (
  `id` tinyint(4) NOT NULL,
  `mobile_image` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `page_contents` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM");


$count = $DB->ROW("SELECT count(*) as cnt from mobile_admin");

if($count['cnt'] == '0'){

  $DB->Update("INSERT INTO `mobile_admin` (`id`, `mobile_image`, `page_contents`) VALUES (1, '/images/DEFAULT/LOGOS/none_logo_here.png', 'About Us page content will come here.')");

}

?>