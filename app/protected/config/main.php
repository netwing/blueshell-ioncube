<?php

// Default configuration file
// If you want to override any configuration
// please create a config.php file in the same directory of this file
// and rewrite only what you want to change

// *** DO NOT OVERWRITE THIS FILE!!! ***

// ***************************
// *** COSTANTS DEFINITION ***
// ***************************

define("APPLICATION_NAME", "BlueShell");
define("APPLICATION_VERSION", "2.0.0-alpha");
define("APPLICATION_SOFTWARE_HOUSE", "Netwing SRL");
define("APPLICATION_PATH", dirname(__FILE__) . DIRECTORY_SEPARATOR . '..');

// *********************
// *** CONFIGURATION ***
// *********************
// Config debug and trace level
$yii_debug = false;
$yii_trace_level = 1;

// Config debug and trace level for console
$yiic_debug = false;
$yiic_trace_level = 1;

// CSRF Validation
defined("APPLICATION_ENABLE_CSRF_VALIDATION") or define("APPLICATION_ENABLE_CSRF_VALIDATION", true);

// Main configuration array
$config = array(
    
    'basePath'  => APPLICATION_PATH,
    'name'      => APPLICATION_NAME,
    'theme'     => 'cerulean',
    'timeZone'  => 'Europe/London',
    'language'  => 'en',
    
    // path aliases
    'aliases' => array(
        'vendor'        => realpath(__DIR__ . '/../../../vendor'),
        'bootstrap'     => realpath(__DIR__ . '/../extensions/netwing/bootstrap'),
        'bower'         => realpath(__DIR__ . '/../../../bower_components'),
        //Path to your Composer vendor dir plus starship/restfullyii path
        // 'RestfullYii'   => realpath(__DIR__ . '/../../../vendor/starship/restfullyii/starship/RestfullYii'),
        
    ),

    // preloading 'log' component
    'preload'   => array(
        'log',
    ),

    // autoloading model and component classes
    'import'    => array(
        'application.models.*',
        'application.components.*',
        'application.modules.admin.models.*',
    ),

    'modules'   => array(

        'admin',
        'example',
        'v1',
        
        // Yii code generator
        'gii' => array(
            'class'             => 'system.gii.GiiModule',
            'password'          => 'develop',
            'generatorPaths'    => array(
                'application.gii',
            ),
            'newFileMode'       => 0776,
            'newDirMode'        => 0777,
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            // Default to only local net 192.168.*.* and localhost
            'ipFilters'         => array('192.168.*.*', '127.0.0.1', '::1'),
        ),

    ),

    'components'    => array(

        // *** YII DEFAULT COMPONENTS ***
        // Request
        'request' => array(
            'enableCsrfValidation' => APPLICATION_ENABLE_CSRF_VALIDATION,
            'enableCookieValidation' => true,
            'class'=>'HttpRequest',
            'noCsrfValidationRoutes'=>array(
                'site/contact',
            ),
        ),

        // Assets component
        'assetManager' => array(
            'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'assets',
            'baseUrl'  => '../assets/',
        ),
        // Main log component
        'log' => array(
            'class'=>'CLogRouter',
            // Routes for logging
            'routes'=>array(
                
                // Log errors and warnings in errors.log
                'error' => array(
                    'class'         => 'CFileLogRoute',
                    'levels'        => 'error, warning',
                    'logfile'       => 'error.log',
                    'enabled'       => true,
                    'maxFileSize'   => 20480,
                    'maxLogFiles'   => 10,
                ),
                
                // Log errors, warnings and info in application.log
                'application' => array(
                    'class'     => 'CFileLogRoute',
                    'levels'    => 'error, warning, info',
                    'logfile'   => 'application.log',
                    'enabled'   => true,
                    'maxFileSize'   => 20480,
                    'maxLogFiles'   => 10,
                ),
                
                // Log trace query in query.log
                'query' => array(
                    'class'         => 'CFileLogRoute',
                    'logfile'       => 'query.log',
                    'categories'    => 'system.db.CDbCommand',
                    'levels'        => 'trace, info, warning, error',
                    'enabled'       => true,
                    'maxFileSize'   => 20480,
                    'maxLogFiles'   => 10,
                ),

                // Log trace in debug.log
                'debug' => array(
                    'class'         => 'CFileLogRoute',
                    'logfile'       => 'debug.log',
                    'levels'        => 'trace',
                    'enabled'       => true,
                    'maxFileSize'   => 20480,
                    'maxLogFiles'   => 10,
                ),
                // Debug toolbar
                'toolbar' => array(
                    'class'     => 'vendor.malyshev.yii-debug-toolbar.YiiDebugToolbarRoute',
                    'ipFilters' => array('0.0.0.0/0'),
                    'enabled'   => false,
                ),
            ),
        ), // end of log route array
/*
        'urlManager'=>array(
            'urlFormat' => 'path',
            'rules' => require(
                dirname(__FILE__) . '/../../../vendor/starship/restfullyii/starship/RestfullYii/config/routes.php'
            ),
            /*
            'rules'=>array(
                'app/' => array('route1', 'urlSuffix'=>'.xml', 'caseSensitive'=>false),                
            ),
            */
//        ),

        // Database connection
        'db' => array(
            'connectionString'      => 'mysql:host=localhost;dbname=yiiapp',
            'emulatePrepare'        => true,
            'username'              => 'username',
            'password'              => 'password',
            'charset'               => 'utf8',
            'tablePrefix'           => null,
            'enableParamLogging'    => true,
            'enableProfiling'       => true,
            // 'queryCacheID'          => 'redis',
            // 'schemaCacheID'         => 'redis',
            // 'schemaCachingDuration' =>  3600,
        ),

        // User authentication and login
        'user' => array(
            'class'             => 'WebUser',
            'allowAutoLogin'    => true,
        ),

        // Route for error handler
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),

        // Authorization manager for RBAC
        'authManager'=>array(
            'class'=>'CDbAuthManager',
        ),

        // Redis cache
        'cache'=>array(
            'class'     => 'CRedisCache',
            'hostname'  => 'localhost',
            'port'      => 6379,
            'database'  => 0,
        ),

        // *** THIRD PARTY COMPONENTS

        // *** NETWING COMPONENTS ***
        
        // Custom bootstrap css and js inclusion
        'bootstrap'     => array(
            'class'     => 'ext.netwing.bootstrap.Bootstrap',
        ),

        // Redis component - Actually using Predis for more advanced features
        'redis'         => array(
            'class'     => 'ext.netwing.redis.Redis',
            'servers'   => array(
                'host'  =>  'localhost',
                'port'  =>  6379,
            ),
            'database'  => 1, // 0 is used for caching purpose, see 'cache' component config
            'prefix'    => "",
        ),

        // Font awesome component for publish assets and register link to css
        'fontAwesome'   => array(
            'class'     => 'ext.netwing.font-awesome.FontAwesome',
        ),

        // Timepicker component for publish assets and register link to css
        'timepicker'   => array(
            'class'     => 'ext.netwing.timepicker.Timepicker',
        ),

        // Custom formatter
        'format' => array(
            'class' => 'MyFormatter',
        ),

        // jQuery Full Calendar
        'calendar' => array(
            'class' => 'ext.netwing.calendar.Calendar',
        ),

        // jQuery Select2
        'select2' => array(
            'class' => 'ext.netwing.select2.Select2',
        ),

        // jQuery Select2
        'minicolors' => array(
            'class' => 'ext.netwing.minicolors.Minicolors',
        ),

        // Brdige from old to new app
        'bridge' => array(
            'class' => 'Bridge',
        ),

    ),

    // *** APPLICATION PARAMETER
    // This can be accessed using Yii::app()->params['paramName']
    'params'    => array(
        // this is used in contact page
        'adminEmail'  => 'info@netwing.it',
        'podioRequestEmail' => 'richieste.33a13162@collaborazione-progetti.netwingit.podio.com',
    ),    

);

