<?php 
function GetPages(){

	global $DB;
	$RunningCount =1;
	$PageArray = array();
	
    $result = $DB->Query("SELECT `name` FROM template_pages");
    while( $page = $DB->NextRow($result) )
    {
		array_push($PageArray, $page['name']);	
	}
	return $PageArray;
}
function GetPageContent($page){

	global $DB;
	
    $result = $DB->Row("SELECT * FROM template_pages WHERE name='".str_replace("-", " ", $page)."' LIMIT 1");

	$content = '<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="CapBody bd_padding_20">
				<div class="Details">';
	$content .= $result['content'];
	$content .= '</div>
				</div>
				</div>
				</div>';

	$result['content'] = $content;
	return $result;
}
?>