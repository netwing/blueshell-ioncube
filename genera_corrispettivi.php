<?php
require_once("config.inc.php");
$dal=$_POST['dal'];
$al=$_POST['al'];
$blue->autentica_utente("contratti","R");
$sel_pb="SELECT posto_barca_id,posto_barca_proprietario,posto_barca_gestore FROM ".$tabelle['posti_barca']." ORDER BY posto_barca_id ASC";
$res_pb=$sql->select_query($sel_pb);
$pb_pg=array();
$pb_pg[0]=array('proprietario'=>"",'gestore'=>"");
while ($row_pb=mysql_fetch_array($res_pb))
{
	$pb_pg[$row_pb['posto_barca_id']]=array("proprietario"=>$row_pb['posto_barca_proprietario'],"gestore"=>$row_pb['posto_barca_gestore']);
}
//$select="SELECT contratto_id,contratto_anagrafica1,contratto_anagrafica2,contratto_barca,contratto_posto_barca,contratto_tipo,contratto_inizio,contratto_fine,contratto_data,contratto_fatturato,contratto_tipo FROM ".$tabelle['contratti']." WHERE (LEFT(contratto_inizio,4)='".$dal[3]."' OR LEFT(contratto_fine,4)='".$dal[3]."') AND (contratto_tipo='1' OR contratto_tipo='11') ORDER BY contratto_tipo ASC, contratto_posto_barca ASC, contratto_inizio ASC";
$select="SELECT contratto_id,contratto_anagrafica1,contratto_anagrafica2,contratto_barca,contratto_posto_barca,contratto_tipo,contratto_inizio,contratto_fine,contratto_data,contratto_totale as contratto_fatturato,contratto_tipo FROM ".$tabelle['contratti']." WHERE (contratto_inizio<='".$al."' AND contratto_fine>='".$dal."') AND (contratto_tipo='1' OR contratto_tipo='11') ORDER BY contratto_tipo ASC, contratto_posto_barca ASC, contratto_inizio ASC";
$result=$sql->select_query($select);
$ricavo_p_tot=0;
$elenco_clienti=$blue->elenco_clienti();
$elenco_posti_barca=$blue->elenco_posti_barca();
$ricerca_sostituzione=array();
$totale_utile=0;
while ($row=mysql_fetch_array($result))
{
	$inizio=$row['contratto_inizio'];
	$fine=$row['contratto_fine'];
	$durata_ts=strtotime($row['contratto_fine'])-strtotime($row['contratto_inizio']);
	$durata_gg=intval($durata_ts/86400); // Calcoliamo la durata in giorni del contratto
	$fatturato=$row['contratto_fatturato'];
	switch($row['contratto_tipo'])
	{
		case '1';
		$tipo='Affitto';
		break;
		case '11';
		$tipo='Transito';
		break;
	}
	@$proprietario=$elenco_clienti[$pb_pg[$row['contratto_posto_barca']]['proprietario']];
	@$gestore=$elenco_clienti[$pb_pg[$row['contratto_posto_barca']]['gestore']];
	if ($inizio<$dal)
	{
		$giorni_di_troppo=strtotime($dal)-strtotime($row['contratto_inizio']);
		$durata_ts=$durata_ts-$giorni_di_troppo;
	}
	// Nel caso in cui il contratto inizi prima di quest'anno
	if ($fine>$al)
	{
		$giorni_di_troppo=strtotime($row['contratto_fine'])-strtotime($al);
		$durata_ts=$durata_ts-$giorni_di_troppo;	
	}
	// Nel caso in cui il contratto termini dopo quest'anno
	$durata_gg2=intval($durata_ts/86400); // Calcoliamo la durata in giorni del contratto per il periodo che ci interessa
	if ($fatturato>0 and $durata_gg2>0)
	{
		$ricavo_gg=$fatturato/$durata_gg; // Calcoliamo il ricavo giornaliero del contratto
		$ricavo_p=round($ricavo_gg*$durata_gg2,2);
		$ricavo_p_tot=$ricavo_p_tot+$ricavo_p;
		$inizio=$sql->data_ita($inizio);
		$fine=$sql->data_ita($fine);
		$ricerca_sostituzione[]=array(	'<PB>'=>$elenco_posti_barca[$row['contratto_posto_barca']],
										'<PROPRIETARIO>'=>$proprietario,
										'<GESTORE>'=>$gestore,
										'<CLIENTE>'=>$elenco_clienti[$row['contratto_anagrafica2']],
										'<INIZIO>'=>$inizio[0],
										'<FINE>'=>$fine[0],
										'<DURATA>'=>$durata_gg,
										'<FATTURATO>'=>number_format($fatturato,2,",","."),
										'<GIORNI>'=>$durata_gg2,
										'<UTILE>'=>number_format($ricavo_p,2,",","."),
										'<TIPO>'=>$tipo
										);
		$totale_utile=$totale_utile+$ricavo_p;						
	//	echo ."==> ".$inizio."-".$fine.": ".$durata_gg." <> ".$durata_gg2." Totale: ".$fatturato."; nel periodo: ".$ricavo_p."<br>";
	}
	// echo $inizio."-".$fine.": ".$durata_gg." -- ".$durata_gg2."<br />";
}
//echo "<br><br>".$ricavo_p_tot;
$excel="Posto barca\tProprietario\tGestore\tCliente\tInizio\tFine\tDurata\tFatturato\tGiorni Utili\tFatturato Utile\tTipo di Contratto\n";
if (array_key_exists("excel",$_POST))
{
	foreach ($ricerca_sostituzione as $k=>$v)
	{
		$excel.=html_entity_decode(implode("\t",$v));
		$excel.="\n";
	}
	header('Content-Type: application/xls');
	header("Content-Disposition: attachment; filename=Report_Corrispettivi.xls");
	echo $excel;
	exit;
}
else
{	
	$rtf=new RTF();
	//$rtf->intestazioni=array("Codice","Contratto","Cliente","Barca","Posto Barca","Data","Dal","Al");
	$rtf->carica_template("template/report_corrispettivi.rtf");
	$rtf->rtf_multiriga($ricerca_sostituzione);
	$rtf->contenuto_finale=str_replace("<DAL>",$_POST['dal'],$rtf->contenuto_finale);
	$rtf->contenuto_finale=str_replace("<AL>",$_POST['al'],$rtf->contenuto_finale);
	$rtf->contenuto_finale=str_replace("<TOTALE_UTILE>",number_format($totale_utile,2,",","."),$rtf->contenuto_finale);
	$rtf->contenuto_finale=str_replace("<BOFEOF>","",$rtf->contenuto_finale);
	$rtf->contenuto_finale=str_replace("<BOHEOH>","",$rtf->contenuto_finale);
	$rtf->output("Report_Corrispettivi.doc");
}
?>