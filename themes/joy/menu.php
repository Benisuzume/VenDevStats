<?php
if (!isset($website) ) {header('HTTP/1.1 404 Not Found'); die; }

if ( !isset($s) ) $s = $lang["search_players"];
?>
<body>

<div id='wrapper'>
<div id='main-container'>
<div id='top-nav'>
<div class='container'>
<div class='search-block'>
   <?=OS_SearchOption()?>
</div></div>
<div class='container'>
<div class='search-block'>
<form action="" id="search-form" method="get">
<input class='search-button' type='submit' value='<?=$s?>'/>
<input id='s' name='search' onblur='if (this.value == "") {this.value = "<?=$s?>"}' onfocus='if (this.value == "<?=$s?>") {this.value = ""}' type='text' value='<?=$s?>'/>
</form>
</div>
<div class='social-icons icon_flat'>
<a class='tooldown rss-tieicon' href='#' target='_blank' title='Rss'></a>
<a class='tooldown google-tieicon' href='#' target='_blank' title='Google+'></a>
<a class='tooldown facebook-tieicon' href='#' target='_blank' title='Facebook'></a>
<a class='tooldown twitter-tieicon' href='#' target='_blank' title='Twitter'></a>
<a class='tooldown pinterest-tieicon' href='#' target='_blank' title='Pinterest'></a>
<a class='tooldown dribbble-tieicon' href='#' target='_blank' title='Dribbble'></a>
<a class='tooldown youtube-tieicon' href='#' target='_blank' title='Youtube'></a>
<a class='tooldown instagram-tieicon' href='#' target='_blank' title='instagram'></a>
</div>
</div>
<div class='clear'></div>
</div>


<div id='header-wrapper'>
<div class='header-content'>
<div class='container'>
<div class='header section' id='header'><div class='widget Header' id='Header1'>
<div id='header-inner'>
<div class='titlewrapper'>
<h1 class='title'>
<?=$DefaultHomeTitle?>
</h1>
</div>
<div class='descriptionwrapper'>
<p class='description'><span><?=$DefaultHomeDescription?></span></p>
</div>
</div>
</div></div>
<div class='ads-top'>
<a href='#' target='_blank' title='Top Banner Here'>
<img width="480" src='<?=OS_HOME?><?=OS_CURRENT_THEME_PATH?>img/banner1.jpg'/>
</a>
</div>

<div class='clear'></div>
</div>
</div>
<nav id='main-nav'>
<div class='container'>
<div class='main-menu'>

<ul class='menu' id='menu-main'>
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

</div>
</div>
</div>

</nav>
<div class='container'>
