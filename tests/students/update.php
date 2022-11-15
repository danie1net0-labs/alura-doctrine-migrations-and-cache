<?php

use App\Entity\Phone;
use App\Entity\Student;
use App\Helper\EntityManagerFactory;

require_once __DIR__ . '/../../vendor/autoload.php';

if (!isset($argv[1], $argv[2])) {
    die('Please enter with ID and name to update' . PHP_EOL);
}

if (!is_int((int) $argv[1])) {
    die('The ID must be an integer' . PHP_EOL);
}

if (!is_string($argv[2])) {
    die('The name must be a string' . PHP_EOL);
}

$entityManager = EntityManagerFactory::createEntityManager();

$student = $entityManager->find(Student::class, $argv[1]);

$student->name = $argv[2];

if (isset($argv[3])) {
    $student->updatePhones(explode(',', $argv[3]));
}

$entityManager->flush();

echo $student . PHP_EOL;