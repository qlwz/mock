<?php
/**
 * Mock 日期随机
 *
 * @author  情留メ蚊子 <qlwz@qq.com>
 * @link    http://www.94qing.com
 */

/**
 * 返回一个随机的日期字符串。
 *
 * @param string $format
 * @return string
 */
function mock_random_date($format = null)
{
    if (!$format) {
        $format = 'yyyy-MM-dd';
    }
    return mock_random_datetime($format);
}

/**
 * 返回一个随机的时间字符串。
 *
 * @param string $format
 * @return string
 */
function mock_random_time($format = null)
{
    if (!$format) {
        $format = 'HH:mm:ss';
    }
    return mock_random_datetime($format);
}

/**
 * 返回一个随机的日期和时间字符串。
 *
 * @param string $format
 * @return string
 */
function mock_random_datetime($format = null)
{
    if (!$format) {
        $format = 'yyyy-MM-dd HH:mm:ss';
    }
    $time = mt_rand(0, time());
    return mock_random_get_date($format, $time);
}

/**
 * 返回当前的日期和时间字符串。
 *
 * @param string $unit
 * @param string $format
 * @return string
 */
function mock_random_now($unit = null, $format = null)
{
    if (func_num_args() == 1) {
        if (!preg_match('/year|month|day|hour|minute|second|week/', $unit)) {
            $format = $unit;
            $unit   = '';
        }
    }
    if (!$format) {
        $format = 'yyyy-MM-dd HH:mm:ss';
    }

    switch (strtolower($unit)) {
        case 'year':
            $time = mktime(0, 0, 0, 1, 1, date('Y'));
            break;
        case 'month':
            $time = mktime(0, 0, 0, date('n'), 1, date('Y'));
            break;
        case 'day':
            $time = mktime(0, 0, 0, date('n'), date('j'), date('Y'));
            break;
        case 'hour':
            $time = mktime(date('H'), 0, 0, date('n'), date('j'), date('Y'));
            break;
        case 'minute':
            $time = mktime(date('H'), date('i'), 0, date('n'), date('j'), date('Y'));
            break;
        case 'second':
            $time = mktime(date('H'), date('i'), date('s'), date('n'), date('j'), date('Y'));
            break;
        case 'week':
            $time = mktime(0, 0, 0, date('n', strtotime('this week')), date('j', strtotime('this week -1 day')), date('Y', strtotime('this week -1 day')));
            break;
        default :
            $time = time();
            break;
    }

    return mock_random_get_date($format, $time);
}

/**
 * 处理成JS日期
 *
 * @param string $format
 * @param int    $time
 * @return string
 */
function mock_random_get_date($format, $time)
{
    //转成js的格式，保持一致

    $year          = date('Y', $time);
    $year2         = date('y', $time);
    $month         = date('m', $time);
    $day           = date('d', $time);
    $hour          = date('H', $time);
    $minute        = date('i', $time);
    $second        = date('s', $time);
    $milliseconds  = mt_rand(0, 999);
    $millisecondsT = str_pad(intval($milliseconds), 3, '0', STR_PAD_LEFT);

    $format = str_replace('yyyy', $year, $format);
    $format = str_replace('yy', $year2, $format);
    $format = str_replace('y', $year2, $format);

    $format = str_replace('MM', $month, $format);
    $format = str_replace('M', intval($month), $format);

    $format = str_replace('dd', $day, $format);
    $format = str_replace('d', intval($day), $format);

    $format = str_replace('HH', $hour, $format);
    $format = str_replace('H', intval($hour), $format);

    $format = str_replace('hh', date('h', $time), $format);
    $format = str_replace('h', date('g', $time), $format);

    $format = str_replace('mm', $minute, $format);
    $format = str_replace('m', intval($minute), $format);

    $format = str_replace('ss', $second, $format);
    $format = str_replace('s', intval($second), $format);

    $format = str_replace('SS', $millisecondsT, $format);
    $format = str_replace('S', intval($milliseconds), $format);

    $format = str_replace('A', date('A', $time), $format);
    $format = str_replace('a', date('a', $time), $format);

    $format = str_replace('T', $time . $millisecondsT, $format);

    return $format;
}
