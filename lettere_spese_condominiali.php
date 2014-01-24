<?php
require_once("config.inc.php");
$blue->autentica_utente("documenti","R");
$anno=$_POST['anno'];
$rendita=$_POST['anno']-1;
$scadenza=$_POST['scadenza'];
$select_contratti="SELECT contratto_id,contratto_data,cliente_id,cliente_nominativo,cliente_indirizzo,cliente_cap,cliente_citta,cliente_provincia,pontile_codice,posto_barca_id,posto_barca_numero,dimensione_lunghezza,dimensione_larghezza,costo_condominiale FROM ".$tabelle['contratti'].",".$tabelle['clienti'].",".$tabelle['pontili'].",".$tabelle['posti_barca'].",".$tabelle['listini_posti_barca'].",".$tabelle['dimensioni']." WHERE cliente_id>1 AND cliente_id=contratto_anagrafica2 AND posto_barca_id=contratto_posto_barca AND pontile_id=posto_barca_pontile AND dimensione_id=posto_barca_dimensioni AND listino_posto_barca_dimensione=dimensione_id AND listino_posto_barca_anno='".$anno."' AND contratto_tipo='2' AND (contratto_fine>NOW() OR contratto_fine='0000-00-00') GROUP BY contratto_posto_barca";
$result_contratti=$sql->select_query($select_contratti);
$ricerca_sostituzione=array();
while ($row_contratti=mysql_fetch_array($result_contratti))
{
	$cliente=$row_contratti['cliente_nominativo'];
	$indirizzo=$row_contratti['cliente_indirizzo'];
	$cap=$row_contratti['cliente_cap'];
	$citta=$row_contratti['cliente_citta'];
	$provincia=$row_contratti['cliente_provincia'];
	$data=date("d-m-Y",time());
	$pontile=$row_contratti['pontile_codice'];
	$posto_barca=$row_contratti['posto_barca_numero'];
	$data_stipula=$sql->data_ita($row_contratti['contratto_data']);
	$data_stipula=$data_stipula[0];
	$costo=number_format($row_contratti['costo_condominiale'],2,",",".");
	$dimensioni=$row_contratti['dimensione_lunghezza']." x ".$row_contratti['dimensione_larghezza'];
	$ricerca_sostituzione[]=array("<NOMINATIVO>"=>$cliente,
								  "<INDIRIZZO>"=>$indirizzo,
								  "<CAP>"=>$cap,
								  "<CITTA>"=>$citta,
								  "<PROVINCIA>"=>$provincia,
								  "<DATA>"=>$data,
								  "<ANNO>"=>$anno,
								  "<PONTILE>"=>$pontile,
								  "<POSTO_BARCA>"=>$posto_barca,
								  "<DIMENSIONI>"=>$dimensioni,
								  "<DATA-STIPULA>"=>$data_stipula,
								  "<COSTO>"=>$costo,
								  "<SCADENZA>"=>$scadenza,
								  "<RENDITA>"=>$rendita,
								  );
}
/*echo "<pre>";
print_r($ricerca_sostituzione);
echo "</pre>";
*/
$rtf=new RTF();
$rtf->carica_template("template/lettera_spese_condominiali.rtf");
$rtf->rtf_multiplo($ricerca_sostituzione);
$rtf->output("Lettere di Spesa Condominiale.doc");
