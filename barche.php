<?php
require_once("config.inc.php");
$blue->autentica_utente("imbarcazioni","R");
$iniziale="1";
if (array_key_exists("iniziale",$_GET))
{
	$_SESSION['elenco_barche']['iniziale']=$_GET['iniziale'];
}
if (array_key_exists("elenco_barche",$_SESSION) and array_key_exists("iniziale",$_SESSION['elenco_barche']))
{
	$iniziale=$_SESSION['elenco_barche']['iniziale'];
}
$paginazione=$sql->paginazione_menu($tabelle['barche']," LEFT(barca_nome,1)='".$iniziale."'");
$limit=$sql->paginazione_valuta();
$select_barche="SELECT barca_id,barca_nome,barca_lunghezza,cliente_id,cliente_nominativo FROM ".$tabelle['barche'].",".$tabelle['clienti']." WHERE barca_proprietario=cliente_id AND LEFT(barca_nome,1)='".$iniziale."' ORDER BY barca_nome ASC LIMIT ".$limit;
$result_barche=$sql->select_query($select_barche);

require_once "views/vector/index.php";
