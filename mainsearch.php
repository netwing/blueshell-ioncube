<?php
require_once "config.inc.php";
$blue->autentica_utente("principale","R");

$sql = "SELECT *
FROM {{clienti}} 
WHERE cliente_nominativo LIKE :search 
OR cliente_nome LIKE :search 
OR cliente_cognome LIKE :search 
LIMIT :start, :limit";
$command = Yii::app()->db->createCommand($sql);
$command->bindValue(':search', '%' . $_GET['s'] . '%', PDO::PARAM_STR);
$command->bindValue(':limit', 10, PDO::PARAM_INT);
$command->bindValue(':start', 0, PDO::PARAM_INT);
$clients = $command->queryAll();

require_once "views/site/mainsearch.php";