<?php
require_once("config.inc.php");
$blue->autentica_utente("contratti","W");
if (!array_key_exists("id",$_GET)) {
	header("Location:index.php");
	exit;
}
$select="SELECT pontile_codice,posto_barca_numero,cliente_nominativo,presenza_barca,presenza_arrivo,presenza_partenza,presenza_posto_barca FROM ".$tabelle['presenze'].",".$tabelle['clienti'].",".$tabelle['posti_barca'].",".$tabelle['pontili']." WHERE presenza_id='".$_GET['id']."' AND cliente_id=presenza_cliente AND posto_barca_id=presenza_posto_barca AND pontile_id=posto_barca_pontile";
$result=$sql->select_query($select);
if ($sql->select_num_rows == 0) {
	Yii::app()->user->setFlash('danger', Yii::t('app', "Presence not found."));
	header("Location:/posti_barca.php");
	exit;
}
$cliente=mysql_result($result,0,"cliente_nominativo");
$barca=mysql_result($result,0,"presenza_barca");
if ($barca!=0) {
	$select_barca="SELECT barca_nome FROM blue_barche WHERE barca_id='".$barca."'";
	$result_barca=$sql->select_query($select_barca);
	$barca=mysql_result($result_barca,0,'barca_nome');
} else {
	$barca="Non Disponibile";
}
$arrivo=mysql_result($result,0,"presenza_arrivo");
if ($arrivo == '0000-00-00') {
    $arrivo = "";
}
$partenza=mysql_result($result,0,"presenza_partenza");
if ($partenza == '0000-00-00') {
	$partenza = "";
}
$posto_barca=mysql_result($result,0,"pontile_codice").mysql_result($result,0,"posto_barca_numero");
$posto_barca_id=mysql_result($result,0,"presenza_posto_barca");
$form->campi_testo=array("presenza_inizio","presenza_fine");
$form->valori_default=array("presenza_inizio" => $arrivo, "presenza_fine" => $partenza);
$form->campi_obbligatori=array("presenza_inizio");
$form->inizializza();
if (count($_POST) > 0) {
	$form->verifica();
	if ($form->errore_form===false) {
        CVarDumper::dump($_POST, 1, true);
		$arrivo = $_POST['presenza_inizio'];
		if ($_POST['presenza_fine']!="") {		
			$partenza = $_POST['presenza_fine'];
		} else {
			$partenza="0000-00-00";
		}
		$update="UPDATE ".$tabelle['presenze']." SET presenza_arrivo='".$arrivo."',presenza_partenza='".$partenza."' WHERE presenza_id='".$_GET['id']."'";
		$sql->update_query($update);
		header("Location:posto_barca_dettagli.php?id=".$posto_barca_id);
		exit;
	}
}

require_once "views/presence/update.php";
