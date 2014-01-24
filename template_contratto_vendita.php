<?php
require_once("config.inc.php");
foreach($_POST as $k=>$v)
{
	if (get_magic_quotes_gpc())
	{
		$$k=stripslashes($v);
	}
	else
	{
		$$k=$v;
	}
}
$sql_costo=str_replace(',','.',$costo);
$sql_costo_totale=str_replace(',','.',$costo_totale);
// Salviamo le informazioni relative ai dettagli del contratto
$contratto_id=$_SESSION['riepilogo']['contratto']['contratto_id'];
$select="SELECT * FROM blue_contratti_dettagli WHERE contratto_dettaglio_contratto_id='".$contratto_id."'";
$result=$sql->select_query($select);
$update="UPDATE blue_contratti SET contratto_imponibile='".$sql_costo."', contratto_totale='".$sql_costo_totale."' WHERE contratto_id='".$contratto_id."'";
$sql->update_query($update);
if ($sql->select_num_rows>0)
{
	$update="UPDATE blue_contratti_dettagli SET contratto_dettaglio_costo_lettere='".$costo_lettere."',contratto_dettaglio_iva_lettere='".$iva_lettere."',contratto_dettaglio_totale_lettere='".$costo_totale_lettere."',contratto_dettaglio_modalita_pagamento='".$modalita_pagamento."',contratto_dettaglio_oneri_anno='".$anno_oneri."',contratto_dettaglio_oneri_cifra='".$costo_oneri."',contratto_dettaglio_oneri_lettere='".$costo_oneri_lettere."',contratto_dettaglio_oneri_saldabili_mese='".$mese_oneri."' WHERE contratto_dettaglio_contratto_id='".$contratto_id."'";
	$sql->update_query($update);
}
else
{
	$insert="INSERT INTO blue_contratti_dettagli (contratto_dettaglio_contratto_id,contratto_dettaglio_costo_lettere,contratto_dettaglio_iva_lettere,contratto_dettaglio_totale_lettere,contratto_dettaglio_modalita_pagamento,contratto_dettaglio_oneri_anno,contratto_dettaglio_oneri_cifra,contratto_dettaglio_oneri_lettere,contratto_dettaglio_oneri_saldabili_mese) VALUES ('".$contratto_id."','".$costo_lettere."','".$iva_lettere."','".$costo_totale_lettere."','".$modalita_pagamento."','".$anno_oneri."','".$costo_oneri."','".$costo_oneri_lettere."','".$mese_oneri."')";
	$sql->insert_query($insert);
}

$campi=array(
			 "<NOMINATIVO>"=>$nominativo,
			 "<DATA_NASCITA>"=>$data_nascita,
			 "<LUOGO_NASCITA>"=>$luogo_nascita,
			 "<INDIRIZZO>"=>$indirizzo,
			 "<CAP>"=>$cap,
			 "<CITTA>"=>$citta,
			 "<NAZIONE>"=>$nazione,
			 "<PARTITA_IVA>"=>$partita_iva,
			 "<CODICE_FISCALE>"=>$codice_fiscale,
			 "<PONTILE>"=>$pontile,
			 "<POSTO_BARCA>"=>$posto_barca,
 			 "<LUNGHEZZA>"=>$lunghezza,
			 "<LARGHEZZA>"=>$larghezza,
 			 "<COSTO>"=>$costo,
			 "<COSTO_LETTERE>"=>$costo_lettere,
 			 "<COSTO_TOTALE>"=>$costo_totale,
			 "<COSTO_TOTALE_LETTERE>"=>$costo_totale_lettere,
 			 "<IVA>"=>$iva,
			 "<IVA_LETTERE>"=>$iva_lettere,
 			 "<MODALITA_PAGAMENTO>"=>$modalita_pagamento,
			 "<ANNO_ONERI>"=>$anno_oneri,
 			 "<MESE_ONERI>"=>$mese_oneri,
 			 "<COSTO_ONERI>"=>$costo_oneri,
			 "<COSTO_ONERI_LETTERE>"=>$costo_oneri_lettere,
			 "<DATA>"=>$data
			);
$chiavi=array_keys($campi);
$valori=array_values($campi);
$rtf=new RTF();
$rtf->carica_template("template/contratto_vendita.rtf");
$rtf->rtf_singolo($chiavi,$valori);
$rtf->output("Contratto di Vendita.doc");
?>