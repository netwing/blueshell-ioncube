<?php
require_once("config.inc.php");
$blue->autentica_utente("anagrafica","R");
$template = 'lettera_comunicazione.rtf';

if (!array_key_exists("proprietari",$_POST) and !array_key_exists("affittuari",$_POST)) {
	Yii::app()->user->setFlash('danger', Yii::t('app', 'You must select at least one between owners or renters'));
	header("Location:clienti_comunicazioni.php");
	exit;
}

// Recuperiamo info sulle date inserite
if (array_key_exists("contratto_dal",$_POST) and $_POST['contratto_dal']!="" and array_key_exists("contratto_al",$_POST) and $_POST['contratto_al']!="") {
	$inizio = $_POST['contratto_dal'];
	$fine = $_POST['contratto_al'];
}

// Inizializziamo l'array che conterra i nostri dati
$ricerca_sostituzione=array();

if (array_key_exists("proprietari",$_POST)) {
	$select_clienti="SELECT cliente_nominativo,cliente_indirizzo,cliente_cap,cliente_citta,cliente_provincia FROM blue_contratti,blue_clienti WHERE cliente_rifiuta_comunicazioni='0' AND contratto_tipo=2 AND cliente_id=contratto_anagrafica2 GROUP BY contratto_anagrafica2 ORDER BY cliente_nominativo ASC";
	// Query per recuperare le informazioni relative ai PROPRIETARI attuali
	$result_clienti=$sql->select_query($select_clienti);
	while ($row_clienti=mysql_fetch_array($result_clienti))
	{
		$ricerca_sostituzione[]=array(
			"<NOMINATIVO>"=>$row_clienti['cliente_nominativo'],
			"<INDIRIZZO>"=>$row_clienti['cliente_indirizzo'],
			"<CAP>"=>$row_clienti['cliente_cap'],
			"<CITTA>"=>$row_clienti['cliente_citta'],
			"<PROVINCIA>"=>$row_clienti['cliente_provincia']								  
		);
	}
}

if (array_key_exists("affittuari",$_POST)) {
	$select_clienti="SELECT cliente_nominativo,cliente_indirizzo,cliente_cap,cliente_citta,cliente_provincia FROM blue_contratti,blue_clienti WHERE cliente_rifiuta_comunicazioni='0' AND contratto_tipo=1 AND cliente_id=contratto_anagrafica2 AND contratto_inizio>='".$inizio."' AND contratto_fine<='".$fine."' GROUP BY contratto_anagrafica2 ORDER BY cliente_nominativo";
	// Query per recuperare le informazioni relative agl'AFFITTUARI compresi tra le date selezionate
	$result_clienti=$sql->select_query($select_clienti);
	while ($row_clienti=mysql_fetch_array($result_clienti)) {
		$ricerca_sostituzione[]=array(
			"<NOMINATIVO>"=>$row_clienti['cliente_nominativo'],
			"<INDIRIZZO>"=>$row_clienti['cliente_indirizzo'],
			"<CAP>"=>$row_clienti['cliente_cap'],
			"<CITTA>"=>$row_clienti['cliente_citta'],
			"<PROVINCIA>"=>$row_clienti['cliente_provincia']								  
		);
	}
}

$rtf = new RTF();
$rtf->carica_template("template/" . $template);
$rtf->rtf_multiplo($ricerca_sostituzione);
$rtf->output(Yii::t('filename', 'Clients_Communications.doc'));
