<?php

defined( 'KEY_ID' ) or die( 'Restricted access' );


function DisplayArticleCats(){

	global $DB;
	
	$Counter =1;
	$DataArray = array();
	
	$result = $DB->query("SELECT * FROM articles_cat ");

	while( $com = $DB->NextRow($result) ){
	
			$DataArray[$Counter]['name'] 	= $com['name'];
			$DataArray[$Counter]['count'] 	= $com['count'];
			$DataArray[$Counter]['id'] 	= $com['id'];

				# make cat link
				$MODdata1['page'] ='articles';  
				$MODdata1['type'] ='system';
				$MODdata1['id1'] = 0;
				$MODdata1['id2'] = $com['id'];
				$MODdata1['name'] = $com['name'];					 
				$DataArray[$Counter]['link'] = MakeLinkMOD($MODdata1);

			$Counter++;
			
	}
		
	return $DataArray;
}


function DisplayArticles($catid=0 , $offset=0){

	global $DB;
	
	$Counter =1;	$DataArray = array(); $MODdata['page'] ='articles';  $MODdata['type'] ='system';
	
	$offset = $offset * D_ARTICLE_LIMIT;
	
	$extraCondition = "";
	$extraCatCondition = "";
	if(is_numeric($catid) && $catid !=0){
	
		$extraCatCondition = " WHERE ac.id = '".$catid."' ";
	
	}

	$extraCondition = " ORDER BY a.id DESC LIMIT $offset, ". D_ARTICLE_LIMIT; // LIMIT 10 
	

	$result = $DB->query("SELECT a.id AS artid, a.cat_id, a.date, a.title, a.content, a.meta_title, a.meta_description, a.meta_keywords, a.image, a.views, a.short, a.link, ac.id AS cat_link_id, ac.count, GROUP_CONCAT(ac.name) AS categories FROM articles AS a LEFT JOIN article_categories_assigned AS aca ON a.id = aca.article_id LEFT JOIN articles_cat AS ac ON aca.category_id = ac.id $extraCatCondition GROUP BY a.id $extraCondition");
	while( $com = $DB->NextRow($result) ){
	
		$DataArray[$Counter]['date'] 		= dates_interconv($com['date']);
		$DataArray[$Counter]['title'] 		= $com['title'];
		$DataArray[$Counter]['content'] 	= $com['content'];
		$DataArray[$Counter]['views'] 		= $com['views'];
		$DataArray[$Counter]['short'] 		= $com['short'];
		$DataArray[$Counter]['image'] 		= $com['image'];
		$DataArray[$Counter]['cat'] 		= $com['categories'];
		//if($com['link'] ==""){

		# make link
		//$MODdata['sub'] ='view';
		//$MODdata['id1'] = $com['artid'];
		//$com['title'] = str_replace("?","",$com['title']);
		//$com['title'] = str_replace(":","",$com['title']);
		$com['title'] = str_replace("'","",$com['title']);
		$MODdata['name'] = $com['title'];
		$DataArray[$Counter]['link'] = MakeLinkMOD($MODdata);

		$DataArray[$Counter]['dontshow'] = true;
		/*}else{
		$DataArray[$Counter]['link'] = $com['link'];
		$DataArray[$Counter]['dontshow'] = false;
		}*/

		# make cat link
		$MODdata1['page'] ='articles';  
		$MODdata1['type'] ='system';
		$MODdata1['id2'] = $com['cat_link_id'];
		$MODdata1['name'] = $com['categories'];
		$DataArray[$Counter]['cat_link'] = MakeLinkMOD($MODdata1);
 
		$Counter++;
			
	}
		
	return $DataArray;
}

function GetTotalArticles($catid=0){

	global $DB;
	
	$Counter =1; $MODdata['page'] ='articles';  $MODdata['type'] ='system';
	
	
	$extraCondition = "";
	$extraCatCondition = "";
	if(is_numeric($catid) && $catid !=0){
		$extraCatCondition = " WHERE ac.id = '".$catid."' ";
	}
	
	$result = $DB->Row("SELECT COUNT(*) AS total FROM articles AS a LEFT JOIN article_categories_assigned AS aca ON a.id = aca.article_id LEFT JOIN articles_cat AS ac ON aca.category_id = ac.id $extraCatCondition");
		
	return $result['total'];
	
}

