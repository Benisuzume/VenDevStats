<?php
if (!isset($website) ) { header('HTTP/1.1 404 Not Found'); die; }
?>

<?php
$c = 0;

/*          CUSTOM          */
//arrays
$leave = array();
$dc = array();
$loose = array();
$nscore = array();
$lowperc = array();
$querys = array();
//querys
//leave
$leave_count = $db->prepare("SELECT `player`,`leaver`,`id` FROM `stats` WHERE `id` >= 1 ORDER BY `leaver` DESC LIMIT 5");
$result = $leave_count->execute();
array_push($querys, "1" );
while ($row = $leave_count->fetch(PDO::FETCH_ASSOC)) {
$leave[$c]["id"] = $row["id"];
$leave[$c]["leave_count"] = $row["leaver"];
$leave[$c]["player"] = $row["player"];
$c++;
}

//dc
$dc_count = $db->prepare("SELECT `player`,`dc_count`,`id` FROM `stats` WHERE `id` >= 1 ORDER BY `dc_count` DESC LIMIT 5");
$result = $dc_count->execute();
array_push($querys, "2" );
while ($row = $dc_count->fetch(PDO::FETCH_ASSOC)) {
$dc[$c]["id"] = $row["id"];
$dc[$c]["dc_count"] = $row["dc_count"];
$dc[$c]["player"] = $row["player"];
$c++;
}
//losse
$losse_count = $db->prepare("SELECT `player`,`losses`,`id` FROM `stats` WHERE `id` >= 1 ORDER BY `losses` DESC LIMIT 5");
$result = $losse_count->execute();
array_push($querys, "3" );
while ($row = $losse_count->fetch(PDO::FETCH_ASSOC)) {
$losse[$c]["id"] = $row["id"];
$losse[$c]["losses"] = $row["losses"];
$losse[$c]["player"] = $row["player"];
$c++;
}
//score
$score_count = $db->prepare("SELECT `player`,`score`,`id` FROM `stats` WHERE `id` >= 1 ORDER BY `score` LIMIT 5");
$result = $score_count->execute();
array_push($querys, "4" );
while ($row = $score_count->fetch(PDO::FETCH_ASSOC)) {
$nscore[$c]["id"] = $row["id"];
$nscore[$c]["score"] = $row["score"];
$nscore[$c]["player"] = $row["player"];
$c++;
}
//losse perc
$low_perc = $db->prepare("SELECT `player`,((`losses`/`games`)*100) as lp,`id` FROM `stats` WHERE `id` >= 1 AND `games` > 20 ORDER BY `lp` DESC LIMIT 5");
$result = $low_perc->execute();
array_push($querys, "5" );
while ($row = $low_perc->fetch(PDO::FETCH_ASSOC)) {
$lowperc[$c]["id"] = $row["id"];
$lowperc[$c]["lp"] = round($row["lp"], 2);
$lowperc[$c]["player"] = $row["player"];
$c++;
}

