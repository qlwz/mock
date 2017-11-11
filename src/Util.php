<?php

namespace qlwz\mock;

/**
 * Class Util
 *
 * @package qlwz\mock
 * @author  情留メ蚊子 <qlwz@qq.com>
 * @link    http://www.94qing.com
 */
class Util
{
    /**
     * 解析规则
     *
     * @param string $name
     * @return \stdClass
     */
    public static function parseRule($name)
    {
        $parameters = $range = $min = $max = $count = $decimal = $dmin = $dmax = $dcount = null;

        preg_match(Constant::RE_KEY, $name, $parameters);
        if (!$parameters) {
            return null;
        }

        if ($parameters && isset ($parameters[3]) && $parameters[3]) {
            $parseRange = self::parseRuleRange($parameters[3]);
            $range      = $parseRange->range;
            $min        = $parseRange->min;
            $max        = $parseRange->max;
            $count      = $parseRange->count;
        }

        if ($parameters && isset ($parameters[4]) && $parameters[4]) {
            $parseRange = self::parseRuleRange($parameters[4]);
            $decimal    = $parseRange->range;
            $dmin       = $parseRange->min;
            $dmax       = $parseRange->max;
            $dcount     = $parseRange->count;
        }

        $result             = new \stdClass();
        $result->parameters = $parameters; // 1 name, 2 inc, 3 range, 4 decimal
        $result->range      = $range; // 1 min, 2 max
        $result->min        = $min;
        $result->max        = $max;
        $result->count      = $count; // min-max
        $result->decimal    = $decimal; //是否有 decimal
        $result->dmin       = $dmin;
        $result->dmax       = $dmax;
        $result->dcount     = $dcount;

        return $result;
    }

    /**
     * 解释规则的返回值
     *
     * @param string $str
     * @return \stdClass
     */
    private static function parseRuleRange($str)
    {
        $range = $min = $max = $count = null;
        preg_match(Constant::RE_RANGE, $str, $range);
        if ($range) {
            if (isset ($range[1]) && $range[1]) {
                $min = intval($range[1]);
            }
            if (isset ($range[2]) && $range[2]) {
                $max   = intval($range[2]);
                $count = rand($min, $max);
            } else {
                $count = $min;
            }
        }

        $result        = new \stdClass();
        $result->range = $range;
        $result->min   = $min;
        $result->max   = $max;
        $result->count = $count;
        return $result;
    }

    /**
     * 获取数据类型
     *
     * @param mixed $obj
     * @return string
     */
    public static function getType($obj)
    {
        $type = gettype($obj);
        if ($type === 'integer' || $type === 'double') {
            return 'number';
        }
        if (in_array($type, ['resource', 'NULL', 'unknown type'])) {
            return 'string';
        }
        return $type;
    }

    /**
     * 随机生成字符串
     *
     * @param int    $length 生成的长度
     * @param string $pool   字符串格式 lower：a-z，upper：A-Z  number：0-9 symbol：!@#$%^&*()[] alpha：a-zA-Z other：customize
     * @return string
     */
    public static function random($length = 6, $pool = '')
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

