<?php

require '../vendor/autoload.php';

require_once "../vendor/config/app_config.php";//$db_vars

require_once '../vendor/config/database.php';

// Automatically load all models
$models = glob('../app/models/*.php');
foreach ($models as $model) {
    require $model;
}

 
