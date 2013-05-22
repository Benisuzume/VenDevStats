<?php
if (!isset($website) ) {header('HTTP/1.1 404 Not Found'); die; }
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--[if lt IE 7 ]>	<html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>		<html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>		<html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>		<html lang="en" class="no-js ie9"> <![endif]-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="content-style-type" content="text/css" />
	<meta name="author" content="Ivan Antonijevic" />
	<meta name="rating" content="Safe For Kids" />
 	<meta name="description" content="<?=$HomeDesc?>" />
	<meta name="keywords" content="<?=$HomeKeywords?>" />
	<meta name='robots' content='noindex,nofollow' />
	<?=os_add_meta()?>
	
	<title><?=$HomeTitle?></title>

<link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css' />	
<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!--[if gte IE 9]>
<style type="text/css">
a.button,input[type='button'], input[type='submit'],h1.post-title,.wp-pagenavi a,#sidebar .item-options,.iegradient {filter: none;}
</style>
<![endif]-->

<style type='text/css' media='all'>
@font-face {
  font-family: 'FontAwesome';
  src: url('<?=OS_THEME_PATH?>fonts/fontawesome-webfont.eot');
  src: url('<?=OS_THEME_PATH?>fonts/fontawesome-webfont.eot?#iefix') format('eot'), url('<?=OS_THEME_PATH?>fonts/fontawesome-webfont.woff') format('woff'), url('<?=OS_THEME_PATH?>fonts/fontawesome-webfont.ttf') format('truetype'), url('<?=OS_THEME_PATH?>fonts/fontawesome-webfont.otf') format('opentype'), url('<?=OS_THEME_PATH?>fonts/fontawesome-webfont.svg#FontAwesome') format('svg');
  font-weight: normal;
  font-style: normal;
}
</style>

<link rel="index" title="<?=OS_HOME_TITLE?>" href="<?=OS_HOME?>" />
<link rel="stylesheet" href="<?=OS_HOME?><?=OS_CURRENT_THEME_PATH?>style.css" type="text/css" />
<script type="text/javascript" src="<?=OS_HOME?>scripts.js"></script>

<link rel='stylesheet' id='superfish-css'  href='<?=OS_THEME_PATH?>css/superfish.css?ver=1.0' type='text/css' media='all' />
<link rel='stylesheet' id='fancybox-css-css'  href='<?=OS_THEME_PATH?>css/jquery.fancybox-1.3.4.css?ver=1.0' type='text/css' media='all' />

<link rel='stylesheet' id='font-awesome-css'  href='<?=OS_THEME_PATH?>css/font-awesome.css?ver=1.0' type='text/css' media='all' />
<link rel='stylesheet' id='supersized-css-css'  href='<?=OS_THEME_PATH?>css/supersized.css?ver=1.0' type='text/css' media='all' />
<script type='text/javascript' src='<?=OS_THEME_PATH?>js/jquery.js?ver=1.8.3'></script>
<script type='text/javascript' src='<?=OS_THEME_PATH?>js/modernizr.js?ver=1.0'></script>
<script type='text/javascript' src='<?=OS_THEME_PATH?>js/superfish.js?ver=1.0'></script>
<script type='text/javascript' src='<?=OS_THEME_PATH?>js/supersubs.js?ver=1.0'></script>


<script type='text/javascript' src='<?=OS_THEME_PATH?>js/jquery.fancybox-1.3.4.pack.js?ver=1.0'></script>
<script type='text/javascript' src='<?=OS_THEME_PATH?>js/jquery.nivo.slider.js?ver=1.0'></script>


<script type="text/javascript">
		jQuery(window).load(function() {
			// nivoslider init
			jQuery('#slider').nivoSlider({
				effect: 'random',
				slices:10,
				boxCols:10,
				boxRows:5,
				animSpeed:500,
				pauseTime:5000,
				directionNav:false,
				directionNavHide:false,
				controlNav:true,
				captionOpacity:1			});
		});
	</script>


