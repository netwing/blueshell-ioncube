<?php
require_once("config.inc.php");
// Inclusione del file di configurazione generale
$blue->autentica_utente("imbarcazioni","R");
// Raccolta delle imbarcazioni con scadenza imminente nei contratti in essere...
$select_polizze="SELECT barca_id,barca_nome,barca_proprietario,cliente_nominativo,barca_scadenza_polizza,contratto_tipo FROM ".$tabelle['barche'].",".$tabelle['clienti'].",".$tabelle['contratti']." WHERE barca_scadenza_polizza BETWEEN NOW()-INTERVAL 1 YEAR AND NOW()+INTERVAL 30 DAY AND cliente_id=barca_proprietario AND contratto_inizio<=NOW() AND contratto_fine>=NOW() AND barca_id=contratto_barca AND contratto_tipo!='4' GROUP BY barca_id ORDER BY barca_scadenza_polizza ASC";
$result_polizze=$sql->select_query($select_polizze);
// Carichiamo le polizze di assicurazione in scadenza
$polizze=array();
while($row_polizze=mysql_fetch_array($result_polizze))
{
	$data=$sql->data_ita($row_polizze['barca_scadenza_polizza']);
	$row_polizze['barca_scadenza_polizza']=$data[0];
	$polizze[]=$row_polizze;
}
// Eseguiamo lo stesso procedimento per le presenze
$select_polizze="SELECT barca_id,barca_nome,barca_proprietario,cliente_nominativo,barca_scadenza_polizza FROM ".$tabelle['barche'].",".$tabelle['clienti'].",".$tabelle['presenze']." WHERE barca_scadenza_polizza BETWEEN NOW()-INTERVAL 1 YEAR AND NOW()+INTERVAL 30 DAY AND cliente_id=barca_proprietario AND presenza_arrivo<=NOW() AND (presenza_partenza>=NOW() OR presenza_partenza='0000-00-00') AND barca_id=presenza_barca GROUP BY barca_id ORDER BY barca_scadenza_polizza ASC";
$result_polizze=$sql->select_query($select_polizze);
// Carichiamo le polizze di assicurazione in scadenza
//$polizze=array();
while($row_polizze=mysql_fetch_array($result_polizze))
{
	$data=$sql->data_ita($row_polizze['barca_scadenza_polizza']);
	$row_polizze['barca_scadenza_polizza']=$data[0];
	$polizze[]=$row_polizze;
}

require_once "views/vector/expiring_insurance.php";
