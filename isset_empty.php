<?php
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


 ?>
