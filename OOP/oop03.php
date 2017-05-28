<?php

/**
 * 构造函数和析构函数
 * User: caisen
 * Date: 2017/5/28
 * Time: 22:25
 */
class BaseClass
{
    function __construct()
    {
        print "In BaseClass construct\n";
    }
}

class SubClass extends BaseClass
{
    function __construct()
    {
        parent::__construct();
        print "In SubClass construct\n";
    }
}

class OtherClass extends BaseClass
{

}

//$obj = new BaseClass();
//
//$obj = new SubClass();
//
//$obj = new OtherClass();

class MyDestructableClass {
    function __construct() {
        print "In constructor\n";
        $this->name = "MyDestructableClass";
    }

    function __destruct() {
        print "Destroying " . $this->name . "\n";
    }
}

$obj = new MyDestructableClass();