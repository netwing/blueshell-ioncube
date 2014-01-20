{* Passare a questo file i parametri ETICHETTA, NOME_CAMPO e VALUE_CAMPO *}

<table width="300" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="150"><strong>{$etichetta}</strong></td>
	    <td width="150" align="right">
		<input name="{$nome_campo}" type="text" id="{$nome_campo}" value="{$value_campo}" size="12" maxlength="12" />
		<input name="Reset" type="reset" onclick="return showCalendar('{$nome_campo}', 'dd-mm-y');" value="..." />
		</td>
	</tr>
</table>
