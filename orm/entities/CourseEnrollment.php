<?php

namespace orm\entities;

class CourseEnrollment
{
    private int $id;
    private int $courseId;
    private int $studentId;
    private float|null $grade;

    public function __construct(int $courseId, int $studentId, float|null $grade = null, int $id = 0)
    {
        $this->courseId = $courseId;
        $this->studentId = $studentId;
        $this->grade = $grade;
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function getStudentId(): int
    {
        return $this->studentId;
    }
    public function getGrade(): float|null
    {
        return $this->grade;
    }
    public function getCourseId(): int
    {
        return $this->courseId;
    }

    public function setGrade(float $grade): void
    {
        $this->grade = $grade;
    }
}