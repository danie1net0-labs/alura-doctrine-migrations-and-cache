<?php

namespace App\Repository;

use App\Entity\Student;
use Doctrine\ORM\EntityRepository;

class StudentRepositoryDoctrine extends EntityRepository
{
    /**
     * @return Student[]
     */
    public function findAllWithCourses(): array
    {
        //$dqlQuery = <<<DQL
        //    SELECT
        //        student, phones, courses
        //    FROM App\Entity\Student student
        //    LEFT JOIN student.phones phones
        //    LEFT JOIN student.courses courses
        //DQL;
        //
        //return $this->getEntityManager()
        //    ->createQuery($dqlQuery)
        //    ->getResult();

        return $this->createQueryBuilder('student')
            ->addSelect('phones')
            ->addSelect('courses')
            ->leftJoin('student.phones', 'phones')
            ->leftJoin('student.courses', 'courses')
            ->getQuery()
            ->enableResultCache(86400)
            ->getResult();
    }
}