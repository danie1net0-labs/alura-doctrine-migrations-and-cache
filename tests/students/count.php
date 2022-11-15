<?php

use App\Entity\Student;
use App\Helper\EntityManagerFactory;

require_once __DIR__ . '/../../vendor/autoload.php';

$entityManager = EntityManagerFactory::createEntityManager();

$studentRepository = $entityManager->getRepository(Student::class);

$criteria = [];

if (isset($argv[1])) {
    $criteria = [
        'name' => $argv[1]
    ];
}

$count = $studentRepository->count($criteria);

echo "$count student(s) found" . PHP_EOL;
