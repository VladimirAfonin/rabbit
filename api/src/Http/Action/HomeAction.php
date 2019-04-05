<?php

declare(strict_types=1);

namespace Api\Http\Action;

use Slim\Http\{Request, Response};

class HomeAction
{
    public function __invoke(Request $request, Response $response)
    {
        return $response->withJson([
            'name' => 'App API',
            'version' => '1.0'
        ]);
    }
}
