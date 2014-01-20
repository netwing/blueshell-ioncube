{include file="header.tpl"}
<!-- INIZIO RIGA CENTRALE DELLA TABELLA DEI CONTENUTI DOVE SI TROVANO I CONTENUTI -->
<tr>
	<td class="schedaOmbraLeft">&nbsp;</td>
	<td>
		<form action="lettere_comunicazioni_clienti.php" method="post" name="form1">
		<table width="100%" border="0">
			<tr>
				<td class="topRigaGrigia"><img src="img/top_contratti.gif"></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td><p>Prepara le lettere per comunicare con i clienti.<br>
					Per utilizzare lettere personalizzate, bisogna caricare il modello dalla pagina di <strong>Gestione Template. </strong><br>
							Ulteriori possibili comunicazioni
							saranno disponibili a breve.</p>
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
					Stampa le lettere per i <strong>proprietari</strong></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td><input name="affittuari" type="checkbox" id="affittuari" value="affittuari">
Stampa le lettere per gli <strong>affittuari</strong></td>
			</tr>
			<tr>
        		<td>
				    <p>{include file="seleziona_data.tpl" etichetta="Dal " nome_campo="contratto_dal" value_campo="$contratto_dal"}</p>
				    </td>
        	</tr>
			<tr>
				<td>{include file="seleziona_data.tpl" etichetta="Al " nome_campo="contratto_al" value_campo="$contratto_al"}</td>
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