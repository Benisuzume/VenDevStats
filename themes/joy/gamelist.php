<?php
if (!isset($website) ) { header('HTTP/1.1 404 Not Found'); die; }

if ( file_exists("inc/geoip/geoip.inc") ) {
        include("inc/geoip/geoip.inc");
        $GeoIPDatabase = geoip_open("inc/geoip/GeoIP.dat", GEOIP_STANDARD);
        $GeoIP = 1;
}
?>
<div class="clr"></div>
 <div class="ct-wrapper">
  <div class="outer-wrapper">
   <div class="content section">
    <div class="widget Blog">
     <div class="blog-posts hfeed">
<? if( $DashboardOnHome == 1 ) { ?>
        <center>
        <table>
          <tr>
            <th width="200" colspan="3">Dashboard</th>
          </tr>
          <tr class="row">
            <td width="200" class="padLeft"><b>Unranked games:</b></td>
            <td> <?=number_format($TotalGamesForUpdate,0)?></td>
          </tr>
          <tr class="row">
            <td width="200" class="padLeft"><b>Ranked games:</b></td>
            <td><?=number_format($TotalRankedGames,0)?></td>
          </tr>
          <tr class="row">
            <td width="200" class="padLeft"><b>Ranked Players:</b></td>
            <td><?=number_format($TotalRankedUsers,0)?></td>
          </tr>
          <tr class="row">
            <td width="200" class="padLeft"><b>Total Bans:</b></td>
            <td><?=number_format($TotalBans,0)?></td>
          </tr>
          <tr class="row">
            <td width="200" class="padLeft"><b>Total Admins:</b></td>
            <td><?=number_format($TotalAdmins,0)?></td>
          </tr>
          <tr class="row">
            <td width="200" class="padLeft"><b>Total Members:</b></td>
            <td><?=number_format($TotalUsers,0)?></td>
          </tr>
          </tr>
          <tr class="row">
            <td width="200" class="padLeft"><b>Total Posts:</b></td>
            <td><?=number_format($TotalNews,0)?></td>
          </tr>
          <tr class="row">
            <td width="200" class="padLeft"><b>Total Comments:</b></td>
            <td><?=number_format($TotalComments,0)?></td>
          </tr>
          <tr class="row">
            <td width="200" class="padLeft"><b>Ban Reports:</b></td>
            <td><?=number_format($TotalBanReports,0)?></td>
          </tr>
          <tr class="row">
            <td width="200" class="padLeft"><b>Ban Appeals:</b></td>
            <td><?=number_format($TotalBanAppeals,0)?></td>
          </tr>
          <tr class="row">
            <td width="200" class="padLeft"><b>Guides:</b></td>
            <td><?=number_format($TotalGuides, 0)?></td>
          </tr>
        </table>
        </center>
    <? } ?>
