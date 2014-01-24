<?php
require_once("config.inc.php");
$blue->autentica_utente("listini","W");
$elenco_dimensioni=$blue->elenco_dimensioni();
$select_anni="SELECT DISTINCT(listino_posto_barca_anno) AS anni FROM ".$tabelle['listini_posti_barca']." ORDER BY listino_posto_barca_anno ASC";
$result_anni=$sql->select_query($select_anni);
$paginazione_anni="";
while ($row_anni=mysql_fetch_array($result_anni))
{
    $paginazione_anni.="<a href=\"listini_posti_barca.php?anno=".$row_anni['anni']."\">".$row_anni['anni']."</a> | ";
}
$anno=date("Y",time());
if (array_key_exists("anno",$_GET))
{
    $_SESSION['listini_anno']=substr($_GET['anno'],0,4);
}
if (array_key_exists("listini_anno",$_SESSION) and $_SESSION['listini_anno']!="")
{
    $anno=$_SESSION['listini_anno'];
}
if (count($_POST)>0) {


    if (array_key_exists('delete', $_POST) and $_POST['delete'] !== null) {
        $delete = "DELETE FROM ".$tabelle['listini_posti_barca']." WHERE listino_posto_barca_anno = '".$anno."'";
        $esit = $sql->delete_query($delete);
        if ($esit) {
            Yii::app()->user->setFlash('success', Yii::t('app', 'Prices list successfully deleted'));
        } else {
            Yii::app()->user->setFlash('danger', Yii::t('app', 'An error occured.'));
        }
        header("Location:listini_posti_barca.php?anno=" . $anno);
        exit;
    }

    $select_id="SELECT listino_posto_barca_id FROM ".$tabelle['listini_posti_barca']." WHERE listino_posto_barca_anno='".$anno."' ORDER BY listino_posto_barca_id";
    $result_id=$sql->select_query($select_id);
    while ($row_id=mysql_fetch_array($result_id)) {
        if (array_key_exists($row_id['listino_posto_barca_id'],$_POST['costo_giornaliero'])) {       
            $costo_giornaliero=$sql->decimale_sql($_POST['costo_giornaliero'][$row_id['listino_posto_barca_id']]);
            $costo_e1=$sql->decimale_sql($_POST['costo_e1'][$row_id['listino_posto_barca_id']]);
            $costo_e2=$sql->decimale_sql($_POST['costo_e2'][$row_id['listino_posto_barca_id']]);
            $costo_em=$sql->decimale_sql($_POST['costo_em'][$row_id['listino_posto_barca_id']]);
            $costo_es=$sql->decimale_sql($_POST['costo_es'][$row_id['listino_posto_barca_id']]);
            $costo_i1=$sql->decimale_sql($_POST['costo_i1'][$row_id['listino_posto_barca_id']]);
            $costo_i2=$sql->decimale_sql($_POST['costo_i2'][$row_id['listino_posto_barca_id']]);
            $costo_im=$sql->decimale_sql($_POST['costo_im'][$row_id['listino_posto_barca_id']]);
            $costo_is=$sql->decimale_sql($_POST['costo_is'][$row_id['listino_posto_barca_id']]);
            $costo_annuale=$sql->decimale_sql($_POST['costo_annuale'][$row_id['listino_posto_barca_id']]);
            $costo_condominiale=$sql->decimale_sql($_POST['costo_condominiale'][$row_id['listino_posto_barca_id']]);
            $update="UPDATE ".$tabelle['listini_posti_barca']." SET costo_giornaliero='".$costo_giornaliero."',costo_e1='".$costo_e1."',costo_e2='".$costo_e2."',costo_em='".$costo_em."',costo_es='".$costo_es."',costo_i1='".$costo_i1."',costo_i2='".$costo_i2."',costo_im='".$costo_im."',costo_is='".$costo_is."',costo_annuale='".$costo_annuale."',costo_condominiale='".$costo_condominiale."' WHERE listino_posto_barca_id='".$row_id['listino_posto_barca_id']."'";
            $esit = $sql->update_query($update);
            if ($esit) {
                Yii::app()->user->setFlash('success', Yii::t('app', 'Changes saved successfully.'));
            } else {
                Yii::app()->user->setFlash('danger', Yii::t('app', 'An error occured.'));
                header("Location:listini_posti_barca.php?anno=" . $anno);
                exit;
            }
        }
    }

    header("Location:listini_posti_barca.php?anno=" . $anno);
    exit;
    
}
# Modifica dei dati

$select_listino="SELECT * FROM ".$tabelle['listini_posti_barca'].",".$tabelle['dimensioni']." WHERE listino_posto_barca_anno='".$anno."' AND dimensione_id=listino_posto_barca_dimensione ORDER BY dimensione_lunghezza ASC, dimensione_larghezza ASC";
$result_listino=$sql->select_query($select_listino);

require_once "views/lists/resources.php";