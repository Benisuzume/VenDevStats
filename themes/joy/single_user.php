<?php
if (!isset($website) ) { header('HTTP/1.1 404 Not Found'); die; }
if (!isset($_SESSION["level"]) AND empty($_SESSION["level"]) ) $_SESSION["level"] = 0;
//image change add on
?>
<script language="javascript">
function changeImage($iid) {
 if (document.getElementById($iid).src == "<?=OS_HOME?>img/unexpand.png") {
  document.getElementById($iid).src = "<?=OS_HOME?>img/expand.png";
 } else {
  document.getElementById($iid).src = "<?=OS_HOME?>img/unexpand.png";
 }
}
</script>
<? foreach ( $UserData as $User ) {
  ?>
<div class="clr"></div>
 <div class="ct-wrapper">
  <div class="outer-wrapper">
   <div class="content section">
    <div class="widget Blog">
     <div class="blog-posts hfeed">
  
  <h1>
	<?=OS_ShowUserFlag( $User["letter"], $User["country"] )?>
    <?=$User["player"]?><font color="blue">@<?=$User["realm"]?></font>  
	<?=OS_IsUserGameBanned( $User["banned"], $lang["banned"] )?>
	<?=OS_IsUserGameAdmin( $User["GameAdmin"], $lang["admin"] )?>
	<?=OS_IsUserGameWarned( $User["warn"],  $User["warn_expire"], $lang["warned"] )?>
	<?=OS_IsUserGameSafe( $User["safelist"], $lang["safelist"] )?>
	<?=OS_IsUserGameLeaver( $User["leaver"], $lang["leaves"].": ".$User["leaver"]."<div>".$lang["stayratio"].": ".$User["stayratio"]."%</div>",1 )?>
  </h1>
<? if ( $_SESSION["level"]>=10 ) { ?>
	<h4> IP: <?=$User["ip"]?> </h4>
<? }
if ( OS_is_banned_player( $User["banname"] ) ) {
?>
   <h3 class="title">Banned<img class="imgvalign" id="3" width="16" height="16" src="<?=OS_HOME?>img/expand.png" onclick="showhide('BANS'); changeImage(3);" alt="" /></h3>
     <tr>
      <div id="BANS" style="display:none;">
     <? foreach ( $bans as $bq ) { ?>
	<div class="comparePlayers">
	 <table>
	  <tr><td width="90">Name</td><td width="160"><font color="red"><?=$bq["name"]?></font></td></tr>
	  <tr><td width="90">Realm</td><td width="160"><font color="green"><?=$bq["server"]?></font></td></tr>
	 <? if ( $_SESSION["level"]>=10 ) { ?>
          <tr><td width="90">IP</td><td width="160"><font color="blue"><?=$bq["ip"]?></font></td></tr>
	 <? }
           $full_reason = "Reason: ".$bq["reason"];
	    if( strlen($bq["reason"]) > "30" ) {
	   $bqreason = explode(" ", $bq["reason"]); ?>
 	  <tr><td width="90">Reason</td><td width="160"><span <?=ShowToolTip($full_reason, OS_HOME.'img/banned.png', 400, 16, 16)?>><?=$bqreason[0]?></span></td></tr>
	 <? } else { ?>
          <tr><td width="90">Reason</td><td width="160"><span <?=ShowToolTip($full_reason, OS_HOME.'img/banned.png', 400, 16, 16)?>><?=$bq["reason"]?></span></td></tr>
	 <? }
	    if( isset($bq["gamename"]) AND !empty($bq["gamename"]))  {
	   $bqgn = explode(" ", $bq["gamename"]);
                if( isset($bqgn[2]) AND !empty($bqgn[2]) ) { ?>
		  <tr><td width="90">GameNumber</td><td width="160"><font color="teal"><span <?=ShowToolTip($bq["gamename"], OS_HOME.'img/banned.png', 200, 16, 16)?>><?=$bqgn[2]?></span></font></td></tr>
                <? } else { ?>
                  <tr><td width="90">GameName</td><td width="160"><font color="teal"><?=$bq["gamename"]?></font></td></tr>
                <? }  ?>
	 <? } else { ?>
          <tr><td width="90">GameName</td><td width="160"><?=$bq["gamename"]?></td></tr>
	 <? }  ?>
          <tr><td width="90">Admin</td><td width="160"><font color="purple"><?=$bq["admin"]?></font></td></tr>
	<? $date = explode(" ", $bq["date"]); ?>
          <tr><td width="90">Date</td><td width="160"><font color="red"><?=$date[0]?></font></td></tr>
        <? if( isset( $bq["expiredate"] ) AND !empty( $bq["expiredate"] ) ) {
	   $date1 = explode(" ", $bq["expiredate"]); ?>
          <tr><td width="90">E-Day</td><td width="160"><font color="orange"><?=$date1[0]?></font></td></tr>
        <? } ?>
	 </table>
	</div>
        <? }
        foreach ( $ipbans as $ibq ) { ?>
	<div class="comparePlayers">
         <table>
          <tr><td width="90">Name</td><td width="160"><font color="red"><?=$ibq["name"]?></font></td></tr>
          <tr><td width="90">Realm</td><td width="160"><font color="green"><?=$ibq["server"]?></font></td></tr>
       	 <? if ( $_SESSION["level"]>=10 ) { ?>
          <tr><td width="90">IP</td><td width="160"><font color="blue"><?=$ibq["ip"]?></font></td></tr>
	 <? }
	    if( strlen($bq["reason"]) > "30" ) {
	   $ibqreason = explode(" ", $ibq["reason"]); ?>
 	  <tr><td width="90">Reason</td><td width="160"><?=$ibqreason[0]?></td></tr>
	 <? } else { ?>
          <tr><td width="90">Reason</td><td width="160"><?=$ibq["reason"]?></td></tr>
	 <? }
	    if( isset($ibq["gamename"]) AND !empty($ibq["gamename"]))  {
	   $ibqgn = explode(" ", $ibq["gamename"]); ?>
          <tr><td width="90">GameNumber</td><td width="160"><span <?=ShowToolTip($bq["gamename"], OS_HOME.'img/banned.png', 200, 16, 16)?>><font color="teal"><?=$ibqgn[2]?></font></span></td></tr>
	 <? } else { ?>
          <tr><td width="90">Reason</td><td width="160"><?=$ibq["gamename"]?></td></tr>
 	 <? }  ?>
          <tr><td width="90">Admin</td><td width="160"><font color="purple"><?=$ibq["admin"]?></td></font></tr>
	 <? $date = explode(" ", $ibq["date"]); ?>
          <tr><td width="90">Date</td><td width="160"><font color="red"><?=$date[0]?></td></font></tr>
	 <? $date2 = explode(" ", $ibq["expiredate"]); ?>
          <tr><td width="90">E-Day</td><td width="160"><font color="orange"><?=$date2[0]?></font></td></tr>
         </table>
	</div>
     <? } } ?>
      </div>
<br>
<!--- IP RANGE --->
<table>
 <tr>
  <th class="padLeft">Accounts on the IP-Range</th>
  <th>Bans on the IP-Range</th>
 </tr>
 <tr>
  <td class="padLeft" width="300">
   <?=$User["player"]?><img class="imgvalign" id="1" width="16" height="16" src="<?=OS_HOME?>img/expand.png" onclick="showhide('MACC'); changeImage(1);" alt="" />
   <div id="MACC" style="display:none;">
    <table>
     <tr>
      <th width="120">AccountName</th>
   <? if( $_SESSION["level"] >= "10" ) { ?>
      <th width="80">IP</td>
   <? } ?>
      <th width="80">Played on this Ip-Range</th>
     </tr>
   <? if( $nummac > 0 ) {
       foreach ( $macqu as $ACC ) { ?>
        <tr><td width="120"><?=$ACC["player"]?></td>
   <? if( $_SESSION["level"] >= "10" ) { ?>
        <td width="80"><?=$ACC["ip"]?></td>
   <? } ?>
        <td width="80"><?=$ACC["games"]?> <?if($ACC["games"] == 1 ) echo 'Time'; else echo 'Times'; ?></td></tr>
     </tr>
  <? }
    } else { ?>
     <tr>
      <td>No multiply Accounts</td>
   <? if( $_SESSION["level"] >= "10" ) { ?>
      <td></td>
   <? } ?>
      <td></td>
     </tr>
 <? } ?>
    </table>
   </div>
  </td>
  <td class="padLeft" width="300">
   <?=$User["player"]?><img class="imgvalign" id="2" width="16" height="16" src="<?=OS_HOME?>img/expand.png" onclick="showhide('BACC'); changeImage(2);" alt="" />
    <div id="BACC" style="display:none;">
     <table>
      <tr>
       <th width="120">AccountName</th>
	<? if( $_SESSION["level"] >= "10" ) { ?>
       <th width="80">IP</td>
        <? } ?>
       <th width="80">Banned on this Ip-Range</th>
      </tr>
<? if( $numbac > 0 ) {
    foreach ( $bacqu as $BCC ) { ?>
      <tr><td width="120"><?=$BCC["name"]?></td>
      <? if( $_SESSION["level"] >= "10" ) { ?>
       <td width="80"><?=$BCC["ip"]?></td>
      <? } ?>
       <td width="80"><?=$BCC["COUNT(*)"]?> <?if($BCC["COUNT(*)"] == 1 ) echo 'Time'; else echo 'Times'; ?></td></tr>
    <? }
      } else { ?>
      <tr>
       <td>No Bans on this IP-Range</td>
   <? if( $_SESSION["level"] >= "10" ) { ?>
       <td></td>
   <? } ?>
       <td></td>
      </tr>
<? } ?>
     </table>
    </div>
   </td>
  </tr>
 </table>
<br>
  <div class="padTop">
  <table class="Table500px">
      <tr class="row">
	  <th class="padLeft" width="140"><?=$lang["stats"] ?></th>
	  <th width="160"></th>
	  <th width="60"></th>
	  <th width="175"></th>
	  <th width="175"></th>
	  <th width="175"></th>
	</tr>
    <tr class="row">
	  <td class="padLeft" width="140"><b><?=$lang["score"]?>:</b></td>
	  <td width="160"><?=$User["score"]?></td>
	  <td class="padLeft" width="60"><b><?=$lang["win_percent"] ?>:</b></td>
	  <td width="160"><?=$User["winslosses"]?> %</td>
	  <td class="padLeft" width="140"><b><?=$lang["ck"] ?>:</b></td>
	  <td width="160"><?=$User["creeps"]?></td>
	</tr>
	
    <tr class="row">
	  <td class="padLeft" width="140"><b><?=$lang["kills"]?>:</b></td>
	  <td width="160"><?=$User["kills"]?></td>
	  <td class="padLeft" width="60"><b><?=$lang["assists"]?>:</b></td>
	  <td width="160"><?=$User["assists"]?></td>
	  <td class="padLeft" width="140"><b><?=$lang["cd"]?>:</b></td>
	  <td width="180"><?=$User["denies"]?></td>
	</tr>
	
    <tr class="row">
	  <td class="padLeft" width="140"><b><?=$lang["deaths"]?>:</b></td>
	  <td width="160"><?=$User["deaths"]?></td>
	  <td class="padLeft" width="90"><b><?=$lang["kd_ratio"]?>:</b></td>
	  <td width="160"><?=($User["kd"])?></td>
	  <td class="padLeft" width="140"><b><?=$lang["neutrals"]?>:</b></td>
	  <td width="160"><?=$User["neutrals"]?></td>
	</tr>
	
    <tr class="row">
	  <td class="padLeft" width="140"><b><?=$lang["games"]?>:</b></td>
	  <td width="160"><a href="<?=OS_HOME?>?games&amp;uid=<?=$User["id"]?>"><?=$User["games"]?></a></td>
	  <td class="padLeft" width="60"><b><?=$lang["wl"] ?>:</b></td>
	  <td width="160"><?=($User["wins"])?> / <?=($User["losses"])?></td>
	  <td class="padLeft" width="60"><b><?=$lang["towers"]?>:</b></td>
	  <td width="160"><?=($User["towers"])?></td>
	</tr>
	
    <tr class="row">
	  <td class="padLeft" width="140"><span <?=ShowToolTip($lang["kills_per_game"], OS_HOME.'img/winner.png', 130, 32, 32)?>><b><?=$lang["kpg"]?>:</b></span></td>
	  <td width="160"><?=$User["kpg"]?></td>
	  <td class="padLeft" width="60"><span <?=ShowToolTip($lang["deaths_per_game"], OS_HOME.'img/skull.png', 160, 32, 32)?>><b><?=$lang["dpg"]?>:</b></span></td>
	  <td width="160"><?=($User["dpg"])?></td>
	  <td class="padLeft" width="60"><b><?=$lang["rax"]?>:</b></td>
	  <td width="160"><?=($User["rax"])?></td>
	</tr>
	
    <tr class="row">
	  <td class="padLeft" width="140"><span <?=ShowToolTip($lang["assists_per_game"], OS_HOME.'img/winner.png', 180, 32, 32)?>><b><?=$lang["apg"]?>:</b></span></td>
	  <td width="160"><?=$User["apg"]?></td>
	  <td class="padLeft" width="60"><span <?=ShowToolTip($lang["creeps_per_game"], OS_HOME.'img/winner.png', 190, 32, 32)?>><b><?=$lang["ckpg"]?>:</b></span></td>
	  <td width="160"><?=($User["ckpg"])?></td>
	  <td class="padLeft" width="60"><span <?=ShowToolTip($lang["denies_per_game"], OS_HOME.'img/winner.png', 190, 32, 32)?>><b><?=$lang["cdpg"]?>:</b></span></td>
	  <td width="160"><?=($User["cdpg"])?></td>
	</tr>
	
    <tr class="row">
	  <td class="padLeft" width="140"><span <?=ShowToolTip($lang["left_info"], OS_HOME.'img/disc.png', 250, 32, 32)?>><b><?=$lang["left"]?>:</b></span></td>
	  <td width="160"><?=$User["leaver"]?> x</td>
          <td class="padLeft" width="60"><span <?=ShowToolTip('How many times a user disconnected', OS_HOME.'img/disc.png', 350, 32, 32)?>><b>Disconnects:</b></span></td>
          <td width="160"><?=($User["dc_count"])?> x</td>
          <td class="padLeft" width="60"><span <?=ShowToolTip($lang["stayratio"], OS_HOME.'img/winner.png', 120, 32, 32)?>><b><?=$lang["stay"]?>:</b></span></td>
          <td width="160"><?=($User["stayratio"])?> %</td>
        </tr>

    <tr>
          <td class="padLeft" width="60"><span <?=ShowToolTip($lang["longest_streak"], OS_HOME.'img/winner.png', 160, 32, 32)?>><b><?=$lang["streak"]?>:</b></span></td>
          <td width="160"><?=($User["maxstreak"])?></td>
          <td class="padLeft" width="60"><span <?=ShowToolTip($lang["zero_deaths"], OS_HOME.'img/winner.png', 250, 32, 32)?>><b>ZeroDeaths:</b></span></td>
          <td width="160"><?=($User["zerodeaths"])?> x</td>
          <td class="padLeft" width="60"><span <?=ShowToolTip('The total number a player was the best player', OS_HOME.'img/winner.png', 250, 32, 32)?>><b>Best Player:</b></span></td>
          <td width="160"><?=($User["best_player"])?> x</td>
        </tr>
	
  </table>
  </div>

  <div class="padTop"></div>
  <table class="Table500px">
    <tr class="scourgeRow">
	  <td width="190" class="padLeft"><b><?=$lang["time_played"] ?></b>:</td>
	  <td class="padLeft"><?=$TimePlayed["timeplayed"]?></td>
	</tr>
  </table>
 <div class="padTop"></div>
<?php
  include(OS_CURRENT_THEME_PATH.'/single_user_hero_stats.php');
?> 

  <div class="padTop"></div>
   <!-- FASTEST AND LONGEST GAME -->
<?php if (isset($FastestGame ) AND !empty($FastestGame) ) { ?> 
  <table class="Table500px">
    <tr>
	  <th class="padLeft" width="250"><?=$lang["fastest_game"]?></th>
	  <th><?=$lang["duration"]?></th>
	  <th><?=$lang["kills"]?></th>
	  <th><?=$lang["deaths"]?></th>
	  <th><?=$lang["assists"]?></th>
	</tr>
    <tr>
	  <td width="250" class="slot<?=$FastestGame["newcolour"]?> padLeft font12">
	      <a href="<?=OS_HOME?>?game=<?=$FastestGame["gameid"]?>"><?=$FastestGame["gamename"]?></a>
	  </td>
	  <td><?=$FastestGame["duration"]?></td>
	  <td><?=$FastestGame["kills"]?></td>
	  <td><?=$FastestGame["deaths"]?></td>
	  <td><?=$FastestGame["assists"]?></td>
	</tr>
	
   </table>
   
<?php } ?>
<?php if (isset($LongestGame ) AND !empty($LongestGame) ) { ?> 
  <table class="Table500px">
    <tr>
	  <th class="padLeft" width="250"><?=$lang["longest_game"]?></th>
	  <th><?=$lang["duration"]?></th>
	  <th><?=$lang["kills"]?></th>
	  <th><?=$lang["deaths"]?></th>
	  <th><?=$lang["assists"]?></th>
	</tr>
    <tr>
	  <td width="250" class="slot<?=$LongestGame["newcolour"]?> padLeft font12">
	      <a href="<?=OS_HOME?>?game=<?=$LongestGame["gameid"]?>"><?=$LongestGame["gamename"]?></a>
	  </td>
	  <td><?=$LongestGame["duration"]?></td>
	  <td><?=$LongestGame["kills"]?></td>
	  <td><?=$LongestGame["deaths"]?></td>
	  <td><?=$LongestGame["assists"]?></td>
	</tr>
	
   </table>
   
<?php } ?>
 
<?=os_display_custom_fields()?>
 
  <div class="padTop"></div>
  <div class="padTop"></div>
 
<table class="Table500px">
<tr>
  <td>
     <div class="padTop aligncenter" align="center">
       <h2><a name="game_history" href="<?=OS_HOME?>?games&amp;uid=<?=$User["id"]?>"><?=$lang["user_game_history"] ?></a></h2>
    </div>
  </td>
</tr>
</table>
  
   <table>
    <tr>
	 <th width="220" class="padLeft"><?=$lang["game"]?></th>
	 <?php if (isset($_GET["u"]) ) { ?>
	 <th width="40"><?=$lang["hero"]?></th>
	 <th width="90"><?=$lang["kda"]?></th>
	 <th width="90"><?=$lang["cdn"]?></th>
	 <?php } ?>
	 <th width="80"><?=$lang["duration"]?></th>
	 <th width="50"><?=$lang["type"]?></th>
	 <th width="140"><?=$lang["date"]?></th>
	 <?php if (!isset($_GET["u"]) ) { ?>
	 <th width="160"><?=$lang["map"]?></th>
	 <?php } ?>
	 <th width="160"><?=$lang["creator"]?></th>
   </tr>
  <?php
  
  foreach ($GamesData as $Games) {
  ?>
  <tr class="row GameHistoryRow">
	 <td width="220" class="padLeft overflow_hidden slot<?=$Games["newcolour"]?>">
	 <?=OS_WinLoseIcon( $Games["win"] )?>
	   <a href="<?=OS_HOME?>?game=<?=$Games["id"]?>"><span class="winner<?=$Games["winner"]?>"><?=$Games["gamename"]?></span></a>
	 </td>
	 <?php if (isset($_GET["u"]) ) { ?>
	 <td width="40" height="40"><img width="32" height="32" src="<?=OS_HOME?>img/heroes/<?=($Games["hero"])?>.gif" alt="Hero" /></td>
	 <td width="90">
	 	<span class="won"><?=($Games["kills"])?></span> / 
	    <span class="lost"><?=$Games["deaths"]?></span> / 
	    <span class="assists"><?=$Games["assists"]?></span>
	 </td>
	 <td width="90">
	 	<span class="won"><?=($Games["creepkills"])?></span> / 
	    <span class="lost"><?=$Games["creepdenies"]?></span> / 
	    <span class="assists"><?=$Games["neutrals"]?></span>
	 </td>
	 <?php } ?>
	 <td width="80"><?=secondsToTime($Games["duration"])?></td>
	 <td width="50"><?=$Games["type"]?></td>
	 <td width="140"><?=date($DateFormat, strtotime($Games["datetime"]))?></td>
	 <?php if (!isset($_GET["u"]) ) { ?>
	 <td width="160"><?=$Games["map"]?></td>
	 <?php } ?>
	 <td width="160"><?=$Games["ownername"]?></td>
   </tr>
  <?php
  }
  ?>
  </table> 
     </div>
    </div>
   </div>
  </div>
</div>
  
  <?php
   $SHOW_TOTALS = 1;
   include('inc/pagination.php');
   
  if ($ReportUserLink == 1) {
  ?>
  <div class="reportUser">
  <a href="<?=OS_HOME?>?ban_report&amp;user=<?=$User["player"]?>"><?=$lang["report_user"]?></a>
  </div>
  <div style="width:100%; margin-top:10px;">&nbsp;</div>
  <?php }
  
  }
 ?>
