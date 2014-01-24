<?php
require_once("config.inc.php");
$blue->autentica_utente("contratti","W");
if (array_key_exists("contratto_id",$_POST) and array_key_exists("Conferma",$_POST)) {
	$delete="DELETE FROM ".$tabelle['contratti']." WHERE contratto_id='".$_POST['contratto_id']."'";
	$sql->delete_query($delete);
	header("Location:contratti.php");
	exit;
}
$elenco_nazioni=$blue->elenco_nazioni();
$elenco_tipi=$blue->elenco_tipi();
$elenco_costruttori=$blue->elenco_costruttori();
if (!array_key_exists("id", $_GET)) {
	header("Location:index.php");
    exit;
}
$select_contratto="SELECT contratto_id,contratto_anagrafica1,contratto_anagrafica2,contratto_barca,contratto_posto_barca,contratto_tipo,contratto_data,contratto_inizio,contratto_fine,contratto_imponibile,contratto_totale FROM ".$tabelle['contratti']." WHERE contratto_id='".$_GET['id']."'";
$result_contratto=$sql->select_query($select_contratto);
$row_contratto=mysql_fetch_array($result_contratto);

if ($row_contratto !== false) {
    $_SESSION['riepilogo']['contratto']=$row_contratto;

    if ($row_contratto['contratto_tipo']==3) {
        $select_cliente="SELECT * FROM ".$tabelle['clienti']." WHERE cliente_id='".$row_contratto['contratto_anagrafica1']."'";
    }
    else
    {
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

}

require_once "views/contract/delete.php";
