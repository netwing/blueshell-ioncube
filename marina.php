<?php
/*
Questo file recupera una serie di dati tra clienti,barche e contratti ed aggiorna
la tabella blue_posti_barca_status.
Questa tabella viene usata dal Flash della HomePage per visualizzare lo status dei posti barca
Non viene eseguito se richiamato da WEB
*/
if (PHP_SAPI !== 'cli') {
	exit;
}
require_once("config.inc.php");
error_reporting("E_ALL ~ E_NOTICE");
// Carichiamo l'elenco dei tipi di contratti
$tipi=$blue->elenco_tipi();
$tipi['31']="Affitto su Gestione";
$tipi['43']="Prenotazione su Gestione";
$tipi['311']="Transito su Gestione";
// Carichiamo l'elenco dei pontili
$pontili=$blue->elenco_pontili();
// Carichiamo l'elenco dei posti barca
$pb=$blue->elenco_posti_barca_disponibili('_');
$contratti=array();
foreach ($pb as $k=>$v)
{
	$contratti[$k]=array('ana'=>'0','tipo'=>'0','barca'=>'0','posto'=>$k,'inizio'=>'','fine'=>'','presenza'=>'');
}

// Carichiamo i contratti di opzione NON al Marina - TIPO 13
$selcon_opzioni="SELECT contratto_anagrafica2 AS ana,contratto_tipo AS tipo,contratto_barca AS barca,contratto_posto_barca AS posto,contratto_inizio AS inizio,contratto_fine AS fine FROM ".$tabelle['contratti']." WHERE contratto_anagrafica2>1 AND contratto_tipo='13' AND (contratto_fine='0000-00-00' OR contratto_fine>=NOW())  ORDER BY contratto_posto_barca ASC";
$rescon_opzioni=$sql->select_query($selcon_opzioni);
while ($rowcon=mysql_fetch_assoc($rescon_opzioni))
{
	$contratti[$rowcon['posto']]['ana']=$rowcon['ana'];
	$contratti[$rowcon['posto']]['tipo']=$rowcon['tipo'];
	$contratti[$rowcon['posto']]['barca']=$rowcon['barca'];
	$contratti[$rowcon['posto']]['inizio']=$rowcon['inizio'];
	$contratti[$rowcon['posto']]['fine']=$rowcon['fine'];
	$contratti[$rowpre['posto']]['presenza']='0';
}
// Carichiamo i contratti di vendita NON al Marina - TIPO 2
$selcon_vendite="SELECT contratto_anagrafica2 AS ana,contratto_tipo AS tipo,contratto_barca AS barca,contratto_posto_barca AS posto,contratto_inizio AS inizio,contratto_fine AS fine FROM ".$tabelle['contratti']." WHERE contratto_anagrafica2>1 AND contratto_tipo='2' AND (contratto_inizio<=NOW() AND (contratto_fine='0000-00-00' OR contratto_fine>=NOW()))  ORDER BY contratto_posto_barca ASC";
$rescon_vendite=$sql->select_query($selcon_vendite);
//echo $sql->select_num_rows;
while ($rowcon=mysql_fetch_assoc($rescon_vendite))
{
	$contratti[$rowcon['posto']]['ana']=$rowcon['ana'];
	$contratti[$rowcon['posto']]['tipo']=$rowcon['tipo'];
	$contratti[$rowcon['posto']]['barca']=$rowcon['barca'];
	$contratti[$rowcon['posto']]['inizio']=$rowcon['inizio'];
	$contratti[$rowcon['posto']]['fine']=$rowcon['fine'];
	$contratti[$rowpre['posto']]['presenza']='0';
}
// Carichiamo le gestioni - TIPO 3
$selcon_gestioni="SELECT contratto_anagrafica1 AS ana,contratto_tipo AS tipo,contratto_barca AS barca,contratto_posto_barca AS posto,contratto_inizio AS inizio,contratto_fine AS fine FROM ".$tabelle['contratti']." WHERE contratto_anagrafica1>1 AND contratto_tipo='3' AND (contratto_inizio<=NOW() AND(contratto_fine='0000-00-00' OR contratto_fine>=NOW()))  ORDER BY contratto_posto_barca ASC";
$rescon_gestioni=$sql->select_query($selcon_gestioni);
while ($rowcon=mysql_fetch_assoc($rescon_gestioni))
{
	$contratti[$rowcon['posto']]['ana']=$rowcon['ana'];
	$contratti[$rowcon['posto']]['tipo']=$rowcon['tipo'];
	$contratti[$rowcon['posto']]['barca']=$rowcon['barca'];
	$contratti[$rowcon['posto']]['inizio']=$rowcon['inizio'];
	$contratti[$rowcon['posto']]['fine']=$rowcon['fine'];
	$contratti[$rowpre['posto']]['presenza']='0';
}
//print_r($contratti[1129]);
// Carichiamo affitti e transiti (li consideriamo pressochè uguali) - TIPO 1 ED 11
$selcon_affitti="SELECT contratto_anagrafica2 AS ana,contratto_tipo AS tipo,contratto_barca AS barca,contratto_posto_barca AS posto,contratto_inizio AS inizio,contratto_fine AS fine FROM ".$tabelle['contratti']." WHERE contratto_anagrafica2>1 AND (contratto_tipo='1' OR contratto_tipo='11') AND (contratto_inizio<=NOW() AND contratto_fine>=NOW())  ORDER BY contratto_posto_barca ASC";
$rescon_affitti=$sql->select_query($selcon_affitti);
while ($rowcon=mysql_fetch_assoc($rescon_affitti))
{
	$contratti[$rowcon['posto']]['ana']=$rowcon['ana'];
	
	/*if ($rowcon['posto']==1129)
	{
		echo "Siamo nel tipo ".$contratti[$rowcon['posto']]['tipo']." e si aggiunge ".$rowcon['tipo'];
		print_r($rowcon);
	}
	*/
	// Se siamo in un Affitto sopra ad una gestione, lo segnaliamo con un tipo di contratto volante (31 dove 3 sta per gestione ed 1 per affitto, oppure 311 dove 3 sta per gestione ed 11 per transito)
	if ($contratti[$rowcon['posto']]['tipo']=='3')
	{
		$contratti[$rowcon['posto']]['tipo'].=$rowcon['tipo'];
	}
	// Nel caso in cui ci siano due o piu' contratti sullo stesso PB, cosi' non si sovrascrive l'Affitto su Gestione
	elseif ($contratti[$rowcon['posto']]['tipo']=='31')
	{
		// Non fare nulla...	
	}
	else
	{
		$contratti[$rowcon['posto']]['tipo']=$rowcon['tipo'];
	}
	$contratti[$rowcon['posto']]['barca']=$rowcon['barca'];
	$contratti[$rowcon['posto']]['inizio']=$rowcon['inizio'];
	$contratti[$rowcon['posto']]['fine']=$rowcon['fine'];
	$contratti[$rowpre['posto']]['presenza']='0';
}
# echo "\n\n";
# print_r($contratti[795]);
// Carichiamo le prenotazioni in cui ci siamo dentro - TIPO 4
$selcon_prenot="SELECT contratto_anagrafica2 AS ana,contratto_tipo AS tipo,contratto_barca AS barca,contratto_posto_barca AS posto,contratto_inizio AS inizio,contratto_fine AS fine FROM ".$tabelle['contratti']." WHERE contratto_anagrafica2>1 AND contratto_tipo='4' AND contratto_inizio<=NOW() AND contratto_fine>=NOW() AND contratto_fatturato_chiuso='0' ORDER BY contratto_posto_barca ASC";
$rescon_prenot=$sql->select_query($selcon_prenot);
while ($rowcon=mysql_fetch_assoc($rescon_prenot))
{
	// Se sul PB non c'è un tubo, oppure una vendita o un'opzione, possiamo sovrascriverlo con una prenotazione
	// In questo modo gli affitti in essere NON vengono sovrascritti dalle prenotazioni in cui siamo dentro 
	if ($contratti[$rowcon['posto']]['tipo']==0 OR $contratti[$rowcon['posto']]['tipo']==2 OR $contratti[$rowcon['posto']]['tipo']==13)
	{
		$contratti[$rowcon['posto']]['ana']=$rowcon['ana'];
		$contratti[$rowcon['posto']]['tipo']=$rowcon['tipo'];
		$contratti[$rowcon['posto']]['barca']=$rowcon['barca'];
		$contratti[$rowcon['posto']]['inizio']=$rowcon['inizio'];
		$contratti[$rowcon['posto']]['fine']=$rowcon['fine'];
		$contratti[$rowpre['posto']]['presenza']='0';
	}
	// Altrimenti, se sul PB c'è una gestione
	elseif ($contratti[$rowcon['posto']]['tipo']==3)
	{
		$contratti[$rowcon['posto']]['ana']=$rowcon['ana'];
		$contratti[$rowcon['posto']]['tipo']='43';
		$contratti[$rowcon['posto']]['barca']=$rowcon['barca'];
		$contratti[$rowcon['posto']]['inizio']=$rowcon['inizio'];
		$contratti[$rowcon['posto']]['fine']=$rowcon['fine'];
		$contratti[$rowpre['posto']]['presenza']='0';
	}
}

