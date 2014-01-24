<?php

// Disable CSRF validation from Yii
define("APPLICATION_ENABLE_CSRF_VALIDATION", true);

require_once "init.php";

// Execute application
$app->run();
