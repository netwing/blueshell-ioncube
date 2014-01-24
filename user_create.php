<?php
require_once("config.inc.php");
$blue->autentica_utente("preferenze","W");
$radio_scelte=array("N","R","W");
$form->campi_testo=array("utente_username","utente_nominativo","utente_telefono","utente_email");
$form->campi_radiobutton=array("utente_accesso_principale"=>$radio_scelte,"utente_accesso_contratti"=>$radio_scelte,"utente_accesso_anagrafica"=>$radio_scelte,"utente_accesso_imbarcazioni"=>$radio_scelte,"utente_accesso_posti_barca"=>$radio_scelte,"utente_accesso_documenti"=>$radio_scelte,"utente_accesso_fatture"=>$radio_scelte,"utente_accesso_template"=>$radio_scelte,"utente_accesso_listini"=>$radio_scelte,"utente_accesso_preferenze"=>$radio_scelte);
$form->valori_default=array("utente_accesso_principale_N"=>'checked="checked"',"utente_accesso_contratti_N"=>'checked="checked"',"utente_accesso_anagrafica_N"=>'checked="checked"',"utente_accesso_imbarcazioni_N"=>'checked="checked"',"utente_accesso_posti_barca_N"=>'checked="checked"',"utente_accesso_documenti_N"=>'checked="checked"',"utente_accesso_fatture_N"=>'checked="checked"',"utente_accesso_template_N"=>'checked="checked"',"utente_accesso_listini_N"=>'checked="checked"',"utente_accesso_preferenze_N"=>'checked="checked"');
$form->campi_obbligatori=array("utente_username");
$form->inizializza();

if (count($_POST)>0) {        
    $form->verifica();
    if ($form->errore_form === false) {

        $utente_username = $sql->pulisci($_POST['utente_username']);
        $select = "SELECT * FROM " . $tabelle['utenti'] . " WHERE utente_username = '" . $utente_username . "'";
        $result = $sql->select_query($select);
        if (mysql_num_rows($result) == 0) {
            foreach ($_POST as $k=>$v) {
                $$k=$sql->pulisci($v);
            }
            $insert="INSERT INTO ".$tabelle['utenti']." (utente_username,utente_password,utente_nominativo,utente_telefono,utente_email,utente_accesso_principale,utente_accesso_contratti,utente_accesso_anagrafica,utente_accesso_imbarcazioni,utente_accesso_posti_barca,utente_accesso_fatture,utente_accesso_documenti,utente_accesso_listini,utente_accesso_template,utente_accesso_preferenze) VALUES ('".$utente_username."',MD5('".$utente_password."'),'".$utente_nominativo."','".$utente_telefono."','".$utente_email."','".$utente_accesso_principale."','".$utente_accesso_contratti."','".$utente_accesso_anagrafica."','".$utente_accesso_imbarcazioni."','".$utente_accesso_posti_barca."','".$utente_accesso_fatture."','".$utente_accesso_documenti."','".$utente_accesso_listini."','".$utente_accesso_template."','".$utente_accesso_preferenze."')";
            $result = $sql->insert_query($insert);
            if ($result) {
                Yii::app()->user->setFlash('success', Yii::t('app', 'User created successfully.'));
            } else {
                Yii::app()->user->setFlash('success', Yii::t('app', 'An error occured.'));
            }
            header("Location:preferenze_utenti.php");
            exit;
        } else {
            $form->add_error('utente_username', Yii::t('app', 'This username was already taken.'));
        }  
    }
}

$action = "user_create.php";
require_once "views/user/create.php";
