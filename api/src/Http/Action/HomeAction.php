<?php

declare(strict_types=1);

namespace Api\Http\Action;

use Psr\Http\Message\{ResponseInterface, ServerRequestInterface};
use Zend\Diactoros\Response\JsonResponse;

class HomeAction
{
    public function handle(ServerRequestInterface $request)
    {
        return new JsonResponse([
            'name' => 'App API',
            'version' => '1.0'
        ]);
    }
}
