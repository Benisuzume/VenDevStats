<?php
if (!isset($website) ) {header('HTTP/1.1 404 Not Found'); die; }

if ( !isset($s) ) $s = $lang["search_players"];
?>

<nav class="iegradient" id="main-navigation" role="navigation">
<div class="innerwrap">
<ul class="sf-menu">
<? if( $Forum == 1 ) { ?>
  <li><a href="javascript:;"><?=$lang["home"]?></a>
         <ul>
          <li><a href="<?=OS_HOME?>">Home</a></li>
          <li><a href="<?=$ForumLink?>">Forum</a></li>
         </ul>
  </li>
<? } else { ?>
  <li><a href="<?=OS_HOME?>"><?=$lang["home"]?></a></li>
<?php } ?>
  <?php if ($TopPage == 1) { ?>
  <li><a href="<?=OS_HOME?>?top"><?=$lang["top"]?></a></li>
  <?php } ?>
<?php if ($Fame_Shame_Pages == 1) { ?>
   <li><a href="javascript:;">Halls</a>
         <ul>
          <li><a href="<?=OS_HOME?>?fame">HoF</a></li>
          <li><a href="<?=OS_HOME?>?shame">HoS</a></li>
         </ul>
        </li>
  <?php } ?>
  <li><a href="<?=OS_HOME?>?games"><?=$lang["game_archive"]?></a></li>
<?php if ($HeroesPage == 1 AND $ItemsPage == 1 ) { ?>
  <li><a href="javascript:;"><?=$lang["media"]?></a>
	 <ul>
	   <?=os_add_menu_misc()?>
	   <?php if ($GuidesPage == 1) { ?>
       <li><a href="<?=OS_HOME?>?guides"><?=$lang["guides"]?></a></li>
	   <?php } ?>
	   <?php if ($HeroesPage == 1) { ?>
       <li><a href="<?=OS_HOME?>?heroes"><?=$lang["heroes"]?></a></li>
	   <?php } ?>
	   <?php if ($HeroVote == 1) { ?>
       <li><a href="<?=OS_HOME?>?vote"><?=$lang["heroes_vote"]?></a></li>
	   <?php } ?>
	   <?php if ($ItemsPage == 1) { ?>
	   <li><a href="<?=OS_HOME?>?items"><?=$lang["items"]?></a></li>
	   <?php } ?>
	 </ul>
  </li>
  <?php } ?>
  
<?php if ($BansPage==1) { ?>
  <li>
  <a href="<?=OS_HOME?>?bans"><?=$lang["bans"]?></a>
    <ul>
	   <li><a href="<?=OS_HOME?>?bans"><?=$lang["all_bans"]?></a></li>
<?php if ($BanReports==1) { ?>
	   <li><a href="<?=OS_HOME?>?ban_report"><?=$lang["ban_report"]?></a></li>
 <?php } ?>	  
<?php if ($BanAppeals==1) { ?>
	   <li><a href="<?=OS_HOME?>?ban_appeal"><?=$lang["ban_appeal"]?></a></li>
 <?php } ?>	  
	<?php if ($WarnPage == 1) { ?>
       <li><a href="<?=OS_HOME?>?warn"><?=$lang["warn"]?></a></li>
    <?php } ?>	
	</ul>
  </li>
	<?php if ($SafelistPage == 1) { ?>
    <li><a href="<?=OS_HOME?>?safelist"><?=$lang["safelist"]?></a></li>
	<?php } ?>
 <?php } ?>
   <?php if ($AdminsPage == 1) { ?>
   <li><a href="<?=OS_HOME?>?admins"><?=$lang["admins"]?></a></li>
   <?php } ?>
   
  <?php if ($AboutUs == 1) { ?>
    <li><a href="<?=OS_HOME?>?about_us"><?=$lang["about_us"]?></a></li>
    <?php } ?>	
	
  <?php if ($MemberListPage == 1) { ?>
    <li><a href="<?=OS_HOME?>?members"><?=$lang["members"]?></a></li>
    <?php } ?>	
   
   <?php if (!is_logged() AND $UserRegistration == 1) { ?>
    <li><a href="<?=OS_HOME?>?login"><?=$lang["login_register"]?></a></li>
   <?php } ?>
   
   <?php if (is_logged() ) { ?>
   <li>
    <a href="<?=OS_HOME?>?profile"><b><?=substr($_SESSION["username"],0,30)?></b></a>
      <ul>
	    <?php if (is_logged() AND isset($_SESSION["level"] ) AND $_SESSION["level"]>=9 ) { ?>
	    <li><a href="<?=OS_HOME?>adm/"><b><?=$lang["admin_panel"]?></b></a></li>
	    <?php } ?>
		 <li><a href="<?=OS_HOME?>?profile"><?=$lang["profile"]?></a></li>
<?php if (isset($_SESSION["phpbb"]) ) { ?>
       <li><a href="<?=OS_HOME?>?logout&amp;sid=<?=$_SESSION["sid"]?>"><?=$lang["logout"]?></a></li>
<?php } else { ?>
		 <li><a href="<?=OS_HOME?>?logout"><?=$lang["logout"]?></a></li>
<?php } ?>
	  </ul>
   </li>
   <?php } ?>
</ul>
<aside class="widget">
   <?=OS_SearchOption()?>
</aside>
<aside class="widget">
  <form role="search" method="get" id="searchform" action="" >
    <div><label class="screen-reader-text" for="s">Search for:</label>
    <input type="text" onblur='if (this.value == "") {this.value = "<?=$s?>";}' onfocus='if (this.value == "<?=$s?>") {this.value = ""}' type="text" value='<?=$s?>' name="search" id="s" />
    </div>
    </form>
</aside>
</div>
</nav>

<div class="innerwrap">
<div id="breadcrumbs"><span><?=$HomeDesc?></span></div>
</div>

<?php os_top_menu() ?>

<div id="bodywrap" class="innerwrap">
<section id="container" role="article aside wrapper">
<div class="content">
<div class="content-inner">
<div id="post-entry">
<section class="post-entry-inner">
