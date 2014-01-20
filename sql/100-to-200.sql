ALTER TABLE  `blue_barche` ADD INDEX (`barca_nome`);
ALTER TABLE  `blue_barche` ADD INDEX (`barca_proprietario`);
ALTER TABLE  `blue_barche` ADD INDEX (`barca_nazione`);

ALTER TABLE  `blue_clienti` ADD INDEX (`cliente_nominativo`);
ALTER TABLE  `blue_clienti` ADD INDEX (`cliente_nome`);
ALTER TABLE  `blue_clienti` ADD INDEX (`cliente_cognome`);

ALTER TABLE  `blue_contratti` ADD INDEX (`contratto_anagrafica1`);
ALTER TABLE  `blue_contratti` ADD INDEX (`contratto_tipo`);
ALTER TABLE  `blue_contratti` ADD INDEX (`contratto_barca`);
ALTER TABLE  `blue_contratti` ADD INDEX (`contratto_posto_barca`);
ALTER TABLE  `blue_contratti` ADD INDEX (`contratto_periodo`);
ALTER TABLE  `blue_contratti` ADD INDEX (`contratto_fine`);

ALTER TABLE  `blue_fatture` ADD INDEX (`fattura_cliente_id`);
ALTER TABLE  `blue_fatture` ADD INDEX (`fattura_numero`);
ALTER TABLE  `blue_fatture` ADD INDEX (`fattura_data`);
ALTER TABLE  `blue_fatture` ADD INDEX (`fattura_contratto_id`);

ALTER TABLE  `blue_fatture_righe` ADD INDEX (`fattura_riga_fattura_id`);
ALTER TABLE  `blue_fatture_righe` ADD INDEX (`fattura_riga_descrizione`);

ALTER TABLE  `blue_prima_nota` ADD INDEX (`prima_nota_data`);
ALTER TABLE  `blue_prima_nota` ADD INDEX (`prima_nota_fattura_id`);
ALTER TABLE  `blue_prima_nota` ADD INDEX (`prima_nota_categoria`);
ALTER TABLE  `blue_prima_nota` ADD INDEX (`prima_nota_mezzo_scambio`);

ALTER TABLE  `blue_posti_barca` ADD INDEX (`posto_barca_pontile`);
ALTER TABLE  `blue_posti_barca` ADD INDEX (`posto_barca_proprietario`);
ALTER TABLE  `blue_posti_barca` ADD INDEX (`posto_barca_gestore`);

ALTER TABLE  `blue_posti_barca_status` ADD INDEX (`posto_barca`);
ALTER TABLE  `blue_posti_barca_status` ADD INDEX (`cliente`);
ALTER TABLE  `blue_posti_barca_status` ADD INDEX (`barca`);
ALTER TABLE  `blue_posti_barca_status` ADD INDEX (`inizio`);
ALTER TABLE  `blue_posti_barca_status` ADD INDEX (`fine`);
ALTER TABLE  `blue_posti_barca_status` ADD INDEX (`status`);
ALTER TABLE  `blue_posti_barca_status` ADD INDEX (`presenza`);

ALTER TABLE  `blue_posti_barca_status` ADD `posto_barca_id` INT(11) UNSIGNED NOT NULL;
ALTER TABLE  `blue_posti_barca_status` ADD INDEX (`posto_barca_id`);