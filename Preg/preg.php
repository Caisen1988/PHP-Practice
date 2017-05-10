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

//用户名只能由英文字母a～z(不区分大小写)、数字0～9、下划线组成。
//用户名的起始字符必须是英文字母.如：netease_2005用户名长度为5～20个字符;
//服务器名只能由英文字母a～z(不区分大小写)、数字0～9、下划线及点组成,@后点前面长度限制为1-10个字符,点后面的限制为com,cn,com.cn,net。
$email='wjj7r8y6@jj.net';
if(ereg("^[a-zA-Z][0-9a-zA-Z_]{4,19}@[0-9a-zA-Z_]{1,10}(\.)(com|cn|com.cn|net)$",$email)) {
		echo 'email格式正确';
}