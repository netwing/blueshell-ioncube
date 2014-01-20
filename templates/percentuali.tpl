{include file="header.tpl"}
<!-- INIZIO RIGA CENTRALE DELLA TABELLA DEI CONTENUTI DOVE SI TROVANO I CONTENUTI -->
<tr>
	<td class="schedaOmbraLeft">&nbsp;</td>
	<td>
		<form action="percentuali.php" method="post" name="form1">
		<table width="100%" border="0">
			<tr>
				<td colspan="2" class="topRigaGrigia"><img src="img/statistiche.gif"></td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td width="26%"><img src="img/titolo_anno_in_corso.jpg"></td>
				<td width="74%">{html_select_date field_order='DMY' field_array='dal1' start_year='2003' end_year='+1' time=$dal1} -- 
				{html_select_date field_order='DMY' field_array='al1' start_year='2003' end_year='+1' time=$al1}</td>
			</tr>
			<tr>
				<td><img src="img/titolo_anno_precedente.jpg"></td>
				<td>{html_select_date field_order='DMY' field_array='dal2' start_year='2003' end_year='+1' time=$dal2} -- 
				{html_select_date field_order='DMY' field_array='al2' start_year='2003' end_year='+1' time=$al2}</td>
			</tr>
			<tr>
			  <td colspan="2" align="right" bgcolor="#99CCFF"><input type="submit" name="Submit" value="Visualizza" /></td>
			</tr>
			<tr>
				<td colspan="2"><p>{if $visualizza}Periodo dal <b>{$dal1|date_format:'%d-%m-%Y'}</b> al <b>{$al1|date_format:'%d-%m-%Y'}</b><br />
					<br />
							TOTALE CONTRATTI: <b>{$anno1.totale_contratti}</b> <br />
							Totale Vendite: <b>{$anno1.totale_vendite} ({$anno1.totale_vendite_percentuale}%)</b>, Gestioni: <b>{$anno1.totale_gestioni} ({$anno1.totale_gestioni_percentuale}% delle vendite)</b><br />
						Totale Affitti: <b>{$anno1.totale_affitti} ({$anno1.totale_affitti_percentuale}%)</b>, di cui:</p>
						<p>Affitto annuale: <b>{$anno1.affitto_annuale} ({$anno1.affitto_annuale_percentuale}%)</b><br />
						Affitto stagionale: <b>{$anno1.affitto_stagionale} ({$anno1.affitto_stagionale_percentuale}%)</b><br />
						Affitto mensile: <b>{$anno1.affitto_mensile} ({$anno1.affitto_mensile_percentuale}%)</b><br />
						Affitto giornaliero: <b>{$anno1.affitto_giornaliero} ({$anno1.affitto_giornaliero_percentuale}%)</b><br />
						Affitto settimanale: <b>{$anno1.affitto_settimanale} ({$anno1.affitto_settimanale_percentuale}%)</b><br />
						Transito: <b>{$anno1.totale_transiti} ({$anno1.totale_transiti_percentuale}%)</b></p>
						<p>Periodo dal <b>{$dal2|date_format:'%d-%m-%Y'}</b> al <b>{$al2|date_format:'%d-%m-%Y'}</b> </p>
						<p>							TOTALE CONTRATTI: <b>{$anno2.totale_contratti}</b> <br />
