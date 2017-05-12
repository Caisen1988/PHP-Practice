## PHP基础知识及代码示例
### 01.File文件操作
* file01.php:读取一个txt文件然后echo出来
* 读取文件，查询数据，导出文件中
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
output($file);
```
> 命令行下面使用方法  php output.php  input.txt output.txt
 
### 02.Array 数组操作
* 01：二维数据排序array_multisort用法
* 02：去掉数组中的空值和false和‘’
### 03.正则
* [最通俗易懂的php正则表达式教程(上)](http://www.tuicool.com/articles/EZ3myu)

* [最通俗易懂的php正则表达式教程(中)](http://www.tuicool.com/articles/6rUzEn7)

* [最通俗易懂的php正则表达式教程(下)](http://www.tuicool.com/articles/nMn2yeU)

### 04.OOP
