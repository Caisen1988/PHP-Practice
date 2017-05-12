<?php
/**
 * PHP面向对象编程简单实例
 */
date_default_timezone_set("PRC");

/*

* 1.静态属性用于保存类的公有数据

* 2.静态方法里面只能访问静态属性

* 3.静态成员不需要实例化对象就可以进行访问

* 4.类的内部可以通过self或者static关键字访问自身静态成员

* 5.可以通过parent关键字访问父类的静态成员

* 6.可以通过类的名称在类定义外部访问静态成员

*

*/

class Human{

    public $name;

    protected $height; //只有自身和子类可以访问

    public $weight;

    private $isHungry = true; //不能被子类访问

    public static $sValue = "Static value in Human class"."\n";

    public function eat($food){

        echo $this->name."'s eating "."'$food"."\n";

    }

    public function info(){

        echo "HUMAN :".$this->name. ";".$this->height.";".$this->isHungry."\n";

    }

}

class Animal{

}

//类的定义以关键字class开始,后面是类的名称，类的命名通常第一个字母大写，以中括号开始和结束

//在PHP中用extends关键字表示类的继承，后面跟父类的类名

//PHP中extends后只能跟一个类的类名，这是PHP中的单继承原则

class NBaplayer extends Human

{

// public $name = "Jordan"; //定义属性

// public $height = "198cm";

// public $weight = "98kg";

    public $team = "Bull";

    public $playernumber = "23";

    private $age = "40"; //Private的类成员只能在内部被访问

//静态属性在定义时在访问控制关键字后面添加static关键字即可

    public static $president = "David Stern";

// 静态方法在定义时在访问控制关键字后面添加static关键字即可

    public static function changePresident($newpresdt){

//在类定义中使用静态成员时，用self或者static关键字后面跟::操作符即可

//注意，在访问静态成员属性时，::后面需要跟$符号

        self ::$president = $newpresdt;

//使用parent关键字访问父类中的静态成员

        echo parent::$sValue."\n";

    }

//构造函数，在对象被实例化时自动调用

    function __construct($name,$height,$weight,$team,$playernumber)

    {

        echo "in NBaplayer constuctor\n";

        $this->name = $name; //$this是php里面的伪变量，表示对象自身，可以通过$->this的方式访问对象的属性和方法

        $this->height = $height;

        $this->weight = $weight;

        $this->team = $team;

        $this->playernumber = $playernumber;

        echo $this->height."\n";

    }

//析构函数，在程序执行结束时自动调用

//析构函数通常被用于清理程序使用的资源。比如，程序使用了打印机，那么可以在析构函数里释放打印机资源

    function __destruct()

    {

        echo "Destroying ".$this->name."\n";

    }

//定义方法

    public function run()

    {

        echo "running\n";

    }

    public function jump()

    {

        echo "jumping\n";

    }

    public function dribble()

    {

        echo "dribbling\n";

    }

    public function shoot()

    {

        echo "shooting\n";

    }

    public function dunk()

    {

        echo "dunking\n";

    }

    public function pass()

    {

        echo "passing\n";

    }

    public function getAge(){

        echo $this->name."'s age is ".($this->age - 2)."\n";

    }

}

//类到对象的实例化

//类的对象为实例化时使用关键字new,后面是类的名称和一堆括号

//$jordan = new NBaplayer("Jordan","198cm","98kg","Bull","23");

//$james = new NBaplayer("James","203cm","120kg","Heat","6");

//对象中的成员属性通过->符号来访问

//在类定义外部访问静态属性，可以用类名加::操作符的方法来访问类的静态成员

//echo NBaplayer::$president." Before change"."\n";

//NBaplayer::changePresident("Aadam Siver");

//echo NBaplayer::$president."\n";

//echo Human::$sValue."\n";

//echo "Jordan : ".$jordan->president."\n";

// echo "James : ".$james->president."\n";

//echo $jordan->name."\n";

//echo $jordan->getAge();

//$jordan->info();

//$jordan->eat("Apple"); //在子类中的对象上可以直接访问父类中定义的属性和方法

//对象中的成员方法通过->符号来访问

//$jordan->dribble();

//$jordan->dunk();

// $jordan->jump();

// $jordan->pass();

// $jordan->run();

// $jordan->shoot();

//

// //每一次用new实例化对象的时候，都会用类名后面的参数列表调用构造函数

//$james = new NBaplayer("James","203cm","120kg","Heat","6");

//echo $james->name."\n";

// //通过把变量设置为Null,可以出发析构函数的调用

// //当对象不会再被使用的时候,会触发析构函数

//$james1 = $james;

//$james2 = &$james;

//$james2 = null;

//$james1 = null;

// echo "From now on James will not be used.\n";

