<?php declare(strict_types=1);

class Student {
    public $id;
    public $name;
    public $surname;

    function __construct(?int $id, string $name, string $surname )
    {
        $this->id=$id;
        $this->name=$name;
        $this->surname=$surname;
    }
    // function __construct()
    // {
        
    // }

    public function getInfo(){
        echo $this->id . "  ". $this->name .  "  " . $this->surname . "</br>"; 
    }
}

$student1=new Student(1,"Adem","Erbas");

$student1->getInfo();


?>