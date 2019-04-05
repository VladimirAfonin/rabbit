<?php
declare(strict_types=1);

/*header('Content-Type: application/json');
echo json_encode([
    'name' => 'App API',
    'version' => '1.0',
]);*/

use Api\Http\Action;


chdir(dirname(__DIR__));

$config = require 'config/config.php';

$app = new \Slim\App($config);

$app->get('/', Action\HomeAction::class);


$app->run();