<?php

require_once("config.inc.php");

$blue->autentica_utente("contratti", "R");

$sel = "SELECT contratto_id, contratto_fine, 
            cliente_id, cliente_nominativo, 
            barca_id, barca_nome, 
            pontile_codice, posto_barca_id, posto_barca_numero 
        FROM " . $tabelle['contratti'] . ", 
             " . $tabelle['clienti'] . ", 
             " . $tabelle['barche'] . ", 
             " . $tabelle['pontili'] . ", 
             " . $tabelle['posti_barca'] . " 
        WHERE contratto_tipo!='4' 
              AND cliente_id=contratto_anagrafica2 
              AND barca_id=contratto_barca 
              AND posto_barca_id=contratto_posto_barca 
              AND pontile_id=posto_barca_pontile 
              AND contratto_fine BETWEEN NOW()-INTERVAL 1 DAY 
              AND NOW()+INTERVAL 30 DAY 
              ORDER BY contratto_fine ASC";


$result_contratti = $sql->select_query($sel);
$contratti = array();
while($row_contratti = mysql_fetch_array($result_contratti)) {
	$contratti[] = $row_contratti;
}

require_once 'views/contract/expiring.php';
