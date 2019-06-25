<?php

namespace Api\Model\User\UseCase\SignUp\Request;

use Api\Model\EventDispatcher;
use Api\Model\User\Entity\User\Email;
use Api\Model\User\Entity\User\User;
use Api\Model\User\Entity\User\UserId;
use Api\Model\User\Entity\User\UserRepository;
use Api\Model\User\Service\PasswordHasher;
use App\Model\Flusher;
use App\Model\User\Service\ConfirmTokenizer;


class Handler
{
    private $users;
    private $hasher;
    private $tokenizer;
    private $flusher;
    private $dispatcher;

    public function __construct(
        UserRepository $users,
        PasswordHasher $hasher,
        ConfirmTokenizer $tokenizer,
        Flusher $flusher,
        EventDispatcher $dispatcher
    )
    {
        $this->users = $users;
        $this->hasher = $hasher;
        $this->tokenizer = $tokenizer;
        $this->flusher = $flusher;
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param Command $command
     * @throws \Exception
     */
    public function handle(Command $command): void
    {
        $email = new Email($command->email);

        if ($this->users->hasByEmail($email)) {
            throw new \DomainException('User with this email already exists.');
        }

        $user = new User(
            UserID::next(),
            new \DateTimeImmutable(),
            $email,
            $this->hasher->hash($command->password),
            $token = $this->tokenizer->generate()
        );

        $this->users->add($user);
        $this->flusher->flush();
        $this->dispatcher->dispatch(...$user->releaseEvents());

    }
}