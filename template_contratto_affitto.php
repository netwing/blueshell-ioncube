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
$campi=array("<NOME>"=>$nome,
			 "<MODELLO>"=>$modello,
			 "<TIPO>"=>$tipo,
			 "<BANDIERA>"=>$bandiera,
			 "<LUNGHEZZA>"=>$lunghezza,
			 "<LARGHEZZA>"=>$larghezza,
			 "<STAZZA>"=>$stazza,
			 "<PESCAGGIO>"=>$pescaggio,
			 "<MOTORE>"=>$motore,
			 "<MATRICOLA>"=>$matricola,
			 "<PROPRIETARIO>"=>$proprietario,
			 "<COMANDANTE>"=>$comandante,
			 "<RECAPITO_TELEFONICO>"=>$recapito_telefonico,
			 "<PROVENIENZA>"=>$provenienza,
			 "<ARRIVO>"=>$arrivo,
			 "<POLIZZA_ASSICURAZIONE>"=>$polizza_assicurazione,
			 "<POLIZZA_NUMERO>"=>$polizza_numero,
			 "<DAL>"=>$dal,
			 "<AL>"=>$al,
			 "<PREZZO>"=>$prezzo,
			 "<IVA>"=>$iva,
			 "<TOTALE>"=>$totale,
			 "<PONTILE>"=>$pontile,
			 "<POSTO_BARCA>"=>$posto_barca,
			 "<NOMINATIVO>"=>$nominativo,
			 "<NASCITADATA>"=>$nascitadata,
			 "<NASCITALUOGO>"=>$nascitaluogo,
			 "<INDIRIZZO>"=>$indirizzo,
			 "<CAP>"=>$cap,
			 "<CITTA>"=>$citta,
			 "<NAZIONE>"=>$nazione,
			 "<PARTITA_IVA>"=>$partita_iva,
			 "<CODICE_FISCALE>"=>$codice_fiscale,
			 "<TELEFONO1>"=>$telefono1,
			 "<TELEFONO2>"=>$telefono2,
			 "<EMAIL>"=>$email,
			 "<DURATA>"=>$durata,
			 "<DAL>"=>$dal,
			 "<AL>"=>$al,
			 "<DATA>"=>$data
			);
$chiavi=array_keys($campi);
$valori=array_values($campi);
$rtf=new RTF();
if ($_POST['Submit']=='STAMPA CONTRATTO ITALIANO')
{
	$rtf->carica_template("template/contratto_affitto.rtf");
	$nome_output="Contratto di Affitto.doc";
}
elseif ($_POST['Submit']=='STAMPA CONTRATTO INGLESE')
{
	$rtf->carica_template("template/contratto_affitto_inglese.rtf");
	$nome_output="Supply Port Services Contract.doc";
}
$rtf->rtf_singolo($chiavi,$valori);
$rtf->output($nome_output);
?>