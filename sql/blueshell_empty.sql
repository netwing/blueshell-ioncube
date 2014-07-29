-- phpMyAdmin SQL Dump
-- version 4.0.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generato il: Giu 18, 2014 alle 13:07
-- Versione del server: 5.5.31-0+wheezy1
-- Versione PHP: 5.4.29-1~dotdeb.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `blueshell_empty`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_access_authorization`
--

CREATE TABLE IF NOT EXISTS `blue_access_authorization` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `resource_id` int(11) unsigned DEFAULT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `identity` text NOT NULL,
  `notes` text,
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `fk_access_authorization_resource_id_blue_resource_id` (`resource_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_access_authorization_log`
--

CREATE TABLE IF NOT EXISTS `blue_access_authorization_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `identity` text NOT NULL,
  `user_agent` text NOT NULL,
  `outcome` int(11) unsigned NOT NULL DEFAULT '0',
  `access_authorization_id` int(11) unsigned DEFAULT NULL,
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `fk_access_authorization_id_blue_access_authorization_id` (`access_authorization_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_assicurazioni`
--

CREATE TABLE IF NOT EXISTS `blue_assicurazioni` (
  `assicurazione_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `assicurazione_nome` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`assicurazione_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_attachment`
--

CREATE TABLE IF NOT EXISTS `blue_attachment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `model` varchar(255) NOT NULL,
  `model_id` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `position` varchar(255) NOT NULL DEFAULT '',
  `filename` varchar(255) NOT NULL DEFAULT '',
  `type` varchar(255) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `idx_attachment_model` (`model`),
  KEY `idx_attachment_model_id` (`model_id`),
  KEY `idx_attachment_title` (`title`),
  KEY `idx_attachment_filename` (`filename`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_audit_trail`
--

CREATE TABLE IF NOT EXISTS `blue_audit_trail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `old_value` text,
  `new_value` text,
  `action` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `field` varchar(255) DEFAULT NULL,
  `stamp` datetime NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `model_id` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_audit_trail_user_id` (`user_id`),
  KEY `idx_audit_trail_model_id` (`model_id`),
  KEY `idx_audit_trail_model` (`model`),
  KEY `idx_audit_trail_field` (`field`),
  KEY `idx_audit_trail_action` (`action`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_auth_assignment`
--

CREATE TABLE IF NOT EXISTS `blue_auth_assignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `blue_auth_assignment`
--

INSERT INTO `blue_auth_assignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES
('ADMIN', '0', NULL, 'N;'),
('ADMIN', '1', NULL, 'N;'),
('admin:contract', '0', NULL, 'N;'),
('admin:contract:create', '0', NULL, 'N;'),
('admin:contract:delete', '0', NULL, 'N;'),
('admin:contract:read', '0', NULL, 'N;'),
('admin:contract:update', '0', NULL, 'N;'),
('admin:customer', '0', NULL, 'N;'),
('admin:customer:create', '0', NULL, 'N;'),
('admin:customer:delete', '0', NULL, 'N;'),
('admin:customer:read', '0', NULL, 'N;'),
('admin:customer:update', '0', NULL, 'N;'),
('admin:document', '0', NULL, 'N;'),
('admin:document:create', '0', NULL, 'N;'),
('admin:document:delete', '0', NULL, 'N;'),
('admin:document:read', '0', NULL, 'N;'),
('admin:document:update', '0', NULL, 'N;'),
('admin:invoice', '0', NULL, 'N;'),
('admin:invoice:create', '0', NULL, 'N;'),
('admin:invoice:delete', '0', NULL, 'N;'),
('admin:invoice:read', '0', NULL, 'N;'),
('admin:invoice:update', '0', NULL, 'N;'),
('admin:main', '0', NULL, 'N;'),
('admin:main:read', '0', NULL, 'N;'),
('admin:order', '0', NULL, 'N;'),
('admin:order:create', '0', NULL, 'N;'),
('admin:order:delete', '0', NULL, 'N;'),
('admin:order:read', '0', NULL, 'N;'),
('admin:order:update', '0', NULL, 'N;'),
('admin:preference', '0', NULL, 'N;'),
('admin:preference:create', '0', NULL, 'N;'),
('admin:preference:delete', '0', NULL, 'N;'),
('admin:preference:read', '0', NULL, 'N;'),
('admin:preference:update', '0', NULL, 'N;'),
('admin:pricelist', '0', NULL, 'N;'),
('admin:pricelist:create', '0', NULL, 'N;'),
('admin:pricelist:delete', '0', NULL, 'N;'),
('admin:pricelist:read', '0', NULL, 'N;'),
('admin:pricelist:update', '0', NULL, 'N;'),
('admin:resource', '0', NULL, 'N;'),
('admin:resource:create', '0', NULL, 'N;'),
('admin:resource:delete', '0', NULL, 'N;'),
('admin:resource:read', '0', NULL, 'N;'),
('admin:resource:update', '0', NULL, 'N;'),
('admin:systemTemplate', '0', NULL, 'N;'),
('admin:systemTemplate:create', '0', NULL, 'N;'),
('admin:systemTemplate:delete', '0', NULL, 'N;'),
('admin:systemTemplate:read', '0', NULL, 'N;'),
('admin:systemTemplate:update', '0', NULL, 'N;'),
('admin:template', '0', NULL, 'N;'),
('admin:template:create', '0', NULL, 'N;'),
('admin:template:delete', '0', NULL, 'N;'),
('admin:template:read', '0', NULL, 'N;'),
('admin:template:update', '0', NULL, 'N;'),
('admin:user', '0', NULL, 'N;'),
('admin:user:create', '0', NULL, 'N;'),
('admin:user:delete', '0', NULL, 'N;'),
('admin:user:read', '0', NULL, 'N;'),
('admin:user:update', '0', NULL, 'N;'),
('admin:vector', '0', NULL, 'N;'),
('admin:vector:create', '0', NULL, 'N;'),
('admin:vector:delete', '0', NULL, 'N;'),
('admin:vector:read', '0', NULL, 'N;'),
('admin:vector:update', '0', NULL, 'N;'),
('main:search', '0', NULL, 'N;'),
('main:search:allow', '0', NULL, 'N;'),
('USER', '0', NULL, 'N;');

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_auth_item`
--

CREATE TABLE IF NOT EXISTS `blue_auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `blue_auth_item`
--

INSERT INTO `blue_auth_item` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
('ADMIN', 2, 'Main administrator', NULL, 'N;'),
('admin:contract', 1, 'Contracts', NULL, 'N;'),
('admin:contract:create', 0, 'Create', NULL, 'N;'),
('admin:contract:delete', 0, 'Delete', NULL, 'N;'),
('admin:contract:read', 0, 'Read', NULL, 'N;'),
('admin:contract:update', 0, 'Update', NULL, 'N;'),
('admin:customer', 1, 'Customers', NULL, 'N;'),
('admin:customer:create', 0, 'Create', NULL, 'N;'),
('admin:customer:delete', 0, 'Delete', NULL, 'N;'),
('admin:customer:read', 0, 'Read', NULL, 'N;'),
('admin:customer:update', 0, 'Update', NULL, 'N;'),
('admin:document', 1, 'Documents', NULL, 'N;'),
('admin:document:create', 0, 'Create', NULL, 'N;'),
('admin:document:delete', 0, 'Delete', NULL, 'N;'),
('admin:document:read', 0, 'Read', NULL, 'N;'),
('admin:document:update', 0, 'Update', NULL, 'N;'),
('admin:invoice', 1, 'Invoices', NULL, 'N;'),
('admin:invoice:create', 0, 'Create', NULL, 'N;'),
('admin:invoice:delete', 0, 'Delete', NULL, 'N;'),
('admin:invoice:read', 0, 'Read', NULL, 'N;'),
('admin:invoice:update', 0, 'Update', NULL, 'N;'),
('admin:main', 1, 'Main access', NULL, 'N;'),
('admin:main:read', 0, 'Allow', NULL, 'N;'),
('admin:order', 1, 'Ordini', NULL, 'N;'),
('admin:order:create', 0, 'Create', NULL, 'N;'),
('admin:order:delete', 0, 'Delete', NULL, 'N;'),
('admin:order:read', 0, 'Read', NULL, 'N;'),
('admin:order:update', 0, 'Update', NULL, 'N;'),
('admin:portmap', 1, 'Port map', NULL, 'N;'),
('admin:portmap:create', 0, 'Create', NULL, 'N;'),
('admin:portmap:delete', 0, 'Delete', NULL, 'N;'),
('admin:portmap:read', 0, 'Read', NULL, 'N;'),
('admin:portmap:update', 0, 'Update', NULL, 'N;'),
('admin:preference', 1, 'Preferences', NULL, 'N;'),
('admin:preference:create', 0, 'Create', NULL, 'N;'),
('admin:preference:delete', 0, 'Delete', NULL, 'N;'),
('admin:preference:read', 0, 'Read', NULL, 'N;'),
('admin:preference:update', 0, 'Update', NULL, 'N;'),
('admin:pricelist', 1, 'Prices lists', NULL, 'N;'),
('admin:pricelist:create', 0, 'Create', NULL, 'N;'),
('admin:pricelist:delete', 0, 'Delete', NULL, 'N;'),
('admin:pricelist:read', 0, 'Read', NULL, 'N;'),
('admin:pricelist:update', 0, 'Update', NULL, 'N;'),
('admin:resource', 1, 'Resources', NULL, 'N;'),
('admin:resource:create', 0, 'Create', NULL, 'N;'),
('admin:resource:delete', 0, 'Delete', NULL, 'N;'),
('admin:resource:read', 0, 'Read', NULL, 'N;'),
('admin:resource:update', 0, 'Update', NULL, 'N;'),
('admin:systemTemplate', 1, 'System templates', NULL, 'N;'),
('admin:systemTemplate:create', 0, 'Create', NULL, 'N;'),
('admin:systemTemplate:delete', 0, 'Delete', NULL, 'N;'),
('admin:systemTemplate:read', 0, 'Read', NULL, 'N;'),
('admin:systemTemplate:update', 0, 'Update', NULL, 'N;'),
('admin:template', 1, 'Print templates', NULL, 'N;'),
('admin:template:create', 0, 'Create', NULL, 'N;'),
('admin:template:delete', 0, 'Delete', NULL, 'N;'),
('admin:template:read', 0, 'Read', NULL, 'N;'),
('admin:template:update', 0, 'Update', NULL, 'N;'),
('admin:user', 1, 'Users administration', NULL, 'N;'),
('admin:user:create', 0, 'Create', NULL, 'N;'),
('admin:user:delete', 0, 'Delete', NULL, 'N;'),
('admin:user:read', 0, 'Read', NULL, 'N;'),
('admin:user:update', 0, 'Update', NULL, 'N;'),
('admin:vector', 1, 'Vectors', NULL, 'N;'),
('admin:vector:create', 0, 'Create', NULL, 'N;'),
('admin:vector:delete', 0, 'Delete', NULL, 'N;'),
('admin:vector:read', 0, 'Read', NULL, 'N;'),
('admin:vector:update', 0, 'Update', NULL, 'N;'),
('main:search', 1, 'Main search', NULL, 'N;'),
('main:search:allow', 0, 'Allow', NULL, 'N;'),
('USER', 2, 'Default user', NULL, 'N;');

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_auth_item_child`
--

CREATE TABLE IF NOT EXISTS `blue_auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `fk_child_blue_auth_item_name` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `blue_auth_item_child`
--

INSERT INTO `blue_auth_item_child` (`parent`, `child`) VALUES
('ADMIN', 'admin:contract:create'),
('admin:contract', 'admin:contract:create'),
('ADMIN', 'admin:contract:delete'),
('admin:contract', 'admin:contract:delete'),
('ADMIN', 'admin:contract:read'),
('admin:contract', 'admin:contract:read'),
('ADMIN', 'admin:contract:update'),
('admin:contract', 'admin:contract:update'),
('ADMIN', 'admin:customer:create'),
('admin:customer', 'admin:customer:create'),
('ADMIN', 'admin:customer:delete'),
('admin:customer', 'admin:customer:delete'),
('ADMIN', 'admin:customer:read'),
('admin:customer', 'admin:customer:read'),
('ADMIN', 'admin:customer:update'),
('admin:customer', 'admin:customer:update'),
('ADMIN', 'admin:document:create'),
('admin:document', 'admin:document:create'),
('ADMIN', 'admin:document:delete'),
('admin:document', 'admin:document:delete'),
('ADMIN', 'admin:document:read'),
('admin:document', 'admin:document:read'),
('ADMIN', 'admin:document:update'),
('admin:document', 'admin:document:update'),
('ADMIN', 'admin:invoice:create'),
('admin:invoice', 'admin:invoice:create'),
('ADMIN', 'admin:invoice:delete'),
('admin:invoice', 'admin:invoice:delete'),
('ADMIN', 'admin:invoice:read'),
('admin:invoice', 'admin:invoice:read'),
('ADMIN', 'admin:invoice:update'),
('admin:invoice', 'admin:invoice:update'),
('ADMIN', 'admin:main:read'),
('admin:main', 'admin:main:read'),
('ADMIN', 'admin:order:create'),
('admin:order', 'admin:order:create'),
('ADMIN', 'admin:order:delete'),
('admin:order', 'admin:order:delete'),
('ADMIN', 'admin:order:read'),
('admin:order', 'admin:order:read'),
('ADMIN', 'admin:order:update'),
('admin:order', 'admin:order:update'),
('ADMIN', 'admin:portmap:create'),
('admin:portmap', 'admin:portmap:create'),
('ADMIN', 'admin:portmap:delete'),
('admin:portmap', 'admin:portmap:delete'),
('ADMIN', 'admin:portmap:read'),
('admin:portmap', 'admin:portmap:read'),
('ADMIN', 'admin:portmap:update'),
('admin:portmap', 'admin:portmap:update'),
('ADMIN', 'admin:preference:create'),
('admin:preference', 'admin:preference:create'),
('ADMIN', 'admin:preference:delete'),
('admin:preference', 'admin:preference:delete'),
('ADMIN', 'admin:preference:read'),
('admin:preference', 'admin:preference:read'),
('ADMIN', 'admin:preference:update'),
('admin:preference', 'admin:preference:update'),
('ADMIN', 'admin:pricelist:create'),
('admin:pricelist', 'admin:pricelist:create'),
('ADMIN', 'admin:pricelist:delete'),
('admin:pricelist', 'admin:pricelist:delete'),
('ADMIN', 'admin:pricelist:read'),
('admin:pricelist', 'admin:pricelist:read'),
('ADMIN', 'admin:pricelist:update'),
('admin:pricelist', 'admin:pricelist:update'),
('ADMIN', 'admin:resource:create'),
('admin:resource', 'admin:resource:create'),
('ADMIN', 'admin:resource:delete'),
('admin:resource', 'admin:resource:delete'),
('ADMIN', 'admin:resource:read'),
('admin:resource', 'admin:resource:read'),
('ADMIN', 'admin:resource:update'),
('admin:resource', 'admin:resource:update'),
('ADMIN', 'admin:systemTemplate:create'),
('admin:systemTemplate', 'admin:systemTemplate:create'),
('ADMIN', 'admin:systemTemplate:delete'),
('admin:systemTemplate', 'admin:systemTemplate:delete'),
('ADMIN', 'admin:systemTemplate:read'),
('admin:systemTemplate', 'admin:systemTemplate:read'),
('ADMIN', 'admin:systemTemplate:update'),
('admin:systemTemplate', 'admin:systemTemplate:update'),
('ADMIN', 'admin:template:create'),
('admin:template', 'admin:template:create'),
('ADMIN', 'admin:template:delete'),
('admin:template', 'admin:template:delete'),
('ADMIN', 'admin:template:read'),
('admin:template', 'admin:template:read'),
('ADMIN', 'admin:template:update'),
('admin:template', 'admin:template:update'),
('ADMIN', 'admin:user:create'),
('admin:user', 'admin:user:create'),
('ADMIN', 'admin:user:delete'),
('admin:user', 'admin:user:delete'),
('ADMIN', 'admin:user:read'),
('admin:user', 'admin:user:read'),
('ADMIN', 'admin:user:update'),
('admin:user', 'admin:user:update'),
('ADMIN', 'admin:vector:create'),
('admin:vector', 'admin:vector:create'),
('ADMIN', 'admin:vector:delete'),
('admin:vector', 'admin:vector:delete'),
('ADMIN', 'admin:vector:read'),
('admin:vector', 'admin:vector:read'),
('ADMIN', 'admin:vector:update'),
('admin:vector', 'admin:vector:update'),
('ADMIN', 'main:search:allow'),
('main:search', 'main:search:allow');

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_barche`
--

CREATE TABLE IF NOT EXISTS `blue_barche` (
  `barca_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `barca_nome` varchar(150) DEFAULT NULL,
  `type_id` int(11) unsigned DEFAULT NULL,
  `barca_nazione` int(11) DEFAULT '1',
  `barca_costruttore` int(5) DEFAULT '1',
  `barca_modello` varchar(100) DEFAULT NULL,
  `barca_anno` varchar(10) DEFAULT NULL,
  `barca_lunghezza` float DEFAULT '0',
  `real_length` decimal(10,2) DEFAULT NULL,
  `barca_larghezza` float DEFAULT '0',
  `real_width` decimal(10,2) DEFAULT NULL,
  `barca_pescaggio` float DEFAULT '0',
  `real_draught` decimal(10,2) DEFAULT NULL,
  `barca_motore` varchar(50) DEFAULT NULL,
  `barca_matricola_motore1` varchar(20) DEFAULT NULL,
  `barca_matricola_motore2` varchar(20) DEFAULT NULL,
  `barca_targa` varchar(20) DEFAULT NULL,
  `displacement` decimal(10,2) DEFAULT NULL,
  `barca_assicurazione` int(5) DEFAULT '1',
  `barca_polizza` varchar(20) DEFAULT NULL,
  `barca_scadenza_polizza` date DEFAULT NULL,
  `barca_caratteristiche` text,
  `predominant_material` varchar(255) DEFAULT NULL,
  `fuel` varchar(255) DEFAULT NULL,
  `barca_colore` varchar(50) DEFAULT NULL,
  `barca_proprietario` int(10) unsigned DEFAULT '0',
  `barca_note` text,
  `vat_contract` decimal(10,2) DEFAULT NULL,
  `vat_contract_description` varchar(255) DEFAULT NULL,
  `vat_service` decimal(10,2) DEFAULT NULL,
  `vat_service_description` varchar(255) DEFAULT NULL,
  `builder` varchar(255) NOT NULL DEFAULT '',
  `insurance_company` varchar(255) NOT NULL DEFAULT '',
  `insurance_maximum` decimal(20,0) DEFAULT NULL,
  `country` varchar(255) NOT NULL DEFAULT '',
  `country_blacklist` tinyint(1) NOT NULL DEFAULT '0',
  `maritime_sector` varchar(255) DEFAULT NULL,
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`barca_id`),
  KEY `barca_nome` (`barca_nome`),
  KEY `barca_proprietario` (`barca_proprietario`),
  KEY `barca_nazione` (`barca_nazione`),
  KEY `barca_nome_2` (`barca_nome`),
  KEY `barca_proprietario_2` (`barca_proprietario`),
  KEY `barca_nazione_2` (`barca_nazione`),
  KEY `idx_barche_builder` (`builder`),
  KEY `idx_barche_insurance_company` (`insurance_company`),
  KEY `idx_barche_country` (`country`),
  KEY `fk_vector_type_id_blue_vector_type_id` (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_barche_trasferimenti`
--

CREATE TABLE IF NOT EXISTS `blue_barche_trasferimenti` (
  `barca_trasferimento_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `barca_trasferimento_barca` int(11) DEFAULT NULL,
  `barca_trasferimento_da` int(11) DEFAULT NULL,
  `barca_trasferimento_a` int(11) DEFAULT NULL,
  `barca_trasferimento_data` date DEFAULT NULL,
  PRIMARY KEY (`barca_trasferimento_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_clienti`
--

CREATE TABLE IF NOT EXISTS `blue_clienti` (
  `cliente_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cliente_nominativo` varchar(250) DEFAULT NULL,
  `cliente_tipo` enum('Persona Fisica','Persona Giuridica') NOT NULL DEFAULT 'Persona Fisica',
  `cliente_nome` varchar(50) DEFAULT NULL,
  `cliente_cognome` varchar(50) DEFAULT NULL,
  `cliente_data_nascita` date DEFAULT NULL,
  `cliente_luogo_nascita` varchar(150) NOT NULL DEFAULT '',
  `cliente_indirizzo` varchar(250) DEFAULT NULL,
  `cliente_citta` varchar(50) DEFAULT NULL,
  `cliente_cap` varchar(5) DEFAULT NULL,
  `cliente_provincia` char(2) DEFAULT NULL,
  `cliente_nazione` int(11) DEFAULT '1',
  `cliente_telefono1` varchar(30) DEFAULT NULL,
  `cliente_tipo_telefono1` enum('Abitazione','Cellulare','Ufficio','Fax') NOT NULL DEFAULT 'Abitazione',
  `cliente_telefono2` varchar(30) DEFAULT NULL,
  `cliente_tipo_telefono2` enum('Abitazione','Cellulare','Ufficio','Fax') NOT NULL DEFAULT 'Cellulare',
  `cliente_telefono3` varchar(30) DEFAULT NULL,
  `cliente_tipo_telefono3` enum('Abitazione','Cellulare','Ufficio','Fax') NOT NULL DEFAULT 'Ufficio',
  `cliente_email` varchar(150) DEFAULT NULL,
  `cliente_codice_fiscale` varchar(255) DEFAULT NULL,
  `cliente_partita_iva` varchar(255) DEFAULT NULL,
  `cliente_documento` enum('CdI','Patente','Patente Nautica','Passaporto') DEFAULT 'CdI',
  `cliente_numero_documento` varchar(20) DEFAULT NULL,
  `cliente_rifiuta_comunicazioni` tinyint(1) NOT NULL DEFAULT '0',
  `cliente_note` text,
  `vat_contract` decimal(10,2) DEFAULT NULL,
  `vat_contract_description` varchar(255) DEFAULT NULL,
  `vat_service` decimal(10,2) DEFAULT NULL,
  `vat_service_description` varchar(255) DEFAULT NULL,
  `country` varchar(255) NOT NULL DEFAULT '',
  `country_blacklist` tinyint(1) NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`cliente_id`),
  KEY `nome_cliente` (`cliente_nome`),
  KEY `cognome_cliente` (`cliente_cognome`),
  KEY `cliente_nominativo` (`cliente_nominativo`),
  KEY `cliente_nome` (`cliente_nome`),
  KEY `cliente_cognome` (`cliente_cognome`),
  KEY `cliente_nominativo_2` (`cliente_nominativo`),
  KEY `cliente_nome_2` (`cliente_nome`),
  KEY `cliente_cognome_2` (`cliente_cognome`),
  KEY `idx_clienti_country` (`country`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_clienti_note`
--

CREATE TABLE IF NOT EXISTS `blue_clienti_note` (
  `cliente_nota_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cliente_nota_cliente_id` int(11) DEFAULT NULL,
  `cliente_nota_data` date DEFAULT NULL,
  `cliente_nota_contenuto` text,
  `cliente_nota_attiva` enum('0','1') DEFAULT NULL,
  PRIMARY KEY (`cliente_nota_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_contract`
--

CREATE TABLE IF NOT EXISTS `blue_contract` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `contractor1_id` int(10) unsigned DEFAULT NULL,
  `contractor2_id` int(10) unsigned DEFAULT NULL,
  `type_id` int(3) unsigned DEFAULT NULL,
  `vector_id` int(10) unsigned DEFAULT NULL,
  `resource_id` int(11) unsigned DEFAULT NULL,
  `duration_id` int(2) unsigned DEFAULT NULL,
  `date` date NOT NULL,
  `date_start` date NOT NULL DEFAULT '0000-00-00',
  `date_end` date NOT NULL DEFAULT '0000-00-00',
  `number` varchar(20) NOT NULL DEFAULT '',
  `manage_type` int(2) NOT NULL DEFAULT '0',
  `manage_perc` float NOT NULL DEFAULT '0',
  `notes` text,
  `total_net` decimal(10,2) DEFAULT NULL,
  `total_vat` decimal(10,2) DEFAULT NULL,
  `total_invoiced` decimal(10,2) DEFAULT '0.00',
  `invoiced_close` int(1) NOT NULL DEFAULT '0',
  `discount` float DEFAULT NULL,
  `sort_order` date NOT NULL DEFAULT '0000-00-00',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `fk_contract_contractor2_id_blue_clienti_cliente_id` (`contractor2_id`),
  KEY `contratto_anagrafica1_2` (`contractor1_id`),
  KEY `contratto_tipo_2` (`type_id`),
  KEY `contratto_barca_2` (`vector_id`),
  KEY `contratto_posto_barca_2` (`resource_id`),
  KEY `contratto_periodo_2` (`duration_id`),
  KEY `contratto_fine_2` (`date_end`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_contract_detail`
--

CREATE TABLE IF NOT EXISTS `blue_contract_detail` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `contract_id` int(11) unsigned NOT NULL,
  `resource_price_id` int(11) unsigned DEFAULT NULL,
  `description` text,
  `price` decimal(13,5) NOT NULL DEFAULT '0.00000',
  `measure_unit` varchar(255) NOT NULL DEFAULT '',
  `quantity` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `discount` decimal(13,5) NOT NULL DEFAULT '0.00000',
  `discount_value` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total_net` decimal(10,2) NOT NULL DEFAULT '0.00',
  `tax_rate_id` int(11) unsigned NOT NULL,
  `vat` decimal(10,2) NOT NULL DEFAULT '0.00',
  `vat_value` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `notes` text,
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `fk_contract_detail_contract_id_blue_contract_id` (`contract_id`),
  KEY `fk_contract_detail_resource_price_id_blue_resource_price_id` (`resource_price_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_contract_duration`
--

CREATE TABLE IF NOT EXISTS `blue_contract_duration` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `color` varchar(255) NOT NULL DEFAULT '',
  `prefix` varchar(255) NOT NULL DEFAULT '',
  `daily` tinyint(1) unsigned DEFAULT '0',
  `weekly` tinyint(1) unsigned DEFAULT '0',
  `monthly` tinyint(1) unsigned DEFAULT '0',
  `seasonal` tinyint(1) unsigned DEFAULT '0',
  `yearly` tinyint(1) unsigned DEFAULT '0',
  `transit` tinyint(1) unsigned DEFAULT '0',
  `expression` varchar(255) NOT NULL DEFAULT '',
  `sort_order` int(11) unsigned NOT NULL DEFAULT '0',
  `enabled` tinyint(1) unsigned DEFAULT '1',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dump dei dati per la tabella `blue_contract_duration`
--

INSERT INTO `blue_contract_duration` (`id`, `name`, `color`, `prefix`, `daily`, `weekly`, `monthly`, `seasonal`, `yearly`, `transit`, `expression`, `sort_order`, `enabled`, `create_time`, `update_time`) VALUES
(1, '1 anno', '', '', 0, 0, 0, 0, 0, 0, '1 YEAR', 6, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, '1 stagione', '', '', 0, 0, 0, 0, 0, 0, '6 MONTH', 5, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, '1 mese', '', '', 0, 0, 0, 0, 0, 0, '1 MONTH', 4, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, '1 giorno', '', '', 0, 0, 0, 0, 0, 0, '1 DAY', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, '1 settimana', '', '', 0, 0, 0, 0, 0, 0, '1 WEEK', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, '2 anni', '', '', 0, 0, 0, 0, 0, 0, '2 YEAR', 7, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, '2 settimane', '', '', 0, 0, 0, 0, 0, 0, '2 WEEK', 3, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_contract_type`
--

CREATE TABLE IF NOT EXISTS `blue_contract_type` (
  `id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL DEFAULT '',
  `description` text,
  `color` varchar(255) NOT NULL DEFAULT '',
  `prefix` varchar(255) NOT NULL DEFAULT '',
  `rent` tinyint(1) unsigned DEFAULT '0',
  `transit` tinyint(1) unsigned DEFAULT '0',
  `sell` tinyint(1) unsigned DEFAULT '0',
  `option` tinyint(1) unsigned DEFAULT '0',
  `manage` tinyint(1) unsigned DEFAULT '0',
  `reservation` tinyint(1) unsigned DEFAULT '0',
  `sort_order` int(11) unsigned NOT NULL DEFAULT '0',
  `enabled` tinyint(1) unsigned DEFAULT '1',
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dump dei dati per la tabella `blue_contract_type`
--

INSERT INTO `blue_contract_type` (`id`, `name`, `description`, `color`, `prefix`, `rent`, `transit`, `sell`, `option`, `manage`, `reservation`, `sort_order`, `enabled`, `create_time`, `update_time`) VALUES
(1, 'affitto', 'Rent contract #{id} of {date} to {fullname} on {resource}', '#ffcc66', '', 1, 0, 0, 0, 0, 0, 1, 1, '2014-01-22 18:08:32', '2014-06-18 14:47:59'),
(2, 'vendita', 'Sell contract #{id} of {date} to {fullname} on {resource}', '#ff6666', '', 0, 0, 1, 0, 0, 0, 3, 1, '2014-01-22 18:08:32', '2014-06-18 14:48:30'),
(3, 'gestione', 'Manage contract #{id} of {date} to {fullname} on {resource}', '#cc66ff', '', 0, 0, 0, 0, 1, 0, 5, 1, '2014-01-22 18:08:32', '2014-06-18 14:49:06'),
(4, 'prenotazione', 'Reservation #{id} of {date} to {fullname} on {resource}', '#66ff66', '', 0, 0, 0, 0, 0, 1, 6, 1, '2014-01-22 18:08:32', '2014-06-18 14:49:31'),
(11, 'transito', 'Transit contract #{id} of {date} to {fullname} on {resource}', '#66ccff', '', 0, 1, 0, 0, 0, 0, 2, 1, '2014-01-22 18:08:32', '2014-06-18 14:48:16'),
(12, 'ospitalità', '', '#6666ff', '', 0, 0, 0, 0, 0, 0, 7, 1, NULL, '2014-06-18 14:49:43'),
(13, 'opzione', 'Option contract #{id} of {date} to {fullname} on {resource}', '#ff6fcf', '', 0, 0, 0, 1, 0, 0, 4, 1, '2014-01-22 18:08:32', '2014-06-18 14:49:19');

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_contratti`
--

CREATE TABLE IF NOT EXISTS `blue_contratti` (
  `contratto_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `contratto_anagrafica1` int(11) unsigned NOT NULL,
  `contratto_anagrafica2` int(11) unsigned NOT NULL,
  `contratto_tipo` int(11) unsigned NOT NULL,
  `contratto_barca` int(11) unsigned NOT NULL DEFAULT '0',
  `contratto_posto_barca` int(11) unsigned NOT NULL,
  `contratto_periodo` int(11) unsigned NOT NULL,
  `contratto_data` date NOT NULL,
  `contratto_inizio` date NOT NULL DEFAULT '0000-00-00',
  `contratto_fine` date NOT NULL DEFAULT '0000-00-00',
  `contratto_numero` varchar(20) NOT NULL DEFAULT '',
  `contratto_gestione_tipo` int(2) NOT NULL DEFAULT '0',
  `contratto_gestione_percentuale` float NOT NULL DEFAULT '0',
  `contratto_note` text,
  `contratto_imponibile` decimal(10,2) DEFAULT NULL,
  `contratto_totale` decimal(10,2) DEFAULT NULL,
  `contratto_fatturato` decimal(10,2) DEFAULT '0.00',
  `contratto_fatturato_chiuso` int(1) NOT NULL DEFAULT '0',
  `contratto_sconto` float DEFAULT NULL,
  `contratto_ordine` date NOT NULL DEFAULT '0000-00-00',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`contratto_id`),
  KEY `fk_contract_contractor2_id_blue_clienti_cliente_id` (`contratto_anagrafica2`),
  KEY `contratto_anagrafica1_2` (`contratto_anagrafica1`),
  KEY `contratto_tipo_2` (`contratto_tipo`),
  KEY `contratto_barca_2` (`contratto_barca`),
  KEY `contratto_posto_barca_2` (`contratto_posto_barca`),
  KEY `contratto_periodo_2` (`contratto_periodo`),
  KEY `contratto_fine_2` (`contratto_fine`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_contratti_dettagli`
--

CREATE TABLE IF NOT EXISTS `blue_contratti_dettagli` (
  `contratto_dettaglio_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `contratto_dettaglio_contratto_id` int(11) unsigned NOT NULL DEFAULT '0',
  `contratto_dettaglio_costo_lettere` varchar(250) DEFAULT NULL,
  `contratto_dettaglio_iva_lettere` varchar(250) DEFAULT NULL,
  `contratto_dettaglio_totale_lettere` varchar(250) DEFAULT NULL,
  `contratto_dettaglio_modalita_pagamento` text,
  `contratto_dettaglio_oneri_anno` varchar(4) DEFAULT NULL,
  `contratto_dettaglio_oneri_cifra` decimal(10,2) DEFAULT NULL,
  `contratto_dettaglio_oneri_lettere` varchar(250) DEFAULT NULL,
  `contratto_dettaglio_oneri_saldabili_mese` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`contratto_dettaglio_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_contratti_periodi`
--

CREATE TABLE IF NOT EXISTS `blue_contratti_periodi` (
  `contratto_periodo_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `contratto_periodo_nome` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`contratto_periodo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dump dei dati per la tabella `blue_contratti_periodi`
--

INSERT INTO `blue_contratti_periodi` (`contratto_periodo_id`, `contratto_periodo_nome`) VALUES
(1, 'annuale'),
(2, 'stagionale'),
(3, 'mensile'),
(4, 'giornaliero'),
(5, 'settimanale'),
(6, 'pluriennale');

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_contratti_tipo`
--

CREATE TABLE IF NOT EXISTS `blue_contratti_tipo` (
  `contratto_tipo_id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `contratto_tipo_nome` varchar(150) NOT NULL DEFAULT '',
  `color` varchar(255) NOT NULL DEFAULT '',
  `prefix` varchar(255) NOT NULL DEFAULT '',
  `rent` tinyint(1) unsigned DEFAULT '0',
  `transit` tinyint(1) unsigned DEFAULT '0',
  `sell` tinyint(1) unsigned DEFAULT '0',
  `option` tinyint(1) unsigned DEFAULT '0',
  `manage` tinyint(1) unsigned DEFAULT '0',
  `reservation` tinyint(1) unsigned DEFAULT '0',
  `sort_order` int(11) unsigned NOT NULL DEFAULT '0',
  `enabled` tinyint(1) unsigned DEFAULT '1',
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`contratto_tipo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dump dei dati per la tabella `blue_contratti_tipo`
--

INSERT INTO `blue_contratti_tipo` (`contratto_tipo_id`, `contratto_tipo_nome`, `color`, `prefix`, `rent`, `transit`, `sell`, `option`, `manage`, `reservation`, `sort_order`, `enabled`, `create_time`, `update_time`) VALUES
(1, 'affitto', '#ffff00', '', 1, 0, 0, 0, 0, 0, 1, 1, '2014-01-22 18:08:32', '2014-01-22 18:08:32'),
(2, 'vendita', '#ff0000', '', 0, 0, 1, 0, 0, 0, 3, 1, '2014-01-22 18:08:32', '2014-01-22 18:08:32'),
(3, 'gestione', '#ff00ff', '', 0, 0, 0, 0, 1, 0, 5, 1, '2014-01-22 18:08:32', '2014-01-22 18:08:32'),
(4, 'prenotazione', '#00ff00', '', 0, 0, 0, 0, 0, 1, 6, 1, '2014-01-22 18:08:32', '2014-01-22 18:08:32'),
(5, 'commissione', '', '', 0, 0, 0, 0, 0, 0, 0, 1, NULL, NULL),
(6, 'sotto commissione', '', '', 0, 0, 0, 0, 0, 0, 0, 1, NULL, NULL),
(7, 'commessa interna', '', '', 0, 0, 0, 0, 0, 0, 0, 1, NULL, NULL),
(9, 'intermediazione', '', '', 0, 0, 0, 0, 0, 0, 0, 1, NULL, NULL),
(11, 'transito', '#00ffff', '', 0, 1, 0, 0, 0, 0, 2, 1, '2014-01-22 18:08:32', '2014-01-22 18:08:32'),
(12, 'ospitalit&agrave;', '', '', 0, 0, 0, 0, 0, 0, 0, 1, NULL, NULL),
(13, 'opzione', '#9999ff', '', 0, 0, 0, 1, 0, 0, 4, 1, '2014-01-22 18:08:32', '2014-01-22 18:08:32');

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_costruttori`
--

CREATE TABLE IF NOT EXISTS `blue_costruttori` (
  `costruttore_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `costruttore_nome` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`costruttore_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_country_blacklist`
--

CREATE TABLE IF NOT EXISTS `blue_country_blacklist` (
  `country` char(2) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`country`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_customer_identification`
--

CREATE TABLE IF NOT EXISTS `blue_customer_identification` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) unsigned NOT NULL,
  `type` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL DEFAULT '',
  `date` date NOT NULL DEFAULT '0000-00-00',
  `expire` date NOT NULL DEFAULT '0000-00-00',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `fk_customer_identification_customer_idblue_clienti_cliente_id` (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_dimensioni`
--

CREATE TABLE IF NOT EXISTS `blue_dimensioni` (
  `dimensione_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `dimensione_lunghezza` float DEFAULT NULL,
  `dimensione_larghezza` float DEFAULT NULL,
  `dimensione_profondita` float DEFAULT NULL,
  `type_id` int(11) unsigned NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`dimensione_id`),
  KEY `fk_dimensioni_type_id_blue_dimension_type_id` (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Dimensioni e Listino dei Posti Barca' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_dimension_type`
--

CREATE TABLE IF NOT EXISTS `blue_dimension_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `description` text,
  `color` varchar(255) NOT NULL DEFAULT '',
  `sort_order` int(11) unsigned NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dump dei dati per la tabella `blue_dimension_type`
--

INSERT INTO `blue_dimension_type` (`id`, `name`, `description`, `color`, `sort_order`, `create_time`, `update_time`) VALUES
(1, 'A mare', 'Posto barca a mare', '#66ccff', 1, '2014-06-18 12:45:29', '2014-06-18 12:54:20'),
(2, 'A terra', 'Rimessaggio a terra', '#ffcc66', 2, '2014-06-18 12:45:29', '2014-06-18 12:54:30');

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_hint`
--

CREATE TABLE IF NOT EXISTS `blue_hint` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `model` varchar(255) NOT NULL,
  `model_id` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'info',
  `title` varchar(255) NOT NULL,
  `description` text,
  `date_start` date NOT NULL DEFAULT '0000-00-00',
  `date_end` date NOT NULL DEFAULT '0000-00-00',
  `alert` tinyint(1) NOT NULL DEFAULT '0',
  `closed` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int(11) unsigned DEFAULT NULL,
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `idx_hint_model` (`model`),
  KEY `idx_hint_model_id` (`model_id`),
  KEY `idx_hint_title` (`title`),
  KEY `idx_hint_date_start` (`date_start`),
  KEY `idx_hint_date_end` (`date_end`),
  KEY `fk_hint_user_id_blue_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_hook_metodo_customer2anagraficacf`
--

CREATE TABLE IF NOT EXISTS `blue_hook_metodo_customer2anagraficacf` (
  `customer_id` int(11) unsigned NOT NULL,
  `anagraficacf_codconto` varchar(10) NOT NULL,
  KEY `index_customer_id` (`customer_id`),
  KEY `index_anagraficacf_codconto` (`anagraficacf_codconto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_hook_metodo_invoice2testedocumenti`
--

CREATE TABLE IF NOT EXISTS `blue_hook_metodo_invoice2testedocumenti` (
  `invoice_id` int(11) unsigned NOT NULL,
  KEY `invoice_id` (`invoice_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_hook_metodo_product2vistagiacenze`
--

CREATE TABLE IF NOT EXISTS `blue_hook_metodo_product2vistagiacenze` (
  `product_id` int(11) unsigned NOT NULL,
  `vistagiacenze_codart` varchar(255) NOT NULL,
  KEY `index_product_id` (`product_id`),
  KEY `index_vistagiacenze_codart` (`vistagiacenze_codart`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_invoice`
--

CREATE TABLE IF NOT EXISTS `blue_invoice` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) unsigned NOT NULL,
  `invoice_number` int(11) unsigned NOT NULL DEFAULT '0',
  `suffix` varchar(255) DEFAULT NULL,
  `invoice_id` int(11) unsigned DEFAULT NULL,
  `date` date NOT NULL,
  `billing_header` text NOT NULL,
  `billing_address` text NOT NULL,
  `billing_zip` text,
  `billing_city` text,
  `billing_province` text,
  `billing_country` text,
  `billing_tax` text NOT NULL,
  `shipping_header` text,
  `shipping_address` text,
  `shipping_zip` text,
  `shipping_city` text,
  `shipping_province` text,
  `shipping_country` text,
  `status_id` int(11) unsigned NOT NULL,
  `type_id` int(11) unsigned NOT NULL,
  `due_date` date DEFAULT NULL,
  `date_paid` date DEFAULT NULL,
  `payment_method_id` int(11) unsigned DEFAULT NULL,
  `notes` text,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_invoice_customer_id_blue_clienti_cliente_id` (`customer_id`),
  KEY `fk_invoice_status_id_blue_invoice_status_id` (`status_id`),
  KEY `fk_invoice_type_id_blue_invoice_type_id` (`type_id`),
  KEY `fk_invoice_invoice_id_blue_invoice_id` (`invoice_id`),
  KEY `fk_invoice_payment_method_id_blue_payment_method_id` (`payment_method_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_invoice_payment`
--

CREATE TABLE IF NOT EXISTS `blue_invoice_payment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) unsigned NOT NULL,
  `gateway` varchar(255) NOT NULL DEFAULT '',
  `date` date DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `fk_invoice_payment_invoice_id_blue_invoice_id` (`invoice_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_invoice_row`
--

CREATE TABLE IF NOT EXISTS `blue_invoice_row` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) unsigned NOT NULL,
  `order_id` int(11) unsigned DEFAULT NULL,
  `order_detail_id` int(11) unsigned DEFAULT NULL,
  `contract_id` int(11) unsigned DEFAULT NULL,
  `contract_detail_id` int(11) unsigned DEFAULT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `price` decimal(13,5) NOT NULL DEFAULT '0.00000',
  `measure_unit` varchar(255) NOT NULL DEFAULT '',
  `quantity` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `discount` decimal(10,5) NOT NULL DEFAULT '0.00000',
  `discount_value` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total_net` decimal(10,2) NOT NULL DEFAULT '0.00',
  `tax_rate_id` int(11) unsigned DEFAULT NULL,
  `vat` decimal(10,2) NOT NULL DEFAULT '0.00',
  `vat_value` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `notes` text,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_invoice_row_id_blue_invoice_id` (`invoice_id`),
  KEY `fk_invoice_row_order_detail_id_blue_order_detail_id` (`order_detail_id`),
  KEY `fk_invoice_row_order_id_blue_order_id` (`order_id`),
  KEY `fk_invoice_row_tax_rate_id_blue_tax_rate_id` (`tax_rate_id`),
  KEY `fk_invoice_row_contract_id_blue_contract_id` (`contract_id`),
  KEY `fk_invoice_row_contract_detail_id_blue_contract_detail_id` (`contract_detail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_invoice_status`
--

CREATE TABLE IF NOT EXISTS `blue_invoice_status` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `color` varchar(255) NOT NULL DEFAULT '',
  `paid` tinyint(1) unsigned DEFAULT '0',
  `unpaid` tinyint(1) unsigned DEFAULT '0',
  `cancelled` tinyint(1) unsigned DEFAULT '0',
  `sort_order` int(11) unsigned NOT NULL DEFAULT '0',
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dump dei dati per la tabella `blue_invoice_status`
--

INSERT INTO `blue_invoice_status` (`id`, `name`, `color`, `paid`, `unpaid`, `cancelled`, `sort_order`, `create_time`, `update_time`) VALUES
(1, 'Pagata', '#66ff66', 1, 0, 0, 1, '2014-01-22 18:08:32', '2014-06-18 14:51:33'),
(2, 'Non pagata', '#ff6666', 0, 1, 0, 2, '2014-01-22 18:08:32', '2014-06-18 14:51:47'),
(3, 'Cancelled', '#cccccc', 0, 0, 1, 3, '2014-01-22 18:08:32', '2014-06-18 14:52:00');

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_invoice_type`
--

CREATE TABLE IF NOT EXISTS `blue_invoice_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `description` text,
  `color` varchar(255) NOT NULL DEFAULT '',
  `type` enum('INCOME','OUTCOME') DEFAULT NULL,
  `prefix` varchar(255) NOT NULL DEFAULT '',
  `year_restart` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `sort_order` int(11) unsigned NOT NULL DEFAULT '0',
  `enabled` tinyint(1) unsigned DEFAULT '1',
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dump dei dati per la tabella `blue_invoice_type`
--

INSERT INTO `blue_invoice_type` (`id`, `name`, `description`, `color`, `type`, `prefix`, `year_restart`, `sort_order`, `enabled`, `create_time`, `update_time`) VALUES
(1, 'Fattura', 'Fattura immediata', '#66ccff', 'INCOME', '2014-', 1, 1, 1, '2014-01-22 18:08:32', '2014-06-18 14:55:56'),
(2, 'Nota di credito', 'Nota di credito', '#ffcc66', 'OUTCOME', '', 1, 2, 1, '2014-01-22 18:08:32', '2014-06-18 14:56:07');

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_listini_posti_barca`
--

CREATE TABLE IF NOT EXISTS `blue_listini_posti_barca` (
  `listino_posto_barca_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `listino_posto_barca_dimensione` int(5) DEFAULT NULL,
  `listino_posto_barca_anno` int(4) DEFAULT NULL,
  `costo_giornaliero` decimal(10,2) DEFAULT NULL,
  `costo_e1` decimal(10,2) DEFAULT NULL,
  `costo_e2` decimal(10,2) DEFAULT NULL,
  `costo_em` decimal(10,2) DEFAULT NULL,
  `costo_es` decimal(10,2) DEFAULT NULL,
  `costo_i1` decimal(10,2) DEFAULT NULL,
  `costo_i2` decimal(10,2) DEFAULT NULL,
  `costo_im` decimal(10,2) DEFAULT NULL,
  `costo_is` decimal(10,2) DEFAULT NULL,
  `costo_annuale` decimal(10,2) DEFAULT NULL,
  `costo_condominiale` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`listino_posto_barca_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `blue_mainsearch`
--
CREATE TABLE IF NOT EXISTS `blue_mainsearch` (
`id` int(11) unsigned
,`type` varchar(8)
,`sort_order` varchar(1)
,`name` varchar(250)
,`search` text
);
-- --------------------------------------------------------

--
-- Struttura della tabella `blue_migration`
--

CREATE TABLE IF NOT EXISTS `blue_migration` (
  `version` varchar(255) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `blue_migration`
--

INSERT INTO `blue_migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1390410505),
('m100000_000000_0', 1390410512),
('m200000_000000_0', 1390410513),
('m200000_100000_0', 1391178480),
('m200000_200000_0', 1391203495),
('m200000_300000_0', 1403095527),
('m200000_300001_0', 1403095527),
('m200000_300002_0', 1403095529),
('m200000_300003_0', 1403095529),
('m200000_300004_0', 1403095529),
('m200000_300010_0', 1403095529),
('m200000_300020_0', 1403095529),
('m200000_300030_0', 1403095530),
('m200000_300040_0', 1403095530),
('m200000_400000_0', 1403095530),
('m200000_400001_0', 1403095530),
('m200000_400002_0', 1403095530),
('m200000_400003_0', 1403095530),
('m200000_400004_0', 1403095530),
('m200000_400005_0', 1403095530),
('m200000_500000_0', 1403095530),
('m200000_500001_0', 1403095531),
('m200000_500002_0', 1403095531),
('m200000_500003_0', 1403095531),
('m200000_600000_0', 1403095531),
('m200000_600001_0', 1403095531),
('m200000_600002_0', 1403095532),
('m200000_600003_0', 1403095532),
('m200000_600004_0', 1403095532),
('m200000_600005_0', 1403095532),
('m200000_600006_0', 1403095532),
('m200000_700000_0', 1403095532),
('m200000_700001_0', 1403095533),
('m200000_700002_0', 1403095533),
('m200000_700003_0', 1403095534),
('m200000_700004_0', 1403095534),
('m200000_700005_0', 1403095534),
('m200000_700006_0', 1403095534),
('m200000_700007_0', 1403095534),
('m200000_800000_0', 1403095534),
('m200000_800001_0', 1403095535),
('m200000_800002_0', 1403095535),
('m200000_800003_0', 1403095535),
('m200000_800004_0', 1403095536),
('m200000_800005_0', 1403095536),
('m200000_800006_0', 1403095536),
('m200000_800007_0', 1403095536),
('m200000_800008_0', 1403095536),
('m200000_800009_0', 1403095536),
('m200000_800010_0', 1403095536);

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_old_system_template`
--

CREATE TABLE IF NOT EXISTS `blue_old_system_template` (
  `id` varchar(255) NOT NULL,
  `language` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `text_content` text,
  `html_content` text,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`,`language`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `blue_old_system_template`
--

INSERT INTO `blue_old_system_template` (`id`, `language`, `name`, `description`, `text_content`, `html_content`, `create_time`, `update_time`) VALUES
('PRINT_FOOTER', 'en', 'Footer print', 'Footer for all print', '---------------------', '<table style="width: 100%;"><tr><td>{$footer_date}</td><td align="right">Page CURRENT_PAGE / TOTAL_PAGES</td></tr></table>', '2014-01-22 18:08:32', NULL),
('PRINT_HEADER', 'en', 'Header print', 'Header for all print', '{$smarty.const.APPLICATION_COMPANY_NAME}\\n---------------------', '<h2>{$smarty.const.APPLICATION_COMPANY_NAME}</h2> <hr />', '2014-01-22 18:08:32', NULL),
('PRINT_INVOICE', 'en', 'Invoice print', 'Invoice print', 'Hello, this invoice is for {$invoice->customer->cliente_nominativo}', '<h1>{$invoice.type.name}&nbsp;{if $invoice.invoice_number}{$invoice.type.prefix}{$invoice.invoice_number}{else}{$invoice.id}{/if}</h1>\n<p>{$invoice.billing_header}<br /> {$invoice.billing_address}<br /> {$invoice.billing_zip}, {$invoice.billing_city}, {$invoice.billing_province}<br /> {$invoice.billing_country}<br /> {$invoice.billing_tax}</p>\n<p>{if $invoice.status.unpaid}Date: {$invoice_date}<br />Due date: {$invoice_due_date} {elseif $invoice.status.paid}Date: {$invoice_date_paid} {else}Date: {$invoice_date}{/if}</p>\n<table style="border: 1px solid black; width: 100%;" cellpadding="2" cellspacing="2">\n<thead>\n<tr><th>Description</th><th>Price</th><th>Quantity</th><th>Vat</th><th>Discount</th><th>Sub total</th></tr>\n</thead>\n<tbody><!-- {foreach $invoice.invoiceRows as $k => $v} --> <!-- {cycle values="#eeeeee,#d0d0d0" assign="trcolor"} -->\n<tr style="background-color: {$trcolor};">\n<td>{$v.description}</td>\n<td style="text-align: right;">{$v.price}</td>\n<td style="text-align: right;">{$v.quantity}</td>\n<td style="text-align: right;">{$v.vat}</td>\n<td style="text-align: right;">{$v.discount}</td>\n<td style="text-align: right;">{$v.total}</td>\n</tr>\n<!-- {/foreach} --></tbody>\n</table>\n<table style="width: 100%;" cellpadding="4">\n<thead>\n<tr><th align="center">Net total</th><th align="center">VAT total</th><th align="center">Discount total</th><th align="center"><strong>Invoice&nbsp;total</strong></th></tr>\n</thead>\n<tbody>\n<tr>\n<td align="right">{$invoice.net_total}</td>\n<td align="right">{$invoice.vat_total}</td>\n<td align="right">{$invoice.discount_total}</td>\n<td align="right"><strong>{$invoice.total}</strong></td>\n</tr>\n</tbody>\n</table>\n<h2>Notes:</h2>\n<p>{$invoice.notes|nl2br}</p>', '2014-01-22 18:08:32', NULL),
('PRINT_ORDER', 'en', 'Order print', 'Order print', 'Hello, this is order is for {$order->customer->cliente_nominativo}', '<h1><img alt="" src="../upload/images/c16b1bae13aaa7b8c8e21e76b810539d.png" style="height:440px; width:440px" />Order #{$order.id} {if $order.work_number} - Work number #{$order.work_number} {/if}</h1>\r\n\r\n<h2>Client: {$order.customer.cliente_nominativo} {if $order.vector !== null}<br />\r\nVector: {$order.vector.barca_nome} {$order.vector.barca_targa} {/if}</h2>\r\n\r\n<p>Date: {$order_date}<br />\r\nWork date: {$order_work_date}<br />\r\nDue date: {$order_due_date}</p>\r\n\r\n<table cellpadding="2" style="border:1px solid black; width:100%">\r\n	<thead>\r\n		<tr>\r\n			<th>Product</th>\r\n			<th>Price</th>\r\n			<th>Quantity</th>\r\n			<th>Vat</th>\r\n			<th>Discount</th>\r\n			<th>Sub total</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody><!-- {foreach $order.orderDetails as $k => $v} -->\r\n		<tr>\r\n			<td>{$v.product.name}</td>\r\n			<td style="text-align:right">{$v.price}</td>\r\n			<td style="text-align:right">{$v.quantity}</td>\r\n			<td style="text-align:right">{$v.vat}</td>\r\n			<td style="text-align:right">{$v.discount}</td>\r\n			<td style="text-align:right">{$v.total}</td>\r\n		</tr>\r\n		<!-- {/foreach} -->\r\n	</tbody>\r\n</table>\r\n\r\n<table cellpadding="4" style="width:100%">\r\n	<thead>\r\n		<tr>\r\n			<th>Net total</th>\r\n			<th>VAT total</th>\r\n			<th>Discount total</th>\r\n			<th><strong>Order total</strong></th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>{$order.net_total}</td>\r\n			<td>{$order.vat_total}</td>\r\n			<td>{$order.discount_total}</td>\r\n			<td><strong>{$order.total}</strong></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<h2>Notes:</h2>\r\n\r\n<p>{$order.notes|nl2br}</p>\r\n', '2014-01-22 18:08:32', '2014-02-05 17:18:48');

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_order`
--

CREATE TABLE IF NOT EXISTS `blue_order` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) unsigned NOT NULL,
  `vector_id` int(10) unsigned DEFAULT NULL,
  `date` date NOT NULL,
  `work_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `work_number` int(11) unsigned DEFAULT NULL,
  `type_id` int(11) unsigned NOT NULL DEFAULT '1',
  `status_id` int(11) unsigned NOT NULL,
  `notes` text,
  `father_id` int(11) unsigned DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_order_customer_id_blue_clienti_cliente_id` (`customer_id`),
  KEY `fk_order_vector_id_blue_barche_barca_id` (`vector_id`),
  KEY `fk_order_status_id_blue_order_status_id` (`status_id`),
  KEY `fk_order_type_id_blue_order_type_id` (`type_id`),
  KEY `fk_order_father_id_blue_order_id` (`father_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_order_detail`
--

CREATE TABLE IF NOT EXISTS `blue_order_detail` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) unsigned NOT NULL,
  `product_id` int(11) unsigned DEFAULT NULL,
  `contract_id` int(11) unsigned DEFAULT NULL,
  `father_id` int(11) unsigned DEFAULT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `description` text,
  `cost` decimal(10,2) DEFAULT NULL,
  `price` decimal(13,5) NOT NULL DEFAULT '0.00000',
  `measure_unit` varchar(255) NOT NULL DEFAULT '',
  `quantity` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `discount` decimal(10,5) NOT NULL DEFAULT '0.00000',
  `discount_value` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total_net` decimal(10,2) NOT NULL DEFAULT '0.00',
  `tax_rate_id` int(11) unsigned DEFAULT NULL,
  `vat` decimal(10,2) NOT NULL DEFAULT '0.00',
  `vat_value` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `work_time` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total_work_time` decimal(10,2) NOT NULL DEFAULT '0.00',
  `done` tinyint(1) unsigned DEFAULT '0',
  `date` date DEFAULT NULL,
  `notes` text,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_order_detail_order_id_blue_order_id` (`order_id`),
  KEY `fk_order_detail_product_id_blue_product_id` (`product_id`),
  KEY `fk_order_detail_contract_id_blue_contratti_id` (`contract_id`),
  KEY `fk_order_detail_tax_rate_id_blue_tax_rate_id` (`tax_rate_id`),
  KEY `fk_order_detail_father_id_blue_order_detail_id` (`father_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_order_status`
--

CREATE TABLE IF NOT EXISTS `blue_order_status` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `color` varchar(255) NOT NULL DEFAULT '',
  `quote` tinyint(1) unsigned DEFAULT '0',
  `opened` tinyint(1) unsigned DEFAULT '0',
  `pending` tinyint(1) unsigned DEFAULT '0',
  `closed` tinyint(1) unsigned DEFAULT '0',
  `cancelled` tinyint(1) unsigned DEFAULT '0',
  `sort_order` int(11) unsigned NOT NULL DEFAULT '0',
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dump dei dati per la tabella `blue_order_status`
--

INSERT INTO `blue_order_status` (`id`, `name`, `color`, `quote`, `opened`, `pending`, `closed`, `cancelled`, `sort_order`, `create_time`, `update_time`) VALUES
(1, 'Preventivo', '#cc66ff', 1, 0, 0, 0, 0, 1, '2014-01-22 18:08:32', '2014-06-18 14:50:14'),
(2, 'Aperto', '#66ffcc', 0, 1, 0, 0, 0, 2, '2014-01-22 18:08:32', '2014-06-18 14:50:24'),
(3, 'In lavorazione', '#ffcc66', 0, 0, 1, 0, 0, 3, '2014-01-22 18:08:32', '2014-06-18 14:50:42'),
(4, 'Chiuso', '#ff6666', 0, 0, 0, 1, 0, 4, '2014-01-22 18:08:32', '2014-06-18 14:50:52'),
(5, 'Cancellato', '#cccccc', 0, 0, 0, 0, 1, 5, '2014-01-22 18:08:32', '2014-06-18 14:51:08');

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_order_type`
--

CREATE TABLE IF NOT EXISTS `blue_order_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `description` text,
  `order` tinyint(1) NOT NULL DEFAULT '0',
  `contract` tinyint(1) NOT NULL DEFAULT '0',
  `service` tinyint(1) NOT NULL DEFAULT '0',
  `color` varchar(255) NOT NULL DEFAULT '',
  `show` tinyint(1) unsigned DEFAULT '0',
  `sort_order` int(11) unsigned NOT NULL DEFAULT '0',
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dump dei dati per la tabella `blue_order_type`
--

INSERT INTO `blue_order_type` (`id`, `name`, `description`, `order`, `contract`, `service`, `color`, `show`, `sort_order`, `create_time`, `update_time`) VALUES
(1, 'Order', 'Standard order', 1, 0, 0, '#66ccff', 1, 1, '2014-01-22 18:08:32', NULL),
(2, 'Contract', 'Contract order', 0, 1, 0, '#ffcc66', 1, 2, '2014-01-22 18:08:32', '2014-02-04 18:24:45'),
(3, 'Service', 'Service or usage order', 0, 0, 1, '#66ffcc', 1, 3, '2014-01-22 18:08:32', NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_payment_method`
--

CREATE TABLE IF NOT EXISTS `blue_payment_method` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `gateway` varchar(255) NOT NULL,
  `enabled` tinyint(1) unsigned DEFAULT '1',
  `sort_order` int(11) unsigned NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dump dei dati per la tabella `blue_payment_method`
--

INSERT INTO `blue_payment_method` (`id`, `name`, `gateway`, `enabled`, `sort_order`, `create_time`, `update_time`) VALUES
(1, 'Rimessa diretta', 'Rimessa diretta', 1, 0, '2014-06-18 12:45:29', '0000-00-00 00:00:00'),
(2, 'Ri.Ba. Fine mese Data fattura', 'Ri.Ba.', 1, 0, '2014-06-18 12:45:29', '0000-00-00 00:00:00'),
(3, 'Bonifico bancario 30 gg data fattura', 'Bonifico bancario', 1, 0, '2014-06-18 12:45:29', '0000-00-00 00:00:00'),
(4, 'Bonifico bancario 30,60 gg fine mese data fattura', 'Bonifico bancario', 1, 0, '2014-06-18 12:45:29', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_payment_method_rule`
--

CREATE TABLE IF NOT EXISTS `blue_payment_method_rule` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `payment_method_id` int(11) unsigned NOT NULL,
  `gateway` varchar(255) NOT NULL DEFAULT '',
  `base_day` enum('INVOICE_DATE','INVOICE_MONTH_END') DEFAULT NULL,
  `days` int(11) unsigned NOT NULL DEFAULT '0',
  `percentage` decimal(10,2) DEFAULT NULL,
  `sort_order` int(11) unsigned NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `fk_payment_method_rule_payment_method_id_blue_payment_method_id` (`payment_method_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dump dei dati per la tabella `blue_payment_method_rule`
--

INSERT INTO `blue_payment_method_rule` (`id`, `payment_method_id`, `gateway`, `base_day`, `days`, `percentage`, `sort_order`, `create_time`, `update_time`) VALUES
(1, 1, 'Rimessa diretta', 'INVOICE_DATE', 0, 100.00, 1, '2014-06-18 12:45:29', '0000-00-00 00:00:00'),
(2, 2, 'Ri.Ba.', 'INVOICE_MONTH_END', 0, 100.00, 1, '2014-06-18 12:45:29', '0000-00-00 00:00:00'),
(3, 3, 'Bonifico bancario', 'INVOICE_DATE', 30, 100.00, 1, '2014-06-18 12:45:29', '0000-00-00 00:00:00'),
(4, 4, 'Bonifico bancario', 'INVOICE_MONTH_END', 30, 50.00, 1, '2014-06-18 12:45:29', '0000-00-00 00:00:00'),
(5, 4, 'Bonifico bancario', 'INVOICE_MONTH_END', 60, 50.00, 2, '2014-06-18 12:45:29', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_pontili`
--

CREATE TABLE IF NOT EXISTS `blue_pontili` (
  `pontile_id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `pontile_nome` varchar(150) NOT NULL DEFAULT '',
  `pontile_codice` char(3) DEFAULT NULL,
  `pontile_tipo` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`pontile_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_pontili_tipo`
--

CREATE TABLE IF NOT EXISTS `blue_pontili_tipo` (
  `pontile_tipo_id` int(2) unsigned NOT NULL AUTO_INCREMENT,
  `pontile_tipo_nome` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`pontile_tipo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_portmap`
--

CREATE TABLE IF NOT EXISTS `blue_portmap` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '0',
  `height` int(11) DEFAULT '700',
  `library` varchar(255) NOT NULL DEFAULT 'RAPHAELJS',
  `sort_order` int(11) unsigned DEFAULT '1',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_posti_barca`
--

CREATE TABLE IF NOT EXISTS `blue_posti_barca` (
  `posto_barca_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `posto_barca_pontile` int(2) NOT NULL DEFAULT '0',
  `posto_barca_numero` int(5) NOT NULL DEFAULT '0',
  `posto_barca_sequenziale` int(5) NOT NULL DEFAULT '0',
  `posto_barca_dimensioni` int(2) NOT NULL DEFAULT '0',
  `posto_barca_descrizione` varchar(150) DEFAULT NULL,
  `posto_barca_proprietario` int(10) NOT NULL DEFAULT '0',
  `posto_barca_proprietario_data` date DEFAULT NULL,
  `posto_barca_gestore` int(10) NOT NULL DEFAULT '0',
  `posto_barca_gestore_data` date DEFAULT NULL,
  `posto_barca_gestore_data_fine` date DEFAULT NULL,
  `posto_barca_disponibile` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`posto_barca_id`),
  KEY `posto_barca_pontile` (`posto_barca_pontile`),
  KEY `posto_barca_proprietario` (`posto_barca_proprietario`),
  KEY `posto_barca_gestore` (`posto_barca_gestore`),
  KEY `posto_barca_pontile_2` (`posto_barca_pontile`),
  KEY `posto_barca_proprietario_2` (`posto_barca_proprietario`),
  KEY `posto_barca_gestore_2` (`posto_barca_gestore`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_posti_barca_status`
--

CREATE TABLE IF NOT EXISTS `blue_posti_barca_status` (
  `status_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `posto_barca` varchar(20) DEFAULT NULL,
  `cliente` int(10) DEFAULT NULL,
  `barca` int(10) DEFAULT NULL,
  `inizio` varchar(20) DEFAULT NULL,
  `fine` varchar(20) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `presenza` enum('0','1') DEFAULT '0',
  `posto_barca_dimensioni` varchar(50) DEFAULT '',
  `posto_barca_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`status_id`),
  KEY `posto_barca` (`posto_barca`),
  KEY `cliente` (`cliente`),
  KEY `barca` (`barca`),
  KEY `inizio` (`inizio`),
  KEY `fine` (`fine`),
  KEY `status` (`status`),
  KEY `presenza` (`presenza`),
  KEY `posto_barca_2` (`posto_barca`),
  KEY `cliente_2` (`cliente`),
  KEY `barca_2` (`barca`),
  KEY `inizio_2` (`inizio`),
  KEY `fine_2` (`fine`),
  KEY `status_2` (`status`),
  KEY `presenza_2` (`presenza`),
  KEY `posto_barca_id` (`posto_barca_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_presence`
--

CREATE TABLE IF NOT EXISTS `blue_presence` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `resource_id` int(11) unsigned NOT NULL,
  `customer_id` int(11) unsigned DEFAULT NULL,
  `vector_id` int(11) unsigned DEFAULT NULL,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `time_start` time DEFAULT NULL,
  `time_end` time DEFAULT NULL,
  `notes` text,
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `fk_presence_resource_id_blue_resource_id` (`resource_id`),
  KEY `fk_presence_customer_id_blue_customer_id` (`customer_id`),
  KEY `fk_presence_vector_id_blue_vector_id` (`vector_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_prima_nota`
--

CREATE TABLE IF NOT EXISTS `blue_prima_nota` (
  `prima_nota_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `prima_nota_data` date NOT NULL,
  `prima_nota_descrizione` varchar(255) NOT NULL,
  `prima_nota_fattura_id` int(11) unsigned NOT NULL,
  `prima_nota_entrata` float NOT NULL,
  `prima_nota_uscita` float NOT NULL,
  `prima_nota_categoria` varchar(255) NOT NULL,
  `prima_nota_mezzo_scambio` varchar(255) NOT NULL,
  PRIMARY KEY (`prima_nota_id`),
  KEY `prima_nota_data` (`prima_nota_data`),
  KEY `prima_nota_fattura_id` (`prima_nota_fattura_id`),
  KEY `prima_nota_categoria` (`prima_nota_categoria`),
  KEY `prima_nota_mezzo_scambio` (`prima_nota_mezzo_scambio`),
  KEY `prima_nota_data_2` (`prima_nota_data`),
  KEY `prima_nota_fattura_id_2` (`prima_nota_fattura_id`),
  KEY `prima_nota_categoria_2` (`prima_nota_categoria`),
  KEY `prima_nota_mezzo_scambio_2` (`prima_nota_mezzo_scambio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_product`
--

CREATE TABLE IF NOT EXISTS `blue_product` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(11) unsigned NOT NULL,
  `sku` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `cost` decimal(10,2) DEFAULT NULL,
  `measure_unit` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `tax_rate_id` int(11) unsigned DEFAULT NULL,
  `vat` decimal(10,2) NOT NULL DEFAULT '0.00',
  `work_time` decimal(10,2) NOT NULL DEFAULT '0.00',
  `enabled` tinyint(1) unsigned DEFAULT '1',
  `sort_order` int(11) unsigned NOT NULL DEFAULT '0',
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_group_id_blue_product_group_id` (`group_id`),
  KEY `fk_product_tax_rate_id_blue_tax_rate_id` (`tax_rate_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_product_bundle`
--

CREATE TABLE IF NOT EXISTS `blue_product_bundle` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `enabled` tinyint(1) unsigned DEFAULT '1',
  `sort_order` int(11) unsigned NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_product_bundle_detail`
--

CREATE TABLE IF NOT EXISTS `blue_product_bundle_detail` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_bundle_id` int(11) unsigned NOT NULL,
  `product_id` int(11) unsigned DEFAULT NULL,
  `price` decimal(13,5) NOT NULL DEFAULT '0.00000',
  `measure_unit` varchar(255) NOT NULL DEFAULT '',
  `quantity` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `discount` decimal(10,5) NOT NULL DEFAULT '0.00000',
  `discount_value` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total_net` decimal(10,2) NOT NULL DEFAULT '0.00',
  `tax_rate_id` int(11) unsigned DEFAULT NULL,
  `vat` decimal(10,2) NOT NULL DEFAULT '0.00',
  `vat_value` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `work_time` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total_work_time` decimal(10,2) NOT NULL DEFAULT '0.00',
  `notes` text,
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `fk_product_bundle_id_blue_product_bundle_id` (`product_bundle_id`),
  KEY `fk_product_id_blue_product_id` (`product_id`),
  KEY `fk_product_bundle_detail_tax_rate_id_blue_tax_rate_id` (`tax_rate_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_product_group`
--

CREATE TABLE IF NOT EXISTS `blue_product_group` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `enabled` tinyint(1) unsigned DEFAULT '1',
  `sort_order` int(11) unsigned NOT NULL DEFAULT '0',
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_resource_price`
--

CREATE TABLE IF NOT EXISTS `blue_resource_price` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `dimension_id` int(11) unsigned NOT NULL,
  `period_id` int(11) unsigned NOT NULL,
  `contract_duration_id` int(11) unsigned NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `vat` decimal(10,2) NOT NULL DEFAULT '0.00',
  `vat_value` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total_vat` decimal(10,2) NOT NULL DEFAULT '0.00',
  `sort_order` int(11) unsigned NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `fk_resource_price_dimension_id_blue_dimensioni_dmensione_id` (`dimension_id`),
  KEY `fk_resource_price_period_id_blue_resource_price_period_id` (`period_id`),
  KEY `fk_resource_price_contract_duration_id_blue_contract_duration_id` (`contract_duration_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_resource_price_period`
--

CREATE TABLE IF NOT EXISTS `blue_resource_price_period` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `year` int(11) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `sort_order` int(11) unsigned NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_scadenze`
--

CREATE TABLE IF NOT EXISTS `blue_scadenze` (
  `scadenza_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `scadenza_data` date DEFAULT NULL,
  `scadenza_descrizione_breve` varchar(200) DEFAULT NULL,
  `scadenza_descrizione_lunga` text,
  `scadenza_file` varchar(200) DEFAULT NULL,
  `scadenza_status` enum('Aperto','Chiuso') DEFAULT 'Aperto',
  `scadenza_data_chiusura` date DEFAULT NULL,
  PRIMARY KEY (`scadenza_id`),
  KEY `descrizione_breve` (`scadenza_descrizione_breve`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_supply_column`
--

CREATE TABLE IF NOT EXISTS `blue_supply_column` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `external_id` text,
  `name` varchar(255) NOT NULL,
  `pier_id` int(3) unsigned NOT NULL,
  `enabled` tinyint(1) unsigned DEFAULT '1',
  `sort_order` int(11) unsigned NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `fk_supply_column_pier_id_blue_pier_id` (`pier_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_supply_column_status`
--

CREATE TABLE IF NOT EXISTS `blue_supply_column_status` (
  `column_id` int(11) unsigned NOT NULL,
  `power1_supply_key_id` int(11) unsigned DEFAULT NULL,
  `power2_supply_key_id` int(11) unsigned DEFAULT NULL,
  `power3_supply_key_id` int(11) unsigned DEFAULT NULL,
  `power4_supply_key_id` int(11) unsigned DEFAULT NULL,
  `water1_supply_key_id` int(11) unsigned DEFAULT NULL,
  `water2_supply_key_id` int(11) unsigned DEFAULT NULL,
  `water3_supply_key_id` int(11) unsigned DEFAULT NULL,
  `water4_supply_key_id` int(11) unsigned DEFAULT NULL,
  `power1_credit` decimal(10,2) NOT NULL DEFAULT '0.00',
  `power2_credit` decimal(10,2) NOT NULL DEFAULT '0.00',
  `power3_credit` decimal(10,2) NOT NULL DEFAULT '0.00',
  `power4_credit` decimal(10,2) NOT NULL DEFAULT '0.00',
  `water1_credit` decimal(10,2) NOT NULL DEFAULT '0.00',
  `water2_credit` decimal(10,2) NOT NULL DEFAULT '0.00',
  `water3_credit` decimal(10,2) NOT NULL DEFAULT '0.00',
  `water4_credit` decimal(10,2) NOT NULL DEFAULT '0.00',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`column_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_supply_consumption`
--

CREATE TABLE IF NOT EXISTS `blue_supply_consumption` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `external_id` text,
  `supply_column_id` int(11) unsigned NOT NULL,
  `supply_key_id` int(11) unsigned DEFAULT NULL,
  `customer_id` int(11) unsigned DEFAULT NULL,
  `start` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `end` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `contract_id` int(11) unsigned DEFAULT NULL,
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `fk_supply_consumption_supply_column_id_blue_supply_column_id` (`supply_column_id`),
  KEY `fk_supply_consumption_customer_id_blue_clienti_cliente_id` (`customer_id`),
  KEY `fk_supply_consumption_contract_id_blue_contract_id` (`contract_id`),
  KEY `fk_supply_consumption_supply_key_id_blue_supply_key_id` (`supply_key_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_supply_key`
--

CREATE TABLE IF NOT EXISTS `blue_supply_key` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `external_id` text,
  `vector_id` int(11) unsigned DEFAULT NULL,
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `credit` decimal(10,2) NOT NULL DEFAULT '0.00',
  `enabled` tinyint(1) unsigned DEFAULT '1',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `fk_supply_key_vector_id_blue_barche_barca_id` (`vector_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_system_template`
--

CREATE TABLE IF NOT EXISTS `blue_system_template` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `scope` varchar(255) NOT NULL,
  `language` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `text_content` text,
  `html_content` text,
  `header_id` int(11) unsigned DEFAULT NULL,
  `footer_id` int(11) unsigned DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `fk_system_template_header_id_blue_system_template_id` (`header_id`),
  KEY `fk_system_template_footer_id_blue_system_template_id` (`footer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dump dei dati per la tabella `blue_system_template`
--

INSERT INTO `blue_system_template` (`id`, `scope`, `language`, `name`, `description`, `text_content`, `html_content`, `header_id`, `footer_id`, `sort_order`, `create_time`, `update_time`) VALUES
(1, 'PRINT_FOOTER', 'en', 'Footer print', 'Footer for all print', '---------------------', '<table style="width: 100%;"><tr><td>{$footer_date}</td><td align="right">Page CURRENT_PAGE / TOTAL_PAGES</td></tr></table>', NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'PRINT_HEADER', 'en', 'Header print', 'Header for all print', '{$smarty.const.APPLICATION_COMPANY_NAME}\\n---------------------', '<h2>{$smarty.const.APPLICATION_COMPANY_NAME}</h2> <hr />', NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'PRINT_INVOICE', 'en', 'Invoice print', 'Invoice print', 'Hello, this invoice is for {$invoice->customer->cliente_nominativo}', '<h1>{$invoice.type.name}&nbsp;{if $invoice.invoice_number}{$invoice.type.prefix}{$invoice.invoice_number}{else}{$invoice.id}{/if}</h1>\n<p>{$invoice.billing_header}<br /> {$invoice.billing_address}<br /> {$invoice.billing_zip}, {$invoice.billing_city}, {$invoice.billing_province}<br /> {$invoice.billing_country}<br /> {$invoice.billing_tax}</p>\n<p>{if $invoice.status.unpaid}Date: {$invoice_date}<br />Due date: {$invoice_due_date} {elseif $invoice.status.paid}Date: {$invoice_date_paid} {else}Date: {$invoice_date}{/if}</p>\n<table style="border: 1px solid black; width: 100%;" cellpadding="2" cellspacing="2">\n<thead>\n<tr><th>Description</th><th>Price</th><th>Quantity</th><th>Vat</th><th>Discount</th><th>Sub total</th></tr>\n</thead>\n<tbody><!-- {foreach $invoice.invoiceRows as $k => $v} --> <!-- {cycle values="#eeeeee,#d0d0d0" assign="trcolor"} -->\n<tr style="background-color: {$trcolor};">\n<td>{$v.description}</td>\n<td style="text-align: right;">{$v.price}</td>\n<td style="text-align: right;">{$v.quantity}</td>\n<td style="text-align: right;">{$v.vat}</td>\n<td style="text-align: right;">{$v.discount}</td>\n<td style="text-align: right;">{$v.total}</td>\n</tr>\n<!-- {/foreach} --></tbody>\n</table>\n<table style="width: 100%;" cellpadding="4">\n<thead>\n<tr><th align="center">Net total</th><th align="center">VAT total</th><th align="center">Discount total</th><th align="center"><strong>Invoice&nbsp;total</strong></th></tr>\n</thead>\n<tbody>\n<tr>\n<td align="right">{$invoice.net_total}</td>\n<td align="right">{$invoice.vat_total}</td>\n<td align="right">{$invoice.discount_total}</td>\n<td align="right"><strong>{$invoice.total}</strong></td>\n</tr>\n</tbody>\n</table>\n<h2>Notes:</h2>\n<p>{$invoice.notes|nl2br}</p>', NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'PRINT_ORDER', 'en', 'Order print', 'Order print', 'Hello, this is order is for {$order->customer->cliente_nominativo}', '<h1><img alt="" src="../upload/images/c16b1bae13aaa7b8c8e21e76b810539d.png" style="height:440px; width:440px" />Order #{$order.id} {if $order.work_number} - Work number #{$order.work_number} {/if}</h1>\r\n\r\n<h2>Client: {$order.customer.cliente_nominativo} {if $order.vector !== null}<br />\r\nVector: {$order.vector.barca_nome} {$order.vector.barca_targa} {/if}</h2>\r\n\r\n<p>Date: {$order_date}<br />\r\nWork date: {$order_work_date}<br />\r\nDue date: {$order_due_date}</p>\r\n\r\n<table cellpadding="2" style="border:1px solid black; width:100%">\r\n	<thead>\r\n		<tr>\r\n			<th>Product</th>\r\n			<th>Price</th>\r\n			<th>Quantity</th>\r\n			<th>Vat</th>\r\n			<th>Discount</th>\r\n			<th>Sub total</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody><!-- {foreach $order.orderDetails as $k => $v} -->\r\n		<tr>\r\n			<td>{$v.product.name}</td>\r\n			<td style="text-align:right">{$v.price}</td>\r\n			<td style="text-align:right">{$v.quantity}</td>\r\n			<td style="text-align:right">{$v.vat}</td>\r\n			<td style="text-align:right">{$v.discount}</td>\r\n			<td style="text-align:right">{$v.total}</td>\r\n		</tr>\r\n		<!-- {/foreach} -->\r\n	</tbody>\r\n</table>\r\n\r\n<table cellpadding="4" style="width:100%">\r\n	<thead>\r\n		<tr>\r\n			<th>Net total</th>\r\n			<th>VAT total</th>\r\n			<th>Discount total</th>\r\n			<th><strong>Order total</strong></th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>{$order.net_total}</td>\r\n			<td>{$order.vat_total}</td>\r\n			<td>{$order.discount_total}</td>\r\n			<td><strong>{$order.total}</strong></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<h2>Notes:</h2>\r\n\r\n<p>{$order.notes|nl2br}</p>\r\n', NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'PRINT_CONTRACT', 'en', 'Print contract', 'Print contract', 'Hello, this is contract is for {$contract->contractor2->fullname}', '<p>{$contract.contractor1.fullname}</p>\n\n<p><strong>Customer</strong><br />\n{$contract.contractor2.fullname}, {$contract.contractor2.complete_address}</p>\n\n<p><strong>Vector</strong><br />\n{$contract.vector.name}, {$contract.vector.length} m.</p>\n\n<p><strong>Resource</strong><br />\n{$contract.resource.pier.pontile_codice} {$contract.resource.number}</p>\n\n<p><strong>Date:</strong> {$contract_date}, From {$contract_date_start} to {$contract_date_end}</p>\n\n<p>Terms of service</p>\n\n<p>Cras mattis consectetur purus sit amet fermentum. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Donec id elit non mi porta gravida at eget metus. Donec id elit non mi porta gravida at eget metus. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>\n', NULL, NULL, 0, '2014-06-18 12:45:29', '0000-00-00 00:00:00'),
(9, 'PRINT_CONTRACT', 'it', 'Contratto di ormeggio', 'Contratto di ormeggio', 'Hello, this is contract is for {$contract->contractor2->fullname}', '<p>{$contract.contractor1.fullname}</p>\n\n<p><strong>Cliente</strong><br />\n{$contract.contractor2.fullname}, {$contract.contractor2.complete_address}</p>\n\n<p><strong>Imbarcazione</strong><br />\n{$contract.vector.name}, {$contract.vector.length} m.</p>\n\n<p><strong>Posto barca</strong><br />\n{$contract.resource.pier.pontile_codice} {$contract.resource.number}</p>\n\n<p><strong>Data:</strong> {$contract_date}, Dal {$contract_date_start} al {$contract_date_end}</p>\n\n<p>Termini e condizioni del servizio</p>\n\n<p>\nInserire qua i termini e le condizioni del servizio.\n</p>\n', NULL, NULL, 0, '2014-06-18 12:45:29', '0000-00-00 00:00:00'),
(10, 'PRINT_ORDER', 'it', 'Ordine di lavorazione', 'Stampa ordine di lavorazione', '', '<h1><img alt="" height="440" src="../upload/images/c16b1bae13aaa7b8c8e21e76b810539d.png" width="440" />Order #{$order.id} {if $order.work_number} - Work number #{$order.work_number} {/if}</h1>\r\n\r\n<h2>Client: {$order.customer.cliente_nominativo} {if $order.vector !== null}<br />\r\nVector: {$order.vector.barca_nome} {$order.vector.barca_targa} {/if}</h2>\r\n\r\n<p>Date: {$order_date}<br />\r\nWork date: {$order_work_date}<br />\r\nDue date: {$order_due_date}</p>\r\n\r\n<table cellpadding="2" style="border:1px solid black; width:100%">\r\n	<thead>\r\n		<tr>\r\n			<th>Product</th>\r\n			<th>Price</th>\r\n			<th>Quantity</th>\r\n			<th>Vat</th>\r\n			<th>Discount</th>\r\n			<th>Sub total</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody><!-- {foreach $order.orderDetails as $k => $v} -->\r\n		<tr>\r\n			<td>{$v.product.name}</td>\r\n			<td style="text-align:right">{$v.price}</td>\r\n			<td style="text-align:right">{$v.quantity}</td>\r\n			<td style="text-align:right">{$v.vat}</td>\r\n			<td style="text-align:right">{$v.discount}</td>\r\n			<td style="text-align:right">{$v.total}</td>\r\n		</tr>\r\n		<!-- {/foreach} -->\r\n	</tbody>\r\n</table>\r\n\r\n<table cellpadding="4" style="width:100%">\r\n	<thead>\r\n		<tr>\r\n			<th>Net total</th>\r\n			<th>VAT total</th>\r\n			<th>Discount total</th>\r\n			<th><strong>Order total</strong></th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>{$order.net_total}</td>\r\n			<td>{$order.vat_total}</td>\r\n			<td>{$order.discount_total}</td>\r\n			<td><strong>{$order.total}</strong></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<h2>Notes:</h2>\r\n\r\n<p>{$order.notes|nl2br}</p>\r\n', NULL, NULL, 0, '2014-06-18 12:56:59', '0000-00-00 00:00:00'),
(11, 'PRINT_INVOICE', 'it', 'Fattura', 'Stampa fattura', '', '<h1>{$invoice.type.name}&nbsp;{if $invoice.invoice_number}{$invoice.type.prefix}{$invoice.invoice_number}{else}{$invoice.id}{/if}</h1>\r\n\r\n<p>{$invoice.billing_header}<br />\r\n{$invoice.billing_address}<br />\r\n{$invoice.billing_zip}, {$invoice.billing_city}, {$invoice.billing_province}<br />\r\n{$invoice.billing_country}<br />\r\n{$invoice.billing_tax}</p>\r\n\r\n<p>{if $invoice.status.unpaid}Date: {$invoice_date}<br />\r\nDue date: {$invoice_due_date} {elseif $invoice.status.paid}Date: {$invoice_date_paid} {else}Date: {$invoice_date}{/if}</p>\r\n\r\n<table cellpadding="2" cellspacing="2" style="border:1px solid black; width:100%">\r\n	<thead>\r\n		<tr>\r\n			<th>Description</th>\r\n			<th>Price</th>\r\n			<th>Quantity</th>\r\n			<th>Vat</th>\r\n			<th>Discount</th>\r\n			<th>Sub total</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody><!-- {foreach $invoice.invoiceRows as $k => $v} --><!-- {cycle values="#eeeeee,#d0d0d0" assign="trcolor"} -->\r\n		<tr>\r\n			<td>{$v.description}</td>\r\n			<td style="text-align:right">{$v.price}</td>\r\n			<td style="text-align:right">{$v.quantity}</td>\r\n			<td style="text-align:right">{$v.vat}</td>\r\n			<td style="text-align:right">{$v.discount}</td>\r\n			<td style="text-align:right">{$v.total}</td>\r\n		</tr>\r\n		<!-- {/foreach} -->\r\n	</tbody>\r\n</table>\r\n\r\n<table cellpadding="4" style="width:100%">\r\n	<thead>\r\n		<tr>\r\n			<th>Net total</th>\r\n			<th>VAT total</th>\r\n			<th>Discount total</th>\r\n			<th><strong>Invoice&nbsp;total</strong></th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>{$invoice.net_total}</td>\r\n			<td>{$invoice.vat_total}</td>\r\n			<td>{$invoice.discount_total}</td>\r\n			<td><strong>{$invoice.total}</strong></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<h2>Notes:</h2>\r\n\r\n<p>{$invoice.notes|nl2br}</p>\r\n', NULL, NULL, 0, '2014-06-18 12:57:23', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_table_columns`
--

CREATE TABLE IF NOT EXISTS `blue_table_columns` (
  `id` varchar(255) NOT NULL,
  `data` text,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_tax_rate`
--

CREATE TABLE IF NOT EXISTS `blue_tax_rate` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `vat` decimal(10,2) NOT NULL DEFAULT '0.00',
  `sort_order` int(11) DEFAULT NULL,
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dump dei dati per la tabella `blue_tax_rate`
--

INSERT INTO `blue_tax_rate` (`id`, `name`, `vat`, `sort_order`, `create_time`, `update_time`) VALUES
(1, 'IVA al 22%', 22.00, 1, '2014-06-18 12:45:32', '0000-00-00 00:00:00'),
(2, 'IVA al 10%', 10.00, 2, '2014-06-18 12:45:32', '0000-00-00 00:00:00'),
(3, 'IVA al 4%', 4.00, 3, '2014-06-18 12:45:32', '0000-00-00 00:00:00'),
(4, 'Esente IVA', 0.00, 4, '2014-06-18 12:45:32', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_transaction`
--

CREATE TABLE IF NOT EXISTS `blue_transaction` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) unsigned NOT NULL,
  `currency` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `gateway` varchar(255) NOT NULL DEFAULT '',
  `date` date NOT NULL DEFAULT '0000-00-00',
  `amount_in` decimal(10,2) NOT NULL DEFAULT '0.00',
  `amount_out` decimal(10,2) NOT NULL DEFAULT '0.00',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `fk_transaction_invoice_id_blue_invoice_id` (`invoice_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_user`
--

CREATE TABLE IF NOT EXISTS `blue_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `username` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `role` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_uniq_username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dump dei dati per la tabella `blue_user`
--

INSERT INTO `blue_user` (`id`, `name`, `username`, `password`, `role`, `email`, `mobile`, `create_time`, `update_time`) VALUES
(1, 'Amministratore', 'admin', '$1$nLq1k0AM$yRWJ0NZzDVzJ/6A.6KXNm/', '["ADMIN"]', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Emanuele Deserti', 'emanuele', '$6$.DxO6FS1fuqr$MCeHZhAgL4h2N.mPsiro2G4lPxIlotGWLqRfQxYK4uVkptxzr4CsgJQ7uBBGNGnGqYsgI8XUrl0YjFDfJ6OwW0', '["ADMIN"]', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_utenti`
--

CREATE TABLE IF NOT EXISTS `blue_utenti` (
  `utente_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `utente_username` varchar(50) DEFAULT NULL,
  `utente_password` varchar(32) DEFAULT NULL,
  `utente_nominativo` varchar(150) DEFAULT NULL,
  `utente_telefono` varchar(20) DEFAULT NULL,
  `utente_email` varchar(100) DEFAULT NULL,
  `utente_accesso_principale` enum('N','R','W') DEFAULT 'N',
  `utente_accesso_contratti` enum('N','R','W') DEFAULT 'N',
  `utente_accesso_anagrafica` enum('N','R','W') DEFAULT 'N',
  `utente_accesso_imbarcazioni` enum('N','R','W') DEFAULT 'N',
  `utente_accesso_posti_barca` enum('N','R','W') DEFAULT 'N',
  `utente_accesso_documenti` enum('N','R','W') DEFAULT 'N',
  `utente_accesso_fatture` enum('N','R','W') DEFAULT 'N',
  `utente_accesso_template` enum('N','R','W') DEFAULT 'N',
  `utente_accesso_listini` enum('N','R','W') DEFAULT 'N',
  `utente_accesso_preferenze` enum('N','R','W') DEFAULT 'N',
  PRIMARY KEY (`utente_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_vector_crew`
--

CREATE TABLE IF NOT EXISTS `blue_vector_crew` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `vector_id` int(10) unsigned NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `identity_document` varchar(255) DEFAULT NULL,
  `identity_number` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `rating` int(11) unsigned DEFAULT '0',
  `notes` text,
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `idx_vector_crew_first_name` (`first_name`),
  KEY `idx_vector_crew_last_name` (`last_name`),
  KEY `idx_vector_crew_role` (`role`),
  KEY `fk_vector_crew_vector_id_blue_vector_id` (`vector_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_vector_engine`
--

CREATE TABLE IF NOT EXISTS `blue_vector_engine` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `vector_id` int(10) unsigned NOT NULL,
  `builder` varchar(255) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `main_plate` varchar(255) NOT NULL,
  `main_year` varchar(4) DEFAULT NULL,
  `secondary_plate` varchar(255) DEFAULT NULL,
  `secondary_year` varchar(4) DEFAULT NULL,
  `hp_power` decimal(10,2) DEFAULT NULL,
  `kw_power` decimal(10,2) DEFAULT NULL,
  `fuel` varchar(255) DEFAULT NULL,
  `cylinder_capacity` decimal(10,2) DEFAULT NULL,
  `cylinder_quantity` decimal(10,2) DEFAULT NULL,
  `stroke` decimal(2,0) DEFAULT NULL,
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `idx_vector_engine_builder` (`builder`),
  KEY `idx_vector_engine_model` (`model`),
  KEY `idx_vector_engine_type` (`type`),
  KEY `idx_vector_engine_main_plate` (`main_plate`),
  KEY `idx_vector_engine_secondary_plate` (`secondary_plate`),
  KEY `fk_vector_engine_vector_id_blue_vector_id` (`vector_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_vector_equipment`
--

CREATE TABLE IF NOT EXISTS `blue_vector_equipment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `vector_id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `length` decimal(10,2) DEFAULT NULL,
  `width` decimal(10,2) DEFAULT NULL,
  `height` decimal(10,2) DEFAULT NULL,
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `idx_vector_equipment_name` (`name`),
  KEY `fk_vector_equipment_vector_id_blue_vector_id` (`vector_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_vector_identification`
--

CREATE TABLE IF NOT EXISTS `blue_vector_identification` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `vector_id` int(10) unsigned NOT NULL,
  `type` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL DEFAULT '',
  `date` date NOT NULL DEFAULT '0000-00-00',
  `expire` date NOT NULL DEFAULT '0000-00-00',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `fk_vector_identification_customer_idblue_clienti_cliente_id` (`vector_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue_vector_type`
--

CREATE TABLE IF NOT EXISTS `blue_vector_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `stroke_dash` varchar(10) NOT NULL DEFAULT '',
  `color` varchar(255) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dump dei dati per la tabella `blue_vector_type`
--

INSERT INTO `blue_vector_type` (`id`, `name`, `stroke_dash`, `color`, `create_time`, `update_time`) VALUES
(1, 'barca a motore', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'barca a vela', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'catamarano', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'trimarano', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'motopesca', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'gommone', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'natante', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'varie', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'auto', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'camion', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'autobus', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'roulotte', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'camper', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struttura della tabella `blue__DEPRECATED_fatture`
--

CREATE TABLE IF NOT EXISTS `blue__DEPRECATED_fatture` (
  `fattura_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fattura_cliente_id` int(10) DEFAULT NULL,
  `fattura_numero` varchar(11) DEFAULT NULL,
  `fattura_data` date DEFAULT NULL,
  `fattura_condizioni_pagamento` varchar(250) DEFAULT NULL,
  `fattura_spese_incasso` decimal(10,2) DEFAULT NULL,
  `fattura_spese_trasporto` decimal(10,2) DEFAULT NULL,
  `fattura_bolli` decimal(10,2) DEFAULT NULL,
  `fattura_pagata` int(1) DEFAULT '0',
  `fattura_esente_iva` enum('0','1') DEFAULT '0',
  `fattura_motivo_esente_iva` varchar(250) DEFAULT '',
  `fattura_contratto_id` int(11) DEFAULT '0',
  `fattura_varie` enum('0','1') DEFAULT '0',
  `fattura_spese_condominiali` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`fattura_id`),
  KEY `fattura_cliente_id` (`fattura_cliente_id`),
  KEY `fattura_numero` (`fattura_numero`),
  KEY `fattura_data` (`fattura_data`),
  KEY `fattura_contratto_id` (`fattura_contratto_id`),
  KEY `fattura_cliente_id_2` (`fattura_cliente_id`),
  KEY `fattura_numero_2` (`fattura_numero`),
  KEY `fattura_data_2` (`fattura_data`),
  KEY `fattura_contratto_id_2` (`fattura_contratto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue__DEPRECATED_fatture_righe`
--

CREATE TABLE IF NOT EXISTS `blue__DEPRECATED_fatture_righe` (
  `fattura_riga_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fattura_riga_fattura_id` int(10) DEFAULT NULL,
  `fattura_riga_descrizione` varchar(250) DEFAULT NULL,
  `fattura_riga_um` varchar(20) DEFAULT NULL,
  `fattura_riga_quantita` float DEFAULT NULL,
  `fattura_riga_listino` decimal(10,2) DEFAULT NULL,
  `fattura_riga_imponibile` decimal(10,2) DEFAULT NULL,
  `fattura_riga_sconto` float DEFAULT '0',
  `fattura_riga_iva` float DEFAULT NULL,
  `fattura_riga_totale` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`fattura_riga_id`),
  KEY `fattura_riga_fattura_id` (`fattura_riga_fattura_id`),
  KEY `fattura_riga_descrizione` (`fattura_riga_descrizione`),
  KEY `fattura_riga_fattura_id_2` (`fattura_riga_fattura_id`),
  KEY `fattura_riga_descrizione_2` (`fattura_riga_descrizione`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue__DEPRECATED_listini_generici`
--

CREATE TABLE IF NOT EXISTS `blue__DEPRECATED_listini_generici` (
  `listino_generico_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `listino_generico_anno` int(4) DEFAULT NULL,
  `listino_generico_descrizione` varchar(250) DEFAULT NULL,
  `listino_generico_costo` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`listino_generico_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue__DEPRECATED_nazioni`
--

CREATE TABLE IF NOT EXISTS `blue__DEPRECATED_nazioni` (
  `nazione_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nazione_nome` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`nazione_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue__DEPRECATED_presenze`
--

CREATE TABLE IF NOT EXISTS `blue__DEPRECATED_presenze` (
  `presenza_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `presenza_posto_barca` int(11) DEFAULT NULL,
  `presenza_cliente` int(11) DEFAULT NULL,
  `presenza_barca` int(10) DEFAULT NULL,
  `presenza_arrivo` date DEFAULT NULL,
  `presenza_partenza` date DEFAULT NULL,
  PRIMARY KEY (`presenza_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue__DEPRECATED_province`
--

CREATE TABLE IF NOT EXISTS `blue__DEPRECATED_province` (
  `provincia_nome` varchar(150) NOT NULL DEFAULT '',
  `provincia_sigla` char(2) NOT NULL DEFAULT '',
  PRIMARY KEY (`provincia_sigla`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `blue__DEPRECATED_tipologie_barche`
--

CREATE TABLE IF NOT EXISTS `blue__DEPRECATED_tipologie_barche` (
  `tipologia_barca_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `tipologia_barca_nome` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`tipologia_barca_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dump dei dati per la tabella `blue__DEPRECATED_tipologie_barche`
--

INSERT INTO `blue__DEPRECATED_tipologie_barche` (`tipologia_barca_id`, `tipologia_barca_nome`) VALUES
(1, 'barca a motore'),
(2, 'barca a vela'),
(3, 'catamarano'),
(4, 'trimarano'),
(5, 'motopesca'),
(6, 'gommone'),
(7, 'natante'),
(8, 'varie'),
(9, 'auto'),
(10, 'camion'),
(11, 'autobus'),
(12, 'roulotte'),
(13, 'camper');

-- --------------------------------------------------------

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `blue_access_authorization`
--
ALTER TABLE `blue_access_authorization`
  ADD CONSTRAINT `fk_access_authorization_resource_id_blue_resource_id` FOREIGN KEY (`resource_id`) REFERENCES `blue_posti_barca` (`posto_barca_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `blue_access_authorization_log`
--
ALTER TABLE `blue_access_authorization_log`
  ADD CONSTRAINT `fk_access_authorization_id_blue_access_authorization_id` FOREIGN KEY (`access_authorization_id`) REFERENCES `blue_access_authorization` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `blue_auth_assignment`
--
ALTER TABLE `blue_auth_assignment`
  ADD CONSTRAINT `fk_blue_itemname` FOREIGN KEY (`itemname`) REFERENCES `blue_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `blue_auth_item_child`
--
ALTER TABLE `blue_auth_item_child`
  ADD CONSTRAINT `fk_child_blue_auth_item_name` FOREIGN KEY (`child`) REFERENCES `blue_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_parent_blue_auth_item_name` FOREIGN KEY (`parent`) REFERENCES `blue_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `blue_barche`
--
ALTER TABLE `blue_barche`
  ADD CONSTRAINT `fk_vector_type_id_blue_vector_type_id` FOREIGN KEY (`type_id`) REFERENCES `blue_vector_type` (`id`);

--
-- Limiti per la tabella `blue_contract`
--
ALTER TABLE `blue_contract`
  ADD CONSTRAINT `fk_contract_resource_id_blue_posti_barca_posto_barca_id` FOREIGN KEY (`resource_id`) REFERENCES `blue_posti_barca` (`posto_barca_id`),
  ADD CONSTRAINT `fk_contract_contractor1_id_blue_clienti_cliente_id` FOREIGN KEY (`contractor1_id`) REFERENCES `blue_clienti` (`cliente_id`),
  ADD CONSTRAINT `fk_contract_contractor2_id_blue_clienti_cliente_id` FOREIGN KEY (`contractor2_id`) REFERENCES `blue_clienti` (`cliente_id`),
  ADD CONSTRAINT `fk_contract_duration_id_blue_contract_duration_id` FOREIGN KEY (`duration_id`) REFERENCES `blue_contract_duration` (`id`),
  ADD CONSTRAINT `fk_contract_type_id_blue_contract_type_id` FOREIGN KEY (`type_id`) REFERENCES `blue_contract_type` (`id`),
  ADD CONSTRAINT `fk_contract_vector_id_blue_barche_barca_id` FOREIGN KEY (`vector_id`) REFERENCES `blue_barche` (`barca_id`);

--
-- Limiti per la tabella `blue_contract_detail`
--
ALTER TABLE `blue_contract_detail`
  ADD CONSTRAINT `fk_contract_detail_resource_price_id_blue_resource_price_id` FOREIGN KEY (`resource_price_id`) REFERENCES `blue_resource_price` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_contract_detail_contract_id_blue_contract_id` FOREIGN KEY (`contract_id`) REFERENCES `blue_contract` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `blue_customer_identification`
--
ALTER TABLE `blue_customer_identification`
  ADD CONSTRAINT `fk_customer_identification_customer_idblue_clienti_cliente_id` FOREIGN KEY (`customer_id`) REFERENCES `blue_clienti` (`cliente_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `blue_dimensioni`
--
ALTER TABLE `blue_dimensioni`
  ADD CONSTRAINT `fk_dimensioni_type_id_blue_dimension_type_id` FOREIGN KEY (`type_id`) REFERENCES `blue_dimension_type` (`id`);

--
-- Limiti per la tabella `blue_hint`
--
ALTER TABLE `blue_hint`
  ADD CONSTRAINT `fk_hint_user_id_blue_user_id` FOREIGN KEY (`user_id`) REFERENCES `blue_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `blue_invoice`
--
ALTER TABLE `blue_invoice`
  ADD CONSTRAINT `fk_invoice_customer_id_blue_clienti_cliente_id` FOREIGN KEY (`customer_id`) REFERENCES `blue_clienti` (`cliente_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_invoice_invoice_id_blue_invoice_id` FOREIGN KEY (`invoice_id`) REFERENCES `blue_invoice` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_invoice_payment_method_id_blue_payment_method_id` FOREIGN KEY (`payment_method_id`) REFERENCES `blue_payment_method` (`id`),
  ADD CONSTRAINT `fk_invoice_status_id_blue_invoice_status_id` FOREIGN KEY (`status_id`) REFERENCES `blue_invoice_status` (`id`),
  ADD CONSTRAINT `fk_invoice_type_id_blue_invoice_type_id` FOREIGN KEY (`type_id`) REFERENCES `blue_invoice_type` (`id`);

--
-- Limiti per la tabella `blue_invoice_payment`
--
ALTER TABLE `blue_invoice_payment`
  ADD CONSTRAINT `fk_invoice_payment_invoice_id_blue_invoice_id` FOREIGN KEY (`invoice_id`) REFERENCES `blue_invoice` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `blue_invoice_row`
--
ALTER TABLE `blue_invoice_row`
  ADD CONSTRAINT `fk_invoice_row_contract_detail_id_blue_contract_detail_id` FOREIGN KEY (`contract_detail_id`) REFERENCES `blue_contract_detail` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_invoice_row_contract_id_blue_contract_id` FOREIGN KEY (`contract_id`) REFERENCES `blue_contract` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_invoice_row_id_blue_invoice_id` FOREIGN KEY (`invoice_id`) REFERENCES `blue_invoice` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_invoice_row_order_detail_id_blue_order_detail_id` FOREIGN KEY (`order_detail_id`) REFERENCES `blue_order_detail` (`id`),
  ADD CONSTRAINT `fk_invoice_row_order_id_blue_order_id` FOREIGN KEY (`order_id`) REFERENCES `blue_order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_invoice_row_tax_rate_id_blue_tax_rate_id` FOREIGN KEY (`tax_rate_id`) REFERENCES `blue_tax_rate` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `blue_order`
--
ALTER TABLE `blue_order`
  ADD CONSTRAINT `fk_order_father_id_blue_order_id` FOREIGN KEY (`father_id`) REFERENCES `blue_order` (`id`),
  ADD CONSTRAINT `fk_order_customer_id_blue_clienti_cliente_id` FOREIGN KEY (`customer_id`) REFERENCES `blue_clienti` (`cliente_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_order_status_id_blue_order_status_id` FOREIGN KEY (`status_id`) REFERENCES `blue_order_status` (`id`),
  ADD CONSTRAINT `fk_order_type_id_blue_order_type_id` FOREIGN KEY (`type_id`) REFERENCES `blue_order_type` (`id`),
  ADD CONSTRAINT `fk_order_vector_id_blue_barche_barca_id` FOREIGN KEY (`vector_id`) REFERENCES `blue_barche` (`barca_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `blue_order_detail`
--
ALTER TABLE `blue_order_detail`
  ADD CONSTRAINT `fk_order_detail_contract_id_blue_contract_id` FOREIGN KEY (`contract_id`) REFERENCES `blue_contract` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_order_detail_father_id_blue_order_detail_id` FOREIGN KEY (`father_id`) REFERENCES `blue_order_detail` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_order_detail_order_id_blue_order_id` FOREIGN KEY (`order_id`) REFERENCES `blue_order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_order_detail_product_id_blue_product_id` FOREIGN KEY (`product_id`) REFERENCES `blue_product` (`id`),
  ADD CONSTRAINT `fk_order_detail_tax_rate_id_blue_tax_rate_id` FOREIGN KEY (`tax_rate_id`) REFERENCES `blue_tax_rate` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `blue_payment_method_rule`
--
ALTER TABLE `blue_payment_method_rule`
  ADD CONSTRAINT `fk_payment_method_rule_payment_method_id_blue_payment_method_id` FOREIGN KEY (`payment_method_id`) REFERENCES `blue_payment_method` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `blue_presence`
--
ALTER TABLE `blue_presence`
  ADD CONSTRAINT `fk_presence_vector_id_blue_vector_id` FOREIGN KEY (`vector_id`) REFERENCES `blue_barche` (`barca_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_presence_customer_id_blue_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `blue_clienti` (`cliente_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_presence_resource_id_blue_resource_id` FOREIGN KEY (`resource_id`) REFERENCES `blue_posti_barca` (`posto_barca_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `blue_product`
--
ALTER TABLE `blue_product`
  ADD CONSTRAINT `fk_product_group_id_blue_product_group_id` FOREIGN KEY (`group_id`) REFERENCES `blue_product_group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_tax_rate_id_blue_tax_rate_id` FOREIGN KEY (`tax_rate_id`) REFERENCES `blue_tax_rate` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `blue_product_bundle_detail`
--
ALTER TABLE `blue_product_bundle_detail`
  ADD CONSTRAINT `fk_product_bundle_detail_tax_rate_id_blue_tax_rate_id` FOREIGN KEY (`tax_rate_id`) REFERENCES `blue_tax_rate` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_bundle_id_blue_product_bundle_id` FOREIGN KEY (`product_bundle_id`) REFERENCES `blue_product_bundle` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_id_blue_product_id` FOREIGN KEY (`product_id`) REFERENCES `blue_product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `blue_resource_price`
--
ALTER TABLE `blue_resource_price`
  ADD CONSTRAINT `fk_resource_price_contract_duration_id_blue_contract_duration_id` FOREIGN KEY (`contract_duration_id`) REFERENCES `blue_contract_duration` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_resource_price_dimension_id_blue_dimensioni_dmensione_id` FOREIGN KEY (`dimension_id`) REFERENCES `blue_dimensioni` (`dimensione_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_resource_price_period_id_blue_resource_price_period_id` FOREIGN KEY (`period_id`) REFERENCES `blue_resource_price_period` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `blue_supply_column`
--
ALTER TABLE `blue_supply_column`
  ADD CONSTRAINT `fk_supply_column_pier_id_blue_pier_id` FOREIGN KEY (`pier_id`) REFERENCES `blue_pontili` (`pontile_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `blue_supply_column_status`
--
ALTER TABLE `blue_supply_column_status`
  ADD CONSTRAINT `fk_supply_column_status_column_id_blue_supply_column_id` FOREIGN KEY (`column_id`) REFERENCES `blue_supply_column` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `blue_supply_consumption`
--
ALTER TABLE `blue_supply_consumption`
  ADD CONSTRAINT `fk_supply_consumption_supply_key_id_blue_supply_key_id` FOREIGN KEY (`supply_key_id`) REFERENCES `blue_supply_key` (`id`),
  ADD CONSTRAINT `fk_supply_consumption_contract_id_blue_contract_id` FOREIGN KEY (`contract_id`) REFERENCES `blue_contract` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_supply_consumption_customer_id_blue_clienti_cliente_id` FOREIGN KEY (`customer_id`) REFERENCES `blue_clienti` (`cliente_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_supply_consumption_supply_column_id_blue_supply_column_id` FOREIGN KEY (`supply_column_id`) REFERENCES `blue_supply_column` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `blue_supply_key`
--
ALTER TABLE `blue_supply_key`
  ADD CONSTRAINT `fk_supply_key_vector_id_blue_barche_barca_id` FOREIGN KEY (`vector_id`) REFERENCES `blue_barche` (`barca_id`);

--
-- Limiti per la tabella `blue_system_template`
--
ALTER TABLE `blue_system_template`
  ADD CONSTRAINT `fk_system_template_footer_id_blue_system_template_id` FOREIGN KEY (`footer_id`) REFERENCES `blue_system_template` (`id`),
  ADD CONSTRAINT `fk_system_template_header_id_blue_system_template_id` FOREIGN KEY (`header_id`) REFERENCES `blue_system_template` (`id`);

--
-- Limiti per la tabella `blue_transaction`
--
ALTER TABLE `blue_transaction`
  ADD CONSTRAINT `fk_transaction_invoice_id_blue_invoice_id` FOREIGN KEY (`invoice_id`) REFERENCES `blue_invoice` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `blue_vector_crew`
--
ALTER TABLE `blue_vector_crew`
  ADD CONSTRAINT `fk_vector_crew_vector_id_blue_vector_id` FOREIGN KEY (`vector_id`) REFERENCES `blue_barche` (`barca_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `blue_vector_engine`
--
ALTER TABLE `blue_vector_engine`
  ADD CONSTRAINT `fk_vector_engine_vector_id_blue_vector_id` FOREIGN KEY (`vector_id`) REFERENCES `blue_barche` (`barca_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `blue_vector_equipment`
--
ALTER TABLE `blue_vector_equipment`
  ADD CONSTRAINT `fk_vector_equipment_vector_id_blue_vector_id` FOREIGN KEY (`vector_id`) REFERENCES `blue_barche` (`barca_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `blue_vector_identification`
--
ALTER TABLE `blue_vector_identification`
  ADD CONSTRAINT `fk_vector_identification_customer_idblue_clienti_cliente_id` FOREIGN KEY (`vector_id`) REFERENCES `blue_barche` (`barca_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
