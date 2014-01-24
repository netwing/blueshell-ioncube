<?php
require_once("config.inc.php");

$a2005=array();
$a2006=array();

$anno1=array();
$anno2=array();
$prenotazioni=array();

$risultati=array();

$dal1 = strftime("%Y-%m-%d", strtotime("1 month ago"));
$al1 = strftime("%Y-%m-%d", time());
$dal2 = strftime("%Y-%m-%d", strtotime("13 month ago"));
$al2 = strftime("%Y-%m-%d", strtotime("12 month ago"));
$dal3 = '0000-00-00';
$al3 = '0000-00-00';

$visualizza = false;

if (count($_POST) > 0) {

	$dal1 = $_POST['dal1'];
	$al1 = $_POST['al1'];
	$dal2 = $_POST['dal2'];
	$al2 = $_POST['al2'];

	$dal3 = strftime("%Y-%m-%d", strtotime("1 year ago", strtotime($_POST['dal2'])));
	$al3 = strftime("%Y-%m-%d", strtotime("1 year ago", strtotime($_POST['al2'])));
		
	$periodi=array(1=>'annuali',2=>'stagionali',3=>'mensili',5=>'settimanali',6=>'pluriennali');
	$dati=array();
	foreach ($periodi as $k=>$v)
	{
		$select="SELECT DISTINCT contratto_anagrafica2,COUNT(*) AS numero FROM blue_contratti WHERE contratto_anagrafica1=1 AND contratto_anagrafica2<>1 AND contratto_tipo='1' AND contratto_periodo='".$k."' AND contratto_inizio<='".$al2."' AND contratto_fine>='".$dal2."' GROUP BY contratto_anagrafica2";
		$result=mysql_query($select);
		$dati[$k][2005]=array();
		while ($r=mysql_fetch_array($result))
		{
			$dati[$k][2005][$r['contratto_anagrafica2']]=$r['numero'];
		}
		
		$select="SELECT DISTINCT contratto_anagrafica2, COUNT(*) AS numero FROM blue_contratti WHERE contratto_anagrafica1=1 AND contratto_anagrafica2<>1 AND contratto_tipo='1' AND contratto_periodo='".$k."' AND contratto_inizio<='".$al1."' AND contratto_fine>='".$dal1."' GROUP BY contratto_anagrafica2";
		$result=mysql_query($select);
		$dati[$k][2006]=array();
		while ($r=mysql_fetch_array($result))
		{
			$dati[$k][2006][$r['contratto_anagrafica2']]=$r['numero'];
		}
	}
	$supertotale=0;
	foreach ($dati as $k=>$v)
	{
		$rinnovi=0;
		$non_rinnovi=0;
		$totale2005=array_sum($dati[$k][2005]);
		$totale2006=array_sum($dati[$k][2006]);
		$supertotale+=$totale2005;
		// Per ogni cliente del 2005
		foreach ($v[2005] as $id=>$num)
		{
			// Se l'utente è presente nell'array dell'anno successivo, ha rinnovato qualcosa
			if (array_key_exists($id,$v[2006]))
			{
				// Se hanno lo stesso numero di contratti o superiore, ha rinnovato tutto
				if ($num<=$v[2006][$id])
				{
					// Tutti i contratti del 2005 sono stati rinnovati
					$rinnovi+=$num;
					// Nessun contratto NON rinnovato
					$non_rinnovi+=0;
				}
				// Se l'anno scorso aveva più contratti, alcuni non sono stati rinnovati
				elseif ($num>$v[2006][$id])
				{
					// Ha rinnovato i contratti che ci sono anche nel 2006
					$rinnovi+=$v[2006][$id];
					// Non ha rinnovato i contratti che ci sono nel 2005 ma NON nel 2006
					$non_rinnovi+=$num-$v[2006][$id];
				}
			}
			// Se non è presente, non ha rinnovato un tubo
			else
			{
				// NON ha rinnovato TUTTI i contratti del 2005
				$non_rinnovi+=$num;
			}
		}
		$risultati[$k]['rinnovati']=$rinnovi;
		$risultati[$k]['non_rinnovati']=$non_rinnovi;
		$risultati[$k]['totali']=$totale2005;
		//$non_rinnovati_annuali=count($anno2005)-$rinnovati_annuali;
		/**/
		//$dati[$k][2005]['totale']=array_sum($dati[$k][2005]);
		//$dati[$k][2006]['totale']=array_sum($dati[$k][2006]);
	}
	$newrisultati=array();
	foreach ($risultati as $k=>$v)
	{
		$stringa="Contratto Affitto ".$periodi[$k].": dei ".$v['totali']." contratti del " . $_POST['dal2'] . ", ".$v['rinnovati']." (".round($v['rinnovati']/$supertotale*100,2)."%) sono stati rinnovati mentre ".$v['non_rinnovati']." (".round($v['non_rinnovati']/$supertotale*100,2)."%) NON sono stati rinnovati"; 
		$newrisultati[]=$stringa;
	}
	$rinnovati = $newrisultati;
	
	$periodi=$blue->elenco_periodi();

	// Array con ID del tipo di contratto e relativo nome
	$stipi="SELECT * FROM blue_contratti_tipo";
	$res=$sql->select_query($stipi);
	$tipi=array();
	while ($r=mysql_fetch_array($res))
	{
		$tipi[$r['contratto_tipo_id']]=$r['contratto_tipo_nome'];
	}
	
	//echo "Periodo dal ".$dal1." al ".$al1."<br><br>";
	
	##########################################################################################################
	# PARTE RELATIVA AI CONTRATTI
	##########################################################################################################
	##########################################################################################################
	# ANNO 2006
	##########################################################################################################
	
	//echo "ANNO 2006:<br>";
	
	// Totale di tutti i contratti di vendita
	$select="SELECT COUNT(*) AS totale FROM blue_contratti WHERE contratto_anagrafica2<>1 AND contratto_anagrafica1<=1 AND contratto_inizio<='".$al1."' AND (contratto_fine>='".$al1."' OR contratto_fine='0000-00-00') AND contratto_tipo=2";
	$result=$sql->select_query($select);
	$vendite2006=mysql_result($result,0,'totale');
	
	// Totale di tutti i contratti di vendita di ritorno
	$select="SELECT COUNT(*) AS totale FROM blue_contratti WHERE contratto_anagrafica2=1 AND contratto_anagrafica1>1 AND contratto_inizio<='".$al1."' AND contratto_fine>='".$dal1."' AND contratto_tipo=2";
	$result=$sql->select_query($select);
	$ritorni2006=mysql_result($result,0,'totale');
	
	// Totale di tutti i contratti di gestione
	$select="SELECT COUNT(*) AS totale FROM blue_contratti WHERE contratto_inizio<='".$al1."' AND contratto_fine>='".$al1."' AND contratto_tipo=3";
	$result=$sql->select_query($select);
	$gestioni2006=mysql_result($result,0,'totale');
	
	// Totale di tutti i contratti di transito
	$select="SELECT COUNT(*) AS totale FROM blue_contratti WHERE contratto_anagrafica2>1 AND contratto_inizio<='".$al1."' AND contratto_fine>='".$dal1."' AND contratto_tipo=11";
	$result=$sql->select_query($select);
	$transiti2006=mysql_result($result,0,'totale');
	
	// Totale di tutti i contratti di affitto suddivisi per durata dell'affitto
	$select="SELECT contratto_periodo,COUNT(*) AS totale FROM blue_contratti WHERE contratto_anagrafica2>1 AND contratto_inizio<='".$al1."' AND contratto_fine>='".$dal1."' AND contratto_tipo=1 GROUP BY contratto_periodo";
	$result=$sql->select_query($select);
	$periodi_affitti2006=array();
	while ($r=mysql_fetch_array($result))
	{
		$periodi_affitti2006[$r['contratto_periodo']]=$r['totale'];
	}
	$affitti2006=array_sum($periodi_affitti2006);
	$affitti2006=$affitti2006+$transiti2006;
	
	$contratti2006=$vendite2006+$affitti2006;
	$anno1['totale_contratti']=$contratti2006;
	
	//echo "TOTALE CONTRATTI: ".$contratti2006."<br>";
	
	//$vendite2006=$vendite2006-$ritorni2006;
	//echo "Totale Vendite: ".$vendite2006." (".round(($vendite2006)/$contratti2006*100,2)."%), ";
	$anno1['totale_vendite']=$vendite2006;
	$anno1['totale_vendite_percentuale']=round(($vendite2006)/$contratti2006*100,2);
	
	//echo "Gestioni: ".$gestioni2006." (".round($gestioni2006/$vendite2006*100,2)."% delle vendite)<br>";
	$anno1['totale_gestioni']=$gestioni2006;
	$anno1['totale_gestioni_percentuale']=round($gestioni2006/$vendite2006*100,2);
		
	//echo "Totale Affitti: ".$affitti2006." (".round($affitti2006/$contratti2006*100,2)."%), di cui:<br><br>";
	$anno1['totale_affitti']=$affitti2006;
	$anno1['totale_affitti_percentuale']=round($affitti2006/$contratti2006*100,2);
	
	foreach ($periodi_affitti2006 as $k=>$v)
	{
		//echo "Affitto ".$periodi[$k].": ".$v." (".round($v/$affitti2006*100,2)."%)<br>";
		$nomeaffitto='affitto_'.$periodi[$k];
		$nomeaffittopercentuale=$nomeaffitto."_percentuale";
		$anno1[$nomeaffitto]=$v;
		$anno1[$nomeaffittopercentuale]=round($v/$affitti2006*100,2);
	}
	//echo "Transito: ".$transiti2006." (".round($transiti2006/$affitti2006*100,2)."%)<br>";
	$anno1['totale_transiti']=$transiti2006;
	$anno1['totale_transiti_percentuale']=round($transiti2006/$affitti2006*100,2);

	
	##########################################################################################################
	# PARTE RELATIVA AI CONTRATTI
	##########################################################################################################
	##########################################################################################################
	# ANNO 2006
	##########################################################################################################
	
	//$dal2="2005-01-01";
	//$al2="2005-04-26";
	
	//echo "ANNO 2005:<br>";
	
	// Totale di tutti i contratti di vendita
	$select="SELECT COUNT(*) AS totale FROM blue_contratti WHERE contratto_anagrafica2>1 AND contratto_anagrafica1=1 AND contratto_inizio<='".$al2."' AND contratto_fine>='".$al2."' AND contratto_tipo=2";
	$result=$sql->select_query($select);
	$vendite2005=mysql_result($result,0,'totale');
	
	// Totale di tutti i contratti di vendita di ritorno
	$select="SELECT COUNT(*) AS totale FROM blue_contratti WHERE contratto_anagrafica2=1 AND contratto_anagrafica1>1 AND contratto_inizio<='".$al2."' AND contratto_fine>='".$dal2."' AND contratto_tipo=2";
	$result=$sql->select_query($select);
	$ritorni2005=mysql_result($result,0,'totale');
	
	// Totale di tutti i contratti di gestione
	$select="SELECT COUNT(*) AS totale FROM blue_contratti WHERE contratto_inizio<='".$al2."' AND contratto_fine>='".$al2."' AND contratto_tipo=3";
	$result=$sql->select_query($select);
	$gestioni2005=mysql_result($result,0,'totale');
	
	// Totale di tutti i contratti di transito
	$select="SELECT COUNT(*) AS totale FROM blue_contratti WHERE contratto_anagrafica2>1 AND contratto_inizio<='".$al2."' AND contratto_fine>='".$dal2."' AND contratto_tipo=11";
	$result=$sql->select_query($select);
	$transiti2005=mysql_result($result,0,'totale');
	//*/
	// Totale di tutti i contratti di affitto suddivisi per durata dell'affitto
	$select="SELECT contratto_periodo,COUNT(*) AS totale FROM blue_contratti WHERE contratto_anagrafica1=1 AND contratto_anagrafica2>1 AND contratto_inizio<='".$al2."' AND contratto_fine>='".$dal2."' AND contratto_tipo=1 GROUP BY contratto_periodo";
	$result=$sql->select_query($select);
	$periodi_affitti2005=array();
	while ($r=mysql_fetch_array($result))
	{
		$periodi_affitti2005[$r['contratto_periodo']]=$r['totale'];
	}
	$affitti2005=array_sum($periodi_affitti2005);
	$affitti2005=$affitti2005+$transiti2005;
	
	$contratti2005=$vendite2005+$affitti2005;
	//echo "TOTALE CONTRATTI: ".$contratti2005."<br>";
	$anno2['totale_contratti']=$contratti2005;
	
	//$vendite2005=$vendite2005-$ritorni2005;
	//echo "Totale Vendite: ".$vendite2005." (".round(($vendite2005)/$contratti2005*100,2)."%), ";
	$anno2['totale_vendite']=$vendite2005;
	$anno2['totale_vendite_percentuale']=round(($vendite2005)/$contratti2005*100,2);
	
	//echo "Gestioni: ".$gestioni2005." (".round($gestioni2005/$vendite2005*100,2)."% delle vendite)<br>";
	$anno2['totale_gestioni']=$gestioni2005;
	$anno2['totale_gestioni_percentuale']=round($gestioni2005/$vendite2005*100,2);
	
	//echo "Totale Affitti: ".$affitti2005." (".round($affitti2005/$contratti2005*100,2)."%), di cui:<br><br>";
	$anno2['totale_affitti']=$affitti2005;
	$anno2['totale_affitti_percentuale']=round($affitti2005/$contratti2005*100,2);
	
	foreach ($periodi_affitti2005 as $k=>$v)
	{
		//echo "Affitto ".$periodi[$k].": ".$v." (".round($v/$affitti2005*100,2)."%)<br>";
		$nomeaffitto="affitto_".$periodi[$k];
		$nomeaffittopercentuale=$nomeaffitto."_percentuale";
		$anno2[$nomeaffitto]=$v;
		$anno2[$nomeaffittopercentuale]=round($v/$affitti2005*100,2);
	}
	//echo "Transito: ".$transiti2005." (".round($transiti2005/$affitti2005*100,2)."%)<br>";
	$anno2['totale_transiti']=$transiti2005;
	$anno2['totale_transiti_percentuale']=round($transiti2005/$affitti2005*100,2);
		
	//echo "<br><br>";
	//echo "Differenze nel 2006 rispetto al 2005:<br>";
	$differenze_affitti=round(($affitti2006-$affitti2005)/$affitti2005*100,2);
	$differenze_vendite=round(($vendite2006-$vendite2005)/$vendite2005*100,2);
	
	//echo "Affitti: ".round(($affitti2006-$affitti2005)/$affitti2005*100,2)."%<br>";
	//echo "Vendite: ".round(($vendite2006-$vendite2005)/$vendite2005*100,2)."%<br>";
	
	//echo "<br><br>";
	
	// Elenco delle prenotazioni che cadono nel periodo
	$prenotazioni_fallite=0;
	$prenotazioni_riuscite=0;
	$select="SELECT contratto_anagrafica2,contratto_posto_barca,contratto_inizio,contratto_fine FROM blue_contratti WHERE contratto_anagrafica2>1 AND contratto_inizio<='".$al1."' AND contratto_fine>='".$dal1."' AND contratto_tipo=4";
	$result=$sql->select_query($select);
	$totale_prenotazioni=$sql->select_num_rows;
	while ($r=mysql_fetch_array($result))
	{
		$sel2="SELECT COUNT(*) AS totale FROM blue_contratti WHERE contratto_tipo=1 AND contratto_anagrafica2='".$r['contratto_anagrafica2']."' AND contratto_posto_barca='".$r['contratto_posto_barca']."'";// AND contratto_inizio='".$r['contratto_inizio']."' AND contratto_fine='".$r['contratto_fine']."'";
		$res2=$sql->select_query($sel2);
		$totale=mysql_result($res2,0,'totale');
		if ($totale==0)
		{
			$prenotazioni_fallite++;
		}
		else
		{
			$prenotazioni_riuscite++;
		}
	}
	
	$prenotazioni['totale']=$totale_prenotazioni;
	$prenotazioni['fallite']=$prenotazioni_fallite;
	$prenotazioni['fallite_percentuale']=round($prenotazioni_fallite/$totale_prenotazioni*100,2);
	$prenotazioni['riuscite']=$prenotazioni_riuscite;
	$prenotazioni['riuscite_percentuale']=round($prenotazioni_riuscite/$totale_prenotazioni*100,2);
	
	//echo "Prenotazioni nel periodo ".date("d-m-Y",strtotime($dal1))." al ".date("d-m-Y",strtotime($al1)).": ".$totale_prenotazioni."<br>";
	//echo "Prenotazioni che NON sono diventate contratti: ".$prenotazioni_fallite." (".round($prenotazioni_fallite/$totale_prenotazioni*100,2)."%)<br>";
	//echo "Prenotazioni che sono diventate contratti: ".$prenotazioni_riuscite." (".round($prenotazioni_riuscite/$totale_prenotazioni*100,2)."%)<br>";
	// Elenco degl'affitti che cadono nel periodo
	
	// Totale delle prenotazioni dopo la fine del periodo...
	$select="SELECT COUNT(*) AS totale FROM blue_contratti WHERE contratto_anagrafica2>1 AND contratto_inizio>'".$al1."' AND contratto_tipo=4";
	$result=$sql->select_query($select);
	$prenotazioni2006=mysql_result($result,0,'totale');
	//echo "Prenotazioni con inizio oltre il ".date("d-m-Y",strtotime($al1)).": ".$prenotazioni2006."<br>";
	
	$prenotazioni['future']=$prenotazioni2006;
	
	// Totale delle opzioni stipulate nel 2006
	$select="SELECT COUNT(*) AS totale FROM blue_contratti WHERE contratto_anagrafica2>1 AND contratto_data<='".$al1."' AND contratto_data>='".$dal1."' AND contratto_tipo=13";
	$result=$sql->select_query($select);
	$opzioni2006=mysql_result($result,0,'totale');
	//echo "Opzioni stipulate nel 2006: ".$opzioni2006."<br>";
	
	##########################################################################################################
	# PARTE RELATIVA AI CLIENTI
	##########################################################################################################
	##########################################################################################################
	# ANNO 2006
	##########################################################################################################
	
	// Questo raccoglie l'elenco dei clienti del marina nel periodo dell'anno 2004
	$select="SELECT DISTINCT cliente_id FROM blue_clienti,blue_contratti WHERE contratto_inizio<='".$al3."' AND contratto_fine>='".$dal3."' AND (contratto_tipo=1 OR contratto_tipo=11) AND cliente_id=contratto_anagrafica2 ORDER BY cliente_id ASC";
	$result=$sql->select_query($select);
	$elenco_clienti2004=array();
	while ($r=mysql_fetch_array($result))
	{
		$elenco_clienti2004[]=$r['cliente_id'];
	}
	
	// Questo raccoglie l'elenco dei clienti del marina nel periodo dell'anno 2005
	$select="SELECT DISTINCT cliente_id FROM blue_clienti,blue_contratti WHERE contratto_inizio<='".$al2."' AND contratto_fine>='".$dal2."' AND (contratto_tipo=1 OR contratto_tipo=11) AND cliente_id=contratto_anagrafica2 ORDER BY cliente_id ASC";
	$result=$sql->select_query($select);
	$elenco_clienti2005=array();
	while ($r=mysql_fetch_array($result))
	{
		$elenco_clienti2005[]=$r['cliente_id'];
	}
	
	$rinnovato2005=0;
	$acquisito2005=0;
	foreach ($elenco_clienti2005 as $v)
	{
		if (in_array($v,$elenco_clienti2004))
		{
			$rinnovato2005++;
		}
		else
		{
			$acquisito2005++;
		}
	}
	$perduto2005=count($elenco_clienti2004)-$rinnovato2005;
	
	$infoclienti=array();
	
	$infoclienti['clienti2005']=count($elenco_clienti2005);
	$infoclienti['rinnovato2005']=$rinnovato2005;
	$infoclienti['rinnovato2005_percentuale']=round($rinnovato2005/count($elenco_clienti2005)*100,2);
	$infoclienti['acquisito2005']=$acquisito2005;
	$infoclienti['acquisito2005_percentuale']=round($acquisito2005/count($elenco_clienti2005)*100,2);
	
	//echo "Nel periodo del 2005 abbiamo ".count($elenco_clienti2005)." clienti totali, di cui ".$rinnovato2005." (".round($rinnovato2005/count($elenco_clienti2005)*100,2)."%) sono clienti che hanno rinnovato, mentre ".$acquisito2005." (".round($acquisito2005/count($elenco_clienti2005)*100,2)."%) sono nuovi clienti acquisiti.";
	
	//echo "<br>";
	
	// Questo raccoglie l'elenco dei clienti del marina nel periodo dell'anno 2006
	$select="SELECT DISTINCT cliente_id FROM blue_clienti,blue_contratti WHERE contratto_inizio<='".$al1."' AND contratto_fine>='".$dal1."' AND (contratto_tipo=1 OR contratto_tipo=11) AND cliente_id=contratto_anagrafica2 ORDER BY cliente_id ASC";
	$result=$sql->select_query($select);
	$elenco_clienti2006=array();
	while ($r=mysql_fetch_array($result))
	{
		$elenco_clienti2006[]=$r['cliente_id'];
	}
	
	$rinnovato2006=0;
	$acquisito2006=0;
	foreach ($elenco_clienti2006 as $v)
	{
		if (in_array($v,$elenco_clienti2005))
		{
			$rinnovato2006++;
		}
		else
		{
			$acquisito2006++;
		}
	}
	$perduto2006=count($elenco_clienti2005)-$rinnovato2006;
	
	$infoclienti['clienti2006']=count($elenco_clienti2006);
	$infoclienti['rinnovato2006']=$rinnovato2006;
	$infoclienti['rinnovato2006_percentuale']=round($rinnovato2006/count($elenco_clienti2006)*100,2);
	$infoclienti['acquisito2006']=$acquisito2006;
	$infoclienti['acquisito2006_percentuale']=round($acquisito2006/count($elenco_clienti2006)*100,2);
	
	//echo "Nel periodo del 2006 abbiamo ".count($elenco_clienti2006)." clienti totali, di cui ".$rinnovato2006." (".round($rinnovato2006/count($elenco_clienti2006)*100,2)."%) sono clienti che hanno rinnovato, mentre ".$acquisito2006." (".round($acquisito2006/count($elenco_clienti2006)*100,2)."%) sono nuovi clienti acquisiti.";
	
	//echo "<br><br>";
	$aumento=round((count($elenco_clienti2006)-count($elenco_clienti2005))/count($elenco_clienti2005)*100,2);
	//echo "L'aumento di clienti nel 2006 rispetto al 2005 e' stato del ".round($aumento,2)."%<br>";
	$rinnovo=round(($rinnovato2006-$rinnovato2005)/$rinnovato2005*100,2);
	//echo "La percentuale di clienti che hanno rinnovato nel 2006 (".$rinnovato2006.") rispetto al 2005 (".$rinnovato2005.") e' del ".round($rinnovo,2)."%<br>";
	$acquisizione=round(($acquisito2006-$acquisito2005)/$acquisito2005*100,2);
	//echo "La percentuale di clienti acquisiti nel 2006 (".$acquisito2006.") rispetto al 2005 (".$acquisito2005.") e' del ".round($acquisizione,2)."%<br>";
	$persi=round(($perduto2006-$perduto2005)/$perduto2005*100,2);
	//echo "La percentuale di clienti che NON hanno rinnovato nel 2006 (".$perduto2006.") rispetto al 2005 (".$perduto2005.") e' del ".round($persi,2)."%<br>";
	$infoclienti['aumento']=$aumento;
	$infoclienti['rinnovo']=$rinnovo;
	$infoclienti['acquisizione']=$acquisizione;
	$infoclienti['persi']=$persi;
	
	##########################################################################################################
	# PARTE RELATIVA A VARIE INFORMAZIONI
	##########################################################################################################
	##########################################################################################################
	# ANNO 2006
	##########################################################################################################
	
	$infofinali=array();
	
	$select="SELECT contratto_inizio,contratto_fine FROM blue_contratti WHERE (contratto_tipo=1 OR contratto_tipo=11) AND contratto_anagrafica1=1 AND contratto_anagrafica2>1 AND contratto_inizio<='".$al1."' AND contratto_fine>='".$dal1."'";
	$result=$sql->select_query($select);
	$inizioanno=time(0,0,0,$_POST['dal1']['Date_Month'],$_POST['dal1']['Date_Day'],$_POST['dal1']['Date_Year']);
	$fineanno=time(0,0,0,$_POST['al1']['Date_Month'],$_POST['al1']['Date_Day'],$_POST['al1']['Date_Year']);
	$i=0;
	$totale=0;
	while ($r=mysql_fetch_array($result))
	{
		$i++;
		$inizio=strtotime($r['contratto_inizio']);
		$fine=strtotime($r['contratto_fine']);
		if ($inizio<=$inizioanno)
		{
			$inizio=$inizioanno;
		}
		if ($fine>=$fineanno)
		{
			$fine=$fineanno;
		}
		$giorni=round(($fine-$inizio)/86400,0);
		$totale+=$giorni;
	}
	$infofinali['con']['totale1']=$totale;
	$infofinali['con']['media1']=round($totale/$i,2);

	$select="SELECT contratto_inizio,contratto_fine FROM blue_contratti WHERE (contratto_tipo=1 OR contratto_tipo=11) AND contratto_anagrafica1=1 AND contratto_anagrafica2>1 AND contratto_inizio<='".$al2."' AND contratto_fine>='".$dal2."'";
	$result=$sql->select_query($select);
	$inizioanno=time(0,0,0,$_POST['dal2']['Date_Month'],$_POST['dal2']['Date_Day'],$_POST['dal2']['Date_Year']);
	$fineanno=time(0,0,0,$_POST['al2']['Date_Month'],$_POST['al2']['Date_Day'],$_POST['al2']['Date_Year']);
	$i=0;
	$totale=0;
	while ($r=mysql_fetch_array($result))
	{
		$i++;
		$inizio=strtotime($r['contratto_inizio']);
		$fine=strtotime($r['contratto_fine']);
		if ($inizio<=$inizioanno)
		{
			$inizio=$inizioanno;
		}
		if ($fine>=$fineanno)
		{
			$fine=$fineanno;
		}
		$giorni=round(($fine-$inizio)/86400,0);
		$totale+=$giorni;
	}
	$infofinali['con']['totale2']=$totale;
	$infofinali['con']['media2']=round($totale/$i,2);

	// SENZA TRANSITI

	$select="SELECT contratto_inizio,contratto_fine FROM blue_contratti WHERE (contratto_tipo=1) AND contratto_anagrafica1=1 AND contratto_anagrafica2>1 AND contratto_inizio<='".$al1."' AND contratto_fine>='".$dal1."'";
	$result=$sql->select_query($select);
	$inizioanno=time(0,0,0,$_POST['dal1']['Date_Month'],$_POST['dal1']['Date_Day'],$_POST['dal1']['Date_Year']);
	$fineanno=time(0,0,0,$_POST['al1']['Date_Month'],$_POST['al1']['Date_Day'],$_POST['al1']['Date_Year']);
	$i=0;
	$totale=0;
	while ($r=mysql_fetch_array($result))
	{
		$i++;
		$inizio=strtotime($r['contratto_inizio']);
		$fine=strtotime($r['contratto_fine']);
		if ($inizio<=$inizioanno)
		{
			$inizio=$inizioanno;
		}
		if ($fine>=$fineanno)
		{
			$fine=$fineanno;
		}
		$giorni=round(($fine-$inizio)/86400,0);
		$totale+=$giorni;
	}
	$infofinali['senza']['totale1']=$totale;
	$infofinali['senza']['media1']=round($totale/$i,2);

	$select="SELECT contratto_inizio,contratto_fine FROM blue_contratti WHERE (contratto_tipo=1) AND contratto_anagrafica1=1 AND contratto_anagrafica2>1 AND contratto_inizio<='".$al2."' AND contratto_fine>='".$dal2."'";
	$result=$sql->select_query($select);
	$inizioanno=time(0,0,0,$_POST['dal2']['Date_Month'],$_POST['dal2']['Date_Day'],$_POST['dal2']['Date_Year']);
	$fineanno=time(0,0,0,$_POST['al2']['Date_Month'],$_POST['al2']['Date_Day'],$_POST['al2']['Date_Year']);
	$i=0;
	$totale=0;
	while ($r=mysql_fetch_array($result))
	{
		$i++;
		$inizio=strtotime($r['contratto_inizio']);
		$fine=strtotime($r['contratto_fine']);
		if ($inizio<=$inizioanno)
		{
			$inizio=$inizioanno;
		}
		if ($fine>=$fineanno)
		{
			$fine=$fineanno;
		}
		$giorni=round(($fine-$inizio)/86400,0);
		$totale+=$giorni;
	}
	$infofinali['senza']['totale2']=$totale;
	$infofinali['senza']['media2']=round($totale/$i,2);

	$visualizza = true;
}

require_once "views/site/percentuali.php";

