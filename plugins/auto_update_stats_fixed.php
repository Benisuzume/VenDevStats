<?php
//Plugin: Auto update games (fixed)
//Author: Ivan
//This plugin automatically updates the statistics in a specific period

if (!isset($website) ) { header('HTTP/1.1 404 Not Found'); die; }

/*** Please do not use the plugin currently, since there some issues with the best_player add on. Im working on it. ***/
$PluginEnabled = '1';
//Enable edit plugin options
//$PluginOptions = '1';

$MaxUpdateGames = '5';
$UpdateTime = '5';
$DisplayStatsLog = '1';

define('OS3_MaxUpdateGames',  $MaxUpdateGames);
define('OS3_UpdateGamesTime', $UpdateTime);

define('OS3_DisplayStatsLog', $DisplayStatsLog);

  function OS_GetAllAdmins($t=1){
    global $db;
    //$db = new db("mysql:host=".OSDB_SERVER.";dbname=".OSDB_DATABASE."", OSDB_USERNAME, OSDB_PASSWORD); 
	if ($t==1) $sth = $db->prepare("SELECT * FROM ".OSDB_ADMINS." WHERE id>=1");
	if ($t==2) $sth = $db->prepare("SELECT * FROM ".OSDB_SAFELIST." WHERE id>=1");
	$result = $sth->execute();
	$data = array();
	while ($row = $sth->fetch(PDO::FETCH_ASSOC)) { $data[]= strtolower($row["name"]);  }
	return array($data);
  }

  function OS_TotalGamesForUpdate( $MapString = "dota" ) {
    global $db;
  	//$db = new db("mysql:host=".OSDB_SERVER.";dbname=".OSDB_DATABASE."", OSDB_USERNAME, OSDB_PASSWORD);
	//$dbh = OS_DBConnect();
	$sth = $db->prepare( "SELECT COUNT(*) FROM ".OSDB_GAMES." 
	WHERE LOWER(map) LIKE ('%".$MapString."%') AND stats = 0 AND duration>='".OS_MIN_GAME_DURATION."' ORDER BY `id`" );
	$result = $sth->execute();
    $r = $sth->fetch(PDO::FETCH_NUM);
    $TotalGamesForUpdate = $r[0];
	return $TotalGamesForUpdate;
  }

if ($PluginEnabled == 1) {

  if ( OS_is_admin() AND OS_PluginEdit() ) {
  
  	$UpdateMaxGames = OS3_MaxUpdateGames;
	$UpdateTimeMin = OS3_UpdateGamesTime;
	$DSL = OS3_DisplayStatsLog;
     if ( isset($_POST["OS_MaxUpdateGames"]) ) {
	 
     $UpdateMaxGames = safeEscape($_POST["OS_MaxUpdateGames"]);
	 $UpdateTimeMin = safeEscape($_POST["OS_UpdateGamesTime"]);
	 
	 $DSL = safeEscape(  $_POST["DisplayStatsLog"]);
	 
	 if ( $UpdateMaxGames>=1000 OR $UpdateMaxGames<=0 ) $UpdateMaxGames = 50;
	 if ( $UpdateTimeMin<=0 ) $UpdateTimeMin = 60;
	 
     write_value_of('$MaxUpdateGames', "$MaxUpdateGames", $UpdateMaxGames , $plugins_dir.basename(__FILE__, '') );
	 write_value_of('$UpdateTime', "$UpdateTime", $UpdateTimeMin , $plugins_dir.basename(__FILE__, '') );
	 write_value_of('$DisplayStatsLog', "$DisplayStatsLog", $DSL , $plugins_dir.basename(__FILE__, '') );
    }
	
    $sel = array();
    
	if ($DSL == 1) $sel[0] = 'selected = "selected"'; else $sel[0]='';
	if ($DSL == 0) $sel[1] = 'selected = "selected"'; else $sel[1]='';
	
	$Option = '
<form action="" method="post" >
  <div>Update max: <input size="2" type="text" value="'.$UpdateMaxGames.'" name="OS_MaxUpdateGames" /> games</div>
  <div>Every: <input size="2" type="text" value="'.$UpdateTimeMin.'" name="OS_UpdateGamesTime" /> min.</div>
  
  <div>Display stats log (for admins): 
  <select name="DisplayStatsLog">
    <option '.$sel[0].' value="1">Yes</option>
	<option '.$sel[1].' value="0">No</option>
  </select>
  </div>
  
  <input type="submit" value = "Save" class="menuButtons" />
  <a href="'.OS_HOME.'adm/?plugins" class="menuButtons">Cancel</a>
</form>';

  }

    if (!$_GET) AddEvent("os_after_content",  "OS_CheckGamesForUpdates"); 
	
	function OS_CheckGamesForUpdates() {
	
	  global $MinDuration;
	  
	  global $ScoreStart;
	  global $ScoreWins;
	  global $ScoreLosses;
	  global $LeftTimePenalty ;
	  global $ScoreDisc;
	  global $MapString;
	  $return = "";
	  
      $TotalGamesForUpdate = OS_TotalGamesForUpdate( $MapString );
	

	$LastUpdateTime = OS_get_custom_field( 0, "last_update_stats" );
	$CurrentTime = time();

	if ( ($LastUpdateTime+ (OS3_UpdateGamesTime*60) ) <= $CurrentTime ) $UpdateStats = 1; else $UpdateStats = 0;

	if ( (int) $TotalGamesForUpdate >=1 AND $UpdateStats == 1) {
	//GET ALL ADMINS (in array)
	
	$admins   = OS_GetAllAdmins(1);
	$safelist = OS_GetAllAdmins(2);

	
	global $db;
	$sth = $db->prepare( "SELECT id FROM ".OSDB_GAMES." 
	WHERE LOWER(map) LIKE LOWER('%".$MapString."%') AND stats = 0 AND duration>='".OS_MIN_GAME_DURATION."' LIMIT ".OS3_MaxUpdateGames." " );
	$result = $sth->execute();

	while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
	   $gid = $row["id"];
	   $sth2 = $db->prepare("SELECT winner, dp.gameid, gp.colour, newcolour, kills, deaths, assists, creepkills, creepdenies, neutralkills, towerkills, gold,  raxkills, courierkills, g.duration as duration, g.gamename, 
	   gp.name as name, 
	   gp.ip as ip, gp.spoofed, gp.spoofedrealm, gp.reserved, gp.left, gp.leftreason,
	   b.name as banname, b.expiredate, b.warn
	   FROM ".OSDB_DP." AS dp 
	   LEFT JOIN ".OSDB_GP." AS gp ON gp.gameid = dp.gameid and dp.colour = gp.colour 
	   LEFT JOIN ".OSDB_DG." AS dg ON dg.gameid = dp.gameid 
	   LEFT JOIN ".OSDB_GAMES." AS g ON g.id = dp.gameid 
	   LEFT JOIN ".OSDB_BANS." as b ON b.name=gp.name
	   WHERE dp.gameid='".$gid."'
	   GROUP by gp.name
	   ORDER BY newcolour");
	   $temp_points  = 0;
	   $result = $sth2->execute();
	   if ($sth2->rowCount() <=0)  { 
	   $update = $db->prepare("UPDATE ".OSDB_GAMES." SET stats = 1 WHERE id = '".$gid."'");
	   $result = $update->execute();
	   }
	   
	   while ($list = $sth2->fetch(PDO::FETCH_ASSOC)) {
	   	$kills=$list["kills"];
		$deaths=$list["deaths"];
		$assists=$list["assists"];
		$creepkills=$list["creepkills"];
		$creepdenies=$list["creepdenies"];
		$neutralkills=$list["neutralkills"];
		$towerkills=$list["towerkills"];
		$raxkills=$list["raxkills"];
		$courierkills=$list["courierkills"];
		$duration=$list["duration"];
		$name=OS_StrToUTF8(trim($list["name"]));
		$IPaddress = $list["ip"];
		$banname=$list["banname"];
		$win=$list["winner"];
		$newcolour=$list["newcolour"];
		
		$warn_expire = $list["expiredate"];
		$warn = $list["warn"];
                $gamename = $list["gamename"];

		
		//NEW FIELDS
		$spoofed = $list["spoofed"];
		$realm = $list["spoofedrealm"];
		$reserved = $list["reserved"];
		if ( empty($warn_expire ) ) $warn_expire  = '0000-00-00 00:00:00'; 
		
		if ( $warn>=1 ) $warn_qry = 'warn = '.$warn.', '; else $warn_qry = "";
				
		if ( in_array( strtolower($name), $admins ) )   $is_admin = 1; else $is_admin = 0;
		if ( in_array( strtolower($name), $safelist ) ) $is_safe = 1;  else $is_safe  = 0;
		
                if ( strtolower($banname)==strtolower($name) ) $BANNED = 1; else $BANNED = 0;
		
		if ($win==1 AND $newcolour<=5) {$winner = 1; $loser = 0;}
		if ($win==0) {$winner = 0; $loser = 0;}
		if ($win==2 AND $newcolour>5) {$winner = 1; $loser = 0;}
		if ($win==1 AND $newcolour>5) {$winner = 0; $loser = 1;}
		if ($win==2 AND $newcolour<=5) {$winner = 0; $loser = 1;}
		
		if ($winner == 1) $score = $ScoreStart + $ScoreWins;
		if ($winner == 0) $score = $ScoreStart - $ScoreLosses;
		if ($win==0) { $score = $ScoreStart; $leaver = 0; }
		
                if ( !isset($BestPlayer)  )     $BestPlayer = ($list["name"]);

                $spoints = ($list["kills"] -  $list["deaths"]) + ($list["assists"]*0.3);
                if ( $spoints > $temp_points ) {
                $BestPlayer = ($list["name"]);
                $temp_points = $spoints;
                }
		
		global $MinDuration; 
		if( !isset($list["leftreason"]) AND empty($list["leftreason"]) ) $list["leftreason"] = "No entry!";
		if ( ( $list["left"] <= ($list["duration"] - $MinDuration) ) AND $list["leftreason"] == "has left the game voluntarily" ) {
		   $leaver = 1; $score = "";
		} else $leaver = 0;
		
		if ($win==0) $draw = 1; else $draw = 0;
		
		if (!empty($name) AND $duration >= OS_MIN_GAME_DURATION) {
		
		//LEAVER
		if ( ( $list["left"] <= ($list["duration"] - $LeftTimePenalty) ) AND $list["leftreason"] == "has left the game voluntarily" ) {
		$score = $ScoreStart - $ScoreDisc; $winner = 0; $loser = 0;
		}
                //DISC
                $splitreason = explode( " ", $list["leftreason"] );
                if( $splitreason[1] == "lost" ) $dc = 1; else $dc = 0;

/** CUSTOM AUTOBAN PLUGIN **/
                //preperation
                $games = 1;
                $dc_count = 0;
                $leave_count = 0;
                //check the player
                $GetUserInfo = $db->prepare("SELECT * FROM ".OSDB_STATS." WHERE player = '".$name."'");
                $result = $GetUserInfo->execute();
                while ($list = $GetUserInfo->fetch(PDO::FETCH_ASSOC)) {
                        $games=$list["games"];
                        $dc_count=$list["dc_count"];
                        $leave_count=$list["leaver"];
			$alreadybanned=$list["banned"];
                }
                //calculations
                //Current Leave
                $games = $games+1;
                if( $leaver == 1 ) $leave_count = $leave_count+1;
                if( $dc == 1 ) $dc_count = $dc_count+1;
                $leaveratio = round( (($leave_count/$games)*100), 2 );
                $dcratio = round( (($dc_count/$games)*100), 2 );
		$lname = strtolower( $name );
                        //Check players with lower games than 5 for a high amount of leaving (over or 3 out of 5 games is to much)
                        if( $games <= 5 AND $leave_count >= 3  AND $is_admin == "0" AND $is_safe == "0" AND $alreadybanned == "0" AND $BANNED == 0 ) {
                                $reason = "AUTOBAN: Player left ".$leave_count." out of ".$games." games.";
                                $db->exec( "INSERT INTO ".OSDB_BANS." (botid,server,name,ip,gamename,date,admin,reason) VALUES ('1', '$realm', '$lname', '$IPaddress', '$gamename', CURRENT_TIMESTAMP(), 'Grief-Ban', '$reason')" );
                        //Check players with lower games than 10 for a high amount of leaving (over or 6 out of 10 games is to much)
                        }
			if( $games <= 10 AND $leave_count >= 6  AND $is_admin == "0" AND $is_safe == "0" AND $alreadybanned == "0" AND $BANNED == 0 ) {
                                $reason = "AUTOBAN: Player left ".$leave_count." out of ".$games." games.";
                                $db->exec( "INSERT INTO ".OSDB_BANS." (botid,server,name,ip,gamename,date,admin,reason) VALUES ('1', '$realm', '$lname', '$IPaddress', '$gamename', CURRENT_TIMESTAMP(), 'Grief-Ban', '$reason')" );
                        }
                        //Check players with more than 10 games, only 10% is a accepted amount of leaving
                        if( $games > 15 AND ( $leaveratio > 10 ) AND $is_admin == "0" AND $is_safe == "0" AND $alreadybanned == "0" AND $BANNED == 0 ) {
                                $reason = "AUTOBAN: Player left has a leaving ratio of ".$leaveratio."% out of ".$games." games.";
                                $db->exec( "INSERT INTO ".OSDB_BANS." (botid,server,name,ip,gamename,date,admin,reason) VALUES ('1', '$realm', '$lname', '$IPaddress', '$gamename', CURRENT_TIMESTAMP(), 'Grief-Ban', '$reason')" );
                        }
                        //Now check for a high amount of disconnects, they could be done on purpose!
                        if( $dcratio > 20 AND $games > 20 AND $is_admin == "0" AND $is_safe == "0" AND $alreadybanned == "0" AND $BANNED == 0 ) {
                                $reason = "AUTOBAN: Player has a disconnect ratio of ".$dcratio."% out of ".$games." games.";
                                $db->exec( "INSERT INTO ".OSDB_BANS." (botid,server,name,ip,gamename,date,admin,reason) VALUES ('1', '$realm', '$lname', '$IPaddress', '$gamename', CURRENT_TIMESTAMP(), 'Grief-Ban', '$reason')" );
                        }

		
		$result2 = $db->prepare("SELECT player, streak, maxstreak, losingstreak, maxlosingstreak, `score`, double_score FROM ".OSDB_STATS." WHERE LOWER(player) = ?");
		$result2->bindValue(1, strtolower( trim($name) ), PDO::PARAM_STR);
		$result = $result2->execute();
		if ($result2->rowCount() >=1) {
        $stats = $result2->fetch(PDO::FETCH_ASSOC);
		$streak = $stats["streak"];
		$maxstreak = $stats["maxstreak"];
		$losingstreak = $stats["losingstreak"];
		$maxlosingstreak = $stats["maxlosingstreak"];
                $is_double = $stats["double_score"];
		$CurrentScore = $stats["score"];
		} else {
		  $streak = 0; $maxstreak = 0; $losingstreak = 0; $maxlosingstreak = 0; $is_double = 0; $CurrentScore = $ScoreStart;
		}
		
		//WIN STREAK
		//increase maxstreak until lose.
		if ($winner == 1) {
		$streak = $streak+1; 
		if ( $streak > $maxstreak ) $maxstreak = $maxstreak+1;
		} 
		if ($winner == 0) $streak = 0;
		//if player lose, reset streak.
		
		//LOSING STREAK
		//increase maxstreak until win.
		if ($winner == 0) {
		$losingstreak = $losingstreak+1; 
		if ( $losingstreak > $maxlosingstreak ) $maxlosingstreak = $maxlosingstreak+1;
		} 
		if ($winner == 1) $losingstreak = 0;
		//if player win, reset streak.
		
		if ( $deaths == 0 AND $draw!=1 ) $zerodeaths = 1; else $zerodeaths = 0;
		
		//Create a new player...

		  if ( $result2->rowCount() <=0) {
		    if( $is_double == 1 ) $score = $score*2;
          $sql3 = "INSERT INTO ".OSDB_STATS."(player, player_lower, score, games, wins, losses, draw, kills, deaths, assists, creeps, denies, neutrals, towers, rax, banned, ip, warn_expire, warn, admin, safelist, realm, reserved, leaver, streak, maxstreak, losingstreak, maxlosingstreak, zerodeaths, dc_count ) 
		  VALUES('$name', '".strtolower( trim($name))."', '$score','1',$winner,$loser,$draw,$kills,$deaths,$assists,$creepkills,$creepdenies,$neutralkills, $towerkills, $raxkills, $BANNED, '$IPaddress', '$warn_expire', '$warn', '$is_admin', '$is_safe', '$realm', '$reserved', '$leaver', '$streak', '$maxstreak', '$losingstreak', '$maxlosingstreak', '$zerodeaths', '$dc')";
          } else {
		  //...or update player data
		  if ($winner == 1) $score = "score = score + $ScoreWins,";
                  if ($winner == 1 AND $is_double == 1 ) $score = "score = score + ".($ScoreWins*2).",";
		  if ($winner == 0) $score = "score = score - $ScoreLosses,";
		  if ($win==0) { $score = ""; $leaver = 0; }
		  
		  //LEAVER
		  if ( ( $list["left"] <= ($list["duration"] - $LeftTimePenalty) ) AND $list["leftreason"] == "has left the game voluntarily"  AND $win!=0 ) {
		  $score = "score = score - $ScoreDisc,";
		  $winner = 0;
		  $loser = 0;
		  }
		  
		  $sql3 = "UPDATE ".OSDB_STATS." SET 
		  $score
		  player = '$name',
		  player_lower = '".strtolower( trim($name))."',
		  games = games+1, 
		  wins = wins +$winner,
		  losses = losses+$loser,
		  draw = draw + $draw,
		  kills = kills + $kills,
		  deaths = deaths + $deaths,
		  assists = assists + $assists,
		  creeps = creeps + $creepkills,
		  denies = denies + $creepdenies,
		  neutrals = neutrals + $neutralkills,
		  towers = towers + $towerkills,
		  rax = rax + $raxkills,
          banned = $BANNED,
		  ip = '$IPaddress',
		  warn_expire = '$warn_expire',
		  $warn_qry
		  admin = '$is_admin',
		  safelist = '$is_safe',
		  realm = '$realm',
		  reserved = reserved + $reserved,
		  leaver = leaver + $leaver,
		  streak = '$streak',
		  maxstreak = '$maxstreak',
		  losingstreak = '$losingstreak',
		  maxlosingstreak = '$maxlosingstreak',
		  zerodeaths = zerodeaths+$zerodeaths,
                  dc_count = dc_count + $dc
		  WHERE LOWER(player) = LOWER('$name');";
		   }
		  $result3 = $db->prepare($sql3);
		  $result = $result3->execute(); 
		
	     $update = $db->prepare("UPDATE ".OSDB_GAMES." SET stats = 1 WHERE id = '".$gid."'");
		 $result = $update->execute(); 
		 OS_add_custom_field(0, "last_update_stats" ,  time() );
		}
	          if ($temp_points>=1) {
		        $updateBP = $db->prepare("UPDATE ".OSDB_STATS." SET best_player = best_player+1 WHERE LOWER(player) = LOWER('".$BestPlayer."') ;");
			$result = $updateBP->execute();
	          }
		$return.="\nGame ($gid) updated!  BEST PLAYER: ".$BestPlayer.".";
		unset( $BestPlayer );
		
	   }
	   
	}
	
  }

	  $TotalGamesForUpdate = OS_TotalGamesForUpdate( $MapString );
	  $LastUpdateTime = OS_get_custom_field( 0, "last_update_stats" );


  if ( OS_is_admin() AND OS3_DisplayStatsLog == 1 AND !$_GET ) { 
	?>
<div class="clr"></div>
 <div class="ct-wrapper">
  <div class="outer-wrapper">
   <div class="content section">
    <div class="widget Blog">
     <div class="blog-posts hfeed padLeft padTop padBottom">
	    <h2>Autoupdate stats log</h2>
		
	    <div><b>Remaining games to update:</b> <?=$TotalGamesForUpdate?></div>
		<?php if ($TotalGamesForUpdate>=1) { ?>
		<div><b>Updating max:</b> <?=OS3_MaxUpdateGames?> games</div>
		<?php } else { ?>
		<div>All statistics are updated successfully</div>
		<?php } ?>
		<?php 
		$NextUpdateTime = $LastUpdateTime+OS3_UpdateGamesTime*60;
		if (date("Y", $LastUpdateTime)>=2000) $LastUpdate = date("d.m.Y, H:i:s", $LastUpdateTime); else $LastUpdate = 'n/a';
		if (date("Y", $NextUpdateTime)>=2000) $NextUpdate = date("d.m.Y, H:i:s", $NextUpdateTime); else $NextUpdate = 'n/a';
		?>
		<div><b>Last update:</b> <?=$LastUpdate?></div>
		<div><b>Next update:</b> <?=$NextUpdate?></div>
	 </div>
    </div>
   </div>
  </div>
</div>
	<?php
  }

}
  
}

?>
