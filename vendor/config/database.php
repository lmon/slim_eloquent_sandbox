<?php

// Database information
// Eloquent instantiation
use Illuminate\Database\Capsule\Manager as Capsule;

include "../vendor/config/app_config.php";//$db_vars
$capsule = new Capsule;

$capsule->addConnection( $db_vars );

// Set the event dispatcher used by Eloquent models... (optional)
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
$capsule->setEventDispatcher(new Dispatcher(new Container));

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();


