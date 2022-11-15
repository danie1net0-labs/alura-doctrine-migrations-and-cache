<?php

use App\Entity\Course;
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

$course = $entityManager->find(Course::class, $argv[1]);

$course->name = $argv[2];

if (isset($argv[3])) {
    $studentRepository = $entityManager->getRepository(Student::class);

    $students = $studentRepository->findBy([
        'id' => explode(',', $argv[3]),
    ]);

    $course->addStudents($students);
}

$entityManager->flush();

echo $course . PHP_EOL;