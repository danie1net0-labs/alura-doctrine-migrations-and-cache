<?php

namespace App\Helper;

use Doctrine\DBAL\Logging\Middleware;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\ORMSetup;
use Symfony\Component\Cache\Adapter\PhpFilesAdapter;
use Symfony\Component\Cache\Exception\CacheException;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\OutputInterface;

class EntityManagerFactory
{
    /**
     * @throws ORMException
     * @throws CacheException
     */
    public static function createEntityManager(): EntityManager
    {
        $configuration = ORMSetup::createAttributeMetadataConfiguration(
            paths: [__DIR__ . '/..'],
            isDevMode: true,
        );

        $configuration->setMiddlewares([
            new Middleware(
                new ConsoleLogger(
                    new ConsoleOutput(OutputInterface::VERBOSITY_DEBUG)
                )
            )
        ]);

        $cacheDirectory = __DIR__ . '/../../var/cache';

        $configuration->setMetadataCache(
            new PhpFilesAdapter(
                namespace: 'metadata_cache',
                directory: $cacheDirectory,
            )
        );

        $configuration->setQueryCache(
            new PhpFilesAdapter(
                namespace: 'query_cache',
                directory: $cacheDirectory,
            )
        );

        $configuration->setResultCache(
            new PhpFilesAdapter(
                namespace: 'result_cache',
                directory: $cacheDirectory,
            )
        );
        
        $connection = [
            'driver' => 'pdo_sqlite',
            'path' => __DIR__ . '/../../database/doctrine.sqlite',
        ];

        return EntityManager::create($connection, $configuration);
    }
}