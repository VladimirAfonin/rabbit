<?php
declare(strict_types=1);

use Api\Infrastructure\Model\User as UserInfrastructure;
use Api\Model\User as UserModel;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;
use Api\Model\User\Entity\DoctrineUserRepository;
use Api\Model\User\Service\BCryptPasswordHasher;
use Api\Model\User\Service\RandConfirmTokenizer;
use Api\Model\Service\DoctrineFlusher;
use Api\Infrastructure;
use Api\ReadModel;

return [
    Api\Model\Flusher::class => function (ContainerInterface $container) {
        return new DoctrineFlusher(
            $container->get(EntityManagerInterface::class),
            $container->get(Api\Model\EventDispatcher::class)
        );
    },
    UserModel\Service\PasswordHasher::class => function () {
        return new BCryptPasswordHasher();
    },
    UserModel\Entity\User\UserRepository::class => function (ContainerInterface $container) {
        return new DoctrineUserRepository(
            $container->get(EntityManagerInterface::class)
        );
    },
    UserModel\Service\ConfirmTokenizer::class => function (ContainerInterface $container) {
        $interval = $container->get('config')['auth']['signup_confirm_interval'];
        return new RandConfirmTokenizer(new \DateInterval($interval));
    },

    UserModel\Entity\User\UserRepository::class => function (ContainerInterface $container) {
        return new DoctrineUserRepository(
            $container->get(\Doctrine\ORM\EntityManagerInterface::class)
        );
    },
    UserModel\UseCase\SignUp\Request\Handler::class => function (ContainerInterface $container) {
        return new UserModel\UseCase\SignUp\Request\Handler(
            $container->get(UserModel\Entity\User\UserRepository::class),
            $container->get(UserModel\Service\PasswordHasher::class),
            $container->get(UserModel\Service\ConfirmTokenizer::class),
            $container->get(Api\Model\Flusher::class)
        );
    },

    UserModel\UseCase\SignUp\Confirm\Handler::class => function (ContainerInterface $container) {
        return new UserModel\UseCase\SignUp\Confirm\Handler(
            $container->get(UserModel\Entity\User\UserRepository::class),
            $container->get(Api\Model\Flusher::class)
        );
    },

    ReadModel\User\UserReadRepository::class => function (ContainerInterface $container) {
        return new Infrastructure\ReadModel\User\DoctrineUserReadRepository(
            $container->get(\Doctrine\ORM\EntityManagerInterface::class)
        );
    },

    ReadModel\Video\AuthorReadRepository::class => function (ContainerInterface $container) {
        return new Infrastructure\ReadModel\Video\DoctrineAuthorReadRepository(
            $container->get(\Doctrine\ORM\EntityManagerInterface::class)
        );
    },


    'config' => [
        'auth' => [
            'signup_confirm_interval' => 'PT5M',
        ],
    ],
];