/*      AVGS        */
//arrays
$avgkills = array();
$avgassists = array();
$avgcreeps = array();
$avgdenies = array();
$avgneutrals = array();
$avgtowers = array();
$avgrax = array();
$querys1 = array();
//querys
//kills
$avkills = $db->prepare("SELECT `player`, `kills`/`games` as kpg,`id` FROM `stats` WHERE `id` >= 1 AND `games` > 20 ORDER BY `kpg` LIMIT 5");
$result = $avkills->execute();
array_push($querys1, "1" );
while ($row = $avkills->fetch(PDO::FETCH_ASSOC)) {
$avgkills[$c]["id"] = $row["id"];
$avgkills[$c]["player"] = $row["player"];
$avgkills[$c]["kpg"] = round($row["kpg"], 1);
$c++;
}
//assists
$avassists = $db->prepare("SELECT `player`, `assists`/`games` as apg,`id` FROM `stats` WHERE `id` >= 1 AND `games` > 20 ORDER BY `apg` LIMIT 5");
$result = $avassists->execute();
array_push($querys1, "2" );
while ($row = $avassists->fetch(PDO::FETCH_ASSOC)) {
$avgassists[$c]["id"] = $row["id"];
$avgassists[$c]["player"] = $row["player"];
$avgassists[$c]["apg"] = round($row["apg"], 1);
$c++;
}
//creeps
$avcreeps = $db->prepare("SELECT `player`, `creeps`/`games` as cpg,`id` FROM `stats` WHERE `id` >= 1 AND `games` > 20 ORDER BY `cpg` LIMIT 5");
array_push($querys1, "3" );
$result = $avcreeps->execute();
while ($row = $avcreeps->fetch(PDO::FETCH_ASSOC)) {
$avgcreeps[$c]["id"] = $row["id"];
$avgcreeps[$c]["player"] = $row["player"];
$avgcreeps[$c]["cpg"] = round($row["cpg"], 1);
$c++;
}
//denies
$avdenies = $db->prepare("SELECT `player`, `denies`/`games` as denpg,`id` FROM `stats` WHERE `id` >= 1 AND `games` > 20 ORDER BY `denpg` LIMIT 5");
$result = $avdenies->execute();
array_push($querys1, "4" );
while ($row = $avdenies->fetch(PDO::FETCH_ASSOC)) {
$avgdenies[$c]["id"] = $row["id"];
$avgdenies[$c]["player"] = $row["player"];
$avgdenies[$c]["denpg"] = round($row["denpg"], 1);
$c++;
}
//neutrals
$avneutrals = $db->prepare("SELECT `player`, `neutrals`/`games` as npg,`id` FROM `stats` WHERE `id` >= 1 AND `games` > 20 ORDER BY `npg` LIMIT 5");
$result = $avneutrals->execute();
array_push($querys1, "5" );
while ($row = $avneutrals->fetch(PDO::FETCH_ASSOC)) {
$avgneutrals[$c]["id"] = $row["id"];
$avgneutrals[$c]["player"] = $row["player"];
$avgneutrals[$c]["npg"] = round($row["npg"], 1);
$c++;
}
//towers
$avtowers = $db->prepare("SELECT `player`, `towers`/`games` as tpg,`id` FROM `stats` WHERE `id` >= 1 AND `games` > 20 ORDER BY `tpg` LIMIT 5");
$result = $avtowers->execute();
array_push($querys1, "6" );
while ($row = $avtowers->fetch(PDO::FETCH_ASSOC)) {
$avgtowers[$c]["id"] = $row["id"];
$avgtowers[$c]["player"] = $row["player"];
$avgtowers[$c]["tpg"] = round($row["tpg"], 1);
$c++;
}
//rax
$avrax = $db->prepare("SELECT `player`, `rax`/`games` as rpg,`id` FROM `stats` WHERE `id` >= 1 AND `games` > 20 ORDER BY `rpg` LIMIT 5");
array_push($querys1, "7" );
$result = $avrax->execute();
while ($row = $avrax->fetch(PDO::FETCH_ASSOC)) {
$avgrax[$c]["id"] = $row["id"];
$avgrax[$c]["player"] = $row["player"];
$avgrax[$c]["rpg"] = round($row["rpg"], 1);
$c++;
}
$k = 1;
?>
<div class="clr"></div>
 <div class="ct-wrapper">
  <div class="outer-wrapper">
   <div class="content section">
    <div class="widget Blog">
     <div class="blog-posts hfeed">
      <h2 class="title">Worst Players</h2>
      <div class="comparePlayers">
       <table style="width:180px; float:left; height:180px;"">
        <tr><th colspan="2">Worst Scores</th></tr>
        <?//score
         foreach( $nscore as $ns ) { ?>
          <tr><td style="width: 200px"><a href="<?=OS_HOME?>?u=<?=$ns["id"]?>"><?=$ns["player"]?></a></td><td style="width: 100px"><?=$ns["score"]?></td></tr>
        <? } ?>
       </table>
      </div>
      <div class="comparePlayers">
       <table style="width:180px; float:left; height:180px;"">
        <tr><th colspan="2">Worst Loose Percentage</th></tr>
        <?//low_perc
         foreach( $lowperc as $lp ) { ?>
          <tr><td style="width: 200px"><a href="<?=OS_HOME?>?u=<?=$lp["id"]?>"><?=$lp["player"]?></a></td><td style="width: 100px"><?=$lp["lp"]?>%</td></tr>
        <? } ?>
       </table>
      </div>
      <div class="comparePlayers">
       <table style="width:180px; float:left; height:180px;"">
        <tr><th colspan="2">Most Losses</th></tr>
        <?//losses
         foreach( $losse as $l ) { ?>
          <tr><td style="width: 200px"><a href="<?=OS_HOME?>?u=<?=$l["id"]?>"><?=$l["player"]?></a></td><td style="width: 100px"><?=$l["losses"]?></td></tr>
        <? } ?>
       </table>
      </div>
      <div class="comparePlayers">
       <table style="width:180px; float:left; height:180px;"">
        <tr><th colspan="2">Most Leavings</th></tr>
        <?//leave
         foreach( $leave as $l ) { ?>
          <tr><td style="width: 200px"><a href="<?=OS_HOME?>?u=<?=$l["id"]?>"><?=$l["player"]?></a></td><td style="width: 100px"><?=$l["leave_count"]?></td></tr>
        <? } ?>
       </table>
      </div>
      <div class="comparePlayers">
       <table style="width:180px; float:left; height:180px;"">
        <tr><th colspan="2">Most Disconnects</th></tr>
        <?//leave
         foreach( $dc as $d ) { ?>
          <tr><td style="width: 200px"><a href="<?=OS_HOME?>?u=<?=$d["id"]?>"><?=$d["player"]?></a></td><td style="width: 100px"><?=$d["dc_count"]?></td></tr>
        <? } ?>
       </table>
      </div>
