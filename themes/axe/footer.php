<?php
if (!isset($website) ) { header('HTTP/1.1 404 Not Found'); die; }
?>

</section>
</div></div></div>
</section>
</div>



</div><!-- WRAPPER MAIN END -->
</div><!-- WRAPPER END -->



<footer class="footer-top">
<div class="innerwrap">
<div class="ftop">
<div class="footer-left">

   <div class="footer-content">
    <div>Generated in: <?=$total_time?> sec.</div>
   </div>
  </div>
  
<div class="footer-right">
   <div class="gototop"><a href="#" rel="nofollow">Return to top of page</a> </div>
</div>
</div>
</div>
</footer>

<?php os_footer();?>

<footer class="footer-bottom">
<div class="innerwrap">
<div class="fbottom">
<div class="footer-left">
</div><!-- FOOTER LEFT END -->

<div class="footer-right">Copyright &#169; <?=date("Y")?> &#183; Powered by <a target="_blank" href="http://openstats.iz.rs/">OpenStats <?=OS_VERSION?></a> modified by <a target="_blank" href="http://www.codelain.com/forum/index.php?action=profile">Grief-Code</a></div>
<!-- FOOTER RIGHT END -->
</div>
</div>
</footer>

<?php os_after_footer(); ?>
</body>
</html>
