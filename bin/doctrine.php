<?php

use App\Helper\EntityManagerFactory;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;

require_once __DIR__ . '/../vendor/autoload.php';

$entityManager = EntityManagerFactory::createEntityManager();

ConsoleRunner::run(
    new SingleManagerProvider($entityManager),
);
