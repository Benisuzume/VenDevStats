<?php
if (!isset($website) ) { header('HTTP/1.1 404 Not Found'); die; }
?>
<h2 class="header-title"><?=$lang["admins"] ?></h2>
<div class="entry">
  <article>
   <table>
    <tr>
       <th width="180" class="padLeft"><?=$lang["admin"] ?></th>
	   <th><?=$lang["server"] ?></th>
    </tr>
   
   <?php foreach($AdminsData as $Admin) { ?>
    <tr>
       <td width="180" class="padLeft"><a href="<?=OS_HOME?>?u=<?=strtolower($Admin["name"])?>"><?=$Admin["name"]?></a></td>
	   <td><?=$Admin["server"]?></td>
    </tr>
   <?php } ?>
   </table>
     </article>
</div>
  <?php
include('inc/pagination.php');
?>