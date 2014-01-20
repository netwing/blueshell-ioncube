{include file="header.tpl"}
<!-- INIZIO RIGA CENTRALE DELLA TABELLA DEI CONTENUTI DOVE SI TROVANO I CONTENUTI -->
{literal}
<script src="cpaint/cpaint2.inc.js" type="text/javascript"></script>
<script language="javascript">
<!--
var cp = new cpaint();
cp.set_debug(0);
// Per gestire le bazze dei contratti
function contrattotipo()
{
/*	if (document.getElementById('contratto_tipo').value=='1')
	{
		document.getElementById('contratto_anagrafica1').options[0] = new Option('Seaser S.p.A.', '1', false, false);
	}
*/
}

// Per cercare i clienti
function clientecerca1() 
{
  cp.call('functions.inc.php', 'cliente_cerca', clienti_elenco1, document.getElementById('cliente_cerca1').value);
  //window.alert("Cerchi i clienti che contengano "+document.getElementById('cliente_cerca').value);
}
function clienti_elenco1(result)
{
	document.getElementById('contratto_anagrafica1').length=0;
	for (i=0;i<result.ajaxResponse[0].record[0].data;i++)
	{
		document.getElementById('contratto_anagrafica1').options[i] = new Option(result.ajaxResponse[0].clientenominativo[i].data, result.ajaxResponse[0].clienteid[i].data, false, false);
	}
}
function clientecerca2() 
{
  cp.call('functions.inc.php', 'cliente_cerca', clienti_elenco2, document.getElementById('cliente_cerca2').value);
  //window.alert("Cerchi i clienti che contengano "+document.getElementById('cliente_cerca').value);
}
function clienti_elenco2(result)
{
	document.getElementById('contratto_anagrafica2').length=0;
	for (i=0;i<result.ajaxResponse[0].record[0].data;i++)
	{
		document.getElementById('contratto_anagrafica2').options[i] = new Option(result.ajaxResponse[0].clientenominativo[i].data, result.ajaxResponse[0].clienteid[i].data, false, false);
	}
}
// Per cercare le barche del cliente
function barcacerca()
{
	cp.call('functions.inc.php', 'barca_cerca', barche_elenco, document.getElementById('contratto_anagrafica2').value);
}
function barche_elenco(result)
{
	document.getElementById('contratto_barca').length=0;
	for (i=0;i<=result.ajaxResponse[0].record[0].data;i++)
	{
		document.getElementById('contratto_barca').options[i] = new Option(result.ajaxResponse[0].barcanome[i].data, result.ajaxResponse[0].barcaid[i].data, false, false);
	}
}

// Per caricare i posti barca
function caricapostibarca()
{
	cp.call('functions.inc.php', 'caricapostibarca', elencopostibarca, document.getElementById('dimensioni_pb').value);
	document.getElementById('costo_postobarca').value=document.getElementById('dimensioni_pb').value;
	cp.call('functions.inc.php', 'caricacostipostobarca', costipostobarca, document.getElementById('dimensioni_pb').value);
	document.getElementById('info_pb').innerHTML="Posti Barca in caricamento...";	
}
function elencopostibarca(result)
{
	document.getElementById('info_pb').innerHTML="&nbsp;";
	document.getElementById('contratto_posto_barca').length=0;
	for (i=0;i<=result.ajaxResponse[0].record[0].data;i++)
	{
		document.getElementById('contratto_posto_barca').options[i] = new Option(result.ajaxResponse[0].postobarca[i].data, result.ajaxResponse[0].postobarcaid[i].data, false, false);
	}

}

