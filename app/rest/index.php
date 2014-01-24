<?php

// Disable CSRF validation from Yii
define("APPLICATION_ENABLE_CSRF_VALIDATION", false);

// Load vendor autoload
require_once dirname(__FILE__) . '/../../vendor/autoload.php';

// *** BASE CONFIGURATION LOAD ***
// Include configuration that set the variable $config
require_once dirname(__FILE__) . '/../protected/config/main.php';

$config['components']['urlManager'] = array(
    'urlFormat' => 'path',
    'rules' => require(
        dirname(__FILE__) . '/../../vendor/starship/restfullyii/starship/RestfullYii/config/routes.php'
    ),
);

if (isset($config['theme'])) {
    unset($config['theme']);    
}

// *** YII FRAMEWORK LOAD ***
// Include base yii class
require_once dirname(__FILE__) . '/../../vendor/yiisoft/yii/framework/yii.php';

// *** YII CREATE APPLICATION
// Create application
$app = Yii::createWebApplication($config);

// *** YII APPLICATION CUSTOMIZATION
// Write here your own customization if needed
if (isset($app->request)) {
    if ($app->request->getPreferredLanguage()) {
        $app->language = $app->request->getPreferredLanguage();
    }
}

// Execute application
$app->run();
