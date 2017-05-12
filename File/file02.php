<?php
/**
 * 读取文件，查询数据，导出文件中
 * User: v_sencai
 * Date: 2017/5/12
 * Time: 17:05
 */
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