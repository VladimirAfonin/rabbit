<?php

use Api\Http\Action\HomeAction;
use Doctrine\Common\Cache\FilesystemCache;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Setup;
use Psr\Container\ContainerInterface;

return [
    'settings' => [
        'addContentLengthHeader' => false,
        'displayErrorDetails' => (bool)getenv('API_DEBUG'),
    ],

    HomeAction::class => function() {
        return new HomeAction();
    },

    EntityManagerInterface::class => function(ContainerInterface $container) {
        $params = $container['config']['doctrine'];
        $config  = Setup::createAnnotationMetadataConfiguration(
            $params['metadata_dirs'],
            $params['dev_model'],
            $params['cache_dir'],
            new FilesystemCache(
                $params['cache_dir']
            ),
            false
        );
        return EntityManager::create(
            $params['connection'],
            $config
        );
    },

    'config' => [
        'doctrine' => [
            'dev_mode' => true,
            'cache_dir' => 'var/cache/doctrine',
            'metadata_dirs' => ['src/Model/User/Entity'],
            'connection' => [
                'url' => getenv('API_DB_URL'),
            ],
        ],
    ],

];