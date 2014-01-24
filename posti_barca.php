<?php
require_once("config.inc.php");
$blue->autentica_utente("posti_barca","R");
$elenco_clienti=$blue->elenco_clienti();
$elenco_pontili=$blue->elenco_pontili();
$elenco_dimensioni=$blue->elenco_dimensioni();
$pontile=1;

// Impostazione della sola form di aggiunta 
$form->campi_testo=array("posto_barca_numero", "posto_barca_dimensioni");
$form->campi_obbligatori=array("posto_barca_numero");

$form->valori_default=array("posto_barca_numero"=>"");
$form->inizializza();




if (array_key_exists("pontile",$_GET))
{
	$_SESSION['gestione_pb']['pontile']=$_GET['pontile'];
}
if (array_key_exists("gestione_pb",$_SESSION) and array_key_exists("pontile",$_SESSION['gestione_pb']))
{
	$pontile=$_SESSION['gestione_pb']['pontile'];
}

if (count($_POST)>0)
{

	// Se l'utente aggiunge un Posto Barca a questo pontile
	if (array_key_exists("Aggiungi",$_POST))
	{
		$form->verifica();
		if ($form->errore_form === false) {
			$pb=intval($_POST['posto_barca_numero']);
			$dim=intval($_POST['posto_barca_dimensioni']);
			$insert="INSERT INTO ".$tabelle['posti_barca']." (posto_barca_pontile,posto_barca_numero,posto_barca_sequenziale,posto_barca_dimensioni,posto_barca_proprietario,posto_barca_proprietario_data,posto_barca_gestore,posto_barca_gestore_data,posto_barca_disponibile) VALUES ('".$pontile."','".$pb."','".$pb."','".$dim."','1',NOW(),'1',NOW(),'1')";
			$ok = $sql->insert_query($insert);
			if ($ok) {
				Yii::app()->user->setFlash('success', Yii::t('app', 'Resource updated successfully.'));
			} else {
				Yii::app()->user->setFlash('success', Yii::t('app', 'An error occured'));
			}
		} 
	}

	// Se l'utente aggiorna le dimensioni di un posto barca
	if (array_key_exists("Aggiorna",$_POST))
	{
		$ok = true;
		foreach  ($_POST as $k => $v) {
			$field = "posto_barca_dimensioni_";
			if (strpos($k, $field)===0) {
				$id = intval(substr($k, strlen($field)));
				$dim = intval($v);
				$update= "UPDATE ".$tabelle['posti_barca']." SET posto_barca_dimensioni='".$dim
						."' WHERE posto_barca_id='".$id."'";
				// Eseguo tutte le query, ma segnalo se almeno una è in errore
				$ok = $sql->update_query($update) and $ok; 
				if ($ok) {
					Yii::app()->user->setFlash('success', Yii::t('app', 'Resource updated successfully.'));
				} else {
					Yii::app()->user->setFlash('success', Yii::t('app', 'An error occured'));
				}
			}	
		}
	}

}

if (count($_GET)>0) 
{

	// Se l'utente elimina un posto barca
	if (array_key_exists("action_to_do",$_GET) and $_GET["action_to_do"] == "delete")
	{
		$delete="DELETE FROM ".$tabelle['posti_barca']." WHERE posto_barca_id='".intval($_GET['posto_barca_id'])."'";
		$ok = $sql->delete_query($delete);
		if ($ok) {
			Yii::app()->user->setFlash('success', Yii::t('app', 'Resource deleted successfully.'));
		} else {
			Yii::app()->user->setFlash('success', Yii::t('app', 'An error occured'));
		}
		header("Location: posti_barca.php?pontile=" . $pontile);
		die();
	}
	// Se l'utente RENDE DISPONIBILE un posto barca
	if (array_key_exists("action_to_do",$_GET) and $_GET["action_to_do"] == "enable")
	{
		$update="UPDATE ".$tabelle['posti_barca']." SET posto_barca_disponibile='1' WHERE posto_barca_id='".$_GET['posto_barca_id']."'";
		$ok = $sql->update_query($update);
		if ($ok) {
			Yii::app()->user->setFlash('success', Yii::t('app', 'Resource enabled successfully.'));
		} else {
			Yii::app()->user->setFlash('success', Yii::t('app', 'An error occured'));
		}
		header("Location: posti_barca.php?pontile=" . $pontile);
		die();
	}
	// Se l'utente RENDE NON DISPONIBILE un posto barca
	if (array_key_exists("action_to_do",$_GET) and $_GET["action_to_do"] == "disable")
	{
		$update="UPDATE ".$tabelle['posti_barca']." SET posto_barca_disponibile='0' WHERE posto_barca_id='".$_GET['posto_barca_id']."'";
		$ok = $sql->update_query($update);
		if ($ok) {
			Yii::app()->user->setFlash('success', Yii::t('app', 'Resource disabled successfully.'));
		} else {
			Yii::app()->user->setFlash('success', Yii::t('app', 'An error occured'));
		}
		header("Location: posti_barca.php?pontile=" . $pontile);
		die();	
	}
}

$where_contratto="posto_barca_pontile='".$pontile."'";
$paginazione=$sql->paginazione_menu($tabelle['posti_barca'],$where_contratto);
$limit=$sql->paginazione_valuta();
$select_pb="SELECT * FROM ".$tabelle['posti_barca']." WHERE ".$where_contratto." ORDER BY posto_barca_numero ASC LIMIT ".$limit;
$result_pb=$sql->select_query($select_pb);

$add_form_action = "posti_barca.php?" . $_SERVER['QUERY_STRING']; 

require_once "views/resource/admin.php";

?>

