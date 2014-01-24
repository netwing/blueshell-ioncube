<?php
require_once("config.inc.php");
$blue->autentica_utente("imbarcazioni","W");
if (!array_key_exists("id",$_GET)) {
	header("Location:barca_inserimento.php?id=0");
	exit;
}
$elenco_tipologie=$blue->elenco_tipologie();
$k_elenco_tipologie=array_keys($elenco_tipologie);
$elenco_nazioni=$blue->elenco_nazioni();
$k_elenco_nazioni=array_keys($elenco_nazioni);
$elenco_costruttori=$blue->elenco_costruttori();
$k_elenco_costruttori=array_keys($elenco_costruttori);
$elenco_assicurazioni=$blue->elenco_assicurazioni();
$k_elenco_assicurazioni=array_keys($elenco_assicurazioni);
$elenco_clienti=$blue->elenco_clienti();
$k_elenco_clienti=array_keys($elenco_clienti);
$form->campi_testo=array("barca_nome","barca_modello","barca_motore","barca_matricola_motore1","barca_matricola_motore2","barca_targa","barca_polizza","barca_caratteristiche","barca_colore","barca_note", "builder", "insurance_company");
$form->campi_numero=array("barca_anno","barca_lunghezza","barca_larghezza","barca_pescaggio");
$form->campi_data_unica=array("barca_scadenza_polizza");
$form->campi_lista=array("barca_proprietario"=>$k_elenco_clienti,"barca_tipologia_barca"=>$k_elenco_tipologie,"country"=>$k_elenco_nazioni);
$prop_default="barca_proprietario_".$_GET['id'];
$form->valori_default=array($prop_default=>"selected=\"selected\"","country_it"=>"selected=\"selected\"","barca_tipologia_barca_1"=>"selected=\"selected\"");
$form->campi_obbligatori=array("barca_nome","barca_proprietario", 'barca_tipologia_barca', 'barca_lunghezza');
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
	if ($form->errore_form === false) {
		$barca_caratteristiche = "";
		$barca_note = "";
		foreach ($_POST as $k=>$v) {
			$$k=$sql->pulisci($v, false);
		}
		$barca_lunghezza = @$sql->decimale_sql($barca_lunghezza);
		$barca_larghezza = @$sql->decimale_sql($barca_larghezza);
		$barca_pescaggio = @$sql->decimale_sql($barca_pescaggio);
		/*
		if (@$barca_costruttore_nuovo != '') {
			$sql->insert_query("INSERT INTO blue_costruttori (costruttore_nome) VALUES ('".$barca_costruttore_nuovo."')");
			$barca_costruttore=$sql->insert_last_id;
		}
		if (@$barca_assicurazione_nuova != '') {
			$sql->insert_query("INSERT INTO blue_assicurazioni (assicurazione_nome) VALUES ('".$barca_assicurazione_nuova."')");
			$barca_assicurazione=$sql->insert_last_id;
		}
		*/
		@$insert="INSERT INTO ".$tabelle['barche']." (barca_nome,barca_tipologia_barca,country, barca_modello,barca_anno,barca_lunghezza,barca_larghezza,barca_pescaggio,barca_motore,barca_matricola_motore1,barca_matricola_motore2,barca_targa,barca_polizza,barca_scadenza_polizza,barca_caratteristiche,barca_colore,barca_proprietario,barca_note, builder, insurance_company) VALUES ('".$barca_nome."','".$barca_tipologia_barca."','".$country."', '".$barca_modello."','".$barca_anno."','".$barca_lunghezza."','".$barca_larghezza."','".$barca_pescaggio."','".$barca_motore."','".$barca_matricola_motore1."','".$barca_matricola_motore2."','".$barca_targa."','".$barca_polizza."','".$barca_scadenza_polizza."','".$barca_caratteristiche."','".$barca_colore."','".$barca_proprietario."','".$barca_note."', '" . $builder . "', '" . $insurance_company . "')";

		$sql->insert_query($insert);
		$lastid=$sql->insert_last_id;

		if (array_key_exists('response', $_GET)) {
			if ($_GET['response'] == 'json') {
				echo intval($lastid);
				exit;
			}
		}

		if ($lastid) {
			Yii::app()->user->setFlash("success", Yii::t('app', 'Vector created successfully.'));
		} else {
			Yii::app()->user->setFlash("danger", Yii::t('app', 'An error occured.'));
			header("Location:barca_inserimento.php?id=" . intval($_GET['id']));
			exit;
		}

		if (array_key_exists("procedere",$_POST) and $_POST['procedere']=="nuovo_contratto2") {
			header("Location:nuovo_contratto2.php?selected=".$lastid."&cliente=".$barca_proprietario);
			exit;
		}
		# Quando vengo dalla procedura di Nuovo Contratto
		elseif (array_key_exists("procedere",$_POST) and $_POST['procedere']=="nuova_presenza2") {
			header("Location:nuova_presenza2.php?selected=".$lastid."&cliente=".$barca_proprietario);
			exit;
		}
		# Se vuole inserire un nuovo cliente
		elseif (array_key_exists("procedere2",$_POST) and $_POST['procedere2']=="nuovo_cliente") {
			header("Location:cliente_inserimento.php");
			exit;
		}
		# Quando vengo dalla procedura di Nuova Presenza
		else {
			header("Location:cliente_visualizza.php?id=".$barca_proprietario);
			exit;
		}
		# Quando inserisco una barca e basta
	}
}

$action = "barca_inserimento.php?id=" . intval($_GET['id']);
require_once "views/vector/create.php";
