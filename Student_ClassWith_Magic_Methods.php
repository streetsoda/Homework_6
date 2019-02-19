<?php

class Student {
    private $firstname;
    private $lastname;
    private $gender;
    private $status;
    private $gpa;


    public function __construct($firstname, $lastname, $gender, $status, $gpa){
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->setGender($gender);
        $this->setStatus($status);
        $this->setGpa($gpa);
    }

    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function setGender($gender) {
        if($gender == "male" || $gender == "female") {
            $this->gender = $gender;
        } else {
            $this->gender = NULL;
        }
    }

    public function getGender() {
        return $this->gender;
    }

    public function setStatus($status) {
        if($status == "freshman" || $status == "sophomore" || $status == "junior" || $status == "senior") {
            $this->status = $status;
        } else {
            $this->status = NULL;
        }
    }

    public function getStatus() {
        return $this->status;
    }

    public function setGpa($gpa) {
        $this->gpa = ($gpa<=4) ? (($gpa>=0) ? $gpa : 0) : 4;
    }

    public function getGpa() {
        return $this->gpa;
    }


    public function __invoke($study_time){

        $this->gpa += log($study_time);
        $this->setGpa($this->gpa);
    }

    public function __toString(){
        return 'Name: ' . $this->firstname . ' ' . $this->lastname . '; Gender: ' . $this->getGender() . '; Status: ' . $this->getStatus() . '; GPA: ' . $this->getGpa().PHP_EOL;
    }
}

function printStudentData($students, $message)
{
    echo $message;
    foreach ($students as $key => $student) {
        echo $students[$key];
    }
}

function study($students, $studyTime)
{
    for ($i = 0; $i < count($students); $i++) {
        $students[$i]($studyTime[$i]);
    }
}

$students = [
    $student1 = ['Mike', 'Barnes', "male", 'freshman', 4],
    $student2 = ['Jim', 'Nickerson', "male", 'sophomore', 3],
    $student3 = ['Jack', 'Indabox', "male", 'junior', 2.5],
    $student4 = ['Jane', 'Miller', "female", 'senior', 3.6],
    $student5 = ['Mary', 'Scott', "female", 'senior', 2.7]
];

$studyTime = [
    60,
    100,
    40,
    100,
    1000
];


for($i=0; $i<count($students); $i++){
    $students[$i] = new Student($students[$i][0], $students[$i][1], $students[$i][2], $students[$i][3], $students[$i][4]);
}

printStudentData($students, 'Before studying:'.PHP_EOL);
study($students, $studyTime);
printStudentData($students, PHP_EOL.'After studying:'.PHP_EOL);