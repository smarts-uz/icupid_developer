<?php
/**
* Page: ARTICLES PAGE
*
* @version  9.0
* @created  Sat 25 Oct  2008
* @related  /inc/func/func_articles.php
*/
defined( 'KEY_ID' ) or die( 'Restricted access' );
 
?>
<div id="main">         
    <div id="main_content_wrapper">     

    <?php
    if(!isset($HEADER_SINGLE_COLUMN)){ ?><div class='conten_outer' style="padding:10px 20px;"> <?php  } ?>   
        
     <div class="clear"></div>

    <?php  if(isset($ERROR_MESSAGE) && strlen($ERROR_MESSAGE) > 3){ ?>
    <div id="messages">
          <div style="" class="message-<?=$ERROR_TYPE ?>" id="main-message-<?=$ERROR_TYPE ?>">
          <a class="dismiss-message" href="#" onclick="Effect.Fade('main-message-<?=$ERROR_TYPE ?>', { duration : 0.5 });; return false;"><img src="images/DEFAULT/_icons/16/menu.gif"></a>
          <?=$ERROR_MESSAGE ?>
        </div>
        <script type="text/javascript" language="javascript">Effect.Pulsate('main-message-<?=$ERROR_TYPE ?>', { pulses : 2, duration : 1, from : 0.7 });</script>
    </div>
    <?php  } ?>
<div class="outer_content">
<?php  foreach($BANNER_ARRAY as $banner){ if($banner['position'] =="middle"){?>
<div class="middle_banner"><?php  print $banner['display'];?></div><?php  }} ?>

<div class="inner_common_cont col-md-12" id="eMeetingContentBox">

<?php  /*<p class="page_decr"> <?=$PageDesc ?></p> */ ?>


<div id="article_inner">
	<div class="articles_list">
 
	<?php
	if($show_page=="view"){

	/**
	* Page: Displays the article
	*
	* @version  9.0
	*/ 
	?>


		<div class="article_brief">
			<a href="<?=DB_DOMAIN?>articles/Test-Article" class="article_title"><?=$article_data['title'] ?></a>
			<div class="Details">
				<?=$article_data['date'] ?> | <?=$GLOBALS['_LANG']['_views'] ?>&nbsp; <?=$article_data['views'] ?> | &nbsp; <?=$article_data['name'] ?>
			</div>

			<div class="article_image">
				<?php
				if(file_exists($_SERVER['DOCUMENT_ROOT']."/uploads/articles/".$article_data['image']) && $article_data['image'] != ""){
				?>
				<img src="<?=DB_DOMAIN?>uploads/articles/<?=$article_data['image']?>">
				<?php
				}
				?>
				
			</div>
			<div class="article_desc">
				<?=$article_data['content'] ?>
			</div>

			<div class="prev-article">
				<?php
				if(isset($prev_article['title']) && $prev_article['title'] != ""){
				?>
				<a href="<?=$prev_article['link']?>"><img src="/images/prev-article.png"><span><?=$prev_article['title']?></span></a>
				<?php
				}
				?>
			</div>

			<div class="next-article">
				<?php
				if(isset($next_article['title']) && $next_article['title'] != ""){
				?>
				<a href="<?=$next_article['link']?>"><span><?=$next_article['title']?></span><img src="/images/next-article.png"></a>
				<?php
				}
				?>
			</div>
		</div>


<?php   
/*
	PARAMERTS: 
	1: width of display box
	2: page
	3: sub page
	4: user created id
	5: item id
	6: extra id 1
	7: extra id 2
*/
if($_SESSION['auth'] =="yes"){
displayCommentsBox("310", $page, $show_page, $_SESSION['uid'], $article_data['id'],0,0);
}

?>





<?php  }else{
	
	if(!empty($article_array)) {
		foreach($article_array as $article){ ?>
			<div class="article_brief">
				<a href='<?=$article['link'] ?>' class="article_title"><?=$article['title'] ?></a>
				<div class="Details">
					<?=$GLOBALS['_LANG']['_date']  ?>&nbsp;<?=$article['date'] ?> | 
					<?php  if($article['dontshow']){ ?><?=$GLOBALS['_LANG']['_views'] ?>&nbsp; <?=$article['views'] ?> | <?php  } ?>
					<a href='<?=$article['cat_link'] ?>' style="text-decoration: underline"><?=$article['cat'] ?></a> |			
				</div>

				<div class="article_image">
					<?php
					if(file_exists($_SERVER['DOCUMENT_ROOT']."/uploads/articles/".$article['image']) && $article['image'] != ""){
					?>
					<img src="<?=DB_DOMAIN?>uploads/articles/<?=$article['image']?>">
					<?php
					}
					?>
					
				</div>
				<div class="article_desc">
				<?=substr(preg_replace('/<[^>]*>/', '', $article['content']),0,400)?>....<a href='<?=$article['link'] ?>' class="article_read_more">Read More</a>
				</div>
			</div>
		<?
		}
		$totalArticlePages =  ceil($total_articles/D_ARTICLE_LIMIT);
		?>
		<div class="article_pagination">
			<ul>
			<?php
			$pagination = $pagination + 1;
			$category_link = "p";
			if(isset($item2_id) && $item2_id != "" && isset($item_id) && $item_id != "" ){
				$category_link = "$item2_id/$item_id";
			}
			
			for($i = 1; $i <= $totalArticlePages; $i++) {
				$active_page="";	
				if($pagination == $i){
					$active_page="active_page";
				}
			?>
				<li class="<?=$active_page?>"><a href="<?=DB_DOMAIN?>articles/<?=$category_link?>/<?=$i?>"><?=$i?></a></li>
			<?php
			}
			?>
			</ul>
		</div>
		<?php
	} ?>
		

<?php  } ?>
</div>
	

</div></div></div><div class="ClearAll"></div>


<?php
/* MAIN CLOSE */
if(!isset($HEADER_SINGLE_COLUMN)){ ?></div><div class="clear"></div> <?php  }else{ print "</div>"; }
?>

</div> <div id="main_wrapper_bottom"></div>
</div>