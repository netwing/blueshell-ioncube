<?php
require_once("config.inc.php");
$blue->autentica_utente("principale", "N");
$elenco_posti_barca=$blue->elenco_posti_barca();
if (array_key_exists("ricerca",$_POST) and $_POST['ricerca']!="")
{
	$ricerca=$sql->pulisci($_POST['ricerca']);
	switch($_POST['operatore'])
	{
		case "contiene";
		$where=" LIKE '%".$ricerca."%'";
		break;
		case "e";
		$where="='".$ricerca."'";
		break;
		case "non e";
		$where="!='".$ricerca."'";
		break;
		case "comincia con";
		$where=" LIKE '".$ricerca."%'";
		break;
		case "finisce con";
		$where=" LIKE '%".$ricerca."'";
		break;
		default;
		$where="='".$ricerca."'";
		break;
	}
	
	$select_clienti="SELECT cliente_id,cliente_nominativo,cliente_telefono1,cliente_telefono2 FROM ".$tabelle['clienti']." WHERE cliente_nominativo".$where." OR cliente_nome".$where." OR cliente_cognome".$where." OR cliente_indirizzo".$where." ORDER BY cliente_nominativo ASC";    
	$result_clienti=$sql->select_query($select_clienti);
	// Andiamo a raccogliere tutti i dati dalla tabella clienti
	$select_barche="SELECT barca_id,barca_nome,barca_lunghezza,barca_targa,barca_matricola_motore1,barca_matricola_motore2,barca_proprietario,cliente_nominativo FROM ".$tabelle['barche'].",".$tabelle['clienti']." WHERE cliente_id=barca_proprietario AND (barca_nome".$where." OR cliente_nominativo".$where." OR barca_matricola_motore1".$where." OR barca_matricola_motore2".$where." OR barca_targa".$where." OR barca_modello".$where." OR barca_caratteristiche".$where." OR barca_colore".$where." OR barca_note".$where.") ORDER BY barca_nome ASC";
	$result_barche=$sql->select_query($select_barche);
	// Andiamo a raccogliere tutti i dati dalla tabella barche
	
	// $select_scadenze="SELECT id_scadenza,data_scadenza,descrizione_breve FROM scadenze WHERE status='Aperto' AND (data_scadenza".$where." OR descrizione_breve".$where." OR descrizione_lunga".$where.") ORDER BY data_scadenza ASC";
	// $result_scadenze=$sql->select_query($select_scadenze);
	// Andiamo a raccogliere tutti i dati dalla tabella scadenze
}
elseif (array_key_exists("vai_al_pb",$_POST) and $_POST['vai_al_pb']!="")
{
	$elenco_pontili=$blue->elenco_pontili();
	$flipped_pontili=array_flip($elenco_pontili);
	$vai_al_pb=strtoupper($_POST['vai_al_pb']);
	$pontile=substr($vai_al_pb,0,1);
	if (!is_numeric(substr($vai_al_pb,1,1)))
	{
		$pontile.=(substr($vai_al_pb,1,1));
	}
	// Se la seconda posizione NON e' un numero, estrapoliamo la seconda posizione come seconda lettera del nome del pontile
	$posto_barca_numero=str_replace($pontile,"",$vai_al_pb);
	if (array_key_exists($pontile,$flipped_pontili))
	{
		$pontile_id=$flipped_pontili[$pontile];
	}
	else
	{
		$pontile_id=0;
	}
	$select="SELECT posto_barca_id FROM ".$tabelle['posti_barca']." WHERE posto_barca_pontile='".$pontile_id."' AND posto_barca_numero='".$posto_barca_numero."'";
	$result=$sql->select_query($select);
	if ($sql->select_num_rows>0)
	{
		$posto_barca_id=mysql_result($result,0,'posto_barca_id');
		header("Location:posto_barca_dettagli.php?id=".$posto_barca_id);
		exit();
	}
	else
	{
		header("Location:posti_barca.php?pontile=".$pontile_id);
		exit();
	}
}
else
{
	$select_clienti="SELECT cliente_id FROM ".$tabelle['clienti']." WHERE 1=2";
	$result_clienti=$sql->select_query($select_clienti);
	// Andiamo a raccogliere tutti i dati dalla tabella clienti
	$select_barche="SELECT barca_id FROM ".$tabelle['barche']." WHERE 1=2";
	$result_barche=$sql->select_query($select_barche);
	// Andiamo a raccogliere tutti i dati dalla tabella barche
}

require_once "views/site/cerca.php";
