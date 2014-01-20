{include file="header.tpl"}
{literal}
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
{/literal}
<body onLoad="MM_preloadImages('icone/btn_visualizza_hover.gif','img/btn_genera_lettere_avviso_hover.gif')">
<!-- INIZIO RIGA CENTRALE DELLA TABELLA DEI CONTENUTI DOVE SI TROVANO I CONTENUTI -->
<tr>
	<td class="schedaOmbraLeft">&nbsp;</td>
	<td>
		<table width="100%" border="0">
			<tr>
				<td class="topRigaGrigia"><img src="img/top_scadenze_affitto.gif"></td>
			</tr>
			<tr>
				<td><table width="100%"  border="0" align="center" cellspacing="2">
                	<tr>
                		<td height="20" class="tdTopColonne">Posto Barca </td>
                		<td class="tdTopColonne">Barca</td>
                		<td class="tdTopColonne">Cliente</td>
                		<td class="tdTopColonne">Scade il </td>
                		<td class="tdTopColonne">&nbsp;</td>
                		</tr>
                	{foreach from=$contratti item=item}
                	<tr>
                		<td class="tdContenutoVisualizzazione" ><p><a href="posto_barca_dettagli.php?id={$item.posto_barca_id}"><strong>{$item.pontile_codice}{$item.posto_barca_numero}</strong></a></p>
                			</td>
                		<td class="tdContenutoVisualizzazione" ><a href="#">{$item.barca_nome}</a></td>
                		<td class="tdContenutoVisualizzazione" ><a href="cliente_visualizza.php?id={$item.cliente_id}">{$item.cliente_nominativo}</a></td>
                		<td class="tdContenutoVisualizzazione" >{$item.contratto_fine|date_format:'%d-%m-%Y'}</td>
                		<td align="center" class="tdContenutoVisualizzazione" ><a href="riepilogo.php?id={$item.contratto_id}" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Visualizza{$item.contratto_id}','','icone/btn_visualizza_hover.gif',1)"><img src="icone/btn_visualizza.gif" name="Visualizza{$item.contratto_id}" border="0" id="Visualizza{$item.contratto_id}" /></a></td>
                		</tr>
                	{/foreach}
					<tr align="right">
                		<td colspan="5"><a href="lettere_scadenza_contratto.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image61','','img/btn_genera_lettere_avviso_hover.gif',1)"><img src="img/btn_genera_lettere_avviso.gif" name="Image61" width="350" height="30" border="0" id="Image61" /></a></td>
                		</tr>
                	<!-- <tr>
			<td colspan="5"><a href="lettere_scadenza_contratto.php"><strong>Genera le lettere di avviso di scadenza del contratto</strong></a></td>
		</tr> -->
                	</table></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>		
		</table>
	</td>
	<td class="schedaOmbraRight">&nbsp;</td>
</tr>
<!-- FINE RIGA CENTRALE DELLA TABELLA DEI CONTENUTI DOVE SI TROVANO I CONTENUTI -->
{include file="footer.tpl"}