<?php
// Funzioni per CPAINT/Ajax
require_once('config.inc.php');
//error_reporting("E_ALL");
// Libreria CPAINT
require_once('cpaint/cpaint2.inc.php');
$cp=new cpaint();

function cliente_cerca($where='')
{
	global $sql;
	global $cp;
	$where=htmlentities(utf8_decode($where));
	$res=$sql->select_query("SELECT cliente_id,cliente_nominativo FROM blue_clienti WHERE cliente_nominativo LIKE '%".$where."%' ORDER BY cliente_nominativo ASC LIMIT 0,50");
	$record=&$cp->add_node('record');
	$record->set_data($sql->select_num_rows);
	$query=&$cp->add_node('query');
	$query->set_data($where);
	
	while ($row=mysql_fetch_array($res))
	{
		$id=&$cp->add_node('clienteid');
		$id->set_data($row['cliente_id']);
		$nominativo=&$cp->add_node('clientenominativo');
		$nominativo->set_data(utf8_encode(html_entity_decode($row['cliente_nominativo'])));
	}
	
}
$cp->register('cliente_cerca');
//cliente_cerca('benad');

function barca_cerca($proprietario='')
{
	global $sql;
	global $cp;
//	echo "SELECT barca_id,barca_nome FROM blue_barche WHERE barca_proprietario='".$proprietario."' ORDER BY barca_nome ASC";
	$res=$sql->select_query("SELECT barca_id,barca_nome FROM blue_barche WHERE barca_proprietario='".$proprietario."' ORDER BY barca_nome ASC");
	$record=&$cp->add_node('record');
	$record->set_data($sql->select_num_rows);
	$id=&$cp->add_node('barcaid');
	$id->set_data('0');
	$nominativo=&$cp->add_node('barcanome');
	$nominativo->set_data('Non Disponibile o Non Necessaria');
	while ($row=mysql_fetch_array($res))
	{
		$id=&$cp->add_node('barcaid');
		$id->set_data($row['barca_id']);
		$nominativo=&$cp->add_node('barcanome');
		$nominativo->set_data($row['barca_nome']);
	}
	
}
$cp->register('barca_cerca');
//barca_cerca(1);

function caricapostibarca($dimensioni)
{
	global $sql;
	global $cp;
	// Carichiamo tutti i posti barca di quel pontile
	$res=$sql->select_query("SELECT posto_barca_id,pontile_codice,posto_barca_numero FROM blue_posti_barca,blue_pontili WHERE pontile_id=posto_barca_pontile AND posto_barca_dimensioni='".$dimensioni."' AND posto_barca_disponibile='1' ORDER BY posto_barca_pontile ASC, posto_barca_numero ASC");
	$record=&$cp->add_node('record');
	$record->set_data($sql->select_num_rows);
	while ($row=mysql_fetch_array($res))
	{
		$id=&$cp->add_node('postobarcaid');
		$id->set_data($row['posto_barca_id']);
		$nominativo=&$cp->add_node('postobarca');
		$nominativo->set_data($row['pontile_codice'].$row['posto_barca_numero']);
	}
}
$cp->register('caricapostibarca');
//caricapostibarca(10,'','');

