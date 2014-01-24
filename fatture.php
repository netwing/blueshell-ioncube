<?php
require_once("config.inc.php");
$blue->autentica_utente("fatture","R");
$elenco_clienti=$blue->elenco_clienti();
$fattura_anno=date("Y",time());
$fattura_mese=date("m",time());

if (array_key_exists("anno",$_GET)) {
	$_SESSION['gestione_fatture']['fattura_anno']=$_GET['anno'];
}
if (array_key_exists("gestione_fatture",$_SESSION) and array_key_exists("fattura_anno",$_SESSION['gestione_fatture'])) {
	$fattura_anno=$_SESSION['gestione_fatture']['fattura_anno'];
}
if (array_key_exists("mese",$_GET)) {
	$_SESSION['gestione_fatture']['fattura_mese']=$_GET['mese'];
}
if (array_key_exists("gestione_fatture",$_SESSION) and array_key_exists("fattura_mese",$_SESSION['gestione_fatture'])) {
	$fattura_mese=$_SESSION['gestione_fatture']['fattura_mese'];
}

$select_anni="SELECT LEFT(fattura_data,4) AS anno FROM ".$tabelle['fatture']." WHERE LEFT(fattura_data,4)<>'0000' GROUP BY LEFT(fattura_data,4)";
$result_anni=$sql->select_query($select_anni);
$anni = array();
while ($row_anni=mysql_fetch_array($result_anni)) {
	if ($row_anni['anno'] == $fattura_anno) {
		$anni[] = "<li role=\"presentation\"><a href=\"fatture.php?anno=".$row_anni['anno']."\"><strong>".$row_anni['anno']."</strong></a></li>";		
	} else {
		$anni[] = "<li role=\"presentation\"><a href=\"fatture.php?anno=".$row_anni['anno']."\">".$row_anni['anno']."</a></li>";
	}
}

$elenco_mesi=array("01"=>"Gen","02"=>"Feb","03"=>"Mar","04"=>"Apr","05"=>"Mag","06"=>"Giu","07"=>"Lug","08"=>"Ago","09"=>"Set","10"=>"Ott","11"=>"Nov","12"=>"Dec");
$mesi = array();
foreach ($elenco_mesi as $k=>$v) {
	if ($k == $fattura_mese) {
		$mesi[] = "<li role=\"presentation\"><a href=\"fatture.php?mese=".$k."\"><strong>".$v."</strong></a></li>";
	} else {
		$mesi[] = "<li role=\"presentation\"><a href=\"fatture.php?mese=".$k."\">".$v."</a></li>";	
	}
}

$periodo=$fattura_anno."-".$fattura_mese;
$where_fattura="fattura_data LIKE '".$periodo."%'";
$paginazione=$sql->paginazione_menu($tabelle['fatture'],$where_fattura);
$limit=$sql->paginazione_valuta();
$select_fatture="SELECT fattura_id,fattura_cliente_id,fattura_numero,fattura_data,SUM(fattura_riga_imponibile) AS fattura_imponibile,SUM(fattura_riga_totale) AS fattura_totale FROM ".$tabelle['fatture'].",".$tabelle['fatture_righe']." WHERE ".$where_fattura." AND fattura_riga_fattura_id=fattura_id GROUP BY fattura_id ORDER BY (fattura_numero + 0) ASC LIMIT ".$limit;
$result_fatture=$sql->select_query($select_fatture);

require_once "views/invoice/admin.php";
