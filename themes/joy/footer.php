<?php
if (!isset($website) ) { header('HTTP/1.1 404 Not Found'); die; }
?>
</div>
</div><!-- blogouter-container -->

<div id='footer'>
<div class='footer-bottom'>
<div class='container'>
  <?php os_footer();?>
    <div class="debug">Generated in: <?=$total_time?> sec.</div>
    <div class="creds">Copyright &#169; <?=date("Y")?> &#183; Powered by <a target="_blank" href="http://openstats.iz.rs/">OpenStats <?=OS_VERSION?></a> modified by <a target="_blank" href="http://www.codelain.com/forum/index.php?action=profile">Grief-Code</a></div>
    <div class="clr"></div>
</div>
 </div><!-- /ct-wrapper -->
</div><!-- footer-wrapper -->


</div><!-- blogouter-wrapper -->
<?php os_after_footer(); ?>
</body>
</html>