if (!file_exists(dirname(__FILE__) . '/config.php')) {
    if (PHP_SAPI == 'cli') {
        echo "*** Configuration not found! ***" . PHP_EOL;
        echo "Please copy ./protected/config/config.php.example in ./protected/config/config.php and set the correct configuration parameters." . PHP_EOL . PHP_EOL;
    } else {
        echo "<html><head></head><body>";
        echo "<h1>Configuration not found!</h1>";
        echo "<p>Please copy <strong>./protected/config/config.php.example</strong> to <strong>./protected/config/config.php</strong> and set the correct configuration parameters.</p>";
        echo "</body></html>";
    }
    exit;
}

// Load user configuration
// in this file, you can overwrite any configuration
require_once "config.php";

$config['timeZone'] = APPLICATION_TIMEZONE;

$config['components']['log']['routes']['error']['maxFileSize']       = LOG_MAX_FILE_SIZE;
$config['components']['log']['routes']['error']['maxLogFiles']       = LOG_MAX_LOG_FILES;
$config['components']['log']['routes']['error']['enabled']           = LOG_ERROR_ENABLED;
$config['components']['log']['routes']['application']['maxFileSize'] = LOG_MAX_FILE_SIZE;
$config['components']['log']['routes']['application']['maxLogFiles'] = LOG_MAX_LOG_FILES;
$config['components']['log']['routes']['application']['enabled']     = LOG_APPLICATION_ENABLED;
$config['components']['log']['routes']['query']['maxFileSize']       = LOG_MAX_FILE_SIZE;
$config['components']['log']['routes']['query']['maxLogFiles']       = LOG_MAX_LOG_FILES;
$config['components']['log']['routes']['query']['enabled']           = LOG_QUERY_ENABLED;
$config['components']['log']['routes']['debug']['maxFileSize']       = LOG_MAX_FILE_SIZE;
$config['components']['log']['routes']['debug']['maxLogFiles']       = LOG_MAX_LOG_FILES;
$config['components']['log']['routes']['debug']['enabled']           = LOG_DEBUG_ENABLED;
if (LOG_TOOLBAR_ENABLED !== true) {
    unset($config['components']['log']['routes']['toolbar']);
}