// Per caricare i costi del posto barca
function caricacostipostobarca()
{
	cp.call('functions.inc.php', 'caricacostipostobarca', costipostobarca, document.getElementById('costo_postobarca').value);
}
function costipostobarca(result)
{
	document.getElementById('costo_anno1').length=0;
	document.getElementById('costo_anno2').length=0;
	document.getElementById('costo_anno1').options[0] = new Option('', 0, false, false);		
	document.getElementById('costo_anno2').options[0] = new Option('', 0, false, false);		
	for (i=0;i<=result.ajaxResponse[0].record[0].data;i++)
	{
		j=i+1;
		document.getElementById('costo_anno1').options[j] = new Option(result.ajaxResponse[0].etichettacosto1[i].data, result.ajaxResponse[0].costo1[i].data, false, false);
		document.getElementById('costo_anno2').options[j] = new Option(result.ajaxResponse[0].etichettacosto2[i].data, result.ajaxResponse[0].costo2[i].data, false, false);	
	}
}
// Per lo status del posto barca
function caricainfopostobarca()
{
	contratto_inizio=document.getElementById('contratto_inizio_Year').value+"-"+document.getElementById('contratto_inizio_Month').value+"-"+document.getElementById('contratto_inizio_Day').value;
	contratto_fine=document.getElementById('contratto_fine_Year').value+"-"+document.getElementById('contratto_fine_Month').value+"-"+document.getElementById('contratto_fine_Day').value;
	//contratto_inizio=0;
	//contratto_fine=0;
	//window.alert(contratto_inizio+" - "+contratto_fine);
	cp.call('functions.inc.php','caricainfopostobarca',infopostobarca,document.getElementById('contratto_posto_barca').value,contratto_inizio,contratto_fine);
}
function infopostobarca(result)
{
	document.getElementById('info_pb').innerHTML=result.ajaxResponse[0].proprietario[0].data+"<br />"+result.ajaxResponse[0].gestore[0].data+"<br />";
	document.getElementById('info_pb').innerHTML+=result.ajaxResponse[0].contratto[0].data;
//	window.alert(result.ajaxResponse[0].contratto[0].data);
}
function resetta()
{
	document.getElementById('costo_anno1').value=0;
	document.getElementById('costo_anno1_molt').value=1;
	document.getElementById('costo_anno2').value=0;
	document.getElementById('costo_anno2_molt').value=1;
}
function calcola_prezzo_listino()
{
	document.getElementById('prezzo_listino').value=(document.getElementById('costo_anno1').value*document.getElementById('costo_anno1_molt').value)+(document.getElementById('costo_anno2').value*document.getElementById('costo_anno2_molt').value);
}
function calcola()
{
	prezzo_listino=document.getElementById('prezzo_listino').value;
	iva=document.getElementById('iva').value;
	sconto=document.getElementById('sconto').value;
	cp.call('functions.inc.php','calcola',valori,prezzo_listino,iva,sconto);
}
function valori(result)
{
	//document.getElementById('prezzo_listino').value=listino;
	document.getElementById('prezzo_listino').value=result.ajaxResponse[0].prezzolistino[0].data;
	document.getElementById('imponibile').value=result.ajaxResponse[0].imponibile[0].data;
	document.getElementById('imposta').value=result.ajaxResponse[0].imposta[0].data;
	document.getElementById('totale').value=result.ajaxResponse[0].totale[0].data;
	document.getElementById('imponibile_scontato').value=result.ajaxResponse[0].imponibilescontato[0].data;
	document.getElementById('imposta_scontata').value=result.ajaxResponse[0].impostascontata[0].data;
	document.getElementById('totale_scontato').value=result.ajaxResponse[0].totalescontato[0].data;	
}
//-->
</script>
{/literal}
<tr>
	<td class="schedaOmbraLeft">&nbsp;</td>
	<td>
		<form action="contratto_nuovo.php" method="post" name="form1">
		<table width="100%" border="0">
			<tr>
				<td class="topRigaGrigia"><img src="img/top_contratti.gif"></td>
			</tr>
			<tr>
				<td><p>Tipo di Contratto 
					
					<select name="contratto_tipo" id="contratto_tipo" onchange="contrattotipo()">
						<option value="0"></option>
						<option value="1">Affitto</option>
						<option value="11">Transito</option>
						<option value="2">Vendita</option>
						<option value="13">Opzione</option>
						<option value="3">Gestione</option>
						<option value="4">Prenotazione</option>
						</select>
				- Periodo 
						<select name="contratto_periodo" id="contratto_periodo">
						{foreach from=$periodi key=k item=i}
						
							
							<option value="{$k}">{$i|capitalize}</option>
						{/foreach}
					</select>
					</p>
					<p>Data del Contratto {html_select_date prefix='contratto_data_' start_year='1997' end_year='+50' field_order='DMY'} </p>
					<table width="100%" border="0" cellpadding="2">
						<tr>
							<td>&nbsp;</td>
							<td><a href="cliente_inserimento.php" target="_blank">Aggiungi un cliente...</a> (chiudi la pagina dopo l'inserimento) </td>
						</tr>
						<tr>
							<td width="343">Cliente 1
								<input name="cliente_cerca1" type="text" id="cliente_cerca1" size="20" maxlength="50" onkeyup="clientecerca1()" />
								<br />
								<select name="contratto_anagrafica1" size="10" id="contratto_anagrafica1">
								</select></td>
							<td width="343">Cliente 2
								<input name="cliente_cerca2" type="text" id="cliente_cerca2" size="20" maxlength="50" onkeyup="clientecerca2()" />
								<br />
								<select name="contratto_anagrafica2" size="10" id="contratto_anagrafica2" onchange="barcacerca()">
								</select></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td><a href="barca_inserimento.php?id=0" target="_blank">Aggiungi una barca...</a> (chiudi la pagina dopo l'inserimento) </td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td><p>Barca del Cliente 2 <br />
										<select name="contratto_barca" size="5" id="contratto_barca">
										</select>
							</p></td>
						</tr>
						<tr>
							<td>Inizio del Contratto {html_select_date prefix='contratto_inizio_' start_year='1997' end_year='+50' field_order='DMY' day_extra='id="contratto_inizio_Day"' month_extra='id="contratto_inizio_Month"' year_extra='id="contratto_inizio_Year"'}</td>
							<td>Fine del Contratto {html_select_date prefix='contratto_fine_' start_year='1997' end_year='+50' field_order='DMY' day_extra='id="contratto_fine_Day"' month_extra='id="contratto_fine_Month"' year_extra='id="contratto_fine_Year"'}</td>
						</tr>
						<tr>
							<td valign="top">Dimensioni Posto Barca 
								<select name="dimensioni_pb" id="dimensioni_pb" onchange="caricapostibarca()">
								{foreach from=$dimensioni item=i key=k}
									<option value="{$k}"{if $k==$dimensione_id} selected="selected"{/if}>{$i}</option>
								{/foreach}
								</select>
								<div id="info_pb">&nbsp;</div></td>
							<td valign="top">
							<select name="contratto_posto_barca" size="10" id="contratto_posto_barca" onchange="caricainfopostobarca()">
							{if $posto_barca_id>0}
							<option value="{$posto_barca_id}" selected="selected">{$posto_barca_scelto}</option>
							{/if}
							</select>
								<input name="Button" type="button" id="Button" value="Verifica Disponibilit&agrave;" onclick="caricainfopostobarca()" /></td>
						</tr>
						<tr>
							<td>Dimensioni su cui calcolare il costo 
								<select name="costo_postobarca" id="costo_postobarca" onchange="caricacostipostobarca()">
								{foreach from=$dimensioni item=i key=k}
								<option value="{$k}">{$i}</option>
								{/foreach}
								</select>								</td>
							<td>Costo Primo Anno 
								<select name="costo_anno1" id="costo_anno1" onchange="calcola_prezzo_listino()">
								</select>
								x 
								<input name="costo_anno1_molt" type="text" id="costo_anno1_molt" value="1" size="2" maxlength="2" onkeyup="calcola_prezzo_listino()" />
								<br />
								Costo Secondo Anno 
								<select name="costo_anno2" id="costo_anno2" onchange="calcola_prezzo_listino()">
								</select>
								x
								<input name="costo_anno2_molt2" type="text" id="costo_anno2_molt" value="1" size="2" maxlength="2" onkeyup="calcola_prezzo_listino()" />								</td>
						</tr>
						<tr>
							<td><p>
								Prezzo di Listino
										<input name="prezzo_listino" type="text" id="prezzo_listino" size="10" onkeyup="resetta()" />
							</p>
								<p>
									<select name="iva" id="iva">
										<option value="esclusa">Iva Esclusa</option>
										<option value="compresa">Iva Compresa</option>
										<option value="esente">Esente Iva</option>
									</select>
								</p>								</td>
							<td><p>Imponibile
									<input name="imponibile" type="text" id="imponibile" />
</p>
								<p>Imposta 
									<input name="imposta" type="text" id="imposta" />
								</p>
								<p>Totale
									<input name="totale" type="text" id="totale" />
								</p></td>
						</tr>
						<tr>
							<td>Applica percentuale di sconto 
								<input name="sconto" type="text" id="sconto" value="0" size="5" maxlength="2" /></td>
							<td><p>Imponibile
								<input name="imponibile_scontato" type="text" id="imponibile_scontato" />
							</p>
								<p>Imposta
									<input name="imposta_scontata" type="text" id="imposta_scontata" />
								</p>
								<p>Totale
									<input name="totale_scontato" type="text" id="totale_scontato" />
								</p></td>
						</tr>
						<tr>
							<td>Percentuale di Gestione 
								<input name="gestione" type="text" id="gestione" size="5" maxlength="2" /></td>
							<td><input name="calcolatutto" type="button" id="calcolatutto" value="CALCOLA" onclick="calcola()" /></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td><input type="submit" name="Submit" value="INSERISCI" /></td>
						</tr>
					</table>
					</td>
			</tr>
		</table>
		</form>
	</td>
	<td class="schedaOmbraRight">&nbsp;</td>
</tr>
<!-- FINE RIGA CENTRALE DELLA TABELLA DEI CONTENUTI DOVE SI TROVANO I CONTENUTI -->
{include file="footer.tpl"}