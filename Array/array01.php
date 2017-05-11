<?php
/**
 * 01：二维数据排序
 * User: v_sencai
 * Date: 2017/5/8
 * Time: 12:39
 */
$vUserInfo = array(
                   array('iIntimacy'=>2,'iType'=>1,'lUin'=>174014263),
                   array('iIntimacy'=>5,'iType'=>1,'lUin'=>835596913),
                   array('iIntimacy'=>1,'iType'=>1,'lUin'=>1330183022),
                   array('iIntimacy'=>0,'iType'=>3,'lUin'=>842993057),
                   array('iIntimacy'=>4,'iType'=>1,'lUin'=>335049190)
              );
foreach ($vUserInfo as $key => $row) {
    $volume[$key]  = $row['iIntimacy'];
}
array_multisort($volume, SORT_ASC,  $vUserInfo); //根据iIntimacy字段升序排列
print_r($vUserInfo);

/**
 * 02：去掉数组中的空值和false和‘’
 */
$entry = array(
    0 => 'foo',
    1 => false,
    2 => -1,
    3 => NULL,
    4 => ''
);
print_r(array_filter($entry));