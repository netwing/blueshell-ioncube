-- MySQL dump 10.9
--
-- Host: localhost    Database: bluedemo
-- ------------------------------------------------------
-- Server version	4.1.13-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `blue_assicurazioni`
--

DROP TABLE IF EXISTS `blue_assicurazioni`;
CREATE TABLE `blue_assicurazioni` (
  `assicurazione_id` int(5) unsigned NOT NULL auto_increment,
  `assicurazione_nome` varchar(200) NOT NULL default '',
  PRIMARY KEY  (`assicurazione_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blue_assicurazioni`
--


/*!40000 ALTER TABLE `blue_assicurazioni` DISABLE KEYS */;
LOCK TABLES `blue_assicurazioni` WRITE;
INSERT INTO `blue_assicurazioni` (`assicurazione_id`, `assicurazione_nome`) VALUES (1,'Ace Insurance SA-NV'),(2,'ADAC'),(3,'Admiral boat insurance'),(4,'Aegeon Company'),(5,'afa maritime'),(6,'Agpm'),(7,'Agrippina'),(8,'Aktiv Assekuranz M.G.M.'),(9,'Alandia Bolagen'),(10,'Allianz'),(11,'Allianz Elementar'),(12,'Allianz subalpina'),(13,'Allianz Tiriac Asigurari'),(14,'Alte Leipziger'),(15,'Amc Marine'),(16,'AncoRas'),(17,'Aon Reed Stenhouse Inc.'),(18,'Assi S.r.l.'),(19,'Assicurazioni Generali'),(20,'Assimoco'),(21,'Assitalia'),(22,'Assurance France Plaisance'),(23,'Aurora'),(24,'Axa Assicurazioni'),(25,'Axa General Insurance'),(26,'Bayerische Assicurazioni'),(27,'Bazerische Versicherungsbank'),(28,'BDM'),(29,'BPB Assicurazioni'),(30,'capitaneria di porto croata'),(31,'Carige Assicurazioni'),(32,'Carnica Assicurazioni'),(33,'Cattolica'),(34,'Certain Underwriters at Lloyd\'s'),(35,'CMA'),(36,'Commercial Union'),(37,'Commercial Union Italia'),(38,'Compagnia di Genova'),(39,'Contrassegno di Assicurazione'),(40,'Courtage Assurance Plaisance'),(41,'COVEA'),(42,'Delta Lloyd'),(43,'Donau allgemeine versicherung-Ag'),(44,'Duomo Assicurazioni'),(45,'Fata'),(46,'FBTO'),(47,'Fondiaria - Sai'),(48,'Fondiaria Assicurazione'),(49,'Frozza Guerrino Assicurazioni'),(50,'Gan'),(51,'GDV'),(52,'Generali Assicurazioni'),(53,'Generali Francia Assicurazioni'),(54,'Generali Lloyd Versicherung AG'),(55,'Genertel'),(56,'Gesamtverband Deutchen Versicherung'),(57,'Gothaer'),(58,'Group Swiss Life (France)'),(59,'Groves John&Westrup Lim.'),(60,'Guida blu'),(61,'GVD'),(62,'Harald &amp; Baum Cie'),(63,'Hdi'),(64,'heath lambert limited'),(65,'hellas yachts insurance'),(66,'Helvetia Assicurazioni'),(67,'HYV'),(68,'Il Duomo'),(69,'Italiana Assicurazioni'),(70,'Itas Assicurazioni'),(71,'kaddar insurance agency ltd'),(72,'katsastusluokat'),(73,'La Fondiaria Assicurazioni'),(74,'La Nationale'),(75,'La Navale'),(76,'La Piemontese Assicurazioni S.p.A.'),(77,'lamas nautica'),(78,'Lazzari Ass.ni'),(79,'Levante Norditalia'),(80,'Lienar Assicurazioni'),(81,'Liguria'),(82,'Linea Guida Blu'),(83,'Linear Assicurazioni'),(84,'Lloyd Adriatico'),(85,'Lloyd Italico'),(86,'Lloyd\'s'),(87,'Lloyd\'s  Marsh Private Client'),(88,'Maa assicurazioni'),(89,'Manfred Falk'),(90,'Mannheimer Versicherung AG'),(91,'Mcm'),(92,'Mediolanum'),(93,'Meie Aurora'),(94,'Menorah'),(95,'Milano Assicurazioni'),(96,'Mnora'),(97,'Mobiliar Versicherung'),(98,'Montmirail SMCA s.a. - Lloyds'),(99,'mutuelles du mans assni'),(100,'Naa'),(101,'Nationale Suisse Assicurazioni'),(102,'Navale Assicurazioni'),(103,'NAVIBLU'),(104,'Navigators &amp;General'),(105,'Nemarf'),(106,'Non Disponibile'),(107,'Nuova Maa Assicurazioni'),(108,'Nuova Tirrenia'),(109,'ouest assurances plaisance'),(110,'Paentaenius'),(111,'Paentaenius Gesmbh'),(112,'Paentaenius Gmbh &amp; Co.'),(113,'Paentaenius Gmbh &amp; Co. Hamburg'),(114,'Paentaenius Monaco'),(115,'Paentaenius UK'),(116,'powszechny zaklad'),(117,'RAS Assicurazioni'),(118,'Sai'),(119,'Sara Assicurazioni'),(120,'Sasa Assicurazioni'),(121,'Schweizer National'),(122,'Schweizer Naz.Vers. AG'),(123,'Shipowners'),(124,'Siegefried Preuss Nachf'),(125,'Slovenica'),(126,'Societ&agrave; Reale Mutua di Assicurazioni'),(127,'st margarets insurance limited'),(128,'Targa Oro'),(129,'Toro Assicurazioni'),(130,'Trenwick/Pantaenius'),(131,'Unipol Assicurazioni'),(132,'uniqa'),(133,'Universo'),(134,'VERONA'),(135,'viaggi generali'),(136,'Vittoria Assicurazioni'),(137,'VS'),(138,'Warta'),(139,'Waterborne'),(140,'Wehring &amp; Wolfes GmbH'),(141,'Wengert'),(142,'Wiener Stadtische'),(143,'Winterthur'),(144,'Wuba'),(145,'Yachtinsurance'),(146,'Yachtline'),(147,'Zavarovalnica Triglav'),(148,'Zuerich Agrippina'),(149,'Zuricar'),(150,'Zurich'),(151,'Zurich Agrippina'),(152,'Zurigo'),(153,'Zurigo Assicurazioni'),(154,'Zurigo Permare'),(155,'Yanmar EO2400'),(156,'FRANCE PLAISANCE ASSURANCE'),(157,'Aviva'),(158,'ANKER'),(159,'REALE MUTUA'),(160,'BPU Assicurazioni'),(161,'PLAN NAUTICA'),(162,'AVIVA ITALIA S.P.A.'),(163,'AUGUSTA ASSICURAZIONI'),(164,'Aviva Italia S.p.a.'),(165,'matmut'),(166,'Royal & Sunalliance'),(167,'Reale Mutua'),(168,'Reale Mutua'),(169,'GENERTEL'),(170,'MAAF Assurances'),(171,'Deutscher Yacht-Pool'),(172,'Adriatic Slovenica'),(173,'Nord Deutsche');
UNLOCK TABLES;
/*!40000 ALTER TABLE `blue_assicurazioni` ENABLE KEYS */;

--
-- Table structure for table `blue_barche`
--

DROP TABLE IF EXISTS `blue_barche`;
CREATE TABLE `blue_barche` (
  `barca_id` int(10) unsigned NOT NULL auto_increment,
  `barca_nome` varchar(150) default NULL,
  `barca_tipologia_barca` int(5) default '1',
  `barca_nazione` int(11) default '1',
  `barca_costruttore` int(5) default '1',
  `barca_modello` varchar(100) default NULL,
  `barca_anno` varchar(10) default NULL,
  `barca_lunghezza` float default '0',
  `barca_larghezza` float default '0',
  `barca_pescaggio` float default '0',
  `barca_motore` varchar(50) default NULL,
  `barca_matricola_motore1` varchar(20) default NULL,
  `barca_matricola_motore2` varchar(20) default NULL,
  `barca_targa` varchar(20) default NULL,
  `barca_assicurazione` int(5) default '1',
  `barca_polizza` varchar(20) default NULL,
  `barca_scadenza_polizza` date default NULL,
  `barca_caratteristiche` text,
  `barca_colore` varchar(50) default NULL,
  `barca_proprietario` int(10) unsigned default '0',
  `barca_note` text,
  PRIMARY KEY  (`barca_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blue_barche`
--


/*!40000 ALTER TABLE `blue_barche` DISABLE KEYS */;
LOCK TABLES `blue_barche` WRITE;
INSERT INTO `blue_barche` (`barca_id`, `barca_nome`, `barca_tipologia_barca`, `barca_nazione`, `barca_costruttore`, `barca_modello`, `barca_anno`, `barca_lunghezza`, `barca_larghezza`, `barca_pescaggio`, `barca_motore`, `barca_matricola_motore1`, `barca_matricola_motore2`, `barca_targa`, `barca_assicurazione`, `barca_polizza`, `barca_scadenza_polizza`, `barca_caratteristiche`, `barca_colore`, `barca_proprietario`, `barca_note`) VALUES (194,'Venture',1,120,1,'','',0,0,0,'','','','',0,'','0000-00-00','','',193,'');
UNLOCK TABLES;
/*!40000 ALTER TABLE `blue_barche` ENABLE KEYS */;

--
-- Table structure for table `blue_barche_trasferimenti`
--

DROP TABLE IF EXISTS `blue_barche_trasferimenti`;
CREATE TABLE `blue_barche_trasferimenti` (
  `barca_trasferimento_id` int(11) unsigned NOT NULL auto_increment,
  `barca_trasferimento_barca` int(11) default NULL,
  `barca_trasferimento_da` int(11) default NULL,
  `barca_trasferimento_a` int(11) default NULL,
  `barca_trasferimento_data` date default NULL,
  PRIMARY KEY  (`barca_trasferimento_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blue_barche_trasferimenti`
--


/*!40000 ALTER TABLE `blue_barche_trasferimenti` DISABLE KEYS */;
LOCK TABLES `blue_barche_trasferimenti` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `blue_barche_trasferimenti` ENABLE KEYS */;

--
-- Table structure for table `blue_clienti`
--

DROP TABLE IF EXISTS `blue_clienti`;
CREATE TABLE `blue_clienti` (
  `cliente_id` int(10) unsigned NOT NULL auto_increment,
  `cliente_nominativo` varchar(250) default NULL,
  `cliente_tipo` enum('Persona Fisica','Persona Giuridica') NOT NULL default 'Persona Fisica',
  `cliente_nome` varchar(50) default NULL,
  `cliente_cognome` varchar(50) default NULL,
  `cliente_data_nascita` date default NULL,
  `cliente_luogo_nascita` varchar(150) NOT NULL default '',
  `cliente_indirizzo` varchar(250) default NULL,
  `cliente_citta` varchar(50) default NULL,
  `cliente_cap` varchar(5) default NULL,
  `cliente_provincia` char(2) default NULL,
  `cliente_nazione` int(11) default '1',
  `cliente_telefono1` varchar(30) default NULL,
  `cliente_tipo_telefono1` enum('Abitazione','Cellulare','Ufficio','Fax') NOT NULL default 'Abitazione',
  `cliente_telefono2` varchar(30) default NULL,
  `cliente_tipo_telefono2` enum('Abitazione','Cellulare','Ufficio','Fax') NOT NULL default 'Cellulare',
  `cliente_telefono3` varchar(30) default NULL,
  `cliente_tipo_telefono3` enum('Abitazione','Cellulare','Ufficio','Fax') NOT NULL default 'Ufficio',
  `cliente_email` varchar(150) default NULL,
  `cliente_codice_fiscale` varchar(20) default NULL,
  `cliente_partita_iva` varchar(20) default NULL,
  `cliente_documento` enum('CdI','Patente','Patente Nautica','Passaporto') default 'CdI',
  `cliente_numero_documento` varchar(20) default NULL,
  `cliente_rifiuta_comunicazioni` int(1) default '0',
  `cliente_note` text,
  `data_inserimento_cliente` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`cliente_id`),
  KEY `nome_cliente` (`cliente_nome`),
  KEY `cognome_cliente` (`cliente_cognome`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blue_clienti`
--


/*!40000 ALTER TABLE `blue_clienti` DISABLE KEYS */;
LOCK TABLES `blue_clienti` WRITE;
INSERT INTO `blue_clienti` (`cliente_id`, `cliente_nominativo`, `cliente_tipo`, `cliente_nome`, `cliente_cognome`, `cliente_data_nascita`, `cliente_luogo_nascita`, `cliente_indirizzo`, `cliente_citta`, `cliente_cap`, `cliente_provincia`, `cliente_nazione`, `cliente_telefono1`, `cliente_tipo_telefono1`, `cliente_telefono2`, `cliente_tipo_telefono2`, `cliente_telefono3`, `cliente_tipo_telefono3`, `cliente_email`, `cliente_codice_fiscale`, `cliente_partita_iva`, `cliente_documento`, `cliente_numero_documento`, `cliente_rifiuta_comunicazioni`, `cliente_note`, `data_inserimento_cliente`) VALUES (1,'Porto Stellare spa','Persona Fisica','','Porto Stellare Spa','2009-01-01','','Via del Porto, 100','Ferrara','44100','FE',120,'05321915183','Abitazione','','Cellulare','','Ufficio','','0123456789','0123456789','CdI','',0,'','2009-02-25 14:27:26'),(192,'bluevv','Persona Fisica','Vincenzo','Venezia','0000-00-00','','','','','',120,'082522222','Abitazione','','Cellulare','','Ufficio','','','','CdI','',0,'','2009-08-03 18:26:08'),(193,'Mario Rossi','Persona Fisica','Mario','Rossi','1980-10-10','Ferrara','Ferrara','Ferrara','44100','FE',120,'05321915183','Ufficio','','Cellulare','','Ufficio','','','','CdI','',0,'','2009-08-04 10:10:24');
UNLOCK TABLES;
/*!40000 ALTER TABLE `blue_clienti` ENABLE KEYS */;

--
-- Table structure for table `blue_clienti_note`
--

DROP TABLE IF EXISTS `blue_clienti_note`;
CREATE TABLE `blue_clienti_note` (
  `cliente_nota_id` int(11) unsigned NOT NULL auto_increment,
  `cliente_nota_cliente_id` int(11) default NULL,
  `cliente_nota_data` date default NULL,
  `cliente_nota_contenuto` text,
  `cliente_nota_attiva` enum('0','1') default NULL,
  PRIMARY KEY  (`cliente_nota_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blue_clienti_note`
--


/*!40000 ALTER TABLE `blue_clienti_note` DISABLE KEYS */;
LOCK TABLES `blue_clienti_note` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `blue_clienti_note` ENABLE KEYS */;

--
-- Table structure for table `blue_contratti`
--

DROP TABLE IF EXISTS `blue_contratti`;
CREATE TABLE `blue_contratti` (
  `contratto_id` int(11) unsigned NOT NULL auto_increment,
  `contratto_anagrafica1` int(10) NOT NULL default '0',
  `contratto_anagrafica2` int(10) NOT NULL default '0',
  `contratto_tipo` int(2) NOT NULL default '0',
  `contratto_barca` int(10) NOT NULL default '0',
  `contratto_posto_barca` int(10) NOT NULL default '0',
  `contratto_periodo` int(2) NOT NULL default '0',
  `contratto_data` date NOT NULL default '0000-00-00',
  `contratto_inizio` date NOT NULL default '0000-00-00',
  `contratto_fine` date NOT NULL default '0000-00-00',
  `contratto_numero` varchar(20) NOT NULL default '',
  `contratto_gestione_tipo` int(2) NOT NULL default '0',
  `contratto_gestione_percentuale` float NOT NULL default '0',
  `contratto_note` text NOT NULL,
  `contratto_imponibile` decimal(10,2) default NULL,
  `contratto_totale` decimal(10,2) default NULL,
  `contratto_fatturato` decimal(10,2) default '0.00',
  `contratto_fatturato_chiuso` int(1) NOT NULL default '0',
  `contratto_sconto` float default NULL,
  `contratto_ordine` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`contratto_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blue_contratti`
--


/*!40000 ALTER TABLE `blue_contratti` DISABLE KEYS */;
LOCK TABLES `blue_contratti` WRITE;
INSERT INTO `blue_contratti` (`contratto_id`, `contratto_anagrafica1`, `contratto_anagrafica2`, `contratto_tipo`, `contratto_barca`, `contratto_posto_barca`, `contratto_periodo`, `contratto_data`, `contratto_inizio`, `contratto_fine`, `contratto_numero`, `contratto_gestione_tipo`, `contratto_gestione_percentuale`, `contratto_note`, `contratto_imponibile`, `contratto_totale`, `contratto_fatturato`, `contratto_fatturato_chiuso`, `contratto_sconto`, `contratto_ordine`) VALUES (428,1,193,1,194,156,1,'2009-08-04','2009-08-04','2010-08-04','',0,0,'','0.00','0.00','0.00',0,0,'0000-00-00'),(429,1,192,2,0,161,6,'2009-08-04','2009-08-04','2059-08-04','',0,0,'','0.00','0.00','0.00',0,0,'0000-00-00');
UNLOCK TABLES;
/*!40000 ALTER TABLE `blue_contratti` ENABLE KEYS */;

--
-- Table structure for table `blue_contratti_dettagli`
--

DROP TABLE IF EXISTS `blue_contratti_dettagli`;
CREATE TABLE `blue_contratti_dettagli` (
  `contratto_dettaglio_id` int(11) unsigned NOT NULL auto_increment,
  `contratto_dettaglio_contratto_id` int(11) unsigned NOT NULL default '0',
  `contratto_dettaglio_costo_lettere` varchar(250) default NULL,
  `contratto_dettaglio_iva_lettere` varchar(250) default NULL,
  `contratto_dettaglio_totale_lettere` varchar(250) default NULL,
  `contratto_dettaglio_modalita_pagamento` text,
  `contratto_dettaglio_oneri_anno` varchar(4) default NULL,
  `contratto_dettaglio_oneri_cifra` decimal(10,2) default NULL,
  `contratto_dettaglio_oneri_lettere` varchar(250) default NULL,
  `contratto_dettaglio_oneri_saldabili_mese` varchar(100) default NULL,
  PRIMARY KEY  (`contratto_dettaglio_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blue_contratti_dettagli`
--


/*!40000 ALTER TABLE `blue_contratti_dettagli` DISABLE KEYS */;
LOCK TABLES `blue_contratti_dettagli` WRITE;
INSERT INTO `blue_contratti_dettagli` (`contratto_dettaglio_id`, `contratto_dettaglio_contratto_id`, `contratto_dettaglio_costo_lettere`, `contratto_dettaglio_iva_lettere`, `contratto_dettaglio_totale_lettere`, `contratto_dettaglio_modalita_pagamento`, `contratto_dettaglio_oneri_anno`, `contratto_dettaglio_oneri_cifra`, `contratto_dettaglio_oneri_lettere`, `contratto_dettaglio_oneri_saldabili_mese`) VALUES (1,121,'','','','','','0.00','',''),(2,134,'','','','','','0.00','',''),(3,117,'','','','','','0.00','','');
UNLOCK TABLES;
/*!40000 ALTER TABLE `blue_contratti_dettagli` ENABLE KEYS */;

--
-- Table structure for table `blue_contratti_periodi`
--

DROP TABLE IF EXISTS `blue_contratti_periodi`;
CREATE TABLE `blue_contratti_periodi` (
  `contratto_periodo_id` smallint(2) unsigned NOT NULL auto_increment,
  `contratto_periodo_nome` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`contratto_periodo_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blue_contratti_periodi`
--


/*!40000 ALTER TABLE `blue_contratti_periodi` DISABLE KEYS */;
LOCK TABLES `blue_contratti_periodi` WRITE;
INSERT INTO `blue_contratti_periodi` (`contratto_periodo_id`, `contratto_periodo_nome`) VALUES (1,'annuale'),(2,'stagionale'),(3,'mensile'),(4,'giornaliero'),(5,'settimanale'),(6,'pluriennale');
UNLOCK TABLES;
/*!40000 ALTER TABLE `blue_contratti_periodi` ENABLE KEYS */;

--
-- Table structure for table `blue_contratti_tipo`
--

DROP TABLE IF EXISTS `blue_contratti_tipo`;
CREATE TABLE `blue_contratti_tipo` (
  `contratto_tipo_id` int(3) unsigned NOT NULL auto_increment,
  `contratto_tipo_nome` varchar(150) NOT NULL default '',
  PRIMARY KEY  (`contratto_tipo_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blue_contratti_tipo`
--


/*!40000 ALTER TABLE `blue_contratti_tipo` DISABLE KEYS */;
LOCK TABLES `blue_contratti_tipo` WRITE;
INSERT INTO `blue_contratti_tipo` (`contratto_tipo_id`, `contratto_tipo_nome`) VALUES (1,'affitto'),(2,'vendita'),(3,'gestione'),(4,'prenotazione'),(5,'commissione'),(6,'sotto commissione'),(7,'commessa interna'),(9,'intermediazione'),(11,'transito'),(12,'ospitalit&agrave;'),(13,'opzione');
UNLOCK TABLES;
/*!40000 ALTER TABLE `blue_contratti_tipo` ENABLE KEYS */;

--
-- Table structure for table `blue_costruttori`
--

DROP TABLE IF EXISTS `blue_costruttori`;
CREATE TABLE `blue_costruttori` (
  `costruttore_id` int(5) unsigned NOT NULL auto_increment,
  `costruttore_nome` varchar(200) NOT NULL default '',
  PRIMARY KEY  (`costruttore_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blue_costruttori`
--


/*!40000 ALTER TABLE `blue_costruttori` DISABLE KEYS */;
LOCK TABLES `blue_costruttori` WRITE;
INSERT INTO `blue_costruttori` (`costruttore_id`, `costruttore_nome`) VALUES (1,'Non Disponibile'),(2,'3B Craft'),(3,'7 mari'),(4,'A. Bugari (Fano)'),(5,'A.M.F. Slickcraft - Usa'),(6,'A/S Fjelistrand Alluminium'),(7,'AB volvo penta'),(8,'Abbate'),(9,'Abbate costruzioni'),(10,'Adventure'),(11,'Airon Marine Snc'),(12,'ala ver'),(13,'Alain Jezequel'),(14,'Alaver San Martino'),(15,'albin Marine'),(16,'Alfa'),(17,'Alpa'),(18,'Alpa Offanengo'),(19,'Alpa Offanengo (CR)'),(20,'Alu-Bat'),(21,'Amel'),(22,'Amerglass'),(23,'Artekno'),(24,'Asso'),(25,'Atelier Outremer'),(26,'Automarine'),(27,'Automarine Ing. Vitto'),(28,'Averbania'),(29,'Azimut'),(30,'Azimut S.p.a.'),(31,'azimut spa'),(32,'Baglietto'),(33,'Baglietto S.p.a'),(34,'Barberini Piero'),(35,'Barberis'),(36,'Bargco'),(37,'Baruffaldi'),(38,'Baruffaldi Chioggia'),(39,'Bavaria'),(40,'bavaria - yachtbau gmbh'),(41,'Bavaria 42'),(42,'Bavaria GMBH Wurzburg'),(43,'Bavaria Yacht bau'),(44,'Bavaria Yachtbau'),(45,'Bavaria Yachtbaugmbh'),(46,'Baylaner'),(47,'Bayliner'),(48,'Bayliner Marine'),(49,'Bayliner Marine  Corp.'),(50,'Bayliner Marine Corp.'),(51,'bayliner marine usa'),(52,'Bayliner Usa'),(53,'Bellingardo Adriana'),(54,'Beneteau'),(55,'Beneteau ed Azimut'),(56,'Beneteau StGilles'),(57,'Benetteau'),(58,'Benetteau Clipper'),(59,'Benetteau First'),(60,'Berreteau'),(61,'Bertram'),(62,'Betram Yachts'),(63,'Bianka-Werft'),(64,'Biasi'),(65,'Blu Rigginf'),(66,'Boston Whaler'),(67,'Boston Whaler 4121 S.'),(68,'Boston Whaler IMC USA'),(69,'Botnia Marin'),(70,'Brazzoni'),(71,'C. Classis'),(72,'C. N. Benetteau-Francia'),(73,'C.B. Nautica'),(74,'C.N. Belardi'),(75,'C.N. Boretto'),(76,'C.N. del Pardo'),(77,'C.N. Dellapasqua'),(78,'C.N. Franchini'),(79,'C.N. Franchini snc'),(80,'C.N. Gilardoni'),(81,'C.N. Gobbi'),(82,'C.N. Hatteras Yacht'),(83,'C.N. Novelli Teodorico'),(84,'C.N. Rinaldi'),(85,'C.N. San Lorenzo'),(86,'C.N. Sciallino'),(87,'Cadei'),(88,'Camper &amp;Nichelson'),(89,'camper &amp;nicholson'),(90,'Canali'),(91,'canali Spa'),(92,'Cant. Catarsi'),(93,'Cant. Italcraft'),(94,'cant. Mollard'),(95,'Cant. Nautico VZ'),(96,'Cant. Nav. Del Golfo'),(97,'Cant. Navali Ambrosi Carasco'),(98,'Cant. Traverso Pietra Ligure'),(99,'cant.Jeanneau'),(100,'Canti Sergio'),(101,'Cantiere Abbate Costr. Nautiche'),(102,'Cantiere Asso 99'),(103,'Cantiere Baglietto spa'),(104,'Cantiere Brondolo'),(105,'cantiere de cesari - cervia'),(106,'Cantiere de Pardo'),(107,'Cantiere del Pardo'),(108,'Cantiere del Pardo s.p.a.'),(109,'cantiere del pardo srl'),(110,'cantiere della pasqua - carnevali'),(111,'Cantiere della Pasqua Carnevali'),(112,'Cantiere di La Spezia'),(113,'Cantiere Nautico Brazzoni'),(114,'Cantiere Nautico VZ S.r.l.'),(115,'CANTIERE NAVALE OMNIA NAUTICA S.N.C.'),(116,'cantiere se.ri.gi'),(117,'Cantiere Zaniboni'),(118,'cantieri navali dell\'adriatico'),(119,'Cantieri Navali Lavagna'),(120,'Carlini'),(121,'Carnevali'),(122,'Carnevali 140'),(123,'Carnevali 42'),(124,'Carnevali S.r.l.'),(125,'Carterpillar Avigliana'),(126,'Caruer Boat'),(127,'Catarsi'),(128,'CATERPILLAR'),(129,'Cattolica'),(130,'Cbs'),(131,'Centro Nautico Biffoni'),(132,'Cervia'),(133,'Chantier Naval'),(134,'CHANTIERS BENETEAU S.A.'),(135,'CHANTIERS Jeanneau'),(136,'Chaparral'),(137,'Chirola'),(138,'Chong Wha Boats'),(139,'Chris'),(140,'Chris Craft'),(141,'Chrysler marine Usa'),(142,'Cider'),(143,'Classis'),(144,'Classis (Godo)'),(145,'Classis Godo'),(146,'CM Carlimi'),(147,'CN del Paiclo'),(148,'CN Progetti'),(149,'Co,na Plastic'),(150,'Co.mar spa'),(151,'Co.Mar. Forli'),(152,'Coma'),(153,'Comar'),(154,'Comar - Forl&igrave;'),(155,'Comar Forl&igrave;'),(156,'Comar S.p.a'),(157,'Comar S.p.a.'),(158,'Comar S.p.a. - Forl&igrave;'),(159,'Comar S.p.a. Forl&igrave;'),(160,'Comar spa'),(161,'Comet 303'),(162,'Conavi srl'),(163,'confor Batari Anvika'),(164,'Contest'),(165,'Conti Canali'),(166,'Conti e Succimarra Lega Navale'),(167,'Contructions Nautiques Anggloises'),(168,'cookson boats'),(169,'Coop.Nautica'),(170,'Coronet'),(171,'Coronet Botved'),(172,'Cosnava'),(173,'Costruzioni Nautiche'),(174,'COVERLINE s.R.L.'),(175,'Cranchi'),(176,'Cranchi Perla 25'),(177,'Cranchi s.r.l.'),(178,'CRANCHI V6'),(179,'Crestiliner Italia-Ameglia'),(180,'crestliner italia spa'),(181,'Crown Yacht'),(182,'D\'Este'),(183,'De cesari'),(184,'De Cesari Cervia'),(185,'De Vries Olanda'),(186,'Dehler 39'),(187,'Del Garda'),(188,'Del Pardo'),(189,'Del Pardo - Crespellano'),(190,'DEL PARDO s.r.l.'),(191,'Del Tirreno - Savona'),(192,'Dell\'Adriatico Mondolfo'),(193,'Della Nora'),(194,'Della Pasqua'),(195,'Della Pasqua &amp;Carnevali'),(196,'Della Pasqua Carnevali'),(197,'della pasqua e Carnevale'),(198,'Della Pasqua e Carnevali'),(199,'Della Pasqua e Carnevali Srl'),(200,'Della Pasua e Carnevali'),(201,'Della Pasuq e Carnevali'),(202,'della Psqua e carnevali'),(203,'Della Santina'),(204,'Della Santina G.'),(205,'Dellapasqua'),(206,'Dellapasqua Carnevali'),(207,'Derk &amp;Klein  - NL'),(208,'Dudy'),(209,'Dufour'),(210,'Dufour Safari'),(211,'Dufour Yachts'),(212,'Dufur'),(213,'Dullia /Pedrengo'),(214,'Eglan Belinje'),(215,'Elan'),(216,'Elan Line'),(217,'elan marine'),(218,'Elan Tovarna Sportnega'),(219,'Elegance Horizon - Taiwan'),(220,'Emerre di Mingolla'),(221,'Ericson'),(222,'Etoile'),(223,'Everett'),(224,'F.lli Marconi'),(225,'Fair Wasy Marine'),(226,'Fairline Boats'),(227,'Fairwais-Fischerbo'),(228,'Farymann'),(229,'farymann - ermania'),(230,'farymann - germania'),(231,'Farymann Diesel'),(232,'Ferretti'),(233,'Ferretti 68/35'),(234,'Ferretti Craft'),(235,'Ferretti New'),(236,'FIART MARE'),(237,'Fiart Mare Baia'),(238,'Fioravanti'),(239,'Fiord'),(240,'First 45'),(241,'Fontana Maletto Navona'),(242,'Forli'),(243,'Franchini'),(244,'Franchini Cattolica'),(245,'Franchini Riccione'),(246,'Francia'),(247,'Fratelli Marchi Venezia'),(248,'Frp Industries Inc'),(249,'G. Roberto &amp;C.'),(250,'G. Tommasi Ancona'),(251,'Gallinari'),(252,'Geesthacht'),(253,'Gi&ograve; Mare'),(254,'Gib Sea'),(255,'Gib Sea (Francia)'),(256,'Gibert Marine'),(257,'Gilardoni Giovanni'),(258,'Gilbert Marine'),(259,'Gilbert Marine S.A. Francia'),(260,'Gino di Este Venezia'),(261,'Gio mare'),(262,'Giordano'),(263,'Giorgi'),(264,'Giorgi Giacomo'),(265,'Gobbi'),(266,'Gobbi Cantieri Nautici'),(267,'Gobbi S.P.A.'),(268,'Gobbi spa'),(269,'Gradassi Nanni Roncuzzi'),(270,'Gradassi, Nanni, Roncuzzi'),(271,'Gran Soleil'),(272,'Granchi'),(273,'Grand Soleil'),(274,'Guy Couach'),(275,'Halberg Rassy'),(276,'Hallberg'),(277,'Hallberg Rassy'),(278,'Hallberg-Rassy'),(279,'Harkovsky Aviacionijzavod'),(280,'Henry wasquez'),(281,'Hille'),(282,'Hobby Craft'),(283,'honda'),(284,'Honda Motor'),(285,'Horn S.r.l.'),(286,'Hstillero Sarmiento'),(287,'Hylas'),(288,'Hylas-42'),(289,'Iag Nautica'),(290,'Ilver'),(291,'Ilver spa'),(292,'Infinity Boats'),(293,'Iniziative Commerciali'),(294,'Innovazione e progetti'),(295,'Innovazione Progetti'),(296,'Innovazioni &amp;Progetti'),(297,'Innovazioni &amp;Progetti S.r.l.'),(298,'Innovazioni progetti'),(299,'Inoovazioni progetti'),(300,'Interboat'),(301,'intermare 42'),(302,'Irwin Yacht Usa'),(303,'Italboats'),(304,'Italcraft'),(305,'Izola'),(306,'Jachtbouw Twente'),(307,'Jachtwerf Jongert'),(308,'Janneau'),(309,'Jeanneali'),(310,'Jeanneau'),(311,'Jeanneau Newco'),(312,'Jeanneau S.A.'),(313,'Jeanneau Yanmar'),(314,'jenneau'),(315,'Johnson Yachts Company Limited'),(316,'Kappamarine'),(317,'Key West'),(318,'La vela'),(319,'Lasale sul Sile'),(320,'Laver S.p.a.'),(321,'Les herbiers'),(322,'Linssen'),(323,'Lombardini Marine S.r.l.'),(324,'Luhrs'),(325,'M.s.a.'),(326,'Ma.Re. Po. Son'),(327,'Magnani'),(328,'Mainschip'),(329,'Mako Sailers'),(330,'Manifacturas'),(331,'Marans F'),(332,'Marchi'),(333,'Marepi&ugrave;'),(334,'Marine'),(335,'marine power'),(336,'Marine Power Europe'),(337,'Marine Power Europe  Petit-Rechain'),(338,'Marine Project'),(339,'Marine Projects'),(340,'Marinello'),(341,'Mariner'),(342,'Marineria s.r.l.'),(343,'Mariver'),(344,'Mariver di Osteria Grande'),(345,'Mariver(BO)'),(346,'Marshall'),(347,'Maxum'),(348,'Maxum Marine co. Arlington'),(349,'Maxum Marine Corp.'),(350,'Mediterranea'),(351,'Mengozzi Michael'),(352,'Menri Wauquiez'),(353,'Mercury - Marine'),(354,'mercury marine'),(355,'Michel Doufour'),(356,'Mileo'),(357,'Minerbio'),(358,'Mistralboats'),(359,'Mochi Craft'),(360,'Mochi Craft Pesaro'),(361,'Mochi-Craft Pesaro'),(362,'Monteray 262 Cruiser'),(363,'Monterey boat'),(364,'Moody 33'),(365,'Moschini'),(366,'Motiva'),(367,'Motomarine'),(368,'Motonautica Adriatica'),(369,'Msa Ship Yard'),(370,'Nanni'),(371,'Nanni Industries - La Teste (Francia)'),(372,'Nautica Commerciale Piol'),(373,'Nautica Salpa'),(374,'Nautica Salpa srl'),(375,'Nautica Serena'),(376,'Nautical Fiberglass'),(377,'Nauticat Hai 590'),(378,'Nautico Gianetti'),(379,'Nautico Marinello di Tindaro Stroscio'),(380,'Nautico Triestino'),(381,'Naviflex'),(382,'Nord Cantieri'),(383,'Nordcantieri Avigliana'),(384,'Nordcantieri Costaguta'),(385,'Novelli'),(386,'Nuova Bat S.r.l.'),(387,'Nuova Intermare'),(388,'Nuova Record S.r.l.'),(389,'Nytec 28'),(390,'Ocean Yacht Usa'),(391,'Omnia Nautica'),(392,'One Design Asso 99'),(393,'pacemarer aglas'),(394,'Paducelli-Gargnano'),(395,'Panrella'),(396,'Pardo srl'),(397,'Parigny'),(398,'Partenautica'),(399,'Pelle Petterson'),(400,'Pelpardo'),(401,'Perigny'),(402,'Perigny Cedex'),(403,'PERKINS'),(404,'Perkins Sabre'),(405,'Pfeil'),(406,'Phanton'),(407,'Pheonyachts Newshaven (GB)'),(408,'Pio spa'),(409,'Pirazzi e Pasotti'),(410,'Plastivela'),(411,'Plastivela Snc'),(412,'Polar Plast'),(413,'Polyform'),(414,'Porcia'),(415,'Pro Line Boats inc.'),(416,'Prout Catamarans di Canvey Island'),(417,'Queentime'),(418,'Racca F.'),(419,'Raffaelli'),(420,'Raffaelli Costruzioni nautiche'),(421,'Rafffaelli Costr. Nautiche'),(422,'Ranieri'),(423,'Ranieri Cantyieri Nautici'),(424,'Rassy'),(425,'Regal Marine'),(426,'Regal marine industries'),(427,'Reinforces Plastic'),(428,'Renault Marine'),(429,'Rex'),(430,'Riccione'),(431,'Rimar'),(432,'Rimar 31'),(433,'Rinaldi'),(434,'Rio'),(435,'Rio s.p.a'),(436,'Rio S.p.a.'),(437,'Rio spa'),(438,'Roc Ron Amey'),(439,'Roe di Giambelluca'),(440,'Rondolini Pesaro'),(441,'Rose Island S.r.l.'),(442,'Ruggerini Motori S.p.a.'),(443,'S.Prospero'),(444,'Saga Norway'),(445,'San Germani'),(446,'Sangermani'),(447,'Sarca'),(448,'Sartini'),(449,'Sartini Cervia'),(450,'Sauir'),(451,'Saver'),(452,'Scandinavian Motor Boats'),(453,'Scanea-Bari'),(454,'Scuter &amp;son ltd'),(455,'Sea Ray'),(456,'Sea ray boat'),(457,'Sea Ray Boats'),(458,'Sea Ray Boats Usa'),(459,'SEALINE INTERNATIONAL LTD'),(460,'Seariff Italia S.r.l.'),(461,'Selva S.p.a.'),(462,'Sessa'),(463,'sessa Marine'),(464,'Sessa Marine S.r.l.'),(465,'Sessa S.a.s.'),(466,'Sibma'),(467,'Sidra snc'),(468,'Siltala Yachts OY'),(469,'Sipla Forli'),(470,'Sloop Broderna Ohleson AB'),(471,'Sloop Cutter'),(472,'Soc. alpa az.Lavoratori Pl.'),(473,'Soc. Maro Sailers S.r.l.'),(474,'Solcio S.p.a.'),(475,'Soleri Fabio'),(476,'Sport Craft'),(477,'Sportcraft inc.'),(478,'Stahl'),(479,'Steda Yachtis'),(480,'Sunseeker Scandinavian'),(481,'suzuki'),(482,'Suzuki Motor Corporation'),(483,'Targa Temporanea'),(484,'tecno mariner srl'),(485,'Tecnofiber'),(486,'Teknocantieri'),(487,'Teknocantieri Stella(SV)'),(488,'Tognacci'),(489,'tohatsu corporation'),(490,'tohatsu Corporation - Tokio'),(491,'Tornado'),(492,'Tovarna Motornih Vozil Tomos'),(493,'U 2'),(494,'Uniesse Marine S.r.l.'),(495,'V. Catarsi'),(496,'Van der Stadt'),(497,'Vetroresina ravennate'),(498,'Vibo Valentia'),(499,'Vincenzo Catarsi'),(500,'VM MOTOR SPA'),(501,'Volvo Penta'),(502,'Volvo Penta Goteberg'),(503,'VZ'),(504,'Werft Feltz'),(505,'Wojciech &amp;Bozena Soszynski'),(506,'X Yachts'),(507,'X-Yachts'),(508,'X-Yachts A/S (Haderslev Dk)'),(509,'Yachbau'),(510,'Yachting france'),(511,'Yamaha'),(512,'Yamaha Marine'),(513,'Yamaha Motor'),(514,'YANMAR'),(515,'yanmar - japan'),(516,'Yanmar Diesel'),(517,'Yanmar diesel engine co. Ltd'),(518,'Yanmar Diesel Engine Coltd'),(519,'Young Sun Yacht'),(520,'Zanetti &amp;Filippi'),(521,'Zaniboni Minerbio (Bo)'),(522,'Zara di Serrenti'),(523,'Zaunelli'),(524,'Zeta Group'),(525,'Zetacraft'),(526,'Nautica Po'),(527,'Comet'),(528,'Autostar'),(529,'Sunseeker Caribbean'),(530,'Sunseeker Caribbean'),(531,'ROVER MARINE S.R.L.'),(532,'CNSO'),(533,'Alb Sail'),(534,'Albatros'),(535,'Cantiere River Srl'),(536,'SERMAGIOTTO'),(537,'CANTIERI PRINCESS'),(538,'ARCIERE 27 MASTER'),(539,'Gabert Marine'),(540,'Outboard Marine Belgium'),(541,'cantiere nautico del serafo'),(542,'CANTIERI SERAFO'),(543,'Con m.a.'),(544,'CANTIERI DI PISA S.P.A.'),(545,'Enterprise Marine'),(546,'Serbia'),(547,'Delphia yachts SA'),(548,'P.A.M INTERNATIONAL'),(549,'Volkswagen Marine'),(550,'Kubota'),(551,'Cantieri Navali D\'este'),(552,'CANADOS GROUP'),(553,'MOTOR yACHT'),(554,'CANT. NETTUNO MESSINA'),(555,'KAISERWERFT GMBH'),(556,'CANTIERI SE.RI.GI'),(557,'Molinari'),(558,'FIBER STAMP'),(559,'FOUR WINNS'),(560,'CANTIERI CADEI'),(561,'Sunseeker International'),(562,'Sunseeker Can.'),(563,'GIANETTI'),(564,'Comet'),(565,'GARCIA SAIL'),(566,'CANTIERI SE.RI.GI'),(567,'Riva'),(568,'Rizzardi'),(569,'Zuanelli'),(570,'Europe Marine'),(571,'Aprea Mare'),(572,'Kelt Oceans'),(573,'Aprea S.n.c.'),(574,'Cantieri Navali Riuniti'),(575,'Cantieri Lombardi'),(576,'Salpa'),(577,'Colombo'),(578,'Formula'),(579,'IW-Varvet AB'),(580,'Doral'),(581,'Dehler'),(582,'Mussini'),(583,'Larson'),(584,'BWA'),(585,'Crownline'),(586,'Sea Doo'),(587,'Baja'),(588,'Bat'),(589,'Symbol'),(590,'Novurania'),(591,'Cobalt'),(592,'Nuova Garda Cantieri srl'),(593,'Wellcraft'),(594,'Schöckl Sportboot'),(595,'Boesch'),(596,'Tullio Abbate'),(597,'Maxi Dolphin'),(598,'UFO 22'),(599,'Motonautica Vesuviana'),(600,'Grand Surprise'),(601,'Protagonist'),(602,'Dolphin'),(603,'Piantoni'),(604,'Tony Giuliano'),(605,'Silvane'),(606,'Capelli'),(607,'Vaiper');
UNLOCK TABLES;
/*!40000 ALTER TABLE `blue_costruttori` ENABLE KEYS */;

--
-- Table structure for table `blue_dimensioni`
--

DROP TABLE IF EXISTS `blue_dimensioni`;
CREATE TABLE `blue_dimensioni` (
  `dimensione_id` int(5) unsigned NOT NULL auto_increment,
  `dimensione_lunghezza` float default NULL,
  `dimensione_larghezza` float default NULL,
  `dimensione_profondita` float default NULL,
  `dimensione_tipo` int(2) NOT NULL default '0',
  PRIMARY KEY  (`dimensione_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Dimensioni e Listino dei Posti Barca';

--
-- Dumping data for table `blue_dimensioni`
--


/*!40000 ALTER TABLE `blue_dimensioni` DISABLE KEYS */;
LOCK TABLES `blue_dimensioni` WRITE;
INSERT INTO `blue_dimensioni` (`dimensione_id`, `dimensione_lunghezza`, `dimensione_larghezza`, `dimensione_profondita`, `dimensione_tipo`) VALUES (1,9,2.7,NULL,0),(2,8,2.5,NULL,0),(3,8,2.6,NULL,0),(4,10,3,NULL,0),(5,10,3.3,NULL,0),(6,12,3.5,NULL,0),(7,12,4,NULL,0);
UNLOCK TABLES;
/*!40000 ALTER TABLE `blue_dimensioni` ENABLE KEYS */;

--
-- Table structure for table `blue_fatture`
--

DROP TABLE IF EXISTS `blue_fatture`;
CREATE TABLE `blue_fatture` (
  `fattura_id` int(10) unsigned NOT NULL auto_increment,
  `fattura_cliente_id` int(10) default NULL,
  `fattura_numero` varchar(11) default NULL,
  `fattura_data` date default NULL,
  `fattura_condizioni_pagamento` varchar(250) default NULL,
  `fattura_spese_incasso` decimal(10,2) default NULL,
  `fattura_spese_trasporto` decimal(10,2) default NULL,
  `fattura_bolli` decimal(10,2) default NULL,
  `fattura_pagata` int(1) default '0',
  `fattura_esente_iva` enum('0','1') default '0',
  `fattura_motivo_esente_iva` varchar(250) default '',
  `fattura_contratto_id` int(11) default '0',
  `fattura_varie` enum('0','1') default '0',
  `fattura_spese_condominiali` enum('0','1') default '0',
  PRIMARY KEY  (`fattura_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blue_fatture`
--


/*!40000 ALTER TABLE `blue_fatture` DISABLE KEYS */;
LOCK TABLES `blue_fatture` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `blue_fatture` ENABLE KEYS */;

--
-- Table structure for table `blue_fatture_righe`
--

DROP TABLE IF EXISTS `blue_fatture_righe`;
CREATE TABLE `blue_fatture_righe` (
  `fattura_riga_id` int(10) unsigned NOT NULL auto_increment,
  `fattura_riga_fattura_id` int(10) default NULL,
  `fattura_riga_descrizione` varchar(250) default NULL,
  `fattura_riga_um` varchar(20) default NULL,
  `fattura_riga_quantita` float default NULL,
  `fattura_riga_listino` decimal(10,2) default NULL,
  `fattura_riga_imponibile` decimal(10,2) default NULL,
  `fattura_riga_sconto` float default '0',
  `fattura_riga_iva` float default NULL,
  `fattura_riga_totale` decimal(10,2) default NULL,
  PRIMARY KEY  (`fattura_riga_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blue_fatture_righe`
--


/*!40000 ALTER TABLE `blue_fatture_righe` DISABLE KEYS */;
LOCK TABLES `blue_fatture_righe` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `blue_fatture_righe` ENABLE KEYS */;

--
-- Table structure for table `blue_listini_generici`
--

DROP TABLE IF EXISTS `blue_listini_generici`;
CREATE TABLE `blue_listini_generici` (
  `listino_generico_id` int(10) unsigned NOT NULL auto_increment,
  `listino_generico_anno` int(4) default NULL,
  `listino_generico_descrizione` varchar(250) default NULL,
  `listino_generico_costo` decimal(10,2) default NULL,
  PRIMARY KEY  (`listino_generico_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blue_listini_generici`
--


/*!40000 ALTER TABLE `blue_listini_generici` DISABLE KEYS */;
LOCK TABLES `blue_listini_generici` WRITE;
INSERT INTO `blue_listini_generici` (`listino_generico_id`, `listino_generico_anno`, `listino_generico_descrizione`, `listino_generico_costo`) VALUES (6,2005,'Traino','50.00'),(3,2006,'vuota','30.00'),(5,2005,'Spese condominiali 2005','0.00'),(7,2005,'Spazio  espositivo','260.00'),(8,2007,'fino a 10 x 3,30','41.00'),(9,2007,'fino a 10 x 3,00','38.00'),(10,2007,'fino a 12','47.00'),(11,2007,'fino a 13','52.00'),(12,2007,'fino a 14','59.00'),(13,2008,'','0.00'),(14,2010,'','0.00'),(15,2009,'','0.00');
UNLOCK TABLES;
/*!40000 ALTER TABLE `blue_listini_generici` ENABLE KEYS */;

--
-- Table structure for table `blue_listini_posti_barca`
--

DROP TABLE IF EXISTS `blue_listini_posti_barca`;
CREATE TABLE `blue_listini_posti_barca` (
  `listino_posto_barca_id` int(10) unsigned NOT NULL auto_increment,
  `listino_posto_barca_dimensione` int(5) default NULL,
  `listino_posto_barca_anno` int(4) default NULL,
  `costo_giornaliero` decimal(10,2) default NULL,
  `costo_e1` decimal(10,2) default NULL,
  `costo_e2` decimal(10,2) default NULL,
  `costo_em` decimal(10,2) default NULL,
  `costo_es` decimal(10,2) default NULL,
  `costo_i1` decimal(10,2) default NULL,
  `costo_i2` decimal(10,2) default NULL,
  `costo_im` decimal(10,2) default NULL,
  `costo_is` decimal(10,2) default NULL,
  `costo_annuale` decimal(10,2) default NULL,
  `costo_condominiale` decimal(10,2) default NULL,
  PRIMARY KEY  (`listino_posto_barca_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blue_listini_posti_barca`
--


/*!40000 ALTER TABLE `blue_listini_posti_barca` DISABLE KEYS */;
LOCK TABLES `blue_listini_posti_barca` WRITE;
INSERT INTO `blue_listini_posti_barca` (`listino_posto_barca_id`, `listino_posto_barca_dimensione`, `listino_posto_barca_anno`, `costo_giornaliero`, `costo_e1`, `costo_e2`, `costo_em`, `costo_es`, `costo_i1`, `costo_i2`, `costo_im`, `costo_is`, `costo_annuale`, `costo_condominiale`) VALUES (1,1,2004,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(2,10,2004,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(3,11,2004,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(4,12,2004,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(5,13,2004,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(6,2,2004,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(7,22,2004,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(8,23,2004,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(9,25,2004,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(10,26,2004,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(11,27,2004,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(13,29,2004,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(14,3,2004,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(15,4,2004,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(16,5,2004,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(17,6,2004,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(18,7,2004,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(19,8,2004,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(20,9,2004,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(21,32,2004,'26.25','160.65','277.20','535.50','2052.75','129.15','223.65','277.20','1365.00','2722.13','0.00'),(105,1,2006,'190.00','1157.00','1983.00','3967.00','15350.00','992.00','1700.00','1831.00','11217.00','21609.00','0.00'),(104,10,2006,'29.00','176.00','307.00','578.00','2244.00','154.00','259.00','319.00','1524.00','2984.00','791.00'),(103,11,2006,'25.00','153.00','259.00','460.00','1924.00','130.00','225.00','266.00','1287.00','2562.00','646.00'),(102,12,2006,'18.00','110.00','189.00','365.00','1523.00','95.00','165.00','214.00','916.00','1827.00','0.00'),(101,13,2006,'17.00','98.00','165.00','331.00','1216.00','83.00','142.00','201.00','792.00','1524.00','0.00'),(100,2,2006,'150.00','916.00','1571.00','3354.00','12989.00','779.00','1334.00','1524.00','9092.00','17358.00','0.00'),(99,22,2006,'90.00','550.00','945.00','1595.00','6612.00','485.00','792.00','839.00','3897.00','9152.00','0.00'),(98,23,2006,'16.00','95.00','153.00','284.00','915.00','78.00','137.00','184.00','732.00','1216.00','0.00'),(97,25,2006,'20.00','121.00','212.00','401.00','1829.00','107.00','177.00','225.00','1040.00','2137.00','357.00'),(96,26,2006,'99.00','603.00','1028.00','1889.00','7793.00','520.00','886.00','921.00','4547.00','10391.00','4017.00'),(95,27,2006,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(93,29,2006,'24.00','145.00','248.00','445.00','1901.00','125.00','213.00','255.00','1225.00','2456.00','501.00'),(92,3,2006,'125.00','762.00','1311.00','2314.00','9801.00','650.00','1110.00','1157.00','5786.00','13414.00','0.00'),(91,4,2006,'111.00','674.00','1157.00','2185.00','8856.00','567.00','981.00','1040.00','5195.00','11808.00','0.00'),(90,5,2006,'79.00','485.00','839.00','1464.00','5786.00','461.00','732.00','779.00','3603.00','8231.00','3014.00'),(89,6,2006,'63.00','383.00','662.00','1217.00','4216.00','331.00','555.00','580.00','2987.00','5668.00','2153.00'),(88,7,2006,'47.00','284.00','485.00','886.00','3070.00','236.00','414.00','461.00','2256.00','4203.00','1507.00'),(87,8,2006,'44.00','272.00','461.00','792.00','2952.00','231.00','389.00','414.00','2137.00','4086.00','1327.00'),(86,9,2006,'35.00','212.00','366.00','709.00','2715.00','171.00','296.00','366.00','1806.00','3602.00','1005.00'),(85,32,2006,'144.00','878.00','1506.00','3094.00','12192.00','747.00','1278.00','1432.00','8266.00','16372.00','5739.00'),(84,32,2005,'26.25','160.65','277.20','535.50','2052.75','129.15','223.65','277.20','1365.00','2722.13','5466.00'),(83,9,2005,'33.00','202.00','349.00','675.00','2586.00','163.00','282.00','349.00','1720.00','3430.00','956.00'),(82,8,2005,'42.00','259.00','439.00','754.00','2811.00','220.00','370.00','394.00','2035.00','3891.00','1264.00'),(81,7,2005,'45.00','270.00','462.00','844.00','2924.00','225.00','394.00','439.00','2149.00','4003.00','1435.00'),(80,6,2005,'60.00','365.00','630.00','1159.00','4015.00','315.00','529.00','552.00','2845.00','5398.00','2049.00'),(79,5,2005,'75.00','462.00','799.00','1394.00','5510.00','439.00','697.00','742.00','3431.00','7839.00','2869.00'),(78,4,2005,'106.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','11246.00','0.00'),(77,3,2005,'119.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','12775.00','0.00'),(76,29,2005,'23.00','138.00','236.00','424.00','1810.00','119.00','203.00','243.00','1167.00','2339.00','477.00'),(74,27,2005,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(73,26,2005,'94.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','9896.00','3826.00'),(72,25,2005,'19.00','115.00','202.00','382.00','1742.00','102.00','169.00','214.00','990.00','2035.00','340.00'),(71,23,2005,'15.00','90.00','146.00','270.00','871.00','74.00','130.00','175.00','697.00','1158.00','0.00'),(70,22,2005,'86.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','8716.00','0.00'),(69,2,2005,'143.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','16531.00','0.00'),(68,13,2005,'16.00','93.00','157.00','315.00','1158.00','79.00','135.00','191.00','754.00','1451.00','0.00'),(67,12,2005,'17.00','105.00','180.00','348.00','1450.00','90.00','157.00','204.00','872.00','1740.00','0.00'),(66,11,2005,'24.00','146.00','247.00','438.00','1832.00','124.00','214.00','253.00','1226.00','2440.00','615.00'),(65,10,2005,'28.00','168.00','292.00','550.00','2137.00','147.00','247.00','304.00','1451.00','2842.00','752.00'),(64,1,2005,'181.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','20580.00','0.00'),(106,1,2007,'25.00','50.00','100.00','450.00','750.00','20.00','45.00','325.00','600.00','1800.00','0.00'),(107,10,2007,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','831.00'),(108,11,2007,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','678.00'),(109,12,2007,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(110,13,2007,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(111,2,2007,'15.00','70.00','140.00','300.00','500.00','50.00','120.00','250.00','400.00','1200.00','0.00'),(112,22,2007,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(113,23,2007,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(114,25,2007,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','375.00'),(115,26,2007,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','4218.00'),(116,27,2007,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(118,29,2007,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','526.00'),(119,3,2007,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(120,4,2007,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(121,5,2007,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','3165.00'),(122,6,2007,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','2261.00'),(123,7,2007,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','1582.00'),(124,8,2007,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','1393.00'),(125,9,2007,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','1055.00'),(126,32,2007,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','6026.00'),(129,34,2006,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','1724.00'),(130,35,2006,'53.00','317.00','543.00','996.00','3452.00','268.00','461.00','500.00','2499.00','4691.00','0.00'),(131,36,2006,'57.00','350.00','603.00','1107.00','3834.00','298.00','508.00','541.00','2744.00','5180.00','0.00'),(134,34,2007,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','1810.00'),(135,35,2007,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(136,36,2007,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(137,1,2008,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(138,10,2008,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(139,11,2008,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(140,12,2008,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(141,13,2008,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(142,2,2008,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(143,22,2008,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(144,23,2008,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(145,25,2008,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(146,26,2008,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(147,27,2008,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(148,29,2008,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(149,3,2008,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(150,4,2008,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(151,5,2008,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(152,6,2008,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(153,7,2008,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(154,8,2008,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(155,9,2008,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(156,32,2008,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(157,34,2008,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(158,35,2008,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(159,36,2008,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(160,1,2010,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(161,10,2010,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(162,11,2010,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(163,12,2010,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(164,13,2010,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(165,2,2010,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(166,22,2010,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(167,23,2010,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(168,25,2010,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(169,26,2010,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(170,27,2010,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(171,29,2010,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(172,3,2010,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(173,4,2010,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(174,5,2010,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(175,6,2010,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(176,7,2010,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(177,8,2010,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(178,9,2010,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(179,32,2010,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(180,34,2010,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(181,35,2010,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(182,36,2010,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(183,1,2009,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(184,10,2009,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(185,11,2009,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(186,12,2009,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(187,13,2009,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(188,2,2009,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(189,22,2009,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(190,23,2009,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(191,25,2009,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(192,26,2009,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(193,27,2009,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(194,29,2009,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(195,3,2009,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(196,4,2009,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(197,5,2009,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(198,6,2009,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(199,7,2009,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(200,8,2009,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(201,9,2009,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(202,32,2009,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(203,34,2009,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(204,35,2009,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00'),(205,36,2009,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00');
UNLOCK TABLES;
/*!40000 ALTER TABLE `blue_listini_posti_barca` ENABLE KEYS */;

--
-- Table structure for table `blue_nazioni`
--

DROP TABLE IF EXISTS `blue_nazioni`;
CREATE TABLE `blue_nazioni` (
  `nazione_id` int(11) unsigned NOT NULL auto_increment,
  `nazione_nome` varchar(100) default NULL,
  PRIMARY KEY  (`nazione_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blue_nazioni`
--


/*!40000 ALTER TABLE `blue_nazioni` DISABLE KEYS */;
LOCK TABLES `blue_nazioni` WRITE;
INSERT INTO `blue_nazioni` (`nazione_id`, `nazione_nome`) VALUES (1,'Abu Dhabi'),(2,'Afghanistan'),(3,'Ajman'),(4,'Albania'),(5,'Algeria'),(6,'American Samoa'),(7,'Andorra'),(8,'Angola'),(9,'Anguilla'),(10,'Antigua E Barbuda'),(11,'Antille Olandesi'),(12,'Arabia Saudita'),(13,'Argentina'),(14,'Armenia'),(15,'Aruba'),(16,'Ascension'),(17,'Australia'),(18,'Austria'),(19,'Azerbaigian'),(20,'Azzorre, Isole'),(21,'Bahama'),(22,'Bahrein'),(23,'Bangladesh'),(24,'Barbados'),(25,'Belgio'),(26,'Belgio (compreso Lussemburgo)'),(27,'Belize'),(28,'Benin'),(29,'Bermuda'),(30,'Bhutan'),(31,'Bielorussia'),(32,'Bolivia'),(33,'Bosnia Erzegovina'),(34,'Botswana'),(35,'Brasile'),(36,'Brunei'),(37,'Bulgaria'),(38,'Burkina Faso'),(39,'Burundi'),(40,'Camerun'),(41,'Campione D\'italia'),(42,'Canada'),(43,'Canarie, Isole'),(44,'Capo Verde'),(45,'Caroline, Isole'),(46,'Cayman Islands'),(47,'Cecoslovacchia'),(48,'Centroafricana Rep.'),(49,'Ceuta'),(50,'Chafarinas'),(51,'Chagos, Isole'),(52,'Ciad'),(53,'Cile'),(54,'Cina Rep.pop.'),(55,'Cipro'),(56,'Citta\' Del Vaticano'),(57,'Clipperton'),(58,'Colombia'),(59,'Comore'),(60,'Congo'),(61,'Cook, Isole'),(62,'Corea Del Nord'),(63,'Corea Del Sud'),(64,'Costa D\'avorio'),(65,'Costarica'),(66,'Croazia'),(67,'Cuba'),(68,'Danimarca'),(69,'Dominica'),(70,'Dominicana Rep.'),(71,'Dubai'),(72,'Ecuador'),(73,'Egitto'),(74,'El Salvador'),(75,'Emirati Arabi Uniti'),(76,'Estonia'),(77,'Etiopia'),(78,'Falkland'),(79,'Far Oer, Isole'),(80,'Fiji'),(81,'Filippine'),(82,'Finlandia'),(83,'Francia'),(84,'Fuijayrah'),(85,'Gabon'),(86,'Gambia'),(87,'Georgia'),(88,'Germania'),(89,'Germania (unita Ex Germania Federale)'),(90,'Ghana'),(91,'Giamaica'),(92,'Giappone'),(93,'Gibilterra'),(94,'Gibuti'),(95,'Giordania'),(96,'Gough'),(97,'Grecia'),(98,'Grenada'),(99,'Groenlandia'),(100,'Guadalupa'),(101,'Guam'),(102,'Guatemala'),(103,'Guayana Francese'),(104,'Guernsey'),(105,'Guinea'),(106,'Guinea Bissau'),(107,'Guinea Equatoriale'),(108,'Guyana'),(109,'Haiti'),(110,'Honduras'),(111,'Hong Kong'),(112,'India'),(113,'Indonesia'),(114,'Iran'),(115,'Iraq'),(116,'Irlanda'),(117,'Islanda'),(118,'Isole Americane Del Pacifico'),(119,'Israele'),(120,'Italia'),(121,'Italia (compreso San Marino)'),(122,'Jersey'),(123,'Jugoslavia'),(124,'Kampuchea'),(125,'Kazakistan'),(126,'Kenya'),(127,'Kirghizistan'),(128,'Kiribati'),(129,'Kuwait'),(130,'Laos'),(131,'Lesotho'),(132,'Lettonia'),(133,'Libano'),(134,'Liberia'),(135,'Libia'),(136,'Liechtenstein'),(137,'Lituania'),(138,'Lussemburgo'),(139,'Macao'),(140,'Madagascar'),(141,'Madeira'),(142,'Malawi'),(143,'Malaysia'),(144,'Maldive'),(145,'Mali'),(146,'Malta'),(147,'Man, Isola'),(148,'Marianne Settentrionali, Isole'),(149,'Marocco'),(150,'Marshall, Isole'),(151,'Martinica'),(152,'Mauritania'),(153,'Maurizio'),(154,'Mayotte'),(155,'Melilla'),(156,'Messico'),(157,'Micronesia, Stati Federali'),(158,'Midway'),(159,'Moldavia'),(160,'Mongolia'),(161,'Montserrat'),(162,'Mozambico'),(163,'Myanmar'),(164,'Namibia'),(165,'Nauru'),(166,'Nepal'),(167,'Nicaragua'),(168,'Niger'),(169,'Nigeria'),(170,'Niue'),(171,'Norvegia'),(172,'Nuova Caledonia'),(173,'Nuova Zelanda'),(174,'Olanda'),(175,'Oman'),(176,'Paesi Non Classificabili'),(177,'Pakistan'),(178,'Palau'),(179,'Panama'),(180,'Panama - Zona Del Canale'),(181,'Papua - Nuova Guinea'),(182,'Paraguay'),(183,'Penon De Alhucemas'),(184,'Penon De Velez De La Gomera'),(185,'Peru\''),(186,'Pitcairn'),(187,'Polinesia Francese'),(188,'Polonia'),(189,'Portogallo'),(190,'Portorico'),(191,'Principato Di Monaco'),(192,'Qatar'),(193,'Ras El Khaimah'),(194,'Regno Unito'),(195,'Reunion'),(196,'Romania'),(197,'Russia'),(198,'Rwanda'),(199,'Sahara Occidentale'),(200,'Saint Lucia'),(201,'Saint Martin Settentrionale'),(202,'Salomone, Isole'),(203,'Samoa'),(204,'San Marino'),(205,'Sant\'elena'),(206,'Sao Tome E Principe'),(207,'Senegal'),(208,'Seychelles'),(209,'Sharjah'),(210,'Sierra Leone'),(211,'Singapore'),(212,'Siria'),(213,'Slovenia'),(214,'Somalia'),(215,'Spagna'),(216,'Sri Lanka'),(217,'St Pierre E Miquelon'),(218,'St. Kitts E Nevis'),(219,'St. Vincent E Grenadine'),(220,'Stati Uniti D\'america'),(221,'Sudafricana Rep.'),(222,'Sudan'),(223,'Suriname'),(224,'Svezia'),(225,'Svizzera'),(226,'Swaziland'),(227,'Tagikistan'),(228,'Taiwan'),(229,'Tanzania'),(230,'Territorio Antartico Britannico'),(231,'Territorio Antartico Francese'),(232,'Territorio Britannico Oceano Indiano'),(233,'Thailandia'),(234,'Togo'),(235,'Tokelau'),(236,'Tonga'),(237,'Trinidad E Tobago'),(238,'Tristan Da Cunha'),(239,'Tunisia'),(240,'Turchia'),(241,'Turkmenistan'),(242,'Turks E Caicos'),(243,'Tuvalu\''),(244,'Ucraina'),(245,'Uganda'),(246,'Umm Al Qaiwain'),(247,'Ungheria'),(248,'Uruguay'),(249,'Uzbekistan'),(250,'Vanuatu'),(251,'Venezuela'),(252,'Vergini Americane, Isole'),(253,'Vergini Britanniche, Isole'),(254,'Vietnam'),(255,'Wake'),(256,'Wallis E Futuna'),(257,'Yemen'),(258,'Zaire'),(259,'Zambia'),(260,'Zimbabwe'),(261,'Virginia'),(262,'Usa'),(263,'Gran Bretagna'),(264,'Paesi Bassi'),(265,'California'),(266,'Inghilterra'),(267,'British Virgin Islands'),(268,'England'),(269,'Channel Islands , Gy1 4hh'),(270,'Cornwall'),(271,'U.s.a.'),(272,'Texas - Usa'),(9999,'Non Disponibile');
UNLOCK TABLES;
/*!40000 ALTER TABLE `blue_nazioni` ENABLE KEYS */;

--
-- Table structure for table `blue_pontili`
--

DROP TABLE IF EXISTS `blue_pontili`;
CREATE TABLE `blue_pontili` (
  `pontile_id` int(3) unsigned NOT NULL auto_increment,
  `pontile_nome` varchar(150) NOT NULL default '',
  `pontile_codice` char(3) default NULL,
  `pontile_tipo` int(2) NOT NULL default '1',
  PRIMARY KEY  (`pontile_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blue_pontili`
--


/*!40000 ALTER TABLE `blue_pontili` DISABLE KEYS */;
LOCK TABLES `blue_pontili` WRITE;
INSERT INTO `blue_pontili` (`pontile_id`, `pontile_nome`, `pontile_codice`, `pontile_tipo`) VALUES (1,'Pontile A','A',1),(2,'Pontile C','C',1),(3,'Pontile T','T',1),(4,'Pontile','',1),(5,'Piazzale','P',1);
UNLOCK TABLES;
/*!40000 ALTER TABLE `blue_pontili` ENABLE KEYS */;

--
-- Table structure for table `blue_pontili_tipo`
--

DROP TABLE IF EXISTS `blue_pontili_tipo`;
CREATE TABLE `blue_pontili_tipo` (
  `pontile_tipo_id` int(2) unsigned NOT NULL auto_increment,
  `pontile_tipo_nome` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`pontile_tipo_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blue_pontili_tipo`
--


/*!40000 ALTER TABLE `blue_pontili_tipo` DISABLE KEYS */;
LOCK TABLES `blue_pontili_tipo` WRITE;
INSERT INTO `blue_pontili_tipo` (`pontile_tipo_id`, `pontile_tipo_nome`) VALUES (1,'Posto Barca Mare'),(2,'Posto Barca Terra'),(3,'Abitazione'),(4,'Ufficio/Negozio'),(5,'Posto Auto'),(6,'Ripostiglio');
UNLOCK TABLES;
/*!40000 ALTER TABLE `blue_pontili_tipo` ENABLE KEYS */;

--
-- Table structure for table `blue_posti_barca`
--

DROP TABLE IF EXISTS `blue_posti_barca`;
CREATE TABLE `blue_posti_barca` (
  `posto_barca_id` int(11) unsigned NOT NULL auto_increment,
  `posto_barca_pontile` int(2) NOT NULL default '0',
  `posto_barca_numero` int(5) NOT NULL default '0',
  `posto_barca_sequenziale` int(5) NOT NULL default '0',
  `posto_barca_dimensioni` int(2) NOT NULL default '0',
  `posto_barca_descrizione` varchar(150) default NULL,
  `posto_barca_proprietario` int(10) NOT NULL default '0',
  `posto_barca_proprietario_data` date default NULL,
  `posto_barca_gestore` int(10) NOT NULL default '0',
  `posto_barca_gestore_data` date default NULL,
  `posto_barca_gestore_data_fine` date default NULL,
  `posto_barca_disponibile` int(1) NOT NULL default '0',
  PRIMARY KEY  (`posto_barca_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blue_posti_barca`
--


/*!40000 ALTER TABLE `blue_posti_barca` DISABLE KEYS */;
LOCK TABLES `blue_posti_barca` WRITE;
INSERT INTO `blue_posti_barca` (`posto_barca_id`, `posto_barca_pontile`, `posto_barca_numero`, `posto_barca_sequenziale`, `posto_barca_dimensioni`, `posto_barca_descrizione`, `posto_barca_proprietario`, `posto_barca_proprietario_data`, `posto_barca_gestore`, `posto_barca_gestore_data`, `posto_barca_gestore_data_fine`, `posto_barca_disponibile`) VALUES (1,1,1,1,6,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(2,1,2,2,6,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(3,1,3,3,6,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(4,1,4,4,6,NULL,1,'1991-12-06',1,'2007-01-01',NULL,1),(5,1,5,5,6,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(6,1,6,6,6,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(7,1,7,7,6,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(8,1,8,8,6,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(9,1,9,9,6,NULL,1,'1996-02-05',1,'2007-03-01',NULL,1),(10,1,10,10,6,NULL,1,'1996-02-05',1,'2007-03-01',NULL,1),(11,1,11,11,6,NULL,1,'1992-06-22',1,'2007-02-19',NULL,1),(12,1,12,12,6,NULL,1,'1996-02-05',1,'2007-03-01',NULL,1),(13,1,13,13,6,NULL,1,'1996-02-05',1,'2007-03-01',NULL,1),(14,1,14,14,6,NULL,1,'1996-02-05',1,'2007-03-01',NULL,1),(15,1,15,15,5,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(16,1,16,16,5,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(17,1,17,17,5,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(18,1,18,18,5,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(19,1,19,19,5,NULL,1,'1991-12-06',1,'2007-02-19',NULL,1),(20,1,20,20,5,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(21,1,21,21,5,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(22,1,22,22,5,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(23,1,23,23,5,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(24,1,24,24,5,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(25,1,25,25,5,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(26,1,26,26,5,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(27,1,27,27,5,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(28,1,28,28,6,NULL,1,'1992-12-10',1,'2007-02-19',NULL,1),(29,1,29,29,6,NULL,1,'1993-10-07',1,'2007-01-01',NULL,1),(30,1,30,30,6,NULL,1,'1992-02-07',1,'2007-02-19',NULL,1),(31,1,31,31,6,NULL,1,'1997-12-04',1,'2007-02-19',NULL,1),(32,1,32,32,6,NULL,1,'1992-06-22',1,'2007-02-19',NULL,1),(33,1,33,33,6,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(34,1,34,34,6,NULL,1,'1988-01-01',1,'2007-02-19',NULL,1),(35,1,35,35,5,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(36,1,36,36,5,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(37,1,37,37,5,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(38,1,38,38,5,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(39,1,39,39,5,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(40,1,40,40,5,NULL,1,'2002-01-01',1,'2007-02-19',NULL,1),(41,1,41,41,5,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(42,1,42,42,5,NULL,1,'1991-12-06',1,'2007-01-01',NULL,1),(43,1,43,43,5,NULL,1,'1997-12-06',1,'2007-02-19',NULL,1),(44,1,44,44,5,NULL,1,'2005-11-06',1,'2007-02-19',NULL,1),(45,1,45,45,5,NULL,1,'1997-12-06',1,'2007-02-19',NULL,1),(46,1,46,46,5,NULL,1,'1991-12-06',1,'2007-02-19',NULL,1),(47,1,47,47,5,NULL,1,'1997-01-20',1,'2007-02-19',NULL,1),(48,1,48,48,5,NULL,1,'1997-01-06',1,'2007-02-19',NULL,1),(49,1,49,49,4,NULL,1,'1992-06-22',1,'2007-02-19',NULL,1),(50,1,50,50,4,NULL,1,'2007-01-01',1,'2007-02-19',NULL,1),(51,1,51,51,4,NULL,1,'1991-12-04',1,'2007-02-19',NULL,1),(52,1,52,52,4,NULL,1,'1992-02-07',1,'2007-02-19',NULL,1),(53,1,53,53,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(54,1,54,54,4,NULL,1,'1991-12-06',1,'2007-02-19',NULL,1),(55,1,55,55,4,NULL,1,'1992-10-28',1,'2006-01-01',NULL,1),(56,1,56,56,4,NULL,1,'1998-09-01',1,'2007-04-01',NULL,1),(57,1,57,57,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(58,1,58,58,4,NULL,1,'2000-03-01',1,'2007-02-19',NULL,1),(59,1,59,59,4,NULL,1,'1991-12-06',1,'2007-01-01',NULL,1),(60,1,60,60,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(61,1,61,61,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(62,1,62,62,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(63,1,63,63,4,NULL,1,'2006-01-01',1,'2007-02-19',NULL,1),(64,1,64,64,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(65,1,65,65,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(66,1,66,66,4,NULL,1,'1996-11-17',1,'2007-02-19',NULL,1),(67,1,67,67,4,NULL,1,'2000-09-13',1,'2007-02-19',NULL,1),(68,1,68,68,4,NULL,1,'1997-03-15',1,'2007-02-19',NULL,1),(69,1,69,69,4,NULL,1,'1990-01-01',1,'2007-02-19',NULL,1),(70,1,70,70,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(71,1,71,71,4,NULL,1,'1991-12-06',1,'2007-02-19',NULL,1),(72,1,72,72,4,NULL,1,'1997-06-12',1,'2007-02-19',NULL,1),(73,1,73,73,4,NULL,1,'1991-12-06',1,'2007-02-19',NULL,1),(74,1,74,74,4,NULL,1,'1991-12-06',1,'2007-02-19',NULL,1),(75,1,75,75,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(76,1,76,76,4,NULL,1,'1991-12-06',1,'2007-04-01',NULL,1),(77,1,77,77,4,NULL,1,'1996-02-05',1,'2007-03-01',NULL,1),(78,1,78,78,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(79,1,79,79,4,NULL,1,'1992-06-22',1,'2007-02-19',NULL,1),(80,1,80,80,6,NULL,1,'1997-01-01',1,'2000-01-01',NULL,1),(81,1,81,81,6,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(82,1,82,82,6,NULL,1,'2007-02-19',1,'2007-01-01',NULL,1),(83,1,83,83,6,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(84,1,84,84,6,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(85,1,85,85,6,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(86,1,86,86,6,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(87,1,87,87,6,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(88,1,88,88,6,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(89,1,89,89,6,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(90,2,1,1,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(91,2,2,2,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(92,2,3,3,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(93,2,4,4,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(94,2,5,5,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(95,2,6,6,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(96,2,7,7,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(97,2,8,8,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(98,2,9,9,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(99,2,10,10,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(100,2,11,11,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(101,2,12,12,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(102,2,13,13,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(103,2,14,14,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(104,2,15,15,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(105,2,16,16,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(106,2,17,17,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(107,2,18,18,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(108,2,19,19,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(109,2,20,20,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(110,2,21,21,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(111,2,22,22,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(112,2,23,23,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(113,2,24,24,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(114,2,25,25,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(115,2,26,26,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(116,2,27,27,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(117,2,28,28,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(118,2,29,29,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(119,2,30,30,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(120,2,31,31,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(121,2,32,32,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(122,2,33,33,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(123,2,34,34,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(124,2,35,35,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(125,2,36,36,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(126,2,37,37,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(127,2,38,38,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(128,2,39,39,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(129,2,40,40,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(130,2,41,41,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(131,2,42,42,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(132,2,43,43,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(133,2,44,44,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(134,2,45,45,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(135,2,46,46,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(136,2,47,47,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(137,2,48,48,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(138,2,49,49,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(139,2,50,50,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(140,2,51,51,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(141,2,52,52,4,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(142,2,53,53,3,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(143,2,54,54,3,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(144,2,55,55,3,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(145,2,56,56,3,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(146,2,57,57,3,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(147,2,58,58,3,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(148,2,59,59,3,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(149,2,60,60,3,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(150,2,61,61,3,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(151,2,62,62,3,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(152,2,63,63,7,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(153,2,64,64,7,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(154,2,65,65,7,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(155,2,66,66,7,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(156,3,1,1,1,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(157,3,2,2,1,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(158,3,3,3,1,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(159,3,4,4,1,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(160,3,5,5,1,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(161,3,6,6,1,NULL,192,'2009-08-04',1,'2007-02-19',NULL,1),(162,3,7,7,1,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(163,3,8,8,1,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(164,3,9,9,1,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(165,3,10,10,1,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(166,3,11,11,1,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(167,3,12,12,1,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(168,3,13,13,1,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(169,3,14,14,1,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(170,3,15,15,1,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(171,3,16,16,1,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(172,3,17,17,1,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(173,3,18,18,1,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(174,3,19,19,1,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(175,3,20,20,1,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(176,3,21,21,1,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(177,3,22,22,1,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(178,3,23,23,1,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(179,3,24,24,1,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(180,3,25,25,1,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(181,3,26,26,1,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(182,3,27,27,1,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(183,3,28,28,1,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(184,3,29,29,1,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(185,3,30,30,1,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(186,3,31,31,1,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(187,3,32,32,1,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(188,3,33,33,1,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(189,3,34,34,1,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(190,3,35,35,1,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(191,3,36,36,1,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(192,3,37,37,2,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(193,3,38,38,2,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(194,3,39,39,2,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(195,3,40,40,2,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(196,3,41,41,2,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(197,3,42,42,2,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(198,3,43,43,2,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(199,3,44,44,2,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(200,3,45,45,2,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(201,3,46,46,2,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(202,3,47,47,2,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(203,3,48,48,2,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(204,3,49,49,2,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(205,3,50,50,2,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(206,3,51,51,2,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(207,3,52,52,2,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(208,3,53,53,2,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(209,3,54,54,2,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(210,3,55,55,2,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(211,3,56,56,2,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(212,3,57,57,2,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(213,3,58,58,2,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(214,3,59,59,2,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(215,3,60,60,2,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(216,3,61,61,2,NULL,1,'2007-02-19',1,'2007-02-19',NULL,1),(226,5,1,1,2,NULL,1,'2007-11-06',1,'2007-11-06',NULL,1),(227,5,2,2,2,NULL,1,'2007-11-06',1,'2007-11-06',NULL,1),(228,5,3,3,2,NULL,1,'2007-11-06',1,'2007-11-06',NULL,1),(229,5,4,4,2,NULL,1,'2007-11-06',1,'2007-11-06',NULL,1),(230,5,5,5,2,NULL,1,'2007-11-06',1,'2007-11-06',NULL,1),(231,5,6,6,2,NULL,1,'2007-11-06',1,'2007-11-06',NULL,1),(232,5,7,7,2,NULL,1,'2007-11-06',1,'2007-11-06',NULL,1),(233,5,8,8,2,NULL,1,'2007-11-06',1,'2007-11-06',NULL,1),(234,5,9,9,2,NULL,1,'2007-11-06',1,'2007-11-06',NULL,1),(235,5,10,10,2,NULL,1,'2007-11-06',1,'2007-11-06',NULL,1),(236,5,11,11,2,NULL,1,'2007-11-06',1,'2007-11-06',NULL,1),(237,5,12,12,2,NULL,1,'2007-11-06',1,'2007-11-06',NULL,1),(238,5,13,13,2,NULL,1,'2007-11-06',1,'2007-11-06',NULL,1),(239,5,14,14,2,NULL,1,'2007-11-06',1,'2007-11-06',NULL,1),(240,5,15,15,2,NULL,1,'2007-11-06',1,'2007-11-06',NULL,1),(241,5,16,16,2,NULL,1,'2007-11-06',1,'2007-11-06',NULL,1),(242,5,17,17,2,NULL,1,'2007-11-06',1,'2007-11-06',NULL,1),(243,5,18,18,2,NULL,1,'2007-11-06',1,'2007-11-06',NULL,1),(244,5,19,19,2,NULL,1,'2007-11-06',1,'2007-11-06',NULL,1),(245,5,20,20,2,NULL,1,'2007-11-06',1,'2007-11-06',NULL,1),(246,5,21,21,2,NULL,1,'2007-11-06',1,'2007-11-06',NULL,1),(247,5,22,22,2,NULL,1,'2007-11-06',1,'2007-11-06',NULL,1),(248,5,23,23,2,NULL,1,'2007-11-06',1,'2007-11-06',NULL,1),(249,5,24,24,2,NULL,1,'2007-11-06',1,'2007-11-06',NULL,1),(250,5,25,25,2,NULL,1,'2007-11-06',1,'2007-11-06',NULL,1),(251,5,26,26,2,NULL,1,'2007-11-06',1,'2007-11-06',NULL,1),(252,5,27,27,2,NULL,1,'2007-11-06',1,'2007-11-06',NULL,1),(253,5,28,28,2,NULL,1,'2007-11-06',1,'2007-11-06',NULL,1),(254,5,29,29,2,NULL,1,'2007-11-06',1,'2007-11-06',NULL,1),(255,1,0,0,5,NULL,1,'2009-08-03',1,'2009-08-03',NULL,1);
UNLOCK TABLES;
/*!40000 ALTER TABLE `blue_posti_barca` ENABLE KEYS */;

--
-- Table structure for table `blue_posti_barca_status`
--

DROP TABLE IF EXISTS `blue_posti_barca_status`;
CREATE TABLE `blue_posti_barca_status` (
  `status_id` int(10) unsigned NOT NULL auto_increment,
  `posto_barca` varchar(20) default NULL,
  `cliente` int(10) default NULL,
  `barca` int(10) default NULL,
  `inizio` varchar(20) default NULL,
  `fine` varchar(20) default NULL,
  `status` varchar(50) default NULL,
  `presenza` enum('0','1') default '0',
  `posto_barca_dimensioni` varchar(50) default '',
  PRIMARY KEY  (`status_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blue_posti_barca_status`
--


/*!40000 ALTER TABLE `blue_posti_barca_status` DISABLE KEYS */;
LOCK TABLES `blue_posti_barca_status` WRITE;
INSERT INTO `blue_posti_barca_status` (`status_id`, `posto_barca`, `cliente`, `barca`, `inizio`, `fine`, `status`, `presenza`, `posto_barca_dimensioni`) VALUES (1,'',0,0,'','','','',''),(2,'A1',0,0,'','','','','12,00 x 3,50'),(3,'A2',0,0,'','','','','12,00 x 3,50'),(4,'A3',0,0,'','','','','12,00 x 3,50'),(5,'A4',0,0,'','','','','12,00 x 3,50'),(6,'A5',0,0,'','','','','12,00 x 3,50'),(7,'A6',0,0,'','','','','12,00 x 3,50'),(8,'A7',0,0,'','','','','12,00 x 3,50'),(9,'A8',0,0,'','','','','12,00 x 3,50'),(10,'A9',0,0,'','','','','12,00 x 3,50'),(11,'A10',0,0,'','','','','12,00 x 3,50'),(12,'A11',0,0,'','','','','12,00 x 3,50'),(13,'A12',0,0,'','','','','12,00 x 3,50'),(14,'A13',0,0,'','','','','12,00 x 3,50'),(15,'A14',0,0,'','','','','12,00 x 3,50'),(16,'A15',0,0,'','','','','10,00 x 3,30'),(17,'A16',0,0,'','','','','10,00 x 3,30'),(18,'A17',0,0,'','','','','10,00 x 3,30'),(19,'A18',0,0,'','','','','10,00 x 3,30'),(20,'A19',0,0,'','','','','10,00 x 3,30'),(21,'A20',0,0,'','','','','10,00 x 3,30'),(22,'A21',0,0,'','','','','10,00 x 3,30'),(23,'A22',0,0,'','','','','10,00 x 3,30'),(24,'A23',0,0,'','','','','10,00 x 3,30'),(25,'A24',0,0,'','','','','10,00 x 3,30'),(26,'A25',0,0,'','','','','10,00 x 3,30'),(27,'A26',0,0,'','','','','10,00 x 3,30'),(28,'A27',0,0,'','','','','10,00 x 3,30'),(29,'A28',0,0,'','','','','12,00 x 3,50'),(30,'A29',0,0,'','','','','12,00 x 3,50'),(31,'A30',0,0,'','','','','12,00 x 3,50'),(32,'A31',0,0,'','','','','12,00 x 3,50'),(33,'A32',0,0,'','','','','12,00 x 3,50'),(34,'A33',0,0,'','','','','12,00 x 3,50'),(35,'A34',0,0,'','','','','12,00 x 3,50'),(36,'A35',0,0,'','','','','10,00 x 3,30'),(37,'A36',0,0,'','','','','10,00 x 3,30'),(38,'A37',0,0,'','','','','10,00 x 3,30'),(39,'A38',0,0,'','','','','10,00 x 3,30'),(40,'A39',0,0,'','','','','10,00 x 3,30'),(41,'A40',0,0,'','','','','10,00 x 3,30'),(42,'A41',0,0,'','','','','10,00 x 3,30'),(43,'A42',0,0,'','','','','10,00 x 3,30'),(44,'A43',0,0,'','','','','10,00 x 3,30'),(45,'A44',0,0,'','','','','10,00 x 3,30'),(46,'A45',0,0,'','','','','10,00 x 3,30'),(47,'A46',0,0,'','','','','10,00 x 3,30'),(48,'A47',0,0,'','','','','10,00 x 3,30'),(49,'A48',0,0,'','','','','10,00 x 3,30'),(50,'A49',0,0,'','','','','10,00 x 3,00'),(51,'A50',0,0,'','','','','10,00 x 3,00'),(52,'A51',0,0,'','','','','10,00 x 3,00'),(53,'A52',0,0,'','','','','10,00 x 3,00'),(54,'A53',0,0,'','','','','10,00 x 3,00'),(55,'A54',0,0,'','','','','10,00 x 3,00'),(56,'A55',0,0,'','','','','10,00 x 3,00'),(57,'A56',0,0,'','','','','10,00 x 3,00'),(58,'A57',0,0,'','','','','10,00 x 3,00'),(59,'A58',0,0,'','','','','10,00 x 3,00'),(60,'A59',0,0,'','','','','10,00 x 3,00'),(61,'A60',0,0,'','','','','10,00 x 3,00'),(62,'A61',0,0,'','','','','10,00 x 3,00'),(63,'A62',0,0,'','','','','10,00 x 3,00'),(64,'A63',0,0,'','','','','10,00 x 3,00'),(65,'A64',0,0,'','','','','10,00 x 3,00'),(66,'A65',0,0,'','','','','10,00 x 3,00'),(67,'A66',0,0,'','','','','10,00 x 3,00'),(68,'A67',0,0,'','','','','10,00 x 3,00'),(69,'A68',0,0,'','','','','10,00 x 3,00'),(70,'A69',0,0,'','','','','10,00 x 3,00'),(71,'A70',0,0,'','','','','10,00 x 3,00'),(72,'A71',0,0,'','','','','10,00 x 3,00'),(73,'A72',0,0,'','','','','10,00 x 3,00'),(74,'A73',0,0,'','','','','10,00 x 3,00'),(75,'A74',0,0,'','','','','10,00 x 3,00'),(76,'A75',0,0,'','','','','10,00 x 3,00'),(77,'A76',0,0,'','','','','10,00 x 3,00'),(78,'A77',0,0,'','','','','10,00 x 3,00'),(79,'A78',0,0,'','','','','10,00 x 3,00'),(80,'A79',0,0,'','','','','10,00 x 3,00'),(81,'A80',0,0,'','','','','12,00 x 3,50'),(82,'A81',0,0,'','','','','12,00 x 3,50'),(83,'A82',0,0,'','','','','12,00 x 3,50'),(84,'A83',0,0,'','','','','12,00 x 3,50'),(85,'A84',0,0,'','','','','12,00 x 3,50'),(86,'A85',0,0,'','','','','12,00 x 3,50'),(87,'A86',0,0,'','','','','12,00 x 3,50'),(88,'A87',0,0,'','','','','12,00 x 3,50'),(89,'A88',0,0,'','','','','12,00 x 3,50'),(90,'A89',0,0,'','','','','12,00 x 3,50'),(91,'C1',0,0,'','','','','10,00 x 3,00'),(92,'C2',0,0,'','','','','10,00 x 3,00'),(93,'C3',0,0,'','','','','10,00 x 3,00'),(94,'C4',0,0,'','','','','10,00 x 3,00'),(95,'C5',0,0,'','','','','10,00 x 3,00'),(96,'C6',0,0,'','','','','10,00 x 3,00'),(97,'C7',0,0,'','','','','10,00 x 3,00'),(98,'C8',0,0,'','','','','10,00 x 3,00'),(99,'C9',0,0,'','','','','10,00 x 3,00'),(100,'C10',0,0,'','','','','10,00 x 3,00'),(101,'C11',0,0,'','','','','10,00 x 3,00'),(102,'C12',0,0,'','','','','10,00 x 3,00'),(103,'C13',0,0,'','','','','10,00 x 3,00'),(104,'C14',0,0,'','','','','10,00 x 3,00'),(105,'C15',0,0,'','','','','10,00 x 3,00'),(106,'C16',0,0,'','','','','10,00 x 3,00'),(107,'C17',0,0,'','','','','10,00 x 3,00'),(108,'C18',0,0,'','','','','10,00 x 3,00'),(109,'C19',0,0,'','','','','10,00 x 3,00'),(110,'C20',0,0,'','','','','10,00 x 3,00'),(111,'C21',0,0,'','','','','10,00 x 3,00'),(112,'C22',0,0,'','','','','10,00 x 3,00'),(113,'C23',0,0,'','','','','10,00 x 3,00'),(114,'C24',0,0,'','','','','10,00 x 3,00'),(115,'C25',0,0,'','','','','10,00 x 3,00'),(116,'C26',0,0,'','','','','10,00 x 3,00'),(117,'C27',0,0,'','','','','10,00 x 3,00'),(118,'C28',0,0,'','','','','10,00 x 3,00'),(119,'C29',0,0,'','','','','10,00 x 3,00'),(120,'C30',0,0,'','','','','10,00 x 3,00'),(121,'C31',0,0,'','','','','10,00 x 3,00'),(122,'C32',0,0,'','','','','10,00 x 3,00'),(123,'C33',0,0,'','','','','10,00 x 3,00'),(124,'C34',0,0,'','','','','10,00 x 3,00'),(125,'C35',0,0,'','','','','10,00 x 3,00'),(126,'C36',0,0,'','','','','10,00 x 3,00'),(127,'C37',0,0,'','','','','10,00 x 3,00'),(128,'C38',0,0,'','','','','10,00 x 3,00'),(129,'C39',0,0,'','','','','10,00 x 3,00'),(130,'C40',0,0,'','','','','10,00 x 3,00'),(131,'C41',0,0,'','','','','10,00 x 3,00'),(132,'C42',0,0,'','','','','10,00 x 3,00'),(133,'C43',0,0,'','','','','10,00 x 3,00'),(134,'C44',0,0,'','','','','10,00 x 3,00'),(135,'C45',0,0,'','','','','10,00 x 3,00'),(136,'C46',0,0,'','','','','10,00 x 3,00'),(137,'C47',0,0,'','','','','10,00 x 3,00'),(138,'C48',0,0,'','','','','10,00 x 3,00'),(139,'C49',0,0,'','','','','10,00 x 3,00'),(140,'C50',0,0,'','','','','10,00 x 3,00'),(141,'C51',0,0,'','','','','10,00 x 3,00'),(142,'C52',0,0,'','','','','10,00 x 3,00'),(143,'C53',0,0,'','','','','8,00 x 2,60'),(144,'C54',0,0,'','','','','8,00 x 2,60'),(145,'C55',0,0,'','','','','8,00 x 2,60'),(146,'C56',0,0,'','','','','8,00 x 2,60'),(147,'C57',0,0,'','','','','8,00 x 2,60'),(148,'C58',0,0,'','','','','8,00 x 2,60'),(149,'C59',0,0,'','','','','8,00 x 2,60'),(150,'C60',0,0,'','','','','8,00 x 2,60'),(151,'C61',0,0,'','','','','8,00 x 2,60'),(152,'C62',0,0,'','','','','8,00 x 2,60'),(153,'C63',0,0,'','','','','12,00 x 4,00'),(154,'C64',0,0,'','','','','12,00 x 4,00'),(155,'C65',0,0,'','','','','12,00 x 4,00'),(156,'C66',0,0,'','','','','12,00 x 4,00'),(157,'T1',193,194,'2009-08-04','2009-08-12','Affitto','1','9,00 x 2,70'),(158,'T2',0,0,'','','','','9,00 x 2,70'),(159,'T3',0,0,'','','','','9,00 x 2,70'),(160,'T4',0,0,'','','','','9,00 x 2,70'),(161,'T5',0,0,'','','','','9,00 x 2,70'),(162,'T6',192,0,'2009-08-04','2059-08-04','Vendita','','9,00 x 2,70'),(163,'T7',0,0,'','','','','9,00 x 2,70'),(164,'T8',0,0,'','','','','9,00 x 2,70'),(165,'T9',0,0,'','','','','9,00 x 2,70'),(166,'T10',0,0,'','','','','9,00 x 2,70'),(167,'T11',0,0,'','','','','9,00 x 2,70'),(168,'T12',0,0,'','','','','9,00 x 2,70'),(169,'T13',0,0,'','','','','9,00 x 2,70'),(170,'T14',0,0,'','','','','9,00 x 2,70'),(171,'T15',0,0,'','','','','9,00 x 2,70'),(172,'T16',0,0,'','','','','9,00 x 2,70'),(173,'T17',0,0,'','','','','9,00 x 2,70'),(174,'T18',0,0,'','','','','9,00 x 2,70'),(175,'T19',0,0,'','','','','9,00 x 2,70'),(176,'T20',0,0,'','','','','9,00 x 2,70'),(177,'T21',0,0,'','','','','9,00 x 2,70'),(178,'T22',0,0,'','','','','9,00 x 2,70'),(179,'T23',0,0,'','','','','9,00 x 2,70'),(180,'T24',0,0,'','','','','9,00 x 2,70'),(181,'T25',0,0,'','','','','9,00 x 2,70'),(182,'T26',0,0,'','','','','9,00 x 2,70'),(183,'T27',0,0,'','','','','9,00 x 2,70'),(184,'T28',0,0,'','','','','9,00 x 2,70'),(185,'T29',0,0,'','','','','9,00 x 2,70'),(186,'T30',0,0,'','','','','9,00 x 2,70'),(187,'T31',0,0,'','','','','9,00 x 2,70'),(188,'T32',0,0,'','','','','9,00 x 2,70'),(189,'T33',0,0,'','','','','9,00 x 2,70'),(190,'T34',0,0,'','','','','9,00 x 2,70'),(191,'T35',0,0,'','','','','9,00 x 2,70'),(192,'T36',0,0,'','','','','9,00 x 2,70'),(193,'T37',0,0,'','','','','8,00 x 2,50'),(194,'T38',0,0,'','','','','8,00 x 2,50'),(195,'T39',0,0,'','','','','8,00 x 2,50'),(196,'T40',0,0,'','','','','8,00 x 2,50'),(197,'T41',0,0,'','','','','8,00 x 2,50'),(198,'T42',0,0,'','','','','8,00 x 2,50'),(199,'T43',0,0,'','','','','8,00 x 2,50'),(200,'T44',0,0,'','','','','8,00 x 2,50'),(201,'T45',0,0,'','','','','8,00 x 2,50'),(202,'T46',0,0,'','','','','8,00 x 2,50'),(203,'T47',0,0,'','','','','8,00 x 2,50'),(204,'T48',0,0,'','','','','8,00 x 2,50'),(205,'T49',0,0,'','','','','8,00 x 2,50'),(206,'T50',0,0,'','','','','8,00 x 2,50'),(207,'T51',0,0,'','','','','8,00 x 2,50'),(208,'T52',0,0,'','','','','8,00 x 2,50'),(209,'T53',0,0,'','','','','8,00 x 2,50'),(210,'T54',0,0,'','','','','8,00 x 2,50'),(211,'T55',0,0,'','','','','8,00 x 2,50'),(212,'T56',0,0,'','','','','8,00 x 2,50'),(213,'T57',0,0,'','','','','8,00 x 2,50'),(214,'T58',0,0,'','','','','8,00 x 2,50'),(215,'T59',0,0,'','','','','8,00 x 2,50'),(216,'T60',0,0,'','','','','8,00 x 2,50'),(217,'T61',0,0,'','','','','8,00 x 2,50'),(218,'P1',0,0,'','','','','8,00 x 2,50'),(219,'P2',0,0,'','','','','8,00 x 2,50'),(220,'P3',0,0,'','','','','8,00 x 2,50'),(221,'P4',0,0,'','','','','8,00 x 2,50'),(222,'P5',0,0,'','','','','8,00 x 2,50'),(223,'P6',0,0,'','','','','8,00 x 2,50'),(224,'P7',0,0,'','','','','8,00 x 2,50'),(225,'P8',0,0,'','','','','8,00 x 2,50'),(226,'P9',0,0,'','','','','8,00 x 2,50'),(227,'P10',0,0,'','','','','8,00 x 2,50'),(228,'P11',0,0,'','','','','8,00 x 2,50'),(229,'P12',0,0,'','','','','8,00 x 2,50'),(230,'P13',0,0,'','','','','8,00 x 2,50'),(231,'P14',0,0,'','','','','8,00 x 2,50'),(232,'P15',0,0,'','','','','8,00 x 2,50'),(233,'P16',0,0,'','','','','8,00 x 2,50'),(234,'P17',0,0,'','','','','8,00 x 2,50'),(235,'P18',0,0,'','','','','8,00 x 2,50'),(236,'P19',0,0,'','','','','8,00 x 2,50'),(237,'P20',0,0,'','','','','8,00 x 2,50'),(238,'P21',0,0,'','','','','8,00 x 2,50'),(239,'P22',0,0,'','','','','8,00 x 2,50'),(240,'P23',0,0,'','','','','8,00 x 2,50'),(241,'P24',0,0,'','','','','8,00 x 2,50'),(242,'P25',0,0,'','','','','8,00 x 2,50'),(243,'P26',0,0,'','','','','8,00 x 2,50'),(244,'P27',0,0,'','','','','8,00 x 2,50'),(245,'P28',0,0,'','','','','8,00 x 2,50'),(246,'P29',0,0,'','','','','8,00 x 2,50'),(247,'A0',0,0,'','','','','10,00 x 3,30');
UNLOCK TABLES;
/*!40000 ALTER TABLE `blue_posti_barca_status` ENABLE KEYS */;

--
-- Table structure for table `blue_presenze`
--

DROP TABLE IF EXISTS `blue_presenze`;
CREATE TABLE `blue_presenze` (
  `presenza_id` int(11) unsigned NOT NULL auto_increment,
  `presenza_posto_barca` int(11) default NULL,
  `presenza_cliente` int(11) default NULL,
  `presenza_barca` int(10) default NULL,
  `presenza_arrivo` date default NULL,
  `presenza_partenza` date default NULL,
  PRIMARY KEY  (`presenza_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blue_presenze`
--


/*!40000 ALTER TABLE `blue_presenze` DISABLE KEYS */;
LOCK TABLES `blue_presenze` WRITE;
INSERT INTO `blue_presenze` (`presenza_id`, `presenza_posto_barca`, `presenza_cliente`, `presenza_barca`, `presenza_arrivo`, `presenza_partenza`) VALUES (68,156,193,194,'2009-08-04','2009-08-12');
UNLOCK TABLES;
/*!40000 ALTER TABLE `blue_presenze` ENABLE KEYS */;

--
-- Table structure for table `blue_province`
--

DROP TABLE IF EXISTS `blue_province`;
CREATE TABLE `blue_province` (
  `provincia_nome` varchar(150) NOT NULL default '',
  `provincia_sigla` char(2) NOT NULL default '',
  PRIMARY KEY  (`provincia_sigla`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blue_province`
--


/*!40000 ALTER TABLE `blue_province` DISABLE KEYS */;
LOCK TABLES `blue_province` WRITE;
INSERT INTO `blue_province` (`provincia_nome`, `provincia_sigla`) VALUES ('Agrigento','AG'),('Alessandria','AL'),('Ancona','AN'),('Aosta','AO'),('Aquila','AQ'),('Arezzo','AR'),('Ascoli-Piceno','AP'),('Asti','AT'),('Avellino','AV'),('Bari','BA'),('Belluno','BL'),('Benevento','BN'),('Bergamo','BG'),('Biella','BI'),('Bologna','BO'),('Bolzano','BZ'),('Brescia','BS'),('Brindisi','BR'),('Cagliari','CA'),('Caltanissetta','CL'),('Campobasso','CB'),('Caserta','CE'),('Catania','CT'),('Catanzaro','CZ'),('Chieti','CH'),('Como','CO'),('Cosenza','CS'),('Cremona','CR'),('Crotone','KR'),('Cuneo','CN'),('Enna','EN'),('Ferrara','FE'),('Firenze','FI'),('Foggia','FG'),('Forli-Cesena','FO'),('Frosinone','FR'),('Genova','GE'),('Gorizia','GO'),('Grosseto','GR'),('Imperia','IM'),('Isernia','IS'),('La-Spezia','SP'),('Latina','LT'),('Lecce','LE'),('Lecco','LC'),('Livorno','LI'),('Lodi','LO'),('Lucca','LU'),('Macerata','MC'),('Mantova','MN'),('Massa-Carrara','MS'),('Matera','MT'),('Messina','ME'),('Milano','MI'),('Modena','MO'),('Napoli','NA'),('Novara','NO'),('Nuoro','NU'),('Oristano','OR'),('Padova','PD'),('Palermo','PA'),('Parma','PR'),('Pavia','PV'),('Perugia','PG'),('Pescara','PE'),('Pesaro-Urbino','PS'),('Piacenza','PC'),('Pisa','PI'),('Pistoia','PT'),('Pordenone','PN'),('Potenza','PZ'),('Prato','PO'),('Ragusa','RG'),('Ravenna','RA'),('Reggio-Calabria','RC'),('Reggio-Emilia','RE'),('Rieti','RI'),('Rimini','RN'),('Roma','RM'),('Rovigo','RO'),('Salerno','SA'),('Sassari','SS'),('Savona','SV'),('Siena','SI'),('Siracusa','SR'),('Sondrio','SO'),('Taranto','TA'),('Teramo','TE'),('Terni','TR'),('Torino','TO'),('Trapani','TP'),('Trento','TN'),('Treviso','TV'),('Trieste','TS'),('Udine','UD'),('Varese','VA'),('Venezia','VE'),('Verbania','VB'),('Vercelli','VC'),('Verona','VR'),('Vibo-Valentia','VV'),('Vicenza','VI'),('Viterbo','VT'),('Non DIsponibile','');
UNLOCK TABLES;
/*!40000 ALTER TABLE `blue_province` ENABLE KEYS */;

--
-- Table structure for table `blue_scadenze`
--

DROP TABLE IF EXISTS `blue_scadenze`;
CREATE TABLE `blue_scadenze` (
  `scadenza_id` int(10) unsigned NOT NULL auto_increment,
  `scadenza_data` date default NULL,
  `scadenza_descrizione_breve` varchar(200) default NULL,
  `scadenza_descrizione_lunga` text,
  `scadenza_file` varchar(200) default NULL,
  `scadenza_status` enum('Aperto','Chiuso') default 'Aperto',
  `scadenza_data_chiusura` date default NULL,
  PRIMARY KEY  (`scadenza_id`),
  KEY `descrizione_breve` (`scadenza_descrizione_breve`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blue_scadenze`
--


/*!40000 ALTER TABLE `blue_scadenze` DISABLE KEYS */;
LOCK TABLES `blue_scadenze` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `blue_scadenze` ENABLE KEYS */;

--
-- Table structure for table `blue_tipologie_barche`
--

DROP TABLE IF EXISTS `blue_tipologie_barche`;
CREATE TABLE `blue_tipologie_barche` (
  `tipologia_barca_id` int(5) unsigned NOT NULL auto_increment,
  `tipologia_barca_nome` varchar(200) NOT NULL default '',
  PRIMARY KEY  (`tipologia_barca_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blue_tipologie_barche`
--


/*!40000 ALTER TABLE `blue_tipologie_barche` DISABLE KEYS */;
LOCK TABLES `blue_tipologie_barche` WRITE;
INSERT INTO `blue_tipologie_barche` (`tipologia_barca_id`, `tipologia_barca_nome`) VALUES (1,'barca a motore'),(2,'barca a vela'),(3,'catamarano'),(4,'trimarano'),(5,'motopesca'),(6,'gommone'),(7,'natante'),(8,'varie'),(9,'auto'),(10,'camion'),(11,'autobus'),(12,'roulotte'),(13,'camper');
UNLOCK TABLES;
/*!40000 ALTER TABLE `blue_tipologie_barche` ENABLE KEYS */;

--
-- Table structure for table `blue_utenti`
--

DROP TABLE IF EXISTS `blue_utenti`;
CREATE TABLE `blue_utenti` (
  `utente_id` int(11) unsigned NOT NULL auto_increment,
  `utente_username` varchar(50) default NULL,
  `utente_password` varchar(32) default NULL,
  `utente_nominativo` varchar(150) default NULL,
  `utente_telefono` varchar(20) default NULL,
  `utente_email` varchar(100) default NULL,
  `utente_accesso_principale` enum('N','R','W') default 'N',
  `utente_accesso_contratti` enum('N','R','W') default 'N',
  `utente_accesso_anagrafica` enum('N','R','W') default 'N',
  `utente_accesso_imbarcazioni` enum('N','R','W') default 'N',
  `utente_accesso_posti_barca` enum('N','R','W') default 'N',
  `utente_accesso_documenti` enum('N','R','W') default 'N',
  `utente_accesso_fatture` enum('N','R','W') default 'N',
  `utente_accesso_template` enum('N','R','W') default 'N',
  `utente_accesso_listini` enum('N','R','W') default 'N',
  `utente_accesso_preferenze` enum('N','R','W') default 'N',
  PRIMARY KEY  (`utente_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blue_utenti`
--


/*!40000 ALTER TABLE `blue_utenti` DISABLE KEYS */;
LOCK TABLES `blue_utenti` WRITE;
INSERT INTO `blue_utenti` (`utente_id`, `utente_username`, `utente_password`, `utente_nominativo`, `utente_telefono`, `utente_email`, `utente_accesso_principale`, `utente_accesso_contratti`, `utente_accesso_anagrafica`, `utente_accesso_imbarcazioni`, `utente_accesso_posti_barca`, `utente_accesso_documenti`, `utente_accesso_fatture`, `utente_accesso_template`, `utente_accesso_listini`, `utente_accesso_preferenze`) VALUES (1,'admin','4f3b19063fb8bfe28f687196dcdcb3ae','Amministratore','','','W','W','W','W','W','W','W','W','W','W');
UNLOCK TABLES;
/*!40000 ALTER TABLE `blue_utenti` ENABLE KEYS */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