Totale Vendite: <b>{$anno2.totale_vendite} ({$anno2.totale_vendite_percentuale}%)</b>, Gestioni: <b>{$anno2.totale_gestioni} ({$anno2.totale_gestioni_percentuale}% delle vendite)</b><br />
Totale Affitti: <b>{$anno2.totale_affitti} ({$anno2.totale_affitti_percentuale}%)</b>, di cui:</p>
<p>Affitto annuale: <b>{$anno2.affitto_annuale} ({$anno2.affitto_annuale_percentuale}%)</b><br />
							Affitto stagionale: <strong>{$anno2.affitto_stagionale} ({$anno2.affitto_stagionale_percentuale}%)</strong><br />
							Affitto mensile: <strong>{$anno2.affitto_mensile} {$anno2.affitto_mensile_percentuale}%)</strong><br />
							Affitto giornaliero: <strong>{$anno2.affitto_giornaliero} ({$anno2.affitto_giornaliero_percentuale}%)</strong><br />
							Affitto settimanale: <strong>{$anno2.affitto_settimanale} ({$anno2.affitto_settimanale_percentuale}%)</strong><br />
				Transito: <strong>{$anno2.totale_transiti} ({$anno2.totale_transiti_percentuale}%)</strong></p>
						<p>Differenza tra il primo ed il secondo periodo: <br />
							Affitti: <strong>{$differenze_affitti}%</strong><br />
							Vendite: <strong>{$differenze_vendite}%</strong><br />
				  </p>
						{foreach from=$rinnovati item=i}{$i}<br />
						{/foreach}
						<p>Prenotazioni nel periodo <strong>{$dal1|date_format:'%d-%m-%Y'}</strong> al <strong>{$al1|date_format:'%d-%m-%Y'}: {$prenotazioni.totale}</strong><br />
						Prenotazioni che NON sono diventate contratti: <strong>{$prenotazioni.fallite} ({$prenotazioni.fallite_percentuale}%)</strong><br />
						Prenotazioni che sono diventate contratti: <strong>{$prenotazioni.riuscite} ({$prenotazioni.riuscite_percentuale}%)</strong><br />
						Prenotazioni con inizio oltre il <strong>{$al1|date_format:'%d-%m-%Y'}: {$prenotazioni.future}</strong><br />
						<br />
						Opzioni stipulate nel <strong>{$smarty.post.al1.Date_Year}: {$opzioni2006}</strong><br />
						<br />
						Nel periodo del <strong>{$smarty.post.al2.Date_Year}</strong> abbiamo <strong>{$infoclienti.clienti2005}</strong> clienti totali, di cui <strong>{$infoclienti.rinnovato2005} ({$infoclienti.rinnovato2005_percentuale}%)</strong> sono clienti che hanno rinnovato, mentre <strong>{$infoclienti.acquisito2005} ({$infoclienti.acquisito2005_percentuale}%)</strong> sono nuovi clienti acquisiti.<br />
				  Nel periodo del <strong>{$smarty.post.al1.Date_Year}</strong> abbiamo 330 clienti totali, di cui 160 (48,48%) sono clienti che hanno rinnovato, mentre 170 (51,52%) sono nuovi clienti acquisiti.</p>
					<p>L'aumento di clienti nel <strong>{$smarty.post.al1.Date_Year} rispetto al {$smarty.post.al2.Date_Year}</strong> e' stato del <strong>{$infoclienti.aumento}%</strong><br />
						La percentuale di clienti che hanno rinnovato nel <strong>{$smarty.post.al1.Date_Year}</strong> rispetto al <strong>{$smarty.post.al2.Date_Year}</strong> e' del <strong>{$infoclienti.rinnovo}%</strong><br />
						La percentuale di clienti acquisiti nel <strong>{$smarty.post.al1.Date_Year}</strong> rispetto al <strong>{$smarty.post.al2.Date_Year}</strong> e' del <strong>{$infoclienti.acquisizione}%</strong><br />
				  La percentuale di clienti che NON hanno rinnovato nel <strong>{$smarty.post.al1.Date_Year}</strong> rispetto al <strong>{$smarty.post.al2.Date_Year}</strong> e' del <strong>{$infoclienti.persi}%</strong></p>
					<p>Includendo i Transiti <br />
						Totale giorni-contratto <strong>{$smarty.post.al1.Date_Year}: {$infofinali.con.totale1} </strong><br />
						Media giorni-contratto <strong>{$smarty.post.al1.Date_Year}: {$infofinali.con.media1} </strong><br />
					Totale giorni-contratto <strong>{$smarty.post.al2.Date_Year}: {$infofinali.con.totale2} </strong><br />
