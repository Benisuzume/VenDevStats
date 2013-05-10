<?php
if (!isset($website) ) { header('HTTP/1.1 404 Not Found'); die; }
?>

<?php
$c = 0;
/*        CUSTOM            */

//arrays
$best = array();
$winperc = array();
$score = array();
$games = array();
$zero = array();

//querys

//best_player
$best_player = $db->prepare("SELECT `player`,`best_player`,`id` FROM `stats` WHERE `id` >= 1 ORDER BY `best_player` DESC LIMIT 5");
$result = $best_player->execute();
while ($row = $best_player->fetch(PDO::FETCH_ASSOC)) {
$best[$c]["id"] = $row["id"];
$best[$c]["best_player"] = $row["best_player"];
$best[$c]["player"] = $row["player"];
$c++;
}

//zerodeaths
$zero_deaths = $db->prepare("SELECT `player`,`zerodeaths`,`id` FROM `stats` WHERE `id` >= 1 ORDER BY `zerodeaths` DESC LIMIT 5");
$result = $zero_deaths->execute();
while ($row = $zero_deaths->fetch(PDO::FETCH_ASSOC)) {
$zero[$c]["id"] = $row["id"];
$zero[$c]["zerodeaths"] = $row["zerodeaths"];
$zero[$c]["player"] = $row["player"];
$c++;
}

//winperc
$win_perc = $db->prepare("SELECT `player`,((`wins`/`games`)*100) as wp,`id` FROM `stats` WHERE `id` >= 1 AND `games` > 20 ORDER BY `wp` DESC LIMIT 5");
$result = $win_perc->execute();
while ($row = $win_perc->fetch(PDO::FETCH_ASSOC)) {
$winperc[$c]["id"] = $row["id"];
$winperc[$c]["wp"] = round($row["wp"], 2);
$winperc[$c]["player"] = $row["player"];
$c++;
}
//score
$score_player = $db->prepare("SELECT `player`,`score`,`id` FROM `stats` WHERE `id` >= 1 ORDER BY `score` DESC LIMIT 5");
$result = $score_player->execute();
while ($row = $score_player->fetch(PDO::FETCH_ASSOC)) {
$score[$c]["id"] = $row["id"];
$score[$c]["score"] = $row["score"];
$score[$c]["player"] = $row["player"];
$c++;
}
//score
$games_player = $db->prepare("SELECT `player`,`games`,`id` FROM `stats` WHERE `id` >= 1 ORDER BY `games` DESC LIMIT 5");
$result = $games_player->execute();
while ($row = $games_player->fetch(PDO::FETCH_ASSOC)) {
$games[$c]["id"] = $row["id"];
$games[$c]["games"] = $row["games"];
$games[$c]["player"] = $row["player"];
$c++;
}

/*         TOTAL            */

