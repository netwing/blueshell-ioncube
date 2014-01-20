{include file="header.tpl"}
<!-- INIZIO RIGA CENTRALE DELLA TABELLA DEI CONTENUTI DOVE SI TROVANO I CONTENUTI -->
<tr>
	<td class="schedaOmbraLeft">&nbsp;</td>
	<td>
		<form action="genera_report_arrivi.php" method="post" name="form1">
		<table width="100%" border="0">
			<tr>
				<td class="topRigaGrigia"><img src="img/top_contratti.gif"></td>
			</tr>
			<tr>
				<td>Indica il pontile e le date di <strong>arrivo</strong> entro
					cui generare il rapporto. </td>
			</tr>
			<tr>
				<td><select name="pontile" id="pontile">
				{foreach from=$pontili item=pontile_codice key=pontile_id}
					{if $pontile == $pontile_id}
						
					<option value="{$pontile_id}" selected="selected">{$pontile_codice}</option>
					{else}
						<option value="{$pontile_id}">{$pontile_codice}</option>					
					{/if}
				{/foreach}
				</select> 
				{$messaggio} </td>
			</tr>
			<tr>
        		<td>
				    <p>{include file="seleziona_data.tpl" etichetta="Con
				    	inizio dal " nome_campo="inizio_dal" value_campo="$inizio_dal"}</p>
				    <p>{include	file="seleziona_data.tpl" etichetta="Fino
				    	al " nome_campo="inizio_al" value_campo="$inizio_al"} </p>
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