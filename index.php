<?php

use ZelFramework\Debug\Debug;
use ZelFramework\Kernel\Environment;
use ZelFramework\Kernel\Kernel;

define('PROJECT_DIR', __DIR__ . '/');

require PROJECT_DIR . 'vendor/autoload.php';

new Environment();

Debug::start();

$kernel = new Kernel();
$kernel->handle()->send();