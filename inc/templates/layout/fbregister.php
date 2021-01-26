<?
## block direct page access
defined( 'KEY_ID' ) or die( 'Restricted access' );

?>
<? foreach($BANNER_ARRAY as $banner){ if($banner['position'] =="middle"){?>
<div class="middle_banner"><? print $banner['display'];?></div><? }} ?>

<p <? if ($PageDesc !='') {?> class="page_decr" <? }?> ><?=$PageDesc ?></p>



<iframe src="https://www.facebook.com/plugins/registration.php?
client_id=<?=FACEBOOK_APP_ID ?>&amp;
redirect_uri=<?=DB_DOMAIN ?>index.php&amp;
fields=[
{'name':'name'},
{'name':'first_name'},
{'name':'last_name'},
{'name':'email'},
{'name':'location'},
{'name':'gender'},
{'name':'birthday'},
{'name':'username',%20%20%20%20%20%20'description':'Username',%20%20%20%20%20%20%20%20%20%20%20%20%20'type':'text'},
]" style="border: none" allowtransparency="true" frameborder="no" height="680" scrolling="auto" width="100%"></iframe>

 