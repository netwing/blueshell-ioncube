<?php
require_once("config.inc.php");
$blue->autentica_utente("anagrafica","W");
$tot1=0;
$tot2=0;
$tot3=0;
$tot4=0;
$tot5=0;
$tot6=0;
if (array_key_exists("cliente_id",$_POST)) {
	$delete="DELETE FROM ".$tabelle['clienti']." WHERE cliente_id='".$_POST['cliente_id']."'";
	$result = $sql->delete_query($delete);
	if ($result) {
		Yii::app()->user->setFlash('success', Yii::t('app', 'Client deleted successfully.'));
	} else {
		Yii::app()->user->setFlash('success', Yii::t('app', 'An error occured'));
	}
	header("Location:clienti.php");
	exit();
} elseif (array_key_exists("id",$_GET)) {
	$select="SELECT COUNT(*) AS tot FROM ".$tabelle['contratti']." WHERE contratto_anagrafica1='".$_GET['id']."' OR contratto_anagrafica2='".$_GET['id']."'";
	$result=$sql->select_query($select);
	$tot1=mysql_result($result,0,'tot');
	// Totale delle ricorrenze del cliente nei contratti
	$select="SELECT COUNT(*) AS tot FROM ".$tabelle['presenze']." WHERE presenza_cliente='".$_GET['id']."'";
	$result=$sql->select_query($select);
	$tot2=mysql_result($result,0,'tot');
	// Totale delle ricorrenze del cliente nelle presenze
	$select="SELECT COUNT(*) AS tot FROM ".$tabelle['clienti_note']." WHERE cliente_nota_cliente_id='".$_GET['id']."'";
	$result=$sql->select_query($select);
	$tot3=mysql_result($result,0,'tot');
	// Totale delle ricorrenze del cliente nelle note
	$select="SELECT COUNT(*) AS tot FROM ".$tabelle['fatture']." WHERE fattura_cliente_id='".$_GET['id']."'";
	$result=$sql->select_query($select);
	$tot4=mysql_result($result,0,'tot');
	// Totale delle ricorrenze del cliente nelle fatture
	$select="SELECT COUNT(*) AS tot FROM ".$tabelle['barche_trasferimenti']." WHERE barca_trasferimento_da='".$_GET['id']."' OR barca_trasferimento_a='".$_GET['id']."'";
	$result=$sql->select_query($select);
	$tot5=mysql_result($result,0,'tot');
	// Totale delle ricorrenze del cliente nei trasferimenti delle imbarcazioni
	$select="SELECT COUNT(*) AS tot FROM ".$tabelle['barche']." WHERE barca_proprietario='".$_GET['id']."'";
	$result=$sql->select_query($select);
	$tot6=mysql_result($result,0,'tot');
	// Totale delle ricorrenze del cliente nelle imbarcazioni
	if ($tot1==0 and $tot2==0 and $tot3==0)
	{
		$messaggio =  '<div class="alert alert-success">'
				   .  Yii::t('app', 'This client was unused in the system and can be safely deleted.')
				   .  '</div>';
		$elimina = true;
	}
	else
	{
		$messaggio = '<div class="alert alert-info">' 
				   . Yii::t('app', 'This client was in {count1} contract, {count2} presence, {count3} notes, {count4} invoices, {count5} vector transfers, {count6} as vectors owner', 
				   		array('{count1}' => $tot1, '{count2}' => $tot2, '{count3}' => $tot3, '{count4}' => $tot4, '{count5}' => $tot5, '{count6}' => $tot6))
				   . '</div>'; 
		$messaggio.= '<div class="alert alert-danger">' . Yii::t('app', 'This client cannot be deleted.') . '</div>';

		$elimina = false;
	}

	require_once "views/client/delete.php";

} else {
	header("Location:clienti.php");
	exit();
}
?>