<div style="clear:both;">&nbsp;</div>
<div class="clr"></div>
<h2 class="title">Top Total Players</h2>
      <div class="comparePlayers">
       <table>
        <tr><th colspan="2">Worst AVG Kills</th></tr>
        <?//kills
         foreach( $avgkills as $ak ) { ?>
          <tr><td style="width: 200px"><a href="<?=OS_HOME?>?u=<?=$ak["id"]?>"><?=$ak["player"]?></a></td><td style="width: 100px"><?=$ak["kpg"]?></td></tr>
        <? } ?>
       </table>
      </div>
      <div class="comparePlayers">
       <table>
        <tr><th colspan="2">Worst AVG Assists</th></tr>
        <?//assists
         foreach( $avgassists as $aa ) { ?>
          <tr><td style="width: 200px"><a href="<?=OS_HOME?>?u=<?=$aa["id"]?>"><?=$aa["player"]?></a></td><td style="width: 100px"><?=$aa["apg"]?></td></tr>
        <? } ?>
       </table>
      </div>
      <div class="comparePlayers">
       <table>
        <tr><th colspan="2">Worst AVG Creeps</th></tr>
        <?//creeps
         foreach( $avgcreeps as $ac ) { ?>
          <tr><td style="width: 200px"><a href="<?=OS_HOME?>?u=<?=$ac["id"]?>"><?=$ac["player"]?></a></td><td style="width: 100px"><?=$ac["cpg"]?></td></tr>
        <? } ?>
       </table>
      </div>
      <div class="comparePlayers">
       <table>
        <tr><th colspan="2">Worst AVG Denies</th></tr>
        <?//denies
         foreach( $avgdenies as $ad ) { ?>
          <tr><td style="width: 200px"><a href="<?=OS_HOME?>?u=<?=$ad["id"]?>"><?=$ad["player"]?></a></td><td style="width: 100px"><?=$ad["denpg"]?></td></tr>
        <? } ?>
       </table>
      </div>
      <div class="comparePlayers">
       <table>
        <tr><th colspan="2">Worst AVG Neutrals</th></tr>
        <?//neutrals
         foreach( $avgneutrals as $an ) { ?>
          <tr><td style="width: 200px"><a href="<?=OS_HOME?>?u=<?=$an["id"]?>"><?=$an["player"]?></a></td><td style="width: 100px"><?=$an["npg"]?></td></tr>
        <? } ?>
       </table>
      </div>
      <div class="comparePlayers">
       <table>
        <tr><th colspan="2">Worst AVG Towers</th></tr>
        <?//towers
         foreach( $avgtowers as $at ) { ?>
          <tr><td style="width: 200px"><a href="<?=OS_HOME?>?u=<?=$at["id"]?>"><?=$at["player"]?></a></td><td style="width: 100px"><?=$at["tpg"]?></td></tr>
        <? } ?>
       </table>
      </div>
      <div class="comparePlayers">
       <table>
        <tr><th colspan="2">Worst AVG Rax</th></tr>
        <?//kills
         foreach( $avgrax as $ar ) { ?>
          <tr><td style="width: 200px"><a href="<?=OS_HOME?>?u=<?=$ar["id"]?>"><?=$ar["player"]?></a></td><td style="width: 100px"><?=$ar["rpg"]?></td></tr>
        <? } ?>
       </table>
      </div>
<div style="clear:both;">&nbsp;</div>
    </div>
   </div>
  </div>
 <br>
