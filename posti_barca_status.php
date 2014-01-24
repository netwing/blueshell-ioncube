<?php
require_once("config.inc.php");
$blue->autentica_utente("posti_barca","R");
$elenco_clienti = $blue->elenco_clienti();
$elenco_barche = $blue->elenco_barche();
$paginazione = $sql->paginazione_menu($tabelle['posti_barca_status']);
$limit = $sql->paginazione_valuta();
$pag = "";
if (array_key_exists("pag",$_GET)) {
	$pag="?pag=" . intval($_GET['pag']);
}
if (array_key_exists('sid', $_GET) and array_key_exists('p', $_GET)) {
    $presenza = intval($_GET['p']);
    $status_id = intval($_GET['sid']);
	$update = "UPDATE " . $tabelle['posti_barca_status'] . " SET presenza='" . $presenza . "' WHERE status_id='" . $status_id . "'";
	$esit = $sql->update_query($update);
    if ($esit) {
        Yii::app()->user->setFlash("success", Yii::t('app', "Presence successfully changed."));
    } else {
        Yii::app()->user->setFlash("danger", Yii::t('app', "An error occured"));
    }
    header("Location:posti_barca_status.php" . $pag);
    exit;
}
$select_status = "SELECT * FROM " . $tabelle['posti_barca_status'] . " ORDER BY posto_barca ASC LIMIT " . $limit;
$result_status = $sql->select_query($select_status);

require_once "views/resource/status.php";