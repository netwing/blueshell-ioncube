<?php
require_once("config.inc.php");
$blue->autentica_utente("contratti","W");
$elenco_nazioni=$blue->elenco_nazioni();
$elenco_tipi=$blue->elenco_tipi();
$elenco_costruttori=$blue->elenco_costruttori();
if (!array_key_exists("id",$_GET)) {
	header("Location:index.php");
}
if (count($_POST) > 0) {
	$inizio = $_POST['contratto_inizio'];
	$fine = $_POST['contratto_fine'];
	$posto_barca = $_POST['posto_barca'];
	$imponibile = $sql->decimale_sql($_POST['imponibile']);
	$totale = $sql->decimale_sql($_POST['totale']);
	$fatturato = $sql->decimale_sql($_POST['fatturato']);
	$gestione_percentuale=0;
	if (array_key_exists("gestione_percentuale",$_POST)) {
		$gestione_percentuale=intval($_POST['gestione_percentuale']);
	}
	$update="UPDATE ".$tabelle['contratti']." SET contratto_imponibile='".$imponibile."',contratto_totale='".$totale."',contratto_fatturato='".$fatturato."',contratto_gestione_percentuale='".$gestione_percentuale."',contratto_inizio='".$inizio."',contratto_fine='".$fine."',contratto_posto_barca='".$posto_barca."' WHERE contratto_id='" . intval($_GET['id']) . "'";
	$esit = $sql->update_query($update);
    if ($esit) {
        Yii::app()->user->setFlash('success', Yii::t('app', 'Changes saved successfully.'));
        header("Location:riepilogo.php?id=" . intval($_GET['id']));
        exit;
    } else {
        Yii::app()->user->setFlash('danger', Yii::t('app', 'An error occured.'));
        header("Location:contratto_modifica.php?id=" . intval($_GET['id']));
        exit;
    }
}
// Se l'utente clicca su Modifica, viene modificato il contratto e sparato al riepilogo non editabile
$select_contratto="SELECT contratto_id,contratto_anagrafica1,contratto_anagrafica2,contratto_barca,contratto_posto_barca,contratto_tipo,contratto_data,contratto_inizio,contratto_fine,contratto_imponibile,contratto_totale,contratto_fatturato,contratto_gestione_percentuale FROM ".$tabelle['contratti']." WHERE contratto_id='".$_GET['id']."'";
$result_contratto=$sql->select_query($select_contratto);
$row_contratto=mysql_fetch_array($result_contratto);
$_SESSION['riepilogo']['contratto']=$row_contratto;
// Carichiamo i dati del contratto e li salviamo in SESSIONE
if ($row_contratto['contratto_tipo']==3) {
	$select_cliente="SELECT * FROM ".$tabelle['clienti']." WHERE cliente_id='".$row_contratto['contratto_anagrafica1']."'";
} else {
	$select_cliente="SELECT * FROM ".$tabelle['clienti']." WHERE cliente_id='".$row_contratto['contratto_anagrafica2']."'";
}
$result_cliente=$sql->select_query($select_cliente);
$row_cliente=mysql_fetch_array($result_cliente);
$_SESSION['riepilogo']['cliente']=$row_cliente;
// Carichiamo i dati del cliente e li salviamo in SESSIONE
$select_barca="SELECT * FROM ".$tabelle['barche']." WHERE barca_id='".$row_contratto['contratto_barca']."'";
$result_barca=$sql->select_query($select_barca);
$row_barca=mysql_fetch_array($result_barca);
$_SESSION['riepilogo']['barca']=$row_barca;
// Carichiamo i dati della barca e li salviamo in SESSIONE
$select_pontile="SELECT pontile_nome,pontile_codice,posto_barca_id,posto_barca_numero,dimensione_id,dimensione_lunghezza,dimensione_larghezza FROM ".$tabelle['pontili'].",".$tabelle['posti_barca'].",".$tabelle['dimensioni']." WHERE pontile_id=posto_barca_pontile AND dimensione_id=posto_barca_dimensioni AND posto_barca_id='".$row_contratto['contratto_posto_barca']."'";
$result_pontile=$sql->select_query($select_pontile);
$row_pontile=mysql_fetch_array($result_pontile);
$_SESSION['riepilogo']['pontile']=$row_pontile;
// Carichiamo i dati del posto barca e del pontile e li salviamo in SESSIONE
$elenco_dimensioni=$blue->elenco_dimensioni();
$javascript="";
$posti_barca_default=array();
/*
foreach ($elenco_dimensioni as $k=>$v) {
	$select="SELECT posto_barca_id,pontile_codice,posto_barca_numero FROM ".$tabelle['pontili'].",".$tabelle['posti_barca']." WHERE posto_barca_dimensioni='".$k."' AND pontile_id=posto_barca_pontile ORDER BY pontile_codice ASC, posto_barca_numero ASC";
	$result=$sql->select_query($select);
	$javascript.="var x".$k."Array = new Array(";
	$i=0;
	$rows=$sql->select_num_rows;
	while ($row=mysql_fetch_array($result))
	{
		$i++;
		$javascript.="\"('".$row['pontile_codice'].$row['posto_barca_numero']."','".$row['posto_barca_id']."'";
		if ($k==$row_pontile['dimensione_id'])
		{
			$posti_barca_default[$row['posto_barca_id']]=$row['pontile_codice'].$row['posto_barca_numero'];
		}
		if ($row['posto_barca_id']==$row_pontile['posto_barca_id'])
		{
			$javascript.=",true,true";
		}
		// Quando si cambiano dimensioni e si ritorna su quelle attuali, il posto barca ritorna quello attualmente impostato
		if ($i<$rows)
		{
			$javascript.=")\", \n";
		}
		else
		{
			$javascript.=")\"";
		}
		// Controllo per vericare quando si arriva alla fine dell'array per il javascript
	}
	$javascript.=") \n";
}
*/
// Questo codice genera i javascript
require_once "views/contract/update.php";
