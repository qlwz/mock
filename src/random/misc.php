<?php
/**
 * Mock 常用随机
 *
 * @author  情留メ蚊子 <qlwz@qq.com>
 * @link    http://www.94qing.com
 */

function mock_random_d4()
{
    return mt_rand(1, 4);
}

function mock_random_d6()
{
    return mt_rand(1, 6);
}

function mock_random_d8()
{
    return mt_rand(1, 8);
}

function mock_random_d12()
{
    return mt_rand(1, 12);
}

function mock_random_d20()
{
    return mt_rand(1, 20);
}

function mock_random_d100()
{
    return mt_rand(1, 100);
}

/**
 * 随机生成一个 GUID。
 *
 * @return string
 */
function mock_random_guid()
{
    $charid = strtoupper(md5(uniqid(rand(), true)));
    $hyphen = chr(45); // "-"
    $uuid   = ''//chr (123)// "{"
        . substr($charid, 0, 8) . $hyphen . substr($charid, 8, 4) . $hyphen . substr($charid, 12, 4) . $hyphen . substr($charid, 16, 4) . $hyphen . substr($charid, 20, 12);
    //. chr (125) // "}"
    return $uuid;
}

/**
 * 随机生成一个 GUID。
 *
 * @return string
 */
function mock_random_uuid()
{
    return mock_random_guid();
}

/**
 * 随机生成一个 18 位身份证。
 * [身份证](http://baike.baidu.com/view/1697.htm#4)
 * 地址码 6 + 出生日期码 8 + 顺序码 3 + 校验码 1
 * [《中华人民共和国行政区划代码》国家标准(GB/T2260)](http://zhidao.baidu.com/question/1954561.html)
 *
 * @return string
 */
function mock_random_id()
{
    $dic  = mock_random_get_address_dic();
    $code = $dic[mt_rand(0, count($dic) - 30)]['id'];
    $id   = $code . date('Ymd', mt_rand(0, time())) . mt_rand(100, 999);

    $rank = [7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2];
    $last = ['1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2'];
    $sum  = 0;
    for ($i = 0; $i < 17; $i++) {
        $sum += intval($id[$i]) * $rank[$i];
    }
    $id .= $last[$sum % 11];
    return $id;
}

/**
 * 生成一个全局的自增整数。
 *
 * @param int $step
 * @return string
 */
function mock_random_increment($step = 1)
{
    if (!isset ($GLOBALS['mock_random_increment'])) {
        $GLOBALS['mock_random_increment'] = 0;
    }
    $GLOBALS['mock_random_increment'] += intval($step) ?: 1;
    return $GLOBALS['mock_random_increment'];
}

/**
 * 生成一个全局的自增整数。
 *
 * @param int $step
 * @return string
 */
function mock_random_inc($step = 1)
{
    return mock_random_increment($step);
}
