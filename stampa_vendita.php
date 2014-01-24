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

$costo=number_format($_SESSION['riepilogo']['contratto']['contratto_imponibile'],2,'.','');
$iva=number_format($_SESSION['riepilogo']['contratto']['contratto_totale']-$_SESSION['riepilogo']['contratto']['contratto_imponibile'],2,'.','');
$costo_totale=number_format($_SESSION['riepilogo']['contratto']['contratto_totale'],2,'.','');
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
			<form action="template_contratto_vendita.php" method="post" name="form1" id="form1">
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
								<td width="150">Data di nascita: </td>
								<td><input name="data_nascita" type="text" id="data_nascita" value="
								<?php 
								
									if ($_SESSION['riepilogo']['cliente']['cliente_data_nascita']!="0000-00-00")
									{
										$data_ita=$sql->data_ita($_SESSION['riepilogo']['cliente']['cliente_data_nascita']);
										echo $data_ita[0];
										//echo strftime("%d-%m-%Y",strtotime($_SESSION['riepilogo']['cliente']['cliente_data_nascita'])); 
									}
									?>
									
								"></td>
							</tr>
					</table></td>
            		</tr>
            	<tr>
					<td class="tratteggioSotto"><table width="100%"  border="0" cellpadding="0" cellspacing="0" class="font10Px">
							<tr>
								<td width="150">Luogo di Nascita : </td>
								<td><input name="luogo_nascita" type="text" id="luogo_nascita" value="<?php echo $_SESSION['riepilogo']['cliente']['cliente_luogo_nascita']; ?>"></td>
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
            					<td><input name="data_contratto" type="text" id="data_contratto" value="<?php echo $_SESSION['riepilogo']['contratto']['contratto_data']; ?>"></td>
           					</tr>
            				</table></td>
           		</tr>
            	<tr>
            		<td align="right"><table width="100%"  border="0" cellpadding="5" cellspacing="0" class="font10Px">
                    	<tr>
                    		<td class="tratteggioSotto"><strong>DATI RELATIVI AI COSTI </strong></td>
                    		</tr>
                    	<tr>
                    		<td class="tratteggioSotto"><table width="100%"  border="0" cellpadding="5" cellspacing="0" class="font10Px">
                    				<tr>
                    					<td colspan="3"><strong>Prezzo del Posto Barca in cifre </strong></td>
                    					</tr>
                    				<tr>
                    					<td width="160"><strong>Costo
                    						<input name="costo" type="text" id="costo" value="<?php echo $costo; ?>" size="10">
                    					</strong></td>
                    					<td><strong>IVA
                    							<input name="iva" type="text" id="iva" value="<?php echo $iva; ?>" size="10">
                    						</strong></td>
                    					<td><strong>Totale
                            						<input name="costo_totale" type="text" id="costo_totale" value="<?php echo $costo_totale; ?>" size="10">
                    						</strong></td>
                    					</tr>
                    				<tr>
                                    	<td colspan="3"><strong>Prezzo del Posto Barca in lettere </strong></td>
                    					</tr>
                    				<tr>
                                    	<td><strong>Costo
                                            		<input name="costo_lettere" type="text" id="costo_lettere" value="<?php echo $_SESSION['riepilogo']['contratto_dettagli']['contratto_dettaglio_costo_lettere']; ?>" size="20">
                                    		</strong></td>
                                    	<td><strong>IVA
                                            		<input name="iva_lettere" type="text" id="iva_lettere" value="<?php echo $_SESSION['riepilogo']['contratto_dettagli']['contratto_dettaglio_iva_lettere']; ?>" size="20">
                                    		</strong></td>
                                    	<td><strong>Totale
                                            		<input name="costo_totale_lettere" type="text" id="costo_totale_lettere" value="<?php echo $_SESSION['riepilogo']['contratto_dettagli']['contratto_dettaglio_totale_lettere']; ?>" size="20">
                                    		</strong></td>
                    					</tr>
                    				<tr>
                    					<td colspan="3"><strong>Modalit&agrave; di Pagamento 
                    						<input name="modalita_pagamento" type="text" id="modalita_pagamento" value="<?php echo $_SESSION['riepilogo']['contratto_dettagli']['contratto_dettaglio_modalita_pagamento']; ?>" size="60">
                    					</strong></td>
                    					</tr>
                    				<tr>
                    					<td colspan="3"><strong>Oneri per l'anno 
                    						<input name="anno_oneri" type="text" id="anno_oneri" value="<?php echo $_SESSION['riepilogo']['contratto_dettagli']['contratto_dettaglio_oneri_anno']; ?>" size="10">
pari a 
<input name="costo_oneri" type="text" id="costo_oneri" value="<?php echo $_SESSION['riepilogo']['contratto_dettagli']['contratto_dettaglio_oneri_cifra']; ?>" size="10">
<input name="costo_oneri_lettere" type="text" id="costo_oneri_lettere" value="<?php echo $_SESSION['riepilogo']['contratto_dettagli']['contratto_dettaglio_oneri_lettere']; ?>" size="20"> 
saldabili entro il mese di 
<input name="mese_oneri" type="text" id="mese_oneri" value="<?php echo $_SESSION['riepilogo']['contratto_dettagli']['contratto_dettaglio_oneri_saldabili_mese']; ?>" size="10">
</strong></td>
                    					</tr>
                    				<tr>
                    					<td colspan="3">&nbsp;</td>
                    					</tr>
                    				</table>
                        			<strong> </strong></td>
                    		</tr>
                    	</table></td>
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