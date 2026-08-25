<?php
class Student
{
    public $name;
    public $studentId;
    public $department;
    function __construct($name, $studentId = null, $department = null)
    {
        $this->name = $name;
        $this->studentId = $studentId;
        $this->department = $department;
    }
    function sayHello()
    {
        echo "Hello! I am a student.";
    }
    function showInfo()
    {
        echo "Name: " . $this->name . "<br>";
        echo "Student ID: " . $this->studentId . "<br>";
        echo "Department: " . $this->department;
    }
    function study()
    {
        echo $this->name . " is studying.";
    }
}
// Part A
$student1 = new Student("");
$student1->sayHello();
echo "<br><br>";
// Part B
$student1 = new Student("Ahmad", 1001, "Computer Science");
$student1->showInfo();
echo "<br><br>";
// Part C
$student2 = new Student("Sara", 1002, "Information Systems");
$student2->showInfo();
echo "<br><br>";
// Part D
class BankAccount
{
    public $ownerName;
    private $balance;
    function __construct($ownerName, $balance)
    {
        $this->ownerName = $ownerName;
        $this->balance = $balance;
    }
    function showBalance()
    {
        echo "Balance: " . $this->balance;
    }
}
$account1 = new BankAccount("Ahmad", 5000);
echo "Owner: " . $account1->ownerName . "<br>";
$account1->showBalance();
echo "<br><br>";
// Part E
class Person
{
    public $name;

    function __construct($name)
    {
        $this->name = $name;
    }
    function introduce()
    {
        echo "My name is " . $this->name;
    }
}
class StudentWithInheritance extends Person
{
    function study()
    {
        echo $this->name . " is studying.";
    }
}
$student3 = new StudentWithInheritance("Ahmad");
$student3->introduce();
echo "<br>";
$student3->study();
echo "<br><br>";
// Part G
class Vehicle
{
    protected $brand;

    function __construct($brand)
    {
        $this->brand = $brand;
    }

    function start()
    {
        echo "The vehicle is starting.";
    }
}
class Car extends Vehicle
{
    function showBrand()
    {
        echo "Car brand: " . $this->brand;
    }
}
$car1 = new Car("Toyota");
$car1->start();
echo "<br>";
$car1->showBrand();
?>
