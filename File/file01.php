<?php
/**
 * 01：读取一个txt文件然后写入cookie
 * User: caisen
 * Date: 2017/4/4
 * Time: 14:42
 */
$fh = fopen('testFile.txt','w');
var_dump($fh);
while(!feof($fh)){
    $s = fgets($fh);
    echo $s;
}
fclose($fh);
