<?php
require_once("config.inc.php");
$blue->autentica_utente("contratti","R");

$dal = date("Y-m-d", time());
$al = date("Y-m-d", time() + (60*60*24*30));

require_once "views/contract/report.php";
