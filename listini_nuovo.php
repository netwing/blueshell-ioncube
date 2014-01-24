<?php
require_once("config.inc.php");
$blue->autentica_utente("listini","W");
$select_anni="SELECT DISTINCT(listino_posto_barca_anno) AS anni FROM ".$tabelle['listini_posti_barca']." ORDER BY listino_posto_barca_anno ASC";
$result_anni=$sql->select_query($select_anni);
$form->campi_numero=array("anno");
$form->campi_obbligatori=array("anno");
$form->inizializza();
$messaggio="";
if (count($_POST)>0)
{
	$form->verifica();
	if ($form->errore_form===false)
	{
		$select_verifica="SELECT * FROM ".$tabelle['listini_posti_barca']." WHERE listino_posto_barca_anno='".$_POST['anno']."'";
		$result_verifica=$sql->select_query($select_verifica);
		$rows_verifica=$sql->select_num_rows;
		if ($rows_verifica==0)
		{
			if ($_POST['copia_anno']==0)
			{
				$select="SELECT MAX(listino_posto_barca_anno) AS anno FROM ".$tabelle['listini_posti_barca'];
				$result=$sql->select_query($select);
				$anno_copia=mysql_result($result,0,'anno');
			}
			else
			{
				$anno_copia=$_POST['copia_anno'];
			}
			$select_copia="SELECT * FROM ".$tabelle['listini_posti_barca']." WHERE listino_posto_barca_anno='".$anno_copia."'";
			$result_copia=$sql->select_query($select_copia);
			while ($row_copia=mysql_fetch_array($result_copia))
			{
				if ($_POST['copia_anno']==0)
				{
					$insert_copia="INSERT INTO ".$tabelle['listini_posti_barca']." (listino_posto_barca_anno,listino_posto_barca_dimensione,costo_giornaliero,costo_e1,costo_e2,costo_em,costo_es,costo_i1,costo_i2,costo_im,costo_is,costo_annuale,costo_condominiale) VALUES ('".$_POST['anno']."','".$row_copia['listino_posto_barca_dimensione']."','0','0','0','0','0','0','0','0','0','0','0')";
				}
				else
				{
					$insert_copia="INSERT INTO ".$tabelle['listini_posti_barca']." (listino_posto_barca_anno,listino_posto_barca_dimensione,costo_giornaliero,costo_e1,costo_e2,costo_em,costo_es,costo_i1,costo_i2,costo_im,costo_is,costo_annuale,costo_condominiale) VALUES ('".$_POST['anno']."','".$row_copia['listino_posto_barca_dimensione']."','".$row_copia['costo_giornaliero']."','".$row_copia['costo_e1']."','".$row_copia['costo_e2']."','".$row_copia['costo_em']."','".$row_copia['costo_es']."','".$row_copia['costo_i1']."','".$row_copia['costo_i2']."','".$row_copia['costo_im']."','".$row_copia['costo_is']."','".$row_copia['costo_annuale']."','".$row_copia['costo_condominiale']."')";
				}
				$sql->insert_query($insert_copia);
			}
			# Creazione di un nuovo listino dei posti barca
			$select_copia="SELECT * FROM ".$tabelle['listini_generici']." WHERE listino_generico_anno='".$anno_copia."'";
			$result_copia=$sql->select_query($select_copia);
			while ($row_copia=mysql_fetch_array($result_copia))
			{
				if ($_POST['copia_anno']==0)
				{
					$insert_copia="INSERT INTO ".$tabelle['listini_generici']." (listino_generico_anno,listino_generico_descrizione,listino_generico_costo) VALUES ('".$_POST['anno']."','','0')";
					$sql->insert_query($insert_copia);
					break; # Se non viene copiato nessun anno, si inserisce una sola riga vuota nei listini generici
				}
				else
				{
					$insert_copia="INSERT INTO ".$tabelle['listini_generici']." (listino_generico_anno,listino_generico_descrizione,listino_generico_costo) VALUES ('".$_POST['anno']."','".$row_copia['listino_generico_descrizione']."','".$row_copia['listino_generico_costo']."')";
					$sql->insert_query($insert_copia);
					# Se invece si copia il listino di un anno precedente, si aggiunge una voce per ogni voce dell'anno
				}
			}
			Yii::app()->user->setFlash('success', Yii::t('app', 'New prices list created successfully.'));
			header("Location: listini_posti_barca.php?anno=" . $_POST['anno']);
			exit;
		} else {
			Yii::app()->user->setFlash('danger', Yii::t('app', 'Prices list already exists.'));
			header("Location: listini_nuovo.php");
			exit;
		}

	}
}

require_once "views/lists/create.php";
