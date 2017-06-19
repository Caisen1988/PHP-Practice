## PHP基础知识及代码示例

### 01.函数

#### 1.1 empyt 与 isset

```
$myvar = NULL; isset($myvar); //  FALSE 当一个变量被赋值为NULL时，就表示这个变量没有值
$myvar = 0; isset($myvar);     //   TRUE
$myvar = FALSE; isset($myvar); // TRUE
$myvar = '';  isset($myvar); //  TRUE
isset($some_undefined_var); //  FALSE Undefined variable

$myvar = NULL; empty($myvar); // TRUE
$myvar = 0; empty($myvar); // TRUE
$myvar = FALSE; empty($myvar); // TRUE
$myvar = '';  empty($myvar); // TRUE
empty($some_undefined_var); // TRUE
```

### 02.File文件操作
* file01.php:读取一个txt文件然后echo出来
```
$fh = fopen('testFile.txt','w');
var_dump($fh);
while(!feof($fh)){
    $s = fgets($fh);
    echo $s;
}
fclose($fh);
```
* file02.php:读取文件，查询数据，导出文件中
```
function output($inputfile,$outputfile){

    $f = fopen($inputfile, 'r');
    if(!$f){ //打开失败
        return;
    }
    while (!feof($f)){
        $v = fgets($f);
        if(!$v) {
            return;
        }
        $parame = trim($v);
        //数据库操作
        file_put_contents($outputfile, $UID, FILE_APPEND | LOCK_EX);//追加写入
    }
    echo 'success';
    fclose($f);
}

$inputfile = $argv[1];
$outputfile = $argv[2];

//开始导入
output($inputfile,$outputfile);
```

* 将php数组导入csv文件

```
function outPutCsv() {
    $arr_data = array();//
    $fp = fopen('gameList.csv', 'w');//w为可写权限

    foreach ($arr_data as $key => $value) {
        $name = $value['name'];
        $appid = $value['appid'];
        $short = $value['short'];
        fputcsv($fp, array('name' => $name, 'appid' => $appid, 'short' => $short));
    }
    fclose($fp);
}

outPutCsv();
```

> 命令行下面使用方法  php output.php  input.txt output.txt

### 03.Array 数组操作
* array01.php：二维数据排序array_multisort用法
* array01.php：去掉数组中的空值和false和‘’ array_filter用法

### 04.正则
* [最通俗易懂的php正则表达式教程(上)](http://www.tuicool.com/articles/EZ3myu)

* [最通俗易懂的php正则表达式教程(中)](http://www.tuicool.com/articles/6rUzEn7)

* [最通俗易懂的php正则表达式教程(下)](http://www.tuicool.com/articles/nMn2yeU)

### 05.OOP知识

* oop01.php: PHP面向对象编程简单实例。

* oop02.php: __get(), __set(), __isset() and __unset()用法。

* oop03.php: 构造函数和析构函数用法。


### 06.设计模式

#### 6.1 工厂模式
