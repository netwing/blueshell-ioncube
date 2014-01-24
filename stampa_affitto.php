<?php
require_once("config.inc.php");
$blue->autentica_utente("documenti","R");
$elenco_nazioni=$blue->elenco_nazioni();
$elenco_tipologie=$blue->elenco_tipologie();
$elenco_assicurazioni=$blue->elenco_assicurazioni();
$select_prezzo="";
$iva=number_format(($_SESSION['riepilogo']['contratto']['contratto_totale']-$_SESSION['riepilogo']['contratto']['contratto_imponibile']),2,',','');
$prezzo=$sql->decimale_ita($_SESSION['riepilogo']['contratto']['contratto_imponibile']);
$totale=$sql->decimale_ita($_SESSION['riepilogo']['contratto']['contratto_totale']);
$sconto=$_SESSION['riepilogo']['contratto']['contratto_sconto'];

$dal = Yii::app()->format->formatDate($_SESSION['riepilogo']['contratto']['contratto_inizio']);
$al = Yii::app()->format->formatDate($_SESSION['riepilogo']['contratto']['contratto_fine']);

$datetime_dal = new DateTime($_SESSION['riepilogo']['contratto']['contratto_inizio']);
$datetime_al = new DateTime($_SESSION['riepilogo']['contratto']['contratto_fine']);
$durata = $datetime_dal->diff($datetime_al)->format("%a");
$data=Yii::app()->format->formatDate($_SESSION['riepilogo']['contratto']['contratto_data']);
if ($sconto>0) {
	$totale=$totale." con uno sconto del ".$sconto."% pari a Euro ".number_format(($totale-($totale/100*$sconto)),2,".","");
	//$prezzo=number_format(($prezzo-($prezzo/100*$sconto)),2,".","");
}

require_once "views/contract/print_rent.php";
