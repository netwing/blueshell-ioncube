<?php
require_once("config.inc.php");
$blue->autentica_utente("preferenze","W");
$radio_scelte=array("N","R","W");
$form->campi_testo=array("utente_username","utente_nominativo","utente_telefono","utente_email");
$form->campi_radiobutton=array("utente_accesso_principale"=>$radio_scelte,"utente_accesso_contratti"=>$radio_scelte,"utente_accesso_anagrafica"=>$radio_scelte,"utente_accesso_imbarcazioni"=>$radio_scelte,"utente_accesso_posti_barca"=>$radio_scelte,"utente_accesso_documenti"=>$radio_scelte,"utente_accesso_fatture"=>$radio_scelte,"utente_accesso_template"=>$radio_scelte,"utente_accesso_listini"=>$radio_scelte,"utente_accesso_preferenze"=>$radio_scelte);
$form->valori_default=array("utente_accesso_principale_N"=>'checked="checked"',"utente_accesso_contratti_N"=>'checked="checked"',"utente_accesso_anagrafica_N"=>'checked="checked"',"utente_accesso_imbarcazioni_N"=>'checked="checked"',"utente_accesso_posti_barca_N"=>'checked="checked"',"utente_accesso_documenti_N"=>'checked="checked"',"utente_accesso_fatture_N"=>'checked="checked"',"utente_accesso_template_N"=>'checked="checked"',"utente_accesso_listini_N"=>'checked="checked"',"utente_accesso_preferenze_N"=>'checked="checked"');
$form->campi_obbligatori=array("utente_username");
$form->inizializza();

if (array_key_exists("id",$_GET) and intval($_GET['id']) > 0) {
    $select="SELECT * FROM ".$tabelle['utenti']." WHERE utente_id='".intval($_GET['id'])."'";
    $result=$sql->select_query($select);
    $row=mysql_fetch_array($result);
    $principale="utente_accesso_principale_".$row['utente_accesso_principale'];
    $contratti="utente_accesso_contratti_".$row['utente_accesso_contratti'];
    $anagrafica="utente_accesso_anagrafica_".$row['utente_accesso_anagrafica'];
    $imbarcazioni="utente_accesso_imbarcazioni_".$row['utente_accesso_imbarcazioni'];
    $posti_barca="utente_accesso_posti_barca_".$row['utente_accesso_posti_barca'];
    $documenti="utente_accesso_documenti_".$row['utente_accesso_documenti'];
    $fatture="utente_accesso_fatture_".$row['utente_accesso_fatture'];
    $template="utente_accesso_template_".$row['utente_accesso_template'];
    $listini="utente_accesso_listini_".$row['utente_accesso_listini'];
    $preferenze="utente_accesso_preferenze_".$row['utente_accesso_preferenze']; 
    $form->valori_default=array("utente_username"=>$row['utente_username'],"utente_nominativo"=>$row['utente_nominativo'],"utente_telefono"=>$row['utente_telefono'],"utente_email"=>$row['utente_email'],$principale=>'checked="checked"',$contratti=>'checked="checked"',$anagrafica=>'checked="checked"',$imbarcazioni=>'checked="checked"',$posti_barca=>'checked="checked"',$documenti=>'checked="checked"',$fatture=>'checked="checked"',$template=>'checked="checked"',$listini=>'checked="checked"',$preferenze=>'checked="checked"');
    $form->inizializza();
}


if (count($_POST)>0) {
    $form->verifica();
    if ($form->errore_form==false) {
        foreach ($_POST as $k=>$v) {
            $$k=$sql->pulisci($v);
        }
        $update="UPDATE ".$tabelle['utenti']." SET utente_username='".$utente_username."',utente_nominativo='".$utente_nominativo."',utente_telefono='".$utente_telefono."',utente_email='".$utente_email."',utente_accesso_principale='".$utente_accesso_principale."',utente_accesso_contratti='".$utente_accesso_contratti."',utente_accesso_anagrafica='".$utente_accesso_anagrafica."',utente_accesso_imbarcazioni='".$utente_accesso_imbarcazioni."',utente_accesso_posti_barca='".$utente_accesso_posti_barca."',utente_accesso_fatture='".$utente_accesso_fatture."',utente_accesso_documenti='".$utente_accesso_documenti."',utente_accesso_listini='".$utente_accesso_listini."',utente_accesso_template='".$utente_accesso_template."',utente_accesso_preferenze='".$utente_accesso_preferenze."' WHERE utente_id='".intval($_GET['id'])."'";
        $result = $sql->update_query($update);
        if ($result and $utente_password != "") {
            $result = $update="UPDATE ".$tabelle['utenti']." SET utente_password=MD5('".$utente_password."') WHERE utente_id='".intval($_GET['id'])."'";
            $sql->update_query($update);
        }
        if ($result) {
            Yii::app()->user->setFlash('success', Yii::t('app', 'User updated successfully.'));
        } else {
            Yii::app()->user->setFlash('success', Yii::t('app', 'An error occured.'));
        }        
        header("Location:preferenze_utenti.php");
        exit;
    }
}

$action = "user_update.php?id=" . intval($_GET['id']);
require_once "views/user/update.php";
