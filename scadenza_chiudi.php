<?php
require_once("config.inc.php");
$blue->autentica_utente("principale","W");
if (array_key_exists("id",$_GET)) {
	$update="UPDATE ".$tabelle['scadenze']." SET scadenza_status='Chiuso', scadenza_data_chiusura=NOW() WHERE scadenza_id='".$_GET['id']."'";
	$sql->update_query($update);
}
Yii::app()->user->setFlash('success', Yii::t('app', 'Deadline successfully closed.'));
header("Location:index.php");
exit;
