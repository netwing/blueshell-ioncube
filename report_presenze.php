<?php
require_once("config.inc.php");
$blue->autentica_utente("contratti","R");

$data_presenza = date("Y-m-d",time());
$pontili = $blue->elenco_pontili();

$messaggio = "";

if (array_key_exists("id",$_GET)) {
	$pontile = intval($_GET['id']);
} else {
	$pontile = 0;
}
if (array_key_exists("nopb",$_GET)) {
    Yii::app()->user->setFlash('warning', Yii::t('app', 'No enabled resources for selected group.'));
    header("Location:report_presenze.php?id=" . $pontile);
    exit;
} elseif (array_key_exists("nopr",$_GET)) {
    Yii::app()->user->setFlash('warning', Yii::t('app', 'No presences for selected group and dates.'));
    header("Location:report_presenze.php?id=" . $pontile);
    exit;
} else {
    $messaggio = "";
}

require_once "views/resource/presence_report.php";