Media giorni-contratto <strong>{$smarty.post.al2.Date_Year}: {$infofinali.con.media2} </strong></p>
					<p>Escludendo i Transiti <br />
						Totale giorni-contratto <strong>{$smarty.post.al1.Date_Year}: {$infofinali.senza.totale1} </strong><br />
						Media giorni-contratto <strong>{$smarty.post.al1.Date_Year}: {$infofinali.senza.media1} </strong><br />
						Totale giorni-contratto <strong>{$smarty.post.al2.Date_Year}: {$infofinali.senza.totale2}</strong> <br />
					Media giorni-contratto <strong>{$smarty.post.al2.Date_Year}: {$infofinali.senza.media2}</strong> {/if} </p></td>
			</tr>
<!--			<tr>
				<td colspan="2"><p>Periodo dal 2006-01-01 al 2006-04-26</p>
					<p>ANNO 2006:<br />
						TOTALE CONTRATTI: 787<br />
						Totale Vendite: 229 (29,1%), Gestioni: 137 (59,83% delle vendite)<br />
						Totale Affitti: 558 (70,9%), di cui:</p>
					<p>Affitto annuale: 435 (77,96%)<br />
						Affitto stagionale: 24 (4,3%)<br />
						Affitto mensile: 55 (9,86%)<br />
						Affitto giornaliero: 3 (0,54%)<br />
						Affitto settimanale: 12 (2,15%)<br />
						Transito: 29 (5,2%)</p>
					<p>&nbsp;</p>
					<p>ANNO 2005:<br />
						TOTALE CONTRATTI: 660<br />
						Totale Vendite: 204 (30,91%), Gestioni: 115 (56,37% delle vendite)<br />
						Totale Affitti: 456 (69,09%), di cui:</p>
					<p>Affitto annuale: 377 (82,68%)<br />
						Affitto stagionale: 18 (3,95%)<br />
						Affitto mensile: 33 (7,24%)<br />
						Affitto giornaliero: 3 (0,66%)<br />
						Affitto settimanale: 8 (1,75%)<br />
						Affitto pluriennale: 1 (0,22%)<br />
						Transito: 16 (3,51%)<br />
					</p>
					<p>Differenze nel 2006 rispetto al 2005:<br />
						Affitti: 22,37%<br />
						Vendite: 12,25%<br />
					</p>
					<p>Prenotazioni nel periodo 01-01-2006 al 26-04-2006: 119<br />
						Prenotazioni che NON sono diventate contratti: 20 (16,81%)<br />
						Prenotazioni che sono diventate contratti: 99 (83,19%)<br />
						Prenotazioni con inizio oltre il 26-04-2006: 65<br />
						Opzioni stipulate nel 2006: 46<br />
						Nel periodo del 2005 abbiamo 258 clienti totali, di cui 130 (50,39%) sono clienti che hanno rinnovato, mentre 128 (49,61%) sono nuovi clienti acquisiti.<br />
						Nel periodo del 2006 abbiamo 330 clienti totali, di cui 160 (48,48%) sono clienti che hanno rinnovato, mentre 170 (51,52%) sono nuovi clienti acquisiti.</p>
					<p>L'aumento di clienti nel 2006 rispetto al 2005 e' stato del 27,91%<br />
						La percentuale di clienti che hanno rinnovato nel 2006 (160) rispetto al 2005 (130) e' del 23,08%<br />
						La percentuale di clienti acquisiti nel 2006 (170) rispetto al 2005 (128) e' del 32,81%<br />
						La percentuale di clienti che NON hanno rinnovato nel 2006 (98) rispetto al 2005 (80) e' del 22,5%</p>
					<p>Totale giorni-contratto 2005: 135072<br />
					Media giorni-contratto 2005: 134,13</p></td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="2"><p>&nbsp;
					</p>					</td>
			</tr>-->		
		</table>
		</form>
	</td>
	<td class="schedaOmbraRight">&nbsp;</td>
</tr>
<!-- FINE RIGA CENTRALE DELLA TABELLA DEI CONTENUTI DOVE SI TROVANO I CONTENUTI -->
{include file="footer.tpl"}