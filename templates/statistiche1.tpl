{include file="header.tpl"}
<!-- INIZIO RIGA CENTRALE DELLA TABELLA DEI CONTENUTI DOVE SI TROVANO I CONTENUTI -->
<tr>
	<td class="schedaOmbraLeft">&nbsp;</td>
	<td>
		<form action="statistiche1.php" method="post" name="form1">
		<table width="100%" border="0">
			<tr>
				<td class="topRigaGrigia"><img src="img/statistiche.gif"></td>
			</tr>
			<tr>
				<td>Cambia Anno: 
				<select name="anno">
				{foreach from=$anni item=i}
					<option value="{$i}">{$i}</option>
				{/foreach}
				</select>
				<input type="submit" name="Submit" value=">">
				</td>
			</tr>
			<tr>
				<td>Statistiche sulle Presenze per nazionalit&agrave; dell'anno {$anno}</td>
			</tr>
			<tr>
				<td>
				<table border="0">
                	<tr>
                		<td><strong>Nazione</strong></td>
                		<td align="center"><strong>Gennaio</strong></td>
                		<td align="center"><strong>Febbraio</strong></td>
                		<td align="center"><strong>Marzo</strong></td>
                		<td align="center"><strong>Aprile</strong></td>
                		<td align="center"><strong>Maggio</strong></td>
                		<td align="center"><strong>Giugno</strong></td>
                		<td align="center"><strong>Luglio</strong></td>
                		<td align="center"><strong>Agosto</strong></td>
                		<td align="center"><strong>Settembre</strong></td>
                		<td align="center"><strong>Ottobre</strong></td>
                		<td align="center"><strong>Novembre</strong></td>
                		<td align="center"><strong>Dicembre</strong></td>
                		<td align="right"><strong>Totale</strong></td>
                		</tr>
				{foreach from=$stat item=i}					
                	<tr>
                		<td><strong>{$i.nazione}</strong></td>
                		<td align="center">{$i.1|default:'0'}</td>
                		<td align="center">{$i.2|default:'0'}</td>
                		<td align="center">{$i.3|default:'0'}</td>
                		<td align="center">{$i.4|default:'0'}</td>
                		<td align="center">{$i.5|default:'0'}</td>
                		<td align="center">{$i.6|default:'0'}</td>
                		<td align="center">{$i.7|default:'0'}</td>
                		<td align="center">{$i.8|default:'0'}</td>
                		<td align="center">{$i.9|default:'0'}</td>
                		<td align="center">{$i.10|default:'0'}</td>
                		<td align="center">{$i.11|default:'0'}</td>
                		<td align="center">{$i.12|default:'0'}</td>
                		<td align="right"><strong>{$i.tot|default:'0'}</strong></td>
               		</tr>
				{/foreach}
				</table>
				</td>
			</tr>
			<tr>
				<td><p>&nbsp;
					</p>
					</td>
			</tr>		
		</table>
		</form>
	</td>
	<td class="schedaOmbraRight">&nbsp;</td>
</tr>
<!-- FINE RIGA CENTRALE DELLA TABELLA DEI CONTENUTI DOVE SI TROVANO I CONTENUTI -->
{include file="footer.tpl"}