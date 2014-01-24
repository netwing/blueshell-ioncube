<?php
require_once("config.inc.php");
$blue->autentica_utente("posti_barca","R");

$form->campi_testo=array("pontile_codice", "nome");
$form->campi_obbligatori=array("pontile_codice");

$form->valori_default=array("pontile_codice"=>"");
$form->inizializza();


// Se l'utente aggiunge un Posto Barca a questo pontile
if (count($_POST)>0)
{
	$form->verifica();
	if ($form->errore_form === false) {
		foreach ($_POST as $k=>$v) {
			$$k=$sql->pulisci($v);
		}
		
		$pc=$_POST['pontile_codice'];
		$nome=$_POST['nome'];
		if ($nome=="")
		{
			$nome="Pontile ".$pc;
			
		}

		// Check to avoid duplications of codes
		$count_query="SELECT COUNT(*) as tot FROM ".$tabelle['pontili']." WHERE pontile_codice = '$pc' ";
 
		$result=$sql->select_query($count_query);
		$tot1=mysql_result($result,0,'tot');

		if ($tot1 >0) {
			Yii::app()->user->setFlash("danger", Yii::t('app', 'Resource group with this code already exists, please choose another code.'));
		} else {
			$insert="INSERT INTO ".$tabelle['pontili']." (pontile_nome,pontile_codice,pontile_tipo) VALUES ('".$nome."','".$pc."','1')";
			$sql->insert_query($insert);
			$lastid=$sql->insert_last_id;

			if ($lastid) {
				Yii::app()->user->setFlash("success", Yii::t('app', 'Resource group successfully created.'));
			} else {
				Yii::app()->user->setFlash("danger", Yii::t('app', 'An error occured.'));
				header("Location:portili.php");
				exit;
			}	
		}

	}
}

//$select="SELECT * FROM ".$tabelle['pontili']." ORDER BY pontile_codice ASC";

$select = "SELECT *, COUNT(pb.posto_barca_id) as 'posti_barca_conteggio'
			FROM `blue_pontili` as p
			LEFT join blue_posti_barca as pb
			ON p.pontile_id = pb.posto_barca_pontile
			GROUP BY (p.pontile_id)";
$result_resource_group=$sql->select_query($select);

$action = "pontili.php";
require_once "views/resource_group/admin.php";

?>
