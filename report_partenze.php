<?php
require_once("config.inc.php");
$blue->autentica_utente("contratti","R");

$inizio_dal = date("Y-m-d", time());
$inizio_al = date("Y-m-d", time() + (60*60*24*30));
$pontili = $blue->elenco_pontili();

if (array_key_exists("id",$_GET)) {
	$pontile=intval($_GET['id']);
} else {
	$pontile=0;
}
if (array_key_exists("nopb",$_GET)) {
    Yii::app()->user->setFlash('warning', Yii::t('app', 'No enabled resources for selected group.'));
    header("Location:report_partenze.php?id=" . $pontile);
    exit;
} elseif (array_key_exists("nopr",$_GET)) {
    Yii::app()->user->setFlash('warning', Yii::t('app', 'No departures for selected group and dates.'));
    header("Location:report_partenze.php?id=" . $pontile);
    exit;
} else {
	$messaggio="";
}

require_once "views/resource/departure_report.php";