//arrays
$totalkills = array();
$totalassists = array();
$totalcreeps = array();
$totaldenies = array();
$totalneutrals = array();
$totaltowers = array();
$totalrax = array();
$totalwins = array();
//querys
//kills
$totkills = $db->prepare("SELECT `player`,`kills`,`id` FROM `stats` WHERE `id` >= 1 ORDER BY `kills` DESC LIMIT 5");
$result = $totkills->execute();
while ($row = $totkills->fetch(PDO::FETCH_ASSOC)) {
$totalkills[$c]["id"] = $row["id"];
$totalkills[$c]["player"] = $row["player"];
$totalkills[$c]["kills"] = $row["kills"];
$c++;
}
//wins
$totwins = $db->prepare("SELECT `player`,`wins`,`id` FROM `stats` WHERE id >= 1 ORDER BY `wins` DESC LIMIT 5");
$result = $totwins->execute();
while ($row = $totwins->fetch(PDO::FETCH_ASSOC)) {
$totalwins[$c]["id"] = $row["id"];
$totalwins[$c]["wins"] = $row["wins"];
$totalwins[$c]["player"] = $row["player"];
$c++;
}
//assists
$totassists = $db->prepare("SELECT `player`,`assists`,`id` FROM `stats` WHERE id >= 1 ORDER BY `assists` DESC LIMIT 5");
$result = $totassists->execute();
while ($row = $totassists->fetch(PDO::FETCH_ASSOC)) {
$totalassists[$c]["id"] = $row["id"];
$totalassists[$c]["player"] = $row["player"];
$totalassists[$c]["assists"] = $row["assists"];
$c++;
}
//creeps
$totcreeps = $db->prepare("SELECT `player`,`creeps`,`id` FROM `stats` WHERE id >= 1 ORDER BY `creeps` DESC LIMIT 5");
$result = $totcreeps->execute();
while ($row = $totcreeps->fetch(PDO::FETCH_ASSOC)) {
$totalcreeps[$c]["id"] = $row["id"];
$totalcreeps[$c]["player"] = $row["player"];
$totalcreeps[$c]["creeps"] = $row["creeps"];
$c++;
}
//denies
$totdenies = $db->prepare("SELECT `player`,`denies`,`id` FROM `stats` WHERE id >= 1 ORDER BY `denies` DESC LIMIT 5");
$result = $totdenies->execute();
while ($row = $totdenies->fetch(PDO::FETCH_ASSOC)) {
$totaldenies[$c]["id"] = $row["id"];
$totaldenies[$c]["player"] = $row["player"];
$totaldenies[$c]["denies"] = $row["denies"];
$c++;
}
//neutrals
$totneutrals = $db->prepare("SELECT `player`,`neutrals`,`id` FROM `stats` WHERE id >= 1 ORDER BY `neutrals` DESC LIMIT 5");
$result = $totneutrals->execute();
while ($row = $totneutrals->fetch(PDO::FETCH_ASSOC)) {
$totalneutrals[$c]["id"] = $row["id"];
$totalneutrals[$c]["player"] = $row["player"];
$totalneutrals[$c]["neutrals"] = $row["neutrals"];
$c++;
}
//tower
$tottowers = $db->prepare("SELECT `player`,`towers`,`id` FROM `stats` WHERE id >= 1 ORDER BY `towers` DESC LIMIT 5");
$result = $tottowers->execute();
while ($row = $tottowers->fetch(PDO::FETCH_ASSOC)) {
$totaltowers[$c]["id"] = $row["id"];
$totaltowers[$c]["player"] = $row["player"];
$totaltowers[$c]["towers"] = $row["towers"];
$c++;
}
//rax
$totrax = $db->prepare("SELECT `player`,`rax`,`id` FROM `stats` WHERE id >= 1 ORDER BY `rax` DESC LIMIT 5");
$result = $totrax->execute();
while ($row = $totrax->fetch(PDO::FETCH_ASSOC)) {
$totalrax[$c]["id"] = $row["id"];
$totalrax[$c]["player"] = $row["player"];
$totalrax[$c]["rax"] = $row["rax"];
$c++;
}

/*          AVG             */

//arrays
$avgkills = array();
$avgassists = array();
$avgcreeps = array();
$avgdenies = array();
$avgneutrals = array();
$avgtowers = array();
$avgrax = array();

