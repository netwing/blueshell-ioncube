<?php

// *** BASE CONFIGURATION LOAD ***
require_once dirname(__FILE__) . '/config/console.php';

// Load vendor autoload
require_once dirname(__FILE__) . '/../../vendor/autoload.php';

// *** YII FRAMEWORK LOAD ***
// Include base yii class
require_once dirname(__FILE__) . '/../../vendor/yiisoft/yii/framework/yii.php';

$yiic=dirname(__FILE__).'/../../vendor/yiisoft/yii/framework/yiic.php';
require_once($yiic);
