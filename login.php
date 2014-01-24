<?php
require_once("config.inc.php");
if (count($_POST) > 0)
{
    if ($_POST['username']!="" and $_POST['password']!="")
    {
        $select="SELECT utente_id,utente_username,utente_nominativo,utente_accesso_principale,utente_accesso_contratti,utente_accesso_anagrafica,utente_accesso_imbarcazioni,utente_accesso_posti_barca,utente_accesso_documenti,utente_accesso_fatture,utente_accesso_template,utente_accesso_listini,utente_accesso_preferenze FROM ".$tabelle['utenti']." WHERE utente_username='".$_POST['username']."' AND utente_password='".md5($_POST['password'])."'";
        $result=$sql->select_query($select);
        if ($sql->select_num_rows==1)
        {
            $row=mysql_fetch_array($result);
            $_SESSION['utente']=array();
            $_SESSION['utente']['utente_id']=$row['utente_id'];
            $_SESSION['utente']['utente_username'] = $row['utente_username'];
            $_SESSION['utente']['utente_nominativo'] = $row['utente_nominativo'];
            $_SESSION['utente']['principale']=$row['utente_accesso_principale'];
            $_SESSION['utente']['contratti']=$row['utente_accesso_contratti'];
            $_SESSION['utente']['anagrafica']=$row['utente_accesso_anagrafica'];
            $_SESSION['utente']['imbarcazioni']=$row['utente_accesso_imbarcazioni'];
            $_SESSION['utente']['posti_barca']=$row['utente_accesso_posti_barca'];
            $_SESSION['utente']['documenti']=$row['utente_accesso_documenti'];
            $_SESSION['utente']['fatture']=$row['utente_accesso_fatture'];
            $_SESSION['utente']['template']=$row['utente_accesso_template'];
            $_SESSION['utente']['listini']=$row['utente_accesso_listini'];
            $_SESSION['utente']['preferenze']=$row['utente_accesso_preferenze'];
            Yii::app()->user->setFlash('success', Yii::t('app', 'Login successful, welcome back.'));
            header("Location:".$_GET['ritorno']);
            exit;
        } else {
            Yii::app()->user->setFlash('danger', Yii::t('app', 'Username not found or invalid password.'));
            header("Location:login.php?ritorno=" . $_GET['ritorno']);
            exit;    
        }
    }
}
if (array_key_exists("logout",$_GET))
{
    unset($_SESSION['utente']);
    session_destroy();
    header("Location:index.php");
    exit;
}

if (!array_key_exists('ritorno', $_GET)) {
    header("Location:login.php?ritorno=index.php");
    exit;
}

require_once "views/site/login.php";
