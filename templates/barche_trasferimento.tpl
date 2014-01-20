{include file="header.tpl"}
<!-- INIZIO RIGA CENTRALE DELLA TABELLA DEI CONTENUTI DOVE SI TROVANO I CONTENUTI -->
<tr>
	<td class="schedaOmbraLeft">&nbsp;</td>
	<td>
		<form action="barca_trasferimento.php?id={$get_id}" method="post" name="form1">
		<table width="100%" border="0">
			<tr>
				<td class="topRigaGrigia"><img src="img/top_imbarcazioni.gif"></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>
					<table width="100%"  border="0" cellspacing="2" cellpadding="0">
                    	<tr>
                    		<td width="23%">Trasferisci quest'imbarcazione
                    			da <strong>{$proprietario_nome}</strong> </td>
                    		<td width="77%">&nbsp;</td>
                    		</tr>
                    	<tr valign="top">
                    		<td>A: </td>
                    		<td><select name="select" size="5">
                    				<option value="a">a</option>
                    				</select></td>
                    		</tr>
                    	<tr>
                    		<td>&nbsp;</td>
                    		<td>&nbsp;</td>
                    		</tr>
                    	<tr>
                    		<td>&nbsp;</td>
                    		<td>&nbsp;</td>
                    		</tr>
                    	<tr>
                    		<td>&nbsp;</td>
                    		<td>&nbsp;</td>
                    		</tr>
                    	</table>
					</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td> <table width="100%"  border="0" cellpadding="0" cellspacing="2">
                	<tr>
                		<td height="20" colspan="3" class="tdUndertopColonne">Trasferimenti
                			dell'imbarcazione <?php echo $barca_nome; ?> </td>
                		</tr>
                	<tr>
                		<td height="20" class="tdUndertopColonne"><strong>Trasferimento
                				da </strong></td>
                		<td class="tdUndertopColonne"><strong>A</strong></td>
                		<td class="tdUndertopColonne"><strong>Data
                				del Trasferimento </strong></td>
                		</tr>
					<!-- inizio riga -->
                	<tr>
                		<td class="tdContenutoVisualizzazione">xxx</td>
                		<td class="tdContenutoVisualizzazione">yyy</td>
                		<td class="tdContenutoVisualizzazione">zzz</td>
                		</tr>
					<!-- inizio riga -->
                	<tr>
                		<td colspan="3">&nbsp;</td>
                		</tr>
                	</table></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>		
		</table>
		</form>
	</td>
	<td class="schedaOmbraRight">&nbsp;</td>
</tr>
<!-- FINE RIGA CENTRALE DELLA TABELLA DEI CONTENUTI DOVE SI TROVANO I CONTENUTI -->
{include file="footer.tpl"}