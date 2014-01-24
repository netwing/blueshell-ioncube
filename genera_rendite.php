<?php
require_once("config.inc.php");
$dal = $_POST['dal'];
$al = $_POST['al'];
$blue->autentica_utente("contratti","R");

// Raccogliamo tutti i contratti di gestione che alla data di inizio rapporto NON sono ancora scaduti
$select="SELECT DISTINCT contratto_posto_barca,contratto_inizio,contratto_fine,contratto_gestione_percentuale,cliente_nominativo,cliente_indirizzo,cliente_cap,cliente_citta,cliente_provincia FROM blue_contratti,blue_clienti WHERE cliente_id=contratto_anagrafica1 AND contratto_tipo='3' AND contratto_fine>='".$dal."'";
$result=$sql->select_query($select);
$roba=array();
$i=0;
while ($row=mysql_fetch_array($result))
{
	$pb=$blue->nome_posto_barca($row['contratto_posto_barca']);
	$proprietario=$row['cliente_nominativo'];
	$percentuale=$row['contratto_gestione_percentuale'];
	$contratto_inizio=$sql->data_ita($row['contratto_inizio']);
	$contratto_fine=$sql->data_ita($row['contratto_fine']);

	// Inserite per comodita' nei calcoli
	$gestione_inizio=$row['contratto_inizio'];
	$gestione_fine=$row['contratto_fine'];
	$durata_gestione=intval((strtotime($row['contratto_fine'])-strtotime($row['contratto_inizio']))/86400);
	// Fine variabili aggiunte al volo
	// echo "LA GESTIONE INIZIA IL ".$gestione_inizio." E FINISCE IL ".$gestione_fine." PER UN TOTALE DI ".$durata_gestione." GIORNI<br>";
	$roba[$i]=array('<POSTOBARCA>'=>$pb[0]."/".$pb[1],'<NOMINATIVO>'=>$proprietario,'<INDIRIZZO>'=>$row['cliente_indirizzo'],'<CAP>'=>$row['cliente_cap'],'<CITTA>'=>$row['cliente_citta'],'<PROVINCIA>'=>$row['cliente_provincia'],'<PERC>'=>$percentuale,'<ANNO>'=>substr($dal, 0, 4),'<DATA>'=>strftime('%d %B %Y',time()),'<INIZIO-GESTIONE>'=>$contratto_inizio[0],'<FINE-GESTIONE>'=>$contratto_fine[0],'<TOTALE>'=>0);
	$select2="SELECT contratto_inizio,contratto_fine,contratto_totale,contratto_fatturato,contratto_tipo FROM blue_contratti WHERE contratto_posto_barca='".$row['contratto_posto_barca']."' AND (contratto_tipo='1' OR contratto_tipo='11') AND (LEFT(contratto_inizio,4)='".substr($dal, 0, 4)."' OR LEFT(contratto_fine,4)='".substr($dal, 0, 4)."')";
	$result2=$sql->select_query($select2);
	$j=0;
	while ($row2=mysql_fetch_array($result2))
	{
		$inizio=$row2['contratto_inizio'];
		$fine=$row2['contratto_fine'];

		// Variabili aggiunge per comodita' di calcolo
		$affitto_inizio=$inizio;
		$affitto_fine=$fine;
		// Fine variabili di comodo
		
		switch($row2['contratto_tipo'])
		{
			case '1';
			$tipo='Affitto';
			break;
			case '11';
			$tipo='Transito';
			break;
		}
		// Durata del contratto di affitto/transito
		$durata_ts=strtotime($fine)-strtotime($inizio);
		// Calcoliamo la durata in giorni del contratto
		$durata_gg=intval($durata_ts/86400);
		// Calcoliamo l'imponibile del fatturato
		$fatturato=$row2['contratto_fatturato']/120*100;
		if ($fatturato<=0)
		{
			$fatturato=$row2['contratto_totale']/120*100;
		}

		// Nel caso in cui il contratto DI AFFITTO inizi prima della data selezionata dall'utente togliamo i giorni prima in eccesso
		if ($inizio<$dal)
		{
			$giorni_di_troppo=strtotime($dal)-strtotime($row2['contratto_inizio']);
			$durata_ts=$durata_ts-$giorni_di_troppo;
		}
		// Nel caso in cui il contratto DI AFFITTO termini dopo la data selezionata dall'utente togliamo i giorni dopo in eccesso
		if ($fine>$al)
		{
			$giorni_di_troppo=strtotime($row2['contratto_fine'])-strtotime($al);
			$durata_ts=$durata_ts-$giorni_di_troppo;	
		}

		// L'affitto inizia tra la data selezionata e l'inizio della gestione (selezione 01-01-2005, affitto 01-02-2005, gestione 01-03-2005)
		if (($dal<=$affitto_inizio) AND ($affitto_inizio<=$gestione_inizio))
		{
			// Togliamo i giorni tra l'inizio della gestione (maggiore) e l'inizio dell'affito (minore)
			$giorni_di_troppo=strtotime($gestione_inizio)-strtotime($affitto_inizio);
			$durata_ts=$durata_ts-$giorni_di_troppo;	
		}
		// L'affitto inizia prima della data selezionata e prima della gestione (selezione 01-01-2005, affitto 01-12-2004, gestione 01-03-2005) 
		elseif(($dal>=$affitto_inizio) AND ($affitto_inizio<=$gestione_inizio))
		{
			// Togliamo i giorni dall'inizio della gestione (maggiore) all'inizio del periodo selezionato (minore)
			$giorni_di_troppo=strtotime($gestione_inizio)-strtotime($dal);
			$durata_ts=$durata_ts-$giorni_di_troppo;	
			// NON agiamo sull'inizio dell'affitto perchè potrebbe essere molto prima
		}

		// L'affitto termina tra la data selezionata e la fine della gestione (selezione 31-12-2005, affitto 30-11-2005, gestione 31-10-2005)
		if (($al>=$affitto_fine) AND ($affitto_fine>=$gestione_fine))
		{
			// Togliamo i giorni tra la fine dell'affitto (maggiore) e la fine della gestione (minore)
			$giorni_di_troppo=strtotime($affitto_fine)-strtotime($gestione_fine);
			$durata_ts=$durata_ts-$giorni_di_troppo;
		}
		// L'affitto termina dopo la data selezionata e dopo la fine della gestione (selezione 31-12-2005, affitto 31-01-2006, gestione 31-10-2005) 
		elseif(($al<=$affitto_fine) AND ($affitto_fine>=$gestione_fine))
		{
			// Togliamo i giorni dalla fine della selezione (maggiore) alla fine della gestione (minore)
			$giorni_di_troppo=strtotime($al)-strtotime($gestione_fine);
			$durata_ts=$durata_ts-$giorni_di_troppo;	
			// NON agiamo sulla fine dell'affitto perchè potrebbe essere molto dopo
		}
		$durata_gg2=intval($durata_ts/86400); // Calcoliamo la durata in giorni del contratto per il periodo che ci interessa
		// echo "Questo affitto che va dal ".$affitto_inizio." al ".$affitto_fine." dura ".$durata_gg." giorni, ma utili ne rimangono ".$durata_gg2."<br />";
		if ($fatturato>0 and $durata_gg2>0)
		{
			$j++;
			$ricavo_giornaliero=$fatturato/$durata_gg; // Calcoliamo il fatturato giornaliero del contratto
			$ricavo_periodo=round($ricavo_giornaliero*$durata_gg2,2); // Calcoliamo il fatturato per i giorni utili
			$rendita=round($ricavo_periodo/100*$percentuale,2);
			$inizio=$sql->data_ita($inizio);
			$fine=$sql->data_ita($fine);
			$roba[$i][]=array('<NUM>'=>$j,'<INIZIO>'=>$row2['contratto_inizio'],'<FINE>'=>$row2['contratto_fine'],'Fatturato'=>$row2['contratto_fatturato'],'Durata'=>$durata_gg,'<GIORNI-UTILI>'=>$durata_gg2,'<INCASSO>'=>$ricavo_periodo,'<RENDITA>'=>$rendita);
			$roba[$i]['<TOTALE>']+=$rendita;
			$roba_x_excel[]=array('Posto Barca'=>$pb[0]."/".$pb[1],'Proprietario'=>$proprietario,'Percentuale'=>$percentuale,'Dal'=>$row2['contratto_inizio'],'Al'=>$row2['contratto_fine'],'Durata'=>$durata_gg,'Fatturato'=>number_format($row2['contratto_fatturato'],2,',',''),'Durata Utile'=>$durata_gg2,'Fatturato Utile'=>number_format($ricavo_periodo,'2',',',''),'Rendita'=>number_format($rendita,'2',',',''),'Tipo di Contratto'=>$tipo);
		}
	}
	$i++;
}
$excel="Rapporto Rendite dal ".$_POST['dal']." al ".$_POST['al']."\n";
$excel.="Posto barca\tProprietario\tPercentuale\tInizio\tFine\tDurata\tIncasso\tGiorni Utili\tIncasso Utile\tRendita\tTipo di Contratto\n";
if (array_key_exists("excel",$_POST))
{
	foreach ($roba_x_excel as $k=>$v)
	{
		$excel.=html_entity_decode(implode("\t",$v));
		$excel.="\n";
	}
	header('Content-Type: application/xls');
	header("Content-Disposition: attachment; filename=Report_Rendite.xls");
	echo $excel;
	exit;
}
else
{	
	$rtf=new RTF();
	//$rtf->intestazioni=array("Codice","Contratto","Cliente","Barca","Posto Barca","Data","Dal","Al");
	$rtf->carica_template("template/report_rendite.rtf");
	$rtf->rtf_multiplo_multiriga($roba);
/*	$rtf->contenuto_finale=str_replace("<DAL>",$_POST['dal'],$rtf->contenuto_finale);
	$rtf->contenuto_finale=str_replace("<AL>",$_POST['al'],$rtf->contenuto_finale);
	$rtf->contenuto_finale=str_replace("<TOTALE_UTILE>",number_format($totale_utile,2,",","."),$rtf->contenuto_finale);
	$rtf->contenuto_finale=str_replace("<BOFEOF>","",$rtf->contenuto_finale);
	$rtf->contenuto_finale=str_replace("<BOHEOH>","",$rtf->contenuto_finale);
*/	$rtf->output("Report_Rendite.doc");
}
?>