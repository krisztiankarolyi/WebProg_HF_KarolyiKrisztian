<?php
/**
 * User: TheCodeholic
 * Date: 4/8/2020
 * Time: 10:40 PM
 */

/**
 * Class Student
 */
class Student
{
    public string $name;
    public string $studentNumber;
    private array $grades = [];

    public function setGrade(Subject $subject, float $grade)
    {
        $this->grades[$subject->getCode()] = $grade;
    }

    public function getAvgGrade(): float
    {
        if (count($this->grades) === 0) {
            return 0.0;
        }

        $sum = array_sum($this->grades);
        return $sum / count($this->grades);
    }

    public function printGrades(University $university)
    {
        echo "$this->name jegyei <br>";
        foreach ($this->grades as $subjectCode => $grade) {
            echo $university->getSubjectByCode($subjectCode)->getName() . ': ' . $grade . "<br>";
        }
    }

    /**
     * @param string $name
     * @param string $studentNumber
     */
    public function __construct(string $name, string $studentNumber)
    {
        $this->name = $name;
        $this->studentNumber = $studentNumber;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getStudentNumber(): string
    {
        return $this->studentNumber;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param string $studentNumber
     */
    public function setStudentNumber(string $studentNumber): void
    {
        $this->studentNumber = $studentNumber;
    }

   public static function sortStudentsByAverageGrade(array $students)
    {
        usort($students, function ($a, $b) {
            return $b->getAvgGrade() <=> $a->getAvgGrade();
        });

        return $students;
    }

}