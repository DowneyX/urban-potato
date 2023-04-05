<?php

namespace orm\mapper;

use orm\entities\Course;
use PDO;

class CourseMapper
{
    private PDO $conn;
    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    public function fetchAll()
    {
        $statement = "SELECT * FROM course;";
        $sth = $this->conn->prepare($statement);
        $sth->execute();
        $rows = $sth->fetchAll();

        if (!$rows) {
            return null;
        }

        $returnArray = [];
        foreach ($rows as $value) {
            $returnArray[] = new Course($value["course_name"], $value["year"], $value["examinor_id"], $value["id"]);
        }
        return $returnArray;
    }

    public function fetchAllWithExaminorId($id)
    {
        $statement = "SELECT * FROM course WHERE examinor_id = ?;";
        $sth = $this->conn->prepare($statement);
        $sth->execute([$id]);
        $rows = $sth->fetchAll();

        if (!$rows) {
            return null;
        }

        $returnArray = [];
        foreach ($rows as $value) {
            $returnArray[] = new Course($value["course_name"], $value["year"], $value["examinor_id"], $value["id"]);
        }
        return $returnArray;
    }

    public function findById($id)
    {
        $statement = "SELECT * FROM course WHERE id = ?;";
        $sth = $this->conn->prepare($statement);
        $sth->execute([$id]);
        $row = $sth->fetch();

        if (!$row) {
            return null;
        }

        return new Course($row["course_name"], $row["year"], $row["examinor_id"], $row["id"]);
    }

    public function insert(Course $course): bool
    {
        $courseName = $course->getCourseName();
        $year = $course->getYear();
        $examinorId = $course->getExaminorId();

        $statement = "INSERT INTO course (course_name, year, examinor_id) VALUES (?, ?, ?);";
        $sth = $this->conn->prepare($statement);
        return $sth->execute([$courseName, $year, $examinorId]);
    }

    public function update()
    {
        //code
    }

    public function delete(Course $course)
    {
        try {
            $id = $course->getId();
            $statement = " DELETE FROM course WHERE id = ?;";
            $sth = $this->conn->prepare($statement);
            return $sth->execute([$id]);
        } catch (\Throwable $e) {
            return false;
        }
    }
}