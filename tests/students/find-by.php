<?php

use App\Entity\Student;
use App\Helper\EntityManagerFactory;

require_once __DIR__ . '/../../vendor/autoload.php';

if (!isset($argv[1])) {
    die('Please enter the object name' . PHP_EOL);
}

$entityManager = EntityManagerFactory::createEntityManager();

$studentRepository = $entityManager->getRepository(Student::class);

/** @var Student[] $students */
$students = $studentRepository->findBy([
    'name' => $argv[1]
]);

echo ($students[0] ?? 'Object not found') . PHP_EOL;
