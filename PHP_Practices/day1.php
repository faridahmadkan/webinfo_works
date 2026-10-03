<?php
echo "Hello, World!";
echo "This is my first PHP program";

//This is a single line comment 

/* this is a multi line comment
*/

// a variable is container for storing values 
// in PHP a variable starts with $
// in PHP vriable names are case-sensitive

//String
$name = "Farid Ahmad";
//Integer
$age = 23;
//Float
$gpa = 4.5;
//bool
$isStudent = true;
//printing data stored in a variable
echo $name;
//changing vriable value
$name = "Ahmad";
//combining vriables and text
echo "my name is" . $name . "and I am" . $age . "years old";
//also
echo "my name is $name and I am $age years old";

//arithmathics
$a = 10;
$b = 5;
//addition
echo $a + $b;
//subtraction
echo $a - $b;
//division
echo $a / $b;
//remainder
echo $a % $b;

//Conditions in PHP: if else elseif
/* comparison operators:
== is equal to
=== identical/ equal type and value
!= not equal to
> greater than
< less than
>= greater than or equal to
<= less than or eual to
*/
$age = 23;
if ($age < 0) {
    echo "invalid age";
} elseif ($age <= 1) {
    echo "Baby or newborn";
} elseif ($age <= 6) {
    echo "Child";
} elseif ($age <= 18) {
    echo "school student";
} else {
    echo "Adult";
}

/* combining conditions
&& and
|| or
! not 
*/
$color = "black";
$size = "43";
if ($color == "black" && $size == "43") {
    echo "this shoes fits your condition";
} else {
    echo "not fit";
}

//Loops in PHP
//for loop
for ($i = 1; $i <= 10; $i++) {
    echo $i . "<br>";
}
//while loop
$j = 1;
while ($j <= 10) {
    echo $j . "<br>";
    $j++;
}
//foreach loop
$names = ['Ali', 'Omer', 'Wali', 'Ahmad', 'Shah'];
foreach ($names as $nm) {
    echo $nm . "<br>";
}


for ($i = 1; $i <= 10; $i++) {
    echo $i . "<br>";
}

for ($i = 2; $i <= 4; $i += 2) {
    echo $i . "<br>";
}

$name = "Farid";
$j = 1;
while ($j <= 5) {
    echo $name . "<br>";
    $j++;
}


//OOP PHP
class Student {
    public string $name;
    public int $id;
    public function showinfo(){
        echo $this->name . "<br>";
        echo $this->id . "<br>";
    }
}

$student1 = new Student();
$student1->name = "Ali";
$student1->id = 1;
$student1->showinfo();

//constractor is a special method that is automatically called when an object is created
class Day1 {
    public string $name;
    public int $age;
    public float $num;
    public function __construct($name, int $age, float $num) {
        echo $this->$name . "<br>";
        echo $this->$age . "<br>";
        echo $this->$num;
    }
}

$day1 = new Day1("Farid", 23, 12.5);


