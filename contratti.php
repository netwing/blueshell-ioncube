<?php
require_once("config.inc.php");
$blue->autentica_utente("contratti","R");
$elenco_clienti=$blue->elenco_clienti();

$elenco_barche=$blue->elenco_barche();

$contratto_tipo=1;
$contratto_anno=date("Y",time());
$contratto_mese=date("m",time());

if (array_key_exists("tipo",$_GET)) {
	$_SESSION['gestione_contratti']['contratto_tipo']=$_GET['tipo'];
}
if (array_key_exists("gestione_contratti",$_SESSION) and array_key_exists("contratto_tipo",$_SESSION['gestione_contratti'])) {
	$contratto_tipo=$_SESSION['gestione_contratti']['contratto_tipo'];
}
if (array_key_exists("anno",$_GET)) {
	$_SESSION['gestione_contratti']['contratto_anno']=$_GET['anno'];
}
if (array_key_exists("gestione_contratti",$_SESSION) and array_key_exists("contratto_anno",$_SESSION['gestione_contratti'])) {
	$contratto_anno=$_SESSION['gestione_contratti']['contratto_anno'];
}
$select_anni="SELECT LEFT(contratto_inizio,4) AS anno FROM ".$tabelle['contratti']." WHERE LEFT(contratto_inizio,4)<>'0000' GROUP BY LEFT(contratto_inizio,4)";
$result_anni=$sql->select_query($select_anni);
$anni = array();
while ($row_anni=mysql_fetch_array($result_anni)) {
	if ($row_anni['anno']==$contratto_anno) {
		$anni[] = "<li role=\"presentation\"><a href=\"contratti.php?anno=".$row_anni['anno']."\"><strong>".$row_anni['anno']."</strong></a></li>";		
	} else {
		$anni[] = "<li role=\"presentation\"><a href=\"contratti.php?anno=".$row_anni['anno']."\">".$row_anni['anno']."</a></li>";
	}
}

if (array_key_exists("mese",$_GET)) {
	$_SESSION['gestione_contratti']['contratto_mese']=$_GET['mese'];
}
if (array_key_exists("gestione_contratti",$_SESSION) and array_key_exists("contratto_mese",$_SESSION['gestione_contratti'])) {
	$contratto_mese=$_SESSION['gestione_contratti']['contratto_mese'];
}
$elenco_mesi=array("01"=>"Gen","02"=>"Feb","03"=>"Mar","04"=>"Apr","05"=>"Mag","06"=>"Giu","07"=>"Lug","08"=>"Ago","09"=>"Set","10"=>"Ott","11"=>"Nov","12"=>"Dec");
$mesi = array();
foreach ($elenco_mesi as $k=>$v) {
	if ($k == $contratto_mese) {
		$mesi[] = "<li role=\"presentation\"><a href=\"contratti.php?mese=".$k."\"><strong>".$v."</strong></a></li>";
	} else {
		$mesi[] = "<li role=\"presentation\"><a href=\"contratti.php?mese=".$k."\">".$v."</a></li>";	
	}
}

$periodo=$contratto_anno."-".$contratto_mese;
$where_contratto="contratto_tipo='".$contratto_tipo."' AND ((contratto_inizio<='".$periodo."-31' AND contratto_fine>='".$periodo."-01') OR (contratto_inizio='0000-00-00' AND contratto_fine='0000-00-00'))";
$paginazione = $sql->paginazione_menu($tabelle['contratti'],$where_contratto);
$limit=$sql->paginazione_valuta();
$select_contratti="SELECT contratto_id,contratto_data,contratto_inizio,contratto_fine,contratto_totale,contratto_fatturato,contratto_sconto,contratto_posto_barca,contratto_anagrafica1,contratto_anagrafica2,contratto_barca,pontile_codice,posto_barca_numero FROM ".$tabelle['contratti'].",".$tabelle['pontili'].",".$tabelle['posti_barca']." WHERE posto_barca_id=contratto_posto_barca AND pontile_id=posto_barca_pontile AND ".$where_contratto." ORDER BY contratto_posto_barca ASC LIMIT ".$limit;
$result_contratti=$sql->select_query($select_contratti);

// $blue->render("contratti/contratti.php");
require_once "views/contract/contract.php";
