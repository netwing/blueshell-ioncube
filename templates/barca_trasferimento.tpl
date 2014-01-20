{include file="header.tpl"}
<!-- INIZIO RIGA CENTRALE DELLA TABELLA DEI CONTENUTI DOVE SI TROVANO I CONTENUTI -->
{literal}
<script>
<!--
<!--
    // Copyright 1998, InsideDHTML.com, LLC. All rights reserved
    // This script can be reproduced as long as the above copyright
    // notice is maintained.

    function doSelectChange(el,dest) {
      dest.value = el.options[el.selectedIndex].text
    }

    function lookupItem(el,dest) {
      if (!isDHTML) {
        el.blur(); el.focus()
      }
      var curValue = el.value.toLowerCase()
      var found = false
      var index = dest.selectedIndex
      var numOptions = dest.options.length
      var pos = 0
      while ((!found) && (pos < numOptions)) {
        found = (dest.options[pos].text.toLowerCase().indexOf(curValue)==0) 
        if (found) 
          index = pos
        pos++
      }
      if (found)
        dest.selectedIndex = index
      if (!isDHTML) 
        el._v = setTimeout("lookupItem(document.form1.textInput, document.form1.cliente)",500)
    }

    function goValue(el) {
      var where
      if (el.selectedIndex>-1) {
        where = el.options[el.selectedIndex].value
        window.open(where,"")
      }
    }

    var ie4 = (document.all)
    var ns4 = (document.layers)
    var isDHTML = ie4 || ns4
// -->

function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
{/literal}
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
                    		<td colspan="2">Trasferisci quest'imbarcazione
                    			da <strong>{$proprietario_nome}</strong> </td>
                    		</tr>
                    	<tr valign="top">
                    		<td colspan="2"><strong>A:</strong><br>
                    			Seleziona il cliente
                    			dall'elenco
                    			<p><strong><input type="text" name="textInput" size="20" onfocus="if (!isDHTML) this._v=setTimeout(&quot;lookupItem(document.form1.textInput, document.form1.cliente)&quot;,500)"  onblur="if (!isDHTML) clearTimeout(this._v)" onkeyup="lookupItem(this,document.form1.cliente)"></strong>Cerca un cliente...</p>
								<p><select name="cliente" size="5" id="cliente" onchange="doSelectChange(this, document.form1.textInput)">
								{foreach from="$elenco_clienti" key="key" item="item"}
									<option value="{$key}">{$item}</option>
                    			{/foreach}
								</select>
						    	</td>
                    		</tr>
                    	<tr>
                    		<td colspan="2">{include file="seleziona_data.tpl" etichetta="Data
                    			del Trasferimento" nome_campo="trasferimento_data" value_campo="$data"}</td>
                    		</tr>
                    	<tr>
                    		<td width="23%"><input name="Trasferisci" type="submit" id="Trasferisci" value="Trasferisci">
                    			<input name="cliente_id" type="hidden" id="cliente_id" value="{$cliente_id}"></td>
                    		<td width="77%">&nbsp;</td>
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
                			dell'imbarcazione {$barca_nome} ({$barca_lunghezza} mt.)</td>
                		</tr>
                	<tr>
                		<td height="20" class="tdUndertopColonne"><strong>Trasferimento
                				da </strong></td>
                		<td class="tdUndertopColonne"><strong>A</strong></td>
                		<td class="tdUndertopColonne"><strong>Data
                				del Trasferimento </strong></td>
                		</tr>
					<!-- inizio riga -->
					{foreach from=$elenco_trasferimenti item="item"}
                	<tr>
                		<td class="tdContenutoVisualizzazione">{$elenco_clienti[$item.barca_trasferimento_da]}</td>
                		<td class="tdContenutoVisualizzazione">{$elenco_clienti[$item.barca_trasferimento_a]}</td>
                		<td class="tdContenutoVisualizzazione">{$item.barca_trasferimento_data}</td>
                		</tr>
					{/foreach}
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