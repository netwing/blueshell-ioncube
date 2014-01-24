<?php
require_once("config.inc.php");
$blue->autentica_utente("contratti","W");
if (array_key_exists('rid', $_GET) === false) {
    header("Location: index.php");
    exit;
}
$form->campi_testo = array("cliente", "barca", "presenza_inizio", "presenza_fine");
$form->campi_obbligatori = array("cliente", "barca", "presenza_inizio");
$form->valori_default = array('presenza_inizio' => strftime("%Y-%m-%d", time()));
$form->inizializza();
if (count($_POST) > 0) {
    $form->verifica();
    if ($form->errore_form === false) {
        $cliente=$_POST['cliente'];
        $barca=$_POST['barca'];
        $posto_barca = intval($_GET['rid']);
        $cliente=$_POST['cliente'];
        $barca=$_POST['barca'];
        $arrivo = $_POST['presenza_inizio'];
        if ($_POST['presenza_fine']!="") {       
            $partenza = $_POST['presenza_fine'];
        } else {
            $partenza = "0000-00-00";
        }
        $insert = "INSERT INTO " . $tabelle['presenze'] . " 
                    (presenza_posto_barca,presenza_cliente,presenza_barca,presenza_arrivo,presenza_partenza) 
                    VALUES ('".$posto_barca."','".$cliente."','".$barca."','".$arrivo."','".$partenza."')";
        $sql->insert_query($insert);
        header("Location:posto_barca_dettagli.php?id=" . $posto_barca);
        exit;
    }
}

require_once "views/presence/create.php";