//querys
//kills
$avkills = $db->prepare("SELECT `player`, `kills`/`games` as kpg,`id` FROM `stats` WHERE `id` >= 1 AND `games` > 20 ORDER BY `kpg` DESC LIMIT 5");
$result = $avkills->execute();
while ($row = $avkills->fetch(PDO::FETCH_ASSOC)) {
$avgkills[$c]["id"] = $row["id"];
$avgkills[$c]["player"] = $row["player"];
$avgkills[$c]["kpg"] = round($row["kpg"], 1);
$c++;
}
//assists
$avassists = $db->prepare("SELECT `player`, `assists`/`games` as apg,`id` FROM `stats` WHERE `id` >= 1 AND `games` > 20 ORDER BY `apg` DESC LIMIT 5");
$result = $avassists->execute();
while ($row = $avassists->fetch(PDO::FETCH_ASSOC)) {
$avgassists[$c]["id"] = $row["id"];
$avgassists[$c]["player"] = $row["player"];
$avgassists[$c]["apg"] = round($row["apg"], 1);
$c++;
}
//creeps
$avcreeps = $db->prepare("SELECT `player`, `creeps`/`games` as cpg,`id` FROM `stats` WHERE `id` >= 1 AND `games` > 20 ORDER BY `cpg` DESC LIMIT 5");
$result = $avcreeps->execute();
while ($row = $avcreeps->fetch(PDO::FETCH_ASSOC)) {
$avgcreeps[$c]["id"] = $row["id"];
$avgcreeps[$c]["player"] = $row["player"];
$avgcreeps[$c]["cpg"] = round($row["cpg"], 1);
$c++;
}
//denies
$avdenies = $db->prepare("SELECT `player`, `denies`/`games` as denpg,`id` FROM `stats` WHERE `id` >= 1 AND `games` > 20 ORDER BY `denpg` DESC LIMIT 5");
$result = $avdenies->execute();
while ($row = $avdenies->fetch(PDO::FETCH_ASSOC)) {
$avgdenies[$c]["id"] = $row["id"];
$avgdenies[$c]["player"] = $row["player"];
$avgdenies[$c]["denpg"] = round($row["denpg"], 1);
$c++;
}
//neutrals
$avneutrals = $db->prepare("SELECT `player`, `neutrals`/`games` as npg,`id` FROM `stats` WHERE `id` >= 1 AND `games` > 20 ORDER BY `npg` DESC LIMIT 5");
$result = $avneutrals->execute();
while ($row = $avneutrals->fetch(PDO::FETCH_ASSOC)) {
$avgneutrals[$c]["id"] = $row["id"];
$avgneutrals[$c]["player"] = $row["player"];
$avgneutrals[$c]["npg"] = round($row["npg"], 1);
$c++;
}
//towers
$avtowers = $db->prepare("SELECT `player`, `towers`/`games` as tpg,`id` FROM `stats` WHERE `id` >= 1 AND `games` > 20 ORDER BY `tpg` DESC LIMIT 5");
$result = $avtowers->execute();
while ($row = $avtowers->fetch(PDO::FETCH_ASSOC)) {
$avgtowers[$c]["id"] = $row["id"];
$avgtowers[$c]["player"] = $row["player"];
$avgtowers[$c]["tpg"] = round($row["tpg"], 1);
$c++;
}
//rax
$avrax = $db->prepare("SELECT `player`, `rax`/`games` as rpg,`id` FROM `stats` WHERE `id` >= 1 AND `games` > 20 ORDER BY `rpg` DESC LIMIT 5");
$result = $avrax->execute();
while ($row = $avrax->fetch(PDO::FETCH_ASSOC)) {
$avgrax[$c]["id"] = $row["id"];
$avgrax[$c]["player"] = $row["player"];
$avgrax[$c]["rpg"] = round($row["rpg"], 1);
$c++;
}
?>
<div class="clr"></div>
 <div class="ct-wrapper">
  <div class="outer-wrapper">
   <div class="content section">
    <div class="widget Blog">
     <div class="blog-posts hfeed">
      <h2 class="title">Top Players</h2>
       <div class="comparePlayers">
        <table>
    	 <tr><th colspan="2">Top Scores</th></tr>
         <?//score
          foreach( $score as $s ) { ?>
           <tr><td style="width: 200px"><a href="<?=OS_HOME?>?u=<?=$s["id"]?>"><?=$s["player"]?></a></td><td style="width: 100px"><?=$s["score"]?></td></tr>
	 <? } ?>
	</table>
       </div>
       <div class="comparePlayers">
        <table>
         <tr><th colspan="2">Top Games</th></tr>
         <?//games
          foreach( $games as $g ) { ?>
           <tr><td style="width: 200px"><a href="<?=OS_HOME?>?u=<?=$g["id"]?>"><?=$g["player"]?></a></td><td style="width: 100px"><?=$g["games"]?></td></tr>
         <? } ?>
        </table>
       </div>
       <div class="comparePlayers">
        <table>
         <tr><th colspan="2">Top Total Win-Precentage</th></tr>
         <?//win_perc
          foreach( $winperc as $w ) { ?>
           <tr><td style="width: 200px"><a href="<?=OS_HOME?>?u=<?=$w["id"]?>"><?=$w["player"]?></a></td><td style="width: 100px"><?=$w["wp"]?>%</td></tr>
         <? } ?>
        </table>
       </div>
       <div class="comparePlayers">
        <table>
         <tr><th colspan="2" >Top Best Player</th></tr>
         <?//best_player
          foreach( $best as $b ) { ?>
           <tr><td style="width: 200px"><a href="<?=OS_HOME?>?u=<?=$b["id"]?>"><?=$b["player"]?></a></td><td style="width: 100px"><?=$b["best_player"]?></td></tr>
         <? } ?>
        </table>
       </div>
       <div class="comparePlayers">
        <table>
         <tr><th colspan="2" >Top Zero Deaths Player</th></tr>
         <?//zero deaths
          foreach( $zero as $z ) { ?>
           <tr><td style="width: 200px"><a href="<?=OS_HOME?>?u=<?=$z["id"]?>"><?=$z["player"]?></a></td><td style="width: 100px"><?=$z["zerodeaths"]?></td></tr>
         <? } ?>
        </table>
       </div>
