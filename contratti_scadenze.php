<?php
require_once("config.inc.php");
// Inclusione del file di configurazione generale
$blue->autentica_utente("contratti","R");
$contratto_fine_dal = date("Y-m-d", time());
$contratto_fine_al = date("Y-m-d", time() + (60*60*24*30));

require_once "views/contract/expire_letter.php";