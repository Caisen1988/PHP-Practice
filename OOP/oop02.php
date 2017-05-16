<?php
//php面向对象
class Employee{
    public $name;
    public function __set($propName,$propValue){
        echo $propName.$propValue;
    }
    public function __get(){
        echo "get";
    }

}

$employee = new Employee();
$employee->name;
