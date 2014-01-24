<?php

// Load vendor
require_once dirname(__FILE__) . "/vendor/autoload.php";

require_once "app/init.php";

// Definizione di alcune costanti utili in tutta l'applicazione
defined("APPLICATION_NAME") or define("APPLICATION_NAME", "Blueshell");
defined("APPLICATION_VERSION") or define("APPLICATION_VERSION", "2.0.0-alfa");
define("ELEMENTI_PER_PAGINA", 20);

define("DATABASE_HOST", $dbhost);
define("DATABASE_USERNAME", $dbuser);
define("DATABASE_PASSWORD", $dbpass);
define("DATABASE_NAME", $dbdata);
define("DATABASE_PREFIX", $dbprefix);

if (isset($port_name)) {
    define("APPLICATION_PORT_NAME", $port_name);
}

if (isset($base_url)) {
    $base_url = rtrim($base_url, '/');
    defined("APPLICATION_BASE_URL") or define("APPLICATION_BASE_URL", $base_url);
}

// Get license key from configuration
define("LICENSE_KEY", $license_key);

// Check writable path
$my_path = array(
    __DIR__ . "/app/protected/runtime",
    __DIR__ . "/app/protected/runtime/temp",
    __DIR__ . "/app/protected/runtime/templates_c",
    __DIR__ . "/template",
    __DIR__ . "/upload",
);
foreach ($my_path as $path) {
    if (!file_exists($path)) {
        if (@mkdir($path) === false) {
            die($path . " must exists.");
        }
    }
    if (!is_writable($path)) {
        if (@chmod($path, 0777) === false) {
            die($path . " must be writable by webserver.");
        }
    }    
}

// Avvio sessione
// session_name("Blue");
// session_start();

// Impostazioni Locali
// setlocale(LC_ALL,"it_IT.utf8"); // DA NON USARE MAI!!!

$alfabeto=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
// Array che contiene tutte le lettere dell'alfabeto

$prefisso = DATABASE_PREFIX;
$tabelle=array( 
    'assicurazioni'         => $prefisso . 'assicurazioni',
    'barche'                => $prefisso . 'barche',
    'barche_trasferimenti'  => $prefisso . 'barche_trasferimenti',
    'clienti'               => $prefisso . 'clienti',
    'clienti_note'          => $prefisso . 'clienti_note',
    'contratti'             => $prefisso . 'contratti',
    'contratti_periodi'     => $prefisso . 'contratti_periodi',
    'contratti_tipo'        => $prefisso . 'contratti_tipo',               
    'costruttori'           => $prefisso . 'costruttori',
    'dimensioni'            => $prefisso . 'dimensioni',
    'nazioni'               => $prefisso . 'nazioni',
    'pontili'               => $prefisso . 'pontili',
    'pontili_tipo'          => $prefisso . 'pontili_tipo',
    'posti_barca'           => $prefisso . 'posti_barca',
    'tipologie_barche'      => $prefisso . 'tipologie_barche',
    'scadenze'              => $prefisso . 'scadenze',
    'utenti'                => $prefisso . 'utenti',
    'posti_barca_status'    => $prefisso . 'posti_barca_status',
    'listini_posti_barca'   => $prefisso . 'listini_posti_barca',
    'listini_condominiali'  => $prefisso . 'listini_condominiali',
    'listini_generici'      => $prefisso . 'listini_generici',
    'fatture'               => $prefisso . 'fatture',
    'fatture_righe'         => $prefisso . 'fatture_righe',
    'presenze'              => $prefisso . 'presenze',
    'prima_nota'            => $prefisso . 'prima_nota',
);


if (!isset($currency)) {
    $currency = "EUR";
}
define("APPLICATION_CURRENCY", $currency);

require_once "class/Mysql.php";
require_once "class/Form.php";
require_once "class/Blue.php";
require_once "class/Rtf.php";

$sql = new MySql($dbhost,$dbuser,$dbpass,$dbdata);
$form = new Form($_POST);
$blue = new Blue($dbhost,$dbuser,$dbpass,$dbdata);

$sql->general_query("SET NAMES 'utf8'");

$blue->tabelle=$tabelle;
// Prefisso ed Array delle tabelle
$blue->pagina_login="login.php";
$blue->pagina_accesso_vietato="utente_accesso_vietato.php";
// Definizione delle pagine per login ed accesso vietato

if (isset($vat_percentage)) {
    define("VAT_PERCENTAGE", $vat_percentage);
} else {
    define("VAT_PERCENTAGE", 0);
}

defined("APPLICATION_LOAD_WEBINTERFACE") or define("APPLICATION_LOAD_WEBINTERFACE", true);
if (APPLICATION_LOAD_WEBINTERFACE) {
    require_once "init_webinterface.inc.php";
}
