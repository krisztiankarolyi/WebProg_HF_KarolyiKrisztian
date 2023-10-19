<?php
require_once "AbstractUniversity.php";

class University extends AbstractUniversity
{
    private function isSubjectExists(string $code): bool
    {
        if (count($this->subjects) == 0) return false;
        foreach ($this->subjects as $subject) {
            if ($subject->getCode() == $code) {
                return true;
            }
        }
        return false;
    }

    public function getSubjects(){
        return $this->subjects;
    }

    public function addSubject(string $code, string $name): Subject
    {
        if (!$this->isSubjectExists($code, $name)) {
            $subject = new Subject($code, $name);
            $this->subjects[] = $subject;
            return $subject;
        } else {
            throw new Exception("Subject exists!");
        }
    }

    public function deleteSubject(Subject $subject): void
    {
        $key = array_search($subject, $this->subjects, true);
        if ($key === false) {
            throw new Exception("Subject not found in the university.");
        }

        if (count($subject->getStudents()) === 0) {
            unset($this->subjects[$key]);
            $this->subjects = array_values($this->subjects);
        } else {
            throw new Exception("Cannot delete the subject. Students are assigned to it.");
        }
    }


    public function addStudentOnSubject(string $subjectCode, Student $student)
    {
        foreach ($this->subjects as $subject) {
            if ($subject->getCode() == $subjectCode) {
                $subject->addStudent($student->getName(), $student->getStudentNumber());
            }
        }
        return [];
    }

    public function getStudentsForSubject(string $subjectCode): array
    {
        foreach ($this->subjects as $subject) {
            if ($subject->getCode() == $subjectCode) {
                return $subject->getStudents();
            }
        }
        return [];
    }

    public function getNumberOfStudents(): int
    {
        $sum = 0;
        foreach ($this->subjects as $subject){
            foreach ($subject->getStudents() as $student) {
                $sum += 1;
            }
        }
        return $sum;
    }

    public function print(): void
    {
        foreach ($this->subjects as $subject) {
            echo "<br>" . '---------------------------------' . "<br>";
            echo $subject . "<br>";
            echo '---------------------------------' . "<br>";

            foreach ($subject->getStudents() as $student) {
                echo $student->getName() . " - " . $student->getStudentNumber();
                echo "<br>";
            }
        }
    }
    public function getSubjectByCode(String $code){
        foreach ($this->subjects as $subject){
            if($subject->getCode() == $code)
                return $subject;
        }
        return null;
    }
}