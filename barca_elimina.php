<?php
require_once("config.inc.php");
$blue->autentica_utente("imbarcazioni","W");
$tot1=0;
$tot2=0;
$tot3=0;

if (array_key_exists("barca_id",$_POST)) {
	$delete="DELETE FROM " . $tabelle['barche'] . " WHERE barca_id='" . $_POST['barca_id'] . "'";
	$result = $sql->delete_query($delete);
	if ($result) {
		Yii::app()->user->setFlash('success', Yii::t('app', 'Vector deleted successfully.'));
	} else {
		Yii::app()->user->setFlash('success', Yii::t('app', 'An error occured'));
	}
	header("Location:barche.php");
	exit();
} elseif (array_key_exists("id",$_GET)) {
	$select="SELECT COUNT(*) AS tot FROM ".$tabelle['contratti'] . " WHERE contratto_barca='".$_GET['id']."'";
	$result=$sql->select_query($select);
	$tot1=mysql_result($result,0,'tot');
	// Totale delle ricorrenze della barca nei contratti
	$select="SELECT COUNT(*) AS tot FROM ".$tabelle['presenze']." WHERE presenza_barca='".$_GET['id']."'";
	$result=$sql->select_query($select);
	$tot2=mysql_result($result,0,'tot');
	// Totale delle ricorrenze della barca nelle presenze
	$select="SELECT COUNT(*) AS tot FROM ".$tabelle['barche_trasferimenti']." WHERE barca_trasferimento_barca='".$_GET['id']."'";
	$result=$sql->select_query($select);
	$tot3=mysql_result($result,0,'tot');
	// Totale delle ricorrenze della barca nelle presenze
	if ($tot1==0 and $tot2==0 and $tot3==0)
	{
		$messaggio = '<div class="alert alert-success">' 
				   . Yii::t('app', 'This vector was unused in the system and can be safely deleted.')
				   . '</div>';
		$elimina=true;
	}
	else
	{
		$messaggio = '<div class="alert alert-info">' 
				   . Yii::t('app', 'This vector was in {count1} contract, {count2} presence and {count3} property transfer.', array('{count1}' => $tot1, '{count2}' => $tot2, '{count3}' => $tot3))
				   . '</div>'; 
		$messaggio.= '<div class="alert alert-danger">' . Yii::t('app', 'This vector cannot be deleted.') . '</div>';
		$elimina=false;
	}
	/*
	$smarty->assign("messaggio",$messaggio);
	$smarty->assign("get_id",$_GET['id']);
	$smarty->assign("elimina",$elimina);
	*/
	require_once "views/vector/delete.php";
} else {
	header("Location:barche.php");
	exit();
}
?>