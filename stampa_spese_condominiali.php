<?php
require_once("config.inc.php");
$blue->autentica_utente("documenti","R");
$select="SELECT DISTINCT(listino_posto_barca_anno) AS anno FROM ".$tabelle['listini_posti_barca']." ORDER BY listino_posto_barca_anno ASC";
$result=$sql->select_query($select);

$scadenza = strftime("%Y-%m-%d", strtotime("next month"));

require_once "views/contract/service_fees.php";
