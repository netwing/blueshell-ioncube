{include file="header.tpl"}
<!-- INIZIO RIGA CENTRALE DELLA TABELLA DEI CONTENUTI DOVE SI TROVANO I CONTENUTI -->
<tr>
	<td class="schedaOmbraLeft">&nbsp;</td>
	<td>
		<form action="lettere_scadenza_contratto.php" method="post" name="form1">
		<table width="100%" border="0">
			<tr>
				<td class="topRigaGrigia"><img src="img/top_documenti_lettere_contratti.gif"></td>
			</tr>
			<tr>
				<td>Seleziona le date di scadenza contratto iniziale e finale
					per la generazione delle lettere di avviso: </td>
			</tr>
			<tr>
        		<td>
				    <p>{include file="seleziona_data.tpl" etichetta="Con scadenza dal " nome_campo="contratto_fine_dal" value_campo="$contratto_fine_dal"}</p>
				    <p>{include	file="seleziona_data.tpl" etichetta="Fino al " nome_campo="contratto_fine_al" value_campo="$contratto_fine_al"} </p>
				</td>
        	</tr>
			<tr>
				<td><input name="Esegui" type="submit" id="Esegui" value="Esegui"></td>
			</tr>		
		</table>
		</form>
	</td>
	<td class="schedaOmbraRight">&nbsp;</td>
</tr>
<!-- FINE RIGA CENTRALE DELLA TABELLA DEI CONTENUTI DOVE SI TROVANO I CONTENUTI -->
{include file="footer.tpl"}