function caricacostipostobarca($dimensioni)
{
	global $sql;
	global $cp;
	$anno_attuale=date('Y',time());
	$res=$sql->select_query("SELECT	costo_giornaliero,costo_e1,costo_e2,costo_em,costo_es,costo_i1,costo_i2,costo_im,costo_is,costo_annuale FROM blue_listini_posti_barca WHERE listino_posto_barca_dimensione='".$dimensioni."' AND listino_posto_barca_anno='".$anno_attuale."'");
	$record=&$cp->add_node('record');
	$record->set_data(10);
	$row=mysql_fetch_array($res);
	$id=&$cp->add_node('costo1');
	$id->set_data($row['costo_giornaliero']);
	$nominativo=&$cp->add_node('etichettacosto1');
	$nominativo->set_data('Giornaliero - '.$row['costo_giornaliero']);
	$id=&$cp->add_node('costo1');
	$id->set_data($row['costo_e1']);
	$nominativo=&$cp->add_node('etichettacosto1');
	$nominativo->set_data('1 Settimana Estiva - '.$row['costo_e1']);
	$id=&$cp->add_node('costo1');
	$id->set_data($row['costo_e2']);
	$nominativo=&$cp->add_node('etichettacosto1');
	$nominativo->set_data('2 Settimane Estive - '.$row['costo_e2']);
	$id=&$cp->add_node('costo1');
	$id->set_data($row['costo_em']);
	$nominativo=&$cp->add_node('etichettacosto1');
	$nominativo->set_data('Mese Estivo - '.$row['costo_em']);
	$id=&$cp->add_node('costo1');
	$id->set_data($row['costo_es']);
	$nominativo=&$cp->add_node('etichettacosto1');
	$nominativo->set_data('Stagione Estiva - '.$row['costo_es']);
	$id=&$cp->add_node('costo1');
	$id->set_data($row['costo_i1']);
	$nominativo=&$cp->add_node('etichettacosto1');
	$nominativo->set_data('1 Settimana Invernale - '.$row['costo_i1']);
	$id=&$cp->add_node('costo1');
	$id->set_data($row['costo_i2']);
	$nominativo=&$cp->add_node('etichettacosto1');
	$nominativo->set_data('2 Settimane Invernali - '.$row['costo_i2']);
	$id=&$cp->add_node('costo1');
	$id->set_data($row['costo_im']);
	$nominativo=&$cp->add_node('etichettacosto1');
	$nominativo->set_data('Mese Invernale - '.$row['costo_im']);
	$id=&$cp->add_node('costo1');
	$id->set_data($row['costo_is']);
	$nominativo=&$cp->add_node('etichettacosto1');
	$nominativo->set_data('Stagione Invernale - '.$row['costo_is']);
	$id=&$cp->add_node('costo1');
	$id->set_data($row['costo_annuale']);
	$nominativo=&$cp->add_node('etichettacosto1');
	$nominativo->set_data('Annuale - '.$row['costo_annuale']);
	$anno_successivo=$anno_attuale+1;
	$res=$sql->select_query("SELECT	costo_giornaliero,costo_e1,costo_e2,costo_em,costo_es,costo_i1,costo_i2,costo_im,costo_is,costo_annuale FROM blue_listini_posti_barca WHERE listino_posto_barca_dimensione='".$dimensioni."' AND listino_posto_barca_anno='".$anno_successivo."'");
	$row=mysql_fetch_array($res);
	$id=&$cp->add_node('costo2');
	$id->set_data($row['costo_giornaliero']);
	$nominativo=&$cp->add_node('etichettacosto2');
	$nominativo->set_data('Giornaliero - '.$row['costo_giornaliero']);
	$id=&$cp->add_node('costo2');
	$id->set_data($row['costo_e1']);
	$nominativo=&$cp->add_node('etichettacosto2');
	$nominativo->set_data('1 Settimana Estiva - '.$row['costo_e1']);
	$id=&$cp->add_node('costo2');
	$id->set_data($row['costo_e2']);
	$nominativo=&$cp->add_node('etichettacosto2');
	$nominativo->set_data('2 Settimane Estive - '.$row['costo_e2']);
	$id=&$cp->add_node('costo2');
	$id->set_data($row['costo_em']);
	$nominativo=&$cp->add_node('etichettacosto2');
	$nominativo->set_data('Mese Estivo - '.$row['costo_em']);
	$id=&$cp->add_node('costo2');
	$id->set_data($row['costo_es']);
	$nominativo=&$cp->add_node('etichettacosto2');
	$nominativo->set_data('Stagione Estiva - '.$row['costo_es']);
	$id=&$cp->add_node('costo2');
	$id->set_data($row['costo_i1']);
	$nominativo=&$cp->add_node('etichettacosto2');
	$nominativo->set_data('1 Settimana Invernale - '.$row['costo_i1']);
	$id=&$cp->add_node('costo2');
	$id->set_data($row['costo_i2']);
	$nominativo=&$cp->add_node('etichettacosto2');
	$nominativo->set_data('2 Settimane Invernali - '.$row['costo_i2']);
	$id=&$cp->add_node('costo2');
	$id->set_data($row['costo_im']);
	$nominativo=&$cp->add_node('etichettacosto2');
	$nominativo->set_data('Mese Invernale - '.$row['costo_im']);
	$id=&$cp->add_node('costo2');
	$id->set_data($row['costo_is']);
	$nominativo=&$cp->add_node('etichettacosto2');
	$nominativo->set_data('Stagione Invernale - '.$row['costo_is']);
	$id=&$cp->add_node('costo2');
	$id->set_data($row['costo_annuale']);
	$nominativo=&$cp->add_node('etichettacosto2');
	$nominativo->set_data('Annuale - '.$row['costo_annuale']);	
}
$cp->register('caricacostipostobarca');

