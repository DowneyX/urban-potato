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

        if (!isset($rows)) {
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

        if (!isset($rows)) {
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

        if (!isset($row)) {
            return null;
        }
        return new Course($row["course_name"], $row["year"], $row["examinor_id"], $row["id"]);
    }
}