<?php
/**
 * Mock 一些转换
 *
 * @author  情留メ蚊子 <qlwz@qq.com>
 * @link    http://www.94qing.com
 */

/**
 * 把字符串的第一个字母转换为大写。
 *
 * @param string $word
 * @return string
 */
function mock_random_capitalize($word = null)
{
    if (!$word) {
        return $word;
    }
    return strtoupper(substr($word, 0, 1)) . substr($word, 1);
}

/**
 * 把字符串转换为大写。
 *
 * @param string $str
 * @return string
 */
function mock_random_upper($str = null)
{
    if (!$str) {
        return $str;
    }
    return strtoupper($str);
}

/**
 * 把字符串转换为小写。
 *
 * @param string $str
 * @return string
 */
function mock_random_lower($str = null)
{
    if (!$str) {
        return $str;
    }
    return strtolower($str);
}

/**
 * 从数组中随机选取一个元素，并返回。
 *
 * @param array $arr
 * @param int   $min
 * @param int   $max
 * @return mixed
 */
function mock_random_pick($arr = null, $min = null, $max = null)
{
    if (!$arr) {
        return '';
    }
    $num = func_num_args();
    if ($num == 1) {
        return $arr[mt_rand(0, count($arr) - 1)];
    } elseif ($num == 2) {
        $max = $min;
    }
    $c = end(mock_random_shuffle($arr, $min, $max));
    return $c;
}

/**
 * 打乱数组中元素的顺序，并返回。
 *
 * @param array $arr
 * @param int   $min
 * @param int   $max
 * @return array
 */
function mock_random_shuffle($arr = null, $min = null, $max = null)
{
    if (!$arr) {
        return [];
    }

    shuffle($arr);

    $num = func_num_args();
    if ($num == 0 || $num == 1) {
        return $arr;
    } elseif ($num == 2) {
        $max = $min;
    }
    return array_slice($arr, 0, mt_rand(intval($min), intval($max)));
}