function calcola($prezzo_listino,$iva,$sconto)
{
	global $cp;
	$prezzo_listino=str_replace(',','.',$prezzo_listino);
	// Se l'IVA e' compresa nella cifra inserita, eseguiamo lo scorporo
	if ($iva=='compresa')
	{
		$imposta=round($prezzo_listino/121*21,2);
		$totale=$prezzo_listino;
		$imponibile=$totale-$imposta;
	}
	// Se l'IVA e' esclusa dalla cifra, la calcoliamo e la aggiungiamo
	elseif ($iva=='esclusa')
	{
		$imposta=round($prezzo_listino/100*21,2);
		$imponibile=$prezzo_listino;
		$totale=$prezzo_listino+$imposta;		
	}
	// Se l'IVA e' esente, non la consideriamo e teniamo imponibile e totale uguali al prezzo di listino ed imposta a zero
	elseif ($iva='esente')
	{
		$imponibile=$prezzo_listino;
		$imposta=0;
		$totale=$prezzo_listino;	
	}
	$imponibile_scontato=$imponibile;
	$imposta_scontata=$imposta;
	$totale_scontato=$totale;
	if ($sconto>0)
	{
		$imponibile_scontato=$imponibile-round($imponibile/100*$sconto,2);
		$imposta_scontata=$imposta-round($imposta/100*$sconto,2);
		$totale_scontato=$totale-round($totale/100*$sconto,2);
	}
	$nodo1=&$cp->add_node('prezzolistino');
	$nodo1->set_data(number_format($prezzo_listino,2,'.',''));
	$nodo2=&$cp->add_node('imponibile');
	$nodo2->set_data(number_format($imponibile,2,'.',''));
	$nodo3=&$cp->add_node('imposta');
	$nodo3->set_data(number_format($imposta,2,'.',''));
	$nodo4=&$cp->add_node('totale');
	$nodo4->set_data(number_format($totale,2,'.',''));
	$nodo5=&$cp->add_node('imponibilescontato');
	$nodo5->set_data(number_format($imponibile_scontato,2,'.',''));
	$nodo6=&$cp->add_node('impostascontata');
	$nodo6->set_data(number_format($imposta_scontata,2,'.',''));
	$nodo7=&$cp->add_node('totalescontato');
	$nodo7->set_data(number_format($totale_scontato,2,'.',''));
}
$cp->register('calcola');

