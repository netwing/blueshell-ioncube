<?php
require_once("config.inc.php");
$ricerca_sostituzione=array();
$clienti=$blue->elenco_clienti();
$posti_barca=$blue->elenco_posti_barca();
$data_presenza_dal = $_POST['data_presenza_dal'];
$data_presenza_al = $_POST['data_presenza_al'];
$pontili=$blue->elenco_pontili();
$dimensioni=$blue->elenco_dimensioni();
$pontile=intval($_POST['pontile']);
$pontile_codice=$pontili[$pontile];
$select_posti_barca="SELECT posto_barca_id FROM ".$tabelle['posti_barca']." WHERE posto_barca_pontile='".$pontile."' ORDER BY posto_barca_id ASC";
$result_posti_barca=$sql->select_query($select_posti_barca);
$posti_barca_pontile=array();
if ($sql->select_num_rows==0)
{
	header("Location:report_presenze.php?nopb");
	exit;
}
while ($row_posti_barca=mysql_fetch_array($result_posti_barca))
{
	$posti_barca_pontile[]=$row_posti_barca['posto_barca_id'];
}
$where_pontili="( presenza_posto_barca=".implode(" OR presenza_posto_barca=",$posti_barca_pontile)." )";
// Carichiamo i posti barca che appartengono al pontile in questione
$select="SELECT presenza_posto_barca,presenza_cliente,presenza_arrivo,presenza_partenza,barca_nome,barca_modello,barca_targa,barca_lunghezza,barca_larghezza,posto_barca_dimensioni FROM ".$tabelle['presenze'].",".$tabelle['barche'].",".$tabelle['posti_barca']." WHERE barca_id=presenza_barca AND posto_barca_id=presenza_posto_barca AND ".$where_pontili." AND (presenza_arrivo<='".$data_presenza_al."' AND (presenza_partenza>='".$data_presenza_dal."' OR presenza_partenza='0000-00-00')) ORDER BY presenza_posto_barca ASC";// OR (presenza_partenza>='".$data_presenza_dal."' AND presenza_partenza<='".$data_presenza_al."') OR (presenza_arrivo>='".$data_presenza_dal."' AND presenza_arrivo<='".$data_presenza_al."' AND presenza_partenza='0000-00-o00') ORDER BY presenza_posto_barca ASC";
$result=$sql->select_query($select);
if ($sql->select_num_rows==0)
{
	header("Location:report_presenze.php?nopr");
	exit;
}
while ($row=mysql_fetch_array($result))
{
	$arrivo=$sql->data_ita($row['presenza_arrivo']);
	$arrivo=$arrivo[0];
	$partenza=$sql->data_ita($row['presenza_partenza']);
	$partenza=$partenza[0];
	$dimensioni_barca=$row['barca_lunghezza']." m. x ".$row['barca_larghezza']." m. ";	
	// $dimensioni_posto_barca=$row['dimensione_lunghezza']." m. x ".$row['dimensione_larghezza']." m. ";	
	$ricerca_sostituzione[]=array(	'<PB>'=>$posti_barca[$row['presenza_posto_barca']],
									'<DIMPB>'=>$dimensioni[$row['posto_barca_dimensioni']],
									'<CLIENTE>'=>$clienti[$row['presenza_cliente']],
									'<BARCA>'=>$row['barca_nome'],
									'<MODELLO>'=>$row['barca_modello'],
									'<TARGA>'=>$row['barca_targa'],
									'<DIMBARCA>'=>$dimensioni_barca,									
									'<ARRIVO>'=>$arrivo,
									'<PARTENZA>'=>$partenza
									);
}

$rtf=new RTF();
//$rtf->intestazioni=array("Codice","Contratto","Cliente","Barca","Posto Barca","Data","Dal","Al");
$rtf->carica_template("template/report_presenze.rtf");
$rtf->rtf_multiriga($ricerca_sostituzione);
$rtf->contenuto_finale=str_replace("<DATA_PRESENZA>",$data_presenza_dal." - ".$data_presenza_al,$rtf->contenuto_finale);
$rtf->contenuto_finale=str_replace("<BOFEOF>","",$rtf->contenuto_finale);
$rtf->contenuto_finale=str_replace("<BOHEOH>","",$rtf->contenuto_finale);
$rtf->output("Report_Presenze_Pontile_".$pontile_codice.".doc");
