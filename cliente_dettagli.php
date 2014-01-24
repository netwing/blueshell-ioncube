<?php
header("Location:app/index.php?r=/admin/customer/detail&id=" . intval($_GET['id']));
exit;
require_once("config.inc.php");
$blue->autentica_utente("anagrafica","R");
if (!array_key_exists("id",$_GET))
{
	header("Location:index.php");
	exit;
}
if (array_key_exists("Collega",$_POST))
{
	// UPDATE totale di spese_condominali e varie
	$sql->update_query("UPDATE blue_fatture SET fattura_spese_condominiali='0',fattura_varie='0' WHERE fattura_cliente_id='".$_GET['id']."'");
	foreach ($_POST['fatture'] as $k=>$v)
	{
		$contratto_id=$_POST['contratti'][$k];
		$update="UPDATE blue_fatture SET fattura_contratto_id='".$contratto_id."' WHERE fattura_id='".$v."'";
		$sql->update_query($update);
	}
	if (array_key_exists("spese_condominiali",$_POST) AND count($_POST['spese_condominiali']>0))
	{
		foreach ($_POST['spese_condominiali'] as $k=>$v)
		{
			$sql->update_query("UPDATE blue_fatture SET fattura_spese_condominiali='1' WHERE fattura_id='".$k."'");
		}
	}
	if (array_key_exists("varie",$_POST) AND count($_POST['varie']>0))
	{
		foreach ($_POST['varie'] as $k=>$v)
		{
			$sql->update_query("UPDATE blue_fatture SET fattura_varie='1' WHERE fattura_id='".$k."'");
		}
	}
}
$select_cliente="SELECT cliente_nominativo FROM ".$tabelle['clienti']." WHERE cliente_id='".$_GET['id']."'";
$result_cliente=$sql->select_query($select_cliente);
$cliente_nominativo=mysql_result($result_cliente,0,'cliente_nominativo');
// Andiamo a recuperare il nome del cliente

$elenco_tipi=$blue->elenco_tipi();
$elenco_periodi=$blue->elenco_periodi();

if (array_key_exists("delfat",$_GET))
{
	$delete="DELETE FROM ".$tabelle['fatture']." WHERE fattura_id='".$_GET['delfat']."'";
	$sql->delete_query($delete);
	$delete="DELETE FROM ".$tabelle['fatture_righe']." WHERE fattura_riga_fattura_id='".$_GET['id']."'";
	$sql->delete_query($delete);
}
// Se viene passato un parametro delfat, la fattura in questione viene cancellata

// $select_contratti="SELECT contratto_id,contratto_anagrafica1,contratto_anagrafica2,contratto_barca,contratto_tipo,contratto_posto_barca,contratto_periodo,contratto_data,contratto_inizio,contratto_fine FROM ".$tabelle['contratti']." WHERE (contratto_anagrafica1='1' AND contratto_anagrafica2='".$_GET['id']."') OR (contratto_anagrafica1='".$_GET['id']."' AND contratto_anagrafica2='1') ORDER BY contratto_data DESC";
$select_contratti="SELECT contratto_id,contratto_anagrafica1,contratto_anagrafica2,contratto_barca,contratto_tipo,contratto_posto_barca,contratto_periodo,contratto_data,contratto_inizio,contratto_fine,contratto_totale,contratto_fatturato,contratto_sconto FROM ".$tabelle['contratti']." WHERE contratto_anagrafica2='".$_GET['id']."' OR (contratto_anagrafica1='".$_GET['id']."' AND contratto_tipo!=2) ORDER BY contratto_fine DESC,contratto_tipo ASC";
if ($_GET['id']=='1')
{
	$select_contratti="SELECT contratto_id,contratto_anagrafica1,contratto_anagrafica2,contratto_barca,contratto_tipo,contratto_posto_barca,contratto_periodo,contratto_data,contratto_inizio,contratto_fine,contratto_totale,contratto_fatturato,contratto_sconto FROM ".$tabelle['contratti']." WHERE contratto_anagrafica2='1' ORDER BY contratto_fine DESC,contratto_tipo ASC";
}
$result_contratti=$sql->select_query($select_contratti);
$contratti_combobox=$result_contratti;
// Caricamento dell'elenco dei contratti del cliente

$select_presenze="SELECT presenza_id,presenza_barca,presenza_posto_barca,presenza_arrivo,presenza_partenza FROM ".$tabelle['presenze']." WHERE presenza_cliente='".$_GET['id']."' ORDER BY presenza_partenza DESC";
$result_presenze=$sql->select_query($select_presenze);
// Caricamento delle presenze del cliente

$select_fatture="SELECT fattura_id,fattura_numero,fattura_data,fattura_riga_descrizione,fattura_riga_totale,fattura_contratto_id,fattura_spese_condominiali,fattura_varie FROM ".$tabelle['fatture'].",".$tabelle['fatture_righe']." WHERE fattura_riga_fattura_id=fattura_id AND fattura_cliente_id='".$_GET['id']."' ORDER BY fattura_data DESC";
$result_fatture=$sql->select_query($select_fatture);
// Caricamento delle fatture del cliente

// BEGIN YII APP INTEGRATION
$customer = Customer::model()->findByPk((int) $_GET['id']);
$controller = new Controller('BS1');
$invoices = Invoice::model();
$invoices->customer_id = $customer->cliente_id;
// END YII APP INTEGRATION

require_once "views/client/detail.php";
