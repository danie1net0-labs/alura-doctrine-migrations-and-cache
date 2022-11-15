<?php

use App\Entity\Course;
use App\Helper\EntityManagerFactory;

require_once __DIR__ . '/../../vendor/autoload.php';

$entityManager = EntityManagerFactory::createEntityManager();

$courseRepository = $entityManager->getRepository(Course::class);

/** @var Course[] $courses */
$courses = $courseRepository->findAll();

foreach ($courses as $course) {
    echo $course . PHP_EOL . PHP_EOL;
}