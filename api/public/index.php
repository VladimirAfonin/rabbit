<?php
declare(strict_types=1);

/*header('Content-Type: application/json');
echo json_encode([
    'name' => 'App API',
    'version' => '1.0',
]);*/

use Api\Http\Action;
use Slim\App;

chdir(dirname(__DIR__));

require 'vendor/autoload.php';
$config = require 'config/config.php';

$container = new \Slim\Container($config);
$app = new App($container);

$app->get('/', Action\HomeAction::class);

$app->run();