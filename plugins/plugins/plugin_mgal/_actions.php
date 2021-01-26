<?
header('Content-Type: text/html; charset=utf-8');
$action = trim(strip_tags($_GET['action']));
############################################################
#################### OPERATIONS ############################
switch ( $action ){

				//////////////////// ADMIN AREA AJAX CALLS ///////////////////////
				case "photo": {
					
					$fid = trim(strip_tags($_GET['fid']));
					//$ff = dirname(__FILE__);
					//$dir = str_replace("plugins/plugins/plugin_mgal","",$ff);
					//$dir = str_replace("plugins\plugins\plugin_mgal","",$dir);
					$dir = $_SERVER['DOCUMENT_ROOT'];
					if(file_exists($dir."/uploads/images/".$fid)){
						$FilS = getimagesize($dir."/uploads/images/".$fid);						
					}

					$ThisImg = "inc/tb.php?src=".$fid."&t=i&x=".$FilS[0]."&y=".$FilS[1].""; 

					print "<img src='".$ThisImg."'>";
					
					
				} break;
}
?>