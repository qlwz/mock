<?php
/**
 * Mock 基础随机
 *
 * @author  情留メ蚊子 <qlwz@qq.com>
 * @link    http://www.94qing.com
 */

/**
 * 返回一个随机的布尔值。
 *
 * @param int  $min
 * @param int  $max
 * @param bool $cur
 * @return bool
 */
function mock_random_boolean($min = null, $max = null, $cur = null)
{
    $random = mt_rand() / mt_getrandmax();
    if ($cur === true || $cur === false) {
        $min = $min ? intval($min) : 1;
        $max = $max ? intval($max) : 1;
        return $random > (1.0 / ($min + $max) * $min) ? !$cur : $cur;
    }
    return $random >= 0.5 ? true : false;
}

function mock_random_bool($min = null, $max = null, $cur = null)
{
    return mock_random_boolean($min, $max, $cur);
}

/**
 * 返回一个随机的自然数（大于等于 0 的整数）。
 *
 * @param int $min
 * @param int $max
 * @return int
 */
function mock_random_natural($min = null, $max = null)
{
    $tmin = $min ? intval($min) : 0;
    $tmax = $max ? intval($max) : 2147483647; // 2^32
    return mt_rand($tmin, $tmax);
}

/**
 * 返回一个随机的整数。
 *
 * @param int $min
 * @param int $max
 * @return int
 */
function mock_random_integer($min = null, $max = null)
{
    $tmin   = $min ? intval($min) : 0;
    $tmax   = $max ? intval($max) : 2147483647; // 2^32
    $result = mt_rand($tmin, $tmax);
    return mock_random_bool() ? $result : 0 - $result;
}

/**
 * 返回一个随机的整数。
 *
 * @param int $min
 * @param int $max
 * @return int
 */
function mock_random_int($min = null, $max = null)
{
    return mock_random_integer($min, $max);
}

/**
 * 返回一个随机的浮点数。
 *
 * @param int $min
 * @param int $max
 * @param int $dmin
 * @param int $dmax
 * @return float
 */
function mock_random_float($min = null, $max = null, $dmin = null, $dmax = null)
{
    $tdmin  = max(min(($dmin ? intval($dmin) : 0), 17), 0);
    $tdmax  = max(min(($dmax ? intval($dmax) : 17), 17), 0);
    $dcount = mock_random_natural($tdmin, $tdmax);

    $ret = mock_random_integer($min, $max) . '.';
    for ($i = 0; $i < $dcount; $i++) {
        $ret .= ($i < $dcount - 1) ? mt_rand(0, 9) : mt_rand(1, 9); // 最后一位不能为 0：如果最后一位为 0，会被 JS 引擎忽略掉。
    }
    return floatval($ret);
}

/**
 * 返回一个随机字符。
 *
 * @param string $pool
 * @return string
 */
function mock_random_character($pool = null)
{
    $pools          = [
        'lower'  => 'abcdefghijklmnopqrstuvwxyz', 'upper' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', 'number' => '0123456789',
        'symbol' => '!@#$%^&*()[]',
    ];
    $pools['alpha'] = $pools['lower'] . $pools['upper'];

    if (!$pool) {
        $chars = $pools['lower'] . $pools['upper'] . $pools['number'] . $pools['symbol'];
    } elseif (isset ($pools[strtolower($pool)])) {
        $chars = $pools[strtolower($pool)];
    } else {
        $chars = $pool;
    }

    $len = strlen($chars) - 1;
    return $chars[mt_rand(0, $len)];
}

/**
 * 返回一个随机字符。
 *
 * @param string $pool
 * @return string
 */
function mock_random_char($pool = null)
{
    return mock_random_character($pool);
}

/**
 * 返回一个随机字符串。
 *
 * @param string $pool
 * @param int    $min
 * @param int    $max
 * @return string
 */
function mock_random_string($pool = null, $min = null, $max = null)
{
    $num = func_num_args();
    if ($num === 0) {
        $len = mt_rand(3, 7);
    } elseif ($num === 1) {
        $len  = $pool;
        $pool = null;
    } elseif ($num === 2) {
        if (!preg_match('/^\d+$/', $pool)) {
            $len = $min;
        } else {
            $len  = mock_random_natural($pool, $min);
            $pool = null;
        }
    } else {
        $len = mock_random_natural($min, $max);
    }

    $text = '';
    for ($i = 0; $i < intval($len); $i++) {
        $text .= mock_random_character($pool);
    }
    return $text;
}

/**
 * 返回一个随机字符串。
 *
 * @param string $pool
 * @param int    $min
 * @param int    $max
 * @return string
 */
function mock_random_str($pool = null, $min = null, $max = null)
{
    return mock_random_string($pool, $min, $max);
}

/**
 * 返回一个整型数组。
 *
 * @param int $start
 * @param int $stop
 * @param int $step
 * @return array
 */
function mock_random_range($start = null, $stop = null, $step = null)
{
    $num = func_num_args();
    if ($num <= 1) {
        $stop  = intval($start);
        $start = 0;
    }
    $tstep = intval($step) ?: 1;

    $len   = max(ceil(($stop - $start) / $tstep), 0);
    $idx   = 0;
    $range = [];
    while ($idx < $len) {
        $range[$idx++] = $start;
        $start         += $tstep;
    }
    return $range;
}
