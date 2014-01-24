<?php
require_once("config.inc.php");
$valute=array('listino','imponibile','totale','imponibile_fattura','imposta','totale_fattura');

$campi=array("<NOMINATIVO>"=>"Nominativo di Prova",
			 "<INDIRIZZO>"=>"Via Milano, 1",
			 "<CAP>"=>"00138",
			 "<CITTA>"=>"Roma",
			 "<NAZIONE>"=>"Italia",
			 "<PROVINCIA>"=>"RM",
			 "<PARTITA_IVA>"=>"0123456789123456",
			 "<CODICE_FISCALE>"=>"ABCDEF12X56Q789X",
			 "<NUMERO_DOCUMENTO>"=>"100",
			 "<DATA>"=>date("d-m-Y",mktime()),
			 "<TIPO_DOCUMENTO>"=>"Fattura",
			 "<CONDIZIONI_PAGAMENTO>"=>"Rimessa Diretta",

			 "<DESCRIZIONE1>"=>"Oggetto",
			 "<U1>"=>"Kg",
			 "<Q1>"=>"1",
			 "<LISTINO1>"=>"1234,56",
			 "<SCONTO1>"=>"0",
			 "<IMPONIBILE1>"=>"2345,67",
			 "<IVA1>"=>"20%",
			 "<TOTALE1>"=>"5678,90",
			
			 "<ALIQUOTA>"=>"20%",
			 "<ESENTE_IVA>"=>"",
			 "<IMPONIBILE>"=>"2345,67",
			 "<IMPOSTA>"=>"500",
			 "<TOTALE>"=>"5678,90",
			 "<SPESE_TRASPORTO>"=>"",
			 "<SPESE_INCASSO>"=>"",
			 "<BOLLI>"=>"",
			 "<TOTALE_EURO>"=>"9999,99"
			);
			
// Questo per aggiornare il fatturato nella riga del contratto solo se l'attuale fatturato più quello nuovo non superano il totale del contratto
$chiavi=array_keys($campi);
$valori=array_values($campi);
$rtf=new RTF();
$rtf->carica_template("template/fattura.rtf");
$rtf->rtf_singolo($chiavi,$valori);
$rtf->output("Fattura.doc");