<div style="clear:both;">&nbsp;</div>
<div class="clr"></div>
<h2 class="title">Top Total Players</h2>
<div class="comparePlayers">
    <table>
     <tr><th colspan="2">Top Total Wins</th></tr>
        <?//wins
        foreach( $totalwins as $td ) { ?>
                <tr><td style="width: 200px"><a href="<?=OS_HOME?>?u=<?=$td["id"]?>"><?=$td["player"]?></a></td><td style="width: 100px"><?=$td["wins"]?></td></tr>
        <? } ?>
    </table>
</div>
<div class="comparePlayers">
    <table>
     <tr><th colspan="2">Top Total Kills</th></tr>
	<?//kills
	foreach( $totalkills as $tk ) { ?>
		<tr><td style="width: 200px"><a href="<?=OS_HOME?>?u=<?=$tk["id"]?>"><?=$tk["player"]?></a></td><td style="width: 100px"><?=$tk["kills"]?></td></tr>
	<? } ?>
    </table>
</div>
<div class="comparePlayers">
    <table>
     <tr><th colspan="2">Top Total Assists</th></tr>
        <?//assists
        foreach( $totalassists as $ta ) { ?>
                <tr><td style="width: 200px"><a href="<?=OS_HOME?>?u=<?=$ta["id"]?>"><?=$ta["player"]?></a></td><td style="width: 100px"><?=$ta["assists"]?></td></tr>
        <? } ?>
    </table>
</div>
<div class="comparePlayers">
    <table>
     <tr><th colspan="2">Top Total Creeps</th></tr>
        <?//creeps
        foreach( $totalcreeps as $tc ) { ?>
                <tr><td style="width: 200px"><a href="<?=OS_HOME?>?u=<?=$tc["id"]?>"><?=$tc["player"]?></a></td><td style="width: 100px"><?=$tc["creeps"]?></td></tr>
        <? } ?>
    </table>
</div>
<div class="comparePlayers">
    <table>
     <tr><th colspan="2">Top Total Denies</th></tr>
        <?//denies
        foreach( $totaldenies as $td ) { ?>
                <tr><td style="width: 200px"><a href="<?=OS_HOME?>?u=<?=$td["id"]?>"><?=$td["player"]?></a></td><td style="width: 100px"><?=$td["denies"]?></td></tr>
        <? } ?>
    </table>
</div>
<div class="comparePlayers">
    <table>
     <tr><th colspan="2">Top Total Neutrals</th></tr>
        <?//neutrals
        foreach( $totalneutrals as $tn ) { ?>
                <tr><td style="width: 200px"><a href="<?=OS_HOME?>?u=<?=$tn["id"]?>"><?=$tn["player"]?></a></td><td style="width: 100px"><?=$tn["neutrals"]?></td></tr>
        <? } ?>
    </table>
