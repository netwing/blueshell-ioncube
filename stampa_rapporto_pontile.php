<?php
require_once("config.inc.php");
$blue->autentica_utente("documenti","R");
$ricerca_sostituzione=array();
$elenco_clienti=$blue->elenco_clienti();
$elenco_pontili=$blue->elenco_pontili();
$elenco_dimensioni=$blue->elenco_dimensioni();
$pontile_codice=$elenco_pontili[$_GET['id']];
$where_contratto="posto_barca_pontile='".intval($_GET['id'])."'";
$select_pb="SELECT * FROM ".$tabelle['posti_barca']." WHERE ".$where_contratto." ORDER BY posto_barca_numero ASC";
$result_pb=$sql->select_query($select_pb);
while ($row_pb=mysql_fetch_array($result_pb))
{
	$data_prop=$sql->data_ita($row_pb['posto_barca_proprietario_data']);
	$data_gest=$sql->data_ita($row_pb['posto_barca_gestore_data']);
	$ricerca_sostituzione[]=array(	'<PB>'=>$elenco_pontili[$row_pb['posto_barca_pontile']]." ".$row_pb['posto_barca_numero'],
									'<DIMENSIONI>'=>$elenco_dimensioni[$row_pb['posto_barca_dimensioni']],
									'<PROPRIETARIO>'=>$elenco_clienti[$row_pb['posto_barca_proprietario']],
									'<DATA_PROP>'=>$data_prop[0],
									'<GESTORE>'=>$elenco_clienti[$row_pb['posto_barca_gestore']],
									'<DATA_GEST>'=>$data_gest[0]
									);
}

$rtf=new RTF();
//$rtf->intestazioni=array("Codice","Contratto","Cliente","Barca","Posto Barca","Data","Dal","Al");
$rtf->carica_template("template/report_pontile.rtf");
$rtf->rtf_multiriga($ricerca_sostituzione);
$rtf->contenuto_finale=str_replace("<DATA>",date("d/m/Y",time()),$rtf->contenuto_finale);
$rtf->contenuto_finale=str_replace("<PONTILE>",$pontile_codice,$rtf->contenuto_finale);
$rtf->contenuto_finale=str_replace("<BOFEOF>","",$rtf->contenuto_finale);
$rtf->contenuto_finale=str_replace("<BOHEOH>","",$rtf->contenuto_finale);
$rtf->output("Report_Pontile_".$pontile_codice.".doc");
?>