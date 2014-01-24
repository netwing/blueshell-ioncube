<?php
require_once("config.inc.php");
$blue->autentica_utente("imbarcazioni","W");
if (!array_key_exists("id",$_GET)) {
	header("Location:index.php");
	exit;
}
if (count($_POST)>0) {
	$form->verifica();
	if ($form->errore_form==false) {
		$barca_caratteristiche = "";
		$barca_note = "";
		foreach ($_POST as $k=>$v) {
			$$k=$sql->pulisci($v,false);
		}
		$barca_lunghezza=$sql->decimale_sql($barca_lunghezza);
		$barca_larghezza=$sql->decimale_sql($barca_larghezza);
		$barca_pescaggio=$sql->decimale_sql($barca_pescaggio);
		$barca_scadenza_polizza=$sql->data_sql($barca_scadenza_polizza);
		$barca_scadenza_polizza=$barca_scadenza_polizza[0];
		$update="UPDATE ".$tabelle['barche']." SET barca_nome='".$barca_nome."',barca_tipologia_barca='".$barca_tipologia_barca."',country='".$country."',barca_modello='".$barca_modello."',barca_anno='".$barca_anno."',barca_lunghezza='".$barca_lunghezza."',barca_larghezza='".$barca_larghezza."',barca_pescaggio='".$barca_pescaggio."',barca_motore='".$barca_motore."',barca_matricola_motore1='".$barca_matricola_motore1."',barca_matricola_motore2='".$barca_matricola_motore2."',barca_targa='".$barca_targa."',barca_polizza='".$barca_polizza."',barca_scadenza_polizza='".$barca_scadenza_polizza."',barca_caratteristiche='".$barca_caratteristiche."',barca_colore='".$barca_colore."',barca_proprietario='".$barca_proprietario."',barca_note='".$barca_note."',builder='".$builder."',insurance_company='".$insurance_company."' WHERE barca_id='".$barca_id."'";
		$result = $sql->update_query($update);

		if ($result) {
			Yii::app()->user->setFlash("success", Yii::t('app', 'Vector updated successfully.'));
			header("Location:barche.php");
			exit;
		} else {
			Yii::app()->user->setFlash("danger", Yii::t('app', 'An error occured.'));
			header("Location:barca_inserimento.php?id=" . intval($_GET['id']));
			exit;
		}

	}
}

$select_barca="SELECT * FROM ".$tabelle['barche']." WHERE barca_id='".$_GET['id']."'";
$result_barca=$sql->select_query($select_barca);
$row_barca=mysql_fetch_array($result_barca);
$barca_scadenza_polizza=$sql->data_ita($row_barca['barca_scadenza_polizza']);
$barca_scadenza_polizza=$barca_scadenza_polizza[0];
$elenco_tipologie=$blue->elenco_tipologie();
$k_elenco_tipologie=array_keys($elenco_tipologie);
$elenco_nazioni=$blue->elenco_nazioni();
$k_elenco_nazioni=array_keys($elenco_nazioni);
$elenco_costruttori=$blue->elenco_costruttori();
$k_elenco_costruttori=array_keys($elenco_costruttori);
$elenco_assicurazioni=$blue->elenco_assicurazioni();
$k_elenco_assicurazioni=array_keys($elenco_assicurazioni);
$elenco_clienti=$blue->elenco_clienti();
$k_elenco_clienti=array_keys($elenco_clienti);
$form->campi_testo=array("barca_nome","barca_modello","barca_motore","barca_matricola_motore1","barca_matricola_motore2","barca_targa","barca_polizza","barca_caratteristiche","barca_colore","barca_note", "builder", "insurance_company");
$form->campi_numero=array("barca_anno","barca_lunghezza","barca_larghezza","barca_pescaggio");
$form->campi_data_unica=array("barca_scadenza_polizza");
$form->campi_lista=array("barca_proprietario"=>$k_elenco_clienti,
						"barca_costruttore"=>$k_elenco_costruttori,
						"barca_assicurazione"=>$k_elenco_assicurazioni,
						"barca_tipologia_barca"=>$k_elenco_tipologie,
						"country"=>$k_elenco_nazioni);
$proprietario_default="barca_proprietario_".$row_barca['barca_proprietario'];
$costruttore_default="barca_costruttore_".$row_barca['barca_costruttore'];
$assicurazione_default="barca_assicurazione_".$row_barca['barca_assicurazione'];
$tipologia_default="barca_tipologia_barca_".$row_barca['barca_tipologia_barca'];
$nazione_default="country_".$row_barca['country'];
$form->valori_default=array("barca_nome"=>$row_barca['barca_nome'],
							"barca_modello"=>$row_barca['barca_modello'],
							"barca_motore"=>$row_barca['barca_motore'],
							"barca_matricola_motore1"=>$row_barca['barca_matricola_motore1'],
							"barca_matricola_motore2"=>$row_barca['barca_matricola_motore2'],
							"barca_targa"=>$row_barca['barca_targa'],
							"barca_polizza"=>$row_barca['barca_polizza'],
							"barca_caratteristiche"=>$row_barca['barca_caratteristiche'],
							"barca_colore"=>$row_barca['barca_colore'],
							"barca_note"=>$row_barca['barca_note'],
							"barca_anno"=>$row_barca['barca_anno'],
							"builder" => $row_barca['builder'],
							"insurance_company" => $row_barca['insurance_company'],
							"barca_lunghezza"=>$sql->decimale_ita($row_barca['barca_lunghezza']),
							"barca_larghezza"=>$sql->decimale_ita($row_barca['barca_larghezza']),
							"barca_pescaggio"=>$sql->decimale_ita($row_barca['barca_pescaggio']),
							"barca_scadenza_polizza"=>$barca_scadenza_polizza,
							$proprietario_default=>"selected=\"selected\"",
							$tipologia_default=>"selected=\"selected\"",
							$nazione_default=>"selected=\"selected\""
							);

$form->campi_obbligatori=array("barca_nome","barca_proprietario");
$form->inizializza();

$action = "barca_modifica.php?id=" . intval($_GET['id']);
require_once "views/vector/edit.php";
