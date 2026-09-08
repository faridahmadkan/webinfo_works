<?php

class Library
{
    const MAX_BOOKS = 3;

    public function showLimit()
    {
        return "Maximum books allowed: " . self::MAX_BOOKS;
    }
}

echo Library::MAX_BOOKS;
echo "<br>";
echo "Maximum books allowed: " . Library::MAX_BOOKS;
echo "<br><br>";

class StudentCounter
{
    public static $count = 0;

    public static function addStudent()
    {
        self::$count++;
    }
}

StudentCounter::addStudent();
StudentCounter::addStudent();
StudentCounter::addStudent();

echo "Total students: " . StudentCounter::$count;
echo "<br><br>";

abstract class Vehicle
{
    abstract public function start();
}

class Car extends Vehicle
{
    public function start()
    {
        return "Car engine started.";
    }
}

class Bike extends Vehicle
{
    public function start()
    {
        return "Bike started.";
    }
}

$car = new Car();
$bike = new Bike();

echo $car->start();
echo "<br>";
echo $bike->start();

?>
