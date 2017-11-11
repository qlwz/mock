<?php
/**
 * Mock 文本随机
 *
 * @author  情留メ蚊子 <qlwz@qq.com>
 * @link    http://www.94qing.com
 */

/**
 * @param      $defaultMin
 * @param      $defaultMax
 * @param null $min
 * @param null $max
 * @return int
 */
function mock_random_get_range($defaultMin, $defaultMax, $min = null, $max = null)
{
    if (!$min) {
        return mt_rand($defaultMin, $defaultMax);
    }
    if (!$max) {
        return intval($min) ?: 1;
    }
    return mock_random_natural($min, $max);
}

/**
 * 随机生成一段文本。
 *
 * @param int $min
 * @param int $max
 * @return string
 */
function mock_random_paragraph($min = null, $max = null)
{
    $len    = mock_random_get_range(3, 7, $min, $max);
    $result = [];
    for ($i = 0; $i < $len; $i++) {
        $result[] = mock_random_sentence();
    }
    return join(' ', $result);
}

/**
 * 随机生成一段文本。
 *
 * @param int $min
 * @param int $max
 * @return string
 */
function mock_random_cparagraph($min = null, $max = null)
{
    $len    = mock_random_get_range(3, 7, $min, $max);
    $result = [];
    for ($i = 0; $i < $len; $i++) {
        $result[] = mock_random_csentence();
    }
    return join('', $result);
}

/**
 * 随机生成一个句子，第一个单词的首字母大写。
 *
 * @param int $min
 * @param int $max
 * @return string
 */
function mock_random_sentence($min = null, $max = null)
{
    $len    = mock_random_get_range(12, 18, $min, $max);
    $result = [];
    for ($i = 0; $i < $len; $i++) {
        $result[] = mock_random_word();
    }
    return mock_random_capitalize(join(' ', $result)) . '.';
}

/**
 * 随机生成一个中文句子。
 *
 * @param int $min
 * @param int $max
 * @return string
 */
function mock_random_csentence($min = null, $max = null)
{
    $len    = mock_random_get_range(12, 18, $min, $max);
    $result = '';
    for ($i = 0; $i < $len; $i++) {
        $result .= mock_random_cword();
    }
    return $result . '。';
}

/**
 * 随机生成一个单词。
 *
 * @param int $min
 * @param int $max
 * @return string
 */
function mock_random_word($min = null, $max = null)
{
    $len    = mock_random_get_range(3, 10, $min, $max);
    $result = '';
    for ($i = 0; $i < $len; $i++) {
        $result .= mock_random_character('lower');
    }
    return $result;
}

/**
 * 随机生成一个或多个汉字。
 *
 * @param string $pool
 * @param int    $min
 * @param int    $max
 * @return string
 */
function mock_random_cword($pool = null, $min = null, $max = null)
{
    $DICT_KANZI = '的一是在不了有和人这中大为上个国我以要他时来用们生到作地于出就分对成会可主发年动同工也能下过子说产种面而方后多定行学法所民得经十三之进着等部度家电力里如水化高自二理起小物现实加量都两体制机当使点从业本去把性好应开它合还因由其些然前外天政四日那社义事平形相全表间样与关各重新线内数正心反你明看原又么利比或但质气第向道命此变条只没结解问意建月公无系军很情者最立代想已通并提直题党程展五果料象员革位入常文总次品式活设及管特件长求老头基资边流路级少图山统接知较将组见计别她手角期根论运农指几九区强放决西被干做必战先回则任取据处队南给色光门即保治北造百规热领七海口东导器压志世金增争济阶油思术极交受联什认六共权收证改清己美再采转更单风切打白教速花带安场身车例真务具万每目至达走积示议声报斗完类八离华名确才科张信马节话米整空元况今集温传土许步群广石记需段研界拉林律叫且究观越织装影算低持音众书布复容儿须际商非验连断深难近矿千周委素技备半办青省列习响约支般史感劳便团往酸历市克何除消构府称太准精值号率族维划选标写存候毛亲快效斯院查江型眼王按格养易置派层片始却专状育厂京识适属圆包火住调满县局照参红细引听该铁价严龙飞';

    $num = func_num_args();
    $len = 1;
    if ($num == 0) {
        $pool = $DICT_KANZI;
    } elseif ($num == 1) {
        if (preg_match('/^\d+$/', $pool)) {
            $len  = intval($pool);
            $pool = $DICT_KANZI;
        }
    } elseif ($num == 2) {
        if (preg_match('/^\d+$/', $pool)) {
            $len  = mock_random_natural($pool, $min);
            $pool = $DICT_KANZI;
        } else {
            $len = intval($min);
        }
    } else {
        $len = mock_random_natural($min, $max);
    }
    if ($len < 0) {
        $len = 1;
    }

    $len2   = mb_strlen($pool, 'utf-8') - 1;
    $result = '';
    for ($i = 0; $i < $len; $i++) {
        $result .= mb_substr($pool, floor(mt_rand(0, $len2)), 1);
    }
    return $result;
}

/**
 * 随机生成一句标题，其中每个单词的首字母大写。
 *
 * @param int $min
 * @param int $max
 * @return string
 */
function mock_random_title($min = null, $max = null)
{
    $len    = mock_random_get_range(3, 7, $min, $max);
    $result = [];
    for ($i = 0; $i < $len; $i++) {
        $result[] = mock_random_capitalize(mock_random_word());
    }
    return join(' ', $result);
}

/**
 * 随机生成一句中文标题。
 *
 * @param int $min
 * @param int $max
 * @return string
 */
function mock_random_ctitle($min = null, $max = null)
{
    $len    = mock_random_get_range(3, 7, $min, $max);
    $result = '';
    for ($i = 0; $i < $len; $i++) {
        $result .= mock_random_cword();
    }
    return $result;
}
