{include file="header.tpl"}
<!-- INIZIO RIGA CENTRALE DELLA TABELLA DEI CONTENUTI DOVE SI TROVANO I CONTENUTI -->
<tr>
	<td class="schedaOmbraLeft">&nbsp;</td>
	<td>
		<form action="genera_rendite.php" method="post" name="form1">
		<table width="100%" border="0">
			<tr>
				<td class="topRigaGrigia"><img src="img/top_contratti.gif"></td>
			</tr>
			<tr>
				<td>Indica  le date di  entro
					cui generare il rapporto. </td>
			</tr>
			<tr>
        		<td>
				    <p>{include file="seleziona_data.tpl" etichetta="Dal" nome_campo="dal" value_campo="$dal"}</p>
				    <p>{include	file="seleziona_data.tpl" etichetta="Al " nome_campo="al" value_campo="$al"} </p>
				</td>
        	</tr>
			<tr>
				<td><input name="excel" type="checkbox" id="excel" value="excel">
					Genera Foglio Excel </td>
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