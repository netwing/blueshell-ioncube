<?php
require_once("config.inc.php");
$blue->autentica_utente("contratti","W");
if (!array_key_exists("id",$_GET))
{
	header("Location:index.php");
	exit();
}
$contratto_id=$sql->pulisci($_GET['id']);
$select="SELECT contratto_tipo FROM ".$tabelle['contratti']." WHERE contratto_id='".$contratto_id."'";
$result=$sql->select_query($select);
$contratto_tipo=mysql_result($result,0,'contratto_tipo');
if ($contratto_tipo==4)
{
	// Recuperiamo le info sulla prenotazione
	$select="SELECT contratto_anagrafica1,contratto_anagrafica2,contratto_tipo,contratto_barca,contratto_posto_barca,contratto_periodo,contratto_data,contratto_inizio,contratto_fine,contratto_numero,contratto_gestione_tipo,contratto_gestione_percentuale,contratto_note,contratto_imponibile,contratto_totale,contratto_fatturato,contratto_fatturato_chiuso,contratto_sconto,contratto_ordine FROM ".$tabelle['contratti']." WHERE contratto_id='".$contratto_id."'";
	$result=$sql->select_query($select);
	$row=mysql_fetch_array($result);
	extract($row);
	// Inseriamo il contratto di affitto
	$insert="INSERT INTO ".$tabelle['contratti']." (contratto_anagrafica1,contratto_anagrafica2,contratto_tipo,contratto_barca,contratto_posto_barca,contratto_periodo,contratto_data,contratto_inizio,contratto_fine,contratto_numero,contratto_gestione_tipo,contratto_gestione_percentuale,contratto_note,contratto_imponibile,contratto_totale,contratto_fatturato,contratto_fatturato_chiuso,contratto_sconto,contratto_ordine)";
	$insert.="VALUES ('".$contratto_anagrafica1."','".$contratto_anagrafica2."','1','".$contratto_barca."','".$contratto_posto_barca."','".$contratto_periodo."','".$contratto_data."','".$contratto_inizio."','".$contratto_fine."','".$contratto_numero."','".$contratto_gestione_tipo."','".$contratto_gestione_percentuale."','".$contratto_note."','".$contratto_imponibile."','".$contratto_totale."','".$contratto_fatturato."','".$contratto_fatturato_chiuso."','".$contratto_sconto."','".$contratto_ordine."') ";
	$sql->insert_query($insert);
	$update="UPDATE ".$tabelle['contratti']." SET contratto_fatturato_chiuso='1' WHERE contratto_id='".$contratto_id."'";
	$sql->update_query($update);
	$nuovo_id=$sql->insert_last_id;
	// Trasferiamo le fatture dalla prenotazione all'affitto
	$update="UPDATE blue_fatture SET fattura_contratto_id='".$nuovo_id."' WHERE fattura_contratto_id='".$contratto_id."'";
	$sql->update_query($update);
	header("Location:riepilogo.php?id=".$nuovo_id);
	exit();
}
else
{
	header("Location:riepilogo.php?id".$contratto_id);
	exit();
}
?>