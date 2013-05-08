<?php
//Plugin: Scroll to top (jQuery)
//Author: Ivan
//Scroll to top plugin. <b>jQuery</b> must be enabled.


if (!isset($website) ) { header('HTTP/1.1 404 Not Found'); die; }

$PluginEnabled = '0';

if ($PluginEnabled == 1  ) {

   AddEvent("os_footer","OS_ScrollToTop");
   
   function OS_ScrollToTop() {
?>
<script type="text/javascript">	
$(function(){
			
  //$("#content").remove();
  $("body").append('<div id="scroll_to_top"><a href="#top">Go top</a></div>');
  $("#scroll_to_top a").css({'display' : 'none', 'z-index' : '9', 'position' : 'fixed', 'top' : '100%', 'width' : '72px', 'margin-top' : '-55px', 'right' : '50px', 'margin-left' : '-50px', 'height' : '20px', 'padding' : '3px 5px', 'font-size' : '14px', 'text-align' : 'center', 'padding' : '3px', 'color' : '#ffffff', 'background-color' : '#222222', '-moz-border-radius' : '5px', '-khtml-border-radius' : '5px', '-webkit-border-radius' : '5px', 'opacity' : '.8', 'text-decoration' : 'none'});	
  
  $('#scroll_to_top a').click(function(){
  $('html, body').animate({scrollTop:0}, 'slow');
  });
  
  $('.gototop').remove(); //Remove go to top (in template)
  
	var scroll_timer;
	var displayed = false;
	var top = $(document.body).children(0).position().top+800;
	$(window).scroll(function () {
		window.clearTimeout(scroll_timer);
		scroll_timer = window.setTimeout(function () {
			if($(window).scrollTop() <= top)
			{
				displayed = false;
				$('#scroll_to_top a').fadeOut(500);
			}
			else if(displayed == false)
			{
				displayed = true;
				$('#scroll_to_top a').stop(true, true).show().click(function () { $('#scroll_to_top a').fadeOut(500); });
			}
		}, 100);
	});
  
});
</script>
<?php
   }
   
}
?>