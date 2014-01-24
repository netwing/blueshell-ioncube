<?php
require_once("config.inc.php");
$blue->autentica_utente("anagrafica","R");
$elenco_nazioni=$blue->elenco_nazioni();
if (!array_key_exists("id",$_GET))
{
	header("Location:index.php");
}
$select_cliente="SELECT * FROM ".$tabelle['clienti']." WHERE cliente_id='".$_GET['id']."'";
$result_cliente=$sql->select_query($select_cliente);
$row_cliente=mysql_fetch_array($result_cliente);
# Carichiamo i dati del cliente

$select_barca="SELECT barca_id,barca_nome, barca_lunghezza FROM ".$tabelle['barche']." WHERE barca_proprietario='".$_GET['id']."'";
$result_barca=$sql->select_query($select_barca);
# Carichiamo i dati sulle imbarcazioni

if (array_key_exists("delfat",$_GET))
{
	$delete="DELETE FROM ".$tabelle['fatture']." WHERE fattura_id='".$_GET['delfat']."'";
	$sql->delete_query($delete);
	$delete="DELETE FROM ".$tabelle['fatture_righe']." WHERE fattura_riga_fattura_id='".$_GET['id']."'";
	$sql->delete_query($delete);
}
# Se viene passato un parametro delfat, la fattura in questione viene cancellata

if (array_key_exists("delnota",$_GET))
{
	$delete="DELETE FROM ".$tabelle['clienti_note']." WHERE cliente_nota_id='".$_GET['delnota']."'";
	$sql->delete_query($delete);
}
// Se viene passato un parametro delnota, la nota in questione viene cancellata

$select_fatture="SELECT fattura_id,fattura_numero,fattura_data FROM ".$tabelle['fatture']." WHERE fattura_cliente_id='".$_GET['id']."' ORDER BY fattura_data ASC";
$result_fatture=$sql->select_query($select_fatture);
# Carichiamo le fatture emesse per il cliente

$select_note="SELECT cliente_nota_id,cliente_nota_data,cliente_nota_contenuto,cliente_nota_attiva FROM ".$tabelle['clienti_note']." WHERE cliente_nota_cliente_id='".$_GET['id']."'";
$result_note=$sql->select_query($select_note);
# Carichiamo le note inserite per quel cliente

require_once "views/client/view.php";