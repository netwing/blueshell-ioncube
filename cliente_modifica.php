<?php
require_once("config.inc.php");
$blue->autentica_utente("anagrafica","W");
if (!array_key_exists("id",$_GET))
{
	header("Location:index.php");
}
$elenco_nazioni=$blue->elenco_nazioni();
$key_elenco_nazioni=array_keys($elenco_nazioni);
$form->campi_testo=array("cliente_nominativo","cliente_nome","cliente_cognome","cliente_indirizzo","cliente_cap","cliente_citta","cliente_provincia","cliente_codice_fiscale","cliente_partita_iva","cliente_telefono1","cliente_telefono2","cliente_telefono3","cliente_email","cliente_numero_documento","cliente_note","cliente_luogo_nascita");
$form->campi_numero=array("cliente_telefono1","cliente_telefono2","cliente_telefono3");
$form->campi_lista=array("country"=>$key_elenco_nazioni,"cliente_documento"=>array("CdI","Patente","Patente Nautica","Passaporto"),"cliente_tipo_telefono1"=>array("Abitazione","Cellulare","Ufficio","Fax"),"cliente_tipo_telefono2"=>array("Abitazione","Cellulare","Ufficio","Fax"),"cliente_tipo_telefono3"=>array("Abitazione","Cellulare","Ufficio","Fax"));
$form->campi_obbligatori=array("cliente_nominativo","cliente_telefono1");

$select_cliente="SELECT cliente_id,cliente_nominativo,cliente_nome,cliente_cognome,cliente_data_nascita,cliente_luogo_nascita,cliente_indirizzo,cliente_citta,cliente_cap,cliente_provincia,country,cliente_telefono1,cliente_tipo_telefono1,cliente_telefono2,cliente_tipo_telefono2,cliente_telefono3,cliente_tipo_telefono3,cliente_email,cliente_codice_fiscale,cliente_partita_iva,cliente_documento,cliente_numero_documento,cliente_rifiuta_comunicazioni,cliente_note FROM ".$tabelle['clienti']." WHERE cliente_id='".$_GET['id']."'";
$result_cliente=$sql->select_query($select_cliente);
$row_cliente=mysql_fetch_array($result_cliente);
// $nascita=explode("-",$row_cliente['cliente_data_nascita']);
$default_nazione_cliente="country_".$row_cliente['country'];
$default_documento_cliente="cliente_documento_".$row_cliente['cliente_documento'];
$default_tipo_telefono1="cliente_tipo_telefono1_".$row_cliente['cliente_tipo_telefono1'];
$default_tipo_telefono2="cliente_tipo_telefono2_".$row_cliente['cliente_tipo_telefono2'];
$default_tipo_telefono3="cliente_tipo_telefono3_".$row_cliente['cliente_tipo_telefono3'];
$form->valori_default=array("cliente_nominativo"=>$row_cliente['cliente_nominativo'],"cliente_nome"=>$row_cliente['cliente_nome'],"cliente_cognome"=>$row_cliente['cliente_cognome'],"cliente_luogo_nascita"=>$row_cliente['cliente_luogo_nascita'],"cliente_data_nascita" => $row_cliente['cliente_data_nascita'], "cliente_indirizzo"=>$row_cliente['cliente_indirizzo'],"cliente_citta"=>$row_cliente['cliente_citta'],"cliente_cap"=>$row_cliente['cliente_cap'],"cliente_provincia"=>$row_cliente['cliente_provincia'],$default_nazione_cliente=>"selected=\"selected\"","cliente_telefono1"=>$row_cliente['cliente_telefono1'],$default_tipo_telefono1=>"selected=\"selected\"","cliente_telefono2"=>$row_cliente['cliente_telefono2'],$default_tipo_telefono2=>"selected=\"selected\"","cliente_telefono3"=>$row_cliente['cliente_telefono3'],$default_tipo_telefono3=>"selected=\"selected\"","cliente_email"=>$row_cliente['cliente_email'],"cliente_codice_fiscale"=>$row_cliente['cliente_codice_fiscale'],"cliente_partita_iva"=>$row_cliente['cliente_partita_iva'],$default_documento_cliente=>"selected=\"selected\"","cliente_numero_documento"=>$row_cliente['cliente_numero_documento'],"cliente_note"=>$row_cliente['cliente_note']);
$form->inizializza();
if (count($_POST)>0)
{
	$form->verifica();
	if ($form->errore_form===false) {
		$cliente_note = "";
		foreach ($_POST as $k=>$v)
		{
			$$k=$sql->pulisci($v);
		}
		$cliente_nome=ucwords(strtolower($cliente_nome));
		$cliente_cognome=ucwords(strtolower($cliente_cognome));
		$cliente_codice_fiscale=strtoupper($cliente_codice_fiscale);
		$cliente_partita_iva=strtoupper($cliente_partita_iva);
		$cliente_rifiuta_comunicazioni='0';
		if (array_key_exists('cliente_rifiuta_comunicazioni',$_POST)) {
			$cliente_rifiuta_comunicazioni='1';
		}
		$update="UPDATE ".$tabelle['clienti']." SET cliente_nominativo='".$cliente_nominativo."',cliente_nome='".$cliente_nome."',cliente_cognome='".$cliente_cognome."',cliente_luogo_nascita='".$cliente_luogo_nascita."',cliente_data_nascita='".$cliente_data_nascita."',cliente_indirizzo='".$cliente_indirizzo."',cliente_citta='".$cliente_citta."',cliente_cap='".$cliente_cap."',cliente_provincia='".$cliente_provincia."',cliente_telefono1='".$cliente_telefono1."',cliente_tipo_telefono1='".$cliente_tipo_telefono1."',cliente_telefono2='".$cliente_telefono2."',cliente_tipo_telefono2='".$cliente_tipo_telefono2."',cliente_telefono3='".$cliente_telefono3."',cliente_tipo_telefono3='".$cliente_tipo_telefono3."',cliente_email='".$cliente_email."',cliente_codice_fiscale='".$cliente_codice_fiscale."',cliente_partita_iva='".$cliente_partita_iva."',cliente_documento='".$cliente_documento."',cliente_numero_documento='".$cliente_numero_documento."',cliente_rifiuta_comunicazioni='".$cliente_rifiuta_comunicazioni."',cliente_note='".$cliente_note."' WHERE cliente_id='".$cliente_id."'";
		$result = $sql->update_query($update);

		if ($result) {
			Yii::app()->user->setFlash("success", Yii::t('app', 'Client updated successfully.'));
		} else {
			Yii::app()->user->setFlash("danger", Yii::t('app', 'An error occured.'));
			header("Location:clienti.php");
			exit;
		}

		header("Location:clienti.php");
		exit;
		# Fine della procedura di update
	}
}

$action = "cliente_modifica.php?id=" . intval($_GET['id']);
require_once "views/client/update.php";
