<?php
require_once("config.inc.php");
$anni=$blue->presenze_anni();
$anno=2005;
if (array_key_exists('anno',$_POST))
{
	$anno=$_POST['anno'];
}
//$selnaz="SELECT cliente_nazione,nazione_nome,COUNT(*) AS totale FROM blue_clienti,blue_nazioni,blue_contratti WHERE nazione_id=cliente_nazione AND (cliente_id=contratto_anagrafica1 OR cliente_id=contratto_anagrafica2) AND LEFT(contratto_data,4)='".$anno."' GROUP BY cliente_nazione";
$seldim="SELECT dimensione_id,dimensione_lunghezza,dimensione_larghezza,COUNT(*) AS totale FROM blue_dimensioni,blue_posti_barca,blue_presenze WHERE posto_barca_dimensioni=dimensione_id AND posto_barca_id=presenza_posto_barca AND (LEFT(presenza_arrivo,4)='".$anno."' OR LEFT(presenza_partenza,4)='".$anno."') GROUP BY posto_barca_dimensioni ORDER BY dimensione_lunghezza ASC, dimensione_larghezza ASC";
$seltipo="SELECT tipologia_barca_id,tipologia_barca_nome,COUNT(*) AS totale FROM blue_tipologie_barche,blue_barche,blue_presenze WHERE barca_tipologia_barca=tipologia_barca_id AND barca_id=presenza_posto_barca AND (LEFT(presenza_arrivo,4)='".$anno."' OR LEFT(presenza_partenza,4)='".$anno."') GROUP BY tipologia_barca_id ORDER BY tipologia_barca_nome ASC";
$restipo=$sql->select_query($seltipo);
$stat1=array();
$x=0;
while ($row=mysql_fetch_array($restipo))
{
	$stat1[$row['tipologia_barca_id']]=array('tipologia'=>$row['tipologia_barca_nome'],1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0,12=>0,'tot'=>0);
	$selcon="SELECT presenza_arrivo,presenza_partenza FROM blue_presenze,blue_barche WHERE presenza_barca=barca_id AND barca_tipologia_barca='".$row['tipologia_barca_id']."' AND (LEFT(presenza_arrivo,4)='".$anno."' OR LEFT(presenza_partenza,4)='".$anno."')"; // AND (presenza_partenza>'0000-00-00' AND presenza_arrivo>'0000-00-00')";
	$rescon=$sql->select_query($selcon);
	while ($rowcon=mysql_fetch_array($rescon))
	{
		for ($i=1;$i<=12;$i++)
		{
			if (strlen($i)==1)
			{
				$j="0".$i;
			}
			else
			{
				$j=$i;
			}
			$gg=date('t',time(12,0,0,$i)); // giorni del mese
			$im=$anno."-".$j."-01"; // Data di inizio mese
			$fm=$anno."-".$j."-".$gg; // Data di fine mese
			$ic=$rowcon['presenza_arrivo']; // Data di inizio contratto
			if ($ic=='0000-00-00')
			{
				$ic=date("Y-m-d",time());
			}
			$fc=$rowcon['presenza_partenza']; // Data di fine contratto
			if ($fc=='0000-00-00')
			{
				$fc=date("Y-m-d",time());
			}
			//Se inizia e finisce all'interno del mese attuale			
			if ($ic>=$im AND $fc<=$fm)
			{
				$addgg=intval((strtotime($fc)-strtotime($ic))/86400);
				$stat1[$row['tipologia_barca_id']][$i]+=$addgg;
				$stat1[$row['tipologia_barca_id']]['tot']+=$addgg;
			}
			//Se inizia nel mese attuale ma finisce oltre
			elseif ($ic>=$im AND $ic<=$fm AND $fc>=$fm)
			{
				$addgg=intval((strtotime($fm)-strtotime($ic))/86400);
				$stat1[$row['tipologia_barca_id']][$i]+=$addgg;
				$stat1[$row['tipologia_barca_id']]['tot']+=$addgg;
			}
			//Se inizia prima del mese attuale ma finisce in questo mese
			elseif ($ic<=$im AND $fc<=$fm AND $fc>=$im)
			{
				$addgg=intval((strtotime($fc)-strtotime($im))/86400);
				$stat1[$row['tipologia_barca_id']][$i]+=$addgg;
				$stat1[$row['tipologia_barca_id']]['tot']+=$addgg;
			}
			//Se il contratto inizia e finisce oltre il mese attuale
			elseif($ic<=$im AND $fc>=$fm)
			{
				$stat1[$row['tipologia_barca_id']][$i]+=$gg;
				$stat1[$row['tipologia_barca_id']]['tot']+=$gg;
			}
		}
	}
}

require_once "views/stats/stats3.php";