// Carichiamo le prenotazioni future
$selcon_prenot="SELECT contratto_anagrafica2 AS ana,contratto_tipo AS tipo,contratto_barca AS barca,contratto_posto_barca AS posto,contratto_inizio AS inizio,contratto_fine AS fine FROM ".$tabelle['contratti']." WHERE contratto_anagrafica2>1 AND contratto_tipo='4' AND contratto_inizio>=NOW() AND contratto_fatturato_chiuso='0' ORDER BY contratto_posto_barca ASC";
$rescon_prenot=$sql->select_query($selcon_prenot);
while ($rowcon=mysql_fetch_assoc($rescon_prenot))
{
	// Se sul PB non c'è un tubo, oppure una vendita, oppure una gestione, possiamo sovrascriverlo con una prenotazione
	// In questo modo gli affitti in essere NON vengono sovrascritti dalle prenotazioni future 
	if ($contratti[$rowcon['posto']]['tipo']==0 OR $contratti[$rowcon['posto']]['tipo']==2 OR $contratti[$rowcon['posto']]['tipo']==13)
	{
		$contratti[$rowcon['posto']]['ana']=$rowcon['ana'];
		$contratti[$rowcon['posto']]['tipo']=$rowcon['tipo'];
		$contratti[$rowcon['posto']]['barca']=$rowcon['barca'];
		$contratti[$rowcon['posto']]['inizio']=$rowcon['inizio'];
		$contratti[$rowcon['posto']]['fine']=$rowcon['fine'];
		$contratti[$rowpre['posto']]['presenza']='0';
	}
	elseif ($contratti[$rowcon['posto']]['tipo']==3)
	{
		$contratti[$rowcon['posto']]['ana']=$rowcon['ana'];
		$contratti[$rowcon['posto']]['tipo']='43';
		$contratti[$rowcon['posto']]['barca']=$rowcon['barca'];
		$contratti[$rowcon['posto']]['inizio']=$rowcon['inizio'];
		$contratti[$rowcon['posto']]['fine']=$rowcon['fine'];
		$contratti[$rowpre['posto']]['presenza']='0';
	}
}


