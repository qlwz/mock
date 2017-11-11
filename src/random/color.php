<?php
/**
 * Mock 颜色随机
 *
 * @author  情留メ蚊子 <qlwz@qq.com>
 * @link    http://www.94qing.com
 */

class ColorConvert
{
    /**
     * @param array $hsv
     * @return array
     */
    public static function hsv2hsl($hsv)
    {
        $h = $hsv[0];
        $s = $hsv[1] / 100;
        $v = $hsv[2] / 100;

        $l  = (2 - $s) * $v;
        $sl = $s * $v;
        $sl /= ($l <= 1) ? $l : 2 - $l;
        $l  /= 2;
        return [$h, $sl * 100, $l * 100];
    }

    /**
     * Converts RGB color to hex code
     *
     * @param array $rgb Array(Red, Green, Blue)
     * @return string String hex value (#000000 - #ffffff)
     */
    public static function rgb2hex($rgb)
    {
        $hex = '#';
        $hex .= str_pad(dechex($rgb[0]), 2, '0', STR_PAD_LEFT);
        $hex .= str_pad(dechex($rgb[1]), 2, '0', STR_PAD_LEFT);
        $hex .= str_pad(dechex($rgb[2]), 2, '0', STR_PAD_LEFT);
        return strtoupper($hex); // returns the hex value including the number sign (#)
    }

    /**
     * @param array $hsv
     * @return string
     */
    public static function hsv2hex($hsv)
    {
        $rgb = self::hsv2rgb($hsv);
        return self::rgb2hex($rgb);
    }

    /**
     * hsv To rgb
     *
     * @param array $hsv
     * @return array
     */
    public static function hsv2rgb(array $hsv)
    {
        $h  = $hsv[0] / 60;
        $s  = $hsv[1] / 100;
        $v  = $hsv[2] / 100;
        $hi = floor($h) % 6;

        $f = $h - floor($h);
        $p = 255 * $v * (1 - $s);
        $q = 255 * $v * (1 - ($s * $f));
        $t = 255 * $v * (1 - ($s * (1 - $f)));

        $v = 255 * $v;
        switch ($hi) {
            case 0:
                return [$v, $t, $p];
            case 1:
                return [$q, $v, $p];
            case 2:
                return [$p, $v, $t];
            case 3:
                return [$p, $q, $v];
            case 4:
                return [$t, $p, $v];
            case 5:
                return [$v, $p, $q];
            default :
                return [0, 0, 0];
        }
    }

    public static function hex2rgba($color, $opacity = false)
    {
        $default = 'rgb(0,0,0)';

        //Return default if no color provided
        if (empty ($color)) {
            return $default;
        }

        //Sanitize $color if "#" is provided 
        if ($color[0] == '#') {
            $color = substr($color, 1);
        }

        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
            $hex = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
        } elseif (strlen($color) == 3) {
            $hex = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
        } else {
            return $default;
        }

        //Convert hexadec to rgb
        $rgb = array_map('hexdec', $hex);

        //Check if opacity is set(rgba or rgb)
        if ($opacity) {
            if (abs($opacity) > 1) {
                $opacity = 1.0;
            }
            $output = 'rgba(' . implode(",", $rgb) . ',' . $opacity . ')';
        } else {
            $output = 'rgb(' . implode(",", $rgb) . ')';
        }

        //Return rgb(a) color string
        return $output;
    }

    /**
     * 随机生成一个有吸引力的颜色。
     * http://martin.ankerl.com/2009/12/09/how-to-create-random-colors-programmatically/
     * https://github.com/devongovett/color-generator/blob/master/index.js
     *
     * @param float $saturation
     * @param float $value
     * @return array()
     */
    public static function goldenRatioColor($saturation = null, $value = null)
    {
        $goldenRatio = 0.618033988749895;
        $hue         = mt_rand() / mt_getrandmax() + $goldenRatio;
        $hue         = $hue > 1 ? $hue - 1.0 : $hue;

        if (!is_float($saturation)) {
            $saturation = 0.5;
        }
        if (!is_float($value)) {
            $value = 0.95;
        }

        return [$hue * 360, $saturation * 100, $value * 100];
    }
}

/**
 * 随机生成一个有吸引力的颜色，格式为 '#RRGGBB'。
 *
 * @param string $name
 * @return string
 */
function mock_random_color($name = null)
{
    if ($name) {
        $dic = [
            'NAVY'   => '#001F3F', 'BLUE' => '#0074D9', 'AQUA' => '#7FDBFF', 'TEAL' => '#39CCCC', 'OLIVE' => '#3D9970',
            'GREEN'  => '#2ECC40', 'LIME' => '#01FF70', 'YELLOW' => '#FFDC00', 'ORANGE' => '#FF851B',
            'RED'    => '#FF4136', 'MAROON' => '#85144b', 'FUCHSIA' => '#F012BE', 'PURPLE' => '#B10DC9',
            'BLACK'  => '#111111', 'GRAY' => '#AAAAAA', 'SILVER' => '#DDDDDD', 'WHITE' => '#FFFFFF',
        ];
        if (isset ($dic[strtoupper($name)])) {
            return $dic[strtoupper($name)];
        }
    }
    return mock_random_hex();
}

/**
 * #DAC0DE
 *
 * @return string
 */
function mock_random_hex()
{
    $hsv = \ColorConvert::goldenRatioColor();
    $hex = \ColorConvert::hsv2hex($hsv);
    return $hex;
}

/**
 * rgb(128,255,255)
 *
 * @return string
 */
function mock_random_rgb()
{
    $hex = mock_random_hex();
    return \ColorConvert::hex2rgba($hex, false);
}

/**
 * rgba(128,255,255,0.3)
 *
 * @return string
 */
function mock_random_rgba()
{
    $hex = mock_random_hex();
    return \ColorConvert::hex2rgba($hex, sprintf('%.2f', mt_rand() / mt_getrandmax()));
}

/**
 * hsl(70,80,90)
 *
 * @return string
 */
function mock_random_hsl()
{
    $hsv = \ColorConvert::goldenRatioColor();
    $hsl = \ColorConvert::hsv2hsl($hsv);
    return 'hsl(' . intval($hsl[0]) . ',' . intval($hsl[1]) . ',' . intval($hsl[2]) . ')';
}
