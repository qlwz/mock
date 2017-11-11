<?php
/**
 * Mock Web随机
 *
 * @author  情留メ蚊子 <qlwz@qq.com>
 * @link    http://www.94qing.com
 */

/**
 * 随机生成一个 URL。
 * [URL 规范](http://www.w3.org/Addressing/URL/url-spec.txt)
 * http                    Hypertext Transfer Protocol
 * ftp                     File Transfer protocol
 * gopher                  The Gopher protocol
 * mailto                  Electronic mail address
 * mid                     Message identifiers for electronic mail
 * cid                     Content identifiers for MIME body part
 * news                    Usenet news
 * nntp                    Usenet news for local NNTP access only
 * prospero                Access using the prospero protocols
 * telnet rlogin tn3270    Reference to interactive sessions
 * wais                    Wide Area Information Servers
 *
 * @param string $protocol
 * @param string $host
 * @return string
 */
function mock_random_url($protocol = null, $host = null)
{
    if (!$protocol) {
        $protocol = mock_random_protocol();
    }
    if (!$host) {
        $host = mock_random_domain();
    }
    return $protocol . '://' . $host . '/' . mock_random_word();
}

/**
 * 随机生成一个 URL 协议。
 *
 * @return string
 */
function mock_random_protocol()
{
    $list = [
        'http', 'ftp', 'gopher', 'mailto', 'mid', 'cid', 'news', 'nntp', 'prospero', 'telnet', 'rlogin', 'tn3270',
        'wais'
    ];
    return $list[mt_rand(0, count($list) - 1)];
}

/**
 * 随机生成一个域名。
 *
 * @param string $tld
 * @return string
 */
function mock_random_domain($tld = null)
{
    if (!$tld) {
        $tld = mock_random_tld();
    }
    return mock_random_word() . '.' . $tld;
}

/**
 * 随机生成一个顶级域名。
 * 国际顶级域名 international top-level domain-names, iTLDs
 * 国家顶级域名 national top-level domainnames, nTLDs
 * [域名后缀大全](http://www.163ns.com/zixun/post/4417.html)
 *
 * @return string
 */
function mock_random_tld()
{
    $list = [
        // 域名后缀
        'com', 'net', 'org', 'edu', 'gov', 'int', 'mil', 'cn', // 国内域名
        'com.cn', 'net.cn', 'gov.cn', 'org.cn', // 中文国内域名
        '中国', '中国互联.公司', '中国互联.网络', // 新国际域名
        'tel', 'biz', 'cc', 'tv', 'info', 'name', 'hk', 'mobi', 'asia', 'cd', 'travel', 'pro', 'museum', 'coop', 'aero',
        // 世界各国域名后缀
        'ad', 'ae', 'af', 'ag', 'ai', 'al', 'am', 'an', 'ao', 'aq', 'ar', 'as', 'at', 'au', 'aw', 'az', 'ba', 'bb',
        'bd', 'be', 'bf', 'bg', 'bh', 'bi', 'bj', 'bm', 'bn', 'bo', 'br', 'bs', 'bt', 'bv', 'bw', 'by', 'bz', 'ca',
        'cc', 'cf', 'cg', 'ch', 'ci', 'ck', 'cl', 'cm', 'cn', 'co', 'cq', 'cr', 'cu', 'cv', 'cx', 'cy', 'cz', 'de',
        'dj', 'dk', 'dm', 'do', 'dz', 'ec', 'ee', 'eg', 'eh', 'es', 'et', 'ev', 'fi', 'fj', 'fk', 'fm', 'fo', 'fr',
        'ga', 'gb', 'gd', 'ge', 'gf', 'gh', 'gi', 'gl', 'gm', 'gn', 'gp', 'gr', 'gt', 'gu', 'gw', 'gy', 'hk', 'hm',
        'hn', 'hr', 'ht', 'hu', 'id', 'ie', 'il', 'in', 'io', 'iq', 'ir', 'is', 'it', 'jm', 'jo', 'jp', 'ke', 'kg',
        'kh', 'ki', 'km', 'kn', 'kp', 'kr', 'kw', 'ky', 'kz', 'la', 'lb', 'lc', 'li', 'lk', 'lr', 'ls', 'lt', 'lu',
        'lv', 'ly', 'ma', 'mc', 'md', 'mg', 'mh', 'ml', 'mm', 'mn', 'mo', 'mp', 'mq', 'mr', 'ms', 'mt', 'mv', 'mw',
        'mx', 'my', 'mz', 'na', 'nc', 'ne', 'nf', 'ng', 'ni', 'nl', 'no', 'np', 'nr', 'nt', 'nu', 'nz', 'om', 'qa',
        'pa', 'pe', 'pf', 'pg', 'ph', 'pk', 'pl', 'pm', 'pn', 'pr', 'pt', 'pw', 'py', 're', 'ro', 'ru', 'rw', 'sa',
        'sb', 'sc', 'sd', 'se', 'sg', 'sh', 'si', 'sj', 'sk', 'sl', 'sm', 'sn', 'so', 'sr', 'st', 'su', 'sy', 'sz',
        'tc', 'td', 'tf', 'tg', 'th', 'tj', 'tk', 'tm', 'tn', 'to', 'tp', 'tr', 'tt', 'tv', 'tw', 'tz', 'ua', 'ug',
        'uk', 'us', 'uy', 'va', 'vc', 've', 'vg', 'vn', 'vu', 'wf', 'ws', 'ye', 'yu', 'za', 'zm', 'zr', 'zw'
    ];
    return $list[mt_rand(0, count($list) - 1)];
}

/**
 * 随机生成一个邮件地址。
 *
 * @param string $domain
 * @return string
 */
function mock_random_email($domain = null)
{
    if (!$domain) {
        $domain = mock_random_word() . '.' . mock_random_tld();
    }
    return mock_random_character('lower') . '.' . mock_random_word() . '@' . $domain;
}

/**
 * 随机生成一个邮件地址。
 *
 * @return string
 */
function mock_random_ip()
{
    $ip_long  = array(
        array('607649792', '608174079'), //36.56.0.0-36.63.255.255
        array('1038614528', '1039007743'), //61.232.0.0-61.237.255.255
        array('1783627776', '1784676351'), //106.80.0.0-106.95.255.255
        array('2035023872', '2035154943'), //121.76.0.0-121.77.255.255
        array('2078801920', '2079064063'), //123.232.0.0-123.235.255.255
        array('-1950089216', '-1948778497'), //139.196.0.0-139.215.255.255
        array('-1425539072', '-1425014785'), //171.8.0.0-171.15.255.255
        array('-1236271104', '-1235419137'), //182.80.0.0-182.92.255.255
        array('-770113536', '-768606209'), //210.25.0.0-210.47.255.255
        array('-569376768', '-564133889'), //222.16.0.0-222.95.255.255
    );
    $rand_key = mt_rand(0, 9);
    $ip       = long2ip(mt_rand($ip_long[$rand_key][0], $ip_long[$rand_key][1])); //随机生成国内某个ip
    return $ip;
}
