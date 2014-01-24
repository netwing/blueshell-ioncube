<?php
require_once('config.inc.php');
$elenco_clienti=$blue->elenco_clienti();
$elenco_clienti[0]='';
$where='';
if (array_key_exists('sts',$_GET))
{
	switch ($_GET['sts'])
	{
		case 'liberi';
		$where='';
		break;
		case 'liberigestione';
		$where='Gestione';
		break;
		case 'affittati';
		$where='Affitto';
		break;
		case 'affittatigestione';
		$where='Affitto su Gestione';
		break;
		case 'venduti';
		$where='Vendita';
		break;
		case 'prenotati';
		$where='Prenotazione';
		break;
		case 'prenotatigestione';
		$where='Prenotazione su Gestione';
		break;
		default;
		$where='';
		break;
	}
}
$select="SELECT posto_barca,cliente,inizio,fine FROM ".$tabelle['posti_barca_status']." WHERE posto_barca!='' AND status='".$where."' ORDER BY posto_barca+0";
$result=$sql->select_query($select);
$xls="Posto Barca\tNominativo\tInizio\tFine\n";
while ($row=mysql_fetch_assoc($result))
{
	$row['cliente']=$elenco_clienti[$row['cliente']];
	$xls.=html_entity_decode(implode("\t",$row));
	$xls.="\n";
}
// ACCROCCHIO OPZIONATI
if (array_key_exists('sts', $_GET) and $_GET['sts']=='opzionati') {
	$xls="Posto Barca\tNominativo\tInizio\tFine\n";
	$select="SELECT posto_barca_numero,pontile_codice,cliente_nominativo,contratto_inizio,contratto_fine FROM blue_posti_barca,blue_pontili,blue_clienti,blue_contratti WHERE posto_barca_id=contratto_posto_barca AND pontile_id=posto_barca_pontile AND cliente_id=contratto_anagrafica2 AND contratto_tipo=13 ORDER BY contratto_posto_barca ASC";
	$result=$sql->select_query($select);
	while ($row=mysql_fetch_assoc($result))
	{
		$xls.=$row['pontile_codice'].$row['posto_barca_numero']."\t".$row['cliente_nominativo']."\t".$row['contratto_inizio']."\t".$row['contratto_fine'];
		$xls.="\n";		
	}
}
// FINE ACCROCCHIO
header('Content-Type: application/xls');
header("Content-Disposition: attachment; filename=Report_Posti_Barca.xls");
echo $xls;
exit;
