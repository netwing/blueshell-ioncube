<?php

if (!file_exists('config.inc.php')) {
    echo '<h1>Missing configuration!</h1>';
    echo '<h3>Please copy <code>config.inc.php.example</code> into <code>config.inc.php</code> 
          and setup database connection parameters.</h3>';
    exit(1);
}
require_once "config.inc.php";
$blue->autentica_utente("principale", "R");

// Controllo dell'autenticazione generica
// require_once("marinara.php");
$select_scadenze="SELECT scadenza_id,scadenza_data,scadenza_descrizione_breve,scadenza_descrizione_lunga,scadenza_file 
                  FROM ".$tabelle['scadenze']." WHERE scadenza_status='Aperto' ORDER BY scadenza_data ASC";
$result_scadenze=$sql->select_query($select_scadenze);
// Carichiamo le scadenze inserite a mano

$statpb=array(
    'Liberi1' => 0,
    'Liberi2' => 0,
    'Affittati1' => 0,
    'Affittati2' => 0,
    'Venduti' => 0,
    'Opzionati' => 0,
    'Prenotati1' => 0,
    'Prenotati2' => 0,
    'Presenze' => 0
);

// Carichiamo i totali dei posti barca affittati, liberi, etc...
$res = $sql->select_query(
    "SELECT DISTINCT status, COUNT(*) AS totale FROM blue_posti_barca_status WHERE posto_barca!='' GROUP BY status"
);

while ($row=mysql_fetch_array($res)) {
    switch ($row['status']) {
        case "Affitto":
            $statpb['Affittati1']+=$row['totale'];
            break;
        case "Affitto su Gestione":
            $statpb['Affittati2']+=$row['totale'];
            break;
        case "Gestione":
            $statpb['Liberi2']+=$row['totale'];
            break;
        case "Vendita":
            $statpb['Venduti']+=$row['totale'];
            break;
        case "Opzione":
            $statpb['Opzionati']+=$row['totale'];
            break;
        case "Prenotazione":
            $statpb['Prenotati1']+=$row['totale'];
            break;
        case "Prenotazione su Gestione":
            $statpb['Prenotati2']+=$row['totale'];
            break;
        default:
        case "":
            $statpb['Liberi1']+=$row['totale'];
            break;
    }
}
// Totale delle presenze
$res2=$sql->select_query("SELECT COUNT(*) AS totale FROM blue_posti_barca_status WHERE presenza='1'");
$statpb['Presenze']+=mysql_result($res2, 0, 'totale');

// Totale delle opzioni
$res3=$sql->select_query("SELECT COUNT(*) AS totale FROM blue_contratti WHERE contratto_tipo='13'");
$statpb['Opzionati']=mysql_result($res3, 0, 'totale');
//$statpb['Liberi1']+=$statpb['Opzionati'];

$server_ip=$_SERVER["SERVER_NAME"];

$portmap = true;
if ($portmap) {
    $regions_contract = new StdClass();
    $regions_contract->pierStructure = new StdClass();
    $regions_contract->pierStructure->disabled = false;

    $regions_presence = new StdClass();
    $regions_presence->pierStructure = new StdClass();
    $regions_presence->pierStructure->disabled = false;

    // Load portmap status and presence
    $select = "SELECT pbs.*, c.*, b.* 
               FROM " . $tabelle['posti_barca_status'] . " AS pbs
               LEFT JOIN " . $tabelle['clienti'] . " AS c ON c.cliente_id = pbs.cliente
               LEFT JOIN " . $tabelle['barche'] . " AS b ON b.barca_id = pbs.barca
               ";
    $result = $sql->select_query($select);
    while ($r = mysql_fetch_assoc($result)) {
        
        if (strlen($r['posto_barca']) == 0) {
            continue;
        }

        $object = new StdClass();
        $object->tooltip = $r['status'];
        $object->attr = new StdClass();
        $object->attr->fill = "#000000";
        $object->attr->href = "/posto_barca_dettagli.php?id=" . $r['posto_barca_id'];
        $object->attr->cursor = "pointer";
        switch ($r['status']) {

            case '':
                $object->attr->fill = "#FFFFFF";
                $object->tooltip = "<h4>" . implode('', explode("_", $r['posto_barca'])) . " " . Yii::t('app', 'Free') . "</h4>";
                break;

            case 'Affitto':
                $object->attr->fill = "#FFFF00";
                $object->tooltip = "<h4>" . implode('', explode("_", $r['posto_barca'])) . " " . Yii::t('app', 'Rent') . " </h4>"
                                 . "<p><strong>" . $r['cliente_nominativo'] . "</strong></p>";
                break;

            case 'Affitto su Gestione':
                $object->attr->fill = "#FF9900";
                $object->tooltip = "<h4>" . implode('', explode("_", $r['posto_barca'])) . " " . Yii::t('app', 'Rent managed') . " </h4>"
                                 . "<p><strong>" . $r['cliente_nominativo'] . "</strong></p>";
                break;

            case 'Gestione':
                $object->attr->fill = "#FF00FF";
                $object->tooltip = "<h4>" . implode('', explode("_", $r['posto_barca'])) . " " . Yii::t('app', 'Managed') . " </h4>"
                                 . "<p><strong>" . $r['cliente_nominativo'] . "</strong></p>";
                break;

            case 'Opzione':
                $object->attr->fill = "#AAAAAA";
                $object->tooltip = "<h4>" . implode('', explode("_", $r['posto_barca'])) . " " . Yii::t('app', 'Optioned') . " </h4>"
                                 . "<p><strong>" . $r['cliente_nominativo'] . "</strong></p>";
                break;

            case 'Prenotazione':
                $object->attr->fill = "#00FFFF";
                $object->tooltip = "<h4>" . implode('', explode("_", $r['posto_barca'])) . " " . Yii::t('app', 'Reserved') . " </h4>"
                                 . "<p><strong>" . $r['cliente_nominativo'] . "</strong></p>";
                break;

            case 'Vendita':
                $object->attr->fill = "#FF0000";
                $object->tooltip = "<h4>" . implode('', explode("_", $r['posto_barca'])) . " " . Yii::t('app', 'Sell') . " </h4>"
                                 . "<p><strong>" . $r['cliente_nominativo'] . "</strong></p>";
                break;

            default:
                $object->attr->fill = "#000000";
                $object->tooltip = "<h4>" . implode('', explode("_", $r['posto_barca'])) . " " . Yii::t('app', 'Status not managed') . " </h4>"
                                 . "<p><strong>" . $r['cliente_nominativo'] . "</strong></p>";
                break;

        }
        $regions_contract->$r['posto_barca'] = $object;

        $object = new StdClass();
        $object->tooltip = $r['presenza'];
        $object->attr = new StdClass();
        $object->attr->fill = "#000000";
        $object->attr->href = "/posto_barca_dettagli.php?id=" . $r['posto_barca_id'];
        $object->attr->cursor = "pointer";
        switch ($r['presenza']) {

            case '':
                $object->attr->fill = "#00FF00";
                $object->tooltip = Yii::t('app', 'Empty');
                break;

            case '1':
                $object->attr->fill = "#FF0000";
                $object->tooltip = Yii::t('app', 'Presence');
                break;

            default:
                $object->attr->fill = "#000000";
                $object->tooltip = Yii::t('app', 'Presence not managed') . " " . $r['presenza'];

        }
        $regions_presence->$r['posto_barca'] = $object;


    }

    $regions_contract = json_encode($regions_contract);
    $regions_presence = json_encode($regions_presence);
    // CVarDumper::dump($regions_contract, 10, true); exit;
}

require_once 'views/site/index.php';
