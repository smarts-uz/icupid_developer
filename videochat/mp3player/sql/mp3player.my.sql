CREATE TABLE `chat7_mp3player_playlists` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `userID` varchar(255) NOT NULL default '',
  `playlist` text NOT NULL,
  PRIMARY KEY  (`id`)
);

CREATE TABLE `chat7_mp3player_songs` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `artist` varchar(255) NOT NULL default '',
  `userID` varchar(255) NOT NULL default '',
  `userName` varchar(255) NOT NULL default '',
  `path` varchar(255) NOT NULL default '',
  `date` datetime default NULL,
  PRIMARY KEY  (`id`)
);