<?php
require_once("config.inc.php");
$blue->autentica_utente("imbarcazioni","W");
if (!array_key_exists("id",$_GET)) {
	header("Location:barche.php");
	exit();	
}
$get_id=intval($_GET['id']);
// Definiamo l'id della barca passato via GET
if (count($_POST) > 0) {
	if (array_key_exists("cliente",$_POST)) {
		$data = $_POST['trasferimento_data'];
		$insert="INSERT INTO ".$tabelle['barche_trasferimenti']." (barca_trasferimento_barca,barca_trasferimento_da,barca_trasferimento_a,barca_trasferimento_data) VALUES ('".$get_id."','".$_POST['cliente_id']."','".$_POST['cliente']."','".$data."')";
		$sql->insert_query($insert);
		$update="UPDATE ".$tabelle['barche']." SET barca_proprietario='".$_POST['cliente']."' WHERE barca_id='".$get_id."'";
		$sql->update_query($update);
	}
}
// Questo se viene passato il form
$elenco_clienti=$blue->elenco_clienti();
// Carichiamo l'elenco dei clienti
$select_nome="SELECT barca_nome, barca_lunghezza, cliente_id, cliente_nominativo FROM ".$tabelle['barche'].",".$tabelle['clienti']." WHERE barca_id='".$get_id."' AND cliente_id=barca_proprietario";
$result=$sql->select_query($select_nome);
$barca_nome=mysql_result($result,0,'barca_nome');
$barca_lunghezza=mysql_result($result,0,'barca_lunghezza');
$proprietario_nome=mysql_result($result,0,'cliente_nominativo');
$cliente_id=mysql_result($result,0,'cliente_id');
// Query per recuperare il nome della barca
$select="SELECT * FROM ".$tabelle['barche_trasferimenti']." WHERE barca_trasferimento_barca='".$get_id."' ORDER BY barca_trasferimento_data DESC";
$result=$sql->select_query($select);
$elenco_trasferimenti=array();
while ($row=mysql_fetch_array($result))
{
	$elenco_trasferimenti[]=$row;
}
// Query per recuperare le informazioni sui trasferimenti della barca.

require_once "views/vector/transfer.php";
