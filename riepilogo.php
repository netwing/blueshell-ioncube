<?php
require_once("config.inc.php");
$blue->autentica_utente("contratti","R");
$elenco_nazioni=$blue->elenco_nazioni();
$elenco_tipi=$blue->elenco_tipi();
$elenco_costruttori=$blue->elenco_costruttori();
if (array_key_exists("id",$_GET) === false) {
	header("Location:contratti.php");
    exit;
}
$select_contratto="SELECT * FROM ".$tabelle['contratti']." WHERE contratto_id='" . intval($_GET['id']) . "'";
$result_contratto=$sql->select_query($select_contratto);
$row_contratto=mysql_fetch_array($result_contratto);
$_SESSION['riepilogo']['contratto']=$row_contratto;

// Raccogliamo i dettagli del contratto
$select_dettagli="SELECT * FROM blue_contratti_dettagli WHERE contratto_dettaglio_contratto_id='" . intval($_GET['id']) . "'";
$result_dettagli=$sql->select_query($select_dettagli);
$row_dettagli=mysql_fetch_array($result_dettagli);
$_SESSION['riepilogo']['contratto_dettagli']=$row_dettagli;

// Controlliamo se da questa prenotazione e' gia' stato generato un contratto 
$affitto_da_prenotazione=0;
if ($row_contratto['contratto_tipo'] == 4) {
	$select_adp="SELECT contratto_id FROM ".$tabelle['contratti']." WHERE contratto_tipo='1' AND contratto_anagrafica1='".$row_contratto['contratto_anagrafica1']."' AND contratto_anagrafica2='".$row_contratto['contratto_anagrafica2']."' AND contratto_inizio='".$row_contratto['contratto_inizio']."' AND contratto_fine='".$row_contratto['contratto_fine']."' AND contratto_posto_barca='".$row_contratto['contratto_posto_barca']."'";	
	$result_adp=$sql->select_query($select_adp);
	if ($sql->select_num_rows>0) {
		$affitto_da_prenotazione=mysql_result($result_adp,0,'contratto_id');
	}
}

if ($row_contratto['contratto_tipo']==3) {
	$select_cliente="SELECT * FROM ".$tabelle['clienti']." WHERE cliente_id='".$row_contratto['contratto_anagrafica1']."'";
}
else {
	$select_cliente="SELECT * FROM ".$tabelle['clienti']." WHERE cliente_id='".$row_contratto['contratto_anagrafica2']."'";
}
$result_cliente=$sql->select_query($select_cliente);
$row_cliente=mysql_fetch_array($result_cliente);
$_SESSION['riepilogo']['cliente']=$row_cliente;

$select_barca="SELECT * FROM ".$tabelle['barche']." WHERE barca_id='".$row_contratto['contratto_barca']."'";
$result_barca=$sql->select_query($select_barca);
$row_barca=mysql_fetch_array($result_barca);
$_SESSION['riepilogo']['barca']=$row_barca;

$select_pontile="SELECT pontile_nome,pontile_codice,posto_barca_numero,dimensione_lunghezza,dimensione_larghezza FROM ".$tabelle['pontili'].",".$tabelle['posti_barca'].",".$tabelle['dimensioni']." WHERE pontile_id=posto_barca_pontile AND dimensione_id=posto_barca_dimensioni AND posto_barca_id='".$row_contratto['contratto_posto_barca']."'";
$result_pontile=$sql->select_query($select_pontile);
$row_pontile=mysql_fetch_array($result_pontile);
$_SESSION['riepilogo']['pontile']=$row_pontile;

// BEGIN YII APP INTEGRATION
$bridge_results = Yii::app()->bridge->orderFromContract($row_contratto['contratto_id']);
// END YII APP INTEGRATION

require_once 'views/contract/view.php';
