<?php

use App\Entity\Student;
use App\Helper\EntityManagerFactory;

require_once __DIR__ . '/../../vendor/autoload.php';

if (!isset($argv[1])) {
    die('Please enter the object ID' . PHP_EOL);
}

$entityManager = EntityManagerFactory::createEntityManager();

/** @var Student $student */
$student = $entityManager->find(Student::class, $argv[1]);

if (!$student) {
    die('Object not found' . PHP_EOL);
}

$entityManager->remove($student);
$entityManager->flush();

echo "Deleted successfully" . PHP_EOL;

