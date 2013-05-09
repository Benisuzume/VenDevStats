<?php
if (!isset($website) ) { header('HTTP/1.1 404 Not Found'); die; }
if (!isset($_SESSION["level"]) AND empty($_SESSION["level"]) ) $_SESSION["level"] = 0;
//image change add on
?>
<script language="javascript">
function changeImage($iid) {
 if (document.getElementById($iid).src == "<?=OS_HOME?>img/-.png") {
  document.getElementById($iid).src = "<?=OS_HOME?>img/+.png";
 } else {
  document.getElementById($iid).src = "<?=OS_HOME?>img/-.png";
 }
}
</script>
<? foreach ( $UserData as $User ) {
  ?>
  <div align="center">
  
  <h1>
    <?php if (isset($User["letter"]) ) { ?>
    <img <?=ShowToolTip($User["country"], $website.'img/flags/'.($User["letter"]).'.gif', 130, 21, 15)?> class="imgvalign" width="21" height="15" src="<?=$website?>img/flags/<?=$User["letter"]?>.gif" alt="" />
    <?php } ?>
    <?=$User["player"]?><font color="blue">@<?=$User["realm"]?></font>   
	<?php if ( isset( $User["banname"] ) AND !empty( $User["banname"] ) ) { ?> - <span class="banned"><?=$lang["banned"]?></span><?php } ?>
  </h1>
<? if ( $_SESSION["level"]>=10 ) { ?>
	<h4> IP: <?=$User["ip"]?> </h4>
<? }
if ( OS_is_banned_player( $User["banname"] ) ) {
?>
   <h3 class="title">Banned<img class="imgvalign" id="3" width="16" height="16" src="<?=OS_HOME?>img/+.png" onclick="showhide('BANS'); changeImage(3);" alt="" /></h3>
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
	   $bqgn = explode(" ", $bq["gamename"]); ?>
          <tr><td width="90">GameNumber</td><td width="160"><font color="teal"><?=$bqgn[2]?></font></td></tr>
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
   <?=$User["player"]?><img class="imgvalign" id="1" width="16" height="16" src="<?=OS_HOME?>img/+.png" onclick="showhide('MACC'); changeImage(1);" alt="" />
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
   <?=$User["player"]?><img class="imgvalign" id="2" width="16" height="16" src="<?=OS_HOME?>img/+.png" onclick="showhide('BACC'); changeImage(2);" alt="" />
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
	  <th class="padLeft" width="120"><?=$lang["stats"] ?></th>
	  <th width="160"></th>
	  <th width="90"></th>
	  <th width="175"></th>
	</tr>
    <tr class="row">
	  <td class="padLeft" width="120"><b><?=$lang["score"]?>:</b></td>
	  <td width="160"><?=$User["score"]?></td>
	  <td width="90"><b><?=$lang["win_percent"] ?>:</b></td>
	  <td width="160"><?=$User["winslosses"]?> %</td>
	</tr>
	
    <tr class="row">
	  <td class="padLeft" width="120"><b><?=$lang["kills"]?>:</b></td>
	  <td width="160"><?=$User["kills"]?></td>
	  <td width="90"><b><?=$lang["assists"]?>:</b></td>
	  <td width="160"><?=$User["assists"]?></td>
	</tr>
	
    <tr class="row">
	  <td class="padLeft" width="120"><b><?=$lang["deaths"]?>:</b></td>
	  <td width="160"><?=$User["deaths"]?></td>
	  <td width="90"><b><?=$lang["kd_ratio"]?>:</b></td>
	  <td width="160"><?=($User["kd"])?></td>
	</tr>
	
    <tr class="row">
	  <td class="padLeft" width="120"><b><?=$lang["games"]?>:</b></td>
	  <td width="160"><a href="<?=$website?>?games&amp;uid=<?=$User["id"]?>"><?=$User["games"]?></a></td>
	  <td width="90"><b><?=$lang["wl"] ?>:</b></td>
	  <td width="160"><?=($User["wins"])?> / <?=($User["losses"])?></td>
	</tr>
	
    <tr class="row">
	  <td class="padLeft" width="120"><b><?=$lang["ck"] ?>:</b></td>
	  <td width="160"><?=$User["creeps"]?></td>
	  <td width="90"><b><?=$lang["towers"]?>:</b></td>
	  <td width="160"><?=($User["towers"])?></td>
	</tr>
	
    <tr class="row">
	  <td class="padLeft" width="120"><b><?=$lang["cd"]?>:</b></td>
	  <td width="160"><?=$User["denies"]?></td>
	  <td width="90"><b><?=$lang["rax"]?>:</b></td>
	  <td width="160"><?=($User["rax"])?></td>
	</tr>
	
    <tr class="row">
	  <td class="padLeft" width="120"><b><?=$lang["kpm"]?>:</b></td>
	  <td width="160"><?=$User["kpm"]?></td>
	  <td width="90"><b><?=$lang["dpm"]?>:</b></td>
	  <td width="160"><?=($User["dpm"])?></td>
	</tr>
	
    <tr class="row">
	  <td class="padLeft" width="120"><b><?=$lang["neutrals"]?>:</b></td>
	  <td width="160"><?=$User["neutrals"]?></td>
	  <td width="90"></td>
	  <td width="160"></td>
	</tr>
	
	
  </table>
  </div>
  <div class="padTop"></div>
  <table class="Table500px">
    <tr class="scourgeRow">
	  <td class="padLeft"><?=$lang["time_played"] ?>:</td>
	  <td><?=$TimePlayed["timeplayed"]?></td>
	</tr>
  </table>
 <div class="padTop"></div>
<?php
  include('themes/'.$DefaultStyle.'/single_user_hero_stats.php');
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
	      <a href="<?=$website?>?game=<?=$FastestGame["gameid"]?>"><?=$FastestGame["gamename"]?></a>
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
	      <a href="<?=$website?>?game=<?=$LongestGame["gameid"]?>"><?=$LongestGame["gamename"]?></a>
	  </td>
	  <td><?=$LongestGame["duration"]?></td>
	  <td><?=$LongestGame["kills"]?></td>
	  <td><?=$LongestGame["deaths"]?></td>
	  <td><?=$LongestGame["assists"]?></td>
	</tr>
	
   </table>
   
<?php } ?>
  
  <div class="padTop"></div>
  <div class="padTop"></div>
  
<?=os_display_custom_fields()?>

<table class="Table500px">
<tr>
  <td>
     <div class="padTop aligncenter" align="center">
       <h2><a name="game_history" href="<?=$website?>?games&amp;uid=<?=$User["id"]?>"><?=$lang["user_game_history"] ?></a></h2>
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
 	 <?php if ($Games["winner"] == 1) { ?>
 	 <img src="<?=$website?>img/winner.png" alt="*" width="24" height="24" class="imgvalign" />
 	 <?php } ?>
 	 <?php if ($Games["winner"] == 2) { ?>
 	 <img src="<?=$website?>img/loser.png"  alt="*" width="24" height="24" class="imgvalign" />
 	 <?php } ?>
 	 <?php if ($Games["winner"] == 0) { ?>
 	 <img src="<?=$website?>img/draw.png"   alt="*" width="24" height="24" class="imgvalign" />
 	 <?php } ?>
	 
	   <a href="<?=$website?>?game=<?=$Games["id"]?>"><span class="winner<?=$Games["winner"]?>"><?=$Games["gamename"]?></span></a>
	 </td>
	 <?php if (isset($_GET["u"]) ) { ?>
	 <td width="40" height="40"><img width="32" height="32" src="<?=$website?>img/heroes/<?=($Games["hero"])?>.gif" alt="Hero" /></td>
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
  <?php
   $SHOW_TOTALS = 1;
   include('inc/pagination.php');
  }
 ?>
