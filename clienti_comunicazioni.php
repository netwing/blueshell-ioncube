<?php
require_once("config.inc.php");
// Inclusione del file di configurazione generale
$blue->autentica_utente("anagrafica","R");
$dp=opendir("template");
$elenco_file=array();
while (($file=readdir($dp))!==false) {
	if ($file!="." and $file!="..") {
		$elenco_file[]=$file;
	}
}

$contratto_dal = date("Y-m-d",time()-(60*60*24*180));
$contratto_al = date("Y-m-d",time()+(60*60*24*180));

require_once "views/client/communication.php";

