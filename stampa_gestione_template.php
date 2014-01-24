<?php
require_once("config.inc.php");
$blue->autentica_utente("template","W");
$messaggio="";
$elenco_file=array(	
    'contratto_affitto.rtf'=>'Contratto di Affitto',
    'contratto_affitto_inglese.rtf'=>'Contratto di Affitto inglese',
    'contratto_gestione.rtf'=>'Contratto di Gestione',
    'contratto_vendita.rtf'=>'Contratto di Vendita',
    'etichette.rtf'=>'Etichette',
    'fattura.rtf'=>'Fattura',
    'lettera_comunicazione.rtf'=>'Comunicazioni ai Clienti',
    'lettera_polizze.rtf'=>'Lettere di Scadenza Polizze',
    'lettera_scadenza.rtf'=>'Lettere di Scadenza Contratti',
    'lettera_spese_condominiali.rtf'=>'Lettere di Spese Condominiali',
    'report_arrivi.rtf'=>'Rapporto Arrivi',
    'report_contratti_fatturato.rtf'=>'Rapporto Contratti e Fatturato',
    'report_contratti.rtf'=>'Rapporto Contratti',
    'report_polizze.rtf'=>'Rapporto Polizze in Scadenza',
    'report_pontile.rtf'=>'Rapporto Status del Pontile',
    'report_presenze.rtf'=>'Rapporto delle Presenze',
    'report_rendite.rtf'=>'Rapporto sulle Rendite'
);

// Template reset
if (array_key_exists('t', $_GET)) {
    $t = trim($_GET['t']);
    if (array_key_exists($t, $elenco_file)) {
        if (file_exists("original-print-template/" . $t) and is_writable("template/")) {
            // Delete file if exists
            if (file_exists("template/" . $t)) {
                unlink("template/" . $t);
            }
            // Copy file
            $esit = copy("original-print-template/" . $t, "template/" . $t);
            if ($esit) {
                Yii::app()->user->setFlash('success', "The template has been reset to original version.");
            } else {
                Yii::app()->user->setFlash('danger', "An error occured.");
            }
            header("Location:stampa_gestione_template.php");
            exit;
        } else {
            if (!file_exists("original-print-template/" . $t)) {
                Yii::app()->user->setFlash('danger', "Default template do not exists!");
            }
            if (!is_writable("template/")) {
                Yii::app()->user->setFlash('danger', "Template path was not writable!");
            }
            header("Location:stampa_gestione_template.php");
            exit;
        }
    }
}

if (count($_POST)>0) {
	if ($_FILES['file']['error']==0 and $_POST['nomefile']!="") {
		$esit = move_uploaded_file($_FILES['file']['tmp_name'],"template/".$_POST['nomefile']);
        if ($esit) {
            Yii::app()->user->setFlash('success', "The template has been updated successfully.");
        } else {
            Yii::app()->user->setFlash('danger', "An error occured.");
        }
        header("Location:stampa_gestione_template.php");
        exit;
	} else {
		Yii::app()->user->setFlash('warning', "You must upload a file and select a destination template.");
        header("Location:stampa_gestione_template.php");
        exit;
	}
}

require_once "views/site/print_template.php";
