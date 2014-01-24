<?php
require_once("config.inc.php");
$blue->autentica_utente("anagrafica","W");
$elenco_clienti=$blue->elenco_clienti();
$form->campi_testo=array("nota_contenuto");
// $form->campi_data_unica=array("nota_data");
$form->campi_obbligatori=array("cliente", "nota_data", "nota_contenuto");
$form->valori_default=array("nota_data"=>date("d-m-Y",time()));
$form->inizializza();
if (count($_POST)>0)
{
	$form->verifica();
	if ($form->errore_form===false)
	{
		$nota_data = $_POST['nota_data'];
		$nota_contenuto=$sql->pulisci($_POST['nota_contenuto']);
		$nota_cliente=intval($_POST['cliente']);
		$insert="INSERT INTO ".$tabelle['clienti_note']." (cliente_nota_cliente_id,cliente_nota_data,cliente_nota_contenuto) VALUES ('".$nota_cliente."','".$nota_data."','".$nota_contenuto."')";
		$sql->insert_query($insert);
		$form->valori_default=array("nota_data"=>date("d-m-Y",time()));
		$form->inizializza();
	}
}

require_once "views/client/add_note.php";