// Staccato dai contratti, ma comunque collegato, carichiamo le presenze
$selpre="SELECT presenza_posto_barca AS posto,presenza_cliente AS ana,presenza_barca AS barca,presenza_arrivo AS inizio,presenza_partenza AS fine FROM ".$tabelle['presenze']." WHERE presenza_arrivo<=NOW() AND (presenza_partenza='0000-00-00' OR presenza_partenza>=NOW()) ORDER BY presenza_posto_barca ASC";
$respre=$sql->select_query($selpre);
while ($rowpre=mysql_fetch_assoc($respre))
{
	$contratti[$rowpre['posto']]['ana']=$rowpre['ana'];
	$contratti[$rowpre['posto']]['barca']=$rowpre['barca'];
	$contratti[$rowpre['posto']]['inizio']=$rowpre['inizio'];
	$contratti[$rowpre['posto']]['fine']=$rowpre['fine'];
	$contratti[$rowpre['posto']]['presenza']='1';
}

// Tronchiamo la tabella appena prima di eseguire le INSERT
$truncate="TRUNCATE TABLE ".$tabelle['posti_barca_status'];
$sql->general_query($truncate);
// Iniziamo l'inserimento
$insert="INSERT INTO ".$tabelle['posti_barca_status']." (posto_barca, cliente, barca, inizio, fine, status, presenza, posto_barca_id) VALUES ";
foreach ($contratti as $k=>$v)
{
	if (!array_key_exists($k,$pb))
	{
		continue;
	}
	$values="(";
	$values.="'".$pb[$k]."',";
	$values.="'".$v['ana']."',";
	$values.="'".$v['barca']."',";
	$values.="'".$v['inizio']."',";
	$values.="'".$v['fine']."',";
	$values.="'".ucfirst($tipi[$v['tipo']])."',";
	$values.="'".$v['presenza']."', ";
	$values.="'".$k."'";
	$values.=")";
	$sql->insert_query($insert.$values);
}
// Carichiamo le informazioni sulle dimensioni dei posti barca
$select="SELECT pontile_codice,posto_barca_numero,dimensione_lunghezza,dimensione_larghezza FROM blue_pontili,blue_posti_barca,blue_dimensioni WHERE posto_barca_pontile=pontile_id AND dimensione_id=posto_barca_dimensioni ORDER BY posto_barca_id ASC";
$result=$sql->select_query($select);
while ($row=mysql_fetch_array($result))
{
	$lunghezza=number_format($row['dimensione_lunghezza'],2,",","");
	$larghezza=number_format($row['dimensione_larghezza'],2,",","");
	$dimensioni=$lunghezza." x ".$larghezza;
	$update="UPDATE blue_posti_barca_status SET posto_barca_dimensioni='".$dimensioni."' WHERE posto_barca='".$row['pontile_codice'] . "_" . $row['posto_barca_numero']."'";
	$sql->update_query($update);
}
