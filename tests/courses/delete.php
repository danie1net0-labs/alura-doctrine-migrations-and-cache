<?php

use App\Entity\Course;
use App\Helper\EntityManagerFactory;

require_once __DIR__ . '/../../vendor/autoload.php';

if (!isset($argv[1])) {
    die('Please enter the object ID' . PHP_EOL);
}

$entityManager = EntityManagerFactory::createEntityManager();

/** @var Course $course */
$course = $entityManager->find(Course::class, $argv[1]);

if (!$course) {
    die('Object not found' . PHP_EOL);
}

$entityManager->remove($course);
$entityManager->flush();

echo "Deleted successfully" . PHP_EOL;

