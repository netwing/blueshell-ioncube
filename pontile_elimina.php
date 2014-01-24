<?php
require_once("config.inc.php");
$blue->autentica_utente("anagrafica","W");
$tot1=0;
$tot2=0;
$tot3=0;
$tot4=0;
$tot5=0;
$tot6=0;
if (array_key_exists("pontile_id",$_POST)) {
	$delete="DELETE FROM ".$tabelle['pontili']." WHERE pontile_id='".$_POST['pontile_id']."'";
	$result = $sql->delete_query($delete);
	if ($result) {
		Yii::app()->user->setFlash('success', Yii::t('app', 'Resource group deleted successfully.'));
	} else {
		Yii::app()->user->setFlash('success', Yii::t('app', 'An error occured'));
	}
	header("Location:pontili.php");
	exit();
}elseif (array_key_exists("id",$_GET)) {
	$select="SELECT COUNT(*) AS tot FROM ".$tabelle['posti_barca']
				." WHERE posto_barca_pontile='".$_GET['id']."'";
	$result=$sql->select_query($select);
	$tot1=mysql_result($result,0,'tot');

	// Totale delle ricorrenze del cliente nelle imbarcazioni
	if ($tot1==0)
	{
		$messaggio =  '<div class="alert alert-success">'
				   .  Yii::t('app', 'This resource group was unused in the system and can be safely deleted.')
				   .  '</div>';
		$elimina = true;
	}
	else
	{
		$messaggio = '<div class="alert alert-info">' 
				   	. Yii::t('app', 'This resource group has {count1} resources', array('{count1}' => $tot1) )
				   	. '</div>'; 
		$messaggio.= '<div class="alert alert-danger">' 
					. Yii::t('app', 'This resource group cannot be deleted.') 
					. '</div>';

		$elimina = false;
	}

	require_once "views/resource_group/delete.php";

} else {
	header("Location:portili.php");
	exit();
}
?>
