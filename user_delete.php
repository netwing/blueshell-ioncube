<?php
require_once("config.inc.php");
$blue->autentica_utente("preferenze","W");

if (array_key_exists("id",$_GET) and $_GET['id']!='' and $_GET['id']!=1) {
    $id = intval($_GET['id']);
    $delete = "DELETE FROM ".$tabelle['utenti']." WHERE utente_id != '1' AND utente_id='".$id."'";
    $result = $sql->delete_query($delete);
    if ($result) {
        Yii::app()->user->setFlash('success', Yii::t('app', 'User deleted successfully.'));
    } else {
        Yii::app()->user->setFlash('success', Yii::t('app', 'An error occured.'));
    }
    header("Location:preferenze_utenti.php");
    exit;
}
