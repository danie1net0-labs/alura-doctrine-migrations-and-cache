<?php

use App\Entity\Phone;
use App\Entity\Student;
use App\Helper\EntityManagerFactory;

require_once __DIR__ . '/../../vendor/autoload.php';

if (!isset($argv[1])) {
    die('Please enter name' . PHP_EOL);
}

$entityManager = EntityManagerFactory::createEntityManager();

$student = new Student($argv[1]);

if (isset($argv[2])) {
    $student->addPhones(explode(',', $argv[2]));
}

$entityManager->persist($student);
$entityManager->flush();

echo $student . PHP_EOL;