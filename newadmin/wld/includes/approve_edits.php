<?php
$sp = (isset($_REQUEST['sp'])) ? $_REQUEST['sp'] : 'pages';
?>

<div class="submenu">
    <h3 class="nav-tab-wrapper">
        <a href="?p=approve_edits&sp=pages" class="nav-tab <?php echo ($sp == 'pages') ? 'active' : ''; ?>">Pages</a>
        <a href="?p=approve_edits&sp=text" class="nav-tab <?php echo ($sp == 'text') ? 'active' : '';?>">Text</a>
        <a href="?p=approve_edits&sp=metatags" class="nav-tab <?php echo ($sp == 'metatags') ? 'active' : '';?>">Metatags</a>
        <a href="?p=approve_edits&sp=banners" class="nav-tab <?php echo ($sp == 'banners') ? 'active' : '';?>">Banners</a>
       
    </h3>
</div>

<?php

if(isset($_REQUEST['p']) && $_REQUEST['p'] == 'approve_edits'){

	$sp = (isset($_REQUEST['sp'])) ? $_REQUEST['sp'] : 'pages';

	include 'approve_edits/'.$sp.'.php';

}


?>