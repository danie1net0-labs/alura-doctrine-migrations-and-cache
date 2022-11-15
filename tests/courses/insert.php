<?php

use App\Entity\Course;
use App\Entity\Student;
use App\Helper\EntityManagerFactory;

require_once __DIR__ . '/../../vendor/autoload.php';

if (!isset($argv[1])) {
    die('Please enter name' . PHP_EOL);
}

$entityManager = EntityManagerFactory::createEntityManager();

$course = new Course($argv[1]);

if (isset($argv[2])) {
    $studentRepository = $entityManager->getRepository(Student::class);

    $students = $studentRepository->findBy([
        'id' => explode(',', $argv[2]),
    ]);

    $course->addStudents($students);
}

$entityManager->persist($course);
$entityManager->flush();

echo $course . PHP_EOL;