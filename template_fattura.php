<?php
require_once("config.inc.php");
$valute=array('listino','imponibile','totale','imponibile_fattura','imposta','totale_fattura');
foreach($_POST as $k=>$v)
{
	if (get_magic_quotes_gpc()) {
		$$k=stripslashes($v);
	} else {
		$$k=$v;
	}
	if (in_array($k,$valute)) {
		$$k=str_replace(',','.',$$k);
		$$k=number_format($$k,2,'.','');
	}	
}
$campi=array("<NOMINATIVO>"=>$nominativo,
			 "<INDIRIZZO>"=>$indirizzo,
			 "<CAP>"=>$cap,
			 "<CITTA>"=>$citta,
			 "<NAZIONE>"=>$nazione,
			 "<PROVINCIA>"=>$provincia,
			 "<PARTITA_IVA>"=>$partita_iva,
			 "<CODICE_FISCALE>"=>$codice_fiscale,
			 "<NUMERO_DOCUMENTO>"=>$numero_documento,
			 "<DATA>"=>$data_user,
			 "<TIPO_DOCUMENTO>"=>$tipo_documento,
			 "<CONDIZIONI_PAGAMENTO>"=>$condizioni_pagamento,

			 "<DESCRIZIONE1>"=>$descrizione,
			 "<U1>"=>$unita_misura,
			 "<Q1>"=>$quantita,
			 "<LISTINO1>"=>number_format($listino,2,",","."),
			 "<SCONTO1>"=>$sconto,
			 "<IMPONIBILE1>"=>number_format($imponibile,2,",","."),
			 "<IVA1>"=>$iva,
			 "<TOTALE1>"=>number_format($totale,2,",","."),
			
			 "<ALIQUOTA>"=>$aliquota,
			 "<ESENTE_IVA>"=>$motivo_esente_iva,
			 "<IMPONIBILE>"=>number_format($imponibile_fattura,2,",","."),
			 "<IMPOSTA>"=>number_format($imposta,2,",","."),
			 "<TOTALE>"=>number_format($totale_fattura,2,",","."),
			 "<SPESE_TRASPORTO>"=>$spese_trasporto,
			 "<SPESE_INCASSO>"=>$spese_incasso,
			 "<BOLLI>"=>$bolli,
			 "<TOTALE_EURO>"=>number_format(($totale_fattura+$spese_trasporto+$spese_incasso+$bolli),2,",",".")
			);
			
