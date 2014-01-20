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
		<form action="cliente_elimina.php" method="post" name="form1">
		<table width="100%" border="0">
			<tr>
				<td class="topRigaGrigia"><img src="img/top_imbarcazioni.gif"></td>
			</tr>
			<tr>
				<td><strong>{$messaggio}</strong></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			{if $elimina=="true"}
			<tr>
				<td><input name="Elimina" type="submit" id="Elimina" value="Elimina il Cliente">
					<input name="cliente_id" type="hidden" id="cliente_id" value="{$get_id}"></td>
			</tr>
			{/if}
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td><a href="clienti.php">Torna Indietro</a> </td>
			</tr>		
		</table>
		</form>
	</td>
	<td class="schedaOmbraRight">&nbsp;</td>
</tr>
<!-- FINE RIGA CENTRALE DELLA TABELLA DEI CONTENUTI DOVE SI TROVANO I CONTENUTI -->
{include file="footer.tpl"}