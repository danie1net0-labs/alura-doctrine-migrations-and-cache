<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20221115122730 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE courses (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A9A55A4C5E237E06 ON courses (name)');
        $this->addSql('CREATE TABLE course_student (course_id INTEGER NOT NULL, student_id INTEGER NOT NULL, PRIMARY KEY(course_id, student_id), CONSTRAINT FK_BFE0AADF591CC992 FOREIGN KEY (course_id) REFERENCES courses (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_BFE0AADFCB944F1A FOREIGN KEY (student_id) REFERENCES students (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_BFE0AADF591CC992 ON course_student (course_id)');
        $this->addSql('CREATE INDEX IDX_BFE0AADFCB944F1A ON course_student (student_id)');
        $this->addSql('CREATE TABLE phones (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, student_id INTEGER DEFAULT NULL, number VARCHAR(11) NOT NULL, CONSTRAINT FK_E3282EF5CB944F1A FOREIGN KEY (student_id) REFERENCES students (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_E3282EF5CB944F1A ON phones (student_id)');
        $this->addSql('CREATE TABLE students (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE courses');
        $this->addSql('DROP TABLE course_student');
        $this->addSql('DROP TABLE phones');
        $this->addSql('DROP TABLE students');
    }
}
