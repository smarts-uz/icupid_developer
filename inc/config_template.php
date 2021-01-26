<?php
//////////////////////////////////////////////////////////////////////////////////////////
// 	GLOBAL TEMPLATE STYLES
///////////////////////////////////////////////////////////////////////////////////////////

## TEMPLATE IMAGE SECTIONS

define('TMP_BACKGROUND_IMG','');
define('TMP_BACKGROUND_PO','');

## TEMPLATE COLOUR SECTIONS

define('TMP_BACKGROUND','');
define('TMP_FOR_1','');
define('TMP_FOR_2','');
define('TMP_FOR_3','');

define('TMP_LINK','');
define('TMP_LINK_MENU',''); 

define('TMP_PAGE_HEAD',''); 
define('TMP_PAGE_FOOTER','1'); 


## WEBSITE LOGO SECTIONS

define('TMP_LOGO',''); 
define('TMP_LOGO_SLOGAN',''); 
define('TMP_LOGO_ICON','');

define('TMP_LOGO_COLOR','#07523B'); 
define('TMP_LOGO_SLOGAN_COLOR','#FFFFFF'); 
define('TMP_LOGO_HIDE','0'); 
define('TMP_LOGO_HEIGHT','82px'); 

## SLIDER STYLES
define('SLIDER1_IMAGE','uploads/files/626824.jpg'); 
define('SLIDER1_LINK','index.php'); 
define('SLIDER1_TITLE','Slider Title'); 
define('SLIDER1_DESC','Slider Description'); 

define('SLIDER2_IMAGE',''); 
define('SLIDER2_LINK','index.php?dll=register1'); 
define('SLIDER2_TITLE','Slider Title'); 
define('SLIDER2_DESC','Slider Description'); 

define('SLIDER3_IMAGE',''); 
define('SLIDER3_LINK','index.php?dll=register2'); 
define('SLIDER3_TITLE','Slider Title'); 
define('SLIDER3_DESC','Slider Description'); 

define('SLIDER4_IMAGE',''); 
define('SLIDER4_LINK','index.php?dll=register5'); 
define('SLIDER4_TITLE','Slider Title'); 
define('SLIDER4_DESC','Slider Description'); 

## TEXT AREA SECTIONS

define("TMP_TXT_1","Welcome to our website..."); 
define("TMP_TXT_2","Create your FREE account today and get started right away!");

define("TMP_TXT_3","iCupid Dating Software 12");
define("TMP_TXT_4","This is a sample description about your website which can be changed via the admin area! Create your own account today and checkout all the great software features in version 11!");

define("TMP_TXT_5","Welcome to our website, this is a long description about how your website.");
define("TMP_TXT_6","Welcome to our website, this is a long description about how your website works and some of the amazing features inside for members to enjoy!   You can edit this description very easily via the admin area allowing you to keep the content on the home page fresh!");


if (!defined('TMP_INDEX_STYLE')) {
    define('TMP_INDEX_STYLE',''); 
}
if (!defined('TMP_WIDTH_CONTAINER')) {
    define('TMP_WIDTH_CONTAINER','920px'); 
}
if (!defined('TMP_WIDTH_PAGE')) {
    define('TMP_WIDTH_PAGE','710px;'); 
}
if (!defined('TMP_WIDTH_MENU')) {
    define('TMP_WIDTH_MENU','200px'); 
}

## SEO META TAGS
define('SEO_PREFIX_TITLE','YourDating |  ');
define('SEO_PREFIX_DESC','YourDating - Dating');
define('SEO_PREFIX_KEYWORDS','online dating site');

define('HOME_TITLE','Home');
define('HOME_DESC','Online Dating');
define('HOME_KEYWORDS','dating site');
?>