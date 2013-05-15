<?php
if (!isset($website) ) {header('HTTP/1.1 404 Not Found'); die; }
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="content-style-type" content="text/css" />
	<meta name="author" content="Ivan Antonijevic" />
	<meta name="rating" content="Safe For Kids" />
 	<meta name="description" content="<?=$HomeDesc?>" />
	<meta name="keywords" content="<?=$HomeKeywords?>" />
	<?=os_add_meta()?>
	
	<title><?=$HomeTitle?></title>
	
<link rel="index" title="<?=OS_HOME_TITLE?>" href="<?=OS_HOME?>" />

<link href='http://fonts.googleapis.com/css?family=Playball' rel='stylesheet' type='text/css'/>
<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'/>
<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js'></script>

<link rel="stylesheet" href="<?=OS_HOME?><?=OS_CURRENT_THEME_PATH?>style.css" type="text/css" />
<link rel="stylesheet" href="<?=OS_HOME?><?=OS_CURRENT_THEME_PATH?>widget.css" type="text/css" />
<script type="text/javascript" src="<?=OS_HOME?>scripts.js"></script>
<?php os_head(); ?>

<script type='text/javascript'>//<![CDATA[
eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('5 6(s,n){b s.c(/<.*?>/d,"").e(/\\s+/).f(0,n-1).g(" ")}5 h(a){i p=j.k(a),3="",2=p.l("2");m(2.o>=1)3=\'<2 7="8" 4="\'+2[0].4+\'" />\';q 3=\'<2 7="8 r-2" 4="t://u.v.w/-y/z-A/B/C-D/E.F" />\';p.9=\'<a G="\'+x+\'">\'+3+"</a>"+"<p>"+6(p.9,H)+"...</p>"};',44,44,'||img|imgtag|src|function|stripTags|class|thumb|innerHTML||return|replace|ig|split|slice|join|readmore|var|document|getElementById|getElementsByTagName|if||length||else|no||https|lh4|googleusercontent|com||G9M2DTCTUwM|Tlh|2pwtc5I|AAAAAAAABKM|kCJg|Kf3W2M|no_image_yet|jpg|href|12'.split('|'),0,{}))
//]]></script>
<script type="text/javascript">var a=navigator,b="userAgent",c="indexOf",f="&m=1",g="(^|&)m=",h="?",k="?m=1";function l(){var d=window.location.href,e=d.split(h);switch(e.length){case 1:return d+k;case 2:return 0<=e[1].search(g)?null:d+f;default:return null}}if(-1!=a[b][c]("Mobile")&&-1!=a[b][c]("WebKit")&&-1==a[b][c]("iPad")||-1!=a[b][c]("Opera Mini")||-1!=a[b][c]("IEMobile")){var m=l();m&&window.location.replace(m)};
</script><script type="text/javascript">
if (window.jstiming) window.jstiming.load.tick('headEnd');
</script>
</head>
