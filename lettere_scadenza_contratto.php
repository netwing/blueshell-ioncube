<?php
require_once("config.inc.php");
$blue->autentica_utente("documenti","R");
if (!array_key_exists("contratto_fine_dal",$_POST) or !array_key_exists("contratto_fine_al",$_POST))
{
	header("Location:contratti_scadenze.php");
	exit;
}

$inizio = $_POST['contratto_fine_dal'];
$fine = $_POST['contratto_fine_al'];

$select_contratti="SELECT contratto_id,contratto_fine,cliente_id,cliente_nominativo,cliente_indirizzo,cliente_cap,cliente_citta,cliente_provincia,barca_nome,pontile_codice,posto_barca_id,posto_barca_numero FROM ".$tabelle['contratti'].",".$tabelle['clienti'].",".$tabelle['barche'].",".$tabelle['pontili'].",".$tabelle['posti_barca']." WHERE contratto_tipo='1' AND cliente_id=contratto_anagrafica2 AND barca_id=contratto_barca AND posto_barca_id=contratto_posto_barca AND pontile_id=posto_barca_pontile AND contratto_fine BETWEEN '".$inizio."' AND '".$fine."' AND cliente_rifiuta_comunicazioni=0";
$result_contratti=$sql->select_query($select_contratti);
$ricerca_sostituzione=array();
while ($row_contratti=mysql_fetch_array($result_contratti))
{
	$cliente=$row_contratti['cliente_nominativo'];
	$indirizzo=$row_contratti['cliente_indirizzo'];
	$cap=$row_contratti['cliente_cap'];
	$citta=$row_contratti['cliente_citta'];
	$provincia=$row_contratti['cliente_provincia'];
	$data = date("d-m-Y", time());
	$pontile=$row_contratti['pontile_codice'];
	$posto_barca=$row_contratti['posto_barca_numero'];
	$barca=$row_contratti['barca_nome'];
	$fine=$sql->data_ita($row_contratti['contratto_fine']);
	$scadenza=$fine[0];
	$ricerca_sostituzione[]=array("<NOMINATIVO>"=>$cliente,
								  "<INDIRIZZO>"=>$indirizzo,
								  "<CAP>"=>$cap,
								  "<CITTA>"=>$citta,
								  "<PROVINCIA>"=>$provincia,
								  "<DATA>"=>$data,
								  "<PONTILE>"=>$pontile,
								  "<POSTO_BARCA>"=>$posto_barca,
								  "<IMBARCAZIONE>"=>$barca,
								  "<SCADENZA>"=>$scadenza
								  );
}
$rtf=new RTF();
$rtf->carica_template("template/lettera_scadenza.rtf");
$rtf->rtf_multiplo($ricerca_sostituzione);
$rtf->output("Lettere_Scadenza_Contratti.doc");
