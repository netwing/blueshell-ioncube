SET foreign_key_checks = 0;
TRUNCATE TABLE `blue_clienti`;
TRUNCATE TABLE `blue_barche`;
SET foreign_key_checks = 0;

INSERT INTO `blueshell_demo`.`blue_clienti` (`cliente_id`, `cliente_nominativo`, `cliente_tipo`, `cliente_nome`, `cliente_cognome`, `cliente_data_nascita`, `cliente_luogo_nascita`, `cliente_indirizzo`, `cliente_citta`, `cliente_cap`, `cliente_provincia`, `cliente_nazione`, `cliente_telefono1`, `cliente_tipo_telefono1`, `cliente_telefono2`, `cliente_tipo_telefono2`, `cliente_telefono3`, `cliente_tipo_telefono3`, `cliente_email`, `cliente_codice_fiscale`, `cliente_partita_iva`, `cliente_documento`, `cliente_numero_documento`, `cliente_rifiuta_comunicazioni`, `cliente_note`, `country`, `create_time`, `update_time`) VALUES (NULL, 'Porto di Ferrara', 'Persona Giuridica', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '1', NULL, 'Abitazione', NULL, 'Cellulare', NULL, 'Ufficio', NULL, NULL, NULL, 'CdI', NULL, '0', NULL, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

INSERT INTO `blue_clienti` (
  `cliente_nominativo` ,
  `cliente_tipo` ,
  `cliente_nome` ,
  `cliente_cognome` ,
  `cliente_data_nascita` ,
  `cliente_luogo_nascita` ,
  `cliente_indirizzo` ,
  `cliente_citta` ,
  `cliente_cap` ,
  `cliente_provincia` ,
  `cliente_nazione` ,
  `cliente_telefono1` ,
  `cliente_telefono2` ,
  `cliente_email` ,
  `cliente_codice_fiscale` ,
  `cliente_partita_iva` ,
  `cliente_documento` ,
  `cliente_numero_documento` ,
  `cliente_rifiuta_comunicazioni` ,
  `cliente_note` ,
  `country` ,
  `create_time`
)
SELECT 
  CONCAT(last_name, " ", first_name), 
  "Persona Fisica", 
  first_name, 
  last_name, 
  birth_date, 
  birth_place,
  address,
  city,
  zip,
  province,
  'it',
  contact1,
  contact2,
  email,
  fiscal_code,
  vat,
  '',
  '',
  0,
  '',
  'it',
  NOW() 
  FROM `fake_customer`;

INSERT INTO `blue_barche` (
  `barca_nome` ,
  `barca_tipologia_barca` ,
  `barca_modello` ,
  `barca_anno` ,
  `barca_lunghezza` ,
  `barca_larghezza` ,
  `barca_motore` ,
  `barca_targa` ,
  `barca_polizza` ,
  `barca_scadenza_polizza` ,
  `barca_proprietario` ,
  `builder` ,
  `insurance_company` ,
  `country` ,
  `create_time`
)
SELECT 
`name`,
`type`,
`model`,
'2001',
`length`,
`width`,
`engine`,
`plate`,
`insurance_id`,
`insurance_expire`,
`owner`,
`builder`,
`insurance_company`,
'it',
NOW() FROM `fake_vector`
