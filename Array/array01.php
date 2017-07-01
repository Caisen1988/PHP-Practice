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


/**
*拼接php数组键值对
*/
$res = 'F033F1AE64E52C9F6EC1E9ACB2CB3672,16,3,156,1107,234,345,565,345,33,66,23,45,76,567,45,45,676,4565,456,1234456+835596913+654321,345,12334+1223+1233+1234+4334,0.033+0.033+0.033+0.033+0.033,835596913+835596913+835596913+835596913+835596913';
$res_arr = explode(',',trim($res));
$key_name = 'vopenid,izoneareaid,maxgrade,maxscore,battle_times_all,izoneareaid,mvp_times_all,godlike_times,kill_3_times,kill_4_times,kill_5_times,battle_times_win,important_winner_times,battle_times_fail,important_loser_times,NoAITotalHurt_avg,groupwar_percent,NoBeHeroAITotalHurt_avg,mvpsocre_avg,qqfrindstr,winpercent_str_gang,fd_heroidstr,herostr,winpercent_str,friend_qqstring';
$key_name_arr = (explode(',',$key_name));
$result = array_combine($key_name_arr,$res_arr);                  //修改键名
print_r($result);
