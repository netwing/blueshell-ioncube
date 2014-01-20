{include file="header.tpl"}
<!-- INIZIO RIGA CENTRALE DELLA TABELLA DEI CONTENUTI DOVE SI TROVANO I CONTENUTI -->
<tr>
	<td class="schedaOmbraLeft">&nbsp;</td>
	<td>
		<form action="genera_etichette_clienti.php" method="post" name="form1">
		<table width="100%" border="0">
			<tr>
				<td class="topRigaGrigia"><img src="img/top_contratti.gif"></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td><p>Prepara le etichette da applicare sulle buste.</p>
					<!-- Seleziona il template di stampa 
					<select name="template" id="template">
						{foreach from=$elenco_file item=file}
						<option value="{$file}">{$file}</option>
						{/foreach}
					</select> --></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td> <input name="proprietari" type="checkbox" id="proprietari" value="proprietari">
					Stampa le etichette con gli indirizzi dei <strong>proprietari</strong></td>
			</tr>
			<tr>
				<td><input name="affittuari" type="checkbox" id="affittuari" value="affittuari">
Stampa le lettere con gli indirizzi degl'<strong>affittuari</strong></td>
			</tr>
			<tr>
				<td><input name="presenze" type="checkbox" id="presenze" value="presenze">
Stampa le lettere con gli indirizzi dei <strong>presenti</strong></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
        		<td>
				    <p>{include file="seleziona_data.tpl" etichetta="Dal" nome_campo="contratto_inizio" value_campo="$contratto_data"}<br />
{include file="seleziona_data.tpl" etichetta="Al" nome_campo="contratto_fine" value_campo="$contratto_data"}</p>
				    </td>
        	</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td><input name="template" type="hidden" value="lettera_cambio_cc.rtf">
				<input name="Esegui" type="submit" id="Esegui" value="Esegui"></td>
			</tr>		
		</table>
		</form>
	</td>
	<td class="schedaOmbraRight">&nbsp;</td>
</tr>
<!-- FINE RIGA CENTRALE DELLA TABELLA DEI CONTENUTI DOVE SI TROVANO I CONTENUTI -->
{include file="footer.tpl"}