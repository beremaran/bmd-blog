<?php
/**
 * Created by PhpStorm.
 * User: beremaran
 * Date: 26.09.2017
 * Time: 16:19
 */

$CORE_DIR = __DIR__ . '/core/';
$DATA_DIR = __DIR__ . '/data/';

include_once __DIR__ . '/vendor/autoload.php';

use Slim\App;

$app = new App(
    require_once $CORE_DIR . 'settings.php'
);

include_once $CORE_DIR . 'dependencies.php';
include_once $CORE_DIR . 'middleware.php';

$__lib = glob($CORE_DIR . 'lib/*.php');
foreach ($__lib as $lib)
    include_once $lib;

include_once $CORE_DIR . 'routes.php';

$app->run();