        $len     = strlen($chars) - 1;
        $randstr = '';
        for ($i = 0; $i < $length; $i++) {
            $num     = mt_rand(0, $len);
            $randstr .= $chars[$num];
        }
        return $randstr;
    }

    /**
     * 获取Object的值
     *
     * @param object $obj
     * @param string $key
     * @return mixed
     */
    public static function getObject($obj, $key)
    {
        if (is_array($obj)) {
            if (isset ($obj[$key])) {
                return $obj[$key];
            }
            return null;
        }
        if (is_object($obj)) {
            foreach ($obj as $k => $v) {
                if ($key == $k) {
                    return $v;
                }
            }
            return null;
        }
        return null;
    }

    /**
     * key是否在Object里面
     *
     * @param object $obj
     * @param string $key
     * @return bool
     */
    public static function inObject($obj, $key)
    {
        if (is_array($obj)) {
            return in_array($key, $obj);
        }
        if (is_object($obj)) {
            foreach ($obj as $k => $v) {
                if ($key == $k) {
                    return true;
                }
            }
            return false;
        }
        return false;
    }

    /**
     * 输出正常的路径数组
     *
     * @param array $pathParts
     * @return array
     */
    public static function normalizePath($pathParts)
    {
        $newPathParts = [];
        foreach ($pathParts as $value) {
            if ($value == '..') {
                array_pop($newPathParts);
            } elseif ($value == '.') {
                continue;
            } else {
                array_push($newPathParts, $value);
            }
        }
        return $newPathParts;
    }

    /**
     * 路径转路径数组
     *
     * @param string $key
     * @return array
     */
    public static function splitPathToArray($key)
    {
        $list = preg_split('/\/+/', $key);
        if (!$list[count($list) - 1]) {
            array_pop($list);
        }
        if (!$list[0]) {
            array_shift($list);
        }
        return $list;
    }

    /**
     * 实现只替换一次
     *
     * @param string $needle
     * @param string $replace
     * @param string $haystack
     * @return string
     */
    public static function str_replace_once($needle, $replace, $haystack)
    {
        $pos = strpos($haystack, $needle);
        if ($pos === false) {
            return $haystack;
        }
        return substr_replace($haystack, $replace, $pos, strlen($needle));
    }

    /**
     * 加载占位符文件
     */
    public static function loadFunction()
    {
        static $isLoad = false;
        if (!$isLoad) {
            $list = glob(__DIR__ . '/random/*.php');
            foreach ($list as $value) {
                include $value;
            }
            $isLoad = true;
        }
    }

    /**
     * 获取执行参数
     *
     * @param string $param
     * @return array
     */
    public static function getParam($param)
    {
        $params = [];
        $tokens = token_get_all('<?php getParam(' . $param . ');?>');

        //去掉最后一个)
        while ($tokens && $tokens[count($tokens) - 1] !== ')') {
            array_pop($tokens);
        }
        if (!$tokens) {
            return $params;
        }
        array_pop($tokens);

        $isStart = false;
        foreach ($tokens as $i => $token) {
            if (!$isStart) {
                //去掉第一个(
                if ($token === '(') {
                    $isStart = true;
                }
                unset ($tokens[$i]);
                continue;
            }
            if (is_array($token) && $token[0] == T_WHITESPACE) {
                unset ($tokens[$i]);
            }
        }

        //dd ('312 --- ' . token_name (312));
        $newTokens = array_values($tokens);
        //dd ($newTokens);
        /**
         * 308 --- T_LNUMBER
         * 309 --- T_DNUMBER
         * 310 --- T_STRING
         * 312 --- T_VARIABLE
         * 318 --- T_CONSTANT_ENCAPSED_STRING
         * 366 --- T_ARRAY
         */
        $type    = null;
        $tmplist = [];

        foreach ($newTokens as $i => $token) {
            if (is_array($token)) {
                $identifier = $token[0];
                if ($identifier == T_VARIABLE) { // 312
                    if ($type == null) {
                        $params[] = null;
                    } elseif ($type == 'list') {
                        $tmplist[] = null;
                    }
                } elseif ($identifier == T_CONSTANT_ENCAPSED_STRING) { //318
                    $tmp = stripslashes($token[1]);
                    $val = substr($tmp, 1, strlen($tmp) - 2);
                    if ($type == null) {
                        $params[] = $val;
                    } elseif ($type == 'list') {
                        $tmplist[] = $val;
                    }
                } elseif ($identifier === T_STRING) { //310
                    $tmp = strtolower($token[1]);
                    $val = null;
                    if ($tmp == 'null') {
                        $val = null;
                    } elseif ($tmp == 'true') {
                        $val = true;
                    } elseif ($tmp == 'false') {
                        $val = false;
                    }
                    if ($type == null) {
                        $params[] = $val;
                    } elseif ($type == 'list') {
                        $tmplist[] = $val;
                    }
                } elseif ($identifier === T_LNUMBER) { //308
                    $val = intval($token[1]);
                    if ($type == null) {
                        $params[] = $val;
                    } elseif ($type == 'list') {
                        $tmplist[] = $val;
                    }
                } elseif ($identifier === T_DNUMBER) { //309
                    $val = floatval($token[1]);
                    if ($type == null) {
                        $params[] = $val;
                    } elseif ($type == 'list') {
                        $tmplist[] = $val;
                    }
                }
            } else {
                if ($token == ',') {

                } elseif ($token == '[') {
                    $type    = 'list';
                    $tmplist = [];
                } elseif ($token == ']') {
                    $type     = null;
                    $params[] = $tmplist;
                }
            }
        }
        return $params;
    }
}
