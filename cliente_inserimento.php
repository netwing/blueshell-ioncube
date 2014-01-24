<?php
require_once("config.inc.php");
$blue->autentica_utente("anagrafica","W");
$elenco_nazioni=$blue->elenco_nazioni();
$key_elenco_nazioni=array_keys($elenco_nazioni);
$form->campi_testo=array("cliente_nominativo","cliente_nome","cliente_cognome","cliente_indirizzo","cliente_cap","cliente_citta","cliente_provincia","cliente_codice_fiscale","cliente_partita_iva","cliente_telefono1","cliente_telefono2","cliente_telefono3","cliente_email","cliente_numero_documento","cliente_note","cliente_luogo_nascita","cliente_data_nascita");
// $form->campi_data=array('cliente_data_nascita'=>array('gg','mm','aaaa'));
$form->campi_numero=array("cliente_telefono1","cliente_telefono2","cliente_telefono3");
$form->campi_lista=array("country"=>$key_elenco_nazioni,"cliente_documento"=>array("Non disponibile", "CdI","Patente","Patente Nautica","Passaporto"),"cliente_tipo_telefono1"=>array("Abitazione","Cellulare","Ufficio","Fax"),"cliente_tipo_telefono2"=>array("Abitazione","Cellulare","Ufficio","Fax"),"cliente_tipo_telefono3"=>array("Abitazione","Cellulare","Ufficio","Fax"));
$form->campi_obbligatori=array("cliente_nominativo","cliente_telefono1");
$form->valori_default=array("cliente_data_nascita" => "", "country_it"=>"selected=\"selected\"","cliente_tipo_telefono1_Cellulare"=>"selected=\"selected\"","cliente_tipo_telefono2_Abitazione"=>"selected=\"selected\"","cliente_tipo_telefono3_Ufficio"=>"selected=\"selected\"");
$form->inizializza();

if (count($_POST)>0)
{
	if (array_key_exists('response', $_GET)) {
		if ($_GET['response'] == 'json') {
			$form->errore_form = false;			
		}
	} else {
		$form->verifica();
	}
	$cliente_note = "";
	if ($form->errore_form === false) {
		foreach ($_POST as $k=>$v) {
			$$k=$sql->pulisci($v);
		}
		$cliente_nome = @ucwords(strtolower($cliente_nome));
		$cliente_cognome = @ucwords(strtolower($cliente_cognome));
		$cliente_codice_fiscale = @strtoupper($cliente_codice_fiscale);
		$cliente_partita_iva = @strtoupper($cliente_partita_iva);
		@$insert = "INSERT INTO ".$tabelle['clienti']." (cliente_nominativo,cliente_nome,cliente_cognome,cliente_luogo_nascita,cliente_data_nascita,cliente_indirizzo,cliente_citta,cliente_cap,cliente_provincia,country,cliente_telefono1,cliente_tipo_telefono1,cliente_telefono2,cliente_tipo_telefono2,cliente_telefono3,cliente_tipo_telefono3,cliente_email,cliente_codice_fiscale,cliente_partita_iva,cliente_documento,cliente_numero_documento,cliente_note) VALUES ('". $cliente_nominativo."','". $cliente_nome."','". $cliente_cognome."','". $cliente_luogo_nascita."','". $cliente_data_nascita."','". $cliente_indirizzo."','". $cliente_citta."','". $cliente_cap."','". $cliente_provincia."','". $country."','". $cliente_telefono1."','". $cliente_tipo_telefono1."','". $cliente_telefono2."','". $cliente_tipo_telefono2."','". $cliente_telefono3."','". $cliente_tipo_telefono3."','". $cliente_email."','". $cliente_codice_fiscale."','". $cliente_partita_iva."','". $cliente_documento."','". $cliente_numero_documento."','". $cliente_note."')";
		$sql->insert_query($insert);
		$lastid=$sql->insert_last_id;
		# Fine della procedura di insert

		if ($lastid) {
			Yii::app()->user->setFlash("success", Yii::t('app', 'Client created successfully.'));
		} else {
			Yii::app()->user->setFlash("danger", Yii::t('app', 'An error occured.'));
			header("Location:clienti.php");
			exit;
		}

		if (array_key_exists('response', $_GET)) {
			if ($_GET['response'] == 'json') {
				echo intval($lastid);
				exit;
			}
		}

		if (array_key_exists("procedere",$_POST) and $_POST['procedere']=="barca") {
			header("Location:barca_inserimento.php?id=".$lastid);
			exit;
		} elseif (array_key_exists("procedere",$_POST) and $_POST['procedere']=="concludi") {
			header("Location:clienti.php");
			exit;
		} elseif (array_key_exists("procedere",$_POST) and $_POST['procedere']=="nuovo_contratto1") {
			header("Location:nuovo_contratto1.php?selected=".$lastid);
			exit;
		} elseif (array_key_exists("procedere",$_POST) and $_POST['procedere']=="nuova_presenza1") {
			header("Location:nuova_presenza1.php?selected=".$lastid);
			exit;
		} elseif (array_key_exists("procedere",$_POST) and $_POST['procedere']=="nuovo") {
			header("Location:cliente_inserimento.php");
			exit;
		} else {
			header("Location:index.php");
			exit;
		}
		# Fine della procedura per redirigere l'utente una volta effettuato l'inserimento dei dati del cliente
	}
}

if (array_key_exists('response', $_GET)) {
	if ($_GET['response'] == 'json') {
		echo intval(-1);
		exit;
	}
}


$action = "cliente_inserimento.php";
require_once "views/client/create.php";
