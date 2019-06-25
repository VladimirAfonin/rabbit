<?php
declare(strict_types=1);

use Slim\App;
use Api\Http\Action\HomeAction;

return function (App $app) {
    $app->get('/', HomeAction::class . ':handle');
    $app->post('/auth/signup', Action\Auth\SignUp\RequestAction::class . ':handle');
};