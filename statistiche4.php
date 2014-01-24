<?php
require_once("config.inc.php");
$anni=$blue->presenze_anni();
$anno=2005;
if (array_key_exists('anno',$_POST))
{
	$anno=$_POST['anno'];
}
$selpro="SELECT cliente_provincia,provincia_nome FROM blue_clienti,blue_province,blue_presenze WHERE provincia_sigla=cliente_provincia AND cliente_id=presenza_cliente AND (LEFT(presenza_arrivo,4)='".$anno."' OR LEFT(presenza_partenza,4)='".$anno."') GROUP BY cliente_provincia";
$respro=$sql->select_query($selpro);
$stat1=array();
$x=0;
while ($row=mysql_fetch_array($respro))
{
	$stat1[$row['cliente_provincia']]=array('provincia'=>$row['provincia_nome'],1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0,12=>0,'tot'=>0);
	$selcon="SELECT presenza_arrivo,presenza_partenza FROM blue_presenze,blue_clienti WHERE presenza_cliente=cliente_id AND cliente_provincia='".$row['cliente_provincia']."' AND (LEFT(presenza_arrivo,4)='".$anno."' OR LEFT(presenza_partenza,4)='".$anno."')"; // AND (presenza_partenza>'0000-00-00' AND presenza_arrivo>'0000-00-00')";
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
				$stat1[$row['cliente_provincia']][$i]+=$addgg;
				$stat1[$row['cliente_provincia']]['tot']+=$addgg;
			}
			//Se inizia nel mese attuale ma finisce oltre
			elseif ($ic>=$im AND $ic<=$fm AND $fc>=$fm)
			{
				$addgg=intval((strtotime($fm)-strtotime($ic))/86400);
				$stat1[$row['cliente_provincia']][$i]+=$addgg;
				$stat1[$row['cliente_provincia']]['tot']+=$addgg;
			}
			//Se inizia prima del mese attuale ma finisce in questo mese
			elseif ($ic<=$im AND $fc<=$fm AND $fc>=$im)
			{
				$addgg=intval((strtotime($fc)-strtotime($im))/86400);
				$stat1[$row['cliente_provincia']][$i]+=$addgg;
				$stat1[$row['cliente_provincia']]['tot']+=$addgg;
			}
			//Se il contratto inizia e finisce oltre il mese attuale
			elseif($ic<=$im AND $fc>=$fm)
			{
				$stat1[$row['cliente_provincia']][$i]+=$gg;
				$stat1[$row['cliente_provincia']]['tot']+=$gg;
			}
		}
	}
}


require_once "views/stats/stats4.php";
