<?php

namespace orm\mapper;

use orm\entities\CourseEnrollment;
use PDO;

class CourseEnrollmentMapper
{
    private PDO $conn;
    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    public function fetchAll()
    {
        $statement = "SELECT * FROM course_enrollment;";
        $sth = $this->conn->prepare($statement);
        $sth->execute();
        $rows = $sth->fetchAll();

        if (!isset($rows)) {
            return null;
        }

        $returnArray = [];
        foreach ($rows as $value) {
            $returnArray[] = new CourseEnrollment($value["course_id"], $value["student_id"], $value["grade"], $value["id"]);
        }
        return $returnArray;
    }

    public function findByCourseStudentId(int $courseId, int $studentId)
    {
        $statement = "SELECT * FROM course_enrollment WHERE course_id = ? AND student_id = ?;";
        $sth = $this->conn->prepare($statement);
        $sth->execute([$courseId, $studentId]);
        $row = $sth->fetch();

        if (!isset($row)) {
            return null;
        }

        return new CourseEnrollment($row["course_id"], $row["student_id"], $row["grade"], $row["id"]);
    }

    public function findById($id)
    {
        $statement = "SELECT * FROM course_enrollment WHERE id = ?;";
        $sth = $this->conn->prepare($statement);
        $sth->execute([$id]);
        $row = $sth->fetch();

        if (!isset($row)) {
            return null;
        }
        return new CourseEnrollment($row["course_id"], $row["student_id"], $row["grade"], $row["id"]);
    }

    public function fetchAllWithStudentId($id)
    {
        $statement = "SELECT * FROM course_enrollment WHERE student_id = ?;";
        $sth = $this->conn->prepare($statement);
        $sth->execute([$id]);
        $rows = $sth->fetchAll();

        if (!isset($rows)) {
            return null;
        }

        $returnArray = [];
        foreach ($rows as $value) {
            $returnArray[] = new CourseEnrollment($value["course_id"], $value["student_id"], $value["grade"], $value["id"]);
        }
        return $returnArray;
    }

    public function fetchAllWithCourseId($id)
    {
        $statement = "SELECT * FROM course_enrollment WHERE course_id = ?;";
        $sth = $this->conn->prepare($statement);
        $sth->execute([$id]);
        $rows = $sth->fetchAll();

        if (!isset($rows)) {
            return null;
        }

        $returnArray = [];
        foreach ($rows as $value) {
            $returnArray[] = new CourseEnrollment($value["course_id"], $value["student_id"], $value["grade"], $value["id"]);
        }
        return $returnArray;
    }

    public function insert(CourseEnrollment $courseEnrollment): void
    {
        $courseId = $courseEnrollment->getCourseId();
        $studentId = $courseEnrollment->getStudentId();

        $statement = "INSERT INTO course_enrollment (course_id, student_id) VALUES (?, ?);";
        $sth = $this->conn->prepare($statement);
        $sth->execute([$courseId, $studentId]);
    }

    public function update(CourseEnrollment $courseEnrollment): void
    {
        $id = $courseEnrollment->getId();
        $courseId = $courseEnrollment->getCourseId();
        $studentId = $courseEnrollment->getStudentId();
        $grade = $courseEnrollment->getGrade();

        $statement = "UPDATE course_enrollment SET course_id = ?, student_id = ?, grade = ? WHERE id = ?;";
        $sth = $this->conn->prepare($statement);
        $sth->execute([$courseId, $studentId, $grade, $id]);
    }
}