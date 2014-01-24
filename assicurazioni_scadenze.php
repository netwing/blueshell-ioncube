<?php
require_once("config.inc.php");
// Inclusione del file di configurazione generale
$blue->autentica_utente("imbarcazioni","R");
$assicurazione_fine_dal=date("Y-m-d",time());
$assicurazione_fine_al=date("Y-m-d",time()+(60*60*24*30));

require_once "views/vector/expiring_insurance2.php";
