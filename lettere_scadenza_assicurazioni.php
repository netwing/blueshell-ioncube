<?php
require_once("config.inc.php");
$blue->autentica_utente("documenti","R");
if (!array_key_exists("assicurazione_fine_dal",$_POST) or !array_key_exists("assicurazione_fine_al",$_POST)) {
	header("Location:assicurazioni_scadenze.php");
	exit;
}

/*
$inizio=$sql->data_sql($_POST['assicurazione_fine_dal']);
$inizio=$inizio[0];
$fine=$sql->data_sql($_POST['assicurazione_fine_al']);
$fine=$fine[0];
*/
$inizio = $_POST['assicurazione_fine_dal'];
$fine = $_POST['assicurazione_fine_al'];

// Eseguiamo il carico delle imbarcazioni con assicurazione in scadenza quando ci sono contratti attivi
$select_contratti="SELECT barca_id,barca_nome,barca_proprietario,barca_scadenza_polizza,cliente_nominativo,cliente_indirizzo,cliente_cap,cliente_citta,cliente_provincia FROM ".$tabelle['clienti'].",".$tabelle['barche'].",".$tabelle['contratti']." WHERE cliente_rifiuta_comunicazioni=0 AND contratto_tipo!='4' AND (contratto_inizio<=NOW() AND contratto_fine>=NOW()) AND barca_id=contratto_barca AND cliente_id=barca_proprietario AND barca_scadenza_polizza BETWEEN '".$inizio."' AND '".$fine."' GROUP BY barca_id ORDER BY barca_scadenza_polizza ASC";
$result_contratti=$sql->select_query($select_contratti);
$ricerca_sostituzione=array();
$temp=array();
while ($row_contratti=mysql_fetch_array($result_contratti)) {
	$cliente=$row_contratti['cliente_nominativo'];
	$indirizzo=$row_contratti['cliente_indirizzo'];
	$cap=$row_contratti['cliente_cap'];
	$citta=$row_contratti['cliente_citta'];
	$provincia=$row_contratti['cliente_provincia'];
	$data=date("d-m-Y",time());
	$barca=$row_contratti['barca_nome'];
	$scad=$sql->data_ita($row_contratti['barca_scadenza_polizza']);
	$scadenza=$scad[0];
	//$ricerca_sostituzione[]=array("<NOMINATIVO>"=>$cliente,
	$temp[$row_contratti['barca_id']]=array(
		"<NOMINATIVO>"=>$cliente,
		"<INDIRIZZO>"=>$indirizzo,
		"<CAP>"=>$cap,
		"<CITTA>"=>$citta,
		"<PROVINCIA>"=>$provincia,
		"<DATA>"=>$data,
		"<IMBARCAZIONE>"=>$barca,
		"<SCADENZA>"=>$scadenza
	);
}
// Eseguiamo il carico delle imbarcazioni con assicurazione in scadenza quando ci sono presenze in corso
$select_contratti="SELECT barca_id,barca_nome,barca_proprietario,barca_scadenza_polizza,cliente_nominativo,cliente_indirizzo,cliente_cap,cliente_citta,cliente_provincia FROM ".$tabelle['clienti'].",".$tabelle['barche'].",".$tabelle['presenze']." WHERE cliente_rifiuta_comunicazioni=0 AND (presenza_arrivo<=NOW() AND (presenza_partenza>=NOW() OR presenza_partenza='0000-00-00')) AND barca_id=presenza_barca AND cliente_id=barca_proprietario AND barca_scadenza_polizza BETWEEN '".$inizio."' AND '".$fine."' GROUP BY barca_id ORDER BY barca_scadenza_polizza ASC";
$result_contratti=$sql->select_query($select_contratti);
while ($row_contratti=mysql_fetch_array($result_contratti)) {
	$cliente=$row_contratti['cliente_nominativo'];
	$indirizzo=$row_contratti['cliente_indirizzo'];
	$cap=$row_contratti['cliente_cap'];
	$citta=$row_contratti['cliente_citta'];
	$provincia=$row_contratti['cliente_provincia'];
	$data=date("d-m-Y",time());
	$barca=$row_contratti['barca_nome'];
	$scad=$sql->data_ita($row_contratti['barca_scadenza_polizza']);
	$scadenza=$scad[0];
//	$ricerca_sostituzione[]=array("<NOMINATIVO>"=>$cliente,
	$temp[$row_contratti['barca_id']]=array(
		"<NOMINATIVO>"=>$cliente,
		"<INDIRIZZO>"=>$indirizzo,
		"<CAP>"=>$cap,
		"<CITTA>"=>$citta,
		"<PROVINCIA>"=>$provincia,
		"<DATA>"=>$data,
		"<IMBARCAZIONE>"=>$barca,
		"<SCADENZA>"=>$scadenza
	);
}

$ricerca_sostituzione=$temp;
// Generiamo l'RTF Finale
$rtf=new RTF();
if (array_key_exists("rapporto",$_POST)) {
	$rtf->carica_template("template/report_polizze.rtf");
	$rtf->rtf_multiriga($ricerca_sostituzione);
	$rtf->contenuto_finale=str_replace("<DAL>",$_POST['assicurazione_fine_dal'],$rtf->contenuto_finale);
	$rtf->contenuto_finale=str_replace("<AL>",$_POST['assicurazione_fine_al'],$rtf->contenuto_finale);
	$rtf->contenuto_finale=str_replace("<BOFEOF>","",$rtf->contenuto_finale);
	$rtf->contenuto_finale=str_replace("<BOHEOH>","",$rtf->contenuto_finale);
	$filename = Yii::t('filename', 'Insurance_expire_report.doc');
	$rtf->output($filename);
}
else {
	$rtf->carica_template("template/lettera_polizze.rtf");
	$rtf->rtf_multiplo($ricerca_sostituzione);
	$filename = Yii::t('filename', 'Insurance_expire_letters.doc');
	$rtf->output($filename);
}
