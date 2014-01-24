<?php
require_once("config.inc.php");
$blue->autentica_utente("principale","R");
if (!array_key_exists("id",$_GET))
{
	header("Location:index.php");
	exit;
}
$select="SELECT * FROM ".$tabelle['scadenze']." WHERE scadenza_id='".$_GET['id']."'";
$result=$sql->select_query($select);
$row_scadenza=mysql_fetch_array($result);

require_once "views/site/scadenza_dettagli.php";