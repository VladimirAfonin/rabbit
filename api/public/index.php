<?php
declare(strict_types=1);

/*header('Content-Type: application/json');
echo json_encode([
    'name' => 'App API',
    'version' => '1.0',
]);*/

use Slim\App;
use Symfony\Component\Dotenv\Dotenv;

chdir(dirname(__DIR__)); // -> /var/www/rabbit.loc/api

require 'vendor/autoload.php';

if(file_exists('.env')) {
    (new Dotenv())->load('.env');
}

(function() {
    $config = require 'config/config.php';
    $container = new \Slim\Container($config);
    $app = new App($container);

    (require  'config/routes.php')($app); // передаем $app в возвращаемую функ
    $app->run();
})();