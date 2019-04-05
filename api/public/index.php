<?php
declare(strict_types=1);

/*header('Content-Type: application/json');
echo json_encode([
    'name' => 'App API',
    'version' => '1.0',
]);*/

use Api\Http\Action;
use Slim\App;
use Symfony\Component\Dotenv\Dotenv;

chdir(dirname(__DIR__)); // -> /var/www/rabbit.loc/api

require 'vendor/autoload.php';

if(file_exists('.env')) {
    (new Dotenv())->load('.env');
}

$config = require 'config/config.php';

$container = new \Slim\Container($config);
$app = new App($container);

$app->get('/', Action\HomeAction::class . ':handle');

$app->run();