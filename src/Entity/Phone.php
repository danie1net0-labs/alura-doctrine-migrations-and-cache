<?php

namespace App\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

#[Entity, Table('phones')]
class Phone
{
    #[Id, GeneratedValue, Column]
    public int $id;

    #[ManyToOne(targetEntity: Student::class, inversedBy: 'phones')]
    public Student $student;

    public function __construct(
        #[Column(length: 11)]
        public string $number,
    ) {
    }

    public function __toString(): string
    {
        return $this->number;
    }
}