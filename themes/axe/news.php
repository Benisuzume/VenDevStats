<?php
if (!isset($website) ) { header('HTTP/1.1 404 Not Found'); die; }
?>
<?php if ( !OS_is_single() ) { ?><h2 class="header-title"><?=$lang["recent_news"]?></h2><?php } ?>
<?php 
foreach ( $NewsData as $News ) {
?>
<article id="post-<?=$News["id"]?>">
<?php if ( !OS_is_single() ) { ?>	
<a href="<?=OS_Post_Link($News["id"])?>" title="<?=$News["title"]?>">
<img width="300" height="300" src="<?=OS_GetFirstImage( $News["full_text"] )?>" class="alignleft wp-post-image" alt="<?=$News["title"]?>" /></a>
<?php } ?>

<div class="<?php if ( !OS_is_single() ) { ?>post-right<?php } ?> ">
<h1 class="post-title"><a href="<?=OS_Post_Link($News["id"])?>" rel="bookmark" title="<?=$News["title"]?>"><?=$News["title"]?></a></h1>

  <div class="post-content">
  <div class="post-meta the-icons">
     <span class="post-time"><i class="icon-time"></i><?=$News["date"]?></span>
	 <span class=""><i class="icon-comment-alt"></i><a href="<?=OS_Post_Link($News["id"])?>#comments" title="<?=$News["title"]?>"><?=$News["comments"]?> <?=$lang["total_comments"]?></a></span>
  </div>
  
  <?=$News["text"]?> <?=$News["read_more"]?>
  
  </div>

</div>

</article>
  
  <div class="separator"></div>
   <?php
   }
   ?>
   <div class="clear"></div>
   <?php
   if ( OS_is_single() ) {
   include("themes/".OS_THEMES_DIR."/comment_form.php");
   }
   ?>
<?php
   include('inc/pagination.php');
?>
  <div class="separator"></div>