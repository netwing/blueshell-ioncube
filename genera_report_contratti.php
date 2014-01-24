<?php
require_once("config.inc.php");
$ricerca_sostituzione=array();
$tipi=$blue->elenco_tipi();
$clienti=$blue->elenco_clienti();
$barche=$blue->elenco_barche();
$posti_barca=$blue->elenco_posti_barca();
$dal=$sql->data_sql($_POST['dal']);
$dal=$dal[0];
$al=$sql->data_sql($_POST['al']);
$al=$al[0];
if (array_key_exists("inizio_fine",$_POST))
{
	switch($_POST['inizio_fine'])
	{
		case "inizio";
		$inizio_fine="contratto_inizio";
		$rtf_inizio_fine="inizio";	
		break;
		case "fine";
		$inizio_fine="contratto_fine";	
		$rtf_inizio_fine="scadenza";	
		break;
		default;
		$inizio_fine="contratto_inizio";
		$rtf_inizio_fine="inizio";	
		break;
	}
}
else
{
	$inizio_fine="contratto_inizio";
	$rtf_inizio_fine="inizio";	
}
$select="SELECT contratto_id,contratto_anagrafica2,contratto_tipo,contratto_barca,contratto_posto_barca,contratto_data,contratto_inizio,contratto_fine,contratto_totale,contratto_sconto,contratto_fatturato FROM ".$tabelle['contratti']." WHERE (contratto_tipo='1' OR contratto_tipo='4' OR contratto_tipo='11') AND ".$inizio_fine.">='".$dal."' AND ".$inizio_fine."<='".$al."' ORDER BY contratto_tipo ASC, ".$inizio_fine." ASC";
$result=$sql->select_query($select);
while ($row=mysql_fetch_array($result)) {
	$data=$sql->data_ita($row['contratto_data']);
	$data=$data[0];
	$inizio=$sql->data_ita($row['contratto_inizio']);
	$inizio=$inizio[0];
	$fine=$sql->data_ita($row['contratto_fine']);
	$fine=$fine[0];
	$totale=$sql->decimale_ita($row['contratto_totale']);
	if ($totale==NULL or $totale=="") {
		$totale="0,00";
	}
	if ($row['contratto_sconto']>0 and $row['contratto_sconto']!='') {
		$totale_scontato=$totale-round(($totale/100*$row['contratto_sconto']),2);
		$totale=$totale." (".number_format($totale_scontato,2,',','').")";
	}
	$fatturato=$sql->decimale_ita($row['contratto_fatturato']);
	if ($fatturato==NULL or $fatturato=="") {
		$fatturato="0,00";
	}
	
	if ($_POST['report_tipo']=="fatturato") {
		$ricerca_sostituzione[]=array(	'<CONTRAT4TO>'=>ucfirst(@$tipi[$row['contratto_tipo']]),
										'<CLIENTE>'=>@$clienti[$row['contratto_anagrafica2']],
										'<BARCA>'=>@$barche[$row['contratto_barca']],
										'<PB>'=>@$posti_barca[$row['contratto_posto_barca']],
										'<DAL>'=>$inizio,
										'<AL>'=>$fine,
										'<TOTALE>'=>$totale,
										'<FATTURATO>'=>$fatturato
										);
	} else {
		$ricerca_sostituzione[]=array(	'<ID>'=>$row['contratto_id'],
										'<CONTRATTO>'=>ucfirst(@$tipi[$row['contratto_tipo']]),
										'<CLIENTE>'=>@$clienti[$row['contratto_anagrafica2']],
										'<BARCA>'=>@$barche[$row['contratto_barca']],
										'<PB>'=>@$posti_barca[$row['contratto_posto_barca']],
										'<DATA>'=>$data,
										'<DAL>'=>$inizio,
										'<AL>'=>$fine
										);
	}
}

$rtf=new RTF();
$rtf->intestazioni=array("Codice","Contratto","Cliente","Barca","Posto Barca","Data","Dal","Al");
if ($_POST['report_tipo']=="fatturato")
{
	$rtf->carica_template("template/report_contratti_fatturato.rtf");
}
else
{
	$rtf->carica_template("template/report_contratti.rtf");
}
$rtf->rtf_multiriga($ricerca_sostituzione);
$rtf->contenuto_finale=str_replace("<INIZIO_FINE>",$rtf_inizio_fine,$rtf->contenuto_finale);
$rtf->contenuto_finale=str_replace("<DAL>",$_POST['dal'],$rtf->contenuto_finale);
$rtf->contenuto_finale=str_replace("<AL>",$_POST['al'],$rtf->contenuto_finale);
$rtf->contenuto_finale=str_replace("<BOFEOF>","",$rtf->contenuto_finale);
$rtf->contenuto_finale=str_replace("<BOHEOH>","",$rtf->contenuto_finale);
$rtf->output("Report_Contratti.doc");
?>