<?php
/**
 * Mock 图片随机
 *
 * @author  情留メ蚊子 <qlwz@qq.com>
 * @link    http://www.94qing.com
 */

/**
 * 生成一个随机的图片地址。
 * 替代图片源
 * http://fpoimg.com/
 * 参考自
 * http://rensanning.iteye.com/blog/1933310
 * http://code.tutsplus.com/articles/the-top-8-placeholders-for-web-designers--net-19485
 *
 * @param string $size
 * @param string $background
 * @param string $foreground
 * @param string $format
 * @param string $text
 * @return string
 */
function mock_random_image($size = null, $background = null, $foreground = null, $format = null, $text = null)
{
    $num = func_num_args();
    // Random.image( size, background, foreground, text )
    if ($num == 4) {
        $text   = $format;
        $format = null;
    }

    // Random.image( size, background, text )
    if ($num == 3) {
        $text       = $foreground;
        $foreground = null;
    }

    // Random.image()
    if (!$size || !preg_match('/^(\d+)x(\d+)$/', $size)) {
        $adSize = [
            '300x250', '250x250', '240x400', '336x280', '180x150', '720x300', '468x60', '234x60', '88x31', '120x90',
            '120x60', '120x240', '125x125', '728x90', '160x600', '120x600', '300x600'
        ];
        $size   = $adSize[mt_rand(0, count($adSize) - 1)];
    }

    if ($background && substr($background, 0, 1) == '#') {
        $background = substr($background, 1);
    }
    if ($foreground && substr($foreground, 0, 1) == '#') {
        $foreground = substr($foreground, 1);
    }
    // http://dummyimage.com/600x400/cc00cc/470047.png&text=hello
    $str = 'http://dummyimage.com/';
    $str .= $size;
    if ($background) {
        $str .= '/' . $background;
    }
    if ($foreground) {
        $str .= '/' . $foreground;
    }
    if ($format) {
        $str .= '.' . $format;
    }
    if ($text) {
        $str .= '&text=' . $text;
    }
    return $str;
}

/**
 * 生成一个随机的图片地址。
 * 替代图片源
 * http://fpoimg.com/
 * 参考自
 * http://rensanning.iteye.com/blog/1933310
 * http://code.tutsplus.com/articles/the-top-8-placeholders-for-web-designers--net-19485
 *
 * @param string $size
 * @param string $background
 * @param string $foreground
 * @param string $format
 * @param string $text
 * @return string
 */
function mock_random_img($size = null, $background = null, $foreground = null, $format = null, $text = null)
{
    return mock_random_image($size, $background, $foreground, $format, $text);
}

/**
 * 生成一段随机的 Base64 图片编码。
 *
 * @param string $size
 * @param string $text
 * @return string
 */
function mock_random_dataImage($size = null, $text = null)
{
    if (!$size || !preg_match('/^(\d+)x(\d+)$/', $size)) {
        $adSize = [
            '300x250', '250x250', '240x400', '336x280', '180x150', '720x300', '468x60', '234x60', '88x31', '120x90',
            '120x60', '120x240', '125x125', '728x90', '160x600', '120x600', '300x600'
        ];
        $size   = $adSize[mt_rand(0, count($adSize) - 1)];
    }
    if ($text === null) {
        $text = $size;
    }

    ob_start();

    list($w, $h) = explode('x', $size);
    $im = imagecreatetruecolor($w, $h);

    $hsv   = \ColorConvert::goldenRatioColor();
    $rgb   = \ColorConvert::hsv2rgb($hsv);
    $color = imagecolorallocate($im, $rgb[0], $rgb[1], $rgb[2]);
    imagefilledrectangle($im, 0, 0, $w, $h, $color);

    $white    = imagecolorallocate($im, 255, 255, 255);
    $fontSize = 14;
    $font     = 'simkai.ttf';

    $bbox = imagettfbbox($fontSize, 0, $font, $text);
    $x    = $bbox[0] + (imagesx($im) / 2) - ($bbox[4] / 2);
    $y    = $bbox[1] + (imagesy($im) / 2) - ($bbox[5] / 2);

    imagettftext($im, $fontSize, 0, $x, $y, $white, $font, $text);
    imagettftext($im, $fontSize, 0, $x + 1, $y, $white, $font, $text); //这是加粗
    imagepng($im);
    imagedestroy($im);

    $data = ob_get_contents();
    ob_end_clean();
    $base64 = base64_encode($data);

    return 'data:image/png;base64,' . $base64;
}
