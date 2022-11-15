<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\Table;

#[Entity, Table('courses')]
class Course
{
    #[Id, GeneratedValue, Column]
    public int $id;

    #[ManyToMany(Student::class, inversedBy: 'courses')]
    public Collection $students;

    public function __construct(
        #[Column(unique: true)]
        public string $name
    )
    {
        $this->students = new ArrayCollection();
    }

    public function __toString(): string
    {
        $students = 'No students';

        if ($this->students->count()) {
            $students = $this->students->map(static fn (Student $student) => $student->name);
            $students = implode(', ', $students->toArray());
        }

        return "ID: $this->id\nName: $this->name\nStudents: $students";
    }

    public function addStudent(Student $student): void
    {
        if ($this->students->contains($student)) {
            return;
        }

        $this->students->add($student);

        $student->enrollInCourse($this);
    }

    public function addStudents(array $students): Collection
    {
        $this->students = new ArrayCollection($students);

        return $this->students;
    }
}