if (array_key_exists('save', $_POST) and $_POST['save'] !== null) {
	$fattura_cliente_id=$_SESSION['riepilogo']['cliente']['cliente_id'];
	$fattura_contratto_id=$_SESSION['riepilogo']['contratto']['contratto_id'];
	$fattura_numero=$sql->pulisci($numero_documento);
	$fattura_data=$sql->data_sql($data);
	$fattura_data=$fattura_data[0];
	$fattura_condizioni_pagamento=$sql->pulisci($condizioni_pagamento);
	$fattura_spese_incasso=$spese_incasso;
	$fattura_spese_trasporto=$spese_trasporto;
	$fattura_bolli=$bolli;
	if (array_key_exists("esente_iva",$_POST))
	{
		$fattura_esente_iva=1;
	}
	else
	{
		$fattura_esente_iva=0;
	}
	$fattura_motivo_esente_iva=$sql->pulisci($motivo_esente_iva);
	$descrizione=$sql->pulisci($descrizione);
	if (array_key_exists("fattura_id",$_POST))
	{
		$update="UPDATE ".$tabelle['fatture']." SET fattura_cliente_id='".$fattura_cliente_id."',fattura_numero='".$fattura_numero."',fattura_data='".$fattura_data."',fattura_condizioni_pagamento='".$fattura_condizioni_pagamento."',fattura_spese_incasso='".$fattura_spese_incasso."',fattura_spese_trasporto='".$fattura_spese_trasporto."',fattura_bolli='".$fattura_bolli."',fattura_esente_iva='".$fattura_esente_iva."',fattura_motivo_esente_iva='".$fattura_motivo_esente_iva."',fattura_contratto_id='".$fattura_contratto_id."' WHERE fattura_id='".$_POST['fattura_id']."'";
		$sql->update_query($update);
		$select_righe_aggiornare="SELECT fattura_riga_id FROM ".$tabelle['fatture_righe']." WHERE fattura_riga_fattura_id='".$_POST['fattura_id']."'";
		$result_righe_aggiornare=$sql->select_query($select_righe_aggiornare);
		if ($sql->select_num_rows>0)
		{
			while ($row=mysql_fetch_array($result_righe_aggiornare))
			{
				$update="UPDATE ".$tabelle['fatture_righe']." SET fattura_riga_descrizione='".$descrizione."',fattura_riga_um='".$unita_misura."',fattura_riga_quantita='".$quantita."',fattura_riga_listino='".$listino."',fattura_riga_sconto='".$sconto."',fattura_riga_imponibile='".$imponibile."',fattura_riga_iva='".$iva."',fattura_riga_totale='".$totale."' WHERE fattura_riga_id='".$row['fattura_riga_id']."'";
				$sql->update_query($update);
			}
		}
		else
		{
			$insert="INSERT INTO ".$tabelle['fatture_righe']." (fattura_riga_fattura_id,fattura_riga_descrizione,fattura_riga_um,fattura_riga_quantita,fattura_riga_listino,fattura_riga_sconto,fattura_riga_imponibile,fattura_riga_iva,fattura_riga_totale) VALUES ('".$_POST['fattura_id']."','".$descrizione."','".$unita_misura."','".$quantita."','".$listino."','".$sconto."','".$imponibile."','".$iva."','".$totale."')";
			$sql->insert_query($insert);
			// Inserimento della riga di fatturazione
		}
	}
	else
	{
		$insert="INSERT INTO ".$tabelle['fatture']." (fattura_cliente_id,fattura_numero,fattura_data,fattura_condizioni_pagamento,fattura_spese_incasso,fattura_spese_trasporto,fattura_bolli,fattura_esente_iva,fattura_motivo_esente_iva,fattura_contratto_id) VALUES ('".$fattura_cliente_id."','".$fattura_numero."','".$fattura_data."','".$fattura_condizioni_pagamento."','".$fattura_spese_incasso."','".$fattura_spese_trasporto."','".$fattura_bolli."','".$fattura_esente_iva."','".$fattura_motivo_esente_iva."','".$fattura_contratto_id."') ";
		$sql->insert_query($insert);
		$fattura_id=$sql->insert_last_id;
		// Inserimento dei dati della fattura (cliente, numero del documento, data, info secondarie)
		$insert="INSERT INTO ".$tabelle['fatture_righe']." (fattura_riga_fattura_id,fattura_riga_descrizione,fattura_riga_um,fattura_riga_quantita,fattura_riga_listino,fattura_riga_sconto,fattura_riga_imponibile,fattura_riga_iva,fattura_riga_totale) VALUES ('".$fattura_id."','".$descrizione."','".$unita_misura."','".$quantita."','".$listino."','".$sconto."','".$imponibile."','".$iva."','".$totale."')";
		$sql->insert_query($insert);
		// Inserimento della riga di fatturazione
        
        // INserimento della riga di prima nota
        $insert = "INSERT INTO " . $tabelle['prima_nota'] . " (prima_nota_data, prima_nota_descrizione, prima_nota_fattura_id, prima_nota_entrata, prima_nota_uscita, prima_nota_categoria, prima_nota_mezzo_scambio)
                   VALUES (NOW(), 'Fattura n. " . $fattura_numero . "', '" . $fattura_id . "', '" . $totale . "', 0, 'Incasso fattura', '')";
        $sql->insert_query($insert);
    
    }
	
    // Se da stampa_fattura.php ci viene passato un fattura_id, eseguiamo un update invece di un insert
	if (array_key_exists("aggiungi_aggiorna",$_POST))
	{
		if ($_POST['aggiungi_aggiorna']=="aggiungi")
		{
			$update="UPDATE ".$tabelle['contratti']." SET contratto_fatturato=contratto_fatturato+".$totale." WHERE contratto_id='".$_SESSION['riepilogo']['contratto']['contratto_id']."'";
			$sql->update_query($update);
		}
		elseif ($_POST['aggiungi_aggiorna']=="aggiorna")
		{
			$update="UPDATE ".$tabelle['contratti']." SET contratto_fatturato=".$totale." WHERE contratto_id='".$_SESSION['riepilogo']['contratto']['contratto_id']."'";	
			$sql->update_query($update);
		}
	}
	// Questo per aggiornare il fatturato nella riga del contratto solo se l'attuale fatturato più quello nuovo non superano il totale del contratto
	header("Location:stampa_fattura.php?id=".$fattura_id);
	exit;
	// Dopo il salvataggio della fattura, rispediamo l'utente alla pagina di stampa della fattura
}
elseif (array_key_exists('save_and_print', $_POST) and $_POST['save_and_print'] !== null) {
	$fattura_cliente_id=$_SESSION['riepilogo']['cliente']['cliente_id'];
	$fattura_contratto_id=$_SESSION['riepilogo']['contratto']['contratto_id'];	
	$fattura_numero=$sql->pulisci($numero_documento);
	$fattura_data=$sql->data_sql($data);
	$fattura_data=$fattura_data[0];
	$fattura_condizioni_pagamento=$sql->pulisci($condizioni_pagamento);
	$fattura_spese_incasso=$spese_incasso;
	$fattura_spese_trasporto=$spese_trasporto;
	$fattura_bolli=$bolli;
	if (array_key_exists("esente_iva",$_POST))
	{
		$fattura_esente_iva=1;
	}
	else
	{
		$fattura_esente_iva=0;
	}
	$fattura_motivo_esente_iva=$sql->pulisci($motivo_esente_iva);
	$descrizione=$sql->pulisci($descrizione);
	if (array_key_exists("fattura_id",$_POST))
	{
		$update="UPDATE ".$tabelle['fatture']." SET fattura_cliente_id='".$fattura_cliente_id."',fattura_numero='".$fattura_numero."',fattura_data='".$fattura_data."',fattura_condizioni_pagamento='".$fattura_condizioni_pagamento."',fattura_spese_incasso='".$fattura_spese_incasso."',fattura_spese_trasporto='".$fattura_spese_trasporto."',fattura_bolli='".$fattura_bolli."',fattura_esente_iva='".$fattura_esente_iva."',fattura_motivo_esente_iva='".$fattura_motivo_esente_iva."',fattura_contratto_id='".$fattura_contratto_id."' WHERE fattura_id='".$_POST['fattura_id']."'";
		$sql->update_query($update);
		$select_righe_aggiornare="SELECT fattura_riga_id FROM ".$tabelle['fatture_righe']." WHERE fattura_riga_fattura_id='".$_POST['fattura_id']."'";
		$result_righe_aggiornare=$sql->select_query($select_righe_aggiornare);
		while ($row=mysql_fetch_array($result_righe_aggiornare))
		{
			$update="UPDATE ".$tabelle['fatture_righe']." SET fattura_riga_descrizione='".$descrizione."',fattura_riga_um='".$unita_misura."',fattura_riga_quantita='".$quantita."',fattura_riga_listino='".$listino."',fattura_riga_sconto='".$sconto."',fattura_riga_imponibile='".$imponibile."',fattura_riga_iva='".$iva."',fattura_riga_totale='".$totale."' WHERE fattura_riga_id='".$row['fattura_riga_id']."'";
			$sql->update_query($update);
		}
	}
	else
	{
		$insert="INSERT INTO ".$tabelle['fatture']." (fattura_cliente_id,fattura_numero,fattura_data,fattura_condizioni_pagamento,fattura_spese_incasso,fattura_spese_trasporto,fattura_bolli,fattura_esente_iva,fattura_motivo_esente_iva,fattura_contratto_id) VALUES ('".$fattura_cliente_id."','".$fattura_numero."','".$fattura_data."','".$fattura_condizioni_pagamento."','".$fattura_spese_incasso."','".$fattura_spese_trasporto."','".$fattura_bolli."','".$fattura_esente_iva."','".$fattura_motivo_esente_iva."','".$fattura_contratto_id."') ";
		$sql->insert_query($insert);
		$fattura_id=$sql->insert_last_id;
		// Inserimento dei dati della fattura (cliente, numero del documento, data, info secondarie)
		$insert="INSERT INTO ".$tabelle['fatture_righe']." (fattura_riga_fattura_id,fattura_riga_descrizione,fattura_riga_um,fattura_riga_quantita,fattura_riga_listino,fattura_riga_sconto,fattura_riga_imponibile,fattura_riga_iva,fattura_riga_totale) VALUES ('".$fattura_id."','".$descrizione."','".$unita_misura."','".$quantita."','".$listino."','".$sconto."','".$imponibile."','".$iva."','".$totale."')";
		$sql->insert_query($insert);
		// Inserimento della riga di fatturazione
        
        // INserimento della riga di prima nota
        $insert = "INSERT INTO " . $tabelle['prima_nota'] . " (prima_nota_data, prima_nota_descrizione, prima_nota_fattura_id, prima_nota_entrata, prima_nota_uscita, prima_nota_categoria, prima_nota_mezzo_scambio)
                   VALUES (NOW(), 'Fattura n. " . $fattura_numero . "', '" . $fattura_id . "', '" . $totale . "', 0, 'Incasso fattura', '')";
        $sql->insert_query($insert);
	}
	// Se da stampa_fattura.php ci viene passato un fattura_id, eseguiamo un update invece di un insert
	if (array_key_exists("aggiungi_aggiorna",$_POST))
	{
		if ($_POST['aggiungi_aggiorna']=="aggiungi")
		{	
			$update="UPDATE ".$tabelle['contratti']." SET contratto_fatturato=contratto_fatturato+".$totale." WHERE contratto_id='".$_SESSION['riepilogo']['contratto']['contratto_id']."'";
			$sql->update_query($update);
		}
		elseif ($_POST['aggiungi_aggiorna']=="aggiorna")
		{
			$update="UPDATE ".$tabelle['contratti']." SET contratto_fatturato=".$totale." WHERE contratto_id='".$_SESSION['riepilogo']['contratto']['contratto_id']."'";	
			$sql->update_query($update);
		}
	}
	// Questo per aggiornare il fatturato nella riga del contratto solo se l'attuale fatturato più quello nuovo non superano il totale del contratto
	$chiavi=array_keys($campi);
	$valori=array_values($campi);
	$rtf=new RTF();
	$rtf->carica_template("template/fattura.rtf");
	$rtf->rtf_singolo($chiavi,$valori);
	$rtf->output("Fattura.doc");
}
?>