<?php

use App\Entity\Student;
use App\Helper\EntityManagerFactory;

require_once __DIR__ . '/../../vendor/autoload.php';

$entityManager = EntityManagerFactory::createEntityManager();

$studentRepository = $entityManager->getRepository(Student::class);

/** @var Student[] $students */
$students = $studentRepository->findAllWithCourses();

foreach ($students as $student) {
    echo $student . PHP_EOL . PHP_EOL;
}