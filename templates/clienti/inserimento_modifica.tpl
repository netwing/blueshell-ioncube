<tr>
	<td class="schedaOmbraLeft">&nbsp;</td>
	<td><img src="img/top_clienti.gif" width="700" height="63" />
		<form name="form1" id="form1" method="post" action="cliente_inserimento.php">
		<table width="100%"  border="0" cellpadding="10" cellspacing="2">
			<tr>
				<td class="tratteggioSotto"></td>
				</tr>
			<tr>
				<td class="tratteggioSotto"><strong>Nominativo*</strong><br />
						<input name="cliente_nominativo" type="text" id="cliente_nominativo" size="30" maxlength="50" />						</td>
				</tr>
			<tr>
				<td class="tratteggioSotto"><strong>Cognome o Ragione Sociale*<br />
				</strong>
						<input name="cliente_cognome" type="text" id="cliente_cognome" size="30" maxlength="50" />
					    <strong><br />
						Nome</strong>*<br />
					<input name="cliente_nome" type="text" id="cliente_nome" size="30" maxlength="50" />					</td>
				</tr>
			<tr>
				<td class="tratteggioSotto"><strong>Indirizzo</strong><br />
						<input name="cliente_indirizzo" type="text" id="cliente_indirizzo" size="50" maxlength="250" />
						<strong><br />
						CAP</strong><br />
						<input name="cliente_cap" type="text" id="cliente_cap" size="7" maxlength="5" />
						<strong><br />
						Citt&agrave;</strong><br />
						<input name="cliente_citta" type="text" id="cliente_citta" size="30" maxlength="50" />
						<strong><br />
						Provincia</strong><br />
						<input name="cliente_provincia" type="text" id="cliente_provincia" size="3" maxlength="2" />
						<strong><br />
						Nazione<br />
					<select name="cliente_nazione" size="3" id="cliente_nazione">
					<?php
					foreach ($elenco_nazioni as $k=>$v)
					{
						$k_nazione_cliente="cliente_nazione_".$k;
					?>
						<option value="<?php echo $k; ?>" selected <?php echo $form->valori_default[$k_nazione_cliente]; ?>><?php echo $v; ?></option>
					<?php
					}
					?>
						</select>
						</strong></td>
				</tr>
			<tr>
				<td class="tratteggioSotto"><strong>Telefono 1* </strong><br />
						<input name="cliente_telefono1" type="text" id="cliente_telefono1" size="30" maxlength="50" />
						<select name="cliente_tipo_telefono1" id="cliente_tipo_telefono1">
							<option value="Abitazione" <?php echo $form->valori_default['cliente_tipo_telefono1_Abitazione']; ?>>Abitazione</option>
							<option value="Cellulare" <?php echo $form->valori_default['cliente_tipo_telefono1_Cellulare']; ?>>Cellulare</option>
							<option value="Ufficio" <?php echo $form->valori_default['cliente_tipo_telefono1_Ufficio']; ?>>Ufficio</option>
							<option value="Fax" <?php echo $form->valori_default['cliente_tipo_telefono1_Fax']; ?>>Fax</option>
						</select>
					    <strong><br />
						Telefono 2 </strong><br />
						<input name="cliente_telefono2" type="text" id="cliente_telefono2" size="30" maxlength="50" />
						<select name="cliente_tipo_telefono2" id="cliente_tipo_telefono2">
							<option value="Abitazione" <?php echo $form->valori_default['cliente_tipo_telefono2_Abitazione']; ?>>Abitazione</option>
							<option value="Cellulare" <?php echo $form->valori_default['cliente_tipo_telefono2_Cellulare']; ?>>Cellulare</option>
							<option value="Ufficio" <?php echo $form->valori_default['cliente_tipo_telefono2_Ufficio']; ?>>Ufficio</option>
							<option value="Fax" <?php echo $form->valori_default['cliente_tipo_telefono2_Fax']; ?>>Fax</option>
						</select>
					    <strong><br />
						Telefono 3</strong><br />
						<input name="cliente_telefono3" type="text" id="cliente_telefono3" size="30" maxlength="50" />
						<select name="cliente_tipo_telefono3" id="cliente_tipo_telefono3">
							<option value="Abitazione" <?php echo $form->valori_default['cliente_tipo_telefono3_Abitazione']; ?>>Abitazione</option>
							<option value="Cellulare" <?php echo $form->valori_default['cliente_tipo_telefono3_Cellulare']; ?>>Cellulare</option>
							<option value="Ufficio" <?php echo $form->valori_default['cliente_tipo_telefono3_Ufficio']; ?>>Ufficio</option>
							<option value="Fax" <?php echo $form->valori_default['cliente_tipo_telefono3_Fax']; ?>>Fax</option>
						</select>
					<strong><br />
					Indirizzo di Posta Elettronica </strong><br />
					<input name="cliente_email" type="text" id="cliente_email" size="30" maxlength="50" />					</td>
				</tr>
			<tr>
				<td class="tratteggioSotto"><strong>Codice Fiscale </strong><br />
						<input name="cliente_codice_fiscale" type="text" id="cliente_codice_fiscale" size="20" maxlength="20" />
						<strong><br />
						Partita IVA</strong><br />
						<input name="cliente_partita_iva" type="text" id="cliente_partita_iva" size="20" maxlength="20" />
						<strong><br />
						Documento</strong><br />
						<select name="cliente_documento">
							<option value="CdI" <?php echo $form->valori_default['cliente_documento_CdI']; ?>>CdI</option>
							<option value="Patente" <?php echo $form->valori_default['cliente_documento_Patente']; ?>>Patente</option>
							<option value="Patente Nautica" <?php echo $form->valori_default['cliente_documento_Patente Nautica']; ?>>Patente Nautica</option>
							<option value="Passaporto" <?php echo $form->valori_default['cliente_documento_Passaporto']; ?>>Passaporto</option>
						</select>        				    <strong><br />
							Numero del Documento</strong><br />
						<input name="cliente_numero_documento" type="text" id="cliente_numero_documento" size="20" maxlength="20" />						</td>
				</tr>
			<tr>
				<td class="tratteggioSotto"><strong>Note<br />
					<textarea name="cliente_note" cols="40" rows="5" id="cliente_note"></textarea>
				</strong></td>
				</tr>
			<tr>
				<td class="tratteggioSotto">
				<?php
				if (array_key_exists("return",$_GET) and $_GET['return']=="nuovo_contratto1")
				{
				?>
				<input name="procedere" type="hidden" value="nuovo_contratto1" />
				<?php
				}
				else
				{
				?>
				<p><strong>Dopo l'inserimento del cliente:</strong></p>
						<p>
							<input name="procedere" type="radio" value="barca" checked="checked" />
				Procedi inserendo una barca </p>
						<p>
							<input name="procedere" type="radio" value="concludi" />
				Concludi la procedura </p>
				<?php
				}
				?>
				</td>
				</tr>
			<tr>
				<td align="right"><input name="Inserisci" type="submit" class="stileBottone" id="Inserisci" value="Inserisci cliente" /></td>
				</tr>
			</table>
	</form></td>
	<td class="schedaOmbraRight">&nbsp;</td>
</tr>