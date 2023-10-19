<?php
require_once "Student.php";
require_once "Subject.php";
require_once "University.php";

$university = new University();

$subject1 = $university->addSubject('112', 'Web II');
$subject2 = $university->addSubject('113', 'Android');

$subject1->addStudent('George', '123'); // Parameters: name, studentNumber
$subject1->addStudent('Mary', '234');
$subject1->addStudent('David', '345');
$subject2->addStudent('Bob', '456');
$subject2->addStudent('Brad', '567');

echo $university->getNumberOfStudents() . "<br>"; // This should print 5
$university->print();

$student1 = new Student('Alice', '12345');
$student2 = new Student('Bob', '67890');

$deleted = $subject1->deleteStudent($student1);
if ($deleted) {
    echo "Student deleted successfully.<br>";
} else {
    echo "Student not found or could not be deleted.<br>";
}

try {
    $university->deleteSubject($subject1);
    echo "Subject deleted successfully.<br>";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "<br>";
}
$university->addStudentOnSubject('113', $student2);

try {
    $university->deleteSubject($subject2);
    echo $subject2->getName()." deleted successfully.<br>";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "<br>";
}
echo"<br>";

$student1->setGrade($subject1, 8.2);
$student2->setGrade($subject1, 6.6);
$student1->setGrade($subject2, 7.6);
$student2->setGrade($subject2, 7.9);

$student1->printGrades($university);
echo "<br>";
$student2->printGrades($university);
echo "<br>";

$students = [
    new Student('Charlie', '11111'),
    new Student('Daniel', '22222'),
    new Student('Eve', '33333'),
    new Student('Frank', '44444'),
    new Student('Grace', '55555'),
];

foreach ($students as $student) {
    $subjects = $university->getSubjects();
    foreach ($subjects as $subject) {
        $grade = rand(50, 100) / 10;
        $student->setGrade($subject, $grade);
    }
}

$sortedStudents = Student::sortStudentsByAverageGrade($students);
echo "Students sorted by average grade:<br>";
foreach ($sortedStudents as $student) {
    echo $student->name . ' - Average Grade: ' . $student->getAvgGrade() . "<br>";
}