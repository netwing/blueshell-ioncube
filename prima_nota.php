<?php
require_once("config.inc.php");
$blue->autentica_utente("fatture","R");
// $elenco_clienti=$blue->elenco_clienti();
$pn_anno=date("Y",time());
$pn_mese=date("m",time());

// Elminare un record di prima nota
if (array_key_exists('delete', $_GET)) {
    
    $id = intval($_GET['delete']);
    $delete = "DELETE FROM " . $tabelle['prima_nota'] . " WHERE prima_nota_id='" . $id . "'";
    $result = $sql->delete_query($delete);
    header("Location: prima_nota.php");
    exit();
}

$select_anni="SELECT LEFT(prima_nota_data,4) AS anno FROM ".$tabelle['prima_nota']." WHERE LEFT(prima_nota_data,4)<>'0000' GROUP BY LEFT(prima_nota_data,4)";
$result_anni=$sql->select_query($select_anni);
$anni = array();
while ($row_anni=mysql_fetch_array($result_anni)) {
    $anni[] = "<li role=\"presentation\"><a href=\"prima_nota.php?anno=".$row_anni['anno']."\">".$row_anni['anno']."</a></li>";
}

$elenco_mesi=array("01"=>"Gen","02"=>"Feb","03"=>"Mar","04"=>"Apr","05"=>"Mag","06"=>"Giu","07"=>"Lug","08"=>"Ago","09"=>"Set","10"=>"Ott","11"=>"Nov","12"=>"Dec");
$mesi = array();
foreach ($elenco_mesi as $k=>$v) {
	$mesi[] = "<li role=\"presentation\"><a href=\"prima_nota.php?mese=".$k."\">".$v."</a></li>";
}

if (array_key_exists("anno",$_GET))
{
	$_SESSION['gestione_prima_nota']['fattura_anno']=$_GET['anno'];
}
if (array_key_exists("gestione_prima_nota",$_SESSION) and array_key_exists("fattura_anno",$_SESSION['gestione_prima_nota']))
{
	$pn_anno=$_SESSION['gestione_prima_nota']['fattura_anno'];
}
if (array_key_exists("mese",$_GET))
{
	$_SESSION['gestione_prima_nota']['fattura_mese']=$_GET['mese'];
}
if (array_key_exists("gestione_prima_nota",$_SESSION) and array_key_exists("fattura_mese",$_SESSION['gestione_prima_nota']))
{
	$pn_mese=$_SESSION['gestione_prima_nota']['fattura_mese'];
}
$periodo = $pn_anno."-".$pn_mese;
$where_pn = "prima_nota_data LIKE '".$periodo."%'";
$paginazione = $sql->paginazione_menu($tabelle['prima_nota'], $where_pn);
$limit = $sql->paginazione_valuta();
$select_pn = "SELECT * FROM " . $tabelle['prima_nota'] . " WHERE " . $where_pn . " ORDER BY prima_nota_data ASC LIMIT " . $limit;
$result_pn = $sql->select_query($select_pn);

// Calcolare i totali del mese
$select_totali_pn = "SELECT SUM(prima_nota_entrata) AS somma_entrata, SUM(prima_nota_uscita) AS somma_uscita FROM " . $tabelle['prima_nota'] . " WHERE " . $where_pn;
$result_totali_pn = $sql->select_query($select_totali_pn);

require_once "views/transactions/admin.php";

