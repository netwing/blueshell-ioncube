<?php
require_once("config.inc.php");
$blue->autentica_utente("contratti","R");

$anno = date('Y',time());

if (array_key_exists('date_year',$_POST)) {
	$anno=$_POST['date_year'];
}
$spese=array();
$totali=array();
$totale_affitti=array();

$periodi=$blue->elenco_periodi();
unset($periodi[0]);
/*$spese['condominiali'][99]=0;
$spese['vendite'][99]=0;
$spese['transiti'][99]=0;
$spese['varie'][99]=0;
$spese['indefinite'][99]=0;
$totale_affitti[99]=0;
$totali[99]=0;
foreach ($periodi as $k=>$v)
{
	$nomeaffitto="affitti ".$v;
	for ($i=1;$i<=12;$i++)
	{
		if (strlen($i)==1)
		{
			$q='0'.$i;
		}
		else
		{
			$q=$i;
		}
		$spese[$nomeaffitto][$q]=0;
		$spese[$nomeaffitto][99]=0;
		$totale_affitti[$q]=0;
		$totale_affitti[99]=0;
	}
}

$spese['affitti'][99]=0;
*/	
// SPESE CONDOMINIALI
$sel="SELECT fattura_numero+0,fattura_data,cliente_nominativo,fattura_riga_descrizione,fattura_riga_imponibile,fattura_riga_totale FROM blue_fatture,blue_fatture_righe,blue_clienti WHERE cliente_id=fattura_cliente_id AND fattura_spese_condominiali='1' AND fattura_varie='0' AND fattura_id=fattura_riga_fattura_id AND fattura_data LIKE '".$anno."%' ORDER BY fattura_numero ASC";
$res=$sql->select_query($sel);
$spese=array();
while ($row=mysql_fetch_array($res))
{
	$spese[]=$row;
}

// VARIE
$sel="SELECT fattura_numero+0,fattura_data,cliente_nominativo,fattura_riga_descrizione,fattura_riga_imponibile,fattura_riga_totale FROM blue_fatture,blue_fatture_righe,blue_clienti WHERE cliente_id=fattura_cliente_id AND fattura_spese_condominiali='0' AND fattura_varie='1' AND fattura_id=fattura_riga_fattura_id AND fattura_data LIKE '".$anno."%' ORDER BY fattura_numero ASC";
$res=$sql->select_query($sel);
$varie=array();
while ($row=mysql_fetch_array($res))
{
	$varie[]=$row;
}

// VENDITE
$sel="SELECT fattura_numero+0,fattura_data,cliente_nominativo,fattura_riga_descrizione,fattura_riga_imponibile,fattura_riga_totale FROM blue_fatture,blue_fatture_righe,blue_clienti,blue_contratti WHERE contratto_tipo='2' AND contratto_id=fattura_contratto_id AND cliente_id=fattura_cliente_id AND fattura_spese_condominiali='0' AND fattura_varie='0' AND fattura_id=fattura_riga_fattura_id AND fattura_data LIKE '".$anno."%' ORDER BY fattura_numero ASC";
$res=$sql->select_query($sel);
$vendite=array();
while ($row=mysql_fetch_array($res))
{
	$vendite[]=$row;
}

// INDEFINITE
$sel="SELECT fattura_numero+0,fattura_data,cliente_nominativo,fattura_riga_descrizione,fattura_riga_imponibile,fattura_riga_totale FROM blue_fatture,blue_fatture_righe,blue_clienti WHERE fattura_contratto_id=0 AND cliente_id=fattura_cliente_id AND fattura_spese_condominiali='0' AND fattura_varie='0' AND fattura_id=fattura_riga_fattura_id AND fattura_data LIKE '".$anno."%' ORDER BY fattura_numero ASC";
$res=$sql->select_query($sel);
$indefinite=array();
while ($row=mysql_fetch_array($res))
{
	$indefinite[]=$row;
}

// TRANSITI
$sel="SELECT fattura_numero+0,fattura_data,cliente_nominativo,fattura_riga_descrizione,fattura_riga_imponibile,fattura_riga_totale FROM blue_fatture,blue_fatture_righe,blue_clienti,blue_contratti WHERE contratto_tipo='11' AND contratto_id=fattura_contratto_id AND cliente_id=fattura_cliente_id AND fattura_spese_condominiali='0' AND fattura_varie='0' AND fattura_id=fattura_riga_fattura_id AND fattura_data LIKE '".$anno."%' ORDER BY fattura_numero ASC";
$res=$sql->select_query($sel);
$transiti=array();
while ($row=mysql_fetch_array($res))
{
	$transiti[]=$row;
}

