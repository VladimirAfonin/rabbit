<?php
declare(strict_types=1);

use Api\Http\Middleware;
use Api\Infrastructure\Framework\Middleware\CallableMiddlewareAdapter as CM;
use Psr\Container\ContainerInterface;
use Slim\App;
use Api\Http\Action\HomeAction;
use Api\Http\Action\Auth\SignUp\RequestAction;
use Api\Http\Action\Auth\SignUp\ConfirmAction;

return function (App $app, ContainerInterface $container) {
    $app->add(new CM($container, Middleware\BodyParamsMiddleware::class));
    $app->add(new CM($container, Middleware\DomainExceptionMiddleware::class));
    $app->add(new CM($container, Middleware\ValidationExceptionMiddleware::class));
    $app->get('/', HomeAction::class . ':handle');
    $app->post('/auth/signup', RequestAction::class . ':handle');
    $app->post('/auth/signup/confirm', ConfirmAction::class . ':handle');
};