<?php

namespace orm\entities;

class Course
{
    private int $id;
    private string $courseName;
    private int $year;
    private int $examinorId;


    public function __construct(string $courseName, int $year, $examinorId, int $id = 0)
    {
        $this->id = $id;
        $this->courseName = $courseName;
        $this->year = $year;
        $this->examinorId = $examinorId;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCourseName()
    {
        return $this->courseName;
    }

    public function getYear()
    {
        return $this->year;
    }

    public function getExaminorId()
    {
        return $this->examinorId;
    }

    public function setCourseName(string $courseName)
    {
        $this->courseName = $courseName;
    }

    public function setYear(int $year)
    {
        $this->year = $year;
    }

    public function setExaminorId(int $examinorId)
    {
        $this->examinorId = $examinorId;
    }
}
