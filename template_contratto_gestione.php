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
$campi=array("<LUNGHEZZA>"=>$lunghezza,
			 "<LARGHEZZA>"=>$larghezza,
			 "<DATA_CONTRATTO>"=>$data_contratto,
			 "<PERC>"=>$gestione_percentuale,
			 "<PERC_RES>"=>100-$gestione_percentuale,
			 "<DAL>"=>$dal,
			 "<AL>"=>$al,
			 "<PONTILE>"=>$pontile,
			 "<POSTO_BARCA>"=>$posto_barca,
			 "<NOMINATIVO>"=>$nominativo,
			 "<INDIRIZZO>"=>$indirizzo,
			 "<CAP>"=>$cap,
			 "<CITTA>"=>$citta,
			 "<NAZIONE>"=>$nazione,
			 "<PARTITA_IVA>"=>$partita_iva,
			 "<CODICE_FISCALE>"=>$codice_fiscale,
			 "<DAL>"=>$dal,
			 "<AL>"=>$al,
			 "<DATA>"=>$data
			);
$chiavi=array_keys($campi);
$valori=array_values($campi);
$rtf=new RTF();
$rtf->carica_template("template/contratto_gestione.rtf");
$rtf->rtf_singolo($chiavi,$valori);
$rtf->output("Contratto di Gestione.doc");
?>