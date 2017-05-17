<?php
/**
 * PHP正则表达式相关练习
 * User: v_sencai
 * Date: 2017/5/10
 * Time: 15:37
 */
//禁止分组的捕获
$str = "http://www.google.com";
$preg= "/http:\/\/\w+\.\w+.(?:net|com|cn)+/is";
$preg2= "/http:\/\/\w+\.\w+.(net|com|cn)+/is";
preg_match($preg,$str,$arr);
preg_match($preg2,$str,$arr2);
// print_r($arr);
// print_r($arr2);

//preg_match() 和 preg_match_all() 的区别
$str='hello world china';
$preg="/\w+\s/is";
preg_match($preg,$str,$arr);
// print_r($arr);
preg_match_all($preg,$str,$arr2);
// print_r($arr2);

//正确理解 $ 和 ^
//为了匹配是否是手机号:
$str = "13521899942";
$preg="/1[\d]{3,15}$/is";
if (preg_match($preg,$str,$arr)) {
    //echo "ok";
}else{
	//echo "no";
}

//需要匹配的字符串。date函数返回当前时间
$content = "Current date and time is ".date("Y-m-d h:i a").", we are learning PHP together.";

//使用通常的方法匹配时间
if (preg_match ('/\d{4}-\d{2}-\d{2} \d{2}:\d{2} [ap]m/', $content, $m))
{
    //echo "匹配的时间是：" .$m[0]. "\n";
}

//由于时间的模式明显，也可以简单的匹配
if (preg_match ('/([\d-]{10}) ([\d:]{5} [ap]m)/', $content, $m))
{
    //echo "当前日期是：" .$m[1]. "\n";
    //echo "当前时间是：" .$m[2]. "\n";
}

//Preg_grep()函数返回一个数组,其中包括了$input数组中与给定的$pattern模式相匹配的单元。对于输入数组$input中的每个元素，preg_grep()也只进行一次匹配。
$subjects = array(
    "Mechanical Engineering",  "Medicine",
    "Social Science",          "Agriculture",
    "Commercial Science",     "politics"
);

//匹配所有仅由有一个单词组成的科目名
$alonewords = preg_grep("/^[a-z]*$/i", $subjects);
print_r($alonewords);