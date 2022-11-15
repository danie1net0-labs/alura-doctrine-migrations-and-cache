<?php

require 'vendor/autoload.php';

use App\Helper\EntityManagerFactory;
use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;
use Doctrine\Migrations\Configuration\Migration\PhpFile;
use Doctrine\Migrations\DependencyFactory;

$entityManager = EntityManagerFactory::createEntityManager();

return DependencyFactory::fromEntityManager(
    new PhpFile(__DIR__ . '/migrations.php'),
    new ExistingEntityManager($entityManager)
);