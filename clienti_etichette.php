<?php
require_once("config.inc.php");
// Inclusione del file di configurazione generale
$blue->autentica_utente("anagrafica","R");

$contratto_data = date("Y-m-d",time());

require_once "views/client/labels.php";