<script type="text/javascript">
jQuery.noConflict();
var $fc = jQuery;
$fc(document).ready(function() {
$fc("a[rel=gallery_group]").fancybox({
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'titlePosition' 	: 'over',
				'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
					return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
				}
			});
});
</script>

<script type="text/javascript">
jQuery.noConflict();
var $sf = jQuery;
    $sf(document).ready(function(){
        $sf("ul.sf-menu").supersubs({
            minWidth:    12,   // minimum width of sub-menus in em units
            maxWidth:    15,   // maximum width of sub-menus in em units
            extraWidth:  1     // extra width can ensure lines don't sometimes turn over
                               // due to slight rounding differences and font-family
        }).superfish();  // call supersubs first, then superfish, so that subs are
                         // not display:none when measuring. Call before initialising
                         // containing tabs for same reason.
    });
</script>

<script type="text/javascript" src="<?=OS_THEME_PATH?>js/supersized.3.1.3.min.js"></script>

        <script type="text/javascript">

			jQuery(function($){
				$.supersized({

					//Functionality
					slideshow               :   1,		//Slideshow on/off
					autoplay				:	1,		//Slideshow starts playing automatically
					start_slide             :   1,		//Start slide (0 is random)
					random					: 	0,		//Randomize slide order (Ignores start slide)
					slide_interval          :   8000,	//Length between transitions
					transition              :   1, 		//0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
					transition_speed		:	2000,	//Speed of transition
					new_window				:	1,		//Image links open in new window/tab
					pause_hover             :   0,		//Pause slideshow on hover
					keyboard_nav            :   1,		//Keyboard navigation on/off
					performance				:	2,		//0-Normal, 1-Hybrid speed/quality, 2-Optimizes image quality, 3-Optimizes transition speed // (Only works for Firefox/IE, not Webkit)
					image_protect			:	1,		//Disables image dragging and right click with Javascript
					image_path				:	'<?=OS_THEME_PATH?>images/backgrounds/', //Default image path

					//Size & Position
					min_width		        :   0,		//Min width allowed (in pixels)
					min_height		        :   0,		//Min height allowed (in pixels)
					vertical_center         :   1,		//Vertically center background
					horizontal_center       :   1,		//Horizontally center background
					fit_portrait         	:   1,		//Portrait images will not exceed browser height
					fit_landscape			:   0,		//Landscape images will not exceed browser width

					//Components
					navigation              :   0,		//Slideshow controls on/off
					thumbnail_navigation    :   0,		//Thumbnail navigation
					slide_counter           :   0,		//Display slide numbers
					slide_captions          :   0,		//Slide caption (Pull from "title" in slides array)
					slides 					:  	[		//Slideshow Images
					
				   {image : '<?=OS_THEME_PATH?>images/backgrounds/dota_background-01.jpg', title :  '',url : ''},
                   {image : '<?=OS_THEME_PATH?>images/backgrounds/dota_background-02.jpg', title :  '',url : ''},
				   {image : '<?=OS_THEME_PATH?>images/backgrounds/dota_background-03.jpg', title :  '',url : ''},
				   {image : '<?=OS_THEME_PATH?>images/backgrounds/dota_background-04.jpg', title :  '',url : ''},
												]

				});
		    });

		</script>

<?php os_head(); ?>
</head>

<body class="home blog chrome" id="custom">


<div id="wrapper">
<div id="wrapper-main">

<header class="iegradient" id="header" role="banner">
<div class="innerwrap">
<div class="header-inner">
  <div id="siteinfo">
    <h1><a href="<?=OS_HOME?>" title="OpenStats" rel="home"><?=$HomeTitle?></a></h1>
    <p id="site-description"><?=$HomeDesc?></p>
  </div><!-- SITEINFO END -->
<?php 
/*
//RIGHT BANNER - 468x60
<div id="topbanner">
<a rel="nofollow" target="_blank" href="javascript:;"><img src="<?=OS_THEME_PATH?>images/468x60.png" alt="Banner" width="468" height="60" border="0" /></a>
</div>
<?php 
//TOPBANNER END
*/ 
?>
</div>
</div>
</header>
