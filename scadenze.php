<?php
require_once("config.inc.php");
$blue->autentica_utente("principale","R");
$form->campi_testo = array("scadenza_data","scadenza_descrizione_breve","scadenza_descrizione_lunga","scadenza_file");
$form->campi_obbligatori = array("scadenza_data","scadenza_descrizione_breve");
$form->valori_default = array("scadenza_data" => strftime("%Y-%m-%d", strtotime("+7 days")));
$tipi = array();
$form->inizializza();

if (count($_POST) > 0) {
    $form->verifica();
    $form->verifica_file(500000, $tipi, false);

    if ($form->errore_form === false) {
        $data_scadenza = $sql->pulisci($_POST['scadenza_data']);
        $descrizione_breve = $sql->pulisci($_POST['scadenza_descrizione_breve']);
        $descrizione_lunga = $sql->pulisci($_POST['scadenza_descrizione_lunga']);
        $insert="INSERT INTO " . $tabelle['scadenze'] . " (scadenza_data,scadenza_descrizione_breve,scadenza_descrizione_lunga) 
                 VALUES ('".$data_scadenza."','".$descrizione_breve."','".$descrizione_lunga."')";

        $esit = $sql->insert_query($insert);
        if ($esit === false) {
            Yii::app()->user->setFlash("danger", Yii::t('app', 'An error occured.'));
            header("Location:scadenze.php");
            exit;
        }
        $lastid = $sql->insert_last_id;

        if (count($_FILES) > 0) {
            if (!file_exists("upload/")) {
                throw new Exception("Upload directory do not exists!");
            }
            if (!is_writable("upload/")) {
                throw new Exception("Upload directory was not writable!");   
            }
            $destinazione = $lastid . "_" . $_FILES['scadenza_file']['name'];
            move_uploaded_file($_FILES['scadenza_file']['tmp_name'], "upload/".$destinazione);

            $update = "UPDATE " . $tabelle['scadenze'] . " 
                       SET scadenza_file='" . $_FILES['scadenza_file']['name'] . "' 
                       WHERE scadenza_id='" . $lastid . "'";
            $sql->update_query($update);
        }

        $form->valori_default=array();
        $form->inizializza();
        Yii::app()->user->setFlash("success", Yii::t('app', 'Deadline successfully saved.'));
        header("Location:scadenze.php");
        exit;

    }
}

require_once "views/site/scadenze.php";