<?php
require_once("config.inc.php");
$blue->autentica_utente("contratti","R");

$anno = date('Y',time());

if (array_key_exists('date_year', $_POST)) {
	$anno = $_POST['date_year'];
}
$spese=array();
$totali=array();
$totale_affitti=array();

$periodi=$blue->elenco_periodi();
unset($periodi[0]);
$spese['condominiali'][99]=0;
$spese['vendite'][99]=0;
$spese['transiti'][99]=0;
$spese['prenotazioni'][99]=0;
$spese['varie'][99]=0;
$spese['indefinite'][99]=0;
$totale_affitti[99]=0;
$totali[99]=0;
foreach ($periodi as $k=>$v) {
	$nomeaffitto="affitti ".$v;
	for ($i=1;$i<=12;$i++) {
		if (strlen($i)==1) {
			$q='0'.$i;
		} else {
			$q=$i;
		}
		$spese[$nomeaffitto][$q]=0;
		$spese[$nomeaffitto][99]=0;
		$totale_affitti[$q]=0;
		$totale_affitti[99]=0;
	}
}

$spese['affitti'][99]=0;
		
for ($i=1; $i<=12; $i++) {
	// Settiamo il numero del mese con lo zero davanti
	if (strlen($i)==1) {
		$q='0'.$i;
	} else {
		$q=$i;
	}
	
	// Fattura di Spese Condominiali
	$sel_spese="SELECT SUM(fattura_riga_imponibile) AS totale FROM blue_fatture,blue_fatture_righe WHERE fattura_riga_descrizione LIKE '%condominiali%' AND fattura_id=fattura_riga_fattura_id AND fattura_data LIKE '".$anno."-".$q."%'";
	if (true) {
		$sel_spese="SELECT SUM(fattura_riga_imponibile) AS totale FROM blue_fatture,blue_fatture_righe WHERE fattura_spese_condominiali='1' AND fattura_varie='0' AND fattura_id=fattura_riga_fattura_id AND fattura_data LIKE '".$anno."-".$q."%'";
	}

	$res=$sql->select_query($sel_spese);
	while ($row=mysql_fetch_array($res)) {
		$spese['condominiali'][$q]=$row['totale'];
		$spese['condominiali'][99]+=$row['totale'];
	}
	ksort($spese['condominiali']);
	
	// Fatture di Vendita
	$sel_vendite="SELECT SUM(fattura_riga_imponibile) AS totale FROM blue_fatture,blue_fatture_righe WHERE (fattura_riga_descrizione LIKE '%vendita%' OR fattura_riga_descrizione LIKE '%acquisto posto barca%' OR fattura_riga_descrizione LIKE '%acquisto pb%' OR fattura_riga_descrizione LIKE '%acquisto p.b.%') AND fattura_id=fattura_riga_fattura_id AND fattura_data LIKE '".$anno."-".$q."%'";
	if (true) {
		$sel_vendite="SELECT SUM(fattura_riga_imponibile) AS totale FROM blue_fatture,blue_fatture_righe,blue_contratti WHERE (contratto_tipo='2' OR contratto_tipo='13') AND contratto_id=fattura_contratto_id AND fattura_id=fattura_riga_fattura_id AND fattura_spese_condominiali='0' AND fattura_varie='0' AND fattura_data LIKE '".$anno."-".$q."%'";
	}
	$res=$sql->select_query($sel_vendite);
	while ($row=mysql_fetch_array($res))
	{
		$spese['vendite'][$q]=$row['totale'];
		$spese['vendite'][99]+=$row['totale'];
	}
	ksort($spese['vendite']);

	// Fatture Non Definite
	$sel_indefinite="SELECT SUM(fattura_riga_imponibile) AS totale FROM blue_fatture,blue_fatture_righe WHERE (1=2) AND fattura_id=fattura_riga_fattura_id AND fattura_data LIKE '".$anno."-".$q."%'";
	if (true) {
		$sel_indefinite="SELECT SUM(fattura_riga_imponibile) AS totale FROM blue_fatture,blue_fatture_righe WHERE fattura_contratto_id=0 AND fattura_spese_condominiali='0' AND fattura_varie='0' AND fattura_id=fattura_riga_fattura_id AND fattura_data LIKE '".$anno."-".$q."%'";
	}
	$res=$sql->select_query($sel_indefinite);
	while ($row=mysql_fetch_array($res))
	{
		$spese['indefinite'][$q]=$row['totale'];
		$spese['indefinite'][99]+=$row['totale'];
	}
	ksort($spese['indefinite']);
	
	// Fatture dei Transiti
	$sel_transito="SELECT SUM(fattura_riga_imponibile) AS totale FROM blue_fatture,blue_fatture_righe WHERE fattura_riga_descrizione LIKE '%transito%' AND fattura_id=fattura_riga_fattura_id AND fattura_data LIKE '".$anno."-".$q."%'";
	if (true) {
		$sel_transito="SELECT SUM(fattura_riga_imponibile) AS totale FROM blue_fatture,blue_fatture_righe,blue_contratti WHERE contratto_tipo='11' AND contratto_id=fattura_contratto_id AND fattura_spese_condominiali='0' AND fattura_varie='0' AND fattura_id=fattura_riga_fattura_id AND fattura_data LIKE '".$anno."-".$q."%'";	}
	$res=$sql->select_query($sel_transito);
	while ($row=mysql_fetch_array($res)) {
		$spese['transiti'][$q]=$row['totale'];
		$spese['transiti'][99]+=$row['totale'];
	}
	ksort($spese['transiti']);	
	
	// Fatture delle Prenotazioni
	$sel_transito="SELECT SUM(fattura_riga_imponibile) AS totale FROM blue_fatture,blue_fatture_righe WHERE 1=2 AND fattura_riga_descrizione LIKE '%acconto%' AND fattura_id=fattura_riga_fattura_id AND fattura_data LIKE '".$anno."-".$q."%'";
	if (true) {
		$sel_transito="SELECT SUM(fattura_riga_imponibile) AS totale FROM blue_fatture,blue_fatture_righe,blue_contratti WHERE contratto_tipo='4' AND contratto_id=fattura_contratto_id AND fattura_spese_condominiali='0' AND fattura_varie='0' AND fattura_id=fattura_riga_fattura_id AND fattura_data LIKE '".$anno."-".$q."%'";	}
	$res=$sql->select_query($sel_transito);
	while ($row=mysql_fetch_array($res))
	{
		$spese['prenotazioni'][$q]=$row['totale'];
		$spese['prenotazioni'][99]+=$row['totale'];
	}
	ksort($spese['prenotazioni']);
	
	// Fatture degli Affitti suddivisi per periodo
	foreach ($periodi as $k=>$v)
	{
		$nomeaffitto="affitti ".$v;
		$sel_affitti="SELECT SUM(fattura_riga_imponibile) AS totale FROM blue_fatture,blue_fatture_righe,blue_contratti WHERE contratto_tipo='1' AND contratto_id=fattura_contratto_id AND contratto_periodo='".$k."' AND fattura_id=fattura_riga_fattura_id AND fattura_data LIKE '".$anno."-".$q."%'";
		$res=$sql->select_query($sel_affitti);
		//$spese[$nomeaffitto][99]=0;
		while ($row=mysql_fetch_array($res))
		{
			$spese[$nomeaffitto][$q]=$row['totale'];
			$spese[$nomeaffitto][99]+=$row['totale'];
			$totale_affitti[$q]+=$row['totale'];
			$totale_affitti[99]+=$row['totale'];
		}
		ksort($spese[$nomeaffitto]);
	}
	
	$sel_affitti="SELECT SUM(fattura_riga_imponibile) AS totale FROM blue_fatture,blue_fatture_righe WHERE (fattura_riga_descrizione LIKE '%ormeggio%' OR fattura_riga_descrizione LIKE '%affitto%') AND fattura_contratto_id='0' AND fattura_id=fattura_riga_fattura_id AND fattura_data LIKE '".$anno."-".$q."%'";
	$res=$sql->select_query($sel_affitti);
	while ($row=mysql_fetch_array($res))
	{
		$spese['affitti'][$q]=$row['totale'];
		$spese['affitti'][99]+=$row['totale'];
	}
	ksort($spese['affitti']);
	
	
	$sel_totali_x_mese="SELECT SUM(fattura_riga_imponibile) AS totale FROM blue_fatture_righe,blue_fatture WHERE fattura_riga_fattura_id=fattura_id AND fattura_data like '".$anno."-".$q."-%'";
	$res=$sql->select_query($sel_totali_x_mese);
	while ($row=mysql_fetch_array($res))
	{
		$totali[$q]=$row['totale'];
		$totali[99]+=$row['totale'];
	}
	ksort($totali);
	
	$spese['varie'][$q]=$totali[$q]-($spese['condominiali'][$q]+$spese['vendite'][$q]+$spese['transiti'][$q]+$spese['affitti'][$q]+$totale_affitti[$q]);
	// Fattura di Varie
	if (true) {
		$sel_spese="SELECT SUM(fattura_riga_imponibile) AS totale FROM blue_fatture,blue_fatture_righe WHERE fattura_varie='1' AND fattura_spese_condominiali='0' AND fattura_id=fattura_riga_fattura_id AND fattura_data LIKE '".$anno."-".$q."%'";
		$res=$sql->select_query($sel_spese);
		while ($row=mysql_fetch_array($res))
		{
			$spese['varie'][$q]=$row['totale'];
			$spese['varie'][99]+=$row['totale'];
		}
		ksort($spese['varie']);
	}	
}

//$spese['varie'][99]=$totali[99]-($spese['condominiali'][99]+$spese['vendite'][99]+$spese['transiti'][99]+$spese['affitti'][99]+$totale_affitti[99]);

$spese['totali']=$totali;
$spese2=$spese;
unset($spese2['affitti']);
$excel="Voce\tGennaio\tFebbraio\tMarzo\tAprile\tMaggio\tGiugno\tLuglio\tAgosto\tSettembre\tOttobre\tNovembre\tDicembre\tTotale\n";

foreach ($spese2 as $k=>$v)
{
	$excel.=$k."\t";
	foreach ($v as $v2)
	{
		$excel.=number_format($v2,2,',','')."\t";
	}
	$excel.="\n";
}
/*echo "<pre>";
print_r($spese);
echo "</pre>";
exit;
*/
header('Content-Type: application/xls');
header("Content-Disposition: attachment; filename=Report_Annuale_".$anno.".xls");
echo $excel;
exit;
