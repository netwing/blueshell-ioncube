<?php
require_once("config.inc.php");
$blue->autentica_utente("contratti","W");

$periodi = $blue->elenco_periodi();
$dimensioni = $blue->elenco_dimensioni();
$pontili = $blue->elenco_pontili();
$contratto_tipi = $blue->elenco_tipi();
$posto_barca_id = 0;
$posto_barca_scelto = '';
$contratto_data = strftime("%Y-%m-%d", time());
$dimensione_id = 0;
if (count($_POST) > 0) {
	$contratto_anagrafica1 = $_POST['contratto_anagrafica1'];
	$contratto_anagrafica2 = $_POST['contratto_anagrafica2'];
	$contratto_tipo = $_POST['contratto_tipo'];
	$contratto_periodo = $_POST['contratto_periodo'];
	$contratto_barca = $_POST['contratto_barca'];
	$contratto_posto_barca = $_POST['contratto_posto_barca'];
	$contratto_data = $_POST['contratto_data'];
	$contratto_inizio = $_POST['contratto_inizio'];
	$contratto_fine = $_POST['contratto_fine'];
	$contratto_gestione_percentuale = $_POST['gestione'];
	$contratto_imponibile = $_POST['imponibile'];
	$contratto_totale = $_POST['totale'];
	$contratto_sconto = $_POST['sconto'];

	// QUESTI DUE PRIMA DI INSERIRE IL NUOVO CONTRATTO !!!
	// Se il nuovo contratto è una vendita
	if ($contratto_tipo=="2") {	
		// Chiudiamo l'eventuale contratto di vendita precedente
		$sel_vendita = "SELECT * FROM blue_contratti WHERE contratto_tipo='2' AND contratto_posto_barca='".$contratto_posto_barca."' AND contratto_fine>'".$contratto_inizio."'";
		$res_vendita = $sql->select_query($sel_vendita);
		if ($sql->select_num_rows > 0) {
			$row_vendita=mysql_fetch_array($res_vendita);
			$update="UPDATE blue_contratti SET contratto_fine='".$contratto_inizio."' WHERE contratto_id='".$row_vendita['contratto_id']."'";
			$sql->update_query($update);
		}
		// Chiudiamo l'eventuale contratto di gestione precedente
		$sel_gestione = "SELECT * FROM blue_contratti WHERE contratto_tipo='3' AND contratto_posto_barca='".$contratto_posto_barca."' AND contratto_fine>'".$contratto_inizio."'";
		$res_gestione = $sql->select_query($sel_gestione);
		if ($sql->select_num_rows > 0) {
			$row_gestione=mysql_fetch_array($res_gestione);
			$update="UPDATE blue_contratti SET contratto_fine='".$contratto_inizio."' WHERE contratto_id='".$row_gestione['contratto_id']."'";
			$sql->update_query($update);
		}
	}		

	$insert="INSERT INTO blue_contratti 
			 (contratto_anagrafica1,contratto_anagrafica2,contratto_tipo,contratto_periodo,contratto_barca,contratto_posto_barca,
			 	contratto_data,contratto_inizio,contratto_fine,contratto_gestione_percentuale,contratto_imponibile,contratto_totale,contratto_sconto) 
			 VALUES ('".$contratto_anagrafica1."','".$contratto_anagrafica2."','".$contratto_tipo."','".$contratto_periodo."','".$contratto_barca."','".$contratto_posto_barca."',
			 	'".$contratto_data."','".$contratto_inizio."','".$contratto_fine."','".$contratto_gestione_percentuale."',
			 	'".$contratto_imponibile."','".$contratto_totale."','".$contratto_sconto."')";
	$sql->insert_query($insert);
	$id = $sql->insert_last_id;

	// Aggiornamento Proprietario
	if ($contratto_tipo == '2') {
		$update="UPDATE blue_posti_barca 
				 SET posto_barca_proprietario='".$contratto_anagrafica2."', posto_barca_proprietario_data='".$contratto_inizio."' 
				 WHERE posto_barca_id='".$contratto_posto_barca."'";
		$sql->update_query($update);
	}
	
	// Aggiornamento Gestore
	if ($contratto_tipo == '3') {
		$update="UPDATE blue_posti_barca 
				 SET posto_barca_gestore='".$contratto_anagrafica2."', posto_barca_gestore_data='".$contratto_inizio."' 
				 WHERE posto_barca_id='".$contratto_posto_barca."'";
		$sql->update_query($update);
	}	

    Yii::app()->user->setFlash('success', Yii::t('app', 'New contract created successfully.'));
    header("Location:riepilogo.php?id=" . $id);
    exit;

}

if (array_key_exists('pb', $_GET)) {
	$res = $sql->select_query("SELECT posto_barca_pontile,posto_barca_numero,posto_barca_dimensioni FROM blue_posti_barca WHERE posto_barca_id='".$_GET['pb']."'");
	if ($sql->select_num_rows>0) {
		$posto_barca_id=$_GET['pb'];
		$posto_barca_pontile=mysql_result($res,0,'posto_barca_pontile');
		$pontile_pb_scelto=$pontili[$posto_barca_pontile];
		$posto_barca_numero=mysql_result($res,0,'posto_barca_numero');
		$posto_barca_scelto=$pontile_pb_scelto.$posto_barca_numero;
		$dimensione_id=mysql_result($res,0,'posto_barca_dimensioni');
	}
}

require_once "views/contract/create.php";
