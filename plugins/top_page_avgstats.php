<?php
//Plugin: Top Page AVG Stats
//Author: Grief-Code
//This Plugin does show avg stats of C/D/N K/D/A T/R of dotastats

if (!isset($website) ) { header('HTTP/1.1 404 Not Found'); die; }

$PluginEnabled = '1';
  
    global $TopData;
    global $DecimalPoint;

	//Top page
	if ( !empty($TopData) ) {
	  if( !isset( $DecimalPoint ) AND empty( $DecimalPoint ) ) $DecimalPoint = ",";
	  for ($c=0; $c<count($TopData); $c++ ) {
	  $TopData[$c]["kills"]  = str_replace( ".", $DecimalPoint, round( ( str_replace($DecimalPoint, "", $TopData[$c]["kills"]) / $TopData[$c]["games"] ), 2) );
	  $TopData[$c]["deaths"] = str_replace( ".", $DecimalPoint, round( ( str_replace($DecimalPoint, "", $TopData[$c]["deaths"]) / $TopData[$c]["games"] ), 2) );
	  $TopData[$c]["assists"]= str_replace( ".", $DecimalPoint, round( ( str_replace($DecimalPoint, "", $TopData[$c]["assists"]) / $TopData[$c]["games"] ), 2) );
	  $TopData[$c]["creeps"] = str_replace( ".", $DecimalPoint, round( ( str_replace($DecimalPoint, "", $TopData[$c]["creeps"]) / $TopData[$c]["games"] ), 2) );
	  $TopData[$c]["denies"] = str_replace( ".", $DecimalPoint, round( ( str_replace($DecimalPoint, "", $TopData[$c]["denies"]) / $TopData[$c]["games"] ), 2) );
          $TopData[$c]["neutrals"] = str_replace( ".", $DecimalPoint, round( ( str_replace($DecimalPoint, "", $TopData[$c]["neutrals"]) / $TopData[$c]["games"] ), 2) );
          $TopData[$c]["towers"] = str_replace( ".", $DecimalPoint, round( ( str_replace($DecimalPoint, "", $TopData[$c]["towers"]) / $TopData[$c]["games"] ), 2) );
          $TopData[$c]["rax"] = str_replace( ".", $DecimalPoint, round( ( str_replace($DecimalPoint, "", $TopData[$c]["rax"]) / $TopData[$c]["games"] ), 2) );

	  }
	   return array($TopData);
	}
?>
