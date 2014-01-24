<?php
require_once("config.inc.php");
$blue->autentica_utente("posti_barca","R");

if (array_key_exists('id', $_GET) === false) {
    header("Location:index.php");
    exit;
}
$posto_barca_id = intval($_GET['id']);

$select_posto_barca = "SELECT pontile_codice,posto_barca_numero,posto_barca_disponibile 
                       FROM blue_pontili,blue_posti_barca 
                       WHERE posto_barca_id='" . $posto_barca_id . "' AND pontile_id=posto_barca_pontile";
$result_posto_barca = $sql->select_query($select_posto_barca);

$row_posto_barca = mysql_fetch_array($result_posto_barca);
$posto_barca_nome = $row_posto_barca['pontile_codice'] . $row_posto_barca['posto_barca_numero'];
$disponibile = $row_posto_barca['posto_barca_disponibile'];

$elenco_tipi = $blue->elenco_tipi();
$elenco_periodi = $blue->elenco_periodi();
$elenco_barche = $blue->elenco_barche_con_lunghezza();

$select_contratti = "SELECT contratto_id,contratto_anagrafica1,contratto_anagrafica2,contratto_barca,
                            contratto_tipo,contratto_periodo,contratto_data,contratto_inizio,contratto_fine,
                            contratto_totale,contratto_fatturato,contratto_sconto 
                     FROM " . $tabelle['contratti'] . " 
                     WHERE contratto_posto_barca='" . $posto_barca_id . "' 
                     ORDER BY contratto_fine DESC, contratto_tipo ASC";

$result_contratti = $sql->select_query($select_contratti);
// Caricamento dell'elenco dei contratti di affitto, gestione e vendita sul posto barca
//$select_prenotazioni="SELECT contratto_id,contratto_anagrafica1,contratto_anagrafica2,contratto_barca,contratto_tipo,contratto_periodo,contratto_data,contratto_inizio,contratto_fine,contratto_totale,contratto_fatturato FROM ".$tabelle['contratti']." WHERE contratto_posto_barca='".$posto_barca_id."' AND contratto_tipo='4' ORDER BY contratto_inizio DESC";
//$result_prenotazioni=$sql->select_query($select_prenotazioni);
// Caricamento dell'elenco dei contratti di affitto, gestione e vendita sul posto barca

if (array_key_exists("presdel", $_GET)) {
	$delete = "DELETE FROM " . $tabelle['presenze'] . " WHERE presenza_id='" . $_GET['presdel'] . "'";
	$esit = $sql->delete_query($delete);
    if ($esit) {
        Yii::app()->user->setFlash("success", Yii::t('app', "Presence successfully deleted."));
    } else {
        Yii::app()->user->setFlash("danger", Yii::t('app', 'An error occured'));
    }
    header("Location:posto_barca_dettagli.php?id=" . $posto_barca_id);
    exit;
}

$select_presenze = "SELECT presenza_id,presenza_posto_barca,presenza_barca,presenza_arrivo,presenza_partenza,cliente_nominativo 
                    FROM " . $tabelle['presenze'] . ", " . $tabelle['clienti'] . " 
                    WHERE cliente_id=presenza_cliente AND presenza_posto_barca='" . $posto_barca_id . "' 
                    ORDER BY presenza_arrivo DESC";
$result_presenze=$sql->select_query($select_presenze);
$numrows_presenze=$sql->select_num_rows;

// Caricamento delle presenze sul posto barca
$select_presenza = "SELECT presenza_id,presenza_posto_barca,presenza_barca,presenza_arrivo,presenza_partenza,cliente_nominativo 
                    FROM " . $tabelle['presenze'] . ", " . $tabelle['clienti'] . " 
                    WHERE cliente_id=presenza_cliente AND presenza_posto_barca='".$posto_barca_id."' 
                    AND presenza_arrivo<=NOW() AND (presenza_partenza>=NOW() OR presenza_partenza='0000-00-00')";
$result_presenza=$sql->select_query($select_presenza);
$presenza_attiva=false;
if ($sql->select_num_rows>0) {
	$presenza_attiva=true;
}

require_once "views/resource/view.php";
