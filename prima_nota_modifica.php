<?php
require_once("config.inc.php");
$blue->autentica_utente("fatture","W");

$form->campi_testo = array("prima_nota_descrizione",
                         "prima_nota_data",
                         "prima_nota_categoria",
                         "prima_nota_mezzo_scambio"
                         );
$form->campi_numero = array("prima_nota_entrata", "prima_nota_uscita");

$form->campi_obbligatori=array("prima_nota_descrizione");

// Se siamo in POST
if (count($_POST) > 0) {

	$form->verifica();
	if ($form->errore_form === false)
	{
		foreach ($_POST as $k=>$v)
		{
			$$k=$sql->pulisci($v);
		}
		
        if (array_key_exists("id", $_GET))
		{
            
            $update = "UPDATE " . $tabelle['prima_nota'] . " SET prima_nota_descrizione='" . $prima_nota_descrizione . "', prima_nota_entrata='" . $prima_nota_entrata . "', prima_nota_uscita='" . $prima_nota_uscita . "', prima_nota_categoria='" . $prima_nota_categoria . "', prima_nota_mezzo_scambio='" . $prima_nota_mezzo_scambio . "' WHERE prima_nota_id='" . intval($_GET['id']) . "'";
            $sql->update_query($update);
            
		} else {
            
            $insert = "INSERT INTO " . $tabelle['prima_nota'] . " (prima_nota_descrizione, prima_nota_data, prima_nota_entrata, prima_nota_uscita, prima_nota_categoria, prima_nota_mezzo_scambio) VALUES ('" . $prima_nota_descrizione . "', '" . $prima_nota_data . "', '" . $prima_nota_entrata . "', '" . $prima_nota_uscita . "', '" . $prima_nota_categoria . "', '" . $prima_nota_mezzo_scambio . "')";
            $sql->insert_query($insert);
            
        }
        header("Location:prima_nota.php");
        exit;
	}
}

if (array_key_exists('id', $_GET)) {
    
    $select = "SELECT * FROM " . $tabelle['prima_nota'] . " WHERE prima_nota_id='" . intval($_GET['id']) . "'";
    $result = $sql->select_query($select);
    $row = mysql_fetch_array($result);
    
    $prima_nota_data = $row['prima_nota_data'];
    
    $form->valori_default = array("prima_nota_descrizione" => $row['prima_nota_descrizione'],
                                  "prima_nota_data" => $row['prima_nota_data'],
                                  "prima_nota_entrata" => $row['prima_nota_entrata'],
                                  "prima_nota_uscita" => $row['prima_nota_uscita'],
                                  "prima_nota_categoria" => $row['prima_nota_categoria'],
                                  "prima_nota_mezzo_scambio" => $row['prima_nota_mezzo_scambio'],
                            );
    
} else {

    $data = strftime("%Y-%m-%d", time());
    $prima_nota_data = $data;
    
}

$form->inizializza();

// Caricare elenco delle prime note
$select_pn = "SELECT * FROM " . $tabelle['prima_nota'] . " WHERE prima_nota_data=DATE(NOW()) ORDER BY prima_nota_data DESC, prima_nota_id DESC";
$result_pn = $sql->select_query($select_pn);

// Calcolare i totali del mese
$select_totali_pn = "SELECT SUM(prima_nota_entrata) AS somma_entrata, SUM(prima_nota_uscita) AS somma_uscita FROM " . $tabelle['prima_nota'] . " WHERE prima_nota_data=NOW() ORDER BY prima_nota_data DESC, prima_nota_id DESC";
$result_totali_pn = $sql->select_query($select_totali_pn);

require_once "views/transactions/update.php";
