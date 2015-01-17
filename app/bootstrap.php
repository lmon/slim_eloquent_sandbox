<?php

require '../vendor/autoload.php';

require_once '../vendor/config/database.php';

// Automatically load all models
$models = glob('../app/models/*.php');
foreach ($models as $model) {
    require $model;
}

 