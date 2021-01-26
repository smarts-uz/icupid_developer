<div id="recent-articles" class="col-md-12">

<h3 class="col-md-12 head-title template_color">Recent Articles</h3>

<ul>
	<? if(!empty($article_top10)){ foreach($article_top10 as $row){ ?>
	 <li><a href='<?=$row['link'] ?>'><?=$row['title'] ?></a></li>
	
	<? } } ?>

</ul>

</div>