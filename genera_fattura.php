<?php
require_once("config.inc.php");

$rtf=new RTF();

$campi=array("<NOMINATIVO>"=>"Emanuele Deserti",
			 "<INDIRIZZO>"=>"Via William Bertazzini, 10",
			 "<CAP>"=>"44030",
			 "<CITTA>"=>"Pontegradella",
			 "<PROVINCIA>"=>"Ferrara",
			 "<NUMERO_DOCUMENTO>"=>"935 F",
			 "<DATA>"=>date("d-m-Y",time()),
			 "<TIPO_DOCUMENTO>"=>"Fattura",
			 "<CONDIZIONI_PAGAMENTO>"=>"Rimessa Diretta",
			 "<CODICE_FISCALE>"=>"DSRMNL79R03D548A",
			 "<PARTITA_IVA>"=>"012345678901",
			 "<ALIQUOTA>"=>"21 %",
			 "<IMPONIBILE>"=>"2000,00",
			 "<IMPOSTA>"=>"400,00",
			 "<TOTALE>"=>"2400,00",
			 "<SPESE_TRASPORTO>"=>"100,00",
			 "<SPESE_INCASSO>"=>"100,00",
			 "<BOLLI>"=>"50,00",
			 "<TOTALE_EURO>"=>"2650,00"
			);
$righe_fattura=array(0=>array("DESCRIZIONE","U","Q","LISTINO","SCONTO","TOTALE","IVA"),
					 1=>array("DESCRIZIONE"=>"Ormeggio annuale dal 07/12/2004 al 06/12/2004 su pontile A/2","U"=>"anno","Q"=>"1","LISTINO"=>"2572,50","SCONTO"=>"","TOTALE"=>"3400,00","IVA"=>"512,50"),
					 2=>array("DESCRIZIONE"=>"BVeta","U"=>"anno","Q"=>"1","LISTINO"=>"2572,50","SCONTO"=>"","TOTALE"=>"3400,00","IVA"=>"512,50"),
					 3=>array("DESCRIZIONE"=>"gamma","U"=>"anno","Q"=>"1","LISTINO"=>"2572,50","SCONTO"=>"","TOTALE"=>"3400,00","IVA"=>"512,50"),
					 4=>array("DESCRIZIONE"=>"delta","U"=>"anno","Q"=>"1","LISTINO"=>"2572,50","SCONTO"=>"","TOTALE"=>"3400,00","IVA"=>"512,50"),
					 5=>array("DESCRIZIONE"=>"omega","U"=>"anno","Q"=>"1","LISTINO"=>"2572,50","SCONTO"=>"","TOTALE"=>"3400,00","IVA"=>"512,50")
					 );

for ($i=1;$i<=9;$i++)
{

	if (array_key_exists($i,$righe_fattura) and count($righe_fattura[$i])>0)
	{
		foreach ($righe_fattura[$i] as $k=>$v)
		{
			$key="<".$k.$i.">";
			$campi[$key]=$v;
		}
	}
	else
	{
		foreach ($righe_fattura[0] as $k)
		{
			$key="<".$k.$i.">";
			$campi[$key]="";
		}
	}
}

//print_r($campi);

$chiavi=array_keys($campi);
$valori=array_values($campi);
$rtf=new RTF();
$rtf->carica_template("template/fattura.rtf");
$rtf->rtf_singolo($chiavi,$valori);
// echo $rtf->contenuto_finale;
$rtf->output("Fattura.doc");
?>
