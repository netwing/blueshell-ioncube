<?php
require_once("config.inc.php");
$blue->autentica_utente("imbarcazioni","R");
$elenco_nazioni=$blue->elenco_nazioni();
$elenco_tipologie=$blue->elenco_tipologie();
$elenco_costruttori=$blue->elenco_costruttori();
$elenco_assicurazioni=$blue->elenco_assicurazioni();
if (!array_key_exists("id",$_GET)) {
	header("Location:index.php");
	exit;
}
$select_barca="SELECT * FROM ".$tabelle['barche']." WHERE barca_id='".$_GET['id']."'";
$result_barca=$sql->select_query($select_barca);
$row_barca=mysql_fetch_array($result_barca);

$select_cliente="SELECT cliente_nominativo FROM ".$tabelle['clienti']." WHERE cliente_id='".$row_barca['barca_proprietario']."'";
$result_cliente=$sql->select_query($select_cliente);
$row_cliente=mysql_fetch_array($result_cliente);

require_once "views/vector/view.php";
