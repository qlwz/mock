<?php

namespace qlwz\mock;

/**
 * Class Constant
 *
 * @package qlwz\mock
 * @author  情留メ蚊子 <qlwz@qq.com>
 * @link    http://www.94qing.com
 */
class Constant
{
    /**
     * RE_KEY
     * 'name|min-max': value
     * 'name|count': value
     * 'name|min-max.dmin-dmax': value
     * 'name|min-max.dcount': value
     * 'name|count.dmin-dmax': value
     * 'name|count.dcount': value
     * 'name|+step': value
     *
     * 1 name, 2 step, 3 range [ min, max ], 4 drange [ dmin, dmax ]
     */
    const RE_KEY   = '/(.+)\|(?:\+(\d+)|([\+\-]?\d+-?[\+\-]?\d*)?(?:\.(\d+-?\d*))?)/';
    const RE_RANGE = '/([\+\-]?\d+)-?([\+\-]?\d+)?/';
    /**
     * RE_PLACEHOLDER
     * placeholder(*)
     */
    const RE_PLACEHOLDER = '/\\\*@([^@#%&()\?\s]+)(?:\((.*?)\))?/';
    public static $GUID = 1;
}
