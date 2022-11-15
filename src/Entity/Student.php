<?php

namespace App\Entity;

use App\Repository\StudentRepositoryDoctrine;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;

#[Entity(StudentRepositoryDoctrine::class), Table('students')]
class Student
{
    #[Id, GeneratedValue, Column]
    public int $id;

    #[OneToMany(
        mappedBy: 'student',
        targetEntity: Phone::class,
        cascade: ['persist', 'remove'],
        fetch: 'EAGER',
        orphanRemoval: true,
    )]
    private Collection $phones;

    #[ManyToMany(Course::class, mappedBy: 'students')]
    private Collection $courses;

    public function __construct(
        #[Column]
        public string $name,
    ){
        $this->phones = new ArrayCollection();
        $this->courses = new ArrayCollection();
    }

    public function __toString(): string
    {
        $phones = 'No phones';

        if ($this->phones->count()) {
            $phones = $this->phones->map(static fn (Phone $phone) => $phone);
            $phones = implode(', ', $phones->toArray());
        }

        $courses = 'No courses';

        if ($this->courses->count()) {
            $courses = $this->courses->map(static fn (Course $course) => $course->name);
            $courses = implode(', ', $courses->toArray());
        }

        return "ID: $this->id\nName: $this->name\nPhones: $phones\nCourses: $courses";
    }

    public function addPhones(array $phones): Collection
    {
        foreach ($phones as $phone) {
            $this->addPhone(new Phone($phone));
        }

        return $this->phones;
    }

    public function addPhone(Phone $phone): void
    {
        $phone->student = $this;

        $this->phones->add($phone);
    }

    public function updatePhones(array $newPhones): Collection
    {
        $this->phones->clear();

        foreach ($newPhones as $phone) {
            $this->addPhone(new Phone($phone));
        }

        return $this->phones;
    }

    public function enrollInCourse(Course $course): void
    {
        if ($this->courses->contains($course)) {
            return;
        }

        $this->courses->add($course);

        $course->addStudent($this);
    }
}