function GetArticleData($id){

	global $DB;
	
	$title = str_replace("-", " ", $id);
	//$DB->Update("UPDATE articles SET views=views+1 WHERE articles.title='".$id."' limit 1");
	$DB->Update("UPDATE articles SET views=views+1 WHERE articles.title='".$title."' limit 1");
	
	

    $result = $DB->Row("SELECT a.id AS artid, a.cat_id, a.date, a.title, a.content, a.meta_title, a.meta_description, a.meta_keywords, a.image, a.views, a.short, a.link, ac.id AS cat_link_id, ac.count, GROUP_CONCAT(ac.name) AS categories FROM articles AS a LEFT JOIN article_categories_assigned AS aca ON a.id = aca.article_id LEFT JOIN articles_cat AS ac ON aca.category_id = ac.id WHERE a.title='".$title."'");
	
	$result['title'] 	= eMeetingOutput($result['title']);
	$result['content'] 	= eMeetingOutput($result['content'],true);
	//$result['date'] 	= dates_interconv($result['date']);
	$result['date'] 	= date("F d,Y",strtotime($result['date']));
	$result['id'] 		= $result['artid'];
	$result['name'] 	= $result['categories'];

	$result['content'] = preg_replace( '(' .chr(ord("�")). ')', "\"", $result['content'] );        # �
	$result['content'] = preg_replace( '(' .chr(ord("�")). ')', "\"", $result['content'] );        # �
	$result['content'] = preg_replace( '(' .chr(ord("`")). ')', "'", $result['content'] );        # `
	$result['content'] = preg_replace( '(' .chr(ord("�")). ')', "'", $result['content'] );        # �
	$result['content'] = preg_replace( '(' .chr(ord("�")). ')', ",", $result['content'] );        # �
	$result['content'] = preg_replace( '(' .chr(ord("`")). ')', "'", $result['content'] );        # `
	$result['content'] = preg_replace( '(' .chr(ord("�")). ')', "'", $result['content'] );        # �
	$result['content'] = preg_replace( '(' .chr(ord("�")). ')', "'", $result['content'] );        # �
	$result['content'] = preg_replace( '(' .chr(ord("�")). ')', "'", $result['content'] );        # �
	$result['content'] = preg_replace( '(' .chr(149). ')', "&#8226;", $result['content'] );    # bullet �
	$result['content'] = preg_replace( '(' .chr(150). ')', "&ndash;", $result['content'] );    # en dash
	$result['content'] = preg_replace( '(' .chr(151). ')', "&mdash;", $result['content'] );    # em dash
	$result['content'] = preg_replace( '(' .chr(153). ')', "&#8482;", $result['content'] );    # trademark
	$result['content'] = preg_replace( '(' .chr(169). ')', "&copy;", $result['content'] );    # copyright mark
	$result['content'] = preg_replace( '(' .chr(174). ')', "&reg;", $result['content'] );        # registration mark


	return $result;
}

function GetPrevArticleData($id){

	global $DB;

	$title = str_replace("-", " ", $id);
           
	$currentArticle = $DB->Row("SELECT * FROM articles AS a WHERE a.title = '".$title."' ORDER BY id DESC LIMIT 1");

	$result = $DB->Row("SELECT * FROM articles AS a WHERE a.id < ".$currentArticle['id']." ORDER BY id DESC LIMIT 1");

	# make link
	$MODdata['page'] = 'articles';
	//$MODdata['sub'] = 'view';
	//$MODdata['id1'] = $result['id'];
	$com['title'] = str_replace("?","",$result['title']);
	$com['title'] = str_replace(":","",$result['title']);
	$com['title'] = str_replace("'","",$result['title']);
	$MODdata['name'] = $com['title'];

	return array('title' => $result['title'],'link' => MakeLinkMOD($MODdata));

}

function GetNextArticleData($id){

	global $DB;


	$title = str_replace("-", " ", $id);

	$currentArticle = $DB->Row("SELECT * FROM articles AS a WHERE a.title = '".$title."' ORDER BY id DESC LIMIT 1");

	$result = $DB->Row("SELECT * FROM articles AS a WHERE a.id > '".$currentArticle['id']."' LIMIT 1");

	# make link
	$MODdata['page'] = 'articles';
	//$MODdata['sub'] = 'view';
	//$MODdata['id1'] = $result['id'];
	$com['title'] = str_replace("?","",$result['title']);
	$com['title'] = str_replace(":","",$result['title']);
	$com['title'] = str_replace("'","",$result['title']);
	$MODdata['name'] = $com['title'];

	return array('title' => $result['title'],'link' => MakeLinkMOD($MODdata));
}
?>