<?php
require_once("config.inc.php");
$blue->autentica_utente("documenti","R");
$elenco_nazioni=$blue->elenco_nazioni();
$elenco_tipologie=$blue->elenco_tipologie();
$elenco_assicurazioni=$blue->elenco_assicurazioni();
$select_prezzo="";
$prezzo="";
$totale="";

$dal=$sql->data_ita($_SESSION['riepilogo']['contratto']['contratto_inizio']);
$dal_ts=$dal[4];
$dal=$dal[0];
$al=$sql->data_ita($_SESSION['riepilogo']['contratto']['contratto_fine']);
$al_ts=$al[4];
$al=$al[0];
$durata=intval(($al_ts-$dal_ts)/(60*60*24));
$data=$sql->data_ita($_SESSION['riepilogo']['contratto']['contratto_data']);
$data=$data[0];
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="stile.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php include("top.php"); ?>
<table border="0" cellpadding="0" cellspacing="0" id="tabellaScheda">
	<tr>
		<td class="schedaCurvaTopLeft">&nbsp;</td>
		<td class="schadaOmbraTop">&nbsp;</td>
		<td class="schedaCurvaTopRight">&nbsp;</td>
	</tr>
	<tr>
		<td class="schedaOmbraLeft">&nbsp;</td>
		<td class="font10Px"><p><img src="img/top_contratti.gif" border="0" /></p>
			<p>Verificare che i dati siano corretti e cliccare sul bottone stampa per avere l'anteprima di stampa</p>
			<form action="template_contratto_gestione.php" method="post" name="form1" id="form1">
				<p>Data del Contratto 
					<input name="data" type="text" id="data" value="<?php echo $data; ?>">
				</p>
				<table width="700" border="0" cellpadding="2" cellspacing="2" class="font10Px">
            	<tr>
            		<td><strong>DATI RELATIVI AL CONTRATTO:</strong></td>
           		</tr>
            	<tr>
            		<td class="tratteggioSotto"><table width="100%"  border="0" cellpadding="0" cellspacing="0" class="font10Px">
            				<tr>
            					<td width="150">Nome e Cognome / Ragione sociale </td>
            					<td><input name="nominativo" type="text" id="nominativo" value="<?php echo $_SESSION['riepilogo']['cliente']['cliente_nominativo']; ?>"></td>
           					</tr>
            				</table></td>
           		</tr>
            	<tr>
            		<td class="tratteggioSotto"><table width="100%"  border="0" cellpadding="0" cellspacing="0" class="font10Px">
            				<tr>
            					<td width="150">Indirizzo: </td>
            					<td><input name="indirizzo" type="text" id="indirizzo" value="<?php echo $_SESSION['riepilogo']['cliente']['cliente_indirizzo']; ?>"></td>
           					</tr>
            				</table></td>
           		</tr>
            	<tr>
            		<td class="tratteggioSotto"><table width="100%"  border="0" cellpadding="0" cellspacing="0" class="font10Px">
            				<tr>
            					<td width="150">Cap.</td>
            					<td><input name="cap" type="text" id="cap" value="<?php echo $_SESSION['riepilogo']['cliente']['cliente_cap']; ?>"></td>
           					</tr>
            				</table></td>
           		</tr>
            	<tr>
            		<td class="tratteggioSotto"><table width="100%"  border="0" cellpadding="0" cellspacing="0" class="font10Px">
            				<tr>
            					<td width="150">Naz. </td>
            					<td><input name="nazione" type="text" id="nazione" value="<?php echo $elenco_nazioni[$_SESSION['riepilogo']['cliente']['country']]; ?>"></td>
           					</tr>
            				</table></td>
           		</tr>
            	<tr>
            		<td class="tratteggioSotto"><table width="100%"  border="0" cellpadding="0" cellspacing="0" class="font10Px">
            				<tr>
            					<td width="150">Citt&agrave;</td>
            					<td><input name="citta" type="text" id="citta" value="<?php echo $_SESSION['riepilogo']['cliente']['cliente_citta']; ?>" size="45"></td>
           					</tr>
            				</table></td>
           		</tr>
            	<tr>
            		<td class="tratteggioSotto"><table width="100%"  border="0" cellpadding="0" cellspacing="0" class="font10Px">
            				<tr>
            					<td width="150">Partita Iva </td>
            					<td><input name="partita_iva" type="text" id="partita_iva" value="<?php echo $_SESSION['riepilogo']['cliente']['cliente_partita_iva']; ?>"></td>
           					</tr>
            				</table></td>
           		</tr>
            	<tr>
            		<td class="tratteggioSotto"><table width="100%"  border="0" cellpadding="0" cellspacing="0" class="font10Px">
                    	<tr>
                    		<td width="150">Codice Fiscale </td>
                    		<td><input name="codice_fiscale" type="text" id="codice_fiscale" value="<?php echo $_SESSION['riepilogo']['cliente']['cliente_codice_fiscale']; ?>"></td>
                    		</tr>
                    	</table></td>
           		</tr>
            	<tr>
            		<td class="tratteggioSotto"><table width="100%"  border="0" cellpadding="0" cellspacing="0" class="font10Px">
            				<tr>
            					<td width="150">Data del Contratto </td>
            					<td><input name="data_contratto" type="text" id="data_contratto" value="<?php $contratto_data=$sql->data_ita($_SESSION['riepilogo']['contratto']['contratto_data']); echo $contratto_data[0]; ?>"></td>
           					</tr>
            				</table></td>
           		</tr>
            	<tr>
            		<td class="tratteggioSotto"><table width="100%"  border="0" cellpadding="0" cellspacing="0" class="font10Px">
						<tr>
							<td width="150">Percentuale di Gestione </td>
							<td><input name="gestione_percentuale" type="text" id="gestione_percentuale" value="<?php echo $_SESSION['riepilogo']['contratto']['contratto_gestione_percentuale']; ?>"></td>
						</tr>
					</table></td>
            		</tr>
            	<tr>
            		<td class="tratteggioSotto"><p>Il presente contratto avr&agrave; durata di anni 1 <br>
            			con inizio
                    				dal
                    				<input name="dal" type="text" id="dal" value="<?php echo $dal; ?>">
				e scadenza il
				<input name="al" type="text" id="al" value="<?php echo $al; ?>">
            				</p></td>
           		</tr>
            	<tr>
            		<td align="right"><table width="100%"  border="0" cellpadding="5" cellspacing="0" class="font10Px">
                    	<tr>
                    	  <td class="tratteggioSotto"><strong>DATI RELATIVI ALL'ORMEGGIO </strong></td>
                  	  </tr>
                    	<tr>
                    		<td class="tratteggioSotto"><table width="100%"  border="0" cellpadding="5" cellspacing="0" class="font10Px">
                    				<tr>
                    					<td width="160"><strong>Ormeggio assegnato:</strong></td>
                    					<td><strong>Pontile
                            						<input name="pontile" type="text" id="pontile" value="<?php echo $_SESSION['riepilogo']['pontile']['pontile_codice']; ?>" size="30">
                    						</strong></td>
                    					<td><strong>N&deg;
                            						<input name="posto_barca" type="text" id="posto_barca" value="<?php echo $_SESSION['riepilogo']['pontile']['posto_barca_numero']; ?>" size="30">
                    						</strong></td>
           					  </tr>
                    				<tr>
                    					<td>&nbsp;</td>
                    					<td>&nbsp;</td>
                    					<td>&nbsp;</td>
           					  </tr>
                    				<tr>
                    					<td><strong>Dimensioni</strong></td>
                    					<td><strong>Lunghezza
                    						<input name="lunghezza" type="text" id="lunghezza" value="<?php echo $_SESSION['riepilogo']['pontile']['dimensione_lunghezza']; ?>">
                    					</strong></td>
                    					<td><strong>Larghezza
                    						<input name="larghezza" type="text" id="larghezza" value="<?php echo $_SESSION['riepilogo']['pontile']['dimensione_larghezza']; ?>">
                    					</strong></td>
           					  </tr>
                    				</table>
                        			<strong> </strong></td>
                    		</tr>
                    	</table></td>
           		</tr>
            	<tr>
            		<td align="right"><input type="submit" name="Submit" value="STAMPA"></td>
           		</tr>
            	</table>
			    <br>
			<table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="tratteggioSottoGrande">&nbsp;</td>
              </tr>
            </table>
			<br>
			</form>
		</td>
		<td class="schedaOmbraRight">&nbsp;</td>
	</tr>
	<tr>
		<td class="schedaCurvaBottomLeft">&nbsp;</td>
		<td class="schedaOmbraBottom">&nbsp;</td>
		<td class="schedaCurvaBottomRight">&nbsp;</td>
	</tr>
</table>
</body>
</html>