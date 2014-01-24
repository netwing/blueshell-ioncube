<?php
require_once("config.inc.php");
$blue->autentica_utente("anagrafica","R");
$iniziale="A";
if (array_key_exists("iniziale",$_GET))
{
	$_SESSION['elenco_clienti']['iniziale']=$_GET['iniziale'];
}
if (array_key_exists("elenco_clienti",$_SESSION) and array_key_exists("iniziale",$_SESSION['elenco_clienti']))
{
	$iniziale=$_SESSION['elenco_clienti']['iniziale'];
}
$paginazione=$sql->paginazione_menu($tabelle['clienti']," LEFT(cliente_nominativo,1)='".$iniziale."'");
$limit=$sql->paginazione_valuta();
$select_clienti="SELECT cliente_id,cliente_nominativo,cliente_cognome,cliente_nome,cliente_telefono1 FROM ".$tabelle['clienti']." WHERE LEFT(cliente_nominativo,1)='".$iniziale."' ORDER BY cliente_nominativo ASC, cliente_cognome ASC LIMIT ".$limit;
$result_clienti=$sql->select_query($select_clienti);


require_once "views/client/admin.php";

