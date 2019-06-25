<?php
declare(strict_types=1);

namespace Api\Http\Action\Auth\SignUp;

use Api\Model\User\UseCase\SignUp\Request\Command;
use Api\Http\Validator\Validator;
use Api\Model\User\UseCase\SignUp\Request\Handler;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RequestAction implements RequestHandlerInterface
{
    private $handler;
    private $validator;

    public function __construct(Handler $handler, Validator $validator)
    {
        $this->handler = $handler;
        $this->validator = $validator;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $body = json_decode($request->getBody()->getContents(), true);
        $command = new Command();
        $command->email = $body['email'] ?? '';
        $command->password = $body['password'] ?? '';

        if ($errors = $this->validator->validate($command)) {
            return new JsonResponse(['errors' => $errors->toArray()], 400);
        }

        $this->handler->handle($command);

        return new JsonResponse([
            'email' => $command->email,
        ], 201);
    }
}