if (DB_HOST === null) {
    unset($config['components']['db']);
} else {
    $config['components']['db']['connectionString'] = 'mysql:host=' . DB_HOST . ';dbname=' . DB_DATABASE_NAME;
    $config['components']['db']['emulatePrepare'] = DB_EMULATE_PREPARE;
    $config['components']['db']['username'] = DB_USERNAME;
    $config['components']['db']['password'] = DB_PASSWORD;
    $config['components']['db']['charset'] = DB_CHARSET;
    $config['components']['db']['tablePrefix'] = DB_TABLE_PREFIX;
    $config['components']['db']['enableParamLogging'] = DB_ENABLE_PARAM_LOGGING;
    $config['components']['db']['enableProfiling'] = DB_ENABLE_PROFILING;

    $config['components']['authManager']['itemTable'] = DB_TABLE_PREFIX . "auth_item";
    $config['components']['authManager']['itemChildTable'] = DB_TABLE_PREFIX . "auth_item_child";
    $config['components']['authManager']['assignmentTable'] = DB_TABLE_PREFIX . "auth_assignment";

}

if (REDIS_HOST === null) {
    unset($config['components']['redis']);
} else {
    $config['components']['redis']['servers']['host'] = REDIS_HOST;
    $config['components']['redis']['servers']['port'] = REDIS_PORT;
    $config['components']['redis']['database']        = REDIS_DATABASE;
    $config['components']['redis']['prefix']          = REDIS_KEY_PREFIX;    
}

define("_MPDF_TEMP_PATH", APPLICATION_PATH . DIRECTORY_SEPARATOR . 'runtime' . DIRECTORY_SEPARATOR . 'mpdf' . DIRECTORY_SEPARATOR);
if (!file_exists(_MPDF_TEMP_PATH)) {
    mkdir(_MPDF_TEMP_PATH);
    chmod(_MPDF_TEMP_PATH, 0777);
}

// Define Debug costants based on variable value
define('YII_DEBUG', $yii_debug);
define('YII_TRACE_LEVEL', $yii_trace_level);