<br>
  <h4><?=$lang["current_games"]?> <a class="menuButtons refresh" href="<?=OS_HOME?>"><?=$lang["refresh"]?></a></h4>
  
  <table class="table table-condensed table-bordered">
  <tr>
    <th class="padLeft" style="width: 800px"><?=$lang["game_name"]?></th>
	<th><?=$lang["slots"] ?></th>
  </tr>
  <?php
        $totalgames = 0;
        $totalplayers = 0;
  foreach ( $LiveGamesData as $LiveGames ) {
        $totalgames += $LiveGames["totalgames"];
        $totalplayers += $LiveGames["totalplayers"];
  if (!empty($LiveGames["gamename"]) ) {
  ?>
  <tr>
    <td class="padLeft">
	   <a href="javascript:;" onclick="showhide('<?=$LiveGames["botid"]?>')"><?=$LiveGames["gamename"]?></a>
	<div id="<?=$LiveGames["botid"]?>" style="display:none;">
	 <table>
	  <tr>
           <th>Player</th>
           <th width="20"><span <?=ShowToolTip("User Ranks", OS_HOME.'img/winner.png', 120, 32, 32)?>> <img src="<?=OS_HOME?>img/ranks/stats1.gif" width="20" /></span></center></th>
           <th width="20"><span <?=ShowToolTip("Current Streak", OS_HOME.'img/winner.png', 120, 32, 32)?>> <img src="<?=OS_HOME?>img/streak.gif" width="20" /></span></center></th>
           <th>Score</th>
           <th>Games</th>
           <th>Win %</th>
           <th>Ping</th>
           <th>Realm</th>
          </tr>
	<?php
         $k = 0;
	 //print_r($LiveGames["players"]);
	 for($i = 0; $i < count( $LiveGames["players"] ) - 2; $i+=3) {
	 	$username = $LiveGames["players"][$i];
		$realm = $LiveGames["players"][$i + 1];
		$ping = $LiveGames["players"][$i + 2];
		$k++;
		if ( $username == "" ) {
		?>
		<tr>
		  <td class="slot<?=$k?>"><?=$lang["empty"] ?></td>
		  <td></td>
		  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
		</tr>
		<?php
		} else {
/** STATS QUERY (maximal use one so we increase the query count only by 10 on a full game) **/
$sth = $db->prepare( "SELECT * FROM ".OSDB_STATS." WHERE player = '".$username."';" );
$result = $sth->execute();
if($sth->rowCount() >=1) {
while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
$user_id  = $row["id"];
$user_ip  = $row["ip"];
$user_score  = $row["score"];
$user_games  = $row["games"];
$user_banned  = $row["banned"];
$user_warn = $row["warn"];
$user_warn_expire  = $row["warn_expire"];
$user_admin  = $row["admin"];
$user_safelist  = $row["safelist"];
$user_streak  = $row["streak"];
$user_double_score  = $row["double_score"];
$user_wins  = $row["wins"];
$user_draw  = $row["draw"];
$user_avg  = $row["avg_score"];
}
} else {
$user_id = 0; $user_ip = 0; $user_score = 0; $user_games = 0; $user_banned = 0; $user_warn = 0; $user_warn_expire = 0; $user_admin = 0; $user_safelist = 0; $user_streak = 0; $user_double_score = 0; $user_wins = 0; $user_draw = 0; $user_avg = 0;
}
if( $user_games > 0 ) {
//Calc Win Perc
$user_winperc = round( ( ( ( $user_wins ) / ( $user_games - $user_draw ) ) * 100 ), 2);
} else { $user_winperc = 0; }
$user_letter   = geoip_country_code_by_addr($GeoIPDatabase, $user_ip);
$user_country  = geoip_country_name_by_addr($GeoIPDatabase, $user_ip);
if ($GeoIP == 1 AND empty($user_letter) ) {
        if( strlen($realm) <= 2) {
                $user_letter = "GAR";
                $user_country = "Garena";
        } else {
                if( strtolower($realm) == "europe.battle.net" ) {
                        $user_letter = "EU";
                        $user_country = "Europe";
                }
                else if( ( strtolower($realm) == "uswest.battle.net" ) OR ( strtolower($realm) == "useast.battle.net" ) ) {
                        $user_letter = "US";
                        $user_country = "USA";
                }
                else if( strtolower($realm) == "asia.battle.net" ) {
                        $user_letter = "CN";
                        $user_country = "Asia";
                } else {
                        $user_letter = "A1";
                        $user_country = "Unknown";
                }
        }
}

 ?>
                <tr>
                  <td class="slot<?=$k?>">
                        <?=OS_ShowUserFlag( $user_letter, $user_country )?>
                        <?=OS_TopUser($user_id, $username)?>
                        <?=OS_IsUserGameBanned( $user_banned, $lang["banned"] )?>
                        <?=OS_IsUserGameAdmin( $user_admin, $lang["admin"] )?>
		        <?=OS_IsUserGameRoot( $user_admin, "Root Admin" )?>
                        <?=OS_IsUserGameWarned( $user_warn,  $user_warn_expire, $lang["warned"] )?>
                        <?=OS_IsUserGameSafe( $user_safelist, $lang["safelist"] )?>
                        <?=OS_IsDoubleScoreUser( $user_double_score, 'Double Score' ) ?>
                  </td>
                  <td><center><?=COS_Rank( $user_avg, $user_games )?></center></td>
                  <td><center><?=$user_streak?></center></td>
                  <td><center><?=$user_score?></center></td>
                  <td><center><?=$user_games?></center></td>
                  <td><center><?=$user_winperc?> %</center></td>
                  <td><? if( !isset($ping) AND empty($ping) ) { ?>not pinged yet<? } else { ?><?=$ping?> <?=$lang["ms"] ?><? } ?></td>
                  <td><? if( !isset($realm) AND empty($realm) ) { ?>not spoofchecked yet<? } else { ?><?=$realm?> (<?=$user_country?>)<? } ?></td>
                </tr>
                <?php
                }
         }
?>
	 </table>
	</div>
	   
	</td>
	<td><?=$LiveGames["slotstaken"]?> / <?=$LiveGames["slotstotal"]?></td>
  </tr>
  <?php } 
  }
  ?>
  <tr>
   <th colspan="2" class="padLeft">
   <?
    echo "There currently ".$totalplayers." Players in ".$totalgames." games.";
   ?>
   </th>
  </tr>
  </table>
  
     </div>
    </div>
   </div>
  </div>
</div>

<?
if ( isset($GeoIP) AND $GeoIP == 1) geoip_close($GeoIPDatabase);
?>
