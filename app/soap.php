<?php

// Disable CSRF validation from Yii
define("APPLICATION_ENABLE_CSRF_VALIDATION", false);

// Init application
require_once "init.php";

// Execute application
$app->defaultController = "v1";
$app->run();
