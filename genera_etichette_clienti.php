<?php
require_once "config.inc.php";

$template = "etichette.rtf";

if (!array_key_exists("proprietari",$_POST) and !array_key_exists("affittuari",$_POST) and !array_key_exists("presenze",$_POST)) {
	Yii::app()->user->setFlash('danger', Yii::t('app', 'You must select at least one between owners, renters or present'));
	header("Location:clienti_etichette.php");
	exit;
}

// Recuperiamo info sulla data inserita
if (array_key_exists("contratto_inizio",$_POST) and $_POST['contratto_inizio']!="" and array_key_exists("contratto_fine",$_POST) and $_POST['contratto_fine']!="") {
	$contratto_inizio = $_POST['contratto_inizio'];
	$contratto_fine = $_POST['contratto_fine'];
}

// Inizializziamo l'array che conterra i nostri dati
$ricerca_sostituzione=array();

// Inizializziamo un array che contiene gli id di tutti gli utenti
$clienti_id=array();
$i=0;
$pagina = array();
if (array_key_exists("proprietari",$_POST)) {
	$select_clienti="SELECT cliente_id,cliente_nominativo,cliente_indirizzo,cliente_cap,cliente_citta,cliente_provincia FROM blue_contratti,blue_clienti WHERE cliente_rifiuta_comunicazioni='0' AND contratto_tipo=2 AND contratto_inizio<=NOW() AND contratto_fine>=NOW() AND cliente_id=contratto_anagrafica2 GROUP BY contratto_anagrafica2 ORDER BY cliente_nominativo ASC";
	// Query per recuperare le informazioni relative ai PROPRIETARI attuali
	$result_clienti=$sql->select_query($select_clienti);
	while ($row_clienti=mysql_fetch_array($result_clienti)) {
		$clienti_id[]=$row_clienti['cliente_id'];
		$i++;
		$pagina["<NOMINATIVO".$i.">"]=$row_clienti['cliente_nominativo'];
		$pagina["<INDIRIZZO".$i.">"]=$row_clienti['cliente_indirizzo'];
		$pagina["<CAP".$i.">"]=$row_clienti['cliente_cap'];
		$pagina["<CITTA".$i.">"]=$row_clienti['cliente_citta'];
		$pagina["<PROVINCIA".$i.">"]=$row_clienti['cliente_provincia'];	
		if ($i==21) {
			$i=0;
			$ricerca_sostituzione[]=$pagina;
			$pagina=array();
		}
	}
	$rimaste=(count($pagina)/5);
	for ($q=$rimaste;$q<=21;$q++) {
		$pagina["<NOMINATIVO".$q.">"]="";
		$pagina["<INDIRIZZO".$q.">"]="";
		$pagina["<CAP".$q.">"]="";
		$pagina["<CITTA".$q.">"]="";
		$pagina["<PROVINCIA".$q.">"]="";
	}
	$i=0;
	$ricerca_sostituzione[]=$pagina;
	$pagina=array();
}

if (array_key_exists("affittuari",$_POST)) {
	$select_clienti="SELECT cliente_id,cliente_nominativo,cliente_indirizzo,cliente_cap,cliente_citta,cliente_provincia FROM blue_contratti,blue_clienti WHERE cliente_rifiuta_comunicazioni='0' AND contratto_tipo=1 AND cliente_id=contratto_anagrafica2 AND (contratto_inizio<='".$contratto_fine."' AND contratto_fine>='".$contratto_inizio."') GROUP BY contratto_anagrafica2 ORDER BY cliente_nominativo";
	// Query per recuperare le informazioni relative agl'AFFITTUARI in essere nella data selezionata
	$result_clienti=$sql->select_query($select_clienti);
	while ($row_clienti=mysql_fetch_array($result_clienti)) {
		if (in_array($row_clienti['cliente_id'],$clienti_id)) {
			continue;
		}
		$clienti_id[]=$row_clienti['cliente_id'];
		$i++;
		$pagina["<NOMINATIVO".$i.">"]=$row_clienti['cliente_nominativo'];
		$pagina["<INDIRIZZO".$i.">"]=$row_clienti['cliente_indirizzo'];
		$pagina["<CAP".$i.">"]=$row_clienti['cliente_cap'];
		$pagina["<CITTA".$i.">"]=$row_clienti['cliente_citta'];
		$pagina["<PROVINCIA".$i.">"]=$row_clienti['cliente_provincia'];	
		if ($i==21) {
			$i=0;
			$ricerca_sostituzione[]=$pagina;
			$pagina=array();
		}
	}
	$rimaste=(count($pagina)/5);
	for ($q=$rimaste;$q<=21;$q++) {
		$pagina["<NOMINATIVO".$q.">"]="";
		$pagina["<INDIRIZZO".$q.">"]="";
		$pagina["<CAP".$q.">"]="";
		$pagina["<CITTA".$q.">"]="";
		$pagina["<PROVINCIA".$q.">"]="";
	}
	$i=0;
	$ricerca_sostituzione[]=$pagina;
	$pagina=array();
}

if (array_key_exists("presenze",$_POST)) {
	$select_clienti="SELECT cliente_id,cliente_nominativo,cliente_indirizzo,cliente_cap,cliente_citta,cliente_provincia FROM blue_presenze,blue_clienti WHERE cliente_rifiuta_comunicazioni='0' AND cliente_id=presenza_cliente AND (presenza_arrivo<='".$contratto_fine."' AND presenza_partenza>='".$contratto_inizio."') GROUP BY presenza_cliente ORDER BY cliente_nominativo";
	// Query per recuperare le informazioni relative alle PRESENZE in essere nella data selezionata
	$result_clienti=$sql->select_query($select_clienti);
	while ($row_clienti=mysql_fetch_array($result_clienti))
	{
		if (in_array($row_clienti['cliente_id'],$clienti_id)) {
			continue;
		}
		$i++;
		$pagina["<NOMINATIVO".$i.">"]=$row_clienti['cliente_nominativo'];
		$pagina["<INDIRIZZO".$i.">"]=$row_clienti['cliente_indirizzo'];
		$pagina["<CAP".$i.">"]=$row_clienti['cliente_cap'];
		$pagina["<CITTA".$i.">"]=$row_clienti['cliente_citta'];
		$pagina["<PROVINCIA".$i.">"]=$row_clienti['cliente_provincia'];	
		if ($i==21) {
			$i=0;
			$ricerca_sostituzione[]=$pagina;
			$pagina=array();
		}
	}
	$rimaste=(count($pagina)/5);
	for ($q=$rimaste;$q<=21;$q++) {
		$pagina["<NOMINATIVO".$q.">"]="";
		$pagina["<INDIRIZZO".$q.">"]="";
		$pagina["<CAP".$q.">"]="";
		$pagina["<CITTA".$q.">"]="";
		$pagina["<PROVINCIA".$q.">"]="";
	}
	$i=0;
	$ricerca_sostituzione[]=$pagina;
	$pagina=array();
}

$rtf=new RTF();
$rtf->carica_template("template/".$template);
$rtf->rtf_multiplo($ricerca_sostituzione);
$rtf->output(Yii::t('filename', 'Clients_Labels.doc'));