</div>
<div class="comparePlayers">
    <table>
     <tr><th colspan="2">Top Total Towers</th></tr>
        <?//towers
        foreach( $totaltowers as $tt ) { ?>
                <tr><td style="width: 200px"><a href="<?=OS_HOME?>?u=<?=$tt["id"]?>"><?=$tt["player"]?></a></td><td style="width: 100px"><?=$tt["towers"]?></td></tr>
        <? } ?>
    </table>
</div>
<div class="comparePlayers">
    <table>
     <tr><th colspan="2">Top Total Rax</th></tr>
        <?//rax
        foreach( $totalrax as $tr ) { ?>
                <tr><td style="width: 200px"><a href="<?=OS_HOME?>?u=<?=$tr["id"]?>"><?=$tr["player"]?></a></td><td style="width: 100px"><?=$tr["rax"]?></td></tr>
        <? } ?>
    </table>
</div>
<div style="clear:both;">&nbsp;</div>
<div class="clr"></div>
<h2 class="title">Top AVG Players</h2>
<div class="comparePlayers">
    <table>
     <tr><th colspan="2">Top AVG Kills</th></tr>
        <?//kills
        foreach( $avgkills as $ak ) { ?>
                <tr><td style="width: 200px"><a href="<?=OS_HOME?>?u=<?=$ak["id"]?>"><?=$ak["player"]?></a></td><td style="width: 100px"><?=$ak["kpg"]?></td></tr>
        <? } ?>
    </table>
</div>
<div class="comparePlayers">
    <table>
     <tr><th colspan="2">Top AVG Assists</th></tr>
        <?//assists
        foreach( $avgassists as $aa ) { ?>
                <tr><td style="width: 200px"><a href="<?=OS_HOME?>?u=<?=$aa["id"]?>"><?=$aa["player"]?></a></td><td style="width: 100px"><?=$aa["apg"]?></td></tr>
        <? } ?>
    </table>
</div>
<div class="comparePlayers">
    <table>
     <tr><th colspan="2">Top AVG Creeps</th></tr>
        <?//creeps
        foreach( $avgcreeps as $ac ) { ?>
                <tr><td style="width: 200px"><a href="<?=OS_HOME?>?u=<?=$ac["id"]?>"><?=$ac["player"]?></a></td><td style="width: 100px"><?=$ac["cpg"]?></td></tr>
        <? } ?>
    </table>
</div>
<div class="comparePlayers">
    <table>
     <tr><th colspan="2">Top AVG Denies</th></tr>
        <?//denies
        foreach( $avgdenies as $ad ) { ?>
                <tr><td style="width: 200px"><a href="<?=OS_HOME?>?u=<?=$ad["id"]?>"><?=$ad["player"]?></a></td><td style="width: 100px"><?=$ad["denpg"]?></td></tr>
        <? } ?>
    </table>
</div>
<div class="comparePlayers">
    <table>
     <tr><th colspan="2">Top AVG Neutrals</th></tr>
        <?//neutrals
        foreach( $avgneutrals as $an ) { ?>
                <tr><td style="width: 200px"><a href="<?=OS_HOME?>?u=<?=$an["id"]?>"><?=$an["player"]?></a></td><td style="width: 100px"><?=$an["npg"]?></td></tr>
        <? } ?>
    </table>
</div>
<div class="comparePlayers">
    <table>
     <tr><th colspan="2">Top AVG Towers</th></tr>
        <?//towers
        foreach( $avgtowers as $at ) { ?>
                <tr><td style="width: 200px"><a href="<?=OS_HOME?>?u=<?=$at["id"]?>"><?=$at["player"]?></a></td><td style="width: 100px"><?=$at["tpg"]?></td></tr>
        <? } ?>
    </table>
</div>
<div class="comparePlayers">
    <table>
     <tr><th colspan="2">Top AVG Rax</th></tr>
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
