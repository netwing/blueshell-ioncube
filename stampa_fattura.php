<?php
require_once("config.inc.php");
$blue->autentica_utente("fatture","R");
$elenco_nazioni=$blue->elenco_nazioni();
$elenco_tipologie=$blue->elenco_tipologie();
$elenco_assicurazioni=$blue->elenco_assicurazioni();
$listino=0;
$sconto=0;
$imponibile=0;
$iva=0;
$totale=0;
if (array_key_exists("id",$_GET)) {
	$select_fattura="SELECT * FROM ".$tabelle['fatture']." WHERE fattura_id='".$_GET['id']."'";
	$result_fattura=$sql->select_query($select_fattura);
	$row_fattura=mysql_fetch_array($result_fattura);
	$data = $row_fattura['fattura_data'];

	$condizioni_pagamento=$row_fattura['fattura_condizioni_pagamento'];
	$numero_documento=$row_fattura['fattura_numero'];
	$spese_incasso=$row_fattura['fattura_spese_incasso'];
	$spese_trasporto=$row_fattura['fattura_spese_trasporto'];
	$bolli=$row_fattura['fattura_bolli'];
	if ($row_fattura['fattura_esente_iva']=="1")
	{
		$esente_iva='checked="checked"';
	}
	else
	{
		$esente_iva="";
	}
	$motivo_esente_iva=$row_fattura['fattura_motivo_esente_iva'];	// Andiamo a recuperare i dati della fattura

	// RECUPERIAMO info sul contratto
	$select_contratto="SELECT * FROM ".$tabelle['contratti']." WHERE contratto_id='".$row_fattura['fattura_contratto_id']."'";
	$result_contratto=$sql->select_query($select_contratto);
	$row_contratto=mysql_fetch_array($result_contratto);
	$_SESSION['riepilogo']['contratto']=$row_contratto;	

	$select_cliente="SELECT * FROM ".$tabelle['clienti']." WHERE cliente_id='".$row_fattura['fattura_cliente_id']."'";
	$result_cliente=$sql->select_query($select_cliente);
	$row_cliente=mysql_fetch_array($result_cliente);
	$_SESSION['riepilogo']['cliente']=$row_cliente;
	// Andiamo a recuperare i dati del cliente

	$select_fattura_righe="SELECT * FROM ".$tabelle['fatture_righe']." WHERE fattura_riga_fattura_id='".$_GET['id']."'";
	$result_fattura_righe=$sql->select_query($select_fattura_righe);
	$row_fattura_righe=mysql_fetch_array($result_fattura_righe);
	$descrizione=$row_fattura_righe['fattura_riga_descrizione'];
	$unita_misura=$row_fattura_righe['fattura_riga_um'];
	$quantita=$row_fattura_righe['fattura_riga_quantita'];
	$listino=$row_fattura_righe['fattura_riga_listino'];
	//$listino=$row_fattura_righe['fattura_riga_imponibile']/100*(100+$row_fattura_righe['fattura_riga_sconto']);
	$imponibile=$row_fattura_righe['fattura_riga_imponibile'];
	$sconto=$row_fattura_righe['fattura_riga_sconto'];
	$iva=$row_fattura_righe['fattura_riga_iva'];
	$aliquota=$iva;
	$totale=$row_fattura_righe['fattura_riga_totale'];
	$imponibile_fattura=$imponibile;
	$imposta=number_format($totale-$imponibile,2,".","");
	$totale_fattura=$totale;
	# Andiamo a recuperare le righe della fattura (per ora viene presa solo la prima)
}
elseif (array_key_exists("cli",$_GET))
{
	$select_cliente="SELECT * FROM ".$tabelle['clienti']." WHERE cliente_id='".intval($_GET['cli'])."'";
	$result_cliente=$sql->select_query($select_cliente);
	$row_cliente=mysql_fetch_array($result_cliente);
	$_SESSION['riepilogo']['cliente']=$row_cliente;
	# Andiamo a recuperare i dati del cliente
	$select_numdoc="SELECT MAX(fattura_numero+0) AS fattura_numero FROM ".$tabelle['fatture']." WHERE LEFT(fattura_data,4)='".date("Y",time())."'";
	$result_numdoc=$sql->select_query($select_numdoc);
	$numero_documento=mysql_result($result_numdoc,0,"fattura_numero");
	$numero_documento++;
	# Definiamo il numero documento in base all'ultimo doc inserito e lo incrementiamo di 1
	$spese_trasporto="";
	$spese_incasso="";
	$bolli="";
	$data = date("Y-m-d",time());
	$descrizione="";
	$select_prezzo="";
	$listino="";
	$imponibile="";
	$totale="";
	$imposta="";
	$sconto="";
	$totale_fattura=$totale;
	$unita_misura="";
	$iva = VAT_PERCENTAGE;
	$aliquota = VAT_PERCENTAGE;
	$quantita="1";
	$condizioni_pagamento="";
	$esente_iva="";
	$motivo_esente_iva="";
} else {
	// print_r($_SESSION['riepilogo']['contratto']);
	$select_prezzo="";
	$listino=$_SESSION['riepilogo']['contratto']['contratto_totale'];
	$totale=$_SESSION['riepilogo']['contratto']['contratto_totale'];
	$sconto=$_SESSION['riepilogo']['contratto']['contratto_sconto'];
	if ($sconto>0)
	{
		$totale=$totale-round($totale/100*$sconto,2);
	}
	$imposta=$totale-round($totale/ (100 + VAT_PERCENTAGE)*100,2);
	$unita_misura="";
	$iva = VAT_PERCENTAGE;
	$aliquota = VAT_PERCENTAGE;
	$imponibile=$totale-$imposta;
	$imponibile_fattura=$imponibile;
	$totale_fattura=$totale;
	$quantita="1";
	$condizioni_pagamento="";
	$esente_iva="";
	$motivo_esente_iva="";
	$select_numdoc="SELECT MAX(fattura_numero+0) AS fattura_numero FROM ".$tabelle['fatture']." WHERE LEFT(fattura_data,4)='".date("Y",time())."'";
	$result_numdoc=$sql->select_query($select_numdoc);
	$numero_documento=mysql_result($result_numdoc,0,"fattura_numero");
	$numero_documento++;
	# Definiamo il numero documento in base all'ultimo doc inserito e lo incrementiamo di 1
	$spese_trasporto="";
	$spese_incasso="";
	$bolli="";
	$data = date("Y-m-d",time());
	
	$dal=$sql->data_ita($_SESSION['riepilogo']['contratto']['contratto_inizio']);
	$dal_ts=$dal[4];
	$dal=$dal[0];
	$al=$sql->data_ita($_SESSION['riepilogo']['contratto']['contratto_fine']);
	$al_ts=$al[4];
	$al=$al[0];
	$durata=intval(($al_ts-$dal_ts)/(60*60*24));
	
	switch ($_SESSION['riepilogo']['contratto']['contratto_tipo'])
	{
		case "1";
		$descrizione="Ormeggio dal ".$dal." al ".$al." su Pontile ".$_SESSION['riepilogo']['pontile']['pontile_codice']."/".$_SESSION['riepilogo']['pontile']['posto_barca_numero'];
		break;
		case "2";
		$descrizione="Acquisto posto barca Pontile ".$_SESSION['riepilogo']['pontile']['pontile_codice']."/".$_SESSION['riepilogo']['pontile']['posto_barca_numero'];
		$descrizione2="Spese condominiali sul Pontile ".$_SESSION['riepilogo']['pontile']['pontile_codice']."/".$_SESSION['riepilogo']['pontile']['posto_barca_numero'];
		break;
		case "3";
		$descrizione="Gestione posto barca Pontile ".$_SESSION['riepilogo']['pontile']['pontile_codice']."/".$_SESSION['riepilogo']['pontile']['posto_barca_numero'];
		break;
		case "4";
		$descrizione="Ormeggio dal ".$dal." al ".$al." su Pontile ".$_SESSION['riepilogo']['pontile']['pontile_codice']."/".$_SESSION['riepilogo']['pontile']['posto_barca_numero'];
		break;		
		case "11";
		$descrizione="Ormeggio dal ".$dal." al ".$al." su Pontile ".$_SESSION['riepilogo']['pontile']['pontile_codice']."/".$_SESSION['riepilogo']['pontile']['posto_barca_numero'];
		break;		
		default;
		$descrizione="Inserire la descrizione";
		break;
	}
	$select_listino="SELECT listino_posto_barca_anno,costo_condominiale FROM ".$tabelle['listini_posti_barca'].",".$tabelle['posti_barca']." WHERE listino_posto_barca_dimensione=posto_barca_dimensioni AND posto_barca_id='".$_SESSION['riepilogo']['contratto']['contratto_posto_barca']."' ORDER BY listino_posto_barca_anno";
	$result_listino=$sql->select_query($select_listino);
	# Raccogliamo i costi sui listini
}

require_once "views/invoice/print.php"; 