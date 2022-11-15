<?php

use App\Entity\Student;
use App\Helper\EntityManagerFactory;

require_once __DIR__ . '/../../vendor/autoload.php';

if (!isset($argv[1])) {
    die('Please enter the object ID' . PHP_EOL);
}

$entityManager = EntityManagerFactory::createEntityManager();

$studentRepository = $entityManager->getRepository(Student::class);

/** @var Student $student */
$student = $studentRepository->find($argv[1]);

echo ($student ?? 'Object not found') . PHP_EOL;