// PRENOTAZIONI
$sel="SELECT fattura_numero+0,fattura_data,cliente_nominativo,fattura_riga_descrizione,fattura_riga_imponibile,fattura_riga_totale FROM blue_fatture,blue_fatture_righe,blue_clienti,blue_contratti WHERE contratto_tipo='4' AND contratto_id=fattura_contratto_id AND cliente_id=fattura_cliente_id AND fattura_spese_condominiali='0' AND fattura_varie='0' AND fattura_id=fattura_riga_fattura_id AND fattura_data LIKE '".$anno."%' ORDER BY fattura_numero ASC";
$res=$sql->select_query($sel);
$prenotazioni=array();
while ($row=mysql_fetch_array($res))
{
	$prenotazioni[]=$row;
}

// AFFITTI
// Fatture degli Affitti suddivisi per periodo
foreach ($periodi as $k=>$v)
{
	$nomeaffitto="affitti ".$v;
	$sel="SELECT fattura_numero+0,fattura_data,cliente_nominativo,fattura_riga_descrizione,fattura_riga_imponibile,fattura_riga_totale FROM blue_fatture,blue_fatture_righe,blue_clienti,blue_contratti WHERE contratto_tipo='1' AND contratto_periodo='".$k."' AND contratto_id=fattura_contratto_id AND cliente_id=fattura_cliente_id AND fattura_spese_condominiali='0' AND fattura_varie='0' AND fattura_id=fattura_riga_fattura_id AND fattura_data LIKE '".$anno."%' ORDER BY fattura_numero ASC";
	$res=$sql->select_query($sel);
	$affitti[$nomeaffitto]=array();
	while ($row=mysql_fetch_array($res))
	{
		$affitti[$nomeaffitto][]=$row;
	}
}


//$spese['varie'][99]=$totali[99]-($spese['condominiali'][99]+$spese['vendite'][99]+$spese['transiti'][99]+$spese['affitti'][99]+$totale_affitti[99]);

$intestazione="Fattura\tData\tCliente\tDescrizione\tImponibile\tTotale\n";
$excel="";
//echo "<pre>";print_r($affitti);exit();
foreach ($affitti as $affitto=>$dati)
{	
	$excel.="\n\n".strtoupper($affitto)."\n".$intestazione;
	foreach ($dati as $k=>$v)
	{
		$excel.=$v[0]."\t".date("d-m-Y",strtotime($v[1]))."\t".html_entity_decode($v[2])."\t".$v[3]."\t".number_format($v[4],2,",","")."\t".number_format($v[5],2,",","")."\n";
	}
}
$excel.="\n\nTRANSITI\n".$intestazione;
foreach ($transiti as $k=>$v)
{
	$excel.=$v[0]."\t".date("d-m-Y",strtotime($v[1]))."\t".html_entity_decode($v[2])."\t".$v[3]."\t".number_format($v[4],2,",","")."\t".number_format($v[5],2,",","")."\n";
}
$excel.="\n\nPRENOTAZIONI (acconti)\n".$intestazione;
foreach ($prenotazioni as $k=>$v)
{
	$excel.=$v[0]."\t".date("d-m-Y",strtotime($v[1]))."\t".html_entity_decode($v[2])."\t".$v[3]."\t".number_format($v[4],2,",","")."\t".number_format($v[5],2,",","")."\n";
}
$excel.="\n\nVENDITE\n".$intestazione;
foreach ($vendite as $k=>$v)
{
	$excel.=$v[0]."\t".date("d-m-Y",strtotime($v[1]))."\t".html_entity_decode($v[2])."\t".$v[3]."\t".number_format($v[4],2,",","")."\t".number_format($v[5],2,",","")."\n";
}
$excel.="\n\nSPESE CONDOMINIALI\n".$intestazione;
foreach ($spese as $k=>$v)
{
	$excel.=$v[0]."\t".date("d-m-Y",strtotime($v[1]))."\t".html_entity_decode($v[2])."\t".$v[3]."\t".number_format($v[4],2,",","")."\t".number_format($v[5],2,",","")."\n";
}
$excel.="\n\nVARIE\n".$intestazione;
foreach ($varie as $k=>$v)
{
	$excel.=$v[0]."\t".date("d-m-Y",strtotime($v[1]))."\t".html_entity_decode($v[2])."\t".$v[3]."\t".number_format($v[4],2,",","")."\t".number_format($v[5],2,",","")."\n";
}
$excel.="\n\nINDEFINITE\n".$intestazione;
foreach ($indefinite as $k=>$v)
{
	$excel.=$v[0]."\t".date("d-m-Y",strtotime($v[1]))."\t".html_entity_decode($v[2])."\t".$v[3]."\t".number_format($v[4],2,",","")."\t".number_format($v[5],2,",","")."\n";
}


header('Content-Type: application/xls');
header("Content-Disposition: attachment; filename=Report_Dettagliato_".$anno.".xls");
echo $excel;
exit;