function caricainfopostobarca($pb,$inizio,$fine)
{
	global $sql;
	global $cp;
	/* Parte per caricare il proprietario ed il gestore */
	$res=$sql->select_query("SELECT posto_barca_proprietario,posto_barca_proprietario_data,posto_barca_gestore,posto_barca_gestore_data,posto_barca_gestore_data_fine FROM blue_posti_barca WHERE posto_barca_id='".$pb."'");
	$proprietario_data=$sql->data_ita(mysql_result($res,0,'posto_barca_proprietario_data'));
	$prop_id=mysql_result($res,0,'posto_barca_proprietario');
	$prop=$sql->select_query("SELECT cliente_nominativo FROM blue_clienti WHERE cliente_id='".$prop_id."'");
	$proprietario=mysql_result($prop,0,'cliente_nominativo');
	$nodo1=&$cp->add_node('proprietario');
	$nodo1->set_data("PROPRIETARIO<br /> <strong>".$proprietario."</strong> dal <strong>".$proprietario_data[0]."</strong>");
	$gest_dal=$sql->data_ita(mysql_result($res,0,'posto_barca_gestore_data'));
	$gest_al=$sql->data_ita(mysql_result($res,0,'posto_barca_gestore_data_fine'));
	$gest_id=mysql_result($res,0,'posto_barca_gestore');
	$gest=$sql->select_query("SELECT cliente_nominativo FROM blue_clienti WHERE cliente_id='".$gest_id."'");
	$gestore=mysql_result($gest,0,'cliente_nominativo');
	$nodo2=&$cp->add_node('gestore');
	$nodo2->set_data("GESTORE<br /> <strong>".$gestore."</strong> dal <strong>".$gest_dal[0]."</strong> al <strong>".$gest_al[0]."</strong>");
	/* Fine parte relativa al proprietario e gestore */
	
	/* Parte relativa ad eventuali contratti Affitto/Transito/Prenotazione nel periodo */
	$query="SELECT contratto_id FROM blue_contratti WHERE contratto_posto_barca='".$pb."' AND (contratto_tipo=1 OR contratto_tipo=4 OR contratto_tipo=11) AND (contratto_inizio<='".$fine."' AND contratto_fine>='".$inizio."')";
	$q=&$cp->add_node('query');
	$q->set_data($query);
	$res=$sql->select_query("SELECT contratto_id,contratto_anagrafica2,contratto_inizio,contratto_fine,contratto_tipo FROM blue_contratti WHERE contratto_posto_barca='".$pb."' AND (contratto_tipo=1 OR contratto_tipo=4 OR contratto_tipo=11) AND (contratto_inizio<='".$fine."' AND contratto_fine>='".$inizio."')");
	$contratti='';
	while ($r=mysql_fetch_array($res))
	{
		$dal=$sql->data_ita($r['contratto_inizio']);
		$al=$sql->data_ita($r['contratto_fine']);
		$rescli=$sql->select_query("SELECT cliente_nominativo FROM blue_clienti WHERE cliente_id='".$r['contratto_anagrafica2']."'");
		$cli=mysql_result($rescli,0,'cliente_nominativo');
		$id=&$cp->add_node('contratto');
		$id->set_data("AFFITTO/TRANSITO ATTUALE<br /><a href=\"riepilogo.php?id=".$r['contratto_id']."\">".$cli."</a> (".$dal[0]." - ".$al[0].")<br />");
	}
	/* Fine parte relativa ai contratti rompiscatole nel periodo */
}
$cp->register('caricainfopostobarca');
//caricainfopostobarca(1344);

function calcola2($listino,$sconto,$imponibile,$iva,$totale)
{
	global $cp;
	$listino=str_replace(',','.',$listino);
	$imponibile=str_replace(',','.',$imponibile);
	$totale=str_replace(',','.',$totale);
	// Se il prezzo di listino viene passato
	if ($listino<>0 and $listino!='')
	{
		// Il totale fattura è il prezzo di listino con applicato lo sconto
		$totale=$listino-($listino/100*$sconto);
		// L'imponibile è il totale scorporato dell'iva
		$imponibile=$totale*100/(100+$iva);
	}
	// Altrimenti, se viene passato almeno l'imponibile
	elseif ($imponibile<>0 and $imponibile!='')
	{
		// Il totale è l'imponibile + l'iva
		$totale=$imponibile+($imponibile/100*$iva);
		// Il listino è il totale + l'eventuale sconto
		$listino=$totale+($totale/100*$sconto);
	}
	// Altrimenti, se viene passato almeno il totale
	elseif ($totale<>0 and $totale!='')
	{
		// Il listino è il totale + l'eventuale sconto
		$listino=$totale+($totale/100*$sconto);
		// L'imponibile è il totale scorporato dall'iva
		$imponibile=$totale*100/(100+$iva);
	}
	$nodo1=&$cp->add_node('listino');
	$nodo1->set_data(number_format($listino,2,",",""));	
	$nodo2=&$cp->add_node('imponibile');
	$nodo2->set_data(number_format($imponibile,2,",",""));
	$nodo2b=&$cp->add_node('iva');
	$nodo2b->set_data(number_format($totale-$imponibile,2,",",""));		
	$nodo3=&$cp->add_node('totale');
	$nodo3->set_data(number_format($totale,2,",",""));
}
$cp->register('calcola2');
//calcola2(0,0,0,20,-1200);

$cp->start();
$cp->return_data();
?>
