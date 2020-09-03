<?php

use ZelFramework\Kernel\Doctrine\DoctrineManager;
use ZelFramework\Kernel\Environment;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

require_once __DIR__.'/../vendor/autoload.php';

define('PROJECT_DIR', str_replace('config', '', __DIR__));

new Environment();
$em = (new DoctrineManager())->get();

return ConsoleRunner::createHelperSet($em);